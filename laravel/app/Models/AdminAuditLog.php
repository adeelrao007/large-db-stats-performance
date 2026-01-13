<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminAuditLog extends Model
{
    protected $table = 'admin_audit_logs';

    public function admin()
    {
        return $this->belongsTo(AdminUser::class, 'admin_user_id');
    }
}

