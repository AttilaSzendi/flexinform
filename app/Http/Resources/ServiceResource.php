<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Service
 */
class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'clientId' => $this->client_id,
            'carId' => $this->car_id,
            'logNumber' => $this->log_number,
            'event' => $this->event,
            'eventTime' => $this->event_time,
            'documentId' => $this->document_id,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'client' => new ClientResource($this->whenLoaded('client')),
            'car' => new CarResource($this->whenLoaded('car')),
        ];
    }
}
