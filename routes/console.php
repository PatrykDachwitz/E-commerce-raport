<?php

use App\Console\Commands\ReportComparisonDay;
use App\Console\Commands\ReportResultDay;
use App\Console\Commands\ReportResultWeekly;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
/*
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
*/
$date = date("Y-m-d", strtotime("-1 day"));
$timezone = "Europe/Warsaw";
Schedule::command(ReportResultDay::class, [$date])
    ->timezone($timezone)
    ->dailyAt('6:30');

Schedule::command(ReportComparisonDay::class, [$date])
    ->timezone($timezone)
    ->dailyAt('6:20');

Schedule::command(ReportResultWeekly::class, [$date])
    ->timezone($timezone)
    ->dailyAt('6:50')
    ->mondays();

