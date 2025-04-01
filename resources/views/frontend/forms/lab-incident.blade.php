@extends('frontend.layout.main')
@section('container')
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>

    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }} / Lab Incident
        </div>
    </div>



    @php
        $users = DB::table('users')->get();
    @endphp
    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QC Head Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm12')">QA Initial Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Investigation Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm14')">QC Head/HOD Secondary Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm15')">QA Secondary Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Closure</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Activity Log</button>

            </div>

            <form action="{{ route('labIncidentCreate') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div id="step-form">

                    <!-- General information content -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        {{-- <input disabled type="text" name="record_number" id="record_number"
                                            value="---/LI/{{ date('y') }}/{{ $record_number }}"> --}}
                                            {{-- <span id="record_number_suffix"></span> --}}

                                            {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                            <input type="hidden" id="record" name="record_number"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/LI/{{ date('y') }}/{{ $record_number}}">
                                        <input disabled type="text"
                                        value="{{ Helpers::getDivisionName(session()->get('division')) }}/LI/{{ date('y') }}/{{ $record_number }}">
                                    {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input readonly type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" name="division_code"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                        <!-- {{-- <div class="static">{{ date('d-M-Y') }}</div> --}} -->
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
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
                                </div> --}}
                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due"> Due Date</label>
                                        <div><small class="text-primary">Please mention expected date of completion</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly
                                                placeholder="DD-MMM-YYYY"/>
                                            <input type="date" name="due_date"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')"  />
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Due Date <span
                                            class="text-danger">*</span></label>
                                        <div class="calenderauditee">
                                            <!-- Display the manually selectable date input -->
                                            <input type="text" id="due_date_display" readonly placeholder="DD-MMM-YYYY" required />

                                            <!-- Editable date input (hidden) -->
                                            <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" required
                                                oninput="handleDateInput(this, 'due_date_display')" />
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function handleDateInput(dateInput, displayId) {
                                        const date = new Date(dateInput.value);

                                        // If date is valid, format it to 'DD-MMM-YYYY'
                                        if (!isNaN(date.getTime())) {
                                            const day = ("0" + date.getDate()).slice(-2); // Add leading 0 if needed
                                            const month = date.toLocaleString('default', { month: 'short' }); // Get short month (e.g. Jan)
                                            const year = date.getFullYear();
                                            const formattedDate = `${day}-${month}-${year}`;
                                            document.getElementById(displayId).value = formattedDate;
                                        } else {
                                            // If no valid date, set placeholder and clear value
                                            document.getElementById(displayId).placeholder = "DD-MMM-YYYY";
                                            document.getElementById(displayId).value = ""; // Clear value to avoid NaN issue
                                        }
                                    }

                                    // Initialize the display field to show placeholder on load
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const dateInput = document.querySelector('input[name="due_date"]');

                                        // If there's an initial date, handle it; otherwise, show placeholder
                                        if (dateInput.value) {
                                            handleDateInput(dateInput, 'due_date_display');
                                        } else {
                                            document.getElementById('due_date_display').placeholder = "DD-MMM-YYYY";
                                        }
                                    });
                                </script>


                                <style>
                                    .hide-input {
                                        display: none;
                                    }
                                </style>




                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group"><b>Initiator Group</b><span
                                            class="text-danger">*</span></label>
                                        <select name="Initiator_Group" id="initiator_group" required>
                                            <option value="">-- Select --</option>
                                            <option value="CQA" @if(old('Initiator_Group') =="CQA") selected @endif>Corporate Quality Assurance</option>
                                            <option value="QAB" @if(old('Initiator_Group') =="QAB") selected @endif>Quality Assurance Biopharma</option>
                                            <option value="CQC" @if(old('Initiator_Group') =="CQA") selected @endif>Central Quality Control</option>
                                            <option value="CQC" @if(old('Initiator_Group') =="MANU") selected @endif>Manufacturing</option>
                                            <option value="PSG" @if(old('Initiator_Group') =="PSG") selected @endif>Plasma Sourcing Group</option>
                                            <option value="CS"  @if(old('Initiator_Group') == "CS") selected @endif>Central Stores</option>
                                            <option value="ITG" @if(old('Initiator_Group') =="ITG") selected @endif>Information Technology Group</option>
                                            <option value="MM"  @if(old('Initiator_Group') == "MM") selected @endif>Molecular Medicine</option>
                                            <option value="CL"  @if(old('Initiator_Group') == "CL") selected @endif>Central Laboratory</option>
                                            <option value="TT"  @if(old('Initiator_Group') == "TT") selected @endif>Tech team</option>
                                            <option value="QA"  @if(old('Initiator_Group') == "QA") selected @endif> Quality Assurance</option>
                                            <option value="QM"  @if(old('Initiator_Group') == "QM") selected @endif>Quality Management</option>
                                            <option value="IA"  @if(old('Initiator_Group') == "IA") selected @endif>IT Administration</option>
                                            <option value="ACC"  @if(old('Initiator_Group') == "ACC") selected @endif>Accounting</option>
                                            <option value="LOG"  @if(old('Initiator_Group') == "LOG") selected @endif>Logistics</option>
                                            <option value="SM"  @if(old('Initiator_Group') == "SM") selected @endif>Senior Management</option>
                                            <option value="BA"  @if(old('Initiator_Group') == "BA") selected @endif>Business Administration</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiator Group Code</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code" value="" readonly required>
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                            <div class="group-input" id="incident_interval_others_gi">
                                                <label for="incident_interval_others_gi">Name of Analyst<span
                                                    class="text-danger">*</span></label>
                                                 <textarea type="text" name="name_of_analyst" required ></textarea>
                                                 {{-- <input type="text" name="name_of_analyst"> --}}
                                            </div>

                                        </div>


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="short_desc" maxlength="255" required>
                                    </div>
                                </div>





                            <!----------------------------------------------------------new table-------------------------------------------------------------------------->


                        <div class="col-12">
                            <div class="group-input" id="IncidentRow">
                                <label for="audit-incident-grid">
                                    Incident Investigation Report
                                    <button type="button" name="audit-incident-grid" id="IncidentAdd">+</button>
                                    <span class="text-primary" data-bs-toggle="modal"
                                        data-bs-target="#observation-field-instruction-modal-LabIncident"
                                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>

                                <table class="table table-bordered" id="onservation-incident-table">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Name of Product</th>
                                            <th>B No./A.R. No.</th>
                                            <th>Remarks</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $serialNumber = 1;
                                    @endphp
                                              {{-- @foreach ($report->data as  $item) --}}
                                                    <tr>
                                              <td style="width: 6%"> {{ $serialNumber++ }} </td>

                                            {{-- <td style="width: 6%"><input type="text" name="investrecord[0][s_no]" value="">
                                              </td>
                                            --}}
                                              <td><input type="text" name="investrecord[0][name_of_product]" value="">
                                               </td>
                                            <td><input type="text" name="investrecord[0][batch_no]" value=""></td>
                                             <td><input type="text" name="investrecord[0][remarks]" value="" ></td>
                                             <td><button class="removeRowBtn">Remove</button>

                                        </tr>
                                       {{-- @endforeach --}}
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
                    var users = @json($users);

                    var html =
                        '<tr>' +
                        '<td><input  type="text" name="investrecord[]" value="' + serialNumber +
                        '"disabled></td>' +
                        '<td><input type="text" name="investrecord['+ investdetails +'][name_of_product]" value=""></td/>' +
                        '<td><input type="text" name="investrecord['+ investdetails +'][batch_no]" value=""></td>' +
                        '<td><input type="text" name="investrecord['+ investdetails +'][remarks]" value=""></td>' +
                        '<td><button class="removeRowBtn">Remove</button></td>' +


                        '</tr>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +

                        '</tr>';
                        investdetails++;

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






                            <!-------------------------------incident grid----------------->

                                {{-- New Added --}}
                                <div class="col-lg-12">
                                    <div class="group-input" id="incident_involved_others_gi">
                                        <label for="incident_involved_others_gi">Instrument Involved<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="incident_involved_others_gi"></textarea>
                                    </div>

                                </div>


                                <div class="col-lg-4">
                                    <div class="group-input" id="stage_stage_gi">
                                        <label for="stage_stage_gi">Stage<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="text" name="stage_stage_gi">
                                    </div>

                                </div><br>
                                <div class="col-lg-4">
                                    <div class="group-input" id="incident_stability_cond_gi">
                                        <label for="incident_stability_cond_gi">Stability Condition (If Applicable)<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="text" name="incident_stability_cond_gi">
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" id="incident_interval_others_gi">
                                        <label for="incident_interval_others_gi">Interval (If Applicable)<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="text" name="incident_interval_others_gi">
                                    </div>

                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input" id="test_gi">
                                        <label for="test_gi">Test<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="text" name="test_gi">
                                    </div>

                                </div>

                                {{-- <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Date Of Analysis <span class="text-danger"></span></label> --}}
                                        {{-- <p class="text-primary"> </p> --}}

                                        {{-- <div class="calenderauditee">
                                            <input type="text" id="incident_date_analysis_gi" readonly
                                                placeholder="DD-MMM-YYYY"/>
                                            <input type="date" name="incident_date_analysis_gi"   class="hide-input" oninput="handleDateInput(this, 'incident_date_analysis_gi')"  />
                                        </div>
                                         --}}
                                    {{-- </div>
                                </div> --}}


                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Analysis Date Due"> Date Of Analysis</label>

                                        <div class="calenderauditee">
                                            <input type="text" id="incident_date_analysis_gi" readonly
                                                placeholder="DD-MMM-YYYY"/>
                                            <input type="date" name="incident_date_analysis_gi"   class="hide-input"
                                                oninput="handleDateInput(this, 'incident_date_analysis_gi')"  />
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6">
                                    <div class="group-input" id="incident_date_analysis_gi">
                                        <label for="incident_date_analysis_gi">Date of Analysis<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="date" name="incident_date_analysis_gi" id="incident_date_analysis_gi" value="">
                                    </div>

                                </div> --}}
                                <script>
                                    function formatDate(input) {
                                        var dateValue = new Date(input.value);
                                        var day = dateValue.getDate();
                                        var month = dateValue.toLocaleString('default', { month: 'long' });
                                        var year = dateValue.getFullYear();
                                        var formattedDate = day + '-' + month + '-' + year;
                                        input.value = formattedDate;
                                    }
                                </script>



                                <div class="col-lg-6">
                                    <div class="group-input" id="incident_specification_no_gi">
                                        <label for="Incident_specification_no">Specification Number<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="text" name="incident_specification_no_gi">
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="incident_stp_no_gi">
                                        <label for="incident_stp_no_gi">STP Number<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="text" name="incident_stp_no_gi">
                                    </div>

                                </div>
                                <!-- <div class="col-lg-6">
                                    <div class="group-input" id="Incident_name_analyst_no_gi">
                                        <label for="Incident_name_analyst_no">Name Of Reported By<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="text" name="Incident_name_analyst_no_gi">
                                    </div>

                                </div> -->
                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="incident_date_incidence_gi">Date of Incidence <span class="text-danger"></span></label>

                                        <div class="calenderauditee">
                                            <input type="text" id="incident_date_incidence_gi_display" readonly
                                                placeholder="DD-MMM-YYYY"/>
                                            <input type="date" name="incident_date_incidence_gi" id="incident_date_incidence_gi" class="hide-input" oninput="handleDateInput(this, 'incident_date_incidence_gi_display')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input" id="description_incidence_gi">
                                        <label for="Description_incidence"> Description Of Incidence<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="description_incidence_gi" id="summernote-1" class="summernote"></textarea>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Reported By <span class="text-danger"></span>
                                        </label>
                                        <textarea name="analyst_sign_date_gi" id=""></textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input" id="analyst_sign_date_gi">
                                        <label for="analyst_sign_date">Analyst Sign Date<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="date" name="analyst_sign_date_gi">
                                    </div>

                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input" id="section_sign_date_gi">
                                        <label for="section_sign_date">Section Head Sign Date<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="date" name="section_sign_date_gi">
                                    </div>

                                </div> --}}
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Section Head Name <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="section_sign_date_gi">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('section_sign_date_gi')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div> --}}
                                {{-- New Added --}}

                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="severity-level">Severity Level</label>
                                        <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span>
                                        <select name="severity_level2">
                                            <option value="0">-- Select --</option>
                                            <option value="minor">Minor</option>
                                            <option value="major">Major</option>
                                            <option value="critical">Critical</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <!-- <div class="col-lg-6">
                                            <div class="group-input" id="initiated_through_req">
                                                <label for="If Other">Others<span
                                                        class="text-danger d-none">*</span></label>
                                                {{-- <textarea {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="initiated_if_other">{{$data->initiated_if_other}}</textarea> --}}
                                            </div>
                                        </div> -->
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date of Occurance">Date of Occurance</label>
                                        <input type="date" name="occurance_date">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="
                                        ">Due Date</label>
                                        <input type="hidden" value="{{ $due_date }}" name="due_date">
                                        <div class="static"> {{ $due_date }}</div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Assigned to">Assigned to</label>
                                        <select name="assigend">
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                        QC Head/HOD Person <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="investigator_qc">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('investigator_qc')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input" id="Incident_Category_others">
                                        <label for="Incident_Category">Others<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="Incident_Category_others"></textarea>
                                    </div>
                                </div>
                                 {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Invocation Type">Invocation Type</label>
                                        <select name="Invocation_Type">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Immediate_action">Immediate Action</label>
                                        <textarea name="immediate_action_ia"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Attachments">Initial Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Attachments"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attachments_gi"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="attachments_gi" name="attachments_gi[]"
                                                    oninput="addMultipleFiles(this, 'attachments_gi')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                <div class="col-md-6">
                    <div class="group-input">
                        <label for="search">
                        QA Reviewer <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="qc_review_to">
                            <option value="">Select a value</option>
                            @foreach ($users as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('qc_review_to')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                                        <!-- QA Review content -->
                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Review Comments">QC Head Review Comments</label>
                                        <textarea name="QA_Review_Comments" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Head Attachments">QC Head Review Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="QA_Head_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_Head_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="QA_Head_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'QA_Head_Attachment')" multiple disabled>
                                            </div>
                                        </div>
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

                        {{-- ---------------QA Initial Review--------- --}}
                        <div id="CCForm12" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Incident Category">QA Initial Review Comments</label>
                                        <textarea name="QA_initial_Comments" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Head Attachments">QA Initial Review Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="QA_Head_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_Initial_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="QA_Initial_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'QA_Initial_Attachment')" multiple disabled>
                                            </div>
                                        </div>
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


                    <!-- Investigation Details content -->
                    <div id="CCForm9" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                {{-- <div class="col-12 sub-head">
                                    Questionnaire
                                </div> --}}
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="INV Questionnaire">INV Questionnaire</label>
                                        <div class="static">Question datafield</div>
                                    </div>
                                </div> --}}

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Investigation Details ">Investigation Details</label>
                                        <textarea name="Investigation_Details" class="tiny" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Action Taken">Action Taken</label>
                                        <textarea name="Action_Taken" class="tiny" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Root Cause">Root Cause</label>
                                        <textarea name="Root_Cause" class="tiny" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Inv_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Inv_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Inv_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Inv_Attachment')" multiple disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                <div class="group-input">
                                    <label for="detail investigation ">Detail Investigation / Probable Root Cause</label>
                                <textarea name="details_investigation_ia" class="tiny" disabled></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="proposed corrective action ">Proposed Corrective Action/Corrective Action Taken</label>
                            <textarea name="proposed_correctivei_ia" class="tiny" disabled></textarea>
                        </div>
                     </div>


                     <div class="col-12">
                        <div class="group-input">
                            <label for="Repeat Analysis Plan ">Repeat Analysis Plan</label>
                        <textarea name="repeat_analysis_plan_ia" class="tiny" disabled></textarea>
                      </div>
                         </div>



                <div class="col-12">
                    <div class="group-input">
                        <label for="Result Of Repeat Analysis ">Result Of Repeat Analysis</label>
                    <textarea name="result_of_repeat_analysis_ia" class="tiny" disabled></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Corrective and Preventive Action">Corrective and Preventive Action</label>
                <textarea name="corrective_and_preventive_action_ia" class="tiny" disabled></textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="group-input">
                <label for="CAPA Number">CAPA Number</label>
            <input type="text" name="capa_number_im" disabled>
        </div>
         </div>

         <div class="col-12">
            <div class="group-input">
                <label for="Investigation Summary">Investigation Summary</label>
            <textarea name="investigation_summary_ia" class="tiny" disabled></textarea>
        </div>
    </div>



    {{-- type of incidence --}}

    {{-- <div class="col-lg-12">
        <div class="group-input">
            <label for="Type Of Incidence"><b>Type Of Incidence</b></label>
            <select name="type_incidence_ia" id="initiator_group">
                <option value="0">-- Select --</option>
                <option value="Analyst Error">Analyst Error</option>
                <option value="Instrument Error">Instrument Error</option>
                <option value="Atypical Error">Atypical Error</option>
                <option value="">Other</option>


            </select>
        </div>
    </div> --}}

    {{-- <div class="col-lg-12">
        <div class="group-input">
            <label for="Type Of Incidence"><b>Type Of Incidence</b></label>
            <select name="type_incidence_ia" id="type_incidence_ia">
                <option value="0">-- Select --</option>
                <option value="Analyst Error">Analyst Error</option>
                <option value="Instrument Error">Instrument Error</option>
                <option value="Atypical Error">Atypical Error</option>
                <option value="Other">Other</option>
            </select>
        </div>
    </div> --}}

    <div class="col-lg-12" id="other_incidence_div" style="display: none;">
        <div class="group-input">
            <label for="other_incidence"><b>Other Incidence</b></label>
            <input type="text" name="other_incidence" id="other_incidence" placeholder="Specify other type of incidence" disabled>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var typeIncidenceSelect = document.getElementById('type_incidence_ia');
            var otherIncidenceDiv = document.getElementById('other_incidence_div');

            typeIncidenceSelect.addEventListener('change', function() {
                if (typeIncidenceSelect.value === 'Other') {
                    otherIncidenceDiv.style.display = 'block';
                } else {
                    otherIncidenceDiv.style.display = 'none';
                }
            });
        });
    </script>


    {{-- type of incidence --}}


                {{-- selection field --}}

                <div class="col-md-6">
                    <div class="group-input">
                        <label for="search">
                            QC Investigator <span class="text-danger"></span>
                        </label>
                            <textarea name="investigator_data" class="tiny" id="" disabled></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="group-input">
                        <label for="search">
                            QC Review <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="qc_review_data" disabled>
                            <option value="">Select a value</option>
                            @foreach ($users as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('qc_review_data')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="group-input">
                        <label for="search">
                            QC Approved By <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="investigator_approve_im">
                            <option value="">Select a value</option>
                            @foreach ($users as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                        @error('assign_to')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div> --}}
                {{-- selection field --}}



                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Attachments">Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Attachments"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attachments_ia"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="attachments_ia" name="attachments_ia[]"
                                                    oninput="addMultipleFiles(this, 'attachments_ia')" multiple disabled>
                                            </div>
                                        </div>
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

                    {{-- ---------------------------------------QC Head/HOD Secondary Review------------------------------------------------ --}}
                    <div id="CCForm14" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                            <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Incident Category">Incident Category</label>
                                        <select name="Incident_Category" id="Incident_Category_data" disabled>
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="Biological">Biological</option>
                                            <option value="Chemical">Chemical</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12" id="other_incidence_data" style="display: none;">
                                    <div class="group-input">
                                        <label for="Other Incidence"><b>Other Incident Category</b></label>
                                        <input type="text" name="other_incidence_data" id="other_incidence_data" value="" disabled/>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const typeIncidenceSelect = document.getElementById('Incident_Category_data');
                                        const otherIncidenceDiv = document.getElementById('other_incidence_data');

                                        function toggleOtherIncidence() {
                                            if (typeIncidenceSelect.value === 'Other') {
                                                otherIncidenceDiv.style.display = 'block';
                                            } else {
                                                otherIncidenceDiv.style.display = 'none';
                                            }
                                        }

                                        typeIncidenceSelect.addEventListener('change', toggleOtherIncidence);

                                        // Initial check on page load
                                        toggleOtherIncidence();
                                    });
                                </script>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Incident Category">QC Head/HOD Secondary Review Comments</label>
                                        <textarea name="QC_head_hod_secondry_Comments" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Head Attachments">QC Head/HOD Secondary Review Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="QA_Head_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QC_headhod_secondery_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="QC_headhod_secondery_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'QC_headhod_secondery_Attachment')" multiple disabled>
                                            </div>
                                        </div>
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
                    {{-- -------------------------------Pending Initiator Update---------------------- --}}

                    <!-- <div id="CCForm13" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Incident Category">Pending Initiator Update Comments</label>
                                        <textarea name="pending_update_Comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Head Attachments">Pending Initiator Update Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="QA_Head_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="pending_update_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="pending_update_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'pending_update_Attachment')" multiple>
                                            </div>
                                        </div>
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
                    </div> -->

                                        {{-- ---------------------------------------QA Secondary Review----------------------------------------------- --}}
                    <div id="CCForm15" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Incident Category">QA Secondary Review Comments</label>
                                        <textarea name="QA_secondry_Comments" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Head Attachments">QA Secondary ReviewAttachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="QA_Head_Attachment"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_secondery_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="QA_secondery_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'QA_secondery_Attachment')" multiple disabled>
                                            </div>
                                        </div>
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


                <div id="CCForm11" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure_incident_c">Closure Of Incident</label>
                                        <input type="text" name="closure_incident_c" disabled>
                                    </div>

                                </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for=" qa head remark"><b>QA Head Comment</b></label>
                                   <textarea name="qa_hear_remark_c" class="tiny" disabled></textarea>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure_attachment_c">Closure Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="closure_attachment_c"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="closure_attachment_c" name="closure_attachment_c[]"
                                                oninput="addMultipleFiles(this, 'closure_attachment_c')" multiple disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>

                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>


                            </div>
                        </div>
                </div>
                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                            <div class="col-12 sub-head" style="font-size: 16px">
                                    Submit
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submit By">Submit By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submit On">Submit On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Submit Comment</label>
                                        <div class="static" ></div>
                                    </div>
                                </div>

                                <div class="col-12 sub-head"  style="font-size: 16px">
                                QC Head/HOD Initial Review Complete
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Verification Complete">QC Head/HOD Initial Review Complete By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Incident Review Completed On">QC Head/HOD Initial Review Complete On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                {{-- @foreach($detail as $d) --}}
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">QC Head/HOD Initial Review Complete Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                {{-- @endforeach --}}
                                <div class="col-12 sub-head"  style="font-size: 16px">
                                    QA Initial Review Complete
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Investigation Completed By">QA Initial Review Complete By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Investigation Completed On">QA Initial Review Complete On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">QA Initial Review Complete Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>


                                <div class="col-12 sub-head"  style="font-size: 16px">
                                Pending Initiator Update Complete
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Assignable Cause Identification Completed">Pending Initiator Update Complete By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Assignable Cause Identification Completed">Pending Initiator Update Complete On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6"> --}}
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Pending Initiator Update Complete Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>


                                <div class="col-12 sub-head"  style="font-size: 16px">
                                    QC Head/HOD Secondary Review Complete
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="No Assignable Completed By">QC Head/HOD Secondary Review Complete By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="No Assignable Completed On">QC Head/HOD Secondary Review Complete On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">QC Head/HOD Secondary Review Complete Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>


                                <div class="col-12 sub-head"  style="font-size: 16px">
                                    QA Secondary Review Complete
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Extended Inv Completed By">QA Secondry Review Complete By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Extended Inv Completed On">QA Secondry Review Complete On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">QA Secondry Review Complete Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-12 sub-head"  style="font-size: 16px">
                                    Approved
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Solution Validation Completed By">Approved By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Solution Validation Completed On">Approved On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Approved Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>

                                <div class="col-12 sub-head"  style="font-size: 16px">
                                    Cancel
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Cancelled By">Cancel By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Cancelled On">Cancel On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Cancel Comment</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                </div>

                                <div class="button-block">
                                <!-- <button type="submit" class="saveButton">Save</button> -->
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <!-- <button type="submit">Submit</button> -->
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" href="#"> Exit </a></button>

                                 <!-- Incident Details content -->
                      {{-- <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Incident Details">Incident Details</label>
                                        <textarea name="Incident_Details"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Document Details ">Document Details</label>
                                        <textarea name="Document_Details"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Instrument Details">Instrument Details</label>
                                        <textarea name="Instrument_Details"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Involved Personnel">Involved Personnel</label>
                                        <textarea name="Involved_Personnel"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Product Details,If Any">Product Details,If Any</label>
                                        <textarea name="Product_Details"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Supervisor Review Comments">Supervisor Review Comments</label>
                                        <textarea name="Supervisor_Review_Comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="ccf_attachments">File Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                        {{-- <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="ccf_attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="ccf_attachments" name="ccf_attachments[]"
                                                    oninput="addMultipleFiles(this, 'ccf_attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-12 sub-head">
                                    Cancelation
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Cancelation Remarks">Cancelation Remarks</label>
                                        <textarea name="Cancelation_Remarks"></textarea>
                                    </div>
                                </div> --}}
                            {{-- </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div> --}}

                                        <!-- CAPA content -->
                    {{-- <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="capa">Capa</label>
                                        <textarea name="capa_capa"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Currective Action">Corrective Action</label>
                                        <textarea name="Currective_Action"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Preventive Action">Preventive Action</label>
                                        <textarea name="Preventive_Action"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Corrective & Preventive Action">Corrective & Preventive Action</label>
                                        <textarea name="Corrective_Preventive_Action"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="CAPA Attachments">CAPA Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="CAPA_Attachment"> --}}
                                        {{-- <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="CAPA_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="CAPA_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'CAPA_Attachment')" multiple>
                                            </div>
                                        </div>
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
                    </div> --}}
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
            ele: '#Facility, #Group, #Audit, #Auditee'
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
    var originalRecordNumber = document.getElementById('record_number').value;
    var initialPlaceholder = '---';

    document.getElementById('initiator_group').addEventListener('change', function() {
        var selectedValue = this.value;
        var recordNumberElement = document.getElementById('record_number');
        var initiatorGroupCodeElement = document.getElementById('initiator_group_code');

        // Update the initiator group code
        initiatorGroupCodeElement.value = selectedValue;

        // Update the record number by replacing the initial placeholder with the selected initiator group code
        var newRecordNumber = originalRecordNumber.replace(initialPlaceholder, selectedValue);
        recordNumberElement.value = newRecordNumber;

        // Update the original record number to keep track of changes
        originalRecordNumber = newRecordNumber;
        initialPlaceholder = selectedValue;
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
            $('#rchars').text(textlen);});
    </script>
    <script>
        var maxLength = 255;
        $('#duedoc').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchar').text(textlen);});
    </script>





@endsection
