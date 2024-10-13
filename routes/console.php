<?php

use App\Console\Commands\VaccineReminderEmailCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(VaccineReminderEmailCommand::class)
    ->customWeekdays()
    ->dailyAt('00:38')
    ->timezone('Asia/Dhaka')
    ->withoutOverlapping(10);
