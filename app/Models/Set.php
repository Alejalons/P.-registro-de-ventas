<?php

namespace App\Models;

use App\Models\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    public function Models()
    {
        return $this->belongsToMany(Models::class, 'products')->withPivot('id','price');
    }
}
