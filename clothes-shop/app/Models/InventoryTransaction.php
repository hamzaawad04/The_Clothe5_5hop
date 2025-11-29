<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    protected $primaryKey = 'transaction_id';
    public $timestamps = false;

    protected $fillable = [
        'variant_id',
        'change_qty',
        'reason'
    ];

    /* Define relationship between inventory transactions and product variants */
    public function variant() {
        return $this->belongsTo(ProductVariant::class, 'variant_id', 'variant_id');
    }
}
