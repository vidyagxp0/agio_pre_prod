@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
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

    <div class="form-field-head">
        <div class="pr-id">
            {{--  New Document  --}}
        </div>
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($data->division_id) }} / External Audit
        </div>
    </div>

    {{-- ---------------------- --}}
    <div id="change-control-view">
        <div class="container-fluid">

            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>

                    <div class="d-flex" style="gap:20px;">
                        <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button>
                        <button class="button_theme1"> <a class="text-white"
                                href="{{ route('ShowExternalAuditTrial', $data->id) }}"> Audit Trail </a> </button>

                        @if ($data->stage == 1)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Schedule Audit
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button>
                        @elseif($data->stage == 2)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Reject
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Complete Audit Preparation
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 3)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Issue Report
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Reject
                            </button>
                        @elseif($data->stage == 4)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                CAPA Plan Proposed

                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                No CAPAs Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button>
                        @elseif($data->stage == 5)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                All Actions Completed
                            </button>
                        @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a> </button>

                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    {{-- ------------------------------By Pankaj-------------------------------- --}}
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars">
                            @if ($data->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif

                            @if ($data->stage >= 2)
                                <div class="active">Audit Preparation</div>
                            @else
                                <div class="">Audit Preparation</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="active">Pending Audit</div>
                            @else
                                <div class="">Pending Audit</div>
                            @endif

                            @if ($data->stage >= 4)
                                <div class="active">Pending Response</div>
                            @else
                                <div class="">Pending Response</div>
                            @endif


                            @if ($data->stage >= 5)
                                <div class="active">CAPA Execution in Progress</div>
                            @else
                                <div class="">CAPA Execution in Progress</div>
                            @endif
                            @if ($data->stage >= 6)
                                <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif
                    @endif


                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
        </div>

        <div class="control-list">

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
                        <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Auditee</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Auditee Details</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Risk Assessment</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Activity Log</button>
                    </div>

                    <form action="{{ route('updateExternalAudit', $data->id) }}" method="post">
                        @csrf
                        <div id="step-form">

                            <!-- General information content -->
                            <div id="CCForm1" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number"><b>Record Number</b></label>
                                                <input disabled type="text" name="record_number"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}/EA/{{ Helpers::year($data->created_at) }}/{{ $data->record }}">
                                                {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Division Code"><b>Division Code</b></label>
                                                <input disabled type="text" name="division_code"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}">
                                                {{-- <div class="static">QMS-North America</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator"><b>Initiator</b></label>
                                                {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                                <input disabled type="text" value="{{ $data->initiator_name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Date Due"><b>Date of Initiation</b></label>
                                                <input disabled type="text"
                                                    value="{{ Helpers::getdateFormat($data->intiation_date) }}"
                                                    name="intiation_date">

                                                {{-- <div class="static">{{ date('d-M-Y') }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="search">
                                                    Assigned To <span class="text-danger"></span>
                                                </label>
                                                <select id="select-state" placeholder="Select..." name="assign_to"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="">Select a value</option>
                                                    @foreach ($users as $key => $value)
                                                        <option value="{{ $value->id }}"
                                                            @if ($data->assign_to == $value->id) selected @endif>
                                                            {{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('assign_to')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="due-date">Due Date<span class="text-danger"></span></label>

                                                <input disabled type="text"
                                                    value="{{ Helpers::getdateFormat($data->due_date) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="initiator_group"><b>Initiator Group</b></label>
                                                <select name="initiator_group"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="">-- Select --</option>
                                                    <option value="CQA"
                                                        @if ($data->initiator_group == 'CQA') selected @endif>Corporate Quality
                                                        Assurance
                                                    </option>
                                                    <option value="QAB"
                                                        @if ($data->initiator_group == 'QAB') selected @endif>Quality Assurance
                                                        Biopharma
                                                    </option>
                                                    <option value="CQC"
                                                        @if ($data->initiator_group == 'CQC') selected @endif>Central Quality
                                                        Control
                                                    </option>
                                                    <option value="CQC"
                                                        @if ($data->initiator_group == 'CQC') selected @endif>Manufacturing
                                                    </option>
                                                    <option value="PSG"
                                                        @if ($data->initiator_group == 'PSG') selected @endif>Plasma Sourcing
                                                        Group
                                                    </option>
                                                    <option value="CS"
                                                        @if ($data->initiator_group == 'CS') selected @endif>Central Stores
                                                    </option>
                                                    <option value="ITG"
                                                        @if ($data->initiator_group == 'ITG') selected @endif>Information
                                                        Technology Group
                                                    </option>
                                                    <option value="MM"
                                                        @if ($data->initiator_group == 'MM') selected @endif>Molecular
                                                        Medicine
                                                    </option>
                                                    <option value="CL"
                                                        @if ($data->initiator_group == 'CL') selected @endif>Central
                                                        Laboratory
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group Code">Initiator Group Code</label>
                                                <input type="text" name="initiator_group_code"
                                                    value="{{ $data->initiator_group }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description</label>
                                                <textarea name="short_description" id="short_description"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->short_description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Type of Audit</label>
                                                <select name="type_of_audit"
                                                    onchange="otherController(this.value, 'others', 'if_other')"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option>Enter Your Selection Here</option>
                                                    <option value="r&d"
                                                        @if ($data->type_of_audit == 'r&d') selected @endif>R&D
                                                    </option>
                                                    <option value="glp"
                                                        @if ($data->type_of_audit == 'glp') selected @endif>GLP
                                                    </option>
                                                    <option value="gcp"
                                                        @if ($data->type_of_audit == 'gcp') selected @endif>GCP
                                                    </option>
                                                    <option value="gdp"
                                                        @if ($data->type_of_audit == 'gdp') selected @endif>GDP
                                                    </option>
                                                    <option value="gep"
                                                        @if ($data->type_of_audit == 'gep') selected @endif>GEP
                                                    </option>
                                                    <option value="others"
                                                        @if ($data->type_of_audit == 'others') selected @endif>Others
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="if_other">
                                                <label for="If Other">If Other<span
                                                        class="text-danger d-none">*</span></label>
                                                <textarea name="if_other" id="if_other" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->if_other }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="repeat">Repeat</label>
                                                <select name="repeat"
                                                    onchange="otherController(this.value, 'yes', 'repeat_nature')">
                                                    <option>Enter Your Selection Here</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                    <option value="na">NA</option>
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
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Initiated Through</label>
                                                <select name="initiated_through"
                                                    onchange="otherController(this.value, 'others', 'initiated_through_req')">
                                                    <option>Enter Your Selection Here</option>
                                                    <option value="recall">Recall</option>
                                                    <option value="return">Return</option>
                                                    <option value="deviation">Deviation</option>
                                                    <option value="complaint">Complaint</option>
                                                    <option value="regulatory">Regulatory</option>
                                                    <option value="lab-incident">Lab Incident</option>
                                                    <option value="improvement">Improvement</option>
                                                    <option value="others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="initiated_through_req">
                                                <label for="If Other">Others<span
                                                        class="text-danger d-none">*</span></label>
                                                <textarea name="if_other"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Inv Attachments">Inv Attachment</label>
                                                <input type="file" id="inv_attachment" name="inv_attachment"
                                                    value="{{ $data->inv_attachment }}" multiple
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="group-input">
                                                <label for="Initial Comments">Initial Comments</label>
                                                <textarea name="initial_comments" id="initial_comments"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->initial_comments }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" id="ChangesaveButton" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>

                                        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Auditee Details content -->
                            <div id="CCForm2" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Auditee/Supplier">Auditee/Supplier</label>
                                                <input type="text" name="auditee" id="auditee"
                                                    value="{{ $data->auditee }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Contact Person">Contact Person</label>
                                                <input type="text" name="contact_person" id="contact_person"
                                                    value="{{ $data->contact_person }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Other Contacts">Other Contacts</label>
                                                <input type="text" name="other_contacts" id="other_contacts"
                                                    value="{{ $data->other_contacts }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Zone">Zone</label>
                                                <input type="text" name="zone" id="zone"
                                                    value="{{ $data->zone }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Country">Country</label>
                                                <input type="text" name="country" id="country"
                                                    value="{{ $data->country }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="City">City</label>
                                                <input type="text" name="city" id="city"
                                                    value="{{ $data->city }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Address">Addres</label>
                                                <input type="text" name="addres" id="addres"
                                                    value="{{ $data->addres }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Regulatory History">Regulatory History</label>
                                                <input type="text" name="regulatory_history" id="regulatory_history"
                                                    value="{{ $data->regulatory_history }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Manufacturing Sites">Manufacturing Sities</label>
                                                <textarea name="manufacturing_sities" id="manufacturing_sities"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->manufacturing_sities }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Quality Management">Quality Management</label>
                                                <textarea name="quality_management" id="quality_management"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->quality_management }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Bussiness History">Business History</label>
                                                <textarea name="business_history" id="business_history"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->business_history }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Performance History">Performance History</label>
                                                <input type="text" name="performance_history" id="performance_history"
                                                    value="{{ $data->performance_history }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Compliance Risk">Compliance Risk</label>
                                                <input type="text" name="compliance_risk" id="compliance_risk"
                                                    value="{{ $data->compliance_risk }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        @if ($data->stage != 0 || $data->stage != 6)
                                            <button type="submit" id="ChangesaveButton" class="saveButton"
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                                        @endif
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!--Risk Assessment  content -->
                            <div id="CCForm3" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12 sub-head">
                                            Audit Information
                                        </div>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Last Audit Date">Last Audit Date</label>
                                                <!-- <input type="date" id="last_audit_date" name="last_audit_date"
                                                    value="{{ $data->last_audit_date }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}> -->
                                                    <div class="calenderauditee">                                     
                                                        <input type="text"  id="last_audit_date"  readonly placeholder="DD-MMM-YYYY" value="{{ $data->last_audit_date }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} />
                                                        <input type="date" name="last_audit_date" value=""
                                                        class="hide-input"
                                                        oninput="handleDateInput(this, 'last_audit_date')"/>
                                                    </div>  
                                            </div>
                                        </div>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Next Audit Date">Next Audit Date</label>
                                                <!-- <input type="date" id="next_audit_date" name="next_audit_date"
                                                    value="{{ $data->next_audit_date }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}> -->
                                                    <div class="calenderauditee">                                     
                                                        <input type="text"  id="next_audit_date"  readonly placeholder="DD-MMM-YYYY"  value="{{ $data->next_audit_date }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}/>
                                                        <input type="date" name="next_audit_date" value=""
                                                        class="hide-input"
                                                        oninput="handleDateInput(this, 'next_audit_date')"/>
                                                    </div>    
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Audit Frequency">Audit Frequency</label>
                                                <select name="audit_frequency" id="audit_frequency"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    @foreach ($users as $key => $value)
                                                        <option value="{{ $value->id }}"
                                                            @if ($data->audit_frequency == $value->id) selected @endif>
                                                            {{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Last Audit Result">Last Audit Result</label>
                                                <select name="last_audit_result" id="last_audit_result"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option>Enter Your Selection Here</option>
                                                    <option value="yes"
                                                        @if ($data->last_audit_result == 'yes') selected @endif>yes
                                                    </option>
                                                    <option value="no"
                                                        @if ($data->last_audit_result == 'no') selected @endif>No
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head">
                                            Risk Factors
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Facility Type">Facility Type</label>
                                                <select name="facility_type" id="facility_type"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option>Enter Your Selection Here</option>
                                                    <option value="yes"
                                                        @if ($data->facility_type == 'yes') selected @endif>yes
                                                    </option>
                                                    <option value="no"
                                                        @if ($data->facility_type == 'no') selected @endif>No
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Number of Employess">Number of Employess</label>
                                                <select name="number_of_employess" id="number_of_employess"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    @foreach ($users as $value)
                                                        <option
                                                            {{ $data->number_of_employess == $value->id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Access to Technical Support">Access to Technical
                                                    Support</label>
                                                <select name="access_to_technical_support"
                                                    id="access_to_technical_support"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    @foreach ($users as $value)
                                                        <option
                                                            {{ $data->access_to_technical_support == $value->id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Services Supported">Services Supported</label>
                                                <select name="services_supported" id="services_supported"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    @foreach ($users as $key => $value)
                                                        <option value="{{ $value->id }}"
                                                            @if ($data->services_supported == $value->id) selected @endif>
                                                            {{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Reliabillty">Reliabillty</label>
                                                <select name="reliabillty" id="reliabillty"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="">--select--</option>
                                                    <option value="yes"
                                                        @if ($data->reliabillty == 'yes') selected @endif>yes
                                                    </option>
                                                    <option value="no"
                                                        @if ($data->reliabillty == 'no') selected @endif>No
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Revenue">Revenue</label>
                                                <select name="revenue" id="revenue"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="">--select--</option>
                                                    <option value="yes"
                                                        @if ($data->revenue == 'yes') selected @endif>yes
                                                    </option>
                                                    <option value="no"
                                                        @if ($data->revenue == 'no') selected @endif>No
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Client Base">Client Base</label>
                                                <select name="client_base" id="client_base"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="">--select--</option>
                                                    <option value="yes"
                                                        @if ($data->client_base == 'yes') selected @endif>yes
                                                    </option>
                                                    <option value="no"
                                                        @if ($data->client_base == 'no') selected @endif>No
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Previous Audit Results">Previous Audit Results</label>
                                                <select name="previous_audit_results" id="previous_audit_results"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="">--select--</option>
                                                    <option value="yes"
                                                        @if ($data->previous_audit_results == 'yes') selected @endif>yes
                                                    </option>
                                                    <option value="no"
                                                        @if ($data->previous_audit_results == 'no') selected @endif>No
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head">
                                            Results
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Risk Ram Total">Risk Ram Total</label>
                                                <input type="text" id="risk_ram_total" name="risk_ram_total"
                                                    value="{{ $data->risk_ram_total }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Risk Median">Risk Median</label>
                                                <input type="text" id="risk_median" name="risk_median"
                                                    value="{{ $data->risk_median }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Risk Average">Risk Average</label>
                                                <input type="text" id="risk_average" name="risk_average"
                                                    value="{{ $data->risk_average }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Risk Assessment Total">Risk Assessment Total
                                                </label>
                                                <input type="text" id="risk_assessment_total"
                                                    name="risk_assessment_total"
                                                    value="{{ $data->risk_assessment_total }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head">
                                            Extension Justification
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="due_date_extension">Due Date Extension Justification</label>
                                                <textarea name="due_date_extension"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        @if ($data->stage != 0 || $data->stage != 6)
                                            <button type="submit" id="ChangesaveButton" class="saveButton"
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                                        @endif
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Signatures content -->
                            <div id="CCForm4" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted By">Submitted By</label>
                                                <div class="static">{{ $data->submitted_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted On">Submitted On</label>
                                                <div class="static">{{ $data->submitted_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Closed By">Closed By</label>
                                                <div class="static">{{ $data->closed_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Closed On">Closed On</label>
                                                <div class="static">{{ $data->closed_on }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        @if ($data->stage != 0 || $data->stage != 6)
                                            <button type="submit" id="ChangesaveButton" class="saveButton"
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                                        @endif
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="submit"
                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Submit</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>


                </div>
            </div>


            <div class="modal fade" id="child-modal1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('extension_child', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    <label for="major">
                                        <input type="hidden" name="parent_name" value="External_audit">
                                        <input type="hidden" name="due_date" value="{{$data->due_date}}">
                                        <input type="radio" name="child_type" value="extension">
                                        extension
                                    </label>

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

            <div class="modal fade" id="signature-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('AuditeeStateChange', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username <span
                                        class="text-danger">*</span></label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span
                                        class="text-danger">*</span></label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment</label>
                                    <input type="comment" name="comment">
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="rejection-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ route('RejectStateAuditee', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username <span
                                        class="text-danger">*</span></label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span
                                        class="text-danger">*</span></label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment <span
                                        class="text-danger">*</span></label>
                                    <input type="comment" name="comment" required>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
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

                        <form action="{{ route('CancelStateExternalAudit', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="mb-3 text-justify">
                                    Please select a meaning and a outcome for this task and enter your username
                                    and password for this task. You are performing an electronic signature,
                                    which is legally binding equivalent of a hand written signature.
                                </div>
                                <div class="group-input">
                                    <label for="username">Username <span
                                        class="text-danger">*</span></label>
                                    <input type="text" name="username" required>
                                </div>
                                <div class="group-input">
                                    <label for="password">Password <span
                                        class="text-danger">*</span></label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="group-input">
                                    <label for="comment">Comment <span
                                        class="text-danger">*</span></label>
                                    <input type="comment" name="comment" required>
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="child-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('childexternalaudit', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                <label></lable>
                                    <label for="major">
                                        <input type="radio" name="child_type" value="Observations">
                                        Observations
                                    </label>
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

            <style>
                #step-form>div {
                    display: none
                }

                #step-form>div:nth-child(1) {
                    display: block;
                }
            </style>

            <script>
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
        @endsection
