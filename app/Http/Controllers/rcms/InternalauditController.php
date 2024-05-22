<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\RecordNumber;
use Illuminate\Http\Request;
use App\Models\InternalAudit;
use App\Models\InternalAuditTrial;
use App\Models\RoleGroup;
use App\Models\InternalAuditGrid;
use App\Models\InternalAuditStageHistory;
use App\Models\User;
use App\Models\IA_checklist_compression;
use PDF;
use Helpers;
use Illuminate\Support\Facades\Mail;
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
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        // return $old_record;

        return view("frontend.forms.audit", compact('due_date', 'record_number', 'old_record'));

    }
    public function create(request $request)
    {
       $internalAudit = new InternalAudit();
        $internalAudit->form_type = "Internal-audit";
        $internalAudit->record = ((RecordNumber::first()->value('counter')) + 1);
        $internalAudit->initiator_id = Auth::user()->id;
        $internalAudit->division_id = $request->division_id;
        $internalAudit->external_agencies = $request->external_agencies;
       // $internalAudit->severity_level = $request->severity_level_select;
       $internalAudit->severity_level_form = $request->severity_level_form;
        $internalAudit->division_code = $request->division_code;
        $internalAudit->parent_id = $request->parent_id;
        $internalAudit->parent_type = $request->parent_type;
        $internalAudit->intiation_date = $request->intiation_date;
        $internalAudit->assign_to = $request->assign_to;
        $internalAudit->due_date = $request->due_date;
        $internalAudit->audit_schedule_start_date= $request->audit_schedule_start_date;
        $internalAudit->audit_schedule_end_date= $request->audit_schedule_end_date;
        $internalAudit->initiator_Group= $request->initiator_Group;
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
        $internalAudit->start_date = $request->start_date;
        $internalAudit->end_date = $request->end_date;
        $internalAudit->External_Auditing_Agency= $request->External_Auditing_Agency;
        $internalAudit->Relevant_Guideline= $request->Relevant_Guideline;
        $internalAudit->QA_Comments= $request->QA_Comments;
        $internalAudit->Others= $request->Others;
        // $internalAudit->file_attachment_guideline = $request->file_attachment_guideline;
        $internalAudit->Audit_Category= $request->Audit_Category;

        $internalAudit->Supplier_Details= $request->Supplier_Details;
        $internalAudit->Supplier_Site= $request->Supplier_Site;
        //$internalAudit->Facility =  implode(',', $request->Facility);
        //$internalAudit->Group = implode(',', $request->Group);
        $internalAudit->material_name = $request->material_name;
        $internalAudit->if_comments = $request->if_comments;
        $internalAudit->lead_auditor = $request->lead_auditor;
        $internalAudit->Audit_team =  implode(',', $request->Audit_team);
        $internalAudit->Auditee =  implode(',', $request->Auditee);
        $internalAudit->Auditor_Details = $request->Auditor_Details;
        $internalAudit->Comments = $request->Comments;
        $internalAudit->Audit_Comments1 = $request->Audit_Comments1;
        $internalAudit->Remarks = $request->Remarks;
        $internalAudit->refrence_record=  implode(',', $request->refrence_record);
        $internalAudit->Audit_Comments2 = $request->Audit_Comments2;
        $internalAudit->due_date = $request->due_date;
        $internalAudit->audit_start_date= $request->audit_start_date;

        $internalAudit->audit_end_date = $request->audit_end_date;
        // $internalAudit->external_others=$request->external_others;

//------------------------------------response and remarks input---------------------------------
//$internalaudit   = new table_cc_impactassement();
//$internalAudit->cc_id = $internalAudit->id;
for ($i = 1; $i <= 63; $i++) {
    $internalAudit->{"response_$i"} = $request->{"response_$i"};
    $internalAudit->{"remark_$i"} = $request->{"remark_$i"};
}

$IAchecklist  = new IA_checklist_compression();
$IAchecklist->cc_id = $IAchecklist->id;
for ($i = 1; $i <= 59; $i++) {
   $IAchecklist->{"response_$i"} = $request->{"response_$i"};
   $IAchecklist->{"remark_$i"} = $request->{"remark_$i"};
}
$IAchecklist->save();
//$internalAudit->save();




        $internalAudit->status = 'Opened';
        $internalAudit->stage = 1;

        if (!empty($request->inv_attachment)) {
            $files = [];
            if ($request->hasfile('inv_attachment')) {
                foreach ($request->file('inv_attachment') as $file) {
                    $name = $request->name . 'inv_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
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
                    $name = $request->name . 'file_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
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
                    $name = $request->name . 'file_attachment_guideline' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
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
                    $name = $request->name . 'myfile' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
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
            $data3->auditor = serialize($request->auditor);
        }
        if (!empty($request->auditee)) {
            $data3->auditee = serialize($request->auditee);
        }
        if (!empty($request->remarks)) {
            $data3->remark = serialize($request->remarks);
        }
        $data3->save();


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
        if (!empty($internalAudit->date)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Date of Initiator';
            $history->previous = "Null";
            $history->current = $internalAudit->date;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->assign_to)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Assigned to';
            $history->previous = "Null";
            $history->current = $internalAudit->assign_to;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->Initiator_Group)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Initiator Group';
            $history->previous = "Null";
            $history->current = $internalAudit->Initiator_Group;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->short_description)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $internalAudit->short_description;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->audit_type)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Type of Audit';
            $history->previous = "Null";
            $history->current = $internalAudit->audit_type;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->if_other)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'If Other';
            $history->previous = "Null";
            $history->current = $internalAudit->if_other;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->initial_comments)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Initial Comments';
            $history->previous = "Null";
            $history->current = $internalAudit->initial_comments;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->start_date)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Schedule Start Date';
            $history->previous = "Null";
            $history->current = $internalAudit->start_date;
            $history->comment = "Na";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->end_date)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Schedule End Date';
            $history->previous = "Null";
            $history->current = $internalAudit->end_date;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->audit_agenda)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Agenda';
            $history->previous = "Null";
            $history->current = $internalAudit->audit_agenda;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        // if (!empty($internalAudit->Facility)) {
        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $internalAudit->id;
        //     $history->activity_type = 'Facility Name';
        //     $history->previous = "Null";
        //     $history->current = $internalAudit->Facility;
        //     $history->comment = "NA";
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
        //     $history->previous = "Null";
        //     $history->current = $internalAudit->Group;
        //     $history->comment = "NA";
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
            $history->previous = "Null";
            $history->current = $internalAudit->material_name;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->lead_auditor)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Lead Auditor';
            $history->previous = "Null";
            $history->current = $internalAudit->lead_auditor;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->Audit_team)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Team';
            $history->previous = "Null";
            $history->current = $internalAudit->Audit_team;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->Auditee)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Auditee';
            $history->previous = "Null";
            $history->current = $internalAudit->Auditee;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->Auditor_Details)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'External Auditor Details';
            $history->previous = "Null";
            $history->current = $internalAudit->Auditor_Details;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->Comments)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Comments';
            $history->previous = "Null";
            $history->current = $internalAudit->Comments;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->Audit_Comments1)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Comments';
            $history->previous = "Null";
            $history->current = $internalAudit->Audit_Comments1;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->Remarks)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Remarks';
            $history->previous = "Null";
            $history->current = $internalAudit->Remarks;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->Reference_Recores1)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Reference Recores';
            $history->previous = "Null";
            $history->current = $internalAudit->Reference_Recores1;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->Reference_Recores2)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Reference Recores';
            $history->previous = "Null";
            $history->current = $internalAudit->Reference_Recores2;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->Audit_Comments2)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Comments';
            $history->previous = "Null";
            $history->current = $internalAudit->Audit_Comments2;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->inv_attachment)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Inv Attachment';
            $history->previous = "Null";
            $history->current = $internalAudit->inv_attachment;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->file_attachment)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'File Attachment';
            $history->previous = "Null";
            $history->current = $internalAudit->file_attachment;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }
        // if (!empty($internalAudit->file_attachment_guideline)) {
        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $internalAudit->id;
        //     $history->activity_type = 'File Attachment';
        //     $history->previous = "Null";
        //     $history->current = $internalAudit->file_attachment_guideline;
        //     $history->comment = "NA";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $internalAudit->status;
        //     $history->save();
        // }

        if (!empty($internalAudit->Audit_file)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Attachments';
            $history->previous = "Null";
            $history->current = $internalAudit->Audit_file;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->report_file)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Report Attachments';
            $history->previous = "Null";
            $history->current = $internalAudit->report_file;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->myfile)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Inv Attachment';
            $history->previous = "Null";
            $history->current = $internalAudit->myfile;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->myfile)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Inv Attachment';
            $history->previous = "Null";
            $history->current = $internalAudit->myfile;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->due_date)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current = $internalAudit->due_date;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->audit_start_date)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit Start Date';
            $history->previous = "Null";
            $history->current = $internalAudit->audit_start_date;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }

        if (!empty($internalAudit->audit_end_date)) {
            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $internalAudit->id;
            $history->activity_type = 'Audit End Date';
            $history->previous = "Null";
            $history->current = $internalAudit->audit_end_date;
            $history->comment = "NA";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $internalAudit->status;
            $history->save();
        }


        toastr()->success('Record is created Successfully');

        return redirect('rcms/qms-dashboard');
    }


    public function update(request $request, $id)
    {
        $lastDocument = InternalAudit::find($id);
        $internalAudit = InternalAudit::find($id);

        $internalAudit->parent_id = $request->parent_id;
        $internalAudit->parent_type = $request->parent_type;
        $internalAudit->intiation_date = $request->intiation_date;
        $internalAudit->assign_to = $request->assign_to;
        $internalAudit->due_date= $request->due_date;
        $internalAudit->initiator_group= $request->initiator_group;
        $internalAudit->initiator_group_code= $request->initiator_group_code;
        $internalAudit->short_description = $request->short_description;
        $internalAudit->audit_type = $request->audit_type;
        $internalAudit->if_other = $request->if_other;
        $internalAudit->Others= $request->Others;
        // $internalAudit->external_others=$request->external_others;
        $internalAudit->Relevant_Guideline= $request->Relevant_Guideline;
        $internalAudit->initiated_through = $request->initiated_through;
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
        $internalAudit->initiator_Group= $request->initiator_Group;

        $internalAudit->start_date = $request->start_date;
        $internalAudit->end_date = $request->end_date;
        $internalAudit->audit_agenda = $request->audit_agenda;
        //$internalAudit->Facility =  implode(',', $request->Facility);
        // $internalAudit->Group = implode(',', $request->Group);
        $internalAudit->external_agencies = $request->external_agencies;
        $internalAudit->material_name = $request->material_name;
        $internalAudit->if_comments = $request->if_comments;
        $internalAudit->lead_auditor = $request->lead_auditor;
        $internalAudit->Audit_team =  implode(',', $request->Audit_team);
        $internalAudit->Auditee =  implode(',', $request->Auditee);
        $internalAudit->Auditor_Details = $request->Auditor_Details;
        $internalAudit->Comments = $request->Comments;
        $internalAudit->Audit_Comments1 = $request->Audit_Comments1;
        $internalAudit->Remarks = $request->Remarks;
        $internalAudit->refrence_record=implode(',', $request->refrence_record);
        $internalAudit->severity_level_form= $request->severity_level_form;
        $internalAudit->audit_schedule_start_date= $request->audit_schedule_start_date;
        $internalAudit->audit_schedule_end_date= $request->audit_schedule_end_date;

        $internalAudit->Audit_Comments2 = $request->Audit_Comments2;
        $internalAudit->due_date= $request->due_date;
        $internalAudit->audit_start_date= $request->audit_start_date;
        $internalAudit->audit_end_date = $request->audit_end_date;

        if (!empty($request->inv_attachment)) {
            $files = [];
            if ($request->hasfile('inv_attachment')) {
                foreach ($request->file('inv_attachment') as $file) {
                    $name = $request->name . 'inv_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
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
                    $name = $request->name . 'file_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
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
                    $name = $request->name . 'file_attachment_guideline' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->file_attachment_guideline= json_encode($files);
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
                    $name = $request->name . 'myfile' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }


            $internalAudit->myfile = json_encode($files);
        }

        $internalAudit->update();

        $data3 = InternalAuditGrid::where('audit_id',$internalAudit->id)->where('type','internal_audit')->first();
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
            $data3->auditor = serialize($request->auditor);
        }
        if (!empty($request->auditee)) {
            $data3->auditee = serialize($request->auditee);
        }
        if (!empty($request->remark)) {
            $data3->remark = serialize($request->remark);
        }
        $data3->update();

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

        if ($lastDocument->date != $internalAudit->date || !empty($request->date_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Date of Initiator';
            $history->previous = $lastDocument->date;
            $history->current = $internalAudit->date;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->assign_to != $internalAudit->assign_to || !empty($request->assign_to_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Assigned to';
            $history->previous = $lastDocument->assign_to;
            $history->current = $internalAudit->assign_to;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Initiator_Group!= $internalAudit->Initiator_Group|| !empty($request->Initiator_Group_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Initiator Group';
            $history->previous = $lastDocument->Initiator_Group;
            $history->current = $internalAudit->Initiator_Group;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->short_description != $internalAudit->short_description || !empty($request->short_description_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastDocument->short_description;
            $history->current = $internalAudit->short_description;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->audit_type != $internalAudit->audit_type || !empty($request->audit_type_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Type of Audit';
            $history->previous = $lastDocument->audit_type;
            $history->current = $internalAudit->audit_type;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->if_other != $internalAudit->if_other || !empty($request->if_other_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'If Other';
            $history->previous = $lastDocument->if_other;
            $history->current = $internalAudit->if_other;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->initial_comments != $internalAudit->initial_comments || !empty($request->initial_comments_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Initial Comments';
            $history->previous = $lastDocument->initial_comments;
            $history->current = $internalAudit->initial_comments;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->start_date != $internalAudit->start_date || !empty($request->start_date_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Audit Schedule Start Date';
            $history->previous = $lastDocument->start_date;
            $history->current = $internalAudit->start_date;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->end_date != $internalAudit->end_date || !empty($request->end_date_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Audit Schedule End Date';
            $history->previous = $lastDocument->end_date;
            $history->current = $internalAudit->end_date;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->audit_agenda != $internalAudit->audit_agenda || !empty($request->audit_agenda_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Audit Agenda';
            $history->previous = $lastDocument->audit_agenda;
            $history->current = $internalAudit->audit_agenda;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        // if ($lastDocument->Facility != $internalAudit->Facility || !empty($request->Facility_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'Facility Name';
        //     $history->previous = $lastDocument->Facility;
        //     $history->current = $internalAudit->Facility;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        // if ($lastDocument->Group != $internalAudit->Group || !empty($request->Group_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'Group Name';
        //     $history->previous = $lastDocument->Group;
        //     $history->current = $internalAudit->Group;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        if ($lastDocument->material_name != $internalAudit->material_name || !empty($request->material_name_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Product/Material Name';
            $history->previous = $lastDocument->material_name;
            $history->current = $internalAudit->material_name;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->lead_auditor != $internalAudit->lead_auditor || !empty($request->lead_auditor_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Lead Auditor';
            $history->previous = $lastDocument->lead_auditor;
            $history->current = $internalAudit->lead_auditor;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Audit_team != $internalAudit->Audit_team || !empty($request->Audit_team_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Audit Team';
            $history->previous = $lastDocument->Audit_team;
            $history->current = $internalAudit->Audit_team;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Auditee != $internalAudit->Auditee || !empty($request->Auditee_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Auditee';
            $history->previous = $lastDocument->Auditee;
            $history->current = $internalAudit->Auditee;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Auditor_Details != $internalAudit->Auditor_Details || !empty($request->Auditor_Details_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'External Auditor Details';
            $history->previous = $lastDocument->Auditor_Details;
            $history->current = $internalAudit->Auditor_Details;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Comments != $internalAudit->Comments || !empty($request->Comments_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Comments';
            $history->previous = $lastDocument->Comments;
            $history->current = $internalAudit->Comments;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Audit_Comments1 != $internalAudit->Audit_Comments1 || !empty($request->Audit_Comments1_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Audit Comments';
            $history->previous = $lastDocument->Audit_Comments1;
            $history->current = $internalAudit->Audit_Comments1;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Remarks != $internalAudit->Remarks || !empty($request->Remarks_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Remarks';
            $history->previous = $lastDocument->Remarks;
            $history->current = $internalAudit->Remarks;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Reference_Recores1 != $internalAudit->Reference_Recores1 || !empty($request->Reference_Recores1_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Reference Recores';
            $history->previous = $lastDocument->Reference_Recores1;
            $history->current = $internalAudit->Reference_Recores1;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Reference_Recores2 != $internalAudit->Reference_Recores2 || !empty($request->Reference_Recores2_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Reference Recores';
            $history->previous = $lastDocument->Reference_Recores2;
            $history->current = $internalAudit->Reference_Recores2;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Audit_Comments2 != $internalAudit->Audit_Comments2 || !empty($request->Audit_Comments2_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Audit Comments';
            $history->previous = $lastDocument->Audit_Comments2;
            $history->current = $internalAudit->Audit_Comments2;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->inv_attachment != $internalAudit->inv_attachment || !empty($request->inv_attachment_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Inv Attachment';
            $history->previous = $lastDocument->inv_attachment;
            $history->current = $internalAudit->inv_attachment;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->file_attachment != $internalAudit->file_attachment || !empty($request->file_attachment_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'File Attachment';
            $history->previous = $lastDocument->file_attachment;
            $history->current = $internalAudit->file_attachment;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        // if ($lastDocument->file_attachment_guideline != $internalAudit->file_attachment_guideline || !empty($request->file_attachment_comment)) {

        //     $history = new InternalAuditTrial();
        //     $history->InternalAudit_id = $id;
        //     $history->activity_type = 'File Attachment';
        //     $history->previous = $lastDocument->file_attachment_guideline;
        //     $history->current = $internalAudit->file_attachment_guideline;
        //     $history->comment = $request->date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        if ($lastDocument->Audit_file != $internalAudit->Audit_file || !empty($request->Audit_file_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Audit Attachments';
            $history->previous = $lastDocument->Audit_file;
            $history->current = $internalAudit->Audit_file;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->report_file != $internalAudit->report_file || !empty($request->report_file_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Report Attachments';
            $history->previous = $lastDocument->report_file;
            $history->current = $internalAudit->report_file;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->myfile != $internalAudit->myfile || !empty($request->myfile_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Inv Attachment';
            $history->previous = $lastDocument->myfile;
            $history->current = $internalAudit->myfile;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->myfile != $internalAudit->myfile || !empty($request->myfile_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Inv Attachment';
            $history->previous = $lastDocument->myfile;
            $history->current = $internalAudit->myfile;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->due_date != $internalAudit->due_date || !empty($request->due_date_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Due Date';
            $history->previous = $lastDocument->due_date;
            $history->current = $internalAudit->due_date;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->audit_start_date!= $internalAudit->audit_start_date || !empty($request->audit_start_date_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Audit Start Date';
            $history->previous = $lastDocument->audit_start_date;
            $history->current = $internalAudit->audit_start_date;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->audit_end_date != $internalAudit->audit_end_date || !empty($request->audit_end_date_comment)) {

            $history = new InternalAuditTrial();
            $history->InternalAudit_id = $id;
            $history->activity_type = 'Audit End Date';
            $history->previous = $lastDocument->audit_end_date;
            $history->current = $internalAudit->audit_end_date;
            $history->comment = $request->date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        toastr()->success('Record is Update Successfully');

        return back();
    }

    public function internalAuditShow($id)
    {
        $old_record = InternalAudit::select('id', 'division_id', 'record')->get();
        $data = InternalAudit::find($id);
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $grid_data = InternalAuditGrid::where('audit_id', $id)->where('type', "internal_audit")->first();
     //   dd($grid_data);
        $grid_data1 = InternalAuditGrid::where('audit_id', $id)->where('type', "Observation_field")->first();
        return view('frontend.internalAudit.view', compact('data', 'old_record','grid_data','grid_data1'));
    }

    public function InternalAuditStateChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = InternalAudit::find($id);
            $lastDocument = InternalAudit::find($id);

            if ($changeControl->stage == 1) {
                $changeControl->stage = "2";
                $changeControl->status = "Audit Preparation";
                $changeControl->audit_schedule_by = Auth::user()->name;
                $changeControl->audit_schedule_on = Carbon::now()->format('d-M-Y');
                            $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changeControl->audit_schedule_by;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Audit Schedule";
                            $history->save();
                //        $list = Helpers::getLeadAuditorUserList();
                //     foreach ($list as $u) {
                //         if($u->q_m_s_divisions_id == $changeControl->division_id){
                //             $email = Helpers::getInitiatorEmail($u->user_id);
                //              if ($email !== null) {

                //               Mail::send(
                //                   'mail.view-mail',
                //                    ['data' => $changeControl],
                //                 function ($message) use ($email) {
                //                     $message->to($email)
                //                         ->subject("Document sent ".Auth::user()->name);
                //                 }
                //               );
                //             }
                //      }
                //   }
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            // if ($changeControl->stage == 2) {
            //     $changeControl->stage = "1";
            //     $changeControl->status = "Audit Preparation";
            //     $changeControl->rejected_by = Auth::user()->name;
            //     $changeControl->rejected_on = Carbon::now()->format('d-M-Y');
            //     $changeControl->update();
            //     toastr()->success('Document Sent');
            //     return back();
            // }
            if ($changeControl->stage == 2) {
                $changeControl->stage = "3";
                $changeControl->status = "Pending Audit";
                $changeControl->audit_preparation_completed_by = Auth::user()->name;
                $changeControl->audit_preparation_completed_on = Carbon::now()->format('d-M-Y');
                $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changeControl->audit_preparation_completed_by;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Audit Preparation Completed";
                            $history->save();
                //             $list = Helpers::getAuditManagerUserList();
                //     foreach ($list as $u) {
                //         if($u->q_m_s_divisions_id == $changeControl->division_id){
                //             $email = Helpers::getInitiatorEmail($u->user_id);
                //              if ($email !== null) {

                //               Mail::send(
                //                   'mail.view-mail',
                //                    ['data' => $changeControl],
                //                 function ($message) use ($email) {
                //                     $message->to($email)
                //                         ->subject("Document sent ".Auth::user()->name);
                //                 }
                //               );
                //             }
                //      }
                //   }
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 3) {
                $changeControl->stage = "4";
                $changeControl->status = "Pending Response";
                $changeControl->audit_mgr_more_info_reqd_by = Auth::user()->name;
                $changeControl->audit_mgr_more_info_reqd_on = Carbon::now()->format('d-M-Y');
                $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changeControl->audit_mgr_more_info_reqd_by;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Audit Mgr More Info Reqd";
                            $history->save();
                        //     $list = Helpers::getLeadAuditeeUserList();
                        //     foreach ($list as $u) {
                        //         if($u->q_m_s_divisions_id == $changeControl->division_id){
                        //             $email = Helpers::getInitiatorEmail($u->user_id);

                        //              if ($email !== null) {

                        //               Mail::send(
                        //                   'mail.view-mail',
                        //                    ['data' => $changeControl],
                        //                 function ($message) use ($email) {
                        //                     $message->to($email)
                        //                         ->subject("Document sent ".Auth::user()->name);
                        //                 }
                        //               );
                        //             }
                        //      }
                        //   }

                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 4) {
                $changeControl->stage = "5";
                $changeControl->status = "CAPA Execution in Progress";
                $changeControl->audit_observation_submitted_by = Auth::user()->name;
                $changeControl->audit_observation_submitted_on = Carbon::now()->format('d-M-Y');
                $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changeControl->audit_observation_submitted_by;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Audit Observation Submitted";
                            $history->save();
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changeControl->stage == 5) {
                $changeControl->stage = "6";
                $changeControl->status = "Closed - Done";
                $changeControl->audit_lead_more_info_reqd_by = Auth::user()->name;
                $changeControl->audit_lead_more_info_reqd_on = Carbon::now()->format('d-M-Y');
                $changeControl->audit_response_completed_by = Auth::user()->name;
                $changeControl->audit_response_completed_on = Carbon::now()->format('d-M-Y');
                $changeControl->response_feedback_verified_by = Auth::user()->name;
                $changeControl->response_feedback_verified_on = Carbon::now()->format('d-M-Y');
                            $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changeControl->audit_lead_more_info_reqd_by;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Audit Lead More Info Reqd";
                            $history->save();
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }



        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }
    public function RejectStateChange(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = InternalAudit::find($id);
            $lastDocument = InternalAudit::find($id);

            if ($changeControl->stage == 4) {
                $changeControl->stage = "6";
                $changeControl->status = "Closed - Done";
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
                $changeControl->stage = "1";
                $changeControl->status = "Opened";
                $changeControl->rejected_by = Auth::user()->name;
                $changeControl->rejected_on = Carbon::now()->format('d-M-Y');
                            $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changeControl->rejected_by;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Rejected";
                            $history->save();
                        //     $list = Helpers::getAuditManagerUserList();
                        //     foreach ($list as $u) {
                        //         if($u->q_m_s_divisions_id == $changeControl->division_id){
                        //             $email = Helpers::getInitiatorEmail($u->user_id);
                        //              if ($email !== null) {

                        //               Mail::send(
                        //                   'mail.view-mail',
                        //                    ['data' => $changeControl],
                        //                 function ($message) use ($email) {
                        //                     $message->to($email)
                        //                         ->subject("Document is Rejected ".Auth::user()->name);
                        //                 }
                        //               );
                        //             }
                        //      }
                        //   }

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
                $changeControl->stage = "1";
                $changeControl->status = "Opened";
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
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = InternalAudit::find($id);
            $lastDocument = InternalAudit::find($id);

            if ($changeControl->stage == 1) {
                $changeControl->stage = "0";
                $changeControl->status = "Closed-Cancelled";
                $changeControl->cancelled_by = Auth::user()->name;
                $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
                                $history = new InternalAuditTrial();
                                $history->InternalAudit_id = $id;
                                $history->activity_type = 'Activity Log';
                                $history->current = $changeControl->cancelled_by;
                                $history->comment = $request->comment;
                                $history->user_id = Auth::user()->id;
                                $history->user_name = Auth::user()->name;
                                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $history->origin_state = $lastDocument->status;
                                $history->stage = "Cancelled";
                                $history->save();
                //                   $list = Helpers::getHodUserList();
                //     foreach ($list as $u) {
                //         if($u->q_m_s_divisions_id == $changeControl->division_id){
                //             $email = Helpers::getLeadAuditorUserList($u->user_id);
                //              if ($email !== null) {

                //               Mail::send(
                //                   'mail.view-mail',
                //                    ['data' => $changeControl],
                //                 function ($message) use ($email) {
                //                     $message->to($email)
                //                         ->subject("Document is cancel By ".Auth::user()->name);
                //                 }
                //               );
                //             }
                //      }
                //   }
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
                $changeControl->cancelled_by = Auth::user()->name;
                $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
                            $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changeControl->cancelled_by;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Cancelled";
                            $history->save();
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
                            $history = new InternalAuditTrial();
                            $history->InternalAudit_id = $id;
                            $history->activity_type = 'Activity Log';
                            $history->current = $changeControl->cancelled_by;
                            $history->comment = $request->comment;
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->stage = "Cancelled";
                            $history->save();
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
        $audit = InternalAuditTrial::where('InternalAudit_id', $id)->orderByDESC('id')->get()->unique('activity_type');
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
            $parent_id = $id;
            $parent_type = "Observations";
            $record_number = ((RecordNumber::first()->value('counter')) + 1);
            $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
            $currentDate = Carbon::now();
            $formattedDate = $currentDate->addDays(30);
            $due_date = $formattedDate->format('d-M-Y');
            return view('frontend.forms.observation', compact('record_number', 'due_date', 'parent_id', 'parent_type'));
        }


    public static function singleReport($id)
    {
        $data = InternalAudit::find($id);
        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.internalAudit.singleReport', compact('data'))
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

    public static function auditReport($id)
    {
        $doc = InternalAudit::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $data = InternalAuditTrial::where('InternalAudit_id', $id)->get();
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
            $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');
            $canvas->page_text($width / 4, $height / 2, $doc->status, null, 25, [0, 0, 0], 2, 6, -20);
            return $pdf->stream('Internal-Audit' . $id . '.pdf');
        }
    }
}
