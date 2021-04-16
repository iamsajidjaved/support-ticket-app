<?php

namespace App\Interfaces;

use App\Http\Requests\AuthRequest;
use App\Models\User;

interface AuthInterface
{
    /**
     * Login user
     *
     * @param App\Http\Requests\AuthRequest $request
     */
    public function login(AuthRequest $request);
}
