<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userInteface;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserInterface $userInterface)
    {
        $this->middleware('auth:api', ['except' => ['register']]);
        $this->userInterface = $userInterface;
    }

    /**
     * Register a new user
     *
     * @method  POST api/v1/user/user
     * @access  public
     * @param App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRequest $request)
    {
        return $this->userInterface->register($request);
    }

    /**
     * Update user's first name and last name
     *
     * @method  PUT api/v1/user/user
     * @access  public
     * @param App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request)
    {
        return $this->userInterface->update($request, auth()->user());
    }
}
