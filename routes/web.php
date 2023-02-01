<?php

use App\Http\Controllers\AudioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PraySchaduleController;
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


Route::get('/', [HomeController::class, 'index']);
Route::middleware('auth')->group(function () {
    Route::resource('schadules', SchaduleController::class);
    Route::resource('audio', AudioController::class)->except('show');

    Route::get('schadules/{id}/toggle', [SchaduleController::class, 'toggle'])->name('schadules.toggle');
    Route::get('praying', [PraySchaduleController::class, 'index'])->name('pray.index');
    Route::post('praying', [PraySchaduleController::class, 'changeAudio'])->name('pray.changeAudio');
});
