<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'type' => $this->type,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
        ];
    }
}
