<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/gudangku')->group(function () {
    Auth::routes(['verify'=>true]);
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->middleware(['auth','verified'])->group(function () {
    /**
     * only super admin
     */
    Route::middleware(['role:super-admin'])->group(function () {
        /**
         * ROLES
         */
        Route::get('/roles', [Spatie\RoleController::class, 'index'])->name('roles.index');
        Route::post('/roles', [Spatie\RoleController::class, 'store'])->name('roles.store');

        /**
         * PERMISSIONS
         */
        Route::get('/permissions', [Spatie\PermissionController::class, 'index'])->name('permissions.index');
        Route::post('/permissions', [Spatie\PermissionController::class, 'store'])->name('permissions.store');

        /**
         * ASSIGN PERMISSION
         */
        Route::get('/assign', [Spatie\AssignController::class, 'index'])->name('assign.index');
        Route::post('/assign', [Spatie\AssignController::class, 'store'])->name('assign.store');
        Route::get('/assign/{role}/edit', [Spatie\AssignController::class, 'edit'])->name('assign.edit');
        Route::put('/assign/{role}/edit', [Spatie\AssignController::class, 'update'])->name('assign.update');
    });

    /**
     * USERS
     */
    Route::resource('/users', Admin\UserController::class)->middleware(['role:super-admin|admin']);

    /**
     * CATEGORIES
     */
    Route::resource('/categories', Admin\CategoryController::class)->middleware(['role:super-admin|admin']);
});
