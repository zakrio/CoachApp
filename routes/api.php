<?php

declare(strict_types=1);

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CoachController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/coaches', CoachController::class)
    ->only(['index', 'show'])
    ->middleware('auth:sanctum');

Route::apiResource('/appointments', AppointmentController::class)
    ->only(['store', 'show'])
    ->middleware('auth:sanctum');
