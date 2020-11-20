<?php

namespace App\Models;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function sale()
    {
        return $this->belongsToMany(Sale::class)->withTimestamps();
    }
}
