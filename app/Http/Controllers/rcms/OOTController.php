<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ootc;
use App\Models\RecordNumber;
use App\Models\ProductGridOot;
use App\Models\OotChecklist;
use App\Models\OotAuditTrial;
use App\Models\RoleGroup;
use Carbon\Carbon;
use App\Models\User;
use App\Models\RcmsDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use PDF;
use Illuminate\Support\Facades\Hash;

class OOTController extends Controller
{
    public function index(Request $request)
    {
    
        return view('frontend.OOT.OOT_form');
    }

    public function store(Request $request)
    {
            // dd($request->oot_result);

        // return dd($request->all());
         
        $data = new Ootc();
        $data->initiator_id   = Auth::user()->id;
        $data->record_number   = ((RecordNumber::first()->value('counter')) + 1);
        $data->intiation_date = $request->intiation_date;
        $data->due_date       = $request->due_date;
        $data->division_id        = $request->division_id;  
        $data->severity_level        = $request->severity_level;
        $data->initiator_group       = $request->initiator_group;
        $data->initiator_group_code  = $request->initiator_group_code;
        $data->initiated_through     = $request->initiated_through;
        $data->if_others	         = $request->if_others;
        $data->is_repeat             = $request->is_repeat;
        $data->repeat_nature         = $request->repeat_nature;
        $data->nature_of_change      = $request->nature_of_change;
        $data->oot_occured_on        = $request->oot_occured_on;
        $data->oot_details           = $request->oot_details;
        $data->producct_history      = $request->producct_history;
        $data->probble_cause         = $request->probble_cause;
        $data->investigation_details = $request->investigation_details;
        $data->comments               = $request->comments;
        $data->reference             = $request->reference;
        // dd($request->investigation_details);
         $data->productmaterialname   = $request->productmaterialname;
        $data->grade_typeofwater     = $request->grade_typeofwater;
        $data->sampleLocation_Point  = $request->sampleLocation_Point;
        $data->market                = $request->market;
        $data->customer              = $request->customer;
        $data->analyst_name          = $request->analyst_name;
        $data->others                = $request->others;
        
        if (is_array($request->reference_record )) {
            $data->reference_record = implode(',', $request->reference_record);
        }
        if (is_array($request->stability_for )) {
            $data->stability_for = implode(',', $request->stability_for);
        }
        $data-> specification_procedure_number    = $request->specification_procedure_number;
        $data-> specification_limit               = $request->specification_limit;
        if (!empty($request->Attachment) && $request->file('Attachment')) {
            $files = [];
            foreach ($request->file('Attachment') as $file) {
                $name = $request->name . 'Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] =  $name; // Store the file path
            }
            // Save the file paths in the database
            $data->Attachment = json_encode($files);
        }   

        $data->corrective_action                  = $request->corrective_action;
        $data->preventive_action                  = $request->preventive_action;
        $data->inv_comments                       = $request->inv_comments;
        if (!empty($request->inv_file_attachment) && $request->file('inv_file_attachment')) {
            $files = [];
            foreach ($request->file('inv_file_attachment') as $file) {
                $name = $request->name . 'inv_file_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] =  $name; // Store the file path
            }
            // Save the file paths in the database
            $data->inv_file_attachment = json_encode($files);
        } 
        $data->inv_head_designee                  = $request->inv_head_designee;
        $data->reason_for_stability               = $request->reason_for_stability;
        $data->description_of_oot_details         = $request->description_of_oot_details;
        $data->sta_bat_product_history            = $request->sta_bat_product_history;
        $data->sta_bat_probable_cause             = $request->sta_bat_probable_cause;
        $data->sta_bat_analyst_name               = $request->sta_bat_analyst_name;
        $data->qa_head_designee                   = $request->qa_head_designee;
        $data->action_taken_result                = $request->action_taken_result;
        $data->retraining_to_analyst_required     = $request->retraining_to_analyst_required;
        $data->cheklist_part_b_remarks            = $request->cheklist_part_b_remarks;
        $data->analysis_on_same_sample	          = $request->analysis_on_same_sample;
        $data->any_other_action                   = $request->any_other_action;
        $data->re_analysis_result                 = $request->re_analysis_result;
        $data->reanalysis_result_oot              = $request->reanalysis_result_oot;
        $data->part_b_comments                    = $request->part_b_comments;
        if (!empty($request->supporting_attechment) && $request->file('supporting_attechment')) {
            $files = [];
            foreach ($request->file('supporting_attechment') as $file) {
                $name = $request->name . 'supporting_attechment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] =  $name; // Store the file path
            }
            // Save the file paths in the database
            $data->supporting_attechment = json_encode($files);
        } 
       
        $data->r_d_comments_part_b                = $request->r_d_comments_part_b;
        $data->a_d_l_comments                     = $request->a_d_l_comments;
        $data->regulatory_comments                = $request->regulatory_comments;
        $data->manufacturing_comments             = $request->manufacturing_comments;
        $data->technical_commitee_comments        = $request->technical_commitee_comments;
        if (!empty($request->supporting_documents) && $request->file('supporting_documents')) {
            $files = [];
            foreach ($request->file('supporting_documents') as $file) {
                $name = $request->name . 'supporting_documents' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] =  $name; // Store the file path
            }
            // Save the file paths in the database
            $data->supporting_documents = json_encode($files);
        }
        $data->last_due_date                      = $request->last_due_date;
        $data->progress_justification_delay       = $request->progress_justification_delay;
        $data->tentative_clousure_date            = $request->tentative_clousure_date;
        $data->remarks_by_qa_department           = $request->remarks_by_qa_department;
        if (!empty($request->conclusion_attechment) && $request->file('conclusion_attechment')) {
            $files = [];
            foreach ($request->file('conclusion_attechment') as $file) {
                $name = $request->name . 'conclusion_attechment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] =  $name; // Store the file path
            }
            // Save the file paths in the database
            $data->conclusion_attechment = json_encode($files);
        }
        $data->closure_comments                   = $request->closure_comments;
        if (!empty($request->doc_closure) && $request->file('doc_closure')) {
            $files = [];
            foreach ($request->file('doc_closure') as $file) {
                $name = $request->name . 'doc_closure' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] =  $name; // Store the file path
            }
            // Save the file paths in the database
            $data->doc_closure = json_encode($files);
        }

        $data->status = 'Opened';                 
        $data->stage = 1;
        //  dd($data);
        $data->save();

         $checkList = new OotChecklist();
        //  $checkList->ootcs_id = $data->id;
        $checkList->ootcs_id            = $data->id;
         $checkList->p_l_irequired      = $request->p_l_irequired;
         $checkList->responce_one       = $request->responce_one;
         $checkList->responce_two       = $request->responce_two;
         $checkList->responce_three     = $request->responce_three;
         $checkList->responce_four      = $request->responce_four;
         $checkList->responce_five      = $request->responce_five;
         $checkList->responce_six       = $request->responce_six;
         $checkList->responce_seven     = $request->responce_seven;
         $checkList->responce_eight     = $request->responce_eight;
         $checkList->responce_nine      = $request->responce_nine;
         $checkList->responce_ten       = $request->responce_ten;
         $checkList->responce_eleven    = $request->responce_eleven;
         $checkList->responce_twele     = $request->responce_twele;
         $checkList->responce_thrteen   = $request->responce_thrteen;
         $checkList->responce_fourteen  = $request->responce_fourteen;
         $checkList->responce_fifteen   = $request->responce_fifteen;
         $checkList->responce_sixteen   = $request->responce_sixteen;
         $checkList->responce_seventeen = $request->responce_seventeen;
         $checkList->responce_eighteen  = $request->responce_eighteen;
         $checkList->responce_ninteen   = $request->responce_ninteen;
         $checkList->responce_twenty    = $request->responce_twenty;
         $checkList->responce_twenty_one         =$request->responce_twenty_one;
         $checkList->responce_twenty_two         =$request->responce_twenty_two;
         $checkList->responce_twenty_three       =$request->responce_twenty_three;
         $checkList->responce_twenty_four        =$request->responce_twenty_four;
         $checkList->responce_twenty_five        =$request->responce_twenty_five;
         $checkList->responce_twenty_six         =$request->responce_twenty_six;
         $checkList->responce_twenty_seven       =$request->responce_twenty_seven;
         $checkList->responce_twenty_eight       =$request->responce_twenty_eight;
         $checkList->responce_twenty_nine        =$request->responce_twenty_nine;
         $checkList->responce_thirty             =$request->responce_thirty;
         $checkList->responce_thirty_one         =$request->responce_thirty_one;
         $checkList->responce_thirty_two         =$request->responce_thirty_two;
         $checkList->responce_thirty_three       =$request->responce_thirty_three;
         $checkList->responce_thirty_four	     =$request->responce_thirty_four;
         $checkList->remark_one                  = $request->remark_one;
         $checkList->remark_two                  = $request->remark_two;
         $checkList->remark_three                = $request->remark_three;
         $checkList->remark_four                 = $request->remark_four;
         $checkList->remark_five                 = $request->remark_five;
         $checkList->remark_six                  = $request->remark_six;
         $checkList->remark_seven                = $request->remark_seven;
         $checkList->remark_eight                = $request->remark_eight;
         $checkList->remark_nine                 = $request->remark_nine;
         $checkList->remark_ten                  = $request->remark_ten;
         $checkList->remark_eleven               = $request->remark_eleven;
         $checkList->remark_twele                = $request->remark_twele;
         $checkList->remark_thrteen              = $request->remark_thrteen;
         $checkList->remark_fourteen             = $request->remark_fourteen;
         $checkList->remark_fifteen              = $request->remark_fifteen;
         $checkList->remark_sixteen              = $request->remark_sixteen;
         $checkList->remark_seventeen            = $request->remark_seventeen;
         $checkList->remark_eighteen             = $request->remark_eighteen;
         $checkList->remark_ninteen              = $request->remark_ninteen;
         $checkList->remark_twenty               = $request->remark_twenty;
         $checkList->remark_twenty_one           = $request->remark_twenty_one;
         $checkList->remark_twenty_two           = $request->remark_twenty_two;
         $checkList->remark_twenty_three         = $request->remark_twenty_three;
         $checkList->remark_twenty_four          = $request->remark_twenty_four;
         $checkList->remark_twenty_five          = $request->remark_twenty_five;
         $checkList->remark_twenty_six           = $request->remark_twenty_six;
         $checkList->remark_twenty_seven         = $request->remark_twenty_seven;
         $checkList->remark_twenty_eight         = $request->remark_twenty_eight;
         $checkList->remark_twenty_nine          = $request->remark_twenty_nine;
         $checkList->remark_thirty               = $request->remark_thirty;
         $checkList->remark_thirty_one           = $request->remark_thirty_one;
         $checkList->remark_thirty_two           = $request->remark_thirty_two;
         $checkList->remark_thirty_three         = $request->remark_thirty_three;
         $checkList->remark_thirty_four          = $request->remark_thirty_four;
         $checkList->l_e_i_oot                   = $request->l_e_i_oot;
         $checkList->elaborate_the_reson         = $request->elaborate_the_reson;
         $checkList->in_charge = $request->in_charge;
         $checkList->pli_head_designee = $request->pli_head_designee;	 

        //  dd($checkList);
        $checkList->save();
        $productGrid = ProductGridOot::where(['ootcs_id' => $data->id, 'identifier' =>'product_materiel'])->firstOrCreate();
        $productGrid->ootcs_id = $data->id;
        $productGrid->identifier = 'product_materiel';
        $productGrid->data = $request->product_materiel;
        // dd($productGrid);
        $productGrid->save();

        $StabilityGrid = ProductGridOot::where(['ootcs_id' => $data->id, 'identifier' =>'details_of_stability'])->firstOrCreate();
        $StabilityGrid->ootcs_id = $data->id;
        $StabilityGrid->identifier = 'details_of_stability';
        $StabilityGrid->data = $request->details_of_stability;
        $StabilityGrid->save();

        
        $OotResultGrid = ProductGridOot::where(['ootcs_id' => $data->id, 'identifier' => 'oot_result'])->firstOrCreate();
        $OotResultGrid->ootcs_id = $data->id;
        $OotResultGrid->identifier = 'oot_result';
        $OotResultGrid->data = $request->oot_result;
        //  dd($OotResultGrid);        
        $OotResultGrid->save();
        
        $InfoProductMat = ProductGridOot::where(['ootcs_id' => $data->id, 'identifier' =>'info_product'])->firstOrCreate();
        $InfoProductMat->ootcs_id = $data->id;
        $InfoProductMat->identifier = 'info_product';
        $InfoProductMat->data = $request->info_product;
        $InfoProductMat->save();


        if (!empty($data->division_code)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Save';
            $history->previous = "Null";
            $history->current = $data->division_code;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->due_date)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Division Code';
            $history->previous = "Null";
            $history->current = $data->division_code;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->initiated_through)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Division Code';
            $history->previous = "Null";
            $history->current = $data->initiated_through;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->if_others)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Division Code';
            $history->previous = "Null";
            $history->current = $data->if_others;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->is_repeat)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Division Code';
            $history->previous = "Null";
            $history->current = $data->is_repeat;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->repeat_nature)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = "Null";
            $history->current = $data->repeat_nature;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->natureOfChange)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Nature Of Change';
            $history->previous = "Null";
            $history->current = $data->natureOfChange;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        
        if (!empty($data->oot_occured_on)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Oot Occured On';
            $history->previous = "Null";
            $history->current = $data->oot_occured_on;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->oot_details)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Oot Details';
            $history->previous = "Null";
            $history->current = $data->oot_details;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->producct_history)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Product His';
            $history->previous = "Null";
            $history->current = $data->producct_history;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->producct_history)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Product History';
            $history->previous = "Null";
            $history->current = $data->producct_history;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->probble_cause)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Probble Cause';
            $history->previous = "Null";
            $history->current = $data->probble_cause;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->investigation_details)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Investigation Details';
            $history->previous = "Null";
            $history->current = $data->investigation_details;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->comments)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Comments';
            $history->previous = "Null";
            $history->current = $data->comments;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->comments)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Comments';
            $history->previous = "Null";
            $history->current = $data->comments;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->productmaterialname)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Product Material Name';
            $history->previous = "Null";
            $history->current = $data->productmaterialname;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->grade_typeofwater)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Grade Type Of Water';
            $history->previous = "Null";
            $history->current = $data->grade_typeofwater;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->sampleLocation_Point)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Sample Location Point';
            $history->previous = "Null";
            $history->current = $data->sampleLocation_Point;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->market)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Market';
            $history->previous = "Null";
            $history->current = $data->market;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->customer)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'customer';
            $history->previous = "Null";
            $history->current = $data->market;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->analyst_name)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'analyst_name';
            $history->previous = "Null";
            $history->current = $data->analyst_name;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->reference_record)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Reference Record';
            $history->previous = "Null";
            $history->current = $data->reference_record;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->others)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Others';
            $history->previous = "Null";
            $history->current = $data->others;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->stability_for)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'stability For';
            $history->previous = "Null";
            $history->current = $data->stability_for;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiator";
            $history->action_name = "Create";
            $history->save();
        }
       

        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }


    public function ootShow($id){

       $data = Ootc::where('id',$id)->first();      
       $grid_product_mat = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'product_materiel'])->first();
    //    dd($grid_product_mat);
       $gridStability = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'details_of_stability'])->first();
       $GridOotRes = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'oot_result'])->first();
    // dd($GridOotRes);
       $InfoProductMat = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'info_product'])->first();


       $checkList = OotChecklist::where(['ootcs_id' => $id ])->first();
    //   dd($checkList);
       $record_number = ((RecordNumber::first()->value('counter')) + 1);
       $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        return view('frontend.OOT.ootView',compact('data','record_number','grid_product_mat','checkList','gridStability','GridOotRes','InfoProductMat'));

    }

    public function update( Request $request,$id){
        $lastDocument = Ootc::find($id);
        
        $data = Ootc::find($id);
        $data->division_id           = $request->division_id;
        $data->record_number         = $lastDocument->record_number;
        // dd($lastDocument->record_number);
        $data->due_date              = $request->due_date;
        $data->severity_level        = $request->severity_level;
        $data->initiator_group       = $request->initiator_group;
        $data->initiator_group_code  =$request->initiator_group_code;
        $data->initiated_through     = $request->initiated_through;
        $data->if_others	         = $request->if_others;
        $data->is_repeat             = $request->is_repeat;
        $data->repeat_nature         = $request->repeat_nature;
        $data->nature_of_change      = $request->nature_of_change;
        $data->oot_occured_on        = $request->oot_occured_on;
        $data->oot_details           = $request->oot_details;
        $data->producct_history      = $request->producct_history;
        $data->probble_cause         = $request->probble_cause;
        $data->investigation_details = $request->investigation_details;
        $data->comments              = $request->comments;
        $data->reference             = $request->reference;
        $data->productmaterialname   = $request->productmaterialname;
        $data->grade_typeofwater     = $request->grade_typeofwater;
        $data->sampleLocation_Point  = $request->sampleLocation_Point;
        $data->market                = $request->market;
        $data->customer              = $request->customer;
        $data->analyst_name          = $request->analyst_name;
        $data->others                = $request->others;
        if (is_array($request->reference_record )) {
            $data->reference_record = implode(',', $request->reference_record);
        }
        if (is_array($request->stability_for )) {
            $data->stability_for = implode(',', $request->stability_for);
        }
        $data->specification_procedure_number = $request->specification_procedure_number;
        $data->specification_limit = $request->specification_limit;
        if (!empty($request->Attachment) && $request->file('Attachment')) {
            $files = [];
            foreach ($request->file('Attachment') as $file) {
                $name = $request->name . 'Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] =  $name; // Store the file path
            }
            // Save the file paths in the database
            $data->Attachment = json_encode($files);
        }  
        $data->corrective_action                     = $request->corrective_action;
        $data->preventive_action                     = $request->preventive_action;
        $data->inv_comments                          = $request->inv_comments;
        if (!empty($request->inv_file_attachment) && $request->file('inv_file_attachment')) {
            $files = [];
            foreach ($request->file('inv_file_attachment') as $file) {
                $name = $request->name . 'inv_file_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] =  $name; // Store the file path
            }
            // Save the file paths in the database
            $data->inv_file_attachment = json_encode($files);
        } 
        $data->inv_head_designee                     = $request->inv_head_designee;
        $data->reason_for_stability                  = $request->reason_for_stability;
        $data->description_of_oot_details            = $request->description_of_oot_details;
        $data->sta_bat_product_history               = $request->sta_bat_product_history;
        $data->sta_bat_probable_cause                = $request->sta_bat_probable_cause;
        $data->sta_bat_analyst_name                  = $request->sta_bat_analyst_name;
        $data->qa_head_designee                      = $request->qa_head_designee;
        
        $data->action_taken_result                = $request->action_taken_result;
        $data->retraining_to_analyst_required     = $request->retraining_to_analyst_required;
        $data->cheklist_part_b_remarks            = $request->cheklist_part_b_remarks;
        $data->analysis_on_same_sample	          = $request->analysis_on_same_sample;
        $data->any_other_action                   = $request->any_other_action;
        $data->re_analysis_result                 = $request->re_analysis_result;
        $data->reanalysis_result_oot              = $request->reanalysis_result_oot;
        $data->part_b_comments                    = $request->part_b_comments;
        if (!empty($request->supporting_attechment) && $request->file('supporting_attechment')) {
            $files = [];
            foreach ($request->file('supporting_attechment') as $file) {
                $name = $request->name . 'supporting_attechment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] =  $name; // Store the file path
            }
            // Save the file paths in the database
            $data->supporting_attechment = json_encode($files);
        } 
       
        $data->r_d_comments_part_b                = $request->r_d_comments_part_b;
        $data->a_d_l_comments                     = $request->a_d_l_comments;
        $data->regulatory_comments                = $request->regulatory_comments;
        $data->manufacturing_comments             = $request->manufacturing_comments;
        $data->technical_commitee_comments        = $request->technical_commitee_comments;
        if (!empty($request->supporting_documents) && $request->file('supporting_documents')) {
            $files = [];
            foreach ($request->file('supporting_documents') as $file) {
                $name = $request->name . 'supporting_documents' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] =  $name; // Store the file path
            }
            // Save the file paths in the database
            $data->supporting_documents = json_encode($files);
        }
        $data->last_due_date                      = $request->last_due_date;
        $data->progress_justification_delay       = $request->progress_justification_delay;
        $data->tentative_clousure_date            = $request->tentative_clousure_date;
        $data->remarks_by_qa_department           = $request->remarks_by_qa_department;
        if (!empty($request->conclusion_attechment) && $request->file('conclusion_attechment')) {
            $files = [];
            foreach ($request->file('conclusion_attechment') as $file) {
                $name = $request->name . 'conclusion_attechment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] =  $name; // Store the file path
            }
            // Save the file paths in the database
            $data->conclusion_attechment = json_encode($files);
        }
        $data->closure_comments                   = $request->closure_comments;
        if (!empty($request->doc_closure) && $request->file('doc_closure')) {
            $files = [];
            foreach ($request->file('doc_closure') as $file) {
                $name = $request->name . 'doc_closure' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] =  $name; // Store the file path
            }
            // Save the file paths in the database
            $data->doc_closure = json_encode($files);
        }


        $data->update();
        $productGrid = ProductGridOot::where(['ootcs_id' => $data->id, 'identifier' =>'product_materiel'])->firstOrCreate();
        $productGrid->ootcs_id = $data->id;
        $productGrid->identifier = 'product_materiel';
        $productGrid->data = $request->product_materiel;
        $productGrid->update();
        toastr()->success('Record is Update Successfully');


        $data->update();
        $StabilityGrid = ProductGridOot::where(['ootcs_id' => $data->id, 'identifier' =>'details_of_stability'])->firstOrCreate();
        $StabilityGrid->ootcs_id = $data->id;
        $StabilityGrid->identifier = 'details_of_stability';
        $StabilityGrid->data = $request->details_of_stability;
        $StabilityGrid->update();
        toastr()->success('Record is Update Successfully');
        
        
        $data->update();
        $OotResultGrid = ProductGridOot::where(['ootcs_id' => $data->id, 'identifier' =>'oot_result'])->firstOrCreate();
        $OotResultGrid->ootcs_id = $data->id;
        $OotResultGrid->identifier = 'oot_result';
        $OotResultGrid->data = $request->oot_result;
        $OotResultGrid->update();
        toastr()->success('Record is Update Successfully');

        $data->update();
        $InfoProductMat = ProductGridOot::where(['ootcs_id' => $data->id, 'identifier' =>'info_product'])->firstOrCreate();
        $InfoProductMat->ootcs_id = $data->id;
        $InfoProductMat->identifier = 'info_product';
        $InfoProductMat->data = $request->info_product;
        $InfoProductMat->update();
        // dd($InfoProductMat);
        toastr()->success('Record is Update Successfully');
        
        
        $checkList = OotChecklist::where(['ootcs_id' => $id])->first();
         $checkList->ootcs_id            = $id;
         $checkList->p_l_irequired      = $request->p_l_irequired;
         $checkList->responce_one       = $request->responce_one;
         $checkList->responce_two       = $request->responce_two;
         $checkList->responce_three     = $request->responce_three;
         $checkList->responce_four      = $request->responce_four;
         $checkList->responce_five      = $request->responce_five;
         $checkList->responce_six       = $request->responce_six;
         $checkList->responce_seven     = $request->responce_seven;
         $checkList->responce_eight     = $request->responce_eight;
         $checkList->responce_nine      = $request->responce_nine;
         $checkList->responce_ten       = $request->responce_ten;
         $checkList->responce_eleven    = $request->responce_eleven;
         $checkList->responce_twele     = $request->responce_twele;
         $checkList->responce_thrteen   = $request->responce_thrteen;
         $checkList->responce_fourteen  = $request->responce_fourteen;
         $checkList->responce_fifteen   = $request->responce_fifteen;
         $checkList->responce_sixteen   = $request->responce_sixteen;
         $checkList->responce_seventeen = $request->responce_seventeen;
         $checkList->responce_eighteen  = $request->responce_eighteen;
         $checkList->responce_ninteen   = $request->responce_ninteen;
         $checkList->responce_twenty    = $request->responce_twenty;
         $checkList->responce_twenty_one = $request->responce_twenty_one;
         $checkList->responce_twenty_two = $request->responce_twenty_two;
         $checkList->responce_twenty_three  =  $request->responce_twenty_three;
         $checkList->responce_twenty_four   =  $request->responce_twenty_four;
         $checkList->responce_twenty_five   =  $request->responce_twenty_five;
         $checkList->responce_twenty_six    =  $request->responce_twenty_six;
         $checkList->responce_twenty_seven  =  $request->responce_twenty_seven;
         $checkList->responce_twenty_eight  =  $request->responce_twenty_eight;
         $checkList->responce_twenty_nine   =  $request->responce_twenty_nine;
         $checkList->responce_thirty        =  $request->responce_thirty;
         $checkList->responce_thirty_one    =  $request->responce_thirty_one;
         $checkList->responce_thirty_two    =  $request->responce_thirty_two;
         $checkList->responce_thirty_three  =  $request->responce_thirty_three;
         $checkList->responce_thirty_four	=  $request->responce_thirty_four;
         $checkList->remark_one             = $request->remark_one;
         $checkList->remark_two             = $request->remark_two;
         $checkList->remark_three           = $request->remark_three;
         $checkList->remark_four            = $request->remark_four;
         $checkList->remark_five            = $request->remark_five;
         $checkList->remark_six             = $request->remark_six;
         $checkList->remark_seven           = $request->remark_seven;
         $checkList->remark_eight           = $request->remark_eight;
         $checkList->remark_nine            = $request->remark_nine;
         $checkList->remark_ten             = $request->remark_ten;
         $checkList->remark_eleven          = $request->remark_eleven;
         $checkList->remark_twele           = $request->remark_twele;
         $checkList->remark_thrteen         = $request->remark_thrteen;
         $checkList->remark_fourteen        = $request->remark_fourteen;
         $checkList->remark_fifteen         = $request->remark_fifteen;
         $checkList->remark_sixteen         = $request->remark_sixteen;
         $checkList->remark_seventeen       = $request->remark_seventeen;
         $checkList->remark_eighteen        = $request->remark_eighteen;
         $checkList->remark_ninteen         = $request->remark_ninteen;
         $checkList->remark_twenty          = $request->remark_twenty;
         $checkList->remark_twenty_one      = $request->remark_twenty_one;
         $checkList->remark_twenty_two      = $request->remark_twenty_two;
         $checkList->remark_twenty_three    = $request->remark_twenty_three;
         $checkList->remark_twenty_four     = $request->remark_twenty_four;
         $checkList->remark_twenty_five     = $request->remark_twenty_five;
         $checkList->remark_twenty_six      = $request->remark_twenty_six;
         $checkList->remark_twenty_seven    = $request->remark_twenty_seven;
         $checkList->remark_twenty_eight    = $request->remark_twenty_eight;
         $checkList->remark_twenty_nine     = $request->remark_twenty_nine;
         $checkList->remark_thirty          = $request->remark_thirty;
         $checkList->remark_thirty_one      = $request->remark_thirty_one;
         $checkList->remark_thirty_two      = $request->remark_thirty_two;
         $checkList->remark_thirty_three    = $request->remark_thirty_three;
         $checkList->remark_thirty_four     = $request->remark_thirty_four;
         $checkList->l_e_i_oot              = $request->l_e_i_oot;
         $checkList->elaborate_the_reson    = $request->elaborate_the_reson;
         $checkList->in_charge              = $request->in_charge;
         $checkList->pli_head_designee      = $request->pli_head_designee;
        $checkList->update();



        if ($lastDocument->division_code != $data->division_code) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Save';
            $history->previous =  $lastDocument->division_code;
            $history->current = $data->division_code;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->due_date) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Due Date';
            $history->previous = $lastDocument->due_date;
            $history->current = $data->due_date;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->initiated_through) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Initiated Through';
            $history->previous = $lastDocument->initiated_through;
            $history->current = $data->initiated_through;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->if_others) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'If Others';
            $history->previous = $lastDocument->if_others;
            $history->current = $data->if_others;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->is_repeat) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Is Repeat';
            $history->previous = $lastDocument->is_repeat;
            $history->current = $data->is_repeat;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->repeat_nature) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = $lastDocument->repeat_nature;
            $history->current = $data->repeat_nature;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->natureofChange) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Nature Of Change';
            $history->previous = $lastDocument->natureOfChange;
            $history->current = $data->natureOfChange;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        
        if ($lastDocument->oot_occured_on) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Oot Occured On';
            $history->previous = $lastDocument->oot_occured_on;
            $history->current = $data->oot_occured_on;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->oot_details) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Oot Details';
            $history->previous = $lastDocument->oot_details;
            $history->current = $data->oot_details;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastDocument->producct_history) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Product History';
            $history->previous = $lastDocument->producct_history;
            $history->current = $data->producct_history;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->probble_cause) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Probble Cause';
            $history->previous = $lastDocument->probble_cause;
            $history->current = $data->probble_cause;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->investigation_details) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Investigation Details';
            $history->previous = $lastDocument->investigation_details;
            $history->current = $data->investigation_details;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->comments) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Comments';
            $history->previous = $lastDocument->comments;
            $history->current = $data->comments;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }


        if ($lastDocument->productmaterialname) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Product Material Name';
            $history->previous = $lastDocument->productmaterialname;
            $history->current = $data->productmaterialname;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->grade_typeofwater) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Grade Type Of Water';
            $history->previous = $lastDocument->grade_typeofwater;
            $history->current = $data->grade_typeofwater;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->sampleLocation_Point) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Sample Location Point';
            $history->previous = $lastDocument->sampleLocation_Point;
            $history->current = $data->sampleLocation_Point;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->market) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Market';
            $history->previous = $lastDocument->market;
            $history->current = $data->market;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->customer) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'customer';
            $history->previous = $lastDocument->customer;
            $history->current = $data->customer;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->analyst_name) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Analyst Name';
            $history->previous = $lastDocument->analyst_name;
            $history->current = $data->analyst_name;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->reference_record) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Reference Record';
            $history->previous = $lastDocument->reference_record;
            $history->current = $data->reference_record;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->others) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Others';
            $history->previous = $lastDocument->others;
            $history->current = $data->others;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->stability_for) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'stability For';
            $history->previous = $lastDocument->stability_for;
            $history->current = $data->stability_for;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }
       
        toastr()->success('Record is Update Successfully');
        return back();
    }

    public function OotAuditTrial($id){
        // dd('requ');
        $audit = OotAuditTrial::where('ootcs_id', $id)->orderByDESC('id')->paginate(5);
        // dd($audit);
        $today = Carbon::now()->format('d-m-y');
        $document = Ootc::where('id', $id)->first();
        $document->originator = User::where('id', $document->initiator_id)->value('name');
        // dd($document);

        return view('frontend.OOT.audit_trial',compact('document','audit','today'));
    }
    
    public function OotAuditDetail($id){
        $detail = OotAuditTrial::find($id);

        $detail_data = OotAuditTrial::where('activity_type', $detail->activity_type)->where('ootcs_id', $detail->ootcs_id)->latest()->get();

        $doc = Ootc::where('id', $detail->ootcs_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);

        return view('frontend.OOT.audit_detail',compact('detail','detail_data','doc'));
    }

    public function singleReport(Request $request, $id){
        $data = Ootc::find($id);
       $grid_product_mat = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'product_materiel'])->first();
    //    dd($grid_product_mat);
       $gridStability = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'details_of_stability'])->first();
       $GridOotRes = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'oot_result'])->first();
       $InfoProductMat = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'info_product'])->first();
       $checkList =OotChecklist::where(['ootcs_id' => $id])->first();

        if(!empty($data)){
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.OOT.singleReports', compact('data','grid_product_mat','gridStability','GridOotRes','InfoProductMat','checkList'))
                ->setOptions([
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'isPhpEnabled' => true,
            ]);
            $pdf->setPaper('A4');
            $pdf->render();
            $canvas = $pdf->getDomPDF()->getCanvas();
            $height = $canvas->get_height();
            $width = $canvas->get_width();
            $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');
            $canvas->page_text($width / 4, $height / 2, $data->status, null, 25, [0, 0, 0], 2, 6, -20);
            return $pdf->stream('Oot' . $id . '.pdf');
        }
    }

    public function oot_send_stage(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changestage = Ootc::find($id);
            $lastDocument = Ootc::find($id);
            if ($changestage->stage == 1) {
                $changestage->stage = "2";
                $changestage->status = "Pending Lab Supervisor Review";
                $changestage->submited_By = Auth::user()->name;
                $changestage->submited_on = Carbon::now()->format('d-M-Y');
                $changestage->a_l_comments = $request->comments;
                // dd($changestage->a_l_comments);
                                $history = new OotAuditTrial();
                                $history->ootcs_id = $id;
                                $history->activity_type = 'Activity Log';
                                $history->current = $changestage->Completed_By;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->id;
                                $history->user_name = Auth::user()->name;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = "Submited";
                                $history->action = "Submit";
                                $history->change_to = "Pending Lab Supervisor Review";
                                $history->change_from = $lastDocument->status;
                                $history->save();
                            //     $list = Helpers::getLeadAuditeeUserList();
                            //     foreach ($list as $u) {
                            //         if($u->q_m_s_divisions_id == $changestage->division_id){
                            //             $email = Helpers::getInitiatorEmail($u->user_id);
                            //              if ($email !== null) {
                                      
                            //               Mail::send(
                            //                   'mail.view-mail',
                            //                    ['data' => $changestage],
                            //                 function ($message) use ($email) {
                            //                     $message->to($email)
                            //                         ->subject("Document sent ".Auth::user()->name);
                            //                 }
                            //               );
                            //             }
                            //      } 
                            //   }
                $changestage->update();
                // dd($changestage);
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 2) {
                $changestage->stage = "3";
                $changestage->status = "Pending preliminary lab investigation";
                $changestage->pls_submited_by = Auth::user()->name;
                $changestage->pls_submited_on = Carbon::now()->format('d-M-Y');
                $changestage->pls_comments = $request->comments;
                // dd($changestage->pls_comments);
                            $history = new OotAuditTrial();
                            $history->ootcs_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changestage->pls_completed_by;
                            $history->comment = $request->comments;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Preliminary Lab Investigation";
                            $history->action = "Submit";
                                $history->change_to = "Pending preliminary lab investigation";
                                $history->change_from = $lastDocument->status;
                            $history->save();
                    //     $list = Helpers::getQAUserList();
                    //     foreach ($list as $u) {
                    //         if($u->q_m_s_divisions_id == $changestage->division_id){
                    //             $email = Helpers::getInitiatorEmail($u->user_id);
                    //              if ($email !== null) {
                            
                    //               Mail::send(
                    //                   'mail.view-mail',
                    //                    ['data' => $changestage],
                    //                 function ($message) use ($email) {
                    //                     $message->to($email)
                    //                         ->subject("Document sent ".Auth::user()->name);
                    //                 }
                    //               );
                    //             }
                    //      } 
                    //   }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 3) {
                $changestage->stage = "4";
                $changestage->status = "Pending Capa";
                $changestage->ppli_submited_by = Auth::user()->name;
                $changestage->ppli_submited_on = Carbon::now()->format('d-M-Y');
                $changestage->ppli_comments = $request->comments;
                            $history = new OotAuditTrial();
                            $history->ootcs_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changestage->pei_completed_by   ;
                            $history->comment = $request->comments;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Lab Error Identified";
                            $history->action = "Submit";
                                $history->change_to = "Pending Capa";
                                $history->change_from = $lastDocument->status;
                            $history->save();
                        //     $list = Helpers::getLeadAuditeeUserList();
                        //     foreach ($list as $u) {
                        //         if($u->q_m_s_divisions_id == $changestage->division_id){
                        //             $email = Helpers::getInitiatorEmail($u->user_id);
                        //              if ($email !== null) {
                                  
                        //               Mail::send(
                        //                   'mail.view-mail',
                        //                    ['data' => $changestage],
                        //                 function ($message) use ($email) {
                        //                     $message->to($email)
                        //                         ->subject("Document sent ".Auth::user()->name);
                        //                 }
                        //               );
                        //             }
                        //      } 
                        //   }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changestage->stage == 4) {
                $changestage->stage = "6";
                $changestage->status = "Pending Final Approval";
                $changestage->p_capa_submited_by = Auth::user()->name;
                // dd($changestage->pei_submited_by);
                $changestage->p_capa_submited_on = Carbon::now()->format('d-M-Y');
                $changestage->p_capa_comments = $request->comments;
                            $history = new OotAuditTrial();
                            $history->ootcs_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changestage->pei_completed_by   ;
                            $history->comment = $request->comments;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Correction Complete";
                            $history->action = "Submit";
                                $history->change_to = "Pending Final Approval";
                                $history->change_from = $lastDocument->status;
                            $history->save();
                        //     $list = Helpers::getLeadAuditeeUserList();
                        //     foreach ($list as $u) {
                        //         if($u->q_m_s_divisions_id == $changestage->division_id){
                        //             $email = Helpers::getInitiatorEmail($u->user_id);
                        //              if ($email !== null) {
                                  
                        //               Mail::send(
                        //                   'mail.view-mail',
                        //                    ['data' => $changestage],
                        //                 function ($message) use ($email) {
                        //                     $message->to($email)
                        //                         ->subject("Document sent ".Auth::user()->name);
                        //                 }
                        //               );
                        //             }
                        //      } 
                        //   }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
          
            if ($changestage->stage == 5) {
                $changestage->stage = "4";
                $changestage->status = "Pending CAPA";
                $changestage->final_appruv_submited_by = Auth::user()->name;
                $changestage->final_approve_submited_on = Carbon::now()->format('d-M-Y');
                $changestage->pei_comments = $request->comments;
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->Final_Approval_By;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = "Extended Inv Complete";
                $history->action = "Submit";
                                $history->change_to = "Pending CAPA";
                                $history->change_from = $lastDocument->status;
                $history->save();
                    //     $list = Helpers::getLeadAuditeeUserList();
                    //     foreach ($list as $u) {
                    //         if($u->q_m_s_divisions_id == $changestage->division_id){
                    //             $email = Helpers::getInitiatorEmail($u->user_id);
                    //              if ($email !== null) {
                            
                    //               Mail::send(
                    //                   'mail.view-mail',
                    //                    ['data' => $changestage],
                    //                 function ($message) use ($email) {
                    //                     $message->to($email)
                    //                         ->subject("Document sent ".Auth::user()->name);
                    //                 }
                    //               );
                    //             }
                    //      } 
                    //   }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changestage->stage == 6) {
                $changestage->stage = "7";
                $changestage->status = "Close done";
                $changestage->Final_Approval_By = Auth::user()->name;
                $changestage->Final_Approval_on = Carbon::now()->format('d-M-Y');
                $changestage->final_capa_comments = $request->comments;
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Activity Log';
                $history->current = $changestage->Final_Approval_By;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->stage = " Approval";
                $history->action = "Submit";
                                $history->change_to = "Close done";
                                $history->change_from = $lastDocument->status;
                $history->save();
                //     $list = Helpers::getLeadAuditeeUserList();
                //     foreach ($list as $u) {
                //         if($u->q_m_s_divisions_id == $changestage->division_id){
                //             $email = Helpers::getInitiatorEmail($u->user_id);
                //              if ($email !== null) {
                        
                //               Mail::send(
                //                   'mail.view-mail',
                //                    ['data' => $changestage],
                //                 function ($message) use ($email) {
                //                     $message->to($email)
                //                         ->subject("Document sent ".Auth::user()->name);
                //                 }
                //               );
                //             }
                //      } 
                //   }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function oot_reject(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $data = Ootc::find($id);
            $lastDocument = Ootc::find($id);

            if ($data->stage == 2) {
                $data->stage = "1";
                $data->status = "Opened";
                // $capa->rejected_by = Auth::user()->name;
                // $capa->rejected_on = Carbon::now()->format('d-M-Y');
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 3) {
                $data->stage = "2";
                $data->status = "Pending Lab Supervisor Review";
                // $data->ppli_submited_by = Auth::user()->name;
                // $data->ppli_submited_on = Carbon::now()->format('d-M-Y');
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 4) {
                $data->stage = "3";
                $data->status = "Pending preliminary lab investigation";
                $data->ppli_submited_by = Auth::user()->name;
                $data->ppli_submited_by = Carbon::now()->format('d-M-Y');
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($data->stage == 5) {
                $data->stage = "3";
                $data->status = "Pending Preliminary Lab Investigation";
                $data->ppli_submited_by = Auth::user()->name;
                $data->ppli_submited_by = Carbon::now()->format('d-M-Y');
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($data->stage == 6) {
                $data->stage = "4";
                $data->status = "Pending CAPA";
                $data->ppli_submited_by = Auth::user()->name;
                $data->ppli_submited_by = Carbon::now()->format('d-M-Y');
                toastr()->success('Document Sent');
                $data->update();
                return back();
            }

            if ($data->stage == 7) {
                $data->stage = "6";
                $data->status = "Pending final approval";
                $data->ppli_submited_by = Auth::user()->name;
                $data->ppli_submited_by = Carbon::now()->format('d-M-Y');
                toastr()->success('Document Sent');
                $data->update();
                return back();
            }

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function stageChange(Request $request, $id){

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changestage = Ootc::find($id);
            $lastDocument = Ootc::find($id);
                $changestage->stage = "5";
                $changestage->status = "Pending Extended Investigation";
                $changestage->pei_submited_by = Auth::user()->name;
                $changestage->pei_submited_on = Carbon::now()->format('d-M-Y');
                $changestage->pei_comments =$request->comments;
                                $history = new OotAuditTrial();
                                $history->ootcs_id = $id;
                                $history->activity_type = 'Activity Log';
                                $history->current = $changestage->Completed_By;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->id;
                                $history->user_name = Auth::user()->name;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = "Lab Error Not Idenfied";
                                $history->save();
                            //     $list = Helpers::getLeadAuditeeUserList();
                            //     foreach ($list as $u) {
                            //         if($u->q_m_s_divisions_id == $changestage->division_id){
                            //             $email = Helpers::getInitiatorEmail($u->user_id);
                            //              if ($email !== null) {
                                      
                            //               Mail::send(
                            //                   'mail.view-mail',
                            //                    ['data' => $changestage],
                            //                 function ($message) use ($email) {
                            //                     $message->to($email)
                            //                         ->subject("Document sent ".Auth::user()->name);
                            //                 }
                            //               );
                            //             }
                            //      } 
                            //   }
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            
        }
    }

    public function ootCancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $data = Ootc::find($id);
            $lastDocument = Ootc::find($id);
            $data->stage = "0";
            $data->status = "Closed-Cancelled";
            $data->cancelled_by = Auth::user()->name;
            $data->cancelled_on = Carbon::now()->format('d-M-Y');
                    $history = new OotAuditTrial();
                    $history->ootcs_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous ="";
                    $history->current = $data->cancelled_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state =  $data->status;
                    $history->stage = 'Cancelled';
                    $history->save();
            $data->update();
            $history = new OotAuditTrial();
            $history->activity_type = "OOT";
            $history->ootcs_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage = $data->stage;
            // $history->status = $data->status;
            $history->save();

            // $list = Helpers::getInitiatorUserList();
            // foreach ($list as $u) {
            //     if($u->q_m_s_divisions_id == $capa->division_id){
            //       $email = Helpers::getInitiatorEmail($u->user_id);
            //       if ($email !== null) {
                    
            //         Mail::send(
            //             'mail.view-mail',
            //             ['data' => $capa],
            //             function ($message) use ($email) {
            //                 $message->to($email)
            //                     ->subject("Cancelled By ".Auth::user()->name);
            //             }
            //          );
            //       }
            //     } 
            // }

            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function auditTiailPdf(Request $request,$id){

        $doc = Ootc::find($id);
        $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        $data = OotAuditTrial::where('ootcs_id', $doc->id)->orderByDesc('id')->get();
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.OOT.audit_trail_pdf', compact('data', 'doc'))
            ->setOptions([
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'isPhpEnabled' => true,
            ]);
        $pdf->setPaper('A4');
        $pdf->render();
        $canvas = $pdf->getDomPDF()->getCanvas();
        $height = $canvas->get_height();
        $width = $canvas->get_width();

        $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');

        $canvas->page_text(
            $width / 3,
            $height / 2,
            $doc->status,
            null,
            60,
            [0, 0, 0],
            2,
            6,
            -20
        );
        return $pdf->stream('SOP' . $id . '.pdf');
        
        // return view('frontend.OOT.audit_trail_pdf');

    }
    
}
