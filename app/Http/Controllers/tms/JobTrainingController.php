<?php

namespace App\Http\Controllers\tms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobTraining;

class JobTrainingController extends Controller
{
    
    public function index()
    {
        $jobTrainings = JobTraining::all();
        return view('frontend.TMS.Job_Training.job_training', compact('jobTrainings'));
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

        $jobTraining->save();

        return redirect()->route('job_training')->with('success', 'Job Training created successfully.');
    }


}
