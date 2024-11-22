<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\Labincident_Second;
use App\Models\QMSDivision;
use Illuminate\Http\Request;
use App\Models\Capa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\RootCauseAnalysis;
use App\Models\RecordNumber;
use App\Models\LabIncidentAuditTrial;
use App\Models\AuditReviewersDetails;
use App\Models\RoleGroup;
use App\Models\User;
use App\Models\lab_incidents_grid;
// use App\Models\Labincident_Second;
use PDF;
use Helpers;
use Exception;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\OpenStage;
use App\Models\LabIncident;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;



class LabIncidentController extends Controller
{

    public function labincident()
    {
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');

        return view('frontend.forms.lab-incident', compact('due_date', 'record_number'));
    }
    public function create(request $request)
    {
        // analyst_sign_date_gi
        // section_sign_date_gi
        // return $request->all();
        if (!$request->short_desc) {
            toastr()->info("Short Description is required");
            return redirect()->back()->withInput();
        }
        // if (!$request->Initiator_Group) {
        //     toastr()->info("Initiator Group is required");
        //     return redirect()->back()->withInput();
        // }
        // $departments = [
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

        $data = new LabIncident();
        $data->Form_Type = "lab-incident";
        $data->record = ((RecordNumber::first()->value('counter')) + 1);
        $data->record_number = $request->record_number;
        $data->initiator_id = Auth::user()->id;
        $data->division_id = $request->division_id;
        $data->short_desc = $request->short_desc;
        $data->severity_level2= $request->severity_level2;
        $data->intiation_date = $request->intiation_date;
        $initiatorGroupShortForm = $request->Initiator_Group;
        $initiatorGroupFullForm = $departments[$initiatorGroupShortForm] ?? 'Unknown Department';
        $data->Initiator_Group = $initiatorGroupFullForm;
        $data->initiator_group_code= $request->initiator_group_code;
        $data->Other_Ref= $request->Other_Ref;
        $data->due_date = $request->due_date;
        $data->assign_to = $request->assign_to;
        $data->Incident_Category= $request->Incident_Category;
        $data->Invocation_Type = $request->Invocation_Type;
        $data->Incident_Details = $request->Incident_Details;
        $data->Document_Details = $request->Document_Details;
        $data->Instrument_Details = $request->Instrument_Details;
        $data->Involved_Personnel = $request->Involved_Personnel;
        $data->Product_Details = $request->Product_Details;
        $data->Supervisor_Review_Comments = $request->Supervisor_Review_Comments;
        $data->Cancelation_Remarks = $request->Cancelation_Remarks;
        $data->Investigation_Details = $request->Investigation_Details;
        $data->Action_Taken = $request->Action_Taken;
        $data->Root_Cause = $request->Root_Cause;
        $data->Currective_Action = $request->Currective_Action;
        $data->Preventive_Action = $request->Preventive_Action;
        $data->Corrective_Preventive_Action = $request->Corrective_Preventive_Action;
        $data->QA_Review_Comments = $request->QA_Review_Comments;
        $data->QA_Head = $request->QA_Head;
        $data->Effectiveness_Check = $request->Effectiveness_Check;
        $data->effectivess_check_creation_date = $request->effectivess_check_creation_date;
        $data->Incident_Type = $request->Incident_Type;
        $data->Conclusion = $request->Conclusion;
        $data->effect_check_date= $request->effect_check_date;
        $data->occurance_date = $request->occurance_date;
        $data->Incident_Category_others = $request->Incident_Category_others;
        $data->due_date_extension= $request->due_date_extension;

        $data->instrument_involved_SSFI= $request->instrument_involved_SSFI;
       $data->stability_condition_SSFI= $request->stability_condition_SSFI;
        $data->interval_SSFI= $request->interval_SSFI;
        $data->test_SSFI= $request->test_SSFI;
        $data->date_of_analysis_SSFI= $request->date_of_analysis_SSFI;
        $data->specification_number_SSFI= $request->specification_number_SSFI;
        $data->stp_number_SSFI= $request->stp_number_SSFI;
        $data->name_of_analyst_SSFI= $request->name_of_analyst_SSFI;
        $data->date_of_incidence_SSFI= $request->date_of_incidence_SSFI;
        $data->qc_reviewer_SSFI= $request->qc_reviewer_SSFI;
        $data->description_of_incidence_SSFI= $request->description_of_incidence_SSFI;
        $data->proposed_corrective_action_SSFI= $request->proposed_corrective_action_SSFI;
        $data->root_cause_SSFI= $request->root_cause_SSFI;
        $data->incident_summary_SSFI= $request->incident_summary_SSFI;
        $data->investigator_qc_SSFI= $request->investigator_qc_SSFI;
        $data->reviewed_by_qc_SSFI= $request->reviewed_by_qc_SSFI;



        $data->closure_of_incident_closure= $request->closure_of_incident_closure;
        $data->affected_documents_closed_closure= $request->affected_documents_closed_closure;
        $data->qc_head_remark_closure= $request->qc_head_remark_closure;
        $data->qc_head_closure= $request->qc_head_closure;
        $data->qa_head_remark_closure= $request->qa_head_remark_closure;
        $data->name_of_analyst= $request->name_of_analyst;
        $data->investigator_data= $request->investigator_data;
        $data->qc_review_data= $request->qc_review_data;
        $data->other_incidence_data= $request->other_incidence_data;



        $data->status = 'Opened';
        $data->stage = 1;
        $data->incident_involved_others_gi =$request->incident_involved_others_gi;
        $data->description_incidence_gi =$request->description_incidence_gi;
        $data->stage_stage_gi =$request->stage_stage_gi;
        $data->incident_stability_cond_gi =$request->incident_stability_cond_gi;
        $data->incident_interval_others_gi =$request->incident_interval_others_gi;
        $data->test_gi =$request->test_gi;
        $data->date_gi =$request->date_gi;
        $data->incident_date_analysis_gi =$request->incident_date_analysis_gi;
        $data->incident_specification_no_gi =$request->incident_specification_no_gi;
        $data->incident_stp_no_gi =$request->incident_stp_no_gi;
        $data->Incident_name_analyst_no_gi =$request->Incident_name_analyst_no_gi;
        $data->incident_date_incidence_gi =$request->incident_date_incidence_gi;
        $data->analyst_sign_date_gi =$request->analyst_sign_date_gi;
        $data->section_sign_date_gi =$request->section_sign_date_gi;
        $data->immediate_action_ia =$request->immediate_action_ia;
        $data->section_date_ia =$request->section_date_ia;
        $data->details_investigation_ia =$request->details_investigation_ia;
        $data->proposed_correctivei_ia =$request->proposed_correctivei_ia;
        $data->repeat_analysis_plan_ia =$request->repeat_analysis_plan_ia;
        $data->result_of_repeat_analysis_ia =$request->result_of_repeat_analysis_ia;
        $data->corrective_and_preventive_action_ia =$request->corrective_and_preventive_action_ia;
        $data->capa_number_im =$request->capa_number_im;
        $data->investigation_summary_ia =$request->investigation_summary_ia;
        $data->type_incidence_ia =$request->type_incidence_ia;
        $data->reasoon_for_extension_e=$request->reasoon_for_extension_e;
        $data->extension_date_e=$request->extension_date_e;
        $data->extension_date_initiator=$request->extension_date_initiator;
        $data->reasoon_for_extension_esc=$request->reasoon_for_extension_esc;
        $data->extension_date_esc=$request->extension_date_esc;
        $data->extension_date_idsc=$request->extension_date_idsc;
        $data->reasoon_for_extension_tc=$request->reasoon_for_extension_tc;
        $data->extension_date__tc=$request->extension_date__tc;
        $data->extension_date_idtc=$request->extension_date_idtc;
        $data->immediate_date_ia =$request->immediate_date_ia;
        $data->capa_capa =$request->capa_capa;
        $data->investigator_qc = $request->investigator_qc;
        $data->qc_approved_to = $request->qc_approved_to;
        $data->qc_review_to = $request->qc_review_to;
        $data->suit_qc_review_to =$request->suit_qc_review_to;

        $data->QA_initial_Comments =$request->QA_initial_Comments;
        $data->pending_update_Comments =$request->pending_update_Comments;
        $data->QC_head_hod_secondry_Comments =$request->QC_head_hod_secondry_Comments;
        $data->QA_secondry_Comments =$request->QA_secondry_Comments;



        // $data->assign_to_qc_reviewer = $request->assign_to_qc_reviewer;




        if (!empty($request->extension_attachments_e)) {
            $files = [];
            if ($request->hasfile('extension_attachments_e')) {
                foreach ($request->file('extension_attachments_e') as $file) {
                    $name = $request->name . 'extension_attachments_e' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->extension_attachments_e = json_encode($files);
        }
        if (!empty($request->attachments_ia)) {
            $files = [];
            if ($request->hasfile('attachments_ia')) {
                foreach ($request->file('attachments_ia') as $file) {
                    $name = $request->name . 'attachments_ia' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->attachments_ia = json_encode($files);
        }

        if (!empty($request->ccf_attachments)) {
            $files = [];
            if ($request->hasfile('ccf_attachments')) {
                foreach ($request->file('ccf_attachments') as $file) {
                    $name = $request->name . 'ccf_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->ccf_attachments = json_encode($files);
        }

        if (!empty($request->attachments_gi)) {
            $files = [];
            if ($request->hasFile('attachments_gi')) {
                foreach ($request->file('attachments_gi') as $file) {
                    // Generate a unique name for the file
                    $name = $request->name . 'attachments_gi' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Move the file to the upload directory
                    $file->move(public_path('upload/'), $name);

                    // Add the file name to the array
                    $files[] = $name;
                }
            }
            // Encode the file names array to JSON and assign it to the model
            $data->attachments_gi = json_encode($files);
        }


        if (!empty($request->QA_Initial_Attachment)) {
            $files = [];
            if ($request->hasFile('QA_Initial_Attachment')) {
                foreach ($request->file('QA_Initial_Attachment') as $file) {
                    // Generate a unique name for the file
                    $name = $request->name . 'QA_Initial_Attachment' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Move the file to the upload directory
                    $file->move(public_path('upload/'), $name);

                    // Add the file name to the array
                    $files[] = $name;
                }
            }
            // Encode the file names array to JSON and assign it to the model
            $data->QA_Initial_Attachment = json_encode($files);
        }


        if (!empty($request->pending_update_Attachment)) {
            $files = [];
            if ($request->hasFile('pending_update_Attachment')) {
                foreach ($request->file('pending_update_Attachment') as $file) {
                    // Generate a unique name for the file
                    $name = $request->name . 'pending_update_Attachment' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Move the file to the upload directory
                    $file->move(public_path('upload/'), $name);

                    // Add the file name to the array
                    $files[] = $name;
                }
            }
            // Encode the file names array to JSON and assign it to the model
            $data->pending_update_Attachment = json_encode($files);
        }

        if (!empty($request->QC_headhod_secondery_Attachment)) {
            $files = [];
            if ($request->hasFile('QC_headhod_secondery_Attachment')) {
                foreach ($request->file('QC_headhod_secondery_Attachment') as $file) {
                    // Generate a unique name for the file
                    $name = $request->name . 'QC_headhod_secondery_Attachment' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Move the file to the upload directory
                    $file->move(public_path('upload/'), $name);

                    // Add the file name to the array
                    $files[] = $name;
                }
            }
            // Encode the file names array to JSON and assign it to the model
            $data->QC_headhod_secondery_Attachment = json_encode($files);
        }

        if (!empty($request->QA_secondery_Attachment)) {
            $files = [];
            if ($request->hasFile('QA_secondery_Attachment')) {
                foreach ($request->file('QA_secondery_Attachment') as $file) {
                    // Generate a unique name for the file
                    $name = $request->name . 'QA_secondery_Attachment' . uniqid() . '.' . $file->getClientOriginalExtension();

                    // Move the file to the upload directory
                    $file->move(public_path('upload/'), $name);

                    // Add the file name to the array
                    $files[] = $name;
                }
            }
            // Encode the file names array to JSON and assign it to the model
            $data->QA_secondery_Attachment = json_encode($files);
        }


        if (!empty($request->file_attachment_SSFI)) {
            $files = [];
            if ($request->hasfile('file_attachment_SSFI')) {
                foreach ($request->file('file_attachment_SSFI') as $file) {
                    $name = $request->name . 'file_attachment_SSFI' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->file_attachment_SSFI = json_encode($files);
        }

        if (!empty($request->file_attachment_closure)) {
            $files = [];
            if ($request->hasfile('file_attachment_closure')) {
                foreach ($request->file('file_attachment_closure') as $file) {
                    $name = $request->name . 'file_attachment_closure' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->file_attachment_closure = json_encode($files);
        }


        if (!empty($request->Initial_Attachment)) {
            $files = [];
            if ($request->hasfile('Initial_Attachment')) {
                foreach ($request->file('Initial_Attachment') as $file) {
                    $name = $request->name . 'Initial_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->Initial_Attachment = json_encode($files);
        }
        if (!empty($request->Attachments)) {
            $files = [];
            if ($request->hasfile('Attachments')) {
                foreach ($request->file('Attachments') as $file) {
                    $name = $request->name . 'Attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->Attachments = json_encode($files);
        }
        if (!empty($request->Inv_Attachment)) {
            $files = [];
            if ($request->hasfile('Inv_Attachment')) {
                foreach ($request->file('Inv_Attachment') as $file) {
                    $name = $request->name . 'Inv_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->Inv_Attachment = json_encode($files);
        }
        if (!empty($request->CAPA_Attachment)) {
            $files = [];
            if ($request->hasfile('CAPA_Attachment')) {
                foreach ($request->file('CAPA_Attachment') as $file) {
                    $name = $request->name . 'CAPA_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->CAPA_Attachment = json_encode($files);
        }
        if (!empty($request->QA_Head_Attachment)) {
            $files = [];
            if ($request->hasfile('QA_Head_Attachment')) {
                foreach ($request->file('QA_Head_Attachment') as $file) {
                    $name = $request->name . 'QA_Head_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->QA_Head_Attachment = json_encode($files);
        }



         $data->save();


         $newtab=$data->id;
         $labnew = new Labincident_Second();
         $labnew->lab_incident_id = $newtab;
         $labnew->involved_ssfi =$request->involved_ssfi;
         $labnew->stage_stage_ssfi = $request->stage_stage_ssfi;
         $labnew->Incident_stability_cond_ssfi   = $request->Incident_stability_cond_ssfi;
         $labnew->Incident_interval_ssfi  = $request->Incident_interval_ssfi;
         $labnew->Incident_date_analysis_ssfi = $request->Incident_date_analysis_ssfi;
         $labnew->Incident_specification_ssfi = $request->Incident_specification_ssfi;
         if($request->has('Incident_date_incidence_ssfi')&& $request->Incident_date_incidence_ssfi!==null){

             $labnew->Incident_date_incidence_ssfi = $request->Incident_date_incidence_ssfi;
         }
         $labnew->Incident_stp_ssfi = $request->Incident_stp_ssfi;
         $labnew->Description_incidence_ssfi = $request->Description_incidence_ssfi;
         $labnew->Detail_investigation_ssfi = $request->Detail_investigation_ssfi;
         $labnew->proposed_corrective_ssfi = $request->proposed_corrective_ssfi;
         $labnew->root_cause_ssfi = $request->root_cause_ssfi;
         $labnew->incident_summary_ssfi = $request->incident_summary_ssfi;
        //  $data->system_suitable_attachments = $request->system_suitable_attachments;
         $labnew->closure_incident_c = $request->closure_incident_c;
         $labnew->affected_document_closure = $request->affected_document_closure;
         $labnew->qc_hear_remark_c = $request->qc_hear_remark_c;
         $labnew->qa_hear_remark_c = $request->qa_hear_remark_c;
         $labnew->test_ssfi = $request->test_ssfi;
         // $data->closure_attachment_c = $request->closure_attachment_c;



        if (!empty($request->system_suitable_attachments)) {
             $files = [];
             if ($request->hasfile('system_suitable_attachments')) {
                 foreach ($request->file('system_suitable_attachments') as $file) {
                     $name = $request->name . 'system_suitable_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                     $file->move('upload/', $name);
                     $files[] = $name;
                 }
             }
             $labnew->system_suitable_attachments = json_encode($files);
         }

         if (!empty($request->closure_attachment_c)) {
             $files = [];
             if ($request->hasfile('closure_attachment_c')) {
                 foreach ($request->file('closure_attachment_c') as $file) {
                     $name = $request->name . 'closure_attachment_c' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                     $file->move('upload/', $name);
                     $files[] = $name;
                 }
             }
             $labnew->closure_attachment_c = json_encode($files);
         }
         $labnew->save();




            // For "Incident Report"
            $griddata = $data->id;

            if (!empty($request->investrecord)) {
                // Save the new auditor data
                $incidentReport = lab_incidents_grid::where(['labincident_id' => $griddata, 'identifier' => 'incident report'])->firstOrNew();
                $incidentReport->labincident_id = $griddata;
                $incidentReport->identifier = 'Incident Report';
                $incidentReport->data = $request->investrecord;
                $incidentReport->save();


                // Define the mapping of field keys to more descriptive names
                $fieldNames = [
                    'name_of_product' => 'Name of Product',
                    'batch_no' => 'B No./A.R. No.',
                    'remarks' => 'Remarks',

                ];

                // Track audit trail changes (creation of new data)
                if (is_array($request->investrecord)) {
                    foreach ($request->investrecord as $index => $newAuditor) {
                        // Track changes for each field
                        $fieldsToTrack = ['name_of_product', 'batch_no', 'remarks'];
                        foreach ($fieldsToTrack as $field) {
                            $newValue = $newAuditor[$field] ?? 'Null';

                            // Only proceed if there's new data
                            if ($newValue !== 'Null') {
                                // Log the creation of the new data in the audit trail
                                $auditTrail = new LabIncidentAuditTrial;
                                $auditTrail->LabIncident_id = $data->id;
                                $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                                $auditTrail->previous = 'Null'; // Since it's new data, there's no previous value
                                $auditTrail->current = $newValue;
                                $auditTrail->comment = "";
                                $auditTrail->user_id = Auth::user()->id;
                                $auditTrail->user_name = Auth::user()->name;
                                $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $auditTrail->origin_state = $data->status;
                                $auditTrail->change_to = "Not Applicable";
                                $auditTrail->change_from = $data->status;
                                $auditTrail->action_name = 'Create'; // Since this is a create operation
                                $auditTrail->save();
                            }
                        }
                    }
                }
            }




                // For "Sutability" report
            $identifier = 'Sutability';

            $suitabilityReport = lab_incidents_grid::where(['labincident_id' => $griddata, 'identifier' => $identifier])->firstOrNew();
            $suitabilityReport->labincident_id = $griddata;
            $suitabilityReport->identifier = $identifier;
            $suitabilityReport->data = $request->investigation;
            $suitabilityReport->save();




         //=======================================Grid ==============================================//

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();
        $departments = [
            'CQA' => 'Corporate Quality Assurance',
            'QAB' => 'Quality Assurance Biopharma',
            'CQC' => 'Central Quality Control',
            'PSG' => 'Plasma Sourcing Group',
            'CS' => 'Central Stores',
            'ITG' => 'Information Technology Group',
            'MM' => 'Molecular Medicine',
            'CL' => 'Central Laboratory',
            'TT' => 'Tech Team',
            'QA' => 'Quality Assurance',
            'QM' => 'Quality Management',
            'IA' => 'IT Administration',
            'ACC' => 'Accounting',
            'LOG' => 'Logistics',
            'SM' => 'Senior Management',
            'BA' => 'Business Administration',
        ];


        if(!empty($data->short_desc)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Short Description';
            $history->previous = "Null";
            $history->current = $data->short_desc;
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

        if(!empty($data->qc_head_closure)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QC Head Closure';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($data->qc_head_closure);
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

        if(!empty($labnew->qc_hear_remark_c)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $labnew->id;
            $history->activity_type = 'QC Head Remark';
            $history->previous = "Null";
            $history->current = $labnew->qc_hear_remark_c;
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

        if(!empty($data->record)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Record Number';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName(session()->get('division')) . "/LI/" . Helpers::year($data->created_at) . "/" . str_pad($data->record, 4, '0', STR_PAD_LEFT);
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

        if(!empty($data->initiator_id)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Initiator';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($data->initiator_id);
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
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Date Of Initiation';
            $history->previous = "Null";
            $history->current = Carbon::parse($data->intiation_date)->format('d-M-Y');
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

        if(!empty($data->division_id)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Site/Location Code';
            $history->previous = "Null";
            $history->current = Helpers::getDivisionName($data->division_id);
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
        // $initiatorGroup = $data->Initiator_Group;
        // $departmentName = $departments[$initiatorGroup] ?? 'Unknown Department';
        // if (!empty($departmentName)) {
        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $data->id;
        //     $history->activity_type = 'Initiator Group';
        //     $history->previous = "Null";
        //     $history->current = $initiatorGroup;
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
        if (!empty($data->Other_Ref)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Other Ref.Doc.No';
            $history->previous = "Null";
            $history->current = $data->Other_Ref;
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
        if (!empty($data->other_incidence)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Other Incidence';
            $history->previous = "Null";
            $history->current = $data->other_incidence;
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

        if (!empty($data->due_date)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Due Date';
            $history->previous = "Null";
            $history->current = Carbon::parse($data->due_date)->format('d-M-Y');
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->assign_to)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Assigned to';
            $history->previous = "Null";
            $history->current = $data->assign_to;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Incident_Category)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Incident Category';
            $history->previous = "Null";
            $history->current = $data->Incident_Category;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Invocation_Type)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Invocation Type';
            $history->previous = "Null";
            $history->current = $data->Invocation_Type;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->incident_involved_others_gi)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Instrument Involved';
            $history->previous = "Null";
            $history->current = $data->incident_involved_others_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->stage_stage_gi)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Stage';
            $history->previous = "Null";
            $history->current = $data->stage_stage_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->incident_stability_cond_gi)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Stability Condition (If Applicable)';
            $history->previous = "Null";
            $history->current = $data->incident_stability_cond_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

         if (!empty($data->incident_interval_others_gi)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Interval (If Applicable)';
            $history->previous = "Null";
            $history->current = $data->incident_interval_others_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if(!empty($data->test_gi)){
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Test';
            $history->previous = "Not Applicable";
            $history->current =$data->test_gi;
            $history->comment = "Null";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role =RoleGroup::where('id',Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if(!empty($data->incident_date_analysis_gi)){
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Date Of Analysis';
            $history->previous = "Null";
            $history->current = Carbon::parse($data->incident_date_analysis_gi)->format('d-M-Y');
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role =RoleGroup::where('id',Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if(!empty($data->incident_specification_no_gi)){
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Specification Number';
            $history->previous = "Null";
            $history->current =$data->incident_specification_no_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name =Auth::user()->name;
            $history->user_role =RoleGroup::where('id',Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if(!empty($data->incident_stp_no_gi)){
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'STP Number';
            $history->previous = "Null";
            $history->current =$data->incident_stp_no_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name =Auth::user()->name;
            $history->user_role =RoleGroup::where('id',Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        // if(!empty($data->Incident_name_analyst_no_gi)){
        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $data->id;
        //     $history->activity_type = 'Name Of Analyst';
        //     $history->previous = "Null";
        //     $history->current =$data->Incident_name_analyst_no_gi;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name =Auth::user()->name;
        //     $history->user_role =RoleGroup::where('id',Auth::user()->role)->value('name');
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->origin_state = $data->status;
        //     $history->save();
        // }
        if (!empty($data->incident_date_incidence_gi)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Date Of Incidence';
            $history->previous = "Null";
            $history->current = Carbon::parse($data->incident_date_incidence_gi)->format('d-M-Y');
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->description_incidence_gi)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Description Of Incidence';
            $history->previous = "Null";
            $history->current = $data->description_incidence_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->analyst_sign_date_gi)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Reported By';
            $history->previous = "Null";
            $history->current = $data->analyst_sign_date_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->section_sign_date_gi)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Section Head Name';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($data->section_sign_date_gi);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->severity_level2)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Severity Level';
            $history->previous = "Null";
            $history->current = $data->severity_level2;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->Incident_Category_others)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Others';
            $history->previous = "Null";
            $history->current = $data->Incident_Category_others;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->attachments_gi)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Initial Attachment';
            $history->previous = "Null";
            $history->current = $data->attachments_gi;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }



        if (!empty($data->Incident_Details)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Incident Details';
            $history->previous = "Null";
            $history->current = $data->Incident_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Document_Details)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Document Details';
            $history->previous = "Null";
            $history->current = $data->Document_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Instrument_Details)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Instrument Details';
            $history->previous = "Null";
            $history->current = $data->Instrument_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Involved_Personnel)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Involved Personnel';
            $history->previous = "Null";
            $history->current = $data->Involved_Personnel;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Product_Details)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Product Details,If Any';
            $history->previous = "Null";
            $history->current = $data->Product_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Supervisor_Review_Comments)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Supervisor Review Comments';
            $history->previous = "Null";
            $history->current = $data->Supervisor_Review_Comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Cancelation_Remarks)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Cancelation Remarks';
            $history->previous = "Null";
            $history->current = $data->Cancelation_Remarks;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Investigation_Details)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Investigation Details';
            $history->previous = "Null";
            $history->current = $data->Investigation_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Action_Taken)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Action Taken';
            $history->previous = "Null";
            $history->current = $data->Action_Taken;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Root_Cause)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Root Cause';
            $history->previous = "Null";
            $history->current = $data->Root_Cause;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Currective_Action)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Currective Action';
            $history->previous = "Null";
            $history->current = $data->Currective_Action;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Preventive_Action)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Preventive Action';
            $history->previous = "Null";
            $history->current = $data->Preventive_Action;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Corrective_Preventive_Action)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Corrective Preventive Action';
            $history->previous = "Null";
            $history->current = $data->Corrective_Preventive_Action;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        // if (!empty($data->QA_Review_Comments)) {
        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $data->id;
        //     $history->activity_type = 'QC Head Review Comments';
        //     $history->previous = "Null";
        //     $history->current = $data->QA_Review_Comments;
        //     $history->comment = "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->change_to = "Opened";
        //     $history->change_from = "Initiation";
        //     $history->action_name = "Create";
        //     $history->origin_state = $data->status;
        //     $history->save();
        // }

        if (!empty($data->QA_Head)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QA Head/Designee Comments';
            $history->previous = "Null";
            $history->current = $data->QA_Head;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Effectiveness_Check)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Effectiveness Check required?';
            $history->previous = "Null";
            $history->current = $data->Effectiveness_Check;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Incident_Type)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Incident Type';
            $history->previous = "Null";
            $history->current = $data->Incident_Type;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->Conclusion)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Conclusion';
            $history->previous = "Null";
            $history->current = $data->Conclusion;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Initial_Attachment)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Initial Attachment';
            $history->previous = "Null";
            $history->current = $data->Initial_Attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->name_of_analyst)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Name of Analyst';
            $history->previous = "Null";
            $history->current = $data->name_of_analyst;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Attachments)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Attachment';
            $history->previous = "Null";
            $history->current = $data->Attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Inv_Attachment)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Inv Attachment';
            $history->previous = "Null";
            $history->current = $data->Inv_Attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->CAPA_Attachment)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'CAPA Attachment';
            $history->previous = "Null";
            $history->current = $data->CAPA_Attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->QA_initial_Comments)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QA Initial Review Comments';
            $history->previous = "Null";
            $history->current = $data->QA_initial_Comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->QA_Initial_Attachment)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QA Initial Review Attachments';
            $history->previous = "Null";
            $history->current = $data->QA_Initial_Attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->pending_update_Comments)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Pending Initiator Update Comments';
            $history->previous = "Null";
            $history->current = $data->pending_update_Comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->pending_update_Attachment)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Pending Initiator Update Attachment';
            $history->previous = "Null";
            $history->current = $data->pending_update_Attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->QC_head_hod_secondry_Comments)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QC Head/HOD Secondary Review Comments';
            $history->previous = "Null";
            $history->current = $data->QC_head_hod_secondry_Comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->QC_headhod_secondery_Attachment)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QC Head/HOD Secondary Review Attachment';
            $history->previous = "Null";
            $history->current = $data->QC_headhod_secondery_Attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->QA_secondry_Comments)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QA Secondary Review Comment';
            $history->previous = "Null";
            $history->current = $data->QA_secondry_Comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->QA_secondery_Attachment)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QA Secondary Review Attachment';
            $history->previous = "Null";
            $history->current = $data->QA_secondery_Attachment;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->effect_check_date)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QA Head Attachment';
            $history->previous = "Null";
            $history->current = $data->effect_check_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->occurance_date)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QA Head Attachment';
            $history->previous = "Null";
            $history->current = $data->occurance_date;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->immediate_action_ia)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Immediate Action';
            $history->previous = "Null";
            $history->current = $data->immediate_action_ia;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->details_investigation_ia)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Detail Investigation / Probable Root Cause';
            $history->previous = "Null";
            $history->current = $data->details_investigation_ia;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->attachments_ia)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Immidiate Action Attachments';
            $history->previous = "Null";
            $history->current = $data->attachments_ia;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->qc_review_to)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QA Reviewer';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($data->qc_review_to);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->investigator_qc)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QC Head/HOD Person';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($data->investigator_qc);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->type_incidence_ia)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Type of Incidence';
            $history->previous = "Null";
            $history->current = $data->type_incidence_ia;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->investigation_summary_ia)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Investigation Summary';
            $history->previous = "Null";
            $history->current = $data->investigation_summary_ia;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->capa_number_im)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'CAPA Number';
            $history->previous = "Null";
            $history->current = $data->capa_number_im;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->corrective_and_preventive_action_ia)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Corrective and Preventive Action';
            $history->previous = "Null";
            $history->current = $data->corrective_and_preventive_action_ia;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->result_of_repeat_analysis_ia)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Result of Repeat Analysis';
            $history->previous = "Null";
            $history->current = $data->result_of_repeat_analysis_ia;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->repeat_analysis_plan_ia)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Repeat Analysis Plan';
            $history->previous = "Null";
            $history->current = $data->repeat_analysis_plan_ia;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->investigator_data)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QC Investigator';
            $history->previous = "Null";
            $history->current = $data->investigator_data;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->qc_review_data)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QC Review';
            $history->previous = "Null";
            $history->current = Helpers::getInitiatorName($data->qc_review_data);
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }


        if (!empty($data->proposed_correctivei_ia)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Proposed Corrective Action/Corrective Action Taken';
            $history->previous = "Null";
            $history->current = $data->proposed_correctivei_ia;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->Incident_Details)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Incident Details';
            $history->previous = "Null";
            $history->current = $data->Incident_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Document_Details)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Document Details';
            $history->previous = "Null";
            $history->current = $data->Document_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Instrument_Details)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Instrument Details';
            $history->previous = "Null";
            $history->current = $data->Instrument_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Involved_Personnel)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Involved Personnel';
            $history->previous = "Null";
            $history->current = $data->Involved_Personnel;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Product_Details)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Product Details';
            $history->previous = "Null";
            $history->current = $data->Product_Details;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

        if (!empty($data->Supervisor_Review_Comments)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Supervisor Review Comments';
            $history->previous = "Null";
            $history->current = $data->Supervisor_Review_Comments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }
        if (!empty($data->ccf_attachments)) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'CCF Attachments';
            $history->previous = "Null";
            $history->current = $data->ccf_attachments;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Opened";
            $history->change_from = "Initiation";
            $history->action_name = "Create";
            $history->origin_state = $data->status;
            $history->save();
        }

    // others tab audittrail

    if (!empty($data->Inv_Attachment)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Inv_Attachment';
        $history->previous = "Null";
        $history->current = $data->Inv_Attachment;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->Investigation_Details)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Investigation Details';
        $history->previous = "Null";
        $history->current = $data->Investigation_Details;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->Action_Taken)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Action Taken';
        $history->previous = "Null";
        $history->current = $data->Action_Taken;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->Root_Cause)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Root Cause';
        $history->previous = "Null";
        $history->current = $data->Root_Cause;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->capa_capa)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'capa_capa';
        $history->previous = "Null";
        $history->current = $data->capa_capa;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->Currective_Action)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Currective Action';
        $history->previous = "Null";
        $history->current = $data->Currective_Action;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->Preventive_Action)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Preventive_Action';
        $history->previous = "Null";
        $history->current = $data->Preventive_Action;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->Corrective_Preventive_Action)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Corrective Preventive Action';
        $history->previous = "Null";
        $history->current = $data->Corrective_Preventive_Action;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->CAPA_Attachment)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'CAPA Attachment';
        $history->previous = "Null";
        $history->current = $data->CAPA_Attachment;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->QA_Review_Comments)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'QC Head Review Comments';
        $history->previous = "Null";
        $history->current = $data->QA_Review_Comments;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->QA_Head_Attachment)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'QC Head Review Attachment';
        $history->previous = "Null";
        $history->current = $data->QA_Head_Attachment;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->QA_Head)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'QA Head';
        $history->previous = "Null";
        $history->current = $data->QA_Head;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->Incident_Type)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Incident Type';
        $history->previous = "Null";
        $history->current = $data->Incident_Type;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->Conclusion)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Conclusion';
        $history->previous = "Null";
        $history->current = $data->Conclusion;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->due_date_extension)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Due Date Extension Justification';
        $history->previous = "Null";
        $history->current = $data->due_date_extension;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->involved_ssfi)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Instrument Involved';
        $history->previous = "Null";
        $history->current = $data->involved_ssfi;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->stage_stage_ssfi)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Stage';
        $history->previous = "Null";
        $history->current = $data->stage_stage_ssfi;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->Incident_stability_cond_ssfi)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Stability Condition (If Applicable)';
        $history->previous = "Null";
        $history->current = $data->Incident_stability_cond_ssfi;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->Incident_interval_ssfi)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Interval (If Applicable)';
        $history->previous = "Null";
        $history->current = $data->Incident_interval_ssfi;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->test_ssfi)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Test';
        $history->previous = "Null";
        $history->current = $data->test_ssfi;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($labnew->Incident_date_analysis_ssfi)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $labnew->id;
        $history->activity_type = 'Date Of Analysis SSFI';
        $history->previous = "Null";
        $history->current = Carbon::parse($labnew->Incident_date_analysis_ssfi)->format('d-M-Y');
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->Incident_specification_ssfi)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Specification Number';
        $history->previous = "Null";
        $history->current = $data->Incident_specification_ssfi;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->Incident_stp_ssfi)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'STP Number';
        $history->previous = "Null";
        $history->current = $data->Incident_stp_ssfi;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($labnew->Incident_date_incidence_ssfi)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $labnew->id;
        $history->activity_type = 'Date Of Incidence SSFI';
        $history->previous = "Null";
        $history->current = Carbon::parse($labnew->Incident_date_incidence_ssfi)->format('d-M-Y');
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->suit_qc_review_to)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'QC Reviewer';
        $history->previous = "Null";
        $history->current = Helpers::getInitiatorName($data->suit_qc_review_to);
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->Description_incidence_ssfi)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Description Of Incidence';
        $history->previous = "Null";
        $history->current = $data->Description_incidence_ssfi;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }
    if(!empty($labnew->qa_hear_remark_c)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $labnew->id;
        $history->activity_type = 'QA Head Comment';
        $history->previous = "Null";
        $history->current = $labnew->qa_hear_remark_c;
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

    if(!empty($labnew->closure_attachment_c)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $labnew->id;
        $history->activity_type = 'Closure Attachment';
        $history->previous = "Null";
        $history->current = $labnew->closure_attachment_c;
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

    if(!empty($labnew->closure_incident_c)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $labnew->id;
        $history->activity_type = 'Closure Of Incident';
        $history->previous = "Null";
        $history->current = $labnew->closure_incident_c;
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

    if (!empty($data->root_cause_ssfi)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Root Cause';
        $history->previous = "Null";
        $history->current = $data->root_cause_ssfi;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }

    if (!empty($data->incident_summary_ssfi)) {
        $history = new LabIncidentAuditTrial();
        $history->LabIncident_id = $data->id;
        $history->activity_type = 'Incident Summary';
        $history->previous = "Null";
        $history->current = $data->incident_summary_ssfi;
        $history->comment = "Not Applicable";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->change_to = "Opened";
        $history->change_from = "Initiation";
        $history->action_name = "Create";
        $history->origin_state = $data->status;
        $history->save();
    }








        toastr()->success('Record is created Successfully');

        // return redirect('rcms/qms-dashboard');
        return redirect()->to('rcms/qms-dashboard');

    }
    public function updateLabIncident(request $request, $id)
    {
        // return $request;
        // return $request->all();
        // dd($request->all());
        if (!$request->short_desc) {
            toastr()->info("Short Description is required");
            return redirect()->back()->withInput();
        }

        $lastDocument = LabIncident::find($id);
        $data = LabIncident::find($id);
        $lastLabtab = Labincident_Second::where('lab_incident_id', $id)->first();
        $labtab= Labincident_Second::where('lab_incident_id',$id)->first();
        $sectionheadname = User::find($id);
        $data->initiator_id = Auth::user()->id;
        $data->short_desc = $request->short_desc;
        $data->Initiator_Group= $request->Initiator_Group;
        $data->initiator_group_code= $request->initiator_group_code;
        $data->Other_Ref= $request->Other_Ref;
        // $data->due_date = $request->due_date;
        if($request->has('due_date')&& $request->due_date!==null)
        {
            $data->due_date = $request->due_date;
        }

        $data->assign_to = $request->assign_to;
        if($data->stage == 5){
            $data->Incident_Category= $request->Incident_Category;
        }
        $data->suit_qc_review_to = $request->suit_qc_review_to;
        $data->Invocation_Type = $request->Invocation_Type;
        $data->Incident_Details = $request->Incident_Details;
        $data->Document_Details = $request->Document_Details;
        $data->Instrument_Details = $request->Instrument_Details;
        $data->Involved_Personnel = $request->Involved_Personnel;
        $data->Product_Details = $request->Product_Details;
        $data->Supervisor_Review_Comments = $request->Supervisor_Review_Comments;
        $data->Cancelation_Remarks = $request->Cancelation_Remarks;
        $data->Investigation_Details = $request->Investigation_Details;
        $data->Action_Taken = $request->Action_Taken;
        $data->Root_Cause = $request->Root_Cause;
        $data->Currective_Action = $request->Currective_Action;
        $data->Preventive_Action = $request->Preventive_Action;
        $data->Corrective_Preventive_Action = $request->Corrective_Preventive_Action;
        $data->QA_Review_Comments = $request->QA_Review_Comments;
        $data->QA_Head = $request->QA_Head;
        $data->Effectiveness_Check = $request->Effectiveness_Check;
        $data->effectivess_check_creation_date = $request->effectivess_check_creation_date;
        $data->Incident_Type = $request->Incident_Type;
        $data->Conclusion = $request->Conclusion;
        $data->effect_check_date= $request->effect_check_date;
        $data->occurance_date = $request->occurance_date;
        $data->Incident_Category_others = $request->Incident_Category_others;
        $data->due_date_extension= $request->due_date_extension;
        $data->severity_level2= $request->severity_level2;
        $data->capa_capa =$request->capa_capa;
        if($data->stage == 1){
            $data->qc_review_to = $request->qc_review_to;
            $data->investigator_qc = $request->investigator_qc;
        }
        $data->qc_approved_to = $request->qc_approved_to;
        // if($data->stage == 1){
        //     $data->qc_review_to = $request->qc_review_to;
        // }
        $data->qc_head_closure= $request->qc_head_closure;
        $data->other_incidence= $request->other_incidence;

        $data->QA_initial_Comments =$request->QA_initial_Comments;
        $data->pending_update_Comments =$request->pending_update_Comments;
        $data->QC_head_hod_secondry_Comments =$request->QC_head_hod_secondry_Comments;
        $data->QA_secondry_Comments =$request->QA_secondry_Comments;
        $data->name_of_analyst= $request->name_of_analyst;
        $data->investigator_data= $request->investigator_data;
        // $data->qc_review_data= $request->qc_review_data;
        $data->other_incidence_data= $request->other_incidence_data;




        // new added
        $data->incident_involved_others_gi =$request->incident_involved_others_gi;
        $data->description_incidence_gi =$request->description_incidence_gi;
        $data->stage_stage_gi =$request->stage_stage_gi;
        $data->incident_stability_cond_gi =$request->incident_stability_cond_gi;
        $data->incident_interval_others_gi =$request->incident_interval_others_gi;
        $data->test_gi =$request->test_gi;
        $data->date_gi =$request->date_gi;
        // $data->incident_date_analysis_gi =$request->incident_date_analysis_gi;
        if ($request->has('incident_date_analysis_gi') && $request->incident_date_analysis_gi !== null) {
            $data->incident_date_analysis_gi = $request->incident_date_analysis_gi;
        }
        $data->incident_specification_no_gi =$request->incident_specification_no_gi;
        $data->incident_stp_no_gi =$request->incident_stp_no_gi;
        $data->Incident_name_analyst_no_gi =$request->Incident_name_analyst_no_gi;
        if($request->has('incident_date_incidence_gi')&& $request->incident_date_incidence_gi !== null){

            $data->incident_date_incidence_gi =$request->incident_date_incidence_gi;
        }
        $data->analyst_sign_date_gi =$request->analyst_sign_date_gi;

        $data->section_sign_date_gi =$request->section_sign_date_gi;
        $data->immediate_action_ia =$request->immediate_action_ia;
        $data->immediate_date_ia =$request->immediate_date_ia;
        $data->section_date_ia =$request->section_date_ia;
        $data->details_investigation_ia =$request->details_investigation_ia;
        $data->proposed_correctivei_ia =$request->proposed_correctivei_ia;
        $data->repeat_analysis_plan_ia =$request->repeat_analysis_plan_ia;
        $data->result_of_repeat_analysis_ia =$request->result_of_repeat_analysis_ia;
        $data->corrective_and_preventive_action_ia =$request->corrective_and_preventive_action_ia;
        $data->capa_number_im =$request->capa_number_im;
        $data->investigation_summary_ia =$request->investigation_summary_ia;
        if($data->stage == 4){
            $data->type_incidence_ia =$request->type_incidence_ia;
            $data->qc_review_data= $request->qc_review_data;
        }
        // extension
        $data->reasoon_for_extension_e=$request->reasoon_for_extension_e;
        if($request->has('extension_date_e')&& $request->extension_date_e !==null){

            $data->extension_date_e=$request->extension_date_e;
        }
        if($request->has('extension_date_initiator')&& $request->extension_date_initiator !== null){

            $data->extension_date_initiator=$request->extension_date_initiator;
        }
        $data->reasoon_for_extension_esc=$request->reasoon_for_extension_esc;
       if($request->has('extension_date_esc')&& $request->extension_date_esc !== null)
       {
           $data->extension_date_esc=$request->extension_date_esc;

       }

       if($request->has('extension_date_idsc')&& $request->extension_date_idsc!==null){

           $data->extension_date_idsc=$request->extension_date_idsc;
        }
        $data->reasoon_for_extension_tc=$request->reasoon_for_extension_tc;

        if($request->has('extension_date__tc')&& $request->extension_date__tc!==null){

            $data->extension_date__tc=$request->extension_date__tc;
        }
        if($request->has('extension_date_idtc')&& $request->extension_date_idtc!== null){

            $data->extension_date_idtc=$request->extension_date_idtc;
        }


        if (!empty($request->extension_attachments_e)) {
            $files = [];
            if ($request->hasfile('extension_attachments_e')) {
                foreach ($request->file('extension_attachments_e') as $file) {
                    $name = $request->name . 'extension_attachments_e' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->extension_attachments_e = json_encode($files);
        }


// ==========================attachment with remove kp =========================
//   // Initialize attachments as an array
//   $attachments = json_decode($data->attachments_gi, true) ?? [];

//   // Handle file attachments removal
//   if ($request->has('removed_files')) {
//       $removedFiles = json_decode($request->input('removed_files'), true);

//       foreach ($removedFiles as $fileName) {
//           // Remove the file from the server
//           $filePath = public_path('upload/' . $fileName);
//           if (File::exists($filePath)) {
//               File::delete($filePath);
//           }

//           // Remove the file name from the attachments array
//           if (($key = array_search($fileName, $attachments)) !== false) {
//               unset($attachments[$key]);
//           }
//       }
//       // Re-index the array to remove gaps
//       $attachments = array_values($attachments);
//   }

//   // Handle file attachments addition
//   if ($request->hasFile('attachments_gi')) {
//       foreach ($request->file('attachments_gi') as $file) {
//           // Generate a unique name for the file
//           $name = $request->name . 'attachments_gi' . uniqid() . '.' . $file->getClientOriginalExtension();

//           // Move the file to the upload directory
//           $file->move(public_path('upload/'), $name);

//           // Add the file name to the array
//           $attachments[] = $name;
//       }
//   }

//   // Encode the file names array to JSON and assign it to the model
//   $data->attachments_gi = json_encode($attachments);
// ==================================

        // if (!empty($request->attachments_gi)) {
        //     $files = [];
        //     if ($request->hasFile('attachments_gi')) {
        //         foreach ($request->file('attachments_gi') as $file) {
        //             // Generate a unique name for the file
        //             $name = $request->name . 'attachments_gi' . rand(1,100) . '.' . $file->getClientOriginalExtension();

        //             // Move the file to the upload directory
        //             $file->move(public_path('upload/'), $name);

        //             // Add the file name to the array
        //             $files[] = $name;
        //             dd($files);
        //         }
        //     }
        //     // Encode the file names array to JSON and assign it to the model
        //     $data->attachments_gi = json_encode($files);
        // }
                             //first attchment ============================
        if (!empty($request->attachments_gi) || !empty($request->deleted_attachments_gi)) {
            $existingFiles = json_decode($data->attachments_gi, true) ?? [];
                    if (!empty($request->deleted_attachments_gi)) {
                $filesToDelete = explode(',', $request->deleted_attachments_gi);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }
            $newFiles = [];
            if ($request->hasFile('attachments_gi')) {
                foreach ($request->file('attachments_gi') as $file) {
                    $name = $request->name . 'attachments_gi' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $newFiles[] = $name;
                }
            }
            $allFiles = array_merge($existingFiles, $newFiles);
            $data->attachments_gi = json_encode($allFiles);
        }

                                      //secomnnd aatch=========================
        if (!empty($request->attachments_ia) || !empty($request->deleted_attachments_ia)) {
            $existingFiles = json_decode($data->attachments_ia, true) ?? [];
                    if (!empty($request->deleted_attachments_ia)) {
                $filesToDelete = explode(',', $request->deleted_attachments_ia);
                // Filter out the files that are marked for deletion
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }
            $newFiles = [];
            if ($request->hasfile('attachments_ia')) {
                foreach ($request->file('attachments_ia') as $file) {
                    $name = $request->name . 'attachments_ia' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $newFiles[] = $name;
                }
            }
            $allFiles = array_merge($existingFiles, $newFiles);
            $data->attachments_ia = json_encode($allFiles);
        }






        // if (!empty($request->attachments_gi) || !empty($request->deleted_attachments_gi)) {
        //     $existingFiles = json_decode($data->attachments_gi, true) ?? [];
        //             if (!empty($request->deleted_attachments_gi)) {
        //         $filesToDelete = explode(',', $request->deleted_attachments_gi);
        //         $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
        //             return !in_array($file, $filesToDelete);
        //         });
        //     }
        //     $newFiles = [];
        //     if ($request->hasFile('attachments_gi')) {
        //         foreach ($request->file('attachments_gi') as $file) {
        //             $name = $request->name . 'attachments_gi' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move(public_path('upload/'), $name);
        //             $newFiles[] = $name;
        //         }
        //     }
        //     $allFiles = array_merge($existingFiles, $newFiles);
        //     $data->attachments_gi = json_encode($allFiles);
        // }



        if (!empty($request->ccf_attachments)) {
            $files = [];
            if ($request->hasfile('ccf_attachments')) {
                foreach ($request->file('ccf_attachments') as $file) {
                    $name = $request->name . 'ccf_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->ccf_attachments = json_encode($files);
        }


        if (!empty($request->Initial_Attachment)) {
            $files = [];
            if ($request->hasfile('Initial_Attachment')) {
                foreach ($request->file('Initial_Attachment') as $file) {
                    $name = $request->name . 'Initial_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->Initial_Attachment = json_encode($files);
        }
        if (!empty($request->Attachments)) {
            $files = [];
            if ($request->hasfile('Attachments')) {
                foreach ($request->file('Attachments') as $file) {
                    $name = $request->name . 'Attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->Attachments = json_encode($files);
        }

        // ======================================third attachment
        if (!empty($request->Inv_Attachment) || !empty($request->deleted_Inv_Attachment)) {
            $existingFiles = json_decode($data->Inv_Attachment, true) ?? [];
            if (!empty($request->deleted_Inv_Attachment)) {
                $filesToDelete = explode(',', $request->deleted_Inv_Attachment);
                $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                    return !in_array($file, $filesToDelete);
                });
            }
            $newFiles = [];
            if ($request->hasfile('Inv_Attachment')) {
                foreach ($request->file('Inv_Attachment') as $file) {
                    $name = $request->name . 'Inv_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $newFiles[] = $name;
                }
            }
            $allFiles = array_merge($existingFiles, $newFiles);
            $data->Inv_Attachment = json_encode($allFiles);
        }


        if (!empty($request->CAPA_Attachment)) {
            $files = [];
            if ($request->hasfile('CAPA_Attachment')) {
                foreach ($request->file('CAPA_Attachment') as $file) {
                    $name = $request->name . 'CAPA_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->CAPA_Attachment = json_encode($files);
        }

//======================fourth attchm,ent

if (!empty($request->QA_Head_Attachment) || !empty($request->deleted_QA_Head_Attachment)) {
    // Get the existing attachments from the database
    $existingFiles = json_decode($data->QA_Head_Attachment, true) ?? [];

    // Handle file deletions
    if (!empty($request->deleted_QA_Head_Attachment)) {
        $filesToDelete = explode(',', $request->deleted_QA_Head_Attachment);
        // Filter out the files that are marked for deletion
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new file uploads
    $newFiles = [];
    if ($request->hasfile('QA_Head_Attachment')) {
        foreach ($request->file('QA_Head_Attachment') as $file) {
            // Generate a unique name for the file
            $name = $request->name . 'QA_Head_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();

            // Move the file to the upload directory
            $file->move('upload/', $name);

            // Add the new file name to the array
            $newFiles[] = $name;
        }
    }

    // Merge existing files with new files
    $allFiles = array_merge($existingFiles, $newFiles);

    // Encode the merged array to JSON and assign it to the model
    $data->QA_Head_Attachment = json_encode($allFiles);
}
// ==========================================attachment Qa initial
 // QA Initial Review Attachments Handling
 if (!empty($request->QA_Initial_Attachment) || !empty($request->deleted_QA_Initial_Attachment)) {
    $existingFiles = json_decode($data->QA_Initial_Attachment, true) ?? [];

    // Handle deleted attachments
    if (!empty($request->deleted_QA_Initial_Attachment)) {
        $filesToDelete = explode(',', $request->deleted_QA_Initial_Attachment);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    $newFiles = [];

    // Handle new file uploads
    if ($request->hasFile('QA_Initial_Attachment')) {
        foreach ($request->file('QA_Initial_Attachment') as $file) {
            $name = $request->name . 'QA_Initial_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    $allFiles = array_merge($existingFiles, $newFiles);
    $data->QA_Initial_Attachment = json_encode($allFiles);
}
// Save other data as necessary...
$data->QA_initial_Comments = $request->QA_initial_Comments;


    // Pending Initiator Update Attachments Handling
    if (!empty($request->pending_update_Attachment) || !empty($request->deleted_pending_update_Attachment)) {
        $existingFiles = json_decode($data->pending_update_Attachment, true) ?? [];

        // Handle deleted attachments
        if (!empty($request->deleted_pending_update_Attachment)) {
            $filesToDelete = explode(',', $request->deleted_pending_update_Attachment);
            $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
                return !in_array($file, $filesToDelete);
            });
        }

        $newFiles = [];

        // Handle new file uploads
        if ($request->hasFile('pending_update_Attachment')) {
            foreach ($request->file('pending_update_Attachment') as $file) {
                $name = $request->name . 'pending_update_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/'), $name);
                $newFiles[] = $name;
            }
        }

        $allFiles = array_merge($existingFiles, $newFiles);
        $data->pending_update_Attachment = json_encode($allFiles);
    }

    // Save other fields as necessary...
    $data->pending_update_Comments = $request->pending_update_Comments;
// ===================================================attchment QC head hod=============
 // QC Head/HOD Secondary Review Attachments Handling
 if (!empty($request->QC_headhod_secondery_Attachment) || !empty($request->deleted_QC_headhod_secondery_Attachment)) {
    $existingFiles = json_decode($data->QC_headhod_secondery_Attachment, true) ?? [];

    // Handle deleted attachments
    if (!empty($request->deleted_QC_headhod_secondery_Attachment)) {
        $filesToDelete = explode(',', $request->deleted_QC_headhod_secondery_Attachment);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    $newFiles = [];

    // Handle new file uploads
    if ($request->hasFile('QC_headhod_secondery_Attachment')) {
        foreach ($request->file('QC_headhod_secondery_Attachment') as $file) {
            $name = $request->name . 'QC_headhod_secondery_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    $allFiles = array_merge($existingFiles, $newFiles);
    $data->QC_headhod_secondery_Attachment = json_encode($allFiles);
}

// Save other fields as necessary
$data->QC_head_hod_secondry_Comments = $request->QC_head_hod_secondry_Comments;

// ====================================================QA Secondary Review==================

 // QA Secondary Review Attachments Handling
 if (!empty($request->QA_secondery_Attachment) || !empty($request->deleted_QA_secondery_Attachment)) {
    $existingFiles = json_decode($data->QA_secondery_Attachment, true) ?? [];

    // Handle deleted attachments
    if (!empty($request->deleted_QA_secondery_Attachment)) {
        $filesToDelete = explode(',', $request->deleted_QA_secondery_Attachment);
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    $newFiles = [];

    // Handle new file uploads
    if ($request->hasFile('QA_secondery_Attachment')) {
        foreach ($request->file('QA_secondery_Attachment') as $file) {
            $name = $request->name . 'QA_secondery_Attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $name);
            $newFiles[] = $name;
        }
    }

    $allFiles = array_merge($existingFiles, $newFiles);
    $data->QA_secondery_Attachment = json_encode($allFiles);
}

// Save other fields as necessary
$data->QA_secondry_Comments = $request->QA_secondry_Comments;



        if ($lastDocument->incident_interval_others_gi != $data->incident_interval_others_gi ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Interval(If Applicable)';
            $history->previous = $lastDocument->incident_interval_others_gi;
            $history->current = $data->incident_interval_others_gi;
            $history->comment = $request->incident_interval_others_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->incident_interval_others_gi) || $lastDocument->incident_interval_others_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocument->qc_head_closure != $data->qc_head_closure ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QC Head Closure';
            $history->previous = Helpers::getInitiatorName($lastDocument->qc_head_closure);
            $history->current = Helpers::getInitiatorName($data->qc_head_closure);
            $history->comment = $request->qc_head_closure_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->qc_head_closure) || $lastDocument->qc_head_closure === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocument->qa_hear_remark_c != $data->qa_hear_remark_c ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QA Head Remark';
            $history->previous = Helpers::getInitiatorName($lastDocument->qa_hear_remark_c);
            $history->current = Helpers::getInitiatorName($data->qa_hear_remark_c);
            $history->comment = $request->qc_head_closure_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->qa_hear_remark_c) || $lastDocument->qa_hear_remark_c === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocument->closure_attachment_c != $data->closure_attachment_c ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Closure Attachment';
            $history->previous = Helpers::getInitiatorName($lastDocument->closure_attachment_c);
            $history->current = Helpers::getInitiatorName($data->closure_attachment_c);
            $history->comment = $request->qc_head_closure_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->closure_attachment_c) || $lastDocument->closure_attachment_c === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocument->other_incidence != $data->other_incidence ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Other Incidence';
            $history->previous = $lastDocument->other_incidence;
            $history->current = $data->other_incidence;
            $history->comment = $request->other_incidence_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->other_incidence) || $lastDocument->other_incidence === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocument->test_gi != $data->test_gi ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Test';
            $history->previous = $lastDocument->test_gi;
            $history->current = $data->test_gi;
            $history->comment = $request->test_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->test_gi) || $lastDocument->test_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

if ($lastDocument->incident_date_analysis_gi !== $data->incident_date_analysis_gi) {

    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $data->id;
    $history->activity_type = 'Date Of Analysis';
    $history->previous = $lastDocument->incident_date_analysis_gi;
    $history->current = Helpers::getdateFormat($data->incident_date_analysis_gi);
    $history->comment = Helpers::getdateFormat($request->incident_date_analysis_gi_comment);
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->origin_state = $lastDocument->status;
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->incident_date_analysis_gi) || $lastDocument->incident_date_analysis_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->save();
}

        if ($lastDocument->incident_specification_no_gi != $data->incident_specification_no_gi ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Specification Number';
            $history->previous = $lastDocument->incident_specification_no_gi;
            $history->current = $data->incident_specification_no_gi;
            $history->comment = $request->incident_specification_no_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->incident_specification_no_gi) || $lastDocument->incident_specification_no_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastDocument->incident_stp_no_gi != $data->incident_stp_no_gi ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'STP Number';
            $history->previous = $lastDocument->incident_stp_no_gi;
            $history->current = $data->incident_stp_no_gi;
            $history->comment = $request->incident_stp_no_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->incident_stp_no_gi) || $lastDocument->incident_stp_no_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }
        // if ($lastDocument->Incident_name_analyst_no_gi != $data->Incident_name_analyst_no_gi ) {
        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $data->id;
        //     $history->activity_type = 'Name Of Analyst';
        //     $history->previous = $lastDocument->Incident_name_analyst_no_gi;
        //     $history->current = $data->Incident_name_analyst_no_gi;
        //     $history->comment = $request->Incident_name_analyst_no_gi_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastDocument->Incident_name_analyst_no_gi) || $lastDocument->Incident_name_analyst_no_gi === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();

        // }
        if ($lastDocument->incident_date_incidence_gi != $data->incident_date_incidence_gi ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Date Of Incidence';
            $history->previous = Helpers::getdateFormat($lastDocument->incident_date_incidence_gi);
            $history->current = Helpers::getdateFormat($data->incident_date_incidence_gi);
            $history->comment = $request->incident_date_incidence_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->incident_date_incidence_gi) || $lastDocument->incident_date_incidence_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->name_of_analyst != $data->name_of_analyst ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Name of Analyst';
            $history->previous = $lastDocument->name_of_analyst;
            $history->current = $data->name_of_analyst;
            $history->comment = $request->incident_date_incidence_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->name_of_analyst) || $lastDocument->name_of_analyst === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->investigator_data != $data->investigator_data ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QC Investigator';
            $history->previous = $lastDocument->investigator_data;
            $history->current = $data->investigator_data;
            $history->comment = $request->incident_date_incidence_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->investigator_data) || $lastDocument->investigator_data === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }


        if ($lastDocument->qc_review_data != $data->qc_review_data ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'QC Review';
            $history->previous = Helpers::getInitiatorName($lastDocument->qc_review_data);
            $history->current = Helpers::getInitiatorName($data->qc_review_data);
            $history->comment = $request->incident_date_incidence_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->qc_review_data) || $lastDocument->qc_review_data === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->other_incidence_data != $data->other_incidence_data ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Other Incident Category';
            $history->previous = $lastDocument->other_incidence_data;
            $history->current = $data->other_incidence_data;
            $history->comment = $request->incident_date_incidence_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->other_incidence_data) || $lastDocument->other_incidence_data === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->description_incidence_gi != $data->description_incidence_gi ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Description Of Incidence';
            $history->previous = $lastDocument->description_incidence_gi;
            $history->current = $data->description_incidence_gi;
            $history->comment = $request->description_incidence_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->description_incidence_gi) || $lastDocument->description_incidence_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }


        // $previousAnalystName = User::find($lastDocument->analyst_sign_date_gi);
        // $currentAnalystName = User::find($data['analyst_sign_date_gi']);

        // if ($lastDocument->analyst_sign_date_gi != $data['analyst_sign_date_gi']||$lastDocument->analyst_sign_date_gi != $data['analyst_sign_date_gi']){
        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $data['id'];
        //     $history->activity_type = 'Reported By';
        //     $history->previous = $previousAnalystName ? $previousAnalystName->name : 'Unknown';
        //     $history->current = $currentAnalystName ? $currentAnalystName->name : 'Unknown';
        //     $history->comment = $request->analyst_sign_date_gi_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastDocument->analyst_sign_date_gi) || $lastDocument->analyst_sign_date_gi === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();

        // }

        if ($lastDocument->analyst_sign_date_gi != $data->analyst_sign_date_gi ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Reported By';
            $history->previous = $lastDocument->analyst_sign_date_gi;
            $history->current = $data->analyst_sign_date_gi;
            $history->comment = $request->description_incidence_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->analyst_sign_date_gi) || $lastDocument->analyst_sign_date_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        $previousSectionName = User::find($lastDocument->section_sign_date_gi);
        $currentSectionName = User::find($data['section_sign_date_gi']);

        if ($lastDocument->section_sign_date_gi != $data['section_sign_date_gi']||$lastDocument->section_sign_date_gi != $data['section_sign_date_gi']){
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data['id'];
            $history->activity_type = 'Section Head Name';
            $history->previous = $previousSectionName ? $previousSectionName->name : 'Unknown';
            $history->current = $currentSectionName ? $currentSectionName->name : 'Unknown';
            $history->comment = $request->section_sign_date_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->section_sign_date_gi) || $lastDocument->section_sign_date_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }
        $previousSectionHeadName = User::find($lastDocument->section_sign_date_gi);
        $currentSectionHeadName = User::find($data['section_sign_date_gi']);

        if ($request->input('section_sign_date_gi_changed') == '1' && $lastDocument->section_sign_date_gi != $data['section_sign_date_gi']) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data['id'];
            $history->activity_type = 'Section Head Name';
            $history->previous = $previousSectionHeadName ? $previousSectionHeadName->name : 'Not Applicable';
            $history->current = $currentSectionHeadName ? $currentSectionHeadName->name : 'Not Applicable';
            $history->comment = $request->section_sign_date_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->section_sign_date_gi_changed) || $lastDocument->section_sign_date_gi_changed === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->severity_level2 != $data->severity_level2 ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Severity Level';
            $history->previous = $lastDocument->severity_level2;
            $history->current = $data->severity_level2;
            $history->comment = $request->severity_level2_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->severity_level2) || $lastDocument->severity_level2 === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Incident_Category_others != $data->Incident_Category_others ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Others';
            $history->previous = $lastDocument->Incident_Category_others;
            $history->current = $data->Incident_Category_others;
            $history->comment = $request->Incident_Category_others_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Incident_Category_others) || $lastDocument->Incident_Category_others === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->attachments_gi != $data->attachments_gi ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Initial Attachment';
            $history->previous = $lastDocument->attachments_gi;
            $history->current = $data->attachments_gi;
            $history->comment = $request->attachments_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->attachments_gi) || $lastDocument->attachments_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }






        $data->update();





        //====================================================suitability/closure====================================================================================================//
        // $labnew = Labincident_Second::find($id);
        // $updatetab=$data->id;
        $labtab = Labincident_Second::where('id', $id)->firstOrCreate();
        $lastlabtab = Labincident_Second::where('id', $id)->firstOrCreate();

        // $labtab->lab_incident_id = $updatetab;
        $labtab->involved_ssfi =$request->involved_ssfi;
        $labtab->stage_stage_ssfi = $request->stage_stage_ssfi;
        $labtab->Incident_stability_cond_ssfi   = $request->Incident_stability_cond_ssfi;
        $labtab->Incident_interval_ssfi  = $request->Incident_interval_ssfi;
        if($request->has('Incident_date_analysis_ssfi')&& $request->Incident_date_analysis_ssfi!==null){

            $labtab->Incident_date_analysis_ssfi = $request->Incident_date_analysis_ssfi;
        }
        $labtab->Incident_specification_ssfi = $request->Incident_specification_ssfi;

        if($request->has('Incident_date_incidence_ssfi')&& $request->Incident_date_incidence_ssfi==!null){

           $labtab->Incident_date_incidence_ssfi = $request->Incident_date_incidence_ssfi;
       }
        $labtab->Incident_stp_ssfi = $request->Incident_stp_ssfi;
        $labtab->Description_incidence_ssfi = $request->Description_incidence_ssfi;
        $labtab->Detail_investigation_ssfi = $request->Detail_investigation_ssfi;
        $labtab->proposed_corrective_ssfi = $request->proposed_corrective_ssfi;
        $labtab->root_cause_ssfi = $request->root_cause_ssfi;
        $labtab->incident_summary_ssfi = $request->incident_summary_ssfi;
        // $data->system_suitable_attachments = $request->system_suitable_attachments;
        $labtab->closure_incident_c = $request->closure_incident_c;
        $labtab->affected_document_closure = $request->affected_document_closure;
        $labtab->qc_hear_remark_c = $request->qc_hear_remark_c;
        $labtab->qa_hear_remark_c = $request->qa_hear_remark_c;
        $labtab->test_ssfi = $request->test_ssfi;



        // ======================five attchemnt

if (!empty($request->system_suitable_attachments) || !empty($request->deleted_system_suitable_attachments)) {
    // Get the existing attachments from the database
    $existingFiles = json_decode($labtab->system_suitable_attachments, true) ?? [];

    // Handle file deletions
    if (!empty($request->deleted_system_suitable_attachments)) {
        $filesToDelete = explode(',', $request->deleted_system_suitable_attachments);
        // Filter out the files that are marked for deletion
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new file uploads
    $newFiles = [];
    if ($request->hasfile('system_suitable_attachments')) {
        foreach ($request->file('system_suitable_attachments') as $file) {
            // Generate a unique name for the file
            $name = $request->name . 'system_suitable_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();

            // Move the file to the upload directory
            $file->move('upload/', $name);

            // Add the new file name to the array
            $newFiles[] = $name;
        }
    }

    // Merge existing files with new files
    $allFiles = array_merge($existingFiles, $newFiles);

    // Encode the merged array to JSON and assign it to the model
    $labtab->system_suitable_attachments = json_encode($allFiles);
}


if (!empty($request->closure_attachment_c) || !empty($request->deleted_closure_attachment_c)) {
    // Get the existing attachments from the database
    $existingFiles = json_decode($labtab->closure_attachment_c, true) ?? [];

    // Handle file deletions
    if (!empty($request->deleted_closure_attachment_c)) {
        $filesToDelete = explode(',', $request->deleted_closure_attachment_c);
        // Filter out the files that are marked for deletion
        $existingFiles = array_filter($existingFiles, function($file) use ($filesToDelete) {
            return !in_array($file, $filesToDelete);
        });
    }

    // Handle new file uploads
    $newFiles = [];
    if ($request->hasfile('closure_attachment_c')) {
        foreach ($request->file('closure_attachment_c') as $file) {
            // Generate a unique name for the file
            $name = $request->name . 'closure_attachment_c' . rand(1, 100) . '.' . $file->getClientOriginalExtension();

            // Move the file to the upload directory
            $file->move('upload/', $name);

            // Add the new file name to the array
            $newFiles[] = $name;
        }
    }

    // Merge existing files with new files
    $allFiles = array_merge($existingFiles, $newFiles);

    // Encode the merged array to JSON and assign it to the model
    $labtab->closure_attachment_c = json_encode($allFiles);
}


        $labtab->save();

        // if (isset($data) && isset($request)) {
        //             // For "Sutability" report
        //             if (isset($data->id) && isset($request->investigation)){
        //             $griddata = $data->id;
        //             $identifier = 'Sutability';

        //             $suitabilityReport = lab_incidents_grid::where(['labincident_id' => $griddata, 'identifier' => $identifier])->firstOrNew();
        //             $suitabilityReport->labincident_id = $griddata;
        //             $suitabilityReport->identifier = $identifier;
        //             $suitabilityReport->data = $request->investigation;
        //             $suitabilityReport->update();
        //             }
        //             else{
        //                 throw new Exception('Required data or request object is not set.');
        //             }

        //             if (isset($data->id) && isset($request->investrecord)) {
        //             // For "Incident Report"
        //             $incidentReport = lab_incidents_grid::where(['labincident_id' => $griddata, 'identifier' => 'incident report'])->firstOrNew();
        //             $incidentReport->labincident_id = $griddata;
        //             $incidentReport->identifier = 'incident report';
        //             $incidentReport->data = $request->investrecord;
        //             $incidentReport->update();
        //             // dd($incidentReport);
        //         }
        //      } else {
        //             throw new Exception('Required data or request object is not set.');
        //         }



        if ($lastDocument->short_desc != $data->short_desc ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastDocument->short_desc;
            $history->current = $data->short_desc;
            $history->comment = $request->short_desc_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->short_desc) || $lastDocument->short_desc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }

        if ($lastlabtab->qc_hear_remark_c != $labtab->qc_hear_remark_c ) {
            dd($lastlabtab->qc_hear_remark_c);

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'QC Head Remark';
            $history->previous = $lastlabtab->qc_hear_remark_c;
            $history->current = $labtab->qc_hear_remark_c;
            $history->comment = $request->qc_hear_remark_comments;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($labtab->qc_hear_remark_c) || $labtab->qc_hear_remark_c === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }



        $department = [
            'CQA' => 'Corporate Quality Assurance',
            'QAB' => 'Quality Assurance Biopharma',
            'CQC' => 'Central Quality Control',
            'PSG' => 'Plasma Sourcing Group',
            'CS' => 'Central Stores',
            'ITG' => 'Information Technology Group',
            'MM' => 'Molecular Medicine',
            'CL' => 'Central Laboratory',
            'TT' => 'Tech Team',
            'QA' => 'Quality Assurance',
            'QM' => 'Quality Management',
            'IA' => 'IT Administration',
            'ACC' => 'Accounting',
            'LOG' => 'Logistics',
            'SM' => 'Senior Management',
            'BA' => 'Business Administration',
        ];

        // $lastInitiatorGroupFullForm = isset($department[$lastDocument->Initiator_Group]) ? $department[$lastDocument->Initiator_Group] : $lastDocument->Initiator_Group;
        // $currentInitiatorGroupFullForm = isset($department[$data->Initiator_Group]) ? $department[$data->Initiator_Group] : $data->Initiator_Group;

        // if ($lastInitiatorGroupFullForm != $currentInitiatorGroupFullForm) {
        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $id;
        //     $history->activity_type = 'Initiator Group';
        //     $history->previous = $lastInitiatorGroupFullForm;
        //     $history->current = $currentInitiatorGroupFullForm;
        //     $history->comment = $request->Initiator_Group_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastDocument->Initiator_Group) || $lastDocument->Initiator_Group === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();

        // }

        if ($lastDocument->Other_Ref != $data->Other_Ref ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Other Ref.Doc.No';
            $history->previous = $lastDocument->Other_Ref;
            $history->current = $data->Other_Ref;
            $history->comment = $request->Other_Ref_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Other_Ref) || $lastDocument->Other_Ref === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->due_date != $data->due_date ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Due Date';
            $history->previous = Helpers::getdateFormat($lastDocument->due_date);
            $history->current = Helpers::getdateFormat($data->due_date);
            $history->comment = $request->due_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->due_date) || $lastDocument->due_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        $previousAssignedToName = User::find($lastDocument->assign_to);
        $currentAssignedToName = User::find($data['assign_to']);

        if ($lastDocument->assign_to != $data['assign_to']) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Assigned to';
            $history->previous = $previousAssignedToName ? $previousAssignedToName->name : 'Unknown';
            $history->current = $currentAssignedToName ? $currentAssignedToName->name : 'Unknown';
            $history->comment = $request->assign_to_comment;
            $history->user_id = Auth::user()->id;
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->assign_to) || $lastDocument->assign_to === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;

            $history->save();
        }

        if ($lastDocument->Incident_Category != $data->Incident_Category ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Incident Category';
            $history->previous = $lastDocument->Incident_Category;
            $history->current = $data->Incident_Category;
            $history->comment = $request->Incident_Category_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Incident_Category) || $lastDocument->Incident_Category === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Invocation_Type != $data->Invocation_Type ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Invocation Type';
            $history->previous = $lastDocument->Invocation_Type;
            $history->current = $data->Invocation_Type;
            $history->comment = $request->Invocation_Type_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Invocation_Type) || $lastDocument->Invocation_Type === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->incident_involved_others_gi != $data->incident_involved_others_gi ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Instrument Involved';
            $history->previous = $lastDocument->incident_involved_others_gi;
            $history->current = $data->incident_involved_others_gi;
            $history->comment = $request->incident_involved_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->incident_involved_others_gi) || $lastDocument->incident_involved_others_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->stage_stage_gi != $data->stage_stage_gi ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Stage';
            $history->previous = $lastDocument->stage_stage_gi;
            $history->current = $data->stage_stage_gi;
            $history->comment = $request->stage_stage_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->stage_stage_gi) || $lastDocument->stage_stage_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->incident_stability_cond_gi != $data->incident_stability_cond_gi ) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $data->id;
            $history->activity_type = 'Stability Condition (If Applicable)';
            $history->previous = $lastDocument->incident_stability_cond_gi;
            $history->current = $data->incident_stability_cond_gi;
            $history->comment = $request->incident_stability_cond_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->incident_stability_cond_gi) || $lastDocument->incident_stability_cond_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Incident_Details != $data->Incident_Details ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Incident Details';
            $history->previous = $lastDocument->Incident_Details;
            $history->current = $data->Incident_Details;
            $history->comment = $request->Incident_Details_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Incident_Details) || $lastDocument->Incident_Details === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }
        if ($lastDocument->Document_Details != $data->Document_Details ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Document Details';
            $history->previous = $lastDocument->Document_Details;
            $history->current = $data->Document_Details;
            $history->comment = $request->Document_Details_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Document_Details) || $lastDocument->Document_Details === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->attachments_ia != $data->attachments_ia ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Immidiate Action Attachments';
            $history->previous = $lastDocument->attachments_ia;
            $history->current = $data->attachments_ia;
            $history->comment = $request->attachments_ia_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->attachments_ia) || $lastDocument->attachments_ia === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->Instrument_Details != $data->Instrument_Details ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Instrument Details';
            $history->previous = $lastDocument->Instrument_Details;
            $history->current = $data->Instrument_Details;
            $history->comment = $request->Instrument_Details_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Instrument_Details) || $lastDocument->Instrument_Details === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Involved_Personnel != $data->Involved_Personnel ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Involved Personnel';
            $history->previous = $lastDocument->Involved_Personnel;
            $history->current = $data->Involved_Personnel;
            $history->comment = $request->Involved_Personnel_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Involved_Personnel) || $lastDocument->Involved_Personnel === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Product_Details != $data->Product_Details) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Product Details,If Any';
            $history->previous = $lastDocument->Product_Details;
            $history->current = $data->Product_Details;
            $history->comment = $request->Product_Details_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Product_Details) || $lastDocument->Product_Details === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Supervisor_Review_Comments != $data->Supervisor_Review_Comments ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Supervisor Review Comments';
            $history->previous = $lastDocument->Supervisor_Review_Comments;
            $history->current = $data->Supervisor_Review_Comments;
            $history->comment = $request->Supervisor_Review_Comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Supervisor_Review_Comments) || $lastDocument->Supervisor_Review_Comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Cancelation_Remarks != $data->Cancelation_Remarks ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Cancelation Remarks';
            $history->previous = $lastDocument->Cancelation_Remarks;
            $history->current = $data->Cancelation_Remarks;
            $history->comment = $request->Cancelation_Remarks_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Cancelation_Remarks) || $lastDocument->Cancelation_Remarks === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        // if ($lastDocument->Investigation_Details != $data->Investigation_Details ) {

        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $id;
        //     $history->activity_type = 'Investigation Details';
        //     $history->previous = $lastDocument->Investigation_Details;
        //     $history->current = $data->Investigation_Details;
        //     $history->comment = $request->Investigation_Details_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastDocument->Investigation_Details) || $lastDocument->Investigation_Details === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }
        if ($lastDocument->Action_Taken != $data->Action_Taken ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Action Taken';
            $history->previous = $lastDocument->Action_Taken;
            $history->current = $data->Action_Taken;
            $history->comment = $request->Action_Taken_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Action_Taken) || $lastDocument->Action_Taken === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Root_Cause != $data->Root_Cause ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Root Cause';
            $history->previous = $lastDocument->Root_Cause;
            $history->current = $data->Root_Cause;
            $history->comment = $request->Root_Cause_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Root_Cause) || $lastDocument->Root_Cause === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->Preventive_Action != $data->Preventive_Action ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Preventive Action';
            $history->previous = $lastDocument->Preventive_Action;
            $history->current = $data->Preventive_Action;
            $history->comment = $request->Preventive_Action_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Preventive_Action) || $lastDocument->Preventive_Action === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->Corrective_Preventive_Action != $data->Corrective_Preventive_Action) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Corrective Preventive Action';
            $history->previous = $lastDocument->Corrective_Preventive_Action;
            $history->current = $data->Corrective_Preventive_Action;
            $history->comment = $request->Corrective_Preventive_Action_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Corrective_Preventive_Action) || $lastDocument->Corrective_Preventive_Action === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        // if ($lastDocument->QA_Review_Comments != $data->QA_Review_Comments) {

        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $id;
        //     $history->activity_type = 'QC Head Review Comments';
        //     $history->previous = $lastDocument->QA_Review_Comments;
        //     $history->current = $data->QA_Review_Comments;
        //     $history->comment = $request->QA_Review_Comments_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastDocument->QA_Review_Comments) || $lastDocument->QA_Review_Comments === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        // if ($lastDocument->QA_Head_Attachment != $data->QA_Head_Attachment) {

        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $id;
        //     $history->activity_type = 'QA Review Attachment';
        //     $history->previous = $lastDocument->QA_Head_Attachment;
        //     $history->current = $data->QA_Head_Attachment;
        //     $history->comment = $request->QA_Review_Comments_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastDocument->QA_Head_Attachment) || $lastDocument->QA_Head_Attachment === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->save();
        // }

        if ($lastDocument->QA_initial_Comments != $data->QA_initial_Comments) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'QA Initial Review Comments';
            $history->previous = $lastDocument->QA_initial_Comments;
            $history->current = $data->QA_initial_Comments;
            $history->comment = $request->QA_Review_Comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->QA_initial_Comments) || $lastDocument->QA_initial_Comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

         if ($lastDocument->QA_Initial_Attachment != $data->QA_Initial_Attachment) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'QA Initial Review Attachments';
            $history->previous = $lastDocument->QA_Initial_Attachment;
            $history->current = $data->QA_Initial_Attachment;
            $history->comment = $request->QA_Review_Comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->QA_Initial_Attachment) || $lastDocument->QA_Initial_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->pending_update_Comments != $data->pending_update_Comments) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Pending Initiator Update Comments';
            $history->previous = $lastDocument->pending_update_Comments;
            $history->current = $data->pending_update_Comments;
            $history->comment = $request->QA_Review_Comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->pending_update_Comments) || $lastDocument->pending_update_Comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->pending_update_Attachment != $data->pending_update_Attachment) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Pending Initiator Update Attachment';
            $history->previous = $lastDocument->pending_update_Attachment;
            $history->current = $data->pending_update_Attachment;
            $history->comment = $request->QA_Review_Comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->pending_update_Attachment) || $lastDocument->pending_update_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->QC_head_hod_secondry_Comments != $data->QC_head_hod_secondry_Comments) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'QC Head/HOD Secondary Review Comments';
            $history->previous = $lastDocument->QC_head_hod_secondry_Comments;
            $history->current = $data->QC_head_hod_secondry_Comments;
            $history->comment = $request->QA_Review_Comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->QC_head_hod_secondry_Comments) || $lastDocument->QC_head_hod_secondry_Comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->QC_headhod_secondery_Attachment != $data->QC_headhod_secondery_Attachment) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'QC Head/HOD Secondary Review Attachment';
            $history->previous = $lastDocument->QC_headhod_secondery_Attachment;
            $history->current = $data->QC_headhod_secondery_Attachment;
            $history->comment = $request->QA_Review_Comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->QC_headhod_secondery_Attachment) || $lastDocument->QC_headhod_secondery_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->QA_secondry_Comments != $data->QA_secondry_Comments) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'QA Secondary Review Comments';
            $history->previous = $lastDocument->QA_secondry_Comments;
            $history->current = $data->QA_secondry_Comments;
            $history->comment = $request->QA_Review_Comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->QA_secondry_Comments) || $lastDocument->QA_secondry_Comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }

        if ($lastDocument->QA_secondery_Attachment != $data->QA_secondery_Attachment) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'QA Secondary Review Attachments';
            $history->previous = $lastDocument->QA_secondery_Attachment;
            $history->current = $data->QA_secondery_Attachment;
            $history->comment = $request->QA_Review_Comments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->QA_secondery_Attachment) || $lastDocument->QA_secondery_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }




        if ($lastDocument->QA_Head != $data->QA_Head ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'QA Head/Designee Comments';
            $history->previous = $lastDocument->QA_Head;
            $history->current = $data->QA_Head;
            $history->comment = $request->QA_Head_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->QA_Head) || $lastDocument->QA_Head === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->save();
        }
        if ($lastDocument->Effectiveness_Check != $data->Effectiveness_Check ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Effectiveness Check required?';
            $history->previous = $lastDocument->Effectiveness_Check;
            $history->current = $data->Effectiveness_Check;
            $history->comment = $request->Effectiveness_Check_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Effectiveness_Check) || $lastDocument->Effectiveness_Check === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();

        }
        if ($lastDocument->Incident_Type != $data->Incident_Type ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Incident Type';
            $history->previous = $lastDocument->Incident_Type;
            $history->current = $data->Incident_Type;
            $history->comment = $request->Incident_Type_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Incident_Type) || $lastDocument->Incident_Type === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
          ;
            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Conclusion != $data->Conclusion ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Conclusion';
            $history->previous = $lastDocument->Conclusion;
            $history->current = $data->Conclusion;
            $history->comment = $request->Conclusion_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Conclusion) || $lastDocument->Conclusion === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Initial_Attachment != $data->Initial_Attachment ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Initial Attachment';
            $history->previous = $lastDocument->Initial_Attachment;
            $history->current = $data->Initial_Attachment;
            $history->comment = $request->Initial_Attachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Initial_Attachment) || $lastDocument->Initial_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Attachments != $data->Attachments ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Attachment';
            $history->previous = $lastDocument->Attachments;
            $history->current = $data->Attachments;
            $history->comment = $request->Attachments_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Attachments) || $lastDocument->Attachments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->Inv_Attachment != $data->Inv_Attachment ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Inv Attachment';
            $history->previous = $lastDocument->Inv_Attachment;
            $history->current = $data->Inv_Attachment;
            $history->comment = $request->Inv_Attachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Inv_Attachment) || $lastDocument->Inv_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->CAPA_Attachment != $data->CAPA_Attachment ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'CAPA Attachment';
            $history->previous = $lastDocument->CAPA_Attachment;
            $history->current = $data->CAPA_Attachment;
            $history->comment = $request->CAPA_Attachment_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->CAPA_Attachment) || $lastDocument->CAPA_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        // if ($lastDocument->QA_Head_Attachment != $data->QA_Head_Attachment ) {

        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $id;
        //     $history->activity_type = 'QA Head Attachment';
        //     $history->previous = $lastDocument->QA_Head_Attachment;
        //     $history->current = $data->QA_Head_Attachment;
        //     $history->comment = $request->QA_Head_Attachment_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastDocument->QA_Head_Attachment) || $lastDocument->QA_Head_Attachment === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }
        if ($lastDocument->effect_check_date != $data->effect_check_date ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Effect Check Date';
            $history->previous = $lastDocument->effect_check_date;
            $history->current = $data->effect_check_date;
            $history->comment = $request->effect_check_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->effect_check_date) || $lastDocument->effect_check_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        if ($lastDocument->occurance_date != $data->occurance_date ) {

            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'QA Head Attachment';
            $history->previous = $lastDocument->occurance_date;
            $history->current = $data->occurance_date;
            $history->comment = $request->occurance_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->occurance_date) || $lastDocument->occurance_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        // audit trail other page tab

        if ($lastDocument->Inv_Attachment != $data->Inv_Attachment) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Inv Attachment';
            $history->previous = $lastDocument->Inv_Attachment;
            $history->current = $data->Inv_Attachment;
            $history->comment = $request->Inv_Attachment_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Inv_Attachment) || $lastDocument->Inv_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

        }

        if ($lastDocument->immediate_action_ia != $data->immediate_action_ia) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Immediate Action';
            $history->previous = $lastDocument->immediate_action_ia;
            $history->current = $data->immediate_action_ia;
            $history->comment = $request->Inv_Attachment_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->immediate_action_ia) || $lastDocument->immediate_action_ia === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

        $history->origin_state = $lastDocument->status;
        $history->save();
    }

            if ($lastDocument->details_investigation_ia != $data->details_investigation_ia) {
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                $history->activity_type = 'Detail Investigation / Probable Root Cause';
                $history->previous = $lastDocument->details_investigation_ia;
                $history->current = $data->details_investigation_ia;
                $history->comment = $request->Inv_Attachment_comment ?? "Not Applicable";
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "Not Applicable";
                $history->change_from = $lastDocument->status;
                if (is_null($lastDocument->details_investigation_ia) || $lastDocument->details_investigation_ia === '') {
                    $history->action_name = "New";
                } else {
                    $history->action_name = "Update";
                }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }


        if ($lastDocument->Investigation_Details != $data->Investigation_Details) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Investigation Details';
            $history->previous = $lastDocument->Investigation_Details;
            $history->current = $data->Investigation_Details;
            $history->comment = $request->Investigation_Details_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Investigation_Details) || $lastDocument->Investigation_Details === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        // if ($lastDocument->Action_Taken != $data->Action_Taken) {
        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $id;
        //     $history->activity_type = 'Action Taken';
        //     $history->previous = $lastDocument->Action_Taken;
        //     $history->current = $data->Action_Taken;
        //     $history->comment = $request->Action_Taken_comment ?? "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastDocument->Action_Taken) || $lastDocument->Action_Taken === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }

        // if ($lastDocument->Root_Cause != $data->Root_Cause) {
        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $id;
        //     $history->activity_type = 'Root Cause';
        //     $history->previous = $lastDocument->Root_Cause;
        //     $history->current = $data->Root_Cause;
        //     $history->comment = $request->Root_Cause_comment ?? "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastDocument->Root_Cause) || $lastDocument->Root_Cause === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }

        if ($lastDocument->capa_capa != $data->capa_capa) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Capa';
            $history->previous = $lastDocument->capa_capa;
            $history->current = $data->capa_capa;
            $history->comment = $request->capa_capa_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->capa_capa) || $lastDocument->capa_capa === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if ($lastDocument->Currective_Action != $data->Currective_Action) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Currective Action';
            $history->previous = $lastDocument->Currective_Action;
            $history->current = $data->Currective_Action;
            $history->comment = $request->Currective_Action_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Currective_Action) || $lastDocument->Currective_Action === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }




        if ($lastDocument->CAPA_Attachment != $data->CAPA_Attachment) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'CAPA Attachment';
            $history->previous = $lastDocument->CAPA_Attachment;
            $history->current = $data->CAPA_Attachment;
            $history->comment = $request->CAPA_Attachment_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->CAPA_Attachment) || $lastDocument->CAPA_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if ($lastDocument->QA_Review_Comments != $data->QA_Review_Comments) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'QC Head Review Comments';
            $history->previous = $lastDocument->QA_Review_Comments;
            $history->current = $data->QA_Review_Comments;
            $history->comment = $request->QA_Review_Comments_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->QA_Review_Comments) || $lastDocument->QA_Review_Comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if ($lastDocument->QA_Head_Attachment != $data->QA_Head_Attachment) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'QC Head Review Attachment';
            $history->previous = $lastDocument->QA_Head_Attachment;
            $history->current = $data->QA_Head_Attachment;
            $history->comment = $request->QA_Head_Attachment_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->QA_Head_Attachment) || $lastDocument->QA_Head_Attachment === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if ($lastDocument->QA_Head != $data->QA_Head) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'QA Head';
            $history->previous = $lastDocument->QA_Head;
            $history->current = $data->QA_Head;
            $history->comment = $request->QA_Head_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->QA_Head) || $lastDocument->QA_Head === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }



        if ($lastDocument->Conclusion != $data->Conclusion) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Conclusion';
            $history->previous = $lastDocument->Conclusion;
            $history->current = $data->Conclusion;
            $history->comment = $request->Conclusion_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Conclusion) || $lastDocument->Conclusion === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if ($lastDocument->due_date_extension != $data->due_date_extension) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Due Date Extension Justification';
            $history->previous = $lastDocument->due_date_extension;
            $history->current = $data->due_date_extension;
            $history->comment = $request->due_date_extension_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->due_date_extension) || $lastDocument->due_date_extension === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if ($lastLabtab->involved_ssfi != $labtab->involved_ssfi) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Instrument Involved';
            $history->previous = $lastLabtab->involved_ssfi;
            $history->current = $labtab->involved_ssfi;
            $history->comment = $request->involved_ssfi_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastLabtab->involved_ssfi) || $lastLabtab->involved_ssfi === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if ($lastLabtab->closure_incident_c != $labtab->closure_incident_c) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Closure of Incident';
            $history->previous = $lastLabtab->closure_incident_c;
            $history->current = $labtab->closure_incident_c;
            $history->comment = "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastLabtab->closure_incident_c) || $lastLabtab->closure_incident_c === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if ($lastLabtab->qa_hear_remark_c != $labtab->qa_hear_remark_c) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'QA Head Comment';
            $history->previous = $lastLabtab->qa_hear_remark_c;
            $history->current = $labtab->qa_hear_remark_c;
            $history->comment = $request->qa_hear_remark_c_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastLabtab->qa_hear_remark_c) || $lastLabtab->qa_hear_remark_c === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if ($lastLabtab->closure_attachment_c != $labtab->closure_attachment_c) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Closure Attachment';
            $history->previous = $lastLabtab->closure_attachment_c;
            $history->current = $labtab->closure_attachment_c;
            $history->comment = $request->qa_hear_remark_c_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastLabtab->closure_attachment_c) || $lastLabtab->closure_attachment_c === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        // if ($lastLabtab->stage_stage_ssfi != $labtab->stage_stage_ssfi ) {
        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $id;
        //     $history->activity_type = 'Stage';
        //     $history->previous = $lastLabtab->stage_stage_ssfi;
        //     $history->current = $labtab->stage_stage_ssfi;
        //     $history->comment = $request->stage_stage_ssfi_comment ?? "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastLabtab->stage_stage_ssfi) || $lastLabtab->stage_stage_ssfi === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        // }

        if ($lastLabtab->stage_stage_ssfi != $labtab->stage_stage_ssfi) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Stage';
            $history->previous = $lastLabtab->stage_stage_ssfi;
            $history->current = $labtab->stage_stage_ssfi;
            $history->comment = $request->stage_stage_ssfi_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastLabtab->stage_stage_ssfi) || $lastLabtab->stage_stage_ssfi === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        // if ($lastDocument->Incident_stability_cond_ssfi != $data->Incident_stability_cond_ssfi) {
        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $id;
        //     $history->activity_type = 'Stability Condition';
        //     $history->previous = $lastDocument->Incident_stability_cond_ssfi;
        //     $history->current = $data->Incident_stability_cond_ssfi;
        //     $history->comment = $request->Incident_stability_cond_ssfi_comment ?? "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastDocument->Incident_stability_cond_ssfi) || $lastDocument->Incident_stability_cond_ssfi === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }

        if ($lastLabtab->Incident_stability_cond_ssfi != $labtab->Incident_stability_cond_ssfi) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Stability Condition (If Applicable)';
            $history->previous = $lastLabtab->Incident_stability_cond_ssfi;
            $history->current = $labtab->Incident_stability_cond_ssfi;
            $history->comment = $request->Incident_stability_cond_ssfi_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastLabtab->Incident_stability_cond_ssfi) || $lastLabtab->Incident_stability_cond_ssfi === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        // if ($lastDocument->Incident_interval_ssfi != $data->Incident_interval_ssfi) {
        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $id;
        //     $history->activity_type = 'Interval';
        //     $history->previous = $lastDocument->Incident_interval_ssfi;
        //     $history->current = $data->Incident_interval_ssfi;
        //     $history->comment = $request->Incident_interval_ssfi_comment ?? "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastDocument->Incident_interval_ssfi) || $lastDocument->Incident_interval_ssfi === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }

        if ($lastLabtab->Incident_interval_ssfi != $labtab->Incident_interval_ssfi) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Interval (If Applicable)';
            $history->previous = $lastLabtab->Incident_interval_ssfi;
            $history->current = $labtab->Incident_interval_ssfi;
            $history->comment = $request->Incident_interval_ssfi_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastLabtab->Incident_interval_ssfi) || $lastLabtab->Incident_interval_ssfi === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        // if ($lastDocument->test_ssfi != $data->test_ssfi) {
        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $id;
        //     $history->activity_type = 'Test';
        //     $history->previous = $lastDocument->test_ssfi;
        //     $history->current = $data->test_ssfi;
        //     $history->comment = $request->test_ssfi_comment ?? "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastDocument->test_ssfi) || $lastDocument->test_ssfi === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }


        if ($lastLabtab->test_ssfi != $labtab->test_ssfi) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Test';
            $history->previous = $lastLabtab->test_ssfi;
            $history->current = $labtab->test_ssfi;
            $history->comment = $request->test_ssfi_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastLabtab->test_ssfi) || $lastLabtab->test_ssfi === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        // if ($lastDocument->Incident_date_analysis_ssfi != $data->Incident_date_analysis_ssfi) {
        //     $history = new LabIncidentAuditTrial();
        //     $history->LabIncident_id = $id;
        //     $history->activity_type = 'Date Analysis';
        //     $history->previous = $lastDocument->Incident_date_analysis_ssfi;
        //     $history->current = $data->Incident_date_analysis_ssfi;
        //     $history->comment = $request->Incident_date_analysis_ssfi_comment ?? "Not Applicable";
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->change_to = "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //      if (is_null($lastDocument->Incident_date_analysis_ssfi) || $lastDocument->Incident_date_analysis_ssfi === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }

        //     $history->origin_state = $lastDocument->status;
        //     $history->save();
        // }

        if ($lastLabtab->Incident_date_analysis_ssfi != $labtab->Incident_date_analysis_ssfi) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Date Of Analysis';
            $history->previous = Carbon::parse($lastLabtab->Incident_date_analysis_ssfi)->format('d-M-Y');
            $history->current = Carbon::parse($labtab->Incident_date_analysis_ssfi)->format('d-M-Y');
            $history->comment = $request->test_ssfi_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastLabtab->Incident_date_analysis_ssfi) || $lastLabtab->Incident_date_analysis_ssfi === '') {
                        $history->action_name = "New";
                    } else {
                        $history->action_name = "Update";
                    }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if ($lastDocument->Incident_specification_ssfi != $data->Incident_specification_ssfi) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Specification';
            $history->previous = $lastDocument->Incident_specification_ssfi;
            $history->current = $data->Incident_specification_ssfi;
            $history->comment = $request->Incident_specification_ssfi_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->initial_attachment_hodsr) || $lastDocument->initial_attachment_hodsr === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if ($lastDocument->Incident_stp_ssfi != $data->Incident_stp_ssfi) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'STP Number';
            $history->previous = $lastDocument->Incident_stp_ssfi;
            $history->current = $data->Incident_stp_ssfi;
            $history->comment = $request->Incident_stp_ssfi_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Incident_stp_ssfi) || $lastDocument->Incident_stp_ssfi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if ($lastDocument->Incident_date_incidence_ssfi != $data->Incident_date_incidence_ssfi) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Incident Date Incidence';
            $history->previous = $lastDocument->Incident_date_incidence_ssfi;
            $history->current = $data->Incident_date_incidence_ssfi;
            $history->comment = $request->Incident_date_incidence_ssfi_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Incident_date_incidence_ssfi) || $lastDocument->Incident_date_incidence_ssfi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        $previousqcreviewName = User::find($lastDocument->section_sign_date_gi);
        $currentqcreviewName = User::find($data['suit_qc_review_to']);
        if ($lastDocument->suit_qc_review_to != $data['suit_qc_review_to']) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'QC Review To';
            $history->previous = $previousqcreviewName?$previousqcreviewName->name:'Not Applicable';
            $history->current = $currentqcreviewName?$currentqcreviewName->name:'Not Applicable';
            $history->comment = $request->suit_qc_review_to_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->suit_qc_review_to) || $lastDocument->suit_qc_review_to === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if ($lastDocument->Description_incidence_ssfi != $data->Description_incidence_ssfi) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Description Incidence';
            $history->previous = $lastDocument->Description_incidence_ssfi;
            $history->current = $data->Description_incidence_ssfi;
            $history->comment = $request->Description_incidence_ssfi_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
            $history->change_from = $lastDocument->status;
             if (is_null($lastDocument->Description_incidence_ssfi) || $lastDocument->Description_incidence_ssfi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }




        if ($lastDocument->root_cause_ssfi != $data->root_cause_ssfi) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Root Cause';
            $history->previous = $lastDocument->root_cause_ssfi;
            $history->current = $data->root_cause_ssfi;
            $history->comment = $request->root_cause_ssfi_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->root_cause_ssfi) || $lastDocument->root_cause_ssfi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }

        if ($lastDocument->incident_summary_ssfi != $data->incident_summary_ssfi) {
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Incident Summary';
            $history->previous = $lastDocument->incident_summary_ssfi;
            $history->current = $data->incident_summary_ssfi;
            $history->comment = $request->incident_summary_ssfi_comment ?? "Not Applicable";
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->incident_summary_ssfi) || $lastDocument->incident_summary_ssfi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

            $history->origin_state = $lastDocument->status;
            $history->save();
        }
        // Audit trail for 'type_incidence_ia'
// if ($lastDocument->type_incidence_ia != $data->type_incidence_ia) {
//     $history = new LabIncidentAuditTrial();
//     $history->LabIncident_id = $id;
//     $history->activity_type = 'Type Incidence';
//     $history->previous = $lastDocument->type_incidence_ia;
//     $history->current = $data->type_incidence_ia;
//     $history->comment = $request->type_incidence_ia_comment ?? "Not Applicable";
//     $history->user_id = Auth::user()->id;
//     $history->user_name = Auth::user()->name;
//     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
//     $history->change_to = "Not Applicable";
//     $history->change_from = $lastDocument->status;
//      if (is_null($lastDocument->type_incidence_ia) || $lastDocument->type_incidence_ia === '') {
//                 $history->action_name = "New";
//             } else {
//                 $history->action_name = "Update";
//             }

//     $history->origin_state = $lastDocument->status;
//     $history->save();
// }

// Audit trail for 'investigation_summary_ia'
if ($lastDocument->investigation_summary_ia != $data->investigation_summary_ia) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'Investigation Summary';
    $history->previous = $lastDocument->investigation_summary_ia;
    $history->current = $data->investigation_summary_ia;
    $history->comment = $request->investigation_summary_ia_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->investigation_summary_ia) || $lastDocument->investigation_summary_ia === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}

if ($lastDocument->type_incidence_ia != $data->type_incidence_ia) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'Type of Incidence';
    $history->previous = $lastDocument->type_incidence_ia;
    $history->current = $data->type_incidence_ia;
    $history->comment = $request->type_incidence_ia_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->type_incidence_ia) || $lastDocument->type_incidence_ia === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}
if ($lastDocument->investigator_qc != $data->investigator_qc) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'QC Head/HOD Person';
    $history->previous = Helpers::getInitiatorName($lastDocument->investigator_qc);
    $history->current = Helpers::getInitiatorName($data->investigator_qc);
    $history->comment = $request->investigator_qc_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->investigator_qc) || $lastDocument->investigator_qc === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}
if ($lastDocument->qc_review_to != $data->qc_review_to) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'QA Reviewer';
    $history->previous = Helpers::getInitiatorName($lastDocument->qc_review_to);
    $history->current = Helpers::getInitiatorName($data->qc_review_to);
    $history->comment = $request->qc_review_to_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->qc_review_to) || $lastDocument->qc_review_to === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}

// Audit trail for 'capa_number_im'
if ($lastDocument->capa_number_im != $data->capa_number_im) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'CAPA number';
    $history->previous = $lastDocument->capa_number_im;
    $history->current = $data->capa_number_im;
    $history->comment = $request->capa_number_im_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->capa_number_im) || $lastDocument->capa_number_im === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}

// Audit trail for 'corrective_and_preventive_action_ia'
if ($lastDocument->corrective_and_preventive_action_ia != $data->corrective_and_preventive_action_ia) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'Corrective and Preventive Action';
    $history->previous = $lastDocument->corrective_and_preventive_action_ia;
    $history->current = $data->corrective_and_preventive_action_ia;
    $history->comment = $request->corrective_and_preventive_action_ia_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->corrective_and_preventive_action_ia) || $lastDocument->corrective_and_preventive_action_ia === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}

// Audit trail for 'result_of_repeat_analysis_ia'
// if ($lastDocument->result_of_repeat_analysis_ia != $data->result_of_repeat_analysis_ia) {
//     $history = new LabIncidentAuditTrial();
//     $history->LabIncident_id = $id;
//     $history->activity_type = 'Result of Repeat Analysis';
//     $history->previous = $lastDocument->result_of_repeat_analysis_ia;
//     $history->current = $data->result_of_repeat_analysis_ia;
//     $history->comment = $request->result_of_repeat_analysis_ia_comment ?? "Not Applicable";
//     $history->user_id = Auth::user()->id;
//     $history->user_name = Auth::user()->name;
//     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
//     $history->change_to = "Not Applicable";
//     $history->change_from = $lastDocument->status;
//      if (is_null($lastDocument->initial_attachment_hodsr) || $lastDocument->initial_attachment_hodsr === '') {
//                 $history->action_name = "New";
//             } else {
//                 $history->action_name = "Update";
//             }

//     $history->origin_state = $lastDocument->status;
//     $history->save();
// }

if ($lastDocument->result_of_repeat_analysis_ia != $data->result_of_repeat_analysis_ia) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'Result of Repeat Analysis';
    $history->previous = $lastDocument->result_of_repeat_analysis_ia;
    $history->current = $data->result_of_repeat_analysis_ia;
    $history->comment = $request->corrective_and_preventive_action_ia_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->result_of_repeat_analysis_ia) || $lastDocument->result_of_repeat_analysis_ia === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}

// Audit trail for 'repeat_analysis_plan_ia'
if ($lastDocument->repeat_analysis_plan_ia != $data->repeat_analysis_plan_ia) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'Repeat Analysis Plan';
    $history->previous = $lastDocument->repeat_analysis_plan_ia;
    $history->current = $data->repeat_analysis_plan_ia;
    $history->comment = $request->repeat_analysis_plan_ia_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->repeat_analysis_plan_ia) || $lastDocument->repeat_analysis_plan_ia === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}

// Audit trail for 'proposed_correctivei_ia'
if ($lastDocument->proposed_correctivei_ia != $data->proposed_correctivei_ia) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'Proposed Corrective Action/Corrective Action Taken';
    $history->previous = $lastDocument->proposed_correctivei_ia;
    $history->current = $data->proposed_correctivei_ia;
    $history->comment = $request->proposed_correctivei_ia_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->proposed_correctivei_ia) || $lastDocument->proposed_correctivei_ia === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}

// Audit trail for 'Incident_Details'
if ($lastDocument->Incident_Details != $data->Incident_Details) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'Incident Details';
    $history->previous = $lastDocument->Incident_Details;
    $history->current = $data->Incident_Details;
    $history->comment = $request->Incident_Details_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->Incident_Details) || $lastDocument->Incident_Details === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}

// Audit trail for 'Document_Details'
if ($lastDocument->Document_Details != $data->Document_Details) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'Document Details';
    $history->previous = $lastDocument->Document_Details;
    $history->current = $data->Document_Details;
    $history->comment = $request->Document_Details_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->Document_Details) || $lastDocument->Document_Details === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}

// Audit trail for 'Instrument_Details'
if ($lastDocument->Instrument_Details != $data->Instrument_Details) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'Instrument Details';
    $history->previous = $lastDocument->Instrument_Details;
    $history->current = $data->Instrument_Details;
    $history->comment = $request->Instrument_Details_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->Instrument_Details) || $lastDocument->Instrument_Details === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
    $history->action_name = "Update";
    $history->origin_state = $lastDocument->status;
    $history->save();
}

// Audit trail for 'Involved_Personnel'
if ($lastDocument->Involved_Personnel != $data->Involved_Personnel) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'Involved Personnel';
    $history->previous = $lastDocument->Involved_Personnel;
    $history->current = $data->Involved_Personnel;
    $history->comment = $request->Involved_Personnel_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->Involved_Personnel) || $lastDocument->Involved_Personnel === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}

// Audit trail for 'Product_Details'
if ($lastDocument->Product_Details != $data->Product_Details) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'Product Details';
    $history->previous = $lastDocument->Product_Details;
    $history->current = $data->Product_Details;
    $history->comment = $request->Product_Details_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->Product_Details) || $lastDocument->Product_Details === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}

// Audit trail for 'Supervisor_Review_Comments'
if ($lastDocument->Supervisor_Review_Comments != $data->Supervisor_Review_Comments) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'Supervisor Review Comments';
    $history->previous = $lastDocument->Supervisor_Review_Comments;
    $history->current = $data->Supervisor_Review_Comments;
    $history->comment = $request->Supervisor_Review_Comments_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->Supervisor_Review_Comments) || $lastDocument->Supervisor_Review_Comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}

// Audit trail for 'ccf_attachments'
if ($lastDocument->ccf_attachments != $data->ccf_attachments) {
    $history = new LabIncidentAuditTrial();
    $history->LabIncident_id = $id;
    $history->activity_type = 'ccf attachments';
    $history->previous = $lastDocument->ccf_attachments;
    $history->current = $data->ccf_attachments;
    $history->comment = $request->ccf_attachments_comment ?? "Not Applicable";
    $history->user_id = Auth::user()->id;
    $history->user_name = Auth::user()->name;
    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    $history->change_to = "Not Applicable";
    $history->change_from = $lastDocument->status;
     if (is_null($lastDocument->ccf_attachments) || $lastDocument->ccf_attachments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }

    $history->origin_state = $lastDocument->status;
    $history->save();
}



        $griddata = $data->id;


        if (!empty($request->investrecord)) {
            // Fetch existing auditor data
            $existingAuditorShow = lab_incidents_grid::where(['labincident_id' => $griddata, 'identifier' => 'incident report'])->first();
            $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

            if($data->stage == 1){
                $incidentReport = lab_incidents_grid::where(['labincident_id' => $griddata, 'identifier' => 'incident report'])->firstOrNew();
                $incidentReport->labincident_id = $griddata;
                $incidentReport->identifier = 'Incident Report';
                $incidentReport->data = $request->investrecord;
                $incidentReport->update();
            }
            //dd($product);
            // Define the mapping of field keys to more descriptive names
            $fieldNames = [
                'name_of_product' => 'Name of Product',
                'batch_no' => 'B No./A.R. No.',
                'remarks' => 'Remarks',

            ];

            // Track audit trail changes
            if (is_array($request->investrecord)) {
                foreach ($request->investrecord as $index => $newAuditor) {
                    $previousAuditor = $existingAuditorData[$index] ?? [];

                    // Track changes for each field
                    $fieldsToTrack = ['name_of_product', 'batch_no', 'remarks'];
                    foreach ($fieldsToTrack as $field) {
                        $oldValue = $previousAuditor[$field] ?? 'Null';
                        $newValue = $newAuditor[$field] ?? 'Null';

                        // Only proceed if there's a change or the data is new
                        if ($oldValue !== $newValue) {
                            // Check if this specific change has already been logged in the audit trail
                            $existingAuditTrail = LabIncidentAuditTrial::where([
                                ['labincident_id', '=', $data->id],
                                ['activity_type', '=', $fieldNames[$field] . ' ( ' . ($index + 1) . ')'],
                                ['previous', '=', $oldValue],
                                ['current', '=', $newValue]
                            ])->first();

                            // Determine if the data is new or updated
                            $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

                            // If no existing audit trail record, log the change
                            if (!$existingAuditTrail) {
                                $auditTrail = new LabIncidentAuditTrial;
                                $auditTrail->labincident_id = $data->id;
                                $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
                                $auditTrail->previous = $oldValue;
                                $auditTrail->current = $newValue;
                                $auditTrail->comment = "";
                                $auditTrail->user_id = Auth::user()->id;
                                $auditTrail->user_name = Auth::user()->name;
                                $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                                $auditTrail->origin_state = $data->status;
                                $auditTrail->change_to = "Not Applicable";
                                $auditTrail->change_from = $data->status;
                                $auditTrail->action_name = $actionName; // Set action to New or Update
                                $auditTrail->save();
                            }
                        }
                    }
                }
            }
        }



                // For "Sutability" report
                $identifier = 'Sutability';

                $suitabilityReport = lab_incidents_grid::where(['labincident_id' => $griddata, 'identifier' => $identifier])->firstOrNew();
                $suitabilityReport->labincident_id = $griddata;
                $suitabilityReport->identifier = $identifier;
                $suitabilityReport->data = $request->investigation;
                $suitabilityReport->save();



        toastr()->success('Record is updated Successfully');

        return back();
    }

    public function LabIncidentShow($id)
    {

        $data = LabIncident::where('id', $id)->first();
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $report = lab_incidents_grid::where('labincident_id', $id)->first();
        // foreach($report as $r){
        //     return $r;
        // }
        $systemSutData = lab_incidents_grid::where(['labincident_id' => $id,'identifier' => 'Sutability'])->first();
        $labnew =Labincident_Second::where(['lab_incident_id'=>$id])->first();

        return view('frontend.labIncident.view', compact('data','report','systemSutData','labnew'));

           }
           public function lab_incident_capa_child(Request $request, $id)
           {
               $cc = LabIncident::find($id);
               $cft = [];
               $parent_id = $id;
               $parent_type = "Lab Incident";
               $old_records = Capa::select('id', 'division_id', 'record')->get();
               $record_number = ((RecordNumber::first()->value('counter')) + 1);
               $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
               $currentDate = Carbon::now();
               $formattedDate = $currentDate->addDays(30);
               $due_date = $formattedDate->format('d-M-Y');
               $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
               $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
               $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
               $parent_initiator_id = $id;
               $changeControl = OpenStage::find(1);


               if (!empty($changeControl->cft)) $cft = explode(',', $changeControl->cft);

               // Debugging to check the revision value


               if ($request->revision == "Action-Item") {
                   $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                   $record = $record_number;
               $old_record = Capa::select('id', 'division_id', 'record')->get();

                    $data=LabIncident::find($id);
                    // $p_record = OutOfCalibration::find($id);
                    $data_record = Helpers::getDivisionName($data->division_id ) . '/' . 'LI' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
                   $expectedParenRecord = Helpers::getDivisionName(session()->get('division')) . "/CAPA/" . date('Y') . "/" .$data->record."";
                //    $count = Helpers::getActionItemData($id, $parent_type);
                //    $countData = $count + 1;

                //    dd($countData);
                // return $data;
                   return view('frontend.action-item.action-item', compact('expectedParenRecord','record','record_number',  'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id','old_record', 'data_record', 'data'));

               }

               if ($request->revision == "resampling") {
                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                $relatedRecords = Helpers::getAllRelatedRecords();
                $record = $record_number;
                $relatedRecords = Helpers::getAllRelatedRecords();
                return view('frontend.resampling.resapling_create', compact('relatedRecords','record', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));

            }

            if ($request->revision == "Extension") {
                $data=LabIncident::find($id);
                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                $relatedRecords = Helpers::getAllRelatedRecords();
                $data_record = Helpers::getDivisionName($data->division_id ) . '/' . 'LI' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
                return view('frontend.extension.extension_new', compact('relatedRecords','record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id', 'data_record'));

            }

               if ($request->revision == "capa") {
                   $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                   $record = $record_number;
                   $Capachild = LabIncident::find($id);
                //    dd($Capachild->division_id);
                   $reference_record = Helpers::getDivisionName($Capachild->division_id ) . '/' . 'LI' .'/' . date('Y') .'/' . str_pad($Capachild->record, 4, '0', STR_PAD_LEFT);
                   $relatedRecords = Helpers::getAllRelatedRecords();
                  return view('frontend.forms.capa', compact('record','record_number', 'due_date', 'parent_id', 'parent_type', 'old_records', 'cft','relatedRecords', 'reference_record'));
               }
               if ($request->revision == "rca") {
                $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                return view('frontend.forms.root-cause-analysis', compact('record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));

            }


           }


           public function lab_incident_extension_child(Request $request, $id)
           {
               $cc = LabIncident::find($id);
               $cft = [];
               $parent_id = $id;
               $parent_type = "LabIncident";
               $old_records = Capa::select('id', 'division_id', 'record')->get();
               $record_number = ((RecordNumber::first()->value('counter')) + 1);
               $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
               $currentDate = Carbon::now();
               $formattedDate = $currentDate->addDays(30);
               $due_date = $formattedDate->format('d-M-Y');
               $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
               $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
               $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
               $parent_initiator_id = $id;
               $changeControl = OpenStage::find(1);
               if (!empty($changeControl->cft)) $cft = explode(',', $changeControl->cft);

               // Debugging to check the revision value


               if ($request->revision == "Extension") {
                   $cc->originator = User::where('id', $cc->initiator_id)->value('name');
                   $relatedRecords = Helpers::getAllRelatedRecords();
                   $data=LabIncident::find($id);
                   $extension_record = Helpers::getDivisionName($data->division_id ) . '/' . 'LI' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
                    $count = Helpers::getChildData($id, $parent_type);
                    $countData = $count + 1;
                   return view('frontend.extension.extension_new', compact('relatedRecords','record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id', 'countData', 'extension_record'));

               }



           }

    public function lab_incident_root_child(Request $request, $id)
    {
        $cc = LabIncident::find($id);
        $cft = [];
        $parent_id = $id;
        $parent_type = "Lab Incident";
        $old_records = Capa::select('id', 'division_id', 'record')->get();
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
        $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_initiator_id = $id;

        if ($request->revision == "Action-Item") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            $record = $record_number;
            $data = LabIncident::find($id);
            $expectedParenRecord = Helpers::getDivisionName(session()->get('division')) . "/CAPA/" . date('Y') . "/" .$data->record."";

            return view('frontend.forms.action-item', compact('expectedParenRecord','record', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));
        }

        if ($request->revision == "capa-child") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.forms.capa', compact('record_number', 'due_date', 'parent_id', 'parent_type', 'old_records', 'cft'));
        }
        if ($request->revision == "effectiveness-check") {
         $cc->originator = User::where('id', $cc->initiator_id)->value('name');
           return view('frontend.forms.effectiveness-check', compact( 'parent_id', 'parent_type','record_number','currentDate','formattedDate','due_date'));
        // return view('frontend.forms.root-cause-analysis', compact('record_number', 'due_date', 'parent_id', 'parent_type'));
    };
    if ($request->revision == "Extension") {
        $cc->originator = User::where('id', $cc->initiator_id)->value('name');
        $relatedRecords = Helpers::getAllRelatedRecords();
        return view('frontend.extension.extension_new', compact('relatedRecords','record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));

    }

}

    public function labincidentRiskChild(Request $request,$id)
    {
        $cc = LabIncident::find($id);
        $cft = [];
        $parent_id = $id;
        $parent_type = "Capa";
        $old_records = Capa::select('id', 'division_id', 'record')->get();
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
        $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_initiator_id = $id;

        if ($request->revision == "risk-Item") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.forms.risk-management', compact('record_number', 'due_date', 'parent_id','old_records', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));

        }
        if ($request->revision == "Extension") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            $relatedRecords = Helpers::getAllRelatedRecords();
            return view('frontend.extension.extension_new', compact('relatedRecords','record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));

        }

    }
    public function LabIncidentStateTwo(Request $request,$id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $labstate = LabIncident::find($id);
            $lastDocument =  LabIncident::find($id);


           if( $labstate->stage == 10){
            $labstate->stage = "4";
            $labstate->no_assignable_cause_by = Auth::user()->name;
            $labstate->no_assignable_cause_on = Carbon::now()->format('d-M-Y');
            $labstate->no_assignable_cause_comment = $request->comment;
            $labstate->status = "Pending Initiator Update";
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Activity Log';
            // $history->previous = $lastDocument->submitted_by;
            $history->current = $labstate->no_assignable_cause_by;
            $history->current = $labstate->verification_complete_completed_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Pending Initiator Update";
            $history->change_from = $lastDocument->status;
            $history->origin_state = $lastDocument->status;
            $history->stage='Final Root Cause Not Found';
            $history->action='Final Root Cause Not Found';
            $history->save();


            $labstate->update();

            return redirect()->back();
           }

        }else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function LabIncidentStateCancel(Request $request,$id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $labstate = LabIncident::find($id);
            $lastDocument =  LabIncident::find($id);


           if( $labstate->stage == 7){
            $labstate->stage = "11";
            $labstate->no_assignable_cause_by = Auth::user()->name;
            $labstate->no_assignable_cause_on = Carbon::now()->format('d-M-Y');
            $labstate->no_assignable_cause_comment = $request->comment;
            $labstate->status = "Closed - Done";
            $history = new LabIncidentAuditTrial();
            $history->LabIncident_id = $id;
            $history->activity_type = 'Approved By, Approved On';
            if (is_null($lastDocument->no_assignable_cause_by) || $lastDocument->no_assignable_cause_by === '') {
                $history->previous = "";
            } else {
                $history->previous = $lastDocument->no_assignable_cause_by . ' , ' . $lastDocument->no_assignable_cause_on;
            }
            $history->current = $labstate->no_assignable_cause_by . ' , ' . $labstate->no_assignable_cause_on;
            $history->current = $labstate->verification_complete_completed_by;
            $history->comment = $request->comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->change_to = "Closed - Done";
            $history->change_from = $lastDocument->status;
            $history->origin_state = $lastDocument->status;
            $history->stage='Approved';
            $history->action='Approved';
            if (is_null($lastDocument->no_assignable_cause_by) || $lastDocument->no_assignable_cause_by === '') {
                $history->action_name = 'New';
            } else {
                $history->action_name = 'Update';
            }
            $history->save();

            // $list = Helpers::getCftUserList($labstate->division_id); // Notify CFT Person
            // foreach ($list as $u) {
            //         $email = Helpers::getUserEmail($u->user_id);
            //             if ($email !== null) {
            //             Mail::send(
            //                 'mail.view-mail',
            //                 ['data' => $labstate, 'site' => "LI", 'history' => "Approved", 'process' => 'Lab Incident', 'comment' => $request->comments, 'user'=> Auth::user()->name],
            //                 function ($message) use ($email, $labstate) {
            //                     $message->to($email)
            //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($labstate->record, 4, '0', STR_PAD_LEFT) . " - Activity: Approved");
            //                 }
            //             );
            //         }
            // }

            $labstate->update();

            return redirect()->back();
           }

        }else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function LabIncidentStateChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = LabIncident::find($id);
            $lastDocument =  LabIncident::find($id);
            $data =  LabIncident::find($id);

            if ($changeControl->stage == 1) {
                $changeControl->stage = "2";
                $changeControl->submitted_by = Auth::user()->name;
                $changeControl->submitted_on = Carbon::now()->format('d-M-Y');
                $changeControl->comment =$request->comment;
                $changeControl->status = "QC Head/HOD Initial Review";
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                // $history->activity_type = 'Activity Log';
                $history->activity_type = 'Submitted By, Submitted On';
                if (is_null($lastDocument->submitted_by) || $lastDocument->submitted_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->submitted_by . ' , ' . $lastDocument->submitted_on;
                }
                // $history->previous = $lastDocument->submitted_by;
                // $history->current = $changeControl->submitted_by;
                $history->current = $changeControl->submitted_by . ' , ' . $changeControl->submitted_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to = "QA Head/HOD Initial Review";
                $history->action = 'Submit';
                $history->change_from = $lastDocument->status;
                $history->stage='Submit';
                if (is_null($lastDocument->submitted_by) || $lastDocument->submitted_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "Submit", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Submit");
                //                 }
                //             );
                //         }
                //     // }
                // }


                $changeControl->update();
                //toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 2) {
                if (empty($changeControl->QA_Review_Comments))
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'QC Head Review Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                 else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Sent for QA Initial Review state'
                    ]);
                }
                $changeControl->stage = "3";
                $changeControl->status = "QA Initial Review";
                $changeControl->verification_complete_completed_by = Auth::user()->name;
                $changeControl->verification_completed_on = Carbon::now()->format('d-M-Y');
                $changeControl->verification_complete_comment =$request->comment;
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                // $history->activity_type = 'Activity Log';
                $history->activity_type = 'QC Head/HOD Initial Review Complete By, QC Head/HOD Initial Review Complete On';
                if (is_null($lastDocument->verification_complete_completed_by) || $lastDocument->verification_complete_completed_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->verification_complete_completed_by . ' , ' . $lastDocument->verification_completed_on;
                }
                // $history->previous = $lastDocument->verification_complete_completed_by;
                // $history->current = $changeControl->verification_complete_completed_by;
                $history->current = $changeControl->verification_complete_completed_by . ' , ' . $changeControl->verification_completed_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "QA Initial Review";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->action = 'QA Head/HOD Initial Review Complete';
                $history->stage='QA Head/HOD Initial Review Complete';
                if (is_null($lastDocument->verification_complete_completed_by) || $lastDocument->verification_complete_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }

                $history->save();
                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "QC Head/HOD Initial Review Complete", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QC Head/HOD Initial Review Complete");
                //                 }
                //             );
                //         }
                //     // }
                // }

                $changeControl->update();
                //toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 3) {
                if (empty($changeControl->QA_initial_Comments))
                    {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'QA Initial Review Tab is yet to be filled'
                        ]);

                        return redirect()->back();
                    }
                     else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for Pending Initiator Update state'
                        ]);
                    }
                $changeControl->stage = "4";
                $changeControl->status = "Pending Initiator Update";
                $changeControl->preliminary_completed_by = Auth::user()->name;
                $changeControl->preliminary_completed_on = Carbon::now()->format('d-M-Y');
                $changeControl->preliminary_completed_comment =$request->comment;
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                // $history->activity_type = 'Activity Log';
                // $history->previous = $lastDocument->preliminary_completed_by;
                // $history->current = $changeControl->preliminary_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "Pending Initiator Update";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->action = 'QA Initial Review Complete';
                $history->stage='QA Initial Review Complete';

                $history->activity_type = 'QA Initial Review Complete By, QA Initial Review Complete On';
                if (is_null($lastDocument->preliminary_completed_by) || $lastDocument->preliminary_completed_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->preliminary_completed_by . ' , ' . $lastDocument->preliminary_completed_on;
                }
                $history->current = $changeControl->preliminary_completed_by . ' , ' . $changeControl->preliminary_completed_on;
                if (is_null($lastDocument->preliminary_completed_by) || $lastDocument->preliminary_completed_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }

                $history->save();
                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "QA Initial Review Complete", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA Initial Review Complete");
                //                 }
                //             );
                //         }
                //     // }
                // }

                $changeControl->update();
                //toastr()->success('Document Sent');
                return back();
            }
                if ($changeControl->stage == 4) {
                    if (empty($changeControl->Investigation_Details))
                    {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'Investigation Details Tab is yet to be filled'
                        ]);

                        return redirect()->back();
                    }
                     else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => ' Sent for QC Head/HOD Secondary Review state'
                        ]);
                    }
                    $changeControl->stage = "5";
                    $changeControl->status = "QC Head/HOD Secondary Review";
                    $changeControl->all_activities_completed_comment =$request->comment;
                    $changeControl->all_activities_completed_by = Auth::user()->name;
                    $changeControl->all_activities_completed_on = Carbon::now()->format('d-M-Y');
                    $history = new LabIncidentAuditTrial();
                    $history->LabIncident_id = $id;
                    // $history->activity_type = 'Activity Log';
                    // $history->previous = $lastDocument->all_activities_completed_by;
                    // $history->current = $changeControl->all_activities_completed_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "QA Head/HOD Secondary Review";
                    $history->change_from = $lastDocument->status;
                    $history->origin_state = $lastDocument->status;
                    $history->stage='Pending Initiator Update Complete';
                    $history->action='Pending Initiator Update Complete';

                    $history->activity_type = 'Pending Initiator Update Complete By, Pending Initiator Update Complete On';
                    if (is_null($lastDocument->all_activities_completed_by) || $lastDocument->all_activities_completed_by === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->all_activities_completed_by . ' , ' . $lastDocument->all_activities_completed_on;
                    }
                    $history->current = $changeControl->all_activities_completed_by . ' , ' . $changeControl->all_activities_completed_on;
                    if (is_null($lastDocument->all_activities_completed_by) || $lastDocument->all_activities_completed_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }

                    $history->save();

                    // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                    // foreach ($list as $u) {
                    //         $email = Helpers::getUserEmail($u->user_id);
                    //             if ($email !== null) {
                    //             Mail::send(
                    //                 'mail.view-mail',
                    //                 ['data' => $changeControl, 'site' => "LI", 'history' => "Pending Initiator Update Complete", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                    //                 function ($message) use ($email, $changeControl) {
                    //                     $message->to($email)
                    //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Pending Initiator Update Complete");
                    //                 }
                    //             );
                    //         }
                    //     // }
                    // }

                    $changeControl->update();
                    //toastr()->success('Document Sent');
                    return back();


                }

            if ($changeControl->stage == 5) {
                if (empty($changeControl->QC_head_hod_secondry_Comments))
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'QC Head/HOD Secondary Review Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                 else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Sent for QA Secondary Review state'
                    ]);
                }
                $changeControl->stage = "6";
                $changeControl->status = "QA Secondary Review";
                $changeControl->review_completed_by = Auth::user()->name;
                $changeControl->review_completed_on = Carbon::now()->format('d-M-Y');
                $changeControl->solution_validation_comment =$request->comment;
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                // $history->activity_type = 'Activity Log';
                // $history->previous = $lastDocument->review_completed_by;
                // $history->current = $changeControl->review_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "QA Secondary Review";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->action='Qc Head/HOD Secondary Review Complete';
                $history->stage='Qc Head/HOD Secondary Review Complete';

                $history->activity_type = 'Qc Head/HOD Secondary Review Complete By, Qc Head/HOD Secondary Review Complete On';
                    if (is_null($lastDocument->review_completed_by) || $lastDocument->review_completed_by === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->review_completed_by . ' , ' . $lastDocument->review_completed_on;
                    }
                    $history->current = $changeControl->review_completed_by . ' , ' . $changeControl->review_completed_on;
                    if (is_null($lastDocument->review_completed_by) || $lastDocument->review_completed_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }

                $history->save();
                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "QA Head/HOD Secondary Review Complete", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA Head/HOD Secondary Review Complete");
                //                 }
                //             );
                //         }
                //     // }
                // }

                $changeControl->update();
                //toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 6) {
                if (empty($changeControl->QA_secondry_Comments))
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'QA Secondary Review Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                 else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Sent for QAH Approval state'
                    ]);
                }
                $changeControl->stage = "7";
                $changeControl->status = "QAH Approval";
                $changeControl->extended_inv_complete_by = Auth::user()->name;
                $changeControl->extended_inv_complete_on = Carbon::now()->format('d-M-Y');
                $changeControl->extended_inv_comment =$request->comment;
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                // $history->activity_type = 'Activity Log';
                // $history->previous = $lastDocument->extended_inv_complete_by;
                // $history->current = $changeControl->extended_inv_complete_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "QAH Approval";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage='QA Secondry Review Complete';
                $history->action='QA Secondry Review Complete';

                $history->activity_type = 'QA Secondry Review Complete By, QA Secondry Review Complete On';
                    if (is_null($lastDocument->extended_inv_complete_by) || $lastDocument->extended_inv_complete_by === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->extended_inv_complete_by . ' , ' . $lastDocument->extended_inv_complete_on;
                    }
                    $history->current = $changeControl->extended_inv_complete_by . ' , ' . $changeControl->extended_inv_complete_on;
                    if (is_null($lastDocument->extended_inv_complete_by) || $lastDocument->extended_inv_complete_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }

                $history->save();

                // $list = Helpers::getCftUserList($changeControl->division_id);
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "QA Secondry Review Complete", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA Secondry Review Complete");
                //                 }
                //             );
                //         }
                //     // }
                // }


                $changeControl->update();
                //toastr()->success('Document Sent');
                return back();
            }

            if ($changeControl->stage == 7) {
                if (empty($changeControl->qa_hear_remark_c))
                {
                    Session::flash('swal', [
                        'type' => 'warning',
                        'title' => 'Mandatory Fields!',
                        'message' => 'Closure Tab is yet to be filled'
                    ]);

                    return redirect()->back();
                }
                 else {
                    Session::flash('swal', [
                        'type' => 'success',
                        'title' => 'Success',
                        'message' => 'Sent for Closed - Done state'
                    ]);
                }
                $changeControl->stage = "8";
                $changeControl->status = "QA Head/HOD Final Review";
                $changeControl->all_actiion_approved_by = Auth::user()->name;
                $changeControl->all_actiion_approved_on = Carbon::now()->format('d-M-Y');
                $changeControl->all_action_approved_comment =$request->comment;
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocument->all_actiion_approved_on;
                $history->current = $changeControl->all_actiion_approved_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "QA Head/HOD Final Review";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage='Root Cause Not Found';
                $history->action='Root Cause Not Found';

                $history->activity_type = 'Root Cause Not Found By, Root Cause Not Found On';
                    if (is_null($lastDocument->all_actiion_approved_by) || $lastDocument->all_actiion_approved_by === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->all_actiion_approved_by . ' , ' . $lastDocument->all_actiion_approved_on;
                    }
                    $history->current = $changeControl->all_actiion_approved_by . ' , ' . $changeControl->all_actiion_approved_on;
                    if (is_null($lastDocument->all_actiion_approved_by) || $lastDocument->all_actiion_approved_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }

                $history->save();
                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "Root Cause Not Found", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Root Cause Not Found");
                //                 }
                //             );
                //         }
                //     // }
                // }

                $changeControl->update();
                //toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 8) {
                $changeControl->stage = "9";
                $changeControl->status = "QA Final Review";
                $changeControl->assesment_completed_by = Auth::user()->name;
                $changeControl->assesment_completed_on = Carbon::now()->format('d-M-Y');
                $changeControl->assessment_comment=$request->comment;
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocument->closure_completed_by;
                $history->current = $changeControl->closure_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "QA Final Review";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage='QA Head/HOD Final Review Complete';
                $history->action='QA Head/HOD Final Review Complete';

                // $history->activity_type = 'QA Head/HOD Final Review Complete By, QA Head/HOD Final Review Complete On';
                //     if (is_null($lastDocument->assesment_completed_by) || $lastDocument->assesment_completed_by === '') {
                //         $history->previous = "";
                //     } else {
                //         $history->previous = $lastDocument->assesment_completed_by . ' , ' . $lastDocument->assesment_completed_on;
                //     }
                //     $history->current = $changeControl->assesment_completed_by . ' , ' . $changeControl->assesment_completed_on;
                //     if (is_null($lastDocument->assesment_completed_by) || $lastDocument->assesment_completed_by === '') {
                //         $history->action_name = 'New';
                //     } else {
                //         $history->action_name = 'Update';
                //     }

                $history->save();
                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "QA Head/HOD Final Review Complete", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA Head/HOD Final Review Complete");
                //                 }
                //             );
                //         }
                //     // }
                // }

                $changeControl->update();
                //toastr()->success('Document Sent');
                return back();
            }

            if ($changeControl->stage == 9) {
                $changeControl->stage = "10";
                $changeControl->status = "QAH Approval";
                $changeControl->assesment_completed_by = Auth::user()->name;
                $changeControl->assesment_completed_on = Carbon::now()->format('d-M-Y');
                $changeControl->assessment_comment=$request->comment;
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocument->closure_completed_by;
                $history->current = $changeControl->closure_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "QAH Approval";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage='QA Final Review Complete';
                $history->action='QA Final Review Complete';

                $history->activity_type = 'QA Final Review Complete By, QA Final Review Complete On';
                    if (is_null($lastDocument->assesment_completed_by) || $lastDocument->assesment_completed_by === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->assesment_completed_by . ' , ' . $lastDocument->assesment_completed_on;
                    }
                    $history->current = $changeControl->assesment_completed_by . ' , ' . $changeControl->assesment_completed_on;
                    if (is_null($lastDocument->assesment_completed_by) || $lastDocument->assesment_completed_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }

                $history->save();
                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "QA Final Review Complete", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: QA Final Review Complete");
                //                 }
                //             );
                //         }
                //     // }
                // }

                $changeControl->update();
                //toastr()->success('Document Sent');
                return back();
            }

            if ($changeControl->stage == 10) {
                $changeControl->stage = "11";
                $changeControl->status = "Closed - Done";
                $changeControl->closure_completed_by = Auth::user()->name;
                $changeControl->closure_completed_on = Carbon::now()->format('d-M-Y');
                $changeControl->closure_comment =$request->comment;

                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = $lastDocument->closure_completed_by;
                $history->current = $changeControl->closure_completed_by;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "Closed - Done";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage='Final Root Cause Found ';
                $history->action='Final Root Cause Found ';

                $history->activity_type = 'Final Root Cause Found By, Final Root Cause Found On';
                    if (is_null($lastDocument->closure_completed_by) || $lastDocument->closure_completed_by === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->closure_completed_by . ' , ' . $lastDocument->closure_completed_on;
                    }
                    $history->current = $changeControl->closure_completed_by . ' , ' . $changeControl->closure_completed_on;
                    if (is_null($lastDocument->closure_completed_by) || $lastDocument->closure_completed_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }

                $history->save();
                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "Final Root Cause Found", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Final Root Cause Found");
                //                 }
                //             );
                //         }
                //     // }
                // }

                $changeControl->update();
                //toastr()->success('Document Sent');
                return back();
            }




        }
         else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function RejectStateChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = LabIncident::find($id);
            $lastDocument = LabIncident::find($id);


            if ($changeControl->stage == 2) {
                $changeControl->stage = "1";
                $changeControl->status = "Opened";
                $changeControl->more_info_req_1_by = Auth::user()->name;
                $changeControl->more_info_req_1_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_info_req_1_comment =$request->comment;
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                $history->activity_type = "Not Applicable";
                // $history->activity_type = 'More Information Required By, More Information Required On';
                // if (is_null($lastDocument->more_info_req_1_by) || $lastDocument->more_info_req_1_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->more_info_req_1_by . ' , ' . $lastDocument->more_info_req_1_on;
                // }
                // $history->current = $changeControl->more_info_req_1_by . ' , ' . $changeControl->more_info_req_1_on;

                $history->previous = "Not Applicable";
                $history->current = "Not Applicable";
                // $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "Opened";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage='More Information Required';
                $history->action='More Information Required';
                // if (is_null($lastDocument->more_info_req_1_by) || $lastDocument->more_info_req_1_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->action_name = 'Not Applicable';
                $history->save();

                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "More Information Required", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                 }
                //             );
                //         }
                // }

                $changeControl->update();

                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 3) {
                $changeControl->stage = "2";
                $changeControl->status = "QC Head/HOD Initial Review";
                $changeControl->more_info_req_2_by = Auth::user()->name;
                $changeControl->more_info_req_2_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_info_req_2_comment =$request->comment;
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                // $history->activity_type = 'More Information Required By, More Information Required On';
                $history->activity_type = 'Not Applicable';
                // if (is_null($lastDocument->more_info_req_2_by) || $lastDocument->more_info_req_2_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->more_info_req_2_by . ' , ' . $lastDocument->more_info_req_2_on;
                // }
                // $history->current = $changeControl->more_info_req_2_by . ' , ' . $changeControl->more_info_req_2_on;
                $history->previous = "Not Applicable";
                $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "QC Head/HOD Initial Review";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage='More Information Required';
                $history->action='More Information Required';
                // if (is_null($lastDocument->more_info_req_2_by) || $lastDocument->more_info_req_2_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->action_name = 'Not Applicable';
                $history->save();
                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "More Information Required", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                 }
                //             );
                //         }
                // }

                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 4) {
                $changeControl->stage = "3";
                $changeControl->status = "QA Initial Review";
                $changeControl->more_info_req_3_by = Auth::user()->name;
                $changeControl->more_info_req_3_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_info_req_3_comment =$request->comment;
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                // $history->activity_type = 'More Information Required By, More Information Required On';
                // if (is_null($lastDocument->more_info_req_3_by) || $lastDocument->more_info_req_3_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->more_info_req_3_by . ' , ' . $lastDocument->more_info_req_3_on;
                // }
                // $history->current = $changeControl->more_info_req_3_by . ' , ' . $changeControl->more_info_req_3_on;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "QA Initial Review";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage='More Information Required';
                $history->action='More Information Required';
                // if (is_null($lastDocument->more_info_req_3_by) || $lastDocument->more_info_req_3_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->action_name = 'Not Applicable';
                $history->save();
                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "More Information Required", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                 }
                //             );
                //         }
                // }

                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 5) {
                $changeControl->stage = "4";
                $changeControl->status = "Pending Initiator Update";
                $changeControl->more_info_req_4_by = Auth::user()->name;
                $changeControl->more_info_req_4_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_info_req_4_comment =$request->comment;
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                // $history->activity_type = 'More Information Required By, More Information Required On';
                // if (is_null($lastDocument->more_info_req_4_by) || $lastDocument->more_info_req_4_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->more_info_req_4_by . ' , ' . $lastDocument->more_info_req_4_on;
                // }
                // $history->current = $changeControl->more_info_req_4_by . ' , ' . $changeControl->more_info_req_4_on;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "Pending Initiator Update";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage='More Information Required';
                $history->action='More Information Required';
                // if (is_null($lastDocument->more_info_req_4_by) || $lastDocument->more_info_req_4_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->action_name = 'Not Applicable';
                $history->save();
                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "More Information Required", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                 }
                //             );
                //         }
                // }

                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 6) {
                $changeControl->stage = "5";
                $changeControl->status = "QC Head/HOD Secondary Review";
                $changeControl->more_info_req_5_by = Auth::user()->name;
                $changeControl->more_info_req_5_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_info_req_5_comment =$request->comment;
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                // $history->activity_type = 'More Information Required By, More Information Required On';
                // if (is_null($lastDocument->more_info_req_5_by) || $lastDocument->more_info_req_5_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->more_info_req_5_by . ' , ' . $lastDocument->more_info_req_5_on;
                // }
                // $history->current = $changeControl->more_info_req_5_by . ' , ' . $changeControl->more_info_req_5_on;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "QC Head/HOD Secondary Review";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage='More Information Required';
                $history->action='More Information Required';
                // if (is_null($lastDocument->more_info_req_5_by) || $lastDocument->more_info_req_5_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->action_name = 'Not Applicable';
                $history->save();
                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "More Information Required", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                 }
                //             );
                //         }
                // }

                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 7) {
                $changeControl->stage = "6";
                $changeControl->status = "QA Secondary Review";
                $changeControl->more_info_req_6_by = Auth::user()->name;
                $changeControl->more_info_req_6_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_info_req_6_comment =$request->comment;
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                // $history->activity_type = 'More Information Required By, More Information Required On';
                // if (is_null($lastDocument->more_info_req_6_by) || $lastDocument->more_info_req_6_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->more_info_req_6_by . ' , ' . $lastDocument->more_info_req_6_on;
                // }
                // $history->current = $changeControl->more_info_req_6_by . ' , ' . $changeControl->more_info_req_6_on;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "QA Secondary Review";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage='More Information Required';
                $history->action='More Information Required';
                // if (is_null($lastDocument->more_info_req_6_by) || $lastDocument->more_info_req_6_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->action_name = 'Not Applicable';
                $history->save();
                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "More Information Required", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                 }
                //             );
                //         }
                // }

                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 8) {
                $changeControl->stage = "7";
                $changeControl->status = "QAH Approval";
                $changeControl->more_info_req_7_by = Auth::user()->name;
                $changeControl->more_info_req_7_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_info_req_7_comment =$request->comment;
                $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                // $history->activity_type = 'More Information Required By, More Information Required On';
                // if (is_null($lastDocument->more_info_req_7_by) || $lastDocument->more_info_req_7_by === '') {
                //     $history->previous = "";
                // } else {
                //     $history->previous = $lastDocument->more_info_req_7_by . ' , ' . $lastDocument->more_info_req_7_on;
                // }
                // $history->current = $changeControl->more_info_req_7_by . ' , ' . $changeControl->more_info_req_7_on;
                // $history->activity_type = 'Not Applicable';
                // $history->previous = "Not Applicable";
                // $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "QAH Approval";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage='More Information Required';
                $history->action='More Information Required';
                // if (is_null($lastDocument->more_info_req_7_by) || $lastDocument->more_info_req_7_by === '') {
                //     $history->action_name = 'New';
                // } else {
                //     $history->action_name = 'Update';
                // }
                $history->action_name = 'Not Applicable';
                $history->save();
                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "More Information Required", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Information Required");
                //                 }
                //             );
                //         }
                // }

                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 9) {
                $changeControl->stage = "8";
                $changeControl->status = "QA Head/HOD Final Review";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }
            if ($changeControl->stage == 10) {
                $changeControl->stage = "9";
                $changeControl->status = "QA Final Review";
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }

        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function LabIncidentCancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = LabIncident::find($id);
            $lastDocument = LabIncident::find($id);

            $changeControl->stage = "0";
            $changeControl->status = "Closed - Cancelled";
            $changeControl->cancelled_by = Auth::user()->name;
            $changeControl->cancelled_on = Carbon::now()->format('d-M-Y');
            $changeControl->cancell_comment =$request->comment;
            $history = new LabIncidentAuditTrial();
                $history->LabIncident_id = $id;
                $history->activity_type = 'Cancel By, Cancel On';
                if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->cancelled_by . ' , ' . $lastDocument->cancelled_on;
                }
                $history->current = $changeControl->cancelled_by . ' , ' . $changeControl->cancelled_on;
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "Opened";
                $history->change_from = $lastDocument->status;
                $history->origin_state = $lastDocument->status;
                $history->stage='Cancel';
                $history->action='Cancel';
                if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();
                // $list = Helpers::getCftUserList($changeControl->division_id); // Notify CFT Person
                // foreach ($list as $u) {
                //         $email = Helpers::getUserEmail($u->user_id);
                //             if ($email !== null) {
                //             Mail::send(
                //                 'mail.view-mail',
                //                 ['data' => $changeControl, 'site' => "LI", 'history' => "Cancel", 'process' => 'Lab Incident', 'comment' => $request->comment, 'user'=> Auth::user()->name],
                //                 function ($message) use ($email, $changeControl) {
                //                     $message->to($email)
                //                     ->subject("Agio Notification: Lab Incident, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Cancel");
                //                 }
                //             );
                //         }
                // }

            $changeControl->update();
            toastr()->success('Document Sent');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function LabIncidentAuditTrial($id)
    {
        $audit = LabIncidentAuditTrial::where('LabIncident_id', $id)->orderByDESC('id')->paginate();
        $today = Carbon::now()->format('d-m-y');
        $document = LabIncident::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
        // dd($document->initiator);
        $users = User::all();
        return view('frontend.labIncident.audit-trial', compact('audit', 'document', 'today','users'));
    }

    public function auditDetailsLabIncident($id)
    {

        $detail = LabIncidentAuditTrial::find($id);

        $detail_data = LabIncidentAuditTrial::where('activity_type', $detail->activity_type)->where('LabIncident_id', $detail->LabIncident_id)->latest()->get();

        $doc = LabIncident::where('id', $detail->LabIncident_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);
        return view('frontend.labIncident.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
    }


    public function root_cause_analysis(Request $request, $id)
    {
        return view("frontend.labIncident.root_cause_analysis");
    }


    public static function singleReport($id)
    {
        $data = LabIncident::find($id);
        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            // $labtab= Labincident_Second::where('lab_incident_id',$id)->get();
            $labgrid =lab_incidents_grid::where(['labincident_id' => $id,'identifier' => 'Incident Report'])->first();
            $labtab_grid =lab_incidents_grid::where(['labincident_id' => $id,'identifier'=> 'Sutability'])->first();
            $data->division = QMSDivision::where('id', $data->division_id)->value('name');
            $labtab = Labincident_Second::where('id', $id)->firstOrCreate();


            // dd($data->division);
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.labIncident.singleReport', compact('data','labtab','labgrid','labtab_grid'))
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
            return $pdf->stream('Lab-Incident' . $id . '.pdf');
        }
    }

    public static function auditReport($id)
    {
        $doc = LabIncident::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
            $data = LabIncidentAuditTrial::where('LabIncident_id', $id)->paginate(1000);

            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.labIncident.auditReport', compact('data', 'doc'))
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
            return $pdf->stream('LabIncident-AuditTrial' . $id . '.pdf');
        }
    }


    public function audit_trail_filter_lab_incident(Request $request, $id)
{
    // Start query for DeviationAuditTrail
    $query = LabIncidentAuditTrial::query();
    $query->where('LabIncident_id', $id);

    // Check if typedata is provided
    if ($request->filled('typedata')) {
        switch ($request->typedata) {
            case 'cft_review':
                // Filter by specific CFT review actions
                $cft_field = ['CFT Review Complete','CFT Review Not Required',];
                $query->whereIn('action', $cft_field);
                break;

            case 'stage':
                // Filter by activity log stage changes
                $stage=[  'Submit', 'HOD Review Complete', 'QA/CQA Initial Review Complete','Request For Cancellation',
                    'CFT Review Complete', 'QA/CQA Final Assessment Complete', 'Approved','Send to Initiator','Send to HOD','Send to QA/CQA Initial Review','Send to Pending Initiator Update',
                    'QA/CQA Final Review Complete', 'Rejected', 'Initiator Updated Complete',
                    'HOD Final Review Complete', 'More Info Required', 'Cancel','Implementation verification Complete','Closure Approved'];
                $query->whereIn('action', $stage); // Ensure correct activity_type value
                break;

            case 'user_action':
                // Filter by various user actions
                $user_action = [  'Submit', 'HOD Review Complete', 'QA/CQA Initial Review Complete','Request For Cancellation',
                    'CFT Review Complete', 'QA/CQA Final Assessment Complete', 'Approved','Send to Initiator','Send to HOD','Send to QA/CQA Initial Review','Send to Pending Initiator Update',
                    'QA/CQA Final Review Complete', 'Rejected', 'Initiator Updated Complete',
                    'HOD Final Review Complete', 'More Info Required', 'Cancel','Implementation verification Complete','Closure Approved'];
                $query->whereIn('action', $user_action);
                break;
                 case 'notification':
                // Filter by various user actions
                $notification = [];
                $query->whereIn('action', $notification);
                break;
                 case 'business':
                // Filter by various user actions
                $business = [];
                $query->whereIn('action', $business);
                break;

            default:
                break;
        }
    }

    // Apply additional filters
    if ($request->filled('user')) {
        $query->where('user_id', $request->user);
    }

    if ($request->filled('from_date')) {
        $query->whereDate('created_at', '>=', $request->from_date);
    }

    if ($request->filled('to_date')) {
        $query->whereDate('created_at', '<=', $request->to_date);
    }

    // Get the filtered results
    $audit = $query->orderByDesc('id')->get();

    // Flag for filter request
    $filter_request = true;

    // Render the filtered view and return as JSON
    $responseHtml = view('frontend.labincident.lab_incident_filter', compact('audit', 'filter_request'))->render();

    return response()->json(['html' => $responseHtml]);
}

public function store_audit_review_lab(Request $request, $id)
{
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

}
