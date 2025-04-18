<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Direction>
 */
class DirectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Direction::class;
    public function definition(): array
    {
        return [
            'libelle' => $this->faker->sentence(5), 
            'code' => $this->faker->unique()->word,
        ];
    }
}
