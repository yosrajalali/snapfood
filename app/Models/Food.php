<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = ['restaurant_id', 'name', 'ingredients', 'price', 'image', 'discount_id','food_party'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function categories()
    {
        return $this->belongsToMany(FoodCategory::class, 'category_food');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class)->withPivot('count');
    }

}
