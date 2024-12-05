<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manipulation;
use App\Models\ChannelsDescription;

class batcontrol extends Controller
{
    public function batlaunch(Request $request)
    {
        // 1. Valider les données du formulaire
        $validatedData = $request->validate([
            'manipulation_name' => ['required', function ($attribute, $value, $fail) {
                if (strlen(trim($value)) < 3) {
                    $fail('Please complete this field with at least 3 characters.');
                }
            }],
            'user' => 'required|integer|exists:users,id',
            'system_free_issue' => 'required|in:yes,no',
            'system_qualified' => 'required|in:yes,no',
            'channelCount' => 'required|integer|min:1|max:4',
            'type_of_samples' => 'required|string',
        ]);

        // 2. Enregistrement des données dans la base
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

        // Récupérer l'ID et le stocker en session
        $manipulationId = $manipulation->id;
        session(['manipulation_id' => $manipulationId]);

        // Insérer les descriptions de canaux
        $channelCount = $request->input('channelCount');
        for ($i = 1; $i <= $channelCount; $i++) {
            $description = $request->input("channel_description_" . $i);
            ChannelsDescription::create([
                'description' => $description,
                'manipulation_id' => $manipulationId,
                'channel_number' => $i,
            ]);
        }

        // 3. Exécution du fichier batch
        $batchFile = storage_path('app/private/script.bat');
        if (!file_exists($batchFile)) {
            return redirect()->back()->withErrors(['batch_error' => 'Le script batch est introuvable.']);
        }

        $output = null;
        $resultCode = null;
        exec('"' . $batchFile . '"', $output, $resultCode);

        if ($resultCode !== 0) {
            return redirect()->back()->withErrors([
                'batch_error' => 'Le script batch a échoué. Code de retour : ' . $resultCode,
            ]);
        }

        // 4. Rediriger vers la vue après le batch
        return view('chrono')->with('success', 'Formulaire soumis et batch exécuté avec succès.');
    }
}
