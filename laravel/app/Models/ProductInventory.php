<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{
    protected $table = 'product_inventory';
    protected $primaryKey = 'product_id';
    public $incrementing = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
