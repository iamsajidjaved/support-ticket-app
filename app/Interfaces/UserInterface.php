<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;

interface UserInterface
{
    /**
     * Register a new user
     *
     * @param App\Http\Requests\UserRequest $request
     */
    public function register(UserRequest $request);

    /**
     * Update user's first name and last name
     *
     * @param App\Http\Requests\UserRequest $request
     */
    public function update(UserRequest $request, $user);
}
