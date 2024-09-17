@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')
            ->select('id', 'name')
            ->get();

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

             let cell10 = newRow.insertCell(5);
            cell6.innerHTML = "<button type='text' class='removeRowBtn' name='Action[]' readonly>Remove</button>";

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
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="scheduled_start_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="scheduled_start_date[]" id="scheduled_start_date' + serialNumber +'_checkdate" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input" oninput="handleDateInput(this, `scheduled_start_date' + serialNumber +'`);checkDate(`scheduled_start_date' + serialNumber +'_checkdate`,`scheduled_end_date' + serialNumber +'_checkdate`)" /></div></div></div></td>' +

                        '<td><input type="time" name="scheduled_start_time[]"></td>' +
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="scheduled_end_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="scheduled_end_date[]" id="scheduled_end_date'+ serialNumber +'_checkdate" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, `scheduled_end_date' + serialNumber +'`);checkDate(`scheduled_start_date' + serialNumber +'_checkdate`,`scheduled_end_date' + serialNumber +'_checkdate`)" /></div></div></div></td>' +
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
                         '<td><button type="button" class="removeRowBtn">Remove</button></td>'+
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
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +'"></td>' +
                        '<td><input type="text" name="observation_id[]"></td>' +
                        
                        // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="date[]" class="hide-input" oninput="handleDateInput(this, `date' + serialNumber +'`)" /></div></div></div></td>' +
                        // '<td><select name="auditorG[]">' +
                         '<option value="">Select a value</option>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    html += '</select></td>' +
                        // '<td><select name="auditeeG[]">' +
                        // '<option value="">Select a value</option>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }
                    // html += '</select></td>' +
                        '<td><input type="text" name="observation_description[]"></td>' +
                        // '<td><input type="text" name="severity_level[]"></td>' +
                        '<td><input type="text" name="area[]"></td>' +
                        //'<td><input type="text" name="observation_category[]"></td>'
                        //  '<td><select name="observation_category[]"><option value="">Select A Value</option><option value="Major">Major</option><option value="Minor">Minor</option><option value="Critical">Critical</option><option value="Recommendation">Recommendation</option></select></td>'+
                        // '<td><select name="capa_required[]"><option value="">Select A Value</option><option value="Yes">Yes</option><option value="No">No</option></select></td>' +
                        '<td><input type="text" name="auditee_response[]"></td>' +
                        // '<td><input type="text" name="auditor_review_on_response[]"></td>' +
                        // '<td><input type="text" name="qa_comment[]"></td>' +
                        // '<td><input type="text" name="capa_details[]"></td>' +
                        // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="capa_due_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="capa_due_date[]" class="hide-input" oninput="handleDateInput(this, `capa_due_date' + serialNumber +'`)" /></div></div></div></td>' +
                        // '<td><select name="capa_owner[]">' +
                         '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' + 
                    // '<td><input type="text" name="action_taken[]"></td>' +
                        //'<td><input type="date" name="capa_completion_date[]"></td>'
                        // '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="capa_completion_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="capa_completion_date[]" class="hide-input" oninput="handleDateInput(this, `capa_completion_date' + serialNumber +'`)" /></div></div></div></td>'
                        
                        // +
                        // '<td><input type="text" name="status_Observation[]"></td>' +
                        // '<td><input type="text" name="remark_observation[]"></td>' +
                         '<td><button type="button" class="removeRowBtn">Remove</button></td>'+
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
    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }} / External Audit
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
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Audit Planning</button> -->
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Audit Preparation</button> -->
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Audit Execution</button> -->
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Summary Response</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">CFT</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">QA/CQA Head Aprroval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>
            </div>

            <form id="auditform" action="{{ route('auditee_store') }}" method="post" enctype="multipart/form-data">
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
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/EA/{{ date('Y') }}/{{ $record_number }}">
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input readonly type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" value="{{ Auth::user()->name }}">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input ">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        <input readonly type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('d-m-Y') }}" name="intiation_date">
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_to">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div> -->
                                
                                <div class="col-md-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="due-date">Due Date <span class="text-danger"></span></label>
                                    <p class="text-primary"> last date this record should be closed by</p>
                                    
                                    <div class="calenderauditee">
                                        <input type="text" id="due_date" readonly
                                            placeholder="DD-MMM-YYYY"/>
                                        <input type="date" name="due_date"  min="" class="hide-input" oninput="handleDateInput(this, 'due_date')"  />
                                    </div>
                                    
                                </div>
                            </div>

                               
                               
                               
                               
                                <div class="col-lg-6">
    <div class="group-input">
        <label for="initiator-group">Initiator Department <span class="text-danger">*</span></label>
        <select name="Initiator_Group" id="initiator_group">
            <option value="">Select Initiator Department</option>
            <option value="CQA" @if (old('Initiator_Group') == 'CQA') selected @endif>Corporate Quality Assurance</option>
            <option value="QA" @if (old('Initiator_Group') == 'QA') selected @endif>Quality Assurance</option>
            <option value="QC" @if (old('Initiator_Group') == 'QC') selected @endif>Quality Control</option>
            <option value="QM" @if (old('Initiator_Group') == 'QM') selected @endif>Quality Control (Microbiology department)</option>
            <option value="PG" @if (old('Initiator_Group') == 'PG') selected @endif>Production General</option>
            <option value="PL" @if (old('Initiator_Group') == 'PL') selected @endif>Production Liquid Orals</option>
            <option value="PT" @if (old('Initiator_Group') == 'PT') selected @endif>Production Tablet and Powder</option>
            <option value="PE" @if (old('Initiator_Group') == 'PE') selected @endif>Production External (Ointment, Gels, Creams and Liquid)</option>
            <option value="PC" @if (old('Initiator_Group') == 'PC') selected @endif>Production Capsules</option>
            <option value="PI" @if (old('Initiator_Group') == 'PI') selected @endif>Production Injectable</option>
            <option value="EN" @if (old('Initiator_Group') == 'EN') selected @endif>Engineering</option>
            <option value="HR" @if (old('Initiator_Group') == 'HR') selected @endif>Human Resource</option>
            <option value="ST" @if (old('Initiator_Group') == 'ST') selected @endif>Store</option>
            <option value="IT" @if (old('Initiator_Group') == 'IT') selected @endif>Electronic Data Processing</option>
            <option value="FD" @if (old('Initiator_Group') == 'FD') selected @endif>Formulation Development</option>
            <option value="AL" @if (old('Initiator_Group') == 'AL') selected @endif>Analytical Research and Development Laboratory</option>
            <option value="PD" @if (old('Initiator_Group') == 'PD') selected @endif>Packaging Development</option>
            <option value="PU" @if (old('Initiator_Group') == 'PU') selected @endif>Purchase Department</option>
            <option value="DC" @if (old('Initiator_Group') == 'DC') selected @endif>Document Cell</option>
            <option value="RA" @if (old('Initiator_Group') == 'RA') selected @endif>Regulatory Affairs</option>
            <option value="PV" @if (old('Initiator_Group') == 'PV') selected @endif>Pharmacovigilance</option>
        </select>

        {{-- Uncomment if validation needed --}}
        {{-- @error('Initiator_Group')
            <p class="text-danger">{{ $message }}</p>
        @enderror --}}
    </div>
</div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiator Department code </label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code"
                                            value="" readonly>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                    class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please mention brief summary</small></div>
                                        <textarea name="short_description"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="short_description" maxlength="255" required>
                                    </div>
                                </div>  
                                {{--  <div class="col-12">
                                    <div class="group-input">
                                        <label for="severity-level">Severity Level</label>
                                        <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span>
                                        <select name="severity_level">
                                            <option value="0">-- Select --</option>
                                            <option value="minor">Minor</option>
                                            <option value="major">Major</option>
                                            <option value="critical">Critical</option>
                                        </select>
                                    </div>
                                </div>  --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group">Initiated Through</label>
                                        <div><small class="text-primary">Please select related information</small></div>
                                        <select name="initiated_through"
                                            onchange="otherController(this.value, 'others', 'initiated_through_req')">
                                            <option value="">-- select --</option>
                                            <option value="recall">Recall</option>
                                            <option value="return">Return</option>
                                            <!-- <option value="deviation">Deviation</option> -->
                                            <option value="complaint">Complaint</option>
                                            <option value="regulatory">Regulatory</option>
                                            <!-- <option value="lab-incident">Lab Incident</option> -->
                                            <option value="improvement">Improvement</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="initiated_through_req">
                                        <label for="If Other">Others<span class="text-danger d-none">*</span></label>
                                        <textarea name="initiated_if_other"></textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="repeat">Repeat</label>
                                        <select name="repeat"
                                            onchange="otherController(this.value, 'yes', 'repeat_nature')">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="NA">NA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="repeat_nature">
                                        <label for="repeat_nature">Repeat Nature<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="repeat_nature"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="audit_type">Type of Audit</label>
                                        <select name="audit_type"
                                            onchange="otherController(this.value, 'others', 'type_of_audit_req')">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="R&D">R&D</option>
                                            <option value="GLP">GLP</option>
                                            <option value="GCP">GCP</option>
                                            <option value="GDP">GDP</option>
                                            <option value="GEP">GEP</option>
                                            <option value="ISO 17025">ISO 17025</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="type_of_audit_req">
                                        <label for="If Other">If Others<span class="text-danger d-none">*</span></label>
                                        <textarea name="if_other"></textarea>
                                        @error('if_other')
                                            <p class="text-danger">this field is required</p>
                                        @enderror
                                    </div>
                                </div>
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
                                <div class="col-lg-6">
                                    <div class="group-input" id="external_agencies_req">
                                        <label for="others">Others<span class="text-danger d-none">*</span></label>
                                        <textarea name="others"></textarea>
                                        @error('if_other')
                                            <p class="text-danger">this field is required</p>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="others">Others<span class="text-danger d-none">*</span></label>
                                        <textarea name="others"></textarea>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Initial Comments">Description</label>
                                        <textarea name="initial_comments"></textarea>
                                    </div>
                                </div>






                                <div class="col-12">
    <div class="group-input" id="IncidentRow">
        <label for="root_cause">
            Auditors
            <button type="button" name="audit-incident-grid" id="IncidentAddAuditor">+</button>
            <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                (Launch Instruction)
            </span>
        </label>

        <table class="table table-bordered" id="onservation-incident-tableAuditor">
            <thead>
                <tr>
                    <th>Row</th>
                    <th>Auditor Name</th>
                    <th>Regulatory Agency</th>
                    <th>Designation</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $serialNumber = 1;
                @endphp
                <tr>
                    <td>{{ $serialNumber++ }}</td>
                    <td><input type="text" name="AuditorNew[0][auditornew]"></td>
                    <td><input type="text" name="AuditorNew[0][regulatoryagency]"></td>
                    <td>
                        <select name="AuditorNew[0][designation]" class="form-select">
                            <option value="">--Select--</option>
                            <option value="Lead Auditor">Lead Auditor</option>
                            <option value="Auditor">Auditor</option>
                        </select>
                    </td>
                    <td><input type="text" name="AuditorNew[0][remarks]"></td>
                    <td><button class="removeRowBtn">Remove</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    let investdetails = 1; // Start from 1 as the initial index
    $('#IncidentAddAuditor').click(function(e) {
        e.preventDefault();

        // Function to generate a new table row with incremented serial number
        function generateTableRow(serialNumber) {
            var html =
                '<tr>' +
                '<td><input disabled type="text" style ="width:15px" value="' + serialNumber + '"></td>' +
                '<td><input type="text" name="AuditorNew[' + investdetails + '][auditornew]" value=""></td>' +
                '<td><input type="text" name="AuditorNew[' + investdetails + '][regulatoryagency]" value=""></td>' +
                '<td>' +
                '<select name="AuditorNew[' + investdetails + '][designation]" class="form-select">' +
                '<option value="">--Select--</option>' +
                '<option value="Lead Auditor">Lead Auditor</option>' +
                '<option value="Auditor">Auditor</option>' +
                '</select>' +
                '</td>' +
                '<td><input type="text" name="AuditorNew[' + investdetails + '][remarks]" value=""></td>' +
                '<td><button class="removeRowBtn">Remove</button>' +
                '</tr>';
            investdetails++; // Increment investdetails for the next row
            return html;
        }

        var tableBody = $('#onservation-incident-tableAuditor tbody'); // Get the table body
        var rowCount = tableBody.children('tr').length; // Calculate the current number of rows
        var newRow = generateTableRow(rowCount + 1); // Generate the new row with the correct serial number
        tableBody.append(newRow); // Append the new row to the table
    });

    // Remove row functionality
    $(document).on('click', '.removeRowBtn', function() {
        $(this).closest('tr').remove();
        // After removing, re-calculate and update serial numbers for all rows
        $('#onservation-incident-tableAuditor tbody tr').each(function(index) {
            $(this).find('td:first input').val(index + 1); // Update serial number for each row
        });
    });
});
</script>
                                    <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">GI Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="audit_file_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="inv_attachment[]"
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

                    <!-- Audit Planning content -->
                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                

                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="start_date"><b>Audit Schedule Start Date
                                        </b></label>
                                        <input type="text" value="{{ date('d-M-Y') }}" name="start_date"
                                            disabled>
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="start_date">
                                    </div>
                                </div> --}}
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule Start Date">Audit Start Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="start_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" id="start_date_checkdate" name="start_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input"
                                                oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule End Date">Audit Start Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="end_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" id="end_date_checkdate" name="end_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" 
                                                oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="audit-agenda-grid">
                                            Audit Agenda<button type="button" name="audit-agenda-grid"
                                                id="internalaudit-table">+</button>
                                        </label>
                                        <table class="table table-bordered" id="internalaudit">
                                            <thead>
                                                <tr>
                                                    <th>Row#</th>
                                                    <th>Area of Audit</th>
                                                    <th>Scheduled Start Date</th>
                                                    <th>Scheduled Start Time</th>
                                                    <th>Scheduled End Date</th>
                                                    <th>Scheduled End Time</th>
                                                    <th>Auditor</th>
                                                    <th>Auditee</th>
                                                    <th>Remarks</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="audit[]"></td>
                                                 

                                                 <td>
                                                    <div class="group-input new-date-data-field mb-0">
                                                        <div class="input-date ">
                                                            <div class="calenderauditee">
                                                                <input type="text"  class="test" id="scheduled_start_date1" readonly placeholder="DD-MMM-YYYY" />
                                                                <input type="date"   id="scheduled_start_date1_checkdate" name="scheduled_start_date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"class="hide-input" 
                                                                oninput="handleDateInput(this, `scheduled_start_date1`);checkDate('scheduled_start_date1_checkdate','scheduled_end_date1_checkdate')" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td> 
                                                <td><input type="time" name="scheduled_start_time[]"></td> 
                                                <td>
                                                    <div class="group-input new-date-data-field mb-0">
                                                        <div class="input-date ">
                                                            <div  class="calenderauditee">
                                                                <input type="text"  class="test" id="scheduled_end_date1" readonly placeholder="DD-MMM-YYYY" />
                                                                <input type="date" id="scheduled_end_date1_checkdate"name="scheduled_end_date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" 
                                                                 oninput="handleDateInput(this, `scheduled_end_date1`);checkDate('scheduled_start_date1_checkdate','scheduled_end_date1_checkdate')" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                

                                                <td><input type="time" name="scheduled_end_time[]"></td>
                                                
                                                <td> <select id="select-state" placeholder="Select..." name="auditor[]">
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                <td><select id="select-state" placeholder="Select..." name="auditee[]">
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" name="remarks[]"></td>
                                               <td><button type="text" class="removeRowBtn">Remove</button></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- <div class="col-6">
                                    <div class="group-input">
                                        <label for="Facility Name">Facility Name</label>
                                        <select multiple name="Facility[]" placeholder="Select Facility Name"
                                            data-search="false" data-silent-initial-value-set="true" id="Facility">
                                            <option value="Plant 1">Plant 1</option>
                                            <option value="QA">QA</option>
                                            <option value="QC">QC</option>
                                            <option value="MFG">MFG</option>
                                            <option value="Corporate">Corporate</option>
                                            <option value="Microbiology">Microbiology</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Group Name">Group Name</label>
                                        <select multiple name="Group[]" placeholder="Select Group Name"
                                            data-search="false" data-silent-initial-value-set="true" id="Group">
                                            <option value="QA">QA</option>
                                            <option value="QC">QC</option>
                                            <option value="Manufacturing">Manufacturing</option>
                                            <option value="Warehouse">Warehouse</option>
                                            <option value="RA">RA</option>
                                            <option value="R&D">R&D</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Product/Material Name">Product/Material Name</label>
                                        <input type="text" name="material_name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments(If Any)">Comments(If Any)</label>
                                        <textarea name="if_comments"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- Audit Preparation content -->
                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Lead Auditor">Lead Auditor</label>
                                        <select name="lead_auditor">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="File Attachments">File Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <div class="file-attachment-field">
                                            <div id="file_attachment"></div>
                                            <input type="file" id="myfile" name="file_attachment[]"
                                            oninput="addMultipleFiles(this, 'file_attachment')" multiple>
                                        </div> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="file_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="file_attachment[]"
                                                    oninput="addMultipleFiles(this, 'file_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    
                                </div>
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Audit Team">Audit Team</label>
                                        <select multiple name="Audit_team[]" placeholder="Select Audit Team"
                                            data-search="false" data-silent-initial-value-set="true" id="Audit">
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Auditee">Auditee</label>
                                        <select multiple name="Auditee[]" placeholder="Select Auditee"
                                            data-search="false" data-silent-initial-value-set="true" id="Auditee">
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="    ">External Auditor Details</label>
                                        <textarea name="Auditor_Details"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="External Auditing Agency">External Auditing Agency</label>
                                        <textarea name="External_Auditing_Agency"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Relevant Guidelines / Industry Standards">Relevant Guidelines /
                                            Industry Standards</label>
                                        <textarea name="Relevant_Guidelines"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Comments">QA Comments</label>
                                        <textarea name="QA_Comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Guideline Attachment">Guideline Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                     

                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="file_attachment_guideline"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="file_attachment_guideline[]"
                                                    oninput="addMultipleFiles(this, 'file_attachment_guideline')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Category">Audit Category</label>
                                        <select name="Audit_Category">
                                            <option value="0">-- Select --</option>
                                            <option value="1">Internal Audit/Self Inspection</option>
                                            <option value="2">Supplier Audit</option>
                                            <option value="3">Regulatory Audit</option>
                                            <option value="4">Consultant Audit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Supplier/Vendor/Manufacturer Details">Supplier/Vendor/Manufacturer
                                            Details</label>
                                        <input type="text" name="Supplier_Details">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Supplier/Vendor/Manufacturer Site">Supplier/Vendor/Manufacturer
                                            Site</label>
                                        <input type="text" name="Supplier_Site">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments">Comments</label>
                                        <textarea name="Comments"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- Audit Execution content -->
                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="audit_start_date Date">Audit Start Date</label>
                                        <div class="calenderauditee">
                                            <input type="text"  id="audit_start_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" id="audit_start_date_checkdate" name="audit_start_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'audit_start_date');checkDate('audit_start_date_checkdate','audit_end_date_checkdate')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <div class="calenderauditee">
                                            <label for="Audit End Date">Audit End Date</label>
                                            <div class="calenderauditee">
                                            <input type="text" id="audit_end_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" id="audit_end_date_checkdate" name="audit_end_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'audit_end_date');checkDate('audit_start_date_checkdate','audit_end_date_checkdate')" />
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                     <div class="group-input">
                                        <label for="audit-agenda-grid">
                                            Observation Details
                                            <button type="button" name="audit-agenda-grid"
                                                id="ObservationAdd">+</button>
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
                                                        <th>Row#</th>
                                                        <th>Observation Details</th>
                                                        {{-- <th>Date</th>
                                                        <th>Auditor</th>
                                                        <th>Auditee</th> --}}
                                                        <th>Pre Comments</th>
                                                        {{-- <th>Severity Level</th> --}}
                                                         <th>CAPA Details if any</th>
                                                        {{-- <th>Observation Category</th>
                                                        <th>CAPA Required</th> --}}
                                                        <th>Post Comments</th>
                                                        {{-- <th>Auditor Review on Response</th>
                                                        <th>QA Comments</th>
                                                        <th>CAPA Details</th>
                                                        <th>CAPA Due Date</th>
                                                        <th>CAPA Owner</th>
                                                        <th>Action Taken</th>
                                                        <th>CAPA Completion Date</th>
                                                        <th>Status</th>
                                                        <th>Remarks</th> --}}
                                                          <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  

                                                </tbody>

                                            </table>
                                        </div>
                                    </div> 
                                




                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="severity-level">Observation Category
                                        <select name="severity_level">
                                            <option value="0">-- Select --</option>
                                            <option value="minor">Minor</option>
                                            <option value="major">Major</option>
                                            <option value="critical">Critical</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Audit Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="audit_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Audit_file[]"
                                                    oninput="addMultipleFiles(this, 'audit_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Comments">Audit Comments</label>
                                        <textarea name="Audit_Comments1"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- Audit Response & Closure content -->
                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">
                                Summary Response
                                </div>
                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Remarks">Remarks</label>
                                        <textarea name="Remarks"></textarea>
                                    </div>
                                </div> -->
                                <!-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Reference Recores">Reference Record</label>
                                        <select multiple id="reference_record" name="refrence_record[]" id="">
                                            {{-- <option value="">--Select---</option> --}}
                                            @foreach ($old_record as $new)
                                                <option value="{{ $new->id }}">
                                                    {{ Helpers::getDivisionName($new->division_id) }}/IA/{{ date('Y') }}/{{ Helpers::recordFormat($new->record) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->
                                <!-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Report Attachments">Report Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" id="myfile" name="report_file[]" multiple> --}}
                                        {{-- <div class="file-attachment-field">
                                            <div id="Audit_file_attachment"></div>
                                            <input type="file" id="myfile" name="report_file[]"
                                            oninput="addMultipleFiles(this, 'Audit_file_attachment')" multiple>
                                        </div> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="report_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="report_file[]"
                                                    oninput="addMultipleFiles(this, 'report_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->


                                {{-- grid added new --}}

<div class="col-12">
    <div class="group-input" id="IncidentRow">
        <label for="root_cause">
            Summary Response
            <button type="button" name="audit-incident-grid" id="IncidentAdd">+</button>
            <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                (Launch Instruction)
            </span>
        </label>
        
            <table class="table table-bordered" id="onservation-incident-table">
                <thead>
                    <tr>
                        <th>Row</th>
                        <th>Observation</th>
                        <th>Response</th>
                        <th>CAPA / ACTION Child Reference If Any </th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $serialNumber =1;
                    @endphp
                    <tr>
                    <td disabled >{{ $serialNumber++ }}</td>
                    <td><input type="text" name="SummaryResponse[0][observation]"></td>
                    <td><input type="text" name="SummaryResponse[0][response]"></td>
                    <td><input type="text" name="SummaryResponse[0][reference_id]"></td>
                    <td><input type="text" name="SummaryResponse[0][status]"></td>
                    <td><input type="text" name="SummaryResponse[0][remarks]"></td>
                    <td><button class="removeRowBtn">Remove</button>
                    </tr>
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


<script>
$(document).ready(function() {
    let investdetails = 1;
    $('#IncidentAdd').click(function(e) {
        function generateTableRow(serialNumber) {
            var html =
                '<tr>' +
                '<td><input disabled type="text" style ="width:15px" value="' + serialNumber + '"></td>' +
                '<td><input type="text" name="SummaryResponse[' + investdetails + '][observation]" value=""></td>' +
                '<td><input type="text" name="SummaryResponse[' + investdetails + '][response]" value=""></td>' +
                '<td><input type="text" name="SummaryResponse[' + investdetails + '][reference_id]" value=""></td>' +
                '<td><input type="text" name="SummaryResponse[' + investdetails + '][status]" value=""></td>' +
                '<td><input type="text" name="SummaryResponse[' + investdetails + '][remarks]" value=""></td>' +
               '<td><button class="removeRowBtn">Remove</button>'+
                '</tr>';
            investdetails++; // Increment the row number here
            return html;
        }

        var tableBody = $('#onservation-incident-table tbody');
        var rowCount = tableBody.children('tr').length;
        var newRow = generateTableRow(rowCount + 1);
        tableBody.append(newRow);
    });
    $(document).on('click', '.removeRowBtn', function() {
        $(this).closest('tr').remove();
    });
});

    </script>

{{-- grid added new --}}

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Summary And Resoponse Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input type="file" id="myfile" name="myfile[]" multiple> --}}
                                        {{-- <div class="file-attachment-field">
                                            <div id="myfile_attachment"></div>
                                            <input type="file" id="myfile" name="myfile[]"
                                            oninput="addMultipleFiles(this, 'myfile_attachment')" multiple>
                                        </div> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="myfile_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="myfile[]"
                                                    oninput="addMultipleFiles(this, 'myfile_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Comments">Audit Comments</label>
                                        <textarea name="Audit_Comments2"></textarea>
                                    </div>
                                </div> -->
                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="due_date_extension">Due Date Extension Justification</label>
                                        <div><small class="text-primary">Please Mention justification if due date is
                                                crossed</small></div>
                                        <textarea name="due_date_extension"></textarea>
                                    </div>
                                </div> -->
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">
                                    Production (Tablet/Capsule/Powder)
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.productionTable').hide();

                                        $('[name="Production_Table_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.productionTable').show();
                                                $('.productionTable span').show();
                                            } else {
                                                $('.productionTable').hide();
                                                $('.productionTable span').hide();
                                            }
                                        });
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Tablet"> Production Tablet</label>
                                        <select name="Production_Table_Review" id="Production_Table_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
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
                                <div class="col-lg-6 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet notification">Production Tablet Person</label>
                                        <select name="Production_Table_Person" class="Production_Table_Person"
                                            id="Production_Table_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet assessment">Impact Assessment (By Production
                                            Tablet)</label>
                                        <textarea class="summernote Production_Table_Assessment" name="Production_Table_Assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet feedback">Production Tablet Feedback</label>
                                        <textarea class="summernote Production_Table_Feedback" name="Production_Table_Feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet attachment">Production Tablet Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Production_Table_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Production_Table_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Production_Table_Attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionTable">
                                    <div class="group-input">
                                        <label for="Production Tablet Completed By">Production Tablet Completed By</label>
                                        <input readonly type="text" name="Production_Table_By"
                                            id="Production_Table_By">
                                    </div>
                                </div>
                                <div class="col-lg-6 productionTable">
                                    <div class="group-input ">
                                        <label for="Production Tablet Completed On">Production Tablet Completed On</label>
                                        <input type="date" id="Production_Table_On" name="Production_Table_On">
                                    </div>
                                </div>

                                <div class="sub-head">
                                    Production Injection
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.productionInjection').hide();

                                        $('[name="Production_Injection_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.productionInjection').show();
                                                $('.productionInjection span').show();
                                            } else {
                                                $('.productionInjection').hide();
                                                $('.productionInjection span').hide();
                                            }
                                        });
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Injection"> Production Injection </label>
                                        <select name="Production_Injection_Review" id="Production_Injection_Review"
                                            disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
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
                                <div class="col-lg-6 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection notification">Production Injection Person</label>
                                        <select class="Production_Injection_Person" id="Production_Injection_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection assessment">Impact Assessment (By Production
                                            Injection)</label>
                                        <textarea class="summernote Production_Injection_Assessment" name="Production_Injection_Assessment"
                                            id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection feedback">Production Injection Feedback </label>
                                        <textarea class="summernote Production_Injection_Feedback" name="Production_Injection_Feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection attachment">Production Injection
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Production_Injection_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="Production_Injection_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Production_Injection_Attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionInjection">
                                    <div class="group-input">
                                        <label for="Production Injection Completed By">Production Injection Completed
                                            By</label>
                                        <input readonly type="text" name="Production_Injection_By"
                                            id="Production_Injection_By">
                                    </div>
                                </div>
                                <div class="col-lg-6 productionInjection">
                                    <div class="group-input ">
                                        <label for="Production Injection Completed On">Production Injection Completed
                                            On</label>
                                        <input type="date"id="Production_Injection_On" name="Production_Injection_On">
                                    </div>
                                </div>


                                <div class="sub-head">
                                    Research & Development
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.researchDevelopment').hide();

                                        $('[name="ResearchDevelopment_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.researchDevelopment').show();
                                                $('.researchDevelopment span').show();
                                            } else {
                                                $('.researchDevelopment').hide();
                                                $('.researchDevelopment span').hide();
                                            }
                                        });
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Research Development"> Research Development Required ?</label>
                                        <select name="ResearchDevelopment_Review" id="ResearchDevelopment_Review"
                                            disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
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
                                <div class="col-lg-6 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development notification">Research Development Person</label>
                                        <select name="ResearchDevelopmentStore_Person" class="ResearchDevelopment_Person"
                                            id="ResearchDevelopment_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development assessment">Impact Assessment (By Research
                                            Development)</label>
                                        <textarea class="summernote ResearchDevelopment_assessment" name="ResearchDevelopment_assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development feedback">Research Development Feedback</label>
                                        <textarea class="summernote ResearchDevelopment_feedback" name="ResearchDevelopment_feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development attachment">Research Development
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="ResearchDevelopment_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="ResearchDevelopment_attachment[]"
                                                    oninput="addMultipleFiles(this, 'ResearchDevelopment_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 researchDevelopment">
                                    <div class="group-input">
                                        <label for="Research Development Completed By">Research Development Completed
                                            By</label>
                                        <input readonly type="text" name="ResearchDevelopment_by"
                                            id="ResearchDevelopment_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 researchDevelopment">
                                    <div class="group-input ">
                                        <label for="Research Development Completed On">Research Development Complete
                                            On</label>
                                        <input type="date" id="ResearchDevelopment_on" name="ResearchDevelopment_on">
                                    </div>
                                </div>

                                <div class="sub-head">
                                    Human Resource
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
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Administration Review Required">Human Resource
                                            Required ?</label>
                                        <select name="Human_Resource_review" id="Human_Resource_review" disabled>
                                            <option value="">-- Select --</option>
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
                                <div class="col-lg-6 human_resources">
                                    <div class="group-input">
                                        <label for="Administration Person"> Human Resource Person</label>
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
                                        <label for="Impact Assessment9">Impact Assessment (By Human Resource )</label>
                                        <textarea class="" name="Human_Resource_assessment" id="summernote-35"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="productionfeedback">Human Resource Feedback</label>
                                        <textarea class="" name="Human_Resource_feedback" id="summernote-36"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 human_resources">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Human Resource
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Human_Resource_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Human_Resource_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Human_Resource_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="Administration Review Completed By"> Human Resource Review Completed
                                            By</label>
                                        <input type="text" name="Human_Resource_by" id="Human_Resource_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field human_resources">
                                    <div class="group-input input-date">
                                        <label for="Administration Review Completed On">Human Resource Review Completed
                                            On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Human_Resource_on" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="Human_Resource_on"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'Human_Resource_on')" />
                                        </div>
                                    </div>
                                </div>


                                <div class="sub-head">
                                    Corporate Quality Assurance
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.CQA').hide();

                                        $('[name="CorporateQualityAssurance_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.CQA').show();
                                                $('.CQA span').show();
                                            } else {
                                                $('.CQA').hide();
                                                $('.CQA span').hide();
                                            }
                                        });
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance"> Corporate Quality Assurance Required
                                            ?</label>
                                        <select name="CorporateQualityAssurance_Review"
                                            id="CorporateQualityAssurance_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
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
                                <div class="col-lg-6 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance notification">Corporate Quality Assurance
                                            Person</label>
                                        <select name="CorporateQualityAssurance_Person"
                                            class="CorporateQualityAssurance_Person"
                                            id="CorporateQualityAssurance_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance assessment">Impact Assessment (By Corporate
                                            Quality Assurance)</label>
                                        <textarea class="summernote CorporateQualityAssurance_assessment" readonly name="CorporateQualityAssurance_assessment"
                                            id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance feedback">Corporate Quality Assurance
                                            Feedback</label>
                                        <textarea class="summernote CorporateQualityAssurance_feedback" name="CorporateQualityAssurance_feedback"
                                            id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance attachment">Corporate Quality Assurance
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="CorporateQualityAssurance_attachment">
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="CorporateQualityAssurance_attachment[]"
                                                    oninput="addMultipleFiles(this, 'CorporateQualityAssurance_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 CQA">
                                    <div class="group-input">
                                        <label for="Corporate Quality Assurance Completed By">Corporate Quality Assurance
                                            Completed By</label>
                                        <input readonly type="text" name="CorporateQualityAssurance_by"
                                            id="CorporateQualityAssurance_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 CQA">
                                    <div class="group-input ">
                                        <label for="Corporate Quality Assurance Completed On">Corporate Quality Assurance
                                            Completed On</label>
                                        <input type="date"id="CorporateQualityAssurance_on"
                                            name="CorporateQualityAssurance_on">
                                    </div>
                                </div>


                                <div class="sub-head">
                                    Stores
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.store').hide();

                                        $('[name="Store_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.store').show();
                                                $('.store span').show();
                                            } else {
                                                $('.store').hide();
                                                $('.store span').hide();
                                            }
                                        });
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Store"> Store</label>
                                        <select name="Store_Review" id="Store_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
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
                                <div class="col-lg-6 store">
                                    <div class="group-input">
                                        <label for="Store notification">Store Person</label>
                                        <select name="Store_Person" class="Store_Person" id="Store_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 store">
                                    <div class="group-input">
                                        <label for="Store assessment">Impact Assessment (By Store)</label>
                                        <textarea class="summernote Store_assessment" name="Store_assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 store">
                                    <div class="group-input">
                                        <label for="Store feedback">Store Feedback</label>
                                        <textarea class="summernote Store_feedback" name="Store_feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 store">
                                    <div class="group-input">
                                        <label for="Store attachment">Store Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Store_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Store_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Store_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 store">
                                    <div class="group-input">
                                        <label for="Store Completed By">Store Completed By</label>
                                        <input readonly type="text" name="Store_by" id="Store_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 store">
                                    <div class="group-input ">
                                        <label for="Store Completed On">Store Completed On</label>
                                        <input type="date"id="Store_on" name="Store_on">
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
                                    Regulatory Affair
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.RegulatoryAffair').hide();

                                        $('[name="RegulatoryAffair_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.RegulatoryAffair').show();
                                                $('.RegulatoryAffair span').show();
                                            } else {
                                                $('.RegulatoryAffair').hide();
                                                $('.RegulatoryAffair span').hide();
                                            }
                                        });
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RegulatoryAffair"> Regulatory Affair Required ?</label>
                                        <select name="RegulatoryAffair_Review" id="RegulatoryAffair_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
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
                                <div class="col-lg-6 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair notification">Regulatory Affair Person</label>
                                        <select name="RegulatoryAffair_Person" class="RegulatoryAffair_Person"
                                            id="RegulatoryAffair_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair assessment">Impact Assessment (By Regulatory
                                            Affair)</label>
                                        <textarea class="summernote RegulatoryAffair_assessment" name="RegulatoryAffair_assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair feedback">Regulatory Affair Feedback</label>
                                        <textarea class="summernote RegulatoryAffair_feedback" name="RegulatoryAffair_feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair attachment">Regulatory Affair Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="RegulatoryAffair_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="RegulatoryAffair_attachment[]"
                                                    oninput="addMultipleFiles(this, 'RegulatoryAffair_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 RegulatoryAffair">
                                    <div class="group-input">
                                        <label for="Regulatory Affair Completed By">Regulatory Affair Completed By</label>
                                        <input readonly type="text" name="RegulatoryAffair_by"
                                            id="RegulatoryAffair_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 RegulatoryAffair">
                                    <div class="group-input ">
                                        <label for="Regulatory Affair Completed On">Regulatory Affair Completed On</label>
                                        <input type="date"id="RegulatoryAffair_on" name="RegulatoryAffair_on">
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



                                <div class="sub-head">
                                    Production (Liquid/Ointment)
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.productionLiquid').hide();

                                        $('[name="ProductionLiquid_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.productionLiquid').show();
                                                $('.productionLiquid span').show();
                                            } else {
                                                $('.productionLiquid').hide();
                                                $('.productionLiquid span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Production Liquid"> Production Liquid </label>
                                        <select name="ProductionLiquid_Review" id="ProductionLiquid_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
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
                                <div class="col-lg-6 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid notification">Production Liquid Person</label>
                                        <select name="ProductionLiquid_Person" class="ProductionLiquid_Person"
                                            id="ProductionLiquid_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid assessment">Impact Assessment (By Production
                                            Liquid)</label>
                                        <textarea class="summernote ProductionLiquid_assessment" name="ProductionLiquid_assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid feedback">Production Liquid Feedback</label>
                                        <textarea class="summernote ProductionLiquid_feedback" name="ProductionLiquid_feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid attachment">Production Liquid Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div> ProductionLiquid_attachment
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="ProductionLiquid_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile"
                                                    name="ProductionLiquid_attachment[]"
                                                    oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 productionLiquid">
                                    <div class="group-input">
                                        <label for="Production Liquid Completed By">Production Liquid Completed By</label>
                                        <input readonly type="text" name="ProductionLiquid_by"
                                            id="ProductionLiquid_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 productionLiquid">
                                    <div class="group-input ">
                                        <label for="Production Liquid Completed On">Production Liquid Completed On</label>
                                        <input type="date" id="ProductionLiquid_on" name="ProductionLiquid_on">
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
                                                <input type="file" id="myfile"
                                                    name="Quality_Control_attachment[]"
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
                                <div class="sub-head">
                                    Microbiology
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.Microbiology').hide();

                                        $('[name="Microbiology_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.Microbiology').show();
                                                $('.Microbiology span').show();
                                            } else {
                                                $('.Microbiology').hide();
                                                $('.Microbiology span').hide();
                                            }
                                        });
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology"> Microbiology Required ?</label>
                                        <select name="Microbiology_Review" id="Microbiology_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
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
                                <div class="col-lg-6 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology notification">Microbiology Person</label>
                                        <select name="Microbiology_Person" class="Microbiology_Person"
                                            id="Microbiology_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology assessment">Impact Assessment (By Microbiology)</label>
                                        <textarea class="summernote Microbiology_assessment" name="Microbiology_assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology feedback">Microbiology Feedback</label>
                                        <textarea class="summernote Microbiology_feedback" name="Microbiology_feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology attachment">Microbiology Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Microbiology_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Microbiology_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Microbiology_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Microbiology">
                                    <div class="group-input">
                                        <label for="Microbiology Completed By">Microbiology Completed By</label>
                                        <input readonly type="text" name="Microbiology_by" id="Microbiology_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 Microbiology">
                                    <div class="group-input ">
                                        <label for="Microbiology Completed On">Microbiology Completed On</label>
                                        <input type="date" id="Microbiology_on" name="Microbiology_on">
                                    </div>
                                </div>


                                <div class="sub-head">
                                    Safety
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
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Safety Review Required">Safety Review Required
                                            ?</label>
                                        <select name="Environment_Health_review" id="Environment_Health_review"
                                            disabled>
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
                                        <label for="Safety Person"> Safety Person</label>
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
                                        <label for="Impact Assessment8">Impact Assessment (By Safety)</label>
                                        <textarea class="" name="Health_Safety_assessment" id="summernote-33">
                                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="productionfeedback">Safety Feedback</label>
                                        <textarea class="" name="Health_Safety_feedback" id="summernote-34">
                                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 environmental_health">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Safety Attachments</label>
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
                                        <label for="productionfeedback">Safety Review Completed
                                            By</label>
                                        <input type="text" name="Environment_Health_Safety_by"
                                            id="Environment_Health_Safety_by" disabled>

                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field environmental_health">
                                    <div class="group-input input-date">
                                        <label for="Safety Review Completed On">Safety Review
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
                                <div class="sub-head">
                                    Contract Giver
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.ContractGiver').hide();

                                        $('[name="ContractGiver_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.ContractGiver').show();
                                                $('.ContractGiver span').show();
                                            } else {
                                                $('.ContractGiver').hide();
                                                $('.ContractGiver span').hide();
                                            }
                                        });
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Contract Giver"> Contract Giver Required ? </label>
                                        <select name="ContractGiver_Review" id="ContractGiver_Review" disabled>
                                            <option value="">-- Select --</option>
                                            <option value='yes'>
                                                Yes</option>
                                            <option value='no'>
                                                No</option>
                                            <option value='na'>
                                                NA</option>
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
                                <div class="col-lg-6 store">
                                    <div class="group-input">
                                        <label for="Contract Giver notification">Contract Giver Person</label>
                                        <select name="ContractGiver_Person" class="ContractGiver_Person"
                                            id="ContractGiver_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 store">
                                    <div class="group-input">
                                        <label for="Contract Giver assessment">Impact Assessment (By Contract
                                            Giver)</label>
                                        <textarea class="summernote ContractGiver_assessment" name="ContractGiver_assessment" id="summernote-17"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 store">
                                    <div class="group-input">
                                        <label for="Contract Giver feedback">Contract Giver Feedback</label>
                                        <textarea class="summernote ContractGiver_feedback" name="ContractGiver_feedback" id="summernote-18"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 store">
                                    <div class="group-input">
                                        <label for="Contract Giver attachment">Contract Giver Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="ContractGiver_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="ContractGiver_attachment[]"
                                                    oninput="addMultipleFiles(this, 'ContractGiver_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 store">
                                    <div class="group-input">
                                        <label for="Contract Giver Completed By">Contract Giver Completed
                                            By</label>
                                        <input readonly type="text" name="ContractGiver_by" id="ContractGiver_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 store">
                                    <div class="group-input ">
                                        <label for="Contract Giver Completed On">Contract Giver Completed On</label>
                                        <input type="date"id="ContractGiver_on" name="ContractGiver_on">
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
                                            <option value="">-- Select --</option>
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
                                            <option value="Regulatory Affairs">Project management</option>



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
                                            <option value="">-- Select --</option>
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
                                            <option value="">-- Select --</option>
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
                                            <option value="">-- Select --</option>
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
                                            <option value="">-- Select --</option>
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
                                <button type="submit" id="ChangesaveButton"
                                    style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    class="saveButton">Save</button>
                                {{-- <a href="/rcms/qms-dashboard"
                                    style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                    <button type="button" class="backButton">Back</button>
                                </a> --}}
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                    id="ChangeNextButton" class="nextButton" onclick="nextStep()">Next</button>
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

                    <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">
                                    QA/CQA Head Approval
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Remarks">QA/CQA Head Approval Comment</label>
                                        <textarea name="qa_cqa_comment"></textarea>
                                    </div>
                                </div>
                              
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Report Attachments">QA/CQA Head Approval Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="qa_cqa_attach"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="qa_cqa_attach[]"
                                                    oninput="addMultipleFiles(this, 'qa_cqa_attach')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                              
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>


                    <!-- Activity Log content -->
                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                            <div class="col-12 sub-head"  style="font-size: 16px">
                            Audit Details Summary
                                     </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Audit Schedule On">Audit Details Summary By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Audit Schedule On">Audit Details Summary On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Comments</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                <div class="col-12 sub-head"  style="font-size: 16px">
                                Cancel
                                     </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Cancelled By">Cancelled By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Cancelled On">Cancelled On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Comments</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>


                                <div class="col-12 sub-head"  style="font-size: 16px">
                                Summary and Response Complete
                                     </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Audit Preparation Completed By">Summary and Response Complete By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Summary and Response Complete  On">Summary and Response Complete On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Comments</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>


                                <div class="col-12 sub-head"  style="font-size: 16px">
                                        CFT Review Not Required
                                     </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="CFT Review Not Required By">CFT Review Not Required By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="CFT Review Not Required On">CFT Review Not Required On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Comments</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>



                                    <div class="col-12 sub-head"  style="font-size: 16px">
                                    CFT Review Complete
                                     </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="CFT Review Not Required By">CFT Review Complete By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="CFT Review Not Required On">CFT Review Complete On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Comments</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>





                                    <div class="col-12 sub-head"  style="font-size: 16px">
                                    Approval Complete
                                     </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="CFT Review Not Required By">Approval Complete By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="CFT Review Not Required On">Approval Complete On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Comments</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>

                                    
                                    <div class="col-12 sub-head"  style="font-size: 16px">
                                    Send to Opened
                                     </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="CFT Review Not Required By">Send to Opened By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="CFT Review Not Required On">Send to Opened On</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Comments</label>
                                            <div class="static"></div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                           
                                      

                                   
                              
                                  
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Response Feedback Verified By">Response Feedback Verified
                                            By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Response Feedback Verified On">Response Feedback Verified
                                            On</label>
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
                                </div> --}}

                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
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
            ele: '#Facility, #Group, #Audit, #Auditee ,#reference_record'
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
        // document.addEventListener('DOMContentLoaded', function() {
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
        // });
    </script>
    <script>
        document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            document.getElementById('initiator_group_code').value = selectedValue;
        });
    </script>

    <script>
    $(document).on('click', '.removeRowBtn', function() {
        $(this).closest('tr').remove();
    })
</script>
     <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);});
    </script>
@endsection
