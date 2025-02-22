<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'type' => $this->faker->word,
            'registered' => $this->faker->dateTime(),
            'ownbrand' => $this->faker->numberBetween(0, 1),
            'accidents' => $this->faker->numberBetween(0, 100),
        ];
    }
}
