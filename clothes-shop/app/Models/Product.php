<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'description',
        'base_price',
        'category_id'
    ];

    /* Define relationship between products and their categories */
    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    /* Define relationship between products and order items */
    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'product_id', 'product_id');
    }

    /* Define relationship between products and their images */
    public function images() {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }

    /* Define relationship between products and their variants (size, color etc.) */
    public function variants() {
        return $this->hasMany(ProductVariant::class, 'product_id', 'product_id');
    }

    /* Define relationship between products and wishlists */
    public function wishlist() {
        return $this->hasMany(Wishlist::class, 'product_id', 'product_id');
    }

    /* Define relationship between products and reviews */
    public function reviews() {
        return $this->hasMany(Review::class, 'product_id', 'product_id');
    }
}