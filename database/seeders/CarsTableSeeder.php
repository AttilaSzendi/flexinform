<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CarsTableSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = base_path('cars.json');

        if (!File::exists($jsonPath)) {
            Car::factory()->count(30)->create();
            return;
        }

        $json = File::get($jsonPath);
        $cars = json_decode($json, true);

        foreach ($cars as $car) {
            Car::query()->create([
                'id' => $car['id'],
                'client_id' => $car['client_id'],
                'type' => $car['type'],
                'registered' => $car['registered'],
                'ownbrand' => $car['ownbrand'],
                'accidents' => $car['accident'],
            ]);
        }
    }
}
