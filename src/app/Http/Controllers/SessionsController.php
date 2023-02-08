<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'You are now logged out.');
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $credentials = request()->validate([
            // Optionally use Rule:exist
            'username' => ['required', 'min:3', 'max:255'],
            'password' => ['required', 'min:6', 'max:255']
        ]);

        // Attempt to login
        if (! auth()->attempt($credentials)) {
            // return back()
            //     ->withInput()
            //     ->withErrors(['username' => 'Invalid username or password']);

            throw ValidationException::withMessages([
                'username' => 'Invalid username or password'
            ]);
        }

        session()->regenerate();
        return redirect('/')->with('success', 'You are now logged in.');
    }
}
