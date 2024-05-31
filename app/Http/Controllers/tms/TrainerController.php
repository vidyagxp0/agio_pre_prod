<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use App\Models\TrainerGrid;
use App\Models\TrainerQualification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TrainerController extends Controller
{
    public function store(Request $request) {
        // return $request->all();

        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => [],
        ];
        // try {
            $trainer = new TrainerQualification();
            $trainer->stage = '1';
            $trainer->status = 'Opened';
            $trainer->division_id = $request->division_id;
            $trainer->record_number = $request->record_number;
            $trainer->site_code = $request->site_code;
            $trainer->initiator = $request->initiator;
            $trainer->date_of_initiation = $request->date_of_initiation;
            $trainer->assigned_to = $request->assigned_to;
            $trainer->due_date = $request->due_date;
            $trainer->short_description = $request->short_description;
            $trainer->trainer_name = $request->trainer_name;
            $trainer->qualification = $request->qualification;
            $trainer->designation = $request->designation;
            $trainer->department = $request->department;
            $trainer->experience = $request->experience;
            $trainer->external_agencies = $request->external_agencies;
            $trainer->trainer = $request->trainer;
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

            $trainerListGrid = TrainerGrid::where(['trainer_qualification_id' => $trainer_qualification_id, 'identifier' => 'listOfAttachment'])->firstOrNew();
            $trainerListGrid->trainer_qualification_id = $trainer_qualification_id;
            $trainerListGrid->identifier = 'listOfAttachment';
            $trainerListGrid->data = $request->trainer_listOfAttachment;
            $trainerListGrid->save();

        // } catch (\Exception $e) {
        //     $res['status'] = 'error';
        //     $res['message'] = $e->getMessage();

        // }

        toastr()->success("Record is created Successfully");
        return redirect(url('TMS'));
        // return response()->json($res);
    }

    public function update(Request $request, $id) {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => [],
        ];

        // try {
            $trainer = TrainerQualification::findOrFail($id);
            $trainer->division_id = $request->division_id;
            $trainer->record_number = $request->record_number;
            $trainer->site_code = $request->site_code;
            $trainer->initiator = $request->initiator;
            $trainer->date_of_initiation = $request->date_of_initiation;
            $trainer->assigned_to = $request->assigned_to;
            $trainer->due_date = $request->due_date;
            $trainer->short_description = $request->short_description;
            $trainer->trainer_name = $request->trainer_name;
            $trainer->qualification = $request->qualification;
            $trainer->designation = $request->designation;
            $trainer->department = $request->department;
            $trainer->experience = $request->experience;
            $trainer->external_agencies = $request->external_agencies;
            $trainer->trainer = $request->trainer;
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
            // dd($trainer->id);

            $trainer_qualification_id = $trainer->id;

            $trainerSkillGrid = TrainerGrid::where(['trainer_qualification_id' => $trainer_qualification_id, 'identifier' => 'trainerSkillSet'])->firstOrNew();
            $trainerSkillGrid->trainer_qualification_id = $trainer_qualification_id;
            $trainerSkillGrid->identifier = 'trainerSkillSet';
            $trainerSkillGrid->data = $request->trainer_skill;
            $trainerSkillGrid->save();

            $trainerListGrid = TrainerGrid::where(['trainer_qualification_id' => $trainer_qualification_id, 'identifier' => 'listOfAttachment'])->firstOrNew();
            $trainerListGrid->trainer_qualification_id = $trainer_qualification_id;
            $trainerListGrid->identifier = 'listOfAttachment';
            $trainerListGrid->data = $request->trainer_listOfAttachment;
            $trainerListGrid->save();

        // } catch (\Exception $e) {
        //     $res['status'] = 'error';
        //     $res['message'] = $e->getMessage();
        // }

        toastr()->success("Record is updated Successfully");
        return back();
    }

    public function show($id) {
        $trainer = TrainerQualification::find($id);

        $trainer_skill = TrainerGrid::where(['trainer_qualification_id' => $id, 'identifier' => 'trainerSkillSet'])->first();
        $trainer_list = TrainerGrid::where(['trainer_qualification_id' => $id, 'identifier' => 'listOfAttachment'])->first();

        return view('frontend.TMS.Trainer_qualification.trainer_qualification_view', compact('trainer', 'trainer_skill', 'trainer_list'));
    }

    public function sendStage(Request $request, $id) {
        try {

            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $trainer = TrainerQualification::find($id);
                $lastEmployee = TrainerQualification::find($id);

                if ($trainer->stage == 1) {
                    $trainer->stage = "2";
                    $trainer->status = "Pending HOD Review";
                    $trainer->sbmitted_by = Auth::user()->name;
                    $trainer->sbmitted_on = Carbon::now()->format('d-m-Y');
                    $trainer->sbmitted_comment = $request->comment;
                    $trainer->update();
                    return back();
                }

                if ($trainer->stage == 2) {
                    $trainer->stage = "3";
                    $trainer->status = "Closed-Done";
                    $trainer->qualified_by = Auth::user()->name;
                    $trainer->qualified_on = Carbon::now()->format('d-m-Y');
                    $trainer->qualified_comment = $request->comment;
                    $trainer->update();
                    return back();
                }
            }

        } catch(\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function rejectStage(Request $request, $id) {
        try {

            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $trainer = TrainerQualification::find($id);
                $lastEmployee = TrainerQualification::find($id);

                if ($trainer->stage == 2) {
                    $trainer->stage = "1";
                    $trainer->status = "Opened";
                    $trainer->rejected_by = Auth::user()->name;
                    $trainer->rejected_on = Carbon::now()->format('d-m-Y');
                    $trainer->rejected_comment = $request->comment;
                    $trainer->update();
                    return back();
                }
            }

        } catch(\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
