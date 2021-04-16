<?php

namespace App\Repositories;

use App\Http\Requests\TicketRequest;
use App\Interfaces\TicketInterface;
use App\Models\Ticket;
use App\Models\User;
use App\Traits\ResponseAPI;

class TicketRepostitory implements TicketInterface
{
    use ResponseAPI;

    /**
     * Implement the register method of TicketInterface
     *
     *  @param App\Http\Requests\TicketRequest $request
     */
    public function store(TicketRequest $request)
    {
        try {
            $ticket = Ticket::create([
                'user_id' => auth()->user()->id,
                'message' => $request->message,
            ]);
            return $this->success("Ticket created", 201);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Implement the update method of TicketInterface
     *
     *@param App\Models\User $user
     */
    function list(User $user) {
        if ($user->role == "admin") {
            $tickets = Ticket::paginate(10);
            return $this->success("Ticket created", $tickets, 200);
        } else {
            return $this->error("Permission Denied", 403);
        }
    }
}
