<?php

namespace App\Repositories;

use App\Http\Requests\TicketRequest;
use App\Interfaces\TicketInterface;
use App\Models\Ticket;
use App\Models\User;
use App\Traits\ResponseAPI;

class TicketRepository implements TicketInterface
{
    use ResponseAPI;

    /**
     * Implement the store method of TicketInterface
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
            return $this->success("Ticket created", $ticket, 201);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Implement the list method of TicketInterface
     *
     *@param App\Models\User $user
     */
    function list(User $user) {
        if ($user->role == "admin") {
            $tickets = Ticket::paginate(10);
            return $this->success("All Tickets", $tickets, 200);
        } else {
            return $this->error("Permission Denied", 403);
        }
    }
}
