<?php

use App\Http\Controllers\BuffetController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\HandoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepresentativeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('landing_page');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('representative', RepresentativeController::class);
    Route::resource('buffet', BuffetController::class);
    Route::resource('commercial', CommercialController::class);
    Route::resource('handout', HandoutController::class);
});




require __DIR__.'/auth.php';
