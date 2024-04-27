<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //input fields of book table
    protected $fillable = ['title', 'author', 'price', 'stock', 'book_category_id'];

    public function category(){
        return $this -> belongsTo(BookCate::class, 'book_category_id');
    }
}

