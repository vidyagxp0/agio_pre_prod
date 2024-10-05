<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobDescription;
use Illuminate\Support\Facades\Auth;
use App\Models\JobDescriptionGrid;
use App\Models\User;
use App\Models\Employee;
use App\Models\Document;
use App\Models\JobDescriptionAudit;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use PDF;
use App\Models\SetDivision;
use App\Models\RoleGroup;
use App\Models\QMSProcess;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Hash;

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
        // dd($request->all());
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

        // $jobTraining->sopdocument = $request->input('sopdocument');

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
        // $jobTraining->jd_type = $request->input('jd_type');
        $jobTraining->revision_purpose = $request->input('revision_purpose');
        // $jobTraining->remark = $request->input('remark'); 
        $jobTraining->evaluation_required = $request->input('evaluation_required');
        // $jobTraining->delegate = $request->input('delegate');
        // $jobTraining->selected_document_id = $request->input('selected_document_id');


        $jobDescription_id = $jobTraining->id;

        $employeeJobGrid = JobDescriptionGrid::where(['jobDescription_id' => $jobDescription_id, 'identifier' => 'jobResponsibilities'])->firstOrNew();
        
        $employeeJobGrid->jobDescription_id = $jobDescription_id;
        $employeeJobGrid->identifier = 'jobResponsibilities';
        $employeeJobGrid->data = json_encode($request->jobResponsibilities);

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

    public function edit($id)
    {
        $jobTraining = JobDescription::find($id);
        // dd($jobTraining = JobDescription::find($id));
        $employees = Employee::all();
        $delegate = User::all();
        $employee_grid_data = JobDescriptionGrid::where(['jobDescription_id' => $id, 'identifier' => 'jobResponsibilities'])->first();

        return view('frontend.TMS.Job_description.job_description_view',compact('jobTraining','employees','delegate','employee_grid_data'));
    }    

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $jobTraining = JobDescription::findOrFail($id);
        $lastDocument = JobDescription::findOrFail($id);
 
        $jobTraining->name = $request->input('name');
        $jobTraining->department = $request->input('department');
        $jobTraining->location = $request->input('location');

        $jobTraining->hod = $request->input('hod');
        $jobTraining->empcode = $request->input('empcode');
        $jobTraining->type_of_training = $request->input('type_of_training');
        $jobTraining->start_date = $request->input('start_date');
        $jobTraining->end_date = $request->input('end_date');

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
        // $jobTraining->remark = $request->input('remark'); 
        $jobTraining->evaluation_required = $request->input('evaluation_required');
        $jobTraining->delegate = $request->input('delegate');

        $jobTraining->responsible_person_comment = $request->input('responsible_person_comment');
        $jobTraining->qa_review = $request->input('qa_review');
        $jobTraining->qa_cqa_comment = $request->input('qa_cqa_comment');
        $jobTraining->respected_department_comment = $request->input('respected_department_comment');
        $jobTraining->final_review_comment = $request->input('final_review_comment');

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

        if ($request->hasFile('responsible_person_attachment')) {
            $file = $request->file('responsible_person_attachment');
            $name = $request->employee_id . 'responsible_person_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $jobTraining->responsible_person_attachment = $name;
        }

        if ($request->hasFile('respected_department_attachment')) {
            $file = $request->file('respected_department_attachment');
            $name = $request->employee_id . 'respected_department_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $jobTraining->respected_department_attachment = $name;
        }

        if ($request->hasFile('final_review_attachment')) {
            $file = $request->file('final_review_attachment');
            $name = $request->employee_id . 'final_review_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $jobTraining->final_review_attachment = $name;
        }



        $jobDescription_id = $jobTraining->id;

        $employeeJobGrid = JobDescriptionGrid::where(['jobDescription_id' => $jobDescription_id, 'identifier' => 'jobResponsibilities'])->firstOrNew();
        
        $employeeJobGrid->jobDescription_id = $jobDescription_id;
        $employeeJobGrid->identifier = 'jobResponsibilities';
        
        $employeeJobGrid->data = json_encode($request->jobResponsibilities);
        $employeeJobGrid->save();

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

    public function sendJDStage(Request $request, $id)
    {
        try {

            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $jobTraining = JobDescription::find($id);
                $lastjobTraining = JobDescription::find($id);

                if ($jobTraining->stage == 1) {
                    $jobTraining->stage = "2";
                    $jobTraining->status = "In Accept JD";
                    $history = new JobDescriptionAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "In Accept JD";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Submit';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 2) {
                    $jobTraining->stage = "3";
                    $jobTraining->status = "In Responsible Person Accept";

                    $history = new JobDescriptionAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "In Responsible Person Accept";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Accept';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 3) {
                    $jobTraining->stage = "4";
                    $jobTraining->status = "QA/CQA Head Approval";
                    $history = new JobDescriptionAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "QA/CQA Head Approval";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Approval Complete';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 4) {
                    $jobTraining->stage = "5";
                    $jobTraining->status = "In Respected Department";
                    $history = new JobDescriptionAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "In Respected Department";
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
                    $history = new JobDescriptionAudit();
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
                    $history = new JobDescriptionAudit();
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
                    $history = new JobDescriptionAudit();
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

                    $history = new JobDescriptionAudit();
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
                if ($jobTraining->stage == 3) {
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
}
