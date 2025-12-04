<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{

    protected $primaryKey = 'cart_id';
    
    public $incrementing = false;

    protected $fillable = [
        'cart_id',
        'variant_id',
        'qty'
    ];

    /* Define relationship between cart items and carts */
    public function cart() {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    /* Define relationship between cart items and variants */
    public function variant() {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'variant_id');
    }
}
