<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccination;
use App\Models\BoosterDose;
use App\Models\Pet;
use App\Models\Vaccine;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VaccinationController extends Controller
{
    // Show vaccinations for the logged-in user’s pets
    public function index()
    {
        $userId = Auth::id();

        $pets = Pet::where('owner_id', $userId)
            ->with('vaccinations.vaccine', 'vaccinations.boosterDose')
            ->get();

        $vaccines = Vaccine::all();

        return view('vaccination.details', compact('pets', 'vaccines'));
    }

    // Store a new vaccination and its booster doses
    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,pet_id',
            'vaccine_id' => 'required|exists:vaccines,id',
            'date_administered' => 'required|date',
            'total_booster_doses' => 'required|integer|min:0',
            'booster_gap_days' => 'required|integer|min:0',
            'notes' => 'nullable|string|max:255',
        ]);

        $vaccination = Vaccination::create([
            'pet_id' => $request->pet_id,
            'vaccine_id' => $request->vaccine_id,
            'date_administered' => $request->date_administered,
            'total_booster_doses' => $request->total_booster_doses,
            'booster_gap_days' => $request->booster_gap_days,
            'notes' => $request->notes,
        ]);

        // Create booster doses
        if ($request->total_booster_doses > 0) {
            for ($i = 1; $i <= $request->total_booster_doses; $i++) {
                BoosterDose::create([
                    'vaccination_id' => $vaccination->id,
                    'pet_id' => $request->pet_id,
                    'dose_number' => $i,
                    'ideal_date' => Carbon::parse($request->date_administered)->addDays($i * $request->booster_gap_days),
                    'status' => 'Pending',
                ]);
            }
        }

        return redirect()->back()->with('success', 'Vaccination and boosters added successfully.');
    }

    // Update an existing vaccination
    public function update(Request $request, $id)
    {
        $vaccination = Vaccination::findOrFail($id);

        $request->validate([
            'vaccine_id' => 'required|exists:vaccines,id',
            'date_administered' => 'required|date',
            'notes' => 'nullable|string|max:255',
        ]);

        $vaccination->update([
            'vaccine_id' => $request->vaccine_id,
            'date_administered' => $request->date_administered,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Vaccination updated successfully.');
    }

    // Delete a vaccination and its boosters
    public function destroy($id)
    {
        $vaccination = Vaccination::findOrFail($id);
        $vaccination->boosterDose()->delete();
        $vaccination->delete();

        return redirect()->back()->with('success', 'Vaccination and related boosters deleted.');
    }

    // Mark a booster dose as given
    public function markBooster(Request $request, $id)
    {
        $request->validate([
            'booster_id' => 'required|exists:booster_dose,id',
            'date_given' => 'required|date',
            'status' => 'required|in:Given',
        ]);

        $booster = BoosterDose::findOrFail($request->booster_id);
        $booster->update([
            'status' => $request->status,
            'given_date' => $request->date_given,
        ]);

        return redirect()->back()->with('success', 'Booster dose marked as Given.');
    }
}
