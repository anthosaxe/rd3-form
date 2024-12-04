<?php

namespace App\Http\Controllers;

use App\Models\DescriptionColonne;
use Illuminate\Http\Request;

class DescriptionColonneController extends Controller
{
    /**
     * Display a listing of the descriptions_colonnes.
     */
    public function index()
    {
        $descriptions = DescriptionColonne::all();
        return response()->json($descriptions);
    }

    /**
     * Store a newly created description_colonne in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'identifiant' => 'required|string',
            'type' => 'required|string',
            'chimie' => 'required|string',
            'dimension' => 'required|string',
            'reference' => 'required|string',
            'rince_solvent' => 'required|string',
            'type_guard_colonne' => 'required|string',
            'chimie_guard_colonne' => 'required|string',
            'dimension_guard_colonne' => 'required|string',
            'identifiant_guard_colonne' => 'required|string',
            'reference_guard_colonne' => 'required|string',
        ]);

        $descriptionColonne = DescriptionColonne::create($validatedData);

        return response()->json($descriptionColonne, 201);
    }

    /**
     * Display the specified description_colonne.
     */
    public function show(DescriptionColonne $descriptionColonne)
    {
        return response()->json($descriptionColonne);
    }

    /**
     * Update the specified description_colonne in storage.
     */
    public function update(Request $request, DescriptionColonne $descriptionColonne)
    {
        $validatedData = $request->validate([
            'identifiant' => 'sometimes|string',
            'type' => 'sometimes|string',
            'chimie' => 'sometimes|string',
            'dimension' => 'sometimes|string',
            'reference' => 'sometimes|string',
            'rince_solvent' => 'sometimes|string',
            'type_guard_colonne' => 'sometimes|string',
            'chimie_guard_colonne' => 'sometimes|string',
            'dimension_guard_colonne' => 'sometimes|string',
            'identifiant_guard_colonne' => 'sometimes|string',
            'reference_guard_colonne' => 'sometimes|string',
        ]);

        $descriptionColonne->update($validatedData);

        return response()->json($descriptionColonne);
    }

    /**
     * Remove the specified description_colonne from storage.
     */
    public function destroy(DescriptionColonne $descriptionColonne)
    {
        $descriptionColonne->delete();

        return response()->json(null, 204);
    }
}

