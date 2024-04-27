@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add new book</h1>
        <form action="{{route('books.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required/>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" name="author" class="form-control" required/>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" name="price" class="form-control" step="0.01" required/>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="text" name="stock" class="form-control" required/>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="book_category_id" class="form-select" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                       <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
    </div>
@endsection