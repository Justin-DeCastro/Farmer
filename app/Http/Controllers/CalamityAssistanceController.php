<?php

namespace App\Http\Controllers;

use App\Models\CalamityAssistance;
use App\Models\User;
use Illuminate\Http\Request;

class CalamityAssistanceController extends Controller
{
    public function index()
    {
        $assistances = CalamityAssistance::with('user')->get();
        $users = User::all();

        return view('admin.calamityAssistance', compact('assistances', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'assistance_title' => 'required|string|max:255',
            'assistance_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        CalamityAssistance::create($request->all());

        return redirect()->back()->with('success', 'Assistance added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'assistance_title' => 'required|string|max:255',
            'assistance_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $assistance = CalamityAssistance::findOrFail($id);
        $assistance->update($request->all());

        return redirect()->back()->with('success', 'Assistance updated successfully.');
    }

    public function destroy($id)
    {
        $assistance = CalamityAssistance::findOrFail($id);
        $assistance->delete();

        return redirect()->back()->with('success', 'Assistance deleted successfully.');
    }
}
