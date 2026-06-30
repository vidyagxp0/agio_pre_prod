<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

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
    $remainingDays = Carbon::today()->diffInDays(
        Carbon::parse($this->record->due_date),
        false
    );

    Mail::send('mail.due_reminder', [

        'user' => $this->user,
        'record' => $this->record,
        'processName' => $this->processName,
        'recordUrl' => $this->recordUrl,
        'dueDate' => $this->record->due_date,
        'recordNumber' => $this->emailRecordNumber,
        'remainingDays' => $remainingDays,
        

    ], function ($message) use ($remainingDays) {

        $subject = "⚠️ {$this->processName}";

        if ($remainingDays > 0) {
            $subject .= " - Due in {$remainingDays} Day(s)";
        } elseif ($remainingDays == 0) {
            $subject .= " - Due Today";
        } else {
            $subject .= " - Overdue";
        }

        $message->to($this->user->email)
                ->subject($subject);
    });
}
}