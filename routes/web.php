<?php

use Illuminate\Support\Facades\Route;

Route::get("/testGoogle", \App\Http\Controllers\testGoogle::class);

Route::get('{any}', function () {
    return view('index');
})->where('any', '.*');
//Route::get('{any}', \App\Http\Controllers\TestApiResponseController::class)->where('any', '.*');
