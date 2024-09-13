@extends('frontend.layout.main')
@section('container')
@php
$users = DB::table('users')->select('id', 'name')->get();
$divisions = DB::table('q_m_s_divisions')->select('id', 'name')->get();
$departments = DB::table('departments')->select('id', 'name')->get();
$employees = DB::table('employees')->select('id', 'employee_name')->get();

@endphp
<style>
    textarea.note-codable {
        display: none !important;
    }

    header {
        display: none;
    }
</style>

<script>
    function otherController(value, checkValue, blockID) {
        let block = document.getElementById(blockID)
        let blockTextarea = block.getElementsByTagName('textarea')[0];
        let blockLabel = block.querySelector('label span.text-danger');
        if (value === checkValue) {
            blockLabel.classList.remove('d-none');
            blockTextarea.setAttribute('required', 'required');
        } else {
            blockLabel.classList.add('d-none');
            blockTextarea.removeAttribute('required');
        }
    }
</script>

<div class="form-field-head">

    <div class="division-bar">
        <strong>On the Job</strong>
        <!-- {{ Helpers::getDivisionName(session()->get('division')) }} / On the Job -->
    </div>
</div>




{{-- ======================================
                    DATA FIELDS
    ======================================= --}}

<div id="change-control-fields">
    <div class="container-fluid">

        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Job Description</button>

        </div>

        <form action="{{ route('job_trainingcreate') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div id="step-form">

                @if (!empty($parent_id))
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
                <!-- General information content -->
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <!-- Employee Name -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="select-employee-name">Emp Name </label>
                                    <select id="select-employee-name" name="selected_employee_id" required>
                                        <option value="">Select an employee</option>
                                        @foreach ($employees as $employee)
                                        <!-- The value is the employee ID, but the name is displayed -->
                                        <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('selected_employee_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Hidden Employee Name Field for Saving the Name -->
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_name">Employee Name (Auto-filled)</label> --}}
                                    <input id="name" name="name" type="hidden" readonly>
                                    {{-- @error('employee_name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                             --}}
                            <!-- Employee Code -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Emp Code </label>
                                    <input id="employee_id" name="empcode" type="text" readonly>
                                    @error('empcode')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                  <div class="col-lg-6">
                        <div class="group-input">
                            <label for="type_of_training">SOP Document</label>      
                            <select name="sopdocument">
                                <option value="">---Select SOP Document---</option>
                                @foreach ($data as $dat)
                                <option value="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}">
                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                </option>
                                @endforeach
                            </select>
                        

                        </div>
                    </div>


                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="type_of_training">SOP Document</label>
                                    <select name="sopdocument"  >
                                        <option value="">---Select SOP Document---</option>
                                        
                                        <option value="on the job">abc</option>
                                        <option value="classroom">dfg</option>
                                    </select>
                                </div>
                            </div> --}}
                            
                            <!-- Type of Training -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="type_of_training">Type of Training</label>
                                    <select name="type_of_training" id="type_of_training" >
                                        <option value="">----Select Training---</option>
                                        <option value="on the job">On The Job</option>
                                        <option value="classroom">Classroom</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Start Date -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="start_date">Start Date</label>
                                    <input id="start_date" type="date" name="start_date" >
                                </div>
                            </div>
                            
                            <!-- End Date -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="end_date">End Date</label>
                                    <input id="end_date" type="date" name="enddate_1" >
                                </div>
                            </div>
                            
                            <!-- Department -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="department">Department</label>
                                    <input id="department" type="text" name="department" readonly>
                                </div>
                            </div>
                            
                            <!-- Location -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="location">Location</label>
                                    <input id="location" type="text" name="location" >
                                </div>
                            </div>
                            
                            <!-- HOD -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="hod">HOD</label>
                                    <input id="hod" type="text" name="hod" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="hod">Revision Purpose</label>
                                    <select name="revision_purpose" id="" >
                                        <option value="">----Select---</option>
                                        <option value="New">New</option>
                                        <option value="Old">Old</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="hod">Evaluation Required</label>
                                    <select name="evaluation_required" id="" >
                                        <option value="">----Select---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
        
                            
                            <script>
                                document.getElementById('select-employee-name').addEventListener('change', function () {
                                    var employeeId = this.value;
                            
                                    if (employeeId) {
                                        fetch(`/employees/${employeeId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                // Populate the fields with data
                                                document.getElementById('name').value = data.employee_name; // Employee Name (for saving)
                                                document.getElementById('employee_id').value = data.full_employee_id; // Employee Code
                                                document.getElementById('type_of_training').value = data.type_of_training || ''; // Type of Training
                                                document.getElementById('start_date').value = data.start_date || ''; // Start Date
                                                document.getElementById('end_date').value = data.end_date || ''; // End Date
                                                document.getElementById('department').value = data.department || 'N/A'; // Department
                                                document.getElementById('location').value = data.site_name || 'N/A'; // Location
                                                // document.getElementById('hod').value = data.hod || 'N/A'; // HOD
                                            })
                                            .catch(error => {
                                                console.error('Error fetching employee data:', error);
                                                // Clear fields if error
                                                document.getElementById('name').value = '';
                                                document.getElementById('employee_id').value = '';
                                                document.getElementById('type_of_training').value = '';
                                                document.getElementById('start_date').value = '';
                                                document.getElementById('end_date').value = '';
                                                document.getElementById('department').value = '';
                                                document.getElementById('location').value = '';
                                                // document.getElementById('hod').value = '';
                                            });
                                    } else {
                                        // Clear fields if no employee selected
                                        document.getElementById('name').value = '';
                                        document.getElementById('employee_id').value = '';
                                        document.getElementById('type_of_training').value = '';
                                        document.getElementById('start_date').value = '';
                                        document.getElementById('end_date').value = '';
                                        document.getElementById('department').value = '';
                                        document.getElementById('location').value = '';
                                        // document.getElementById('hod').value = '';
                                    }
                                });
                            </script>


            <div class="col-12">
                <div class="group-input">
                    <div class="why-why-chart">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">Sr.No.</th>
                                    <th style="width: 30%;">Subject</th>
                                    <th>Type of Training</th>
                                    <th>Reference Document No.</th>
                                    {{-- <th>Trainee Name</th> --}}
                                    <th>Trainer </th>
                                    <th>Date of Training</th>
                                    <th>Date of Completion</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                // Fetch the trainers' IDs
                                $trainerIds = DB::table('user_roles')->where('q_m_s_roles_id', 6)->pluck('user_id');
                                $usersDetails = DB::table('users')->select('id', 'name')->get();
                                $trainers = DB::table('users')->whereIn('id', $trainerIds)->select('id', 'name')->get();
                                @endphp
                                <tr>
                                    <td>1</td>


                                    <td>
                                        <input type="text" name="subject_1">
                                    </td>

                                    <td>
                                        <input type="text" name="type_of_training_1">
                                    </td>

                                    <td>
                                        <input type="text" name="reference_document_no_1">
                                    </td>
                                    {{-- <td>
                                        <select name="trainee_name_1" id="">
                                            <option value="">-- Select --</option>
                                            @foreach ($trainers as $trainer)
                                            <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                    @endforeach
                                    </select>
                                    </td> --}}
                                    <td>
                                        <select name="trainer_1" id="">
                                            <option value="">-- Select --</option>
                                            @foreach ($usersDetails as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="date" name="startdate_1" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="startdate" value="" class="hide-input" oninput="handleDateInput(this, 'startdate');checkDate('startdate','enddate')">
                                    </td>
                                    <td>
                                        <input type="date" name="enddate_1" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="enddate" value="" class="hide-input" oninput="handleDateInput(this, 'enddate');checkDate('startdate','enddate')">
                                    </td>

                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <input type="text" name="subject_2">
                                    </td>
                                    <td>
                                        <input type="text" name="type_of_training_2">
                                    </td>
                                    <td>
                                        <input type="text" name="reference_document_no_2">
                                    </td>
                                    {{-- <td>
                                         <select name="trainee_name_2" id="">
                                            <option value="">-- Select --</option>
                                            @foreach ($trainers as $trainer)
                                            <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                    @endforeach
                                    </select>
                                    </td> --}}
                                    <td>
                                        <select name="trainer_2" id="">
                                            <option value="">-- Select --</option>
                                            @foreach ($usersDetails as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="date" name="startdate_2" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="startdate" value="" class="hide-input" oninput="handleDateInput(this, 'startdate');checkDate('startdate','enddate')">
                                    </td>
                                   <td>
                                        <input type="date" name="enddate_2" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="enddate" value="" class="hide-input" oninput="handleDateInput(this, 'enddate');checkDate('startdate','enddate')">
                                    </td>

                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>
                                        <input type="text" name="subject_3">
                                    </td>
                                    <td>
                                        <input type="text" name="type_of_training_3">
                                    </td>
                                    <td>
                                        <input type="text" name="reference_document_no_3">
                                    </td>
                                    {{-- <td>
                                        <select name="trainee_name_3" id="">
                                            <option value="">-- Select --</option>
                                            @foreach ($trainers as $trainer)
                                            <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                    @endforeach
                                    </select>
                                    </td> --}}
                                    <td>
                                        <select name="trainer_3" id="">
                                            <option value="">-- Select --</option>
                                            @foreach ($usersDetails as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="date" name="startdate_3" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="startdate" value="" class="hide-input" oninput="handleDateInput(this, 'startdate');checkDate('startdate','enddate')">
                                    </td>
                                   <td>
                                        <input type="date" name="enddate_3" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="enddate" value="" class="hide-input" oninput="handleDateInput(this, 'enddate');checkDate('startdate','enddate')">
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>
                                        <input type="text" name="subject_4">
                                    </td>
                                    <td>
                                        <input type="text" name="type_of_training_4">
                                    </td>
                                    <td>
                                        <input type="text" name="reference_document_no_4">
                                    </td>
                                    {{-- <td>
                                        <select name="trainee_name_4" id="">
                                            <option value="">-- Select --</option>
                                            @foreach ($trainers as $trainer)
                                            <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                    @endforeach
                                    </select>
                                    </td> --}}
                                    <td>
                                        <select name="trainer_4" id="">
                                            <option value="">-- Select --</option>
                                            @foreach ($usersDetails as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <input type="date" name="startdate_4" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="startdate" value="" class="hide-input" oninput="handleDateInput(this, 'startdate');checkDate('startdate','enddate')">
                                    </td>
                                    <td>
                                        <input type="date" name="enddate_4" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="enddate" value="" class="hide-input" oninput="handleDateInput(this, 'enddate');checkDate('startdate','enddate')">
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>
                                        <input type="text" name="subject_5">
                                    </td>
                                    <td>
                                        <input type="text" name="type_of_training_5">
                                    </td>
                                    <td>
                                        <input type="text" name="reference_document_no_5">
                                    </td>
                                    {{-- <td>
                                        <select name="trainee_name_5" id="">
                                            <option value="">-- Select --</option>
                                            @foreach ($trainers as $trainer)
                                            <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                    @endforeach
                                    </select>
                                    </td> --}}
                                    <td>
                                        <select name="trainer_5" id="">
                                            <option value="">-- Select --</option>
                                            @foreach ($usersDetails as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="date" name="startdate_5" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="startdate" value="" class="hide-input" oninput="handleDateInput(this, 'startdate');checkDate('startdate}','enddate')">
                                    </td>
                                    <td>
                                        <input type="date" name="enddate_5" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="enddate" value="" class="hide-input" oninput="handleDateInput(this, 'enddate');checkDate('startdate','enddate')">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </div>
    <div class="button-block">
        <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
        <!-- <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                Exit </a> </button> -->

    </div>
</div>
</div>


                <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <!-- Employee Name -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="select-state">Name of Employee</label>
                                    <select id="select-state" placeholder="Select..." name="name_employee" required>
                                        <option value="">Select an employee</option>
                                        @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" data-name="{{ $employee->employee_name }}">{{ $employee->employee_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Job Description Number</label>
                                    <input type="text" name="job_description_no" id=""  >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Effective Date </label>
                                    <input type="date" name="effective_date" id="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Employee ID </label>
                                    <input type="text" name="employee_id" id="employee_ids" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="department_location">Department</label>
                                    <input type="text" name="new_department" id="departments" readonly>
                                </div>
                            </div>

                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="department_location">Location <span class="text-danger">*</span></label>
                                    <input type="text" name="location" id="city" readonly>
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="designation">Designation </label>
                                    <input type="text" name="designation" id="designees"  readonly>
                                </div>
                            </div>
                            <input type="hidden" name="employee_name" id="employee_name">

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="Short Description">Qualification </label>
                                    <input id="qualifications" type="text" name="qualification" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="repeat_nature">OutSide Experience In Years</label>
                                    <input type="text" name="total_experience" id="" >
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="repeat_nature">Date of Joining<span class="text-danger d-none">*</span></label>
                                        <div class="calenderauditee">
                                            <input type="text" id="date_joining_displays" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="date_joining" id="date_joinings" class="hide-input" oninput="handleDateInput(this, 'date_joining_display')" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.getElementById('select-state').addEventListener('change', function() {
                                    var selectedOption = this.options[this.selectedIndex];
                                    var employeeId = selectedOption.value;
                                    var employeeName = selectedOption.getAttribute('data-name');

                                    if (employeeId) {
                                        fetch(`/employees/${employeeId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                document.getElementById('employee_ids').value = data.full_employee_id;
                                                document.getElementById('departments').value = data.department;
                                                // document.getElementById('city').value = data.site_name;
                                                document.getElementById('designees').value = data.job_title;
                                                document.getElementById('experience').value = data.experience;
                                                document.getElementById('qualifications').value = data.qualification;
                                                document.getElementById('date_joinings').value = data.joining_date;
                                                document.getElementById('date_joining_displays').value = formatDate(data.joining_date);
                                            });
                                        document.getElementById('employee_name').value = employeeName;
                                    } else {
                                        document.getElementById('employee_ids').value = '';
                                        document.getElementById('departments').value = '';
                                        // document.getElementById('city').value = '';
                                        document.getElementById('designees').value = '';
                                        document.getElementById('experience').value = '';
                                        document.getElementById('qualifications').value = '';
                                        document.getElementById('employee_name').value = '';
                                        document.getElementById('date_joinings').value = '';
                                        document.getElementById('date_joining_displays').value = '';
                                    }
                                });

                                function formatDate(dateString) {
                                    const date = new Date(dateString);
                                    const options = {
                                        year: 'numeric',
                                        month: 'short',
                                        day: '2-digit'
                                    };
                                    return date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                }
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Experience With Agio Pharma </label>
                                    <input type="text" name="experience_with_agio" id="" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision" id="repeat_nature">Total Years of Experience </label>
                                    <input type="text" name="experience_if_any" id="experience" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Reason For Revision </label>
                                    <input type="text" name="reason_for_revision" id="" >
                                </div>
                            </div>


                        <div class="col-12 sub-head">
                            Job Responsibilities
                        </div>
                        <div class="group-input">
                            <label for="audit-agenda-grid">
                                Job Responsibilities
                                <button type="button" name="audit-agenda-grid" id="ObservationAdd">+</button>
                                <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="job-responsibilty-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr No.</th>
                                            <th>Job Responsibilities </th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input disabled type="text" name="jobResponsibilities[0][serial]" value="1"></td>
                                            <td><input type="text" name="jobResponsibilities[0][job]"></td>
                                            <td><input type="text" name="jobResponsibilities[0][remarks]"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                                        

    </div>
    <div class="button-block">
        <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
        {{-- <button type="button" id="ChangeNextButton" class="nextButton">Next</button> --}}
        <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                Exit </a> </button>

    </div>
</div>
</div>

</div>
</form>

</div>
</div>

<style>
    #step-form>div {
        display: none
    }

    #step-form>div:nth-child(1) {
        display: block;
    }
</style>

<script>
    $(document).ready(function() {
        $('#ObservationAdd').click(function(e) {
            function generateTableRow(serialNumber) {

                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="jobResponsibilities[' + serialNumber +
                    '][serial]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="jobResponsibilities[' + serialNumber +
                    '][job]"></td>' +
                    '<td><input type="text" class="Document_Remarks" name="jobResponsibilities[' +
                    serialNumber + '][remarks]"></td>' +


                    '</tr>';

                return html;
            }

            var tableBody = $('#job-responsibilty-table tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>


<script>
    function otherController(value, checkValue, blockID) {
        let block = document.getElementById(blockID)
        let blockTextarea = block.getElementsByTagName('textarea')[0];
        let blockLabel = block.querySelector('label span.text-danger');
        if (value === checkValue) {
            blockLabel.classList.remove('d-none');
            blockTextarea.setAttribute('required', 'required');
        } else {
            blockLabel.classList.add('d-none');
            blockTextarea.removeAttribute('required');
        }
    }
</script>

<script>
    VirtualSelect.init({
        ele: '#Facility, #Group, #Audit, #Auditee , #capa_related_record,#cft_reviewer'
    });

    function openCity(evt, cityName) {
        var i, cctabcontent, cctablinks;
        cctabcontent = document.getElementsByClassName("cctabcontent");
        for (i = 0; i < cctabcontent.length; i++) {
            cctabcontent[i].style.display = "none";
        }
        cctablinks = document.getElementsByClassName("cctablinks");
        for (i = 0; i < cctablinks.length; i++) {
            cctablinks[i].className = cctablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }



    function openCity(evt, cityName) {
        var i, cctabcontent, cctablinks;
        cctabcontent = document.getElementsByClassName("cctabcontent");
        for (i = 0; i < cctabcontent.length; i++) {
            cctabcontent[i].style.display = "none";
        }
        cctablinks = document.getElementsByClassName("cctablinks");
        for (i = 0; i < cctablinks.length; i++) {
            cctablinks[i].className = cctablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";

        // Find the index of the clicked tab button
        const index = Array.from(cctablinks).findIndex(button => button === evt.currentTarget);

        // Update the currentStep to the index of the clicked tab
        currentStep = index;
    }

    const saveButtons = document.querySelectorAll(".saveButton");
    const nextButtons = document.querySelectorAll(".nextButton");
    const form = document.getElementById("step-form");
    const stepButtons = document.querySelectorAll(".cctablinks");
    const steps = document.querySelectorAll(".cctabcontent");
    let currentStep = 0;

    function nextStep() {
        // Check if there is a next step
        if (currentStep < steps.length - 1) {
            // Hide current step
            steps[currentStep].style.display = "none";

            // Show next step
            steps[currentStep + 1].style.display = "block";

            // Add active class to next button
            stepButtons[currentStep + 1].classList.add("active");

            // Remove active class from current button
            stepButtons[currentStep].classList.remove("active");

            // Update current step
            currentStep++;
        }
    }

    function previousStep() {
        // Check if there is a previous step
        if (currentStep > 0) {
            // Hide current step
            steps[currentStep].style.display = "none";

            // Show previous step
            steps[currentStep - 1].style.display = "block";

            // Add active class to previous button
            stepButtons[currentStep - 1].classList.add("active");

            // Remove active class from current button
            stepButtons[currentStep].classList.remove("active");

            // Update current step
            currentStep--;
        }
    }
</script>
<script>
    document.getElementById('initiator_group').addEventListener('change', function() {
        var selectedValue = this.value;
        document.getElementById('initiator_group_code').value = selectedValue;
    });

    function setCurrentDate(item) {
        if (item == 'yes') {
            $('#effect_check_date').val('{{ date('
                d - M - Y ') }}');
        } else {
            $('#effect_check_date').val('');
        }
    }
</script>
<script>
    var maxLength = 255;
    $('#docname').keyup(function() {
        var textlen = maxLength - $(this).val().length;
        $('#rchars').text(textlen);
    });
</script>
@endsection