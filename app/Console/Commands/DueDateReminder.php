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

    // private function resolveReminderUser($record, $processKey)
    // {
    //     $stage = $record->stage;
    //     $divisionId = $record->division_id ?? 1;

    //     switch ($processKey) {

    //         case 'Action Item':
    //             if ($stage == 1) {
    //                 $users = collect();
    //                 if (!empty($record->initiator_id)) {
    //                     $users = $users->merge(User::where('id', $record->initiator_id)->get());
    //                 }
    //                 $users = $users->merge($this->getUsersByRole($divisionId, 'Action Item', 3));
    //                 return $users->unique('id');
    //             }
    //             if ($stage == 2 || $stage == 3) {
    //                 $users = collect();
    //                 if (!empty($record->assign_to)) {
    //                     $users = $users->merge(User::where('id', $record->assign_to)->get());
    //                 }
    //                 $users = $users->merge($this->getUsersByRole($divisionId, 'Action Item', 18));
    //                 return $users->unique('id');
    //             }
    //             if ($stage == 4) {
    //                 $users = collect();
    //                 $users = $users->merge($this->getUsersByRole($divisionId, 'Action Item', 7));
    //                 $users = $users->merge($this->getUsersByRole($divisionId, 'Action Item', 66));
    //                 return $users->unique('id');
    //             }
    //             if ($stage == 5) {
    //                 return collect();
    //             }
    //             break;


    //     }

    //     return collect();
    // }

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

            case 'Change Proposal And Justification':
                if ($stage == 1) {
                    $users = collect();
                    if (!empty($record->initiator_id)) {
                        $users = $users->merge(User::where('id', $record->initiator_id)->get());
                    }
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Proposal And Justification', 3));
                    return $users->unique('id');
                }
                if ($stage == 2) {
                    $users = collect();
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Proposal And Justification', 4));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Proposal And Justification', 18));
                    return $users->unique('id');
                }
                if ($stage == 3) {
                    $users = collect();
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Proposal And Justification', 48));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Proposal And Justification', 63));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Proposal And Justification', 18));
                    return $users->unique('id');
                }
                if ($stage == 4) {
                    $users = collect();
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Proposal And Justification', 43));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Proposal And Justification', 9));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Proposal And Justification', 65));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Proposal And Justification', 18));
                    return $users->unique('id');
                }
                if ($stage == 5) {
                    return collect(); 
                }
                break;

            // ✅ CHANGE CONTROL
            case 'Change Control':

                // STAGE 1: Role 3
                if ($stage == 1) {
                    return $this->getUsersByRole($divisionId, 'Change Control', 3);
                }

                // STAGE 2: Role 4
                if ($stage == 2) {
                    return $this->getUsersByRole($divisionId, 'Change Control', 4);
                }

                // STAGE 3: Roles 7, 66
                if ($stage == 3) {
                    $users = collect();
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Control', 7));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Control', 66));
                    return $users->unique('id');
                }

                // STAGE 5: Roles 7, 66
                if ($stage == 5) {
                    $users = collect();
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Control', 7));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Control', 66));
                    return $users->unique('id');
                }

                // STAGE 6: Role 50
                if ($stage == 6) {
                    return $this->getUsersByRole($divisionId, 'Change Control', 50);
                }

                // STAGE 7: Roles 39, 43, 42, 9, 65
                if ($stage == 7) {
                    $users = collect();
                    $roleIds = [39, 43, 42, 9, 65];
                    foreach ($roleIds as $roleId) {
                        $users = $users->merge($this->getUsersByRole($divisionId, 'Change Control', $roleId));
                    }
                    return $users->unique('id');
                }

                // STAGE 9: Roles 3, 18
                if ($stage == 9) {
                    $users = collect();
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Control', 3));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Control', 18));
                    return $users->unique('id');
                }

                // STAGE 10: Roles 4, 18
                if ($stage == 10) {
                    $users = collect();
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Control', 4));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Control', 18));
                    return $users->unique('id');
                }

                // STAGE 11: Roles 7, 66, 18
                if ($stage == 11) {
                    $users = collect();
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Control', 7));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Control', 66));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Change Control', 18));
                    return $users->unique('id');
                }

                // STAGE 12: Roles 39, 42, 9, 43, 65, 18
                if ($stage == 12) {
                    $users = collect();
                    $roleIds = [39, 42, 9, 43, 65, 18];
                    foreach ($roleIds as $roleId) {
                        $users = $users->merge($this->getUsersByRole($divisionId, 'Change Control', $roleId));
                    }
                    return $users->unique('id');
                }

                break;

            case 'CAPA':

                // STAGE 1: Role 3
                if ($stage == 1) {
                    return $this->getUsersByRole($divisionId, 'CAPA', 3);
                }

                // STAGE 2: Role 4
                if ($stage == 2) {
                    return $this->getUsersByRole($divisionId, 'CAPA', 4);
                }

                // STAGE 3: Roles 48, 49, 63
                if ($stage == 3) {
                    $users = collect();
                    $roleIds = [48, 49, 63];
                    foreach ($roleIds as $roleId) {
                        $users = $users->merge($this->getUsersByRole($divisionId, 'CAPA', $roleId));
                    }
                    return $users->unique('id');
                }

                // STAGE 4: Roles 64, 67
                if ($stage == 4) {
                    $users = collect();
                    $roleIds = [64, 67];
                    foreach ($roleIds as $roleId) {
                        $users = $users->merge($this->getUsersByRole($divisionId, 'CAPA', $roleId));
                    }
                    return $users->unique('id');
                }

                // STAGE 5: Role 3
                if ($stage == 5) {
                    return $this->getUsersByRole($divisionId, 'CAPA', 3);
                }

                // STAGE 6: Role 4
                if ($stage == 6) {
                    return $this->getUsersByRole($divisionId, 'CAPA', 4);
                }

                // STAGE 7: Roles 7, 66
                if ($stage == 7) {
                    $users = collect();
                    $users = $users->merge($this->getUsersByRole($divisionId, 'CAPA', 7));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'CAPA', 66));
                    return $users->unique('id');
                }

                // STAGE 8: Roles 9, 39, 42, 43, 65
                if ($stage == 8) {
                    $users = collect();
                    $roleIds = [9, 39, 42, 43, 65];
                    foreach ($roleIds as $roleId) {
                        $users = $users->merge($this->getUsersByRole($divisionId, 'CAPA', $roleId));
                    }
                    return $users->unique('id');
                }

                // STAGE 9+: Closed - No mail (assuming stage 9 is closed)
                if ($stage >= 9) {
                    return collect();
                }

                break;

            case 'Deviation':

                // STAGE 1: Role 3 (Initiator)
                if ($stage == 1) {
                    return $this->getUsersByRole($divisionId, 'Deviation', 3);
                }

                // STAGE 2: Role 4 (HOD)
                if ($stage == 2) {
                    return $this->getUsersByRole($divisionId, 'Deviation', 4);
                }

                // STAGE 3: Roles 7, 66 (QA/CQA Initial Review)
                if ($stage == 3) {
                    $users = collect();
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Deviation', 7));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Deviation', 66));
                    return $users->unique('id');
                }

                // STAGE 4: Roles 7, 66 (QA/CQA Final Assessment)
                if ($stage == 4) {
                    $users = collect();
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Deviation', 7));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Deviation', 66));
                    return $users->unique('id');
                }

                // STAGE 5: Roles 7, 66 (Send to Initiator/HOD/QA)
                if ($stage == 5) {
                    $users = collect();
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Deviation', 7));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Deviation', 66));
                    return $users->unique('id');
                }

                // STAGE 6: Roles 43, 65, 42, 9, 39 (Approval)
                if ($stage == 6) {
                    $users = collect();
                    $roleIds = [43, 65, 42, 9, 39];
                    foreach ($roleIds as $roleId) {
                        $users = $users->merge($this->getUsersByRole($divisionId, 'Deviation', $roleId));
                    }
                    return $users->unique('id');
                }

                // STAGE 7: Role 3 (Initiator Update)
                if ($stage == 7) {
                    return $this->getUsersByRole($divisionId, 'Deviation', 3);
                }

                // STAGE 8: Role 4 (HOD Final Review)
                if ($stage == 8) {
                    return $this->getUsersByRole($divisionId, 'Deviation', 4);
                }

                // STAGE 9: Roles 7, 66 (Implementation Verification)
                if ($stage == 9) {
                    $users = collect();
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Deviation', 7));
                    $users = $users->merge($this->getUsersByRole($divisionId, 'Deviation', 66));
                    return $users->unique('id');
                }

                // STAGE 10: Roles 43, 65, 42, 39, 9 (Closure Approval)
                if ($stage == 10) {
                    $users = collect();
                    $roleIds = [43, 65, 42, 39, 9];
                    foreach ($roleIds as $roleId) {
                        $users = $users->merge($this->getUsersByRole($divisionId, 'Deviation', $roleId));
                    }
                    return $users->unique('id');
                }

                // STAGE 11: Roles 65, 43, 42, 39, 9 (Cancellation)
                if ($stage == 11) {
                    $users = collect();
                    $roleIds = [65, 43, 42, 39, 9];
                    foreach ($roleIds as $roleId) {
                        $users = $users->merge($this->getUsersByRole($divisionId, 'Deviation', $roleId));
                    }
                    return $users->unique('id');
                }

                // STAGE 12: Closed - No mail
                if ($stage == 12) {
                    return collect(); 
                }
                break;
            default:
                 return collect();
        }
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
            'CAPA' => '/capashow/',
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
            'CAPA' => 'CAPA',
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
            'Change Proposal And Justification' => 'CPJ',
        ];

        return $codes[$processName] ?? 'XX';
    }
}
