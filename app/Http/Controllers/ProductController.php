<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function edit($id)
    {
        $product=Product::findOrFail($id);
        $categories=Category::all();
        return view("Admin.edit",compact("product","categories"));
    }

    public function update(Request $request,$id){
        //validation
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'required|string',
            'price'=>'required|numeric',
            'category_id'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048',
            "quantity"=>'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product=Product::findOrFail($id);
        if($request->has('image'))
        {

                Storage::delete('public/storage/' . $product->image);
                $data['image'] = $request->file('image')->store('products', 'public');
        }

        //update
        $product->update($data);
        //redirect

        return redirect(url("products/show/$id"))->with("success","data updated successfully");

    }

    public function delete($id){
        $product=Product::findOrFail($id);
        Storage::delete('public/storage/' . $product->image);
        $product->delete();
        $products=Product::all();
        return redirect('products')->with("success","product deleted successfully");

    }
}
