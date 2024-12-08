<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use App\Models\Farmer;
use App\Models\CalamityReport;
use App\Models\Announcement;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home() {
        // Retrieve the count of feedbacks for the currently logged-in user
        $feedbackCount = Feedback::where('user_id', Auth::id())->count();

        // Retrieve the latest 5 announcements
        $announcements = Announcement::latest()->take(5)->get();

        // Count unique crop types and livestock types from the Farmer model
        $uniqueCropTypesCount = Farmer::distinct('crop_types')->count('crop_types');
        $uniqueLivestockCount = Farmer::distinct('livestock_types')->count('livestock_types');

        // Get the total number of submitted reports
        $totalReportsCount = CalamityReport::where('user_id', Auth::id())->count();

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
            'totalReportsCount', // Pass total reports count
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
        $userId = auth()->id(); // Get logged-in user ID
        $calamityReport = CalamityReport::where('user_id', $userId)->get(); // Filter by user ID

        $announcements = Announcement::latest()->take(5)->get();
        $feedbackCount = Feedback::count();
        $uniqueCropTypesCount = Farmer::distinct('crop_types')->count('crop_types');
        $uniqueLivestockCount = Farmer::distinct('livestock_types')->count('livestock_types');

        $apiKey = env('WEATHER_API_KEY');
        $city = 'Oriental Mindoro';
        $response = Http::get(env('WEATHER_API_URL') . "/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric',
        ]);

        $weatherData = $response->json();
        $tomorrowWeather = [
            'temperature' => $weatherData['main']['temp'] ?? null,
            'description' => $weatherData['weather'][0]['description'] ?? null,
            'icon' => $weatherData['weather'][0]['icon'] ?? null,
        ];

        return view('User.calamityReport', compact(
            'feedbackCount',
            'uniqueCropTypesCount',
            'uniqueLivestockCount',
            'announcements',
            'userId',
            'calamityReport',
            'tomorrowWeather'
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

        // Validate inputs including the image file
        $validatedData = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'farmer_address' => 'required|string|max:255',
            'farm_location' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'sex' => 'required|in:male,female',
            'contact_number' => 'required|string|max:255',
            'fourps' => 'nullable|string|max:255',
            'pwd' => 'nullable|string|max:255',
            'indigenous' => 'nullable|string|max:255',
            'farm_area' => 'required|numeric',
            'area_planted' => 'required|numeric',
            'commodity' => 'required|string|max:255',

        ]);

        // Update user fields
        $user->last_name = $request->last_name;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->suffix = $request->suffix;
        $user->farmer_address = $request->farmer_address;
        $user->farm_location = $request->farm_location;
        $user->birthdate = $request->birthdate;
        $user->sex = $request->sex;
        $user->contact_number = $request->contact_number;
        $user->fourps = $request->fourps;
        $user->pwd = $request->pwd;
        $user->indigenous = $request->indigenous;
        $user->farm_area = $request->farm_area;
        $user->area_planted = $request->area_planted;
        $user->commodity = $request->commodity;

        // Handle profile picture upload if provided


        // Check if a new password is provided and hash it
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Save the updated user information
        $user->save();

        // Redirect back with success message
        return back()->with('success', 'Profile updated successfully!');
    }



}
