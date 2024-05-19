<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['buyer_id', 'restaurant_id', 'status'];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }


    public function foods()
    {
        return $this->belongsToMany(Food::class)->withPivot('count');
    }


    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
