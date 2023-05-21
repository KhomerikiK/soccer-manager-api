<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'position_id' => Position::factory(),
            'country_id' => Country::first(),
            'first_name' => [
                'en' => $this->faker->firstName,
                'ka' => $this->faker->firstName,
            ],
            'last_name' => [
                'en' => $this->faker->lastName,
                'ka' => $this->faker->lastName,
            ],
            'age' => $this->faker->numberBetween(18, 40),
            'market_price' => $this->faker->numberBetween(1000000, 5000000),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
