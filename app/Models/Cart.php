<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['buyer_id', 'food_id', 'count'];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

//    public function foods()
//    {
//        return $this->belongsToMany(Food::class, 'cart_food')
//            ->withPivot('count')
//            ->withTimestamps();
//    }

    public function restaurant()
    {
        return $this->food->restaurant();
    }
}
