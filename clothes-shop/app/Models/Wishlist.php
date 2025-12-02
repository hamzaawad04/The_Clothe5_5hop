<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{

    protected $fillable = [
        'user_id',
        'product_id',
        'variant_id',
        'note'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function variant() {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'variant_id');
    }
}
