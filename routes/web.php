<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VetController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ChatbotController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 🌐 Public welcome page
Route::get('/', function () {
    return view('welcome');
});

// 📊 Dashboard (requires authentication and verification)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 🧑‍⚕️ Public vet listing
Route::get('/vet/details', [VetController::class, 'show'])->name('vet.details');

// 🔄 AJAX: Get vets by region
Route::get('/get-vets-by-region', [ConsultationController::class, 'getVetsByRegion']);

// 🔐 Authenticated and verified routes
Route::middleware(['auth', 'verified'])->group(function () {

    // 🤖 Chatbot interaction (POST message from chatbot)
    Route::post('/chatbot/message', [ChatbotController::class, 'message'])->name('chatbot.message');

    // 📄 PDF generation/download
    Route::get('/pdf/download/{id}', [PdfController::class, 'download'])->name('pdf.download');

    // 🐾 Pet Management Routes
    Route::get('/pet-details', [PetController::class, 'index'])->name('pet.details');
    Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
    Route::put('/pets/{pet}', [PetController::class, 'update'])->name('pets.update');
    Route::delete('/pets/{pet}', [PetController::class, 'destroy'])->name('pets.destroy');

    // 💉 Vaccination Routes
    Route::get('/vaccination/details', [VaccinationController::class, 'index'])->name('vaccination.details');
    Route::post('/vaccinations', [VaccinationController::class, 'store'])->name('vaccination.store');
    Route::put('/vaccinations/{id}', [VaccinationController::class, 'update'])->name('vaccination.update');
    Route::delete('/vaccinations/{id}', [VaccinationController::class, 'destroy'])->name('vaccination.destroy');
    Route::post('/vaccinations/{id}/booster', [VaccinationController::class, 'markBooster'])->name('booster.mark');

    // 🩺 Consultation Routes
    Route::get('/consultation', [ConsultationController::class, 'index'])->name('consultation.details');
    Route::post('/consultation', [ConsultationController::class, 'store'])->name('consultation.store');

    // 👤 User Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🛡️ Laravel Breeze authentication routes (login, register, etc.)
require __DIR__.'/auth.php';
