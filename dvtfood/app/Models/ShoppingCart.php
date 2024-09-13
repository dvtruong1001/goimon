<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $table = "shopping_cart";
    protected $fillable = [
        "token",
        "status",
        "pay_at",
        "owner"
    ];

    protected $casts = [
        'create_at' => 'datetime',
    ];
}
