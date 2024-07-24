<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    //
    public function create()
    {
        $categories=Category::all();
        return view("Admin.create",compact("categories"));
    }

    public function show($id)
    {
        $product=Product::findOrFail($id);
        return view("Admin.show",compact("product"));
    }

    public function store(Request $request){
        //validation
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'required|string',
            'price'=>'required|numeric',
            'category_id'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
            "quantity"=>'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        //store
        $data['image'] = $request->file('image')->store('products', 'public');

        //create
        Product::create($data);
        //redirect

        return redirect(url('products/create'))->with("success","data inserted successfully");

        // echo "hi im store";
    }

    public function allProducts() {
        $products=Product::all();
        return view("Admin.allproducts",compact("products"));
    }
}
