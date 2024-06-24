<?php

use App\Http\Controllers\{
    CityController,
    CompanyController,
    DriverController,
    UserController,
    ProfileController,
    SettingsController,
    RoleController,
    TripController,
    ReportController,
    DashboardController
};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\Api\LoginController;

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

    Route::post('login', [LoginController::class, 'login']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('settings', SettingsController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('trips', TripController::class);
    Route::resource('cities', CityController::class);
});

require __DIR__.'/auth.php';
