<?php

use App\Http\Controllers\v1\ContactController;
use App\Http\Controllers\v1\GeneralInfoController;
use Illuminate\Support\Facades\Route;

Route::put('info', [GeneralInfoController::class, 'update']);
Route::get('contacts', ContactController::class);
