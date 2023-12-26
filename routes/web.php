<?php

use App\Http\Controllers\BuffetController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\HandoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\SiteController;
use App\Http\Middleware\EnsureCreateBuffet;
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

Route::get('/dashboard', [SiteController::class, 'dashboard'])->middleware(['auth', 'verified', 'buffet.created'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'buffet.created'])->name('dashboard');

Route::middleware(['auth', 'verified', 'buffet.not_created'])->group(function(){
    Route::get('/auth/create-buffet', [BuffetController::class, 'create_on_register'])->name('auth.buffet.create');
    Route::post('/auth/create-buffet', [BuffetController::class, 'store_on_register'])->name('auth.buffet.store');
    
    Route::get('/auth/create-buffet/payment', [BuffetController::class, 'create_payment_on_register'])->name('auth.buffet.create_payment');
    Route::post('/auth/create-buffet/payment', [BuffetController::class, 'store_payment_on_register'])->name('auth.buffet.store_payment');
});


Route::middleware(['auth', 'verified', 'buffet.created'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('representative', RepresentativeController::class);
    Route::resource('buffet', BuffetController::class);
    Route::resource('commercial', CommercialController::class);
    Route::resource('handout', HandoutController::class);
});




require __DIR__.'/auth.php';
