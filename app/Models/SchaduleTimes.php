<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchaduleTimes extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'schadule_id',
        'day',
        'time',
    ];
}
