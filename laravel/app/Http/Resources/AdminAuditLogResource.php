<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminAuditLogResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'action' => $this->action,
            'target_type' => $this->target_type,
            'target_id' => $this->target_id,
            'created_at' => $this->created_at,
        ];
    }
}
