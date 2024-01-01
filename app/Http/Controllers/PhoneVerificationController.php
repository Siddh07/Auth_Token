<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhoneRegistration;
use Carbon\Carbon;

class PhoneVerificationController extends Controller
{
    public function showVerificationForm()
    {
        return view('verify');
    }
   public function verify(Request $request)
{
    $token = $request->input('token');
    $phone = $request->input('phone');

    $registration = PhoneRegistration::where('phone', $phone)
        ->where('token', $token)
        ->first();

    if ($registration) {
        if ($registration->token_expires_at < Carbon::now()) {
            // Token has expired, redirect to regenerate.blade.php
            return redirect()->route('regenerate')->with('phone', $phone);
        }

        // Valid token and phone number
        // You can perform any additional actions here, such as updating the registration status

        // Redirect to the registration page
        return redirect()->route('register')->with(['phone' => $phone]);
    } else {
        // Invalid token or phone number
        return redirect()->back()->with('error', 'Invalid token or phone number. Please try again.');
    }
}

    
}