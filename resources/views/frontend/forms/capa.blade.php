@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->get();
    @endphp
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>

 <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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


    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }} / CAPA
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
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Equipment/Material Info</button> -->
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">CAPA Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm11')">HOD Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm12')">QA/CQA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm15')">QA/CQA Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm19')">Initiator CAPA Update </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm13')">HOD Final Review</button>
                 <button class="cctablinks" onclick="openCity(event, 'CCForm14')">QA/CQA Closure Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">CAPA Closure</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Activity Log</button>



                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Group Comments</button> --}}
            </div>

            <form class="formSubmit" action="{{ route('capastore') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div id="step-form">

                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif
                    <!-- General information content -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                {{-- <div class="col-lg-6">
                                    {{-- <div class="group-input">
                                        <label for="RLS Record Number">Record Number</label>
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/CAPA/{{ date('Y') }}/{{ $record_number }}">
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    {{-- </div> --}}
                                    {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="RLS Record Number"><b>Record Number</b></label>
                                            {{-- <input disabled type="text" name="record" value=""> --}}
                                            {{-- <input disabled type="text" name="record" value=" {{ Helpers::getDivisionName(session()->get('division')) }}/LI/{{ date('Y') }}/{{ $record }}">
                                            <input disabled type="text" name="record_number" id="record"
                                                   value="{{ Helpers::getDivisionName(session()->get('division')) }}/CAPA/{{ date('y') }}/{{ $record_number }}">
                                        </div>
                                    </div>

                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        {{-- <input disabled type="text" name="record" value=""> --}}
                                        {{-- <input disabled type="text" name="record" value=" {{ Helpers::getDivisionName(session()->get('division')) }}/LI/{{ date('Y') }}/{{ $record}}"> --}}
                                        <input disabled type="text" name="record" id="record"
                                        value="{{ Helpers::getDivisionName(session()->get('division')) }}/CAPA/{{ date('Y') }}/{{ $record_number }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code">Site/Location Code</label>
                                        <input readonly type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator">Initiator </label>
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" name="division_code"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due">Date of Initiation</label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span
                                            class="text-danger">*</span> 
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_to" required>
                                            <option value="">Select a value</option>
                                            @foreach ($users as $value)
                                                <option value="{{ $value->name }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                             
                       
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule Start Date">Due Date
                                        <span
                                        class="text-danger">*</span>
                                        </label>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_dateq" readonly
                                                placeholder="DD-MM-YYYY" />
                                            <input type="date" id="due_date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input"
                                                oninput="handleDateInput(this, 'due_dateq');checkDate('due_dateq')"  required/>
                                        </div>

                                    </div>
                                </div>
                          
                                <script>
                                    function handleDateInput(dateInput, displayId) {
                                        const date = new Date(dateInput.value);
                                        const options = { day: '2-digit', month: 'short', year: 'numeric' };
                                        document.getElementById(displayId).value = date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                    }

                                    // Call this function initially to ensure the correct format is shown on page load
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const dateInput = document.querySelector('input[name="due_date"]');
                                        handleDateInput(dateInput, 'due_date_display');
                                    });
                                    </script>

                                    <style>
                                    .hide-input {
                                        display: none;
                                    }
                                    </style>

                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="initiator-group">Initiator Department<span
                                            class="text-danger">*</span></label>
                                                <select name="initiator_Group" id="initiator_group"  required>
                                                        <option value="">--Select Initiation Department--</option>
                                                        <option value="CQA" >Corporate Quality Assurance</option>
                                                        <option value="QA" >Quality Assurance</option>
                                                        <option value="QC" >Quality Control</option>
                                                        <option value="QM" >Quality Control (Microbiology department)</option>
                                                        <option value="PG" >Production General</option>
                                                        <option value="PL" >Production Liquid Orals</option>
                                                        <option value="PT" >Production Tablet and Powder</option>
                                                        <option value="PE" >Production External (Ointment, Gels, Creams and Liquid)</option>
                                                        <option value="PC" >Production Capsules</option>
                                                        <option value="PI" >Production Injectable</option>
                                                        <option value="EN" >Engineering</option>
                                                        <option value="HR" >Human Resource</option>
                                                        <option value="ST" >Store</option>
                                                        <option value="IT" >Electronic Data Processing</option>
                                                        <option value="FD" >Formulation  Development</option>
                                                        <option value="AL" >Analytical research and Development Laboratory</option>
                                                        <option value="PD">Packaging Development</option>
                                                        <option value="PU">Purchase Department</option>
                                                        <option value="DC">Document Cell</option>
                                                        <option value="RA">Regulatory Affairs</option>
                                                        <option value="PV">Pharmacovigilance</option>
                                                    </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code"> Initiator Department Code</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code"
                                            value="" readonly >
                                    </div>
                                </div> --}}

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator Department</b></label>
                                        <input readonly type="text" name="initiator_Group" id="initiator_group"
                                            value="{{ Helpers::getUsersDepartmentName(Auth::user()->departmentid) }}">
                                    </div>
                                </div>

                                    <script>
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
                                    </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiation Department Code</label>
                                        <input type="text" name="initiator_group_code" id="initiator_group_code" placeholder="Initiator Group Code"
                                            value="" readonly>
                                    </div>
                                </div>

                             
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="short_description" maxlength="255"
                                            required>
                                    </div>
                                </div>
                                    <p id="docnameError" style="color:red">**Short Description is required</p>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group">Initiated Through</label>
                                        <div><small class="text-primary">Please select related information</small></div>
                                        <select name="initiated_through"
                                            onchange="otherController(this.value, 'others', 'initiated_through_req')">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="internal_audit">Internal Audit</option>
                                            <option value="external_audit">External Audit</option>
                                            <option value="recall">Recall</option>
                                            <option value="return">Return</option>
                                            <option value="deviation">Deviation</option>
                                            <option value="complaint">Complaint</option>
                                            <option value="regulatory_inspection">Regulatory Inspection</option>
                                            <option value="lab-incident">Lab Incident</option>
                                            <option value="improvement">Improvement</option>
                                            <option value="process_product">Process/Product</option>
                                            <option value="supplier">Supplier</option>
                                            <option value="gmp_invastigation">GMP Investigation</option>
                                            <option value="discreoancy_nc">Discrepancy/NC</option>
                                            <option value="change_control">Change Control</option>
                                            <option value="utility_quipment_system">Utility/Equipment/System</option>
                                            <option value="oos">OOS</option>
                                            <option value="product_failure">Product Failure</option>
                                            <option value="apqr">APQR</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="initiated_through_req">
                                        <label for="initiated_through">Others<span
                                                class="text-danger d-none">*</span></label>
                                        <textarea name="initiated_through_req"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="repeat">Repeat</label>
                                        <div><small class="text-primary">Please select yes if it is has recurred in past
                                                six months</small></div>
                                        <select name="repeat"
                                            onchange="otherController(this.value, 'Yes', 'repeat_nature')">
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
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Problem Description">Problem Description</label>
                                        <textarea name="problem_description"></textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="CAPA Team">CAPA Team</label>
                                        <select multiple id="select-state" placeholder="Select..." name="capa_team[]">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $value)

                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="CAPA Team">CAPA Team</label>
                                        <select multiple name="capa_team[]" placeholder="Select CAPA Team"
                                            data-search="false" data-silent-initial-value-set="true" id="Audit">
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="CAPA Related Records">CAPA Related Records</label>
                                        <div class="related-record-block">
                                            <select  multiple id="capa_related_record" name="capa_related_record[]" id="">

                                                @foreach ($old_record as $new)
                                                    <option value="{{ $new->id }}"  >
                                                        {{ Helpers::getDivisionName($new->division_id) }}/CAPA/{{date('Y')}}/{{ Helpers::recordFormat($new->record) }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div> --}}



                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Reference Records">Reference Records</label>
                                        <select multiple id="capa_related_record" name="capa_related_record[]"
                                            id="">

                                            @foreach ($old_records as $new)
                                                <option value="{{ Helpers::getDivisionName($new->division_id) . '/AI/' . date('Y') . '/' . Helpers::recordFormat($new->record) }}">
                                                    {{ Helpers::getDivisionName($new->division_id) }}/CAPA/{{ date('Y') }}/{{ Helpers::recordFormat($new->record) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <div class="related-record-block">
                                            <input type="text" name="capa_related_record">
                                            <div data-bs-toggle="modal" data-bs-target="#related-records-modal">
                                                Add
                                            </div>
                                        </div> -
                                    </div>
                                </div> --}}

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Reference Records</b></label>
                                        @if (!empty($reference_record))
                                        <input readonly type="text" name="parent_record_number"
                                            value="{{ $reference_record }}">
                                        @else
                                        <input type="text" name="parent_record_number_edit"
                                        value="">
                                        @endif
                                    </div>
                                </div>

                                {{-- <div class="col-6">
                                    <div class="group-input">
                                        <label for="related_records">Reference Records</label>
                                        <select multiple name="capa_related_record[]" placeholder="Select Reference Records"
                                            data-silent-initial-value-set="true" id="capa_related_record" class="form-control">

                                            @foreach ($relatedRecords as $records)
                                                <option
                                                    value="{{ Helpers::getDivisionName(
                                                        $records->division_id || $records->division || $records->division_code || $records->site_location_code,
                                                    ) .
                                                        '/' .
                                                        $records->process_name .
                                                        '/' .
                                                        date('Y') .
                                                        '/' .
                                                        Helpers::recordFormat($records->record) }}">
                                                    {{ Helpers::getDivisionName(
                                                        $records->division_id || $records->division || $records->division_code || $records->site_location_code,
                                                    ) .
                                                        '/' .
                                                        $records->process_name .
                                                        '/' .
                                                        date('Y') .
                                                        '/' .
                                                        Helpers::recordFormat($records->record) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('capa_related_record')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Initial Observation">Initial Observation</label>
                                        <textarea name="initial_observation"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Interim Containnment">Interim Containment</label>
                                        <select name="interim_containnment"
                                            onchange="otherController(this.value, 'required', 'containment_comments')">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="required">Required</option>
                                            <option value="not-required">Not Required</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="containment_comments">
                                        <label for="Containment Comments">
                                            Containment Comments <span class="text-danger d-none">*</span>
                                        </label>
                                        <textarea name="containment_comments" id="capa_attachment"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="CAPA Attachments">CAPA Attachments </label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>

                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="closure_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="hodfile" name="capa_attachment[]"
                                                    oninput="addMultipleFiles(this, 'closure_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 sub-head">
                                    Other Type Details
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Details">Investigation Summary </label>
                                        {{-- <input type="text" name="investigation"> --}}
                                    <textarea name="investigation" ></textarea>
                                    </div>
                                    <div class="group-input">
                                        <label for="Details">Root Cause</label>
                                        {{-- <input type="text" name="rcadetails"> --}}
                                    <textarea name="rcadetails" ></textarea>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Material Details">
                                            Product / Material Details
                                            <button type="button" name="ann" id="material">+</button>
                                        </label>
                                        <table class="table table-bordered" id="productmaterial">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Product / Material Name</th>
                                                    <th>Product /Material Batch No./Lot No./AR No.</th>
                                                    <th>Product / Material Manufacturing Date</th>
                                                    <th>Product / Material Date of Expiry</th>
                                                    <th>Product Batch Disposition Decision</th>
                                                    <th>Product Remark</th>
                                                    <th>Product Batch Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input disabled type="text" name="serial_number[]"
                                                            value="1"></td>
                                                    <td><input type="text" name="material_name[]"></td>
                                                    <td><input type="text" name="material_batch_no[]"></td>
                                                    <td><input type="text" name="material_mfg_date[]"
                                                            class="material_mfg_date" placeholder="DD-MMM-YYYY" /></td>
                                                    <td><input type="text" name="material_expiry_date[]"
                                                            class="material_expiry_date" placeholder="DD-MMM-YYYY" /></td>
                                                    <td><input type="text" name="material_batch_desposition[]"></td>
                                                    <td><input type="text" name="material_remark[]"></td>
                                                    <td>
                                                        <select name="material_batch_status[]" class="batch_status">
                                                            <option value="">-- Select value --</option>
                                                            <option value="Hold">Hold</option>
                                                            <option value="Release">Release</option>
                                                            <option value="Quarantine">Quarantine</option>
                                                        </select>
                                                    </td>
                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

<script>
                                    $(document).ready(function() {
                                        // Function to create a new row
                                        function createNewRow(serialNumber) {
                                            return $('<tr>' +
                                                '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                                                '"></td>' +
                                                '<td><input type="text" name="material_name[]"></td>' +
                                                '<td><input type="text" name="material_batch_no[]"></td>' +
                                                '<td><input type="text" name="material_mfg_date[]" class="material_mfg_date" placeholder="DD-MMM-YYYY" /></td>' +
                                                '<td><input type="text" name="material_expiry_date[]" class="material_expiry_date" placeholder="DD-MMM-YYYY" /></td>' +
                                                '<td><input type="text" name="material_batch_desposition[]"></td>' +
                                                '<td><input type="text" name="material_remark[]"></td>' +
                                                '<td>' +
                                                '<select name="material_batch_status[]" class="batch_status">' +
                                                '<option value="">-- Select value --</option>' +
                                                '<option value="Hold">Hold</option>' +
                                                '<option value="Release">Release</option>' +
                                                '<option value="Quarantine">Quarantine</option>' +
                                                '</select>' +
                                                '</td>' +
                                                '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                '</tr>');
                                        }

                                        // Initialize datepicker on input fields
                                        function initializeDatepicker() {
    $('.material_mfg_date, .material_expiry_date').datepicker({
        dateFormat: 'dd-M-yy', // Desired format like '10 Oct 2024'
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        onClose: function(dateText, inst) {
            if (dateText) {
                // Format the date correctly when closed
                const dateObj = $(this).datepicker('getDate');
                $(this).val($.datepicker.formatDate('dd-M-yy', dateObj));
            } else {
                $(this).val(''); // Clear the input if no date is selected
                $(this).attr('placeholder', 'DD-MMM-YYYY'); // Reset the placeholder
            }
        },
        beforeShow: function() {
            $(this).attr('readonly', 'readonly'); // Prevent text input while opening the datepicker
        }
    });

    // Prevent manual text entry
    $('.material_mfg_date, .material_expiry_date').on('keypress', function(e) {
        e.preventDefault(); // Disable text input
    });

    // Optional: To clear the field when clicking outside
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.material_mfg_date, .material_expiry_date').length) {
            $(this).val(''); // Clear input if not clicked
        }
    });
}

// Call the function to initialize the datepicker
$(document).ready(function() {
    initializeDatepicker();
});

                                        // Add a new row
                                        $('#material').click(function(e) {
                                            e.preventDefault();

                                            // Count existing rows
                                            var rowCount = $('#productmaterial tbody tr').length;
                                            var newRow = createNewRow(rowCount + 1); // Create new row with next serial number

                                            // Append the new row to the table
                                            $('#productmaterial tbody').append(newRow);

                                            // Initialize datepicker for new row
                                            initializeDatepicker();
                                        });

                                        // Remove row event
                                        $(document).on('click', '.removeRowBtn', function() {
                                            $(this).closest('tr').remove();

                                            // If rows are left, update the serial numbers
                                            $('#productmaterial tbody tr').each(function(index) {
                                                $(this).find('input[name="serial_number[]"]').val(index + 1);
                                            });
                                        });

                                        // Date validation: Ensure expiry date is greater than manufacturing date
                                        $(document).on('change', '.material_mfg_date, .material_expiry_date', function() {
                                            var row = $(this).closest('tr');
                                            var mfgDateVal = row.find('.material_mfg_date').val();
                                            var expiryDateVal = row.find('.material_expiry_date').val();

                                            if (mfgDateVal && expiryDateVal) {
                                                var mfgDate = new Date(mfgDateVal);
                                                var expiryDate = new Date(expiryDateVal);

                                                if (expiryDate <= mfgDate) {
                                                    alert('Expiry date must be greater than the manufacturing date.');

                                                    // Clear invalid expiry date and set placeholder
                                                    row.find('.material_expiry_date').val('').attr('placeholder', 'DD-MMM-YYYY');
                                                }
                                            }
                                        });

                                        // Initialize datepicker for existing fields on page load
                                        initializeDatepicker();
                                    });
                                </script>







                                <div class="col-12 sub-head">
                                    Equipment/Instruments Details
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Material Details">
                                            Equipment/Instruments Details<button type="button" name="ann"
                                                id="addequipment">+</button>
                                        </label>
                                        <table class="table table-bordered" id="equipment_de">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Equipment/Instruments Name</th>
                                                    <th>Equipment/Instrument ID</th>
                                                    <th>Equipment/Instruments Comments</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>



                                         <tbody>
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="equipment[]"></td>
                                                <td><input type="text" name="equipment_instruments[]"></td>
                                                <td><input type="text" name="equipment_comments[]"></td>
                                                <td><button type="button" class="removeRowBtn">Remove</button></td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('addequipment').addEventListener('click', function() {
                                        const tableBody = document.querySelector('#equipment_de tbody');
                                        const newRow = document.createElement('tr');

                                        const rowCount = tableBody.rows.length + 1;

                                        newRow.innerHTML = `
                                            <td><input disabled type="text" name="serial_number[]" value="${rowCount}"></td>
                                            <td><input type="text" name="equipment[]"></td>
                                            <td><input type="text" name="equipment_instruments[]"></td>
                                            <td><input type="text" name="equipment_comments[]"></td>
                                            <td><button type="button" class="removeRowBtn">Remove</button></td>
                                        `;

                                        tableBody.appendChild(newRow);

                                        updateRemoveRowListeners();
                                    });

                                    function updateRemoveRowListeners() {
                                        document.querySelectorAll('.removeRowBtn').forEach(button => {
                                            button.addEventListener('click', function() {
                                                this.closest('tr').remove();
                                                updateRowNumbers();
                                            });
                                        });
                                    }

                                    function updateRowNumbers() {
                                        document.querySelectorAll('#equipment_de tbody tr').forEach((row, index) => {
                                            row.querySelector('input[name="serial_number[]"]').value = index + 1;
                                        });
                                    }

                                    // Initial call to set up the listeners for the existing row
                                    updateRemoveRowListeners();
                                </script>
                                <div class="col-12 sub-head">
                                    Other Type CAPA Details
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Details">Details</label>
                                        {{-- <input type="text" name="details_new"> --}}
                                        <textarea name="details_new" ></textarea>
                                    </div>
                                </div>

                                </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="on-submit-disable-button">Save</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>
                                <!-- CAPA Details content ****************************-->
                <div id="CCForm4" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="group-input">
                                                    <label for="search">
                                                        CAPA Type<span class="text-danger"></span>
                                                    </label>
                                                    <select id="capa_type" placeholder="Select..." name="capa_type">
                                                        <option value="">Select a value</option>
                                                        <option value="Corrective Action">Corrective Action</option>
                                                        <option value="Preventive Action">Preventive Action</option>
                                                        <option value="Corrective & Preventive Action">Corrective & Preventive Action
                                                        </option>
                                                    </select>
                                                    @error('assign_to')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 corrective-action-field" style="display: none;">
                                                <div class="group-input">
                                                    <label for="Corrective Action">Corrective Action</label>
                                                    <textarea name="corrective_action"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 preventive-action-field" style="display: none;">
                                                <div class="group-input">
                                                    <label for="Preventive Action">Preventive Action</label>
                                                    <textarea name="preventive_action"></textarea>
                                                </div>
                                            </div>

                                                <script>
                                                    document.addEventListener("DOMContentLoaded", function () {
                                                        let capaTypeSelect = document.getElementById("capa_type");
                                                        let correctiveActionField = document.querySelector(".corrective-action-field");
                                                        let preventiveActionField = document.querySelector(".preventive-action-field");

                                                        capaTypeSelect.addEventListener("change", function () {
                                                            let selectedValue = this.value;

                                                            if (selectedValue === "Corrective Action") {
                                                                correctiveActionField.style.display = "block";
                                                                preventiveActionField.style.display = "none";
                                                            } else if (selectedValue === "Preventive Action") {
                                                                correctiveActionField.style.display = "none";
                                                                preventiveActionField.style.display = "block";
                                                            } else if (selectedValue === "Corrective & Preventive Action") {
                                                                correctiveActionField.style.display = "block";
                                                                preventiveActionField.style.display = "block";
                                                            } else {
                                                                correctiveActionField.style.display = "none";
                                                                preventiveActionField.style.display = "none";
                                                            }
                                                        });
                                                    });
                                                </script>


                                            {{-- <div class="col-12">
                                                <div class="group-input">
                                                    <label for="Supervisor Review Comments">QA Review Comments</label>
                                                    <textarea name="supervisor_review_comments"></textarea>
                                                </div>
                                            </div> --}}

                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="Closure Attachments">File Attachment</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                                                    <div class="file-attachment-field">
                                                        <div class="file-attachment-list" id="capafileattachement"></div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input type="file" id="qafile" name="capafileattachement[]"
                                                                oninput="addMultipleFiles(this, 'capafileattachement')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="on-submit-disable-button">Save</button>
                                             <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                                </a> </button>
                                        </div>
                                    </div>
                                </div>
{{-- ===========================================HOd reviwe tab ============= tab --}}

<div id="CCForm11" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-12">
                <div class="group-input">
                    <label for="QA Head Review & Closure">HOD Remark</label>
                    <textarea name="hod_remarks"></textarea>
                </div>
            </div>
            <!-- <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">HOD Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>

                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="hod_attachment"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="hoddfile" name="hod_attachment[]"
                                oninput="addMultipleFiles(this, 'hod_attachment')" >
                        </div>
                    </div>
                </div>
            </div>     -->
            <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">HOD Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>
                    {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="hod_attachment"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="hod_attachment[]"
                                oninput="addMultipleFiles(this, 'hod_attachment')" multiple>
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
            <button type="submit" class="on-submit-disable-button">Save</button>
             <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
        </div>
    </div>
</div>



{{-- ==========================QA review tab ================ --}}

<div id="CCForm12" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-12">
                <div class="group-input">
                    <label for="Comments">  QA/CQA Review Comment
                    </label>
                    <textarea name="capa_qa_comments"></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">QA/CQA Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>
                    {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="qa_attachment"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="qa_attachment[]"
                                oninput="addMultipleFiles(this, 'qa_attachment')" multiple>
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
            <button type="submit" class="on-submit-disable-button">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
        </div>
    </div>
</div>
                    <!-- CAPA Closure content -->
                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Interim Containnment">Effectiveness check required</label>
                                        <select name="effectivness_check">
                                            <option value="">-----Select---</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Review & Closure">QA/CQA Head Closure Review Comment</label>
                                        <textarea name="qa_review"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Closure Attachments">QA/CQA Head Closure Review Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="closurer_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myFile" name="closure_attachment[]"
                                                    oninput="addMultipleFiles(this, 'closurer_attachment')" multiple>
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
                                {{-- <div class="col-12 sub-head">
                                    Extension Justification
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="due_date_extension">Due Date Extension Justification</label>
                                        <div><small class="text-primary">Please Mention justification if due date is
                                                crossed</small></div>
                                        <textarea name="due_date_extension"></textarea>
                                    </div>
                                </div>
                            </div>--}}
                            </div>
                            <div class="button-block">
                                <button type="submit" class="on-submit-disable-button">Save</button>
                               <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div>
                    {{-- ==========================hod final review ================ --}}

<div id="CCForm13" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-12">
                <div class="group-input">
                    <label for="Comments"> Hod Final Review Comments</label>
                    <textarea name="hod_final_review"></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">Hod Final Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>
                    {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="hod_final_attachment"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfilea" name="hod_final_attachment[]"
                                oninput="addMultipleFiles(this, 'hod_final_attachment')" multiple>
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
            <button type="submit" class="on-submit-disable-button">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
        </div>
    </div>
</div>
{{-- ==========================QA/CQA Final Review tab ================ --}}
<div id="CCForm19" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-12">
                <div class="group-input">
                    <label for="Comments"> Initiator CAPA Update Comment</label>
                    <textarea name="initiator_comment"></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">Initiator CAPA Update Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>
                    {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="initiator_capa_attachment"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfilea" name="initiator_capa_attachment[]"
                                oninput="addMultipleFiles(this, 'initiator_capa_attachment')" multiple>
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
            <button type="submit" class="on-submit-disable-button">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
        </div>
    </div>
</div>
<div id="CCForm14" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-12">
                <div class="group-input">
                    <label for="Comments">QA/CQA Closure Review Comment</label>
                    <textarea name="qa_cqa_qa_comments"></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">QA/CQA Closure Review Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>
                    {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="qa_closure_attachment"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfileb" name="qa_closure_attachment[]"
                                oninput="addMultipleFiles(this, 'qa_closure_attachment')" multiple>
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
            <button type="submit" class="on-submit-disable-button">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
        </div>
    </div>
</div>
{{-- ==========================QAH/CQAH ================ --}}

<div id="CCForm15" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-15">
                <div class="group-input">
                    <label for="Comments"> QA/CQA Approval Comment</label>
                    <textarea name="qah_cq_comments"></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Closure Attachments">QA/CQA Approval Attachment</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting
                            documents</small></div>
                    {{-- <input multiple type="file" id="myfile" name="closure_attachment[]"> --}}
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="qah_cq_attachment"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfilec" name="qah_cq_attachment[]"
                                oninput="addMultipleFiles(this, 'qah_cq_attachment')" multiple>
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
            <button type="submit" class="on-submit-disable-button">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
        </div>
    </div>
</div>






                <!-- Project Study content****************************** -->







                <!-- Activity Log content -->
                <div id="CCForm8" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Proposed By">Propose Plan By</label>
                                    <input type="hidden" name="">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Proposed On">Propose Plan On</label>
                                    <input type="hidden" name="plan_proposed_on">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Proposed By"> Propose Plan Comment</label>
                                    <input type="hidden" name="">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Cancelled By">Cancel By</label>
                                    <input type="hidden" name="cancelled_by">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Cancelled On">Cancel On</label>
                                    <input type="hidden" name="cancelled_on">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Proposed By">Cancel Comment</label>
                                    <input type="hidden" name="">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Approved By">HOD Review Complete By</label>
                                    <input type="hidden" name="hod_review_completed_by">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="HOD Review Completed On">HOD Review Complete On</label>
                                    <input type="hidden" name="hod_review_completed_on">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Proposed By">HOD Review Complete Comment</label>
                                    <input type="hidden" name="">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required By"> More Info Required By</label>
                                    <input type="hidden" name="more_info_required_by">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required On"> More Info Required On</label>
                                    <input type="hidden" name="more_info_required_on">
                                    <div class="static"></div>
                                </div>
                            </div> --}}

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Completed By">QA/CQA Review Complete By</label>
                                    <input type="hidden" name="qa_review_completed_by">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Completed On"> QA/CQA Review Complete On</label>
                                    <input type="hidden" name="qa_review_completed_on">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Proposed By">QA/CQA Review Complete Comment</label>
                                    <input type="hidden" name="">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required By"> More Info Required By</label>
                                    <input type="hidden" name="qa_more_info_required_by">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required On"> More Info Required On</label>
                                    <input type="hidden" name="qa_more_info_required_on">
                                    <div class="static"></div>
                                </div>
                            </div> --}}
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Approved By">Approved By</label>
                                    <input type="hidden" name="approved_by">

                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Approved On"> Approved On</label>
                                    <input type="hidden" name="approved_on">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Proposed By">Approved Comment</label>
                                    <input type="hidden" name="">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required By"> More Info Required By</label>
                                    <input type="hidden" name="app_more_info_required_by">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required On"> More Info Required On</label>
                                    <input type="hidden" name="app_more_info_required_on">
                                    <div class="static"></div>
                                </div>
                            </div> --}}
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected By">Complete By</label>
                                    <input type="hidden" name="completed_by">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="completed On">Complete On</label>
                                    <input type="hidden" name="completed_on">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Proposed By">Complete Comment</label>
                                    <input type="hidden" name="">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required By"> More Info Required By</label>
                                    <input type="hidden" name="com_more_info_required_by">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required On"> More Info Required On</label>
                                    <input type="hidden" name="com_more_info_required_on">
                                    <div class="static"></div>
                                </div>
                            </div>~ --}}
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected By">HOD Final Review Complete By</label>
                                    <input type="hidden" name="hod_final_review_completed_by">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">HOD Final Review Complete On</label>
                                    <input type="hidden" name="hod_final_review_completed_on">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Proposed By">HOD Final Review Complete Comment</label>
                                    <input type="hidden" name="">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required By"> More Info Required By</label>
                                    <input type="hidden" name="hod_more_info_required_by">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required On"> More Info Required On</label>
                                    <input type="hidden" name="hod_more_info_required_on">
                                    <div class="static"></div>
                                </div>
                            </div> --}}
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required By"> QA/CQA Closure Review Complete By</label>
                                    <input type="hidden" name="">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA/CQA QA/CQA Closure Review Completed On"> QA/CQA Closure Review Complete On</label>
                                    <input type="hidden" name="qa_closure_review_completed_on">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Proposed By">QA/CQA Closure Review Complete Comment</label>
                                    <input type="hidden" name="">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required By"> More Info Required By</label>
                                    <input type="hidden" name="closure_more_info_required_by">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required On"> More Info Required On</label>
                                    <input type="hidden" name="closure_qa_more_info_required_on">
                                    <div class="static"></div>
                                </div>
                            </div> --}}
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required By">
                                        QAH/CQA Head Approval Complete By
                                    </label>
                                    <input type="hidden" name="qah_approval_completed_by">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA QA/CQA Approval Completed On">QAH/CQA Head Approval Complete On</label>
                                    <input type="hidden" name="qah_approval_completed_on">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Plan Proposed By">  QAH/CQA Head Approval Complete Comment</label>
                                    <input type="hidden" name="">
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required By"> More Info Required By</label>
                                    <input type="hidden" name="qah_more_info_required_by">
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="QA More Info Required On"> More Info Required On</label>
                                    <input type="hidden" name="qah_more_info_required_on">
                                    <div class="static"></div>
                                </div>
                            </div>

                        </div> --}}
                        <div class="button-block">
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"
                                    href="#"> Exit </a> </button>
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
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee , #capa_related_record,#cft_reviewer'
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

        function setCurrentDate(item){
            if(item == 'yes'){
                $('#effect_check_date').val('{{ date('d-M-Y')}}');
            }
            else{
                $('#effect_check_date').val('');
            }
        }
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


    {{-- =======================================================record number ============================================ --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
        var originalRecordNumber = document.getElementById('record').value;
        var initialPlaceholder = '---';

            document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            var recordNumberElement = document.getElementById('record');
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

    </script> --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var originalRecordNumber = document.getElementById('record').value;
            var initialPlaceholder = '---';

            document.getElementById('initiator_group').addEventListener('change', function() {
                var selectedValue = this.value;
                var recordNumberElement = document.getElementById('record');
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
    </script> --}}

@endsection
