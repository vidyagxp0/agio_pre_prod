<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OOTController extends Controller
{
    public function index()
    {
        return view('frontend.OOT.OOT_form');
    }
}
