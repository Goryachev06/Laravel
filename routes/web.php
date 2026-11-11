<?php

use App\Http\Controllers\CapitalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CapitalController::class, 'index'])->name('home');
Route::resource('capitals', CapitalController::class);