<?php

namespace App\Support;

use Illuminate\Support\Facades\Auth;

class Tenant
{
    public static function user()
    {
        return Auth::user();
    }

    public static function companyId()
    {
        return Auth::user()?->company_id;
    }
}