<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['role'];

    const ROLES = [
        'developer'     => 1,
        'administrator' => 2,
        'operator'      => 3,
        'driver'        => 4
    ];
    const ROLES_SLUG = [
        1 => 'developer',
        2 => 'administrator',
        3 => 'operator',
        4 => 'driver'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
