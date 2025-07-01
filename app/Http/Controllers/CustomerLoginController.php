<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    public function customerLoginForm()
    {
        return view('auth.customerLogin'); // create this Blade view
    }

    public function customerLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if email is verified
            if (is_null($user->email_verified_at)) {
                Auth::logout();
                return back()->withErrors(['email' => 'Please verify your email before logging in.']);
            }

            // Check if role is customer
            if ($user->role !== 'customer') {
                Auth::logout();
                return back()->withErrors(['email' => 'You are not allowed to login from here.']);
            }

            return redirect('/dashboard'); // Change as needed
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}
