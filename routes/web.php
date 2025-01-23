<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikliController;
use App\Http\Controllers\KosaricaController;
use App\Http\Controllers\NarudzbaController;
use App\Http\Controllers\RadniciNarudzbeController;
use App\Http\Controllers\RadniciController;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/artikli', [ArtikliController::class, 'index'])->name('artikli.index');
Route::get('/artikli/create', [ArtikliController::class, 'create'])->name('artikli.create');
Route::post('/artikli', [ArtikliController::class, 'store'])->name('artikli.store');
Route::get('/kosarica', [KosaricaController::class, 'index'])->name('kosarica.index');
Route::post('/kosarica/dodaj', [KosaricaController::class, 'dodaj'])->name('kosarica.dodaj');
Route::post('/kosarica/azuriraj', [KosaricaController::class, 'azuriraj'])->name('kosarica.azuriraj');
Route::post('/kosarica/ukloni', [KosaricaController::class, 'ukloni'])->name('kosarica.ukloni');
Route::post('/kosarica/ocisti', [KosaricaController::class, 'ocisti'])->name('kosarica.ocisti');
Route::post('/kosarica/zavrsi', [KosaricaController::class, 'zavrsiNarudzbu'])->name('kosarica.zavrsi');
Route::put('/kosarica/update/{id}', [KosaricaController::class, 'update'])->name('kosarica.update');
Route::delete('/kosarica/ukloni/{id}', [KosaricaController::class, 'ukloni'])->name('kosarica.ukloni');
Route::post('/kosarica/zavrsi', [KosaricaController::class, 'zavrsiNarudzbu'])->name('kosarica.zavrsi');
Route::post('/narudzbe/{id}/status', [NarudzbaController::class, 'promijeniStatus'])->name('narudzbe.promijeniStatus');
Route::get('/narudzbe', [NarudzbaController::class, 'index'])->name('narudzbe.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/narudzbe', [NarudzbaController::class, 'index'])->name('narudzbe.index');
    Route::post('/narudzbe/{id}/status', [NarudzbaController::class, 'updateStatus'])->name('narudzbe.updateStatus');
});
Route::middleware('auth')->group(function () {
    Route::get('/radnici/narudzbe', [RadniciNarudzbeController::class, 'index'])->name('radnici.narudzbe.index');
    Route::post('/radnici/narudzbe/{id}/status', [RadniciNarudzbeController::class, 'promijeniStatus'])->name('radnici.narudzbe.promijeniStatus');
});
Route::middleware('auth')->group(function () {
    // Prikaz svih radnika
    Route::get('/radnici', [RadniciController::class, 'index'])->name('radnici.index');

    // Forma za kreiranje novog radnika
    Route::get('/radnici/create', [RadniciController::class, 'create'])->name('radnici.create');

    // Spremanje novog radnika
    Route::post('/radnici', [RadniciController::class, 'store'])->name('radnici.store');

    // Forma za editovanje radnika
    Route::get('/radnici/{id}/edit', [RadniciController::class, 'edit'])->name('radnici.edit');

    // Ažuriranje radnika
    Route::put('/radnici/{id}', [RadniciController::class, 'update'])->name('radnici.update');

    // Brisanje radnika
    Route::delete('/radnici/{id}', [RadniciController::class, 'destroy'])->name('radnici.destroy');
});

Route::middleware('auth')->group(function () {
    // Ruta za prikaz svih radnika
    Route::get('admin/radnici', [RadniciController::class, 'index'])->name('radnici.index');

    // Ruta za dodavanje novog radnika
    Route::get('admin/radnici/create', [RadniciController::class, 'create'])->name('admin.radnici.create');
    Route::get('admin/radnici/create', [RadniciController::class, 'create'])->name('admin.radnici.create');
    Route::post('adminradnici', [RadniciController::class, 'store'])->name('admin.radnici.store');
    Route::get('admin/radnici/edit', [RadniciController::class, 'edit'])->name('admin.radnici.edit');
    Route::post('admin/radnici/edit', [RadniciController::class, 'edit'])->name('admin.radnici.edit');
    Route::get('admin/radnici/destroy', [RadniciController::class, 'destroy'])->name('admin.radnici.destroy');
    Route::post('admin/radnici/destroy', [RadniciController::class, 'destroy'])->name('admin.radnici.destroy');
    Route::get('admin/radnici/index', [RadniciController::class, 'index'])->name('admin.radnici.index');
    Route::get('admin/radnici/{id}/edit', [RadniciController::class, 'edit'])->name('admin.radnici.edit');
    Route::get('radnici/{id}/edit', [RadniciController::class, 'edit'])->name('radnici.edit');

    // Ostatak ruta za radnike...
});
Route::middleware(['auth'])->group(function () {
    Route::resource('radnici', RadniciController::class);
    
});



