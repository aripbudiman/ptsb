<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'branch_id' => $this->faker->numberBetween(1, 5),
            'category_id' => $this->faker->numberBetween(1, 6),
            'price' => $this->faker->randomFloat(2, 10000, 1000000),
            'image'=> $this->faker->imageUrl(640, 480, 'cats', true),
        ];
    }
}
