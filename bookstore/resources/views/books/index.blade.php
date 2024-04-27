@extends('layouts.app')

@section('content')

<div class="container">
    <h1>All Books</h1>
    <div class="mb-3">
        <form action="{{route('books.filter')}}" method="GET" class="row g-3">
            <div class="col-auto">
                <select name="category" class="form-select">
                    <option value="">Filter by Category</option>
                    @foreach ($categories as $category)
                        <option value="{{$category -> id}}">{{$category -> name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div>
    <div class="mb-3" style="margin-left: 1000px;">
        <a href="{{route('books.create')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
            </svg>
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr style="font-weight: 600;">
                        <td>{{$book -> title}}</td>
                        <td>{{$book -> author}}</td>
                        <td>{{$book -> price}}</td>
                        <td>{{$book -> stock}}</td>
                        <td>{{$book -> category -> name}}</td>
                        <td>
                            <a href="#" onclick="openModal('{{ route('books.borrowBook', $book -> id) }}','{{$book -> id}}', 'Borrow Books')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" color="warning" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1z"/>
                                </svg>
                            </a>
                            <a href="#" onclick="openModal('{{ route('books.returnBook', $book -> id) }}', '{{$book -> id}}', 'Return Books')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="warning" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                                </svg>
                            </a>
                            <a href="{{route('books.edit', $book -> id)}}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('books.delete', $book->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookModalLabel">Book Information</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(url, id, title) {
        var modalTitle = document.getElementById('bookModalLabel');
        modalTitle.innerHTML = title;

        var modalBody = document.querySelector('.modal-body');
        modalBody.innerHTML = `
            <form id="bookForm" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="user_id" class="form-label">User ID</label>
                    <input type="text" name="user_id" class="form-control" required/>
                </div>
                <div class="mb-3">
                        <label for="book_id" class="form-label">Book ID</label>
                        <input type="text" id="book_id" class="form-control" required/>
                    </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        `;

        // Set the action of the form dynamically
        var form = document.getElementById('bookForm');
        form.action = url;

        var bookId = document.getElementById('book_id');
        bookId.name = id;
        bookId.value = id;

        $('#bookModal').modal('show');
    }
</script>
    
@endsection