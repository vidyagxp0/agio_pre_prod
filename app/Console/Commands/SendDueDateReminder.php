<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DueDateReminderMail;
use Illuminate\Support\Facades\DB;




class SendDueReminders extends Command
{
    protected $signature = 'due:reminders';
    protected $description = 'Send due date reminder emails';

    public function handle()
    {
        $today = now();

        // Deviation
        $this->processReminder('deviations', 1, 'Deviation', $today);

        // CAPA
        $this->processReminder('capas', 2, 'CAPA', $today);

        // Risk
        $this->processReminder('risk_management', 3, 'Risk Assessment', $today);
    }

    private function processReminder($table, $processId, $processName, $today)
    {
        $stageRoleMap = [
            1 => 3, // Initiator
            2 => 4, // HOD
            3 => 7, // QA
        ];

        $records = DB::table($table)
            ->where('status', 'pending')
            ->get();

        foreach ($records as $record) {

            $daysLeft = $today->diffInDays($record->due_date, false);

            if ($daysLeft <= 7 && $daysLeft >= 0) {

                $roleId = $stageRoleMap[$record->stage_id] ?? null;

                if (!$roleId) continue;

                $users = DB::table('user_roles')
                    ->join('users', 'user_roles.user_id', '=', 'users.id')
                    ->where('user_roles.role_id', $roleId)
                    ->where('user_roles.q_m_s_processes_id', $processId)
                    ->get();

                foreach ($users as $user) {

                    Mail::to($user->email)
                        ->queue(new DueDateReminderMail($record, $processName));
                }
            }
        }
    }
}