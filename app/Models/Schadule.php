<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schadule extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'duration',
        'status'
    ];

    public function times()
    {
        return $this->hasMany(SchaduleTimes::class);
    }

    public function audio()
    {
        return $this->belongsToMany(Audio::class, SchaduleDetail::class);
    }

    public function details()
    {
        return $this->hasMany(SchaduleDetail::class);
    }
}
