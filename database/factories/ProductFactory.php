<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => Str::random(8),
            'name' => $this->faker->word,
            'description' => $this->faker->word,
            'price' => mt_rand(100, 1000),
            'discount' => mt_rand(0, 100),
            'quantity' => mt_rand(0, 100),
            'function' => $this->faker->word,
            'model_number' => Str::random(8),
            'comment' => $this->faker->word,
        ];
    }
}
