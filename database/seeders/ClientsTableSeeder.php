<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ClientsTableSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = base_path('clients.json');

        if (!File::exists($jsonPath)) {
            Client::factory()->count(30)->create();
            return;
        }

        $json = File::get($jsonPath);
        $clients = json_decode($json, true);

        foreach ($clients as $client) {
            Client::query()->create([
                'id' => $client['id'],
                'name' => $client['name'],
                'card_number' => $client['idcard'],
            ]);
        }
    }
}
