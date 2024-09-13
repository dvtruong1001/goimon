<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoppingCartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get("/cart/addtocart", [ShoppingCartController::class,"addToCart"])->name('addtocart');
Route::get('/cart/updateproduct', [ShoppingCartController::class, "updateProductCart"])->name("updateproduct");
Route::post("/auth/login", [UserController::class, "tryLogin"])->name('login');
