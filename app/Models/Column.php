<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;
    // Liste des champs autorisés pour l'attribution de masse
    protected $fillable = ['identifiant', 'type', 'chimie', 'dimension'];
}
