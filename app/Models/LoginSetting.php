<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginSetting extends Model
{
    use HasFactory;

    public static function getUserLimit()
    {
        return Self::where("id", 1)->value("user_limit");
    }

    public static function getLogoutTime()
    {
        return Self::where("id", 1)->value("auto_logout_time");
    }
}
