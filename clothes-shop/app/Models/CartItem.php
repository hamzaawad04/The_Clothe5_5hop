<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected $primaryKey = 'cart_item_id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'cart_id',
        'variant_id', // stores product_id now
        'qty'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'variant_id', 'product_id');
    }
}
