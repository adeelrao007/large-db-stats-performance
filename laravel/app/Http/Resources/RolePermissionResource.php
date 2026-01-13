<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RolePermissionResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'role_id'       => $this->role_id,
            'permission_id' => $this->permission_id,

            'role' => new RoleResource(
                $this->whenLoaded('role')
            ),

            'permission' => new PermissionResource(
                $this->whenLoaded('permission')
            ),
        ];
    }
}

