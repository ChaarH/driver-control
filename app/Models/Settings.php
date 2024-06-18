<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'company_id',
        'setting',
        'slug',
        'description',
        'value'
    ];

    public function company()
    {
        return $this->hasOne(Company::class);
    }
}
