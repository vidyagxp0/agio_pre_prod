<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Induction_training;
use App\Models\InductionTrainingAudit;
use App\Models\RecordNumber;
use App\Models\JobTraining;
use App\Models\DocumentTraining;
use App\Models\Training;
use App\Models\Quize;
use App\Models\Question;
use App\Models\RoleGroup;
use App\Models\User;
use App\Models\EmpTrainingQuizResult;
use Illuminate\Support\Facades\App;
use PDF;
use App\Models\Document;
use App\Models\QuestionariesGrid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InductionTrainingcontroller extends Controller
{
    // Method to display the form
    public function index()
    {
        $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = str_pad($record, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        $employees = Employee::all();
        $data = Document::all();

        return view('frontend.TMS.Induction_training.induction_training', compact('due_date','data', 'record', 'employees'));
    }

    public function fetchQuestion($id)
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

    public function getEmployeeDetails($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }


    
    public function store(Request $request)
    {

        $inductionTraining = new Induction_training();


        $inductionTraining->stage = '1';
        $inductionTraining->status = 'Opened';
        $inductionTraining->employee_id = $request->employee_id;
        $inductionTraining->name_employee = $request->name_employee;
        $inductionTraining->department = $request->department;
        $inductionTraining->location = $request->location;
        $inductionTraining->designation = $request->designation;
        $inductionTraining->qualification = $request->qualification;
        $inductionTraining->experience_if_any = $request->experience_if_any;
        $inductionTraining->date_joining = $request->date_joining;
        $inductionTraining->start_date = $request->start_date;
        $inductionTraining->end_date = $request->end_date;

        $inductionTraining->training_date_1 = $request->training_date_1;
        $inductionTraining->training_date_2 = $request->training_date_2;
        $inductionTraining->training_date_3 = $request->training_date_3;
        $inductionTraining->training_date_4 = $request->training_date_4;
        $inductionTraining->training_date_5 = $request->training_date_5;
        $inductionTraining->training_date_6 = $request->training_date_6;
        $inductionTraining->training_date_7 = $request->training_date_7;
        $inductionTraining->training_date_8 = $request->training_date_8;
        $inductionTraining->training_date_9 = $request->training_date_9;
        $inductionTraining->training_date_10 = $request->training_date_10;
        $inductionTraining->training_date_11 = $request->training_date_11;
        $inductionTraining->training_date_12 = $request->training_date_12;
        $inductionTraining->training_date_13 = $request->training_date_13;
        $inductionTraining->training_date_14 = $request->training_date_14;
        $inductionTraining->training_date_15 = $request->training_date_15;
        // $inductionTraining->training_date_16 = $request->training_date_16;


        // Handle looping through the document fields
        for ($i = 1; $i <= 16; $i++) {
            $documentNumberKey = "document_number_$i";
            $trainingDateKey = "training_date_$i";
            $remarkKey = "remark_$i";
            $attachmentKey = "attachment_$i";

            // Handle both underscore and hyphen cases
            $documentNumber = $request->input($documentNumberKey) ?? $request->input(str_replace('_', '-', $documentNumberKey));
            $trainingDate = $request->input($trainingDateKey) ?? $request->input(str_replace('_', '-', $trainingDateKey));
            $remark = $request->input($remarkKey) ?? $request->input(str_replace('_', '-', $remarkKey));

            $inductionTraining->$documentNumberKey = $documentNumber;
            $inductionTraining->$trainingDateKey = $trainingDate;
            $inductionTraining->$remarkKey = $remark;

            if ($request->hasFile($attachmentKey)) {
                // Optionally delete the old file
                if ($inductionTraining->$attachmentKey) {
                    Storage::delete('public/' . $inductionTraining->$attachmentKey);
                }
    
                $file = $request->file($attachmentKey);
                $filePath = $file->store('attachments', 'public');
                $inductionTraining->$attachmentKey = $filePath;
            }

            if ($request->hasFile($attachmentKey)) {
                $file = $request->file($attachmentKey);
                $name = $request->name . 'attached' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $inductionTraining->$attachmentKey = $name;
            }
        }
        $inductionTraining->trainee_name = $request->trainee_name;
        $inductionTraining->training_type = $request->training_type;

        $inductionTraining->hr_name = $request->hr_name;
        $inductionTraining->save();

        if (!empty($request->employee_id)) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->previous = "Null";
            $validation2->current = $request->employee_id;
            $validation2->activity_type = 'Employee ID';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }


        if (!empty($request->name_employee)) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->activity_type = 'Name of Employee';
            $validation2->previous = "Null";
            $validation2->current = $request->name_employee;
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
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
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
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
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

        if (!empty($request->designation)) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
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

        if (!empty($request->qualification)) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
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

        if (!empty($request->experience_if_any)) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->activity_type = 'Experience (if any)';
            $validation2->previous = "Null";
            $validation2->current = $request->experience_if_any;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->date_joining)) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->activity_type = 'Date of Joining';
            $validation2->previous = "Null";
            $validation2->current = \Carbon\Carbon::parse($request->date_joining)->format('d-M-Y');
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        return redirect()->route('TMS.index')->with('success', 'Induction training data saved successfully!');
    }

    public function edit($id)
    {
        // Find the Induction Training record by ID
        $inductionTraining = Induction_training::find($id);
    
        // Fetch the employee details related to this training
        $employee = Employee::where('id', $inductionTraining->name_employee)->first();
        $employee_name = $employee ? $employee->employee_name : ''; // If employee exists, get name, otherwise empty string
    
        // Fetch all employees and documents
        $employees = Employee::all();
        $data = Document::all();
    
        // Fetch the record and document training by ID
        $record = Induction_training::findOrFail($id);
        $document_training = DocumentTraining::where('document_id', $id)->first();
    
        // Use optional() to avoid null errors when training_plan or quize is null
        $training = optional($document_training)->training_plan ? Training::find($document_training->training_plan) : null;
        $quize = optional($training)->quize ? Quize::find($training->quize) : null;
    
        // Get the saved SOP document and employee grid data
        $savedSop = $record->sopdocument;
        $employee_grid_data = QuestionariesGrid::where(['induction_id' => $id, 'identifier' => 'Questionaries'])->first();
    
        // Return the view with all necessary data
        return view('frontend.TMS.Induction_training.induction_training_view', compact(
            'inductionTraining', 'employees', 'employee_grid_data', 'employee_name', 'data', 'savedSop', 'quize', 'document_training'
        ));
    }
    


    public function update(Request $request, $id)
    {
        $inductionTraining = Induction_training::find($id);
        $lastdocument = Induction_training::find($id);

        $inductionTraining->employee_id = $request->employee_id;
        $inductionTraining->name_employee = $request->name_employee;
        // $inductionTraining->department = $request->department;
        $inductionTraining->on_the_job_comment = $request->on_the_job_comment;
        $inductionTraining->designation = $request->designation;
        $inductionTraining->qualification = $request->qualification;
        $inductionTraining->experience_if_any = $request->experience_if_any;
        $inductionTraining->date_joining = $request->date_joining;

        $inductionTraining->final_r_comment = $request->final_r_comment;
        $inductionTraining->questionaries_required = $request->questionaries_required;

        $inductionTraining->evaluation_comment = $request->evaluation_comment;
        $inductionTraining->hr_head_comment = $request->hr_head_comment;
        $inductionTraining->qa_final_comment = $request->qa_final_comment;
        $inductionTraining->hr_final_comment = $request->hr_final_comment;
        $inductionTraining->start_date = $request->start_date;
        $inductionTraining->end_date = $request->end_date;


        
        $inductionTraining->training_date_1 = $request->training_date_1;
        $inductionTraining->training_date_2 = $request->training_date_2;
        $inductionTraining->training_date_3 = $request->training_date_3;
        $inductionTraining->training_date_4 = $request->training_date_4;
        $inductionTraining->training_date_5 = $request->training_date_5;
        $inductionTraining->training_date_6 = $request->training_date_6;
        $inductionTraining->training_date_7 = $request->training_date_7;
        $inductionTraining->training_date_8 = $request->training_date_8;
        $inductionTraining->training_date_9 = $request->training_date_9;
        $inductionTraining->training_date_10 = $request->training_date_10;
        $inductionTraining->training_date_11 = $request->training_date_11;
        $inductionTraining->training_date_12 = $request->training_date_12;
        $inductionTraining->training_date_13 = $request->training_date_13;
        $inductionTraining->training_date_14 = $request->training_date_14;
        $inductionTraining->training_date_15 = $request->training_date_15;

        if ($request->hasFile('final_r_attachment')) {
            $file = $request->file('final_r_attachment');
            $name = $request->employee_id . 'final_r_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $inductionTraining->final_r_attachment = $name;
        }

        if ($request->hasFile('evaluation_attachment')) {
            $file = $request->file('evaluation_attachment');
            $name = $request->employee_id . 'evaluation_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $inductionTraining->evaluation_attachment = $name;
        }

        if ($request->hasFile('hr_head_attachment')) {
            $file = $request->file('hr_head_attachment');
            $name = $request->employee_id . 'hr_head_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $inductionTraining->hr_head_attachment = $name;
        }

        if ($request->hasFile('qa_final_attachment')) {
            $file = $request->file('qa_final_attachment');
            $name = $request->employee_id . 'qa_final_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $inductionTraining->qa_final_attachment = $name;
        }

        if ($request->hasFile('hr_final_attachment')) {
            $file = $request->file('hr_final_attachment');
            $name = $request->employee_id . 'hr_final_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $inductionTraining->hr_final_attachment = $name;
        }

        if ($request->hasFile('on_the_job_attachment')) {
            $file = $request->file('on_the_job_attachment');
            $name = $request->employee_id . 'on_the_job_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $inductionTraining->on_the_job_attachment = $name;
        }

        $induction_id = $inductionTraining->id;
        $employeeJobGrid = QuestionariesGrid::where(['induction_id' => $induction_id, 'identifier' => 'Questionaries'])->firstOrNew();
        $employeeJobGrid->induction_id = $induction_id;
        $employeeJobGrid->identifier = 'Questionaries';
        $employeeJobGrid->data = $request->jobResponsibilities;  
        $employeeJobGrid->save();

        // Handle looping through the document fields
        for ($i = 1; $i <= 16; $i++) {
            $documentNumberKey = "document_number_$i";
            $trainingDateKey = "training_date_$i";
            $remarkKey = "remark_$i";
            $attachmentKey = "attachment_$i";

                    // Handle file upload
        // if ($request->hasFile($attachmentKey)) {
        //     // Optionally delete the old file
        //     if ($inductionTraining->$attachmentKey) {
        //         Storage::delete('public/' . $inductionTraining->$attachmentKey);
        //     }

        //     $file = $request->file($attachmentKey);
        //     $filePath = $file->store('attachments', 'public');
        //     $inductionTraining->$attachmentKey = $filePath;
        // }

        if ($request->hasFile($attachmentKey)) {
            $file = $request->file($attachmentKey);
            $name = $request->name . $attachmentKey . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $inductionTraining->$attachmentKey = $name;
        }



            // Handle both underscore and hyphen cases
            $documentNumber = $request->input($documentNumberKey) ?? $request->input(str_replace('_', '-', $documentNumberKey));
            $trainingDate = $request->input($trainingDateKey) ?? $request->input(str_replace('_', '-', $trainingDateKey));
            $remark = $request->input($remarkKey) ?? $request->input(str_replace('_', '-', $remarkKey));

            $inductionTraining->$documentNumberKey = $documentNumber;
            $inductionTraining->$trainingDateKey = $trainingDate;
            $inductionTraining->$remarkKey = $remark;
        }

        $inductionTraining->trainee_name = $request->trainee_name;
        $inductionTraining->training_type = $request->training_type;    
        $inductionTraining->hr_name = $request->hr_name;
        $inductionTraining->save();



        if ($lastdocument->employee_id != $inductionTraining->employee_id) {
            $validation2 = new InductionTrainingAudit();

            $validation2->induction_id = $inductionTraining->id;
            $validation2->previous = $lastdocument->employee_id;
            $validation2->current = $inductionTraining->employee_id;
            $validation2->activity_type = 'Employee ID';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->employee_id) || $lastdocument->employee_id === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }


        if ($lastdocument->name_employee != $inductionTraining->name_employee) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->previous = $lastdocument->name_employee;
            $validation2->current = $inductionTraining->name_eemployee_namemployee;
            $validation2->activity_type = 'Name of Employee';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->name_employee) || $lastdocument->name_employee === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->department_location != $inductionTraining->department_location) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->previous = $lastdocument->department_location;
            $validation2->current = $inductionTraining->department_location;
            $validation2->activity_type = 'Department & Location';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->department_location) || $lastdocument->department_location === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->designation != $inductionTraining->designation) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->previous = $lastdocument->designation;
            $validation2->current = $inductionTraining->designation;
            $validation2->activity_type = 'Designation';
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

        if ($lastdocument->qualification != $inductionTraining->qualification) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->previous = $lastdocument->qualification;
            $validation2->current = $inductionTraining->qualification;
            $validation2->activity_type = 'Qualification';
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

        if ($lastdocument->experience_if_any != $inductionTraining->experience_if_any) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->previous = $lastdocument->experience_if_any;
            $validation2->current = $inductionTraining->experience_if_any;
            $validation2->activity_type = 'Experience (if any)';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->experience_if_any) || $lastdocument->experience_if_any === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->date_joining != $inductionTraining->date_joining) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->previous = \Carbon\Carbon::parse($lastdocument->date_joining)->format('d-M-Y');
            $validation2->current = \Carbon\Carbon::parse($inductionTraining->date_joining)->format('d-M-Y');
            $validation2->activity_type = 'Date of Joining';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->date_joining) || $lastdocument->date_joining === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->hr_name != $inductionTraining->hr_name) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->previous = $lastdocument->hr_name;
            $validation2->current = $inductionTraining->hr_name;
            $validation2->activity_type = 'HR Name';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->hr_name) || $lastdocument->hr_name === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->trainee_name != $inductionTraining->trainee_name) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->previous = $lastdocument->trainee_name;
            $validation2->current = $inductionTraining->trainee_name;
            $validation2->activity_type = 'Trainee Name';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->trainee_name) || $lastdocument->trainee_name === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }
        if ($lastdocument->on_the_job_comment != $inductionTraining->on_the_job_comment) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->previous = $lastdocument->on_the_job_comment;
            $validation2->current = $inductionTraining->on_the_job_comment;
            $validation2->activity_type = 'Remark';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->on_the_job_comment) || $lastdocument->on_the_job_comment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->on_the_job_attachment != $inductionTraining->on_the_job_attachment) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->previous = $lastdocument->on_the_job_attachment;
            $validation2->current = $inductionTraining->on_the_job_attachment;
            $validation2->activity_type = 'Remark';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->on_the_job_attachment) || $lastdocument->on_the_job_attachment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }


        return redirect()->back()->with('success', 'Induction training data saved successfully!');
    }

    public function inductionAuditTrial($id)
    {
        $inductionTraining = Induction_training::find($id);
        $audit = InductionTrainingAudit::where('induction_id', $id)->orderByDESC('id')->paginate();
        $today = Carbon::now()->format('d-m-y');
        $document = Induction_training::where('id', $id)->first();
        $document->Initiation = User::where('id', $document->initiator_id)->value('name');
        return view('frontend.TMS.Induction_training.induction_audit', compact('audit', 'document', 'today', 'inductionTraining'));
    }


    public function sendStage(Request $request, $id)
    {
        try {

            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $jobTraining = Induction_training::find($id);
                $lastjobTraining = Induction_training::find($id);

                // if ($jobTraining->stage == 1) {
                //     $jobTraining->stage = "2";
                //     $jobTraining->status = "Question-Answer";

                //     $history = new InductionTrainingAudit();
                //     $history->induction_id = $id;
                //     $history->activity_type = 'Activity Log';
                //     $history->comment = $request->comment;
                //     $history->user_id = Auth::user()->id;
                //     $history->user_name = Auth::user()->name;
                //     $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                //     $history->change_to = "Question-Answer";
                //     $history->change_from = $lastjobTraining->status;
                //     $history->action = 'Submit';
                //     $history->stage = 'Submited';
                //     $history->save();

                //     $jobTraining->update();
                //     return back();
                // }
                if ($jobTraining->stage == 1) {
                    $jobTraining->stage = "2";
                    $jobTraining->status = "Employee Answers";

                    $history = new InductionTrainingAudit();
                    $history->induction_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "Employee Answers";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Submit';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 2) {
                    $jobTraining->stage = "3";
                    $jobTraining->status = "Evaluation";

                    $history = new InductionTrainingAudit();
                    $history->induction_id = $id;
                    $history->activity_type = 'Activity Log';
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

                if ($jobTraining->stage == 3) {
                    $jobTraining->stage = "4";
                    $jobTraining->status = "HR Head Approval";
                    $history = new InductionTrainingAudit();
                    $history->induction_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "HR Head Approval";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Evaluation Complete';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 4) {
                    $jobTraining->stage = "5";
                    $jobTraining->status = "QA/CQA Head Approval";

                    $history = new InductionTrainingAudit();
                    $history->induction_id = $id;
                    $history->activity_type = 'Activity Log';
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

                if ($jobTraining->stage == 5) {
                    $jobTraining->stage = "6";
                    $jobTraining->status = "In HR Final Review";

                    $history = new InductionTrainingAudit();
                    $history->induction_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "In HR Final Review";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'QA/CQA Head Approval Complete';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }
                if ($jobTraining->stage == 6) {
                    $jobTraining->stage = "7";
                    $jobTraining->status = "OJT Creation";

                    $history = new InductionTrainingAudit();
                    $history->induction_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "OJT Creation";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Send To OJT';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 7) {
                    $jobTraining->stage = "8";
                    $jobTraining->status = "Closed-done";

                    $history = new InductionTrainingAudit();
                    $history->induction_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "Closed-done";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Creation Complete';
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

    public function cancelStage(Request $request, $id){
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $jobTraining = Induction_training::find($id);
            $lastjobTraining = Induction_training::find($id);

            if ($jobTraining->stage == 4) {
                $jobTraining->stage = "2";
                $jobTraining->status = "Question-Answer";

                $history = new InductionTrainingAudit();
                $history->induction_id = $id;
                $history->activity_type = 'Activity Log';
                $history->comment = $request->comment;
                $history->user_id = Auth::user()->id;
                $history->user_name = Auth::user()->name;
                $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $history->change_to = "Question-Answer";
                $history->change_from = $lastjobTraining->status;
                $history->action = 'Question-Answer';
                $history->stage = 'Submited';
                $history->save();

                $jobTraining->update();
                return back();
            } 
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        } 
    }


    public function Induction_Child(Request $request, $id)
    {
        $employees = Employee::find($id);
    
        $data = Document::all();
        $hods = User::get();
        $delegate = User::get();
        $jobTraining = JobTraining::all();
        $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = str_pad($record, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        $inductionTraining = Induction_training::all();
    
        if ($request->child_type == 'induction_training') {
            return view('frontend.TMS.Job_Training.job_training', compact('employees','due_date','record','data','hods','jobTraining','delegate','inductionTraining'));
        } else {
            return view('frontend.TMS.Job_Training.job_training', compact('employees','due_date','record','data','hods','jobTraining','delegate','inductionTraining'));
        }
    }
    public static function inductionReport($id)
    {
        $data = Induction_training::find($id);
        if (!empty($data)) {
            $data->originator_id = User::where('id', $data->initiator_id)->value('name');
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.TMS.Induction_training.induction_report', compact('data'))
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

    

    public function viewrendersopinduction($id){
        return view('frontend.TMS.induction_training_detail', compact('id'));
    }

    public function inductionquestionshow($sopids, $inductiontrainingid){
        $inductiontrainingid = Induction_training::find($inductiontrainingid);
        $inductiontrainingid->attempt_count = $inductiontrainingid->attempt_count == -1 ? 0 : ( $inductiontrainingid->attempt_count == 0 ? 0 : $inductiontrainingid->attempt_count - 1);
        $inductiontrainingid->save();
        $sopidsArray = explode(',', $sopids);

        $sopidsArray = array_map('trim', $sopidsArray);
        $questions = Question::where('document_id', $sopidsArray)
            ->get();
        return view('frontend.TMS.induction_training.Induction_training_question_Answer', compact('questions', 'inductiontrainingid'));

    }

    public function checkAnswerInduction(Request $request)
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

        if($request->attempt_count == 0 || $result == 'Pass'){
            $induction = Induction_training::find($request->training_id);
            $induction->stage = 3;
            $induction->status = "Evaluation";
            $induction->update();
        }

            $storeResult = new EmpTrainingQuizResult();
            $storeResult->emp_id = $request->emp_id;
            $storeResult->training_id = $request->training_id;
            $storeResult->employee_name = $request->employee_name;
            $storeResult->training_type = "Induction Training";
            $storeResult->correct_answers = $correctCount;
            $storeResult->incorrect_answers = $totalQuestions - $correctCount;
            $storeResult->total_questions = $totalQuestions;
            $storeResult->score = $score."%";
            $storeResult->result = $result;
            $storeResult->attempt_number = $request->attempt_count + 1;
            $storeResult->save();        

        return view('frontend.TMS.Job_Training.job_quiz_result', [
            'totalQuestions' => $totalQuestions, // Total questions shown
            'correctCount' => $correctCount, // Number of correctly answered questions
            'score' => $score, // Final score for these 10 questions
            'result' => $result // Pass or Fail based on 80%
        ]);
    }
}
