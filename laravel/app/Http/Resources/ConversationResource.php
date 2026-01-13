<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id'   => $this->id,
            'type' => $this->type,

            'participants' => ConversationParticipantResource::collection(
                $this->whenLoaded('participants')
            ),
        ];
    }
}

