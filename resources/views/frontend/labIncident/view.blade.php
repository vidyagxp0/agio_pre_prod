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

    @php
        $users = DB::table('users')->get();
    @endphp

    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($data->division_id) }} / Lab Incident
        </div>
    </div>

    {{-- ---------------------- --}}
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
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                        <button class="button_theme1"> <a class="text-white"
                                href="{{ route('audittrialLabincident', $data->id) }}"> Audit Trail </a> </button>

                        @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                        @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Incident Review Completed
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancellation Request
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Request More Info
                            </button>
                        @elseif($data->stage == 3 && (in_array(10, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Investigation Completed
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Request More Info
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                        @elseif($data->stage == 4 && (in_array(10, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                All Activities Completed
                            </button>
                        @elseif($data->stage == 5 && (in_array(10, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Further Investigation Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button>
                        @elseif($data->stage == 6 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Return To Pending CAPA
                            </button>
                        @elseif($data->stage == 7 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA Head Approval Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Return to QA Review
                            </button>
                            <!-- <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit
                                </a> </button> -->
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
                                <div class="active">Pending Incident Review </div>
                            @else
                                <div class="">Pending Incident Review</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="active">Pending Investigation</div>
                            @else
                                <div class="">Pending Investigation</div>
                            @endif

                            @if ($data->stage >= 4)
                                <div class="active">Pending Activity Completion</div>
                            @else
                                <div class="">Pending Activity Completion</div>
                            @endif
                            @if ($data->stage >= 5)
                                <div class="active">Pending CAPA</div>
                            @else
                                <div class="">Pending CAPA</div>
                            @endif
                            @if ($data->stage >= 6)
                                <div class="active">Pending QA Review</div>
                            @else
                                <div class="">Pending QA Review</div>
                            @endif
                            @if ($data->stage >= 7)
                                <div class="active">Pending QA Head Approval Complete</div>
                            @else
                                <div class="">Pending QA Head Approval Complete</div>
                            @endif
                            @if ($data->stage >= 8)
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

    </div>
    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Immediate Actions</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Extension</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Incident Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Investigation Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">CAPA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">QA Head/Designee Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">System Suitability Failure Inicidence</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm11')">Closure</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Activity Log</button>
            </div>

            <form action="{{ route('LabIncidentUpdate', $data->id) }}" method="post" enctype="multipart/form-data">
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
                                            value="{{ Helpers::getDivisionName($data->division_id) }}/LI/{{ Helpers::year($data->created_at) }}/{{ $data->record }}">
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input readonly type="text" name="division_code" value="{{ Helpers::getDivisionName($data->division_id) }}">
                                        {{-- <div class="static">QMS-North America</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" name="division_code"
                                            value="{{ $data->initiator_name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        <input disabled type="text" name="intiation_date"
                                         value="{{ Helpers::getdateFormat($data->intiation_date)}}" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                            <option value="">Select a value</option>
                                            @foreach ($users as $key=> $value)
                                                <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                             
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due"> Due Date</label>
                                        <div><small class="text-primary">Please mention expected date of completion</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly
                                                placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->due_date) }}" {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : ''}}/>
                                            <input type="date" name="due_date" {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : ''}}  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                    </div>
                                </div>  
                                
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group"><b>Initiator Group</b></label>
                                        <select name="Initiator_Group" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                             id="initiator_group">
                                            <option value="Corporate Quality Assurance"
                                                @if ($data->Initiator_Group== 'Corporate Quality Assurance') selected @endif>Corporate
                                                Quality Assurance</option>
                                            <option value="QAB"
                                                @if ($data->Initiator_Group== 'QAB') selected @endif>Quality
                                                Assurance Biopharma</option>
                                            <option value="CQC"
                                                @if ($data->Initiator_Group== 'CQC') selected @endif>Central
                                                Quality Control</option>
                                            <option value="CQC"
                                                @if ($data->Initiator_Group== 'MANU') selected @endif>Manufacturing
                                            </option>
                                            <option value="PSG"
                                                @if ($data->Initiator_Group== 'PSG') selected @endif>Plasma
                                                Sourcing Group</option>
                                            <option value="CS"
                                                @if ($data->Initiator_Group== 'CS') selected @endif>Central
                                                Stores</option>
                                            <option value="ITG"
                                                @if ($data->Initiator_Group== 'ITG') selected @endif>Information
                                                Technology Group</option>
                                            <option value="MM"
                                                @if ($data->Initiator_Group== 'MM') selected @endif>Molecular
                                                Medicine</option>
                                            <option value="CL"
                                                @if ($data->Initiator_Group== 'CL') selected @endif>Central
                                                Laboratory</option>
                                            <option value="TT"
                                                @if ($data->Initiator_Group== 'TT') selected @endif>Tech
                                                team</option>
                                            <option value="QA"
                                                @if ($data->Initiator_Group== 'QA') selected @endif>Quality
                                                Assurance</option>
                                            <option value="QM"
                                                @if ($data->Initiator_Group== 'QM') selected @endif>Quality
                                                Management</option>
                                            <option value="IA"
                                                @if ($data->Initiator_Group== 'IA') selected @endif>IT
                                                Administration</option>
                                            <option value="ACC"
                                                @if ($data->Initiator_Group== 'ACC') selected @endif>Accounting
                                            </option>
                                            <option value="LOG"
                                                @if ($data->Initiator_Group== 'LOG') selected @endif>Logistics
                                            </option>
                                            <option value="SM"
                                                @if ($data->Initiator_Group== 'SM') selected @endif>Senior
                                                Management</option>
                                            <option value="BA"
                                                @if ($data->Initiator_Group== 'BA') selected @endif>Business
                                                Administration</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiator Group Code</label>
                                        <input type="text" id="initiator_group_code"  name="initiator_group_code" value="{{$data->Initiator_Group}}" readonly>
                                    </div>
                                </div>
                               
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        
                                        <textarea name="short_desc"   id="docname" type="text"    maxlength="255" required  {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->short_desc }}</textarea>
                                    </div>
                                    <p id="docnameError" style="color:red">**Short Description is required</p>

                                </div>

                                 {{-- Table --}}
                           



                        <div class="col-12">
                            <div class="group-input">
                                <label for="Material Details">
                                    Incident Investigation Report<button type="button" name="ann" id="">+</button>
                                </label>
                                <table class="table table-bordered" id="">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Name of Product</th>
                                            <th>B No./A.R. No.</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="serial_number[]"></td>
                                           </td>
                                              <td><input type="text" name="Name_of_the_product[]" >                                             
                                            <td><input type="text" name="B_no_AR_no[]"
                                                />
                                            </td>
                                             <td><input type="text" name="GI_remark[]" >
                                             </td>
                                        </tr>
                                     </tbody>
                                </table>
                            </div>
                        </div>


                        {{-- Table --}} 

                        {{-- New Added --}}
                        <div class="col-lg-12">
                            <div class="group-input" id="Incident_invlvolved_others">
                                <label for="Incident_Involved">Instrument Involved<span
                                        class="text-danger d-none">*</span></label>
                                <textarea name="Incident_involved_others"></textarea>
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="group-input" id="Incident_stage">
                                <label for="Incident_stage">Stage<span
                                        class="text-danger d-none">*</span></label>
                                <input type="text" name="stage_stage">
                            </div>

                        </div><br>

                        <div class="col-lg-4">
                            <div class="group-input" id="Incident_stability_cond">
                                <label for="Incident_stability_cond">Stability Condition (If Applicable)<span
                                        class="text-danger d-none">*</span></label>
                                <input type="text" name="Incident_stability_cond">
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="group-input" id="Incident_interval_others">
                                <label for="Incident_interval_others">Interval (If Applicable)<span
                                        class="text-danger d-none">*</span></label>
                                <input type="text" name="Incident_interval_others">
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="group-input" id="Incident_test_others">
                                <label for="Incident_test_others">Test<span
                                        class="text-danger d-none">*</span></label>
                                <input type="text" name="test_gi">
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" id="Incident_date_analysis">
                                <label for="Incident_date_analysis">Date Of Analysis<span
                                        class="text-danger d-none">*</span></label>
                                <input type="date" name="Incident_date_analysis">
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="group-input" id="Incident_specification_no">
                                <label for="Incident_specification_no">Specification Number<span
                                        class="text-danger d-none">*</span></label>
                                <input type="text" name="Incident_specification_no">
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" id="Incident_stp_no">
                                <label for="Incident_stp_no">STP Number<span
                                        class="text-danger d-none">*</span></label>
                                <input type="text" name="Incident_stp_no">
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="group-input" id="Incident_name_analyst_no">
                                <label for="Incident_name_analyst_no">Name Of Analyst<span
                                        class="text-danger d-none">*</span></label>
                                <input type="text" name="Incident_name_analyst_no">
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="group-input" id="Incident_date_incidence">
                                <label for="Incident_date_incidence">Date Of Incidence<span
                                        class="text-danger d-none">*</span></label>
                                <input type="date" name="Incident_date_incidence">
                            </div>

                        </div>

                        <div class="col-lg-12">
                            <div class="group-input" id="Description_incidence">
                                <label for="Description_incidence"> Description Of Incidence<span
                                        class="text-danger d-none">*</span></label>
                                <textarea name="Description_incidence"></textarea>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" id="analyst_sign_date">
                                <label for="analyst_sign_date">Analyst Sign Date<span
                                        class="text-danger d-none">*</span></label>
                                <input type="date" name="analyst_sign_date">
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="group-input" id="section_sign_date">
                                <label for="section_sign_date">Section Head Sign Date<span
                                        class="text-danger d-none">*</span></label>
                                <input type="date" name="section_sign_date">
                            </div>

                        </div>

                                 {{-- New Added --}}
                        



                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="severity-level">Severity Level</label>
                                        <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span>
                                        <select name="severity_level2"{{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }} >
                                            <option value="0">-- Select --</option>
                                            <option @if ($data->severity_level2=='minor') selected @endif  value="minor">Minor</option>
                                            <option @if ($data->severity_level2=='major') selected @endif value="major">Major</option>
                                            <option @if ($data->severity_level2=='critical') selected @endif value="critical">Critical</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- <div class="col-lg-6">
                             <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date of Occurance">Date of Occurance</label>
                                        <input type="date" name="occurance_date" value="{{ $data->occurance_date }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Due Date">Due Date</label>
                                        <input type="date" name="due_date" value="{{ $data->due_date }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Assigned to">Assigned to</label>
                                        <select name="assigend">
                                            @foreach($users as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> 
                                </div>-->
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Incident Category">Incident Category</label>
                                        <select {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }} name="Incident_Category">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="Biological" @if ($data->Incident_Category== 'Biological') selected @endif>
                                                Biological
                                            </option>
                                            <option value="Chemical" @if ($data->Incident_Category== 'Chemical') selected @endif>
                                                Chemical
                                            </option>
                                            <option value="Others" @if ($data->Incident_Category== 'Others') selected @endif>
                                                Others
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                            <div class="group-input" id="initiated_through_req1">
                                                <label for="Incident_Category_others">Others<span
                                                        class="text-danger d-none">*</span></label>
                                                <textarea name="Incident_Category_others" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->Incident_Category_others }}</textarea>
                                            </div>
                                        </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Invocation Type">Invocation Type</label>
                                        <select  name="Invocation_Type" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1" @if ($data->Invocation_Type== '1') selected @endif>1
                                            </option>
                                            <option value="2" @if ($data->Invocation_Type== '2') selected @endif>2
                                            </option>
                                            <option value="3" @if ($data->Invocation_Type== '3') selected @endif>3
                                            </option>
                                        </select>
                                    </div>
                                </div>
                             
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Initial Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                            value="{{ $data->Initial_Attachment }}"> --}}
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="Initial_Attachment">
                                                    @if ($data->Initial_Attachment)
                                                    @foreach (json_decode($data->Initial_Attachment) as $file)
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
                                                    <input {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }} type="file" id="myfile" name="Initial_Attachment[]"
                                                        oninput="addMultipleFiles(this, 'Initial_Attachment')" multiple>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Immediate_action">Immediate Action</label>
                                        <textarea name="immediate_action"></textarea>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="group-input" id="immediate_date_ia">
                                        <label for="immediate_date_ia">Analyst Sign/Date<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="date" name="immediate_date_ia">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="section_date_ia">
                                        <label for="section_date_ia">Section Head Sign/Date<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="date" name="section_date_ia">
                                    </div>
                                </div>
                               <div class="col-12">
                                <div class="group-input">
                                    <label for="detail investigation ">Detail Investigation / Probable Root Cause</label>
                                <textarea name="details_investigation"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="proposed corrective action ">Proposed Corrective Action/Corrective Action Taken</label>
                            <textarea name="proposed_correctivei_ia"></textarea>
                        </div>
                     </div>
                
                    
                     <div class="col-12">
                        <div class="group-input">
                            <label for="Repeat Analysis Plan ">Repeat Analysis Plan</label>
                        <textarea name="repeat_analysis_plan"></textarea>
                      </div>
                         </div>


                          {{-- selection field --}}
                
                          <div class="col-md-4">
                            <div class="group-input">
                                <label for="search">
                                    Investigator(QC) <span class="text-danger"></span>
                                </label>
                                <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                    <option value="">Select a value</option>
                                    @foreach ($users as $key=> $value)
                                        <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @error('assign_to')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="group-input">
                                <label for="search">
                                    QC Review <span class="text-danger"></span>
                                </label>
                                <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                    <option value="">Select a value</option>
                                    @foreach ($users as $key=> $value)
                                        <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @error('assign_to')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="group-input">
                                <label for="search">
                                QC Approved By <span class="text-danger"></span>
                                </label>
                                <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                    <option value="">Select a value</option>
                                    @foreach ($users as $key=> $value)
                                        <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @error('assign_to')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div> 
                {{-- selection field --}}
                <div class="col-12">
                    <div class="group-input">
                        <label for="Result Of Repeat Analysis ">Result Of Repeat Analysis</label>
                    <textarea name="result_of_repeat_analysis"></textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Corrective and Preventive Action">Corrective and Preventive Action</label>
                <textarea name="corrective_and_preventive_action"></textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="group-input">
                <label for="CAPA Number">CAPA Number</label>
            <input type="text" name="capa_number_im">
        </div>
         </div>

         <div class="col-12">
            <div class="group-input">
                <label for="Investigation Summary">Investigation Summary</label>
            <textarea name="investigation_summary"></textarea>
        </div>
    </div>



    {{-- type of incidence --}}

    <div class="col-lg-12">
        <div class="group-input">
            <label for="Type Of Incidence"><b>Type Of Incidence</b></label>
            <select name="Initiator_Group" id="initiator_group">
                <option value="0">-- Select --</option>
                <option value="Analyst Error">Analyst Error</option>
                <option value="Instrument Error">Instrument Error</option>
                <option value="Atypical Error">Atypical Error</option>
              
            </select>
        </div>
    </div>
    {{-- type of incidence --}}

    
                {{-- selection field --}}
                
                <div class="col-md-4">
                    <div class="group-input">
                        <label for="search">
                            Investigator(QC) <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                            <option value="">Select a value</option>
                            @foreach ($users as $key=> $value)
                                <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        @error('assign_to')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="group-input">
                        <label for="search">
                            QC Review <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                            <option value="">Select a value</option>
                            @foreach ($users as $key=> $value)
                                <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        @error('assign_to')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="group-input">
                        <label for="search">
                            QC Approved By <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                            <option value="">Select a value</option>
                            @foreach ($users as $key=> $value)
                                <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        @error('assign_to')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- selection field --}}
                

                               
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Attachments">Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Attachments"> --}}
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Attachments"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Attachments[]"
                                                    oninput="addMultipleFiles(this, 'Attachments')" multiple>
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

                     {{-- extension --}}
                     <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                         <div class="row">
                             <div class="group-input">
                                 <div class="col-12 sub-head">
                                     First Extension
                                 </div>
 
                             </div>
 
                             <div class="col-12">
                                 <div class="group-input">
                                     <label for="Incident Details">Reason For Extension</label>
                                     <textarea name="reasoon_for_extension"></textarea>
                                 </div>
                             </div>
 
                             <div class="col-6">
                                 <div class="group-input">
                                 <label for="extension date">Extension Date (if required)</label>
                                 <input type="date" name="extension_date" id="extension_date">
                                 </div>
                             </div>
                                
                             <div class="col-6">
                                 <div class="group-input">
                                 <label for="extension date">Extension Initiator Date</label>
                                 <input type="date" name="extension_date" id="extension_date">
                                 </div>
                             </div>
                             {{-- person field --}}
 
                             <div class="col-md-6">
                                <div class="group-input">
                                    <label for="search">
                                        Extension HOD <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                        <option value="">Select a value</option>
                                        @foreach ($users as $key=> $value)
                                            <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('assign_to')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="search">
                                        Extension Approved By <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                        <option value="">Select a value</option>
                                        @foreach ($users as $key=> $value)
                                            <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('assign_to')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                             
                           
                             
 
 
                           </div>
                           <div class="row">
                                <div class="group-input">
                                      <div class="col-12 sub-head">
                                    Second Extension
                                    </div>
                                </div>
                              <div class="col-12">
                                  <div class="group-input">
                                 <label for="reason for extension sc">Reason For Extension</label>
                                 <textarea name="reasoon_for_extension_sc"></textarea>
                                 </div>
                              </div>
 
                           
                              <div class="col-6">
                                 <div class="group-input">
                                  <label for="extension date">Extension Date (if required)</label>
                                   <input type="date" name="extension_date__sc" id="extension_date__sc">
                                 </div>
                              </div>
                            
                                 <div class="col-6">
                                     <div class="group-input">
                                     <label for="extension date">Extension Initiator Date</label>
                                     <input type="date" name="extension_date_idsc" id="extension_date_idsc">
                                     </div>
                                 </div>
 
                                                {{-- person field --}}

                                                <div class="col-md-6">
                                                    <div class="group-input">
                                                        <label for="search">
                                                            Extension HOD <span class="text-danger"></span>
                                                        </label>
                                                        <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                                            <option value="">Select a value</option>
                                                            @foreach ($users as $key=> $value)
                                                                <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('assign_to')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="group-input">
                                                        <label for="search">
                                                            Extension Approved By <span class="text-danger"></span>
                                                        </label>
                                                        <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                                            <option value="">Select a value</option>
                                                            @foreach ($users as $key=> $value)
                                                                <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('assign_to')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                           </div>
 
                           {{-- third section --}}
 
                           <div class="row">
                             <div class="group-input">
                                   <div class="col-12 sub-head">
                                 Third Extension
                                 </div>
                             </div>
                           <div class="col-12">
                               <div class="group-input">
                              <label for="reason for extension tc">Reason For Extension</label>
                              <textarea name="reasoon_for_extension_tc"></textarea>
                              </div>
                           </div>
 
                        
                           <div class="col-6">
                              <div class="group-input">
                               <label for="extension date">Extension Date (if required)</label>
                                <input type="date" name="extension_date__tc" id="extension_date__tc">
                              </div>
                           </div>
                         
                              <div class="col-6">
                                  <div class="group-input">
                                  <label for="extension date">Extension Initiator Date</label>
                                  <input type="date" name="extension_date_idtc" id="extension_date_idtc">
                                  </div>
                              </div>
                                    {{-- person field --}}
 
                                    <div class="col-md-4">
                                        <div class="group-input">
                                            <label for="search">
                                                Extension Approved By QA <span class="text-danger"></span>
                                            </label>
                                            <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                                <option value="">Select a value</option>
                                                @foreach ($users as $key=> $value)
                                                    <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('assign_to')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="group-input">
                                            <label for="search">
                                                Extension Approved By CQA <span class="text-danger"></span>
                                            </label>
                                            <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                                <option value="">Select a value</option>
                                                @foreach ($users as $key=> $value)
                                                    <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('assign_to')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                        </div>
                        <div class="col-12">
                         <div class="group-input">
                             <label for="Attachments">Extension Attachments</label>
                             <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                             <div class="file-attachment-field">
                                 <div class="file-attachment-list" id="extension_attachments"></div>
                                 <div class="add-btn">
                                     <div>Add</div>
                                     <input type="file" id="myfile" name="extension_attachments[]"
                                         oninput="addMultipleFiles(this, 'extension_attachments')" multiple>
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
                   
                   
                   
                   
                   
                    <!-- Incident Details content -->
                    <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Incident Details">Incident Details</label>
                                        <textarea name="Incident_Details" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->Incident_Details }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Document Details ">Document Details</label>
                                        <textarea name="Document_Details" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->Document_Details }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Instrument Details">Instrument Details</label>
                                        <textarea name="Instrument_Details" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->Instrument_Details }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Involved Personnel">Involved Personnel</label>
                                        <textarea name="Involved_Personnel" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->Involved_Personnel }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Product Details,If Any">Product Details,If Any</label>
                                        <textarea name="Product_Details" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->Product_Details }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Supervisor Review Comments">Supervisor Review Comments</label>
                                        <textarea name="Supervisor_Review_Comments" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->Supervisor_Review_Comments }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Attachments">Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Attachments" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                            value="{{ $data->Attachments }}"> --}}
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="Attachments">
                                                    @if ($data->Attachments)
                                                    @foreach (json_decode($data->Attachments) as $file)
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
                                                    <input {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }} type="file" id="myfile" name="Attachments[]"
                                                        oninput="addMultipleFiles(this, 'Attachments')" multiple>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                {{-- <div class="col-12 sub-head">
                                    Cancelation
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Cancelation Remarks">Cancelation Remarks</label>
                                        <textarea name="Cancelation_Remarks" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->Cancelation_Remarks }}</textarea>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- Investigation Details content -->
                    <div id="CCForm9" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                {{-- <div class="col-12 sub-head">
                                    Questionnaire
                                </div>  --}}
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="INV Questionnaire">INV Questionnaire</label>
                                        <div class="static">Question datafield</div>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">Inv Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Inv_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                            value="{{ $data->Inv_Attachment }}"> --}}
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="Inv_Attachment">
                                                    @if ($data->Inv_Attachment)
                                                    @foreach (json_decode($data->Inv_Attachment) as $file)
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
                                                    <input {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }} type="file" id="myfile" name="Inv_Attachment[]"
                                                        oninput="addMultipleFiles(this, 'Inv_Attachment')" multiple>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Investigation Details ">Investigation Details</label>
                                        <textarea name="Investigation_Details" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->Investigation_Details }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Action Taken">Action Taken</label>
                                        <textarea name="Action_Taken" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->Action_Taken }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Root Cause">Root Cause</label>
                                        <textarea name="Root_Cause" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->Root_Cause }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- CAPA content -->
                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Currective Action">Corrective Action</label>
                                        <textarea name="Currective_Action" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->Currective_Action }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Preventive Action">Preventive Action</label>
                                        <textarea name="Preventive_Action" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->Preventive_Action }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Corrective & Preventive Action">Corrective & Preventive Action</label>
                                        <textarea name="Corrective_Preventive_Action" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->Corrective_Preventive_Action }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="CAPA Attachments">CAPA Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="CAPA_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                            value="{{ $data->CAPA_Attachment }}"> --}}
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="CAPA_Attachment">
                                                    @if ($data->CAPA_Attachment)
                                                    @foreach (json_decode($data->CAPA_Attachment) as $file)
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
                                                    <input {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }} type="file" id="myfile" name="CAPA_Attachment[]"
                                                        oninput="addMultipleFiles(this, 'CAPA_Attachment')" multiple>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- QA Review content -->
                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Review Comments">QA Review Comments</label>
                                        <textarea name="QA_Review_Comments" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->QA_Review_Comments }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Head Attachments">QA Head Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="QA_Head_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}
                                            value="{{ $data->QA_Head_Attachment }}"> --}}
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="QA_Head_Attachment">
                                                    @if ($data->QA_Head_Attachment)
                                                    @foreach (json_decode($data->QA_Head_Attachment) as $file)
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
                                                    <input {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }} type="file" id="myfile" name="QA_Head_Attachment[]"
                                                        oninput="addMultipleFiles(this, 'QA_Head_Attachment')" multiple>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- QA Head/Designee Approval content -->
                    <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12 sub-head">
                                    Closure
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Head/Designee Comments">QA Head/Designee Comments</label>
                                        <textarea name="QA_Head" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{ $data->QA_Head }}</textarea>
                                    </div>
                                </div>
                            <div class="col-lg-6">
                                    <!-- <div class="group-input">
                                        <label for="Effectiveness Check required?">Effectiveness Check
                                            required?</label>
                                        <select name="Effectiveness_Check" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="yes" @if ($data->Effectiveness_Check == 'yes') selected @endif>yes
                                            </option>
                                            <option value="no" @if ($data->Effectiveness_Check == 'no') selected @endif>no
                                            </option>
                                        </select>
                                    </div> -->
                                </div> 
                                <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Effect.Chesk Creation Date">Effect.Chesk Creation Date</label>
                                        <input type="date" name="effect_check_date" {{ $data->stage == 0 || $data->stage == 8 ? "readonly" : "" }}
                                            value="{{ $data->effect_check_date }}">
                                    </div>
                                </div>  -->
                                 <!-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Effectiveness Check Creation Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="effectivess_check_creation_date" readonly
                                                placeholder="DD-MMM-YYYY" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }} value="{{ Helpers::getdateFormat($data->effectivess_check_creation_date) }}"/>
                                            <input type="date" name="effectivess_check_creation_date"  value="{{ $data->effectivess_check_creation_date }} "class="hide-input"
                                                oninput="handleDateInput(this, 'effectivess_check_creation_date')" />
                                        </div>
                                    </div> 
                                </div>  -->
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Incident Type">Incident Type</label>
                                        <select name="Incident_Type" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1" @if ($data->Incident_Type == '1') selected @endif>Type
                                                A
                                            </option>
                                            <option value="2" @if ($data->Incident_Type == '2') selected @endif>Type
                                                B
                                            </option>
                                            <option value="3" @if ($data->Incident_Type == '3') selected @endif>Type
                                                c
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Conclusion">Conclusion</label>
                                        <textarea name="Conclusion"{{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }} >{{ $data->Conclusion }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 sub-head">
                                    Extension Justification
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="due_date_extension">Due Date Extension Justification</label>
                                        <div><small class="text-primary">Please Mention justification if due date is crossed</small></div>
                                        <span id="rchar">240</span>
                                        characters remaining
                                        <textarea name="due_date_extension" id="duedoc" type="text"    maxlength="240"{{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>{{$data->due_date_extension}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div>
                    
                    {{-- System Suitability Failure Inicidence --}}

                    <div id="CCForm10" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                                <div class="row">
                                                             {{-- Table --}}


                                                             <div class="col-12">
                                                                <div class="group-input">
                                                                    <label for="Material Details">
                                                                        System Suitability Failure Incidence<button type="button" name="ann" id="">+</button>
                                                                    </label>
                                                                    <table class="table table-bordered" id="">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Sr. No.</th>
                                                                                <th>Name of Product</th>
                                                                                <th>B No./A.R. No.</th>
                                                                                <th>Remarks</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><input type="text" name="serial_number[]"></td>
                                                                               </td>
                                                                                  <td><input type="text" name="Name_of_the_product[]" >                                             
                                                                                <td><input type="text" name="B_no_AR_no[]"
                                                                                    />
                                                                                </td>
                                                                                 <td><input type="text" name="GI_remark[]" >
                                                                                 </td>
                                                                            </tr>
                                                                         </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            
                                    
                                    




                            
                            {{-- Table --}} 
    
    
                                                            {{-- New Added --}}
                                                            <div class="col-lg-12">
                                                                <div class="group-input" id="Incident_invlvolved_others">
                                                                    <label for="Incident_Involved">Instrument Involved<span
                                                                            class="text-danger d-none">*</span></label>
                                                                    <textarea name="involved_ssfi"></textarea>
                                                                </div>
                            
                                                            </div>
                            
                                                            
                                                            <div class="col-lg-4">
                                                                <div class="group-input" id="Incident_stage">
                                                                    <label for="Incident_stage">Stage<span
                                                                            class="text-danger d-none">*</span></label>
                                                                    <input type="text" name="stage_stage_ssfi">
                                                                </div>
                            
                                                            </div><br>
                                                            <div class="col-lg-4">
                                                                <div class="group-input" id="Incident_stability_cond">
                                                                    <label for="Incident_stability_cond">Stability Condition (If Applicable)<span
                                                                            class="text-danger d-none">*</span></label>
                                                                    <input type="text" name="Incident_stability_cond_ssfi">
                                                                </div>
                            
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="group-input" id="Incident_interval_others">
                                                                    <label for="Incident_interval_others">Interval (If Applicable)<span
                                                                            class="text-danger d-none">*</span></label>
                                                                    <input type="text" name="Incident_interval_ssfi">
                                                                </div>
                            
                                                            </div>
                                                            
                                                            <div class="col-lg-6">
                                                                <div class="group-input" id="Incident_test_others">
                                                                    <label for="Incident_test_others">Test<span
                                                                            class="text-danger d-none">*</span></label>
                                                                    <input type="text" name="test_ssfi">
                                                                </div>
                            
                                                            </div>
                            
                                                             
                                                            <div class="col-lg-6">
                                                                <div class="group-input" id="Incident_date_analysis">
                                                                    <label for="Incident_date_analysis">Date Of Analysis<span
                                                                            class="text-danger d-none">*</span></label>
                                                                    <input type="date" name="Incident_date_analysis_ssfi">
                                                                </div>
                            
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="group-input" id="Incident_specification_no">
                                                                    <label for="Incident_specification_no">Specification Number<span
                                                                            class="text-danger d-none">*</span></label>
                                                                    <input type="text" name="Incident_specification_ssfi">
                                                                </div>
                            
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="group-input" id="Incident_stp_no">
                                                                    <label for="Incident_stp_no">STP Number<span
                                                                            class="text-danger d-none">*</span></label>
                                                                    <input type="text" name="Incident_stp_ssfi">
                                                                </div>
                            
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="group-input">
                                                                    <label for="search">
                                                                        Name Of Analyst<span class="text-danger"></span>
                                                                    </label>
                                                                    <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                                                        <option value="">Select a value</option>
                                                                        @foreach ($users as $key=> $value)
                                                                            <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('assign_to')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-lg-4">
                                                                <div class="group-input">
                                                                    <label for="search">
                                                                        Name Of Analyst <span class="text-danger"></span>
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
                                                            <div class="col-lg-4">
                                                                <div class="group-input" id="Incident_date_incidence">
                                                                    <label for="Incident_date_incidence">Date Of Incidence<span
                                                                            class="text-danger d-none">*</span></label>
                                                                    <input type="date" name="Incident_date_incidence_ssfi">
                                                                </div>
                            
                                                            </div>



                                                            <div class="col-md-4">
                                                                <div class="group-input">
                                                                    <label for="search">
                                                                        QC Reviewer<span class="text-danger"></span>
                                                                    </label>
                                                                    <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                                                        <option value="">Select a value</option>
                                                                        @foreach ($users as $key=> $value)
                                                                            <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('assign_to')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
   
                                                            <div class="col-lg-12">
                                                                <div class="group-input" id="Description_incidence">
                                                                    <label for="Description_incidence"> Description Of Incidence<span
                                                                            class="text-danger d-none">*</span></label>
                                                                    <textarea name="Description_incidence_ssfi"></textarea>
                                                                </div>
                            
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="group-input" id="Detail_investigation">
                                                                    <label for="Detail_investigation"> Detail Investigation<span
                                                                            class="text-danger d-none">*</span></label>
                                                                    <textarea name="Detail_investigation_ssfi"></textarea>
                                                                </div>
                            
                                                            </div>
    
                                                            <div class="col-lg-12">
                                                                <div class="group-input" id="proposed corrective">
                                                                    <label for="Detail_investigation"> Proposed Corrective Action<span
                                                                            class="text-danger d-none">*</span></label>
                                                                    <textarea name="proposed_corrective_ssfi"></textarea>
                                                                </div>
                            
                                                            </div>
    
                                                            <div class="col-lg-12">
                                                                <div class="group-input" id="root cause">
                                                                    <label for="root_cause"> Root Cause<span
                                                                            class="text-danger d-none">*</span></label>
                                                                    <textarea name="root_cause"></textarea>
                                                                </div>
                            
                                                            </div>
    
                                                            <div class="col-lg-12">
                                                                <div class="group-input" id="incident summary ssfi">
                                                                    <label for="incident summary ssfi"> Incident Summary<span
                                                                            class="text-danger d-none">*</span></label>
                                                                    <textarea name="incident_summary_ssfi"></textarea>
                                                                </div>
                            
                                                            </div>
    
                                                            
                                    <div class="col-md-4">
                                        <div class="group-input">
                                            <label for="search">
                                                QC Reviewer <span class="text-danger"></span>
                                            </label>
                                            <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>
                                                <option value="">Select a value</option>
                                                @foreach ($users as $key=> $value)
                                                    <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('assign_to')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                                        {{-- <div class="col-md-6">
                                                            <div class="group-input">
                                                                  <label for="search">
                                                              Reviewed By(QC) <span class="text-danger"></span>
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
                                                    <div class="col-lg-12">
                                                        <div class="group-input">
                                                            <label for="system_suitable_attachments">File Attachment</label>
                                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                            {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                                            <div class="file-attachment-field">
                                                                <div class="file-attachment-list" id="incident_initial_Attachment"></div>
                                                                <div class="add-btn">
                                                                    <div>Add</div>
                                                                    <input type="file" id="myfile" name="system_suitable_attachments[]"
                                                                        oninput="addMultipleFiles(this, 'system_suitable_attachments')" multiple>
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
    
         
                                                            
                                                            
                                                            {{-- New Added --}}
                            </div>
                        </div>
                    </div>


                                              <!-- Closure Tab -->
                <div id="CCForm11" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure_incident">Closure Of Incident</label>
                                    <input type="text" name="closure_incident_c">
                                </div>

                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="affected documents closed"><b>Affected Documents Closed</b></label>
                                    <select name="Initiator_Group" id="initiator_group" name="affected_documents_closed">
                                        <option value="0">-- Select --</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        <option value="NA">NA</option>
                                      
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="head remark"><b>QC Head Remark</b></label>
                                   <textarea name="qc_hear_remark_c"></textarea>
                                </div>
                            </div>



                            {{-- <div class="col-md-12">
                                <div class="group-input">
                                      <label for="search">
                                  QC Head <span class="text-danger"></span>
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


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for=" qa head remark"><b>QA Head Remark</b></label>
                               <textarea name="qa_hear_remark_c"></textarea>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="closure_attachments">File Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                {{-- <input type="file" id="myfile" name="Initial_Attachment"> --}}
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="closure_attachment_c"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="closure_attachment_c[]"
                                            oninput="addMultipleFiles(this, 'closure_attachment_c')" multiple>
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
            </div>
          

                    <!-- Activity Log content -->
                    <div id="CCForm7" class="inner-block cctabcontent">
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
                                        <div class="Date">{{ $data->submitted_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Incident Review Completed By">Incident Review Completed
                                            By</label>
                                        <div class="static">{{ $data->incident_review_completed_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Incident Review Completed On">Incident Review Completed
                                            On</label>
                                        <div class="Date">{{ $data->incident_review_completed_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Investigation Completed By">Investigation Completed By</label>
                                        <div class="static">{{ $data->investigation_completed_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Investigation Completed On">Investigation Completed On</label>
                                        <div class="Date">{{ $data->investigation_completed_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Review Completed By">QA Review Completed By</label>
                                        <div class="static">{{ $data->qA_review_completed_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Review Completed On">QA Review Completed On</label>
                                        <div class="Date">{{ $data->qA_review_completed_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Head Approval Completed By">QA Head Approval Completed By</label>
                                        <div class="static">{{ $data->qA_head_approval_completed_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA Head Approval Completed On">QA Head Approval Completed On</label>
                                        <div class="Date">{{ $data->qA_head_approval_completed_on }}</div>
                                    </div>
                                </div>
                               
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="All Activities Completed By">All Activities Completed By</label>
                                        <div class="static">{{ $data->all_activities_completed_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="All Activities Completed On">All Activities Completed On</label>
                                        <div class="Date">{{ $data->all_activities_completed_on }}</div>
                                    </div>
                                </div>
                                 <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Review Completed By">Review Completed By</label>
                                        <div class="static">{{$data->review_completed_by}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Review Completed On">Review Completed On</label>
                                        <div class="Date">{{$data->review_completed_on}}</div>
                                    </div>
                                </div> 
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancelled By">Cancelled By</label>
                                        <div class="static">{{ $data->cancelled_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancelled On">Cancelled On</label>
                                        <div class="Date">{{ $data->cancelled_on }}</div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="All Activities Completed By">All Activities Completed By</label>
                                        <div class="static">{{ $data->all_activities_completed_by }}</div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="All Activities Completed On">All Activities Completed On</label>
                                        <div class="Date">{{ $data->all_activities_completed_on }}</div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Review Completed By">Review Completed By</label>
                                        <div class="static">{{$data->review_completed_by}}</div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Review Completed On">Review Completed On</label>
                                        <div class="Date">{{$data->review_completed_on}}</div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="submit" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>Submit</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
    {{-- ----------------------modal------------- --}}

    <div class="modal fade" id="rejection-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('rcms/RejectStateChangeEsign', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username  <span
                                class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password  <span
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

    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('StageChangeLabIncident', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username  <span
                                class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password  <span
                                class="text-danger">*</span></label>
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

    

    <div class="modal fade" id="cancel-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('LabIncidentCancel', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username  <span
                                class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password  <span
                                class="text-danger">*</span></label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment  <span
                                class="text-danger">*</span></label>
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

    <div class="modal fade" id="child-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <form action="{{ route('lab_incident_root_child', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            <label for="major">
                                <input type="radio" name="revision" id="major" value="Action-Item">
                                Root Cause Analysis
                            </label>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        <button type="submit">Continue</button>
                    </div> -->
                    <div class="modal-footer">
                              <button type="submit">Submit</button>
                             <button type="button" data-bs-dismiss="modal">Close</button>                         
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
                <form action="{{ route('lab_incident_capa_child', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            <label for="major">
                                <input type="radio" name="revision" id="major" value="Action-Item">
                                CAPA
                            </label>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        <button type="submit">Continue</button>
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
        // JavaScript
        document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            document.getElementById('initiator_group_code').value = selectedValue;
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
        <script>
        var maxLength = 240;
        $('#duedoc').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchar').text(textlen);});
    </script>
@endsection
