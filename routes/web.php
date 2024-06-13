<?php

use App\Http\Controllers\{
    CompanyController,
    DriverController,
    UserController,
    ProfileController,
    SettingsController,
    RoleController,
    RunController,
    ReportController,
    DashboardController
};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(callback: function () {
//    Route::resource('/dashboard', DashboardController::class)->name('dashboard.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('settings', SettingsController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('runs', RunController::class);
});

require __DIR__.'/auth.php';
