<?php

use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:web,tenants')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::redirect('/', '/dashboard');
    // Route::view('/', 'base')->name('dashboard');
    // Route::get('/', function () {
    //     dd(auth()->user());
    // })->name('dashboard');

    // Routes pour les utilisateurs (agents de sécurité)
    Route::resource('users', UserController::class);

    // Routes pour les visiteurs
    Route::resource('visitors', VisitorController::class);

    // Routes pour les visites
    Route::resource('visits', VisitController::class);
    Route::post('visits/{visit}/mark-departure', [VisitController::class, 'markDeparture'])
        ->name('visits.mark-departure');

    // Routes pour les locataires
    Route::resource('tenants', TenantController::class);
});

Route::middleware('auth:tenants')->group(function () {
    Route::get('/tenants/dashboard', function () {
        dd(auth('tenants')->user());
    })->name('tenants.dashboard');
});

require __DIR__ . '/auth.php';

?>