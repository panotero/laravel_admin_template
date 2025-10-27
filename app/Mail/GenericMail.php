<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class GenericMail extends Mailable
{

    public $body;
    public $mailArray;

    public function __construct($subject, $body, $mailArray)
    {
        $this->subject($subject);
        $this->body = $body;
        $this->mailArray = $mailArray;
    }

    public function build()
    {
        return $this->view('emails.generic')
            ->with(['body' => $this->body, 'mailArray' => $this->mailArray]);
    }
}
