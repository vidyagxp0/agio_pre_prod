@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->select('id', 'name')->where('active', 1)->get();
        $userRoles = DB::table('user_roles')->select('user_id')->where('q_m_s_roles_id', 4)->distinct()->get();
        $departments = DB::table('departments')->select('id', 'name')->get();
        $divisions = DB::table('q_m_s_divisions')->select('id', 'name')->get();

        $userIds = DB::table('user_roles')->where('q_m_s_roles_id', 4)->distinct()->pluck('user_id');

        // Step 3: Use the plucked user_id values to get the names from the users table
        $userNames = DB::table('users')->whereIn('id', $userIds)->pluck('name');

        // If you need both id and name, use the select method and get
        $userDetails = DB::table('users')->whereIn('id', $userIds)->select('id', 'name')->get();
        // dd ($userIds,$userNames, $userDetails);
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
        function handleDateInput(input, targetId) {
            const target = document.getElementById(targetId);
            const date = new Date(input.value);
            const options = {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            };
            const formattedDate = date.toLocaleDateString('en-US', options).replace(/ /g, '-');
            target.value = formattedDate;
        }
    </script>

    <div class="form-field-head">
        <div class="pr-id">
            Manage Employee
        </div>
        {{-- <div class="division-bar">
            <strong>Site Division/Project</strong> :
            Plant
        </div> --}}

        {{-- <div class="button-bar">
            <button type="button">Save</button>
            <button type="button">Cancel</button>
            <button type="button">New</button>
            <button type="button">Copy</button>
            <button type="button">Child</button>
            <button type="button">Check Spelling</button>
            <button type="button">Change Project</button>
        </div> --}}
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
                                ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $employee->division_id])
                                ->get();
                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                        @endphp

                        <button class="button_theme1">
                            <a class="text-white" href="{{ route('audittrail', $employee->id) }}"> Audit Trail
                            </a>
                        </button>
                        <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                                            Activate
                                                        </button> -->
                        @if ($employee->stage == 1)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Activate
                            </button>
                        @elseif($employee->stage == 2)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Send To Induction Training
                            </button>
                        @elseif($employee->stage == 3)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Complete
                            </button>
                        @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('TMS') }}"> Exit
                            </a>
                        </button>


                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    {{-- ------------------------------By Pankaj-------------------------------- --}}
                    @if ($employee->stage == 0)
                        <div class="progress-bars ">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars d-flex">
                            @if ($employee->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif

                            @if ($employee->stage >= 2)
                                <div class="active">Active </div>
                            @else
                                <div class="">Active</div>
                            @endif
                            @if ($employee->stage >= 3)
                                <div class="active">Induction Training</div>
                            @else
                                <div class="">Induction Training</div>
                            @endif

                            @if ($employee->stage >= 4)
                                <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed-Complete</div>
                            @endif
                    @endif


                </div>
                {{-- @endif --}}
            </div>
        </div>
        <!-- Tab links -->
        <div class="cctab">

            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Employee</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm2')">Induction Training</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Activity Log</button>

        </div>
        <script>
            $(document).ready(function() {
                <?php if ($employee->stage == 4) : ?>
                $("#target :input").prop("disabled", true);
                <?php endif; ?>
            });
        </script>

        <form id="target" action="{{ route('employee.update', $employee->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <!-- Tab content -->
            <div id="step-form">

                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Site Division/Project">Site Division/Project</label>
                                     <input value="{{ $employee->division_id }}" name="division_id" readonly >
                            <select name="division_id" id="division_id">
                                <option value="{{ $employee->division_id }}">-- Select --</option>
                                @foreach ($divisions as $division)
                                <option value="{{ $division->id }}" @if ($division->id == $employee->division_id) selected @endif>{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="site_name">Site Division/Project <span class="text-danger">*</span></label>
                                    <!-- <input type="text" id="site_division" name="site_division" value="{{ $employee->site_division }}" required> -->
                                    <select name="site_division">
                                        <option value="">Enter Your Selection Here</option>
                                        <option value="Corporate" @if ($employee->site_division == 'Corporate') selected @endif>
                                            Corporate</option>
                                        <option value="Plant" @if ($employee->site_division == 'Plant') selected @endif>Plant
                                        </option>

                                    </select>
                                </div>
                            </div>


                            <!-- <div class="col-lg-6">
                                                            <div class="group-input">
                                                                <label for="Assigned To">Assigned To</label>
                                                                <select name="assigned_to">
                                                                    <option value="">-- Select --</option>
                                                                    @foreach ($users as $user)
    <option value="{{ $user->id }}" @if ($user->id == $employee->assigned_to) selected @endif>{{ $user->name }}</option>
    @endforeach
                                                                </select>
                                                            </div>
                                                        </div> -->

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Joining Date">Joining Date</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="joining_date" readonly placeholder="DD-MMM-YYYY"
                                            value="{{ $employee->joining_date ? \Carbon\Carbon::parse($employee->joining_date)->format('d-M-Y') : '' }}" />
                                        <input type="date" name="joining_date"
                                            max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                            value="{{ $employee->joining_date ?? '' }}" class="hide-input"
                                            oninput="handleDateInput(this, 'joining_date')"  readonly/>
                                    </div>
                                </div>
                            </div>


                            <!-- <div class="col-lg-6 new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <label for="Actual Start Date">Actual Start Date</label>
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="start_date" readonly placeholder="DD-MMM-YYYY" value="{{ $employee->start_date ? \Carbon\Carbon::parse($employee->start_date)->format('d-M-Y') : '' }}" />
                                                                    <input type="date" name="start_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $employee->start_date ?? '' }}" class="hide-input" oninput="handleDateInput(this, 'start_date')" />
                                                                </div>
                                                            </div>
                                                        </div> -->

                            {{-- <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Employee ID">Employee ID</label>
                            <input type="text" name="employee_id" value="{{ $employee->employee_id }}">
                        </div>
                    </div> --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Prefix">Prefix<span class="text-danger">*</span></label>
                                    <select name="prefix" id="prefix-select" required onchange="toggleInputBox()">
                                        <option value="">Enter Your Selection Here</option>
                                        <option value="PW"
                                            {{ (old('prefix') ?? $employee->prefix) == 'PW' ? 'selected' : '' }}>Permanent
                                            Workers</option>
                                        <option value="PS"
                                            {{ (old('prefix') ?? $employee->prefix) == 'PS' ? 'selected' : '' }}>Permanent
                                            Staff</option>
                                        <option value="OS"
                                            {{ (old('prefix') ?? $employee->prefix) == 'OS' ? 'selected' : '' }}>Others
                                            Separately</option>
                                    </select>
                                    <div id="other-input" style="display: none; margin-top: 5px;">
                                        <label for="other">Others</label>
                                        <input type="text" name="other" id="other"
                                            value="{{ $employee->other }}" style="width: 100%;">
                                    </div>
                                </div>
                            </div>

                            <script>
                                function toggleInputBox() {
                                    const selectElement = document.getElementById('prefix-select');
                                    const otherInput = document.getElementById('other-input');


                                    if (selectElement.value === 'OS') {
                                        otherInput.style.display = 'block';
                                    } else {
                                        otherInput.style.display = 'none';
                                    }
                                }
                                document.addEventListener('DOMContentLoaded', function() {
                                    toggleInputBox();
                                });
                            </script>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Employee ID">Employee ID</label>
                                    <input type="text" name="emp_id" value="{{ $employee->emp_id }}" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_name">Employee Name <span class="text-danger">*</span></label>
                                    <input type="text" name="employee_name" value="{{ $employee->employee_name }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Gender">Gender</label>
                                    <select name="gender">
                                        <option value="">Enter Your Selection Here</option>
                                        <option value="Female" @if ($employee->gender == 'Female') selected @endif>Female
                                        </option>
                                        <option value="Male" @if ($employee->gender == 'Male') selected @endif>Male
                                        </option>
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Department">Department Name</label>
                                    <select name="department">
                                        <option>-- Select --</option>
                                        @php
                                            $savedDepartmentId = old('department', $employee->department);
                                        @endphp

                                        @foreach (Helpers::getDepartments() as $code => $department)
                                            <option value="{{ $code }}"
                                                @if ($savedDepartmentId == $code) selected @endif>{{ $department }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="qualification">Qualification<span class="text-danger">*</span></label>
                                    <input type="text" name="qualification" value="{{ $employee->qualification }}" required>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Department">Department Name</label>
                                    <select name="department" id="department" onchange="toggleOtherDepartment()">
                                        <option value="">-- Select --</option>
                                        @php
                                            $savedDepartmentId = old('department', $employee->department);
                                        @endphp

                                        @foreach (Helpers::getDepartments() as $code => $department)
                                            <option value="{{ $code }}"
                                                @if ($savedDepartmentId == $code) selected @endif>{{ $department }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @php
                                $savedJobTitle = old('job_title', $employee->job_title);
                            @endphp

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="job_title">Designation<span class="text-danger">*</span></label>
                                    <select name="job_title" id="job_title" required onchange="toggleOtherDesignation()">
                                        <option value="">Enter Your Selection Here</option>
                                        <option value="Trainee" @if ($savedJobTitle == 'Trainee') selected @endif>Trainee
                                        </option>
                                        <option value="Officer" @if ($savedJobTitle == 'Officer') selected @endif>Officer
                                        </option>
                                        <option value="Senior Officer" @if ($savedJobTitle == 'Senior Officer') selected @endif>Senior Officer</option>
                                        <option value="Executive" @if ($savedJobTitle == 'Executive') selected @endif>
                                            Executive</option>
                                        <option value="Senior Executive" @if ($savedJobTitle == 'Senior Executive') selected @endif>
                                        Senior Executive</option>
                                        <option value="Assistant Manager" @if ($savedJobTitle == 'Assistant Manager') selected @endif>
                                            Assistant Manager</option>
                                        <option value="Manager" @if ($savedJobTitle == 'Manager') selected @endif>Manager
                                        </option>
                                        <option value="Senior General Manager" @if ($savedJobTitle == 'Senior General Manager') selected @endif>Senior General Manager
                                        </option>
                                        <option value="Senior Manager" @if ($savedJobTitle == 'Senior Manager') selected @endif>Senior Manager</option>
                                        <option value="Deputy General Manager" @if ($savedJobTitle == 'Deputy General Manager') selected @endif>
                                            Deputy General Manager</option>
                                        <option value="Assistant General Manager and General Manager" @if ($savedJobTitle == 'Assistant General Manager and General Manager') selected @endif>Assistant General Manager and General Manager</option>
                                        <option value="Head Quality" @if ($savedJobTitle == 'Head Quality') selected @endif>
                                            Head Quality</option>
                                        <option value="VP Quality" @if ($savedJobTitle == 'VP Quality') selected @endif>VP
                                            Quality</option>
                                        <option value="Plant Head" @if ($savedJobTitle == 'Plant Head') selected @endif>
                                            Plant Head</option>
                                        <option value="Other Designation"
                                            @if ($savedJobTitle == 'Other Designation') selected @endif>Other Designation</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Experience">Experience (No. of Years)</label>
                                    <select name="experience" id="experience">
                                        <option>Select </option>
                                        @for ($experience = 1; $experience <= 70; $experience++)
                                            <option value="{{ $experience }}"
                                                @if ($experience == $employee->experience) selected @endif>{{ $experience }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="other_department">Other Department</label>
                                    <input type="text" name="other_department"
                                        value="{{ $employee->other_department }}">
                                </div>
                            </div> --}}

                            <div class="col-lg-6" id="other_department_container" style="display: none;">
                                <div class="group-input">
                                    <label for="other_department">Other Department</label>
                                    <input type="text" name="other_department" id="other_department"
                                        value="{{ old('other_department', $employee->other_department) }}">
                                </div>
                            </div>
                            <div class="col-lg-6" id="other_designation_container" style="display: none;">
                                <div class="group-input">
                                    <label for="other_designation">Other Designation</label>
                                    <input type="text" name="other_designation" id="other_designation"
                                        value="{{ $employee->other_designation }}">
                                </div>
                            </div>

                            <script>
                                function toggleOtherDesignation() {
                                    const jobTitleSelect = document.getElementById('job_title');
                                    const otherDesignationContainer = document.getElementById('other_designation_container');
                                    // Check if the selected job title is "Other designation"
                                    if (jobTitleSelect.value === "Other designation") {
                                        otherDesignationContainer.style.display = 'block';
                                    } else {
                                        otherDesignationContainer.style.display = 'none';
                                    }
                                }

                                window.onload = function() {
                                    toggleOtherDesignation();
                                };
                            </script>
                            <script>
                                function toggleOtherDepartment() {
                                    const departmentSelect = document.getElementById('department');
                                    const otherDepartmentContainer = document.getElementById('other_department_container');
                                    // Check if the selected department is "Other Department"
                                    if (departmentSelect.value === "Other") {
                                        otherDepartmentContainer.style.display = 'block';
                                    } else {
                                        otherDepartmentContainer.style.display = 'none';
                                    }
                                }

                                window.onload = function() {
                                    toggleOtherDepartment();
                                };
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Attached CV">Attached CV</label>
                                    <input type="file" id="myfile" name="attached_cv"
                                        value="{{ $employee->attached_cv }}">
                                    <a href="{{ asset('upload/' . $employee->attached_cv) }}"
                                        target="_blank">{{ $employee->attached_cv }}</a>
                                </div>
                            </div>

                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="attached_cv">Attached CV</label>
                                    <input type="file" id="myfile" name="attached_cv">

                                    @if ($employee->attached_cv)
                                        <a href="{{ asset('upload/' . $employee->attached_cv) }}" target="_blank">
                                            {{ $employee->attached_cv }}
                                        </a>
                                    @endif
                                </div>
                            </div> --}}




                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Certification/Qualification">Certification/Qualification</label>
                                    <input type="file" id="myfile" name="certification"
                                        value="{{ $employee->certification }}">
                                    <a href="{{ asset('upload/' . $employee->certification) }}"
                                        target="_blank">{{ $employee->certification }}</a>
                                </div>
                            </div>

                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Certification/Qualification">Certification/Qualification</label>
                                    <input type="file" id="myfile" name="certification">
                                    @if ($employee->certification)
                                        <a href="{{ asset('upload/' . $employee->certification) }}"
                                            target="_blank">{{ $employee->certification }}</a>
                                    @endif
                                </div>
                            </div> --}}

                            <!-- <div class="col-lg-6">
                                                            <div class="group-input">
                                                                <label for="Additional Medical Document">Medical Checkup Report?</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="group-input">
                                                                <label for="Attached Medical Document">Medical Checkup Report?</label>
                                                                @if ($employee->has_additional_document === 'Yes')
    <input type="file" id="myfile" name="additional_document" value="{{ $employee->certification }}">
    @endif
                                                            
                                                                    <p><a href="{{ asset('uploads/medical_docs/' . $employee->additional_document) }}" target="_blank">Download Document</a></p>
                                                               
                                                            </div>
                                                        </div> -->

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Additional Medical Document">Medical Checkup Report?</label>
                                    <select name="has_additional_document" id="has_additional_document">
                                        <option value="">--Select--</option>
                                        <option value="No"
                                            {{ $employee->has_additional_document == 'No' ? 'selected' : '' }}>No
                                        </option>
                                        <option value="Yes"
                                            {{ $employee->has_additional_document == 'Yes' ? 'selected' : '' }}>Yes
                                        </option>
                                    </select>
                                </div>
                            </div>

                            @if ($employee->has_additional_document == 'Yes')
                                <div class="col-lg-6" id="medical_attachment">
                                    <div class="group-input">
                                        <label for="Attached Medical Document">Medical Checkup Attachment</label>
                                        <input type="file" name="additional_document" id="additional_document">
                                        @if ($employee->additional_document)
                                            <a href="{{ asset('storage/' . $employee->additional_document) }}"
                                                target="_blank">{{ $employee->additional_document }}</a>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $employee->email }}" readonly>
                                </div>
                            </div>




                            <div class="pt-2 col-12 sub-head">
                                Employee Address Details
                            </div>
                            {{-- <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Zone">Zone</label>
                            <select name="zone">
                                <option value="">Enter Your Selection Here</option>
                                <option value="Asia" @if ($employee->zone == 'Asia') selected @endif>Asia</option>
                                <option value="Europe" @if ($employee->zone == 'Europe') selected @endif>Europe</option>
                                <option value="Africa" @if ($employee->zone == 'Africa') selected @endif>Africa</option>
                                <option value="Central America" @if ($employee->zone == 'Central America') selected @endif>Central America</option>
                                <option value="South America" @if ($employee->zone == 'South America') selected @endif>South America</option>
                                <option value="Oceania" @if ($employee->zone == 'Oceania') selected @endif>Oceania</option>
                                <option value="North America" @if ($employee->zone == 'North America') selected @endif>North America</option>
                            </select>
                        </div>
                    </div> --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Country">Country</label>
                                    <select name="country" class="form-select country"
                                        aria-label="Default select example" disabled>
                                        <option value="India" data-code="IN">India</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="City">State</label>
                                    <select name="state" class="form-select state" aria-label="Default select example"
                                        onchange="loadCities()">
                                        <option value="{{ $employee->state }}" selected>{{ $employee->state }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="State/District">City</label>
                                    <select name="city" class="form-select city" aria-label="Default select example">
                                        <option value="{{ $employee->city }}" selected>{{ $employee->city }}</option>
                                        <!-- Pre-selected city -->
                                    </select>
                                </div>
                            </div>

                            <script>
                                var config = {
                                    cUrl: 'https://api.countrystatecity.in/v1',
                                    ckey: 'NHhvOEcyWk50N2Vna3VFTE00bFp3MjFKR0ZEOUhkZlg4RTk1MlJlaA==' // Replace with actual key
                                };

                                var countrySelect = document.querySelector('.country'),
                                    stateSelect = document.querySelector('.state'),
                                    citySelect = document.querySelector('.city');

                                // Store the selected state and city from employee data
                                var selectedState = "{{ $employee->state }}";
                                var selectedCity = "{{ $employee->city }}";

                                function loadStates() {
                                    stateSelect.disabled = false;
                                    stateSelect.innerHTML = '<option value="">Select State</option>';

                                    const selectedCountryCode = 'IN'; // Fixed country code for India

                                    $.ajax({
                                        url: `${config.cUrl}/countries/${selectedCountryCode}/states`,
                                        headers: {
                                            "X-CSCAPI-KEY": config.ckey
                                        },
                                        success: function(data) {
                                            data.forEach(state => {
                                                const option = document.createElement('option');
                                                option.value = state.name;
                                                option.textContent = state.name;
                                                option.dataset.code = state.iso2;
                                                stateSelect.appendChild(option);

                                                // Preselect state if it matches the employee's state
                                                if (state.name === selectedState) {
                                                    option.selected = true;
                                                    loadCities(); // Load cities if state is already selected
                                                }
                                            });
                                        },
                                        error: function(xhr, status, error) {
                                            console.error('Error loading states:', error);
                                        }
                                    });
                                }

                                function loadCities() {
                                    citySelect.disabled = false;
                                    citySelect.innerHTML = '<option value="">Select City</option>';

                                    const selectedCountryCode = 'IN'; // Fixed country code for India
                                    const selectedStateCode = stateSelect.options[stateSelect.selectedIndex].dataset.code;

                                    $.ajax({
                                        url: `${config.cUrl}/countries/${selectedCountryCode}/states/${selectedStateCode}/cities`,
                                        headers: {
                                            "X-CSCAPI-KEY": config.ckey
                                        },
                                        success: function(data) {
                                            data.forEach(city => {
                                                const option = document.createElement('option');
                                                option.value = city.name;
                                                option.textContent = city.name;
                                                citySelect.appendChild(option);

                                                // Preselect city if it matches the employee's city
                                                if (city.name === selectedCity) {
                                                    option.selected = true;
                                                }
                                            });
                                        },
                                        error: function(xhr, status, error) {
                                            console.error('Error loading cities:', error);
                                        }
                                    });
                                }

                                $(document).ready(function() {
                                    loadStates(); // Load states on page load
                                    stateSelect.addEventListener('change', loadCities); // Load cities when state changes
                                });
                            </script>



                            <!-- <div class="col-lg-6">
                                                            <div class="group-input">
                                                                <label for="Site Name">Site Name</label>
                                                                <select name="site_name">
                                                                    <option value="">Enter Your Selection Here</option>
                                                                    <option value="Corporate" @if ($employee->site_name == 'Corporate') selected @endif>Corporate</option>
                                                                    <option value="Plant" @if ($employee->site_name == 'Plant') selected @endif>Plant</option>
                                                                 
                                                                </select>
                                                            </div>
                                                        </div> -->

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <div class="group-input">
                                        <label for="Building">Building</label>
                                        <input type="text" name="building" value="{{ $employee->building }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Floor">Floor</label>
                                    <input type="text" name="floor" value="{{ $employee->floor }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Room">Room</label>
                                    <input type="text" name="room" value="{{ $employee->room }}">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="Picture">Picture</label>
                                    <input type="file" id="myfile" name="picture"
                                        value="{{ $employee->picture }}">
                                    <a href="{{ asset('upload/' . $employee->picture) }}"
                                        target="_blank">{{ $employee->picture }}</a>
                                </div>
                            </div>

                            {{-- <div class="col-6">
                                <div class="group-input">
                                    <label for="Picture">Picture</label>
                                    <input type="file" id="myfile" name="picture">
                                    @if ($employee->external_attachment)
                                        <a href="{{ asset('upload/' . $employee->external_attachment) }}"
                                            target="_blank">{{ $employee->external_attachment }}</a>
                                    @endif
                                </div>
                            </div> --}}

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="Picture">Specimen Signature </label>
                                    <input type="file" id="myfile" name="specimen_signature"
                                        value="{{ $employee->specimen_signature }}">
                                    <a href="{{ asset('upload/' . $employee->specimen_signature) }}"
                                        target="_blank">{{ $employee->specimen_signature }}</a>
                                </div>
                            </div>

                            {{-- <div class="col-6">
                                <div class="group-input">
                                    <label for="Picture">Speciman Signature </label>
                                    <input type="file" id="myfile" name="specimen_signature">
                                    @if ($employee->specimen_signature)
                                        <a href="{{ asset('upload/' . $employee->specimen_signature) }}"
                                            target="_blank">{{ $employee->specimen_signature }}</a>
                                    @endif
                                </div>
                            </div> --}}

                            {{-- <div class="col-6">
                        <div class="group-input">
                            <label for="Facility Name">HOD </label>
                            <select multiple name="hod[]" placeholder="Select HOD" data-search="false" data-silent-initial-value-set="true" id="hod">
                                @foreach ($userDetails as $userRole)
                                <option value="{{ $userRole->id }}" @if ($userRole->id == $employee->hod) selected @endif>{{ $userRole->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div> --}}

                            {{-- <option value="{{ $userRole->id }}" {{ strpos($employee->designee, $userRole->id) !== false ? 'selected' : '' }}>{{ $userRole->name }}</option> --}}

                            {{-- <div class="col-6">
                        <div class="group-input">
                            <label for="Facility Name">Designee </label>
                            <select multiple name="designee[]" placeholder="Select Designee Name" data-search="false" data-silent-initial-value-set="true" id="designee">
                                <option value="QA Head" {{ strpos($employee->designee, 'QA Head') !== false ? 'selected' : '' }}>QA Head</option>
                                <option value="QC Head" {{ strpos($employee->designee, "QC Head") !== false ? 'selected' : '' }}>QC Head</option>

                            </select>
                        </div>
                    </div> --}}

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Comments">Comments</label>
                                    <textarea name="comment">{{ $employee->comment }}</textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="File Attachment">File Attachment</label>
                                    <input type="file" id="myfile" name="file_attachment"
                                        value="{{ $employee->file_attachment }}">
                                    <a href="{{ asset('upload/' . $employee->file_attachment) }}"
                                        target="_blank">{{ $employee->file_attachment }}</a>
                                </div>
                            </div>

                            {{-- <div class="col-12">
                                <div class="group-input">
                                    <label for="File Attachment">File Attachment</label>
                                    <input type="file" id="myfile" name="file_attachment">
                                    @if ($employee->file_attachment)
                                        <a href="{{ asset('upload/' . $employee->file_attachment) }}"
                                            target="_blank">{{ $employee->file_attachment }}</a>
                                    @endif
                                </div>
                            </div> --}}

                            {{-- <div class="col-12 sub-head">
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
                                        <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][job]" value="{{ array_key_exists('job', $employee_grid) ? $employee_grid['job'] : '' }}"></td>
                                        <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][remarks]" value="{{ array_key_exists('remarks', $employee_grid) ? $employee_grid['remarks'] : '' }}"></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td><input disabled type="text" name="jobResponsibilities[0][serial]" value="1"></td>
                                        <td><input type="text" name="jobResponsibilities[0][job]"></td>
                                        <td><input type="text" name="jobResponsibilities[0][remarks]"></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div> --}}

                        </div>

                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton01" class="saveButton">Save</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        </div>

                    </div>
                </div>
            </div>

            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Activated On">Remark</label>
                                <textarea name="induction_comment">{{ $employee->induction_comment }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="External Attachment">Attachment</label>
                                <input type="file" id="myfile" name="induction_attachment"
                                    value="{{ $employee->induction_attachment }}">
                                <a href="{{ asset('upload/' . $employee->induction_attachment) }}"
                                    target="_blank">{{ $employee->induction_attachment }}</a>
                            </div>
                        </div>

                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                        <!-- <button type="button" class="backButton" onclick="previousStep()">Back</button> -->
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                 
                    </div>
                </div>
            </div>


            <!-- Activity Log content -->
            <div id="CCForm3" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Activated By">Activate By</label>
                                <div class="static">{{ $employee->activated_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Activated On">Activate On</label>
                                <div class="static">
                                    {{ $employee->activated_on }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Activated On">Activate Comment</label>
                                <div class="static">
                                    {{ $employee->activated_comment }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for=" Rejected By">Send induction-Training By</label>
                                <div class="static">{{ $employee->retired_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Rejected On">Send induction-Training On</label>
                                <div class="static">{{ $employee->retired_on }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Rejected On">Send induction-Training Comment</label>
                                <div class="static">{{ $employee->retired_comment }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Rejected On">Complete By</label>
                                <div class="static">{{ $employee->complete_by }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Rejected On">Complete On</label>
                                <div class="static">{{ $employee->complete_on }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Rejected On">Complete Comment</label>
                                <div class="static">{{ $employee->complete_comment }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton"> <a href="{{ url('TMS') }}" class="text-white">
                                Save </a></button>
                        <!-- <a href="/rcms/qms-dashboard"> -->
                        {{-- <button type="button" class="backButton">Back</button> --}}
                        </a>
                        {{-- <button type="submit">Submit</button> --}}
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                                Exit </a> </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>



    {{-- Child   --}}
    <div class="modal fade" id="child-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <div class="model-body">

                    <form action="{{ route('employee.child', $employee->id) }}" method="POST">
                        @csrf
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="group-input">
                                <label style="display: flex;" for="major">
                                    <input type="radio" name="child_type" id="major" value="induction_training">
                                    Induction Training
                                </label>


                                {{-- <label style="display: flex;" for="major">
                                <input type="radio" name="child_type" id="major" value="variation">
                                Read and Understand
                            </label>

                            <label for="major">
                                <input type="radio" name="child_type" id="major" value="renewal">
                                Classroom
                            </label>
                            <label for="major">
                                <input type="radio" name="child_type" id="major" value="correspondence">
                                Correspondence
                            </label>
                            <label for="major">
                                <input type="radio" name="child_type" id="major" value="osur">
                                PSUR
                            </label> --}}

                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit">Submit</button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>




    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('tms/employee/sendstage', $employee->id) }}" method="POST"
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

    <script>


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

        const saveButtons = document.querySelectorAll('.saveButton1');
        const form = document.getElementById('step-form');
    </script>
    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#reference_record, #designee, #hod'
        });
    </script>
@endsection
