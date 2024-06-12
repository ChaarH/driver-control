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
        'administrator' => 1,
        'operator'      => 2,
        'driver'        => 3
    ];
    const ROLES_SLUG = [
        1 => 'administrator',
        2 => 'operator',
        3 => 'driver'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
