<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use App\Models\RecordNumber;
use App\Models\RoleGroup;
use App\Models\TrainerGrid;
use App\Models\TrainerQualification;
use App\Models\TrainerQualificationAuditTrial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TrainerController extends Controller
{

    public function index()
    {
        $record = ((RecordNumber::first()->value('counter')) + 1);
        $record = str_pad($record, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        return view('frontend.TMS.Trainer_qualification.trainer_qualification', compact('due_date', 'record'));
    }

    public function store(Request $request)
    {
        // return $request->all();

        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => [],
        ];
        // try {
        $recordCounter = RecordNumber::first();
        $newRecordNumber = $recordCounter->counter + 1;

        $recordCounter->counter = $newRecordNumber;
        $recordCounter->save();

        $trainer = new TrainerQualification();
        $trainer->stage = '1';
        $trainer->status = 'Opened';
        $trainer->division_id = $request->division_id;
        $trainer->record_number = ((RecordNumber::first()->value('counter')) + 1);

        // $trainer->record_number = $request->record_number;
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
        $trainer->hod = $request->hod;
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


        //Audit Trails 
        if (!empty($request->short_description)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->previous = "Null";
            $validation2->current = $request->short_description;
            $validation2->activity_type = 'Short Description';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->date_of_initiation)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Date of Initiation';
            $validation2->previous = "Null";
            $validation2->current = $request->date_of_initiation;
            $validation2->comment = "Not Applicable";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->assign_to)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Assign To';
            $validation2->previous = "Null";
            $validation2->current = $request->assign_to;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            $validation2->save();
        }

        if (!empty($request->due_date)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Due Date';
            $validation2->previous = "Null";
            $validation2->current = $request->due_date;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }
        if (!empty($request->trainer_name)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Trainer Name';
            $validation2->previous = "Null";
            $validation2->current = $request->trainer_name;
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
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
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

        if (!empty($request->designation)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
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

        if (!empty($request->department)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
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

        if (!empty($request->experience)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Experience (No. of Years)';
            $validation2->previous = "Null";
            $validation2->current = $request->experience;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->hod)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'HOD';
            $validation2->previous = "Null";
            $validation2->current = $request->hod;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->trainer)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Qualification Status';
            $validation2->previous = "Null";
            $validation2->current = $request->trainer;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->qualification_comments)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Qualification Comments';
            $validation2->previous = "Null";
            $validation2->current = $request->qualification_comments;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->initial_attachment)) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Initial Attachment';
            $validation2->previous = "Null";
            $validation2->current = $request->initial_attachment;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }





        toastr()->success("Record is created Successfully");
        return redirect(url('TMS'));
        // return response()->json($res);
    }

    public function update(Request $request, $id)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => [],
        ];
        // try {
        $trainer = TrainerQualification::findOrFail($id);
        $lastdocument = TrainerQualification::findOrFail($id);

        $trainer->division_id = $request->division_id;
        // $trainer->record_number = $request->record_number;
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
        $trainer->hod = $request->hod;
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
            $trainer->initial_attachment = $name;
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


        //Audit Trails 
        //  if (!empty($request->short_description))
        if ($lastdocument->short_description != $trainer->short_description) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->previous = $lastdocument->short_description;
            $validation2->current = $trainer->short_description;
            $validation2->activity_type = 'Short Description';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->short_description) || $lastdocument->short_description === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->date_of_initiation != $trainer->date_of_initiation) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Date of Initiation';
            $validation2->previous = $lastdocument->date_of_initiation;
            $validation2->current = $trainer->date_of_initiation;
            $validation2->comment = "Not Applicable";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->date_of_initiation) || $lastdocument->date_of_initiation === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->assign_to != $trainer->assign_to) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Assign To';
            $validation2->previous = $lastdocument->assign_to;
            $validation2->current = $trainer->assign_to;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->assign_to) || $lastdocument->assign_to === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastdocument->due_date != $trainer->due_date) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Due Date';
            $validation2->previous = $lastdocument->due_date;
            $validation2->current = $trainer->due_date;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->due_date) || $lastdocument->due_date === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }
        if ($lastdocument->trainer_name != $trainer->trainer_name) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Trainer Name';
            $validation2->previous = $lastdocument->trainer_name;
            $validation2->current = $trainer->trainer_name;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->trainer_name) || $lastdocument->trainer_name === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->qualification != $trainer->qualification) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Qualification';
            $validation2->previous = $lastdocument->qualification;
            $validation2->current = $trainer->qualification;
            $validation2->comment = "NA";
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

        if ($lastdocument->designation != $trainer->designation) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Designation';
            $validation2->previous = $lastdocument->designation;
            $validation2->current = $trainer->designation;
            $validation2->comment = "NA";
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

        if ($lastdocument->department != $trainer->department) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Department';
            $validation2->previous = $lastdocument->department;
            $validation2->current = $trainer->department;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->department) || $lastdocument->department === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->experience != $trainer->experience) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Experience (No. of Years)';
            $validation2->previous = $lastdocument->experience;
            $validation2->current = $trainer->experience;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->experience) || $lastdocument->experience === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->hod != $trainer->hod) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'HOD';
            $validation2->previous = $lastdocument->hod;
            $validation2->current = $trainer->hod;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->hod) || $lastdocument->hod === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->trainer != $trainer->trainer) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Qualification Status';
            $validation2->previous = $lastdocument->trainer;
            $validation2->current = $trainer->trainer;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->trainer) || $lastdocument->trainer === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->qualification_comments != $trainer->qualification_comments) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Qualification Comments';
            $validation2->previous = $lastdocument->qualification_comments;
            $validation2->current = $trainer->qualification_comments;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->qualification_comments) || $lastdocument->qualification_comments === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastdocument->initial_attachment != $trainer->initial_attachment) {
            $validation2 = new TrainerQualificationAuditTrial();
            $validation2->trainer_id = $trainer->id;
            $validation2->activity_type = 'Initial Attachment';
            $validation2->previous = $lastdocument->initial_attachment;
            $validation2->current = $trainer->initial_attachment;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastdocument->status;
            if (is_null($lastdocument->initial_attachment) || $lastdocument->initial_attachment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }


        toastr()->success("Record is updated Successfully");
        return back();
    }

    public function show($id)
    {
        $trainer = TrainerQualification::find($id);

        $trainer_skill = TrainerGrid::where(['trainer_qualification_id' => $id, 'identifier' => 'trainerSkillSet'])->first();
        $trainer_list = TrainerGrid::where(['trainer_qualification_id' => $id, 'identifier' => 'listOfAttachment'])->first();

        return view('frontend.TMS.Trainer_qualification.trainer_qualification_view', compact('trainer', 'trainer_skill', 'trainer_list'));
    }

    public function sendStage(Request $request, $id)
    {
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

                    $history = new TrainerQualificationAuditTrial();
                    $history->trainer_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $trainer->sbmitted_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    $history->origin_state = $lastEmployee->status;
                    $history->action = 'submit';
                    $history->change_to = "Pending HOD Review";
                    $history->change_from = $lastEmployee->status;
                    $history->stage = 'Submited';
                    $history->save();

                    $trainer->update();
                    return back();
                }

                if ($trainer->stage == 2) {
                    $trainer->stage = "3";
                    $trainer->status = "Closed-Done";
                    $trainer->qualified_by = Auth::user()->name;
                    $trainer->qualified_on = Carbon::now()->format('d-m-Y');
                    $trainer->qualified_comment = $request->comment;

                    $history = new TrainerQualificationAuditTrial();
                    $history->trainer_id = $id;
                    $history->activity_type = 'Activity Log';
                    $history->current = $trainer->qualified_by;
                    $history->comment = $request->comment;
                    $history->user_id = Auth::user()->id;
                    $history->user_name = Auth::user()->name;
                    $history->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                    // $history->origin_state = $lastEmployee->status;
                    $history->change_to = "Closed-Done";
                    $history->change_from = $lastEmployee->status;
                    $history->stage = 'Qualified';
                    $history->save();
                    $trainer->update();
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

    public function rejectStage(Request $request, $id)
    {
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
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function trainerAuditTrial($id)
    {
        $trainer = TrainerQualification::find($id);
        $audit = TrainerQualificationAuditTrial::where('trainer_id', $id)->orderByDESC('id')->paginate();
        $today = Carbon::now()->format('d-m-y');
        $document = TrainerQualification::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');

        return view('frontend.TMS.Trainer_qualification.trainer_qualification_auditTrail', compact('audit', 'trainer', 'document', 'today'));
    }

    public function auditDetailstrainer($id)
    {

        $detail = TrainerQualificationAuditTrial::find($id);

        $detail_data = TrainerQualificationAuditTrial::where('activity_type', $detail->activity_type)->where('trainer_id', $detail->trainer_id)->latest()->get();

        $doc = TrainerQualification::where('id', $detail->trainer_id)->first();

        $doc->origiator_name = User::find($doc->initiator_id);

        return view('frontend.TMS.Trainer_qualification.trainerQualification_auditTrailDetails', compact('detail', 'doc', 'detail_data'));
    }
}
