<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class WeatherAlert extends Mailable
{
    public $emailData;

    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    public function build()
    {
        return $this->view('emails.weather_alert')
                    ->with('emailData', $this->emailData);
    }
}
