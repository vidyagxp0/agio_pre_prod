<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendAdminUserEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $user;
    public $plainPassword;

    public function __construct($user, $plainPassword)
    {
        $this->user = $user;
        $this->plainPassword = $plainPassword;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
     {
        Mail::send('mail.adminUserDetail', [
            'user' => $this->user,
            'plainPassword' => $this->plainPassword
        ], function ($message) {
            $message->to($this->user->email)
                    ->subject('Your Account Credentials');
        });
    }
}
