<?php

use App\Http\Controllers\AudioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchaduleController;
use Illuminate\Support\Facades\Route;
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

Route::resource('schadules', SchaduleController::class)->middleware('auth');
Route::resource('audio', AudioController::class)->except('show')->middleware('auth');
Route::get('schadules/{id}/toggle', [SchaduleController::class, 'toggle'])
    ->middleware('auth')->name('schadules.toggle');
