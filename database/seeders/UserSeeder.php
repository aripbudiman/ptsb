<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password'=>bcrypt(12345678),
            'avatar'=>'default.png',
            'role'=>'admin',
        ]);
        \App\Models\User::factory(10)->create();
    }
}
