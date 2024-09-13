<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class UserController extends Controller
{
    //
    public function addToCart(Request $request)
    {

        // $this->validate($request, [
        //     "token" => 'required|string|max:255',
        //     "product" => 'required|integer|min:1',
        // ]);

        $users = User::where("token", "=", $request->token);
        if ($users->count() <= 0) {
            return response()->json(["message" => "Token không hợp lệ"], 401);
        }

        $product = Product::where("id", "=", (int) $request->product);
        if ($product->count() <= 0) {
            return response()->json(["message" => "Sản phẩm này không tồn tại hoặc đã được gỡ xuống"]);
        }

        $shoppingCart = ShoppingCart::where("status", '=', 0);
        if ($shoppingCart->count() <= 0) {
            $shoppingCartToken = Str::random(20);
            ShoppingCart::insert([
                "token" => $shoppingCartToken,
                "status" => 0,
                "owner" => $users->first()->token
            ]);

            ProductCart::insert([
                "product_id" => $request->product,
                "cart_token" => $shoppingCartToken
            ]);

            return response()->json([
                "message" => "Thêm sản phẩm vào giỏ hàng thành công",
                "cart_token" => $shoppingCartToken
            ]);

        } else {
            ProductCart::insert([
                "product_id" => $request->product,
                "cart_token" => $shoppingCart->first()->token
            ]);

            return response()->json([
                "message" => "Thêm sản phẩm vào giỏ hàng thành công",
                "cart_token" => $shoppingCart->first()->token
            ]);

        }

        return response()->json(["message" => "Lỗi yêu cầu"], 401);
    }
}
