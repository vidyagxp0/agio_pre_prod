<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use App\Models\RecordNumber;
use App\Models\DocumentTraining;
use App\Models\Training;
use App\Models\Quize;
use App\Models\Question;
use App\Models\Document;
use App\Models\RoleGroup;
use App\Models\TrainerGrid;
use App\Models\QuestionariesTrainingGrid;
use App\Models\TrainerQualification;
use App\Models\TrainerQualificationAuditTrial;
use App\Models\User;
use Illuminate\Support\Facades\App;
use PDF;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TrainerController extends Controller
{

    public function index()
    {
        $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = str_pad($record, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        $employees = Employee::all();
        return view('frontend.TMS.Trainer_qualification.trainer_qualification', compact('due_date', 'record','employees'));
    }

    public function getEmployeeDetails($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    public function fetchQuestionss($id)
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

    public function getQuestions($documentId)
    {
        $document_training = DocumentTraining::where('document_id', $documentId)->first();
        if ($document_training && $document_training->training_plan) {
            $training = Training::find($document_training->training_plan);
            $quize = Quize::find($training->quize);
    
            // Assuming your Quize model has a relation to questions and choices
            $questions = $quize->questions->map(function ($question) {
                return [
                    'id' => $question->id,
                    'question' => $question->question_text,
                    'choices' => $question->choices->pluck('option_text'), // Assuming choices relation
                    'answer' => $question->answer,
                ];
            });
    
            return response()->json(['success' => true, 'questions' => $questions]);
        }
    
        return response()->json(['success' => false]);
    }
    

    public function store(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => [],
        ];
        // try {
        $recordCounter = RecordNumber::first();
        $newRecordNumber = $recordCounter->counter + 1;

        $recordCounter->counter = $newRecordNumber;
        $recordCounter->save();

        $trainer = new TrainerQualification();
        $trainer->stage = '1';
        $trainer->status = 'Opened';
        $trainer->division_id = $request->division_id;
        $trainer->record_number = ((RecordNumber::first()->value('counter')) + 1);

        // $trainer->record_number = $request->record_number;
        $trainer->site_code = $request->site_code;
        $trainer->employee_id = $request->employee_id;
        $trainer->employee_name = $request->employee_name;
        // $trainer->name_employee = $request->name_employee;
        $trainer->initiator = $request->initiator;
        $trainer->date_of_initiation = $request->date_of_initiation;
        $trainer->assigned_to = $request->assigned_to;
        $trainer->due_date = $request->due_date;
        $trainer->short_description = $request->short_description;
        $trainer->description = $request->description;
        $trainer->trainer_name = $request->trainer_name;
        $trainer->qualification = $request->qualification;
        $trainer->designation = $request->designation;
        $trainer->department = $request->department;
        $trainer->experience = $request->experience;
        $trainer->hod = $request->hod;
        $trainer->trainer = $request->trainer;
        $trainer->training_date = $request->training_date;
        $trainer->topic = $request->topic;
        $trainer->type = $request->type;
        $trainer->evaluation = $request->evaluation;
        $trainer->evaluation_through = $request->evaluation_through;
        
        $trainer->evaluation_criteria_1 = $request->evaluation_criteria_1;
        $trainer->evaluation_criteria_2 = $request->evaluation_criteria_2;
        $trainer->evaluation_criteria_3 = $request->evaluation_criteria_3;
        $trainer->evaluation_criteria_4 = $request->evaluation_criteria_4;
        $trainer->evaluation_criteria_5 = $request->evaluation_criteria_5;
        $trainer->evaluation_criteria_6 = $request->evaluation_criteria_6;
        $trainer->evaluation_criteria_7 = $request->evaluation_criteria_7;
        $trainer->evaluation_criteria_8 = $request->evaluation_criteria_8;
        $trainer->qualification_comments = $request->qualification_comments;

        if ($request->hasFile('initial_attachment')) {
            $file = $request->file('initial_attachment');
            $name = $request->employee_id . 'initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $trainer->initial_attachment = $name; // Store only the file name
        }

        $trainer->save();
        // dd ($trainer->id);


        $trainer_qualification_id = $trainer->id;

        $trainerSkillGrid = TrainerGrid::where(['trainer_qualification_id' => $trainer_qualification_id, 'identifier' => 'trainerSkillSet'])->firstOrNew();
        $trainerSkillGrid->trainer_qualification_id = $trainer_qualification_id;
        $trainerSkillGrid->identifier = 'trainerSkillSet';
        $trainerSkillGrid->data = $request->trainer_skill;
        $trainerSkillGrid->save();

        // $induction_id = $inductionTraining->id;
        $employeeJobGrid = QuestionariesTrainingGrid::where(['trainer_qualification_id' => $trainer_qualification_id, 'identifier' => 'Questionaries'])->firstOrNew();
        $employeeJobGrid->trainer_qualification_id = $trainer_qualification_id;
        $employeeJobGrid->identifier = 'Questionaries';
        $employeeJobGrid->data = $request->jobResponsibilities;  
        $employeeJobGrid->save();

        $trainerListGrid = TrainerGrid::where(['trainer_qualification_id' => $trainer_qualification_id, 'identifier' => 'listOfAttachment'])->firstOrNew();
        $trainerListGrid->trainer_qualification_id = $trainer_qualification_id;
        $trainerListGrid->identifier = 'listOfAttachment';
        $trainerListGrid->data = $request->trainer_listOfAttachment;
        $trainerListGrid->save();


        //Audit Trails 
        if (!empty($request->short_description)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->previous = "Null";
            $validation2->current = $request->short_description;
            $validation2->activity_type = 'Short Description';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->date_of_initiation)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Date of Initiation';
            $validation2->previous = "Null";
            $validation2->current = $request->date_of_initiation;
            $validation2->comment = "Not Applicable";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->assign_to)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Assign To';
            $validation2->previous = "Null";
            $validation2->current = $request->assign_to;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->due_date)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Due Date';
            $validation2->previous = "Null";
            $validation2->current = $request->due_date;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }
        if (!empty($request->trainer_name)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Trainer Name';
            $validation2->previous = "Null";
            $validation2->current = $request->trainer_name;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->qualification)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Qualification';
            $validation2->previous = "Null";
            $validation2->current = $request->qualification;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->training_date)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Schedule Training date';
            $validation2->previous = "Null";
            $validation2->current = $request->training_date;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->topic)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Topic of Training';
            $validation2->previous = "Null";
            $validation2->current = $request->topic;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->type)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Type of Training';
            $validation2->previous = "Null";
            $validation2->current = $request->type;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->evaluation)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Evaluation Required';
            $validation2->previous = "Null";
            $validation2->current = $request->evaluation;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->evaluation_through)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Evaluation Through';
            $validation2->previous = "Null";
            $validation2->current = $request->evaluation_through;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->designation)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Designation';
            $validation2->previous = "Null";
            $validation2->current = $request->designation;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->department)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
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

        if (!empty($request->experience)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Experience (No. of Years)';
            $validation2->previous = "Null";
            $validation2->current = $request->experience;
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
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
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

        if (!empty($request->trainer)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Qualification Status';
            $validation2->previous = "Null";
            $validation2->current = $request->trainer;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->qualification_comments)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Qualification Comments';
            $validation2->previous = "Null";
            $validation2->current = $request->qualification_comments;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->initial_attachment)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Initial Attachment';
            $validation2->previous = "Null";
            $validation2->current = $request->initial_attachment;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }





        toastr()->success("Record is created Successfully");
        return redirect(url('TMS'));
        // return response()->json($res);
    }

    public function update(Request $request, $id)
    {

        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => [],
        ];
        // try {
        $trainer = TrainerQualification::findOrFail($id);
        $lastdocument = TrainerQualification::findOrFail($id);

        $trainer->division_id = $request->division_id;
        $trainer->site_code = $request->site_code;
        $trainer->employee_id = $request->employee_id;
        $trainer->employee_name = $request->employee_name;
        $trainer->initiator = $request->initiator;
        $trainer->date_of_initiation = $request->date_of_initiation;
        $trainer->assigned_to = $request->assigned_to;
        $trainer->due_date = $request->due_date;
        $trainer->short_description = $request->short_description;
        $trainer->description = $request->description;
        $trainer->trainer_name = $request->trainer_name;
        $trainer->qualification = $request->qualification;
        $trainer->designation = $request->designation;
        $trainer->department = $request->department;
        $trainer->experience = $request->experience;
        $trainer->hod = $request->hod;
        $trainer->trainer = $request->trainer;

        $trainer->training_date = $request->training_date;
        $trainer->topic = $request->topic;
        $trainer->type = $request->type;
        $trainer->evaluation = $request->evaluation;
        $trainer->evaluation_through = $request->evaluation_through;
        $trainer->sopdocument = $request->sopdocument;

        $trainer->qa_final_comment = $request->qa_final_comment;
        $trainer->hod_comment = $request->hod_comment;
        $trainer->trainer_acknowledge_comment = $request->trainer_acknowledge_comment;
        $trainer->start_date = $request->start_date;
        $trainer->end_date = $request->end_date;
        $trainer->start_time = $request->start_time;
        $trainer->end_time = $request->end_time;
        $trainer->pending_training_comment = $request->pending_training_comment;
        $trainer->evaluation_by_hod = $request->evaluation_by_hod;
        $trainer->evaluation_criteria_hod = $request->evaluation_criteria_hod;
        $trainer->evaluation_by_qa = $request->evaluation_by_qa;
        $trainer->evaluation_criteria_qa = $request->evaluation_criteria_qa;

        $trainer->evaluation_criteria_1 = $request->evaluation_criteria_1;
        $trainer->evaluation_criteria_2 = $request->evaluation_criteria_2;
        $trainer->evaluation_criteria_3 = $request->evaluation_criteria_3;
        $trainer->evaluation_criteria_4 = $request->evaluation_criteria_4;
        $trainer->evaluation_criteria_5 = $request->evaluation_criteria_5;
        $trainer->evaluation_criteria_6 = $request->evaluation_criteria_6;
        $trainer->evaluation_criteria_7 = $request->evaluation_criteria_7;
        $trainer->evaluation_criteria_8 = $request->evaluation_criteria_8;
        $trainer->qualification_comments = $request->qualification_comments;

        if ($request->hasFile('hod_attachment')) {
            $file = $request->file('hod_attachment');
            $name = $request->employee_id . 'hod_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $trainer->hod_attachment = $name;
        }

        if ($request->hasFile('qa_final_attachment')) {
            $file = $request->file('qa_final_attachment');
            $name = $request->employee_id . 'qa_final_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $trainer->qa_final_attachment = $name;
        }

        if ($request->hasFile('initial_attachment')) {
            $file = $request->file('initial_attachment');
            $name = $request->employee_id . 'initial_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $trainer->initial_attachment = $name;
        }

        if ($request->hasFile('trainer_acknowledge_attachments')) {
            $file = $request->file('trainer_acknowledge_attachments');
            $name = $request->employee_id . 'trainer_acknowledge_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $trainer->trainer_acknowledge_attachments = $name;
        }

        if ($request->hasFile('pending_training_attachments')) {
            $file = $request->file('pending_training_attachments');
            $name = $request->employee_id . 'pending_training_attachments' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $trainer->pending_training_attachments = $name;
        }

        $trainer->save();

        $trainer_qualification_id = $trainer->id;

        $trainerSkillGrid = TrainerGrid::where(['trainer_qualification_id' => $trainer_qualification_id, 'identifier' => 'trainerSkillSet'])->firstOrNew();
        $trainerSkillGrid->trainer_qualification_id = $trainer_qualification_id;
        $trainerSkillGrid->identifier = 'trainerSkillSet';
        $trainerSkillGrid->data = $request->trainer_skill;
        $trainerSkillGrid->save();

        $employeeJobGrid = QuestionariesTrainingGrid::where(['trainer_qualification_id' => $trainer_qualification_id, 'identifier' => 'Questionaries'])->firstOrNew();
        $employeeJobGrid->trainer_qualification_id = $trainer_qualification_id;
        $employeeJobGrid->identifier = 'Questionaries';
        $employeeJobGrid->data = $request->jobResponsibilities;  
        $employeeJobGrid->save();

        // $trainerListGrid = TrainerGrid::where(['trainer_qualification_id' => $trainer_qualification_id, 'identifier' => 'listOfAttachment'])->firstOrNew();
        // $trainerListGrid->trainer_qualification_id = $trainer_qualification_id;
        // $trainerListGrid->identifier = 'listOfAttachment';
        // $trainerListGrid->data = $request->trainer_listOfAttachment;
        // $trainerListGrid->save();

        // } catch (\Exception $e) {
        //     $res['status'] = 'error';
        //     $res['message'] = $e->getMessage();
        // }


        //Audit Trails 
        //  if (!empty($request->short_description))
        if ($lastdocument->short_description != $trainer->short_description) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->previous = $lastdocument->short_description;
            $validation2->current = $trainer->short_description;
            $validation2->activity_type = 'Short Description';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->short_description) || $lastdocument->short_description === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->date_of_initiation != $trainer->date_of_initiation) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Date of Initiation';
            $validation2->previous = $lastdocument->date_of_initiation;
            $validation2->current = $trainer->date_of_initiation;
            $validation2->comment = "Not Applicable";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->date_of_initiation) || $lastdocument->date_of_initiation === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->assign_to != $trainer->assign_to) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Assign To';
            $validation2->previous = $lastdocument->assign_to;
            $validation2->current = $trainer->assign_to;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->assign_to) || $lastdocument->assign_to === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->due_date != $trainer->due_date) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Due Date';
            $validation2->previous = $lastdocument->due_date;
            $validation2->current = $trainer->due_date;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->due_date) || $lastdocument->due_date === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }
        if ($lastdocument->trainer_name != $trainer->trainer_name) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Trainer Name';
            $validation2->previous = $lastdocument->trainer_name;
            $validation2->current = $trainer->trainer_name;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->trainer_name) || $lastdocument->trainer_name === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->qualification != $trainer->qualification) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Qualification';
            $validation2->previous = $lastdocument->qualification;
            $validation2->current = $trainer->qualification;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->qualification) || $lastdocument->qualification === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->training_date != $trainer->training_date) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Schedule Training date';
            $validation2->previous = $lastdocument->training_date;
            $validation2->current = $trainer->training_date;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->training_date) || $lastdocument->training_date === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->topic != $trainer->topic) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Topic of Training';
            $validation2->previous = $lastdocument->topic;
            $validation2->current = $trainer->topic;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->topic) || $lastdocument->topic === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->type != $trainer->type) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Type of Training';
            $validation2->previous = $lastdocument->type;
            $validation2->current = $trainer->type;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->type) || $lastdocument->type === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->evaluation != $trainer->evaluation) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Evaluation Required';
            $validation2->previous = $lastdocument->evaluation;
            $validation2->current = $trainer->evaluation;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->evaluation) || $lastdocument->evaluation === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->evaluation_through != $trainer->evaluation_through) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Evaluation Through';
            $validation2->previous = $lastdocument->evaluation_through;
            $validation2->current = $trainer->evaluation_through;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->evaluation_through) || $lastdocument->evaluation_through === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->designation != $trainer->designation) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Designation';
            $validation2->previous = $lastdocument->designation;
            $validation2->current = $trainer->designation;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->designation) || $lastdocument->designation === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->department != $trainer->department) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Department';
            $validation2->previous = $lastdocument->department;
            $validation2->current = $trainer->department;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->department) || $lastdocument->department === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->experience != $trainer->experience) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Experience (No. of Years)';
            $validation2->previous = $lastdocument->experience;
            $validation2->current = $trainer->experience;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->experience) || $lastdocument->experience === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->hod != $trainer->hod) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'HOD';
            $validation2->previous = $lastdocument->hod;
            $validation2->current = $trainer->hod;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->hod) || $lastdocument->hod === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->trainer != $trainer->trainer) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Qualification Status';
            $validation2->previous = $lastdocument->trainer;
            $validation2->current = $trainer->trainer;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->trainer) || $lastdocument->trainer === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->qualification_comments != $trainer->qualification_comments) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Qualification Comments';
            $validation2->previous = $lastdocument->qualification_comments;
            $validation2->current = $trainer->qualification_comments;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->qualification_comments) || $lastdocument->qualification_comments === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->initial_attachment != $trainer->initial_attachment) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Initial Attachment';
            $validation2->previous = $lastdocument->initial_attachment;
            $validation2->current = $trainer->initial_attachment;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->initial_attachment) || $lastdocument->initial_attachment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        toastr()->success("Record is updated Successfully");
        return back();
    }

    public function show($id)
    {
        $trainer = TrainerQualification::find($id);

        $trainer_skill = TrainerGrid::where(['trainer_qualification_id' => $id, 'identifier' => 'trainerSkillSet'])->first();
        $trainer_list = TrainerGrid::where(['trainer_qualification_id' => $id, 'identifier' => 'listOfAttachment'])->first();
        $employee_grid_data = QuestionariesTrainingGrid::where(['trainer_qualification_id' => $id, 'identifier' => 'Questionaries'])->first();
        
        $data = Document::all();

        $record = TrainerQualification::findOrFail($id);
        $document_training = DocumentTraining::where('document_id', $id)->first();
    
        $training = optional($document_training)->training_plan ? Training::find($document_training->training_plan) : null;
        $quize = optional($training)->quize ? Quize::find($training->quize) : null;
    
        $savedSop = $record->sopdocument;

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');

        return view('frontend.TMS.Trainer_qualification.trainer_qualification_view', compact('trainer', 'due_date', 'trainer_skill', 'trainer_list','employee_grid_data','data','record','document_training','training','quize','savedSop'));
    }

    public function sendStage(Request $request, $id)
    {
        try {

            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $trainer = TrainerQualification::find($id);
                $lastEmployee = TrainerQualification::find($id);

                if ($trainer->stage == 1) {
                    $trainer->stage = "2";
                    $trainer->status = "Pending Trainer Update";
                    $trainer->sbmitted_by = Auth::user()->name;
                    $trainer->sbmitted_on = Carbon::now()->format('d-m-Y');
                    $trainer->sbmitted_comment = $request->comment;

                    $history = new TrainerQualificationAuditTrial();
                    $history->trainer_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $trainer->sbmitted_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    // $history->origin_state = $lastEmployee->status;
                    $history->action = 'Submit';
                    $history->change_to = "Pending Trainer Update";
                    $history->change_from = $lastEmployee->status;
                    $history->stage = 'Submited';
                    $history->save();

                    $trainer->update();
                    return back();
                }

                if ($trainer->stage == 2) {
                    $trainer->stage = "3";
                    $trainer->status = "Trainer Answer";
                    $trainer->update_complete_by = Auth::user()->name;
                    $trainer->update_complete_on = Carbon::now()->format('d-m-Y');
                    $trainer->update_complete_comment = $request->comment;

                    $history = new TrainerQualificationAuditTrial();
                    $history->trainer_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $trainer->sbmitted_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    // $history->origin_state = $lastEmployee->status;
                    $history->action = 'Update Complete';
                    $history->change_to = "Trainer Answer";
                    $history->change_from = $lastEmployee->status;
                    $history->stage = 'Submited';
                    $history->save();

                    $trainer->update();
                    return back();
                }

                if ($trainer->stage == 3) {
                    $trainer->stage = "4";
                    $trainer->status = "HOD Evaluation";
                    $trainer->answer_complete_by= Auth::user()->name;
                    $trainer->answer_complete_on = Carbon::now()->format('d-m-Y');
                    $trainer->answer_complete_comment = $request->comment;

                    $history = new TrainerQualificationAuditTrial();
                    $history->trainer_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $trainer->sbmitted_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    // $history->origin_state = $lastEmployee->status;
                    $history->action = 'Answer Complete';
                    $history->change_to = "HOD Evaluation";
                    $history->change_from = $lastEmployee->status;
                    $history->stage = 'Submited';
                    $history->save();

                    $trainer->update();
                    return back();
                }

                if ($trainer->stage == 4) {
                    $trainer->stage = "5";
                    $trainer->status = "QA/CQA Head Approval";
                    $trainer->evaluation_complete_by = Auth::user()->name;
                    $trainer->evaluation_complete_on = Carbon::now()->format('d-m-Y');
                    $trainer->evaluation_complete_comment = $request->comment;

                    $history = new TrainerQualificationAuditTrial();
                    $history->trainer_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $trainer->sbmitted_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    // $history->origin_state = $lastEmployee->status;
                    $history->action = 'Evaluation Complete';
                    $history->change_to = "QA/CQA Head Approval";
                    $history->change_from = $lastEmployee->status;
                    $history->stage = 'Submited';
                    $history->save();

                    $trainer->update();
                    return back();
                }

                // if ($trainer->stage == 5) {
                //     $trainer->stage = "6";
                //     $trainer->status = "QA/CQA Head Approval";
                //     $trainer->sbmitted_by = Auth::user()->name;
                //     $trainer->sbmitted_on = Carbon::now()->format('d-m-Y');
                //     $trainer->sbmitted_comment = $request->comment;

                //     $history = new TrainerQualificationAuditTrial();
                //     $history->trainer_id = $id;
                //     $history->activity_type = 'Activity Log';
                //     $history->current = $trainer->sbmitted_by;
                //     $history->comment = $request->comment;
                //     $history->user_id = Auth::user()->id;
                //     $history->user_name = Auth::user()->name;
                //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                //     // $history->origin_state = $lastEmployee->status;
                //     $history->action = 'Submit';
                //     $history->change_to = "QA/CQA Head Approval";
                //     $history->change_from = $lastEmployee->status;
                //     $history->stage = 'Submited';
                //     $history->save();

                //     $trainer->update();
                //     return back();
                // }

                if ($trainer->stage == 5) {
                    $trainer->stage = "6";
                    $trainer->status = "Closed-Done";
                    $trainer->qualified_by = Auth::user()->name;
                    $trainer->qualified_on = Carbon::now()->format('d-m-Y');
                    $trainer->qualified_comment = $request->comment;

                    $history = new TrainerQualificationAuditTrial();
                    $history->trainer_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $trainer->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    // $history->origin_state = $lastEmployee->status;
                    $history->action = 'Qualified';
                    $history->change_to = "Closed-Done";
                    $history->change_from = $lastEmployee->status;
                    $history->stage = 'Qualified';
                    $history->save();
                    $trainer->update();
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

    public function rejectStage(Request $request, $id)
    {
        try {

            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $trainer = TrainerQualification::find($id);
                $lastEmployee = TrainerQualification::find($id);

                if ($trainer->stage == 4) {
                    $trainer->stage = "1";
                    $trainer->status = "Opened";
                    $trainer->rejected_by = Auth::user()->name;
                    $trainer->rejected_on = Carbon::now()->format('d-m-Y');
                    $trainer->rejected_comment = $request->comment;

                    $history = new TrainerQualificationAuditTrial();
                    $history->trainer_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $trainer->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    // $history->origin_state = $lastEmployee->status;
                    $history->action = 'Reject';
                    $history->change_to = "Opened";
                    $history->change_from = $lastEmployee->status;
                    $history->stage = 'Reject';
                    $history->save();


                    $trainer->update();
                    return back();
                }

                if ($trainer->stage == 5) {
                    $trainer->stage = "1";
                    $trainer->status = "Opened";
                    $trainer->rejected_by = Auth::user()->name;
                    $trainer->rejected_on = Carbon::now()->format('d-m-Y');
                    $trainer->rejected_comment = $request->comment;

                    $history = new TrainerQualificationAuditTrial();
                    $history->trainer_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $trainer->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    // $history->origin_state = $lastEmployee->status;
                    $history->action = 'Reject';
                    $history->change_to = "Opened";
                    $history->change_from = $lastEmployee->status;
                    $history->stage = 'Reject';
                    $history->save();


                    $trainer->update();
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

    public function trainerAuditTrial($id)
    {
        $trainer = TrainerQualification::find($id);
        $audit = TrainerQualificationAuditTrial::where('trainer_id', $id)->orderByDESC('id')->paginate();
        $today = Carbon::now()->format('d-m-y');
        $document = TrainerQualification::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');

        return view('frontend.TMS.Trainer_qualification.trainer_qualification_auditTrail', compact('audit', 'trainer', 'document', 'today'));
    }
 
    public function auditDetailstrainer($id)
    {

        $detail = TrainerQualificationAuditTrial::find($id);

        $detail_data = TrainerQualificationAuditTrial::where('activity_type', $detail->activity_type)->where('trainer_id', $detail->trainer_id)->latest()->get();

        $doc = TrainerQualification::where('id', $detail->trainer_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);

        return view('frontend.TMS.Trainer_qualification.trainerQualification_auditTrailDetails', compact('detail', 'doc', 'detail_data'));
    }

    public static function trainerReport($id)
    {
        $data = TrainerQualification::find($id);
        if (!empty($data)) {
            $data->originator_id = User::where('id', $data->initiator_id)->value('name');
            $trainer_list = TrainerGrid::where(['trainer_qualification_id' => $id, 'identifier' => 'listOfAttachment'])->first();
            $employee_grid_data = QuestionariesTrainingGrid::where(['trainer_qualification_id' => $id, 'identifier' => 'Questionaries'])->first();
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.TMS.Trainer_qualification.trainer_report', compact('data','trainer_list','employee_grid_data'))
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
