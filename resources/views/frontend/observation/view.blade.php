@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
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
    <style>
        header .header_rcms_bottom {
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

<div class="form-field-head">
    <div class="division-bar">
        <strong>Site Division/Project</strong> : {{ Helpers::getDivisionName(session()->get('division')) }}/Observation
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
                        $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id])->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                    @endphp
                        <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button>
                        <button class="button_theme1"> <a class="text-white" href="{{ route('ShowObservationAuditTrial', $data->id) }}">
                                Audit Trail </a> </button>

                        @if ($data->stage == 1 && (in_array(12, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Report Issued
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 2 && (in_array(11, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Complete
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                        @elseif($data->stage == 3 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA Approval
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal1">
                                QA Approval Without CAPA
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Reject CAPA Plan
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                        @elseif($data->stage == 4 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))               
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                All CAPA Closed
                            </button>
                        @elseif($data->stage == 5 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Final Approval
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
                                <div class="active">Pending CAPA Plan </div>
                            @else
                                <div class="">Pending CAPA Plan</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="active">Pending Approval</div>
                            @else
                                <div class="">Pending Approval</div>
                            @endif

                            @if ($data->stage >= 4)
                                <div class="active">CAPA Execution in Progress</div>
                            @else
                                <div class="">CAPA Execution in Progress</div>
                            @endif


                            @if ($data->stage >= 5)
                                <div class="active">Pending Final Approval</div>
                            @else
                                <div class="">Pending Final Approval</div>
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
       <script>
        $(document).ready(function() {
            $('#observation_table').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                    '<tr>' +
                        '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                        '<td><input type="text" name="action[]"></td>' +
                        '<td><select name="responsible[]">' +
                            '<option value="">Select a value</option>';

                        for (var i = 0; i < users.length; i++) {
                            html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                        }

                        html += '</select></td>' +
                        // '<td><input type="date" name="deadline[]"></td>' +
                                                '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="deadline' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="deadline[]" class="hide-input" oninput="handleDateInput(this, `deadline' + serialNumber +'`)" /></div></div></div></td>' +

                        '<td><input type="text" name="item_status[]"></td>' +
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
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Observation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">CAPA Plan</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Impact Analysis</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Summary</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Signatures</button>
            </div>

            <form action="{{ route('observationupdate', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div id="step-form">

                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sub-head">General Information</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input type="hidden" name="record_number">
                                        <input disabled type="text"
                                            value="{{ $data->division_code }}/OBS/{{ Helpers::year($data->created_at) }}/{{ $data->record }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input readonly type="text" name="division_code"
                                            value="{{ $data->division_code }} ">
                                        {{-- <div class="static">QMS-North America</div> --}}
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
                                        <label for="date_opened">Date of Initiation<span class="text-danger"></span></label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input  type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="assign_to1">Assigned To</label>
                                        <select name="assign_to" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $value)
                                            <option {{ $data->assign_to == $value->id ? 'selected' : '' }}
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                  <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="date_due">Date Due</label>
                                        <div class="calenderauditee">
                                            <input type="text" name="due_date" id="due_date" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <!-- <input type="date"  class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')" />
                                        <input disabled type="text"  value="{{ Helpers::getdateFormat($data->due_date) }}"> 
                                    </div>
                                </div>  
                                </div>  -->
                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="date_due">Due Date<span class="text-danger"></span></label>
                                        <div><small class="text-primary">Please mention expected date of completion</small></div>
                                        {{-- <input type="date" name="due_date"> --}}
                                        {{-- <div class="calenderauditee">
                                            <input type="text"  id="due_date" readonly
                                                placeholder="DD-MMM-YYYY" 
                                                    value="{{ Helpers::getdateFormat($data->due_date) }}" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}/>
                                            <!-- <input type="date" name="due_date" id="due_date"  class="hide-input" --}}
                                                {{-- oninput="handleDateInput(this, 'due_date');checkDate('due_date_checkdate','due_date_checkdate')" /> --> --}}
                                        {{-- </div>
                                    </div>
                                </div> --}} 
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="due-date"> Date Due <span class="text-danger"></span></label>
                                        <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small></div>
                                        <input readonly type="text"
                                            value="{{ Helpers::getdateFormat($data->due_date) }}"
                                            name="due_date"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}>
                                        {{-- <input type="text" value="{{ $data->due_date }}" name="due_date"> --}}
                                        {{-- <div class="static"> {{ $due_date }}</div> --}}

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        
                                        <textarea name="short_description"   id="docname" type="text"    maxlength="255" required  {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>{{ $data->short_description }}</textarea>
                                    </div>
                                          {{-- <p id="docnameError" style="color:red">**Short Description is required</p> --}}
                             </div>
                                        
                                {{-- <div class="col-12">
                                    <div class="sub-head">Observation Details</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="grading">Grading</label>
                                        <select name="grading" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>
                                            <option value="">-- Select --</option>
                                            <option value="1" {{ $data->grading == '1' ? 'selected' : '' }}>Recommendation</option>
                                            <option value="2" {{ $data->grading == '2' ? 'selected' : '' }}>Major</option>
                                            <option value="3" {{ $data->grading == '3' ? 'selected' : '' }}>Minor</option>
                                            <option value="4" {{ $data->grading == '4' ? 'selected' : '' }}>Critical</option>
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="category_observation">Category Observation</label>
                                        <select name="category_observation" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>
                                            <option value="">-- Select --</option>
                                            <option title="Case Report Form (CRF)" value="1" {{ $data->category_observation == '1' ? 'selected' : '' }}>
                                                Case Report Form (CRF)
                                            </option>
                                            <option title="Clinical Database" value="2" {{ $data->category_observation == '2' ? 'selected' : '' }}>
                                                Clinical Database
                                            </option>
                                            <option title="Clinical Trial Protocol" value="3" {{ $data->category_observation == '3' ? 'selected' : '' }}>
                                                Clinical Trial Protocol
                                            </option>
                                            <option title="Clinical Trial Report" value="4" {{ $data->category_observation == '4' ? 'selected' : '' }}>
                                                Clinical Trial Report
                                            </option>
                                            <option title="Compliance" value="5" {{ $data->category_observation == '5' ? 'selected' : '' }}>
                                                Compliance
                                            </option>
                                            <option title="Computerized systems" value="6" {{ $data->category_observation == '6' ? 'selected' : '' }}>
                                                Computerized systems
                                            </option>
                                            <option title="Conduct of Study" value="7" {{ $data->category_observation == '7' ? 'selected' : '' }}>
                                                Conduct of Study
                                            </option>
                                            <option title="Data Accuracy / SDV" value="8" {{ $data->category_observation == '8' ? 'selected' : '' }}>
                                                Data Accuracy / SDV
                                            </option>
                                            <option title="Documentation" value="9" {{ $data->category_observation == '9' ? 'selected' : '' }}>
                                                Documentation
                                            </option>
                                            <option title="Essential Documents (TMF/ISF)" value="10" {{ $data->category_observation == '10' ? 'selected' : '' }}>
                                                Essential Documents (TMF/ISF)
                                            </option>
                                            <option title="Ethics Committee (IEC / IRB)" value="11" {{ $data->category_observation == '11' ? 'selected' : '' }}>
                                                Ethics Committee (IEC / IRB)
                                            </option>
                                            <option title="Facilities / Equipment" value="12" {{ $data->category_observation == '12' ? 'selected' : '' }}>
                                                Facilities / Equipment
                                            </option>
                                            <option title="Miscellaneous" value="13" {{ $data->category_observation == '13' ? 'selected' : '' }}>
                                                Miscellaneous
                                            </option>
                                            <option title="Monitoring" value="14" {{ $data->category_observation == '14' ? 'selected' : '' }}>
                                                Monitoring
                                            </option>
                                            <option title="Organization and Responsibilities" value="16" {{ $data->category_observation == '16' ? 'selected' : '' }}>
                                                Organization and Responsibilities
                                            </option>
                                            <option title="Periodic Safety Reporting" value="17" {{ $data->category_observation == '17' ? 'selected' : '' }}>
                                                Periodic Safety Reporting
                                            </option>
                                            <option title="Protocol Compliance" value="18" {{ $data->category_observation == '18' ? 'selected' : '' }}>
                                                Protocol Compliance
                                            </option>
                                            <option title="Qualification and Training of Staff" value="19" {{ $data->category_observation == '19' ? 'selected' : '' }}>
                                                Qualification and Training of Staff
                                            </option>
                                            <option title="Quality Management System" value="20" {{ $data->category_observation == '20' ? 'selected' : '' }}>
                                                Quality Management System
                                            </option>
                                            <option title="Regulatory Requirements" value="25" {{ $data->category_observation == '25' ? 'selected' : '' }}>
                                                Regulatory Requirements
                                            </option>
                                            <option title="Reliability of Data" value="26" {{ $data->category_observation == '26' ? 'selected' : '' }}>
                                                Reliability of Data
                                            </option>
                                            <option title="Safety Reporting" value="27" {{ $data->category_observation == '27' ? 'selected' : '' }}>
                                                Safety Reporting
                                            </option>
                                            <option title="Source Documents" value="28" {{ $data->category_observation == '28' ? 'selected' : '' }}>
                                                Source Documents
                                            </option>
                                            <option title="Subject Diary(ies)" value="29" {{ $data->category_observation == '29' ? 'selected' : '' }}>
                                                Subject Diary(ies)
                                            </option>
                                            <option title="Informed Consent Form" value="30" {{ $data->category_observation == '30' ? 'selected' : '' }}>
                                                Informed Consent Form
                                            </option>
                                            <option title="Subject Questionnaire(s)" value="31" {{ $data->category_observation == '31' ? 'selected' : '' }}>
                                                Subject Questionnaire(s)
                                            </option>
                                            <option title="Supporting Procedures" value="32" {{ $data->category_observation == '32' ? 'selected' : '' }}>
                                                Supporting Procedures
                                            </option>
                                            <option title="Test Article and Accountability" value="33" {{ $data->category_observation == '33' ? 'selected' : '' }}>
                                                Test Article and Accountability
                                            </option>
                                            <option title="Trial Master File (TMF)" value="34" {{ $data->category_observation == '34' ? 'selected' : '' }}>
                                                Trial Master File (TMF)
                                            </option>
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="reference_guideline">Referenced Guideline</label>
                                        <input type="text" name="reference_guideline" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{ $data->reference_guideline }}">
                                    </div>
                                </div> --}}
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="desc">Description</label>
                                        <textarea name="description" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} >{{ $data->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="sub-head">Further Information</div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="attach_files1">Attached Files</label>
                                        <input type="file" name="attach_files1" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}  value="{{ $data->attach_files1 }}"/>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="attach_files1">Attached Files</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="attach_files1">
                                                @if ($data->attach_files1)
                                                @foreach(json_decode($data->attach_files1) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                           @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="{{ $data->attach_files1 }}" type="file" id="myfile" name="attach_files1[]"
                                                    oninput="addMultipleFiles(this, 'attach_files1')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="capa_date_due">Recomendation Date Due for CAPA</label>
                                         <div class="calenderauditee">                                     
                                        <input type="text"  id="recomendation_capa_date_due"  readonly placeholder="DD-MMM-YYYY"  {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} 
                                        value="{{ ($data->recomendation_capa_date_due) }}"/>
                                         <input type="date" name="recomendation_capa_date_due" value="{{ $data->recomendation_capa_date_due }}"
                                        class="hide-input" 
                                        oninput="handleDateInput(this, 'recomendation_capa_date_due')"  /> 
                                        </div> 
                                    </div>
                                </div> --}}
                                 <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date ">
                                        <label for="capa_date_due">Recomendation  Due Date  for CAPA</label>
                                        <div class="calenderauditee">
                                            <input type="text" name="recomendation_capa_date_due" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  id="recomendation_capa_date_due" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->recomendation_capa_date_due) }}" />
                                            <input type="date"  class="hide-input" value="{{ Helpers::getdateFormat($data->recomendation_capa_date_due) }}" 
                                                oninput="handleDateInput(this, 'recomendation_capa_date_due')" />
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="non_compliance">Non Compliance</label>
                                        <textarea name="non_compliance" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>{{ $data->non_compliance }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="recommend_action">Recommended Action</label>
                                        <textarea name="recommend_action" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>{{ $data->recommend_action }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="related_observations">Related Obsevations</label>
                                        <input type="file" name="related_observations" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}  value="{{ $data->related_observations }}"/>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="related_observations">Related Obsevations</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="related_observations">
                                            @if ($data->related_observations)
                                            @foreach(json_decode($data->related_observations) as $file)
                                            <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                <b>{{ $file }}</b>
                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                            </h6>
                                       @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="{{ $data->related_observations }}" type="file" id="myfile" name="related_observations[]"
                                                oninput="addMultipleFiles(this, 'related_observations')"
                                                multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sub-head">CAPA Plan Details</div>
                                </div>
                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="date_Response_due1">Date Response Due1</label>
                                        <!-- <input type="date" name="date_Response_due2" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{ $data->date_Response_due2 }}"/> -->
                                        <div class="calenderauditee">                                     
                                        <input type="text" name="date_Response_due2"  id="date_Response_due"  readonly placeholder="DD-MMM-YYYY" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} 
                                        value="{{ Helpers::getdateFormat($data->date_Response_due2) }}" />
                                        {{-- <input type="date" name="date_Response_due2" value="{{ $data->date_Response_due2 }}"
                                        class="hide-input" --}}
                                        {{-- oninput="handleDateInput(this, 'date_Response_due2')" /> --}}
                                        {{-- <input type="text"  id="date_Response_due2"  readonly placeholder="DD-MMM-YYYY" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{ $data->date_Response_due2 }}" />
                                        <input type="date" name="date_Response_due2" value=""
                                        class="hide-input"
                                        oninput="handleDateInput(this, 'date_Response_due2')" />
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date ">
                                        <label for="date_Response_due1">Date Response Due </label>
                                        <div class="calenderauditee">
                                            <input type="text" name="date_Response_due22" id="date_Response_due" readonly
                                                placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->date_response_due1) }}"  />
                                            <input type="date" id="date_Response_due_checkdate" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}  value="{{ $data->date_response_due1 }}"  class="hide-input"
                                                oninput="handleDateInput(this, 'date_Response_due');checkDate('date_Response_due_checkdate','date_due_checkdate')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="date_due"> Due Date</label>
                                        <div class="calenderauditee">                                     
                                            <input type="text" name="capa_date_due11"  id="date_due"  readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->capa_date_due) }}" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} />
                                            <input type="date" id="date_due_checkdate" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="{{ $data->capa_date_due }}" class="hide-input"
                                            oninput="handleDateInput(this, 'date_due');checkDate('date_Response_due_checkdate','date_due_checkdate')" />
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="due-date">Due Date1 <span class="text-danger"></span></label>
                                        <div><small class="text-primary">Please Mention justification if due date is
                                            crossed</small></div>
                                    
                                            value="{{ Helpers::getdateFormat($data->due_date) }}"
                                            name="due_date"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}}>
                                        <input type="text" value="{{ $data->due_date }}" name="due_date">
                                        

                                    </div>
                                </div> --}}
                                 <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="assign_to2">Assigned To</label>
                                        <select name="assign_to2" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $value)
                                            <option {{ $data->assign_to2 == $value->id ? 'selected' : '' }}
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="cro_vendor">CRO/Vendor</label>
                                        <select name="cro_vendor" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>
                                            <option value="">-- Select --</option>
                                            <option title="Amit Guru" value="1" {{ $data->cro_vendor == '1' ? 'selected' : '' }}>
                                                Amit Guru
                                            </option>
                                            <option title="Shaleen Mishra" value="2" {{ $data->cro_vendor == '2' ? 'selected' : '' }}>
                                                Shaleen Mishra
                                            </option>
                                            <option title="Vikas Prajapati" value="3" {{ $data->cro_vendor == '3' ? 'selected' : '' }}>
                                                Vikas Prajapati
                                            </option>
                                            <option title="Anshul Patel" value="4" {{ $data->cro_vendor == '4' ? 'selected' : '' }}>
                                                Anshul Patel
                                            </option>
                                            <option title="Amit Patel" value="5" {{ $data->cro_vendor == '5' ? 'selected' : '' }}>
                                                Amit Patel
                                            </option>
                                            <option title="Madhulika Mishra" value="6" {{ $data->cro_vendor == '6' ? 'selected' : '' }}>
                                                Madhulika Mishra
                                            </option>
                                            <option title="Jim Kim" value="7" {{ $data->cro_vendor == '7' ? 'selected' : '' }}>
                                                Jim Kim
                                            </option>
                                            <option title="Akash Asthana" value="8" {{ $data->cro_vendor == '8' ? 'selected' : '' }}>
                                                Akash Asthana
                                            </option>
                                            <option title="Not Applicable" value="9" {{ $data->cro_vendor == '9' ? 'selected' : '' }}>
                                                Not Applicable
                                            </option>
                                            {{-- @foreach ($users as $value)
                                            <option {{ $data->cro_vendor == $value->id ? 'selected' : '' }}
                                                value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach --}}
                                        {{--</select>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="action-plan-grid">
                                            Action Plan<button type="button" name="action-plan-grid"
                                                id="observation_table"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>+</button>
                                        </label>
                                        <table class="table table-bordered" id="observation">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Action</th>
                                                    <th>Responsible</th>
                                                    <th>Deadline</th>
                                                    <th>Item Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (unserialize($griddata->action) as $key => $temps)
                                                <tr> 
                                                    <!-- <td><input type="text" name="serial_number[]" value="{{ $key+1 }}"></td> -->
                                                    <td><input disabled type="text" name="serial_number[]"  value="{{ $key+1 }}">
                                                </td>
                                                    <td><input type="text" name="action[]" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{unserialize($griddata->action)[$key] ? unserialize($griddata->action)[$key] : "" }}"></td>
                                                    {{-- <td><input type="text" name="responsible[]" value="{{unserialize($griddata->responsible)[$key] ? unserialize($griddata->responsible)[$key] : "" }}"></td> --}}
                                                    <td> <select id="select-state" placeholder="Select..."
                                                        name="responsible[]" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} >
                                                        
                                                        <option value="">-Select-</option>
                                                        @foreach ($users as $value)
                                                            <option
                                                                @if($griddata && unserialize($griddata->responsible)[$key])
                                                              {{ unserialize($griddata->responsible)[$key] == $value->id ? 'selected' : '' }}
                                                               @endif

                                                                value="{{ $value->id }}">
                                                                {{ $value->name }}
                                                            </option>
                                                        @endforeach
                                                    </select></td>
                                                    <td>
                                                    <div class="group-input new-date-data-field mb-0">
                                                        <div class="input-date ">
                                                            <div class="calenderauditee">
                                                              
                                                                <input type="text" id="deadline{{$key}}' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat(unserialize($griddata->deadline)[$key]) }}" oninput="handleDateInput(this, `deadline' + serialNumber +'`)" />
                                                                 <input type="date"  value="{{unserialize($griddata->deadline)[$key]}}" name="deadline[]" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{ Helpers::getdateFormat(unserialize($griddata->deadline)[$key]) }}" class="hide-input" 
                                                                oninput="handleDateInput(this, `deadline{{$key}}' + serialNumber +'`)" /> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td> 
                                                    <!-- <td>
                                                        <div class="group-input new-date-data-field mb-0">
                                                            <div class="input-date ">
                                                                <div class="calenderauditee">
                                                                    {{-- <input type="text" id="deadline' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /> --}}
                                                                    <input type="date" name="deadline[]" class="hide-input" 
                                                                    oninput="handleDateInput(this, `deadline' + serialNumber +'`)" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>  -->
                                                    {{-- <td><input type="text" name="deadline[]"{{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}  value="{{unserialize($griddata->deadline)[$key] ? unserialize($griddata->deadline)[$key] : "" }}"></td> --}}
                                                    {{-- <td><input type="text" name="item_status[]" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{unserialize($griddata->item_status)[$key] ? unserialize($griddata->item_status)[$key] : "" }}"></td>  --}}
                                                    <td><input type="text" name="item_status[]" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{unserialize($griddata->action)[$key] ? unserialize($griddata->action)[$key] : "" }}"></td>

                                                    {{-- <td>
    @php
    $item_status = unserialize($griddata->item_status);
    $value = isset($item_status[$key]) ? $item_status[$key] : '';
    @endphp
    <input type="text" name="item_status[]" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{ $value }}">
</td> --}}

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="comments">Comments</label>
                                        <textarea name="comments" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>{{ $data->comments }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sub-head">Impact Analysis</div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="impact">Impact</label>
                                        <select name="impact" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>
                                            <option value="">-- Select --</option>
                                            <option value="1" {{ $data->impact == '1' ? 'selected' : '' }}>High</option>
                                            <option value="2" {{ $data->impact == '2' ? 'selected' : '' }}>Medium</option>
                                            <option value="3" {{ $data->impact == '3' ? 'selected' : '' }}>Low</option>
                                            <option value="4" {{ $data->impact == '4' ? 'selected' : '' }}>None</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="impact_analysis">Impact Analysis</label>
                                        <textarea type  name="impact_analysis" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>{{ $data->impact_analysis }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="sub-head">Risk Analysis</div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Severity Rate">Severity Rate</label>
                                        <select name="severity_rate" id="analysisR" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}
                                            onchange='calculateRiskAnalysis(this)'>
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1" {{ $data->severity_rate == '1' ? 'selected' : '' }}>Negligible</option>
                                            <option value="2" {{ $data->severity_rate == '2' ? 'selected' : '' }}>Moderate</option>
                                            <option value="3" {{ $data->severity_rate == '3' ? 'selected' : '' }}>Major</option>
                                            <option value="4" {{ $data->severity_rate == '4' ? 'selected' : '' }}>Fatal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Occurrence">Occurrence</label>
                                        <select name="occurrence" id="analysisP" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} onchange='calculateRiskAnalysis(this)'>
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="5" {{ $data->occurrence == '5' ? 'selected' : '' }}>Extremely Unlikely</option>
                                            <option value="4" {{ $data->occurrence == '4' ? 'selected' : '' }}>Rare</option>
                                            <option value="3" {{ $data->occurrence == '3' ? 'selected' : '' }}>Unlikely</option>
                                            <option value="2" {{ $data->occurrence == '2' ? 'selected' : '' }}>Likely</option>
                                            <option value="1" {{ $data->occurrence == '1' ? 'selected' : '' }}>Very Likely</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Detection">Detection</label>
                                        <select name="detection" id="analysisN" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} onchange='calculateRiskAnalysis(this)'>
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="5" {{ $data->detection == '5' ? 'selected' : '' }}>Impossible</option>
                                            <option value="4" {{ $data->detection == '4' ? 'selected' : '' }}>Rare</option>
                                            <option value="3" {{ $data->detection == '3' ? 'selected' : '' }}>Unlikely</option>
                                            <option value="2" {{ $data->detection == '2' ? 'selected' : '' }}>Likely</option>
                                            <option value="1" {{ $data->detection == '1' ? 'selected' : '' }}>Very Likely</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RPN">RPN</label>
                                        <input type="text" name="analysisRPN" id="analysisRPN" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{ $data->analysisRPN }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="sub-head">Action Summary</div>
                                </div>

                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="actual_start_date">Actual Start Date</label>
                                        <div class="calenderauditee"> 
                                            <input type="text"  id="actual_start_date"  readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->actual_start_date) }}"
                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}/>
                                            <input type="date"  class="hide-input" style="display: none;"
                                                oninput="handleDateInput(this, 'recomendation_capa_date_due')" />
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="actual_end_date">Actual End Date</label>
                                        <div class="calenderauditee"> 
                                        <input type="date" name="actual_end_date" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->actual_end_date) }}"
                                         {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{ $data->actual_end_date }}">
                                    </div>
                                </div>  --}}
                            
                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="actual_end_date">Actual End Date11</label>
                                        <div class="calenderauditee"> 
                                            <input type="text"  id="actual_end_date"  readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->actual_end_date) }}"
                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}/>
                                        </div>
                                    </div>
                                 --}}
                                 <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="actual_start_date">Actual Start Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="actual_start_date" readonly
                                                placeholder="DD-MMM-YYYY"value="{{ Helpers::getdateFormat($data->actual_start_date) }}" />
                                            <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $data->actual_start_date }}"  id="actual_start_date_checkdate" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="actual_start_date" class="hide-input"
                                                oninput="handleDateInput(this, 'actual_start_date');checkDate('actual_start_date_checkdate','actual_end_date_checkdate')" />
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-lg-6  new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="actual_end_date">Actual End Date</lable>
                                        <div class="calenderauditee">
                                        <input type="text" id="actual_end_date"                             
                                                placeholder="DD-MMM-YYYY"value="{{ Helpers::getdateFormat($data->actual_end_date) }}" />
                                             <input type="date"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $data->actual_end_date }}" id="actual_end_date_checkdate" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="actual_end_date" class="hide-input"
                                                oninput="handleDateInput(this, 'actual_end_date');checkDate('actual_start_date_checkdate','actual_end_date_checkdate')" />
                                        </div>
                                   
                                        
                                    </div>
                                </div> 
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="action_taken">Action Taken</label>
                                        <textarea name="action_taken" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>{{ $data->action_taken }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="sub-head">Response Summary</div>
                                </div>
                               
                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="date_response_due1">Date Response Due</label>
                                        <div class="calenderauditee"> 
                                            <input type="text"  id="date_response_due1"  readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->date_response_due1) }}"
                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}/>
                                            <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  class="hide-input"
                                            oninput="handleDateInput(this, 'date_response_due1')" />
                                            
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="response_date">Date of Response</label>
                                        <input type="date" name="response_date" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{ $data->response_date }}">
                                    </div>
                                </div> --}}



                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="response_date">Date of Response</label>
                                        <div class="calenderauditee"> 
                                            <input type="text"  id="response_date"  readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->response_date) }}"
                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}/>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="attach_files">Attached Files</label>
                                        <input type="file" name="attach_files2" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{ $data->attach_files2 }}">
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="attach_files2">Attached Files</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="attach_files2">
                                                @if ($data->attach_files2)
                                                @foreach(json_decode($data->attach_files2) as $file)
                                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                </h6>
                                           @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} value="{{ $data->attach_files2 }}" type="file" id="myfile" name="attach_files2[]"
                                                    oninput="addMultipleFiles(this, 'attach_files2')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="related_url">Related URL</label>
                                        <input type="url" name="related_url" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }} value="{{ $data->related_url }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="response_summary">Response Summary</label>
                                        <textarea name="response_summary" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>{{ $data->response_summary }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Completed_By">Completed By</label>
                                        <div class="static">{{ $data->Completed_By }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Completed_On">Completed On</label>
                                        <div class="static">{{ $data->completed_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA_Approved_By">QA Approved By</label>
                                        <div class="static">{{ $data->QA_Approved_By }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="QA_Approved_On">QA Approved On</label>
                                        <div class="static">{{ $data->QA_Approved_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Final_Approval_By">Final Approval By</label>
                                        <div class="static">{{ $data->Final_Approval_By }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Final_Approval_On">Final Approval On</label>
                                        <div class="static">{{ $data->Final_Approval_on }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="submit" {{ $data->stage == 0 || $data->stage == 6 ? "disabled" : "" }}>Submit</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a>
                                </button>
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
                <form action="{{ route('extension_child', $data->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            <label for="major">
                                <input type="hidden" name="parent_name" value="Observation">
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
                <form action="{{ route('observation_change_stage', $data->id) }}" method="POST">
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

    <div class="modal fade" id="rejection-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('RejectStateChangeObservation', $data->id) }}" method="POST">
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
    <div class="modal fade" id="rejection-modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('updatestageobservation', $data->id) }}" method="POST">
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
                <form action="{{ route('observationchild', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            <label for="major">
                                <input type="radio" name="child_type" value="Capa">
                                CAPA
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
            $('#rchars').text(textlen);});
    </script>
@endsection



