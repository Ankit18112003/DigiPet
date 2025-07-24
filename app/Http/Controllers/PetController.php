<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class PetController extends Controller
{
    // Show all pets for the logged-in user
    public function index()
    {
        $user = Auth::user();
        $pets = Pet::where('owner_id', $user->id)->get();
        return view('pet.details', compact('pets'));
    }

    // Store a new pet
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'dob' => 'required|date|before:today',
            'microchip_number' => 'required|numeric|unique:pets,microchip_number',
        ]);

        $dob = Carbon::parse($request->dob);
        $age = $dob->age;

        Pet::create([
            'pet_id' => (string) Str::uuid(),
            'owner_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type,
            'breed' => $request->breed,
            'color' => $request->color,
            'dob' => $request->dob,
            'microchip_number' => $request->microchip_number,
            'age' => $age, // In case you re-add age in future
        ]);

        return redirect()->route('pet.details')->with('success', 'Pet added successfully.');
    }

    // Update an existing pet
    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'dob' => 'required|date|before:today',
            'microchip_number' => [
                'required',
                'numeric',
                Rule::unique('pets')->ignore($pet->id),
            ],
        ]);

        $dob = Carbon::parse($request->dob);
        $age = $dob->age;

        $pet->update([
            'name' => $request->name,
            'type' => $request->type,
            'breed' => $request->breed,
            'color' => $request->color,
            'dob' => $request->dob,
            'microchip_number' => $request->microchip_number,
            'age' => $age, // If column exists
        ]);

        return redirect()->route('pet.details')->with('success', 'Pet updated successfully.');
    }

    // Delete a pet
    public function destroy(Pet $pet)
    {
        $pet->delete();
        return redirect()->route('pet.details')->with('success', 'Pet deleted successfully.');
    }
}
