<?php

namespace App\Jobs;

use App\Models\Farmer;
use Illuminate\Support\Facades\Log;

use App\Mail\WeatherAlert;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class SendWeatherAlertJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    protected $emailData;

    /**
     * Create a new job instance.
     *
     * @param array $emailData
     * @return void
     */
    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Get all farmers
        $farmers = Farmer::all();

        // Send email to all farmers
        foreach ($farmers as $farmer) {
            try {
                Mail::to($farmer->email)->send(new WeatherAlert($this->emailData));
            } catch (\Exception $e) {
                // Log the error if email fails
                Log::error('Failed to send weather alert to farmer: ' . $farmer->email . '. Error: ' . $e->getMessage());
            }
        }
    }
}
