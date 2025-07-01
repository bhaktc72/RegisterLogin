<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class RegisterController extends Controller
{
    public function adminRegisterForm()
    {
        return view('auth.register.admin');
    }

    public function customerRegisterForm()
    {
        return view('auth.register.customer');
    }

public function customerRegister(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ], [
        'password.min' => 'The password must be at least 8 characters long.',
        'password.confirmed' => 'The password confirmation does not match.',
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = 'customer';
    $user->password = Hash::make($request->password);
    $user->email_verification_token = Str::random(32);
    $user->save();

    $verificationUrl = route('email.verify', ['token' => $user->email_verification_token]);

    Mail::to($user->email)->send(new VerifyEmail($user, $verificationUrl));

    return redirect()->back()->with('success', 'Verification email sent. Please check your inbox.');
}

public function adminRegister(Request $request)
{

    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ], [
        'password.min' => 'The password must be at least 8 characters long.',
        'password.confirmed' => 'The password confirmation does not match.',
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->role = 'admin';
    $user->email_verification_token = Str::random(32);
    $user->save();

   
    $verificationUrl = route('email.verify', ['token' => $user->email_verification_token]);

    Mail::to($user->email)->send(new VerifyEmail($user, $verificationUrl));

    return redirect()->back()->with('success', 'Verification email sent. Please check your inbox.');
}



}
