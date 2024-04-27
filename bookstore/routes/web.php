<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

Route::resource('books', BookController::class);
Route::get('/', [BookController::class, 'index']) -> name('books.index');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books', [BookController::class, 'filter'])->name('books.filter');
Route::post('/books/{id}/borrow', [BookController::class, 'borrowBook'])->name('books.borrowBook');
Route::post('/books/{id}', [BookController::class, 'returnBook'])->name('books.returnBook');
Route::delete('/books/{book}', [BookController::class, 'delete'])->name('books.delete');
Route::get('/users', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

//Route::get('/', function () {
  //  return view('welcome');
//});
