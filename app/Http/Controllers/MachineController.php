<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    /**
     * Display a listing of the machines.
     */
    public function index()
    {
        $machines = Machine::all();
        return response()->json($machines);
    }

    /**
     * Store a newly created machine in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'local' => 'required|string|max:255',
        ]);

        $machine = Machine::create($validatedData);

        return response()->json($machine, 201);
    }

    /**
     * Display the specified machine.
     */
    public function show(Machine $machine)
    {
        return response()->json($machine);
    }

    /**
     * Update the specified machine in storage.
     */
    public function update(Request $request, Machine $machine)
    {
        $validatedData = $request->validate([
            'nom' => 'sometimes|string|max:255',
            'local' => 'sometimes|string|max:255',
        ]);

        $machine->update($validatedData);

        return response()->json($machine);
    }

    /**
     * Remove the specified machine from storage.
     */
    public function destroy(Machine $machine)
    {
        $machine->delete();

        return response()->json(null, 204);
    }
}

