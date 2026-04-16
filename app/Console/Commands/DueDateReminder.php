<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Carbon\Carbon;
use App\Jobs\SendReminderMailJob; 
use App\Models\QMSProcess;
use Illuminate\Support\Facades\DB;

class DueDateReminder extends Command
{
    protected $signature = 'reminder:due-date';
    protected $description = 'Send due date reminder mails';

    private function generateRecordNumber($record, $processName)
{
    $divisionId = $record->division_id ?? 1;

    // Division Name (you can customize mapping)
    $divisionMap = [
        1 => 'Corporate',
        2 => 'Plant',
    ];

    $divisionName = $divisionMap[$divisionId] ?? 'Corporate';

    $processCode = $this->getProcessCode($processName);

    $year = now()->year;

    $recordId = str_pad($record->id, 4, '0', STR_PAD_LEFT);

    return "{$divisionName}/{$processCode}/{$year}/{$recordId}";
}

    public function handle()
    {
        Log::info('REMINDER_JOB_STARTED', [
            'time' => now()->toDateTimeString()
        ]);

        $today = Carbon::today();
        $processes = config('qms_processes.processes') ?? [];

        if (empty($processes)) {
            Log::error('NO_PROCESSES_FOUND');
            return;
        }

        foreach ($processes as $key => $process) {

            $model = $process['model'] ?? null;
            $processName = $process['name'] ?? 'Process';

            if (!$model || !class_exists($model)) {
                Log::error('MODEL_NOT_FOUND', ['model' => $model]);
                continue;
            }

            $records = $model::whereNotNull('due_date')->get();

            foreach ($records as $record) {

                try {
                    $dueDate = Carbon::parse($record->due_date);
                } catch (\Exception $e) {
                    Log::warning('DATE_PARSE_FAILED', [
                        'record_id' => $record->id,
                        'date' => $record->due_date
                    ]);
                    continue;
                }

                $startReminder = $dueDate->copy()->subDays(7);

                Log::info('RECORD_CHECK', [
                    'process' => $processName,
                    'record_id' => $record->id,
                    'today' => $today->toDateString(),
                    'due_date' => $dueDate->toDateString()
                ]);

                if (!$today->between($startReminder, $dueDate)) {
                    continue;
                }

                // Users fetch karo
                $users = $this->resolveReminderUser($record, $processName);
                $recordUrl = $this->getRecordUrl($processName, $record);

                if ($users->isEmpty()) {
                    Log::warning('NO_USERS_FOUND', [
                        'record_id' => $record->id
                    ]);
                    continue;
                }

               foreach ($users as $user) {

                    if (empty($user->email)) {
                        continue;
                    }

                    try {

                        $recordUrl = $this->getRecordUrl($processName, $record);

                        // ✅ generate record number
                        $recordNumber = $this->generateRecordNumber($record, $processName);

                        Log::info('DEBUG_RECORD', [
                            'record_id' => $record->id,
                            'record_number' => $recordNumber,
                        ]);

                        SendReminderMailJob::dispatch(
                            $user,
                            $record,
                            $processName,
                            $recordUrl,
                            $recordNumber // ✅ ADD THIS
                        );

                    } catch (\Exception $e) {
                        Log::error('MAIL_FAILED', [
                            'email' => $user->email,
                            'error' => $e->getMessage()
                        ]);
                    }
                }
            }
        }

        Log::info('REMINDER_JOB_FINISHED', [
            'time' => now()->toDateTimeString()
        ]);
    }

    private function resolveReminderUser($record, $processKey)
    {
        $stage = $record->stage;
        $divisionId = $record->division_id ?? 1;
        
        switch ($processKey) {
            
            case 'Action Item':
                if ($stage == 1) {
                    $users = collect();
                    if (!empty($record->initiator_id)) {
                        $users = $users->merge(User::where('id', $record->initiator_id)->get());
                    }
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Action Item', 3));
                    return $users->unique('id');
                }
                if ($stage == 2 || $stage == 3) {
                    $users = collect();
                    if (!empty($record->assign_to)) {
                        $users = $users->merge(User::where('id', $record->assign_to)->get());
                    }
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Action Item', 18));
                    return $users->unique('id');
                }
                if ($stage == 4) {
                    $users = collect();
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Action Item', 7));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Action Item', 66));
                    return $users->unique('id');
                }
                if ($stage == 5) {
                    return collect();
                }
                break;
                 
        }
        
        return collect();
    }

    private function getUsersByRole($divisionId, $processName, $roleId)
    {
        $process = QMSProcess::where([
            'division_id' => $divisionId,
            'process_name' => $processName
        ])->first();
        
        if (!$process) {
            return collect();
        }
        
        $userIds = DB::table('user_roles')
            ->where('q_m_s_divisions_id', $divisionId)
            ->where('q_m_s_processes_id', $process->id)
            ->where('q_m_s_roles_id', $roleId)
            ->pluck('user_id');
        
        if ($userIds->isEmpty()) {
            return collect();
        }
        
        return User::whereIn('id', $userIds)->get();
    }

    private function getRecordUrl($processName, $record)
    {
        $baseUrl = config('app.url');
        
        $urls = [
            'Action Item' => '/rcms/actionItem/',
            'Change Control' => '/rcms/changeControl/',
            'CAPA' => '/rcms/capa/',
            'Deviation' => '/rcms/deviation/',
            'Change Proposal And Justification' => '/rcms/changeProposal/',
        ];
        
        $path = $urls[$processName] ?? '/rcms/dashboard/';
        return $baseUrl . $path . $record->id;
    }

    private function getProcessCode($processName)
    {
        $codes = [
            'Extension' => 'EXT',
            'Action Item' => 'AI',
            'Resampling' => 'RS',
            'Observation' => 'OB',
            'Root Cause Analysis' => 'RCA',
            'Risk Assessment' => 'RA',
            'Management Review' => 'MR',
            'External Audit' => 'EA',
            'Internal Audit' => 'IA',
            'Audit Program' => 'AP',
            'CAPA' => 'CA',
            'Change Control' => 'CC',
            'New Document' => 'ND',
            'Lab Incident' => 'LI',
            'Effectiveness Check' => 'EC',
            'OOS/OOT' => 'OOS',
            'OOC' => 'OOC',
            'Deviation' => 'DV',
            'Market Complaint' => 'MC',
            'Incident' => 'INC',
            'ERRATA' => 'ERR',
            'Change Proposal And Justification' => 'CP',
        ];
        
        return $codes[$processName] ?? 'XX';
    }
}