<?php

namespace App\Http\Controllers;
use App\Models\Induction_training;
use Illuminate\Http\Request;

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
// dd($inductionTraining);
    $inductionTraining->save();
        return redirect()->route('TMS.index')->with('success', 'Induction training data saved successfully!');
    }

    public function edit($id)
    {
        $inductionTraining = Induction_training::find($id);
        return view('frontend\TMS\Induction_training\induction_training_view', compact('inductionTraining'));
    }


    public function update(Request $request, $id){
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
}
