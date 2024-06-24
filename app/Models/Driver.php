<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $table = 'drivers';

    protected $fillable = [
        'user_id',
        'trip_price',
        'type_price',
        'pix',
        'car_brand',
        'online',
        'in_trip'
    ];



    protected $with = ['user'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class)->latest();
    }
}
