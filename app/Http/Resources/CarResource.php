<?php

namespace App\Http\Resources;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Car
 */
class CarResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'clientId' => $this->client_id,
            'type' => $this->type,
            'registered' => $this->registered,
            'ownbrand' => $this->ownbrand,
            'accidents' => $this->accidents,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'client' => new ClientResource($this->whenLoaded('client')),
            'services' => ServiceResource::collection($this->whenLoaded('services')),
            'latestService' => new ServiceResource($this->whenLoaded('latestService')),
        ];
    }
}
