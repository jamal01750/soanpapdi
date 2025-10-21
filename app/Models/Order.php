<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'address',
        'mobile_number',
        'cart_items',
        'delivery_option',
        'payment_method',
        'payment_details',
        'subtotal',
        'discount',
        'delivery_charge',
        'final_total',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'cart_items' => 'array', // Automatically cast the JSON string to an array and back
        'payment_details' => 'array',
    ];
}
