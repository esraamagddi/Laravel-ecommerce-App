<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    //
    public function allProducts(){

        $products=Product::all();
        return ProductResource::collection($products);
    }
}
