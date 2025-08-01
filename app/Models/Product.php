<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_code',
        'name',
        'uom',
        'quantity',
    ];
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
