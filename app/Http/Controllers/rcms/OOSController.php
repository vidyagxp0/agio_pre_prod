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

        //dd($input);
        // file attechment of all pages
        if (!empty ($request->initial_attachment_gi)) {
            $files = [];
            if ($request->hasfile('initial_attachment_gi')) {
                foreach ($request->file('initial_attachment_gi') as $file) {
                    
                    $name =  'initial_attachment_gi' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['initial_attachment_gi'] = json_encode($files);
        }


        if (!empty ($request->file_attachments_pli)) {
            $files = [];
            if ($request->hasfile('file_attachments_pli')) {
                foreach ($request->file('file_attachments_pli') as $file) {
                    
                    $name =  'file_attachments_pli' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['file_attachments_pli'] = json_encode($files);
        }

        if (!empty ($request->supporting_attachment_plic)) {
            $files = [];
            if ($request->hasfile('supporting_attachment_plic')) {
                foreach ($request->file('supporting_attachment_plic') as $file) {
                    
                    $name =  'supporting_attachment_plic' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['supporting_attachment_plic'] = json_encode($files);
        }

        if (!empty ($request->supporting_attachments_plir)) {
            $files = [];
            if ($request->hasfile('supporting_attachments_plir')) {
                foreach ($request->file('supporting_attachments_plir') as $file) {
                    
                    $name =  'supporting_attachments_plir' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['supporting_attachments_plir'] = json_encode($files);
        }


        if (!empty ($request->file_attachments_pli)) {
            $files = [];
            if ($request->hasfile('file_attachments_pli')) {
                foreach ($request->file('file_attachments_pli') as $file) {
                    
                    $name =  'file_attachments_pli' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['file_attachments_pli'] = json_encode($files);
        }

        if (!empty ($request->attachments_piiqcr)) {
            $files = [];
            if ($request->hasfile('attachments_piiqcr')) {
                foreach ($request->file('attachments_piiqcr') as $file) {
                    
                    $name =  'attachments_piiqcr' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['attachments_piiqcr'] = json_encode($files);
        }

        if (!empty ($request->additional_testing_attachment_atp)) {
            $files = [];
            if ($request->hasfile('additional_testing_attachment_atp')) {
                foreach ($request->file('additional_testing_attachment_atp') as $file) {
                    
                    $name =  'additional_testing_attachment_atp' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['additional_testing_attachment_atp'] = json_encode($files);
        }

        if (!empty ($request->file_attachments_if_any_ooscattach)) {
            $files = [];
            if ($request->hasfile('file_attachments_if_any_ooscattach')) {
                foreach ($request->file('file_attachments_if_any_ooscattach') as $file) {
                    
                    $name =  'file_attachments_if_any_ooscattach' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['file_attachments_if_any_ooscattach'] = json_encode($files);
        }

        if (!empty ($request->conclusion_attachment_ocr)) {
            $files = [];
            if ($request->hasfile('conclusion_attachment_ocr')) {
                foreach ($request->file('conclusion_attachment_ocr') as $file) {
                    
                    $name =  'conclusion_attachment_ocr' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['conclusion_attachment_ocr'] = json_encode($files);
        }


        if (!empty ($request->cq_attachment_ocqr)) {
            $files = [];
            if ($request->hasfile('cq_attachment_ocqr')) {
                foreach ($request->file('cq_attachment_ocqr') as $file) {
                    
                    $name =  'cq_attachment_ocqr' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['cq_attachment_ocqr'] = json_encode($files);
        }


        if (!empty ($request->disposition_attachment_bd)) {
            $files = [];
            if ($request->hasfile('disposition_attachment_bd')) {
                foreach ($request->file('disposition_attachment_bd') as $file) {
                    
                    $name =  'disposition_attachment_bd' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['disposition_attachment_bd'] = json_encode($files);
        }

        if (!empty ($request->reopen_attachment_ro)) {
            $files = [];
            if ($request->hasfile('reopen_attachment_ro')) {
                foreach ($request->file('reopen_attachment_ro') as $file) {
                    
                    $name =  'reopen_attachment_ro' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['reopen_attachment_ro'] = json_encode($files);
        }

        if (!empty ($request->addendum_attachment_uaa)) {
            $files = [];
            if ($request->hasfile('addendum_attachment_uaa')) {
                foreach ($request->file('addendum_attachment_uaa') as $file) {
                    
                    $name =  'addendum_attachment_uaa' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['addendum_attachment_uaa'] = json_encode($files);
        }

        if (!empty ($request->addendum_attachments_uae)) {
            $files = [];
            if ($request->hasfile('addendum_attachments_uae')) {
                foreach ($request->file('addendum_attachments_uae') as $file) {
                    
                    $name =  'addendum_attachments_uae' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['addendum_attachments_uae'] = json_encode($files);
        }

        if (!empty ($request->required_attachment_uar)) {
            $files = [];
            if ($request->hasfile('required_attachment_uar')) {
                foreach ($request->file('required_attachment_uar') as $file) {
                    
                    $name =  'required_attachment_uar' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['required_attachment_uar'] = json_encode($files);
        }

        if (!empty ($request->verification_attachment_uar)) {
            $files = [];
            if ($request->hasfile('verification_attachment_uar')) {
                foreach ($request->file('verification_attachment_uar') as $file) {
                    
                    $name =  'verification_attachment_uar' . rand(1, 10000) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $input['verification_attachment_uar'] = json_encode($files);
        }
        $OosDataRecord = OOS::create($input);
        // =========== oos grid start =====================
        if(!empty($OosDataRecord)){
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
        }
        
    }
}
