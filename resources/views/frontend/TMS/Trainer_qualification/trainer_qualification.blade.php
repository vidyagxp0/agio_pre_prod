@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->select('id', 'name')->get();

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
                        '_checkdate" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input" oninput="handleDateInput(this, scheduled_start_date' +
                        serialNumber + ');checkDate(scheduled_start_date' + serialNumber +
                        '_checkdate,scheduled_end_date' + serialNumber +
                        '_checkdate)" /></div></div></div></td>' +
                        '<td><input type="time" name="scheduled_start_time[]"></td>' +
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="scheduled_end_date' +
                        serialNumber +
                        '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="scheduled_end_date[]" id="scheduled_end_date' +
                        serialNumber +
                        '_checkdate"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"class="hide-input" oninput="handleDateInput(this, scheduled_end_date' +
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
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }} Trainer Qualification
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

                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>
            </div>

            <form id="auditform" action="{{ route('trainer.store') }}" method="POST" enctype="multipart/form-data">
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
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record_number" value="PL-01-109">
                                        <input type="hidden" name="record_number" value="PL-01-109">
                                    </div>
                                </div>
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
                                        <label for="Initiator"><b>Site/Location Code</b></label>
                                        <input disabled type="text" name="site_code" value="PLANT">
                                        <input type="hidden" name="site_code" value="PLANT">

                                    </div>
                                </div>
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
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="date_of_initiation">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="date_of_initiation">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assigned_to">
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


                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Due Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" name= "due_date" id="due_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description</label><span
                                            id="rchars">255</span>
                                        characters remaining
                                        <input id="short_description" type="text" name="short_description"
                                            maxlength="255">
                                    </div>
                                </div>

                                <div class="sub-head">
                                    Trainer Information
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="trainer">Trainer Name</label>
                                        <select name="trainer_name" id="trainer_name">
                                            <option value="0">Select</option>
                                            <option value="trainer1">Trainer 1</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="qualification">Qualification</label>
                                        <input id="qualification" type="text" name="qualification" maxlength="255">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Designation">Designation</label>
                                        <select name="designation" id="designation">
                                            <option value="0">Select</option>
                                            <option value="lead_trainer">Lead Trainer</option>
                                            <option value="senior_trainer">Senior Trainer</option>
                                            <option value="Instructor">Instructor</option>
                                            <option value="Evaluator">Evaluator</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Department">Department</label>
                                        <select name="department" id="department">
                                            <option value="0">Select</option>
                                            <option value="quality_assurance">Quality Assurance (QA)</option>
                                            <option value="operations">Operations</option>
                                            <option value="learning_deve">Learning and Development (L&D)</option>
                                            <option value="it">Information Technology (IT)</option>
                                            <option value="Finance">Finance</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Experience">Experience (No. of Years)</label>
                                        <select name="experience" id="Experience">
                                            <option value="">Select </option>
                                            @for ($i = 1; $i <= 70; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="priority-level">Priority Level</label>
                                        <span class="text-primary">Priority levels in TMS can be tailored to suit the specific needs of the institution in managing the training program.</span>
                                        <select name="priority_level">
                                            <option value="0">-- Select --</option>
                                            <option value="low">Low Priority</option>
                                            <option value="medium">Medium Priority</option>
                                            <option value="high">High Priority</option>
                                        </select>
                                    </div>
                                </div> --}}





                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group">Initiated Through</label>
                                        <div><small class="text-primary">Please select related information</small></div>
                                        <select name="initiated_through"
                                            onchange="otherController(this.value, 'others', 'initiated_through_req')">
                                            <option value="">-- select --</option>
                                            <option value="recall">Recall</option>
                                            <option value="return">Return</option>
                                            <option value="deviation">Deviation</option>
                                            <option value="complaint">Complaint</option>
                                            <option value="regulatory">Regulatory</option>
                                            <option value="lab-incident">Lab Incident</option>
                                            <option value="improvement">Improvement</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input" id="initiated_through_req">
                                        <label for="If Other">Others<span class="text-danger d-none">*</span></label>
                                        <textarea name="initiated_if_other"></textarea>
                                    </div>
                                </div> --}}


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="external_agencies">External Agencies</label>
                                        <select name="external_agencies"
                                            onchange="otherController(this.value, 'others', 'external_agencies_req')">
                                            <option value="">-- Select --</option>
                                            <option value="jordan_fda">Jordan FDA</option>
                                            <option value="us_fda">USFDA</option>
                                            <option value="mhra">MHRA</option>
                                            <option value="anvisa">ANVISA</option>
                                            <option value="iso">ISO</option>
                                            <option value="who">WHO</option>
                                            <option value="local_fda">Local FDA</option>
                                            <option value="tga">TGA</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="group-input">
                                        <label for="audit-agenda-grid">
                                            Trainer Skill Set<button type="button" name="audit-agenda-grid"
                                                id="Trainer_Skill_table">+</button>
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
                                            List of Attachments<button type="button" name="audit-agenda-grid"
                                                id="attachmentgrid-table">+</button>
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
                                </div>

                                <div class="">
                                    <div class="group-input">
                                        <label for="trainingQualificationStatus">Trainer</label>
                                        <select name="trainer" id="trainingQualificationStatus">
                                            <option value="">-- Select --</option>
                                            <option value="Qualified">Qualified</option>
                                            <option value="Not Qualified">Not Qualified</option>
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
                                                                <option value=""> -- Select --</option>
                                                                <option value="1"> 1</option>
                                                                <option value="2"> 2</option>
                                                                <option value="3"> 3</option>

                                                            </select>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Delivery & Knowledge Of Content</td>
                                                        <td>
                                                            <select name="evaluation_criteria_2" id="">
                                                                <option value=""> -- Select --</option>
                                                                <option value="1"> 1</option>
                                                                <option value="2"> 2</option>
                                                                <option value="3"> 3</option>

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
                                                                <option value="1"> 1</option>
                                                                <option value="2"> 2</option>
                                                                <option value="3"> 3</option>

                                                            </select>
                                                        </td>


                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Is Research Up to Date?</td>
                                                        <td>
                                                            <select name="evaluation_criteria_4" id="">
                                                                <option value=""> -- Select --</option>
                                                                <option value="1"> 1</option>
                                                                <option value="2"> 2</option>
                                                                <option value="3"> 3</option>

                                                            </select>
                                                        </td>


                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Interactions With Participants</td>
                                                        <td>
                                                            <select name="evaluation_criteria_5" id="">
                                                                <option value=""> -- Select --</option>
                                                                <option value="1"> 1</option>
                                                                <option value="2"> 2</option>
                                                                <option value="3"> 3</option>

                                                            </select>
                                                        </td>


                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Response To Participants</td>
                                                        <td>
                                                            <select name="evaluation_criteria_6" id="">
                                                                <option value=""> -- Select --</option>
                                                                <option value="1"> 1</option>
                                                                <option value="2"> 2</option>
                                                                <option value="3"> 3</option>

                                                            </select>
                                                        </td>


                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>Discussion Techniques</td>
                                                        <td>
                                                            <select name="evaluation_criteria_7" id="">
                                                                <option value=""> -- Select --</option>
                                                                <option value="1"> 1</option>
                                                                <option value="2"> 2</option>
                                                                <option value="3"> 3</option>

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
                                                                <option value="1"> 1</option>
                                                                <option value="2"> 2</option>
                                                                <option value="3"> 3</option>

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
                                    <textarea class="" name="qualification_comments"></textarea>
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



                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">Initial Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    {{-- <input type="file" id="myfile" name="inv_attachment[]" multiple> --}}
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="audit_file_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="initial_attachment"
                                                oninput="addMultipleFiles(this, 'audit_file_attachment')" multiple>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>



                <!-- Activity Log content -->
                <div id="CCForm6" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Submitted On">Submitted By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Submitted On">Submitted On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Qualified By">Qualified By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Qualified On">Qualified On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for=" Rejected By">Rejected By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Rejected On">Rejected On</label>
                                    <div class="static"></div>
                                </div>
                            </div>

                        </div>
                        {{-- <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <a href="/rcms/qms-dashboard">
                                <button type="button" class="backButton">Back</button>
                            </a>
                            <button type="submit">Submit</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div> --}}
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
