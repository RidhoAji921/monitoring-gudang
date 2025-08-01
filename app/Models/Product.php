<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
