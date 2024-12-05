<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuardColumnController;
use App\Http\Controllers\batcontrol;
use Illuminate\Http\Request;
use App\Models\ChannelsDescription;
use Illuminate\Support\Facades\DB;

// Page d'accueil
Route::get('/', function () {
    return view('index');
});

// Page administrateur
Route::get('/admin', function () {
    return view('admin'); // Vue 'admin.blade.php'
});

// Enregistrement du temps de manipulation
Route::post('/call_form_after', function (Request $request) {
    // Valider les données
    $request->validate([
        'manipulation_time' => 'required|integer|min:0',
    ]);

    // Convertir les secondes en HH:MM:SS
    $manipulationTimeInSeconds = $request->input('manipulation_time');
    $hours = floor($manipulationTimeInSeconds / 3600);
    $minutes = floor(($manipulationTimeInSeconds % 3600) / 60);
    $seconds = $manipulationTimeInSeconds % 60;

    $formattedTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

    // Mettre à jour la base de données
    $manipulationId = session('manipulation_id');
    DB::table('manipulations')->where('id', $manipulationId)->update([
        'manipulation_time' => now()->format('Y-m-d') . ' ' . $formattedTime,
        'updated_at' => now(),
    ]);

    return back()->with('success', 'Manipulation time saved successfully!');
});

// Route pour récupérer tous les utilisateurs (via AJAX)
Route::post('users/all', [UserController::class, 'getAllUsers'])->name('users.all');

// Routes AJAX pour les colonnes
Route::post('columns/all', [ColumnController::class, 'getAllColumns'])->name('columns.all');
Route::post('guardcolumns/all', [GuardColumnController::class, 'getAllGuardColumns'])->name('guardcolumns.all');

// Page intermédiaire pour affichage après soumission
Route::get('/submit_before', function () {
    return view('after'); // Vue intermédiaire
});

// Route pour soumettre le formulaire et exécuter le batch
Route::post('/submit_before', [batcontrol::class, 'batlaunch'])->name('submit_before');
