<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobTraining;
use App\Models\Department;
use App\Models\JobTrainingAudit;
use App\Models\RoleGroup;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JobTrainingController extends Controller
{

    public function index()
    {
        $jobTraining = JobTraining::all();
        return view('frontend.TMS.Job_Training.job_training', compact('jobTraining'));
    }



    public function store(Request $request)
    {

        $jobTraining = new JobTraining();

        $jobTraining->stage = '1';
        $jobTraining->status = 'Opened';
        $jobTraining->name = $request->input('name');
        $jobTraining->department = $request->input('department');
        $jobTraining->location = $request->input('location');

        $jobTraining->hod = $request->input('hod');

        for ($i = 1; $i <= 5; $i++) {
            $jobTraining->{"subject_$i"} = $request->input("subject_$i");
            $jobTraining->{"type_of_training_$i"} = $request->input("type_of_training_$i");
            $jobTraining->{"reference_document_no_$i"} = $request->input("reference_document_no_$i");
            $jobTraining->{"trainee_name_$i"} = $request->input("trainee_name_$i");
            $jobTraining->{"trainer_$i"} = $request->input("trainer_$i");

            $jobTraining->{"startdate_$i"} = $request->input("startdate_$i");
            $jobTraining->{"enddate_$i"} = $request->input("enddate_$i");
        }
        $jobTraining->save();


        if (!empty($request->name)) {
            $validation2 = new JobTrainingAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->name;
            $validation2->activity_type = 'Name';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }


        if (!empty($request->department)) {
            $validation2 = new JobTrainingAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->activity_type = 'Department';
            $validation2->previous = "Null";
            $validation2->current = $request->department;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->location)) {
            $validation2 = new JobTrainingAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->activity_type = 'Location';
            $validation2->previous = "Null";
            $validation2->current = $request->location;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }
        if (!empty($request->hod)) {
            $validation2 = new JobTrainingAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->activity_type = 'HOD';
            $validation2->previous = "Null";
            $validation2->current = $request->hod;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }



        toastr()->success('Job Training created successfully.');
        return redirect('TMS');
        // return redirect()->route('TMS')->with('success', '');
    }


    public function edit($id)
    {

        $jobTraining = JobTraining::find($id);
        // dd($jobTraining);
        $departments = Department::all();
        $users = User::all();

        if (!$jobTraining) {
            return redirect()->route('job_training.index')->with('error', 'Job Training not found');
        }
        return view('frontend.TMS.Job_Training.job_training_view', compact('jobTraining', 'id', 'departments', 'users'));
    }

    public function update(Request $request, $id)
    {
        $jobTraining = JobTraining::findOrFail($id);
        $lastDocument = JobTraining::findOrFail($id);

        // Update fields
        $jobTraining->name = $request->input('name');
        $jobTraining->department = $request->input('department');
        $jobTraining->location = $request->input('location');
        $jobTraining->hod = $request->input('hod');

        for ($i = 1; $i <= 5; $i++) {
            $jobTraining->{"subject_$i"} = $request->input("subject_$i");
            $jobTraining->{"type_of_training_$i"} = $request->input("type_of_training_$i");
            $jobTraining->{"reference_document_no_$i"} = $request->input("reference_document_no_$i");
            $jobTraining->{"trainee_name_$i"} = $request->input("trainee_name_$i");
            $jobTraining->{"trainer_$i"} = $request->input("trainer_$i");

            $jobTraining->{"startdate_$i"} = $request->input("startdate_$i");
            $jobTraining->{"enddate_$i"} = $request->input("enddate_$i");
        }

        $jobTraining->save();

        if ($lastDocument->name != $request->name) {
            $validation2 = new JobTrainingAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->name;
            $validation2->current = $request->name;
            $validation2->activity_type = 'Name';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->name) || $lastDocument->name === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }


        if ($lastDocument->department != $request->department) {
            $validation2 = new JobTrainingAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->activity_type = 'Department';
            $validation2->previous = $lastDocument->department;
            $validation2->current = $request->department;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->department) || $lastDocument->department === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->location != $request->location) {
            $validation2 = new JobTrainingAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->activity_type = 'Location';
            $validation2->previous = $lastDocument->location;
            $validation2->current = $request->location;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->location) || $lastDocument->location === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }
        if ($lastDocument->hod != $request->hod) {
            $validation2 = new JobTrainingAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->activity_type = 'HOD';
            $validation2->previous = $lastDocument->hod;
            $validation2->current = $request->hod;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->hod) || $lastDocument->hod === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        return redirect()->back()->with('success', 'Job Training updated successfully.');
    }

    public function sendStage(Request $request, $id)
    {
        try {

            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $jobTraining = JobTraining::find($id);
                $lastjobTraining = JobTraining::find($id);

                if ($jobTraining->stage == 1) {
                    $jobTraining->stage = "2";
                    $jobTraining->status = "Closed-Retired";

                    $history = new JobTrainingAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "Closed-Retired";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Retire';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }
            }
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function jobAuditTrial($id)
    {
        $jobTraining = JobTraining::find($id);
        $audit = JobTrainingAudit::where('job_id', $id)->orderByDESC('id')->paginate();
        $today = Carbon::now()->format('d-m-y');
        $document = JobTraining::where('id', $id)->first();
        $document->Initiation = User::where('id', $document->initiator_id)->value('name');
        return view('frontend.TMS.Job_Training.job_training_audit', compact('audit', 'document', 'today', 'jobTraining'));
    }
}
