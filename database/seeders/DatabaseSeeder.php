<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GeneralInfoSeeder::class,
            UserSeeder::class,
            LinkSeeder::class,
            SocialNetworkSeeder::class,
        ]);
    }
}
