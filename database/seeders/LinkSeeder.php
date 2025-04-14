<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Link::factory()->createMany([
            ['name' => 'portfolio', 'url' => 'https://carlosalexandre.com.br'],
            ['name' => 'api', 'url' => 'https://api.carlosalexandre.com.br'],
        ]);
    }
}
