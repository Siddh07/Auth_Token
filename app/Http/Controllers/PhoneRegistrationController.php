<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\PhoneRegistration;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PhoneRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $phone = $request->input('phone');
    
        // Check if a record with the same phone number already exists
        $existingRegistration = PhoneRegistration::where('phone', $phone)->first();
    
        if ($existingRegistration) {
            // Handle the case when the phone number already exists
            // You can redirect back with an error message or perform any other action
            return redirect()->back()->with('error', 'Phone number already registered.');
        }
    
        // Create a new phone registration
        $phoneRegistration = new PhoneRegistration();
        $phoneRegistration->phone = $phone;
        $phoneRegistration->token = mt_rand(1000, 9999); // Generate a random integer token
        $phoneRegistration->token_expires_at = Carbon::now()->addSeconds(20); // Set token expiration time to 30 seconds
        $phoneRegistration->save();
    
        // Redirect to the verification page with the phone number
        return view('verify')->with('phone', $phone);
    }
    public function verifyToken(Request $request)
    {
        $token = $request->input('token');
        $phone = $request->input('phone');
    
        // Retrieve the phone registration from the database
        $phoneRegistration = PhoneRegistration::where('phone', $phone)
            ->where('token', $token)
            ->first();
    
        if ($phoneRegistration) {
            // Check if the token has expired
            if ($phoneRegistration->token_expires_at >= Carbon::now()) {
                // Token has expired, redirect to registration page
                return redirect()->route('register')->with(['phone' => $phone]);
            }
            // Valid token and phone number
            // You can perform any additional actions here, such as updating the registration status
    
            // Redirect to the registration page
            return redirect()->route('Register')->with(['phone' => $phone]);

           


            
        } else {
            // Invalid token or phone number
            return redirect()->back()->with('error', 'Invalid token or phone number. Please try again.');
        }
    }   


    public function regenerateToken(Request $request, $phone)
    {
        // Retrieve the phone registration from the database
        $phoneRegistration = PhoneRegistration::where('phone', $phone)->first();
    
        if ($phoneRegistration) {
            // Generate a new token
            $newToken = mt_rand(1000, 9999);
    
            // Update the existing token column with the new token value
            $phoneRegistration->token = $newToken;

            
            $phoneRegistration->save();
    
            // Redirect to the verify page with the updated phone number
            return redirect()->route('verify.form', ['phone' => $phone]);
        } else {
            // Phone registration not found
            return redirect()->back()->with('error', 'Phone registration not found. Please try again.');
        }
    }
    
    public function showRegenerateForm()
    {
        $phone = session('phone'); // Retrieve the phone number from the session
        return view('regenerate', compact('phone'));
       
    }


    public function showVerifyForm($phone)
    {
        return view('verify')->with('phone', $phone);
    }
    

}