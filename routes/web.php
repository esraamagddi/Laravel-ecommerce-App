<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('redirect',[HomeController::class,'redirect']);


Route::controller(ProductController::class)->group(function () {
    Route::middleware(IsAdmin::class)->group(function(){

    Route::post('/products', 'store')->name('store');
    Route::get('/products/create', 'create')->name('create');
    Route::get('/products', 'allProducts')->name('allProducts');
    Route::get('/products/show/{id}', 'show')->name('show');
    Route::get('/products/edit/{id}', 'edit')->name('edit');
    Route::put('/products/{id}', 'update')->name('update');
    Route::delete('/products/{id}', 'delete')->name('delete');
});

});