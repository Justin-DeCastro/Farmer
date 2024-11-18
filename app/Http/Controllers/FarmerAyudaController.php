<?php

namespace App\Http\Controllers;

use App\Models\FarmerAyuda;
use Illuminate\Http\Request;
use App\Mail\FarmerAssistance;
use Illuminate\Support\Facades\Mail;

class FarmerAyudaController extends Controller
{
    // Display the form
    public function create()
    {
        return view('admin.ayuda');
    }

    // Store the form data
    public function store(Request $request)
{
    // Validate the form input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'location' => 'required|string|max:255',
        'assistance' => 'required|string|max:1000',
    ]);

    // Access form data
    $name = $request->input('name');
    $email = $request->input('email');
    $location = $request->input('location');
    $assistanceDetails = $request->input('assistance');  // Updated field name

    // Store the data in the database
    FarmerAyuda::create([
        'name' => $name,
        'email' => $email,
        'location' => $location,
        'request' => $assistanceDetails, // Updated field name
    ]);

    // Send the email to the farmer (from the admin)
    Mail::to($email)->send(new FarmerAssistance($name, $location, $assistanceDetails));

    // Redirect back with success message
    return redirect()->route('assistance')->with('success', 'The assistance request has been sent to the farmer!');
}
}
