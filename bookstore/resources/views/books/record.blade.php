@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Route::is('books.issue'))
            <h1>Issue</h1>
            <form action="{{ route('books.issueBook') }}" method="POST">
        @elseif (Route::is('books.return'))
            <h1>Return</h1>
            <form action="{{ route('books.returnBook') }}" method="POST">
        @endif
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="text" name="user_id" class="form-control" required/>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
