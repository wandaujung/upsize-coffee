<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProductController;



Route::get('/', function () {
    return view('pages.home');
});



Route::get('/menu', [MenuController::class, 'index'])
    ->name('menu');



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


});



Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');


    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');


    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


});



require __DIR__.'/auth.php';