@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    <style>
        header {
            display: none;
        }
        .calenderauditee {
        position: relative;
    }

    .new-date-data-field .input-date input.hide-input {
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
    
    @php
        $users = DB::table('users')->get();
    @endphp
    {{-- ======================================
                CHANGE CONTROL VIEW
    ======================================= --}}
    <div id="rcms_form-head">
        <div class="container-fluid">
            <div class="inner-block">
                {{-- <div class="head">PR-0001</div> --}}
                <div class="slogan">
                    <strong>Division / Project :</strong>
                    {{ Helpers::getDivisionName($data->division_id) }} / Action item
                </div>
            </div>
        </div>
    </div>

    <div id="change-control-view">
        <div class="container-fluid">

            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>

                    <div class="d-flex" style="gap:20px;">
                        @php
                        $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                    @endphp
                        <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button>
                        {{--  <button class="button_theme1"> <a class="text-white" href="{{ url('send-notification', $data->id) }}"> Send Notification </a> </button>  --}}

                        <button class="button_theme1"> <a class="text-white"
                                href="{{ url('rcms/action-item-audittrialshow', $data->id) }}"> Audit Trail </a> </button>
                        @if ($data->stage == 1 && in_array(3, $userRoleIds) || in_array(18, $userRoleIds))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 2 && (in_array(8, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                More Information Required
                            </button>
                        @endif
                        <a class="text-white button_theme1" href="{{ url('rcms/qms-dashboard') }}"> Exit </a>
                    </div>
                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                        @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="active bg-danger">Closed-Cancelled</div>
                        @else
                        <div class="progress-bars">
                            @if ($data->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif
                            @if ($data->stage >= 2)
                                <div class="active">Work In Progress</div>
                            @else
                                <div class="">Work In Progress</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="bg-danger">Closed-Done</div>
                            @else
                                <div class="">Closed-Done</div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div id="change-control-fields">
            <div class="container-fluid">

                <!-- Tab links -->
                <div class="cctab">
                    <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Parent General Information</button> --}}
                    <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Post Completion</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Action Approval</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Activity Log</button>
                </div>

                <form action="{{ route('actionItem.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div id="step-form">

                        <!-- Tab content -->
                        <div id="CCForm1" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="sub-head">
                                    General Information
                                </div>
                                <div class="row">
                                    @if (!empty($cc->id))
                                        <input type="hidden" name="ccId" value="{{ $cc->id }}">
                                    @endif
                                    {{-- <div class="col-lg-6"> --}}

                                    {{-- <div class="group-input">
                                            <label for="originator">Initiator</label>
                                            <div class="static">Amit Guru</div>
                                        </div> --}}
                                    {{-- </div> --}}
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="RLS Record Number"><b>Record Number</b></label>
                                            <input disabled type="text" name="record_number"
                                                value="{{ Helpers::getDivisionName($data->division_id) }}/AI/{{ Helpers::year($data->created_at) }}/{{ $data->record }}">
                                            {{-- <div class="static"></div> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Division Code"><b>Division Code</b></label>
                                            <input disabled type="text" name="division_code"
                                                value="{{ Helpers::getDivisionName($data->division_id) }}">
                                            {{-- <div class="static"></div> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Initiator"><b>Initiator</b></label>
                                            <input disabled type="text" name="initiator_id"
                                                value="{{ Helpers::getInitiatorName($data->initiator_id) }}">
                                            {{-- <div class="static"> </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Date Due"><b>Date of Initiation</b></label>
                                            <input disabled type="text" name="intiation_date"
                                                value="{{ Helpers::getdateFormat($data->intiation_date) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="search">
                                                Assigned To <span class="text-danger"></span>
                                            </label>
                                            <select {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} id="select-state" placeholder="Select..." name="assign_to">
                                                <option value="">Select a value</option>
                                                @foreach ($users as $value)
                                                    <option {{ $data->assign_to == $value->id ? 'selected' : '' }}
                                                        value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="due-date">Due Date <span class="text-danger"></span></label>
                                            <input disabled type="text"
                                                value="{{ Helpers::getdateFormat($data->due_date) }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        
                                        <textarea name="short_description"   id="docname" type="text"    maxlength="255" required  {{ $data->stage == 0 || $data->stage == 3 ? "disabled" : "" }}>{{ $data->short_description }}</textarea>
                                    </div>
                                    <p id="docnameError" style="color:red">**Short Description is required</p>
                                </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Related Records">Action Item Related Records</label>
                                            <select {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} multiple id="related_records" name="related_records[]"
                                                placeholder="Select Reference Records">
                                                <option value="">--select record--</option>
                                                @if (!empty($old_record))
                                                @foreach ($old_record as $new)
                                                        <option value="{{ $new->id }}"{{ in_array($new->id, explode(',', $data->Reference_Recores1)) ? 'selected' : '' }}>
                                                            {{ Helpers::getDivisionName($new->division_id) }}/AI/{{ date('Y') }}/{{ Helpers::recordFormat($new->record) }}
                                                        </option>
                                                    @endforeach
                                                    @endif
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="HOD Persons">HOD Persons</label>
                                            <select multiple name="hod_preson[]" placeholder="Select HOD Persons" data-search="false"
                                                data-silent-initial-value-set="true" id="hod" {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}>
                                                @foreach ($users as $value)
                                                    <option  value="{{ $value->id }}"
                                                        {{ in_array($value->id, explode(',', $data->hod_preson)) ? 'selected' : '' }}>
                                                       {{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="related_records">Action Item Related Records</label>
                                            <select multiple name="related_records" placeholder="Select Reference Records"
                                                data-search="false" data-silent-initial-value-set="true"
                                                id="related_records">
                                                <option {{ $data->related_records == '31' ? 'selected' : '' }}
                                                    value="31">QMS-EMEA/PROD/2023/31</option>
                                                <option {{ $data->related_records == '32' ? 'selected' : '' }}
                                                    value="32">QMS-EMEA/PROD/2023/32</option>
                                                <option {{ $data->related_records == '33' ? 'selected' : '' }}
                                                    value="33">QMS-EMEA/PROD/2023/33</option>
                                                <option {{ $data->related_records == '34' ? 'selected' : '' }}
                                                    value="34">QMS-EMEA/PROD/2023/34</option>
                                                <option {{ $data->related_records== '35' ? 'selected' : '' }}
                                                    value="35">QMS-EMEA/PROD/2023/35</option>
                                                <option {{ $data->related_records == '36' ? 'selected' : '' }}
                                                    value="36">QMS-EMEA/PROD/2023/36</option>
                                                <option {{ $data->related_records == '37' ? 'selected' : '' }}
                                                    value="37">QMS-EMEA/PROD/2023/37</option>
                                                <option {{ $data->related_records == '38' ? 'selected' : '' }}
                                                    value="38">QMS-EMEA/PROD/2023/38</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="description">Description</label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} name="description">{{ $data->description }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="Responsible Department">Responsible Department</label>
                                            <select {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} name="departments">
                                                <option value="">Enter Your Selection Here</option>
                                                <option {{ $data->departments == '1' ? 'selected' : '' }} value="1">
                                                    Quality
                                                    Assurance-CQA</option>
                                                <option {{ $data->departments == '2' ? 'selected' : '' }} value="2">
                                                    Research
                                                    and development</option>
                                                <option {{ $data->departments == '3' ? 'selected' : '' }}value="3">
                                                    Regulatory
                                                    Science</option>
                                                <option {{ $data->departments == '4' ? 'selected' : '' }} value="4">
                                                    Supply
                                                    Chain Management</option>
                                                <option {{ $data->departments == '5' ? 'selected' : '' }} value="5">
                                                    Finance
                                                </option>
                                                <option {{ $data->departments == '6' ? 'selected' : '' }} value="6">
                                                    QA-Digital</option>
                                                <option {{ $data->departments == '7' ? 'selected' : '' }} value="7">
                                                    Central
                                                    Engineering</option>
                                                <option {{ $data->departments == '8' ? 'selected' : '' }} value="8">
                                                    Projects
                                                </option>
                                                <option {{ $data->departments == '9' ? 'selected' : '' }} value="9">
                                                    Marketing</option>
                                                <option {{ $data->departments == '10' ? 'selected' : '' }} value="10">
                                                    QCAT
                                                </option>
                                                <option {{ $data->departments == '11' ? 'selected' : '' }} value="11">
                                                    Marketing</option>
                                                <option {{ $data->departments == '12' ? 'selected' : '' }} value="12">
                                                    GMP
                                                    Pilot Plant</option>
                                                <option {{ $data->departments == '13' ? 'selected' : '' }} value="13">
                                                    Manufacturing Sciences and Technology</option>
                                                <option {{ $data->departments == '14' ? 'selected' : '' }} value="14">
                                                    Environment, Health and Safety</option>
                                                <option {{ $data->departments == '15' ? 'selected' : '' }} value="15">
                                                    Business Relationship Management</option>
                                                <option {{ $data->departments == '16' ? 'selected' : '' }} value="16">
                                                    National Regulatory Affairs</option>
                                                <option {{ $data->departments == '17' ? 'selected' : '' }} value="17">
                                                    HR
                                                </option>
                                                <option {{ $data->departments == '18' ? 'selected' : '' }} value="18">
                                                    Admin
                                                </option>
                                                <option {{ $data->departments == '19' ? 'selected' : '' }} value="19">
                                                    Information Technology</option>
                                                <option {{ $data->departments == '20' ? 'selected' : '' }} value="20">
                                                    Program
                                                    Management QA Analytical (Q13)</option>
                                                <option {{ $data->departments == '21' ? 'selected' : '' }} value="21">
                                                    QA
                                                    Analytical (Q8)</option>
                                                <option {{ $data->departments == '22' ? 'selected' : '' }} value="22">
                                                    QA
                                                    Packaging Development</option>
                                                <option {{ $data->departments == '23' ? 'selected' : '' }} value="23">
                                                    QA
                                                    Engineering</option>
                                                <option {{ $data->departments == '24' ? 'selected' : '' }} value="24">
                                                    DS
                                                    Quality Assurance</option>
                                                <option {{ $data->departments == '25' ? 'selected' : '' }} value="25">
                                                    Quality
                                                    Control (Q13)</option>
                                                <option {{ $data->departments == '26' ? 'selected' : '' }} value="26">
                                                    Quality
                                                    Control (Q8)</option>
                                                <option {{ $data->departments == '27' ? 'selected' : '' }} value="27">
                                                    Quality
                                                    Control (Q15)</option>
                                                <option {{ $data->departments == '28' ? 'selected' : '' }} value="28">
                                                    QC
                                                    Microbiology (B1)</option>
                                                <option {{ $data->departments == '29' ? 'selected' : '' }} value="29">
                                                    QC
                                                    Microbiology (B2)</option>
                                                <option {{ $data->departments == '30' ? 'selected' : '' }} value="30">
                                                    Production (B1)</option>
                                                <option {{ $data->departments == '31' ? 'selected' : '' }} value="31">
                                                    Production (B2)</option>
                                                <option {{ $data->departments == '32' ? 'selected' : '' }} value="32">
                                                    Production (Packing)</option>
                                                <option {{ $data->departments == '33' ? 'selected' : '' }} value="33">
                                                    Production (Devices)</option>
                                                <option {{ $data->departments == '34' ? 'selected' : '' }} value="34">
                                                    Production (DS)</option>
                                                <option {{ $data->departments == '35' ? 'selected' : '' }} value="35">
                                                    Engineering and Maintenance (B1)</option>
                                                <option {{ $data->departments == '36' ? 'selected' : '' }} value="36">
                                                    Engineering and Maintenance (B2)</option>
                                                <option {{ $data->departments == '37' ? 'selected' : '' }} value="37">
                                                    Engineering and Maintenance (W20)</option>
                                                <option {{ $data->departments == '38' ? 'selected' : '' }} value="38">
                                                    Device
                                                    Technology Principle Management</option>
                                                <option {{ $data->departments == '39' ? 'selected' : '' }} value="39">
                                                    Production (82)</option>
                                                <option {{ $data->departments == '40' ? 'selected' : '' }} value="40">
                                                    Production (Packing)</option>
                                                <option {{ $data->departments == '41' ? 'selected' : '' }} value="41">
                                                    Production (Devices)</option>
                                                <option {{ $data->departments == '42' ? 'selected' : '' }} value="42">
                                                    Production (DS)</option>
                                                <option {{ $data->departments == '43' ? 'selected' : '' }} value="43">
                                                    Engineering and Maintenance (B1)</option>
                                                <option {{ $data->departments == '44' ? 'selected' : '' }} value="44">
                                                    Engineering and Maintenance (B2) Engineering and
                                                    Maintenance (W20)
                                                </option>
                                                <option {{ $data->departments == '45' ? 'selected' : '' }} value="45">
                                                    Device
                                                    Technology Principle Management</option>
                                                <option {{ $data->departments == '46' ? 'selected' : '' }} value="46">
                                                    Warehouse(DP)</option>
                                                <option {{ $data->departments == '47' ? 'selected' : '' }} value="47">
                                                    Drug
                                                    safety</option>
                                                <option {{ $data->departments == '48' ? 'selected' : '' }} value="48">
                                                    Others
                                                </option>
                                                <option {{ $data->departments == '49' ? 'selected' : '' }} value="49">
                                                    Visual
                                                    Inspection</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="file_attach">File Attachments</label>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="file_attach">
                                                    @if ($data->file_attach)
                                                        @foreach (json_decode($data->file_attach) as $file)
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
                                                    <input {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="file_attach[]"
                                                        oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">
                                            Exit </a> </button>

                                </div>
                            </div>
                        </div>

                        {{-- <div id="CCForm2" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Action Taken">RLS Record Number</label>
                                            <div class="static">Parent Record Number</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="initiator-group">Inititator Group</label>
                                            <select name="initiatorGroup" id="initiator-group">
                                                <option value="">-- Select --</option>
                                                <option {{ $data->initiatorGroup == 'CQA' ? 'selected' : '' }}
                                                    value="CQA">Corporate Quality Assurance</option>
                                                <option {{ $data->initiatorGroup == 'QAB' ? 'selected' : '' }}
                                                    value="QAB">Quality Assurance Biopharma</option>
                                                <option {{ $data->initiatorGroup == 'CQC' ? 'selected' : '' }}
                                                    value="CQC">Central Quality Control</option>
                                                <option {{ $data->initiatorGroup == 'CQC' ? 'selected' : '' }}
                                                    value="CQC">Manufacturing</option>
                                                <option {{ $data->initiatorGroup == 'PSG' ? 'selected' : '' }}
                                                    value="PSG">Plasma Sourcing Group</option>
                                                <option {{ $data->initiatorGroup == 'CS' ? 'selected' : '' }}
                                                    value="CS">Central Stores</option>
                                                <option {{ $data->initiatorGroup == 'ITG' ? 'selected' : '' }}
                                                    value="ITG">Information Technology Group</option>
                                                <option {{ $data->initiatorGroup == 'MM' ? 'selected' : '' }}
                                                    value="MM">Molecular Medicine</option>
                                                <option {{ $data->initiatorGroup == 'CL' ? 'selected' : '' }}
                                                    value="CL">Central Laboratory</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="initiator-code">Initiator Group Code</label>
                                            <div class="default-name"> <span
                                                    id="initiator-code">{{ $data->initiatorGroup }}</span></div>
                                        </div>
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
                        </div> --}}

                        <div id="CCForm3" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="sub-head col-12">Post Completion</div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="action_taken">Action Taken</label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} name="action_taken">{{ $data->action_taken }}</textarea>
                                        </div>
                                    </div>
                                    
                                    
                                <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Audit Schedule Start Date">Actual Start Date</label>
                                <div class="calenderauditee">
                                    <input type="text" 
                                        id="start_date" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->start_date) }}"  />
                                    <input class="hide-input" type="date"   name="start_date"{{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} id="start_date_checkdate" value="{{ $data->start_date }}"
                                        oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                </div>
                            </div>
                        </div>
                       <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Audit Schedule End Date">Actual End Date</label>
                                {{-- <input type="date" name="end_date" value="{{ $data->end_date }}" --}}
                                <div class="calenderauditee">
                                    <input type="text" 
                                        id="end_date" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->end_date) }}"  />
                                    <input class="hide-input" type="date"   name="end_date"{{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} id="end_date_checkdate" value="{{ $data->end_date }}"
                                        oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                </div>
                            </div>
                        </div>
                                </div>
                                      <div class="col-12">
                                        <div class="group-input">
                                            <label for="Comments">Comments</label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} name="comments">{{ $data->comments }}</textarea>
                                        </div>
                                    </div> 
                                    <!--<div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                                <label for="Audit Start Date">Actual Start Date</label>
                                                 <div class="calenderauditee">
                                                        <input type="text" id="start_date" readonly
                                                            placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->start_date) }}"/>
                                                         <input type="date" id="start_date_checkdate" value="{{ $data->start_date }} "
                                                        name="start_date"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} class="hide-input"
                                                            oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')" /> -->
                                                <!-- </div>
                                     </div>
                                 </div>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Audit End Date">Actual End Date</label>
                                                   <div class="calenderauditee">
                                                        <input type="text"  id="end_date" readonly
                                                            placeholder="DD-MMM-YYYY"value="{{ Helpers::getdateFormat($data->end_date) }}"/> -->
                                                        <!-- <input type="date" name="end_date"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="{{ $data->end_date }} "
                                                        id="end_date_checkdate" class="hide-input"
                                                            oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" /> -->
                                                    <!-- </div>
                                            </div>
                                        </div> --> 
                                    {{-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="Support_doc">Supporting Documents</label>
                                            <input type="file" id="myfile" name="Support_doc"
                                                value="{{ $data->Support_doc }}">
                                        </div>
                                    </div> --}}
                                   
                       
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

                        <div id="CCForm4" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="sub-head">Action Approval</div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="qa_comments">QA Review Comments</label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} name="qa_comments">{{ $data->qa_comments }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-12 sub-head">
                                        Extension Justification
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="due_date_extension">Due Date Extension Justification</label>
                                            <textarea  {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} name="due_date_extension">{{ $data->due_date_extension }}</textarea>
                                        </div>
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

                        <div id="CCForm5" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="sub-head">
                                    Electronic Signatures
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="submitted by">Submitted By</label>
                                            <div class="static">{{ $data->submitted_by }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="submitted on">Submitted On</label>
                                            <div class="Date">{{ $data->submitted_on }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="cancelled by">Cancelled By</label>
                                            <div class="static">{{ $data->cancelled_by }}</div> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="cancelled on">Cancelled On</label>
                                            <div class="Date">{{ $data->cancelled_on }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="More information required By">More information required By</label>
                                            <div class="static">{{ $data->more_information_required_by }}</div> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="More information required On">More information required On</label>
                                            <div class="Date">{{ $data->more_information_required_on }}</div> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="completed by">Completed By</label>
                                            <div class="static">{{ $data->completed_by }}</div> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="completed on">Completed On</label>
                                            <div class="Date">{{ $data->completed_on }}</div> 
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="button-block">
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="submit" class="saveButton">Save</button>
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
                                <input type="hidden" name="parent_name" value="Action_item">
                                <input type="hidden" name="due_date" value="{{ $data->due_date }}">
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


    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('rcms/send-At', $data->id) }}" method="POST">
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
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
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

                        <form action="{{ url('rcms/action-stage-cancel', $data->id) }}" method="POST">
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

            <div class="modal fade" id="rejection-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">E-Signature</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <form action="{{ route('capaCancel', $data->id) }}" method="POST">
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
    <div id="division-modal" class="d-none">
        <div class="division-container">
            <div class="content-container">
                <form action="{{ route('division_change', $data->id) }}" method="post">
                    @csrf
                    <div class="division-tabs">
                        <div class="tab">
                            @php
                                $division = DB::table('q_m_s_divisions')->where('status', 1)->get();
                            @endphp
                            @foreach ($division as $temp)
                                <input type="hidden" value="{{ $temp->id }}" name="division_id" required>
                                <button class="divisionlinks"
                                    onclick="openDivision(event, {{ $temp->id }})">{{ $temp->name }}</button>
                            @endforeach

                        </div>
                        @php
                            $process = DB::table('processes')->get();
                        @endphp
                        @foreach ($process as $temp)
                            <div id="{{ $temp->division_id }}" class="divisioncontent">
                                @php
                                    $pro = DB::table('processes')
                                        ->where('division_id', $temp->division_id)
                                        ->get();
                                @endphp
                                @foreach ($pro as $test)
                                    <label for="process">
                                        <input type="radio" for="process" value="{{ $test->id }}"
                                            name="process_id" required> {{ $test->process_name }}
                                    </label>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                    <div class="button-container">
                        <button id="submit-division">Cancel</button>
                        <button id="submit-division" type="submit">Continue</button>
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
                    <h4 class="modal-title">Document Revision</h4>
                </div>
                <form method="{{ url('rcms/child-AT', $data->id) }}" action="post">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            <label for="revision">Choose Change Implementation</label>
                            <label for="major">
                                <input type="radio" name="revision" id="major" value="Action-Item">
                                Action Item

                            </label>
                            <label for="minor">
                                <input type="radio" name="revision" id="minor">
                                Extention
                            </label>

                            <label for="minor">
                                <input type="radio" name="revision" id="minor">
                                New Document
                            </label>


                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        <button type="submit">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Example Blade View -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    @if (session()->has('errorMessages'))
        <script>
            // Create an array to hold all the error messages
            var errorMessages = @json(session()->get('errorMessages'));

            // Show the sweetAlert with the error messages

            Swal.fire({
                icon: '',
                title: 'Validation Error',
                html: errorMessages,

                showCloseButton: true, // Display a close button
                customClass: {
                    title: 'my-title-class', // Add a custom CSS class to the title
                    htmlContainer: 'my-html-class text-danger', // Add a custom CSS class to the popup content
                },
                confirmButtonColor: '#3085d6', // Customize the confirm button color
            });
        </script>
        @php session()->forget('errorMessages'); @endphp
    @endif
    <script>
        $(document).ready(function() {
            $('#add-input').click(function() {
                var lastInput = $('.bar input:last');
                var newInput = $('<input type="text" name="review_comment">');
                lastInput.after(newInput);
            });
        });
    </script>
     <script>
            document.addEventListener('DOMContentLoaded', function () {
                const removeButtons = document.querySelectorAll('.remove-file');

                removeButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const fileName = this.getAttribute('data-file-name');
                        const fileContainer = this.closest('.file-container');

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

@endsection
