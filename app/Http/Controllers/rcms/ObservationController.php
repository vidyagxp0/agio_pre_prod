<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\AuditTrialObservation;
use App\Models\Observation;
use App\Models\RecordNumber;
use App\Models\User;
use App\Models\OpenStage;
use App\Models\Capa;
use Carbon\Carbon;
use Helpers;
use App\Models\RoleGroup;
use App\Models\ObservationGrid;
use App\Models\InternalAuditGrid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use PDF;
use Illuminate\Support\Facades\Session;


class ObservationController extends Controller
{

    public function observation()
    {
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        return view('frontend.forms.observation', compact('due_date', 'record_number'));
    }


    public function observationstore(Request $request)
    {
        if (!$request->short_description) {
            toastr()->error("Short description is required");
            //return redirect()->back();
        }
        $data = new Observation();
        // dd($data);

        $data->record = ((RecordNumber::first()->value('counter')) + 1);
        $data->initiator_id = Auth::user()->id;
        $data->parent_id = $request->parent_id;
        $data->parent_type = $request->parent_type;
        $data->division_code = $request->division_id;
        $data->record_number = $request->record_number;
        $data->intiation_date = $request->intiation_date;
        $data->due_date = $request->due_date;
        $data->short_description = $request->short_description;
        $data->assign_to = $request->assign_to;
        $data->grading = $request->grading;
        $data->category_observation = $request->category_observation;
        $data->reference_guideline = $request->reference_guideline;
        $data->description = $request->description;
        $data->auditee_department = $request->auditee_department;
        $data->response_detail = $request->response_detail;
        $data->corrective_action = $request->corrective_action;
        $data->preventive_action = $request->preventive_action;

        if(!empty($request->attach_files_gi)){
            $files = [];
            if ($request->hasFile('attach_files_gi')) {
                foreach ($request->file('attach_files_gi') as $file) {
                    $name = $request->name . 'attach_files_gi' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $files[] = $name;
                }
            }
            $data->attach_files_gi = json_encode($files);
        }
        
        if(!empty($request->response_capa_attach)){
            $files = [];
            if ($request->hasFile('response_capa_attach')) {
                foreach ($request->file('response_capa_attach') as $file) {
                    $name = $request->name . 'response_capa_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $files[] = $name;
                }
            }
            $data->response_capa_attach = json_encode($files);
        }

        // $files = [];
        // if ($request->hasFile('attach_files_gi')) {
        //     foreach ($request->file('attach_files_gi') as $file) {
        //         $name = $request->name . 'attach_files_gi' . uniqid() . '.' . $file->getClientOriginalExtension();
        //         $file->move(public_path('upload/'), $name);
        //         $files[] = $name;
        //     }
        // }
        // $data->attach_files_gi = json_encode($files);

        $data->recomendation_capa_date_due = $request->recomendation_capa_date_due;
        $data->audit_response_date = $request->audit_response_date;
        $data->non_compliance = $request->non_compliance;
        $data->recommend_action = $request->recommend_action;
        $data->date_Response_due2 = $request->date_Response_due2;
        $data->capa_date_due = $request->capa_date_due;
        $data->assign_to2 = $request->assign_to2;
        $data->cro_vendor = $request->cro_vendor;
        $data->comments = $request->comments;
        $data->impact = $request->impact;
        $data->impact_analysis = $request->impact_analysis;
        $data->severity_rate = $request->severity_rate;
        // dd($request->severity_rate);

        $severity = [
            '1' => 'Negligible',
            '2' => 'Moderate',
            '3' => 'Major',
            '4' => 'Fatal',
        ];
        if (isset($data->severity_rate) && array_key_exists($data->severity_rate, $severity)) {
            $data->severity_rate = $severity[$data->severity_rate];
        } else {
            $data->severity_rate = '';
        }
        if ($request->has('severity_rate') && array_key_exists($request->severity_rate, $severity)) {
            $data->severity_rate = $severity[$request->severity_rate];
        }


        // $data->occurrence = $request->occurrence;
        $Occurance = [
            '5' => 'Extremely Unlikely',
            '4' => 'Rare',
            '3' => 'Unlikely',
            '2' => 'Likely',
            '1' => 'Very Likely',
        ];
        if (isset($data->occurrence) && array_key_exists($data->occurrence, $Occurance)) {
            $data->occurrence = $Occurance[$data->occurrence];
        } else {
            $data->occurrence = '';
        }
        if ($request->has('occurrence') && array_key_exists($request->occurrence, $Occurance)) {
            $data->occurrence = $Occurance[$request->occurrence];
        }

        // $data->detection = $request->detection;
        $Detection = [
            '5' => 'Impossible',
            '4' => 'Rare',
            '3' => 'Unlikely',
            '2' => 'Likely',
            '1' => 'Very Likely',
        ];
        if (isset($data->detection) && array_key_exists($data->detection, $Detection)) {
            $data->detection = $Detection[$data->detection];
        } else {
            $data->detection = '';
        }
        if ($request->has('detection') && array_key_exists($request->detection, $Detection)) {
            $data->detection = $Detection[$request->detection];
        }
        $data->analysisRPN = $request->analysisRPN;
        $data->actual_start_date = $request->actual_start_date;
        $data->actual_end_date = $request->actual_end_date;
        $data->action_taken = $request->action_taken;
        $data->date_response_due1= $request->date_response_due1;

        $data->response_date = $request->response_date;
        // $data->attach_files2 = $request->attach_files2;
        $data->related_url = $request->related_url;
        $data->response_summary = $request->response_summary;

        // if ($request->hasfile('related_observations')) {
        //     $image = $request->file('related_observations');
        //     $ext = $image->getClientOriginalExtension();
        //     $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;
        //     $image->move('upload/document/', $image_name);
        //     $data->related_observations = $image_name;
        // }
        // if (!empty($request->related_observations)) {
        //     $files = [];
        //     if ($request->hasfile('related_observations')) {
        //         foreach ($request->file('related_observations') as $file) {
        //             $name = $request->name . 'related_observations' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }

        //     $data->related_observations = json_encode($files);
        // }
        if(!empty($request->related_observations)){
        $files = [];
        if ($request->hasFile('related_observations')) {
            foreach ($request->file('related_observations') as $file) {
                $name = $request->name . 'related_observations' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/'), $name);
                $files[] = $name;
            }
        }
        $data->related_observations = json_encode($files);
    }

        // if (!empty($request->attach_files2)) {
        //     $files = [];
        //     if ($request->hasfile('attach_files2')) {
        //         foreach ($request->file('attach_files2') as $file) {
        //             $name = $request->name . 'attach_files2' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }

        //     $data->attach_files2 = json_encode($files);
        // }
if(!empty($request->attach_files2)){
        $files = [];
        if ($request->hasFile('attach_files2')) {
            foreach ($request->file('attach_files2') as $file) {
                $name = $request->name . 'attach_files2' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/'), $name);
                $files[] = $name;
            }
        }

        $data->attach_files2 = json_encode($files);

    }
    if(!empty($request->impact_analysis)){
        $files = [];
        if ($request->hasFile('impact_analysis')) {
            foreach ($request->file('impact_analysis') as $file) {
                $name = $request->name . 'impact_analysis' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/'), $name);
                $files[] = $name;
            }
        }
        $data->impact_analysis = json_encode($files);
    }
        $data->status = 'Opened';
        $data->stage = 1;
        $data->save();

        $data1 = new ObservationGrid();
        $data1->observation_id = $data->id;
        if (!empty($request->action)) {
            $data1->action = serialize($request->action);
        }
        if (!empty($request->responsible)) {
            $data1->responsible = serialize($request->responsible);
        }
        if (!empty($request->item_status)) {
            $data1->item_status = serialize($request->item_status);
        }
        if (!empty($request->deadline)) {
            $data1->deadline = serialize($request->deadline);
        }
        $data1->save();

        $record = RecordNumber::first();
        $record->counter = ((RecordNumber::first()->value('counter')) + 1);
        $record->update();

        // if (!empty($data->parent_id)) {
        // $history = new AuditTrialObservation();
        // $history->Observation_id = $data->id;
        // $history->activity_type = 'Parent Id';
        // $history->previous = "Null";
        // $history->current = $data->parent_id;
        // $history->comment = "NA";
        // $history->user_id = Auth::user()->id;
        // $history->user_name = Auth::user()->name;
        // $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        // $history->origin_state = $data->status;
        // $history->change_to =   "Opened";
        // $history->change_from = "Initiator";
        // $history->action_name = 'Create';
        // $history->save();
        // }
    //     if (!empty($data->parent_type)) {
    //     $history = new AuditTrialObservation();
    //     $history->Observation_id = $data->id;
    //     $history->activity_type = 'Parent Type';
    //     $history->previous = "Null";
    //     $history->current = $data->parent_type;
    //     $history->comment = "NA";
    //     $history->user_id = Auth::user()->id;
    //     $history->user_name = Auth::user()->name;
    //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    //     $history->origin_state = $data->status;
    //     $history->change_to =   "Opened";
    //     $history->change_from = "Initiator";
    //     $history->action_name = 'Create';
    //     $history->save();
    // }
    if (!empty($data->record_number)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Record Number';
        $history->previous = "Null";
        $history->current = $request->record_number;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }

    if (!empty($data->initiator_id)) {
        // dd(Auth::user()->name);
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Initiator';
        $history->previous = "Null";
        $history->current = Auth::user()->name;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }

    if (!empty($data->division_code)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Site/Location Code';
        $history->previous = "Null";
        $history->current = Helpers::getDivisionName($data->division_code);
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }
    if (!empty($data->intiation_date)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Date of Initiation';
        $history->previous ="Null";
        $history->current =  Helpers::getdateFormat($data->intiation_date);
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }
    if (!empty($data->due_date)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Observation Due Date';
        $history->previous ="Null";
        $history->current =  Helpers::getdateFormat($data->due_date);
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }
    if (!empty($data->assign_to)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Auditee Department Head';
        $history->previous = "Null";
        $history->current = Helpers::getInitiatorName($data->assign_to);
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }
    
    if (!empty($data->auditee_department)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Auditee Department Name';
        $history->previous = "Null";
        $history->current = $data->auditee_department;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }
    if (!empty($data->short_description)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Short Description';
        $history->previous = "Null";
        $history->current = $data->short_description;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }

  
    if (!empty($data->attach_files_gi)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Attached Files';
        $history->previous = "Null";
        $history->current = $data->attach_files_gi;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }

    if (!empty($data->recomendation_capa_date_due)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Response Due Date';
        $history->previous = "Null";
        $history->current = $data->recomendation_capa_date_due;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }

    if (!empty($data->non_compliance)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Observation (+)';
        $history->previous = "Null";
        $history->current = $data->non_compliance;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }

    if (!empty($data->response_detail)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Response Details (+)';
        $history->previous = "Null";
        $history->current = $data->response_detail;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }

    if (!empty($data->corrective_action)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Corrective Actions (+)';
        $history->previous = "Null";
        $history->current = $data->corrective_action;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }

    if (!empty($data->preventive_action)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Preventive Action (+)';
        $history->previous = "Null";
        $history->current = $data->preventive_action;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }

    if (!empty($data->comments)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Comments';
        $history->previous = "Null";
        $history->current = $data->comments;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }

    
    if (!empty($data->response_capa_attach)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Response and CAPA Attachments';
        $history->previous = "Null";
        $history->current = $data->response_capa_attach;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }
        
    if (!empty($data->actual_start_date)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Actual Action Start Date';
        $history->previous = "Null";
        $history->current = Helpers::getdateFormat($data->actual_start_date);
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }
        
    if (!empty($data->actual_end_date)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Actual Action End Date';
        $history->previous = "Null";
        $history->current = Helpers::getdateFormat($data->actual_end_date);
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }
        
    if (!empty($data->action_taken)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Action Taken';
        $history->previous = "Null";
        $history->current = $data->action_taken;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }
        
    if (!empty($data->response_summary)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Response Summary';
        $history->previous = "Null";
        $history->current = $data->response_summary;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }
       
    if (!empty($data->attach_files2)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Response Verification Attachements';
        $history->previous = "Null";
        $history->current = $data->attach_files2;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }
       
    if (!empty($data->related_url)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Related URL';
        $history->previous = "Null";
        $history->current = $data->related_url;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }
       
    if (!empty($data->impact)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Response Verification Comment';
        $history->previous = "Null";
        $history->current = $data->impact;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }

    if (!empty($data->impact_analysis)) {
        $history = new AuditTrialObservation();
        $history->Observation_id = $data->id;
        $history->activity_type = 'Response and Summary Attachment';
        $history->previous = "Null";
        $history->current = $data->impact_analysis;
        $history->comment = "NA";
        $history->user_id = Auth::user()->id;
        $history->user_name = Auth::user()->name;
        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        $history->origin_state = $data->status;
        $history->change_to =   "Opened";
        $history->change_from = "Initiation";
        $history->action_name = 'Create';
        $history->save();
    }

        toastr()->success("Record is created Successfully");
        return redirect(url('rcms/qms-dashboard'));
    }


    public function observationupdate(Request $request, $id)
    {


        $data = Observation::find($id);
        $lastDocument = Observation::find($id);
        $data = Observation::find($id);
        $data->initiator_id = Auth::user()->id;
        $data->parent_id = $request->parent_id;
        $data->parent_type = $request->parent_type;
        // $data->division_code = $request->division_code;
        // $data->intiation_date = $request->intiation_date;
        // $data->due_date = $request->due_date;
        $data->short_description = $request->short_description;
        $data->assign_to = $request->assign_to;
        $data->grading = $request->grading;
        $data->category_observation = $request->category_observation;
        $data->reference_guideline = $request->reference_guideline;
        $data->description = $request->description;

        $data->auditee_department = $request->auditee_department;
        $data->response_detail = $request->response_detail;
        $data->corrective_action = $request->corrective_action;
        $data->preventive_action = $request->preventive_action;

        if(!empty($request->attach_files_gi)){
            $files = [];
            if ($request->hasFile('attach_files_gi')) {
                foreach ($request->file('attach_files_gi') as $file) {
                    $name = $request->name . 'attach_files_gi' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $files[] = $name;
                }
            }
            $data->attach_files_gi = json_encode($files);
        }
        
        if(!empty($request->response_capa_attach)){
            $files = [];
            if ($request->hasFile('response_capa_attach')) {
                foreach ($request->file('response_capa_attach') as $file) {
                    $name = $request->name . 'response_capa_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $files[] = $name;
                }
            }
            $data->response_capa_attach = json_encode($files);
        }

        // $files = [];
        // if ($request->hasFile('attach_files_gi')) {
        //     foreach ($request->file('attach_files_gi') as $file) {
        //         $name = $request->name . 'attach_files_gi' . uniqid() . '.' . $file->getClientOriginalExtension();
        //         $file->move(public_path('upload/'), $name);
        //         $files[] = $name;
        //     }
        //     $data->attach_files_gi = json_encode($files);
        // } else {
        //     if (isset($data->attach_files_gi)) {
        //         $files = json_decode($data->attach_files_gi, true);
        //     }
        // }

        // if(!empty($request->attach_files_gi)) {
        //     $files = [];
        //     if ($request->hasFile('attach_files_gi')) {
        //         foreach ($request->file('attach_files_gi') as $file) {
        //             $name = $request->name . 'attach_files_gi' . uniqid() . '.' . $file->getClientOriginalExtension();
        //             $file->move(public_path('upload/'), $name);
        //             $files[] = $name;
        //         }
        //     }
        //     $data->attach_files_gi = json_encode($files);
        // } else {
        //     // Handle case when no new files are added, but some might have been removed
        //     if ($request->input('current_files')) {
        //         $data->attach_files_gi = json_encode($request->input('current_files'));
        //     }
        // }



        $data->recomendation_capa_date_due = $request->recomendation_capa_date_due;
        $data->audit_response_date = $request->audit_response_date;
        $data->non_compliance = $request->non_compliance;
        $data->recommend_action = $request->recommend_action;
        $data->date_Response_due2 = $request->date_Response_due2;
        $data->capa_date_due = $request->capa_date_due11;
        $data->assign_to2 = $request->assign_to2;
        $data->cro_vendor = $request->cro_vendor;
        $data->comments = $request->comments;
        $data->impact = $request->impact;
        // $data->impact_analysis = $request->impact_analysis;
        
        if(!empty($request->impact_analysis)){
            $files = [];
            if ($request->hasFile('impact_analysis')) {
                foreach ($request->file('impact_analysis') as $file) {
                    $name = $request->name . 'impact_analysis' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('upload/'), $name);
                    $files[] = $name;
                }
            }
            $data->impact_analysis = json_encode($files);
        }
        // $data->severity_rate = $request->severity_rate;
        $severity = [
            '1' => 'Negligible',
            '2' => 'Moderate',
            '3' => 'Major',
            '4' => 'Fatal',
        ];
        if (isset($data->severity_rate) && array_key_exists($data->severity_rate, $severity)) {
            $data->severity_rate = $severity[$data->severity_rate];
        } else {
            $data->severity_rate = '';
        }
        if ($request->has('severity_rate') && array_key_exists($request->severity_rate, $severity)) {
            $data->severity_rate = $severity[$request->severity_rate];
        }

        // $data->occurrence = $request->occurrence;
        $Occurance = [
            '5' => 'Extremely Unlikely',
            '4' => 'Rare',
            '3' => 'Unlikely',
            '2' => 'Likely',
            '1' => 'Very Likely',
        ];
        if (isset($data->occurrence) && array_key_exists($data->occurrence, $Occurance)) {
            $data->occurrence = $Occurance[$data->occurrence];
        } else {
            $data->occurrence = '';
        }
        if ($request->has('occurrence') && array_key_exists($request->occurrence, $Occurance)) {
            $data->occurrence = $Occurance[$request->occurrence];
        }

        // $data->detection = $request->detection;
        $Detection = [
            '5' => 'Impossible',
            '4' => 'Rare',
            '3' => 'Unlikely',
            '2' => 'Likely',
            '1' => 'Very Likely',
        ];
        if (isset($data->detection) && array_key_exists($data->detection, $Detection)) {
            $data->detection = $Detection[$data->detection];
        } else {
            $data->detection = '';
        }
        if ($request->has('detection') && array_key_exists($request->detection, $Detection)) {
            $data->detection = $Detection[$request->detection];
        }
        $data->analysisRPN = $request->analysisRPN;
        $data->actual_start_date = $request->actual_start_date;
        $data->actual_end_date = $request->actual_end_date;
        $data->action_taken = $request->action_taken;

         $data->date_response_due1 = $request->date_Response_due22;
        // $data->date_response_due1 = $request->date_response_due1;
        $data->response_date = $request->response_date;
        // $data->attach_files2 = $request->attach_files2;
        $data->related_url = $request->related_url;
        $data->response_summary = $request->response_summary;

        // if ($request->hasfile('related_observations')) {
        //     $image = $request->file('related_observations');
        //     $ext = $image->getClientOriginalExtension();
        //     $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;
        //     $image->move('upload/document/', $image_name);
        //     $data->related_observations = $image_name;
        // }
        if (!empty($request->related_observations)) {
        $files = [];
        if ($request->hasFile('related_observations')) {
            foreach ($request->file('related_observations') as $file) {
                $name = $request->name . 'related_observations' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/'), $name);
                $files[] = $name;
            }
        }
        $data->related_observations = json_encode($files);
    }
        // if (!empty($request->related_observations)) {
        //     $files = [];
        //     if ($request->hasfile('related_observations')) {
        //         foreach ($request->file('related_observations') as $file) {
        //             $name = $request->name . 'related_observations' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }

        //     $data->related_observations = json_encode($files);
        // }
        // if ($request->hasfile('attach_files2')) {
        //     $image = $request->file('attach_files2');
        //     $ext = $image->getClientOriginalExtension();
        //     $image_name = date('y-m-d') . '-' . rand() . '.' . $ext;
        //     $image->move('upload/document/', $image_name);
        //     $data->attach_files2 = $image_name;
        // }

        if (!empty($request->attach_files2)) {
        $files = [];
        if ($request->hasFile('attach_files2')) {
            foreach ($request->file('attach_files2') as $file) {
                $name = $request->name . 'attach_files2' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/'), $name);
                $files[] = $name;
            }
        }
        $data->attach_files2 = json_encode($files);
    }
        // if (!empty($request->attach_files2)) {
        //     $files = [];
        //     if ($request->hasfile('attach_files2')) {
        //         foreach ($request->file('attach_files2') as $file) {
        //             $name = $request->name . 'attach_files2' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
        //             $file->move('upload/', $name);
        //             $files[] = $name;
        //         }
        //     }

        //     $data->attach_files2 = json_encode($files);
        // }

        // $data->status = 'Opened';
        // $data->stage = 1;
        $data->update();

        $data1 = ObservationGrid::find($id);
        $data1->observation_id = $data->id;
        if (!empty($request->action)) {
            $data1->action = serialize($request->action);
        }
        if (!empty($request->responsible)) {
            $data1->responsible = serialize($request->responsible);
        }
        if (!empty($request->item_status)) {
            $data1->item_status = serialize($request->item_status);
        }
        if (!empty($request->deadline)) {
            $data1->deadline = serialize($request->deadline);
        }
        $data1->update();

        if ($lastDocument->assign_to != $data->assign_to || !empty($request->assign_to_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Auditee Department Head';
            $history->previous = Helpers::getInitiatorName($lastDocument->assign_to);
            $history->current = Helpers::getInitiatorName($data->assign_to);
            $history->comment = $request->assign_to_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->assign_to) || $lastDocument->assign_to === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->auditee_department != $data->auditee_department || !empty($request->auditee_department_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Auditee Department Name';
            $history->previous = $lastDocument->auditee_department;
            $history->current = $data->auditee_department;
            $history->comment = $request->auditee_department_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->auditee_department) || $lastDocument->auditee_department === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->short_description != $data->short_description || !empty($request->short_description_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Short Description';
            $history->previous = $lastDocument->short_description;
            $history->current = $data->short_description;
            $history->comment = $request->short_description_comment;
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

        if ($lastDocument->attach_files_gi != $data->attach_files_gi || !empty($request->attach_files_gi_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Attached files';
            $history->previous = $lastDocument->attach_files_gi;
            $history->current = $data->attach_files_gi;
            $history->comment = $request->attach_files_gi_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->attach_files_gi) || $lastDocument->attach_files_gi === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->recomendation_capa_date_due != $data->recomendation_capa_date_due || !empty($request->actual_start_date_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Response due date ';
            $history->previous = Helpers::getdateFormat($lastDocument->recomendation_capa_date_due);
            $history->current = Helpers::getdateFormat($data->recomendation_capa_date_due);
            $history->comment = $request->actual_start_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->recomendation_capa_date_due) || $lastDocument->recomendation_capa_date_due === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
     

        
        if ($lastDocument->non_compliance != $data->non_compliance || !empty($request->actual_start_date_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Observation (+)';
            $history->previous = $lastDocument->non_compliance;
            $history->current = $data->non_compliance;
            $history->comment = $request->actual_start_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->non_compliance) || $lastDocument->non_compliance === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->response_detail != $data->response_detail || !empty($request->actual_start_date_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Response Details (+)';
            $history->previous = $lastDocument->response_detail;
            $history->current = $data->response_detail;
            $history->comment = $request->actual_start_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->response_detail) || $lastDocument->response_detail === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastDocument->corrective_action != $data->corrective_action || !empty($request->actual_start_date_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Corrective Actions (+)';
            $history->previous = $lastDocument->corrective_action;
            $history->current = $data->corrective_action;
            $history->comment = $request->actual_start_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->corrective_action) || $lastDocument->corrective_action === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->preventive_action != $data->preventive_action || !empty($request->actual_start_date_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Preventive Action (+)';
            $history->previous = $lastDocument->preventive_action;
            $history->current = $data->preventive_action;
            $history->comment = $request->actual_start_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->preventive_action) || $lastDocument->preventive_action === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastDocument->comments != $data->comments || !empty($request->actual_start_date_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Comments';
            $history->previous = $lastDocument->comments;
            $history->current = $data->comments;
            $history->comment = $request->actual_start_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->comments) || $lastDocument->comments === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->response_capa_attach != $data->response_capa_attach || !empty($request->actual_start_date_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Response and CAPA Attachments';
            $history->previous = $lastDocument->response_capa_attach;
            $history->current = $data->response_capa_attach;
            $history->comment = $request->actual_start_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->response_capa_attach) || $lastDocument->response_capa_attach === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }



        if ($lastDocument->actual_start_date != $data->actual_start_date || !empty($request->actual_start_date_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Actual Action Start Date ';
            $history->previous = Helpers::getdateFormat($lastDocument->actual_start_date);
            $history->current = Helpers::getdateFormat($data->actual_start_date);
            $history->comment = $request->actual_start_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->actual_start_date) || $lastDocument->actual_start_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastDocument->actual_end_date != $data->actual_end_date || !empty($request->actual_end_date_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Actual Action End Date ';
            $history->previous =  Helpers::getdateFormat($lastDocument->actual_end_date);
            $history->current = Helpers::getdateFormat($data->actual_end_date);
            $history->comment = $request->actual_end_date_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->actual_end_date) || $lastDocument->actual_end_date === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
        if ($lastDocument->action_taken != $data->action_taken || !empty($request->action_taken_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Action Taken ';
            $history->previous = $lastDocument->action_taken;
            $history->current = $data->action_taken;
            $history->comment = $request->action_taken_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->action_taken) || $lastDocument->action_taken === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
      
        if ($lastDocument->response_summary != $data->response_summary || !empty($request->action_taken_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Response Summary ';
            $history->previous = $lastDocument->response_summary;
            $history->current = $data->response_summary;
            $history->comment = $request->action_taken_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->response_summary) || $lastDocument->response_summary === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }
      
        if ($lastDocument->attach_files2 != $data->attach_files2 || !empty($request->action_taken_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Response Verification Attachements ';
            $history->previous = $lastDocument->attach_files2;
            $history->current = $data->attach_files2;
            $history->comment = $request->action_taken_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->attach_files2) || $lastDocument->attach_files2 === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->related_url != $data->related_url || !empty($request->action_taken_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Related URL ';
            $history->previous = $lastDocument->related_url;
            $history->current = $data->related_url;
            $history->comment = $request->action_taken_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->related_url) || $lastDocument->related_url === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        if ($lastDocument->impact != $data->impact || !empty($request->action_taken_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Response Verification Comment';
            $history->previous = $lastDocument->impact;
            $history->current = $data->impact;
            $history->comment = $request->action_taken_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->impact) || $lastDocument->impact === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }


        if ($lastDocument->impact_analysis != $data->impact_analysis || !empty($request->action_taken_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Response and Summary Attachment';
            $history->previous = $lastDocument->impact_analysis;
            $history->current = $data->impact_analysis;
            $history->comment = $request->action_taken_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->impact_analysis) || $lastDocument->impact_analysis === '') {
                $history->action_name = "New";
            } else {
                $history->action_name = "Update";
            }
            $history->save();
        }

        toastr()->success("Record is updated successfully");
        return back();
    }

    public function observationshow($id)
    {
        $data = Observation::find($id);
        $data->record = str_pad($data->record, 4, '0', STR_PAD_LEFT);
        $data->assign_to_name = User::where('id', $data->assign_id)->value('name');
        $data->initiator_name = User::where('id', $data->initiator_id)->value('name');
        $grid_data = InternalAuditGrid::where('audit_id', $id)->where('type', "external_audit")->first();
        $griddata = ObservationGrid::where('observation_id',$data->id)->first();
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        // return $data;
        return view('frontend.observation.view', compact('data','griddata','grid_data','due_date'));
    }
    public function observation_send_stage(Request $request, $id)
    {


        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changestage = Observation::find($id);
            $lastDocument = Observation::find($id);
            $capaRequired = $request->capaNotReq;
            // dd($capaRequired);
            if ($changestage->stage == 1) {
                $changestage->stage = "2";
                $changestage->status = "Pending Response";
                $changestage->report_issued_by = Auth::user()->name;
                $changestage->report_issued_on = Carbon::now()->format('d-M-Y');
                $changestage->report_issued_comment = $request->comment;
                $history = new AuditTrialObservation();
                $history->Observation_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changestage->submitted_by;
                $history->comment = $request->comment;
                $history->action = 'Report Issued';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Pending Response";
                $history->change_from = $lastDocument->status;
                // $history->stage = '';
                // $history->stage = '2';

                $history->activity_type = 'Report Issued By, Report Issued On';
                if (is_null($lastDocument->report_issued_by) || $lastDocument->report_issued_on === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->report_issued_by . ' , ' . $lastDocument->report_issued_on;
                }
                $history->current = $changestage->report_issued_by . ' , ' . $changestage->report_issued_on;
                if (is_null($lastDocument->report_issued_by) || $lastDocument->report_issued_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
                $history->save();

                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if($capaRequired == "Yes"){
                if ($changestage->stage == 2) {
                    if (empty($changestage->response_detail))
                    {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'Response and CAPA Tab is yet to be filled'
                        ]);
    
                        return redirect()->back();
                    }
                     else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for Response Verification state'
                        ]);
                    }
                    $changestage->stage = "3";
                    $changestage->status = "Response Verification";
                    $changestage->complete_By = Auth::user()->name;
                    $changestage->complete_on = Carbon::now()->format('d-M-Y');
                    $changestage->complete_comment = $request->comment;

                    $history = new AuditTrialObservation();
                    $history->Observation_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->current = $changestage->submitted_by;
                    $history->comment = $request->comment;
                    $history->action = 'CAPA Plan Proposed';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Response Verification";
                    $history->change_from = $lastDocument->status;
                    // $history->stage = '';
                    $history->activity_type = 'CAPA Plan Proposed By, CAPA Plan Proposed On';
                    if (is_null($lastDocument->complete_By) || $lastDocument->complete_on === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->complete_By . ' , ' . $lastDocument->complete_on;
                    }
                    $history->current = $changestage->complete_By . ' , ' . $changestage->complete_on;
                    if (is_null($lastDocument->complete_By) || $lastDocument->complete_By === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
                    $history->save();
                    $changestage->update();
                    toastr()->success('Document Sent');
                    return back();
                }
            } else {
                if ($changestage->stage == 2) {
                    if (empty($changestage->response_detail))
                    {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'Response and CAPA Tab is yet to be filled'
                        ]);
    
                        return redirect()->back();
                    }
                     else {
                        Session::flash('swal', [
                            'type' => 'success',
                            'title' => 'Success',
                            'message' => 'Sent for Response Verification state'
                        ]);
                    }
                    $changestage->stage = "3";
                    $changestage->status = "Response Verification";
                    $changestage->qa_approval_without_capa_by = Auth::user()->name;
                    $changestage->qa_approval_without_capa_on = Carbon::now()->format('d-M-Y');
                    $changestage->qa_approval_without_capa_comment = $request->comment;
    
                     $history = new AuditTrialObservation();
                    $history->Observation_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->previous = "";
                    $history->current = $changestage->submitted_by;
                    $history->comment = $request->comment;
                    $history->action = 'No CAPAs Required';
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastDocument->status;
                    $history->change_to =   "Closed - Done";
                    $history->change_from = $lastDocument->status;
                    // $history->stage = '';
                    $history->activity_type = 'No CAPAs Required By, No CAPAs Required On';
                    if (is_null($lastDocument->qa_approval_without_capa_by) || $lastDocument->qa_approval_without_capa_on === '') {
                        $history->previous = "";
                    } else {
                        $history->previous = $lastDocument->qa_approval_without_capa_by . ' , ' . $lastDocument->qa_approval_without_capa_on;
                    }
                    $history->current = $changestage->qa_approval_without_capa_by . ' , ' . $changestage->qa_approval_without_capa_on;
                    if (is_null($lastDocument->qa_approval_without_capa_by) || $lastDocument->qa_approval_without_capa_by === '') {
                        $history->action_name = 'New';
                    } else {
                        $history->action_name = 'Update';
                    }
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
                $history->save();
                    $changestage->update();
                    toastr()->success('Document Sent');
                    return back();
                }
            }           
            
            
            if ($changestage->stage == 3) {
                if (empty($changestage->impact))
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
                        'message' => 'Sent for Closed - Done state'
                    ]);
                }
                $changestage->stage = "4";
                $changestage->status = "Closed - Done";
                $changestage->Final_Approval_By = Auth::user()->name;
                // dd($data->Final_Approval_By);
                $changestage->Final_Approval_on = Carbon::now()->format('d-M-Y');
                $changestage->Final_Approval_comment = $request->comment;

                $history = new AuditTrialObservation();
                $history->Observation_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changestage->submitted_by;
                $history->comment = $request->comment;
                $history->action = 'Response Reviewed';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Closed - Done";
                $history->change_from = $lastDocument->status;
                // $history->stage = '';
                $history->activity_type = 'Response Reviewed By, Response Reviewed On';
                if (is_null($lastDocument->Final_Approval_By) || $lastDocument->Final_Approval_on === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->Final_Approval_By . ' , ' . $lastDocument->Final_Approval_on;
                }
                $history->current = $changestage->Final_Approval_By . ' , ' . $changestage->Final_Approval_on;
                if (is_null($lastDocument->Final_Approval_By) || $lastDocument->Final_Approval_By === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
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

    public function ObservationCancel(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = Observation::find($id);

            if ($changeControl->stage == 1) {
                $changeControl->stage = "0";
                $changeControl->status = "Closed - Cancelled";
                $changeControl->cancel_by = Auth::user()->name;
                $changeControl->cancel_on = Carbon::now()->format('d-M-Y');
                $changeControl->cancel_comment = $request->comment;
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
            $changeControl = Observation::find($id);
            $lastDocument = Observation::find($id);


            if ($changeControl->stage == 2) {
                $changeControl->stage = "1";
                $changeControl->status = "Opened";
                $changeControl->more_info_required_by = Auth::user()->name;
                $changeControl->more_info_required_on = Carbon::now()->format('d-M-Y');
                $changeControl->more_info_required_comment = $request->comment;


                $history = new AuditTrialObservation();
                $history->Observation_id = $id;
                $history->activity_type = 'Not Applicable';
                $history->previous = "Not Applicable";
                $history->current = "Not Applicable";
                $history->comment = $request->comment;
                $history->action = 'More Info Required';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $changeControl->status;
                $history->change_to =   "Opened";
                $history->change_from = $lastDocument->status;
                $history->stage = '';
                $history->save();
                $changeControl->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($changeControl->stage == 3) {
                $changeControl->stage = "2";
                $changeControl->status = "Pending Response";
                $changeControl->reject_capa_plan_by = Auth::user()->name;
                $changeControl->reject_capa_plan_on = Carbon::now()->format('d-M-Y');
                $changeControl->reject_capa_plan_comment = $request->comment;

                
                $changeControl->update();
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
                toastr()->success('Document Sent');
                return back();
            }

          
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function CapanotStage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = Observation::find($id);
            $lastDocument = Observation::find($id);

            if ($changeControl->stage == 2) {
                $changeControl->stage = "3";
                $changeControl->status = "Response Verification";
                $changeControl->qa_approval_without_capa_by = Auth::user()->name;
                $changeControl->qa_approval_without_capa_on = Carbon::now()->format('d-M-Y');
                $changeControl->qa_approval_without_capa_comment = $request->comment;

                 $history = new AuditTrialObservation();
                $history->Observation_id = $id;
                $history->activity_type = 'Activity Log';
                $history->previous = "";
                $history->current = $changeControl->submitted_by;
                $history->comment = $request->comment;
                $history->action = 'No CAPAs Required';
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->origin_state = $lastDocument->status;
                $history->change_to =   "Closed - Done";
                $history->change_from = $lastDocument->status;
                // $history->stage = '';
                $history->activity_type = 'No CAPAs Required By, No CAPAs Required On';
                if (is_null($lastDocument->qa_approval_without_capa_by) || $lastDocument->qa_approval_without_capa_on === '') {
                    $history->previous = "";
                } else {
                    $history->previous = $lastDocument->qa_approval_without_capa_by . ' , ' . $lastDocument->qa_approval_without_capa_on;
                }
                $history->current = $changeControl->qa_approval_without_capa_by . ' , ' . $changeControl->qa_approval_without_capa_on;
                if (is_null($lastDocument->qa_approval_without_capa_by) || $lastDocument->qa_approval_without_capa_by === '') {
                    $history->action_name = 'New';
                } else {
                    $history->action_name = 'Update';
                }
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
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function observation_child(Request $request, $id)
    {
        $cc = Observation::find($id);
        $cft = [];
        $parent_id = $id;
        $parent_type = "Observation";
        $old_records = Capa::select('id', 'division_id', 'record')->get();
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
        $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
        $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_initiator_id = $id;
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $changeControl = OpenStage::find(1);
        $relatedRecords = Helpers::getAllRelatedRecords();
        // if(!empty($changeControl->cft)) $cft = explode(',', $changeControl->cft);
        if ($request->revision == "capa-child") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.forms.capa', compact('record_number', 'due_date', 'parent_id', 'parent_type', 'old_records', 'cft','relatedRecords'));
        }
        if ($request->revision == "Action-Item") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            $record = $record_number;
            return view('frontend.action-item.action-item', compact('record','record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));
        }
        if ($request->revision == "RCA") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            return view('frontend.forms.root-cause-analysis', compact('record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id'));
    
        }
        
        // return view('frontend.forms.capa', compact('record_number', 'due_date', 'parent_id', 'parent_type', 'old_record', 'cft'));
    }


    public function ObservationAuditTrialShow($id)
    {
        $audit = AuditTrialObservation::where('Observation_id', $id)->orderByDESC('id')->paginate(5);
        $today = Carbon::now()->format('d-m-y');
        $document = Observation::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');
        $users = User::all();
        return view('frontend.observation.audit-trial', compact('audit', 'document', 'today', 'users'));
    }


    public function ObservationAuditTrailPdf($id){
      
        $doc = Observation::find($id);
        $audit = AuditTrialObservation::where('observation_id', $id)->paginate(500);
        $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        $data = AuditTrialObservation::where('observation_id', $doc->id)->orderByDesc('id')->get();
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.observation.Obs_audittrail_PDF', compact('data', 'audit', 'doc'))
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
    }

    public function ObservationAuditTrialDetails($id)
    {
        $detail = AuditTrialObservation::find($id);

        $detail_data = AuditTrialObservation::where('activity_type', $detail->activity_type)->where('Observation_id', $detail->Observation_id)->latest()->get();

        $doc = Observation::where('id', $detail->Observation_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);
        return view('frontend.observation.audit-trial-inner', compact('detail', 'doc', 'detail_data'));
    }

    public function ObservationSingleReport($id){
        $data = Observation::find($id);
        $griddata = ObservationGrid::where('observation_id',$data->id)->first();
        if (!empty($data)) {
            // $data->data = ObservationGrid::where('e_id', $id)->where('identifier', "details")->first();
            // dd($data->all());
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.observation.obs_single_report', compact('data','griddata'))
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
            return $pdf->stream('errata' . $id . '.pdf');
        }
    }

    public function audit_trail_filter_observation(Request $request, $id)
    {
        // Start query for DeviationAuditTrail
        $query = AuditTrialObservation::query();
        $query->where('Observation_id', $id);
    
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
        $responseHtml = view('frontend.observation.observation_filter', compact('audit', 'filter_request'))->render();
    
        return response()->json(['html' => $responseHtml]);
    }

}
