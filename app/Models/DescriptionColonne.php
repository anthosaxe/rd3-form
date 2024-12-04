<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DescriptionColonne extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'identifiant',
        'type',
        'chimie',
        'dimension',
        'reference',
        'rince_solvent',
        'type_guard_colonne',
        'chimie_guard_colonne',
        'dimension_guard_colonne',
        'identifiant_guard_colonne',
        'reference_guard_colonne',
    ];

    /**
     * The manipulations that belong to the column.
     */
    public function manipulations(): BelongsToMany
    {
        return $this->belongsToMany(Manipulation::class, 'colonne_manipulation');
    }
}

