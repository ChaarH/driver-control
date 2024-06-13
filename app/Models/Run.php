<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Run extends Model
{
    use HasFactory;

    protected $table = 'runs';

    protected $fillable = [
        'driver_id',
        'company_id',
        'price',
        'city_from',
        'city_to',
        'district_from',
        'district_to',
        'address_from',
        'address_to',
        'started_at',
        'ended_at'
    ];
}
