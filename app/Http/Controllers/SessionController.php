<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function destroy()
    {
        $username = auth()->user()->username;
        auth()->logout();

        return redirect('/')->with('success','Goodbye '.$username);
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {

        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!auth()->attempt($attributes)){
            throw ValidationException::withMessages([
                'email'=> 'vos credentials ne correspondent pas',
            ]);
        }
        // user is logged in
        session()->regenerate();
        $username = auth()->user()->username;
        return redirect('/')->with('success','welcome '.$username);



    }
}
