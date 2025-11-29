<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'status',
        'total_amount',
        'ship_name',
        'ship_address',
        'payment_method',
        'order_date'
    ];

    /* Define relationship between orders and users */
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /* Define relationship between orders and items */
    public function items() {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    /* Define relationship between orders and returns */
    public function return() {
        return $this->hasOne(ReturnModel::class, 'order_id', 'order_id');
    }
}
