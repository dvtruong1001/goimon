<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::all();

        return view("home", [
            "categories" => $categories,
            "products" => $products,
            "authenticatedUser" => $request->attributes->get('authenticatedUser')
        ]);
    }
}
