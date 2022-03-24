<?php

namespace App\Listeners;

use App\Events\CreatedStudent;
use App\Mail\PasswordSet;
use Illuminate\Support\Facades\Mail;

class SendMailWithPassword
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CreatedStudent  $event
     *
     * @return void
     */
    public function handle(CreatedStudent $event)
    {
        Mail::to($event->student->email)->send(new PasswordSet($event->student));
    }
}
