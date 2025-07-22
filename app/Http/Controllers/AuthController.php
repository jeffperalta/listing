<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create() 
    {
        return inertia('Auth/Login'); // Return the login view
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ( !Auth::attempt($request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]), true)) {
            throw ValidationException::withMessages([
                'email' => 'Authentication failed.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()
            ->intended(route('listing.index'))
            ->with('success', 'You are now logged in.');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('listing.index');
    }
}
