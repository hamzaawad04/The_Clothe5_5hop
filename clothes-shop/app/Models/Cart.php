<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = 'cart_id';
    /* Set attribute 'timestamps' to false so laravel knows no relevant columns exist */
    public $timestamps = false;

    /* The attributes that can be changed */
    protected $fillable = [
        'user_id',
        'session_token'
    ];

    /* Define relationship between carts and users */
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /* Define relationship between carts and items */
    public function items() {
        return $this->hasMany(CartItem::class, 'cart_id', 'cart_id');
    }
}
