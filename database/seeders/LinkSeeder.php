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
            ['name' => 'github', 'url' => 'https://github.com/devc4rlos'],
            ['name' => 'linkedin', 'url' => 'https://linkedin.com/in/devc4rlos'],
            ['name' => 'whatsapp', 'url' => 'https://api.whatsapp.com/send?phone=5511994411592'],
            ['name' => 'facebook', 'url' => 'https://www.facebook.com/devc4rlos'],
            ['name' => 'instagram', 'url' => 'https://www.instagram.com/devc4rlos'],
            ['name' => 'x', 'url' => 'https://x.com/devc4rlos'],
            ['name' => 'telegram', 'url' => 'https://t.me/devc4rlos'],
        ]);
    }
}
