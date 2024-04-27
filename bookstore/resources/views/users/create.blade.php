@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add new User</h1>
        <form action="{{route('users.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required/>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" class="form-control" required/>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" required/>
            </div>
            <div class="mb-3">
                <label for="phone_no" class="form-label">Phone No</label>
                <input type="text" name="phone_no" class="form-control" required/>
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>
@endsection