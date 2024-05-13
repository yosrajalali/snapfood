<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'buyer_id',
        'title',
        'address',
        'latitude',
        'longitude',
        'is_current',
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

}
