<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Farmer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FarmerController extends Controller
{
    public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:farmers,email|max:255', // Added 'email' column specification
        'phone' => 'required|string|max:20',
        'crop_types' => 'required|string',
        'livestock_types' => 'required|string',
        'crop_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'livestock_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Define the paths
    $cropImagesPath = public_path('images/crops');
    $livestockImagesPath = public_path('images/livestock');

    // Create directories if they do not exist
    if (!file_exists($cropImagesPath)) {
        mkdir($cropImagesPath, 0755, true); // More secure permission
    }
    if (!file_exists($livestockImagesPath)) {
        mkdir($livestockImagesPath, 0755, true); // More secure permission
    }

    // Handle image upload for crop types
    $cropImagePaths = [];
    if ($request->hasFile('crop_images')) {
        foreach ($request->file('crop_images') as $file) {
            $filename = uniqid() . '_' . $file->getClientOriginalName(); // Added uniqid() for better uniqueness
            $file->move($cropImagesPath, $filename);
            $cropImagePaths[] = 'images/crops/' . $filename;
        }
    }

    // Handle image upload for livestock types
    $livestockImagePaths = [];
    if ($request->hasFile('livestock_images')) {
        foreach ($request->file('livestock_images') as $file) {
            $filename = uniqid() . '_' . $file->getClientOriginalName(); // Added uniqid() for better uniqueness
            $file->move($livestockImagesPath, $filename);
            $livestockImagePaths[] = 'images/livestock/' . $filename;
        }
    }

    // Store farmer information
    Farmer::create([
        'user_id' => auth()->id(),
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'crop_types' => $request->input('crop_types'),
        'location' => $request->input('location'),
        'livestock_types' => $request->input('livestock_types'),
        'crop_images' => json_encode($cropImagePaths), // Store as JSON
        'livestock_images' => json_encode($livestockImagePaths), // Store as JSON
    ]);

    return redirect()->back()->with('success', 'Information submitted successfully.');
}




    public function farmerdata(){
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
        $uniqueCropTypesCount = Farmer::distinct('crop_types')->count('crop_types');
        return view ('User.farmerdata',compact('uniqueCropTypesCount','tomorrowWeather'));
    }
    public function viewfarmercrops(){
        $userId = auth()->id(); // Get the ID of the logged-in user
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

        // Filter farmers by user ID
        $farmers = Farmer::where('user_id', $userId)->get();
        $uniqueCropTypesCount = Farmer::where('user_id', $userId)->distinct('crop_types')->count('crop_types');

        return view('User.cropsdata', compact('uniqueCropTypesCount', 'farmers', 'userId', 'tomorrowWeather'));
    }


}
