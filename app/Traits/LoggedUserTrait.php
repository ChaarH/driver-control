<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait LoggedUserTrait
{
    public function userInfo()
    {
        return Auth::user();
    }
}