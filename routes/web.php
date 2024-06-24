<?php

use Illuminate\Support\Facades\Route;

Route::get("/testGoogle", \App\Http\Controllers\Api\Report\DailyController::class);

Route::get('{any}', function () {
    return view('index');
})->where('any', '.*');
//Route::get('{any}', \App\Http\Controllers\TestApiResponseController::class)->where('any', '.*');
