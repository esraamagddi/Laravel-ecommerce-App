<?php

use App\Http\Controllers\ApiProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(ApiProductController::class)->group(function(){

    Route::get('products',  'allProducts');
    Route::get('products/{id}',  'show');
    Route::get('products',  'allProducts');
    Route::get('products',  'allProducts');

});
