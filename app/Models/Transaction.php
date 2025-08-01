<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'product_id',
        'document',
        'in',
        'out',
        'date',
        'remaining',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
