<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {    
        return [
            'name' => $this->faker->word,
            'category_id' => Category::inRandomOrder()->first()->id,  
            'price' => $this->faker->randomFloat(2, 5, 1000),  
            'description' => $this->faker->paragraph,
            'images' => json_encode([$this->faker->imageUrl, $this->faker->imageUrl]), 
        ];
    }
}
