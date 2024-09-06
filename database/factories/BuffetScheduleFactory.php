<?php

namespace Database\Factories;

use App\Enums\ScheduleDay;
use App\Enums\ScheduleStatus;
use App\Models\Buffet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BuffetSchedule>
 */
class BuffetScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $buffet = Buffet::pluck('id')->toArray();

        return [
            'day'=> fake()->randomElement(array_column(ScheduleDay::cases(),'name')),
            'time' => fake()->time(), 
            'duration'=> fake()-> numberBetween(60,240), // em minutos 
            'blocked_in'=>null, //caso o buffet esteja em manutencao de dia x a y e sem festas 
            'blocked_until'=>null,
            'status'=> fake()->randomElement(array_column(ScheduleStatus::cases(),'name')),
            'buffet_id'=>fake()->randomElement($buffet),
        ];
    }
}
