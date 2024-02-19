<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NginxStatusController;

Route::get('/', function () {
    return view('welcome');
});

// Use DashboardController@index for the default dashboard view
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Here, you can define additional routes for specific dashboard sections like Nginx status
    // For example, to keep the Nginx status page accessible as a separate route:
    Route::get('/status/nginx', [NginxStatusController::class, 'dashboard'])->name('status.nginx');

    // Add routes for other statuses or functionalities as needed
});

require __DIR__.'/auth.php';
