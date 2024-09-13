<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoppingCartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("/", [HomeController::class, "index"])->middleware('auth.cookie');
Route::get("/home", [HomeController::class, "index"])->middleware('auth.cookie')->name("home");


Route::get("/shopping-cart", [ShoppingCartController::class, "index"])->middleware('auth.cookie')->name('shopping-cart');

Route::get("/login", function(){
    return view("login");
})->name("login");