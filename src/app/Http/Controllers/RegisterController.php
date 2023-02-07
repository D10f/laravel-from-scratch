<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Returns the register view
     */
    public function create()
    {
        return view('register.create');
    }

    /**
     * Registers a new user
     */
    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'username' => ['required', 'min:3', 'max:255'],
            'password' => ['required', 'min:6', 'max:255'],
            'email' => ['required', 'email', 'max:255']
        ]);

        // Option 1
        // $attributes['password'] = bcrypt($attributes['password']);

        // Option 2 - using mutators in the model

        User::create($attributes);

        return redirect('/');
    }
}
