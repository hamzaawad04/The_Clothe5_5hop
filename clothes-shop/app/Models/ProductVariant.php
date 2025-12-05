<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $primaryKey = 'product_variant_id';

    protected $fillable = [
        'product_id',
        'size',
        'colour',
        'stock_qty',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'variant_id', 'variant_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'variant_id', 'variant_id');
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class, 'variant_id', 'variant_id');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'variant_id', 'variant_id');
    }
}
