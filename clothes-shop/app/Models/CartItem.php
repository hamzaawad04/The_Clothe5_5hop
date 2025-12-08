<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';
    public $timestamps = false;
    protected $primaryKey = 'cart_item_id'; // no single primary key

    protected $fillable = [
        'cart_id',
        'variant_id',
        'qty'
    ];

    public function cart() {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    public function variant() {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'variant_id');
    }
}
