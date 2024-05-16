<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeGrid;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function store(Request $request) {

        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => [],
        ];
        try {
            $employee = new Employee();
            $employee->assigned_to = $request->assigned_to;
            $employee->start_date = $request->start_date;
            $employee->joining_date = $request->joining_date;
            $employee->employee_id = $request->employee_id;
            $employee->gender = $request->gender;
            $employee->department = $request->department;
            $employee->job_title = $request->job_title;

            if (!empty($request->attached_cv) && $request->file('attached_cv')) {
                $files = [];
                foreach ($request->file('attached_cv') as $file) {
                    $name = $request->employee_id . 'attached_cv' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] =  $name; // Store the file path
                }
                // Save the file paths in the database
                $employee->attached_cv = json_encode($files);
            }

            if (!empty($request->certification) && $request->file('certification')) {
                $files = [];
                foreach ($request->file('certification') as $file) {
                    $name = $request->employee_id . 'certification' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] =  $name; // Store the file path
                }
                // Save the file paths in the database
                $employee->certification = json_encode($files);
            }

            $employee->zone = $request->zone;
            $employee->country = $request->country;
            $employee->state = $request->state;
            $employee->city = $request->city;
            $employee->site_name = $request->site_name;
            $employee->building = $request->building;
            $employee->floor = $request->floor;
            $employee->room = $request->room;

            if (!empty($request->picture) && $request->file('picture')) {
                $files = [];
                foreach ($request->file('picture') as $file) {
                    $name = $request->employee_id . 'picture' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] =  $name; // Store the file path
                }
                // Save the file paths in the database
                $employee->picture = json_encode($files);
            }

            if (!empty($request->specimen_signature) && $request->file('specimen_signature')) {
                $files = [];
                foreach ($request->file('specimen_signature') as $file) {
                    $name = $request->employee_id . 'specimen_signature' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] =  $name; // Store the file path
                }
                // Save the file paths in the database
                $employee->specimen_signature = json_encode($files);
            }

            $employee->hod = $request->hod;
            $employee->designee = $request->designee;
            $employee->comment = $request->comment;

            if (!empty($request->file_attachment) && $request->file('file_attachment')) {
                $files = [];
                foreach ($request->file('file_attachment') as $file) {
                    $name = $request->employee_id . 'file_attachment' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('upload/', $name);
                    $files[] =  $name; // Store the file path
                }
                // Save the file paths in the database
                $employee->file_attachment = json_encode($files);
            }

            $employee->external_comment = $request->external_comment;
            $employee->external_attachment = $request->external_attachment;

            $employee->save();

            $employee_id = $employee->id;

            $employeeJobGrid = EmployeeGrid::where(['employee_id' => $employee_id, 'identifier' => 'jobResponsibilites'])->firstOrCreate();
            $employeeJobGrid->employee_id = $employee_id;
            $employeeJobGrid->identifier = 'jobResponsibilites';
            $employeeJobGrid->data = $request->employee_job_data;

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


            $employeeExternalGrid = EmployeeGrid::where(['employee_id' => $employee_id, 'identifier' => 'external_training'])->firstOrCreate();
            $employeeExternalGrid->employee_id = $employee_id;
            $employeeExternalGrid->identifier = 'external_training';
            $employeeExternalGrid->data = $request->employee_external_training_data;
            $employeeExternalGrid->save();

        } catch (\Exception $e) {
            $res['status'] = 'error';
            $res['message'] = $e->getMessage();

        }

        toastr()->success("Record is created Successfully");
        return redirect(url('TMS'));
        // return response()->json($res);
    }
}
