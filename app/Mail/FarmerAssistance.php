<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FarmerAssistance extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $location;
    public $assistanceDetails;

    public function __construct($name, $location, $assistanceDetails)
    {
        $this->name = $name;
        $this->location = $location;
        $this->assistanceDetails = $assistanceDetails;
    }

    public function build()
    {
        return $this->subject('Assistance Request from Admin')
                    ->view('emails.farmerAssistance'); // Make sure to create this view
    }
}
