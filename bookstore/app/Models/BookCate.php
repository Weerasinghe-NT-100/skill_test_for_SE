<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCate extends Model
{
    use HasFactory;

    //input fields of book_cate table
    protected $fillable = ['name'];

    public function books(){
        return $this -> hasMany(Book::class, 'book_category_id');
    }
}