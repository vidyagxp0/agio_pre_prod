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


    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
    {
        // Due Date Reminder (Daily Check)
        // $schedule->command('reminder:due-date')->everyMinute();
           $schedule->command('reminder:due-date')
        ->dailyAt('00:00');

        // Existing Scheduled Emails
        $scheduledEmails = DB::table('subscribes')->get();

        foreach ($scheduledEmails as $email) {

            $recipents = Recipent::where('subscribe_id',$email->id)->get();

            foreach($recipents as $temp){

                $user = User::where('id',$temp->user_id)->value('email');

                if($email->type == "Weekly"){

                    $schedule->command('email:send '.$user)
                        ->weekly()
                        ->days([$email->day])
                        ->at($email->time);

                }

                if($email->type == "Daily"){

                    $schedule->command('email:send '.$user)
                        ->dailyAt($email->time);

                }

                if ($email->type == "Monthly") {

                    $schedule->command('email:send '.$user)
                        ->monthly()
                        ->days([$email->day])
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
