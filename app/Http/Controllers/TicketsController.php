<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\StoreTicketRequest;
use App\Notifications\TicketReassigned;
use Illuminate\Support\Facades\Notification;
use App\Mail\MyTicket;
use App\State;
use App\Ticket;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */
    public function index()
    {

        $states = State::all();
        $tickets = Ticket::latest('created_at')->paginate(10);

        return view('tickets.index', compact('tickets', 'states'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * return \Illuminate\Http\Response
     */
    public function create($client = null)
    {
        $states = State::all();

        if ($client != null) {
            $client = Client::findOrFail($client);
            return view('tickets.create', compact('states', 'client'));
        } else {
            $clients = Client::all();
            $client = null;
            return view('tickets.create', compact('states', 'clients', 'client'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * param  \Illuminate\Http\Request  $request
     * return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        Ticket::create([
            'title' => $request['title'],
            'body' => $request['body'],
            'state_id' => $request['state'],
            'client_id' => $request['client'],
            'user_id' => auth()->user()->id
        ]);

        $client = Client::where('id', '=', $request['client'])->pluck('email');

        Mail::to($client)->send(new MyTicket($request));

        return redirect(route('tickets.index'))->with('success', 'Ticket created!');
    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $ticket
     * return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Ticket $ticket
     * @return Response
     */
    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $states = State::all();
        $clients = Client::all();
        $users = User::all();
        return view('tickets.edit',compact('ticket','states','clients', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * param  \Illuminate\Http\Request  $request
     * param  \App\Ticket  $ticket
     * return \Illuminate\Http\Response
     */
    public function update(Ticket $ticket, StoreTicketRequest $request)
    {
        //$this->authorize('update-ticket', $ticket);
        $this->authorize('update', $ticket);

        if($ticket->user_id != $request['user']) {
            $user = User::find($request['user']);
            $user->notify(new TicketReassigned($ticket['id']));
        }
        
        Ticket::where('id', $ticket['id'])->update([
            'title' => $request['title'],
            'body' => $request['body'],
            'state_id' => $request['state'],
            'client_id' => $request['client'],
            'user_id' => $request['user']
        ]);

        return redirect(route('tickets.show', $ticket))->with('success', 'Ticket updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ticket $ticket
     * return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //$this->authorize('update-ticket', $ticket);
        $this->authorize('delete', $ticket);
        $ticket->delete();
        return redirect(route('tickets.index'))->with('success', 'Ticket deleted!');
    }
}
