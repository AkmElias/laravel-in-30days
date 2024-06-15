<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        //validation
        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //sign in
        if(!auth()->attempt(request(['email', 'password']))){
            return back()->withErrors([
                'message' => 'Bad credentials. Please try again'
            ]);
        }

        //redirect
        return redirect('/jobs');
    }
}
