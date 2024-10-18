@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->select('id', 'name')->get();

    @endphp

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

{{--@php
dd($pre);
@endphp--}}
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
                        '<td> <input type="text" name="facility_name[]" id="facility_name"> </td>' +
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
                        '<td> <input type= "text" name="product_stage[]" id=""> </td>' +
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
            let investigationIndex = 1;
            $('#investigation_Details').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    var userOptionsHtml = '';
                    users.forEach(user => {
                        userOptionsHtml = userOptionsHtml.concat(
                            `<option value="$(user.id)">${user.name}</option>`)
                    })

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td> <select name="Investigation_team[' + investigationIndex +
                        '][teamMember]" id=""> <option value="">-- Select --</option>' + userOptionsHtml +
                        ' </select> </td>' +
                        '<td><input type="text" class="numberDetail" name="Investigation_team[' +
                        investigationIndex + '][responsibility]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="Investigation_team[' +
                        investigationIndex + '][remarks]"></td>' +
                        '<td><button type="text" class="removeRowBtn" ">Remove</button></td>' +

                        '</tr>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +

                        '</tr>';
                    docIndex++;

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

    <script>
        $(document).ready(function() {
            let rootCauseIndex = 1;
            $('#rootCauseAdd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td> <select name="rootCauseData[' + rootCauseIndex +
                        '][rootCauseCategory]" id=""> <option value="">-- Select --</option><option value="">name   </option> </select></td>' +
                        '<td><select name="rootCauseData[' + rootCauseIndex +
                        '][rooCauseSubCategory]" id=""><option value="">-- Select --</option><option value="">name</option>  </select></td>' +
                        '<td><input type="text" class="Document_Remarks" name="rootCauseData[' +
                        rootCauseIndex + '][ifOthers]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="rootCauseData[' +
                        rootCauseIndex + '][probability]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="rootCauseData[' +
                        rootCauseIndex + '][remarks]"></td>' +
                        '<td><button type="text" class="removeRowBtn" ">Remove</button></td>' +

                        '</tr>';

                    rootCauseIndex++;
                    return html;
                }

                var tableBody = $('#rootCauseAddTable tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            let investigationTeamIndex = 1;
            $('#addInvestigationTeam').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    var userOptionsHtml = '';
                    users.forEach(user => {
                        userOptionsHtml = userOptionsHtml.concat(
                            `<option value="${user.id}">${user.name}</option>`)
                    });

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td> <select name="investigationTeam[' + investigationTeamIndex +
                        '][teamMember]" > <option value="">-- Select --</option>' + userOptionsHtml +
                        ' </select> </td>' +
                        ' <td><input type="text" name="investigationTeam[' + investigationTeamIndex +
                        '][responsibility]"></td>' +
                        '<td><input type="text" name="investigationTeam[' + investigationTeamIndex +
                        '][remarks]"></td>' +
                        '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';
                    '</tr>';

                    docIndex++;
                    return html;
                }
                var tableBody = $('#investigationDetailAddTable tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong>:
            {{ Helpers::getDivisionName(session()->get('division')) }}/Incident
        </div>
    </div>

    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">HOD Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">QA Initial Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">QA Head Designee Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Initiator Update</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm14')">HOD Final Review</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm12')">Extension</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm13')">QA Final Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QAH/Designee Closure Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>



                {{-- <button class="cctablinks " onclick="openCity(event, 'CCForm7')">CFT</button> --}}
                {{-- <button class="cctablinks " id="Investigation_button" style="display: none" --}}
                    {{-- onclick="openCity(event, 'CCForm9')">Investigation</button> --}}
                {{-- <button id="QRM_button" class="cctablinks" style="display: none"
                    onclick="openCity(event, 'CCForm11')">QRM</button> --}}

                {{-- <button id="CAPA_button" class="cctablinks" style="display: none"
                    onclick="openCity(event, 'CCForm10')">CAPA</button> --}}

            </div>
            <form class="formSubmit" id="auditform" action="{{ route('incident-store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="form_name" id="formNameField" value="">
                <div id="step-form">

                    <!-- General information content -->

                    @if ($errors->any())
                        @foreach ($errors as $error)
                            <div class="text-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                                            <!-- ----------GI-------- -->

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
                                        {{-- <input disabled type="text" name="record_number"> --}}
                                        <input disabled type="text" name="record" id="record"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/INC/{{ date('y') }}/{{ $data }}">
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input disabled type="text" name="division_id"
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
                                        <input readonly type="text" value="{{ date('d-M-Y') }}" name="intiation_date"
                                            id="intiation_date"
                                            style="background-color: light-dark(rgba(239, 239, 239, 0.3), rgba(59, 59, 59, 0.3))">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date_hidden">
                                    </div>
                                </div>

                                {{-- <div class="col-lg-12 new-date-data-field">
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
                                </div> --}}
                                <div class="col-lg-12 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule Start Date">Due Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_dateq" readonly
                                                placeholder="DD-MM-YYYY" />
                                            <input type="date" id="due_date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input"
                                                oninput="handleDateInput(this, 'due_dateq');checkDate('due_dateq')" />
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

                                {{-- <div class="col-lg-12">
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
                                </div> --}}

        {{--new department--}}

                        {{--<div class="col-lg-6">
                            <div class="group-input">
                                <label for="Short Description">Initiator Department <span
                                        class="text-danger"></span></label>
                                <select name="Initiator_Group" id="Initiator_Group">
                                    <option selected disabled value="">---select---</option>
                                    @foreach (Helpers::getInitiatorGroups() as $code => $Initiator_Group)
                                        <option value="{{ $Initiator_Group }}"
                                            data-code="{{ $code }}"
                                            @if (isset($data->Initiator_Group) && $data->Initiator_Group == $Initiator_Group)
                                                    selected
                                                @endif>
                                            {{ $Initiator_Group }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>--}}

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group"><b>Initiation Department
                                </b> <span
                                        class="text-danger">*</span></label>
                                <select name="Initiator_Group" id="initiator_group">
                                        <option value="">Select Department</option>
                                        <option value="CQA">Corporate Quality Assurance</option>
                                        <option value="QA">Quality Assurance</option>
                                        <option value="QC">Quality Control</option>
                                        <option value="QM">Quality Control (Microbiology department)</option>
                                        <option value="PG">Production General</option>
                                        <option value="PL">Production Liquid Orals</option>
                                        <option value="PT">Production Tablet and Powder</option>
                                        <option value="PE">Production External (Ointment, Gels, Creams and
                                            Liquid)</option>
                                        <option value="PC">Production Capsules</option>
                                        <option value="PI">Production Injectable</option>
                                        <option value="EN">Engineering</option>
                                        <option value="HR">Human Resource</option>
                                        <option value="ST">Store</option>
                                        <option value="IT">Electronic Data Processing</option>
                                        <option value="FD">Formulation Development</option>
                                        <option value="AL">Analytical research and Development Laboratory
                                        </option>
                                        <option value="PD">Packaging Development</option>
                                        <option value="PU">Purchase Department</option>
                                        <option value="DC">Document Cell</option>
                                        <option value="RA">Regulatory Affairs</option>
                                        <option value="PV">Pharmacovigilance</option>

                                </select>
                            </div>
                            {{--@error('Initiator_Group')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror--}}
                        </div>


                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group Code">Initiation Department Code</label>
                                <input readonly type="text" name="initiator_group_code"
                                    id="initiator_group_code"
                                    value="{{ $data->initiator_group_code ?? '' }}">
                            </div>
                        </div>

                                {{--<div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-group">Initiation Department </label>
                                        <select name="Initiator_Group" id="Initiator_group">
                                                <option value="">Select Department</option>
                                                <option value="CQA">Corporate Quality Assurance</option>
                                                <option value="QA">Quality Assurance</option>
                                                <option value="QC">Quality Control</option>
                                                <option value="QM">Quality Control (Microbiology department)</option>
                                                <option value="PG">Production General</option>
                                                <option value="PL">Production Liquid Orals</option>
                                                <option value="PT">Production Tablet and Powder</option>
                                                <option value="PE">Production External (Ointment, Gels, Creams and
                                                    Liquid)</option>
                                                <option value="PC">Production Capsules</option>
                                                <option value="PI">Production Injectable</option>
                                                <option value="EN">Engineering</option>
                                                <option value="HR">Human Resource</option>
                                                <option value="ST">Store</option>
                                                <option value="IT">Electronic Data Processing</option>
                                                <option value="FD">Formulation Development</option>
                                                <option value="AL">Analytical research and Development Laboratory
                                                </option>
                                                <option value="PD">Packaging Development</option>
                                                <option value="PU">Purchase Department</option>
                                                <option value="DC">Document Cell</option>
                                                <option value="RA">Regulatory Affairs</option>
                                                <option value="PV">Pharmacovigilance</option>
                                        </select>--}}
                                        {{-- @error('Initiator_Group')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror --}}
                                    {{--</div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Department Code</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code"
                                            value="" readonly>
                                    </div>
                                </div>--}}

                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="short_description_required">Equipment Name</label>
                                        <select name="equipment_name" id="equipment_name" required>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no"> No</option>
                                            <option value="na">NA</option>
                                        </select>
                                    </div>
                                    @error('equipment_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="instrument_name">Instrument Name</label>
                                        <select name="instrument_name" id="instrument_name" required>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no"> No</option>
                                            <option value="na">NA</option>
                                        </select>
                                    </div>
                                    @error('instrument_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="facility_name">Facility Name</label>
                                        <select name="inc_facility_name" id="inc_facility_name" required>
                                            <option value="0">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no"> No</option>
                                            <option value="na">NA</option>
                                        </select>
                                    </div>
                                    @error('inc_facility_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                        <label for="short_description_required">Repeat Incident?</label>
                                        <select name="short_description_required" id="short_description_required"
                                            required>
                                            <option value="0">-- Select --</option>
                                            <option value="Recurring" @if (old('short_description_required') == 'Recurring') selected @endif>
                                                Yes</option>
                                            <option value="Non-Recurring"
                                                @if (old('short_description_required') == 'Non-Recurring') selected @endif>
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
                                        <textarea name="nature_of_repeat" class="nature_of_repeat"></textarea>
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
                                        <label for="Incident date">Incident Observed On (Date)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="incident_date" readonly placeholder="DD-MM-YYYY" />
                                            {{-- <td><input type="time" name="scheduled_start_time[]"></td> --}}
                                            <input type="date" name="incident_date"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'incident_date')" />
                                        </div>
                                    </div>
                                    @error('incident_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6 new-time-data-field">
                                    <div class="group-input input-time">
                                        <label for="incident_time">Incident Observed On (Time)</label>
                                        <input type="text" name="incident_time" id="incident_time">
                                    </div>
                                    @error('incident_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{--<div class="col-lg-6 new-time-data-field">
                                    <div class="group-input input-time">
                                        <label for="incident_time">Incident Observed On (Time)</label>
                                        <input type="text" name="incident_time" id="incident_time">
                                    </div>
                                    @error('incident_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>--}}

                                <div class="col-lg-6 new-time-data-field">
                                    <div class="group-input input-time delayJustificationBlock">
                                        <label for="incident_time">Delay Justification</label>
                                        <textarea id="Delay_Justification" name="Delay_Justification"></textarea>
                                    </div>
                                    {{-- @error('incident_date')
                                        <div class="text-danger">{{  $message  }}</div>
                                    @enderror --}}
                                </div>

                                <script>
                                    flatpickr("#incident_time", {
                                        enableTime: true,
                                        noCalendar: true,
                                        dateFormat: "H:i", // 24-hour format without AM/PM
                                        minuteIncrement: 1, // Set minute increment to 1
                                        time_24hr: true // Force 24-hour format in the time picker
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="facility">Incident Observed By</label>
                                        <input type="text" name="Facility" id="incident_observed_by"
                                            placeholder="Enter Person Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule End Date">Incident Reported on</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="incident_reported_date" readonly
                                                placeholder="DD-MM-YYYY" />
                                            <input type="date" name="incident_reported_date"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'incident_reported_date')" />
                                        </div>
                                    </div>
                                </div>
                                {{--<script>
                                    $('.delayJustificationBlock').hide();

                                    function calculateDateDifference() {
                                        let incidentDate = $('input[name=incident_date]').val();
                                        let reportedDate = $('input[name=incident_reported_date]').val();

                                        if (!incidentDate || !reportedDate) {
                                            console.error('Incident date or reported date is missing.');
                                            return;
                                        }

                                        let incidentDateMoment = moment(incidentDate);
                                        let reportedDateMoment = moment(reportedDate);

                                        let diffInDays = reportedDateMoment.diff(incidentDateMoment, 'days');

                                        if (diffInDays > 0) {
                                            $('.delayJustificationBlock').show();
                                        } else {
                                            $('.delayJustificationBlock').hide();
                                        }

                                    }

                                    $('input[name=incident_date]').on('change', function() {
                                        calculateDateDifference();
                                    })

                                    $('input[name=incident_reported_date]').on('change', function() {
                                        calculateDateDifference();
                                    })
                                </script>--}}

                                {{--<script>
                                    $(document).ready(function() {
                                        // Hide the delayJustificationBlock initially
                                        $('.delayJustificationBlock').hide();

                                        // Check the condition on page load
                                        checkDateDifference();
                                    });

                                    function checkDateDifference() {
                                        let incidentDate = $('input[name=incident_date]').val();
                                        let incidentTime = $('input[name=incident_time]').val(); // Get incident time

                                        if (!incidentDate || !incidentTime) {
                                            console.error('Incident date or time is missing.');
                                            return;
                                        }

                                        // Combine the incident date and time into a single moment object
                                        let incidentDateTime = moment(`${incidentDate} ${incidentTime}`, 'YYYY-MM-DD HH:mm');
                                        let currentDateTime = moment(); // Get current date and time

                                        // Calculate the difference in hours
                                        let diffInHours = currentDateTime.diff(incidentDateTime, 'hours');

                                        // Show delay justification if the difference is more than 24 hours
                                        if (diffInHours > 24) {
                                            $('.delayJustificationBlock').show();
                                        } else {
                                            $('.delayJustificationBlock').hide();
                                        }
                                    }

                                    // Call checkDateDifference whenever the values are changed
                                    $('input[name=incident_date], input[name=incident_time]').on('change', function() {
                                        checkDateDifference();
                                    });
                                </script>--}}

                                <script>
                                    $(document).ready(function() {
                                        // Hide the delayJustificationBlock initially
                                        $('.delayJustificationBlock').hide();

                                        // Check the condition on page load or whenever input changes
                                        checkDateDifference();

                                        // Call checkDateDifference whenever the values are changed
                                        $('input[name=incident_date], input[name=incident_time]').on('change', function() {
                                            checkDateDifference();
                                        });
                                    });

                                    function checkDateDifference() {
                                        let incidentDate = $('input[name=incident_date]').val(); // Incident Date
                                        let incidentTime = $('input[name=incident_time]').val(); // Incident Time

                                        if (!incidentDate || !incidentTime) {
                                            console.error('Incident date or time is missing.');
                                            $('.delayJustificationBlock').hide(); // Ensure it's hidden if either is missing
                                            return;
                                        }

                                        // Combine the incident date and time into a single moment object
                                        let incidentDateTime = moment(`${incidentDate} ${incidentTime}`, 'YYYY-MM-DD HH:mm');
                                        let currentDateTime = moment(); // Get the current date and time

                                        // Calculate the difference in hours
                                        let diffInHours = currentDateTime.diff(incidentDateTime, 'hours');
                                        //alert(diffInHours);
                                        // Show delay justification if the difference is more than 24 hours
                                        if (diffInHours < 24) {
                                            $('.delayJustificationBlock').hide();

                                        } else {
                                            $('.delayJustificationBlock').show();
                                        }
                                    }
                                </script>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="audit type">Incident Related To </label>
                                        <select multiple name="audit_type[]" id="audit_type">
                                            {{-- <option value="">Enter Your Selection Here</option> --}}
                                            <option value="Equipment/Instrument">Equipment/Instrument/System </option>
                                            <option value="Material_System">Material</option>
                                            <option value="process">Process</option>
                                            <option value="Anyother(specify)">Any other (specify) </option>
                                            {{-- <option value="Documentationerror">Documentation error </option>
                                            <option value="STP/ADS_instruction">STP/ADS instruction </option>
                                            <option value="Packaging&Labelling">Packaging & Labelling </option>
                                            <option value="Laboratory_Instrument/System"> Laboratory Instrument /System
                                            </option>
                                            <option value="Facility">Facility</option>
                                            <option value="Utility_System"> Utility System</option>
                                            <option value="Computer_System"> Computer System</option> --}}
                                            {{-- <option value="Document">Document</option> --}}
                                            {{-- <option value="Data integrity">Data integrity</option>
                                            <option value="SOP Instruction">SOP Instruction</option>
                                            <option value="BMR/ECR Instruction">BMR/ECR Instruction</option>
                                            <option value="Water System">Water System</option> --}}

                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="audit type">Incident Related To </label>
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

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="search"> Department Head <span class="text-danger"></span> </label>
                                        <select id="select-state" placeholder="Select..." name="department_head">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('inv_head_designee')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="search"> QA Reviewer <span class="text-danger"></span> </label>
                                        <select id="select-state" placeholder="Select..." name="qa_reviewer">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('inv_head_designee')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </div>
                                </div>
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
                                                <td><input type="text" name="facility_name[]" class="facilityName"></td>
                                                <td><input type="text" name="IDnumber[]" class="id-number"></td>
                                                <td><input type="text" name="Remarks[]" class="remarks"></td>
                                                <td><button class="removeRowBtn">Remove</button></td>
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
                                        {{--document-details-field-instruction-modal--}}
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal1"
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
                                                    {{--<th style="width: 16%"> Reference Document Name</th>--}}
                                                    <th style="width: 16%">Document Name</th>
                                                    <th style="width: 16%">Remarks</th>
                                                    <th style="width: 8%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial[]" value="1"></td>
                                                <td><input type="text" class="numberDetail" name="Number[]"></td>
                                                <td><input type="text" class="ReferenceDocumentName"
                                                        name="ReferenceDocumentName[]"></td>
                                                <td><input type="text" class="Document_Remarks"
                                                        name="Document_Remarks[]"></td>
                                                        <td><button class="removeRowBtn">Remove</button></td>


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
                                        <label for="Product Details Required">Product / Material Details Required?</label>
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
                                            Product / Material Details
                                                    {{--Batch--}}
                                            <button type="button" name="audit-agenda-grid"
                                                id="Product_Details">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#observation-field-instruction-modal2"
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
                                                        <th style="width: 12%">Product / Material</th>
                                                        <th style="width: 16%"> Stage</th>
                                                        <th style="width: 16%">A.R.No. / Batch No</th>
                                                        <th style="width: 8%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <td><input disabled type="text" name="serial[]" value="1">
                                                    </td>
                                                    <td><input type="text" class="productName" name="product_name[]">
                                                    </td>
                                                    <td><input type="text" name="product_stage[]" id="product_stage">
                                                    </td>
                                                    <td><input type="text" class="productBatchNo" name="batch_no[]">
                                                    </td>
                                                    <td><button class="removeRowBtn">Remove</button></td>


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
                                        <label for="Description Incident">Description of Incident</label>
                                        <textarea class="" id="Description_incident" name="Description_incident[]"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Description Incident">Description of Incident</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Description_incident" id="summernote-1" required> </textarea>
                                    </div>
                                    @error('Description_incident[]')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Description Incident">Investigation</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="investigation"  > </textarea>
                                    </div>
                                    @error('investigation[]')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Description Incident">Immediate corrective action</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="immediate_correction"  > </textarea>
                                    </div>
                                    @error('immediate_correction[]')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="col-6">
                                <div class="group-input">
                                        <label for="ImmediateAction">Immediate Action (if any)</label>
                                        <textarea class="" id="Immediate_Action" name="Immediate_Action[]"></textarea>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Immediate Action">Immediate Action (if any)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Immediate_Action[]" id="summernote-2"></textarea>
                                    </div>
                                    @error('record')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                                {{-- <div class="col-6">
                                <div class="group-input">
                                        <label for="Preliminary Impact">Preliminary Impact of Incident</label>
                                        <textarea class="" id="Preliminary_Impact" name="Preliminary_Impact[]"></textarea>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Preliminary Impact">Preliminary Impact of Incident </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Preliminary_Impact[]" id="summernote-3" required>  </textarea>
                                    </div>
                                    @error('Preliminary_Impact')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Initial Attachment</label>
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

                                <button type="submit" class="saveButton on-submit-disable-button">Save</button>

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
                                        <label for="HOD Remarks">Review Of Incident And Verification Of Effectiveness Of Corrcetion</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="review_of_verific" disabled>  </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="HOD Remarks">Recommendations</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Recommendations" disabled>  </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="HOD Remarks">Impact Assessment</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Impact_Assessmenta" disabled>  </textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments">HOD Remark</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                        <textarea name="HOD_Remarks" disabled> </textarea>
                                    </div>
                                </div>
                                 <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">HOD Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="hod_attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="HOD_Attachments" name="hod_attachments[]"
                                                    oninput="addMultipleFiles(this, 'hod_attachments')" multiple disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton on-submit-disable-button">Save</button>


                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="backButton" onclick="previousStep()">Back</button>

                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
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
                    <style>
                        .form-section {
                            /* display: grid; */
                            grid-template-columns: auto auto;
                            align-items: center;
                        }

                        .form-section > div {
                            padding: 10px;
                        }

                        /* .divider {
                            width: 2px;
                            background-color: black;
                            height: 100%;
                        } */

                        .radio-group {
                            display: flex;
                            flex-direction: column;
                        }

                        label {
                            font-weight: bold;
                        }
                        .main-group{
                            display: flex;
                            gap:20px;
                            border: 2px solid gray;
                            padding: 10px;

                            border-radius: 5px;
                        }
                    </style>

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="form-section">
                                    <!-- Incident Fields Section -->
                                    <div>
                                        <!-- Product Quality Impact -->
                                        <div class="main-group">
                                            <div>
                                                <label>Product Quality Impact:</label>
                                            </div>
                                            <div class="checkbox-group">
                                                <label><input type="checkbox" name="product_quality_imapct" value="yes" onclick="selectOne(this)" disabled> Yes</label>
                                                <label><input type="checkbox" name="product_quality_imapct" value="no" onclick="selectOne(this)" disabled> No</label>
                                                <label><input type="checkbox" name="product_quality_imapct" value="na" onclick="selectOne(this)" disabled> N/A</label>
                                            </div>
                                        </div>
                                        <br>

                                        <!-- Process Performance Impact -->
                                        <div class="main-group">
                                           <div>
                                            <label>Process Performance Impact:</label>
                                           </div>
                                        <div class="checkbox-group">
                                            <label><input type="checkbox" name="process_performance_impact" value="yes" onclick="selectOne(this)" disabled> Yes</label>
                                            <label><input type="checkbox" name="process_performance_impact" value="no" onclick="selectOne(this)" disabled> No</label>
                                            <label><input type="checkbox" name="process_performance_impact" value="na" onclick="selectOne(this)" disabled> N/A</label>
                                        </div>
                                        </div>
                                        <br>

                                        <!-- Yield Impact -->
                                        <div class="main-group">
                                            <div>
                                                <label>Yield Impact:</label>
                                            </div>
                                           <div class="checkbox-group">
                                            <label><input type="checkbox" name="yield_impact" value="yes" onclick="selectOne(this)"> Yes</label>
                                            <label><input type="checkbox" name="yield_impact" value="no" onclick="selectOne(this)"> No</label>
                                            <label><input type="checkbox" name="yield_impact" value="na" onclick="selectOne(this)"> N/A</label>
                                        </div>

                                        </div>
                                        <br>


                                        <!-- GMP Impact -->
                                        <div class="main-group">
                                            <div>
                                                <label>GMP Impact:</label>
                                            </div>
                                        <div class="checkbox-group">
                                            <label><input type="checkbox" name="gmp_impact" value="yes" onclick="selectOne(this)" disabled> Yes</label>
                                            <label><input type="checkbox" name="gmp_impact" value="no" onclick="selectOne(this)" disabled> No</label>
                                            <label><input type="checkbox" name="gmp_impact" value="na" onclick="selectOne(this)" disabled> N/A</label>
                                        </div>

                                        </div>
                                        <br>
                                        <div class="main-group">
                                            <div>
                                                <label>Additional Testing Required:</label>
                                            </div>
                                        <!-- Additional Testing Required -->
                                        <div class="checkbox-group">
                                            <label><input type="checkbox" name="additionl_testing_required" value="yes" onclick="selectOne(this)" disabled> Yes</label>
                                            <label><input type="checkbox" name="additionl_testing_required" value="no" onclick="selectOne(this)" disabled> No</label>
                                            <label><input type="checkbox" name="additionl_testing_required" value="na" onclick="selectOne(this)" disabled> N/A</label>
                                        </div>
                                        </div>
                                        <br>

                                    <div class="col-md-12 mb-3">
                                        <div class="group-input">
                                            <label for="QAInitialRemark">If Yes, Then Mention:</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>
                                            <textarea class="tiny" name="any_similar_incident_in_past" disabled></textarea>
                                        </div>
                                    </div>



                                    <!-- Vertical Line Divider -->
                                    <div class="divider"></div>

                                    <!-- Right Column -->
                                    <div>
                                        <div class="main-group">
                                            <div>
                                                <label>Any Similar Incident in Past:</label>
                                            </div>
                                        <!-- Similar Incident in Past -->
                                        <div class="checkbox-group">
                                            <label><input type="checkbox" name="capa_require" value="yes" onclick="selectOne(this)" disabled> Yes</label>
                                            <label><input type="checkbox" name="capa_require" value="no" onclick="selectOne(this)" disabled> No</label>
                                            <label><input type="checkbox" name="capa_require" value="na" onclick="selectOne(this)" disabled> N/A</label>
                                        </div>
                                        </div>
                                        <br>

                                        <!-- Classification by QA -->
                                        <div class="main-group">
                                            <div>
                                                <label>Classification by QA:</label>
                                            </div>
                                        <div class="checkbox-group">
                                            <label><input type="checkbox" name="classification_by_qa" value="critical" onclick="selectOne(this)" disabled> Critical</label>
                                            <label><input type="checkbox" name="classification_by_qa" value="non-critical" onclick="selectOne(this)" disabled> Non-Critical</label>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="QAInitialRemark">QA Initial Review Remarks</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="QAInitialRemark" id="summernote-7" disabled></textarea>
                                    </div>
                                </div>

                            <br>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="QA attachments">QA Initial Review Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_attachmentss"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Initial_attachment[]"
                                                    oninput="addMultipleFiles(this, 'QA_attachmentss')" multiple disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            </form>

                            </div>
                            <div class="button-block">
                                <button type="submit" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="saveButton on-submit-disable-button">Save</button>

                                <button type="button" class="backButton" onclick="previousStep()">Back</button>

                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
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


                    <!-- ----------QA HEAD Designee Approval-------- -->
                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="col-12 sub-head">
                                QA Head/Designee Approval
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="HOD Remarks">QA Head/Designee Approval Comment</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="qa_head_deginee_comment" id="summernote-4" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">QA Head/Designee Approval Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_Desinee_attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="qa_head_deginee_attachments[]"
                                                    oninput="addMultipleFiles(this, 'QA_Desinee_attachments')" multiple disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="button-block">
                                <button type="submit" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="saveButton on-submit-disable-button">Save </button>

                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="backButton" onclick="previousStep()">Back</button>

                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
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







                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="form-section">



                                                                {{-- <script>
                                    function selectOne(checkbox) {
                                                        const checkboxes = checkbox.closest('.checkbox-group').querySelectorAll('input[type="checkbox"]');

                                                        checkboxes.forEach((item) => {
                                                            if (item !== checkbox) {
                                                                item.checked = false; // Uncheck other checkboxes in the group
                                                            }
                                                        });
                                                    }
                                    </script>                                                      --}}
                                    <!-- Incident Fields Section -->
                                      <div>
                                        {{-- <div class="main-group">
                                            <div>
                                                <label>Product Quality Impact:</label>
                                            </div>
                                            <div class="checkbox-group">
                                                <label><input type="checkbox" name="product_quality_imapct" value="yes" onclick="selectOne(this)"> Yes</label>
                                                <label><input type="checkbox" name="product_quality_imapct" value="no" onclick="selectOne(this)"> No</label>
                                                <label><input type="checkbox" name="product_quality_imapct" value="na" onclick="selectOne(this)"> N/A</label>
                                            </div>
                                        </div> --}}

                                        <div class="main-group">
                                            <div>
                                                <label>CAPA Implementation:</label>
                                            </div>

                                        <div class="checkbox-group">
                                            <label><input type="checkbox" name="capa_implementation" value="yes" onclick="selectOne(this)" disabled> Yes</label>
                                            <label><input type="checkbox" name="capa_implementation" value="no" onclick="selectOne(this)" disabled> No</label>
                                            <label><input type="checkbox" name="capa_implementation" value="na" onclick="selectOne(this)" disabled> N/A</label>
                                        </div>
                                        </div>
                                        <br>

                                        <!-- Process Performance Impact -->
                                        <div class="main-group">
                                            <div>
                                                <label >All check points compiled with (Documentary evidence shall be attached or referred to):</label>
                                            </div>

                                        <div class="checkbox-group">
                                            <label><input type="checkbox" name="check_points" value="yes" onclick="selectOne(this)" disabled> Yes</label>
                                            <label><input type="checkbox" name="check_points" value="no" onclick="selectOne(this)" disabled> No</label>
                                            <label><input type="checkbox" name="check_points" value="na" onclick="selectOne(this)" disabled> N/A</label>
                                        </div>
                                        </div>
                                        <br>

                                        <!-- Yield Impact -->
                                        <div class="main-group">
                                            <div>
                                                <label >Based upon the assessment of the corrective actions planned, whether unplanned deviation is required:</label>
                                            </div>

                                        <div class="checkbox-group">
                                            <label><input type="checkbox" name="corrective_actions" value="yes" onclick="selectOne(this)" disabled> Yes</label>
                                            <label><input type="checkbox" name="corrective_actions" value="no" onclick="selectOne(this)" disabled> No</label>
                                            <label><input type="checkbox" name="corrective_actions" value="na" onclick="selectOne(this)" disabled> N/A</label>
                                        </div>
                                       </div>
                                        <br>

                                        <!-- GMP Impact -->
                                        <div class="main-group">
                                            <div>
                                                <label>Batch release satisfactory:</label>
                                            </div>

                                          <div class="checkbox-group">
                                            <label><input type="checkbox" name="batch_release" value="yes" onclick="selectOne(this)" disabled> Yes</label>
                                            <label><input type="checkbox" name="batch_release" value="no" onclick="selectOne(this)" disabled> No</label>
                                            <label><input type="checkbox" name="batch_release" value="na" onclick="selectOne(this)" disabled> N/A</label>
                                          </div>
                                        </div>
                                        <br>
                                        {{-- <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Closure">Closure</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                                <textarea class="tiny" name="closure_ini" id="summernote-14"></textarea>
                                            </div>
                                        </div> --}}

                                        <!-- Additional Testing Required -->
                                        <div class="main-group">
                                            <div>
                                                <label>Affected documents closed:</label>
                                            </div>

                                        <div class="checkbox-group">
                                            <label><input type="checkbox" name="affected_documents" value="yes" onclick="selectOne(this)" disabled> Yes</label>
                                            <label><input type="checkbox" name="affected_documents" value="no" onclick="selectOne(this)" disabled> No</label>
                                            <label><input type="checkbox" name="affected_documents" value="na" onclick="selectOne(this)" disabled> N/A</label>
                                        </div>
                                        </div>
                                        <br>

                                        <!-- If Yes, Then Mention -->

                                    </div>

                                    <!-- Vertical Line Divider -->
                                    <div class="divider"></div>

                                    <!-- Right Column -->
                                    <div>
                                        <!-- Similar Incident in Past -->


                                        <!-- Classification by QA -->


                                    </div>
                                 </div>
                                      <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="QA Feedbacks">Initiator Update Comments</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="QA_Feedbacks" id="summernote-14" disabled>  </textarea>
                                    </div>
                                    </div>
                                  <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="QA attachments">Initiator Update Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_attachmentsa"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="QA_attachments[]"
                                                    oninput="addMultipleFiles(this, 'QA_attachmentsa')" multiple disabled>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
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
                    <!-- ----------QA HEAD Approved-------- -->
                    <div id="CCForm14" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="HOD Remarks">HOD Final Review  Comments</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="qa_head_Remarks" id="summernote-4" disabled>  </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">HOD Final Review  Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="qa_head_attachments[]"
                                                    oninput="addMultipleFiles(this, 'QA_attachments')" multiple disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="button-block">
                                <button type="submit" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="saveButton on-submit-disable-button">Save </button>

                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="backButton" onclick="previousStep()">Back</button>

                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
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

                       {{-- <script>
                         function selectOne(checkbox) {
                         const checkboxes = document.getElementsByName('additional_testing_required');

                           checkboxes.forEach((item) => {
                             if (item !== checkbox) {
                                item.checked = false; // Uncheck other checkboxes
                               }
                             });
                               }

                        </script>--}}
                        <script>
                            function selectOne(checkbox) {
                                                const checkboxes = checkbox.closest('.checkbox-group').querySelectorAll('input[type="checkbox"]');

                                                checkboxes.forEach((item) => {
                                                    if (item !== checkbox) {
                                                        item.checked = false; // Uncheck other checkboxes in the group
                                                    }
                                                });
                                            }
                            </script>
                    <script>
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
                    </script>

                    <!-- Initiator Update -->

                    <!-- ----------Qa Fina Review-------- -->
                    <div id="CCForm13" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="HOD Remarks">QA Final Review Comments</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="qa_final_review" id="summernote-4" disabled>  </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">QA Final Review Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="hod_attachmentsb"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="QA_attachments" name="qa_final_ra_attachments[]"
                                                    oninput="addMultipleFiles(this, 'hod_attachmentsb')" multiple disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="saveButton on-submit-disable-button">Save </button>

                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="backButton" onclick="previousStep()">Back</button>

                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
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
                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                {{-- <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Post Categorization Of Incident">Post Categorization Of
                                            Incident</label>
                                        <div><small class="text-primary">Please Refer Intial Incident category before
                                                updating.</small></div>
                                        <select name="Post_Categorization" id="Post_Categorization" >
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
                                        <label for="Investigation Of Revised Categorization">Justification for Revised
                                            Category</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Investigation_Of_Review" id="summernote-13">   </textarea>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Remarks">Closure Comments</label>
                                        <textarea class="tiny" name="Closure_Comments" id="summernote-15" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Disposition of Batch</label>
                                        <textarea class="tiny" name="Disposition_Batch" id="summernote-16" disabled></textarea>
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
                                                    oninput="addMultipleFiles(this, 'closure_attachment')" multiple disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="button-block">
                                <button type="submit" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="saveButton on-submit-disable-button">Save</button>
                                    <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
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



                </div>




                <!-- Activity Log content -->
                <div id="CCForm6" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head">Submit</div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="submit by">Submit By :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="submit on">Submit On :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submit on">Submit Comment :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="submit comment">Submit Comments :-</label>
                                    <div class="static"></div>
                                </div>
                            </div> --}}
                            <div class="sub-head">HOD Initial Review Complete</div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="HOD Review Complete By">HOD Initial Review Complete By :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="HOD Initial Review Complete On">HOD Initial Review Complete On :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="HOD Initial Review Complete On">HOD Initial Review Complete Comment :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submit on">More Information
                                        Required By :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submit on">More Information
                                        Required On :-</label>
                                    <div class="static"></div>
                                </div>
                            </div> --}}


                            {{-- <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="HOD Review Comments">HOD Review Comments :-</label>
                                    <div class="static"></div>
                                </div>
                            </div> --}}


                            <div class="sub-head">QA Initial Review Complete</div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="QA Initial Review Complete By">QA Initial Review Complete By
                                        :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="QA Initial Review Complete On">QA Initial Review Complete On
                                        :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="QA Initial Review Complete On">QA Initial Review Complete Comment
                                        :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>


                            <div class="sub-head">QAH/Designee Approval Complete</div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="QA Initial Review Complete By">QAH/Designee Approval Complete By:-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="QA Initial Review Complete On">QAH/Designee Approval Complete On:-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="QA Initial Review Comments">QAH/Designee Approval Complete Comment:-</label>
                                    <div class=""></div>
                                </div>
                            </div>


                            <div class="sub-head">Pending Initiator Update Complete</div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="CFT Review Complete By">Pending Initiator Update Complete By :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="Pending Initiator Update Complete On">Pending Initiator Update Complete On :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Pending Initiator Update Complete On">Pending Initiator Update Complete Comment :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submit on">More Information
                                        Required By :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submit on">More Information
                                        Required On :-</label>
                                    <div class="static"></div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="CFT Review Comments">CFT Review Comments :-</label>
                                    <div class="static"></div>
                                </div>
                            </div> --}}
                            <div class="sub-head">HOD Final Review Completed</div>

                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="CFT Review Complete By">HOD Final Review Complete By :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="CFT Review Complete On">HOD Final Review Complete On :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="CFT Review Comments">HOD Final Review Complete Comment :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submit on">More Information
                                        Required By :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submit on">More Information
                                        Required On :-</label>
                                    <div class="static"></div>
                                </div>
                            </div> --}}
                            <div class="sub-head"> QA Final Review Complete</div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="QA Final Review Complete By"> QA Final Review Complete By :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="QA Final Review Complete On"> QA Final Review Complete On :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="QA Final Review Complete On"> QA Final Review Complete Comment :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="sub-head"> Approved</div>

                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="Approved By"> Approved By :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="Approved On">Approved On :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved On">Approved Comment :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submit on">More Information
                                        Required By :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submit on">More Information
                                        Required On :-</label>
                                    <div class="static"></div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Approved Comments">Approved Comments :-</label>
                                    <div class="static"></div>
                                </div>
                            </div> --}}
                            {{--<div class="sub-head">cancel</div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submit by">cancel By :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="cancelled on">cancel On :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="cancelled on">cancel Comment :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>--}}
                            <div class="sub-head">
                                cancel
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="submit by">cancel By :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled on">cancel On :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="cancelled on">cancel Comment :-</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            {{-- <button type="submit" class="saveButton">Save</button> --}}
                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="backButton" onclick="previousStep()">Back</button>
                            {{-- <button type="submit">Submit</button> --}}
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
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
                        <h4 class="modal-title">Incident Workflow</h4>
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
                                                data-bs-target="#incident_extension"> Incident</a></div>
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
        {{-- <div class="modal fade" id="capa_extension">
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
        </div> --}}
        {{-- ===============================Incident=========== --}}
        {{-- <div class="modal fade" id="incident_extension">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Incident-Extension</h4>
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
                                <label for="password">Proposed Due Date (Incident)</label>
                                <input class="extension_modal_signature" type="date" name="incident_due_capa">
                            </div>
                            <div class="group-input">
                                <label for="password">Extension Justification (Incident)<span
                                        class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text" name="incident_justification">
                            </div>
                            <div class="group-input">
                                <label for="password">Incident Extension Completed By </label>
                                <select class="extension_modal_signature" name="incident_extension_by" id="">
                                    <option value="">-- Select --</option>
                                </select>
                            </div>
                            <div class="group-input">
                                <label for="password">Incident Extension Completed On </label>
                                <input class="extension_modal_signature" type="date" name="incident_on">
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
        </div> --}}


        {{-- =================================effectiveness extension============ --}}
        {{-- <div class="modal fade" id="effectivenss_extension">
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
                                                data-bs-target="#incident_effectiveness"> Incident Effectiveness
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
                    </button> -
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
        {{-- <div class="modal fade" id="incident_effectiveness">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Incident-Effectiveness</h4>
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
                                <label for="Incident">Effectiveness Check Plan(Incident)</label>
                                <input class="extension_modal_signature" type="date" name="effectiveness_incident">
                            </div>
                            <div class="group-input">
                                <label for="password">Incident Effectiveness Check Plan Proposed By<span
                                        class="text-danger">*</span></label>
                                <input class="extension_modal_signature" type="text"
                                    name="effectiveness_incident_proposed_by">
                            </div>
                            <div class="group-input">
                                <label for="password">Incident Effectiveness Check Plan Proposed On </label>
                                <input class="extension_modal_signature" type="text"
                                    name="incident_effectiveness_by">
                            </div>
                            <div class="group-input">
                                <label for="password">Effectiveness Check Colsure Comments(Incident)</label>
                                <input class="extension_modal_signature" type="date"
                                    name="incident_effectiveness_on">
                            </div>
                            <div class="group-input">
                                <label for="password">Next Review Date(Incident)</label>
                                <input class="extension_modal_signature" type="date" name="next_review_incident">
                            </div>
                            <div class="group-input">
                                <label for="password">Incident Effectiveness Check closed By </label>
                                <select class="extension_modal_signature" name="incident_feectiveness_closed_by"
                                    id="">
                                    <option value="">-- Select --</option>
                                </select>
                            </div>
                            <div class="group-input">
                                <label for="password">Incident Effectiveness Check CLosed On</label>
                                <input class="extension_modal_signature" type="date"
                                    name="incident_effectiveness_on">
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
        </div> --}}
        {{-- ===============================CAPA effectiveness=========== --}}
        {{-- <div class="modal fade" id="capa_effectiveness">
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
                                    name="incident_effectiveness_by">
                            </div>
                            <div class="group-input">
                                <label for="password">Effectiveness Check Colsure Comments(CAPA)</label>
                                <input class="extension_modal_signature" type="date"
                                    name="incident_effectiveness_on">
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
        </div> --}}
        {{-- ==============================QRM effectiveness=========== --}}
        {{-- <div class="modal fade" id="qrm_effectiveness">
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
                                <input class="extension_modal_signature" type="date" name="incident_due_capa">
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
        </div> --}}
        {{-- ==============================investigation effectiveness=========== --}}
        {{-- <div class="modal fade" id="investigation_effectiveness">
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
        </div> --}}

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
                                <button type="button" onclick="submitForm()" class="saveButton on-submit-disable-button">Save</button>
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
            document.getElementById('Initiator_Group').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var selectedCode = selectedOption.getAttribute('data-code');
            document.getElementById('initiator_group_code').value = selectedCode;
            });

            // Set the group code on page load if a value is already selected
            document.addEventListener('DOMContentLoaded', function() {
            var initiatorGroupElement = document.getElementById('initiator_group');
            if (initiatorGroupElement.value) {
                var selectedOption = initiatorGroupElement.options[initiatorGroupElement.selectedIndex];
                var selectedCode = selectedOption.getAttribute('data-code');
                document.getElementById('initiator_group_code').value = selectedCode;
            }
            });
        </script>



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

        <script>
            $(document).ready(function() {
                $('.formSubmit').on('submit', function(e) {
                    $('.on-submit-disable-button').prop('disabled', true);
                });
            });
        </script>

    @endsection
