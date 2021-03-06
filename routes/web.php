<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\addToCart;


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

Route::get('/', App\Http\Controllers\User\WelcomeController::class)->name('default');;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('/products', \App\Http\Controllers\User\ProductsController::class )
->only('index', 'show')->names('user.products');


Route::resource('/cart', \App\Http\Controllers\User\CartController::class )
->only('index')->names('user.cart');

Route::post('/addToCart/{product}',[ \App\Http\Controllers\User\CartController::class, 'addToCart'])
    ->name('addToCart');
Route::post('/removeFromCart/{product}',[ \App\Http\Controllers\User\CartController::class, 'removeFromCart'])
    ->name('removeFromCart');

Route::resource('/orders', App\Http\Controllers\User\OrderController::class )
    ->only('show', 'create', 'store')
    ->names('user.orders');

Route::get('/orders', [App\Http\Controllers\User\OrderController::class, 'index'])
    ->middleware(['auth'])->name('user.orders.index');

