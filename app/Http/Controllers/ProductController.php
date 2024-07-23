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
        $data['image']=Storage::putFile("products",$data['image']);
        //create
        Product::create($data);
        //redirect

        return redirect(url('products/create'))->with("success","data inserted successfully");

        // echo "hi im store";
    }
}
