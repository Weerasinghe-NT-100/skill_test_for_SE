<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    //input fields of book_cate table
    protected $fillable = [
        'name', 'email', 'address', 'phone_no',
    ];

    //input fields of hidden fields
    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}


