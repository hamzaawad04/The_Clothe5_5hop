<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\EloquentCompositeKey\HasCompositePrimaryKey;

class OrderItem extends Model
{
    use HasCompositePrimaryKey;

    protected $primaryKey = ['order_id', 'product_id', 'variant_id'];
    public $incrementing = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'unit_price',
        'qty',
        'line_total'
    ];

    /* Define relationship between order items and orders */
    public function order() {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    /* Define relationship between order items and products */
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    /* Define relationship between order items and product variants */
    public function variant() {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'variant_id');
    }
}
