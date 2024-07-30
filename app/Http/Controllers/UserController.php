<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function allProducts() {
        $products=Product::all();
        return view("User.home",compact("products"));
    }

    public function show($id)
    {
        $product=Product::findOrFail($id);
        return view("User.show",compact("product"));
    }
}
