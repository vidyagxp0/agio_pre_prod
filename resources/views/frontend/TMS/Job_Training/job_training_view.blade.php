@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->get();
    @endphp
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>

    <style>
        .progress-bars div {
            flex: 1 1 auto;
            border: 1px solid grey;
            padding: 5px;
            text-align: center;
            position: relative;
            /* border-right: none; */
            background: white;
        }

        .state-block {
            padding: 20px;
            margin-bottom: 20px;
        }

        .progress-bars div.active {
            background: green;
            font-weight: bold;
        }

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(1) {
            border-radius: 20px 0px 0px 20px;
        }

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(4) {
            border-radius: 0px 20px 20px 0px;

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
            {{ Helpers::getDivisionName(session()->get('division')) }}
        </div>
    </div>




    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}

    <div id="change-control-fields">
        <div class="container-fluid">


            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>

                    <div class="d-flex" style="gap:20px;">
                        @php
                            $userRoles = DB::table('user_roles')
                                ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => 4])
                                ->get();
                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                        @endphp

                        <button class="button_theme1">
                            <a class="text-white" href="{{ route('job_audittrail', $jobTraining->id) }}"> Audit Trail
                            </a>
                        </button>

                        @if ($jobTraining->stage == 1)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Send to JD
                            </button>
                        @elseif($jobTraining->stage == 2)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Send to Certification
                            </button>
                        @elseif($jobTraining->stage == 3)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Complete
                            </button>
                        @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('TMS') }}"> Exit
                            </a> </button>
                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    {{-- ------------------------------By Pankaj-------------------------------- --}}
                    @if ($jobTraining->stage == 0)
                        <div class="progress-bars ">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars d-flex">
                            @if ($jobTraining->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif

                            @if ($jobTraining->stage >= 2)
                                <div class="active">Send To JD</div>
                            @else
                                <div class="">Send To JD</div>
                            @endif

                            @if ($jobTraining->stage >= 3)
                                <div class="active">Certification</div>
                            @endif

                            @if ($jobTraining->stage >= 4)
                                <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- @endif --}}
            </div>
        </div>

        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm2')">Job Description</button>
            @if ($jobTraining->stage >= 3)
            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Certificate</button>
            @endif

        </div>

        <script>
            $(document).ready(function() {
                <?php if (in_array($jobTraining->stage, [4])) : ?>
                $("#target :input").prop("disabled", true);
                <?php endif; ?>
            });
        </script>

        <form id="target" action="{{ route('job_trainingupdate', ['id' => $jobTraining->id]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div id="step-form">

                @if (!empty($parent_id))
                    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                    <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="row">
               
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number">Name </label>
                                        <input type="text" name="name" id="name_employee"
                                            value="{{ $jobTraining->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="employee_id">Emp Code</label>
                                        <input id="employee_id" name="empcode" type="text"
                                            value="{{ $jobTraining->empcode }}" readonly>
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
                                                <option
                                                    value="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                    {{ $savedSop == $dat->sop_type_short . '/' . $dat->department_id . '/000' . $dat->id . '/R' . $dat->major ? 'selected' : '' }}>
                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="type_of_training">Type of Training</label>
                                        <select name="type_of_training" id="type_of_training">
                                            <option value="">----Select Training----</option>
                                            <option value="on the job"
                                                {{ $jobTraining->type_of_training == 'on the job' ? 'selected' : '' }}>On
                                                The Job</option>
                                            <option value="classroom"
                                                {{ $jobTraining->type_of_training == 'classroom' ? 'selected' : '' }}>
                                                Classroom</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="start_date">Start Date</label>
                                        <input id="start_date" type="date" name="start_date"
                                            value="{{ $jobTraining->start_date }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="end_date">End Date</label>
                                        <input id="end_date" type="date" name="enddate_1"
                                            value="{{ $jobTraining->enddate_1 }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Department">Department</label>
                                        <select name="department" readonly>
                                            <option value="">-- Select Dept --</option>
                                
                                            @php
                                                $savedDepartmentId = old('department', $jobTraining->department);
                                            @endphp

                                            @foreach (Helpers::getDepartments() as $code => $department)
                                                <option value="{{ $code }}"
                                                    @if ($savedDepartmentId == $code) selected @endif>{{ $department }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code">Location</label>

                                        <input type="text" name="location" value="{{ $jobTraining->location }}" readonly>

                                    </div>
                                </div>

                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Persons">HOD</label>
                                        <select name="hod" id="hod">
                                            <option value="">-- Select HOD --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $user->id == old('hod', $jobTraining->hod) ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="hod">Revision Purpose</label>
                                    <select name="revision_purpose" id="" >
                                        <option value="">----Select---</option>
                                            <option value="New"
                                                {{ $jobTraining->revision_purpose == 'New' ? 'selected' : '' }}>New
                                                </option>
                                            <option value="Old"
                                                {{ $jobTraining->revision_purpose == 'Old' ? 'selected' : '' }}>
                                                Old</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="hod">Evaluation Required</label>
                                    <select name="evaluation_required" id="" >
                                        <option value="">----Select---</option>
                                        <option value="Yes"
                                                {{ $jobTraining->evaluation_required == 'Yes' ? 'selected' : '' }}>Yes
                                                </option>
                                            <option value="No"
                                                {{ $jobTraining->evaluation_required == 'No' ? 'selected' : '' }}>
                                                No</option>
                                    
                                    </select>
                                </div>
                            </div>


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
                                                        <th>Trainer</th>
                                                        <th> Date of Training</th>
                                                        <th>Date of Completion </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        // Fetch the trainers' IDs
                                                        $trainerIds = DB::table('user_roles')
                                                            ->where('q_m_s_roles_id', 6)
                                                            ->pluck('user_id');
                                                        $usersDetails = DB::table('users')->select('id', 'name')->get();
                                                        $trainers = DB::table('users')
                                                            ->whereIn('id', $trainerIds)
                                                            ->select('id', 'name')
                                                            ->get();
                                                    @endphp

                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>
                                                                <input type="text" name="subject_{{ $i }}"
                                                                    value="{{ $jobTraining->{'subject_' . $i} }}">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                    name="type_of_training_{{ $i }}"
                                                                    value="{{ $jobTraining->{'type_of_training_' . $i} }}">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                    name="reference_document_no_{{ $i }}"
                                                                    value="{{ $jobTraining->{'reference_document_no_' . $i} }}">
                                                            </td>
                     
                                                            <td>
                                                                <select name="trainer_{{ $i }}"
                                                                    id="">
                                                                    <option value="">-- Select --</option>
                                                                    @foreach ($usersDetails as $u)
                                                                        <option value="{{ $u->id }}"
                                                                            {{ $jobTraining->{'trainer_' . $i} == $u->id ? 'selected' : '' }}>
                                                                            {{ $u->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="date"
                                                                    name="startdate_{{ $i }}"
                                                                    value="{{ $jobTraining->{'startdate_' . $i} }}"
                                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                    class="hide-input"
                                                                    oninput="handleDateInput(this, 'startdate');checkDate('startdate','enddate')">
                                                            </td>

                                                            <td>
                                                                <input type="date"
                                                                    name="enddate_{{ $i }}"
                                                                    value="{{ $jobTraining->{'enddate_' . $i} }}"
                                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                    class="hide-input"
                                                                    oninput="handleDateInput(this, 'enddate');checkDate('enddate','startdate')">
                                                            </td>
                              
                                                        </tr>
                                                    @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                      

                            </div>
                        </div>
                    </div>

                </div>


        <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="select-state">Name of Employee</label>
                                    <select id="select-state" name="name_employee_disabled" disabled>
                                        <option value="">Select an employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" 
                                                {{ $employee->id == old('name_employee', $jobTraining->name_employee) ? 'selected' : '' }}
                                                data-name="{{ $employee->employee_name }}">
                                                {{ $employee->employee_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="name_employee" value="{{ old('name_employee', $jobTraining->name_employee) }}">
                                    @error('employee_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Job Description Number</label>
                                    <input type="text" name="job_description_no" value="{{ old('job_description_no', $jobTraining->job_description_no) }}" @if($jobTraining->stage != 2) disabled @endif>
                                </div>
                            </div>
              
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="end_date">Effective Date </label>
                                    <input id="end_date" type="date" value="{{ old('effective_date', $jobTraining->effective_date) }}" name="effective_date" @if($jobTraining->stage != 2) disabled @endif>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Employee ID </label>
                                    <input disabled type="text" name="employee_id" value="{{ $jobTraining->empcode }}" id="employee_ids" readonly>


                                    
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="department_location">Department</label>
                                    <select  name="new_department">
                                            <option value="">-- Select Dept --</option>
                                
                                            @php
                                                $savedDepartmentId = old('new_department', $jobTraining->new_department);
                                            @endphp

                                            @foreach (Helpers::getDepartments() as $code => $department)
                                                <option value="{{ $code }}"
                                                    @if ($savedDepartmentId == $code) selected @endif>{{ $department }}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="designation">Designation </label>
                                    <input type="text" name="designation" id="designees" value="{{ $jobTraining->designation }}"  readonly>
                                </div>
                            </div>
                            <input type="hidden" name="employee_name" id="employee_name">

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="Short Description">Qualification </label>
                                    <input id="qualifications" type="text" name="qualification" value="{{ $jobTraining->qualification }}" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input" id="repeat_nature">
                                    <label for="repeat_nature">OutSide Experience In Years</label>
                                    <input type="text" name="total_experience" value="{{ old('total_experience', $jobTraining->total_experience) }}" @if($jobTraining->stage != 2) disabled @endif>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="repeat_nature">Date of Joining<span class="text-danger d-none">*</span></label>
                                        <div class="calenderauditee">
                                            <input type="text" id="date_joining_displays" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="date_joining" id="date_joinings" class="hide-input" oninput="handleDateInput(this, 'date_joining_display')" value="{{ $jobTraining->date_joining }}" >
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
                                                document.getElementById('designees').value = data.job_title;
                                                document.getElementById('experience').value = data.experience;
                                                document.getElementById('qualifications').value = data.qualification;
                                                document.getElementById('date_joinings').value = data.joining_date;
                                                document.getElementById('date_joining_displays').value = formatDate(data.joining_date);
                                            });
                                        document.getElementById('employee_name').value = employeeName;
                                    } else {
                                        // Reset fields if no employee is selected
                                        document.getElementById('employee_ids').value = '';
                                        document.getElementById('departments').value = '';
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
                                    <input type="text" name="experience_with_agio" value="{{ old('experience_with_agio', $jobTraining->experience_with_agio) }}" @if($jobTraining->stage != 2) disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Total Years of Experience </label>
                                    <input type="text" name="experience_if_any" id="" value="{{ $jobTraining->experience_if_any }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Reason For Revision </label>
                                    <input type="text" name="reason_for_revision" value="{{ old('reason_for_revision', $jobTraining->reason_for_revision) }}" @if($jobTraining->stage != 2) disabled @endif>
                                </div>
                            </div>
                
                    <div class="col-12 sub-head">
                        Job Responsibilities
                    </div>
                    <div class="pt-2 group-input">
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
                                    @if ($employee_grid_data && is_array($employee_grid_data->data))
                                    @foreach ($employee_grid_data->data as $index => $employee_grid)
                                    <tr>
                                        <td><input disabled type="text" name="jobResponsibilities[{{ $loop->index }}][serial]" value="{{ $loop->index+1 }}"></td>
                                        <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][job]" value="{{ array_key_exists('job', $employee_grid) ? $employee_grid['job'] : '' }}" @if($jobTraining->stage != 2) disabled @endif></td>
                                        <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][remarks]" value="{{ array_key_exists('remarks', $employee_grid) ? $employee_grid['remarks'] : '' }}" @if($jobTraining->stage != 2) disabled @endif></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td><input disabled type="text" name="jobResponsibilities[0][serial]" value="1"></td>
                                        <td><input type="text" name="jobResponsibilities[0][job]" @if($jobTraining->stage != 2) disabled @endif></td>
                                        <td><input type="text" name="jobResponsibilities[0][remarks]" @if($jobTraining->stage != 2) disabled @endif></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div> 

                    {{-- <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Submitted By">Reporting Authority: </label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Submitted On">Responsible Person/s in absence </label>
                            <div class="static"></div>
                        </div>
                    </div> 

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Submitted By">Accepted by (Employee): </label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Submitted On">Authorized by (Head QA/CQA):  </label>
                            <div class="static"></div>
                        </div>
                    </div>--}}

            </div>
            <div class="button-block">
                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                <!-- <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                        Exit </a> </button> -->

            </div>
        </div>
        </div>

                @if ($jobTraining->stage >= 3)
                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="certificate-container">
                                        <div class="certificate-title">TRAINING CERTIFICATE</div>

                                        <div class="certificate-description"><br><br>
                                            This is to certify that Mr./Ms./Mrs. <strong>{{$jobTraining->name}}</strong>.
                                            has undergone On Job training including the requirement of cGMP and has shown a good attitude and thorough understanding in the subject.
                                        </div>

                                        <div class="certificate-description">
                                            Therefore we certify that Mr. Ms. / Mrs. <strong>{{$jobTraining->name}}</strong>.
                                            is capable of performing his/her assigned duties in the <strong>{{$jobTraining->department}}</strong> Department independently.
                                        </div>

                                        <div class="date-container">
                                            <div>Sign/Date</div>
                                            <div class="signature">Head Department</div>
                                        </div>

                                        <div class="signature-container">
                                            <div>Sign/Date</div>
                                            <div class="signature">Head QA/CQA</div>
                                        </div>
                                    </div>
                                </div>

                                <div style="margin-top: 40px;" class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

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

<style>
 
        .certificate-container {
            width: 1000px;
            height: 500px;
            border: 4px solid #00000061;
            padding: 18px;
            background-color: white;
            position: relative;
            margin: auto;
        }
        .certificate-title {
            font-size: 30px;
            font-weight: bold;
            color: #00aaff;
            display: flex;
            justify-content: center;
        }
        .certificate-subtitle {
            font-size: 18px;
            color: #555;
        }
 
        .certificate-description {
            margin-top: 30px;
            font-size: 18px;
            color: #333;
        }
        .date-container {
            position: absolute;
            bottom: 40px;
            left: 50px;
            font-size: 18px;
            color: #333;
        }
        .signature-container {
            position: absolute;
            bottom: 40px;
            right: 50px;
            text-align: center;
            font-size: 18px;
            color: #333;
        }
        .signature {
            margin-top: 10px;
            border-top: 1px solid #333;
            width: 200px;
        }
</style>

    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('rcms/job_trainer_send', $jobTraining->id) }}" method="POST"
                    id="signatureModalForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>

                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>

                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" required>
                        </div>

                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input type="comment" name="comment">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="signatureModalButton">
                            <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Submit
                        </button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
