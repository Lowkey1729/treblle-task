<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe9@gmail.com',
            'phone_number' => '+2349010768387',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);
    }
}
