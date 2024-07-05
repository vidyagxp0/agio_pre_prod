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
        return view('frontend\TMS\Induction_training\induction_training');
    }

    public function store(Request $request)
    {
        // dd($request->all());
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
