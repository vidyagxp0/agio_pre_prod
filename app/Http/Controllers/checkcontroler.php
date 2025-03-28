<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\CC;
use App\Models\check;
use App\Models\Extension;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Support\Facades\App;
use App\Services\DocumentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class checkcontroler extends Controller
{
    
    public function copy(){
        $document = Extension::all();       
    
        foreach($document as $data){       
            $cc = CC::find($data->cc_id);
            
            if ($cc) {
                $data->originator = User::where('id', $cc->initiator_id)->value('name');
            } else {
                $data->originator = 'Unknown';
            }
        }
        
        return view('check.check',['hero' => $document]); 
    }
    
    function store (Request $request){
     $store =new check ();
     $store->short_description=$request->short_description;
     $store->save();
     //return  redirect()->route('check');
     return "saved";

    }

    // function show(){
    //     $show = check::all();
    //     return view ('check.checkk',['show'=> $show]);
    // }



public function take() 
{

    $data = check::all();
    if (!$data) {
        return abort(404); // अगर data नहीं मिला तो 404 error
    }
    $pdf = App::make('dompdf.wrapper');
    $time = Carbon::now();
    $pdf = PDF::loadView('check.checkreport', compact('data'))
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
        ])
        ->setPaper('A4');

    return $pdf->stream('ShortDescription.pdf');
}

    
    
// }
//     function take (){
//         $data = check ::all();
//         $pdf = App::make('dompdf.wrapper');
//         $time = Carbon::now();
//                      $pdf = PDF::loadview('check.checkreport', compact('data'))
//                         ->setOptions([
//                              'defaultFont' => 'sans-serif',
//                              'isHtml5ParserEnabled' => true,
//                              'isRemoteEnabled' => true,
//                             'isPhpEnabled' => true,
//                          ]);
//         $pdf->setPaper('A4');
//                      $pdf->render();
//                      $canvas = $pdf->getDomPDF()->getCanvas();
//                      $height = $canvas->get_height();
//                      $width = $canvas->get_width();
//                      $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');
//                      $canvas->page_text($width / 4, $height / 2, $data->status, null, 25, [0, 0, 0], 2, 6, -20);
//                      return $pdf->stream('Extension' . $id . '.pdf');
//        // return view ('check.checkreport');      
//     }






}