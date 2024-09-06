<?php

namespace Database\Factories;

use App\Enums\BookingStatus;
use App\Enums\BuffetStatus;
use App\Enums\ScheduleStatus;
use App\Enums\UserStatus;
use App\Models\Booking;
use App\Models\Buffet;
use App\Models\BuffetSchedule;
use App\Models\User;
use Carbon\Carbon;
use Faker\Provider\pt_BR\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new Person($this->faker));
        $buffet_schedules = BuffetSchedule::where('status', ScheduleStatus::ACTIVE->name)->pluck('id')->toArray();
        $buffet = Buffet::where('status', BuffetStatus::ACTIVE->name)->pluck('id')->toArray();

        return [
            'name_birthdayperson' => $this->faker->name(),
            'years_birthdayperson' => fake()->numberBetween(1,100),
            'num_guests'=> fake()->numberBetween(20,70),
            'party_day'=> fake()->dateTimeThisYear('+4 weeks'),
            'schedule_id'=>fake()->randomElement($buffet_schedules),
            'status'=>fake()->randomElement(array_column(BookingStatus::cases(),'name')),
            'price'=>fake()->randomFloat(2,2000,7000),
            'buffet_id'=>fake()->randomElement($buffet),
            'discount'=>fake()->randomFloat(1,0,50)
        ];
    }

    public function current() {
        $dataAgora = Carbon::now()->locale('pt-BR');

        return $this->state(fn (array $attributes) => [
            'party_day' => $dataAgora
        ]);
    }
}
