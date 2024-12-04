<?php

namespace App\Http\Controllers;

use App\Models\Manipulation;
use Illuminate\Http\Request;

class ManipulationController extends Controller
{
    /**
     * Display a listing of the manipulations.
     */
    public function index()
    {
        $manipulations = Manipulation::all();
        return response()->json($manipulations);
    }

    /**
     * Store a newly created manipulation in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_de_manipulation' => 'required|string|max:255',
            'system_issue' => 'boolean',
            'system_qualified' => 'boolean',
            'type_samples' => 'required|string',
            'rinsing_method' => 'required|string',
            'howmany_injections' => 'required|integer',
            'issue_after_manip' => 'required|string',
        ]);

        $manipulation = Manipulation::create($validatedData);

        return response()->json($manipulation, 201);
    }

    /**
     * Display the specified manipulation.
     */
    public function show(Manipulation $manipulation)
    {
        return response()->json($manipulation);
    }

    /**
     * Update the specified manipulation in storage.
     */
    public function update(Request $request, Manipulation $manipulation)
    {
        $validatedData = $request->validate([
            'nom_de_manipulation' => 'sometimes|string|max:255',
            'system_issue' => 'boolean',
            'system_qualified' => 'boolean',
            'type_samples' => 'sometimes|string',
            'rinsing_method' => 'sometimes|string',
            'howmany_injections' => 'sometimes|integer',
            'issue_after_manip' => 'sometimes|string',
        ]);

        $manipulation->update($validatedData);

        return response()->json($manipulation);
    }

    /**
     * Remove the specified manipulation from storage.
     */
    public function destroy(Manipulation $manipulation)
    {
        $manipulation->delete();

        return response()->json(null, 204);
    }
}

