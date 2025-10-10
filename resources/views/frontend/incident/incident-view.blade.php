 @extends('frontend.layout.main')
        @section('container')

        <link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet'
            type='text/css' />
        <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'>
        </script>


            @php
                $users = DB::table('users')->select('id', 'name')->get();
            @endphp
            <style>
                textarea.note-codable {
                    display: none !important;
                }

                /* header {
                    display: none;
                } */
                   header .header_rcms_bottom ,.container-fluid.header-bottom,.search-bar{
                    display: none;
                }
                #fr-logo {
                    display: none;
                }

                .fr-logo {
                    display: none;
                }

                .fr-quick-insert {
                    left: 150px !important;
                }

            </style>
            <style>
                .hide-input {
                    display: none;
                }
            </style>
               <style>
    .form-section {
        grid-template-columns: auto auto;
        align-items: center;
    }

    .form-section > div {
        padding: 10px;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
    }

    .checkbox-group label {
        margin-right: 10px;
    }

    /* .checkbox-group input[type="checkbox"] {
        margin-right: 5px;
    } */

    label {
        font-weight: bold;
    }
    .main-group{
                            display: flex;
                            gap:20px;
                            border: 2px solid gray;
                            padding: 8px;

                            border-radius: 5px;
                        }


    </style>

            <style>
                textarea.note-codable {
                    display: none !important;
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
                                '" readonly placeholder="DD-MM-YYYY" /><input type="date" name="scheduled_start_date[]" id="scheduled_start_date' +
                                serialNumber +
                                '_checkdate" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input" oninput="handleDateInput(this, `scheduled_start_date' +
                            serialNumber + '`);checkDate(`scheduled_start_date' + serialNumber +
                            '_checkdate`,`scheduled_end_date' + serialNumber +
                            '_checkdate`)" /></div></div></div></td>' +

                                '<td><input type="time" name="scheduled_start_time[]"></td>' +
                                '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="scheduled_end_date' +
                                serialNumber +
                                '" readonly placeholder="DD-MM-YYYY" /><input type="date" name="scheduled_end_date[]" id="scheduled_end_date' +
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
                            var stageDisabled = {{ $data->stage == 0 || $data->stage == 7 ? 'true' : 'false' }};

                            var disabledAttr = stageDisabled ? 'disabled' : '';

                            var html =
                                '<tr>' +
                                '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                                '"></td>' +
                                '<td><input type="text" name="facility_name[]" ' + disabledAttr + '></td>' +
                                '<td><input type="text" name="IDnumber[]" ' + disabledAttr + '></td>' +
                                '<td><input type="text" name="Remarks[]" ' + disabledAttr + '></td>' +
                                '<td><button class="removeRowBtn">Remove</button></td>' +
                                '</tr>';

                            return html;
                        }

                        var tableBody = $('#onservation-field-table tbody');
                        var rowCount = tableBody.children('tr').length;
                        var newRow = generateTableRow(rowCount + 1); // +1 to get the correct serial number
                        tableBody.append(newRow);
                    });

                    // Remove row functionality
                    $(document).on('click', '.removeRowBtn', function(e) {
                        $(this).closest('tr').remove();
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
                                '<td><input type="text" name="Number[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}></td>' +
                                '<td><input type="text" name="ReferenceDocumentName[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}></td>' +
                                '<td><input type="text" name="Document_Remarks[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}></td>' +
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
                                '<td> <input type="text" name="product_stage[]" id=""></td>' +

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
                                userOptionsHtml = userOptionsHtml.concat(
                                    `<option value="${user.id}">${user.name}</option>`)
                            });

                            var html =
                                '<tr>' +
                                '<td><input disabled type="text" name="investication[' + serialNumber +
                                '][serial]" value="' + serialNumber + '"></td>' +
                                '<td> <select name="investication[' + serialNumber +
                                '][investioncation_team]" id="" class="investioncation_team"> <option value="">-- Select --</option>' +
                                userOptionsHtml + ' </select> </td>' +
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
                                '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                                '"></td>' +

                                // '<td><input disabled type="text" name="failure_mode_qrms[' + serialNumber + '][serial]" value="' + serialNumber + '"></td>' +
                                '<td><input type="text" class="numberDetail" name="failure_mode_qrms[' +
                                serialNumber + '][risk_factor]"></td>' +
                                '<td><input type="text" class="numberDetail" name="failure_mode_qrms[' +
                                serialNumber + '][risk_element]"></td>' +
                                '<td><input type="text" class="Document_Remarks" name="failure_mode_qrms[' +
                                serialNumber + '][probale_of_risk_element]"></td>' +
                                '<td><input type="text" class="Document_Remarks" name="failure_mode_qrms[' +
                                serialNumber + '][existing_risk_control]"></td>' +
                                '<td> <select name="failure_mode_qrms[' + serialNumber +
                                '][initial_severity]" id=""> <option value="">-- Select --</option><option value="1">1</option> <option value="2">2</option> <option value="3">3</option> </select> </td>' +
                                '<td> <select name="failure_mode_qrms[' + serialNumber +
                                '][initial_probability]" id=""> <option value="">-- Select --</option><option value="1">1</option> <option value="2">2</option> <option value="3">3</option></select> </td>' +
                                '<td> <select name="failure_mode_qrms[' + serialNumber +
                                '][initial_detectability]" id=""> <option value="1">-- Select --</option><option value="1">1</option> <option value="2">2</option> <option value="3">3</option> </select> </td>' +
                                '<td><input type="text" class="Document_Remarks" name="failure_mode_qrms[' +
                                serialNumber + '][initial_rpn]"></td>' +
                                '<td> <select name="failure_mode_qrms[' + serialNumber +
                                '][risk_acceptance]" id=""> <option value="n">-- Select --</option><option value="n">N</option> <option> Y </option> </select> </td>' +
                                '<td><input type="text" class="Document_Remarks" name="failure_mode_qrms[' +
                                serialNumber + '][proposed_additional_risk_control]"></td>' +

                                '<td> <select name="failure_mode_qrms[' + serialNumber +
                                '][residual_severity]" id=""> <option value="1">-- Select --</option><option value="1">1</option> <option value="2">2</option> <option value="3">3</option> </select> </td>' +
                                '<td> <select name="failure_mode_qrms[' + serialNumber +
                                '][residual_probability]" id=""> <option value="1">-- Select --</option><option value="1">1</option> <option value="2">2</option> <option value="3">3</option> </select> </td>' +
                                '<td> <select name="failure_mode_qrms[' + serialNumber +
                                '][residual_detectability]" id=""> <option value="1">-- Select --</option><option value="1">1</option> <option value="2">2</option> <option value="3">3</option> </select> </td>' +
                                '<td><input type="text" class="Document_Remarks"              name="failure_mode_qrms[' +
                                serialNumber + '][residual_rpn]"></td>' +
                                '<td> <select name="failure_mode_qrms[' + serialNumber +
                                '][risk_acceptance]" id=""> <option value="">-- Select --</option><option value="n">N</option>   <option value="y">Y</option></select> </td>' +

                                '<td><input type="text" class="Document_Remarks" name="failure_mode_qrms[' +
                                serialNumber + '][mitigation_proposal]"></td>' +


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
                                '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                                '"></td>' +
                                '<td><input type="text" class="numberDetail" name="matrix_qrms[' + serialNumber +
                                '][risk_Assesment]"></td>' +
                                '<td><input type="text" class="numberDetail" name="matrix_qrms[' + serialNumber +
                                '][review_schedule]"></td>' +
                                '<td><input type="text" class="numberDetail" name="matrix_qrms[' + serialNumber +
                                '][actual_reviewed]"></td>' +
                                '<td><input type="text" class="numberDetail" name="matrix_qrms[' + serialNumber +
                                '][recorded_by]"></td>' +
                                '<td><input type="text" class="numberDetail" name="matrix_qrms[' + serialNumber +
                                '][remark]"></td>' +
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
                    let investigationTeamDataIndex =
                        {{ $investigationTeamData && is_array($investigationTeamData) ? count($investigationTeamData) : 1 }};
                    $('#investigationTeamAdd').click(function(e) {
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
                                '<td> <select name="investigationTeam[' + investigationTeamDataIndex +
                                '][teamMember]" id="" class="teamMember"> <option value="">-- Select --</option>' +
                                userOptionsHtml + ' </select> </td>' +
                                '<td><input type="text" class="responsibility" name="investigationTeam[' +
                                investigationTeamDataIndex + '][responsibility]"></td>' +
                                '<td><input type="text" class="remarks" name="investigationTeam[' +
                                investigationTeamDataIndex + '][remarks]"></td>' +
                                '<td><button type="text" class="removeRowBtn" ">Remove</button></td>' +
                                '</tr>';
                            investigationTeamDataIndex++;
                            return html;
                        }

                        var tableBody = $('#investigationTeamDetailTable tbody');
                        var rowCount = tableBody.children('tr').length;
                        var newRow = generateTableRow(rowCount + 1);
                        tableBody.append(newRow);
                    });
                });
            </script>

            <script>
                $(document).ready(function() {
                    let rootCauseDataIndex = {{ $rootCauseData && is_array($rootCauseData) ? count($rootCauseData) : 1 }};
                    $('#rootCauseAdd').click(function(e) {
                        function generateTableRow(serialNumber) {
                            var users = @json($users);

                            var html =
                                '<tr>' +
                                '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                                '"></td>' +
                                '<td> <select name="rootCauseData[' + rootCauseDataIndex +
                                '][rootCauseCategory]" class="Root_Cause_Category_Select" id=""> <option value="">-- Select --</option> <option value="M-Machine(Equipment)">M-Machine(Equipment)</option><option value="M-Maintenance">M-Maintenance</option><option value="M-Man Power (physical work)">M-Man Power (physical work)</option><option value="M-Management">M-Management</option><option value="M-Material (Raw,Consumables etc.)">M-Material (Raw,Consumables etc.)</option><option value="M-Method (Process/Inspection)">M-Method (Process/Inspection)</option><option value="M-Mother Nature (Environment)">M-Mother Nature (Environment)</option><option value="P-Place/Plant">P-Place/Plant</option><option value="P-Policies">P-Policies</option><option value="P-Price">P-Price </option><option value="P-Procedures">P-Procedures</option><option value="P-Process">P-Process </option><option value="P-Product">P-Product</option><option value="S-Suppliers">S-Suppliers</option><option value="S-Surroundings">S-Surroundings</option><option value="S-Systems">S-Systems</option>  </select></td>' +
                                '<td><select name="rootCauseData[' + rootCauseDataIndex +
                                '][rootCauseSubCategory]" id="" class="Root_Cause_Sub_Category_Select"><option value="">-- Select --</option> <option value="infrequent_audits">Infrequent Audits </option><option value="No_Preventive_Maintenance">No Preventive Maintenance </option><option value="Other">Other</option><option value="Poor_Maintenance_or_Design">Poor Maintenance or Design </option><option value="Maintenance_Needs_Improvement">Maintenance Needs Improvement </option><option value="Scheduling_Problem">Scheduling Problem </option><option value="system_deficiency">System Deficiency </option><option value="technical_error">Technical Error </option><option value="tolerable_failure">Tolerable Failure </option><option value="calibration_issues">Calibration Issues </option><option value="Infrequent_Audits">Infrequent Audits</option><option value="No_Preventive_Maintenance">No Preventive Maintenance </option><option value="Other">Other</option><option value="Maintenance_Needs_Improvement">Maintenance Needs Improvement</option><option value="Scheduling_Problem ">Scheduling Problem </option><option value="System_Deficiency">System Deficiency </option><option value="Technical_Error ">Technical Error </option><option value="Tolerable_Failure">Tolerable Failure </option><option value="Failure_to_Follow_SOP">Failure to Follow SOP</option><option value="Human_Machine_Interface">Human-Machine Interface</option><option value="Misunderstood_Verbal_Communication">Misunderstood Verbal Communication </option><option value="Other">Other</option><option value="Personnel Error">Personnel Error</option><option value="Personnel not Qualified">Personnel not Qualified</option><option value="Practice Needed">Practice Needed</option><option value="Teamwork Needs Improvement">Teamwork Needs Improvement</option><option value="Attention">Attention</option><option value="Understanding">Understanding</option><option value="Procedural">Procedural</option><option value="Behavioral">Behavioral</option><option value="Skill">Skill</option><option value="Inattention to task">Inattention to task</option><option value="Lack of Process">Lack of Process</option><option value="Methods">Methods</option><option value="No or Poor Management Involvement">No or Poor Management Involvement</option><option value="Other">Other</option><option value="Personnel not Qualified">Personnel not Qualified</option><option value="Poor employee involvement">Poor employee involvement</option><option value="Poor recognition of hazard">Poor recognition of hazard</option><option value="Previously identified hazards were not eliminated">Previously identified hazards were not eliminated</option><option value="Stress demands">Stress demands</option><option value="Task hazards not guarded properly">Task hazards not guarded properly</option><option value="Personnel not Qualified">Personnel not Qualified</option>  </select></td>' +
                                '<td><input type="text" class="Document_Remarks" name="rootCauseData[' +
                                rootCauseDataIndex + '][ifOthers]"></td>' +
                                '<td><input type="text" class="Document_Remarks" name="rootCauseData[' +
                                rootCauseDataIndex + '][probability]"></td>' +
                                '<td><input type="text" class="Document_Remarks" name="rootCauseData[' +
                                rootCauseDataIndex + '][remarks]"></td>' +
                                '<td><button type="text" class="removeRowBtn" ">Remove</button></td>' +
                                '</tr>';

                            rootCauseDataIndex++;
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
                $(document).on('click', '.removeRowBtn', function() {
                    $(this).closest('tr').remove();
                })
            </script>
            <div class="form-field-head">

                <div class="division-bar">
                    <strong>Site Division/Project</strong> :
                    {{ Helpers::getDivisionName($data->division_id) }}/Incident
                </div>
            </div>

            <!-- Incident Form Starts -->

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
                                    $cftUsers = DB::table('incident_cfts')
                                        ->where(['incident_id' => $data->id])
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
                                    // $cftCompleteUser = DB::table('incident_cft_responses')
                                    //     ->whereIn('status', ['In-progress', 'Completed'])
                                    //     ->where('incident_id', $data->id)
                                    //     ->where('cft_user_id', Auth::user()->id)
                                    //     ->whereNull('deleted_at')
                                    //     ->first();
                                    // dd($cftCompleteUser);
                                @endphp
                                <!-- <button class="button_theme1" onclick="window.print();return false;" class="new-doc-btn">Print</button> -->
                                <button class="button_theme1"> <a class="text-white"
                                        href="{{ url('rcms/incident-audit-trail', $data->id) }}">Audit Trail </a>
                                </button>
                                {{--@php
                                dd($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                                @endphp--}}
                                @if ($data->stage == 1 && (($data->initiator_id == Auth::user()->id) || (Helpers::check_roles($data->division_id, 'Incident', 4) || Helpers::check_roles($data->division_id, 'Incident', 18))))
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                        Submit
                                    </button>
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                        Cancel
                                    </button>
                                @elseif($data->stage == 2 && (Helpers::check_roles($data->division_id, 'Incident', 4)))
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                        More Info Required
                                    </button>
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                        HOD Initial Review Complete
                                    </button>
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                        Cancel
                                    </button>
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                        Child
                                    </button>

                                @elseif($data->stage == 3 && (Helpers::check_roles($data->division_id, 'Incident', 48) || Helpers::check_roles($data->division_id, 'Incident', 18)))
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                        More Info Required
                                    </button>
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                        QA Initial Review Complete
                                    </button>
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                        Child
                                    </button>

                                @elseif($data->stage == 4 && ( Helpers::check_roles($data->division_id, 'Incident', 42) || Helpers::check_roles($data->division_id, 'Incident', 43) || Helpers::check_roles($data->division_id, 'Incident', 39) || Helpers::check_roles($data->division_id, 'Incident', 9) || Helpers::check_roles($data->division_id, 'Incident', 18)))
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                        More Info Required
                                    </button>
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                         QAH/Designee Approval Complete
                                    </button>
                                    @if(Helpers::getChildData($data->id, 'Incident') < 3)
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                        Child
                                    </button>
                                    @endif
                                @elseif($data->stage == 5 && ( Helpers::check_roles($data->division_id, 'Incident', 3) || Helpers::check_roles($data->division_id, 'Incident', 18) ))
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                        Pending Initiator Update Complete
                                    </button>
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                        More Info Required
                                    </button>
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                        Child
                                    </button>
                                @elseif($data->stage == 6 && ( Helpers::check_roles($data->division_id, 'Incident', 4) || Helpers::check_roles($data->division_id, 'Incident', 18)))
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                        HOD Final Review Complete
                                    </button>
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                        More Info Required
                                    </button>
                                    @if(Helpers::getChildData($data->id, 'Incident') < 3)
                                   <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                        Child
                                    </button>
                                    @endif
                                @elseif($data->stage == 7 && (Helpers::check_roles($data->division_id, 'Incident', 48) || Helpers::check_roles($data->division_id, 'Incident', 18)))
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                        More Info Required
                                    </button>
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                        QA Final Review Complete
                                    </button>
                                    @if(Helpers::getChildData($data->id, 'Incident') < 3)
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                        Child
                                    </button>
                                     @endif
                                @elseif($data->stage == 8 && (Helpers::check_roles($data->division_id, 'Incident', 42) || Helpers::check_roles($data->division_id, 'Incident', 43) || Helpers::check_roles($data->division_id, 'Incident', 39) || Helpers::check_roles($data->division_id, 'Incident', 9) || Helpers::check_roles($data->division_id, 'Incident', 18) ))
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                        Approved                            </button>
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                        More Info Required
                                    </button>
                                    @if(Helpers::getChildData($data->id, 'Incident') < 3)
                                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                        Child
                                    </button>
                                    @endif
                                @endif
                                <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                                    </a> </button>
                                    {{--Helpers::check_roles($data->division_id, 'Incident', 43)--}}

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
                                        <div class="active">HOD Initial Review</div>
                                    @else
                                        <div class="">HOD Initial Review</div>
                                    @endif

                                    @if ($data->stage >= 3)
                                        <div class="active">QA Initial Review</div>
                                    @else
                                        <div class="">QA Initial Review</div>
                                    @endif

                                    @if ($data->stage >= 4)
                                    <div class="active">QAH/Designee Approval </div>
                                    @else
                                    <div class="">QAH/Designee Approval</div>
                                    @endif

                                    @if ($data->stage >= 5)
                                        <div class="active">Pending Initiator Update</div>
                                    @else
                                        <div class="">Pending Initiator Update</div>
                                    @endif


                                    @if ($data->stage >= 6)
                                        <div class="active">HOD Final Review</div>
                                    @else
                                        <div class="">HOD Final Review</div>
                                    @endif
                                    @if ($data->stage >= 7)
                                        <div class="active">QA Final Review</div>
                                    @else
                                        <div class="">QA Final Review</div>
                                    @endif
                                    @if ($data->stage >= 8)
                                        <div class="active">QAH Closure Approval</div>
                                    @else
                                        <div class="">QAH Closure Approval</div>
                                    @endif
                                    {{-- @if ($data->stage >= 8)
                                        <div class="active">QA Final Approval</div>
                                    @else
                                        <div class="">QA Final Approval</div>
                                    @endif --}}
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
                            <button class="cctablinks" onclick="openCity(event, 'CCForm8')">HOD initial Review</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">QA Initial Review</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">QA Head/Designee Approval</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Initiator Update</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm17')">HOD Final Review </button>
                            {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm12')">Extension</button> --}}
                            <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA Final Review</button>
                            {{-- <button class="cctablinks " onclick="openCity(event, 'CCForm7')">CFT</button> --}}
                            <button class="cctablinks " id="Investigation_button" onclick="openCity(event, 'CCForm9')"
                                style="display: none">Investigation</button>
                            <button class="cctablinks " id="QRM_button" onclick="openCity(event, 'CCForm19')"
                                style="display: none">QRM</button>
                            <button class="cctablinks " id="CAPA_button" onclick="openCity(event, 'CCForm20')"
                                style="display: none">CAPA</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QAH/Designee Closure Approval</button>

                            <button class="cctablinks" onclick="openCity(event, 'CCForm16')">Activity Log</button>
                        </div>

                        <form id="auditForm" action="{{ route('incident-update', $data->id) }}" method="post"
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

                                                    <input disabled type="text"
                                                        value="{{ Helpers::getDivisionName($data->division_id) }}/INC/{{ date('Y') }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}">

                                                    {{-- <input disabled type="text" name="record"> --}}

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
                                                    <input readonly type="text" value="{{ Helpers::getdateFormat($data->intiation_date) }}" name="intiation_date" id="intiation_date">

                                                </div>
                                            </div>

                                            {{-- <div class="col-lg-12 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Due Date">Due Date</label>
                                                    <div><small class="text-primary">If revising Due Date, kindly mention revision
                                                            reason in "Due Date Extension Justification" data field.</small></div>
                                                    <div class="calenderauditee">
                                                        <input  type="text" id="due_date" readonly placeholder="DD-MM-YYYY"value="{{ Helpers::getdateFormat($data->due_date) }}"/>
                                                        <input type="date" id="due_date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                            oninput="handleDateInput(this, 'due_dateq');checkDate('due_dateq')" />
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-12 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="Audit Schedule Start Date">Due Date <span class="text-danger">{{$data->stage == 1 ? '*' : '' }}</span</label>
                                                    {{--<div><small class="text-primary">If revising Due Date, kindly mention revision
                                                        reason in "Due Date Extension Justification" data field.</small></div>--}}
                                                     <div class="calenderauditee">
                                                        <input type="text" id="due_dateq" readonly placeholder="DD-MM-YYYY" value="{{ Helpers::getdateFormat($data->due_date) }}" {{ $data->stage == 1 ? '' : 'readonly' }}
                                                    />
                                                        <input type="date" id="due_dateq" name="due_date"min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $data->due_date }}" class="hide-input"
                                                        oninput="handleDateInput(this, 'due_dateq');checkDate('due_dateq')" {{ $data->stage == 1 ? '' : 'readonly' }}/>
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


                                                {{-- <div class="col-lg-6">
                                                    <div class="group-input">
                                                        <label for="Initiator Group"><b>Initiation Department
                                                        </b> <span
                                                                class="text-danger">*</span></label>
                                                        <select name="Initiator_Group" id="initiator_group" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}                                                            > --}}
                                                            {{-- <option value="CQA" @if ($data->Initiator_Group == 'CQA') selected @endif> Corporate  Quality Assurance</option>
                                                            <option value="QAB" @if ($data->Initiator_Group == 'QAB') selected @endif> Quality  Assurance Biopharma</option>
                                                            <option value="QAB" @if ($data->Initiator_Group == 'QC') selected @endif> Quality  Control</option>
                                                            <option value="CQC" @if ($data->Initiator_Group == 'CQC') selected @endif> Central Quality Control</option>
                                                            <option value="MANU" @if ($data->Initiator_Group == 'MANU') selected @endif> Manufacturing  </option>
                                                            <option value="PSG" @if ($data->Initiator_Group == 'PSG') selected @endif>Plasma Sourcing Group</option>
                                                            <option value="CS" @if ($data->Initiator_Group == 'CS') selected @endif> Central Stores</option>
                                                            <option value="ITG" @if ($data->Initiator_Group == 'ITG') selected @endif> Information    Technology Group</option>
                                                            <option value="MM" @if ($data->Initiator_Group == 'MM') selected @endif> Molecular  Medicine</option>
                                                            <option value="CL" @if ($data->Initiator_Group == 'CL') selected @endif>Central Laboratory</option>
                                                            <option value="TT" @if ($data->Initiator_Group == 'TT') selected @endif>Tech  team</option>
                                                            <option value="QA" @if ($data->Initiator_Group == 'QA') selected @endif> Quality Assurance</option>
                                                            <option value="QM" @if ($data->Initiator_Group == 'QM') selected @endif> Quality Management</option>
                                                            <option value="IA" @if ($data->Initiator_Group == 'IA') selected @endif>  IT  Administration</option>
                                                            <option value="ACC" @if ($data->Initiator_Group == 'ACC') selected @endif>  Accounting   </option>
                                                            <option value="LOG" @if ($data->Initiator_Group == 'LOG') selected @endif> Logistics     </option>
                                                            <option value="SM" @if ($data->Initiator_Group == 'SM') selected @endif>Senior Management</option>
                                                            <option value="BA" @if ($data->Initiator_Group == 'BA') selected @endif> Business  Administration</option>
                                                            <option value="DC" @if ($data->Initiator_Group == 'DC') selected @endif>  Document Cell</option>
                                                            <option value="PG"  @if ($data->Initiator_Group == 'PG') selected @endif>Production General</option> --}}
                                                                {{-- <option value="">Select Department</option>
                                                                <option value="CQA"  @if ($data->Initiator_Group == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                                                <option value="QA" @if ($data->Initiator_Group == 'QA') selected @endif >Quality Assurance</option>
                                                                <option value="QC"  @if ($data->Initiator_Group == 'QC') selected @endif>Quality Control</option>
                                                                <option value="QM"  @if ($data->Initiator_Group == 'QM') selected @endif>Quality Control (Microbiology department)</option>
                                                                <option value="PG"  @if ($data->Initiator_Group == 'PG') selected @endif>Production General</option>
                                                                <option value="PL"  @if ($data->Initiator_Group == 'PL') selected @endif>Production Liquid Orals</option>
                                                                <option value="PT"  @if ($data->Initiator_Group == 'PT') selected @endif>Production Tablet and Powder</option>
                                                                <option value="PE"  @if ($data->Initiator_Group == 'PE') selected @endif>Production External (Ointment, Gels, Creams and
                                                                    Liquid)</option>
                                                                <option value="PC"  @if ($data->Initiator_Group == 'PC') selected @endif>Production Capsules</option>
                                                                <option value="PI"  @if ($data->Initiator_Group == 'PI') selected @endif>Production Injectable</option>
                                                                <option value="EN"  @if ($data->Initiator_Group == 'EN') selected @endif>Engineering</option>
                                                                <option value="HR"  @if ($data->Initiator_Group == 'HR') selected @endif>Human Resource</option>
                                                                <option value="ST"  @if ($data->Initiator_Group == 'ST') selected @endif>Store</option>
                                                                <option value="IT"  @if ($data->Initiator_Group == 'IT') selected @endif>Electronic Data Processing</option>
                                                                <option value="FD"  @if ($data->Initiator_Group == 'FD') selected @endif>Formulation Development</option>
                                                                <option value="AL"  @if ($data->Initiator_Group == 'AL') selected @endif>Analytical research and Development Laboratory
                                                                </option>
                                                                <option value="PD"  @if ($data->Initiator_Group == 'PD') selected @endif>Packaging Development</option>
                                                                <option value="PU"  @if ($data->Initiator_Group == 'PU') selected @endif>Purchase Department</option>
                                                                <option value="DC" @if ($data->Initiator_Group == 'DC') selected @endif >Document Cell</option>
                                                                <option value="RA"  @if ($data->Initiator_Group == 'RA') selected @endif>Regulatory Affairs</option>
                                                                <option value="PV"  @if ($data->Initiator_Group == 'PV') selected @endif>Pharmacovigilance</option>

                                                        </select>
                                                    </div>
                                                    @error('Initiator_Group')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div> --}}

                                                <div class="col-lg-6">
                                                    <div class="group-input">
                                                        <label for="Initiator"><b>Initiation Department</b></label>
                                                        <input readonly type="text" name="Initiator_Group" id="initiator_group"
                                                            value="{{ $data->Initiator_Group }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="group-input">
                                                        <label for="Initiation Group Code">Initiation Department Code</label>
                                                        <input type="text" name="initiator_group_code"
                                                            value="{{ $data->initiator_group_code }}" id="initiator_group_code"
                                                            readonly>
                                                        {{-- <div class="default-name"> <span
                                                        id="initiator_group_code">{{ $data->Initiator_Group }}</span></div> --}}
                                                    </div>
                                                </div>

                                                {{-- <div class="col-lg-6">
                                                    <div class="group-input">
                                                        <label for="Initiator Group Code">Initiation Department Code</label>
                                                        <input type="text" name="initiator_group_code" value="{{ $data->initiator_group_code }}"
                                                            id="initiator_group_code" readonly>
                                                    </div>
                                                </div> --}}

                                            {{-- <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Document Details Required">Equipment Name<span
                                                            class="text-danger">*</span></label>
                                                    <select
                                                        name="equipment_name"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        id="equipment_name" value="{{ $data->equipment_name }}">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data->equipment_name == 'yes' || old('equipment_name') == 'yes') selected @endif value="yes">
                                                            Yes</option>
                                                        <option @if ($data->equipment_name == 'no' || old('equipment_name') == 'no') selected @endif value="no">
                                                            No</option>>
                                                            <option @if ($data->equipment_name == 'na' || old('equipment_name') == 'na') selected @endif value="na">
                                                                NA</option>>
                                                    </select>
                                                </div>
                                                @error('equipment_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Document Details Required">Instrument Name <span
                                                            class="text-danger">*</span></label>
                                                    <select
                                                        name="instrument_name"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        id="instrument_name" value="{{ $data->instrument_name }}">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data->instrument_name == 'yes' || old('instrument_name') == 'yes') selected @endif value="yes">
                                                            Yes</option>
                                                        <option @if ($data->instrument_name == 'no' || old('instrument_name') == 'no') selected @endif value="no">
                                                            No</option>>
                                                            <option @if ($data->instrument_name == 'na' || old('instrument_name') == 'na') selected @endif value="na">
                                                                NA</option>>
                                                    </select>
                                                </div>
                                                @error('instrument_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Document Details Required">Facility Name <span
                                                            class="text-danger">*</span></label>
                                                    <select
                                                        name="inc_facility_name"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        id="inc_facility_name" value="{{ $data->inc_facility_name }}">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data->inc_facility_name == 'yes' || old('inc_facility_name') == 'yes') selected @endif value="yes">
                                                            Yes</option>
                                                        <option @if ($data->inc_facility_name == 'no' || old('inc_facility_name') == 'no') selected @endif value="no">
                                                            No</option>>
                                                            <option @if ($data->inc_facility_name == 'na' || old('inc_facility_name') == 'na') selected @endif value="na">
                                                                NA</option>>
                                                    </select>
                                                </div>
                                                @error('instrument_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}


                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="Short Description">Short Description<span class="text-danger">
                                                            *</span></label><span id="rchars">255</span>characters remaining
                                                            <input id="docname" type="text" name="short_description" maxlength="255"
                                                            required value="{{ $data->short_description }}" {{ $data->stage == 1 ? '' : 'readonly' }}>
                                                    {{-- <textarea name="short_description"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }} id="docname"
                                                        type="text" maxlength="255" required {{ $data->stage == 0 || $data->stage == 8? 'disabled' : '' }}>{{ $data->short_description }}</textarea> --}}
                                                </div>
                                                @error('short_description')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 new-date-data-field">
    <div class="group-input input-date">
        <label for="short_description_required">Repeat Incident?<span class="text-danger">*</span></label>
        <select name="short_description_required"
                id="short_description_required"
                onchange="checkRecurring(this)"
                {{-- value="{{ $data->short_description_required }}"  --}}
                {{ $data->stage == 0 || $data->stage == 9 ? 'readonly' : '' }}>
            <option value="">-- Select --</option>
            <option value="Yes" @if($data->short_description_required == 'Yes' || old('short_description_required') == 'Yes')selected @endif>Yes</option>
            <option value="No" @if($data->short_description_required == 'No' || old('short_description_required') == 'No') selected @endif>No</option>
        </select>
    </div>
    @error('short_description_required')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="col-lg-6" id="nature_of_repeat_block"
    @if ($data->short_description_required != 'Yes') style="display: none" @endif>
    <div class="group-input">
        <label for="nature_of_repeat">Repeat Nature
            <span id="asteriskInviRecurring"
                  style="display: {{ $data->short_description_required == 'Yes' ? 'inline' : 'none' }}"
                  class="text-danger">*</span>
        </label>
        <textarea class="nature_of_repeat"
                  name="nature_of_repeat"
                  id="nature_of_repeat"
                  {{ $data->stage == 0 || $data->stage == 9 ? 'readonly' : '' }}>{{ $data->nature_of_repeat }}</textarea>
    </div>
    @error('nature_of_repeat')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectField = document.getElementById('short_description_required');
        var natureOfRepeatBlock = document.getElementById('nature_of_repeat_block');
        var asteriskIcon = document.getElementById('asteriskInviRecurring');
        var natureOfRepeatField = document.getElementById('nature_of_repeat');

        // Initialize 'Repeat Nature' field visibility based on current selection
        toggleNatureOfRepeatField(selectField.value === 'Yes');

        // Listen for dropdown changes
        selectField.addEventListener('change', function() {
            toggleNatureOfRepeatField(this.value === 'Yes');
        });

        // Toggle visibility and required attribute for 'Repeat Nature'
        function toggleNatureOfRepeatField(isYes) {
            natureOfRepeatBlock.style.display = isYes ? 'block' : 'none';
            asteriskIcon.style.display = isYes ? 'inline' : 'none';
            natureOfRepeatField.required = isYes;
        }
    });

    function checkRecurring(selectElement) {
        var repeatNatureField = document.getElementById('nature_of_repeat');
        repeatNatureField.required = selectElement.value === 'Yes';
    }
</script>


                                        <div class="col-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="severity-level">Incident Observed On (Date)<span
                                                        class="text-danger">*</span></label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="incident_date" readonly placeholder="DD-MM-YYYY" value="{{ Helpers::getdateFormat($data->incident_date) }}" {{ $data->stage == 1 ? '' : 'readonly' }}/>
                                                    <input type="date" name="incident_date" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $data->incident_date }}"
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'incident_date')" {{ $data->stage == 1 ? '' : 'readonly' }}/>
                                                </div>
                                                @error('Deviation_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>


                                            <div class="col-lg-6 new-time-data-field">
                                                <div class="group-input input-time">
                                                    <label for="incident_time">Incident Observed On (Time)<span
                                                            class="text-danger">*</span></label>
                                                    <input type="time"
                                                        name="incident_time"
                                                        id="incident_time"
                                                        value="{{ old('incident_time') ? old('incident_time') : $data->incident_time }}" {{ $data->stage == 1 ? '' : 'readonly' }}>
                                                    @error('incident_time')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
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

                                            <div class="col-lg-6 new-time-data-field">
                                                <div
                                                    class="group-input input-time @error('Delay_Justification') @else delayJustificationBlock @enderror">
                                                    <label for="incident_time">Delay Justification<span
                                                            class="text-danger">*</span></label>
                                                    <textarea id="Delay_Justification" name="Delay_Justification" {{ $data->stage == 1 ? '' : 'readonly' }}>{{ $data->Delay_Justification }}</textarea>
                                                </div>
                                                @error('Delay_Justification')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    @php
                                                        $users = DB::table('users')->get();
                                                    @endphp

                                                    <label for="If Other">Incident Observed By<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="Facility" placeholder="Select Person Name"
                                                        value="{{ $data->Facility }}" {{ $data->stage == 1 ? '' : 'readonly' }}>
                                                    @error('Facility')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="severity-level">Incident Reported On<span
                                                            class="text-danger">*</span></label>
                                                    <div class="calenderauditee">
                                                        <input type="text" id="incident_reported_date" readonly placeholder="DD-MM-YYYY" value="{{ Helpers::getdateFormat($data->incident_reported_date) }}" {{ $data->stage == 1 ? '' : 'readonly' }}/>
                                                        <input type="date" name="incident_reported_date" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $data->incident_reported_date }}"
                                                        class="hide-input"
                                                        oninput="handleDateInput(this, 'incident_reported_date')" {{ $data->stage == 1 ? '' : 'readonly' }}/>
                                                    </div>
                                                    @error('incident_reported_date')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{--<script>
                                                $(document).ready(function() {
                                                    // Hide the delayJustificationBlock initially
                                                    $('.delayJustificationBlock').hide();

                                                    // Check the condition on page load
                                                    checkDateDifference();
                                                });

                                                function checkDateDifference() {
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

                                                // Call checkDateDifference whenever the values are changed
                                                $('input[name=incident_date], input[name=incident_reported_date]').on('change', function() {
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
                                                    <label for="audit type">Incident Related To<span
                                                            class="text-danger">*</span></label>
                                                    <select multiple name="audit_type[]" id="audit_type" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>

                                                        <option value="Equipment/Instrument"
                                                            {{ strpos($data->audit_type, 'Equipment/Instrument/System') !== false ? 'selected' : '' }}>
                                                            Equipment/ Instrument/System</option>
                                                            <option value="Material"
                                                            {{ strpos($data->audit_type, 'Material') !== false ? 'selected' : '' }}>
                                                            Material </option>
                                                            <option value="Process"
                                                            {{ strpos($data->process, 'Process') !== false ? 'selected' : '' }}>
                                                            Process</option>
                                                        <option value="Anyother(specify)"
                                                            {{ strpos($data->audit_type, 'Anyother(specify)') !== false ? 'selected' : '' }}>
                                                            Other( Please specify)</option>
                                                        {{-- <option value="Documentationerror"
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
                                                            <option
                                                            value="Facility"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                            {{ strpos($data->audit_type, 'Facility') !== false ? 'selected' : '' }}>
                                                            Facility</option>
                                                        <option value="Laboratory_Instrument/System"
                                                            {{ strpos($data->audit_type, 'Laboratory_Instrument/System') !== false ? 'selected' : '' }}>
                                                            Laboratory Instrument/System</option>
                                                        <option value="Utility_System"
                                                            {{ strpos($data->audit_type, 'Utility_System') !== false ? 'selected' : '' }}>
                                                            Utility System</option>
                                                        <option value="Computer_System"
                                                            {{ strpos($data->audit_type, 'Computer_System') !== false ? 'selected' : '' }}>
                                                            Computer System</option> --}}
                                                        {{-- <option value="Document"
                                                            {{ strpos($data->audit_type, 'Document') !== false ? 'selected' : '' }}>
                                                            Document</option> --}}
                                                        {{-- <option value="Data integrity"
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
                                                         --}}
                                                    </select>
                                                </div>
                                                @error('audit_type')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="col-lg-6" id="others_block"
                                                @if (strpos($data->audit_type, 'Anyother(specify)')) style="display: none" @endif>
                                                <div class="group-input">
                                                    <label for="others">Others<span id="asteriskInOther"
                                                            style="display: {{ $data->audit_type == 'Anyother(specify)' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="otherrr" name="others"
                                                        id="others" value="{{ $data->others }}" {{ $data->stage == 1 ? '' : 'readonly' }}>
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

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="search">Department Head<span class="text-danger"></span>
                                                    </label>

                                                    <select id="select-state" placeholder="Select..." name="department_head" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                        <option value="">--Select--</option>
                                                        @foreach ($users as $key => $value)
                                                            <option @if ($data->department_head == $value->id) selected @endif
                                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="search">QA Reviewer<span class="text-danger"></span> </label>

                                                    <select id="select-state" placeholder="Select..." name="qa_reviewer" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                        <option value="">--Select--</option>
                                                        @foreach ($users as $key => $value)
                                                            <option @if ($data->qa_reviewer == $value->id) selected @endif
                                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="Facility/Equipment"> Facility/ Equipment/ Instrument/ System
                                                        Details Required? <span class="text-danger">*</span></label>
                                                    <select name="Facility_Equipment"
                                                        id="Facility_Equipment" value="{{ $data->Facility_Equipment }}" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
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

                                            {{-- <div class="group-input" id="facilityRow"
                                                @if ($data->Facility_Equipment == 'no') style="display: none" @endif>

                                                <label for="audit-agenda-grid">
                                                    Facility/ Equipment/ Instrument/ System Details<span id="asteriskInvifaci"
                                                    style="display: {{ $data->Facility_Equipment == 'yes' ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span>

                                                    <button type="button" name="audit-agenda-grid" id="ObservationAdd">+</button>
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
                                                                        <td><input disabled type="text" name="serial[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }} value="{{ $key + 1 }}"></td>
                                                                        <td> <input type="text" name="facility_name[]" {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}  value="{{ isset(unserialize($grid_data->facility_name)[$key]) ? unserialize($grid_data->facility_name)[$key] : '' }}"> </td>
                                                                        <td><input class="id-number" type="text" name="IDnumber[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}  value="{{ isset(unserialize($grid_data->IDnumber)[$key]) ? unserialize($grid_data->IDnumber)[$key] : '' }}"></td>
                                                                        <td><input class="remarks" type="text"  name="Remarks[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}  value="{{ unserialize($grid_data->Remarks)[$key] ? unserialize($grid_data->Remarks)[$key] : '' }}"> </td>
                                                                        <td><input type="text" class="Removebtn" name="Action[]" readonly></td>
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
                                            </div> --}}

                                            <div class="group-input" id="facilityRow"
                                                @if ($data->Facility_Equipment == 'no') style="display: none" @endif>
                                                <label for="audit-agenda-grid">
                                                    Facility/ Equipment/ Instrument/ System Details<span id="asteriskInvifaci"
                                                        style="display: {{ $data->Facility_Equipment == 'yes' ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span>
                                                    <button type="button" name="audit-agenda-grid"
                                                        id="ObservationAdd" {{ $data->stage == 1 ? '' : 'disabled' }}>+</button>
                                                    {{-- <span class="text-primary" data-bs-toggle="modal"
                                                        data-bs-target="#observation-field-instruction-modal"
                                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                        (Launch Instruction)
                                                    </span> --}}
                                                </label>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="onservation-field-table"
                                                        style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 5%">Sr. No.</th>
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
                                                                        <td><input disabled type="text" name="serial[]"
                                                                                value="{{ $key + 1 }}"></td>
                                                                        <td><input type="text" name="facility_name[]" value="{{ isset(unserialize($grid_data->facility_name)[$key]) ? unserialize($grid_data->facility_name)[$key] : '' }}"
                                                                            {{ $data->stage == 1 ? '' : 'disabled' }}></td>
                                                                        <td><input class="id-number" type="text"
                                                                                name="IDnumber[]"
                                                                                value="{{ isset(unserialize($grid_data->IDnumber)[$key]) ? unserialize($grid_data->IDnumber)[$key] : '' }}"
                                                                                {{ $data->stage == 1 ? '' : 'disabled' }}>
                                                                        </td>
                                                                        <td><input class="remarks" type="text"
                                                                                name="Remarks[]"
                                                                                value="{{ unserialize($grid_data->Remarks)[$key] ? unserialize($grid_data->Remarks)[$key] : '' }}"
                                                                                {{ $data->stage == 1 ? '' : 'disabled' }}>
                                                                        </td>
                                                                        <td><button class="removeRowBtn">Remove</button></td>
                                                                    </tr>
                                                                @endforeach
                                                            {{-- @else
                                                                <tr>

                                                                    <td><input type="text" name="facility_name[]"
                                                                            {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                                    </td>
                                                                    <td><input type="text" name="IDnumber[]"
                                                                            {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                                    </td>
                                                                    <td><input type="text" name="Remarks[]"
                                                                            {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                                    </td>
                                                                    <td><button class="removeRowBtn">Remove</button></td>
                                                                </tr> --}}
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
                                                        name="Document_Details_Required"
                                                        id="Document_Details_Required"
                                                        value="{{ $data->Document_Details_Required }}" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
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
                                                        name="audit-agenda-grid"
                                                        value="audit-agenda-grid" id="ReferenceDocument" {{ $data->stage == 1 ? '' : 'disabled' }}>+</button>
                                                    {{-- <span class="text-primary" data-bs-toggle="modal"
                                                        data-bs-target="#observation-field-instruction-modal1"
                                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                        (Launch Instruction)
                                                    </span> --}}
                                                </label>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="ReferenceDocument_details"
                                                        style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 4%">Sr. No.</th>
                                                                <th style="width: 12%">Document Number</th>
                                                                {{--<th style="width: 16%"> Reference Document Name</th>--}}
                                                                <th style="width: 16%">Document Name</th>
                                                                <th style="width: 16%">Remarks</th>
                                                                <th style="width: 8%">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($grid_data1->ReferenceDocumentName)
                                                                @foreach (unserialize($grid_data1->ReferenceDocumentName) as $key => $temps)
                                                                    <tr>
                                                                        <td><input disabled type="text"
                                                                                name="serial[]"
                                                                                value="{{ $key + 1 }}"></td>
                                                                        <td><input class="numberDetail" type="text"
                                                                                name="Number[]"
                                                                                value="{{ unserialize($grid_data1->Number)[$key] ? unserialize($grid_data1->Number)[$key] : '' }}" {{ $data->stage == 1 ? '' : 'disabled' }}>
                                                                        </td>
                                                                        <td><input class="ReferenceDocumentName" type="text"
                                                                                name="ReferenceDocumentName[]"
                                                                                value="{{ unserialize($grid_data1->ReferenceDocumentName)[$key] ? unserialize($grid_data1->ReferenceDocumentName)[$key] : '' }}" {{ $data->stage == 1 ? '' : 'disabled' }}>
                                                                        </td>
                                                                        <td><input class="Document_Remarks" type="text"
                                                                                name="Document_Remarks[]"
                                                                                value="{{ unserialize($grid_data1->Document_Remarks)[$key] ? unserialize($grid_data1->Document_Remarks)[$key] : '' }}" {{ $data->stage == 1 ? '' : 'disabled' }}>
                                                                        </td>
                                                                        <td><button class="removeRowBtn">Remove</button></td>

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
                                                    <label for="Document Details Required">Product / Material Details Required? <span
                                                            class="text-danger">*</span></label>
                                                    <select
                                                        name="Product_Details_Required"
                                                        id="Product_Details_Required"
                                                        value="{{ $data->Product_Details_Required }}" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
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
                                                    <div class="group-input" id="productRow"
                                                        @if ($data->Product_Details_Required == 'no') style="display: none" @endif>
                                                        <label for="audit-agenda-grid">
                                                            Product / Material Details <span id="asteriskInviprod"
                                                                style="display: {{ $data->Product_Details_Required == 'yes' ? 'inline' : 'none' }}"
                                                                class="text-danger">*</span>
                                                            <button type="button" name="audit-agenda-grid"
                                                                id="Product_Details" {{ $data->stage == 1 ? '' : 'disabled' }}>+</button>
                                                            {{-- <span class="text-primary" data-bs-toggle="modal"
                                                                data-bs-target="#observation-field-instruction-modal2"
                                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                                (Launch Instruction)
                                                            </span> --}}
                                                        </label>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="Product_Details_Details"
                                                                style="width: 100%;">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 4%">Sr. No.</th>
                                                                        <th style="width: 12%">Product / Material</th>
                                                                        <th style="width: 16%">Stage</th>
                                                                        <th style="width: 16%">A.R.No. / Batch No</th>
                                                                        <th style="width: 8%">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if ($grid_data2->product_name)
                                                                        @foreach (unserialize($grid_data2->product_name) as $key => $temps)
                                                                            <tr>
                                                                                <td><input disabled type="text"
                                                                                        name="serial[]"
                                                                                        value="{{ $key + 1 }}"></td>
                                                                                <td><input class="productName" type="text"
                                                                                        name="product_name[]"
                                                                                        value="{{ isset(unserialize($grid_data2->product_name)[$key]) ? unserialize($grid_data2->product_name)[$key] : '' }}" {{ $data->stage == 1 ? '' : 'readonly' }}>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" name="product_stage[]"
                                                                                 id="product_stage"
                                                                                        value="{{ isset(unserialize($grid_data2->product_stage)[$key]) ? unserialize($grid_data2->product_stage)[$key] : '' }}" {{ $data->stage == 1 ? '' : 'readonly' }}>

                                                                                </td>
                                                                                <td><input class="productBatchNo" type="text"
                                                                                        name="batch_no[]"
                                                                                        value="{{ isset(unserialize($grid_data2->batch_no)[$key]) ? unserialize($grid_data2->batch_no)[$key] : '' }}" {{ $data->stage == 1 ? '' : 'readonly' }}>
                                                                                </td>
                                                                                <td><button class="removeRowBtn">Remove</button></td>

                                                                            </tr>
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
                                                            var asteriskIcon = document.getElementById('asteriskInviprod');
                                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                        });
                                                    });
                                                </script>
                                            </div>


                                            {{-- <div class="col-md-12">
                                                <div class="group-input">
                                                    <label for="Description Incident">Description of Incident <span
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote" name="Description_incident"
                                                        id="summernote-1" {{ $data->stage == 1 ? '' : 'readonly' }}>{{ $data->Description_incident }}</textarea>
                                                </div>
                                                @error('Description_incident')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}
                                            <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

                                            <div class="col-md-12">
                                                <div class="group-input">
                                                    <label for="Description_incident">Description of Incident <span class="text-danger">*</span></label>
                                                    <div>
                                                        <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                                    </div>
                                                    <textarea name="Description_incident"
                                                              class="froala"
                                                            {{ $data->stage == 1 ? '' : 'readonly' }}>{{ $data->Description_incident }}</textarea>
                                                </div>
                                                @error('Description_incident')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- <style>
                                                .ck.ck-editor__editable_inline[dir=ltr] {
                                                    height: 90px;
                                                }

                                                /* Optional: Hide the "Rich Text Editor" label */
                                                .ck.ck-label {
                                                    display: none !important;
                                                }
                                            </style>

                                            <script>
                                                ClassicEditor
                                                    .create(document.querySelector('#editor'), {
                                                        // You can set or override the label here
                                                        ariaLabel: '', // Empty label to prevent showing "Rich Text Editor"
                                                    })
                                                    .then(editor => {
                                                        // Manually remove any aria-label if it’s added
                                                        const editable = editor.ui.getEditableElement();
                                                        editable.removeAttribute('aria-label');
                                                    })
                                                    .catch(error => {
                                                        console.error(error);
                                                    });
                                            </script> -->

                                            {{-- <div class="col-md-12">
                                                <div class="group-input">
                                                    <label for="Description Incident">Investigation <span
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote" name="investigation"
                                                        id="summernote-1" {{ $data->stage == 1 ? '' : 'readonly' }}>{{ $data->investigation }}</textarea>
                                                </div>
                                                @error('investigation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}

                                            <!-- CKEditor Script -->
                                            <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

                                            <!-- Investigation Field -->
                                            <div class="col-md-12">
                                                <div class="group-input">
                                                    <label for="investigation">Investigation <span class="text-danger">*</span></label>
                                                    <div>
                                                        <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                                    </div>
                                                    <textarea name="investigation"
                                                            class="froala"
                                                            {{ $data->stage == 1 ? '' : 'readonly' }}>{{ $data->investigation }}</textarea>
                                                </div>
                                                @error('investigation')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Optional: Custom height -->
                                            <!-- <style>
                                                .ck.ck-editor__editable_inline[dir=ltr] {
                                                    height: 90px;
                                                }

                                                /* Remove any unexpected CKEditor accessibility labels */
                                                .ck.ck-label {
                                                    display: none !important;
                                                }
                                                .ck-powered-by{
                                                    display: none;
                                                }
                                            </style> -->

                                            <!-- CKEditor Initialization -->
                                            <!-- <script>
                                                ClassicEditor
                                                    .create(document.querySelector('#editor-investigation'), {
                                                        ariaLabel: '', // prevent default label
                                                    })
                                                    .then(editor => {
                                                        const editable = editor.ui.getEditableElement();
                                                        editable.removeAttribute('aria-label');
                                                    })
                                                    .catch(error => {
                                                        console.error(error);
                                                    });
                                            </script> -->
                                                      
                                            <div class="col-md-12">
                                                <div class="group-input">
                                                    <label for="Description Incident">Immediate Corrective Action<span
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="immediate_correction"
                                                    {{ $data->stage == 1 ? '' : 'readonly' }}>{{ $data->immediate_correction }}</textarea>
                                                </div>
                                                @error('immediate_correction')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

        {{--
                                            <div class="col-md-12">
                                                <div class="group-input">
                                                    <label for="Immediate Action">Immediate Action (if any) <span
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Immediate_Action[]" {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        id="summernote-2">{{ $data->Immediate_Action }}</textarea>
                                                </div>
                                                @error('Immediate_Action')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}

                                            {{-- <div class="col-md-12">
                                                <div class="group-input">
                                                    <label for="Preliminary Impact">Preliminary Impact of Incident <span
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Preliminary_Impact[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        id="summernote-3">{{ $data->Preliminary_Impact }}</textarea>
                                                </div>
                                                @error('Preliminary_Impact')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="Audit Attachments">Initial Attachment</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div class="file-attachment-list" id="Audit_file">
                                                            @if ($data->Audit_file)
                                                                @foreach(json_decode($data->Audit_file) as $file)
                                                                    <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name1="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                        <input type="hidden" name="existing_Audit_file[]" value="{{ $file }}">
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input type="file" id="audit_file" name="Audit_file[]" oninput="addMultipleFiles(this, 'Audit_file')" multiple {{ $data->stage == 1 ? '' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hidden field to keep track of files to be deleted -->
                                            <input type="hidden" id="deleted_Audit_file" name="deleted_Audit_file" value="">

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    const removeButtons = document.querySelectorAll('.remove-file');

                                                    removeButtons.forEach(button => {
                                                        button.addEventListener('click', function() {
                                                            const fileName = this.getAttribute('data-file-name1');
                                                            const fileContainer = this.closest('.file-container');

                                                            // Hide the file container
                                                            if (fileContainer) {
                                                                fileContainer.style.display = 'none';
                                                                // Remove hidden input associated with this file
                                                                const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                                if (hiddenInput) {
                                                                    hiddenInput.remove();
                                                                }

                                                                // Add the file name to the deleted files list
                                                                const deletedFilesInput = document.getElementById('deleted_Audit_file');
                                                                let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                                deletedFiles.push(fileName);
                                                                deletedFilesInput.value = deletedFiles.join(',');
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>

                                        </div>
                                        <div class="button-block">
                                            <button
                                                type="submit"
                                                id="ChangesaveButton01" class="saveButton saveAuditFormBtn d-flex"
                                                style="align-items: center;" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>
                                                <div class="spinner-border spinner-border-sm auditFormSpinner"
                                                    style="display: none">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Save
                                            </button>
                                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                            <button type="button"
                                                style=" justify-content: center; width: 4rem; margin-left: 1px;"> <a
                                                    href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                                    Exit </a> </button>

                                        </div>
                                    </div>
                                </div>
                                <!-- ----------hod Review-------- -->
                                <div id="CCForm8" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                    <div class="group-input">
                                                        <label for="HOD Remarks">Review Of Incident And Verification Of Effectiveness Of Correction <span class="text-danger">{{$data->stage==2 ? '*' : ''}}</span></label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="review_of_verific" {{ $data->stage == 2 ? '' : 'readonly' }}>{{ $data->review_of_verific }}</textarea>
                                                    </div>

                                                @error('review_of_verific')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <div class="group-input">
                                                    <label for="HOD Remarks">Recommendations  <span class="text-danger">{{$data->stage==2 ? '*' : ''}}</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Recommendations" id="summernote-4" {{ $data->stage == 2 ? '' : 'readonly' }}>{{ $data->Recommendations }}</textarea>
                                                </div>

                                            @error('Recommendations')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <div class="group-input">
                                                <label for="HOD Remarks">Impact Assessment  <span class="text-danger">{{$data->stage==2 ? '*' : ''}}</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="Impact_Assessmenta" {{ $data->stage == 2 ? '' : 'readonly' }}>{{ $data->Impact_Assessmenta }}</textarea>
                                            </div>

                                        @error('Impact_Assessment')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="Comments"> HOD Remark  <span
                                                class="text-danger">*</span></label>
                                            <textarea name="HOD_Remarks" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>{{ $data->HOD_Remarks }}</textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-12">
                                        @if ($data->stage == 2)
                                            <div class="group-input">
                                                <label for="HOD Remark">HOD Remark<span
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="HOD_Remarks" id="summernote-4" required {{ $data->stage == 2 ? '' : 'readonly' }}>{{ $data->HOD_Remarks }}</textarea>
                                            </div>
                                        @else
                                            <div class="group-input">
                                                <label for="HOD Remark">HOD Remark</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea  class="tiny" name="HOD_Remarks" id="summernote-4" {{ $data->stage == 2 ? '' : 'readonly' }}>{{ $data->HOD_Remarks }}</textarea>
                                            </div>
                                        @endif
                                        @error('HOD_Remarks')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                             <div class="col-12">
                                                @if ($data->stage == 2)
                                                    {{-- <div class="group-input">
                                                        <label for="Inv Attachments">HOD Attachments</label>
                                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                                documents</small></div>
                                                        <div class="file-attachment-field">
                                                            <div disabled class="file-attachment-list" id="hod_attachments">
                                                                @if ($data->hod_attachments)
                                                                    @foreach (json_decode($data->hod_attachments) as $file)
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
                                                                     type="file" id="hod_attachments"
                                                                    name="hod_attachments[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                                    oninput="addMultipleFiles(this, 'hod_attachments')" multiple>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    <div class="group-input">
                                                        <label for="HOD Attachments">HOD Attachments</label>
                                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                        <div class="file-attachment-field">
                                                            <div class="file-attachment-list" id="hod_attachments">
                                                                @if ($data->hod_attachments)
                                                                    @foreach(json_decode($data->hod_attachments) as $file)
                                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                                            <b>{{ $file }}</b>
                                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                                            <a type="button" class="remove-file" data-file-name2="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                            <input type="hidden" name="existing_hod_attachments[]" value="{{ $file }}">
                                                                        </h6>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            <div class="add-btn">
                                                                <div>Add</div>
                                                                <input type="file" id="hod_attachments" name="hod_attachments[]" oninput="addMultipleFiles(this, 'hod_attachments')" multiple {{ $data->stage == 2 ? '' : 'disabled' }}>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Hidden field to keep track of files to be deleted -->
                                                    <input type="hidden" id="deleted_hod_attachments" name="deleted_hod_attachments" value="">

                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            const removeButtons = document.querySelectorAll('.remove-file');

                                                            removeButtons.forEach(button => {
                                                                button.addEventListener('click', function() {
                                                                    const fileName = this.getAttribute('data-file-name2');
                                                                    const fileContainer = this.closest('.file-container');

                                                                    // Hide the file container
                                                                    if (fileContainer) {
                                                                        fileContainer.style.display = 'none';
                                                                        // Remove hidden input associated with this file
                                                                        const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                                        if (hiddenInput) {
                                                                            hiddenInput.remove();
                                                                        }

                                                                        // Add the file name to the deleted files list
                                                                        const deletedFilesInput = document.getElementById('deleted_hod_attachments');
                                                                        let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                                        deletedFiles.push(fileName);
                                                                        deletedFilesInput.value = deletedFiles.join(',');
                                                                    }
                                                                });
                                                            });
                                                        });
                                                    </script>
                                                @else
                                                    <div class="group-input">
                                                        <label for="Inv Attachments">HOD Attachments</label>
                                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                                documents</small></div>
                                                        <div class="file-attachment-field">
                                                            <div disabled class="file-attachment-list" id="hod_attachments">
                                                                @if ($data->hod_attachments)
                                                                    @foreach (json_decode($data->hod_attachments) as $file)
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

                                                                    type="file" id="hod_attachments"
                                                                    name="hod_attachments[]"
                                                                    oninput="addMultipleFiles(this, 'hod_attachments')" multiple {{ $data->stage == 2 ? '' : 'disabled' }}>
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

                                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                                type="submit"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                                class="saveButton saveAuditFormBtn d-flex" style="align-items: center;"
                                                id="ChangesaveButton02">
                                                <div class="spinner-border spinner-border-sm auditFormSpinner"
                                                    style="display: none" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Save
                                            </button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                            class="backButton" onclick="previousStep()">Back</button>
                                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                                type="button"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                class="nextButton" onclick="nextStep()">Next</button>
                                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                                type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                                    Exit </a>
                                            </button>
                                            {{-- @if (
                                                $data->stage == 2 ||
                                                    $data->stage == 3 ||
                                                    $data->stage == 4 ||
                                                    $data->stage == 5 ||
                                                    $data->stage == 6 ||
                                                    $data->stage == 7) --}}
                                                {{-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;;"
                                                    type="button" class="button  launch_extension" data-bs-toggle="modal"
                                                    data-bs-target="#launch_extension">
                                                    Launch Extension
                                                </a> --}}
                                            {{-- @endif --}}
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


                                    // Function to handle the change event of the Initial Incident Category dropdown
                                    function handleincidentCategoryChange() {
                                        var selectElement = document.getElementById("incident_category");
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
                                        $('#incident_category, #Investigation_required, #qrm_required, #capa_required').change(
                                            function() {
                                                // Get the selected values
                                                var incidentCategory = $('#incident_category').val();
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
                                        $('#incident_category').change(function() {
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


                                        $('#incident_category').change(function() {
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
                                        <div class="form-section">
                                            <!-- Incident Fields Section -->
                                            <div>
                                                <!-- Product Quality Impact -->
                                                <div class="main-group">
                                                    <div>
                                                        <label>Product Quality Impact: <span class="text-danger">{{ $data->stage == 3 ? '*' : ''}}</span></label>
                                                    </div><div class="checkbox-group">
                                                    <input type="checkbox" name="product_quality_imapct" value="Yes" onclick="selectOne(this)" {{ $data->product_quality_imapct == 'Yes' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> Yes
                                                    <input type="checkbox" name="product_quality_imapct" value="No" onclick="selectOne(this)" {{ $data->product_quality_imapct == 'No' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> No
                                                    <input type="checkbox" name="product_quality_imapct" value="NA" onclick="selectOne(this)" {{ $data->product_quality_imapct == 'NA' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> N/A
                                                </div>
                                                </div>
                                                <br>

                                                <!-- Process Performance Impact -->
                                                <div class="main-group">
                                                    <div>
                                                     <label>Process Performance Impact: <span class="text-danger">{{$data->stage==3 ? '*' : ''}}</span></label>
                                                    </div>                                                <div class="checkbox-group">
                                                    <input type="checkbox" name="process_performance_impact" value="Yes" onclick="selectOne(this)" {{ $data->process_performance_impact == 'Yes' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> Yes
                                                    <input type="checkbox" name="process_performance_impact" value="No" onclick="selectOne(this)"{{ $data->process_performance_impact == 'No' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> No
                                                    <input type="checkbox" name="process_performance_impact" value="NA" onclick="selectOne(this)" {{ $data->process_performance_impact == 'NA' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> NA
                                                </div>
                                                </div>
                                                <br>

                                                <!-- Yield Impact -->
                                                <div class="main-group">
                                                    <div>
                                                        <label>Yield Impact:<span class="text-danger">{{$data->stage==3 ? '*' : ''}}</span></label>
                                                    </div>
                                                    <div class="checkbox-group">
                                                    <input type="checkbox" name="yield_impact" value="Yes" onclick="selectOne(this)" {{ $data->yield_impact == 'Yes' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> Yes
                                                    <input type="checkbox" name="yield_impact" value="No" onclick="selectOne(this)" {{ $data->yield_impact == 'No' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> No
                                                    <input type="checkbox" name="yield_impact" value="NA" onclick="selectOne(this)" {{ $data->yield_impact == 'NA' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> N/A
                                                </div>
                                                </div>
                                                <br>

                                                <!-- GMP Impact -->
                                                <div class="main-group">
                                                    <div>
                                                        <label>GMP Impact: <span class="text-danger">{{$data->stage==3 ? '*' : ''}}</span></label>
                                                    </div>                                                <div class="checkbox-group">
                                                    <input type="checkbox" name="gmp_impact" value="Yes" onclick="selectOne(this)" {{ $data->gmp_impact == 'Yes' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> Yes
                                                    <input type="checkbox" name="gmp_impact" value="No" onclick="selectOne(this)" {{ $data->gmp_impact == 'No' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> No
                                                    <input type="checkbox" name="gmp_impact" value="NA" onclick="selectOne(this)" {{ $data->gmp_impact == 'NA' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> NA
                                                  </div>
                                                </div>
                                                <br>

                                                <!-- Additional Testing Required -->
                                                <div class="main-group">
                                                    <div>
                                                        <label>Additional Testing Required: <span class="text-danger">{{$data->stage==3 ? '*' : ''}}</span></label>
                                                    </div>
                                                    <div class="checkbox-group">
                                                    <input type="checkbox" name="additionl_testing_required" value="Yes" onclick="selectOne(this)" {{ $data->additionl_testing_required == 'Yes' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> Yes
                                                    <input type="checkbox" name="additionl_testing_required" value="No" onclick="selectOne(this)" {{ $data->additionl_testing_required == 'No' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> No
                                                    <input type="checkbox" name="additionl_testing_required" value="NA" onclick="selectOne(this)" {{ $data->additionl_testing_required == 'NA' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> NA
                                                </div>
                                                </div>
                                                <br>

                                                <!-- If Yes, Then Mention -->

                                              </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="Comments"> If Yes, Then Mention:<span class="text-danger">{{$data->stage==3 ? '*' : ''}}</span></label>
                                                    <textarea name="any_similar_incident_in_past" {{ $data->stage == 3 ? '' : 'readonly' }}>{{ $data->any_similar_incident_in_past}}</textarea>
                                                </div>
                                            </div>



                                            <!-- Vertical Line Divider -->
                                            <div class="divider"></div>

                                            <!-- Right Column -->
                                            <div>
                                                <!-- Similar Incident in Past -->
                                                <div class="main-group">
                                                    <div>
                                                        <label>Any Similar Incident in Past:<span class="text-danger">{{$data->stage==3 ? '*' : ''}}</span></label>
                                                    </div>
                                                    <div class="checkbox-group">
                                                    <input type="checkbox" name="capa_require" value="Yes" onclick="selectOne(this)" {{ $data->capa_require == 'Yes' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> Yes
                                                    <input type="checkbox" name="capa_require" value="No" onclick="selectOne(this)" {{ $data->capa_require == 'No' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> No
                                                    <input type="checkbox" name="capa_require" value="NA" onclick="selectOne(this)" {{ $data->capa_require == 'NA' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> NA
                                                </div>
                                                </div>
                                                <br>

                                                <!-- Classification by QA -->
                                                <div class="main-group">
                                                    <div>
                                                        <label>Classification by QA: <span class="text-danger">{{$data->stage==3 ? '*' : ''}}</span></label>
                                                    </div>
                                                    <div class="checkbox-group">
                                                    <input type="checkbox" name="classification_by_qa" value="Critical" onclick="selectOne(this)" {{ $data->classification_by_qa == 'Critical' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> Critical
                                                    <input type="checkbox" name="classification_by_qa" value="Non-critical" onclick="selectOne(this)" {{ $data->classification_by_qa == 'Non-critical' ? 'checked' : '' }} {{ $data->stage == 3 ? '' : 'readonly' }}> Non-Critical
                                                </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            @if ($data->stage == 3)
                                                <div class="group-input">
                                                    <label for="HOD Remarks">QA Initial Review Remarks <span
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea  name="QAInitialRemark" required {{ $data->stage == 3 ? '' : 'readonly' }}>{{ $data->QAInitialRemark }}</textarea>
                                                </div>
                                            @else
                                                <div class="group-input">
                                                    <label for="QA Initial Review Remarks">QA Initial Review Remarks</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea name="QAInitialRemark" {{ $data->stage == 3 ? '' : 'readonly' }}>{{ $data->QAInitialRemark }}</textarea>
                                                </div>
                                            @endif
                                            {{-- @error('QAInitialRemark')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror --}}
                                        </div>
                                             {{-- <div class="col-12">
                                                <div class="group-input">
                                                    <label for="QA Initial Attachments">QA Initial Review Attachments </label>
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
                                                                name="Initial_attachment[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>   --}}
                                             <div class="col-12">
                                                <div class="group-input">
                                                    <label for="QA Initial Attachments">QA Initial Review Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div class="file-attachment-list" id="file-list">
                                                            @if ($data->Initial_attachment)
                                                                @foreach(json_decode($data->Initial_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                                        <a type="button" class="remove-file" data-file-name3="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                        <input type="hidden" name="existing_Initial_attachment[]" value="{{ $file }}">
                                                                    </h6>
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                        <!-- Updated the ID of the input -->
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input type="file" id="file-input" name="Initial_attachment[]" multiple {{ $data->stage == 3 ? '' : 'disabled' }}>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hidden field to keep track of files to be deleted -->
                                            <input type="hidden" id="deleted_Initial_attachment" name="deleted_Initial_attachment" value="">

                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    const fileInput = document.getElementById('file-input');
                                                    const fileList = document.getElementById('file-list');
                                                    const deletedFilesInput = document.getElementById('deleted_Initial_attachment');

                                                    // Handle file removal
                                                    function handleFileRemoval() {
                                                        const removeButtons = document.querySelectorAll('.remove-file');

                                                        removeButtons.forEach(button => {
                                                            button.addEventListener('click', function() {
                                                                const fileName = this.getAttribute('data-file-name3');
                                                                const fileContainer = this.closest('.file-container');

                                                                // Hide the file container
                                                                if (fileContainer) {
                                                                    fileContainer.style.display = 'none';

                                                                    // Add the file name to the deleted files list
                                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                                    deletedFiles.push(fileName);
                                                                    deletedFilesInput.value = deletedFiles.join(',');

                                                                    // Remove hidden input associated with this file
                                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                                    if (hiddenInput) {
                                                                        hiddenInput.remove();
                                                                    }
                                                                }
                                                            });
                                                        });
                                                    }

                                                    // Add files dynamically without removing the existing ones
                                                    fileInput.addEventListener('change', function() {
                                                        const files = Array.from(fileInput.files);

                                                        files.forEach((file, index) => {
                                                            const fileName = file.name;
                                                            const fileContainer = document.createElement('h6');
                                                            fileContainer.classList.add('file-container', 'text-dark');
                                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                                            fileContainer.innerHTML = `
                                                                <b>${fileName}</b>
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                                <a type="button" class="remove-file"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                <input type="hidden" name="new_Initial_attachment[]" value="${fileName}">
                                                            `;

                                                            fileList.appendChild(fileContainer);
                                                        });

                                                        // Rebind the remove-file click events
                                                        handleFileRemoval();
                                                    });

                                                    // Initial binding of remove buttons
                                                    handleFileRemoval();
                                                });
                                            </script>

                                                                 {{-- <div class="col-md-12">
                                                <div class="group-input">
                                                    <label for="QAInitialRemark">QA Initial Remarks <span
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data->stage == 3) required @endif class="summernote QAInitialRemark"
                                                        name="QAInitialRemark"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }} id="summernote-6">{{ $data->QAInitialRemark }}</textarea>
                                                </div>
                                                @error('QAInitialRemark')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>  --}}

                                        {{-- @if ($data->stage == 3)
                                            <div class="row">

                                                <div style="margin-bottom: 0px;" class="col-lg-12 new-date-data-field ">
                                                    <div class="group-input input-date">

                                                        @if ($data->stage == 3)
                                                            <label for="Incident category">Initial Incident category <span
                                                                    class="text-danger">*</span></label>
                                                            <select id="incident_category"
                                                                name="incident_category"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                                value="{{ $data->incident_category }}"
                                                                onchange="handleincidentCategoryChange()" required>
                                                                <option value="0">-- Select --</option>
                                                                <option @if ($data->incident_category == 'minor') selected @endif
                                                                    value="minor">Minor</option>
                                                                <option @if ($data->incident_category == 'major') selected @endif
                                                                    value="major">Major</option>
                                                                <option @if ($data->incident_category == 'critical') selected @endif
                                                                    value="critical">Critical</option>
                                                            </select>
                                                        @else
                                                            <label for="Incident category">Initial Incident category</label>
                                                            <select id="incident_category"
                                                                name="incident_category"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                                onchange="handleincidentCategoryChange()"
                                                                value="{{ $data->incident_category }}">
                                                                <option value="0">-- Select --</option>
                                                                <option @if ($data->incident_category == 'minor') selected @endif
                                                                    value="minor">Minor</option>
                                                                <option @if ($data->incident_category == 'major') selected @endif
                                                                    value="major">Major</option>
                                                                <option @if ($data->incident_category == 'critical') selected @endif
                                                                    value="critical">Critical</option>
                                                            </select>
                                                        @endif

                                                        @error('incident_category')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                        @endif --}}
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

                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="QRM Required">QRM Required ? <span class="text-danger">*</span></label>
                                                <select
                                                    name="qrm_required"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
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
                                        </div> --}}

                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Investigation required">Investigation Required? <span
                                                        class="text-danger">*</span></label>
                                                <select
                                                    name="Investigation_required"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
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
                                                            name="Justification_for_categorization"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
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
                                                            name="Justification_for_categorization"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
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
                                                        name="Investigation_Details"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
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

                                            {{-- <div class="col-md-12">
                                                <div class="group-input">
                                                    <label for="QAInitialRemark">QA Initial Remarks <span
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data->stage == 3) required @endif class="summernote QAInitialRemark"
                                                        name="QAInitialRemark"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }} id="summernote-6">{{ $data->QAInitialRemark }}</textarea>
                                                </div>
                                                @error('QAInitialRemark')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}
                                            {{-- <div class="col-12">
                                                <div class="group-input">
                                                    <label for="QA Initial Attachments">QA Initial Attachments </label>
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
                                                                name="Initial_attachment[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Initial_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                   --}}

                                    <div class="button-block">
                                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                        type="submit"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                        class="saveButton saveAuditFormBtn d-flex" style="align-items: center;"
                                        id="ChangesaveButton02">
                                        <div class="spinner-border spinner-border-sm auditFormSpinner"
                                            style="display: none" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        Save
                                    </button>
                                    <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="backButton" onclick="previousStep()">Back</button>
                                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                            type="button"
                                            class="nextButton" onclick="nextStep()">Next</button>
                                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button">
                                            <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                                Exit </a> </button>
                                        {{--@if (
                                            $data->stage == 2 ||
                                                $data->stage == 3 ||
                                                $data->stage == 4 ||
                                                $data->stage == 5 ||
                                                $data->stage == 6 ||
                                                $data->stage == 7)--}}
                                            {{-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                                class="button  launch_extension" data-bs-toggle="modal"
                                                data-bs-target="#launch_extension">
                                                Launch Extension
                                            </a> --}}
                                        {{--@endif--}}
                                        <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                                            data-bs-target="#effectivenss_extension">
                                                            Launch Effectiveness Check
                                                        </a> -->
                                    </div>
                                </div>
                            </div>
                            {{-- <script>
                                var checkValue = false;
                                $(document).ready(function() {
                                    $('#incident_category').change(function() {
                                        if ($(this).val() === 'major' || $(this).val() === 'critical') {
                                            checkValue = true;
                                            $('#Investigation_required').val('yes').prop('disabled', true);
                                            $('#capa_required').val('yes').prop('disabled', true);
                                            $('#qrm_required').val('yes').prop('disabled', true);
                                            $('#Customer_notification').val('yes').prop('disabled', true);
                                            var asteriskIcon = document.getElementById('asteriskInviinvestication');
                                            var a steriskIcon2 = document.getElementById('asterikCustomer_notification');
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
                            </script> --}}

{{--Add new tab--}}

                    <!-- ----------QA HEAD Designee Approval-------- -->
                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="col-12 sub-head">
                                QA Head/Designee Approval
                            </div>


                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    @if ($data->stage == 4)
                                    <div class="group-input">
                                        <label for="HOD Remarks">QA Head/Designee Approval Comment<span
                                            class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="qa_head_deginee_comment" id="summernote-4" required {{ $data->stage == 4 ? '' : 'readonly' }}>{{ $data->qa_head_deginee_comment }}</textarea>
                                    </div>
                                    @else
                                    <div class="group-input">
                                        <label for="HOD Remarks">QA Head/Designee Approval Comment</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="qa_head_deginee_comment" id="summernote-4" {{ $data->stage == 4 ? '' : 'readonly' }}>{{ $data->qa_head_deginee_comment }}</textarea>
                                    </div>
                                     @endif
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">QA Head/Designee Approval Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_Desinee_attachments">
                                                @if ($data->qa_head_deginee_attachments)
                                                @foreach (json_decode($data->qa_head_deginee_attachments) as $file)
                                                    <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file" data-file-name4="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                        <input type="hidden" name="existing_qa_head_deginee_attachments[]" value="{{ $file }}">
                                                    </h6>
                                                @endforeach
                                            @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="qa_head_deginee_attachments[]"
                                                    oninput="addMultipleFiles(this, 'QA_Desinee_attachments')" multiple {{ $data->stage == 4 ? '' : 'disabled' }}>
                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const removeButtons = document.querySelectorAll('.remove-file');

                                                removeButtons.forEach(button => {
                                                    button.addEventListener('click', function() {
                                                        const fileName = this.getAttribute('data-file-name4');
                                                        const fileContainer = this.closest('.file-container');

                                                        // Hide the file container
                                                        if (fileContainer) {
                                                            fileContainer.style.display = 'none';
                                                            // Remove hidden input associated with this file
                                                            const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                            if (hiddenInput) {
                                                                hiddenInput.remove();
                                                            }

                                                            // Add the file name to the deleted files list
                                                            const deletedFilesInput = document.getElementById('deleted_qa_head_deginee_attachments');
                                                            let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                            deletedFiles.push(fileName);
                                                            deletedFilesInput.value = deletedFiles.join(',');
                                                        }
                                                    });
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>

                            </div>
                            <div class="button-block">
                                <button type="submit" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="saveButton" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Save </button>

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


                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">

                            <div class="row">
                                <div class="form-section">
                                    <!-- Incident Fields Section -->
                                    <div>
                                        <!-- Product Quality Impact -->
                                        <div class="main-group">
                                            <div>
                                                <label>CAPA Implementation:<span class="text-danger">{{$data->stage==5 ? '*' : ''}}</span></label>
                                            </div>
                                            <div class="checkbox-group">
                                            <input type="checkbox" name="capa_implementation" value="Yes" onclick="selectOne(this)" {{ $data->capa_implementation == 'Yes' ? 'checked' : '' }}> Yes
                                            <input type="checkbox" name="capa_implementation" value="No" onclick="selectOne(this)" {{ $data->capa_implementation == 'No' ? 'checked' : '' }}> No
                                            <input type="checkbox" name="capa_implementation" value="NA" onclick="selectOne(this)" {{ $data->capa_implementation == 'NA' ? 'checked' : '' }}> N/A
                                        </div>
                                        </div>
                                        <br>

                                        <!-- Process Performance Impact -->
                                        <div class="main-group">
                                            <div>
                                             <label>All check points compiled with (Documentary evidence shall be attached or referred to):<span class="text-danger">{{$data->stage==5 ? '*' : ''}}</span></label>
                                            </div>
                                           <div class="checkbox-group">
                                            <input type="checkbox" name="check_points" value="Yes" onclick="selectOne(this)" {{ $data->check_points == 'Yes' ? 'checked' : '' }}> Yes
                                            <input type="checkbox" name="check_points" value="No" onclick="selectOne(this)" {{ $data->check_points == 'No' ? 'checked' : '' }}> No
                                            <input type="checkbox" name="check_points" value="NA" onclick="selectOne(this)" {{ $data->check_points == 'NA' ? 'checked' : '' }}> N/A
                                        </div>
                                        </div>
                                        <br>
                                        <div class="main-group">
                                            <div>
                                             <label>Based upon the assessment of the corrective actions planned, whether unplanned deviation is required:<span class="text-danger">{{$data->stage==5 ? '*' : ''}}</span></label>
                                            </div>
                                           <div class="checkbox-group">
                                            <input type="checkbox" name="corrective_actions" value="Yes" onclick="selectOne(this)" {{ $data->corrective_actions == 'Yes' ? 'checked' : '' }}> Yes
                                            <input type="checkbox" name="corrective_actions" value="No" onclick="selectOne(this)" {{ $data->corrective_actions == 'No' ? 'checked' : '' }}> No
                                            <input type="checkbox" name="corrective_actions" value="NA" onclick="selectOne(this)" {{ $data->corrective_actions == 'NA' ? 'checked' : '' }}> N/A
                                        </div>
                                        </div>
                                        <br>

                                        <!-- Yield Impact -->
                                        <div class="main-group">
                                            <div>
                                                <label>Batch release satisfactory:<span class="text-danger">{{$data->stage==5 ? '*' : ''}}</span></label>
                                            </div>
                                            <div class="checkbox-group">
                                            <input type="checkbox" name="batch_release" value="Yes" onclick="selectOne(this)" {{ $data->batch_release == 'Yes' ? 'checked' : '' }}> Yes
                                            <input type="checkbox" name="batch_release" value="No" onclick="selectOne(this)" {{ $data->batch_release == 'No' ? 'checked' : '' }}> No
                                            <input type="checkbox" name="batch_release" value="NA" onclick="selectOne(this)" {{ $data->batch_release == 'NA' ? 'checked' : '' }}> N/A
                                        </div>
                                        </div>
                                        <br>
                                        {{-- <div class="col-md-12 mb-3">
                                            <div class="group-input">
                                                <label for="Closure">Closure</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                                <textarea class="tiny" name="closure_ini" {{ $data->closure_ini }}></textarea>
                                            </div>
                                        </div> --}}

                                        <!-- GMP Impact -->
                                        <div class="main-group">
                                            <div>
                                                <label>Affected documents closed: <span class="text-danger">{{$data->stage==5 ? '*' : ''}}</span></label>
                                            </div>
                                            <div class="checkbox-group">
                                            <input type="checkbox" name="affected_documents" value="Yes" onclick="selectOne(this)" {{ $data->affected_documents == 'Yes' ? 'checked' : '' }}> Yes
                                            <input type="checkbox" name="affected_documents" value="No" onclick="selectOne(this)" {{ $data->affected_documents == 'No' ? 'checked' : '' }}> No
                                            <input type="checkbox" name="affected_documents" value="NA" onclick="selectOne(this)" {{ $data->affected_documents == 'NA' ? 'checked' : '' }}> N/A
                                          </div>
                                        </div>


                                        <!-- Additional Testing Required -->



                                    </div>
                                </div>

                                <div class="col-md-12">
                                    @if ($data->stage == 5)
                                        <div class="group-input">
                                            <label for="HOD Remarks">Initiator Update Comments <span
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea  name="QA_Feedbacks" required {{ $data->stage == 5 ? '' : 'readonly' }}>{{ $data->QA_Feedbacks }}</textarea>
                                        </div>
                                    @else
                                        <div class="group-input">
                                            <label for="Initiator Update Comments">Initiator Update Comments</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea name="QA_Feedbacks" {{ $data->stage == 5 ? '' : 'readonly' }}>{{ $data->QA_Feedbacks }}</textarea>
                                        </div>
                                    @endif
                                    @error('QA_Feedbacks')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Closure Attachments">Initiator Update Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Initator_attachments">

                                                @if ($data->QA_attachments)
                                                @foreach (json_decode($data->QA_attachments) as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}"
                                                            target="_blank"><i class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file"
                                                            data-file-name5="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            {{-- @endif --}}
                                            @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="QA_attachments[]"
                                                    oninput="addMultipleFiles(this, 'Initator_attachments')" multiple {{ $data->stage == 5 ? '' : 'disabled' }}>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-12 sub-head">
                                    Effectiveness Check Details
                                </div> -->
                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Effectiveness Check Required">Effectiveness Check
                                            Required?</label>
                                        <select name="effect_check" onChange="setCurrentDate(this.value)">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div> -->
                                <!-- <div class="col-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="EffectCheck Creation Date">Effectiveness Check Creation Date</label>
                                        {{-- <input type="date" name="effect_check_date"> --}}
                                        <div class="calenderauditee">
                                            <input type="text" name="effect_check_date" id="effect_check_date" readonly
                                                placeholder="DD-MM-YYYY" />
                                            <input type="date" name="effect_check_date" class="hide-input"
                                                oninput="handleDateInput(this, 'effect_check_date')" />
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="col-6">
                                    <div class="group-input">
                                        <label for="Effectiveness_checker">Effectiveness Checker</label>
                                        <select id="select-state" placeholder="Select..." name="Effectiveness_checker">
                                            <option value="">Select a person</option>
                                            @foreach ($users as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->
                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="effective_check_plan">Effectiveness Check Plan</label>
                                        <textarea name="effective_check_plan"></textarea>
                                    </div>
                                </div> -->


                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Save</button>
                                 <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>



                            {{-- Qa Head  Approved --}}
                            <div id="CCForm17" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if ($data->stage == 6)
                                                <div class="group-input">
                                                    <label for="QA Feedbacks">HOD Final Review Comments <span class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                                            require completion</small></div>
                                                    <textarea class="tiny" name="qa_head_Remarks"
                                                        id="summernote-14" required {{ $data->stage == 6 ? '' : 'readonly' }}>{{ $data->qa_head_Remarks }}</textarea>
                                                </div>
                                            @else
                                                <div class="group-input">
                                                    <label for="QA Feedbacks">HOD Final Review  Comments</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                                            require completion</small></div>
                                                    <textarea  class="tiny"
                                                        name="qa_head_Remarks" id="summernote-14" {{ $data->stage == 6 ? '' : 'readonly' }}>{{ $data->qa_head_Remarks }}</textarea>
                                                </div>
                                            @endif
                                            @error('qa_head_Remarks')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Closure Attachments">HOD Final Review Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="qa_attachment">
                                                        @if ($data->qa_head_attachments)
                                                            @foreach (json_decode($data->qa_head_attachments) as $file)
                                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                                    <a type="button" class="remove-file" data-file-name6="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                                    <input type="hidden" name="existing_qa_head_attachments[]" value="{{ $file }}">
                                                                </h6>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="qa_head_attachments" name="qa_head_attachments[]" oninput="addMultipleFiles(this, 'qa_attachment')" multiple {{ $data->stage == 6 ? '' : 'disabled' }}>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hidden field to keep track of files to be deleted -->
                                        <input type="hidden" id="deleted_qa_head_attachments" name="deleted_qa_head_attachments" value="">

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const removeButtons = document.querySelectorAll('.remove-file');

                                                removeButtons.forEach(button => {
                                                    button.addEventListener('click', function() {
                                                        const fileName = this.getAttribute('data-file-name6');
                                                        const fileContainer = this.closest('.file-container');

                                                        // Hide the file container
                                                        if (fileContainer) {
                                                            fileContainer.style.display = 'none';
                                                            // Remove hidden input associated with this file
                                                            const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                            if (hiddenInput) {
                                                                hiddenInput.remove();
                                                            }

                                                            // Add the file name to the deleted files list
                                                            const deletedFilesInput = document.getElementById('deleted_qa_head_attachments');
                                                            let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                            deletedFiles.push(fileName);
                                                            deletedFilesInput.value = deletedFiles.join(',');
                                                        }
                                                    });
                                                });
                                            });
                                        </script>

                                        <!-- <div class="col-12 sub-head">
                                            Effectiveness Check Details
                                        </div> -->
                                        <!-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Effectiveness Check Required">Effectiveness Check
                                                    Required?</label>
                                                <select name="effect_check" onChange="setCurrentDate(this.value)">
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="EffectCheck Creation Date">Effectiveness Check Creation Date</label>
                                                {{-- <input type="date" name="effect_check_date"> --}}
                                                <div class="calenderauditee">
                                                    <input type="text" name="effect_check_date" id="effect_check_date" readonly
                                                        placeholder="DD-MM-YYYY" />
                                                    <input type="date" name="effect_check_date" class="hide-input"
                                                        oninput="handleDateInput(this, 'effect_check_date')" />
                                                </div>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-6">
                                            <div class="group-input">
                                                <label for="Effectiveness_checker">Effectiveness Checker</label>
                                                <select id="select-state" placeholder="Select..." name="Effectiveness_checker">
                                                    <option value="">Select a person</option>
                                                    @foreach ($users as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="effective_check_plan">Effectiveness Check Plan</label>
                                                <textarea name="effective_check_plan"></textarea>
                                            </div>
                                        </div> -->


                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Save</button>
                                         <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>


                    <!-- QA Final Review -->
                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-md-12">
                                    @if ($data->stage == 7)
                                        <div class="group-input">
                                            <label for="QA Feedbacks">QA Final Review Comments <span class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                                    require completion</small></div>
                                            <textarea class="tiny" name="qa_final_review"
                                                id="summernote-14" required>{{ $data->qa_final_review }}</textarea>
                                        </div>
                                    @else
                                        <div class="group-input">
                                            <label for="QA Feedbacks">QA Final Review Comments</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                                    require completion</small></div>
                                            <textarea  class="tiny"
                                                name="qa_final_review"  id="summernote-14" {{ $data->stage == 7 ? '' : 'readonly' }}>{{ $data->qa_final_review }}</textarea>
                                        </div>
                                    @endif
                                    @error('QA_Feedbacks')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA attachments">QA Final Review Attachments </label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="QA_Final_attachments">
                                                @if ($data->qa_final_ra_attachments)
                                                    @foreach (json_decode($data->qa_final_ra_attachments) as $file)
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
                                                <input  type="file" id="myfile"
                                                    name="qa_final_ra_attachments[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'QA_Final_attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA attachments">QA Final Review Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_Final_attachments">
                                                @if ($data->qa_final_ra_attachments)
                                                    @foreach (json_decode($data->qa_final_ra_attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file" data-file-name7="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            <input type="hidden" name="existing_qa_final_ra_attachments[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="qa_final_ra_attachments" name="qa_final_ra_attachments[]" oninput="addMultipleFiles(this, 'QA_Final_attachments')" multiple {{ $data->stage == 7 ? '' : 'disabled' }}>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_qa_final_ra_attachments" name="deleted_qa_final_ra_attachments" value="">

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeButtons = document.querySelectorAll('.remove-file');

                                        removeButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const fileName = this.getAttribute('data-file-name7');
                                                const fileContainer = this.closest('.file-container');

                                                // Hide the file container
                                                if (fileContainer) {
                                                    fileContainer.style.display = 'none';
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById('deleted_qa_final_ra_attachments');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });
                                </script>


                            </div>
                            <div class="button-block">
                                <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                    type="submit"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                    id="ChangesaveButton05" class="saveAuditFormBtn d-flex" style="align-items: center;">
                                    <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none"
                                        role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Save
                                </button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                {{--<button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                    type="button"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                    class="nextButton" onclick="nextStep()">Next</button>--}}
                                <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a
                                        href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>

                                @if (
                                    $data->stage == 2 ||
                                        $data->stage == 3 ||
                                        $data->stage == 4 ||
                                        $data->stage == 5 ||
                                        $data->stage == 6 ||
                                        $data->stage == 7)
                                    {{-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                        class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#launch_extension">
                                        Launch Extension
                                    </a> --}}
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
                                {{-- <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Post Categorization Of Incident">Post Categorization Of Incident</label>
                                        <div><small class="text-primary">Please Refer Intial Incident category before
                                                updating.</small></div>
                                        <select
                                            name="Post_Categorization"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
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
                                </div> --}}

                                {{-- <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Investigation Of Revised Categorization">Justification for Revised Category
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                                completion</small></div>
                                        <textarea  class="tiny"
                                            name="Investigation_Of_Review"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                            id="summernote-13">{{ $data->Investigation_Of_Review }}</textarea>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Closure Comments">Closure Comments <span class="text-danger">
                                                @if ($data->stage == 8)
                                                    *
                                                @else
                                                @endif
                                            </span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                                completion</small></div>
                                        <textarea   class="tiny"
                                            name="Closure_Comments"  id="summernote-15" {{ $data->stage == 8 ? '' : 'readonly' }}>{{ $data->Closure_Comments }}</textarea>
                                    </div>
                                    @error('Closure_Comments')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Disposition of Batch">Disposition of Batch <span class="text-danger">
                                                @if ($data->stage == 8)
                                                    *
                                                @else
                                                @endif
                                            </span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                                completion</small></div>
                                        <textarea  class="tiny"
                                            name="Disposition_Batch" id="summernote-16" {{ $data->stage == 8 ? '' : 'readonly' }}>{{ $data->Disposition_Batch }}</textarea>
                                    </div>
                                    @error('Disposition_Batch')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="col-12">
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
                                                <input  type="file" id="myfile"
                                                    name="closure_attachment[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'closure_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Closure Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="closure_attachment">
                                                @if ($data->closure_attachment)
                                                    @foreach (json_decode($data->closure_attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file" data-file-name8="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            <input type="hidden" name="existing_closure_attachment[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="closure_attachment" name="closure_attachment[]" oninput="addMultipleFiles(this, 'closure_attachment')" multiple {{ $data->stage == 8 ? '' : 'disabled' }}>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_closure_attachment" name="deleted_closure_attachment" value="">

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeButtons = document.querySelectorAll('.remove-file');

                                        removeButtons.forEach(button => {
                                            button.addEventListener('click', function() {
                                                const fileName = this.getAttribute('data-file-name8');
                                                const fileContainer = this.closest('.file-container');

                                                // Hide the file container
                                                if (fileContainer) {
                                                    fileContainer.style.display = 'none';
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById('deleted_closure_attachment');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });
                                </script>


                            </div>
                            <div class="button-block">
                                <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                    type="submit"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                    id="ChangesaveButton06" class=" saveAuditFormBtn d-flex" style="align-items: center;">
                                    <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none"
                                        role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Save
                                </button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                class="backButton" onclick="previousStep()">Back</button>
                                <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                    type="button"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                    class="nextButton" onclick="nextStep()">Next</button>
                                <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a
                                        href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                                @if (
                                    $data->stage == 2 ||
                                        $data->stage == 3 ||
                                        $data->stage == 4 ||
                                        $data->stage == 5 ||
                                        $data->stage == 6 ||
                                        $data->stage == 7)
                                    {{-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                        class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#launch_extension">
                                        Launch Extension
                                    </a> --}}
                                @endif
                                <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                                                data-bs-target="#effectivenss_extension">
                                                                Launch Effectiveness Check
                                                            </a> -->
                            </div>
                        </div>
                    </div>

                    <!-- Activity Log content -->
                    <div id="CCForm16" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">Submit</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit by">Submit By :-</label>
                                        @if ($data->submit_by)
                                        <div class="static">{{ $data->submit_by }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">Submit On :-</label>
                                        @if ($data->submit_on)
                                        <div class="static">{{ $data->submit_on }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" style="width:1620px; height:100px; `padding:5px;">
                                        <label for="submit comment">Submit Comment :-</label>
                                        @if ($data->submit_comment)
                                        <div class="static">{{ $data->submit_comment }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>

                                <div class="sub-head">HOD Initial Review Complete</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="HOD Review Complete By">HOD Initial Review Complete By :-</label>
                                        @if ($data->HOD_Initial_Review_Complete_By)
                                        <div class="static">{{ $data->HOD_Initial_Review_Complete_By }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="HOD Review Complete On">HOD Initial Review Complete On :-</label>
                                        @if ($data->HOD_Initial_Review_Complete_On)
                                        <div class="static">{{ $data->HOD_Initial_Review_Complete_On }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" style="width:1620px; height:100px; `padding:5px;">
                                        <label for="HOD Review Comments">HOD Initial Review Complete Comment :-</label>
                                        @if ($data->HOD_Initial_Review_Comments)
                                        <div class="static">{{ $data->HOD_Initial_Review_Comments }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required By :-</label>
                                        <div class="static">{{ $data->hod_more_info_required_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required On :-</label>
                                        <div class="static">{{ $data->hod_more_info_required_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required Comments-</label>
                                        <div class="static">{{ $data->hod_more_info_required_comment }}</div>
                                    </div>
                                </div> --}}
                                {{--<div class="sub-head">
                                    cancelled
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit by">cancelled By :-</label>
                                        <div class="static">{{ $data->Hod_Cancelled_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="cancelled on">cancelled On :-</label>
                                        <div class="static">{{ $data->Hod_Cancelled_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit on">Cancelled Comments-</label>
                                        <div class="static">{{ $data->Hod_Cancelled_cmt }}</div>
                                    </div>
                                </div>--}}


                                <div class="sub-head">QA Initial Review Complete</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Initial Review Complete By">QA Initial Review Complete By :-</label>
                                        @if ($data->QA_Initial_Review_Complete_By)
                                        <div class="static">{{ $data->QA_Initial_Review_Complete_By }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Initial Review Complete On">QA Initial Review Complete On :-</label>
                                        @if ($data->QA_Initial_Review_Complete_On)
                                        <div class="static">{{ $data->QA_Initial_Review_Complete_On }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" style="width:1620px; height:100px; `padding:5px;">
                                        <label for="QA Initial Review Comments">QA Initial Review Complete Comment:-</label>
                                        @if ($data->QA_Initial_Review_Comments)
                                        <div class="static">{{ $data->QA_Initial_Review_Comments }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required By :-</label>
                                        <div class="static">{{ $data->qa_more_info_required_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required On :-</label>
                                        <div class="static">{{ $data->qa_more_info_required_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required Comments-</label>
                                        <div class="static">{{ $data->qa_more_info_required_comment }}</div>
                                    </div>
                                </div> --}}


                                <div class="sub-head">QAH/Designee Approval Complete</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Initial Review Complete By">QAH/Designee Approval Complete By:-</label>
                                        @if ($data->QAH_Designee_Approval_Complete_By)
                                        <div class="static">{{ $data->QAH_Designee_Approval_Complete_By }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Initial Review Complete On">QAH/Designee Approval Complete On:-</label>
                                        @if ($data->QAH_Designee_Approval_Complete_On)
                                        <div class="static">{{ $data->QAH_Designee_Approval_Complete_On }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" style="width:1620px; height:100px; `padding:5px;">
                                        <label for="QA Initial Review Comments">QAH/Designee Approval Complete Comment:-</label>
                                        @if ($data->QAH_Designee_Approval_Complete_Comments)
                                        <div class="static">{{ $data->QAH_Designee_Approval_Complete_Comments }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>

                                {{-- <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required By :-</label>
                                        <div class="static">{{ $data->qah_more_info_required_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required On :-</label>
                                        <div class="static">{{ $data->qah_more_info_required_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required Comments-</label>
                                        <div class="static">{{ $data->qah_more_info_required_comment }}</div>
                                    </div>
                                </div> --}}



                                <div class="sub-head">Pending Initiator Update Complete</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Pending Initiator Update Complete By">Pending Initiator Update Complete By:-</label>
                                        @if ($data->Pending_Review_Complete_By)
                                        <div class="static">{{ $data->Pending_Review_Complete_By }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Pending Initiator Update Complete On">Pending Initiator Update Complete On:-</label>
                                        @if ($data->Pending_Review_Complete_On)
                                        <div class="static">{{ $data->Pending_Review_Complete_On }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                                        <label for="CFT Review Comments">Pending Initiator Update Complete Comment:-</label>
                                        @if ($data->Pending_Review_Comments)
                                        <div class="static">{{ $data->Pending_Review_Comments }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required By :-</label>
                                        <div class="static">{{ $data->initiator_more_info_required_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required On :-</label>
                                        <div class="static">{{ $data->initiator_more_info_required_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required Comments-</label>
                                        <div class="static">{{ $data->initiator_more_info_required_comment }}</div>
                                    </div>
                                </div> --}}


                                <div class="sub-head">HOD Final Review Complete</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Final Review Complete By">HOD Final Review Complete By:-</label>
                                        @if ($data->Hod_Final_Review_Complete_By)
                                        <div class="static">{{ $data->Hod_Final_Review_Complete_By }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Final Review Complete On">HOD Final Review Complete On:-</label>
                                        @if ($data->Hod_Final_Review_Complete_On)
                                        <div class="static">{{ $data->Hod_Final_Review_Complete_On }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                                        <label for="QA Final Review Comments">HOD Final Review Complete Comment:-</label>
                                        @if ($data->Hod_Final_Review_Comments)
                                        <div class="static">{{ $data->Hod_Final_Review_Comments }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>

                                {{-- <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required By :-</label>
                                        <div class="static">{{ $data->hod_final_more_info_required_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required On :-</label>
                                        <div class="static">{{ $data->hod_final_more_info_required_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required Comments-</label>
                                        <div class="static">{{ $data->hod_final_more_info_required_comment }}</div>
                                    </div>
                                </div> --}}
                                

                                {{--@php
                                dd($data->QA_Final_Review_Complete_By);
                                @endphp--}}
                                <div class="sub-head">QA Final Review Complete</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Final Review Complete By"> QA Final Review Complete By:-</label>
                                        @if ($data->QA_Final_Review_Complete_By)
                                        <div class="static">{{ $data->QA_Final_Review_Complete_By}}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Final Review Complete On"> QA Final Review Complete On:-</label>
                                        @if ($data->QA_Final_Review_Complete_On)
                                        <div class="static">{{ $data->QA_Final_Review_Complete_On}}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                                        <label for="QA Final Review Comments"> QA Final Review Complete Comment:-</label>
                                        @if ($data->QA_Final_Review_Comments)
                                        <div class="static">{{ $data->QA_Final_Review_Comments}}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required By :-</label>
                                        <div class="static">{{ $data->Hod_more_info_req_by}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required On :-</label>
                                        <div class="static">{{ $data->Hod_more_info_req_on}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required Comments-</label>
                                        <div class="static">{{ $data->Hod_more_info_req_cmt}}</div>
                                    </div>
                                </div> --}}




                                {{-- <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required By :-</label>
                                        <div class="static">{{ $data->Qa_final_more_info_req_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required On :-</label>
                                        <div class="static">{{ $data->Qa_final_more_info_req_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required Comments-</label>
                                        <div class="static">{{ $data->Qa_final_more_info_req_cmt }}</div>
                                    </div>
                                </div> --}}


                                <div class="sub-head">Approved</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Final Review Complete By">Approved By:-</label>
                                        @if ($data->QA_head_approved_by)
                                        <div class="static">{{ $data->QA_head_approved_by }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Final Review Complete On">Approved On:-</label>
                                        @if ($data->QA_head_approved_on)
                                        <div class="static">{{ $data->QA_head_approved_on }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" style="width:1620px; height:100px; `padding:5px;">
                                        <label for="QA Final Review Comments">Approved Comment:-</label>
                                        @if ($data->QA_head_approved_comment)
                                        <div class="static">{{ $data->QA_head_approved_comment }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                            {{-- 
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required By :-</label>
                                        <div class="static">{{ $data->approved_more_info_req_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required On :-</label>
                                        <div class="static">{{ $data->approved_more_info_req_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required Comments-</label>
                                        <div class="static">{{ $data->approved_more_info_req_cmt }}</div>
                                    </div>
                                </div> --}}



                                {{-- <div class="sub-head">Initiator Update</div>
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
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required By :-</label>
                                        <div class="static">{{ $data->more_info_req_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required On :-</label>
                                        <div class="static">{{ $data->more_info_req_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required Comments-</label>
                                        <div class="static">{{ $data->more_info_req_cmt }}</div>
                                    </div>
                            </div> --}}




                                {{-- <div class="sub-head">QA Final Approval</div>
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
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required By :-</label>
                                        <div class="static">{{ $data->more_info_req_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required On :-</label>
                                        <div class="static">{{ $data->more_info_req_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit on">More Information
                                            Required Comments-</label>
                                        <div class="static">{{ $data->more_info_req_cmt }}</div>
                                    </div>
                                </div> --}}
                                <div class="sub-head">Cancel</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="submit by">Cancel By:-</label>
                                        @if ($data->Cancelled_by)
                                        <div class="static">{{ $data->Cancelled_by }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="cancelled on">Cancel On:-</label>
                                        @if ($data->Cancelled_on)
                                        <div class="static">{{ $data->Cancelled_on }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submit on">Cancel Comment:-</label>
                                        @if ($data->Cancelled_cmt)
                                        <div class="static">{{ $data->Cancelled_cmt }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                {{-- <button
                                    type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }}
                                    class="saveButton saveAuditFormBtn d-flex" style="align-items: center;">
                                    <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none"
                                        role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Save
                                </button> --}}
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                class="backButton" onclick="previousStep()" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Back</button>

                                {{-- <button type="submit"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Submit</button> --}}
                                <button type="button"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}> <a
                                        href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>




{{-- <div id="CCForm17" class="inner-block cctabcontent">
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
                            <div disabled class="file-attachment-list" id="hod_attachments">
                                @if ($data->hod_attachments)
                                    @foreach (json_decode($data->hod_attachments) as $file)
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
                                    type="file" id="hod_attachments"
                                    name="hod_attachments[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                    oninput="addMultipleFiles(this, 'hod_attachments')" multiple>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="group-input">
                        <label for="Inv Attachments">HOD Attachments</label>
                        <div><small class="text-primary">Please Attach all relevant or supporting
                                documents</small></div>
                        <div class="file-attachment-field">
                            <div disabled class="file-attachment-list" id="hod_attachments">
                                @if ($data->hod_attachments)
                                    @foreach (json_decode($data->hod_attachments) as $file)
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
                                    type="file" id="hod_attachments"
                                    name="hod_attachments[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                    oninput="addMultipleFiles(this, 'hod_attachments')" multiple>
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

            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }}
                class="saveButton saveAuditFormBtn d-flex" style="align-items: center;"
                id="ChangesaveButton02">
                <div class="spinner-border spinner-border-sm auditFormSpinner"
                    style="display: none" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                Save
            </button>
            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                type="button"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                class="nextButton" onclick="nextStep()">Next</button>
            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                    Exit </a>
            </button>
            @if (
                $data->stage == 2 ||
                    $data->stage == 3 ||
                    $data->stage == 4 ||
                    $data->stage == 5 ||
                    $data->stage == 6 ||
                    $data->stage == 7)
                -- <a style="  justify-content: center; width: 10rem; margin-left: 1px;;"
                    type="button" class="button  launch_extension" data-bs-toggle="modal"
                    data-bs-target="#launch_extension">
                    Launch Extension
                </a> -
            @endif
             <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                            data-bs-target="#effectivenss_extension">
                            Launch Effectiveness Check
                        </a>
        </div>
    </div>
</div> --}}
                            {{-- Qa Initiator  Approved --}}
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


                <!-- investigation -->
                <div id="CCForm9" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            {{-- @if ($investigationExtension && $investigationExtension->investigation_proposed_due_date)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Proposed Due Date">Proposed Due  Date</label>
                                        <input name="investigation_proposed_due_date" id="investigation_proposed_due_date" value="{{ Helpers::getdateFormat($investigationExtension->investigation_proposed_due_date) }}" disabled>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Proposed Due Date">Proposed Due Date</label>
                                        <input name="investigation_proposed_due_date" id="investigation_proposed_due_date" placeholder=""  disabled>
                                    </div>
                                </div>
                            @endif --}}
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Investigation Summary">Description of Event</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                            completion</small></div>
                                    <textarea class="tiny" name="Discription_Event" id="summernote-8" >{{ $data->Discription_Event }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Impact Assessment">Objective</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                            completion</small></div>
                                    <textarea class="tiny" name="objective" id="summernote-9" >{{ $data->objective }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Root Cause">Scope</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                            completion</small></div>
                                    <textarea class="tiny" name="scope" id="summernote-10" >{{ $data->scope }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Root Cause">Immediate Action</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                            completion</small></div>
                                    <textarea class="tiny" name="imidiate_action" id="summernote-10" >{{ $data->imidiate_action }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Root Cause">Impact Assesment</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                            completion</small></div>
                                    <textarea class="tiny" name="impact_ass" id="summernote-10" >{{ $data->impact_ass }}</textarea>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="group-input" id="documentsRowna">
                                    <label for="audit-agenda-grid">
                                        Investigation team and Responsibilities
                                        <button type="button" name="audit-agenda-grid" id="investigationTeamAdd">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#investigationTeamDetailTable"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="investigationTeamDetailTable"
                                            style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 4%">SR NO.</th>
                                                    <th style="width: 12%">Investigation Team</th>
                                                    <th style="width: 16%">Responsibility</th>
                                                    <th style="width: 16%">Remarks</th>
                                                    <th style="width: 8%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if ($investigationTeamData && is_array($investigationTeamData))
                                                    @foreach ($investigationTeamData as $investigation_data)
                                                        <tr>
                                                            <td>
                                                                <input disabled type="text"
                                                                    name="investigationTeam[{{ $loop->index }}][serial]"
                                                                    value="{{ $loop->index + 1 }}">
                                                            </td>
                                                            <td>
                                                                <select
                                                                    name="investigationTeam[{{ $loop->index }}][teamMember]"
                                                                    id="" class="teamMember">
                                                                    <option value="">-- Select --</option>
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}"
                                                                            {{ $investigation_data['teamMember'] == $user->id ? 'selected' : '' }}>
                                                                            {{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="responsibility"
                                                                    name="investigationTeam[{{ $loop->index }}][responsibility]"
                                                                    value="{{ isset($investigation_data['responsibility']) ? $investigation_data['responsibility'] : '' }}">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="remarks"
                                                                    name="investigationTeam[{{ $loop->index }}][remarks]"
                                                                    value="{{ isset($investigation_data['remarks']) ? $investigation_data['remarks'] : '' }}">
                                                            </td>
                                                            <td><input type="button" class="Action" name=""></td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <td><input disabled type="text" name="investigationTeam[0][serial]"
                                                            value="1"></td>
                                                    <td>
                                                        <select name="investigationTeam[0][teamMember]" id="">
                                                            <option value="">-- Select --</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}">{{ $user->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="responsibility"
                                                            name="investigationTeam[0][responsibility]">
                                                    </td>
                                                    <td><input type="text" class="remarks"
                                                            name="investigationTeam[0][remarks]"></td>
                                                    <td><input type="text" class="Action" name=""></td>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="audit type">Investigation Approach </label>
                                    <select multiple name="investigation_approach[]" id="investigation_approach">
                                        <option value="Why-Why Chart"
                                            {{ strpos($data->investigation_approach, 'Why-Why Chart') !== false ? 'selected' : '' }}>
                                            Why-Why Chart</option>
                                        <option value="Failure Mode and Efect Analysis"
                                            {{ strpos($data->investigation_approach, 'Failure Mode and Efect Analysis') !== false ? 'selected' : '' }}>
                                            Failure Mode and Efect Analysis</option>
                                        <option value="Fishbone or Ishikawa Diagram"
                                            {{ strpos($data->investigation_approach, 'Fishbone or Ishikawa Diagram') !== false ? 'selected' : '' }}>
                                            Fishbone or Ishikawa Diagram</option>
                                        <option value="Is/Is Not Analysis"
                                            {{ strpos($data->investigation_approach, 'Is/Is Not Analysis') !== false ? 'selected' : '' }}>
                                            Is/Is Not Analysis</option>
                                        <option value="Brainstorming"
                                            {{ strpos($data->investigation_approach, 'Brainstorming') !== false ? 'selected' : '' }}>
                                            Brainstorming</option>
                                    </select>
                                </div>
                            </div>

                            <script>
                                // $(document).ready(function () {
                                // $('#Root_Cause_Category_Select').change(function () {
                                $(document).on('change', '.Root_Cause_Category_Select', function() {
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
                                        subCategorySelect.append(
                                            '<option value="No_Preventive_Maintenance">No Preventive Maintenance</option>');
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append(
                                            '<option value="Poor_Maintenance_or_Design">Poor Maintenance or Design</option>');
                                        subCategorySelect.append(
                                            '<option value="Maintenance Needs Improvement">Maintenance Needs Improvement</option>');
                                        subCategorySelect.append('<option value="Scheduling Problem">Scheduling Problem</option>');
                                        subCategorySelect.append('<option value="System Deficiency">System Deficiency</option>');
                                        subCategorySelect.append('<option value="Technical Error">Technical Error</option>');
                                        subCategorySelect.append('<option value="Tolerable Failure">Tolerable Failure</option>');
                                        subCategorySelect.append('<option value="Calibration Issues">Calibration Issues</option>');



                                    } else if (selectedCategory === 'M-Maintenance') {
                                        subCategorySelect.append('<option value="Infrequent_Audits">Infrequent Audits</option>');
                                        subCategorySelect.append(
                                            '<option value="No_Preventive_Maintenance">No Preventive Maintenance</option>');
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append(
                                            '<option value="Maintenance Needs Improvement">Maintenance Needs Improvement</option>');
                                        subCategorySelect.append('<option value="Scheduling Problem">Scheduling Problem</option>');
                                        subCategorySelect.append('<option value="System Deficiency">System Deficiency</option>');
                                        subCategorySelect.append('<option value="Technical Error">Technical Error</option>');
                                        subCategorySelect.append('<option value="Tolerable Failure">Tolerable Failure</option>');



                                    } else if (selectedCategory === 'M-Man Power (physical work)') {
                                        subCategorySelect.append('<option value="Failure_to_Follow_SOP">Failure to Follow SOP</option>');
                                        subCategorySelect.append(
                                            '<option value="Human_Machine_Interface">Human-Machine Interface</option>');
                                        subCategorySelect.append(
                                            '<option value="Misunderstood_Verbal_Communication">Misunderstood Verbal Communication</option>'
                                        );
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append('<option value="Personnel Error">Personnel Error</option>');
                                        subCategorySelect.append(
                                            '<option value="Personnel not Qualified">Personnel not Qualified</option>');
                                        subCategorySelect.append('<option value="Practice Needed">Practice Needed</option>');
                                        subCategorySelect.append(
                                            '<option value="Teamwork Needs Improvement">Teamwork Needs Improvement</option>');
                                        subCategorySelect.append('<option value="Attention">Attention</option>');
                                        subCategorySelect.append('<option value="Understanding">Understanding</option>');
                                        subCategorySelect.append('<option value="Procedural ">Procedural </option>');
                                        subCategorySelect.append('<option value="Behavioral">Behavioral</option>');
                                        subCategorySelect.append('<option value="Skill">Skill</option>');

                                    } else if (selectedCategory === 'M-Management') {
                                        subCategorySelect.append('<option value="Inattention to task">Inattention to task</option>');
                                        subCategorySelect.append('<option value="Lack of Process">Lack of Process</option>');
                                        subCategorySelect.append('<option value="Methods">Methods</option>');
                                        subCategorySelect.append(
                                            '<option value="No or poor management involvement">No or poor management involvement</option>'
                                        );
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append(
                                            '<option value="Personnel not Qualified">Personnel not Qualified</option>');
                                        subCategorySelect.append(
                                            '<option value="Poor employee involvement">Poor employee involvement</option>');
                                        subCategorySelect.append(
                                            '<option value="Poor recognition of hazard">Poor recognition of hazard</option>');
                                        subCategorySelect.append(
                                            '<option value="Previously identified hazards were not eliminated">Previously identified hazards were not eliminated</option>'
                                        );
                                        subCategorySelect.append('<option value="Stress demands">Stress demands</option>');
                                        subCategorySelect.append(
                                            '<option value="Task hazards not guarded properly">Task hazards not guarded properly</option>'
                                        );
                                        subCategorySelect.append(
                                            '<option value="Training or education lacking">Training or education lacking</option>');
                                    } else if (selectedCategory === 'M-Material (Raw,Consumables etc.)') {
                                        subCategorySelect.append(
                                            '<option value="Defective equipment or tool">Defective equipment or tool</option>');
                                        subCategorySelect.append('<option value="Defective raw material">Defective raw material</option>');
                                        subCategorySelect.append(
                                            '<option value="Incorrect tool selection">Incorrect tool selection</option>');
                                        subCategorySelect.append('<option value="Lack of raw material">Lack of raw material</option>');
                                        subCategorySelect.append('<option value="Machine / Equipment">Machine / Equipment</option>');
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append(
                                            '<option value="Poor equipment or tool placement">Poor equipment or tool placement</option>'
                                        );
                                        subCategorySelect.append(
                                            '<option value="Poor maintenance or design">Poor maintenance or design</option>');
                                        subCategorySelect.append('<option value="Wrong type for job">Wrong type for job</option>');

                                    } else if (selectedCategory === 'M-Method (Process/Inspection)') {
                                        subCategorySelect.append(
                                            '<option value="Instruction Needs Improvement">Instruction Needs Improvement</option>');
                                        subCategorySelect.append(
                                            '<option value="Learning Objective Needs Improvement">Learning Objective Needs Improvement</option>'
                                        );
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append(
                                            '<option value="Poor employee involvement">Poor employee involvement</option>');
                                        subCategorySelect.append(
                                            '<option value="Poor recognition of hazard">Poor recognition of hazard</option>');
                                        subCategorySelect.append(
                                            '<option value="Previously identified hazards were not eliminated">Previously identified hazards were not eliminated</option>'
                                        );
                                        subCategorySelect.append('<option value="Scheduling Problem">Scheduling Problem</option>');
                                        subCategorySelect.append(
                                            '<option value="Training or education lacking">Training or education lacking</option>');
                                        subCategorySelect.append('<option value="Wrong Sequence">Wrong Sequence</option>');
                                    } else if (selectedCategory === 'M-Mother Nature (Environment)') {
                                        subCategorySelect.append('<option value="Forces of nature">Forces of nature</option>');
                                        subCategorySelect.append(
                                            '<option value="Job design or layout of work">Job design or layout of work</option>');
                                        subCategorySelect.append('<option value="Orderly workplace">Orderly workplace</option>');
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append(
                                            '<option value="Physical demands of the task">Physical demands of the task</option>');
                                        subCategorySelect.append(
                                            '<option value="Surfaces poorly maintained">Surfaces poorly maintained</option>');
                                    } else if (selectedCategory === 'P-Place/Plant') {
                                        subCategorySelect.append('<option value="Forces of nature">Forces of nature</option>');
                                        subCategorySelect.append(
                                            '<option value="Job design or layout of work">Job design or layout of work</option>');
                                        subCategorySelect.append('<option value="Orderly workplace">Orderly workplace</option>');
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append(
                                            '<option value="Physical demands of the task">Physical demands of the task</option>');
                                        subCategorySelect.append(
                                            '<option value="Surfaces poorly maintained">Surfaces poorly maintained</option>');

                                    } else if (selectedCategory === 'P-Policies') {
                                        subCategorySelect.append(
                                            '<option value="Instruction Needs Improvement">Instruction Needs Improvement</option>');
                                        subCategorySelect.append(
                                            '<option value="Learning Objective Needs Improvement">Learning Objective Needs Improvement</option>'
                                        );
                                        subCategorySelect.append('<option value="No Standard / Policy">No Standard / Policy</option>');
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append('<option value="Wrong Revision Used">Wrong Revision Used</option>');


                                    } else if (selectedCategory === 'P-Price') {
                                        subCategorySelect.append('<option value="No Budget">No Budget</option>');
                                        subCategorySelect.append('<option value="No Preparation">No Preparation</option>');
                                        subCategorySelect.append('<option value="No Standard / Policy">No Standard / Policy</option>');
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append('<option value="Wrong Estimation">Wrong Estimation</option>');


                                    } else if (selectedCategory === 'P-Procedures') {
                                        subCategorySelect.append(
                                            '<option value="Learning Objective Needs Improvement">Learning Objective Needs Improvement</option>'
                                        );
                                        subCategorySelect.append('<option value="Management system">Management system</option>');
                                        subCategorySelect.append('<option value="No or poor procedures">No or poor procedures</option>');
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append('<option value="Poor communication">Poor communication</option>');
                                        subCategorySelect.append(
                                            '<option value="Poor employee involvement">Poor employee involvement</option>');
                                        subCategorySelect.append(
                                            '<option value="Practices are not the same as written procedures">Practices are not the same as written procedures</option>'
                                        );
                                        subCategorySelect.append(
                                            '<option value="Previously identified hazards were not eliminated">Previously identified hazards were not eliminated</option>'
                                        );
                                        subCategorySelect.append(
                                            '<option value="Procedure Difficult to Use">Procedure Difficult to Use</option>');
                                        subCategorySelect.append(
                                            '<option value="Training or education lacking">Training or education lacking</option>');
                                        subCategorySelect.append('<option value="Wrong Revision Used">Wrong Revision Used</option>');

                                    } else if (selectedCategory === 'P-Process') {
                                        subCategorySelect.append(
                                            '<option value="Instruction Needs Improvement">Instruction Needs Improvement</option>');
                                        subCategorySelect.append(
                                            '<option value="Learning Objective Needs Improvement">Learning Objective Needs Improvement</option>'
                                        );
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append(
                                            '<option value="Poor employee involvement">Poor employee involvement</option>');
                                        subCategorySelect.append(
                                            '<option value="Poor recognition of hazard">Poor recognition of hazard</option>');
                                        subCategorySelect.append(
                                            '<option value="Previously identified hazards were not eliminated">Previously identified hazards were not eliminated</option>'
                                        );
                                        subCategorySelect.append('<option value="Scheduling Problem">Scheduling Problem</option>');
                                        subCategorySelect.append(
                                            '<option value="Training or education lacking">Training or education lacking</option>');
                                        subCategorySelect.append('<option value="Wrong Sequence">Wrong Sequence</option>');


                                    } else if (selectedCategory === 'P-Product') {
                                        subCategorySelect.append(
                                            '<option value="Defective equipment or tool">Defective equipment or tool</option>');
                                        subCategorySelect.append('<option value="Defective raw material">Defective raw material</option>');
                                        subCategorySelect.append(
                                            '<option value="Incorrect tool selection">Incorrect tool selection</option>');
                                        subCategorySelect.append('<option value="Lack of raw material">Lack of raw material</option>');
                                        subCategorySelect.append('<option value="Machine / Equipment">Machine / Equipment</option>');
                                        subCategorySelect.append(
                                            '<option value="Poor equipment or tool placement">Poor equipment or tool placement</option>'
                                        );
                                        subCategorySelect.append(
                                            '<option value="Poor maintenance or design">Poor maintenance or design</option>');
                                        subCategorySelect.append('<option value="Wrong type for job">Wrong type for job</option>');


                                    } else if (selectedCategory === 'S-Suppliers') {
                                        subCategorySelect.append('<option value="Infrequent Audits">Infrequent Audits</option>');
                                        subCategorySelect.append(
                                            '<option value="Misunderstood Verbal Communication">Misunderstood Verbal Communication</option>'
                                        );
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append(
                                            '<option value="Personnel not Qualified">Personnel not Qualified</option>');
                                        subCategorySelect.append(
                                            '<option value="Shift Change Communication">Shift Change Communication</option>');
                                        subCategorySelect.append('<option value="Task Not Analyzed">Task Not Analyzed</option>');
                                    } else if (selectedCategory === 'S-Surroundings') {
                                        subCategorySelect.append('<option value="Forces of nature">Forces of nature</option>');
                                        subCategorySelect.append(
                                            '<option value="Job design or layout of work">Job design or layout of work</option>');
                                        subCategorySelect.append('<option value="Orderly workplace">Orderly workplace</option>');
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append(
                                            '<option value="Physical demands of the task">Physical demands of the task</option>');
                                        subCategorySelect.append(
                                            '<option value="Surfaces poorly maintained">Surfaces poorly maintained</option>');


                                    } else if (selectedCategory === 'S-Systems') {
                                        subCategorySelect.append('<option value="Infrequent Audits">Infrequent Audits</option>');
                                        subCategorySelect.append(
                                            '<option value="No Preventive Maintenance">No Preventive Maintenance</option>');
                                        subCategorySelect.append('<option value="Other">Other</option>');
                                        subCategorySelect.append(
                                            '<option value="Poor maintenance or design">Poor maintenance or design</option>');
                                        subCategorySelect.append(
                                            '<option value="Maintenance Needs Improvement">Maintenance Needs Improvement</option>');
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
                                        @if ($fishbone_data && is_array($fishbone_data))
                                            <div class="left-group">
                                                <div class="grid-field field-name">
                                                    <div>Measurement</div>
                                                    <div>Materials</div>
                                                    <div>Methods</div>
                                                </div>
                                                <div class="top-field-group">
                                                    <div class="grid-field fields top-field">

                                                        @foreach ($fishbone_data['measurement'] as $measurement)
                                                            <div><input type="text"
                                                                    name="fishbone[measurement][{{ $loop->index }}]"
                                                                    value="{{ $measurement }}"></div>
                                                        @endforeach
                                                        @foreach ($fishbone_data['materials'] as $materials)
                                                            <div><input type="text"
                                                                    name="fishbone[materials][{{ $loop->index }}]"
                                                                    value="{{ $materials }}"></div>
                                                        @endforeach
                                                        @foreach ($fishbone_data['methods'] as $methods)
                                                            <div><input type="text"
                                                                    name="fishbone[methods][{{ $loop->index }}]"
                                                                    value="{{ $methods }}"></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="mid"></div>
                                                <div class="bottom-field-group">
                                                    <div class="grid-field fields bottom-field">
                                                        @foreach ($fishbone_data['environment'] as $environment)
                                                            <div><input type="text"
                                                                    name="fishbone[environment][{{ $loop->index }}]"
                                                                    value="{{ $environment }}"></div>
                                                        @endforeach
                                                        @foreach ($fishbone_data['manpower'] as $manpower)
                                                            <div><input type="text"
                                                                    name="fishbone[manpower][{{ $loop->index }}]"
                                                                    value="{{ $manpower }}"></div>
                                                        @endforeach
                                                        @foreach ($fishbone_data['machine'] as $machine)
                                                            <div><input type="text"
                                                                    name="fishbone[machine][{{ $loop->index }}]"
                                                                    value="{{ $machine }}"></div>
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
                                                    <textarea name="fishbone[fishbone_problem_statement]">{{ $fishbone_data['fishbone_problem_statement'] }}</textarea>
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
                                                @if ($why_data && is_array($why_data))
                                                    <tr style="background: #f4bb22">
                                                        <th style="width:150px;">Problem Statement :</th>
                                                        <td>
                                                            <textarea name="why[problem_statement]">{{ $why_data['problem_statement'] }}</textarea>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 1 <span
                                                                onclick="addWhyField('why_1_block', 'why[why_1][index]')">+</span>
                                                        </th>
                                                        <td>
                                                            @foreach ($why_data['why_1'] as $why_one)
                                                                <div class="why_1_block whyblock-bottom">
                                                                    <textarea name="why[why_1][{{ $loop->index }}]">{{ $why_one }}</textarea>
                                                                </div>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 2 <span
                                                                onclick="addWhyField('why_2_block', 'why[why_2][index]')">+</span>
                                                        </th>
                                                        <td>
                                                            @foreach ($why_data['why_2'] as $why_two)
                                                                <div class="why_2_block  whyblock-bottom">
                                                                    <textarea name="why[why_2][{{ $loop->index }}]">{{ $why_two }}</textarea>
                                                                </div>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 3 <span
                                                                onclick="addWhyField('why_3_block', 'why[why_3][index]')">+</span>
                                                        </th>
                                                        <td>
                                                            @foreach ($why_data['why_3'] as $why_three)
                                                                <div class="why_3_block whyblock-bottom">
                                                                    <textarea name="why[why_3][{{ $loop->index }}]">{{ $why_three }}</textarea>
                                                                </div>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 4 <span
                                                                onclick="addWhyField('why_4_block', 'why[why_4][index]')">+</span>
                                                        </th>
                                                        <td>
                                                            @foreach ($why_data['why_4'] as $why_four)
                                                                <div class="why_4_block whyblock-bottom">
                                                                    <textarea name="why[why_4][{{ $loop->index }}]">{{ $why_four }}</textarea>
                                                                </div>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 5 <span
                                                                onclick="addWhyField('why_5_block', 'why[why_5][index]')">+</span>
                                                        </th>
                                                        <td>
                                                            @foreach ($why_data['why_5'] as $why_five)
                                                                <div class="why_5_block whyblock-bottom">
                                                                    <textarea name="why[why_5][{{ $loop->index }}]">{{ $why_five }}</textarea>
                                                                </div>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr style="background: #0080006b;">
                                                        <th style="width:150px;">Root Cause :</th>
                                                        <td>
                                                            <textarea name="why[root-cause]">{{ $why_data['root-cause'] }}</textarea>
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
                                                            Why 1 <span
                                                                onclick="addWhyField('why_1_block', 'why[why_1][]')">+</span>
                                                        </th>
                                                        <td>
                                                            <div class="why_1_block">
                                                                <textarea name="why[why_1][0]"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 2 <span
                                                                onclick="addWhyField('why_2_block', 'why[why_2][]')">+</span>
                                                        </th>
                                                        <td>
                                                            <div class="why_2_block">
                                                                <textarea name="why[why_2][0]"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 3 <span
                                                                onclick="addWhyField('why_3_block', 'why[why_3][]')">+</span>
                                                        </th>
                                                        <td>
                                                            <div class="why_3_block">
                                                                <textarea name="why[why_3][0]"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 4 <span
                                                                onclick="addWhyField('why_4_block', 'why[why_4][]')">+</span>
                                                        </th>
                                                        <td>
                                                            <div class="why_4_block">
                                                                <textarea name="why[why_4][0]"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="why-row">
                                                        <th style="width:150px; color: #393cd4;">
                                                            Why 5 <span
                                                                onclick="addWhyField('why_5_block', 'why[why_5][]')">+</span>
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
                                                        <textarea name="attention_issues">{{ $data->attention_issues }}</textarea>
                                                    </td>
                                                    <td>
                                                        <textarea name="attention_actions">{{ $data->attention_actions }}</textarea>
                                                    </td>
                                                    <td style="background: rgb(222 220 220 / 58%)">
                                                        <textarea name="attention_remarks">{{ $data->attention_remarks }}</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="background: rgb(222 220 220 / 58%)">
                                                        2
                                                    </td>
                                                    <th>Understanding</th>
                                                    <td style="background: rgb(222 220 220 / 58%)">
                                                        <textarea name="understanding_issues">{{ $data->understanding_issues }}</textarea>
                                                    </td>
                                                    <td>
                                                        <textarea name="understanding_actions">{{ $data->understanding_actions }}</textarea>
                                                    </td>
                                                    <td style="background: rgb(222 220 220 / 58%)">
                                                        <textarea name="understanding_remarks">{{ $data->understanding_remarks }}</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="background: rgb(222 220 220 / 58%)">
                                                        3
                                                    </td>
                                                    <th>Procedural</th>
                                                    <td style="background: rgb(222 220 220 / 58%)">
                                                        <textarea name="procedural_issues">{{ $data->procedural_issues }}</textarea>
                                                    </td>
                                                    <td>
                                                        <textarea name="procedural_actions">{{ $data->procedural_actions }}</textarea>
                                                    </td>
                                                    <td style="background: rgb(222 220 220 / 58%)">
                                                        <textarea name="procedural_remarks">{{ $data->procedural_remarks }}</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="background: rgb(222 220 220 / 58%)">
                                                        4
                                                    </td>
                                                    <th>Behavioral</th>
                                                    <td style="background: rgb(222 220 220 / 58%)">
                                                        <textarea name="behavioiral_issues">{{ $data->behavioiral_issues }}</textarea>
                                                    </td>
                                                    <td>
                                                        <textarea name="behavioiral_actions">{{ $data->behavioiral_actions }}</textarea>
                                                    </td>
                                                    <td style="background: rgb(222 220 220 / 58%)">
                                                        <textarea name="behavioiral_remarks">{{ $data->behavioiral_remarks }}</textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="background: rgb(222 220 220 / 58%)">
                                                        5
                                                    </td>
                                                    <th>Skill</th>
                                                    <td style="background: rgb(222 220 220 / 58%)">
                                                        <textarea name="skill_issues">{{ $data->skill_issues }}</textarea>
                                                    </td>
                                                    <td>
                                                        <textarea name="skill_actions">{{ $data->skill_actions }}</textarea>
                                                    </td>
                                                    <td style="background: rgb(222 220 220 / 58%)">
                                                        <textarea name="skill_remarks">{{ $data->skill_remarks }}</textarea>
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

                        <div class="sub-head"> Root Cause </div>

                        <div class="col-lg-12">
                            <div class="group-input" id="documentsRowname">
                                <label for="audit-agenda-grid">
                                    Root Cause
                                    <button type="button" name="audit-agenda-grid" id="rootCauseAdd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal" data-bs-target="#root-cause"
                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="rootCauseAddTable" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="width: 4%">SR NO.</th>
                                                <th style="width: 12%"> Root Cause Category</th>
                                                <th style="width: 16%">Root Cause Sub-Category</th>
                                                <th style="width: 16%">If Others</th>

                                                <th style="width: 16%"> Probability</th>
                                                <th style="width: 16%"> Remarks</th>

                                                <th style="width: 8%">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if ($rootCauseData && is_array($rootCauseData))
                                                @foreach ($rootCauseData as $index => $root_cause_dat)
                                                    <tr>
                                                        <td>
                                                            <input disabled type="text"
                                                                name="rootCauseData[{{ $loop->index }}][serial]"
                                                                value="{{ $loop->index + 1 }}">
                                                        </td>
                                                        <td>
                                                            <select name="rootCauseData[{{ $loop->index }}][rootCauseCategory]"
                                                                id="Root_Cause_Category_Select"
                                                                class="Root_Cause_Category_Select">
                                                                <option value="">-- Select --</option>

                                                                <option value="M-Machine(Equipment)"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'M-Machine(Equipment)' ? 'selected' : '' }}>
                                                                    M-Machine(Equipment)</option>
                                                                <option value="M-Maintenance"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'M-Maintenance' ? 'selected' : '' }}>
                                                                    M-Maintenance</option>
                                                                <option value="M-Man Power (physical work)"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'M-Man Power (physical work)' ? 'selected' : '' }}>
                                                                    M-Man Power (physical work)</option>
                                                                <option value="M-Management"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == '"M-Management' ? 'selected' : '' }}>
                                                                    M-Management</option>
                                                                <option value="M-Material (Raw,Consumables etc.)"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'M-Material (Raw,Consumables etc.)' ? 'selected' : '' }}>
                                                                    M-Material (Raw,Consumables etc.)</option>
                                                                <option value="M-Method (Process/Inspection)"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'M-Method (Process/Inspection)' ? 'selected' : '' }}>
                                                                    M-Method (Process/Inspection)</option>
                                                                <option value="M-Mother Nature (Environment)"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'M-Mother Nature (Environment)' ? 'selected' : '' }}>
                                                                    M-Mother Nature (Environment)</option>
                                                                <option value="P-Place/Plant"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'P-Place/Plant' ? 'selected' : '' }}>
                                                                    P-Place/Plant</option>
                                                                <option value="P-Policies"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'P-Policies' ? 'selected' : '' }}>
                                                                    P-Policies</option>
                                                                <option value="P-Price"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'P-Price' ? 'selected' : '' }}>
                                                                    P-Price </option>
                                                                <option value="P-Procedures"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'P-Procedures' ? 'selected' : '' }}>
                                                                    P-Procedures</option>
                                                                <option value="P-Process"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'P-Process' ? 'selected' : '' }}>
                                                                    P-Process </option>
                                                                <option value="P-Product"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'P-Product' ? 'selected' : '' }}>
                                                                    P-Product</option>
                                                                <option value="S-Suppliers"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'S-Suppliers' ? 'selected' : '' }}>
                                                                    S-Suppliers</option>
                                                                <option value="S-Surroundings"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'S-Surroundings' ? 'selected' : '' }}>
                                                                    S-Surroundings</option>
                                                                <option value="S-Systems"
                                                                    {{ array_key_exists('rootCauseCategory', $root_cause_dat) && $root_cause_dat['rootCauseCategory'] == 'S-Systems' ? 'selected' : '' }}>
                                                                    S-Systems</option>

                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select
                                                                name="rootCauseData[{{ $loop->index }}][rootCauseSubCategory]"
                                                                id="Root_Cause_Sub_Category_Select"
                                                                class="Root_Cause_Sub_Category_Select">
                                                                <option value="">-- Select --</option>

                                                                <option value="Infrequent_Audits"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Infrequent_Audits' ? 'selected' : '' }}>
                                                                    Infrequent Audits </option>
                                                                <option
                                                                    value="No_Preventive_Maintenance {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'No_Preventive_Maintenance' ? 'selected' : '' }}">
                                                                    No Preventive Maintenance </option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Poor_Maintenance_or_Design"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Poor_Maintenance_or_Design' ? 'selected' : '' }}>
                                                                    Poor Maintenance or Design </option>
                                                                <option value="Maintenance Needs Improvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Maintenance Needs Improvement' ? 'selected' : '' }}>
                                                                    Maintenance Needs Improvement </option>
                                                                <option value="Scheduling Problem"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Scheduling Problem' ? 'selected' : '' }}>
                                                                    Scheduling Problem </option>
                                                                <option value="System Deficiency"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'System Deficiency' ? 'selected' : '' }}>
                                                                    System Deficiency </option>
                                                                <option value="Technical Error"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Technical Error' ? 'selected' : '' }}>
                                                                    Technical Error </option>
                                                                <option value="Tolerable Failure"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Tolerable Failure' ? 'selected' : '' }}>
                                                                    Tolerable Failure </option>
                                                                <option value="Calibration Issues"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Calibration Issues' ? 'selected' : '' }}>
                                                                    Calibration Issues </option>

                                                                <option value="Infrequent_Audits"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Infrequent_Audits' ? 'selected' : '' }}>
                                                                    Infrequent Audits </option>
                                                                <option
                                                                    value="No_Preventive_Maintenance {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'No_Preventive_Maintenance' ? 'selected' : '' }}">
                                                                    No Preventive Maintenance </option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Maintenance Needs Improvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Maintenance Needs Improvement' ? 'selected' : '' }}>
                                                                    Maintenance Needs Improvement </option>
                                                                <option value="Scheduling Problem"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Scheduling Problem' ? 'selected' : '' }}>
                                                                    Scheduling Problem </option>
                                                                <option value="System Deficiency"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'System Deficiency' ? 'selected' : '' }}>
                                                                    System Deficiency </option>
                                                                <option value="Technical Error"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Technical Error' ? 'selected' : '' }}>
                                                                    Technical Error </option>
                                                                <option value="Tolerable Failure"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Tolerable Failure' ? 'selected' : '' }}>
                                                                    Tolerable Failure </option>


                                                                <option value="Failure_to_Follow_SOP"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Failure_to_Follow_SOP' ? 'selected' : '' }}>
                                                                    Failure to Follow SOP</option>
                                                                <option value="Human_Machine_Interface"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Human_Machine_Interface' ? 'selected' : '' }}>
                                                                    Human-Machine Interface</option>
                                                                <option value="Misunderstood_Verbal_Communication"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Misunderstood_Verbal_Communication' ? 'selected' : '' }}>
                                                                    Misunderstood Verbal Communication </option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Personnel Error"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Personnel Error' ? 'selected' : '' }}>
                                                                    Personnel Error</option>
                                                                <option value="Personnel not Qualified"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Personnel not Qualified' ? 'selected' : '' }}>
                                                                    Personnel not Qualified</option>
                                                                <option value="Practice Needed"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Practice Needed' ? 'selected' : '' }}>
                                                                    Practice Needed</option>
                                                                <option value="Teamwork Needs Improvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Teamwork Needs Improvement' ? 'selected' : '' }}>
                                                                    Teamwork Needs Improvement</option>
                                                                <option value="Attention"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Attention' ? 'selected' : '' }}>
                                                                    Attention</option>
                                                                <option value="Understanding"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Understanding' ? 'selected' : '' }}>
                                                                    Understanding</option>
                                                                <option value="Procedural"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Procedural' ? 'selected' : '' }}>
                                                                    Procedural</option>
                                                                <option value="Behavioral"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Behavioral' ? 'selected' : '' }}>
                                                                    Behavioral</option>
                                                                <option value="Skill"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Skill' ? 'selected' : '' }}>
                                                                    Skill</option>

                                                                <option value="Inattention to task"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Inattention to task' ? 'selected' : '' }}>
                                                                    Inattention to task</option>
                                                                <option value="Lack of Process"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Lack of Process' ? 'selected' : '' }}>
                                                                    Lack of Process</option>
                                                                <option value="Methods"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Methods' ? 'selected' : '' }}>
                                                                    Methods</option>
                                                                <option value="No or poor management involvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'No or poor management involvement' ? 'selected' : '' }}>
                                                                    No or Poor Management Involvement</option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Personnel not Qualified"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Personnel not Qualified' ? 'selected' : '' }}>
                                                                    Personnel not Qualified</option>
                                                                <option value="Poor employee involvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Poor employee involvement' ? 'selected' : '' }}>
                                                                    Poor employee involvement</option>
                                                                <option value="Poor recognition of hazard"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Poor recognition of hazard' ? 'selected' : '' }}>
                                                                    Poor recognition of hazard</option>
                                                                <option value="Previously identified hazards were not eliminated"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Previously identified hazards were not eliminated' ? 'selected' : '' }}>
                                                                    Previously identified hazards were not eliminated</option>
                                                                <option value="Stress demands"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Stress demands' ? 'selected' : '' }}>
                                                                    Stress demands</option>
                                                                <option value="Task hazards not guarded properly"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Task hazards not guarded properly' ? 'selected' : '' }}>
                                                                    Task hazards not guarded properly</option>
                                                                <option value="Training or education lacking"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Training or education lacking' ? 'selected' : '' }}>
                                                                    Training or education lacking</option>

                                                                <option value="Defective equipment or tool"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Defective equipment or tool' ? 'selected' : '' }}>
                                                                    Defective equipment or tool</option>
                                                                <option value="Defective raw material"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Defective raw material' ? 'selected' : '' }}>
                                                                    Defective raw material</option>
                                                                <option value="Incorrect tool selection"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Incorrect tool selection' ? 'selected' : '' }}>
                                                                    Incorrect tool selection</option>
                                                                <option value="Lack of raw material"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Lack of raw material' ? 'selected' : '' }}>
                                                                    Lack of raw material</option>
                                                                <option value="Machine / Equipment"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Machine / Equipment' ? 'selected' : '' }}>
                                                                    Machine / Equipment</option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Poor equipment or tool placement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Poor equipment or tool placement' ? 'selected' : '' }}>
                                                                    Poor equipment or tool placement</option>
                                                                <option value="Poor maintenance or design"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Poor maintenance or design' ? 'selected' : '' }}>
                                                                    Poor maintenance or design</option>
                                                                <option value="Wrong type for job"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Wrong type for job' ? 'selected' : '' }}>
                                                                    Wrong type for job</option>

                                                                <option value="Instruction Needs Improvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Instruction Needs Improvement' ? 'selected' : '' }}>
                                                                    Instruction Needs Improvement</option>
                                                                <option value="Learning Objective Needs Improvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Learning Objective Needs Improvement' ? 'selected' : '' }}>
                                                                    Learning Objective Needs Improvement</option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Poor employee involvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Poor employee involvement' ? 'selected' : '' }}>
                                                                    Poor employee involvement</option>
                                                                <option value="Poor recognition of hazard"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Poor recognition of hazard' ? 'selected' : '' }}>
                                                                    Poor recognition of hazard</option>
                                                                <option value="Previously identified hazards were not eliminated"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Previously identified hazards were not eliminated' ? 'selected' : '' }}>
                                                                    Previously identified hazards were not eliminated</option>
                                                                <option value="Scheduling Problem"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Scheduling Problem' ? 'selected' : '' }}>
                                                                    Scheduling Problem</option>
                                                                <option value="Training or education lacking"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Training or education lacking' ? 'selected' : '' }}>
                                                                    Training or education lacking</option>
                                                                <option value="Wrong Sequence"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Wrong Sequence' ? 'selected' : '' }}>
                                                                    Wrong Sequence</option>

                                                                <option value="Forces of nature"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Forces of nature' ? 'selected' : '' }}>
                                                                    Forces of nature</option>
                                                                <option value="Job design or layout of work"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Job design or layout of work' ? 'selected' : '' }}>
                                                                    Job design or layout of work</option>
                                                                <option value="Orderly workplace"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Orderly workplace' ? 'selected' : '' }}>
                                                                    Orderly workplace</option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Physical demands of the task"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Physical demands of the task' ? 'selected' : '' }}>
                                                                    Physical demands of the task</option>
                                                                <option value="Surfaces poorly maintained"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Surfaces poorly maintained' ? 'selected' : '' }}>
                                                                    Surfaces poorly maintained</option>

                                                                <option value="Forces of nature"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Forces of nature' ? 'selected' : '' }}>
                                                                    Forces of nature</option>
                                                                <option value="Job design or layout of work"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Job design or layout of work' ? 'selected' : '' }}>
                                                                    Job design or layout of work</option>
                                                                <option value="Orderly workplace"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Orderly workplace' ? 'selected' : '' }}>
                                                                    Orderly workplace</option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Physical demands of the task"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Physical demands of the task' ? 'selected' : '' }}>
                                                                    Physical demands of the task</option>
                                                                <option value="Surfaces poorly maintained"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Surfaces poorly maintained' ? 'selected' : '' }}>
                                                                    Surfaces poorly maintained</option>

                                                                <option value="Instruction Needs Improvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Instruction Needs Improvement' ? 'selected' : '' }}>
                                                                    Instruction Needs Improvement</option>
                                                                <option value="Learning Objective Needs Improvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Learning Objective Needs Improvement' ? 'selected' : '' }}>
                                                                    Learning Objective Needs Improvement</option>
                                                                <option value="No Standard / Policy"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'No Standard / Policy' ? 'selected' : '' }}>
                                                                    No Standard / Policy</option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Wrong Revision Used"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Wrong Revision Used' ? 'selected' : '' }}>
                                                                    Wrong Revision Used</option>

                                                                <option value="No Budget"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'No Budget' ? 'selected' : '' }}>
                                                                    No Budget</option>
                                                                <option value="No Preparation"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'No Preparation' ? 'selected' : '' }}>
                                                                    No Preparation</option>
                                                                <option value="No Standard / Policy"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'No Standard / Policy' ? 'selected' : '' }}>
                                                                    No Standard / Policy</option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Wrong Estimation"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Wrong Estimation' ? 'selected' : '' }}>
                                                                    Wrong Estimation</option>

                                                                <option value="Learning Objective Needs Improvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Learning Objective Needs Improvement' ? 'selected' : '' }}>
                                                                    Learning Objective Needs Improvement</option>
                                                                <option value="Management system"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Management system' ? 'selected' : '' }}>
                                                                    Management system</option>
                                                                <option value="No or poor procedures"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'No or poor procedures' ? 'selected' : '' }}>
                                                                    No or poor procedures</option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Poor communication"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Poor communication' ? 'selected' : '' }}>
                                                                    Poor communication</option>
                                                                <option value="Poor employee involvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Poor employee involvement' ? 'selected' : '' }}>
                                                                    Poor employee involvement</option>
                                                                <option value="Practices are not the same as written procedures"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Practices are not the same as written procedures' ? 'selected' : '' }}>
                                                                    Practices are not the same as written procedures</option>
                                                                <option value="Previously identified hazards were not eliminated"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Previously identified hazards were not eliminated' ? 'selected' : '' }}>
                                                                    Previously identified hazards were not eliminated</option>
                                                                <option value="Procedure Difficult to Use"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Procedure Difficult to Use' ? 'selected' : '' }}>
                                                                    Procedure Difficult to Use</option>
                                                                <option value="Training or education lacking"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Training or education lacking' ? 'selected' : '' }}>
                                                                    Training or education lacking</option>
                                                                <option value="Wrong Revision Used"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Wrong Revision Used' ? 'selected' : '' }}>
                                                                    Wrong Revision Used</option>

                                                                <option value="Instruction Needs Improvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Instruction Needs Improvement' ? 'selected' : '' }}>
                                                                    Instruction Needs Improvement</option>
                                                                <option value="Learning Objective Needs Improvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Learning Objective Needs Improvement' ? 'selected' : '' }}>
                                                                    Learning Objective Needs Improvement</option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Poor employee involvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Poor employee involvement' ? 'selected' : '' }}>
                                                                    Poor employee involvement</option>
                                                                <option value="Poor recognition of hazard"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Poor recognition of hazard' ? 'selected' : '' }}>
                                                                    Poor recognition of hazard</option>
                                                                <option value="Previously identified hazards were not eliminated"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Previously identified hazards were not eliminated' ? 'selected' : '' }}>
                                                                    Previously identified hazards were not eliminated</option>
                                                                <option value="Scheduling Problem"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Scheduling Problem' ? 'selected' : '' }}>
                                                                    Scheduling Problem</option>
                                                                <option value="Training or education lacking"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Training or education lacking' ? 'selected' : '' }}>
                                                                    Training or education lacking</option>
                                                                <option value="Wrong Sequence"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Wrong Sequence' ? 'selected' : '' }}>
                                                                    Wrong Sequence</option>

                                                                <option value="Defective equipment or tool"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Defective equipment or tool' ? 'selected' : '' }}>
                                                                    Defective equipment or tool</option>
                                                                <option value="OtherDefective raw material"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Defective raw material' ? 'selected' : '' }}>
                                                                    Defective raw material</option>
                                                                <option value="Incorrect tool selection"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Incorrect tool selection' ? 'selected' : '' }}>
                                                                    Incorrect tool selection</option>
                                                                <option value="Lack of raw material"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Lack of raw material' ? 'selected' : '' }}>
                                                                    Lack of raw material</option>
                                                                <option value="Machine / Equipment"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Machine / Equipment' ? 'selected' : '' }}>
                                                                    Machine / Equipment</option>
                                                                <option value="Poor equipment or tool placement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Poor equipment or tool placement' ? 'selected' : '' }}>
                                                                    Poor equipment or tool placement</option>
                                                                <option value="Poor maintenance or design"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Poor maintenance or design' ? 'selected' : '' }}>
                                                                    Poor maintenance or design</option>
                                                                <option value="Wrong type for job"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Wrong type for job' ? 'selected' : '' }}>
                                                                    Wrong type for job</option>

                                                                <option value="Infrequent Audits"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Infrequent Audits' ? 'selected' : '' }}>
                                                                    Infrequent Audits</option>
                                                                <option value="Misunderstood Verbal Communication"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Misunderstood Verbal Communication' ? 'selected' : '' }}>
                                                                    Misunderstood Verbal Communication</option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Personnel not Qualified"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Personnel not Qualified' ? 'selected' : '' }}>
                                                                    Personnel not Qualified</option>
                                                                <option value="Shift Change Communication"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Shift Change Communication' ? 'selected' : '' }}>
                                                                    Shift Change Communication</option>
                                                                <option value="Task Not Analyzed"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Task Not Analyzed' ? 'selected' : '' }}>
                                                                    Task Not Analyzed</option>

                                                                <option value="Forces of nature"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Forces of nature' ? 'selected' : '' }}>
                                                                    Forces of nature</option>
                                                                <option value="Job design or layout of work"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Job design or layout of work' ? 'selected' : '' }}>
                                                                    Job design or layout of work</option>
                                                                <option value="Orderly workplace"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Orderly workplace' ? 'selected' : '' }}>
                                                                    Orderly workplace</option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Physical demands of the task"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Physical demands of the task' ? 'selected' : '' }}>
                                                                    Physical demands of the task</option>
                                                                <option value="Surfaces poorly maintained"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Surfaces poorly maintained' ? 'selected' : '' }}>
                                                                    Surfaces poorly maintained</option>

                                                                <option value="Infrequent Audits"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Infrequent Audits' ? 'selected' : '' }}>
                                                                    Infrequent Audits</option>
                                                                <option value="No Preventive Maintenance"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'No Preventive Maintenance' ? 'selected' : '' }}>
                                                                    No Preventive Maintenance</option>
                                                                <option value="Other"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                                <option value="Poor maintenance or design"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Poor maintenance or design' ? 'selected' : '' }}>
                                                                    Poor maintenance or design</option>
                                                                <option value="Maintenance Needs Improvement"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Maintenance Needs Improvement' ? 'selected' : '' }}>
                                                                    Maintenance Needs Improvement</option>
                                                                <option value="Scheduling Problem"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Scheduling Problem' ? 'selected' : '' }}>
                                                                    Scheduling Problem</option>
                                                                <option value="System Deficiency"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'System Deficiency' ? 'selected' : '' }}>
                                                                    System Deficiency</option>
                                                                <option value="Technical Error"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Technical Error' ? 'selected' : '' }}>
                                                                    Technical Error</option>
                                                                <option value="Tolerable Failure"
                                                                    {{ array_key_exists('rootCauseSubCategory', $root_cause_dat) && $root_cause_dat['rootCauseSubCategory'] == 'Tolerable Failure' ? 'selected' : '' }}>
                                                                    Tolerable Failure</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="Document_Remarks"
                                                                name="rootCauseData[{{ $loop->index }}][ifOthers]"
                                                                value="{{ array_key_exists('ifOthers', $root_cause_dat) ? $root_cause_dat['ifOthers'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="Document_Remarks"
                                                                name="rootCauseData[{{ $loop->index }}][probability]"
                                                                value="{{ array_key_exists('probability', $root_cause_dat) ? $root_cause_dat['probability'] : '' }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="Document_Remarks"
                                                                name="rootCauseData[{{ $loop->index }}][remarks]"
                                                                value="{{ array_key_exists('remarks', $root_cause_dat) ? $root_cause_dat['remarks'] : '' }}">
                                                        </td>
                                                        <td><input type="text" class="Removebtn" name="Action[]"></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <td><input disabled type="text" name="rootCauseData[0][serial]"
                                                        value="1"></td>
                                                <td><select name="rootCauseData[0][rootCauseCategory]"
                                                        id="Root_Cause_Category_Select" class="Root_Cause_Category_Select">
                                                        <option value="">-- Select --</option>

                                                        <option value="M-Machine(Equipment)">M-Machine(Equipment)</option>
                                                        <option value="M-Maintenance">M-Maintenance</option>
                                                        <option value="M-Man Power (physical work)">M-Man Power (physical work)
                                                        </option>
                                                        <option value="M-Management">M-Management</option>
                                                        <option value="M-Material (Raw,Consumables etc.)">M-Material
                                                            (Raw,Consumables etc.)
                                                        </option>
                                                        <option value="M-Method (Process/Inspection)">M-Method
                                                            (Process/Inspection)</option>
                                                        <option value="M-Mother Nature (Environment)">M-Mother Nature
                                                            (Environment)</option>
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
                                                <td><select name="rootCauseData[0][rootCauseSubCategory]"
                                                        id="Root_Cause_Sub_Category_Select"
                                                        class="Root_Cause_Sub_Category_Select">
                                                        <option value="">-- Select --</option>

                                                        <option value="infrequent_audits">Infrequent Audits </option>
                                                        <option value="No_Preventive_Maintenance">No Preventive Maintenance
                                                        </option>
                                                        <option value="Other">Other</option>
                                                        <option value="Poor_Maintenance_or_Design">Poor Maintenance or Design
                                                        </option>
                                                        <option value="Maintenance_Needs_Improvement">Maintenance Needs
                                                            Improvement </option>
                                                        <option value="Scheduling_Problem">Scheduling Problem </option>
                                                        <option value="system_deficiency">System Deficiency </option>
                                                        <option value="technical_error">Technical Error </option>
                                                        <option value="tolerable_failure">Tolerable Failure </option>
                                                        <option value="calibration_issues">Calibration Issues </option>

                                                        <option value="Infrequent_Audits">Infrequent Audits</option>
                                                        <option value="No_Preventive_Maintenance">No Preventive Maintenance
                                                        </option>
                                                        <option value="Other">Other</option>
                                                        <option value="Maintenance_Needs_Improvement">Maintenance Needs
                                                            Improvement</option>
                                                        <option value="Scheduling_Problem ">Scheduling Problem </option>
                                                        <option value="System_Deficiency">System Deficiency </option>
                                                        <option value="Technical_Error ">Technical Error </option>
                                                        <option value="Tolerable_Failure">Tolerable Failure </option>


                                                        <option value="Failure_to_Follow_SOP">Failure to Follow SOP</option>
                                                        <option value="Human_Machine_Interface">Human-Machine Interface</option>
                                                        <option value="Misunderstood_Verbal_Communication">Misunderstood Verbal
                                                            Communication
                                                        </option>
                                                        <option value="Other">Other</option>
                                                        <option value="Personnel Error">Personnel Error</option>
                                                        <option value="Personnel not Qualified">Personnel not Qualified</option>
                                                        <option value="Practice Needed">Practice Needed</option>
                                                        <option value="Teamwork Needs Improvement">Teamwork Needs Improvement
                                                        </option>
                                                        <option value="Attention">Attention</option>
                                                        <option value="Understanding">Understanding</option>
                                                        <option value="Procedural">Procedural</option>
                                                        <option value="Behavioral">Behavioral</option>
                                                        <option value="Skill">Skill</option>

                                                        <option value="Inattention to task">Inattention to task</option>
                                                        <option value="Lack of Process">Lack of Process</option>
                                                        <option value="Methods">Methods</option>
                                                        <option value="No or Poor Management Involvement">No or Poor Management
                                                            Involvement
                                                        </option>
                                                        <option value="Other">Other</option>
                                                        <option value="Personnel not Qualified">Personnel not Qualified</option>
                                                        <option value="Poor employee involvement">Poor employee involvement
                                                        </option>
                                                        <option value="Poor recognition of hazard">Poor recognition of hazard
                                                        </option>
                                                        <option value="Previously identified hazards were not eliminated">
                                                            Previously identified
                                                            hazards were not eliminated</option>
                                                        <option value="Stress demands">Stress demands</option>
                                                        <option value="Task hazards not guarded properly">Task hazards not guarded
                                                            properly
                                                        </option>
                                                        <option value="Personnel not Qualified">Personnel not Qualified</option>

                                                    </select></td>
                                                <td><input type="text" class="Document_Remarks"
                                                        name="rootCauseData[0][ifOthers]"></td>
                                                <td><input type="text" class="Document_Remarks"
                                                        name="rootCauseData[0][probability]"></td>
                                                <td><input type="text" class="Document_Remarks"
                                                        name="rootCauseData[0][remarks]"></td>
                                                <td><input type="text" class="Removebtn" name="Action[]" readonly></td>
                                            @endif
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Capa Required">CAPA Required ? <span
                                        class="text-danger">*</span></label>
                                <select
                                    name="capa_required"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
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


                        <div class="col-md-12 mb-3">
                            <div class="group-input">
                                <label for="Immediate_Action_Take">Detail Of Root Cause </label>
                                <textarea class="tiny" name="detail_of_root" id="detail_of_root">{{ $data->detail_of_root }}</textarea>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="short_description_required">Product Quality Impact</label>
                                    <select name="product_quality_imapct" id="product_quality_imapct">
                                        <option value="0">-- Select --</option>
                                        <option @if ($data->product_quality_imapct == 'yes') selected @endif value="yes">Yes</option>
                                        <option @if ($data->product_quality_imapct == 'no') selected @endif value="no">No</option>
                                        <option @if ($data->product_quality_imapct == 'na') selected @endif value="na">NA </option>

                                    </select>
                                </div>
                                @error('product_quality_imapct')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="process_performance_impact">Process Performance Impact</label>
                                    <select name="process_performance_impact" id="process_performance_impact">
                                        <option value="0">-- Select --</option>
                                        <option @if ($data->process_performance_impact == 'yes') selected @endif value="yes">Yes</option>
                                        <option @if ($data->process_performance_impact == 'no') selected @endif value="no">No</option>
                                        <option @if ($data->process_performance_impact == 'na') selected @endif value="na">NA </option>

                                    </select>
                                </div>
                                @error('process_performance_impact')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}


                        {{-- <div class="row">
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="process_performance_impact">Yield Impact</label>
                                    <select name="yield_impact" id="yield_impact">
                                        <option value="0">-- Select --</option>
                                        <option @if ($data->yield_impact == 'yes') selected @endif value="yes">Yes</option>
                                        <option @if ($data->yield_impact == 'no') selected @endif value="no">No</option>
                                        <option @if ($data->yield_impact == 'na') selected @endif value="na">NA </option>
                                    </select>
                                </div>
                                @error('yield_impact')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="additionl_testing_required">Addtitional Testing Required</label>
                                    <select name="additionl_testing_required" id="additionl_testing_required">
                                        <option value="0">-- Select --</option>
                                        <option @if ($data->additionl_testing_required == 'yes') selected @endif value="yes">Yes</option>
                                        <option @if ($data->additionl_testing_required == 'no') selected @endif value="no">No</option>
                                        <option @if ($data->additionl_testing_required == 'na') selected @endif value="na">NA </option>
                                    </select>
                                </div>
                                @error('additionl_testing_required')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="row">
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="any_similar_incident_in_past"> Any Similar Incident In Past</label>
                                    <select name="any_similar_incident_in_past" id="any_similar_incident_in_past">
                                        <option value="0">-- Select --</option>
                                        <option @if ($data->any_similar_incident_in_past == 'yes') selected @endif value="yes">Yes</option>
                                        <option @if ($data->any_similar_incident_in_past == 'no') selected @endif value="no">No</option>
                                        <option @if ($data->any_similar_incident_in_past == 'na') selected @endif value="na">NA </option>
                                    </select>
                                </div>
                                @error('any_similar_incident_in_past')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="classification_by_qa"> Classification By QA</label>
                                    <select name="classification_by_qa" id="classification_by_qa">
                                        <option value="0">-- Select --</option>
                                        <option @if ($data->classification_by_qa == 'yes') selected @endif value="yes">Yes</option>
                                        <option @if ($data->classification_by_qa == 'no') selected @endif value="no">No</option>
                                        <option @if ($data->classification_by_qa == 'na') selected @endif value="na">NA </option>
                                    </select>
                                </div>
                                @error('classification_by_qa')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div> --
                        </div> --}}



                        {{-- <div class="row">
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="gmp_impact">GMP Impact</label>
                                    <select name="gmp_impact" id="gmp_impact">
                                        <option value="0">-- Select --</option>
                                        <option @if ($data->gmp_impact == 'yes') selected @endif value="yes">Yes</option>
                                        <option @if ($data->gmp_impact == 'no') selected @endif value="no">No</option>
                                        <option @if ($data->gmp_impact == 'na') selected @endif value="na">NA </option>
                                    </select>
                                </div>
                                @error('yield_impact')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="button-block">
                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="submit"
                                class="saveButton" {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>Save</button>
                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"
                                class="nextButton" onclick="nextStep()">Next</button>
                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a
                                    href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                            @if (
                                $data->stage == 2 ||
                                    $data->stage == 3 ||
                                    $data->stage == 4 ||
                                    $data->stage == 5 ||
                                    $data->stage == 6 ||
                                    $data->stage == 7)
                                {{-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                    class="button  launch_extension" data-bs-toggle="modal"
                                    data-bs-target="#launch_extension">
                                    Launch Extension
                                </a> --}}
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
                            {{-- @if ($capaExtension && $capaExtension->capa_proposed_due_date)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="capa_proposed_due_date"><b>Proposed Due Date</b></label>
                                        <input disabled type="text" name="capa_proposed_due_date"
                                            id="capa_proposed_due_date"
                                            value="{{ Helpers::getdateFormat($capaExtension->capa_proposed_due_date) }}">
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="capa_proposed_due_date"><b>Proposed Due Date</b></label>
                                        <input disabled type="text" name="capa_proposed_due_date"
                                            id="capa_proposed_due_date">
                                    </div>
                                </div>
                            @endif --}}
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
                                                        @if ($data->stage == 4) disabled @endif id="Other1_Department_person" value="{{ $data1->Other1_Department_person }}">
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
                                        @if ($data->stage == 4) disabled @endif id="department_capa"
                                        value="{{ $data->department_capa }}">
                                        <option value="0">-- Select --</option>
                                        <option @if ($data->department_capa == 'CQA') selected @endif value="CQA">Corporate
                                            Quality Assurance</option>
                                        <option @if ($data->department_capa == 'QAB') selected @endif value="QAB">Quality
                                            Assurance Biopharma</option>
                                        <option @if ($data->department_capa == 'CQC') selected @endif value="QAB">Central
                                            Quality Control</option>
                                        <option @if ($data->department_capa == 'CQC') selected @endif value="QAB">Central
                                            Quality Control</option>
                                        <option @if ($data->department_capa == 'MANU') selected @endif value="MANU">Manufacturing
                                        </option>
                                        <option @if ($data->department_capa == 'PSG') selected @endif value="PSG">Plasma
                                            Sourcing Group</option>
                                        <option @if ($data->department_capa == 'CS') selected @endif value="CS">Central
                                            Stores</option>
                                        <option @if ($data->department_capa == 'ITG') selected @endif value="ITG">Information
                                            Technology Group </option>
                                        <option @if ($data->department_capa == 'MM') selected @endif value="MM">Molecular
                                            Medicine </option>
                                        <option @if ($data->department_capa == 'CL') selected @endif value="CL">Central
                                            Laboratory </option>
                                        <option @if ($data->department_capa == 'QA') selected @endif value="QA">Quality
                                            Assurance </option>
                                        <option @if ($data->department_capa == 'TT') selected @endif value="TT">Tech team
                                        </option>
                                        <option @if ($data->department_capa == 'QM') selected @endif value="QM">Quality
                                            Management </option>
                                        <option @if ($data->department_capa == 'IA') selected @endif value="IA">IT
                                            Administration </option>
                                        <option @if ($data->department_capa == 'ACC') selected @endif value="ACC">Accounting
                                        </option>
                                        <option @if ($data->department_capa == 'LOG') selected @endif value="LOG">Logistics
                                        </option>
                                        <option @if ($data->department_capa == 'SM') selected @endif value="SM">Senior
                                            Management </option>
                                        <option @if ($data->department_capa == 'BA') selected @endif value="BA">Business
                                            Administration </option>
                                    </select>
                                    @error('department_capa')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div style="margin-bottom: 0px;" class="col-lg-12 new-date-data-field ">
                                <div class="group-input input-date">
                                    <label for="Incident category">Source of CAPA</label>
                                    <select name="source_of_capa" id="incident_category"
                                        @if ($data->stage == 4) disabled @endif id="incident_category"
                                        value="{{ $data->source_of_capa }}">
                                        <option value="0">-- Select -- </option>
                                        <option @if ($data->source_of_capa == 'Incident') selected @endif value="Incident">Incident
                                        </option>
                                        <option @if ($data->source_of_capa == 'OS/OT') selected @endif value="OS/OT">OS/OT
                                        </option>
                                        <option @if ($data->source_of_capa == 'Audit_Obs') selected @endif value="Audit_Obs">Audit
                                            Observation</option>
                                        <option @if ($data->source_of_capa == 'Complaint') selected @endif value="Complaint">Complaint
                                        </option>
                                        <option @if ($data->source_of_capa == 'Product_Recall') selected @endif value="Product_Recall">
                                            Product Recall</option>
                                        <option @if ($data->source_of_capa == 'Returned_Goods') selected @endif value="Returned_Goods">
                                            Returned Goods</option>
                                        <option @if ($data->source_of_capa == 'APQR') selected @endif value="APQR">APQR</option>
                                        <option @if ($data->source_of_capa == 'Management_Review_Action_Plan') selected @endif
                                            value="Management_Review_Action_Plan">Management Review Action Plan</option>
                                        <option @if ($data->source_of_capa == 'Investigation') selected @endif value="Investigation">
                                            Investigation</option>
                                        <option @if ($data->source_of_capa == 'Internal_Review') selected @endif value="Internal_Review">
                                            Internal Review</option>
                                        <option @if ($data->source_of_capa == 'Quality_Risk_Assessment') selected @endif
                                            value="Quality_Risk_Assessment">Quality Risk Assessment</option>
                                        <option value="Others">Others</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-lg-6" id="capa_others_block" style="display: none">
                                <div class="group-input">
                                    <label for="others">Others <span id="asteriskInviothers" style="display: none"
                                            class="text-danger">*</span></label>
                                    <input type="text" id="others" name="capa_others" class="others">
                                </div>
                            </div>

                            <script>
                                $('select[name=source_of_capa]').change(function() {
                                    $(this).val() == 'Others' ? $('#capa_others_block').fadeIn() : $('#capa_others_block').fadeOut()
                                })
                            </script>

                            <div class="col-lg-6" id="others_block">
                                <div class="group-input">
                                    <label for="others">Source Document</label>
                                    <input type="text" id="source_doc" name="source_doc"
                                        value="{{ $data->source_doc }}" class="source_doc">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Description_of_Discrepancy">Description of Discrepancy </label>
                                    <textarea class="tiny" name="Description_of_Discrepancy" id="Description_of_Discrepancy" value="">{{ $data->Description_of_Discrepancy }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Root_Cause">Root Cause</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                            completion</small></div>
                                    <textarea class="tiny" name="capa_root_cause" id="capa_root_cause">{{ $data->capa_root_cause }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Immediate_Action_Take">Immediate Action Taken (If Applicable)</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                            completion</small></div>
                                    <textarea class="tiny" name="Immediate_Action_Take" id="Immediate_Action_Take">{{ $data->Immediate_Action_Take }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Corrective_Action_Details">Corrective Action Details</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                            completion</small></div>
                                    <textarea class="tiny" name="Corrective_Action_Details" id="Corrective_Action_Details" value="">{{ $data->Corrective_Action_Details }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Preventive_Action_Details">Preventive Action Details</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                            completion</small></div>
                                    <textarea class="tiny" name="Preventive_Action_Details" id="Preventive_Action_Details" value="">{{ $data->Preventive_Action_Details }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Audit Schedule End Date">Target Completion Date</label>
                                    {{-- <div class="calenderauditee">
                                <input readonly type="text" id="Capa_reported_date"  value="{{ date('d-M-Y') }}" name="capa_completed_date" style="background-color: light-dark(rgba(239, 239, 239, 0.3), rgba(59, 59, 59, 0.3))"/>
                                    <input type="date" value="{{ $data->capa_completed_date }}" name="capa_completed_date"
                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" value=""
                                        oninput="handleDateInput(this, 'Capa_reported_date')" />
                                </div> --}}
                                    <div class="calenderauditee">
                                        <input type="text" id="capa_completed_date" readonly placeholder="DD-MM-YYYY"
                                            value="{{ $data->capa_completed_date ? \Carbon\Carbon::parse($data->capa_completed_date)->format('d-M-Y') : '' }}" />
                                        <input type="date" name="capa_completed_date"
                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                            value="{{ $data->capa_completed_date ?? '' }}" class="hide-input"
                                            oninput="handleDateInput(this, 'capa_completed_date')" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Interim_Control">Interim Control(If Any)</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                            completion</small></div>
                                    <textarea class="tiny" name="Interim_Control" id="Interim_Control" value="">{{ $data->Interim_Control }}</textarea>
                                </div>
                            </div>
                            <div class="sub-head">
                                CAPA Implementation
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Corrective_Action_Taken">Corrective Action Taken</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                            completion</small></div>
                                    <textarea class="tiny" name="Corrective_Action_Taken" id="Corrective_Action_Taken" value="">{{ $data->Corrective_Action_Taken }}</textarea>
                                </div>

                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Preventive_action_Taken">Preventive Action Taken</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                            completion</small></div>
                                    <textarea class="tiny" name="Preventive_action_Taken" id="Preventive_action_Taken" value="">{{ $data->Preventive_action_Taken }}</textarea>
                                </div>
                            </div>
                            <div class="sub-head">
                                CAPA Closure
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="CAPA_Closure_Comments">CAPA Closure Comments</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require
                                            completion</small></div>
                                    <textarea class="" name="CAPA_Closure_Comments" id="CAPA_Closure_Comments">{{ $data->CAPA_Closure_Comments }}</textarea>
                                </div>

                                <div class="col-lg-12">
                                    @if ($data->stage == 7)
                                        <div class="group-input">
                                            <label for="CAPA_Closure_attachment Attachment">CAPA Closure Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="CAPA_Closure_attachment">
                                                    @if ($data->CAPA_Closure_attachment)
                                                        @foreach (json_decode($data->CAPA_Closure_attachment) as $file)
                                                            <h6 class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                        class="fa fa-eye text-primary"
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
                                                    <input type="file" id="CAPA_Closure_attachment"
                                                        name="CAPA_Closure_attachment[]"
                                                        oninput="addMultipleFiles(this, 'CAPA_Closure_attachment')"
                                                        value=""
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        {{ $data->stage == 0 || $data->stage == 2 ? 'disabled' : '' }} multiple>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="group-input">
                                            <label for="CAPA_Closure_attachment Attachment">CAPA Closure Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="CAPA_Closure_attachment">
                                                    @if ($data->CAPA_Closure_attachment)
                                                        @foreach (json_decode($data->CAPA_Closure_attachment) as $file)
                                                            <h6 class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                        class="fa fa-eye text-primary"
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
                                                    <input type="file" id="CAPA_Closure_attachment"
                                                        name="CAPA_Closure_attachment[]"
                                                        oninput="addMultipleFiles(this, 'CAPA_Closure_attachment')"
                                                        value=""
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        {{ $data->stage == 0 || $data->stage == 2 ? 'disabled' : '' }} multiple>
                                                </div>
                                            </div>
                                        </div>
                                    @endif



                                </div>
                            </div>

                            <div class="button-block">
                                <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                    type="submit"{{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}
                                    id="ChangesaveButton04" class=" saveAuditFormBtn d-flex" style="align-items: center;">
                                    <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none"
                                        role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Save
                                </button>
                                <a href="/rcms/qms-dashboard" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                    <button type="button"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                        class="backButton">Back</button>
                                </a>

                                <button style=" justify-content: center; width: 4rem; margin-left: 1px;" type="button"
                                    class="nextButton" onclick="nextStep()">Next</button>
                                <button style=" justify-content: center; width: 4rem; margin-left: 1px;" type="button"> <a
                                        href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                                @if (
                                    $data->stage == 2 ||
                                        $data->stage == 3 ||
                                        $data->stage == 4 ||
                                        $data->stage == 5 ||
                                        $data->stage == 6 ||
                                        $data->stage == 7)
                                    {{-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                        class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#launch_extension">
                                        Launch Extension
                                    </a> --}}
                                @endif
                                <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                                            data-bs-target="#effectivenss_extension">
                                                            Launch Effectiveness Check
                                                        </a> -->
                            </div>
                        </div>
                    </div>
                </div>





                <!-- Effectiveness Check-->

                <div id="CCForm12" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head">
                                Incident Extension
                            </div>

                            @if ($incidentExtension && $incidentExtension->dev_proposed_due_date)
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule End Date">Proposed Due Date (Incident)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="dev_proposed_due_date" id="dev_proposed_due_date"
                                                readonly
                                                value="{{ Helpers::getdateFormat($incidentExtension->dev_proposed_due_date) }}" />
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule End Date">Proposed Due Date (Incident)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="dev_proposed_due_date" id="dev_proposed_due_date"
                                                readonly />
                                        </div>
                                    </div>
                                </div>
                            @endif


                            @if ($incidentExtension && $incidentExtension->dev_extension_justification)
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Extension_Justification_incident">Extension Justification (Incident)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                                require completion</small></div>
                                        <textarea name="dev_extension_justification" placeholder="" disabled id="dev_extension_justification"
                                            value="{{ $incidentExtension->dev_extension_justification }}">{{ $incidentExtension->dev_extension_justification }}</textarea>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Extension_Justification_incident">Extension Justification (Incident)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                                require completion</small></div>
                                        <textarea name="dev_extension_justification" placeholder="" id="dev_extension_justification" disabled></textarea>
                                    </div>
                                </div>
                            @endif

                            @if ($incidentExtension && $incidentExtension->dev_extension_completed_by)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for=" dev_extension_completed_by"> Incident Extension Completed By </label>
                                        <select name="dev_extension_completed_by" id="dev_extension_completed_by" disabled>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    @if ($user->id == $incidentExtension->dev_extension_completed_by) selected @endif>{{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for=" dev_extension_completed_by"> Incident Extension Completed By </label>
                                        <select name="dev_extension_completed_by" id="dev_extension_completed_by" disabled>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            @if ($incidentExtension && $incidentExtension->dev_completed_on)
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule End Date">Incident Extension Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="dev_completed_on" readonly name="dev_completed_on"
                                                placeholder="DD-MM-YYYY"
                                                value="{{ Helpers::getdateFormat($incidentExtension->dev_completed_on) }}" />
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule End Date">Incident Extension Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="dev_completed_on" readonly name="dev_completed_on"
                                                placeholder="DD-MM-YYYY" />
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- CAPA EXTENSION START -->
                            <div class="sub-head">
                                CAPA Extension
                            </div>
                            @if ($capaExtension && $capaExtension->capa_proposed_due_date)
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="capa_proposed_due_date">Proposed Due Date (CAPA)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="capa_proposed_due_date" disabled
                                                name="capa_proposed_due_date" placeholder="DD-MM-YYYY"
                                                value="{{ Helpers::getdateFormat($capaExtension->capa_proposed_due_date) }}" />
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="capa_proposed_due_date">Proposed Due Date (CAPA)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="capa_proposed_due_date" disabled
                                                name="capa_proposed_due_date" placeholder="DD-MM-YYYY" />
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($capaExtension && $capaExtension->capa_extension_justification)
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="capa_extension_justification">Extension Justification (CAPA)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                                require completion</small></div>
                                        <textarea name="capa_extension_justification" placeholder="" id="capa_extension_justification" disabled>{{ $capaExtension->capa_extension_justification }}</textarea>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="capa_extension_justification">Extension Justification (CAPA)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                                require completion</small></div>
                                        <textarea name="capa_extension_justification" placeholder="" id="capa_extension_justification" disabled></textarea>
                                    </div>
                                </div>
                            @endif


                            <div class="row">
                                @if ($capaExtension && $capaExtension->capa_extension_completed_by)
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" capa_extension_completed_by"> CAPA Extension Completed By </label>
                                            <select name="capa_extension_completed_by" id="capa_extension_completed_by"
                                                disabled>

                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if ($user->id == $capaExtension->capa_extension_completed_by) selected @endif>{{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" capa_extension_completed_by"> CAPA Extension Completed By </label>
                                            <select name="capa_extension_completed_by" id="capa_extension_completed_by"
                                                disbaled>

                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                @if ($capaExtension && $capaExtension->capa_completed_on)
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Audit Schedule End Date">CAPA Extension Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="capa_completed_on" name="capa_completed_on" disabled
                                                    placeholder="DD-MM-YYYY"
                                                    value="{{ Helpers::getdateFormat($capaExtension->capa_completed_on) }}" />
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Audit Schedule End Date">CAPA Extension Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="capa_completed_on" name="capa_completed_on" disabled
                                                    placeholder="DD-MM-YYYY" />
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

                            @if ($qrmExtension && $qrmExtension->qrm_proposed_due_date)
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="qrm_proposed_due_date">Proposed Due Date (Quality Risk Management)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="qrm_proposed_due_date" name="qrm_proposed_due_date"
                                                value="{{ Helpers::getdateFormat($qrmExtension->qrm_proposed_due_date) }}"
                                                disabled placeholder="DD-MM-YYYY" />
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="qrm_proposed_due_date">Proposed Due Date (Quality Risk Management)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="qrm_proposed_due_date" name="qrm_proposed_due_date"
                                                disabled placeholder="DD-MM-YYYY" />
                                        </div>
                                    </div>
                                </div>
                            @endif


                            @if ($qrmExtension && $qrmExtension->qrm_extension_justification)
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="qrm_extension_justification">Extension Justification (Quality Risk
                                            Management)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                                require completion</small></div>
                                        <textarea disabled name="qrm_extension_justification" id="qrm_extension_justification"
                                            value="{{ $qrmExtension->qrm_extension_justification }}">{{ $qrmExtension->qrm_extension_justification }}</textarea>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="qrm_extension_justification">Extension Justification (Quality Risk
                                            Management)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                                require completion</small></div>
                                        <textarea disabled name="qrm_extension_justification" placeholder="QRM Extension Justification"
                                            id="qrm_extension_justification"> </textarea>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                @if ($qrmExtension && $qrmExtension->qrm_extension_completed_by)
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="qrm_extension_completed_by"> Quality Risk Management Extension Completed
                                                By </label>
                                            <select name="qrm_extension_completed_by" id="qrm_extension_completed_by" disabled>

                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if ($user->id == $qrmExtension->qrm_extension_completed_by) selected @endif>{{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="qrm_extension_completed_by"> Quality Risk Management Extension Completed
                                                By </label>
                                            <select name="qrm_extension_completed_by" id="qrm_extension_completed_by" disabled>

                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                @if ($qrmExtension && $qrmExtension->qrm_completed_on)
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="qrm_completed_on">Quality Risk Management Extension Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="qrm_completed_on" name="qrm_completed_on"
                                                    value="{{ Helpers::getdateFormat($qrmExtension->qrm_completed_on) }}"
                                                    disabled placeholder="DD-MM-YYYY" />
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="qrm_completed_on">Quality Risk Management Extension Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="qrm_completed_on" name="qrm_completed_on" disabled
                                                    placeholder="DD-MM-YYYY" />
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

                            @if ($investigationExtension && $investigationExtension->investigation_proposed_due_date)
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="investigation_proposed_due_date">Proposed Due Date (Investigation)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="investigation_proposed_due_date"
                                                name="investigation_proposed_due_date"
                                                value="{{ Helpers::getdateFormat($investigationExtension->investigation_proposed_due_date) }}"
                                                disabled placeholder="DD-MM-YYYY" />
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="investigation_proposed_due_date">Proposed Due Date (Investigation)</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="investigation_proposed_due_date"
                                                name="investigation_proposed_due_date" disbaled placeholder="DD-MM-YYYY" />
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($investigationExtension && $investigationExtension->investigation_extension_justification)
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="investigation_extension_justification">Extension Justification
                                            (Investigation)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                                require completion</small></div>
                                        <textarea disabled name="investigation_extension_justification" placeholder=""
                                            id="investigation_extension_justification"
                                            value="{{ $investigationExtension->investigation_extension_justification }}">{{ $investigationExtension->investigation_extension_justification }}</textarea>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="investigation_extension_justification">Extension Justification
                                            (Investigation)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                                require completion</small></div>
                                        <textarea name="investigation_extension_justification" placeholder="" id="investigation_extension_justification"
                                            disabled></textarea>
                                    </div>
                                </div>
                            @endif


                            <div class="row">
                                @if ($investigationExtension && $investigationExtension->investigation_extension_completed_by)
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" Investigation_Extension_Completed_By"> Investigation Extension Completed
                                                By</label>
                                            <select name="investigation_extension_completed_by"
                                                id="investigation_extension_completed_by" disabled>
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if ($user->id == $investigationExtension->investigation_extension_completed_by) selected @endif>{{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for=" Investigation_Extension_Completed_By"> Investigation Extension Completed
                                                By</label>
                                            <select name="investigation_extension_completed_by"
                                                id="investigation_extension_completed_by" disabled>
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                @if ($investigationExtension && $investigationExtension->investigation_completed_on)
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="investigation_completed_on">Investigation Extension Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="investigation_completed_on"
                                                    id="investigation_completed_on"
                                                    value="{{ Helpers::getdateFormat($investigationExtension->investigation_completed_on) }}"
                                                    disabled placeholder="DD-MM-YYYY" />
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="investigation_completed_on">Investigation Extension Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="investigation_completed_on"
                                                    id="investigation_completed_on" disabled placeholder="DD-MM-YYYY" />
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>

                        <div class="button-block">
                            <button style="justify-content: center; width: 4rem; margin-left: 1px;" type="submit"
                                class="saveButton" {{ $data->stage == 9 ? 'disabled' : '' }}>Save</button>
                                <button type="button" class="backButton" style="justify-content: center; width: 4rem; margin-left: 1px;">Back</button>
                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"
                                class="nextButton" onclick="nextStep()">Next</button>
                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a
                                    href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                            @if (
                                $data->stage == 2 ||
                                    $data->stage == 3 ||
                                    $data->stage == 4 ||
                                    $data->stage == 5 ||
                                    $data->stage == 6 ||
                                    $data->stage == 7)
                                {{-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                    class="button  launch_extension" data-bs-toggle="modal"
                                    data-bs-target="#launch_extension">
                                    Launch Extension
                                </a> --}}
                            @endif
                            <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                                            data-bs-target="#effectivenss_extension">
                                                            Launch Effectiveness Check
                                                        </a> -->
                        </div>
                    </div>
                </div>
            </div>


            </div>
            </form>
            <div class="sticky-buttons">
                <div>
                    {{-- <a type="button" class="" data-toggle="modal" data-target="#myModal3">

                        <svg width="18" height="24" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#ffffff"
                                d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34M332.1 128H256V51.9zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288zm220.1-208c-5.7 0-10.6 4-11.7 9.5c-20.6 97.7-20.4 95.4-21 103.5c-.2-1.2-.4-2.6-.7-4.3c-.8-5.1.3.2-23.6-99.5c-1.3-5.4-6.1-9.2-11.7-9.2h-13.3c-5.5 0-10.3 3.8-11.7 9.1c-24.4 99-24 96.2-24.8 103.7c-.1-1.1-.2-2.5-.5-4.2c-.7-5.2-14.1-73.3-19.1-99c-1.1-5.6-6-9.7-11.8-9.7h-16.8c-7.8 0-13.5 7.3-11.7 14.8c8 32.6 26.7 109.5 33.2 136c1.3 5.4 6.1 9.1 11.7 9.1h25.2c5.5 0 10.3-3.7 11.6-9.1l17.9-71.4c1.5-6.2 2.5-12 3-17.3l2.9 17.3c.1.4 12.6 50.5 17.9 71.4c1.3 5.3 6.1 9.1 11.6 9.1h24.7c5.5 0 10.3-3.7 11.6-9.1c20.8-81.9 30.2-119 34.5-136c1.9-7.6-3.8-14.9-11.6-14.9h-15.8z" />
                        </svg>
                    </a> --}}
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
                                <h4 class="modal-titles">Incident Workflow</h4>
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
                                                @if ($qrmExtension && $qrmExtension->counter == 3)
                                                    <a>-------</a>
                                                @else
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#qrm_extension">
                                                        QRM</a>
                                                @endif
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                @if ($investigationExtension && $investigationExtension->counter == 3)
                                                    <a>-------</a>
                                                @else
                                                    <a href=""data-bs-toggle="modal"
                                                        data-bs-target="#investigation_extension"> Investigation</a>
                                                @endif
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                @if ($capaExtension && $capaExtension->counter == 3)
                                                    <a>-------</a>
                                                @else
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#capa_extension">
                                                        CAPA</a>
                                                @endif
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                @if ($incidentExtension && $incidentExtension->counter == 3)
                                                    <a>-------</a>
                                                @else
                                                    <a href="" data-bs-toggle="modal"
                                                        data-bs-target="#incident_extension"> Incident</a>
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
                                    <input class="extension_modal_signature" type="date" name="qrm_proposed_due_date"
                                        id="qrm_proposed_due_date">
                                </div>
                                <div class="group-input">
                                    <label for="password">Extension Justification (QRM)<span
                                            class="text-danger">*</span></label>
                                    <input class="extension_modal_signature" type="text" name="qrm_extension_justification"
                                        id="qrm_extension_justification">
                                </div>
                                <div class="group-input">
                                    <label for="password">Quality Risk Management Extension Completed By </label>
                                    <select class="extension_modal_signature" name="qrm_extension_completed_by"
                                        id="qrm_extension_completed_by">
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="group-input">
                                    <label for="password">Quality Risk Management Extension Completed On </label>
                                    <input class="extension_modal_signature" type="date" name="qrm_completed_on"
                                        id="qrm_completed_on">
                                </div>
                                <input name="incident_id" id="incident_id" value="{{ $data->id }}" hidden>
                                <input name="extension_identifier" id="extension_identifier" value="QRM" hidden>
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
                                    <select class="extension_modal_signature" name="investigation_extension_completed_by"
                                        id="investigation_extension_completed_by">
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="group-input">
                                    <label for="password">Investigation Extension Completed On </label>
                                    <input class="extension_modal_signature" type="date" name="investigation_completed_on"
                                        id="investigation_completed_on">
                                </div>
                                <input name="incident_id" id="incident_id" value="{{ $data->id }}" hidden>
                                <input name="extension_identifier" id="extension_identifier" value="Investigation" hidden>
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
                                    <input class="extension_modal_signature" type="date" name="capa_proposed_due_date"
                                        id="capa_proposed_due_date">
                                </div>
                                <div class="group-input">
                                    <label for="password">Extension Justification (CAPA)<span
                                            class="text-danger">*</span></label>
                                    <input class="extension_modal_signature" type="text"
                                        name="capa_extension_justification" id="capa_extension_justification">
                                </div>
                                <div class="group-input">
                                    <label for="password">CAPA Extension Completed By </label>
                                    <select class="extension_modal_signature" name="capa_extension_completed_by"
                                        id="capa_extension_completed_by">

                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input name="incident_id" id="incident_id" value="{{ $data->id }}" hidden>
                                <input name="extension_identifier" id="extension_identifier" value="Capa" hidden>
                                <div class="group-input">
                                    <label for="password">CAPA Extension Completed On </label>
                                    <input class="extension_modal_signature" type="date" name="capa_completed_on"
                                        id="capa_completed_on">
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


            <div class="modal fade" id="incident_extension">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Incident-Extension</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ route('launch-extension-incident', $data->id) }}" method="post">
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
                                    <label for="password">Proposed Due Date (Incident)</label>
                                    <input class="extension_modal_signature" type="date" name="dev_proposed_due_date"
                                        id="dev_proposed_due_date">
                                </div>
                                <div class="group-input">
                                    <label for="password">Extension Justification (Incident)<span
                                            class="text-danger">*</span></label>
                                    <input class="extension_modal_signature" type="text" name="dev_extension_justification"
                                        id="dev_extension_justification">
                                </div>
                                <div class="group-input">
                                    <label for="password">Incident Extension Completed By </label>
                                    <select class="extension_modal_signature" name="dev_extension_completed_by"
                                        id="dev_extension_completed_by">

                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="group-input">
                                    <label for="password">Incident Extension Completed On </label>
                                    <input class="extension_modal_signature" type="date" name="dev_completed_on"
                                        id="dev_completed_on">
                                </div>
                                <input name="incident_id" id="incident_id" value="{{ $data->id }}" hidden>
                                <input name="extension_identifier" id="extension_identifier" value="Incident" hidden>
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
                                <button type="button" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="incident_effectiveness">
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
                                    <input class="extension_modal_signature" type="text" name="incident_effectiveness_by">
                                </div>
                                <div class="group-input">
                                    <label for="password">Effectiveness Check Colsure Comments(Incident)</label>
                                    <input class="extension_modal_signature" type="date" name="incident_effectiveness_on">
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
                                    <input class="extension_modal_signature" type="date" name="incident_effectiveness_on">
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
                                    <input class="extension_modal_signature" type="date" name="effectiveness_check_capa">
                                </div>
                                <div class="group-input">
                                    <label for="password">CAPA Effectiveness Check Plan Proposed By<span
                                            class="text-danger">*</span></label>
                                    <input class="extension_modal_signature" type="text"
                                        name="_eefectiveness_capa_proposed_by">
                                </div>
                                <div class="group-input">
                                    <label for="password">CAPA Effectiveness Check Plan Proposed On </label>
                                    <input class="extension_modal_signature" type="text" name="incident_effectiveness_by">
                                </div>
                                <div class="group-input">
                                    <label for="password">Effectiveness Check Colsure Comments(CAPA)</label>
                                    <input class="extension_modal_signature" type="date" name="incident_effectiveness_on">
                                </div>
                                <div class="group-input">
                                    <label for="password">Next Review Date(CAPA)</label>
                                    <input class="extension_modal_signature" type="date" name="next_review_capa">
                                </div>
                                <div class="group-input">
                                    <label for="password">CAPA Effectiveness Check closed By </label>
                                    <select class="extension_modal_signature" name="capa_effectiveness_closed" id="">
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
                                    <select class="extension_modal_signature" name="qrm_effectivenss_check_by" id="">
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
                    var editor = new FroalaEditor('.froala', {
                        key: "uXD2lC7C4B4D4D4J4B11dNSWXf1h1MDb1CF1PLPFf1C1EESFKVlA3C11A8D7D2B4B4G2D3J3==",
                        imageUploadParam: 'image_param',
                        imageUploadMethod: 'POST',
                        imageMaxSize: 20 * 1024 * 1024,
                        imageUploadURL: "{{ secure_url('api/upload-files') }}",
                        fileUploadParam: 'image_param',
                        fileUploadURL: "{{ secure_url('api/upload-files')}}",
                        videoUploadParam: 'image_param',
                        videoUploadURL: "{{ secure_url('api/upload-files') }}",
                        videoMaxSize: 500 * 1024 * 1024,
                    });
                    
                    $(".froala-disabled").FroalaEditor("edit.off");
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
            {{--<script>
                document.getElementById('initiator_group').addEventListener('change', function() {
                    var selectedValue = this.value;
                    document.getElementById('initiator_group_code').value = selectedValue;
                });
            </script>--}}
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
                        <form action="{{ route('incident_child_1', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    @if ($data->stage == 2)

                                    <label for="major">
                                        <input type="radio" name="child_type" id="major" value="rca">
                                        RCA
                                    </label>

                                    <label for="major">
                                        <input type="radio" name="child_type" id="major" value="capa">
                                        CAPA
                                    </label>

                                    <label for="major">
                                        <input type="radio" name="child_type" id="major" value=" Action_Item">
                                        Action-Item
                                    </label>
                                    
                                    @if(Helpers::getChildData($data->id, 'Incident') < 3)
                                        <label for="major">
                                            <input type="radio" name="child_type" id="major" value="extension">
                                                Extension
                                        </label>
                                    @endif

                               @endif

                                    {{-- @if ($data->stage == 3)
                                        <label for="major">
                                            <input type="radio" name="child_type" id="major" value="rca">
                                            RCA
                                        </label>
                                        <br>
                                        <label for="major">
                                            <input type="radio" name="child_type" id="major" value="extension">
                                            Extension
                                        </label>
                                    @endif --}}

                                    @if ($data->stage == 3)

                                    <label for="major">
                                        <input type="radio" name="child_type" id="major" value="rca">
                                        RCA
                                    </label>

                                    <label for="major">
                                        <input type="radio" name="child_type" id="major" value="capa">
                                        CAPA
                                    </label>
                                    <label for="major">
                                        <input type="radio" name="child_type" id="major" value=" Action_Item">
                                        Action-Item
                                    </label>
                                    @if(Helpers::getChildData($data->id, 'Incident') < 3)
                                    <label for="major">
                                        <input type="radio" name="child_type" id="major" value="extension">
                                            Extension
                                    </label>
                                    @endif

                                @endif

                                    @if ($data->stage == 5)

                                        <label for="major">
                                            <input type="radio" name="child_type" id="major" value="rca">
                                            RCA
                                        </label>

                                        <label for="major">
                                            <input type="radio" name="child_type" id="major" value="capa">
                                            CAPA
                                        </label>
                                        <label for="major">
                                            <input type="radio" name="child_type" id="major" value=" Action_Item">
                                            Action-Item
                                        </label>
                                        @if(Helpers::getChildData($data->id, 'Incident') < 3)
                                        <label for="major">
                                            <input type="radio" name="child_type" id="major" value="extension">
                                                Extension
                                        </label>
                                        @endif

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
            <div class="modal fade" id="child-modal1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('incident_child_1', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                             @if(Helpers::getChildData($data->id, 'Incident') < 3)
                                <div class="group-input">
                                    <label for="major">
                                        <input type="radio" name="child_type" value="extension">
                                        Extension
                                    </label>
                                </div>
                             @endif

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

                        <form action="{{ route('incident-reject', $data->id) }}" method="POST">
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
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment <span class="text-danger">*</span></label>
                                    <input type="comment" class="form-control" name="comment" required>
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

                        <form action="{{ route('incident-cancel', $data->id) }}" method="POST">
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

                        <form action="{{ url('incidentIsCFTRequired', $data->id) }}" method="POST">
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

                        <form action="{{ route('incidentCheck', $data->id) }}" method="POST">
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
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password"class="form-control" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment <span class="text-danger">*</span></label>
                                    <input type="comment"class="form-control" name="comment" required>
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

                        <form action="{{ route('incidentCheck2', $data->id) }}" method="POST">
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
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment <span class="text-danger">*</span></label>
                                    <input type="comment" class="form-control" name="comment" required>
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

                        <form action="{{ route('incidentCheck3', $data->id) }}" method="POST">
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
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment <span class="text-danger">*</span></label>
                                    <input type="comment" class="form-control" name="comment" required>
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
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment</label>
                                    <input type="comment" class="form-control" name="comment">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="pendingInitiatorModalButton">
                                    <div class="spinner-border spinner-border-sm pendingInitiatorModalSpinner"
                                        style="display: none" role="status">
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
                        <form action="{{ route('incidentStageChange', $data->id) }}" method="POST"
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
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment</label>
                                    <input type="comment" class="form-control" name="comment">
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
                        <form action="{{ route('incidentCftnotreqired', $data->id) }}" method="POST">
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
                                    <input class="form-control" type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment</label>
                                    <input class="form-control" type="comment" name="comment">
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
                        <form action="{{ route('incidentQaMoreInfo', $data->id) }}" method="POST">
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
            {{-- <script>
                document.getElementById('initiator_group').addEventListener('change', function() {
                    var selectedValue = this.value;
                    document.getElementById('initiator_group_code').value = selectedValue;
                });
            </script> --}}
             <script>
                // JavaScript
                document.getElementById('initiator_group').addEventListener('change', function() {
                    var selectedValue = this.value;
                    document.getElementById('initiator_group_code').value = selectedValue;
                });
            </script>
            <script>
                function clicktoremove() {

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
                    measurementInput.setAttribute('name', 'fishbone[measurement][' + i + ']')
                    measurement.append(measurementInput)
                    topField.append(measurement)

                    let materials = document.createElement('div')
                    let materialsInput = document.createElement('input')
                    materialsInput.setAttribute('type', 'text')
                    materialsInput.setAttribute('name', 'fishbone[materials][' + i + ']')
                    materials.append(materialsInput)
                    topField.append(materials)

                    let methods = document.createElement('div')
                    let methodsInput = document.createElement('input')
                    methodsInput.setAttribute('type', 'text')
                    methodsInput.setAttribute('name', 'fishbone[methods][' + i + ']')
                    methods.append(methodsInput)
                    topField.append(methods)

                    topBlock.prepend(topField)

                    let bottomField = document.createElement('div')
                    bottomField.className = 'grid-field fields bottom-field'

                    let environment = document.createElement('div')
                    let environmentInput = document.createElement('input')
                    environmentInput.setAttribute('type', 'text')
                    environmentInput.setAttribute('name', 'fishbone[environment][' + i + ']')
                    environment.append(environmentInput)
                    bottomField.append(environment)

                    let manpower = document.createElement('div')
                    let manpowerInput = document.createElement('input')
                    manpowerInput.setAttribute('type', 'text')
                    manpowerInput.setAttribute('name', 'fishbone[manpower][' + i + ']')
                    manpower.append(manpowerInput)
                    bottomField.append(manpower)

                    let machine = document.createElement('div')
                    let machineInput = document.createElement('input')
                    machineInput.setAttribute('type', 'text')
                    machineInput.setAttribute('name', 'fishbone[machine][' + i + ']')
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
