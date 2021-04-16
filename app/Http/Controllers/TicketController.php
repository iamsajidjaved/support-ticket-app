<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Interfaces\TicketInterface;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    protected $ticketInterface;

    /**
     * Create a new TicketController instance.
     *
     * @return void
     */
    public function __construct(TicketInterface $ticketInterface)
    {
        $this->middleware('auth:api', ['except' => []]);
        $this->ticketInterface = $ticketInterface;
    }

    /**
     * Store a new ticket
     *
     * @method  POST api/v1/support/tickets
     * @access  public
     *
     * @param App\Http\Requests\TicketRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TicketRequest $request)
    {
        return $this->ticketInterface->store($request);
    }

    /**
     * List all tickets
     *
     * @method  GET api/v1/support/tickets
     * @access  public
     *
     * @param App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    function list() {
        return $this->ticketInterface->list(auth()->user());
    }

}
