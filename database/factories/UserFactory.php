<?php

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;


class UserFactory extends Factory
{
    protected static ?string $password;
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'role'=>'employee',
            'avatar'=>'default.png',
            'password' => bcrypt(12345678),
            'remember_token' => Str::random(10),
            'branch_id' => Branch::all()->random()->id
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
