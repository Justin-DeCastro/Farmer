<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use App\Mail\AnnouncementMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display the announcements page.
     */
    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('announcements.index', compact('announcements'));
    }

    /**
     * Store a new announcement.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Store the announcement
        $announcement = Announcement::create($request->all());

        // Send email to all users
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new AnnouncementMail($announcement->title, $announcement->content));
        }

        return redirect()->back()->with('success', 'Announcement added and emails sent successfully!');
    }
}
