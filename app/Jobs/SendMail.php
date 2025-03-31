<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $email;
    public $process_name;
    public $process;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data, $email, $process, $process_name)
    {
        $this->data = $data;
        $this->email = $email;
        $this->process = $process;
        $this->process_name = $process_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $process_name = $this->process_name;
        $process = $this->process;
        $email = $this->email;
        try {
            Mail::send(
                'mail.view-mail',
                $this->data,
                function ($message) use ($email, $process, $process_name) {
                    $message->to($email)
                    ->subject("Agio Notification: $process_name, Record #" . str_pad($process->record, 4, '0', STR_PAD_LEFT) . " - Activity: Submit Performed");
                }
            );
        } catch(\Exception $e) {
            info('Error Sending Mail', [$e]);
        }
    }
}
