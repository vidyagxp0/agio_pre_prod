<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TNI;
use Illuminate\Support\Facades\Auth;
use App\Models\QMSDivision;
use App\Models\TNIGrid;
use App\Models\Employee;
use App\Models\Training;
use App\Models\Document;
use App\Models\User;
use Helpers;

class TNIController extends Controller
{
    public function index()
    {
        $Tni = TNI::all();
        $division = QMSDivision::all();
        $employees = Employee::all();
        $trainings = Training::all();
        return view('frontend.TMS.TNI_TNA.Tni_create', compact('Tni', 'division', 'employees', 'trainings'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'division_id' =>'required',
            'initiation_date'=>'required',
            'departments'=>'required',
        ]);
        
        $Tni = new TNI();
        $Tni->division_id = $request->division_id;
        $Tni->initiator_id = Auth::user()->id;
        $Tni->departments = $request->departments;
        $Tni->initiation_date = $request->initiation_date;        
        $Tni->save();

        $trainingPlan = TNIGrid::where(['tni_id' => $Tni->id, 'identifier' => "TrainingPlan"])->firstOrCreate();
        $trainingPlan->tni_id = $Tni->id;
        $trainingPlan->identifier = "TrainingPlan";
        $trainingPlan->data = $request->trainingPlanData;
        $trainingPlan->save();

        toastr()->success('Record Created Successfully !!');
        return redirect()->route('Tni_create');
    }

    public function show($id){
        $Tni = TNI::findOrFail($id);
        $trainingPlan = TNIGrid::where(['tni_id' => $Tni->id, 'identifier' => 'TrainingPlan'])->first();
        $trainingPlanData = json_decode($trainingPlan->data, true);

        $trainings = Training::all();
        $employees = User::all();

        return view('frontend.TMS.TNI_TNA.Tni_view', compact('Tni', 'trainingPlanData', 'trainings', 'employees'));
    }

    public function update(Request $request, $id){
        $Tni = TNI::find($id);        
       
        $Tni->save();
        toastr()->success('Update Successfully !!');
        return redirect()->route('Tni.index');
    }

    public function getTrainingDetails($trainingId)
    {
        $training = Training::find($trainingId);
        $docdetail = Document::where('id', $trainingId)->first();

        $traineeIds = explode(',', $training->trainees);
        $users = User::whereIn('id', $traineeIds)->get(['id', 'name']);

        $sopIds = explode(',', $training->sops);
        $sops = Document::whereIn('id', $sopIds)->get();

        $sopNumbers = $sops->map(function ($sop) {
            return $sop->sop_type_short . '/' . 
                   $sop->department_id . '/000' . 
                   $sop->id . '/R' . 
                   $sop->major;
        });

        if ($training) {
            return response()->json([
                'sop_numbers' => $sopNumbers,
                'users' => $users,
                'sops' => $docdetail->document_name,
                'created_at' => $training->created_at->format('d-M-Y'),
            ]);
        }

        return response()->json([
            'sop_numbers' => [],
            'sops' => '',
            'created_at' => '',
            'users' => []
        ]);
    }


}
