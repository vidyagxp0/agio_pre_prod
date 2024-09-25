<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobTraining;
use App\Models\JobTrainingGrid;
use App\Models\Department;
use App\Models\JobTrainingAudit;
use Illuminate\Support\Facades\Mail;
use App\Models\SetDivision;
use App\Models\RoleGroup;
use App\Models\QMSProcess;
use App\Models\User;
use App\Models\Employee;
use App\Models\Document;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JobTrainingController extends Controller
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

        $jobTraining = JobTraining::all();
        $employees = Employee::all();

        return view('frontend.TMS.Job_Training.job_training', compact('jobTraining','data','hods','delegate','employees'));
    }


    public function getEmployeeDetail($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }


    public function getSopDescription($id)
{
    $document = Document::find($id); // Document ka model use karein
    
    if ($document) {
        return response()->json([
            'short_description' => $document->short_description // Short description field ka naam use karein
        ]);
    }

    return response()->json(['short_description' => ''], 404);
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
        $jobTraining->empcode = $request->input('empcode');
        $jobTraining->type_of_training = $request->input('type_of_training');
        $jobTraining->start_date = $request->input('start_date');
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


      $jobTraining_id = $jobTraining->id;

        $employeeJobGrid = JobTrainingGrid::where(['jobTraining_id' => $jobTraining_id, 'identifier' => 'jobResponsibilites'])->firstOrNew();
        $employeeJobGrid->jobTraining_id = $jobTraining_id;
        $employeeJobGrid->identifier = 'jobResponsibilites';
        $employeeJobGrid->data = $request->jobResponsibilities;  

        $employeeJobGrid->save();

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
        $data = Document::all();
        $record = JobTraining::findOrFail($id);
        $savedSop = $record->sopdocument;
        $employees = Employee::all();
        $employee_grid_data = JobTrainingGrid::where(['jobTraining_id' => $id, 'identifier' => 'jobResponsibilites'])->first();

        // dd($jobTraining);
        $departments = Department::all();
        $users = User::all();

        if (!$jobTraining) {
            return redirect()->route('job_training.index')->with('error', 'Job Training not found');
        }
        return view('frontend.TMS.Job_Training.job_training_view', compact('jobTraining', 'id', 'departments', 'users','data','savedSop','employees','employee_grid_data'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $jobTraining = JobTraining::findOrFail($id);
        $lastDocument = JobTraining::findOrFail($id);

        // Update fields
        $jobTraining->name = $request->input('name');
        $jobTraining->department = $request->input('department');
        $jobTraining->location = $request->input('location');
        $jobTraining->hod = $request->input('hod');

        $jobTraining->empcode = $request->input('empcode');
        $jobTraining->type_of_training = $request->input('type_of_training');
        $jobTraining->start_date = $request->input('start_date');
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

        $jobTraining->evaluation_comment = $request->input('evaluation_comment');
        $jobTraining->qa_review = $request->input('qa_review');
        $jobTraining->qa_cqa_comment = $request->input('qa_cqa_comment');
        $jobTraining->qa_cqa_head_comment = $request->input('qa_cqa_head_comment');
        $jobTraining->final_review_comment = $request->input('final_review_comment');

        // $employeeJobGrid = EmployeeGrid::where(['employee_id' => $employee_id, 'identifier' => 'jobResponsibilites'])->firstOrNew();
        // $employeeJobGrid->employee_id = $employee_id;
        // $employeeJobGrid->identifier = 'jobResponsibilites';
        // $employeeJobGrid->data = $request->jobResponsibilities;
        // $employeeJobGrid->save();

        if ($request->hasFile('qa_review_attachment')) {
            $file = $request->file('qa_review_attachment');
            $name = $request->employee_id . 'qa_review_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $jobTraining->qa_review_attachment = $name;
        }

        if ($request->hasFile('qa_cqa_attachment')) {
            $file = $request->file('qa_cqa_attachment');
            $name = $request->employee_id . 'qa_cqa_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $jobTraining->qa_cqa_attachment = $name;
        }

        if ($request->hasFile('evaluation_attachment')) {
            $file = $request->file('evaluation_attachment');
            $name = $request->employee_id . 'evaluation_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $jobTraining->evaluation_attachment = $name;
        }

        if ($request->hasFile('qa_cqa_head_attachment')) {
            $file = $request->file('qa_cqa_head_attachment');
            $name = $request->employee_id . 'qa_cqa_head_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $jobTraining->qa_cqa_head_attachment = $name;
        }

        if ($request->hasFile('final_review_attachment')) {
            $file = $request->file('final_review_attachment');
            $name = $request->employee_id . 'final_review_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $jobTraining->final_review_attachment = $name;
        }


        $jobTraining_id = $jobTraining->id;

        $employeeJobGrid = JobTrainingGrid::where(['jobTraining_id' => $jobTraining_id, 'identifier' => 'jobResponsibilites'])->firstOrNew();
        $employeeJobGrid->jobTraining_id = $jobTraining_id;
        $employeeJobGrid->identifier = 'jobResponsibilites';
        $employeeJobGrid->data = $request->jobResponsibilities;
        $employeeJobGrid->save();

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
                    $jobTraining->status = "In Accept";
                    $history = new JobTrainingAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "In Accept";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Submit';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 2) {
                    $jobTraining->stage = "3";
                    $jobTraining->status = "QA Review";

                    $history = new JobTrainingAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "QA Review";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Accept Complete';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 3) {
                    $jobTraining->stage = "4";
                    $jobTraining->status = "QA/CQA Head Approval";
                    $history = new JobTrainingAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "QA/CQA Head Approval";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Review Complete';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                // if ($jobTraining->stage == 4) {
                //     $jobTraining->stage = "5";
                //     $jobTraining->status = "QA/CQA Approval";
                //     $history = new JobTrainingAudit();
                //     $history->job_id = $id;
                //     $history->activity_type = 'Activity Log';
                //     $history->current = $jobTraining->qualified_by;
                //     $history->comment = $request->comment;
                //     $history->user_id = Auth::user()->id;
                //     $history->user_name = Auth::user()->name;
                //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                //     $history->change_to = "QA/CQA Approval";
                //     $history->change_from = $lastjobTraining->status;
                //     $history->action = 'Review Complete';
                //     $history->stage = 'Submited';
                //     $history->save();

                //     $jobTraining->update();
                //     return back();
                // }

                if ($jobTraining->stage == 4) {
                    $jobTraining->stage = "5";
                    $jobTraining->status = "Employee Answers";
                    $history = new JobTrainingAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "Employee Answers";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Approval Complete';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 5) {
                    $jobTraining->stage = "6";
                    $jobTraining->status = "Evaluation";
                    $history = new JobTrainingAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "Evaluation";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Answer Submit';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 6) {
                    $jobTraining->stage = "7";
                    $jobTraining->status = "QA/CQA Head Final Review";
                    $history = new JobTrainingAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "QA/CQA Head Final Review";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Evaluation Complete';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 7) {
                    $jobTraining->stage = "8";
                    $jobTraining->status = "Verification and Approval";
                    $history = new JobTrainingAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "Verification and Approval";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'QA/CQA Head Review Complete';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 8) {
                    $jobTraining->stage = "9";
                    $jobTraining->status = "Closed-Done";

                    $history = new JobTrainingAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "Closed-Done";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Verification and Approval Complete';
                    $history->stage = 'Submited';
                    $history->save();

                    // $user = User::find($jobTraining->hod);
                    // if ($user) {
                    //     Mail::send(
                    //         'mail.view-mail',
                    //         ['data' => $jobTraining, 'site'=>"", 'history' => "Need for Sourcing of Starting Material ", 'process' => 'jobTraining', 'comment' => $request->comments, 'user'=> Auth::user()->name],
                    //         function ($message) use ($user, $jobTraining) {
                    //             $message->to($user->email)
                    //             ->subject("TMS Notification: Complete On the Job Training");
                    //         }
                    //     );
                    // }

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

 
    public function cancelStage(Request $request, $id)
    {
        try {

            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $jobTraining = JobTraining::find($id);
                $lastjobTraining = JobTraining::find($id);

                if ($jobTraining->stage == 2) {
                    $jobTraining->stage = "1";
                    $jobTraining->status = "Opened";
                    $history = new JobTrainingAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "Opened";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Reject';
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
