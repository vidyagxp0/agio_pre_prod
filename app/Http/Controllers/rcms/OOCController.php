<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\OOC_Grid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use App\Models\User;
use Helpers;
use App\Models\AuditReviewersDetails;
use App\Models\OutOfCalibration;
use App\Models\OOCAuditTrail;
use App\Models\RoleGroup;
use App\Models\RecordNumber;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Capa;
use App\Models\OpenStage;
use App\Models\extension_new;
use App\Models\ActionItem;
use App\Models\RootCauseAnalysis;



class OOCController extends Controller
{
    public function index()
    {
        $record_number = RecordNumber::first();
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        return view('frontend.OOC.out_of_calibration',compact('due_date', 'record_number'));
    }


    public function create(request $request)
    {
        if (!$request->description_ooc) {
            toastr()->info("Short Description is required");
            return redirect()->back();
        }
        $data = new OutOfCalibration();
        $data->form_type = 'Out Of Calibration';
        $data->record = ((RecordNumber::first()->value('counter')) + 1);
        $data->initiator_id = Auth::user()->id;
        $data->division_id = $request->division_id;
        $data->description_ooc = $request->description_ooc;
        $data->assign_to = $request->assign_to;
        $data->due_date = $request->due_date;
        $data->record_number = $request->record_number;
        $data->division_code = $request->division_code;
        $data->initiated_through_capas_ooc_IB = $request->initiated_through_capas_ooc_IB;
        $data->initiated_through_capa_prevent_ooc_IB = $request->initiated_through_capa_prevent_ooc_IB;
        $data->initiated_through_capa_corrective_ooc_IB = $request->initiated_through_capa_corrective_ooc_IB;


        // dd($data->record_number);
        $data->Initiator_Group= $request->Initiator_Group;
        $data->intiation_date = $request->intiation_date;
        $data->initiator_group_code= $request->initiator_group_code;
        $data->initiated_through = $request->initiated_through;
        $data->initiated_if_other= $request->initiated_if_other;
        $data->is_repeat_ooc= $request->is_repeat_ooc;
        $data->Repeat_Nature= $request->Repeat_Nature;
      
        $data->details_of_ooc= $request->details_of_ooc;
      
        $data->ooc_due_date= $request->ooc_due_date;
        $data->Delay_Justification_for_Reporting= $request->Delay_Justification_for_Reporting;
        $data->HOD_Remarks = $request->HOD_Remarks;
        $data->Immediate_Action_ooc = $request->Immediate_Action_ooc;
        $data->Preliminary_Investigation_ooc = $request->Preliminary_Investigation_ooc;
        $data->qa_comments_ooc = $request->qa_comments_ooc;
        $data->last_calibration_date = $request->last_calibration_date;
        $data->phase_ib_investigation_summary = $request->phase_ib_investigation_summary;
        $data->phase_ia_investigation_summary = $request->phase_ia_investigation_summary;
        $data->assignable_cause_identified = $request->assignable_cause_identified;


        // dd($data->last_calibration_date);

        $data->Summary_closure = $request->Summary_closure;
        $data->qa_comments_description_ooc = $request->qa_comments_description_ooc;

        $data->is_repeat_assingable_ooc = $request->is_repeat_assingable_ooc;

        $data->protocol_based_study_hypthesis_study_ooc = $request->protocol_based_study_hypthesis_study_ooc;
        $data->justification_for_protocol_study_hypothesis_study_ooc = $request->justification_for_protocol_study_hypothesis_study_ooc;
        $data->plan_of_protocol_study_hypothesis_study = $request->plan_of_protocol_study_hypothesis_study;
        $data->conclusion_of_protocol_based_study_hypothesis_study_ooc = $request->conclusion_of_protocol_based_study_hypothesis_study_ooc;
        $data->analysis_remarks_stage_ooc = $request->analysis_remarks_stage_ooc;
        $data->calibration_results_stage_ooc = $request->calibration_results_stage_ooc;
        $data->is_repeat_result_naturey_ooc = $request->is_repeat_result_naturey_ooc;
        $data->review_of_calibration_results_of_analyst_ooc = $request->review_of_calibration_results_of_analyst_ooc;
        $data->results_criteria_stage_ooc = $request->results_criteria_stage_ooc;
        // $data->is_repeat_stae_ooc = $request->is_repeat_stae_ooc;
        $data->is_repeat_stae_ooc = $request->is_repeat_stae_ooc;

        // dd($data->is_repeat_stae_ooc);
        $data->qa_comments_stage_ooc = $request->qa_comments_stage_ooc;
        $data->additional_remarks_stage_ooc = $request->additional_remarks_stage_ooc;
        $data->is_repeat_stageii_ooc = $request->is_repeat_stageii_ooc;
        $data->is_repeat_stage_instrument_ooc = $request->is_repeat_stage_instrument_ooc;
        $data->details_of_instrument_out_of_order = $request->details_of_instrument_out_of_order;

        $data->is_repeat_proposed_stage_ooc = $request->is_repeat_proposed_stage_ooc;
        $data->ooc_logged_by = $request->ooc_logged_by;
        $data->qa_assign_person = $request->qa_assign_person;
        // dd($data->qa_assign_person);
        $data->is_repeat_compiled_stageii_ooc = $request->is_repeat_compiled_stageii_ooc;
        $data->compiled_by = $request->compiled_by;
        $data->initiated_throug_stageii_ooc = $request->initiated_throug_stageii_ooc;
        $data->initiated_through_stageii_ooc = $request->initiated_through_stageii_ooc;
        $data->justification_for_recalibration = $request->justification_for_recalibration;

        $data->is_repeat_reanalysis_stageii_ooc = $request->is_repeat_reanalysis_stageii_ooc;
        $data->initiated_through_stageii_cause_failure_ooc = $request->initiated_through_stageii_cause_failure_ooc;
        $data->is_repeat_capas_ooc = $request->is_repeat_capas_ooc;
        $data->initiated_through_capas_ooc = $request->initiated_through_capas_ooc;
        $data->rootcausenewfield = $request->rootcausenewfield;

        // dd($data->rootcausenewfield);

        $data->initiated_through_capa_prevent_ooc = $request->initiated_through_capa_prevent_ooc;
        $data->hodremarksnewfield = $request->hodremarksnewfield;
        $data->qaremarksnewfield = $request->qaremarksnewfield;
        $data->initiated_through_capa_corrective_ooc = $request->initiated_through_capa_corrective_ooc;
        $data->initiated_through_capa_ooc = $request->initiated_through_capa_ooc;
        $data->short_description_closure_ooc = $request->short_description_closure_ooc;
        $data->document_code_closure_ooc = $request->document_code_closure_ooc;
        $data->remarks_closure_ooc = $request->remarks_closure_ooc;
        $data->initiated_through_closure_ooc = $request->initiated_through_closure_ooc;
        $data->initiated_through_hodreview_ooc = $request->initiated_through_hodreview_ooc;
        $data->initiated_through_rootcause_ooc = $request->initiated_through_rootcause_ooc;
        $data->initiated_through_impact_closure_ooc = $request->initiated_through_impact_closure_ooc;
        $data->status = 'Opened';
        $data->stage = 1;


        $data->qaheadremarks = $request->qaheadremarks;
        $data->phase_IA_HODREMARKS = $request->phase_IA_HODREMARKS;
        $data->qaHremarksnewfield = $request->qaHremarksnewfield;
        $data->phase_IB_HODREMARKS = $request->phase_IB_HODREMARKS;
        $data->phase_IB_qareviewREMARKS = $request->phase_IB_qareviewREMARKS;
        $data->qPIBaHremarksnewfield = $request->qPIBaHremarksnewfield;

        // Handling attachments
        if (!empty($request->initial_attachment_qahead_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_qahead_ooc')) {
                foreach ($request->file('initial_attachment_qahead_ooc') as $file) {
                    $name = $request->name . '_initial_attachment_qahead_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_qahead_ooc = json_encode($files);
        }

        if (!empty($request->attachments_hodIAHODPRIMARYREVIEW_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_hodIAHODPRIMARYREVIEW_ooc')) {
                foreach ($request->file('attachments_hodIAHODPRIMARYREVIEW_ooc') as $file) {
                    $name = $request->name . 'PhaseIA_HOD_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->attachments_hodIAHODPRIMARYREVIEW_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_qah_post_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_qah_post_ooc')) {
                foreach ($request->file('initial_attachment_qah_post_ooc') as $file) {
                    $name = $request->name . 'P_IA_QAH_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_qah_post_ooc = json_encode($files);
        }

        if (!empty($request->attachments_hodIBBBHODPRIMARYREVIEW_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_hodIBBBHODPRIMARYREVIEW_ooc')) {
                foreach ($request->file('attachments_hodIBBBHODPRIMARYREVIEW_ooc') as $file) {
                    $name = $request->name . 'Phase_IB_HOD_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->attachments_hodIBBBHODPRIMARYREVIEW_ooc = json_encode($files);
        }

        if (!empty($request->attachments_QAIBBBREVIEW_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_QAIBBBREVIEW_ooc')) {
                foreach ($request->file('attachments_QAIBBBREVIEW_ooc') as $file) {
                    $name = $request->name . 'Phase_IB_QA_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->attachments_QAIBBBREVIEW_ooc = json_encode($files);
        }

        if (!empty($request->Pib_attachements)) {
            $files = [];
            if ($request->hasfile('Pib_attachements')) {
                foreach ($request->file('Pib_attachements') as $file) {
                    $name = $request->name . 'P_IB_QAH_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->Pib_attachements = json_encode($files);
        }



        if (!empty($request->initial_attachment_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_ooc')) {
                foreach ($request->file('initial_attachment_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_ooc = json_encode($files);
        }
        if (!empty($request->initial_attachment_stageii_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_stageii_ooc')) {
                foreach ($request->file('initial_attachment_stageii_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_stageii_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_stageii_ooc = json_encode($files);
        }
        if (!empty($request->attachments_hod_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_hod_ooc')) {
                foreach ($request->file('attachments_hod_ooc') as $file) {
                    $name = $request->name . 'attachments_hod_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->attachments_hod_ooc = json_encode($files);
        }

        if (!empty($request->attachments_stage_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_stage_ooc')) {
                foreach ($request->file('attachments_stage_ooc') as $file) {
                    $name = $request->name . 'Phase_IA_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->attachments_stage_ooc = json_encode($files);
        }

        if (!empty($request->attachments_hypothesis_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_hypothesis_ooc')) {
                foreach ($request->file('attachments_hypothesis_ooc') as $file) {
                    $name = $request->name . 'Hypothesis_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->attachments_hypothesis_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_hodreview_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_hodreview_ooc')) {
                foreach ($request->file('initial_attachment_hodreview_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_hodreview_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_hodreview_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_closure_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_closure_ooc')) {
                foreach ($request->file('initial_attachment_closure_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_closure_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_closure_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_capa_post_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_capa_post_ooc')) {
                foreach ($request->file('initial_attachment_capa_post_ooc') as $file) {
                    $name = $request->name . 'Phase_IA_QA_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_capa_post_ooc = json_encode($files);
        }


        if (!empty($request->initial_attachment_reanalysisi_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_reanalysisi_ooc')) {
                foreach ($request->file('initial_attachment_reanalysisi_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_reanalysisi_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_reanalysisi_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_capa_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_capa_ooc')) {
                foreach ($request->file('initial_attachment_capa_ooc') as $file) {
                    $name = $request->name . 'QA_Head_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_capa_ooc = json_encode($files);
        }


        $data->save();
        // dd($data);



        // ====================counter===================//
        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();

        //===================counter=======================//

        //=========================================================Audit Trail Create ===========================================================================================//


        if(!empty($data->record)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Record Number';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName(session()->get('division')) . "/OOC/" . Helpers::year($data->created_at) . "/" . str_pad($data->record, 4, '0', STR_PAD_LEFT);
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

        if(!empty($data->division_code)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Site/Location Code';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName(session()->get('division'));
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

        if(!empty($data->Initiator)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = Auth::user()->name;
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

        if(!empty($data->intiation_date)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($data->intiation_date);
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

        if(!empty($data->due_date)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($data->due_date);
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

        $department = [
            'CQA' => 'Corporate Quality Assurance',
            'QA' => 'Quality Assurance',
            'QC' => 'Quality Control',
            'QM' => 'Quality Control (Microbiology department)',
            'PG' => 'Production General',
            'PL' => 'Production Liquid Orals',
            'PT' => 'Production Tablet and Powder',
            'PE' => 'Production External (Ointment, Gels, Creams and Liquid)',
            'PC' => 'Production Capsules',
            'PI' => 'Production Injectable',
            'EN' => 'Engineering',
            'HR' => 'Human Resource',
            'ST' => 'Store',
            'IT' => 'Electronic ooc Processing',
            'FD' => 'Formulation Development',
            'AL' => 'Analytical research and Development Laboratory',
            'PD' => 'Packaging Development',
            'PU' => 'Purchase Department',
            'DC' => 'Document Cell',
            'RA' => 'Regulatory Affairs',
            'PV' => 'Pharmacovigilance',
        ];

        $currentInitiatorGroupFullForm = isset($department[$data->Initiator_Group]) ? $department[$data->Initiator_Group] : $data->Initiator_Group;

        if(!empty($data->Initiator_Group)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Initiator Department';
            $history->previous = "Null";
            $history->current = $currentInitiatorGroupFullForm;
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

        if(!empty($data->initiator_group_code)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Initiator Department Code';
            $history->previous = "Null";
            $history->current = $data->initiator_group_code;
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


        if(!empty($data->last_calibration_date)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Last Calibration Date';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($data->last_calibration_date);
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

         if(!empty($data->description_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Short Description ';
            $history->previous = "Null";
            $history->current = $data->description_ooc;
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

        if(!empty($data->initiated_through)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
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


        if(!empty($data->initiated_if_other)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'If Other';
            $history->previous = "Null";
            $history->current = $data->initiated_if_other;
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

        if(!empty($data->is_repeat_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Is Repeat';
            $history->previous = "Null";
            $history->current = $data->is_repeat_ooc;
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

        if(!empty($data->Repeat_Nature)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = "Null";
            $history->current = $data->Repeat_Nature;
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



        if(!empty($data->details_of_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Details of OOC';
            $history->previous = "Null";
            $history->current = $data->details_of_ooc;
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

        if(!empty($data->initial_attachment_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Initial Attachment';
            $history->previous = "Null";
            $history->current = str_replace(',', ', ', $data->initial_attachment_ooc);
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

         if(!empty($data->assign_to)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'HOD Person';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($data->assign_to);
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

         if(!empty($data->qa_assign_person)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'QA Person';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($data->qa_assign_person);
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

        if(!empty($data->ooc_logged_by)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'OOC Logged by';
            $history->previous = "Null";
            $history->current = $data->ooc_logged_by;
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

        if(!empty($data->ooc_due_date)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'OOC Logged On';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($data->ooc_due_date);
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

         if(!empty($data->Delay_Justification_for_Reporting)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Delay Justification for Reporting';
            $history->previous = "Null";
            $history->current = $data->Delay_Justification_for_Reporting;
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

        // Immediate Action
        if(!empty($data->Immediate_Action_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Immediate Action';
            $history->previous = "Null";
            $history->current = $data->Immediate_Action_ooc;
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

                // HOD Remarks
        if(!empty($data->HOD_Remarks)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'HOD Primary Review Remarks';
            $history->previous = "Null";
            $history->current = $data->HOD_Remarks;
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


        // HOD Attachment
        if(!empty($data->attachments_hod_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'HOD Primary Review Attachments';
            $history->previous = "Null";
            // $history->current = json_encode($data->attachments_hod_ooc);
            $history->current = str_replace(',', ', ', $data->attachments_hod_ooc);
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if(!empty($data->qaheadremarks)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'QA Head Primary Review Remarks';
            $history->previous = "Null";
            $history->current = $data->qaheadremarks;
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

        if (!empty($data->initial_attachment_capa_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'QA Head Primary Review Attachment';
            $history->previous = "Null";
            // $history->current = $data->initial_attachment_capa_ooc;
            $history->current = str_replace(',', ', ', $data->initial_attachment_capa_ooc);
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->analysis_remarks_stage_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Analyst Interview';
            $history->previous = "Null";
            $history->current = $data->analysis_remarks_stage_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->qa_comments_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Evaluation Remarks';
            $history->previous = "Null";
            $history->current = $data->qa_comments_ooc;
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

        if (!empty($data->qa_comments_description_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Description of Cause for OOC Results (If Identified)';
            $history->previous = "Null";
            $history->current = $data->qa_comments_description_ooc;
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


        if (!empty($data->is_repeat_assingable_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Root Cause identified';
            $history->previous = "Null";
            $history->current = $data->is_repeat_assingable_ooc;
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

        if (!empty($data->rootcausenewfield)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Phase IA Investigation Comment';
            $history->previous = "Null";
            $history->current = $data->rootcausenewfield;
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

        if (!empty($data->protocol_based_study_hypthesis_study_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Protocol Based Study/Hypothesis Study';
            $history->previous = "Null";
            $history->current = $data->protocol_based_study_hypthesis_study_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->justification_for_protocol_study_hypothesis_study_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Justification for Protocol study/ Hypothesis Study';
            $history->previous = "Null";
            $history->current = $data->justification_for_protocol_study_hypothesis_study_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


        if (!empty($data->plan_of_protocol_study_hypothesis_study)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Plan of Protocol Study/Hypothesis Study';
            $history->previous = "Null";
            $history->current = $data->plan_of_protocol_study_hypothesis_study;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if(!empty($data->attachments_hypothesis_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Hypothesis Attachment';
            $history->previous = "Null";
            // $history->current = $data->attachments_hypothesis_ooc;
            $history->current = str_replace(',', ', ', $data->attachments_hypothesis_ooc);
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

        if (!empty($data->conclusion_of_protocol_based_study_hypothesis_study_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Conclusion of Protocol based Study/Hypothesis Study';
            $history->previous = "Null";
            $history->current = $data->conclusion_of_protocol_based_study_hypothesis_study_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->calibration_results_stage_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Calibration Results';
            $history->previous = "Null";
            $history->current = $data->calibration_results_stage_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->review_of_calibration_results_of_analyst_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Review of Calibration Results of Analyst';
            $history->previous = "Null";
            $history->current = $data->review_of_calibration_results_of_analyst_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->attachments_stage_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Phase IA Attachment';
            $history->previous = "Null";
            // $history->current = json_encode($data->attachments_stage_ooc);
            $history->current = str_replace(',', ', ', $data->attachments_stage_ooc);
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->results_criteria_stage_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Result Criteria';
            $history->previous = "Null";
            $history->current = $data->results_criteria_stage_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($data->is_repeat_stae_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Result';
            $history->previous = "Null";
            $history->current = $data->is_repeat_stae_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->additional_remarks_stage_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Additional Remarks (if any)';
            $history->previous = "Null";
            $history->current = $data->additional_remarks_stage_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($data->initiated_through_capas_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Corrective Action';
            $history->previous = "Null";
            $history->current = $data->initiated_through_capas_ooc;
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

        if (!empty($data->initiated_through_capa_prevent_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Preventive Action';
            $history->previous = "Null";
            $history->current = $data->initiated_through_capa_prevent_ooc;
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

            if (!empty($data->initiated_through_capa_corrective_ooc)) {
                $history = new OOCAuditTrail();
                $history->ooc_id = $data->id;
                $history->activity_type = 'Corrective & Preventive Action';
                $history->previous = "Null";
                $history->current = $data->initiated_through_capa_corrective_ooc;
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

            if (!empty($data->phase_ia_investigation_summary)) {
                $history = new OOCAuditTrail();
                $history->ooc_id = $data->id;
                $history->activity_type = 'Phase IA Summary';
                $history->previous = "Null";
                $history->current = $data->phase_ia_investigation_summary;
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

        if(!empty($data->phase_IA_HODREMARKS)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Phase IA HOD Remarks';
            $history->previous = "Null";
            $history->current = $data->phase_IA_HODREMARKS;
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

        if(!empty($data->attachments_hodIAHODPRIMARYREVIEW_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Phase IA HOD Attachment';
            $history->previous = "Null";
            // $history->current = json_encode($data->attachments_hodIAHODPRIMARYREVIEW_ooc);
            $history->current = str_replace(',', ', ', $data->attachments_hodIAHODPRIMARYREVIEW_ooc);
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

        if(!empty($data->qaremarksnewfield)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Phase IA QA Remarks';
            $history->previous = "Null";
            $history->current = $data->qaremarksnewfield;
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

            if (!empty($data->initial_attachment_capa_post_ooc)) {
                $history = new OOCAuditTrail();
                $history->ooc_id = $data->id;
                $history->activity_type = 'Phase IA QA Attachment';
                $history->previous = "Null";
                // $history->current = $data->initial_attachment_capa_post_ooc;
                $history->current = str_replace(',', ', ', $data->initial_attachment_capa_post_ooc);
                $history->comment = "Null";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to = "Opened";
                $history->change_from = "Initiation";
                $history->action_name = "Create";
                $history->save();
            }

            if (!empty($data->assignable_cause_identified)) {
                $history = new OOCAuditTrail();
                $history->ooc_id = $data->id;
                $history->activity_type = 'Assignable cause identified';
                $history->previous = "Null";
                $history->current = $data->assignable_cause_identified;
                $history->comment = "Null";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to = "Opened";
                $history->change_from = "Initiation";
                $history->action_name = "Create";
                $history->save();
            }

            if(!empty($data->qaHremarksnewfield)) {
                $history = new OOCAuditTrail();
                $history->ooc_id = $data->id;
                $history->activity_type = 'P-IA QAH Remarks';
                $history->previous = "Null";
                $history->current = $data->qaHremarksnewfield;
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

        if(!empty($data->initial_attachment_qah_post_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'P-IA QAH Attachment';
            $history->previous = "Null";
            // $history->current = json_encode($data->initial_attachment_qah_post_ooc);
            $history->current = str_replace(',', ', ', $data->initial_attachment_qah_post_ooc);
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

            if (!empty($data->is_repeat_stageii_ooc)) {
                $history = new OOCAuditTrail();
                $history->ooc_id = $data->id;
                $history->activity_type = 'Rectification by Service Engineer required';
                $history->previous = "Null";
                $history->current = $data->is_repeat_stageii_ooc;
                $history->comment = "Null";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $data->status;
                $history->change_to = "Opened";
                $history->change_from = "Initiation";
                $history->action_name = "Create";
                $history->save();
            }

        if (!empty($data->is_repeat_stage_instrument_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Instrument is Out of Order';
            $history->previous = "Null";
            $history->current = $data->is_repeat_stage_instrument_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->details_of_instrument_out_of_order)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Details of instrument out of order';
            $history->previous = "Null";
            $history->current = $data->details_of_instrument_out_of_order;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->is_repeat_proposed_stage_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Proposed By';
            $history->previous = "Null";
            $history->current = $data->is_repeat_proposed_stage_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->initial_attachment_stageii_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Details of Equipment Rectification Attachment';
            $history->previous = "Null";
            // $history->current = $data->initial_attachment_stageii_ooc;
            $history->current = str_replace(',', ', ', $data->initial_attachment_stageii_ooc);
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->is_repeat_compiled_stageii_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Compiled by';
            $history->previous = "Null";
            $history->current = $data->is_repeat_compiled_stageii_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        // Impact Assessment
        if (!empty($data->initiated_throug_stageii_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Impact Assessment';
            $history->previous = "Null";
            $history->current = $data->initiated_throug_stageii_ooc;
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

        if (!empty($data->initiated_through_stageii_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Details of Impact Evaluation';
            $history->previous = "Null";
            $history->current = $data->initiated_through_stageii_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->justification_for_recalibration)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Justification for Recalibration';
            $history->previous = "Null";
            $history->current = $data->justification_for_recalibration;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->is_repeat_reanalysis_stageii_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Result of Recalibration';
            $history->previous = "Null";
            $history->current = $data->is_repeat_reanalysis_stageii_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->initiated_through_stageii_cause_failure_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Cause for failure';
            $history->previous = "Null";
            $history->current = $data->initiated_through_stageii_cause_failure_ooc;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->initiated_through_capas_ooc_IB)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Corrective action IB Investigation.';
            $history->previous = "Null";
            $history->current = $data->initiated_through_capas_ooc_IB;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->initiated_through_capa_prevent_ooc_IB)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Preventive action IB Investigation.';
            $history->previous = "Null";
            $history->current = $data->initiated_through_capa_prevent_ooc_IB;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($data->initiated_through_capa_corrective_ooc_IB)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Corrective and preventive action IB Investigation.';
            $history->previous = "Null";
            $history->current = $data->initiated_through_capa_corrective_ooc_IB;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $data->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($data->phase_ib_investigation_summary)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Phase IB Summary';
            $history->previous = "Null";
            $history->current = $data->phase_ib_investigation_summary;
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

        if (!empty($data->initial_attachment_reanalysisi_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Phase IB Attachment';
            $history->previous = "Null";
            // $history->current = $data->initial_attachment_reanalysisi_ooc;
            $history->current = str_replace(',', ', ', $data->initial_attachment_reanalysisi_ooc);
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

        if(!empty($data->phase_IB_HODREMARKS)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Phase IB HOD Primary Remarks';
            $history->previous = "Null";
            $history->current = $data->phase_IB_HODREMARKS;
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

        if(!empty($data->attachments_hodIBBBHODPRIMARYREVIEW_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Phase IB HOD Primary Attachment';
            $history->previous = "Null";
            // $history->current = json_encode($data->attachments_hodIBBBHODPRIMARYREVIEW_ooc);
            $history->current = str_replace(',', ', ', $data->attachments_hodIBBBHODPRIMARYREVIEW_ooc);
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

        if(!empty($data->phase_IB_qareviewREMARKS)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Phase IB QA Remarks';
            $history->previous = "Null";
            $history->current = $data->phase_IB_qareviewREMARKS;
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

        if(!empty($data->attachments_QAIBBBREVIEW_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Phase IB QA Attachment';
            $history->previous = "Null";
            // $history->current = json_encode($data->attachments_QAIBBBREVIEW_ooc);
            $history->current = str_replace(',', ', ', $data->attachments_QAIBBBREVIEW_ooc);
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


        if(!empty($data->is_repeat_realease_stageii_ooc)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'Release of Instrument for usage';
            $history->previous = "Null";
            $history->current = $data->is_repeat_realease_stageii_ooc;
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

        if(!empty($data->qPIBaHremarksnewfield)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'P-IB QAH Remarks';
            $history->previous = "Null";
            $history->current = $data->qPIBaHremarksnewfield;
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

        if(!empty($data->Pib_attachements)) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $data->id;
            $history->activity_type = 'P-IB QAH Attachment';
            $history->previous = "Null";
            // $history->current = json_encode($data->Pib_attachements);
            $history->current = str_replace(',', ', ', $data->Pib_attachements);
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


        $oocGrid = $data->id;

        if (!empty($request->instrumentdetails)) {
        $instrumentDetail = OOC_Grid::where(['ooc_id' => $oocGrid, 'identifier' => 'Instrument Details'])->firstOrNew();
        $instrumentDetail->ooc_id = $oocGrid;
        $instrumentDetail->identifier = 'Instrument Details';
        $instrumentDetail->data = $request->instrumentdetails;
        $instrumentDetail->save();
        }

       //    if($request->has('oocevoluation')){
        if (!empty($request->instrumentdetails)) {

        $oocevaluation = OOC_Grid::where(['ooc_id'=>$oocGrid,'identifier'=>'OOC Evaluation'])->firstOrNew();
        $oocevaluation->ooc_id = $oocGrid;
        $oocevaluation->identifier = 'OOC Evaluation';
        $oocevaluation->data = $request->oocevoluation;
        $oocevaluation->save();
        }




        // HOD SuperVision Review






        // Preliminary Investigation
        // if(!empty($data->Preliminary_Investigation_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'Preliminary Investigation';
        //     $history->previous = "Null";
        //     $history->current = $data->Preliminary_Investigation_ooc;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }


        // OOC EVALUATION














        // STAGE-I





        // if (!empty($data->is_repeat_result_naturey_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'Results Nature';
        //     $history->previous = "Null";
        //     $history->current = $data->is_repeat_result_naturey_ooc;
        //     $history->comment = "Null";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }
















        // STAGEII







        // if (!empty($data->is_repeat_realease_stageii_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'Is Repeat Release Stage II';
        //     $history->previous = "Null";
        //     $history->current = $data->is_repeat_realease_stageii_ooc;
        //     $history->comment = "Null";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }













        // if (!empty($data->is_repeat_capas_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'CAPA Type';
        //     $history->previous = "Null";
        //     $history->current = $data->is_repeat_capas_ooc;
        //     $history->comment = "Null";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }
        // if (!empty($data->initiated_through)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'Initiated Through';
        //     $history->previous = "Null";
        //     $history->current = $data->initiated_through;
        //     $history->comment = "Null";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // if (!empty($data->initiated_through_capa_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'CAPA Post Implementation Comments';
        //     $history->previous = "Null";
        //     $history->current = $data->initiated_through_capa_ooc;
        //     $history->comment = "Null";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }






        // if (!empty($data->is_repeat_capas_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'CAPA Type';
        //     $history->previous = "Null";
        //     $history->current = $data->is_repeat_capas_ooc;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }
        // Closure Fields
        // if (!empty($data->short_description_closure_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'Closure Comments';
        //     $history->previous = "Null";
        //     $history->current = $data->short_description_closure_ooc;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // if (!empty($data->initial_attachment_closure_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'Details of Equipment Rectification';
        //     $history->previous = "Null";
        //     $history->current = $data->initial_attachment_closure_ooc;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // if (!empty($data->document_code_closure_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'Document Code';
        //     $history->previous = "Null";
        //     $history->current = $data->document_code_closure_ooc;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // if (!empty($data->remarks_closure_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'Remarks';
        //     $history->previous = "Null";
        //     $history->current = $data->remarks_closure_ooc;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // if (!empty($data->initiated_through_closure_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'Immediate Corrective Action';
        //     $history->previous = "Null";
        //     $history->current = $data->initiated_through_closure_ooc;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }
        // Immediate Corrective Action
        // if (!empty($data->initiated_through_closure_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'Immediate Corrective Action';
        //     $history->previous = "Null";
        //     $history->current = $data->initiated_through_closure_ooc;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // HOD Remarks
        // if (!empty($data->initiated_through_hodreview_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'HOD Remarks';
        //     $history->previous = "Null";
        //     $history->current = $data->initiated_through_hodreview_ooc;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // HOD Attachment
        // if (!empty($data->initial_attachment_hodreview_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'HOD Attachment';
        //     $history->previous = "Null";
        //     $history->current = $data->initial_attachment_hodreview_ooc;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // Root Cause Analysis
        // if (!empty($data->initiated_through_rootcause_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'Root Cause Analysis';
        //     $history->previous = "Null";
        //     $history->current = $data->initiated_through_rootcause_ooc;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // if(!empty($data->initial_attachment_qahead_ooc)) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $data->id;
        //     $history->activity_type = 'QA Head Attachment';
        //     $history->previous = "Null";
        //     $history->current = json_encode($data->initial_attachment_qahead_ooc);
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $data->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

       toastr()->success('Record is created Successfully');

        return redirect('rcms/qms-dashboard');


        // return $data;

    }

    public function OutofCalibrationShow($id){

        $ooc = OutOfCalibration::where('id', $id)->first();
        // dd($ooc);
        $ooc->record = str_pad($ooc->record, 4, '0', STR_PAD_LEFT);
        $ooc->assign_to_name = User::where('id', $ooc->assign_id)->value('name');
        $ooc->initiator_name = User::where('id', $ooc->initiator_id)->value('name');

       // $oocgrid = OOC_Grid::where('ooc_id',$id)->first();

 $oocgrid = OOC_Grid::where(['ooc_id'=> $id,'identifier'=>'Instrument Details'])->first();
        $oocgridDecoded = [];
        if ($oocgrid && $oocgrid->data) {
            $oocgridDecoded = is_string($oocgrid->data)
                ? json_decode($oocgrid->data, true)
                : $oocgrid->data;
        }

        $oocEvolution = OOC_Grid::where(['ooc_id'=>$id, 'identifier'=>'OOC Evaluation'])->first();

        return view('frontend.OOC.ooc_view' , compact('ooc','oocgrid','oocEvolution','oocgridDecoded'));
    }

    public function updateOutOfCalibration(Request $request,$id )
    {


        if (!$request->description_ooc) {
            toastr()->info("Short Description is required");
            return redirect()->back()->withInput();
        }
        $lastDocumentOoc = OutOfCalibration::find($id);
        $ooc = OutOfCalibration::find($id);
        $lastDocumentOocs = $ooc->replicate();
        $ooc->initiator_id = Auth::user()->id;
        // $ooc->intiation_date = $request->intiation_date;
        $ooc->assign_to = $request->assign_to;
        $ooc->due_date = $request->due_date;
        $ooc->ooc_logged_by = $request->ooc_logged_by;
        $ooc->description_ooc = $request->description_ooc;
        $ooc->Initiator_Group= $request->Initiator_Group;
        $ooc->hodremarksnewfield = $request->hodremarksnewfield;
        $ooc->qaremarksnewfield = $request->qaremarksnewfield;
        $ooc->initiator_group_code= $request->initiator_group_code;
        $ooc->initiated_through = $request->initiated_through;
        $ooc->Summary_closure = $request->Summary_closure;
        $ooc->initiated_if_other= $request->initiated_if_other;
        $ooc->qa_assign_person = $request->qa_assign_person;
        $ooc->initiated_through_capas_ooc_IB = $request->initiated_through_capas_ooc_IB;
        $ooc->initiated_through_capa_prevent_ooc_IB = $request->initiated_through_capa_prevent_ooc_IB;
        $ooc->initiated_through_capa_corrective_ooc_IB = $request->initiated_through_capa_corrective_ooc_IB;
        $ooc->is_repeat_ooc= $request->is_repeat_ooc;
        $ooc->Repeat_Nature= $request->Repeat_Nature;
        $ooc->details_of_ooc= $request->details_of_ooc;


        $ooc->ooc_due_date= $request->ooc_due_date;
        $ooc->Delay_Justification_for_Reporting= $request->Delay_Justification_for_Reporting;
        $ooc->HOD_Remarks = $request->HOD_Remarks;
        $ooc->Immediate_Action_ooc = $request->Immediate_Action_ooc;
        $ooc->Preliminary_Investigation_ooc = $request->Preliminary_Investigation_ooc;
        $ooc->qa_comments_ooc = $request->qa_comments_ooc;
        $ooc->qa_comments_description_ooc = $request->qa_comments_description_ooc;
        $ooc->is_repeat_assingable_ooc = $request->is_repeat_assingable_ooc;
        $ooc->protocol_based_study_hypthesis_study_ooc = $request->protocol_based_study_hypthesis_study_ooc;
        $ooc->justification_for_protocol_study_hypothesis_study_ooc = $request->justification_for_protocol_study_hypothesis_study_ooc;
        $ooc->plan_of_protocol_study_hypothesis_study = $request->plan_of_protocol_study_hypothesis_study;
        $ooc->conclusion_of_protocol_based_study_hypothesis_study_ooc = $request->conclusion_of_protocol_based_study_hypothesis_study_ooc;
        $ooc->analysis_remarks_stage_ooc = $request->analysis_remarks_stage_ooc;
        $ooc->calibration_results_stage_ooc = $request->calibration_results_stage_ooc;
        $ooc->is_repeat_result_naturey_ooc = $request->is_repeat_result_naturey_ooc;
        $ooc->review_of_calibration_results_of_analyst_ooc = $request->review_of_calibration_results_of_analyst_ooc;
        $ooc->results_criteria_stage_ooc = $request->results_criteria_stage_ooc;
        $ooc->is_repeat_stae_ooc = $request->is_repeat_stae_ooc;
        $ooc->last_calibration_date = $request->last_calibration_date;
        // dd($ooc->is_repeat_stae_ooc);
        $ooc->qa_comments_stage_ooc = $request->qa_comments_stage_ooc;
        $ooc->additional_remarks_stage_ooc = $request->additional_remarks_stage_ooc;
        $ooc->is_repeat_stageii_ooc = $request->is_repeat_stageii_ooc;
        $ooc->is_repeat_stage_instrument_ooc = $request->is_repeat_stage_instrument_ooc;
        $ooc->is_repeat_proposed_stage_ooc = $request->is_repeat_proposed_stage_ooc;
        $ooc->is_repeat_compiled_stageii_ooc = $request->is_repeat_compiled_stageii_ooc;
        $ooc->compiled_by = $request->compiled_by;
        $ooc->details_of_instrument_out_of_order = $request->details_of_instrument_out_of_order;

        $ooc->assignable_cause_identified = $request->assignable_cause_identified;


        $ooc->initiated_throug_stageii_ooc = $request->initiated_throug_stageii_ooc;
        $ooc->initiated_through_stageii_ooc = $request->initiated_through_stageii_ooc;
        $ooc->is_repeat_reanalysis_stageii_ooc = $request->is_repeat_reanalysis_stageii_ooc;
        $ooc->justification_for_recalibration = $request->justification_for_recalibration;

        $ooc->initiated_through_stageii_cause_failure_ooc = $request->initiated_through_stageii_cause_failure_ooc;
        $ooc->is_repeat_capas_ooc = $request->is_repeat_capas_ooc;
        $ooc->initiated_through_capas_ooc = $request->initiated_through_capas_ooc;
        $ooc->rootcausenewfield = $request->rootcausenewfield;
        $ooc->phase_ib_investigation_summary = $request->phase_ib_investigation_summary;
        $ooc->phase_ia_investigation_summary = $request->phase_ia_investigation_summary;



        // dd($ooc->initiated_through_capas_ooc);
        $ooc->initiated_through_capa_prevent_ooc = $request->initiated_through_capa_prevent_ooc;
        $ooc->initiated_through_capa_corrective_ooc = $request->initiated_through_capa_corrective_ooc;
        $ooc->initiated_through_capa_ooc = $request->initiated_through_capa_ooc;
        $ooc->short_description_closure_ooc = $request->short_description_closure_ooc;
        $ooc->document_code_closure_ooc = $request->document_code_closure_ooc;
        $ooc->remarks_closure_ooc = $request->remarks_closure_ooc;
        $ooc->initiated_through_closure_ooc = $request->initiated_through_closure_ooc;
        $ooc->initiated_through_hodreview_ooc = $request->initiated_through_hodreview_ooc;
        $ooc->initiated_through_rootcause_ooc = $request->initiated_through_rootcause_ooc;
        $ooc->initiated_through_impact_closure_ooc = $request->initiated_through_impact_closure_ooc;

        // Update Remarks Fields
        $ooc->qaheadremarks = $request->qaheadremarks;
        $ooc->phase_IA_HODREMARKS = $request->phase_IA_HODREMARKS;
        $ooc->qaHremarksnewfield = $request->qaHremarksnewfield;
        $ooc->phase_IB_HODREMARKS = $request->phase_IB_HODREMARKS;
        $ooc->phase_IB_qareviewREMARKS = $request->phase_IB_qareviewREMARKS;
        $ooc->qPIBaHremarksnewfield = $request->qPIBaHremarksnewfield;

        $ooc->is_repeat_realease_stageii_ooc = $request->is_repeat_realease_stageii_ooc;
        
        // Update Attachments Fields
        if (!empty($request->initial_attachment_qahead_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_qahead_ooc')) {
                foreach ($request->file('initial_attachment_qahead_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_qahead_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_qahead_ooc = json_encode($files);
        }

        if (!empty($request->attachments_hodIAHODPRIMARYREVIEW_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_hodIAHODPRIMARYREVIEW_ooc')) {
                foreach ($request->file('attachments_hodIAHODPRIMARYREVIEW_ooc') as $file) {
                    $name = $request->name . 'PhaseIA_HOD_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->attachments_hodIAHODPRIMARYREVIEW_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_qah_post_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_qah_post_ooc')) {
                foreach ($request->file('initial_attachment_qah_post_ooc') as $file) {
                    $name = $request->name . 'P_IA_QAH_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_qah_post_ooc = json_encode($files);
        }

        if (!empty($request->attachments_hodIBBBHODPRIMARYREVIEW_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_hodIBBBHODPRIMARYREVIEW_ooc')) {
                foreach ($request->file('attachments_hodIBBBHODPRIMARYREVIEW_ooc') as $file) {
                    $name = $request->name . 'Phase_IB_HOD_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->attachments_hodIBBBHODPRIMARYREVIEW_ooc = json_encode($files);
        }

        if (!empty($request->attachments_QAIBBBREVIEW_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_QAIBBBREVIEW_ooc')) {
                foreach ($request->file('attachments_QAIBBBREVIEW_ooc') as $file) {
                    $name = $request->name . 'Phase_IB_QA_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->attachments_QAIBBBREVIEW_ooc = json_encode($files);
        }

        if (!empty($request->Pib_attachements)) {
            $files = [];
            if ($request->hasfile('Pib_attachements')) {
                foreach ($request->file('Pib_attachements') as $file) {
                    $name = $request->name . 'P_IB_QAH_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->Pib_attachements = json_encode($files);
        }






        if (!empty($request->initial_attachment_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_ooc')) {
                foreach ($request->file('initial_attachment_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_ooc = json_encode($files);
        }
        if (!empty($request->initial_attachment_stageii_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_stageii_ooc')) {
                foreach ($request->file('initial_attachment_stageii_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_stageii_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_stageii_ooc = json_encode($files);
        }
        if (!empty($request->attachments_hod_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_hod_ooc')) {
                foreach ($request->file('attachments_hod_ooc') as $file) {
                    $name = $request->name . 'attachments_hod_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->attachments_hod_ooc = json_encode($files);
        }

        if (!empty($request->attachments_stage_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_stage_ooc')) {
                foreach ($request->file('attachments_stage_ooc') as $file) {
                    $name = $request->name . 'Phase_IA_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->attachments_stage_ooc = json_encode($files);
        }

        if (!empty($request->attachments_hypothesis_ooc)) {
            $files = [];
            if ($request->hasfile('attachments_hypothesis_ooc')) {
                foreach ($request->file('attachments_hypothesis_ooc') as $file) {
                    $name = $request->name . 'Hypothesis_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->attachments_hypothesis_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_reanalysisi_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_reanalysisi_ooc')) {
                foreach ($request->file('initial_attachment_reanalysisi_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_reanalysisi_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_reanalysisi_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_hodreview_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_hodreview_ooc')) {
                foreach ($request->file('initial_attachment_hodreview_ooc') as $file) {
                    $name = $request->name . 'HOD_Review_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_hodreview_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_closure_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_closure_ooc')) {
                foreach ($request->file('initial_attachment_closure_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_closure_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_closure_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_capa_post_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_capa_post_ooc')) {
                foreach ($request->file('initial_attachment_capa_post_ooc') as $file) {
                    $name = $request->name . 'Phase_IA_QA_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_capa_post_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_capa_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_capa_ooc')) {
                foreach ($request->file('initial_attachment_capa_ooc') as $file) {
                    $name = $request->name . 'QA_Head_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $ooc->initial_attachment_capa_ooc = json_encode($files);
        }


       //=======================================================Audit Trail======================================================//

        if ($lastDocumentOoc->due_date != $ooc->due_date) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Due Date';
            $history->previous = Helpers::getdateFormat($lastDocumentOoc->due_date);
            $history->current = Helpers::getdateFormat($ooc->due_date);
            $history->comment = $request->due_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->due_date) || $lastDocumentOoc->due_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        $department = [
            'CQA' => 'Corporate Quality Assurance',
            'QA' => 'Quality Assurance',
            'QC' => 'Quality Control',
            'QM' => 'Quality Control (Microbiology department)',
            'PG' => 'Production General',
            'PL' => 'Production Liquid Orals',
            'PT' => 'Production Tablet and Powder',
            'PE' => 'Production External (Ointment, Gels, Creams and Liquid)',
            'PC' => 'Production Capsules',
            'PI' => 'Production Injectable',
            'EN' => 'Engineering',
            'HR' => 'Human Resource',
            'ST' => 'Store',
            'IT' => 'Electronic ooc Processing',
            'FD' => 'Formulation Development',
            'AL' => 'Analytical research and Development Laboratory',
            'PD' => 'Packaging Development',
            'PU' => 'Purchase Department',
            'DC' => 'Document Cell',
            'RA' => 'Regulatory Affairs',
            'PV' => 'Pharmacovigilance',
        ];


        // $department = [
        //     'CQA' => 'Corporate Quality Assurance',
        //     'QAB' => 'Quality Assurance Biopharma',
        //     'CQC' => 'Central Quality Control',
        //     'PSG' => 'Plasma Sourcing Group',
        //     'CS' => 'Central Stores',
        //     'ITG' => 'Information Technology Group',
        //     'MM' => 'Molecular Medicine',
        //     'CL' => 'Central Laboratory',
        //     'TT' => 'Tech Team',
        //     'QA' => 'Quality Assurance',
        //     'QM' => 'Quality Management',
        //     'IA' => 'IT Administration',
        //     'ACC' => 'Accounting',
        //     'LOG' => 'Logistics',
        //     'SM' => 'Senior Management',
        //     'BA' => 'Business Administration',
        // ];

        $lastInitiatorGroupFullForm = isset($department[$lastDocumentOoc->Initiator_Group]) ? $department[$lastDocumentOoc->Initiator_Group] : $lastDocumentOoc->Initiator_Group;
        $currentInitiatorGroupFullForm = isset($department[$ooc->Initiator_Group]) ? $department[$ooc->Initiator_Group] : $ooc->Initiator_Group;


        if ($lastDocumentOoc->Initiator_Group != $ooc->Initiator_Group) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Initiation Department';
            $history->previous = $lastInitiatorGroupFullForm;
            $history->current = $currentInitiatorGroupFullForm;
            $history->comment = $request->Initiator_Group_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->Initiator_Group) || $lastDocumentOoc->Initiator_Group === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocumentOoc->initiator_group_code != $ooc->initiator_group_code) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Initiation Department Code';
            $history->previous = $lastDocumentOoc->initiator_group_code;
            $history->current = $ooc->initiator_group_code;
            $history->comment = $request->initiator_group_code_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initiator_group_code) || $lastDocumentOoc->initiator_group_code === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocumentOoc->last_calibration_date != $ooc->last_calibration_date) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Last Calibration Date';
            $history->previous = Helpers::getdateFormat($lastDocumentOoc->last_calibration_date);
            $history->current = Helpers::getdateFormat($ooc->last_calibration_date);
            $history->comment = $request->last_calibration_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;

            if (is_null($lastDocumentOoc->last_calibration_date) || $lastDocumentOoc->last_calibration_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocumentOoc->description_ooc != $ooc->description_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastDocumentOoc->description_ooc;
            $history->current = $ooc->description_ooc;
            $history->comment = $request->description_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->description_ooc) || $lastDocumentOoc->description_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        if ($lastDocumentOoc->initiated_through != $ooc->initiated_through) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Initiated Through';
            $history->previous = $lastDocumentOoc->initiated_through;
            $history->current = $ooc->initiated_through;
            $history->comment = $request->initiated_through_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initiated_through) || $lastDocumentOoc->initiated_through === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        if ($lastDocumentOoc->initiated_if_other != $ooc->initiated_if_other) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'If Other';
            $history->previous = $lastDocumentOoc->initiated_if_other;
            $history->current = $ooc->initiated_if_other;
            $history->comment = $request->initiated_if_other_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initiated_if_other) || $lastDocumentOoc->initiated_if_other === '') {
                $history->action_name = "New";
            }  else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        // if ($lastDocumentOoc->is_repeat_capas_ooc != $ooc->is_repeat_capas_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'Is Repeat';
        //     $history->previous = $lastDocumentOoc->is_repeat_capas_ooc;
        //     $history->current = $ooc->is_repeat_capas_ooc;
        //     $history->comment = $request->is_repeat_capas_ooc_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     if (is_null($lastDocumentOoc->is_repeat_capas_ooc) || $lastDocumentOoc->is_repeat_capas_ooc === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();

        // }

        if ($lastDocumentOoc->is_repeat_ooc != $ooc->is_repeat_ooc ) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Is Repeat';
            $history->previous = $lastDocumentOoc->is_repeat_ooc;
            $history->current = $ooc->is_repeat_ooc;
            $history->comment = $request->is_repeat_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->is_repeat_ooc) || $lastDocumentOoc->is_repeat_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocumentOoc->Repeat_Nature != $ooc->Repeat_Nature) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = $lastDocumentOoc->Repeat_Nature;
            $history->current = $ooc->Repeat_Nature;
            $history->comment = $request->Repeat_Nature_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->Repeat_Nature) || $lastDocumentOoc->Repeat_Nature === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        if ($lastDocumentOoc->details_of_ooc != $ooc->details_of_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Details of OOC';
            $history->previous = $lastDocumentOoc->details_of_ooc;
            $history->current = $ooc->details_of_ooc;
            $history->comment = $request->details_of_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->details_of_ooc) || $lastDocumentOoc->details_of_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        if ($lastDocumentOoc->initial_attachment_ooc != $ooc->initial_attachment_ooc ) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Initial Attachment';
            $history->previous = str_replace(',', ', ', $lastDocumentOoc->initial_attachment_ooc);
            $history->current = str_replace(',', ', ', $ooc->initial_attachment_ooc);
            $history->comment = $request->initial_attachment_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initial_attachment_ooc) || $lastDocumentOoc->initial_attachment_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocumentOoc->assign_to != $ooc->assign_to ) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'HOD Person';
            $history->previous = Helpers::getInitiatorName($lastDocumentOoc->assign_to);
            $history->current = Helpers::getInitiatorName($ooc->assign_to);
            $history->comment = $request->qa_assign_person_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->assign_to) || $lastDocumentOoc->assign_to === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocumentOoc->qa_assign_person != $ooc->qa_assign_person ) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'QA Person';
            $history->previous = Helpers::getInitiatorName($lastDocumentOoc->qa_assign_person);
            $history->current = Helpers::getInitiatorName($ooc->qa_assign_person);
            $history->comment = $request->qa_assign_person_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->qa_assign_person) || $lastDocumentOoc->qa_assign_person === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocumentOoc->ooc_logged_by != $ooc->ooc_logged_by) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'OOC Logged by';
            $history->previous = $lastDocumentOoc->ooc_logged_by;
            $history->current = $ooc->ooc_logged_by;
            $history->comment = $request->ooc_logged_by_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->ooc_logged_by) || $lastDocumentOoc->ooc_logged_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocumentOoc->ooc_due_date != $ooc->ooc_due_date ) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'OOC Logged On';
            $history->previous = Carbon::parse($lastDocumentOoc->ooc_due_date)->format('d-M-Y');
            $history->current = Carbon::parse($ooc->ooc_due_date)->format('d-M-Y');
            $history->comment = $request->ooc_due_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->ooc_due_date) || $lastDocumentOoc->ooc_due_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocumentOoc->Delay_Justification_for_Reporting != $ooc->Delay_Justification_for_Reporting ) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Delay Justification for Reporting';
            $history->previous = $lastDocumentOoc->Delay_Justification_for_Reporting;
            $history->current = $ooc->Delay_Justification_for_Reporting;
            $history->comment = $request->Delay_Justification_for_Reporting_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->Delay_Justification_for_Reporting) || $lastDocumentOoc->Delay_Justification_for_Reporting === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        // Check and log changes for Immediate Action
        if ($lastDocumentOoc->Immediate_Action_ooc != $ooc->Immediate_Action_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Immediate Action';
            $history->previous = $lastDocumentOoc->Immediate_Action_ooc;
            $history->current = $ooc->Immediate_Action_ooc;
            $history->comment = 'Updated Immediate Action';
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->Immediate_Action_ooc) || $lastDocumentOoc->Immediate_Action_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        // Check and log changes for HOD Remarks
        if ($lastDocumentOoc->HOD_Remarks != $ooc->HOD_Remarks) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'HOD Primary Review Remarks';
            $history->previous = $lastDocumentOoc->HOD_Remarks;
            $history->current = $ooc->HOD_Remarks;
            $history->comment = 'Updated HOD Remarks';
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->HOD_Remarks) || $lastDocumentOoc->HOD_Remarks === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        // Check and log changes for HOD Attachment
        if ($lastDocumentOoc->attachments_hod_ooc != $ooc->attachments_hod_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'HOD Primary Review Attachments';
            // $history->previous = json_encode($lastDocumentOoc->attachments_hod_ooc);
            // $history->current = json_encode($ooc->attachments_hod_ooc);
            $history->previous = str_replace(',', ', ', $lastDocumentOoc->attachments_hod_ooc);
            $history->current = str_replace(',', ', ', $ooc->attachments_hod_ooc);
            $history->comment = 'Updated HOD Attachment';
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->attachments_hod_ooc) || $lastDocumentOoc->attachments_hod_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->qaheadremarks != $ooc->qaheadremarks) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'QA Head Primary Review Remarks';
            $history->previous = $lastDocumentOoc->qaheadremarks;
            $history->current = $ooc->qaheadremarks;
            $history->comment = $request->qaheadremarks_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            $history->action_name = is_null($lastDocumentOoc->qaheadremarks) ? "New" : "Update";
            $history->save();
        }

        if ($lastDocumentOoc->initial_attachment_capa_ooc != $ooc->initial_attachment_capa_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'QA Head Primary Review Attachment';
            // $history->previous = $lastDocumentOoc->initial_attachment_capa_ooc;
            // $history->current = $ooc->initial_attachment_capa_ooc;
            $history->previous = str_replace(',', ', ', $lastDocumentOoc->initial_attachment_capa_ooc);
            $history->current = str_replace(',', ', ', $ooc->initial_attachment_capa_ooc);
            $history->comment = $request->initial_attachment_capa_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initial_attachment_capa_ooc) || $lastDocumentOoc->initial_attachment_capa_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocumentOoc->analysis_remarks_stage_ooc != $ooc->analysis_remarks_stage_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Analyst Interview';
            $history->previous = $lastDocumentOoc->analysis_remarks_stage_ooc;
            $history->current = $ooc->analysis_remarks_stage_ooc;
            $history->comment = $request->analysis_remarks_stage_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->analysis_remarks_stage_ooc) || $lastDocumentOoc->analysis_remarks_stage_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        // Check and log changes for Evaluation Remarks
        if ($lastDocumentOoc->qa_comments_ooc != $ooc->qa_comments_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Evaluation Remarks';
            $history->previous = $lastDocumentOoc->qa_comments_ooc;
            $history->current = $ooc->qa_comments_ooc;
            $history->comment = 'Updated Evaluation Remarks';
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->qa_comments_ooc) || $lastDocumentOoc->qa_comments_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->qa_comments_description_ooc != $ooc->qa_comments_description_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Description of Cause for OOC Results (If Identified)';
            $history->previous = $lastDocumentOoc->qa_comments_description_ooc;
            $history->current = $ooc->qa_comments_description_ooc;
            $history->comment = 'Updated Description of Cause for OOC Results';
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->qa_comments_description_ooc) || $lastDocumentOoc->qa_comments_description_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        if ($lastDocumentOoc->is_repeat_assingable_ooc != $ooc->is_repeat_assingable_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Root Cause identified';
            $history->previous = $lastDocumentOoc->is_repeat_assingable_ooc;
            $history->current = $ooc->is_repeat_assingable_ooc;
            $history->comment = $request->is_repeat_assingable_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->is_repeat_assingable_ooc) || $lastDocumentOoc->is_repeat_assingable_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->rootcausenewfield != $ooc->rootcausenewfield) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Phase IA Investigation Comment';
            $history->previous = $lastDocumentOoc->rootcausenewfield;
            $history->current = $ooc->rootcausenewfield;
            $history->comment = $request->rootcausenewfield_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->rootcausenewfield) || $lastDocumentOoc->rootcausenewfield === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->protocol_based_study_hypthesis_study_ooc != $ooc->protocol_based_study_hypthesis_study_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Protocol Based Study/Hypothesis Study ';
            $history->previous = $lastDocumentOoc->protocol_based_study_hypthesis_study_ooc;
            $history->current = $ooc->protocol_based_study_hypthesis_study_ooc;
            $history->comment = $request->protocol_based_study_hypthesis_study_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->protocol_based_study_hypthesis_study_ooc) || $lastDocumentOoc->protocol_based_study_hypthesis_study_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        // Check and log changes for Justification for Protocol Study/Hypothesis Study
        if ($lastDocumentOoc->justification_for_protocol_study_hypothesis_study_ooc != $ooc->justification_for_protocol_study_hypothesis_study_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Justification for Protocol study/ Hypothesis Study';
            $history->previous = $lastDocumentOoc->justification_for_protocol_study_hypothesis_study_ooc;
            $history->current = $ooc->justification_for_protocol_study_hypothesis_study_ooc;
            $history->comment = $request->justification_for_protocol_study_hypothesis_study_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->justification_for_protocol_study_hypothesis_study_ooc) || $lastDocumentOoc->justification_for_protocol_study_hypothesis_study_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        // Check and log changes for Plan of Protocol Study/Hypothesis Study
        if ($lastDocumentOoc->plan_of_protocol_study_hypothesis_study != $ooc->plan_of_protocol_study_hypothesis_study) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Plan of Protocol Study/Hypothesis Study';
            $history->previous = $lastDocumentOoc->plan_of_protocol_study_hypothesis_study;
            $history->current = $ooc->plan_of_protocol_study_hypothesis_study;
            $history->comment = $request->plan_of_protocol_study_hypothesis_study_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->plan_of_protocol_study_hypothesis_study) || $lastDocumentOoc->plan_of_protocol_study_hypothesis_study === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->attachments_hypothesis_ooc != $ooc->attachments_hypothesis_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Hypothesis Attachment';
            // $history->previous = $lastDocumentOoc->attachments_hypothesis_ooc;
            // $history->current = $ooc->attachments_hypothesis_ooc;
            $history->previous = str_replace(',', ', ', $lastDocumentOoc->attachments_hypothesis_ooc);
            $history->current = str_replace(',', ', ', $ooc->attachments_hypothesis_ooc);
            $history->comment = $request->attachments_hypothesis_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->attachments_hypothesis_ooc) || $lastDocumentOoc->attachments_hypothesis_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }


        if ($lastDocumentOoc->conclusion_of_protocol_based_study_hypothesis_study_ooc != $ooc->conclusion_of_protocol_based_study_hypothesis_study_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Conclusion of Protocol based Study/Hypothesis Study';
            $history->previous = $lastDocumentOoc->conclusion_of_protocol_based_study_hypothesis_study_ooc;
            $history->current = $ooc->conclusion_of_protocol_based_study_hypothesis_study_ooc;
            $history->comment = $request->conclusion_of_protocol_based_study_hypothesis_study_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->conclusion_of_protocol_based_study_hypothesis_study_ooc) || $lastDocumentOoc->conclusion_of_protocol_based_study_hypothesis_study_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        if ($lastDocumentOoc->calibration_results_stage_ooc != $ooc->calibration_results_stage_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Calibration Results';
            $history->previous = $lastDocumentOoc->calibration_results_stage_ooc;
            $history->current = $ooc->calibration_results_stage_ooc;
            $history->comment = $request->calibration_results_stage_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->calibration_results_stage_ooc) || $lastDocumentOoc->calibration_results_stage_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->review_of_calibration_results_of_analyst_ooc != $ooc->review_of_calibration_results_of_analyst_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Review of Calibration Results of Analyst';
            $history->previous = $lastDocumentOoc->review_of_calibration_results_of_analyst_ooc;
            $history->current = $ooc->review_of_calibration_results_of_analyst_ooc;
            $history->comment = $request->review_of_calibration_results_of_analyst_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->review_of_calibration_results_of_analyst_ooc) || $lastDocumentOoc->review_of_calibration_results_of_analyst_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        if ($lastDocumentOoc->attachments_stage_ooc != $ooc->attachments_stage_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Phase IA Attachment';
            // $history->previous = $lastDocumentOoc->attachments_stage_ooc;
            // $history->current = $ooc->attachments_stage_ooc;
            $history->previous = str_replace(',', ', ', $lastDocumentOoc->attachments_stage_ooc);
            $history->current = str_replace(',', ', ', $ooc->attachments_stage_ooc);
            $history->comment = 'Updated Phase IA Attachment';
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->attachments_stage_ooc) || $lastDocumentOoc->attachments_stage_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->results_criteria_stage_ooc != $ooc->results_criteria_stage_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Result Criteria';
            $history->previous = $lastDocumentOoc->results_criteria_stage_ooc;
            $history->current = $ooc->results_criteria_stage_ooc;
            $history->comment = 'Updated Result Criteria';
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->results_criteria_stage_ooc) || $lastDocumentOoc->results_criteria_stage_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->is_repeat_stae_ooc != $ooc->is_repeat_stae_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Result';
            $history->previous = $lastDocumentOoc->is_repeat_stae_ooc;
            $history->current = $ooc->is_repeat_stae_ooc;
            $history->comment = $request->is_repeat_stae_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->is_repeat_stae_ooc) || $lastDocumentOoc->is_repeat_stae_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->additional_remarks_stage_ooc != $ooc->additional_remarks_stage_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Additional Remarks (if any)';
            $history->previous = $lastDocumentOoc->additional_remarks_stage_ooc;
            $history->current = $ooc->additional_remarks_stage_ooc;
            $history->comment = 'Updated Additional Remarks';
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->additional_remarks_stage_ooc) || $lastDocumentOoc->additional_remarks_stage_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->initiated_through_capas_ooc != $ooc->initiated_through_capas_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Corrective Action';
            $history->previous = $lastDocumentOoc->initiated_through_capas_ooc;
            $history->current = $ooc->initiated_through_capas_ooc;
            $history->comment = $request->initiated_through_capas_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initiated_through_capas_ooc) || $lastDocumentOoc->initiated_through_capas_ooc === '') {
                $history->action_name = "New";
            } else {
                if (is_null($lastDocumentOoc->initiated_through_capas_ooc) || $lastDocumentOoc->initiated_through_capas_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            }
            $history->save();

        }

        if ($lastDocumentOoc->initiated_through_capa_prevent_ooc != $ooc->initiated_through_capa_prevent_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Preventive Action';
            $history->previous = $lastDocumentOoc->initiated_through_capa_prevent_ooc;
            $history->current = $ooc->initiated_through_capa_prevent_ooc;
            $history->comment = $request->initiated_through_capa_prevent_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initiated_through_capa_prevent_ooc) || $lastDocumentOoc->initiated_through_capa_prevent_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocumentOoc->initiated_through_capa_corrective_ooc != $ooc->initiated_through_capa_corrective_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Corrective & Preventive Action';
            $history->previous = $lastDocumentOoc->initiated_through_capa_corrective_ooc;
            $history->current = $ooc->initiated_through_capa_corrective_ooc;
            $history->comment = $request->initiated_through_capa_corrective_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initiated_through_capa_prevent_ooc) || $lastDocumentOoc->initiated_through_capa_prevent_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocumentOoc->phase_ia_investigation_summary != $ooc->phase_ia_investigation_summary) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Phase IA Summary';
            $history->previous = $lastDocumentOoc->phase_ia_investigation_summary;
            $history->current = $ooc->phase_ia_investigation_summary;
            $history->comment = $request->phase_ia_investigation_summary_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->phase_ia_investigation_summary) || $lastDocumentOoc->phase_ia_investigation_summary === '') {
                $history->action_name = "New";
            } else {
                if (is_null($lastDocumentOoc->phase_ia_investigation_summary) || $lastDocumentOoc->phase_ia_investigation_summary === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            }
            $history->save();

        }

        if ($lastDocumentOoc->phase_IA_HODREMARKS != $ooc->phase_IA_HODREMARKS) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Phase IA HOD Remarks';
            $history->previous = $lastDocumentOoc->phase_IA_HODREMARKS;
            $history->current = $ooc->phase_IA_HODREMARKS;
            $history->comment = $request->phase_IA_HODREMARKS_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            $history->action_name = is_null($lastDocumentOoc->phase_IA_HODREMARKS) ? "New" : "Update";
            $history->save();
        }

        if ($lastDocumentOoc->attachments_hodIAHODPRIMARYREVIEW_ooc != $ooc->attachments_hodIAHODPRIMARYREVIEW_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Phase IA HOD Attachment';
            // $history->previous = $lastDocumentOoc->attachments_hodIAHODPRIMARYREVIEW_ooc;
            // $history->current = $ooc->attachments_hodIAHODPRIMARYREVIEW_ooc;
            $history->previous = str_replace(',', ', ', $lastDocumentOoc->attachments_hodIAHODPRIMARYREVIEW_ooc);
            $history->current = str_replace(',', ', ', $ooc->attachments_hodIAHODPRIMARYREVIEW_ooc);
            $history->comment = $request->attachments_hodIAHODPRIMARYREVIEW_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            $history->action_name = is_null($lastDocumentOoc->attachments_hodIAHODPRIMARYREVIEW_ooc) ? "New" : "Update";
            $history->save();
        }

        if ($lastDocumentOoc->qaremarksnewfield != $ooc->qaremarksnewfield) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Phase IA QA Remarks';
            $history->previous = $lastDocumentOoc->qaremarksnewfield;
            $history->current = $ooc->qaremarksnewfield;
            $history->comment = $request->qaremarksnewfield_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            $history->action_name = is_null($lastDocumentOoc->qaremarksnewfield) ? "New" : "Update";
            $history->save();
        }

        if ($lastDocumentOoc->initial_attachment_capa_post_ooc != $ooc->initial_attachment_capa_post_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Phase IA QA Attachment';
            // $history->previous = $lastDocumentOoc->initial_attachment_capa_post_ooc;
            // $history->current = $ooc->initial_attachment_capa_post_ooc;
            $history->previous = str_replace(',', ', ', $lastDocumentOoc->initial_attachment_capa_post_ooc);
            $history->current = str_replace(',', ', ', $ooc->initial_attachment_capa_post_ooc);
            $history->comment = $request->initial_attachment_capa_post_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            $history->action_name = is_null($lastDocumentOoc->initial_attachment_capa_post_ooc) ? "New" : "Update";
            $history->save();
        }

        if (
            isset($ooc->assignable_cause_identified) &&
            !empty($ooc->assignable_cause_identified) &&
            ($lastDocumentOoc->assignable_cause_identified !== $ooc->assignable_cause_identified)
        ) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Assignable cause identified';
            $history->previous = $lastDocumentOoc->assignable_cause_identified;
            $history->current = $ooc->assignable_cause_identified;
            $history->comment = $request->assignable_cause_identified ?? null;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            $history->action_name = is_null($lastDocumentOoc->assignable_cause_identified) ? "New" : "Update";
            $history->save();
        }

        if ($lastDocumentOoc->qaHremarksnewfield != $ooc->qaHremarksnewfield) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'P-IA QAH Remarks';
            $history->previous = $lastDocumentOoc->qaHremarksnewfield;
            $history->current = $ooc->qaHremarksnewfield;
            $history->comment = $request->qaHremarksnewfield_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            $history->action_name = is_null($lastDocumentOoc->qaHremarksnewfield) ? "New" : "Update";
            $history->save();
        }

        if ($lastDocumentOoc->initial_attachment_qah_post_ooc != $ooc->initial_attachment_qah_post_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'P-IA QAH Attachment';
            // $history->previous = $lastDocumentOoc->initial_attachment_qah_post_ooc;
            // $history->current = $ooc->initial_attachment_qah_post_ooc;
            $history->previous = str_replace(',', ', ', $lastDocumentOoc->initial_attachment_qah_post_ooc);
            $history->current = str_replace(',', ', ', $ooc->initial_attachment_qah_post_ooc);
            $history->comment = $request->initial_attachment_qah_post_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            $history->action_name = is_null($lastDocumentOoc->initial_attachment_qah_post_ooc) ? "New" : "Update";
            $history->save();
        }

        if ($lastDocumentOoc->is_repeat_stageii_ooc != $ooc->is_repeat_stageii_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Rectification by Service Engineer required';
            $history->previous = $lastDocumentOoc->is_repeat_stageii_ooc;
            $history->current = $ooc->is_repeat_stageii_ooc;
            $history->comment = $request->is_repeat_stageii_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->is_repeat_stageii_ooc) || $lastDocumentOoc->is_repeat_stageii_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->is_repeat_stage_instrument_ooc != $ooc->is_repeat_stage_instrument_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Instrument is Out of Order';
            $history->previous = $lastDocumentOoc->is_repeat_stage_instrument_ooc;
            $history->current = $ooc->is_repeat_stage_instrument_ooc;
            $history->comment = $request->is_repeat_stage_instrument_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->is_repeat_stage_instrument_ooc) || $lastDocumentOoc->is_repeat_stage_instrument_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->details_of_instrument_out_of_order != $ooc->details_of_instrument_out_of_order) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Details of instrument out of order';
            $history->previous = $lastDocumentOoc->details_of_instrument_out_of_order;
            $history->current = $ooc->details_of_instrument_out_of_order;
            $history->comment = $request->details_of_instrument_out_of_order_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->details_of_instrument_out_of_order) || $lastDocumentOoc->details_of_instrument_out_of_order === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->is_repeat_compiled_stageii_ooc != $ooc->is_repeat_compiled_stageii_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Proposed By';
            $history->previous = Helpers::getInitiatorName($lastDocumentOoc->is_repeat_compiled_stageii_ooc);
            $history->current = Helpers::getInitiatorName($ooc->is_repeat_compiled_stageii_ooc);
            $history->comment = $request->is_repeat_compiled_stageii_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->is_repeat_compiled_stageii_ooc) || $lastDocumentOoc->is_repeat_compiled_stageii_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->initial_attachment_stageii_ooc != $ooc->initial_attachment_stageii_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Details of Equipment Rectification Attachment';
            // $history->previous = json_encode($lastDocumentOoc->initial_attachment_stageii_ooc);
            // $history->current = json_encode($ooc->initial_attachment_stageii_ooc);
            $history->previous = str_replace(',', ', ', $lastDocumentOoc->initial_attachment_stageii_ooc);
            $history->current = str_replace(',', ', ', $ooc->initial_attachment_stageii_ooc);
            $history->comment = $request->initial_attachment_stageii_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initial_attachment_stageii_ooc) || $lastDocumentOoc->initial_attachment_stageii_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->compiled_by != $ooc->compiled_by) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Compiled by';
            $history->previous = Helpers::getInitiatorName($lastDocumentOoc->compiled_by);
            $history->current = Helpers::getInitiatorName($ooc->compiled_by);
            $history->comment = $request->compiled_by_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->compiled_by) || $lastDocumentOoc->compiled_by === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->initiated_throug_stageii_ooc != $ooc->initiated_throug_stageii_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Impact Assessment';
            $history->previous = $lastDocumentOoc->initiated_throug_stageii_ooc;
            $history->current = $ooc->initiated_throug_stageii_ooc;
            $history->comment = $request->initiated_throug_stageii_ooc;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initiated_through_rootcause_ooc) || $lastDocumentOoc->initiated_through_rootcause_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->initiated_through_stageii_ooc != $ooc->initiated_through_stageii_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Details of Impact Evaluation';
            $history->previous = $lastDocumentOoc->initiated_through_stageii_ooc;
            $history->current = $ooc->initiated_through_stageii_ooc;
            $history->comment = $request->initiated_through_stageii_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initiated_throug_stageii_ooc) || $lastDocumentOoc->initiated_throug_stageii_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        if ($lastDocumentOoc->justification_for_recalibration != $ooc->justification_for_recalibration) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Justification for Recalibration';
            $history->previous = $lastDocumentOoc->justification_for_recalibration;
            $history->current = $ooc->justification_for_recalibration;
            $history->comment = $request->justification_for_recalibration_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->justification_for_recalibration) || $lastDocumentOoc->justification_for_recalibration === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->is_repeat_reanalysis_stageii_ooc != $ooc->is_repeat_reanalysis_stageii_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Result of Recalibration';
            $history->previous = $lastDocumentOoc->is_repeat_reanalysis_stageii_ooc;
            $history->current = $ooc->is_repeat_reanalysis_stageii_ooc;
            $history->comment = $request->is_repeat_reanalysis_stageii_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->is_repeat_reanalysis_stageii_ooc) || $lastDocumentOoc->is_repeat_reanalysis_stageii_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        if ($lastDocumentOoc->initiated_through_stageii_cause_failure_ooc != $ooc->initiated_through_stageii_cause_failure_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Cause for failure';
            $history->previous = $lastDocumentOoc->initiated_through_stageii_cause_failure_ooc;
            $history->current = $ooc->initiated_through_stageii_cause_failure_ooc;
            $history->comment = $request->initiated_through_stageii_cause_failure_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initiated_through_stageii_cause_failure_ooc) || $lastDocumentOoc->initiated_through_stageii_cause_failure_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocumentOoc->initiated_through_capas_ooc_IB != $ooc->initiated_through_capas_ooc_IB) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Corrective action IB Investigation.';
            $history->previous = $lastDocumentOoc->initiated_through_capas_ooc_IB;
            $history->current = $ooc->initiated_through_capas_ooc_IB;
            $history->comment = $request->initiated_through_capas_ooc_IB_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initiated_through_capas_ooc_IB) || $lastDocumentOoc->initiated_through_capas_ooc_IB === '') {
                $history->action_name = "New";
            } else {
                if (is_null($lastDocumentOoc->initiated_through_capas_ooc_IB) || $lastDocumentOoc->initiated_through_capas_ooc_IB === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            }
            $history->save();

        }

        if ($lastDocumentOoc->initiated_through_capa_prevent_ooc_IB != $ooc->initiated_through_capa_prevent_ooc_IB) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Preventive action IB Investigation.';
            $history->previous = $lastDocumentOoc->initiated_through_capa_prevent_ooc_IB;
            $history->current = $ooc->initiated_through_capa_prevent_ooc_IB;
            $history->comment = $request->initiated_through_capa_prevent_ooc_IB_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initiated_through_capa_prevent_ooc_IB) || $lastDocumentOoc->initiated_through_capa_prevent_ooc_IB === '') {
                $history->action_name = "New";
            } else {
                if (is_null($lastDocumentOoc->initiated_through_capa_prevent_ooc_IB) || $lastDocumentOoc->initiated_through_capa_prevent_ooc_IB === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            }
            $history->save();

        }


        if ($lastDocumentOoc->initiated_through_capa_corrective_ooc_IB != $ooc->initiated_through_capa_corrective_ooc_IB) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Corrective and preventive action IB Investigation.';
            $history->previous = $lastDocumentOoc->initiated_through_capa_corrective_ooc_IB;
            $history->current = $ooc->initiated_through_capa_corrective_ooc_IB;
            $history->comment = $request->initiated_through_capa_corrective_ooc_IB_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initiated_through_capa_corrective_ooc_IB) || $lastDocumentOoc->initiated_through_capa_corrective_ooc_IB === '') {
                $history->action_name = "New";
            } else {
                if (is_null($lastDocumentOoc->initiated_through_capa_corrective_ooc_IB) || $lastDocumentOoc->initiated_through_capa_corrective_ooc_IB === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            }
            $history->save();

        }

        if ($lastDocumentOoc->phase_ib_investigation_summary != $ooc->phase_ib_investigation_summary) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Phase IB Summary';
            $history->previous = $lastDocumentOoc->phase_ib_investigation_summary;
            $history->current = $ooc->phase_ib_investigation_summary;
            $history->comment = $request->phase_ib_investigation_summary_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->phase_ib_investigation_summary) || $lastDocumentOoc->phase_ib_investigation_summary === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocumentOoc->initial_attachment_reanalysisi_ooc != $ooc->initial_attachment_reanalysisi_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Phase IB Attachment';
            // $history->previous = $lastDocumentOoc->initial_attachment_reanalysisi_ooc;
            // $history->current = $ooc->initial_attachment_reanalysisi_ooc;
            $history->previous = str_replace(',', ', ', $lastDocumentOoc->initial_attachment_reanalysisi_ooc);
            $history->current = str_replace(',', ', ', $ooc->initial_attachment_reanalysisi_ooc);
            $history->comment = $request->initial_attachment_reanalysisi_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            if (is_null($lastDocumentOoc->initial_attachment_reanalysisi_ooc) || $lastDocumentOoc->initial_attachment_reanalysisi_ooc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocumentOoc->phase_IB_HODREMARKS != $ooc->phase_IB_HODREMARKS) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Phase IB HOD Primary Remarks';
            $history->previous = $lastDocumentOoc->phase_IB_HODREMARKS;
            $history->current = $ooc->phase_IB_HODREMARKS;
            $history->comment = $request->phase_IB_HODREMARKS_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            $history->action_name = is_null($lastDocumentOoc->phase_IB_HODREMARKS) ? "New" : "Update";
            $history->save();
        }

        if ($lastDocumentOoc->attachments_hodIBBBHODPRIMARYREVIEW_ooc != $ooc->attachments_hodIBBBHODPRIMARYREVIEW_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Phase IB HOD Primary Attachment';
            // $history->previous = $lastDocumentOoc->attachments_hodIBBBHODPRIMARYREVIEW_ooc;
            // $history->current = $ooc->attachments_hodIBBBHODPRIMARYREVIEW_ooc;
            $history->previous = str_replace(',', ', ', $lastDocumentOoc->attachments_hodIBBBHODPRIMARYREVIEW_ooc);
            $history->current = str_replace(',', ', ', $ooc->attachments_hodIBBBHODPRIMARYREVIEW_ooc);
            $history->comment = $request->attachments_hodIBBBHODPRIMARYREVIEW_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            $history->action_name = is_null($lastDocumentOoc->attachments_hodIBBBHODPRIMARYREVIEW_ooc) ? "New" : "Update";
            $history->save();
        }

        if ($lastDocumentOoc->phase_IB_qareviewREMARKS != $ooc->phase_IB_qareviewREMARKS) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Phase IB QA Remarks';
            $history->previous = $lastDocumentOoc->phase_IB_qareviewREMARKS;
            $history->current = $ooc->phase_IB_qareviewREMARKS;
            $history->comment = $request->phase_IB_qareviewREMARKS_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            $history->action_name = is_null($lastDocumentOoc->phase_IB_qareviewREMARKS) ? "New" : "Update";
            $history->save();
        }

        if ($lastDocumentOoc->attachments_QAIBBBREVIEW_ooc != $ooc->attachments_QAIBBBREVIEW_ooc) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Phase IB QA Attachment';
            // $history->previous = $lastDocumentOoc->attachments_QAIBBBREVIEW_ooc;
            // $history->current = $ooc->attachments_QAIBBBREVIEW_ooc;
            $history->previous = str_replace(',', ', ', $lastDocumentOoc->attachments_QAIBBBREVIEW_ooc);
            $history->current = str_replace(',', ', ', $ooc->attachments_QAIBBBREVIEW_ooc);
            $history->comment = $request->attachments_QAIBBBREVIEW_ooc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            $history->action_name = is_null($lastDocumentOoc->attachments_QAIBBBREVIEW_ooc) ? "New" : "Update";
            $history->save();
        }

        if (
            isset($ooc->is_repeat_realease_stageii_ooc) &&
            !empty($ooc->is_repeat_realease_stageii_ooc) &&
            ($lastDocumentOoc->is_repeat_realease_stageii_ooc !== $ooc->is_repeat_realease_stageii_ooc)
        ) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Release of Instrument for usage';
            $history->previous = $lastDocumentOoc->is_repeat_realease_stageii_ooc;
            $history->current = $ooc->is_repeat_realease_stageii_ooc;
            $history->comment = $request->is_repeat_realease_stageii_ooc_comment ?? null;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;

            $history->action_name = (is_null($lastDocumentOoc->is_repeat_realease_stageii_ooc) || $lastDocumentOoc->is_repeat_realease_stageii_ooc === '')
                                    ? "New"
                                    : "Update";
            $history->save();
        }

        if ($lastDocumentOoc->qPIBaHremarksnewfield != $ooc->qPIBaHremarksnewfield) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'P-IB QAH Remarks';
            $history->previous = $lastDocumentOoc->qPIBaHremarksnewfield;
            $history->current = $ooc->qPIBaHremarksnewfield;
            $history->comment = $request->qPIBaHremarksnewfield_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            $history->action_name = is_null($lastDocumentOoc->qPIBaHremarksnewfield) ? "New" : "Update";
            $history->save();
        }

        if ($lastDocumentOoc->Pib_attachements != $ooc->Pib_attachements) {
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'P-IB QAH Attachement';
            // $history->previous = $lastDocumentOoc->Pib_attachements;
            // $history->current = $ooc->Pib_attachements;
            $history->previous = str_replace(',', ', ', $lastDocumentOoc->Pib_attachements);
            $history->current = str_replace(',', ', ', $ooc->Pib_attachements);
            $history->comment = $request->Pib_attachements_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOoc->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocumentOoc->status;
            $history->action_name = is_null($lastDocumentOoc->Pib_attachements) ? "New" : "Update";
            $history->save();
        }




        // Check and log changes for Preliminary Investigation
        // if ($lastDocumentOoc->Preliminary_Investigation_ooc != $ooc->Preliminary_Investigation_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'Preliminary Investigation';
        //     $history->previous = $lastDocumentOoc->Preliminary_Investigation_ooc;
        //     $history->current = $ooc->Preliminary_Investigation_ooc;
        //     $history->comment = 'Updated Preliminary Investigation';
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     if (is_null($lastDocumentOoc->Preliminary_Investigation_ooc) || $lastDocumentOoc->Preliminary_Investigation_ooc === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        // OOC Evaluation


        // Check and log changes for Description of Cause for OOC Results

        // stage i

        // if ($lastDocumentOoc->is_repeat_result_naturey_ooc != $ooc->is_repeat_result_naturey_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'Results Naturey';
        //     $history->previous = $lastDocumentOoc->is_repeat_result_naturey_ooc;
        //     $history->current = $ooc->is_repeat_result_naturey_ooc;
        //     $history->comment = 'Updated Results Naturey';
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     if (is_null($lastDocumentOoc->is_repeat_result_naturey_ooc) || $lastDocumentOoc->is_repeat_result_naturey_ooc === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        // if ($lastDocumentOoc->review_of_calibration_results_of_analyst_ooc != $ooc->review_of_calibration_results_of_analyst_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'Review of Calibration Results of Analyst';
        //     $history->previous = $lastDocumentOoc->review_of_calibration_results_of_analyst_ooc;
        //     $history->current = $ooc->review_of_calibration_results_of_analyst_ooc;
        //     $history->comment = 'Updated Review of Calibration Results of Analyst';
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     if (is_null($lastDocumentOoc->review_of_calibration_results_of_analyst_ooc) || $lastDocumentOoc->review_of_calibration_results_of_analyst_ooc === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        // if ($lastDocumentOoc->initiated_throug_stageii_ooc != $ooc->initiated_throug_stageii_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'Impact Assessment at Stage II';
        //     $history->previous = $lastDocumentOoc->initiated_throug_stageii_ooc;
        //     $history->current = $ooc->initiated_throug_stageii_ooc;
        //     $history->comment = $request->initiated_throug_stageii_ooc_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     if (is_null($lastDocumentOoc->initiated_throug_stageii_ooc) || $lastDocumentOoc->initiated_throug_stageii_ooc === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }


        // // Closure Fields
        // if ($lastDocumentOoc->short_description_closure_ooc != $ooc->short_description_closure_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'Closure Comments';
        //     $history->previous = $lastDocumentOoc->short_description_closure_ooc;
        //     $history->current = $ooc->short_description_closure_ooc;
        //     $history->comment = $request->short_description_closure_ooc_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     if (is_null($lastDocumentOoc->short_description_closure_ooc) || $lastDocumentOoc->short_description_closure_ooc === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        // if ($lastDocumentOoc->initial_attachment_closure_ooc != $ooc->initial_attachment_closure_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'Details of Equipment Rectification';
        //     $history->previous = $lastDocumentOoc->initial_attachment_closure_ooc;
        //     $history->current = $ooc->initial_attachment_closure_ooc;
        //     $history->comment = $request->initial_attachment_closure_ooc_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     if (is_null($lastDocumentOoc->initial_attachment_closure_ooc) || $lastDocumentOoc->initial_attachment_closure_ooc === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        // if ($lastDocumentOoc->document_code_closure_ooc != $ooc->document_code_closure_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'Document Code';
        //     $history->previous = $lastDocumentOoc->document_code_closure_ooc;
        //     $history->current = $ooc->document_code_closure_ooc;
        //     $history->comment = $request->document_code_closure_ooc_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     if (is_null($lastDocumentOoc->document_code_closure_ooc) || $lastDocumentOoc->document_code_closure_ooc === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        // if ($lastDocumentOoc->remarks_closure_ooc != $ooc->remarks_closure_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'Remarks';
        //     $history->previous = $lastDocumentOoc->remarks_closure_ooc;
        //     $history->current = $ooc->remarks_closure_ooc;
        //     $history->comment = $request->remarks_closure_ooc_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     if (is_null($lastDocumentOoc->remarks_closure_ooc) || $lastDocumentOoc->remarks_closure_ooc === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        // if ($lastDocumentOoc->initiated_through_closure_ooc != $ooc->initiated_through_closure_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'Immediate Corrective Action';
        //     $history->previous = $lastDocumentOoc->initiated_through_closure_ooc;
        //     $history->current = $ooc->initiated_through_closure_ooc;
        //     $history->comment = $request->initiated_through_closure_ooc_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     if (is_null($lastDocumentOoc->initiated_through_closure_ooc) || $lastDocumentOoc->initiated_through_closure_ooc === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        // if ($lastDocumentOoc->initiated_through_hodreview_ooc != $ooc->initiated_through_hodreview_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'HOD Remarks';
        //     $history->previous = $lastDocumentOoc->initiated_through_hodreview_ooc;
        //     $history->current = $ooc->initiated_through_hodreview_ooc;
        //     $history->comment = $request->initiated_through_hodreview_ooc_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     if (is_null($lastDocumentOoc->initiated_through_hodreview_ooc) || $lastDocumentOoc->initiated_if_other === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        // if ($lastDocumentOoc->initial_attachment_hodreview_ooc != $ooc->initial_attachment_hodreview_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'HOD Attachment';
        //     $history->previous = $lastDocumentOoc->initial_attachment_hodreview_ooc;
        //     $history->current = $ooc->initial_attachment_hodreview_ooc;
        //     $history->comment = $request->initial_attachment_hodreview_ooc_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     if (is_null($lastDocumentOoc->initial_attachment_hodreview_ooc) || $lastDocumentOoc->initial_attachment_hodreview_ooc === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        // if ($lastDocumentOoc->initiated_through_rootcause_ooc != $ooc->initiated_through_rootcause_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'Root Cause Analysis';
        //     $history->previous = $lastDocumentOoc->initiated_through_rootcause_ooc;
        //     $history->current = $ooc->initiated_through_rootcause_ooc;
        //     $history->comment = $request->initiated_through_rootcause_ooc_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     if (is_null($lastDocumentOoc->initiated_through_rootcause_ooc) || $lastDocumentOoc->initiated_through_rootcause_ooc === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }



        // if ($lastDocumentOoc->initial_attachment_qahead_ooc != $ooc->initial_attachment_qahead_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'Initial QA Head Attachment OOC';
        //     $history->previous = $lastDocumentOoc->initial_attachment_qahead_ooc;
        //     $history->current = $ooc->initial_attachment_qahead_ooc;
        //     $history->comment = $request->initial_attachment_qahead_ooc_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     $history->action_name = is_null($lastDocumentOoc->initial_attachment_qahead_ooc) ? "New" : "Update";
        //     $history->save();
        // }

        // if ($lastDocumentOoc->attachments_hodIAHODPRIMARYREVIEW_ooc != $ooc->attachments_hodIAHODPRIMARYREVIEW_ooc) {
        //     $history = new OOCAuditTrail();
        //     $history->ooc_id = $id;
        //     $history->activity_type = 'Phase IA HOD Attachment';
        //     $history->previous = $lastDocumentOoc->attachments_hodIAHODPRIMARYREVIEW_ooc;
        //     $history->current = $ooc->attachments_hodIAHODPRIMARYREVIEW_ooc;
        //     $history->comment = $request->attachments_hodIAHODPRIMARYREVIEW_ooc_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocumentOoc->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocumentOoc->status;
        //     $history->action_name = is_null($lastDocumentOoc->attachments_hodIAHODPRIMARYREVIEW_ooc) ? "New" : "Update";
        //     $history->save();
        // }


        // =============================================Update Grid ================================//
        $oocGrid = $ooc->id;
        // if($request->has('instrumentDetail')){
        // if (!empty($request->instrumentdetails)) {
        // $instrumentDetail = OOC_Grid::where(['ooc_id' => $oocGrid, 'identifier' => 'Instrument Details'])->firstOrNew();
        // $instrumentDetail->ooc_id = $oocGrid;
        // $instrumentDetail->identifier = 'Instrument Details';
        // $instrumentDetail->data = $request->instrumentdetails;
        // dd($instrumentDetail);
        // $instrumentDetail->save();
        // }


        ////////////////////////////////////////////////////////////////////////////////////

             
        if (!empty($request->instrumentdetails)) 
        {
            // dd($request->capa_closure_tab1);
            $existingInitialdetails = OOC_Grid::where(['ooc_id' => $oocGrid, 'identifier' => 'Instrument Details'])->first();
            $existingAuditorData = $existingInitialdetails ? $existingInitialdetails->data : [];

                        $CapaDetailGrid = OOC_Grid::firstOrNew(['ooc_id' => $oocGrid, 'identifier' => 'Instrument Details',]);
                        $CapaDetailGrid->ooc_id = $oocGrid;
                        $CapaDetailGrid->identifier = 'Instrument Details';
                        $CapaDetailGrid->data = $request->instrumentdetails;
                        $CapaDetailGrid->save();


                        $fieldNames = [
                            'instrument_name' => 'Instrument Name ',
                            'instrument_id' => 'Instrument ID',
                            'remarks' => 'Remarks',
                            'calibration' => 'Calibration Parameter',
                            'acceptancecriteria' => 'Acceptance Criteria',
                            'results' => 'Results',
                        ];

            // Track audit trail changes
            if (is_array($request->instrumentdetails)) {
                foreach ($request->instrumentdetails as $index => $newAuditor) {
                    $previousAuditor = $existingAuditorData[$index] ?? [];

                    // Track changes for each field
                    $fieldsToTrack = ['instrument_name', 'instrument_id', 'remarks','calibration','acceptancecriteria','results'];
                    foreach ($fieldsToTrack as $field) {
                        $oldValue = $previousAuditor[$field] ?? 'Null';
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // If there's a change, add an entry to the audit trail
                        if ($oldValue !== $newValue) {
                            $history = new OOCAuditTrail();
                            $history->ooc_id = $oocGrid;
                            $history->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                            $history->previous = $oldValue;
                            $history->current = $newValue;
                            $history->comment = "";
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocumentOoc->status;
                            $history->change_to = $lastDocumentOoc->status;
                            $history->change_from = $lastDocumentOoc->status;
                            $history->action_name = $oldValue == 'Null' ? "New" : "Update";
                            $history->save();
                        }
                    }
                }
            }
        
        }















        ////////////////////////////////////////////////////////////////////////////////////

        //    if($request->has('oocevoluation')){
        if (!empty($request->instrumentdetails)) {

        $oocevaluation = OOC_Grid::where(['ooc_id'=>$oocGrid,'identifier'=>'OOC Evaluation'])->firstOrNew();
        $oocevaluation->ooc_id = $oocGrid;
        $oocevaluation->identifier = 'OOC Evaluation';
        $oocevaluation->data = $request->oocevoluation;
        $oocevaluation->save();
        }




        //==============================================Update Grid ================================//













        toastr()->success('Record is updated Successfully');
        $ooc->update();
        // dd($ooc);

        $oocGrid = $ooc->id;
        $instrumentDetail = OOC_Grid::where(['ooc_id' => $oocGrid, 'identifier' => 'Instrument Details'])->firstOrNew();
        $instrumentDetail->ooc_id = $oocGrid;
        $instrumentDetail->identifier = 'Instrument Details';
        $instrumentDetail->data = $request->instrumentdetails;
        $instrumentDetail->save();





        //=====================Second Grid ===========================//






        //=====================Second Grid ===========================//


        return back();

    }


    private function generateResponseKey($question) {
        return str_replace(' ', '_', strtolower($question)) . '_response';
    }

    private function generateRemarkKey($question) {
        return str_replace(' ', '_', strtolower($question)) . '_remark';
    }





    public function OOCStateChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $oocchange = OutOfCalibration::find($id);
            $lastDocumentOOC = OutOfCalibration::find($id);

            if ($oocchange->stage == 1) {


                if (empty($oocchange->description_ooc) || empty($oocchange->ooc_due_date) || empty($oocchange->ooc_logged_by || empty($oocchange->qa_assign_person) || empty($oocchange->is_repeat_ooc) || empty($oocchange->assign_to) || empty($oocchange->initiated_through) || empty($oocchange->details_of_ooc) || empty($oocchange->due_date) || empty($oocchange->last_calibration_date))) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Pls Fill General Information Tab is yet to be filled!',
                        'type' => 'warning',  
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for HOD Primary Review',
                        'type' => 'success',
                    ]);
                }

                $oocchange->stage = "2";
                $oocchange->submitted_by = Auth::user()->name;
                $oocchange->submitted_on = Carbon::now()->format('d-M-Y');
                $oocchange->comment = $request->comment;
                $oocchange->status = "HOD Primary Review";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Submit By    ,   Submit On';
                        if (is_null($lastDocumentOOC->submitted_by) || $lastDocumentOOC->submitted_by === '') {
                            $history->previous = "Null";
                        } else {
                            $history->previous = $lastDocumentOOC->submitted_by . ' , ' . $lastDocumentOOC->submitted_on;
                        }

                    // $history->previous = $lastDocumentOOC->submitted_by;
                    $history->current = $oocchange->submitted_by . ' , ' . $oocchange->submitted_on;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocumentOOC->status;
                    $history->change_to = "HOD Primary Review";
                    $history->change_from = $lastDocumentOOC->status;
                    // $history->action_name = 'Submit';
                    if (is_null($lastDocumentOOC->submitted_by) || $lastDocumentOOC->submitted_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->action = 'Submit';

                    $history->stage='Submit';
                    $history->save();

                    $list = Helpers::getCftUserList($oocchange->division_id); // Notify CFT Person
                        foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $oocchange, 'site' => "OOC", 'history' => "Submit", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $oocchange) {
                                        $message->to($email)
                                        ->subject("Agio Notification: OOC, Record #" . str_pad($oocchange->record, 4, '0', STR_PAD_LEFT) . " - Activity: Submit");
                                    }
                                );
                            }
                        // }
                    }


                // $this->saveAuditTrail($id, $lastDocumentOOC, $oocchange, 'Opened', 'HOD Primary Review', $isInitial);
                $oocchange->update();
                toastr()->success('HOD Primary Review');
                return back();
            }


            if ($oocchange->stage == 2) {
                if (!$oocchange->HOD_Remarks) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'HOD Primary Remarks is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for QA Head Primary Review',
                        'type' => 'success',
                    ]);
                }
                // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'OOC')
                    ->get();
                        $hasPending1 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done') {
                                $hasPending1 = true;
                                break;
                            }
                        }

                    if ($hasPending1) {
                        // $extensionchildStatus = trim(strtolower($extensionchild->status));
                            Session::flash('swal', [
                                'title' => 'Extension Child Pending!',
                                'message' => 'You cannot proceed until Extension Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Sent for Next Stage',
                            'type' => 'success',
                        ]);
                    }

                $oocchange->stage = "3";
                $oocchange->initial_phase_i_investigation_completed_by = Auth::user()->name;
                $oocchange->initial_phase_i_investigation_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->initial_phase_i_investigation_comment = $request->comment;
                $oocchange->status = "QA Head Primary Review";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'HOD Primary Review Complete By     ,     HOD Primary Review Complete On';
                if (is_null($lastDocumentOOC->initial_phase_i_investigation_completed_by) || $lastDocumentOOC->initial_phase_i_investigation_completed_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocumentOOC->initial_phase_i_investigation_completed_by . ' , ' . $lastDocumentOOC->initial_phase_i_investigation_completed_on;
                }
                $history->current = $oocchange->initial_phase_i_investigation_completed_by . ' , ' . $oocchange->initial_phase_i_investigation_completed_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "QA Head Primary Review";
                $history->change_from = $lastDocumentOOC->status;
                $history->action = 'HOD Primary Review Complete';
                if (is_null($lastDocumentOOC->initial_phase_i_investigation_completed_by) || $lastDocumentOOC->initial_phase_i_investigation_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='HOD Primary Review Complete';
                $history->save();

                $list = Helpers::getCftUserList($oocchange->division_id); // Notify CFT Person
                        foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $oocchange, 'site' => "OOC", 'history' => "HOD Primary Review Complete", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $oocchange) {
                                        $message->to($email)
                                        ->subject("Agio Notification: OOC, Record #" . str_pad($oocchange->record, 4, '0', STR_PAD_LEFT) . " - Activity: HOD Primary Review Complete");
                                    }
                                );
                            }
                        // }
                    }


                // $this->saveAuditTrail($id, $lastDocumentOOC, $oocchange, 'HOD Primary Review', 'HOD Primary Review Complete');
                $oocchange->update();
                toastr()->success('QA Head Primary Review');
                return back();
            }

            if ($oocchange->stage == 3) {

                if (!$oocchange->qaheadremarks) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'QA Head Primary Remarks is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Under Phase-IA Investigation',
                        'type' => 'success',
                    ]);
                }

                // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'OOC')
                    ->get();
                        $hasPending2 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done') {
                                $hasPending2 = true;
                                break;
                            }
                        }

                    if ($hasPending2) {
                        // $extensionchildStatus = trim(strtolower($extensionchild->status));
                            Session::flash('swal', [
                                'title' => 'Extension Child Pending!',
                                'message' => 'You cannot proceed until Extension Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Sent for Next Stage',
                            'type' => 'success',
                        ]);
                    }

                $oocchange->stage = "4";
                $oocchange->assignable_cause_f_completed_by = Auth::user()->name;
                $oocchange->assignable_cause_f_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->assignable_cause_f_completed_comment = $request->comment;
                $oocchange->status = "Under Phase-IA Investigation";

                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = '';
                if (is_null($lastDocumentOOC->assignable_cause_f_completed_by) || $lastDocumentOOC->assignable_cause_f_completed_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocumentOOC->assignable_cause_f_completed_by . ' , ' . $lastDocumentOOC->assignable_cause_f_completed_on;
                }
                $history->activity_type = 'QA Head Primary Review Complete By    ,     QA Head Primary Review Complete  On';
                $history->current = $oocchange->assignable_cause_f_completed_by . ' , ' . $oocchange->assignable_cause_f_completed_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Under Phase-IA Investigation";
                $history->change_from = $lastDocumentOOC->status;
                $history->action = 'QA Head Primary Review Complete';
                $history->stage='QA Head Primary Review Complete';
                if (is_null($lastDocumentOOC->assignable_cause_f_completed_by) || $lastDocumentOOC->assignable_cause_f_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }

                $history->save();
                $list = Helpers::getCftUserList($oocchange->division_id); // Notify CFT Person
                        foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $oocchange, 'site' => "OOC", 'history' => "QA Head Primary Review Complete", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $oocchange) {
                                        $message->to($email)
                                        ->subject("Agio Notification: OOC, Record #" . str_pad($oocchange->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA Head Primary Review Complete");
                                    }
                                );
                            }
                        // }
                    }
                // $this->saveAuditTrail($id, $lastDocumentOOC, $oocchange, 'CQA/QA Head Primary Review', 'CQA/QA Head Primary Review Complete');
                $oocchange->update();
                toastr()->success('Under Phase-IA Investigation');
                return back();
            }

            
            if ($oocchange->stage == 4) {

                if (empty($oocchange->qa_comments_ooc)|| empty($oocchange->is_repeat_stae_ooc) || empty($oocchange->phase_ia_investigation_summary) || empty($oocchange->analysis_remarks_stage_ooc) || empty($oocchange->qa_comments_ooc) || empty($oocchange->qa_comments_description_ooc) || empty($oocchange->is_repeat_assingable_ooc) ) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required! Phase IA Investigation',
                        'message' => 'Phase IA Investigation Tab is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Phase IA HOD Primary Review',
                        'type' => 'success',
                    ]);
                }
                //Capa child validation
                    $oo_c_capa_child = Capa::where('parent_id', $id)
                   ->where('parent_type', 'OOC')
                        ->get();

                    $hasPendingChild = false;
                    foreach ($oo_c_capa_child as $child) {
                        $status = trim(strtolower($child->status));
                        if (!in_array($status, ['closed - done', 'reject', 'cancel'])) {
                            $hasPendingChild = true;
                            break;
                        }
                    }

                    if ($hasPendingChild) {
                        Session::flash('swal', [
                            'title' => 'Child CAPA Pending!',
                            'message' => 'You cannot proceed until all CAPA child records are Closed-Done, Rejected, or Cancelled.',
                            'type' => 'warning',
                        ]);
                        return redirect()->back();
                    }

                // ✅ Action Item Child Validation
                    $OOCChildAction = ActionItem::where('parent_id', $id)
                        ->where('parent_type', 'OOC')
                        ->get();

                    $hasPendingActionChild = false;

                    foreach ($OOCChildAction as $child) {
                        $status = trim(strtolower($child->status));
                        // Check if Action Item child is still open
                        if (!in_array($status, ['closed - done', 'reject', 'cancel'])) {
                            $hasPendingActionChild = true;
                            break;
                        }
                    }

                    if ($hasPendingActionChild) {
                        Session::flash('swal', [
                            'title' => 'Action Item Child Pending!',
                            'message' => 'You cannot proceed until all Action Item child records are Closed-Done, Rejected, or Cancelled.',
                            'type' => 'warning',
                        ]);
                        return redirect()->back();
                    }

                // ✅ Root Cause Analysis Child Validation
                    $OOCChildRoot = RootCauseAnalysis::where('parent_id', $id)
                        ->where('parent_type', 'OOC')
                        ->get();

                    $hasPendingRootChild = false;

                    foreach ($OOCChildRoot as $child) {
                        $status = trim(strtolower($child->status));
                        // Check if Root Cause Analysis child is still open
                        if (!in_array($status, ['closed - done', 'reject', 'cancel'])) {
                            $hasPendingRootChild = true;
                            break;
                        }
                    }

                    if ($hasPendingRootChild) {
                        Session::flash('swal', [
                            'title' => 'Root Cause Analysis Pending!',
                            'message' => 'You cannot proceed until all Root Cause Analysis child records are Closed-Done, Rejected, or Cancelled.',
                            'type' => 'warning',
                        ]);
                        return redirect()->back();
                    }


                 // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'OOC')
                    ->get();
                        $hasPending3 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done') {
                                $hasPending3 = true;
                                break;
                            }
                        }

                    if ($hasPending3) {
                        // $extensionchildStatus = trim(strtolower($extensionchild->status));
                            Session::flash('swal', [
                                'title' => 'Extension Child Pending!',
                                'message' => 'You cannot proceed until Extension Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Sent for Next Stage',
                            'type' => 'success',
                        ]);
                    }

                $oocchange->stage = "5";
                $oocchange->cause_f_completed_by = Auth::user()->name;
                $oocchange->cause_f_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->cause_f_completed_comment = $request->comment;
                $oocchange->status = "Phase IA HOD Primary Review";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Phase IA Investigation By     ,     Phase IA Investigation On';
                if (is_null($lastDocumentOOC->cause_f_completed_by) || $lastDocumentOOC->cause_f_completed_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocumentOOC->cause_f_completed_by . ' , ' . $lastDocumentOOC->cause_f_completed_on;
                }

                // $history->previous = $lastDocumentOOC->cause_f_completed_by;
                $history->current = $oocchange->cause_f_completed_by . ' , ' . $oocchange->cause_f_completed_on;
                // $history->current = $oocchange->cause_f_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Phase IA HOD Primary Review";
                $history->change_from = $lastDocumentOOC->status;
                $history->action = 'Phase IA Investigation';
                if (is_null($lastDocumentOOC->cause_f_completed_by) || $lastDocumentOOC->cause_f_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }

                $history->stage='Phase IA Investigation';
                $history->save();
                $list = Helpers::getCftUserList($oocchange->division_id); // Notify CFT Person
                        foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $oocchange, 'site' => "OOC", 'history' => "Phase IA Investigation", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $oocchange) {
                                        $message->to($email)
                                        ->subject("Agio Notification: OOC, Record #" . str_pad($oocchange->record, 4, '0', STR_PAD_LEFT) . " - Activity: Phase IA Investigation");
                                    }
                                );
                            }
                        // }
                    }
                // $this->saveAuditTrail($id, $lastDocumentOOC, $oocchange, 'Phase IA Investigation', 'Phase IA HOD Primary Review');
                $oocchange->update();
                toastr()->success('Phase IA HOD Primary Review');
                return redirect()->back();
            }

            if ($oocchange->stage == 5) {

                if (!$oocchange->phase_IA_HODREMARKS) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required! Phase IA HOD Primary Review',
                        'message' => 'Phase IA HOD Remarks is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Phase IA QA Review',
                        'type' => 'success',
                    ]);
                }
                 // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'OOC')
                    ->get();
                        $hasPending4 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done') {
                                $hasPending4 = true;
                                break;
                            }
                        }

                    if ($hasPending4) {
                        // $extensionchildStatus = trim(strtolower($extensionchild->status));
                            Session::flash('swal', [
                                'title' => 'Extension Child Pending!',
                                'message' => 'You cannot proceed until Extension Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Sent for Next Stage',
                            'type' => 'success',
                        ]);
                    }
                
                $oocchange->stage = "7";
                $oocchange->obvious_r_completed_by = Auth::user()->name;
                $oocchange->obvious_r_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->cause_i_ncompleted_comment = $request->comment;
                $oocchange->status = "Phase IA QA Review";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Phase IA HOD Review Complete By   ,  Phase IA HOD Review Complete On';
                // $history->previous = $lastDocumentOOC->obvious_r_completed_by;
                if (is_null($lastDocumentOOC->obvious_r_completed_by) || $lastDocumentOOC->obvious_r_completed_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocumentOOC->obvious_r_completed_by . ' , ' . $lastDocumentOOC->obvious_r_completed_on;
                }
                $history->current = $oocchange->obvious_r_completed_by . ' , ' . $oocchange->obvious_r_completed_on;
                // $history->current = $oocchange->obvious_r_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Phase IA QA Review";
                $history->change_from = $lastDocumentOOC->status;
                $history->action = 'Phase IA HOD Primary Review Complete';
                if (is_null($lastDocumentOOC->obvious_r_completed_by) || $lastDocumentOOC->obvious_r_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Phase IA HOD Primary Review Complete';
                $history->save();
                $list = Helpers::getCftUserList($oocchange->division_id); // Notify CFT Person
                        foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $oocchange, 'site' => "OOC", 'history' => "Phase IA HOD Review Complete", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $oocchange) {
                                        $message->to($email)
                                        ->subject("Agio Notification: OOC, Record #" . str_pad($oocchange->record, 4, '0', STR_PAD_LEFT) . " - Activity: Phase IA HOD Review Complete");
                                    }
                                );
                            }
                        // }
                    }
                  // $this->saveAuditTrail($id, $lastDocumentOOC, $oocchange, 'Obvious Results Not Found', 'Under Stage II B Investigation');
                  $oocchange->update();
                toastr()->success('Phase IA QA Review');
                return back();
            }

            if ($oocchange->stage == 7) {

                if (!$oocchange->qaremarksnewfield) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required! Phase IA QA Review',
                        'message' => 'Phase IA QA Remarks is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for P-IA QAH Review',
                        'type' => 'success',
                    ]);
                }
 
                




                // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'OOC')
                    ->get();
                        $hasPending5 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done') {
                                $hasPending5 = true;
                                break;
                            }
                        }

                    if ($hasPending5) {
                        // $extensionchildStatus = trim(strtolower($extensionchild->status));
                            Session::flash('swal', [
                                'title' => 'Extension Child Pending!',
                                'message' => 'You cannot proceed until Extension Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Sent for Next Stage',
                            'type' => 'success',
                        ]);
                    }
                $oocchange->stage = "8";
                $oocchange->cause_i_completed_by = Auth::user()->name;
                $oocchange->cause_i_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->correction_ooc_comment = $request->comment;
                $oocchange->status = "P-IA QAH Review";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Phase IA QA Review Complete By   ,    Phase IA QA Review Complete On';
                // $history->previous = $lastDocumentOOC->cause_i_completed_by;
                if (is_null($lastDocumentOOC->cause_i_completed_by) || $lastDocumentOOC->cause_i_completed_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocumentOOC->cause_i_completed_by . ' , ' . $lastDocumentOOC->cause_i_completed_on;
                }

                // $history->current = $oocchange->cause_i_completed_by;
                $history->current = $oocchange->cause_i_completed_by . ' , ' . $oocchange->cause_i_completed_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "P-IA QAH Review";
                $history->change_from = $lastDocumentOOC->status;
                $history->action = 'Phase IA QA Review Complete';
                if (is_null($lastDocumentOOC->cause_i_completed_by) || $lastDocumentOOC->cause_i_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Phase IA QA Review Complete';
                $history->save();

                $list = Helpers::getCftUserList($oocchange->division_id); // Notify CFT Person
                        foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $oocchange, 'site' => "OOC", 'history' => "Phase IA QA Review Complete", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $oocchange) {
                                        $message->to($email)
                                        ->subject("Agio Notification: OOC, Record #" . str_pad($oocchange->record, 4, '0', STR_PAD_LEFT) . " - Activity: Phase IA QA Review Complete");
                                    }
                                );
                            }
                        // }
                    }

                // $this->saveAuditTrail($id, $lastDocumentOOC, $oocchange, 'Phase IA QA Review Complete', 'P-IA CQAH/QAH Review');
                $oocchange->update();
                toastr()->success('P-IA QAH Review');
                return back();
            }

            if ($oocchange->stage == 8) {

                if (!$oocchange->qaHremarksnewfield) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required! P-IA QAH Review',
                        'message' => 'P-IA QAH Remarks is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Closed-Done',
                        'type' => 'success',
                    ]);
                }

                 // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'OOC')
                    ->get();
                        $hasPending7 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done') {
                                $hasPending7 = true;
                                break;
                            }
                        }

                    if ($hasPending7) {
                        // $extensionchildStatus = trim(strtolower($extensionchild->status));
                            Session::flash('swal', [
                                'title' => 'Extension Child Pending!',
                                'message' => 'You cannot proceed until Extension Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Sent for Next Stage',
                            'type' => 'success',
                        ]);
                    }
                $oocchange->stage = "9";
                $oocchange->approved_ooc_completed_by = Auth::user()->name;
                $oocchange->approved_ooc_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->approved_ooc_comment = $request->comment;
                $oocchange->status = "Closed-Done";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Assignable Cause Found By     ,    Assignable Cause Found On';
                if (is_null($lastDocumentOOC->approved_ooc_completed_by) || $lastDocumentOOC->approved_ooc_completed_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocumentOOC->approved_ooc_completed_by . ' , ' . $lastDocumentOOC->approved_ooc_completed_on;
                }
                $history->current = $oocchange->approved_ooc_completed_by . ' , ' . $oocchange->approved_ooc_completed_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Closed-Done";
                $history->change_from = $lastDocumentOOC->status;
                $history->action = 'Assignable Cause Found';
                if (is_null($lastDocumentOOC->approved_ooc_completed_by) || $lastDocumentOOC->approved_ooc_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Assignable Cause Found';
                $history->save();
                $list = Helpers::getCftUserList($oocchange->division_id); // Notify CFT Person
                        foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $oocchange, 'site' => "OOC", 'history' => "Assignable Cause Found", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $oocchange) {
                                        $message->to($email)
                                        ->subject("Agio Notification: OOC, Record #" . str_pad($oocchange->record, 4, '0', STR_PAD_LEFT) . " - Activity: Assignable Cause Found");
                                    }
                                );
                            }
                        // }
                    }
                // $this->saveAuditTrail($id, $lastDocumentOOC, $oocchange, 'Assignable Cause Found', 'Closed-Done');
                $oocchange->update();
                toastr()->success('Closed-Done');
                return back();
            }

            if ($oocchange->stage == 10) {

                if (empty($oocchange->is_repeat_stageii_ooc)  || empty($oocchange->compiled_by) || empty($oocchange->justification_for_recalibration) || empty($oocchange->initiated_throug_stageii_ooc) || empty($oocchange->initiated_through_stageii_ooc)|| empty($oocchange->is_repeat_reanalysis_stageii_ooc)|| empty($oocchange->initiated_through_stageii_cause_failure_ooc)|| empty($oocchange->initiated_through_capas_ooc_IB)|| empty($oocchange->initiated_through_capa_prevent_ooc_IB)|| empty($oocchange->phase_ib_investigation_summary) ) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required! Phase IB Investigation',
                        'message' => 'Phase IB Investigation Tab is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Phase IB HOD Primary Review',
                        'type' => 'success',
                    ]);
                }

                // if (!$oocchange->is_repeat_proposed_stage_ooc) {
                //     // Flash message for warning (field not filled)
                //     Session::flash('swal', [
                //         'title' => 'Mandatory Fields Required! Phase IB Investigation',
                //         'message' => 'Proposed By is yet to be filled!',
                //         'type' => 'warning',  // Type can be success, error, warning, info, etc.
                //     ]);

                //     return redirect()->back();
                // } else {
                //     // Flash message for success (when the form is filled correctly)
                //     Session::flash('swal', [
                //         'title' => 'Success!',
                //         'message' => 'Sent for Phase IB HOD Primary Review',
                //         'type' => 'success',
                //     ]);
                // }
                  // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'OOC')
                    ->get();
                        $hasPending8 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done') {
                                $hasPending8 = true;
                                break;
                            }
                        }

                    if ($hasPending8) {
                        // $extensionchildStatus = trim(strtolower($extensionchild->status));
                            Session::flash('swal', [
                                'title' => 'Extension Child Pending!',
                                'message' => 'You cannot proceed until Extension Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Sent for Next Stage',
                            'type' => 'success',
                        ]);
                    }
                $oocchange->stage = "11";
                $oocchange->correction_ooc_completed_by = Auth::user()->name;
                $oocchange->correction_ooc_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->correction_ooc_comment = $request->comment;
                $oocchange->status = "Phase IB HOD Primary Review";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Phase IB Investigation By     ,      Phase IB Investigation On';
                if (is_null($lastDocumentOOC->correction_ooc_completed_by) || $lastDocumentOOC->correction_ooc_completed_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocumentOOC->correction_ooc_completed_by . ' , ' . $lastDocumentOOC->correction_ooc_completed_on;
                }
                $history->current = $oocchange->correction_ooc_completed_by . ' , ' . $oocchange->correction_ooc_completed_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Phase IB HOD Primary Review";
                $history->change_from = $lastDocumentOOC->status;
                $history->action = 'Phase IB Investigation';
                if (is_null($lastDocumentOOC->correction_ooc_completed_by) || $lastDocumentOOC->correction_ooc_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Phase IB Investigation';
                $history->save();

                $list = Helpers::getCftUserList($oocchange->division_id); // Notify CFT Person
                        foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $oocchange, 'site' => "OOC", 'history' => "Phase IB Investigation", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $oocchange) {
                                        $message->to($email)
                                        ->subject("Agio Notification: OOC, Record #" . str_pad($oocchange->record, 4, '0', STR_PAD_LEFT) . " - Activity: Phase IB Investigation");
                                    }
                                );
                            }
                        // }
                    }
                // $this->saveAuditTrail($id, $lastDocumentOOC, $oocchange, 'Phase IB Investigation', 'Phase IB HOD Primary Review');
                $oocchange->update();
                toastr()->success('Phase IB HOD Primary Review');
                return back();
            }

            if ($oocchange->stage == 11) {

                if (!$oocchange->phase_IB_HODREMARKS) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required! Phase IB HOD Primary Review',
                        'message' => 'Phase IB HOD Primary Remarks is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Phase IB QA Review',
                        'type' => 'success',
                    ]);
                }

                // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'OOC')
                    ->get();
                        $hasPending8 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done') {
                                $hasPending8 = true;
                                break;
                            }
                        }

                    if ($hasPending8) {
                        // $extensionchildStatus = trim(strtolower($extensionchild->status));
                            Session::flash('swal', [
                                'title' => 'Extension Child Pending!',
                                'message' => 'You cannot proceed until Extension Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Sent for Next Stage',
                            'type' => 'success',
                        ]);
                    }
                $oocchange->stage = "12";
                $oocchange->Phase_IB_HOD_Review_Completed_BY = Auth::user()->name;
                $oocchange->Phase_IB_HOD_Review_Completed_ON = Carbon::now()->format('d-M-Y');
                $oocchange->Phase_IB_HOD_Review_Completed_Comment = $request->comment;
                $oocchange->status = "Phase IB QA Review";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Phase IB HOD Review Complete By   ,    Phase IB HOD Review Complete On';
                // $history->previous = $lastDocumentOOC->Phase_IB_HOD_Review_Completed_BY;
                if (is_null($lastDocumentOOC->Phase_IB_HOD_Review_Completed_BY) || $lastDocumentOOC->Phase_IB_HOD_Review_Completed_BY === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocumentOOC->Phase_IB_HOD_Review_Completed_BY . ' , ' . $lastDocumentOOC->Phase_IB_HOD_Review_Completed_ON;
                }
                $history->current = $oocchange->Phase_IB_HOD_Review_Completed_BY . ' , ' . $oocchange->Phase_IB_HOD_Review_Completed_ON;
                // $history->current = $oocchange->Phase_IB_HOD_Review_Completed_BY;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Phase IB QA Review";
                $history->change_from = $lastDocumentOOC->status;
                $history->action = 'Phase IB HOD Review Complete';
                if (is_null($lastDocumentOOC->Phase_IB_HOD_Review_Completed_BY) || $lastDocumentOOC->Phase_IB_HOD_Review_Completed_BY === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Phase IB HOD Review Complete';
                $history->save();

                $list = Helpers::getCftUserList($oocchange->division_id); // Notify CFT Person
                        foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $oocchange, 'site' => "OOC", 'history' => "Phase IB HOD Review Complete", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $oocchange) {
                                        $message->to($email)
                                        ->subject("Agio Notification: OOC, Record #" . str_pad($oocchange->record, 4, '0', STR_PAD_LEFT) . " - Activity: Phase IB HOD Review Complete");
                                    }
                                );
                            }
                        // }
                    }
                // $this->saveAuditTrail($id, $lastDocumentOOC, $oocchange, 'Phase IB HOD Review Complete ', 'Phase IB QA Review');
                $oocchange->update();
                toastr()->success('Phase IB QA Review');
                return back();
            }

            if ($oocchange->stage == 12) {

                if (!$oocchange->phase_IB_qareviewREMARKS) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required! Phase IB QA Review',
                        'message' => 'Phase IB QA Remarks is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for P-IB QAH Review',
                        'type' => 'success',
                    ]);
                }
                // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'OOC')
                    ->get();
                        $hasPendin9 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done') {
                                $hasPendin9 = true;
                                break;
                            }
                        }

                    if ($hasPendin9) {
                        // $extensionchildStatus = trim(strtolower($extensionchild->status));
                            Session::flash('swal', [
                                'title' => 'Extension Child Pending!',
                                'message' => 'You cannot proceed until Extension Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Sent for Next Stage',
                            'type' => 'success',
                        ]);
                    }

                $oocchange->stage = "13";
                $oocchange->Phase_IB_QA_Review_Complete_12_by = Auth::user()->name;
                $oocchange->Phase_IB_QA_Review_Complete_12_on = Carbon::now()->format('d-M-Y');
                $oocchange->Phase_IB_QA_Review_Complete_12_comment = $request->comment;
                $oocchange->status = "P-IB QAH Review";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Phase IB QA Review Complete By   , Phase IB QA Review Complete On';
                if (is_null($lastDocumentOOC->Phase_IB_QA_Review_Complete_12_by) || $lastDocumentOOC->Phase_IB_QA_Review_Complete_12_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocumentOOC->Phase_IB_QA_Review_Complete_12_by . ' , ' . $lastDocumentOOC->Phase_IB_QA_Review_Complete_12_on;
                }
                // $history->previous = $lastDocumentOOC->Phase_IB_QA_Review_Complete_12_by;
                $history->current = $oocchange->Phase_IB_QA_Review_Complete_12_by . ' , ' . $oocchange->Phase_IB_QA_Review_Complete_12_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "P-IB QAH Review";
                $history->change_from = $lastDocumentOOC->status;
                $history->action = 'Phase IA HOD Review Complete';
                if (is_null($lastDocumentOOC->Phase_IB_QA_Review_Complete_12_by) || $lastDocumentOOC->Phase_IB_QA_Review_Complete_12_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Phase IA HOD Review Complete';
                $history->save();
                $list = Helpers::getCftUserList($oocchange->division_id); // Notify CFT Person
                        foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $oocchange, 'site' => "OOC", 'history' => "Phase IB QA Review Complete", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $oocchange) {
                                        $message->to($email)
                                        ->subject("Agio Notification: OOC, Record #" . str_pad($oocchange->record, 4, '0', STR_PAD_LEFT) . " - Activity: Phase IB QA Review Complete");
                                    }
                                );
                            }
                        // }
                    }
                // $this->saveAuditTrail($id, $lastDocumentOOC, $oocchange, 'Phase IB QA Review Complete', 'P-IB CQAH/QAH Review');
                $oocchange->update();
                toastr()->success('P-IB QAH Review');
                return back();
            }
            if ($oocchange->stage == 13) {

                if (empty($oocchange->qPIBaHremarksnewfield) || empty($oocchange->is_repeat_realease_stageii_ooc)) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required! P-IB QAH Review',
                        'message' => 'P-IB QAH Review Tab is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Closed Done',
                        'type' => 'success',
                    ]);
                }

                   // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'OOC')
                    ->get();
                        $hasPendin10 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done') {
                                $hasPendin10 = true;
                                break;
                            }
                        }

                    if ($hasPendin10) {
                        // $extensionchildStatus = trim(strtolower($extensionchild->status));
                            Session::flash('swal', [
                                'title' => 'Extension Child Pending!',
                                'message' => 'You cannot proceed until Extension Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Sent for Next Stage',
                            'type' => 'success',
                        ]);
                    }
                $oocchange->stage = "14";
                $oocchange->P_IB_Assignable_Cause_Found_by = Auth::user()->name;
                $oocchange->P_IB_Assignable_Cause_Found_on = Carbon::now()->format('d-M-Y');
                $oocchange->P_IB_Assignable_Cause_Found_comment = $request->comment;
                $oocchange->status = "Closed Done";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Approved By  ,  Approved On';
                if (is_null($lastDocumentOOC->P_IB_Assignable_Cause_Found_by) || $lastDocumentOOC->P_IB_Assignable_Cause_Found_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocumentOOC->P_IB_Assignable_Cause_Found_by . ' , ' . $lastDocumentOOC->Phase_IB_QA_Review_Complete_12_on;
                }
                $history->current = $oocchange->P_IB_Assignable_Cause_Found_by . ' , ' . $oocchange->P_IB_Assignable_Cause_Found_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Closed Done";
                $history->change_from = $lastDocumentOOC->status;
                $history->action = 'Approved';
                if (is_null($lastDocumentOOC->P_IB_Assignable_Cause_Found_by) || $lastDocumentOOC->P_IB_Assignable_Cause_Found_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->stage='Approved';
                $history->save();
                $list = Helpers::getCftUserList($oocchange->division_id); // Notify CFT Person
                        foreach ($list as $u) {
                        // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $oocchange, 'site' => "OOC", 'history' => "Approved", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $oocchange) {
                                        $message->to($email)
                                        ->subject("Agio Notification: OOC, Record #" . str_pad($oocchange->record, 4, '0', STR_PAD_LEFT) . " - Activity: Approved");
                                    }
                                );
                            }
                        // }
                    }
                // $this->saveAuditTrail($id, $lastDocumentOOC, $oocchange, 'P-IB Assignable Cause Found', 'Closed Done');
                $oocchange->update();
                toastr()->success('Closed Done');
                return back();
            }


        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function OOCStateChangetwo(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $oocchange = OutOfCalibration::find($id);
            $lastDocumentOOC = OutOfCalibration::find($id);

            if ($oocchange->stage == 8) {

                if (!$oocchange->qaHremarksnewfield) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required! P-IA QAH Review',
                        'message' => 'P-IA QAH Remarks is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Under Phase-IB Investigation',
                        'type' => 'success',
                    ]);
                }

                // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'OOC')
                    ->get();
                        $hasPending6 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done') {
                                $hasPending6 = true;
                                break;
                            }
                        }

                    if ($hasPending6) {
                        // $extensionchildStatus = trim(strtolower($extensionchild->status));
                            Session::flash('swal', [
                                'title' => 'Extension Child Pending!',
                                'message' => 'You cannot proceed until Extension Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Sent for Next Stage',
                            'type' => 'success',
                        ]);
                    }
                $oocchange->stage = "10";
                $oocchange->correction_r_completed_by = Auth::user()->name;
                $oocchange->correction_r_completed_on = Carbon::now()->format('d-M-Y');
                $oocchange->correction_r_ncompleted_comment = $request->comment;
                $oocchange->status = "Under Phase-IB Investigation";
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'Assignable Cause Not Found By  ,   Assignable Cause Not Found On';
                if (is_null($lastDocumentOOC->correction_r_completed_by) || $lastDocumentOOC->correction_r_completed_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocumentOOC->correction_r_completed_by . ' , ' . $lastDocumentOOC->correction_r_completed_on;
                }

                $history->current = $oocchange->correction_r_completed_by . ' , ' . $oocchange->correction_r_completed_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Under Phase-IB Investigation";
                $history->change_from = $lastDocumentOOC->status;
                // $history->action_name = 'Assignable Cause Not Found';
                $history->action = 'Assignable Cause Not Found';
                $history->stage='Assignable Cause Not Found';
                if (is_null($lastDocumentOOC->correction_r_completed_by) || $lastDocumentOOC->correction_r_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }

                $history->save();

                $list = Helpers::getCftUserList($oocchange->division_id); // Notify CFT Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $oocchange, 'site' => "OOC", 'history' => "Assignable Cause Not Found", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $oocchange) {
                                    $message->to($email)
                                    ->subject("Agio Notification: OOC, Record #" . str_pad($oocchange->record, 4, '0', STR_PAD_LEFT) . " - Activity: Assignable Cause Not Found");
                                }
                            );
                        }
                    // }
                }

                $oocchange->update();
                toastr()->success('Under Phase-IB Investigation');
                return back();
            }


        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function RejectStateChangeTwo(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $ooc = OutOfCalibration::find($id);
            $lastDocumentOOC = OutOfCalibration::find($id);

            if ($ooc->stage == 23)
            {
                $ooc->stage = "4";
                $ooc->status = "Phase II B QA Review ";
                $ooc->new_stage_reject_by = Auth::user()->name;
                $ooc->new_stage_reject_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_reject_comment = $request->comment;
                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                $history->activity_type = 'P-II A Assignable Cause Not Found By  ,   P-II A Assignable Cause Not Found On';
                if (is_null($lastDocumentOOC->new_stage_reject_by) || $lastDocumentOOC->new_stage_reject_by === '') {
                    $history->previous = "Null";
                } else {
                    $history->previous = $lastDocumentOOC->new_stage_reject_by . ' , ' . $lastDocumentOOC->new_stage_reject_on;
                }
                $history->current = $ooc->new_stage_reject_by . ' , ' . $ooc->new_stage_reject_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocumentOOC->status;
                $history->change_to = "Under Phase-II B Investigation";
                $history->change_from = $lastDocumentOOC->status;
                $history->action = 'P-II A Assignable Cause Not Found';
                $history->stage='P-II A Assignable Cause Not Found';
                if (is_null($lastDocumentOOC->new_stage_reject_by) || $lastDocumentOOC->new_stage_reject_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                $list = Helpers::getCftUserList($oocchange->division_id); // Notify CFT Person
                foreach ($list as $u)
               {
             // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                $email = Helpers::getUserEmail($u->user_id);
                    if ($email !== null)
                    {
                        Mail::send(
                            'mail.view-mail',
                            ['data' => $oocchange, 'site' => "OOC", 'history' => "P-II A Assignable Cause Not Found", 'process' => 'OOC', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                            function ($message) use ($email, $oocchange) {
                                $message->to($email)
                                ->subject("Agio Notification: OOC, Record #" . str_pad($oocchange->record, 4, '0', STR_PAD_LEFT) . " - Activity: P-II A Assignable Cause Not Found");
                            }
                        );
                    }
              // }
                }
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }

        }

    }

    public function RejectoocStateChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password))
         {
            $ooc = OutOfCalibration::find($id);
          
            $lastDocument = OutOfCalibration::find($id);
           

            if ($ooc->stage == 2) {
                $ooc->stage = "1";
                $ooc->status = "Opened";
                $ooc->new_stage_reject_HOD_by = Auth::user()->name;
                $ooc->new_stage_reject_HOD_on  = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_reject_HOD_comment = $request->comment;

                $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                     foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $ooc) {
                                    $message->to($email)
                                    ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                                }
                            );
                        }
                    // }
                }

                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Opened";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($ooc->stage == 3) {
                $ooc->stage = "2";
                $ooc->status = "HOD Primary Review";
                $ooc->stagethird_more_by = Auth::user()->name;
                $ooc->stagethird_more_on = Carbon::now()->format('d-M-Y');
                $ooc->stagethird_more_comment = $request->comment;

                $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $ooc) {
                                    $message->to($email)
                                    ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                                }
                            );
                        }
                    // }
                }

                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "HOD Primary Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ooc->stage == 4) {
                $ooc->stage = "3";
                $ooc->status = "QA Head Primary Review";
                $ooc->new_stage_reject_CQA_by = Auth::user()->name;
                $ooc->new_stage_reject__CQA_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_reject_CQA_comment = $request->comment;

                $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $ooc, 'site' => "OOC", 'history' => "Request More Info", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $ooc) {
                                    $message->to($email)
                                    ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: Request More Info");
                                }
                            );
                        }
                    // }
                }

                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "QA Head Primary Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();



                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ooc->stage == 5) {
                $ooc->stage = "4";
                $ooc->status = "Under Phase-IA Investigation";
                $ooc->new_stage_reject_UnderPhaseIA_by = Auth::user()->name;
                $ooc->new_stage_reject_UnderPhaseIA_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_reject_UnderPhaseIA_comment = $request->comment;

                $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $ooc) {
                                    $message->to($email)
                                    ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                                }
                            );
                        }
                    // }
                }

                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Under Phase-IA Investigation";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ooc->stage == 7) {
                $ooc->stage = "5";
                $ooc->status = "Phase IA HOD Primary Review";
                $ooc->new_stage_reject_Phase_IA_HOD_Primary_Review_by = Auth::user()->name;
                $ooc->new_stage_reject_Phase_IA_HOD_Primary_Review_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_reject_Phase_IA_HOD_Primary_Review_comment = $request->comment;

                $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $ooc) {
                                    $message->to($email)
                                    ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                                }
                            );
                        }
                    // }
                }

                $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Phase IA HOD Primary Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ooc->stage == 8) {
                $ooc->stage = "7";
                $ooc->status = "Phase IA QA Review";
                $ooc->new_stage_rejectUnder_Stage_II_B_Investigation_by = Auth::user()->name;
                $ooc->new_stage_rejectUnder_Stage_II_B_Investigation_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_rejectUnder_Stage_II_B_Investigation_comment = $request->comment;

                $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $ooc) {
                                    $message->to($email)
                                    ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                                }
                            );
                        }
                    // }
                }

                 $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Phase IA QA Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ooc->stage == 10) {
                $ooc->stage = "8";
                $ooc->status = "P-IA QAH Review";
                $ooc->new_stage_rejectP_IA_CQAH_QAH_Reviewation_by = Auth::user()->name;
                $ooc->new_stage_rejectP_IA_CQAH_QAH_Reviewation_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_rejectP_IA_CQAH_QAH_Review_comment = $request->comment;

                $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $ooc) {
                                    $message->to($email)
                                    ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                                }
                            );
                        }
                    // }
                }


                 $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "P-IA QAH Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ooc->stage == 11) {
                $ooc->stage = "10";
                $ooc->status = "Under Phase-IB Investigation";
                $ooc->new_stage_rejectUnder_Phase_IB_Investigation_by = Auth::user()->name;
                $ooc->new_stage_rejectUnder_Phase_IB_Investigation_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_rejectUnder_Phase_IB_Investigation_comment = $request->comment;

                $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $ooc) {
                                    $message->to($email)
                                    ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                                }
                            );
                        }
                    // }
                }

                 $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Under Phase-IB Investigation";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ooc->stage == 12) {
                $ooc->stage = "11";
                $ooc->status = "Phase IB HOD Primary Review";
                $ooc->new_stage_rejectPhase_IB_HOD_Primary_Review_by = Auth::user()->name;
                $ooc->new_stage_rejectPhase_IB_HOD_Primary_Review_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_rejectPhase_IB_HOD_Primary_Reviewcomment = $request->comment;

                $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $ooc) {
                                    $message->to($email)
                                    ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                                }
                            );
                        }
                    // }
                }

                
                 $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Phase IB HOD Primary Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();

                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ooc->stage == 13) {
                $ooc->stage = "12";
                $ooc->status = "Phase IB QA Review";
                $ooc->new_stage_rejectPhase_IB_QA_Review_by = Auth::user()->name;
                $ooc->new_stage_rejectPhase_IB_QA_Review_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_rejectPhase_IB_QA_Review_comment = $request->comment;

                $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $ooc) {
                                    $message->to($email)
                                    ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                                }
                            );
                        }
                    // }
                }

                  $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Phase IB QA Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($ooc->stage == 15)
            {
                $ooc->stage = "13";
                $ooc->status = "P-IB QAH Review";
                $ooc->new_stage_rejectP_IA_CQAH_QAH_Reviewation_by = Auth::user()->name;
                $ooc->new_stage_rejectP_IA_CQAH_QAH_Reviewation_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_rejectP_IA_CQAH_QAH_Review_comment = $request->comment;

                $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $ooc) {
                                    $message->to($email)
                                    ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                                }
                            );
                        }
                    // }
                }

                  $history = new OOCAuditTrail();
                $history->ooc_id = $id;
                
                $history->activity_type = 'Not Applicable';
                $history->previous = 'Not Applicable';
                $history->action_name = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->current = 'Not Applicable';
                $history->action = 'More Info Required';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "P-IB QAH Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Plan Proposed';
                $history->save();
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ooc->stage == 16) {
                $ooc->stage = "15";
                $ooc->status = "Under Phase-II A Investigation";
                $ooc->new_stage_rejectUnder_Phase_II_A_Investigation_by = Auth::user()->name;
                $ooc->new_stage_rejectUnder_Phase_II_A_Investigation_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_rejectUnder_Phase_II_A_Investigation_comment = $request->comment;

                $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $ooc) {
                                    $message->to($email)
                                    ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                                }
                            );
                        }
                    // }
                }
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ooc->stage == 17) {
                $ooc->stage = "16";
                $ooc->status = "Phase II A HOD Primary Review";
                $ooc->new_stage_rejectUnder_Phase_II_A_HOD17Investigation_by = Auth::user()->name;
                $ooc->new_stage_rejectUnder_Phase_II_A_HOD17Investigation_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_rejectUnder_Phase_II_A_HOD17Investigation_comment = $request->comment;

                $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            Mail::send(
                                'mail.view-mail',
                                ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                function ($message) use ($email, $ooc) {
                                    $message->to($email)
                                    ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                                }
                            );
                        }
                    // }
                }
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($ooc->stage == 18) {
                $ooc->stage = "17";
                $ooc->status = "Phase IA QA Review";
                $ooc->new_stage_rejectUnder_Phase_IA_HOD18Investigation_by = Auth::user()->name;
                $ooc->new_stage_rejectUnder_Phase_IA_HOD18Investigation_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_rejectUnder_Phase_IA_HOD18Investigation_comment = $request->comment;

                // $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $ooc) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                 }
                //             );
                //         }
                //     // }
                // }
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ooc->stage == 20) {
                $ooc->stage = "18";
                $ooc->status = "P-II A QAH/CQAH Review";
                $ooc->new_stage_reject_P_II_A_QAH_CQAH_Review_by = Auth::user()->name;
                $ooc->new_stage_reject_P_II_A_QAH_CQAH_Review_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_reject_P_II_A_QAH_CQAH_Review_comment = $request->comment;

                // $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $ooc) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                 }
                //             );
                //         }
                //     // }
                // }
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($ooc->stage == 21) {
                $ooc->stage = "20";
                $ooc->status = "Under Phase-II B Investigation";
                $ooc->new_stage_rejectUnder_Phase_II_B_Investigation_by = Auth::user()->name;
                $ooc->new_stage_rejectUnder_Phase_II_B_Investigation_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_rejectUnder_Phase_II_B_Investigation_comment = $request->comment;

                // $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $ooc) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                 }
                //             );
                //         }
                //     // }
                // }
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($ooc->stage == 22) {
                $ooc->stage = "21";
                $ooc->status = "Phase II B HOD Primary Review";
                $ooc->new_stage_rejectUnder_Phase_II_B_HOD_Primary_Review_by = Auth::user()->name;
                $ooc->new_stage_rejectUnder_Phase_II_B_HOD_Primary_Review_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_rejectUnder_Phase_II_B_HOD_Primary_Review_comment = $request->comment;

                // $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $ooc) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                 }
                //             );
                //         }
                //     // }
                // }
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($ooc->stage == 23) {
                $ooc->stage = "22";
                $ooc->status = "Phase II B QA Review ";
                $ooc->new_stage_reject_by = Auth::user()->name;
                $ooc->new_stage_reject_on = Carbon::now()->format('d-M-Y');
                $ooc->new_stage_reject_comment = $request->comment;

                // $list = Helpers::getCftUserList($ooc->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //     // if($u->q_m_s_divisions_id == $extensionNew->division_id){
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $ooc, 'site' => "OOC", 'history' => "More Information Required", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $ooc) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: OOC, Record #" . str_pad($ooc->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                 }
                //             );
                //         }
                //     // }
                // }
                $ooc->update();
                toastr()->success('Document Sent');
                return back();
            }

        }
         else {
            toastr()->error('E-signature Not match');
            return back();
         }
    }






    public function OOCAuditTrial($id){
        $auditrecord = OutOfCalibration::find($id);
        $audit = OOCAuditTrail::where('ooc_id',$id)->orderByDesc('id')->paginate();
        $today = Carbon::now()->format('d-m-y');
        $document = OOCAuditTrail::where('ooc_id',$id)->first();
        $auditrecord->initiator = User::where('id',$auditrecord->initiator_id)->value('name');
        // return $document;
        return view('frontend.OOC.audit-trail',compact('audit','document','today','auditrecord'));


    }

    public function OOCAuditReview(Request $request, $id){
        $history = new AuditReviewersDetails;
        $history->doc_id = $id;
        $history->user_id = Auth::user()->id;
        $history->type = $request->type;
        $history->reviewer_comment = $request->reviewer_comment;
        $history->reviewer_comment_by = Auth::user()->name;
        $history->reviewer_comment_on = Carbon::now()->toDateString();
        $history->save();
        return redirect()->back();
    }

    public function OOCStateCancel(Request $request , $id){
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $ooc = OutOfCalibration::find($id);
            $lastDocumentOOC = OutOfCalibration::find($id);
            $oocchange = OutOfCalibration::find($id);

            $ooc->stage = "0";
            $ooc->status = "Closed - Cancelled";
            $ooc->cancelled_by = Auth::user()->name;
            $ooc->cancelled_on = Carbon::now()->format('d-M-Y');
            $ooc->cancell_comment =$request->comment;

            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Cancel By  ,   Cancel On';
            if (is_null($lastDocumentOOC->cancelled_by) || $lastDocumentOOC->cancelled_by === '') {
                    $history->previous = "Null";
            } else {
                    $history->previous = $lastDocumentOOC->cancelled_by . ' , ' . $lastDocumentOOC->cancelled_on;
            }
            $history->current = $ooc->cancelled_by . ' , ' . $ooc->cancelled_on;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOOC->status;
            $history->change_to = "Closed - Cancelled";
            $history->change_from = $lastDocumentOOC->status;
            $history->action = 'Cancel';
            $history->stage = 'Cancel';
            if (is_null($lastDocumentOOC->cancelled_by) || $lastDocumentOOC->cancelled_by === '') {
                    $history->action_name = 'New';
            } else {
                    $history->action_name = 'Update';
            }
            $history->save();

            $list = Helpers::getCftUserList($oocchange->division_id); // Notify CFT Person
            foreach ($list as $u)
            {
                // if($u->q_m_s_divisions_id == $extensionNew->division_id){
              $email = Helpers::getUserEmail($u->user_id);
                    if ($email !== null)
                    {
                        Mail::send(
                            'mail.view-mail',
                            ['data' => $oocchange, 'site' => "OOC", 'history' => "Cancel", 'process' => 'OOC', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                            function ($message) use ($email, $oocchange) {
                                $message->to($email)
                                ->subject("Agio Notification: OOC, Record #" . str_pad($oocchange->record, 4, '0', STR_PAD_LEFT) . " - Activity: Cancel");
                            }
                        );
                    }
               // }
            }
            $ooc->update();
            toastr()->success('Document Sent');
            return back();




            $ooc->stage = "9";
            $ooc->status = "Closed - Cancelled";
            $ooc->approved_ooc_completed_by = Auth::user()->name;
            $ooc->approved_ooc_completed_on = Carbon::now()->format('d-M-Y');
            $ooc->approved_ooc_comment ='Not Applicable';
            $ooc->update();
            $history = new OOCAuditTrail();
            $history->ooc_id = $id;
            $history->activity_type = 'Assignable Cause Found By     ,    Assignable Cause Found On';
            if (is_null($lastDocumentOOC->approved_ooc_completed_by) || $lastDocumentOOC->approved_ooc_completed_by === '') {
                $history->previous = "Null";
            } else {
                $history->previous = $lastDocumentOOC->approved_ooc_completed_by . ' , ' . $lastDocumentOOC->approved_ooc_completed_on;
            }
            $history->current = $oocchange->approved_ooc_completed_by . ' , ' . $oocchange->approved_ooc_completed_on;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocumentOOC->status;
            $history->change_to = "Closed-Done";
            $history->change_from = $lastDocumentOOC->status;
            $history->action = 'Assignable Cause Found';
            if (is_null($lastDocumentOOC->approved_ooc_completed_by) || $lastDocumentOOC->approved_ooc_completed_by === '') {
                $history->action_name = 'New';
            } else {
                $history->action_name = 'Update';
            }
            $history->stage='Assignable Cause Found';
            $history->save();

            toastr()->success('Closed Done');
            return back();



        } else {
            toastr()->error('E-signature Not match');
            return back();
        }

    }
    public function OOCChildRoot(Request $request ,$id)
    {
               $cc = OutOfCalibration::find($id);
               $cft = [];
               $parent_id = $id;
               $parent_type = "OOC";
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
               $parent_division_id = OutOfCalibration::where('id', $id)->value('division_id');
              
               $formattedDate = $currentDate->addDays(30);
               $due_date = $formattedDate->format('d-M-Y');
               $oocOpen = OpenStage::find(1);
               if (!empty($oocOpen->cft)) $cft = explode(',', $oocOpen->cft);


               if ($request->revision == "capa-child") {
                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                $record = $record_number;
                $old_records = $old_record;
                $relatedRecords = Helpers::getAllRelatedRecords();
                $Capachild = OutOfCalibration::find($id);
                $reference_record = Helpers::getDivisionName($Capachild->division_id ) . '/' . 'OOC' .'/' . date('Y') .'/' . str_pad($Capachild->record, 4, '0', STR_PAD_LEFT);
                return view('frontend.forms.capa', compact('record','record_number', 'due_date', 'parent_id', 'parent_type', 'old_records', 'cft','relatedRecords','reference_record'));
                }

               if ($request->revision == "Action-Item") {
                   $p_record = OutOfCalibration::find($id);
                   $data_record = Helpers::getDivisionName($p_record->division_id ) . '/' . 'OOC' .'/' . date('Y') .'/' . str_pad($p_record->record, 4, '0', STR_PAD_LEFT);
                    //dd($data_record);
                    $data = new \stdClass();   // Create an empty object
                    $data->due_date = $p_record->due_date;  // Assuming $p_record has a due_date field

                   $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                   $parentRecord = OutOfCalibration::where('id', $id)->value('record');

                   return view('frontend.action-item.action-item', compact('record_number','parentRecord', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id','record','old_record', 'data_record','data','parent_division_id'));
               }
               if ($request->revision == "Root-Cause-Analysis") {
                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                return view('frontend.forms.root-cause-analysis', compact('record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));

            }
            if ($request->revision == "Resampling") {
                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                $relatedRecords = Helpers::getAllRelatedRecords();
                return view('frontend.resampling.resapling_create', compact('record', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id','relatedRecords'));
           }

           if ($request->revision == "Extension") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            $relatedRecords = Helpers::getAllRelatedRecords();
            $data=OutOfCalibration::find($id);
            $extension_record = Helpers::getDivisionName($data->division_id ) . '/' . 'OOC' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
            $count = Helpers::getChildData($id, $parent_type);
            $countData = $count + 1;

          
           
            $parent_due_date =  OutOfCalibration::where('id',$id)->value('due_date');
            if ($request->due_date) {
               $parent_due_date = $request->due_date;
             }
            return view('frontend.extension.extension_new', compact('record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id','relatedRecords', 'extension_record','countData','parent_division_id','parent_due_date'));

        }

        }

    public function oo_c_capa_child(Request $request ,$id)
    {
        $cc = OutOfCalibration::find($id);
               $cft = [];
               $parent_id = $id;
               $parent_type = "OOC";
               $currentDate = Carbon::now();
               $formattedDate = $currentDate->addDays(30);
               $relatedRecords = Helpers::getAllRelatedRecords();
               $due_date= $formattedDate->format('d-M-Y');
               $old_record = Capa::select('id', 'division_id', 'record')->get();
               $record_number = ((RecordNumber::first()->value('counter')) + 1);
               $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
               $record = ((RecordNumber::first()->value('counter')) + 1);
               $record = str_pad($record, 4, '0', STR_PAD_LEFT);
               $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
               $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
               $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
               $parent_division_id = OutOfCalibration::where('id', $id)->value('division_id');
          
               $parent_initiator_id = $id;



               $formattedDate = $currentDate->addDays(30);
               $due_date = $formattedDate->format('d-M-Y');
               $oocOpen = OpenStage::find(1);
               if (!empty($oocOpen->cft)) $cft = explode(',', $oocOpen->cft);

            //    if ($request->revision == "Action-child") {
            //     $p_record = OutOfCalibration::find($id);
            //     $data_record = Helpers::getDivisionName($p_record->division_id ) . '/' . 'OOC' .'/' . date('Y') .'/' . str_pad($p_record->record, 4, '0', STR_PAD_LEFT);
            //  //    dd($data_record);

            //     $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            //     $parentRecord = OutOfCalibration::where('id', $id)->value('record');


            //     return view('frontend.action-item.action-item', compact('record_number','parentRecord', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id','record','old_record', 'data_record'));
            // }


             if ($request->revision == "Action-child") {
                    $parent_due_date = "";
                    $parent_name = $request->parent_name;
                    if ($request->due_date) {
                       $parent_due_date = $request->due_date;
                     }

                $p_record = OutOfCalibration::find($id);
                $data_record = Helpers::getDivisionName($p_record->division_id ) . '/' . 'OOC' .'/' . date('Y') .'/' . str_pad($p_record->record, 4, '0', STR_PAD_LEFT);

                $data = new \stdClass();   // Create an empty object
                $data->due_date = $p_record->due_date;  // Assuming $p_record has a due_date field

                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                $parentRecord = OutOfCalibration::where('id', $id)->value('record');
                return view('frontend.action-item.action-item', compact('record','record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id','old_record','parentRecord','data_record','data',));

            }

               if ($request->revision == "risk-Item") {
                   $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                   return view('frontend.forms.risk-management', compact('record_number', 'due_date', 'parent_id','old_record', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));

               }
               if ($request->revision == "CAPA") {
                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                $record_number = $record_number;
                $old_records = $old_record;
                $Capachild = OutOfCalibration::find($id);
                $reference_record = Helpers::getDivisionName($Capachild->division_id ) . '/' . 'OOC' .'/' . date('Y') .'/' . str_pad($Capachild->record, 4, '0', STR_PAD_LEFT);
                return view('frontend.forms.capa', compact('record_number', 'due_date', 'parent_id', 'parent_type', 'old_records', 'cft','relatedRecords','reference_record'));
                }
               if ($request->revision == "Extension") {
                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                $relatedRecords = Helpers::getAllRelatedRecords();
                $data=OutOfCalibration::find($id);
                $extension_record = Helpers::getDivisionName($data->division_id ) . '/' . 'OOC' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
                $count = Helpers::getChildData($id, $parent_type);
                $countData = $count + 1;
                $parent_due_date =  OutOfCalibration::where('id',$id)->value('due_date');
                if ($request->due_date) {
                   $parent_due_date = $request->due_date;
                 }
                
                return view('frontend.extension.extension_new', compact('record_number','extension_record', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id','relatedRecords','countData','parent_division_id','parent_due_date'));

            }
    }
    public function OOCChildExtension(Request $request ,$id)
    {
        $cc = OutOfCalibration::find($id);
               $cft = [];
               $parent_id = $id;
               $parent_type = "OOC";
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
               $parent_division_id = OutOfCalibration::where('id', $id)->value('division_id');
              

               $formattedDate = $currentDate->addDays(30);
               $due_date = $formattedDate->format('d-M-Y');
               $oocOpen = OpenStage::find(1);
               if (!empty($oocOpen->cft)) $cft = explode(',', $oocOpen->cft);

                if ($request->revision == "Extension") {
                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                $relatedRecords = Helpers::getAllRelatedRecords();
                $data=OutOfCalibration::find($id);
                $extension_record = Helpers::getDivisionName($data->division_id ) . '/' . 'OOC' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
                $count = Helpers::getChildData($id, $parent_type);
                $countData = $count + 1;
                $parent_due_date =  OutOfCalibration::where('id',$id)->value('due_date');
                if ($request->due_date) {
                   $parent_due_date = $request->due_date;
                 }
                return view('frontend.extension.extension_new', compact('record_number', 'extension_record', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id','relatedRecords','countData','parent_division_id','parent_due_date'));

            }
    }
    public function OOCChildAction(Request $request ,$id)
    {
        $cc = OutOfCalibration::find($id);
               $cft = [];
               $parent_id = $id;
               $parent_type = "OOC";
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
               $parent_division_id = OutOfCalibration::where('id', $id)->value('division_id');
               $parent_initiator_id = $id;


               $formattedDate = $currentDate->addDays(30);
               $due_date = $formattedDate->format('d-M-Y');
               $oocOpen = OpenStage::find(1);
               if (!empty($oocOpen->cft)) $cft = explode(',', $oocOpen->cft);

                if ($request->revision == "Extension") {
                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                $relatedRecords = Helpers::getAllRelatedRecords();
                $data=OutOfCalibration::find($id);
                $extension_record = Helpers::getDivisionName($data->division_id ) . '/' . 'OOC' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
                $count = Helpers::getChildData($id, $parent_type);
                $countData = $count + 1;

                 $parent_due_date = "";
                $parent_name = $request->parent_name;
                if ($request->due_date) {
               $parent_due_date = $request->due_date;
                                         }

                return view('frontend.extension.extension_new', compact('record_number', 'extension_record', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id','relatedRecords','countData','parent_division_id','parent_due_date'));

            }
            if ($request->revision == "Action-child") {
                $parent_due_date = "";
                $parent_name = $request->parent_name;
                if ($request->due_date) {
               $parent_due_date = $request->due_date;
                                         }

            $p_record = OutOfCalibration::find($id);
            $data_record = Helpers::getDivisionName($p_record->division_id ) . '/' . 'OOC' .'/' . date('Y') .'/' . str_pad($p_record->record, 4, '0', STR_PAD_LEFT);
            $parentRecord = OutOfCalibration::where('id', $id)->value('record');
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');

            $data = new \stdClass();   // Create an empty object
            $data->due_date = $p_record->due_date;  // Assuming $p_record has a due_date field

            return view('frontend.action-item.action-item', compact('record','record_number','old_record', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id','data_record','data','parent_division_id'));

        }
    }

    public function auditDetailsooc($id){

        $detail = OOCAuditTrail::find($id);

        $detail_data = OOCAuditTrail::where('activity_type', $detail->activity_type)->where('ooc_id', $detail->ooc_id)->latest()->get();

        $doc = OOCAuditTrail::where('id', $detail->ooc_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);

        return view('frontend.OOC.audit-trial-inner', compact('detail', 'doc', 'detail_data'));


    }
    public function auditReportooc($id)
    {
        $doc = OutOfCalibration::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $audit = OOCAuditTrail::where('ooc_id', $id)->paginate(500);

            $data = OOCAuditTrail::where('ooc_id', $id)->get();

            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.OOC.auditReport', compact('data', 'doc','audit'))
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
            $canvas->page_text($width / 4, $height / 2, $doc->status, null, 25, [0, 0, 0], 2, 6, -20);
            return $pdf->stream('OOC-AuditTrial' . $id . '.pdf');
        }

    }



    public function singleReports(Request $request, $id){
        $ooc = OutOfCalibration::where('id', $id)->first();
        $ooc->record = str_pad($ooc->record, 4, '0', STR_PAD_LEFT);
        $ooc->assign_to_name = User::where('id', $ooc->assign_id)->value('name');
        $ooc->initiator_name = User::where('id', $ooc->initiator_id)->value('name');
        $data = OutOfCalibration::find($id);
        $oocgrid = OOC_Grid::where('ooc_id',$id)->first();
        $oocevolution = OOC_Grid::where(['ooc_id'=>$id, 'identifier'=>'OOC Evaluation'])->first();
        $assignedTo = OutOfCalibration::with('assignedUser')->get();

        if (!empty($data)) {

            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.OOC.ooc_singleReport', compact('data','oocgrid','oocevolution','ooc','assignedTo'))
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
            return $pdf->stream('OOC' . $id . '.pdf');
        }
    }

}
