<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OOSController extends Controller
{
    public  function index()
    {
        return view('frontend.OOS.oos_form');
    }
}
