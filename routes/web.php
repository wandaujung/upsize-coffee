<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\RoomController;


Route::get('/', function () {
    return view('pages.home');
});


Route::get('/menu', [MenuController::class, 'index'])
    ->name('menu');


Route::get('/ruangan', [RoomController::class, 'index'])
    ->name('rooms');


Route::post('/cart/{product}', [CartController::class, 'store'])
    ->middleware('auth')
    ->name('cart.store');


Route::get('/cart', [CartController::class, 'index'])
    ->middleware('auth')
    ->name('cart.index');


Route::patch('/cart/{cart}', [CartController::class, 'update'])
    ->middleware('auth')
    ->name('cart.update');


Route::delete('/cart/{cart}', [CartController::class, 'destroy'])
    ->middleware('auth')
    ->name('cart.destroy');


Route::get('/dashboard', function () {
    return view('dashboard');
})
->middleware(['auth', 'verified'])
->name('dashboard');


Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');


Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('/admin/products', ProductController::class);

    Route::resource('/admin/bookings', AdminBookingController::class);

    Route::resource('/admin/orders', AdminOrderController::class);

});


Route::get('/booking', [BookingController::class, 'create'])
    ->middleware('auth')
    ->name('booking.create');


Route::post('/booking', [BookingController::class, 'store'])
    ->middleware('auth')
    ->name('booking.store');


Route::get('/checkout', [OrderController::class, 'checkout'])
    ->middleware('auth')
    ->name('checkout');


Route::post('/checkout', [OrderController::class, 'store'])
    ->middleware('auth')
    ->name('checkout.store');


Route::get('/orders', [MyOrderController::class, 'index'])
    ->middleware('auth')
    ->name('orders');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');


    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');


    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


require __DIR__.'/auth.php';