<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminRoleAssignmentResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'admin_user_id' => $this->admin_user_id,
            'role_id' => $this->role_id,

            'admin' => new AdminUserResource(
                $this->whenLoaded('adminUser')
            ),

            'role' => new RoleResource(
                $this->whenLoaded('role')
            ),
        ];
    }
}
