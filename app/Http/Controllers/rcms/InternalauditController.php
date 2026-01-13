<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\RecordNumber;
use App\Models\InternalAuditorGrid;
use App\Models\RootAuditTrial;
use Illuminate\Http\Request;
use App\Models\InternalAudit;
use App\Models\{InternalAuditTrial,IA_checklist_tablet_compression,IA_checklist_tablet_coating,Checklist_Capsule, IA_checklist__formulation_research, IA_checklist_analytical_research, IA_checklist_dispensing, IA_checklist_engineering, IA_checklist_hr, IA_checklist_manufacturing_filling, IA_checklist_production_injection, IA_checklist_stores, IA_dispencing_manufacturing, IA_liquid_ointment, IA_ointment_paking, IA_quality_control, InternalAuditChecklistGrid};
use App\Models\{IA_checklist_capsule_paking};
use App\Models\RoleGroup;
use App\Models\AuditReviewersDetails;
use App\Models\InternalAuditGrid;
use App\Models\InternalAuditStageHistory;
use App\Models\InternalAuditObservationGrid;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\extension_new;
use App\Models\Observation;
use App\Models\ActionItem;
use App\Models\RootCauseAnalysis;
use App\Models\Capa;
use App\Models\InternalAuditResponse;
use App\Models\IA_checklist_compression;
use PDF;
use Helpers;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InternalauditController extends Controller
{
    public function internal_audit()
    {
        $old_record = InternalAudit::select('id', 'division_id', 'record')->get();
    //    $record_number = ((RecordNumber::first()->value('counter')) + 1);
        //  $lasteffectivness = InternalAudit::orderBy('record', 'desc')->first();
        // $record_number = $lasteffectivness ? ((int)$lasteffectivness->record + 1) : 1;  
        // $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        // return $old_record;

        return view("frontend.forms.audit", compact('due_date',  'old_record'));

    }
    public function create(request $request)
    {
        // return "breaking";

        $lastIA = InternalAudit::orderBy('record', 'desc')->first();

        $record = $lastIA ? (int) $lastIA->record + 1 : 1;

         $lastIA = InternalAudit::orderBy('record_number', 'desc')->first();

        $record_number = $lastIA
                ? (int) $lastIA->record_number + 1
                : 1;
    // 
    //    $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);

       $internalAudit = new InternalAudit();
        $internalAudit->form_type = "Internal-audit";
        $internalAudit->record = $record;
       $internalAudit->record_number = $record_number;
        $internalAudit->initiator_id = Auth::user()->id;
        $internalAudit->division_id = $request->division_id;
        // dd($internalAudit);
        $internalAudit->external_agencies = $request->external_agencies;
       // $internalAudit->severity_level = $request->severity_level_select;
        $internalAudit->severity_level_form = $request->severity_level_form;
        $internalAudit->division_code = $request->division_code;
        $internalAudit->parent_id = $request->parent_id;
        $internalAudit->parent_type = $request->parent_type;
        $internalAudit->intiation_date = $request->intiation_date;
        $internalAudit->assign_to = $request->assign_to;
        // dd($internalAudit->assign_to);
        $internalAudit->due_date = $request->due_date;
        // dd($internalAudit->due_date);
        $internalAudit->audit_schedule_start_date= $request->audit_schedule_start_date;
        $internalAudit->audit_schedule_end_date= $request->audit_schedule_end_date;
        $internalAudit->Initiator_Group= $request->Initiator_Group;
        // dd( $internalAudit->Initiator_Group );
        $internalAudit->initiator_group_code= $request->initiator_group_code;
        $internalAudit->short_description = $request->short_description;
        $internalAudit->audit_type = $request->audit_type;
        $internalAudit->if_other = $request->if_other;
        $internalAudit->initiated_through = $request->initiated_through;
        $internalAudit->initiated_if_other = $request->initiated_if_other;
        $internalAudit->repeat = $request->repeat;
        $internalAudit->repeat_nature = $request->repeat_nature;
        $internalAudit->due_date_extension = $request->due_date_extension;
        $internalAudit->initial_comments = $request->initial_comments;
        $internalAudit->sch_audit_start_date = $request->sch_audit_start_date;
        $internalAudit->end_date = $request->end_date;
        $internalAudit->External_Auditing_Agency= $request->External_Auditing_Agency;
        $internalAudit->Relevant_Guideline= $request->Relevant_Guideline;
        $internalAudit->QA_Comments= $request->QA_Comments;
        $internalAudit->Others= $request->Others;
        $internalAudit->Auditor_comment = $request->Auditor_comment;
        $internalAudit->Auditee_comment = $request->Auditee_comment;
        $internalAudit->auditee_department = $request->auditee_department;
        //dd($request->auditee_department);
        // $internalAudit->file_attachment_guideline = $request->file_attachment_guideline;
        $internalAudit->Audit_Category= $request->Audit_Category;
        // dd($internalAudit->Audit_Category);
        $internalAudit->res_ver = $request->res_ver;

        if (!empty($request->attach_file_rv)) {
            $files = [];
            if ($request->hasfile('attach_file_rv')) {
                foreach ($request->file('attach_file_rv') as $file) {
                    $name = $request->name . 'response_verify_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->attach_file_rv = json_encode($files);
        }
        $internalAudit->Supplier_Details= $request->Supplier_Details;
        $internalAudit->Supplier_Site= $request->Supplier_Site;
        //$internalAudit->Facility =  implode(',', $request->Facility);
        //$internalAudit->Group = implode(',', $request->Group);
        $internalAudit->material_name = $request->material_name;
        $internalAudit->if_comments = $request->if_comments;
        $internalAudit->lead_auditor = $request->lead_auditor;
        // $internalAudit->Audit_team =  implode(',', $request->Audit_team);
        // if (is_array($request->Audit_team)) {
        //     $internalAudit->Audit_team = implode(',', $request->Audit_team);
        // } else {
        //     $internalAudit->Audit_team = $request->Audit_team;
        // }
        if (is_array($request->checklists)) {
            $internalAudit->checklists = implode(',', $request->checklists);
        } else {
            $internalAudit->checklists = $request->checklists;
        }
        // $internalAudit->Auditee =  implode(',', $request->Auditee);
        // if (is_array($request->Auditee)) {
        //     $internalAudit->Auditee = implode(',', $request->Auditee);
        // } else {
        //     $internalAudit->Auditee = $request->Auditee;
        // }
        $internalAudit->Auditor_Details = $request->Auditor_Details;
        $internalAudit->Comments = $request->Comments;
        $internalAudit->Audit_Comments1 = $request->Audit_Comments1;
        $internalAudit->Remarks = $request->Remarks;
        // $internalAudit->refrence_record=  implode(',', $request->refrence_record);
        if (is_array($request->refrence_record)) {
            $internalAudit->refrence_record = implode(',', $request->refrence_record);
        } else {
            $internalAudit->refrence_record = $request->refrence_record;
        }
        $internalAudit->Audit_Comments2 = $request->Audit_Comments2;
        $internalAudit->due_date = $request->due_date;
        $internalAudit->audit_start_date= $request->audit_start_date;

        $internalAudit->audit_end_date = $request->audit_end_date;
        // $internalAudit->external_others=$request->external_others;
        $internalAudit->response_1 = $request->response_1;

        $internalAudit->response_2 = $request->response_2;
        $internalAudit->response_3 = $request->response_3;
        $internalAudit->response_4 = $request->response_4;
        $internalAudit->response_5 = $request->response_5;
        $internalAudit->response_6 = $request->response_6;
        $internalAudit->response_7 = $request->response_7;
        $internalAudit->response_8 = $request->response_8;
        $internalAudit->response_9 = $request->response_9;
        $internalAudit->response_10 = $request->response_10;
        $internalAudit->response_11 = $request->response_11;
        $internalAudit->response_12 = $request->response_12;
        $internalAudit->response_13 = $request->response_13;
        $internalAudit->response_14 = $request->response_14;
        $internalAudit->response_15 = $request->response_15;
        $internalAudit->response_16 = $request->response_16;
        $internalAudit->response_17 = $request->response_17;
        $internalAudit->response_18 = $request->response_18;
        $internalAudit->response_19 = $request->response_19;
        $internalAudit->response_20 = $request->response_20;
        $internalAudit->response_21 = $request->response_21;
        $internalAudit->response_22 = $request->response_22;
        $internalAudit->response_23 = $request->response_23;
        $internalAudit->response_24 = $request->response_24;
        $internalAudit->response_25 = $request->response_25;
        $internalAudit->response_26 = $request->response_26;
        $internalAudit->response_27 = $request->response_27;
        $internalAudit->response_28 = $request->response_28;
        $internalAudit->response_29 = $request->response_29;
        $internalAudit->response_30 = $request->response_30;
        $internalAudit->response_31 = $request->response_31;
        $internalAudit->response_32 = $request->response_32;
        $internalAudit->response_33 = $request->response_33;
        $internalAudit->response_34 = $request->response_34;
        $internalAudit->response_35 = $request->response_35;
        $internalAudit->response_36 = $request->response_36;
        $internalAudit->response_37 = $request->response_37;
        $internalAudit->response_38 = $request->response_38;
        $internalAudit->response_39 = $request->response_39;
        $internalAudit->response_40 = $request->response_40;
        $internalAudit->response_41 = $request->response_41;
        $internalAudit->response_42 = $request->response_42;
        $internalAudit->response_43 = $request->response_43;
        $internalAudit->response_44 = $request->response_44;
        $internalAudit->response_45 = $request->response_45;
        $internalAudit->response_46 = $request->response_46;
        $internalAudit->response_47 = $request->response_47;
        $internalAudit->response_48 = $request->response_48;
        $internalAudit->response_49 = $request->response_49;
        $internalAudit->response_50 = $request->response_50;
        $internalAudit->response_51 = $request->response_52;
        $internalAudit->response_52 = $request->response_52;
        $internalAudit->response_53 = $request->response_53;
        $internalAudit->response_54 = $request->response_54;
        $internalAudit->response_55 = $request->response_55;
        $internalAudit->response_56 = $request->response_56;
        $internalAudit->response_57 = $request->response_57;
        $internalAudit->response_58 = $request->response_58;
        $internalAudit->response_59 = $request->response_59;
        $internalAudit->response_60 = $request->response_60;
        $internalAudit->response_61 = $request->response_61;
        $internalAudit->response_62 = $request->response_62;
        $internalAudit->response_63 = $request->response_63;


        $internalAudit->remark_1 = $request->remark_1;
        $internalAudit->remark_2 = $request->remark_2;
        $internalAudit->remark_3 = $request->remark_3;
        $internalAudit->remark_4 = $request->remark_4;
        $internalAudit->remark_5 = $request->remark_5;
        $internalAudit->remark_6 = $request->remark_6;
        $internalAudit->remark_7 = $request->remark_7;
        $internalAudit->remark_8 = $request->remark_8;
        $internalAudit->remark_9 = $request->remark_9;
        $internalAudit->remark_10 = $request->remark_10;
        $internalAudit->remark_11 = $request->remark_11;
        $internalAudit->remark_12 = $request->remark_12;
        $internalAudit->remark_13 = $request->remark_13;

        $internalAudit->remark_14 = $request->remark_14;
        $internalAudit->remark_15 = $request->remark_15;
        $internalAudit->remark_16 = $request->remark_16;
        $internalAudit->remark_17 = $request->remark_17;
        $internalAudit->remark_18 = $request->remark_18;
        $internalAudit->remark_19 = $request->remark_19;
        $internalAudit->remark_20 = $request->remark_20;
        $internalAudit->remark_21 = $request->remark_21;
        $internalAudit->remark_22 = $request->remark_22;
        $internalAudit->remark_23 = $request->remark_23;
        $internalAudit->remark_24 = $request->remark_24;
        $internalAudit->remark_25 = $request->remark_25;
        $internalAudit->remark_26 = $request->remark_26;
        $internalAudit->remark_27 = $request->remark_27;
        $internalAudit->remark_28 = $request->remark_28;
        $internalAudit->remark_29 = $request->remark_29;
        $internalAudit->remark_30 = $request->remark_30;
        $internalAudit->remark_31 = $request->remark_31;
        $internalAudit->remark_32 = $request->remark_32;
        $internalAudit->remark_33 = $request->remark_33;
        $internalAudit->remark_34 = $request->remark_34;
        $internalAudit->remark_35 = $request->remark_35;
        $internalAudit->remark_36 = $request->remark_36;
        $internalAudit->remark_37 = $request->remark_37;
        $internalAudit->remark_38 = $request->remark_38;
        $internalAudit->remark_39 = $request->remark_39;
        $internalAudit->remark_40 = $request->remark_40;
        $internalAudit->remark_41 = $request->remark_41;
        $internalAudit->remark_42 = $request->remark_42;
        $internalAudit->remark_43 = $request->remark_43;
        $internalAudit->remark_44 = $request->remark_44;
        $internalAudit->remark_45 = $request->remark_45;
        $internalAudit->remark_46 = $request->remark_46;
        $internalAudit->remark_47 = $request->remark_47;
        $internalAudit->remark_48 = $request->remark_48;
        $internalAudit->remark_49 = $request->remark_49;
        $internalAudit->remark_50 = $request->remark_50;
        $internalAudit->remark_51 = $request->remark_51;
        $internalAudit->remark_52 = $request->remark_52;
        $internalAudit->remark_53 = $request->remark_53;
        $internalAudit->remark_54 = $request->remark_54;
        $internalAudit->remark_55 = $request->remark_55;
        $internalAudit->remark_56 = $request->remark_56;
        $internalAudit->remark_57 = $request->remark_57;
        
        $internalAudit->remark_58 = $request->remark_58;
        $internalAudit->remark_59 = $request->remark_59;
        $internalAudit->remark_60 = $request->remark_60;
        $internalAudit->remark_61 = $request->remark_61;
        $internalAudit->remark_62 = $request->remark_62;
        $internalAudit->remark_63 = $request->remark_63;

        $internalAudit->save();



        $Summary = $internalAudit->id;

        $AuditorsNew = InternalAuditorGrid::where(['auditor_id' => $Summary, 'identifier' => 'Auditors'])->firstOrNew();
        $AuditorsNew->auditor_id = $Summary;
        $AuditorsNew->identifier = 'Auditors';
        $AuditorsNew->data = $request->AuditorNew;
        $AuditorsNew->save();

        $auditorsNew = InternalAuditGrid::where(['audit_id' => $internalAudit->id, 'identifier' => 'Audit Agenda'])->firstOrCreate();
        $auditorsNew->audit_id = $internalAudit->id;
        $auditorsNew->identifier = 'Audit Agenda';
        $auditAgendaData = $request->auditAgendaData;
        if (!empty($auditAgendaData) && is_array($auditAgendaData)) {
            foreach ($auditAgendaData as $index => $row) {
                if (isset($row['auditors']) && is_array($row['auditors'])) {
                    $row['auditors'] = implode(',', $row['auditors']);
                }

                if (isset($row['auditee']) && is_array($row['auditee'])) {
                    $row['auditee'] = implode(',', $row['auditee']);
                }
            }
        }
        $auditorsNew->data = $auditAgendaData;
        $auditorsNew->save();


        //if (!empty($request->AuditorNew)) {
        //    // Save the new auditor data
        //    $AuditorsNew = InternalAuditorGrid::where(['auditor_id' => $Summary, 'identifier' => 'Auditors'])->firstOrNew();
        //    $AuditorsNew->auditor_id = $Summary;
        //    $AuditorsNew->identifier = 'Auditors';
        //    $AuditorsNew->data = $request->AuditorNew;
        //    $AuditorsNew->save();


        //    // Define the mapping of field keys to more descriptive names
        //    $fieldNames = [
        //        'auditornew' => 'Auditor Name',
        //        'regulatoryagency' => 'Department',
        //        'designation' => 'Designation',
        //        'remarks' => 'Remarks',

        //    ];

        //    // Track audit trail changes (creation of new data)
        //    if (is_array($request->AuditorNew)) {
        //        foreach ($request->AuditorNew as $index => $newAuditor) {
        //            // Track changes for each field
        //            $fieldsToTrack = ['auditornew', 'regulatoryagency', 'designation', 'remarks'];
        //            foreach ($fieldsToTrack as $field) {
        //                $newValue = $newAuditor[$field] ?? 'Null';

        //                // Only proceed if there's new data
        //                if ($newValue !== 'Null') {
        //                    // Log the creation of the new data in the audit trail
        //                    $auditTrail = new InternalAuditTrial;
        //                    $auditTrail->internalAudit_id = $internalAudit->id;
        //                    $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
        //                    $auditTrail->previous = 'Null'; // Since it's new data, there's no previous value
        //                    $auditTrail->current = $newValue;
        //                    $auditTrail->comment = "";
        //                    $auditTrail->user_id = Auth::user()->id;
        //                    $auditTrail->user_name = Auth::user()->name;
        //                    $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //                    //$auditTrail->origin_state = $internalAudit->status;
        //                    $auditTrail->change_to = "Not Applicable";
        //                    $auditTrail->change_from = $internalAudit->status;
        //                    $auditTrail->action_name = 'Create'; // Since this is a create operation
        //                    $auditTrail->save();
        //                }
        //            }
        //        }
        //    }
        //}


                //------------------------------------response and remarks input---------------------------------
                //$internalaudit   = new table_cc_impactassement();

            $internal_id = $internalAudit->id;
            $newDataGridInternalsave = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'observations'])->firstOrNew();
            // dd($newDataGridInternalsave);
            $newDataGridInternalsave->io_id = $internal_id;
            $newDataGridInternalsave->identifier = 'observations';
            $newDataGridInternalsave->data = $request->observations;
            $newDataGridInternalsave->save();

            //if (!empty($request->observations)) {
            //    $newDataGridInternalsave = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'observations'])->firstOrNew();
            //    // dd($newDataGridInternalsave);
            //    $newDataGridInternalsave->io_id = $internal_id;
            //    $newDataGridInternalsave->identifier = 'observations';
            //    $newDataGridInternalsave->data = $request->observations;
            //    $newDataGridInternalsave->save();


            //    // Define the mapping of field keys to more descriptive names
            //    $fieldNames = [
            //        'observation' => 'Observations/Discrepancy',
            //        'category' => 'Category',
            //        'remarks' => 'Remarks',

            //    ];

            //    // Track audit trail changes (creation of new data)
            //    if (is_array($request->observations)) {
            //        foreach ($request->observations as $index => $newAuditor) {
            //            // Track changes for each field
            //            $fieldsToTrack = ['observation', 'category', 'remarks'];
            //            foreach ($fieldsToTrack as $field) {
            //                $newValue = $newAuditor[$field] ?? 'Null';

            //                // Only proceed if there's new data
            //                if ($newValue !== 'Null') {
            //                    // Log the creation of the new data in the audit trail
            //                    $auditTrail = new InternalAuditTrial;
            //                    $auditTrail->InternalAudit_id = $internalAudit->id;
            //                    $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
            //                    $auditTrail->previous = 'Null'; // Since it's new data, there's no previous value
            //                    $auditTrail->current = $newValue;
            //                    $auditTrail->comment = "";
            //                    $auditTrail->user_id = Auth::user()->id;
            //                    $auditTrail->user_name = Auth::user()->name;
            //                    $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //                    $auditTrail->origin_state = $internalAudit->status;
            //                    $auditTrail->change_to = "Not Applicable";
            //                    $auditTrail->change_from = $internalAudit->status;
            //                    $auditTrail->action_name = 'Create'; // Since this is a create operation
            //                    $auditTrail->save();
            //                }
            //            }
            //        }
            //    }
            //}


            $internal_id = $internalAudit->id;
            $newDataGridInitialClosure = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'Initial'])->firstOrCreate();
            $newDataGridInitialClosure->io_id = $internal_id;
            $newDataGridInitialClosure->identifier = 'Initial';
            $newDataGridInitialClosure->data = $request->Initial;
            $newDataGridInitialClosure->save();

            //if (!empty($request->Initial)) {
            //    $newDataGridInitialClosure = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'Initial'])->firstOrCreate();
            //    $newDataGridInitialClosure->io_id = $internal_id;
            //    $newDataGridInitialClosure->identifier = 'Initial';
            //    $newDataGridInitialClosure->data = $request->Initial;
            //    $newDataGridInitialClosure->save();


            //    // Define the mapping of field keys to more descriptive names
            //    $fieldNames = [
            //        'observation' => 'Observation',
            //        'impact_assesment' => 'Response with impact assesment & CAPA (If Applicable)',
            //        'responsiblity' => 'Responsibility',
            //        'closure_date' => 'Proposed Closure Date',
            //        'Actual_date' => 'Actual Closure Date',

            //    ];

            //    // Track audit trail changes (creation of new data)
            //    if (is_array($request->Initial)) {
            //        foreach ($request->Initial as $index => $newAuditor) {
            //            // Track changes for each field
            //            $fieldsToTrack = ['observation', 'impact_assesment', 'responsiblity', 'closure_date', 'Actual_date'];
            //            foreach ($fieldsToTrack as $field) {
            //                $newValue = $newAuditor[$field] ?? 'Null';

            //                // Only proceed if there's new data
            //                if ($newValue !== 'Null') {
            //                    // Log the creation of the new data in the audit trail
            //                    $auditTrail = new InternalAuditTrial;
            //                    $auditTrail->internalAudit_id = $internalAudit->id;
            //                    $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
            //                    $auditTrail->previous = 'Null'; // Since it's new data, there's no previous value
            //                    $auditTrail->current = $newValue;
            //                    $auditTrail->comment = "";
            //                    $auditTrail->user_id = Auth::user()->id;
            //                    $auditTrail->user_name = Auth::user()->name;
            //                    $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //                    //$auditTrail->origin_state = $internalAudit->status;
            //                    $auditTrail->change_to = "Not Applicable";
            //                    $auditTrail->change_from = $internalAudit->status;
            //                    $auditTrail->action_name = 'Create'; // Since this is a create operation
            //                    $auditTrail->save();
            //                }
            //            }
            //        }
            //    }
            //}


        //$internalAudit->save();
        $ia_id = $internalAudit->id;
        $auditAssessmentGrid = InternalAuditChecklistGrid::where(['ia_id' => $internalAudit->id, 'identifier' => 'auditAssessmentChecklist'])->firstOrNew();
        $auditAssessmentGrid->ia_id = $internalAudit->id;
        $auditAssessmentGrid->identifier = 'auditAssessmentChecklist';
        $auditAssessmentGrid->data = $request->auditAssessmentChecklist;
        $auditAssessmentGrid->save();

        $auditPersonnelGrid = InternalAuditChecklistGrid::where(['ia_id' => $internalAudit->id, 'identifier' => 'auditPersonnelChecklist'])->firstOrNew();
        $auditPersonnelGrid->ia_id = $internalAudit->id;
        $auditPersonnelGrid->identifier = 'auditPersonnelChecklist';
        $auditPersonnelGrid->data = $request->auditPersonnelChecklist;
        $auditPersonnelGrid->save();

        $auditfacilityGrid = InternalAuditChecklistGrid::where(['ia_id' => $internalAudit->id, 'identifier' => 'auditfacilityChecklist'])->firstOrNew();
        $auditfacilityGrid->ia_id = $internalAudit->id;
        $auditfacilityGrid->identifier = 'auditfacilityChecklist';
        $auditfacilityGrid->data = $request->auditfacilityChecklist;
        $auditfacilityGrid->save();

        $auditMachinesGrid = InternalAuditChecklistGrid::where(['ia_id' => $internalAudit->id, 'identifier' => 'auditMachinesChecklist'])->firstOrNew();
        $auditMachinesGrid->ia_id = $internalAudit->id;
        $auditMachinesGrid->identifier = 'auditMachinesChecklist';
        $auditMachinesGrid->data = $request->auditMachinesChecklist;
        $auditMachinesGrid->save();

        $auditProductionGrid = InternalAuditChecklistGrid::where(['ia_id' => $internalAudit->id, 'identifier' => 'auditProductionChecklist'])->firstOrNew();
        $auditProductionGrid->ia_id = $internalAudit->id;
        $auditProductionGrid->identifier = 'auditProductionChecklist';
        $auditProductionGrid->data = $request->auditProductionChecklist;
        $auditProductionGrid->save();

        $auditMaterialsGrid = InternalAuditChecklistGrid::where(['ia_id' => $internalAudit->id, 'identifier' => 'auditMaterialsChecklist'])->firstOrNew();
        $auditMaterialsGrid->ia_id = $internalAudit->id;
        $auditMaterialsGrid->identifier = 'auditMaterialsChecklist';
        $auditMaterialsGrid->data = $request->auditMaterialsChecklist;
        $auditMaterialsGrid->save();

        $auditQualityGrid = InternalAuditChecklistGrid::where(['ia_id' => $internalAudit->id, 'identifier' => 'auditQualityControlChecklist'])->firstOrNew();
        $auditQualityGrid->ia_id = $internalAudit->id;
        $auditQualityGrid->identifier = 'auditQualityControlChecklist';
        $auditQualityGrid->data = $request->auditQualityControlChecklist;
        $auditQualityGrid->save();

        $auditQualityAssuranceGrid = InternalAuditChecklistGrid::where(['ia_id' => $internalAudit->id, 'identifier' => 'auditQualityAssuranceChecklist'])->firstOrNew();
        $auditQualityAssuranceGrid->ia_id = $internalAudit->id;
        $auditQualityAssuranceGrid->identifier = 'auditQualityAssuranceChecklist';
        $auditQualityAssuranceGrid->data = $request->auditQualityAssuranceChecklist;
        $auditQualityAssuranceGrid->save();

        $auditPackagingGrid = InternalAuditChecklistGrid::where(['ia_id' => $internalAudit->id, 'identifier' => 'auditPackagingChecklist'])->firstOrNew();
        $auditPackagingGrid->ia_id = $internalAudit->id;
        $auditPackagingGrid->identifier = 'auditPackagingChecklist';
        $auditPackagingGrid->data = $request->auditPackagingChecklist;
        $auditPackagingGrid->save();

        $auditsheGrid = InternalAuditChecklistGrid::where(['ia_id' => $internalAudit->id, 'identifier' => 'auditSheChecklist'])->firstOrNew();
        $auditsheGrid->ia_id = $internalAudit->id;
        $auditsheGrid->identifier = 'auditSheChecklist';
        $auditsheGrid->data = $request->auditSheChecklist;
        $auditsheGrid->save();

        $internalAuditComments = InternalAuditChecklistGrid::where(['ia_id' => $ia_id])->firstOrNew();
        $internalAuditComments->auditSheChecklist_comment = $request->auditSheChecklist_comment;
        if (!empty($request->auditSheChecklist_attachment)) {
            $files = [];
            if ($request->hasfile('auditSheChecklist_attachment')) {
                foreach ($request->file('auditSheChecklist_attachment') as $file) {
                    $name = $request->name . 'auditSheChecklist_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAuditComments->auditSheChecklist_attachment = json_encode($files);

        }

        $internalAuditComments->save();


        $internalAudit->status = 'Opened';
        $internalAudit->stage = 1;

        if (!empty($request->inv_attachment)) {
            $files = [];
            if ($request->hasfile('inv_attachment')) {
                foreach ($request->file('inv_attachment') as $file) {
                    $name = $request->name . 'gi_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->inv_attachment = json_encode($files);
        }


        if (!empty($request->file_attachment)) {
            $files = [];
            if ($request->hasfile('file_attachment')) {
                foreach ($request->file('file_attachment') as $file) {
                    $name = $request->name . 'acknowledgement_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }

            $internalAudit->file_attachment = json_encode($files);
        }
        if (!empty($request->file_attachment_guideline)) {
            $files = [];
            if ($request->hasfile('file_attachment_guideline')) {
                foreach ($request->file('file_attachment_guideline') as $file) {
                    $name = $request->name . 'auditpreparation_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->file_attachment_guideline = json_encode($files);
        }


        if (!empty($request->Audit_file)) {
            $files = [];
            if ($request->hasfile('Audit_file')) {
                foreach ($request->file('Audit_file') as $file) {
                    $name = $request->name . 'Audit_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->Audit_file = json_encode($files);
        }

        if (!empty($request->report_file)) {
            $files = [];
            if ($request->hasfile('report_file')) {
                foreach ($request->file('report_file') as $file) {
                    $name = $request->name . 'report_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->report_file = json_encode($files);
        }
        if (!empty($request->myfile)) {
            $files = [];
            if ($request->hasfile('myfile')) {
                foreach ($request->file('myfile') as $file) {
                    $name = $request->name . 'audit_response' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->myfile = json_encode($files);
        }
        //dd($internalAudit);
         //return $internalAudit;
        $internalAudit->save();

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();


        // -----------------grid----  Audit Agenda+
        $data3 = new InternalAuditGrid();
        $data3->audit_id = $internalAudit->id;
        $data3->type = "internal_audit";

        if (!empty($request->audit)) {
            $data3->area_of_audit = serialize($request->audit);
        }
        if (!empty($request->scheduled_start_date)) {
            $data3->start_date = serialize($request->scheduled_start_date);
        }
        if (!empty($request->scheduled_start_time)) {
            $data3->start_time = serialize($request->scheduled_start_time);
        }
        if (!empty($request->scheduled_end_date)) {
            $data3->end_date = serialize($request->scheduled_end_date);
        }
        if (!empty($request->scheduled_end_time)) {
            $data3->end_time = serialize($request->scheduled_end_time);
        }
        if (!empty($request->auditor)) {
            $data3->auditor = serialize( $request->auditor);
        }
        if (!empty($request->auditee)) {
            $data3->auditee = serialize( $request->auditee);
        }
        if (!empty($request->remarks)) {
            $data3->remark = serialize($request->remarks);
        }
        $data3->save();

        //$fieldNames = [
        //    'audit' => 'Area of Audit',
        //    'scheduled_start_date' => 'Scheduled Start Date',
        //    'scheduled_start_time' => 'Scheduled Start Time',
        //    'scheduled_end_date' => 'Scheduled End Date',
        //    'scheduled_end_time' => 'Scheduled End Time',
        //    'auditor' => 'Auditor',
        //    'auditee' => 'Auditee',
        //    'remark' => 'Remarks',

        //];

        //foreach ($request->audit as $index => $audit) {
        //    // Since this is a new entry, there are no previous details
        //    $previousDetails = [
        //        'audit' => null,
        //        'scheduled_start_date' => null,
        //        'scheduled_start_time' => null,
        //        'scheduled_end_date' => null,
        //        'scheduled_end_time' => null,
        //        'auditor' => null,
        //        'auditee' => null,
        //        'remark' => null,

        //    ];

        //    // Current fields values from the request
        //    $fields = [
        //        'audit' => $audit,
        //        'scheduled_start_date' => Helpers::getdateFormat($request->scheduled_start_date[$index]) ?? null,
        //        'scheduled_start_time' => $request->scheduled_start_time[$index] ?? null,
        //        'scheduled_end_date' => Helpers::getdateFormat($request->scheduled_end_date[$index]) ?? null,
        //        'scheduled_end_time' => $request->scheduled_end_time[$index] ?? null,
        //        'auditor' => Helpers::getInitiatorName($request->auditor[$index]) ?? null,
        //        'auditee' => Helpers::getInitiatorName($request->auditee[$index]) ?? null,
        //        'remark' => $request->remark[$index] ?? null,

        //    ];


        //    foreach ($fields as $key => $currentValue) {
        //        // Log changes for new rows (no previous value to compare)
        //        if (!empty($currentValue)) {

        //            $history = new InternalAuditTrial();
        //            $history->InternalAudit_id = $internalAudit->id;

        //            // Set activity type to include field name and row index using the fieldNames array
        //            $history->activity_type = $fieldNames[$key] . ' (' . ($index + 1) . ')';

        //            // Since this is a new entry, 'Previous' value is null
        //            $history->previous = 'null'; // Previous value or 'null'

        //            // Assign 'Current' value, which is the new value
        //            $history->current = $currentValue; // New value

        //            // Comments and user details
        //            $history->comment = 'NA';
        //            $history->user_id = Auth::user()->id;
        //            $history->user_name = Auth::user()->name;
        //            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //            $history->origin_state = "Not Applicable"; // For new entries, set an appropriate status
        //            $history->change_to = "Opened";
        //            $history->change_from = "Initiation";
        //            $history->action_name = "Create";

        //            // Save the history record
        //            $history->save();
        //        }
        //    }
        //}





        $data4 = new InternalAuditGrid();
        $data4->audit_id = $internalAudit->id;
        $data4->type = "Observation_field";
        if (!empty($request->observation_id)) {
            $data4->observation_id = serialize($request->observation_id);
        }
        // if (!empty($request->date)) {
        //     $data4->date = serialize($request->date);
        // }
        // if (!empty($request->auditorG)) {
        //     $data4->auditor = serialize($request->auditorG);
        // }
        // if (!empty($request->auditeeG)) {
        //     $data4->auditee = serialize($request->auditeeG);
        // }
        if (!empty($request->observation_description)) {
            $data4->observation_description = serialize($request->observation_description);
        }
        // if (!empty($request->severity_level)) {
        //     $data4->severity_level = serialize($request->severity_level);
        // }
        if (!empty($request->area)) {
            $data4->area = serialize($request->area);
        }
        // if (!empty($request->observation_category)) {
        //     $data4->observation_category = serialize($request->observation_category);
        // }
        //  if (!empty($request->capa_required)) {
        //     $data4->capa_required = serialize($request->capa_required);
        // }
         if (!empty($request->auditee_response)) {
            $data4->auditee_response = serialize($request->auditee_response);
        }
        // if (!empty($request->auditor_review_on_response)) {
        //     $data4->auditor_review_on_response = serialize($request->auditor_review_on_response);
        // }
        // if (!empty($request->qa_comment)) {
        //     $data4->qa_comment = serialize($request->qa_comment);
        // }
        // if (!empty($request->capa_details)) {
        //     $data4->capa_details = serialize($request->capa_details);
        // }
        // if (!empty($request->capa_due_date)) {
        //     $data4->capa_due_date = serialize($request->capa_due_date);
        // }
        // if (!empty($request->capa_owner)) {
        //     $data4->capa_owner = serialize($request->capa_owner);
        // }
        // if (!empty($request->action_taken)) {
        //     $data4->action_taken = serialize($request->action_taken);
        // }
        // if (!empty($request->capa_completion_date)) {
        //     $data4->capa_completion_date = serialize($request->capa_completion_date);
        // }
        // if (!empty($request->status_Observation)) {
        //     $data4->status = serialize($request->status_Observation);
        // }
        // if (!empty($request->remark_observation)) {
        //     $data4->remark = serialize($request->remark_observation);
        // }
        $data4->save();

        if (!empty($internalAudit->record)) {
            $history = new InternalAuditTrial();
            $history->internalAudit_id = $internalAudit->id;
            $history->activity_type = 'Record Number';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName(session()->get('division')) . "/IA/" . Helpers::year($internalAudit->created_at) . "/" . str_pad($internalAudit->record, 4, '0', STR_PAD_LEFT);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->division_code)) {
            $history = new InternalAuditTrial();
            $history->internalAudit_id = $internalAudit->id;
            $history->activity_type = 'Site/Location Code';
            $history->previous = "Null";
            $history->current = $internalAudit->division_code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($internalAudit->initiator_id)) {
            $history = new InternalAuditTrial();
            $history->internalAudit_id = $internalAudit->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($internalAudit->initiator_id);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($request->intiation_date)) {
            $history = new InternalAuditTrial();
            $history->internalAudit_id = $internalAudit->id;
            $history->activity_type = 'Date Of Initiation';
            $history->previous = "Null";
            $history->current =  Helpers::getdateFormat($request->intiation_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->assign_to)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Auditee Department Head';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($internalAudit->assign_to);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->sch_audit_start_date)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Scheduled audit date';
            $history->previous = "Null";
            $history->current =  Helpers::getdateFormat($internalAudit->sch_audit_start_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($internalAudit->auditee_department)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Auditee department Name';
            $history->previous = "Null";
            $history->current = Helpers::getFullDepartmentName($internalAudit->auditee_department);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($internalAudit->Initiator_Group)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Initiator Department';
            $history->previous = "Null";
            $history->current = $internalAudit->Initiator_Group;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->initiator_group_code)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Initiator Department  Code';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->initiator_group_code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->short_description)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->initiated_through)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Initiated Through';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->initiated_through;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }


        // if (!empty($internalAudit->audit_type)) {
        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $internalAudit->id;
        //     $history->activity_type = 'Type of Audit';
        //     $history->previous = "Not Applicable";
        //     $history->current = $internalAudit->audit_type;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $internalAudit->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->save();
        // }

        // if (!empty($internalAudit->if_other)) {
        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $internalAudit->id;
        //     $history->activity_type = 'If Other';
        //     $history->previous = "Not Applicable";
        //     $history->current = $internalAudit->if_other;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $internalAudit->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->save();
        // }
        if (!empty($internalAudit->initiated_if_other)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Others';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->initiated_if_other;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->initial_comments)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Description';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->initial_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->external_agencies)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'External Agencies';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->external_agencies;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->Others)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Others';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->Others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->audit_schedule_start_date)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Start';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->audit_schedule_start_date;
            $history->comment = "Na";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->audit_schedule_end_date)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'End Date';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->audit_schedule_end_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        // if (!empty($internalAudit->audit_agenda)) {
        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $internalAudit->id;
        //     $history->activity_type = 'Audit Agenda';
        //     $history->previous = "Not Applicable";
        //     $history->current = $internalAudit->audit_agenda;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $internalAudit->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->save();
        // }

        // if (!empty($internalAudit->Facility)) {
        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $internalAudit->id;
        //     $history->activity_type = 'Facility Name';
        //     $history->previous = "Not Applicable";
        //     $history->current = $internalAudit->Facility;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $internalAudit->status;
        //     $history->save();
        // }

        // if (!empty($internalAudit->Group)) {
        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $internalAudit->id;
        //     $history->activity_type = 'Group Name';
        //     $history->previous = "Not Applicable";
        //     $history->current = $internalAudit->Group;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $internalAudit->status;
        //     $history->save();
        // }

        if (!empty($internalAudit->material_name)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Product/Material Name';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->material_name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->if_comments)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Comments(If Any)';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->if_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->lead_auditor)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Lead Auditor';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->lead_auditor;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($internalAudit->due_date_extension)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Due Date Extension Justification';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->due_date_extension;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        // if (!empty($internalAudit->Audit_team)) {
        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $internalAudit->id;
        //     $history->activity_type = 'Audit Team';
        //     $history->previous = "Not Applicable";
        //     $history->current = $internalAudit->Audit_team;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $internalAudit->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->save();
        // }

        // if (!empty($internalAudit->Auditee)) {
        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $internalAudit->id;
        //     $history->activity_type = 'Auditee';
        //     $history->previous = "Not Applicable";
        //     $history->current = $internalAudit->Auditee;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $internalAudit->status;
        //     $history->change_to =   "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = 'Create';
        //     $history->save();
        // }

        if (!empty($internalAudit->Auditor_Details)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'External Auditor Details';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->Auditor_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->Relevant_Guideline)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Relevant Guidelines / Industry Standards';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->Relevant_Guideline;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->QA_Comments)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'QA Comments';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->QA_Comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->Audit_Category)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Category';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->Audit_Category;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->Supplier_Details)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Supplier/Vendor/Manufacturer Details';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->Supplier_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->Supplier_Site)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Supplier/Vendor/Manufacturer Site';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->Supplier_Site;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }


        if (!empty($internalAudit->Comments)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Comments';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->Comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->severity_level_form)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Observation Category';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->severity_level_form;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->Audit_Comments1)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Comments';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->Audit_Comments1;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($internalAudit->refrence_record)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Reference Record';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->refrence_record;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($internalAudit->res_ver)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Response Verification Comment';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->res_ver;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($internalAudit->attach_file_rv)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Response verification Attachments';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->attach_file_rv;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->Remarks)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Remarks';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->Remarks;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->Reference_Recores1)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Reference Records';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->Reference_Recores1;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->Reference_Recores2)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Reference Records';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->Reference_Recores2;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->Audit_Comments2)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Comments';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->Audit_Comments2;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->inv_attachment)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'GI Attachment';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->inv_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->file_attachment)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Acknowledgement Attachment';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->file_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }
        if (!empty($internalAudit->file_attachment_guideline)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Preparation and Execution Attachment';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->file_attachment_guideline;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->Audit_file)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Attachments';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->Audit_file;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->report_file)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Report Attachments';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->report_file;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->myfile)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Attachment';
            $history->previous = "Not Applicable";
            $history->current = $internalAudit->myfile;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }



        if (!empty($internalAudit->due_date)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Not Applicable";
             $history->current =  Helpers::getdateFormat( $internalAudit->due_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->audit_start_date)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Start Date';
            $history->previous = "Not Applicable";
            $history->current = Helpers::getdateFormat($internalAudit->audit_start_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }

        if (!empty($internalAudit->audit_end_date)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit End Date';
            $history->previous = "Not Applicable";
            $history->current = Helpers::getdateFormat( $internalAudit->audit_end_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->change_to =   "Opened";
            $history->change_from = "Initiation";
            $history->action_name = 'Create';
            $history->save();
        }


        toastr()->success('Record is created Successfully');

        return redirect('rcms/qms-dashboard');
    }


    public function update(request $request, $id)
    {

       // dd($request->all());
        $lastDocument = InternalAudit::find($id);
        $internalAudit = InternalAudit::find($id);

        // $internalAudit->parent_id = $request->parent_id;
        // $internalAudit->parent_type = $request->parent_type;
        $internalAudit->intiation_date = $request->intiation_date;
        $internalAudit->assign_to = $request->assign_to;
        $internalAudit->due_date= $request->due_date;
        // dd($internalAudit->due_date);
        // $internalAudit->initiator_group= $request->initiator_group;
        $internalAudit->initiator_group_code= $request->initiator_group_code;
        $internalAudit->short_description = $request->short_description;
        $internalAudit->audit_type = $request->audit_type;
        $internalAudit->if_other = $request->if_other;
        $internalAudit->Others= $request->Others;
        // $internalAudit->external_others=$request->external_others;
        $internalAudit->Relevant_Guideline= $request->Relevant_Guideline;
        $internalAudit->initiated_through = $request->initiated_through;
        // dd($internalAudit->initiated_through);
        $internalAudit->initiated_if_other = $request->initiated_if_other;
        $internalAudit->repeat = $request->repeat;
        $internalAudit->QA_Comments= $request->QA_Comments;
        // $internalAudit->file_attachment_guideline = $request->file_attachment_guideline;
        $internalAudit->Supplier_Details= $request->Supplier_Details;
        $internalAudit->Supplier_Site= $request->Supplier_Site;
        $internalAudit->Audit_Category= $request->Audit_Category;
        $internalAudit->repeat_nature = $request->repeat_nature;
        $internalAudit->due_date_extension = $request->due_date_extension;
        $internalAudit->External_Auditing_Agency= $request->External_Auditing_Agency;
        $internalAudit->initial_comments = $request->initial_comments;
        $internalAudit->Initiator_Group = $request->Initiator_Group;
        // dd($internalAudit->Initiator_Group);
        // dd($internalAudit->Initiator_Group);
        $internalAudit->Auditor_comment = $request->Auditor_comment;
        $internalAudit->Auditee_comment = $request->Auditee_comment;
        // dd($internalAudit->Auditor_comment);
        $internalAudit->auditee_department = $request->auditee_department;
        $internalAudit->sch_audit_start_date = $request->sch_audit_start_date;

        $internalAudit->end_date = $request->end_date;
        $internalAudit->audit_agenda = $request->audit_agenda;
        //$internalAudit->Facility =  implode(',', $request->Facility);
        // $internalAudit->Group = implode(',', $request->Group);
        $internalAudit->external_agencies = $request->external_agencies;
        $internalAudit->material_name = $request->material_name;
        $internalAudit->if_comments = $request->if_comments;
        $internalAudit->lead_auditor = $request->lead_auditor;
        // $internalAudit->Audit_team =  implode(',', $request->Audit_team);
        if (is_array($request->checklists)) {
            $internalAudit->checklists = implode(',', $request->checklists);
        } else {
            $internalAudit->checklists = $request->checklists;
        }
        // dd($request->checklists);
        // $internalAudit->Auditee =  implode(',', $request->Auditee);
        $internalAudit->Auditor_Details = $request->Auditor_Details;
        $internalAudit->Comments = $request->Comments;
        $internalAudit->Audit_Comments1 = $request->Audit_Comments1;
        $internalAudit->Remarks = $request->Remarks;
        // $internalAudit->refrence_record=implode(',', $request->refrence_record);
        $internalAudit->refrence_record = is_array($request->refrence_record)
    ? implode(',', $request->refrence_record)
    : $request->refrence_record;
        $internalAudit->severity_level_form= $request->severity_level_form;
        $internalAudit->audit_schedule_start_date= $request->audit_schedule_start_date;
        $internalAudit->audit_schedule_end_date= $request->audit_schedule_end_date;

        $internalAudit->Audit_Comments2 = $request->Audit_Comments2;
        $internalAudit->due_date= $request->due_date;
        $internalAudit->audit_start_date= $request->audit_start_date;
        $internalAudit->audit_end_date = $request->audit_end_date;
        $internalAudit->auditSheChecklist_comment_main = $request->auditSheChecklist_comment_main;
        $internalAudit->res_ver = $request->res_ver;


        // ===================update==============checklist=========

        $internalAudit->response_1 = $request->response_1;
        $internalAudit->response_2 = $request->response_2;
        $internalAudit->response_3 = $request->response_3;
        $internalAudit->response_4 = $request->response_4;
        $internalAudit->response_5 = $request->response_5;
        $internalAudit->response_6 = $request->response_6;
        $internalAudit->response_7 = $request->response_7;
        $internalAudit->response_8 = $request->response_8;
        $internalAudit->response_9 = $request->response_9;
        $internalAudit->response_10 = $request->response_10;
        $internalAudit->response_11 = $request->response_11;
        $internalAudit->response_12 = $request->response_12;
        $internalAudit->response_13 = $request->response_13;
        $internalAudit->response_14 = $request->response_14;
        $internalAudit->response_15 = $request->response_15;
        $internalAudit->response_16 = $request->response_16;
        $internalAudit->response_17 = $request->response_17;
        $internalAudit->response_18 = $request->response_18;
        $internalAudit->response_19 = $request->response_19;
        $internalAudit->response_20 = $request->response_20;
        $internalAudit->response_21 = $request->response_21;
        $internalAudit->response_22 = $request->response_22;
        $internalAudit->response_23 = $request->response_23;
        $internalAudit->response_24 = $request->response_24;
        $internalAudit->response_25 = $request->response_25;
        $internalAudit->response_26 = $request->response_26;
        $internalAudit->response_27 = $request->response_27;
        $internalAudit->response_28 = $request->response_28;
        $internalAudit->response_29 = $request->response_29;
        $internalAudit->response_30 = $request->response_30;
        $internalAudit->response_31 = $request->response_31;
        $internalAudit->response_32 = $request->response_32;
        $internalAudit->response_33 = $request->response_33;
        $internalAudit->response_34 = $request->response_34;
        $internalAudit->response_35 = $request->response_35;
        $internalAudit->response_36 = $request->response_36;
        $internalAudit->response_37 = $request->response_37;
        $internalAudit->response_38 = $request->response_38;
        $internalAudit->response_39 = $request->response_39;
        $internalAudit->response_40 = $request->response_40;
        $internalAudit->response_41 = $request->response_41;
        $internalAudit->response_42 = $request->response_42;
        $internalAudit->response_43 = $request->response_43;
        $internalAudit->response_44 = $request->response_44;
        $internalAudit->response_45 = $request->response_45;
        $internalAudit->response_46 = $request->response_46;
        $internalAudit->response_47 = $request->response_47;
        $internalAudit->response_48 = $request->response_48;
        $internalAudit->response_49 = $request->response_49;
        $internalAudit->response_50 = $request->response_50;
        $internalAudit->response_51 = $request->response_52;
        $internalAudit->response_52 = $request->response_52;
        $internalAudit->response_53 = $request->response_53;
        $internalAudit->response_54 = $request->response_54;
        $internalAudit->response_55 = $request->response_55;
        $internalAudit->response_56 = $request->response_56;
        $internalAudit->response_57 = $request->response_57;
        $internalAudit->response_58 = $request->response_58;
        $internalAudit->response_59 = $request->response_59;
        $internalAudit->response_60 = $request->response_60;
        $internalAudit->response_61 = $request->response_61;
        $internalAudit->response_62 = $request->response_62;
        $internalAudit->response_63 = $request->response_63;


        $internalAudit->remark_1 = $request->remark_1;
        $internalAudit->remark_2 = $request->remark_2;
        $internalAudit->remark_3 = $request->remark_3;
        $internalAudit->remark_4 = $request->remark_4;
        $internalAudit->remark_5 = $request->remark_5;
        $internalAudit->remark_6 = $request->remark_6;
        $internalAudit->remark_7 = $request->remark_7;
        $internalAudit->remark_8 = $request->remark_8;
        $internalAudit->remark_9 = $request->remark_9;
        $internalAudit->remark_10 = $request->remark_10;
        $internalAudit->remark_11 = $request->remark_11;
        $internalAudit->remark_12 = $request->remark_12;
        $internalAudit->remark_13 = $request->remark_13;
        $internalAudit->remark_14 = $request->remark_14;
        $internalAudit->remark_15 = $request->remark_15;
        $internalAudit->remark_16 = $request->remark_16;
        $internalAudit->remark_17 = $request->remark_17;
        $internalAudit->remark_18 = $request->remark_18;
        $internalAudit->remark_19 = $request->remark_19;
        $internalAudit->remark_20 = $request->remark_20;
        $internalAudit->remark_21 = $request->remark_21;
        $internalAudit->remark_22 = $request->remark_22;
        $internalAudit->remark_23 = $request->remark_23;
        $internalAudit->remark_24 = $request->remark_24;
        $internalAudit->remark_25 = $request->remark_25;
        $internalAudit->remark_26 = $request->remark_26;
        $internalAudit->remark_27 = $request->remark_27;
        $internalAudit->remark_28 = $request->remark_28;
        $internalAudit->remark_29 = $request->remark_29;
        $internalAudit->remark_30 = $request->remark_30;
        $internalAudit->remark_31 = $request->remark_31;
        $internalAudit->remark_32 = $request->remark_32;
        $internalAudit->remark_33 = $request->remark_33;
        $internalAudit->remark_34 = $request->remark_34;
        $internalAudit->remark_35 = $request->remark_35;
        $internalAudit->remark_36 = $request->remark_36;
        $internalAudit->remark_37 = $request->remark_37;
        $internalAudit->remark_38 = $request->remark_38;
        $internalAudit->remark_39 = $request->remark_39;
        $internalAudit->remark_40 = $request->remark_40;
        $internalAudit->remark_41 = $request->remark_41;
        $internalAudit->remark_42 = $request->remark_42;
        $internalAudit->remark_43 = $request->remark_43;
        $internalAudit->remark_44 = $request->remark_44;
        $internalAudit->remark_45 = $request->remark_45;
        $internalAudit->remark_46 = $request->remark_46;
        $internalAudit->remark_47 = $request->remark_47;
        $internalAudit->remark_48 = $request->remark_48;
        $internalAudit->remark_49 = $request->remark_49;
        $internalAudit->remark_50 = $request->remark_50;
        $internalAudit->remark_51 = $request->remark_51;
        $internalAudit->remark_52 = $request->remark_52;
        $internalAudit->remark_53 = $request->remark_53;
        $internalAudit->remark_54 = $request->remark_54;
        $internalAudit->remark_55 = $request->remark_55;
        $internalAudit->remark_56 = $request->remark_56;
        $internalAudit->remark_57 = $request->remark_57;
        $internalAudit->remark_58 = $request->remark_58;
        $internalAudit->remark_59 = $request->remark_59;
        $internalAudit->remark_60 = $request->remark_60;
        $internalAudit->remark_61 = $request->remark_61;
        $internalAudit->remark_62 = $request->remark_62;
        $internalAudit->remark_63 = $request->remark_63;
        $internalAudit->Description_Deviation = $request->Description_Deviation;

        // dd($request->Description_Deviation);

        // =======================new teblet compresion ====
        $checklistTabletCompression = IA_checklist_tablet_compression::where(['ia_id' => $id])->firstOrCreate();
        $checklistTabletCompression->ia_id = $id;


        for ($i = 1; $i <= 49; $i++)
        {
            $string = 'tablet_compress_response_'. $i;
            $checklistTabletCompression->$string = $request->$string;
        }

        for ($i = 1; $i <= 49; $i++)
        {
            $string = 'tablet_compress_remark_'. $i;
            $checklistTabletCompression->$string = $request->$string;
        }
        // dd($checklistTabletCompression->tablet_compress_remark_1)
        $checklistTabletCompression->tablet_compress_response_final_comment = $request->tablet_compress_response_final_comment;
        $checklistTabletCompression->save();


        // =======================new teblet coating ====
        $checklistTabletCoating = IA_checklist_tablet_coating::where(['ia_id' => $id])->firstOrCreate();
        $checklistTabletCoating->ia_id = $id;


        for ($i = 1; $i <= 49; $i++)
        {
            $string = 'tablet_coating_response_'. $i;
            $checklistTabletCoating->$string = $request->$string;
        }

        for ($i = 1; $i <= 49; $i++)
        {
            $string = 'tablet_coating_remark_'. $i;
            $checklistTabletCoating->$string = $request->$string;
        }
        // dd($checklistTabletCompression->tablet_compress_remark_1)
        $checklistTabletCoating->tablet_coating_remark_comment = $request->tablet_coating_remark_comment;
        $checklistTabletCoating->save();


        //==================== onitnment controller==================================================================
$liquid_ointments = IA_liquid_ointment::where(['ia_id' => $id])->firstOrCreate();
$liquid_ointments->ia_id = $id;


 for ($i = 1; $i <= 50; $i++)
 {
     $string = 'liquid_ointments_response_'. $i;
    $liquid_ointments->$string = $request->$string;
 }

 for ($i = 1; $i <= 50; $i++)
 {
    $string = 'liquid_ointments_remark_'. $i;
     $liquid_ointments->$string = $request->$string;
 }
 // dd($checklistTabletCompression->tablet_compress_remark_1)
 $liquid_ointments->Description_oinments_comment = $request->Description_oinments_comment;
$liquid_ointments->save();

//======================================  Checklist_Capsule==========================================================================================================================================================

$Checklist_Capsule = Checklist_Capsule::where(['ia_id' => $id])->firstOrCreate();
$Checklist_Capsule->ia_id = $id;


for ($i = 1; $i <= 50; $i++)
{
    $string = 'capsule_response_'. $i;
    $Checklist_Capsule->$string = $request->$string;
}

for ($i = 1; $i <= 50; $i++)
{
    $string = 'capsule_remark_'. $i;
    $Checklist_Capsule->$string = $request->$string;
}
// dd($checklistTabletCompression->tablet_compress_remark_1)
$Checklist_Capsule->Description_Deviation_capsule = $request->Description_Deviation_capsule;
$Checklist_Capsule->save();

//=========================================================================================



        // =======================new teblet paking====
        $checklistTabletPaking = IA_checklist_capsule_paking::where(['ia_id' => $id])->firstOrCreate();
        $checklistTabletPaking->ia_id = $id;


        for ($i = 1; $i <= 49; $i++)
        {
            $string = 'tablet_capsule_packing_'. $i;
            $checklistTabletPaking->$string = $request->$string;
        }

        for ($i = 1; $i <= 49; $i++)
        {
            $string = 'tablet_capsule_packing_remark_'. $i;
            $checklistTabletPaking->$string = $request->$string;
        }
        // dd($checklistTabletCompression->tablet_compress_remark_1)
        $checklistTabletPaking->tablet_capsule_packing_comment = $request->tablet_capsule_packing_comment;
        $checklistTabletPaking->save();

  // =======================new teblet dispencing_and_manufactuirng ====
  $dispencing_and_manufactuirng = IA_dispencing_manufacturing::where(['ia_id' => $id])->firstOrCreate();
  $dispencing_and_manufactuirng->ia_id = $id;


  for ($i = 1; $i <= 66; $i++)
  {
      $string = 'dispensing_and_manufacturing_'. $i;
      $dispencing_and_manufactuirng->$string = $request->$string;
  }

  for ($i = 1; $i <= 66; $i++)
  {
      $string = 'dispensing_and_manufacturing_remark_'. $i;
      $dispencing_and_manufactuirng->$string = $request->$string;
  }
  // dd($checklistTabletCompression->tablet_compress_remark_1)
  $dispencing_and_manufactuirng->dispensing_and_manufacturing_comment = $request->dispensing_and_manufacturing_comment;
  $dispencing_and_manufactuirng->save();

  // =======================new tebletointment packing ====
  $ointment_packing = IA_ointment_paking::where(['ia_id' => $id])->firstOrCreate();
  $ointment_packing->ia_id = $id;


  for ($i = 1; $i <= 51; $i++)
  {
      $string = 'ointment_packing_'. $i;
      $ointment_packing->$string = $request->$string;
  }

  for ($i = 1; $i <= 51; $i++)
  {
      $string = 'ointment_packing_remark_'. $i;
      $ointment_packing->$string = $request->$string;
  }
  // dd($checklistTabletCompression->tablet_compress_remark_1)
  $ointment_packing->ointment_packing_comment = $request->ointment_packing_comment;
  $ointment_packing->save();

   // =======================new engneering checklist ====
   $engineering_checklist = IA_checklist_engineering::where(['ia_id' => $id])->firstOrCreate();
   $engineering_checklist->ia_id = $id;

    /* ================= ENGINEERING (34) ================= */
for ($i = 1; $i <= 34; $i++) {
    $engineering_checklist->{'engineering_response_'.$i} = $request->{'engineering_response_'.$i} ?? null;
    $engineering_checklist->{'engineering_remark_'.$i}   = $request->{'engineering_remark_'.$i} ?? null;
}

/* ================= BUILDING (6) ================= */
for ($i = 1; $i <= 6; $i++) {
    $engineering_checklist->{'building_response_'.$i} = $request->{'building_response_'.$i} ?? null;
    $engineering_checklist->{'building_remark_'.$i}   = $request->{'building_remark_'.$i} ?? null;
}

/* ================= HVAC / HEPA (2) ================= */
for ($i = 1; $i <= 2; $i++) {
    $engineering_checklist->{'hvac_response_'.$i} = $request->{'hvac_response_'.$i} ?? null;
    $engineering_checklist->{'hvac_remark_'.$i}   = $request->{'hvac_remark_'.$i} ?? null;
}
//    for ($i = 1; $i <= 34; $i++)
//    {
//        $string = 'engineering_response_'. $i;
//        $engineering_checklist->$string = $request->$string;
//    }

//    for ($i = 1; $i <= 34; $i++)
//    {
//        $string = 'engineering_remark_'. $i;
//        $engineering_checklist->$string = $request->$string;
//    }
   // dd($checklistTabletCompression->tablet_compress_remark_1)
   $engineering_checklist->engineering_response_comment = $request->engineering_response_comment;
   $engineering_checklist->save();

    // =======================new quality control checklist ====
    $quality_control_checklist = IA_quality_control::where(['ia_id' => $id])->firstOrCreate();
    $quality_control_checklist->ia_id = $id;


    for ($i = 1; $i <= 99; $i++)
    {
        $string = 'quality_control_response_'. $i;
        $quality_control_checklist->$string = $request->$string;
    }

    for ($i = 1; $i <= 99; $i++)
    {
        $string = 'quality_control_remark__'. $i;
        $quality_control_checklist->$string = $request->$string;
    }
    // dd($checklistTabletCompression->tablet_compress_remark_1)
    $quality_control_checklist->quality_control_response_comment = $request->quality_control_response_comment;
    $quality_control_checklist->save();

 // =======================new checklist stores ====
 $checklist_stores = IA_checklist_stores::where(['ia_id' => $id])->firstOrCreate();
 $checklist_stores->ia_id = $id;


 for ($i = 1; $i <= 31; $i++)
 {
     $string = 'checklist_stores_response_'. $i;
     $checklist_stores->$string = $request->$string;
 }

 for ($i = 1; $i <= 31; $i++)
 {
     $string = 'checklist_stores_remark_'. $i;
     $checklist_stores->$string = $request->$string;
 }
 // dd($checklistTabletCompression->tablet_compress_remark_1)
 $checklist_stores->checklist_stores_response_comment = $request->checklist_stores_response_comment;
 $checklist_stores->save();


  // =======================new human resources ====
  $checklist_human_resources = IA_checklist_hr::where(['ia_id' => $id])->firstOrCreate();
  $checklist_human_resources->ia_id = $id;


  for ($i = 1; $i <= 35; $i++)
  {
      $string = 'checklist_hr_response_'. $i;
      $checklist_human_resources->$string = $request->$string;
  }

  for ($i = 1; $i <= 35; $i++)
  {
      $string = 'checklist_hr_remark_'. $i;
      $checklist_human_resources->$string = $request->$string;
  }
  // dd($checklistTabletCompression->tablet_compress_remark_1)
  $checklist_human_resources->checklist_hr_response_comment = $request->checklist_hr_response_comment;
  $checklist_human_resources->save();

  // =======================new human resources ====
  $checklist_production_dispensing = IA_checklist_dispensing::where(['ia_id' => $id])->firstOrCreate();
  $checklist_production_dispensing->ia_id = $id;


  for ($i = 1; $i <= 14; $i++)
  {
      $string = 'response_dispensing_'. $i;
      $checklist_production_dispensing->$string = $request->$string;
  }

  for ($i = 1; $i <= 14; $i++)
  {
      $string = 'remark_dispensing_'. $i;
      $checklist_production_dispensing->$string = $request->$string;
  }
  for ($i = 1; $i <= 50; $i++)
  {
      $string = 'response_injection_'. $i;
      $checklist_production_dispensing->$string = $request->$string;
  }

  for ($i = 1; $i <= 50; $i++)
  {
      $string = 'remark_injection_'. $i;
      $checklist_production_dispensing->$string = $request->$string;
  }
  for ($i = 1; $i <= 7; $i++)
  {
      $string = 'response_documentation_'. $i;
      $checklist_production_dispensing->$string = $request->$string;
  }

  for ($i = 1; $i <= 7; $i++)
  {
      $string = 'remark_documentation_'. $i;
      $checklist_production_dispensing->$string = $request->$string;
  }
  // dd($checklistTabletCompression->tablet_compress_remark_1)
  $checklist_production_dispensing->remark_documentation_name_comment = $request->remark_documentation_name_comment;
  $checklist_production_dispensing->save();

// ======================================checklist injecection production=================
  $checklist_production_injection = IA_checklist_production_injection::where(['ia_id' => $id])->firstOrCreate();
  $checklist_production_injection->ia_id = $id;



  for ($i = 1; $i <= 41; $i++)
  {
      $string = 'response_injection_packing_'. $i;
      $checklist_production_injection->$string = $request->$string;
  }

  for ($i = 1; $i <= 41; $i++)
  {
      $string = 'remark_injection_packing_'. $i;
      $checklist_production_injection->$string = $request->$string;
  }
  for ($i = 1; $i <= 6; $i++)
  {
      $string = 'response_documentation_production_'. $i;
      $checklist_production_injection->$string = $request->$string;
  }

  for ($i = 1; $i <= 6; $i++)
  {
      $string = 'remark_documentation_production_'. $i;
      $checklist_production_injection->$string = $request->$string;
  }
  // dd($checklistTabletCompression->tablet_compress_remark_1)
  $checklist_production_injection->response_injection_packing_comment = $request->response_injection_packing_comment;
  $checklist_production_injection->save();

  // ====================================== IA_checklist_manufacturing_filling =================
  $checklist_manufacturing_production = IA_checklist_manufacturing_filling::where(['ia_id' => $id])->firstOrCreate();
  $checklist_manufacturing_production->ia_id = $id;



  for ($i = 1; $i <= 44; $i++)
  {
      $string = 'response_powder_manufacturing_filling_'. $i;
      $checklist_manufacturing_production->$string = $request->$string;
  }

  for ($i = 1; $i <= 44; $i++)
  {
      $string = 'remark_powder_manufacturing_filling_'. $i;
      $checklist_manufacturing_production->$string = $request->$string;
  }
  for ($i = 1; $i <= 8; $i++)
  {
      $string = 'response_packing_'. $i;
      $checklist_manufacturing_production->$string = $request->$string;
  }

  for ($i = 1; $i <= 8; $i++)
  {
      $string = 'remark_packing_'. $i;
      $checklist_manufacturing_production->$string = $request->$string;
  }
  for ($i = 1; $i <= 6; $i++)
  {
      $string = 'powder_response_packing_'. $i;
      $checklist_manufacturing_production->$string = $request->$string;
  }
  for ($i = 1; $i <= 6; $i++)
  {
      $string = 'powder_remark_packing_'. $i;
      $checklist_manufacturing_production->$string = $request->$string;
  }
  // dd($checklistTabletCompression->tablet_compress_remark_1)
  $checklist_manufacturing_production->remark_powder_manufacturing_filling_comment = $request->remark_powder_manufacturing_filling_comment;
  $checklist_manufacturing_production->save();


   // ====================================== IA_checklist_analytical_research =================
   $checklist_analytical_research = IA_checklist_analytical_research::where(['ia_id' => $id])->firstOrCreate();
   $checklist_analytical_research->ia_id = $id;



   for ($i = 1; $i <= 26; $i++)
   {
       $string = 'response_analytical_research_development_'. $i;
       $checklist_analytical_research->$string = $request->$string;
   }

   for ($i = 1; $i <= 26; $i++)
   {
       $string = 'remark_analytical_research_development_'. $i;
       $checklist_analytical_research->$string = $request->$string;
   }

   // dd($checklistTabletCompression->tablet_compress_remark_1)
   $checklist_analytical_research->remark_analytical_research_comment = $request->remark_analytical_research_comment;
   $checklist_analytical_research->save();

 // ====================================== IA_checklist_analytical_research =================
 $checklist__formulation_research = IA_checklist__formulation_research::where(['ia_id' => $id])->firstOrCreate();
 $checklist__formulation_research->ia_id = $id;



 for ($i = 1; $i <= 24; $i++)
 {
     $string = 'response_formulation_research_development_'. $i;
     $checklist__formulation_research->$string = $request->$string;
 }

 for ($i = 1; $i <= 24; $i++)
 {
     $string = 'remark_formulation_research_development_'. $i;
     $checklist__formulation_research->$string = $request->$string;
 }

 // dd($checklistTabletCompression->tablet_compress_remark_1)
 $checklist__formulation_research->remark_formulation_research_development_comment = $request->remark_formulation_research_development_comment;
 $checklist__formulation_research->save();

        if (!empty($request->inv_attachment)) {
            if ($request->hasfile('inv_attachment')) {
                foreach ($request->file('inv_attachment') as $file) {
                    $name = $request->name . 'gi_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);

                    $files[] = $name;
                }
            }


            $internalAudit->inv_attachment = json_encode($files);
        }

        if (!empty($request->attach_file_rv)) {
            $files = [];
            if ($request->hasfile('attach_file_rv')) {
                foreach ($request->file('attach_file_rv') as $file) {
                    $name = $request->name . 'response_verify_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->attach_file_rv = json_encode($files);
        }

        if (!empty($request->file_attachment)) {
            $files = [];
            if ($request->hasfile('file_attachment')) {
                foreach ($request->file('file_attachment') as $file) {
                    $name = $request->name . 'acknowledgement_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
 if (!empty($request->inv_attachment)) {
            $files = [];
            if ($request->hasfile('inv_attachment')) {
                foreach ($request->file('inv_attachment') as $file) {
                    $name = $request->name . 'gi_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->inv_attachment = json_encode($files);
        }

            $internalAudit->file_attachment = json_encode($files);
        }
        if (!empty($request->file_attachment_guideline)) {
            $files = [];
            if ($request->hasfile('file_attachment_guideline')) {
                foreach ($request->file('file_attachment_guideline') as $file) {
                    $name = $request->name . 'auditpreparation_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->file_attachment_guideline= json_encode($files);
        }

        if (!empty($request->auditSheChecklist_attachment_main)) {
            $files = [];
            if ($request->hasfile('auditSheChecklist_attachment_main')) {
                foreach ($request->file('auditSheChecklist_attachment_main') as $file) {
                    $name = $request->name . 'auditSheChecklist_attachment_main' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->auditSheChecklist_attachment_main= json_encode($files);
        }


        if (!empty($request->Audit_file)) {
            $files = [];
            if ($request->hasfile('Audit_file')) {
                foreach ($request->file('Audit_file') as $file) {
                    $name = $request->name . 'Audit_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->Audit_file = json_encode($files);
        }

        if (!empty($request->report_file)) {
            $files = [];
            if ($request->hasfile('report_file')) {
                foreach ($request->file('report_file') as $file) {
                    $name = $request->name . 'report_file' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->report_file = json_encode($files);
        }

        if (!empty($request->myfile)) {
            $files = [];
            if ($request->hasfile('myfile')) {
                foreach ($request->file('myfile') as $file) {
                    $name = $request->name . 'audit_response' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->myfile = json_encode($files);
        }
        if (!empty($request->supproting_attachment)) {
            $files = [];
            if ($request->hasfile('supproting_attachment')) {
                foreach ($request->file('supproting_attachment') as $file) {
                    $name = $request->name . 'supproting_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->supproting_attachment = json_encode($files);
        }

        if (!empty($request->tablet_coating_supporting_attachment)) {
            $files = [];
            if ($request->hasfile('tablet_coating_supporting_attachment')) {
                foreach ($request->file('tablet_coating_supporting_attachment') as $file) {
                    $name = $request->name . 'tablet_coating_supporting_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->tablet_coating_supporting_attachment = json_encode($files);
        }
        if (!empty($request->dispensing_and_manufacturing_attachment)) {
            $files = [];
            if ($request->hasfile('dispensing_and_manufacturing_attachment')) {
                foreach ($request->file('dispensing_and_manufacturing_attachment') as $file) {
                    $name = $request->name . 'dispensing_and_manufacturing_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->dispensing_and_manufacturing_attachment = json_encode($files);

        }
        if (!empty($request->ointment_packing_attachment)) {
            $files = [];
            if ($request->hasfile('ointment_packing_attachment')) {
                foreach ($request->file('ointment_packing_attachment') as $file) {
                    $name = $request->name . 'ointment_packing_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->ointment_packing_attachment = json_encode($files);
        }
        if (!empty($request->engineering_response_attachment)) {
            $files = [];
            if ($request->hasfile('engineering_response_attachment')) {
                foreach ($request->file('engineering_response_attachment') as $file) {
                    $name = $request->name . 'engineering_response_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->engineering_response_attachment = json_encode($files);
        }
        if (!empty($request->quality_control_response_attachment)) {
            $files = [];
            if ($request->hasfile('quality_control_response_attachment')) {
                foreach ($request->file('quality_control_response_attachment') as $file) {
                    $name = $request->name . 'quality_control_response_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->quality_control_response_attachment = json_encode($files);
        }
        if (!empty($request->checklist_stores_response_attachment)) {
            $files = [];
            if ($request->hasfile('checklist_stores_response_attachment')) {
                foreach ($request->file('checklist_stores_response_attachment') as $file) {
                    $name = $request->name . 'checklist_stores_response_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->checklist_stores_response_attachment = json_encode($files);
        }
        if (!empty($request->checklist_hr_response_attachment)) {
            $files = [];
            if ($request->hasfile('checklist_hr_response_attachment')) {
                foreach ($request->file('checklist_hr_response_attachment') as $file) {
                    $name = $request->name . 'checklist_hr_response_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->checklist_hr_response_attachment = json_encode($files);
        }
        if (!empty($request->remark_injection_packing_attachment)) {
            $files = [];
            if ($request->hasfile('remark_injection_packing_attachment')) {
                foreach ($request->file('remark_injection_packing_attachment') as $file) {
                    $name = $request->name . 'remark_injection_packing_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->remark_injection_packing_attachment = json_encode($files);
        }
        if (!empty($request->remark_analytical_research_attachment)) {
            $files = [];
            if ($request->hasfile('remark_analytical_research_attachment')) {
                foreach ($request->file('remark_analytical_research_attachment') as $file) {
                    $name = $request->name . 'remark_analytical_research_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->remark_analytical_research_attachment = json_encode($files);
        }
        if (!empty($request->remark_powder_manufacturing_filling_attachment)) {
            $files = [];
            if ($request->hasfile('remark_powder_manufacturing_filling_attachment')) {
                foreach ($request->file('remark_powder_manufacturing_filling_attachment') as $file) {
                    $name = $request->name . 'remark_powder_manufacturing_filling_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->remark_powder_manufacturing_filling_attachment = json_encode($files);
        }
        if (!empty($request->remark_formulation_research_development_attachment)) {
            $files = [];
            if ($request->hasfile('remark_formulation_research_development_attachment')) {
                foreach ($request->file('remark_formulation_research_development_attachment') as $file) {
                    $name = $request->name . 'remark_formulation_research_development_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->remark_formulation_research_development_attachment = json_encode($files);
        }
        if (!empty($request->remark_documentation_name_attachment)) {
            $files = [];
            if ($request->hasfile('remark_documentation_name_attachment')) {
                foreach ($request->file('remark_documentation_name_attachment') as $file) {
                    $name = $request->name . 'remark_documentation_name_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->remark_documentation_name_attachment = json_encode($files);
        }
        if (!empty($request->tablet_capsule_packing_attachmen)) {
            $files = [];
            if ($request->hasfile('tablet_capsule_packing_attachmen')) {
                foreach ($request->file('tablet_capsule_packing_attachmen') as $file) {
                    $name = $request->name . 'tablet_capsule_packing_attachmen' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->tablet_capsule_packing_attachmen = json_encode($files);
        }
        if (!empty($request->file_attach_add_2)) {
            $files = [];
            if ($request->hasfile('file_attach_add_2')) {
                foreach ($request->file('file_attach_add_2') as $file) {
                    $name = $request->name . 'file_attach_add_2' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->file_attach_add_2 = json_encode($files);
        }
        if (!empty($request->file_attach_add_1)) {
            $files = [];
            if ($request->hasfile('file_attach_add_1')) {
                foreach ($request->file('file_attach_add_1') as $file) {
                    $name = $request->name . 'file_attach_add_1' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->file_attach_add_1 = json_encode($files);
        }

        if (!empty($request->file_attach)) {
            $files = [];
            if ($request->hasfile('file_attach')) {
                foreach ($request->file('file_attach') as $file) {
                    $name = $request->name . 'file_attach' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->file_attach = json_encode($files);
        }

        if (!empty($request->file_attach_capsule)) {
            $files = [];
            if ($request->hasfile('file_attach_capsule')) {
                foreach ($request->file('file_attach_capsule') as $file) {
                    $name = $request->name . 'file_attach_capsule' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->file_attach_capsule = json_encode($files);
        }

        $auditorsNew = InternalAuditGrid::where(['audit_id' => $id, 'identifier' => 'Audit Agenda'])->firstOrCreate();
        $auditorsNew->audit_id = $id;
        $auditorsNew->identifier = 'Audit Agenda';
        $auditAgendaData = $request->auditAgendaData;
        if (!empty($auditAgendaData) && is_array($auditAgendaData)) {
            foreach ($auditAgendaData as $index => $row) {
                if (isset($row['auditors']) && is_array($row['auditors'])) {
                    $row['auditors'] = implode(',', $row['auditors']);
                }

                if (isset($row['auditee']) && is_array($row['auditee'])) {
                    $row['auditee'] = implode(',', $row['auditee']);
                }
            }
        }
        $auditorsNew->data = $auditAgendaData;
        $auditorsNew->update();








        if ($lastDocument->short_description != $internalAudit->short_description || !empty($request->comment)) {

            $history = new RootAuditTrial();
            $history->root_id = $id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastDocument->short_description;
            $history->current = $internalAudit->short_description;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
                if (is_null($lastDocument->short_description) || $lastDocument->short_description === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }



            $history->save();
        }

        // if ($lastDocument->date != $internalAudit->date || !empty($request->date_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'Date of Initiator';
        //     $history->previous = $lastDocument->date;
        //     $history->current = $internalAudit->date;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        // if ($lastDocument->assign_to != $internalAudit->assign_to || !empty($request->assign_to_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'Auditee Department Head';
        //     $history->previous = $lastDocument->assign_to;
        //     $history->current = $internalAudit->assign_to;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }





        if ($lastDocument->assign_to != $request->assign_to) {
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $id)
            ->where('activity_type', 'Auditee Department Head')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Auditee Department Head';
            $history->previous = Helpers::getInitiatorName($lastDocument->assign_to);
            $history->current =Helpers::getInitiatorName($internalAudit->assign_to);
            $history->comment = $request->assign_to_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        // if ($lastDocument->Initiator_Group!= $internalAudit->Initiator_Group|| !empty($request->Initiator_Group_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'Initiator Department ';
        //     $history->previous = $lastDocument->Initiator_Group;
        //     $history->current = $internalAudit->Initiator_Group;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }


        // dd(Helpers::getInitiatorGroupData($internalAudit->Initiator_Group));
        // dd($request->Initiator_Group);
        // dd($request->Initiator_Group);
        if($lastDocument->Initiator_Group != $request->Initiator_Group){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Initiator Department ')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Initiator Department ';
            if($lastDocument->Initiator_Group == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = Helpers::getFullDepartmentName($lastDocument->Initiator_Group);
            }
            $history->current = Helpers::getFullDepartmentName($request->Initiator_Group);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if($lastDocument->initiator_group_code != $request->initiator_group_code){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Initiator Department  Code')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Initiator Department  Code';
            if($lastDocument->initiator_group_code == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->initiator_group_code;
            }
            $history->current = $request->initiator_group_code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if($lastDocument->res_ver != $request->res_ver){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Response Verification Comment')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Response Verification Comment';
            if($lastDocument->res_ver == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->res_ver;
            }
            $history->current = $request->res_ver;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        // if($lastDocument->attach_file_rv != $request->attach_file_rv){
        //     $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
        //     ->where('activity_type', 'Response verification Attachments')
        //     ->exists();
        //     $history = new InternalAuditTrial;
        //     $history->InternalAudit_id = $lastDocument->id;
        //     $history->activity_type = 'Response verification Attachments';
        //     if($lastDocument->attach_file_rv == null){
        //         $history->previous = "Not Applicable";
        //     } else{
        //         $history->previous = $lastDocument->attach_file_rv;
        //     }
        //     $history->current = $request->attach_file_rv;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
        //     $history->save();
        // }

        $previousAttachments5 = $lastDocument->attach_file_rv;
        $areIniAttachmentsSame5 = $previousAttachments5 == $internalAudit->attach_file_rv;

        if ($areIniAttachmentsSame5 != true) {
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
                ->where('activity_type', 'Response verification Attachments')
                ->exists();
                    $history = new InternalAuditTrial;
                    $history->InternalAudit_id = $id;
                    $history->activity_type = 'Response verification Attachments';
                    $history->previous = $previousAttachments5;
                    $history->current = $internalAudit->attach_file_rv;
                    $history->comment = "Not Applicable";
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Not Applicable";
                    $history->change_from = $lastDocument->status;
                    if ($lastDocumentAuditTrail) {
                        $history->action_name = "Update";
                    } else {
                        $history->action_name = "New";
                    }
                    $history->save();
                }

        // if ($lastDocument->short_description != $internalAudit->short_description || !empty($request->short_description_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'Short Description';
        //     $history->previous = $lastDocument->short_description;
        //     $history->current = $internalAudit->short_description;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        // dd($lastDocument->short_description != $request->short_description);

        if($lastDocument->short_description != $request->short_description){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Short Description')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Short Description';
            if($lastDocument->short_description == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->short_description;
            }
            $history->current = $request->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            // dd($history->current);
            $history->save();
        }
        if($lastDocument->due_date != $request->due_date){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Due Date')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Due Date';
            if($lastDocument->due_date == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = Helpers::getdateFormat($lastDocument->due_date);
            }
            $history->current =Helpers::getdateFormat( $request->due_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        // dd($lastDocument->auditee_department != $request->auditee_department);
        if($lastDocument->auditee_department != $request->auditee_department){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Auditee department Name')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Auditee department Name';
            if($lastDocument->auditee_department == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous =Helpers::getFullDepartmentName($lastDocument->auditee_department);
            }
            $history->current = Helpers::getFullDepartmentName($request->auditee_department);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if($lastDocument->sch_audit_start_date != $request->sch_audit_start_date){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Scheduled audit date')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Scheduled audit date';
            if($lastDocument->sch_audit_start_date == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous =  Helpers::getdateFormat($lastDocument->sch_audit_start_date);
            }
            $history->current =  Helpers::getdateFormat($request->sch_audit_start_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if($lastDocument->Auditee_comment != $request->Auditee_comment){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Auditee Comment')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Auditee Comment';
            if($lastDocument->Auditee_comment == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->Auditee_comment;
            }
            $history->current = $request->Auditee_comment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if($lastDocument->Auditor_comment != $request->Auditor_comment){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Auditor Comment')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Auditor Comment';
            if($lastDocument->Auditor_comment == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->Auditor_comment;
            }
            $history->current = $request->Auditor_comment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if($lastDocument->initiated_through != $request->initiated_through){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Initiated Through')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Initiated Through';
            if($lastDocument->initiated_through == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->initiated_through;
            }
            $history->current = $request->initiated_through;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        // if ($lastDocument->audit_type != $internalAudit->audit_type || !empty($request->audit_type_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'Type of Audit';
        //     $history->previous = $lastDocument->audit_type;
        //     $history->current = $internalAudit->audit_type;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }

        // if($lastDocument->audit_type != $request->audit_type){
        //     $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
        //     ->where('activity_type', 'Type of Audit')
        //     ->exists();
        //     $history = new InternalAuditTrial;
        //     $history->InternalAudit_id = $lastDocument->id;
        //     $history->activity_type = 'Type of Audit';
        //     if($lastDocument->audit_type == null){
        //         $history->previous = "Not Applicable";
        //     } else{
        //         $history->previous = $lastDocument->audit_type;
        //     }
        //     $history->current = $request->audit_type;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
        //     $history->save();
        // }

        // if ($lastDocument->if_other != $internalAudit->if_other || !empty($request->if_other_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'If Other';
        //     $history->previous = $lastDocument->if_other;
        //     $history->current = $internalAudit->if_other;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }

        // if($lastDocument->if_other != $request->if_other){
        //     $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
        //     ->where('activity_type', 'If Other')
        //     ->exists();
        //     $history = new InternalAuditTrial;
        //     $history->InternalAudit_id = $lastDocument->id;
        //     $history->activity_type = 'If Other';
        //     if($lastDocument->if_other == null){
        //         $history->previous = "Not Applicable";
        //     } else{
        //         $history->previous = $lastDocument->if_other;
        //     }
        //     $history->current = $request->if_other;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
        //     $history->save();
        // }

        if($lastDocument->initiated_if_other != $request->initiated_if_other){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Other')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Other';
            if($lastDocument->initiated_if_other == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->initiated_if_other;
            }
            $history->current = $request->initiated_if_other;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        // if ($lastDocument->initial_comments != $internalAudit->initial_comments || !empty($request->initial_comments_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'Initial Comments';
        //     $history->previous = $lastDocument->initial_comments;
        //     $history->current = $internalAudit->initial_comments;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }


        if($lastDocument->initial_comments != $request->initial_comments){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Description')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Description';
            if($lastDocument->initial_comments == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->initial_comments;
            }
            $history->current = $request->initial_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if($lastDocument->external_agencies != $request->external_agencies){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'External Agencies')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'External Agencies';
            if($lastDocument->external_agencies == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->external_agencies;
            }
            $history->current = $request->external_agencies;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }


        if($lastDocument->Others != $request->Others){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Others')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Others';
            if($lastDocument->Others == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->Others;
            }
            $history->current = $request->Others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if($lastDocument->audit_schedule_start_date != $request->audit_schedule_start_date){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Audit Start')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Audit Start';
            if($lastDocument->audit_schedule_start_date == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->audit_schedule_start_date;
            }
            $history->current = $request->audit_schedule_start_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if($lastDocument->audit_schedule_end_date != $request->audit_schedule_end_date){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'End Date')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'End Date';
            if($lastDocument->audit_schedule_end_date == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->audit_schedule_end_date;
            }
            $history->current = $request->audit_schedule_end_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if($lastDocument->material_name != $request->material_name){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Product/Material Name')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Product/Material Name';
            if($lastDocument->material_name == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->material_name;
            }
            $history->current = $request->material_name;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }


        if($lastDocument->if_comments != $request->if_comments){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Comments(If Any)')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Comments(If Any)';
            if($lastDocument->if_comments == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->if_comments;
            }
            $history->current = $request->if_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if($lastDocument->lead_auditor != $request->lead_auditor){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Lead Auditor')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Lead Auditor';
            if($lastDocument->lead_auditor == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->lead_auditor;
            }
            $history->current = $request->lead_auditor;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if($lastDocument->Auditor_Details != $request->Auditor_Details){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'External Auditor Details')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'External Auditor Details';
            if($lastDocument->Auditor_Details == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->Auditor_Details;
            }
            $history->current = $request->Auditor_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if($lastDocument->External_Auditing_Agency != $request->External_Auditing_Agency){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'External Auditing Agency')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'External Auditing Agency';
            if($lastDocument->External_Auditing_Agency == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->External_Auditing_Agency;
            }
            $history->current = $request->External_Auditing_Agency;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

        if($lastDocument->Relevant_Guideline != $request->Relevant_Guideline){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Relevant Guidelines / Industry Standards')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Relevant Guidelines / Industry Standards';
            if($lastDocument->Relevant_Guideline == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->Relevant_Guideline;
            }
            $history->current = $request->Relevant_Guideline;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if($lastDocument->QA_Comments != $request->QA_Comments){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'QA Comments')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'QA Comments';
            if($lastDocument->QA_Comments == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->QA_Comments;
            }
            $history->current = $request->QA_Comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if($lastDocument->Audit_Category != $request->Audit_Category){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Audit Category')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Audit Category';
            if($lastDocument->Audit_Category == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->Audit_Category;
            }
            $history->current = $request->Audit_Category;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if($lastDocument->Supplier_Details != $request->Supplier_Details){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Supplier/Vendor/Manufacturer Details')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Supplier/Vendor/Manufacturer Details';
            if($lastDocument->Supplier_Details == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->Supplier_Details;
            }
            $history->current = $request->Supplier_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if($lastDocument->Supplier_Site != $request->Supplier_Site){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Supplier/Vendor/Manufacturer Site')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Supplier/Vendor/Manufacturer Site';
            if($lastDocument->Supplier_Site == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->Supplier_Site;
            }
            $history->current = $request->Supplier_Site;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if($lastDocument->Comments != $request->Comments){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Comments')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Comments';
            if($lastDocument->Comments == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->Comments;
            }
            $history->current = $request->Comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if($lastDocument->audit_start_date != $request->audit_start_date){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Audit Start Date')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Audit Start Date';
            if($lastDocument->audit_start_date == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous =Helpers::getdateFormat ($lastDocument->audit_start_date);
            }
            $history->current = Helpers::getdateFormat($request->audit_start_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if($lastDocument->audit_end_date != $request->audit_end_date){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Audit End Date')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Audit End Date';
            if($lastDocument->audit_end_date == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = Helpers::getdateFormat ($lastDocument->audit_end_date);
            }
            $history->current =Helpers::getdateFormat( $request->audit_end_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if($lastDocument->severity_level_form != $request->severity_level_form){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Observation Category')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Observation Category';
            if($lastDocument->severity_level_form == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->severity_level_form;
            }
            $history->current = $request->severity_level_form;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if($lastDocument->Audit_Comments1 != $request->Audit_Comments1){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Audit Comments')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Audit Comments';
            if($lastDocument->Audit_Comments1 == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->Audit_Comments1;
            }
            $history->current = $request->Audit_Comments1;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if($lastDocument->Remarks != $request->Remarks){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Remarks')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Remarks';
            if($lastDocument->Remarks == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->Remarks;
            }
            $history->current = $request->Remarks;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        if($lastDocument->Audit_Comments2 != $request->Audit_Comments2){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Audit Comments')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Audit Comments';
            if($lastDocument->Audit_Comments2 == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->Audit_Comments2;
            }
            $history->current = $request->Audit_Comments2;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }
        // if ($lastDocument->file_attachment_guideline != $internalAudit->file_attachment_guideline || !empty($request->file_attachment_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'Audit Preparation and Execution Attachment';
        //     $history->previous = $lastDocument->file_attachment_guideline;
        //     $history->current = $internalAudit->file_attachment_guideline;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        if($lastDocument->due_date_extension != $request->due_date_extension){
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
            ->where('activity_type', 'Due Date Extension Justification')
            ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $lastDocument->id;
            $history->activity_type = 'Due Date Extension Justification';
            if($lastDocument->due_date_extension == null){
                $history->previous = "Not Applicable";
            } else{
                $history->previous = $lastDocument->due_date_extension;
            }
            $history->current = $request->due_date_extension;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            $history->action_name = $lastDocumentAuditTrail ? 'Update' : 'New';
            $history->save();
        }

$previousAttachments = $lastDocument->inv_attachment;
$areIniAttachmentsSame = $previousAttachments == $internalAudit->inv_attachment;

if ($areIniAttachmentsSame != true) {
    $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
        ->where('activity_type', 'GI Attachment')
        ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $id;
            $history->activity_type = 'GI Attachment';
            $history->previous = $previousAttachments;
            $history->current = $internalAudit->inv_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if ($lastDocumentAuditTrail) {
                $history->action_name = "Update";
            } else {
                $history->action_name = "New";
            }
            $history->save();
        }



$previousAttachments1 = $lastDocument->file_attachment;
$areIniAttachmentsSame1 = $previousAttachments1 == $internalAudit->file_attachment;

if ($areIniAttachmentsSame1 != true) {
    $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
        ->where('activity_type', 'Acknowledgement Attachment')
        ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Acknowledgement Attachment';
            $history->previous = $previousAttachments1;
            $history->current = $internalAudit->file_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if ($lastDocumentAuditTrail) {
                $history->action_name = "Update";
            } else {
                $history->action_name = "New";
            }
            $history->save();
        }



$previousAttachments2 = $lastDocument->file_attachment_guideline;
$areIniAttachmentsSame2 = $previousAttachments2 == $internalAudit->file_attachment_guideline;

if ($areIniAttachmentsSame2 != true) {
    $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
        ->where('activity_type', 'Guideline Attachment')
        ->exists();
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Audit Preparation and Execution Attachment';
            $history->previous = $previousAttachments2;
            $history->current = $internalAudit->file_attachment_guideline;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if ($lastDocumentAuditTrail) {
                $history->action_name = "Update";
            } else {
                $history->action_name = "New";
            }
            $history->save();
        }


        $previousAttachments3 = $lastDocument->Audit_file;
        $areIniAttachmentsSame3 = $previousAttachments3 == $internalAudit->Audit_file;

        if ($areIniAttachmentsSame2 != true) {
            // Check if a similar record already exists
            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
                ->where('activity_type', 'Audit Preparation and Execution Attachment') // Match specific activity
                ->where('previous', $previousAttachments2) // Match the previous value
                ->where('current', $internalAudit->file_attachment_guideline) // Match the current value
                ->exists();

            // Prepare the new history entry
            $history = new InternalAuditTrial;
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Audit Preparation and Execution Attachment';
            $history->previous = $previousAttachments2;
            $history->current = $internalAudit->file_attachment_guideline;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            // Determine if it's a new entry or an update
            if ($lastDocumentAuditTrail) {
                $history->action_name = "Update"; // Entry exists, treat as an update
            } else {
                $history->action_name = "New"; // No similar entry, treat as new
            }

            // Save the history record
            $history->save();
        }

                $previousAttachments4 = $lastDocument->report_file;
                $areIniAttachmentsSame4 = $previousAttachments4 == $internalAudit->report_file;

                if ($areIniAttachmentsSame4 != true) {
                    $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
                        ->where('activity_type', 'Report Attachment')
                        ->exists();
                            $history = new InternalAuditTrial;
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Report Attachment';
                            $history->previous = $previousAttachments4;
                            $history->current = $internalAudit->report_file;
                            $history->comment = "Not Applicable";
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            if ($lastDocumentAuditTrail) {
                                $history->action_name = "Update";
                            } else {
                                $history->action_name = "New";
                            }
                            $history->save();
                        }


                $previousAttachments5 = $lastDocument->myfile;
                $areIniAttachmentsSame5 = $previousAttachments5 == $internalAudit->myfile;

                if ($areIniAttachmentsSame5 != true) {
                    $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
                        ->where('activity_type', 'Audit Attachment')
                        ->exists();
                            $history = new InternalAuditTrial;
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Audit Attachment';
                            $history->previous = $previousAttachments5;
                            $history->current = $internalAudit->myfile;
                            $history->comment = "Not Applicable";
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->change_to =   "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            if ($lastDocumentAuditTrail) {
                                $history->action_name = "Update";
                            } else {
                                $history->action_name = "New";
                            }
                            $history->save();
                        }


                        $checklist1 = Helpers::getfullnameChecklist($lastDocument->checklists);
                        $checklistdata1 = $checklist1 == Helpers::getfullnameChecklist($internalAudit->checklists);
                        // dd($lastDocument->checklists);
                            // dd($checklistdata1);
                        if ($checklistdata1 != true) {
                            $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
                                ->where('activity_type', 'Checklists')
                                ->exists();
                                    $history = new InternalAuditTrial;
                                    $history->InternalAudit_id = $id;
                                    $history->activity_type = 'Checklists';
                                    $history->previous = $checklist1;
                                    $history->current = Helpers::getfullnameChecklist($internalAudit->checklists);
                                    // $history->current = $internalAudit->checklists;
                                    $history->comment = "Not Applicable";
                                    $history->user_id = Auth::user()->id;
                                    $history->user_name = Auth::user()->name;
                                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                    $history->origin_state = $lastDocument->status;
                                    $history->change_to =   "Not Applicable";
                                    $history->change_from = $lastDocument->status;
                                    if ($lastDocumentAuditTrail) {
                                        $history->action_name = "Update";
                                    } else {
                                        $history->action_name = "New";
                                    }
                                    $history->save();
                                }


                                $reference_record = $lastDocument->refrence_record;
                                $reference_record_data = $reference_record == $internalAudit->refrence_record;

                                if ($reference_record_data != true) {
                                    $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
                                        ->where('activity_type', 'Reference Record')
                                        ->exists();
                                            $history = new InternalAuditTrial;
                                            $history->InternalAudit_id = $id;
                                            $history->activity_type = 'Reference Record';
                                            $history->previous = str_replace(',', ', ', $reference_record);
                                            $history->current =  str_replace(',', ', ',$internalAudit->refrence_record);
                                            $history->comment = "Not Applicable";
                                            $history->user_id = Auth::user()->id;
                                            $history->user_name = Auth::user()->name;
                                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                            $history->origin_state = $lastDocument->status;
                                            $history->change_to =   "Not Applicable";
                                            $history->change_from = $lastDocument->status;
                                            if ($lastDocumentAuditTrail) {
                                                $history->action_name = "Update";
                                            } else {
                                                $history->action_name = "New";
                                            }
                                            $history->save();
                                        }

                                // $Audit_team = $lastDocument->Audit_team;
                                // $Audit_team_data = $Audit_team == $internalAudit->Audit_team;

                                // if ($Audit_team_data != true) {
                                //     $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
                                //         ->where('activity_type', 'Audit Team')
                                //         ->exists();
                                //             $history = new InternalAuditTrial;
                                //             $history->InternalAudit_id = $id;
                                //             $history->activity_type = 'Audit Team';
                                //             $history->previous = $Audit_team;
                                //             $history->current = $internalAudit->Audit_team;
                                //             $history->comment = "Not Applicable";
                                //             $history->user_id = Auth::user()->id;
                                //             $history->user_name = Auth::user()->name;
                                //             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                //             $history->origin_state = $lastDocument->status;
                                //             $history->change_to =   "Not Applicable";
                                //             $history->change_from = $lastDocument->status;
                                //             if ($lastDocumentAuditTrail) {
                                //                 $history->action_name = "Update";
                                //             } else {
                                //                 $history->action_name = "New";
                                //             }
                                //             $history->save();
                                //         }


                                        // $Auditee = $lastDocument->Auditee;
                                        // $Auditee_data = $Auditee == $internalAudit->Auditee;

                                        // if ($Auditee_data != true) {
                                        //     $lastDocumentAuditTrail = InternalAuditTrial::where('InternalAudit_id', $internalAudit->id)
                                        //         ->where('activity_type', 'Auditee')
                                        //         ->exists();
                                        //             $history = new InternalAuditTrial;
                                        //             $history->InternalAudit_id = $id;
                                        //             $history->activity_type = 'Auditee';
                                        //             $history->previous = $Auditee;
                                        //             $history->current = $internalAudit->Auditee;
                                        //             $history->comment = "Not Applicable";
                                        //             $history->user_id = Auth::user()->id;
                                        //             $history->user_name = Auth::user()->name;
                                        //             $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                        //             $history->origin_state = $lastDocument->status;
                                        //             $history->change_to =   "Not Applicable";
                                        //             $history->change_from = $lastDocument->status;
                                        //             if ($lastDocumentAuditTrail) {
                                        //                 $history->action_name = "Update";
                                        //             } else {
                                        //                 $history->action_name = "New";
                                        //             }
                                        //             $history->save();
                                        //         }



        // if ($lastDocument->report_file != $internalAudit->report_file || !empty($request->report_file_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'Report Attachments';
        //     $history->previous = $lastDocument->report_file;
        //     $history->current = $internalAudit->report_file;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        // if ($lastDocument->myfile != $internalAudit->myfile || !empty($request->myfile_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'GI Attachment';
        //     $history->previous = $lastDocument->myfile;
        //     $history->current = $internalAudit->myfile;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        // if ($lastDocument->myfile != $internalAudit->myfile || !empty($request->myfile_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'GI Attachment';
        //     $history->previous = $lastDocument->myfile;
        //     $history->current = $internalAudit->myfile;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        // if ($lastDocument->due_date != $internalAudit->due_date || !empty($request->due_date_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'Due Date';
        //     $history->previous = $lastDocument->due_date;
        //     $history->current = $internalAudit-internalAudit>due_date;
                // $history->current =  Helpers::getdateFormat( $root->due_date);
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        // if ($lastDocument->audit_start_date!= $internalAudit->audit_start_date || !empty($request->audit_start_date_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'Audit Start Date';
        //     $history->previous = $lastDocument->audit_start_date;
        //     $history->current = $internalAudit->audit_start_date;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        // if ($lastDocument->audit_end_date != $internalAudit->audit_end_date || !empty($request->audit_end_date_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'Audit End Date';
        //     $history->previous = $lastDocument->audit_end_date;
        //     $history->current = $internalAudit->audit_end_date;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }


        $internalAudit->update();



        $Summary = $internalAudit->id;
        $AuditorsNew = InternalAuditorGrid::where(['auditor_id' => $Summary, 'identifier' => 'Auditors'])->firstOrNew();
        $AuditorsNew->auditor_id = $Summary;
        $AuditorsNew->identifier = 'Auditors';
        $AuditorsNew->data = $request->AuditorNew;
        $AuditorsNew->update();

        //if (!empty($request->AuditorNew)) {
        //    // Fetch existing auditor data
        //    $existingAuditorShow = InternalAuditorGrid::where(['auditor_id' => $Summary, 'identifier' => 'Auditors'])->first();
        //    $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

        //    if($internalAudit->stage == 1){
        //        $AuditorsNew = InternalAuditorGrid::where(['auditor_id' => $Summary, 'identifier' => 'Auditors'])->firstOrNew();
        //        $AuditorsNew->auditor_id = $Summary;
        //        $AuditorsNew->identifier = 'Auditors';
        //        $AuditorsNew->data = $request->AuditorNew;
        //        $AuditorsNew->update();
        //    }
        //    //dd($product);
        //    // Define the mapping of field keys to more descriptive names
        //    $fieldNames = [
        //        'auditornew' => 'Auditor Name',
        //        'regulatoryagency' => 'Department',
        //        'designation' => 'Designation',
        //        'remarks' => 'Remarks',

        //    ];

        //    // Track audit trail changes
        //    if (is_array($request->AuditorNew)) {
        //        foreach ($request->AuditorNew as $index => $newAuditor) {
        //            $previousAuditor = $existingAuditorData[$index] ?? [];

        //            // Track changes for each field
        //            $fieldsToTrack = ['auditornew', 'regulatoryagency', 'designation', 'remarks'];
        //            foreach ($fieldsToTrack as $field) {
        //                $oldValue = $previousAuditor[$field] ?? 'Null';
        //                $newValue = $newAuditor[$field] ?? 'Null';

        //                // Only proceed if there's a change or the data is new
        //                if ($oldValue !== $newValue) {
        //                    // Check if this specific change has already been logged in the audit trail
        //                    $existingAuditTrail = InternalAuditTrial::where([
        //                        ['InternalAudit_id', '=', $internalAudit->id],
        //                        ['activity_type', '=', $fieldNames[$field] . ' ( ' . ($index + 1) . ')'],
        //                        ['previous', '=', $oldValue],
        //                        ['current', '=', $newValue]
        //                    ])->first();

        //                    // Determine if the data is new or updated
        //                    $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

        //                    // If no existing audit trail record, log the change
        //                    if (!$existingAuditTrail) {
        //                        $auditTrail = new InternalAuditTrial;
        //                        $auditTrail->InternalAudit_id = $internalAudit->id;
        //                        $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
        //                        $auditTrail->previous = $oldValue;
        //                        $auditTrail->current = $newValue;
        //                        $auditTrail->comment = "";
        //                        $auditTrail->user_id = Auth::user()->id;
        //                        $auditTrail->user_name = Auth::user()->name;
        //                        $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //                        $auditTrail->origin_state = $internalAudit->status;
        //                        $auditTrail->change_to = "Not Applicable";
        //                        $auditTrail->change_from = $internalAudit->status;
        //                        $auditTrail->action_name = $actionName; // Set action to New or Update
        //                        $auditTrail->save();
        //                    }
        //                }
        //            }
        //        }
        //    }
        //}




        $internal_id = $internalAudit->id;
        $newDataGridInternalAudits = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'observations'])->firstOrNew();
        $newDataGridInternalAudits->io_id = $internal_id;
        $newDataGridInternalAudits->identifier = 'observations';
        $newDataGridInternalAudits->data = $request->observations;
        $newDataGridInternalAudits->save();

        //if (!empty($request->observations)) {
        //    // Fetch existing auditor data
        //    $existingAuditorShow = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'observations'])->first();
        //    $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

        //    if($internalAudit->stage == 1){
        //        $newDataGridInternalAudits = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'observations'])->firstOrNew();
        //        $newDataGridInternalAudits->io_id = $internal_id;
        //        $newDataGridInternalAudits->identifier = 'observations';
        //        $newDataGridInternalAudits->data = $request->observations;
        //        $newDataGridInternalAudits->save();
        //    }
        //    //dd($product);
        //    // Define the mapping of field keys to more descriptive names
        //    $fieldNames = [
        //        'observation' => 'Observations/Discrepancy',
        //        'category' => 'Category',
        //        'remarks' => 'Remarks',

        //    ];

        //    // Track audit trail changes
        //    if (is_array($request->observations)) {
        //        foreach ($request->observations as $index => $newAuditor) {
        //            $previousAuditor = $existingAuditorData[$index] ?? [];

        //            // Track changes for each field
        //            $fieldsToTrack = ['observation', 'category', 'remarks'];
        //            foreach ($fieldsToTrack as $field) {
        //                $oldValue = $previousAuditor[$field] ?? 'Null';
        //                $newValue = $newAuditor[$field] ?? 'Null';

        //                // Only proceed if there's a change or the data is new
        //                if ($oldValue !== $newValue) {
        //                    // Check if this specific change has already been logged in the audit trail
        //                    $existingAuditTrail = InternalAuditTrial::where([
        //                        ['InternalAudit_id', '=', $internalAudit->id],
        //                        ['activity_type', '=', $fieldNames[$field] . ' ( ' . ($index + 1) . ')'],
        //                        ['previous', '=', $oldValue],
        //                        ['current', '=', $newValue]
        //                    ])->first();

        //                    // Determine if the data is new or updated
        //                    $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

        //                    // If no existing audit trail record, log the change
        //                    if (!$existingAuditTrail) {
        //                        $auditTrail = new InternalAuditTrial;
        //                        $auditTrail->InternalAudit_id = $internalAudit->id;
        //                        $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
        //                        $auditTrail->previous = $oldValue;
        //                        $auditTrail->current = $newValue;
        //                        $auditTrail->comment = "";
        //                        $auditTrail->user_id = Auth::user()->id;
        //                        $auditTrail->user_name = Auth::user()->name;
        //                        $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //                        $auditTrail->origin_state = $internalAudit->status;
        //                        $auditTrail->change_to = "Not Applicable";
        //                        $auditTrail->change_from = $internalAudit->status;
        //                        $auditTrail->action_name = $actionName; // Set action to New or Update
        //                        $auditTrail->save();
        //                    }
        //                }
        //            }
        //        }
        //    }
        //}


  $internal_id = $internalAudit->id;
  $newDataGridInternalAuditRoles = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'auditorroles'])->firstOrCreate();
  $newDataGridInternalAuditRoles->io_id = $internal_id;
  $newDataGridInternalAuditRoles->identifier = 'auditorroles';
  $newDataGridInternalAuditRoles->data = $request->auditorroles;
  $newDataGridInternalAuditRoles->save();



        $internal_id = $internalAudit->id;
        $newDataGridInitialClosure = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'Initial'])->firstOrCreate();
        $newDataGridInitialClosure->io_id = $internal_id;
        $newDataGridInitialClosure->identifier = 'Initial';
        $newDataGridInitialClosure->data = $request->Initial;
        $newDataGridInitialClosure->update();

        //if (!empty($request->Initial)) {
        //    // Fetch existing auditor data
        //    $existingAuditorShow = InternalAuditObservationGrid::where(['io_id' => $Summary, 'identifier' => 'Initial'])->first();
        //    $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

        //    if($internalAudit->stage == 1){
        //        $newDataGridInitialClosure = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'Initial'])->firstOrCreate();
        //        $newDataGridInitialClosure->io_id = $internal_id;
        //        $newDataGridInitialClosure->identifier = 'Initial';
        //        $newDataGridInitialClosure->data = $request->Initial;
        //        $newDataGridInitialClosure->update();
        //    }
        //    //dd($product);
        //    // Define the mapping of field keys to more descriptive names
        //    $fieldNames = [
        //        'observation' => 'Observation',
        //        'impact_assesment' => 'Response with impact assesment & CAPA (If Applicable)',
        //        'responsiblity' => 'Responsibility',
        //        'closure_date' => 'Proposed Closure Date',
        //        'Actual_date' => 'Actual Closure Date',

        //    ];

        //    // Track audit trail changes
        //    if (is_array($request->Initial)) {
        //        foreach ($request->Initial as $index => $newAuditor) {
        //            $previousAuditor = $existingAuditorData[$index] ?? [];

        //            // Track changes for each field
        //            $fieldsToTrack = ['observation', 'impact_assesment', 'responsiblity', 'closure_date', 'Actual_date'];
        //            foreach ($fieldsToTrack as $field) {
        //                $oldValue = $previousAuditor[$field] ?? 'Null';
        //                $newValue = $newAuditor[$field] ?? 'Null';

        //                // Only proceed if there's a change or the data is new
        //                if ($oldValue !== $newValue) {
        //                    // Check if this specific change has already been logged in the audit trail
        //                    $existingAuditTrail = InternalAuditTrial::where([
        //                        ['InternalAudit_id', '=', $internalAudit->id],
        //                        ['activity_type', '=', $fieldNames[$field] . ' ( ' . ($index + 1) . ')'],
        //                        ['previous', '=', $oldValue],
        //                        ['current', '=', $newValue]
        //                    ])->first();

        //                    // Determine if the data is new or updated
        //                    $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

        //                    // If no existing audit trail record, log the change
        //                    if (!$existingAuditTrail) {
        //                        $auditTrail = new InternalAuditTrial;
        //                        $auditTrail->InternalAudit_id = $internalAudit->id;
        //                        $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
        //                        $auditTrail->previous = $oldValue;
        //                        $auditTrail->current = $newValue;
        //                        $auditTrail->comment = "";
        //                        $auditTrail->user_id = Auth::user()->id;
        //                        $auditTrail->user_name = Auth::user()->name;
        //                        $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //                        $auditTrail->origin_state = $internalAudit->status;
        //                        $auditTrail->change_to = "Not Applicable";
        //                        $auditTrail->change_from = $internalAudit->status;
        //                        $auditTrail->action_name = $actionName; // Set action to New or Update
        //                        $auditTrail->save();
        //                    }
        //                }
        //            }
        //        }
        //    }
        //}




  $ia_id = $internalAudit->id;
  // dd($request->all());

    // $validatedData = $request->validate([
    //   'auditAssessmentChecklist' => 'required|array',
    //         'auditAssessmentChecklist.*.response' => 'nullable|string',
    //         'auditAssessmentChecklist.*.remarks' => 'nullable|string',

    //         'auditPersonnelChecklist' => 'required|array',
    //         'auditPersonnelChecklist.*.response' => 'nullable|string',
    //         'auditPersonnelChecklist.*.remarks' => 'nullable|string',

    //         'auditfacilityChecklist' => 'required|array',
    //         'auditfacilityChecklist.*.response' => 'nullable|string',
    //         'auditfacilityChecklist.*.remarks' => 'nullable|string',

    //         'auditMachinesChecklist' => 'required|array',
    //         'auditMachinesChecklist.*.response' => 'nullable|string',
    //         'auditMachinesChecklist.*.remarks' => 'nullable|string',

    //         'auditProductionChecklist' => 'required|array',
    //         'auditProductionChecklist.*.response' => 'nullable|string',
    //         'auditProductionChecklist.*.remarks' => 'nullable|string',

    //         'auditMaterialsChecklist' => 'required|array',
    //         'auditMaterialsChecklist.*.response' => 'nullable|string',
    //         'auditMaterialsChecklist.*.remarks' => 'nullable|string',

    //         'auditQualityControlChecklist' => 'required|array',
    //         'auditQualityControlChecklist.*.response' => 'nullable|string',
    //         'auditQualityControlChecklist.*.remarks' => 'nullable|string',

    //         'auditQualityAssuranceChecklist' => 'required|array',
    //         'auditQualityAssuranceChecklist.*.response' => 'nullable|string',
    //         'auditQualityAssuranceChecklist.*.remarks' => 'nullable|string',

    //         'auditPackagingChecklist' => 'required|array',
    //         'auditPackagingChecklist.*.response' => 'nullable|string',
    //         'auditPackagingChecklist.*.remarks' => 'nullable|string',

    //         'auditSheChecklist' => 'required|array',
    //         'auditSheChecklist.*.response' => 'nullable|string',
    //         'auditSheChecklist.*.remarks' => 'nullable|string',

    //     ]);

        // dd("test");
        // dd($validatedData);

        $auditAssessmentGrid = InternalAuditChecklistGrid::where(['ia_id' => $ia_id, 'identifier' => 'auditAssessmentChecklist'])->firstOrNew();
        // dd($auditAssessmentGrid);
        $auditAssessmentGrid->ia_id = $ia_id;
        $auditAssessmentGrid->identifier = 'auditAssessmentChecklist';
        $auditAssessmentGrid->data = 'auditAssessmentChecklist';
        // dd($auditAssessmentGrid);
        $auditAssessmentGrid->save();

        $auditPersonnelGrid = InternalAuditChecklistGrid::where(['ia_id' => $ia_id, 'identifier' => 'auditPersonnelChecklist'])->firstOrNew();
        $auditPersonnelGrid->ia_id = $ia_id;
        $auditPersonnelGrid->identifier = 'auditPersonnelChecklist';
        $auditPersonnelGrid->data = 'auditPersonnelChecklist';
        // dd($auditPersonnelGrid);
        $auditPersonnelGrid->save();

        $auditfacilityGrid = InternalAuditChecklistGrid::where(['ia_id' => $ia_id, 'identifier' => 'auditfacilityChecklist'])->firstOrNew();
        $auditfacilityGrid->ia_id = $ia_id;
        $auditfacilityGrid->identifier = 'auditfacilityChecklist';
        $auditfacilityGrid->data = 'auditfacilityChecklist';
        $auditfacilityGrid->save();

        $auditMachinesGrid = InternalAuditChecklistGrid::where(['ia_id' => $ia_id, 'identifier' => 'auditMachinesChecklist'])->firstOrNew();
        $auditMachinesGrid->ia_id = $ia_id;
        $auditMachinesGrid->identifier = 'auditMachinesChecklist';
        $auditMachinesGrid->data = 'auditMachinesChecklist';
        $auditMachinesGrid->save();

        $auditProductionGrid = InternalAuditChecklistGrid::where(['ia_id' => $ia_id, 'identifier' => 'auditProductionChecklist'])->firstOrNew();
        $auditProductionGrid->ia_id = $ia_id;
        $auditProductionGrid->identifier = 'auditProductionChecklist';
        $auditProductionGrid->data =  'auditProductionChecklist';
        $auditProductionGrid->save();

        $auditMaterialsGrid = InternalAuditChecklistGrid::where(['ia_id' => $ia_id, 'identifier' => 'auditMaterialsChecklist'])->firstOrNew();
        $auditMaterialsGrid->ia_id = $ia_id;
        $auditMaterialsGrid->identifier = 'auditMaterialsChecklist';
        $auditMaterialsGrid->data =  'auditMaterialsChecklist';
        $auditMaterialsGrid->save();

        $auditQualityGrid = InternalAuditChecklistGrid::where(['ia_id' => $ia_id, 'identifier' => 'auditQualityControlChecklist'])->firstOrNew();
        $auditQualityGrid->ia_id = $ia_id;
        $auditQualityGrid->identifier = 'auditQualityControlChecklist';
        $auditQualityGrid->data =  'auditQualityControlChecklist';
        $auditQualityGrid->save();

        $auditQualityAssuranceGrid = InternalAuditChecklistGrid::where(['ia_id' => $ia_id, 'identifier' => 'auditQualityAssuranceChecklist'])->firstOrNew();
        $auditQualityAssuranceGrid->ia_id = $ia_id;
        $auditQualityAssuranceGrid->identifier = 'auditQualityAssuranceChecklist';
        $auditQualityAssuranceGrid->data =  'auditQualityAssuranceChecklist';
        $auditQualityAssuranceGrid->save();

        $auditPackagingGrid = InternalAuditChecklistGrid::where(['ia_id' => $ia_id, 'identifier' => 'auditPackagingChecklist'])->firstOrNew();
        $auditPackagingGrid->ia_id = $ia_id;
        $auditPackagingGrid->identifier = 'auditPackagingChecklist';
        $auditPackagingGrid->data = 'auditPackagingChecklist';
        $auditPackagingGrid->save();

        $auditsheGrid = InternalAuditChecklistGrid::where(['ia_id' => $ia_id, 'identifier' => 'auditSheChecklist'])->firstOrNew();
        $auditsheGrid->ia_id = $ia_id;
        $auditsheGrid->identifier = 'auditSheChecklist';
        $auditsheGrid->data = 'auditSheChecklist';
        $auditsheGrid->save();

        $internalAuditComments = InternalAuditChecklistGrid::where(['ia_id' => $ia_id])->firstOrNew();
        $internalAuditComments->auditSheChecklist_comment = $request->auditSheChecklist_comment;
        if (!empty($request->auditSheChecklist_attachment)) {
            $files = [];
            if ($request->hasfile('auditSheChecklist_attachment')) {
                foreach ($request->file('auditSheChecklist_attachment') as $file) {
                    $name = "IA-" . 'auditSheChecklist_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAuditComments->auditSheChecklist_attachment = json_encode($files);
            // dd($internalAuditComments->auditSheChecklist_attachment);
        }
        $internalAuditComments->save();




        // Fetch the existing record from the database based on the incident ID
            $data3 = InternalAuditGrid::where('audit_id', $internalAudit->id)
                ->where('type', 'internal_audit')
                ->first();

            // Perform the update after storing the previous values
            if (!empty($request->audit)) {
                $data3->area_of_audit = serialize($request->audit);
            }
            if (!empty($request->scheduled_start_date)) {
                $data3->start_date = serialize($request->scheduled_start_date);
            }
            if (!empty($request->scheduled_start_time)) {
                $data3->start_time = serialize($request->scheduled_start_time);
            }
            if (!empty($request->scheduled_end_date)) {
                $data3->end_date = serialize($request->scheduled_end_date);
            }
            if (!empty($request->scheduled_end_time)) {
                $data3->end_time = serialize($request->scheduled_end_time);
            }
            // if (!empty($request->auditor)) {
            //     $data3->auditor = serialize($request->auditor);
            // }
            // if (!empty($request->auditee)) {
            //     $data3->auditee = serialize($request->auditee);
            // }
            if (!empty($request->auditor)) {
                dd(implode(',', $request->auditor));
                $data3->auditor = implode(',', $request->auditor); // Save as a comma-separated string
            }
            if (!empty($request->auditee)) {
                $data3->auditee = implode(',', $request->auditee); // Save as a comma-separated string
            }


            if (!empty($request->remark)) {
                $data3->remark = serialize($request->remark);
            }
            // dd(json_encode($request->auditor));

            // Update the record in the database
            $data3->update();

            // Store the previous details for comparison before making updates
            //$previousDetails = [
            //    'audit' => !is_null($data3->audit) ? unserialize($data3->audit) : null,
            //    'scheduled_start_date' => !is_null($data3->scheduled_start_date) ? unserialize($data3->scheduled_start_date) : null,
            //    'scheduled_start_time' => !is_null($data3->scheduled_start_time) ? unserialize($data3->scheduled_start_time) : null,
            //    'scheduled_end_date' => !is_null($data3->scheduled_end_date) ? unserialize($data3->scheduled_end_date) : null,
            //    'scheduled_end_time' => !is_null($data3->scheduled_end_time) ? unserialize($data3->scheduled_end_time) : null,
            //    'auditor' => !is_null($data3->auditor) ? unserialize($data3->auditor) : null,
            //    'auditee' => !is_null($data3->auditee) ? unserialize($data3->auditee) : null,
            //    'remark' => !is_null($data3->remark) ? unserialize($data3->remark) : null,
            //];

            //// Perform the update after storing the previous values
            //if (!empty($request->audit)) {
            //    $data3->area_of_audit = serialize($request->audit);
            //}
            //if (!empty($request->scheduled_start_date)) {
            //    $data3->start_date = serialize($request->scheduled_start_date);
            //}
            //if (!empty($request->scheduled_start_time)) {
            //    $data3->start_time = serialize($request->scheduled_start_time);
            //}
            //if (!empty($request->scheduled_end_date)) {
            //    $data3->end_date = serialize($request->scheduled_end_date);
            //}
            //if (!empty($request->scheduled_end_time)) {
            //    $data3->end_time = serialize($request->scheduled_end_time);
            //}
            //if (!empty($request->auditor)) {
            //    $data3->auditor = serialize($request->auditor);
            //}
            //if (!empty($request->auditee)) {
            //    $data3->auditee = serialize($request->auditee);
            //}
            //if (!empty($request->remark)) {
            //    $data3->remark = serialize($request->remark);
            //}

            //// Update the record in the database
            //$data3->update();

            //// Define an associative array to map the field keys to display names
            //$fieldNames = [
            //    'audit' => 'Area of Audit',
            //    'scheduled_start_date' => 'Scheduled Start Date',
            //    'scheduled_start_time' => 'Scheduled Start Time',
            //    'scheduled_end_date' => 'Scheduled End Date',
            //    'scheduled_end_time' => 'Scheduled End Time',
            //    'auditor' => 'Auditor',
            //    'auditee' => 'Auditee',
            //    'remark' => 'Remarks'
            //];

            //// Ensure audit is an array before iterating
            //if (is_array($request->audit) && !empty($request->audit)) {
            //    foreach ($request->audit as $index => $audit) {
            //        // Retrieve previous details for the current index
            //        $previousValues = [
            //            'audit' => $previousDetails['audit'][$index] ?? null,
            //            'scheduled_start_date' => $previousDetails['scheduled_start_date'][$index] ?? null,
            //            'scheduled_start_time' => $previousDetails['scheduled_start_time'][$index] ?? null,
            //            'scheduled_end_date' => $previousDetails['scheduled_end_date'][$index] ?? null,
            //            'scheduled_end_time' => $previousDetails['scheduled_end_time'][$index] ?? null,
            //            'auditor' => $previousDetails['auditor'][$index] ?? null,
            //            'auditee' => $previousDetails['auditee'][$index] ?? null,
            //            'remark' => $previousDetails['remark'][$index] ?? null,
            //        ];

            //        // Current field values from the request
            //        $fields = [
            //            'audit' => $audit,
            //            'scheduled_start_date' => $request->scheduled_start_date[$index],
            //            'scheduled_start_time' => $request->scheduled_start_time[$index],
            //            'scheduled_end_date' => $request->scheduled_end_date[$index],
            //            'scheduled_end_time' => $request->scheduled_end_time[$index],
            //            'auditor' => $request->auditor[$index],
            //            'auditee' => $request->auditee[$index],
            //            'remark' => $request->remark[$index],
            //        ];

            //        foreach ($fields as $key => $currentValue) {
            //            // Get the previous value from the previous data
            //            $previousValue = $previousValues[$key] ?? null;

            //            // Log the changes only if the previous value is different from the current value
            //            if ($previousValue != $currentValue && !empty($currentValue)) {
            //                // Check if an audit trail entry for this specific row and field already exists
            //                $existingAudit = InternalAuditTrial::where('InternalAudit_id', $id)
            //                    ->where('activity_type', $fieldNames[$key] . ' (' . ($index + 1) . ')')
            //                    ->where('previous', $previousValue)
            //                    ->where('current', $currentValue)
            //                    ->exists();

            //                // Only create a new audit trail entry if no existing entry matches
            //                if (!$existingAudit) {
            //                    $history = new InternalAuditTrial();
            //                    $history->InternalAudit_id = $id;

            //                    // Set activity type to include field name and row index using the fieldNames array
            //                    $history->activity_type = $fieldNames[$key] . ' (' . ($index + 1) . ')';

            //                    // Assign 'Previous' value explicitly as null if it doesn't exist
            //                    $history->previous = $previousValue;

            //                    // Assign 'Current' value, which is the new value
            //                    $history->current = $currentValue;

            //                    // Comments and user details
            //                    $history->comment = $request->equipment_comments[$index] ?? '';
            //                    $history->user_id = Auth::user()->id;
            //                    $history->user_name = Auth::user()->name;
            //                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            //                    $history->origin_state = $internalAudit->status;
            //                    $history->change_to = "Not Applicable";
            //                    $history->change_from = $internalAudit->status;
            //                    $history->action_name = is_null($previousValue) || $currentValue === '' ? 'New' : 'Update';

            //                    // Save the history record
            //                    $history->save();
            //                }
            //            }
            //        }
            //    }
            //}




        $data4 = InternalAuditGrid::where('audit_id',$internalAudit->id)->where('type','Observation_field')->first();

        if (!empty($request->observation_id)) {
            $data4->observation_id = serialize($request->observation_id);
        }
        if (!empty($request->date)) {
            $data4->date = serialize($request->date);
        }
        if (!empty($request->auditorG)) {
            $data4->auditor = serialize($request->auditorG);
        }
        if (!empty($request->auditeeG)) {
            $data4->auditee = serialize($request->auditeeG);
        }
        if (!empty($request->observation_description)) {
            $data4->observation_description = serialize($request->observation_description);
        }
        if (!empty($request->severity_level)) {
            $data4->severity_level = serialize($request->severity_level);
        }
        if (!empty($request->area)) {
            $data4->area = serialize($request->area);
        }
        if (!empty($request->observation_category)) {
            $data4->observation_category = serialize($request->observation_category);
        }
         if (!empty($request->capa_required)) {
            $data4->capa_required = serialize($request->capa_required);
        }
         if (!empty($request->auditee_response)) {
            $data4->auditee_response = serialize($request->auditee_response);
        }
        if (!empty($request->auditor_review_on_response)) {
            $data4->auditor_review_on_response = serialize($request->auditor_review_on_response);
        }
        if (!empty($request->qa_comment)) {
            $data4->qa_comment = serialize($request->qa_comment);
        }
        if (!empty($request->capa_details)) {
            $data4->capa_details = serialize($request->capa_details);
        }
        if (!empty($request->capa_due_date)) {
            $data4->capa_due_date = serialize($request->capa_due_date);
        }
        if (!empty($request->capa_owner)) {
            $data4->capa_owner = serialize($request->capa_owner);
        }
        if (!empty($request->action_taken)) {
            $data4->action_taken = serialize($request->action_taken);
        }
        if (!empty($request->capa_completion_date)) {
            $data4->capa_completion_date = serialize($request->capa_completion_date);
        }
        if (!empty($request->status_Observation)) {
            $data4->status = serialize($request->status_Observation);
        }
        if (!empty($request->remark_observation)) {
            $data4->remark = serialize($request->remark_observation);
        }
        $data4->update();

        toastr()->success('Record is Update Successfully');

        return back();
    }

    public function internalAuditShow($id)
    {
        $internal_id = $id;
        $old_record = InternalAudit::select('id', 'division_id', 'record')->get();
        $data = InternalAudit::find($id);
        $checklist1 = IA_checklist_tablet_compression::where('ia_id', $id)->first();
        $checklist2 = IA_checklist_tablet_coating::where('ia_id', $id)->first();
        $checklist4 = Checklist_Capsule::where('ia_id', $id)->first();
        $checklist3 = IA_checklist_capsule_paking::where('ia_id', $id)->first();
        $checklist5 = IA_liquid_ointment::where('ia_id', $id)->first();
        $checklist6 = IA_dispencing_manufacturing::where('ia_id', $id)->first();

        $checklist7 = IA_ointment_paking::where('ia_id', $id)->first();
        $checklist9 = IA_checklist_engineering::where('ia_id', $id)->first();
        $checklist10 = IA_quality_control::where('ia_id', $id)->first();
        $checklist11 = IA_checklist_stores::where('ia_id', $id)->first();
        $checklist12 = IA_checklist_hr::where('ia_id', $id)->first();
        $checklist13 = IA_checklist_dispensing::where('ia_id', $id)->first();
        $checklist14 = IA_checklist_production_injection::where('ia_id', $id)->first();
        $checklist15 = IA_checklist_manufacturing_filling::where('ia_id', $id)->first();
        $checklist16 = IA_checklist_analytical_research::where('ia_id', $id)->first();
        $checklist17 = IA_checklist__formulation_research::where('ia_id', $id)->first();

        // dd($checklist1);
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $grid_data = InternalAuditGrid::where('audit_id', $id)->where('type', "internal_audit")->first();


    //    dd($grid_data);
        $grid_data1 = InternalAuditGrid::where('audit_id', $id)->where('type', "Observation_field")->first();
        // return dd($checklist1);
        $auditornew = InternalAudit::where('id', $id)->first();
        $auditAssessmentChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditAssessmentChecklist'])->first();
        $auditPersonnelChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditPersonnelChecklist'])->firstOrNew();
        $auditfacilityChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditfacilityChecklist'])->firstOrNew();
        $auditMachinesChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditMachinesChecklist'])->firstOrNew();
        $auditProductionChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditProductionChecklist'])->firstOrNew();
        $auditMaterialsChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditMaterialsChecklist'])->firstOrNew();
        $auditQualityControlChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditQualityControlChecklist'])->firstOrNew();
        $auditQualityAssuranceChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditQualityAssuranceChecklist'])->firstOrNew();
        $auditPackagingChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditPackagingChecklist'])->firstOrNew();
        $auditSheChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditSheChecklist'])->firstOrNew();
        $gridcomment = InternalAuditChecklistGrid::where(['ia_id' => $id])->first();
        $grid_Data3 = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'observations'])->firstOrNew();
        // foreach ($grid_Data3 as $d )
        // return $grid_Data3['identifier'];
        $grid_Data4 = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'auditorroles'])->firstOrCreate();
        $grid_Data5 = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'Initial'])->firstOrCreate();
        $auditorview = InternalAuditorGrid::where(['auditor_id'=>$id, 'identifier'=>'Auditors'])->first();


        $auditAgendaData =InternalAuditGrid::where(['audit_id' => $id, 'identifier' => 'Audit Agenda'])->first();
        $json = $auditAgendaData ? json_decode($auditAgendaData->data, true) : [];

        // dd($json);
        // dd($auditAgendaData->data);
        // $auditAgendaData = InternalAuditGrid::where(['audit_id' => $id, 'identifier' => 'Audit Agenda'])->first();
        // $rowIndex = 0;
        // if ($auditAgendaData && property_exists($auditAgendaData, 'data') && is_array($auditAgendaData->data)) {
        //     $rowIndex = count($auditAgendaData->data);
        // }
        // $auditJson = json_decode($auditAgendaData->data, true);

        return view('frontend.internalAudit.view', compact('data','checklist1','checklist2','checklist3', 'checklist4','checklist5','checklist6','checklist7','checklist9','checklist10','checklist11','checklist12','checklist13','checklist14','checklist15','checklist16','checklist17','old_record','grid_data','grid_data1', 'auditAssessmentChecklist','auditPersonnelChecklist','auditfacilityChecklist','auditMachinesChecklist','auditProductionChecklist','auditMaterialsChecklist','auditQualityControlChecklist','auditQualityAssuranceChecklist','auditPackagingChecklist','auditSheChecklist','gridcomment','grid_Data3','grid_Data4','grid_Data5','auditorview','auditAgendaData','json'));
    }


    public function InternalAuditStateChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = InternalAudit::find($id);
            $lastDocument = InternalAudit::find($id);
            $auditorview = InternalAuditorGrid::where(['auditor_id'=>$id, 'identifier'=>'Auditors'])->first();


            $isCommentEditable = false;

            // Check all conditions
                if (
                    !empty($auditorview->data) &&
                    is_iterable($auditorview->data)
                )
                {
                    foreach ($auditorview->data as $audditor) {
                        if (
                            isset($audditor['auditornew'], $audditor['designation']) &&
                            $audditor['auditornew'] == Auth::user()->id &&
                            $audditor['designation'] === 'Lead Auditor'
                        ) {
                            $isCommentEditable = true;
                            break;
                        }
                    }
                }

            if ($changeControl->stage == 1) {
                $changeControl->stage = "2";
                $changeControl->status = "Acknowledgement ";
                $changeControl->audit_schedule_by = Auth::user()->name;
                $changeControl->audit_schedule_on = Carbon::now()->format('d-M-Y');
                $changeControl->sheduled_audit_comment = $request->comment;
                            $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Schedule Audit By, Schedule Audit On';
                            if (is_null($lastDocument->audit_schedule_by) || $lastDocument->audit_schedule_by === '') {
                                $history->previous = "Not Applicable";
                            } else {
                                $history->previous = $lastDocument->audit_schedule_by . ' , ' . $lastDocument->audit_schedule_on;
                            }
                            $history->current = $changeControl->audit_schedule_by . ' , ' . $changeControl->audit_schedule_on;
                            $history->action='Schedule Audit';
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->change_to = "Acknowledgement ";
                            $history->change_from = $lastDocument->status;
                            $history->stage = "Acknowledgement ";
                            if (is_null($lastDocument->audit_schedule_by) || $lastDocument->audit_schedule_by === '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                            $history->save();
               

                    $list = Helpers::getInitiatorUserList($changeControl->division_id);
                        foreach ($list as $u) {

                            $email = Helpers::getUserEmail($u->user_id);

                            if ($email !== null) {

                                try {

                                    $data = [
                                        'data'    => $changeControl,
                                        'site'    => "External Audit",
                                        'history' => "More Information Required",
                                        'process' => 'External Audit',
                                        'comment' => $history->comments,
                                        'user'    => Auth::user()->name
                                    ];
                                    SendMail::dispatch(
                                        $data,
                                        $email,
                                        $changeControl,      
                                        'External Audit'      
                                    );

                                } catch (\Exception $e) {

                                    \Log::error('Queue Dispatch Error', [
                                        'email' => $email,
                                        'error' => $e->getMessage()
                                    ]);

                                }

                            }
                        }

                $changeControl->update();
                $checkReviews = InternalAuditResponse::where('ia_id', $id)->get();

                foreach ($checkReviews as $review) {
                    $review->forceDelete();
                }
                toastr()->success('Document Sent');
                return back();
            }
            //for lead auditor

            if($changeControl->stage == 2){
                $responseData = InternalAuditResponse::where('ia_id', $id)->orderBy('id', 'desc')->first();
                $stageCheck = new InternalAuditResponse();

                $userId = Auth::user()->id;
                $userName = Auth::user()->name;
                $userRoleName = RoleGroup::where('id', Auth::user()->role)->value('name');
                $now = Carbon::now()->format('d-M-Y');

                $auditorview = InternalAuditorGrid::where(['auditor_id' => $id, 'identifier' => 'Auditors'])->first();

                $isLeadAuditor = false;
                if (!empty($auditorview->data) && is_iterable($auditorview->data)) {
                    foreach ($auditorview->data as $auditor) {
                        if (
                            isset($auditor['auditornew'], $auditor['designation']) &&
                            $auditor['auditornew'] == $userId &&
                            $auditor['designation'] === 'Lead Auditor'
                        ) {
                            $isLeadAuditor = true;
                            break;
                        }
                    }
                }

                // Determine role
                $personRole = $isLeadAuditor ? 'Lead Auditor' : 'Auditee';
                $commentField = $isLeadAuditor ? 'Auditor_comment' : 'Auditee_comment';
                // Check if comment is filled in DB field
                if (empty($changeControl->$commentField)) {
                    toastr()->error('Please fill the comment before e-signing.');
                    return back();
                }
                if (
                    $changeControl->$commentField &&
                    (!isset($responseData) || $responseData->person_role != $personRole)
                ) {
                    // Create response
                    $stageCheck->ia_id = $id;
                    $stageCheck->user_id = $userId;
                    $stageCheck->person_role = $personRole;
                    $stageCheck->status = ($responseData && $responseData->person_role != $personRole) ? 'Complete' : 'In-Progress';
                    $stageCheck->save();

                    // Update change control based on role
                    if ($isLeadAuditor) {
                        $changeControl->audit_preparation_completed_by_lead_auditor = $userName;
                        $changeControl->audit_preparation_completed_on_lead_auditor = $now;
                        $changeControl->acknowledge_commnet_lead_auditor = $request->comment;
                    } else {
                        $changeControl->audit_preparation_completed_by = $userName;
                        $changeControl->audit_preparation_completed_on = $now;
                        $changeControl->acknowledge_commnet = $request->comment;
                    }


                    // $list = Helpers::getInitiatorUserList($changeControl->division_id);
                    // foreach ($list as $u) {
                    //    $email = Helpers::getInitiatorEmail($u->user_id);
                    //        if ($email !== null) {
                    //        Mail::send(
                    //            'mail.view-mail',
                    //            ['data' => $changeControl, 'site' => "Internal Audit", 'history' => "Review", 'process' => 'Internal Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                    //            function ($message) use ($email, $changeControl) {
                    //                $message->to($email)
                    //                ->subject("Agio Notification: Internal Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                    //            }
                    //        );
                    //    }
                    // }

                    $changeControl->update();

                    // Save audit trail
                    $this->saveAuditHistory($id, $request->comment, $personRole, $lastDocument, $now);

                    // Check if both roles have completed
                    if ($this->isAuditPreparationComplete($id)) {
                        $changeControl->stage = 3;
                        $changeControl->status = 'Audit';
                        $changeControl->update();
                    }

                    toastr()->success('Document Sent');
                    return back();
                }
            }

            if ($changeControl->stage == 3) {
                if ((empty($changeControl->checklists) || empty($changeControl->Comments))
                && (!isset($changeControl->auditAgendaData) || empty($changeControl->auditAgendaData['auditArea'])))
                            {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'Audit Preparation and Execution Tab and Audit Observation Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                 else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Sent for Response'
                    ]);
                }

                // $extensionchild = extension_new::where('parent_id', $id)
                //     ->where('parent_type', 'Internal Audit')
                //     ->get();
                //     // dd($extensionchild);
                //         $hasPending1 = false;
                //     foreach ($extensionchild as $ext) {
                //             $extensionchildStatus = trim(strtolower($ext->status));
                //             if ($extensionchildStatus !== 'closed - done') {
                //                 $hasPending1 = true;
                //                 break;
                //             }
                //         }

                //     if ($hasPending1) {
                //             Session::flash('swal', [
                //                 'title' => 'Extension Child Pending!',
                //                 'message' => 'You cannot proceed until Extension Child is Closed-Done.',
                //                 'type' => 'warning',
                //             ]);

                //         return redirect()->back();
                        
                //     } else {
                //         Session::flash('swal', [
                //             'title' => 'Success!',
                //             'message' => 'Sent for Next Stage',
                //             'type' => 'success',
                //         ]);
                //     }

                //     $observationchild = Observation::where('parent_id', $id)
                //     ->where('parent_type', 'Internal Audit')
                //     ->get();
                //     // dd($extensionchild);
                //         $hasPending2 = false;
                //         foreach ($observationchild as $ext) {
                //             $observationchildStatus = trim(strtolower($ext->status));
                //             if ($observationchildStatus !== 'closed - done') {
                //                 $hasPending2 = true;
                //                 break;
                //             }
                //         }

                //     if ($hasPending2) {
                //             Session::flash('swal', [
                //                 'title' => 'Observations Child Pending!',
                //                 'message' => 'You cannot proceed until Observations Child is Closed-Done.',
                //                 'type' => 'warning',
                //             ]);

                //         return redirect()->back();
                        
                //     } else {
                //         Session::flash('swal', [
                //             'title' => 'Success!',
                //             'message' => 'Sent for Next Stage',
                //             'type' => 'success',
                //         ]);
                //     }


                $changeControl->stage = "4";
                $changeControl->status = " Response";
                $changeControl->audit_mgr_more_info_reqd_by = Auth::user()->name;
                $changeControl->audit_mgr_more_info_reqd_on = Carbon::now()->format('d-M-Y');
                $changeControl->issue_report_comment = $request->comment;
                $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Issue Report By, Issue Report On';
                            if (is_null($lastDocument->audit_mgr_more_info_reqd_by) || $lastDocument->audit_mgr_more_info_reqd_by === '') {
                                $history->previous = "Not Applicable";
                            } else {
                                $history->previous = $lastDocument->audit_mgr_more_info_reqd_by . ' , ' . $lastDocument->audit_mgr_more_info_reqd_on;
                            }
                            $history->current = $changeControl->audit_mgr_more_info_reqd_by . ' , ' . $changeControl->audit_mgr_more_info_reqd_on;
                            $history->action='Issue Report';
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->change_to = " Response";
                            $history->change_from = $lastDocument->status;
                            $history->stage = " Response";
                            if (is_null($lastDocument->audit_mgr_more_info_reqd_by) || $lastDocument->audit_mgr_more_info_reqd_by === '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                            $history->save();
                        $list = Helpers::getLeadAuditeeUserList($changeControl->division_id);       
                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {

                                    $data = [
                                        'data'    => $changeControl,
                                        'site'    => "Internal Audit",
                                        'history' => "Issue Report",
                                        'process' => 'Internal Audit',
                                        'comment' => $history->comments,
                                        'user'    => Auth::user()->name
                                    ];
                                    SendMail::dispatch(
                                        $data,
                                        $email,
                                        $changeControl,      
                                        'Internal Audit'      
                                    );

                                } catch (\Exception $e) {

                                    \Log::error('Queue Dispatch Error', [
                                        'email' => $email,
                                        'error' => $e->getMessage()
                                    ]);

                                }

                            }
                        }
                  


                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 4) {

                // if (!isset($changeControl->Initial))
                // {
                //     Session::flash('swal', [
                //         'type' => 'warning',
                //         'title' => 'Mandatory Fields!',
                //         'message' => 'Response  Tab is yet to be filled'
                //     ]);

                //     return redirect()->back();
                // }
                //  else {
                //     Session::flash('swal', [
                //         'type' => 'success',
                //         'title' => 'Success',
                //         'message' => 'Sent for Closed -Done'
                //     ]);
                // }

                $extensionchild = extension_new::where('parent_id', $id)
                   ->where('parent_type', 'Internal Audit')
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

                    $actionchilds = ActionItem::where('parent_id', $id)
                        ->where('parent_type', 'Internal Audit')
                        ->get();
                            $hasPendingaction = false;
                            foreach ($actionchilds as $ext) {
                                $actionchildstatus = trim(strtolower($ext->status));
                                if ($actionchildstatus !== 'closed - done') {
                                    $hasPendingaction = true;
                                    break;
                                }
                            }
                    if ($hasPendingaction) {
                        // $actionchildstatus = trim(strtolower($extensionchild->status));
                        if ($hasPendingaction) {
                            Session::flash('swal', [
                                'title' => 'Action Item Child Pending!',
                                'message' => 'You cannot proceed until Action Item Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        }
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Document Sent',
                            'type' => 'success',
                        ]);
                    }

                    $capachilds = Capa::where('parent_id', $id)
                        ->where('parent_type', 'Internal Audit')
                        ->get();
                            $hasPending = false;
                            foreach ($capachilds as $ext) {
                                $capachildstatus = trim(strtolower($ext->status));
                                if ($capachildstatus !== 'closed - done') {
                                    $hasPending = true;
                                    break;
                                }
                            }
                    if ($hasPending) {
                        // $capachildstatus = trim(strtolower($extensionchild->status));
                        if ($hasPending) {
                            Session::flash('swal', [
                                'title' => 'CAPA Child Pending!',
                                'message' => 'You cannot proceed until CAPA Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        }
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Document Sent',
                            'type' => 'success',
                        ]);
                    }
                    $rcachilds = RootCauseAnalysis::where('parent_id', $id)
                        ->where('parent_type', 'Internal Audit')
                        ->get();
                            $hasPendingRCA = false;
                            foreach ($rcachilds as $ext) {
                                $rcachildstatus = trim(strtolower($ext->status));
                                if ($rcachildstatus !== 'closed - done') {
                                    $hasPendingRCA = true;
                                    break;
                                }
                            }
                    if ($hasPendingRCA) {
                        // $rcachildstatus = trim(strtolower($extensionchild->status));
                        if ($hasPendingRCA) {
                            Session::flash('swal', [
                                'title' => 'RCA Child Pending!',
                                'message' => 'You cannot proceed until RCA Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        }
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Document Sent',
                            'type' => 'success',
                        ]);
                    }

                $changeControl->stage = "5";
                $changeControl->status = "Response Verification";
                $changeControl->audit_observation_submitted_by = Auth::user()->name;
                $changeControl->audit_observation_submitted_on = Carbon::now()->format('d-M-Y');
                $changeControl->capa_plan_comment = $request->comment;
                $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'CAPA Plan Proposed By, CAPA Plan Proposed On';
                            if (is_null($lastDocument->audit_observation_submitted_by) || $lastDocument->audit_observation_submitted_by === '') {
                                $history->previous = "Not Applicable";
                            } else {
                                $history->previous = $lastDocument->audit_observation_submitted_by . ' , ' . $lastDocument->audit_observation_submitted_on;
                            }
                            $history->current = $changeControl->audit_observation_submitted_by . ' , ' . $changeControl->audit_observation_submitted_on;
                            $history->action='CAPA Plan Proposed';
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->change_to = "Response Verification";
                            $history->change_from = $lastDocument->status;
                            $history->stage = "Response Verification";
                            if (is_null($lastDocument->audit_observation_submitted_by) || $lastDocument->audit_observation_submitted_by === '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                            $history->save();

                            $list = Helpers::getAuditManagerUserList($changeControl->division_id);
                            foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {

                                    $data = [
                                        'data'    => $changeControl,
                                        'site'    => "Internal Audit",
                                        'history' => "CAPA Plan Proposed",
                                        'process' => 'Internal Audit',
                                        'comment' => $history->comments,
                                        'user'    => Auth::user()->name
                                    ];
                                    SendMail::dispatch(
                                        $data,
                                        $email,
                                        $changeControl,      
                                        'Internal Audit'      
                                    );

                                } catch (\Exception $e) {

                                    \Log::error('Queue Dispatch Error', [
                                        'email' => $email,
                                        'error' => $e->getMessage()
                                    ]);

                                }

                            }
                        }

                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changeControl->stage == 5) {

                if (empty($changeControl->res_ver ))
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'Response Verification Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                 else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Sent for Closed -Done'
                    ]);
                }

                $extensionchild = extension_new::where('parent_id', $id)
                   ->where('parent_type', 'Internal Audit')
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

                $changeControl->stage = "6";
                $changeControl->status = "Closed - Done";
                $changeControl->audit_lead_more_info_reqd_by = Auth::user()->name;
                $changeControl->audit_lead_more_info_reqd_on = Carbon::now()->format('d-M-Y');
                $changeControl->audit_response_completed_by = Auth::user()->name;
                $changeControl->audit_response_completed_on = Carbon::now()->format('d-M-Y');
                $changeControl->response_feedback_verified_by = Auth::user()->name;
                $changeControl->response_feedback_verified_on = Carbon::now()->format('d-M-Y');
                $changeControl->response_reviewd_comment = $request->comment;
                            $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Response Reviewed By, Response Reviewed On';
                            if (is_null($lastDocument->audit_lead_more_info_reqd_by) || $lastDocument->audit_lead_more_info_reqd_by === '') {
                                $history->previous = "Not Applicable";
                            } else {
                                $history->previous = $lastDocument->audit_lead_more_info_reqd_by . ' , ' . $lastDocument->audit_lead_more_info_reqd_on;
                            }
                            $history->current = $changeControl->audit_lead_more_info_reqd_by . ' , ' . $changeControl->audit_lead_more_info_reqd_on;
                            $history->action='Response Reviewed';
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->change_to = "Closed - Done";
                            $history->change_from = $lastDocument->status;
                            $history->stage = "Audit Lead More Info Reqd";
                            if (is_null($lastDocument->audit_lead_more_info_reqd_by) || $lastDocument->audit_lead_more_info_reqd_by === '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                            $history->save();

                             $list = Helpers::getLeadAuditeeUserList($changeControl->division_id);
                            foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {

                                    $data = [
                                        'data'    => $changeControl,
                                        'site'    => "Internal Audit",
                                        'history' => "Response Reviewed",
                                        'process' => 'Internal Audit',
                                        'comment' => $history->comments,
                                        'user'    => Auth::user()->name
                                    ];
                                    SendMail::dispatch(
                                        $data,
                                        $email,
                                        $changeControl,      
                                        'Internal Audit'      
                                    );

                                } catch (\Exception $e) {

                                    \Log::error('Queue Dispatch Error', [
                                        'email' => $email,
                                        'error' => $e->getMessage()
                                    ]);

                                }

                            }
                        }

                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }



        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
    private function saveAuditHistory($id, $comment, $role, $lastDocument, $now)
    {
        $fieldPrefix = $role === 'Lead Auditor' ? 'lead_auditor' : '';

        $previousName = $lastDocument->{'audit_preparation_completed_by' . ($fieldPrefix ? '_' . $fieldPrefix : '')};
        $previousDate = $lastDocument->{'audit_preparation_completed_on' . ($fieldPrefix ? '_' . $fieldPrefix : '')};

        $history = new InternalAuditTrial();
        $history->InternalAudit_id = $id;
        $history->activity_type = 'Acknowledgement By, Acknowledgement On';
        $history->previous = ($previousName) ? $previousName . ' , ' . $previousDate : 'Not Applicable';
        $history->current = Auth::user()->name . ' , ' . $now;
        $history->action = 'Acknowledgement';
        $history->comment = $comment;
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $lastDocument->status;
        $history->change_to = "Audit";
        $history->change_from = $lastDocument->status;
        $history->stage = "Audit";
        $history->action_name = $previousName ? 'Update' : 'New';
        $history->save();
    }

    private function isAuditPreparationComplete($id)
    {
        $responses = InternalAuditResponse::where('ia_id', $id)->get();

        $auditorDone = $responses->where('person_role', 'Lead Auditor')->first();
        $auditeeDone = $responses->where('person_role', 'Auditee')->first();

        return $auditorDone && $auditeeDone;
    }

    public function InternalAuditStateChangeLeadAuditor(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = InternalAudit::find($id);
            $lastDocument = InternalAudit::find($id);
            $auditorview = InternalAuditorGrid::where(['auditor_id'=>$id, 'identifier'=>'Auditors'])->first();


            $isCommentEditable = false;

            // Check all conditions
                if (
                    !empty($auditorview->data) &&
                    is_iterable($auditorview->data)
                ) {
                    foreach ($auditorview->data as $audditor) {
                        if (
                            isset($audditor['auditornew'], $audditor['designation']) &&
                            $audditor['auditornew'] == Auth::user()->id &&
                            $audditor['designation'] === 'Lead Auditor'
                        ) {
                            $isCommentEditable = true;
                            break;
                        }
                    }
                }
            if($changeControl->stage == 2){
                $responseData = InternalAuditResponse::where('ia_id', $id)->orderBy('id', 'desc')
                            ->first();
                    $stageCheck = new InternalAuditResponse();
                    if(
                        $changeControl->Auditor_comment &&
                        $isCommentEditable &&
                        (!isset($responseData) || $responseData->person_role != "Lead Auditor")
                    ){

                        $stageCheck->ia_id = $id;
                        $stageCheck->user_id = Auth::user()->id;
                        $stageCheck->person_role = "Lead Auditor";
                        if($responseData && $responseData->person_role == "Auditee"){
                            $stageCheck->status = 'Complete';
                        }
                        else{
                            $stageCheck->status = 'In-Progress';
                                
                                $changeControl->audit_preparation_completed_by_lead_auditor = Auth::user()->name;
                                $changeControl->audit_preparation_completed_on_lead_auditor = Carbon::now()->format('d-M-Y');
                                $changeControl->acknowledge_commnet_lead_auditor = $request->comment;
                                $history = new InternalAuditTrial();
                                            $history->InternalAudit_id = $id;
                                            $history->activity_type = 'Acknowledgement By, Acknowledgement On';
                                            if (is_null($lastDocument->audit_preparation_completed_by_lead_auditor) || $lastDocument->audit_preparation_completed_by_lead_auditor === '') {
                                                $history->previous = "Not Applicable";
                                            } else {
                                                $history->previous = $lastDocument->audit_preparation_completed_by_lead_auditor . ' , ' . $lastDocument->audit_preparation_completed_on_lead_auditor;
                                            }
                                            $history->current = $changeControl->audit_preparation_completed_by_lead_auditor . ' , ' . $changeControl->audit_preparation_completed_on;
                                            $history->action='Acknowledgement';
                                            // $history->current = $changeControl->audit_preparation_completed_by;
                                            $history->comment = $request->comment;
                                            $history->user_id = Auth::user()->id;
                                            $history->user_name = Auth::user()->name;
                                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                            $history->origin_state = $lastDocument->status;
                                            $history->change_to = " Audit";
                                            $history->change_from = $lastDocument->status;
                                            $history->stage = " Audit";
                                            if (is_null($lastDocument->audit_preparation_completed_by_lead_auditor) || $lastDocument->audit_preparation_completed_by_lead_auditor === '') {
                                                $history->action_name = 'New';
                                            } else {
                                                $history->action_name = 'Update';
                                            }
                                            $history->save();

                                            $list = Helpers::getInitiatorUserList($changeControl->division_id);
                                            foreach ($list as $u) {
                                                $email = Helpers::getInitiatorEmail($u->user_id);
                                                    if ($email !== null) {
                                                    Mail::send(
                                                        'mail.view-mail',
                                                        ['data' => $changeControl, 'site' => "Internal Audit", 'history' => "Review", 'process' => 'Internal Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                                        function ($message) use ($email, $changeControl) {
                                                            $message->to($email)
                                                            ->subject("Agio Notification: Internal Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                                                        }
                                                    );
                                                }
                                            }

                                $changeControl->update();
                        }
                        $stageCheck->save();
                    }

                    if($responseData && $stageCheck->status == 'Complete'){
                        $changeControl->stage = "3";
                        $changeControl->status = "Audit";
                        $changeControl->audit_preparation_completed_by_lead_auditor = Auth::user()->name;
                        $changeControl->audit_preparation_completed_on_lead_auditor = Carbon::now()->format('d-M-Y');
                        $changeControl->acknowledge_commnet_lead_auditor = $request->comment;
                        $history = new InternalAuditTrial();
                                    $history->InternalAudit_id = $id;
                                    $history->activity_type = 'Acknowledgement By, Acknowledgement On';
                                    if (is_null($lastDocument->audit_preparation_completed_by_lead_auditor) || $lastDocument->audit_preparation_completed_by_lead_auditor === '') {
                                        $history->previous = "Not Applicable";
                                    } else {
                                        $history->previous = $lastDocument->audit_preparation_completed_by_lead_auditor . ' , ' . $lastDocument->audit_preparation_completed_on_lead_auditor;
                                    }
                                    $history->current = $changeControl->audit_preparation_completed_by_lead_auditor . ' , ' . $changeControl->audit_preparation_completed_on;
                                    $history->action='Acknowledgement';
                                    // $history->current = $changeControl->audit_preparation_completed_by;
                                    $history->comment = $request->comment;
                                    $history->user_id = Auth::user()->id;
                                    $history->user_name = Auth::user()->name;
                                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                    $history->origin_state = $lastDocument->status;
                                    $history->change_to = " Audit";
                                    $history->change_from = $lastDocument->status;
                                    $history->stage = " Audit";
                                    if (is_null($lastDocument->audit_preparation_completed_by) || $lastDocument->audit_preparation_completed_by === '') {
                                        $history->action_name = 'New';
                                    } else {
                                        $history->action_name = 'Update';
                                    }
                                    $history->save();

                                    $list = Helpers::getInitiatorUserList($changeControl->division_id);
                                    foreach ($list as $u) {
                                        $email = Helpers::getInitiatorEmail($u->user_id);
                                            if ($email !== null) {
                                            Mail::send(
                                                'mail.view-mail',
                                                ['data' => $changeControl, 'site' => "Internal Audit", 'history' => "Review", 'process' => 'Internal Audit', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                                function ($message) use ($email, $changeControl) {
                                                    $message->to($email)
                                                    ->subject("Agio Notification: Internal Audit, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Review");
                                                }
                                            );
                                        }
                                    }

                        $changeControl->update();

                        toastr()->success('Document Sent');
                        return back();

                    }
                    else{

                        toastr()->success('Document Sent');
                        return back();
                    }
                }




        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function noCapastate(Request $request, $id){

        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = InternalAudit::find($id);
            $lastDocument = InternalAudit::find($id);


        if ($changeControl->stage == 4) {

           
                    $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'Internal Audit')
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

                    $actionchilds = ActionItem::where('parent_id', $id)
                        ->where('parent_type', 'Internal Audit')
                        ->get();
                            $hasPendingaction = false;
                            foreach ($actionchilds as $ext) {
                                $actionchildstatus = trim(strtolower($ext->status));
                                if ($actionchildstatus !== 'closed - done') {
                                    $hasPendingaction = true;
                                    break;
                                }
                            }
                    if ($hasPendingaction) {
                        // $actionchildstatus = trim(strtolower($extensionchild->status));
                        if ($hasPendingaction) {
                            Session::flash('swal', [
                                'title' => 'Action Item Child Pending!',
                                'message' => 'You cannot proceed until Action Item Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        }
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Document Sent',
                            'type' => 'success',
                        ]);
                    }

                    $capachilds = Capa::where('parent_id', $id)
                        ->where('parent_type', 'Internal Audit')
                        ->get();
                            $hasPending = false;
                            foreach ($capachilds as $ext) {
                                $capachildstatus = trim(strtolower($ext->status));
                                if ($capachildstatus !== 'closed - done') {
                                    $hasPending = true;
                                    break;
                                }
                            }
                    if ($hasPending) {
                        // $capachildstatus = trim(strtolower($extensionchild->status));
                        if ($hasPending) {
                            Session::flash('swal', [
                                'title' => 'CAPA Child Pending!',
                                'message' => 'You cannot proceed until CAPA Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        }
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Document Sent',
                            'type' => 'success',
                        ]);
                    }
                    $rcachilds = RootCauseAnalysis::where('parent_id', $id)
                        ->where('parent_type', 'Internal Audit')
                        ->get();
                            $hasPendingRCA = false;
                            foreach ($rcachilds as $ext) {
                                $rcachildstatus = trim(strtolower($ext->status));
                                if ($rcachildstatus !== 'closed - done') {
                                    $hasPendingRCA = true;
                                    break;
                                }
                            }
                    if ($hasPendingRCA) {
                        // $rcachildstatus = trim(strtolower($extensionchild->status));
                        if ($hasPendingRCA) {
                            Session::flash('swal', [
                                'title' => 'RCA Child Pending!',
                                'message' => 'You cannot proceed until RCA Child is Closed-Done.',
                                'type' => 'warning',
                            ]);

                        return redirect()->back();
                        }
                    } else {
                        // Flash message for success (when the form is filled correctly)
                        Session::flash('swal', [
                            'title' => 'Success!',
                            'message' => 'Document Sent',
                            'type' => 'success',
                        ]);
                    }

            $changeControl->stage = "5";
            $changeControl->status = "Response Verification";
            $changeControl->no_capa_plan_by = Auth::user()->name;
            $changeControl->no_capa_plan_on = Carbon::now()->format('d-M-Y');
            $changeControl->no_capa_plan_required_comment = $request->comment;
                        $history = new InternalAuditTrial();
                        $history->InternalAudit_id = $id;
                        $history->activity_type = 'No CAPAs Required By, No CAPAs Required On';
                        if (is_null($lastDocument->no_capa_plan_by) || $lastDocument->no_capa_plan_by === '') {
                            $history->previous = "Not Applicable";
                        } else {
                            $history->previous = $lastDocument->no_capa_plan_by . ' , ' . $lastDocument->no_capa_plan_on;
                        }
                        $history->current = $changeControl->no_capa_plan_by . ' , ' . $changeControl->no_capa_plan_on;
                        $history->action='No CAPAs Required';
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to = "Response Verification";
                        $history->change_from = $lastDocument->status;
                        $history->stage = "Response Verification";
                        if (is_null($lastDocument->no_capa_plan_by) || $lastDocument->no_capa_plan_by === '') {
                            $history->action_name = 'New';
                        } else {
                            $history->action_name = 'Update';
                        }
                        $history->save();
                
                     $list = Helpers::getAuditManagerUserList($changeControl->division_id);
                            foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {

                                    $data = [
                                        'data'    => $changeControl,
                                        'site'    => "Internal Audit",
                                        'history' => "CAPA Plan Proposed",
                                        'process' => 'Internal Audit',
                                        'comment' => $history->comments,
                                        'user'    => Auth::user()->name
                                    ];
                                    SendMail::dispatch(
                                        $data,
                                        $email,
                                        $changeControl,      
                                        'Internal Audit'      
                                    );

                                } catch (\Exception $e) {

                                    \Log::error('Queue Dispatch Error', [
                                        'email' => $email,
                                        'error' => $e->getMessage()
                                    ]);

                                }

                            }
                        }

            $changeControl->update();
            $history = new InternalAuditStageHistory();
            $history->type = "Internal Audit";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $changeControl->stage;
            $history->status = $changeControl->status;
            $history->save();
            toastr()->success('Document Sent');
            return back();
        }
    }
}
    public function RejectStateChange(Request $request, $id)
    {

        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = InternalAudit::find($id);
            $lastDocument = InternalAudit::find($id);

            // if ($changeControl->stage == 4) {
            //     $changeControl->stage = "6";
            //     $changeControl->status = "Closed - Done";
            //     $changeControl->no_capa_plan_by = Auth::user()->name;
            //     $changeControl->no_capa_plan_on = Carbon::now()->format('d-M-Y');
            //     $changeControl->no_capa_plan_required_comment = $request->comment;
            //     $changeControl->update();
            //     $history = new InternalAuditStageHistory();
            //     $history->type = "Internal Audit";
            //     $history->doc_id = $id;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->comment = $request->comment;
            //     $history->stage_id = $changeControl->stage;
            //     $history->status = $changeControl->status;
            //     $history->save();
            //     toastr()->success('Document Sent');
            //     return back();
            // }



            if ($changeControl->stage == 2) {
                $changeControl->stage = "1";
                $changeControl->status = "Opened";
                $changeControl->more_info_2_by = Auth::user()->name;
                $changeControl->more_info_2_on = Carbon::now()->format('d-M-Y');
                $changeControl->audit_observation_submitted_by = Auth::user()->name;
                $changeControl->audit_observation_submitted_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_info_2_comment = $request->comment;
                            $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'More Info Required';
                            // if (is_null($lastDocument->more_info_2_by) || $lastDocument->more_info_2_by === '') {
                            //   $history->previous = "Not Applicable";
                            // } else {
                            //     $history->previous = 'Not Applicable';
                            // }
                            $history->previous = 'Not Applicable';
                            $history->current = 'Not Applicable';
                            $history->action='More Info Required';
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->change_to = "Opened";
                            $history->change_from = $lastDocument->status;
                            $history->stage = "Opened";
                            // if (is_null($lastDocument->more_info_2_by) || $lastDocument->more_info_2_by === '') {
                            //     $history->action_name = 'New';
                            // } else {
                            //     $history->action_name = 'Update';
                            // }
                            $history->action_name = 'Not Applicable';
                            $history->save();
                       

                        $list = Helpers::getQAUserList($changeControl->division_id);
                            foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {

                                    $data = [
                                        'data'    => $changeControl,
                                        'site'    => "Internal Audit",
                                        'history' => "More Info Required",
                                        'process' => 'Internal Audit',
                                        'comment' => $history->comments,
                                        'user'    => Auth::user()->name
                                    ];
                                    SendMail::dispatch(
                                        $data,
                                        $email,
                                        $changeControl,      
                                        'Internal Audit'      
                                    );

                                } catch (\Exception $e) {

                                    \Log::error('Queue Dispatch Error', [
                                        'email' => $email,
                                        'error' => $e->getMessage()
                                    ]);

                                }

                            }
                        }
                        $list = Helpers::getCQAUsersList($changeControl->division_id);
                            foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                                try {

                                    $data = [
                                        'data'    => $changeControl,
                                        'site'    => "Internal Audit",
                                        'history' => "More Info Required",
                                        'process' => 'Internal Audit',
                                        'comment' => $history->comments,
                                        'user'    => Auth::user()->name
                                    ];
                                    SendMail::dispatch(
                                        $data,
                                        $email,
                                        $changeControl,      
                                        'Internal Audit'      
                                    );

                                } catch (\Exception $e) {

                                    \Log::error('Queue Dispatch Error', [
                                        'email' => $email,
                                        'error' => $e->getMessage()
                                    ]);

                                }

                            }
                        }


                $changeControl->update();
                $history = new InternalAuditStageHistory();
                $history->type = "Internal Audit";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
            // if ($changeControl->stage == 3) {
            //     $changeControl->stage = "1";
            //     $changeControl->status = "Opened";
            //     $changeControl->more_info_3_comment = $request->comment;
            //     $history = new InternalAuditStageHistory();
            //     $history->type = "Internal Audit";
            //     $history->doc_id = $id;
            //     $history->user_id = Auth::user()->id;
            //     $history->user_name = Auth::user()->name;
            //     $history->comment = $request->comment;
            //     $history->stage_id = $changeControl->stage;
            //     $history->status = $changeControl->status;
            //     $history->save();
            //     toastr()->success('Document Sent');
            //     return back();
            // }

            if ($changeControl->stage == 3) {
                $changeControl->stage = "1";
                $changeControl->status = "Opened";
                $changeControl->more_info_3_by = Auth::user()->name;
                $changeControl->more_info_3_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_info_3_comment = $request->comment;
                            $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Not Applicable';
                            // if (is_null($lastDocument->more_info_3_by) || $lastDocument->more_info_3_by === '') {
                            //   $history->previous = "Not Applicable";
                            // } else {
                            //     $history->previous = $lastDocument->more_info_3_by . ' , ' . $lastDocument->more_info_3_on;
                            // }
                            $history->previous = "Not Applicable";
                            $history->current = "Not Applicable";
                            $history->action='More Info Required';
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->change_to = "Opened";
                            $history->change_from = $lastDocument->status;
                            $history->stage = "Opened";
                            // if (is_null($lastDocument->more_info_3_by) || $lastDocument->more_info_3_by === '') {
                            //     $history->action_name = 'New';
                            // } else {
                            //     $history->action_name = 'Update';
                            // }
                            $history->action_name = 'Not Applicable';
                            $history->save();
                            $list = Helpers::getLeadAuditeeUserList($changeControl->division_id);
                                    foreach ($list as $u) {
                                    $email = Helpers::getUserEmail($u->user_id);
                                    if ($email !== null) {
                                        try {

                                            $data = [
                                                'data'    => $changeControl,
                                                'site'    => "Internal Audit",
                                                'history' => "More Info Required",
                                                'process' => 'Internal Audit',
                                                'comment' => $history->comments,
                                                'user'    => Auth::user()->name
                                            ];
                                            SendMail::dispatch(
                                                $data,
                                                $email,
                                                $changeControl,      
                                                'Internal Audit'      
                                            );

                                        } catch (\Exception $e) {

                                            \Log::error('Queue Dispatch Error', [
                                                'email' => $email,
                                                'error' => $e->getMessage()
                                            ]);

                                        }

                                    }
                                }

                       


                $changeControl->update();
                $history = new InternalAuditStageHistory();
                $history->type = "Internal Audit";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
    public function InternalAuditCancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = InternalAudit::find($id);
            $lastDocument = InternalAudit::find($id);

            if ($changeControl->stage == 1) {
                $changeControl->stage = "0";
                $changeControl->status = "Closed-Cancelled";
                $changeControl->cancelled_1_by = Auth::user()->name;
                $changeControl->cancelled_1_on = Carbon::now()->format('d-M-Y');
                $changeControl->cancel_1_comment = $request->comment;

                $Capachild = Capa::where('parent_id', $id)
                    ->where('parent_type', 'Internal Audit')
                    ->get();

                foreach ($Capachild as $child) {
                    $child->stage = "0";
                    $child->status = "Closed - Cancelled";
                    // $child->cancelled_by = Auth::user()->name;
                    // $child->cancelled_on = Carbon::now()->format('d-M-Y');
                    $child->save();
                }

                $ExtensionChild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'Internal Audit')
                    ->get();

                foreach ($ExtensionChild as $child) {
                    $child->stage = "0";
                    $child->status = "Closed - Cancelled";
                    // $child->cancelled_by = Auth::user()->name;
                    // $child->cancelled_on = Carbon::now()->format('d-M-Y');
                    $child->save();
                }

                $ActionChild = ActionItem::where('parent_id', $id)
                    ->where('parent_type', 'Internal Audit')
                    ->get();

                foreach ($ActionChild as $child) {
                    $child->stage = "0";
                    $child->status = "Closed - Cancelled";
                    // $child->cancelled_by = Auth::user()->name;
                    // $child->cancelled_on = Carbon::now()->format('d-M-Y');
                    $child->save();
                }

                $RCAChild = RootCauseAnalysis::where('parent_id', $id)
                    ->where('parent_type', 'Internal Audit')
                    ->get();

                foreach ($RCAChild as $child) {
                    $child->stage = "0";
                    $child->status = "Closed - Cancelled";
                    // $child->cancelled_by = Auth::user()->name;
                    // $child->cancelled_on = Carbon::now()->format('d-M-Y');
                    $child->save();
                }

                $ObservationChild = Observation::where('parent_id', $id)
                    ->where('parent_type', 'Internal Audit')
                    ->get();

                foreach ($ObservationChild as $child) {
                    $child->stage = "0";
                    $child->status = "Closed - Cancelled";
                    // $child->cancelled_by = Auth::user()->name;
                    // $child->cancelled_on = Carbon::now()->format('d-M-Y');
                    $child->save();
                }

                                $history = new InternalAuditTrial();
                                $history->InternalAudit_id = $id;
                                $history->activity_type = 'Cancel By, Cancel On';
                                if (is_null($lastDocument->cancelled_1_by) || $lastDocument->cancelled_1_by === '') {
                                  $history->previous = "Not Applicable";
                                } else {
                                    $history->previous = $lastDocument->cancelled_1_by . ' , ' . $lastDocument->cancelled_1_on;
                                }
                                $history->current = $changeControl->cancelled_1_by . ' , ' . $changeControl->cancelled_1_on;
                                $history->action='Cancel';
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->id;
                                $history->user_name = Auth::user()->name;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->change_to = "Closed-Cancelled";
                                $history->change_from = $lastDocument->status;
                                $history->stage = "Closed-Cancelled";
                                if (is_null($lastDocument->cancelled_1_by) || $lastDocument->cancelled_1_by === '') {
                                    $history->action_name = 'New';
                                } else {
                                    $history->action_name = 'Update';
                                }
                                $history->save();
                                $list = Helpers::getLeadAuditeeUserList($changeControl->division_id);
                                    foreach ($list as $u) {
                                    $email = Helpers::getUserEmail($u->user_id);
                                    if ($email !== null) {
                                        try {

                                            $data = [
                                                'data'    => $changeControl,
                                                'site'    => "Internal Audit",
                                                'history' => "Cancel",
                                                'process' => 'Internal Audit',
                                                'comment' => $history->comments,
                                                'user'    => Auth::user()->name
                                            ];
                                            SendMail::dispatch(
                                                $data,
                                                $email,
                                                $changeControl,      
                                                'Internal Audit'      
                                            );

                                        } catch (\Exception $e) {

                                            \Log::error('Queue Dispatch Error', [
                                                'email' => $email,
                                                'error' => $e->getMessage()
                                            ]);

                                        }

                                    }
                                }
                                $list = Helpers::getCQAUsersList($changeControl->division_id);
                                    foreach ($list as $u) {
                                    $email = Helpers::getUserEmail($u->user_id);
                                    if ($email !== null) {
                                        try {

                                            $data = [
                                                'data'    => $changeControl,
                                                'site'    => "Internal Audit",
                                                'history' => "Cancel",
                                                'process' => 'Internal Audit',
                                                'comment' => $history->comments,
                                                'user'    => Auth::user()->name
                                            ];
                                            SendMail::dispatch(
                                                $data,
                                                $email,
                                                $changeControl,      
                                                'Internal Audit'      
                                            );

                                        } catch (\Exception $e) {

                                            \Log::error('Queue Dispatch Error', [
                                                'email' => $email,
                                                'error' => $e->getMessage()
                                            ]);

                                        }

                                    }
                                }
                                $list = Helpers::getQAUserList($changeControl->division_id);
                                    foreach ($list as $u) {
                                    $email = Helpers::getUserEmail($u->user_id);
                                    if ($email !== null) {
                                        try {

                                            $data = [
                                                'data'    => $changeControl,
                                                'site'    => "Internal Audit",
                                                'history' => "Cancel",
                                                'process' => 'Internal Audit',
                                                'comment' => $history->comments,
                                                'user'    => Auth::user()->name
                                            ];
                                            SendMail::dispatch(
                                                $data,
                                                $email,
                                                $changeControl,      
                                                'Internal Audit'      
                                            );

                                        } catch (\Exception $e) {

                                            \Log::error('Queue Dispatch Error', [
                                                'email' => $email,
                                                'error' => $e->getMessage()
                                            ]);

                                        }

                                    }
                                }
                                
                $changeControl->update();
                $history = new InternalAuditStageHistory();
                $history->type = "Internal Audit";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 2) {
                $changeControl->stage = "0";
                $changeControl->status = "Closed-Cancelled";
                $changeControl->cancelled_2_by = Auth::user()->name;
                $changeControl->cancelled_2_on = Carbon::now()->format('d-M-Y');
                $changeControl->cancel_2_comment = $request->comment;
                            $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Cancel By, Cancel On';
                                if (is_null($lastDocument->cancelled_2_by) || $lastDocument->cancelled_2_by === '') {
                                  $history->previous = "Not Applicable";
                                } else {
                                    $history->previous = $lastDocument->cancelled_2_by . ' , ' . $lastDocument->cancelled_2_on;
                                }
                                $history->current = $changeControl->cancelled_2_by . ' , ' . $changeControl->cancelled_2_on;
                                $history->action='Cancel';
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->change_to = "Closed-Cancelled";
                            $history->change_from = $lastDocument->status;
                            $history->stage = "Closed-Cancelled";
                            if (is_null($lastDocument->cancelled_2_by) || $lastDocument->cancelled_2_by === '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                            $history->save();
                             $list = Helpers::getLeadAuditeeUserList($changeControl->division_id);
                                    foreach ($list as $u) {
                                    $email = Helpers::getUserEmail($u->user_id);
                                    if ($email !== null) {
                                        try {

                                            $data = [
                                                'data'    => $changeControl,
                                                'site'    => "Internal Audit",
                                                'history' => "Cancel",
                                                'process' => 'Internal Audit',
                                                'comment' => $history->comments,
                                                'user'    => Auth::user()->name
                                            ];
                                            SendMail::dispatch(
                                                $data,
                                                $email,
                                                $changeControl,      
                                                'Internal Audit'      
                                            );

                                        } catch (\Exception $e) {

                                            \Log::error('Queue Dispatch Error', [
                                                'email' => $email,
                                                'error' => $e->getMessage()
                                            ]);

                                        }

                                    }
                                }
                                $list = Helpers::getCQAUsersList($changeControl->division_id);
                                    foreach ($list as $u) {
                                    $email = Helpers::getUserEmail($u->user_id);
                                    if ($email !== null) {
                                        try {

                                            $data = [
                                                'data'    => $changeControl,
                                                'site'    => "Internal Audit",
                                                'history' => "Cancel",
                                                'process' => 'Internal Audit',
                                                'comment' => $history->comments,
                                                'user'    => Auth::user()->name
                                            ];
                                            SendMail::dispatch(
                                                $data,
                                                $email,
                                                $changeControl,      
                                                'Internal Audit'      
                                            );

                                        } catch (\Exception $e) {

                                            \Log::error('Queue Dispatch Error', [
                                                'email' => $email,
                                                'error' => $e->getMessage()
                                            ]);

                                        }

                                    }
                                }
                                $list = Helpers::getQAUserList($changeControl->division_id);
                                    foreach ($list as $u) {
                                    $email = Helpers::getUserEmail($u->user_id);
                                    if ($email !== null) {
                                        try {

                                            $data = [
                                                'data'    => $changeControl,
                                                'site'    => "Internal Audit",
                                                'history' => "Cancel",
                                                'process' => 'Internal Audit',
                                                'comment' => $history->comments,
                                                'user'    => Auth::user()->name
                                            ];
                                            SendMail::dispatch(
                                                $data,
                                                $email,
                                                $changeControl,      
                                                'Internal Audit'      
                                            );

                                        } catch (\Exception $e) {

                                            \Log::error('Queue Dispatch Error', [
                                                'email' => $email,
                                                'error' => $e->getMessage()
                                            ]);

                                        }

                                    }
                                }
                $changeControl->update();
                $history = new InternalAuditStageHistory();
                $history->type = "Internal Audit";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 3) {
                $changeControl->stage = "0";
                $changeControl->status = "Closed-Cancelled";
                $changeControl->cancelled_by = Auth::user()->name;
                $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
                $changeControl->cancel_3_comment = $request->comment;
                            $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Cancel By, Cancel On';
                            if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                              $history->previous = "Not Applicable";
                            } else {
                                $history->previous = $lastDocument->cancelled_by . ' , ' . $lastDocument->cancelled_on;
                            }
                            $history->current = $changeControl->cancelled_by . ' , ' . $changeControl->cancelled_on;
                            $history->action='Cancel';
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->origin_state = $lastDocument->status;
                            $history->change_to = "Closed-Cancelled";
                            $history->stage = "Closed-Cancelled";
                            if (is_null($lastDocument->cancelled_2_by) || $lastDocument->cancelled_2_by === '') {
                                $history->action_name = 'New';
                            } else {
                                $history->action_name = 'Update';
                            }
                            $history->save();
                             $list = Helpers::getLeadAuditeeUserList($changeControl->division_id);
                                    foreach ($list as $u) {
                                    $email = Helpers::getUserEmail($u->user_id);
                                    if ($email !== null) {
                                        try {

                                            $data = [
                                                'data'    => $changeControl,
                                                'site'    => "Internal Audit",
                                                'history' => "Cancel",
                                                'process' => 'Internal Audit',
                                                'comment' => $history->comments,
                                                'user'    => Auth::user()->name
                                            ];
                                            SendMail::dispatch(
                                                $data,
                                                $email,
                                                $changeControl,      
                                                'Internal Audit'      
                                            );

                                        } catch (\Exception $e) {

                                            \Log::error('Queue Dispatch Error', [
                                                'email' => $email,
                                                'error' => $e->getMessage()
                                            ]);

                                        }

                                    }
                                }
                                $list = Helpers::getCQAUsersList($changeControl->division_id);
                                    foreach ($list as $u) {
                                    $email = Helpers::getUserEmail($u->user_id);
                                    if ($email !== null) {
                                        try {

                                            $data = [
                                                'data'    => $changeControl,
                                                'site'    => "Internal Audit",
                                                'history' => "Cancel",
                                                'process' => 'Internal Audit',
                                                'comment' => $history->comments,
                                                'user'    => Auth::user()->name
                                            ];
                                            SendMail::dispatch(
                                                $data,
                                                $email,
                                                $changeControl,      
                                                'Internal Audit'      
                                            );

                                        } catch (\Exception $e) {

                                            \Log::error('Queue Dispatch Error', [
                                                'email' => $email,
                                                'error' => $e->getMessage()
                                            ]);

                                        }

                                    }
                                }
                                $list = Helpers::getQAUserList($changeControl->division_id);
                                    foreach ($list as $u) {
                                    $email = Helpers::getUserEmail($u->user_id);
                                    if ($email !== null) {
                                        try {

                                            $data = [
                                                'data'    => $changeControl,
                                                'site'    => "Internal Audit",
                                                'history' => "Cancel",
                                                'process' => 'Internal Audit',
                                                'comment' => $history->comments,
                                                'user'    => Auth::user()->name
                                            ];
                                            SendMail::dispatch(
                                                $data,
                                                $email,
                                                $changeControl,      
                                                'Internal Audit'      
                                            );

                                        } catch (\Exception $e) {

                                            \Log::error('Queue Dispatch Error', [
                                                'email' => $email,
                                                'error' => $e->getMessage()
                                            ]);

                                        }

                                    }
                                }
                $changeControl->update();
                $history = new InternalAuditStageHistory();
                $history->type = "Internal Audit";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $changeControl->stage;
                $history->status = $changeControl->status;
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function InternalAuditTrialShow($id)
    {
        $audit = InternalAuditTrial::where('InternalAudit_id', $id)->orderByDESC('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = InternalAudit::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
        return view('frontend.internalAudit.audit-trial', compact('audit', 'document', 'today'));
    }

    public function InternalAuditTrialDetails($id)
    {
        $detail = InternalAuditTrial::find($id);

        $detail_data = InternalAuditTrial::where('activity_type', $detail->activity_type)->where('InternalAudit_id', $detail->InternalAudit_id)->latest()->get();

        $doc = InternalAudit::where('id', $detail->InternalAudit_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);
        return view('frontend.internalAudit.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
    }

        public function internal_audit_child(Request $request, $id)
        {
            
            if($request->child_type == 'Observations'){

                $parent_id = $id;
                $parent_type = "Internal Audit";
                $parent_division_id = InternalAudit::where('id', $id)->value('division_id');
                // $record_number = ((RecordNumber::first()->value('counter')) + 1);
                // $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);


                 $old_record = Observation::select('id', 'division_code', 'record')->get();
                $lastAi = Observation::orderBy('record', 'desc')->first();
                $record = $lastAi ? $lastAi->record + 1 : 1;
                $record = str_pad($record, 4, '0', STR_PAD_LEFT);
                $record_number = $record;



                $currentDate = Carbon::now();
                $formattedDate = $currentDate->addDays(30);
                $due_date = $formattedDate->format('d-M-Y');
                // dd('tet');
                return view('frontend.forms.observation', compact('record_number', 'due_date', 'parent_id', 'parent_type','parent_division_id'));
            }
            
            if ($request->child_type == "Extension")
            {
                $parent_id = $id;
                $parent_type = "Internal Audit";
                $parent_division_id = InternalAudit::where('id', $id)->value('division_id');
                // $record_number = ((RecordNumber::first()->value('counter')) + 1);
                // $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
                // $record = ((RecordNumber::first()->value('counter')) + 1);
                // $record = str_pad($record_number, 4, '0', STR_PAD_LEFT);


                 $old_record = extension_new::select('id', 'division_id', 'record')->get();
                $lastAi = extension_new::orderBy('record', 'desc')->first();
                $record = $lastAi ? $lastAi->record + 1 : 1;
        
                $record = str_pad($record, 4, '0', STR_PAD_LEFT);
                $record_number = $record;
           
              


                $parent_due_date = InternalAudit::where('id', $id)->value('due_date');
                $relatedRecords = Helpers::getAllRelatedRecords();
                $data = InternalAudit::find($id);
                $extension_record = Helpers::getDivisionName($data->division_id ) . '/' . 'IA' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
                $count = Helpers::getChildData($id, $parent_type);
                $countData = $count + 1;
                   
                 if ($request->child_type == "Extension"){
            $lastExtension = extension_new::where('parent_id', $id)
                                ->where('parent_type', 'Internal Audit')
                                ->orderByDesc('id')
                                ->first();
                    
                            if (!$lastExtension) {
                                $extensionCount = 1;
                            } else {
                                if (in_array($lastExtension->status, ['Closed - Done', 'Closed - Reject','Closed Cancelled'])) {
                                    $extensionCount = $lastExtension->count + 1;
                                } else {
                                    return redirect()->back()->with('error', $lastExtension->count . 'st extension not complete.');
                                }
                            }

                        }  


            
                return view('frontend.extension.extension_new', compact('parent_type','record','record_number','parent_id','parent_due_date','extension_record','parent_division_id', 'relatedRecords','countData',));
            }


        }

        public function multiple_child(Request $request, $id)
        {
            
            $old_records = InternalAudit::select('id', 'division_id', 'record')->get();
            $parent_id = $id;
          //  $record_number = ((RecordNumber::first()->value('counter')) + 1);
            $parent_division_id = InternalAudit::where('id', $id)->value('division_id');
           // $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            // $record = ((RecordNumber::first()->value('counter')) + 1);
            // $record = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            $currentDate = Carbon::now();
            $formattedDate = $currentDate->addDays(30);
            $due_date = $formattedDate->format('d-M-Y');
            $parent_type = "Internal Audit";
            if($request->child_type == 'action_item'){
                $p_record = InternalAudit::find($id);
                $data = InternalAudit::find($id);
                $data_record = Helpers::getDivisionName($p_record->division_id ) . '/' . 'IA' .'/' . date('Y') .'/' . str_pad($p_record->record, 4, '0', STR_PAD_LEFT);
                 $parent_record = $data_record;
                $old_record = ActionItem::select('id', 'division_id', 'record')->get();
                $lastAi = ActionItem::orderBy('record', 'desc')->first();
                $record_number = $lastAi ? $lastAi->record + 1 : 1;
                $record = str_pad($record_number, 4, '0', STR_PAD_LEFT);
                $record_number = $record;
                 $pre = [
                    'DEV' => \App\Models\Deviation::class,
                'AP' => \App\Models\AuditProgram::class,
                'AI' => \App\Models\ActionItem::class,
                'Exte' => \App\Models\extension_new::class,
                'Resam' => \App\Models\Resampling::class,
                'Obse' => \App\Models\Observation::class,
                'RCA' => \App\Models\RootCauseAnalysis::class,
                'RA' => \App\Models\RiskAssessment::class,
                'MR' => \App\Models\ManagementReview::class,
                'EA' => \App\Models\Auditee::class,
                'IA' => \App\Models\InternalAudit::class,
                'CAPA' => \App\Models\Capa::class,
                'CC' => \App\Models\CC::class,
                'ND' => \App\Models\Document::class,
                'Lab' => \App\Models\LabIncident::class,
                'EC' => \App\Models\EffectivenessCheck::class,
                'OOSChe' => \App\Models\OOS::class,
                'OOT' => \App\Models\OOT::class,
                'OOC' => \App\Models\OutOfCalibration::class,
                'MC' => \App\Models\MarketComplaint::class,
                'NC' => \App\Models\NonConformance::class,
                'Incident' => \App\Models\Incident::class,
                'FI' => \App\Models\FailureInvestigation::class,
                'ERRATA' => \App\Models\errata::class,
                'OOSMicr' => \App\Models\OOS_micro::class,
                // Add other models as necessary...
                ];

                // Create an empty collection to store the related records
                $relatedRecords = collect();

                // Loop through each model and get the records, adding the process name to each record
                foreach ($pre as $processName => $modelClass) {
                $records = $modelClass::all()->map(function ($record) use ($processName) {
                    $record->process_name = $processName; // Attach the process name to each record
                    return $record;
                });

                // Merge the records into the collection
                $relatedRecords = $relatedRecords->merge($records);
                }

              
                return view('frontend.action-item.action-item', compact('record_number', 'due_date', 'parent_id', 'parent_type','parent_division_id','record', 'data_record','data','relatedRecords','parent_record'));
            }
            if($request->child_type == 'r_c_a'){

                 $old_record = RootCauseAnalysis::select('id', 'division_id', 'record')->get();
                $lastAi = RootCauseAnalysis::orderBy('record', 'desc')->first();
                $record = $lastAi ? $lastAi->record + 1 : 1;
               $record = str_pad($record, 4, '0', STR_PAD_LEFT);
                $record_number =$record;
                return view('frontend.forms.root-cause-analysis', compact('record_number', 'due_date', 'parent_id', 'parent_type','parent_division_id'));
            }
            if($request->child_type == 'capa'){
                $Capachild = InternalAudit::find($id);
                $reference_record = Helpers::getDivisionName($Capachild->division_id ) . '/' . 'IA' .'/' . date('Y') .'/' . str_pad($Capachild->record, 4, '0', STR_PAD_LEFT);

                $relatedRecords = Helpers::getAllRelatedRecords();

                 $old_record = Capa::select('id', 'division_id', 'record')->get();
                $lastAi = Capa::orderBy('record', 'desc')->first();
                $record = $lastAi ? $lastAi->record + 1 : 1;
               $record = str_pad($record, 4, '0', STR_PAD_LEFT);
                $record_number =$record;

                return view('frontend.forms.capa', compact('record_number', 'due_date', 'parent_id', 'parent_type','old_records','relatedRecords','reference_record','parent_division_id'));
            }

            if ($request->child_type == "Extension")
            {
                    $parent_due_date = InternalAudit::where('id', $id)->value('due_date');
                    $relatedRecords = Helpers::getAllRelatedRecords();
                    $data = InternalAudit::find($id);
                    $extension_record = Helpers::getDivisionName($data->division_id ) . '/' . 'IA' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
                    $count = Helpers::getChildData($id, $parent_type);
                    $countData = $count + 1; 

                    //   if ($request->child_type == "Extension"){
                    // $lastExtension = extension_new::where('parent_id', $id)
                    //             ->where('parent_type', 'Internal Audit')
                    //             ->orderByDesc('id')
                    //             ->first();
                    
                    //         if (!$lastExtension) {
                    //             $extensionCount = 1;
                    //         } else {
                    //             if (in_array($lastExtension->status, ['Closed - Done', 'Closed - Reject','Closed Cancelled'])) {
                    //                 $extensionCount = $lastExtension->count + 1;
                    //             } else {
                    //                 return redirect()->back()->with('error', $lastExtension->count . 'st extension not complete.');
                    //             }
                    //         }

                    //     }  

                     $old_record = extension_new::select('id', 'division_id', 'record')->get();
                $lastAi = extension_new::orderBy('record', 'desc')->first();
                $record = $lastAi ? $lastAi->record + 1 : 1;
        
                $record = str_pad($record, 4, '0', STR_PAD_LEFT);
                $record_number = $record;
           

                    return view('frontend.extension.extension_new', compact('parent_type','record','record_number','parent_id','parent_due_date','extension_record','parent_division_id', 'relatedRecords','countData',));
            }
            

        }


    // public static function singleReport($id)
    // {
    //     $data = InternalAudit::find($id);
    //     $checklist1 = IA_checklist_tablet_compression::where('ia_id', $id)->first();
    //     $checklist2 = IA_checklist_tablet_coating::where('ia_id', $id)->first();
    //     $checklist3 = IA_checklist_capsule_paking::where('ia_id', $id)->first();
    //     $checklist4 = Checklist_Capsule::where('ia_id', $id)->first();
    //     $checklist5 = IA_liquid_ointment::where('ia_id', $id)->first();
    //     $checklist6 = IA_dispencing_manufacturing::where('ia_id', $id)->first();
    //     $checklist7 = IA_ointment_paking::where('ia_id', $id)->first();
    //     $checklist9 = IA_checklist_engineering::where('ia_id', $id)->first();
    //     $checklist10 = IA_quality_control::where('ia_id', $id)->first();
    //     $checklist11 = IA_checklist_stores::where('ia_id', $id)->first();
    //     $checklist12 = IA_checklist_hr::where('ia_id', $id)->first();
    //     $checklist13 = IA_checklist_dispensing::where('ia_id', $id)->first();
    //     $checklist14 = IA_checklist_production_injection::where('ia_id', $id)->first();
    //     $checklist15 = IA_checklist_manufacturing_filling::where('ia_id', $id)->first();
    //     $checklist16 = IA_checklist_analytical_research::where('ia_id', $id)->first();
    //     $checklist17 = IA_checklist__formulation_research::where('ia_id', $id)->first();
    //     $auditAssessmentChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditAssessmentChecklist'])->first();
    //     $auditPersonnelChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditPersonnelChecklist'])->firstOrNew();
    //     $auditfacilityChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditfacilityChecklist'])->firstOrNew();
    //     $auditMachinesChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditMachinesChecklist'])->firstOrNew();
    //     $auditProductionChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditProductionChecklist'])->firstOrNew();
    //     $auditMaterialsChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditMaterialsChecklist'])->firstOrNew();
    //     $auditQualityControlChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditQualityControlChecklist'])->firstOrNew();
    //     $auditQualityAssuranceChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditQualityAssuranceChecklist'])->firstOrNew();
    //     $auditPackagingChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditPackagingChecklist'])->firstOrNew();
    //     $auditSheChecklist = InternalAuditChecklistGrid::where(['ia_id' => $id, 'identifier' => 'auditSheChecklist'])->firstOrNew();






    //     if (!empty($data)) {
    //         $data->originator = User::where('id', $data->initiator_id)->value('name');
    //         $pdf = App::make('dompdf.wrapper');
    //         $time = Carbon::now();
    //         $pdf = PDF::loadview('frontend.internalAudit.singleReport', compact('data','checklist1','checklist2','checklist3','checklist4','checklist5','checklist6','checklist7','checklist9','checklist10','checklist11','checklist12','checklist13','checklist14','checklist15','checklist16','checklist17','auditAssessmentChecklist','auditPersonnelChecklist','auditfacilityChecklist','auditMachinesChecklist','auditProductionChecklist','auditMaterialsChecklist','auditQualityControlChecklist','auditQualityAssuranceChecklist','auditPackagingChecklist','auditSheChecklist'))
    //             ->setOptions([
    //                 'defaultFont' => 'sans-serif',
    //                 'isHtml5ParserEnabled' => true,
    //                 'isRemoteEnabled' => true,
    //                 'isPhpEnabled' => true,
    //             ]);
    //         $pdf->setPaper('A4');
    //         $pdf->render();
    //         $canvas = $pdf->getDomPDF()->getCanvas();
    //         $height = $canvas->get_height();
    //         $width = $canvas->get_width();
    //         $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');
    //         $canvas->page_text($width / 4, $height / 2, $data->status, null, 25, [0, 0, 0], 2, 6, -20);
    //         return $pdf->stream('Internal-Audit' . $id . '.pdf');
    //     }
    // }
    public static function singleReport($id)
    {
        $data = InternalAudit::find($id);
        $checklist1 = IA_checklist_tablet_compression::where('ia_id', $id)->first();
        $checklist2 = IA_checklist_tablet_coating::where('ia_id', $id)->first();
        $checklist3 = IA_checklist_capsule_paking::where('ia_id', $id)->first();
        $checklist4 = Checklist_Capsule::where('ia_id', $id)->first();
        $checklist5 = IA_liquid_ointment::where('ia_id', $id)->first();
        $checklist6 = IA_dispencing_manufacturing::where('ia_id', $id)->first();
        $checklist7 = IA_ointment_paking::where('ia_id', $id)->first();
        $checklist9 = IA_checklist_engineering::where('ia_id', $id)->first();
        $checklist10 = IA_quality_control::where('ia_id', $id)->first();
        $checklist11 = IA_checklist_stores::where('ia_id', $id)->first();
        $checklist12 = IA_checklist_hr::where('ia_id', $id)->first();
        $checklist13 = IA_checklist_dispensing::where('ia_id', $id)->first();
        $checklist14 = IA_checklist_production_injection::where('ia_id', $id)->first();
        $checklist15 = IA_checklist_manufacturing_filling::where('ia_id', $id)->first();
        $checklist16 = IA_checklist_analytical_research::where('ia_id', $id)->first();
        $checklist17 = IA_checklist__formulation_research::where('ia_id', $id)->first();



        $auditorview = InternalAuditorGrid::where(['auditor_id'=>$id, 'identifier'=>'Auditors'])->first();
        $grid_data = InternalAuditGrid::where('audit_id', $id)->where('type', "internal_audit")->first();
        $grid_Data3 = InternalAuditObservationGrid::where(['io_id' =>$id, 'identifier' => 'observations'])->first();
        $grid_Data5 = InternalAuditObservationGrid::where(['io_id' => $id, 'identifier' => 'Initial'])->first();

        $auditAgendaData = InternalAuditGrid::where(['audit_id' => $id, 'identifier' => 'Audit Agenda'])->first();
        $json = $auditAgendaData ? json_decode($auditAgendaData->data, true) : [];



        if (!empty($json)) {
            // Check if keys exist before unserializing
            $json['area_of_audit'] = isset($json['area_of_audit']) ? unserialize($json['area_of_audit']) : null;
            $json['start_date'] = isset($json['start_date']) ? unserialize($json['start_date']) : null;
            $json['start_time'] = isset($json['start_time']) ? unserialize($json['start_time']) : null;
            $json['end_date'] = isset($json['end_date']) ? unserialize($json['end_date']) : null;
            $json['end_time'] = isset($json['end_time']) ? unserialize($json['end_time']) : null;
            $json['auditor'] = isset($json['auditor']) ? unserialize($json['auditor']) : null;
            $json['auditee'] = isset($json['auditee']) ? unserialize($json['auditee']) : null;
            $json['remark'] = isset($json['remark']) ? unserialize($json['remark']) : null;
        }





        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.internalAudit.singleReport', compact('data','checklist1','checklist2','checklist3','checklist4','checklist5','checklist6','checklist7','checklist9','checklist10','checklist11','checklist12','checklist13','checklist14','checklist15','checklist16','checklist17','grid_data','auditorview','grid_Data3','grid_Data5','json'))
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
            $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
                $text = "$pageNumber of $pageCount";
                $font = $fontMetrics->getFont('sans-serif');
                $size = 9;
                $width = $fontMetrics->getTextWidth($text, $font, $size);

                $canvas->text(($canvas->get_width() - $width - 110), ($canvas->get_height() - 763), $text, $font, $size);
            });
            return $pdf->stream('Internal-Audit' . $id . '.pdf');
        }
    }


    public function internalAuditReview(Request $request, $id){
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


    public static function auditReport($id)
    {
        $doc = InternalAudit::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $data = InternalAuditTrial::where('InternalAudit_id', $id)->orderByDesc('id')->get();
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.internalAudit.auditReport', compact('data', 'doc'))
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
            $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $text = " $pageNumber of $pageCount";
            $font = $fontMetrics->getFont('sans-serif', 'normal');
            $size = 9;
            $width = $fontMetrics->getTextWidth($text, $font, $size);

            $canvas->text(($canvas->get_width() - $width - 110), ($canvas->get_height() - 26), $text, $font, $size);
            });
            return $pdf->stream('Internal-Audit' . $id . '.pdf');
        }
    }

    public static function observationSingleReport($id)
    {
        $data = InternalAudit::find($id);
        $internal_id = $id;
        $grid_Data3 = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'observations'])->firstOrCreate();
        $grid_Data4 = InternalAuditObservationGrid::where(['io_id' => $internal_id, 'identifier' => 'auditorroles'])->firstOrCreate();
        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.internalAudit.observation-tab-singleReport', compact('data','grid_Data3','grid_Data4'))
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
            return $pdf->stream('Internal-Audit' . $id . '.pdf');
        }
    }

}
