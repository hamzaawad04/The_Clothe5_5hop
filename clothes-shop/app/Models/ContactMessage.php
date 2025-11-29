<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'message',
        'status'
    ];

    /* Define relationship between contact messages and users */
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
