<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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


Route::prefix('admin')->middleware(IsAdmin::class)->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::post('/products', 'store')->name('admin.products.store');
        Route::get('/products/create', 'create')->name('admin.products.create');
        Route::get('/products', 'allProducts')->name('admin.products.all');
        Route::get('/products/show/{id}', 'show')->name('admin.products.show');
        Route::get('/products/edit/{id}', 'edit')->name('admin.products.edit');
        Route::put('/products/{id}', 'update')->name('admin.products.update');
        Route::delete('/products/{id}', 'delete')->name('admin.products.delete');
    });
});


Route::get('change/{lang}',function($lang){
    if($lang=="ar"){
        session()->put('lang', 'ar');
    }else
    {
        session()->put('lang', 'en');
    }
    return redirect()->back();
})->middleware('ChangeLang');

Route::controller(UserController::class)->group(function () {
    // Route::middleware(IsAdmin::class)->group(function(){

    Route::post('/products', 'store')->name('store');
    Route::get('/products/create', 'create')->name('create');
    Route::get('/products', 'allProducts')->name('allProducts');
    Route::get('/products/show/{id}', 'show')->name('show');
    Route::get('/search', 'search')->name('search');
    Route::get('/products/edit/{id}', 'edit')->name('edit');
    Route::put('/products/{id}', 'update')->name('update');
    Route::delete('/products/{id}', 'delete')->name('delete');


// });

});