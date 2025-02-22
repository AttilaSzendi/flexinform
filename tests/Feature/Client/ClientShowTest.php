<?php

namespace Tests\Feature\Client;

use App\Models\Car;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ClientShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_be_retrieved(): void
    {
        Client::factory()
            ->has(
                Car::factory()
                    ->count(2)
                    ->has(
                        Service::factory()
                            ->count(3)
                            ->state(function (array $attributes, Car $car) {
                                return ['client_id' => $car->client_id];
                            })
                    )
            )
            ->create();


        $response = $this->getJson(route('client.show'));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'cardNumber',
                'createdAt',
                'updatedAt',
                'cars' => [
                    [
                        'latestService',
                    ]
                ]
            ]
        ]);
    }

    public function test_cars_contain_the_latest_services(): void
    {
        $client = Client::factory()->has(Car::factory())->create();

        Service::factory()->create([
            'client_id' => $client->id,
            'car_id' => $client->cars[0]->id,
            'log_number' => 1,
        ]);

        $latestService = Service::factory()->create([
            'client_id' => $client->id,
            'car_id' => $client->cars[0]->id,
            'log_number' => 2,
        ]);

        $response = $this->getJson(route('client.show'));

        $response->assertOk();

        $response->assertJsonPath('data.cars.0.latestService.id', $latestService->id);
    }

    public function test_clients_can_be_filtered_by_name(): void
    {
        Client::factory()->create(['name' => 'John']);
        Client::factory()->create(['name' => 'Jane']);

        $response = $this->getJson(route('client.show', [
            'name' => 'oh'
        ]));

        $response->assertOk();
    }

    public function test_clients_can_be_filtered_by_card_number(): void
    {
        Client::factory()->create(['card_number' => 'asdqwe']);
        Client::factory()->create(['card_number' => 'cardnumber123']);

        $response = $this->getJson(route('client.show', [
            'cardNumber' => 'cardnumber123'
        ]));

        $response->assertOk();
    }

    public function test_error_should_thrown_when_result_has_more_then_one_client(): void
    {
        Client::factory()->count(2)->create();

        $response = $this->getJson(route('client.show'));

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }
}
