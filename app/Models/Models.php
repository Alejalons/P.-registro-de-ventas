<?php

namespace App\Models;

use App\Models\Set;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    use HasFactory;

    public function sets()
    {
        return $this->belongsToMany(Set::class, 'products')->withPivot('id','price');
    }
}
