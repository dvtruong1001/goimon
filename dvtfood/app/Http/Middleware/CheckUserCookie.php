<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class CheckUserCookie
{
    public function handle($request, Closure $next)
    {
        $userToken = $request->cookie('user_token');
        
        if ($userToken) {
            $user = DB::table('users')->where("token","=", $userToken)->first();
            if ($user) {
                $request->attributes->set('authenticatedUser', $user);
                return $next($request);
            }
        }
        return redirect()->route('login');
        
    }
}
