<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\BusOperatorController;
use App\Http\Controllers\Admin\BusRouteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SeatSelectionController;
use App\Http\Controllers\Frontend\BookingController;


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::middleware(['auth', 'permission:users.view'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    });

    Route::middleware(['auth', 'permission:users.create'])->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
    });

    Route::middleware(['auth', 'permission:users.edit'])->group(function () {
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    });

    Route::middleware(['auth', 'permission:users.delete'])->group(function () {
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::resource('roles', RoleController::class)
        ->only(['index'])
        ->middleware('permission:roles.view');

    Route::resource('roles', RoleController::class)
        ->only(['create', 'store'])
        ->middleware('permission:roles.create');

    Route::resource('roles', RoleController::class)
        ->only(['edit', 'update'])
        ->middleware('permission:roles.edit');

    Route::resource('roles', RoleController::class)
        ->only(['destroy'])
        ->middleware('permission:roles.delete');

    Route::resource('permissions', PermissionController::class)
        ->only(['index', 'show'])->middleware('permission:permissions.view');

    Route::resource('bus-operators', BusOperatorController::class)
        ->only(['index'])
        ->middleware('permission:bus-operators.view');

    Route::resource('bus-operators', BusOperatorController::class)
        ->only(['create', 'store'])
        ->middleware('permission:bus-operators.create');

    Route::resource('bus-operators', BusOperatorController::class)
        ->only(['edit', 'update'])
        ->middleware('permission:bus-operators.edit');

    Route::resource('bus-operators', BusOperatorController::class)
        ->only(['destroy'])
        ->middleware('permission:bus-operators.delete');

    Route::resource('buses', BusController::class)
        ->only(['index'])
        ->middleware('permission:buses.view');

    Route::resource('buses', BusController::class)
        ->only(['create', 'store'])
        ->middleware('permission:buses.create');

    Route::resource('buses', BusController::class)
        ->only(['edit', 'update'])
        ->middleware('permission:buses.edit');

    Route::resource('buses', BusController::class)
        ->only(['destroy'])
        ->middleware('permission:buses.delete');

    Route::resource('bus-routes', BusRouteController::class)
        ->only(['index'])
        ->middleware('permission:bus-routes.view');

    Route::resource('bus-routes', BusRouteController::class)
        ->only(['create', 'store'])
        ->middleware('permission:bus-routes.create');

    Route::resource('bus-routes', BusRouteController::class)
        ->only(['edit', 'update'])
        ->middleware('permission:bus-routes.edit');

    Route::resource('bus-routes', BusRouteController::class)
        ->only(['destroy'])
        ->middleware('permission:bus-routes.delete');

    Route::resource('trips', TripController::class)
        ->only(['index'])
        ->middleware('permission:trips.view');

    Route::resource('trips', TripController::class)
        ->only(['create', 'store'])
        ->middleware('permission:trips.create');

    Route::resource('trips', TripController::class)
        ->only(['edit', 'update'])
        ->middleware('permission:trips.edit');

    Route::resource('trips', TripController::class)
        ->only(['destroy'])
        ->middleware('permission:trips.delete');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/trips/{trip}/seat-selection', [SeatSelectionController::class, 'index'])
    ->name('frontend.seat-selection');

Route::post('/trips/{trip}/booking', [BookingController::class, 'store'])
    ->name('booking.store');

Route::post('/passenger-details', [BookingController::class, 'passengerDetails'])
    ->name('frontend.passenger-details');

Route::get('/trips/{trip}/review', [BookingController::class, 'review'])
    ->name('booking.review');
Route::get('/booking/{booking}/confirmation', [BookingController::class, 'confirmation'])
    ->name('booking.confirmation');


require __DIR__.'/auth.php';
