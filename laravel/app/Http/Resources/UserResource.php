<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'email' => $this->email,

            'account' => new AccountResource(
                $this->whenLoaded('account')
            ),

            'addresses' => AddressResource::collection(
                $this->whenLoaded('addresses')
            ),
        ];
    }
}

