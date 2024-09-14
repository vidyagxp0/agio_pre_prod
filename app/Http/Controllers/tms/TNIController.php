<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TNI;
use Illuminate\Support\Facades\Auth;

class TNIController extends Controller
{
    public function index()
    {
        $Tni = TNI::all();
        return view('frontend.TMS.TNI_TNA.Tni_create', compact('Tni'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' =>'required',
            'question_bank'=>'required|max:255',
            'questions'=>'required',
            'passing'=>'required',
          ]);
        $Tni = new TNI();
        $Tni->trainer_id = Auth::user()->id;
        // $Tni->title = $request->title;
        // $Tni->description = $request->description;
        // $Tni->category = $request->category;
        // $Tni->passing = $request->passing;
        // $Tni->question_bank = $request->question_bank;
        // if(!empty($request->questions)){
        // $Tni->question = implode(',', $request->questions);
        // }
        $Tni->save();
        toastr()->success('Submit Successfully !!');
        return redirect()->route('Tni.index');
    }

    // public function show($id)
    // {
        
    //     $Tni = TNI::find($id);
        
    //     return view('frontend.TMS.TNI_TNA.Tni_view',compact('Tni'));
    // }
    public function update(Request $request, $id)
    {
        $Tni = TNI::find($id);
        
       
        $Tni->save();
        toastr()->success('Update Successfully !!');
        return redirect()->route('Tni.index');
    }

}
