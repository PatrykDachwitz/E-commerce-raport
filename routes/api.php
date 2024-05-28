<?php

use App\Http\Controllers\Api\Report\DailyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group([
    'prefix' => 'report',
    'as' => 'report.',
], function () {
    Route::get('daily', DailyController::class)
    ->name('daily');
});
