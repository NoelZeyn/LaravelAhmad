<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WasteController; 
use App\Http\Controllers\ObjectDetectionController; 
use App\Http\Controllers\RecyclingCenterController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/map', function () {
    return view('map');
});
Route::get('/recycling_centers', function () {
    return view('recycling_centers');
});
Route::get('/api/recycling-centers', [RecyclingCenterController::class, 'index']); // Read all
Route::post('/api/recycling-centers', [RecyclingCenterController::class, 'store']); // Create
Route::get('/api/recycling-centers/{id}', [RecyclingCenterController::class, 'show']); // Read one
Route::put('/api/recycling-centers/{id}', [RecyclingCenterController::class, 'update']); // Update
Route::delete('/api/recycling-centers/{id}', [RecyclingCenterController::class, 'destroy']); // Delete

Route::get('/object-detection', [ObjectDetectionController::class, 'index']);


require __DIR__.'/auth.php';
