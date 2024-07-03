<?php

namespace App\Http\Controllers\tms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobTraining;
use App\Models\Department;
use App\Models\User;
use DB;

class JobTrainingController extends Controller
{
    
    public function index()
    {
        $jobTraining = JobTraining::all();
        return view('frontend.TMS.Job_Training.job_training', compact('jobTraining'));
    }

   

    public function store(Request $request)
    {
       
        $jobTraining = new JobTraining();

        $jobTraining->name = $request->input('name');
        $jobTraining->department = $request->input('department');
        $jobTraining->location = $request->input('location');

        // $jobTraining->startdate = $request->input('startdate');
        // $jobTraining->enddate = $request->input('enddate');
        $jobTraining->hod = $request->input('hod');
       
        for ($i = 1; $i <= 5; $i++) {
            $jobTraining->{"subject_$i"} = $request->input("subject_$i");
            $jobTraining->{"type_of_training_$i"} = $request->input("type_of_training_$i");
            $jobTraining->{"reference_document_no_$i"} = $request->input("reference_document_no_$i");
            $jobTraining->{"trainee_name_$i"} = $request->input("trainee_name_$i");
            $jobTraining->{"trainer_$i"} = $request->input("trainer_$i");

            $jobTraining->{"startdate_$i"} = $request->input("startdate_$i");
            $jobTraining->{"enddate_$i"} = $request->input("enddate_$i");
        }
// dd($jobTraining->trainer_);
        $jobTraining->save();

       
        // Add other fields as necessary

       

        toastr()->success('Job Training created successfully.');
            return redirect('TMS');
        // return redirect()->route('TMS')->with('success', '');
    }


  public function edit($id){
    
    $jobTraining = JobTraining::find($id);
    // dd($jobTraining);
    $departments = Department::all(); 
    $users = User::all();

    if (!$jobTraining) {
        return redirect()->route('job_training.index')->with('error', 'Job Training not found');
    }
    return view('frontend.TMS.Job_Training.job_training_view',compact('jobTraining' ,'id','departments', 'users'));
  }

    public function update(Request $request, $id)
    {
        $jobTraining = JobTraining::findOrFail($id);
    
        // Update fields
        $jobTraining->name = $request->input('name');
        $jobTraining->department = $request->input('department');
        $jobTraining->location = $request->input('location');
        $jobTraining->hod = $request->input('hod');
        // $jobTraining->startdate = $request->input('startdate');
        // $jobTraining->enddate = $request->input('enddate');
    
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
    
        return redirect()->back()->with('success', 'Job Training updated successfully.');
    }
    


}
