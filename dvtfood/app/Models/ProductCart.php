<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    use HasFactory;
    protected $table = "product_cart";
    protected $fillable = [
        "product_id",
        "cart_token"
    ];

    protected $casts = [
        'create_at' => 'datetime',
    ];
}
