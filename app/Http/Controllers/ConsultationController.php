<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pet;
use App\Models\Vet;
use App\Models\Consultation;

class ConsultationController extends Controller
{
    /**
     * Show the consultation booking form and consultation history.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Pets owned by the logged-in user
        $pets = Pet::where('owner_id', $user->id)->get();

        // Optional vet filtering logic
        $vets = [];
        if ($request->filled('region')) {
            $regionMap = [
                'north' => 'North Goa',
                'south' => 'South Goa',
            ];
            $region = $regionMap[strtolower($request->region)] ?? null;

            if ($region) {
                $vets = Vet::where('region', $region)->get();
            }
        }

        // Consultation history of all user's pets
        $consultations = Consultation::whereIn('pet_id', $pets->pluck('pet_id'))
            ->with(['pet', 'vet'])
            ->latest('consultation_date')
            ->get();

        return view('consultation.details', [
            'pets' => $pets,
            'vets' => $vets,
            'consultations' => $consultations,
        ]);
    }

    /**
     * Store a new consultation record.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'pet_id' => ['required', 'string', 'exists:pets,pet_id'],
            'vet_id' => ['required', 'integer', 'exists:vets,vet_id'],
            'consultation_date' => ['required', 'date', 'after_or_equal:today'],
            'purpose' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        // Ensure the selected pet belongs to the authenticated user
        $pet = Pet::where('pet_id', $request->pet_id)
            ->where('owner_id', $user->id)
            ->first();

        if (!$pet) {
            return back()->withErrors(['pet_id' => 'Selected pet not found or not owned by you'])->withInput();
        }

        // Create the consultation record
        Consultation::create([
            'pet_id' => $request->pet_id, // UUID-like string from pets.pet_id
            'vet_id' => $request->vet_id,
            'consultation_date' => $request->consultation_date,
            'purpose' => $request->purpose,
            'notes' => $request->notes,
        ]);

        return redirect()->route('consultation.details')->with('success', 'Consultation booked successfully.');
    }

    /**
     * AJAX: Get vets based on selected region.
     */
    public function getVetsByRegion(Request $request)
    {
        $regionMap = [
            'north' => 'North Goa',
            'south' => 'South Goa',
        ];

        $mappedRegion = $regionMap[strtolower($request->region)] ?? null;

        if (!$mappedRegion) {
            return response()->json(['vets' => []]);
        }

        $vets = Vet::where('region', $mappedRegion)->get();

        return response()->json(['vets' => $vets]);
    }
}
