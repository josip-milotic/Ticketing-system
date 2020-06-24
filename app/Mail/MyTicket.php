<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyTicket extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $client;
    public $ticket;
    public $state;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {

        $this->ticket = $request;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.myTicket');
    }
}
