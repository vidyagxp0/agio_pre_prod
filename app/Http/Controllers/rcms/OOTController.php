<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OOT;
use carbon;

class OOTController extends Controller
{
    public function index()
    {
        return view('frontend.OOT.OOT_form');
    }

    public function store(Request $request)
    {
     
        
       
        $request->all();
        
       

            $input = $request->all(); 

            // $input['due_date'] = $input['due_date'] ? Carbon::parse($input['due_date'])->format('d F Y') : '';
            // dd($request->all());    

            OOT::create($input);


}
}
