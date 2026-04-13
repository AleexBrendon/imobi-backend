<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('clients', ClientController::class);
    Route::apiResource('properties', PropertyController::class);
    Route::apiResource('contracts', ContractController::class);

    Route::get('documents', [DocumentController::class, 'index']);
    Route::post('documents', [DocumentController::class, 'store']);
    Route::get('documents/{id}', [DocumentController::class, 'show']);
    Route::delete('documents/{id}', [DocumentController::class, 'destroy']);

    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::post('/logout', [AuthController::class, 'logout']);
});