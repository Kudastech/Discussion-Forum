<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register()
    {

        return view('auth.register');
    }


    public function store()
    {
        $validate = request()->validate([

            'name' => 'required|min:3|max:40',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|confirmed|min:8'
        ]);

        $user = User::create([

            'name' => $validate['name'],

            'email' => $validate['email'],

            'password' => Hash::make($validate['password'])
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));

        return redirect()->route('dashboard')->with('success', 'Account Created Successfully');
    }



    public function login()
    {

        return view('auth.login');

    }


    public function authenticate()
    {
        $validate = request()->validate([

            'email' => 'required|email|',

            'password' => 'required|min:8'
        ]);

        if (auth()->attempt($validate)) {

            request()->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Logged in successfully!');

        } else {

            return redirect()->route('login')->withErrors([

                'email' => 'No matching user found with the provided email and password',

            ]);
        }
    }



    public function logout()
    {
        auth()->logout();

        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', 'Logout Successfully');
    }
}
