<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;


class RejectRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

     
    public function __construct($first_name)
    {
        $this->name = $first_name;
    }

    
    public function build()
    {
        return $this->subject($this->name . 'Request Rejected')
                    ->view('requestreject')
                    ->with('name', $this->name);
    }
}
