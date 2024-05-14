<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OOS;
use App\Models\Oosgrids;

class OOSController extends Controller
{
    public function index()
    {
        return view('frontend.OOS.oos_form');
    }
    public function store(Request $request)
    {   
        $input = $request->all();

        dd($input);
        // file attechment of all pages

        // if (!empty ($request->gi_attachment)) {
        //     $files = [];
        //     if ($request->hasfile('gi_attachment')) {
        //         foreach ($request->file('gi_attachment') as $file) {
        //             $name =  'gi_attachment' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $input['gi_attachment'] = json_encode($files);
        // }
        $OosDataRecord = OOS::create($input);
        // =========== oot grid start =====================
        // if(!empty($genaralDataRecord)){
        //     $info_product_item = $request->info_product_item;
        //     $stability_study_arnumber = $request->stability_study_arnumber;
        //     $oot_results_arnumber = $request->oot_results_arnumber;
        //     $preliminary_question = $request->preliminary_question;
            
             // ======== General Information =>Info On Product/Material =========
             
            // if(isset($info_product_item) && $info_product_item!=''){
            //     $i=0;
            //     foreach ($info_product_item as $key => $value1) {
            //     $genaralGridInfoData = array(
            //     'oot_id'=> $genaralDataRecord->id,
            //     'identifier' => $request->identifier[$i],
            //     'info_product_item' => $info_product_item[$i],
            //     'info_product_lot_batch' => $request->info_product_lot_batch[$i],
            //     'info_product_arnumber' => $request->info_product_arnumber[$i],
            //     'info_product_mfg_date' => $request->info_product_mfg_date[$i], 
            //     'info_expiry_date' => $request->info_expiry_date[$i], 
            //     'info_label_claim' => $request->info_label_claim[$i],
            //     ); 
            //     $genaralGridInfoDatas = OotGrids::insert($genaralGridInfoData);
            //     $i++;  
            //     }
            // }
        
    }
}
