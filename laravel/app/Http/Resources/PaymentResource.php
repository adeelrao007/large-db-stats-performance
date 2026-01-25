<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'provider' => $this->provider,
            'amount' => $this->amount,
            'paid_at' => $this->paid_at,
        ];
    }
}
