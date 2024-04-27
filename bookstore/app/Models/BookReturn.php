<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookReturn extends Model
{
    
    protected $fillable = ['user_id', 'book_id', 'returned_at'];
}
