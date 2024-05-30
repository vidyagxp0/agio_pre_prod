<?php

namespace App\Http\Controllers\tms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobTraining;
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
        $jobTraining->department_location = $request->input('department_location');
        $jobTraining->startdate = $request->input('startdate');
        $jobTraining->enddate = $request->input('enddate');
        // $jobTraining->trainee = $request->input('subject');
       
        for ($i = 1; $i <= 5; $i++) {
            $jobTraining->{"subject_$i"} = $request->input("subject_$i");
            $jobTraining->{"type_of_training_$i"} = $request->input("type_of_training_$i");
            $jobTraining->{"reference_document_no_$i"} = $request->input("reference_document_no_$i");
            $jobTraining->{"trainee_name_$i"} = $request->input("trainee_name_$i");
            $jobTraining->{"trainer_$i"} = $request->input("trainer_$i");
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
    return view('frontend.TMS.Job_Training.job_training_view',compact('jobTraining' ,'id'));
  }

    public function update(Request $request, $id)
    {
        $jobTraining = JobTraining::findOrFail($id);
    
        // Update fields
        $jobTraining->name = $request->input('name');
        $jobTraining->department_location = $request->input('department_location');
        $jobTraining->startdate = $request->input('startdate');
        $jobTraining->enddate = $request->input('enddate');
    
        for ($i = 1; $i <= 5; $i++) {
            $jobTraining->{"subject_$i"} = $request->input("subject_$i");
            $jobTraining->{"type_of_training_$i"} = $request->input("type_of_training_$i");
            $jobTraining->{"reference_document_no_$i"} = $request->input("reference_document_no_$i");
            $jobTraining->{"trainee_name_$i"} = $request->input("trainee_name_$i");
            $jobTraining->{"trainer_$i"} = $request->input("trainer_$i");
        }
    
        $jobTraining->save();
    
        return redirect()->back()->with('success', 'Job Training updated successfully.');
    }
    


}
