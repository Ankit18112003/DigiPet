<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vet;

class VetController extends Controller
{
    public function show(Request $request)
    {
        $region = $request->input('region');

        // Filter vets based on selected region
        if ($region === 'North Goa' || $region === 'South Goa') {
            $vets = Vet::where('region', $region)->get();
        } else {
            $vets = Vet::all(); // Show all if region is "All" or not selected
        }

        return view('vet.details', compact('vets', 'region'));
    }
}
