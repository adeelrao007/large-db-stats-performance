<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function translations()
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function inventory()
    {
        return $this->hasOne(ProductInventory::class);
    }
}
