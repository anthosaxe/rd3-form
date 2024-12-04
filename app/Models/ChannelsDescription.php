<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelsDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'description',
        'manipulation_id',
        'channel_number',
    ];
}
