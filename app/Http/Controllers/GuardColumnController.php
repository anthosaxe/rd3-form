<?php

namespace App\Http\Controllers;

use App\Models\GuardColumn;
use Illuminate\Http\Request;

class GuardColumnController extends Controller
{
    public function getAllGuardColumns()
    {
        $guardcolumns = GuardColumn::all(); // Récupère toutes les entrées de la table `columns`
        return response()->json($guardcolumns);
    }
}
