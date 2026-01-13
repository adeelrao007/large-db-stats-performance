<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductInventoryResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'quantity' => $this->quantity,
        ];
    }
}

