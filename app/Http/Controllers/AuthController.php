<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use App\Models\User;
use App\Models\OtpVerification;
use App\Mail\AccountVerifiedMail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister(){
        return view('auth.register');
    }
    public function register(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => 2,
            'password' => bcrypt($validatedData['password']),
        ]);

        // Send OTP to the user's email
        $otp = rand(100000, 900000); // Generate a random 6-digit OTP
        OtpVerification::create([
            'user_id' => $user->id,
            'otp_code' => $otp,
            'expires_at' => now()->addMinutes(10), // OTP expires in 10 minutes
        ]);

        Mail::to($user->email)->send(new SendOtpMail($otp));

        return redirect()->route('verify-otp.submit')
        ->with([
        'success' => 'Registration successful! Please check your email for the OTP to verify your account.',
        'email' => $user->email
        ]);
    }

    public function showVerifyOtp(Request $request)
    {
        $email = $request->session()->get('email');
        return view('auth.verify-otp', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
            'otp' => 'required|string|max:6',
        ]);

        // Find the user by email
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // Check if the OTP is valid and not expired
        $otpVerification = OtpVerification::where('user_id', $user->id)
            ->where('otp_code', $validatedData['otp'])
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpVerification || $otpVerification->otp_code !== $validatedData['otp']) {
            return response()->json(['message' => 'Invalid or expired OTP.'], 422);
        }

        if (Carbon::now()->gt(Carbon::parse($otpVerification->expires_at))) {
            return response()->json(['message' => 'OTP has expired.'], 422);
        }

        // Mark the user as verified
        $user->is_verified = true;
        $user->save();

        // Delete the OTP verification record
        $otpVerification->delete();

        // Send account verified email
        Mail::to($user->email)->send(new AccountVerifiedMail());

        Auth::login($user);


        return response()->json([
            'message' => 'Account verified successfully.',
            'user' => $user,
        ]);
    }
}
