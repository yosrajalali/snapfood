<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['buyer_id', 'restaurant_id', 'status_id', 'total_price', 'food_id'];

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}
