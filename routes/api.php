<?php

use App\Http\Controllers\Api\AccountsController;
use Illuminate\Support\Facades\Route;

// List all accounts
Route::get('/accounts', [AccountsController::class, 'index']);

// Get detailed account information
Route::get('/accounts/{id}', [AccountsController::class, 'show']);