<?php

use App\Http\Controllers\CaregiverController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\HabitatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\SpecieController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ HomeController::class, 'index' ])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::resource('caregivers', CaregiverController::class);
    Route::resource('guides', GuideController::class);
    Route::resource('habitats', HabitatController::class);
    Route::resource('itineraries', ItineraryController::class);
    Route::resource('species', SpecieController::class);
    Route::resource('zones', ZoneController::class);

    Route::post('/specie/caregiver', [ SpecieController::class, 'storeWithCaregiver' ])->name('specie.caregiver.store');
});


Auth::routes();

Route::get('/home', [ HomeController::class, 'index' ])->name('home');
