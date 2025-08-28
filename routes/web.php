<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Account routes
Route::resource('accounts', AccountController::class);