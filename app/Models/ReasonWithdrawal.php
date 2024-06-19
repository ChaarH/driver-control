<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReasonWithdrawal extends Model
{
    use HasFactory;

    protected $table = 'reason_withdrawals';

    protected $fillable = [
        'company_id',
        'reason'
    ];

    public function company()
    {
        return $this->hasMany(Company::class, 'id', 'company_id');
    }
}
