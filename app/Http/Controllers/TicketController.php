<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Create a new TicketController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    /**
     * Store a new ticket
     *
     * @param \Illuminate\Http\JsonResponse $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|max:1000',
        ],
            [
                'message.required' => 'Enter Your Message',
                'message.max' => 'Maximum 1000 Characters',
            ]);

        $ticket = Ticket::create([
            'user_id' => auth()->user()->id,
            'message' => $request->message,
        ]);

        return response()->json(['ticket' => $ticket], 200);
    }

    /**
     * List all tickets
     *
     * @param \Illuminate\Http\JsonResponse $request
     * @return \Illuminate\Http\JsonResponse
     */
    function list(Request $request) {
        if (auth()->user()->role == "admin") {
            $tickets = Ticket::paginate(10);
            return response()->json(['tickets' => $tickets], 200);
        } else {
            return response()->json(['message' => "Permission Denied"], 403);
        }
    }

}
