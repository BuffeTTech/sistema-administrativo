<?php

namespace Database\Seeders;

use App\Models\Handout;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HandoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $handout = Handout::factory()->create([
            'title' => 'Primeiro comunicado',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi at metus luctus massa pretium facilisis. Aliquam in ultrices velit, id consequat risus. Nullam vitae tellus ultricies libero blandit rhoncus eu dictum est. Nunc non sem faucibus, molestie orci at, rutrum massa. Donec sed aliquet metus. Sed in laoreet diam, eget euismod dui. Suspendisse iaculis tempor semper.',
            'send_in' => now(),
            'author_id' => 1
        ]);

        Handout::factory()->count(15)->create();
    }
}
