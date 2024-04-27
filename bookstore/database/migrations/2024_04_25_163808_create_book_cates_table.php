<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookCatesTable extends Migration
{
    public function up(){
        Schema::create('book_cates', function (Blueprint $table) {
            $table -> id();
            $table -> string('name');
            $table -> timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('book_cates');
    }
}