<?php

namespace App\Repositories;

use App\Http\Requests\AuthRequest;
use App\Interfaces\AuthInterface;
use App\Traits\ResponseAPI;


class AuthRepository implements AuthInterface
{
    use ResponseAPI;

    /**
     * Implement the login method of AuthInterface
     *
     *  @param App\Http\Requests\AuthRequest $request
     */
    public function login(AuthRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return $this->error("Unauthorized", 401);
        } else {
            $tokenInfo = $this->respondWithToken($token);
            return $this->success("Successfully logged-in", $tokenInfo, 200);
        }
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
