@extends('frontend.layout.main')
@section('container')
<link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet'
        type='text/css' />
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'>
    </script>
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>
    <style>
        #fr-logo {
            display: none;
        }
    </style>

    <div class="form-field-head">
        {{-- <div class="pr-id">
            New Child
        </div> --}}
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            @if(!empty($parent_division_id)) 
                {{ Helpers::getDivisionName($parent_division_id) }} /
            @else
                {{ Helpers::getDivisionName(session()->get('division')) }} /
            @endif
             Action Item
        </div>
    </div>
    @php
        $users = DB::table('users')->get();
    @endphp


    {{-- ! ========================================= --}}
    {{-- !               DATA FIELDS                 --}}
    {{-- ! ========================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Acknowledge</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Post Completion</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA/CQA Verification</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Activity Log</button>
            </div>

            <form action="{{ route('actionItem.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div id="step-form">
                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif
                    <!-- Tab content -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                General Information
                            </div> <!-- RECORD NUMBER -->
                            <div class="row">

                            @if (!empty($parent_id))
                            <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName($parent_division_id) }}/AI/{{ date('Y') }}/{{ $record}}">
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input readonly type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                    </div>
                                </div> -->

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        @if(!empty($parent_division_id))
                                            <input disabled type="text" name="division_id" value="{{ Helpers::getDivisionName($parent_division_id) }}">
                                            <input type="hidden" name="division_id" value="{{ $parent_division_id }}">
                                        @else
                                            <input disabled type="text" name="division_id" value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                            <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                        @endif
                                    </div>
                                </div>

                            @else
                            <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input type="hidden" name="record" value="{{ $record_number }}">
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/AI/{{ date('Y') }}/{{ str_pad($record_number, 4, '0', STR_PAD_LEFT) }}">
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input disabled type="text" name="division_id"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id"
                                            value="{{ session()->get('division') }}">
                                        {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                    </div>
                                </div>

                            @endif
                               

                                <div class="col-lg-6">
                                    @if (!empty($cc->id))
                                        <input type="hidden" name="ccId" value="{{ $cc->id }}">
                                    @endif
                                    <div class="group-input">
                                        <label for="originator">Initiator</label>
                                        <input disabled type="text"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Opened">Date of Initiation</label>
                                        {{-- <div class="static">{{ date('d-M-Y') }}</div> --}}
                                        <input disabled type="text"
                                            value="{{ date('d-M-Y') }}"
                                            name="intiation_date">
                                        <input type="hidden" value="{{ date('d-M-Y') }}" name="intiation_date">
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Parent Record Number</b></label>
                                        @if (!empty($record_number_full))
                                        <input readonly type="text" name="parent_record_number"
                                            value="{{ $record_number_full }}">
                                        @else
                                        <input readonly type="text" name="parent_record_number"
                                        value="">
                                        @endif
                                    </div>
                                </div> --}}
    

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Parent Record Number</b></label>
                                    @if (!empty($parent_record))
                                        <input readonly type="text" name="parent_record_number"
                                            value="{{ $parent_record }}">
                                    @else
                                        <input readonly type="text" name="parent_record_number" value="">
                                    @endif

                                    </div>
                                </div>

                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Due Date">Due Date</label>

                                        @if (!empty($cc->due_date))
                                        <div class="static">{{ $cc->due_date }}</div>
                                        @endif
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
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                --}}

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="assign_to1"> Assigned To<span
                                                class="text-danger">*</span>
                                        </label></label>
                                        <select name="assign_to" id="assign_to" required>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}" data-department-id="{{ $data->departmentid }}">
                                                    {{ $data->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Due Date"> Due Date</label>
                                        {{-- <div>
                                            <small class="text-primary">If revising Due Date, kindly mention the revision reason in the "Due Date Extension Justification" data field.</small>
                                        </div> --}}
                                        {{-- <div class="calenderauditee">
                                            <!-- Display formatted date (Initial placeholder) -->
                                            <input disabled type="text" id="due_date_display" readonly placeholder="DD-MMM-YYYY" />

                                            <!-- Hidden input field to allow the user to pick a date -->
                                            <input type="date" name="due_date"

                                                class="hide-input" oninput="handleDateInput(this, 'due_date_display')" />
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- <script>
                                    function handleDateInput(dateInput, displayId) {
                                        const date = new Date(dateInput.value);
                                        if (dateInput.value) {
                                            const options = { day: '2-digit', month: 'short', year: 'numeric' };
                                            document.getElementById(displayId).value = date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                        } else {
                                            document.getElementById(displayId).value = '';
                                        }
                                    }

                                    // Ensure the correct format is shown on page load (if you want to pre-fill with today's date)
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const dateInput = document.querySelector('input[name="due_date"]');
                                        if (!dateInput.value) {
                                            dateInput.value = "{{ \Carbon\Carbon::now()->format('Y-m-d') }}";
                                            handleDateInput(dateInput, 'due_date_display');
                                        }
                                    });
                                </script> --}}

                                {{-- <style>
                                    .hide-input {
                                        display: none;
                                    }
                                </style> --}}
                   

                   
                                {{-- @if (!empty($parent_type))
                                <div class="col-lg-6 new-date-data-field">
                                <label for="Audit Schedule Start Date">Due Date</label>
                                <input type="text" name="due_date" value="{{ Helpers::getdateFormat($data->due_date) }}"  style="font-size: 14px;" />
                                </div>
                                @else
                                <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Audit Schedule Start Date">Due Date</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="due_dateq" placeholder="DD-MM-YYYY" />
                                        <input type="date" id="due_date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" 
                                            value="{{ $due_date }}" class="hide-input"
                                            oninput="handleDateInput(this, 'due_dateq');checkDate('due_dateq')" />
                                    </div>
                                </div>
                                </div>
                                @endif --}}

                                {{-- @if (!empty($parent_type) && ($parent_type == 'CAPA' || $parent_type == 'Management Review'))
                                    <div class="col-lg-6 new-date-data-field">
                                        <label for="Audit Schedule Start Date">Due Date</label>
                                        <input type="text" name="due_date" value="{{ Helpers::getdateFormat($data1->due_date) }}" style="font-size: 14px;" />
                                    </div>
                                @elseif (!empty($parent_type))
                                    <div class="col-lg-6 new-date-data-field">
                                        <label for="Audit Schedule Start Date">Due Date</label>
                                        <input type="text" name="due_date" value="{{ Helpers::getdateFormat($data->due_date ?? '') }}" style="font-size: 14px;" />
                                    </div>
                                @else --}}
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Audit Schedule Start Date">Due Date</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="due_dateq" placeholder="DD-MM-YYYY" />
                                                <input type="date" id="due_date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" 
                                                    value="{{ $due_date }}" class="hide-input"
                                                    oninput="handleDateInput(this, 'due_dateq');checkDate('due_dateq')" />
                                            </div>
                                        </div>
                                    </div>
                                {{-- @endif --}}


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
                                        <label for="Due Date">Parent Record</label>
                                        @if (!empty($parent_id))
                                            @if($parent_type == "Risk Assesment")
                                                <input type="text" name="parent_record" value="{{ str_pad($parentRecord, 4, '0', STR_PAD_LEFT) }}" readonly >
                                            @elseif($parent_type == "CAPA")
                                                <input type="text" name="parent_record" value="{{ str_pad($parentRecord, 4, '0', STR_PAD_LEFT) }}" readonly >
                                            @elseif($parent_type == "OOS Chemical")
                                                <input type="text" name="parent_record" value="{{ str_pad($parentRecord, 4, '0', STR_PAD_LEFT) }}" readonly >
                                            @elseif($parent_type == "OOT")
                                                <input type="text" name="parent_record" value="{{ str_pad($parentRecord, 4, '0', STR_PAD_LEFT) }}" readonly >
                                            @elseif($parent_type == "Out of Calibration")
                                                <input type="text" name="parent_record" value="{{ str_pad($parentRecord, 4, '0', STR_PAD_LEFT) }}" readonly >
                                            @elseif($parent_type == "External Audit")
                                                <input type="text" name="parent_record" value="{{ str_pad($parentRecord, 4, '0', STR_PAD_LEFT) }}" readonly >
                                            @elseif($parent_type == "Market Complaint")
                                                <input type="text" name="parent_record" value="{{ str_pad($parentRecord, 4, '0', STR_PAD_LEFT) }}" readonly >
                                            @elseif($parent_type == "Management Review")
                                                <input type="text" name="parent_record" value="{{ str_pad($parentRecord, 4, '0', STR_PAD_LEFT) }}" readonly >
                                            @else
                                                <input type="text" name="parent_record" readonly>
                                            @endif
                                        @endif
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
                                </script> --}}

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
                                        <input id="docname" type="text" name="short_description" maxlength="255" required>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Related Records">Action Item Related Records</label>
                                        <select multiple id="related_records" name="related_records[]"
                                            placeholder="Select Reference Records">
                                      @if (!empty($old_record))
                                            @foreach ($old_record as $new)
                                            @php
                                            $recordValue =
                                                Helpers::getDivisionName($new->division_id) .
                                                '/AI/' .
                                                date('Y') .
                                                '/' .
                                                Helpers::recordFormat($new->record);
                                            $selected = in_array(
                                                $recordValue,
                                                explode(',', $new->related_records),
                                            )
                                                ? 'selected'
                                                : '';
                                        @endphp
                                                <option value="{{ $recordValue }}">
                                                    {{ Helpers::getDivisionName($new->division_id) }}/AI/{{ date('Y') }}/{{ Helpers::recordFormat($new->record) }}
                                                </option>
                                            @endforeach
                                         @endif
                                        </select>
                                        {{-- <input type="longText" name="related_records" > --}}
                                    </div>
                                </div> -->

                                <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="HOD Persons">Action Item Related Records</label>
                                           <input type="text" name="related_records">
                                        </div>
                                </div>
                                 {{-- <div class="col-6">
                                    <div class="group-input">
                                        <label for="related_records">
                                           Action Item Related Records <span class="text-danger">*</span>
                                        </label>

                                        <select multiple name="related_records[]" id="related_records" 
                                            placeholder="Select Reference Records"
                                            data-silent-initial-value-set="true"
                                            required>
                                            
                                            @if (!empty($relatedRecords))
                                                @foreach ($relatedRecords as $records)
                                                    @php
                                                        $recordValue = Helpers::getDivisionName(
                                                            $records->division_id ?? $records->division ?? $records->division_code ?? $records->site_location_code
                                                        ) . '/' . $records->process_name . '/' . date('Y') . '/' . Helpers::recordFormat($records->record);
                                                    @endphp

                                                    <option value="{{ $recordValue }}">
                                                        {{ $recordValue }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Persons">HOD Persons</label>
                                        <select   name="hod_preson[]" placeholder="Select HOD Persons" data-search="false"
                                            data-silent-initial-value-set="true">
                                            <option value="">select person</option>
                                            @foreach ($users as $value)

                                                <option value="{{ $value->name }}">{{ $value->name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Short Description"> Description<span
                                                class="text-danger"></span></label>
                                        <textarea class="summernote" name="description"  id="summernote-1"></textarea>
                                    </div>
                                </div>

                                {{--
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Responsible Department">Responsible Department</label>
                                        <select name="departments">
                                            <option value="" >--Select--</option>
                                            <option value="Corporate Quality Assurance" >Corporate Quality Assurance</option>
                                            <option value="Quality Assurance" >Quality Assurance</option>
                                            <option value="Quality Control" >Quality Control</option>
                                            <option value="Quality Control (Microbiology department)" >Quality Control (Microbiology department)</option>
                                            <option value="Production GeneralG" >Production General</option>
                                            <option value="Production Liquid Orals" >Production Liquid Orals</option>
                                            <option value="Production Tablet and Powder" >Production Tablet and Powder</option>
                                            <option value="Production External (Ointment, Gels, Creams and Liquid)" >Production External (Ointment, Gels, Creams and Liquid)</option>
                                            <option value="Production Capsules" >Production Capsules</option>
                                            <option value="Production Injectable" >Production Injectable</option>
                                            <option value="Engineering" >Engineering</option>
                                            <option value="Human Resource" >Human Resource</option>
                                            <option value="Store" >Store</option>
                                            <option value="Electronic Data Processing" >Electronic Data Processing</option>
                                            <option value="Formulation  Development" >Formulation  Development</option>
                                            <option value="Analytical research and Development Laboratory" >Analytical research and Development Laboratory</option>
                                            <option value="Packaging Development">Packaging Development</option>
                                            <option value="Purchase Department">Purchase Department</option>
                                            <option value="Document Cell">Document Cell</option>
                                            <option value="Regulatory Affairs">Regulatory Affairs</option>
                                            <option value="Pharmacovigilance">Pharmacovigilance</option>
                                        </select>
                                    </div>
                                </div>

                                --}}


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Responsible Department</b></label>
                                        <input readonly type="text" name="departments" id="initiator_group">
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

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="file_attach">File Attachments</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="file_attach"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="file_attach[]"
                                                    oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                            </div>
                                        </div>
                                        {{-- <input type="file" name="file_attach[]" multiple> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>

                            </div>
                        </div>
                    </div>

                    {{-- <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Action Taken">RLS Record Number</label>
                                        <div class="static">Parent Record Number</div>
                                        <input disabled type="text"
                                            value="{{ Helpers::getDivisionName($parent_division_id) }}/{{ $parent_name }}/2023/{{ Helpers::recordFormat($parent_record) }}">
                                    </div>
                                </div>

                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">
                                            Exit </a> </button>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head">Acknowledge</div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="acknowledge_comments">Acknowledge Comment
                                        </label>
                                        <textarea name="acknowledge_comments" disabled></textarea>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="file_attach">Acknowledge Attachment</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="acknowledge_attach"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" disabled name="acknowledge_attach[]"
                                                    oninput="addMultipleFiles(this, 'acknowledge_attach')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>


                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head col-12">Post Completion</div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="action_taken">Action Taken</label>
                                        <textarea name="action_taken" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="start_date">Actual Start Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="start_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  id="start_date_checkdate" name="start_date" class="hide-input"
                                                oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')" disabled />
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-lg-6  new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="end_date">Actual End Date</label>
                                        <div class="calenderauditee">
                                        <input type="text" id="end_date"
                                                placeholder="DD-MMM-YYYY" />
                                             <input type="date"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="end_date_checkdate" name="end_date" class="hide-input"
                                                oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" disabled />
                                        </div>


                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments">Comments</label>
                                        <textarea name="comments" disabled></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Support_doc">Completion Attachment</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Support_doc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Support_doc[]"
                                                    oninput="addMultipleFiles(this, 'Support_doc')" multiple disabled>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head">QA/CQA Verification</div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_comments">QA/CQA Verification Comments</label>
                                        <textarea name="qa_comments" disabled></textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-12 sub-head">
                                    Extension Justification
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="due-dateextension">Due Date Extension Justification</label>
                                        <textarea name="due_date_extension"></textarea>
                                    </div>
                                </div> --}}

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="file_attach">QA/CQA Verification attachments</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="final_attach"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="final_attach[]"
                                                    oninput="addMultipleFiles(this, 'final_attach')" multiple disabled>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <style>
                        .static{
                            font-weight: 100 !important;
                        }
                    </style>


                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                        <div class="sub-head">
                            Activity Log
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="submitted by">Submit By</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="submitted on">Submit On</label>
                                    <div class="Date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Submit Comment</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                            <div class="sub-head">Cancel</div>
                                        </div> -->
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled by">Cancel By</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled on">Cancel On</label>
                                    <div class="Date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Cancel Comment</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>

                            <!-- <div class="col-12">
                                            <div class="sub-head">Acknowledge Complete</div>
                                        </div> -->

                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled by">Acknowledge Complete By</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled on">Acknowledge Complete On</label>
                                    <div class="Date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Acknowledge Complete Comment</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>

                            <!-- <div class="col-12">
                                            <div class="sub-head">Complete</div>
                                        </div> -->

                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled by">Complete By</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled on">Complete On</label>
                                    <div class="Date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Complete Comment</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                            <div class="sub-head">Verification Complete</div>
                                        </div> -->
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled by">Verification Complete By</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled on">Verification Complete On</label>
                                    <div class="Date">Not Applicable</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Verification Complete Comment</label>
                                    <div class="static">Not Applicable</div>
                                </div>
                            </div>

                                </div>
                            <div class="button-block">
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <!-- <button type="submit" class="saveButton">Save</button> -->
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
            ele: '#related_records, #hod'
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
    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);});
    </script>

    
<script>
         var editor = new FroalaEditor('.summernote', {
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
         
        $(".summernote-disabled").FroalaEditor("edit.off");
    </script>

@endsection
