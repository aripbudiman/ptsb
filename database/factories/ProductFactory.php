<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'category_id'=> $this->faker->numberBetween(1, 10),
            'price' => $this->faker->numberBetween(10000, 1000000),
            'image'=> $this->faker->imageUrl(),
        ];
    }
}
