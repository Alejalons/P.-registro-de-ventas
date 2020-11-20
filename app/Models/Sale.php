<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
