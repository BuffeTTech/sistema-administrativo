<?php

namespace Database\Factories;

use App\Enums\DocumentType;
use App\Enums\UserStatus;
use App\Models\Address;
use App\Models\Phone;
use App\Models\Representative;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'document' => Str::random(10),
            'document_type' => DocumentType::CPF->name,
            'status' => fake()->randomElement(array_column(UserStatus::cases(), 'name')),
            'remember_token' => Str::random(10),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            $roles = ['commercial', 'representative', 'administrative'];
            $role_chosed = fake()->randomElement($roles);

            $phone1 = Phone::create([
                'number'=>fake()->phoneNumber()
            ]);
            $phone2 = Phone::create([
                'number'=>fake()->phoneNumber()
            ]);
            $address = Address::create([
                "zipcode"=>fake()->postcode(),
                "adress"=>fake()->streetName(),
                "number"=>fake()->buildingNumber(),
                "neighborhood"=>fake()->secondaryAddress(),
                "state"=>fake()->state(),
                "city"=>fake()->city(),
                "country"=>fake()->country(),
            ]);

            $user->update([
                'phone1'=>$phone1->id,
                'phone2'=>$phone2->id,
                // 'address'=>$address->id,
            ]);

            if($role_chosed == "representative") {
                Representative::create(['user_id'=>$user->id]);                
            }

            $user->assignRole($role_chosed);
        });
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
