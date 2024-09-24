<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function toggle_status($id)
    {
        try {

            $user = User::find($id);
            $user->is_active = !$user->is_active;
            $user->save();

            toastr()->success('Account updated!');

        } catch (\Exception $e) {
            toastr()->error('User Not Found');
        }

        return redirect()->back();
    }
}