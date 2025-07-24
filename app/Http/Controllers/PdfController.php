<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pet;
use App\Models\Vaccination;
use App\Models\BoosterDose;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class PdfController extends Controller
{
    public function download($id)
    {
        ini_set('memory_limit', '1024M');

        $pet = Pet::where('id', $id)
            ->where('owner_id', Auth::id())
            ->firstOrFail();

        $owner = Auth::user();

        // ✅ Vaccination + Boosters
        $vaccinations = Vaccination::where('pet_id', $pet->id)->get();
        $boosters = BoosterDose::whereIn('vaccination_id', $vaccinations->pluck('id'))
                    ->get()
                    ->groupBy('vaccination_id');

        // ✅ QR code (as SVG string)
        $qrCodeSvg = QrCode::format('svg')->size(100)->generate("Pet: {$pet->name}, Owner: {$owner->name}");

        // ✅ Load PDF view
        $pdf = Pdf::loadView('pdf.petcards', [
            'pet' => $pet,
            'owner' => $owner,
            'vaccinations' => $vaccinations,
            'boosters' => $boosters,
            'qrCodeSvg' => $qrCodeSvg
        ])->setPaper('a4', 'portrait');

        return $pdf->download('pet_details.pdf');
    }
}
