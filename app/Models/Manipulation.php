<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Manipulation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_manip',
        'system_issue',
        'system_qualified',
        'type_samples',
        'rinsing_method',
        'howmany_injections',
        'issue_after_manip',
        'users_id',
        'machines_id',
        'column_id',
        'guard_column_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'system_issue' => 'boolean',
        'system_qualified' => 'boolean',
        'howmany_injections' => 'integer',
    ];

    /**
     * Get the user that owns the manipulation.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The channels that belong to the manipulation.
     */
    public function channels(): BelongsToMany
    {
        return $this->belongsToMany(Channel::class, 'channel_manipulation');
    }

    /**
     * The columns that belong to the manipulation.
     */
    public function descriptionsColonnes(): BelongsToMany
    {
        return $this->belongsToMany(DescriptionColonne::class, 'colonne_manipulation');
    }
}

