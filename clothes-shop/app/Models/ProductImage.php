<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{

    protected $primaryKey = 'product_image_id';
    public $incrementing = false;

    protected $fillable = [
        'product_id',
        'url',
        'is_primary'
    ];

    /* Define relationship between product images and their products */
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
