<?php

namespace App\Console\Scheduling;

use Illuminate\Console\Scheduling\Schedule;

class ExtendedSchedule extends Schedule
{
    // Add your custom methods or override existing methods here
        public function skipIfNotFifthWednesday()
    {
        $this->skip(function ($date) {
            return $date->weekOfMonth !== 5 || $date->dayOfWeek !== 3; // 5th Wednesday (weekOfMonth = 5, dayOfWeek = 3)
        });

        return $this;
    }
}
