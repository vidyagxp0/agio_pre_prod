<?php

namespace App\Http\Controllers;

use App\Models\OOS_micro;
use App\Services\OOSMicroService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OOSMicroController extends Controller
{
    public function index()
    {
        return view('frontend.OOS_Micro.oos_micro');
    }



    public function store(Request $request)
    {

        // $input = $request->all();
        // $input['stage'] ="1";
        // $input['status']="Opened";


        $data = new OOS_micro();
        $data->initiator_id = Auth::user()->id;
        $data->record = DB::table('record_numbers')->value('counter') + 1;
        $data->title = $request->title;
        $data->version = $request->version;
        $data->short_description = $request->short_description;

        //========== file attechment of all pages ==========
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

        $data->save();

        $grid_inputs = [
            "phase_I_investigation",
            "analyst_training_proce",
            "sample_receiving_verification_lab",
            "method_procedure_used_during_analysis",
            "Instrument_Equipment_Det",
            "Results_and_Calculat",
            "Training_records_Analyst_Involved",
            "sample_intactness_before_analysis",
            "test_methods_Procedure",
            "Review_of_Media_Buffer_Standards_prep",
            "Checklist_for_Revi_of_Media_Buffer_Stand_prep",
            "check_for_disinfectant_detail",
            "Checklist_for_Review_of_instrument_equip",
            "Checklist_for_Review_of_Training_records_Analyst",
            "Checklist_for_Review_of_sampling_and_Transport",
            "Checklist_Review_of_Test_Method_proced",
            "Checklist_for_Review_Media_prepara_RTU_media",
            "Checklist_Review_Environment_condition_in_test",
            "review_of_instrument_bioburden_and_waters",
            "disinfectant_details_of_bioburden_and_water_test",
            "training_records_analyst_involvedIn_testing_microbial_asssay",
            "sample_intactness_before_analysis",
            "checklist_for_review_of_test_method_IMA",
            "cr_of_media_buffer_st_IMA",
            "CR_of_microbial_cultures_inoculation_IMA",
            "CR_of_Environmental_condition_in_testing_IMA",
            "CR_of_instru_equipment_IMA",
            "disinfectant_details_IMA",
            "CR_of_training_rec_anaylst_in_monitoring_CIEM",
            "Check_for_Sample_details_CIEM",
            "Check_for_comparision_of_results_CIEM",
            "checklist_for_media_dehydrated_CIEM",
            "checklist_for_media_prepara_sterilization_CIEM",
            "CR_of_En_condition_in_testing_CIEMs",
            "check_for_disinfectant_CIEM",
            "checklist_for_fogging_CIEM",
            "CR_of_test_method_CIEM",
            "CR_microbial_isolates_contamination_CIEM",
            "CR_of_instru_equip_CIEM",
            "Ch_Trend_analysis_CIEM",
            "checklist_for_analyst_training_CIMT",
            "checklist_for_comp_results_CIMT",
            "checklist_for_Culture_verification_CIMT",
            "sterilize_accessories_CIMT",
            "checklist_for_intrument_equip_last_CIMT",
            "disinfectant_details_last_CIMT",
            "checklist_for_result_calculation_CIMT",
            "phase_II_OOS_investigation"
        ];

        foreach ($grid_inputs as $grid_input)
        {
            OOSMicroService::store_grid($data, $request, $grid_input);
        }

//--------------Grid 1-------------------info on product /material-----------------

}

}


