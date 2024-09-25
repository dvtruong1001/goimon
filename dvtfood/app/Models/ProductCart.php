<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "product_id",
        "cart_token",
        "product_count"
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
