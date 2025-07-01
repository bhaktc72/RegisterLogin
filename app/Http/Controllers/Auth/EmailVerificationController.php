<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function emailVerify($token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return response()->view('emails.verifiedEmail', ['status' => 'Invalid or expired verification link.'], 404);
        }

        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->save();

        return response()->view('emails.verifiedEmail', ['status' => 'Email verified successfully!']);
    }
}
