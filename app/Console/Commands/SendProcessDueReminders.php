<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DueDateReminderMail;
use Illuminate\Support\Facades\DB;

class SendProcessDueReminders extends Command
{
    protected $signature = 'process:due-reminders';
    protected $description = 'Send due date reminders for all processes';

    public function handle()
    {
        $today = now();

        // Process tables
        $this->processReminder('deviations', 36, 'Deviation', $today);
        $this->processReminder('capas', 2, 'CAPA', $today);
        $this->processReminder('risk_management', 3, 'Risk Assessment', $today);

        $this->info('Reminder process completed.');
    }

   private function processReminder($table, $processId, $processName, $today)
{
    $stageRoleMap = [
        1 => 3, // Initiator
        2 => 4, // HOD
        3 => 7, // QA
    ];

    $records = DB::table($table)
        ->whereNotNull('stage')
        ->get();

    $this->info("===== {$processName} =====");
    $this->info('Records found: ' . $records->count());

    foreach ($records as $record) {

        // 🔥 DEBUG START
        $this->info("Record ID: {$record->id}");
        $this->info("Stage: {$record->stage}");
        $this->info("Due Date: {$record->due_date}");

        $daysLeft = $today->diffInDays($record->due_date, false);

        $this->info("Days Left: {$daysLeft}");
        // 🔥 DEBUG END

      
    if($daysLeft <= 7 && $daysLeft >=0)
    {
            $this->info("✅ Condition PASSED");

            $roleId = $stageRoleMap[$record->stage] ?? null;

            if (!$roleId) {
                $this->info("❌ No role mapping for stage: {$record->stage}");
                continue;
            }

            $this->info("Role ID: {$roleId}");

            $users = DB::table('user_roles')
                ->join('users', 'user_roles.user_id', '=', 'users.id')
                ->where('user_roles.q_m_s_roles_id', $roleId)
                ->where('user_roles.q_m_s_processes_id', $processId)
                ->get();

            $this->info("Users found: " . $users->count());

            foreach ($users as $user) {

                if ($user->email) {

                    $this->info("📧 Sending mail to: {$user->email}");

                    Mail::to($user->email)
                        ->queue(new DueDateReminderMail($record, $processName));
                }
            }

        } else {
            $this->info("❌ Condition FAILED (not within 7 days)");
        }

        $this->info("-------------------------");
    }
}
}