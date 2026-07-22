<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\users\LoginUserRequest;
use App\Http\Requests\users\RegisterUserRequest;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        $validated['is_admin'] = false;
        $user = User::create($validated);

        $token = JWTAuth::fromUser($user);
        return response()->json([
        'message' => 'User Registerd Successfully',
        'user' => $user,
        'token' => $token,
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
