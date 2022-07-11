<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\OrderController;

Route::group(['middleware' => ['permission:admin_per']], function () {
    Route::resource('/products', ProductsController::class)
        ->names('admin.products');
});

Route::group(['middleware' => ['permission:admin_per']], function () {
    Route::resource('/orders', OrderController::class)
        ->names('admin.orders');
    Route::post('/orders/approve/{order}',[OrderController::class, 'approve'])->name('admin.orders.approve');
    Route::post('/orders/reject/{order}',[OrderController::class, 'reject'])->name('admin.orders.reject');
});

