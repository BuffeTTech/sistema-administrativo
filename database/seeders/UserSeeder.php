<?php

namespace Database\Seeders;

use App\Enums\DocumentType;
use App\Enums\UserStatus;
use App\Models\Commercial;
use App\Models\Phone;
use App\Models\Representative;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrative= User::create([
            'name' => 'Administrativo',
            'email' => 'administracao@buffets.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$d1GtfTTungciG2JXfgIHyuUv61Z7aJU736cdXxvfvgxVpPXVjY99C', // password = 'teste123'
            'remember_token' => Str::random(10),
            'document_type'=>DocumentType::CPF->name,
            'document'=>'971.341.540-09',
            'status'=>UserStatus::ACTIVE->name
        ]);
        $administrative->assignRole('administrative');
      
        $phone = Phone::create(['number'=>'(19) 99999-9999']);
        $representative = User::create([
            'name' => 'Guilherme',
            'email' => 'teste@teste.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$d1GtfTTungciG2JXfgIHyuUv61Z7aJU736cdXxvfvgxVpPXVjY99C', // password = 'teste123'
            'remember_token' => Str::random(10),
            'document_type'=>DocumentType::CPF->name,
            'document'=>'895.391.260-10',
            'status'=>UserStatus::ACTIVE->name,
            'phone1'=>$phone->id
        ]);
        $representative->assignRole('representative');
        $representative_table = Representative::create(['user_id'=>$representative->id]);
        
        $phone_commercial = Phone::create(['number'=>'(19) 99999-9999']);
        $representative = User::create([
            'name' => 'Guilherme',
            'email' => 'comercial@teste.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$d1GtfTTungciG2JXfgIHyuUv61Z7aJU736cdXxvfvgxVpPXVjY99C', // password = 'teste123'
            'remember_token' => Str::random(10),
            'document_type'=>DocumentType::CNPJ->name,
            'document'=>'16.900.860/0001-11',
            'status'=>UserStatus::ACTIVE->name,
            'phone1'=>$phone_commercial->id
        ]);
        $representative->assignRole('commercial');
        $representative_table = Commercial::create(['user_id'=>$representative->id]);

        User::factory()->count(70)->create();
    }
}
