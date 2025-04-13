<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Carlos Alexandre',
            'email' => config('user.default_root_email'),
            'password' => Hash::make(config('user.default_root_password')),
        ]);
    }
}
