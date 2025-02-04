<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReunionController;
use App\Http\Controllers\OrganController;
use App\Http\Controllers\TextLoiController;


// Route pour afficher le formulaire de connexion
Route::get('login', [LoginController::class, 'showLoginForm'])->name('utilisateur.loginForm')->middleware('guest');;

// Route pour traiter le formulaire de connexion
Route::post('login', [LoginController::class, 'login'])->name('utilisateur.login');

// Route pour se déconnecter
Route::post('logout', [LoginController::class, 'logout'])->name('utilisateur.logout');

// Routes protégées par le middleware `auth`
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ReunionController::class,'index'])->name('dashboard');
    // Pour les réunions
Route::get('/reunions', [ReunionController::class, 'index'])->name('reunions.list');
Route::get('/reunions/create', [ReunionController::class, 'create'])->name('reunions.form');
Route::get('/reunions/{id}/edit', [ReunionController::class, 'edit'])->name('reunions.edit');
Route::post('/reunions', [ReunionController::class, 'store'])->name('reunions.store');
Route::put('/reunions/{id}', [ReunionController::class, 'update'])->name('reunions.update');
Route::delete('/reunions/{id}', [ReunionController::class, 'destroy'])->name('reunions.destroy');

// Pour les organes
Route::get('/organs', [OrganController::class, 'index'])->name('organs.list');
Route::get('/organs/create', [OrganController::class, 'create'])->name('organs.form');
Route::get('/organs/{id}/edit', [OrganController::class, 'edit'])->name('organs.edit');
Route::post('/organs', [OrganController::class, 'store'])->name('organs.store');
Route::put('/organs/{id}', [OrganController::class, 'update'])->name('organs.update');
Route::delete('/organs/{id}', [OrganController::class, 'destroy'])->name('organs.destroy');

// pour les textes de loi 
Route::get('/lois', [TextLoiController::class, 'index'])->name('lois.list');
Route::get('/lois/create', [TextLoiController::class, 'create'])->name('lois.form');
Route::get('/lois/{id}/edit', [TextLoiController::class, 'edit'])->name('lois.edit');
Route::post('/lois', [TextLoiController::class, 'store'])->name('lois.store');
Route::put('/lois/{id}', [TextLoiController::class, 'update'])->name('lois.update');
Route::delete('/lois/{id}', [TextLoiController::class, 'destroy'])->name('lois.destroy');



});

// routes pour reunion 