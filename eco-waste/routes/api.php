<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecyclingCenterController;
Route::get('/api/recycling-centers', [RecyclingCenterController::class, 'index']); // Read all
Route::post('/api/recycling-centers', [RecyclingCenterController::class, 'store']); // Create
Route::get('/api/recycling-centers/{id}', [RecyclingCenterController::class, 'show']); // Read one
Route::put('/api/recycling-centers/{id}', [RecyclingCenterController::class, 'update']); // Update
Route::delete('/api/recycling-centers/{id}', [RecyclingCenterController::class, 'destroy']); // Delete