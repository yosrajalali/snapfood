<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [ 'restaurant_id', 'status_id', 'total_price', 'cart_id'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

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
