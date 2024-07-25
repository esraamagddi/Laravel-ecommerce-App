<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request){
       $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'description'=>'required|string',
            'price'=>'required|numeric',
            'category_id'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            "quantity"=>'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        Product::create([
            "name"=>$request->name,
            "description"=>$request->description,
            "price"=>$request->price,
            "category_id"=>$request->category_id,
            "quantity"=>$request->quantity,
            "image"=>$request->file('image')->store('products', 'public')
        ]);
        return response()->json([
            "message" =>"Product added successfully"
        ],201);
      }

      public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'description'=>'required|string',
            'price'=>'required|numeric',
            'category_id'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048',
            "quantity"=>'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $product=Product::find($id);
        if ($product == null){
            return response()->json([
                "message" =>"Product not found"
            ],404);
        }

        $imageName=$request->image;//old name

        if($request->has('image'))
        {

                Storage::delete('public/storage/' . $imageName);
                $imageName = $request->file('image')->store('products', 'public'); //new name
            }

        $product->update([
            "name"=>$request->name,
            "description"=>$request->description,
            "price"=>$request->price,
            "category_id"=>$request->category_id,
            "quantity"=>$request->quantity,
            "image"=>$imageName
        ]);

        return response()->json([
            "message" =>"Product updated successfully",
            "products"=>new ProductResource($product)
        ],201);


      }
}
