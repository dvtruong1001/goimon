<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    

    public function tryLogin(Request $request)
    {
        $this->validate($request, [
            "phone" => 'required|string|max:255',
            "password" => 'required|string|min:6',
        ]);
        $users = User::where("phone", "=", $request->phone);

        if ($users->count() <= 0) {
            return response()->json([
                "message" => "Số điện thoại chưa được đăng ký"
            ], 401);
        }

        $user = $users->first();

        if (md5(trim($request->password)) !== trim($user->password)) {
            return response()->json([
                "message" => "Mật khẩu không chính xác"
            ], 401);
        }

        return response()->json([
            "message" => "Đăng nhập thành công",
            "token" => $user->token
        ], 200);
    }
}
