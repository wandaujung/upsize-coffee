<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})
->middleware(['auth', 'verified'])
->name('dashboard');



Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');


    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');


    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


require __DIR__.'/auth.php';