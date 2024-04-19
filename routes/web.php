<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EtudiantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// Route pour générer automatiquement les étudiants
Route::get('/genere-etudiant', [EtudiantController::class, 'genereLaListeDesEtudiants'])->name('etudiant.genere');

// Route pour exporter les données en pdf
Route::get('/export-pdf', [EtudiantController::class, 'exportPDF'])->name('etudiant.exportPdf');

Route::get('/etudiant', [EtudiantController::class, 'index'])->name('etudiant.index');

// Route pour afficher le formulaire de création de tâche
Route::get('/etudiant/create', [EtudiantController::class, 'create'])->name('etudiant.create');

// Route pour traiter la création d'une nouvelle tâche
Route::post('/etudiant', [EtudiantController::class, 'store'])->name('etudiant.store');

Route::get('/etudiant/{id}', [EtudiantController::class, 'show']);

// Route pour afficher le formulaire de modification d'une tâche
Route::get('/etudiant/{id}/edit', [EtudiantController::class, 'edit'])->name('etudiant.edit');

Route::put('/etudiant/{id}/update', [EtudiantController::class, 'update'])->name('etudiant.update');

Route::delete('/etudiant/{id}/delete', [EtudiantController::class, 'destroy'])->name('etudiant.delete');

Route::get('/etudiants/search', [EtudiantController::class, 'search'])->name('etudiant.search');

// Route pour envoyer le pdf par email
Route::get('/etudiant_email', [EtudiantController::class, 'page_email'])->name('page.email');

Route::post('/send-email', [EtudiantController::class, 'sendEmail'])->name('send.email');