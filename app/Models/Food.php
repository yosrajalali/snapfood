<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = ['restaurant_id', 'name', 'ingredients', 'price', 'image', 'category_id', 'discount_id','food_party'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function category()
    {
        return $this->belongsTo(FoodCategory::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
