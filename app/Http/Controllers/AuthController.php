<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['signin']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param \Illuminate\Http\JsonResponse $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|ends_with_tld',
            'password' => 'required',
        ],
            [
                'email.required' => 'Enter Email Address',
                'email.email' => 'Invalid Email Address',
                'email.ends_with_tld' => 'Invalid Email Address',
            ]);

        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param \Illuminate\Http\JsonResponse $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     * @param \Illuminate\Http\JsonResponse $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ], 200);
    }
}
