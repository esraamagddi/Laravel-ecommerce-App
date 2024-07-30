<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiProductController;
use App\Http\Middleware\ApiAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(ApiProductController::class)->group(function(){
    Route::middleware(ApiAuth::class)->group(function(){

    Route::get('products',  'allProducts');
    Route::get('products/{id}',  'show');
    Route::post('products',  'store');
    Route::put('products/{id}',  'update');
    Route::delete('products/{id}',  'delete');
    });
});

Route::controller(ApiAuthController::class)->group(function (){
    Route::post('login',  'login');
    Route::post('register',  'register');
    Route::post('logout',  'logout')->middleware(ApiAuth::class);

});
