<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

Route::get('/admin', [AdminDashboardController::class, 'index'])->middleware(['auth', 'can:admins'])->name('admin.dashboard');
// Route::get('/admin', [AdminDashboardController::class, 'index'])->middleware(['admin','auth'])->name('admin.dashboard');
