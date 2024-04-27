@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Book</h1>
        <form action="{{route('books.update', $book -> id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{$book -> title}}" required/>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" name="author" class="form-control" value="{{$book -> author}}" required/>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" name="price" class="form-control" value="{{$book -> price}}" step="0.01" required/>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="text" name="stock" class="form-control" value="{{$book -> stock}}" required/>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="book_category_id" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{$category -> id}}" {{$book -> book_category_id == $category->id ? 'selected':''}}>{{$category -> name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Book</button>
        </form>
    </div>
@endsection