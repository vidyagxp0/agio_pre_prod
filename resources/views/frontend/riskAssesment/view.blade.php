@extends('frontend.layout.main')
@section('container')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function addFishBone(top, bottom) {
            let mainBlock = document.querySelector('.fishbone-ishikawa-diagram');
            let topBlock = mainBlock.querySelector(top)
            let bottomBlock = mainBlock.querySelector(bottom)

            let topField = document.createElement('div')
            topField.className = 'grid-field fields top-field'

            let measurement = document.createElement('div')
            let measurementInput = document.createElement('input')
            measurementInput.setAttribute('type', 'text')
            measurementInput.setAttribute('name', 'measurement[]')
            measurement.append(measurementInput)
            topField.append(measurement)

            let materials = document.createElement('div')
            let materialsInput = document.createElement('input')
            materialsInput.setAttribute('type', 'text')
            materialsInput.setAttribute('name', 'materials[]')
            materials.append(materialsInput)
            topField.append(materials)

            let methods = document.createElement('div')
            let methodsInput = document.createElement('input')
            methodsInput.setAttribute('type', 'text')
            methodsInput.setAttribute('name', 'methods[]')
            methods.append(methodsInput)
            topField.append(methods)

            topBlock.prepend(topField)

            let bottomField = document.createElement('div')
            bottomField.className = 'grid-field fields bottom-field'

            let environment = document.createElement('div')
            let environmentInput = document.createElement('input')
            environmentInput.setAttribute('type', 'text')
            environmentInput.setAttribute('name', 'environment[]')
            environment.append(environmentInput)
            bottomField.append(environment)

            let manpower = document.createElement('div')
            let manpowerInput = document.createElement('input')
            manpowerInput.setAttribute('type', 'text')
            manpowerInput.setAttribute('name', 'manpower[]')
            manpower.append(manpowerInput)
            bottomField.append(manpower)

            let machine = document.createElement('div')
            let machineInput = document.createElement('input')
            machineInput.setAttribute('type', 'text')
            machineInput.setAttribute('name', 'machine[]')
            machine.append(machineInput)
            bottomField.append(machine)

            bottomBlock.append(bottomField)
        }

        function deleteFishBone(top, bottom) {
            let mainBlock = document.querySelector('.fishbone-ishikawa-diagram');
            let topBlock = mainBlock.querySelector(top)
            let bottomBlock = mainBlock.querySelector(bottom)
            if (topBlock.firstChild) {
                topBlock.removeChild(topBlock.firstChild);
            }
            if (bottomBlock.lastChild) {
                bottomBlock.removeChild(bottomBlock.lastChild);
            }
        }
    </script>
    <script>
        function addWhyField(con_class, name) {
            let mainBlock = document.querySelector('.why-why-chart')
            let container = mainBlock.querySelector(`.${con_class}`)
            let textarea = document.createElement('textarea')
            textarea.setAttribute('name', name);
            container.append(textarea)
        }
    </script>
    <script>
        function calculateInitialResult(selectElement) {
            let row = selectElement.closest('tr');
            let R = parseFloat(row.querySelector('.fieldR').value) || 0;
            let P = parseFloat(row.querySelector('.fieldP').value) || 0;
            let N = parseFloat(row.querySelector('.fieldN').value) || 0;
            let result = R * P * N;

            // Update the result field within the row
            row.querySelector('.initial-rpn').value = result;
        }
    </script>
    <script>
        function calculateResidualResult(selectElement) {
            // Get the row containing the changed select element
            let row = selectElement.closest('tr');

            // Get values from select elements within the row
            let R = parseFloat(row.querySelector('.residual-fieldR').value) || 0;
            let P = parseFloat(row.querySelector('.residual-fieldP').value) || 0;
            let N = parseFloat(row.querySelector('.residual-fieldN').value) || 0;

            // Perform the calculation
            let result = R * P * N;

            // Update the result field within the row
            row.querySelector('.residual-rpn').value = result;
        }
    </script>
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
        function calculateRiskAnalysis2(selectElement) {
            // Get the row containing the changed select element
            let row = selectElement.closest('tr');

            // Get values from select elements within the row
            let R = parseFloat(document.getElementById('analysisR2').value) || 0;
            let P = parseFloat(document.getElementById('analysisP2').value) || 0;
            let N = parseFloat(document.getElementById('analysisN2').value) || 0;

            // Perform the calculation
            let result = R * P * N;

            // Update the result field within the row
            document.getElementById('analysisRPN2').value = result;
        }
    </script>
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
            {{ Helpers::getDivisionName($data->division_id) }} / Risk Assesment
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
                        {{-- <a href="{{route('riskSingleReport', $data->id)}}"><button class="button_theme1"
                            class="new-doc-btn">Print</button></a> --}}

                        <button class="button_theme1"> <a class="text-white" href="{{ url('riskAuditTrial', $data->id) }}">
                                Audit Trail </a> </button>

                        @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Evaluation Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 3 && (in_array(16, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Action Plan Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Request More Info
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>

                        @elseif($data->stage == 4 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Action Plan Approved
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Reject Action Plan
                            </button>
                        @elseif($data->stage == 5 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                All Actions Completed
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Request More Info
                            </button>
                        @elseif($data->stage == 6 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Residual Risk Evaluation Completed
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Actions Needed
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
                                <div class="active">Risk Analysis & Work Group Assignment </div>
                            @else
                                <div class="">Risk Analysis & Work Group Assignment</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="active">Risk Processing & Action Plan </div>
                            @else
                                <div class="">Risk Processing & Action Plan</div>
                            @endif

                            @if ($data->stage >= 4)
                                <div class="active">Pending HOD Approval </div>
                            @else
                                <div class="">Pending HOD Approval </div>
                            @endif


                            @if ($data->stage >= 5)
                                <div class="active">Actions Items in Progress</div>
                            @else
                                <div class="">Actions Items in Progress</div>
                            @endif
                            @if ($data->stage >= 6)
                                <div class="active">Residual Risk Evaluation</div>
                            @else
                                <div class="">Residual Risk Evaluation</div>
                            @endif
                            @if ($data->stage >= 7)
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





            {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
            <div id="change-control-fields">
                <div class="container-fluid">

                    <!-- Tab links -->
                    <div class="cctab">
                        <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Risk/Opportunity Assesment</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Risk/Opportunity details </button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Work Group Assignment</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Risk/Opportunity Analysis</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Residual Risk</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Risk Mitigation</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Signatures</button>
                    </div>

                    <form action="{{ route('riskUpdate', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div id="step-form">

                            <!-- Risk Management Tab content -->
                            <div id="CCForm1" class="inner-block cctabcontent">

                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number"><b>Record Number</b></label>
                                                <input disabled type="text" name="record_number"
                                                    value=" {{ Helpers::getDivisionName($data->division_id) }}/RA/{{ Helpers::year($data->created_at) }}/{{ $data->record }}">
                                                {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Division Code"><b>Site/Location Code</b></label>
                                                <input readonly type="text" name="division_code"
                                                    value=" {{ Helpers::getDivisionName($data->division_id) }}">
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
                                                <input disabled type="text"
                                                    value="{{ Helpers::getdateFormat($data->intiation_date) }}"
                                                    name="intiation_date">
                                                {{-- <input type="hidden" value="{{ $data->intiation_date }}" name="intiation_date"> --}}

                                                {{-- <div class="static">{{ date('d-M-Y') }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="search">
                                                    Assigned To <span class="text-danger"></span>
                                                </label>
                                                <select id="select-state" placeholder="Select..." name="assign_to"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
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
                                                <label for="due-date">Due Date <span class="text-danger"></span></label>
                                                <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small></div>
                                                <input readonly type="text"
                                                    value="{{ Helpers::getdateFormat($data->due_date) }}"  
                                                    name="due_date">

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group"><b>Initiator Group</b></label>
                                                <select name="Initiator_Group" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                     id="initiator_group">
                                                    <option value="CQA"
                                                        @if ($data->Initiator_Group== 'CQA') selected @endif>Corporate
                                                        Quality Assurance</option>
                                                    <option value="QAB"
                                                        @if ($data->Initiator_Group== 'QAB') selected @endif>Quality
                                                        Assurance Biopharma</option>
                                                    <option value="CQC"
                                                        @if ($data->Initiator_Group== 'CQC') selected @endif>Central
                                                        Quality Control</option>
                                                    <option value="MANU"
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
                                                <input type="text" name="initiator_group_code" 
                                                    value="{{ $data->Initiator_Group}}" id="initiator_group_code"
                                                    readonly>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description <span
                                                        class="text-danger">*</span></label>
                                                        <div><small class="text-primary">Please mention brief summary</small></div>
                                                <textarea name="short_description" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="short_desc">{{ $data->short_description }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description<span
                                                        class="text-danger">*</span></label><span id="rchars">255</span>
                                                characters remaining
                                                
                                                <textarea name="short_description"   id="docname" type="text"    maxlength="255" required  {{ $data->stage == 0 || $data->stage == 7 ? "disabled" : "" }}>{{ $data->short_description }}</textarea>
                                            </div>
                                                  {{-- <p id="docnameError" style="color:red">**Short Description is required</p> --}}
                                     </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="severity-level">Severity Level</label>
                                                <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span>
                                                <select {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} name="severity2_level">
                                                    <option  value="0">-- Select --</option>
                                                    <option @if ($data->severity2_level == 'minor') selected @endif
                                                     value="minor">Minor</option>
                                                    <option  @if ($data->severity2_level == 'major') selected @endif 
                                                    value="major">Major</option>
                                                    <option @if ($data->severity2_level == 'critical') selected @endif
                                                    value="critical">Critical</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- --------------------------------------- --}}
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Department(s)">Department(s)</label>
                                                <select multiple name="departments[]" placeholder="Select Departments"
                                                    data-search="false" data-silent-initial-value-set="true"
                                                    id="departments" class="new_first_department"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Select Department</option>
                                                    <option value="1"
                                                        {{ in_array('1', explode(',', $data->departments)) ? 'selected' : '' }}>
                                                        QA</option>
                                                    <option value="2"
                                                        {{ in_array('2', explode(',', $data->departments)) ? 'selected' : '' }}>
                                                        QC</option>
                                                    <option value="3"
                                                        {{ in_array('3', explode(',', $data->departments)) ? 'selected' : '' }}>
                                                        R&D</option>
                                                    <option value="4"
                                                        {{ in_array('4', explode(',', $data->departments)) ? 'selected' : '' }}>
                                                        Manufacturing</option>
                                                    <option value="5"
                                                        {{ in_array('5', explode(',', $data->departments)) ? 'selected' : '' }}>
                                                        Warehouse</option>

                                                </select>
                                            </div>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $('#departments').change(function() {
                                                    var selectedOptions = $(this).val();
                                                    console.log('selectedOptions', selectedOptions);
                                                    document.querySelector('#departments2').setValue(selectedOptions);
                                                });
                                            });
                                        </script>
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Team Members">Team Members</label>
                                                <select multiple name="team_members[]" placeholder="Select Team Members"
                                                    data-search="false" data-silent-initial-value-set="true"
                                                    id="team_members"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">select team member</option>
                                                    <option value="1"
                                                        {{ in_array('1', explode(',', $data->team_members)) ? 'selected' : '' }}>
                                                        Amit Guru</option>
                                                    <option value="2"
                                                        {{ in_array('2', explode(',', $data->team_members)) ? 'selected' : '' }}>
                                                        Anshul Patel</option>
                                                    <option value="3"
                                                        {{ in_array('3', explode(',', $data->team_members)) ? 'selected' : '' }}>
                                                        Vikash Prajapati</option>
                                                    <option value="4"
                                                        {{ in_array('4', explode(',', $data->team_members)) ? 'selected' : '' }}>
                                                        Amit Patel</option>
                                                    <option value="5"
                                                        {{ in_array('5', explode(',', $data->team_members)) ? 'selected' : '' }}>
                                                        Shaleen Mishra</option>
                                                    <option value="6"
                                                        {{ in_array('6', explode(',', $data->team_members)) ? 'selected' : '' }}>
                                                        Madhulika Mishra</option>

                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Sourcd of Risk">Source of Risk/Opportunity</label>
                                                <select name="source_of_risk" id="source_of_risk"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->source_of_risk == 'Audit' ? 'selected' : '' }}
                                                        value="Audit">Audit</option>
                                                    <option {{ $data->source_of_risk == 'Complaint' ? 'selected' : '' }}
                                                        value="Complaint">Complaint</option>
                                                    <option {{ $data->source_of_risk == 'Employee' ? 'selected' : '' }}
                                                        value="Employee">Employee</option>
                                                    <option {{ $data->source_of_risk == 'Other' ? 'selected' : '' }}
                                                        value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Type..">Type</label>
                                                <select name="type" id="type"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->type == 'Other' ? 'selected' : '' }} value="Other">
                                                        Other</option>
                                                    <option {{ $data->type == 'Business_Risk' ? 'selected' : '' }}
                                                        value="Business_Risk">Business Risk</option>
                                                    <option {{ $data->type == 'custumer_Related' ? 'selected' : '' }}
                                                        value="custumer_Related">Customer-Related Risk(Complaint)
                                                    </option>
                                                    <option {{ $data->type == 'Opportunity' ? 'selected' : '' }}
                                                        value="Opportunity">Opportunity
                                                    </option>
                                                    <option {{ $data->type == 'Market' ? 'selected' : '' }}
                                                        value="Market">Market</option>
                                                    <option {{ $data->type == 'Operational_Risk' ? 'selected' : '' }}
                                                        value="Operational_Risk">Operational Risk</option>
                                                    <option {{ $data->type == 'Strategic_Rick' ? 'selected' : '' }}
                                                        value="Strategic_Risk">Strategic Risk</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Priority Level">Priority Level</label>
                                                <select name="priority_level" id="priority_level"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->priority_level == 'High' ? 'selected' : '' }}
                                                        value="High">High</option>
                                                    <option {{ $data->priority_level == 'medium' ? 'selected' : '' }}
                                                        value="medium">medium</option>
                                                    <option {{ $data->priority_level == 'Low' ? 'selected' : '' }}
                                                        value="Low">Low</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Zone">Zone</label>
                                                <select name="zone" id="zone"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="{{ $data->zone }}">Enter Your Selection Here</option>
                                                    <option {{ $data->zone == 'Asia' ? 'selected' : '' }} value="Asia">
                                                        Asia</option>
                                                    <option {{ $data->zone == 'Europe' ? 'selected' : '' }}
                                                        value="Europe">Europe</option>
                                                    <option {{ $data->zone == 'Africa' ? 'selected' : '' }}
                                                        value="Africa">Africa</option>
                                                    <option {{ $data->zone == 'Central_America' ? 'selected' : '' }}
                                                        value="Central_America">Central America</option>
                                                    <option {{ $data->zone == 'South_America' ? 'selected' : '' }}
                                                        value="South_America">South America</option>
                                                    <option {{ $data->zone == 'Oceania' ? 'selected' : '' }}
                                                        value="Oceania">Oceania</option>
                                                    <option {{ $data->zone == 'North_America' ? 'selected' : '' }}
                                                        value="North_America">North America</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Country">Country</label>
                                                <select name="country" class="countries" id="country" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="{{ $data->country }}">Select Country</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="State/District">State/District</label>
                                                <select name="state" class="states" id="stateId" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="{{ $data->state }}">Select State</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="City">City</label>
                                                <select name="city" class="cities" id="city" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="{{ $data->city }}">Select City</option>

                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-6">
                                            <div class="group-input">
                                                <label for="Description">Risk/Opportunity Description</label>
                                                <textarea name="description" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="description">{{ $data->description }}</textarea>
                                            </div>
                                        </div>
                                       
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Comments">Risk/Opportunity Comments</label>
                                                <textarea name="comments" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="comments">{{ $data->comments }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="button-block">
                                        <button type="submit" id="ChangeSaveButton" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>

                            </div>

                            <!-- Risk Details content -->
                            <div id="CCForm2" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Department(s)">Department(s)</label>
                                                <select multiple name="departments2[]" placeholder="Select Departments"
                                                    data-search="false" data-silent-initial-value-set="true"
                                                    id="departments2" class="new_department"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Select Department</option>
                                                    <option value="1"
                                                        {{ in_array('1', explode(',', $data->departments2)) ? 'selected' : '' }}>
                                                        QA</option>
                                                    <option value="2"
                                                        {{ in_array('2', explode(',', $data->departments2)) ? 'selected' : '' }}>
                                                        QC</option>
                                                    <option value="3"
                                                        {{ in_array('3', explode(',', $data->departments2)) ? 'selected' : '' }}>
                                                        R&D</option>
                                                    <option value="4"
                                                        {{ in_array('4', explode(',', $data->departments2)) ? 'selected' : '' }}>
                                                        Manufacturing</option>
                                                    <option value="5"
                                                        {{ in_array('5', explode(',', $data->departments2)) ? 'selected' : '' }}>
                                                        Warehouse</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Sourcd of Risk">Source of Risk</label>
                                                <select name="source_of_risk2" id="sourcd_of_risk"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->source_of_risk2 == 'Audit' ? 'selected' : '' }}
                                                        value="Audit">Audit</option>
                                                    <option {{ $data->source_of_risk2 == 'Complaint' ? 'selected' : '' }}
                                                        value="Complaint">Complaint</option>
                                                    <option {{ $data->source_of_risk2 == 'Employee' ? 'selected' : '' }}
                                                        value="Employee">Employee</option>
                                                    <option {{ $data->source_of_risk2 == 'Other' ? 'selected' : '' }}
                                                        value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Site Name">Site Name</label>
                                                <select name="site_name" id="site_name"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->site_name == '2' ? 'selected' : '' }}
                                                        value="2">City MFR B</option>
                                                    <option {{ $data->site_name == '1' ? 'selected' : '' }}
                                                        value="1">City MFR A</option>
                                                    <option {{ $data->site_name == '3' ? 'selected' : '' }}
                                                        value="3">City MFR C</option>
                                                    <option {{ $data->site_name == '4' ? 'selected' : '' }}
                                                        value="4">Complex A</option>
                                                    <option {{ $data->site_name == '5' ? 'selected' : '' }}
                                                        value="5">Complex B</option>
                                                    <option {{ $data->site_name == '6' ? 'selected' : '' }}
                                                        value="6">Maerketing A</option>
                                                    <option {{ $data->site_name == '7' ? 'selected' : '' }}
                                                        value="7">Maerketing B</option>
                                                    <option {{ $data->site_name == '8' ? 'selected' : '' }}
                                                        value="8">Maerketing C</option>
                                                    <option {{ $data->site_name == '9' ? 'selected' : '' }}
                                                        value="9">Oceanside</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Building.">Building.</label>
                                                <select name="building" id="building"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->building == 'A' ? 'selected' : '' }} value="A">
                                                        A</option>
                                                    <option {{ $data->building == 'B' ? 'selected' : '' }} value="B">
                                                        B</option>
                                                    <option {{ $data->building == 'C' ? 'selected' : '' }} value="C">
                                                        C</option>
                                                    <option {{ $data->building == 'D' ? 'selected' : '' }} value="D">
                                                        D</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Floor...">Floor</label>
                                                <select name="floor" id="floor"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->floor == 'First' ? 'selected' : '' }}
                                                        value="First">First</option>
                                                    <option {{ $data->floor == 'Second' ? 'selected' : '' }}
                                                        value="Second">Second</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Room">Room</label>
                                                <select name="room" id="room"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->room == 'C-101' ? 'selected' : '' }} value="C-101">
                                                        C-101</option>
                                                    <option {{ $data->room == 'C-202' ? 'selected' : '' }} value="C-202">
                                                        C-202</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="Reference Recores">Related Record</label>
                                                <select {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} multiple id="related_record" name="related_record[]" id="">
                                                    <option value="">--Select---</option>
                                                    @foreach ($old_record as $new)
                                                        <option value="{{ $new->id }}" {{ in_array($new->id, explode(',', $data->refrence_record)) ? 'selected' : '' }}>
                                                            {{ Helpers::getDivisionName($new->division_id) }}/RA/{{date('Y')}}/{{ Helpers::recordFormat($new->record) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Duration">Duration</label>
                                                <select name="duration" id="duration"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->duration == '1' ? 'selected' : '' }}
                                                        value="1">
                                                        2 hours</option>
                                                    <option {{ $data->duration == '2' ? 'selected' : '' }}
                                                        value="2">
                                                        4 hours</option>
                                                    <option {{ $data->duration == '3' ? 'selected' : '' }}
                                                        value="3">
                                                        8 hours</option>
                                                    <option {{ $data->duration == '4' ? 'selected' : '' }}
                                                        value="4">
                                                        16 hours</option>
                                                    <option {{ $data->duration == '5' ? 'selected' : '' }}
                                                        value="5">
                                                        24 hours</option>
                                                    <option {{ $data->duration == '6' ? 'selected' : '' }}
                                                        value="6">
                                                        36 hours</option>
                                                    <option {{ $data->duration == '7' ? 'selected' : '' }}
                                                        value="7">
                                                        72 hours</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Hazard">Hazard</label>
                                                <select name="hazard" id="hazard"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->hazard == '1' ? 'selected' : '' }} value="1">
                                                        Confined Space</option>
                                                    <option {{ $data->hazard == '2' ? 'selected' : '' }} value="2">
                                                        Electrical</option>
                                                    <option {{ $data->hazard == '3' ? 'selected' : '' }} value="3">
                                                        Energy use</option>
                                                    <option {{ $data->hazard == '4' ? 'selected' : '' }} value="4">
                                                        Ergonomics</option>
                                                    <option {{ $data->hazard == '5' ? 'selected' : '' }} value="5">
                                                        Machine Guarding</option>
                                                    <option {{ $data->hazard == '6' ? 'selected' : '' }} value="6">
                                                        Material Storage</option>
                                                    <option {{ $data->hazard == '7' ? 'selected' : '' }} value="7">
                                                        Material use</option>
                                                    <option {{ $data->hazard == '8' ? 'selected' : '' }} value="8">
                                                        Pressure</option>
                                                    <option {{ $data->hazard == '9' ? 'selected' : '' }} value="9">
                                                        Thermal</option>
                                                    <option {{ $data->hazard == '10' ? 'selected' : '' }} value="10">
                                                        Water use</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Room">Room</label>
                                                <select name="room2" id="room2"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->room2 == '1' ? 'selected' : '' }} value="1">
                                                        Biochemistry</option>
                                                    <option {{ $data->room2 == '2' ? 'selected' : '' }} value="2">
                                                        Automation</option>
                                                    <option {{ $data->room2 == '3' ? 'selected' : '' }} value="3">
                                                        Blood Collection</option>
                                                    <option {{ $data->room2 == '4' ? 'selected' : '' }} value="4">
                                                        Enter Yo</option>
                                                    <option {{ $data->room2 == '5' ? 'selected' : '' }} value="5">
                                                        Buffer Preparation</option>
                                                    <option {{ $data->room2 == '6' ? 'selected' : '' }} value="6">
                                                        Bulk Fill</option>
                                                    <option {{ $data->room2 == '7' ? 'selected' : '' }} value="7">
                                                        Calibration</option>
                                                    <option {{ $data->room2 == '8' ? 'selected' : '' }} value="8">
                                                        Component Manufacturing</option>
                                                    <option {{ $data->room2 == '9' ? 'selected' : '' }} value="9">
                                                        Computer</option>
                                                    <option {{ $data->room2 == '10' ? 'selected' : '' }} value="10">
                                                        Computer / Automated Systems</option>
                                                    <option {{ $data->room2 == '11' ? 'selected' : '' }} value="11">
                                                        Despensing Donor Suitability</option>
                                                    <option {{ $data->room2 == '12' ? 'selected' : '' }} value="12">
                                                        Filling</option>
                                                    <option {{ $data->room2 == '13' ? 'selected' : '' }} value="13">
                                                        Filtration</option>
                                                    <option {{ $data->room2 == '14' ? 'selected' : '' }} value="14">
                                                        Formulation</option>
                                                    <option {{ $data->room2 == '15' ? 'selected' : '' }} value="15">
                                                        Incoming QA</option>
                                                    <option {{ $data->room2 == '16' ? 'selected' : '' }} value="16">
                                                        Hazard</option>
                                                    <option {{ $data->room2 == '17' ? 'selected' : '' }} value="17">
                                                        Laboratory</option>
                                                    <option {{ $data->room2 == '18' ? 'selected' : '' }} value="18">
                                                        Laboratory Support Facility</option>
                                                    <option {{ $data->room2 == '19' ? 'selected' : '' }} value="19">
                                                        Enter Your</option>
                                                    <option {{ $data->room2 == '20' ? 'selected' : '' }} value="20">
                                                        Lot Release</option>
                                                    <option {{ $data->room2 == '21' ? 'selected' : '' }} value="21">
                                                        Manufacturing</option>
                                                    <option {{ $data->room2 == '22' ? 'selected' : '' }} value="22">
                                                        Materials Management</option>
                                                    <option {{ $data->room2 == '23' ? 'selected' : '' }} value="23">
                                                        Room</option>
                                                    <option {{ $data->room2 == '24' ? 'selected' : '' }} value="24">
                                                        Operations</option>
                                                    <option {{ $data->room2 == '25' ? 'selected' : '' }} value="25">
                                                        Packaging</option>
                                                    <option {{ $data->room2 == '26' ? 'selected' : '' }} value="26">
                                                        Plant Engineering</option>
                                                    <option {{ $data->room2 == '27' ? 'selected' : '' }} value="27">
                                                        Enter Your Sele</option>
                                                    <option {{ $data->room2 == '28' ? 'selected' : '' }} value="28">
                                                        Njown</option>
                                                    <option {{ $data->room2 == '29' ? 'selected' : '' }} value="29">
                                                        Powder Filling</option>
                                                    <option {{ $data->room2 == '30' ? 'selected' : '' }} value="30">
                                                        Process Development</option>
                                                    <option {{ $data->room2 == '31' ? 'selected' : '' }} value="31">
                                                        Product Distribution</option>
                                                    <option {{ $data->room2 == '32' ? 'selected' : '' }} value="32">
                                                        Product Testing</option>
                                                    <option {{ $data->room2 == '33' ? 'selected' : '' }} value="33">
                                                        Production Purification</option>
                                                    <option {{ $data->room2 == '34' ? 'selected' : '' }} value="34">
                                                        QA</option>
                                                    <option {{ $data->room2 == '35' ? 'selected' : '' }} value="35">
                                                        QA Laboratory Quality Control</option>
                                                    <option {{ $data->room2 == '36' ? 'selected' : '' }} value="36">
                                                        Quality Control / Assurance</option>
                                                    <option {{ $data->room2 == '37' ? 'selected' : '' }} value="37">
                                                        Sanitization</option>
                                                    <option {{ $data->room2 == '38' ? 'selected' : '' }} value="38">
                                                        Shipping/Distribution Storage/Distribution
                                                    </option>
                                                    <option {{ $data->room2 == '39' ? 'selected' : '' }} value="39">
                                                        Storage and Distribution</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Regulatory Climate">Regulatory Climate</label>
                                                <select name="regulatory_climate" id="regulatory_climate"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->regulatory_climate == '1' ? 'selected' : '' }}
                                                        value="1">0. No significant regulatory issues affecting
                                                        operation
                                                    </option>
                                                    <option {{ $data->regulatory_climate == '2' ? 'selected' : '' }}
                                                        value="2">1. Some regulatory or enforcement changes
                                                        potentially
                                                        affecting
                                                        operation are
                                                        anticipated </option>
                                                    <option {{ $data->regulatory_climate == '3' ? 'selected' : '' }}
                                                        value="3">2. A few regulatory or enforcement changes
                                                        affect
                                                        operations</option>
                                                    <option {{ $data->regulatory_climate == '4' ? 'selected' : '' }}
                                                        value="4">3. Regulatory and enforcement changes affect
                                                        operation
                                                    </option>
                                                    <option {{ $data->regulatory_climate == '5' ? 'selected' : '' }}
                                                        value="5">4. Significant programatic regulatory and
                                                        enforcement
                                                        changes affect
                                                        operation
                                                    </option>
                                                    <option {{ $data->regulatory_climate == '6' ? 'selected' : '' }}
                                                        value="6">1. Some regulatory or enforcement changes
                                                        potentially
                                                        affecting operation are anticipated </option>
                                                    <option {{ $data->regulatory_climate == '7' ? 'selected' : '' }}
                                                        value="7">2. A few regulatory or enforcement changes
                                                        affect
                                                        operations</option>
                                                    <option {{ $data->regulatory_climate == '8' ? 'selected' : '' }}
                                                        value="8">3. Regulatory and enforcement changes affect
                                                        operation
                                                    </option>
                                                    <option {{ $data->regulatory_climate == '9' ? 'selected' : '' }}
                                                        value="9">4. Significant programatic regulatory and
                                                        enforcement
                                                        changes affect operation</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Number of Employees">Number of Employees</label>
                                                <select name="Number_of_employees" id="Number_of_employees"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->Number_of_employees == '1' ? 'selected' : '' }}
                                                        value="1">0-50</option>
                                                    <option {{ $data->Number_of_employees == '2' ? 'selected' : '' }}
                                                        value="2">50-100</option>
                                                        <option {{ $data->Number_of_employees == '3' ? 'selected' : '' }} value="3">100-200</option>
                                                        <option {{ $data->Number_of_employees == '4' ? 'selected' : '' }} value="4">200-300</option>
                                                        <option {{ $data->Number_of_employees == '5' ? 'selected' : '' }} value="5">300-500</option>
                                                        <option {{ $data->Number_of_employees == '6' ? 'selected' : '' }} value="6">500-1000</option>
                                                        <option {{ $data->Number_of_employees == '7' ? 'selected' : '' }} value="7">1000+</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Risk Management Strategy">Risk Management Strategy</label>
                                                <select name="risk_management_strategy" id="risk_management_strategy"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->risk_management_strategy == '1' ? 'selected' : '' }}
                                                        value="1">Accept</option>
                                                    <option {{ $data->risk_management_strategy == '2' ? 'selected' : '' }}
                                                        value="2">Avoid the Risk</option>
                                                    <option {{ $data->risk_management_strategy == '3' ? 'selected' : '' }}
                                                        value="3">Mitigate</option>
                                                    <option {{ $data->risk_management_strategy == '4' ? 'selected' : '' }}
                                                        value="4">Transfer</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Work Group Assignment content -->
                            <div id="CCForm3" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="sub-head">
                                        Assignment Details
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Scheduled Start Date">Scheduled Start Date</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="schedule_start_date" readonly value="{{ Helpers::getdateFormat($data->schedule_start_date1) }}" 
                                                        placeholder="DD-MMM-YYYY" />
                                                    <input type="date" id="schedule_start_date_checkdate" name="schedule_start_date1" value="{{ $data->schedule_start_date1 }}" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} class="hide-input" 
                                                        oninput="handleDateInput(this, 'schedule_start_date');checkDate('schedule_start_date_checkdate','schedule_end_date_checkdate')" />
                                                </div>
                                                {{-- <input type="date" name="schedule_start_date1" value="{{$data->schedule_start_date1}}"> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Scheduled End Date">Scheduled End Date</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="schedule_end_date" readonly value="{{ Helpers::getdateFormat($data->schedule_end_date1) }}" 
                                                        placeholder="DD-MMM-YYYY" />
                                                    <input type="date" id="schedule_end_date_checkdate" name="schedule_end_date1" value="{{ $data->schedule_end_date1 }}" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} class="hide-input"
                                                        oninput="handleDateInput(this, 'schedule_end_date');checkDate('schedule_start_date_checkdate','schedule_end_date_checkdate')" />
                                                </div>
                                                {{-- <input type="date" name="schedule_end_date1" value="{{$data->schedule_end_date}}"> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Estimated Man-Hours">Estimated Man-Hours</label>
                                                <input type="text" name="estimated_man_hours" id="estimated_man_hours"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    value="{{ $data->estimated_man_hours }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Estimated Cost">Estimated Cost</label>
                                                <input type="text" name="estimated_cost" id="estimated_cost"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    value="{{ $data->estimated_cost }}">
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Supervisor">Supervisor</label>
                                                <div class="static">shaleen</div>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Currency">Currency</label>
                                                <select name="currency" id="currency"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->currency == '1' ? 'selected' : '' }}
                                                        value="1">ARS-Argentine Peso</option>
                                                    <option {{ $data->currency == '2' ? 'selected' : '' }}
                                                        value="2">AUD-Australian Dollar</option>
                                                    <option {{ $data->currency == '3' ? 'selected' : '' }}
                                                        value="3">BRL-Brazilian Real CAD-Canadian Dollar</option>
                                                    <option {{ $data->currency == '4' ? 'selected' : '' }}
                                                        value="4">CHF-Swiss Franc</option>
                                                    <option {{ $data->currency == '5' ? 'selected' : '' }}
                                                        value="5">CNY-Chinese Yuan</option>
                                                    <option {{ $data->currency == '6' ? 'selected' : '' }}
                                                        value="6">EUR-Euro</option>
                                                    <option {{ $data->currency == '7' ? 'selected' : '' }}
                                                        value="7">HKD-Hong Kong Dollar ILS-Israeli New Sheqel
                                                    </option>
                                                    <option {{ $data->currency == '8' ? 'selected' : '' }}
                                                        value="8">INR-Indian Rupee JPY-Japanese Yen</option>
                                                    <option {{ $data->currency == '9' ? 'selected' : '' }}
                                                        value="9">KRW-South Korean Won</option>
                                                    <option {{ $data->currency == '10' ? 'selected' : '' }}
                                                        value="10">MXN-Mexican Peso</option>
                                                    <option {{ $data->currency == '11' ? 'selected' : '' }}
                                                        value="11">RUB-Russian Rouble</option>
                                                    <option {{ $data->currency == '12' ? 'selected' : '' }}
                                                        value="12">SAR-Saudi Riyal</option>
                                                    <option {{ $data->currency == '13' ? 'selected' : '' }}
                                                        value="13">TRY-Turkish Lira</option>
                                                    <option {{ $data->currency == '14' ? 'selected' : '' }}
                                                        value="14">USD-US Dollar</option>
                                                    <option {{ $data->currency == '15' ? 'selected' : '' }}
                                                        value="15">XAG-Silver</option>
                                                    <option {{ $data->currency == '16' ? 'selected' : '' }}
                                                        value="16">XAU-Gold</option>
                                                    <option {{ $data->currency == '17' ? 'selected' : '' }}
                                                        value="17">XPD-Palladium</option>
                                                    <option {{ $data->currency == '18' ? 'selected' : '' }}
                                                        value="18">XPT-Platinum</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Team Members">Team Members</label>
                                                <select multiple name="team_members2[]" placeholder="Select Team Members"
                                                    data-search="false" data-silent-initial-value-set="true"
                                                    id="team_members"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="1"
                                                        {{ in_array('1', explode(',', $data->team_members2)) ? 'selected' : '' }}>
                                                        Amit Guru</option>
                                                    <option value="2"
                                                        {{ in_array('2', explode(',', $data->team_members2)) ? 'selected' : '' }}>
                                                        Anshul Patel</option>
                                                    <option value="3"
                                                        {{ in_array('3', explode(',', $data->team_members2)) ? 'selected' : '' }}>
                                                        Vikash Prajapati</option>
                                                    <option value="4"
                                                        {{ in_array('4', explode(',', $data->team_members2)) ? 'selected' : '' }}>
                                                        Amit Patel</option>
                                                    <option value="5"
                                                        {{ in_array('5', explode(',', $data->team_members2)) ? 'selected' : '' }}>
                                                        Shaleen Mishra</option>
                                                    <option value="6"
                                                        {{ in_array('6', explode(',', $data->team_members2)) ? 'selected' : '' }}>
                                                        Madhulika Mishra</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Training Requirement">Training Requirement</label>
                                                <select multiple name="training_require"
                                                    placeholder="Select Training Requirement" data-search="false"
                                                    data-silent-initial-value-set="true" id="team_members"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="1">ABC</option>
                                                    <option value="1">ABC</option>
                                                    <option value="1">ABC</option>
                                                    <option value="1">ABC</option>

                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-6">
                                            <div class="group-input">
                                                <label for="Justification / Rationale">Justification / Rationale</label>
                                                <textarea name="justification" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="justification">{{ $data->justification }} </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sub-head">
                                        Action Plan
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Product/Material">
                                                    Action Plan<button type="button" name="ann" id="action_plan"
                                                        {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>+</button>
                                                </label>
                                                <table class="table table-bordered" id="action_plan_details">
                                                    <thead>
                                                        <tr>
                                                            <th>Row #</th>
                                                            <th>Action</th>
                                                            <th>Responsible</th>
                                                            <th>Deadline</th>
                                                            <th>Item static</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach (unserialize($action_plan->action) as $key => $temps)
                                                            <tr>
                                                                <td><input disabled type="text" name="serial_number[]"
                                                                        value="{{ $key + 1 }}"></td>
                                                                <td><input type="text" name="action[]"
                                                                        value="{{ $temps ? $temps : ' ' }}"></td>
                                                                {{-- <td><input type="text" name="responsible[]"
                                                                        value="{{ unserialize($action_plan->responsible)[$key] ? unserialize($action_plan->responsible)[$key] : '' }}">
                                                                </td> --}}
                                                                <td> <select id="select-state" placeholder="Select..."
                                                                    name="responsible[]">
                                                                    <option value="">Select a value</option>
                                                                    @foreach ($users as $value)
                                                                        <option
                                                                            {{ unserialize($action_plan->responsible)[$key] ? (unserialize($action_plan->responsible)[$key] == $value->id ? 'selected' : ' ') : '' }}
                                                                            value="{{ $value->id }}">
                                                                            {{ $value->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select></td>
                                                                {{-- <td><input type="text" name="deadline[]"
                                                                        value="{{ unserialize($action_plan->deadline)[$key] ? unserialize($action_plan->deadline)[$key] : '' }}">
                                                                </td> --}}
                                                                <td><div class="group-input new-date-data-field mb-0">
                                                                    <div class="input-date "><div
                                                                    class="calenderauditee">
                                                                    <input type="text" id="deadline{{$key}}' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat(unserialize($action_plan->deadline)[$key]) }}" />
                                                                    <input type="date" name="deadline[]" class="hide-input" value="{{ unserialize($action_plan->deadline)[$key] }}"
                                                                    oninput="handleDateInput(this, `deadline{{$key}}' + serialNumber +'`)" /></div></div></div></td>
                                                                
                                                                <td><input type="text" name="item_static[]"
                                                                        value="{{ unserialize($action_plan->item_static)[$key] ? unserialize($action_plan->item_static)[$key] : '' }}">
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="Report Attachments">Work Group Attachments</label>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="reference"></div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="reference[]"
                                                            oninput="addMultipleFiles(this, 'reference')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="File Attachments">Work Group Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div class="file-attachment-list" id="reference">
                                                            @if ($data->reference)
                                                            @foreach(json_decode($data->reference) as $file)
                                                            <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                       @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="add-btn">
                                                            <div>Add</div>
                                                            <input {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} type="file" id="myfile" name="reference[]"
                                                                oninput="addMultipleFiles(this, 'reference')" multiple>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- General information content -->
                            <div id="CCForm4" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="sub-head">
                                        RCA Results
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="root-cause-methodology">Root Cause Methodology</label>
                                                <select name="root_cause_methodology[]" multiple {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    placeholder="-- Select --" data-search="false"
                                                    data-silent-initial-value-set="true" id="root-cause-methodology">
                                                    {{-- <option value="0">-- Select --</option> --}}
                                                    <option value="1"
                                                        {{ in_array('1', explode(',', $data->root_cause_methodology)) ? 'selected' : '' }}>
                                                        Why-Why Chart</option>
                                                    <option value="2"
                                                        {{ in_array('2', explode(',', $data->root_cause_methodology)) ? 'selected' : '' }}>
                                                        Failure Mode and Efect Analysis</option>
                                                    <option value="3"
                                                        {{ in_array('3', explode(',', $data->root_cause_methodology)) ? 'selected' : '' }}>
                                                        Fishbone or Ishikawa Diagram</option>
                                                    <option value="4"
                                                        {{ in_array('4', explode(',', $data->root_cause_methodology)) ? 'selected' : '' }}>
                                                        Is/Is Not Analysis</option>


                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head"></div>
                                        <div class="col-12 mb-4">
                                            <div class="group-input">
                                                <label for="agenda">
                                                    Failure Mode and Effect Analysis<button type="button" name="agenda"
                                                        onclick="addRiskAssessment('risk-assessment-risk-management')">+</button>
                                                </label>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" style="width: 200%"
                                                        id="risk-assessment-risk-management">
                                                        <thead>
                                                            <tr>
                                                                <th>Row #</th>
                                                                <th>Risk Factor</th>
                                                                <th>Risk element </th>
                                                                <th>Probable cause of risk element</th>
                                                                <th>Existing Risk Controls</th>
                                                                <th>Initial Severity- H(3)/M(2)/L(1)</th>
                                                                <th>Initial Probability- H(3)/M(2)/L(1)</th>
                                                                <th>Initial Detectability- H(1)/M(2)/L(3)</th>
                                                                <th>Initial RPN</th>
                                                                <th>Risk Acceptance (Y/N)</th>
                                                                <th>Proposed Additional Risk control measure (Mandatory for
                                                                    Risk
                                                                    elements having RPN>4)</th>
                                                                <th>Residual Severity- H(3)/M(2)/L(1)</th>
                                                                <th>Residual Probability- H(3)/M(2)/L(1)</th>
                                                                <th>Residual Detectability- H(1)/M(2)/L(3)</th>
                                                                <th>Residual RPN</th>
                                                                <th>Risk Acceptance (Y/N)</th>
                                                                <th>Mitigation proposal (Mention either CAPA reference
                                                                    number, IQ,
                                                                    OQ or
                                                                    PQ)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (!empty($riskEffectAnalysis->risk_factor))
                                                                @foreach (unserialize($riskEffectAnalysis->risk_factor) as $key => $riskFactor)
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td><input name="risk_factor[]" type="text" value="{{ $riskFactor }}" ></td>
                                                                    <td><input name="risk_element[]" type="text" value="{{ unserialize($riskEffectAnalysis->risk_element)[$key] ?? null }}" >
                                                                    </td>
                                                                    <td> <input name="problem_cause[]" type="text" value="{{ unserialize($riskEffectAnalysis->problem_cause)[$key] ?? null }}" >
                                                                    </td>
                                                                    <td><input name="existing_risk_control[]" type="text" value="{{ unserialize($riskEffectAnalysis->existing_risk_control)[$key] ?? null }}" >
                                                                    </td>
                                                                    <td><select onchange="calculateInitialResult(this)" class="fieldR" name="initial_severity[]">
                                                                            <option value="">-- Select --</option>
                                                                            <option value="1" {{ (unserialize($riskEffectAnalysis->initial_severity)[$key] ?? null)== 1 ? 'selected' :''}}>1</option>
                                                                            <option value="2"  {{ (unserialize($riskEffectAnalysis->initial_severity)[$key] ?? null)== 2 ? 'selected' :''}}>2</option>
                                                                            <option value="3"  {{ (unserialize($riskEffectAnalysis->initial_severity)[$key] ?? null)== 3 ? 'selected' :''}}>3</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <select onchange="calculateInitialResult(this)" class="fieldP" name="initial_detectability[]">
                                                                            <option value="">-- Select --</option>
                                                                            <option value="1" {{ (unserialize($riskEffectAnalysis->initial_detectability)[$key] ?? null)== 1 ? 'selected' :''}}>1</option>
                                                                            <option value="2"  {{ (unserialize($riskEffectAnalysis->initial_detectability)[$key] ?? null)== 2 ? 'selected' :''}}>2</option>
                                                                            <option value="3"  {{ (unserialize($riskEffectAnalysis->initial_detectability)[$key] ?? null)== 3 ? 'selected' :''}}>3</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <select onchange="calculateInitialResult(this)" class="fieldN" name="initial_probability[]">
                                                                            <option value="">-- Select --</option>
                                                                            <option value="1" {{ (unserialize($riskEffectAnalysis->initial_probability)[$key] ?? null)== 1 ? 'selected' :''}}>1</option>
                                                                            <option value="2"  {{ (unserialize($riskEffectAnalysis->initial_probability)[$key] ?? null)== 2 ? 'selected' :''}}>2</option>
                                                                            <option value="3"  {{ (unserialize($riskEffectAnalysis->initial_probability)[$key] ?? null)== 3 ? 'selected' :''}}>3</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        {{-- <input name="initial_rpn[]" type="text"  class='initial-rpn' value="{{ unserialize($riskEffectAnalysis->initial_rpn)[$key] ?? null }}" > --}}
                                                                        <input name="initial_rpn[]" type="text" class='residual-rpn' value="{{ unserialize($riskEffectAnalysis->initial_rpn)[$key] ?? null }}" >

                                                                    </td>
                                                                    <td>
                                                                        <input name="risk_acceptance[]" type="text" value="{{ unserialize($riskEffectAnalysis->risk_acceptance)[$key] ?? null }}" >
                                                                    </td>
                                                                    <td>
                                                                        <input name="risk_control_measure[]" type="text" value="{{ unserialize($riskEffectAnalysis->risk_control_measure)[$key] ?? null }}" >
                                                                         
                                                                    </td>
                                                                    <td>
                                                                        <select onchange="calculateResidualResult(this)" class="residual-fieldR" name="residual_severity[]">
                                                                            <option value="">-- Select --</option>
                                                                            <option value="1" {{ (unserialize($riskEffectAnalysis->residual_severity)[$key] ?? null)== 1 ? 'selected' :''}}>1</option>
                                                                            <option value="2"  {{ (unserialize($riskEffectAnalysis->residual_severity)[$key] ?? null)== 2 ? 'selected' :''}}>2</option>
                                                                            <option value="3"  {{ (unserialize($riskEffectAnalysis->residual_severity)[$key] ?? null)== 3 ? 'selected' :''}}>3</option>
                                                                        </select>
                                                                        
                                                                    </td>
                                                                    <td>
                                                                        <select onchange="calculateResidualResult(this)" class="residual-fieldP" name="residual_probability[]">
                                                                            <option value="">-- Select --</option>
                                                                            <option value="1" {{ (unserialize($riskEffectAnalysis->residual_probability)[$key] ?? null)== 1 ? 'selected' :''}}>1</option>
                                                                            <option value="2"  {{ (unserialize($riskEffectAnalysis->residual_probability)[$key] ?? null)== 2 ? 'selected' :''}}>2</option>
                                                                            <option value="3"  {{ (unserialize($riskEffectAnalysis->residual_probability)[$key] ?? null)== 3 ? 'selected' :''}}>3</option>
                                                                        </select>
                                                                         
                                                                    </td>
    
                                                                    <td>
                                                                        <select onchange="calculateResidualResult(this)" class="residual-fieldN" name="residual_detectability[]">
                                                                            <option value="">-- Select --</option>
                                                                            <option value="1" {{ (unserialize($riskEffectAnalysis->residual_detectability)[$key] ?? null)== 1 ? 'selected' :''}}>1</option>
                                                                            <option value="2"  {{ (unserialize($riskEffectAnalysis->residual_detectability)[$key] ?? null)== 2 ? 'selected' :''}}>2</option>
                                                                            <option value="3"  {{ (unserialize($riskEffectAnalysis->residual_detectability)[$key] ?? null)== 3 ? 'selected' :''}}>3</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                         <input name="residual_rpn[]" type="text" class='residual-rpn' value="{{ unserialize($riskEffectAnalysis->residual_rpn)[$key] ?? null }}" >
                                                                    </td>
                                                                    <td>
                                                                        <select onchange="calculateInitialResult(this)" class="fieldR" name="risk_acceptance2[]">
                                                                            <option value="">-- Select --</option>
                                                                            <option value="Y" {{ (unserialize($riskEffectAnalysis->risk_acceptance2)[$key] ?? null)== 'Y' ? 'selected' :''}}>Y</option>
                                                                            <option value="N"  {{ (unserialize($riskEffectAnalysis->risk_acceptance2)[$key] ?? null)== 'N' ? 'selected' :''}}>N</option>
                                                                         </select>
                                                                    </td>
                                                                    <td>
                                                                        <input name="mitigation_proposal[]" type="text" value="{{ unserialize($riskEffectAnalysis->mitigation_proposal)[$key] ?? null }}" >
                                                                    </td>
                                                                </tr>    
                                                                @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head"></div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="fishbone">
                                                    Fishbone or Ishikawa Diagram
                                                    <button type="button" name="agenda"
                                                        onclick="addFishBone('.top-field-group', '.bottom-field-group')">+</button>
                                                    <button type="button" name="agenda" class="fishbone-del-btn"
                                                        onclick="deleteFishBone('.top-field-group', '.bottom-field-group')">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                    <span class="text-primary" data-bs-toggle="modal"
                                                        data-bs-target="#fishbone-instruction-modal"
                                                        style="font-size: 0.8rem; font-weight: 400;">
                                                        (Launch Instruction)
                                                    </span>
                                                </label>
                                                <div class="fishbone-ishikawa-diagram">
                                                    <div class="left-group">
                                                        <div class="grid-field field-name">
                                                            <div>Measurement</div>
                                                            <div>Materials</div>
                                                            <div>Methods</div>
                                                        </div>
                                                        <div class="top-field-group">
                                                            <div class="grid-field fields top-field">
                                                                @if (!empty($fishbone->measurement))
                                                                    @foreach (unserialize($fishbone->measurement) as $key => $measure)
                                                                        <div><input type="text"
                                                                                value="{{ $measure }}"
                                                                                name="measurement[]"></div>
                                                                        <div><input type="text"
                                                                                value="{{ unserialize($fishbone->materials)[$key] ? unserialize($fishbone->materials)[$key] : '' }}"
                                                                                name="materials[]"></div>
                                                                        <div><input type="text"
                                                                                value="{{ unserialize($fishbone->methods)[$key] ? unserialize($fishbone->methods)[$key] : '' }}"
                                                                                name="methods[]"></div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="mid"></div>
                                                        <div class="bottom-field-group">
                                                            <div class="grid-field fields bottom-field">
                                                                @if (!empty($fishbone->environment))
                                                                    @foreach (unserialize($fishbone->environment) as $key => $measure)
                                                                        <div><input type="text"
                                                                                value="{{ $measure }}"
                                                                                name="environment[]"></div>
                                                                        <div><input type="text"
                                                                                value="{{ unserialize($fishbone->manpower)[$key] ? unserialize($fishbone->manpower)[$key] : '' }}"
                                                                                name="manpower[]"></div>
                                                                        <div><input type="text"
                                                                                value="{{ unserialize($fishbone->machine)[$key] ? unserialize($fishbone->machine)[$key] : '' }}"
                                                                                name="machine[]"></div>
                                                                    @endforeach
                                                                @endif

                                                            </div>
                                                        </div>
                                                        <div class="grid-field field-name">
                                                            <div>Environment</div>
                                                            <div>Manpower</div>
                                                            <div>Machine</div>
                                                        </div>
                                                    </div>
                                                    <div class="right-group">
                                                        <div class="field-name">
                                                            Problem Statement
                                                        </div>
                                                        <div class="field">

                                                            <textarea name="problem_statement">{{ $fishbone->problem_statement }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head"></div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="why-why-chart">
                                                    Why-Why Chart
                                                    <span class="text-primary" data-bs-toggle="modal"
                                                        data-bs-target="#why_chart-instruction-modal"
                                                        style="font-size: 0.8rem; font-weight: 400;">
                                                        (Launch Instruction)
                                                    </span>
                                                </label>
                                                <div class="why-why-chart">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr style="background: #f4bb22">
                                                                <th style="width:150px;">Problem Statement :</th>
                                                                <td>

                                                                    <textarea name="why_problem_statement">{{ $whyChart->why_problem_statement }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr class="why-row">
                                                                <th style="width:150px; color: #393cd4;">
                                                                    Why 1 <span
                                                                        onclick="addWhyField('why_1_block', 'why_1[]')">+</span>
                                                                </th>
                                                                <td>
                                                                    <div class="why_1_block">
                                                                        @if (!empty($whyChart->why_1))
                                                                            @foreach (unserialize($whyChart->why_1) as $key => $measure)
                                                                                <textarea name="why_1[]">{{ $measure }}</textarea>
                                                                            @endforeach
                                                                        @endif

                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="why-row">
                                                                <th style="width:150px; color: #393cd4;">
                                                                    Why 2 <span
                                                                        onclick="addWhyField('why_2_block', 'why_2[]')">+</span>
                                                                </th>
                                                                <td>
                                                                    <div class="why_2_block">
                                                                        @if (!empty($whyChart->why_2))
                                                                            @foreach (unserialize($whyChart->why_2) as $key => $measure)
                                                                                <textarea name="why_2[]">{{ $measure }}</textarea>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="why-row">
                                                                <th style="width:150px; color: #393cd4;">
                                                                    Why 3 <span
                                                                        onclick="addWhyField('why_3_block', 'why_3[]')">+</span>
                                                                </th>
                                                                <td>
                                                                    <div class="why_3_block">
                                                                        @if (!empty($whyChart->why_3))
                                                                            @foreach (unserialize($whyChart->why_3) as $key => $measure)
                                                                                <textarea name="why_3[]">{{ $measure }}</textarea>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="why-row">
                                                                <th style="width:150px; color: #393cd4;">
                                                                    Why 4 <span
                                                                        onclick="addWhyField('why_4_block', 'why_4[]')">+</span>
                                                                </th>
                                                                <td>
                                                                    <div class="why_4_block">
                                                                        @if (!empty($whyChart->why_4))
                                                                            @foreach (unserialize($whyChart->why_4) as $key => $measure)
                                                                                <textarea name="why_4[]">{{ $measure }}</textarea>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="why-row">
                                                                <th style="width:150px; color: #393cd4;">
                                                                    Why 5 <span
                                                                        onclick="addWhyField('why_5_block', 'why_5[]')">+</span>
                                                                </th>
                                                                <td>
                                                                    <div class="why_5_block">
                                                                        @if (!empty($whyChart->why_5))
                                                                            @foreach (unserialize($whyChart->why_5) as $key => $measure)
                                                                                <textarea name="why_5[]">{{ $measure }}</textarea>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr style="background: #0080006b;">
                                                                <th style="width:150px;">Root Cause :</th>
                                                                <td>
                                                                    <textarea name="why_root_cause">{{ $whyChart->why_root_cause }}</textarea>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head"></div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="why-why-chart">
                                                    Is/Is Not Analysis
                                                    <span class="text-primary" data-bs-toggle="modal"
                                                        data-bs-target="#is_is_not-instruction-modal"
                                                        style="font-size: 0.8rem; font-weight: 400;">
                                                        (Launch Instruction)
                                                    </span>
                                                </label>
                                                <div class="why-why-chart">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>&nbsp;</th>
                                                                <th>Will Be</th>
                                                                <th>Will Not Be</th>
                                                                <th>Rationale</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th style="background: #0039bd85">What</th>
                                                                <td>
                                                                    <textarea name="what_will_be">{{ $what_who_where->what_will_be }}</textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea name="what_will_not_be">{{ $what_who_where->what_will_not_be }}</textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea name="what_rationable"> {{ $what_who_where->what_rationable }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th style="background: #0039bd85">Where</th>
                                                                <td>
                                                                    <textarea name="where_will_be"> {{ $what_who_where->where_will_be }}</textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea name="where_will_not_be"> {{ $what_who_where->where_will_be }}</textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea name="where_rationable"> {{ $what_who_where->where_will_be }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th style="background: #0039bd85">When</th>
                                                                <td>
                                                                    <textarea name="when_will_be"> {{ $what_who_where->when_will_be }}</textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea name="when_will_not_be">{{ $what_who_where->when_will_not_be }}</textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea name="when_rationable"> {{ $what_who_where->when_rationable }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th style="background: #0039bd85">Coverage</th>
                                                                <td>
                                                                    <textarea name="coverage_will_be"> {{ $what_who_where->coverage_will_be }}</textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea name="coverage_will_not_be"> {{ $what_who_where->coverage_will_not_be }}</textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea name="coverage_rationable"> {{ $what_who_where->coverage_rationable }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th style="background: #0039bd85">Who</th>
                                                                <td>
                                                                    <textarea name="who_will_be"> {{ $what_who_where->who_will_be }}</textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea name="who_will_not_be"> {{ $what_who_where->who_will_not_be }}</textarea>
                                                                </td>
                                                                <td>
                                                                    <textarea name="who_rationable"> {{ $what_who_where->who_rationable }}</textarea>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head"></div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="root_cause_description">Root Cause Description</label>
                                                <textarea {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} name="root_cause_description">{{ $data->root_cause_description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="investigation_summary">Investigation Summary</label>
                                                <textarea {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} name="investigation_summary">{{ $data->investigation_summary }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sub-head">
                                        Risk Analysis
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Severity Rate">Severity Rate</label>
                                                <select name="severity_rate" id="analysisR" onchange='calculateRiskAnalysis(this)'
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->severity_rate == 'Negligible' ? 'selected' : '' }}
                                                        value="1">Negligible</option>
                                                    <option {{ $data->severity_rate == 'Moderate' ? 'selected' : '' }}
                                                        value="2">Moderate</option>
                                                    <option {{ $data->severity_rate == 'Major' ? 'selected' : '' }}
                                                        value="3">Major</option>
                                                    <option {{ $data->severity_rate == 'Fatal' ? 'selected' : '' }}
                                                        value="4">Fatal</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Occurrence">Occurrence</label>
                                                <select name="occurrence" id="analysisP" onchange='calculateRiskAnalysis(this)'
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option
                                                        {{ $data->occurrence == 'Extremely Unlikely' ? 'selected' : '' }}
                                                        value="Extremely Unlikely">Extremely Unlikely</option>
                                                    <option {{ $data->occurrence == '4' ? 'selected' : '' }}
                                                        value="4">Rare</option>
                                                    <option {{ $data->occurrence == '3' ? 'selected' : '' }}
                                                        value="3">Unlikely</option>
                                                    <option {{ $data->occurrence == '2' ? 'selected' : '' }}
                                                        value="2">Likely</option>
                                                    <option {{ $data->occurrence == '1' ? 'selected' : '' }}
                                                        value="1">Very Likely</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Detection">Detection</label>
                                                <select name="detection" id="analysisN" onchange='calculateRiskAnalysis(this)'
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->detection == '5' ? 'selected' : '' }}
                                                        value="5">Impossible</option>
                                                    <option {{ $data->detection == '4' ? 'selected' : '' }}
                                                        value="4">Rare</option>
                                                    <option {{ $data->detection == '3' ? 'selected' : '' }}
                                                        value="3">Unlikely</option>
                                                    <option {{ $data->detection == '2' ? 'selected' : '' }}
                                                        value="2">Likely</option>
                                                    <option {{ $data->detection == '1' ? 'selected' : '' }}
                                                        value="1">Very Likely</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RPN">RPN</label>
                                                <div><small class="text-primary">Auto - Calculated</small></div>
                                                    
                                                    <input readonly type="text" name="rpn" id="analysisRPN" value="{{$data->rpn}}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Residual Risk content -->
                            <div id="CCForm5" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Residual Risk">Residual Risk</label>
                                                <input type="text" name="residual_risk" id="residual_risk"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    value="{{ $data->residual_risk }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Residual Risk Impact">Residual Risk Impact</label>
                                                <select name="residual_risk_impact" id="analysisR2" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                onchange='calculateRiskAnalysis2(this)'>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option value="1" {{ $data->residual_risk_impact == '1' ? 'selected' : '' }}>High</option>
                                                    <option value="2" {{ $data->residual_risk_impact == '2' ? 'selected' : '' }}>Low</option>
                                                    <option value="3" {{ $data->residual_risk_impact == '3' ? 'selected' : '' }}>Medium</option>
                                                    <option value="4" {{ $data->residual_risk_impact == '4' ? 'selected' : '' }}>None</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Residual Risk Probability">Residual Risk Probability</label>
                                                <select name="residual_risk_probability" id="analysisP2" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} onchange='calculateRiskAnalysis2(this)'>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option value="1" {{ $data->residual_risk_probability == '1' ? 'selected' : '' }}>High</option>
                                                    <option value="2" {{ $data->residual_risk_probability == '2' ? 'selected' : '' }}>Medium</option>
                                                    <option value="3" {{ $data->residual_risk_probability == '3' ? 'selected' : '' }}>Low</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Detection">Residual Detection</label>
                                                <select name="detection2" id="analysisN2" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} onchange='calculateRiskAnalysis2(this)'>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option value="5" {{ $data->detection2 == '5' ? 'selected' : '' }}>Impossible</option>
                                                    <option value="4" {{ $data->detection2 == '4' ? 'selected' : '' }}>Rare</option>
                                                    <option value="3" {{ $data->detection2 == '3' ? 'selected' : '' }}>Unlikely</option>
                                                    <option value="2" {{ $data->detection2 == '2' ? 'selected' : '' }}>Likely</option>
                                                    <option value="1" {{ $data->detection2 == '1' ? 'selected' : '' }}>Very Likely</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RPN">Residual RPN</label>
                                                <div><small class="text-primary">Auto - Calculated</small></div>
                                                <input readonly type="text" name="rpn2" id="analysisRPN2" value="{{$data->rpn2}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Comments">Comments</label>
                                                <textarea name="comments2" id="comments2" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>{{ $data->comments2 }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ----------------------------------------------- --}}
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <div id="CCForm6" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="group-input">
                                                {{-- <label for="mitigation_plan_details">
                                                    Mitigation Plan Details<button type="button" name="ann"  {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        onclick="add5Input('mitigation_plan_details')">+</button>
                                                </label> --}}
                                                <label for="mitigation_plan_details">
                                                    Mitigation Plan Details<button type="button" name="ann"
                                                        id="action_plan2">+</button>
                                                </label>
                                                <table class="table table-bordered" id="action_plan_details2">
                                                    <thead>
                                                        <tr>
                                                            <th>Row #</th>
                                                            <th>Mitigation Steps</th>
                                                            <th>
                                                                Deadline
                                                                {{-- Input Type Date --}}
                                                            </th>
                                                            <th>
                                                                Responsible Person
                                                                {{-- Person type Data Field --}}
                                                            </th>
                                                            <th>Status</th>
                                                            <th>Remarks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach (unserialize($mitigation_plan_details->mitigation_steps) as $key => $temps)
                                                        <tr>
                                                            <td><input disabled type="text" name="serial_number[]"
                                                                    value="{{ $key + 1 }}"></td>
                                                            <td><input type="text" name="mitigation_steps[]"
                                                                    value="{{ $temps ? $temps : ' ' }}"></td>
                                                            {{-- <td><input type="date" name="deadline2[]"
                                                                    value="{{ unserialize($mitigation_plan_details->deadline2)[$key] ? unserialize($mitigation_plan_details->deadline2)[$key] : '' }}">
                                                            </td> --}}
                                                            <td><div class="group-input new-date-data-field mb-0">
                                                                <div class="input-date "><div
                                                                class="calenderauditee">
                                                                <input type="text" id="deadline2{{$key}}' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat(unserialize($mitigation_plan_details->deadline2)[$key]) }}" />
                                                                <input type="date" name="deadline2[]" class="hide-input" value="{{ unserialize($mitigation_plan_details->deadline2)[$key] }}"
                                                                oninput="handleDateInput(this, `deadline2{{$key}}' + serialNumber +'`)" /></div></div></div></td>
                                                            {{-- <td><input type="text" name="responsible_person[]"
                                                                    value="{{ unserialize($mitigation_plan_details->responsible_person)[$key] ? unserialize($mitigation_plan_details->responsible_person)[$key] : '' }}">
                                                            </td> --}}
                                                            <td> <select id="select-state" placeholder="Select..."
                                                                name="responsible_person[]">
                                                                <option value="">-Select-</option>
                                                                @foreach ($users as $value)
                                                                    <option
                                                                        {{ unserialize($mitigation_plan_details->responsible_person)[$key] ? (unserialize($mitigation_plan_details->responsible_person)[$key] == $value->id ? 'selected' : ' ') : '' }}
                                                                        value="{{ $value->id }}">
                                                                        {{ $value->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select></td>
                                                            <td><input type="text" name="status[]"
                                                                    value="{{ unserialize($mitigation_plan_details->status)[$key] ? unserialize($mitigation_plan_details->status)[$key] : '' }}">
                                                            </td>
                                                            <td><input type="text" name="remark[]"
                                                                    value="{{ unserialize($mitigation_plan_details->remark)[$key] ? unserialize($mitigation_plan_details->remark)[$key] : '' }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="sub-head">Risk Mitigation</div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="mitigation-required">Mitigation Required</label>
                                                <div class="check-input">
                                                    <label for="yes">
                                                        <input selected type="radio" name="mitigation_required" id="yes">
                                                        Yes
                                                    </label>
                                                    <label for="no">
                                                        <input selected type="radio" name="mitigation_required" id="no">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="mitigation">Mitigation Required</label>
                                                <select name="mitigation_required" placeholder="Select Departments" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} data-search="false"
                                                    data-silent-initial-value-set="true" id="" >
                                                    <option value="">Select Mitigation </option>
                                                    <option value="yes"  {{ $data->mitigation_required == 'yes' ? 'selected' : '' }}>Yes</option>
                                                    <option value="no"  {{ $data->mitigation_status == 'no' ? 'selected' : '' }}>No</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="mitigation-plan">Mitigation Plan</label>
                                                <textarea {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} name="mitigation_plan">{{ $data->mitigation_plan }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="mitigation-due-date">Scheduled End Date</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="mitigation_due_date" readonly value="{{ Helpers::getdateFormat($data->mitigation_due_date)}}"
                                                        name="mitigation_due_date" placeholder="DD-MMM-YYYY" />
                                                    <input type="date" name="mitigation_due_date" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} value="{{ $data->mitigation_due_date }}" class="hide-input"  
                                                        oninput="handleDateInput(this, 'mitigation_due_date')" />
                                                </div>
                                                {{-- <input type="date" name="mitigation_due_date"
                                                    value="{{ $data->mitigation_due_date }}"> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="mitigation-status">Status of Mitigation</label>
                                                <select name="mitigation_status" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="0">-- Select --</option>
                                                    <option value="green"
                                                        {{ $data->mitigation_status == 'green' ? 'selected' : '' }}>Green
                                                        Status</option>
                                                    <option value="amber"
                                                        {{ $data->mitigation_status == 'amber' ? 'selected' : '' }}>Amber
                                                        Status</option>
                                                    <option value="red"
                                                        {{ $data->mitigation_status == 'red' ? 'selected' : '' }}>Red
                                                        Staus</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="mitigation-status-comments">Mitigation Status Comments</label>
                                                <textarea {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} name="mitigation_status_comments">{{ $data->mitigation_status_comments }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="sub-head">Overall Assessment</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="impact">Impact</label>
                                                <select name="impact" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="0">-- Select --</option>
                                                    <option value="high"
                                                        {{ $data->impact == 'high' ? 'selected' : '' }}>High</option>
                                                    <option value="medium"
                                                        {{ $data->impact == 'medium' ? 'selected' : '' }}>Medium</option>
                                                    <option value="low"
                                                        {{ $data->impact == 'low' ? 'selected' : '' }}>Low</option>
                                                    <option value="none"
                                                        {{ $data->impact == 'none' ? 'selected' : '' }}>None</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="criticality">Criticality</label>
                                                <select name="criticality" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="0">-- Select --</option>
                                                    <option value="high"
                                                        {{ $data->criticality == 'high' ? 'selected' : '' }}>High</option>
                                                    <option value="medium"
                                                        {{ $data->criticality == 'medium' ? 'selected' : '' }}>Medium
                                                    </option>
                                                    <option value="low"
                                                        {{ $data->criticality == 'low' ? 'selected' : '' }}>Low</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="impact-analysis">Impact Analysis</label>
                                                <textarea {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} name="impact_analysis">{{ $data->impact_analysis }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="risk-analysis">Risk Analysis</label>
                                                <textarea {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} name="risk_analysis">{{ $data->risk_analysis }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="severity">Severity</label>
                                                <select name="severity">
                                                    <option value="0">-- Select --</option>
                                                    <option value="Negligible"
                                                        {{ $data->severity == 'Negligible' ? 'selected' : '' }}>Negligible
                                                    </option>
                                                    <option value="Minor"
                                                        {{ $data->severity == 'Minor' ? 'selected' : '' }}>Minor</option>
                                                    <option value="Moderate"
                                                        {{ $data->severity == 'Moderate' ? 'selected' : '' }}>Moderate
                                                    </option>
                                                    <option value="Major"
                                                        {{ $data->severity == 'Major' ? 'selected' : '' }}>Major</option>
                                                    <option value="Fatal"
                                                        {{ $data->severity == 'Fatal' ? 'selected' : '' }}>Fatal</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="occurance">Occurance</label>
                                                <select name="occurance">
                                                    <option value="0">-- Select --</option>
                                                    <option value="Extremely_Unlikely">Extremely Unlikely</option>
                                                    <option value="Rare"
                                                        {{ $data->occurance == 'Rare' ? 'selected' : '' }}>Rare</option>
                                                    <option value="Unlikely"
                                                        {{ $data->occurance == 'Unlikely' ? 'selected' : '' }}>Unlikely
                                                    </option>
                                                    <option value="Likely"
                                                        {{ $data->occurance == 'Likely' ? 'selected' : '' }}>Likely
                                                    </option>
                                                    <option value="Very_Likely"
                                                        {{ $data->occurance == 'Very_Likely' ? 'selected' : '' }}>Very
                                                        Likely</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="Reference Recores">Reference Record</label>
                                                <select {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} multiple id="reference_record" name="refrence_record[]" id="">
                                                    {{-- <option value="">--Select---</option> --}}
                                                    @foreach ($old_record as $new)
                                                        <option value="{{ $new->id }}" {{ in_array($new->id, explode(',', $data->refrence_record)) ? 'selected' : '' }}>
                                                            {{ Helpers::getDivisionName($new->division_id) }}/RA/{{ date('Y') }}/{{ Helpers::recordFormat($new->record) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 sub-head">
                                            Extension Justification
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="due_date_extension">Due Date Extension Justification</label>
                                                <div><small class="text-primary">Please Mention justification if due date is crossed</small></div>
                                                <textarea {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} name="due_date_extension">{{$data->due_date_extension}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton">Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        <button type="button"> <a class="text-white"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Signatures content -->
                            <div id="CCForm7" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted By..">Submitted By</label>
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
                                                <label for="Evaluated By">Evaluated By</label>
                                                <div class="static">{{ $data->evaluated_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Evaluated On">Evaluated On</label>
                                                <div class="static">{{ $data->evaluated_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Plan Approved By">Plan Approved By</label>
                                                <div class="static">{{ $data->plan_approved_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Plan Approved On">Plan Approved On</label>
                                                <div class="static">{{ $data->plan_approved_on }}</div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Action Plan Complete">Action Plan Completed By</label>
                                                <div class="static">{{ $data->action_plan_completed_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Action Plan Complete">Action Plan Completed On</label>
                                                <div class="static">{{ $data->action_plan_completed_on }}</div>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Risk Analysis Completed By">Risk Analysis Completed By</label>
                                                <div class="static">{{ $data->risk_analysis_completed_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Risk Analysis Completed On">Risk Analysis Completed On</label>
                                                <div class="static">{{ $data->risk_analysis_completed_on }}</div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="All Actions Completed">All Actions Completed By</label>
                                                <div class="static">{{ $data->all_actions_completed_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="All Actions Completed">All Actions Completed On</label>
                                                <div class="static">{{ $data->all_actions_completed_on }}</div>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Cancel">Cancelled By</label>
                                                <div class="static">{{ $data->cancelled_by }}</div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Cancel">Cancelled On</label>
                                                <div class="static">{{ $data->cancelled_on }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton"
                                            onclick="previousStep()">Back</button>
                                        <button type="submit"
                                            {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>Submit</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

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
                        <form action="{{ route('riskAssesmentStateUpdate', $data->id) }}" method="POST">
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
                                    <label for="comment">Comment</label>
                                    <input type="comment" name="comment">
                                </div>
                            </div>

                            <!-- Modal footer -->
                            <!-- <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button type="button" data-bs-dismiss="modal">Close</button>
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

                        <form action="{{ url('reject_Risk', $data->id) }}" method="POST">
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
            <div class="modal fade" id="child-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('riskAssesmentChild', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    <label for="major">
                                        <input type="radio" name="revision" id="major" value="Action-Item">
                                        Create Action Item
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
                $(document).ready(function() {
                    $('#action_plan').click(function(e) {
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
                                '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="deadline' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="deadline[]" class="hide-input" oninput="handleDateInput(this, `deadline' + serialNumber +'`)" /></div></div></div></td>'
                                 +
                                '<td><input type="text" name="item_static[]"></td>' +
                                '</tr>';



                            return html;
                        }

                        var tableBody = $('#action_plan_details tbody');
                        var rowCount = tableBody.children('tr').length;
                        var newRow = generateTableRow(rowCount + 1);
                        tableBody.append(newRow);
                    });
                    $('#action_plan2').click(function(e) {
                        function generateTableRow(serialNumber) {
                            var users = @json($users);
                            console.log(users);
                            var html =
                            '<tr>' +
                                '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                                '<td><input type="text" name="mitigation_steps[]"></td>' +
                                // '<td><input type="date" name="deadline2[]"></td>' +
                                '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="deadline2' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="deadline2[]" class="hide-input" oninput="handleDateInput(this, `deadline2' + serialNumber +'`)" /></div></div></div></td>'
                                  +
                                '<td><select name="responsible_person[]">' +
                                    '<option value="">Select a value</option>';

                                for (var i = 0; i < users.length; i++) {
                                    html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                                }

                                html += '</select></td>' +
                                '<td><input type="text" name="status[]"></td>' +
                                '<td><input type="text" name="remark[]"></td>' +
                                '</tr>';

                            return html;
                        }

                        var tableBody = $('#action_plan_details2 tbody');
                        var rowCount = tableBody.children('tr').length;
                        var newRow = generateTableRow(rowCount + 1);
                        tableBody.append(newRow);
                    });
                });
            </script>

            <script>
                VirtualSelect.init({
                    ele: '#Facility, #Group, #Audit, #Auditee, #root-cause-methodology, #reference_record, #related_record'
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
            </script>

            <script>
                VirtualSelect.init({
                    ele: '#departments,#departments2, #team_members, #training-require, #impacted_objects'
                });
            </script>
            <script>
                $(document).ready(function() {
                    var loc = new locationInfo();
                    var countryDropdown = $("#country"); 
                    var desiredValue = '{{$data->country}}'; 
                     setTimeout(function() {
                        countryDropdown.find('option[value="{{$data->country}}"]').prop('selected', true);
                         var countryId = jQuery("option:selected", this).attr('countryid');
                            if(countryId != ''){
                                loc.getStates(countryId);
                            }
                            else{
                                jQuery(".states option:gt(0)").remove();
                            }
                        var stateDropdown = $("#state");     
                        stateDropdown.find('option[value="{{$data->state}}"]').prop('selected', true);
                        var stateId = jQuery("option:selected", this).attr('stateid');
                        if(stateId != ''){
                            loc.getCities(stateId);
                        }
                        else{
                            jQuery(".cities option:gt(0)").remove();
                        }
                        var cityDropdown = $("#city");     
                        cityDropdown.find('option[value="{{$data->city}}"]').prop('selected', true);
                    }, 1000);
                });
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
                var maxLength = 255;
                $('#docname').keyup(function() {
                    var textlen = maxLength - $(this).val().length;
                    $('#rchars').text(textlen);});
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
        @endsection
