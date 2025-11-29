<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $primaryKey = 'variant_id';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'size',
        'color',
        'stock_qty'
    ];

    /* Define relationship between product variants and the products */
    public function products() {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    /* Define relationship between products and order items */
    public function cartItems() {
        return $this->hasMany(CartItem::class, 'variant_id', 'variant_id');
    }

    /* Define relationship between product variants and orders */
    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'variant_id', 'variant_id');
    }

    /* Define relationship between product variants and inventory transactions */
    public function inventoryTransactions() {
        return $this->hasMany(InventoryTransaction::class, 'variant_id', 'variant_id');
    }

    /* Define relationship between product variants and wishlists */
    public function wishlist() {
        return $this->hasMany(Wishlist::class, 'variant_id', 'variant_id');
    }
}
