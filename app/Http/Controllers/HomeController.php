<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use App\Models\Farmer;
use App\Models\CalamityReport;
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
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8',
        'rs' => 'nullable|string|max:255',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image file
    ]);

    // Update user fields
    $user->name = $request->name;
    $user->email = $request->email;
    $user->rs = $request->rs; // Update rs field

    // Check if a new password is provided and hash it
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    // Handle profile picture upload if provided
    if ($request->hasFile('profile_picture')) {
        // Generate a unique name for the image to avoid overwriting
        $imageName = time() . '.' . $request->profile_picture->getClientOriginalExtension();

        // Move the image to the public directory
        $request->profile_picture->move(public_path('profile_pictures'), $imageName);

        // Save the file path to the user's profile picture field
        $user->profile_picture = 'profile_pictures/' . $imageName; // Save the relative path
    }

    // Save the updated user information
    $user->save();

    // Redirect back with success message
    return back()->with('success', 'Profile updated successfully!');
}



}
