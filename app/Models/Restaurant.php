<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'name',
        'type',
        'phone_number',
        'address',
        'bank_account_number',
        'is_complete',
        'is_open',
        'delivery_cost',
        'operational_hours'
    ];

    protected $casts = [
        'operational_hours' => 'array'
    ];
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function foods()
    {
        return $this->hasMany(Food::class);
    }
    public function RestaurantCategory()
    {
        return $this->belongsTo(RestaurantCategory::class);
    }
}
