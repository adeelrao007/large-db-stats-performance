<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';
    public $timestamps = false;

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'default_currency_id');
    }
}

