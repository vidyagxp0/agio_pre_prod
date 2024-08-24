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
use App\Models\QMSDivision;
use Carbon\Carbon;
use App\Models\Capa;
use App\Models\User;
use App\Models\OpenStage;
use App\Models\RcmsDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use PDF;
use Helpers;
use Illuminate\Support\Facades\Hash;

class OOTController extends Controller
{
    public function index(Request $request)
    {
        $cft = [];
        $old_record = Ootc::select('id', 'division_id', 'record_number')->get();
        $data = ((RecordNumber::first()->value('counter')) + 1);
        $data = str_pad($data, 4, '0', STR_PAD_LEFT);

        $division = QMSDivision::where('name', Helpers::getDivisionName(session()->get('division')))->first();

        if ($division) {
            $ootData = Ootc::where('division_id', $division->id)->latest()->first();

            // if ($ootData) {
            //     $record_number = $ootData->record_number ? str_pad($ootData->record_number->record_number + 1, 4, '0', STR_PAD_LEFT) : '0001';
            // } else {
            //     $record_number = '0001';
            // }

            if (is_object($ootData) && isset($ootData->record_number)) {
                // Ensure $ootData->record_number is an object and has the property record_number
                if (is_object($ootData->record_number) && isset($ootData->record_number->record_number)) {
                    $record_number = str_pad($ootData->record_number->record_number + 1, 4, '0', STR_PAD_LEFT);
                } else {
                    $record_number = '0001'; // Default value if the structure is not as expected
                }
            } else {
                $record_number = '0001'; // Default value if $ootData is not an object or doesn't have record_number
            }
        }

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date= $formattedDate->format('Y-m-d');
        $changeControl = OpenStage::find(1);
         if(!empty($changeControl->cft)) $cft = explode(',', $changeControl->cft);

        return view('frontend.OOT.OOT_form', compact('old_record', 'data','division', 'due_date'));
    }

    public function store(Request $request)
    {

        $data = new Ootc();
        $data->initiator_id          = Auth::user()->id;
        $data->record_number         = ((RecordNumber::first()->value('counter')) + 1);
        $data->intiation_date        = $request->intiation_date;
        $data->due_date              = $request->due_date;
        $data->due_date              = Carbon::now()->addDays(30)->format('d-M-Y');
        $data->division_id           = $request->division_id;
        // $data->severity_level        = $request->severity_level;
        $data->initiator_group       = $request->initiator_group;
        $data->initiator_group_code  = $request->initiator_group_code;
        $data->initiated_through     = $request->initiated_through;
        $data->short_description     = $request->short_description;
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
        // $data->reference             = $request->reference;
        $data->reference             = implode(',', $request->reference);
         $data->productmaterialname   = $request->productmaterialname;
        $data->grade_typeofwater      = $request->grade_typeofwater;
        $data->sampleLocation_Point   = $request->sampleLocation_Point;
        $data->market                 = $request->market;
        $data->customer               = $request->customer;
        $data->analyst_name           = $request->analyst_name;
        $data->others                 = $request->others;
        $data->reference_record       = $request->reference_record;
        $data->delay_justification    = $request->delay_justification;
        $data->oot_observed_on        = $request->oot_observed_on;
        $data->oot_report_on          = $request->oot_report_on;
        $data->immediate_action       = $request->immediate_action;

        // if (is_array($request->stability_for)) {
        //     $data->stability_for = implode(',', $request->stability_for);
        // }

        if ($request->stability_for) {
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

        $data->pli_finaly_validity_check          = $request->pli_finaly_validity_check;
        $data->finaly_validity_check              = $request->finaly_validity_check;
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
        $data->save();

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter'))+1);
        $record->update();

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
         $checkList->in_charge                   = $request->in_charge;
         $checkList->pli_head_designee           = $request->pli_head_designee;
         $checkList->data                        = $request->data;
        //   dd($checkList->data);
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

        $productDetail = ProductGridOot::where(['ootcs_id' => $data->id, 'identifier' =>'product_detail'])->firstOrCreate();
        $productDetail->ootcs_id = $data->id;
        $productDetail->identifier = 'product_detail';
        $productDetail->data = $request->product_detail;
        $productDetail->save();


        if (!empty($data->division_code)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'division_code';
            $history->previous = "Null";
            $history->current = $data->division_code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->save();
        }



        if (!empty($data->due_date)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Due date';
            $history->previous = "Null";
            $history->current = $data->due_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->initiated_through)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Initiated Through';
            $history->previous = "Null";
            $history->current = $data->initiated_through;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->short_description)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $data->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->if_others)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'If others';
            $history->previous = "Null";
            $history->current = $data->if_others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->is_repeat)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'is_repeat';
            $history->previous = "Null";
            $history->current = $data->is_repeat;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->repeat_nature)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = "Null";
            $history->current = $data->repeat_nature;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->natureOfChange)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Nature Of Change';
            $history->previous = "Null";
            $history->current = $data->natureOfChange;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


        if (!empty($data->oot_occured_on)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Oot Occured On';
            $history->previous = "Null";
            $history->current = $data->oot_occured_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->oot_details)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Oot Details';
            $history->previous = "Null";
            $history->current = $data->oot_details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->producct_history)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Product His';
            $history->previous = "Null";
            $history->current = $data->producct_history;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->producct_history)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Product History';
            $history->previous = "Null";
            $history->current = $data->producct_history;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->probble_cause)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Probble Cause';
            $history->previous = "Null";
            $history->current = $data->probble_cause;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->investigation_details)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Investigation Details';
            $history->previous = "Null";
            $history->current = $data->investigation_details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->comments)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Comments';
            $history->previous = "Null";
            $history->current = $data->comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }



        if (!empty($data->productmaterialname)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Product Material Name';
            $history->previous = "Null";
            $history->current = $data->productmaterialname;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->grade_typeofwater)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Grade Type Of Water';
            $history->previous = "Null";
            $history->current = $data->grade_typeofwater;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->sampleLocation_Point)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Sample Location Point';
            $history->previous = "Null";
            $history->current = $data->sampleLocation_Point;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->market)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Market';
            $history->previous = "Null";
            $history->current = $data->market;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->customer)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'customer';
            $history->previous = "Null";
            $history->current = $data->market;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->analyst_name)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'analyst_name';
            $history->previous = "Null";
            $history->current = $data->analyst_name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->reference_record)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Reference Record';
            $history->previous = "Null";
            $history->current = $data->reference_record;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->others)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Others';
            $history->previous = "Null";
            $history->current = $data->others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->stability_for)) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'stability For';
            $history->previous = "Null";
            $history->current = $data->stability_for;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }


    public function ootShow($id){

        $cft = [];
        $revised_date = "";

        //dd($data);

        $data = Ootc::where('id',$id)->first();
        $old_record = Ootc::select('id', 'division_id', 'record_number')->get();
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');


       $formattedDate = Helpers::getdateFormat($data->due_date);
       $occuredDate = Helpers::getdateFormat($data->oot_occured_on);
       $grid_product_mat = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'product_materiel'])->first();
    //    dd($grid_product_mat);
       $gridStability = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'details_of_stability'])->first();
       $GridOotRes = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'oot_result'])->first();
    // dd($GridOotRes);
       $InfoProductMat = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'info_product'])->first();
       $productDetail = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'product_detail'])->first();



       $checkList = OotChecklist::where(['ootcs_id' => $id,  ])->first();

       $record_number = ((RecordNumber::first()->value('counter')) + 1);
       $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        return view('frontend.OOT.ootView',compact('data','record_number','grid_product_mat','checkList','gridStability','GridOotRes','InfoProductMat','formattedDate','occuredDate','old_record','productDetail'));

    }

    public function update( Request $request,$id){
        $lastDocument = Ootc::find($id);



        $data = Ootc::find($id);
        // $data->division_id           = $request->division_id;
        $data->record_number         = $lastDocument->record_number;
        // dd($lastDocument->record_number);
        $data->due_date              = $request->due_date;
        // $data->severity_level        = $request->severity_level;
        $data->due_date = Carbon::now()->addDays(30)->format('d-M-Y');
        $data->initiator_group       = $request->initiator_group;
        // $data->initiator_group_code  =$request->initiator_group_code;
        $data->initiated_through     = $request->initiated_through;
        $data->short_description     = $request->short_description;
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
        $data->reference             = implode('',$request->reference );
        $data->productmaterialname   = $request->productmaterialname;
        $data->grade_typeofwater     = $request->grade_typeofwater;
        $data->sampleLocation_Point  = $request->sampleLocation_Point;
        $data->market                = $request->market;
        $data->customer              = $request->customer;
        $data->analyst_name          = $request->analyst_name;
        $data->others                = $request->others;
        $data->reference_record      = $request->reference_record;

        $data->delay_justification    = $request->delay_justification;
        $data->oot_observed_on        = $request->oot_observed_on? $request->oot_observed_on : $data->oot_observed_on;
        $data->oot_report_on          = $request->oot_report_on? $request->oot_report_on : $data->oot_report_on;
        $data->immediate_action       = $request->immediate_action;

        // if (is_array($request->stability_for )) {
        //     $data->stability_for = implode(',', $request->stability_for);
        // }
        if ($request->stability_for) {
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

        $data->pli_finaly_validity_check             = $request->pli_finaly_validity_check;
        $data->finaly_validity_check                 = $request->finaly_validity_check;
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

        $data->action_taken_result                   = $request->action_taken_result;
        $data->retraining_to_analyst_required        = $request->retraining_to_analyst_required;
        $data->cheklist_part_b_remarks               = $request->cheklist_part_b_remarks;
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
        toastr()->success('Record is Update Successfully');


        $data->update();
        $productDetail = ProductGridOot::where(['ootcs_id' => $data->id, 'identifier' =>'product_detail'])->firstOrCreate();
        $productDetail->ootcs_id = $data->id;
        $productDetail->identifier = 'product_detail';
        $productDetail->data = $request->product_detail;
        $productDetail->update();
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
         $checkList->responce_fourteen      = $request->responce_fourteen;
         $checkList->responce_fifteen       = $request->responce_fifteen;
         $checkList->responce_sixteen       = $request->responce_sixteen;
         $checkList->responce_seventeen     = $request->responce_seventeen;
         $checkList->responce_eighteen      = $request->responce_eighteen;
         $checkList->responce_ninteen       = $request->responce_ninteen;
         $checkList->responce_twenty        = $request->responce_twenty;
         $checkList->responce_twenty_one    = $request->responce_twenty_one;
         $checkList->responce_twenty_two    = $request->responce_twenty_two;
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

         $checkList->data                        = $request->data;
        $checkList->update();
        // dd($checkList);



        if ($lastDocument->division_code != $data->division_code) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'division_code';
            $history->previous =  $lastDocument->division_code;
            $history->current = $data->division_code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->due_date != $data->due_date  ) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Due Date';
            $history->previous = $lastDocument->due_date;
            $history->current = $data->due_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->short_description != $data->short_description) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'short_description';
            $history->previous =  $lastDocument->short_description;
            $history->current = $data->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->initiated_through != $data->initiated_through) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Initiated Through';
            $history->previous = $lastDocument->initiated_through;
            $history->current = $data->initiated_through;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->if_others != $data->if_others) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'If Others';
            $history->previous = $lastDocument->if_others;
            $history->current = $data->if_others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->is_repeat != $data->is_repeat) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Is Repeat';
            $history->previous = $lastDocument->is_repeat;
            $history->current = $data->is_repeat;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->repeat_nature != $data->repeat_nature) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = $lastDocument->repeat_nature;
            $history->current = $data->repeat_nature;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->natureofChange != $data->natureofChange) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Nature Of Change';
            $history->previous = $lastDocument->natureOfChange;
            $history->current = $data->natureOfChange;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }


        if ($lastDocument->oot_occured_on != $data->oot_occured_on) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Oot Occured On';
            $history->previous = $lastDocument->oot_occured_on;
            $history->current = $data->oot_occured_on;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->oot_details != $data->oot_details ) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Oot Details';
            $history->previous = $lastDocument->oot_details;
            $history->current = $data->oot_details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }
        if ($lastDocument->producct_history != $data->producct_history) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Product History';
            $history->previous = $lastDocument->producct_history;
            $history->current = $data->producct_history;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->probble_cause != $data->probble_cause) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Probble Cause';
            $history->previous = $lastDocument->probble_cause;
            $history->current = $data->probble_cause;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->investigation_details != $data->investigation_details) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Investigation Details';
            $history->previous = $lastDocument->investigation_details;
            $history->current = $data->investigation_details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->comments != $data->comments) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Comments';
            $history->previous = $lastDocument->comments;
            $history->current = $data->comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }


        if ($lastDocument->productmaterialname != $data->productmaterialname) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Product Material Name';
            $history->previous = $lastDocument->productmaterialname;
            $history->current = $data->productmaterialname;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->grade_typeofwater != $data->grade_typeofwater) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Grade Type Of Water';
            $history->previous = $lastDocument->grade_typeofwater;
            $history->current = $data->grade_typeofwater;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->sampleLocation_Point != $data->sampleLocation_Point) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Sample Location Point';
            $history->previous = $lastDocument->sampleLocation_Point;
            $history->current = $data->sampleLocation_Point;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->market  != $data-> market) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Market';
            $history->previous = $lastDocument->market;
            $history->current = $data->market;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->customer != $data->market) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'customer';
            $history->previous = $lastDocument->customer;
            $history->current = $data->customer;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->analyst_name != $data->analyst_name) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Analyst Name';
            $history->previous = $lastDocument->analyst_name;
            $history->current = $data->analyst_name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->reference_record != $data->reference_record) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Reference Record';
            $history->previous = $lastDocument->reference_record;
            $history->current = $data->reference_record;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->others != $data-> others) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'Others';
            $history->previous = $lastDocument->others;
            $history->current = $data->others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = "Update";
            $history->save();
        }

        if ($lastDocument->stability_for != $data->stability_for) {
            $history = new OotAuditTrial();
            $history->ootcs_id = $data->id;
            $history->activity_type = 'stability For';
            $history->previous = $lastDocument->stability_for;
            $history->current = $data->stability_for;
            $history->comment = "Not Applicable";
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
        $productDetail = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'product_detail'])->first();

    //    dd($grid_product_mat);
       $gridStability = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'details_of_stability'])->first();
       $GridOotRes = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'oot_result'])->first();
       $InfoProductMat = ProductGridOot::where(['ootcs_id' => $id, 'identifier' => 'info_product'])->first();
       $checkList =OotChecklist::where(['ootcs_id' => $id])->first();

        if(!empty($data)){
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.OOT.singleReports', compact('data','grid_product_mat','gridStability','GridOotRes','InfoProductMat','checkList','productDetail'))
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
                $changestage->submited_by = Auth::user()->name;
                $changestage->submited_on = Carbon::now()->format('d-M-Y');
                $changestage->a_l_comments = $request->comments;
                $changestage->status = "HOD Primary Review";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Submitted By    ,   Submitted On';
                        if (is_null($lastDocument->submited_by) || $lastDocument->submited_by === '') {
                            $history->previous = "Null";
                        } else {
                            $history->previous = $lastDocument->submited_by . ' , ' . $lastDocument->submited_on;
                        }
    
                    $history->current = $changestage->submited_by . ' , ' . $changestage->submited_on;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to = "HOD Primary Review";
                    $history->change_from = $lastDocument->status;
                    // $history->action_name = 'Submit';
                    if (is_null($lastDocument->submited_by) || $lastDocument->submited_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->action = 'Submit';
    
                    $history->stage='Submit';
                    $history->save();
                $changestage->update();
                toastr()->success('HOD Primary Review');
                return back();
            }
            
            if ($changestage->stage == 2) {
                $changestage->stage = "3";
                // $changestage->Request_For_Cancellation_By = Auth::user()->name;
                // $changestage->Request_For_Cancellation_On = Carbon::now()->format('d-M-Y');
                // $changestage->Request_For_Cancellation_Comment = $request->comments;
                $changestage->status = "QA Head Approval";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Request For Cancellation By     ,     Request For Cancellation On';
                if (is_null($lastDocument->Request_For_Cancellation_By) || $lastDocument->Request_For_Cancellation_By === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->Request_For_Cancellation_By . ' , ' . $lastDocument->Request_For_Cancellation_On;
                }
                $history->current = $changestage->Request_For_Cancellation_By . ' , ' . $changestage->Request_For_Cancellation_On;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "CQA/QA Head Primary Review";
                $history->change_from = $lastDocument->status;
                $history->action = 'HOD Primary Review Complete';
                if (is_null($lastDocument->pls_submited_by) || $lastDocument->pls_submited_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='HOD Primary Review Complete';
                $history->save();
    
                
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'HOD Primary Review', 'HOD Primary Review Complete');
                $changestage->update();
                toastr()->success('CQA/QA Head Primary Review');
                return back();
            }

            
    
            if ($changestage->stage == 4) {
                $changestage->stage = "5";
                $changestage->ppli_submited_by = Auth::user()->name;
                $changestage->ppli_submited_on = Carbon::now()->format('d-M-Y');
                $changestage->ppli_comments = $request->comments;
                $changestage->status = "Under Phase-IA Investigation";
    
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = '';
                if (is_null($lastDocument->ppli_submited_by) || $lastDocument->ppli_submited_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->ppli_submited_by . ' , ' . $lastDocument->ppli_submited_on;
                }
                $history->activity_type = 'CQA/QA Head Primary Review Complete By    ,     CQA/QA Head Primary Review Complete  On';
                $history->current = $changestage->ppli_submited_by . ' , ' . $changestage->ppli_submited_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Under Phase-IA Investigation";
                $history->change_from = $lastDocument->status;
                $history->action = 'CQA/QA Head Primary Review Complete';
                $history->stage='CQA/QA Head Primary Review Complete';
                if (is_null($lastDocument->ppli_submited_by) || $lastDocument->ppli_submited_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
    
                $history->save();
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'CQA/QA Head Primary Review', 'CQA/QA Head Primary Review Complete');
                $changestage->update();
                toastr()->success('Under Phase-IA Investigation');
                return back();
            }
    
            if ($changestage->stage == 5) {
                $changestage->stage = "7";
                $changestage->p_capa_submited_by = Auth::user()->name;
                $changestage->p_capa_submited_on = Carbon::now()->format('d-M-Y');
                $changestage->p_capa_comments = $request->comments;
                $changestage->status = "Phase IA HOD Primary Review";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Phase IA Investigation By     ,     Phase IA Investigation On';
                if (is_null($lastDocument->p_capa_submited_by) || $lastDocument->p_capa_submited_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->p_capa_submited_by . ' , ' . $lastDocument->p_capa_submited_on;
                }
    
                // $history->previous = $lastDocument->p_capa_submited_by;
                $history->current = $changestage->p_capa_submited_by . ' , ' . $changestage->p_capa_submited_on;
                // $history->current = $changestage->p_capa_submited_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Phase IA HOD Primary Review";
                $history->change_from = $lastDocument->status;
                $history->action = 'Phase IA Investigation';
                if (is_null($lastDocument->p_capa_submited_by) || $lastDocument->p_capa_submited_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
    
                $history->stage='Phase IA Investigation';
                $history->save();
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'Phase IA Investigation', 'Phase IA HOD Primary Review');
                $changestage->update();
                toastr()->success('Phase IA HOD Primary Review');
                return redirect()->back();
            }
    
            if ($changestage->stage == 7) {
                $changestage->stage = "8";
                $changestage->Final_Approval_By = Auth::user()->name;
                $changestage->Final_Approval_on = Carbon::now()->format('d-M-Y');
                $changestage->final_capa_comments = $request->comments;
                $changestage->status = "Phase IA QA Review";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Phase IA HOD Review Complete By   ,  Phase IA HOD Review Complete On';
                // $history->previous = $lastDocument->Final_Approval_By;
                if (is_null($lastDocument->Final_Approval_By) || $lastDocument->Final_Approval_By === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->Final_Approval_By . ' , ' . $lastDocument->Final_Approval_on;
                }
                $history->current = $changestage->Final_Approval_By . ' , ' . $changestage->Final_Approval_on;
                // $history->current = $changestage->Final_Approval_By;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Phase IA QA Review";
                $history->change_from = $lastDocument->status;
                $history->action = 'Phase IA HOD Review Complete';
                if (is_null($lastDocument->Final_Approval_By) || $lastDocument->Final_Approval_By === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Phase IA HOD Review Complete';
                $history->save();
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'Obvious Results Not Found', 'Under Stage II B Investigation');
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
    
            if ($changestage->stage == 8) {
                $changestage->stage = "9";
                $changestage->cause_i_completed_by = Auth::user()->name;
                $changestage->cause_i_completed_on = Carbon::now()->format('d-M-Y');
                $changestage->correction_data_comment = $request->comments;
                $changestage->status = "P-IA CQAH/QAH Review";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Phase IA QA Review Complete By   ,    Phase IA QA Review Complete On';
                // $history->previous = $lastDocument->cause_i_completed_by;
                if (is_null($lastDocument->cause_i_completed_by) || $lastDocument->cause_i_completed_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->cause_i_completed_by . ' , ' . $lastDocument->cause_i_completed_on;
                }
    
                // $history->current = $changestage->cause_i_completed_by;
                $history->current = $changestage->cause_i_completed_by . ' , ' . $changestage->cause_i_completed_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "P-IA CQAH/QAH Review";
                $history->change_from = $lastDocument->status;
                $history->action = 'Phase IA QA Review Complete';
                if (is_null($lastDocument->cause_i_completed_by) || $lastDocument->cause_i_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Phase IA QA Review Complete';
                $history->save();
    
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'Phase IA QA Review Complete', 'P-IA CQAH/QAH Review');
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
    
            if ($changestage->stage == 9) {
                $changestage->stage = "10";
                $changestage->approved_data_completed_by = Auth::user()->name;
                $changestage->approved_data_completed_on = Carbon::now()->format('d-M-Y');
                $changestage->approved_data_comment = $request->comments;
                $changestage->status = "Closed-Done";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Assignable Cause Found Complete By     ,    Assignable Cause Found Complete On';
                if (is_null($lastDocument->approved_data_completed_by) || $lastDocument->approved_data_completed_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->approved_data_completed_by . ' , ' . $lastDocument->approved_data_completed_on;
                }
                $history->current = $changestage->approved_data_completed_by . ' , ' . $changestage->approved_data_completed_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Closed-Done";
                $history->change_from = $lastDocument->status;
                $history->action = 'Assignable Cause Found';
                if (is_null($lastDocument->approved_data_completed_by) || $lastDocument->approved_data_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Assignable Cause Found';
                $history->save();
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'Assignable Cause Found', 'Closed-Done');
                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }
    
            if ($changestage->stage == 11) {
                $changestage->stage = "12";
                $changestage->correction_ooT_completed_by = Auth::user()->name;
                $changestage->correction_ooT_completed_on = Carbon::now()->format('d-M-Y');
                $changestage->correction_ooT_comment = $request->comments;
                $changestage->status = "Phase IB HOD Primary Review";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Activity Log';
                if (is_null($lastDocument->correction_data_completed_by) || $lastDocument->correction_data_completed_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->correction_data_completed_by . ' , ' . $lastDocument->correction_data_completed_on;
                }
                $history->current = $changestage->correction_data_completed_by . ' , ' . $changestage->correction_data_completed_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Phase IB HOD Primary Review";
                $history->change_from = $lastDocument->status;
                $history->action = 'Phase IB Investigation';
                if (is_null($lastDocument->correction_data_completed_by) || $lastDocument->correction_data_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Phase IB Investigation';
                $history->save();
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'Phase IB Investigation', 'Phase IB HOD Primary Review');
                $changestage->update();
                toastr()->success('Phase IB HOD Primary Review');
                return back();
            }
    
            if ($changestage->stage == 12) {
                $changestage->stage = "13";
                $changestage->Phase_IB_HOD_Review_Completed_BY = Auth::user()->name;
                $changestage->Phase_IB_HOD_Review_Completed_ON = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IB_HOD_Review_Completed_Comment = $request->comments;
                $changestage->status = "Phase IB QA Review";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Phase IB HOD Review Complete By   ,    Phase IB HOD Review Complete On';
                // $history->previous = $lastDocument->Phase_IB_HOD_Review_Completed_BY;
                if (is_null($lastDocument->Phase_IB_HOD_Review_Completed_BY) || $lastDocument->Phase_IB_HOD_Review_Completed_BY === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->Phase_IB_HOD_Review_Completed_BY . ' , ' . $lastDocument->Phase_IB_HOD_Review_Completed_ON;
                }
                $history->current = $changestage->Phase_IB_HOD_Review_Completed_BY . ' , ' . $changestage->Phase_IB_HOD_Review_Completed_ON;
                // $history->current = $changestage->Phase_IB_HOD_Review_Completed_BY;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Phase IB QA Review";
                $history->change_from = $lastDocument->status;
                $history->action = 'Phase IB HOD Review Complete';
                if (is_null($lastDocument->Phase_IB_HOD_Review_Completed_BY) || $lastDocument->Phase_IB_HOD_Review_Completed_BY === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Phase IB HOD Review Complete';
                $history->save();
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'Phase IB HOD Review Complete ', 'Phase IB QA Review');
                $changestage->update();
                toastr()->success('Phase IB QA Review');
                return back();
            }
    
            if ($changestage->stage == 13) {
                $changestage->stage = "14";
                $changestage->Phase_IB_QA_Review_Complete_12_by = Auth::user()->name;
                $changestage->Phase_IB_QA_Review_Complete_12_on = Carbon::now()->format('d-M-Y');
                $changestage->Phase_IB_QA_Review_Complete_12_comment = $request->comments;
                $changestage->status = "P-IB CQAH/QAH Review";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Phase IA HOD Review Complete By   , Phase IA HOD Review Complete On';
                if (is_null($lastDocument->Phase_IB_QA_Review_Complete_12_by) || $lastDocument->Phase_IB_QA_Review_Complete_12_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->Phase_IB_QA_Review_Complete_12_by . ' , ' . $lastDocument->Phase_IB_QA_Review_Complete_12_on;
                }
                // $history->previous = $lastDocument->Phase_IB_QA_Review_Complete_12_by;
                $history->current = $changestage->Phase_IB_QA_Review_Complete_12_by . ' , ' . $changestage->Phase_IB_QA_Review_Complete_12_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "P-IB CQAH/QAH Review";
                $history->change_from = $lastDocument->status;
                $history->action = 'Phase IA HOD Review Complete';
                if (is_null($lastDocument->Phase_IB_QA_Review_Complete_12_by) || $lastDocument->Phase_IB_QA_Review_Complete_12_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Phase IA HOD Review Complete';
                $history->save();
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'Phase IB QA Review Complete', 'P-IB CQAH/QAH Review');
                $changestage->update();
                toastr()->success('P-IB CQAH/QAH Review');
                return back();
            }
            if ($changestage->stage == 14) {
                $changestage->stage = "15";
                $changestage->P_IB_Assignable_Cause_Found_by = Auth::user()->name;
                $changestage->P_IB_Assignable_Cause_Found_on = Carbon::now()->format('d-M-Y');
                $changestage->P_IB_Assignable_Cause_Found_comment = $request->comments;
                $changestage->status = "Closed Done";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'P-IB Assignable Cause Found By  ,  P-IB Assignable Cause Found On';
                if (is_null($lastDocument->P_IB_Assignable_Cause_Found_by) || $lastDocument->P_IB_Assignable_Cause_Found_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->P_IB_Assignable_Cause_Found_by . ' , ' . $lastDocument->Phase_IB_QA_Review_Complete_12_on;
                }
                $history->current = $changestage->P_IB_Assignable_Cause_Found_by . ' , ' . $changestage->P_IB_Assignable_Cause_Found_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Closed Done";
                $history->change_from = $lastDocument->status;
                $history->action = 'P-IB Assignable Cause Found';
                if (is_null($lastDocument->P_IB_Assignable_Cause_Found_by) || $lastDocument->P_IB_Assignable_Cause_Found_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='P-IB Assignable Cause Found';
                $history->save();
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'P-IB Assignable Cause Found', 'Closed Done');
                $changestage->update();
                toastr()->success('Closed Done');
                return back();
            }
            if ($changestage->stage == 16) {
                $changestage->stage = "17";
                $changestage->Phase_II_A_Investigation_by = Auth::user()->name;
                $changestage->Phase_II_A_Investigation_on = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_A_Investigation_comment = $request->comments;
                $changestage->status = "Phase II A HOD Primary Review";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Phase II A Investigation By , Phase II A Investigation On';
                if (is_null($lastDocument->Phase_II_A_Investigation_by) || $lastDocument->Phase_II_A_Investigation_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->Phase_II_A_Investigation_by . ' , ' . $lastDocument->Phase_II_A_Investigation_on;
                }
                // $history->previous = $lastDocument->Phase_II_A_Investigation_by;
                $history->current = $changestage->Phase_II_A_Investigation_by . ' , ' . $changestage->Phase_II_A_Investigation_on;
                $history->current = $changestage->Phase_II_A_Investigation_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Phase II A HOD Primary Review";
                $history->change_from = $lastDocument->status;
                $history->action = 'Phase II A Investigation';
                $history->stage='Phase II A Investigation';
                if (is_null($lastDocument->Phase_II_A_Investigation_by) || $lastDocument->Phase_II_A_Investigation_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                
                $history->save();
                $changestage->update();
                toastr()->success('Phase II A HOD Primary Review');
                return back();
            }
            if ($changestage->stage == 17) {
                $changestage->stage = "18";
                $changestage->Phase_II_A_HOD_Review_Complete_by = Auth::user()->name;
                $changestage->Phase_II_A_HOD_Review_Complete_on = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_A_HOD_Review_Complete_comment = $request->comments;
                $changestage->status = "Phase II A QA Review";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Phase II A HOD Review Complete By    ,   Phase II A HOD Review Complete On';
                if (is_null($lastDocument->Phase_II_A_HOD_Review_Complete_by) || $lastDocument->Phase_II_A_HOD_Review_Complete_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->Phase_II_A_HOD_Review_Complete_by . ' , ' . $lastDocument->Phase_II_A_HOD_Review_Complete_on;
                }
                $history->current = $changestage->Phase_II_A_HOD_Review_Complete_by . ' , ' . $changestage->Phase_II_A_HOD_Review_Complete_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Phase II A QA Review";
                $history->change_from = $lastDocument->status;
                $history->action = 'Phase II A HOD Review Complete';
                if (is_null($lastDocument->Phase_II_A_HOD_Review_Complete_by) || $lastDocument->Phase_II_A_HOD_Review_Complete_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Phase II A HOD Review Complete';
                $history->save();
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'Phase II A HOD Review Complete', 'Phase II A QA Review');
                $changestage->update();
                toastr()->success('Phase II A QA Review');
                return back();
            }
    
            if ($changestage->stage == 18) {
                $changestage->stage = "19";
                $changestage->Phase_II_A_QA_Review_Complete_by = Auth::user()->name;
                $changestage->Phase_II_A_QA_Review_Complete_on = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_A_QA_Review_Complete_comment = $request->comments;
                $changestage->status = "P-II A QAH/CQAH Review";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Phase II A QA Review Complete By   ,    Phase II A QA Review Complete  On';
                if (is_null($lastDocument->Phase_II_A_QA_Review_Complete_by) || $lastDocument->Phase_II_A_QA_Review_Complete_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->Phase_II_A_QA_Review_Complete_by . ' , ' . $lastDocument->Phase_II_A_QA_Review_Complete_on;
                }
                $history->current = $changestage->Phase_II_A_QA_Review_Complete_by . ' , ' . $changestage->Phase_II_A_QA_Review_Complete_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "P-II A QAH/CQAH Review";
                $history->change_from = $lastDocument->status;
                $history->action = 'Phase II A QA Review Complete';
                if (is_null($lastDocument->Phase_II_A_QA_Review_Complete_by) || $lastDocument->Phase_II_A_QA_Review_Complete_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Phase II A QA Review Complete';
                $history->save();
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'Phase II A QA Review Complete', 'P-II A QAH/CQAH Review');
                $changestage->update();
                toastr()->success('P-II A QAH/CQAH Review');
                return back();
            }
            if ($changestage->stage == 19) {
                $changestage->stage = "20";
                $changestage->P_II_A_Assignable_Cause_Found_by = Auth::user()->name;
                $changestage->P_II_A_Assignable_Cause_Found_on = Carbon::now()->format('d-M-Y');
                $changestage->P_II_A_Assignable_Cause_Found_comment = $request->comments;
                $changestage->status = "Closed Done";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'P-II A Assignable Cause Found By  ,   P-II A Assignable Cause Found  On';
                if (is_null($lastDocument->P_II_A_Assignable_Cause_Found_by) || $lastDocument->P_II_A_Assignable_Cause_Found_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->P_II_A_Assignable_Cause_Found_by . ' , ' . $lastDocument->Phase_II_A_QA_Review_Complete_on;
                }
                $history->current = $changestage->P_II_A_Assignable_Cause_Found_by . ' , ' . $changestage->Phase_II_A_QA_Review_Complete_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Closed Done";
                $history->change_from = $lastDocument->status;
                $history->action = 'P-II A Assignable Cause Found';
                $history->stage='P-II A Assignable Cause Found';
                if (is_null($lastDocument->Phase_II_A_QA_Review_Complete_by) || $lastDocument->Phase_II_A_QA_Review_Complete_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'P-II A Assignable Cause Found', 'Closed Done');
                $changestage->update();
                toastr()->success('Closed Done');
                return back();
            }
    
            if ($changestage->stage == 21) {
                $changestage->stage = "22";
                $changestage->Phase_II_B_Investigation_by = Auth::user()->name;
                $changestage->Phase_II_B_Investigation_on = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_B_Investigation_comment = $request->comments;
                $changestage->status = "Phase II B HOD Primary Review ";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Phase II B Investigation By   ,    Phase II B Investigation On';
                if (is_null($lastDocument->Phase_II_B_Investigation_by) || $lastDocument->Phase_II_B_Investigation_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->Phase_II_B_Investigation_by . ' , ' . $lastDocument->Phase_II_B_Investigation_on;
                }
                $history->current = $changestage->Phase_II_B_Investigation_by . ' , ' . $changestage->Phase_II_B_Investigation_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Phase II B HOD Primary Review";
                $history->change_from = $lastDocument->status;
                $history->action = 'Phase II B Investigation';
                $history->stage='Phase II B Investigation';
                if (is_null($lastDocument->Phase_II_A_QA_Review_Complete_by) || $lastDocument->Phase_II_A_QA_Review_Complete_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
    
                $history->save();
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'Phase II B Investigation', 'Phase II B HOD Primary Review ');
                $changestage->update();
                toastr()->success('Phase II B HOD Primary Review ');
                return back();
            }
            if ($changestage->stage == 22) {
                $changestage->stage = "23";
                $changestage->Phase_II_B_HOD_Review_Complete_by = Auth::user()->name;
                $changestage->Phase_II_B_HOD_Review_Complete_on = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_B_HOD_Review_Complete_comment = $request->comments;
                $changestage->status = "Phase II B QA Review  ";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Phase II B HOD Review Complete By  ,   Phase II B HOD Review Complete On';
                if (is_null($lastDocument->Phase_II_B_HOD_Review_Complete_by) || $lastDocument->Phase_II_B_HOD_Review_Complete_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocument->Phase_II_B_HOD_Review_Complete_by . ' , ' . $lastDocument->Phase_II_B_HOD_Review_Complete_on;
                }
                $history->current = $changestage->Phase_II_B_HOD_Review_Complete_by . ' , ' . $changestage->Phase_II_B_HOD_Review_Complete_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Phase II B QA Review";
                $history->change_from = $lastDocument->status;
                $history->action = 'Phase II B HOD Review Complete';
                $history->stage='Phase II B HOD Review Complete';
                if (is_null($lastDocument->Phase_II_B_HOD_Review_Complete_by) || $lastDocument->Phase_II_B_HOD_Review_Complete_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
    
                $history->save();
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'Phase II B HOD Review Complete ', 'Phase II B QA Review  ');
                $changestage->update();
                toastr()->success('Phase II B QA Review  ');
                return back();
            }
            if ($changestage->stage == 23) {
                $changestage->stage = "24";
                $changestage->Phase_II_B_QA_ReviewComplete_by = Auth::user()->name;
                $changestage->Phase_II_B_QA_ReviewComplete_on = Carbon::now()->format('d-M-Y');
                $changestage->Phase_II_B_QA_ReviewComplete_comment = $request->comments;
                $changestage->status = "P-II B QAH/CQAH Review";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocument->Phase_II_B_QA_ReviewComplete_by;
                $history->current = $changestage->Phase_II_B_QA_ReviewComplete_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "P-II B QAH/CQAH Review";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'Phase II B QA Review Complete';
                $history->stage='Phase II B QA Review Complete';
                $history->save();
                // $this->saveAuditTrail($id, $lastDocument, $changestage, 'Phase II B QA Review Complete', 'P-II B QAH/CQAH Review');
                $changestage->update();
                toastr()->success('P-II B QAH/CQAH Review');
                return back();
            }
            if ($changestage->stage == 24) {
                $changestage->stage = "25";
                $changestage->P_II_B_Assignable_Cause_Found_by = Auth::user()->name;
                $changestage->P_II_B_Assignable_Cause_Found_on = Carbon::now()->format('d-M-Y');
                $changestage->P_II_B_Assignable_Cause_Found_comment = $request->comments;
                $changestage->status = "Closed - Done";
                $history = new OotAuditTrial();
                $history->ootcs_id = $id;
                $history->activity_type = 'P-II B Assignable Cause Found By ,   P-II B Assignable Cause Found On';
                $history->previous = $lastDocument->P_II_B_Assignable_Cause_Found_by;
                $history->current = $changestage->P_II_B_Assignable_Cause_Found_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Closed - Done";
                $history->change_from = $lastDocument->status;
                $history->action_name = 'P-II B Assignable Cause Found';
                $history->action = 'P-II B Assignable Cause Found';
                $history->stage='P-II B Assignable Cause Found';
                $history->save();
                $changestage->update();
                toastr()->success('Closed - Done');
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
                $data->new_stage_reject_HOD_by = Auth::user()->name;
                $data->new_stage_reject_HOD_on  = Carbon::now()->format('d-M-Y');
                $data->new_stage_reject_HOD_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
    
            if ($data->stage == 4) {
                $data->stage = "2";
                $data->status = "HOD Primary Review";
                $data->new_stage_reject_HOD_by = Auth::user()->name;
                $data->new_stage_reject_HOD_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_reject_HOD_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 5) {
                $data->stage = "4";
                $data->status = "CQA/QA Head Primary Review";
                $data->new_stage_reject_CQA_by = Auth::user()->name;
                $data->new_stage_reject__CQA_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_reject_CQA_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 7) {
                $data->stage = "5";
                $data->status = "Under Phase-IA Investigation";
                $data->new_stage_reject_UnderPhaseIA_by = Auth::user()->name;
                $data->new_stage_reject_UnderPhaseIA_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_reject_UnderPhaseIA_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 8) {
                $data->stage = "7";
                $data->status = "Phase IA HOD Primary Review";
                $data->new_stage_reject_Phase_IA_HOD_Primary_Review_by = Auth::user()->name;
                $data->new_stage_reject_Phase_IA_HOD_Primary_Review_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_reject_Phase_IA_HOD_Primary_Review_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 9) {
                $data->stage = "8";
                $data->status = "Phase IA QA Review ";
                // $data->more_infor_nine_reject_by = Auth::user()->name;
                // $data->more_infor_nine_reject_on = Carbon::now()->format('d-M-Y');
                // $data->more_infor_nine_reject_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 10) {
                $data->stage = "8";
                $data->status = "Under Stage II B Investigation";
                $data->new_stage_rejectUnder_Stage_II_B_Investigation_by = Auth::user()->name;
                $data->new_stage_rejectUnder_Stage_II_B_Investigation_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_rejectUnder_Stage_II_B_Investigation_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 11) {
                $data->stage = "9";
                $data->status = "P-IA CQAH/QAH Review";
                $data->new_stage_rejectP_IA_CQAH_QAH_Reviewation_by = Auth::user()->name;
                $data->new_stage_rejectP_IA_CQAH_QAH_Reviewation_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_rejectP_IA_CQAH_QAH_Review_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 12) {
                $data->stage = "11";
                $data->status = "Under Phase-IB Investigation";
                $data->new_stage_rejectUnder_Phase_IB_Investigation_by = Auth::user()->name;
                $data->new_stage_rejectUnder_Phase_IB_Investigation_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_rejectUnder_Phase_IB_Investigation_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 13) {
                $data->stage = "12";
                $data->status = "Phase IB HOD Primary Review";
                $data->new_stage_rejectPhase_IB_HOD_Primary_Review_by = Auth::user()->name;
                $data->new_stage_rejectPhase_IB_HOD_Primary_Review_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_rejectPhase_IB_HOD_Primary_Reviewcomment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 14) {
                $data->stage = "13";
                $data->status = "Phase IB QA Review";
                // $data->fourteen_stage_return_by = Auth::user()->name;
                // $data->fourteen_stage_return_on = Carbon::now()->format('d-M-Y');
                // $data->fourteen_stage_return_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 15) {
                $data->stage = "13";
                $data->status = "Phase IB QA Review";
                $data->new_stage_rejectPhase_IB_QA_Review_by = Auth::user()->name;
                $data->new_stage_rejectPhase_IB_QA_Review_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_rejectPhase_IB_QA_Review_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 16) {
                $data->stage = "14";
                $data->status = "P-IA CQAH/QAH Review";
                $data->new_stage_rejectP_IA_CQAH_QAH_Reviewation_by = Auth::user()->name;
                $data->new_stage_rejectP_IA_CQAH_QAH_Reviewation_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_rejectP_IA_CQAH_QAH_Review_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 17) {
                $data->stage = "16";
                $data->status = "Under Phase-II A Investigation";
                $data->new_stage_rejectUnder_Phase_II_A_Investigation_by = Auth::user()->name;
                $data->new_stage_rejectUnder_Phase_II_A_Investigation_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_rejectUnder_Phase_II_A_Investigation_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 18) {
                $data->stage = "17";
                $data->status = "Phase II A HOD Primary Review";
                $data->new_stage_rejectUnder_Phase_II_A_HOD17Investigation_by = Auth::user()->name;
                $data->new_stage_rejectUnder_Phase_II_A_HOD17Investigation_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_rejectUnder_Phase_II_A_HOD17Investigation_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
    
            if ($data->stage == 19) {
                $data->stage = "18";
                $data->status = "Phase IA QA Review";
                $data->new_stage_rejectUnder_Phase_IA_HOD18Investigation_by = Auth::user()->name;
                $data->new_stage_rejectUnder_Phase_IA_HOD18Investigation_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_rejectUnder_Phase_IA_HOD18Investigation_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 21) {
                $data->stage = "19";
                $data->status = "P-II A QAH/CQAH Review";
                $data->new_stage_reject_P_II_A_QAH_CQAH_Review_by = Auth::user()->name;
                $data->new_stage_reject_P_II_A_QAH_CQAH_Review_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_reject_P_II_A_QAH_CQAH_Review_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
    
            if ($data->stage == 22) {
                $data->stage = "21";
                $data->status = "Under Phase-II B Investigation";
                $data->new_stage_rejectUnder_Phase_II_B_Investigation_by = Auth::user()->name;
                $data->new_stage_rejectUnder_Phase_II_B_Investigation_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_rejectUnder_Phase_II_B_Investigation_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
    
            if ($data->stage == 23) {
                $data->stage = "22";
                $data->status = "Phase II B HOD Primary Review";
                $data->new_stage_rejectUnder_Phase_II_B_HOD_Primary_Review_by = Auth::user()->name;
                $data->new_stage_rejectUnder_Phase_II_B_HOD_Primary_Review_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_rejectUnder_Phase_II_B_HOD_Primary_Review_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($data->stage == 24) {
                $data->stage = "23";
                $data->status = "Phase II B QA Review ";
                $data->new_stage_reject_by = Auth::user()->name;
                $data->new_stage_reject_on = Carbon::now()->format('d-M-Y');
                $data->new_stage_reject_comment = $request->comment;
                $data->update();
                toastr()->success('Document Sent');
                return back();
            }

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
    public function RejectStateChangeNew(Request $request, $id)
{
    if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
        $data = Ootc::find($id);
        $lastDocument = Ootc::find($id);

        if ($data->stage == 24) {
            $data->stage = "4";
            $data->status = "Phase II B QA  Review ";
            $data->new_stage_reject_by = Auth::user()->name;
            $data->new_stage_reject_on = Carbon::now()->format('d-M-Y');
            $data->new_stage_reject_comment = $request->comment;
            $history = new OotAuditTrial();
            $history->ootcs_id = $id;
            $history->activity_type = 'P-II A Assignable Cause Not Found By  ,   P-II A Assignable Cause Not Found On';
            if (is_null($lastDocument->new_stage_reject_by) || $lastDocument->new_stage_reject_by === '') {
                $history->previous = "Null";
            } else {
                $history->previous = $lastDocument->new_stage_reject_by . ' , ' . $lastDocument->new_stage_reject_on;
            }
            $history->current = $data->new_stage_reject_by . ' , ' . $data->new_stage_reject_on;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Under Phase-II B Investigation";
            $history->change_from = $lastDocument->status;
            $history->action = 'P-II A Assignable Cause Not Found';
            $history->stage='P-II A Assignable Cause Not Found';
            if (is_null($lastDocument->new_stage_reject_by) || $lastDocument->new_stage_reject_by === '') {
                $history->action_name = 'New';
            } else {
                $history->action_name = 'Update';
            }
            $history->save();
            $data->update();
            toastr()->success('Document Sent');
            return back();
        }

    }

}

public function stageChange(Request $request, $id){

    if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
        $changestage = Ootc::find($id);
        $lastDocument = Ootc::find($id);
            
        
        if ($changestage->stage == 1) {
            $changestage->stage = "3";
            // $changestage->Request_For_Cancellation_By = Auth::user()->name;
            // $changestage->Request_For_Cancellation_On = Carbon::now()->format('d-M-Y');
            // $changestage->Request_For_Cancellation_Comment = $request->comment;
            $changestage->status = "QA Head Approval";
            $history = new OotAuditTrial();
            $history->ootcs_id = $id;
            $history->activity_type = 'Request For Cancellation By  ,   Request For Cancellation On';
            if (is_null($lastDocument->Request_For_Cancellation_By) || $lastDocument->Request_For_Cancellation_By === '') {
                $history->previous = "Null";
            } else {
                $history->previous = $lastDocument->Request_For_Cancellation_By . ' , ' . $lastDocument->Request_For_Cancellation_On;
            }
            
            $history->current = $changestage->Request_For_Cancellation_By . ' , ' . $changestage->Request_For_Cancellation_On;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Under Phase-IB Investigation";
            $history->change_from = $lastDocument->status;
            // $history->action_name = 'Assignable Cause Not Found';
            $history->action = 'Assignable Cause Not Found';
            $history->stage='Assignable Cause Not Found';
            if (is_null($lastDocument->correction_r_completed_by) || $lastDocument->correction_r_completed_by === '') {
                $history->action_name = 'New';
            } else {
                $history->action_name = 'Update';
            }

            $history->save();
            $changestage->update();
            toastr()->success('Under Phase-IB Investigation');
            return back();
        }
        if ($changestage->stage == 2) {
            $changestage->stage = "4";
            $changestage->pls_submited_by = Auth::user()->name;
            $changestage->pls_submited_on = Carbon::now()->format('d-M-Y');
            $changestage->pls_comments = $request->a_l_comments;
            $changestage->status = "CQA/QA Head Primary Review";
            $history = new OotAuditTrial();
            $history->ootcs_id = $id;
            $history->activity_type = 'HOD Primary Review Complete By     ,     HOD Primary Review Complete On';
            if (is_null($lastDocument->pls_submited_by) || $lastDocument->pls_submited_by === '') {
                $history->previous = "Null";
            } else {
                $history->previous = $lastDocument->pls_submited_by . ' , ' . $lastDocument->pls_submited_on;
            }
            $history->current = $changestage->pls_submited_by . ' , ' . $changestage->pls_submited_on;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "CQA/QA Head Primary Review";
            $history->change_from = $lastDocument->status;
            $history->action = 'HOD Primary Review Complete';
            if (is_null($lastDocument->pls_submited_by) || $lastDocument->pls_submited_by === '') {
                $history->action_name = 'New';
            } else {
                $history->action_name = 'Update';
            }
            $history->stage='HOD Primary Review Complete';
            $history->save();

            
            $changestage->update();
            toastr()->success('CQA/QA Head Primary Review');
            return back();
        }
        
        

                        if ($changestage->stage == 9) {
                            $changestage->stage = "11";
                            $changestage->correction_r_completed_by = Auth::user()->name;
                            $changestage->correction_r_completed_on = Carbon::now()->format('d-M-Y');
                            $changestage->correction_r_ncompleted_comment = $request->a_l_comments;
                            $changestage->status = "Under Phase-IB Investigation";
                            $history = new OotAuditTrial();
                            $history->ootcs_id = $id;
                            $history->activity_type = 'Assignable Cause Not Found Complete By  ,   Assignable Cause Not Found Complete On';
                            if (is_null($lastDocument->correction_r_completed_by) || $lastDocument->correction_r_completed_by === '') {
                                $history->previous = "Null";
                            } else {
                                $history->previous = $lastDocument->correction_r_completed_by . ' , ' . $lastDocument->correction_r_completed_on;
                            }
                            
                            $history->current = $changestage->correction_r_completed_by . ' , ' . $changestage->correction_r_completed_on;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->change_to = "Under Phase-IB Investigation";
                            $history->change_from = $lastDocument->status;
                            // $history->action_name = 'Assignable Cause Not Found';
                            $history->action = 'Assignable Cause Not Found';
                            $history->stage='Assignable Cause Not Found';
                            if (is_null($lastDocument->correction_r_completed_by) || $lastDocument->correction_r_completed_by === '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                
                            $history->save();
                            $changestage->update();
                            toastr()->success('Under Phase-IB Investigation');
                            return back();
                        }
                
                        if ($changestage->stage == 14) {
                            $changestage->stage = "16";
                            $changestage->Under_Phase_II_A_Investigation_by = Auth::user()->name;
                            $changestage->Under_Phase_II_A_Investigation_on = Carbon::now()->format('d-M-Y');
                            $changestage->Under_Phase_II_A_Investigation_comment = $request->a_l_comments;
                            $changestage->status = "Under Phase-II A Investigation";
                            $history = new OotAuditTrial();
                            $history->ootcs_id = $id;
                            $history->activity_type = 'P-IB Assignable Cause Found By   ,   P-IB Assignable Cause Found On';
                            if (is_null($lastDocument->Under_Phase_II_A_Investigation_by) || $lastDocument->Under_Phase_II_A_Investigation_by === '') {
                                $history->previous = "Null";
                            } else {
                                $history->previous = $lastDocument->Under_Phase_II_A_Investigation_by . ' , ' . $lastDocument->Under_Phase_II_A_Investigation_on;
                            }
                            // $history->previous = $lastDocument->Under_Phase_II_A_Investigation_by;
                            $history->current = $changestage->Under_Phase_II_A_Investigation_by . ' , ' . $changestage->Under_Phase_II_A_Investigation_on;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->change_to = "Under Phase-II A Investigation";
                            $history->change_from = $lastDocument->status;
                            $history->action = 'P-IB Assignable Cause Found';
                            if (is_null($lastDocument->Under_Phase_II_A_Investigation_by) || $lastDocument->Under_Phase_II_A_Investigation_by === '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                            $history->stage='P-IB Assignable Cause Found';
                            $history->save();
                            
                            // $this->saveAuditTrail($id, $lastDocument, $changestage, 'P-IB Assignable Cause Found', 'Under Phase-II A Investigation');
                            $changestage->update();
                            toastr()->success('Under Phase-II A Investigation');
                            return back();
                        }
                
                        if ($changestage->stage == 19) {
                            $changestage->stage = "21";
                            $changestage->P_II_A_Assignable_Cause_Not_Found_by = Auth::user()->name;
                            $changestage->P_II_A_Assignable_Cause_Not_Found_on = Carbon::now()->format('d-M-Y');
                            $changestage->P_II_A_Assignable_Cause_Not_Found_comment = $request->a_l_comments;
                            $changestage->status = "Under Phase-II B Investigation ";
                            $history = new OotAuditTrial();
                            $history->ootcs_id = $id;
                            $history->activity_type = 'P-II A Assignable Cause Found By  ,   P-II A Assignable Cause Found On';
                            if (is_null($lastDocument->P_II_A_Assignable_Cause_Not_Found_by) || $lastDocument->P_II_A_Assignable_Cause_Not_Found_by === '') {
                                $history->previous = "Null";
                            } else {
                                $history->previous = $lastDocument->P_II_A_Assignable_Cause_Not_Found_by . ' , ' . $lastDocument->P_II_A_Assignable_Cause_Not_Found_on;
                            }
                            $history->current = $changestage->P_II_A_Assignable_Cause_Not_Found_by . ' , ' . $changestage->P_II_A_Assignable_Cause_Not_Found_on;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->change_to = "Under Phase-II B Investigation";
                            $history->change_from = $lastDocument->status;
                            $history->action = 'P-II A Assignable Cause Found';
                            $history->stage='P-II A Assignable Cause Found';
                            if (is_null($lastDocument->P_II_A_Assignable_Cause_Not_Found_by) || $lastDocument->P_II_A_Assignable_Cause_Not_Found_by === '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                            $history->save();
                            // $this->saveAuditTrail($id, $lastDocument, $changestage, 'P-II A Assignable Cause Found', 'Under Phase-II B Investigation ');
                            $changestage->update();
                            toastr()->success('Under Phase-II B Investigation ');
                            return back();
                        }
                    }
                        
        
            toastr()->success('Document Sent');
            return back();
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
                // dd($history->user_role);
                $history->origin_state =  $data->status;
                $history->stage = 'Cancelled';
                $history->save();
        $data->update();
        // $history = new OotAuditTrial();
        // $history->activity_type = "OOT";
        // $history->ootcs_id = $id;
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->stage = $data->stage;
        // $history->status = $data->status;
        // $history->save();

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
public function OOTChildRoot(Request $request ,$id)
{
    $cc = Ootc::find($id);
           $cft = [];
           $parent_id = $id;
           $parent_type = "OOT";
           $old_record = Capa::select('id', 'division_id', 'record')->get();
           $record_number = ((RecordNumber::first()->value('counter')) + 1);
           $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
           $record = ((RecordNumber::first()->value('counter')) + 1);
           $record = str_pad($record, 4, '0', STR_PAD_LEFT);
           $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
           $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
           $currentDate = Carbon::now();
           $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
           $parent_initiator_id = $id;


           $formattedDate = $currentDate->addDays(30);
           $due_date = $formattedDate->format('d-M-Y');
           $oocOpen = OpenStage::find(1);
           if (!empty($oocOpen->cft)) $cft = explode(',', $oocOpen->cft);


           if ($request->revision == "capa-child") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            // $record = $record_number;
            $old_records = $old_record;
            return view('frontend.forms.capa', compact('record_number', 'due_date', 'parent_id', 'parent_type', 'old_records', 'cft'));
            }

           if ($request->revision == "Action-Item") {
               $cc->originator = User::where('id', $cc->initiator_id)->value('name');
               return view('frontend.forms.action-item', compact('record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id','record'));
           }
           if ($request->revision == "Root-Cause-Analysis") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.forms.root-cause-analysis', compact('record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));
           
        }
        if ($request->revision == "Resampling") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.resampling.resapling_create', compact('record', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));
       }

       if ($request->revision == "Extension") {
        $cc->originator = User::where('id', $cc->initiator_id)->value('name');
        return view('frontend.extension.extension_new', compact('record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));

    }

    }


    public function OOTChildExtensionOOT(Request $request ,$id)
    {
        $cc = Ootc::find($id);
               $cft = [];
               $parent_id = $id;
               $parent_type = "OOT";
               $currentDate = Carbon::now();
               $formattedDate = $currentDate->addDays(30);
               $due_date= $formattedDate->format('d-M-Y');
               $old_record = Capa::select('id', 'division_id', 'record')->get();
               $record_number = ((RecordNumber::first()->value('counter')) + 1);
               $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
               $record = ((RecordNumber::first()->value('counter')) + 1);
               $record = str_pad($record, 4, '0', STR_PAD_LEFT);
               $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
               $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
               $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
               $parent_initiator_id = $id;


               $formattedDate = $currentDate->addDays(30);
               $due_date = $formattedDate->format('d-M-Y');
               $oocOpen = OpenStage::find(1);
               if (!empty($oocOpen->cft)) $cft = explode(',', $oocOpen->cft);

                if ($request->revision == "Extension") {
                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                return view('frontend.extension.extension_new', compact('record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));
    
            }
    }

public function oo_t_capa_child(Request $request ,$id)
    {
        $cc = Ootc::find($id);
               $cft = [];
               $parent_id = $id;
               $parent_type = "OOT";
               $currentDate = Carbon::now();
               $formattedDate = $currentDate->addDays(30);
               $due_date= $formattedDate->format('d-M-Y');
               $old_record = Capa::select('id', 'division_id', 'record')->get();
               $record_number = ((RecordNumber::first()->value('counter')) + 1);
               $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
               $record = ((RecordNumber::first()->value('counter')) + 1);
               $record = str_pad($record, 4, '0', STR_PAD_LEFT);
               $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
               $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
               $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
               $parent_initiator_id = $id;


               $formattedDate = $currentDate->addDays(30);
               $due_date = $formattedDate->format('d-M-Y');
               $oocOpen = OpenStage::find(1);
               if (!empty($oocOpen->cft)) $cft = explode(',', $oocOpen->cft);


               if ($request->revision == "Action-child") {
                    $parent_due_date = "";
                    $parent_id = $id;
                    $parent_name = $request->parent_name;
                    if ($request->due_date) {
                   $parent_due_date = $request->due_date;
                                             }


                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                return view('frontend.forms.action-item', compact('record','record_number' ,'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));

            }

               if ($request->revision == "risk-Item") {
                   $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                   return view('frontend.forms.risk-management', compact('record_number', 'due_date', 'parent_id','old_record', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));

               }

               if ($request->revision == "Extension") {
                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                return view('frontend.extension.extension_new', compact('record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));
    
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
