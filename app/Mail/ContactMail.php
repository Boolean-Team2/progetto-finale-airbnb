<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    private $sendMail;

    public function __construct($apartment)
    {
        $this->sendMail = $apartment;
    }

    public function build()
    {
        $output = $this->sendMail;
        return $this->view('mail.send-mail', compact('output'));
    }
}



