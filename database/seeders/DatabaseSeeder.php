<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\BuffetStatus;
use App\Enums\DocumentType;
use App\Enums\UserStatus;
use App\Events\BuffetCreatedEvent;
use App\Models\Address;
use App\Models\Buffet;
use App\Models\BuffetSubscription;
use App\Models\Phone;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            HandoutSeeder::class,
            BuffetSeeder::class,
            BuffetScheduleSeeder::class,
            BookingSeeder::class,
            SubscriptionSeeder::class
        ]);

        $phone = Phone::create(['number'=>'(19) 99999-9999']);
        $user = User::create([
            'name' => 'José',
            'email' => 'josé@dono.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password = 'teste123'
            'remember_token' => Str::random(10),
            'document_type'=>DocumentType::CPF->name,
            'document'=>'393.492.780-73',
            'status'=>UserStatus::ACTIVE->name,
            'phone1'=>$phone->id
        ]);
        $user->assignRole('buffet');
        
        $buffet_alegria_address = Address::create([
            "zipcode"=>fake()->postcode(),
            "street"=>fake()->streetName(),
            "number"=>fake()->buildingNumber(),
            "neighborhood"=>fake()->secondaryAddress(),
            "state"=>fake()->state(),
            "city"=>fake()->city(),
            "country"=>fake()->country(),
            "complement"=>""
        ]);
      
        $buffet_alegria_phone1 = Phone::create(['number'=>'(19) 99999-9999']);
      
        $buffet_alegria = Buffet::create([
            'trading_name' => 'Buffet Alegria',
            'email' => 'buffet@alegria.com',
            'slug' => 'buffet-alegria',
            'document' => "47.592.257/0001-43",
            'owner_id' => $user->id,
            'status' => BuffetStatus::ACTIVE->name,
            'phone1'=>$buffet_alegria_phone1->id,
            'address'=>$buffet_alegria_address->id
        ]);
        $subscription = Subscription::where('slug', 'pacote-basico')->get()->first();
        $buffet_subscription = BuffetSubscription::create([
            'buffet_id'=>$buffet_alegria->id,
            'subscription_id'=>$subscription->id,
            'expires_in'=>Carbon::now()->addMonth(3)
        ]);
        event(new BuffetCreatedEvent(buffet: $buffet_alegria, subscription: $subscription, buffet_subscription: $buffet_subscription));
    }
}
