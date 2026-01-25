<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'carrier' => $this->carrier,
            'tracking_number' => $this->tracking_number,
            'status' => $this->status,
            'shipped_at' => $this->shipped_at,
        ];
    }
}
