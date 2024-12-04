<?php

namespace App\Http\Controllers;

use App\Models\Solvent;
use Illuminate\Http\Request;

class SolventController extends Controller
{
    /**
     * Display a listing of the solvents.
     */
    public function index()
    {
        $solvents = Solvent::all();
        return response()->json($solvents);
    }

    /**
     * Store a newly created solvent in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $solvent = Solvent::create($validatedData);

        return response()->json($solvent, 201);
    }

    /**
     * Display the specified solvent.
     */
    public function show(Solvent $solvent)
    {
        return response()->json($solvent);
    }

    /**
     * Update the specified solvent in storage.
     */
    public function update(Request $request, Solvent $solvent)
    {
        $validatedData = $request->validate([
            'nom' => 'sometimes|string|max:255',
        ]);

        $solvent->update($validatedData);

        return response()->json($solvent);
    }

    /**
     * Remove the specified solvent from storage.
     */
    public function destroy(Solvent $solvent)
    {
        $solvent->delete();

        return response()->json(null, 204);
    }
}

