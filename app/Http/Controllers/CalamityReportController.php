<?php

namespace App\Http\Controllers;

use App\Models\CalamityReport;
use Illuminate\Http\Request;

class CalamityReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reporterName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Ensure the report is created with the logged-in user
        CalamityReport::create([
            'reporter_name' => $request->reporterName,
            'email' => $request->email,
            'location' => $request->location,
            'description' => $request->description,
            'user_id' => auth()->id(), // Store the logged-in user's ID
        ]);

        return redirect()->back()->with('success', 'Calamity report submitted successfully.');
    }

    public function markAsCompleted($id)
    {
        $report = CalamityReport::findOrFail($id);

        // Remove ownership check, allow anyone to mark as completed
        $report->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Report marked as completed.');
    }


    public function delete($id)
    {
        $report = CalamityReport::findOrFail($id);

        // Ensure the logged-in user owns the report
        if ($report->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You do not have permission to delete this report.');
        }

        $report->delete();

        return redirect()->back()->with('success', 'Report deleted successfully.');
    }

    public function cancel($id)
    {
        $report = CalamityReport::findOrFail($id);

        // Remove ownership check, allow anyone to cancel the report
        $report->status = 'canceled';
        $report->save();

        return redirect()->back()->with('success', 'Report status updated to Canceled.');
    }

    public function uploadImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $report = CalamityReport::findOrFail($id);

        // Get the uploaded file
        $file = $request->file('image');

        // Generate a unique name for the image to avoid overwriting
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Move the image to the public directory
        $file->move(public_path('calamity_reports_images'), $fileName);

        // Save the image path in the database
        $report->image_path = 'calamity_reports_images/' . $fileName;
        $report->status = 'under review'; // Optional: Change status to 'Under Review'
        $report->save();

        return redirect()->back()->with('success', 'Image uploaded successfully for review.');
    }

}



