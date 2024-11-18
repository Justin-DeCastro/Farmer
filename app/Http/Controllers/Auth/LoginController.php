<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Get the authenticated user
            $user = Auth::user();

            // Check the role of the user
            if ($user->role == 'admin') {
                return redirect()->route('admindash'); // Redirect to admin dashboard
            } else {
                return redirect()->route('home'); // Redirect to the home page for regular users
            }
        }

        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/'); // Redirect to login page after logout
    }
}
