<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class SendAdminUserEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $plainPassword;

    public $tries = 1;

    public function __construct($user, $plainPassword)
    {
        $this->user = $user;
        $this->plainPassword = $plainPassword;
    }

    public function handle()
    {
        try {

            Mail::send('mail.adminUserDetail', [
                'user' => $this->user,
                'plainPassword' => $this->plainPassword
            ], function ($message) {

                $message->to($this->user->email)
                        ->subject('Your Account Credentials');
            });

        } catch (Throwable $e) {

            Log::error('Admin user credential email failed.', [
                'user_id' => $this->user->id ?? null,
                'email' => $this->user->email ?? null,
                'error' => $e->getMessage(),
            ]);

        }
    }
}