<?php

namespace Database\Seeders;

use App\Enums\DocumentType;
use App\Enums\UserStatus;
use App\Models\Commercial;
use App\Models\Phone;
use App\Models\Representative;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phone = Phone::create(['number'=>'(19) 99999-9999']);
        $user = User::create([
            'name' => 'Guilherme',
            'email' => 'teste@teste.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'document_type'=>DocumentType::CPF->name,
            'document'=>'619.775.410-03',
            'status'=>UserStatus::ACTIVE->name,
            'phone1'=>$phone->id
        ]);
        $user->assignRole('administrative');

        $phone = Phone::create(['number'=>'(19) 99999-9999']);
        $administrative= User::create([
            'name' => 'Administrativo',
            'email' => 'administracao@buffettech.com.br',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'document_type'=>DocumentType::CPF->name,
            'document'=>'971.341.540-09',
            'status'=>UserStatus::ACTIVE->name
        ]);
        $administrative->assignRole('administrative');
      
        $phone = Phone::create(['number'=>'(19) 99999-9999']);
        $representative = User::create([
            'name' => 'Guilherme',
            'email' => 'representante@buffettech.com.br',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
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
            'email' => 'comercial@buffettech.com.br',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'document_type'=>DocumentType::CNPJ->name,
            'document'=>'16.900.860/0001-11',
            'status'=>UserStatus::ACTIVE->name,
            'phone1'=>$phone_commercial->id
        ]);
        $representative->assignRole('commercial');
        $representative_table = Commercial::create(['user_id'=>$representative->id]);

        // User::factory()->count(70)->create();

        // Fake Data
        $phone = Phone::create(['number'=>'(19) 99999-9999']);
        $user = User::create([
            'name' => 'Andrade',
            'email' => 'andrade@buffettech.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'document_type'=>DocumentType::CPF->name,
            'document'=>'786.488.220-09',
            'status'=>UserStatus::ACTIVE->name,
            'phone1'=>$phone->id
        ]);
        $user->assignRole('administrative');

        $phone = Phone::create(['number'=>'(19) 99999-9999']);
        $user = User::create([
            'name' => 'Luiza',
            'email' => 'luiza@buffettech.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'document_type'=>DocumentType::CPF->name,
            'document'=>'107.699.920-48',
            'status'=>UserStatus::ACTIVE->name,
            'phone1'=>$phone->id
        ]);
        $user->assignRole('administrative');

        $phone = Phone::create(['number'=>'(19) 99999-9999']);
        $user = User::create([
            'name' => 'Ximenes',
            'email' => 'ximenes@buffettech.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'document_type'=>DocumentType::CPF->name,
            'document'=>'453.075.070-11',
            'status'=>UserStatus::ACTIVE->name,
            'phone1'=>$phone->id
        ]);
        $user->assignRole('administrative');
    }
}
