<?php

namespace App\Models;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'description',
        'base_price',
        'low_stock_threshold',
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

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class, 'product_id')->where('is_primary', 1);
    }

    public function otherImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->where('is_primary', 0);
    }
}