<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Fetch pets associated with the authenticated user
        $pets = Pet::where('owner_id', auth()->id())->get();

        // Pass the pets data to the dashboard view
        return view('dashboard', compact('pets'));
    }
}
