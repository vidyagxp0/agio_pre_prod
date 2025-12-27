<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\Capa;
use App\Jobs\SendMail;
use App\Models\ActionItem;
use App\Models\ActionItemHistory;
use App\Models\ExtensionNewAuditTrail;
use App\Models\CapaHistory;
use App\Models\RecordNumber;
use App\Models\User;
use App\Models\CapaAuditTrial;
use App\Models\RoleGroup;
use App\Models\CapaGrid;
use App\Models\Extension;
use App\Models\extension_new;
use App\Models\CC;
use App\Models\Division;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PDF;
use Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\OpenStage;
use App\Models\QMSDivision;
// use App\Services\DocumentService;

class CapaController extends Controller
{

    public function capa()
    {
        $cft = [];
        $old_records = Capa::select('id', 'division_id', 'record')->get();
        // Record number ko pad karke 4 digits ka bana rahe hain
        // $record_number = ((RecordNumber::first()->value('counter')) + 1);
         $old_record = Capa::select('id', 'division_id', 'record')->get();
        $lastAi = Capa::orderBy('record', 'desc')->first();
        $record_number = $lastAi ? $lastAi->record + 1 : 1;
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);

        // Division ke hisaab se latest record check kar rahe hain
        $division = QMSDivision::where('name', Helpers::getDivisionName(session()->get('division')))->first();

        if ($division) {
            $last_capa = Capa::where('division_id', $division->id)->latest()->first();

            if ($last_capa) {
                // Agar last record hai to usko pad karke next record number bana rahe hain
                $record_number = $last_capa->record ? str_pad($last_capa->record + 1, 4, '0', STR_PAD_LEFT) : '0001';
            } else {
                $record_number = '0001';
            }
        }

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');

        $changeControl = OpenStage::find(1);
        if (!empty($changeControl->cft)) {
            $cft = explode(',', $changeControl->cft);
        }
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

        return view("frontend.forms.capa", compact('due_date', 'record_number', 'relatedRecords', 'old_records', 'cft'));
    }

    public function capastore(Request $request)
    {
        // return $request;

        if (!$request->short_description) {
            toastr()->error("Short description is required");
            return redirect()->back();
        }

        $lastCapa = Capa::orderBy('record', 'desc')->first();

        $record_number = $lastCapa ? $lastCapa->record + 1 : 1;
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);

        
        $capa = new Capa();
        $capa->form_type = "CAPA";
        //$capa->record = ((RecordNumber::first()->value('counter')) + 1);
        $capa->record = $record_number;
        // dd($capa);
        $capa->initiator_id = Auth::user()->id;
        $capa->division_id = $request->division_id;
        $capa->parent_id = $request->parent_id;
        $capa->parent_type = $request->parent_type;
        $capa->division_code = $request->division_code;
        $capa->intiation_date = $request->intiation_date;
        $capa->general_initiator_group = $request->initiator_group;
        $capa->short_description = $request->short_description;
        $capa->problem_description = $request->problem_description;
        // dd($capa);
        $capa->due_date = $request->due_date;
        $capa->assign_to = $request->assign_to;
        $capa->capa_team =  implode(',', $request->capa_team);
        $capa_teamIdsArray = explode(',', $capa->capa_team);
        $capa_teamNames = User::whereIn('id', $capa_teamIdsArray)->pluck('name')->toArray();
        $capa_teamNamesString = implode(', ', $capa_teamNames);
        //    $capa->capa_team = implode(',', $request->capa_team);
        //    $capa->capa_team = implode(',', $request->input('capa_team', []));
        //    dd( $capa->capa_team);
        $capa->capa_type = $request->capa_type;
        $capa->severity_level_form = $request->severity_level_form;
        $capa->initiated_through = $request->initiated_through;
        $capa->initiated_through_req = $request->initiated_through_req;
        $capa->repeat = $request->repeat;
        $capa->initiator_Group = $request->initiator_Group;
        $capa->initiator_group_code = $request->initiator_group_code;
        // dd($capa->initiator_Group);

        //  dd($capa->initiator_Group);

        // $capa->initiator_Group = Helpers::getInitiatorGroupFullName($request->initiator_Group);
        //    dd($capa->initiator_Group );
        $capa->initiator_group_code = $request->initiator_group_code;
        $capa->repeat_nature = $request->repeat_nature;
        $capa->Effectiveness_checker = $request->Effectiveness_checker;
        $capa->effective_check_plan = $request->effective_check_plan;
        $capa->due_date_extension = $request->due_date_extension;
        $capa->cft_comments_form = $request->cft_comments_form;
        $capa->qa_comments_new = $request->qa_comments_new;
        $capa->designee_comments_new = $request->designee_comments_new;
        $capa->Warehouse_comments_new = $request->Warehouse_comments_new;
        $capa->Engineering_comments_new = $request->Engineering_comments_new;
        $capa->Instrumentation_comments_new = $request->Instrumentation_comments_new;
        $capa->Validation_comments_new = $request->Validation_comments_new;
        $capa->Others_comments_new = $request->Others_comments_new;
        $capa->Group_comments_new = $request->Group_comments_new;

        $capa->due_date_extension = $request->due_date_extension;
        $capa->hod_final_review = $request->hod_final_review;
        $capa->qa_cqa_qa_comments = $request->qa_cqa_qa_comments;
        $capa->qah_cq_comments = $request->qah_cq_comments;
        $capa->initiator_comment = $request->initiator_comment;
        $capa->effectivness_check = $request->effectivness_check;



        //    $capa->hod_attachment = $request->hod_attachment;
        //    $capa->qa_attachment = $request->qa_attachment;
        //    $capa->capafileattachement = $request->capafileattachement;
        $capa->investigation = $request->investigation;
        $capa->rcadetails = $request->rcadetails;
        $capa->parent_record_number_edit = $request->parent_record_number_edit;






        //    $capa->cft_attchament_new= json_encode($request->cft_attchament_new);
        //    $capa->additional_attachments= json_encode($request->additional_attachments);
        //    $capa->group_attachments_new = json_encode($request->group_attachments_new);
        $capa->Microbiology_new = $request->Microbiology_new;
        //    $capa->Microbiology_Person = $request->Microbiology_Person;
        $capa->goup_review = $request->goup_review;
        $capa->Production_new = $request->Production_new;
        $capa->Quality_Approver = $request->Quality_Approver;
        $capa->Quality_Approver_Person = $request->Quality_Approver_Person;
        $capa->bd_domestic = $request->bd_domestic;
        $capa->Bd_Person = $request->Bd_Person;
        $capa->Production_Person = $request->Production_Person;
        //    $capa->additional_attachments= json_encode($request->additional_attachments);
        // $capa->capa_related_record = implode(',', $request->capa_related_record);

        $capa->initial_observation = $request->initial_observation;
        $capa->interim_containnment = $request->interim_containnment;
        $capa->containment_comments = $request->containment_comments;
        if (!empty($request->capa_attachment)) {
            $files = [];
            if ($request->hasfile('capa_attachment')) {
                foreach ($request->file('capa_attachment') as $file) {
                    $name = $request->name . '-capa_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->capa_attachment = json_encode($files);
        }
        if (!empty($request->cft_attchament_new)) {
            $files = [];
            if ($request->hasfile('cft_attchament_new')) {
                foreach ($request->file('cft_attchament_new') as $file) {
                    $name = $request->name . '-cft_attchament_new' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->cft_attchament_new = json_encode($files);
        }
        if (!empty($request->additional_attachments)) {
            $files = [];
            if ($request->hasfile('additional_attachments')) {
                foreach ($request->file('additional_attachments') as $file) {
                    $name = $request->name . '-additional_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->additional_attachments = json_encode($files);
        }
        if (!empty($request->group_attachments_new)) {
            $files = [];
            if ($request->hasfile('group_attachments_new')) {
                foreach ($request->file('group_attachments_new') as $file) {
                    $name = $request->name . '-group_attachments_new' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->group_attachments_new = json_encode($files);
        }
        if (!empty($request->hod_attachment)) {
            $files = [];
            if ($request->hasfile('hod_attachment')) {
                foreach ($request->file('hod_attachment') as $file) {
                    $name = $request->name . '-hod_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->hod_attachment = json_encode($files);
        }
        if (!empty($request->qa_attachment)) {
            $files = [];
            if ($request->hasfile('qa_attachment')) {
                foreach ($request->file('qa_attachment') as $file) {
                    $name = $request->name . '-qa_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->qa_attachment = json_encode($files);
        }
        if (!empty($request->capafileattachement)) {
            $files = [];
            if ($request->hasfile('capafileattachement')) {
                foreach ($request->file('capafileattachement') as $file) {
                    $name = $request->name . '-capafileattachement' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->capafileattachement = json_encode($files);
        }
        if (!empty($request->hod_final_attachment)) {
            $files = [];
            if ($request->hasfile('hod_final_attachment')) {
                foreach ($request->file('hod_final_attachment') as $file) {
                    $name = $request->name . '-hod_final_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->hod_final_attachment = json_encode($files);
        }
        if (!empty($request->initiator_capa_attachment)) {
            $files = [];
            if ($request->hasfile('initiator_capa_attachment')) {
                foreach ($request->file('initiator_capa_attachment') as $file) {
                    $name = $request->name . '-initiator_capa_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->initiator_capa_attachment = json_encode($files);
        }

        if (!empty($request->qa_closure_attachment)) {
            $files = [];
            if ($request->hasfile('qa_closure_attachment')) {
                foreach ($request->file('qa_closure_attachment') as $file) {
                    $name = $request->name . '-qa_closure_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->qa_closure_attachment = json_encode($files);
        }
        //  dd($capa->qa_closure_attachment);
        if (!empty($request->qah_cq_attachment)) {
            $files = [];
            if ($request->hasfile('qah_cq_attachment')) {
                foreach ($request->file('qah_cq_attachment') as $file) {
                    $name = $request->name . '-qah_cq_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->qah_cq_attachment = json_encode($files);
        }
        $capa->parent_record_number = $request->parent_record_number;
        $capa->capa_qa_comments = $request->capa_qa_comments;
        $capa->capa_qa_comments2 = $request->capa_qa_comments2;
        $capa->hod_remarks = $request->hod_remarks;
        $capa->details_new = $request->details_new;
        $capa->project_details_application = $request->project_details_application;
        $capa->project_initiator_group = $request->project_initiator_group;
        $capa->site_number = $request->site_number;
        $capa->subject_number = $request->subject_number;
        $capa->subject_initials = $request->subject_initials;
        $capa->sponsor = $request->sponsor;
        $capa->general_deviation = $request->general_deviation;
        $capa->corrective_action = $request->corrective_action;
        $capa->preventive_action = $request->preventive_action;
        $capa->supervisor_review_comments = $request->supervisor_review_comments;
        $capa->qa_review = $request->qa_review;
        $capa->effectiveness = $request->effectiveness;
        $capa->effect_check = $request->effect_check;
        $capa->effect_check_date = $request->effect_check_date;

        if (!empty($request->closure_attachment)) {
            $files = [];
            if ($request->hasfile('closure_attachment')) {
                foreach ($request->file('closure_attachment') as $file) {
                    $name = $request->name . '-closure_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->closure_attachment = json_encode($files);
        }

        $capa->status = 'Opened';
        $capa->stage = 1;
        $capa->save();

        $data1 = new CapaGrid();
        $data1->capa_id = $capa->id;
        $data1->type = "Product_Details";

        if (!empty($request->material_name)) {
            $data1->product_name = serialize($request->material_name);
        }
        if (!empty($request->material_batch_no)) {
            $data1->batch_no = serialize($request->material_batch_no);
        }
        if (!empty($request->material_mfg_date)) {
            $data1->mfg_date = serialize($request->material_mfg_date);
        }
        if (!empty($request->material_batch_desposition)) {
            $data1->batch_desposition = serialize($request->material_batch_desposition);
        }
        if (!empty($request->material_expiry_date)) {
            $data1->expiry_date = serialize($request->material_expiry_date);
        }
        if (!empty($request->material_remark)) {
            $data1->remark = serialize($request->material_remark);
        }
        if (!empty($request->material_batch_status)) {
            $data1->batch_status = serialize($request->material_batch_status);
        }
        //  dd($request->all());
        $data1->save();


        $data2 = new CapaGrid();
        $data2->capa_id = $capa->id;
        $data2->type = "Material_Details";
        if (!empty($request->material_name)) {
            $data2->material_name = serialize($request->material_name);
        }
        if (!empty($request->material_batch_no)) {
            $data2->material_batch_no = serialize($request->material_batch_no);
        }
        if (!empty($request->material_mfg_date)) {
            $data2->material_mfg_date = serialize($request->material_mfg_date);
        }
        if (!empty($request->material_expiry_date)) {
            $data2->material_expiry_date = serialize($request->material_expiry_date);
        }
        if (!empty($request->material_batch_desposition)) {
            $data2->material_batch_desposition = serialize($request->material_batch_desposition);
        }
        if (!empty($request->material_remark)) {
            $data2->material_remark = serialize($request->material_remark);
        }
        if (!empty($request->material_batch_status)) {
            $data2->material_batch_status = serialize($request->material_batch_status);
        }


        $data2->save();

        $data3 = new CapaGrid();
        $data3->capa_id = $capa->id;
        $data3->type = "Instruments_Details";
        if (!empty($request->equipment)) {
            $data3->equipment = serialize($request->equipment);
        }
        if (!empty($request->equipment_instruments)) {
            $data3->equipment_instruments = serialize($request->equipment_instruments);
        }
        if (!empty($request->equipment_comments)) {
            $data3->equipment_comments = serialize($request->equipment_comments);
        }
        $data3->save();

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();


        if (!empty($capa->record)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Record Number';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName(session()->get('division')) . "/CAPA/" . Helpers::year($capa->created_at) . "/" . str_pad($capa->record, 4, '0', STR_PAD_LEFT);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->division_code)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Site/Location Code';
            $history->previous = "Null";
            $history->current = $capa->division_code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($capa->initiator_id)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($capa->initiator_id);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


        if (!empty($capa->intiation_date)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Date of Initiation';
            $history->previous = "Null";
            $history->current = Helpers::getdateFormat($capa->intiation_date);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        // dd($request->assign_to);
        if (!empty($request->assign_to)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Assigned To';
            $history->previous = "Null";
            $history->current = $request->assign_to;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        };
        if (!empty($capa->due_date)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            // $history->current = $capa->due_date;

            $history->current = Helpers::getdateFormat($capa->due_date);

            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->initiator_Group)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Initiator Department';
            $history->previous = "Null";
            // $history->current = Helpers::getFullDepartmentName($request->initiator_Group);
            $history->current = Helpers::getUsersDepartmentName(Auth::user()->departmentid) ;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        };
        if (!empty($capa->initiator_group_code)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Initiation Department Code';
            $history->previous = "Null";
            $history->current = $capa->initiator_group_code;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->short_description)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $capa->short_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->initiated_through)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Initiated Through';
            $history->previous = "Null";
            $history->current =  $capa->initiated_through;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($capa->initiated_through_req)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Others';
            $history->previous = "Null";
            $history->current = $capa->initiated_through_req;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


        if (!empty($capa->repeat)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Repeat';
            $history->previous = "Null";
            $history->current = $capa->repeat;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->repeat_nature)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = "Null";
            $history->current = $capa->repeat_nature;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


        if (!empty($capa->problem_description)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Problem Description';
            $history->previous = "Null";
            $history->current = $capa->problem_description;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->capa_team)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'CAPA Team';
            $history->previous = "Null";
            $history->current = $capa_teamNamesString;

            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->parent_record_number_edit)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Reference Records';
            $history->previous = "Null";
            $history->current = $capa->parent_record_number_edit;

            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }





        // if (!empty($capa->parent_record_number)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'Reference Records';
        //     $history->previous = "Null";
        //     if (is_array($capa->parent_record_number)) {
        //         $history->current = implode(',', $capa->parent_record_number);
        //     } else {
        //         // If it's a string, no need to implode
        //         $history->current = $capa->parent_record_number;
        //     }

        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        if (!empty($capa->initial_observation)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Initial Observation';
            $history->previous = "Null";
            $history->current = $capa->initial_observation;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }



        if (!empty($capa->interim_containnment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Interim Containment';
            $history->previous = "Null";
            $history->current = $capa->interim_containnment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->containment_comments)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Containment Comments';
            $history->previous = "Null";
            $history->current = $capa->containment_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->capa_attachment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'CAPA Attachments';
            $history->previous = "Null";
            $history->current = $capa->capa_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->investigation)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Investigation Summary';
            $history->previous = "Null";
            $history->current = $capa->investigation;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }



        if (!empty($capa->rcadetails)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Root Cause';
            $history->previous = "Null";
            $history->current = $capa->rcadetails;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


        if (!empty($capa->details_new)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Details';
            $history->previous = "Null";
            $history->current = $capa->details_new;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        /////////////////////// Equipment / MAterial Info///////////
        // if (!empty($capa->severity_level_form)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'Severity Level';
        //     $history->previous = "Null";
        //     $history->current = $capa->severity_level_form;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        /////////////////////CAPA Details//////////////////////
        if (!empty($capa->capa_type)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'CAPA Type';
            $history->previous = "Null";
            $history->current = $capa->capa_type;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->corrective_action)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Corrective Action';
            $history->previous = "Null";
            $history->current = $capa->corrective_action;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->preventive_action)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Preventive Action';
            $history->previous = "Null";
            $history->current = $capa->preventive_action;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($capa->capafileattachement)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'File Attachment';
            $history->previous = "Null";
            $history->current = $capa->capafileattachement;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        /////////////////////////HOD REview////////////////
        if (!empty($capa->hod_remarks)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'HOD Remark';
            $history->previous = "Null";
            $history->current = $capa->hod_remarks;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


        if (!empty($capa->hod_attachment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'HOD Attachment';
            $history->previous = "Null";
            $history->current = $capa->hod_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        // if (!empty($capa->capa_related_record)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'Reference Records';
        //     $history->previous = "Null";
        //     $history->current = $capa->capa_related_record;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //      $history->change_to = "Opened";
        //                    $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }











        if (!empty($capa->capa_qa_comments)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'QA/CQA Review Comment';
            $history->previous = "Null";
            $history->current = $capa->capa_qa_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->qa_attachment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'QA/CQA Attachment';
            $history->previous = "Null";
            $history->current = $capa->qa_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->qah_cq_comments)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'QA/CQA Approval Comment';
            $history->previous = "Null";
            $history->current = $capa->qah_cq_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->qah_cq_attachment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'QA/CQA Approval Attachment';
            $history->previous = "Null";
            $history->current = $capa->qah_cq_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->save();
        }

        if (!empty($capa->initiator_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Initiator CAPA Update Comment';
            $history->previous = "Null";
            $history->current = $capa->initiator_comment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->initiator_capa_attachment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Initiator CAPA Update Attachment';
            $history->previous = "Null";
            $history->current = $capa->initiator_capa_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        // if (!empty($capa->capa_qa_comments2)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'CAPA QA Comments';
        //     $history->previous = "Null";
        //     $history->current = $capa->capa_qa_comments2;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // if (!empty($capa->details)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'Details';
        //     $history->previous = "Null";
        //     $history->current = $capa->details;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //     $history->save();
        // }

        // if (!empty($capa->project_details_application)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'Project Datails Application';
        //     $history->previous = "Null";
        //     $history->current = $capa->project_details_application;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // if (!empty($capa->project_initiator_group)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'Initiator Group';
        //     $history->previous = "Null";
        //     $history->current = $capa->project_initiator_group;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // if (!empty($capa->site_number)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'Site Number';
        //     $history->previous = "Null";
        //     $history->current = $capa->site_number;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // if (!empty($capa->subject_number)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'Subject Number';
        //     $history->previous = "Null";
        //     $history->current = $capa->subject_number;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // if (!empty($capa->subject_initials)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'Subject Initials';
        //     $history->previous = "Null";
        //     $history->current = $capa->subject_initials;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }
        // if (!empty($capa->due_date_extension)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'Due Date Extension Justification';
        //     $history->previous = "Null";
        //     $history->current = $capa->due_date_extension;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }






        ///////////////// HOD final Review////////////////////


        if (!empty($capa->hod_final_review)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'HOD Final Review Comments';
            $history->previous = "Null";
            $history->current = $capa->hod_final_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }
        if (!empty($capa->hod_final_attachment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'HOD Final Attachment';
            $history->previous = "Null";
            $history->current = $capa->hod_final_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }






        ///////////////// QA/CQA Closure Review////////////////////
        if (!empty($capa->qa_cqa_qa_comments)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'QA/CQA Closure Review Comment';
            $history->previous = "Null";
            $history->current = $capa->qa_cqa_qa_comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->qa_closure_attachment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'QA/CQA Closure Review Attachment';
            $history->previous = "Null";
            $history->current = $capa->qa_closure_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }


        /////////////////////////QA/CQA Closure Approval/////////////////////


        if (!empty($capa->effectivness_check)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'Effectiveness check required';
            $history->previous = "Null";
            $history->current = $capa->effectivness_check;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->qa_review)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'QA/CQA Head Closure Review Comment';
            $history->previous = "Null";
            $history->current = $capa->qa_review;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        if (!empty($capa->closure_attachment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $capa->id;
            $history->activity_type = 'QA/CQA Head Closure Review Attachment';
            $history->previous = "Null";
            $history->current = $capa->closure_attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $capa->status;
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->save();
        }

        // if (!empty($capa->qa_attachmentc)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'QA/CQA Approval Attachment';
        //     $history->previous = "Null";
        //     $history->current = $capa->qa_attachmentc;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //     $history->save();
        // }




        // if (!empty($capa->supervisor_review_comments)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'Supervisor Review Comments';
        //     $history->previous = "Null";
        //     $history->current = $capa->supervisor_review_comments;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }



        // if (!empty($capa->effectiveness)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'Effectiveness Check required';
        //     $history->previous = "Null";
        //     $history->current = $capa->effectiveness;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }

        // if (!empty($capa->effect_check_date)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'Effect.Check Creation Date';
        //     $history->previous = "Null";
        //     $history->current = $capa->effect_check_date;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }




        // if (!empty($capa->capa_type)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $capa->id;
        //     $history->activity_type = 'Capa Type';
        //     $history->previous = "Null";
        //     $history->current = $capa->capa_type;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $capa->status;
        //      $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->save();
        // }


         //----------------- logic for showing grid data in audit trail -----------------------//

        // Create a new CapaGrid instance for storing the new data
        $data1 = new CapaGrid();
        $data1->capa_id = $capa->id;
        $data1->type = "Material_Details";

        // Define the mapping of database fields to the descriptive field names
        $fieldNames = [
            'material_name' => 'Product / Material Name',
            'material_batch_no' => 'Product / Material Batch No./Lot No./AR No.',
            'material_mfg_date' => 'Product / Material Manufacturing Date',
            'material_expiry_date' => 'Product / Material Date of Expiry',
            'material_batch_desposition' => 'Product Batch Disposition Decision',
            'material_remark' => 'Product Remark',
            'material_batch_status' => 'Product Batch Status',
        ];

        foreach ($request->material_name as $index => $material_name) {
            // Since this is a new entry, there are no previous details
            $previousDetails = [
                'material_name' => null,
                'material_batch_no' => null,
                'material_mfg_date' => null,
                'material_expiry_date' => null,
                'material_batch_desposition' => null,
                'material_remark' => null,
                'material_expiry_date' => null,
            ];

            $fields = [
                'material_name' => $material_name,
                'material_batch_no' => $request->material_batch_no[$index],
                'material_mfg_date' => Helpers::getdateFormat($request->material_mfg_date[$index]),
                'material_expiry_date' => Helpers::getdateFormat($request->material_expiry_date[$index]),
                'material_batch_desposition' => $request->material_batch_desposition[$index],
                'material_remark' => $request->material_remark[$index],
                'material_expiry_date' => $request->material_expiry_date[$index],
            ];

            foreach ($fields as $key => $currentValue) {
                // Log changes for new rows (no previous value to compare)
                if (!empty($currentValue)) {
                    // Only create an audit trail entry for new values
                    $history = new CapaAuditTrial();
                    $history->capa_id = $capa->id;

                    // Set activity type to include field name and row index using the fieldNames array
                    $history->activity_type = $fieldNames[$key] . ' (' . ($index + 1) . ')';

                    // Since this is a new entry, 'Previous' value is null
                    $history->previous = 'null'; // Previous value or 'null'

                    // Assign 'Current' value, which is the new value
                    $history->current = $currentValue; // New value

                    // Comments and user details
                    $history->comment = 'NA';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = "Not Applicable"; // For new entries, set an appropriate status
                    $history->change_to = "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = "Create";

                    // Save the history record
                    $history->save();
                }
            }
        }
     //----------------------------------------------------------------------------

        $data3 = new CapaGrid();
        $data3->capa_id = $capa->id;
        $data3->type = "Instruments_Details";

        // Define an associative array to map the field keys to display names
        $fieldNames = [
            'equipment' => 'Equipment/Instruments Name',
            'equipment_instruments' => 'Equipment/Instrument ID',
            'equipment_comments' => 'Equipment/Instruments Comments'
        ];

        foreach ($request->equipment as $index => $equipment) {
            // Since this is a new entry, there are no previous details
            $previousDetails = [
                'equipment' => null,
                'equipment_instruments' => null,
                'equipment_comments' => null,
            ];

            // Current fields values from the request
            $fields = [
                'equipment' => $equipment,
                'equipment_instruments' => $request->equipment_instruments[$index],
                'equipment_comments' => $request->equipment_comments[$index],
            ];

            foreach ($fields as $key => $currentValue) {
                // Log changes for new rows (no previous value to compare)
                if (!empty($currentValue)) {
                    // Only create an audit trail entry for new values
                    $history = new CapaAuditTrial();
                    $history->capa_id = $capa->id;

                    // Set activity type to include field name and row index using the fieldNames array
                    $history->activity_type = $fieldNames[$key] . ' (' . ($index + 1) . ')';

                    // Since this is a new entry, 'Previous' value is null
                    $history->previous = 'null'; // Previous value or 'null'

                    // Assign 'Current' value, which is the new value
                    $history->current = $currentValue; // New value

                    // Comments and user details
                    $history->comment = $request->equipment_comments[$index] ?? '';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = "Not Applicable"; // For new entries, set an appropriate status
                    $history->change_to = "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = "Create";

                    // Save the history record
                    $history->save();
                }
            }
        }



        // DocumentService::update_qms_numbers();

        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }
    public function capaUpdate(Request $request, $id)
    {
        if (!$request->short_description) {
            toastr()->error("Short description is required");
            return redirect()->back();
        }
        $lastDocument = Capa::find($id);
        $capa = Capa::find($id);

        $getId = $lastDocument->capa_team;
        $lastcapa_teamIdsArray = explode(',', $getId);
        $lastcapa_teamNames = User::whereIn('id', $lastcapa_teamIdsArray)->pluck('name')->toArray();
        $lastcapa_teamName = implode(', ', $lastcapa_teamNames);
        // $capa->parent_id = $request->parent_id;
        // $capa->parent_type = $request->parent_type;
        // $capa->division_code = $request->division_code;
        // $capa->intiation_date= $request->intiation_date;
        $capa->general_initiator_group = $request->initiator_group;
        $capa->short_description = $request->short_description;
        $capa->problem_description = $request->problem_description;
        $capa->due_date = $request->due_date;
        if ($capa->stage == 1) {
            $capa->assign_to =  implode(',', (array) $request->assign_to);
        }
        // $capa->assign_to = $request->assign_to;
        //  $capa->capa_team = $request->capa_team;
        // $capa->capa_team = implode(',', $request->capa_team);

        if ($capa->stage == 1) {
            $capa->capa_team =  implode(',', $request->capa_team);
            $capa_teamIdsArray = explode(',', $capa->capa_team);
            $capa_teamNames = User::whereIn('id', $capa_teamIdsArray)->pluck('name')->toArray();
            $capa_teamNamesString = implode(', ', $capa_teamNames);
        }
        if ($capa->stage == 1) {
            $capa->capa_type =  implode(',', (array) $request->capa_type);
        }
        // $capa->capa_type = $request->capa_type;
        $capa->details_new = $request->details_new;
        if ($capa->stage == 1) {
            $capa->initiated_through =  implode(',', (array) $request->initiated_through);
        }
        // $capa->initiated_through = $request->initiated_through;
        $capa->initiated_through_req = $request->initiated_through_req;
        // $capa->repeat = $request->repeat;
        if ($capa->stage == 1) {
            $capa->repeat = implode(',', (array) $request->repeat); // Cast to array and implode
        }
        // if ($capa->stage == 1) {
        //     $capa->initiator_Group =  implode(',', (array) $request->initiator_Group);
        // }
        // $capa->initiator_Group= $request->initiator_Group;

        $capa->parent_record_number_edit = $request->parent_record_number_edit;

        $capa->initiator_group_code = $request->initiator_group_code;
        $capa->severity_level_form = $request->severity_level_form;
        $capa->cft_comments_form = $request->cft_comments_form;
        $capa->qa_comments_new = $request->qa_comments_new;
        $capa->designee_comments_new = $request->designee_comments_new;
        $capa->Warehouse_comments_new = $request->Warehouse_comments_new;
        $capa->Engineering_comments_new = $request->Engineering_comments_new;
        $capa->Instrumentation_comments_new = $request->Instrumentation_comments_new;
        $capa->Validation_comments_new = $request->Validation_comments_new;
        $capa->Others_comments_new = $request->Others_comments_new;
        $capa->Quality_Approver = $request->Quality_Approver;
        $capa->Quality_Approver_Person = $request->Quality_Approver_Person;
        $capa->Production_new = $request->Production_new;
        $capa->Group_comments_new = $request->Group_comments_new;
        //    $capa->cft_attchament_new = json_encode($request->cft_attchament_new);
        //    $capa->group_attachments_new = json_encode($request->group_attachments_new);
        $capa->repeat_nature = $request->repeat_nature;
        $capa->Effectiveness_checker = $request->Effectiveness_checker;
        $capa->effective_check_plan = $request->effective_check_plan;
        $capa->due_date_extension = $request->due_date_extension;
        // if ($capa->stage == 1) {
        //     $capa->capa_related_record =  implode(',', $request->capa_related_record);
        // }        // $capa->reference_record = $request->reference_record;
        $capa->parent_record_number_edit = $request->parent_record_number_edit;
        $capa->Microbiology_new = $request->Microbiology_new;
        $capa->goup_review = $request->goup_review;
        $capa->initial_observation = $request->initial_observation;
        if ($capa->stage == 1) {
            $capa->interim_containnment = implode(',', (array) $request->interim_containnment);
        }
        // $capa->interim_containnment = $request->interim_containnment;
        $capa->containment_comments = $request->containment_comments;

        $capa->capa_qa_comments = $request->capa_qa_comments;
        $capa->capa_qa_comments2 = $request->capa_qa_comments2;
        // $capa->details = $request->details;
        $capa->project_details_application = $request->project_details_application;
        $capa->project_initiator_group = $request->project_initiator_group;
        $capa->site_number = $request->site_number;
        $capa->subject_number = $request->subject_number;
        $capa->subject_initials = $request->subject_initials;
        $capa->sponsor = $request->sponsor;
        $capa->general_deviation = $request->general_deviation;
        $capa->corrective_action = $request->corrective_action;
        $capa->preventive_action = $request->preventive_action;
        $capa->supervisor_review_comments = $request->supervisor_review_comments;
        $capa->qa_review = $request->qa_review;
        $capa->effectiveness = $request->effectiveness;
        $capa->effect_check = $request->effect_check;
        $capa->effect_check_date = $request->effect_check_date;
        $capa->bd_domestic = $request->bd_domestic;
        $capa->Bd_Person = $request->Bd_Person;
        $capa->Production_Person = $request->Production_Person;
        $capa->hod_remarks = $request->hod_remarks;
        $capa->hod_final_review = $request->hod_final_review;
        $capa->qa_cqa_qa_comments = $request->qa_cqa_qa_comments;
        $capa->qah_cq_comments = $request->qah_cq_comments;
        $capa->initiator_comment = $request->initiator_comment;
        $capa->effectivness_check = $request->effectivness_check;


        //    $capa->hod_attachment = $request->hod_attachment;
        //    $capa->qa_attachment = $request->qa_attachment;
        //    $capa->capafileattachement = $request->capafileattachement;
        $capa->investigation = $request->investigation;
        $capa->rcadetails = $request->rcadetails;



        if (!empty($request->capa_attachment)) {
            $files = [];
            if ($request->hasfile('capa_attachment')) {
                foreach ($request->file('capa_attachment') as $file) {
                    $name = $request->name . 'capa_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->capa_attachment = json_encode($files);
        }

        if (!empty($request->hod_attachment)) {
            $files = [];
            if ($request->hasfile('hod_attachment')) {
                foreach ($request->file('hod_attachment') as $file) {
                    $name = $request->name . 'hod_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->hod_attachment = json_encode($files);
        }
        if (!empty($request->qa_attachment)) {
            $files = [];
            if ($request->hasfile('qa_attachment')) {
                foreach ($request->file('qa_attachment') as $file) {
                    $name = $request->name . 'qa_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->qa_attachment = json_encode($files);
        }
        if (!empty($request->capafileattachement)) {
            $files = [];
            if ($request->hasfile('capafileattachement')) {
                foreach ($request->file('capafileattachement') as $file) {
                    $name = $request->name . 'capafileattachement' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->capafileattachement = json_encode($files);
        }


        if (!empty($request->closure_attachment)) {
            $files = [];
            if ($request->hasfile('closure_attachment')) {
                foreach ($request->file('closure_attachment') as $file) {
                    $name = $request->name . 'closure_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->closure_attachment = json_encode($files);
        }
        if (!empty($request->hod_final_attachment)) {
            $files = [];
            if ($request->hasfile('hod_final_attachment')) {
                foreach ($request->file('hod_final_attachment') as $file) {
                    $name = $request->name . 'hod_final_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->hod_final_attachment = json_encode($files);
        }
        if (!empty($request->initiator_capa_attachment)) {
            $files = [];
            if ($request->hasfile('initiator_capa_attachment')) {
                foreach ($request->file('initiator_capa_attachment') as $file) {
                    $name = $request->name . 'initiator_capa_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->initiator_capa_attachment = json_encode($files);
        }
        if (!empty($request->qa_closure_attachment)) {
            $files = [];
            if ($request->hasfile('qa_closure_attachment')) {
                foreach ($request->file('qa_closure_attachment') as $file) {
                    $name = $request->name . 'qa_closure_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->qa_closure_attachment = json_encode($files);
        }
        if (!empty($request->qah_cq_attachment)) {
            $files = [];
            if ($request->hasfile('qah_cq_attachment')) {
                foreach ($request->file('qah_cq_attachment') as $file) {
                    $name = $request->name . 'qah_cq_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $capa->qah_cq_attachment = json_encode($files);
        }
        $capa->update();


        // -----------------------grid--------------------
        // if ($request->product_name) {
        //     $data1 = CapaGrid::where('capa_id', $id)->where('type', "Product_Details")->first();
        //     $data1->capa_id = $capa->id;
        //     $data1->type = "Product_Details";
        //     if (!empty($request->product_name)) {
        //         $data1->product_name = serialize($request->product_name);
        //     }
        //     if (!empty($request->product_batch_no)) {
        //         $data1->batch_no = serialize($request->product_batch_no);
        //     }
        //     if (!empty($request->mfg_date)) {
        //         $data1->mfg_date = serialize($request->mfg_date);
        //     }
        //     if (!empty($request->product_expiry_date)) {
        //         $data1->expiry_date = serialize($request->product_expiry_date);
        //     }
        //     if (!empty($request->product_batch_desposition)) {
        //         $data1->batch_desposition = serialize($request->product_batch_desposition);
        //     }

        //     if (!empty($request->product_remark)) {
        //         $data1->remark = serialize($request->product_remark);
        //     }
        //     if (!empty($request->product_batch_status)) {
        //         $data1->batch_status = serialize($request->product_batch_status);
        //     }
        //     $data1->update();
        // }

        // // --------------------------

        // if ($request->material_name) {
        //     $data2 = CapaGrid::where('type', 'Material_Details')->where('capa_id', $id)->first();
        //     if (empty($data2)) {
        //         $data2 = new CapaGrid();
        //     }

        //     $data2->capa_id = $capa->id;
        //     $data2->type = "Material_Details";
        //     if (!empty($request->material_name)) {
        //         $data2->material_name = serialize($request->material_name);
        //     }
        //     if (!empty($request->material_batch_no)) {
        //         $data2->material_batch_no = serialize($request->material_batch_no);
        //     }

        //     if (!empty($request->material_mfg_date)) {
        //         $data2->material_mfg_date = serialize($request->material_mfg_date);
        //     }
        //     if (!empty($request->material_expiry_date)) {
        //         $data2->material_expiry_date = serialize($request->material_expiry_date);
        //     }
        //     if (!empty($request->material_batch_desposition)) {
        //         $data2->material_batch_desposition = serialize($request->material_batch_desposition);
        //     }
        //     if (!empty($request->material_remark)) {
        //         $data2->material_remark = serialize($request->material_remark);
        //     }

        //     if ($capa->stage == 1) {
        //         if (!empty($request->material_batch_status)) {
        //             $data2->material_batch_status = serialize($request->material_batch_status);
        //         }
        //     }

        //     $data2->update();
        // }

        // // ----------------------------------------
        // if ($request->equipment) {
        //     $data3 = CapaGrid::where('capa_id', $id)->where('type', "Instruments_Details")->first();
        //     $data3->capa_id = $capa->id;
        //     $data3->type = "Instruments_Details";
        //     if (!empty($request->equipment)) {
        //         $data3->equipment = serialize($request->equipment);
        //     }
        //     if (!empty($request->equipment_instruments)) {
        //         $data3->equipment_instruments = serialize($request->equipment_instruments);
        //     }
        //     if (!empty($request->equipment_comments)) {
        //         $data3->equipment_comments = serialize($request->equipment_comments);
        //     }
        // }
        // $data3->save();
        $capa->update();

        //     $record = RecordNumber::first();
        //     $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        //     $record->update();
        // }



        // if ($lastDocument->division_code != $capa->division_code || !empty($request->division_code_comment)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Site/Location Code';
        //     $history->previous = $lastDocument->division_code;
        //     $history->current = $capa->division_code;
        //     $history->comment = $request->division_code_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;

        //     // Null or empty check
        //     if (is_null($lastDocument->division_code) || $lastDocument->division_code === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }
        if ($lastDocument->assign_to != $capa->assign_to || !empty($request->problem_description_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Assigned To';
            $history->previous = $lastDocument->assign_to;
            $history->current = ($capa->assign_to);
            $history->comment = $request->problem_description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            // Null or empty check
            if (is_null($lastDocument->assign_to) || $lastDocument->assign_to === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->due_date != $capa->due_date || !empty($request->due_date_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Due Date';
            // Helpers::getdateFormat($data->due_date)
            $history->previous = Helpers::getdateFormat($lastDocument->due_date);
            $history->current = Helpers::getdateFormat($capa->due_date);
            $history->comment = $request->due_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            // Null or empty check
            if (is_null($lastDocument->due_date) || $lastDocument->due_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->initiator_Group != $capa->initiator_Group || !empty($request->initiator_Group_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Initiator Department';
            $history->previous = Helpers::getFullDepartmentName($lastDocument->initiator_Group);
            $history->current = Helpers::getFullDepartmentName($capa->initiator_Group);
            $history->comment = $request->initiator_Group_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            // Null or empty check
            if (is_null($lastDocument->initiator_Group) || $lastDocument->initiator_Group === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->initiator_group_code != $capa->initiator_group_code || !empty($request->initiator_group_code_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Initiator Department Code';
            $history->previous = $lastDocument->initiator_group_code;
            $history->current = $capa->initiator_group_code;
            $history->comment = $request->initiator_group_code_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            // Null or empty check
            if (is_null($lastDocument->initiator_group_code) || $lastDocument->initiator_group_code === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        // if ($lastDocument->short_description != $capa->short_description || !empty($request->short_description_comment)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Short Description';
        //     $history->previous = $lastDocument->short_description;
        //     $history->current = $capa->short_description;
        //     $history->comment = $request->short_description_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;

        //     // Null or empty check
        //     if (is_null($lastDocument->short_description) || $lastDocument->short_description === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        if ($lastDocument->short_description != $capa->short_description) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastDocument->short_description;
            $history->current = $capa->short_description;
            $history->comment = $request->initiated_through_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            // Null or empty check
            if (is_null($lastDocument->short_description) || $lastDocument->short_description === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->initiated_through != $capa->initiated_through) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Initiated Through';
            $history->previous = $lastDocument->initiated_through;
            $history->current = $capa->initiated_through;
            $history->comment = $request->initiated_through_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            // Null or empty check
            if (is_null($lastDocument->initiated_through) || $lastDocument->initiated_through === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->initiated_through_req != $capa->initiated_through_req) {

            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Others';
            $history->previous = $lastDocument->initiated_through_req;
            $history->current = $capa->initiated_through_req;
            $history->comment = $request->initiated_through_req_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->initiated_through_req) || $lastDocument->initiated_through_req === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->repeat != $capa->repeat) {

            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Repeat';
            $history->previous = $lastDocument->repeat;
            $history->current = $capa->repeat;
            $history->comment = $request->repeat_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->repeat) || $lastDocument->repeat === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->repeat_nature != $capa->repeat_nature) {

            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Repeat Nature';
            $history->previous = $lastDocument->repeat_nature;
            $history->current = $capa->repeat_nature;
            $history->comment = $request->repeat_nature_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->repeat_nature) || $lastDocument->repeat_nature === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->problem_description != $capa->problem_description || !empty($request->problem_description_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Problem Description';
            $history->previous = $lastDocument->problem_description;
            $history->current = $capa->problem_description;
            $history->comment = $request->problem_description_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            // Null or empty check
            if (is_null($lastDocument->problem_description) || $lastDocument->problem_description === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->capa_team != $capa->capa_team || !empty($request->capa_team_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'CAPA Team';
            $history->previous = $lastcapa_teamName;
            $history->current = $capa_teamNamesString;
            $history->comment = $request->capa_team_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            // Null or empty check
            if (is_null($lastDocument->capa_team) || $lastDocument->capa_team === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->parent_record_number_edit != $capa->parent_record_number_edit || !empty($request->initial_observation_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Reference Records';
            $history->previous = $lastDocument->parent_record_number_edit;
            $history->current = $capa->parent_record_number_edit;
            $history->comment = $request->initial_observation_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->parent_record_number_edit) || $lastDocument->parent_record_number_edit === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->initial_observation != $capa->initial_observation || !empty($request->initial_observation_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Initial Observation';
            $history->previous = $lastDocument->initial_observation;
            $history->current = $capa->initial_observation;
            $history->comment = $request->initial_observation_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->initial_observation) || $lastDocument->initial_observation === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->interim_containnment != $capa->interim_containnment || !empty($request->interim_containnment_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Interim Containment';
            $history->previous = $lastDocument->interim_containnment;
            $history->current = $capa->interim_containnment;
            $history->comment = $request->interim_containnment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->interim_containnment) || $lastDocument->interim_containnment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->containment_comments != $capa->containment_comments || !empty($request->interim_containnment_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Containment Comments';
            $history->previous = $lastDocument->containment_comments;
            $history->current = $capa->containment_comments;
            $history->comment = $request->interim_containnment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->containment_comments) || $lastDocument->containment_comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->capa_attachment != $capa->capa_attachment || !empty($request->capa_attachment_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'CAPA Attachments';
            $history->previous = $lastDocument->capa_attachment;
            $history->current = $capa->capa_attachment;
            $history->comment = $request->capa_attachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->capa_attachment) || $lastDocument->capa_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }





        if ($lastDocument->investigation != $capa->investigation) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Investigation Summary';
            $history->previous = $lastDocument->investigation;
            $history->current = $capa->investigation;
            $history->comment = $request->investigation_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            // Null or empty check
            if (is_null($lastDocument->investigation) || $lastDocument->investigation === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->rcadetails != $capa->rcadetails) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Root Cause';
            $history->previous = $lastDocument->rcadetails;
            $history->current = $capa->rcadetails;
            $history->comment = $request->rcadetails_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            // Null or empty check
            if (is_null($lastDocument->rcadetails) || $lastDocument->rcadetails === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->details_new != $capa->details_new) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Details';
            $history->previous = $lastDocument->details_new;
            $history->current = $capa->details_new;
            $history->comment = $request->details_new_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->details_new) || $lastDocument->details_new === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->capa_type != $capa->capa_type) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Capa Type';
            $history->previous = $lastDocument->capa_type;
            $history->current = $capa->capa_type;
            $history->comment = $request->capa_type_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->capa_type) || $lastDocument->capa_type === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        if ($lastDocument->corrective_action != $capa->corrective_action || !empty($request->corrective_action_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Corrective Action';
            $history->previous = $lastDocument->corrective_action;
            $history->current = $capa->corrective_action;
            $history->comment = $request->corrective_action_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            // Null or empty check
            if (is_null($lastDocument->corrective_action) || $lastDocument->corrective_action === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->preventive_action != $capa->preventive_action || !empty($request->preventive_action_comment)) {

            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Preventive Action';
            $history->previous = $lastDocument->preventive_action;
            $history->current = $capa->preventive_action;
            $history->comment = $request->preventive_action_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->preventive_action) || $lastDocument->preventive_action === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->capafileattachement != $capa->capafileattachement) {

            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'File Attachment';
            $history->previous = $lastDocument->capafileattachement;
            $history->current = $capa->capafileattachement;
            $history->comment = $request->capafileattachement_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->capafileattachement) || $lastDocument->capafileattachement === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }






        if ($lastDocument->hod_remarks != $capa->hod_remarks) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'HOD Remark';
            $history->previous = $lastDocument->hod_remarks;
            $history->current = $capa->hod_remarks;
            $history->comment = $request->hod_remarks_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            // Null or empty check
            if (is_null($lastDocument->hod_remarks) || $lastDocument->hod_remarks === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->hod_attachment != $capa->hod_attachment) {

            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'HOD Attachment';
            $history->previous = $lastDocument->hod_attachment;
            $history->current = $capa->hod_attachment;
            $history->comment = $request->hod_attachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->hod_attachment) || $lastDocument->hod_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->capa_qa_comments != $capa->capa_qa_comments || !empty($request->capa_qa_comments_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'QA/CQA Review Comment';
            $history->previous = $lastDocument->capa_qa_comments;
            $history->current = $capa->capa_qa_comments;
            $history->comment = $request->capa_qa_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->capa_qa_comments) || $lastDocument->capa_qa_comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->qa_attachment != $capa->qa_attachment) {

            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'QA/CQA Attachment';
            $history->previous = $lastDocument->qa_attachment;
            $history->current = $capa->qa_attachment;
            $history->comment = $request->qa_attachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->qa_attachment) || $lastDocument->qa_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->qah_cq_comments != $capa->qah_cq_comments || !empty($request->qah_cq_comments_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'QA/CQA Approval Comment';
            $history->previous = $lastDocument->qah_cq_comments;
            $history->current = $capa->qah_cq_comments;
            $history->comment = $request->qah_cq_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->qah_cq_comments) || $lastDocument->qah_cq_comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->qah_cq_attachment != $capa->qah_cq_attachment || !empty($request->qah_cq_attachment_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'QA/CQA Approval Attachment ';
            $history->previous = $lastDocument->qah_cq_attachment;
            $history->current = $capa->qah_cq_attachment;
            $history->comment = $request->qah_cq_attachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->qah_cq_attachment) || $lastDocument->qah_cq_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->initiator_comment != $capa->initiator_comment || !empty($request->initiator_comment_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Initiator CAPA Update Comment';
            $history->previous = $lastDocument->initiator_comment;
            $history->current = $capa->initiator_comment;
            $history->comment = $request->initiator_comment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->initiator_comment) || $lastDocument->initiator_comment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->initiator_capa_attachment != $capa->initiator_capa_attachment || !empty($request->initiator_capa_attachment_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Initiator CAPA Update Attachment ';
            $history->previous = $lastDocument->initiator_capa_attachment;
            $history->current = $capa->initiator_capa_attachment;
            $history->comment = $request->initiator_capa_attachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->initiator_capa_attachment) || $lastDocument->initiator_capa_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->hod_final_review != $capa->hod_final_review || !empty($request->hod_final_review_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'HOD Final Review Comments';
            $history->previous = $lastDocument->hod_final_review;
            $history->current = $capa->hod_final_review;
            $history->comment = $request->hod_final_review_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->hod_final_review) || $lastDocument->hod_final_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->hod_final_attachment != $capa->hod_final_attachment || !empty($request->hod_final_attachment_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'HOD Final Attachment ';
            $history->previous = $lastDocument->hod_final_attachment;
            $history->current = $capa->hod_final_attachment;
            $history->comment = $request->hod_final_attachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->hod_final_attachment) || $lastDocument->hod_final_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->qa_cqa_qa_comments != $capa->qa_cqa_qa_comments || !empty($request->qa_cqa_qa_comments_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'QA/CQA Closure Review Comment';
            $history->previous = $lastDocument->qa_cqa_qa_comments;
            $history->current = $capa->qa_cqa_qa_comments;
            $history->comment = $request->qa_cqa_qa_comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->qa_cqa_qa_comments) || $lastDocument->qa_cqa_qa_comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->qa_closure_attachment != $capa->qa_closure_attachment || !empty($request->qa_closure_attachment_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'QA/CQA Closure Review Attachment ';
            $history->previous = $lastDocument->qa_closure_attachment;
            $history->current = $capa->qa_closure_attachment;
            $history->comment = $request->qa_closure_attachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->qa_closure_attachment) || $lastDocument->qa_closure_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->effectivness_check != $capa->effectivness_check || !empty($request->effectivness_check_comment)) {
            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Effectiveness check required';
            $history->previous = $lastDocument->effectivness_check;
            $history->current = $capa->effectivness_check;
            $history->comment = $request->effectivness_check_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;

            if (is_null($lastDocument->effectivness_check) || $lastDocument->effectivness_check === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }







        // if ($lastDocument->assign_to != $capa->assign_to || !empty($request->assign_to_comment)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Assigned To';
        //     $history->previous =Helpers::getInitiatorName( $lastDocument->assign_to);
        //     $history->current = Helpers::getInitiatorName($capa->assign_to);
        //     $history->comment = $request->assign_to_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;

        //     // Null or empty check
        //     if (is_null($lastDocument->assign_to) || $lastDocument->assign_to === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }


        // if ($lastDocument->reference_record != $capa->reference_record || !empty($request->reference_record_comment)) {

        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Reference Records';
        //     $history->previous = $lastDocument->reference_record;
        //     $history->current = $capa->reference_record;
        //     $history->comment = $request->reference_record_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        // if ($lastDocument->parent_record_number != $capa->parent_record_number || !empty($request->capa_related_record_comment)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Reference Records';
        //     $history->previous = $lastDocument->parent_record_number;
        //     $history->current = $capa->parent_record_number;
        //     $history->comment = $request->capa_related_record_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->parent_record_number) || $lastDocument->parent_record_number === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }








        // if ($lastDocument->due_date_extension != $capa->due_date_extension || !empty($request->due_date_extension_comment)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Interim Containment';
        //     $history->previous = $lastDocument->due_date_extension;
        //     $history->current = $capa->due_date_extension;
        //     $history->comment = $request->due_date_extension_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;

        //     if (is_null($lastDocument->due_date_extension) || $lastDocument->due_date_extension === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        ///////////////////////////////////CAPA Clousure//////////////////////////////////////////////////

        if ($lastDocument->qa_review != $capa->qa_review || !empty($request->qa_review_comment)) {

            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'QA/CQA Head Closure Review Comment';
            $history->previous = $lastDocument->qa_review;
            $history->current = $capa->qa_review;
            $history->comment = $request->qa_review_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->qa_review) || $lastDocument->qa_review === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->closure_attachment != $capa->closure_attachment || !empty($request->closure_attachment_comment)) {

            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'QA/CQA Head Closure Review Attachment';
            $history->previous = $lastDocument->closure_attachment;
            $history->current = $capa->closure_attachment;
            $history->comment = $request->closure_attachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->closure_attachment) || $lastDocument->closure_attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        // if ($lastDocument->due_date_extension != $capa->due_date_extension || !empty($request->due_date_extension_comment)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Due Date Extension Justification';
        //     $history->previous = $lastDocument->due_date_extension;
        //     $history->current = $capa->due_date_extension;
        //     $history->comment = $request->due_date_extension_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;

        //     if (is_null($lastDocument->due_date_extension) || $lastDocument->due_date_extension === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }
        /////////////////////HOD Final REview////////////////




        ////////////////QA/CQA Closure Review//////////////////



        ////{{-- ==========================QAH/CQAH ================ --}}















        // if ($lastDocument->capa_qa_comments2 != $capa->capa_qa_comments2 || !empty($request->capa_qa_comments2_comment)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'CAPA QA Comments';
        //     $history->previous = $lastDocument->capa_qa_comments2;
        //     $history->current = $capa->capa_qa_comments2;
        //     $history->comment = $request->capa_qa_comments2_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;

        //     if (is_null($lastDocument->capa_qa_comments2) || $lastDocument->capa_qa_comments2 === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        // if ($lastDocument->details != $capa->details || !empty($request->details_comment)) {

        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Details';
        //     $history->previous = $lastDocument->details;
        //     $history->current = $capa->details;
        //     $history->comment = $request->details_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        // if ($lastDocument->project_details_application != $capa->project_details_application || !empty($request->project_details_application_comment)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Project Details Application';
        //     $history->previous = $lastDocument->project_details_application;
        //     $history->current = $capa->project_details_application;
        //     $history->comment = $request->project_details_application_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;

        //     // Null or empty check
        //     if (is_null($lastDocument->project_details_application) || $lastDocument->project_details_application === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        // if ($lastDocument->project_initiator_group != $capa->project_initiator_group || !empty($request->project_initiator_group_comment)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Initiator Group';
        //     $history->previous = $lastDocument->project_initiator_group;
        //     $history->current = $capa->project_initiator_group;
        //     $history->comment = $request->project_initiator_group_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;

        //     // Null or empty check
        //     if (is_null($lastDocument->project_initiator_group) || $lastDocument->project_initiator_group === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        // if ($lastDocument->site_number != $capa->site_number || !empty($request->site_number_comment)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Site Number';
        //     $history->previous = $lastDocument->site_number;
        //     $history->current = $capa->site_number;
        //     $history->comment = $request->site_number_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;

        //     // Null or empty check
        //     if (is_null($lastDocument->site_number) || $lastDocument->site_number === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        // if ($lastDocument->subject_number != $capa->subject_number || !empty($request->subject_number_comment)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Subject Number';
        //     $history->previous = $lastDocument->subject_number;
        //     $history->current = $capa->subject_number;
        //     $history->comment = $request->subject_number_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;

        //     // Null or empty check
        //     if (is_null($lastDocument->subject_number) || $lastDocument->subject_number === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        // if ($lastDocument->subject_initials != $capa->subject_initials || !empty($request->subject_initials_comment)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Subject Initials';
        //     $history->previous = $lastDocument->subject_initials;
        //     $history->current = $capa->subject_initials;
        //     $history->comment = $request->subject_initials_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;

        //     // Null or empty check
        //     if (is_null($lastDocument->subject_initials) || $lastDocument->subject_initials === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        // if ($lastDocument->sponsor != $capa->sponsor || !empty($request->sponsor_comment)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Sponsor';
        //     $history->previous = $lastDocument->sponsor;
        //     $history->current = $capa->sponsor;
        //     $history->comment = $request->sponsor_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;

        //     // Null or empty check
        //     if (is_null($lastDocument->sponsor) || $lastDocument->sponsor === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        // if ($lastDocument->general_deviation != $capa->general_deviation || !empty($request->general_deviation_comment)) {
        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'General Deviation';
        //     $history->previous = $lastDocument->general_deviation;
        //     $history->current = $capa->general_deviation;
        //     $history->comment = $request->general_deviation_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;

        //     // Null or empty check
        //     if (is_null($lastDocument->general_deviation) || $lastDocument->general_deviation === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }



        // if ($lastDocument->supervisor_review_comments != $capa->supervisor_review_comments || !empty($request->supervisor_review_comments_comment)) {

        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Supervisor Review Comments';
        //     $history->previous = $lastDocument->supervisor_review_comments;
        //     $history->current = $capa->supervisor_review_comments;
        //     $history->comment = $request->supervisor_review_comments_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->supervisor_review_comments) || $lastDocument->supervisor_review_comments === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }



        // if ($lastDocument->effectiveness != $capa->effectiveness || !empty($request->effectiveness_comment)) {

        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Effectiveness Check required';
        //     $history->previous = $lastDocument->effectiveness;
        //     $history->current = $capa->effectiveness;
        //     $history->comment = $request->effectiveness_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->effectiveness) || $lastDocument->effectiveness === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

        // if ($lastDocument->effect_check_date != $capa->effect_check_date || !empty($request->effect_check_date_comment)) {

        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Effect.Check Creation Date';
        //     $history->previous = $lastDocument->effect_check_date;
        //     $history->current = $capa->effect_check_date;
        //     $history->comment = $request->effect_check_date_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->effect_check_date) || $lastDocument->effect_check_date === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }


        // if ($lastDocument->severity_level_form != $capa->severity_level_form) {

        //     $history = new CapaAuditTrial();
        //     $history->capa_id = $id;
        //     $history->activity_type = 'Severity Level';
        //     $history->previous = $lastDocument->severity_level_form;
        //     $history->current = $capa->severity_level_form;
        //     $history->comment = $request->severity_level_form_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->severity_level_form) || $lastDocument->severity_level_form === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }















        //----------------- logic for showing grid data in audit trail -----------------------//

        $data1 = CapaGrid::where('capa_id', $id)->where('type', "Material_Details")->first();

        // Safely unserialize fields with a fallback to null if fields are empty
        $previousDetails = [
            'material_name' => !is_null($data1->material_name) ? unserialize($data1->material_name) : null,
            'material_batch_no' => !is_null($data1->material_batch_no) ? unserialize($data1->material_batch_no) : null,
            'material_mfg_date' => !is_null($data1->material_mfg_date) ? unserialize($data1->material_mfg_date) : null,
            'material_expiry_date' => !is_null($data1->material_expiry_date) ? unserialize($data1->material_expiry_date) : null,
            'material_batch_desposition' => !is_null($data1->material_batch_desposition) ? unserialize($data1->material_batch_desposition) : null,
            'material_remark' => !is_null($data1->material_remark) ? unserialize($data1->material_remark) : null,
            'material_batch_status' => !is_null($data1->material_batch_status) ? unserialize($data1->material_batch_status) : null,
        ];

        // Serialize fields if they are not empty
        if (!empty($request->material_name)) {
            $data1->material_name = serialize($request->material_name);
        }
        if (!empty($request->material_batch_no)) {
            $data1->material_batch_no = serialize($request->material_batch_no);
        }
        if (!empty($request->material_mfg_date)) {
            $data1->material_mfg_date = serialize($request->material_mfg_date);
        }
        if (!empty($request->material_expiry_date)) {
            $data1->material_expiry_date = serialize($request->material_expiry_date);
        }
        if (!empty($request->material_batch_desposition)) {
            $data1->material_batch_desposition = serialize($request->material_batch_desposition);
        }
        if (!empty($request->material_remark)) {
            $data1->material_remark = serialize($request->material_remark);
        }
        if (!empty($request->material_batch_status)) {
            $data1->material_batch_status = serialize($request->material_batch_status);
        }

        // Save updated data
        $data1->update();

        // Map database fields to descriptive field names
        $fieldNames = [
            'material_name' => 'Product / Material Name',
            'material_batch_no' => 'Product / Material Batch No./Lot No./AR No.',
            'material_mfg_date' => 'Product / Material Manufacturing Date',
            'material_expiry_date' => 'Product / Material Date of Expiry',
            'material_batch_desposition' => 'Product Batch Disposition Decision',
            'material_remark' => 'Product Remark',
            'material_batch_status' => 'Product Batch Status',
        ];

        if (is_array($request->material_name) && !empty($request->material_name)) {
            foreach ($request->material_name as $index => $material_name) {

                $previousValues = [
                    'material_name' => $previousDetails['material_name'][$index] ?? null,
                    'material_batch_no' => $previousDetails['material_batch_no'][$index] ?? null,
                    'material_mfg_date' => Helpers::getdateFormat($previousDetails['material_mfg_date'][$index] ?? null),
                    'material_expiry_date' => Helpers::getdateFormat($previousDetails['material_expiry_date'][$index] ?? null),
                    'material_batch_desposition' => $previousDetails['material_batch_desposition'][$index] ?? null,
                    'material_remark' => $previousDetails['material_remark'][$index] ?? null,
                    'material_batch_status' => $previousDetails['material_batch_status'][$index] ?? null,
                ];

                $previousValues = [
                    'material_name' => isset($previousDetails['material_name'][$index]) ? $previousDetails['material_name'][$index] : null,
                    
                    'material_batch_no' => isset($previousDetails['material_batch_no'][$index]) ? $previousDetails['material_batch_no'][$index] : null,
                    
                    'material_mfg_date' => isset($previousDetails['material_mfg_date'][$index]) ? Helpers::getdateFormat($previousDetails['material_mfg_date'][$index]) : null,
                    
                    'material_expiry_date' => isset($previousDetails['material_expiry_date'][$index]) ? Helpers::getdateFormat($previousDetails['material_expiry_date'][$index]) : null,

                    'material_batch_desposition' => isset($previousDetails['material_batch_desposition'][$index]) ? $previousDetails['material_batch_desposition'][$index] : null,
                    
                    'material_remark' => isset($previousDetails['material_remark'][$index]) ? $previousDetails['material_remark'][$index] : null,
                    
                    'material_batch_status' => isset($previousDetails['material_batch_status'][$index]) ? $previousDetails['material_batch_status'][$index] : null,
        
                    // 'action' => $previousDetails['action'][$index] ?? null,
                    // 'responsible' => Helpers::getInitiatorName($previousDetails['responsible'][$index]) ?? null,
                    // 'deadline' => Helpers::getdateFormat($previousDetails['deadline'][$index]) ?? null,
                    // 'item_status' => $previousDetails['item_status'][$index] ?? null,
                ];

                // Current field values
                $fields = [
                    'material_name' => $material_name,
                    'material_batch_no' => isset($request->material_batch_no[$index]) ? $request->material_batch_no[$index] : null,
                    'material_mfg_date' => isset($request->material_mfg_date[$index]) ? Helpers::getdateFormat($request->material_mfg_date[$index]) : null,
                    'material_expiry_date' => isset($request->material_expiry_date[$index]) ? Helpers::getdateFormat($request->material_expiry_date[$index]) : null,
                    'material_batch_desposition' => isset($request->material_batch_desposition[$index]) ? $request->material_batch_desposition[$index] : null,
                    'material_remark' => isset($request->material_remark[$index]) ? $request->material_remark[$index] : null,
                    'material_batch_status' => isset($request->material_batch_status[$index]) ? $request->material_batch_status[$index] : null,
                ];
                

                foreach ($fields as $key => $currentValue) {
                    $previousValue = $previousValues[$key] ?? null;

                    // Log changes if the current value is different from the previous one
                    if ($previousValue != $currentValue && !empty($currentValue)) {
                        // Check if an audit trail entry for this specific row and field already exists
                        $existingAudit = CapaAuditTrial::where('capa_id', $id)
                            ->where('activity_type', $fieldNames[$key] . ' (' . ($index + 1) . ')')
                            ->where('previous', $previousValue)
                            ->where('current', $currentValue)
                            ->exists();

                        // Only create a new audit trail entry if no existing entry matches
                        if (!$existingAudit) {
                            $history = new CapaAuditTrial();
                            $history->capa_id = $id;
                            $history->activity_type = $fieldNames[$key] . ' (' . ($index + 1) . ')';
                            $history->previous = $previousValue;
                            $history->current = $currentValue;
                            $history->comment = $request->material_comment[$index] ?? 'NA';
                            $history->user_id = Auth::user()->id;
                            $history->user_name = Auth::user()->name;
                            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                            $history->origin_state = $lastDocument->status;
                            $history->change_to = "Not Applicable";
                            $history->change_from = $lastDocument->status;
                            $history->action_name = "Update";
                            $history->save();
                        }
                    }
                }
            }
        }



        
//---------------------------------------------------------------------------------------------------------------------------

    $data3 = CapaGrid::where('capa_id', $id)->where('type', "Instruments_Details")->first();

    // Safely unserialize fields and fallback to null if they are empty
    $previousDetails = [
        'equipment' => !is_null($data3->equipment) ? unserialize($data3->equipment) : null,
        'equipment_instruments' => !is_null($data3->equipment_instruments) ? unserialize($data3->equipment_instruments) : null,
        'equipment_comments' => !is_null($data3->equipment_comments) ? unserialize($data3->equipment_comments) : null,
    ];

    // Serialize fields if they are not empty
    if (!empty($request->equipment)) {
        $data3->equipment = serialize($request->equipment);
    }
    if (!empty($request->equipment_instruments)) {
        $data3->equipment_instruments = serialize($request->equipment_instruments);
    }
    if (!empty($request->equipment_comments)) {
        $data3->equipment_comments = serialize($request->equipment_comments);
    }

    $data3->update();

    // Define the mapping of database fields to the descriptive field names
    $fieldNames = [
        'equipment' => 'Equipment/Instruments Name',
        'equipment_instruments' => 'Equipment/Instrument ID',
        'equipment_comments' => 'Equipment/Instruments Comments',
    ];

    if (is_array($request->equipment) && !empty($request->equipment)) {
        foreach ($request->equipment as $index => $equipment) {

            // Fetch previous values
            $previousValues = [
                'equipment' => isset($previousDetails['equipment'][$index]) ? $previousDetails['equipment'][$index] : null,
                'equipment_instruments' => isset($previousDetails['equipment_instruments'][$index]) ? $previousDetails['equipment_instruments'][$index] : null,
                'equipment_comments' => isset($previousDetails['equipment_comments'][$index]) ? $previousDetails['equipment_comments'][$index] : null,
            ];

            // Current field values
            $fields = [
                'equipment' => $equipment,
                'equipment_instruments' => $request->equipment_instruments[$index],
                'equipment_comments' => $request->equipment_comments[$index],
            ];

            foreach ($fields as $key => $currentValue) {
                $previousValue = $previousValues[$key] ?? null;

                // Log changes if the current value is different from the previous one
                if ($previousValue != $currentValue && !empty($currentValue)) {
                    // Check if an audit trail entry for this specific row and field already exists
                    $existingAudit = CapaAuditTrial::where('capa_id', $id)
                        ->where('activity_type', $fieldNames[$key] . ' (' . ($index + 1) . ')')
                        ->where('previous', $previousValue)
                        ->where('current', $currentValue)
                        ->exists();

                    // Only create a new audit trail entry if no existing entry matches
                    if (!$existingAudit) {
                        $history = new CapaAuditTrial();
                        $history->capa_id = $id;
                        $history->activity_type = $fieldNames[$key] . ' (' . ($index + 1) . ')';
                        $history->previous = $previousValue; // Use the previous value
                        $history->current = $currentValue; // New value
                        $history->comment = 'NA'; // Use comments if available
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to = "Not Applicable"; // Adjust if needed
                        $history->change_from = $lastDocument->status; // Adjust if needed
                        $history->action_name = "Update";
                        $history->save();
                    }
                }
            }
        }
    }

//-----------------------------------------------------------------------------------------------------------------
        // foreach ($request->equipment as $index => $equipment) {
        //     // Retrieve previous details for comparison
        //     $previousDetails = [
        //         'equipment' => unserialize($data3->equipment)[$index] ?? null,
        //         'equipment_instruments' => unserialize($data3->equipment_instruments)[$index] ?? null,
        //         'equipment_comments' => unserialize($data3->equipment_comments)[$index] ?? null,
        //     ];

        //     // Current fields values
        //     $fields = [
        //         'equipment' => $equipment,
        //         'equipment_instruments' => $request->equipment_instruments[$index],
        //         'equipment_comments' => $request->equipment_comments[$index],
        //     ];

        //     foreach ($fields as $key => $currentValue) {
        //         // Ensure null is explicitly stored if no previous value exists
        //         $previousValue = $previousDetails[$key] ?? null;

        //         // Log changes for new or updated rows
        //         if (($previousValue != $currentValue || !empty($request->equipment_comments[$index])) && !empty($currentValue)) {
        //             // Check if an audit trail entry for this specific row and field already exists
        //             $existingAudit = CapaAuditTrial::where('capa_id', $id)
        //                 ->where('activity_type', $fieldNames[$key] . ' (' . ($index + 1) . ')')
        //                 ->where('previous', $previousValue)
        //                 ->where('current', $currentValue)
        //                 ->exists();

        //             // Only create a new audit trail entry if no existing entry matches
        //             if (!$existingAudit) {
        //                 $history = new CapaAuditTrial();
        //                 $history->capa_id = $id;

        //                 // Set activity type to include field name and row index using the fieldNames array
        //                 $history->activity_type = $fieldNames[$key] . ' (' . ($index + 1) . ')';

        //                 // Assign 'Previous' value explicitly as null if it doesn't exist
        //                 $history->previous =  'null'; // Previous value or 'null'

        //                 // Assign 'Current' value, which is the new value
        //                 $history->current = $currentValue; // New value

        //                 // Comments and user details
        //                 $history->comment = $request->equipment_comments[$index] ?? '';
        //                 $history->user_id = Auth::user()->id;
        //                 $history->user_name = Auth::user()->name;
        //                 $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //                 $history->origin_state = $data3->status;
        //                 $history->change_to = "Not Applicable";
        //                 $history->change_from = $data3->status;
        //                 $history->action_name = "Update";

        //                 // Save the history record
        //                 $history->save();
        //             }
        //         }
        //     }
        // }


        // DocumentService::update_qms_numbers();

        toastr()->success("Record is updated Successfully");
        return back();
    }

    public function capashow($id)
    {
        $cft = [];
        $revised_date = "";
        $data = Capa::find($id);
        //dd($data);
        $old_record = Capa::select('id', 'division_id', 'record')->get();
        $revised_date = Extension::where('parent_id', $id)->where('parent_type', "Capa")->value('revised_date');
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $data1 = CapaGrid::where('capa_id', $id)->where('type', "Product_Details")->first();
        $data2 = CapaGrid::where('capa_id', $id)->where('type', "Material_Details")->first();
        $data3 = CapaGrid::where('capa_id', $id)->where('type', "Instruments_Details")->first();
        if (!empty($changeControl->cft)) $cft = explode(',', $changeControl->cft);
        // $MaterialsQueryData = Http::get('http://103.167.99.37/LIMS_EL/WebServices.Query.MaterialsQuery.lims');
        // dd( $MaterialsQueryData->json());
        // $EquipmentsQueryData = Http::get('http://103.167.99.37/LIMS_EL/WebServices.Query.EquipmentsQuery.lims');
        // dd( $EquipmentsQueryData->json());
        // dd($data);




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

        return view('frontend.capa.capaView', compact('data', 'data1', 'data2', 'data3', 'old_record', 'revised_date', 'cft', 'relatedRecords'));
    }


    public function capa_send_stage(Request $request, $id)
    {

        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $capa = Capa::find($id);
            $lastDocument = Capa::find($id);

            if ($capa->stage == 1) {
                if (empty($capa->assign_to) || empty($capa->due_date) || empty($capa->short_description) || empty($capa->initiated_through) || empty($capa->repeat) || empty($capa->problem_description) || empty($capa->initial_observation) || empty($capa->interim_containnment) || empty($capa->investigation) || empty($capa->rcadetails) || empty($capa->details_new) || empty($capa->capa_type)) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Mandatory Fields! to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for HOD Review state',
                        'type' => 'success',
                    ]);
                }
                $capa->stage = "2";
                $capa->status = "HOD Review";
                $capa->plan_proposed_by = Auth::user()->name;
                $capa->plan_proposed_on = Carbon::now()->format('d-M-Y');
                $capa->comment = $request->comment;
                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'Propose Plan By, Propose Plan On';
                $history->action = 'Propose Plan';
                $history->previous = "";
                $history->current = $capa->plan_proposed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;

                $history->change_to = "HOD Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'HOD Review';
                $history->action_name = 'Update';
                if (is_null($lastDocument->plan_proposed_by) || $lastDocument->plan_proposed_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->plan_proposed_by . ' , ' . $lastDocument->plan_proposed_on;
                }
                $history->current = $capa->plan_proposed_by . ' , ' . $capa->plan_proposed_on;
                if (is_null($lastDocument->plan_proposed_by) || $lastDocument->plan_proposed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

               

                 $list = Helpers::getHodUserList($capa->division_id);
                 foreach ($list as $u)
                {

                        $email = Helpers::getUserEmail($u->user_id);

                        if ($email !== null) {

                            try {

                                $data = [
                                    'data'    => $capa,
                                    'site'    => "CAPA",
                                    'history' => "Propose Plan",
                                    'process' => 'CAPA',
                                    'comment' => $request->commenta,
                                    'user'    => Auth::user()->name
                                ];

                                SendMail::dispatch(
                                    $data,
                                    $email,
                                    $capa,     // process object
                                    'CAPA'     // process name
                                );

                            } catch (\Exception $e) {

                                \Log::error('Queue Dispatch Error', [
                                    'email' => $email,
                                    'error' => $e->getMessage()
                                ]);
                            }
                        }
                    }
                //     foreach ($list as $u) 
                // {

                //     $email = Helpers::getUserEmail($u->user_id);

                //     if ($email !== null) {

                //         try {   

                //             Mail::send(
                //                 'mail.view-mail',
                //                 [
                //                     'data' => $capa,
                //                     'site' => "CAPA",
                //                     'history' => "Propose Plan",
                //                     'process' => 'CAPA',
                //                     'comment' => $request->commenta,
                //                     'user'=> Auth::user()->name
                //                 ],
                //                 function ($message) use ($email, $capa) {
                //                     $message->to($email)
                //                         ->subject(
                //                             "Agio Notification: CAPA, Record #"
                //                             . str_pad($capa->record, 4, '0', STR_PAD_LEFT)
                //                             . " - Activity: Propose Plan"
                //                         );
                //                 }
                //             );

                //         } catch (\Exception $e) {   

                //             \Log::error('Mail Error: ' . $e->getMessage()); 

                //         }   
                //     }
                // }


                $capa->update();
                //toastr()->success('Document Sent');
                return back();
            }
            if ($capa->stage == 2) {
                
                if (!$capa->hod_remarks) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'HOD Remark is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for QA/CQA Review state',
                        'type' => 'success',
                    ]);
                }

                 // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'CAPA')
                    ->get();
                        $hasPending1 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                           if ($extensionchildStatus !== 'closed - done' && $extensionchildStatus !== 'closed - reject' && $extensionchildStatus !== 'closed cancelled' ){
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

                $capa->stage = "3";
                $capa->status = "QA/CQA Review";
                $capa->hod_review_completed_by = Auth::user()->name;
                $capa->hod_review_completed_on = Carbon::now()->format('d-M-Y');
                $capa->hod_comment = $request->comment;
                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'HOD Review Complete By, HOD Review Complete On';
                $history->action = 'HOD Review Complete';
                $history->previous = "";
                $history->current = $capa->plan_approved_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "QA/CQA Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'QA/CQA Review';
                $history->action_name = 'Update';
                if (is_null($lastDocument->hod_review_completed_by) || $lastDocument->hod_review_completed_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->hod_review_completed_by . ' , ' . $lastDocument->hod_review_completed_on;
                }
                $history->current = $capa->hod_review_completed_by . ' , ' . $capa->hod_review_completed_on;
                if (is_null($lastDocument->hod_review_completed_by) || $lastDocument->hod_review_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                $QARevlist = Helpers::getQAReviewerUserList($capa->division_id);

                $CQARevlist = Helpers::getCQAReviewerUsersList($capa->division_id);

                $usersmerge = collect($QARevlist)->merge($CQARevlist);

                $usersmerge = $usersmerge->unique('user_id');

                foreach ($usersmerge as $u) 
                {

                    $email = Helpers::getUserEmail($u->user_id);

                    if ($email !== null) {

                        try {

                            Mail::send(
                                'mail.view-mail',
                                [
                                    'data'    => $capa,
                                    'site'    => "CAPA",
                                    'history' => "QA/CQA Review Complete",
                                    'process' => 'CAPA',
                                    'comment' => $request->commenta,
                                    'user'    => Auth::user()->name
                                ],
                                function ($message) use ($email, $capa) {
                                    $message->to($email)
                                        ->subject(
                                            "Agio Notification: CAPA, Record #"
                                            . str_pad($capa->record, 4, '0', STR_PAD_LEFT)
                                            . " - Activity: QA/CQA Review Complete"
                                        );
                                }
                            );

                        } catch (\Exception $e) {
                            \Log::error('Mail Error: ' . $e->getMessage());
                        }
                    }
                }

                $capa->update();
                //toastr()->success('Document Sent');
                return back();
            }
            if ($capa->stage == 3) {
                if (!$capa->capa_qa_comments) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'QA/CQA Review Comment is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for QA/CQA Approval state',
                        'type' => 'success',
                    ]);
                }
                //Action child

                   $actionchilds = ActionItem::where('parent_id', $id)
                                ->where('parent_type', 'CAPA')
                                ->get();
                                    $hasPendingaction = false;
                                foreach ($actionchilds as $ext) {
                                        $actionchildstatus = trim(strtolower($ext->status));
                                       if ($actionchildstatus !== 'closed - done'  && $actionchildstatus !== 'closed-cancelled') {
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
                // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'CAPA')
                    ->get();
                        $hasPending2 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done' && $extensionchildStatus !== 'closed - reject' && $extensionchildStatus !== 'closed cancelled' ) {
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

                $capa->stage = "4";
                $capa->status = "QA/CQA Approval";
                $capa->qa_review_completed_by = Auth::user()->name;
                $capa->qa_review_completed_on = Carbon::now()->format('d-M-Y');
                $capa->qa_comment = $request->comment;
                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'QA/CQA Review Complete By, QA/CQA Review Complete On';
                $history->action = 'QA/CQA Review Complete';
                $history->previous = "";
                $history->current = $capa->completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "QA/CQA Approval";
                $history->change_from = $lastDocument->status;
                $history->stage = 'QA/CQA Approval';
                $history->action_name = 'Update';
                if (is_null($lastDocument->qa_review_completed_by) || $lastDocument->qa_review_completed_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->qa_review_completed_by . ' , ' . $lastDocument->qa_review_completed_on;
                }
                $history->current = $capa->qa_review_completed_by . ' , ' . $capa->qa_review_completed_on;
                if (is_null($lastDocument->qa_review_completed_by) || $lastDocument->qa_review_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
              $QAaprList = Helpers::getCQAApproverUsersList($capa->division_id);
              $CQAapplist = Helpers::getCQAApproverUsersList($capa->division_id);
              $usersmerge = collect($QAaprList)->merge($CQAapplist);

                $usersmerge = $usersmerge->unique('user_id');

                foreach ($usersmerge as $u) {

                    $email = Helpers::getUserEmail($u->user_id);

                    if ($email !== null) {

                        try {

                            Mail::send(
                                'mail.view-mail',
                                [
                                    'data'    => $capa,
                                    'site'    => "CAPA",
                                    'history' => "QA/CQA Review Complete",
                                    'process' => 'CAPA',
                                    'comment' => $request->commenta,
                                    'user'    => Auth::user()->name
                                ],
                                function ($message) use ($email, $capa) {
                                    $message->to($email)
                                        ->subject(
                                            "Agio Notification: CAPA, Record #"
                                            . str_pad($capa->record, 4, '0', STR_PAD_LEFT)
                                            . " - Activity: QA/CQA Review Complete"
                                        );
                                }
                            );

                        } catch (\Exception $e) {
                            \Log::error('Mail Error: ' . $e->getMessage());
                        }
                    }
                }


                $capa->update();
                //toastr()->success('Document Sent');
                return back();
            }
            if ($capa->stage == 4) {
                if (!$capa->qah_cq_comments) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'QA/CQA Approval Comment is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for CAPA In progress state',
                        'type' => 'success',
                    ]);
                }

                //Action Item Child

                   $actionchilds = ActionItem::where('parent_id', $id)
                                ->where('parent_type', 'CAPA')
                                ->get();
                                    $hasPendingaction = false;
                                foreach ($actionchilds as $ext) {
                                        $actionchildstatus = trim(strtolower($ext->status));
                                        if ($actionchildstatus !== 'closed - done'  && $actionchildstatus !== 'closed-cancelled') {
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

                // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'CAPA')
                    ->get();
                        $hasPending3 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                             if ($extensionchildStatus !== 'closed - done' && $extensionchildStatus !== 'closed - reject' && $extensionchildStatus !== 'closed cancelled' ) {
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
                $capa->stage = "5";
                $capa->status = "CAPA In progress";
                $capa->approved_by = Auth::user()->name;
                $capa->approved_on = Carbon::now()->format('d-M-Y');
                $capa->approved_comment = $request->comment;

                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'Approved By, Approved On';
                $history->action = 'Approved';
                $history->previous = "";
                $history->current = $capa->approved_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "CAPA In progress";
                $history->change_from = $lastDocument->status;
                $history->stage = 'CAPA In progress';
                $history->action_name = 'Update';
                if (is_null($lastDocument->approved_by) || $lastDocument->approved_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->approved_by . ' , ' . $lastDocument->approved_on;
                }
                $history->current = $capa->approved_by . ' , ' . $capa->acknowledge_on;
                if (is_null($lastDocument->approved_by) || $lastDocument->approved_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
               

                 $list = Helpers::getInitiatorUserList($capa->division_id);
                foreach ($list as $u) {

                    $email = Helpers::getUserEmail($u->user_id);

                    if ($email !== null) {

                        try {   

                            Mail::send(
                                'mail.view-mail',
                                [
                                    'data' => $capa,
                                    'site' => "CAPA",
                                    'history' => "Approved",
                                    'process' => 'CAPA',
                                    'comment' => $request->commenta,
                                    'user'=> Auth::user()->name
                                ],
                                function ($message) use ($email, $capa) {
                                    $message->to($email)
                                        ->subject(
                                            "Agio Notification: CAPA, Record #"
                                            . str_pad($capa->record, 4, '0', STR_PAD_LEFT)
                                            . " - Activity: Approved"
                                        );
                                }
                            );

                        } catch (\Exception $e) {   

                            \Log::error('Mail Error: ' . $e->getMessage()); 

                        }   
                    }
                }

                $capa->update();
                //toastr()->success('Document Sent');
                return back();
            }
            if ($capa->stage == 5) {
                if (!$capa->initiator_comment) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'Initiator CAPA Update Comment is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for HOD Final Review state',
                        'type' => 'success',
                    ]);
                }

                //Action item child
                   $actionchilds = ActionItem::where('parent_id', $id)
                                ->where('parent_type', 'CAPA')
                                ->get();
                                    $hasPendingaction = false;
                                foreach ($actionchilds as $ext) {
                                        $actionchildstatus = trim(strtolower($ext->status));
                                         if ($actionchildstatus !== 'closed - done'  && $actionchildstatus !== 'closed-cancelled') {
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

                // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'CAPA')
                    ->get();
                        $hasPending4 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                             if ($extensionchildStatus !== 'closed - done' && $extensionchildStatus !== 'closed - reject' && $extensionchildStatus !== 'closed cancelled' ) {
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

                $capa->stage = "6";
                $capa->status = "HOD Final Review";
                $capa->completed_by = Auth::user()->name;
                $capa->completed_on = Carbon::now()->format('d-M-Y');
                $capa->com_comment = $request->comment;

                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'Completed By, Completed On';
                $history->action = 'Completed';
                $history->previous = "";
                $history->current = $capa->approved_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "HOD Final Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'HOD Final Review';
                $history->action_name = 'Update';
                if (is_null($lastDocument->completed_by) || $lastDocument->completed_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->completed_by . ' , ' . $lastDocument->completed_on;
                }
                $history->current = $capa->completed_by . ' , ' . $capa->completed_on;
                if (is_null($lastDocument->completed_by) || $lastDocument->completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
                

                   $list = Helpers::getHodUserList($capa->division_id);
                       foreach ($list as $u) {

                    $email = Helpers::getUserEmail($u->user_id);

                    if ($email !== null) {

                        try {   

                            Mail::send(
                                'mail.view-mail',
                                [
                                    'data' => $capa,
                                    'site' => "CAPA",
                                    'history' => "Completed",
                                    'process' => 'CAPA',
                                    'comment' => $request->commenta,
                                    'user'=> Auth::user()->name
                                ],
                                function ($message) use ($email, $capa) {
                                    $message->to($email)
                                        ->subject(
                                            "Agio Notification: CAPA, Record #"
                                            . str_pad($capa->record, 4, '0', STR_PAD_LEFT)
                                            . " - Activity: Completed"
                                        );
                                }
                            );

                        } catch (\Exception $e) {   

                            \Log::error('Mail Error: ' . $e->getMessage()); 

                        }   
                    }
                }
                $capa->update();
                //toastr()->success('Document Sent');
                return back();
            }
            if ($capa->stage == 6) {
                if (!$capa->hod_final_review) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'HOD Final Review Comments is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for QA/CQA Closure Review state',
                        'type' => 'success',
                    ]);
                }


               

                // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'CAPA')
                    ->get();
                        $hasPending5 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done' && $extensionchildStatus !== 'closed - reject' && $extensionchildStatus !== 'closed cancelled' ){
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

                $capa->stage = "7";
                $capa->status = "QA/CQA Closure Review";
                $capa->hod_final_review_completed_by = Auth::user()->name;
                $capa->hod_final_review_completed_on = Carbon::now()->format('d-M-Y');
                $capa->final_comment = $request->comment;

                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'HOD Final Review Completed By, HOD Final Review Completed On';
                $history->action = 'HOD Final Review Completed';
                $history->previous = "";
                $history->current = $capa->approved_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "QA/CQA Closure Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'QA/CQA Closure Review';
                $history->action_name = 'Update';
                if (is_null($lastDocument->hod_final_review_completed_by) || $lastDocument->hod_final_review_completed_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->hod_final_review_completed_by . ' , ' . $lastDocument->hod_final_review_completed_on;
                }
                $history->current = $capa->hod_final_review_completed_by . ' , ' . $capa->hod_final_review_completed_on;
                if (is_null($lastDocument->hod_final_review_completed_by) || $lastDocument->acknowledge_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
                $QAList = Helpers::getQAUserList($capa->division_id);
              $CQAlist = Helpers::getCQAUsersList($capa->division_id);
              $usersmerge = collect($QAList)->merge($CQAlist);

                $usersmerge = $usersmerge->unique('user_id');

                foreach ($usersmerge as $u) {

                    $email = Helpers::getUserEmail($u->user_id);

                    if ($email !== null) {

                        try {

                            Mail::send(
                                'mail.view-mail',
                                [
                                    'data'    => $capa,
                                    'site'    => "CAPA",
                                    'history' => "QA/CQA Review Complete",
                                    'process' => 'CAPA',
                                    'comment' => $request->commenta,
                                    'user'    => Auth::user()->name
                                ],
                                function ($message) use ($email, $capa) {
                                    $message->to($email)
                                        ->subject(
                                            "Agio Notification: CAPA, Record #"
                                            . str_pad($capa->record, 4, '0', STR_PAD_LEFT)
                                            . " - Activity: QA/CQA Review Complete"
                                        );
                                }
                            );

                        } catch (\Exception $e) {
                            \Log::error('Mail Error: ' . $e->getMessage());
                        }
                    }
                }
                $capa->update();
                //toastr()->success('Document Sent');
                return back();
            }
            if ($capa->stage == 7) {
                if (!$capa->qa_cqa_qa_comments) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'QA/CQA Closure Review Comment is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for QAH/CQA Approval state',
                        'type' => 'success',
                    ]);
                }


                 //Action item child
                   $actionchilds = ActionItem::where('parent_id', $id)
                                ->where('parent_type', 'CAPA')
                                ->get();
                                    $hasPendingaction = false;
                                foreach ($actionchilds as $ext) {
                                        $actionchildstatus = trim(strtolower($ext->status));
                                         if ($actionchildstatus !== 'closed - done'  && $actionchildstatus !== 'closed-cancelled') {
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
                // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'CAPA')
                    ->get();
                        $hasPending6 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done' && $extensionchildStatus !== 'closed - reject' && $extensionchildStatus !== 'closed cancelled' ) {
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

                $capa->stage = "8";
                $capa->status = "QA/CQA Approval ";
                $capa->qa_closure_review_completed_by = Auth::user()->name;
                $capa->qa_closure_review_completed_on = Carbon::now()->format('d-M-Y');
                $capa->qa_closure_comment = $request->comment;

                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'QA/CQA Closure Review Completed By, QA/CQA Closure Review Completed On';
                $history->action = 'QA/CQA Closure Review Completed';
                $history->previous = "";
                $history->current = $capa->approved_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "QA/CQA Approval ";
                $history->change_from = $lastDocument->status;
                $history->stage = 'QA/CQA Approval ';
                $history->action_name = 'Update';
                if (is_null($lastDocument->qa_closure_review_completed_by) || $lastDocument->qa_closure_review_completed_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->qa_closure_review_completed_by . ' , ' . $lastDocument->qa_closure_review_completed_on;
                }
                $history->current = $capa->qa_closure_review_completed_by . ' , ' . $capa->qa_closure_review_completed_on;
                if (is_null($lastDocument->qa_closure_review_completed_by) || $lastDocument->qa_closure_review_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
                


                 $list = Helpers::getQAHeadUserList($capa->division_id);
                       foreach ($list as $u) {

                    $email = Helpers::getUserEmail($u->user_id);

                    if ($email !== null) {

                        try {   

                            Mail::send(
                                'mail.view-mail',
                                [
                                    'data' => $capa,
                                    'site' => "CAPA",
                                    'history' => "Cancel",
                                    'process' => 'CAPA',
                                    'comment' => $request->commenta,
                                    'user'=> Auth::user()->name
                                ],
                                function ($message) use ($email, $capa) {
                                    $message->to($email)
                                        ->subject(
                                            "Agio Notification: CAPA, Record #"
                                            . str_pad($capa->record, 4, '0', STR_PAD_LEFT)
                                            . " - Activity: Cancel"
                                        );
                                }
                            );

                        } catch (\Exception $e) {   

                            \Log::error('Mail Error: ' . $e->getMessage()); 

                        }   
                    }
                }
                $capa->update();
                //toastr()->success('Document Sent');
                return back();
            }

            if ($capa->stage == 8) {
                if (!$capa->qa_review) {
                    // Flash message for warning (field not filled)
                    Session::flash('swal', [
                        'title' => 'Mandatory Fields Required!',
                        'message' => 'QA/CQA Head Closure Review Comment is yet to be filled!',
                        'type' => 'warning',  // Type can be success, error, warning, info, etc.
                    ]);

                    return redirect()->back();
                } else {
                    // Flash message for success (when the form is filled correctly)
                    Session::flash('swal', [
                        'title' => 'Success!',
                        'message' => 'Sent for Closed - Done state',
                        'type' => 'success',
                    ]);
                }

                // exetnsion child validation
                      $extensionchild = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'CAPA')
                    ->get();
                        $hasPending7 = false;
                    foreach ($extensionchild as $ext) {
                            $extensionchildStatus = trim(strtolower($ext->status));
                            if ($extensionchildStatus !== 'closed - done' && $extensionchildStatus !== 'closed - reject' && $extensionchildStatus !== 'closed cancelled' ) {
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
                $capa->stage = "9";
                $capa->status = "Closed - Done";
                $capa->qah_approval_completed_by = Auth::user()->name;
                $capa->qah_approval_completed_on = Carbon::now()->format('d-M-Y');
                $capa->qah_comment = $request->comment;
                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'QAH/CQA Head Approval Complete By, QAH/CQA Head Approval Complete On';
                $history->action = 'QAH/CQA Head Approval Complete';
                $history->previous = "";
                $history->current = $capa->completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Closed - Done";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Closed - Done';
                $history->action_name = 'Update';
                if (is_null($lastDocument->qah_approval_completed_by) || $lastDocument->qah_approval_completed_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->qah_approval_completed_by . ' , ' . $lastDocument->qah_approval_completed_on;
                }
                $history->current = $capa->qah_approval_completed_by . ' , ' . $capa->qah_approval_completed_on;
                if (is_null($lastDocument->qah_approval_completed_by) || $lastDocument->qah_approval_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
             
                // $usersmerge = $usersmerge->unique('user_id');
                $usersmerge = collect()
                ->merge(Helpers::getQAUserList($capa->division_id))
                ->merge(Helpers::getCQAUsersList($capa->division_id))
                ->merge(Helpers::getQAReviewerUserList($capa->division_id))
                ->merge(Helpers::getCQAReviewerUsersList($capa->division_id))
                ->merge(Helpers::getCQAApproverUsersList($capa->division_id))
                ->merge(Helpers::getQAApproverUserList($capa->division_id))
                ->merge(Helpers::getInitiatorUserList($capa->division_id))
                ->merge(Helpers::getHodUserList($capa->division_id))
                ->unique('user_id');

                foreach ($usersmerge as $u) {

                    $email = Helpers::getUserEmail($u->user_id);

                    if ($email !== null) {

                        try {

                            Mail::send(
                                'mail.view-mail',
                                [
                                    'data'    => $capa,
                                    'site'    => "CAPA",
                                    'history' => "QAH/CQA Head Approval Complete",
                                    'process' => 'CAPA',
                                    'comment' => $request->commenta,
                                    'user'    => Auth::user()->name
                                ],
                                function ($message) use ($email, $capa) {
                                    $message->to($email)
                                        ->subject(
                                            "Agio Notification: CAPA, Record #"
                                            . str_pad($capa->record, 4, '0', STR_PAD_LEFT)
                                            . " - Activity: QAH/CQA Head Approval Complete"
                                        );
                                }
                            );

                        } catch (\Exception $e) {
                            \Log::error('Mail Error: ' . $e->getMessage());
                        }
                    }
                }
                $capa->update();
                //toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function capaCancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $capa = Capa::find($id);
            $lastDocument = Capa::find($id);

            if ($capa->stage == 2) {
                $capa->stage = "0";
                $capa->status = "Closed-Cancelled";
                $capa->cancelled_by = Auth::user()->name;
                $capa->cancelled_on = Carbon::now()->format('d-M-Y');
                $capa->cancel_comment = $request->comment;
            
              
                $childActionItems = ActionItem::where('parent_id', $id)
                ->where('parent_type', 'CAPA')
                ->get();

                if ($childActionItems->count() > 0) {
                    foreach ($childActionItems as $actionItem) {
                        $lastopenState = clone $actionItem; // save previous values before update

                        // 🔹 Update fields
                        $actionItem->stage = "0";
                        $actionItem->status = "Closed-Cancelled";
                        $actionItem->cancelled_by = Auth::user()->name;
                        $actionItem->cancelled_on = Carbon::now()->format('d-M-Y');
                        $actionItem->cancelled_comment =$request->comment;
                        $actionItem->save();

                        // 🔹 Create history record
                        $history = new ActionItemHistory();
                        $history->cc_id = $actionItem->id;
                        $history->action = "Cancel";
                        $history->activity_type = 'Cancel By, Cancel On';
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastopenState->status;
                        $history->change_from = $lastopenState->status;
                        $history->change_to = "Closed-Cancelled";
                        $history->stage = "Cancelled";

                        // 🔹 Previous & Current info
                        $history->previous = $lastopenState->cancelled_by
                            ? $lastopenState->cancelled_by . ' , ' . $lastopenState->cancelled_on
                            : '';
                        $history->current = $actionItem->cancelled_by . ' , ' . $actionItem->cancelled_on;
                        $history->action_name = $lastopenState->cancelled_by ? 'Update' : 'New';

                        $history->save();
                    }
                }




                $childExtensions = extension_new::where('parent_id', $id)
                    ->where('parent_type', 'CAPA')
                    ->get();

                if ($childExtensions->count() > 0) {
                    foreach ($childExtensions as $ext) {
                        $lastDocument = clone $ext; // store previous values

                        // 🔹 Update each child extension
                        $ext->status = "Closed Cancelled";
                        $ext->stage = "0";
                        $ext->reject_by = Auth::user()->name;
                        $ext->reject_on = Carbon::now()->format('d-M-Y');
                        $ext->reject_comment = $request->comment;
                        $ext->save();

                        // 🔹 Add Audit Trail
                        $history = new ExtensionNewAuditTrail();
                        $history->extension_id = $ext->id;
                        $history->activity_type = 'Cancel By, Cancel On';
                        $history->action = 'Cancel';
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_from = $lastDocument->status;
                        $history->change_to = "Closed - Cancelled";
                        $history->stage = 'Closed - Cancelled';

                        // Previous/Current data tracking
                        $history->previous = $lastDocument->reject_by
                            ? $lastDocument->reject_by . ' , ' . $lastDocument->reject_on
                            : '';
                        $history->current = $ext->reject_by . ' , ' . $ext->reject_on;
                        $history->action_name = $lastDocument->reject_by ? 'Update' : 'New';

                        $history->save();
                    }
                }




                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'Cancel By, Cancel On';
                $history->action = 'Cancel';
                $history->previous = "";
                $history->current = $capa->cancelled_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state =  $capa->status;
                $history->change_to = "Closed-Cancelled";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Cancelled';
                if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->cancelled_by . ' , ' . $lastDocument->cancelled_on;
                }
                $history->current = $capa->cancelled_by . ' , ' . $capa->cancelled_on;
                if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
               
                // $usersmerge = $usersmerge->unique('user_id');
                $usersmerge = collect()
                ->merge(Helpers::getQAUserList($capa->division_id))
                ->merge(Helpers::getCQAUsersList($capa->division_id))
                ->unique('user_id');

                foreach ($usersmerge as $u) {

                    $email = Helpers::getUserEmail($u->user_id);

                    if ($email !== null) {

                        try {

                            Mail::send(
                                'mail.view-mail',
                                [
                                    'data'    => $capa,
                                    'site'    => "CAPA",
                                    'history' => "Closed-Cancelled",
                                    'process' => 'CAPA',
                                    'comment' => $request->commenta,
                                    'user'    => Auth::user()->name
                                ],
                                function ($message) use ($email, $capa) {
                                    $message->to($email)
                                        ->subject(
                                            "Agio Notification: CAPA, Record #"
                                            . str_pad($capa->record, 4, '0', STR_PAD_LEFT)
                                            . " - Activity: Closed-Cancelled"
                                        );
                                }
                            );

                        } catch (\Exception $e) {
                            \Log::error('Mail Error: ' . $e->getMessage());
                        }
                    }
                }
                $capa->update();
                $history = new CapaHistory();
                $history->type = "Capa";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $capa->stage;
                $history->status = $capa->status;
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function capa_qa_more_info(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $capa = Capa::find($id);
            $lastDocument = Capa::find($id);
            if ($capa->stage == 2) {
                $capa->stage = "1";
                $capa->status = "Opened";
               
                $capa->more_info_required_by = Auth::user()->name;
                $capa->more_info_required_on = Carbon::now()->format('d-M-Y');
                $capa->hod_comment1 = $request->comment;

                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->action  = "More Information Required";
                $history->current = "Not Applicable";
                $history->action_name = "Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Opened";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Opened';
                // $history->action_name = 'Update';
                // if (is_null($lastDocument->more_info_required_by) || $lastDocument->more_info_required_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->more_info_required_by . ' , ' . $lastDocument->more_info_required_on;
                // }
                // $history->current = $capa->more_info_required_by . ' , ' . $capa->more_info_required_on;
                // if (is_null($lastDocument->more_info_required_by) || $lastDocument->more_info_required_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->save();
                $list = Helpers::getInitiatorUserList($capa->division_id);
                foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $capa->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            try {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $capa, 'site'=>"CAPA", 'history' => "More Info Required ", 'process' => 'Capa', 'comment' => $capa->hod_comment1, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $capa) {
                                        $message->to($email)
                                        ->subject("Agio Notification: Capa, Record #" . str_pad($capa->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required  Performed");
                                    }
                                );
                            } catch(\Exception $e) {
                                info('Error sending mail', [$e]);
                            }
                        }
                    // }
                }


                 
                $capa->update();
                $history = new CapaHistory();
                $history->type = "Capa";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $capa->stage;
                $history->status = $capa->status;
                $history->save();

                toastr()->success('Document Sent');
                return back();
            }

            if ($capa->stage == 3) {
                $capa->stage = "2";
                $capa->status = "HOD Review";
                $capa->qa_more_info_required_by = Auth::user()->name;
                $capa->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                $capa->qa_commenta = $request->comment;

                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->action  = "More Information Required";
                $history->current = "Not Applicable";
                $history->action_name = "Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "HOD Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'HOD Review';
                // $history->action_name = 'Update';
                // if (is_null($lastDocument->qa_more_info_required_by) || $lastDocument->qa_more_info_required_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->qa_more_info_required_by . ' , ' . $lastDocument->qa_more_info_required_on;
                // }
                // $history->current = $capa->qa_more_info_required_by . ' , ' . $capa->qa_more_info_required_on;
                // if (is_null($lastDocument->qa_more_info_required_by) || $lastDocument->qa_more_info_required_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->save();
              
                 $list = Helpers::getHodUserList($capa->division_id);
                      foreach ($list as $u) {
                    // if($u->q_m_s_divisions_id == $capa->division_id){
                        $email = Helpers::getUserEmail($u->user_id);
                            if ($email !== null) {
                            try {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $capa, 'site'=>"CAPA", 'history' => "More Info Required ", 'process' => 'Capa', 'comment' => $capa->hod_comment1, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $capa) {
                                        $message->to($email)
                                        ->subject("Agio Notification: Capa, Record #" . str_pad($capa->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required  Performed");
                                    }
                                );
                            } catch(\Exception $e) {
                                info('Error sending mail', [$e]);
                            }
                        }
                    // }
                }
                $capa->update();
                $history = new CapaHistory();
                $history->type = "Capa";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $capa->stage;
                $history->status = $capa->status;
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }

            if ($capa->stage == 4) {
                $capa->stage = "3";
                $capa->status = "QA/CQA Review";
                $capa->app_more_info_required_by = Auth::user()->name;
                $capa->app_more_info_required_on = Carbon::now()->format('d-M-Y');
                $capa->app_comment = $request->comment;
              

                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->action  = "More Information Required";
                $history->current = "Not Applicable";
                $history->action_name = "Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "QA/CQA Review";
                $history->change_from = $lastDocument->status;
                $history->stage = 'Rejected';
                  // $usersmerge = $usersmerge->unique('user_id');
                $usersmerge = collect()
                ->merge(Helpers::getQAReviewerUserList($capa->division_id))
                ->merge(Helpers::getCQAReviewerUsersList($capa->division_id))
                ->unique('user_id');

                foreach ($usersmerge as $u) {

                    $email = Helpers::getUserEmail($u->user_id);

                    if ($email !== null) {

                        try {

                            Mail::send(
                                'mail.view-mail',
                                [
                                    'data'    => $capa,
                                    'site'    => "CAPA",
                                    'history' => "More Information Required",
                                    'process' => 'CAPA',
                                    'comment' => $request->commenta,
                                    'user'    => Auth::user()->name
                                ],
                                function ($message) use ($email, $capa) {
                                    $message->to($email)
                                        ->subject(
                                            "Agio Notification: CAPA, Record #"
                                            . str_pad($capa->record, 4, '0', STR_PAD_LEFT)
                                            . " - Activity: More Information Required"
                                        );
                                }
                            );

                        } catch (\Exception $e) {
                            \Log::error('Mail Error: ' . $e->getMessage());
                        }
                    }
                }
                $capa->update();
                $history->save();

               

          
                $history = new CapaHistory();
                $history->type = "Capa";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $capa->stage;
                $history->status = $capa->status;
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
            if ($capa->stage == 5) {
                $capa->stage = "4";
                $capa->status = "QA/CQA Approval";
                $capa->com_more_info_required_by = Auth::user()->name;
                $capa->com_more_info_required_on = Carbon::now()->format('d-M-Y');
                $capa->com_comment1 = $request->comment;

                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->action  = "More Information Required";
                $history->current = "Not Applicable";
                $history->action_name = "Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "QA/CQA Approval";
                $history->change_from = $lastDocument->status;
                $history->stage = 'QA/CQA Approval';
                // $history->action_name = 'Update';
                // if (is_null($lastDocument->com_more_info_required_by) || $lastDocument->com_more_info_required_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->com_more_info_required_by . ' , ' . $lastDocument->com_more_info_required_on;
                // }
                // $history->current = $capa->com_more_info_required_by . ' , ' . $capa->com_more_info_required_on;
                // if (is_null($lastDocument->com_more_info_required_by) || $lastDocument->com_more_info_required_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->save();

                $capa->update();


                
                $history = new CapaHistory();
                $history->type = "Capa";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $capa->stage;
                $history->status = $capa->status;
                $history->save();

                toastr()->success('Document Sent');
                return back();
            }
        }
        if ($capa->stage == 6) {
            $capa->stage = "5";
            $capa->status = "CAPA In progress";
            $capa->hod_more_info_required_by = Auth::user()->name;
            $capa->hod_more_info_required_on = Carbon::now()->format('d-M-Y');
            $capa->final_hod_comment = $request->comment;

            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Not Applicable';
            $history->previous = "Not Applicable";
            $history->action  = "More Information Required";
            $history->current = "Not Applicable";
            $history->action_name = "Not Applicable";
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "CAPA In progress";
            $history->change_from = $lastDocument->status;
            $history->stage = 'CAPA In progress';
            
            $history->save();
            
             $list = Helpers::getInitiatorUserList($capa->division_id);
                       foreach ($list as $u) {

                    $email = Helpers::getUserEmail($u->user_id);

                    if ($email !== null) {

                        try {   

                            Mail::send(
                                'mail.view-mail',
                                [
                                    'data' => $capa,
                                    'site' => "CAPA",
                                    'history' => "More Information Required",
                                    'process' => 'CAPA',
                                    'comment' => $request->commenta,
                                    'user'=> Auth::user()->name
                                ],
                                function ($message) use ($email, $capa) {
                                    $message->to($email)
                                        ->subject(
                                            "Agio Notification: CAPA, Record #"
                                            . str_pad($capa->record, 4, '0', STR_PAD_LEFT)
                                            . " - Activity: More Information Required"
                                        );
                                }
                            );

                        } catch (\Exception $e) {   

                            \Log::error('Mail Error: ' . $e->getMessage()); 

                        }   
                    }
                }
            $capa->update();
            $history = new CapaHistory();
            $history->type = "Capa";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $capa->stage;
            $history->status = $capa->status;
            $history->save();

            toastr()->success('Document Sent');
            return back();
        }
        if ($capa->stage == 7) {
            $capa->stage = "6";
            $capa->status = "HOD Final Review";
            $capa->closure_more_info_required_by = Auth::user()->name;
            $capa->closure_qa_more_info_required_on = Carbon::now()->format('d-M-Y');
            $capa->closure_qa_comment = $request->comment;

            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Not Applicable';
            $history->previous = "Not Applicable";
            $history->action  = "More Information Required";
            $history->current = "Not Applicable";
            $history->action_name = "Not Applicable";
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "HOD Final Review";
            $history->change_from = $lastDocument->status;
            $history->stage = 'HOD Final Review';
            $history->action_name = 'Update';
          

            $list = Helpers::getHodUserList($capa->division_id);
                      foreach ($list as $u) {

                    $email = Helpers::getUserEmail($u->user_id);

                    if ($email !== null) {

                        try {   

                            Mail::send(
                                'mail.view-mail',
                                [
                                    'data' => $capa,
                                    'site' => "CAPA",
                                    'history' => "More Information Required",
                                    'process' => 'CAPA',
                                    'comment' => $request->commenta,
                                    'user'=> Auth::user()->name
                                ],
                                function ($message) use ($email, $capa) {
                                    $message->to($email)
                                        ->subject(
                                            "Agio Notification: CAPA, Record #"
                                            . str_pad($capa->record, 4, '0', STR_PAD_LEFT)
                                            . " - Activity: More Information Required"
                                        );
                                }
                            );

                        } catch (\Exception $e) {   

                            \Log::error('Mail Error: ' . $e->getMessage()); 

                        }   
                    }
                }
            $capa->update();
            $history = new CapaHistory();
            $history->type = "Capa";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $capa->stage;
            $history->status = $capa->status;
            $history->save();

            toastr()->success('Document Sent');
            return back();
        }
        if ($capa->stage == 8) {
            $capa->stage = "7";
            $capa->status = "QA/CQA Closure Review";
            $capa->qah_more_info_required_by = Auth::user()->name;
            $capa->qah_more_info_required_on = Carbon::now()->format('d-M-Y');
            $capa->qah_comment1 = $request->comment;

            $history = new CapaAuditTrial();
            $history->capa_id = $id;
            $history->activity_type = 'Not Applicable';
            $history->previous = "Not Applicable";
            $history->action  = "More Information Required";
            $history->current = "Not Applicable";
            $history->action_name = "Not Applicable";
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "QA/CQA Closure Review";
            $history->change_from = $lastDocument->status;
            $history->stage = 'QA/CQA Closure Review';
            // $history->action_name = 'Update';
            // if (is_null($lastDocument->qah_more_info_required_by) || $lastDocument->qah_more_info_required_by === '') {
            //     $history->previous = "";
            // } else {
            //     $history->previous = $lastDocument->qah_more_info_required_by . ' , ' . $lastDocument->qah_more_info_required_on;
            // }
            // $history->current = $capa->qah_more_info_required_by . ' , ' . $capa->qah_more_info_required_on;
            // if (is_null($lastDocument->qah_more_info_required_by) || $lastDocument->qah_more_info_required_by === '') {
            //     $history->action_name = 'New';
            // } else {
            //     $history->action_name = 'Update';
            // }
            $history->save();

             $usersmerge = collect()
                ->merge(Helpers::getQAUserList($capa->division_id))
                ->merge(Helpers::getCQAUsersList($capa->division_id))
                ->unique('user_id');

                foreach ($usersmerge as $u) {

                    $email = Helpers::getUserEmail($u->user_id);

                    if ($email !== null) {

                        try {

                            Mail::send(
                                'mail.view-mail',
                                [
                                    'data'    => $capa,
                                    'site'    => "CAPA",
                                    'history' => "More Information Required",
                                    'process' => 'CAPA',
                                    'comment' => $request->commenta,
                                    'user'    => Auth::user()->name
                                ],
                                function ($message) use ($email, $capa) {
                                    $message->to($email)
                                        ->subject(
                                            "Agio Notification: CAPA, Record #"
                                            . str_pad($capa->record, 4, '0', STR_PAD_LEFT)
                                            . " - Activity: More Information Required"
                                        );
                                }
                            );

                        } catch (\Exception $e) {
                            \Log::error('Mail Error: ' . $e->getMessage());
                        }
                    }
                }
             
            $capa->update();
            $history = new CapaHistory();
            $history->type = "Capa";
            $history->doc_id = $id;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->stage_id = $capa->stage;
            $history->status = $capa->status;
            $history->save();

            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function capa_reject(Request $request, $id)
    {

        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $capa = Capa::find($id);
            $lastDocument = Capa::find($id);


            if ($capa->stage == 2) {
                $capa->stage = "1";
                $capa->status = "Opened";
               
                // $capa->rejected_by = Auth::user()->name;
                // $capa->rejected_on = Carbon::now()->format('d-M-Y');
                // $capa->update();
                // $history = new CapaHistory();
                // $history->type = "Capa";
                // $history->doc_id = $id;
                // $history->user_id = Auth::user()->id;
                // $history->user_name = Auth::user()->name;
                // $history->stage_id = $lastDocument->stage;
                // $history->status = "Opened";
                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $capa->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Opened";
                $history->change_from = "Pending CAPA Plan";

                $history->save();
                $capa->update();
               


                $list = Helpers::getInitiatorUserList($capa->division_id);
                    foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $capa, 'site'=>"CAPA", 'history' => "More Info Required", 'process' => 'CAPA', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $capa) {
                                        $message->to($email)
                                        ->subject("Agio Notification: CAPA, Record #" . str_pad($capa->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required Performed");
                                    }
                                );
                            }
                        
                    }

                toastr()->success('Document Sent');
                return back();
            }
            if ($capa->stage == 3) {
                $capa->stage = "2";
                $capa->status = "Pending CAPA Plan";
                $capa->qa_more_info_required_by = Auth::user()->name;
                $capa->qa_more_info_required_on = Carbon::now()->format('d-M-Y');
                // $history = new CapaAuditTrial();
                // $history->capa_id = $id;
                // $history->activity_type = 'Activity Log';
                // $history->previous = "";
                // $history->current = $capa->qa_more_info_required_by;
                // $history->comment = $request->comment;
                // $history->user_id = Auth::user()->id;
                // $history->user_name = Auth::user()->name;
                // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                // $history->origin_state = $lastDocument->status;
                // $history->stage = 'Qa More Info Required';
                // $history->save();
                $history = new CapaAuditTrial();
                $history->capa_id = $id;
                $history->activity_type = 'Activity Log';
                $history->action = 'Reject';
                $history->previous = "";
                $history->current = $capa->qa_more_info_required_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "Pending CAPA Plan";
                $history->change_from = "CAPA In Progress";
                $history->stage = 'CAPA In Progress';
                $history->action_name = 'Update';

                $history->save();
                $capa->update();


                 $list = Helpers::getHodUserList($capa->division_id);
                    foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                                if ($email !== null) {
                                Mail::send(
                                    'mail.view-mail',
                                    ['data' => $capa, 'site'=>"CAPA", 'history' => "More Info Required", 'process' => 'CAPA', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                                    function ($message) use ($email, $capa) {
                                        $message->to($email)
                                        ->subject("Agio Notification: CAPA, Record #" . str_pad($capa->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required Performed");
                                    }
                                );
                            }
                        
                    }
                $history = new CapaHistory();
                $history->type = "Capa";
                $history->doc_id = $id;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->stage_id = $capa->stage;
                $history->status = "Pending CAPA Plan<";
                $history->save();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }



    public function CapaAuditTrial($id)
    {
        $audit = CapaAuditTrial::where('capa_id', $id)->orderByDesc('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = Capa::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
        $data = Capa::find($id);

        // return $audit;

        return view('frontend.capa.audit-trial', compact('audit', 'document', 'today', 'data'));
    }

    public function auditDetails($id)
    {

        $detail = CapaAuditTrial::find($id);

        $detail_data = CapaAuditTrial::where('activity_type', $detail->activity_type)->where('capa_id', $detail->capa_id)->latest()->get();

        $doc = Capa::where('id', $detail->capa_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);
        return view('frontend.capa.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
    }

    public function child_change_control(Request $request, $id)
    {
        $cft = [];
        $parent_id = $id;
        $parent_type = "CAPA";
        $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = str_pad($record, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $parent_record = Capa::where('id', $id)->value('record');
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_division_id = Capa::where('id', $id)->value('division_id');
        $parent_initiator_id = Capa::where('id', $id)->value('initiator_id');
        $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
        $parent_short_description = Capa::where('id', $id)->value('short_description');
        $hod = User::where('role', 4)->get();
        $pre = CC::all();
        $changeControl = OpenStage::find(1);
        if (!empty($changeControl->cft)) $cft = explode(',', $changeControl->cft);
        // return $capa_data;
        if ($request->child_type == "Change_control") {
            $record_number = $record;
            return view('frontend.change-control.new-change-control', compact('cft', 'pre', 'hod', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id', 'parent_record', 'record_number', 'due_date', 'parent_id', 'parent_type'));
        }

        $old_record = Capa::select('id', 'division_id', 'record')->get();
        if ($request->child_type == "Action_Item") {
            $parentRecord = Capa::where('id', $id)->value('record');
            $parent_name = "CAPA";
            // $data = Capa::find($id);
            $data1 = Capa::select('id', 'division_id', 'record', 'due_date')->where('id', $id)->first();
            
            // $p_record = OutOfCalibration::find($id);
            $data_record = Helpers::getDivisionName($data1->division_id) . '/' . 'CAPA' . '/' . date('Y') . '/' . str_pad($data1->record, 4, '0', STR_PAD_LEFT);
             $parent_record = $data_record;
            $expectedParenRecord = Helpers::getDivisionName(session()->get('division')) . "/CAPA/" . date('Y') . "/" . $data1->record . "";
            return view('frontend.action-item.action-item', compact('expectedParenRecord', 'old_record', 'parentRecord', 'parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_name', 'parent_division_id', 'parent_record', 'record', 'due_date', 'parent_id', 'parent_type', 'data_record', 'data1'));
        }
        // else {
        //     return view('frontend.forms.effectiveness-checkkjkjk', compact('old_record','parent_short_description', 'parent_initiator_id', 'parent_intiation_date', 'parent_division_id', 'parent_record', 'record', 'due_date', 'parent_id', 'parent_type'));
        // }
        if ($request->child_type == "rca") {
            // $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            // $record_number = $record;
            return view('frontend.forms.root-cause-analysis', compact('record', 'due_date', 'parent_id', 'old_record', 'parent_type', 'parent_intiation_date', 'parent_record', 'parent_initiator_id', 'cft'));
        }
        if ($request->child_type == "extension") {
            $parent_name = "CAPA";
            $parent_due_date = "";
            $parent_name = $request->$parent_name;
            if ($request->due_date) {
                $parent_due_date = $request->due_date;
            }

            $record = ((RecordNumber::first()->value('counter')) + 1);
            $record = str_pad($record, 4, '0', STR_PAD_LEFT);
            $record_number = $record;
            $parent_division_id = Capa::where('id',$id)->value('division_id');
            $data = Capa::find($id);
            $extension_record = Helpers::getDivisionName($data->division_id) . '/' . 'CAPA' . '/' . date('Y') . '/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
            $count = Helpers::getChildData($id, $parent_type);
            $countData = $count + 1;
            $relatedRecords = Helpers::getAllRelatedRecords();
            // $data_record = Helpers::getDivisionName($data->division_id ) . '/' . 'LI' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
            return view('frontend.extension.extension_new', compact('parent_id', 'parent_name', 'relatedRecords', 'record_number', 'parent_due_date', 'parent_type', 'extension_record', 'countData','parent_division_id'));
        }
    }

    public function effectiveness_check(Request $request, $id)
    {
        $parent_record = Capa::where('id', $id)->value('record');
        $parent_division_id = Capa::where('id', $id)->value('division_id');
        $parent_type = "CAPA";
        $parent_id = Capa::find($id)->record;
        $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = str_pad($record, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        $record_number = $record;
        return view("frontend.forms.effectiveness-check", compact('due_date', 'record_number','parent_id','parent_type','parent_division_id','parent_record'));
    }


    public static function singleReport($id)
    {
        $data = Capa::find($id);

        if (!empty($data)) {
            $data->Product_Details = CapaGrid::where('capa_id', $id)->where('type', "Product_Details")->first();
            $data->Instruments_Details = CapaGrid::where('capa_id', $id)->where('type', "Instruments_Details")->first();
            $data->Material_Details = CapaGrid::where('capa_id', $id)->where('type', "Material_Details")->first();
            $data->originator = User::where('id', $data->initiator_id)->value('name');

            $capa_teamIdsArray = explode(',', $data->capa_team);
            $capa_teamNames = User::whereIn('id', $capa_teamIdsArray)->pluck('name')->toArray();
            $capa_teamNamesString = implode(', ', $capa_teamNames);




            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.capa.singleReport', compact('data', 'capa_teamNamesString'))
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
            return $pdf->stream('CAPA' . $id . '.pdf');
        }
    }

    public static function auditReport($id)
    {
        $doc = Capa::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $data = CapaAuditTrial::where('capa_id', $id)->get();
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $data = $data->sortBy('created_at');
            $pdf = PDF::loadview('frontend.capa.auditReport', compact('data', 'doc'))
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
            return $pdf->stream('CAPA-Audit' . $id . '.pdf');
        }
    }
}
