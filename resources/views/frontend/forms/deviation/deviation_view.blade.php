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
        .launch_extension {
            background: #4274da;
            color: white;
            border: 0;
            padding: 4px 15px;
            border: 1px solid #4274da;
            transition: all 0.3s linear;
        }
        .main_head_modal li {
            margin-bottom: 10px;
        }

        .extension_modal_signature {
            display: block;
            width: 100%;
            border: 1px solid #837f7f;
            border-radius: 5px;
        }

        .main_head_modal {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
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

        .text-danger {
            margin-top: -22px;
            padding: 4px;
            margin-bottom: 3px;
        }

        /* .saveButton:disabled{
                background: black!important;
                border:  black!important;

            } */

        .main-danger-block {
            display: flex;
        }

        .swal-modal {
            scale: 0.7 !important;
        }

        .swal-icon {
            scale: 0.8 !important;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if (Session::has('swal'))
        <script>
            swal("{{ Session::get('swal')['title'] }}", "{{ Session::get('swal')['message'] }}",
                "{{ Session::get('swal')['type'] }}")
        </script>
    @endif

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
                        '<td> <select name="facility_name[]" id="facility_name"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>  <option value="">-- Select --</option>  <option value="Facility">Facility</option>  <option value="Equipment"> Equipment</option> <option value="Instrument">Instrument</option></select> </td>' +
                        '<td><input type="text" name="IDnumber[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}></td>' +
                        '<td><input type="text" name="Remarks[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}></td>' +
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
                        '<td><input type="text" name="Number[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}></td>' +
                        '<td><input type="text" name="ReferenceDocumentName[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}></td>' +
                        '<td><input type="text" name="Document_Remarks[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}></td>' +
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
        $(document).ready(function() {
            $('#investigation_Details').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);

                    var userOptionsHtml = '';

                    users.forEach(user => {
                        userOptionsHtml = userOptionsHtml.concat(`<option value="${user.id}">${user.name}</option>`)
                    });

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="investication[' + serialNumber +
                        '][serial]" value="' + serialNumber + '"></td>' +
                        '<td> <select name="investication[' + serialNumber +
                        '][investioncation_team]" id="" class="investioncation_team"> <option value="">-- Select --</option>'+ userOptionsHtml +' </select> </td>' +
                        '<td><input type="text" class="numberDetail" name="investication[' + serialNumber +
                        '][responsibility]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="investication[' +
                        serialNumber + '][remarks]"></td>' +
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
                        '<td><input disabled type="text" name="rootCause[' + serialNumber +
                        '][serial]" value="' + serialNumber + '"></td>' +
                        '<td> <select name="rootCause[' + serialNumber +
                            '][Root_Cause_Category]" class="Root_Cause_Category_Select" id=""> <option value="">-- Select --</option> <option value="M-Machine(Equipment)">M-Machine(Equipment)</option><option value="M-Maintenance">M-Maintenance</option><option value="M-Man Power (physical work)">M-Man Power (physical work)</option><option value="M-Management">M-Management</option><option value="M-Material (Raw,Consumables etc.)">M-Material (Raw,Consumables etc.)</option><option value="M-Method (Process/Inspection)">M-Method (Process/Inspection)</option><option value="M-Mother Nature (Environment)">M-Mother Nature (Environment)</option><option value="P-Place/Plant">P-Place/Plant</option><option value="P-Policies">P-Policies</option><option value="P-Price">P-Price </option><option value="P-Procedures">P-Procedures</option><option value="P-Process">P-Process </option><option value="P-Product">P-Product</option><option value="S-Suppliers">S-Suppliers</option><option value="S-Surroundings">S-Surroundings</option><option value="S-Systems">S-Systems</option>  </select></td>' +
                        '<td><select name="rootCause[' + serialNumber +
                        '][Root_Cause_Sub_Category]" id="" class="Root_Cause_Sub_Category_Select"><option value="">-- Select --</option> <option value="infrequent_audits">Infrequent Audits </option><option value="No_Preventive_Maintenance">No Preventive Maintenance </option><option value="Other">Other</option><option value="Poor_Maintenance_or_Design">Poor Maintenance or Design </option><option value="Maintenance_Needs_Improvement">Maintenance Needs Improvement </option><option value="Scheduling_Problem">Scheduling Problem </option><option value="system_deficiency">System Deficiency </option><option value="technical_error">Technical Error </option><option value="tolerable_failure">Tolerable Failure </option><option value="calibration_issues">Calibration Issues </option><option value="Infrequent_Audits">Infrequent Audits</option><option value="No_Preventive_Maintenance">No Preventive Maintenance </option><option value="Other">Other</option><option value="Maintenance_Needs_Improvement">Maintenance Needs Improvement</option><option value="Scheduling_Problem ">Scheduling Problem </option><option value="System_Deficiency">System Deficiency </option><option value="Technical_Error ">Technical Error </option><option value="Tolerable_Failure">Tolerable Failure </option><option value="Failure_to_Follow_SOP">Failure to Follow SOP</option><option value="Human_Machine_Interface">Human-Machine Interface</option><option value="Misunderstood_Verbal_Communication">Misunderstood Verbal Communication </option><option value="Other">Other</option><option value="Personnel Error">Personnel Error</option><option value="Personnel not Qualified">Personnel not Qualified</option><option value="Practice Needed">Practice Needed</option><option value="Teamwork Needs Improvement">Teamwork Needs Improvement</option><option value="Attention">Attention</option><option value="Understanding">Understanding</option><option value="Procedural">Procedural</option><option value="Behavioral">Behavioral</option><option value="Skill">Skill</option><option value="Inattention to task">Inattention to task</option><option value="Lack of Process">Lack of Process</option><option value="Methods">Methods</option><option value="No or Poor Management Involvement">No or Poor Management Involvement</option><option value="Other">Other</option><option value="Personnel not Qualified">Personnel not Qualified</option><option value="Poor employee involvement">Poor employee involvement</option><option value="Poor recognition of hazard">Poor recognition of hazard</option><option value="Previously identified hazards were not eliminated">Previously identified hazards were not eliminated</option><option value="Stress demands">Stress demands</option><option value="Task hazards not guarded properly">Task hazards not guarded properly</option><option value="Personnel not Qualified">Personnel not Qualified</option>  </select></td>' +
                        '<td><input type="text" class="Document_Remarks" name="rootCause[' + serialNumber +
                        '][ifother]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="rootCause[' + serialNumber +
                        '][probability]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="rootCause[' + serialNumber +
                        '][remarks]"></td>' +
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
            $('#risk-assessment-risk-management').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +

                        // '<td><input disabled type="text" name="failure_mode_qrms[' + serialNumber + '][serial]" value="' + serialNumber + '"></td>' +
                        '<td><input type="text" class="numberDetail" name="failure_mode_qrms[' + serialNumber +'][risk_factor]"></td>' +
                        '<td><input type="text" class="numberDetail" name="failure_mode_qrms[' + serialNumber +'][risk_element]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="failure_mode_qrms[' + serialNumber + '][probale_of_risk_element]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="failure_mode_qrms[' + serialNumber + '][existing_risk_control]"></td>' +
                        '<td> <select name="failure_mode_qrms[' + serialNumber + '][initial_severity]" id=""> <option value="">-- Select --</option><option value="1">1</option> <option value="2">2</option> <option value="3">3</option> </select> </td>' +
                        '<td> <select name="failure_mode_qrms[' + serialNumber + '][initial_probability]" id=""> <option value="">-- Select --</option><option value="1">1</option> <option value="2">2</option> <option value="3">3</option></select> </td>' +
                        '<td> <select name="failure_mode_qrms[' + serialNumber + '][initial_detectability]" id=""> <option value="1">-- Select --</option><option value="1">1</option> <option value="2">2</option> <option value="3">3</option> </select> </td>' +
                        '<td><input type="text" class="Document_Remarks" name="failure_mode_qrms[' + serialNumber + '][initial_rpn]"></td>' +
                        '<td> <select name="failure_mode_qrms[' + serialNumber + '][risk_acceptance]" id=""> <option value="n">-- Select --</option><option value="n">N</option> <option> Y </option> </select> </td>' +
                        '<td><input type="text" class="Document_Remarks" name="failure_mode_qrms[' + serialNumber + '][proposed_additional_risk_control]"></td>' +

                        '<td> <select name="failure_mode_qrms[' + serialNumber + '][residual_severity]" id=""> <option value="1">-- Select --</option><option value="1">1</option> <option value="2">2</option> <option value="3">3</option> </select> </td>' +
                        '<td> <select name="failure_mode_qrms[' + serialNumber + '][residual_probability]" id=""> <option value="1">-- Select --</option><option value="1">1</option> <option value="2">2</option> <option value="3">3</option> </select> </td>' +
                        '<td> <select name="failure_mode_qrms[' + serialNumber + '][residual_detectability]" id=""> <option value="1">-- Select --</option><option value="1">1</option> <option value="2">2</option> <option value="3">3</option> </select> </td>' +
                        '<td><input type="text" class="Document_Remarks"              name="failure_mode_qrms[' + serialNumber + '][residual_rpn]"></td>' +
                        '<td> <select name="failure_mode_qrms[' + serialNumber + '][risk_acceptance]" id=""> <option value="">-- Select --</option><option value="n">N</option>   <option value="y">Y</option></select> </td>' +

                        '<td><input type="text" class="Document_Remarks" name="failure_mode_qrms[' + serialNumber + '][mitigation_proposal]"></td>' +


                        '<td><button type="text" class="removeRowBtn" ">Remove</button></td>' +

                        '</tr>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +

                        '</tr>';

                    return html;
                }

                var tableBody = $('#risk-assessment-risk-management_details tbody');
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
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                        '<td><input type="text" class="numberDetail" name="matrix_qrms[' + serialNumber +'][risk_Assesment]"></td>' +
                        '<td><input type="text" class="numberDetail" name="matrix_qrms[' + serialNumber +'][review_schedule]"></td>' +
                        '<td><input type="text" class="numberDetail" name="matrix_qrms[' + serialNumber +'][actual_reviewed]"></td>' +
                        '<td><input type="text" class="numberDetail" name="matrix_qrms[' + serialNumber +'][recorded_by]"></td>' +
                        '<td><input type="text" class="numberDetail" name="matrix_qrms[' + serialNumber +'][remark]"></td>' +
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
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove();
        })
    </script>
    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }}/Deviation
        </div>
    </div>

    <!-- Deviation Form Starts -->

    <div id="change-control-view">
        <div class="container-fluid">

            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>

                    <div class="d-flex" style="gap:20px;">
                        @php
                            $userRoles = DB::table('user_roles')
                                ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])
                                ->get();
                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                            $cftRolesAssignUsers = collect($userRoleIds); //->contains(fn ($roleId) => $roleId >= 22 && $roleId <= 33);
                            $cftUsers = DB::table('deviationcfts')
                                ->where(['deviation_id' => $data->id])
                                ->first();

                            // Define the column names
                            $columns = [
                                'Production_person',
                                'Warehouse_notification',
                                'Quality_Control_Person',
                                'QualityAssurance_person',
                                'Engineering_person',
                                'Analytical_Development_person',
                                'Kilo_Lab_person',
                                'Technology_transfer_person',
                                'Environment_Health_Safety_person',
                                'Human_Resource_person',
                                'Information_Technology_person',
                                'Project_management_person',
                            ];

                            // Initialize an array to store the values
                            $valuesArray = [];

                            // Iterate over the columns and retrieve the values
                            foreach ($columns as $column) {
                                $value = $cftUsers->$column;
                                // Check if the value is not null and not equal to 0
                                if ($value !== null && $value != 0) {
                                    $valuesArray[] = $value;
                                }
                            }
                            $cftCompleteUser = DB::table('deviationcfts_response')
                                ->whereIn('status', ['In-progress', 'Completed'])
                                ->where('deviation_id', $data->id)
                                ->where('cft_user_id', Auth::user()->id)
                                ->whereNull('deleted_at')
                                ->first();
                            // dd($cftCompleteUser);
                        @endphp
                        <!-- <button class="button_theme1" onclick="window.print();return false;" class="new-doc-btn">Print</button> -->
                        <button class="button_theme1"> <a class="text-white"
                                href="{{ url('DeviationAuditTrial', $data->id) }}">Audit Trail </a> </button>

                        @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                HOD Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 3 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA Initial Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cft-not-reqired">
                                CFT Review Not Required
                            </button>
                            <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button> -->
                        @elseif(
                            $data->stage == 4 &&
                                (in_array(5, $userRoleIds) || in_array(18, $userRoleIds) || in_array(Auth::user()->id, $valuesArray)))
                            @if (!$cftCompleteUser)
                                <button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#more-info-required-modal">
                                    More Info Required
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    CFT Review Complete
                                </button>
                            @endif
                        @elseif($data->stage == 5 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#sendToInitiator">
                                Send to Initiator
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hodsend">
                                Send to HOD
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#qasend">
                                Send to QA Initial Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA Final Review Complete
                            </button>
                            <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button> -->
                        @elseif($data->stage == 6 && (in_array(39, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approved
                            </button>
                        @elseif($data->stage == 7 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#sendToInitiator">
                                Send to Opened
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hodsend">
                                Send to HOD Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#qasend">
                                Send to QA Initial Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Initiator Updated Complete
                            </button>
                        @elseif($data->stage == 8 && (in_array(39, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#sendToInitiator">
                                Send to Opened
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hodsend">
                                Send to HOD Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#qasend">
                                Send to QA Initial Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#pending-initiator-update">
                            Send to Pending Initiator Update
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            QA Final Review Complete
                            </button>
                        @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a> </button>


                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars" style="font-size: 15px;">
                            @if ($data->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif

                            @if ($data->stage >= 2)
                                <div class="active">HOD Review </div>
                            @else
                                <div class="">HOD Review</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="active">QA Initial Review</div>
                            @else
                                <div class="">QA Initial Review</div>
                            @endif

                            @if ($data->stage >= 4)
                                <div class="active">CFT Review</div>
                            @else
                                <div class="">CFT Review</div>
                            @endif


                            @if ($data->stage >= 5)
                                <div class="active">QA Final Review</div>
                            @else
                                <div class="">QA Final Review</div>
                            @endif
                            @if ($data->stage >= 6)
                                <div class="active">QA Head/Manager Designee Approval</div>
                            @else
                                <div class="">QA Head/Manager Designee Approval</div>
                            @endif
                            @if ($data->stage >= 7)
                                <div class="active">Pending Initiator Update</div>
                            @else
                                <div class="">Pending Initiator Update</div>
                            @endif
                            @if ($data->stage >= 8)
                                <div class="active">QA Final Approval</div>
                            @else
                                <div class="">QA Final Approval</div>
                            @endif
                            @if ($data->stage >= 9)
                                <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif
                    @endif
                </div>
            </div>
        </div>
        <script>
            console.log('Script working')

            $(document).ready(function() {


                function submitForm() {

                    let auditForm = document.getElementById('auditForm');


                    console.log('sumitting form')

                    document.querySelectorAll('.saveAuditFormBtn').forEach(function(button) {
                        button.disabled = true;
                    })

                    document.querySelectorAll('.auditFormSpinner').forEach(function(spinner) {
                        spinner.style.display = 'flex';
                    })

                    auditForm.submit();
                }

                $('#ChangesaveButton01').click(function() {
                    document.getElementById('formNameField').value = 'general-open';
                    submitForm();
                });

                $('#ChangesaveButton02').click(function() {
                    document.getElementById('formNameField').value = 'hod';
                    submitForm();
                });

                $('#ChangesaveButton03').click(function() {
                    document.getElementById('formNameField').value = 'qa';
                    submitForm();
                });

                $('#ChangesaveButton04').click(function() {
                    document.getElementById('formNameField').value = 'capa';
                    submitForm();
                });

                $('#ChangesaveButton05').click(function() {
                    document.getElementById('formNameField').value = 'qa-final';
                    submitForm();
                });

                $('#ChangesaveButton06').click(function() {
                    document.getElementById('formNameField').value = 'qah';
                    submitForm();
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                var signatureForm = document.getElementById('signatureModalForm');

                signatureForm.addEventListener('submit', function(e) {

                    var submitButton = signatureForm.querySelector('.signatureModalButton');
                    var spinner = signatureForm.querySelector('.signatureModalSpinner');

                    submitButton.disabled = true;

                    spinner.style.display = 'inline-block';
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                var signatureForm = document.getElementById('pendingInitiatorForm');

                signatureForm.addEventListener('submit', function(e) {

                    var submitButton = signatureForm.querySelector('.pendingInitiatorModalButton');
                    var spinner = signatureForm.querySelector('.pendingInitiatorModalSpinner');

                    submitButton.disabled = true;

                    spinner.style.display = 'inline-block';
                });
            });


            // =========================
            wow = new WOW({
                boxClass: 'wow', // default
                animateClass: 'animated', // default
                offset: 0, // default
                mobile: true, // default
                live: true // default
            })
            wow.init();
        </script>

        <div style="background: #e0903230;" id="change-control-fields">
            <div class="container-fluid">

                <!-- Tab links -->
                <div class="cctab">
                    <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm8')">HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm2')">QA Initial Review</button>
                    <button class="cctablinks " onclick="openCity(event, 'CCForm7')">CFT</button>
                    <button class="cctablinks " id="Investigation_button" onclick="openCity(event, 'CCForm9')" style="display: none">Investigation</button>
                    <button class="cctablinks " id="QRM_button" onclick="openCity(event, 'CCForm11')" style="display: none">QRM</button>
                    <button class="cctablinks " id="CAPA_button" onclick="openCity(event, 'CCForm10')" style="display: none">CAPA</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA Final Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QAH/Designee Approval</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm12')">Extension</button>

                    <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>
                </div>

                <form id="auditForm" action="{{ route('deviationupdate', $data->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="form_name" id="formNameField" value="">
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
                                            <label for="record_number"><b>Record Number</b></label>
                                            @if ($data->stage >= 3)
                                                <input disabled type="text"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}/DEV/{{ date('Y') }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}">
                                            @else
                                                <input disabled type="text" name="record">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Division Code"><b>Site/Location Code</b></label>
                                            <input disabled type="text" name="division_code"
                                                value="{{ $divisionName }}">
                                            <input type="hidden" name="division_id"
                                                value="{{ session()->get('division') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Initiator"><b>Initiator</b></label>
                                            <input disabled type="text" value="{{ $data->initiator_name }}">

                                        </div>
                                    </div>
                                    <?php
                                    // Calculate the due date (30 days from the initiation date)
                                    $initiationDate = date('Y-m-d'); // Current date as initiation date
                                    $dueDate = date('Y-m-d', strtotime($initiationDate . '+30 days')); // Due date
                                    ?>

                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Date of Initiation"><b>Date of Initiation</b></label>
                                            <input readonly type="text" value="{{ date('d-M-Y') }}"
                                                name="initiation_date" id="initiation_date"
                                                style="background-color: light-dark(rgba(239, 239, 239, 0.3), rgba(59, 59, 59, 0.3))">
                                            <input type="hidden" value="{{ date('Y-m-d') }}"
                                                name="initiation_date_hidden">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Due Date">Due Date</label>
                                            <div><small class="text-primary">If revising Due Date, kindly mention revision
                                                    reason in "Due Date Extension Justification" data field.</small></div>
                                            <div class="calenderauditee">
                                                <input readonly type="text"
                                                    value="{{ Helpers::getdateFormat($data->due_date) }}"
                                                    name="due_date" />
                                                <input type="date" name="due_date"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                    oninput="handleDateInput(this, 'due_date')" />
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        // Format the due date to DD-MM-YYYY
                                        var dueDateFormatted = new Date("{{ $dueDate }}").toLocaleDateString('en-GB', {
                                            day: '2-digit',
                                            month: '2-digit',
                                            year: 'numeric'
                                        }).split('/').join('-');

                                        // Set the formatted due date value to the input field
                                        document.getElementById('due_date').value = dueDateFormatted;
                                    </script>

                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="Initiator Group"><b>Department</b> <span
                                                    class="text-danger">*</span></label>
                                            <select name="Initiator_Group"
                                                {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                id="initiator_group">
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="CQA" @if ($data->Initiator_Group == 'CQA') selected @endif>
                                                    Corporate
                                                    Quality Assurance</option>
                                                <option value="QAB" @if ($data->Initiator_Group == 'QAB') selected @endif>
                                                    Quality
                                                    Assurance Biopharma</option>
                                                <option value="CQC" @if ($data->Initiator_Group == 'CQC') selected @endif>
                                                    Central
                                                    Quality Control</option>
                                                <option value="MANU" @if ($data->Initiator_Group == 'MANU') selected @endif>
                                                    Manufacturing
                                                </option>
                                                <option value="PSG" @if ($data->Initiator_Group == 'PSG') selected @endif>
                                                    Plasma
                                                    Sourcing Group</option>
                                                <option value="CS" @if ($data->Initiator_Group == 'CS') selected @endif>
                                                    Central
                                                    Stores</option>
                                                <option value="ITG" @if ($data->Initiator_Group == 'ITG') selected @endif>
                                                    Information
                                                    Technology Group</option>
                                                <option value="MM" @if ($data->Initiator_Group == 'MM') selected @endif>
                                                    Molecular
                                                    Medicine</option>
                                                <option value="CL" @if ($data->Initiator_Group == 'CL') selected @endif>
                                                    Central
                                                    Laboratory</option>
                                                <option value="TT" @if ($data->Initiator_Group == 'TT') selected @endif>
                                                    Tech
                                                    team</option>
                                                <option value="QA" @if ($data->Initiator_Group == 'QA') selected @endif>
                                                    Quality
                                                    Assurance</option>
                                                <option value="QM" @if ($data->Initiator_Group == 'QM') selected @endif>
                                                    Quality
                                                    Management</option>
                                                <option value="IA" @if ($data->Initiator_Group == 'IA') selected @endif>
                                                    IT
                                                    Administration</option>
                                                <option value="ACC" @if ($data->Initiator_Group == 'ACC') selected @endif>
                                                    Accounting
                                                </option>
                                                <option value="LOG" @if ($data->Initiator_Group == 'LOG') selected @endif>
                                                    Logistics
                                                </option>
                                                <option value="SM" @if ($data->Initiator_Group == 'SM') selected @endif>
                                                    Senior
                                                    Management</option>
                                                <option value="BA" @if ($data->Initiator_Group == 'BA') selected @endif>
                                                    Business
                                                    Administration</option>

                                            </select>
                                        </div>
                                        @error('Initiator_Group')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Short Description">Short Description<span class="text-danger">
                                                    *</span></label><span id="rchars">255</span>characters remaining
                                            <textarea name="short_description"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="docname"
                                                type="text" maxlength="255" required {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->short_description }}</textarea>
                                        </div>
                                        @error('short_description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Short Description required">Repeat Deviation? <span
                                                    class="text-danger">*</span></label>
                                            <select name="short_description_required"
                                                {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                id="short_description_required" onchange="checkRecurring(this)"
                                                value="{{ $data->short_description_required }}">
                                                <option value="0">-- Select --</option>
                                                <option value="Recurring"
                                                    @if ($data->short_description_required == 'Recurring' || old('short_description_required') == 'Recurring') selected @endif>Yes</option>
                                                <option value="Non_Recurring"
                                                    @if ($data->short_description_required == 'Non_Recurring' || old('short_description_required') == 'Non_Recurring') selected @endif>No</option>
                                            </select>
                                        </div>
                                        @error('short_description_required')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6" id="nature_of_repeat_block"
                                        @if ($data->short_description_required != 'Recurring') style="display: none" @endif>
                                        <div class="group-input" id="nature_of_repeat">
                                            <label for="nature_of_repeat">Repeat Nature <span id="asteriskInviRecurring"
                                                    style="display: {{ $data->short_description_required == 'Recurring' ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <textarea class="nature_of_repeat"
                                                name="nature_of_repeat"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="nature_of_repeat"
                                                class="nature_of_repeat">{{ $data->nature_of_repeat }}</textarea>
                                        </div>
                                        @error('nature_of_repeat')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                                                // var natureOfRepeatBlock = document.getElementsById('nature_of_repeat_block');

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
                                    <script>
                                        function checkRecurring(selectElement) {
                                            var repeatNatureField = document.getElementById('nature_of_repeat');
                                            if (selectElement.value === 'Recurring') {
                                                repeatNatureField.setAttribute('required', 'required');
                                            } else {
                                                repeatNatureField.removeAttribute('required');
                                            }
                                        }
                                    </script>
                                    <div class="col-6">
                                        <div class="group-input">
                                            <label for="severity-level">Deviation Observed On <span
                                                    class="text-danger">*</span></label>
                                            <!-- <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span> -->
                                            <input type="date" id="Deviation_date"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                name="Deviation_date"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ old('Deviation_date') ? old('Deviation_date') : $data->Deviation_date }}">
                                            @error('Deviation_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 new-time-data-field">
                                        <div class="group-input input-time">
                                            <label for="deviation_time">Deviation Observed On (Time) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                name="deviation_time"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                id="deviation_time"
                                                value="{{ old('deviation_time') ? old('deviation_time') : $data->deviation_time }}">
                                            @error('deviation_time')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6 new-time-data-field">
                                        <div
                                            class="group-input input-time @error('Delay_Justification') @else delayJustificationBlock @enderror">
                                            <label for="deviation_time">Delay Justification <span class="text-danger">*</span></label>
                                            <textarea id="Delay_Justification" name="Delay_Justification">{{ $data->Delay_Justification }}</textarea>
                                        </div>
                                        @error('Delay_Justification')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                                            @php
                                                $users = DB::table('users')->get();
                                            @endphp

                                            <label for="If Other">Deviation Observed By<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="Facility" placeholder="Select Facility Name"
                                                value="{{ $data->Facility }}">
                                            @error('Facility')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Initiator Group">Deviation Reported On <span
                                                    class="text-danger">*</span></label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input type="date" id="Deviation_reported_date"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                name="Deviation_reported_date"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data->Deviation_reported_date }}">
                                        </div>
                                        @error('Deviation_reported_date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <script>
                                        $(document).ready(function() {
                                            // Hide the delayJustificationBlock initially
                                            $('.delayJustificationBlock').hide();

                                            // Check the condition on page load
                                            checkDateDifference();
                                        });

                                        function checkDateDifference() {
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

                                        // Call checkDateDifference whenever the values are changed
                                        $('input[name=Deviation_date], input[name=Deviation_reported_date]').on('change', function() {
                                            checkDateDifference();
                                        });
                                        </script>

                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="audit type">Deviation Related To <span
                                                    class="text-danger">*</span></label>
                                            <select multiple
                                                name="audit_type[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                id="audit_type">
                                                <option
                                                    value="Facility"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    {{ strpos($data->audit_type, 'Facility') !== false ? 'selected' : '' }}>
                                                    Facility</option>
                                                <option value="Equipment/Instrument"
                                                    {{ strpos($data->audit_type, 'Equipment/Instrument') !== false ? 'selected' : '' }}>
                                                    Equipment/Instrument</option>
                                                <option value="Documentationerror"
                                                    {{ strpos($data->audit_type, 'Documentationerror') !== false ? 'selected' : '' }}>
                                                    Documentation error</option>
                                                <option value="STP/ADS_instruction"
                                                    {{ strpos($data->audit_type, 'STP/ADS_instruction') !== false ? 'selected' : '' }}>
                                                    STP/ADS instruction</option>
                                                <option value="Packaging&Labelling"
                                                    {{ strpos($data->audit_type, 'Packaging&Labelling') !== false ? 'selected' : '' }}>
                                                    Packaging & Labelling</option>
                                                <option value="Material_System"
                                                    {{ strpos($data->audit_type, 'Material_System') !== false ? 'selected' : '' }}>
                                                    Material System</option>
                                                <option value="Laboratory_Instrument/System"
                                                    {{ strpos($data->audit_type, 'Laboratory_Instrument/System') !== false ? 'selected' : '' }}>
                                                    Laboratory Instrument/System</option>
                                                <option value="Utility_System"
                                                    {{ strpos($data->audit_type, 'Utility_System') !== false ? 'selected' : '' }}>
                                                    Utility System</option>
                                                <option value="Computer_System"
                                                    {{ strpos($data->audit_type, 'Computer_System') !== false ? 'selected' : '' }}>
                                                    Computer System</option>
                                                <option value="Document"
                                                    {{ strpos($data->audit_type, 'Document') !== false ? 'selected' : '' }}>
                                                    Document</option>
                                                <option value="Data integrity"
                                                    {{ strpos($data->audit_type, 'Data integrity') !== false ? 'selected' : '' }}>
                                                    Data integrity</option>
                                                <option value="SOP Instruction"
                                                    {{ strpos($data->audit_type, 'SOP Instruction') !== false ? 'selected' : '' }}>
                                                    SOP Instruction</option>
                                                <option value="BMR/ECR Instruction"
                                                    {{ strpos($data->audit_type, 'BMR/ECR Instruction') !== false ? 'selected' : '' }}>
                                                    BMR/ECR Instruction</option>
                                                <option value="Water System"
                                                    {{ strpos($data->audit_type, 'Water System') !== false ? 'selected' : '' }}>
                                                    Water System</option>
                                                <option value="Anyother(specify)"
                                                    {{ strpos($data->audit_type, 'Anyother(specify)') !== false ? 'selected' : '' }}>
                                                    Anyother(specify)</option>
                                            </select>
                                        </div>
                                        @error('audit_type')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-lg-6" id="others_block"
                                        @if (strpos($data->audit_type, 'Anyother(specify)')) style="display: none" @endif>
                                        <div class="group-input">
                                            <label for="others">Others <span id="asteriskInOther"
                                                    style="display: {{ $data->audit_type == 'Anyother(specify)' ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="otherrr" name="others"
                                                {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                id="others" value="{{ $data->others }}">
                                            @error('others')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var selectField = document.getElementById('audit_type');
                                            var inputsToToggle = [];

                                            // Add elements with class 'facility-name' to inputsToToggle
                                            var facilityNameInputs = document.getElementsByClassName('otherrr');
                                            for (var i = 0; i < facilityNameInputs.length; i++) {
                                                inputsToToggle.push(facilityNameInputs[i]);
                                            }


                                            selectField.addEventListener('change', function() {
                                                // var isRequired = this.value === 'Anyother(specify)';
                                                var isRequired = this.value.includes('Anyother(specify)');
                                                console.log('isRequired', isRequired)

                                                inputsToToggle.forEach(function(input) {
                                                    input.required = isRequired;
                                                    console.log(input.required, isRequired, 'input req');
                                                });

                                                document.getElementById('others_block').style.display = isRequired ? 'block' : 'none';

                                                // Show or hide the asterisk icon based on the selected value
                                                var asteriskIcon = document.getElementById('asteriskInOther');
                                                asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            });
                                        });
                                    </script>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="Facility/Equipment"> Facility/ Equipment/ Instrument/ System
                                                Details Required? <span class="text-danger">*</span></label>
                                            <select name="Facility_Equipment"
                                                {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                id="Facility_Equipment" value="{{ $data->Facility_Equipment }}">
                                                <option value="">-- Select --</option>
                                                <option @if ($data->Facility_Equipment == 'yes' || old('Facility_Equipment') == 'yes') selected @endif value="yes">
                                                    Yes</option>
                                                <option @if ($data->Facility_Equipment == 'no' || old('Facility_Equipment') == 'no') selected @endif value="no">
                                                    No</option>>
                                            </select>
                                            @error('Facility_Equipment')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="group-input" id="facilityRow"
                                        @if ($data->Facility_Equipment == 'no') style="display: none" @endif>
                                        <label for="audit-agenda-grid">
                                            Facility/ Equipment/ Instrument/ System Details <span id="asteriskInvifaci"
                                                style="display: {{ $data->Facility_Equipment == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                            <button type="button"
                                                name="audit-agenda-grid"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="audit-agenda-grid" id="ObservationAdd">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#observation-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="onservation-field-table"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%">Row#</th>
                                                        <th style="width: 12%">Name</th>
                                                        <th style="width: 16%">ID Number</th>
                                                        <th style="width: 15%">Remarks</th>
                                                        <th style="width: 8%">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!empty($grid_data->Remarks))
                                                        @foreach (unserialize($grid_data->Remarks) as $key => $temps)
                                                            <tr>
                                                                <td><input disabled type="text"
                                                                        name="serial[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                        value="{{ $key + 1 }}"></td>
                                                                <td>
                                                                    <select class="facility-name"
                                                                        name="facility_name[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                        id="facility_name">
                                                                        @if (isset($grid_data->facility_name))
                                                                            @php
                                                                                $facility_name = unserialize(
                                                                                    $grid_data->facility_name,
                                                                                );
                                                                            @endphp
                                                                            <option value="">-- Select --</option>
                                                                            <option value="Facility"
                                                                                {{ isset($facility_name[$key]) && $facility_name[$key] == 'Facility' ? 'selected' : 'Facility' }}>
                                                                                Facility</option>
                                                                            <option value="Equipment"
                                                                                {{ isset($facility_name[$key]) && $facility_name[$key] == 'Facility' ? 'selected' : 'Equipment' }}>
                                                                                Equipment</option>
                                                                            <option value="Instrument"
                                                                                {{ isset($facility_name[$key]) && $facility_name[$key] == 'Instrument' ? 'selected' : 'Instrument' }}>
                                                                                Instrument</option>
                                                                        @endif

                                                                    </select>
                                                                </td>
                                                                <td><input class="id-number" type="text"
                                                                        name="IDnumber[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                        value="{{ isset(unserialize($grid_data->IDnumber)[$key]) ? unserialize($grid_data->IDnumber)[$key] : '' }}">
                                                                </td>
                                                                <td><input class="remarks" type="text"
                                                                        name="Remarks[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                        value="{{ unserialize($grid_data->Remarks)[$key] ? unserialize($grid_data->Remarks)[$key] : '' }}">
                                                                </td>
                                                                <td><input type="text" class="Removebtn"
                                                                        name="Action[]" readonly></td>

                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="main-danger-block">


                                            @error('facility_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            @error('IDnumber')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

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

                                                // Show or hide the asterisk icon based on the selected value
                                                var asteriskIcon = document.getElementById('asteriskInvifaci');
                                                document.getElementById('facilityRow').style.display = isRequired ? 'block' : 'none';
                                                asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            });
                                        });
                                    </script>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="Document Details Required">Document Details Required? <span
                                                    class="text-danger">*</span></label>
                                            <select
                                                name="Document_Details_Required"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                id="Document_Details_Required"
                                                value="{{ $data->Document_Details_Required }}">
                                                <option value="">-- Select --</option>
                                                <option @if ($data->Document_Details_Required == 'yes' || old('Document_Details_Required') == 'yes') selected @endif value="yes">
                                                    Yes</option>
                                                <option @if ($data->Document_Details_Required == 'no' || old('Document_Details_Required') == 'no') selected @endif value="no">
                                                    No</option>>
                                            </select>
                                        </div>
                                        @error('Document_Details_Required')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="group-input" id="documentsRow"
                                        @if ($data->Document_Details_Required == 'no') style="display: none" @endif>
                                        <label for="audit-agenda-grid">
                                            Document Details <span id="asteriskInvidoc"
                                                style="display: {{ $data->Document_Details_Required == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                            <button type="button"
                                                name="audit-agenda-grid"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="audit-agenda-grid" id="ReferenceDocument">+</button>
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
                                                    @if ($grid_data1->ReferenceDocumentName)
                                                        @foreach (unserialize($grid_data1->ReferenceDocumentName) as $key => $temps)
                                                            <tr>
                                                                <td><input disabled type="text"
                                                                        name="serial[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                        value="{{ $key + 1 }}"></td>
                                                                <td><input class="numberDetail" type="text"
                                                                        name="Number[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                        value="{{ unserialize($grid_data1->Number)[$key] ? unserialize($grid_data1->Number)[$key] : '' }}">
                                                                </td>
                                                                <td><input class="ReferenceDocumentName" type="text"
                                                                        name="ReferenceDocumentName[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                        value="{{ unserialize($grid_data1->ReferenceDocumentName)[$key] ? unserialize($grid_data1->ReferenceDocumentName)[$key] : '' }}">
                                                                </td>
                                                                <td><input class="Document_Remarks" type="text"
                                                                        name="Document_Remarks[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                        value="{{ unserialize($grid_data1->Document_Remarks)[$key] ? unserialize($grid_data1->Document_Remarks)[$key] : '' }}">
                                                                </td>
                                                                <td><input type="text" class="Removebtn"
                                                                        name="Action[]" readonly></td>

                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>

                                            </table>
                                        </div>
                                        @error('Number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @error('ReferenceDocumentName')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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

                                                // Show or hide the asterisk icon based on the selected value
                                                document.getElementById('documentsRow').style.display = isRequired ? 'block' : 'none';
                                                var asteriskIcon = document.getElementById('asteriskInvidoc');
                                                asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            });
                                        });
                                    </script>

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="Document Details Required">Product/Batch Required? <span
                                                        class="text-danger">*</span></label>
                                                <select
                                                    name="Product_Details_Required"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    id="Product_Details_Required"
                                                    value="{{ $data->Product_Details_Required }}">
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data->Product_Details_Required == 'yes' || old('Product_Details_Required') == 'yes') selected @endif value="yes">
                                                        Yes</option>
                                                    <option @if ($data->Product_Details_Required == 'no' || old('Product_Details_Required') == 'no') selected @endif value="no">
                                                        No</option>>
                                                </select>
                                            </div>
                                            @error('Product_Details_Required')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                    <div class="col-lg-12">
                                        <div class="col-lg-12">
                                            <div class="group-input" id="productRow"  @if ($data->Product_Details_Required == 'no') style="display: none" @endif>
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
                                                            @if ($grid_data2->product_name)
                                                                @foreach (unserialize($grid_data2->product_name) as $key => $temps)
                                                                    <td><input disabled type="text"
                                                                            name="serial[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                            value="{{ $key + 1 }}"></td>
                                                                    <td><input class="productName" type="text"
                                                                            name="product_name[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                            value="{{ isset(unserialize($grid_data2->product_name)[$key]) ? unserialize($grid_data2->product_name)[$key] : '' }}">
                                                                    </td>
                                                                    <td>
                                                                        <select class="productStage"
                                                                            name="product_stage[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                            id="product_stage">
                                                                            @if (isset($grid_data2->product_stage))
                                                                                @php
                                                                                    $product_stage = unserialize(
                                                                                        $grid_data2->product_stage,
                                                                                    );
                                                                                @endphp
                                                                                <option value="">-- Select --
                                                                                </option>
                                                                                <option value="1"
                                                                                    {{ isset($product_stage[$key]) && $product_stage[$key] == '1' ? 'selected' : '1' }}>
                                                                                    1</option>
                                                                                <option value="2"
                                                                                    {{ isset($product_stage[$key]) && $product_stage[$key] == '2' ? 'selected' : '2' }}>
                                                                                    2</option>
                                                                                <option value="3"
                                                                                    {{ isset($product_stage[$key]) && $product_stage[$key] == '3' ? 'selected' : '3' }}>
                                                                                    3</option>
                                                                                <option value="4"
                                                                                    {{ isset($product_stage[$key]) && $product_stage[$key] == '4' ? 'selected' : '4' }}>
                                                                                    4</option>
                                                                                <option value="5"
                                                                                    {{ isset($product_stage[$key]) && $product_stage[$key] == '5' ? 'selected' : '5' }}>
                                                                                    5</option>
                                                                                <option value="6"
                                                                                    {{ isset($product_stage[$key]) && $product_stage[$key] == '6' ? 'selected' : '6' }}>
                                                                                    6</option>
                                                                                <option value="7"
                                                                                    {{ isset($product_stage[$key]) && $product_stage[$key] == '7' ? 'selected' : '7' }}>
                                                                                    7</option>
                                                                                <option value="8"
                                                                                    {{ isset($product_stage[$key]) && $product_stage[$key] == '8' ? 'selected' : '8' }}>
                                                                                    8</option>
                                                                                <option value="9"
                                                                                    {{ isset($product_stage[$key]) && $product_stage[$key] == '9' ? 'selected' : '9' }}>
                                                                                    9</option>
                                                                                <option value="Final"
                                                                                    {{ isset($product_stage[$key]) && $product_stage[$key] == 'Final' ? 'selected' : 'Final' }}>
                                                                                    Final</option>
                                                                            @endif
                                                                        </select>
                                                                    </td>
                                                                    <td><input class="productBatchNo" type="text"
                                                                            name="batch_no[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                            value="{{ isset(unserialize($grid_data2->batch_no)[$key]) ? unserialize($grid_data2->batch_no)[$key] : '' }}">
                                                                    </td>
                                                                    <td><input type="text" class="Removebtn"
                                                                            name="Action[]" readonly></td>
                                                                @endforeach
                                                            @endif
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
                                                // note-codable
                                                var selectField = document.getElementById('Product_Details_Required');
                                                var inputsToToggle = [];

                                                // Add elements with class 'productName' to inputsToToggle
                                                var productNameInput = document.getElementsByClassName('productName');
                                                for (var i = 0; i < productNameInput.length; i++) {
                                                    inputsToToggle.push(productNameInput[i]);
                                                }

                                                // Add elements with class 'productStage' to inputsToToggle
                                                var productStageInput = document.getElementsByClassName('productStage');
                                                for (var j = 0; j < productStageInput.length; j++) {
                                                    inputsToToggle.push(productStageInput[j]);
                                                }

                                                // Add elements with class 'productBatchNo' to inputsToToggle
                                                var batchNoInput = document.getElementsByClassName('productBatchNo');
                                                for (var k = 0; k < batchNoInput.length; k++) {
                                                    inputsToToggle.push(batchNoInput[k]);
                                                }

                                                selectField.addEventListener('change', function() {
                                                var isRequired = this.value === 'yes';
                                                console.log(this.value, isRequired, 'value');

                                                inputsToToggle.forEach(function(input) {
                                                    input.required = isRequired;
                                                    console.log(input.required, isRequired, 'input req');
                                                });

                                                // Show or hide the asterisk icon based on the selected value
                                                document.getElementById('productRow').style.display = isRequired ? 'block' : 'none';
                                                var asteriskIcon = document.getElementById('asteriskInvidoc');
                                                asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            });
                                            });
                                        </script>
                                    </div>

                                   
                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Description Deviation">Description of Deviation <span
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea class="tiny"
                                                name="Description_Deviation"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-1">{{ $data->Description_Deviation }}</textarea>
                                        </div>
                                        @error('Description_Deviation')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Immediate Action">Immediate Action (if any) <span
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Immediate_Action[]" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                id="summernote-2">{{ $data->Immediate_Action }}</textarea>
                                        </div>
                                        @error('Immediate_Action')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Preliminary Impact">Preliminary Impact of Deviation <span
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea class="tiny" name="Preliminary_Impact[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                id="summernote-3">{{ $data->Preliminary_Impact }}</textarea>
                                        </div>
                                        @error('Preliminary_Impact')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Inv Attachments">Initial Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="initial_file">
                                                    @if ($data->initial_file)
                                                        @foreach (json_decode($data->initial_file) as $file)
                                                            <h6 class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}"
                                                                    target="_blank"><i class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a class="remove-file"
                                                                    data-file-name="{{ $file }}"><i
                                                                        class="fa-solid fa-circle-xmark"
                                                                        style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="HOD_Attachments"
                                                        name="initial_file[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'initial_file')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-block">
                                    <button  type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }}
                                        id="ChangesaveButton01" class="saveButton saveAuditFormBtn d-flex"
                                        style="align-items: center;">
                                        <div class="spinner-border spinner-border-sm auditFormSpinner"
                                            style="display: none" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        Save
                                    </button>
                                    <button  type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                        id="ChangeNextButton" class="nextButton">Next</button>
                                    <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white">
                                            Exit </a> </button>

                                </div>
                            </div>
                        </div>
                        <!-- ----------hod Review-------- -->
                        <div id="CCForm8" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if ($data->stage == 2)
                                            <div class="group-input">
                                                <label for="HOD Remarks">HOD Remarks <span
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="HOD_Remarks" id="summernote-4" required>{{ $data->HOD_Remarks }}</textarea>
                                            </div>
                                        @else
                                            <div class="group-input">
                                                <label for="HOD Remarks">HOD Remarks</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea readonly class="tiny" name="HOD_Remarks" id="summernote-4">{{ $data->HOD_Remarks }}</textarea>
                                            </div>
                                        @endif
                                        @error('HOD_Remarks')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        @if ($data->stage == 2)
                                            <div class="group-input">
                                                <label for="Inv Attachments">HOD Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list" id="Audit_file">
                                                        @if ($data->Audit_file)
                                                            @foreach (json_decode($data->Audit_file) as $file)
                                                                <h6 class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                                    <a class="remove-file"
                                                                        data-file-name="{{ $file }}"><i
                                                                            class="fa-solid fa-circle-xmark"
                                                                            style="color:red; font-size:20px;"></i></a>
                                                                </h6>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="HOD_Attachments"
                                                            name="Audit_file[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'Audit_file')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="group-input">
                                                <label for="Inv Attachments">HOD Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list" id="Audit_file">
                                                        @if ($data->Audit_file)
                                                            @foreach (json_decode($data->Audit_file) as $file)
                                                                <h6 class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                                    <a class="remove-file"
                                                                        data-file-name="{{ $file }}"><i
                                                                            class="fa-solid fa-circle-xmark"
                                                                            style="color:red; font-size:20px;"></i></a>
                                                                </h6>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input disabled
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="HOD_Attachments"
                                                            name="Audit_file[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'Audit_file')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>
                                        $(document).ready(function() {
                                            // Event listener for the remove file button
                                            $(document).on('click', '.remove-file', function() {
                                                $(this).closest('.file-container').remove();
                                            });
                                        });
                                    </script>


                                </div>
                                <div class="button-block">

                                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }}
                                        class="saveButton saveAuditFormBtn d-flex" style="align-items: center;"
                                        id="ChangesaveButton02">
                                        <div class="spinner-border spinner-border-sm auditFormSpinner"
                                            style="display: none" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        Save
                                    </button>
                                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                        class="nextButton" onclick="nextStep()">Next</button>
                                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white"> Exit </a>
                                        </button>
                                        @if ($data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 )
                                            <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                                class="button  launch_extension" data-bs-toggle="modal"
                                                data-bs-target="#launch_extension">
                                                Launch Extension
                                            </a>
                                        @endif
                                        <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#effectivenss_extension">
                                            Launch Effectiveness Check
                                        </a> -->
                                </div>
                            </div>
                        </div>

                        <script>
                            // handleInvestigationRequiredChange();


                            // function handleInvestigationRequiredChange() {
                            //     var investigationSelect = document.getElementById("Investigation_required");
                            //     var investigationButton = document.getElementById("Investigation_button");

                            //     // Get the selected value of the Investigation Required dropdown
                            //     var investigationRequired = investigationSelect.value;

                            //     // Check if Investigation Required is "Yes"
                            //     if (investigationRequired === "yes") {
                            //         // Show the Investigation button
                            //         investigationButton.style.display = "display";
                            //     } else {
                            //         // Hide the Investigation button
                            //         investigationButton.style.display = "none";
                            //     }
                            // }

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

                        <!-- QA Initial reVIEW -->
                        <div id="CCForm2" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                @if ($data->stage == 3)
                                    <div class="row">

                                        <div style="margin-bottom: 0px;" class="col-lg-12 new-date-data-field ">
                                            <div class="group-input input-date">

                                                @if ($data->stage == 3)
                                                    <label for="Deviation category">Initial Deviation category <span
                                                            class="text-danger">*</span></label>
                                                    <select id="Deviation_category"
                                                        name="Deviation_category"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        value="{{ $data->Deviation_category }}"
                                                        onchange="handleDeviationCategoryChange()" required>
                                                        <option value="0">-- Select --</option>
                                                        <option @if ($data->Deviation_category == 'minor') selected @endif
                                                            value="minor">Minor</option>
                                                        <option @if ($data->Deviation_category == 'major') selected @endif
                                                            value="major">Major</option>
                                                        <option @if ($data->Deviation_category == 'critical') selected @endif
                                                            value="critical">Critical</option>
                                                    </select>
                                                @else
                                                    <label for="Deviation category">Initial Deviation category</label>
                                                    <select id="Deviation_category"
                                                        name="Deviation_category"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        onchange="handleDeviationCategoryChange()"
                                                        value="{{ $data->Deviation_category }}">
                                                        <option value="0">-- Select --</option>
                                                        <option @if ($data->Deviation_category == 'minor') selected @endif
                                                            value="minor">Minor</option>
                                                        <option @if ($data->Deviation_category == 'major') selected @endif
                                                            value="major">Major</option>
                                                        <option @if ($data->Deviation_category == 'critical') selected @endif
                                                            value="critical">Critical</option>
                                                    </select>
                                                @endif

                                                @error('Deviation_category')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                @endif
                                <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="capa_required"> CAPA Required ?</label>
                                        <select name="capa_required" id="capa_required">
                                            <option value="select">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div> -->

                                <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Capa Required">CAPA Required? <span
                                                    class="text-danger">*</span></label>
                                            <select
                                                name="capa_required"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                id="capa_required" value="{{ $data->capa_required }}">
                                                <option value="select">-- Select --</option>
                                                <option @if ($data->capa_required == 'yes') selected @endif value='yes'>
                                                    Yes</option>
                                                <option @if ($data->capa_required == 'no') selected @endif value='no'>
                                                    No</option>
                                            </select>
                                            <!-- @error('capa_required')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror -->
                                        </div>
                                    </div>

                                <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="qrm_required">QRM Required ?</label>
                                        <select name="qrm_required" id="qrm_required">
                                            <option value="select">-- Select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div> -->

                                <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="QRM Required">QRM Required? <span
                                                    class="text-danger">*</span></label>
                                            <select
                                                name="qrm_required"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                id="qrm_required" value="{{ $data->qrm_required }}">
                                                <option value="select">-- Select --</option>
                                                <option @if ($data->qrm_required == 'yes') selected @endif value='yes'>
                                                    Yes</option>
                                                <option @if ($data->qrm_required == 'no') selected @endif value='no'>
                                                    No</option>
                                            </select>
                                            <!-- @error('qrm_required')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror -->
                                        </div>
                                    </div>

                                <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Investigation required">Investigation Required? <span
                                                    class="text-danger">*</span></label>
                                            <select
                                                name="Investigation_required"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                id="Investigation_required" value="{{ $data->Investigation_required }}">
                                                <option value="select">-- Select --</option>
                                                <option @if ($data->Investigation_required == 'yes') selected @endif value='yes'>
                                                    Yes</option>
                                                <option @if ($data->Investigation_required == 'no') selected @endif value='no'>
                                                    No</option>
                                            </select>
                                            @error('Investigation_required')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                @if ($data->stage == 3)

                                    @if ($data->stage == 3)
                                        <div class="col-md-12">
                                            <div class="group-input">
                                                <label for="Justification for  categorization">Justification for
                                                    categorization <span class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny Justification_for_categorization"
                                                    name="Justification_for_categorization"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    id="summernote-5" required>{{ $data->Justification_for_categorization }}</textarea>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12">
                                            <div class="group-input">
                                                <label for="Justification for  categorization">Justification for
                                                    categorization</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny Justification_for_categorization"
                                                    name="Justification_for_categorization"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    id="summernote-5">{{ $data->Justification_for_categorization }}</textarea>
                                            </div>
                                        </div>
                                    @endif
                                    @error('Justification_for_categorization')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="col-md-12">
                                        <div class="group-input" id="investigation_details_block" style="display: none">
                                            <label for="Investigation Details">Investigation Details <span
                                                    id="asteriskInviinvestication"
                                                    style="display: {{ $data1->Investigation_required == 'yes' ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea class="summernote Investigation_Details"
                                                name="Investigation_Details"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                class="Investigation_Details" id="summernote-6">{{ $data->Investigation_Details }}</textarea>

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Investigation_required');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Investigation_Details');
                                                    for (var i = 0; i < facilityNameInputs.length; i++) {
                                                        inputsToToggle.push(facilityNameInputs[i]);
                                                    }


                                                    selectField.addEventListener('change', function() {
                                                        var isRequired = this.value === 'yes';

                                                        inputsToToggle.forEach(function(input) {
                                                            input.required = isRequired;
                                                            console.log(input.required, isRequired, 'input req');
                                                        });

                                                        document.getElementById('investigation_details_block').style.display = isRequired ?
                                                            'inline' : 'none';
                                                        // Show or hide the asterisk icon based on the selected value
                                                        var asteriskIcon = document.getElementById('asteriskInviinvestication');
                                                        asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                    });
                                                });
                                            </script>
                                            @error('Investigation_Details')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="QAInitialRemark">QA Initial Remarks <span
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea @if ($data->stage == 3) required @endif class="summernote QAInitialRemark"
                                                name="QAInitialRemark"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-6">{{ $data->QAInitialRemark }}</textarea>
                                        </div>
                                        @error('QAInitialRemark')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="QA Initial Attachments">QA Initial Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="Initial_attachment">
                                                    @if ($data->Initial_attachment)
                                                        @foreach (json_decode($data->Initial_attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}"
                                                                    target="_blank"><i class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file"
                                                                    data-file-name="{{ $file }}"><i
                                                                        class="fa-solid fa-circle-xmark"
                                                                        style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile"
                                                        name="Initial_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        @else
                            <div class="row">
                                <div style="margin-bottom: 0px;" class="col-lg-12 new-date-data-field ">
                                    <div class="group-input input-date">
                                        @if ($data->stage == 3)
                                            <label for="Deviation category">Initial Deviation category <span
                                                    class="text-danger">*</span></label>
                                            <select disabled id="Deviation_category"
                                                name="Deviation_category"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data->Deviation_category }}">
                                                <option value="0">-- Select --</option>
                                                <option @if ($data->Deviation_category == 'minor') selected @endif value="minor">
                                                    Minor</option>
                                                <option @if ($data->Deviation_category == 'major') selected @endif value="major">
                                                    Major</option>
                                                <option @if ($data->Deviation_category == 'critical') selected @endif
                                                    value="critical">Critical</option>
                                            </select>
                                        @else
                                            <div class="group-input">
                                                <label for="Deviation category">Initial Deviation category</label>
                                                <select disabled id="Deviation_category"
                                                    name="Deviation_category"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    value="{{ $data->Deviation_category }}">
                                                    <option value="0">-- Select --</option>
                                                    <option @if ($data->Deviation_category == 'minor') selected @endif
                                                        value="minor">Minor</option>
                                                    <option @if ($data->Deviation_category == 'major') selected @endif
                                                        value="major">Major</option>
                                                    <option @if ($data->Deviation_category == 'critical') selected @endif
                                                        value="critical">Critical</option>
                                                </select>
                                            </div>
                                        @endif
                                        @error('Deviation_category')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Justification for  categorization">Justification for
                                            categorization</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea disabled class="tiny"
                                            name="Justification_for_categorization"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-5">{{ $data->Justification_for_categorization }}</textarea>
                                    </div>
                                    @error('Justification_for_categorization')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Investigation required">Investigation Required?</label>
                                        <select disabled name="Investigation_required" id="Investigation_required"
                                            value="{{ $data->Investigation_required }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data->Investigation_required == 'yes') selected @endif value='yes'>Yes
                                            </option>
                                            <option @if ($data->Investigation_required == 'no') selected @endif value='no'>No
                                            </option>
                                        </select>
                                        @error('Investigation_required')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Investigation Details">Investigation Details <span
                                                id="asteriskInviinvestication" style="display: none"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea disabled class="summernote Investigation_Details"
                                            name="Investigation_Details"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            class="Investigation_Details" id="summernote-6">{{ $data->Investigation_Details }}</textarea>
                                        @error('Investigation_Details')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var selectField = document.getElementById('Investigation_required');
                                                var inputsToToggle = [];

                                                // Add elements with class 'facility-name' to inputsToToggle
                                                // var facilityNameInputs = document.getElementsByClassName('Investigation_Details');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }


                                                selectField.addEventListener('change', function() {
                                                    var isRequired = this.value === 'yes';

                                                    // inputsToToggle.forEach(function (input) {
                                                    //     input.required = isRequired;
                                                    //     console.log(input.required, isRequired, 'input req');
                                                    // });

                                                    // Show or hide the asterisk icon based on the selected value
                                                    var asteriskIcon = document.getElementById('asteriskInviinvestication');
                                                    asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="QAInitialRemark">QA Initial Remarks</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea readonly class="tiny"
                                            name="QAInitialRemark"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-6">{{ $data->QAInitialRemark }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Initial Attachments">QA Initial Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Initial_attachment">
                                                @if ($data->Initial_attachment)
                                                    @foreach (json_decode($data->Initial_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                    class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input disabled type="file" id="myfile"
                                                    name="Initial_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="button-block">
                                <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }}
                                    id="ChangesaveButton03" class="saveAuditFormBtn d-flex" style="align-items: center;">
                                    <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none"
                                        role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Save
                                </button>
                                <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                    class="nextButton" onclick="nextStep()">Next</button>
                                <button  style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                                        @if ($data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 )
                                        <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                            class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#launch_extension">
                                            Launch Extension
                                        </a>
                                        @endif
                                        <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#effectivenss_extension">
                                            Launch Effectiveness Check
                                        </a> -->
                            </div>
                        </div>
                    </div>
                    <script>
                        var checkValue = false;
                        $(document).ready(function() {
                            $('#Deviation_category').change(function() {
                                if ($(this).val() === 'major' || $(this).val() === 'critical') {
                                    checkValue = true;
                                    $('#Investigation_required').val('yes').prop('disabled', true);
                                    $('#capa_required').val('yes').prop('disabled', true);
                                    $('#qrm_required').val('yes').prop('disabled', true);
                                    $('#Customer_notification').val('yes').prop('disabled', true);
                                    var asteriskIcon = document.getElementById('asteriskInviinvestication');
                                    var asteriskIcon2 = document.getElementById('asterikCustomer_notification');
                                    asteriskIcon.style.display = 'inline';
                                    asteriskIcon2.style.display = 'inline';
                                } else {
                                    $('#Customer_notification').prop('disabled', false);
                                    $('#Investigation_required').prop('disabled', false);
                                    $('#capa_required').prop('disabled', false);
                                    $('#qrm_required').prop('disabled', false);
                                    var asteriskIcon = document.getElementById('asteriskInviinvestication');
                                    var asteriskIcon2 = document.getElementById('asterikCustomer_notification');
                                    asteriskIcon.style.display = 'none';
                                    asteriskIcon2.style.display = 'none';
                                }
                            });
                        });

                        // Enable the field before submitting the form
                        $('form').submit(function() {
                            $('#Investigation_required').prop('disabled', false);
                            // $('#capa_required').prop('disabled', false);
                            // $('#qrm_required').prop('disabled', false);
                            $('#Customer_notification').prop('disabled', false);
                        });
                    </script>

                    <!-- CFT -->
                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">
                                    Production
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Production_Review !== 'yes')

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
                                        @endif
                                    });
                                </script>
                                @php
                                    $data1 = DB::table('deviationcfts')
                                        ->where('deviation_id', $data->id)
                                        ->first();
                                @endphp
                                @if ($data->stage == 3 || $data->stage == 4)
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Production Review"> Production Review Required ? <span
                                                    class="text-danger">*</span></label>
                                            <select name="Production_Review" id="Production_Review"
                                                @if ($data->stage == 4) disabled @endif
                                                @if ($data->stage == 3) required @endif>
                                                <option value="">-- Select --</option>
                                                <option @if ($data1->Production_Review == 'yes') selected @endif value='yes'>
                                                    Yes</option>
                                                <option @if ($data1->Production_Review == 'no') selected @endif value='no'>
                                                    No</option>
                                                <option @if ($data1->Production_Review == 'na') selected @endif value='na'>
                                                    NA</option>
                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 22,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        // $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 p_erson">
                                        <div class="group-input">
                                            <label for="Production notification">Production Person <span
                                                    id="asteriskProduction"
                                                    style="display: {{ $data1->Production_Review == 'yes' ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span>
                                            </label>
                                            <select @if ($data->stage == 4) disabled @endif
                                                name="Production_person" class="Production_person"
                                                id="Production_person">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if ($user->id == $data1->Production_person) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 p_erson">
                                        <div class="group-input">
                                            <label for="Production assessment">Impact Assessment (By Production) <span
                                                    id="asteriskProduction1"
                                                    style="display: {{ $data1->Production_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea @if ($data1->Production_Review == 'yes' && $data->stage == 4) required @endif class="summernote Production_assessment"
                                                @if ($data->stage == 3 || Auth::user()->id != $data1->Production_person) readonly @endif name="Production_assessment" id="summernote-17">{{ $data1->Production_assessment }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 p_erson">
                                        <div class="group-input">
                                            <label for="Production feedback">Production Feedback <span
                                                    id="asteriskProduction2"
                                                    style="display: {{ $data1->Production_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea class="summernote Production_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Production_person) readonly @endif
                                                name="Production_feedback" id="summernote-18" @if ($data1->Production_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Production_feedback }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 p_erson">
                                        <div class="group-input">
                                            <label for="production attachment">Production Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="production_attachment">
                                                    @if ($data1->production_attachment)
                                                        @foreach (json_decode($data1->production_attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}"
                                                                    target="_blank"><i class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file"
                                                                    data-file-name="{{ $file }}"><i
                                                                        class="fa-solid fa-circle-xmark"
                                                                        style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile"
                                                        name="production_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'production_attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 p_erson">
                                        <div class="group-input">
                                            <label for="Production Review Completed By">Production Review Completed
                                                By</label>
                                            <input readonly type="text" value="{{ $data1->Production_by }}"
                                                name="production_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                id="production_by">


                                        </div>
                                    </div>
                                    <div class="col-lg-6 p_erson">
                                        <div class="group-input ">
                                            <label for="Production Review Completed On">Production Review Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input type="date"id="production_on"
                                                name="production_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data1->production_on }}">
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var selectField = document.getElementById('Production_Review');
                                            var inputsToToggle = [];

                                            // Add elements with class 'facility-name' to inputsToToggle
                                            var facilityNameInputs = document.getElementsByClassName('Production_person');
                                            for (var i = 0; i < facilityNameInputs.length; i++) {
                                                inputsToToggle.push(facilityNameInputs[i]);
                                            }
                                            // var facilityNameInputs = document.getElementsByClassName('Production_assessment');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }
                                            // var facilityNameInputs = document.getElementsByClassName('Production_feedback');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }

                                            selectField.addEventListener('change', function() {
                                                var isRequired = this.value === 'yes';
                                                console.log(this.value, isRequired, 'value');

                                                inputsToToggle.forEach(function(input) {
                                                    input.required = isRequired;
                                                    console.log(input.required, isRequired, 'input req');
                                                });

                                                // Show or hide the asterisk icon based on the selected value
                                                var asteriskIcon = document.getElementById('asteriskProduction');
                                                asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            });
                                        });
                                    </script>
                                @else
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Production Review">Production Review Required ?</label>
                                            <select name="Production_Review" disabled id="Production_Review">
                                                <option value="">-- Select --</option>
                                                <option @if ($data1->Production_Review == 'yes') selected @endif value='yes'>
                                                    Yes</option>
                                                <option @if ($data1->Production_Review == 'no') selected @endif value='no'>
                                                    No</option>
                                                <option @if ($data1->Production_Review == 'na') selected @endif value='na'>
                                                    NA</option>
                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 22,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 p_erson">
                                        <div class="group-input">
                                            <label for="Production notification">Production Person <span
                                                    id="asteriskInvi11" style="display: none"
                                                    class="text-danger">*</span></label>
                                            <select name="Production_person" disabled id="Production_person">
                                                <option value="0">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if ($user->id == $data1->Production_person) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if ($data->stage == 4)
                                        <div class="col-md-12 mb-3 p_erson">
                                            <div class="group-input">
                                                <label for="Production assessment">Impact Assessment (By Production) <span
                                                        id="asteriskInvi12" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="Production_assessment" id="summernote-17">{{ $data1->Production_assessment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 p_erson">
                                            <div class="group-input">
                                                <label for="Production feedback">Production Feedback <span
                                                        id="asteriskInvi22" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="Production_feedback" id="summernote-18">{{ $data1->Production_feedback }}</textarea>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12 mb-3 p_erson">
                                            <div class="group-input">
                                                <label for="Production assessment">Impact Assessment (By Production) <span
                                                        id="asteriskInvi12" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea disabled class="tiny" name="Production_assessment" id="summernote-17">{{ $data1->Production_assessment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 p_erson">
                                            <div class="group-input">
                                                <label for="Production feedback">Production Feedback <span
                                                        id="asteriskInvi22" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea disabled class="tiny" name="Production_feedback" id="summernote-18">{{ $data1->Production_feedback }}</textarea>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12 p_erson">
                                        <div class="group-input">
                                            <label for="production attachment">Production Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="production_attachment">
                                                    @if ($data1->production_attachment)
                                                        @foreach (json_decode($data1->production_attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}"
                                                                    target="_blank"><i class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file"
                                                                    data-file-name="{{ $file }}"><i
                                                                        class="fa-solid fa-circle-xmark"
                                                                        style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input disabled
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="production_attachment[]"
                                                        oninput="addMultipleFiles(this, 'production_attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 p_erson">
                                        <div class="group-input">
                                            <label for="Production Review Completed By">Production Review Completed
                                                By</label>
                                            <input readonly type="text" value="{{ $data1->Production_by }}"
                                                name="production_by" id="production_by">


                                        </div>
                                    </div>
                                    <div class="col-lg-6 p_erson">
                                        <div class="group-input">
                                            <label for="Production Review Completed On">Production Review Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input readonly type="date"id="production_on" name="production_on"
                                                value="{{ $data1->production_on }}">
                                        </div>
                                    </div>
                                @endif

                                <div class="sub-head">
                                    Warehouse
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Warehouse_review !== 'yes')

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
                                        @endif
                                    });
                                </script>
                                @if ($data->stage == 3 || $data->stage == 4)
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Warehouse Review Required">Warehouse Review Required ? <span
                                                    class="text-danger">*</span></label>
                                            <select @if ($data->stage == 3) required @endif
                                                name="Warehouse_review" id="Warehouse_review"
                                                @if ($data->stage == 4) disabled @endif>
                                                <option value="0">-- Select --</option>
                                                <option @if ($data1->Warehouse_review == 'yes') selected @endif
                                                    value="yes">Yes</option>
                                                <option @if ($data1->Warehouse_review == 'no') selected @endif
                                                    value="no">No</option>
                                                <option @if ($data1->Warehouse_review == 'na') selected @endif
                                                    value="na">NA</option>

                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 23,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 warehouse">
                                        <div class="group-input">
                                            <label for="Warehouse Person">Warehouse Person <span id="asteriskware"
                                                    style="display: {{ $data1->Warehouse_review == 'yes' ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <select name="Warehouse_notification" class="Warehouse_notification"
                                                id="Warehouse_notification"
                                                value="{{ $data1->Warehouse_notification }}"
                                                @if ($data->stage == 4) disabled @endif>
                                                <option value=""> -- Select --</option>
                                                @foreach ($users as $user)
                                                    <option
                                                        {{ $data1->Warehouse_notification == $user->id ? 'selected' : '' }}
                                                        value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 warehouse">
                                        <div class="group-input">
                                            <label for="Impact Assessment1">Impact Assessment (By Warehouse) <span
                                                    id="asteriskware2"
                                                    style="display: {{ $data1->Warehouse_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea @if ($data1->Warehouse_review == 'yes' && $data->stage == 4) required @endif class="summernote Warehouse_assessment"
                                                name="Warehouse_assessment" id="summernote-19" @if ($data->stage == 3 || Auth::user()->id != $data1->Warehouse_notification) readonly @endif>{{ $data1->Warehouse_assessment }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 warehouse">
                                        <div class="group-input">
                                            <label for="Warehouse Feedback">Warehouse Feedback <span id="asteriskware3"
                                                    style="display: {{ $data1->Warehouse_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea @if ($data1->Warehouse_review == 'yes' && $data->stage == 4) required @endif class="summernote Warehouse_feedback"
                                                name="Warehouse_feedback" id="summernote-20" @if ($data->stage == 3 || Auth::user()->id != $data1->Warehouse_notification) readonly @endif>{{ $data1->Warehouse_feedback }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 warehouse">
                                        <div class="group-input">
                                            <label for="Warehouse attachment">Warehouse Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="Warehouse_attachment">
                                                    @if ($data1->Warehouse_attachment)
                                                        @foreach (json_decode($data1->Warehouse_attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}"
                                                                    target="_blank"><i class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file"
                                                                    data-file-name="{{ $file }}"><i
                                                                        class="fa-solid fa-circle-xmark"
                                                                        style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="Warehouse_attachment[]"
                                                        oninput="addMultipleFiles(this, 'Warehouse_attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var selectField = document.getElementById('Warehouse_review');
                                            var inputsToToggle = [];

                                            // Add elements with class 'facility-name' to inputsToToggle
                                            var facilityNameInputs = document.getElementsByClassName('Warehouse_notification');
                                            for (var i = 0; i < facilityNameInputs.length; i++) {
                                                inputsToToggle.push(facilityNameInputs[i]);
                                            }
                                            // var facilityNameInputs = document.getElementsByClassName('Warehouse_assessment');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }
                                            // var facilityNameInputs = document.getElementsByClassName('Warehouse_feedback');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }

                                            selectField.addEventListener('change', function() {
                                                var isRequired = this.value === 'yes';

                                                inputsToToggle.forEach(function(input) {
                                                    input.required = isRequired;
                                                });

                                                // Show or hide the asterisk icon based on the selected value
                                                var asteriskIcon = document.getElementById('asteriskware');
                                                asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            });
                                        });
                                    </script>

                                    <div class="col-md-6 mb-3 warehouse">
                                        <div class="group-input">
                                            <label for="Warehouse Review Completed By">Warehouse Review Completed By</label>
                                            <input disabled type="text" value="{{ $data1->Warehouse_by }}" name="Warehouse_by" id="Warehouse_by">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3 warehouse">
                                        <div class="group-input">
                                            <label for="Warehouse Review Completed On">Warehouse Review Completed On</label>
                                            <input type="date"id="Warehouse_on" name="Warehouse_on"
                                                value="{{ $data1->Warehouse_on }}">
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6 warehouse">
                                        <div class="group-input">
                                            <label for="Warehouse Review Required">Warehouse Review Required ?</label>
                                            <select disabled name="Warehouse_review" id="Warehouse_review">
                                                <option value="0">-- Select --</option>
                                                <option @if ($data1->Warehouse_review == 'yes') selected @endif
                                                    value="yes">Yes</option>
                                                <option @if ($data1->Warehouse_review == 'no') selected @endif
                                                    value="no">No</option>
                                                <option @if ($data1->Warehouse_review == 'na') selected @endif
                                                    value="na">NA</option>

                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 23,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 warehouse">
                                        <div class="group-input">
                                            <label for="Warehouse Person">Warehouse Person </label>
                                            <select disabled name="Warehouse_notification" id="Warehouse_notification"
                                                value="{{ $data1->Warehouse_notification }}">
                                                <option value=""> -- Select --</option>
                                                @foreach ($users as $user)
                                                    <option
                                                        {{ $data1->Warehouse_notification == $user->id ? 'selected' : '' }}
                                                        value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    @if ($data->stage == 4)
                                        <div class="col-md-12 mb-3 warehouse">
                                            <div class="group-input">
                                                <label for="Impact Assessment1">Impact Assessment (By Warehouse)</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if
                                                        it does not require completion</small></div>
                                                <textarea class="tiny" name="Warehouse_assessment" id="summernote-19">{{ $data1->Warehouse_assessment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 warehouse">
                                            <div class="group-input">
                                                <label for="Warehouse Feedback">Warehouse Feedback</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if
                                                        it does not require completion</small></div>
                                                <textarea class="tiny" name="Warehouse_feedback" id="summernote-20">{{ $data1->Warehouse_feedback }}</textarea>
                                            </div>
                                        </div>
                            </div>
                        @else
                            <div class="col-md-12 mb-3 warehouse">
                                <div class="group-input">
                                    <label for="Impact Assessment1">Impact Assessment (By Warehouse)</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea disabled class="tiny" name="Warehouse_assessment" id="summernote-19">{{ $data1->Warehouse_assessment }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 warehouse">
                                <div class="group-input">
                                    <label for="Warehouse Feedback">Warehouse Feedback</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea disabled class="tiny" name="Warehouse_feedback" id="summernote-20">{{ $data1->Warehouse_feedback }}</textarea>
                                </div>
                            </div>
                            @endif
                            <div class="col-12 warehouse">
                                <div class="group-input">
                                    <label for="Warehouse attachment">Warehouse Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="Warehouse_attachment">
                                            @if ($data1->Warehouse_attachment)
                                                @foreach (json_decode($data1->Warehouse_attachment) as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file"
                                                            data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                type="file" id="myfile" name="Warehouse_attachment[]"
                                                oninput="addMultipleFiles(this, 'Warehouse_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 warehouse">
                                <div class="group-input">
                                    <label for="Warehouse Review Completed By">Warehouse Review Completed By</label>
                                    <input disabled type="text" value="{{ $data1->Warehouse_by }}"
                                        name="Warehouse_by" id="Warehouse_by">
                                </div>
                            </div>
                            <div class="col-lg-6 warehouse">
                                <div class="group-input">
                                    <label for="Warehouse Review Completed On">Warehouse Review Completed On</label>
                                    <input disabled type="date"id="Warehouse_on" name="Warehouse_on"
                                        value="{{ $data1->Warehouse_on }}">
                                </div>
                            </div>
                            @endif

                            <div class="sub-head">
                                Quality Control
                            </div>
                            <script>
                                $(document).ready(function() {
                                    @if($data1->Quality_review !== 'yes')

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
                                    @endif
                                });
                            </script>
                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control Review Required">Quality Control Review Required?
                                            <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif name="Quality_review"
                                            id="Quality_review" @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Quality_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Quality_review == 'no') selected @endif value="no">No
                                            </option>
                                            <option @if ($data1->Quality_review == 'na') selected @endif value="na">NA
                                            </option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 24, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Person">Quality Control Person <span id="asteriskQC"
                                                style="display: {{ $data1->Quality_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Quality_Control_Person" class="Quality_Control_Person"
                                            id="Quality_Control_Person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Quality_Control_Person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_control">
                                    <div class="group-input">
                                        <label for="Impact Assessment2">Impact Assessment (By Quality Control) <span
                                                id="asteriskQC1"
                                                style="display: {{ $data1->Quality_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Quality_review == 'yes' && $data->stage == 4) required @endif class="summernote Quality_Control_assessment"
                                            name="Quality_Control_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->Quality_Control_Person) readonly @endif id="summernote-21">{{ $data1->Quality_Control_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Feedback">Quality Control Feedback <span
                                                id="asteriskQC2"
                                                style="display: {{ $data1->Quality_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Quality_review == 'yes' && $data->stage == 4) required @endif class="summernote Quality_Control_feedback"
                                            name="Quality_Control_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Quality_Control_Person) readonly @endif id="summernote-22">{{ $data1->Quality_Control_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Quality_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Quality_Control_Person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskQC');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Attachments">Quality Control Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Quality_Control_attachment">
                                                @if ($data1->Quality_Control_attachment)
                                                    @foreach (json_decode($data1->Quality_Control_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Quality_Control_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Control_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Review Completed By">Quality Control Review Completed
                                            By</label>
                                        <input disabled type="text" value="{{ $data1->Quality_Control_by }}"
                                            name="Quality_Control_by" id="Quality_Control_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Review Completed On">Quality Control Review Completed
                                            On</label>
                                        <input type="date"id="Quality_Control_on" name="Quality_Control_on"
                                            value="{{ $data1->Quality_Control_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Quality Assurance
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Quality_Assurance_Review !== 'yes')

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
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Required">Quality Assurance Review Required ?
                                            <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Quality_Assurance_Review" id="Quality_Assurance_Review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Quality_Assurance_Review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Quality_Assurance_Review == 'no') selected @endif value="no">No
                                            </option>
                                            <option @if ($data1->Quality_Assurance_Review == 'na') selected @endif value="na">NA
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 26, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Person">Quality Assurance Person <span
                                                id="asteriskQQA"
                                                style="display: {{ $data1->Quality_Assurance_Review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="QualityAssurance_person" class="QualityAssurance_person"
                                            id="QualityAssurance_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->QualityAssurance_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Impact Assessment3">Impact Assessment (By Quality Assurance) <span
                                                id="asteriskQQA1"
                                                style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 4) required @endif class="summernote QualityAssurance_assessment"
                                            name="QualityAssurance_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->QualityAssurance_person) readonly @endif id="summernote-23">{{ $data1->QualityAssurance_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Feedback">Quality Assurance Feedback <span
                                                id="asteriskQQA2"
                                                style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 4) required @endif class="summernote QualityAssurance_feedback"
                                            name="QualityAssurance_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->QualityAssurance_person) readonly @endif id="summernote-24">{{ $data1->QualityAssurance_feedback }}</textarea>
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Quality_Assurance_Review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('QualityAssurance_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskQQA');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Attachments">Quality Assurance Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Quality_Assurance_attachment">
                                                @if ($data1->Quality_Assurance_attachment)
                                                    @foreach (json_decode($data1->Quality_Assurance_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
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
                                        <input type="text" name="QualityAssurance_by" id="QualityAssurance_by"
                                            value="{{ $data1->QualityAssurance_by }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Completed On">Quality Assurance Review
                                            Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="QualityAssurance_on" name="QualityAssurance_on"
                                            value="{{ $data1->QualityAssurance_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Engineering
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Engineering_review !== 'yes')

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
                                        @endif

                                    });
                                </script>
                                <div class="sub-head">
                                    Engineering
                                </div>

                                <div class="col-lg-6 ">
                                    <div class="group-input">
                                        <label for="Customer notification">Engineering Review Required ? <span
                                                class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Engineering_review" id="Engineering_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Engineering_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Engineering_review == 'no') selected @endif value="no">No
                                            </option>
                                            <option @if ($data1->Engineering_review == 'na') selected @endif value="na">NA
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 25, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 engineering">
                                    <div class="group-input">
                                        <label for="Customer notification">Engineering Person <span id="asteriskEP"
                                                style="display: {{ $data1->Engineering_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Engineering_person" class="Engineering_person"
                                            id="Engineering_person" @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Engineering_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 engineering">
                                    <div class="group-input">
                                        <label for="Impact Assessment4">Impact Assessment (By Engineering) <span
                                                id="asteriskEP1"
                                                style="display: {{ $data1->Engineering_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Engineering_review == 'yes' && $data->stage == 4) required @endif class="summernote Engineering_assessment"
                                            name="Engineering_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->Engineering_person) readonly @endif id="summernote-25">{{ $data1->Engineering_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 engineering">
                                    <div class="group-input">
                                        <label for="Engineering Feedback">Engineering Feedback <span id="asteriskEP2"
                                                style="display: {{ $data1->Engineering_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Engineering_review == 'yes' && $data->stage == 4) required @endif class="summernote Engineering_feedback"
                                            name="Engineering_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Engineering_person) readonly @endif id="summernote-26">{{ $data1->Engineering_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Engineering_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Engineering_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskEP');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 engineering">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Engineering Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Engineering_attachment">
                                                @if ($data1->Engineering_attachment)
                                                    @foreach (json_decode($data1->Engineering_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Engineering_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Engineering_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 engineering">
                                    <div class="group-input">
                                        <label for="Engineering Review Completed By">Engineering Review Completed
                                            By</label>
                                        <input disabled type="text" value="{{ $data1->Engineering_by }}"
                                            name="Engineering_by" id="Engineering_by">

                                    </div>
                                </div>
                                <div class="col-lg-6 engineering">
                                    <div class="group-input">
                                        <label for="Engineering Review Completed On">Engineering Review Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date" id="Engineering_on" name="Engineering_on"
                                            value="{{ $data1->Engineering_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Analytical Development Laboratory
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Analytical_Development_review!== 'yes')

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
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Required">Analytical
                                            Development Laboratory Review Required ? <span
                                                class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Analytical_Development_review" id="Analytical_Development_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Analytical_Development_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Analytical_Development_review == 'no') selected @endif value="no">No
                                            </option>
                                            <option @if ($data1->Analytical_Development_review == 'na') selected @endif value="na">NA
                                            </option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 27, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 analytical_development">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Person"> Analytical Development
                                            Laboratory Person <span id="asteriskAD"
                                                style="display: {{ $data1->Analytical_Development_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Analytical_Development_person"
                                            class="Analytical_Development_person" id="Analytical_Development_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Analytical_Development_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 analytical_development">
                                    <div class="group-input">
                                        <label for="Impact Assessment5">Impact Assessment (By Analytical Development
                                            Laboratory) <span id="asteriskAD1"
                                                style="display: {{ $data1->Analytical_Development_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Analytical_Development_review == 'yes' && $data->stage == 4) required @endif class="summernote Analytical_Development_assessment"
                                            name="Analytical_Development_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->Analytical_Development_person) readonly @endif
                                            id="summernote-27">{{ $data1->Analytical_Development_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 analytical_development">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Feedback"> Analytical Development
                                            Laboratory Feedback <span id="asteriskAD2"
                                                style="display: {{ $data1->Analytical_Development_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Analytical_Development_review == 'yes' && $data->stage == 4) required @endif class="summernote Analytical_Development_feedback"
                                            name="Analytical_Development_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Analytical_Development_person) readonly @endif id="summernote-28">{{ $data1->Analytical_Development_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Analytical_Development_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Analytical_Development_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskAD');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 analytical_development">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Analytical Development Laboratory
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Analytical_Development_attachment">
                                                @if ($data1->Analytical_Development_attachment)
                                                    @foreach (json_decode($data1->Analytical_Development_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
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
                                        <input disabled type="text" value="{{ $data1->Analytical_Development_by }}"
                                            name="Analytical_Development_by" id="Analytical_Development_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 analytical_development">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Completed On">Analytical
                                            Development Laboratory Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date" id="Analytical_Development_on"
                                            name="Analytical_Development_on"
                                            value="{{ $data1->Analytical_Development_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Process Development Laboratory / Kilo Lab
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Kilo_Lab_review !== 'yes')

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
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Process Development Laboratory"> Process Development Laboratory / Kilo
                                            Lab Review Required ? <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Kilo_Lab_review" id="Kilo_Lab_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Kilo_Lab_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Kilo_Lab_review == 'no') selected @endif value="no">No
                                            </option>
                                            <option @if ($data1->Kilo_Lab_review == 'na') selected @endif value="na">NA
                                            </option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 28, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 kilo_lab">
                                    <div class="group-input">
                                        <label for="Process Development Laboratory"> Process Development Laboratory / Kilo
                                            Lab Person <span id="asteriskPDL"
                                                style="display: {{ $data1->Kilo_Lab_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Kilo_Lab_person" class="Kilo_Lab_person" id="Kilo_Lab_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Kilo_Lab_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 kilo_lab">
                                    <div class="group-input">
                                        <label for="Impact Assessment6">Impact Assessment (By Process Development
                                            Laboratory / Kilo Lab) <span id="asteriskPDL1"
                                                style="display: {{ $data1->Kilo_Lab_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Kilo_Lab_review == 'yes' && $data->stage == 4) required @endif class="summernote Analytical_Development_assessment"
                                            name="Kilo_Lab_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->Kilo_Lab_person) readonly @endif id="summernote-29">{{ $data1->Kilo_Lab_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 kilo_lab">
                                    <div class="group-input">
                                        <label for="Kilo Lab Feedback"> Process Development Laboratory / Kilo Lab Feedback
                                            <span id="asteriskPDL2"
                                                style="display: {{ $data1->Kilo_Lab_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Kilo_Lab_review == 'yes' && $data->stage == 4) required @endif class="summernote Analytical_Development_feedback"
                                            name="Kilo_Lab_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Kilo_Lab_person) readonly @endif id="summernote-30">{{ $data1->Kilo_Lab_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Kilo_Lab_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Kilo_Lab_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPDL');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 kilo_lab">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Process Development Laboratory / Kilo Lab
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Kilo_Lab_attachment">
                                                @if ($data1->Kilo_Lab_attachment)
                                                    @foreach (json_decode($data1->Kilo_Lab_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Kilo_Lab_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Kilo_Lab_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 kilo_lab">
                                    <div class="group-input">
                                        <label for="Kilo Lab Review Completed By">Process Development Laboratory / Kilo
                                            Lab Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Kilo_Lab_attachment_by }}"
                                            name="Kilo_Lab_attachment_by" id="Kilo_Lab_attachment_by">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 kilo_lab">
                                    <div class="group-input">
                                        <label for="Kilo Lab Review Completed On">Process Development Laboratory / Kilo
                                            Lab Review Completed On</label>
                                        <input type="date" id="Kilo_Lab_attachment_on"
                                            name="Kilo_Lab_attachment_on"
                                            value="{{ $data1->Kilo_Lab_attachment_on }}">

                                    </div>
                                </div>
                                <div class="sub-head">
                                    Technology Transfer / Design
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Technology_transfer_review !== 'yes')

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
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Design Review Required">Technology Transfer / Design Review Required ?
                                            <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Technology_transfer_review" id="Technology_transfer_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Technology_transfer_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Technology_transfer_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Technology_transfer_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 29, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 technology_transfer">
                                    <div class="group-input">
                                        <label for="Design Person"> Technology Transfer / Design Person <span
                                                id="asteriskTT"
                                                style="display: {{ $data1->Technology_transfer_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Technology_transfer_person" class="Technology_transfer_person"
                                            id="Technology_transfer_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Technology_transfer_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 technology_transfer">
                                    <div class="group-input">
                                        <label for="Impact Assessment7">Impact Assessment (By Technology Transfer /
                                            Design) <span id="asteriskTT1"
                                                style="display: {{ $data1->Technology_transfer_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Technology_transfer_review == 'yes' && $data->stage == 4) required @endif class="summernote Technology_transfer_assessment"
                                            name="Technology_transfer_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->Technology_transfer_person) readonly @endif id="summernote-31">{{ $data1->Technology_transfer_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 technology_transfer">
                                    <div class="group-input">
                                        <label for="Design Feedback"> Technology Transfer / Design Feedback <span
                                                id="asteriskTT2"
                                                style="display: {{ $data1->Technology_transfer_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Technology_transfer_review == 'yes' && $data->stage == 4) required @endif class="summernote Technology_transfer_feedback"
                                            name="Technology_transfer_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Technology_transfer_person) readonly @endif id="summernote-32">{{ $data1->Technology_transfer_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Technology_transfer_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Technology_transfer_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskTT');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 technology_transfer">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Technology Transfer / Design Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Technology_transfer_attachment">
                                                @if ($data1->Technology_transfer_attachment)
                                                    @foreach (json_decode($data1->Technology_transfer_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Technology_transfer_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Technology_transfer_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 technology_transfer">
                                    <div class="group-input">
                                        <label for="productionfeedback">Technology Transfer / Design Review Completed
                                            By</label>
                                        <input disabled type="text" value="{{ $data1->Technology_transfer_by }}"
                                            name="Technology_transfer_by" id="Technology_transfer_by">


                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 technology_transfer">
                                    <div class="group-input">
                                        <label for="productionfeedback">Technology Transfer / Design Review Completed
                                            On</label>
                                        <input type="date" id="Technology_transfer_on"
                                            name="Technology_transfer_on"
                                            value="{{ $data1->Technology_transfer_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Environment, Health & Safety
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Environment_Health_review !== 'yes')

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
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Safety Review Required">Environment, Health & Safety Review Required ?
                                            <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Environment_Health_review" id="Environment_Health_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Environment_Health_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Environment_Health_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Environment_Health_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 30, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 environmental_health">
                                    <div class="group-input">
                                        <label for="Safety Person"> Environment, Health & Safety Person <span
                                                id="asteriskEH"
                                                style="display: {{ $data1->Environment_Health_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Environment_Health_Safety_person"
                                            class="Environment_Health_Safety_person"
                                            id="Environment_Health_Safety_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Environment_Health_Safety_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="Impact Assessment8">Impact Assessment (By Environment, Health &
                                            Safety) <span id="asteriskEH1"
                                                style="display: {{ $data1->Environment_Health_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Environment_Health_review == 'yes' && $data->stage == 4) required @endif class="tiny" name="Health_Safety_assessment"
                                            @if ($data->stage == 3 || Auth::user()->id != $data1->Environment_Health_Safety_person) readonly @endif id="summernote-33">{{ $data1->Health_Safety_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="Safety Feedback">Environment, Health & Safety Feedback <span
                                                id="asteriskEH2"
                                                style="display: {{ $data1->Environment_Health_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Environment_Health_review == 'yes' && $data->stage == 4) required @endif class="tiny" name="Health_Safety_feedback"
                                            id="summernote-34" @if ($data->stage == 3 || Auth::user()->id != $data1->Environment_Health_Safety_person) readonly @endif>{{ $data1->Health_Safety_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Environment_Health_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Environment_Health_Safety_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskEH');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 environmental_health">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Environment, Health & Safety Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Environment_Health_Safety_attachment">
                                                @if ($data1->Environment_Health_Safety_attachment)
                                                    @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Environment_Health_Safety_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="Safety Review Completed By">Environment, Health & Safety Review
                                            Completed By</label>
                                        <input disabled type="text"
                                            value="{{ $data1->Environment_Health_Safety_by }}"
                                            name="Environment_Health_Safety_by" id="Environment_Health_Safety_by">


                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="Safety Review Completed On">Environment, Health & Safety Review
                                            Completed On</label>
                                        <input type="date" id="Environment_Health_Safety_on"
                                            name="Environment_Health_Safety_on"
                                            value="{{ $data1->Environment_Health_Safety_on }}">

                                    </div>
                                </div>
                                <div class="sub-head">
                                    Human Resource & Administration
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Human_Resource_review !== 'yes')

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
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Human Resource & Administration Review Required
                                            ? <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Human_Resource_review" id="Human_Resource_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Human_Resource_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Human_Resource_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Human_Resource_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 31, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 human_resources">
                                    <div class="group-input">
                                        <label for="Customer notification"> Human Resource & Administration Person <span
                                                id="asteriskHR"
                                                style="display: {{ $data1->Human_Resource_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Human_Resource_person" class="Human_Resource_person"
                                            id="Human_Resource_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Human_Resource_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Human Resource &
                                            Administration ) <span id="asteriskHR1"
                                                style="display: {{ $data1->Human_Resource_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Human_Resource_review == 'yes' && $data->stage == 4) required @endif class="summernote Human_Resource_assessment"
                                            name="Human_Resource_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->Human_Resource_person) readonly @endif id="summernote-35">{{ $data1->Human_Resource_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="productionfeedback">Human Resource & Administration Feedback <span
                                                id="asteriskHR2"
                                                style="display: {{ $data1->Human_Resource_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Human_Resource_review == 'yes' && $data->stage == 4) required @endif class="summernote Human_Resource_feedback"
                                            name="Human_Resource_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Human_Resource_person) readonly @endif id="summernote-36">{{ $data1->Human_Resource_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Human_Resource_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Human_Resource_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskHR');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 human_resources">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Human Resource & Administration Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Human_Resource_attachment">
                                                @if ($data1->Human_Resource_attachment)
                                                    @foreach (json_decode($data1->Human_Resource_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Human_Resource_attachment[]"
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
                                        <input disabled type="text" value="{{ $data1->Human_Resource_by }}"
                                            name="Human_Resource_by" id="Human_Resource_by">


                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="Administration Review Completed On"> Human Resource & Administration
                                            Review Completed On</label>
                                        <input type="date" id="Environment_Health_Safety_on"
                                            name="Environment_Health_Safety_on"
                                            value="{{ $data1->Environment_Health_Safety_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Information Technology
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Information_Technology_review !== 'yes')

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
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6 ">
                                    <div class="group-input">
                                        <label for="Information Technology Review Required"> Information Technology Review
                                            Required ? <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name=" Information_Technology_review" id=" Information_Technology_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Information_Technology_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Information_Technology_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Information_Technology_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 32, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 information_technology">
                                    <div class="group-input">
                                        <label for="Information Technology Person"> Information Technology Person <span
                                                id="asteriskITP"
                                                style="display: {{ $data1->Information_Technology_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name=" Information_Technology_person"
                                            class="Information_Technology_person" id=" Information_Technology_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Information_Technology_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 information_technology">
                                    <div class="group-input">
                                        <label for="Impact Assessment10">Impact Assessment (By Information Technology)
                                            <span id="asteriskITP"
                                                style="display: {{ $data1->Information_Technology_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Information_Technology_review == 'yes' && $data->stage == 4) required @endif class="summernote Information_Technology_assessment"
                                            name="Information_Technology_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->Information_Technology_person) readonly @endif
                                            id="summernote-37">{{ $data1->Information_Technology_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 information_technology">
                                    <div class="group-input">
                                        <label for="Information Technology Feedback">Information Technology Feedback <span
                                                id="asteriskITP"
                                                style="display: {{ $data1->Information_Technology_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Information_Technology_review == 'yes' && $data->stage == 4) required @endif class="summernote Information_Technology_feedback"
                                            name="Information_Technology_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Information_Technology_person) readonly @endif id="summernote-38">{{ $data1->Information_Technology_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Information_Technology_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Information_Technology_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskITP');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 information_technology">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Information Technology Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Information_Technology_attachment">
                                                @if ($data1->Information_Technology_attachment)
                                                    @foreach (json_decode($data1->Information_Technology_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
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
                                        <input disabled type="text" value="{{ $data1->Information_Technology_by }}"
                                            name="Information_Technology_by" id="Information_Technology_by">

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 information_technology">
                                    <div class="group-input">
                                        <label for="Information Technology Review Completed On">Information Technology
                                            Review Completed On</label>
                                        <input type="text" name="Information_Technology_on"
                                            id="Information_Technology_on"
                                            value={{ $data1->Information_Technology_on }}>
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Project Management
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Project_management_review !== 'yes')

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
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Project management Review Required"> Project management Review
                                            Required ? <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Project_management_review" id="Project_management_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Project_management_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Project_management_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Project_management_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 33, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 project_management">
                                    <div class="group-input">
                                        <label for="Project management Person"> Project management Person <span
                                                id="asteriskPMP"
                                                style="display: {{ $data1->Project_management_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Project_management_person" class="Project_management_person"
                                            id="Project_management_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Project_management_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 project_management">
                                    <div class="group-input">
                                        <label for="Impact Assessment11">Impact Assessment (By Project management ) <span
                                                id="asteriskPMP"
                                                style="display: {{ $data1->Project_management_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Project_management_review == 'yes' && $data->stage == 4) required @endif class="summernote Project_management_assessment"
                                            name="Project_management_assessment" id="summernote-39" @if ($data->stage == 3 || Auth::user()->id != $data1->Project_management_person) readonly @endif>{{ $data1->Project_management_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 project_management">
                                    <div class="group-input">
                                        <label for="Project management Feedback"> Project management Feedback <span
                                                id="asteriskPMP"
                                                style="display: {{ $data1->Project_management_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Project_management_review == 'yes' && $data->stage == 4) required @endif class="summernote Project_management_feedback"
                                            name="Project_management_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Project_management_person) readonly @endif id="summernote-40">{{ $data1->Project_management_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Project_management_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Project_management_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPMP');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 project_management">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Project management Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Project_management_attachment">
                                                @if ($data1->Project_management_attachment)
                                                    @foreach (json_decode($data1->Project_management_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
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
                                        <input disabled type="text" value="{{ $data1->Project_management_by }}"
                                            name="Project_management_by" id="Project_management_by">

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 project_management">
                                    <div class="group-input">
                                        <label for="Project management Review Completed On">Project management Review
                                            Completed On</label>
                                        <input type="date" name="Project_management_on" id="Project_management_on"
                                            value="{{ $data1->Project_management_on }}">
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control Review Required">Quality Control Review
                                            Required?</label>
                                        <select disabled name="Quality_review" id="Quality_review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Quality_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Quality_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Quality_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>                                        
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 24, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control Person">Quality Control Person</label>
                                        <select disabled name="Quality_Control_Person" id="Quality_Control_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Quality_Control_Person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment2">Impact Assessment (By Quality Control)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny"
                                            name="Quality_Control_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-21">{{ $data1->Quality_Control_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Quality Control Feedback">Quality Control Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny"
                                            name="Quality_Control_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-22">{{ $data1->Quality_Control_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Quality Control Attachments">Quality Control Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Quality_Control_attachment">
                                                @if ($data1->Quality_Control_attachment)
                                                    @foreach (json_decode($data1->Quality_Control_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Quality_Control_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Control_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Quality Control Review Completed By">Quality Control Review Completed
                                            By</label>
                                        <input disabled type="text" value="{{ $data1->Quality_Control_by }}"
                                            name="Quality_Control_by" id="Quality_Control_by">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control Review Completed On">Quality Control Review Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input disabled type="date"id="Quality_Control_on" name="Quality_Control_on"
                                            value="{{ $data1->Quality_Control_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Quality Assurance
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Required">Quality Assurance Review Required
                                            ?</label>
                                        <select disabled name="Quality_Assurance_Review" id="Quality_Assurance_Review">
                                            <option @if ($data1->Quality_Assurance_Review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Quality_Assurance_Review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Quality_Assurance_Review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 26, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Assurance Person">Quality Assurance Person</label>
                                        <select disabled name="QualityAssurance_person" id="QualityAssurance_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->QualityAssurance_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment3">Impact Assessment (By Quality Assurance)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny"
                                            name="QualityAssurance_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-23">{{ $data1->QualityAssurance_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Quality Assurance Feedback">Quality Assurance Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny"
                                            name="QualityAssurance_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-24">{{ $data1->QualityAssurance_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Quality Assurance Attachments">Quality Assurance Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Quality_Assurance_attachment">
                                                @if ($data1->Quality_Assurance_attachment)
                                                    @foreach (json_decode($data1->Quality_Assurance_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Quality_Assurance_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Completed By">Quality Assurance Review
                                            Completed By</label>
                                        <input disabled type="text" value="{{ $data1->QualityAssurance_by }}"
                                            name="QualityAssurance_by" id="QualityAssurance_by">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Completed On">Quality Assurance Review
                                            Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input disabled type="date"id="QualityAssurance_on"
                                            name="QualityAssurance_on" value="{{ $data1->QualityAssurance_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Engineering
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Engineering Review Required ?</label>
                                        <select disabled name="Engineering_review" id="Engineering_review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Engineering_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Engineering_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Engineering_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 25, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Engineering Person</label>
                                        <select disabled name="Engineering_person" id="Engineering_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Engineering_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment4">Impact Assessment (By Engineering)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny"
                                            name="Engineering_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-25">{{ $data1->Engineering_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Engineering Feedback">Engineering Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Engineering_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-26">{{ $data1->Engineering_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Engineering Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Engineering_attachment">
                                                @if ($data1->Engineering_attachment)
                                                    @foreach (json_decode($data1->Engineering_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Engineering_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Engineering_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Engineering Review Completed By">Engineering Review Completed
                                            By</label>
                                        <input disabled type="text" value="{{ $data1->Engineering_by }}"
                                            name="Engineering_by" id="Engineering_by">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Engineering Review Completed On">Engineering Review Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input disabled type="date" id="Engineering_on" name="Engineering_on"
                                            value="{{ $data1->Engineering_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Analytical Development Laboratory
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Required">Analytical
                                            Development Laboratory Review Required ?</label>
                                        <select disabled name="Analytical_Development_review"
                                            id="Analytical_Development_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Analytical_Development_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Analytical_Development_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Analytical_Development_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 27, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Person"> Analytical Development
                                            Laboratory Person</label>
                                        <select disabled name="Analytical_Development_person"
                                            id="Analytical_Development_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Analytical_Development_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment5">Impact Assessment (By Analytical Development
                                            Laboratory)</label>
                                        <textarea class="tiny"
                                            name="Analytical_Development_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-27">{{ $data1->Analytical_Development_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Feedback"> Analytical Development
                                            Laboratory Feedback</label>
                                        <textarea class="tiny"
                                            name="Analytical_Development_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-28">{{ $data1->Analytical_Development_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Analytical Development Laboratory
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Analytical_Development_attachment">
                                                @if ($data1->Analytical_Development_attachment)
                                                    @foreach (json_decode($data1->Analytical_Development_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Analytical_Development_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Analytical_Development_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Completed By">Analytical
                                            Development Laboratory Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Analytical_Development_by }}"
                                            name="Analytical_Development_by" id="Analytical_Development_by">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Completed On">Analytical
                                            Development Laboratory Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input disabled type="date" id="Analytical_Development_on"
                                            name="Analytical_Development_on"
                                            value="{{ $data1->Analytical_Development_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Process Development Laboratory / Kilo Lab
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Process Development Laboratory"> Process Development Laboratory / Kilo
                                            Lab Review Required ?</label>
                                        <select disabled name="Kilo_Lab_review" id="Kilo_Lab_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Kilo_Lab_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Kilo_Lab_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Kilo_Lab_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 28, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Process Development Laboratory"> Process Development Laboratory / Kilo
                                            Lab Person</label>
                                        <select disabled name="Kilo_Lab_person" id="Kilo_Lab_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Kilo_Lab_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment6">Impact Assessment (By Process Development
                                            Laboratory / Kilo Lab)</label>
                                        <textarea class="tiny" name="Kilo_Lab_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-29">{{ $data1->Kilo_Lab_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Kilo Lab Feedback"> Process Development Laboratory / Kilo Lab
                                            Feedback</label>
                                        <textarea class="tiny" name="Kilo_Lab_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-30">{{ $data1->Kilo_Lab_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Process Development Laboratory / Kilo Lab
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Kilo_Lab_attachment">
                                                @if ($data1->Kilo_Lab_attachment)
                                                    @foreach (json_decode($data1->Kilo_Lab_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Kilo_Lab_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Kilo_Lab_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Kilo Lab Review Completed By">Process Development Laboratory / Kilo
                                            Lab Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Kilo_Lab_attachment_by }}"
                                            name="Kilo_Lab_attachment_by" id="Kilo_Lab_attachment_by">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Kilo Lab Review Completed On">Process Development Laboratory / Kilo
                                            Lab Review Completed On</label>
                                        <input disabled type="date" id="Kilo_Lab_attachment_on"
                                            name="Kilo_Lab_attachment_on"
                                            value="{{ $data1->Kilo_Lab_attachment_on }}">

                                    </div>
                                </div>
                                <div class="sub-head">
                                    Technology Transfer / Design
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Design Review Required">Technology Transfer / Design Review Required
                                            ?</label>
                                        <select disabled name="Technology_transfer_review"
                                            id="Technology_transfer_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Technology_transfer_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Technology_transfer_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Technology_transfer_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 29, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Design Person"> Technology Transfer / Design Person</label>
                                        <select disabled name="Technology_transfer_person"
                                            id="Technology_transfer_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Technology_transfer_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment7">Impact Assessment (By Technology Transfer /
                                            Design)</label>
                                        <textarea class="tiny"
                                            name="Technology_transfer_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-31">{{ $data1->Technology_transfer_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Design Feedback"> Technology Transfer / Design Feedback</label>
                                        <textarea class="tiny"
                                            name="Technology_transfer_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-32">{{ $data1->Technology_transfer_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Technology Transfer / Design Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Technology_transfer_attachment">
                                                @if ($data1->Technology_transfer_attachment)
                                                    @foreach (json_decode($data1->Technology_transfer_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Technology_transfer_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Technology_transfer_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Technology Transfer / Design Review Completed
                                            By</label>
                                        <input disabled type="text" value="{{ $data1->Technology_transfer_by }}"
                                            name="Technology_transfer_by" id="Technology_transfer_by">


                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Technology Transfer / Design Review Completed
                                            On</label>
                                        <input disabled type="date" id="Technology_transfer_on"
                                            name="Technology_transfer_on"
                                            value="{{ $data1->Technology_transfer_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Environment, Health & Safety
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Safety Review Required">Environment, Health & Safety Review Required
                                            ?</label>
                                        <select disabled name="Environment_Health_review"
                                            id="Environment_Health_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Environment_Health_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Environment_Health_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Environment_Health_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 30, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Safety Person"> Environment, Health & Safety Person</label>
                                        <select disabled name="Environment_Health_Safety_person"
                                            id="Environment_Health_Safety_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Environment_Health_Safety_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment8">Impact Assessment (By Environment, Health &
                                            Safety)</label>
                                        <textarea class="tiny"
                                            name="Health_Safety_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-33">{{ $data1->Health_Safety_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Safety Feedback">Environment, Health & Safety Feedback</label>
                                        <textarea class="tiny"
                                            name="Health_Safety_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-34">{{ $data1->Health_Safety_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Environment, Health & Safety Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Environment_Health_Safety_attachment">
                                                @if ($data1->Environment_Health_Safety_attachment)
                                                    @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Environment_Health_Safety_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Safety Review Completed By">Environment, Health & Safety Review
                                            Completed By</label>
                                        <input disabled type="text"
                                            value="{{ $data1->Environment_Health_Safety_by }}"
                                            name="Environment_Health_Safety_by" id="Environment_Health_Safety_by">


                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Safety Review Completed On">Environment, Health & Safety Review
                                            Completed On</label>
                                        <input disabled type="date" id="Environment_Health_Safety_on"
                                            name="Environment_Health_Safety_on"
                                            value="{{ $data1->Environment_Health_Safety_on }}">

                                    </div>
                                </div>
                                <div class="sub-head">
                                    Human Resource & Administration
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Human Resource & Administration Review Required
                                            ?</label>
                                        <select disabled name="Human_Resource_review" id="Human_Resource_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Human_Resource_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Human_Resource_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Human_Resource_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 31, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Human Resource & Administration Person</label>
                                        <select disabled name="Human_Resource_person" id="Human_Resource_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Human_Resource_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Human Resource &
                                            Administration )</label>
                                        <textarea class="tiny"
                                            name="Human_Resource_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-35">{{ $data1->Human_Resource_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Human Resource & Administration Feedback</label>
                                        <textarea class="tiny"
                                            name="Human_Resource_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-36">{{ $data1->Human_Resource_feedback }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Human Resource & Administration Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Human_Resource_attachment">
                                                @if ($data1->Human_Resource_attachment)
                                                    @foreach (json_decode($data1->Human_Resource_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Human_Resource_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Human_Resource_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Administration Review Completed By"> Human Resource & Administration
                                            Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Human_Resource_by }}"
                                            name="Human_Resource_by" id="Human_Resource_by">


                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Administration Review Completed On"> Human Resource & Administration
                                            Review Completed On</label>
                                        <input type="date" id="Environment_Health_Safety_on"
                                            name="Environment_Health_Safety_on"
                                            value="{{ $data1->Environment_Health_Safety_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Information Technology
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Information Technology Review Required"> Information Technology Review
                                            Required ?</label>
                                        <select disabled name=" Information_Technology_review"
                                            id=" Information_Technology_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Information_Technology_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Information_Technology_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Information_Technology_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 32, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Information Technology Person"> Information Technology Person</label>
                                        <select disabled name=" Information_Technology_person"
                                            id=" Information_Technology_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Information_Technology_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment10">Impact Assessment (By Information
                                            Technology)</label>
                                        <textarea class="tiny"
                                            name="Information_Technology_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-37">{{ $data1->Information_Technology_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Information Technology Feedback">Information Technology
                                            Feedback</label>
                                        <textarea class="tiny"
                                            name="Information_Technology_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-38">{{ $data1->Information_Technology_feedback }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Information Technology Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Information_Technology_attachment">
                                                @if ($data1->Information_Technology_attachment)
                                                    @foreach (json_decode($data1->Information_Technology_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Information_Technology_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Information_Technology_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Information Technology Review Completed By"> Information Technology
                                            Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Information_Technology_by }}"
                                            name="Information_Technology_by" id="Information_Technology_by">

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Information Technology Review Completed On">Information Technology
                                            Review Completed On</label>
                                        <input disabled type="text" name="Information_Technology_on"
                                            id="Information_Technology_on"
                                            value={{ $data1->Information_Technology_on }}>
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Project Management
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Project management Review Required"> Project management Review
                                            Required ?</label>
                                        <select disabled name="Project_management_review"
                                            id="Project_management_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Project_management_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Project_management_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Project_management_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 33, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Project management Person"> Project management Person</label>
                                        <select disabled name="Project_management_person"
                                            id="Project_management_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Project_management_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment11">Impact Assessment (By Project management
                                            )</label>
                                        <textarea class="tiny"
                                            name="Project_management_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-39">{{ $data1->Project_management_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Project management Feedback"> Project management Feedback</label>
                                        <textarea class="tiny"
                                            name="Project_management_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-40">{{ $data1->Project_management_feedback }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Project management Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Project_management_attachment">
                                                @if ($data1->Project_management_attachment)
                                                    @foreach (json_decode($data1->Project_management_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Project_management_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Project_management_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Project management Review Completed By"> Project management Review
                                            Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Project_management_by }}"
                                            name="Project_management_by" id="Project_management_by">

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Project management Review Completed On">Project management Review
                                            Completed On</label>
                                        <input disabled type="date" name="Project_management_on"
                                            id="Project_management_on" value={{ $data1->Project_management_on }}>


                                    </div>
                                </div>
                            @endif
                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="sub-head">
                                    Other's 1 ( Additional Person Review From Departments If Required)
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
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Review Required1"> Other's 1 Review Required? </label>
                                        <select name="Other1_review" @if ($data->stage == 4) disabled @endif
                                            id="Other1_review" value="{{ $data1->Other1_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other1_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other1_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other1_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 other1_reviews ">
                                    <div class="group-input">
                                        <label for="Person1"> Other's 1 Person <span id="asterisko1"
                                                style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other1_person" @if ($data->stage == 4) disabled @endif
                                            id="Other1_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other1_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 other1_reviews ">

                                    <div class="group-input">
                                        <label for="Department1"> Other's 1 Department <span id="asteriskod1"
                                                style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other1_Department_person"
                                            @if ($data->stage == 4) disabled @endif
                                            id="Other1_Department_person"
                                            value="{{ $data1->Other1_Department_person }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other1_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other1_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other1_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other1_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other1_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other1_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other1_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other1_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other1_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other1_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other1_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other1_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 other1_reviews ">
                                    <div class="group-input">
                                        <label for="Impact Assessment12">Impact Assessment (By Other's 1) <span
                                                id=""
                                                style="display: {{ $data1->Other1_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Other1_review == 'yes' && $data->stage == 4) required @endif class="tiny" name="Other1_assessment"
                                            @if ($data->stage == 3 || Auth::user()->id != $data1->Other1_person) readonly @endif id="summernote-41">{{ $data1->Other1_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 other1_reviews ">
                                    <div class="group-input">
                                        <label for="Feedback1"> Other's 1 Feedback <span id=""
                                                style="display: {{ $data1->Other1_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data1->Other1_review == 'yes' && $data->stage == 4) required @endif class="tiny" name="Other1_feedback"
                                            @if ($data->stage == 3 || Auth::user()->id != $data1->Other1_person) readonly @endif id="summernote-42">{{ $data1->Other1_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Other1_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Other1_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        var facilityNameInputs = document.getElementsByClassName('Other1_Department_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asterisko1');
                                            var asteriskIcon1 = document.getElementById('asteriskod1');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            asteriskIcon1.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 other1_reviews ">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 1 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other1_attachment">
                                                @if ($data1->Other1_attachment)
                                                    @foreach (json_decode($data1->Other1_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Other1_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other1_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 other1_reviews ">
                                    <div class="group-input">
                                        <label for="Review Completed By1"> Other's 1 Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Other1_by }}"
                                            name="Other1_by" id="Other1_by">

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 other1_reviews ">
                                    <div class="group-input">
                                        <label for="Review Completed On1">Other's 1 Review Completed On</label>
                                        <input disabled type="date" name="Other1_on" id="Other1_on"
                                            value="{{ $data1->Other1_on }}">

                                    </div>
                                </div>
                                <div class="sub-head">
                                    Other's 2 ( Additional Person Review From Departments If Required)
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
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review2"> Other's 2 Review Required ?</label>
                                        <select name="Other2_review" @if ($data->stage == 4) disabled @endif
                                            id="Other2_review" value="{{ $data1->Other2_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other2_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other2_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other2_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Person2"> Other's 2 Person <span id="asterisko2"
                                                style="display: {{ $data1->Other2_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other2_person" @if ($data->stage == 4) disabled @endif
                                            id="Other2_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other2_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Department2"> Other's 2 Department <span id="asteriskod2"
                                                style="display: {{ $data1->Other2_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other2_Department_person"
                                            @if ($data->stage == 4) disabled @endif
                                            id="Other2_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other2_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other2_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other2_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other2_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other2_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other2_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other2_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other2_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other2_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other2_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other2_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other2_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>

                                        </select>

                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Other2_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Other2_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        var facilityNameInputs = document.getElementsByClassName('Other2_Department_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asterisko2');
                                            var asteriskIcon1 = document.getElementById('asteriskod2');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            asteriskIcon1.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-md-12 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment13">Impact Assessment (By Other's 2) <span
                                                id=""
                                                style="display: {{ $data1->Other2_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other2_person) readonly @endif class="tiny" name="Other2_Assessment"
                                            @if ($data1->Other2_review == 'yes' && $data->stage == 4) required @endif id="summernote-43">{{ $data1->Other2_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Feedback2"> Other's 2 Feedback <span id=""
                                                style="display: {{ $data1->Other2_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other2_person) readonly @endif class="tiny" name="Other2_feedback"
                                            @if ($data1->Other2_review == 'yes' && $data->stage == 4) required @endif id="summernote-44">{{ $data1->Other2_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 2 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other2_attachment">
                                                @if ($data1->Other2_attachment)
                                                    @foreach (json_decode($data1->Other2_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Other2_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other2_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By2"> Other's 2 Review Completed By</label>
                                        <input type="text" name="Other2_by" id="Other2_by"
                                            value="{{ $data1->Other2_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed On2">Other's 2 Review Completed On</label>
                                        <input disabled type="date" name="Other2_on" id="Other2_on"
                                            value="{{ $data1->Other2_on }}">
                                    </div>
                                </div>

                                <div class="sub-head">
                                    Other's 3 ( Additional Person Review From Departments If Required)
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
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review3"> Other's 3 Review Required ?</label>
                                        <select name="Other3_review" @if ($data->stage == 4) disabled @endif
                                            id="Other3_review" value="{{ $data1->Other3_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other3_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other3_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other3_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                        </select>

                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Person3">Other's 3 Person <span id="asterisko3"
                                                style="display: {{ $data1->Other3_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other3_person" @if ($data->stage == 4) disabled @endif
                                            id="Other3_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other3_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Department3">Other's 3 Department <span id="asteriskod3"
                                                style="display: {{ $data1->Other3_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other3_Department_person"
                                            @if ($data->stage == 4) disabled @endif
                                            id="Other3_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other3_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other3_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other3_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other3_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other3_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other3_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other3_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other3_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other3_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other3_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other3_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other3_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>
                                        </select>

                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Other3_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Other3_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        var facilityNameInputs = document.getElementsByClassName('Other3_Department_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asterisko3');
                                            var asteriskIcon1 = document.getElementById('asteriskod3');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            asteriskIcon1.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-md-12 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment14">Impact Assessment (By Other's 3) <span
                                                id=""
                                                style="display: {{ $data1->Other3_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other3_person) readonly @endif class="tiny" name="Other3_Assessment"
                                            @if ($data1->Other3_review == 'yes' && $data->stage == 4) required @endif id="summernote-45">{{ $data1->Other3_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="feedback3"> Other's 3 Feedback <span id=""
                                                style="display: {{ $data1->Other3_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other3_person) readonly @endif class="tiny" name="Other3_feedback"
                                            @if ($data1->Other3_review == 'yes' && $data->stage == 4) required @endif id="summernote-46">{{ $data1->Other3_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 3 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other3_attachment">
                                                @if ($data1->Other3_attachment)
                                                    @foreach (json_decode($data1->Other3_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Other3_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other3_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 3 Review Completed By</label>
                                        <input type="text" name="Other3_by" id="Other3_by"
                                            value="{{ $data1->Other3_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback">Other's 3 Review Completed On</label>
                                        <input disabled type="date" name="Other3_on" id="Other3_on"
                                            value="{{ $data1->Other3_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Other's 4 ( Additional Person Review From Departments If Required)
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
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review4">Other's 4 Review Required ?</label>
                                        <select name="Other4_review" @if ($data->stage == 4) disabled @endif
                                            id="Other4_review" value="{{ $data1->Other4_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other4_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other4_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other4_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Person4"> Other's 4 Person <span id="asterisko4"
                                                style="display: {{ $data1->Other4_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other4_person" @if ($data->stage == 4) disabled @endif
                                            id="Other4_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other4_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Department4"> Other's 4 Department <span id="asteriskod4"
                                                style="display: {{ $data1->Other4_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other4_Department_person"
                                            @if ($data->stage == 4) disabled @endif
                                            id="Other4_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other4_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other4_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other4_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other4_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other4_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other4_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other4_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other4_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other4_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other4_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other4_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other4_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>
                                        </select>

                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Other4_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Other4_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        var facilityNameInputs = document.getElementsByClassName('Other4_Department_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asterisko4');
                                            var asteriskIcon1 = document.getElementById('asteriskod4');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            asteriskIcon1.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-md-12 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment15">Impact Assessment (By Other's 4) <span
                                                id=""
                                                style="display: {{ $data1->Other4_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other4_person) readonly @endif class="tiny" name="Other4_Assessment"
                                            @if ($data1->Other4_review == 'yes' && $data->stage == 4) required @endif id="summernote-47">{{ $data1->Other4_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="feedback4"> Other's 4 Feedback <span id=""
                                                style="display: {{ $data1->Other4_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other4_person) readonly @endif class="tiny" name="Other4_feedback"
                                            @if ($data1->Other4_review == 'yes' && $data->stage == 4) required @endif id="summernote-48">{{ $data1->Other4_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 4 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other4_attachment">
                                                @if ($data1->Other4_attachment)
                                                    @foreach (json_decode($data1->Other4_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Other4_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other4_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By4"> Other's 4 Review Completed By</label>
                                        <input type="text" name="Other4_by" id="Other4_by"
                                            value="{{ $data1->Other4_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed On4">Other's 4 Review Completed On</label>
                                        <input disabled type="date" name="Other4_on" id="Other4_on"
                                            value="{{ $data1->Other4_on }}">

                                    </div>
                                </div>



                                <div class="sub-head">
                                    Other's 5 ( Additional Person Review From Departments If Required)
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
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review5">Other's 5 Review Required ?</label>
                                        <select name="Other5_review" @if ($data->stage == 4) disabled @endif
                                            id="Other5_review" value="{{ $data1->Other5_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other5_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other5_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other5_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Person5">Other's 5 Person <span id="asterisko5"
                                                style="display: {{ $data1->Other5_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other5_person" @if ($data->stage == 4) disabled @endif
                                            id="Other5_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other5_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Department5"> Other's 5 Department <span id="asteriskod5"
                                                style="display: {{ $data1->Other5_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other5_Department_person"
                                            @if ($data->stage == 4) disabled @endif
                                            id="Other5_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other5_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other5_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other5_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other5_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other5_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other5_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other5_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other5_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other5_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other5_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other5_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other5_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>
                                        </select>

                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Other5_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Other5_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        var facilityNameInputs = document.getElementsByClassName('Other5_Department_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asterisko5');
                                            var asteriskIcon1 = document.getElementById('asteriskod5');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            asteriskIcon1.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-md-12 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment16">Impact Assessment (By Other's 5) <span
                                                id=""
                                                style="display: {{ $data1->Other5_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other5_person) readonly @endif class="tiny"
                                            name="Other5_Assessment"@if ($data1->Other5_review == 'yes' && $data->stage == 4) required @endif id="summernote-49">{{ $data1->Other5_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 5 Feedback <span id=""
                                                style="display: {{ $data1->Other5_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other5_person) readonly @endif class="tiny"
                                            name="Other5_feedback"@if ($data1->Other5_review == 'yes' && $data->stage == 4) required @endif id="summernote-50">{{ $data1->Other5_feedback }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 5 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other5_attachment">
                                                @if ($data1->Other5_attachment)
                                                    @foreach (json_decode($data1->Other5_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Other5_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other5_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By5"> Other's 5 Review Completed By</label>
                                        <input type="text" name="Other5_by" id="Other5_by"
                                            value="{{ $data1->Other5_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed On5">Other's 5 Review Completed On</label>
                                        <input disabled type="date" name="Other5_on" id="Other5_on"
                                            value="{{ $data1->Other5_on }}">
                                    </div>
                                </div>
                            @else
                                <div class="sub-head">
                                    Other's 1 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Review Required1"> Other's 1 Review Required? </label>
                                        <select disabled
                                            name="Other1_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other1_review" value="{{ $data1->Other1_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other1_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other1_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other1_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person1"> Other's 1 Person </label>
                                        <select disabled
                                            name="Other1_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other1_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other1_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department1"> Other's 1 Department</label>
                                        <select disabled
                                            name="Other1_Department_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other1_Department_person"
                                            value="{{ $data1->Other1_Department_person }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other1_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other1_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other1_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other1_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other1_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other1_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other1_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other1_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other1_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other1_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other1_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other1_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment12">Impact Assessment (By Other's 1)</label>
                                        <textarea disabled class="tiny"
                                            name="Other1_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-41">{{ $data1->Other1_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Feedback1"> Other's 1 Feedback</label>
                                        <textarea disabled class="tiny"
                                            name="Other1_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-42">{{ $data1->Other1_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 1 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other1_attachment">
                                                @if ($data1->Other1_attachment)
                                                    @foreach (json_decode($data1->Other1_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Other1_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other1_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed By1"> Other's 1 Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Other1_by }}"
                                            name="Other1_by" id="Other1_by">

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed On1">Other's 1 Review Completed On</label>
                                        <input disabled type="date" name="Other1_on" id="Other1_on"
                                            value="{{ $data1->Other1_on }}">

                                    </div>
                                </div>

                                <div class="sub-head">
                                    Other's 2 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review2"> Other's 2 Review Required ?</label>
                                        <select disabled
                                            name="Other2_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other2_review" value="{{ $data1->Other2_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other2_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other2_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other2_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person2"> Other's 2 Person</label>
                                        <select disabled
                                            name="Other2_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other2_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other2_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department2"> Other's 2 Department</label>
                                        <select disabled
                                            name="Other2_Department_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other2_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other2_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other2_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other2_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other2_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other2_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other2_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other2_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other2_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other2_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other2_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other2_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other2_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>

                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment13">Impact Assessment (By Other's 2)</label>
                                        <textarea disabled ="summernote"
                                            name="Other2_Assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-43">{{ $data1->Other2_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Feedback2"> Other's 2 Feedback</label>
                                        <textarea disabled class="tiny"
                                            name="Other2_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-44">{{ $data1->Other2_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 2 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other2_attachment">
                                                @if ($data1->Other2_attachment)
                                                    @foreach (json_decode($data1->Other2_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Other2_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other2_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed By2"> Other's 2 Review Completed By</label>
                                        <input type="text" name="Other2_by" id="Other2_by"
                                            value="{{ $data1->Other2_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed On2">Other's 2 Review Completed On</label>
                                        <input disabled type="date" name="Other2_on" id="Other2_on"
                                            value="{{ $data1->Other2_on }}">
                                    </div>
                                </div>

                                <div class="sub-head">
                                    Other's 3 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review3"> Other's 3 Review Required ?</label>
                                        <select disabled
                                            name="Other3_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other3_review" value="{{ $data1->Other3_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other3_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other3_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other3_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                        </select>

                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person3">Other's 3 Person</label>
                                        <select disabled
                                            name="Other3_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other3_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other3_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department3">Other's 3 Department</label>
                                        <select disabled
                                            name="Other3_Department_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other3_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other3_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other3_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other3_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other3_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other3_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other3_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other3_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other3_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other3_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other3_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other3_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other3_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment14">Impact Assessment (By Other's 3)</label>
                                        <textarea disabled class="tiny"
                                            name="Other3_Assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-45">{{ $data1->Other3_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="feedback3"> Other's 3 Feedback</label>
                                        <textarea disabled class="tiny"
                                            name="Other3_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-46">{{ $data1->Other3_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 3 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other3_attachment">
                                                @if ($data1->Other3_attachment)
                                                    @foreach (json_decode($data1->Other3_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Other3_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other3_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 3 Review Completed By</label>
                                        <input type="text" name="Other3_by" id="Other3_by"
                                            value="{{ $data1->Other3_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Other's 3 Review Completed On</label>
                                        <input disabled type="date" name="Other3_on" id="Other3_on"
                                            value="{{ $data1->Other3_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Other's 4 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review4">Other's 4 Review Required ?</label>
                                        <select disabled
                                            name="Other4_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other4_review" value="{{ $data1->Other4_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other4_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other4_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other4_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person4"> Other's 4 Person</label>
                                        <select
                                            name="Other4_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other4_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other4_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department4"> Other's 4 Department</label>
                                        <select disabled
                                            name="Other4_Department_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other4_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other4_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other4_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other4_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other4_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other4_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other4_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other4_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other4_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other4_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other4_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other4_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other4_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment15">Impact Assessment (By Other's 4)</label>
                                        <textarea disabled class="tiny"
                                            name="Other4_Assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-47">{{ $data1->Other4_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="feedback4"> Other's 4 Feedback</label>
                                        <textarea disabled class="tiny"
                                            name="Other4_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-48">{{ $data1->Other4_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 4 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other4_attachment">
                                                @if ($data1->Other4_attachment)
                                                    @foreach (json_decode($data1->Other4_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Other4_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other4_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed By4"> Other's 4 Review Completed By</label>
                                        <input type="text" name="Other4_by" id="Other4_by"
                                            value="{{ $data1->Other4_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed On4">Other's 4 Review Completed On</label>
                                        <input disabled type="date" name="Other4_on" id="Other4_on"
                                            value="{{ $data1->Other4_on }}">

                                    </div>
                                </div>



                                <div class="sub-head">
                                    Other's 5 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review5">Other's 5 Review Required ?</label>
                                        <select disabled
                                            name="Other5_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other5_review" value="{{ $data1->Other5_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other5_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other5_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other5_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person5">Other's 5 Person</label>
                                        <select disabled
                                            name="Other5_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other5_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other5_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department5"> Other's 5 Department</label>
                                        <select disabled
                                            name="Other5_Department_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other5_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other5_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other5_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other5_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other5_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other5_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other5_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other5_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other5_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other5_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other5_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other5_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other5_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment16">Impact Assessment (By Other's 5)</label>
                                        <textarea disabled class="tiny"
                                            name="Other5_Assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-49">{{ $data1->Other5_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 5 Feedback</label>
                                        <textarea disabled class="tiny"
                                            name="Other5_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-50">{{ $data1->Other5_feedback }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 5 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other5_attachment">
                                                @if ($data1->Other5_attachment)
                                                    @foreach (json_decode($data1->Other5_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Other5_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other5_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed By5"> Other's 5 Review Completed By</label>
                                        <input type="text" name="Other5_by" id="Other5_by"
                                            value="{{ $data1->Other5_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed On5">Other's 5 Review Completed On</label>
                                        <input disabled type="date" name="Other5_on" id="Other5_on"
                                            value="{{ $data1->Other5_on }}">
                                    </div>
                                </div>
                            @endif








                        </div>
                        <div class="button-block">
                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }}
                                id="ChangesaveButton" class="saveButton saveAuditFormBtn d-flex"
                                style="align-items: center;">
                                <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none"
                                    role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                Save
                            </button>
                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                id="ChangeNextButton" class="nextButton">Next</button>
                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                                    @if ($data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 )
                                    <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                            class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#launch_extension">
                                            Launch Extension
                                        </a>
                                        @endif
                                        <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#effectivenss_extension">
                                            Launch Effectiveness Check
                                        </a> -->
                        </div>
                    </div>
            </div>
        </div>


        <!-- investigation -->
        <div id="CCForm9" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="row">
                    @if($investigationExtension && $investigationExtension->investigation_proposed_due_date)
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Proposed Due Date">Proposed Due Date</label>
                                <input name="investigation_proposed_due_date" id="investigation_proposed_due_date" value="{{ Helpers::getdateFormat($investigationExtension->investigation_proposed_due_date) }}" disabled>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Proposed Due Date">Proposed Due Date</label>
                                <input name="investigation_proposed_due_date" id="investigation_proposed_due_date" placeholder="Deviation Proposed Due Date"  disabled>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="Investigation Summary">Description of Event</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea class="tiny" name="Discription_Event" id="summernote-8">{{ $data->Discription_Event }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="Impact Assessment">Objective</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea class="tiny" name="objective" id="summernote-9">{{ $data->objective }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="Root Cause">Scope</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea class="tiny" name="scope" id="summernote-10">{{ $data->scope }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="Root Cause">Immediate Action</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea class="tiny" name="imidiate_action" id="summernote-10">{{ $data->imidiate_action }}</textarea>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="group-input" id="documentsRowna">
                            <label for="audit-agenda-grid">
                                Investigation team and Responsibilities
                                <button type="button" name="audit-agenda-grid" id="investigation_Details">+</button>
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

                                                    @if ($investigation_data && is_array($investigation_data->data))
                                                    @foreach ($investigation_data->data as $investigation_data)
                                                    <tr>
                                                        <td>
                                                            <input disabled type="text" name="investication[{{ $loop->index }}][serial]" value="{{ $loop->index+1 }}">
                                                        </td>
                                                        <td>
                                                            <select name="investication[{{ $loop->index }}][investioncation_team]" id="" class="investioncation_team">
                                                                <option value="">-- Select --</option>
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}" {{ $investigation_data['investioncation_team'] == $user->id ? 'selected' : '' }}>{{ $user->name }}</option> </select>
                                                                @endforeach
                                                        </td>
                                                        <td>
                                                            <input type="text" class="numberDetail" name="investication[{{ $loop->index }}][responsibility]" value="{{ $investigation_data['responsibility'] }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="Document_Remarks" name="investication[{{ $loop->index }}][remarks]" value="{{ $investigation_data['remarks'] }}">
                                                        </td>
                                                        <td><input type="text" class="Action" name=""></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <td><input disabled type="text" name="investication[0][serial]" value="1"></td>
                                                    @foreach ($users as $user)
                                                        <td> <select name="investication[0][investioncation_team]" id=""> <option value="">-- Select --</option><option value="{{ $user->id }}">{{ $user->name }}</option> </select> </td>
                                                    @endforeach
                                                    <td><input type="text" class="numberDetail" name="investication[0][responsibility]"></td>
                                                    <td><input type="text" class="Document_Remarks" name="investication[0][remarks]"></td>
                                                    <td><input type="text" class="Action" name="" readonly></td>
                                                @endif



                                                </tbody>

                                            </table>
                                        </div>
                        </div>
                        <!-- @error('Product_Batch')
                                        <div class="text-danger">{{ $message  }}</div>
                                    @enderror -->
                    </div>

                    <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="audit type">Investigation Approach </label>
                                    <select multiple name="investigation_approach[]" id="investigation_approach">
                                        <option value="Why-Why Chart" {{ strpos($data->investigation_approach, 'Why-Why Chart') !== false ? 'selected' : '' }}>Why-Why Chart</option>
                                        <option value="Failure Mode and Efect Analysis" {{ strpos($data->investigation_approach, 'Failure Mode and Efect Analysis') !== false ? 'selected' : '' }}>Failure Mode and Efect Analysis</option>
                                        <option value="Fishbone or Ishikawa Diagram" {{ strpos($data->investigation_approach, 'Fishbone or Ishikawa Diagram') !== false ? 'selected' : '' }}>Fishbone or Ishikawa Diagram</option>
                                        <option value="Is/Is Not Analysis" {{ strpos($data->investigation_approach, 'Is/Is Not Analysis') !== false ? 'selected' : '' }}>Is/Is Not Analysis</option>
                                        <option value="Brainstorming" {{ strpos($data->investigation_approach, 'Brainstorming') !== false ? 'selected' : '' }}>Brainstorming</option>
                                    </select>
                                </div>
                            </div>



                    <div class="col-lg-12">
                                <div class="group-input" id="documentsRowname" >
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
                                                    <th style="width: 12%">	Root Cause Category</th>
                                                    <th style="width: 16%">Root Cause Sub-Category</th>
                                                    <th style="width: 16%">If Others</th>

                                                    <th style="width: 16%">	Probability</th>
                                                    <th style="width: 16%">	Remarks</th>

                                                    <th style="width: 8%">Action</th>


                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if ($root_cause_data && is_array($root_cause_data->data))

                                                    <!-- {{ count($root_cause_data->data) }} -->
                                                    @foreach ($root_cause_data->data as $index => $root_cause_dat)
                                                    <tr>
                                                        <td>
                                                            <input disabled type="text" name="rootCause[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}">
                                                        </td>
                                                        <td>
                                                            <select name="rootCause[{{ $loop->index }}][Root_Cause_Category]" id="Root_Cause_Category_Select" class="Root_Cause_Category_Select">
                                                                <option value="">-- Select --</option>

                                                                <option value="M-Machine(Equipment)" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'M-Machine(Equipment)' ? 'selected' : '' }}>M-Machine(Equipment)</option>
                                                                <option value="M-Maintenance" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'M-Maintenance' ? 'selected' : '' }}>M-Maintenance</option>
                                                                <option value="M-Man Power (physical work)" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'M-Man Power (physical work)' ? 'selected' : '' }}>M-Man Power (physical work)</option>
                                                                <option value="M-Management" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == '"M-Management' ? 'selected' : '' }}>M-Management</option>
                                                                <option value="M-Material (Raw,Consumables etc.)" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'M-Material (Raw,Consumables etc.)' ? 'selected' : '' }}>M-Material (Raw,Consumables etc.)</option>
                                                                <option value="M-Method (Process/Inspection)" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'M-Method (Process/Inspection)' ? 'selected' : '' }}>M-Method (Process/Inspection)</option>
                                                                <option value="M-Mother Nature (Environment)" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'M-Mother Nature (Environment)' ? 'selected' : '' }}>M-Mother Nature (Environment)</option>
                                                                <option value="P-Place/Plant" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'P-Place/Plant' ? 'selected' : '' }}>P-Place/Plant</option>
                                                                <option value="P-Policies" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'P-Policies' ? 'selected' : '' }}>P-Policies</option>
                                                                <option value="P-Price" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'P-Price' ? 'selected' : '' }}>P-Price </option>
                                                                <option value="P-Procedures" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'P-Procedures' ? 'selected' : '' }}>P-Procedures</option>
                                                                <option value="P-Process" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'P-Process' ? 'selected' : '' }}>P-Process </option>
                                                                <option value="P-Product" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'P-Product' ? 'selected' : '' }}>P-Product</option>
                                                                <option value="S-Suppliers" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'S-Suppliers' ? 'selected' : '' }}>S-Suppliers</option>
                                                                <option value="S-Surroundings" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'S-Surroundings' ? 'selected' : '' }}>S-Surroundings</option>
                                                                <option value="S-Systems" {{ array_key_exists('Root_Cause_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Category'] == 'S-Systems' ? 'selected' : '' }}>S-Systems</option>

                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="rootCause[{{ $loop->index }}][Root_Cause_Sub_Category]" id="Root_Cause_Sub_Category_Select" class="Root_Cause_Sub_Category_Select">
                                                                <option value="">-- Select --</option>

                                                                <option value="Infrequent_Audits" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Infrequent_Audits' ? 'selected' : '' }}>Infrequent Audits </option>
                                                                <option value="No_Preventive_Maintenance {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) &&  $root_cause_dat['Root_Cause_Sub_Category'] == 'No_Preventive_Maintenance' ? 'selected' : '' }}">No Preventive Maintenance </option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Poor_Maintenance_or_Design" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Poor_Maintenance_or_Design' ? 'selected' : '' }}>Poor Maintenance or Design </option>
                                                                <option value="Maintenance Needs Improvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Maintenance Needs Improvement' ? 'selected' : '' }}>Maintenance Needs Improvement </option>
                                                                <option value="Scheduling Problem" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Scheduling Problem' ? 'selected' : '' }}>Scheduling Problem </option>
                                                                <option value="System Deficiency" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'System Deficiency' ? 'selected' : '' }}>System Deficiency </option>
                                                                <option value="Technical Error" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Technical Error' ? 'selected' : '' }}>Technical Error </option>
                                                                <option value="Tolerable Failure" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Tolerable Failure' ? 'selected' : '' }}>Tolerable Failure </option>
                                                                <option value="Calibration Issues" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Calibration Issues' ? 'selected' : '' }}>Calibration Issues </option>

                                                                <option value="Infrequent_Audits" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Infrequent_Audits' ? 'selected' : '' }}>Infrequent Audits </option>
                                                                <option value="No_Preventive_Maintenance {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) &&  $root_cause_dat['Root_Cause_Sub_Category'] == 'No_Preventive_Maintenance' ? 'selected' : '' }}">No Preventive Maintenance </option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Maintenance Needs Improvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Maintenance Needs Improvement' ? 'selected' : '' }}>Maintenance Needs Improvement </option>
                                                                <option value="Scheduling Problem" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Scheduling Problem' ? 'selected' : '' }}>Scheduling Problem </option>
                                                                <option value="System Deficiency" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'System Deficiency' ? 'selected' : '' }}>System Deficiency </option>
                                                                <option value="Technical Error" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Technical Error' ? 'selected' : '' }}>Technical Error </option>
                                                                <option value="Tolerable Failure" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Tolerable Failure' ? 'selected' : '' }}>Tolerable Failure </option>


                                                                <option value="Failure_to_Follow_SOP" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Failure_to_Follow_SOP' ? 'selected' : '' }}>Failure to Follow SOP</option>
                                                                <option value="Human_Machine_Interface" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Human_Machine_Interface' ? 'selected' : '' }}>Human-Machine Interface</option>
                                                                <option value="Misunderstood_Verbal_Communication" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Misunderstood_Verbal_Communication' ? 'selected' : '' }}>Misunderstood Verbal Communication </option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) &&$root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Personnel Error" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Personnel Error' ? 'selected' : '' }}>Personnel Error</option>
                                                                <option value="Personnel not Qualified" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Personnel not Qualified' ? 'selected' : '' }}>Personnel not Qualified</option>
                                                                <option value="Practice Needed" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Practice Needed' ? 'selected' : '' }}>Practice Needed</option>
                                                                <option value="Teamwork Needs Improvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Teamwork Needs Improvement' ? 'selected' : '' }}>Teamwork Needs Improvement</option>
                                                                <option value="Attention" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Attention' ? 'selected' : '' }}>Attention</option>
                                                                <option value="Understanding" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Understanding' ? 'selected' : '' }}>Understanding</option>
                                                                <option value="Procedural" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Procedural' ? 'selected' : '' }}>Procedural</option>
                                                                <option value="Behavioral" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Behavioral' ? 'selected' : '' }}>Behavioral</option>
                                                                <option value="Skill" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Skill' ? 'selected' : '' }}>Skill</option>

                                                                <option value="Inattention to task" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Inattention to task' ? 'selected' : '' }}>Inattention to task</option>
                                                                <option value="Lack of Process" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Lack of Process' ? 'selected' : '' }}>Lack of Process</option>
                                                                <option value="Methods" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Methods' ? 'selected' : '' }}>Methods</option>
                                                                <option value="No or poor management involvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'No or poor management involvement' ? 'selected' : '' }}>No or Poor Management Involvement</option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Personnel not Qualified"  {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Personnel not Qualified' ? 'selected' : '' }}>Personnel not Qualified</option>
                                                                <option value="Poor employee involvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Poor employee involvement' ? 'selected' : '' }}>Poor employee involvement</option>
                                                                <option value="Poor recognition of hazard" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Poor recognition of hazard' ? 'selected' : '' }}>Poor recognition of hazard</option>
                                                                <option value="Previously identified hazards were not eliminated" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Previously identified hazards were not eliminated' ? 'selected' : '' }}>Previously identified hazards were not eliminated</option>
                                                                <option value="Stress demands" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Stress demands' ? 'selected' : '' }}>Stress demands</option>
                                                                <option value="Task hazards not guarded properly" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Task hazards not guarded properly' ? 'selected' : '' }}>Task hazards not guarded properly</option>
                                                                <option value="Training or education lacking" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Training or education lacking' ? 'selected' : '' }}>Training or education lacking</option>

                                                                <option value="Defective equipment or tool" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Defective equipment or tool' ? 'selected' : '' }}>Defective equipment or tool</option>
                                                                <option value="Defective raw material" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Defective raw material' ? 'selected' : '' }}>Defective raw material</option>
                                                                <option value="Incorrect tool selection" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Incorrect tool selection' ? 'selected' : '' }}>Incorrect tool selection</option>
                                                                <option value="Lack of raw material" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Lack of raw material' ? 'selected' : '' }}>Lack of raw material</option>
                                                                <option value="Machine / Equipment" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Machine / Equipment' ? 'selected' : '' }}>Machine / Equipment</option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Poor equipment or tool placement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Poor equipment or tool placement' ? 'selected' : '' }}>Poor equipment or tool placement</option>
                                                                <option value="Poor maintenance or design" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Poor maintenance or design' ? 'selected' : '' }}>Poor maintenance or design</option>
                                                                <option value="Wrong type for job" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Wrong type for job' ? 'selected' : '' }}>Wrong type for job</option>

                                                                <option value="Instruction Needs Improvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Instruction Needs Improvement' ? 'selected' : '' }}>Instruction Needs Improvement</option>
                                                                <option value="Learning Objective Needs Improvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Learning Objective Needs Improvement' ? 'selected' : '' }}>Learning Objective Needs Improvement</option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Poor employee involvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Poor employee involvement' ? 'selected' : '' }}>Poor employee involvement</option>
                                                                <option value="Poor recognition of hazard" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Poor recognition of hazard' ? 'selected' : '' }}>Poor recognition of hazard</option>
                                                                <option value="Previously identified hazards were not eliminated" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Previously identified hazards were not eliminated' ? 'selected' : '' }}>Previously identified hazards were not eliminated</option>
                                                                <option value="Scheduling Problem" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Scheduling Problem' ? 'selected' : '' }}>Scheduling Problem</option>
                                                                <option value="Training or education lacking" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Training or education lacking' ? 'selected' : '' }}>Training or education lacking</option>
                                                                <option value="Wrong Sequence" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Wrong Sequence' ? 'selected' : '' }}>Wrong Sequence</option>

                                                                <option value="Forces of nature" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Forces of nature' ? 'selected' : '' }}>Forces of nature</option>
                                                                <option value="Job design or layout of work" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Job design or layout of work' ? 'selected' : '' }}>Job design or layout of work</option>
                                                                <option value="Orderly workplace" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Orderly workplace' ? 'selected' : '' }}>Orderly workplace</option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Physical demands of the task" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Physical demands of the task' ? 'selected' : '' }}>Physical demands of the task</option>
                                                                <option value="Surfaces poorly maintained" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Surfaces poorly maintained' ? 'selected' : '' }}>Surfaces poorly maintained</option>

                                                                <option value="Forces of nature" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Forces of nature' ? 'selected' : '' }}>Forces of nature</option>
                                                                <option value="Job design or layout of work" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Job design or layout of work' ? 'selected' : '' }}>Job design or layout of work</option>
                                                                <option value="Orderly workplace" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Orderly workplace' ? 'selected' : '' }}>Orderly workplace</option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Physical demands of the task" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Physical demands of the task' ? 'selected' : '' }}>Physical demands of the task</option>
                                                                <option value="Surfaces poorly maintained" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Surfaces poorly maintained' ? 'selected' : '' }}>Surfaces poorly maintained</option>

                                                                <option value="Instruction Needs Improvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Instruction Needs Improvement' ? 'selected' : '' }}>Instruction Needs Improvement</option>
                                                                <option value="Learning Objective Needs Improvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Learning Objective Needs Improvement' ? 'selected' : '' }}>Learning Objective Needs Improvement</option>
                                                                <option value="No Standard / Policy" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'No Standard / Policy' ? 'selected' : '' }}>No Standard / Policy</option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Wrong Revision Used" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Wrong Revision Used' ? 'selected' : '' }}>Wrong Revision Used</option>

                                                                <option value="No Budget" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'No Budget' ? 'selected' : '' }}>No Budget</option>
                                                                <option value="No Preparation" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'No Preparation' ? 'selected' : '' }}>No Preparation</option>
                                                                <option value="No Standard / Policy" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'No Standard / Policy' ? 'selected' : '' }}>No Standard / Policy</option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Wrong Estimation" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Wrong Estimation' ? 'selected' : '' }}>Wrong Estimation</option>

                                                                <option value="Learning Objective Needs Improvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Learning Objective Needs Improvement' ? 'selected' : '' }}>Learning Objective Needs Improvement</option>
                                                                <option value="Management system" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Management system' ? 'selected' : '' }}>Management system</option>
                                                                <option value="No or poor procedures" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'No or poor procedures' ? 'selected' : '' }}>No or poor procedures</option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Poor communication" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Poor communication' ? 'selected' : '' }}>Poor communication</option>
                                                                <option value="Poor employee involvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Poor employee involvement' ? 'selected' : '' }}>Poor employee involvement</option>
                                                                <option value="Practices are not the same as written procedures" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Practices are not the same as written procedures' ? 'selected' : '' }}>Practices are not the same as written procedures</option>
                                                                <option value="Previously identified hazards were not eliminated" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Previously identified hazards were not eliminated' ? 'selected' : '' }}>Previously identified hazards were not eliminated</option>
                                                                <option value="Procedure Difficult to Use" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Procedure Difficult to Use' ? 'selected' : '' }}>Procedure Difficult to Use</option>
                                                                <option value="Training or education lacking" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Training or education lacking' ? 'selected' : '' }}>Training or education lacking</option>
                                                                <option value="Wrong Revision Used" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Wrong Revision Used' ? 'selected' : '' }}>Wrong Revision Used</option>

                                                                <option value="Instruction Needs Improvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Instruction Needs Improvement' ? 'selected' : '' }}>Instruction Needs Improvement</option>
                                                                <option value="Learning Objective Needs Improvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Learning Objective Needs Improvement' ? 'selected' : '' }}>Learning Objective Needs Improvement</option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Poor employee involvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Poor employee involvement' ? 'selected' : '' }}>Poor employee involvement</option>
                                                                <option value="Poor recognition of hazard" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Poor recognition of hazard' ? 'selected' : '' }}>Poor recognition of hazard</option>
                                                                <option value="Previously identified hazards were not eliminated" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Previously identified hazards were not eliminated' ? 'selected' : '' }}>Previously identified hazards were not eliminated</option>
                                                                <option value="Scheduling Problem" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Scheduling Problem' ? 'selected' : '' }}>Scheduling Problem</option>
                                                                <option value="Training or education lacking" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Training or education lacking' ? 'selected' : '' }}>Training or education lacking</option>
                                                                <option value="Wrong Sequence" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Wrong Sequence' ? 'selected' : '' }}>Wrong Sequence</option>

                                                                <option value="Defective equipment or tool" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Defective equipment or tool' ? 'selected' : '' }}>Defective equipment or tool</option>
                                                                <option value="OtherDefective raw material" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Defective raw material' ? 'selected' : '' }}>Defective raw material</option>
                                                                <option value="Incorrect tool selection" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Incorrect tool selection' ? 'selected' : '' }}>Incorrect tool selection</option>
                                                                <option value="Lack of raw material" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Lack of raw material' ? 'selected' : '' }}>Lack of raw material</option>
                                                                <option value="Machine / Equipment" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Machine / Equipment' ? 'selected' : '' }}>Machine / Equipment</option>
                                                                <option value="Poor equipment or tool placement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Poor equipment or tool placement' ? 'selected' : '' }}>Poor equipment or tool placement</option>
                                                                <option value="Poor maintenance or design" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Poor maintenance or design' ? 'selected' : '' }}>Poor maintenance or design</option>
                                                                <option value="Wrong type for job" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Wrong type for job' ? 'selected' : '' }}>Wrong type for job</option>

                                                                <option value="Infrequent Audits" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Infrequent Audits' ? 'selected' : '' }}>Infrequent Audits</option>
                                                                <option value="Misunderstood Verbal Communication" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Misunderstood Verbal Communication' ? 'selected' : '' }}>Misunderstood Verbal Communication</option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Personnel not Qualified" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Personnel not Qualified' ? 'selected' : '' }}>Personnel not Qualified</option>
                                                                <option value="Shift Change Communication" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Shift Change Communication' ? 'selected' : '' }}>Shift Change Communication</option>
                                                                <option value="Task Not Analyzed" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Task Not Analyzed' ? 'selected' : '' }}>Task Not Analyzed</option>

                                                                <option value="Forces of nature" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Forces of nature' ? 'selected' : '' }}>Forces of nature</option>
                                                                <option value="Job design or layout of work" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Job design or layout of work' ? 'selected' : '' }}>Job design or layout of work</option>
                                                                <option value="Orderly workplace" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Orderly workplace' ? 'selected' : '' }}>Orderly workplace</option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Physical demands of the task" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Physical demands of the task' ? 'selected' : '' }}>Physical demands of the task</option>
                                                                <option value="Surfaces poorly maintained" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Surfaces poorly maintained' ? 'selected' : '' }}>Surfaces poorly maintained</option>

                                                                <option value="Infrequent Audits" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Infrequent Audits' ? 'selected' : '' }}>Infrequent Audits</option>
                                                                <option value="No Preventive Maintenance" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'No Preventive Maintenance' ? 'selected' : '' }}>No Preventive Maintenance</option>
                                                                <option value="Other" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Other' ? 'selected' : '' }}>Other</option>
                                                                <option value="Poor maintenance or design" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Poor maintenance or design' ? 'selected' : '' }}>Poor maintenance or design</option>
                                                                <option value="Maintenance Needs Improvement" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Maintenance Needs Improvement' ? 'selected' : '' }}>Maintenance Needs Improvement</option>
                                                                <option value="Scheduling Problem" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Scheduling Problem' ? 'selected' : '' }}>Scheduling Problem</option>
                                                                <option value="System Deficiency" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'System Deficiency' ? 'selected' : '' }}>System Deficiency</option>
                                                                <option value="Technical Error" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Technical Error' ? 'selected' : '' }}>Technical Error</option>
                                                                <option value="Tolerable Failure" {{ array_key_exists('Root_Cause_Sub_Category', $root_cause_dat) && $root_cause_dat['Root_Cause_Sub_Category'] == 'Tolerable Failure' ? 'selected' : '' }}>Tolerable Failure</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="Document_Remarks" name="rootCause[{{ $loop->index }}][ifother]" value="{{ array_key_exists('ifother', $root_cause_dat) ? $root_cause_dat['ifother']  : ''}}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="Document_Remarks" name="rootCause[{{ $loop->index }}][probability]" value="{{ array_key_exists('probability', $root_cause_dat) ? $root_cause_dat['probability'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="Document_Remarks" name="rootCause[{{ $loop->index }}][remarks]" value="{{ array_key_exists('remarks', $root_cause_dat) ? $root_cause_dat['remarks'] : '' }}">
                                                        </td>
                                                        <td><input type="text" class="Removebtn" name="Action[]"></td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <td><input disabled type="text" name="rootCause[0][serial]" value="1"></td>
                                                    <td><select name="rootCause[0][Root_Cause_Category]" id="Root_Cause_Category_Select" class="Root_Cause_Category_Select">
                                                        <option value="">-- Select --</option>

                                                        <option value="M-Machine(Equipment)">M-Machine(Equipment)</option>
                                                        <option value="M-Maintenance">M-Maintenance</option>
                                                        <option value="M-Man Power (physical work)">M-Man Power (physical work)</option>
                                                        <option value="M-Management">M-Management</option>
                                                        <option value="M-Material (Raw,Consumables etc.)">M-Material (Raw,Consumables etc.)</option>
                                                        <option value="M-Method (Process/Inspection)">M-Method (Process/Inspection)</option>
                                                        <option value="M-Mother Nature (Environment)">M-Mother Nature (Environment)</option>
                                                        <option value="P-Place/Plant">P-Place/Plant</option>
                                                        <option value="P-Policies">P-Policies</option>
                                                        <option value="P-Price">P-Price </option>
                                                        <option value="P-Procedures">P-Procedures</option>
                                                        <option value="P-Process">P-Process </option>
                                                        <option value="P-Product">P-Product</option>
                                                        <option value="S-Suppliers">S-Suppliers</option>
                                                        <option value="S-Surroundings">S-Surroundings</option>
                                                        <option value="S-Systems">S-Systems</option>

                                                    </select></td>
                                                    <td><select name="rootCause[0][Root_Cause_Sub_Category]" id="Root_Cause_Sub_Category_Select" class="Root_Cause_Sub_Category_Select">
                                                        <option value="">-- Select --</option>

                                                        <option value="infrequent_audits">Infrequent Audits </option>
                                                        <option value="No_Preventive_Maintenance">No Preventive Maintenance </option>
                                                        <option value="Other">Other</option>
                                                        <option value="Poor_Maintenance_or_Design">Poor Maintenance or Design </option>
                                                        <option value="Maintenance_Needs_Improvement">Maintenance Needs Improvement </option>
                                                        <option value="Scheduling_Problem">Scheduling Problem </option>
                                                        <option value="system_deficiency">System Deficiency </option>
                                                        <option value="technical_error">Technical Error </option>
                                                        <option value="tolerable_failure">Tolerable Failure </option>
                                                        <option value="calibration_issues">Calibration Issues </option>

                                                        <option value="Infrequent_Audits">Infrequent Audits</option>
                                                        <option value="No_Preventive_Maintenance">No Preventive Maintenance </option>
                                                        <option value="Other">Other</option>
                                                        <option value="Maintenance_Needs_Improvement">Maintenance Needs Improvement</option>
                                                        <option value="Scheduling_Problem ">Scheduling Problem </option>
                                                        <option value="System_Deficiency">System Deficiency </option>
                                                        <option value="Technical_Error ">Technical Error </option>
                                                        <option value="Tolerable_Failure">Tolerable Failure </option>


                                                        <option value="Failure_to_Follow_SOP">Failure to Follow SOP</option>
                                                        <option value="Human_Machine_Interface">Human-Machine Interface</option>
                                                        <option value="Misunderstood_Verbal_Communication">Misunderstood Verbal Communication </option>
                                                        <option value="Other">Other</option>
                                                        <option value="Personnel Error">Personnel Error</option>
                                                        <option value="Personnel not Qualified">Personnel not Qualified</option>
                                                        <option value="Practice Needed">Practice Needed</option>
                                                        <option value="Teamwork Needs Improvement">Teamwork Needs Improvement</option>
                                                        <option value="Attention">Attention</option>
                                                        <option value="Understanding">Understanding</option>
                                                        <option value="Procedural">Procedural</option>
                                                        <option value="Behavioral">Behavioral</option>
                                                        <option value="Skill">Skill</option>

                                                        <option value="Inattention to task">Inattention to task</option>
                                                        <option value="Lack of Process">Lack of Process</option>
                                                        <option value="Methods">Methods</option>
                                                        <option value="No or Poor Management Involvement">No or Poor Management Involvement</option>
                                                        <option value="Other">Other</option>
                                                        <option value="Personnel not Qualified">Personnel not Qualified</option>
                                                        <option value="Poor employee involvement">Poor employee involvement</option>
                                                        <option value="Poor recognition of hazard">Poor recognition of hazard</option>
                                                        <option value="Previously identified hazards were not eliminated">Previously identified hazards were not eliminated</option>
                                                        <option value="Stress demands">Stress demands</option>
                                                        <option value="Task hazards not guarded properly">Task hazards not guarded properly</option>
                                                        <option value="Personnel not Qualified">Personnel not Qualified</option>

                                                    </select></td>
                                                    <td><input type="text" class="Document_Remarks" name="rootCause[0][ifother]"></td>
                                                    <td><input type="text" class="Document_Remarks" name="rootCause[0][probability]"></td>
                                                    <td><input type="text" class="Document_Remarks" name="rootCause[0][remarks]"></td>
                                                    <td><input type="text" class="Removebtn" name="Action[]" readonly></td>

                                                @endif
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>

                            <script>
                                // $(document).ready(function () {
                                    // $('#Root_Cause_Category_Select').change(function () {
                                    $(document).on('change', '.Root_Cause_Category_Select', function () {
                                        console.log('this', $(this))
                                        console.log('change')
                                        var selectedCategory = $(this).val();
                                        var subCategorySelect = $(this).closest('td').next().find('.Root_Cause_Sub_Category_Select')
                                        console.log('subCategorySelect', subCategorySelect)

                                        // Clear existing options
                                        subCategorySelect.empty();

                                        // Populate options based on selected category
                                        if (selectedCategory === 'M-Machine(Equipment)') {
                                            subCategorySelect.append('<option value="Infrequent_Audits">Infrequent Audits</option>');
                                            subCategorySelect.append('<option value="No_Preventive_Maintenance">No Preventive Maintenance</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Poor_Maintenance_or_Design">Poor Maintenance or Design</option>');
                                            subCategorySelect.append('<option value="Maintenance Needs Improvement">Maintenance Needs Improvement</option>');
                                            subCategorySelect.append('<option value="Scheduling Problem">Scheduling Problem</option>');
                                            subCategorySelect.append('<option value="System Deficiency">System Deficiency</option>');
                                            subCategorySelect.append('<option value="Technical Error">Technical Error</option>');
                                            subCategorySelect.append('<option value="Tolerable Failure">Tolerable Failure</option>');
                                            subCategorySelect.append('<option value="Calibration Issues">Calibration Issues</option>');



                                        } else if (selectedCategory === 'M-Maintenance') {
                                            subCategorySelect.append('<option value="Infrequent_Audits">Infrequent Audits</option>');
                                            subCategorySelect.append('<option value="No_Preventive_Maintenance">No Preventive Maintenance</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Maintenance Needs Improvement">Maintenance Needs Improvement</option>');
                                            subCategorySelect.append('<option value="Scheduling Problem">Scheduling Problem</option>');
                                            subCategorySelect.append('<option value="System Deficiency">System Deficiency</option>');
                                            subCategorySelect.append('<option value="Technical Error">Technical Error</option>');
                                            subCategorySelect.append('<option value="Tolerable Failure">Tolerable Failure</option>');



                                        } else if (selectedCategory === 'M-Man Power (physical work)') {
                                            subCategorySelect.append('<option value="Failure_to_Follow_SOP">Failure to Follow SOP</option>');
                                            subCategorySelect.append('<option value="Human_Machine_Interface">Human-Machine Interface</option>');
                                            subCategorySelect.append('<option value="Misunderstood_Verbal_Communication">Misunderstood Verbal Communication</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Personnel Error">Personnel Error</option>');
                                            subCategorySelect.append('<option value="Personnel not Qualified">Personnel not Qualified</option>');
                                            subCategorySelect.append('<option value="Practice Needed">Practice Needed</option>');
                                            subCategorySelect.append('<option value="Teamwork Needs Improvement">Teamwork Needs Improvement</option>');
                                            subCategorySelect.append('<option value="Attention">Attention</option>');
                                            subCategorySelect.append('<option value="Understanding">Understanding</option>');
                                            subCategorySelect.append('<option value="Procedural ">Procedural </option>');
                                            subCategorySelect.append('<option value="Behavioral">Behavioral</option>');
                                            subCategorySelect.append('<option value="Skill">Skill</option>');

                                        }
                                        else if(selectedCategory === 'M-Management'){
                                            subCategorySelect.append('<option value="Inattention to task">Inattention to task</option>');
                                            subCategorySelect.append('<option value="Lack of Process">Lack of Process</option>');
                                            subCategorySelect.append('<option value="Methods">Methods</option>');
                                            subCategorySelect.append('<option value="No or poor management involvement">No or poor management involvement</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Personnel not Qualified">Personnel not Qualified</option>');
                                            subCategorySelect.append('<option value="Poor employee involvement">Poor employee involvement</option>');
                                            subCategorySelect.append('<option value="Poor recognition of hazard">Poor recognition of hazard</option>');
                                            subCategorySelect.append('<option value="Previously identified hazards were not eliminated">Previously identified hazards were not eliminated</option>');
                                            subCategorySelect.append('<option value="Stress demands">Stress demands</option>');
                                            subCategorySelect.append('<option value="Task hazards not guarded properly">Task hazards not guarded properly</option>');
                                            subCategorySelect.append('<option value="Training or education lacking">Training or education lacking</option>');
                                         }
                                         else if(selectedCategory === 'M-Material (Raw,Consumables etc.)'){
                                            subCategorySelect.append('<option value="Defective equipment or tool">Defective equipment or tool</option>');
                                            subCategorySelect.append('<option value="Defective raw material">Defective raw material</option>');
                                            subCategorySelect.append('<option value="Incorrect tool selection">Incorrect tool selection</option>');
                                            subCategorySelect.append('<option value="Lack of raw material">Lack of raw material</option>');
                                            subCategorySelect.append('<option value="Machine / Equipment">Machine / Equipment</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Poor equipment or tool placement">Poor equipment or tool placement</option>');
                                            subCategorySelect.append('<option value="Poor maintenance or design">Poor maintenance or design</option>');
                                            subCategorySelect.append('<option value="Wrong type for job">Wrong type for job</option>');

                                        }
                                        else if(selectedCategory === 'M-Method (Process/Inspection)'){
                                            subCategorySelect.append('<option value="Instruction Needs Improvement">Instruction Needs Improvement</option>');
                                            subCategorySelect.append('<option value="Learning Objective Needs Improvement">Learning Objective Needs Improvement</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Poor employee involvement">Poor employee involvement</option>');
                                            subCategorySelect.append('<option value="Poor recognition of hazard">Poor recognition of hazard</option>');
                                            subCategorySelect.append('<option value="Previously identified hazards were not eliminated">Previously identified hazards were not eliminated</option>');
                                            subCategorySelect.append('<option value="Scheduling Problem">Scheduling Problem</option>');
                                            subCategorySelect.append('<option value="Training or education lacking">Training or education lacking</option>');
                                            subCategorySelect.append('<option value="Wrong Sequence">Wrong Sequence</option>');
                                         }

                                        else if(selectedCategory === 'M-Mother Nature (Environment)'){
                                            subCategorySelect.append('<option value="Forces of nature">Forces of nature</option>');
                                            subCategorySelect.append('<option value="Job design or layout of work">Job design or layout of work</option>');
                                            subCategorySelect.append('<option value="Orderly workplace">Orderly workplace</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Physical demands of the task">Physical demands of the task</option>');
                                            subCategorySelect.append('<option value="Surfaces poorly maintained">Surfaces poorly maintained</option>');
                                         }
                                        else if(selectedCategory === 'P-Place/Plant'){
                                            subCategorySelect.append('<option value="Forces of nature">Forces of nature</option>');
                                            subCategorySelect.append('<option value="Job design or layout of work">Job design or layout of work</option>');
                                            subCategorySelect.append('<option value="Orderly workplace">Orderly workplace</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Physical demands of the task">Physical demands of the task</option>');
                                            subCategorySelect.append('<option value="Surfaces poorly maintained">Surfaces poorly maintained</option>');

                                        }
                                        else if(selectedCategory === 'P-Policies'){
                                            subCategorySelect.append('<option value="Instruction Needs Improvement">Instruction Needs Improvement</option>');
                                            subCategorySelect.append('<option value="Learning Objective Needs Improvement">Learning Objective Needs Improvement</option>');
                                            subCategorySelect.append('<option value="No Standard / Policy">No Standard / Policy</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Wrong Revision Used">Wrong Revision Used</option>');


                                        }
                                        else if(selectedCategory === 'P-Price'){
                                            subCategorySelect.append('<option value="No Budget">No Budget</option>');
                                            subCategorySelect.append('<option value="No Preparation">No Preparation</option>');
                                            subCategorySelect.append('<option value="No Standard / Policy">No Standard / Policy</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Wrong Estimation">Wrong Estimation</option>');


                                        }
                                        else if(selectedCategory === 'P-Procedures'){
                                            subCategorySelect.append('<option value="Learning Objective Needs Improvement">Learning Objective Needs Improvement</option>');
                                            subCategorySelect.append('<option value="Management system">Management system</option>');
                                            subCategorySelect.append('<option value="No or poor procedures">No or poor procedures</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Poor communication">Poor communication</option>');
                                            subCategorySelect.append('<option value="Poor employee involvement">Poor employee involvement</option>');
                                            subCategorySelect.append('<option value="Practices are not the same as written procedures">Practices are not the same as written procedures</option>');
                                            subCategorySelect.append('<option value="Previously identified hazards were not eliminated">Previously identified hazards were not eliminated</option>');
                                            subCategorySelect.append('<option value="Procedure Difficult to Use">Procedure Difficult to Use</option>');
                                            subCategorySelect.append('<option value="Training or education lacking">Training or education lacking</option>');
                                            subCategorySelect.append('<option value="Wrong Revision Used">Wrong Revision Used</option>');

                                        }

                                        else if(selectedCategory === 'P-Process'){
                                            subCategorySelect.append('<option value="Instruction Needs Improvement">Instruction Needs Improvement</option>');
                                            subCategorySelect.append('<option value="Learning Objective Needs Improvement">Learning Objective Needs Improvement</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Poor employee involvement">Poor employee involvement</option>');
                                            subCategorySelect.append('<option value="Poor recognition of hazard">Poor recognition of hazard</option>');
                                            subCategorySelect.append('<option value="Previously identified hazards were not eliminated">Previously identified hazards were not eliminated</option>');
                                            subCategorySelect.append('<option value="Scheduling Problem">Scheduling Problem</option>');
                                            subCategorySelect.append('<option value="Training or education lacking">Training or education lacking</option>');
                                            subCategorySelect.append('<option value="Wrong Sequence">Wrong Sequence</option>');


                                        }

                                        else if(selectedCategory === 'P-Product'){
                                            subCategorySelect.append('<option value="Defective equipment or tool">Defective equipment or tool</option>');
                                            subCategorySelect.append('<option value="Defective raw material">Defective raw material</option>');
                                            subCategorySelect.append('<option value="Incorrect tool selection">Incorrect tool selection</option>');
                                            subCategorySelect.append('<option value="Lack of raw material">Lack of raw material</option>');
                                            subCategorySelect.append('<option value="Machine / Equipment">Machine / Equipment</option>');
                                            subCategorySelect.append('<option value="Poor equipment or tool placement">Poor equipment or tool placement</option>');
                                            subCategorySelect.append('<option value="Poor maintenance or design">Poor maintenance or design</option>');
                                            subCategorySelect.append('<option value="Wrong type for job">Wrong type for job</option>');


                                        }

                                        else if(selectedCategory === 'S-Suppliers'){
                                            subCategorySelect.append('<option value="Infrequent Audits">Infrequent Audits</option>');
                                            subCategorySelect.append('<option value="Misunderstood Verbal Communication">Misunderstood Verbal Communication</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Personnel not Qualified">Personnel not Qualified</option>');
                                            subCategorySelect.append('<option value="Shift Change Communication">Shift Change Communication</option>');
                                            subCategorySelect.append('<option value="Task Not Analyzed">Task Not Analyzed</option>');
                                           }

                                        else if(selectedCategory === 'S-Surroundings'){
                                            subCategorySelect.append('<option value="Forces of nature">Forces of nature</option>');
                                            subCategorySelect.append('<option value="Job design or layout of work">Job design or layout of work</option>');
                                            subCategorySelect.append('<option value="Orderly workplace">Orderly workplace</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Physical demands of the task">Physical demands of the task</option>');
                                            subCategorySelect.append('<option value="Surfaces poorly maintained">Surfaces poorly maintained</option>');


                                        }

                                        else if(selectedCategory === 'S-Systems'){
                                            subCategorySelect.append('<option value="Infrequent Audits">Infrequent Audits</option>');
                                            subCategorySelect.append('<option value="No Preventive Maintenance">No Preventive Maintenance</option>');
                                            subCategorySelect.append('<option value="Other">Other</option>');
                                            subCategorySelect.append('<option value="Poor maintenance or design">Poor maintenance or design</option>');
                                            subCategorySelect.append('<option value="Maintenance Needs Improvement">Maintenance Needs Improvement</option>');
                                            subCategorySelect.append('<option value="Scheduling Problem">Scheduling Problem</option>');
                                            subCategorySelect.append('<option value="System Deficiency">System Deficiency</option>');
                                            subCategorySelect.append('<option value="Technical Error">Technical Error</option>');
                                            subCategorySelect.append('<option value="Tolerable Failure">Tolerable Failure</option>');

                                        }
                                    });
                                // });
                    </script>


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
                                @if($fishbone_data && is_array($fishbone_data->data))
                                    <div class="left-group">
                                        <div class="grid-field field-name">
                                            <div>Measurement</div>
                                            <div>Materials</div>
                                            <div>Methods</div>
                                        </div>
                                        <div class="top-field-group">
                                            <div class="grid-field fields top-field">

                                                @foreach ($fishbone_data->data['measurement'] as $measurement)
                                                    <div><input type="text" name="fishbone[measurement][{{ $loop->index }}]" value="{{ $measurement }}"></div>
                                                @endforeach
                                                @foreach ($fishbone_data->data['materials'] as $materials)
                                                    <div><input type="text" name="fishbone[materials][{{ $loop->index }}]" value="{{ $materials }}"></div>
                                                @endforeach
                                                @foreach ($fishbone_data->data['methods'] as $methods)
                                                    <div><input type="text" name="fishbone[methods][{{ $loop->index }}]" value="{{ $methods }}"></div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="mid"></div>
                                        <div class="bottom-field-group">
                                            <div class="grid-field fields bottom-field">
                                                @foreach ($fishbone_data->data['environment'] as $environment)
                                                    <div><input type="text" name="fishbone[environment][{{ $loop->index }}]" value="{{ $environment }}"></div>
                                                @endforeach
                                                @foreach ($fishbone_data->data['manpower'] as $manpower)
                                                    <div><input type="text" name="fishbone[manpower][{{ $loop->index }}]" value="{{ $manpower }}"></div>
                                                @endforeach
                                                @foreach ($fishbone_data->data['machine'] as $machine)
                                                    <div><input type="text" name="fishbone[machine][{{ $loop->index }}]" value="{{ $machine }}"></div>
                                                @endforeach
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
                                            <textarea name="fishbone[fishbone_problem_statement]">{{ $fishbone_data->data['fishbone_problem_statement'] }}</textarea>
                                        </div>
                                    </div>
                                @else
                                    <div class="left-group">
                                        <div class="grid-field field-name">
                                            <div>Measurement</div>
                                            <div>Materials</div>
                                            <div>Methods</div>
                                        </div>
                                        <div class="top-field-group">
                                            <div class="grid-field fields top-field">
                                                <div><input type="text" name="fishbone[measurement][0]"></div>
                                                <div><input type="text" name="fishbone[materials][0]"></div>
                                                <div><input type="text" name="fishbone[methods][0]"></div>
                                            </div>
                                        </div>
                                        <div class="mid"></div>
                                        <div class="bottom-field-group">
                                            <div class="grid-field fields bottom-field">
                                                <div><input type="text" name="fishbone[environment][0]"></div>
                                                <div><input type="text" name="fishbone[manpower][0]"></div>
                                                <div><input type="text" name="fishbone[machine][0]"></div>
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
                                            <textarea name="fishbone[fishbone_problem_statement]"></textarea>
                                        </div>
                                    </div>
                                @endif
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
                                        @if($why_data && is_array($why_data->data))
                                            <tr style="background: #f4bb22">
                                                <th style="width:150px;">Problem Statement :</th>
                                                <td>
                                                    <textarea name="why[problem_statement]">{{ $why_data->data['problem_statement'] }}</textarea>
                                                </td>
                                            </tr>
                                            <tr class="why-row">
                                                <th style="width:150px; color: #393cd4;">
                                                    Why 1 <span onclick="addWhyField('why_1_block', 'why[why_1][index]')">+</span>
                                                </th>
                                                <td>
                                                    @foreach ($why_data->data['why_1'] as $why_one)
                                                    <div class="why_1_block">
                                                        <textarea name="why[why_1][{{ $loop->index }}]">{{ $why_one }}</textarea>
                                                    </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr class="why-row">
                                                <th style="width:150px; color: #393cd4;">
                                                    Why 2 <span onclick="addWhyField('why_2_block', 'why[why_2][index]')">+</span>
                                                </th>
                                                <td>
                                                    @foreach ($why_data->data['why_2'] as $why_two)
                                                        <div class="why_2_block">
                                                            <textarea name="why[why_2][{{ $loop->index }}]">{{ $why_two }}</textarea>
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr class="why-row">
                                                <th style="width:150px; color: #393cd4;">
                                                    Why 3 <span onclick="addWhyField('why_3_block', 'why[why_3][index]')">+</span>
                                                </th>
                                                <td>
                                                    @foreach ($why_data->data['why_3'] as $why_three)
                                                        <div class="why_3_block">
                                                            <textarea name="why[why_3][{{ $loop->index }}]">{{ $why_three }}</textarea>
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr class="why-row">
                                                <th style="width:150px; color: #393cd4;">
                                                    Why 4 <span onclick="addWhyField('why_4_block', 'why[why_4][index]')">+</span>
                                                </th>
                                                <td>
                                                    @foreach ($why_data->data['why_4'] as $why_four)
                                                        <div class="why_4_block">
                                                            <textarea name="why[why_4][{{ $loop->index }}]">{{ $why_four }}</textarea>
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr class="why-row">
                                                <th style="width:150px; color: #393cd4;">
                                                    Why 5 <span onclick="addWhyField('why_5_block', 'why[why_5][index]')">+</span>
                                                </th>
                                                <td>
                                                    @foreach ($why_data->data['why_5'] as $why_five)
                                                        <div class="why_5_block">
                                                            <textarea name="why[why_5][{{ $loop->index }}]">{{ $why_five }}</textarea>
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr style="background: #0080006b;">
                                                <th style="width:150px;">Root Cause :</th>
                                                <td>
                                                    <textarea name="why[root-cause]">{{ $why_data->data['root-cause'] }}</textarea>
                                                </td>
                                            </tr>
                                        @else
                                            <tr style="background: #f4bb22">
                                                <th style="width:150px;">Problem Statement :</th>
                                                <td>
                                                    <textarea name="why[problem_statement]"></textarea>
                                                </td>
                                            </tr>
                                            <tr class="why-row">
                                                <th style="width:150px; color: #393cd4;">
                                                    Why 1 <span onclick="addWhyField('why_1_block', 'why[why_1][]')">+</span>
                                                </th>
                                                <td>
                                                    <div class="why_1_block">
                                                        <textarea name="why[why_1][0]"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="why-row">
                                                <th style="width:150px; color: #393cd4;">
                                                    Why 2 <span onclick="addWhyField('why_2_block', 'why[why_2][]')">+</span>
                                                </th>
                                                <td>
                                                    <div class="why_2_block">
                                                        <textarea name="why[why_2][0]"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="why-row">
                                                <th style="width:150px; color: #393cd4;">
                                                    Why 3 <span onclick="addWhyField('why_3_block', 'why[why_3][]')">+</span>
                                                </th>
                                                <td>
                                                    <div class="why_3_block">
                                                        <textarea name="why[why_3][0]"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="why-row">
                                                <th style="width:150px; color: #393cd4;">
                                                    Why 4 <span onclick="addWhyField('why_4_block', 'why[why_4][]')">+</span>
                                                </th>
                                                <td>
                                                    <div class="why_4_block">
                                                        <textarea name="why[why_4][0]"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="why-row">
                                                <th style="width:150px; color: #393cd4;">
                                                    Why 5 <span onclick="addWhyField('why_5_block', 'why[why_5][]')">+</span>
                                                </th>
                                                <td>
                                                    <div class="why_5_block">
                                                        <textarea name="why[why_5][0]"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr style="background: #0080006b;">
                                                <th style="width:150px;">Root Cause :</th>
                                                <td>
                                                    <textarea name="why[root-cause]"></textarea>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="sub-head"></div>
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
                                                    1
                                                </td>
                                                <th style="background: ">Attention</th>
                                                <td style="background: rgb(222 220 220 / 58%)">
                                                    <textarea name="attention_issues">{{ $data->attention_issues}}</textarea>
                                                </td>
                                                <td>
                                                    <textarea name="attention_actions">{{ $data->attention_actions}}</textarea>
                                                </td>
                                                <td style="background: rgb(222 220 220 / 58%)">
                                                    <textarea name="attention_remarks">{{ $data->attention_remarks}}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="background: rgb(222 220 220 / 58%)">
                                                   2
                                                </td>
                                                <th >Understanding</th>
                                                <td style="background: rgb(222 220 220 / 58%)">
                                                    <textarea name="understanding_issues">{{ $data->understanding_issues}}</textarea>
                                                </td>
                                                <td>
                                                    <textarea name="understanding_actions">{{ $data->understanding_actions}}</textarea>
                                                </td>
                                                <td style="background: rgb(222 220 220 / 58%)">
                                                    <textarea name="understanding_remarks">{{ $data->understanding_remarks}}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="background: rgb(222 220 220 / 58%)">
                                                    3
                                                </td>
                                                <th >Procedural</th>
                                                <td style="background: rgb(222 220 220 / 58%)">
                                                    <textarea name="procedural_issues">{{ $data->procedural_issues}}</textarea>
                                                </td>
                                                <td>
                                                    <textarea name="procedural_actions">{{ $data->procedural_actions}}</textarea>
                                                </td>
                                                <td style="background: rgb(222 220 220 / 58%)">
                                                    <textarea name="procedural_remarks">{{ $data->procedural_remarks}}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="background: rgb(222 220 220 / 58%)">
                                               4
                                                </td>
                                                <th >Behavioral</th>
                                                <td style="background: rgb(222 220 220 / 58%)">
                                                    <textarea name="behavioiral_issues">{{ $data->behavioiral_issues}}</textarea>
                                                </td>
                                                <td>
                                                    <textarea name="behavioiral_actions">{{ $data->behavioiral_actions}}</textarea>
                                                </td>
                                                <td style="background: rgb(222 220 220 / 58%)">
                                                    <textarea name="behavioiral_remarks">{{ $data->behavioiral_remarks}}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="background: rgb(222 220 220 / 58%)">
                                                   5
                                                </td>
                                                <th >Skill</th>
                                                <td style="background: rgb(222 220 220 / 58%)">
                                                    <textarea name="skill_issues">{{ $data->skill_issues}}</textarea>
                                                </td>
                                                <td>
                                                    <textarea name="skill_actions">{{ $data->skill_actions}}</textarea>
                                                </td>
                                                <td style="background: rgb(222 220 220 / 58%)">
                                                    <textarea name="skill_remarks">{{ $data->skill_remarks}}</textarea>
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
                                                <textarea name="what_will_be">{{ $data->what_will_be }}</textarea>
                                            </td>
                                            <td>
                                                <textarea name="what_will_not_be">{{ $data->what_will_not_be }}</textarea>
                                            </td>
                                            <td>
                                                <textarea name="what_rationable">{{ $data->what_rationable }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background: rgb(222 220 220 / 58%)">Where</th>
                                            <td>
                                                <textarea name="where_will_be">{{ $data->where_will_be }}</textarea>
                                            </td>
                                            <td>
                                                <textarea name="where_will_not_be">{{ $data->where_will_not_be }}</textarea>
                                            </td>
                                            <td>
                                                <textarea name="where_rationable">{{ $data->where_rationable }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background: rgb(222 220 220 / 58%)">When</th>
                                            <td>
                                                <textarea name="when_will_be">{{ $data->when_will_be }}</textarea>
                                            </td>
                                            <td>
                                                <textarea name="when_will_not_be">{{ $data->when_will_not_be }}</textarea>
                                            </td>
                                            <td>
                                                <textarea name="when_rationable">{{ $data->when_rationable }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background:rgb(222 220 220 / 58%)">Coverage</th>
                                            <td>
                                                <textarea name="coverage_will_be">{{ $data->coverage_will_be }}</textarea>
                                            </td>
                                            <td>
                                                <textarea name="coverage_will_not_be">{{ $data->coverage_will_not_be }}</textarea>
                                            </td>
                                            <td>
                                                <textarea name="coverage_rationable">{{ $data->coverage_rationable }}</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="background:rgb(222 220 220 / 58%)">Who</th>
                                            <td>
                                                <textarea name="who_will_be">{{ $data->who_will_be }}</textarea>
                                            </td>
                                            <td>
                                                <textarea name="who_will_not_be">{{ $data->who_will_not_be }}</textarea>
                                            </td>
                                            <td>
                                                <textarea name="who_rationable">{{ $data->who_rationable }}</textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="button-block">
                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"  type="submit" class="saveButton" {{ $data->stage == 9 ? 'disabled' : '' }}>Save</button>
                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button" class="nextButton" onclick="nextStep()">Next</button>
                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                            Exit </a> </button>
                            @if ($data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 )
                            <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                            class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#launch_extension">
                                            Launch Extension
                                        </a>
                                        @endif
                                        <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#effectivenss_extension">
                                            Launch Effectiveness Check
                                        </a> -->
                </div>
            </div>
        </div>

        <div id="CCForm11" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="row">
                    <div class="col-12 sub-head"></div>
                    @if($qrmExtension && $qrmExtension->qrm_proposed_due_date)
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Proposed Due Date">Proposed Due Date</label>
                                <input name="qrm_proposed_due_date" id="qrm_proposed_due_date" value="{{ Helpers::getdateFormat($qrmExtension->qrm_proposed_due_date) }}" disabled>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Proposed Due Date">Proposed Due Date</label>
                                <input name="qrm_proposed_due_date" id="qrm_proposed_due_date" disabled>
                            </div>
                        </div>
                    @endif

                    <div class="col-12 mb-4">
                        <div class="group-input">
                            <label for="agenda">
                                Failure Mode and Effect Analysis
                                <button type="button" name="agenda"
                                   id="risk-assessment-risk-management">+</button>
                                <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#failure_mode_and_effect_analysis" style="font-size: 0.8rem; font-weight: 400;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" style="width: 200%"
                                    id="risk-assessment-risk-management_details">
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

    @if ($grid_data_qrms && is_array($grid_data_qrms->data))
        @foreach ($grid_data_qrms->data as $grid_data_qrms)
            <tr>

                <td><input disabled type="text"name="serial[]"
                        {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} value="{{ $key + 1 }}"></td>
                <td>
                    <input type="text" class="numberDetail" name="failure_mode_qrms[{{ $loop->index }}][risk_factor]"
                        value="{{ isset($grid_data_qrms['risk_factor']) ? $grid_data_qrms['risk_factor'] : '' }}">
                </td>
                <td>
                    <input type="text" class="numberDetail" name="failure_mode_qrms[{{ $loop->index }}][risk_element]"
                        value="{{ isset($grid_data_qrms['risk_element']) ? $grid_data_qrms['risk_element'] : '' }}">
                </td>
                <td>
                    <input type="text" class="numberDetail"
                        name="failure_mode_qrms[{{ $loop->index }}][probale_of_risk_element]"
                        value="{{ isset($grid_data_qrms['probale_of_risk_element']) ? $grid_data_qrms['probale_of_risk_element'] : '' }}">
                </td>
                <td>
                    <input type="text" class="numberDetail"
                        name="failure_mode_qrms[{{ $loop->index }}][existing_risk_control]"
                        value="{{ isset($grid_data_qrms['existing_risk_control']) ? $grid_data_qrms['existing_risk_control'] : '' }}">
                </td>
                <td>
                    <select name="failure_mode_qrms[{{ $loop->index }}][initial_severity]" id="">
                        <option value="">-- Select --</option>
                        <option value="1"
                            {{ isset($grid_data_qrms['initial_severity']) && $grid_data_qrms['initial_severity'] == '1' ? 'selected' : '' }}>
                            1</option>
                        <option value="2"
                            {{ isset($grid_data_qrms['initial_severity']) && $grid_data_qrms['initial_severity'] == '2' ? 'selected' : '' }}>
                            2</option>
                        <option value="3"
                            {{ isset($grid_data_qrms['initial_severity']) && $grid_data_qrms['initial_severity'] == '3' ? 'selected' : '' }}>
                            3</option>
                    </select>
                </td>
                <td>
                    <select name="failure_mode_qrms[{{ $loop->index }}][initial_probability]" id="">
                        <option value="">-- Select --</option>
                        <option value="1"
                            {{ isset($grid_data_qrms['initial_probability']) && $grid_data_qrms['initial_probability'] == '1' ? 'selected' : '' }}>
                            1</option>
                        <option value="2"
                            {{ isset($grid_data_qrms['initial_probability']) && $grid_data_qrms['initial_probability'] == '2' ? 'selected' : '' }}>
                            2</option>
                        <option value="3"
                            {{ isset($grid_data_qrms['initial_probability']) && $grid_data_qrms['initial_probability'] == '3' ? 'selected' : '' }}>
                            3</option>
                    </select>
                </td>

                <td>
                    <select name="failure_mode_qrms[{{ $loop->index }}][initial_detectability]" id="">
                        <option value="">-- Select --</option>
                        <option value="1"
                            {{ isset($grid_data_qrms['initial_detectability']) && $grid_data_qrms['initial_detectability'] == '1' ? 'selected' : '' }}>
                            1</option>
                        <option value="2"
                            {{ isset($grid_data_qrms['initial_detectability']) && $grid_data_qrms['initial_detectability'] == '2' ? 'selected' : '' }}>
                            2</option>
                        <option value="3"
                            {{ isset($grid_data_qrms['initial_detectability']) && $grid_data_qrms['initial_detectability'] == '3' ? 'selected' : '' }}>
                            3</option>
                    </select>
                </td>
                <td>
                    <input type="text" class="numberDetail"
                        name="failure_mode_qrms[{{ $loop->index }}][initial_rpn]"
                        value="{{ isset($grid_data_qrms['initial_rpn']) ? $grid_data_qrms['initial_rpn'] : '' }}">
                </td>

                <td>
                    <select name="failure_mode_qrms[{{ $loop->index }}][risk_acceptance]" id="">
                        <option value="">-- Select --</option>
                        <option value="n"
                            {{ isset($grid_data_qrms['risk_acceptance']) && $grid_data_qrms['risk_acceptance'] == 'n' ? 'selected' : '' }}>
                            N</option>
                        <option value="y"
                            {{ isset($grid_data_qrms['risk_acceptance']) && $grid_data_qrms['risk_acceptance'] == 'y' ? 'selected' : '' }}>
                            Y</option>
                </td>

                <td>
                    <input type="text" class="numberDetail"
                        name="failure_mode_qrms[{{ $loop->index }}][proposed_additional_risk_control]"
                        value="{{ isset($grid_data_qrms['proposed_additional_risk_control']) ? $grid_data_qrms['proposed_additional_risk_control'] : '' }}">
                </td>

                <td>
                    <select name="failure_mode_qrms[{{ $loop->index }}][residual_severity]" id="">
                        <option value="">-- Select --</option>
                        <option value="1"
                            {{ isset($grid_data_qrms['residual_severity']) && $grid_data_qrms['residual_severity'] == '1' ? 'selected' : '' }}>
                            1</option>
                        <option value="2"
                            {{ isset($grid_data_qrms['residual_severity']) && $grid_data_qrms['residual_severity'] == '2' ? 'selected' : '' }}>
                            2</option>
                        <option value="3"
                            {{ isset($grid_data_qrms['residual_severity']) && $grid_data_qrms['residual_severity'] == '3' ? 'selected' : '' }}>
                            3</option>
                    </select>
                </td>

                <td>
                    <select name="failure_mode_qrms[{{ $loop->index }}][residual_probability]" id="">
                        <option value="">-- Select --</option>
                        <option value="1"
                            {{ isset($grid_data_qrms['residual_probability']) && $grid_data_qrms['residual_probability'] == '1' ? 'selected' : '' }}>
                            1</option>
                        <option value="2"
                            {{ isset($grid_data_qrms['residual_probability']) && $grid_data_qrms['residual_probability'] == '2' ? 'selected' : '' }}>
                            2</option>
                        <option value="3"
                            {{ isset($grid_data_qrms['residual_probability']) && $grid_data_qrms['residual_probability'] == '3' ? 'selected' : '' }}>
                            3</option>
                    </select>
                </td>

                <td>
                    <select name="failure_mode_qrms[{{ $loop->index }}][residual_detectability]" id="">
                        <option value="">-- Select --</option>
                        <option value="1"
                            {{ isset($grid_data_qrms['residual_detectability']) && $grid_data_qrms['residual_detectability'] == '1' ? 'selected' : '' }}>
                            1</option>
                        <option value="2"
                            {{ isset($grid_data_qrms['residual_detectability']) && $grid_data_qrms['residual_detectability'] == '2' ? 'selected' : '' }}>
                            2</option>
                        <option value="3"
                            {{ isset($grid_data_qrms['residual_detectability']) && $grid_data_qrms['residual_detectability'] == '3' ? 'selected' : '' }}>
                            3</option>
                    </select>
                </td>

                <td>
                    <input type="text" class="numberDetail"
                        name="failure_mode_qrms[{{ $loop->index }}][residual_rpn]"
                        value="{{ isset($grid_data_qrms['residual_rpn']) ? $grid_data_qrms['residual_rpn'] : '' }}">
                </td>

                <td>
                    <select name="failure_mode_qrms[{{ $loop->index }}][risk_acceptance]" id="">
                        <option value="">-- Select --</option>
                        <option value="n"
                            {{ isset($grid_data_qrms['risk_acceptance']) && $grid_data_qrms['risk_acceptance'] == 'n' ? 'selected' : '' }}>
                            N</option>
                        <option value="y"
                            {{ isset($grid_data_qrms['risk_acceptance']) && $grid_data_qrms['risk_acceptance'] == 'y' ? 'selected' : '' }}>
                            Y</option>
                </td>

                <td>
                    <input type="text" class="numberDetail"
                        name="failure_mode_qrms[{{ $loop->index }}][mitigation_proposal]"
                        value="{{ isset($grid_data_qrms['mitigation_proposal']) ? $grid_data_qrms['mitigation_proposal'] : '' }}">
                </td>

                <td><input type="text" class="Action" name=""></td>
            </tr>
        @endforeach
    @else
        <!-- <td><input disabled type="text" name="failure_mode_qrms[0][serial]" value=""></td> -->
        <td><input disabled type="text"name="serial[]"
                {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} value="{{ $key + 1 }}"></td>
        <td><input type="text" class="numberDetail" name="failure_mode_qrms[0][risk_factor]"></td>
        <td><input type="text" class="Document_Remarks" name="failure_mode_qrms[0][risk_element]"></td>
        <td><input type="text" class="Document_Remarks" name="failure_mode_qrms[0][probale_of_risk_element]"></td>
        <td><input type="text" class="Document_Remarks" name="failure_mode_qrms[0][existing_risk_control]"></td>
        <td>
            <select name="failure_mode_qrms[0][initial_severity]" id="">
                <option value="">-- Select --</option>
                <option value="1" ($grid_data_qrms && isset($grid_data_qrms['initial_severity']=='1' ? 'selected'
                    : '' ))>1</option>
                <option value="2" ($grid_data_qrms && isset($grid_data_qrms['initial_severity']=='2' ? 'selected'
                    : '' ))>2</option>
                <option value="3" ($grid_data_qrms && isset($grid_data_qrms['initial_severity']=='3' ? 'selected'
                    : '' ))>3</option>
            </select>
        </td>
        <td>
            <select name="failure_mode_qrms[0][initial_probability]" id="">
                <option value="">-- Select --</option>
                <option value="1" ($grid_data_qrms && isset($grid_data_qrms['initial_probability']=='1'
                    ? 'selected' : '' ))>1</option>
                <option value="2" ($grid_data_qrms && isset($grid_data_qrms['initial_probability']=='2'
                    ? 'selected' : '' ))>2</option>
                <option value="3" ($grid_data_qrms && isset($grid_data_qrms['initial_probability']=='3'
                    ? 'selected' : '' ))>3</option>
            </select>
        </td>
        <td>
            <select name="failure_mode_qrms[0][initial_detectability]" id="">
                <option value="">-- Select --</option>
                <option value="1" ($grid_data_qrms && isset($grid_data_qrms['initial_detectability']=='1'
                    ? 'selected' : '' ))>1</option>
                <option value="2" ($grid_data_qrms && isset($grid_data_qrms['initial_detectability']=='2'
                    ? 'selected' : '' ))>2</option>
                <option value="3" ($grid_data_qrms && isset($grid_data_qrms['initial_detectability']=='3'
                    ? 'selected' : '' ))>3</option>
            </select>
        </td>
        <td><input type="text" class="Document_Remarks" name="failure_mode_qrms[0][initial_rpn]"></td>

        <td>
            <select name="failure_mode_qrms[0][risk_acceptance]" id="">
                <option value="">-- Select --</option>
                <option value="n" ($grid_data_qrms && isset($grid_data_qrms['risk_acceptance']=='n' ? 'selected'
                    : '' ))>N</option>
                <option value="y" ($grid_data_qrms && isset($grid_data_qrms['risk_acceptance']=='y' ? 'selected'
                    : '' ))>Y</option>
            </select>
        </td>

        <td><input type="text" class="Document_Remarks"
                name="failure_mode_qrms[0][proposed_additional_risk_control]"></td>

        <td>
            <select name="failure_mode_qrms[0][residual_severity]" id="">
                <option value="">-- Select --</option>
                <option value="1" ($grid_data_qrms && isset($grid_data_qrms['residual_severity']=='1' ? 'selected'
                    : '' ))>1</option>
                <option value="2" ($grid_data_qrms && isset($grid_data_qrms['residual_severity']=='2' ? 'selected'
                    : '' ))>2</option>
                <option value="3" ($grid_data_qrms && isset($grid_data_qrms['residual_severity']=='3' ? 'selected'
                    : '' ))>3</option>
            </select>
        </td>

        <td>
            <select name="failure_mode_qrms[0][residual_probability]" id="">
                <option value="">-- Select --</option>
                <option value="1" ($grid_data_qrms && isset($grid_data_qrms['residual_probability']=='1'
                    ? 'selected' : '' ))>1</option>
                <option value="2" ($grid_data_qrms && isset($grid_data_qrms['residual_probability']=='2'
                    ? 'selected' : '' ))>2</option>
                <option value="3" ($grid_data_qrms && isset($grid_data_qrms['residual_probability']=='3'
                    ? 'selected' : '' ))>3</option>
            </select>
        </td>

        <td>
            <select name="failure_mode_qrms[0][residual_detectability]" id="">
                <option value="">-- Select --</option>
                <option value="1" ($grid_data_qrms && isset($grid_data_qrms['residual_detectability']=='1'
                    ? 'selected' : '' ))>1</option>
                <option value="2" ($grid_data_qrms && isset($grid_data_qrms['residual_detectability']=='2'
                    ? 'selected' : '' ))>2</option>
                <option value="3" ($grid_data_qrms && isset($grid_data_qrms['residual_detectability']=='3'
                    ? 'selected' : '' ))>3</option>
            </select>
        </td>

        <td><input type="text" class="Document_Remarks" name="failure_mode_qrms[0][residual_rpn]"></td>

        <td>
            <select name="failure_mode_qrms[0][risk_acceptance]" id="">
                <option value="">-- Select --</option>
                <option value="n" ($grid_data_qrms && isset($grid_data_qrms['risk_acceptance']=='n' ? 'selected'
                    : '' ))>N</option>
                <option value="y" ($grid_data_qrms && isset($grid_data_qrms['risk_acceptance']=='y' ? 'selected'
                    : '' ))>Y</option>
            </select>
        </td>

        <td><input type="text" class="Document_Remarks" name="failure_mode_qrms[0][mitigation_proposal]"></td>

        <td><input type="text" class="Action" name=""></td>
    @endif

</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="Investigation Summary">Conclusion</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea class="tiny" name="Conclusion" id="summernote-8" value="{{$data->Conclusion}}">{{$data->Conclusion}}
                </textarea>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="Investigation Summary">Identified Risk</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea class="tiny" name="Identified_Risk" value="{{$data->Identified_Risk}}" id="summernote-8">{{$data->Identified_Risk}}
                </textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Severity Rate">Severity Rate</label>
                            <select name="severity_rate" id="analysisR" onchange='calculateRiskAnalysis(this)'>
                                <option value="">Enter Your Selection Here</option>
                                <option value="negligible" @if ($data->severity_rate == 'negligible') selected @endif>Negligible</option>
                                <option value="moderate"  @if ($data->severity_rate == 'moderate') selected @endif>Moderate</option>
                                <option value="major" @if ($data->severity_rate == 'major') selected @endif>Major</option>
                                <option value="fatal"  @if ($data->severity_rate == 'fatal') selected @endif>Fatal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Occurrence">Occurrence</label>
                            <select name="Occurrence" id="analysisP" onchange='calculateRiskAnalysis(this)'>
                                <option value="">Enter Your Selection Here</option>
                                <option value="extremely_unilikely" @if ($data->Occurrence == 'extremely_unilikely') selected @endif>Extremely Unlikely</option>
                                <option value="rare" @if ($data->Occurrence == 'rare') selected @endif>Rare</option>
                                <option value="unlikely" @if ($data->Occurrence == 'unlikely') selected @endif>Unlikely</option>
                                <option value="likely" @if ($data->Occurrence == 'likely') selected @endif>Likely</option>
                                <option value="very_likely" @if ($data->Occurrence == 'very_likely') selected @endif>Very Likely</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Detection">Detection</label>
                            <select name="detection" id="analysisN" onchange='calculateRiskAnalysis(this)'>
                                <option value="">Enter Your Selection Here</option>
                                <option value="impossible" @if ($data->detection == 'impossible') selected @endif>Impossible</option>
                                <option value="rare" @if ($data->detection== 'rare') selected @endif>Rare</option>
                                <option value="unlikely" @if ($data->detection == 'unlikely') selected @endif>Unlikely</option>
                                <option value="likely"  @if ($data->detection == 'likely') selected @endif>Likely</option>
                                <option value="very_likely" @if ($data->detection == 'very_likely') selected @endif>Very Likely</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="RPN">RPN</label>
                            <div><small class="text-primary">Auto - Calculated</small></div>
                            <input type="text" name="rpn" id="analysisRPN" value="" readonly>
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

    @if ($grid_data_matrix_qrms && is_array($grid_data_matrix_qrms->data))
        @foreach ($grid_data_matrix_qrms->data as $grid_data_matrix_qrms)
            <tr>

                <!-- <td> <input disabled type="text" name="matrix_qrms[{{ $loop->index }}][serial]" value="1">  </td> -->
                <td><input disabled type="text"name="serial[]"
                        {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} value="{{ $key + 1 }}">
                </td>

                <td>
                    <input type="text" class="numberDetail"
                        name="matrix_qrms[{{ $loop->index }}][risk_Assesment]"
                        value="{{ isset($grid_data_matrix_qrms['risk_Assesment']) ? $grid_data_matrix_qrms['risk_Assesment'] : '' }}">
                </td>
                <td>
                    <input type="text" class="numberDetail"
                        name="matrix_qrms[{{ $loop->index }}][review_schedule]"
                        value="{{ isset($grid_data_matrix_qrms['review_schedule']) ? $grid_data_matrix_qrms['review_schedule'] : '' }}">
                </td>
                <td>
                    <input type="text" class="numberDetail"
                        name="matrix_qrms[{{ $loop->index }}][actual_reviewed]"
                        value="{{ isset($grid_data_matrix_qrms['actual_reviewed']) ? $grid_data_matrix_qrms['actual_reviewed'] : '' }}">
                </td>
                <td>
                    <input type="text" class="numberDetail" name="matrix_qrms[{{ $loop->index }}][recorded_by]"
                        value="{{ isset($grid_data_matrix_qrms['recorded_by']) ? $grid_data_matrix_qrms['recorded_by'] : '' }}">
                </td>
                <td>
                    <input type="text" class="numberDetail" name="matrix_qrms[{{ $loop->index }}][remark]"
                        value="{{ isset($grid_data_matrix_qrms['remark']) ? $grid_data_matrix_qrms['remark'] : '' }}">
                </td>

                <td><input type="text" class="Action" name=""></td>
            </tr>
        @endforeach
    @else
        <td><input disabled type="text"name="serial[]"
                {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} value="{{ $key + 1 }}"></td>
        <!-- <td><input disabled type="text" name="matrix_qrms[0][serial]" value=""></td> -->

        <td><input type="text" class="numberDetail" name="matrix_qrms[0][risk_Assesment]"></td>
        <td><input type="text" class="Document_Remarks" name="matrix_qrms[0][review_schedule]"></td>
        <td><input type="text" class="Document_Remarks" name="matrix_qrms[0][actual_reviewed]"></td>
        <td><input type="text" class="Document_Remarks" name="matrix_qrms[0][recorded_by]"></td>
        <td><input type="text" class="Document_Remarks" name="matrix_qrms[0][remark]"></td>

        <td><input type="text" class="Action" name="" disabled></td>
    @endif



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
                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="submit" class="saveButton" {{ $data->stage == 9 ? 'disabled' : '' }}>Save</button>
                    <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                        <button type="button" class="backButton">Back</button>
                    </a>
                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button" class="nextButton" onclick="nextStep()">Next</button>
                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                            Exit </a> </button>
                            @if ($data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 )
                            <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                            class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#launch_extension">
                                            Launch Extension
                                        </a>
                                        @endif
                                        <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#effectivenss_extension">
                                            Launch Effectiveness Check
                                        </a> -->
                </div>
            </div>
        </div>


        <!-- capa update -->
    <div id="CCForm10" class="inner-block cctabcontent">
        <div class="inner-block-content">
            <div class="row">
                @if($capaExtension && $capaExtension->capa_proposed_due_date)
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="capa_proposed_due_date"><b>Proposed Due Date</b></label>
                            <input disabled type="text" name="capa_proposed_due_date" id="capa_proposed_due_date" value="{{ Helpers::getdateFormat($capaExtension->capa_proposed_due_date) }}">
                        </div>
                    </div>
                @else
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="capa_proposed_due_date"><b>Proposed Due Date</b></label>
                            <input disabled type="text" name="capa_proposed_due_date" id="capa_proposed_due_date" >
                        </div>
                    </div>
                @endif
                    <!-- <div class="col-lg-6">
                        <div class="group-input">
                            <label for="CAPA_Number"><b>CAPA No</b></label>
                            <input disabled type="text" name="capa_number">
                        </div>
                    </div> -->
                <!-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department1"> Other's 1 Department <span id="asteriskod1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                        <select name="Other1_Department_person"
                                         @if ($data->stage==4) disabled @endif id="Other1_Department_person" value="{{ $data1->Other1_Department_person }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other1_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option  @if ($data1->Other1_Department_person == 'Warehouse') selected @endif
                                               value="Warehouse"> Warehouse</option>
                                            <option  @if ($data1->Other1_Department_person == 'Project management') selected @endif
                                                            value="Project management">Project management</option>

                                        </select>

                                    </div>
                                </div> -->
                <div class="col-lg-12">
                    <div class="group-input">
                        <label for="Initiator Group"><b>Name of the Department</b><span
                            class="text-danger">*</span></label>
                        <select name="department_capa" id="department_capa"
                        @if ($data->stage==4) disabled @endif id="department_capa" value="{{ $data->department_capa }}">
                            <option value="0">-- Select --</option>
                            <option @if ($data->department_capa == 'CQA') selected @endif
                                                value="CQA">Corporate Quality Assurance</option>
                            <option @if ($data->department_capa == 'QAB') selected @endif
                                                value="QAB">Quality
                                Assurance Biopharma</option>
                            <option @if ($data->department_capa == 'CQC') selected @endif
                                                value="QAB">Central Quality Control</option>
                                <option @if ($data->department_capa == 'CQC') selected @endif
                                                value="QAB">Central Quality Control</option>
                                <option @if ($data->department_capa == 'MANU') selected @endif
                                                value="MANU">Manufacturing</option>
                                <option @if ($data->department_capa == 'PSG') selected @endif
                                                value="PSG">Plasma
                                Sourcing Group</option>
                                <option @if ($data->department_capa == 'CS') selected @endif
                                        value="CS">Central Stores</option>
                                <option @if ($data->department_capa == 'ITG') selected @endif
                                        value="ITG">Information Technology Group </option>
                                <option @if ($data->department_capa == 'MM') selected @endif
                                        value="MM">Molecular Medicine </option>
                                <option @if ($data->department_capa == 'CL') selected @endif
                                        value="CL">Central Laboratory </option>
                                <option @if ($data->department_capa == 'QA') selected @endif
                                        value="QA">Quality Assurance </option>
                                <option @if ($data->department_capa == 'TT') selected @endif
                                        value="TT">Tech team </option>
                                <option @if ($data->department_capa == 'QM') selected @endif
                                        value="QM">Quality Management </option>
                                <option @if ($data->department_capa == 'IA') selected @endif
                                        value="IA">IT Administration </option>
                                <option @if ($data->department_capa == 'ACC') selected @endif
                                        value="ACC">Accounting </option>
                                <option @if ($data->department_capa == 'LOG') selected @endif
                                        value="LOG">Logistics </option>
                                <option @if ($data->department_capa == 'SM') selected @endif
                                        value="SM">Senior Management </option>
                                <option @if ($data->department_capa == 'BA') selected @endif
                                        value="BA">Business Administration </option>
                        </select>
                        @error('department_capa')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div style="margin-bottom: 0px;" class="col-lg-12 new-date-data-field ">
                    <div class="group-input input-date">
                        <label for="Deviation category">Source of CAPA</label>
                        <select name="source_of_capa" id="Deviation_category"
                         @if ($data->stage==4) disabled @endif id="Deviation_category" value="{{ $data->source_of_capa }}">
                            <option value="0">-- Select -- </option>
                            <option @if ($data->source_of_capa == 'Deviation') selected @endif
                                                value="Deviation">Deviation</option>
                            <option @if ($data->source_of_capa == 'OS/OT') selected @endif
                                                value="OS/OT">OS/OT</option>
                            <option @if ($data->source_of_capa == 'Audit_Obs') selected @endif
                                                value="Audit_Obs">Audit Observation</option>
                            <option @if ($data->source_of_capa == 'Complaint') selected @endif
                                                value="Complaint">Complaint</option>
                            <option @if ($data->source_of_capa == 'Product_Recall') selected @endif
                                                value="Product_Recall">Product Recall</option>
                            <option @if ($data->source_of_capa == 'Returned_Goods') selected @endif
                                                value="Returned_Goods">Returned Goods</option>
                            <option @if ($data->source_of_capa == 'APQR') selected @endif
                                                value="APQR">APQR</option>
                            <option @if ($data->source_of_capa == 'Management_Review_Action_Plan') selected @endif
                                                value="Management_Review_Action_Plan">Management Review Action Plan</option>
                            <option @if ($data->source_of_capa == 'Investigation') selected @endif
                                                value="Investigation">Investigation</option>
                            <option @if ($data->source_of_capa == 'Internal_Review') selected @endif
                                                value="Internal_Review">Internal Review</option>
                            <option @if ($data->source_of_capa == 'Quality_Risk_Assessment') selected @endif
                                                value="Quality_Risk_Assessment">Quality Risk Assessment</option>
                            <option value="Others">Others</option>
                        </select>

                    </div>
                </div>

                    <div class="col-lg-6" id="capa_others_block" style="display: none">
                    <div class="group-input">
                        <label for="others">Others <span id="asteriskInviothers" style="display: none" class="text-danger">*</span></label>
                        <input type="text" id="others" name="capa_others" class="others">
                    </div>
                </div>

                <script>
                    $('select[name=source_of_capa]').change(function() {
                        $(this).val() == 'Others' ? $('#capa_others_block').fadeIn() : $('#capa_others_block').fadeOut()
                    })
                </script>

                <div class="col-lg-6" id="others_block" >
                    <div class="group-input">
                        <label for="others">Source Document</label>
                        <input type="text" id="source_doc" name="source_doc" value="{{ $data->source_doc }}" class="source_doc">
                    </div>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="group-input">
                        <label for="Description_of_Discrepancy">Description of Discrepancy </label>
                        <textarea class="tiny" name="Description_of_Discrepancy" id="Description_of_Discrepancy" value="">{{$data->Description_of_Discrepancy}}</textarea>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="group-input">
                        <label for="Root_Cause">Root Cause</label>
                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                        <textarea class="tiny" name="capa_root_cause" id="capa_root_cause">{{ $data->capa_root_cause }}</textarea>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="group-input">
                        <label for="Immediate_Action_Take">Immediate Action Taken (If Applicable)</label>
                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                        <textarea class="tiny" name="Immediate_Action_Take" id="Immediate_Action_Take">{{ $data->Immediate_Action_Take }}</textarea>
                    </div>
                </div>
                    <div class="col-md-12 mb-3">
                    <div class="group-input">
                        <label for="Corrective_Action_Details">Corrective Action Details</label>
                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                        <textarea class="tiny" name="Corrective_Action_Details" id="Corrective_Action_Details" value="">{{ $data->Corrective_Action_Details }}</textarea>
                    </div>
                </div>
                    <div class="col-md-12 mb-3">
                    <div class="group-input">
                        <label for="Preventive_Action_Details">Preventive Action Details</label>
                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                        <textarea class="tiny" name="Preventive_Action_Details" id="Preventive_Action_Details" value="">{{ $data->Preventive_Action_Details }}</textarea>
                    </div>
                </div>
                    <div class="col-lg-6 new-date-data-field">
                    <div class="group-input input-date">
                        <label for="Audit Schedule End Date">Target Completion Date</label>
                        <div class="calenderauditee">
                        <!-- <input  type="date" value="{{ $data->capa_completed_date ? $data->capa_completed_date : '' }}" name="capa_completed_date"id="capa_completed_date"
                        oninput="handleDateInput(this, 'Capa_reported_date')">
                        <input type="hidden" value="{{ date('Y-m-d') }}" name="capa_completed_date">  -->

                         <input readonly type="text" id="Capa_reported_date"  value="{{ date('d-M-Y') }}" name="capa_completed_date" style="background-color: light-dark(rgba(239, 239, 239, 0.3), rgba(59, 59, 59, 0.3))"/>
                            <input type="date" value="{{ $data->capa_completed_date }}" name="capa_completed_date"
                             max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" value=""
                                oninput="handleDateInput(this, 'Capa_reported_date')" />
                        </div>
                    </div>
                </div>

                    <div class="col-md-12 mb-3">
                    <div class="group-input">
                        <label for="Interim_Control">Interim Control(If Any)</label>
                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                        <textarea class="tiny" name="Interim_Control" id="Interim_Control" value="">{{ $data->Interim_Control }}</textarea>
                    </div>
                </div>
                    <div class="sub-head">
                            CAPA Implementation
                            </div>
                                <div class="col-md-12 mb-3">
                    <div class="group-input">
                        <label for="Corrective_Action_Taken">Corrective Action Taken</label>
                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                        <textarea class="tiny" name="Corrective_Action_Taken" id="Corrective_Action_Taken" value="">{{ $data->Corrective_Action_Taken }}</textarea>
                    </div>

                </div> <div class="col-md-12 mb-3">
                    <div class="group-input">
                        <label for="Preventive_action_Taken">Preventive Action Taken</label>
                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                        <textarea class="tiny" name="Preventive_action_Taken" id="Preventive_action_Taken" value="">{{ $data->Preventive_action_Taken }}</textarea>
                    </div>
                </div>
                <div class="sub-head">
                            CAPA Closure
                            </div>
                        <div class="col-md-12 mb-3">
                    <div class="group-input">
                        <label for="CAPA_Closure_Comments">CAPA Closure Comments</label>
                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                        <textarea class="" name="CAPA_Closure_Comments" id="CAPA_Closure_Comments" value="">{{ $data->CAPA_Closure_Comments }}</textarea>
                    </div>

                    <div class="col-lg-12">
                    @if($data->stage == 7)
                    <div class="group-input">
                        <label for="CAPA_Closure_attachment Attachment">CAPA Closure Attachment</label>
                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                        <div class="file-attachment-field">
                            <div class="file-attachment-list" id="CAPA_Closure_attachment">
                            @if ($data->CAPA_Closure_attachment)
                                        @foreach(json_decode($data->CAPA_Closure_attachment) as $file)
                                            <h6 class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                <b>{{ $file }}</b>
                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                <a class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                            </h6>
                                @endforeach
                            @endif
                            </div>
                            <div class="add-btn">
                                <div>Add</div>
                                <input  type="file" id="CAPA_Closure_attachment" name="CAPA_Closure_attachment[]"
                                    oninput="addMultipleFiles(this, 'CAPA_Closure_attachment')" value=""
                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} {{ $data->stage == 0 || $data->stage == 2 ? 'disabled' : '' }} multiple>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="group-input">
                        <label for="CAPA_Closure_attachment Attachment">CAPA Closure Attachment</label>
                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                        <div class="file-attachment-field">
                            <div class="file-attachment-list" id="CAPA_Closure_attachment">
                            @if ($data->CAPA_Closure_attachment)
                                        @foreach(json_decode($data->CAPA_Closure_attachment) as $file)
                                            <h6 class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                <b>{{ $file }}</b>
                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                <a class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                            </h6>
                                @endforeach
                            @endif
                            </div>
                            <div class="add-btn">
                                <div>Add</div>
                                <input  type="file" id="CAPA_Closure_attachment" name="CAPA_Closure_attachment[]"
                                    oninput="addMultipleFiles(this, 'CAPA_Closure_attachment')" value=""
                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} {{ $data->stage == 0 || $data->stage == 2 ? 'disabled' : '' }} multiple>
                            </div>
                        </div>
                    </div>
                    @endif



                </div>
            </div>

            <div class="button-block">
            <button  style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }} id="ChangesaveButton04" class=" saveAuditFormBtn d-flex" style="align-items: center;">
                    <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none" role="status">
                        <span class="sr-only">Loading...</span>
                        </div>
                        Save
                </button>
                <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                        <button type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} class="backButton">Back</button>
                    </a>

                <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button" class="nextButton" onclick="nextStep()">Next</button>
                <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                        Exit </a> </button>
                        @if ($data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 )
                        <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                            class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#launch_extension">
                                            Launch Extension
                                        </a>
                                        @endif
                                        <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#effectivenss_extension">
                                            Launch Effectiveness Check
                                        </a> -->
            </div>
        </div>
    </div>
    </div>
        <!-- investigation and capa -->
         <!-- <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            @if ($data->stage == 5)
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Investigation Summary">Investigation Summary <span style="display: {{ $data->stage == 5 ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="tiny" name="Investigation_Summary"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-8">{{ $data->Investigation_Summary }}</textarea>
                                    </div>
                                    @error('Investigation_Summary')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Impact Assessment">Impact Assessment <span style="display: {{ $data->stage == 5 ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="tiny" name="Impact_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-9">{{ $data->Impact_assessment }}</textarea>
                                    </div>
                                    @error('Impact_assessment')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Root Cause">Root Cause  <span style="display: {{ $data->stage == 5 ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="tiny" name="Root_cause" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}  id="summernote-10">{{ $data->Root_cause }}</textarea>
                                    </div>
                                    @error('Root_cause')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="CAPA Rquired">CAPA Required ? <span class="text-danger"   style="display: {{ $data->stage == 5 ? 'inline' : 'none' }}" >*</span></label>
                                      <select name="CAPA_Rquired"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}   id="CAPA_Rquired" value="{{ $data->CAPA_Rquired }}">
                                        <option value="0"> -- Select --</option>
                                        <option @if ($data->CAPA_Rquired == 'yes') selected @endif
                                            value="yes">Yes</option>
                                        <option  @if ($data->CAPA_Rquired == 'no') selected @endif
                                           value="no">No</option>
                                      </select>
                                      @error('CAPA_Rquired')
                                          <div class="text-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="CAPA Description">CAPA Description  <span id="asteriskIcon32q13" style="display: {{ $data->CAPA_Rquired == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="CAPA_Description summernote" name="CAPA_Description"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}  id="summernote-11">{{ $data->CAPA_Description }}</textarea>

                                        @error('CAPA_Description')
                                          <div class="text-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                            var selectField = document.getElementById('CAPA_Rquired');
                                            var inputsToToggle = [];

                                            var facilityNameInputs = document.getElementsByClassName('capa_type');
                                            for (var i = 0; i < facilityNameInputs.length; i++) {
                                                inputsToToggle.push(facilityNameInputs[i]);
                                            }
                                            var facilityNameInputs = document.getElementsByClassName('CAPA_Description');
                                            for (var i = 0; i < facilityNameInputs.length; i++) {
                                                inputsToToggle.push(facilityNameInputs[i]);
                                            }

                                            selectField.addEventListener('change', function () {
                                                var isRequired = this.value === 'yes';

                                                inputsToToggle.forEach(function (input) {
                                                    input.required = isRequired;
                                                });

                                                var asteriskIcon321 = document.getElementById('asteriskIcon32q1');
                                                var asteriskIcon3211 = document.getElementById('asteriskIcon32q13');
                                                asteriskIcon321.style.display = isRequired ? 'inline' : 'none';
                                                asteriskIcon3211.style.display = isRequired ? 'inline' : 'none';
                                            });
                                        });
                                </script>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Post Categorization Of Deviation">Post Categorization Of Deviation <span style="display: {{ $data->stage == 5 ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please Refer Intial deviation category before updating.</small></div>
                                        <select name="Post_Categorization"  id="Post_Categorization" value="Post_Categorization">
                                        <option value=""> -- Select --</option>
                                        <option @if ($data->Post_Categorization == 'major') selected @endif
                                            value="major">Major</option>
                                        <option  @if ($data->Post_Categorization == 'minor') selected @endif
                                           value="minor">Minor</option>
                                           <option  @if ($data->Post_Categorization == 'critical') selected @endif
                                            value="critical">Critical</option>
                                      </select>
                                      @error('Post_Categorization')
                                          <div class="text-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Investigation Of Revised Categorization">Justification for Revised Category <span class="text-danger" style="display:{{ $data->stage == 5 ? 'inline' : 'none' }}">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="tiny" name="Investigation_Of_Review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}  id="summernote-13">{{ $data->Investigation_Of_Review }}</textarea>
                                    </div>
                                    @error('Post_Categorization')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Investigatiom Attachment">Investigation Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Investigation_attachment">
                                                @if ($data->Investigation_attachment)
                                                @foreach (json_decode($data->Investigation_attachment) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                           @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 5 ? '' : 'disabled' }} type="file" id="myfile" name="Investigation_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'Investigation_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="capa_Attachments">CAPA Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Capa_attachment">
                                                @if ($data->Capa_attachment)
                                                @foreach (json_decode($data->Capa_attachment) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                           @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 5 ? '' : 'disabled' }} type="file" id="myfile" name="Capa_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'Capa_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Investigation Summary">Investigation Summary</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea readonly class="tiny" name="Investigation_Summary"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-8">{{ $data->Investigation_Summary }}</textarea>
                                    </div>
                                    @error('Investigation_Summary')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Impact Assessment">Impact Assessment</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea readonly class="tiny" name="Impact_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-9">{{ $data->Impact_assessment }}</textarea>
                                    </div>
                                    @error('Impact_assessment')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Root Cause">Root Cause </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea readonly class="tiny" name="Root_cause"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}  id="summernote-10">{{ $data->Root_cause }}</textarea>
                                    </div>
                                    @error('Root_cause')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="CAPA Rquired">CAPA Required ?</label>
                                      <select disabled name="CAPA_Rquired"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}   id="CAPA_Rquired" value="{{ $data->CAPA_Rquired }}">
                                        <option value="0"> -- Select --</option>
                                        <option @if ($data->CAPA_Rquired == 'yes') selected @endif
                                            value="yes">Yes</option>
                                        <option  @if ($data->CAPA_Rquired == 'no') selected @endif
                                           value="no">No</option>
                                      </select>
                                      @error('CAPA_Rquired')
                                          <div class="text-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="CAPA Description">CAPA Description</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea readonly class="tiny" name="CAPA_Description"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}  id="summernote-11">{{ $data->CAPA_Description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Post Categorization Of Deviation">Post Categorization Of Deviation</label>
                                        <div><small class="text-primary">Please Refer Intial deviation category before updating.</small></div>
                                        <select name="Post_Categorization" id="Post_Categorization" value="Post_Categorization">
                                        <option value=""> -- Select --</option>
                                        <option @if ($data->Post_Categorization == 'major') selected @endif
                                            value="major">Major</option>
                                        <option  @if ($data->Post_Categorization == 'minor') selected @endif
                                           value="minor">Minor</option>
                                           <option  @if ($data->Post_Categorization == 'critical') selected @endif
                                            value="critical">Critical</option>
                                      </select>
                                      @error('Post_Categorization')
                                          <div class="text-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Investigation Of Revised Categorization">Justification for Revised Category </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea readonly class="tiny" name="Investigation_Of_Review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}  id="summernote-13">{{ $data->Investigation_Of_Review }}</textarea>
                                    </div>
                                    @error('Post_Categorization')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Investigatiom Attachment">Investigatiom Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Investigation_attachment">
                                                @if ($data->Investigation_attachment)
                                                @foreach (json_decode($data->Investigation_attachment) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                           @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Investigation_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'Investigation_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="capa_Attachments">CAPA Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Capa_attachment">
                                                @if ($data->Capa_attachment)
                                                @foreach (json_decode($data->Capa_attachment) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                           @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Capa_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'Capa_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="button-block">
                                <button type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }} id="ChangesaveButton04" class=" saveAuditFormBtn d-flex" style="align-items: center;">
                                    <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none" role="status">
                                        <span class="sr-only">Loading...</span>
                                      </div>
                                      Save
                                </button>
                             <a href="/rcms/qms-dashboard">
                                        <button type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} class="backButton">Back</button>
                                    </a>
                                <button type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>  -->

        <!-- QA Final Review -->
        <div id="CCForm4" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="row">
                    <div class="col-md-12">
                        @if ($data->stage == 5)
                            <div class="group-input">
                                <label for="QA Feedbacks">QA Feedbacks <span class="text-danger">*</span></label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                        require completion</small></div>
                                <textarea class="tiny" name="QA_Feedbacks"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                    id="summernote-14" required>{{ $data->QA_Feedbacks }}</textarea>
                            </div>
                        @else
                            <div class="group-input">
                                <label for="QA Feedbacks">QA Feedbacks</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                        require completion</small></div>
                                <textarea readonly class="tiny"
                                    name="QA_Feedbacks"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-14">{{ $data->QA_Feedbacks }}</textarea>
                            </div>
                        @endif
                        @error('QA_Feedbacks')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="group-input">
                            <label for="QA attachments">QA Attachments</label>
                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small>
                            </div>
                            <div class="file-attachment-field">
                                <div disabled class="file-attachment-list" id="QA_attachments">
                                    @if ($data->QA_attachments)
                                        @foreach (json_decode($data->QA_attachments) as $file)
                                            <h6 type="button" class="file-container text-dark"
                                                style="background-color: rgb(243, 242, 240);">
                                                <b>{{ $file }}</b>
                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                        class="fa fa-eye text-primary"
                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                <a type="button" class="remove-file"
                                                    data-file-name="{{ $file }}"><i
                                                        class="fa-solid fa-circle-xmark"
                                                        style="color:red; font-size:20px;"></i></a>
                                            </h6>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input {{ $data->stage == 5 ? '' : 'disabled' }} type="file" id="myfile"
                                        name="QA_attachments[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                        oninput="addMultipleFiles(this, 'QA_attachments')" multiple>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="button-block">
                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }}
                        id="ChangesaveButton05" class="saveAuditFormBtn d-flex" style="align-items: center;">
                        <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none"
                            role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Save
                    </button>
                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                        class="nextButton" onclick="nextStep()">Next</button>
                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                            Exit </a> </button>

                            @if ($data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 )
                            <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                            class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#launch_extension">
                                            Launch Extension
                                        </a>
                                        @endif
                                        <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#effectivenss_extension">
                                            Launch Effectiveness Check
                                        </a> -->
                </div>
            </div>
        </div>

        <!-- QAH-->
        <div id="CCForm5" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="group-input">
                            <label for="Post Categorization Of Deviation">Post Categorization Of Deviation</label>
                            <div><small class="text-primary">Please Refer Intial deviation category before
                                    updating.</small></div>
                            <select
                                name="Post_Categorization"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                id="Post_Categorization" value="Post_Categorization">
                                <option value=""> -- Select --</option>
                                <option @if ($data->Post_Categorization == 'major') selected @endif value="major">Major
                                </option>
                                <option @if ($data->Post_Categorization == 'minor') selected @endif value="minor">Minor
                                </option>
                                <option @if ($data->Post_Categorization == 'critical') selected @endif value="critical">Critical
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="group-input">
                            <label for="Investigation Of Revised Categorization">Justification for Revised Category
                            </label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea readonly class="tiny"
                                name="Investigation_Of_Review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                id="summernote-13">{{ $data->Investigation_Of_Review }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="group-input">
                            <label for="Closure Comments">Closure Comments <span class="text-danger">
                                    @if ($data->stage == 6)
                                        *
                                    @else
                                    @endif
                                </span></label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea @if ($data->stage != 6) disabled @endif required class="tiny"
                                name="Closure_Comments"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-15">{{ $data->Closure_Comments }}</textarea>
                        </div>
                        @error('Closure_Comments')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="group-input">
                            <label for="Disposition of Batch">Disposition of Batch <span class="text-danger">
                                    @if ($data->stage == 6)
                                        *
                                    @else
                                    @endif
                                </span></label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea @if ($data->stage != 6) readonly @endif required class="tiny"
                                name="Disposition_Batch"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-16">{{ $data->Disposition_Batch }}</textarea>
                        </div>
                        @error('Disposition_Batch')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="closure attachment">Closure Attachments</label>
                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small>
                            </div>
                            <div class="file-attachment-field">
                                <div disabled class="file-attachment-list" id="closure_attachment">
                                    @if ($data->closure_attachment)
                                        @foreach (json_decode($data->closure_attachment) as $file)
                                            <h6 type="button" class="file-container text-dark"
                                                style="background-color: rgb(243, 242, 240);">
                                                <b>{{ $file }}</b>
                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                        class="fa fa-eye text-primary"
                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                <a type="button" class="remove-file"
                                                    data-file-name="{{ $file }}"><i
                                                        class="fa-solid fa-circle-xmark"
                                                        style="color:red; font-size:20px;"></i></a>
                                            </h6>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input {{ $data->stage == 6 ? '' : 'disabled' }} type="file" id="myfile"
                                        name="closure_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                        oninput="addMultipleFiles(this, 'closure_attachment')" multiple>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="button-block">
                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }}
                        id="ChangesaveButton06" class=" saveAuditFormBtn d-flex" style="align-items: center;">
                        <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none"
                            role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Save
                    </button>
                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                        class="nextButton" onclick="nextStep()">Next</button>
                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                            Exit </a> </button>
                            @if ($data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 )
                            <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                            class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#launch_extension">
                                            Launch Extension
                                        </a>
                                        @endif
                                        <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#effectivenss_extension">
                                            Launch Effectiveness Check
                                        </a> -->
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

                    @if($deviationExtension && $deviationExtension->dev_proposed_due_date)
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Audit Schedule End Date">Proposed Due Date (Deviation)</label>
                                <div class="calenderauditee">
                                    <input type="text" id="dev_proposed_due_date" id="dev_proposed_due_date" readonly value="{{Helpers::getdateFormat($deviationExtension->dev_proposed_due_date)}}" />
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Audit Schedule End Date">Proposed Due Date (Deviation)</label>
                                <div class="calenderauditee">
                                    <input type="text" id="dev_proposed_due_date" id="dev_proposed_due_date" readonly />
                                </div>
                            </div>
                        </div>
                    @endif


                    @if($deviationExtension && $deviationExtension->dev_extension_justification)
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Extension_Justification_deviation">Extension Justification (Deviation)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea name="dev_extension_justification" placeholder="Deviation Extension Justification" disabled id="dev_extension_justification" value="{{$deviationExtension->dev_extension_justification}}">{{$deviationExtension->dev_extension_justification}}</textarea>
                            </div>
                        </div>
                    @else
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Extension_Justification_deviation">Extension Justification (Deviation)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea name="dev_extension_justification" placeholder="Deviation Extension Justification" id="dev_extension_justification" disabled ></textarea>
                            </div>
                        </div>
                    @endif

                    @if($deviationExtension && $deviationExtension->dev_extension_completed_by)
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" dev_extension_completed_by"> Deviation Extension Completed By </label>
                                <select name="dev_extension_completed_by" id="dev_extension_completed_by" disabled>
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @if($user->id == $deviationExtension->dev_extension_completed_by) selected @endif >{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" dev_extension_completed_by"> Deviation Extension Completed By </label>
                                <select name="dev_extension_completed_by" id="dev_extension_completed_by" disabled>
                                    <option value="">-- Select --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    @if($deviationExtension && $deviationExtension->dev_completed_on)
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Audit Schedule End Date">Deviation Extension Completed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="dev_completed_on" readonly name="dev_completed_on" placeholder="DD-MMM-YYYY" value="{{Helpers::getdateFormat($deviationExtension->dev_completed_on)}}" />
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Audit Schedule End Date">Deviation Extension Completed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="dev_completed_on" readonly name="dev_completed_on" placeholder="DD-MMM-YYYY" />
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- CAPA EXTENSION START -->
                    <div class="sub-head">
                        CAPA Extension
                    </div>
                    @if($capaExtension && $capaExtension->capa_proposed_due_date)
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="capa_proposed_due_date">Proposed Due Date (CAPA)</label>
                                <div class="calenderauditee">
                                    <input type="text" id="capa_proposed_due_date" disabled name="capa_proposed_due_date"
                                        placeholder="DD-MMM-YYYY" value="{{Helpers::getdateFormat($capaExtension->capa_proposed_due_date)}}" />
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="capa_proposed_due_date">Proposed Due Date (CAPA)</label>
                                <div class="calenderauditee">
                                    <input type="text" id="capa_proposed_due_date" disabled name="capa_proposed_due_date"
                                        placeholder="DD-MMM-YYYY" />
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($capaExtension && $capaExtension->capa_extension_justification)
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="capa_extension_justification">Extension Justification (CAPA)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea name="capa_extension_justification" placeholder="Capa Extension Justification" id="capa_extension_justification" disabled>{{$capaExtension->capa_extension_justification}}</textarea>
                            </div>
                        </div>
                    @else
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="capa_extension_justification">Extension Justification (CAPA)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea name="capa_extension_justification" placeholder="Capa Extension Justification" id="capa_extension_justification" disabled></textarea>
                            </div>
                        </div>
                    @endif


                    <div class="row">
                        @if($capaExtension && $capaExtension->capa_extension_completed_by)
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for=" capa_extension_completed_by"> CAPA Extension Completed By </label>
                                    <select name="capa_extension_completed_by" id="capa_extension_completed_by" disabled>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @if($user->id == $capaExtension->capa_extension_completed_by) selected @endif  >{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for=" capa_extension_completed_by"> CAPA Extension Completed By </label>
                                    <select name="capa_extension_completed_by" id="capa_extension_completed_by" disbaled>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        @if($capaExtension && $capaExtension->capa_completed_on)
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Audit Schedule End Date">CAPA Extension Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="capa_completed_on" name="capa_completed_on" disabled placeholder="DD-MMM-YYYY" value="{{Helpers::getdateFormat($capaExtension->capa_completed_on)}}" />
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Audit Schedule End Date">CAPA Extension Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="capa_completed_on" name="capa_completed_on" disabled placeholder="DD-MMM-YYYY" />
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                    <!-- CAPA EXTENSION ENDS -->


                    <!-- QRM EXTENSION START -->
                    <div class="sub-head">
                        Quality Risk Management Extension
                    </div>

                    @if($qrmExtension && $qrmExtension->qrm_proposed_due_date)
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="qrm_proposed_due_date">Proposed Due Date (Quality Risk Management)</label>
                                <div class="calenderauditee">
                                    <input type="text" id="qrm_proposed_due_date" name="qrm_proposed_due_date" value="{{Helpers::getdateFormat($qrmExtension->qrm_proposed_due_date)}}" disabled placeholder="DD-MMM-YYYY" />
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="qrm_proposed_due_date">Proposed Due Date (Quality Risk Management)</label>
                                <div class="calenderauditee">
                                    <input type="text" id="qrm_proposed_due_date" name="qrm_proposed_due_date" disabled placeholder="DD-MMM-YYYY" />
                                </div>
                            </div>
                        </div>
                    @endif


                    @if($qrmExtension && $qrmExtension->qrm_extension_justification)
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="qrm_extension_justification">Extension Justification (Quality Risk Management)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea disabled name="qrm_extension_justification" id="qrm_extension_justification" value="{{$qrmExtension->qrm_extension_justification}}">{{$qrmExtension->qrm_extension_justification}}</textarea>
                            </div>
                        </div>
                    @else
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="qrm_extension_justification">Extension Justification (Quality Risk Management)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea disabled name="qrm_extension_justification" placeholder="QRM Extension Justification" id="qrm_extension_justification"> </textarea>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        @if($qrmExtension && $qrmExtension->qrm_extension_completed_by)
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="qrm_extension_completed_by"> Quality Risk Management Extension Completed By </label>
                                    <select name="qrm_extension_completed_by" id="qrm_extension_completed_by" disabled>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @if($user->id == $qrmExtension->qrm_extension_completed_by) selected @endif >{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="qrm_extension_completed_by"> Quality Risk Management Extension Completed By </label>
                                    <select name="qrm_extension_completed_by" id="qrm_extension_completed_by" disabled>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        @if($qrmExtension && $qrmExtension->qrm_completed_on)
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="qrm_completed_on">Quality Risk Management Extension Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="qrm_completed_on" name="qrm_completed_on" value="{{Helpers::getdateFormat($qrmExtension->qrm_completed_on)}}" disabled placeholder="DD-MMM-YYYY" />
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="qrm_completed_on">Quality Risk Management Extension Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="qrm_completed_on" name="qrm_completed_on" disabled placeholder="DD-MMM-YYYY" />
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- QRM EXTENSION START -->


                     <!-- Investigation EXTENSION START -->

                    <div class="sub-head">
                        Investigation Extension
                    </div>

                    @if($investigationExtension && $investigationExtension->investigation_proposed_due_date)
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="investigation_proposed_due_date">Proposed Due Date (Investigation)</label>
                                <div class="calenderauditee">
                                    <input type="text" id="investigation_proposed_due_date" name="investigation_proposed_due_date" value="{{Helpers::getdateFormat($investigationExtension->investigation_proposed_due_date)}}" disabled placeholder="DD-MMM-YYYY" />
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="investigation_proposed_due_date">Proposed Due Date (Investigation)</label>
                                <div class="calenderauditee">
                                    <input type="text" id="investigation_proposed_due_date" name="investigation_proposed_due_date" disbaled placeholder="DD-MMM-YYYY" />
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($investigationExtension && $investigationExtension->investigation_extension_justification)
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="investigation_extension_justification">Extension Justification (Investigation)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea disabled name="investigation_extension_justification" placeholder="Investigation Extension Justification" id="investigation_extension_justification" value="{{$investigationExtension->investigation_extension_justification}}">{{$investigationExtension->investigation_extension_justification}}</textarea>
                            </div>
                        </div>
                    @else
                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="investigation_extension_justification">Extension Justification (Investigation)</label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <textarea name="investigation_extension_justification" placeholder="Investigation Extension Justification" id="investigation_extension_justification" disabled ></textarea>
                            </div>
                        </div>
                    @endif


                    <div class="row">
                        @if($investigationExtension && $investigationExtension->investigation_extension_completed_by)
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for=" Investigation_Extension_Completed_By"> Investigation Extension Completed By</label>
                                    <select name="investigation_extension_completed_by" id="investigation_extension_completed_by" disabled>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" @if($user->id == $investigationExtension->investigation_extension_completed_by) selected @endif >{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for=" Investigation_Extension_Completed_By"> Investigation Extension Completed By</label>
                                    <select name="investigation_extension_completed_by" id="investigation_extension_completed_by" disabled>
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        @if($investigationExtension && $investigationExtension->investigation_completed_on)
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="investigation_completed_on">Investigation Extension Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="investigation_completed_on" id="investigation_completed_on" value="{{Helpers::getdateFormat($investigationExtension->investigation_completed_on)}}" disabled placeholder="DD-MMM-YYYY" />
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="investigation_completed_on">Investigation Extension Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="investigation_completed_on" id="investigation_completed_on" disabled placeholder="DD-MMM-YYYY" />
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- Investigation EXTENSION START -->


                    <!-- <div class="sub-head">
                        Deviation Effectiveness Check
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="Effectiveness_Check_Plan_Deviation">Effectiveness Check Plan(Deviation)</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea class="tiny" name="Effectiveness_Check_Plan_Deviation" id="summernote-10"> </textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" Deviation_Effectiveness_Check_Plan_Proposed_By">Deviation Effectiveness Check
                                    Plan Proposed By </label>
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
                                <label for="deviation_EC_Plan_Proposed_On"> Deviation Effectiveness Check Plan Proposed
                                    On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="deviation_EC_Plan_Proposed_On" readonly
                                        placeholder="DD-MMM-YYYY" />
                                    <input type="date" name="deviation_EC_Plan_Proposed_On"
                                        max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'deviation_EC_Plan_Proposed_On')" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="EC_Closure_comments_deviation">Effectiveness Check Closure
                                Comments(Deviation)</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea class="tiny" name="EC_Closure_comments_deviation" id="summernote-10"> </textarea>
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
                                <label for=" deviaiton_EC_Closed_By">Deviation Effectiveness Check Closed By</label>
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
                                <label for="deviation_Effectiveness_Check_Closed_On">Deviation Effectiveness Check Closed
                                    On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="deviation_Effectiveness_Check_Closed_On" readonly
                                        placeholder="DD-MMM-YYYY" />
                                    <input type="date" name="deviation_Effectiveness_Check_Closed_On"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
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
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea class="tiny" name="EC_plan_Capa" id="summernote-10">
                </textarea>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" Investigation_Extension_Completed_By">CAPA Effectiveness Check Plan Proposed
                                    By </label>
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
                                <label for="Investigation_Extension_Completed_On">CAPA Effectiveness Check Plan Proposed
                                    On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="Investigation_Extension_Completed_On" readonly
                                        placeholder="DD-MMM-YYYY" />
                                    <input type="date" name="Investigation_Extension_Completed_On"
                                        max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'Investigation_Extension_Completed_On')" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="Extension_Justi_QRM">Effectiveness Check Closure Comments(CAPA)</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
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
                                <label for=" Investigation_Extension_Completed_By">CAPA Effectiveness Check Closed
                                    By</label>
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
                                <label for="Effectiveness_Check_Closed_On">CAPA Effectiveness Check Closed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="Effectiveness_Check_Closed_On" readonly
                                        placeholder="DD-MMM-YYYY" />
                                    <input type="date" name="Effectiveness_Check_Closed_On"
                                        max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'Effectiveness_Check_Closed_On')" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="sub-head">
                        Quality Risk Management Effectiveness Check
                    </div>
                    <div class="col-md-12 mb-3">
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="Extension_Justi_QRM">Effectiveness Check Plan( Quality Risk Management)</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea class="tiny" name="Extension_Justi_QRM" id="summernote-10">
                </textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" Investigation_Extension_Completed_By"> QRM Effectiveness Check Plan Proposed
                                    By </label>
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
                                <label for="Investigation_Extension_Completed_On">QRM Effectiveness Check Plan Proposed
                                    On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="Investigation_Extension_Completed_On" readonly
                                        placeholder="DD-MMM-YYYY" />
                                    <input type="date" name="Investigation_Extension_Completed_On"
                                        max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'Investigation_Extension_Completed_On')" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="Extension_Justi_QRM">Effectiveness Check Closure Comments( Quality Risk
                                Management)</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
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
                                <label for=" Investigation_Extension_Completed_By">QRM Effectiveness Check Closed
                                    By</label>
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
                                <label for="Effectiveness_Check_Closed_On">QRM Effectiveness Check Closed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="Effectiveness_Check_Closed_On" readonly
                                        placeholder="DD-MMM-YYYY" />
                                    <input type="date" name="Effectiveness_Check_Closed_On"
                                        max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
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
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea class="tiny" name="Extension_Justi_QRM" id="summernote-10">
                </textarea>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" Investigation_Extension_Completed_By">Investigation Effectiveness Check Plan
                                    Proposed By </label>
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
                                <label for="Effectiveness_Check_Plan_Proposed_On">Investigation Effectiveness Check Plan
                                    Proposed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="Effectiveness_Check_Plan_Proposed_On" readonly
                                        placeholder="DD-MMM-YYYY" />
                                    <input type="date" name="Effectiveness_Check_Plan_Proposed_On"
                                        max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'Effectiveness_Check_Plan_Proposed_On')" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="group-input">
                            <label for="EC_Closure_Comments_investigation">Effectiveness Check Closure
                                Comments(Investigation)</label>
                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                    completion</small></div>
                            <textarea class="tiny" name="EC_Closure_Comments_investigation" id="summernote-10">
                </textarea>
                        </div>
                    </div>

                    <div class="col-lg-6 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="Investigation_Extension_Completed_On">Next Review Date (Investigation)</label>
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
                                <label for=" Investigation_Effectiveness_Check_Closed_By">Investigation Effectiveness
                                    Check Closed By</label>
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
                                <label for="Investigation_Effectiveness_Check_Closed_On">Investigation Effectiveness Check
                                    Closed On</label>
                                <div class="calenderauditee">
                                    <input type="text" id="Investigation_Effectiveness_Check_Closed_On" readonly
                                        placeholder="DD-MMM-YYYY" />
                                    <input type="date" name="Investigation_Effectiveness_Check_Closed_On"
                                        max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'Investigation_Effectiveness_Check_Closed_On')" />
                                </div>
                            </div>
                        </div> -->
                    </div>

                    <div class="button-block">
                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="submit" class="saveButton" {{ $data->stage == 9 ? 'disabled' : '' }}>Save</button>
                        <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                            <button type="button" class="backButton">Back</button>
                        </a>
                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                Exit </a> </button>
                                @if ($data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 )
                                <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                            class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#launch_extension">
                                            Launch Extension
                                        </a>
                                        @endif
                                        <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#effectivenss_extension">
                                            Launch Effectiveness Check
                                        </a> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Activity Log content -->
        <div id="CCForm6" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="row">
                    <div class="sub-head">Submission</div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="submit by">Submit By :-</label>
                            <div class="static">{{ $data->submit_by }}</div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="submit on">Submit On :-</label>
                            <div class="static">{{ $data->submit_on }}</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input" style="width:1620px; height:100px; `padding:5px;">
                            <label for="submit comment">Submit Comments :-</label>
                            <div class="">{{ $data->submit_comment }}</div>
                        </div>
                    </div>

                    <div class="sub-head">HOD Review Completed</div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="HOD Review Complete By">HOD Review Complete By :-</label>
                            <div class="static">{{ $data->HOD_Review_Complete_By }}</div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="HOD Review Complete On">HOD Review Complete On :-</label>
                            <div class="static">{{ $data->HOD_Review_Complete_On }}</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input" style=" ">
                            <label for="HOD Review Comments">HOD Review Comments :-</label>
                            <div class="">{{ $data->HOD_Review_Comments }}</div>
                        </div>
                    </div>


                    <div class="sub-head">QA Initial Review Completed</div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="QA Initial Review Complete By">QA Initial Review Complete By :-</label>
                            <div class="static">{{ $data->QA_Initial_Review_Complete_By }}</div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="QA Initial Review Complete On">QA Initial Review Complete On :-</label>
                            <div class="static">{{ $data->QA_Initial_Review_Complete_On }}</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input" style="width:1620px; height:100px; `padding:5px;">
                            <label for="QA Initial Review Comments">QA Initial Review Comments:-</label>
                            <div class="">{{ $data->QA_Initial_Review_Comments }}</div>
                        </div>
                    </div>

                    <div class="sub-head">CFT Review Complete</div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="CFT Review Complete By">CFT Review Complete By :-</label>
                            <div class="static">{{ $data->CFT_Review_Complete_By }}</div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="CFT Review Complete On">CFT Review Complete On :-</label>
                            <div class="static">{{ $data->CFT_Review_Complete_On }}</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                            <label for="CFT Review Comments">CFT Review Comments :-</label>
                            <div class="">{{ $data->CFT_Review_Comments }}</div>
                        </div>
                    </div>

                    <div class="sub-head"> QA Final Review Completed</div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="QA Final Review Complete By"> QA Final Review Complete By :-</label>
                            <div class="static">{{ $data->QA_Final_Review_Complete_By }}</div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="QA Final Review Complete On"> QA Final Review Complete On :-</label>
                            <div class="static">{{ $data->QA_Final_Review_Complete_On }}</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                            <label for="QA Final Review Comments"> QA Final Review Comments :-</label>
                            <div class="">{{ $data->QA_Final_Review_Comments }}</div>
                        </div>
                    </div>

                    <div class="sub-head">QA Head/Manager Designee Approval</div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="QA Final Review Complete By">QA Head/Manager Designee Approval Complete By :-</label>
                            <div class="static">{{ $data->QA_head_approved_by }}</div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="QA Final Review Complete On">QA Head/Manager Designee Approval Complete On :-</label>
                            <div class="static">{{ $data->QA_head_approved_on	 }}</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                            <label for="QA Final Review Comments">QA Head/Manager Designee Approval Comments :-</label>
                            <div class="">{{ $data->QA_head_approved_comment }}</div>
                        </div>
                    </div>                    

                    <div class="sub-head">Initiator Update</div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="CFT Review Complete By">Initiator Update Complete By :-</label>
                            <div class="static">{{ $data->pending_initiator_approved_by }}</div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="CFT Review Complete On">Initiator Update Complete On :-</label>
                            <div class="static">{{ $data->pending_initiator_approved_on }}</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="CFT Review Comments">Initiator Update Comments :-</label>
                            <div class="">{{ $data->pending_initiator_approved_comment }}</div>
                        </div>
                    </div>


                    <div class="sub-head">QA Final Approval</div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="Approved By">QA Final Approved By :-</label>
                            <div class="static">{{ $data->QA_final_approved_by }}</div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="group-input">
                            <label for="Approved On">QA Final Approved On :-</label>
                            <div class="static">{{ $data->QA_final_approved_on }}</div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                            <label for="Approved Comments">QA Final Approved Comments :-</label>
                            <div class="">{{ $data->QA_final_approved_comment }}</div>
                        </div>
                    </div>
                </div>
                <div class="button-block">
                    <button type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }}
                        class="saveButton saveAuditFormBtn d-flex" style="align-items: center;">
                        <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none"
                            role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Save
                    </button>
                    <a href="/rcms/qms-dashboard">
                        <button type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                            class="backButton">Back</button>
                    </a>
                    <button type="submit"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>Submit</button>
                    <button type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}> <a
                            href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                            Exit </a> </button>
                </div>
            </div>
        </div>

    </div>
    </form>
    <div class="sticky-buttons">
        <div>
            <a type="button" class="" data-toggle="modal" data-target="#myModal3">

                <svg width="18" height="24" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#ffffff"
                        d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34M332.1 128H256V51.9zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288zm220.1-208c-5.7 0-10.6 4-11.7 9.5c-20.6 97.7-20.4 95.4-21 103.5c-.2-1.2-.4-2.6-.7-4.3c-.8-5.1.3.2-23.6-99.5c-1.3-5.4-6.1-9.2-11.7-9.2h-13.3c-5.5 0-10.3 3.8-11.7 9.1c-24.4 99-24 96.2-24.8 103.7c-.1-1.1-.2-2.5-.5-4.2c-.7-5.2-14.1-73.3-19.1-99c-1.1-5.6-6-9.7-11.8-9.7h-16.8c-7.8 0-13.5 7.3-11.7 14.8c8 32.6 26.7 109.5 33.2 136c1.3 5.4 6.1 9.1 11.7 9.1h25.2c5.5 0 10.3-3.7 11.6-9.1l17.9-71.4c1.5-6.2 2.5-12 3-17.3l2.9 17.3c.1.4 12.6 50.5 17.9 71.4c1.3 5.3 6.1 9.1 11.6 9.1h24.7c5.5 0 10.3-3.7 11.6-9.1c20.8-81.9 30.2-119 34.5-136c1.9-7.6-3.8-14.9-11.6-14.9h-15.8z" />
                </svg>
            </a>
        </div>
    </div>
    </div>
    </div>


    <div class="container">
        <div class="modal right fade" id="myModal3" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-titles">Deviation Workflow</h4>
                    </div>
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
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="modal right fade" id="myModal4" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">WorkFlow</h4>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

    </div>

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
                                <div>
                                    @if($qrmExtension && $qrmExtension->counter == 3)
                                        <a>-------</a>
                                    @else
                                        <a href="" data-bs-toggle="modal" data-bs-target="#qrm_extension"> QRM</a>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div>
                                    @if($investigationExtension && $investigationExtension->counter == 3)
                                        <a>-------</a>
                                    @else
                                        <a href=""data-bs-toggle="modal" data-bs-target="#investigation_extension"> Investigation</a>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div>
                                    @if($capaExtension && $capaExtension->counter == 3)
                                        <a>-------</a>
                                    @else
                                        <a href="" data-bs-toggle="modal" data-bs-target="#capa_extension"> CAPA</a>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div>
                                    @if($deviationExtension && $deviationExtension->counter == 3)
                                        <a>-------</a>
                                    @else
                                        <a href="" data-bs-toggle="modal" data-bs-target="#deviation_extension"> Deviation</a>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="qrm_extension">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">QRM-Extension</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('launch-extension-qrm', $data->id) }}" method="post">
                @csrf
                <div class="modal-body">
                    <!-- <div class="group-input">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="password" name="password" required>
                    </div> -->
                    <div class="group-input">
                        <label for="password">Proposed Due Date(QRM)</label>
                        <input class="extension_modal_signature" type="date" name="qrm_proposed_due_date" id="qrm_proposed_due_date">
                    </div>
                    <div class="group-input">
                        <label for="password">Extension Justification (QRM)<span
                                class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text"
                            name="qrm_extension_justification" id="qrm_extension_justification">
                    </div>
                    <div class="group-input">
                        <label for="password">Quality Risk Management Extension Completed By </label>
                        <select class="extension_modal_signature" name="qrm_extension_completed_by"
                            id="qrm_extension_completed_by">
                            <option value="">-- Select --</option>
                            @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="group-input">
                        <label for="password">Quality Risk Management Extension Completed On </label>
                        <input class="extension_modal_signature" type="date"
                            name="qrm_completed_on" id="qrm_completed_on">
                    </div>
                    <input name="deviation_id" id="deviation_id" value="{{$data->id}}" hidden >
                    <input name="extension_identifier" id="extension_identifier" value="QRM" hidden >
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

<div class="modal fade" id="investigation_extension">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Investigation-Extension</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('launch-extension-investigation', $data->id) }}" method="post">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">

                    <!-- <div class="group-input">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="password" name="password" required>
                    </div> -->
                    <div class="group-input">
                        <label for="password">Proposed Due Date(Investigation)</label>
                        <input class="extension_modal_signature" type="date"
                            name="investigation_proposed_due_date" id="investigation_proposed_due_date">
                    </div>
                    <div class="group-input">
                        <label for="password">Extension Justification (Investigation)<span
                                class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text"
                            name="investigation_extension_justification" id="investigation_extension_justification">
                    </div>
                    <div class="group-input">
                        <label for="password">Investigation Extension Completed By </label>
                        <select class="extension_modal_signature" name="investigation_extension_completed_by" id="investigation_extension_completed_by">
                            <option value="">-- Select --</option>
                            @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="group-input">
                        <label for="password">Investigation Extension Completed On </label>
                        <input class="extension_modal_signature" type="date" name="investigation_completed_on" id="investigation_completed_on">
                    </div>
                    <input name="deviation_id" id="deviation_id" value="{{$data->id}}" hidden >
                    <input name="extension_identifier" id="extension_identifier" value="Investigation" hidden >
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


<div class="modal fade" id="capa_extension">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">CAPA-Extension</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('launch-extension-capa', $data->id) }}" method="post">
                @csrf

                <!-- Modal body -->
                <div class="modal-body">

                    <!-- <div class="group-input">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="password" name="password" required>
                    </div> -->
                    <div class="group-input">
                        <label for="password">Proposed Due Date (CAPA)</label>
                        <input class="extension_modal_signature" type="date" name="capa_proposed_due_date" id="capa_proposed_due_date">
                    </div>
                    <div class="group-input">
                        <label for="password">Extension Justification (CAPA)<span
                                class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="capa_extension_justification" id="capa_extension_justification">
                    </div>
                    <div class="group-input">
                        <label for="password">CAPA Extension Completed By </label>
                        <select class="extension_modal_signature" name="capa_extension_completed_by" id="capa_extension_completed_by">
                            <option value="">-- Select --</option>
                            @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <input name="deviation_id" id="deviation_id" value="{{$data->id}}" hidden >
                    <input name="extension_identifier" id="extension_identifier" value="Capa" hidden >
                    <div class="group-input">
                        <label for="password">CAPA Extension Completed On </label>
                        <input class="extension_modal_signature" type="date" name="capa_completed_on" id="capa_completed_on">
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


<div class="modal fade" id="deviation_extension">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Deviation-Extension</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('launch-extension-deviation', $data->id) }}" method="post">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <!-- <div class="group-input">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="password" name="password" required>
                    </div> -->
                    <div class="group-input">
                        <label for="password">Proposed Due Date (Deviation)</label>
                        <input class="extension_modal_signature" type="date" name="dev_proposed_due_date" id="dev_proposed_due_date">
                    </div>
                    <div class="group-input">
                        <label for="password">Extension Justification (Deviation)<span
                                class="text-danger">*</span></label>
                        <input class="extension_modal_signature" type="text"
                            name="dev_extension_justification" id="dev_extension_justification">
                    </div>
                    <div class="group-input">
                        <label for="password">Deviation Extension Completed By </label>
                        <select class="extension_modal_signature" name="dev_extension_completed_by" id="dev_extension_completed_by">
                        <option value="">-- Select --</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="group-input">
                        <label for="password">Deviation Extension Completed On </label>
                        <input class="extension_modal_signature" type="date" name="dev_completed_on" id="dev_completed_on">
                    </div>
                    <input name="deviation_id" id="deviation_id" value="{{$data->id}}" hidden  >
                    <input name="extension_identifier" id="extension_identifier" value="Deviation"  hidden >
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
                    <button type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


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
 <!-- ==============================investigation effectiveness===========  -->
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
            ele: '#Facility, #Group, #Audit, #Auditee ,#reference_record, #related_records, #investigation_approach, #audit_type'
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
            const addRowButton = document.getElementById('new-button-icon');
            addRowButton.addEventListener('click', function() {
                const department = this.parentNode.innerText.trim(); // Get the department name

                // Create a new row and insert it after the current row
                const newRow = document.createElement('tr');
                newRow.innerHTML = `<td style="background: #e1d8d8">${department}</td>
                            <td><textarea name="Person"></textarea></td>
                            <td><textarea name="Impect_Assessment"></textarea></td>
                            <td><textarea name="Comments"></textarea></td>
                            <td><textarea name="sign&date"></textarea></td>
                            <td><textarea name="Remarks"></textarea></td>`;

                // Insert the new row after the current row
                const currentRow = this.parentNode.parentNode;
                currentRow.parentNode.insertBefore(newRow, currentRow.nextSibling);
            });
        });
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

    <script>
        function addWhyField(con_class, name) {
            let mainBlock = document.querySelector('.why-why-chart')
            let container = mainBlock.querySelector(`.${con_class}`)
            let textarea = document.createElement('textarea')
            textarea.setAttribute('name', name);
            container.append(textarea)
        }
    </script>
    <div class="modal fade" id="child-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <form action="{{ route('deviation_child_1', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            @if ($data->stage == 3)
                                <label for="major">
                                    <input type="radio" name="child_type" id="major" value="rca">
                                    RCA
                                </label>
                                <br>
                                <label for="major">
                                    <input type="radio" name="child_type" id="major" value="extension">
                                    Extension
                                </label>
                            @endif

                            @if ($data->stage == 5)
                                <label for="major">
                                    <input type="radio" name="child_type" id="major" value="capa">
                                    CAPA
                                </label>
                                <br>
                                <label for="major">
                                    <input type="radio" name="child_type" id="major" value="extension">
                                    Extension
                                </label>
                            @endif
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        <button type="submit">Continue</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="more-info-required-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('deviation_reject', $data->id) }}" method="POST">
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
                        <button type="submit">
                            Submit
                        </button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cancel-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('deviationCancel', $data->id) }}" method="POST">
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


    <div class="modal fade" id="deviationIsCFTRequired">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('deviationIsCFTRequired', $data->id) }}" method="POST">
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
    <div class="modal fade" id="sendToInitiator">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('check', $data->id) }}" method="POST">
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
    <div class="modal fade" id="hodsend">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('check2', $data->id) }}" method="POST">
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
    <div class="modal fade" id="qasend">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('check3', $data->id) }}" method="POST">
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


    <div class="modal fade" id="pending-initiator-update">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('pending_initiator_update', $data->id) }}" method="POST"
                    id="pendingInitiatorForm">
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
                        <button type="submit" class="pendingInitiatorModalButton">
                            <div class="spinner-border spinner-border-sm pendingInitiatorModalSpinner" style="display: none"
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

    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('deviation_send_stage', $data->id) }}" method="POST"
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
    <div class="modal fade" id="cft-not-reqired">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('cftnotreqired', $data->id) }}" method="POST">
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
                            <label for="comment">Comment</label>
                            <input type="comment" name="comment">
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
    <div class="modal fade" id="modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('deviation_qa_more_info', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username</label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input type="comment" name="comment">
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
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#capa_related_record, #investigation_approach'
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
        function clicktoremove(){

        }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const removeButtons = document.querySelectorAll('.remove-file');

        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const fileName = this.getAttribute('data-file-name');
                const fileContainer = this.parentElement;

                // Hide the file container
                if (fileContainer) {
                    fileContainer.style.display = 'none';
                }
            });
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
        var i = 0;
        function addFishBone(top, bottom) {
            i++;
            let mainBlock = document.querySelector('.fishbone-ishikawa-diagram');
            let topBlock = mainBlock.querySelector(top)
            let bottomBlock = mainBlock.querySelector(bottom)

            let topField = document.createElement('div')
            topField.className = 'grid-field fields top-field'

            let measurement = document.createElement('div')
            let measurementInput = document.createElement('input')
            measurementInput.setAttribute('type', 'text')
            measurementInput.setAttribute('name', 'fishbone[measurement]['+i+']')
            measurement.append(measurementInput)
            topField.append(measurement)

            let materials = document.createElement('div')
            let materialsInput = document.createElement('input')
            materialsInput.setAttribute('type', 'text')
            materialsInput.setAttribute('name', 'fishbone[materials]['+i+']')
            materials.append(materialsInput)
            topField.append(materials)

            let methods = document.createElement('div')
            let methodsInput = document.createElement('input')
            methodsInput.setAttribute('type', 'text')
            methodsInput.setAttribute('name', 'fishbone[methods]['+i+']')
            methods.append(methodsInput)
            topField.append(methods)

            topBlock.prepend(topField)

            let bottomField = document.createElement('div')
            bottomField.className = 'grid-field fields bottom-field'

            let environment = document.createElement('div')
            let environmentInput = document.createElement('input')
            environmentInput.setAttribute('type', 'text')
            environmentInput.setAttribute('name', 'fishbone[environment]['+i+']')
            environment.append(environmentInput)
            bottomField.append(environment)

            let manpower = document.createElement('div')
            let manpowerInput = document.createElement('input')
            manpowerInput.setAttribute('type', 'text')
            manpowerInput.setAttribute('name', 'fishbone[manpower]['+i+']')
            manpower.append(manpowerInput)
            bottomField.append(manpower)

            let machine = document.createElement('div')
            let machineInput = document.createElement('input')
            machineInput.setAttribute('type', 'text')
            machineInput.setAttribute('name', 'fishbone[machine]['+i+']')
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
        let why_index = 0;
        function addWhyField(con_class, name) {
            why_index++;
            let mainBlock = document.querySelector('.why-why-chart')
            let container = mainBlock.querySelector(`.${con_class}`)
            let textarea = document.createElement('textarea')
            let newName = name.replace('index', why_index);
            textarea.setAttribute('name', newName);
            container.append(textarea)

            $(textarea).after('<button class="remove-row col-md-2">Remove</button>');
                $(textarea).next('.remove-row').on('click', function() {
                    $(this).prev('textarea').remove();
                    $(this).remove();
            });
        }
    </script>
@endsection
