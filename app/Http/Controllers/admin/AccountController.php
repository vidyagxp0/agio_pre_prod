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
            $user = User::findOrFail($id);

            // Toggle active status
            $user->is_active = !$user->is_active;

            // ✅ If activating user → reset lock data
            if ($user->is_active == 1) {
                $user->failed_attempts = 0;
                $user->locked_at = null;
            }

            $user->save();

            toastr()->success('Account updated!');

        } catch (\Exception $e) {
            toastr()->error('User Not Found');
        }

        return redirect()->back();
    }
}