<?php

use App\Http\Controllers\CaregiverController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\HabitatController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\SpecieController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::resource('caregivers', CaregiverController::class);
    Route::resource('guides', GuideController::class);
    Route::resource('habitats', HabitatController::class);
    Route::resource('itineraries', ItineraryController::class);
    Route::resource('species', SpecieController::class);
    Route::resource('zones', ZoneController::class);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
