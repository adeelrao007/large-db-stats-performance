<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'code' => $this->code,
            'symbol' => $this->symbol,
        ];
    }
}
