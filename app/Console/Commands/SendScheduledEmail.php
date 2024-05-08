<?php

namespace App\Console\Commands;

use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendScheduledEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {user}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = $this->argument('user');

        $email = User::where('email',$user)->first();
        // Logic to send the email
        // $email = 'shrivastavaji0911@gmail.com';
        // $name = 'Recipient Name';
        $subject = 'Sample Email';
        $data = [
            'message' => 'This is a sample email message.',
        ];

        Mail::to($email->email)->send(new SendEmail($subject, $email->name));

        $this->info('Sample email sent successfully.');
    }
    // public function handle()
    // {
    //     return Command::SUCCESS;
    // }
}
