<?php

use App\Http\Controllers\ClientShowController;
use App\Http\Controllers\ServiceIndexController;
use Illuminate\Support\Facades\Route;

Route::get('/clients', ClientShowController::class)->name('client.show');
Route::get('/services', ServiceIndexController::class)->name('service.index');
