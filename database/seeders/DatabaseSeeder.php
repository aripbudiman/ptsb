<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BranchSeeder::class);
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password'=>bcrypt(12345678),
            'avatar'=>'default.png',
            'role'=>'admin',
        ]);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
