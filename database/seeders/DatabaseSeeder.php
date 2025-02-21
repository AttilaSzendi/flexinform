<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ClientsTableSeeder::class);
        $this->call(CarsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
    }
}
