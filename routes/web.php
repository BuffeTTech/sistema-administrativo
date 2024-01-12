<?php

use App\Events\BuffetCreatedEvent;
use App\Http\Controllers\BuffetController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\HandoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\Address;
use App\Models\Buffet;
use App\Models\BuffetSubscription;
use App\Models\Phone;
use App\Models\Subscription;
use App\Models\User;

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

    Route::get('/auth/create-buffet/subscription', [BuffetController::class, 'create_select_subscription_on_register'])->name('auth.buffet.select_subscription');
    Route::post('/auth/create-buffet/subscription', [BuffetController::class, 'store_select_subscription_on_register'])->name('auth.buffet.select_subscription');
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
    
    Route::get('/subscription', [SubscriptionController::class, 'subscriptions'])->name('buffet.subscription');
    Route::get('/subscription/create', [SubscriptionController::class, 'create_subscription'])->name('buffet.subscription.create');
    Route::post('/subscription', [SubscriptionController::class, 'store_subscription'])->name('buffet.subscription.store');
    Route::get('/subscription/{subscription}', [SubscriptionController::class, 'show_subscription'])->name('buffet.subscription.show');
    Route::get('/subscription/{subscription}/edit', [SubscriptionController::class, 'edit_subscription'])->name('buffet.subscription.edit');
    Route::put('/subscription/{subscription}', [SubscriptionController::class, 'update_subscription'])->name('buffet.subscription.update');
    
});

Route::get('/teste', function() {
    $user_data = [
        'name' => "fodinha",
        'email' => "dasd@dasd",
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'document' => "fodinha",
        'document_type' => 'CPF',
        'status' => "ACTIVE",
        'remember_token' => "aaaaaaaaaa",
    ];
    $user = User::where('email', $user_data['email'])->get()->first();
    if(!$user) {
        $user = User::create($user_data);

        $user_phone1 = Phone::create([
            'number'=>"(19) 99999-9999"
        ]);
        $user_phone2 = Phone::create([
            'number'=>"(19) 99999-9999"
        ]);
        $user_address = Address::create([
            "zipcode"=>'13063-000',
            "street"=>'rua dos fodinhas',
            "number"=>220,
            "neighborhood"=>'jardim dos fodas',
            "state"=>'SP',
            "city"=>'Campinas',
            "country"=>'Brasil',
            "complement"=>""
        ]);
        $user->update([
            'phone1'=>$user_phone1->id,
            'phone2'=>$user_phone2->id,
            'address'=>$user_address->id,
        ]);
        $user->assignRole('buffet');

    }

    $data = [
        'trading_name' => 'sdadas',
        'email' => fake()->unique()->safeEmail(),
        'slug' => 'buffet-fodalegria',
        'document' => '39.303.604/0001-44',
        'owner_id'=>$user->id,
        'status' => "ACTIVE",
    ];
    $buffet = Buffet::where('slug', $data['slug'])->get()->first();
    if(!$buffet) {
        $buffet = Buffet::create($data);
        $phone1 = Phone::create([
            'number'=>"(19) 99999-9999"
        ]);
        $phone2 = Phone::create([
            'number'=>"(19) 99999-9999"
        ]);
        $address = Address::create([
            "zipcode"=>'13063-000',
            "street"=>'rua dos fodinhas',
            "number"=>220,
            "neighborhood"=>'jardim dos fodas',
            "state"=>'SP',
            "city"=>'Campinas',
            "country"=>'Brasil',
            "complement"=>""
        ]);
        $buffet->update([
            'phone1'=>$phone1->id,
            'phone2'=>$phone2->id,
            'address'=>$address->id,
        ]);
        $subscription = Subscription::latest()->first();
        $buffet_subscription = BuffetSubscription::create([
            'buffet_id'=>$buffet->id,
            'subscription_id'=>$subscription->id
        ]);
    }

    $buffet_subscription = BuffetSubscription::where('buffet_id', $buffet->id)->get()->first();
    $subscription = Subscription::where('id', $buffet_subscription->subscription_id)->get()->first();
    event(new BuffetCreatedEvent(buffet: $buffet, buffet_subscription: $buffet_subscription, subscription: $subscription));
    
});

require __DIR__.'/auth.php';
