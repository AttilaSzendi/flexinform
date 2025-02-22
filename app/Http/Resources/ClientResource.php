<?php

namespace App\Http\Resources;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Client
 */
class ClientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cardNumber' => $this->card_number,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'cars' => CarResource::collection($this->whenLoaded('cars')),
        ];
    }
}
