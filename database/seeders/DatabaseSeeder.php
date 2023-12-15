<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\DocumentType;
use App\Models\User;
use Illuminate\Database\Seeder;
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
        ]);
        // \App\Models\User::factory(10)->create();

        $administrative= User::factory()->create([
            'name' => 'Administrativo',
            'email' => 'administracao@buffets.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$d1GtfTTungciG2JXfgIHyuUv61Z7aJU736cdXxvfvgxVpPXVjY99C', // password = 'teste123'
            'remember_token' => Str::random(10),
            'document_type'=>DocumentType::CPF->name,
            'document'=>'971.341.540-09',
        ]);
        $administrative->assignRole('administrative');

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
