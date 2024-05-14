<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OOSMicroController extends Controller
{
    public function index()
    {
        return view('frontend.OOS_Micro.oos_micro');
    }
}
