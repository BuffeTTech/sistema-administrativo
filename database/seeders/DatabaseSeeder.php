<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\DocumentType;
use App\Enums\UserStatus;
use App\Models\Phone;
use App\Models\Representative;
use App\Models\User;
use Database\Factories\HandoutFactory;
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

        // $administrative= User::factory()->create([
        //     'name' => 'Administrativo',
        //     'email' => 'administracao@buffets.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$d1GtfTTungciG2JXfgIHyuUv61Z7aJU736cdXxvfvgxVpPXVjY99C', // password = 'teste123'
        //     'remember_token' => Str::random(10),
        //     'document_type'=>DocumentType::CPF->name,
        //     'document'=>'971.341.540-09',
        //     'status'=>UserStatus::ACTIVE->name
        // ]);
        // $administrative->assignRole('administrative');
      
        // $phone = Phone::create(['number'=>'(19) 99999-9999']);
        // $representative = User::factory()->create([
        //     'name' => 'Guilherme',
        //     'email' => 'teste@teste.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$d1GtfTTungciG2JXfgIHyuUv61Z7aJU736cdXxvfvgxVpPXVjY99C', // password = 'teste123'
        //     'remember_token' => Str::random(10),
        //     'document_type'=>DocumentType::CPF->name,
        //     'document'=>'895.391.260-10',
        //     'status'=>UserStatus::ACTIVE->name,
        //     'phone1'=>$phone->id
        // ]);
        // $representative->assignRole('representative');
        // $representative_table = Representative::create(['user_id'=>$representative->id]);

        User::factory()->count(30)->create();
      
        // $handout = Handout::factory()->create([
        //     'title' => 'Primeiro comunicado',
        //     'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at metus luctus massa pretium facilisis. Aliquam in ultrices velit, id consequat risus. Nullam vitae tellus ultricies libero blandit rhoncus eu dictum est. Nunc non sem faucibus, molestie orci at, rutrum massa. Donec sed aliquet metus. Sed in laoreet diam, eget euismod dui. Suspendisse iaculis tempor semper.'
        // ]);
    }
}
