<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'nameClient', 'address', 'contact','rut','mail','paymentMethod','status','price','dispatchPrice','users_id',
    ];
    protected $guarded = [];  
    public function product()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
