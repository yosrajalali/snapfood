<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Buyer extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'password',
        'is_current'
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
