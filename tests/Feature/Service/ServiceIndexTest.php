<?php

namespace Tests\Feature\Service;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_services_can_be_listed(): void
    {
        Service::factory()->count($count = 5)->create();

        $response = $this->getJson(route('service.index'));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'logNumber',
                    'event',
                    'eventTime',
                    'documentId',
                    'createdAt',
                    'updatedAt',
                ]
            ]
        ]);

        $response->assertJsonCount($count, 'data');
    }

    public function test_services_can_be_filtered_by_car_id(): void
    {
        $services = Service::factory()->count(2)->create();

        $response = $this->getJson(route('service.index', [
            'carId' => $services[0]->car_id
        ]));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'logNumber',
                    'event',
                    'eventTime',
                    'documentId',
                    'createdAt',
                    'updatedAt',
                ]
            ]
        ]);

        $response->assertJsonCount(1, 'data');
    }

    public function test_services_can_be_filtered_by_client_id(): void
    {
        $services = Service::factory()->count(2)->create();

        $response = $this->getJson(route('service.index', [
            'clientId' => $services[0]->client_id
        ]));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'logNumber',
                    'event',
                    'eventTime',
                    'documentId',
                    'createdAt',
                    'updatedAt',
                ]
            ]
        ]);

        $response->assertJsonCount(1, 'data');
    }
}
