<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DashboardController extends Controller
{
    //

    public function dashboard()
    {

        $users = User::all()->count();

        return view('admin.dashboard', compact('users'));
    }
}
