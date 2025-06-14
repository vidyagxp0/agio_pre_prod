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

    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> : {{ Helpers::getDivisionName(session()->get('division')) }}/Observation
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
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Response & CAPA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Summary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Response Verification</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Activity Log</button>
            </div>

            <form action="{{ route('observationstore') }}" method="post" enctype="multipart/form-data" class="formSubmit">
                @csrf
                <div id="step-form">
                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif

                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sub-head">General Information</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>

                                        @if (!empty($parent_division_id))
                                            <input disabled type="text"
                                                value="{{ Helpers::getDivisionName($parent_division_id) }}/OBS/{{ date('Y') }}/{{ $record_number }}">
                                            <input type="hidden" name="record_number" id="record_number"
                                                value="{{ Helpers::getDivisionName($parent_division_id)}}/OBS/{{ date('Y') }}/{{ $record_number }}">
                                        @else
                                            <input disabled type="text"
                                                value="{{ Helpers::getDivisionName(session()->get('division')) }}/OBS/{{ date('Y') }}/{{ $record_number }}">
                                                <input type="hidden" name="record_number" id="record_number"
                                                value="{{ Helpers::getDivisionName(session()->get('division')) }}/OBS/{{ date('Y') }}/{{ $record_number }}">
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        @if (!empty($parent_division_id))
                                        
                                            <input readonly type="text" name="division_id"
                                                value="{{ Helpers::getDivisionName($parent_division_id) }}">
                                            <input type="hidden" name="division_id" value="{{ $parent_division_id }}">

                                        @else
                                            <input readonly type="text" name="division_id"
                                                value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                            <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="originator">Initiator</label>
                                        <input disabled type="text" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="date_opened">Date of Initiation</label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="assign_to1">Auditee department Head</label>
                                        <select name="assign_to">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Auditee department Name</b></label>
                                        <input readonly type="text" name="auditee_department" id="initiator_group"
                                            value="{{ Helpers::getUsersDepartmentName(Auth::user()->departmentid) }}">
                                    </div>
                                </div> --}}

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="assign_to1">Auditee Department Head</label>
                                        <select name="assign_to" id="assign_to">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}" data-department-id="{{ $data->departmentid }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Auditee Department Name</b></label>
                                        <input readonly type="text" name="auditee_department" id="initiator_group">
                                    </div>
                                </div>


                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        let assignToSelect = document.getElementById("assign_to");
                                        let departmentInput = document.getElementById("initiator_group");

                                        assignToSelect.addEventListener("change", function () {
                                            let selectedOption = assignToSelect.options[assignToSelect.selectedIndex];
                                            let departmentId = selectedOption.getAttribute("data-department-id");

                                            if (departmentId) {
                                                // AJAX request to get department name
                                                fetch(`/get-department-name/${departmentId}`)
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        departmentInput.value = data.department_name || "N/A";
                                                    })
                                                    .catch(error => {
                                                        console.error("Error fetching department name:", error);
                                                    });
                                            } else {
                                                departmentInput.value = "N/A";
                                            }
                                        });
                                    });
                                </script>



                            {{-- <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    // Define department name to code mapping
                                    const departmentMapping = {
                                        "Calibration Lab": "CLB",
                                        "Engineering": "ENG",
                                        "Facilities": "FAC",
                                        "LAB": "LAB",
                                        "Labeling": "LABL",
                                        "Manufacturing": "MANU",
                                        "Quality Assurance": "QA",
                                        "Quality Control": "QC",
                                        "Ragulatory Affairs": "RA",
                                        "Security": "SCR",
                                        "Training": "TR",
                                        "IT": "IT",
                                        "Application Engineering": "AE",
                                        "Trading": "TRD",
                                        "Research": "RSCH",
                                        "Sales": "SAL",
                                        "Finance": "FIN",
                                        "Systems": "SYS",
                                        "Administrative": "ADM",
                                        "M&A": "M&A",
                                        "R&D": "R&D",
                                        "Human Resource": "HR",
                                        "Banking": "BNK",
                                        "Marketing": "MRKT",

                                    };

                                    // Get the Initiator Department input
                                    let initiatorGroupInput = document.getElementById("initiator_group");
                                    let initiatorGroupCodeInput = document.getElementById("initiator_group_code");

                                    // Get the department name from the input field
                                    let departmentName = initiatorGroupInput.value.trim();

                                    // Auto-generate the department code based on the mapping
                                    if (departmentName in departmentMapping) {
                                        initiatorGroupCodeInput.value = departmentMapping[departmentName];
                                    } else {
                                        initiatorGroupCodeInput.value = "N/A"; // Default if not found
                                    }
                                });
                            </script> --}}

                        {{-- <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Observation Report Due Date</label>
                                        <div class="calenderauditee">
                                            <!-- Display the manually selectable date input -->
                                            <input type="text" id="due_date" readonly placeholder="DD-MMM-YYYY" />

                                            <!-- Editable date input (hidden) -->
                                            <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                    </div>
                                </div> --}}
                                
                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Observation Report Due Date</label>
                                        <div class="calenderauditee">
                                            <!-- Display the manually selectable date input -->
                                            <input type="text" id="due_date_display" name="due_date" value="{{ date('d-M-Y') }}" placeholder="DD-MMM-YYYY" />

                                            <!-- Editable date input (hidden) -->
                                            <input type="date" value="{{ date('Y-m-d') }}" name="due_date"  class="hide-input"
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


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="short_description" maxlength="255"
                                            required>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description"><b>Short Description <span
                                            class="text-danger">*</span></b></label>
                                        <textarea name="short_description" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="sub-head">Observation Details</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="grading">Grading</label>
                                        <select name="grading">
                                            <option value="">-- Select --</option>
                                            <option value="1">Recommendation</option>
                                            <option value="2">Major</option>
                                            <option value="3">Minor</option>
                                            <option value="4">Critical</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="category_observation">Category Observation</label>
                                        <select name="category_observation">
                                            <option value="">-- Select --</option>
                                            <option title="Case Report Form (CRF)" value="1">
                                                Case Report Form (CRF)
                                            </option>
                                            <option title="Clinical Database" value="2">
                                                Clinical Database
                                            </option>
                                            <option title="Clinical Trial Protocol" value="3">
                                                Clinical Trial Protocol
                                            </option>
                                            <option title="Clinical Trial Report" value="4">
                                                Clinical Trial Report
                                            </option>
                                            <option title="Compliance" value="5" >
                                                Compliance
                                            </option>
                                            <option title="Computerized systems" value="6">
                                                Computerized systems
                                            </option>
                                            <option title="Conduct of Study" value="7">
                                                Conduct of Study
                                            </option>
                                            <option title="Data Accuracy / SDV" value="8">
                                                Data Accuracy / SDV
                                            </option>
                                            <option title="Documentation" value="9">
                                                Documentation
                                            </option>
                                            <option title="Essential Documents (TMF/ISF)" value="10">
                                                Essential Documents (TMF/ISF)
                                            </option>
                                            <option title="Ethics Committee (IEC / IRB)" value="11">
                                                Ethics Committee (IEC / IRB)
                                            </option>
                                            <option title="Facilities / Equipment" value="12">
                                                Facilities / Equipment
                                            </option>
                                            <option title="Miscellaneous" value="13">
                                                Miscellaneous
                                            </option>
                                            <option title="Monitoring" value="14">
                                                Monitoring
                                            </option>
                                            <option title="Organization and Responsibilities" value="16">
                                                Organization and Responsibilities
                                            </option>
                                            <option title="Periodic Safety Reporting" value="17">
                                                Periodic Safety Reporting
                                            </option>
                                            <option title="Protocol Compliance" value="18">
                                                Protocol Compliance
                                            </option>
                                            <option title="Qualification and Training of Staff" value="19">
                                                Qualification and Training of Staff
                                            </option>
                                            <option title="Quality Management System" value="20">
                                                Quality Management System
                                            </option>
                                            <option title="Regulatory Requirements" value="25">
                                                Regulatory Requirements
                                            </option>
                                            <option title="Reliability of Data" value="26">
                                                Reliability of Data
                                            </option>
                                            <option title="Safety Reporting" value="27">
                                                Safety Reporting
                                            </option>
                                            <option title="Source Documents" value="28">
                                                Source Documents
                                            </option>
                                            <option title="Subject Diary(ies)" value="29">
                                                Subject Diary(ies)
                                            </option>
                                            <option title="Informed Consent Form" value="30">
                                                Informed Consent Form
                                            </option>
                                            <option title="Subject Questionnaire(s)" value="31">
                                                Subject Questionnaire(s)
                                            </option>
                                            <option title="Supporting Procedures" value="32">
                                                Supporting Procedures
                                            </option>
                                            <option title="Test Article and Accountability" value="33">
                                                Test Article and Accountability
                                            </option>
                                            <option title="Trial Master File (TMF)" value="34">
                                                Trial Master File (TMF)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="reference_guideline">Referenced Guideline</label>
                                        <input type="text" name="reference_guideline">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="desc">Description</label>
                                        <textarea name="description"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="sub-head">Further Information</div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="attach_files1">Attached Files</label>
                                        <input type="file" name="attach_files1" />
                                    </div>
                                </div> --}}
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Attached Files">Attached Files </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attach_files_gi"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="attach_files_gi" name="attach_files_gi[]"
                                                    oninput="addMultipleFiles(this, 'attach_files_gi')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="attach_files1">Attached Files</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attach_files1"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="attach_files1[]"
                                                    oninput="addMultipleFiles(this, 'attach_files1')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="capa_date_due">Recomendation Date Due for CAPA</label>
                                        <input type="date" name="recomendation_capa_date_due" />
                                    </div>
                                </div> --}}
                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date ">
                                        <label for="capa_date_due">Response Due Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" name="recomendation_capa_date_due"
                                                id="recomendation_capa_date_due" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                class="hide-input"
                                                oninput="handleDateInput(this, 'recomendation_capa_date_due')" />
                                        </div>
                                    </div>
                                </div>


                                <div class="group-input">
                                    <label for="audit-agenda-grid">
                                        Observation
                                        <button type="button" name="details" id="Details-add">+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Details-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 8%">Sr.No</th>
                                                    <th style="width: 40%">Observation</th>
                                                    <th style="width: 40%">Category</th>
                                                    <th style="width: 12%">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="observation[0][serial]"
                                                        value="1"></td>
                                                <td>
                                                    <textarea name="observation[0][non_compliance]" rows="3" cols="40"></textarea>
                                                </td>

                                                <td>
                                                <select name="observation[0][category]" class="category">
                                                    <option value="select">Select Category</option>
                                                    <option value="major">Major</option>
                                                    <option value="minor">Minor</option>
                                                     <option value="critical">Critical</option>
                                                </select>
                                               </td>
                                                <td><button type="text" class="removeRowBtn">Remove</button></td>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <script>
                                        $(document).ready(function() {
                                            $('#Details-add').click(function(e) {
                                                function generateTableRow(serialNumber) {
                                                    var html = '';
                                                    html += '<tr>' +
                                                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                                                        '"></td>' +
                                                        '<td><textarea name="observation[' + serialNumber + '][non_compliance]" rows="3" cols="40"></textarea></td>'
                                                        +
                                                        
                                                        '<td><select name="observation[' + serialNumber + '][category]" class="category">' +
                                                            '<option value="select">Select Category</option>' +
                                                            '<option value="major">Major</option>' +
                                                            '<option value="minor">Minor</option>' +
                                                            '<option value="critical">Critical</option>' +
                                                        '</select></td>' +

                                                        '<td><button type="text" class="removeRowBtn" >Remove</button></td>' +

                                                        '</tr>';

                                                    return html;
                                                }

                                                var tableBody = $('#Details-table tbody');
                                                var rowCount = tableBody.children('tr').length;
                                                var newRow = generateTableRow(rowCount + 1);
                                                tableBody.append(newRow);
                                            });
                                        });
                                    </script>


                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton on-submit-disable-button">Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                <button type="button"> <a class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sub-head">Response and CAPA Plan Details</div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="date_Response_due">Date Response Due</label>
                                        <input type="date" name="date_Response_due2" />
                                    </div>
                                </div> --}}
                                <!-- <div class="col-md-12 new-date-data-field">
                                            <div class="group-input input-date ">
                                                <label for="date_Response_due1">Response Details (+) </label>
                                                <textarea name="response_detail" id=""></textarea>
                                            </div>
                                        </div> -->

                                    <div class="group-input">
                                    <label for="audit-agenda-grid">
                                    Response Details
                                        <button type="button" name="details" id="Details-add1" disabled>+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Details-table2">
                                            <thead>
                                                <tr>
                                                    <th style="width: 8%">Sr.No</th>
                                                    <th style="width: 80%">Response</th>
                                                    <th style="width: 12%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="response[0][serial]" value="1" style="flex-grow: 1; width: 100%;"></td>
                                                <td><textarea disabled name="response[0][response_detail]" style="flex-grow: 1; width: 100%;"></textarea></td>
                                                <td><button type="text" class="removeRowBtn" disabled>Remove</button></td>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <script>
                                        $(document).ready(function() {
                                            $('#Details-add1').click(function(e) {
                                                function generateTableRow(serialNumber) {
                                                    var html = '';
                                                    html += '<tr>' +
                                                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                                                        '"></td>' +
                                                        '<td><textarea  name="response[' + serialNumber +
                                                        '][response_detail]"></textarea></td>' +
                                                        '<td><button type="text" class="removeRowBtn" >Remove</button></td>' +
                                                        '</tr>';

                                                    return html;
                                                }

                                                var tableBody = $('#Details-table2 tbody');
                                                var rowCount = tableBody.children('tr').length;
                                                var newRow = generateTableRow(rowCount + 1);
                                                tableBody.append(newRow);
                                            });
                                        });
                                    </script>

                                        <!-- <div class="col-lg-12 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="date_due">Corrective Actions (+)</label>
                                                <textarea name="corrective_action" id=""></textarea>
                                            </div>

                                        </div>
                                         -->

                                         <div class="group-input">
                                    <label for="audit-agenda-grid">
                                    Corrective Actions
                                        <button type="button" name="details" id="Details-add3" disabled>+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Details-table3">
                                            <thead>
                                                <tr>
                                                    <th style="width: 8%">Sr.No</th>
                                                    <th style="width: 80%">Corrective Actions</th>
                                                    <th style="width: 12%">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="corrective[0][serial]" value="1" style="flex-grow: 1; width: 100%;"></td>
                                                <td><textarea disabled type="text" name="corrective[0][corrective_action]" style="flex-grow: 1; width: 100%;"></textarea> </td>
                                                <td><button type="text" class="removeRowBtn" disabled>Remove</button></td>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <script>
                                        $(document).ready(function() {
                                            $('#Details-add3').click(function(e) {
                                                function generateTableRow(serialNumber) {
                                                    var html = '';
                                                    html += '<tr>' +
                                                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                                                        '<td><textarea type="text" name="corrective[' + serialNumber +'][corrective_action]"></textarea></td>' +
                                                        '<td><button type="text" class="removeRowBtn" >Remove</button></td>' +
                                                        '</tr>';

                                                    return html;
                                                }

                                                var tableBody = $('#Details-table3 tbody');
                                                var rowCount = tableBody.children('tr').length;
                                                var newRow = generateTableRow(rowCount + 1);
                                                tableBody.append(newRow);
                                            });
                                        });
                                    </script>


                                        <!-- <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="assign_to2">Preventive Action (+)</label>
                                                    <textarea name="preventive_action"></textarea>
                                            </div>
                                        </div> -->

                                        <div class="group-input">
                                    <label for="audit-agenda-grid">
                                    Preventive Action
                                        <button type="button" name="details" id="Details-add4" disabled>+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Details-table4">
                                            <thead>
                                                <tr>
                                                    <th style="width: 8%">Sr.No</th>
                                                    <th style="width: 80%">Preventive Action</th>
                                                    <th style="width: 12%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="preventive[0][serial]"  value="1" style="flex-grow: 1; width: 100%;"></td>
                                                <td><textarea disabled type="text" name="preventive[0][preventive_action]" style="flex-grow: 1; width: 100%;"> </textarea></td>
                                                <td><button type="text" class="removeRowBtn" disabled>Remove</button></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <script>
                                        $(document).ready(function() {
                                            $('#Details-add4').click(function(e) {
                                                function generateTableRow(serialNumber) {
                                                    var html = '';
                                                    html += '<tr>' +
                                                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +'"></td>' +
                                                        '<td><textarea type="text" name="preventive[' + serialNumber +'][preventive_action]"></textarea></td>' +
                                                        '<td><button type="text" class="removeRowBtn" >Remove</button></td>' +
                                                        '</tr>';

                                                    return html;
                                                }

                                                var tableBody = $('#Details-table4 tbody');
                                                var rowCount = tableBody.children('tr').length;
                                                var newRow = generateTableRow(rowCount + 1);
                                                tableBody.append(newRow);
                                            });
                                        });
                                    </script>


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="action-plan-grid">
                                            Action Plan<button type="button" name="action-plan-grid"
                                                id="observation_table" disabled>+</button>
                                        </label>
                                        <table class="table table-bordered" id="observation">
                                            <thead>
                                                <tr>
                                                    <th style="width: 25px;">S.No.</th>
                                                    <th>Action</th>
                                                    <th>Responsible</th>
                                                    <th>Target Completion Date</th>
                                                    <th>Action Status</th>
                                                    <th style="width: 15%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input  type="text" name="action[]"></td>
                                                {{-- <td><input type="text" name="responsible[]"></td> --}}
                                                <td> <select  id="select-state" placeholder="Select..."
                                                        name="responsible[]">
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                {{-- <td><input type="text" name="deadline[]"></td> --}}
                                                <td>
                                                    <div class="group-input new-date-data-field mb-0">
                                                        <div class="input-date ">
                                                            <div class="calenderauditee">
                                                                <input  type="text" id="deadline' + serialNumber +'"
                                                                    readonly placeholder="DD-MMM-YYYY" />
                                                                <input  type="date"
                                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"name="deadline[]"
                                                                    class="hide-input"
                                                                    oninput="handleDateInput(this, `deadline' + serialNumber +'`)" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><input  type="text" name="item_status[]"></td>
                                                <td><button type="text"
                                                    class="removeRowBtn">Remove</button></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="comments">Comments</label>
                                        <textarea name="comments" disabled></textarea>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Attachments">Response and CAPA Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Attachments"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="response_capa_attach"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input disabled type="file" id="response_capa_attach" name="response_capa_attach[]"
                                                    oninput="addMultipleFiles(this, 'response_capa_attach')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>



                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sub-head">Action Summary</div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="actual_start_date">Actual Start Date</label>
                                        <input type="date" name="actual_start_date">
                                    </div>
                                </div> --}}
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="actual_start_date">Actual Action Start Date</label>
                                        <div class="calenderauditee">
                                            <input disabled type="text" id="actual_start_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input disabled type="date"
                                                id="actual_start_date_checkdate" name="actual_start_date"
                                                class="hide-input"
                                                oninput="handleDateInput(this, 'actual_start_date');checkDate('actual_start_date_checkdate','actual_end_date_checkdate')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6  new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="actual_end_date">Actual Action End Date</lable>
                                            <div class="calenderauditee">
                                                <input disabled type="text" id="actual_end_date" placeholder="DD-MMM-YYYY" />
                                                <input disabled type="date"
                                                    id="actual_end_date_checkdate" name="actual_end_date"
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'actual_end_date');checkDate('actual_start_date_checkdate','actual_end_date_checkdate')" />
                                            </div>


                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="action_taken">Action Taken</label>
                                        <textarea disabled name="action_taken" class="summernote"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="sub-head">Response Summary</div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="response_summary">Response Summary</label>
                                        <textarea disabled name="response_summary" class="summernote"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="attach_files">Response and Summary Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="impact_analysis"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input disabled type="file" id="myfile" name="impact_analysis[]"
                                                    oninput="addMultipleFiles(this, 'impact_analysis')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="related_url">Related URL</label>
                                        <input type="text" name="related_url">
                                    </div>
                                </div> --}}

                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                            <div class="col-12">
                                            <div class="group-input">
                                                <label for="impact">Response Verification Comment</label>
                                                <textarea disabled name="impact"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                    <div class="group-input">
                                        <label for="attach_files">Response Verification Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attach_files2"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input disabled type="file" id="myfile" name="attach_files2[]"
                                                    oninput="addMultipleFiles(this, 'attach_files2')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                            <div class="col-12">
                                            <div class="sub-head">Report Issued</div>
                                        </div>


                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancel By">Report Issued By</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancel By">Report Issued On</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancel By">Report Issued Comment</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="sub-head">Cancel</div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancel By">Cancel By</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Cancel On">Cancel On</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted on">Cancel Comment</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="sub-head">More Info Required</div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="More Info Required By">More Info Required By</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="More Info Required On">More Info Required On</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted on">More Info Required Comment</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="sub-head">CAPA Plan Proposed</div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Reject CAPA Plan By">CAPA Plan Proposed By</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="CAPA Plan Proposed On">CAPA Plan Proposed On</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted on">CAPA Plan Proposed Comment</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="sub-head">No CAPA's Required</div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="QA Approval Without CAPA By">No CAPA's Required By</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="No CAPA's Plan Proposed On">No CAPA's Required On</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted on">No CAPA's Required Comment</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="sub-head">Response Reviewed</div>
                                        </div>



                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="QA Approval On">Response Reviewed By</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Response Reviewed By">Response Reviewed On</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Submitted on">Response Reviewed Comment</label>
                                                <div class="static">Not Applicable</div>
                                            </div>
                                        </div>

                            </div>
                            <div class="button-block">
                                <!-- <button type="submit" class="saveButton">Save</button> -->
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <!-- <button type="submit">Submit</button> -->
                                <button type="button"> <a class="text-white"
                                        href="{{ url('rcms/qms-dashboard') }}"> Exit </a>
                                </button>
                            </div>
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


        </script>

    <script>
        $(document).ready(function() {
            $('#observation_table').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="action[]"></td>' +
                        '<td><select name="responsible[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        // '<td><input type="date" name="deadline[]"></td>' +
                        '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="deadline' +
                        serialNumber +
                        '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="deadline[]" class="hide-input" oninput="handleDateInput(this, `deadline' +
                    serialNumber + '`)" /></div></div></div></td>' +

                        '<td><input type="text" name="item_status[]"></td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                        '</tr>';



                    return html;
                }

                var tableBody = $('#observation tbody');
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
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.formSubmit').on('submit', function(e) {
                $('.on-submit-disable-button').prop('disabled', true);
            });
        });
    </script>
@endsection
