<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\EloquentCompositeKey\HasCompositePrimaryKey;

class ProductImage extends Model
{
    use HasCompositePrimaryKey;

    protected $primaryKey = ['product_id', 'url'];
    public $incrementing = false;
    public $timestamps = false;

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
