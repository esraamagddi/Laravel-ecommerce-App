<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categoryId=$product->category_id;
        $category=Category::findOrFail($categoryId);

        return view("User.show",compact("product","category"));
    }

    public function search(Request $request)

    {
        $request->validate([
            'query' => 'nullable|string|max:255',
        ]);

        $query = (string) $request->input('query', '');

        $products = Product::where('name', 'like', "%$query%")->get();

        return view('User.home', compact('products', 'query'));

    }
}
