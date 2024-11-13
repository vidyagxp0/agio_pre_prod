@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->select('id', 'name')->get();
        $divisions = DB::table('q_m_s_divisions')->select('id', 'name')->get();
        $departments = DB::table('departments')->select('id', 'name')->get();

    @endphp

    <style>
        label.error {
            color: red;
        }
    </style>

    <script>
        $(document).ready(function() {
            let auditForm = $('form#auditform')

            $('#ChangesaveButton').on('click', function(e) {
                console.log('submit test')
                let isValid = auditForm.validate();

                if (!isValid) {
                    e.preventDefault();
                }
            })

        });
    </script>
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

                        '</tr>';

                    return html;
                }

                var tableBody = $('#onservation-field-table tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
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
    <div class="form-field-head">

        <div class="division-bar">
            <strong>New Trainer Qualification</strong>
            {{-- <strong>Site Division/Project</strong> : --}}
            {{-- {{ Helpers::getDivisionName(session()->get('division')) }} Trainer Qualification --}}
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

                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Pending Trainer Update</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Pending Training </button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">HOD Evaluation</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QA/CQA Head Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>
            </div>

            <form id="auditform" action="{{ route('trainer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="step-form">

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
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="trainer">Trainer Name</label>
                                        <input id="trainer_name" type="text" name="trainer_name" maxlength="255">
                                    </div>
                                </div> --}}

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="select-state">Name of Employee</label>
                                        <select id="select-state" placeholder="Select..." name="employee_name" required
                                            {{ isset($employee) ? 'disabled' : '' }}>
                                            <option value="">Select an employee</option>
                                            @foreach ($employees as $emp)
                                                <option value="{{ $emp->id }}" data-name="{{ $emp->employee_name }}"
                                                    data-department="{{ Helpers::getFullDepartmentName($emp->department) ?? 'NA' }}"
                                                    {{ isset($employee) && $employee->id == $emp->id ? 'selected' : '' }}>
                                                    {{ $emp->employee_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="employee_id">Employee ID </label>
                                        <input type="text" name="employee_id"
                                            value ="{{ isset($employee) ? $employee->full_employee_id : '' }}"
                                            id="employee_id" required readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="department_location">Department</label>
                                        <input type="text" name="department"
                                            value ="{{ isset($employee) ? Helpers::getFullDepartmentName($employee->department) ?? 'NA' : '' }}"
                                            id="department" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="designation">Designation </label>
                                        <input type="text" name="designation"
                                            value ="{{ isset($employee) ? $employee->job_title : '' }}" id="designee"
                                            required readonly>
                                    </div>
                                </div>
                                <input type="hidden" name="employee_name" id="employee_name">

                                <div class="col-lg-6">
                                    <div class="group-input" id="repeat_nature">
                                        <label for="repeat_nature">Experience (if any)</label>
                                        <input type="number" name="experience" value ="" min="1"
                                            id="experience">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Persons">HOD </label>
                                        <input id="" type="text" name="hod">
                                        <!-- <select name="hod" placeholder="Select HOD" data-search="false" data-silent-initial-value-set="true" id="hod">
                                                                        <option value="">-- Select Hod --</option>
                                                                        @foreach ($users as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                        </select> -->
                                    </div>
                                </div>

                                <!-- <div class="col-6">
                                    <div class="group-input">
                                        <label for="qualification">Qualification</label>
                                        <input id="qualification" type="text" name="qualification" maxlength="255" >
                                    </div> -->

                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Short Description">Qualification </label>
                                        <input id="qualification" type="text"
                                            value ="{{ isset($employee) ? $employee->qualification : '' }}"
                                            name="qualification" readonly>
                                    </div>
                                </div>

                                <script>
                                    document.getElementById('select-state').addEventListener('change', function() {
                                        var selectedOption = this.options[this.selectedIndex];
                                        var employeeId = selectedOption.value;
                                        var employeeName = selectedOption.getAttribute('data-name');
                                        var department = selectedOption.getAttribute('data-department');

                                        if (employeeId) {
                                            fetch(`/employees/${employeeId}`)
                                                .then(response => response.json())
                                                .then(data => {
                                                    document.getElementById('employee_id').value = data.full_employee_id;
                                                    document.getElementById('department').value = department;
                                                    document.getElementById('designee').value = data.job_title;
                                                    // document.getElementById('experience').value = data.experience;
                                                    document.getElementById('qualification').value = data.qualification;
                                                });
                                            document.getElementById('employee_name').value = employeeName;
                                        } else {
                                            document.getElementById('employee_id').value = '';
                                            document.getElementById('department').value = '';
                                            document.getElementById('designee').value = '';
                                            // document.getElementById('experience').value = '';
                                            document.getElementById('qualification').value = '';
                                            document.getElementById('employee_name').value = '';
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
                                        <label for="training_date">Schedule Training date</label>
                                        <input type="date" id="training_date" name="training_date">
                                    </div>
                                </div>

                                <!-- Topic of Training -->
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="topic">Topic of Training</label>
                                        <input type="text" id="" name="topic">
                                    </div>
                                </div>

                                <!-- Type of Training -->
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="type">Type of Training</label>
                                        <select name="type" id="type">
                                            <option value="">--Select--</option>
                                            <option value="Planned/ Schedule Training">Planned/ Schedule Training </option>
                                            <option value="Unplanned/ Unschedule Training">Unplanned/ Unschedule Training </option>
                                            <option value="External Training">External Training </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="evaluation">Evaluation Required</label>
                                        <select name="evaluation" id="evaluation">
                                            <option value="">--Select--</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6" id="evaluation-through-container" style="display: none;">
                                    <div class="group-input">
                                        <label for="evaluation-through">Evaluation Through</label>
                                        <select name="evaluation_through" id="evaluation-through">
                                            <option value="">--Select--</option>
                                            <option value="questionnaire">Questionnaire</option>
                                            <option value="group_interaction">Group Interaction</option>
                                            <option value="viva_voice">Viva Voice</option>
                                        </select>
                                    </div>
                                </div>

                                <script>
                                    document.getElementById('evaluation').addEventListener('change', function () {
                                        var evaluationThroughContainer = document.getElementById('evaluation-through-container');
                                        if (this.value === 'yes') {
                                            evaluationThroughContainer.style.display = 'block';
                                        } else {
                                            evaluationThroughContainer.style.display = 'none';
                                        }
                                    });
                                </script>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="site_name">Site Division/Project</label>
                                        <select name="site_code">
                                            <option value="">-- Select --</option>
                                            <option value="Corporate">Corporate</option>
                                            <option value="Plant">Plant</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Site Division/Project">Site Division/Project <span class="text-danger">*</span></label>
                                    <select name="division_id" required>
                                        <option value="">-- Select --</option>
                                        @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record_number" value="">
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


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        <input disabled type="text" name="initiator"
                                            value="{{ Auth::user()->name }}">
                                        <input type="hidden" name="initiator" value="{{ Auth::user()->name }}">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}"
                                            name="date_of_initiation">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="date_of_initiation">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger">*</span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assigned_to" required>
                                            <option value="">Select</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>


                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Due Date <span class="text-danger">*</span></label>
                                        <div class="calenderauditee">

                                            <input type="hidden" value="{{$due_date}}" name="due_date">
                                            <input disabled type="text" value="{{Helpers::getdateFormat($due_date)}}">
                                        </div>
                                    </div>
                                </div> --}}


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description <span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="short_description" type="text" name="short_description"
                                            maxlength="255" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Description">Description </label>
                                        <input id="description" type="text" name="description">
                                    </div>
                                </div>



            {{-- <div class="">
                <div class="group-input">
                    <label for="audit-agenda-grid">
                        Trainer Skill Set<button type="button" name="audit-agenda-grid" id="Trainer_Skill_table">+</button>
                    </label>
                    <table class="table table-bordered" id="Trainer_Skill_table_details">
                        <thead>
                            <tr>
                                <th style="width: 5%;">Sr. No.</th>
                                <th>Trainer Skill Set</th>

                                <th>Remarks</th>

                            </tr>
                        </thead>
                        <tbody>
                            <td><input disabled type="text" name="trainer_skill[0][serial_number]" value="1">
                            </td>
                            <td><input type="text" name="trainer_skill[0][Trainer_skill_set]"></td>
                            <td><input type="text" name="trainer_skill[0][remarks]"></td>
                        </tbody>
                    </table>
                </div>

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

                            </tr>
                        </thead>
                        <tbody>
                            <td><input disabled type="text" name="trainer_listOfAttachment[0][serial_number]" value="1">
                            </td>
                            <td><input type="text" name="trainer_listOfAttachment[0][title_of document]"></td>
                            <td><input type="text" name="trainer_listOfAttachment[0][supporting_document]"></td>

                            <td><input type="text" name="trainer_listOfAttachment[0][remarks]"></td>
                        </tbody>
                    </table>
                </div>
            </div> --}}


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
                                                                <option value=""> -- Select --</option>
                                                                <option value="Poor">Poor</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Satisfactory">Satisfactory</option>

                                                            </select>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Delivery & Knowledge Of Content</td>
                                                        <td>
                                                            <select name="evaluation_criteria_2" id="">
                                                                <option value=""> -- Select --</option>
                                                                <option value="Poor">Poor</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Satisfactory">Satisfactory</option>

                                                            </select>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Oral & Written Languagee (Speaking
                                                            Style Was Clear, Easily understood , Pleasant to hear)</td>
                                                        <td>
                                                            <select name="evaluation_criteria_3" id="">
                                                                <option value=""> -- Select --</option>
                                                                <option value="Poor">Poor</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Satisfactory">Satisfactory</option>

                                                            </select>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Is Research Up to Date?</td>
                                                        <td>
                                                            <select name="evaluation_criteria_4" id="">
                                                                <option value=""> -- Select --</option>
                                                                <option value="Poor">Poor</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Satisfactory">Satisfactory</option>

                                                            </select>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Interactions With Participants</td>
                                                        <td>
                                                            <select name="evaluation_criteria_5" id="">
                                                                <option value=""> -- Select --</option>
                                                                <option value="Poor">Poor</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Satisfactory">Satisfactory</option>

                                                            </select>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Response To Participants</td>
                                                        <td>
                                                            <select name="evaluation_criteria_6" id="">
                                                                <option value=""> -- Select --</option>
                                                                <option value="Poor">Poor</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Satisfactory">Satisfactory</option>

                                                            </select>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>Discussion Techniques</td>
                                                        <td>
                                                            <select name="evaluation_criteria_7" id="">
                                                                <option value=""> -- Select --</option>
                                                                <option value="Poor">Poor</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Satisfactory">Satisfactory</option>
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
                                                                <option value="Poor">Poor</option>
                                                                <option value="Good">Good</option>
                                                                <option value="Satisfactory">Satisfactory</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="">
                                <div class="group-input">
                                    <label for="trainingQualificationStatus">Qualification Status</label>
                                    <select name="trainer" id="trainingQualificationStatus">
                                        <option value="">-- Select --</option>
                                        <option value="Qualified">Qualified</option>
                                        <option value="Not Qualified">Not Qualified</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Q_comment">Qualification Comments</label>
                                    <textarea class="" name="qualification_comments"></textarea>
                                </div>
                            </div> --}}

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">Initial Attachment</label>
                                    <input type="file" id="myfile" name="initial_attachment">
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
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>

                        </div>
                    </div>

                    {{-- <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="col-12 sub-head">
                            Questionaries
                        </div>
                        <div class="pt-2 group-input">
                            <label for="audit-agenda-grid">
                                Questionaries
                                <button type="button" name="audit-agenda-grid" id="ObservationAdd">+</button>
                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#observation-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
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

                                                <tr>
                                                    <td><input disabled type="text"
                                                            name="jobResponsibilities[serial]"
                                                            value=""></td>
                                                    <td><input type="text"
                                                            name="jobResponsibilities[job]"
                                                            value=""
                                                            class="question-input">
                                                    </td>
                                                    <td><input type="text"
                                                            name="jobResponsibilities[remarks]"
                                                            value=""
                                                            class="answer-input">
                                                    </td>
                                                    <td><input type="text"
                                                            name="jobResponsibilities[comments]"
                                                            value=""
                                                            class="answer-input">
                                                    </td>
                                                </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton" id="">Save</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        </div>
                    </div>
                </div> --}}
                {{-- <script>
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
                </script> --}}

                <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Trainer Acknowledge Comment</label>
                                    <textarea name="trainer_acknowledge_comment"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="External Attachment">Trainer Acknowledge Attachments</label>
                                    <input type="file" id="myfile" name="trainer_acknowledge_attachments"
                                        value="">
                                    <a href=""
                                        target="_blank"></a>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                        </div>
                    </div>
                </div>

                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-6">
                              <div class="group-input">
                                    <label for="start_date">Start Date of Training</label>
                                    <input type="date" id="start_date" name="start_date" class="" onchange="setMinEndDate()">
                              </div>  
                            </div>

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="end_date">End Date of Training</label>
                                    <input type="date" id="end_date" name="end_date" class="" onchange="setMaxStartDate()">
                                </div>    
                            </div>

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="start_time">Start Time of Training</label>
                                    <input type="time" id="start_time" name="start_time">
                                </div>    
                            </div>

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="end_time">End Time of Training</label>
                                    <input type="time" id="end_time" name="end_time">
                                </div>    
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Pending Training Comment</label>
                                    <textarea name="pending_training_comment"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="External Attachment">Pending Training Attachments</label>
                                    <input type="file" id="myfile" name="pending_training_attachments"
                                        value="">
                                    <a href=""
                                        target="_blank"></a>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        </div>
                    </div>
                </div>


                <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="HOD Persons">Evaluation by HOD</label>
                                    <select name="evaluation_by_hod" placeholder="Select Evaluation by HOD" data-search="false" data-silent-initial-value-set="true" id="hod">
                                            <option value="">-- Select Evaluation by HOD --</option>
                                            @foreach ($users as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Evaluation by HOD">Evaluation Criteria</label>
                                    <input type="text" name ="evaluation_criteria_hod">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">HOD Evaluation Comment</label>
                                    <textarea name="hod_comment"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="External Attachment">HOD Evaluation Attachment</label>
                                    <input type="file" id="myfile" name="hod_attachment"
                                        value="">
                                    <a href=""
                                        target="_blank"></a>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        </div>
                    </div>
                </div>

                <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                        <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="HOD Persons">Evaluation by QA/CQA</label>
                                    <select name="evaluation_by_qa" placeholder="Select Evaluation by QA/CQA" data-search="false" data-silent-initial-value-set="true" id="hod">
                                            <option value="">-- Select Evaluation by QA/CQA --</option>
                                            @foreach ($users as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Evaluation by Criteria">Evaluation Criteria</label>
                                    <input type="text" name ="evaluation_criteria_qa">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="QA/CQA Head Approval Comment">QA/CQA Head Approval Comment</label>
                                    <textarea name="qa_final_comment"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="QA/CQA Head Approval Attachment">QA/CQA Head Approval Attachment</label>
                                    <input type="file" id="myfile" name="qa_final_attachment"
                                        value="">
                                    <a href=""
                                        target="_blank"></a>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        </div>
                    </div>
                </div>


                    <!-- Activity Log content -->
                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submitted On">Submit By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submitted On">Submit On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Comment">Submit Comment</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Submitted On">Update Complete By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Submitted On">Update Complete On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Comment">Update Complete Comment</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Submitted On">Answer Complete By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Submitted On">Answer Complete On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Comment">Answer Complete Comment</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Submitted On">Evaluation Complete By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Submitted On">Evaluation Complete On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Comment">Evaluation Complete Comment</label>
                                    <div class="static"></div>
                                </div>
                            </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Qualified By">Qualified By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Qualified On">Qualified On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Qualified On">Qualified Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for=" Rejected By">Rejected By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Rejected On">Rejected On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Qualified On">Rejected Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <a href="/rcms/qms-dashboard">
                                    <button type="button" class="backButton">Back</button>
                                </a>
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
        function setMinEndDate() {
            var startDate = document.getElementById('start_date').value;
            document.getElementById('end_date').min = startDate; 
        }

        function setMaxStartDate() {
            var endDate = document.getElementById('end_date').value;
            document.getElementById('start_date').max = endDate;
        }
    </script>

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


@section('footer_cdn')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/additional-methods.min.js"
        integrity="sha512-TiQST7x/0aMjgVTcep29gi+q5Lk5gVTUPE9XgN0g96rwtjEjLpod4mlBRKWHeBcvGBAEvJBmfDqh2hfMMmg+5A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
