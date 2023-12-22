<?php

namespace Database\Factories;

use App\Enums\BuffetStatus;
use App\Enums\UserStatus;
use App\Models\Address;
use App\Models\Buffet;
use App\Models\Phone;
use App\Models\User;
use Faker\Provider\pt_BR\Company;
use Faker\Provider\pt_BR\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buffet>
 */
class BuffetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new Person($this->faker));
        $this->faker->addProvider(new Company($this->faker));
        $users = User::pluck('id')->where('status', UserStatus::ACTIVE->name)->toArray();

        return [
            'trading_name' => $this->faker->name(),
            'email' => fake()->unique()->safeEmail(),
            'document' => $this->faker->cnpj(),
            'owner_id'=>fake()->randomElement($users),
            'status' => fake()->randomElement(array_column(BuffetStatus::cases(), 'name')),
        ];
    }
    public function configure():static
    {
        return $this->afterCreating(function(Buffet $buffet){
            $phone1 = Phone::create([
                'number'=>fake()->phoneNumber()
            ]);
            $phone2 = Phone::create([
                'number'=>fake()->phoneNumber()
            ]);
            $address = Address::create([
                "zipcode"=>fake()->postcode(),
                "street"=>fake()->streetName(),
                "number"=>fake()->buildingNumber(),
                "neighborhood"=>fake()->secondaryAddress(),
                "state"=>fake()->state(),
                "city"=>fake()->city(),
                "country"=>fake()->country(),
                "complement"=>""
            ]);
            $buffet->update([
                'phone1'=>$phone1->id,
                'phone2'=>$phone2->id,
                'address'=>$address->id,
            ]);
        });
    }
}
