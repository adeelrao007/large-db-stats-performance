<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id'     => $this->id,
            'amount' => $this->amount,
            'status' => $this->status,

            'items' => OrderItemResource::collection(
                $this->whenLoaded('items')
            ),

            'payment' => new PaymentResource(
                $this->whenLoaded('payment')
            ),
        ];
    }
}

