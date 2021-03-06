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

    /**
     * PRODUCTS
     */
    Route::resource('products', Admin\ProductController::class);

    /**
     * PARTNERS
     */
    Route::resource('partners', Admin\PartnerController::class);

    /**
     * PRODUCT ENTER
     */
    Route::prefix('product-enter')->group(function () {
        Route::get('', [Admin\ProductEnterController::class, 'index'])->name('product-enter.index');
        Route::get('/create', [Admin\ProductEnterController::class, 'create'])->name('product-enter.create');
        Route::post('/store', [Admin\ProductEnterController::class, 'store'])->name('product-enter.store');
        Route::get('/{id}/edit', [Admin\ProductEnterController::class, 'edit'])->name('product-enter.edit');
        Route::put('/{id}/update', [Admin\ProductEnterController::class, 'update'])->name('product-enter.update');
    });

    /**
     * PRODUCT ENTER DETAIL
     */
    Route::prefix('product-enter-detail')->group(function () {
        Route::delete('/delete', [Admin\ProductEnterDetailController::class, 'destroy'])->name('product-enter-detail.destroy');
    });

    /**
     * PRODUCT EXIT
     */
    Route::prefix('product-exit')->group(function () {
        Route::get('', [Admin\ProductExitController::class, 'index'])->name('product-exit.index');
        Route::get('/create', [Admin\ProductExitController::class, 'create'])->name('product-exit.create');
        Route::post('/store', [Admin\ProductExitController::class, 'store'])->name('product-exit.store');
        Route::get('/{id}/edit', [Admin\ProductExitController::class, 'edit'])->name('product-exit.edit');
        Route::put('/{id}/edit', [Admin\ProductExitController::class, 'update'])->name('product-exit.update');
    });
    /**
     * PRODUCT ENTER DETAIL
     */
    Route::prefix('product-exit-detail')->group(function () {
        Route::delete('/delete', [Admin\ProductExitDetailController::class, 'destroy'])->name('product-exit-detail.destroy');
    });

});
