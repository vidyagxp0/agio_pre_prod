@extends('frontend.layout.main')
@section('container')
@php
$users = DB::table('users')->select('id', 'name')->get();
$divisions = DB::table('q_m_s_divisions')->select('id', 'name')->get();
$departments = DB::table('departments')->select('id', 'name')->get();

@endphp
<style>
    textarea.note-codable {
        display: none !important;
    }

    header {
        display: none;
    }
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function() {
        $("#datepicker").datepicker();
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
    function addAuditAgenda(tableId) {
        var table = document.getElementById(tableId);
        var currentRowCount = table.rows.length;
        var newRow = table.insertRow(currentRowCount);
        newRow.setAttribute("id", "row" + currentRowCount);
        var cell1 = newRow.insertCell(0);
        cell1.innerHTML = currentRowCount;

        var cell2 = newRow.insertCell(1);
        cell2.innerHTML = "<input type='text'>";

        var cell3 = newRow.insertCell(2);
        cell3.innerHTML = "<input type='date'>";

        var cell4 = newRow.insertCell(3);
        cell4.innerHTML = "<input type='time'>";

        var cell5 = newRow.insertCell(4);
        cell5.innerHTML = "<input type='date'>";

        var cell6 = newRow.insertCell(5);
        cell6.innerHTML = "<input type='time'>";

        var cell7 = newRow.insertCell(6);
        cell7.innerHTML =
            // '<select name="auditor"><option value="">-- Select --</option><option value="1">Amit Guru</option></select>'

            var cell8 = newRow.insertCell(7);
        cell8.innerHTML =
            // '<select name="auditee"><option value="">-- Select --</option><option value="1">Amit Guru</option></select>'

            var cell9 = newRow.insertCell(8);
        cell9.innerHTML = "<input type='text'>";
        for (var i = 1; i < currentRowCount; i++) {
            var row = table.rows[i];
            row.cells[0].innerHTML = i;
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#internalaudit-table').click(function(e) {

            function generateTableRow(serialNumber) {
                var users = @json($users);

                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="audit[]"></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="scheduled_start_date' +
                    serialNumber +
                    '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="scheduled_start_date[]" id="scheduled_start_date' +
                    serialNumber +
                    '_checkdate" min="{{ \Carbon\Carbon::now()->format('
                Y - m - d ') }}"  class="hide-input" oninput="handleDateInput(this, scheduled_start_date' +
                    serialNumber + ');checkDate(scheduled_start_date' + serialNumber +
                    '_checkdate,scheduled_end_date' + serialNumber +
                    '_checkdate)" /></div></div></div></td>' +
                    '<td><input type="time" name="scheduled_start_time[]"></td>' +
                    '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="scheduled_end_date' +
                    serialNumber +
                    '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="scheduled_end_date[]" id="scheduled_end_date' +
                    serialNumber +
                    '_checkdate"  min="{{ \Carbon\Carbon::now()->format('
                Y - m - d ') }}"class="hide-input" oninput="handleDateInput(this, scheduled_end_date' +
                    serialNumber + ');checkDate(scheduled_start_date' + serialNumber +
                    '_checkdate,scheduled_end_date' + serialNumber +
                    '_checkdate)" /></div></div></div></td>' +
                    '<td><input type="time" name="scheduled_end_time[]"></td>' +
                    '<td><select name="auditor[]">' +
                    '<option value="">Select a value</option>';

                for (var i = 0; i < users.length; i++) {
                    html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                }

                html += '</select></td>' +
                    '<td><select name="auditee[]">' +
                    '<option value="">Select a value</option>';

                for (var i = 0; i < users.length; i++) {
                    html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                }
                html += '</select></td>' +
                    '<td><input type="text" name="remarks[]"></td>' +
                    '</tr>';

                return html;
            }

            var tableBody = $('#internalaudit tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#attachmentgrid-table').click(function(e) {

            function generateTableRow(serialNumber) {
                var users = @json($users);

                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="trainer_listOfAttachment[' + serialNumber +
                    '][serial_number]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="trainer_listOfAttachment[' + serialNumber +
                    '][title_of document]"></td>' +
                    '<td><input type="text" name="trainer_listOfAttachment[' + serialNumber +
                    '][supporting_document]"></td>' +
                    '<td><input type="text" name="trainer_listOfAttachment[' + serialNumber +
                    '][remarks]"></td>' +
                    '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                    '</tr>';

                // for (var i = 0; i < users.length; i++) {
                //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                // }


                '</tr>';

                return html;
            }

            var tableBody = $('#attachmentgrid tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#Trainer_Skill_table').click(function(e) {

            function generateTableRow(serialNumber) {
                var users = @json($users);

                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="trainer_skill[' + serialNumber +
                    '][serial_number]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="trainer_skill[' + serialNumber +
                    '][Trainer_skill_set]"></td>' +

                    '<td><input type="text" name="trainer_skill[' + serialNumber +
                    '][remarks]"></td>' +
                    '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                    '</tr>';

                // for (var i = 0; i < users.length; i++) {
                //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                // }


                '</tr>';

                return html;
            }

            var tableBody = $('#Trainer_Skill_table_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>



<script>
    $(document).ready(function() {
        $('#ObservationAdd').click(function(e) {
            function generateTableRow(serialNumber) {
                var users = @json($users);

                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                    '"></td>' +
                    '<td><input type="text" name="observation_id[]"></td>' +

                    +'<option value="">Select a value</option>';


                html += '</select></td>' +

                    '<td><input type="text" name="observation_description[]"></td>' +
                    '<td><input type="text" name="area[]"></td>' +
                    '<td><input type="text" name="auditee_response[]"></td>'

                '<option value="">Select a value</option>';

                for (var i = 0; i < users.length; i++) {
                    html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                }

                html += '</select></td>' +
                    '<td><button type="text" class="removeRowBtn">Remove</button></td>' +

                    '</tr>';

                return html;
            }

            var tableBody = $('#onservation-field-table tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });

        // $(document).on('click', '.removeRowBtn', function() {
        //     $(this).closest('tr').remove();
        // });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.removeRowBtn').on('click', function() {
            $(this).closest('tr').remove();
        });
    });
</script>

<style>
    .calenderauditee {
        position: relative;
    }

    .new-date-data-field input.hide-input {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .new-date-data-field input {
        border: 1px solid grey;
        border-radius: 5px;
        padding: 5px 15px;
        display: block;
        width: 100%;
        background: white;
    }

    .calenderauditee input::-webkit-calendar-picker-indicator {
        width: 100%;
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

    #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(6) {
        border-radius: 0px 20px 20px 0px;

    }
</style>
<div class="form-field-head">

    <div class="division-bar">
        <strong>Trainer Qualification</strong>
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
                    $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $trainer->division_id])->get();
                    $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                    @endphp

                    <button class="button_theme1">
                        <a class="text-white" href="{{ route('trainer.audittrail', $trainer->id) }}"> Audit Trail
                        </a>
                    </button>

                    @if ($trainer->stage == 1)
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        Submit
                    </button>
                    @elseif($trainer->stage == 2)

                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        Update Complete
                    </button>
                    {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                        Reject
                    </button> --}}
                    @elseif($trainer->stage == 3)
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Answer Complete
                    </button>
                    @elseif($trainer->stage == 4)
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Evaluation Complete
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                        Reject
                    </button>
                    @elseif($trainer->stage == 5)
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Qualified
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                        Reject
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
                @if ($trainer->stage == 0)
                <div class="progress-bars ">
                    <div class="bg-danger">Closed-Cancelled</div>
                </div>
                @else
                <div class="progress-bars d-flex">
                    @if ($trainer->stage >= 1)
                    <div class="active">Opened</div>
                    @else
                    <div class="">Opened</div>
                    @endif

                    @if ($trainer->stage >= 2)
                    <div class="active">Pending Trainer Update</div>
                    @else
                    <div class="">Pending Trainer Update</div>
                    @endif

                    @if ($trainer->stage >= 3)
                    <div class="active">Trainee Answer</div>
                    @else
                    <div class="">Trainee Answer</div>
                    @endif

                    @if ($trainer->stage >= 4)
                    <div class="active">HOD Evaluation</div>
                    @else
                    <div class="">HOD Evaluation</div>
                    @endif
                    @if ($trainer->stage >= 5)
                    <div class="active">QA/CQA Head Approval</div>
                    @else
                    <div class="">QA/CQA Head Approval</div>
                    @endif

                    @if ($trainer->stage >= 6)
                    <div class="bg-danger">Closed - Done</div>
                    @else
                    <div class="">Closed - Done</div>
                    @endif
                    @endif


                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
        </div>

        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Questionaries</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">HOD Evaluation</button>

            <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA/CQA Head Approval</button>
            @if ($trainer->stage >= 5 && $trainer->trainer == "Qualified")
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Certificate</button>
            @endif
            <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Certificate</button> -->

            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>
        </div>
        <script>
            $(document).ready(function() {
                <?php if ($trainer->stage == 6) : ?>
                    $("#target :input").prop("disabled", true);
                <?php endif; ?>
            });
        </script>
        
        <form id="target" action="{{ route('trainer.update', $trainer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="step-form">

                <!-- General information content -->
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            @if (!empty($parent_id))
                            <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                            <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                            @endif

                            <div class="sub-head">
                Trainer Information
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="trainer">Trainer Name</label>
                    <input id="trainer_name" type="text" name="trainer_name" maxlength="255" value="{{ $trainer->trainer_name }}">
                </div>
            </div>


            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number">Name of Employee</label>
                                    <input  type="text" name="name_employee_display" id="name_employee_display" maxlength="255" value="{{ $trainer->employee_name }}">
                                    <input type="hidden" name="employee_name" value="{{ $trainer->employee_name }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number">Employee ID </label>
                                    <input disabled type="text" name="employee_id_display" value="{{ $trainer->employee_id }}">
                                    <input type="hidden" name="employee_id" value="{{ $trainer->employee_id }}">
                                </div>
                            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Department">Department</label>
                    <select name="department">
                        <option>-- Select --</option>
                        {{-- @foreach ($departments as $department)
                                <option value="{{ $department->id }}" @if ($department->id == $trainer->department) selected @endif>{{ $department->name }}</option>
                        @endforeach --}}



                        @php
                        $savedDepartmentId = old('department', $trainer->department);
                        @endphp

                        @foreach (Helpers::getDepartments() as $code => $department)
                        <option value="{{ $code }}" @if ($savedDepartmentId==$code) selected @endif>{{ $department }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- <div class="col-lg-6">
                <div class="group-input">
                    <label for="Designation">Designation</label>
                    <select name="designation" id="designation">
                        <option>Select</option>
                        <option value="lead_trainer" @if ($trainer->designation == "lead_trainer") selected @endif>Lead Trainer</option>
                        <option value="senior_trainer" @if ($trainer->designation == "senior_trainer") selected @endif>Senior Trainer</option>
                        <option value="Instructor" @if ($trainer->designation == "Instructor") selected @endif>Instructor</option>
                        <option value="Evaluator" @if ($trainer->designation == "Evaluator") selected @endif>Evaluator</option>
                    </select>
                </div>
            </div> -->

            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Job Title">Designation<span class="text-danger">*</span></label>
                                    <select name="designation" id="job_title" required onchange="checkDesignation()" readonly>
                                        <option value="">----Select---</option>
                                        <option value="Trainee" {{ $trainer->designation == 'Trainee' ? 'selected' : '' }}>Trainee</option>
                                        <option value="Officer" {{ $trainer->designation == 'Officer' ? 'selected' : '' }}>Officer</option>
                                        <option value="Sr. Officer" {{ $trainer->designation == 'Sr. Officer' ? 'selected' : '' }}>Sr. Officer</option>
                                        <option value="Executive" {{ $trainer->designation == 'Executive' ? 'selected' : '' }}>Executive</option>
                                        <option value="Sr.executive" {{ $trainer->designation == 'Sr.executive' ? 'selected' : '' }}>Sr. Executive</option>
                                        <option value="Asst. manager" {{ $trainer->designation == 'Asst. manager' ? 'selected' : '' }}>Asst. Manager</option>
                                        <option value="Manager" {{ $trainer->designation == 'Manager' ? 'selected' : '' }}>Manager</option>
                                        <option value="Sr. manager" {{ $trainer->designation == 'Sr. manager' ? 'selected' : '' }}>Sr. Manager</option>
                                        <option value="Deputy GM" {{ $trainer->designation == 'Deputy GM' ? 'selected' : '' }}>Deputy GM</option>
                                        <option value="AGM and GM" {{ $trainer->designation == 'AGM and GM' ? 'selected' : '' }}>AGM and GM</option>
                                        <option value="Head quality" {{ $trainer->designation == 'Head quality' ? 'selected' : '' }}>Head quality</option>
                                        <option value="VP quality" {{ $trainer->designation == 'VP quality' ? 'selected' : '' }}>VP quality</option>
                                        <option value="Plant head" {{ $trainer->designation == 'Plant head' ? 'selected' : '' }}>Plant head</option>
                                    </select>
                                </div>
                            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Experience">Experience (No. of Years)</label>
                    <select name="experience" id="experience">
                        <option>Select </option>
                        @for ($experience = 1; $experience <= 70; $experience++) <option value="{{ $experience }}" @if ($experience==$trainer->experience) selected @endif>{{ $experience }}</option>
                            @endfor
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="HOD Persons">HOD</label>
                    <input id="" type="text" name="hod" maxlength="255" value="{{ $trainer->hod }}">

                    <!-- <select name="hod" id="hod">
                        <option value="">-- Select HOD --</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == old('hod', $trainer->hod) ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                        @endforeach
                    </select> -->
                </div>
            </div>

            <div class="col-6">
                <div class="group-input">
                    <label for="qualification">Qualification</label>
                    <input id="qualification" type="text" name="qualification" maxlength="255" value="{{ $trainer->qualification }}">
                </div>
            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="training_date">Training Date</label>
                                    <input type="date" id="training_date" name="training_date" value="{{$trainer->training_date}}">
                                </div>
                            </div>

                            <!-- Topic of Training -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="topic">Topic of Training</label>
                                    <input type="text" id="" name="topic" value="{{$trainer->topic}}">
                                </div>
                            </div>

                            <!-- Type of Training -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="type">Type of Training</label>
                                    <select name="type" id="type" >
                                        <option value="">--Select--</option>
                                        <option value="technical" @if ($trainer->type == "technical") selected @endif>Technical</option>
                                        <option value="non-technical" @if ($trainer->type == "non-technical") selected @endif>Non-Technical</option>
                                        <option value="safety" @if ($trainer->type == "technical") selected @endif>Safety</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Evaluation Required -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="evaluation">Evaluation Required</label>
                                    <select name="evaluation">
                                    <option value="">--Select--</option>
                                    <option value="yes" @if ($trainer->evaluation == "yes") selected @endif>Yes</option>
                                    <option value="no" @if ($trainer->evaluation == "no") selected @endif>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="site_name">Site Division/Project <span class="text-danger">*</span></label>
                                    <!-- <input type="text" id="site_code" name="site_code" value="{{$trainer->site_code}}" required> -->
                                    <select name="site_code">
                                        <option value="">Enter Your Selection Here</option>
                                        <option value="Corporate" @if($trainer->site_code=="Corporate" ) selected @endif>Corporate</option>
                                        <option value="Plant" @if($trainer->site_code=="Plant" ) selected @endif>Plant</option>
                                    
                                    </select>
                                </div>
                            </div>


                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Site Division/Project">Site Division/Project</label>
                                    <input value="{{ $trainer->site_code }}" name="site_code" readonly >
                            <select name="division_id">
                                <option>-- Select --</option>
                                @foreach ($divisions as $division)
                                <option value="{{ $division->id }}" @if ($division->id == $trainer->division_id) selected @endif >{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code </b></label>
                                        <input readonly type="text" name="site_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                    <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                </div>
            </div> --}}

            {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Site/Location Code</b></label>
                                        <input disabled type="text" name="site_code" value="PLANT">
                                        <input type="hidden" name="site_code" value="PLANT">

                                    </div>
                                </div> --}}
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator"><b>Initiator</b></label>
                    <input disabled type="text" name="initiator" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="initiator" value="{{ Auth::user()->name }}">

                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Date Due"><b>Date of Initiation</b></label>
                    <input disabled type="text" value="{{ date('d-M-Y', strtotime($trainer->date_of_initiation)) }}" name="date_of_initiation">
                    <input type="hidden" value="{{ date('d-M-Y', strtotime($trainer->date_of_initiation)) }}" name="date_of_initiation">
                </div>
            </div>
            <div class="col-md-6">
                <div class="group-input">
                    <label for="search">
                        Assigned To <span class="text-danger"></span>
                    </label>
                    <select id="select-state" placeholder="Select..." name="assigned_to">
                        <option value="">Select</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if ($user->id == $trainer->assigned_to) selected @endif>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('assign_to')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>


            {{-- <div class="col-lg-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="Date Due">Due Date</label>
                    <div class="calenderauditee">

                        <input type="hidden" value="{{$due_date}}" name="due_date">
                        <input disabled type="text" value="{{Helpers::getdateFormat($due_date)}}">
                    </div>
                </div>
            </div> --}}


            <div class="col-12">
                <div class="group-input">
                    <label for="Short Description">Short Description</label><span id="rchars">255</span>
                    characters remaining
                    <input id="short_description" type="text" name="short_description" maxlength="255" value="{{ $trainer->short_description }}">
                </div>
            </div>

            <div class="">
                {{-- <div class="group-input">
                    <label for="audit-agenda-grid">
                        Trainer Skill Set<button type="button" name="audit-agenda-grid" id="Trainer_Skill_table">+</button>
                    </label>
                    <table class="table table-bordered" id="Trainer_Skill_table_details">
                        <thead>
                            <tr>
                                <th style="width: 5%;">Sr. No.</th>
                                <th>Trainer Skill Set</th>

                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($trainer_skill && is_array($trainer_skill->data))
                            @foreach ($trainer_skill->data as $index => $skill)
                            <tr>
                                <td><input disabled type="text" name="trainer_skill[{{ $loop->index }}][serial_number]" value="{{ $loop->index+1 }}">
                                </td>
                                <td><input type="text" name="trainer_skill[{{ $loop->index }}][Trainer_skill_set]" value=" {{ array_key_exists('Trainer_skill_set', $skill) ? $skill['Trainer_skill_set'] : '' }}"></td>
                                <td><input type="text" name="trainer_skill[{{ $loop->index }}][remarks]" value=" {{ array_key_exists('remarks', $skill) ? $skill['remarks'] : '' }}"></td>
                                <td>
                                    <button type="button" onclick="removeRow(this)">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td><input disabled type="text" name="trainer_skill[0][serial_number]" value="1">
                                </td>
                                <td><input type="text" name="trainer_skill[0][Trainer_skill_set]"></td>
                                <td><input type="text" name="trainer_skill[0][remarks]"></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div> --}}

                <script>
                    function removeRow(button) {
                        var row = button.closest('tr');
                        row.parentNode.removeChild(row);
                    }
                </script>

                <div class="group-input">
                    <label for="audit-agenda-grid">
                        List of Attachments<button type="button" name="audit-agenda-grid" id="attachmentgrid-table">+</button>
                    </label>
                    <table class="table table-bordered" id="attachmentgrid">
                        <thead>
                            <tr>
                                <th style="width: 5%;">Sr. No.</th>
                                <th>Title of Document</th>
                                <th>Supporting Document</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($trainer_list && is_array($trainer_list->data))
                            @foreach ($trainer_list->data as $index => $list)
                            <tr>
                                <td><input disabled type="text" name="trainer_listOfAttachment[{{ $loop->index }}][serial_number]" value="{{ $loop->index+1 }}">
                                </td>
                                <td><input type="text" name="trainer_listOfAttachment[{{ $loop->index }}][title_of document]" value=" {{ array_key_exists('title_of document', $list) ? $list['title_of document'] : '' }}"></td>
                                <td><input type="text" name="trainer_listOfAttachment[{{ $loop->index }}][supporting_document]" value=" {{ array_key_exists('supporting_document', $list) ? $list['supporting_document'] : '' }}"></td>
                                <td><input type="text" name="trainer_listOfAttachment[{{ $loop->index }}][remarks]" value=" {{ array_key_exists('remarks', $list) ? $list['remarks'] : '' }}"></td>
                                <td><button type="button" class="removeRowBtn">Remove</button></td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td><input disabled type="text" name="trainer_listOfAttachment[0][serial_number]" value="1">
                                </td>
                                <td><input type="text" name="trainer_listOfAttachment[0][title_of document]"></td>
                                <td><input type="text" name="trainer_listOfAttachment[0][supporting_document]"></td>
                                <td><input type="text" name="trainer_listOfAttachment[0][remarks]"></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="">
                <div class="group-input">
                    <label for="trainingQualificationStatus">Qualification Status</label>
                    <select name="trainer" id="trainingQualificationStatus">
                        <option>-- Select --</option>
                        <option value="Qualified" @if ($trainer->trainer == "Qualified") selected @endif>Qualified</option>
                        <option value="Not Qualified" @if ($trainer->trainer == "Not Qualified") selected @endif>Not Qualified</option>
                    </select>
                </div>
            </div>

            <div class="sub-head">Evaluation Criteria</div>

            <div class="col-12">
                <div class="group-input">
                    <div class="why-why-chart">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 7%;">Sr. No.</th>
                                    <th style="width: 50%;">Evaluation Criteria</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Clarity Of Objectives</td>
                                    <td>
                                        <select name="evaluation_criteria_1" id="">
                                            <option> -- Select --</option>
                                            <option value="1" @if ($trainer->evaluation_criteria_1 == "1") selected @endif> 1</option>
                                            <option value="2" @if ($trainer->evaluation_criteria_1 == "2") selected @endif> 2</option>
                                            <option value="3" @if ($trainer->evaluation_criteria_1 == "3") selected @endif> 3</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Delivery & Knowledge Of Content</td>
                                    <td>
                                        <select name="evaluation_criteria_2" id="">
                                            <option> -- Select --</option>
                                            <option value="1" @if ($trainer->evaluation_criteria_2 == "1") selected @endif> 1</option>
                                            <option value="2" @if ($trainer->evaluation_criteria_2 == "2") selected @endif> 2</option>
                                            <option value="3" @if ($trainer->evaluation_criteria_2 == "3") selected @endif> 3</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Oral & Written Languagee (Speaking
                                        Style Was Clear, Easily understood , Pleasant to hear)</td>
                                    <td>
                                        <select name="evaluation_criteria_3" id="">
                                            <option> -- Select --</option>
                                            <option value="1" @if ($trainer->evaluation_criteria_3 == "1") selected @endif> 1</option>
                                            <option value="2" @if ($trainer->evaluation_criteria_3 == "2") selected @endif> 2</option>
                                            <option value="3" @if ($trainer->evaluation_criteria_3 == "3") selected @endif> 3</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Is Research Up to Date?</td>
                                    <td>
                                        <select name="evaluation_criteria_4" id="">
                                            <option> -- Select --</option>
                                            <option value="1" @if ($trainer->evaluation_criteria_4 == "1") selected @endif> 1</option>
                                            <option value="2" @if ($trainer->evaluation_criteria_4 == "2") selected @endif> 2</option>
                                            <option value="3" @if ($trainer->evaluation_criteria_4 == "3") selected @endif> 3</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Interactions With Participants</td>
                                    <td>
                                        <select name="evaluation_criteria_5" id="">
                                            <option value=""> -- Select --</option>
                                            <option value="1" @if ($trainer->evaluation_criteria_5 == "1") selected @endif> 1</option>
                                            <option value="2" @if ($trainer->evaluation_criteria_5 == "2") selected @endif> 2</option>
                                            <option value="3" @if ($trainer->evaluation_criteria_5 == "3") selected @endif> 3</option>

                                        </select>
                                    </td>


                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Response To Participants</td>
                                    <td>
                                        <select name="evaluation_criteria_6" id="">
                                            <option value=""> -- Select --</option>
                                            <option value="1" @if ($trainer->evaluation_criteria_6 == "1") selected @endif> 1</option>
                                            <option value="2" @if ($trainer->evaluation_criteria_6 == "2") selected @endif> 2</option>
                                            <option value="3" @if ($trainer->evaluation_criteria_6 == "3") selected @endif> 3</option>

                                        </select>
                                    </td>


                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Discussion Techniques</td>
                                    <td>
                                        <select name="evaluation_criteria_7" id="">
                                            <option value=""> -- Select --</option>
                                            <option value="1" @if ($trainer->evaluation_criteria_7 == "1") selected @endif> 1</option>
                                            <option value="2" @if ($trainer->evaluation_criteria_7 == "2") selected @endif> 2</option>
                                            <option value="3" @if ($trainer->evaluation_criteria_7 == "3") selected @endif> 3</option>

                                        </select>
                                    </td>


                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Managed Pace Of The Training Well /
                                        Created a Comfortable learning environment</td>
                                    <td>
                                        <select name="evaluation_criteria_8" id="">
                                            <option value=""> -- Select --</option>
                                            <option value="1" @if ($trainer->evaluation_criteria_8 == "1") selected @endif> 1</option>
                                            <option value="2" @if ($trainer->evaluation_criteria_8 == "2") selected @endif> 2</option>
                                            <option value="3" @if ($trainer->evaluation_criteria_8 == "3") selected @endif> 3</option>

                                        </select>
                                    </td>


                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-md-12 mb-3">
        <div class="group-input">
            <label for="Q_comment">Qualification Comments</label>
            <textarea class="" name="qualification_comments">{{ $trainer->qualification_comments }}</textarea>
        </div>
    </div>

    <div class="col-12">
        <div class="group-input">
            <label for="Inv Attachments">Initial Attachment</label>
            <input type="file" id="myfile" name="initial_attachment" value="{{ $trainer->initial_attachment }}">
            <a href="{{ asset('upload/' . $trainer->initial_attachment) }}" target="_blank">{{ $trainer->initial_attachment }}</a>
        </div>
    </div>
    <script>
        VirtualSelect.init({
            ele: '#reference_record, #notify_to'
        });

        $('#summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        let referenceCount = 1;

        function addReference() {
            referenceCount++;
            let newReference = document.createElement('div');
            newReference.classList.add('row', 'reference-data-' + referenceCount);
            newReference.innerHTML = `
                                        <div class="col-lg-6">
                                            <input type="text" name="reference-text">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="file" name="references" class="myclassname">
                                        </div><div class="col-lg-6">
                                            <input type="file" name="references" class="myclassname">
                                        </div>
                                    `;
            let referenceContainer = document.querySelector('.reference-data');
            referenceContainer.parentNode.insertBefore(newReference, referenceContainer.nextSibling);
        }
    </script>

    <script>
        function removeHtmlTags() {
            var textarea = document.getElementById("summernote-16");
            var cleanValue = textarea.value.replace(/<[^>]*>?/gm, ''); // Remove HTML tags
            textarea.value = cleanValue;
        }
    </script>

    <div class="button-block">
        <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
        <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                Exit </a> </button>
    </div>
</div>
</div>

<div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="col-12 sub-head">
                            Questionaries
                        </div>
                        <div class="pt-2 group-input">
                            <label for="audit-agenda-grid">
                                Questionaries
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
                                            <th>Questions</th>
                                            <th>Answer Fillup by Employee</th>
                                            <th>Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($employee_grid_data && is_array($employee_grid_data->data))
                                            @foreach ($employee_grid_data->data as $index => $employee_grid)
                                            <tr>
                                                <td><input disabled type="text" name="jobResponsibilities[{{ $loop->index }}][serial]" value="{{ $loop->index+1 }}"></td>
                                                <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][job]" value="{{ array_key_exists('job', $employee_grid) ? $employee_grid['job'] : '' }}" class="question-input">
                                                </td>
                                                <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][remarks]" value="{{ array_key_exists('remarks', $employee_grid) ? $employee_grid['remarks'] : '' }}" class="answer-input">
                                                </td>
                                                <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][comments]" value="{{ array_key_exists('comments', $employee_grid) ? $employee_grid['comments'] : '' }}" class="answer-input">
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td><input disabled type="text" name="jobResponsibilities[0][serial]" value="1"></td>
                                                <td><input type="text" name="jobResponsibilities[0][job]" class="question-input" >
                                                </td>
                                                <td><input type="text" name="jobResponsibilities[0][remarks]" class="answer-input">
                                              
                                                </td>
                                                <td><input type="text" name="jobResponsibilities[0][comments]" class="answer-input" >
                                            
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                        </div> 
                        <div class="button-block">
                            <button type="submit" class="saveButton" id="">Save</button>
           
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        </div>
                    </div>
                </div>
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

                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Remarks</label>
                                    <textarea name="hod_comment">{{ $trainer->hod_comment }}</textarea>
                                </div>
                            </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="External Attachment">HOD Evaluation Attachment</label>
                                        <input type="file" id="myfile" name="hod_attachment" value="{{ $trainer->hod_attachment }}">
                                        <a href="{{ asset('upload/' . $trainer->hod_attachment) }}" target="_blank">{{ $trainer->hod_attachment }}</a>
                                    </div>
                                </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                 
                        </div>
                    </div>
                </div>

                <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                        <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Remarks</label>
                                    <textarea name="qa_final_comment">{{ $trainer->qa_final_comment }}</textarea>
                                </div>
                            </div>
                        <div class="col-12">
                                    <div class="group-input">
                                        <label for="External Attachment">QA/CQA Attachment</label>
                                        <input type="file" id="myfile" name="qa_final_attachment" value="{{ $trainer->qa_final_attachment }}">
                                        <a href="{{ asset('upload/' . $trainer->qa_final_attachment) }}" target="_blank">{{ $trainer->qa_final_attachment }}</a>
                                    </div>
                                </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                 
                        </div>
                    </div>
                </div>

                @if ($trainer->stage >= 5)
                <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                <div class="button-block">
                                    <button type="button" class="printButton" onclick="printCertificate()">
                                        <i class="fas fa-print"></i>Print
                                    </button>
                                </div>
                                    <div class="certificate-container">
                                        <div class="certificate-title">TRAINING CERTIFICATE</div>

                                        <div class="certificate-description"><br><br>
                                            This is to certify that Mr./Ms./Mrs. <strong>{{$trainer->employee_name}}</strong>.
                                            has undergone Training Qualification including the requirement of cGMP and has shown a good attitude and thorough understanding in the subject.
                                        </div>

                                        <div class="certificate-description">
                                            Therefore we certify that Mr. Ms. / Mrs. <strong>{{$trainer->name_employee}}</strong>.
                                            is capable of performing his/her assigned duties in the <strong>{{$trainer->department}}</strong> Department independently.
                                        </div>

                                        <div class="date-container">
                                        <div class="signature-block">
                                            <strong>Sign/Date:</strong>_________
                                            <div>HR Head</div>
                                        </div>

                                        <div>
                                            <strong>Sign/Date:</strong>_________
                                            <div class="signature">Head QA/CQA<div></div></div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div style="margin-top: 40px;" class="button-block">
                                    <button type="submit" class=" btn btn saveButton">Save</button>
                                    <button type="button" id="ChangeNextButton" class=" btn btn nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                <style>
           .certificate-container {
            width: 685px;
            height: 500px;
            border: 4px solid #3d6186;
            padding: 18px;
            background-color: white;
            position: relative;
            margin: auto;
            box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
        }
        .certificate-title {
            font-size: 30px;
            font-weight: bold;
            color: #677078;
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
            display: flex;
            justify-content: space-between;
            margin-top: 60px;
            font-size: 18px;
        }
        .signature-container {
            position: absolute;
            bottom: 40px;
            right: 50px;
            text-align: center;
            font-size: 18px;
            color: #333;
        }
       
        @media print {
            .button-block {
                display: none !important; 
            }

            body * {
                visibility: hidden;
            }

            #CCForm4, #CCForm4 * {
                visibility: visible;
            }

            #CCForm4 {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
        .button-block {
            display: flex;
            justify-content: flex-end;
            margin-top: 50px;
        }

        .printButton {
            background-color: #2c3e50;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            float: right; 
        }

        .printButton:hover {
            background-color: #1a252f;
        }

        .printButton i {
            margin-right: 8px; 
        }

        @media print {
    .button-block {
        display: none !important; 
    }

    body * {
        visibility: hidden;
    }

    .certificate-container, .certificate-container * {
        visibility: visible;
    }

    .certificate-container {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
}

            </style>

<script>
                        function printCertificate() {
                        var buttons = document.querySelector(".button-block");
                        buttons.style.display = 'none';
                        window.print();
                        buttons.style.display = 'block';
                    }

                </script>
<!-- Activity Log content -->
<div id="CCForm6" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Submitted On">Submitted By</label>
                    <div class="static">{{ $trainer->sbmitted_by }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Submitted On">Submitted On</label>
                    <div class="static">{{ $trainer->sbmitted_on }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Comment">Comment</label>
                    <div class="static">{{ $trainer->sbmitted_comment }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Qualified By">Qualified By</label>
                    <div class="static">{{ $trainer->qualified_by }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Qualified On">Qualified On</label>
                    <div class="static">{{ $trainer->qualified_on }}</div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Comment">Comment</label>
                    <div class="static">{{ $trainer->qualified_comment }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for=" Rejected By">Rejected By</label>
                    <div class="static">{{ $trainer->rejected_by }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Rejected On">Rejected On</label>
                    <div class="static">{{ $trainer->rejected_on }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Comment">Comment</label>
                    <div class="static">{{ $trainer->rejected_comment }}</div>
                </div>
            </div>
        </div>
        <div class="button-block">
            <button type="submit" class="saveButton">Save</button>
            <a href="/rcms/qms-dashboard">
                <button type="button" class="backButton">Back</button>
            </a>
            <button type="submit">Submit</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                    Exit </a> </button>
        </div>
    </div>
</div>

</div>
</form>

</div>
</div>

<div class="modal fade" id="signature-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ url('tms/trainer/sendstage', $trainer->id) }}" method="POST" id="signatureModalForm">
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
                        <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none" role="status">
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

<div class="modal fade" id="rejection-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ url('tms/trainer/rejectStage', $trainer->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
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
                        <label for="comment">Comment <span class="text-danger">*</span></label>
                        <input type="comment" name="comment" required>
                    </div>
                </div>

                <!-- Modal footer -->
                <!-- <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button>Close</button>
                    </div> -->
                <div class="modal-footer">
                    <button type="submit">Submit</button>
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
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
    document.getElementById('myfile').addEventListener('change', function() {
        var fileListDiv = document.querySelector('.file-list');
        fileListDiv.innerHTML = ''; // Clear previous entries

        for (var i = 0; i < this.files.length; i++) {
            var file = this.files[i];
            var listItem = document.createElement('div');
            listItem.textContent = file.name;
            fileListDiv.appendChild(listItem);
        }
    });
</script>


<script>
    VirtualSelect.init({
        ele: '#Facility, #Group, #Audit, #Auditee ,#reference_record, #trainerSkillSet'
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
</script>
<script>
    var maxLength = 255;
    $('#docname').keyup(function() {
        var textlen = maxLength - $(this).val().length;
        $('#rchars').text(textlen);
    });
</script>
@endsection