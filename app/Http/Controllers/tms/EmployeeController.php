<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeGrid;
use Illuminate\Http\Request;
use Helpers;

class EmployeeController extends Controller
{
    public function store(Request $request) {
        $res = [
            'status' => 'ok',
            'message' => 'success',
            'body' => [],
        ];


        // return $request->all();
        // try {
            $employee = new Employee();
            $employee->division_id = $request->division_id;
            $employee->assigned_to = $request->assigned_to;
            $employee->start_date = $request->start_date;
            $employee->joining_date = $request->joining_date;
            $employee->employee_id = $request->employee_id;
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
            $employee = Employee::findOrFail($id);
            $employee->division_id = $request->division_id;
            $employee->assigned_to = $request->assigned_to;
            $employee->start_date = $request->start_date;
            $employee->joining_date = $request->joining_date;
            $employee->employee_id = $request->employee_id;
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

            // if ($request->hasFile('cerificate')) {
            //     $file = $request->file('certificate');
            //     $name = $request->employee_id . 'certificate' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //     $file->move('upload/', $name);
            //     $employee->certificate = $name;
            // }
            // if ($request->hasFile('suporting_documents')) {
            //     $file = $request->file('suporting_documents');
            //     $name = $request->employee_id . 'suporting_documents' . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            //     $file->move('upload/', $name);
            //     $employee->suporting_documents = $name;
            // }

            // $employeeExternalGrid = EmployeeGrid::where(['employee_id' => $employee_id, 'identifier' => 'external_training'])->firstOrNew();
            // $employeeExternalGrid->employee_id = $employee_id;
            // $employeeExternalGrid->identifier = 'external_training';
            // $employeeExternalGrid->data = $request->external_training;
            // $employeeExternalGrid->save();

        // } catch (\Exception $e) {
        //     $res['status'] = 'error';
        //     $res['message'] = $e->getMessage();
        // }

        toastr()->success("Record is updated Successfully");
        return back();
    }

    public function show($id) {

        $employee = Employee::find($id);
        $employee_grid_data = EmployeeGrid::where(['employee_id' => $id, 'identifier' => 'jobResponsibilites'])->first();
        $external_grid_data = EmployeeGrid::where(['employee_id' => $id, 'identifier' => 'external_training'])->first();

        return view('frontend.TMS.Employee.employee_view', compact('employee', 'employee_grid_data', 'external_grid_data'));
    }
}
