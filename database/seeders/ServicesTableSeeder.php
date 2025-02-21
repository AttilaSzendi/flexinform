<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ServicesTableSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = base_path('services.json');

        if (!File::exists($jsonPath)) {
            Service::factory()->count(30)->create();
            return;
        }

        $json = File::get($jsonPath);
        $Services = json_decode($json, true);

        foreach ($Services as $service) {
            Service::query()->create([
                'id' => $service['id'],
                'client_id' => $service['client_id'],
                'car_id' => $service['car_id'],
                'log_number' => $service['lognumber'],
                'event' => $service['event'],
                'event_time' => $service['eventtime'],
                'document_id' => $service['document_id'],
            ]);
        }
    }
}
