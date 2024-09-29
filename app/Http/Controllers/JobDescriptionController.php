<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobDescription;
use App\Models\JobDescriptionGrid;
use App\Models\User;
use App\Models\Employee;
use App\Models\Document;

class JobDescriptionController extends Controller
{
    public function index()
    {
        $data = Document::all();
        // $hods = DB::table('user_roles')
        //     ->join('users', 'user_roles.user_id', '=', 'users.id')
        //     ->select('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name')
        //     ->where('user_roles.q_m_s_processes_id', $process->id)
        //     ->where('user_roles.q_m_s_roles_id', 4)
        //     ->groupBy('user_roles.q_m_s_processes_id', 'users.id', 'users.role', 'users.name')
        //     ->get();
        $hods = User::get();
        $delegate = User::get();

        $jobTraining = JobDescription::all();
        $employees = Employee::all();

        return view('frontend.TMS.Job_description.job_description', compact('jobTraining','data','hods','delegate','employees'));
    }

    public function getEmployeeData($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    public function store(Request $request)
    {
        $jobTraining = new JobDescription();

        $jobTraining->stage = '1';
        $jobTraining->status = 'Opened';
        $jobTraining->name = $request->input('name');
        $jobTraining->department = $request->input('department');
        $jobTraining->location = $request->input('location');

        $jobTraining->hod = $request->input('hod');
        $jobTraining->empcode = $request->input('empcode');
        $jobTraining->type_of_training = $request->input('type_of_training');
        $jobTraining->start_date = $request->input('start_date');
        $jobTraining->end_date = $request->input('end_date');

        $jobTraining->sopdocument = $request->input('sopdocument');

        $jobTraining->name_employee = $request->input('name_employee');
        $jobTraining->job_description_no = $request->input('job_description_no');
        $jobTraining->effective_date = $request->input('effective_date');
        $jobTraining->employee_id = $request->input('employee_id');
        $jobTraining->new_department = $request->input('new_department');
        $jobTraining->designation = $request->input('designation');
        $jobTraining->qualification = $request->input('qualification');
        $jobTraining->date_joining = $request->input('date_joining');
        $jobTraining->experience_if_any = $request->input('experience_if_any');
        $jobTraining->experience_with_agio = $request->input('experience_with_agio');
        $jobTraining->total_experience = $request->input('total_experience');
        $jobTraining->reason_for_revision = $request->input('reason_for_revision');
        $jobTraining->jd_type = $request->input('jd_type');
        $jobTraining->revision_purpose = $request->input('revision_purpose');
        $jobTraining->remark = $request->input('remark'); 
        $jobTraining->evaluation_required = $request->input('evaluation_required');
        $jobTraining->delegate = $request->input('delegate');
        $jobTraining->selected_document_id = $request->input('selected_document_id');


      $jobDescription_id = $jobTraining->id;

        $employeeJobGrid = JobDescriptionGrid::where(['jobDescription_id' => $jobDescription_id, 'identifier' => 'jobDescription'])->firstOrNew();
        $employeeJobGrid->jobDescription_id = $jobDescription_id;
        $employeeJobGrid->identifier = 'jobDescription';
        $employeeJobGrid->data = $request->jobDescription;  

        $employeeJobGrid->save();

        // for ($i = 1; $i <= 5; $i++) {
        //     $jobTraining->{"subject_$i"} = $request->input("subject_$i");
        //     $jobTraining->{"type_of_training_$i"} = $request->input("type_of_training_$i");
        //     $jobTraining->{"reference_document_no_$i"} = $request->input("reference_document_no_$i");
        //     $jobTraining->{"trainee_name_$i"} = $request->input("trainee_name_$i");
        //     $jobTraining->{"trainer_$i"} = $request->input("trainer_$i");

        //     $jobTraining->{"startdate_$i"} = $request->input("startdate_$i");
        //     $jobTraining->{"enddate_$i"} = $request->input("enddate_$i");
        // }
        $jobTraining->save();


        // if (!empty($request->name)) {
        //     $validation2 = new JobTrainingAudit();
        //     $validation2->job_id = $jobTraining->id;
        //     $validation2->previous = "Null";
        //     $validation2->current = $request->name;
        //     $validation2->activity_type = 'Name';
        //     $validation2->user_id = Auth::user()->id;
        //     $validation2->user_name = Auth::user()->name;
        //     $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

        //     $validation2->change_to =   "Opened";
        //     $validation2->change_from = "Initiation";
        //     $validation2->action_name = 'Create';
        //     $validation2->save();
        // }


        // if (!empty($request->department)) {
        //     $validation2 = new JobTrainingAudit();
        //     $validation2->job_id = $jobTraining->id;
        //     $validation2->activity_type = 'Department';
        //     $validation2->previous = "Null";
        //     $validation2->current = $request->department;
        //     $validation2->comment = "NA";
        //     $validation2->user_id = Auth::user()->id;
        //     $validation2->user_name = Auth::user()->name;
        //     $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

        //     $validation2->change_to =   "Opened";
        //     $validation2->change_from = "Initiation";
        //     $validation2->action_name = 'Create';
        //     $validation2->save();
        // }

        // if (!empty($request->location)) {
        //     $validation2 = new JobTrainingAudit();
        //     $validation2->job_id = $jobTraining->id;
        //     $validation2->activity_type = 'Location';
        //     $validation2->previous = "Null";
        //     $validation2->current = $request->location;
        //     $validation2->comment = "NA";
        //     $validation2->user_id = Auth::user()->id;
        //     $validation2->user_name = Auth::user()->name;
        //     $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

        //     $validation2->change_to =   "Opened";
        //     $validation2->change_from = "Initiation";
        //     $validation2->action_name = 'Create';

        //     $validation2->save();
        // }
        // if (!empty($request->hod)) {
        //     $validation2 = new JobTrainingAudit();
        //     $validation2->job_id = $jobTraining->id;
        //     $validation2->activity_type = 'HOD';
        //     $validation2->previous = "Null";
        //     $validation2->current = $request->hod;
        //     $validation2->comment = "NA";
        //     $validation2->user_id = Auth::user()->id;
        //     $validation2->user_name = Auth::user()->name;
        //     $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

        //     $validation2->change_to =   "Opened";
        //     $validation2->change_from = "Initiation";
        //     $validation2->action_name = 'Create';

        //     $validation2->save();
        // }



        toastr()->success('Job Description created successfully.');
        return redirect('TMS');
        // return redirect()->route('TMS')->with('success', '');
    }

}
