<?php

namespace App\Interfaces;

use App\Http\Requests\TicketRequest;
use App\Models\User;

interface TicketInterface
{
    /**
     * Create a new ticket
     *
     * @param App\Http\Requests\TicketRequest $request
     */
    public function store(TicketRequest $request);

    /**
     * List all tickets
     *
     * @param App\Models\User $user
     */
    public function list(User $user);
}
