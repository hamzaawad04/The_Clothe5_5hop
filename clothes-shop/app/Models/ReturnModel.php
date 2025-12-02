<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnModel extends Model
{
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'order_id',
        'status',
        'reason_text'
    ];

    /* Define relationship between returns and orders */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
