<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OOCController extends Controller
{
    public function index()
    {
        return view('frontend.OOC.out_of_calibration');
    }
}
