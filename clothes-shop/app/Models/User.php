<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }

    /* Define relationship between users and their cart */
    public function carts() {
        return $this->hasMany(Cart::class, 'user_id', 'user_id');
    }

    /* Define relationship between users and their orders */
    public function orders() {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }

    /* Define relationship between users and their wishlist */
    public function wishlist() {
        return $this->hasMany(Wishlist::class, 'user_id', 'user_id');
    }

    /* Define relationship between users and their contact messages */
    public function contactMessages() {
        return $this->hasMany(ContactMessage::class, 'user_id', 'user_id');
    }
}
