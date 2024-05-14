<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarketComplaintController extends Controller
{
    public function index()
    {
        return view('frontend.market_complaint.market_complaint_new');
    }


    public function store(Request $request)
    {   
        $input = $request->all();
        dd($request->all());
        // file attechment of all pages
        // if (!empty ($request->initial_attachment_gi)) {
        //     $files = [];
        //     if ($request->hasfile('initial_attachment_gi')) {
        //         foreach ($request->file('initial_attachment_gi') as $file) {
                    
        //             $name =  'initial_attachment_gi' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $input['initial_attachment_gi'] = json_encode($files);
        // }
        // $OosDataRecord = OOS::create($input);
        // // =========== oos grid start =====================
        // if(!empty($OosDataRecord)){
        //     $info_product_item = $request->info_product_item;
        // // ======== General Information =>Info On Product/Material =========
        //     if(isset($info_product_item) && $info_product_item!=''){
        //         $i=0;
        //         foreach ($info_product_item as $key => $value1) {
        //         $genaralGridInfoData = array(
        //         'oot_id'=> $genaralDataRecord->id,
        //         'identifier' => $request->identifier[$i],
        //         'info_product_item' => $info_product_item[$i],
        //         'info_product_lot_batch' => $request->info_product_lot_batch[$i],
        //         'info_product_arnumber' => $request->info_product_arnumber[$i],
        //         'info_product_mfg_date' => $request->info_product_mfg_date[$i], 
        //         'info_expiry_date' => $request->info_expiry_date[$i], 
        //         'info_label_claim' => $request->info_label_claim[$i],
        //         ); 
        //         $genaralGridInfoDatas = OotGrids::insert($genaralGridInfoData);
        //         $i++;  
        //         }
        //     }
        // }
        
    }

}
