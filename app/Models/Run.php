<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public static function scopeLastRunFromDriver($driver_id)
    {
        return Run::where('driver_id', $driver_id)
            ->whereRaw('date(ended_at) = ?', [Carbon::now()->format('Y-m-d')] )
            ->orderBy('ended_at')
            ->limit(1);
    }


    /*
     * Relations
     * */
    public function driver()
    {
        return $this->hasMany(Driver::class,'id', 'driver_id');
    }
}
