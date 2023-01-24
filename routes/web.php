<?php

use App\Http\Controllers\AudioController;
use App\Http\Controllers\SchaduleController;
use App\Models\Audio;
use App\Models\Schadule;
use App\Models\SchaduleDetail;
use App\Models\SchaduleTimes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('schadules.index');
    }
    return view('auth.login');
});
Route::get('audio-testing', function () {

    $backgrounds = Storage::disk('bg')->allFiles();

    $audio = Audio::all();
    $dirAudio = [];
    foreach ($audio as $key => $value) {
        $file = Storage::path("public/audio/$value->name");

        if (File::exists($file)) {
            $dirAudio[] =  [
                'name' => $value->name,
                'audio' => asset("storage/audio/$value->name"),
                'cover' => asset('bg') . '/' . $backgrounds[array_rand($backgrounds)],
                'id' => $key,
                'artist' => 'dani fahmy rosyid'
            ];
        }
    }

    return view('audio', compact('dirAudio'));
});

Route::resource('schadules', SchaduleController::class)->middleware('auth');
Route::resource('audio', AudioController::class)->except('show')->middleware('auth');
Route::get('schadules/{id}/toggle', [SchaduleController::class, 'toggle'])
    ->middleware('auth')->name('schadules.toggle');
