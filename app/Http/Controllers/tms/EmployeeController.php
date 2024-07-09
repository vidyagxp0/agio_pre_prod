<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeAudit;
use App\Models\EmployeeGrid;
use App\Models\RoleGroup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function store(Request $request)
    {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => [],
        ];


        // return $request->all();
        // try {
        $employee = new Employee();
        $employee->stage = '1';
        $employee->status = 'Opened';
        $employee->division_id = $request->division_id;
        $employee->assigned_to = $request->assigned_to;
        $employee->start_date = $request->start_date;
        $employee->joining_date = $request->joining_date;
        $employee->employee_id = $request->employee_id;
        $employee->employee_name = $request->employee_name;
        $employee->gender = $request->gender;
        $employee->department = $request->department;
        $employee->job_title = $request->job_title;

        if ($request->hasFile('attached_cv')) {
            $file = $request->file('attached_cv');
            $name = $request->employee_id . 'attached_cv' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $employee->attached_cv = $name; // Store only the file name
        }

        if ($request->hasFile('certification')) {
            $file = $request->file('certification');
            $name = $request->employee_id . 'certification' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $employee->certification = $name; // Store only the file name
        }

        $employee->zone = $request->zone;
        $employee->country = $request->country;
        $employee->state = $request->state;
        $employee->city = $request->city;
        $employee->site_name = $request->site_name;
        $employee->building = $request->building;
        $employee->floor = $request->floor;
        $employee->room = $request->room;

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $name = $request->employee_id . 'picture' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $employee->picture = $name; // Store only the file name
        }

        if ($request->hasFile('specimen_signature')) {
            $file = $request->file('specimen_signature');
            $name = $request->employee_id . 'specimen_signature' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $employee->specimen_signature = $name; // Store only the file name
        }

        $employee->hod = is_array($request->hod) ? implode(',', $request->hod) : '';
        $employee->designee = is_array($request->designee) ? implode(',', $request->designee) : '';
        $employee->comment = $request->comment;

        if ($request->hasFile('file_attachment')) {
            $file = $request->file('file_attachment');
            $name = $request->employee_id . 'file_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $employee->file_attachment = $name; // Store only the file name
        }

        $employee->external_comment = $request->external_comment;

        if ($request->hasFile('external_attachment')) {
            $file = $request->file('external_attachment');
            $name = $request->employee_id . 'external_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $employee->external_attachment = $name; // Store only the file name
        }
        $employee->save();

        $employee_id = $employee->id;

        $employeeJobGrid = EmployeeGrid::where(['employee_id' => $employee_id, 'identifier' => 'jobResponsibilites'])->firstOrNew();
        $employeeJobGrid->employee_id = $employee_id;
        $employeeJobGrid->identifier = 'jobResponsibilites';
        $employeeJobGrid->data = $request->jobResponsibilities;

        $employeeJobGrid->save();

        if (!empty($request->employee_external_training_data) && $request->file('employee_external_training_data')) {
            $files = [];
            foreach ($request->file('employee_external_training_data') as $file) {
                $name = $request->employee_id . 'employee_external_training_data' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $files[] =  $name; // Store the file path
            }
        }

        // $requestGridData = $request->employee_external_training_data;

        // $requestGridData[0]['filename'] = $files;

        $employeeExternalGrid = EmployeeGrid::where(['employee_id' => $employee_id, 'identifier' => 'external_training'])->firstOrNew();
        $employeeExternalGrid->employee_id = $employee_id;
        $employeeExternalGrid->identifier = 'external_training';
        $employeeExternalGrid->data = $request->external_training;
        $employeeExternalGrid->save();

        // } catch (\Exception $e) {
        //     $res['status'] = 'error';
        //     $res['message'] = $e->getMessage();

        // }

        if (!empty($request->short_description)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->previous = "Null";
            $validation2->current = $request->short_description;
            $validation2->activity_type = 'Short Description';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';
            // $validation2->comment = "Not Applicable";
            $validation2->save();
        }


        if (!empty($request->assign_to)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
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

        if (!empty($request->start_date)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Actual Start Date';
            $validation2->previous = "Null";
            $validation2->current = $request->start_date;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }
        if (!empty($request->joining_date)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Joining Date';
            $validation2->previous = "Null";
            $validation2->current = $request->joining_date;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->emp_id)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Employee ID';
            $validation2->previous = "Null";
            $validation2->current = $request->emp_id;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->employee_name)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Employee Name';
            $validation2->previous = "Null";
            $validation2->current = $request->employee_name;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->gender)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Gender';
            $validation2->previous = "Null";
            $validation2->current = $request->gender;
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
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
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

        if (!empty($request->job_title)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Job Title';
            $validation2->previous = "Null";
            $validation2->current = $request->job_title;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->attached_cv)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Attached CV';
            $validation2->previous = "Null";
            $validation2->current = $request->attached_cv;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->certification)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Certification/Qualification';
            $validation2->previous = "Null";
            $validation2->current = $request->certification;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->zone)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Zone';
            $validation2->previous = "Null";
            $validation2->current = $request->zone;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->country)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Country';
            $validation2->previous = "Null";
            $validation2->current = $request->country;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->state)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'State';
            $validation2->previous = "Null";
            $validation2->current = $request->state;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->city)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'City';
            $validation2->previous = "Null";
            $validation2->current = $request->city;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->site_name)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Site Name';
            $validation2->previous = "Null";
            $validation2->current = $request->site_name;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->building)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Building';
            $validation2->previous = "Null";
            $validation2->current = $request->building;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->floor)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Floor';
            $validation2->previous = "Null";
            $validation2->current = $request->floor;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->room)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Room';
            $validation2->previous = "Null";
            $validation2->current = $request->room;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->picture)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Picture';
            $validation2->previous = "Null";
            $validation2->current = $request->picture;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->specimen_signature)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Speciman Signature';
            $validation2->previous = "Null";
            $validation2->current = $request->specimen_signature;
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
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'HOD';
            $validation2->previous = "Null";
            $validation2->current = json_encode($request->hod);
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->designee)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Designee';
            $validation2->previous = "Null";
            $validation2->current = json_encode($request->designee);
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->comment)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Comments';
            $validation2->previous = "Null";
            $validation2->current = $request->comment;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->file_attachment)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'File Attachment';
            $validation2->previous = "Null";
            $validation2->current = $request->file_attachment;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }

        if (!empty($request->external_comment)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'External Comment';
            $validation2->previous = "Null";
            $validation2->current = $request->external_comment;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Opened";
            $validation2->change_from = "Initiation";
            $validation2->action_name = 'Create';

            $validation2->save();
        }


        if (!empty($request->external_attachment)) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'External Attachment';
            $validation2->previous = "Null";
            $validation2->current = $request->external_attachment;
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
        $employee = Employee::findOrFail($id);
        $lastDocument = Employee::findOrFail($id);

        $employee->division_id = $request->division_id;
        // dd($request->division_id);
        $employee->assigned_to = $request->assigned_to;
        $employee->start_date = $request->start_date;
        $employee->joining_date = $request->joining_date;
        $employee->employee_id = $request->employee_id;
        $employee->employee_name = $request->employee_name;
        $employee->gender = $request->gender;
        $employee->department = $request->department;
        $employee->job_title = $request->job_title;

        if ($request->hasFile('attached_cv')) {
            $file = $request->file('attached_cv');
            $name = $request->employee_id . 'attached_cv' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $employee->attached_cv = $name;
        }

        if ($request->hasFile('certification')) {
            $file = $request->file('certification');
            $name = $request->employee_id . 'certification' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $employee->certification = $name;
        }

        $employee->zone = $request->zone;
        $employee->country = $request->country;
        $employee->state = $request->state;
        $employee->city = $request->city;
        $employee->site_name = $request->site_name;
        $employee->building = $request->building;
        $employee->floor = $request->floor;
        $employee->room = $request->room;

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $name = $request->employee_id . 'picture' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $employee->picture = $name;
        }

        if ($request->hasFile('specimen_signature')) {
            $file = $request->file('specimen_signature');
            $name = $request->employee_id . 'specimen_signature' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $employee->specimen_signature = $name;
        }

        $employee->hod = is_array($request->hod) ? implode(',', $request->hod) : '';
        $employee->designee = is_array($request->designee) ? implode(',', $request->designee) : '';
        $employee->comment = $request->comment;

        if ($request->hasFile('file_attachment')) {
            $file = $request->file('file_attachment');
            $name = $request->employee_id . 'file_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $employee->file_attachment = $name;
        }

        $employee->external_comment = $request->external_comment;

        if ($request->hasFile('external_attachment')) {
            $file = $request->file('external_attachment');
            $name = $request->employee_id . 'external_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/', $name);
            $employee->external_attachment = $name;
        }
        $employee->save();

        $employee_id = $employee->id;

        $employeeJobGrid = EmployeeGrid::where(['employee_id' => $employee_id, 'identifier' => 'jobResponsibilites'])->firstOrNew();
        $employeeJobGrid->employee_id = $employee_id;
        $employeeJobGrid->identifier = 'jobResponsibilites';
        $employeeJobGrid->data = $request->jobResponsibilities;
        $employeeJobGrid->save();

        $externalTrainingData = $request->input('external_training', []);

        foreach ($externalTrainingData as $index => $training) {
            if ($request->hasFile("external_training.$index.certificate")) {
                $file = $request->file("external_training.$index.certificate");
                $name = $employee_id . '_certificate_' . $index . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/certificates'), $name);
                $externalTrainingData[$index]['certificate'] = 'upload/certificates/' . $name;
            }

            if ($request->hasFile("external_training.$index.supporting_documents")) {
                $file = $request->file("external_training.$index.supporting_documents");
                $name = $employee_id . '_supporting_documents_' . $index . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/documents'), $name);
                $externalTrainingData[$index]['supporting_documents'] = 'upload/documents/' . $name;
            }
        }

        $employeeExternalGrid = EmployeeGrid::where(['employee_id' => $employee_id, 'identifier' => 'external_training'])->firstOrNew();
        $employeeExternalGrid->employee_id = $employee_id;
        $employeeExternalGrid->identifier = 'external_training';
        $employeeExternalGrid->data = $externalTrainingData;
        $employeeExternalGrid->save();

        // } catch (\Exception $e) {
        //     $res['status'] = 'error';
        //     $res['message'] = $e->getMessage();
        // }


        if ($lastDocument->short_description != $request->short_description) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->previous = $lastDocument->short_description;
            $validation2->current = $request->short_description;
            $validation2->activity_type = 'Short Description';
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->short_description) || $lastDocument->short_description === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }


        if ($lastDocument->assign_to != $request->assign_to) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Assign To';
            $validation2->previous = $lastDocument->assign_to;
            $validation2->current = $request->assign_to;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->assign_to) || $lastDocument->assign_to === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->start_date != $request->start_date) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Actual Start Date';
            $validation2->previous = $lastDocument->start_date;
            $validation2->current = $request->start_date;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->start_date) || $lastDocument->start_date === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->joining_date != $request->joining_date) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Joining Date';
            $validation2->previous = $lastDocument->joining_date;
            $validation2->current = $request->joining_date;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->joining_date) || $lastDocument->joining_date === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->emp_id != $request->emp_id) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Employee ID';
            $validation2->previous = $lastDocument->emp_id;
            $validation2->current = $request->emp_id;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->emp_id) || $lastDocument->emp_id === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->employee_name != $request->employee_name) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Employee Name';
            $validation2->previous = $lastDocument->employee_name;
            $validation2->current = $request->employee_name;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->employee_name) || $lastDocument->employee_name === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->gender != $request->gender) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Gender';
            $validation2->previous = $lastDocument->gender;
            $validation2->current = $request->gender;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->gender) || $lastDocument->gender === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->department != $request->department) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Department';
            $validation2->previous = $lastDocument->department;
            $validation2->current = $request->department;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->department) || $lastDocument->department === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->job_title != $request->job_title) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Job Title';
            $validation2->previous = $lastDocument->job_title;
            $validation2->current = $request->job_title;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->job_title) || $lastDocument->job_title === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }
        if ($lastDocument->attached_cv != $request->attached_cv) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Attached CV';
            $validation2->previous = $lastDocument->attached_cv;
            $validation2->current = $request->attached_cv;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->attached_cv) || $lastDocument->attached_cv === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastDocument->certification != $request->certification) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Certification/Qualification';
            $validation2->previous = $lastDocument->certification;
            $validation2->current = $request->certification;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->certification) || $lastDocument->certification === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastDocument->zone != $request->zone) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Zone';
            $validation2->previous = $lastDocument->zone;
            $validation2->current = $request->zone;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->zone) || $lastDocument->zone === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastDocument->country != $request->country) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Country';
            $validation2->previous = $lastDocument->country;
            $validation2->current = $request->country;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->country) || $lastDocument->country === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->state != $request->state) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'State';
            $validation2->previous = $lastDocument->state;
            $validation2->current = $request->state;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->state) || $lastDocument->state === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->city != $request->city) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'City';
            $validation2->previous = $lastDocument->city;
            $validation2->current = $request->city;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->city) || $lastDocument->city === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }

        if ($lastDocument->site_name != $request->site_name) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Site Name';
            $validation2->previous = $lastDocument->site_name;
            $validation2->current = $request->site_name;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->site_name) || $lastDocument->site_name === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastDocument->building != $request->building) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Building';
            $validation2->previous = $lastDocument->building;
            $validation2->current = $request->building;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->building) || $lastDocument->building === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastDocument->floor != $request->floor) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Floor';
            $validation2->previous = $lastDocument->floor;
            $validation2->current = $request->floor;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->floor) || $lastDocument->floor === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastDocument->room != $request->room) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Room';
            $validation2->previous = $lastDocument->room;
            $validation2->current = $request->room;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->room) || $lastDocument->room === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastDocument->picture != $request->picture) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Picture';
            $validation2->previous = $lastDocument->picture;
            $validation2->current = $request->picture;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->picture) || $lastDocument->picture === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastDocument->specimen_signature != $request->specimen_signature) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Speciman Signature';
            $validation2->previous = $lastDocument->specimen_signature;
            $validation2->current = $request->specimen_signature;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->specimen_signature) || $lastDocument->specimen_signature === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastDocument->hod != $request->hod) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'HOD';
            $validation2->previous = $lastDocument->hod;
            $validation2->current = json_encode($request->hod);
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->hod) || $lastDocument->hod === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastDocument->designee != $request->designee) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Designee';
            $validation2->previous = $lastDocument->designee;
            $validation2->current = json_encode($request->designee);
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->designee) || $lastDocument->designee === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastDocument->comment != $request->comment) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'Comments';
            $validation2->previous = $lastDocument->comment;
            $validation2->current = $request->comment;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->comment) || $lastDocument->comment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastDocument->file_attachment != $request->file_attachment) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'File Attachment';
            $validation2->previous = $lastDocument->file_attachment;
            $validation2->current = $request->file_attachment;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->file_attachment) || $lastDocument->file_attachment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }

            $validation2->save();
        }

        if ($lastDocument->external_comment != $request->external_comment) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'External Comment';
            $validation2->previous = $lastDocument->external_comment;
            $validation2->current = $request->external_comment;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;
            if (is_null($lastDocument->external_comment) || $lastDocument->external_comment === '') {
                $validation2->action_name = 'New';
            } else {
                $validation2->action_name = 'Update';
            }
            $validation2->save();
        }


        if ($lastDocument->external_attachment != $request->external_attachment) {
            $validation2 = new EmployeeAudit();
            $validation2->emp_id = $employee->id;
            $validation2->activity_type = 'External Attachment';
            $validation2->previous = $lastDocument->external_attachment;
            $validation2->current = $request->external_attachment;
            $validation2->comment = "NA";
            $validation2->user_id = Auth::user()->id;
            $validation2->user_name = Auth::user()->name;
            $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

            $validation2->change_to =   "Not Applicable";
            $validation2->change_from = $lastDocument->status;

            if (is_null($lastDocument->external_attachment) || $lastDocument->external_attachment === '') {
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

        $employee = Employee::find($id);
        // dd($employee);
        $employee_grid_data = EmployeeGrid::where(['employee_id' => $id, 'identifier' => 'jobResponsibilites'])->first();
        $external_grid_data = EmployeeGrid::where(['employee_id' => $id, 'identifier' => 'external_training'])->first();

        return view('frontend.TMS.Employee.employee_view', compact('employee', 'employee_grid_data', 'external_grid_data'));
    }

    public function sendStage(Request $request, $id)
    {
        try {

            if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
                $employee = Employee::find($id);
                $lastEmployee = Employee::find($id);

                if ($employee->stage == 1) {
                    $employee->stage = "2";
                    $employee->status = "Active";
                    $employee->activated_by = Auth::user()->name;
                    $employee->activated_on = Carbon::now()->format('d-m-Y');
                    $employee->activated_comment = $request->comment;
                    $employee->update();
                    return back();
                }

                if ($employee->stage == 2) {
                    $employee->stage = "3";
                    $employee->status = "Closed-Retired";
                    $employee->retired_by = Auth::user()->name;
                    $employee->retired_on = Carbon::now()->format('d-m-Y');
                    $employee->retired_comment = $request->comment;
                    $employee->update();
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

    public function AuditTrial($id)
    {
        $employee = Employee::find($id);
        $audit = EmployeeAudit::where('emp_id', $id)->orderByDESC('id')->paginate();
        $today = Carbon::now()->format('d-m-y');
        $document = Employee::where('id', $id)->first();
        $document->initiator = User::where('id', $document->initiator_id)->value('name');

        return view('frontend.TMS.Employee.employee_audit', compact('audit', 'document', 'employee', 'today'));
    }
}
