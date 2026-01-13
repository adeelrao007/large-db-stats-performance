<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductPriceResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'currency_id' => $this->currency_id,
            'price'       => $this->price,
        ];
    }
}

