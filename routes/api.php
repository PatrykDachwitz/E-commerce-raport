<?php

use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\HistoriesReportController;
use App\Http\Controllers\Api\Report\ComparisonController;
use App\Http\Controllers\Api\Report\DailyController;
use App\Http\Controllers\Api\Report\WeeklyController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::put('users/{user}/super_admin', [UserController::class, 'setSuperAdmin'])
    ->middleware('auth:sanctum')
    ->name('users.superAdmin');

Route::apiResource('users', UserController::class)
    ->middleware('auth:sanctum');

Route::apiResource('histories_report', HistoriesReportController::class)
    ->only('index')
    ->middleware('auth:sanctum');

Route::apiResource('countries', CountryController::class)
    ->middleware('auth:sanctum');

Route::group([
    'prefix' => 'report',
    'as' => 'report.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('daily', DailyController::class)
        ->name('daily');
    Route::get('weekly', WeeklyController::class)
        ->name('weekly');

    Route::get('comparison', ComparisonController::class)
        ->name('comparison');
});
