<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';
<<<<<<< Updated upstream
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null; // no single primary key
=======
    protected $primaryKey = 'cart_item_id';
    public $timestamps = true;
>>>>>>> Stashed changes

    protected $fillable = [
        'cart_id',
        'variant_id',
        'qty'
    ];

    public function cart() {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

<<<<<<< Updated upstream
    public function variant() {
=======
    public function variant()
    {
>>>>>>> Stashed changes
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'variant_id');
    }
}
