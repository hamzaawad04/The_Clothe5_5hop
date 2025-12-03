<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\EloquentCompositeKey\HasCompositePrimaryKey;

class CartItem extends Model
{
    /* Allows Model to have a composite key */
    use HasCompositePrimaryKey;

    protected $primaryKey = ['cart_id', 'variant_id'];
    /* Set attribute 'incrementing' to false so laravel knows the primary composite key doesn't increment */
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
