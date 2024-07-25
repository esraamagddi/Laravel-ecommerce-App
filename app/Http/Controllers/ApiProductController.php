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
        if ($products == null){
            return response()->json([
                "message" =>"Products not found"
            ],404);
        }
        return ProductResource::collection($products);
    }

    public function show($id){
        $products=Product::find($id);
        if ($products == null){
            return response()->json([
                "message" =>"Product not found"
            ],404);
        }
        return new ProductResource($products);
    }
}
