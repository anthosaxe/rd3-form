<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuardColumnController;
use App\Models\ChannelsDescription;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Manipulation;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('index');
});

Route::get('/admin', function () 
{
    return view('admin');  // Renvoie la vue 'admin.blade.php'
});

Route::post('/call_form_after', function (Request $request) 
{
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

    // update dans la base de données
    $manipulationId = session('manipulation_id');
    DB::table('manipulations')->where('id', $manipulationId)->update([
    'manipulation_time' => now()->format('Y-m-d') . ' ' . $formattedTime,
    'updated_at' => now(),
]);
    
    return back()->with('success', 'Manipulation time saved successfully!');
});


Route::post('users/all', [UserController::class, 'getAllUsers'])->name('users.all');
//route ajax jquery pour les colonnes (columns.js)
Route::post('columns/all', [ColumnController::class, 'getAllColumns'])->name('columns.all');
Route::post('guardcolumns/all', [GuardColumnController::class, 'getAllGuardColumns'])->name('guardcolumns.all');

Route::get('/submit_before', function () {
    return view('after'); // Remplacez 'submit_form' par votre vue Blade
});


// Enregistrement du premier formulaire lors du clic du submit before
Route::post('/submit_before', function (Request $request) 
{
    //dd($request->all()); // Vérifie que tous les champs dynamiques sont présents
    // Validation des données du formulaire
    $request->validate([
        'manipulation_name' => ['required', function ($attribute, $value, $fail) {
            if (strlen(trim($value)) < 3) {
                $fail('Please complete this field with at least 3 characters.');
            }
        }],
        'user' => 'required|integer|exists:users,id', // Exemples d'autres validations
    ]);

    //print_r($request->all());

    // Enregistrement de la manipulation
    //dd($request->input('manipulation_name'));
    $manipulation = Manipulation::create([
        'users_id' => $request->input('user'),
        'machines_id' => 1,
        'nom_manip' => $request->input('manipulation_name'),
        'system_issue' => $request->input('system_free_issue'),
        'system_qualified' => $request->input('system_qualified'),
        'howmany_injections' => $request->input('channelCount'),
        'column_id' => $request->input('column_description'),
        'guard_column_id' => $request->input('guard_column_description'),
        'type_samples' => $request->input('type_of_samples'),

    ]);
    

    // Récupérer l'ID de l'enregistrement créé
    $manipulationId = $manipulation->id;
    // Sauvegarder l'ID dans une variable de session
    session(['manipulation_id' => $manipulationId]);

    //récupérer le nombre de description de channels :
    $channelCount = $request->input('channelCount');

    // Boucler pour insérer chaque description de canal
    for ($i = 1; $i <= $channelCount; $i++) 
    {
        // Construire dynamiquement le nom de l'input pour chaque description de canal
        $description = $request->input("channel_description_".$i);
        //dd($description);
        // Insérer dans la table channels_descriptions
        ChannelsDescription::create([
            'description' => $description,
            'manipulation_id' => $manipulationId,
            'channel_number' => $i, // Numéro du canal (1, 2, etc.)
        ]);
    }
    


    // Rediriger vers la vue `chrono` après l'enregistrement
    return view('chrono');
})->name('submit_before'); // Déplacement de ->name() avant le point-virgule






