<?php

namespace Database\Seeders;

use App\Models\SocialNetwork;
use Illuminate\Database\Seeder;

class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialNetwork::factory()->createMany([
            [
                'name' => 'facebook',
                'url' => 'https://www.facebook.com/devc4rlos',
                'icon' => 'https://carlosalexandre.com.br/assets/icons/facebook.png',
                'text' => 'Facebook',
            ],
            [
                'name' => 'x',
                'url' => 'https://x.com/devc4rlos',
                'icon' => 'https://carlosalexandre.com.br/assets/icons/x.png',
                'text' => 'X',
            ],
            [
                'name' => 'whatsapp',
                'url' => 'https://api.whatsapp.com/send?phone=5511994411592',
                'icon' => 'https://carlosalexandre.com.br/assets/icons/whatsapp.png',
                'text' => 'Whatsapp',
            ],
            [
                'name' => 'instagram',
                'url' => 'https://instagram.com/devc4rlos',
                'icon' => 'https://carlosalexandre.com.br/assets/icons/instagram.png',
                'text' => 'Instagram',
            ],
            [
                'name' => 'telegram',
                'url' => 'https://telegram.me/devc4rlos',
                'icon' => 'https://carlosalexandre.com.br/assets/icons/telegram.png',
                'text' => 'Telegram',
            ]
        ]);
    }
}
