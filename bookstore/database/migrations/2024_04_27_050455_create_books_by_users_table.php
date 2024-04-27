<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksByUsersTable extends Migration
{
    public function up(){
        Schema::create('books_by_users', function (Blueprint $table) {
            $table -> id();
            $table -> unsignedBigInteger('user_id');
            $table -> unsignedBigInteger('book_id') -> unique();
            $table -> timestamp('borrowed_at') -> nullable();
            $table -> timestamp('returned_at') -> nullable();
            $table -> timestamps();

            $table -> foreign('user_id') -> references('id') -> on('users') -> onDelete('cascade');
            $table -> foreign('book_id') -> references('id') -> on('books') -> onDelete('cascade');
        });
    }

    public function down(){
        Schema::dropIfExists('books_by_users');
    }
}