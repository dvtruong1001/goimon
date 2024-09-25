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

Route::get('/cart/removeproduct', [ShoppingCartController::class, "removeProduct"])->name("removeproduct");
Route::get('/cart/confirmcart', [ShoppingCartController::class, "confirmCart"])->name("confirmcart");

Route::get('/cart/checkpaycart', [ShoppingCartController::class, "checkPayCart"])->name("checkpaycart");


Route::get('/cart/removecart', [ShoppingCartController::class, "removeCart"])->name("removecart");



Route::post("/auth/login", [UserController::class, "tryLogin"])->name('apilogin');
