<?php

use App\Http\Controllers\BuffetController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\HandoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('landing_page');

// Route::get('/dashboard', [SiteController::class, 'dashboard'])->middleware(['auth', 'verified', 'buffet.created'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'buffet.created'])->name('dashboard');

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

    // Subscription
    Route::get('/subscription/roles', [SubscriptionController::class, 'roles'])->name('buffet.roles');
    Route::get('/subscription/roles/create', [SubscriptionController::class, 'create_role'])->name('buffet.roles.create');
    Route::post('/subscription/roles', [SubscriptionController::class, 'store_role'])->name('buffet.roles.store');
    Route::get('/subscription/roles/{role}', [SubscriptionController::class, 'show_role'])->name('buffet.roles.show');
    
    Route::get('/subscription/permissions', [SubscriptionController::class, 'permissions'])->name('buffet.permissions');
    Route::get('/subscription/permissions/{permission}', [SubscriptionController::class, 'show_permission'])->name('buffet.permissions.show');
    Route::patch('/subscription/permissions/{permission}', [SubscriptionController::class, 'add_role'])->name('buffet.permissions.add_role');
    
    Route::get('/subscription', [SubscriptionController::class, 'subscriptions'])->name('buffet.subscription');
    Route::get('/subscription/create', [SubscriptionController::class, 'create_subscription'])->name('buffet.subscription.create');
    Route::post('/subscription', [SubscriptionController::class, 'store_subscription'])->name('buffet.subscription.store');
    Route::get('/subscription/{subscription}', [SubscriptionController::class, 'show_subscription'])->name('buffet.subscription.show');
    Route::get('/subscription/{subscription}/edit', [SubscriptionController::class, 'edit_subscription'])->name('buffet.subscription.edit');
    Route::put('/subscription/{subscription}', [SubscriptionController::class, 'update_subscription'])->name('buffet.subscription.update');
    
});




require __DIR__.'/auth.php';
