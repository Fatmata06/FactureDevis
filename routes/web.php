<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EntrepriseClientController;
use App\Http\Controllers\ClientFinalController;
use App\Http\Controllers\LigneDocumentController;
use App\Http\Controllers\DocumentController;



Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::resource('entreprise_clients', EntrepriseClientController::class);
});
Route::resource('clients_finaux', ClientFinalController::class);
Route::resource('documents', DocumentController::class);
Route::get('documents/{document}/pdf', [DocumentController::class, 'pdf'])->name('documents.pdf');
Route::get('documents/{document}/lignes/create', [LigneDocumentController::class, 'create'])->name('lignes.create');
Route::post('/documents/{document}/lignes', [LigneDocumentController::class, 'store'])->name('lignes.store');


Route::resource('documents', App\Http\Controllers\DocumentController::class);
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');

Route::get('/documents/{document}', [DocumentController::class, 'show'])->name('documents.show');

// Route::get('/documents/{document}/lignes/create', [LigneDocumentController::class, 'create'])->name('ligne-documents.create');
// Route::post('/documents/{document}/lignes', [LigneDocumentController::class, 'store'])->name('ligne-documents.store');

Route::middleware(['auth'])->group(function () {
    Route::resource('documents.ligne-documents', LigneDocumentController::class)
        ->shallow();
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/devis', [QuoteController::class, 'index'])->name('quotes.index');
Route::get('/devis/creer', [QuoteController::class, 'create'])->name('quotes.create');
Route::post('/devis', [QuoteController::class, 'store'])->name('quotes.store');




Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/creer', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');




require __DIR__.'/auth.php';


