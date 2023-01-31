<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerSchadule extends Model
{
    use HasFactory;

    protected $fillable = [
        'subuh',
        'dhuhur',
        'ashar',
        'manggrip',
        'isya',
        'date'
    ];
}
