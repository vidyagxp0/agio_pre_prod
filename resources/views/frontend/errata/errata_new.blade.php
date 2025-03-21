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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .hidden {
            display: none;
        }

        #txt-custom {
            display: none;
        }
    </style>
    <script>
    $(document).ready(function() {
        $('.formSubmit').on('submit', function(e) {
            $('.on-submit-disable-button').prop('disabled', true);
        });
    });
</script>

    <div class="form-field-head">
        {{-- <div class="pr-id">
            New Child
        </div> --}}
        <div class="division-bar">
            <strong>Site Division/Project</strong> : {{ Helpers::getDivisionName(session()->get('division')) }}/ERRATA
        </div>
    </div>



    {{-- ! ========================================= --}}
    {{-- !               DATA FIELDS                 --}}
    {{-- ! ========================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm2')">HOD Initial Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA/CQA Initial Review</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">CFT</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QA/CQA Head Designee Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Initiator Update</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">HOD final Review</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm8')">QA Review</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">QA/CQA Head Designee Closure
                    Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">Activity Log</button>
            </div>

            <form class="formSubmit" action="{{ route('errata.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="step-form">
                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif
                    <!-- -----------Tab-1------------ -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                {{-- <div class="sub-head">Parent Record Information</div> --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Record Number">Record Number</label>
                                        <input disabled type="text" name="record"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/ERRATA/{{ date('Y') }}/{{ $record_number }}">
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
                                        <label for="Initiator">Initiator</label>
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" name="initiator_by" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due">Date of Initiation</label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Department</b></label>
                                        <input readonly type="text" name="Initiator_Group" id="initiator_group"
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
                                                    <label for="Initiator Group Code"> Department Code</label>
                                                    <input type="text" name="department_code" id="initiator_group_code" placeholder="Department Code"
                                                        value="" readonly>
                                                </div>
                                            </div>



                                {{-- <div class="col-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Document Type<span class="text-danger"></span>
                                        </label>
                                        <input type="text" id="select-state" placeholder="Select..."
                                            name="document_type">
                                    </div>
                                </div> --}}

                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="doc-type">Document Type<span class="text-danger">*</span></label>
                                        <select name="document_type" id="select-state" required onchange="handleDocumentSelection(this)">
                                            <option value="" selected>Enter your Selection</option>
                                            @foreach (Helpers::getDocumentTypes() as $code => $type)
                                                <option value="{{ $code }}">
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                            <option value="others">Others</option> <!-- 'others' value updated -->
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6" id="others-input" style="display: none;"> <!-- hidden by default -->
                                    <div class="group-input">
                                        <label for="others">
                                            Others<span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="document_type_others" placeholder="Please specify">
                                    </div>
                                </div>
<script>

    function handleDocumentSelection(select) {
    const othersInput = document.getElementById('others-input');
    if (select.value === 'others') {
        othersInput.style.display = 'block';
    } else {
        othersInput.style.display = 'none';
    }
}

    </script>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">Document Type<span class="text-danger">*</span></label>
                                        <select name="document_type_id" id="doc-type" required onchange="handleDocumentSelection(this)">
                                            <option value="" selected>Enter your Selection</option>
                                            @foreach (Helpers::getDocumentTypes() as $code => $type)
                                                <option value="{{ $code }}">
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p id="doc-typeError" style="color:red">** Department is required</p>
                                </div> --}}


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="short_description" maxlength="255"
                                            required>
                                    </div>
                                </div>
                                @php

                                    $old_record = DB::table('erratas')->get();
                                    // $reference_documents = is_array($showdata->reference_document)
                                    //     ? $showdata->reference_document
                                    //     : explode(',', $showdata->reference_document);
                                @endphp

                                    {{-- <div class="">
                                    <div class="group-input">
                                        <label for="Reference Recores">Refrence Documents </label>

                                        @foreach ($old_record as $new)
                                            <option value="{{ $new->id }}">
                                                {{ Helpers::getDivisionName($new->division_id) }}/ERRATA/{{ date('Y') }}/{{ str_pad($new->id, 4, '0', STR_PAD_LEFT) }}

                                            </option>
                                        @endforeach

                                        </select> -->
                                        <input type="text" name="reference" id="docname" maxlength="255">
                                    </div>
                                </div> --}}

                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="reference">Parent Record Number</label>
                                        <select multiple name="reference[]" placeholder="Select Parent Record Number"
                                            data-silent-initial-value-set="true" id="reference">

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
                                        @error('reference')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div> -->

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Observation on Page No.">Parent Record Number
                                           </label>
                                        <input  type="text" name="reference" maxlength="255">

                                    </div>
                                </div>



                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Observation on Page No.">Error Observed on Page
                                            No.</label>
                                        <textarea class="summernote" name="Observation_on_Page_No" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Brief Description of error </label>
                                        <textarea class="summernote" name="brief_description" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Document title">Document title</label>
                                        <input type="text" name="document_title" maxlength="255">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Type Of Error<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="type_of_error">
                                            <option value="">-- Select a value --</option>
                                            <option value="Typographical Error (TE)">Typographical Error (TE)</option>
                                            <option value="Calculation Error (CE)">Calculation Error (CE)</option>
                                            <option value="Grammatical Error (GE)">Grammatical Error (GE)</option>
                                            <option value="Missing Word Error (ME)">Missing Word Error (ME)</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="typeOfErrorBlock" class="group-input col-6" style="display: none;">
                                    <label for="otherFieldsUser">Other</label>
                                    <input type="text" name="otherFieldsUser" class="form-control" />
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Correction Of Error">Correction Of Error required</label>
                                        <textarea class="summernote" name="Correction_Of_Error" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                                <script>
                                    $(document).ready(function() {
                                        // Initially hide the field
                                        $('#typeOfErrorBlock').hide();

                                        $('select[name=type_of_error]').change(function() {
                                            const selectedVal = $(this).val();
                                            if (selectedVal === 'Other') {
                                                $('#typeOfErrorBlock').show();
                                            } else {
                                                $('#typeOfErrorBlock').hide();
                                            }
                                        });

                                        // Optionally, check the current value when the page loads in case of form errors
                                        if ($('select[name=type_of_error]').val() === 'Other') {
                                            $('#typeOfErrorBlock').show();
                                        }
                                    });
                                </script>




                                @php
                                    $users = DB::table('users')->get();
                                @endphp
                                <!-- <div class="col-md-6">
                                                                                                                                                                                                                                                                                        <div class="group-input">
                                                                                                                                                                                                                                                                                            <label for="select-state">
                                                                                                                                                                                                                                                                                                Department Head  <span class="text-danger"></span>
                                                                                                                                                                                                                                                                                            </label>
                                                                                                                                                                                                                                                                                            <select id="select-state" placeholder="Select..." name="department_head_to">
                                                                                                                                                                                                                                                                                                <option value="">Select a value</option>
                                                                                                                                                                                                                                                                                                @foreach ($users as $data)
    <option value="{{ $data->id }}">{{ $data->name }}</option>
    @endforeach
                                                                                                                                                                                                                                                                                            </select>
                                                                                                                                                                                                                                                                                            @error('department_head_to')
        <p class="text-danger">{{ $message }}</p>
    @enderror
                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                    </div> -->
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Department Head <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="department_head_to">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_head_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            QA reviewer <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="qa_reviewer">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('qa_reviewer')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>



                                <div class="group-input">
                                    <!-- <label for="audit-agenda-grid">
                                        Details
                                        <button type="button" name="details" id="Details-add">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            Launch Deviation
                                        </span>
                                    </label> -->
                                    <label for="action-plan-grid">
                                        Details<button type="button" name="action-plan-grid"
                                                id="Details_add">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            Launch Deviation
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Details-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2%">Sr. No.</th>
                                                    <th style="width: 12%">List Of Impacting Document (If Any)</th>
                                                    <!-- <th style="width: 16%"> Prepared By</th>
                                                    <th style="width: 15%">Checked By</th>
                                                    <th style="width: 15%">Approved By</th> -->
                                                    <th style="width: 3%">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- <td><input disabled type="text" name="details[0][serial]"
                                                        value="1"></td>
                                                <td><input type="text" name="details[0][ListOfImpactingDocument]"></td> -->
                                                <td><input disabled type="text" name="serial_number[]" value="1">
                                                </td>
                                                <td><input type="text" name="ListOfImpactingDocument[]"></td>
                                                <!-- <td><input type="text" name="details[0][PreparedBy]"></td>
                                                <td><input type="text" name="details[0][CheckedBy]"></td>
                                                <td><input type="text" name="details[0][ApprovedBy]"></td> -->
                                                <td><button type="text" class="removeRowBtn">Remove</button></td>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                                <!-- <div class="new-date-data-field">
                                                                                                                                                                                                                                                                                                                        <div class="group-input input-date">
                                                                                                                                                                                                                                                                                                                            <label for="Errata_date">Date And Time of Correction</label>
                                                                                                                                                                                                                                                                                                                            <div class="calenderauditee">
                                                                                                                                                                                                                                                                                                                                <input type="text" id="displayErrataDate"
                                                                                                                                                                                                                                                                                                                                    name="Date_and_time_of_correction" readonly
                                                                                                                                                                                                                                                                                                                                    placeholder="DD-MM-YYYY HH:MM" />
                                                                                                                                                                                                                                                                                                                                <input type="datetime-local" id="Errata_date"
                                                                                                                                                                                                                                                                                                                                    name="Date_and_time_of_correction" onchange="updateDisplayDateTime(this)"
                                                                                                                                                                                                                                                                                                                                    class="hide-input" />
                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                        @error('Errata_date')
        <div class="text-danger">{{ $message }}</div>
    @enderror
                                                                                                                                                                                                                                                                                                                    </div> -->

                                <script>
                                    function updateDisplayDateTime(input) {
                                        const selectedDateTime = new Date(input.value);
                                        const formattedDateTime = formatDate(selectedDateTime);
                                        document.getElementById('displayErrataDate').value = formattedDateTime;
                                    }

                                    function formatDate(date) {
                                        const day = String(date.getDate()).padStart(2, '0');
                                        const monthIndex = date.getMonth();
                                        const monthNames = ["Jan", "Feb", "March", "April", "May", "June",
                                            "July", "Aug", "Sep", "Oct", "Nov", "Dec"
                                        ];
                                        const month = monthNames[monthIndex];
                                        const year = date.getFullYear();
                                        let hours = date.getHours();
                                        let minutes = date.getMinutes();

                                        hours = String(hours).padStart(2, '0');
                                        minutes = String(minutes).padStart(2, '0');

                                        const formattedDateTime = `${day}-${month}-${year} ${hours}:${minutes}`;

                                        return formattedDateTime;
                                    }
                                </script>

                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms /qms-dashboard') }}">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>
                    <!-- -----------Tab-2------------ -->
                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="HOD Initial Comment">HOD Initial Comment</label>
                                        <textarea class="summernote" name="HOD_Remarks" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="HOD Initial Attachments">HOD Initial Attachments</label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="HOD_Attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="HOD_Attachments" name="HOD_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'HOD_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="button-block">
                                    <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>


                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- -----------Tab-3------------ -->
                    {{-- <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">Production</div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Production Review Required </label>
                                        <select name="production_review_required">
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Production Person </label>
                                        <select name="">
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By
                                            Production)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Production Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Production Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Production Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Production Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head">Warehouse</div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Warehouse Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Warehouse Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By
                                            Warehouse)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Warehouse Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Warehouse Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Warehouse Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Warehouse Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head">Quality Control</div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Quality Control Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Quality Control Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Quality
                                            Control)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Quality Control Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Quality Control Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Quality Control Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Quality Control Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head">Engineering </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Engineering Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Engineering Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By
                                            Engineering)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Engineering Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Engineering Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Engineering Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Engineering Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head">Analytical Development Laboratry </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Analytical Development Laboratry Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Analytical Development Laboratry Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Analytical
                                            Development Laboratry)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Analytical Development Laboratry
                                            Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Analytical Development Laboratry Attachments
                                        </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Analytical Development Laboratry Review Completed
                                            By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Analytical Development Laboratry Review Completed
                                            On</label>
                                        <input type="date" />
                                    </div>
                                </div>



                                <div class="sub-head">Process Development Laboratry </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Process Development Laboratry Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Process Development Laboratry Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Process
                                            Development Laboratry)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Process Development Laboratry
                                            Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Process Development Laboratry Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Process Development Laboratory / Kilo Lab Review Completed
                                            By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Process Development Laboratory / Kilo Lab Review Completed
                                            On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head">Technology Transfer Design </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Technology Transfer Design Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Technology Transfer Design Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Technology
                                            Transfer Design)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Technology Transfer Design
                                            Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Technology Transfer Design Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Technology Transfer / Design Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Technology Transfer / Design Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>




                                <div class="sub-head">Environment Health & Safety </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Environment Health & Safety Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Environment Health & Safety Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Environment
                                            Health & Safety)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Environment Health & Safety
                                            Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Environment Health & Safety Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Environment, Health & Safety Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Environment, Health & Safety Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head"> Human Resource & Administration </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by"> Human Resource & Administration Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by"> Human Resource & Administration Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Human Resource &
                                            Administration)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Human Resource & Administration
                                            Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment"> Human Resource & Administration Attachments
                                        </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Human Resource & Administration Review Completed
                                            By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Human Resource & Administration Review Completed
                                            On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head">Information Technology </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Information Technology Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Information Technology Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Information
                                            Technology)</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Information Technology Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Information Technology Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Information Technology Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Information Technology Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>


                                <div class="sub-head">Project Management </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Project Management Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Project Management Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Project
                                            Management )</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Project Management Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Project Management Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Other's 1 Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Other's 1 Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>

                                <div class="sub-head">Other's 1 (Additional Person Review From Departments If Required)
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 1 Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 1 Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 1 Department </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Manufacturing</option>
                                            <option>Production</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 1
                                            )</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Other's 1 Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Other's 1 Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Project Management Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Project Management Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>

                                <div class="sub-head">Other's 2 (Additional Person Review From Departments If Required)
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 2 Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 2 Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 2 Department </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Manufacturing</option>
                                            <option>Production</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 2
                                            )</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Other's 2 Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Other's 2 Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Other's 3 Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Other's 2 Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>

                                <div class="sub-head">Other's 3 (Additional Person Review From Departments If Required)
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 3 Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 3 Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 3 Department </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Manufacturing</option>
                                            <option>Production</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 3
                                            )</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Other's 3 Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Other's 3 Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Other's 3 Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Other's 3 Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>

                                <div class="sub-head">Other's 4 (Additional Person Review From Departments If Required)
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 4 Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 4 Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 4 Department </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Manufacturing</option>
                                            <option>Production</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 4
                                            )</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Other's 4 Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Other's 4 Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Other's 4 Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Other's 4 Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>

                                <div class="sub-head">Other's 5 (Additional Person Review From Departments If Required)
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 5 Review Required </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 5 Person </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Pankaj</option>
                                            <option>Manish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="submitted by">Other's 5 Department </label>
                                        <select>
                                            <option>--select--</option>
                                            <option>Manufacturing</option>
                                            <option>Production</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Impact Assessment (By Other's 5
                                            )</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Other's 5 Feedback</label>
                                        <textarea class="summernote" name="Disposition_Batch" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Other's 5 Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="File_Attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Reviewed by">Other's 5 Review Completed By</label>
                                        <input type="text" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Approved on">Other's 5 Review Completed On</label>
                                        <input type="date" />
                                    </div>
                                </div>

                                <div class="button-block">
                                    <button type="button" class="backButton on-submit-disable-button" onclick="previousStep()">Back</button>
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- -----------Tab-4------------ -->
                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="QA Initial Comment">QA/CQA Initial Comment</label>
                                        <textarea class="summernote" name="QA_Feedbacks" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="QA Initial Attachments">QA/CQA Initial Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_Attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="QA_Attachments" name="QA_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'QA_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="button-block">
                                    <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>


                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- -----------Tab-5------------ -->

                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">


                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Approval Comment">Approval Comment</label>
                                        <textarea class="summernote" name="Approval_Comment" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Approval attachment">Approval Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Approval_Attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="Approval_Attachments"
                                                    name="Approval_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'Approval_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-12 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Date Of Correction</label>
                                        <div><small class="text-primary">Please mention expected date of completion</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <input type="text" id="Date_and_time_of_correction" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="
                                        " />
                                            <input type="date" name="Date_and_time_of_correction" class="hide-input"
                                                oninput="handleDateInput(this, 'Date_and_time_of_correction')" />
                                        </div>
                                    </div>

                                </div> --}}

                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Closure Comments</label>
                                        <textarea class="summernote" name="Closure_Comments" id="summernote-16"></textarea>
                                    </div>
                                </div> --}}

                                {{-- <div class="col-6">
                                    <div class="group-input">
                                        <label class="" for="Audit Comments">Closure Comments</label>
                                        <input type="text" name="Closure_Comments" />
                                    </div>
                                </div> --}}

                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            All Impacting Documents Corrected <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..."
                                            name="All_Impacting_Documents_Corrected">
                                            <option value="">Select a value</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div> --}}

                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Remarks (If Any)</label>
                                        <textarea class="summernote" name="Remarks" id="summernote-16"></textarea>
                                    </div>
                                </div> --}}

                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Closure Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Closure_Attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="Closure_Attachments"
                                                    name="Closure_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'Closure_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}



                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>


                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- -----------Tab-6------------ -->
                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-lg-12 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Date Of Correction of document</label>
                                        <div><small class="text-primary">Please mention expected date of completion</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <input type="text" id="Date_and_time_of_correction" readonly
                                                placeholder="DD-MMM-YYYY" value="" />
                                            <input type="date" name="Date_and_time_of_correction" class="hide-input"
                                                oninput="handleDateInput(this, 'Date_and_time_of_correction')" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="search">
                                            All Impacting Documents Corrected <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..."
                                            name="All_Impacting_Documents_Corrected">
                                            <option value="">Select a value</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Remarks</label>
                                        <textarea class="summernote" name="Remarks" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Initiator Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Initiator_Attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="Initiator_Attachments"
                                                    name="Initiator_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'Initiator_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="button-block">
                                    <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>


                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- -----------Tab-7------------ -->

                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="HOD Comment">HOD final review Comment</label>
                                        <textarea class="summernote" name="HOD_Comment1" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="HOD Attachments">HOD final Attachments</label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="HOD_Attachments1"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="HOD_Attachments1" name="HOD_Attachments1[]"
                                                    oninput="addMultipleFiles(this, 'HOD_Attachments1')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="button-block">
                                    <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>


                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- -----------Tab-8------------ -->

                    {{-- <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="QA Comment">QA Comment</label>
                                        <textarea class="summernote" name="QA_Comment1" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="QA Attachments">QA Attachments</label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_Attachments1"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="QA_Attachments1" name="QA_Attachments1[]"
                                                    oninput="addMultipleFiles(this, 'QA_Attachments1')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="button-block">
                                    <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>


                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                    <!-- -----------Tab-9------------ -->

                    <div id="CCForm9" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Closure Comments</label>
                                        <textarea class="summernote" name="Closure_Comments" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="closure attachment">Closure Attachments </label>
                                        <div><small class="text-primary">
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Closure_Attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="Closure_Attachments"
                                                    name="Closure_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'Closure_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="button-block">
                                    <button type="submit" class="saveButton on-submit-disable-button">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>


                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- -----------Tab-10------------ -->
                    <div id="CCForm10" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submitted by">Submit By</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submit on">Submit On</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submit on"> Submit Comment</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Cancel BY">Cancel By</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Cancel On"> Cancel On</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submitted on">Cancel Comment</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Reviewed by">HOD Initial Review Complete By</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Approved on">HOD Initial Review Complete On</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submitted on"> HOD Initial Review Complete Comment</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Reviewed by">Review Complete By</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Approved on">Review Complete On</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submitted on"> Review Complete Comment</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Reviewed by">Approval Complete By</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Approved on">Approval Complete On</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submitted on"> Approval Complete Comment</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Correction Completed by">Correction Completed By</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Correction Completed on">Correction Completed On</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submitted on">Correction Completed Comment</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="HOD Review Complete By">HOD Review Completed By</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="HOD Review Complete By on">HOD Review Completed On</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submitted on">HOD Review Completed Comment</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="QA Head Aproval Completed by">QA/CQA Head Approval Completed
                                            By</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="QA Head Aproval Completed on">QA/CQA Head Approval Completed
                                            On</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submitted on">QA/CQA Head Approval Completed Comment</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>



                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Sent to Opened State BY">Sent To Opened State By</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="QA Head Aproval Completed on">Sent To Opened State
                                            On</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submitted on">Sent To Opened State Comment</label>
                                        <div class="">Not Applicable</div>
                                    </div>
                                </div>





                                <div class="button-block">
                                    {{-- <button type="submit" class="saveButton on-submit-disable-button">Save</button> --}}
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    {{-- <button type="button" class="nextButton" onclick="nextStep()">Next</button> --}}


                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
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
            ele: '#related_records, #hod, #reference'
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

    <!-- <script>
        $(document).ready(function() {
            $('#Details-add').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html = '';
                    html += '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="details[' + serialNumber +
                        '][ListOfImpactingDocument]"></td>' +

                        // '<td><input type="text" name="details[' + serialNumber + '][PreparedBy]"></td>' +
                        // '<td><input type="text" name="details[' + serialNumber + '][CheckedBy]"></td>' +
                        // '<td><input type="text" name="details[' + serialNumber + '][ApprovedBy]"></td>' +

                        '<td><button type="text" class="removeRowBtn" >Remove</button></td>' +
                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

                    '</tr>';

                    return html;
                }

                var tableBody = $('#Details-table tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script> -->

    <script>
        $(document).ready(function() {
            $('#Details_add').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                            '<tr>' +
                            '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                            '"></td>' +
                            '<td><input type="text" name="ListOfImpactingDocument[]"></td>' +

                            '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
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

    <script>
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove();
        })
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
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>
@endsection
