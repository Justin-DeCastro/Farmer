<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FeedbackController extends Controller
{
    public function index(){
        $feedbacks = Feedback::where('user_id', auth()->id())->get();

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
        $feedbackCount = $feedbacks->count();
         return view('User.feedback', [
            'feedbacks' => $feedbacks,
            'feedbackCount' => $feedbackCount,
            'tomorrowWeather' => $tomorrowWeather,
        ]);
    }
    public function store(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    // Add the authenticated user's ID to the validated data
    $validated['user_id'] = auth()->id(); // This will add the currently authenticated user's ID

    // Create a new feedback record with the user_id
    Feedback::create($validated);

    // Redirect or respond with a success message
    return redirect()->back()->with('success', 'Feedback submitted successfully!');
}

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    $feedback = Feedback::findOrFail($id);
    $feedback->update($request->all());

    return redirect()->back()->with('success', 'Feedback updated successfully.');
}
public function destroy($id)
{
    $feedback = Feedback::findOrFail($id);
    $feedback->delete();

    return redirect()->back()->with('success', 'Feedback deleted successfully.');
}

}
