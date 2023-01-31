<?php

use App\Http\Controllers\AudioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchaduleController;
use App\Models\Audio;
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

Route::get('/symlink', function () {
    $target = storage_path('app/public');
    $link = $_SERVER['DOCUMENT_ROOT'] . '/audio/storage';

    symlink($target, $link);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/testing', [SchaduleController::class, 'updatePraySchadule']);
Route::get('/mapping/audio', function () {
    $storage = Storage::files('public/audio');

    foreach ($storage as $key => $file) {
        $name = str_replace('public/audio/', '', $file);
        if (Audio::where('name', $name)->count() < 1) {
            Audio::create([
                'name' => $name
            ]);
        }
    }
});
Route::resource('schadules', SchaduleController::class)->middleware('auth');
Route::resource('audio', AudioController::class)->except('show')->middleware('auth');
Route::get('schadules/{id}/toggle', [SchaduleController::class, 'toggle'])
    ->middleware('auth')->name('schadules.toggle');
