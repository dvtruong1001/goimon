<?php

namespace App\Http\Controllers;
use App\Models\ShoppingCart;
use App\Models\ProductCart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
class ShoppingCartController extends Controller
{
    //
    public function index(Request $request)
    {
        $shopping_carts = ShoppingCart::where("owner", "=", "haha")->orderByDesc("id")->limit(5)->get();
        $product_carts = ProductCart::all();
        $products = [];
        foreach ($shopping_carts as $cart) {
            $products[$cart->token] = [];
        }
        foreach ($product_carts as $product) {

            $products[$product->cart_token][] = array(
                "linker" => Product::where("id", "=", $product->product_id)->get()->first(),
                "product" => $product
            );
        }


        return view("cart", [
            "shoppingcarts" => $shopping_carts,
            "products" => $products,
            "authenticatedUser" => $request->attributes->get("authenticatedUser")
        ]);
    }



    public function addToCart(Request $request)
    {

        // $this->validate($request, [
        //     "token" => 'required|string|max:255',
        //     "product" => 'required|integer|min:1',
        // ]);

        $users = User::where("token", "=", $request->user_token);
        if ($users->count() <= 0) {
            return response()->json(["message" => "Token không hợp lệ"], 401);
        }

        $product = Product::where("id", "=", $request->product_id);
        if ($product->count() <= 0) {
            return response()->json(["message" => "Sản phẩm này không tồn tại hoặc đã được gỡ xuống"], 401);
        }

        $shoppingCart = ShoppingCart::where("status", '=', 0)->first();
        if (!$shoppingCart) {
            $shoppingCartToken = Str::random(20);

            ShoppingCart::insert([
                "token" => $shoppingCartToken,
                "status" => 0,
                "owner" => $users->first()->token
            ]);

            ProductCart::insert([
                "product_id" => $request->product_id,
                "cart_token" => $shoppingCartToken
            ]);

            return response()->json([
                "message" => "Thêm sản phẩm vào giỏ hàng thành công",
                "cart_token" => $shoppingCartToken
            ], 200);

        } else {
            $pr_cart = ProductCart::where("product_id", "=", $request->product_id)->where("cart_token", "=", $shoppingCart->token)->first();
            if ($pr_cart) {

                $pr_cart->product_count++;

                $pr_cart->save();

            } else {
                ProductCart::insert([
                    "product_id" => $request->product_id,
                    "cart_token" => $shoppingCart->token
                ]);
            }


            return response()->json([
                "message" => "Thêm sản phẩm vào giỏ hàng thành công",
                "cart_token" => $shoppingCart->token
            ], 200);

        }

        return response()->json(["message" => "Lỗi yêu cầu"], 401);
    }

    public function updateProductCart(Request $request)
    {
        $users = User::where("token", "=", $request->user_token);
        if ($users->count() <= 0) {
            return response()->json(["message" => "Token không hợp lệ"], 401);
        }


        $product = ProductCart::where("id", "=", $request->product_id)->first();
        if ($product->count() <= 0) {
            return response()->json(["message" => "Sản phẩm này không tồn tại hoặc đã được gỡ xuống"], 401);
        }


        $shoppingCart = ShoppingCart::where("token", "=", $product->cart_token)->first();
        if ($shoppingCart->status == 1) {
            return response()->json([
                "message" => "Đơn hàng này đã thanh toán nên không thể sửa"
            ], 400);
        }
        if ($request->new_count <= 0) {
            return response()->json([
                "message" => "Tối thiểu là 1 sản phẩm"
            ], 400);
        }


        if ($request->new_count > 100) {
            return response()->json([
                "message" => "Tối đa là 100 sản phẩm"
            ], 400);
        }

        $product->product_count = $request->new_count;
        $product->save();

        $product_cart = ProductCart::where('cart_token', "=", $product->cart_token)->get();

        $price_final = 0;

        foreach ($product_cart as $item) {
            $product = Product::where("id", "=", $item->product_id)->first();
            $price_final += $product->price * $item->product_count;
        }


        return response()->json([
            "message" => "Đã chỉnh sửa số lượng sản phẩm",
            "price_final" => $price_final
        ], 200);

    }
}
