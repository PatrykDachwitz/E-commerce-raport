<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;


$date = date("Y-m-d", strtotime("-1 day"));
$timezone = "Europe/Warsaw";
Artisan::command('report:result-day {date}', function (){})
    ->schedule([$date])
    ->timezone($timezone)
    ->dailyAt('6:30');

Artisan::command('report:comparison-day {date}', function (){})
    ->schedule([$date])
    ->timezone($timezone)
    ->dailyAt('6:20');

Artisan::command('report:weekly-day {date}', function (){})
    ->schedule([$date])
    ->timezone($timezone)
    ->dailyAt('6:50')
    ->mondays();

