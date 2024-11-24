<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Farmer;
use App\Models\FarmerAyuda;
use App\Models\User;
use App\Mail\WeatherAlert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendWeatherAlertJob;
use App\Models\Announcement;
use App\Models\CalamityReport;
class AdminController extends Controller
{


    public function admindash() {
        $newReportsCount = CalamityReport::where('created_at', '>=', now()->subDay())->count();

        // Retrieve all farmers
        $farmers = Farmer::all();

        // Location most sent ayuda
        $locationMostSentAyuda = FarmerAyuda::select('location', DB::raw('count(*) as total'))
            ->groupBy('location')
            ->orderByDesc('total')
            ->first();

        // Unique crop types count
        $uniqueCropTypesCount = Farmer::distinct('crop_types')->count('crop_types');

        // Additional statistics
        $totalFarmersCount = $farmers->count();

        // Count of crop images
        $totalCropImagesCount = Farmer::whereNotNull('crop_images')->count();

        // Count of livestock types (assuming you want to count unique types)
        $uniqueLivestockTypesCount = Farmer::distinct('livestock_types')->count('livestock_types');

        // Farmers grouped by location
        $farmersByLocation = Farmer::select('location', DB::raw('count(*) as total'))
            ->groupBy('location')
            ->get();

        // Crop type distribution (excluding null or empty values)
        $cropDistribution = Farmer::select('crop_types', DB::raw('count(*) as total'))
            ->whereNotNull('crop_types')
            ->where('crop_types', '!=', '')
            ->groupBy('crop_types')
            ->get();

        // Livestock distribution (excluding null or empty values)
        $livestockDistribution = Farmer::select('livestock_types', DB::raw('count(*) as total'))
            ->whereNotNull('livestock_types')
            ->where('livestock_types', '!=', '')
            ->groupBy('livestock_types')
            ->get();

        // Merge crop and livestock distribution
        $cropAndLivestockDistribution = $cropDistribution->merge($livestockDistribution);

        // Recent registrations (adjust the query according to your registration date field)
        $recentRegistrationsCount = Farmer::where('created_at', '>=', now()->subMonth())->count();

        // Identify the most affected location dynamically
        $susceptibleCrops = ['corn', 'wheat', 'rice']; // Add other susceptible crop types

        $mostAffectedLocation = Farmer::select('location', DB::raw('count(*) as affected_count'))
            ->whereIn('crop_types', $susceptibleCrops)
            ->groupBy('location')
            ->orderBy('affected_count', 'desc')
            ->first();

        $mostAffectedLocationData = Farmer::select(DB::raw('MONTH(created_at) as month, YEAR(created_at) as year, location, COUNT(*) as total'))
            ->whereIn('crop_types', $susceptibleCrops)
            ->groupBy(DB::raw('MONTH(created_at), YEAR(created_at), location'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at), total'), 'desc')
            ->get();

        // Prepare data with formatted month labels
        $formattedData = $mostAffectedLocationData->map(function($item) {
            $monthName = \Carbon\Carbon::createFromFormat('m', $item->month)->format('F'); // Format month to full name
            $item->month_label = $monthName . ' - ' . $item->location; // Combine month and location
            return $item;
        });

        // Fetch weather prediction for tomorrow
        $apiKey = env('WEATHER_API_KEY'); // Use the API key from the .env file
        $city = 'Oriental Mindoro'; // City for the weather data
        $response = Http::get(env('WEATHER_API_URL') . "/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric',
        ]);

        $weatherData = $response->json();

        // Extract relevant weather information
        $tomorrowWeather = [
            'temperature' => $weatherData['main']['temp'] ?? null,
            'description' => $weatherData['weather'][0]['description'] ?? null,
            'icon' => $weatherData['weather'][0]['icon'] ?? null, // Extract the icon code
        ];

        // Define the temperature threshold
        $temperatureThreshold = 35;

        // Check if the temperature is below the threshold
        if ($tomorrowWeather['temperature'] !== null && $tomorrowWeather['temperature'] < $temperatureThreshold) {
            // Prepare email data
            $emailData = [
                'city' => $city,
                'temperature' => $tomorrowWeather['temperature'],
                'description' => $tomorrowWeather['description'],
            ];

            // Calculate the delay to 8 AM
            $now = Carbon::now();
            $targetTime = $now->copy()->setTimezone('Asia/Manila')->setTime(8, 0, 0);

            // If 8 AM has already passed today, schedule for 8 AM the next day
            if ($now->greaterThan($targetTime)) {
                $targetTime->addDay();
            }

            // Calculate the delay in seconds
            $delay = $targetTime->diffInSeconds($now);

            // Dispatch the job with the calculated delay
            dispatch(new SendWeatherAlertJob($emailData))->delay(now()->addSeconds($delay));
        }

        return view('Admin.dashboard', compact(
            'uniqueCropTypesCount',
            'totalFarmersCount',
            'totalCropImagesCount',
            'uniqueLivestockTypesCount',
            'farmers',
            'farmersByLocation',
            'cropDistribution',
            'livestockDistribution',
            'cropAndLivestockDistribution', // Pass merged distribution
            'recentRegistrationsCount',
            'mostAffectedLocation',
            'mostAffectedLocationData',
            'formattedData',
            'locationMostSentAyuda',
            'newReportsCount',
            'tomorrowWeather' // Pass weather data to the view
        ));
    }








    public function farmersCrops(){


        $newReportsCount = CalamityReport::where('created_at', '>=', now()->subDay())->count();
        $uniqueCropTypesCount = Farmer::distinct('crop_types')->count('crop_types');
        $farmers = Farmer::all();
        $farmersByLocation = Farmer::select('location', DB::raw('count(*) as total'))
        ->groupBy('location')
        ->get();
        $cropDistribution = Farmer::select('crop_types', DB::raw('count(*) as total'))
        ->groupBy('crop_types')
        ->get();
        $livestockDistribution = Farmer::select('livestock_types', DB::raw('count(*) as total'))
        ->whereNotNull('livestock_types')
        ->where('livestock_types', '!=', '')
        ->groupBy('livestock_types')
        ->get();
        $susceptibleCrops = ['corn', 'wheat', 'rice']; // Add other susceptible crop types
// Recent registrations (adjust the query according to your registration date field)
$recentRegistrationsCount = Farmer::where('created_at', '>=', now()->subMonth())->count();
$mostAffectedLocationData = Farmer::select(DB::raw('MONTH(created_at) as month, YEAR(created_at) as year, location, COUNT(*) as total'))
            ->whereIn('crop_types', $susceptibleCrops)
            ->groupBy(DB::raw('MONTH(created_at), YEAR(created_at), location'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at), total'), 'desc')
            ->get();

        // Prepare data with formatted month labels
        $formattedData = $mostAffectedLocationData->map(function($item) {
            $monthName = \Carbon\Carbon::createFromFormat('m', $item->month)->format('F'); // Format month to full name
            $item->month_label = $monthName . ' - ' . $item->location; // Combine month and location
            return $item;
        });
        $cropAndLivestockDistribution = $cropDistribution->merge($livestockDistribution);

        return view ('Admin.FarmerCrops',compact('farmers','livestockDistribution','cropAndLivestockDistribution','uniqueCropTypesCount','newReportsCount','cropDistribution','farmersByLocation','mostAffectedLocationData','formattedData'));
    }
    public function ViewAllCrops() {
        // Fetch all farmers' crop data
        $farmers = Farmer::all(); // Get all farmers from the table

        return view('Admin.ViewAllCrops', compact('farmers')); // Pass $farmers to the view
    }

    public function assistance() {
        $calamityReport = CalamityReport::all();
        $newReportsCount = CalamityReport::where('created_at', '>=', now()->subDay())->count();
        // Fetch all farmers' crop data
        $susceptibleCrops = ['corn', 'wheat', 'rice']; // Add other susceptible crop types
        $farmers = Farmer::all(); // Get all farmers from the table
        $requests = FarmerAyuda::all(); // Get all farmers from the table
        $mostAffectedLocationData = Farmer::select(DB::raw('MONTH(created_at) as month, YEAR(created_at) as year, location, COUNT(*) as total'))
        ->whereIn('crop_types', $susceptibleCrops)
        ->groupBy(DB::raw('MONTH(created_at), YEAR(created_at), location'))
        ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at), total'), 'desc')
        ->get();
        $farmersByLocation = Farmer::select('location', DB::raw('count(*) as total'))
        ->groupBy('location')
        ->get();
        $cropDistribution = Farmer::select('crop_types', DB::raw('count(*) as total'))
        ->groupBy('crop_types')
        ->get();
        $livestockDistribution = Farmer::select('livestock_types', DB::raw('count(*) as total'))
        ->whereNotNull('livestock_types')
        ->where('livestock_types', '!=', '')
        ->groupBy('livestock_types')
        ->get();
        $cropAndLivestockDistribution = $cropDistribution->merge($livestockDistribution);
    // Prepare data with formatted month labels
    $formattedData = $mostAffectedLocationData->map(function($item) {
        $monthName = \Carbon\Carbon::createFromFormat('m', $item->month)->format('F'); // Format month to full name
        $item->month_label = $monthName . ' - ' . $item->location; // Combine month and location
        return $item;
    });
        return view('Admin.ayuda', compact('farmers','susceptibleCrops','cropAndLivestockDistribution','calamityReport','newReportsCount','cropDistribution','farmersByLocation','mostAffectedLocationData','formattedData','requests')); // Pass $farmers to the view
    }

    public function testimonials()
    {
        // Auto-update unread feedbacks to "Read"
        Feedback::where('status', 'Unread')->update(['status' => 'Viewed... Thank You for your Feedback']);

        $newReportsCount = CalamityReport::where('created_at', '>=', now()->subDay())->count();

        $farmersByLocation = Farmer::select('location', DB::raw('count(*) as total'))
            ->groupBy('location')
            ->get();

        $susceptibleCrops = ['corn', 'wheat', 'rice']; // Add other susceptible crop types

        $mostAffectedLocationData = Farmer::select(DB::raw('MONTH(created_at) as month, YEAR(created_at) as year, location, COUNT(*) as total'))
            ->whereIn('crop_types', $susceptibleCrops)
            ->groupBy(DB::raw('MONTH(created_at), YEAR(created_at), location'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at), total'), 'desc')
            ->get();

        $cropDistribution = Farmer::select('crop_types', DB::raw('count(*) as total'))
            ->groupBy('crop_types')
            ->get();
            $livestockDistribution = Farmer::select('livestock_types', DB::raw('count(*) as total'))
            ->whereNotNull('livestock_types')
            ->where('livestock_types', '!=', '')
            ->groupBy('livestock_types')
            ->get();
        $formattedData = $mostAffectedLocationData->map(function ($item) {
            $monthName = \Carbon\Carbon::createFromFormat('m', $item->month)->format('F'); // Format month to full name
            $item->month_label = $monthName . ' - ' . $item->location; // Combine month and location
            return $item;
        });
        $cropAndLivestockDistribution = $cropDistribution->merge($livestockDistribution);
        // Recent registrations (adjust the query according to your registration date field)
        $recentRegistrationsCount = Farmer::where('created_at', '>=', now()->subMonth())->count();

        $farmers = Farmer::all(); // Get all farmers from the table
        $feedbacks = Feedback::all(); // Fetch all feedbacks (status is already updated)

        return view('Admin.Testimonials', compact('feedbacks', 'farmers','cropAndLivestockDistribution', 'newReportsCount', 'susceptibleCrops', 'formattedData', 'farmersByLocation', 'mostAffectedLocationData', 'cropDistribution', 'recentRegistrationsCount'));
    }

    public function announcement() {
        $newReportsCount = CalamityReport::where('created_at', '>=', now()->subDay())->count();
        // Fetch all farmers' crop data
        $susceptibleCrops = ['corn', 'wheat', 'rice']; // Add other susceptible crop types
        $farmers = Farmer::all(); // Get all farmers from the table
        $requests = FarmerAyuda::all(); // Get all farmers from the table
        $announcements = Announcement::all(); // Get all farmers from the table
        $mostAffectedLocationData = Farmer::select(DB::raw('MONTH(created_at) as month, YEAR(created_at) as year, location, COUNT(*) as total'))
        ->whereIn('crop_types', $susceptibleCrops)
        ->groupBy(DB::raw('MONTH(created_at), YEAR(created_at), location'))
        ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at), total'), 'desc')
        ->get();
        $farmersByLocation = Farmer::select('location', DB::raw('count(*) as total'))
        ->groupBy('location')
        ->get();
        $cropDistribution = Farmer::select('crop_types', DB::raw('count(*) as total'))
        ->groupBy('crop_types')
        ->get();
        $livestockDistribution = Farmer::select('livestock_types', DB::raw('count(*) as total'))
        ->whereNotNull('livestock_types')
        ->where('livestock_types', '!=', '')
        ->groupBy('livestock_types')
        ->get();
        $cropAndLivestockDistribution = $cropDistribution->merge($livestockDistribution);
    // Prepare data with formatted month labels
    $formattedData = $mostAffectedLocationData->map(function($item) {
        $monthName = \Carbon\Carbon::createFromFormat('m', $item->month)->format('F'); // Format month to full name
        $item->month_label = $monthName . ' - ' . $item->location; // Combine month and location
        return $item;
    });
        return view('Admin.announcements', compact('farmers','cropAndLivestockDistribution','newReportsCount','susceptibleCrops','announcements','cropDistribution','farmersByLocation','mostAffectedLocationData','formattedData','requests')); // Pass $farmers to the view
    }
    public function calamity()
    {
        // Fetch the count of unseen calamity reports
        $newReportsCount = CalamityReport::where('viewed', false)->count();

        // Mark all unseen reports as viewed when accessing the page
        CalamityReport::where('viewed', false)->update(['viewed' => true]);

        // Other existing logic
        $calamityReport = CalamityReport::all();
        $susceptibleCrops = ['corn', 'wheat', 'rice'];
        $farmers = Farmer::all();
        $requests = FarmerAyuda::all();
        $announcements = Announcement::all();
        $mostAffectedLocationData = Farmer::select(DB::raw('MONTH(created_at) as month, YEAR(created_at) as year, location, COUNT(*) as total'))
            ->whereIn('crop_types', $susceptibleCrops)
            ->groupBy(DB::raw('MONTH(created_at), YEAR(created_at), location'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at), total'), 'desc')
            ->get();
        $farmersByLocation = Farmer::select('location', DB::raw('count(*) as total'))
            ->groupBy('location')
            ->get();
        $cropDistribution = Farmer::select('crop_types', DB::raw('count(*) as total'))
            ->groupBy('crop_types')
            ->get();
            $livestockDistribution = Farmer::select('livestock_types', DB::raw('count(*) as total'))
            ->whereNotNull('livestock_types')
            ->where('livestock_types', '!=', '')
            ->groupBy('livestock_types')
            ->get();
            $cropAndLivestockDistribution = $cropDistribution->merge($livestockDistribution);
        $formattedData = $mostAffectedLocationData->map(function ($item) {
            $monthName = \Carbon\Carbon::createFromFormat('m', $item->month)->format('F');
            $item->month_label = $monthName . ' - ' . $item->location;
            return $item;
        });

        return view('Admin.calamityReport', compact(
            'farmers',
            'susceptibleCrops',
            'announcements',
            'cropAndLivestockDistribution',
            'cropDistribution',
            'livestockDistribution',
            'farmersByLocation',
            'mostAffectedLocationData',
            'formattedData',
            'requests',
            'calamityReport',
            'newReportsCount'
        ));
    }
    public function userAccount()
    {
        // Fetch the count of unseen calamity reports
        $newReportsCount = CalamityReport::where('viewed', false)->count();

        // Mark all unseen reports as viewed when accessing the page
        CalamityReport::where('viewed', false)->update(['viewed' => true]);

        // Other existing logic
        $calamityReport = CalamityReport::all();
        $susceptibleCrops = ['corn', 'wheat', 'rice'];
        $farmers = Farmer::all();
        $userAccount = User::all();
        $requests = FarmerAyuda::all();
        $announcements = Announcement::all();
        $mostAffectedLocationData = Farmer::select(DB::raw('MONTH(created_at) as month, YEAR(created_at) as year, location, COUNT(*) as total'))
            ->whereIn('crop_types', $susceptibleCrops)
            ->groupBy(DB::raw('MONTH(created_at), YEAR(created_at), location'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at), total'), 'desc')
            ->get();
        $farmersByLocation = Farmer::select('location', DB::raw('count(*) as total'))
            ->groupBy('location')
            ->get();
        $cropDistribution = Farmer::select('crop_types', DB::raw('count(*) as total'))
            ->groupBy('crop_types')
            ->get();
            $livestockDistribution = Farmer::select('livestock_types', DB::raw('count(*) as total'))
            ->whereNotNull('livestock_types')
            ->where('livestock_types', '!=', '')
            ->groupBy('livestock_types')
            ->get();
            $cropAndLivestockDistribution = $cropDistribution->merge($livestockDistribution);
        $formattedData = $mostAffectedLocationData->map(function ($item) {
            $monthName = \Carbon\Carbon::createFromFormat('m', $item->month)->format('F');
            $item->month_label = $monthName . ' - ' . $item->location;
            return $item;
        });

        return view('Admin.Useraccount', compact(
            'farmers',
            'susceptibleCrops',
            'announcements',
            'cropDistribution',
            'farmersByLocation',
            'cropAndLivestockDistribution',
            'livestockDistribution',
            'mostAffectedLocationData',
            'formattedData',
            'requests',
            'calamityReport',
            'userAccount',
            'newReportsCount'
        ));
    }



}

