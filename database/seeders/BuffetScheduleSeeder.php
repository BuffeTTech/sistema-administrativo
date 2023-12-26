<?php

namespace Database\Seeders;

use App\Models\BuffetSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuffetScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BuffetSchedule::factory()->count(15)->create();
    }
}
