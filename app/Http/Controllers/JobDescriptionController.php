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
use Helpers;
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
        // $jobTraining->name = $request->input('name');
        // $jobTraining->department = $request->input('department');
        // $jobTraining->location = $request->input('location');

        // $jobTraining->hod = $request->input('hod');
        // $jobTraining->empcode = $request->input('empcode');
        // $jobTraining->type_of_training = $request->input('type_of_training');
        // $jobTraining->start_date = $request->input('start_date');
        // $jobTraining->end_date = $request->input('end_date');

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
        $jobTraining->jd_type = $request->input('jd_type');
        $jobTraining->revision_purpose = $request->input('revision_purpose');
        // $jobTraining->remark = $request->input('remark'); 
        $jobTraining->evaluation_required = $request->input('evaluation_required');
        $jobTraining->delegate = $request->input('delegate');
        // $jobTraining->selected_document_id = $request->input('selected_document_id');
        $jobTraining->save();


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

        if (!empty($request->name_employee)) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->name_employee;
            $validation2->activity_type = 'Name of Employee';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->job_description_no)) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->job_description_no;
            $validation2->activity_type = 'Job Description Number';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }
        
        if (!empty($request->effective_date)) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = Helpers::getdateFormat($request->effective_date);
            $validation2->activity_type = 'Effective Date';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->employee_id)) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->employee_id;
            $validation2->activity_type = 'Employee Code';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->new_department)) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->new_department;
            $validation2->activity_type = 'Department';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->designation)) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->designation;
            $validation2->activity_type = 'Designation';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->qualification)) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->qualification;
            $validation2->activity_type = 'Qualification';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->total_experience)) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->total_experience;
            $validation2->activity_type = 'OutSide Experience In Years';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->date_joining)) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = Helpers::getdateFormat($request->date_joining);
            $validation2->activity_type = 'Date of Joining';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->experience_with_agio)) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->experience_with_agio;
            $validation2->activity_type = 'Experience With Agio Pharma';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->experience_if_any)) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->experience_if_any;
            $validation2->activity_type = 'Total Years of Experience';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->jd_type)) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->jd_type;
            $validation2->activity_type = 'Job Description Status';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->reason_for_revision)) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->reason_for_revision;
            $validation2->activity_type = 'Reason for Revision';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->delegate)) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->delegate;
            $validation2->activity_type = 'Delegate';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

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
        if ($employee_grid_data) {
            // Decode the JSON data into an associative array
            $employee_grid_data->data = json_decode($employee_grid_data->data, true); // true converts it into an associative array
        }

        return view('frontend.TMS.Job_description.job_description_view',compact('jobTraining','employees','delegate','employee_grid_data'));
    }    

    public function update(Request $request, $id)
    {
        $jobTraining = JobDescription::findOrFail($id);
        $lastDocument = JobDescription::findOrFail($id);


        $jobTraining->name_employee = $request->input('name_employee');
        $jobTraining->job_description_no = $request->input('job_description_no');
        $jobTraining->effective_date = $request->input('effective_date');
        // $jobTraining->employee_id = $request->input('employee_id');
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


        $jobTraining->save();
        
        $jobDescription_id = $jobTraining->id;

        $employeeJobGrid = JobDescriptionGrid::where(['jobDescription_id' => $jobDescription_id, 'identifier' => 'jobResponsibilities'])->firstOrNew();
        $employeeJobGrid->jobDescription_id = $jobDescription_id;
        $employeeJobGrid->identifier = 'jobResponsibilities';
        $employeeJobGrid->data = json_encode($request->jobResponsibilities);
        $employeeJobGrid->save();

        if ($lastDocument->name_employee != $request->name_employee) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->name_employee;
            $validation2->current = $request->name_employee;
            $validation2->activity_type = 'Name of Employee';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->name_employee) || $lastDocument->name_employee === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->job_description_no != $request->job_description_no) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->job_description_no;
            $validation2->current = $request->job_description_no;
            $validation2->activity_type = 'Job Description Number';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->job_description_no) || $lastDocument->job_description_no === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }
        
        if ($lastDocument->effective_date != $request->effective_date) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = Helpers::getdateFormat($lastDocument->effective_date);
            $validation2->current = Helpers::getdateFormat($request->effective_date);
            $validation2->activity_type = 'Effective Date';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->effective_date) || $lastDocument->effective_date === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->employee_id != $request->employee_id) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->employee_id;
            $validation2->activity_type = 'Employee Code';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->employee_id) || $lastDocument->employee_id === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->new_department != $request->new_department) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->new_department;
            $validation2->current = $request->new_department;
            $validation2->activity_type = 'Department';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->new_department) || $lastDocument->new_department === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->designation != $request->designation){
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->designation;
            $validation2->current = $request->designation;
            $validation2->activity_type = 'Designation';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->designation) || $lastDocument->designation === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->qualification != $request->qualification) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->qualification;
            $validation2->current = $request->qualification;
            $validation2->activity_type = 'Qualification';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->qualification) || $lastDocument->qualification === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->total_experience != $request->total_experience) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->total_experience;
            $validation2->activity_type = 'OutSide Experience In Years';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->total_experience) || $lastDocument->total_experience === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->date_joining != $request->date_joining) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = Helpers::getdateFormat($lastDocument->date_joining);
            $validation2->current = Helpers::getdateFormat($request->date_joining);
            $validation2->activity_type = 'Date of Joining';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->date_joining) || $lastDocument->date_joining === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->experience_with_agio != $request->experience_with_agio) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->experience_with_agio;
            $validation2->current = $request->experience_with_agio;
            $validation2->activity_type = 'Experience With Agio Pharma';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->experience_with_agio) || $lastDocument->experience_with_agio === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->experience_if_any != $request->experience_if_any) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->experience_if_any;
            $validation2->current = $request->experience_if_any;
            $validation2->activity_type = 'Total Years of Experience';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->experience_if_any) || $lastDocument->experience_if_any === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->jd_type != $request->jd_type) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->jd_type;
            $validation2->current = $request->jd_type;
            $validation2->activity_type = 'Job Description Status';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->jd_type) || $lastDocument->jd_type === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->reason_for_revision != $request->reason_for_revision) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->reason_for_revision;
            $validation2->current = $request->reason_for_revision;
            $validation2->activity_type = 'Reason for Revision';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->reason_for_revision) || $lastDocument->reason_for_revision === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->delegate != $request->delegate) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->delegate;
            $validation2->current = $request->delegate;
            $validation2->activity_type = 'Delegate';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->delegate) || $lastDocument->delegate === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

                
        if ($lastDocument->qa_review != $request->qa_review) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->qa_review;
            $validation2->current = $request->qa_review;
            $validation2->activity_type = 'Remark';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->qa_review) || $lastDocument->qa_review === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->qa_review_attachment != $request->qa_review_attachment) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->qa_review_attachment;
            $validation2->current = $jobTraining->qa_review_attachment;
            $validation2->activity_type = 'Attachment';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->qa_review_attachment) || $lastDocument->qa_review_attachment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->qa_cqa_comment != $request->qa_cqa_comment) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->qa_cqa_comment;
            $validation2->current = $request->qa_cqa_comment;
            $validation2->activity_type = 'Remark';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->qa_cqa_comment) || $lastDocument->qa_cqa_comment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->qa_cqa_attachment != $request->qa_cqa_attachment) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->qa_cqa_attachment;
            $validation2->current = $jobTraining->qa_cqa_attachment;
            $validation2->activity_type = 'Attachment';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->qa_cqa_attachment) || $lastDocument->qa_cqa_attachment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->responsible_person_comment != $request->responsible_person_comment) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->responsible_person_comment;
            $validation2->current = $request->responsible_person_comment;
            $validation2->activity_type = 'Remark';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->responsible_person_comment) || $lastDocument->responsible_person_comment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->responsible_person_attachment != $request->responsible_person_attachment) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->responsible_person_attachment;
            $validation2->current = $jobTraining->responsible_person_attachment;
            $validation2->activity_type = 'Attachment';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->responsible_person_attachment) || $lastDocument->responsible_person_attachment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->respected_department_comment != $request->respected_department_comment) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->respected_department_comment;
            $validation2->current = $request->respected_department_comment;
            $validation2->activity_type = 'Remark';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->respected_department_comment) || $lastDocument->respected_department_comment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->respected_department_attachment != $request->respected_department_attachment)  {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->respected_department_attachment;
            $validation2->current = $jobTraining->respected_department_attachment;
            $validation2->activity_type = 'Attachment';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->respected_department_attachment) || $lastDocument->respected_department_attachment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->final_review_comment != $request->final_review_comment) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->final_review_comment;
            $validation2->current = $request->final_review_comment;
            $validation2->activity_type = 'Remark';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->final_review_comment) || $lastDocument->final_review_comment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

         if ($lastDocument->final_review_attachment != $request->final_review_attachment) {
            $validation2 = new JobDescriptionAudit();
            $validation2->job_id = $jobTraining->id;
            $validation2->previous = $lastDocument->final_review_attachment;
            $validation2->current = $jobTraining->final_review_attachment;
            $validation2->activity_type = 'Attachment';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to = "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->final_review_attachment) || $lastDocument->final_review_attachment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }
        

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

            if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
                $jobTraining = JobDescription::find($id);
                $lastjobTraining = JobDescription::find($id);

                if ($jobTraining->stage == 1) {
                    $jobTraining->stage = "2";
                    $jobTraining->status = "In Accept JD";
                    $jobTraining->submit_by = Auth::user()->name;
                    $jobTraining->submit_on = Carbon::now()->format('d-m-Y');
                    $jobTraining->submit_comment = $request->comment;
                    
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
                    $jobTraining->accept_JD_Complete_by = Auth::user()->name;
                    $jobTraining->accept_JD_Complete_on = Carbon::now()->format('d-m-Y');
                    $jobTraining->accept_JD_Complete_comment = $request->comment;

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
                    $jobTraining->accept_by = Auth::user()->name;
                    $jobTraining->accept_on = Carbon::now()->format('d-m-Y');
                    $jobTraining->accept_comment = $request->comment;

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
                    $jobTraining->approval_Complete_by = Auth::user()->name;
                    $jobTraining->approval_Complete_on = Carbon::now()->format('d-m-Y');
                    $jobTraining->approval_Complete_comment = $request->comment;
                    
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
                    $jobTraining->status = "In QA JD Number Allocate";
                    $jobTraining->send_to_QA_by = Auth::user()->name;
                    $jobTraining->send_to_QA_on = Carbon::now()->format('d-m-Y');
                    $jobTraining->send_to_QA_comment = $request->comment;
                    
                    $history = new JobDescriptionAudit();
                    $history->job_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $jobTraining->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "In QA JD Number Allocate";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Answer Submit';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                // if ($jobTraining->stage == 6) {
                //     $jobTraining->stage = "7";
                //     $jobTraining->status = "QA/CQA Head Final Review";
                //     // $jobTraining->closure_by = Auth::user()->name;
                //     // $jobTraining->closure_on = Carbon::now()->format('d-m-Y');
                //     // $jobTraining->closure_comment = $request->comment;

                //     $history = new JobDescriptionAudit();
                //     $history->job_id = $id;
                //     $history->activity_type = 'Activity Log';
                //     $history->current = $jobTraining->qualified_by;
                //     $history->comment = $request->comment;
                //     $history->user_id = Auth::user()->id;
                //     $history->user_name = Auth::user()->name;
                //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                //     $history->change_to = "QA/CQA Head Final Review";
                //     $history->change_from = $lastjobTraining->status;
                //     $history->action = 'Evaluation Complete';
                //     $history->stage = 'Submited';
                //     $history->save();

                //     $jobTraining->update();
                //     return back();
                // }

                // if ($jobTraining->stage == 7) {
                //     $jobTraining->stage = "8";
                //     $jobTraining->status = "Verification and Approval";
                //     $history = new JobDescriptionAudit();
                //     $history->job_id = $id;
                //     $history->activity_type = 'Activity Log';
                //     $history->current = $jobTraining->qualified_by;
                //     $history->comment = $request->comment;
                //     $history->user_id = Auth::user()->id;
                //     $history->user_name = Auth::user()->name;
                //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                //     $history->change_to = "Verification and Approval";
                //     $history->change_from = $lastjobTraining->status;
                //     $history->action = 'QA/CQA Head Review Complete';
                //     $history->stage = 'Submited';
                //     $history->save();

                //     $jobTraining->update();
                //     return back();
                // }

                if ($jobTraining->stage == 6) {
                    $jobTraining->stage = "9";
                    $jobTraining->status = "Closed-Done";
                    $jobTraining->closure_by = Auth::user()->name;
                    $jobTraining->closure_on = Carbon::now()->format('d-m-Y');
                    $jobTraining->closure_comment = $request->comment;

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
            else {
                toastr()->error('E-signature Not match');
                return back();
            }
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function cancelStages(Request $request, $id)
    {
        // dd($request->all());
        try {
            if ($request->username == Auth::user()->emp_code && Hash::check($request->password, Auth::user()->password)) {
                $jobTraining = JobDescription::find($id);
                $lastjobTraining = JobDescription::find($id);

                if ($jobTraining->stage == 2) {
                    $jobTraining->stage = "1";
                    $jobTraining->status = "Opened";
                    $jobTraining->reject_by = Auth::user()->name;
                    $jobTraining->reject_on = Carbon::now()->format('d-m-Y');
                    $jobTraining->reject_comment = $request->comments;

                    $history = new JobDescriptionAudit();
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
                    $jobTraining->reject_by = Auth::user()->name;
                    $jobTraining->reject_on = Carbon::now()->format('d-m-Y');
                    $jobTraining->reject_comment = $request->comments;

                    $history = new JobDescriptionAudit();
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
              
            }else {
                toastr()->error('E-signature Not match');
                return back();
            }
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function AuditTrial($id)
    {
        $jobTraining = JobDescription::find($id);
        $audit = JobDescriptionAudit::where('job_id', $id)->orderByDESC('id')->paginate();
        $today = Carbon::now()->format('d-m-y');
        $document = JobDescription::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');

        return view('frontend.TMS.Job_description.job_description_auditTrail', compact('audit', 'document', 'jobTraining', 'today'));
    }

    public static function report($id)
    {
        $data = JobDescription::find($id);
        if (!empty($data)) {
            $data->originator_id = User::where('id', $data->initiator_id)->value('name');
            $employee_grid_data = JobDescriptionGrid::where(['jobDescription_id' => $id, 'identifier' => 'jobResponsibilities'])->first();
            if ($employee_grid_data) {
                // Decode the JSON data into an associative array
                $employee_grid_data->data = json_decode($employee_grid_data->data, true); // true converts it into an associative array
            }
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadView('frontend.TMS.Job_description.job_description_report', compact('data','employee_grid_data'))
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
            return $pdf->stream('example.pdf' . $id . '.pdf');
        }
    }

}
