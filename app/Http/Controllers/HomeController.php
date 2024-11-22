<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use App\Models\Farmer;
use App\Models\Announcement;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        // Retrieve the count of feedbacks
        $announcements = Announcement::latest()->take(5)->get();
        $feedbackCount = Feedback::count();
        $uniqueCropTypesCount = Farmer::distinct('crop_types')->count('crop_types');
        $uniqueLivestockCount = Farmer::distinct('livestock_types')->count('livestock_types');

        // Fetch current weather and forecast for tomorrow
        $apiKey = env('WEATHER_API_KEY');
        $city = 'Oriental Mindoro'; // Replace with your city
        $response = Http::get(env('WEATHER_API_URL') . "/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric',
        ]);

        $weatherData = $response->json();
        $tomorrowWeather = [
            'temperature' => $weatherData['main']['temp'] ?? null,
            'description' => $weatherData['weather'][0]['description'] ?? null,
            'icon' => $weatherData['weather'][0]['icon'] ?? null, // Extract the icon code
        ];

        // Pass the count and weather data to the view
        return view('User.home', compact(
            'feedbackCount',
            'uniqueCropTypesCount',
            'uniqueLivestockCount',
            'announcements',
            'tomorrowWeather' // Pass weather data to the view
        ));
    }



    public function feedback() {

        $feedbacks = Feedback::all();


        $feedbackCount = $feedbacks->count();
        $apiKey = env('WEATHER_API_KEY');
        $city = 'Oriental Mindoro'; // Replace with your city
        $response = Http::get(env('WEATHER_API_URL') . "/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric',
        ]);

        $weatherData = $response->json();
        $tomorrowWeather = [
            'temperature' => $weatherData['main']['temp'] ?? null,
            'description' => $weatherData['weather'][0]['description'] ?? null,
            'icon' => $weatherData['weather'][0]['icon'] ?? null, // Extract the icon code
        ];


        return view('User.feedback', [
            'feedbacks' => $feedbacks,
            'feedbackCount' => $feedbackCount,
            'tomorrowWeather' => $tomorrowWeather,
        ]);
    }
    public function calamityReport() {
        // Retrieve the count of feedbacks
        $userId = auth()->id();

        $announcements = Announcement::latest()->take(5)->get();
        $feedbackCount = Feedback::count();
        $uniqueCropTypesCount = Farmer::distinct('crop_types')->count('crop_types');
        $uniqueLivestockCount = Farmer::distinct('livestock_types')->count('livestock_types');

        // Fetch current weather and forecast for tomorrow
        $apiKey = env('WEATHER_API_KEY');
        $city = 'Oriental Mindoro'; // Replace with your city
        $response = Http::get(env('WEATHER_API_URL') . "/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric',
        ]);

        $weatherData = $response->json();
        $tomorrowWeather = [
            'temperature' => $weatherData['main']['temp'] ?? null,
            'description' => $weatherData['weather'][0]['description'] ?? null,
            'icon' => $weatherData['weather'][0]['icon'] ?? null, // Extract the icon code
        ];

        // Pass the count and weather data to the view
        return view('User.calamityReport', compact(
            'feedbackCount',
            'uniqueCropTypesCount',
            'uniqueLivestockCount',
            'announcements',
            'userId',
            'tomorrowWeather' // Pass weather data to the view
        ));
    }
    public function editAccount() {

        $feedbacks = Feedback::all();


        $feedbackCount = $feedbacks->count();
        $apiKey = env('WEATHER_API_KEY');
        $city = 'Oriental Mindoro'; // Replace with your city
        $response = Http::get(env('WEATHER_API_URL') . "/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric',
        ]);

        $weatherData = $response->json();
        $tomorrowWeather = [
            'temperature' => $weatherData['main']['temp'] ?? null,
            'description' => $weatherData['weather'][0]['description'] ?? null,
            'icon' => $weatherData['weather'][0]['icon'] ?? null, // Extract the icon code
        ];


        return view('User.EditProfile', [
            'feedbacks' => $feedbacks,
            'feedbackCount' => $feedbackCount,
            'tomorrowWeather' => $tomorrowWeather,
        ]);
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Validate inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'rs' => 'nullable|string|max:255', // Add validation for rs
        ]);

        // Update user fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->rs = $request->rs; // Update rs field

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }


}
