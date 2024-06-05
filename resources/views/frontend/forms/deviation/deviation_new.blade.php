@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->select('id', 'name')->get();

    @endphp

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }

        .sub-main-head {
            display: flex;
            justify-content: space-evenly;
        }

        .Activity-type {
            margin-bottom: 7px;
        }

        /* .sub-head {
            margin-left: 280px;
            margin-right: 280px;
            color: #4274da;
            border-bottom: 2px solid #4274da;
            padding-bottom: 5px;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 1.2rem;

        } */

        .create-entity {
            background: #323c50;
            padding: 10px 15px;
            color: white;
            margin-bottom: 20px;

        }

        .bottom-buttons {
            display: flex;
            justify-content: flex-end;
            margin-right: 300px;
            margin-top: 50px;
            gap: 20px;
        }

        .launch_extension {
            background: #4274da;
            color: white;
            border: 0;
            padding: 4px 15px;
            border: 1px solid #4274da;
            transition: all 0.3s linear;
        }

        .main_head_modal {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* .modal-header{
            background: gainsboro !important;
        } */
        .main_head_modal li {
            margin-bottom: 10px;
        }

        .extension_modal_signature {
            display: block;
            width: 100%;
            border: 1px solid #837f7f;
            border-radius: 5px;
        }
    </style>
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

        .text-danger {
            margin-top: -22px;
            padding: 4px;
            margin-bottom: 3px;
        }

        /* .saveButton:disabled{
                background: black!important;
                border:  black!important;

            } */
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
    <!-- <script>
        function addWhyField(con_class, name) {
            let mainBlock = document.querySelector('.why-why-chart')
            let container = mainBlock.querySelector(`.${con_class}`)
            let textarea = document.createElement('textarea')
            textarea.setAttribute('name', name);
            container.append(textarea)
        }
    </script> -->

    <script>
        console.log('Script working')
        $(document).ready(function() {

            let auditForm = document.getElementById('auditform');

            function submitForm() {
                document.querySelectorAll('.saveAuditFormBtn').forEach(function(button) {
                    button.disabled = true;
                })

                document.querySelectorAll('.auditFormSpinner').forEach(function(spinner) {
                    spinner.style.display = 'flex';
                })

                auditForm.submit();
            }

            $('#ChangesaveButton0011').click(function() {
                document.getElementById('formNameField').value = 'general';
                submitForm();
            });


        });
        // ==================================

        wow = new WOW({
            boxClass: 'wow', // default
            animateClass: 'animated', // default
            offset: 0, // default
            mobile: true, // default
            live: true // default
        })
        wow.init();
    </script>

    <script>
        $(document).ready(function() {
            $('#internalaudit-table').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="audit[]"></td>' +
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="scheduled_start_date' +
                        serialNumber +
                        '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="scheduled_start_date[]" id="scheduled_start_date' +
                        serialNumber +
                        '_checkdate" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input" oninput="handleDateInput(this, `scheduled_start_date' +
                    serialNumber + '`);checkDate(`scheduled_start_date' + serialNumber +
                    '_checkdate`,`scheduled_end_date' + serialNumber +
                    '_checkdate`)" /></div></div></div></td>' +

                        '<td><input type="time" name="scheduled_start_time[]"></td>' +
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="scheduled_end_date' +
                        serialNumber +
                        '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="scheduled_end_date[]" id="scheduled_end_date' +
                        serialNumber +
                        '_checkdate" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, `scheduled_end_date' +
                    serialNumber + '`);checkDate(`scheduled_start_date' + serialNumber +
                    '_checkdate`,`scheduled_end_date' + serialNumber +
                    '_checkdate`)" /></div></div></div></td>' +
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
            $('#ObservationAdd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td> <select name="facility_name[]" id="facility_name">  <option value="">-- Select --</option>  <option value="1">Facility</option>  <option value="2"> Equipment</option> <option value="3">Instrument</option></select> </td>' +
                        '<td><input type="text" name="IDnumber[]"></td>' +
                        '<td><input type="text" name="Remarks[]"></td>' +
                        '<td><button class="removeRowBtn">Remove</button></td>' +


                        '</tr>';

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
    <script>
        $(document).ready(function() {
            $('#ReferenceDocument').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="Number[]"></td>' +
                        '<td><input type="text" name="ReferenceDocumentName[]"></td>' +
                        '<td><input type="text" name="Document_Remarks[]"></td>' +
                        '<td><button class="removeRowBtn">Remove</button></td>' +


                        '</tr>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +

                        '</tr>';

                    return html;
                }

                var tableBody = $('#ReferenceDocument_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
        $(document).on('click', '.remove-file', function() {
            $(this).closest('div').remove();
            console.log('removing')
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#Product_Details').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="product_name[]"></td>' +
                        '<td> <select name="product_stage[]" id=""> <option value="">-- Select --</option> <option value="">1 <option value="">2</option> <option value="">3</option><option value="">4</option> <option value="">5</option><option value="">6</option> <option value="">7</option> <option value="">8</option><option value="">9</option><option value="">Final</option> </select></td>' +
                        '<td><input type="text" name="batch_no[]"></td>' +
                        '<td><button class="removeRowBtn">Remove</button></td>' +



                        '</tr>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +

                        '</tr>';

                    return html;
                }

                var tableBody = $('#Product_Details_Details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove();
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#investigation_Details').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td> <select name="Investigation_team[]" id=""> <option value="">-- Select --</option><option value="">name</option> </select> </td>' +
                        '<td><input type="text" class="numberDetail" name="Responsibility[]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="Remarks[]"></td>' +
                        '<td><button type="text" class="removeRowBtn" ">Remove</button></td>' +

                        '</tr>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +

                        '</tr>';

                    return html;
                }

                var tableBody = $('#investigation_Details_Details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#root_cause_Details').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td> <select name="Root_Cause_Category[]" id=""> <option value="">-- Select --</option><option value="">name   </option> </select></td>' +
                        '<td><select name="Root_Cause_Sub-Category[]" id=""><option value="">-- Select --</option><option value="">name</option>  </select></td>' +
                        '<td><input type="text" class="Document_Remarks" name="ifother[]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="Probability[]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="remarks[]"></td>' +
                        '<td><button type="text" class="removeRowBtn" ">Remove</button></td>' +

                        '</tr>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +

                        '</tr>';

                    return html;
                }

                var tableBody = $('#Root_cause_Details_Details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#risk_matrix_details').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="Risk_Assessment[]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="Review_Schedule[]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="Actual_Reviewed[]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="Recorded_By[]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="Remarks[]"></td>' +
                        '<td><button type="text" class="removeRowBtn" ">Remove</button></td>' +

                        '</tr>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +

                        '</tr>';

                    return html;
                }

                var tableBody = $('#risk_matrix_details_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong>:
            {{ Helpers::getDivisionName(session()->get('division')) }}/Deviation
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
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">HOD Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">QA Initial Review</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm7')">CFT</button>
                <button class="cctablinks " id="Investigation_button" style="display: none"
                    onclick="openCity(event, 'CCForm9')">Investigation</button>
                <button id="QRM_button" class="cctablinks" style="display: none"
                    onclick="openCity(event, 'CCForm11')">QRM</button>

                <button id="CAPA_button" class="cctablinks" style="display: none"
                    onclick="openCity(event, 'CCForm10')">CAPA</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Investigation & CAPA</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Initiator Update</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QAH/Designee Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm12')">Extension</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>
            </div>
            <form id="auditform" action="{{ route('deviationstore') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="form_name" id="formNameField" value="">
                <div id="step-form">

                    <!-- General information content -->

                    @if ($errors->any())
                        @foreach ($errors as $error)
                            <div class="text-danger">{{ $error }}</div>
                        @endforeach
                    @endif

                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                @if (!empty($parent_id))
                                    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                                    <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                                    <input type="hidden" name="parent_record" value="{{ $parent_record }}">
                                @endif
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record_number">
                                        {{-- value="{{ Helpers::getDivisionName(session()->get('division')) }}/DEV/{{ date('Y') }}/{{ $record_number }}"> --}}
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input disabled type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        {{-- <div class="static">QMS-North America</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" value="{{ Auth::user()->name }}">

                                    </div>
                                </div>


                                @php
                                    // Calculate the due date (30 days from the initiation date)
                                    $initiationDate = date('Y-m-d'); // Current date as initiation date
                                    $dueDate = date('Y-m-d', strtotime($initiationDate . '+30 days')); // Due date
                                @endphp

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date of Initiation"><b>Date of Initiation</b></label>
                                        <input readonly type="text" value="{{ date('d-M-Y') }}" name="initiation_date"
                                            id="initiation_date"
                                            style="background-color: light-dark(rgba(239, 239, 239, 0.3), rgba(59, 59, 59, 0.3))">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="initiation_date_hidden">
                                    </div>
                                </div>

                                <div class="col-lg-12 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Due Date">Due Date</label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision
                                                reason in "Due Date Extension Justification" data field.</small></div>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly placeholder="DD-MM-YYYY" />
                                            <input type="date" name="due_date"
                                                min="{{ \Carbon\Carbon::now()->format('d-M-Y') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    // Format the due date to DD-MM-YYYY
                                    // Your input date
                                    var dueDate = "{{ $dueDate }}"; // Replace {{ $dueDate }} with your actual date variable

                                    // Create a Date object
                                    var date = new Date(dueDate);

                                    // Array of month names
                                    var monthNames = [
                                        "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                                    ];

                                    // Extracting day, month, and year from the date
                                    var day = date.getDate().toString().padStart(2, '0'); // Ensuring two digits
                                    var monthIndex = date.getMonth();
                                    var year = date.getFullYear();

                                    // Formatting the date in "dd-MMM-yyyy" format
                                    var dueDateFormatted = `${day}-${monthNames[monthIndex]}-${year}`;

                                    // Set the formatted due date value to the input field
                                    document.getElementById('due_date').value = dueDateFormatted;
                                </script>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group"><b>Department</b><span
                                                class="text-danger">*</span></label>
                                        <select name="Initiator_Group" id="initiator_group" required>
                                            <option value="">-- Select --</option>
                                            <option value="CQA" @if (old('Initiator_Group') == 'CQA') selected @endif>
                                                Corporate Quality Assurance</option>
                                            <option value="QAB" @if (old('Initiator_Group') == 'QAB') selected @endif>
                                                Quality
                                                Assurance Biopharma</option>
                                            <option value="CQC" @if (old('Initiator_Group') == 'CQC') selected @endif>
                                                Central
                                                Quality Control</option>
                                            <option value="MANU" @if (old('Initiator_Group') == 'MANU') selected @endif>
                                                Manufacturing</option>
                                            <option value="PSG" @if (old('Initiator_Group') == 'PSG') selected @endif>Plasma
                                                Sourcing Group</option>
                                            <option value="CS" @if (old('Initiator_Group') == 'CS') selected @endif>
                                                Central
                                                Stores</option>
                                            <option value="ITG" @if (old('Initiator_Group') == 'ITG') selected @endif>
                                                Information Technology Group</option>
                                            <option value="MM" @if (old('Initiator_Group') == 'MM') selected @endif>
                                                Molecular Medicine</option>
                                            <option value="CL" @if (old('Initiator_Group') == 'CL') selected @endif>
                                                Central
                                                Laboratory</option>

                                            <option value="TT" @if (old('Initiator_Group') == 'TT') selected @endif>Tech
                                                team</option>
                                            <option value="QA" @if (old('Initiator_Group') == 'QA') selected @endif>
                                                Quality Assurance</option>
                                            <option value="QM" @if (old('Initiator_Group') == 'QM') selected @endif>
                                                Quality Management</option>
                                            <option value="IA" @if (old('Initiator_Group') == 'IA') selected @endif>IT
                                                Administration</option>
                                            <option value="ACC" @if (old('Initiator_Group') == 'ACC') selected @endif>
                                                Accounting</option>
                                            <option value="LOG" @if (old('Initiator_Group') == 'LOG') selected @endif>
                                                Logistics</option>
                                            <option value="SM" @if (old('Initiator_Group') == 'SM') selected @endif>
                                                Senior Management</option>
                                            <option value="BA" @if (old('Initiator_Group') == 'BA') selected @endif>
                                                Business Administration</option>
                                        </select>
                                        @error('Initiator_Group')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Department Code</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code"
                                            value="" readonly>
                                    </div>
                                </div> --}}

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        Characters remaining
                                        <input id="docname" type="text" name="short_description" maxlength="255"
                                            required>
                                    </div>
                                    @error('short_description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="short_description_required">Repeat Deviation?</label>
                                        <select name="short_description_required" id="short_description_required"
                                            required>
                                            <option value="0">-- Select --</option>
                                            <option value="Recurring" @if (old('short_description_required') == 'Recurring') selected @endif>
                                                Yes</option>
                                            <option value="Non_Recurring"
                                                @if (old('short_description_required') == 'Non_Recurring') selected @endif>
                                                No</option>
                                        </select>
                                    </div>
                                    @error('short_description_required')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6" id="nature_of_repeat_block" style="display: none">

                                    <div class="group-input" id="nature_of_repeat">
                                        <label for="nature_of_repeat">Repeat Nature </label>
                                        <textarea name="nature_of_repeat" class="nature_of_repeat">{{ isset($data) ? $data->short_description_required : '' }}</textarea>
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('short_description_required');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('nature_of_repeat');

                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }


                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'Recurring';

                                            inputsToToggle.forEach(function(input) {
                                                if (!isRequired) {
                                                    document.getElementById('nature_of_repeat_block').style.display = 'none';
                                                } else {
                                                    document.getElementById('nature_of_repeat_block').style.display = 'block';
                                                }
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskInviRecurring');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>


                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Deviation date">Deviation Observed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Deviation_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            {{-- <td><input type="time" name="scheduled_start_time[]"></td> --}}
                                            <input type="date" name="Deviation_date"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Deviation_date')" />
                                        </div>
                                    </div>
                                    @error('Deviation_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-lg-6 new-time-data-field">
                                    <div class="group-input input-time">
                                        <label for="deviation_time">Deviation Observed On (Time)</label>
                                        <input type="text" name="deviation_time" id="deviation_time">
                                    </div>
                                    @error('Deviation_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 new-time-data-field">
                                    <div class="group-input input-time delayJustificationBlock">
                                        <label for="deviation_time">Delay Justification</label>
                                        <textarea id="Delay_Justification" name="Delay_Justification"></textarea>
                                    </div>
                                    {{-- @error('Deviation_date')
                                        <div class="text-danger">{{  $message  }}</div>
                                    @enderror --}}
                                </div>

                                <script>
                                    flatpickr("#deviation_time", {
                                        enableTime: true,
                                        noCalendar: true,
                                        dateFormat: "H:i", // 24-hour format without AM/PM
                                        minuteIncrement: 1 // Set minute increment to 1

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="facility">Deviation Observed By</label>
                                        <input type="text" name="Facility" id="deviation_observed_by" placeholder="Enter Facility Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule End Date">Deviation Reported on</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Deviation_reported_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Deviation_reported_date"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Deviation_reported_date')" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $('.delayJustificationBlock').hide();

                                    function calculateDateDifference() {
                                        let deviationDate = $('input[name=Deviation_date]').val();
                                        let reportedDate = $('input[name=Deviation_reported_date]').val();

                                        if (!deviationDate || !reportedDate) {
                                            console.error('Deviation date or reported date is missing.');
                                            return;
                                        }

                                        let deviationDateMoment = moment(deviationDate);
                                        let reportedDateMoment = moment(reportedDate);

                                        let diffInDays = reportedDateMoment.diff(deviationDateMoment, 'days');

                                        if (diffInDays > 0) {
                                            $('.delayJustificationBlock').show();
                                        } else {
                                            $('.delayJustificationBlock').hide();
                                        }

                                    }

                                    $('input[name=Deviation_date]').on('change', function() {
                                        calculateDateDifference();
                                    })

                                    $('input[name=Deviation_reported_date]').on('change', function() {
                                        calculateDateDifference();
                                    })
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="audit type">Deviation Related To </label>
                                        <select multiple name="audit_type[]" id="audit_type">
                                            {{-- <option value="">Enter Your Selection Here</option> --}}
                                            <option value="Facility">Facility</option>
                                            <option value="Equipment/Instrument">Equipment/ Instrument </option>
                                            <option value="Documentationerror">Documentation error </option>
                                            <option value="STP/ADS_instruction">STP/ADS instruction </option>
                                            <option value="Packaging&Labelling">Packaging & Labelling </option>
                                            <option value="Material_System">Material System </option>
                                            <option value="Laboratory_Instrument/System"> Laboratory Instrument /System
                                            </option>
                                            <option value="Utility_System"> Utility System</option>
                                            <option value="Computer_System"> Computer System</option>
                                            <option value="Document">Document</option>
                                            <option value="Data integrity">Data integrity</option>
                                            <option value="SOP Instruction">SOP Instruction</option>
                                            <option value="BMR/ECR Instruction">BMR/ECR Instruction</option>
                                            <option value="Water System">Water System</option>
                                            <option value="Anyother(specify)">Any other (specify) </option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="audit type">Deviation Related To </label>
                                        <select name="audit_type[]" id="audit_type" multiple class="form-control">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="Facility">Facility</option>
                                            <option value="Equipment/Instrument">Equipment/ Instrument </option>
                                            <option value="Documentationerror">Documentation error </option>
                                            <option value="STP/ADS_instruction">STP/ADS instruction </option>
                                            <option value="Packaging&Labelling">Packaging & Labelling  </option>
                                            <option value="Material_System">Material System  </option>
                                            <option value="Laboratory_Instrument/System"> Laboratory Instrument /System</option>
                                            <option value="Utility_System"> Utility System</option>
                                            <option value="Computer_System"> Computer System</option>
                                            <option value="Document">Document</option>
                                            <option value="Data integrity">Data integrity</option>
                                            <option value="SOP Instruction">SOP Instruction</option>
                                            <option value="BMR/ECR Instruction">BMR/ECR Instruction</option>
                                            <option value="Water System">Water System</option>
                                            <option value="Anyother(specify)">Any other (specify) </option>
                                        </select>
                                    </div>
                                </div> --}}


                                <div class="col-lg-6" id="others_block" style="display: none;">
                                    <div class="group-input">
                                        <label for="others">Others <span id="asteriskInviothers" style="display: none"
                                                class="text-danger">*</span></label>
                                        <input type="text" id="others" name="others" class="others">
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('audit_type');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('others');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }


                                        selectField.addEventListener('change', function() {
                                            // var isRequired = this.value === 'Anyother(specify)';
                                            var isRequired = this.value.includes('Anyother(specify)');
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            document.getElementById('others_block').style.display = isRequired ? 'block' : 'none';

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskInviothers');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Facility/Equipment"> Facility/ Equipment/ Instrument/ System Details
                                            Required?</label>
                                        <select name="Facility_Equipment" id="Facility_Equipment">
                                            <option value="">--Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>

                                        </select>
                                    </div>
                                    @error('Facility_Equipment')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="group-input" id="facilityRow" style="display: none">
                                    <label for="audit-agenda-grid">
                                        Facility/ Equipment/ Instrument/ System Details
                                        <button type="button" name="audit-agenda-grid" id="ObservationAdd">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="onservation-field-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 4%">Row#</th>
                                                    <th style="width: 12%">Name</th>
                                                    <th style="width: 16%"> ID Number</th>
                                                    <th style="width: 15%">Remarks</th>
                                                    <th style="width: 8%">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial[]" value="1"></td>
                                                <td> <select name="facility_name[]" id="facility_name"
                                                        class="facility-name">
                                                        <option value="">-- Select --</option>
                                                        <option value="Facility">Facility</option>
                                                        <option value="Equipment"> Equipment</option>
                                                        <option value="Instrument">Instrument</option>
                                                    </select> </td>
                                                <td><input type="text" name="IDnumber[]" class="id-number"></td>
                                                <td><input type="text" name="Remarks[]" class="remarks"></td>
                                                <td><input type="text" name="Action[]" class="action" readonly></td>

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Facility_Equipment');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('facility-name');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        // Add elements with class 'id-number' to inputsToToggle
                                        var idNumberInputs = document.getElementsByClassName('id-number');
                                        for (var j = 0; j < idNumberInputs.length; j++) {
                                            inputsToToggle.push(idNumberInputs[j]);
                                        }

                                        // Add elements with class 'remarks' to inputsToToggle
                                        var remarksInputs = document.getElementsByClassName('remarks');
                                        for (var k = 0; k < remarksInputs.length; k++) {
                                            inputsToToggle.push(remarksInputs[k]);
                                        }


                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            document.getElementById('facilityRow').style.display = isRequired ? 'block' : 'none';
                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskInvi');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Document Details Required">Document Details Required?</label>
                                        <select name=" Document_Details_Required" id="Document_Details_Required">
                                            <option value="">--Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="group-input" id="documentsRow" style="display: none">
                                    <label for="audit-agenda-grid">
                                        Document Details
                                        <button type="button" name="audit-agenda-grid" id="ReferenceDocument">+</button>

                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#document-details-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="ReferenceDocument_details"
                                            style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 4%">Row#</th>
                                                    <th style="width: 12%">Document Number</th>
                                                    <th style="width: 16%"> Reference Document Name</th>
                                                    <th style="width: 16%"> Remarks</th>

                                                    <th style="width: 8%"> Action</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial[]" value="1"></td>
                                                <td><input type="text" class="numberDetail" name="Number[]"></td>
                                                <td><input type="text" class="ReferenceDocumentName"
                                                        name="ReferenceDocumentName[]"></td>
                                                <td><input type="text" class="Document_Remarks"
                                                        name="Document_Remarks[]"></td>
                                                <td><input type="text" class="" name="Action[]" readonly></td>


                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // note-codable

                                        var selectField = document.getElementById('Document_Details_Required');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('numberDetail');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        // Add elements with class 'id-number' to inputsToToggle
                                        var idNumberInputs = document.getElementsByClassName('Document_Remarks');
                                        for (var j = 0; j < idNumberInputs.length; j++) {
                                            inputsToToggle.push(idNumberInputs[j]);
                                        }

                                        // Add elements with class 'remarks' to inputsToToggle
                                        var remarksInputs = document.getElementsByClassName('ReferenceDocumentName');
                                        for (var k = 0; k < remarksInputs.length; k++) {
                                            inputsToToggle.push(remarksInputs[k]);
                                        }


                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });


                                            document.getElementById('documentsRow').style.display = isRequired ? 'block' : 'none';
                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskInviDetails');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Product Details Required">Product/Batch Details Required?</label>
                                        <select name=" Product_Details_Required" id="Product_Details_Required">
                                            <option value="">--Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="group-input" id="productRow" style="display: none">
                                        <label for="audit-agenda-grid">
                                            Product/Batch Details
                                            <button type="button" name="audit-agenda-grid"
                                                id="Product_Details">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#product-batch-grid"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="Product_Details_Details"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 4%">Row#</th>
                                                        <th style="width: 12%">Product</th>
                                                        <th style="width: 16%"> Stage</th>
                                                        <th style="width: 16%">Batch No</th>
                                                        <th style="width: 8%">Action</th>



                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <td><input disabled type="text" name="serial[]" value="1">
                                                    </td>
                                                    <td><input type="text" class="productName" name="product_name[]">
                                                    </td>
                                                    <td>

                                                        <select name="product_stage[]" id="product_stage"
                                                            class="productStage">
                                                            <option value="">-- Select --</option>
                                                            <option value="">1</option>
                                                            <option value="">2</option>
                                                            <option value="">3</option>
                                                            <option value="">4</option>
                                                            <option value="">5</option>
                                                            <option value="">6</option>
                                                            <option value="">7</option>
                                                            <option value="">8</option>
                                                            <option value="">9</option>
                                                            <option value="">Final</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="productBatchNo" name="batch_no[]">
                                                    </td>
                                                    <td><input type="text" class="Removebtn" name="Action[]" readonly>
                                                    </td>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @error('product_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    @error('product_stage')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    @error('batch_no')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Product_Details_Required');
                                        var inputsToToggle = [];

                                        // Add elements with class 'productName' to inputsToToggle
                                        var productNameInputs = document.getElementsByClassName('productName');
                                        for (var i = 0; i < productNameInputs.length; i++) {
                                            inputsToToggle.push(productNameInputs[i]);
                                        }

                                        // Add elements with class 'productStage' to inputsToToggle
                                        var productStageInputs = document.getElementsByClassName('productStage');
                                        for (var j = 0; j < productStageInputs.length; j++) {
                                            inputsToToggle.push(productStageInputs[j]);
                                        }

                                        // Add elements with class 'productBatchNo' to inputsToToggle
                                        var productBatchNoInputs = document.getElementsByClassName('productBatchNo');
                                        for (var k = 0; k < productBatchNoInputs.length; k++) {
                                            inputsToToggle.push(productBatchNoInputs[k]);
                                        }


                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';
                                            console.log(this.value, isRequired, 'value');

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                                console.log(input.required, isRequired, 'input req');
                                            });

                                            document.getElementById('productRow').style.display = isRequired ? 'block' : 'none';
                                            var asteriskIcon = document.getElementById('asteriskInvi');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <!-- <div class="col-lg-6">
                                        <div class="group-input" id="external_agencies_req">
                                            <label for="others">HOD / Designee<span class="text-danger d-none">*</span></label>
                                          <select name="hod_designee" id="">
                                            <option value="">-- Select --</option>
                                            <option value="person1">person 1</option>
                                            <option value="person2">person 2</option>
                                          </select>



                                        </div>
                          </div> -->
                                <!-- <div class="col-lg-6">
                                        <div class="group-input" id="external_agencies_req">
                                            <label for="others">Head QA / Designee<span class="text-danger d-none">*</span></label>
                                          <select name="hod_designee" id="">
                                            <option value="">-- Select --</option>
                                            <option value="person1">person 1</option>
                                            <option value="person2">person 2</option>
                                          </select>



                                        </div>
                          </div> -->
                                <!-- <div class="col-lg-6">
                                        <div class="group-input" id="external_agencies_req">
                                            <label for="others">QA<span class="text-danger d-none">*</span></label>
                                          <select name="hod_designee" id="">
                                            <option value="">-- Select --</option>
                                            <option value="person1">person 1</option>
                                            <option value="person2">person 2</option>
                                          </select>


                                        </div>
                          </div> -->
                                <!-- <div class="col-6">
                                        <div class="group-input">
                                            <label for="Facility Name">Notify To</label>
                                            <select multiple name="Facility[]" placeholder="Select Facility Name"
                                                data-search="false" data-silent-initial-value-set="true" id="Facility">
                                                <option value="Plant 1"> 1</option>
                                                <option value="Plant 1"> 2</option>
                                                <option value="Plant 1"> 3</option>

                                            </select>
                                        </div>
                                    </div> -->

                                {{-- <div class="col-6">
                                    <div class="group-input">
                                        <label for="Description Deviation">Description of Deviation</label>
                                        <textarea class="" id="Description_Deviation" name="Description_Deviation[]"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Description Deviation">Description of Deviation</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Description_Deviation[]" id="summernote-1" required>
                                    </textarea>
                                    </div>
                                    @error('Description_Deviation[]')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="col-6">
                                <div class="group-input">
                                        <label for="ImmediateAction">Immediate Action (if any)</label>
                                        <textarea class="" id="Immediate_Action" name="Immediate_Action[]"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Immediate Action">Immediate Action (if any)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Immediate_Action[]" id="summernote-2"required>
                                    </textarea>
                                    </div>
                                    @error('record')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="col-6">
                                <div class="group-input">
                                        <label for="Preliminary Impact">Preliminary Impact of Deviation</label>
                                        <textarea class="" id="Preliminary_Impact" name="Preliminary_Impact[]"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Preliminary Impact">Preliminary Impact of Deviation </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Preliminary_Impact[]" id="summernote-3" required>
                                    </textarea>
                                    </div>
                                    @error('Preliminary_Impact')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Initial Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Audit_file"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="HOD_Attachments" name="Audit_file[]"
                                                    oninput="addMultipleFiles(this, 'Audit_file')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">

                                <button style=" justify-content: center; width: 4rem; margin-left: 1px;" type="submit"
                                    id="ChangesaveButton0011" onclick="submitForm()"
                                    class="saveButton saveAuditFormBtn d-flex" style="align-items: center;">
                                    <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none"
                                        role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Save
                                </button>
                                <button style=" justify-content: center; width: 4rem; margin-left: 1px;" type="button"
                                    id="ChangeNextButton" class="nextButton">Next</button>
                                <button style=" justify-content: center; width: 4rem; margin-left: 1px;"type="button"> <a
                                        href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a> </button>

                            </div>
                        </div>
                    </div>


                    <!-- ----------hod Review-------- -->
                    <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">


                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="HOD Remarks">HOD Remarks</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="HOD_Remarks" id="summernote-4">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">HOD Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Audit_file"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="HOD_Attachments" name="Audit_file[]"
                                                    oninput="addMultipleFiles(this, 'Audit_file')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="button-block">
                                <button type="submit" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="saveButton">Save </button>
                                <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="backButton">Back</button>
                                </a>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                                        <!-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;" type="button"
                                        class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#launch_extension">
                                        Launch Extension
                                    </a> -->
                                    {{-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#effectivenss_extension">
                                        Launch Effectiveness Check
                                    </a> --}}
                            </div>
                        </div>
                    </div>
                    <!-- QA Initial reVIEW -->
                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">




                                <script>
                                    handleInvestigationRequiredChange();


                                    function handleInvestigationRequiredChange() {
                                        var investigationSelect = document.getElementById("Investigation_required");
                                        var investigationButton = document.getElementById("Investigation_button");

                                        // Get the selected value of the Investigation Required dropdown
                                        var investigationRequired = investigationSelect.value;

                                        // Check if Investigation Required is "Yes"
                                        if (investigationRequired === "yes") {
                                            // Show the Investigation button
                                            investigationButton.style.display = "display";
                                        } else {
                                            // Hide the Investigation button
                                            investigationButton.style.display = "none";
                                        }
                                    }

                                    // Call the function initially to set the initial visibility of the button




                                    // Function to handle the change event of the Initial Deviation Category dropdown
                                    function handleDeviationCategoryChange() {
                                        var selectElement = document.getElementById("Deviation_category");
                                        var selectedOption = selectElement.options[selectElement.selectedIndex].value;

                                        // var investigationSelect = document.getElementById("Investigation_required");

                                        // var investigationButton = document.getElementById("Investigation_button");

                                        // var selectedOptn = investigationSelect.options[investigationSelect.selectedIndex].value;


                                        //   if(selectedOptn=== "yes"){

                                        //     document.getElementById("Investigation_button").style.display = "block";

                                        //     }
                                        //     else{
                                        //     document.getElementById("Investigation_button").style.display = "none";


                                        //     }

                                        // Get the selected values
                                        // var investigationRequired = investigationSelect.value;

                                        // Check if the selected option is "Major" or "Critical"
                                        if (selectedOption === "major" || selectedOption === "critical") {
                                            // If "Major" or "Critical" is selected, set default value to "yes" for all Investigation, CAPA, and QRM fields
                                            document.getElementById("Investigation_required").value = "yes";
                                            document.getElementById("capa_required").value = "yes";
                                            document.getElementById("qrm_required").value = "yes";

                                            // Show the Investigation, CAPA, and QRM buttons
                                            document.getElementById("Investigation_button").style.display = "block";
                                            document.getElementById("CAPA_button").style.display = "block";
                                            document.getElementById("QRM_button").style.display = "block";
                                        } else {
                                            // If any other option is selected, set default value to "select" for all Investigation, CAPA, and QRM fields
                                            document.getElementById("Investigation_required").value = "select";
                                            document.getElementById("capa_required").value = "select";
                                            document.getElementById("qrm_required").value = "select";

                                            // Hide the Investigation, CAPA, and QRM buttons
                                            document.getElementById("Investigation_button").style.display = "none";
                                            document.getElementById("CAPA_button").style.display = "none";
                                            document.getElementById("QRM_button").style.display = "none";



                                        }

                                    }
                                </script>




                                <div style="margin-bottom: 0px;" class="col-lg-12 new-date-data-field ">
                                    <div class="group-input input-date">
                                        <label for="Deviation_category">Initial Deviation Category</label>
                                        <select name="Deviation_category" id="Deviation_category" disabled
                                            onchange="handleDeviationCategoryChange()">
                                            <option value="0">-- Select -- </option>
                                            <option value="minor">Minor </option>
                                            <option value="major">Major </option>
                                            <option value="critical">Critical </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Investigation required">Investigation Required ?</label>
                                        <select name="Investigation_required" id="Investigation_required" disabled>
                                            <option value="select">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="capa_required"> CAPA Required ?</label>
                                        <select name="capa_required" id="capa_required" disabled>
                                            <option value="select">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="qrm_required">QRM Required ?</label>
                                        <select name="qrm_required" id="qrm_required" disabled>
                                            <option value="select">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Justification for Categorization">Justification for
                                            Categorization</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Justification_for_categorization" id="summernote-5">
                                    </textarea>
                                    </div>
                                </div>

                                <!-- {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Product/Material Name">Investigation Details </label>
                                        <textarea class="" name="Investigation_Details" id="" cols="30" ></textarea>

                                    </div>
                                </div> --}} -->
                                <div class="col-md-12 mb-3">
                                    <div class="group-input" id="Investigations_details">
                                        <label for="Investigation Details">Investigation Details<span
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class=" Investigation_Details" name="Investigation_Details" id="summernote-6">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="QAInitialRemark">QA Initial Remarks</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="QAInitialRemark" id="summernote-7">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="QA Initial Attachments">QA Initial Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Initial_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="saveButton">Save</button>
                                <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <button type="button"  class="backButton">Back</button>
                                </a>

                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"  class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                                        <!-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;" type="button"
                                        class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#launch_extension">
                                        Launch Extension
                                    </a> -->
                                    {{-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#effectivenss_extension">
                                        Launch Effectiveness Check
                                    </a> --}}
                            </div>
                        </div>
                    </div>
                    <script>
                        // This is a JQuery used for showing the Investigation

                        $(document).ready(function() {
                            $('#Deviation_category, #Investigation_required, #qrm_required, #capa_required').change(
                                function() {
                                    // Get the selected values
                                    var deviationCategory = $('#Deviation_category').val();
                                    var investigationRequired = $('#Investigation_required').val();
                                    var capaRequired = $('#capa_required').val();
                                    var qrmRequired = $('#qrm_required').val();


                                    // Check if both conditions are met
                                    if (investigationRequired === 'yes') {
                                        $('#Investigation_button').show(); // Show the investigation button
                                    } else {
                                        $('#Investigation_button').hide(); // Hide the investigation button
                                    }
                                    //CAPA condition
                                    if (capaRequired === 'yes') {
                                        $('#CAPA_button').show(); // Show the investigation button
                                    } else {
                                        $('#CAPA_button').hide(); // Hide the investigation button
                                    }
                                    //QRMCon
                                    if (qrmRequired === 'yes') {
                                        $('#QRM_button').show(); // Show the investigation button
                                    } else {
                                        $('#QRM_button').hide(); // Hide the investigation button
                                    }
                                });
                        });



                        //                           $(document).ready(function () {
                        //                             $('#Investigation_required').change(function () {
                        //                                 var selectedValues = $(this).val();

                        // Investigation_required
                        //                                 if (selectedValues === 'major' || selectedValues === 'critical') {
                        //                                     $('#Investigation_required').val('yes').prop('disabled', true);
                        //                                     $('#capa_required').val('yes').prop('disabled', true);
                        //                                     $('#qrm_required').val('yes').prop('disabled', true);

                        //                                 } else {
                        //                                     $('#Investigation_required').prop('disabled', false);
                        //                                     $('#qrm_required').prop('disabled', false);
                        //                                     $('#capa_required').prop('disabled', false);
                        //                                 }

                        //                             });
                        //                         });



                        $(document).ready(function() {
                            $('#Deviation_category').change(function() {
                                var selectedValues = $(this).val();

                                if (selectedValues === 'major' || selectedValues === 'critical') {
                                    $('#Investigation_required').val('yes').prop('disabled', true);
                                    $('#capa_required').val('yes').prop('disabled', true);
                                    $('#qrm_required').val('yes').prop('disabled', true);

                                } else {
                                    $('#Investigation_required').prop('disabled', false);
                                    $('#qrm_required').prop('disabled', false);
                                    $('#capa_required').prop('disabled', false);
                                }

                            });
                        });

                        $(document).ready(function() {


                            $('#Deviation_category').change(function() {
                                if ($(this).val() === 'major') {
                                    $('#Investigation_required').val('yes').prop('disabled', true);


                                    $('#Investigations_details').show();
                                    $('textarea[name="Investigations_details"]').prop('required', true);

                                    $('#Customer_notification').val('yes').prop('disabled', true);
                                    $('#customer_option').show();
                                    $('textarea[name="customer_option"]').prop('required', true);
                                } else {
                                    $('#Customer_notification').prop('disabled', false);
                                    $('#customer_option').hide();
                                    $('textarea[name="customer_option"]').prop('required', false);
                                    $('#Investigation_required').prop('disabled', false);


                                    $('#Investigations_details').hide();
                                    $('textarea[name="Investigations_details"]').prop('required', false);
                                }
                                // if ($(this).val() === 'major') {
                                //     $('#Investigation_required').val('yes');
                                //     $('#Customer_notification').val('yes');
                                // }
                            });
                        });
                        $(document).ready(function() {
                            $('#Investigation_required').change(function() {
                                var selectedValue = $(this).val();
                                if (selectedValue === 'yes') {
                                    $('#Investigations_details').show();
                                    $('textarea[name="Investigations_details"]').prop('required', true);
                                } else {
                                    $('#Investigations_details').hide();
                                    $('textarea[name="Investigations_details"]').prop('required', false);
                                }
                            });

                            // Trigger change event on page load if already selected value is "Recurring"
                            $('#Investigation_required').change();
                        });
                        $(document).ready(function() {
                            $('#Customer_notification').change(function() {
                                var selectedValue = $(this).val();
                                if (selectedValue === 'yes') {
                                    $('#customer_option').show();
                                    $('textarea[name="customer_option"]').prop('required', true);
                                } else {
                                    $('#customer_option').hide();
                                    $('textarea[name="customer_option"]').prop('required', false);
                                }
                            });

                            // Trigger change event on page load if already selected value is "Recurring"
                            $('#Customer_notification').change();
                        });
                    </script>
                    {{-- <script>
                        $(document).ready(function () {
                            // Event listener for Investigation_required dropdown
                            $('#Investigation_required').change(function () {
                                if ($(this).val() === 'yes') {
                                    // If "Yes" is selected, make Investigation_Details field required
                                    $('.Investigation_Details').prop('required', true);
                                } else {
                                    // If "No" or any other option is selected, remove the required attribute
                                    $('.Investigation_Details').prop('required', false);
                                    // Hide error message when not required
                                    $('.error-message').hide();
                                }
                            });

                            // Event listener for Investigation_Details field
                            $('.Investigation_Details').blur(function () {
                                // Check if the field is empty and required
                                if ($(this).prop('required') && $(this).val().trim() === '') {
                                    // Show error message if empty
                                    $('.error-message').show();
                                } else {
                                    // Hide error message if not empty
                                    $('.error-message').hide();
                                }
                            });

                            // Initial check when page loads
                            if ($('#Investigation_required').val() === 'yes') {
                                $('.Investigation_Details').prop('required', true);
                            }
                        });
                    </script>
                    <script>
                        $(document).ready(function () {
                            // Event listener for Customer_notification dropdown
                            $('#Customer_notification').change(function () {
                                if ($(this).val() === 'yes') {
                                    // If "Yes" is selected, make Investigation_Details field required
                                    $('#customers').prop('required', true);
                                } else {
                                    // If "No" or any other option is selected, remove the required attribute
                                    $('#customers').prop('required', false);
                                    // Hide error message when not required
                                    $('.error-message').hide();
                                }
                            });

                            // Event listener for Investigation_Details field
                            $('#customers').blur(function () {
                                // Check if the field is empty and required
                                if ($(this).prop('required') && $(this).val().trim() === '') {
                                    // Show error message if empty
                                    $('.error-message').show();
                                } else {
                                    // Hide error message if not empty
                                    $('.error-message').hide();
                                }
                            });

                            // Initial check when page loads
                            if ($('#Customer_notification').val() === 'yes') {
                                $('#customers').prop('required', true);
                            }
                        });
                    </script> --}}
                    <!-- CFT -->
                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">
                                    Production
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.p_erson').hide();

                                        $('[name="Production_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.p_erson').show();
                                                $('.p_erson span').show();
                                            } else {
                                                $('.p_erson').hide();
                                                $('.p_erson span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Review">Production Review Required ?</label>
                                        <select name="Production_Review" id="Production_Review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp

                                <div class="col-lg-6 p_erson">
                                    <div class="group-input">
                                        <label for="Production person">Production Person</label>
                                        <select name="Production_person" id="Production_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 p_erson" >
                                    <div class="group-input">
                                        <label for="Production assessment">Impact Assessment (By Production)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="Production_assessment" id="summernote-17">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 p_erson">
                                    <div class="group-input">
                                        <label for="Production feedback">Production Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="Production_feedback" id="summernote-18">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 p_erson">
                                    <div class="group-input">
                                        <label for="production attachment"> Production Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="production_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="production_attachment[]"
                                                    oninput="addMultipleFiles(this, 'production_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 p_erson">
                                    <div class="group-input">
                                        <label for="Production Review Completed By">Production Review Completed By</label>
                                        <input disabled type="text" name="production_by" id="production_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field p_erson">
                                    <div class="group-input input-date">
                                        <label for="Production Review Completed On">Production Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="production_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="production_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'production_on')" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.warehouse').hide();

                                        $('[name="Warehouse_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.warehouse').show();
                                                $('.warehouse span').show();
                                            } else {
                                                $('.warehouse').hide();
                                                $('.warehouse span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Warehouse
                                </div>
                                <div class="col-lg-6 ">
                                    <div class="group-input">
                                        <label for="Warehouse Review Required">Warehouse Review Required ?</label>
                                        <select name="Warehouse_review" id="Warehouse_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 23, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 warehouse">
                                    <div class="group-input">
                                        <label for="Customer notification">Warehouse Person</label>
                                        <select name="Warehouse_notification" id="Warehouse_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 warehouse">
                                    <div class="group-input">
                                        <label for="Impact Assessment1">Impact Assessment (By Warehouse)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="Warehouse_assessment" id="summernote-19">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 warehouse">
                                    <div class="group-input">
                                        <label for="productionfeedback">Warehouse Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="Warehouse_feedback" id="summernote-20">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 warehouse">
                                    <div class="group-input">
                                        <label for="Warehouse attachment"> Warehouse Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Warehouse_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Warehouse_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Warehouse_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 warehouse">
                                    <div class="group-input">
                                        <label for="Warehousefeedback">Warehouse Review Completed By</label>
                                        <input disabled type="text" name="Warehouse_by" id="Warehouse_by">

                                    </div>
                                </div>

                                <div class="col-lg-6 new-date-data-field warehouse">
                                    <div class="group-input input-date">
                                        <label for="Warehouse Review Completed On">Warehouse Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Warehouse_on" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Warehouse_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Warehouse_on')" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.quality_control').hide();

                                        $('[name="Quality_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.quality_control').show();
                                                $('.quality_control span').show();
                                            } else {
                                                $('.quality_control').hide();
                                                $('.quality_control span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Quality Control
                                </div>
                                <div class="col-lg-6 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Review Required">Quality Control Review Required
                                            ?</label>
                                        <select name="Quality_review" id="Quality_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 24, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control Person">Quality Control Person</label>
                                        <select name="Quality_Control_Person" id="Quality_Control_Person" disabled>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_control">
                                    <div class="group-input">
                                        <label for="Impact Assessment2">Impact Assessment (By Quality Control)</label>
                                        <textarea class="" name="Quality_Control_assessment" id="summernote-21">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Feedback">Quality Control Feedback</label>
                                        <textarea class="" name="Quality_Control_feedback" id="summernote-22">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Attachments">Quality Control Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Quality_Control_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Quality_Control_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Control_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 quality_control">
                                    <div class="group-input">
                                        <label for="productionfeedback">Quality Control Review Completed By</label>
                                        <input type="text" name="QualityAssurance__by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field quality_control">
                                    <div class="group-input input-date">
                                        <label for="Quality Control Review Completed On">Quality Control Review Completed
                                            On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Quality_Control_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Quality_Control_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Quality_Control_on')" />
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('.quality_assurance').hide();

                                        $('[name="Quality_Assurance"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.quality_assurance').show();
                                                $('.quality_assurance span').show();
                                            } else {
                                                $('.quality_assurance').hide();
                                                $('.quality_assurance span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Quality Assurance
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Quality Assurance Review Required ?</label>
                                        <select name="Quality_Assurance" id="QualityAssurance_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 25, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Person">Quality Assurance Person</label>
                                        <select name="QualityAssurance_person" id="QualityAssurance_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Impact Assessment3">Impact Assessment (By Quality Assurance)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="QualityAssurance_assessment" id="summernote-23">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Feedback">Quality Assurance Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="QualityAssurance_feedback" id="summernote-24">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Attachments">Quality Assurance Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Quality_Assurance_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Quality_Assurance_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Completed By">Quality Assurance Review
                                            Completed By</label>
                                        <input type="text" name="QualityAssurance_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field quality_assurance">
                                    <div class="group-input input-date">
                                        <label for="Quality Assurance Review Completed On">Quality Assurance Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="QualityAssurance_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="QualityAssurance_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'QualityAssurance_on')" />
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('.engineering').hide();

                                        $('[name="Engineering_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.engineering').show();
                                                $('.engineering span').show();
                                            } else {
                                                $('.engineering').hide();
                                                $('.engineering span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Engineering
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Engineering Review Required">Engineering Review Required ?</label>
                                        <select name="Engineering_review" id="Engineering_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 26, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 engineering">
                                    <div class="group-input">
                                        <label for="Engineering Person">Engineering Person</label>
                                        <select name="Engineering_person" id="Engineering_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 engineering">
                                    <div class="group-input">
                                        <label for="Impact Assessment4">Impact Assessment (By Engineering)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="Engineering_assessment" id="summernote-25">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 engineering">
                                    <div class="group-input">
                                        <label for="productionfeedback">Engineering Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="Engineering_feedback" id="summernote-26">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 engineering">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Engineering Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Engineering_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Engineering_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Engineering_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 engineering">
                                    <div class="group-input">
                                        <label for="Engineering Review Completed By">Engineering Review Completed
                                            By</label>
                                        <input type="text" name="Engineering_by" id="Engineering_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field engineering">
                                    <div class="group-input input-date">
                                        <label for="Engineering Review Completed On">Engineering Review Completed
                                            On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Engineering_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Engineering_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Engineering_on')" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.analytical_development').hide();

                                        $('[name="Analytical_Development_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.analytical_development').show();
                                                $('.analytical_development span').show();
                                            } else {
                                                $('.analytical_development').hide();
                                                $('.analytical_development span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Analytical Development Laboratory
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Required">Analytical
                                            Development Laboratory Review Required ?</label>
                                        <select name="Analytical_Development_review" id="Analytical_Development_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 27, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 analytical_development">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Person">Analytical Development
                                            Laboratory Person</label>
                                        <select name="Analytical_Development_person" id="Analytical_Development_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 analytical_development">
                                    <div class="group-input">
                                        <label for="Impact Assessment5">Impact Assessment (By Analytical Development
                                            Laboratory)</label>
                                        <textarea class="" name="Analytical_Development_assessment" id="summernote-27">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 analytical_development">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Feedback"> Analytical Development
                                            Laboratory Feedback</label>
                                        <textarea class="" name="Analytical_Development_feedback" id="summernote-28">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 analytical_development">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Analytical Development Laboratory
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Analytical_Development_attachment">
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Analytical_Development_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Analytical_Development_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 analytical_development">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Completed By">Analytical
                                            Development Laboratory Review Completed By</label>
                                        <input type="text" name="Analytical_Development_by"
                                            id="Analytical_Development_by" disabled>

                                    </div>
                                </div>
                                {{-- <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Completed On">Analytical Development Laboratory Review Completed On</label>
                                        <input type="date" name="Analytical_Development_on" disabled>

                                    </div>
                                </div> --}}
                                <div class="col-lg-6 new-date-data-field analytical_development">
                                    <div class="group-input input-date">
                                        <label for="Analytical Development Laboratory Review Completed On">Analytical
                                            Development Laboratory Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Analytical_Development_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Analytical_Development_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Analytical_Development_on')" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.kilo_lab').hide();

                                        $('[name="Kilo_Lab_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.kilo_lab').show();
                                                $('.kilo_lab span').show();
                                            } else {
                                                $('.kilo_lab').hide();
                                                $('.kilo_lab span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Process Development Laboratory / Kilo Lab
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Process Development Laboratory"> Process Development Laboratory / Kilo
                                            Lab Review Required ?</label>
                                        <select name="Kilo_Lab_review" id="Kilo_Lab_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 28, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 kilo_lab">
                                    <div class="group-input">
                                        <label for="Process Development Laboratory"> Process Development Laboratory / Kilo
                                            Lab Person</label>
                                        <select name="Kilo_Lab_person" id="Kilo_Lab_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach


                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 kilo_lab">
                                    <div class="group-input">
                                        <label for="Impact Assessment6">Impact Assessment (By Process Development
                                            Laboratory / Kilo Lab)</label>
                                        <textarea class="" name="Kilo_Lab_assessment" id="summernote-29">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 kilo_lab">
                                    <div class="group-input">
                                        <label for="Kilo Lab Feedback"> Process Development Laboratory / Kilo Lab
                                            Feedback</label>
                                        <textarea class="" name="Kilo_Lab_feedback" id="summernote-30">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 kilo_lab">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Process Development Laboratory / Kilo Lab
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Kilo_Lab_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Kilo_Lab_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Kilo_Lab_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 kilo_lab">
                                    <div class="group-input">
                                        <label for="Kilo Lab Review Completed By">Process Development Laboratory / Kilo
                                            Lab Review Completed By</label>
                                        <input type="text" name="Kilo_Lab_attachment_by"
                                            id="Kilo_Lab_attachment_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field kilo_lab">
                                    <div class="group-input input-date">
                                        <label for="Kilo Lab Review Completed On">Process Development Laboratory / Kilo
                                            Lab Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Kilo_Lab_attachment_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Kilo_Lab_attachment_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Kilo_Lab_attachment_on')" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.technology_transfer').hide();

                                        $('[name="Technology_transfer_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.technology_transfer').show();
                                                $('.technology_transfer span').show();
                                            } else {
                                                $('.technology_transfer').hide();
                                                $('.technology_transfer span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Technology Transfer / Design
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Design Review Required">Technology Transfer / Design Review Required
                                            ?</label>
                                        <select name="Technology_transfer_review" id="Technology_transfer_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 29, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 technology_transfer">
                                    <div class="group-input">
                                        <label for="Design Person"> Technology Transfer / Design Person</label>
                                        <select name="Technology_transfer_person" id="Technology_transfer_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach


                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 technology_transfer">
                                    <div class="group-input">
                                        <label for="Impact Assessment7">Impact Assessment (By Technology Transfer /
                                            Design)</label>
                                        <textarea class="" name="Technology_transfer_assessment" id="summernote-31">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 technology_transfer">
                                    <div class="group-input">
                                        <label for="Design Feedback"> Technology Transfer / Design Feedback</label>
                                        <textarea class="" name="Technology_transfer_feedback" id="summernote-32">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 technology_transfer">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Technology Transfer / Design Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Technology_transfer_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Technology_transfer_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Technology_transfer_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 technology_transfer">
                                    <div class="group-input">
                                        <label for="Design Review Completed By">Technology Transfer / Design Review
                                            Completed By</label>
                                        <input type="text" name="Technology_transfer_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field technology_transfer">
                                    <div class="group-input input-date">
                                        <label for="Design Review Completed On">Technology Transfer / Design Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Technology_transfer_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Technology_transfer_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Technology_transfer_on')" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.environmental_health').hide();

                                        $('[name="Environment_Health_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.environmental_health').show();
                                                $('.environmental_health span').show();
                                            } else {
                                                $('.environmental_health').hide();
                                                $('.environmental_health span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Environment, Health & Safety
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Safety Review Required">Environment, Health & Safety Review Required
                                            ?</label>
                                        <select name="Environment_Health_review" id="Environment_Health_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 30, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 environmental_health">
                                    <div class="group-input">
                                        <label for="Safety Person"> Environment, Health & Safety Person</label>
                                        <select name="Environment_Health_Safety_person"
                                            id="Environment_Health_Safety_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="Impact Assessment8">Impact Assessment (By Environment, Health &
                                            Safety)</label>
                                        <textarea class="" name="Health_Safety_assessment" id="summernote-33">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="productionfeedback">Environment, Health & Safety Feedback</label>
                                        <textarea class="" name="Health_Safety_feedback" id="summernote-34">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 environmental_health">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Environment, Health & Safety Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Environment_Health_Safety_attachment">
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Environment_Health_Safety_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="productionfeedback">Environment, Health & Safety Review Completed
                                            By</label>
                                        <input type="text" name="Environment_Health_Safety_by"
                                            id="Environment_Health_Safety_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field environmental_health">
                                    <div class="group-input input-date">
                                        <label for="Safety Review Completed On">Environment, Health & Safety Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Environment_Health_Safety_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Environment_Health_Safety_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Environment_Health_Safety_on')" />
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('.human_resources').hide();

                                        $('[name="Human_Resource_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.human_resources').show();
                                                $('.human_resources span').show();
                                            } else {
                                                $('.human_resources').hide();
                                                $('.human_resources span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Human Resource & Administration
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Administration Review Required">Human Resource & Administration Review
                                            Required ?</label>
                                        <select name="Human_Resource_review" id="Human_Resource_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 31, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 human_resources" >
                                    <div class="group-input">
                                        <label for="Administration Person"> Human Resource & Administration Person</label>
                                        <select name="Human_Resource_person" id="Human_Resource_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach


                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="Impact Assessment9">Impact Assessment (By Human Resource &
                                            Administration )</label>
                                        <textarea class="" name="Human_Resource_assessment" id="summernote-35">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="productionfeedback">Human Resource & Administration Feedback</label>
                                        <textarea class="" name="Human_Resource_feedback" id="summernote-36">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 human_resources">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Human Resource & Administration
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Human_Resource_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Human_Resource_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Human_Resource_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="Administration Review Completed By"> Human Resource & Administration
                                            Review Completed By</label>
                                        <input type="text" name="Human_Resource_by" id="Human_Resource_by"
                                            disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field human_resources">
                                    <div class="group-input input-date">
                                        <label for="Administration Review Completed On">Human Resource & Administration
                                            Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Human_Resource_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Human_Resource_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Human_Resource_on')" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.information_technology').hide();

                                        $('[name="Information_Technology_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.information_technology').show();
                                                $('.information_technology span').show();
                                            } else {
                                                $('.information_technology').hide();
                                                $('.information_technology span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Information Technology
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Information Technology Review Required"> Information Technology Review
                                            Required ?</label>
                                        <select name=" Information_Technology_review"
                                            id=" Information_Technology_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 32, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 information_technology">
                                    <div class="group-input">
                                        <label for="Information Technology Person"> Information Technology Person</label>
                                        <select name=" Information_Technology_person"
                                            id=" Information_Technology_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 information_technology">
                                    <div class="group-input">
                                        <label for="Impact Assessment10">Impact Assessment (By Information
                                            Technology)</label>
                                        <textarea class="" name="Information_Technology_assessment" id="summernote-37">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 information_technology">
                                    <div class="group-input">
                                        <label for="Information Technology Feedback"> Information Technology
                                            Feedback</label>
                                        <textarea class="" name="Information_Technology_feedback" id="summernote-38">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 information_technology">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Information Technology Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Information_Technology_attachment">
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Information_Technology_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Information_Technology_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 information_technology">
                                    <div class="group-input">
                                        <label for="Information Technology Review Completed By"> Information Technology
                                            Review Completed By</label>
                                        <input type="text" name="Information_Technology_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field information_technology">
                                    <div class="group-input input-date">
                                        <label for="Information Technology Review Completed On">Information Technology
                                            Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Information_Technology_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Information_Technology_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Information_Technology_on')" />
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('.project_management').hide();

                                        $('[name="Project_management_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.project_management').show();
                                                $('.project_management span').show();
                                            } else {
                                                $('.project_management').hide();
                                                $('.project_management span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Project Management
                                </div>
                                <div class="col-lg-6 project_management">
                                    <div class="group-input">
                                        <label for="Project management Review Required"> Project management Review
                                            Required ?</label>
                                        <select name="Project_management_review" id="Project_management_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 33, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 project_management">
                                    <div class="group-input">
                                        <label for="Project management Person"> Project management Person</label>
                                        <select name="Project_management_person" id="Project_management_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach


                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 project_management">
                                    <div class="group-input">
                                        <label for="Impact Assessment11">Impact Assessment (By Project management
                                            )</label>
                                        <textarea class="" name="Project_management_assessment" id="summernote-39">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 project_management">
                                    <div class="group-input">
                                        <label for="Project management Feedback"> Project management Feedback</label>
                                        <textarea class="" name="Project_management_feedback" id="summernote-40">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 project_management">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Project management Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Project_management_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Project_management_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Project_management_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 project_management">
                                    <div class="group-input">
                                        <label for="Project management Review Completed By"> Project management Review
                                            Completed By</label>
                                        <input type="text" name="Project_management_by"id="Project_management_by"
                                            disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field project_management">
                                    <div class="group-input input-date">
                                        <label for="Project management Review Completed On">Information Technology Review
                                            Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Project_management_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Project_management_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Project_management_on')" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.other1_reviews').hide();

                                        $('[name="Other1_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.other1_reviews').show();
                                                $('.other1_reviews span').show();
                                            } else {
                                                $('.other1_reviews').hide();
                                                $('.other1_reviews span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Other's 1 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 1 Review Required ?</label>
                                        <select name="Other1_review" id="Other1_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 34, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 other1_reviews">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 1 Person</label>
                                        <select name="Other1_person" id="Other1_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 other1_reviews">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 1 Department</label>
                                        <select name="Other1_Department_person" id="Other1_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                                Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety
                                            </option>
                                            <option value="Human Resource & Administration">Human Resource &
                                                Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option>



                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 other1_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Other's 1)</label>
                                        <textarea class="" name="Other1_assessment" id="summernote-41">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 other1_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 1 Feedback</label>
                                        <textarea class="" name="Other1_feedback" id="summernote-42">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 other1_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 1 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other1_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Other1_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other1_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 other1_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 1 Review Completed By</label>
                                        <input type="text" name="Other1_by" id="Other1_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field other1_reviews">
                                    <div class="group-input input-date">
                                        <label for="Review Completed On1">Other's 1 Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other1_on" name="Other1_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.Other2_reviews').hide();

                                        $('[name="Other2_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.Other2_reviews').show();
                                                $('.Other2_reviews span').show();
                                            } else {
                                                $('.Other2_reviews').hide();
                                                $('.Other2_reviews span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Other's 2 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6 ">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 2 Review Required ?</label>
                                        <select name="Other2_review" id="Other2_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 35, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 2 Person</label>
                                        <select name="Other2_person" id="Other2_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 2 Department</label>
                                        <select name="Other2_Department_person" id="Other2_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                                Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety
                                            </option>
                                            <option value="Human Resource & Administration">Human Resource &
                                                Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option>



                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment13">Impact Assessment (By Other's 2)</label>
                                        <textarea class="" name="Other2_Assessment" id="summernote-43">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Feedback2"> Other's 2 Feedback</label>
                                        <textarea class="" name="Other2_feedback" id="summernote-44">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 2 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other2_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Other2_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other2_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By2"> Other's 2 Review Completed By</label>
                                        <input type="text" name="Other2_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field Other2_reviews">
                                    <div class="group-input input-date">
                                        <label for="Review Completed On2">Other's 2 Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other2_on" name="Other2_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            {{-- <input type="date"  name="Other2_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                    oninput="handleDateInput(this, 'Other2_on')" /> --}}
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.Other3_reviews').hide();

                                        $('[name="Other3_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.Other3_reviews').show();
                                                $('.Other3_reviews span').show();
                                            } else {
                                                $('.Other3_reviews').hide();
                                                $('.Other3_reviews span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Other's 3 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 3 Review Required ?</label>
                                        <select name="Other3_review" id="Other3_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 36, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 3 Person</label>
                                        <select name="Other3_person" id="Other3_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other3_reviews ">
                                    <div class="group-input">
                                        <label for="Customer notification"> Other's 3 Department</label>
                                        <select name="Other3_Department_person" id="Other3_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                                Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety
                                            </option>
                                            <option value="Human Resource & Administration">Human Resource &
                                                Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option>



                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Other's 3)</label>
                                        <textarea class="" name="Other3_Assessment" id="summernote-45">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 3 Feedback</label>
                                        <textarea class="" name="Other3_feedback" id="summernote-46">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 3 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other3_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Other3_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other3_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 3 Review Completed By</label>
                                        <input type="text" name="Other3_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field Other3_reviews">
                                    <div class="group-input input-date">
                                        <label for="Review Completed On3">Other's 3 Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other3_on" name="Other3_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            {{-- <input type="date"  name="Other3_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                    oninput="handleDateInput(this, 'Other3_on')" /> --}}
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.Other4_reviews').hide();

                                        $('[name="Other4_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.Other4_reviews').show();
                                                $('.Other4_reviews span').show();
                                            } else {
                                                $('.Other4_reviews').hide();
                                                $('.Other4_reviews span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Other's 4 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review4"> Other's 4 Review Required ?</label>
                                        <select name="Other4_review" id="Other4_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 37, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Person4"> Other's 4 Person</label>
                                        <select name="Other4_person" id="Other4_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Department4"> Other's 4 Department</label>
                                        <select name="Other4_Department_person" id="Other4_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                                Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety
                                            </option>
                                            <option value="Human Resource & Administration">Human Resource &
                                                Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option>



                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment15">Impact Assessment (By Other's 4)</label>
                                        <textarea class="" name="Other4_Assessment" id="summernote-47">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="feedback4"> Other's 4 Feedback</label>
                                        <textarea class="" name="Other4_feedback" id="summernote-48">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 4 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other4_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Other4_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other4_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By4"> Other's 4 Review Completed By</label>
                                        <input type="text" name="Other4_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field Other4_reviews">
                                    <div class="group-input input-date">
                                        <label for="Review Completed On4">Other's 4 Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other4_on" name="Other4_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            {{-- <input type="date"  name="Other4_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                    oninput="handleDateInput(this, 'Other4_on')" /> --}}
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('.Other5_reviews').hide();

                                        $('[name="Other5_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.Other5_reviews').show();
                                                $('.Other5_reviews span').show();
                                            } else {
                                                $('.Other5_reviews').hide();
                                                $('.Other5_reviews span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="sub-head">
                                    Other's 5 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review5"> Other's 5 Review Required ?</label>
                                        <select name="Other5_review" id="Other5_review" disabled>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="na">NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $division = DB::table('q_m_s_divisions')
                                        ->where('name', Helpers::getDivisionName(session()->get('division')))
                                        ->first();
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 38, 'q_m_s_divisions_id' => $division->id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Person5">Other's 5 Person</label>
                                        <select name="Other5_person" id="Other5_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Department5"> Other's 5 Department</label>
                                        <select name="Other5_Department_person" id="Other5_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option value="Production">Production</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="Quality_Control">Quality Control</option>
                                            <option value="Quality_Assurance">Quality Assurance</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                                Lab</option>
                                            <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                            <option value="Environment, Health & Safety">Environment, Health & Safety
                                            </option>
                                            <option value="Human Resource & Administration">Human Resource &
                                                Administration</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Project management">Project management</option>



                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Other's 5)</label>
                                        <textarea class="" name="Other5_Assessment" id="summernote-49">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 5 Feedback</label>
                                        <textarea class="" name="Other5_feedback" id="summernote-50">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Other's 5 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Other5_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Other5_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other5_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By5"> Other's 5 Review Completed By</label>
                                        <input type="text" name="Other5_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field Other5_reviews">
                                    <div class="group-input input-date">
                                        <label for="Review Completed On5">Other's 5 Review Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other5_on" name="Other5_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            {{-- <input type="date"  name="Other5_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                    oninput="handleDateInput(this, 'Other5_on')" /> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="saveButton">Save</button>
                                <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <button type="button"  class="backButton">Back</button>
                                </a>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;" id="ChangeNextButton" class="nextButton"
                                    onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                                        <!-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;" type="button"
                                        class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#launch_extension">
                                        Launch Extension
                                    </a> -->
                                    {{-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#effectivenss_extension">
                                        Launch Effectiveness Check
                                    </a> --}}
                            </div>

                        </div>
                    </div>


                    <!-- investigation -->
                    <div id="CCForm9" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Investigation Summary">Description of Event</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Discription_Event" id="summernote-8">
                                </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment">Objective</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="objective" id="summernote-9">
                                </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Root Cause">Scope</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="scope" id="summernote-10">
                                </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Root Cause">Immediate Action</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="imidiate_action" id="summernote-10">
                                </textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="group-input" id="documentsRowna">
                                        <label for="audit-agenda-grid">
                                            Investigation team and Responsibilities
                                            <button type="button" name="audit-agenda-grid"
                                                id="investigation_Details">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#investigationn-team-responsibilities"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="investigation_Details_Details"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 4%">Row#</th>
                                                        <th style="width: 12%">Investigation Team</th>
                                                        <th style="width: 16%">Responsibility</th>
                                                        <th style="width: 16%">Remarks</th>
                                                        <th style="width: 8%">Action</th>



                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <td><input disabled type="text" name="serial[]" value="1">
                                                    </td>
                                                    <td> <select name="Investigation_team[]" id="">
                                                            <option value="">-- Select --</option>
                                                            <option value="">name</option>
                                                        </select> </td>
                                                    <td><input type="text" class="numberDetail"
                                                            name="Responsibility[]"></td>
                                                    <td><input type="text" class="Document_Remarks"
                                                            name="Remarks[]"></td>
                                                    <td><input type="text" class="Action" name="Action[]"></td>


                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    {{-- @error('Product_Batch')
                                    <div class="text-danger">{{ $message  }}</div>
                                @enderror --}}
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="audit type">Investigation Approach </label>
                                        <select multiple name="investigation_approach[]" id="investigation_approach">
                                            {{-- <option value="">Enter Your Selection Here</option> --}}
                                            <option value="Why-Why Chart">Why-Why Chart</option>
                                            <option value="Failure Mode and Efect Analysis">Failure Mode and Efect
                                                Analysis</option>
                                            <option value="Fishbone or Ishikawa Diagram">Fishbone or Ishikawa Diagram
                                            </option>
                                            <option value="Is/Is Not Analysis">Is/Is Not Analysis</option>
                                            <option value="Brainstorming">Brainstorming</option>


                                        </select>
                                    </div>
                                </div>



                                <div class="col-lg-12">
                                    <div class="group-input" id="documentsRowname">
                                        <label for="audit-agenda-grid">
                                            Root Cause
                                            <button type="button" name="audit-agenda-grid"
                                                id="root_cause_Details">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#root-cause"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="Root_cause_Details_Details"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 4%">Row#</th>
                                                        <th id="Root_Cause_Category" style="width: 12%">Root Cause
                                                            Category</th>
                                                        <th style="width: 16%" id="Root_Cause_Sub_Category">Root Cause
                                                            Sub-Category</th>
                                                        <th style="width: 16%">If Others</th>

                                                        <th style="width: 16%"> Probability</th>
                                                        <th style="width: 16%"> Remarks</th>

                                                        <th style="width: 8%">Action</th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <td><input disabled type="text" name="serial[]" value="1">
                                                    </td>
                                                    {{-- <td> <select name="Root_Cause_Category[]" id=""> <option value="">-- Select --</option><option value="">name   </option> </select></td> --}}
                                                    {{-- <td><select name="Root_Cause_Sub-Category[]" id=""><option value="">-- Select --</option><option value="">name</option>  </select></td> --}}
                                                    <td>

                                                        <select name="Root_Cause_Category[]"
                                                            id="Root_Cause_Category_Select">
                                                            <option value="">-- Select --</option>

                                                            <option value="M-Machine(Equipment)">M-Machine(Equipment)
                                                            </option>
                                                            <option value="">M-Maintenance</option>
                                                            <option value="">M-Man Power (physical work)</option>
                                                            <option value="">M-Management</option>
                                                            <option value="">M-Material (Raw,Consumables etc.)
                                                            </option>
                                                            <option value="">M-Method (Process/Inspection)</option>
                                                            <option value="">M-Mother Nature (Environment)</option>
                                                            <option value="">P-Place/Plant</option>
                                                            <option value="">P-Policies</option>
                                                            <option value="">P-Price </option>
                                                            <option value="">P-Procedures</option>
                                                            <option value="">P-Process </option>
                                                            <option value="">P-Product</option>
                                                            <option value="">S-Suppliers</option>
                                                            <option value="">S-Surroundings</option>
                                                            <option value="">S-Systems</option>

                                                        </select>
                                                    </td>
                                                    <td> <select name="Root_Cause_Sub_Category[]"
                                                            id="Root_Cause_Sub_Category_Select">
                                                            <option value="">-- Select --</option>

                                                            <option value="Poor_Maintenance_or_Design">Infrequent Audits
                                                            </option>
                                                            <option value="No_Preventive_Maintenance">No Preventive
                                                                Maintenance </option>
                                                            <option value="Other">Other</option>
                                                            <option value="Poor_Maintenance_or_Design">Poor Maintenance or
                                                                Design </option>
                                                            <option value="Maintenance_Needs_Improvement">Maintenance
                                                                Needs Improvement </option>
                                                            <option value="Scheduling_Problem">Scheduling Problem
                                                            </option>
                                                            <option value="system_deficiency">System Deficiency </option>
                                                            <option value="">Technical Error </option>
                                                            <option value="">Tolerable Failure </option>
                                                            <option value="">Calibration Issues </option>

                                                            <option value="Infrequent_Audits">Infrequent Audits</option>
                                                            <option value="No_Preventive_Maintenance">No Preventive
                                                                Maintenance </option>
                                                            <option value="Other">Other</option>
                                                            <option value="Maintenance_Needs_Improvement">Maintenance
                                                                Needs Improvement</option>
                                                            <option value="">Scheduling Problem </option>
                                                            <option value="">System Deficiency </option>
                                                            <option value="">Technical Error </option>
                                                            <option value="">Tolerable Failure </option>


                                                            <option value="Failure_to_Follow_SOP">Failure to Follow SOP
                                                            </option>
                                                            <option value="Human_Machine_Interface">Human-Machine
                                                                Interface</option>
                                                            <option value="Misunderstood_Verbal_Communication">
                                                                Misunderstood Verbal Communication </option>
                                                            <option value="Other">Other</option>
                                                            <option value="">Personnel Error</option>
                                                            <option value="">Personnel not Qualified</option>
                                                            <option value="">Practice Needed</option>
                                                            <option value="">Teamwork Needs Improvement</option>
                                                            <option value="">Attention</option>
                                                            <option value="">Understanding</option>
                                                            <option value="">Procedural</option>
                                                            <option value="">Behavioral</option>
                                                            <option value="">Skill</option>

                                                            <option value="">Inattention to task</option>
                                                            <option value="">Lack of Process</option>
                                                            <option value="">Methods</option>
                                                            <option value="">No or poor management involvement
                                                            </option>
                                                            <option value="">Other</option>
                                                            <option value="">Personnel not Qualified</option>



                                                        </select></td>
                                                    <td><input type="text" class="Document_Remarks"
                                                            name="ifother[]"></td>
                                                    <td><input type="text" class="Document_Remarks"
                                                            name="Probability[]"></td>
                                                    <td><input type="text" class="Document_Remarks"
                                                            name="remarks[]"></td>
                                                    <td><input type="text" class="Removebtn" name="Action[]"></td>


                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    {{-- @error('Product_Batch')
                                <div class="text-danger">{{ $message  }}</div>
                            @enderror --}}
                                </div>


                                <div class="col-12 sub-head"></div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="fishbone">
                                            Fishbone or Ishikawa Diagram
                                            <button type="button" name="agenda"
                                                onclick="addFishBone('.top-field-group', '.bottom-field-group')">+</button>
                                            <button type="button" name="agenda" class="fishbone-del-btn"
                                                onclick="deleteFishBone('.top-field-group', '.bottom-field-group')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#fishbone-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="fishbone-ishikawa-diagram">
                                            <div class="left-group">
                                                <div class="grid-field field-name">
                                                    <div>Measurement</div>
                                                    <div>Materials</div>
                                                    <div>Methods</div>
                                                </div>
                                                <div class="top-field-group">
                                                    <div class="grid-field fields top-field">
                                                        <div><input type="text" name="measurement[]"></div>
                                                        <div><input type="text" name="materials[]"></div>
                                                        <div><input type="text" name="methods[]"></div>
                                                    </div>
                                                </div>
                                                <div class="mid"></div>
                                                <div class="bottom-field-group">
                                                    <div class="grid-field fields bottom-field">
                                                        <div><input type="text" name="environment[]"></div>
                                                        <div><input type="text" name="manpower[]"></div>
                                                        <div><input type="text" name="machine[]"></div>
                                                    </div>
                                                </div>
                                                <div class="grid-field field-name">
                                                    <div>Environment</div>
                                                    <div>Manpower</div>
                                                    <div>Machine</div>
                                                </div>
                                            </div>
                                            <div class="right-group">
                                                <div class="field-name">
                                                    Problem Statement
                                                </div>
                                                <div class="field">
                                                    <textarea name="problem_statement"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 sub-head"></div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="why-why-chart">
                                            Why-Why Chart
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#why_chart-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="why-why-chart">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr style="background: #f4bb22">
                                                        <th style="width:150px;">Problem Statement :</th>
                                                        <td>
                                                            <textarea name="why_problem_statement"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 1 <span
                                                                onclick="addWhyField('why_1_block', 'why_1[]')">+</span>
                                                        </th>
                                                        <td>
                                                            <div class="col-md-10 why_1_block">
                                                                <textarea name="why_1[]"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 2 <span
                                                                onclick="addWhyField('why_2_block', 'why_2[]')">+</span>
                                                        </th>
                                                        <td>
                                                            <div class="why_2_block">
                                                                <textarea name="why_2[]"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 3 <span
                                                                onclick="addWhyField('why_3_block', 'why_3[]')">+</span>
                                                        </th>
                                                        <td>
                                                            <div class="why_3_block">
                                                                <textarea name="why_3[]"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 4 <span
                                                                onclick="addWhyField('why_4_block', 'why_4[]')">+</span>
                                                        </th>
                                                        <td>
                                                            <div class="why_4_block">
                                                                <textarea name="why_4[]"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 5 <span
                                                                onclick="addWhyField('why_5_block', 'why_5[]')">+</span>
                                                        </th>
                                                        <td>
                                                            <div class="why_5_block">
                                                                <textarea name="why_5[]"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr style="background: #0080006b;">
                                                        <th style="width:150px;">Root Cause :</th>
                                                        <td>
                                                            <textarea name="root-cause"></textarea>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-head"></div>
                                <script>
                                    $(document).ready(function() {
                                        $('#Root_Cause_Category_Select').change(function() {
                                            console.log('change')
                                            var selectedCategory = $(this).val();
                                            var subCategorySelect = $('#Root_Cause_Sub_Category_Select');

                                            // Clear existing options
                                            subCategorySelect.empty();

                                            // Populate options based on selected category
                                            if (selectedCategory === 'M-Machine(Equipment)') {
                                                subCategorySelect.append(
                                                '<option value="Infrequent_Audits">Infrequent Audits</option>');
                                                subCategorySelect.append(
                                                    '<option value="No_Preventive_Maintenance">No Preventive Maintenance</option>');
                                                subCategorySelect.append('<option value="Other">Other</option>');
                                                subCategorySelect.append(
                                                    '<option value="Poor_Maintenance_or_Design">Poor Maintenance or Design</option>'
                                                    );
                                                subCategorySelect.append(
                                                    '<option value="Poor_Maintenance_or_Design">Poor Maintenance or Design</option>'
                                                    );

                                                subCategorySelect.append(
                                                    '<option value="Poor_Maintenance_or_Design">Poor Maintenance or Design</option>'
                                                    );

                                                subCategorySelect.append(
                                                    '<option value="Poor_Maintenance_or_Design">Poor Maintenance or Design</option>'
                                                    );

                                                subCategorySelect.append(
                                                    '<option value="Poor_Maintenance_or_Design">Poor Maintenance or Design</option>'
                                                    );
                                                subCategorySelect.append(
                                                    '<option value="Poor_Maintenance_or_Design">Poor Maintenance or Design</option>'
                                                    );
                                                subCategorySelect.append(
                                                    '<option value="Poor_Maintenance_or_Design">Poor Maintenance or Design</option>'
                                                    );

                                            } else if (selectedCategory === 'M-Maintenance') {
                                                subCategorySelect.append(
                                                '<option value="Infrequent_Audits">Infrequent Audits</option>');
                                                subCategorySelect.append(
                                                    '<option value="No_Preventive_Maintenance">No Preventive Maintenance</option>');
                                                subCategorySelect.append('<option value="Other">Other</option>');
                                                subCategorySelect.append(
                                                    '<option value="Maintenance_Needs_Improvement">Maintenance Needs Improvement</option>'
                                                    );
                                            } else if (selectedCategory === 'M-Man Power (physical work)') {
                                                subCategorySelect.append(
                                                    '<option value="Failure_to_Follow_SOP">Failure to Follow SOP</option>');
                                                subCategorySelect.append(
                                                    '<option value="Human_Machine_Interface">Human-Machine Interface</option>');
                                                subCategorySelect.append(
                                                    '<option value="Misunderstood_Verbal_Communication">Misunderstood Verbal Communication</option>'
                                                    );
                                                subCategorySelect.append('<option value="Other">Other</option>');
                                            }
                                        });
                                    });
                                </script>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="why-why-chart">
                                            Category Of Human Error
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#is_is_not-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="why-why-chart">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width:7%;">Row #</th>
                                                        <th style="width:15%;">Gap Category</th>

                                                        <th>Issues</th>
                                                        <th>Actions</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            {{-- <input disabled type="text"  value=""> --}}
                                                            1
                                                        </td>
                                                        <th style="background: ">Attention</th>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            <textarea name="attention_issues"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="attention_actions"></textarea>
                                                        </td>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            <textarea name="attention_remarks"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            2
                                                        </td>
                                                        <th>Understanding</th>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            <textarea name="understanding_issues"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="understanding_actions"></textarea>
                                                        </td>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            <textarea name="understanding_remarks"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            3
                                                        </td>
                                                        <th>Procedural</th>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            <textarea name="procedural_issues"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="procedural_actions"></textarea>
                                                        </td>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            <textarea name="procedural_remarks"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            4
                                                        </td>
                                                        <th>Behavioral</th>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            <textarea name="behavioiral_issues"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="behavioiral_actions"></textarea>
                                                        </td>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            <textarea name="behavioiral_remarks"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            5
                                                        </td>
                                                        <th>Skill</th>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            <textarea name="skill_issues"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="skill_actions"></textarea>
                                                        </td>
                                                        <td style="background: rgb(222 220 220 / 58%)">
                                                            <textarea name="skill_remarks"></textarea>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-head"></div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="why-why-chart">
                                            Is/Is Not Analysis
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#is_is_not-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="why-why-chart">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th>Will Be</th>
                                                        <th>Will Not Be</th>
                                                        <th>Rationale</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th style="background: rgb(222 220 220 / 58%)">What</th>
                                                        <td>
                                                            <textarea name="what_will_be"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="what_will_not_be"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="what_rationable"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="background: rgb(222 220 220 / 58%)">Where</th>
                                                        <td>
                                                            <textarea name="where_will_be"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="where_will_not_be"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="where_rationable"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="background: rgb(222 220 220 / 58%)">When</th>
                                                        <td>
                                                            <textarea name="when_will_be"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="when_will_not_be"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="when_rationable"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="background:rgb(222 220 220 / 58%)">Coverage</th>
                                                        <td>
                                                            <textarea name="coverage_will_be"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="coverage_will_not_be"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="coverage_rationable"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="background:rgb(222 220 220 / 58%)">Who</th>
                                                        <td>
                                                            <textarea name="who_will_be"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="who_will_not_be"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="who_rationable"></textarea>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="button-block">
                                <button type="submit" class="saveButton" style=" justify-content: center; width: 4rem; margin-left: 1px;">Save</button>
                                <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <button type="button" class="backButton" >Back</button>
                                </a>
                                <button type="button" class="nextButton" style=" justify-content: center; width: 4rem; margin-left: 1px;" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                                        <!-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;" type="button"
                                        class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#launch_extension">
                                        Launch Extension
                                    </a> -->
                                    {{-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#effectivenss_extension">
                                        Launch Effectiveness Check
                                    </a> --}}
                            </div>
                        </div>
                    </div>


                    {{-- -------------QRM----------------- --}}
                    <div id="CCForm11" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12 sub-head"></div>
                                <div class="col-12 mb-4">
                                    <div class="group-input">
                                        <label for="agenda">
                                            Failure Mode and Effect Analysis
                                            <button type="button" name="agenda"
                                                onclick="addRiskAssessment('risk-assessment-risk-management')">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#failure_mode_and_effect_analysis" style="font-size: 0.8rem; font-weight: 400;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" style="width: 200%"
                                                id="risk-assessment-risk-management">
                                                <thead>
                                                    <tr>
                                                        <th>Row #</th>
                                                        <th>Risk Factor</th>
                                                        <th>Risk element </th>
                                                        <th>Probable cause of risk element</th>
                                                        <th>Existing Risk Controls</th>
                                                        <th>Initial Severity- H(3)/M(2)/L(1)</th>
                                                        <th>Initial Probability- H(3)/M(2)/L(1)</th>
                                                        <th>Initial Detectability- H(1)/M(2)/L(3)</th>
                                                        <th>Initial RPN</th>
                                                        <th>Risk Acceptance (Y/N)</th>
                                                        <th>Proposed Additional Risk control measure (Mandatory for Risk
                                                            elements having RPN>4)</th>
                                                        <th>Residual Severity- H(3)/M(2)/L(1)</th>
                                                        <th>Residual Probability- H(3)/M(2)/L(1)</th>
                                                        <th>Residual Detectability- H(1)/M(2)/L(3)</th>
                                                        <th>Residual RPN</th>
                                                        <th>Risk Acceptance (Y/N)</th>
                                                        <th>Mitigation proposal (Mention either CAPA reference number, IQ,
                                                            OQ or
                                                            PQ)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Investigation Summary">Conclusion</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Conclusion" id="summernote-8">
                                         </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Investigation Summary">Identified Risk</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Identified_Risk" id="summernote-8">
                                        </textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Severity Rate">Severity Rate</label>
                                        <select name="severity_rate" id="analysisR"
                                            onchange='calculateRiskAnalysis(this)'>
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">Negligible</option>
                                            <option value="2">Moderate</option>
                                            <option value="3">Major</option>
                                            <option value="4">Fatal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Occurrence">Occurrence</label>
                                        <select name="occurrence" id="analysisP"
                                            onchange='calculateRiskAnalysis(this)'>
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="5">Extremely Unlikely</option>
                                            <option value="4">Rare</option>
                                            <option value="3">Unlikely</option>
                                            <option value="2">Likely</option>
                                            <option value="1">Very Likely</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Detection">Detection</label>
                                        <select name="detection" id="analysisN"
                                            onchange='calculateRiskAnalysis(this)'>
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="5">Impossible</option>
                                            <option value="4">Rare</option>
                                            <option value="3">Unlikely</option>
                                            <option value="2">Likely</option>
                                            <option value="1">Very Likely</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RPN">RPN</label>
                                        <div><small class="text-primary">Auto - Calculated</small></div>
                                        <input type="text" name="rpn" id="analysisRPN" value=""
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-12 sub-head"></div>
                                <div class="col-12 mb-4">
                                    <div class="group-input">
                                        <label for="agenda">
                                            Risk Matrix
                                            <button type="button" name="agenda" id="risk_matrix_details">+</button>
                                            <span class="text-primary" style="font-size: 0.8rem; font-weight: 400;" data-bs-toggle="modal"
                                            data-bs-target="#risk_matrix">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" style="width: 150%"
                                                id="risk_matrix_details_details">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No #</th>
                                                        <th>Risk Assessment</th>
                                                        <th>Review Schedule</th>
                                                        <th>Actual Reviewed On</th>
                                                        <th>Recorded By Sign and Date</th>
                                                        <th>Remarks</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <td><input disabled type="text" name="serial[]" value="1">
                                                    </td>
                                                    <td><input type="text" class="Document_Remarks"
                                                            name="Risk_Assessment[]"></td>
                                                    <td><input type="text" class="Document_Remarks"
                                                            name="Review_Schedule[]"></td>
                                                    <td><input type="text" class="Document_Remarks"
                                                            name="Actual_Reviewed[]"></td>
                                                    <td><input type="text" class="Document_Remarks"
                                                            name="Recorded_By[]"></td>
                                                    <td><input type="text" class="Document_Remarks"
                                                            name="Remarks[]"></td>
                                                    <td><input type="text" class="Removebtn" name="Action[]"></td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <script>
                                function calculateRiskAnalysis(selectElement) {
                                    // Get the row containing the changed select element
                                    let row = selectElement.closest('tr');

                                    // Get values from select elements within the row
                                    let R = parseFloat(document.getElementById('analysisR').value) || 0;
                                    let P = parseFloat(document.getElementById('analysisP').value) || 0;
                                    let N = parseFloat(document.getElementById('analysisN').value) || 0;

                                    // Perform the calculation
                                    let result = R * P * N;

                                    // Update the result field within the row
                                    document.getElementById('analysisRPN').value = result;
                                }
                            </script>
                            <div class="button-block">
                                <button type="submit" class="saveButton" style=" justify-content: center; width: 4rem; margin-left: 1px;">Save</button>
                                <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="backButton">Back</button>
                                </a>
                                <button type="button"  style=" justify-content: center; width: 4rem; margin-left: 1px;" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                                        <!-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;" type="button"
                                        class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#launch_extension">
                                        Launch Extension
                                    </a> -->
                                    {{-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#effectivenss_extension">
                                        Launch Effectiveness Check
                                    </a> --}}
                            </div>
                        </div>
                    </div>


                    <!-- capa -->
                    <div id="CCForm10" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4"  for="Investigation Summary">Investigation Summary</label>
                                        <textarea class="" name="Investigation_Summary" id="Investigation_Summary" cols="30" ></textarea>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="CAPA_Number"><b>CAPA No</b></label>
                                        <input disabled type="text" name="capa_number">
                                    </div>
                                </div> --}}

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group"><b>Name of the Department</b><span
                                                class="text-danger">*</span></label>
                                        <select name="department_capa" id="department_capa">
                                            <option value="">-- Select --</option>
                                            <option value="CQA" @if (old('department_capa') == 'CQA') selected @endif>
                                                Corporate Quality Assurance</option>
                                            <option value="QAB" @if (old('department_capa') == 'QAB') selected @endif>
                                                Quality
                                                Assurance Biopharma</option>
                                            <option value="CQC" @if (old('department_capa') == 'CQC') selected @endif>
                                                Central
                                                Quality Control</option>
                                            <option value="MANU" @if (old('department_capa') == 'MANU') selected @endif>
                                                Manufacturing</option>
                                            <option value="PSG" @if (old('department_capa') == 'PSG') selected @endif>
                                                Plasma
                                                Sourcing Group</option>
                                            <option value="CS" @if (old('department_capa') == 'CS') selected @endif>
                                                Central
                                                Stores</option>
                                            <option value="ITG" @if (old('department_capa') == 'ITG') selected @endif>
                                                Information Technology Group</option>
                                            <option value="MM" @if (old('department_capa') == 'MM') selected @endif>
                                                Molecular Medicine</option>
                                            <option value="CL" @if (old('department_capa') == 'CL') selected @endif>
                                                Central
                                                Laboratory</option>

                                            <option value="TT" @if (old('department_capa') == 'TT') selected @endif>
                                                Tech
                                                team</option>
                                            <option value="QA" @if (old('department_capa') == 'QA') selected @endif>
                                                Quality Assurance</option>
                                            <option value="QM" @if (old('department_capa') == 'QM') selected @endif>
                                                Quality Management</option>
                                            <option value="IA" @if (old('department_capa') == 'IA') selected @endif>IT
                                                Administration</option>
                                            <option value="ACC" @if (old('department_capa') == 'ACC') selected @endif>
                                                Accounting</option>
                                            <option value="LOG" @if (old('department_capa') == 'LOG') selected @endif>
                                                Logistics</option>
                                            <option value="SM" @if (old('department_capa') == 'SM') selected @endif>
                                                Senior Management</option>
                                            <option value="BA" @if (old('department_capa') == 'BA') selected @endif>
                                                Business Administration</option>
                                        </select>
                                        @error('department_capa')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div style="margin-bottom: 0px;" class="col-lg-12 new-date-data-field ">
                                    <div class="group-input input-date">
                                        <label for="Deviation category">Source of CAPA</label>
                                        <select name="Deviation_category" id="Deviation_category">
                                            <option value="0">-- Select -- </option>
                                            <option value="Deviation">Deviation </option>
                                            <option value="OS/OT">OS/OT</option>
                                            <option value="Audit_Obs">Audit Observation </option>

                                            <option value="Complaint">Complaint</option>
                                            <option value="Product_Recall">Product Recall</option>
                                            <option value="Returned_Goods">Returned Goods</option>
                                            <option value="APQR">APQR</option>
                                            <option value="Management_Review_Action_Plan">Management Review Action Plan
                                            </option>
                                            <option value="Investigation">Investigation</option>
                                            <option value="Internal_Review">Internal Review</option>
                                            <option value="Quality_Risk_Assessment">Quality Risk Assessment</option>
                                            <option value="Others">Others</option>

                                        </select>

                                    </div>
                                </div>

                                <div class="col-lg-6" id="others_block">
                                    <div class="group-input">
                                        <label for="others">Others <span id="asteriskInviothers"
                                                style="display: none" class="text-danger">*</span></label>
                                        <input type="text" id="others" name="others" class="others">
                                    </div>
                                </div>

                                <div class="col-lg-6" id="others_block">
                                    <div class="group-input">
                                        <label for="others">Source Document</label>
                                        <input type="text" id="source_doc" name="source_doc" class="source_doc">
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Description_of_Discrepancy">Description of Discrepancy </label>
                                        <textarea class="tiny" name="Description_of_Discrepancy" id="summernote-8">
                                    </textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4"  for="Impact assessment">Impact Assessment</label>
                                        <textarea class="" name="Impact_assessment" id="Impact_assessment" cols="30" ></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Root_Cause">Root Cause</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Root_Cause" id="summernote-9">
                                    </textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4"  for="Root cause">Root Cause</label>
                                        <textarea class="" name="Root_cause" id="Root_cause" cols="30" ></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Immediate_Action_Take">Immediate Action Taken (If Applicable)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Immediate_Action_Take" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Corrective_Action_Details">Corrective Action Details</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Corrective_Action_Details" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Preventive_Action_Details">Preventive Action Details</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Preventive_Action_Details" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>


                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Interim_Control">Interim Control(If Any)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Interim_Control" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="sub-head">
                                    CAPA Implementation
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Corrective_Action_Taken">Corrective Action Taken</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Corrective_Action_Taken" id="summernote-10">
                                    </textarea>
                                    </div>

                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Preventive_action_Taken">Preventive Action Taken</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Preventive_action_Taken" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="sub-head">
                                    CAPA Closure
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="CAPA_Closure_Comments">CAPA Closure Comments</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="" name="CAPA_Closure_Comments" id="summernote-10">
                                    </textarea>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="CAPA_Closure_attachment Attachment">CAPA Closure
                                                Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="CAPA_Closure_attachment"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile"
                                                        name="CAPA_Closure_attachment[]"
                                                        oninput="addMultipleFiles(this, 'CAPA_Closure_attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="button-block">
                                    <button type="submit" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="saveButton">Save</button>
                                    <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                        <button type="button" class="backButton">Back</button>
                                    </a>
                                    <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;" > <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white">
                                            Exit </a> </button>
                                            <!-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;" type="button"
                                            class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#launch_extension">
                                            Launch Extension
                                        </a> -->
                                        {{-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#effectivenss_extension">
                                            Launch Effectiveness Check
                                        </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- investigation and capa -->
                    {{-- <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Investigation Summary">Investigation Summary</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="" name="Investigation_Summary" id="summernote-8">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment">Impact Assessment</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="" name="Impact_assessment" id="summernote-9">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Root Cause">Root Cause</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="" name="Root_cause" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="CAPA Rquired">CAPA Required ?</label>
                                      <select name="CAPA_Rquired" id="CAPA_Rquired">
                                        <option value="0"> -- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no"> No</option>
                                      </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="capa type">CAPA Type?</label>
                                      <select name="capa_type" id="capa_type">
                                        <option value="0"> -- Select --</option>
                                        <option value="Corrective_Action">Corrective Action</option>
                                        <option value="Preventive_Action">Preventive Action</option>
                                        <option value="Corrective&Preventive">Corrective & Preventive Action both</option>
                                      </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="CAPA Description">CAPA Description</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="" name="CAPA_Description" id="summernote-11">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Post Categorization Of Deviation">Post Categorization Of Deviation</label>
                                       <div><small class="text-primary">Please Refer Intial deviation category before updating.</small></div>
                                        {{-- <textarea class="" name="Post_Categorization" id="summernote-12"> --}}
                    {{-- <select name="Post_Categorization" id="Post_Categorization">
                                                <option value=""> -- Select --</option>
                                                <option value="major">Major</option>
                                                <option value="minor">Minor</option>
                                                <option value="critical">Critical</option>
                                              </select>
                                    </textarea>
                                    </div>
                                </div> --}}

                    {{-- <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Investigation Of Revised Categorization">Justification for Revised Category</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="" name="Investigation_Of_Review" id="summernote-13">
                                    </textarea>
                                    </div>
                                </div> --}}


                    {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Investigatiom Attachment">Investigation Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Investigation_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Investigation_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Investigation_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="capa_Attachments">CAPA Attachment </label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small>
                                            </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Capa_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Capa_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Capa_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> --}}

                    {{-- <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                              <a href="/rcms/qms-dashboard">
                                        <button type="button" class="backButton">Back</button>
                                    </a>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>  --}}

                    <!-- Initiator Update -->
                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">


                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Feedbacks">QA Feedbacks</label>
                                        <textarea class="" name="QA_Feedbacks"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="QA Feedbacks">Initiator Feedbacks</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="QA_Feedbacks" id="summernote-14">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="QA attachments">Initiator Additional Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="QA_attachments[]"
                                                    oninput="addMultipleFiles(this, 'QA_attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="button-block">
                                <button type="submit" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="saveButton">Save</button>
                                <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <button type="button"  class="backButton">Back</button>
                                </a>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                                        <!-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;" type="button"
                                            class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#launch_extension">
                                            Launch Extension
                                        </a> -->
                                    {{-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#effectivenss_extension">
                                        Launch Effectiveness Check
                                    </a> --}}
                            </div>
                        </div>
                    </div>

                    <!-- QAH-->
                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Post Categorization Of Deviation">Post Categorization Of
                                            Deviation</label>
                                        <div><small class="text-primary">Please Refer Intial deviation category before
                                                updating.</small></div>
                                        <select name="Post_Categorization" id="Post_Categorization" disabled>
                                            <option value=""> -- Select --</option>
                                            <option value="major">Major</option>
                                            <option value="minor">Minor</option>
                                            <option value="critical">Critical</option>
                                        </select>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Investigation Of Revised Categorization">Justification for Revised
                                            Category</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Investigation_Of_Review" id="summernote-13">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Remarks">Closure Comments</label>
                                        <textarea class="tiny" name="Closure_Comments" id="summernote-15"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Disposition of Batch</label>
                                        <textarea class="tiny" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Closure Attachments </label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="closure_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="closure_attachment[]"
                                                    oninput="addMultipleFiles(this, 'closure_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="button-block">
                                <button type="submit" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="saveButton">Save</button>
                                <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <button type="button" class="backButton">Back</button>
                                </a>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                                        <!-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;" type="button"
                                        class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#launch_extension">
                                        Launch Extension
                                    </a> -->
                                    {{-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#effectivenss_extension">
                                        Launch Effectiveness Check
                                    </a> --}}
                            </div>
                        </div>
                    </div>

                    <!-- Effectiveness Check-->

                    <div id="CCForm12" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">
                                    Deviation Extension
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule End Date">Proposed Due Date (Deviation)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Proposed_Due_date_deviation" readonly
                                                placeholder="DD-MMM-YYYY" disabled/>
                                            <input type="date" name="Proposed_Due_date_deviation"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Proposed_Due_date_deviation')" disabled />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Extension_Justification_deviation">Extension Justification
                                            (Deviation)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Extension_Justification_deviation" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for=" Deviation_Extension_Completed_By"> Deviation Extension Completed By
                                        </label>
                                        <select name="Deviation_Extension_Completed_By"
                                            id="Deviation_Extension_Completed_By" disabled>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule End Date">Deviation Extension Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Deviation_Extension_Completed_On" readonly
                                                placeholder="DD-MMM-YYYY" disabled/>
                                            <input type="date" name="Deviation_Extension_Completed_On"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Deviation_Extension_Completed_On')" disabled/>
                                        </div>
                                    </div>
                                </div>


                                <div class="sub-head">
                                    CAPA Extension
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Proposed_Due_date_CAPA">Proposed Due Date (CAPA)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Proposed_Due_date_CAPA" readonly
                                                placeholder="DD-MMM-YYYY" disabled />
                                            <input type="date" name="Proposed_Due_date_CAPA"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Proposed_Due_date_CAPA')" disabled />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Extension_Justification_CAPA">Extension Justification (CAPA)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Extension_Justification_CAPA" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>


                                {{-- row --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" CAPA_Extension_Completed_By"> CAPA Extension Completed By
                                            </label>
                                            <select name="CAPA_Extension_Completed_By" id="CAPA_Extension_Completed_By" disabled>
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Audit Schedule End Date">CAPA Extension Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="CAPA_Extension_Completed_On" readonly
                                                    placeholder="DD-MMM-YYYY" disabled />
                                                <input type="date" name="CAPA_Extension_Completed_On"
                                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'CAPA_Extension_Completed_On')" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    {{-- row_end --}}
                                </div>
                                <div class="sub-head">
                                    Quality Risk Management Extension
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Proposed_Due_Date_QRM">Proposed Due Date (Quality Risk
                                            Management)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Proposed_Due_Date_QRM" readonly
                                                placeholder="DD-MMM-YYYY" disabled />
                                            <input type="date" name="Proposed_Due_Date_QRM"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Proposed_Due_Date_QRM')" disabled />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Extension_Justi_QRM">Extension Justification (Quality Risk
                                            Management)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Extension_Justi_QRM" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>

                                {{-- row --}}
                                <div class="row">


                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" Quality_Risk_Management_Extension_Completed_By"> Quality Risk
                                                Management Extension Completed By </label>
                                            <select name="Quality_Risk_Management_Extension_Completed_By"
                                                id="Quality_Risk_Management_Extension_Completed_By" disabled>
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Quality_Risk_Management_Extension_Completed_ON">Quality Risk
                                                Management Extension Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text"
                                                    id="Quality_Risk_Management_Extension_Completed_ON" readonly
                                                    placeholder="DD-MMM-YYYY" disabled />
                                                <input type="date"
                                                    name="Quality_Risk_Management_Extension_Completed_ON"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'Quality_Risk_Management_Extension_Completed_ON')" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    {{-- row_end --}}
                                </div>
                                <div class="sub-head">
                                    Investigation Extension
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Proposed_Due_date_investigation">Proposed Due Date
                                            (Investigation)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Proposed_Due_date_investigation" readonly
                                                placeholder="DD-MMM-YYYY" disabled />
                                            <input type="date" name="Proposed_Due_date_investigation"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Proposed_Due_date_investigation')" disabled />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Extension_Justification_investigation">Extension Justification
                                            (Investigation)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Extension_Justification_investigation" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>


                                {{-- row --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" Investigation_Extension_Completed_By"> Investigation Extension
                                                Completed By </label>
                                            <select name="Investigation_Extension_Completed_By"
                                                id="Investigation_Extension_Completed_By" disabled>
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Investigation_Extension_Completed_On">Investigation Extension
                                                Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="Investigation_Extension_Completed_On" readonly
                                                    placeholder="DD-MMM-YYYY" disabled />
                                                <input type="date" name="Investigation_Extension_Completed_On"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'Investigation_Extension_Completed_On')" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    {{-- row-end --}}
                                </div>


                                {{-- <div class="sub-head">
                                    Deviation Effectiveness Check
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Effectiveness_Check_Plan_Deviation">Effectiveness Check
                                            Plan(Deviation)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Effectiveness_Check_Plan_Deviation" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" Deviation_Effectiveness_Check_Plan_Proposed_By">Deviation
                                                Effectiveness Check Plan Proposed By </label>
                                            <select name="Deviation_Effectiveness_Check_Plan_Proposed_By"
                                                id="Deviation_Effectiveness_Check_Plan_Proposed_By">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="deviation_EC_Plan_Proposed_On"> Deviation Effectiveness Check Plan
                                                Proposed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="deviation_EC_Plan_Proposed_On" readonly
                                                    placeholder="DD-MMM-YYYY" />
                                                <input type="date" name="deviation_EC_Plan_Proposed_On"
                                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'deviation_EC_Plan_Proposed_On')" />
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="EC_Closure_comments_deviation">Effectiveness Check Closure
                                            Comments(Deviation)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="EC_Closure_comments_deviation" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>


                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Next_review_date_deviation">Next Review Date(Deviation)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Next_review_date_deviation" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Next_review_date_deviation"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Next_review_date_deviation')" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" deviaiton_EC_Closed_By">Deviation Effectiveness Check Closed
                                                By</label>
                                            <select name="deviaiton_EC_Closed_By" id="deviaiton_EC_Closed_By">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="deviation_Effectiveness_Check_Closed_On">Deviation Effectiveness
                                                Check Closed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="deviation_Effectiveness_Check_Closed_On"
                                                    readonly placeholder="DD-MMM-YYYY" />
                                                <input type="date" name="deviation_Effectiveness_Check_Closed_On"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'deviation_Effectiveness_Check_Closed_On')" />
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="sub-head">
                                    CAPA Effectiveness Check
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="EC_plan_Capa">Effectiveness Check Plan(CAPA)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="EC_plan_Capa" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" Investigation_Extension_Completed_By">CAPA Effectiveness Check
                                                Plan Proposed By </label>
                                            <select name="Investigation_Extension_Completed_By"
                                                id="Investigation_Extension_Completed_By">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Investigation_Extension_Completed_On">CAPA Effectiveness Check
                                                Plan Proposed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="Investigation_Extension_Completed_On" readonly
                                                    placeholder="DD-MMM-YYYY" />
                                                <input type="date" name="Investigation_Extension_Completed_On"
                                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'Investigation_Extension_Completed_On')" />
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Extension_Justi_QRM">Effectiveness Check Closure
                                            Comments(CAPA)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Extension_Justi_QRM" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Investigation_Extension_Completed_On">Next Review Date(CAPA)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Investigation_Extension_Completed_On" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Investigation_Extension_Completed_On"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Investigation_Extension_Completed_On')" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" Investigation_Extension_Completed_By">CAPA Effectiveness Check
                                                Closed By</label>
                                            <select name="Investigation_Extension_Completed_By"
                                                id="Investigation_Extension_Completed_By">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Effectiveness_Check_Closed_On">CAPA Effectiveness Check Closed
                                                On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="Effectiveness_Check_Closed_On" readonly
                                                    placeholder="DD-MMM-YYYY" />
                                                <input type="date" name="Effectiveness_Check_Closed_On"
                                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'Effectiveness_Check_Closed_On')" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="sub-head">
                                    Quality Risk Management Effectiveness Check
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Extension_Justi_QRM">Effectiveness Check Plan( Quality Risk
                                            Management)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Extension_Justi_QRM" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" Investigation_Extension_Completed_By"> QRM Effectiveness Check
                                                Plan Proposed By </label>
                                            <select name="Investigation_Extension_Completed_By"
                                                id="Investigation_Extension_Completed_By">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Investigation_Extension_Completed_On">QRM Effectiveness Check Plan
                                                Proposed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="Investigation_Extension_Completed_On" readonly
                                                    placeholder="DD-MMM-YYYY" />
                                                <input type="date" name="Investigation_Extension_Completed_On"
                                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'Investigation_Extension_Completed_On')" />
                                            </div>
                                        </div>

                                    </div>

                                </div>


                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Extension_Justi_QRM">Effectiveness Check Closure Comments( Quality
                                            Risk Management)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Extension_Justi_QRM" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Investigation_Extension_Completed_On">Next Review Date(Quality Risk
                                            Management)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Investigation_Extension_Completed_On" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Investigation_Extension_Completed_On"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Investigation_Extension_Completed_On')" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" Investigation_Extension_Completed_By">QRM Effectiveness Check
                                                Closed By</label>
                                            <select name="Investigation_Extension_Completed_By"
                                                id="Investigation_Extension_Completed_By">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Effectiveness_Check_Closed_On">QRM Effectiveness Check Closed
                                                On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="Effectiveness_Check_Closed_On" readonly
                                                    placeholder="DD-MMM-YYYY" />
                                                <input type="date" name="Effectiveness_Check_Closed_On"
                                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'Effectiveness_Check_Closed_On')" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="sub-head">
                                    Investigation Effectiveness Check
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Extension_Justi_QRM">Effectiveness Check Plan(Investigation)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Extension_Justi_QRM" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" Investigation_Extension_Completed_By">Investigation Effectiveness
                                                Check Plan Proposed By </label>
                                            <select name="Investigation_Extension_Completed_By"
                                                id="Investigation_Extension_Completed_By">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Effectiveness_Check_Plan_Proposed_On">Investigation Effectiveness
                                                Check Plan Proposed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="Effectiveness_Check_Plan_Proposed_On" readonly
                                                    placeholder="DD-MMM-YYYY" />
                                                <input type="date" name="Effectiveness_Check_Plan_Proposed_On"
                                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'Effectiveness_Check_Plan_Proposed_On')" />
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="EC_Closure_Comments_investigation">Effectiveness Check Closure
                                            Comments(Investigation)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="EC_Closure_Comments_investigation" id="summernote-10">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Investigation_Extension_Completed_On">Next Review Date
                                            (Investigation)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Investigation_Extension_Completed_On" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Investigation_Extension_Completed_On"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Investigation_Extension_Completed_On')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" Investigation_Effectiveness_Check_Closed_By">Investigation
                                                Effectiveness Check Closed By</label>
                                            <select name="Investigation_Effectiveness_Check_Closed_By"
                                                id="Investigation_Effectiveness_Check_Closed_By">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Investigation_Effectiveness_Check_Closed_On">Investigation
                                                Effectiveness Check Closed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="Investigation_Effectiveness_Check_Closed_On"
                                                    readonly placeholder="DD-MMM-YYYY" />
                                                <input type="date" name="Investigation_Effectiveness_Check_Closed_On"
                                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'Investigation_Effectiveness_Check_Closed_On')" />
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>

                                <div class="button-block">
                                    <button type="submit" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="saveButton">Save</button>
                                    <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                        <button type="button"  class="backButton">Back</button>
                                    </a>
                                    <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white">
                                            Exit </a> </button>
                                            <!-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;" type="button"
                                            class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#launch_extension">
                                            Launch Extension
                                        </a> -->
                                        {{-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#effectivenss_extension">
                                            Launch Effectiveness Check
                                        </a> --}}
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- Activity Log content -->
                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">Submission</div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit by">Submit By :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit on">Submit On :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="submit comment">Submit Comments :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="sub-head">HOD Review Completed</div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Review Complete By">HOD Review Complete By :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Review Complete On">HOD Review Complete On :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="HOD Review Comments">HOD Review Comments :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>


                                <div class="sub-head">QA Initial Review Completed</div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Initial Review Complete By">QA Initial Review Complete By
                                            :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Initial Review Complete On">QA Initial Review Complete On
                                            :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="QA Initial Review Comments">QA Initial Review Comments:-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="sub-head">CFT Review Complete</div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="CFT Review Complete By">CFT Review Complete By :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="CFT Review Complete On">CFT Review Complete On :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="CFT Review Comments">CFT Review Comments :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="sub-head">Initiator Update</div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="CFT Review Complete By">Initiator Update Complete By :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="CFT Review Complete On">Initiator Update Complete On :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="CFT Review Comments">Initiator Update Comments :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="sub-head"> QA Final Review Completed</div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Final Review Complete By"> QA Final Review Complete By :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Final Review Complete On"> QA Final Review Complete On :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="QA Final Review Comments"> QA Final Review Comments :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="sub-head"> Approved</div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved By">Approved By :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved On">Approved On :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Approved Comments">Approved Comments :-</label>
                                        <div class="static"></div>
                                    </div>
                                </div>






                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <a href="/rcms/qms-dashboard">
                                    <button type="button" class="backButton">Back</button>
                                </a>
                                <button type="submit">Submit</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                        class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            <div class="sticky-buttons">
                <div>
                    <a type="button" class="" data-toggle="modal" data-target="#myModal">

                        <svg width="18" height="24" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#ffffff"
                                d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34M332.1 128H256V51.9zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288zm220.1-208c-5.7 0-10.6 4-11.7 9.5c-20.6 97.7-20.4 95.4-21 103.5c-.2-1.2-.4-2.6-.7-4.3c-.8-5.1.3.2-23.6-99.5c-1.3-5.4-6.1-9.2-11.7-9.2h-13.3c-5.5 0-10.3 3.8-11.7 9.1c-24.4 99-24 96.2-24.8 103.7c-.1-1.1-.2-2.5-.5-4.2c-.7-5.2-14.1-73.3-19.1-99c-1.1-5.6-6-9.7-11.8-9.7h-16.8c-7.8 0-13.5 7.3-11.7 14.8c8 32.6 26.7 109.5 33.2 136c1.3 5.4 6.1 9.1 11.7 9.1h25.2c5.5 0 10.3-3.7 11.6-9.1l17.9-71.4c1.5-6.2 2.5-12 3-17.3l2.9 17.3c.1.4 12.6 50.5 17.9 71.4c1.3 5.3 6.1 9.1 11.6 9.1h24.7c5.5 0 10.3-3.7 11.6-9.1c20.8-81.9 30.2-119 34.5-136c1.9-7.6-3.8-14.9-11.6-14.9h-15.8z" />
                        </svg>
                    </a>
                </div>
                {{-- <div

          >
          <a type="button" class="" data-toggle="modal" data-target="#myModal1">

            <svg width="24" height="24" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
              <path
                fill="#ffffff"
                d="M25.01 49v46H103V49zM153 49v46h78V49zm128 0v46h78V49zm128 0v46h78V49zM55.01 113v64H119v46h18v-46h64v-64h-18v46H73.01v-46zM311 113v64h64v46h18v-46h64v-64h-18v46H329v-46zM89.01 241v46H167v-46zM345 241v46h78v-46zm-226 64v48h128v46h18v-46h128v-48h-18v30H137v-30zm98 112v46h78v-46z"
              />
            </svg>
        </a>

          </div> --}}
            </div>
        </div>
    </div>




    {{-- ==================================================================== --}}


    <div class="container">


        <!-- Modal -->
        <div class="modal right fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Deviation Workflow</h4>
                    </div>
                    <div style="padding: 2px; " class="modal-body">

                        <div style="padding:3px;" class="modal-body">

                            <Div class="button-box">
                                <div style="background: #85be859e;" class="mini_buttons">
                                    Opened
                                </div>
                                <div class="down-logo">
                                    <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                        class="w-100 h-100">

                                </div>
                                <div style="background: #0000ff1f;" class="mini_buttons">
                                    HOD Review
                                </div>
                                <div class="down-logo">
                                    <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                        class="w-100 h-100">

                                </div>
                                <div style="background: #0000ff1f;" class="mini_buttons">
                                    QA Initial Review
                                </div>
                                <div class="down-logo">
                                    <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                        class="w-100 h-100">

                                </div>
                                <div style="background: #0000ff1f;" class="mini_buttons">
                                    CFT Review
                                </div>
                                <div class="down-logo">
                                    <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                        class="w-100 h-100">

                                </div>
                                <div style="background: #0000ff1f;" class="mini_buttons">
                                    QA Final Review
                                </div>
                                <div class="down-logo">
                                    <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                        class="w-100 h-100">

                                </div>
                                <div style="background: #0000ff1f;" class="mini_buttons">
                                    QA Head/Manager Designee Approval
                                </div>
                                <div class="down-logo">
                                    <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                        class="w-100 h-100">
                                </div>

                                <div style="background: #0000ff1f;" class="mini_buttons">
                                    Pending Initiator Update
                                </div>
                                <div class="down-logo">
                                    <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                        class="w-100 h-100">
                                </div>

                                <div style="background: #0000ff1f;" class="mini_buttons">
                                    QA Final Approval
                                </div>
                                <div class="down-logo">
                                    <img class="dawn_arrow" src="{{ asset('user/images/down.gif') }}" alt="..."
                                        class="w-100 h-100">
                                </div>
                                <div style="background: #ff000042;" class="mini_buttons">
                                    Closed - Done
                                </div>
                            </Div>
                        </div>
                        <!-- {{-- <div class="modal-footer">
                   <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                 </div> --}} -->
                    </div>

                </div>
            </div>
            {{-- --------------------------------------------------------------   --}}
        </div>
        <div class="container">



            <div class="modal right fade" id="myModal1" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                            <h4 class="modal-title">WorkFlow</h4>
                        </div>
                        <div class="modal-body">




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default close-btn"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        {{-- ==================================================================== --}}

        {{-- =================================launch extension============ --}}
        <div class="modal fade" id="launch_extension">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <div class="launch_extension_header">
                            <h4 class="modal-title text-center">Launch Extension</h4>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form method="POST">
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="main_head_modal">
                                <ul>
                                    <li>
                                        <div> <a href="" data-bs-toggle="modal"
                                                data-bs-target="#qrm_extension"> QRM</a></div>
                                    </li>
                                    <li>
                                        <div> <a href=""data-bs-toggle="modal"
                                                data-bs-target="#investigation_extension"> Investigation</a></div>
                                    </li>
                                    <li>
                                        <div> <a href="" data-bs-toggle="modal"
                                                data-bs-target="#capa_extension"> CAPA</a></div>
                                    </li>
                                    <li>
                                        <div> <a href="" data-bs-toggle="modal"
                                                data-bs-target="#deviation_extension"> Deviation</a></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="submit">
                        Submit
                    </button> --}}
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ===================================================qrm================== --}}
        <div class="modal fade" id="qrm_extension">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">QRM-Extension</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <div class="group-input">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text" name="username" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="password" name="password" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Proposed Due Date(QRM)</label>
                                <input class="extension_modal_signature" type="date" name="proposed_due_date">
                            </div>
                            <div class="group-input">
                                <label for="password">Extension Justification (QRM)<span
                                        class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text"
                                    name="extension_justification">
                            </div>
                            <div class="group-input">
                                <label for="password">Quality Risk Management Extension Completed By </label>
                                <select class="extension_modal_signature" name="quality_risk_management_by"
                                    id="">
                                    <option value="">-- Select --</option>
                                </select>
                            </div>
                            <div class="group-input">
                                <label for="password">Quality Risk Management Extension Completed On </label>
                                <input class="extension_modal_signature" type="date"
                                    name="quality_risk_management_on">
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit">
                                Submit
                            </button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- ===============================invesigation=========== --}}
        <div class="modal fade" id="investigation_extension">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Investigation-Extension</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <div class="group-input">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text" name="username" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="password" name="password" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Proposed Due Date(Investigation)</label>
                                <input class="extension_modal_signature" type="date"
                                    name="proposed_due_investigation">
                            </div>
                            <div class="group-input">
                                <label for="password">Extension Justification (Investigation)<span
                                        class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text"
                                    name="investigation_justification">
                            </div>
                            <div class="group-input">
                                <label for="password">Investigation Extension Completed By </label>
                                <select class="extension_modal_signature" name="investigation_by" id="">
                                    <option value="">-- Select --</option>
                                </select>
                            </div>
                            <div class="group-input">
                                <label for="password">Investigation Extension Completed On </label>
                                <input class="extension_modal_signature" type="date" name="investigation_on">
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit">
                                Submit
                            </button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- ===============================CAPA=========== --}}
        <div class="modal fade" id="capa_extension">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">CAPA-Extension</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <div class="group-input">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text" name="username" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="password" name="password" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Proposed Due Date (CAPA)</label>
                                <input class="extension_modal_signature" type="date" name="proposed_due_capa">
                            </div>
                            <div class="group-input">
                                <label for="password">Extension Justification (CAPA)<span
                                        class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text" name="capa_justification">
                            </div>
                            <div class="group-input">
                                <label for="password">CAPA Extension Completed By </label>
                                <select class="extension_modal_signature" name="capa_by" id="">
                                    <option value="">-- Select --</option>
                                </select>
                            </div>
                            <div class="group-input">
                                <label for="password">CAPA Extension Completed On </label>
                                <input class="extension_modal_signature" type="date" name="capa_on">
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit">
                                Submit
                            </button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- ===============================deviation=========== --}}
        <div class="modal fade" id="deviation_extension">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Deviation-Extension</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <div class="group-input">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text" name="username" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="password" name="password" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Proposed Due Date (Deviation)</label>
                                <input class="extension_modal_signature" type="date" name="deviation_due_capa">
                            </div>
                            <div class="group-input">
                                <label for="password">Extension Justification (Deviation)<span
                                        class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text"
                                    name="deviation_justification">
                            </div>
                            <div class="group-input">
                                <label for="password">Deviation Extension Completed By </label>
                                <select class="extension_modal_signature" name="deviation_extension_by"
                                    id="">
                                    <option value="">-- Select --</option>
                                </select>
                            </div>
                            <div class="group-input">
                                <label for="password">Deviation Extension Completed On </label>
                                <input class="extension_modal_signature" type="date" name="deviation_on">
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit">
                                Submit
                            </button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        {{-- =================================effectiveness extension============ --}}
        <div class="modal fade" id="effectivenss_extension">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <div class="launch_extension_header">
                            <h4 class="modal-title text-center">Launch Effectiveness Check</h4>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form method="POST">
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="main_head_modal">
                                <ul>
                                    <li>
                                        <div> <a href="" data-bs-toggle="modal"
                                                data-bs-target="#deviation_effectiveness"> Deviation Effectiveness
                                                Check</a></div>
                                    </li>

                                    <li>
                                        <div> <a href="" data-bs-toggle="modal"
                                                data-bs-target="#capa_effectiveness"> CAPA Effectivenss Check</a></div>
                                    </li>
                                    <li>
                                        <div> <a href="" data-bs-toggle="modal"
                                                data-bs-target="#qrm_effectiveness"> QRM Effectiveness Check</a></div>
                                    </li>
                                    <li>
                                        <div> <a href=""data-bs-toggle="modal"
                                                data-bs-target="#investigation_effectiveness"> Investigation Effectiveness
                                                Check</a></div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="submit">
                        Submit
                    </button> --}}
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- ===============================deviation effectiveness=========== --}}
        <div class="modal fade" id="deviation_effectiveness">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Deviation-Effectiveness</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <div class="group-input">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text" name="username" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="password" name="password" required>
                            </div>
                            <div class="group-input">
                                <label for="deviation">Effectiveness Check Plan(Deviation)</label>
                                <input class="extension_modal_signature" type="date"
                                    name="effectiveness_deviation">
                            </div>
                            <div class="group-input">
                                <label for="password">Deviation Effectiveness Check Plan Proposed By<span
                                        class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text"
                                    name="effectiveness_deviation_proposed_by">
                            </div>
                            <div class="group-input">
                                <label for="password">Deviation Effectiveness Check Plan Proposed On </label>
                                <input class="extension_modal_signature" type="text"
                                    name="deviation_effectiveness_by">
                            </div>
                            <div class="group-input">
                                <label for="password">Effectiveness Check Colsure Comments(Deviation)</label>
                                <input class="extension_modal_signature" type="date"
                                    name="deviation_effectiveness_on">
                            </div>
                            <div class="group-input">
                                <label for="password">Next Review Date(Deviation)</label>
                                <input class="extension_modal_signature" type="date" name="next_review_deviation">
                            </div>
                            <div class="group-input">
                                <label for="password">Deviation Effectiveness Check closed By </label>
                                <select class="extension_modal_signature" name="deviation_feectiveness_closed_by"
                                    id="">
                                    <option value="">-- Select --</option>
                                </select>
                            </div>
                            <div class="group-input">
                                <label for="password">Deviation Effectiveness Check CLosed On</label>
                                <input class="extension_modal_signature" type="date"
                                    name="deviation_effectiveness_on">
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit">
                                Submit
                            </button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- ===============================CAPA effectiveness=========== --}}
        <div class="modal fade" id="capa_effectiveness">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">CAPA-Effectiveness</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <div class="group-input">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text" name="username" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="password" name="password" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Effectiveness Check Plan(CAPA)</label>
                                <input class="extension_modal_signature" type="date"
                                    name="effectiveness_check_capa">
                            </div>
                            <div class="group-input">
                                <label for="password">CAPA Effectiveness Check Plan Proposed By<span
                                        class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text"
                                    name="_eefectiveness_capa_proposed_by">
                            </div>
                            <div class="group-input">
                                <label for="password">CAPA Effectiveness Check Plan Proposed On </label>
                                <input class="extension_modal_signature" type="text"
                                    name="deviation_effectiveness_by">
                            </div>
                            <div class="group-input">
                                <label for="password">Effectiveness Check Colsure Comments(CAPA)</label>
                                <input class="extension_modal_signature" type="date"
                                    name="deviation_effectiveness_on">
                            </div>
                            <div class="group-input">
                                <label for="password">Next Review Date(CAPA)</label>
                                <input class="extension_modal_signature" type="date" name="next_review_capa">
                            </div>
                            <div class="group-input">
                                <label for="password">CAPA Effectiveness Check closed By </label>
                                <select class="extension_modal_signature" name="capa_effectiveness_closed"
                                    id="">
                                    <option value="">-- Select --</option>
                                </select>
                            </div>
                            <div class="group-input">
                                <label for="password">CAPA Effectiveness Check CLosed On</label>
                                <input class="extension_modal_signature" type="date" name="capa_effectiveness_on">
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit">
                                Submit
                            </button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- ==============================QRM effectiveness=========== --}}
        <div class="modal fade" id="qrm_effectiveness">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">QRM-Effectiveness</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="mb-3 text-justify">
                                Please select a meaning and a outcome for this task and enter your username
                                and password for this task.
                            </div>
                            <div class="group-input">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text" name="username" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="password" name="password" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Effectiveness Check Plan(QRM)</label>
                                <input class="extension_modal_signature" type="date" name="deviation_due_capa">
                            </div>
                            <div class="group-input">
                                <label for="password">QRM Effectiveness Check Plan Proposed By<span
                                        class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text" name="qrm_proposed_by">
                            </div>
                            <div class="group-input">
                                <label for="password">QRM Effectiveness Check Plan Proposed On </label>
                                <input class="extension_modal_signature" type="text" name="qrm_effectiveness_by">
                            </div>
                            <div class="group-input">
                                <label for="password">Effectiveness Check Colsure Comments(QRM)</label>
                                <input class="extension_modal_signature" type="date" name="qrm_effectiveness_on">
                            </div>
                            <div class="group-input">
                                <label for="password">Next Review Date(QRM)</label>
                                <input class="extension_modal_signature" type="date" name="next_review_qrm">
                            </div>
                            <div class="group-input">
                                <label for="password">QRM Effectiveness Check closed By </label>
                                <select class="extension_modal_signature" name="qrm_effectivenss_check_by"
                                    id="">
                                    <option value="">-- Select --</option>
                                </select>
                            </div>
                            <div class="group-input">
                                <label for="password">QRM Effectiveness Check CLosed On</label>
                                <input class="extension_modal_signature" type="date" name="qrm_effectiveness_on">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit">
                                Submit
                            </button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- ==============================investigation effectiveness=========== --}}
        <div class="modal fade" id="investigation_effectiveness">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Investigation-Effectiveness</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <div class="group-input">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text" name="username" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="password" name="password" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Effectiveness Check Plan(Investigation)</label>
                                <input class="extension_modal_signature" type="date"
                                    name="investigation_effectivenss_check">
                            </div>
                            <div class="group-input">
                                <label for="password">Investigation Effectiveness Check Plan Proposed By<span
                                        class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text"
                                    name="investigation_effectivenss_by">
                            </div>
                            <div class="group-input">
                                <label for="password">Investigation Effectiveness Check Plan Proposed On </label>
                                <input class="extension_modal_signature" type="text"
                                    name="investigation_effectiveness_on">
                            </div>
                            <div class="group-input">
                                <label for="password">Effectiveness Check Colsure Comments(Investigation)</label>
                                <input class="extension_modal_signature" type="date"
                                    name="investigation_effectiveness_on">
                            </div>
                            <div class="group-input">
                                <label for="password">Next Review Date(Investigation)</label>
                                <input class="extension_modal_signature" type="date"
                                    name="investigation_effectiveness_on">
                            </div>
                            <div class="group-input">
                                <label for="password">Investigation Effectiveness Check closed By </label>
                                <select class="extension_modal_signature" name="investigation_effectiveness_by"
                                    id="">
                                    <option value="">-- Select --</option>
                                </select>
                            </div>
                            <div class="group-input">
                                <label for="password">Investigation Effectiveness Check CLosed On</label>
                                <input class="extension_modal_signature" type="date"
                                    name="investigation_effectiveness_on">
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit">
                                Submit
                            </button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- ==================================================================== --}}

        <!-- -----------------------------------------------------------modal body---------------------- -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div style="background: #f7f2f" class="modal-header">
                        <h4 class="modal-title">Customers</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <!-- Form for adding new customer -->
                        <form method="POST" id="customerForm">
                            @csrf
                            <style>
                                .validationClass {
                                    margin-left: 100px
                                }
                            </style>

                            <div class="modal-sub-head">
                                <div class="sub-main-head">
                                    <!-- Customer input fields -->
                                    <!-- Left box -->
                                    <div class="left-box">
                                        <!-- Customer ID -->
                                        <div class="Activity-type">
                                            <label style="font-weight: bold;" for="customer_id">Customer ID<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="text" id="customer_id" name="customer_id">
                                        </div>
                                        <span id="customer_id_error" class="text-danger validationClass"></span>
                                        <!-- Email -->
                                        <div class="Activity-type">
                                            <label style="font-weight: bold; margin-left: 30px;" for="email">Email
                                                ID<span class="text-danger">*</span> :</label>
                                            <input type="text" id="email" name="email">
                                        </div>
                                        <span id="email_error" class="text-danger validationClass"></span>
                                        <!-- Customer Type -->
                                        <div class="Activity-type">
                                            <label style="font-weight: bold; margin-left: -20px;"
                                                for="customer_type">Customer Type<span class="text-danger">*</span>
                                                :</label>
                                            <input type="text" id="customer_type" name="customer_type">
                                        </div>
                                        <span id="customer_type_error" class="text-danger validationClass"></span>
                                        <!-- Status -->
                                        <div class="Activity-type">
                                            <label style="font-weight: bold; margin-left: 42px;"
                                                for="status">Status<span class="text-danger">*</span> :</label>
                                            <input type="text" id="status" name="status">
                                        </div>
                                        <span id="status_error" class="text-danger validationClass"></span>
                                    </div>

                                    <!-- Right box -->
                                    <div class="right-box">
                                        <!-- Customer Name -->
                                        <div class="Activity-type">
                                            <label style="font-weight: bold;" for="customer_name">Customer Name<span
                                                    class="text-danger">*</span> :</label>
                                            <input type="text" id="customer_name" name="customer_name">
                                        </div>
                                        <span id="customer_name_error" class="text-danger validationClass"></span>
                                        <!-- Contact No -->
                                        <div class="Activity-type">
                                            <label style="font-weight: bold; margin-left: 36px;"
                                                for="contact_no">Contact No<span class="text-danger">*</span> :</label>
                                            <input type="text" id="contact_no" name="contact_no">
                                        </div>
                                        <span id="contact_no_error" class="text-danger validationClass"></span>
                                        <!-- Industry -->
                                        <div class="Activity-type">
                                            <label style="font-weight: bold; margin-left: 57px;"
                                                for="industry">Industry<span class="text-danger">*</span> :</label>
                                            <input type="text" id="industry" name="industry">
                                        </div>
                                        <span id="industry_error" class="text-danger validationClass"></span>
                                        <!-- Region -->
                                        <div class="Activity-type">
                                            <label style="font-weight: bold; margin-left: 66px; "
                                                for="region">Region<span class="text-danger">*</span> :</label>
                                            <input type="text" id="region" name="region">
                                        </div>
                                        <span id="region_id_error" class="text-danger validationClass"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Remarks -->
                            <div class="Activity-type">
                                <textarea style="margin-left: 126px; margin-top: 15px; width: 79%;" placeholder="Remarks" name="remarks"
                                    id="remarks" cols="30"></textarea>
                            </div>
                            <!-- Save button -->
                            <div
                                style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px;">
                                <button type="button" onclick="submitForm()" class="saveButton">Save</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>


        <!-- -----------------------------------------------------end---------------------- -->
        <style>
            #step-form>div {
                display: none
            }

            #step-form>div:nth-child(1) {
                display: block;
            }
        </style>
        <script>
            const saveButton = document.getElementById("ChangeSaveButton001");

            // Add a click event listener to the button
            saveButton.addEventListener("click", function() {
                // Handle the click event here
                document.getElementById("ChangesaveButton001").disabled = true;
                console.log("Save Changes button clicked");

            });

            function handleClick001() {
                // Disable the button to prevent multiple clicks
                document.getElementById("ChangesaveButton001").disabled = true;

                .then(() => {
                        // Re-enable the button after the action is completed
                        document.getElementById("ChangesaveButton001").disabled = false;
                    })
                    .catch(error => {
                        // Re-enable the button if an error occurs
                        document.getElementById("ChangesaveButton001").disabled = false;
                        console.error('An error occurred:', error);
                    });
            }

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
            VirtualSelect.init({
                ele: '#Facility, #Group, #Audit, #Auditee ,#related_records ,#audit_type, #investigation_approach'
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
            document.addEventListener('DOMContentLoaded', function() {
                const select = document.getElementById('investigation_approach');
                select.addEventListener('change', function() {
                    const selectedOptions = Array.from(select.selectedOptions).map(option => option.value);
                    console.log(selectedOptions); // You can do whatever you need with the selected options here
                });
            });
        </script>
        <script>
            function removeHtmlTags() {
                var textarea = document.getElementById("summernote-1");
                var cleanValue = textarea.value.replace(/<[^>]*>?/gm, ''); // Remove HTML tags
                textarea.value = cleanValue;
            }
        </script>
        <script>
            function removeHtmlTags() {
                var textarea = document.getElementById("summernote-2");
                var cleanValue = textarea.value.replace(/<[^>]*>?/gm, ''); // Remove HTML tags
                textarea.value = cleanValue;
            }
        </script>

        <script>
            function removeHtmlTags() {
                var textarea = document.getElementById("summernote-3");
                var cleanValue = textarea.value.replace(/<[^>]*>?/gm, ''); // Remove HTML tags
                textarea.value = cleanValue;
            }
        </script>
        <script>
            function removeHtmlTags() {
                var textarea = document.getElementById("summernote-15");
                var cleanValue = textarea.value.replace(/<[^>]*>?/gm, ''); // Remove HTML tags
                textarea.value = cleanValue;
            }
        </script>
        <script>
            function removeHtmlTags() {
                var textarea = document.getElementById("summernote-16");
                var cleanValue = textarea.value.replace(/<[^>]*>?/gm, ''); // Remove HTML tags
                textarea.value = cleanValue;
            }
        </script>


        {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const addRowButtons = document.querySelectorAll('.add-row');
        addRowButtons.forEach(button => {
            button.addEventListener('click', function() {
                const row = this.parentNode.parentNode; // Get the parent tr of the button

                const department = row.querySelector('td:first-child').innerText.trim(); // Get the department name
                const department1 = row.querySelector('td:first-child').nextElementSibling.querySelector('textarea').getAttribute('name'); // Get the department name

                // Create a new row and insert it after the current row
                const newRow = document.createElement('tr');
                newRow.innerHTML = `<td style="background: #e1d8d8">${department}</td>
                                    <td><textarea name="${department1}_Person"></textarea></td>
                                    <td><textarea name="${department1}_Impect_Assessment"></textarea></td>
                                    <td><textarea name="${department1}_Comments"></textarea></td>
                                    <td><textarea name="${department1}_sign&date"></textarea></td>
                                    <td><textarea name="${department1}_Remarks"></textarea></td>`;

                // Insert the new row after the current row
                row.parentNode.insertBefore(newRow, row.nextSibling);
            });
        });
    });
    </script> --}}


        {{-- // document.addEventListener('DOMContentLoaded', function() {
        //     document.getElementById('type_of_audit').addEventListener('change', function() {
        //         var typeOfAuditReqInput = document.getElementById('type_of_audit_req');
        //         if (typeOfAuditReqInput) {
        //             var selectedValue = this.value;
        //             if (selectedValue == 'others') {
        //                 typeOfAuditReqInput.setAttribute('required', 'required');
        //             } else {
        //                 typeOfAuditReqInput.removeAttribute('required');
        //             }
        //         } else {
        //             console.error("Element with id 'type_of_audit_req' not found");
        //         }
        //     });
        // }); --}}

        <script>
            document.getElementById('initiator_group').addEventListener('change', function() {
                var selectedValue = this.value;
                document.getElementById('initiator_group_code').value = selectedValue;
            });
        </script>
        <script>
            document.getElementById('department_capa').addEventListener('change', function() {
                var selectedValue = this.value;
                document.getElementById('department_capa_code').value = selectedValue;
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const select = document.getElementById('audit_type');
                select.addEventListener('change', function() {
                    const selectedOptions = Array.from(select.selectedOptions).map(option => option.value);
                    console.log(selectedOptions); // You can do whatever you need with the selected options here
                });
            });
        </script>

        <script>
            var maxLength = 255;
            $('#docname').keyup(function() {
                var textlen = maxLength - $(this).val().length;
                $('#rchars').text(textlen);
            });
        </script>
        <script>
            function addFishBone(top, bottom) {
                let mainBlock = document.querySelector('.fishbone-ishikawa-diagram');
                let topBlock = mainBlock.querySelector(top)
                let bottomBlock = mainBlock.querySelector(bottom)

                let topField = document.createElement('div')
                topField.className = 'grid-field fields top-field'

                let measurement = document.createElement('div')
                let measurementInput = document.createElement('input')
                measurementInput.setAttribute('type', 'text')
                measurementInput.setAttribute('name', 'measurement[]')
                measurement.append(measurementInput)
                topField.append(measurement)

                let materials = document.createElement('div')
                let materialsInput = document.createElement('input')
                materialsInput.setAttribute('type', 'text')
                materialsInput.setAttribute('name', 'materials[]')
                materials.append(materialsInput)
                topField.append(materials)

                let methods = document.createElement('div')
                let methodsInput = document.createElement('input')
                methodsInput.setAttribute('type', 'text')
                methodsInput.setAttribute('name', 'methods[]')
                methods.append(methodsInput)
                topField.append(methods)

                topBlock.prepend(topField)

                let bottomField = document.createElement('div')
                bottomField.className = 'grid-field fields bottom-field'

                let environment = document.createElement('div')
                let environmentInput = document.createElement('input')
                environmentInput.setAttribute('type', 'text')
                environmentInput.setAttribute('name', 'environment[]')
                environment.append(environmentInput)
                bottomField.append(environment)

                let manpower = document.createElement('div')
                let manpowerInput = document.createElement('input')
                manpowerInput.setAttribute('type', 'text')
                manpowerInput.setAttribute('name', 'manpower[]')
                manpower.append(manpowerInput)
                bottomField.append(manpower)

                let machine = document.createElement('div')
                let machineInput = document.createElement('input')
                machineInput.setAttribute('type', 'text')
                machineInput.setAttribute('name', 'machine[]')
                machine.append(machineInput)
                bottomField.append(machine)

                bottomBlock.append(bottomField)
            }

            function deleteFishBone(top, bottom) {
                let mainBlock = document.querySelector('.fishbone-ishikawa-diagram');
                let topBlock = mainBlock.querySelector(top)
                let bottomBlock = mainBlock.querySelector(bottom)
                if (topBlock.firstChild) {
                    topBlock.removeChild(topBlock.firstChild);
                }
                if (bottomBlock.lastChild) {
                    bottomBlock.removeChild(bottomBlock.lastChild);
                }
            }
        </script>

        <script>
            function addWhyField(con_class, name) {
                let mainBlock = document.querySelector('.why-why-chart')
                let container = mainBlock.querySelector(`.${con_class}`)
                let textarea = document.createElement('textarea')
                textarea.setAttribute('name', name);
                container.append(textarea)


                $(textarea).after('<button class="remove-row">Remove</button>');
                $(textarea).next('.remove-row').on('click', function() {
                    $(this).prev('textarea').remove();
                    $(this).remove();
                });
            }
        </script>

    @endsection
