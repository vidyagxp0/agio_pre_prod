<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //




    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember_me = $request->has('remember') ? true : false;

        if (Auth::guard('admin')->attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            if (Auth::guard('admin')->user()->active) {
                toastr()->success('Login Successfully.');
                return redirect()->intended('admin/dashboard');
            }
            else {

                toastr()->error('Login failed.');
                return back()->withErrors([
                    'msg' => 'Your login is disabled please contact administrator.',
                ]);
            }
        }

        toastr()->error('Login failed.');

        return back()->withErrors([
            'msg' => 'The provided credentials do not match our records.',
        ]);
    }



    public function logout()
    {

        Auth::guard('admin')->logout();
        return  redirect('admin/login');
    }
}
