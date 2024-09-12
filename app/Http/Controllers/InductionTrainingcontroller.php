<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Induction_training;
use App\Models\InductionTrainingAudit;
use App\Models\RecordNumber;
use App\Models\RoleGroup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InductionTrainingController extends Controller
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

        return view('frontend.TMS.Induction_training.induction_training', compact('due_date', 'record', 'employees'));
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
        $inductionTraining->name_employee = $request->employee_name;
        $inductionTraining->department = $request->department;
        $inductionTraining->location = $request->location;
        $inductionTraining->designation = $request->designation;
        $inductionTraining->qualification = $request->qualification;
        $inductionTraining->experience_if_any = $request->experience_if_any;
        $inductionTraining->date_joining = $request->date_joining;

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
        $inductionTraining = Induction_training::find($id);
        $employees = Employee::all();
        return view('frontend.TMS.Induction_training.induction_training_view', compact('inductionTraining', 'employees'));
    }


    public function update(Request $request, $id)
    {
        $inductionTraining = Induction_training::find($id);
        $lastdocument = Induction_training::find($id);

        $inductionTraining->employee_id = $request->employee_id;
        $inductionTraining->name_employee = $request->name_employee;
        $inductionTraining->department = $request->department;
        $inductionTraining->on_the_job_comment = $request->on_the_job_comment;
        $inductionTraining->designation = $request->designation;
        $inductionTraining->qualification = $request->qualification;
        $inductionTraining->experience_if_any = $request->experience_if_any;
        $inductionTraining->date_joining = $request->date_joining;

        $inductionTraining->final_r_comment = $request->final_r_comment;

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

        if ($request->hasFile('on_the_job_attachment')) {
            $file = $request->file('on_the_job_attachment');
            $name = $request->employee_id . 'on_the_job_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $inductionTraining->on_the_job_attachment = $name;
        }
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
            $validation2->current = $inductionTraining->name_employee;
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

                if ($jobTraining->stage == 1) {
                    $jobTraining->stage = "2";
                    $jobTraining->status = "Submit";

                    $history = new InductionTrainingAudit();
                    $history->induction_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "Submit";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'submit';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }
                if ($jobTraining->stage == 2) {
                    $jobTraining->stage = "3";
                    $jobTraining->status = "Complete";

                    $history = new InductionTrainingAudit();
                    $history->induction_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "Complete";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Complete';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 3) {
                    $jobTraining->stage = "4";
                    $jobTraining->status = "On Job Training";

                    $history = new InductionTrainingAudit();
                    $history->induction_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "On Job Training";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Send On Job Training';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 4) {
                    $jobTraining->stage = "5";
                    $jobTraining->status = "Certification";

                    $history = new InductionTrainingAudit();
                    $history->induction_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->change_to = "Certification";
                    $history->change_from = $lastjobTraining->status;
                    $history->action = 'Certificate';
                    $history->stage = 'Submited';
                    $history->save();

                    $jobTraining->update();
                    return back();
                }

                if ($jobTraining->stage == 5) {
                    $jobTraining->stage = "6";
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
                    $history->action = 'Closed-done';
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
