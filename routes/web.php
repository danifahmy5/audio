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
Route::get('/test-connection', [HomeController::class, 'testConnection']);
Route::middleware('auth')->group(function () {
    Route::resource('schadules', SchaduleController::class);
    Route::resource('audio', AudioController::class)->except('show');

    Route::get('schadules/{id}/toggle', [SchaduleController::class, 'toggle'])->name('schadules.toggle');
    Route::get('prayer', [PraySchaduleController::class, 'index'])->name('pray.index');
    Route::get('prayer/sync', [PraySchaduleController::class, 'updatePraySchaduleV2'])->name('pray.sync');
    Route::post('prayer', [PraySchaduleController::class, 'changeAudio'])->name('pray.changeAudio');
});
