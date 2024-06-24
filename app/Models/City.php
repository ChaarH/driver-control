<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $fillable = [
        'name',
        'trip_price',
        'increase_time_start',
        'increase_time_end',
        'trip_price_increased_after_time',
        'default'
    ];

    public function companies()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}
