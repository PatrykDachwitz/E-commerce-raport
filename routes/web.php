<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\testGoogle;
use Illuminate\Support\Facades\Route;


Route::post('/login', [LoginController::class, 'logIn'])
->name('login');
Route::get('/login', [LoginController::class, 'view'])
->name('login');
Route::put('/logOut', [LoginController::class, 'logOut'])
    ->middleware('auth:sanctum')
    ->name('logOut');

Route::get('{any}', function () {
    return view('index');
    })
    ->where('any', '.*')
    ->middleware('auth:sanctum')
    ->name('dashboard');
//Route::get('{any}', \App\Http\Controllers\TestApiResponseController::class)->where('any', '.*');
