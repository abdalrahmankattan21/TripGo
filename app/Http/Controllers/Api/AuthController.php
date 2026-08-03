<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\users\LoginUserRequest;
use App\Http\Requests\users\RegisterUserRequest;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use App\Models\OtpVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\AccountVerifiedMail;



class AuthController extends Controller
{
    use ApiResponseTrait;

    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        $validated['is_admin'] = false;
        $user = User::create($validated);
        $token = JWTAuth::fromUser($user);

        $otp = rand(100000, 900000); // Generate a random 6-digit OTP

        OtpVerification::create([
            'user_id' => $user->id,
            'otp_code' => $otp,
            'expires_at' => now()->addMinutes(10), // OTP expires in 10 minutes
        ]);

        Mail::to($user->email)->send(new SendOtpMail($otp));

        return response()->json([
            'message' => 'Registration successful! Please check your email for the OTP to verify your account.',
            'user' => $user,
            'token' => $token,
        ]);
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
        $user->email_verified_at = now();
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

    public function login(LoginUserRequest $request)
    {
        $validated = $request->validated();
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return $this->error('Invalid credentials.', 401);
        }

        $user = auth()->user();

        return response()->json([
        'message' => 'User Login Successfully',
        'user' => $user,
        'token' => $token,
       ]);
    }

    public function logout()
    {
        auth()->logout();
        return $this->success('Successfully logged out.', null);
    }


      public function me()
    {
        $user = auth()->user();
        return $this->success( 'Authenticated user retrieved.', $user);
    }

}
