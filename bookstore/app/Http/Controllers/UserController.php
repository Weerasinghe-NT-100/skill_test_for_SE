<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerification;

class UserController extends Controller
{
    //Displaying the "Add user page"
    public function create()
    {
        return view('users.create');
    }

    //Store user details in the users table in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'phone_no' => 'required|max:10',
        ]);

        $user = User::create($request -> all());

        //Send a mail to the user through provided email to verify email
        Mail::to($user->email)->send(new EmailVerification($user));

        return redirect()->route('books.index')->with('success', 'User registered successfully.');
    }
}
