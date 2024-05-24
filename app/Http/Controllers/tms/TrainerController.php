<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use App\Models\TrainerGrid;
use App\Models\TrainerQualification;
use Illuminate\Http\Request;

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
}
