<?php

namespace App\Console;

use App\Console\Scheduling\ExtendedSchedule;
use App\Models\Recipent;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{


    protected $commands = [
        \App\Console\Commands\SendScheduledEmail::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $scheduledEmails = DB::table('subscribes')->get();
            foreach ($scheduledEmails as $email) {
                $recipents = Recipent::where('subscribe_id',$email->id)->get();
                foreach($recipents as $temp){
                    $user = User::where('id',$temp->user_id)->value('email');
                    if($email->type == "Weekly"){
                        $schedule->command('email:send '.$user)
                        ->weekly()
                        ->days([$email->day]) // Replace [1] with an array of the desired day(s) (1 for Monday, 2 for Tuesday, etc.)
                        ->at($email->time);
                    }
                    if($email->type == "Daily"){
                        $schedule->command('email:send '.$user)
                        ->dailyAt($email->time);
                    }
                    // if($email->type == "Monthly"){
                    //     $schedule->command('email:send '.$user)
                    //     ->monthly()
                    //     ->days([3]) // Replace [3] with the desired day(s) of the week (0-6, where 0 is Sunday)
                    //     ->when(4)
                    //     ->at('10:20');
                    // }
                    if ($email->type == "Monthly") {
                        $schedule->command('email:send ' . $user)
                            ->monthly()
                            ->days([$email->day]) // Replace [3] with the desired day(s) of the week (0-6, where 0 is Sunday)
                            ->when(function () use ($email) {
                                return function ($date) use ($email) {
                                $date->weekOfMonth === $email->week;
                                };
                            })
                            ->at($email->time);
                    }

                }
                }

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
