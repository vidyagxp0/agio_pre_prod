<?php

namespace App\Http\Controllers\tms;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function store(Request $request) {
        $employee = new Employee();
        $employee->assigned_to = $request->assigned_to;
        $employee->start_date = $request->start_date;
        $employee->joining_date = $request->joining_date;
        $employee->employee_id = $request->employee_id;
        $employee->gender = $request->gender;
        $employee->department = $request->department;
        $employee->job_title = $request->job_title;
        // attached_cv
        // certification
        $employee->zone = $request->zone;
        $employee->country = $request->country;
        $employee->state = $request->state;
        $employee->city = $request->city;
        $employee->site_name = $request->site_name;
        $employee->building = $request->building;
        $employee->floor = $request->floor;
        $employee->room = $request->room;
        // picture
        // specimen_signature
        $employee->hod = $request->hod;
        $employee->designee = $request->designee;
        $employee->comment = $request->comment;
        // file_attachment

        // external_comment
        // external_attachment

        $employee->save();
    }
}
