<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
 use App\Http\Controllers\Admin\PermissionController;

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
            ->only(['index','show'])->middleware('permission:permissions.view');;

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
