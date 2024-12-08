<?php

namespace App\Http\Controllers;
use App\Models\AssistanceHistory;
use App\Models\CalamityReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CalamityReportController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'calamity' => 'required|string',
            'farmerType' => 'required|string',
            'rsbsaRefNumber' => 'nullable|string',
            'cropsOrLivestocks' => 'required|string',
            'proofImages' => 'required|array',
            'proofImages.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remarks' => 'nullable|string',
            // Validation for dynamic fields
            'partialDamageArea' => 'nullable|string',
            'totallyDamageArea' => 'nullable|string',
            'totalArea' => 'nullable|string',
            'farmType' => 'nullable|string',
            'animalType' => 'nullable|string',
            'ageClassification' => 'nullable|string',
            'noOfHeads' => 'nullable|integer',
            'surname' => 'nullable|string',
            'first_name' => 'nullable|string',
            'middle_name' => 'nullable|string',
            'extension_name' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'region' => 'nullable|string',
            'municipality' => 'nullable|string',
            'province' => 'nullable|string',
            'barangay' => 'nullable|string',
            'orgName' => 'nullable|string',
            'maleCount' => 'nullable|integer',
            'femaleCount' => 'nullable|integer',
            'sex' => 'nullable|string',
            'tribeName' => 'nullable|string',
            'pwd' => 'nullable|in:yes,no',
            'arb' => 'nullable|in:yes,no',
            'fourPs' => 'nullable|in:yes,no',
        ]);

        // Handle file uploads
        $proofImages = [];
        if ($request->hasFile('proofImages')) {
            foreach ($request->file('proofImages') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('proof_images'), $filename);
                $proofImages[] = 'proof_images/' . $filename;
            }
        }

        // Create the report record
        $calamityReport = CalamityReport::create([
            'calamity' => $validated['calamity'],
            'farmer_type' => $validated['farmerType'],
            'rsbsa_ref_number' => $validated['rsbsaRefNumber'],
            'crops_or_livestocks' => $validated['cropsOrLivestocks'],
            'proof_images' => $proofImages,
            'remarks' => $validated['remarks'],
            'partial_damage_area' => $validated['partialDamageArea'],
            'totally_damage_area' => $validated['totallyDamageArea'],
            'total_area' => $validated['totalArea'],
            'farm_type' => $validated['farmType'],
            'animal_type' => $validated['animalType'],
            'age_classification' => $validated['ageClassification'],
            'no_of_heads' => $validated['noOfHeads'],
            'surname' => $validated['surname'],
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'extension_name' => $validated['extension_name'],
            'birthdate' => $validated['birthdate'],
            'region' => $validated['region'],
            'municipality' => $validated['municipality'],
            'province' => $validated['province'],
            'barangay' => $validated['barangay'],
            'org_name' => $validated['orgName'],
            'male_count' => $validated['maleCount'],
            'female_count' => $validated['femaleCount'],
            'sex' => $validated['sex'],
            'tribe_name' => $validated['tribeName'],
            'pwd' => $validated['pwd'],
            'arb' => $validated['arb'],
            'four_ps' => $validated['fourPs'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Calamity report created successfully!');
    }



    public function markAsCompleted($id)
    {
        $report = CalamityReport::findOrFail($id);

        // Remove ownership check, allow anyone to mark as completed
        $report->update(['report_status' => 'completed']);

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
    public function provideAssistance($id, $assistanceType)
    {
        // Find the report by ID
        $report = CalamityReport::findOrFail($id);

        // Update the report with the assistance type
        $report->assistance_type = $assistanceType;
        $report->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', "{$assistanceType} has been provided.");
    }
    public function storeAssistanceHistory(Request $request, $id, $assistanceType)
    {
        $calamityReport = CalamityReport::findOrFail($id);

        // Store the assistance in the assistance_histories table
        AssistanceHistory::create([
            'report_id' => $calamityReport->id,
            'assistance_type' => $assistanceType,
            'date_provided' => now(),
            'remarks' => $request->remarks, // If you have remarks in the form
        ]);

        // Optionally, update the status of the report if needed
        $calamityReport->update(['status' => 'Assistance Provided']);

        return redirect()->back()->with('success', 'Assistance provided successfully!');
    }
}



