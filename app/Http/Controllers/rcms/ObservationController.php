<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\AuditTrialObservation;
use App\Models\Observation;
use Illuminate\Support\Facades\Log;
use App\Models\RecordNumber;
use App\Models\User;
use App\Models\OpenStage;
use App\Models\Capa;
use App\Models\ActionItem;
use App\Models\RootCauseAnalysis;
use App\Models\ActionItemHistory;
use App\Models\RootAuditTrial;
use App\Models\CapaAuditTrial;
use Carbon\Carbon;
use Helpers;
use App\Models\RoleGroup;
use App\Models\ObseravtionSingleGrid;
use App\Models\ObservationGrid;
use App\Models\InternalAuditGrid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use PDF;
use Illuminate\Support\Facades\Session;


class ObservationController extends Controller
{

    public function observation()
    {
        // $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $old_record = Observation::select('id', 'division_code', 'record')->get();
        // $lastAi = Observation::orderBy('record', 'desc')->first();
        // $record_number = $lastAi ? $lastAi->record + 1 : 1;
        // $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        return view('frontend.forms.observation', compact('due_date'));
    }

    


    public function observationstore(Request $request)
    {
        if (!$request->short_description) {
            toastr()->error("Short description is required");
            //return redirect()->back();
        }
         $lastCapa = Observation::orderBy('record', 'desc')->first();

        $record_number = $lastCapa ? $lastCapa->record + 1 : 1;
     
        $data = new Observation();
        // dd($data);
        $data->record = $record_number;
        // $data->record = ((RecordNumber::first()->value('counter')) + 1);
        $data->initiator_id = Auth::user()->id;
        $data->parent_id = $request->parent_id;
        $data->parent_type = $request->parent_type;
        $data->division_code = $request->division_id;
        $data->record_number = $record_number;
        $data->intiation_date = $request->intiation_date;
        $data->due_date = $request->due_date;
        $data->short_description = $request->short_description;
        $data->assign_to = $request->assign_to;
        $data->grading = $request->grading;
        $data->category_observation = $request->category_observation;
        $data->reference_guideline = $request->reference_guideline;
        $data->description = $request->description;
        // $data->auditee_department = $request->auditee_department;
        $user = User::find($request->assign_to);
    $data->auditee_department = $user ? $user->department->name : null;
    
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
        // $data->related_url = $request->related_url;
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
                $name = $request->name . 'response_verify_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
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
                $name = $request->name . 'response_summary_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
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
        $data1->type = "Action_Plan";

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


        // ----------------------------------------------------------------------------------------

            // Define an associative array to map the field keys to display names

        $data1 = new ObservationGrid();
        $data1->observation_id = $data->id;
        $data1->type = "Action_Plan";

        $fieldNames = [
            'action' => 'Action',
            'responsible' => 'Responsible',
            'item_status' => 'Item Status',
            'deadline' => 'Deadline'
        ];

        foreach ($request->action as $index => $action) {
            // Since this is a new entry, there are no previous details
            $previousDetails = [
                'action' => null,
                'responsible' => null,
                'item_status' => null,
                'deadline' => null,
            ];

            // Current fields values from the request
            $fields = [
                'action' => $action,
                'responsible' => Helpers::getInitiatorName($request->responsible[$index]),
                'item_status' => $request->item_status[$index],
                'deadline' => Helpers::getdateFormat($request->deadline[$index]),
            ];

            foreach ($fields as $key => $currentValue) {
                // Log changes for new rows (no previous value to compare)
                if (!empty($currentValue)) {
                    // Only create an audit trail entry for new values
                    $history = new AuditTrialObservation();
                    $history->observation_id = $data->id;

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

        // ----------------------------------------------------------------------------------------


        $observation_id = $data->id;
        $observationSingleGrid = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'observation'])->firstOrCreate();
        $observationSingleGrid->obs_id = $observation_id;
        $observationSingleGrid->identifier = 'observation';
        $observationSingleGrid->data = $request->observation;
        $observationSingleGrid->save();


        $observationSingleCorrect = ObseravtionSingleGrid::where([
            'obs_id' => $observation_id,
            'identifier' => 'observation'
        ])->firstOrCreate([
            'obs_id' => $observation_id,
            'identifier' => 'observation',
        ]);

        // Save the data from the request
        $observationSingleCorrect->data = $request->observation;
        $observationSingleCorrect->save();

        // Initialize a manual counter for observation actions
        $actionCounter = 0;

        // Loop through the observation data and create audit trail entries for new actions
        if (is_array($request->observation)) {
            foreach ($request->observation as $observationAction) {
                $currentObservationAction = $observationAction['non_compliance'] ?? null;

                // Check if the preventive action is not empty
                if (!empty($currentObservationAction)) {
                    // Increment the manual counter only for non-empty preventive actions
                    $actionCounter++;

                    // Create a new audit trail entry for each preventive action
                    $history = new AuditTrialObservation();
                    $history->Observation_id = $observation_id;
                    $history->activity_type = "Observation" . ' (' . $actionCounter . ')';
                    $history->previous = null; // Since it's a new entry, there is no previous action
                    $history->current = $currentObservationAction;
                    $history->comment = $request->action_taken_comment ?? ''; // Add a comment if provided
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'New'; // Assuming a new entry starts in 'New' state
                    $history->change_to = "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = "Create";

                    // Save the audit trail entry
                    $history->save();
                }
            }
        }



        $observationSingleResponse = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'response'])->firstOrCreate();
        $observationSingleResponse->obs_id = $observation_id;
        $observationSingleResponse->identifier = 'response';
        $observationSingleResponse->data = $request->response;
        $observationSingleResponse->save();

        $observationSingleCorrect = ObseravtionSingleGrid::where([
            'obs_id' => $observation_id,
            'identifier' => 'response'
        ])->firstOrCreate([
            'obs_id' => $observation_id,
            'identifier' => 'response',
        ]);

        // Save the data from the request
        $observationSingleCorrect->data = $request->response;
        $observationSingleCorrect->save();

        // Initialize a manual counter for response actions
        $actionCounter = 0;

        // Loop through the response data and create audit trail entries for new actions
        if (is_array($request->response)) {
            foreach ($request->response as $responseAction) {
                $currentResponseAction = $responseAction['response_detail'] ?? null;

                // Check if the preventive action is not empty
                if (!empty($currentResponseAction)) {
                    // Increment the manual counter only for non-empty preventive actions
                    $actionCounter++;

                    // Create a new audit trail entry for each preventive action
                    $history = new AuditTrialObservation();
                    $history->Observation_id = $observation_id;
                    $history->activity_type = "Response Action" . ' (' . $actionCounter . ')';
                    $history->previous = null; // Since it's a new entry, there is no previous action
                    $history->current = $currentResponseAction;
                    $history->comment = $request->action_taken_comment ?? ''; // Add a comment if provided
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'New'; // Assuming a new entry starts in 'New' state
                    $history->change_to = "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = "Create";

                    // Save the audit trail entry
                    $history->save();
                }
            }
        }



        $observationSingleCorrect = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'corrective'])->firstOrCreate();
        $observationSingleCorrect->obs_id = $observation_id;
        $observationSingleCorrect->identifier = 'corrective';
        $observationSingleCorrect->data = $request->corrective;
        $observationSingleCorrect->save();


        $observationSingleCorrect = ObseravtionSingleGrid::where([
            'obs_id' => $observation_id,
            'identifier' => 'corrective'
        ])->firstOrCreate([
            'obs_id' => $observation_id,
            'identifier' => 'corrective',
        ]);

        // Save the data from the request
        $observationSingleCorrect->data = $request->corrective;
        $observationSingleCorrect->save();

        // Initialize a manual counter for corrective actions
        $actionCounter = 0;

        // Loop through the corrective data and create audit trail entries for new actions
        if (is_array($request->corrective)) {
            foreach ($request->corrective as $correctiveAction) {
                $currentCorrectiveAction = $correctiveAction['corrective_action'] ?? null;

                // Check if the preventive action is not empty
                if (!empty($currentCorrectiveAction)) {
                    // Increment the manual counter only for non-empty preventive actions
                    $actionCounter++;

                    // Create a new audit trail entry for each preventive action
                    $history = new AuditTrialObservation();
                    $history->Observation_id = $observation_id;
                    $history->activity_type = "Corrective Action" . ' (' . $actionCounter . ')';
                    $history->previous = null; // Since it's a new entry, there is no previous action
                    $history->current = $currentCorrectiveAction;
                    $history->comment = $request->action_taken_comment ?? ''; // Add a comment if provided
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'New'; // Assuming a new entry starts in 'New' state
                    $history->change_to = "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = "Create";

                    // Save the audit trail entry
                    $history->save();
                }
            }
        }


        $observationSingleCorrect = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'preventive'])->firstOrCreate();
        $observationSingleCorrect->obs_id = $observation_id;
        $observationSingleCorrect->identifier = 'preventive';
        $observationSingleCorrect->data = $request->preventive;
        $observationSingleCorrect->save();


        $observationSingleCorrect = ObseravtionSingleGrid::where([
            'obs_id' => $observation_id,
            'identifier' => 'preventive'
        ])->firstOrCreate([
            'obs_id' => $observation_id,
            'identifier' => 'preventive',
        ]);

        // Save the data from the request
        $observationSingleCorrect->data = $request->preventive;
        $observationSingleCorrect->save();

        // Initialize a manual counter for preventive actions
        $actionCounter = 0;

        // Loop through the preventive data and create audit trail entries for new actions
        if (is_array($request->preventive)) {
            foreach ($request->preventive as $preventiveAction) {
                $currentPreventiveAction = $preventiveAction['preventive_action'] ?? null;

                // Check if the preventive action is not empty
                if (!empty($currentPreventiveAction)) {
                    // Increment the manual counter only for non-empty preventive actions
                    $actionCounter++;

                    // Create a new audit trail entry for each preventive action
                    $history = new AuditTrialObservation();
                    $history->Observation_id = $observation_id;
                    $history->activity_type = "Preventive Action" . ' (' . $actionCounter . ')';
                    $history->previous = null; // Since it's a new entry, there is no previous action
                    $history->current = $currentPreventiveAction;
                    $history->comment = $request->action_taken_comment ?? ''; // Add a comment if provided
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = 'New'; // Assuming a new entry starts in 'New' state
                    $history->change_to = "Opened";
                    $history->change_from = "Initiation";
                    $history->action_name = "Create";

                    // Save the audit trail entry
                    $history->save();
                }
            }
        }


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
        $history->activity_type = 'Observation Report Due Date';
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
        $history->activity_type = 'Response Verification Attachments';
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

    // if (!empty($data->related_url)) {
    //     $history = new AuditTrialObservation();
    //     $history->Observation_id = $data->id;
    //     $history->activity_type = 'Related URL';
    //     $history->previous = "Null";
    //     $history->current = $data->related_url;
    //     $history->comment = "NA";
    //     $history->user_id = Auth::user()->id;
    //     $history->user_name = Auth::user()->name;
    //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
    //     $history->origin_state = $data->status;
    //     $history->change_to =   "Opened";
    //     $history->change_from = "Initiation";
    //     $history->action_name = 'Create';
    //     $history->save();
    // }

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
        // $data->parent_id = $request->parent_id;
        // $data->parent_type = $request->parent_type;
        // $data->division_code = $request->division_code;
        // $data->intiation_date = $request->intiation_date;
        $data->due_date = $request->due_date;
        $data->short_description = $request->short_description;
        $data->assign_to = $request->assign_to;
        $data->grading = $request->grading;
        $data->category_observation = $request->category_observation;
        $data->reference_guideline = $request->reference_guideline;
        $data->description = $request->description;

        // $data->auditee_department = $request->auditee_department;
        $user = User::find($request->assign_to);
$data->auditee_department = $user ? $user->department->name : null;

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
                    $name = $request->name . 'response_summary_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
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
        // $data->related_url = $request->related_url;
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
                $name = $request->name . 'response_verify_attach' . uniqid() . '.' . $file->getClientOriginalExtension();
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


        // $data1 = ObservationGrid::find($id);
        // $data1->observation_id = $data->id;
        // $data1->type = "Action_Plan";

//  ------------------------------------------------------------------------------------------------------------------
// Update the $data model instance
$data->update();


$data1 = ObservationGrid::where('observation_id', $id)->where('type', "Action_Plan")->first();

// Safely unserialize and use fallback to empty array if null
$previousDetails = [
    'action' => !is_null($data1->action) ? unserialize($data1->action) : null ,
    'responsible' => !is_null($data1->responsible) ? unserialize($data1->responsible) : null,
    'deadline' => !is_null($data1->deadline) ? unserialize($data1->deadline) : null,
    'item_status' => !is_null($data1->item_status) ? unserialize($data1->item_status) : null,
];

    // Serialize fields if they are not empty
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

    // Save the $data1 model instance
    $data1->update();







// Define the mapping of database fields to the descriptive field names
$fieldNames = [
    'action' => 'Action',
    'responsible' => 'Responsible',
    'deadline' => 'Deadline',
    'item_status' => 'Item Status',
];

if (is_array($request->action) && !empty($request->action)) {
    foreach ($request->action as $index => $action) {

        $previousValues = [
            'action' => isset($previousDetails['action'][$index]) ? $previousDetails['action'][$index] : null,

            'responsible' => isset($previousDetails['responsible'][$index]) ? Helpers::getInitiatorName($previousDetails['responsible'][$index]) : null,

            'deadline' => isset($previousDetails['deadline'][$index]) ? Helpers::getdateFormat($previousDetails['deadline'][$index]) : null,

            'item_status' => isset($previousDetails['item_status'][$index]) ? $previousDetails['item_status'][$index] : null,

            // 'action' => $previousDetails['action'][$index] ?? null,
            // 'responsible' => Helpers::getInitiatorName($previousDetails['responsible'][$index]) ?? null,
            // 'deadline' => Helpers::getdateFormat($previousDetails['deadline'][$index]) ?? null,
            // 'item_status' => $previousDetails['item_status'][$index] ?? null,
        ];



        // Current field values
        $fields = [
            'action' => $action,
            'responsible' => Helpers::getInitiatorName($request->responsible[$index]),
            'deadline' => Helpers::getdateFormat($request->deadline[$index]),
            'item_status' => $request->item_status[$index],
        ];

        foreach ($fields as $key => $currentValue) {
            $previousValue = $previousValues[$key] ?? null;

            // Log changes if the current value is different from the previous one
            if ($previousValue != $currentValue && !empty($currentValue)) {
                // Check if an audit trail entry for this specific row and field already exists
                $existingAudit = AuditTrialObservation::where('observation_id', $id)
                    ->where('activity_type', $fieldNames[$key] . ' (' . ($index + 1) . ')')
                    ->where('previous', $previousValue)
                    ->where('current', $currentValue)
                    ->exists();

                // Only create a new audit trail entry if no existing entry matches
                if (!$existingAudit) {
                    $history = new AuditTrialObservation();
                    $history->observation_id = $id;
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

        // ------------------------------------------------------------------------------------------------------------------


        $observation_id = $data->id;
        $observationSingleGrid = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'observation'])->firstOrCreate();
        $observationSingleGrid->obs_id = $observation_id;
        $observationSingleGrid->identifier = 'observation';
        $observationSingleGrid->data = $request->observation;
        $observationSingleGrid->save();


        $observationSingleCorrect = ObseravtionSingleGrid::firstOrNew([
            'obs_id' => $observation_id,
            'identifier' => 'observation'
        ]);

        // Update the data from the request
        $observationSingleCorrect->data = $request->observation;
        $observationSingleCorrect->save();

        $actionCounter = 0;

        // Loop through the observation data and check for updates or comments
        if (is_array($request->observation)) {
            foreach ($request->observation as $index => $observationAction) {
                $lastObservationAction = $lastDocument->observation[$index] ?? null;
                $currentObservationAction = $observationAction['non_compliance'];

                $actionCounter++;

                // Check if there is a change or an action comment
                if ($lastObservationAction != $currentObservationAction || !empty($request->action_taken_comment)) {
                    // Check if an existing audit trail entry already exists for this action
                    $existingHistory = AuditTrialObservation::where([
                        'Observation_id' => $id,
                        'activity_type' => "Observation" . ' (' . ($actionCounter) . ')',
                        'previous' => $lastObservationAction,
                        'current' => $currentObservationAction
                    ])->first();

                    // If no existing history, create a new entry
                    if (!$existingHistory) {
                        $history = new AuditTrialObservation();
                        $history->Observation_id = $id;
                        $history->activity_type = "Observation" . ' (' . ($actionCounter) . ')';
                        $history->previous = $lastObservationAction;
                        $history->current = $currentObservationAction;
                        $history->comment = $request->action_taken_comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to = "Not Applicable";
                        $history->change_from = $lastDocument->status;
                        $history->action_name = "Update";
                        // Determine if this is a new entry or an update
                        // if (is_null($lastObservationAction) || $lastObservationAction === '') {
                        //     $history->action_name = "New";
                        // } else {
                        //     $history->action_name = "Update";
                        // }

                        // Save the audit trail entry
                        $history->save();
                    }
                }
            }
        }

        // ----------------------------------------------------------------------

        // $observation_id = $data->id;

        // if (!empty($request->observation)) {
        //     // Fetch existing data for the observation
        //     $existingAuditorShow = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'observation'])->first();
        //     $existingAuditorData = $existingAuditorShow ? $existingAuditorShow->data : [];

        //     // Update or create a new observation entry
        //     $observationSingleGrid = ObseravtionSingleGrid::firstOrNew(['obs_id' => $observation_id, 'identifier' => 'observation']);
        //     $observationSingleGrid->obs_id = $observation_id;
        //     $observationSingleGrid->identifier = 'observation';
        //     $observationSingleGrid->data = $request->observation;
        //     $observationSingleGrid->save();

        //     $fieldNames = [
        //         'non_compliance' => 'Observation',
        //     ];

        //     if (is_array($request->observation)) {
        //         foreach ($request->observation as $index => $newAuditor) {
        //             // Ensure that previousAuditor is fetched for each row
        //             $previousAuditor = isset($existingAuditorData[$index]) ? $existingAuditorData[$index] : [];

        //             // Fields to track changes
        //             $fieldsToTrack = ['non_compliance'];

        //             foreach ($fieldsToTrack as $field) {
        //                 $oldValue = isset($previousAuditor[$field]) ? $previousAuditor[$field] : 'Null';
        //                 $newValue = isset($newAuditor[$field]) ? $newAuditor[$field] : 'Null';

        //                 // Only create audit trail if there is a change
        //                 if ($oldValue !== $newValue) {
        //                     $existingAuditTrail = AuditTrialObservation::where([
        //                         ['Observation_id', '=', $observation_id],
        //                         ['activity_type', '=', $fieldNames[$field] . ' ( ' . ($index + 1) . ')'],
        //                         ['previous', '=', $oldValue],
        //                         ['current', '=', $newValue]
        //                     ])->first();

        //                     $actionName = empty($oldValue) || $oldValue === 'Null' ? 'New' : 'Update';

        //                     if (!$existingAuditTrail) {
        //                         $auditTrail = new AuditTrialObservation;
        //                         $auditTrail->Observation_id = $observation_id;
        //                         $auditTrail->activity_type = $fieldNames[$field] . ' ( ' . ($index + 1) . ')';
        //                         $auditTrail->previous = $oldValue;
        //                         $auditTrail->current = $newValue;
        //                         $auditTrail->comment = "";
        //                         $auditTrail->user_id = Auth::user()->id;
        //                         $auditTrail->user_name = Auth::user()->name;
        //                         $auditTrail->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //                         $auditTrail->origin_state = $data->status;
        //                         $auditTrail->change_to = "Not Applicable";
        //                         $auditTrail->change_from = $data->status;
        //                         $auditTrail->action_name = $actionName;
        //                         $auditTrail->save();
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }




        // -------------------------------------------------------------------------


        $observation_id = $data->id;
        $observationSingleResponse = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'response'])->firstOrCreate();
        $observationSingleResponse->obs_id = $observation_id;
        $observationSingleResponse->identifier = 'response';
        $observationSingleResponse->data = $request->response;
        $observationSingleResponse->save();



        $observationSingleCorrect = ObseravtionSingleGrid::firstOrNew([
            'obs_id' => $observation_id,
            'identifier' => 'response'
        ]);

        // Update the data from the request
        $observationSingleCorrect->data = $request->response;
        $observationSingleCorrect->save();

        $actionCounter = 0;

        // Loop through the response data and check for updates or comments
        if (is_array($request->response)) {
            foreach ($request->response as $index => $responseAction) {
                $lastResponseAction = $lastDocument->response[$index] ?? null;
                $currentResponseAction = $responseAction['response_detail'];

                $actionCounter++;

                // Check if there is a change or an action comment
                if ($lastResponseAction != $currentResponseAction || !empty($request->action_taken_comment)) {
                    // Check if an existing audit trail entry already exists for this action
                    $existingHistory = AuditTrialObservation::where([
                        'Observation_id' => $id,
                        'activity_type' => "Response Action" . ' (' . ($actionCounter) . ')',
                        'previous' => $lastResponseAction,
                        'current' => $currentResponseAction
                    ])->first();

                    // If no existing history, create a new entry
                    if (!$existingHistory) {
                        $history = new AuditTrialObservation();
                        $history->Observation_id = $id;
                        $history->activity_type = "Response Details" . ' (' . ($actionCounter) . ')';
                        $history->previous = $lastResponseAction;
                        $history->current = $currentResponseAction;
                        $history->comment = $request->action_taken_comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to = "Not Applicable";
                        $history->change_from = $lastDocument->status;
                        $history->action_name = "Update";
                        // Determine if this is a new entry or an update
                        // if (is_null($lastResponseAction) || $lastResponseAction === '') {
                        //     $history->action_name = "New";
                        // } else {
                        //     $history->action_name = "Update";
                        // }

                        // Save the audit trail entry
                        $history->save();
                    }
                }
            }
        }



        $observationSingleCorrect = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'corrective'])->firstOrCreate();
        $observationSingleCorrect->obs_id = $observation_id;
        $observationSingleCorrect->identifier = 'corrective';
        $observationSingleCorrect->data = $request->corrective;
        $observationSingleCorrect->save();


        $observationSingleCorrect = ObseravtionSingleGrid::firstOrNew([
            'obs_id' => $observation_id,
            'identifier' => 'corrective'
        ]);

        // Update the data from the request
        $observationSingleCorrect->data = $request->corrective;
        $observationSingleCorrect->save();

        $actionCounter = 0;

        // Loop through the corrective data and check for updates or comments
        if (is_array($request->corrective)) {
            foreach ($request->corrective as $index => $correctiveAction) {
                $lastCorrectiveAction = $lastDocument->corrective[$index] ?? null;
                $currentCorrectiveAction = $correctiveAction['corrective_action'];

                $actionCounter++;

                // Check if there is a change or an action comment
                if ($lastCorrectiveAction != $currentCorrectiveAction || !empty($request->action_taken_comment)) {
                    // Check if an existing audit trail entry already exists for this action
                    $existingHistory = AuditTrialObservation::where([
                        'Observation_id' => $id,
                        'activity_type' => "Corrective Action" . ' (' . ($actionCounter) . ')',
                        'previous' => $lastCorrectiveAction,
                        'current' => $currentCorrectiveAction
                    ])->first();

                    // If no existing history, create a new entry
                    if (!$existingHistory) {
                        $history = new AuditTrialObservation();
                        $history->Observation_id = $id;
                        $history->activity_type = "Corrective Action" . ' (' . ($actionCounter) . ')';
                        $history->previous = $lastCorrectiveAction;
                        $history->current = $currentCorrectiveAction;
                        $history->comment = $request->action_taken_comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to = "Not Applicable";
                        $history->change_from = $lastDocument->status;
                        $history->action_name = "Update";
                        // Determine if this is a new entry or an update
                        // if (is_null($lastCorrectiveAction) || $lastCorrectiveAction === '') {
                        //     $history->action_name = "New";
                        // } else {
                        //     $history->action_name = "Update";
                        // }

                        // Save the audit trail entry
                        $history->save();
                    }
                }
            }
        }


        $observationSingleCorrect = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'preventive'])->firstOrCreate();
        $observationSingleCorrect->obs_id = $observation_id;
        $observationSingleCorrect->identifier = 'preventive';
        $observationSingleCorrect->data = $request->preventive;
        $observationSingleCorrect->save();

        $observationSingleCorrect = ObseravtionSingleGrid::firstOrNew([
            'obs_id' => $observation_id,
            'identifier' => 'preventive'
        ]);

        // Update the data from the request
        $observationSingleCorrect->data = $request->preventive;
        $observationSingleCorrect->save();

        $actionCounter = 0;

        // Loop through the preventive data and check for updates or comments
        if (is_array($request->preventive)) {
            foreach ($request->preventive as $index => $preventiveAction) {
                $lastPreventiveAction = $lastDocument->preventive[$index] ?? null;
                $currentPreventiveAction = $preventiveAction['preventive_action'];

                $actionCounter++;

                // Check if there is a change or an action comment
                if ($lastPreventiveAction != $currentPreventiveAction || !empty($request->action_taken_comment)) {
                    // Check if an existing audit trail entry already exists for this action
                    $existingHistory = AuditTrialObservation::where([
                        'Observation_id' => $id,
                        'activity_type' => "Preventive Action" . ' (' . ($actionCounter) . ')',
                        'previous' => $lastPreventiveAction,
                        'current' => $currentPreventiveAction
                    ])->first();

                    // If no existing history, create a new entry
                    if (!$existingHistory) {
                        $history = new AuditTrialObservation();
                        $history->Observation_id = $id;
                        $history->activity_type = "Preventive Action" . ' (' . ($actionCounter) . ')';
                        $history->previous = $lastPreventiveAction;
                        $history->current = $currentPreventiveAction;
                        $history->comment = $request->action_taken_comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to = "Not Applicable";
                        $history->change_from = $lastDocument->status;
                        $history->action_name = "Update";
                        // Determine if this is a new entry or an update
                        // if (is_null($lastPreventiveAction) || $lastPreventiveAction === '') {
                        //     $history->action_name = "New";
                        // } else {
                        //     $history->action_name = "Update";
                        // }

                        // Save the audit trail entry
                        $history->save();
                    }
                }
            }
        }

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

        if ($lastDocument->due_date != $data->due_date || !empty($request->auditee_department_comment)) {

            $history = new AuditTrialObservation();
            $history->Observation_id = $id;
            $history->activity_type = 'Observation Report Due Date';
            $history->previous = Helpers::getdateFormat($lastDocument->due_date);
            $history->current = Helpers::getdateFormat($data->due_date);
            $history->comment = $request->auditee_department_comment;
            $history->user_id = Auth::user()->id;
            $history->user_name = Auth::user()->name;
            $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
            $history->origin_state = $lastDocument->status;
            $history->change_to =   "Not Applicable";
            $history->change_from = $lastDocument->status;
            if (is_null($lastDocument->due_date) || $lastDocument->due_date === '') {
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
            $history->activity_type = 'Response Due Date ';
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
            $history->activity_type = 'Response Verification Attachments ';
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

        // if ($lastDocument->related_url != $data->related_url || !empty($request->action_taken_comment)) {

        //     $history = new AuditTrialObservation();
        //     $history->Observation_id = $id;
        //     $history->activity_type = 'Related URL ';
        //     $history->previous = $lastDocument->related_url;
        //     $history->current = $data->related_url;
        //     $history->comment = $request->action_taken_comment;
        //     $history->user_id = Auth::user()->id;
        //     $history->user_name = Auth::user()->name;
        //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
        //     $history->origin_state = $lastDocument->status;
        //     $history->change_to =   "Not Applicable";
        //     $history->change_from = $lastDocument->status;
        //     if (is_null($lastDocument->related_url) || $lastDocument->related_url === '') {
        //         $history->action_name = "New";
        //     } else {
        //         $history->action_name = "Update";
        //     }
        //     $history->save();
        // }

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
        $observation_id = $id;
        // $grid_Data = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'observation'])->first();
        $grid_Data = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'observation'])->firstOrCreate();
        $grid_Data2 = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'response'])->firstOrCreate();
        $grid_Data3 = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'corrective'])->firstOrCreate();
        $grid_Data4 = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'preventive'])->firstOrCreate();

       
        return view('frontend.observation.view', compact('data','griddata','grid_data','due_date', 'grid_Data','grid_Data2', 'grid_Data3', 'grid_Data4'));
    }
    public function observation_send_stage(Request $request, $id)
    {

        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changestage = Observation::find($id);
            $lastDocument = Observation::find($id);
            $observation_id = $id;
            $grid_Data2 = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'response'])->firstOrCreate();
            $grid_Data3 = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'corrective'])->firstOrCreate();
            $grid_Data4 = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'preventive'])->firstOrCreate();
            $grid_Data = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'observation'])->firstOrCreate();

            $capaRequired = $request->capaNotReq;
            
            // if ($changestage->stage == 1) {

                
                    if ($changestage->stage == 1) {
                        if (empty($changestage->assign_to) || empty($changestage->due_date) || empty($changestage->short_description) || empty($changestage->recomendation_capa_date_due))
                        {
                            Session::flash('swal', [
                                'type' => 'warning',
                                'title' => 'Mandatory Fields!',
                                'message' => 'General Information Tab is yet to be filled'
                            ]);
    
                            return redirect()->back();
                        }
                         else {
                            Session::flash('swal', [
                                'type' => 'success',
                                'title' => 'Success',
                                'message' => 'Sent for Pending Response state'
                            ]);
                        }
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


                $list = Helpers::getLeadAuditeeUsersList($changestage->division_code); // Notify CFT Person
                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changestage, 
                                            'site' => "OBS", 
                                            'history' => "Submit", 
                                            'process' => 'Observation', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changestage) {
                                            $message->to($email)
                                                ->subject("Agio Notification: Observation, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Submit Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                 
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                   
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        }

                $history->save();

                $changestage->update();
                toastr()->success('Document Sent');
                return back();
            }

            if($capaRequired == "Yes"){
                if ($changestage->stage == 2) {
                    
                    if (
                        empty($grid_Data2->data) || !is_array($grid_Data2->data) || empty($grid_Data2->data[0]['response_detail']) ||
                        empty($grid_Data3->data) || !is_array($grid_Data3->data) || empty($grid_Data3->data[0]['corrective_action']) ||
                        empty($grid_Data4->data) || !is_array($grid_Data4->data) || empty($grid_Data4->data[0]['preventive_action']) ||
                        empty($changestage->comments) ||
                        empty($changestage->actual_start_date) ||
                        empty($changestage->actual_end_date) ||
                        empty($changestage->action_taken) ||
                        empty($changestage->response_summary) ||
                         empty($changestage->impact_analysis) ||
                         is_null($changestage->impact_analysis)
                    ) {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'Response and CAPA,Summary Tab are yet to be filled'
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
                     $capachilds = Capa::where('parent_id', $id)
                ->where('parent_type', 'Observation')
                ->get();
                    $hasPending = false;
                foreach ($capachilds as $ext) {
                        $capachildstatus = trim(strtolower($ext->status));
                        if ($capachildstatus !== 'closed - done' && $capachildstatus !== 'closed-cancelled' ) {
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
                ->where('parent_type', 'Observation')
                ->get();
                    $hasPendingRCA = false;
                foreach ($rcachilds as $ext) {
                        $rcachildstatus = trim(strtolower($ext->status));
                        if ($rcachildstatus !== 'closed - done'  && $capachildstatus !== 'closed-cancelled') {
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
               $actionchilds = ActionItem::where('parent_id', $id)
                ->where('parent_type', 'Observation')
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

                  
                $list = Helpers::getQAUserList($changestage->division_id);

                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changestage, 
                                            'site' => "OBS", 
                                            'history' => "CAPA Plan Proposed", 
                                            'process' => 'Observation', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changestage) {
                                            $message->to($email)
                                                ->subject("Agio Notification: Observation, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: CAPA Plan Proposed Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                 
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                   
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        }

                    $changestage->update();
                    toastr()->success('Document Sent');
                    return back();
                }
            } else {
                
                if ($changestage->stage == 2) {

                
                    if (
                        empty($grid_Data2->data) || !is_array($grid_Data2->data) || empty($grid_Data2->data[0]['response_detail']) ||
                        empty($grid_Data3->data) || !is_array($grid_Data3->data) || empty($grid_Data3->data[0]['corrective_action']) ||
                        empty($grid_Data4->data) || !is_array($grid_Data4->data) || empty($grid_Data4->data[0]['preventive_action']) ||
                        empty($changestage->comments) ||
                        empty($changestage->actual_start_date) ||
                        empty($changestage->actual_end_date) ||
                        empty($changestage->action_taken) ||
                        empty($changestage->response_summary) || 
                            empty($changestage->impact_analysis) ||
                         is_null($changestage->impact_analysis)
                    )
                    {
                        Session::flash('swal', [
                            'type' => 'warning',
                            'title' => 'Mandatory Fields!',
                            'message' => 'Response and CAPA Tab , Summary is yet to be filled'
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
                     $capachilds = Capa::where('parent_id', $id)
                ->where('parent_type', 'Observation')
                ->get();
                    $hasPending = false;
                foreach ($capachilds as $ext) {
                        $capachildstatus = trim(strtolower($ext->status));
                        if ($capachildstatus !== 'closed - done' && $capachildstatus !== 'closed-cancelled' ) {
                            $hasPending = true;
                            break;
                        }
                    }
               if ($hasPending) {
                // $capachildstatus = trim(strtolower($extensionchild->status));
                   if ($hasPending) {
                       Session::flash('swal', [
                           'title' => 'CAPA Child Pending!',
                           'message' => 'You cannot proceed — CAPA Item Child is still pending',
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
                ->where('parent_type', 'Observation')
                ->get();
                    $hasPendingRCA = false;
                foreach ($rcachilds as $ext) {
                        $rcachildstatus = trim(strtolower($ext->status));
                        if ($rcachildstatus !== 'closed - done'  && $rcachildstatus !== 'closed-cancelled') {
                            $hasPendingRCA = true;
                            break;
                        }
                    }
               if ($hasPendingRCA) {
                // $rcachildstatus = trim(strtolower($extensionchild->status));
                   if ($hasPendingRCA) {
                       Session::flash('swal', [
                           'title' => 'RCA Child Pending!',
                           'message' => 'You cannot proceed — RCA Item Child is still pending',
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
               $actionchilds = ActionItem::where('parent_id', $id)
                ->where('parent_type', 'Observation')
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
                           'message' => 'You cannot proceed — Action Item Child is still pending.',
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
                    $history->change_to =   "Response Verification";
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

                    $list = Helpers::getAuditManagerUsersList($changestage->division_code);                                 
                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changestage, 
                                            'site' => "OBS", 
                                            'history' => "No CAPAs Required", 
                                            'process' => 'Observation', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changestage) {
                                            $message->to($email)
                                                ->subject("Agio Notification: Observation, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: No CAPAs Required Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                 
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                   
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        }
                         $list = Helpers::getQAUserList($changestage->division_code);                                 
                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changestage, 
                                            'site' => "OBS", 
                                            'history' => "No CAPAs Required", 
                                            'process' => 'Observation', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changestage) {
                                            $message->to($email)
                                                ->subject("Agio Notification: Observation, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: No CAPAs Required Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                 
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                   
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        }
                         $list = Helpers::getCQAUsersList($changestage->division_code);                                 
                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changestage, 
                                            'site' => "OBS", 
                                            'history' => "No CAPAs Required", 
                                            'process' => 'Observation', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changestage) {
                                            $message->to($email)
                                                ->subject("Agio Notification: Observation, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: No CAPAs Required Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                 
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                   
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        }

                         $list = Helpers::getLeadAuditeeUsersList($changestage->division_code);                                 
                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changestage, 
                                            'site' => "OBS", 
                                            'history' => "No CAPAs Required", 
                                            'process' => 'Observation', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changestage) {
                                            $message->to($email)
                                                ->subject("Agio Notification: Observation, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: No CAPAs Required Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                 
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                   
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        }

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
                // $history->activity_type = 'Activity Log';
                // $history->previous = "";
                // $history->current = $changestage->submitted_by;
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

                 $usersmerge = collect()
                ->merge(Helpers::getQAUserList($changestage->division_code))
                ->merge(Helpers::getAuditManagerUsersList($changestage->division_code))
                ->merge(Helpers::getLeadAuditorUsersList($changestage->division_code))
                ->merge(Helpers::getLeadAuditeeUsersList($changestage->division_code))
                ->unique('user_id');

                // $list = Helpers::getAuditManagerUsersList($changestage->division_code); // Notify CFT Person
                     foreach ($usersmerge as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changestage, 
                                            'site' => "OBS", 
                                            'history' => "Response Reviewed", 
                                            'process' => 'Observation', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changestage) {
                                            $message->to($email)
                                                ->subject("Agio Notification: Observation, Record #" . str_pad($changestage->record, 4, '0', STR_PAD_LEFT) . " - Activity: Response Reviewed Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                 
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                   
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        }


                
                $history->save();
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
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
            $changeControl = Observation::find($id);

            if ($changeControl->stage == 1) {
                $changeControl->stage = "0";
                $changeControl->status = "Closed - Cancelled";
                $changeControl->cancel_by = Auth::user()->name;
                $changeControl->cancel_on = Carbon::now()->format('d-M-Y');
                $changeControl->cancel_comment = $request->comment;

                

                $childCapas = Capa::where('parent_id', $id)
                ->where('parent_type', 'Observation')
                ->get();

                if ($childCapas->count() > 0) {
                    foreach ($childCapas as $capa) {
                        $lastDocument = clone $capa; // save old state for history

                        // 🔹 Update individual CAPA record
                        $capa->stage = "0";
                        $capa->status = "Closed-Cancelled";
                        $capa->cancelled_by = Auth::user()->name;
                        $capa->cancelled_on = Carbon::now()->format('d-M-Y');
                        $capa->cancel_comment = $request->comment;
                        $capa->save();

                        // 🔹 Create Audit Trail entry
                        $history = new CapaAuditTrial();
                        $history->capa_id = $capa->id;
                        $history->activity_type = 'Cancel By, Cancel On';
                        $history->action = 'Cancel';
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_from = $lastDocument->status;
                        $history->change_to = "Closed-Cancelled";
                        $history->stage = 'Cancelled';

                        // Previous / Current audit info
                        $history->previous = $lastDocument->cancelled_by
                            ? $lastDocument->cancelled_by . ' , ' . $lastDocument->cancelled_on
                            : '';
                        $history->current = $capa->cancelled_by . ' , ' . $capa->cancelled_on;
                        $history->action_name = $lastDocument->cancelled_by ? 'Update' : 'New';

                        $history->save();
                    }
                }


                $childActionItems = ActionItem::where('parent_id', $id)
                ->where('parent_type', 'Observation')
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
                 $childroot = RootCauseAnalysis::where('parent_id', $id)
                ->where('parent_type', 'Observation')
                ->get();

                if ($childroot->count() > 0) {
                    foreach ($childroot as $root) {
                        $lastopenState = clone $root; // save previous values before update

                        // 🔹 Update fields
                        $root->stage = "0";
                        $root->status = "Closed-Cancelled";
                        $root->cancelled_by = Auth::user()->name;
                        $root->cancelled_on = Carbon::now()->format('d-M-Y');
                        $root->cancel_comment = $request->comment;
                        $root->save();

                        // 🔹 Create history record
                        $history = new RootAuditTrial();
                        $history->root_id = $id;
                        $history->activity_type = 'Cancelled By,Cancelled On';
                        // $history->previous = $lastDocument->cancelled_by;
                        $history->previous = "";
                        $history->current = $root->cancelled_by;
                        $history->comment = $request->comment;
                        $history->user_id = Auth::user()->id;
                        $history->action = "Cancel";
                        $history->user_name = Auth::user()->name;
                        $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                        $history->origin_state = $lastDocument->status;
                        $history->change_to =   "Closed-Cancelled";
                        $history->change_from = $lastDocument->status;

                        $history->stage = 'Cancelled ';
                        if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                            $history->previous = "";
                        } else {
                            $history->previous = $lastDocument->cancelled_by . ' , ' . $lastDocument->cancelled_on;
                        }
                        $history->current = $root->cancelled_by . ' , ' . $root->cancelled_on;
                        if (is_null($lastDocument->cancelled_by) || $lastDocument->cancelled_by === '') {
                            $history->action_name = 'New';
                        } else {
                            $history->action_name = 'Update';
                        }
                        $history->save();

                    }
                }

                $list = Helpers::getLeadAuditeeUsersList($changeControl->division_code);                                 
                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changeControl, 
                                            'site' => "OBS", 
                                            'history' => "Cancel", 
                                            'process' => 'Observation', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                                ->subject("Agio Notification: Observation, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: Cancel Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                 
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                   
                                    session()->flash('error', 'Failed to send email to ' . $email);
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

    public function RejectStateChange(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
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

                    $list = Helpers::getLeadAuditorUsersList($changeControl->division_code); // Notify CFT Person
                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changeControl, 
                                            'site' => "OBS", 
                                            'history' => "More Info Required", 
                                            'process' => 'Observation', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                                ->subject("Agio Notification: Observation, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                 
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                   
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        }         
                         $list = Helpers::getCQAUsersList($changeControl->division_code); // Notify CFT Person
                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changeControl, 
                                            'site' => "OBS", 
                                            'history' => "Submit", 
                                            'process' => 'Observation', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                                ->subject("Agio Notification: Observation, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                 
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                   
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        }                    

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


                    $list = Helpers::getLeadAuditeeUsersList($changeControl->division_code); // Notify CFT Person
                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changeControl, 
                                            'site' => "OBS", 
                                            'history' => "More Info Required", 
                                            'process' => 'Observation', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                                ->subject("Agio Notification: Observation, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                 
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                   
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        }   
                    $list = Helpers::getQAHeadUserList($changeControl->division_code); // Notify CFT Person
                    foreach ($list as $u) {
                        $email = Helpers::getUserEmail($u->user_id);
                    
                        if ($email !== null) {
                            try {
                                Mail::send(
                                    'mail.view-mail',
                                    [
                                        'data' => $changeControl, 
                                        'site' => "OBS", 
                                        'history' => "More Info Required", 
                                        'process' => 'Observation', 
                                        'comment' => $request->comment, 
                                        'user' => Auth::user()->name
                                    ],
                                    function ($message) use ($email, $changeControl) {
                                        $message->to($email)
                                            ->subject("Agio Notification: Observation, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: More Info Required Performed");
                                    }
                                );
                            } catch (\Exception $e) {
                                
                                Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                    
                                
                                session()->flash('error', 'Failed to send email to ' . $email);
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

    public function CapanotStage(Request $request, $id)
    {
        if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
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

                $list = Helpers::getAuditManagerUsersList($changeControl->division_code); // Notify CFT Person
                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changeControl, 
                                            'site' => "OBS", 
                                            'history' => "No CAPAs Required", 
                                            'process' => 'Observation', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                                ->subject("Agio Notification: Observation, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: No CAPAs Required Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                 
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                   
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        } 


                $list = Helpers::getQAUserList($changeControl->division_code); // Notify CFT Person
                        foreach ($list as $u) {
                            $email = Helpers::getUserEmail($u->user_id);
                        
                            if ($email !== null) {
                                try {
                                    Mail::send(
                                        'mail.view-mail',
                                        [
                                            'data' => $changeControl, 
                                            'site' => "OBS", 
                                            'history' => "No CAPAs Required", 
                                            'process' => 'Observation', 
                                            'comment' => $request->comment, 
                                            'user' => Auth::user()->name
                                        ],
                                        function ($message) use ($email, $changeControl) {
                                            $message->to($email)
                                                ->subject("Agio Notification: Observation, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: No CAPAs Required Performed");
                                        }
                                    );
                                } catch (\Exception $e) {
                                 
                                    Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                        
                                   
                                    session()->flash('error', 'Failed to send email to ' . $email);
                                }
                            }
                        }   
                    $list = Helpers::getCQAUsersList($changeControl->division_code); // Notify CFT Person
                    foreach ($list as $u) {
                        $email = Helpers::getUserEmail($u->user_id);
                    
                        if ($email !== null) {
                            try {
                                Mail::send(
                                    'mail.view-mail',
                                    [
                                        'data' => $changeControl, 
                                        'site' => "OBS", 
                                        'history' => "No CAPAs Required", 
                                        'process' => 'Observation', 
                                        'comment' => $request->comment, 
                                        'user' => Auth::user()->name
                                    ],
                                    function ($message) use ($email, $changeControl) {
                                        $message->to($email)
                                            ->subject("Agio Notification: Observation, Record #" . str_pad($changeControl->record, 4, '0', STR_PAD_LEFT) . " - Activity: No CAPAs Required Performed");
                                    }
                                );
                            } catch (\Exception $e) {
                                
                                Log::error('Error sending mail to ' . $email . ': ' . $e->getMessage());
                    
                                
                                session()->flash('error', 'Failed to send email to ' . $email);
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

    public function observation_child(Request $request, $id)
    {
        $cc = Observation::find($id);
        $cft = [];
        $parent_id = $id;
        $parent_type = "Observation";
        $old_records = Capa::select('id', 'division_id', 'record')->get();
        // $record_number = ((RecordNumber::first()->value('counter')) + 1);
        // $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $parent_intiation_date = Capa::where('id', $id)->value('intiation_date');
        // $parent_record =  ((RecordNumber::first()->value('counter')) + 1);
        // $parent_record = str_pad($parent_record, 4, '0', STR_PAD_LEFT);
        $parent_initiator_id = $id;
        $parent_division_id = Observation::where('id', $id)->value('division_code');

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('d-M-Y');
        $changeControl = OpenStage::find(1);
        $relatedRecords = Helpers::getAllRelatedRecords();
        $Capachild = Observation::find($id);
        $reference_record = Helpers::getDivisionName($Capachild->division_code ) . '/' . 'OBS' .'/' . date('Y') .'/' . str_pad($Capachild->record, 4, '0', STR_PAD_LEFT);
        // if(!empty($changeControl->cft)) $cft = explode(',', $changeControl->cft);
        if ($request->revision == "capa-child") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');

            $old_record = Capa::select('id', 'division_id', 'record')->get();
            $lastAi = Capa::orderBy('record', 'desc')->first();
            $record = $lastAi ? $lastAi->record + 1 : 1;
        
            
        // $record = ((RecordNumber::first()->value('counter')) + 1);
            $record = str_pad($record, 4, '0', STR_PAD_LEFT);
            $record_number =$record;
             $data1 = Observation::select('id', 'division_code', 'record', 'due_date')->where('id', $id)->first();
                $data_record = Helpers::getDivisionName($data1->division_code) . '/' . 'OBS' . '/' . date('Y') . '/' . str_pad($data1->record, 4, '0', STR_PAD_LEFT);
                $parent_record = $data_record;
            return view('frontend.forms.capa', compact('record_number', 'due_date', 'parent_id', 'parent_type', 'old_records', 'cft','relatedRecords','reference_record','parent_division_id'));
        }
        if ($request->revision == "Action-Item") {
            $data = Observation::find($id);
            $parent_division_id = Observation::where('id', $id)->value('division_code');
            $parent_record = Helpers::getDivisionName($data->division_code ) . '/' . 'OBS' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
            // $record = $record_number;
            
            $old_record = ActionItem::select('id', 'division_id', 'record')->get();
            $lastAi = ActionItem::orderBy('record', 'desc')->first();
            $record = $lastAi ? $lastAi->record + 1 : 1;
            $record = str_pad($record, 4, '0', STR_PAD_LEFT);
            $record_number =$record;
            
            
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
                

        return view('frontend.action-item.action-item', compact('record','record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id', 'data','parent_division_id','relatedRecords'));
        }
        if ($request->revision == "RCA") {
            $cc->originator = User::where('id', $cc->initiator_id)->value('name');
              $old_record = RootCauseAnalysis::select('id', 'division_id', 'record')->get();
            $lastAi = RootCauseAnalysis::orderBy('record', 'desc')->first();
            $record = $lastAi ? $lastAi->record + 1 : 1;
            $record = str_pad($record, 4, '0', STR_PAD_LEFT);
            $record_number =$record;

                $data = Observation::find($id);
            $parent_division_id = Observation::where('id', $id)->value('division_code');
            $parent_record = Helpers::getDivisionName($data->division_code ) . '/' . 'OBS' .'/' . date('Y') .'/' . str_pad($data->record, 4, '0', STR_PAD_LEFT);
           // $cc->originator = User::where('id', $cc->initiator_id)->value('name');
        
            return view('frontend.forms.root-cause-analysis', compact('record_number', 'due_date', 'parent_id', 'parent_type','parent_intiation_date','parent_record','parent_initiator_id','parent_division_id'));

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

        $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
            $text = " $pageNumber of $pageCount";
            $font = $fontMetrics->getFont('sans-serif', 'normal');
            $size = 9;
            $width = $fontMetrics->getTextWidth($text, $font, $size);

            $canvas->text(($canvas->get_width() - $width - 110), ($canvas->get_height() - 26), $text, $font, $size);
        });

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

        // dd($data);
        $observation_id = $id;
        $griddata = ObservationGrid::where('observation_id',$data->id)->first();
        $grid_Data = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'observation'])->firstOrCreate();
        $grid_Data2 = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'response'])->firstOrCreate();
        $grid_Data3 = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'corrective'])->firstOrCreate();
        $grid_Data4 = ObseravtionSingleGrid::where(['obs_id' => $observation_id, 'identifier' => 'preventive'])->firstOrCreate();
        if (!empty($data)) {
            // $data->data = ObservationGrid::where('e_id', $id)->where('identifier', "details")->first();
            // dd($data->all());
            $data->originator = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.observation.obs_single_report', compact('data','griddata', 'grid_Data', 'grid_Data2', 'grid_Data3', 'grid_Data4'))
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
            return $pdf->stream('Observation' . $id . '.pdf');
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
