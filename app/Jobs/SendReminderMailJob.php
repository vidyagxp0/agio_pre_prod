<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendReminderMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $record;
    public $processName;
    public $recordUrl;
    public $emailRecordNumber;

    public function __construct($user, $record, $processName, $recordUrl, $recordNumber)
    {
        $this->user = $user;
        $this->record = $record;
        $this->processName = $processName;
        $this->recordUrl = $recordUrl;
        $this->emailRecordNumber = $recordNumber;
    }

    public function handle()
    {
        Log::info('JOB_RUNNING', [
            'record_number' => $this->emailRecordNumber
        ]);

        Mail::send('mail.due_reminder', [
            'user' => $this->user,
            'record' => $this->record,
            'processName' => $this->processName,
            'recordUrl' => $this->recordUrl,
            'dueDate' => $this->record->due_date,
            'recordNumber' => $this->emailRecordNumber // ✅ correct
        ], function ($message) {
            $message->to($this->user->email)
                    ->subject('⚠️ Reminder: Due Date Near');
        });

        Log::info('JOB_FINAL_DATA', [
            'emailRecordNumber' => $this->emailRecordNumber
        ]);
    }
}