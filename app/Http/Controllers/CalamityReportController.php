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

        CalamityReport::create([
            'reporter_name' => $request->reporterName,
            'email' => $request->email,
            'location' => $request->location,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Calamity report submitted successfully.');
    }
    public function markAsCompleted($id)
{
    $report = CalamityReport::findOrFail($id);
    $report->update(['status' => 'completed']);

    return redirect()->back()->with('success', 'Report marked as completed.');
}

public function delete($id)
{
    $report = CalamityReport::findOrFail($id);
    $report->delete();

    return redirect()->back()->with('success', 'Report deleted successfully.');
}

}
