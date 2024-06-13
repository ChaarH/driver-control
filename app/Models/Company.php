<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'logo',
        'address',
        'city',
        'cep',
        'phone_1',
        'phone_2'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
