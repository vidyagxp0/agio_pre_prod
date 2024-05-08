<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TotalLogin extends Model
{
    use HasFactory;

    public static function ifUserExist($user_id){
       return Self::where("user_id", $user_id)->first();
    }

    public static function userCheck()
    {
        if (TotalLogin::userCount() > 0) {
            foreach (TotalLogin::get() as $user) {
                $userLastActivity = TotalLogin::getLastActivity($user->user_id);
                $currentTime = Carbon::now();
                $activityDifference = $currentTime->diffInMinutes($userLastActivity);
                if ($activityDifference >= LoginSetting::getLogoutTime()) {
                    TotalLogin::where('user_id', $user->user_id)->delete();
                }
            }
        }
    }

    public static function userCount(){
        return Self::count();
    }

    public static function addUser()
    {
        $totalLogin = new TotalLogin;
        $totalLogin->user_id = Auth::id();
        $totalLogin->save();
    }

    public static function removeUser($user_id)
    {
       return Self::where("user_id",$user_id)->delete();
    }

    public static function isUserLimitReached()
    {
        $userCount = Self::count();
        return $userCount == LoginSetting::getUserLimit();
    }

    public static function getLastActivity($user_id)
    {
        return TotalLogin::where("user_id", $user_id)->value("updated_at");
    }

    public static function setLastActivity($time)
    {
        return Self::where("user_id", Auth::id())->update(["updated_at" => $time]);
    }
}
