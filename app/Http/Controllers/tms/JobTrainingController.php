<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobTraining;
use App\Models\EmpTrainingQuizResult;
use App\Models\DocumentTraining;
use App\Models\Training;
use App\Models\Quize;
use App\Models\Question;
use App\Models\JobTrainingGrid;
use App\Models\Department;
use App\Models\JobTrainingAudit;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use PDF;
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

//     public function index()
// {
//     // All documents
//     $data = Document::all();

//     // Fetch questions for each document
//     $documentQuestions = [];
//     foreach ($data as $document) {
//         $document_training = DocumentTraining::where('document_id', $document->id)->first();
//         if ($document_training) {
//             $training = Training::find($document_training->training_plan);
//             if ($training && $training->training_plan_type == "Read & Understand with Questions") {
//                 $quize = Quize::find($training->quize);
//                 $questions = explode(',', $quize->question);
//                 $question_list = [];

//                 foreach ($questions as $question_id) {
//                     $question = Question::find($question_id);
//                     if ($question) {
//                         $json_options = unserialize($question->options);
//                         $options = [];
//                         foreach ($json_options as $key => $value) {
//                             $options[chr(97 + $key)] = $value; // Format options
//                         }
//                         $question->options = $options;
//                         $question_list[] = $question;
//                     }
//                 }
//                 $documentQuestions[$document->id] = $question_list;
//             }
//         }
//     }

//     $hods = User::all();
//     $delegate = User::all();
//     $jobTraining = JobTraining::all();
//     $employees = Employee::all();

//     return view('frontend.TMS.Job_Training.job_training', compact('jobTraining', 'data', 'hods', 'delegate', 'employees', 'documentQuestions'));
// }


public function fetchQuestions($id)
{
    $document_training = DocumentTraining::where('document_id', $id)->first();
    if ($document_training) {
        $training = Training::find($document_training->training_plan); 
        if ($training && $training->training_plan_type == "Read & Understand with Questions") {
            $quize = Quize::find($training->quize);
            $questions = explode(',', $quize->question);
            $question_list = [];

            foreach ($questions as $question_id) {
                $question = Question::find($question_id);
                if ($question) {
                    $json_options = unserialize($question->options);
                    $options = [];
                    foreach ($json_options as $key => $value) {
                        $options[chr(97 + $key)] = $value; // Format options
                    }
                    $question->options = $options;
                    $question_list[] = $question;
                }
            }
            return response()->json($question_list); // Return questions array as JSON
        }
    }
    return response()->json([]); // Return empty array if no questions found
}

public function trainingQuestions($id){

    $document = Document::find($id);
    $document_training = DocumentTraining::where('document_id',$id)->first();
    $training = Training::find($document_training->training_plan);
    if($training->training_plan_type == "Read & Understand with Questions"){
        $quize = Quize::find($training->quize);
        $data = explode(',',$quize->question);
        // dd($document_training);
        $array = [];

        for($i = 0; $i<count($data); $i++){
            $question = Question::find($data[$i]);
            $question->id = $i+1;
            $json_option = unserialize($question->options);
            $options = [];
            foreach($json_option as $key => $value){
                $options[chr(97 + $key)] = $value;
            }
            $question->options = array($options);
            $ans = unserialize($question->answers);
            $question->answers = implode("", $ans);
            $question->score = 0;
            $question->status = "";

            array_push($array,$question);
        }
         $data_array = implode(',',$array);

        return view('frontend.TMS.Job_Training.quize',compact('document','data_array','quize'));
   }
   else{
    toastr()->error('Training not specified');
    return back();
   }
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
        
        $document_training = DocumentTraining::where('document_id', $id)->first();
         // Use optional() to avoid null errors when training_plan or quize is null
         $training = optional($document_training)->training_plan ? Training::find($document_training->training_plan) : null;
         $quize = optional($training)->quize ? Quize::find($training->quize) : null;
        // $training = Training::find($document_training->training_plan); 
        // $quize = Quize::find($training->quize);
        $employee_grid_data = JobTrainingGrid::where(['jobTraining_id' => $id, 'identifier' => 'jobResponsibilites'])->first();

        // dd($jobTraining);
        $departments = Department::all();
        $users = User::all();

        if (!$jobTraining) {
            return redirect()->route('job_training.index')->with('error', 'Job Training not found');
        }
        return view('frontend.TMS.Job_Training.job_training_view', compact('jobTraining', 'id', 'departments', 'users','data','savedSop','quize','training','document_training','employees','employee_grid_data'));
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

        $jobTraining->evaluation_comment = $request->input('evaluation_comment');
        $jobTraining->qa_review = $request->input('qa_review');
        $jobTraining->qa_cqa_comment = $request->input('qa_cqa_comment');
        $jobTraining->qa_cqa_head_comment = $request->input('qa_cqa_head_comment');
        $jobTraining->final_review_comment = $request->input('final_review_comment');
        $jobTraining->selected_document_id = $request->input('selected_document_id');


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
                    $history->action = 'Submit';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 2) {
                    $jobTraining->stage = "3";
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

                if ($jobTraining->stage == 3) {
                    $jobTraining->stage = "4";
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

                if ($jobTraining->stage == 5) {
                    $jobTraining->stage = "6";
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

                // if ($jobTraining->stage == 6) {
                //     $jobTraining->stage = "7";
                //     $jobTraining->status = "QA/CQA Head Final Review";
                //     $history = new JobTrainingAudit();
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
                //     $history = new JobTrainingAudit();
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
                    $jobTraining->stage = "7";
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
   
    public static function jobReport($id)
    {
        $data = JobTraining::find($id);
        if (!empty($data)) {
            $data->originator_id = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.TMS.Job_Training.job_report', compact('data'))
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

    public function viewrendersop($id){

        return view('frontend.TMS.on_the_job_training_detail', compact('id'));
    }

    public function viewPdf($id)
    {

        $depaArr = ['ACC' => 'Accounting', 'ACC3' => 'Accounting',];
        $data = Document::find($id);
        //$data->department = Department::find($data->department_id);
        $department = Department::find(Auth::user()->departmentid);
        $document = Document::find($id);

        if ($department) {
            $data['department_name'] = $department->name;
        } else {
            $data['department_name'] = '';
        }
        $data->department = $department;

        $data['originator'] = User::where('id', $data->originator_id)->value('name');
        $data['originator_email'] = User::where('id', $data->originator_id)->value('email');
        $data['document_type_name'] = DocumentType::where('id', $data->document_type_id)->value('name');
        $data['document_type_code'] = DocumentType::where('id', $data->document_type_id)->value('typecode');

        $data['document_division'] = Division::where('id', $data->division_id)->value('name');
        $data['year'] = Carbon::parse($data->created_at)->format('Y');
        $data['document_content'] = DocumentContent::where('document_id', $id)->first();

        // pdf related work
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();

        // return view('frontend.documents.pdfpage', compact('data', 'time', 'document'))->render();
        // $pdf = PDF::loadview('frontend.documents.new-pdf', compact('data', 'time', 'document'))
        $pdf = PDF::loadview('frontend.documents.pdfpage', compact('data', 'time', 'document'))
            ->setOptions([
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'isPhpEnabled' => true,
            ]);
        $pdf->setPaper('A4');
        $pdf->render();
        $canvas = $pdf->getDomPDF()->getCanvas();
        $canvas->set_default_view('FitB');
        $height = $canvas->get_height();
        $width = $canvas->get_width();

        $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');

        $canvas->page_text(
            $width / 4,
            $height / 2,
            Helpers::getDocStatusByStage($data->stage),
            null,
            25,
            [0, 0, 0],
            2,
            6,
            -20
        );

        if ($data->documents) {

            $pdfArray = explode(',', $data->documents);
            foreach ($pdfArray as $pdfFile) {
                $existingPdfPath = public_path('upload/PDF/' . $pdfFile);
                $permissions = 0644; // Example permission value, change it according to your needs
                if (file_exists($existingPdfPath)) {
                    // Create a new Dompdf instance
                    $options = new Options();
                    $options->set('chroot', public_path());
                    $options->set('isPhpEnabled', true);
                    $options->set('isRemoteEnabled', true);
                    $options->set('isHtml5ParserEnabled', true);
                    $options->set('allowedFileExtensions', ['pdf']); // Allow PDF file extension

                    $dompdf = new Dompdf($options);

                    chmod($existingPdfPath, $permissions);

                    // Load the existing PDF file
                    $dompdf->loadHtmlFile($existingPdfPath);

                    // Render the PDF
                    $dompdf->render();

                    // Output the PDF to the browser
                    $dompdf->stream();
                }
            }
        }

        return $pdf->stream('SOP' . $id . '.pdf');
    }

    public function questionshow($sopids, $onthejobid){
        $onthejobid = JobTraining::find($onthejobid);
        $onthejobid->attempt_count = $onthejobid->attempt_count == 0 ? 0 : $onthejobid->attempt_count - 1;
        $onthejobid->save();
        $sopidsArray = explode(',', $sopids);

        $sopidsArray = array_map('trim', $sopidsArray);
        $questions = Question::where('document_id', $sopidsArray)
            ->get();
        return view('frontend.TMS.Job_Training.on_the_job_question_Answer', compact('questions', 'onthejobid'));

    }

    // public function checkAnswerOTJ(Request $request)
    // {
    //     $questions = Question::all(); // Retrieve all questions related to the quiz
    //     $correctCount = 0;
    //     $totalQuestions = count($questions);
    
    //     // Loop through each question and validate the user's response
    //     foreach ($questions as $question) {
    //         $userAnswer = $request->input('question_' . $question->id); // Get user answer for the specific question
    //         $correctAnswers = unserialize($question->answers); // Retrieve correct answers from the database
    //         $questionType = $question->type;
    
    //         // Check if the user's answer is correct based on the question type
    //         if ($questionType === 'Single Selection Questions') {
    //             if ($userAnswer == $correctAnswers[0]) {
    //                 $correctCount++;
    //             }
    //         } elseif ($questionType === 'Multi Selection Questions') {
    //             if (is_array($userAnswer) && count(array_diff($correctAnswers, $userAnswer)) === 0 && count(array_diff($userAnswer, $correctAnswers)) === 0) {
    //                 $correctCount++;
    //             }
    //         }
    //     }
    
    //     // Calculate the percentage score
    //     $score = ($correctCount / $totalQuestions) * 100;
    
    //     // Determine pass or fail based on the 80% criteria
    //     $result = $score >= 80 ? 'Pass' : 'Fail';
    
    //     return view('frontend.TMS.Job_Training.job_quiz_result', [
    //         'totalQuestions' => $totalQuestions,
    //         'correctCount' => $correctCount,
    //         'score' => $score,
    //         'result' => $result
    //     ]);
        
    // }
    
    
    // public function checkAnswerOTJ(Request $request)
    // {
    //     // Retrieve a random subset of 10 questions from the database (adjust this as needed)
    //     $questions = Question::inRandomOrder()->take(10)->get();
    //     $correctCount = 0;
    //     $totalQuestions = count($questions);
    
    //     // Loop through each question and validate the user's response
    //     foreach ($questions as $question) {
    //         $userAnswer = $request->input('question_' . $question->id); // Get user answer for the specific question
    //         $correctAnswers = unserialize($question->answers); // Retrieve correct answers from the database
    //         $questionType = $question->type;
    
    //         // Check if the user's answer is correct based on the question type
    //         if ($questionType === 'Single Selection Questions') {
    //             if ($userAnswer == $correctAnswers[0]) {
    //                 $correctCount++;
    //             }
    //         } elseif ($questionType === 'Multi Selection Questions') {
    //             if (is_array($userAnswer) && count(array_diff($correctAnswers, $userAnswer)) === 0 && count(array_diff($userAnswer, $correctAnswers)) === 0) {
    //                 $correctCount++;
    //             }
    //         }
    //     }
    
    //     // Calculate the percentage score
    //     $score = ($correctCount / $totalQuestions) * 100;
    
    //     // Determine pass or fail based on the 80% criteria
    //     $result = $score >= 80 ? 'Pass' : 'Fail';
    
    //     // Return the correct view with result data
    //     return view('frontend.TMS.Job_Training.job_quiz_result', [
    //         'totalQuestions' => $totalQuestions,
    //         'correctCount' => $correctCount,
    //         'score' => $score,
    //         'result' => $result
    //     ]);
    // }
    











//     public function checkAnswerOTJ(Request $request)
// {
//     // Retrieve a combination of 'Single Selection' and 'Multi Selection' questions, then shuffle and select 10
//     $allQuestions = Question::inRandomOrder()->get(); // Get all questions randomly

//     // Filter only 'Single Selection' and 'Multi Selection' questions
//     $filteredQuestions = $allQuestions->filter(function ($question) {
//         return in_array($question->type, ['Single Selection Questions', 'Multi Selection Questions']);
//     });

//     // Take only 10 questions from the filtered collection
//     $questions = $filteredQuestions->take(10); 

//     $correctCount = 0;
//     $totalQuestions = count($questions);

//     // Loop through each question and validate the user's response
//     foreach ($questions as $question) {
//         $userAnswer = $request->input('question_' . $question->id); // Get user answer for the specific question
//         $correctAnswers = unserialize($question->answers); // Retrieve correct answers from the database
//         $questionType = $question->type;

//         // Check if the user's answer is correct based on the question type
//         if ($questionType === 'Single Selection Questions') {
//             if ($userAnswer == $correctAnswers[0]) {
//                 $correctCount++;
//             }
//         } elseif ($questionType === 'Multi Selection Questions') {
//             if (is_array($userAnswer) && count(array_diff($correctAnswers, $userAnswer)) === 0 && count(array_diff($userAnswer, $correctAnswers)) === 0) {
//                 $correctCount++;
//             }
//         }
//     }

//     // Calculate the percentage score
//     $score = ($correctCount / $totalQuestions) * 100;

//     // Determine pass or fail based on the 80% criteria
//     $result = $score >= 80 ? 'Pass' : 'Fail';

//     // Return the correct view with result data
//     return view('frontend.TMS.Job_Training.job_quiz_result', [
//         'totalQuestions' => $totalQuestions,
//         'correctCount' => $correctCount,
//         'score' => $score,
//         'result' => $result
//     ]);
// }




// public function checkAnswerOTJ(Request $request)
// {
  
//     $allQuestions = Question::inRandomOrder()->get(); 
//     $filteredQuestions = $allQuestions->filter(function ($question) {
//         return in_array($question->type, ['Single Selection Questions', 'Multi Selection Questions']);
//     });
  
   
//     $questions = $filteredQuestions->take(10); 

//     $correctCount = 0; 
//     $totalQuestions = count($questions); 

  
//     foreach ($questions as $question) {
//         $userAnswer = $request->input('question_' . $question->id); 
//         $correctAnswers = unserialize($question->answers);
//         $questionType = $question->type;

      
//         if ($questionType === 'Single Selection Questions') {
          
//             if ($userAnswer == $correctAnswers[0]) {
//                 $correctCount++;
//             }
//         } elseif ($questionType === 'Multi Selection Questions') {
           
//             if (is_array($userAnswer) && count(array_diff($correctAnswers, $userAnswer)) === 0 && count(array_diff($userAnswer, $correctAnswers)) === 0) {
//                 $correctCount++; 
//             }
//         }
//     }

   
//     $score = ($correctCount / $totalQuestions) * 100;

  
//     $result = $score >= 80 ? 'Pass' : 'Fail';

//     return view('frontend.TMS.Job_Training.job_quiz_result', [
//         'totalQuestions' => $totalQuestions,
//         'correctCount' => $correctCount,
//         'score' => $score,
//         'result' => $result
//     ]);
// }

// public function checkAnswerOTJ(Request $request)
// {
//     // Fetch all questions in a random order
//     $allQuestions = Question::inRandomOrder()->get();

//     // Filter questions to include only Single and Multi Selection Questions
//     $filteredQuestions = $allQuestions->filter(function ($question) {
//         return in_array($question->type, ['Single Selection Questions', 'Multi Selection Questions']);
//     });

//     // Take the first 10 questions from the filtered list
//     $questions = $filteredQuestions->take(10);

//     $correctCount = 0; // Initialize correct answer count
//     $totalQuestions = count($questions); // Total number of selected questions

//     foreach ($questions as $question) {
//         // Retrieve user's answer for each question
//         $userAnswer = $request->input('question_' . $question->id);
//         $correctAnswers = unserialize($question->answers); // Correct answers for the question
//         $questionType = $question->type;

//         if ($questionType === 'Single Selection Questions') {
//             // If it's a single selection question, check if the user's answer matches the correct answer
//             if ($userAnswer == $correctAnswers[0]) {
//                 $correctCount++;
//             }
//         } elseif ($questionType === 'Multi Selection Questions') {
//             // If it's a multi-selection question, check if all the answers match
//             if (is_array($userAnswer)) {
//                 // Check if the user's answer matches exactly with the correct answer set
//                 if (count(array_diff($correctAnswers, $userAnswer)) === 0 && count(array_diff($userAnswer, $correctAnswers)) === 0) {
//                     $correctCount++;
//                 }
//             }
//         }
//     }

//     // Calculate the correct percentage based on the total questions
//     $score = ($correctCount / $totalQuestions) * 100;

//     // Determine the pass/fail result based on 80% correct criteria
//     $result = $score >= 80 ? 'Pass' : 'Fail';

//     return view('frontend.TMS.Job_Training.job_quiz_result', [
//         'totalQuestions' => $totalQuestions, // Total questions shown
//         'correctCount' => $correctCount, // Number of correctly answered questions
//         'score' => $score, // Final score
//         'result' => $result // Pass or Fail
//     ]);
// }


public function checkAnswerOTJ(Request $request)

{
    // Fetch all questions in a random order

    $allQuestions = Question::inRandomOrder()->get();

    // Filter questions to include only Single and Multi Selection Questions
    $filteredQuestions = $allQuestions->filter(function ($question) {
        return in_array($question->type, ['Single Selection Questions', 'Multi Selection Questions']);
    });

    // Take the first 10 questions from the filtered list
    $questions = $filteredQuestions->take(10);

    $correctCount = 0; // Initialize correct answer count
    $totalQuestions = count($questions); // Total number of selected questions (should be 10)

    foreach ($questions as $question) {
        // Retrieve user's answer for each question
        $userAnswer = $request->input('question_' . $question->id);
        $correctAnswers = unserialize($question->answers); // Correct answers for the question
        $questionType = $question->type;

        if ($questionType === 'Single Selection Questions') {
            // If it's a single selection question, check if the user's answer matches the correct answer
            if ($userAnswer == $correctAnswers[0]) {
                $correctCount++;
            }
        } elseif ($questionType === 'Multi Selection Questions') {
            // If it's a multi-selection question, check if the user's answer matches exactly with the correct answer set
            if (is_array($userAnswer)) {
                // Check if the user's answer matches exactly with the correct answer set
                if (count(array_diff($correctAnswers, $userAnswer)) === 0 && count(array_diff($userAnswer, $correctAnswers)) === 0) {
                    $correctCount++;
                }
            }
        }
    }

    // Calculate the correct percentage for the 10 questions
    $score = ($correctCount / $totalQuestions) * 100; // This will be based on 10 questions

   
    $result = $score >= 80 ? 'Pass' : 'Fail';

    if($result == 'Pass'){
        $storeResult = new EmpTrainingQuizResult();
        $storeResult->emp_id = "PW1";
        $storeResult->employee_name = "PW1";
        $storeResult->training_type = "PW1";
        $storeResult->correct_answers = "PW1";
        $storeResult->incorrect_answers = "PW1";
        $storeResult->total_questions = "PW1";
        $storeResult->score = "PW1";
        $storeResult->result = "PW1";
        $storeResult->attempt_number = "PW1";
    }

    return view('frontend.TMS.Job_Training.job_quiz_result', [
        'totalQuestions' => $totalQuestions, // Total questions shown
        'correctCount' => $correctCount, // Number of correctly answered questions
        'score' => $score, // Final score for these 10 questions
        'result' => $result // Pass or Fail based on 80%
    ]);
}



}
