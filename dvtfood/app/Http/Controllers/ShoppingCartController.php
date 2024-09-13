<?php

namespace App\Http\Controllers;
use App\Models\ShoppingCart;
use App\Models\ProductCart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ShoppingCartController extends Controller
{
    //
    public function index()
    {
        $shopping_carts = ShoppingCart::where("owner", "=", "haha")->limit(5)->get();
        $product_carts = ProductCart::all();
        $products = [];
        foreach ($product_carts as $product) {
            $products[] = Product::where("id", "=", $product->product_id)->get()->first();
        }


        return view("cart", ["shoppingcarts" => $shopping_carts, "products" => $products]);
    }
}
