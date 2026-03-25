<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\OrderStatus;

class Order extends Model
{
    
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'user_id',
        'status',
        'total_amount',
        'ship_name',
        'ship_address',
        'payment_method',
        'order_date'
    ];

    /**
    * Get the attributes that should be cast.
    *
    * @return array<string, string>
    */
    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class,
        ];
    }

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
