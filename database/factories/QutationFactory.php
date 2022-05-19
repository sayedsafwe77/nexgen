<?php

namespace Database\Factories;

use App\Models\Qutation;
use Illuminate\Database\Eloquent\Factories\Factory;

class QutationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Qutation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
