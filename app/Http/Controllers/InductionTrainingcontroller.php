<?php

namespace App\Http\Controllers;

use App\Models\Induction_training;
use App\Models\InductionTrainingAudit;
use App\Models\RoleGroup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InductionTrainingController extends Controller
{
    // Method to display the form
    public function index()
    {
        return view('frontend.TMS.Induction_training.induction_training');
    }

    public function store(Request $request)
    {
        $inductionTraining = new Induction_training();


        $inductionTraining->stage = '1';
        $inductionTraining->status = 'Opened';
        $inductionTraining->employee_id = $request->employee_id;
        $inductionTraining->name_employee = $request->name_employee;
        $inductionTraining->department_location = $request->department_location;
        $inductionTraining->designation = $request->designation;
        $inductionTraining->qualification = $request->qualification;
        $inductionTraining->experience_if_any = $request->experience_if_any;
        $inductionTraining->date_joining = $request->date_joining;

        // Handle looping through the document fields
        for ($i = 1; $i <= 16; $i++) {
            $documentNumberKey = "document_number_$i";
            $trainingDateKey = "training_date_$i";
            $remarkKey = "remark_$i";

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

        if (!empty($request->department_location)) {
            $validation2 = new InductionTrainingAudit();
            $validation2->induction_id = $inductionTraining->id;
            $validation2->activity_type = 'Department & Location';
            $validation2->previous = "Null";
            $validation2->current = $request->department_location;
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
            $validation2->current = $request->date_joining;
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
        return view('frontend.TMS.Induction_training.induction_training_view', compact('inductionTraining'));
    }


    public function update(Request $request, $id)
    {
        $inductionTraining = Induction_training::find($id);
        $lastdocument = Induction_training::find($id);

        $inductionTraining->employee_id = $request->employee_id;
        $inductionTraining->name_employee = $request->name_employee;
        $inductionTraining->department_location = $request->department_location;
        $inductionTraining->designation = $request->designation;
        $inductionTraining->qualification = $request->qualification;
        $inductionTraining->experience_if_any = $request->experience_if_any;
        $inductionTraining->date_joining = $request->date_joining;

        // Handle looping through the document fields
        for ($i = 1; $i <= 16; $i++) {
            $documentNumberKey = "document_number_$i";
            $trainingDateKey = "training_date_$i";
            $remarkKey = "remark_$i";

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
            $validation2->previous = $lastdocument->date_joining;
            $validation2->current = $inductionTraining->date_joining;
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
}
