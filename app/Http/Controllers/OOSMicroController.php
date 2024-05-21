<?php

namespace App\Http\Controllers;

use App\Models\OOS_micro;
use App\Services\OOSMicroService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OOSMicroController extends Controller
{
    public function index()
    {
        return view('frontend.OOS_Micro.oos_micro');
    }



}
