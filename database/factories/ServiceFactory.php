<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'car_id' => Car::factory(),
            'log_number' => $this->faker->unique()->randomNumber(),
            'event' => $this->faker->word,
            'event_time' => $this->faker->dateTime(),
            'document_id' => $this->faker->unique()->randomNumber(),
        ];
    }
}
