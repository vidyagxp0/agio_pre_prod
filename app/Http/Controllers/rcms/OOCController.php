<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\OutOfCalibration;
use App\Models\RecordNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OOCController extends Controller
{
    public function index()
    {
        return view('frontend.OOC.out_of_calibration');
    }

    public function ooc()
    {


        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');




	return view('frontend.OOC.out_of_calibration', compact('due_date', 'record_number'));
    }

    public function create(request $request)
    {
        // return dd($request->all());
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
        $data->Initiator_Group= $request->Initiator_Group;
        $data->initiator_group_code= $request->initiator_group_code;
        $data->initiated_through = $request->initiated_through;
        $data->initiated_if_other= $request->initiated_if_other;
        $data->is_repeat_ooc= $request->is_repeat_ooc;
        $data->Repeat_Nature= $request->Repeat_Nature;
        $data->ooc_due_date= $request->ooc_due_date;
        $data->Delay_Justification_for_Reporting= $request->Delay_Justification_for_Reporting;
        $data->HOD_Remarks = $request->HOD_Remarks;
        // $data->attachments_hod_ooc = $request->attachments_hod_ooc;
        $data->Immediate_Action_ooc = $request->Immediate_Action_ooc;
        $data->Preliminary_Investigation_ooc = $request->Preliminary_Investigation_ooc;
        $data->qa_comments_ooc = $request->qa_comments_ooc;
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
        $data->is_repeat_stae_ooc = $request->is_repeat_stae_ooc;
        $data->qa_comments_stage_ooc = $request->qa_comments_stage_ooc;
        $data->additional_remarks_stage_ooc = $request->additional_remarks_stage_ooc;
        $data->is_repeat_stageii_ooc = $request->is_repeat_stageii_ooc;
        $data->is_repeat_stage_instrument_ooc = $request->is_repeat_stage_instrument_ooc;
        $data->is_repeat_proposed_stage_ooc = $request->is_repeat_proposed_stage_ooc;
        // $data->initial_attachment_stageii_ooc = $request->initial_attachment_stageii_ooc;
        $data->is_repeat_compiled_stageii_ooc = $request->is_repeat_compiled_stageii_ooc;
        $data->is_repeat_realease_stageii_ooc = $request->is_repeat_realease_stageii_ooc;
        $data->initiated_throug_stageii_ooc = $request->initiated_throug_stageii_ooc;
        $data->initiated_through_stageii_ooc = $request->initiated_through_stageii_ooc;
        $data->is_repeat_reanalysis_stageii_ooc = $request->is_repeat_reanalysis_stageii_ooc;
        $data->initiated_through_stageii_cause_failure_ooc = $request->initiated_through_stageii_cause_failure_ooc;
        $data->is_repeat_capas_ooc = $request->is_repeat_capas_ooc;
        $data->initiated_through_capas_ooc = $request->initiated_through_capas_ooc;
        $data->initiated_through_capa_prevent_ooc = $request->initiated_through_capa_prevent_ooc;
        $data->initiated_through_capa_corrective_ooc = $request->initiated_through_capa_corrective_ooc;
        $data->initiated_through_capa_ooc = $request->initiated_through_capa_ooc;
        $data->short_description_closure_ooc = $request->short_description_closure_ooc;
        $data->document_code_closure_ooc = $request->document_code_closure_ooc;
        $data->remarks_closure_ooc = $request->remarks_closure_ooc;
        $data->initiated_through_closure_ooc = $request->initiated_through_closure_ooc;
        $data->initiated_through_hodreview_ooc = $request->initiated_through_hodreview_ooc;
        $data->initiated_through_rootcause_ooc = $request->initiated_through_rootcause_ooc;
        $data->initiated_through_impact_closure_ooc = $request->initiated_through_impact_closure_ooc;


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
                    $name = $request->name . 'attachments_stage_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->attachments_stage_ooc = json_encode($files);
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
                    $name = $request->name . 'initial_attachment_capa_post_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_capa_post_ooc = json_encode($files);
        }

        if (!empty($request->initial_attachment_capa_ooc)) {
            $files = [];
            if ($request->hasfile('initial_attachment_capa_ooc')) {
                foreach ($request->file('initial_attachment_capa_ooc') as $file) {
                    $name = $request->name . 'initial_attachment_capa_ooc' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] = $name;
                }
            }
            $data->initial_attachment_capa_ooc = json_encode($files);
        }


        $data->save();




        toastr()->success('Record is created Successfully');

        return redirect('rcms/qms-dashboard');


        // return $data;

    }

    public function edit(){
        return view('frontend.OOC.ooc_view');
    }

}
