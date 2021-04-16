<?php

namespace App\Interfaces;

use App\Http\Requests\TicketRequest;
use App\Models\User;

interface TicketInterface
{
    /**
     * Register a new user
     *
     * @param App\Http\Requests\TicketRequest $request
     */
    public function store(TicketRequest $request);

    /**
     * Update user's first name and last name
     *
     * @param App\Models\User $user
     */
    public function list(User $user);
}
