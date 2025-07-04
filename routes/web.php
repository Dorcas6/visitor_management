<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\VisitorController;
use App\Http\Middleware\ReadOnlyAccess;
use App\Http\Middleware\UserOnlyResources;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:web,tenants')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::redirect('/', '/dashboard');
});

Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware(['auth:web,tenants', ReadOnlyAccess::class]);

Route::resource('users', UserController::class)
    ->except('index')
    ->middleware('auth:web');

Route::get('visitors', [VisitorController::class, 'index'])->name('visitors.index')->middleware(['auth:web,tenants', ReadOnlyAccess::class]);
Route::resource('visitors', VisitorController::class)
    ->except('index')
    ->middleware('auth:web');

Route::middleware('auth:tenants')->group(function () {
    Route::get('/tenants/dashboard', [DashboardController::class, 'index'])->name('tenants.dashboard');
});

Route::resource('tenants', TenantController::class)->middleware('auth');

Route::post('visits/{visit}/mark-departure', [VisitController::class, 'markDeparture'])->name('visits.mark-departure');

Route::get('visits', [VisitController::class, 'index'])->name('visits.index')->middleware(['auth:web,tenants', ReadOnlyAccess::class]);
Route::resource('visits', VisitController::class)
    ->except('index')
    ->middleware('auth:web');

require __DIR__ . '/auth.php';
