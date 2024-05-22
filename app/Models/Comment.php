<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'cart_id',
        'buyer_id',
        'comment',
        'score',
        'status',
        'response'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}
