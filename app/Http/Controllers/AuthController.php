<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Interfaces\AuthInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authInterface;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(AuthInterface $authInterface)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->authInterface = $authInterface;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @method  POST api/v1/auth/login
     * @access  public
     *
     * @param App\Http\Requests\AuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthRequest $request)
    {
        return $this->authInterface->login($request);
    }

    /**
     * Log out the user (Invalidate the token).
     *
     * @method  GET api/v1/auth/logout
     * @access  public
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
