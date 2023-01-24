<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchaduleDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'audio_id',
        'schadule_id',
    ];
}
