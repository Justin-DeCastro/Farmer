<?php

// app/Http/Controllers/AssistanceController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assistance;
use App\Models\User;

class AssistanceController extends Controller
{
    public function index()
    {
        $assistances = Assistance::orderBy('created_at', 'desc')->get();

        $users = User::all();

        return view('Admin.calamityAssistance', compact('assistances', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'assistance_title' => 'required|string|max:255',
            'assistance_date' => 'required|date',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $assistance = Assistance::create([
            'assistance_title' => $request->assistance_title,
            'assistance_date' => $request->assistance_date,
        ]);

        $assistance->users()->attach($request->user_ids);

        return redirect()->back()->with('success', 'Assistance added successfully');
    }


    public function update(Request $request, $id)
    {
        $assistance = Assistance::findOrFail($id);

        $validatedData = $request->validate([
            'assistance_title' => 'required|string|max:255',
            'assistance_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $assistance->update($validatedData);

        return redirect()->back()->with('success', 'Assistance updated successfully!');
    }

    public function destroy($id)
    {
        $assistance = Assistance::findOrFail($id);
        $assistance->delete();

        return redirect()->back()->with('success', 'Assistance deleted successfully!');
    }
}
