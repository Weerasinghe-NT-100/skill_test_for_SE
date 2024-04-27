<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookCate;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    //Displaying all the books that are available in the book store
    public function index(){
        $books = Book::with('category')->get();
        $categories = BookCate::all();
        return view('books.index', compact('books', 'categories'));
    }

    //Filter books by their book category
    public function filter(Request $request){
        $categories = BookCate::all();
        $booksQuery = Book::with('category');

        if($request -> has('category')){
            $categoryFilter = $request->input('category');
            $booksQuery->whereHas('category', function($query) use ($categoryFilter) {
                $query->where('id', $categoryFilter);
            });
        }

        $books = $booksQuery->get();
        return view('books.index', compact('books', 'categories'));
    }

    //Get book categories in the "Add a book" page
    public function create(){
        $categories = BookCate::all();
        return view('books.create', compact('categories'));
    }

    //Store book details with a book category
    public function store(Request $request){
        $request -> validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'book_category_id' => 'required|exists:book_cates,id'
        ]);

        Book::create($request -> all());

        return redirect() -> route('books.index') -> with('success', 'Book Added Successfully');
    }

    //display exsisting book details of selected book for editing
    public function edit(Book $book){
        $categories = BookCate::all();
        return view('books.edit', compact('book', 'categories'));
    }

    //Update a selected book details
    public function update(Request $request, $id){
        $request -> validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'book_category_id' => 'required|exists:book_cates,id' 
        ]);

        $book = Book::findOrFail($id);
        $book -> update($request -> all());

        return redirect() -> route('books.index') -> with('success', 'Book updated successfully');
    }

    //Delete a selected book 
    public function delete(Book $book){
        $book -> delete();
        return redirect() -> route('books.index') -> with('success', 'Book deleted successfully');
    }

    //Issue a book 
    public function borrowBook(Request $request, $id)
    {
        //When a book is issued, decrease stock count of relevent book
        $book = Book::findOrFail($id);
        $book->decrement('stock');

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:book,id',
        ]);

        $requestData = $request->all();
        $requestData['borrowed_at'] = now();
        $requestData = $request->except('_token');

        DB::table('books_by_users')->insert($requestData);

        //return redirect()->route('books.index')->with('success', 'Book issued successfully');
    }

    //Returning a book
    public function returnBook(Request $request, $id)
    {
        //When a book is returned, increase stock count of relevent book
        $book = Book::findOrFail($id);
        $book->increment('stock');

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:book,id',
        ]);

        $requestData = $request->except('_token');

        $requestData['returned_at'] = now();

        DB::table('books_by_users') -> where($request -> book_id) -> update($requestData);

        return redirect()->route('books.index')->with('success', 'Book returned successfully');
    }
    
}
