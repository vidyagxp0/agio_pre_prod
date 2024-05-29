<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\Deviation;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index($slug)
    {
        switch ($slug) {
            case 'capa':
                return view('frontend.forms.logs.capa_log');
                break;
            case 'deviation':
                $deviation = Deviation::get();
                return view('frontend.forms.logs.deviation_log', compact('deviation'));
                break;
            default:
                return $slug;
                break;
        }
    }
}
