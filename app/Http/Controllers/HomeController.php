<?php

namespace App\Http\Controllers;

use App\Models\Audio;
use App\Models\Schadule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $backgrounds = Storage::disk('bg')->allFiles();

        $schadules = Schadule::whereHas('times', function ($q) {
            return $q->whereTime('time', date('00:00:00'))->where('day', date('l'));
        })->where('status', true)->first();
        // $schadules = Schadule::whereHas('times', function ($q) {
        //     return $q->whereTime('time', date('H:i:00'))->where('day', date('l'));
        // })->where('status', true)->first();

        $dirAudio = [];
        if (!is_null($schadules)) {
            foreach ($schadules->audio as $key => $value) {
                $file = Storage::path("public/audio/$value->name");

                if (File::exists($file)) {
                    $dirAudio[] =  [
                        'name' => $value->name,
                        'audio' => asset("storage/audio/$value->name"),
                        'cover' => asset('bg') . '/' . $backgrounds[array_rand($backgrounds)],
                        'id' => $key,
                        'artist' => 'Dani fahmy rosyid'
                    ];
                }
            }
        }

        if ($schadules->shuffle) {
            shuffle($dirAudio);
        }


        if (count($dirAudio) < 1) {
            return view('notfound');
        }
        return view('audio', compact('dirAudio', 'schadules'));
    }
}
