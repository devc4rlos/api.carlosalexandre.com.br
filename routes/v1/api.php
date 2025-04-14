<?php

use App\Http\Controllers\v1\AuthenticationController;
use App\Http\Controllers\v1\ContactController;
use App\Http\Controllers\v1\GeneralInfoController;
use App\Http\Controllers\v1\LinkController;
use App\Http\Controllers\v1\SocialNetworkController;
use Illuminate\Support\Facades\Route;

Route::get('contacts', ContactController::class);
Route::post('login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', [AuthenticationController::class, 'logout']);
    Route::put('info', [GeneralInfoController::class, 'update']);
    Route::apiResource('links', LinkController::class);
    Route::apiResource('social-network', SocialNetworkController::class);
});
