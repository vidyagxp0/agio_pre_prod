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
    {{--  <script>
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
    </script>  --}}

    <script>
        function calculateRiskAnalysis2(selectElement) {
            let residualRiskImpact = parseFloat(document.getElementById('analysisR2').value) || 0;
            let residualRiskProbability = parseFloat(document.getElementById('analysisP2').value) || 0;
            let residualDetection = parseFloat(document.getElementById('analysisN2').value) || 0;

            let residualRPN = residualRiskImpact * residualRiskProbability * residualDetection;

            document.getElementById('analysisRPN2').value = residualRPN;

            let residualRiskLevel = '';
            if (residualRPN >= 1 && residualRPN <= 24) {
                residualRiskLevel = 'Low';
            } else if (residualRPN >= 25 && residualRPN <= 74) {
                residualRiskLevel = 'Medium';
            } else if (residualRPN >= 75 && residualRPN <= 125) {
                residualRiskLevel = 'High';
            }

            document.getElementById('riskLevel_2').value = residualRiskLevel;
        }
    </script>

    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }

        .main-danger-block {
            display: flex;
        }

        .swal-modal {
            scale: 0.7 !important;
        }

        .whyblock-bottom {
            margin-bottom: 10px;
        }

        .swal-icon {
            scale: 0.8 !important;
        }
    </style>

    @php
        $users = DB::table('users')->get();
    @endphp

    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($data->division_id) }} / Risk Assessment
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
                        $userRoles = DB::table('user_roles')
                            ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])
                            ->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                        $cftRolesAssignUsers = collect($userRoleIds); //->contains(fn ($roleId) => $roleId >= 22 && $roleId <= 33);
                        $cftUsers = DB::table('risk_managment_cfts')
                            ->where(['risk_id' => $data->id])
                            ->first();

                        // Define the column names
                        $columns = [
                            'Production_Table_Person',
                            'Production_Injection_Person',
                            'ResearchDevelopment_person',
                            'Store_person',
                            'Quality_Control_Person',
                            'QualityAssurance_person',
                            'RegulatoryAffair_person',
                            'ProductionLiquid_person',
                            'Microbiology_person',
                            'Engineering_person',
                            'ContractGiver_person',
                            'Environment_Health_Safety_person',
                            'Human_Resource_person',
                            'CorporateQualityAssurance_person',
                        ];

                        // Initialize an array to store the values
                        $valuesArray = [];

                        // Iterate over the columns and retrieve the values
                        foreach ($columns as $column) {
                            $value = $cftUsers->$column;
                            // Check if the value is not null and not equalto 0
                            if ($value !== null && $value != 0) {
                                $valuesArray[] = $value;
                            }
                        }
                        $cftCompleteUser = DB::table('risk_assesment_cft_responces')
                            ->whereIn('status', ['In-progress', 'Completed'])
                            ->where('risk_id', $data->id)
                            ->where('cft_user_id', Auth::user()->id)
                            ->whereNull('deleted_at')
                            ->first();
                        // dd($cftCompleteUser);
                    @endphp
                        {{-- <a href="{{route('riskSingleReport', $data->id)}}"><button class="button_theme1"
                            class="new-doc-btn">Print</button></a> --}}

                        <button class="button_theme1"> <a class="text-white" href="{{ url('riskAuditTrial', $data->id) }}">
                                Audit Trail </a> </button>

                        @if ($data->stage == 1 && Helpers::check_roles($data->division_id, 'Risk Assessment', 3))
                            <!-----------------Helpers::check_roles($data->division_id, 'Root Cause Analysis', 3)----------->
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 2 && Helpers::check_roles($data->division_id, 'Risk Assessment', 4))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                HOD Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>

                            {{-- @elseif(
                                ($data->stage == 3 && Helpers::check_roles($data->division_id, 'Risk Assessment', 5)) ||
                                    in_array(Auth::user()->id, $valuesArray)) --}}
                                    @elseif(
                            ($data->stage == 3 && Helpers::check_roles($data->division_id, 'Risk Assessment', 5)) ||
                                in_array(Auth::user()->id, $valuesArray))
                                     <!-- @if (!$cftCompleteUser)
    -->

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                CFT Review Complete
                            </button>
                                      <!--
    @endif -->


                        @elseif($data->stage == 4 && Helpers::check_roles($data->division_id, 'Risk Assessment', 7))
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                            Request More Info
                        </button>


                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            QA/CQA Review Complete
                        </button>

                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                            Child
                        </button>
                        @elseif($data->stage == 5 && Helpers::check_roles($data->division_id, 'Risk Assessment', 42))

                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                            More Information Required
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            In Approval
                        </button>
                        @endif
                        {{-- @elseif($data->stage == 4 && Helpers::check_roles($data->division_id, 'Risk Assessment', 7) || Helpers::check_roles($data->division_id, 'Risk Assessment', 66))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Request More Info
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA/CQA Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>

                        @elseif($data->stage == 5 && (in_array(42, $userRoleIds) || in_array(65 , $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                In Approval
                            </button>

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Request More Info
                            </button>

                        @endif --}}
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
                                <div class="active">HOD Review</div>
                            @else
                                <div class="">HOD Review</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="active">CFT Review </div>
                            @else
                                <div class="">CFT Review</div>
                            @endif

                            @if ($data->stage >= 4)
                                <div class="active">In QA/CQA Review
                                </div>
                            @else
                                <div class="">In QA/CQA Review</div>
                            @endif


                            @if ($data->stage >= 5)
                                <div class="active">In Approval</div>
                            @else
                                <div class="">In Approval</div>
                            @endif
                            {{-- @if ($data->stage >= 6)
                                <div class="active">Residual Risk Evaluation</div>
                            @else
                                <div class="">Residual Risk Evaluation</div>
                            @endif --}}
                            @if ($data->stage >= 6)
                                <div class="bg-danger">Closed-Done</div>
                            @else
                                <div class="">Closed-Done</div>
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
                        <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Risk Assessment</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm3')">HOD/Designee </button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm4')">CFT Review</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QA/CQA Review</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm6')">QA/CQA Head Approval </button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Activity Log</button>
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Risk/Opportunity details </button> --}}
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Work Group Assignment</button> --}}
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Residual Risk</button> --}}
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Risk Mitigation</button> --}}
                    </div>

                    <form action="{{ route('riskUpdate', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="form_name" id="formNameField" value="">
                        <div id="step-form">

                            <!-- Risk Management Tab content -->
                            <div id="CCForm1" class="inner-block cctabcontent">

                                <div class="inner-block-content">
                                    <div class="sub-head">
                                        General Information
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number"><b>Record Number</b></label>
                                                <input disabled type="text" name="record_number"
                                                    value=" {{ Helpers::getDivisionName($data->division_id) }}/RA/{{ date('Y') }}/{{ $data->record }}">
                                                {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Division Code"><b>Site/Location Code</b></label>
                                                <input readonly type="text" name="division_code"
                                                    value=" {{ Helpers::getDivisionName($data->division_id) }}">
                                                {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
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


                                        <div class="col-md-6 ">
                                            <div class="group-input ">
                                                <label for="due-date"> Date Of Initiation<span
                                                        class="text-danger"></span></label>
                                                <input disabled type="text"
                                                    value="{{ Helpers::getdateFormat($data['intiation_date'] ?? '') }}"
                                                    name="intiation_date">
                                                <input type="hidden" value="{{ $data->intiation_date }}"
                                                    name="intiation_date"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                        {{--  <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Date Due"><b>Date of Initiation</b></label>
                                                <input disabled type="text"
                                                    value="{{ Helpers::getdateFormat($data->intiation_date) }}"
                                                    name="intiation_date">  --}}
                                        {{-- <input type="hidden" value="{{ $data->intiation_date }}" name="intiation_date"> --}}

                                        {{-- <div class="static">{{ date('d-M-Y') }}</div> --}}
                                        {{--  </div>
                                        </div>  --}}

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group"><b>Initiator Department</b></label>
                                                <select {{ Helpers::isRiskAssessment($data->stage) }}
                                                    name="Initiator_Group"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    id="initiator_group">
                                                    <option value="">-- Select --</option>
                                                    <option value="CQA"
                                                        @if ($data->Initiator_Group == 'CQA') selected @endif>Corporate Quality
                                                        Assurance</option>
                                                    <option value="QA"
                                                        @if ($data->Initiator_Group == 'QA') selected @endif>Quality Assurance
                                                    </option>
                                                    <option value="QC"
                                                        @if ($data->Initiator_Group == 'QC') selected @endif>Quality Control
                                                    </option>
                                                    <option value="QM"
                                                        @if ($data->Initiator_Group == 'QM') selected @endif>Quality Control
                                                        (Microbiology department)
                                                    </option>
                                                    <option value="PG"
                                                        @if ($data->Initiator_Group == 'PG') selected @endif>Production
                                                        General</option>
                                                    <option value="PL"
                                                        @if ($data->Initiator_Group == 'PL') selected @endif>Production Liquid
                                                        Orals</option>
                                                    <option value="PT"
                                                        @if ($data->Initiator_Group == 'PT') selected @endif>Production Tablet
                                                        and Powder</option>
                                                    <option value="PE"
                                                        @if ($data->Initiator_Group == 'PE') selected @endif>Production
                                                        External (Ointment, Gels, Creams and Liquid)</option>
                                                    <option value="PC"
                                                        @if ($data->Initiator_Group == 'PC') selected @endif>Production
                                                        Capsules</option>
                                                    <option value="PI"
                                                        @if ($data->Initiator_Group == 'PI') selected @endif>Production
                                                        Injectable</option>
                                                    <option value="EN"
                                                        @if ($data->Initiator_Group == 'EN') selected @endif>Engineering
                                                    </option>
                                                    <option value="HR"
                                                        @if ($data->Initiator_Group == 'HR') selected @endif>Human Resource
                                                    </option>
                                                    <option value="ST"
                                                        @if ($data->Initiator_Group == 'ST') selected @endif>Store</option>
                                                    <option value="IT"
                                                        @if ($data->Initiator_Group == 'IT') selected @endif>Electronic Data
                                                        Processing
                                                    </option>
                                                    <option value="FD"
                                                        @if ($data->Initiator_Group == 'FD') selected @endif>Formulation
                                                        Development
                                                    </option>
                                                    <option value="AL"
                                                        @if ($data->Initiator_Group == 'AL') selected @endif>Analytical
                                                        research and Development Laboratory
                                                    </option>
                                                    <option value="PD"
                                                        @if ($data->Initiator_Group == 'PD') selected @endif>Packaging
                                                        Development
                                                    </option>

                                                    <option value="PU"
                                                        @if ($data->Initiator_Group == 'PU') selected @endif>Purchase
                                                        Department
                                                    </option>
                                                    <option value="DC"
                                                        @if ($data->Initiator_Group == 'DC') selected @endif>Document Cell
                                                    </option>
                                                    <option value="RA"
                                                        @if ($data->Initiator_Group == 'RA') selected @endif>Regulatory
                                                        Affairs
                                                    </option>
                                                    <option value="PV"
                                                        @if ($data->Initiator_Group == 'PV') selected @endif>
                                                        Pharmacovigilance
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group Code">Initiator Department Code</label>
                                                <input {{ Helpers::isRiskAssessment($data->stage) }} type="text"
                                                    name="initiator_group_code" value="{{ $data->Initiator_Group }}"
                                                    id="initiator_group_code" readonly>
                                            </div>
                                        </div>


                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description<span
                                                        class="text-danger">*</span></label><span
                                                    id="rchars">255</span> characters remaining

                                                <input type="text" name="short_description" maxlength="255" id="short_description"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    value="{{ $data->short_description }}" required>
                                            </div>
                                            <p id="docnameError" style="color:red">**Short Description is required</p>
                                        </div> --}}

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description<span
                                                        class="text-danger">*</span></label>
                                                <span id="rchars">255</span> characters remaining
                                                <input name="short_description" id="docname" type="text"
                                                    maxlength="255" required value="{{ $data->short_description }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            </div>
                                            @error('short_description')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-6">
                                            <div class="group-input">
                                                <label for="search">Source of Risk/Opportunity</label>
                                                <select name="source_of_risk" id="source_of_risk" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->source_of_risk == 'Audit' ? 'selected' : '' }} value="Audit">Audit</option>
                                                    <option {{ $data->source_of_risk == 'Complaint' ? 'selected' : '' }} value="Complaint">Complaint</option>
                                                    <option {{ $data->source_of_risk == 'Employee' ? 'selected' : '' }} value="Employee">Employee</option>
                                                    <option {{ $data->source_of_risk == 'Customer' ? 'selected' : '' }} value="Customer">Customer</option>
                                                    <option {{ $data->source_of_risk == 'Regulation' ? 'selected' : '' }} value="Regulation">Regulation</option>
                                                    <option {{ $data->source_of_risk == 'Competition' ? 'selected' : '' }} value="Competition">Competition</option>
                                                    <option {{ $data->source_of_risk == 'Other' ? 'selected' : '' }} value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="typeOfErrorBlock" class="group-input col-6" style="display: none;">
                                            <label for="otherFieldsUser">Other (Source of Risk/Opportunity)</label>
                                            <input type="text" name="other_source_of_risk" class="form-control" value="{{ old('other_source_of_risk', $data->other_source_of_risk ?? '') }}" />
                                        </div>

                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                                        <script>
                                            $(document).ready(function() {
                                                // Initially hide the field
                                                $('#typeOfErrorBlock').hide();

                                                $('select[name=source_of_risk]').change(function() {
                                                    const selectedVal = $(this).val();
                                                    if (selectedVal === 'Other') {
                                                        $('#typeOfErrorBlock').show();
                                                    } else {
                                                        $('#typeOfErrorBlock').hide();
                                                    }
                                                });

                                                // Optionally, check the current value when the page loads in case of form errors
                                                if ($('select[name=source_of_risk]').val() === 'Other') {
                                                    $('#typeOfErrorBlock').show();
                                                }
                                            });
                                        </script>


                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Type..">Type</label>
                                            <select name="type" id="type"
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <option value="">Enter Your Selection Here</option>

                                                <option {{ $data->type == 'Business Risk' ? 'selected' : '' }} value="Business Risk">Business Risk</option>
                                                <option {{ $data->type == 'Customer Related' ? 'selected' : '' }} value="Customer Related">Customer-Related Risk (Complaint)</option>
                                                <option {{ $data->type == 'Opportunity' ? 'selected' : '' }} value="Opportunity">Opportunity</option>
                                                <option {{ $data->type == 'Market' ? 'selected' : '' }} value="Market">Market</option>
                                                <option {{ $data->type == 'Operational_Risk' ? 'selected' : '' }} value="Operational_Risk">Operational Risk</option>
                                                <option {{ $data->type == 'Strategic Risk' ? 'selected' : '' }} value="Strategic Risk">Strategic Risk</option>
                                                <option {{ $data->type == 'Other Data' ? 'selected' : '' }} value="Other Data"> Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="typeOfError" class="group-input col-6" style="display:none;">
                                        <label for="otherFieldsUser">Other(Type)</label>
                                        <input type="text" name="other_type" class="form-control"
                                            value="{{ old('other_type', $data->other_type ?? '') }}" />
                                    </div>

                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                                    <script>
                                        $(document).ready(function() {
                                            // Initially hide the field
                                            $('#typeOfError').hide();

                                            $('select[name=type]').change(function() {
                                                const selectedVal = $(this).val();
                                                if (selectedVal === 'Other Data') { // Corrected value check
                                                    $('#typeOfError').show();
                                                } else {
                                                    $('#typeOfError').hide();
                                                }
                                            });

                                            // Optionally, check the current value when the page loads in case of form errors
                                            if ($('select[name=type]').val() === 'Other Data') { // Corrected value check
                                                $('#typeOfError').show();
                                            }
                                        });
                                    </script>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Priority Level">Priority Level</label>
                                                <select name="priority_level" id="priority_level"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option {{ $data->priority_level == 'High' ? 'selected' : '' }}
                                                        value="High">High</option>
                                                    <option {{ $data->priority_level == 'medium' ? 'selected' : '' }}
                                                        value="medium">medium</option>
                                                    <option {{ $data->priority_level == 'Low' ? 'selected' : '' }}
                                                        value="Low">Low</option>
                                                </select>
                                                @error('priority_level')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- <div class="col-6">
                                            <div class="group-input">
                                                <label for="Description">Other</label>
                                                <textarea name="others_comment" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="others_comment">{{ $data->others_comment }}</textarea>
                                                @error('others_comment')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div> --}}

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Comments">Purpose</label>
                                                <textarea name="purpose" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} id="comments">{{ $data->purpose }}</textarea>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Comments">Scope</label>
                                                <textarea name="scope" id="comments" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->scope }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Comments">Reason for Revision</label>
                                                <textarea name="reason_for_revision" id="comments" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->reason_for_revision }}</textarea>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Comments">Brief Description / Procedure </label>
                                                <textarea name="Brief_description" id="comments" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->Brief_description }}</textarea>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Comments">Documents Used for Risk Management</label>
                                                <textarea name="document_used_risk" id="comments" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->document_used_risk }}</textarea>
                                            </div>
                                        </div>


                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="Comments">Risk/Opportunity Comments</label>
                                                <textarea name="comments" {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="comments">{{ $data->comments }}</textarea>
                                            </div>
                                        </div> --}}



                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="File Attachments">Initial Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="reference">
                                                        @if ($data->risk_attachment)
                                                            @foreach (json_decode($data->risk_attachment) as $file)
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
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile" name="risk_attachment[]"
                                                            oninput="addMultipleFiles(this, 'reference')" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>

                            </div>

                            <!-- Risk Assesment Form -->
                            <div id="CCForm2" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="sub-head">
                                        Risk Assessment
                                    </div>
                                            <div class="row">

                                                {{-- <div class="col-6">
                                                    <div class="group-input">
                                                        <label for="root-cause-methodology">Root Cause Methodology</label>
                                                        @php
                                                            $selectedMethodologies = explode(',', $data->root_cause_methodology);
                                                            if (!in_array('Other_Detail', $selectedMethodologies)) {
                                                                $selectedMethodologies[] = 'Other_Detail';
                                                            }
                                                        @endphp
                                                        <select name="root_cause_methodology[]" multiple
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            id="root-cause-methodology">
                                                            <option value="Why-Why Chart"
                                                                @if (in_array('Why-Why Chart', $selectedMethodologies)) selected @endif>Why-Why Chart
                                                            </option>
                                                            <option value="Failure Mode and Effect Analysis"
                                                                @if (in_array('Failure Mode and Effect Analysis', $selectedMethodologies)) selected @endif>Failure Mode and
                                                                Effect Analysis</option>
                                                            <option value="Other_Detail" @if (in_array('Other_Detail', $selectedMethodologies)) selected @endif>Other </option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div id="rootCause" class="group-input" style="display: none;">
                                                        <label for="otherFieldsUser">Other (Root Cause Methodology)</label>
                                                        <input type="text" name="other_root_cause_methodology" class="form-control" value="{{ old('other_root_cause_methodology', $data->other_root_cause_methodology ?? '') }}"/>
                                                    </div>
                                                </div>

                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


                                                <script>
                                                    $(document).ready(function() {
                                                        // Function to check the current value of the select and toggle the input field
                                                        function toggleOtherField() {
                                                            const selectedVals = $('#root-cause-methodology').val();
                                                            if (selectedVals && selectedVals.includes('Other_Detail')) {
                                                                $('#rootCause').show();
                                                            } else {
                                                                $('#rootCause').hide();
                                                            }
                                                        }

                                                        // Bind the change event to the select field
                                                        $('#root-cause-methodology').change(function() {
                                                            toggleOtherField();
                                                        });

                                                        // Check the current value when the page loads
                                                        toggleOtherField();
                                                    });
                                                </script> --}}

                                                    {{-- TESTING PURPOSE --}}

                                                    {{-- <div class="col-6">
                                                        <div class="group-input">
                                                            <label for="root-cause-methodology">Root Cause Methodology</label>
                                                            @php
                                                                $selectedMethodologies = explode(',', $data->root_cause_methodology);
                                                            @endphp
                                                            <select name="root_cause_methodology[]" multiple
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                id="root-cause-methodology">
                                                                <option value="Why-Why Chart"
                                                                    @if (in_array('Why-Why Chart', $selectedMethodologies)) selected @endif>Why-Why Chart
                                                                </option>
                                                                <option value="Failure Mode and Effect Analysis"
                                                                    @if (in_array('Failure Mode and Effect Analysis', $selectedMethodologies)) selected @endif>Failure Mode and
                                                                    Effect Analysis</option>
                                                                <option value="Other Detail" @if (in_array('Other_Detail', $selectedMethodologies)) selected @endif>Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div id="rootCause" class="group-input" style="display:none;">
                                                            <label for="otherFieldsUser">Other (Root Cause Methodology)</label>
                                                            <input type="text" name="other_root_cause_methodology" id="summernote" class="form-control" value="{{ $data->other_root_cause_methodology ?? '' }}"/>
                                                        </div>
                                                    </div>

                                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                                                    <script>
                                                        $(document).ready(function() {
                                                            // Function to check the current value of the select and toggle the input field
                                                            function toggleOtherField() {
                                                                const selectedVals = $('#root-cause-methodology').val();
                                                                if (selectedVals && selectedVals.includes('Other_Detail')) {
                                                                    $('#rootCause').show();
                                                                } else {
                                                                    $('#rootCause').hide();
                                                                }
                                                            }

                                                            // Bind the change event to the select field
                                                            $('#root-cause-methodology').change(function() {
                                                                toggleOtherField();
                                                            });

                                                            // Check the current value when the page loads
                                                            toggleOtherField();
                                                        });
                                                    </script> --}}

                                                    <div class="col-6">
                                                        <div class="group-input">
                                                            <label for="root-cause-methodology">Root Cause Methodology</label>
                                                            @php
                                                                $selectedMethodologies = explode(',', $data->root_cause_methodology);
                                                            @endphp
                                                            <select name="root_cause_methodology[]" multiple
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                id="root-cause-methodology">
                                                                <option value="Why-Why Chart"
                                                                    @if (in_array('Why-Why Chart', $selectedMethodologies)) selected @endif>Why-Why Chart
                                                                </option>
                                                                <option value="Failure Mode and Effect Analysis"
                                                                    @if (in_array('Failure Mode and Effect Analysis', $selectedMethodologies)) selected @endif>Failure Mode and
                                                                    Effect Analysis</option>
                                                                <option value="Other Detail" @if (in_array('Other Detail', $selectedMethodologies)) selected @endif>Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div id="rootCause" class="group-input" style="display:none;">
                                                            <label for="otherFieldsUser">Other (Root Cause Methodology)</label>
                                                            <textarea name="other_root_cause_methodology" id="summernote" class="form-control">{{ $data->other_root_cause_methodology ?? '' }}</textarea>
                                                        </div>
                                                    </div>

                                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                                                    <script>
                                                        $(document).ready(function() {
                                                            // Ye function select field ka value check kar ke input field ko toggle karta hai
                                                            function toggleOtherField() {
                                                                const selectedVals = $('#root-cause-methodology').val();
                                                                console.log("Selected Values:", selectedVals); // Debugging ke liye value check karo
                                                                if (selectedVals && selectedVals.includes('Other Detail')) {
                                                                    $('#rootCause').show(); // Agar 'Other Detail' select hai to input field dikhao
                                                                } else {
                                                                    $('#rootCause').hide(); // Nahi to input field chhupa do
                                                                }
                                                            }

                                                            // Jab select field ka value change ho to toggleOtherField function ko call karo
                                                            $('#root-cause-methodology').change(function() {
                                                                toggleOtherField();
                                                            });

                                                            // Jab page load ho tab bhi current value check karke input field ko set karo
                                                            toggleOtherField();
                                                        });
                                                    </script>


                                                    {{-- Testing purpose --}}


                                                        <div class="col-12 mb-4" id="fmea-section" style="display:none;">
                                                            <div class="group-input">
                                                                <label for="agenda">
                                                                    Failure Mode and Effect Analysis
                                                                    <button type="button" name="agenda"
                                                                        onclick="addRiskAssessmentdata1('risk-assessment-risk-management')"
                                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>+</button>
                                                                </label>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered" style="width: 200%"  id="risk-assessment-risk-management">
                                                                        <thead>
                                                                            <tr>

                                                                                <th colspan="1"style="text-align:center;"></th>
                                                                                <th colspan="2"style="text-align:center;">Risk Identification</th>
                                                                                <th colspan="1"style="text-align:center;">Risk Analysis</th>
                                                                                <th colspan="4"style="text-align:center;">Risk Evaluation</th>
                                                                                <th colspan="1"style="text-align:center;">Risk Control</th>
                                                                                <th colspan="6"style="text-align:center;">Risk Evaluation</th>
                                                                                <th colspan="2"style="text-align:center;"></th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Row #</th>
                                                                                <th>Activity</th>
                                                                                <th>Possible Risk/Failure (Identified Risk)</th>
                                                                                <th>Consequences of Risk/Potential Causes</th>
                                                                                <th>Severity (S)</th>
                                                                                <th>Probability (P)</th>
                                                                                <th>Detection (D)</th>
                                                                                <th>RPN</th>
                                                                                <th>Control Measures recommended/ Risk mitigation proposed</th>
                                                                                <th>Severity (S)</th>
                                                                                <th>Probability (P)</th>
                                                                                <th>Detection (D)</th>
                                                                                <th>Risk Level (RPN)</th>
                                                                                <th>Category of Risk Level (Low, Medium and High)</th>
                                                                                <th>Risk Acceptance (Y/N)</th>
                                                                                <th>Traceability document</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @if (!empty($riskEffectAnalysis->risk_factor))
                                                                                @foreach (unserialize($riskEffectAnalysis->risk_factor) as $key => $riskFactor)
                                                                                    <tr>
                                                                                        <td>{{ $key + 1 }}</td>
                                                                                        <td><input name="risk_factor[]" type="text"
                                                                                                value="{{ $riskFactor }}"
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                                        </td>
                                                                                        <td><input name="problem_cause[]" type="text"
                                                                                                value="{{ unserialize($riskEffectAnalysis->problem_cause)[$key] ?? null }}"
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                                        </td>
                                                                                        <td><input name="existing_risk_control[]"
                                                                                                type="text"
                                                                                                value="{{ unserialize($riskEffectAnalysis->existing_risk_control)[$key] ?? null }}"
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select onchange="calculateInitialResult(this)"
                                                                                                class="fieldR" name="initial_severity[]"
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                                                <option value="">-- Select --</option>
                                                                                                <option value="1"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_severity)[$key] ?? null) == 1 ? 'selected' : '' }}>
                                                                                                    1-Insignificant</option>
                                                                                                <option value="2"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_severity)[$key] ?? null) == 2 ? 'selected' : '' }}>
                                                                                                    2-Minor</option>
                                                                                                <option value="3"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_severity)[$key] ?? null) == 3 ? 'selected' : '' }}>
                                                                                                    3-Major</option>
                                                                                                <option value="4"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_severity)[$key] ?? null) == 4 ? 'selected' : '' }}>
                                                                                                    4-Critical</option>
                                                                                                <option value="5"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_severity)[$key] ?? null) == 5 ? 'selected' : '' }}>
                                                                                                    5-Catastrophic</option>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select onchange="calculateInitialResult(this)"
                                                                                                class="fieldP" name="initial_detectability[]"
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                                                <option value="">-- Select --</option>
                                                                                                <option value="1"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_detectability)[$key] ?? null) == 1 ? 'selected' : '' }}>
                                                                                                    1-Very rare</option>
                                                                                                <option value="2"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_detectability)[$key] ?? null) == 2 ? 'selected' : '' }}>
                                                                                                    2-Unlikely</option>
                                                                                                <option value="3"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_detectability)[$key] ?? null) == 3 ? 'selected' : '' }}>
                                                                                                    3-Possibly</option>
                                                                                                <option value="4"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_detectability)[$key] ?? null) == 4 ? 'selected' : '' }}>
                                                                                                    4-Likely</option>
                                                                                                <option value="5"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_detectability)[$key] ?? null) == 5 ? 'selected' : '' }}>
                                                                                                    5-Almost certain (every time)</option>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select onchange="calculateInitialResult(this)"
                                                                                                class="fieldN" name="initial_probability[]"
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                                                <option value="">-- Select --</option>
                                                                                                <option value="1"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_probability)[$key] ?? null) == 1 ? 'selected' : '' }}>
                                                                                                    1-Always detected</option>
                                                                                                <option value="2"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_probability)[$key] ?? null) == 2 ? 'selected' : '' }}>
                                                                                                    2-Likely to detect</option>
                                                                                                <option value="3"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_probability)[$key] ?? null) == 3 ? 'selected' : '' }}>
                                                                                                    3-Possible to detect</option>
                                                                                                <option value="4"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_probability)[$key] ?? null) == 4 ? 'selected' : '' }}>
                                                                                                    4-Unlikely to detect</option>
                                                                                                <option value="5"
                                                                                                    {{ (unserialize($riskEffectAnalysis->initial_probability)[$key] ?? null) == 5 ? 'selected' : '' }}>
                                                                                                    5-Not detectable</option>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td><input name="initial_rpn[]" type="text"
                                                                                                class='initial-rpn'
                                                                                                value="{{ unserialize($riskEffectAnalysis->initial_rpn)[$key] ?? null }}"
                                                                                                readonly
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                                        </td>
                                                                                        <td><input name="risk_control_measure[]"
                                                                                                type="text"
                                                                                                value="{{ unserialize($riskEffectAnalysis->risk_control_measure)[$key] ?? null }}"
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select onchange="calculateResidualResult(this)"
                                                                                                class="residual-fieldR"
                                                                                                name="residual_severity[]"
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                                                <option value="">-- Select --</option>
                                                                                                <option value="1"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_severity)[$key] ?? null) == 1 ? 'selected' : '' }}>
                                                                                                    1-Insignificant</option>
                                                                                                <option value="2"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_severity)[$key] ?? null) == 2 ? 'selected' : '' }}>
                                                                                                    2-Minor</option>
                                                                                                <option value="3"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_severity)[$key] ?? null) == 3 ? 'selected' : '' }}>
                                                                                                    3-Major</option>
                                                                                                <option value="4"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_severity)[$key] ?? null) == 4 ? 'selected' : '' }}>
                                                                                                    4-Critical</option>
                                                                                                <option value="5"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_severity)[$key] ?? null) == 5 ? 'selected' : '' }}>
                                                                                                    5-Catastrophic</option>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select onchange="calculateResidualResult(this)"
                                                                                                class="residual-fieldP"
                                                                                                name="residual_probability[]"
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                                                <option value="">-- Select --</option>
                                                                                                <option value="1"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_probability)[$key] ?? null) == 1 ? 'selected' : '' }}>
                                                                                                    1-Very rare</option>
                                                                                                <option value="2"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_probability)[$key] ?? null) == 2 ? 'selected' : '' }}>
                                                                                                    2-Unlikely</option>
                                                                                                <option value="3"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_probability)[$key] ?? null) == 3 ? 'selected' : '' }}>
                                                                                                    3-Possibly</option>
                                                                                                <option value="4"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_probability)[$key] ?? null) == 4 ? 'selected' : '' }}>
                                                                                                    4-Likely</option>
                                                                                                <option value="5"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_probability)[$key] ?? null) == 5 ? 'selected' : '' }}>
                                                                                                    5-Almost certain (every time)</option>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select onchange="calculateResidualResult(this)"
                                                                                                class="residual-fieldN"
                                                                                                name="residual_detectability[]"
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                                                <option value="">-- Select --</option>
                                                                                                <option value="1"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_detectability)[$key] ?? null) == 1 ? 'selected' : '' }}>
                                                                                                    1-Always detected</option>
                                                                                                <option value="2"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_detectability)[$key] ?? null) == 2 ? 'selected' : '' }}>
                                                                                                    2-Likely to detect</option>
                                                                                                <option value="3"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_detectability)[$key] ?? null) == 3 ? 'selected' : '' }}>
                                                                                                    3-Possible to detect</option>
                                                                                                <option value="4"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_detectability)[$key] ?? null) == 4 ? 'selected' : '' }}>
                                                                                                    4-Unlikely to detect</option>
                                                                                                <option value="5"
                                                                                                    {{ (unserialize($riskEffectAnalysis->residual_detectability)[$key] ?? null) == 5 ? 'selected' : '' }}>
                                                                                                    5-Not detectable</option>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td><input name="residual_rpn[]" type="text"
                                                                                                class='residual-rpn'
                                                                                                value="{{ unserialize($riskEffectAnalysis->residual_rpn)[$key] ?? null }}"
                                                                                                readonly></td>
                                                                                        <td>
                                                                                            <input name="risk_acceptance[]"
                                                                                                class="risk-acceptance"
                                                                                                value="{{ unserialize($riskEffectAnalysis->risk_acceptance)[$key] ?? '' }}"
                                                                                                readonly
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select name="risk_acceptance2[]"
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                                                <option value="">-- Select --</option>
                                                                                                <option value="N"
                                                                                                    {{ (unserialize($riskEffectAnalysis->risk_acceptance2)[$key] ?? null) == 'N' ? 'selected' : '' }}>
                                                                                                    N</option>
                                                                                                <option value="Y"
                                                                                                    {{ (unserialize($riskEffectAnalysis->risk_acceptance2)[$key] ?? null) == 'Y' ? 'selected' : '' }}>
                                                                                                    Y</option>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td><input name="mitigation_proposal[]" type="text"
                                                                                                value="{{ unserialize($riskEffectAnalysis->mitigation_proposal)[$key] ?? null }}"
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                                        </td>
                                                                                        <td> <button class="btn btn-dark removeBtn"
                                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Remove</button>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            @endif
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-12" id="why-why-chart-section" style="display:none;">
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

                                                                                    <textarea {{ Helpers::isRiskAssessment($data->stage) }} name="why_problem_statement">{{ $whyChart->why_problem_statement }}</textarea>
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
                                                                                                <textarea {{ Helpers::isRiskAssessment($data->stage) }} name="why_1[]">{{ $measure }}</textarea>
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
                                                                                                <textarea {{ Helpers::isRiskAssessment($data->stage) }} name="why_2[]">{{ $measure }}</textarea>
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
                                                                                                <textarea {{ Helpers::isRiskAssessment($data->stage) }} name="why_3[]">{{ $measure }}</textarea>
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
                                                                                                <textarea {{ Helpers::isRiskAssessment($data->stage) }} name="why_4[]">{{ $measure }}</textarea>
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
                                                                                                <textarea {{ Helpers::isRiskAssessment($data->stage) }} name="why_5[]">{{ $measure }}</textarea>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr style="background: #0080006b;">
                                                                                <th style="width:150px;">Root Cause :</th>
                                                                                <td>
                                                                                    <textarea {{ Helpers::isRiskAssessment($data->stage) }} name="why_root_cause">{{ $whyChart->why_root_cause }}</textarea>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                            </div>


                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="investigation_summary">Risk Assessment Summary <span
                                                    class="text-danger"></span></label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="investigation_summary">{{ $data->investigation_summary }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="investigation_summary">Risk Assessment Conclusion</label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="r_a_conclussion"> {{ $data->r_a_conclussion }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="investigation_summary">Other</label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="risk_a_other"> {{ $data->risk_a_other }}</textarea>
                                        </div>
                                    </div> --}}
                                </div>
                                {{-- <div class="sub-head">
                                    Risk Analysis
                                </div> --}}

                                {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Severity Rate">Severity Rate</label>
                                            <select name="severity_rate" id="analysisR"
                                                onchange='calculateRiskAnalysis(this)'
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <option value="">Enter Your Selection Here</option>
                                                <option {{ $data->severity_rate == 1 ? 'selected' : '' }} value="1">
                                                    1-Insignificant</option>
                                                <option {{ $data->severity_rate == 2 ? 'selected' : '' }} value="2">
                                                    2-Minor</option>
                                                <option {{ $data->severity_rate == 3 ? 'selected' : '' }} value="3">
                                                    3-Major</option>
                                                <option {{ $data->severity_rate == 4 ? 'selected' : '' }} value="4">
                                                    4-Critical</option>
                                                <option {{ $data->severity_rate == 5 ? 'selected' : '' }} value="5">
                                                    5-Catastrophic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Occurrence">Occurrence</label>
                                            <select name="occurrence" id="analysisP"
                                                onchange='calculateRiskAnalysis(this)'
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <option value="">Enter Your Selection Here</option>
                                                <option {{ $data->occurrence == 1 ? 'selected' : '' }} value="1">
                                                    1-Very rare</option>
                                                <option {{ $data->occurrence == 2 ? 'selected' : '' }} value="2">
                                                    2-Unlikely</option>
                                                <option {{ $data->occurrence == 3 ? 'selected' : '' }} value="3">
                                                    3-Possibly</option>
                                                <option {{ $data->occurrence == 4 ? 'selected' : '' }} value="4">
                                                    4-Likely</option>
                                                <option {{ $data->occurrence == 5 ? 'selected' : '' }} value="5">
                                                    5-Almost certain (every time)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Detection">Detection</label>
                                            <select name="detection" id="analysisN"
                                                onchange='calculateRiskAnalysis(this)'
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <option value="">Enter Your Selection Here</option>
                                                <option {{ $data->detection == 1 ? 'selected' : '' }} value="1">
                                                    1-Always detected</option>
                                                <option {{ $data->detection == 2 ? 'selected' : '' }} value="2">
                                                    2-Likely to detect</option>
                                                <option {{ $data->detection == 3 ? 'selected' : '' }} value="3">
                                                    3-Possible to detect</option>
                                                <option {{ $data->detection == 4 ? 'selected' : '' }} value="4">
                                                    4-Unlikely to detect</option>
                                                <option {{ $data->detection == 5 ? 'selected' : '' }} value="5">
                                                    5-Not detectable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="RPN">RPN</label>
                                            <div><small class="text-primary">Auto - Calculated</small></div>
                                            <input type="text" name="rpn" id="analysisRPN"
                                                value="{{ $data->rpn }}" readonly>
                                        </div>
                                    </div> --}}
                                <div class="row">

                                    {{-- <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="File Attachments"> Risk Assesment Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="risk_ana_attach">
                                                    @if ($data->risk_ana_attach)
                                                        @foreach (json_decode($data->risk_ana_attach) as $file)
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
                                                    <input {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="risk_ana_attach[]"
                                                        oninput="addMultipleFiles(this, 'risk_ana_attach')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="File Attachments">Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="risk_ana_attach">
                                                    @if ($data->risk_ana_attach)
                                                        @foreach (json_decode($data->risk_ana_attach) as $file)
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
                                                    <input
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="risk_ana_attach[]"
                                                        oninput="addMultipleFiles(this, 'risk_ana_attach')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="button-block">
                                    <button type="submit" id="ChangesaveButton02" class="saveButton"
                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                </div>
                            </div>
                        </div>

                        <!------------ Hod Designee ---------------------->
                        <div id="CCForm3" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="sub-head">
                                    HOD/Designee
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Microbiology-Person">CFT Reviewer Selection <span class="text-danger"></span></label>
                                        <select multiple name="reviewer_person_value[]"
                                            placeholder="Select CFT Reviewers" data-search="false"
                                            data-silent-initial-value-set="true"  id="reviewer_person_value"  {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                            <!-- <option value="">-- Select --</option> -->
                                            @foreach ($cft as $data1)
                                                @if (Helpers::checkUserRolesMicrobiology_Person($data1))
                                                    @if (in_array($data1->id, $cftReviewerIds))
                                                        <option value="{{ $data1->id }}" {{ in_array($data1->id, $cftReviewerIds) ? 'selected' : '' }}>
                                                            {{ $data1->name }}</option>
                                                    @else
                                                        <option value="{{ $data1->id }}">
                                                            {{ $data1->name }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        @if ($data->stage == 2)
                                        <div class="group-input">
                                            <label for="Closure Comment">HOD/Designee Review Comment<span
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion </small></div>
                                                    <textarea name="hod_des_rev_comm" id="summernote-1"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}   {{$data->stage == 2 ? 'required' : ''}}>{{ $data->hod_des_rev_comm }}</textarea>
                                        </div>
                                        @else
                                        <div class="group-input">
                                            <label for="Closure Comment">HOD/Designee Review Comment<span
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does not  require completion </small></div>
                                                    <textarea readonly name="hod_des_rev_comm" id="summernote-1"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}   {{$data->stage == 2 ? 'required' : ''}}>{{ $data->hod_des_rev_comm }}</textarea>
                                        </div>
                                        @endif

                                    </div>

                                    @if ($data->stage == 2)
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Inv Attachments">HOD/Designee Attachments</label>
                                            <div>
                                                <small class="text-primary">
                                                    Please Attach all relevant or supporting documents
                                                </small>
                                            </div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="hod_design_attach">
                                                    @if ($data->hod_design_attach)
                                                        @foreach (json_decode($data->hod_design_attach) as $file)
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
                                                    <input {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        type="file" id="hod_design_attach" name="hod_design_attach[]"
                                                        oninput="addMultipleFiles(this,'hod_design_attach')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Inv Attachments">HOD/Designee Attachments</label>
                                            <div>
                                                <small class="text-primary">
                                                    Please Attach all relevant or supporting documents
                                                </small>
                                            </div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="hod_design_attach">
                                                    @if ($data->hod_design_attach)
                                                        @foreach (json_decode($data->hod_design_attach) as $file)
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
                                                    <input disabled {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        type="file" id="hod_design_attach" name="hod_design_attach[]"
                                                        oninput="addMultipleFiles(this,'hod_design_attach')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif



                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton" id="saveButton"
                                        {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>


                        <!---CFT-->
                        <div id="CCForm4" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="sub-head">
                                        Production (Tablet/Capsule/Powder)
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                        // Jab page load hota hai toh check karo value
                                        if ($('[name="Production_Table_Review"]').val() === 'yes') {
                                            $('.productionTable').show();
                                            $('.productionTable span').show();
                                        } else {
                                            $('.productionTable').hide();
                                            $('.productionTable span').hide();
                                        }

                                        // Change event ko handle kar
                                        $('[name="Production_Table_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.productionTable').show();
                                                $('.productionTable span').show();
                                            } else {
                                                $('.productionTable').hide();
                                                $('.productionTable span').hide();
                                            }
                                        });
                                    });
                                    </script>
                                    @php
                                        $data1 = DB::table('risk_managment_cfts')
                                            ->where('risk_id', $data->id)
                                            ->first();
                                    @endphp

                                     @if ($data->stage == 2 || $data->stage == 3)
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Production Tablet"> Production Tablet/Capsule/Powder Required ? <span
                                                        class="text-danger">*</span></label>
                                                <select name="Production_Table_Review" id="Production_Table_Review"
                                                    @if ($data->stage == 3) disabled @endif>
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Production_Table_Review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->Production_Table_Review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->Production_Table_Review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                        <option @if ($data1->Production_Table_Review == 'na' || empty($data1->Production_Table_Review)) selected @endif value='na'>NA</option>
                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 51,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <!-- <p>USER ROLE COUNT {{ $data->division_id }}</p> -->
                                        <div class="col-lg-6 productionTable">
                                            <div class="group-input">
                                                <label for="Production Tablet notification">Production Tablet/Capsule/Powder Person
                                                    <span id="asteriskPT"
                                                        style="display: {{ $data1->Production_Table_Review == 'yes' ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span>
                                                </label>
                                                <select @if ($data->stage == 3)  @endif
                                                    name="Production_Table_Person" class="Production_Table_Person"
                                                    id="Production_Table_Person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->Production_Table_Person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 productionTable">
                                            <div class="group-input">
                                                <label for="Production Tablet assessment">Impact Assessment (By
                                                    Production Tablet/Capsule/Powder) <span id="asteriskPT1"
                                                        style="display: {{ $data1->Production_Table_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea @if ($data1->Production_Table_Review == 'yes' && $data->stage == 3) required @endif class="summernote Production_Table_Assessment"
                                                    @if (
                                                        $data->stage == 2 || (isset($data1->Production_Table_Person) && Auth::user()->name != $data1->Production_Table_Person)) readonly @endif name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 mb-3 productionTable">
                                            <div class="group-input">
                                                <label for="Production Tablet feedback">Production Tablet/Capsule/Powder Feedback
                                                    <span id="asteriskPT2"
                                                        style="display: {{ $data1->Production_Table_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote Production_Table_Feedback" @if (
                                                    $data->stage == 2 ||
                                                        (isset($data1->Production_Table_Person) && Auth::user()->name != $data1->Production_Table_Person)) readonly @endif
                                                    name="Production_Table_Feedback" id="summernote-18" @if ($data1->Production_Table_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Production_Table_Feedback }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 productionTable">
                                            <div class="group-input">
                                                <label for="Production Tablet attachment">Production Tablet/Capsule/Powder
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Production_Table_Attachment">
                                                        @if ($data1->Production_Table_Attachment)
                                                            @foreach (json_decode($data1->Production_Table_Attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Production_Table_Attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'Production_Table_Attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 productionTable">
                                            <div class="group-input">
                                                <label for="Production Tablet Completed By">Production Tablet/Capsule/Powder Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->Production_Table_By }}"
                                                    name="Production_Table_By"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                    id="Production_Table_By">
                                            </div>
                                        </div>


                                        <div class="col-6 mb-3 productionTable new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Production Tablet Completed On">Production Tablet/Capsule/Powder
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="Production_Table_On" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->Production_Table_On) }}" />
                                                    <input readonly type="date" name="Production_Table_On"
                                                        min="{{ \Carbon\Carbon::now()->format('d-M-Y') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'Production_Table_On')" />
                                                </div>
                                                @error('Production_Table_On')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var selectField = document.getElementById('Production_Table_Review');
                                                var inputsToToggle = [];

                                                // Add elements with class 'facility-name' to inputsToToggle
                                                var facilityNameInputs = document.getElementsByClassName('Production_Table_Person');
                                                for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    inputsToToggle.push(facilityNameInputs[i]);
                                                }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Table_Assessment');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Table_Feedback');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }

                                                selectField.addEventListener('change', function() {
                                                    var isRequired = this.value === 'yes';
                                                    console.log(this.value, isRequired, 'value');

                                                    inputsToToggle.forEach(function(input) {
                                                        input.required = isRequired;
                                                        console.log(input.required, isRequired, 'input req');
                                                    });

                                                    // Show or hide the asterisk icon based on the selected value
                                                    var asteriskIcon = document.getElementById('asteriskPT');
                                                    asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                });
                                            });
                                        </script>
                                    @else
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Production Tablet">Production Tablet/Capsule/Powder Required ?</label>
                                                <select name="Production_Table_Review" disabled
                                                    id="Production_Table_Review">
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Production_Table_Review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->Production_Table_Review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->Production_Table_Review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                        <option @if ($data1->Production_Table_Review == 'na' || empty($data1->Production_Table_Review)) selected @endif value='na'>NA</option>
                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 51,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 productionTable">
                                            <div class="group-input">
                                                <label for="Production Tablet notification">Production Tablet/Capsule/Powder Person
                                                    <span id="asteriskInvi11" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <select name="Production_Table_Person" disabled
                                                    id="Production_Table_Person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->Production_Table_Person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if ($data->stage == 3)
                                            <div class="col-md-12 mb-3 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet assessment">Impact Assessment (By
                                                        Production
                                                        Tablet/Capsule/Powder)
                                                        <!-- <span
                                                                                                                                                                                                                    id="asteriskInvi12" style="display: none"
                                                                                                                                                                                                                    class="text-danger">*</span> -->
                                                    </label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet feedback">Production Tablet Feedback
                                                        <!-- <span
                                                                                                                                                                                                                    id="asteriskInvi22" style="display: none"
                                                                                                                                                                                                                    class="text-danger">*</span> -->
                                                    </label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Production_Table_Feedback" id="summernote-18">{{ $data1->Production_Table_Feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @else
                                            <div class="col-md-12 mb-3 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet assessment">Impact Assessment (By
                                                        Production
                                                        Tablet/Capsule/Powder)
                                                        <!-- <span
                                                                                                                                                                                                                    id="asteriskInvi12" style="display: none"
                                                                                                                                                                                                                    class="text-danger">*</span> -->
                                                    </label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet feedback">Production
                                                        Tablet/Capsule/Powder Feedback
                                                        <!-- <span id="asteriskInvi22" style="display: none" class="text-danger">*</span> -->
                                                    </label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="Production_Table_Feedback" id="summernote-18">{{ $data1->Production_Table_Feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @endif
                                        <div class="col-12 productionTable">
                                            <div class="group-input">
                                                <label for="Production Tablet attachment">Production Tablet/Capsule/Powder
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Production_Table_Attachment">
                                                        @if ($data1->Production_Table_Attachment)
                                                            @foreach (json_decode($data1->Production_Table_Attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input disabled
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Production_Table_Attachment[]"
                                                            oninput="addMultipleFiles(this, 'Production_Table_Attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 productionTable">
                                            <div class="group-input">
                                                <label for="Production Tablet Completed By">Production Tablet/Capsule/Powder Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->Production_Table_By }}"
                                                    name="Production_Table_By" id="Production_Table_By">


                                            </div>
                                        </div>
                                        <div class="col-6 mb-3 productionTable new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Production Tablet Completed On">Production Tablet/Capsule/Powder
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="Production_Table_On" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->Production_Table_On) }}" />
                                                    <input readonly type="date" name="Production_Table_On"
                                                        min="{{ \Carbon\Carbon::now()->format('d-M-Y') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'Production_Table_On')" />
                                                </div>
                                                @error('Production_Table_On')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif


                                       <div class="sub-head">
                                    Production Injection
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if ($data1->Production_Injection_Review !== 'yes')
                                            $('.productionInjection').hide();

                                            $('[name="Production_Injection_Review"]').change(function() {
                                                if ($(this).val() === 'yes') {

                                                    $('.productionInjection').show();
                                                    $('.productionInjection span').show();
                                                } else {
                                                    $('.productionInjection').hide();
                                                    $('.productionInjection span').hide();
                                                }
                                            });
                                        @endif
                                    });
                                </script>
                                @php
                                    $data1 = DB::table('risk_managment_cfts')
                                        ->where('risk_id', $data->id)
                                        ->first();
                                @endphp

                                @if ($data->stage == 2 || $data->stage == 3)
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Production Injection"> Production Injection Required ? <span
                                                    class="text-danger">*</span></label>
                                            <select name="Production_Injection_Review" id="Production_Injection_Review"
                                                @if ($data->stage == 3) disabled @endif>
                                                <option value="">-- Select --</option>
                                                <option @if ($data1->Production_Injection_Review == 'yes') selected @endif
                                                    value='yes'>
                                                    Yes</option>
                                                <option @if ($data1->Production_Injection_Review == 'no') selected @endif
                                                    value='no'>
                                                    No</option>
                                                {{-- <option @if ($data1->Production_Injection_Review == 'na') selected @endif
                                                    value='na'>
                                                    NA</option> --}}
                                                    <option @if ($data1->Production_Injection_Review == 'na' || empty($data1->Production_Injection_Review)) selected @endif value='na'>NA</option>

                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 53,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection notification">Production Injection Person
                                                <span id="asteriskPT"
                                                    style="display: {{ $data1->Production_Injection_Review == 'yes' ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span>
                                            </label>
                                            <select @if ($data->stage == 3) disabled @endif
                                                name="Production_Injection_Person" class="Production_Injection_Person"
                                                id="Production_Injection_Person">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->name }}"
                                                        @if ($user->name == $data1->Production_Injection_Person) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection assessment">Impact Assessment (By Production
                                                Injection) <span id="asteriskPT1"
                                                    style="display: {{ $data1->Production_Injection_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea @if ($data1->Production_Injection_Review == 'yes' && $data->stage == 3) required @endif class="summernote Production_Injection_Assessment"
                                                @if (
                                                    $data->stage == 2 ||
                                                        (isset($data1->Production_Injection_Person) && Auth::user()->name != $data1->Production_Injection_Person)) readonly @endif name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection feedback">Production Injection Feedback <span
                                                    id="asteriskPT2"
                                                    style="display: {{ $data1->Production_Injection_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea class="summernote Production_Injection_Feedback" @if (
                                                $data->stage == 2 ||
                                                    (isset($data1->Production_Injection_Person) && Auth::user()->name != $data1->Production_Injection_Person)) readonly @endif
                                                name="Production_Injection_Feedback" id="summernote-18" @if ($data1->Production_Injection_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Production_Injection_Feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-12 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection attachment">Production Injection
                                                Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list"
                                                    id="Production_Injection_Attachment">
                                                    @if ($data1->Production_Injection_Attachment)
                                                        @foreach (json_decode($data1->Production_Injection_Attachment) as $file)
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
                                                    <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile"
                                                        name="Production_Injection_Attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'Production_Injection_Attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection Completed By">Production Injection Completed
                                                By</label>
                                            <input readonly type="text"
                                                value="{{ $data1->Production_Injection_By }}"
                                                name="Production_Injection_By"{{ $data->stage == 0 || $data->stage == 6 ? 'readonly' : '' }}
                                                id="Production_Injection_By">


                                        </div>
                                    </div>
                                    <div class="col-6 productionInjection new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Production Injection Completed On">Production Injection
                                                Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="Production_Injection_On" readonly
                                                    placeholder="DD-MMM-YYYY"
                                                    value="{{ Helpers::getdateFormat($data1->Production_Injection_On) }}" />
                                                <input readonly type="date" name="Production_Injection_On"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'Production_Injection_On')" />
                                            </div>
                                            @error('Production_Injection_On')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var selectField = document.getElementById('Production_Injection_Review');
                                            var inputsToToggle = [];

                                            // Add elements with class 'facility-name' to inputsToToggle
                                            var facilityNameInputs = document.getElementsByClassName('Production_Injection_Person');
                                            for (var i = 0; i < facilityNameInputs.length; i++) {
                                                inputsToToggle.push(facilityNameInputs[i]);
                                            }
                                            // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }
                                            // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }

                                            selectField.addEventListener('change', function() {
                                                var isRequired = this.value === 'yes';
                                                console.log(this.value, isRequired, 'value');

                                                inputsToToggle.forEach(function(input) {
                                                    input.required = isRequired;
                                                    console.log(input.required, isRequired, 'input req');
                                                });

                                                // Show or hide the asterisk icon based on the selected value
                                                var asteriskIcon = document.getElementById('asteriskPT');
                                                asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            });
                                        });
                                    </script>
                                @else
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Production Injection">Production Injection Required ?</label>
                                            <select name="Production_Injection_Review" disabled
                                                id="Production_Injection_Review">
                                                <option value="">-- Select --</option>
                                                <option @if ($data1->Production_Injection_Review == 'yes') selected @endif
                                                    value='yes'>
                                                    Yes</option>
                                                <option @if ($data1->Production_Injection_Review == 'no') selected @endif
                                                    value='no'>
                                                    No</option>
                                                {{-- <option @if ($data1->Production_Injection_Review == 'na') selected @endif
                                                    value='na'>
                                                    NA</option> --}}
                                                    <option @if ($data1->Production_Injection_Review == 'na' || empty($data1->Production_Injection_Review)) selected @endif value='na'>NA</option>

                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 53,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection notification">Production Injection Person
                                                <span id="asteriskInvi11" style="display: none"
                                                    class="text-danger">*</span></label>
                                            <select name="Production_Injection_Person" disabled
                                                id="Production_Injection_Person">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->name }}"
                                                        @if ($user->name == $data1->Production_Injection_Person) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if ($data->stage == 3)
                                        <div class="col-md-12 mb-3 productionInjection">
                                            <div class="group-input">
                                                <label for="Production Injection assessment">Impact Assessment (By
                                                    Production Injection)
                                                    <!-- <span
                                                                                                                                                                                                                                                                                                                                                                id="asteriskInvi12" style="display: none"
                                                                                                                                                                                                                                                                                                                                                                class="text-danger">*</span> -->
                                                </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if
                                                        it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 mb-3 productionInjection">
                                            <div class="group-input">
                                                <label for="Production Injection feedback">Production Injection Feedback
                                                    <!-- <span   id="asteriskInvi22" style="display: none" class="text-danger">*</span> -->
                                                </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if
                                                        it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="Production_Injection_Feedback" id="summernote-18">{{ $data1->Production_Injection_Feedback }}</textarea>
                                            </div>
                                        </div> --}}
                                    @else
                                        <div class="col-md-12 mb-3 productionInjection">
                                            <div class="group-input">
                                                <label for="Production Injection assessment">Impact Assessment (By
                                                    Production Injection)
                                                    <!-- <span
                                                                                                                                                                                                                                                                                                                                                                id="asteriskInvi12" style="display: none"
                                                                                                                                                                                                                                                                                                                                                                class="text-danger">*</span> -->
                                                </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if
                                                        it
                                                        does not require completion</small></div>
                                                <textarea disabled class="tiny" name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 mb-3 productionInjection">
                                            <div class="group-input">
                                                <label for="Production Injection feedback">Production Injection Feedback
                                                    <!-- <span
                                                                                                                                                                                                                                                                                                                                                                id="asteriskInvi22" style="display: none"
                                                                                                                                                                                                                                                                                                                                                                class="text-danger">*</span> -->
                                                </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if
                                                        it
                                                        does not require completion</small></div>
                                                <textarea disabled class="tiny" name="Production_Injection_Feedback" id="summernote-18">{{ $data1->Production_Injection_Feedback }}</textarea>
                                            </div>
                                        </div> --}}
                                    @endif
                                    <div class="col-12 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection attachment">Production Injection
                                                Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list"
                                                    id="Production_Injection_Attachment">
                                                    @if ($data1->Production_Injection_Attachment)
                                                        @foreach (json_decode($data1->Production_Injection_Attachment) as $file)
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
                                                    <input disabled
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile"
                                                        name="Production_Injection_Attachment[]"
                                                        oninput="addMultipleFiles(this, 'Production_Injection_Attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection Completed By">Production Injection Completed
                                                By</label>
                                            <input readonly type="text"
                                                value="{{ $data1->Production_Injection_By }}"
                                                name="Production_Injection_By" id="Production_Injection_By">


                                        </div>
                                    </div>
                                    <div class="col-6 productionInjection new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Production Injection Completed On">Production Injection
                                                Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="Production_Injection_On" readonly
                                                    placeholder="DD-MMM-YYYY"
                                                    value="{{ Helpers::getdateFormat($data1->Production_Injection_On) }}" />
                                                <input readonly type="date" name="Production_Injection_On"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'Production_Injection_On')" />
                                            </div>
                                            @error('Production_Injection_On')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                @endif


                                    <div class="sub-head">
                                        Research & Development
                                    </div>
                                    <script>
                                        $(document).ready(function() {

                                            @if ($data1->ResearchDevelopment_Review !== 'yes')
                                                $('.researchDevelopment').hide();

                                                $('[name="ResearchDevelopment_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.researchDevelopment').show();
                                                        $('.researchDevelopment span').show();
                                                    } else {
                                                        $('.researchDevelopment').hide();
                                                        $('.researchDevelopment span').hide();
                                                    }
                                                });
                                            @endif
                                        });
                                    </script>
                                    @php
                                        $data1 = DB::table('risk_managment_cfts')
                                            ->where('risk_id', $data->id)
                                            ->first();
                                    @endphp

                                    @if ($data->stage == 2 || $data->stage == 3)
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Research Development"> Research & Development Required ?
                                                    <span class="text-danger">*</span></label>
                                                <select name="ResearchDevelopment_Review"
                                                    id="ResearchDevelopment_Review"
                                                    @if ($data->stage == 3) disabled @endif>
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->ResearchDevelopment_Review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->ResearchDevelopment_Review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->ResearchDevelopment_Review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                    <option @if ($data1->ResearchDevelopment_Review == 'na' || empty($data1->ResearchDevelopment_Review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 55,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 researchDevelopment">
                                            <div class="group-input">
                                                <label for="Research Development notification">Research & Development
                                                    Person
                                                    <span id="asteriskPT"
                                                        style="display: {{ $data1->ResearchDevelopment_Review == 'yes' ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span>
                                                </label>
                                                <select @if ($data->stage == 3) disabled @endif
                                                    name="ResearchDevelopment_person"
                                                    class="ResearchDevelopment_person"
                                                    id="ResearchDevelopment_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->ResearchDevelopment_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3 researchDevelopment">
                                            <div class="group-input">
                                                <label for="Research Development assessment">Impact Assessment (By
                                                    Research &
                                                    Development) <span id="asteriskPT1"
                                                        style="display: {{ $data1->ResearchDevelopment_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea @if ($data1->ResearchDevelopment_Review == 'yes' && $data->stage == 3) required @endif class="summernote ResearchDevelopment_assessment"
                                                    @if (
                                                        $data->stage == 2 ||
                                                            (isset($data1->ResearchDevelopment_person) && Auth::user()->name != $data1->ResearchDevelopment_person)) readonly @endif name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 mb-3 researchDevelopment">
                                            <div class="group-input">
                                                <label for="Research Development feedback">Research & Development
                                                    Feedback <span id="asteriskPT2"
                                                        style="display: {{ $data1->ResearchDevelopment_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote ResearchDevelopment_feedback" @if (
                                                    $data->stage == 2 ||
                                                        (isset($data1->ResearchDevelopment_person) && Auth::user()->name != $data1->ResearchDevelopment_person)) readonly @endif
                                                    name="ResearchDevelopment_feedback" id="summernote-18" @if ($data1->ResearchDevelopment_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                            </div>
                                        </div> --}}

                                        <div class="col-12 researchDevelopment">
                                            <div class="group-input">
                                                <label for="Research Development attachment">Research & Development
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="ResearchDevelopment_attachment">
                                                        @if ($data1->ResearchDevelopment_attachment)
                                                            @foreach (json_decode($data1->ResearchDevelopment_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="ResearchDevelopment_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'ResearchDevelopment_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 researchDevelopment">
                                            <div class="group-input">
                                                <label for="Research Development Completed By">Research & Development
                                                    Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->ResearchDevelopment_by }}"
                                                    name="ResearchDevelopment_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                    id="ResearchDevelopment_by">


                                            </div>
                                        </div>

                                        <div class="col-6 researchDevelopment new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Research Development Completed On">Research & Development
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="ResearchDevelopment_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->ResearchDevelopment_on) }}" />
                                                    <input readonly type="date" name="ResearchDevelopment_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'ResearchDevelopment_on')" />
                                                </div>
                                                @error('ResearchDevelopment_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var selectField = document.getElementById('ResearchDevelopment_Review');
                                                var inputsToToggle = [];

                                                // Add elements with class 'facility-name' to inputsToToggle
                                                var facilityNameInputs = document.getElementsByClassName('ResearchDevelopment_person');
                                                for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    inputsToToggle.push(facilityNameInputs[i]);
                                                }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }

                                                selectField.addEventListener('change', function() {
                                                    var isRequired = this.value === 'yes';
                                                    console.log(this.value, isRequired, 'value');

                                                    inputsToToggle.forEach(function(input) {
                                                        input.required = isRequired;
                                                        console.log(input.required, isRequired, 'input req');
                                                    });

                                                    // Show or hide the asterisk icon based on the selected value
                                                    var asteriskIcon = document.getElementById('asteriskPT');
                                                    asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                });
                                            });
                                        </script>
                                    @else
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Research Development">Research & Development Required
                                                    ?</label>
                                                <select name="ResearchDevelopment_Review" disabled
                                                    id="ResearchDevelopment_Review">
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->ResearchDevelopment_Review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->ResearchDevelopment_Review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->ResearchDevelopment_Review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                    <option @if ($data1->ResearchDevelopment_Review == 'na' || empty($data1->ResearchDevelopment_Review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 55,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 researchDevelopment">
                                            <div class="group-input">
                                                <label for="Research Development notification">Research & Development
                                                    Person
                                                    <span id="asteriskInvi11" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <select name="ResearchDevelopment_person" disabled
                                                    id="ResearchDevelopment_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->ResearchDevelopment_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if ($data->stage == 3)
                                            <div class="col-md-12 mb-3 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development assessment">Impact Assessment (By
                                                        Research &
                                                        Development)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development feedback">Research & Development
                                                        Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="ResearchDevelopment_feedback" id="summernote-18">{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @else
                                            <div class="col-md-12 mb-3 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development assessment">Impact Assessment (By
                                                        Research &
                                                        Development)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development feedback">Research & Development
                                                        Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="ResearchDevelopment_feedback" id="summernote-18">{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @endif
                                        <div class="col-12 researchDevelopment">
                                            <div class="group-input">
                                                <label for="Research Development attachment">Research & Development
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="ResearchDevelopment_attachment">
                                                        @if ($data1->ResearchDevelopment_attachment)
                                                            @foreach (json_decode($data1->ResearchDevelopment_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input disabled
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="ResearchDevelopment_attachment[]"
                                                            oninput="addMultipleFiles(this, 'ResearchDevelopment_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 researchDevelopment">
                                            <div class="group-input">
                                                <label for="Research Development Completed By">Research & Development
                                                    Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->ResearchDevelopment_by }}"
                                                    name="ResearchDevelopment_by" id="StorResearchDevelopment_by">


                                            </div>
                                        </div>
                                        <div class="col-6 researchDevelopment new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Research Development Completed On">Research & Development
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="ResearchDevelopment_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->ResearchDevelopment_on) }}" />
                                                    <input readonly type="date" name="ResearchDevelopment_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'ResearchDevelopment_on')" />
                                                </div>
                                                @error('ResearchDevelopment_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif


                                    <div class="sub-head">
                                        Human Resource
                                    </div>
                                    <script>
                                        $(document).ready(function() {

                                            @if ($data1->Human_Resource_review !== 'yes')
                                                $('.Human_Resource').hide();

                                                $('[name="Human_Resource_review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.Human_Resource').show();
                                                        $('.Human_Resource span').show();
                                                    } else {
                                                        $('.Human_Resource').hide();
                                                        $('.Human_Resource span').hide();
                                                    }
                                                });
                                            @endif
                                        });
                                    </script>
                                    @php
                                        $data1 = DB::table('risk_managment_cfts')
                                            ->where('risk_id', $data->id)
                                            ->first();
                                    @endphp

                                    @if ($data->stage == 2 || $data->stage == 3)
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Human Resource"> Human Resource Required ? <span
                                                        class="text-danger">*</span></label>
                                                <select name="Human_Resource_review" id="Human_Resource_review"
                                                    @if ($data->stage == 3) disabled @endif>
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Human_Resource_review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->Human_Resource_review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->Human_Resource_review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                    <option @if ($data1->Human_Resource_review == 'na' || empty($data1->Human_Resource_review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 31,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 Human_Resource">
                                            <div class="group-input">
                                                <label for="Human Resource notification">Human Resource Person <span
                                                        id="asteriskPT"
                                                        style="display: {{ $data1->Human_Resource_review == 'yes' ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span>
                                                </label>
                                                <select @if ($data->stage == 3) disabled @endif
                                                    name="Human_Resource_person" class="Human_Resource_person"
                                                    id="Human_Resource_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->Human_Resource_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 Human_Resource">
                                            <div class="group-input">
                                                <label for="Human Resource assessment">Impact Assessment (By Human
                                                    Resource)
                                                    <span id="asteriskPT1"
                                                        style="display: {{ $data1->Human_Resource_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea @if ($data1->Human_Resource_review == 'yes' && $data->stage == 3) required @endif class="summernote Human_Resource_assessment"
                                                    @if ($data->stage == 2 || (isset($data1->Human_Resource_person) && Auth::user()->name != $data1->Human_Resource_person)) readonly @endif name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 mb-3 Human_Resource">
                                            <div class="group-input">
                                                <label for="Human Resource feedback">Human Resource Feedback <span
                                                        id="asteriskPT2"
                                                        style="display: {{ $data1->Human_Resource_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote Human_Resource_feedback" @if ($data->stage == 2 || (isset($data1->Human_Resource_person) && Auth::user()->name != $data1->Human_Resource_person)) readonly @endif
                                                    name="Human_Resource_feedback" id="summernote-18" @if ($data1->Human_Resource_review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Human_Resource_feedback }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 Human_Resource">
                                            <div class="group-input">
                                                <label for="Human Resource attachment">Human Resource
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Human_Resource_attachment">
                                                        @if ($data1->Human_Resource_attachment)
                                                            @foreach (json_decode($data1->Human_Resource_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Human_Resource_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'Human_Resource_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 Human_Resource">
                                            <div class="group-input">
                                                <label for="Human Resource Completed By">Human Resource Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->Human_Resource_by }}"
                                                    name="Human_Resource_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                    id="Human_Resource_by">


                                            </div>
                                        </div>

                                        <div class="col-lg-6 Human_Resource new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Human Resource Completed On">Human Resource
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="Human_Resource_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->Human_Resource_on) }}" />
                                                    <input readonly type="date" name="Human_Resource_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'Human_Resource_on')" />
                                                </div>
                                                @error('Human_Resource_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var selectField = document.getElementById('Human_Resource_review');
                                                var inputsToToggle = [];

                                                // Add elements with class 'facility-name' to inputsToToggle
                                                var facilityNameInputs = document.getElementsByClassName('Human_Resource_person');
                                                for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    inputsToToggle.push(facilityNameInputs[i]);
                                                }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }

                                                selectField.addEventListener('change', function() {
                                                    var isRequired = this.value === 'yes';
                                                    console.log(this.value, isRequired, 'value');

                                                    inputsToToggle.forEach(function(input) {
                                                        input.required = isRequired;
                                                        console.log(input.required, isRequired, 'input req');
                                                    });

                                                    // Show or hide the asterisk icon based on the selected value
                                                    var asteriskIcon = document.getElementById('asteriskPT');
                                                    asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                });
                                            });
                                        </script>
                                    @else
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Human Resource">Human Resource Required ?</label>
                                                <select name="Human_Resource_review" disabled
                                                    id="Human_Resource_review">
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Human_Resource_review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->Human_Resource_review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->Human_Resource_review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                    <option @if ($data1->Human_Resource_review == 'na' || empty($data1->Human_Resource_review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 31,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 Human_Resource">
                                            <div class="group-input">
                                                <label for="Human Resource notification">Human Resource Person <span
                                                        id="asteriskInvi11" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <select name="Human_Resource_person" disabled
                                                    id="Human_Resource_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->Human_Resource_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if ($data->stage == 3)
                                            <div class="col-md-12 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource assessment">Impact Assessment (By Human
                                                        Resource)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource feedback">Human Resource
                                                        Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Human_Resource_feedback" id="summernote-18">{{ $data1->Human_Resource_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @else
                                            <div class="col-md-12 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource assessment">Impact Assessment (By Human
                                                        Resource)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource feedback">Human Resource
                                                        Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="Human_Resource_feedback" id="summernote-18">{{ $data1->Human_Resource_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @endif
                                        <div class="col-12 Human_Resource">
                                            <div class="group-input">
                                                <label for="Human Resource attachment">Human Resource
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Human_Resource_attachment">
                                                        @if ($data1->Human_Resource_attachment)
                                                            @foreach (json_decode($data1->Human_Resource_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input disabled
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Human_Resource_attachment[]"
                                                            oninput="addMultipleFiles(this, 'Human_Resource_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 Human_Resource">
                                            <div class="group-input">
                                                <label for="Human Resource Completed By">Human Resource Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->Human_Resource_by }}"
                                                    name="Human_Resource_by" id="Human_Resource_by">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 Human_Resource new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Human Resource Completed On">Human Resource
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="Human_Resource_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->Human_Resource_on) }}" />
                                                    <input readonly type="date" name="Human_Resource_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'Human_Resource_on')" />
                                                </div>
                                                @error('Human_Resource_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    <div class="sub-head">
                                        Corporate Quality Assurance
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            @if ($data1->CorporateQualityAssurance_Review !== 'yes')
                                                $('.CQA').hide();

                                                $('[name="CorporateQualityAssurance_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.CQA').show();
                                                        $('.CQA span').show();
                                                    } else {
                                                        $('.CQA').hide();
                                                        $('.CQA span').hide();
                                                    }
                                                });
                                            @endif
                                        });
                                    </script>
                                    @php
                                        $data1 = DB::table('risk_managment_cfts')
                                            ->where('risk_id', $data->id)
                                            ->first();
                                    @endphp

                                    @if ($data->stage == 2 || $data->stage == 3)
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Corporate Quality Assurance"> Corporate Quality Assurance
                                                    Required
                                                    ? <span class="text-danger">*</span></label>
                                                <select name="CorporateQualityAssurance_Review"
                                                    id="CorporateQualityAssurance_Review"
                                                    @if ($data->stage == 3) disabled @endif>
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->CorporateQualityAssurance_Review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->CorporateQualityAssurance_Review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->CorporateQualityAssurance_Review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                    <option @if ($data1->CorporateQualityAssurance_Review == 'na' || empty($data1->CorporateQualityAssurance_Review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 58,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 CQA">
                                            <div class="group-input">
                                                <label for="Corporate Quality Assurance notification">Corporate
                                                    Quality
                                                    Assurance Person <span id="asteriskPT"
                                                        style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span>
                                                </label>
                                                <select @if ($data->stage == 3) disabled @endif
                                                    name="CorporateQualityAssurance_person"
                                                    class="CorporateQualityAssurance_person"
                                                    id="CorporateQualityAssurance_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->CorporateQualityAssurance_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 CQA">
                                            <div class="group-input">
                                                <label for="Corporate Quality Assurance assessment">Impact Assessment
                                                    (By
                                                    Corporate Quality
                                                    Assurance) <span id="asteriskPT1"
                                                        style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea @if ($data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 3) required @endif
                                                    class="summernote CorporateQualityAssurance_assessment" @if (
                                                        $data->stage == 2 ||
                                                            (isset($data1->CorporateQualityAssurance_person) &&
                                                                Auth::user()->name != $data1->CorporateQualityAssurance_person)) readonly @endif
                                                    name="CorporateQualityAssurance_assessment" id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 mb-3 CQA">
                                            <div class="group-input">
                                                <label for="Corporate Quality Assurance feedback">Corporate Quality
                                                    Assurance
                                                    Feedback <span id="asteriskPT2"
                                                        style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote CorporateQualityAssurance_feedback" @if (
                                                    $data->stage == 2 ||
                                                        (isset($data1->CorporateQualityAssurance_person) &&
                                                            Auth::user()->name != $data1->CorporateQualityAssurance_person)) readonly @endif
                                                    name="CorporateQualityAssurance_feedback" id="summernote-18"
                                                    @if ($data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 CQA">
                                            <div class="group-input">
                                                <label for="Corporate Quality Assurance attachment">Corporate Quality
                                                    Assurance
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="CorporateQualityAssurance_attachment">
                                                        @if ($data1->CorporateQualityAssurance_attachment)
                                                            @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="CorporateQualityAssurance_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'CorporateQualityAssurance_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 CQA">
                                            <div class="group-input">
                                                <label for="Corporate Quality Assurance Completed By">Corporate
                                                    Quality
                                                    Assurance Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->CorporateQualityAssurance_by }}"
                                                    name="CorporateQualityAssurance_by"{{ $data->stage == 0 || $data->stage == 6 ? 'readonly' : '' }}
                                                    id="CorporateQualityAssurance_by">


                                            </div>
                                        </div>

                                        <div class="col-lg-6 CQA new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Corporate Quality Assurance Completed On">Corporate
                                                    Quality
                                                    Assurance
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="CorporateQualityAssurance_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->CorporateQualityAssurance_on) }}" />
                                                    <input readonly type="date"
                                                        name="CorporateQualityAssurance_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'CorporateQualityAssurance_on')" />
                                                </div>
                                                @error('CorporateQualityAssurance_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var selectField = document.getElementById('CorporateQualityAssurance_Review');
                                                var inputsToToggle = [];

                                                // Add elements with class 'facility-name' to inputsToToggle
                                                var facilityNameInputs = document.getElementsByClassName('CorporateQualityAssurance_person');
                                                for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    inputsToToggle.push(facilityNameInputs[i]);
                                                }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }

                                                selectField.addEventListener('change', function() {
                                                    var isRequired = this.value === 'yes';
                                                    console.log(this.value, isRequired, 'value');

                                                    inputsToToggle.forEach(function(input) {
                                                        input.required = isRequired;
                                                        console.log(input.required, isRequired, 'input req');
                                                    });

                                                    // Show or hide the asterisk icon based on the selected value
                                                    var asteriskIcon = document.getElementById('asteriskPT');
                                                    asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                });
                                            });
                                        </script>
                                    @else
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Corporate Quality Assurance">Corporate Quality Assurance
                                                    Required
                                                    ?</label>
                                                <select name="CorporateQualityAssurance_Review" disabled
                                                    id="CorporateQualityAssurance_Review">
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->CorporateQualityAssurance_Review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->CorporateQualityAssurance_Review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->CorporateQualityAssurance_Review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                    <option @if ($data1->CorporateQualityAssurance_Review == 'na' || empty($data1->CorporateQualityAssurance_Review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 58,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 CQA">
                                            <div class="group-input">
                                                <label for="Corporate Quality Assurance notification">Corporate
                                                    Quality
                                                    Assurance Person <span id="asteriskInvi11" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <select name="CorporateQualityAssurance_person" disabled
                                                    id="CorporateQualityAssurance_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->CorporateQualityAssurance_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if ($data->stage == 3)
                                            <div class="col-md-12 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance assessment">Impact
                                                        Assessment (By
                                                        Corporate
                                                        Quality Assurance)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="CorporateQualityAssurance_assessment" id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance feedback">Corporate
                                                        Quality
                                                        Assurance
                                                        Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="CorporateQualityAssurance_feedback" id="summernote-18">{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @else
                                            <div class="col-md-12 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance assessment">Impact
                                                        Assessment (By
                                                        Corporate
                                                        Quality Assurance)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="CorporateQualityAssurance_assessment" id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance feedback">Corporate
                                                        Quality
                                                        Assurance
                                                        Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="CorporateQualityAssurance_feedback" id="summernote-18">{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @endif
                                        <div class="col-12 CQA">
                                            <div class="group-input">
                                                <label for="Corporate Quality Assurance attachment">Corporate Quality
                                                    Assurance
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="CorporateQualityAssurance_attachment">
                                                        @if ($data1->CorporateQualityAssurance_attachment)
                                                            @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input disabled
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Microbiology_attachment[]"
                                                            oninput="addMultipleFiles(this, 'Microbiology_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 CQA">
                                            <div class="group-input">
                                                <label for="Corporate Quality Assurance Completed By">Corporate
                                                    Quality
                                                    Assurance Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->CorporateQualityAssurance_by }}"
                                                    name="CorporateQualityAssurance_by"
                                                    id="CorporateQualityAssurance_by">


                                            </div>
                                        </div>
                                        <div class="col-lg-6 CQA new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Corporate Quality Assurance Completed On">Corporate
                                                    Quality
                                                    Assurance
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="CorporateQualityAssurance_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->CorporateQualityAssurance_on) }}" />
                                                    <input readonly type="date"
                                                        name="CorporateQualityAssurance_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'CorporateQualityAssurance_on')" />
                                                </div>
                                                @error('CorporateQualityAssurance_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif



                                    <div class="sub-head">
                                        Stores
                                    </div>
                                    <script>
                                        $(document).ready(function() {

                                            @if ($data1->Store_Review !== 'yes')
                                                $('.store').hide();

                                                $('[name="Store_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.store').show();
                                                        $('.store span').show();
                                                    } else {
                                                        $('.store').hide();
                                                        $('.store span').hide();
                                                    }
                                                });
                                            @endif
                                        });
                                    </script>
                                    @php
                                        $data1 = DB::table('risk_managment_cfts')
                                            ->where('risk_id', $data->id)
                                            ->first();
                                    @endphp

                                    @if ($data->stage == 2 || $data->stage == 3)
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Store"> Store Required ? <span
                                                        class="text-danger">*</span></label>
                                                <select name="Store_Review" id="Store_Review"
                                                    @if ($data->stage == 3) disabled @endif>
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Store_Review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->Store_Review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->Store_Review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                    <option @if ($data1->Store_Review == 'na' || empty($data1->Store_Review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 54,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 store">
                                            <div class="group-input">
                                                <label for="Store notification">Store Person <span id="asteriskPT"
                                                        style="display: {{ $data1->Store_Review == 'yes' ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span>
                                                </label>
                                                <select @if ($data->stage == 3) disabled @endif
                                                    name="Store_person" class="Store_person" id="Store_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->Store_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 store">
                                            <div class="group-input">
                                                <label for="Store assessment">Impact Assessment (By Store) <span
                                                        id="asteriskPT1"
                                                        style="display: {{ $data1->Store_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea @if ($data1->Store_Review == 'yes' && $data->stage == 3) required @endif class="summernote Store_assessment"
                                                    @if ($data->stage == 2 || (isset($data1->Store_person) && Auth::user()->name != $data1->Store_person)) readonly @endif name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 mb-3 store">
                                            <div class="group-input">
                                                <label for="store feedback">Store Feedback <span id="asteriskPT2"
                                                        style="display: {{ $data1->Store_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote Store_feedback" @if ($data->stage == 2 || (isset($data1->Store_person) && Auth::user()->name != $data1->Store_person)) readonly @endif
                                                    name="Store_feedback" id="summernote-18" @if ($data1->Store_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Store_feedback }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 store">
                                            <div class="group-input">
                                                <label for="Store attachment">Store Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Store_attachment">
                                                        @if ($data1->Store_attachment)
                                                            @foreach (json_decode($data1->Store_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Store_attachment[]"{{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'Store_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 store">
                                            <div class="group-input">
                                                <label for="Store Completed By">Store Completed
                                                    By</label>
                                                <input readonly type="text" value="{{ $data1->Store_by }}"
                                                    name="Store_by"{{ $data->stage == 0 || $data->stage == 6 ? 'readonly' : '' }}
                                                    id="Store_by">


                                            </div>
                                        </div>

                                        <div class="col-lg-6 store new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Store Completed On">Store
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="Store_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->Store_on) }}" />
                                                    <input readonly type="date" name="Store_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'Store_on')" />
                                                </div>
                                                @error('Store_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var selectField = document.getElementById('Store_Review');
                                                var inputsToToggle = [];

                                                // Add elements with class 'facility-name' to inputsToToggle
                                                var facilityNameInputs = document.getElementsByClassName('Store_person');
                                                for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    inputsToToggle.push(facilityNameInputs[i]);
                                                }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }

                                                selectField.addEventListener('change', function() {
                                                    var isRequired = this.value === 'yes';
                                                    console.log(this.value, isRequired, 'value');

                                                    inputsToToggle.forEach(function(input) {
                                                        input.required = isRequired;
                                                        console.log(input.required, isRequired, 'input req');
                                                    });

                                                    // Show or hide the asterisk icon based on the selected value
                                                    var asteriskIcon = document.getElementById('asteriskPT');
                                                    asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                });
                                            });
                                        </script>
                                    @else
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Store">Store Required ?</label>
                                                <select name="Store_Review" disabled id="Store_Review">
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Store_Review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->Store_Review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->Store_Review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                    <option @if ($data1->Store_Review == 'na' || empty($data1->Store_Review)) selected @endif value='na'>NA</option>
                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 54,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 store">
                                            <div class="group-input">
                                                <label for="Store notification">Store Person <span
                                                        id="asteriskInvi11" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <select name="Store_person" disabled id="Store_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->Store_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if ($data->stage == 3)
                                            <div class="col-md-12 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Store assessment">Impact Assessment (By Store)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Store feedback">Store Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Store_feedback" id="summernote-18">{{ $data1->Store_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @else
                                            <div class="col-md-12 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Store assessment">Impact Assessment (By Store)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Store feedback">Store Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="Store_feedback" id="summernote-18">{{ $data1->Store_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @endif
                                        <div class="col-12 store">
                                            <div class="group-input">
                                                <label for="Store attachment">Store Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Store_attachment">
                                                        @if ($data1->Store_attachment)
                                                            @foreach (json_decode($data1->Store_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input disabled
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Store_attachment[]"
                                                            oninput="addMultipleFiles(this, 'Store_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 store">
                                            <div class="group-input">
                                                <label for="Store Completed By">Store Completed
                                                    By</label>
                                                <input readonly type="text" value="{{ $data1->Store_by }}"
                                                    name="Store_by" id="Store_by">


                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6 store">
                                    <div class="group-input">
                                        <label for="Store Completed On">Store Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input readonly type="date" id="Store_on" name="Store_on"
                                            value="{{ $data1->Store_on }}">
                                    </div>
                                </div> --}}
                                        <div class="col-lg-6 store new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Store Completed On">Store
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="Store_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->Store_on) }}" />
                                                    <input readonly type="date" name="Store_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'Store_on')" />
                                                </div>
                                                @error('Store_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif



                                    <div class="sub-head">
                                        Quality Control
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            @if ($data1->Quality_review !== 'yes')

                                                $('.qualityControl').hide();

                                                $('[name="Quality_review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.qualityControl').show();
                                                        $('.qualityControl span').show();
                                                    } else {
                                                        $('.qualityControl').hide();
                                                        $('.qualityControl span').hide();
                                                    }
                                                });
                                            @endif
                                        });
                                    </script>
                                    @php
                                        $data1 = DB::table('risk_managment_cfts')
                                            ->where('risk_id', $data->id)
                                            ->first();
                                    @endphp

                                    @if ($data->stage == 2 || $data->stage == 3)
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Quality Control"> Quality Control Review Required ? <span
                                                        class="text-danger">*</span></label>
                                                <select name="Quality_review" id="Quality_review_Review"
                                                    @if ($data->stage == 3) disabled @endif>
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Quality_review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->Quality_review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->Quality_review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                    <option @if ($data1->Quality_review == 'na' || empty($data1->Quality_review)) selected @endif value='na'>NA</option>
                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 24,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 qualityControl">
                                            <div class="group-input">
                                                <label for="Quality Control notification">Quality Control Person <span
                                                        id="asteriskPT"
                                                        style="display: {{ $data1->Quality_review == 'yes' ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span>
                                                </label>
                                                <select @if ($data->stage == 3) disabled @endif
                                                    name="Quality_Control_Person" class="Quality_Control_Person"
                                                    id="Quality_Control_Person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->Quality_Control_Person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 qualityControl">
                                            <div class="group-input">
                                                <label for="Quality Control assessment">Impact Assessment (By Quality
                                                    Control)
                                                    <span id="asteriskPT1"
                                                        style="display: {{ $data1->Quality_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea @if ($data1->Quality_review == 'yes' && $data->stage == 3) required @endif class="summernote Quality_Control_assessment"
                                                    @if (
                                                        $data->stage == 2 ||
                                                            (isset($data1->Quality_Control_Person) && Auth::user()->name != $data1->Quality_Control_Person)) readonly @endif name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 mb-3 qualityControl">
                                            <div class="group-input">
                                                <label for="Quality Control feedback">Quality Control Feedback <span
                                                        id="asteriskPT2"
                                                        style="display: {{ $data1->Quality_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote Quality_Control_feedback" @if (
                                                    $data->stage == 2 ||
                                                        (isset($data1->Quality_Control_Person) && Auth::user()->name != $data1->Quality_Control_Person)) readonly @endif
                                                    name="Quality_Control_feedback" id="summernote-18" @if ($data1->Quality_review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Quality_Control_feedback }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 qualityControl">
                                            <div class="group-input">
                                                <label for="Quality Control attachment">Quality Control
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Quality_Control_attachment">
                                                        @if ($data1->Quality_Control_attachment)
                                                            @foreach (json_decode($data1->Quality_Control_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Quality_Control_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'Quality_Control_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 qualityControl">
                                            <div class="group-input">
                                                <label for="Quality Control Completed By">Quality Control Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->Quality_Control_by }}"
                                                    name="Quality_Control_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                    id="Quality_Control_by">


                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6 qualityControl">
                                         <div class="group-input ">
                                        <label for="Quality Control Completed On">Quality Control Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="Quality_Control_on"
                                            name="Quality_Control_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            value="{{ $data1->Quality_Control_on }}">
                                         </div>
                                        </div> --}}
                                        <div class="col-lg-6 qualityControl new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Quality Control Completed On">Quality Control
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="Quality_Control_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->Quality_Control_on) }}" />
                                                    <input readonly type="date" name="Quality_Control_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'Quality_Control_on')" />
                                                </div>
                                                @error('Quality_Control_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var selectField = document.getElementById('Quality_review');
                                                var inputsToToggle = [];

                                                // Add elements with class 'facility-name' to inputsToToggle
                                                var facilityNameInputs = document.getElementsByClassName('Quality_Control_Person');
                                                for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    inputsToToggle.push(facilityNameInputs[i]);
                                                }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }

                                                selectField.addEventListener('change', function() {
                                                    var isRequired = this.value === 'yes';
                                                    console.log(this.value, isRequired, 'value');

                                                    inputsToToggle.forEach(function(input) {
                                                        input.required = isRequired;
                                                        console.log(input.required, isRequired, 'input req');
                                                    });

                                                    // Show or hide the asterisk icon based on the selected value
                                                    var asteriskIcon = document.getElementById('asteriskPT');
                                                    asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                });
                                            });
                                        </script>
                                    @else
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Quality Control">Quality Control Required ?</label>
                                                <select name="Quality_review" disabled id="Quality_review">
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Quality_review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->Quality_review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->Quality_review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                    <option @if ($data1->Quality_review == 'na' || empty($data1->Quality_review)) selected @endif value='na'>NA</option>
                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 24,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 qualityControl">
                                            <div class="group-input">
                                                <label for="Quality Control notification">Quality Control Person <span
                                                        id="asteriskInvi11" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <select name="Quality_Control_Person" disabled
                                                    id="Quality_Control_Person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->Quality_Control_Person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if ($data->stage == 3)
                                            <div class="col-md-12 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control assessment">Impact Assessment (By
                                                        Quality
                                                        Control)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control feedback">Quality Control
                                                        Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Quality_Control_feedback" id="summernote-18">{{ $data1->Quality_Control_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @else
                                            <div class="col-md-12 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control assessment">Impact Assessment (By
                                                        Quality
                                                        Control)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control feedback">Quality Control
                                                        Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="Quality_Control_feedback" id="summernote-18">{{ $data1->Quality_Control_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @endif
                                        <div class="col-12 qualityControl">
                                            <div class="group-input">
                                                <label for="Quality Control attachment">Quality Control
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Quality_Control_attachment">
                                                        @if ($data1->Quality_Control_attachment)
                                                            @foreach (json_decode($data1->Quality_Control_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input disabled
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Store_attachment[]"
                                                            oninput="addMultipleFiles(this, 'Quality_Control_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 qualityControl">
                                            <div class="group-input">
                                                <label for="Quality Control Completed By">Quality Control Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->Quality_Control_by }}"
                                                    name="Quality_Control_by" id="Quality_Control_by">


                                            </div>
                                        </div>
                                        <div class="col-lg-6 qualityControl new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Quality Control Completed On">Quality Control
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="Quality_Control_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->Quality_Control_on) }}" />
                                                    <input readonly type="date" name="Quality_Control_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'Quality_Control_on')" />
                                                </div>
                                                @error('Quality_Control_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif


                                    <div class="sub-head">
                                        Quality Assurance
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            @if ($data1->Quality_Assurance_Review !== 'yes')

                                                $('.quality_assurance').hide();

                                                $('[name="Quality_Assurance_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {
                                                        $('.quality_assurance').show();
                                                        $('.quality_assurance span').show();
                                                    } else {
                                                        $('.quality_assurance').hide();
                                                        $('.quality_assurance span').hide();
                                                    }
                                                });
                                            @endif

                                        });
                                    </script>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Quality Assurance Review Required">Quality Assurance Review
                                                Required ?
                                                <span class="text-danger">*</span></label>
                                            <select @if ($data->stage == 3) required @endif
                                                name="Quality_Assurance_Review" id="Quality_Assurance_Review"
                                                @if ($data->stage == 3) disabled @endif>
                                                <option value="">-- Select --</option>
                                                <option @if ($data1->Quality_Assurance_Review == 'yes') selected @endif
                                                    value="yes">
                                                    Yes</option>
                                                <option @if ($data1->Quality_Assurance_Review == 'no') selected @endif
                                                    value="no">
                                                    No
                                                </option>
                                                {{-- <option @if ($data1->Quality_Assurance_Review == 'na') selected @endif
                                                    value="na">
                                                    NA
                                                </option> --}}
                                                <option @if ($data1->Quality_Assurance_Review == 'na' || empty($data1->Quality_Assurance_Review)) selected @endif value='na'>NA</option>
                                            </select>
                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 26,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        //$users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 quality_assurance">
                                        <div class="group-input">
                                            <label for="Quality Assurance Person">Quality Assurance Person <span
                                                    id="asteriskQQA"
                                                    style="display: {{ $data1->Quality_Assurance_Review == 'yes' ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <select name="QualityAssurance_person" class="QualityAssurance_person"
                                                id="QualityAssurance_person"
                                                @if ($data->stage == 3) disabled @endif>
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option
                                                        {{ $data1->QualityAssurance_person == $user->name ? 'selected' : '' }}
                                                        value="{{ $user->name }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 quality_assurance">
                                        <div class="group-input">
                                            <label for="Impact Assessment3">Impact Assessment (By Quality Assurance)
                                                <span id="asteriskQQA1"
                                                    style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it does
                                                    not require completion</small></div>
                                            <textarea @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 3) required @endif class="summernote QualityAssurance_assessment"
                                                name="QualityAssurance_assessment" @if ($data->stage == 2 || Auth::user()->name != $data1->QualityAssurance_person) readonly @endif id="summernote-23">{{ $data1->QualityAssurance_assessment }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12 mb-3 quality_assurance">
                                        <div class="group-input">
                                            <label for="Quality Assurance Feedback">Quality Assurance Feedback <span
                                                    id="asteriskQQA2"
                                                    style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it does
                                                    not require completion</small></div>
                                            <textarea @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 3) required @endif class="summernote QualityAssurance_feedback"
                                                name="QualityAssurance_feedback" @if ($data->stage == 2 || Auth::user()->name != $data1->QualityAssurance_person) readonly @endif id="summernote-24">{{ $data1->QualityAssurance_feedback }}</textarea>
                                        </div>
                                    </div> --}}

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var selectField = document.getElementById('Quality_Assurance_Review');
                                            var inputsToToggle = [];

                                            // Add elements with class 'facility-name' to inputsToToggle
                                            var facilityNameInputs = document.getElementsByClassName('QualityAssurance_person');
                                            for (var i = 0; i < facilityNameInputs.length; i++) {
                                                inputsToToggle.push(facilityNameInputs[i]);
                                            }

                                            selectField.addEventListener('change', function() {
                                                var isRequired = this.value === 'yes';

                                                inputsToToggle.forEach(function(input) {
                                                    input.required = isRequired;
                                                });

                                                // Show or hide the asterisk icon based on the selected value
                                                var asteriskIcon = document.getElementById('asteriskQQA');
                                                asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            });
                                        });
                                    </script>
                                    <div class="col-12 quality_assurance">
                                        <div class="group-input">
                                            <label for="Quality Assurance Attachments">Quality Assurance
                                                Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list"
                                                    id="Quality_Assurance_attachment">
                                                    @if ($data1->Quality_Assurance_attachment)
                                                        @foreach (json_decode($data1->Quality_Assurance_attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}"
                                                                    target="_blank"><i
                                                                        class="fa fa-eye text-primary"
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
                                                    <input
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile"
                                                        name="Quality_Assurance_attachment[]"
                                                        oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 quality_assurance">
                                        <div class="group-input">
                                            <label for="Quality Assurance Review Completed By">Quality Assurance
                                                Review
                                                Completed By</label>
                                            <input type="text" name="QualityAssurance_by"
                                                id="QualityAssurance_by" value="{{ $data1->QualityAssurance_by }}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3 quality_assurance new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Quality Assurance Review Completed On">Quality Assurance
                                                Review
                                                Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="QualityAssurance_on" readonly
                                                    placeholder="DD-MMM-YYYY"
                                                    value="{{ Helpers::getdateFormat($data1->QualityAssurance_on) }}" />
                                                <input type="date" name="QualityAssurance_on"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-M-d') }}"
                                                    value="" class="hide-input"
                                                    oninput="handleDateInput(this, 'QualityAssurance_on')" />
                                            </div>
                                            @error('QualityAssurance_on')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="sub-head">
                                        Regulatory Affair
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            @if ($data1->RegulatoryAffair_Review !== 'yes')
                                                $('.RegulatoryAffair').hide();

                                                $('[name="RegulatoryAffair_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.RegulatoryAffair').show();
                                                        $('.RegulatoryAffair span').show();
                                                    } else {
                                                        $('.RegulatoryAffair').hide();
                                                        $('.RegulatoryAffair span').hide();
                                                    }
                                                });
                                            @endif
                                        });
                                    </script>
                                    @php
                                        $data1 = DB::table('risk_managment_cfts')
                                            ->where('risk_id', $data->id)
                                            ->first();
                                    @endphp

                                    @if ($data->stage == 2 || $data->stage == 3)
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RegulatoryAffair"> Regulatory Affair Required ? <span
                                                        class="text-danger">*</span></label>
                                                <select name="RegulatoryAffair_Review" id="RegulatoryAffair_Review"
                                                    @if ($data->stage == 3) disabled @endif>
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->RegulatoryAffair_Review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->RegulatoryAffair_Review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->RegulatoryAffair_Review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                        <option @if ($data1->RegulatoryAffair_Review == 'na' || empty($data1->RegulatoryAffair_Review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 57,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 RegulatoryAffair">
                                            <div class="group-input">
                                                <label for="Regulatory Affair notification">Regulatory Affair Person
                                                    <span id="asteriskPT"
                                                        style="display: {{ $data1->RegulatoryAffair_Review == 'yes' ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span>
                                                </label>
                                                <select @if ($data->stage == 3) disabled @endif
                                                    name="RegulatoryAffair_person" class="RegulatoryAffair_person"
                                                    id="RegulatoryAffair_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->RegulatoryAffair_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 RegulatoryAffair">
                                            <div class="group-input">
                                                <label for="Regulatory Affair assessment">Impact Assessment (By
                                                    Regulatory
                                                    Affair) <span id="asteriskPT1"
                                                        style="display: {{ $data1->RegulatoryAffair_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea @if ($data1->RegulatoryAffair_Review == 'yes' && $data->stage == 3) required @endif class="summernote RegulatoryAffair_assessment"
                                                    @if (
                                                        $data->stage == 2 ||
                                                            (isset($data1->RegulatoryAffair_person) && Auth::user()->name != $data1->RegulatoryAffair_person)) readonly @endif name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 mb-3 RegulatoryAffair">
                                            <div class="group-input">
                                                <label for="Regulatory Affair feedback">Regulatory Affair Feedback
                                                    <span id="asteriskPT2"
                                                        style="display: {{ $data1->RegulatoryAffair_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote RegulatoryAffair_feedback" @if (
                                                    $data->stage == 2 ||
                                                        (isset($data1->RegulatoryAffair_person) && Auth::user()->name != $data1->RegulatoryAffair_person)) readonly @endif
                                                    name="RegulatoryAffair_feedback" id="summernote-18" @if ($data1->RegulatoryAffair_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 RegulatoryAffair">
                                            <div class="group-input">
                                                <label for="Regulatory Affair attachment">Regulatory Affair
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="RegulatoryAffair_attachment">
                                                        @if ($data1->RegulatoryAffair_attachment)
                                                            @foreach (json_decode($data1->RegulatoryAffair_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="RegulatoryAffair_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'RegulatoryAffair_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 RegulatoryAffair">
                                            <div class="group-input">
                                                <label for="Regulatory Affair Completed By">Regulatory Affair
                                                    Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->RegulatoryAffair_by }}"
                                                    name="RegulatoryAffair_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                    id="RegulatoryAffair_by">


                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6 RegulatoryAffair">
                                    <div class="group-input ">
                                        <label for="Regulatory Affair Completed On">Regulatory Affair Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="RegulatoryAffair_on"
                                            name="RegulatoryAffair_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            value="{{ $data1->RegulatoryAffair_on }}">
                                    </div>
                                </div> --}}
                                        <div class="col-lg-6 RegulatoryAffair new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Regulatory Affair Completed On">Regulatory Affair
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="RegulatoryAffair_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->RegulatoryAffair_on) }}" />
                                                    <input readonly type="date" name="RegulatoryAffair_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'RegulatoryAffair_on')" />
                                                </div>
                                                @error('RegulatoryAffair_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var selectField = document.getElementById('RegulatoryAffair_Review');
                                                var inputsToToggle = [];

                                                // Add elements with class 'facility-name' to inputsToToggle
                                                var facilityNameInputs = document.getElementsByClassName('RegulatoryAffair_person');
                                                for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    inputsToToggle.push(facilityNameInputs[i]);
                                                }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }

                                                selectField.addEventListener('change', function() {
                                                    var isRequired = this.value === 'yes';
                                                    console.log(this.value, isRequired, 'value');

                                                    inputsToToggle.forEach(function(input) {
                                                        input.required = isRequired;
                                                        console.log(input.required, isRequired, 'input req');
                                                    });

                                                    // Show or hide the asterisk icon based on the selected value
                                                    var asteriskIcon = document.getElementById('asteriskPT');
                                                    asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                });
                                            });
                                        </script>
                                    @else
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Regulatory Affair">Regulatory Affair Required ?</label>
                                                <select name="RegulatoryAffair_Review" disabled
                                                    id="RegulatoryAffair_Review">
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->RegulatoryAffair_Review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->RegulatoryAffair_Review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->RegulatoryAffair_Review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                        <option @if ($data1->RegulatoryAffair_Review == 'na' || empty($data1->RegulatoryAffair_Review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 57,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 RegulatoryAffair">
                                            <div class="group-input">
                                                <label for="Regulatory Affair notification">Regulatory Affair Person
                                                    <span id="asteriskInvi11" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <select name="RegulatoryAffair_person" disabled
                                                    id="RegulatoryAffair_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->RegulatoryAffair_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if ($data->stage == 3)
                                            <div class="col-md-12 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair assessment">Impact Assessment (By
                                                        Regulatory
                                                        Affair)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair feedback">Regulatory Affair
                                                        Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="RegulatoryAffair_feedback" id="summernote-18">{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @else
                                            <div class="col-md-12 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair assessment">Impact Assessment (By
                                                        Regulatory
                                                        Affair)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair feedback">Regulatory Affair
                                                        Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="RegulatoryAffair_feedback" id="summernote-18">{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @endif
                                        <div class="col-12 RegulatoryAffair">
                                            <div class="group-input">
                                                <label for="Regulatory Affair attachment">Regulatory Affair
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="RegulatoryAffair_attachment">
                                                        @if ($data1->RegulatoryAffair_attachment)
                                                            @foreach (json_decode($data1->RegulatoryAffair_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input disabled
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="RegulatoryAffair_attachment[]"
                                                            oninput="addMultipleFiles(this, 'RegulatoryAffair_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 RegulatoryAffair">
                                            <div class="group-input">
                                                <label for="Regulatory Affair Completed By">Regulatory Affair
                                                    Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->RegulatoryAffair_by }}"
                                                    name="RegulatoryAffair_by" id="RegulatoryAffair_by">


                                            </div>
                                        </div>
                                        <div class="col-lg-6 RegulatoryAffair new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Regulatory Affair Completed On">Regulatory Affair
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="RegulatoryAffair_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->RegulatoryAffair_on) }}" />
                                                    <input readonly type="date" name="RegulatoryAffair_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'RegulatoryAffair_on')" />
                                                </div>
                                                @error('RegulatoryAffair_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif



                                    <div class="sub-head">
                                        Production (Liquid/External Preparation)
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            @if ($data1->ProductionLiquid_Review !== 'yes')
                                                $('.productionLiquid').hide();

                                                $('[name="ProductionLiquid_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.productionLiquid').show();
                                                        $('.productionLiquid span').show();
                                                    } else {
                                                        $('.productionLiquid').hide();
                                                        $('.productionLiquid span').hide();
                                                    }
                                                });
                                            @endif
                                        });
                                    </script>
                                    @php
                                        $data1 = DB::table('risk_managment_cfts')
                                            ->where('risk_id', $data->id)
                                            ->first();
                                    @endphp

                                    @if ($data->stage == 2 || $data->stage == 3)
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Production Liquid"> Production Liquid/External preparation Required ? <span
                                                        class="text-danger">*</span></label>
                                                <select name="ProductionLiquid_Review" id="ProductionLiquid_Review"
                                                    @if ($data->stage == 3) disabled @endif>
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->ProductionLiquid_Review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->ProductionLiquid_Review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->ProductionLiquid_Review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                        <option @if ($data1->ProductionLiquid_Review == 'na' || empty($data1->ProductionLiquid_Review)) selected @endif value='na'>NA</option>
                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 52,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 productionLiquid">
                                            <div class="group-input">
                                                <label for="Production Liquid notification">Production Liquid//External preparation Person
                                                    <span id="asteriskPT"
                                                        style="display: {{ $data1->ProductionLiquid_Review == 'yes' ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span>
                                                </label>
                                                <select @if ($data->stage == 3) disabled @endif
                                                    name="ProductionLiquid_person" class="ProductionLiquid_person"
                                                    id="ProductionLiquid_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->ProductionLiquid_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 productionLiquid">
                                            <div class="group-input">
                                                <label for="Production Liquid assessment">Impact Assessment (By
                                                    Production
                                                    Liquid/External preparation) <span id="asteriskPT1"
                                                        style="display: {{ $data1->ProductionLiquid_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea @if ($data1->ProductionLiquid_Review == 'yes' && $data->stage == 3) required @endif class="summernote ProductionLiquid_assessment"
                                                    @if (
                                                        $data->stage == 2 ||
                                                            (isset($data1->ProductionLiquid_person) && Auth::user()->name != $data1->ProductionLiquid_person)) readonly @endif name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 mb-3 productionLiquid">
                                            <div class="group-input">
                                                <label for="Production Liquid feedback">Production Liquid/External preparation Feedback
                                                    <span id="asteriskPT2"
                                                        style="display: {{ $data1->ProductionLiquid_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote ProductionLiquid_feedback" @if (
                                                    $data->stage == 2 ||
                                                        (isset($data1->ProductionLiquid_person) && Auth::user()->name != $data1->ProductionLiquid_person)) readonly @endif
                                                    name="ProductionLiquid_feedback" id="summernote-18" @if ($data1->ProductionLiquid_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->ProductionLiquid_feedback }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 productionLiquid">
                                            <div class="group-input">
                                                <label for="Production Liquid attachment">Production Liquid/External preparation
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="ProductionLiquid_attachment">
                                                        @if ($data1->ProductionLiquid_attachment)
                                                            @foreach (json_decode($data1->ProductionLiquid_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="ProductionLiquid_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 productionLiquid">
                                            <div class="group-input">
                                                <label for="Production Liquid Completed By">Production Liquid/External preparation
                                                    Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->ProductionLiquid_by }}"
                                                    name="ProductionLiquid_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                    id="ProductionLiquid_by">
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6 productionLiquid">
                                    <div class="group-input ">
                                        <label for="Production Liquid Completed On">Production Liquid Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="ProductionLiquid_on"
                                            name="ProductionLiquid_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            value="{{ $data1->ProductionLiquid_on }}">
                                    </div>
                                </div> --}}
                                        <div class="col-lg-6 productionLiquid new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Production Liquid Completed On">Production Liquid/External preparation
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="ProductionLiquid_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->ProductionLiquid_on) }}" />
                                                    <input readonly type="date" name="ProductionLiquid_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'ProductionLiquid_on')" />
                                                </div>
                                                @error('ProductionLiquid_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var selectField = document.getElementById('ProductionLiquid_Review');
                                                var inputsToToggle = [];

                                                // Add elements with class 'facility-name' to inputsToToggle
                                                var facilityNameInputs = document.getElementsByClassName('ProductionLiquid_person');
                                                for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    inputsToToggle.push(facilityNameInputs[i]);
                                                }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }

                                                selectField.addEventListener('change', function() {
                                                    var isRequired = this.value === 'yes';
                                                    console.log(this.value, isRequired, 'value');

                                                    inputsToToggle.forEach(function(input) {
                                                        input.required = isRequired;
                                                        console.log(input.required, isRequired, 'input req');
                                                    });

                                                    // Show or hide the asterisk icon based on the selected value
                                                    var asteriskIcon = document.getElementById('asteriskPT');
                                                    asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                });
                                            });
                                        </script>
                                    @else
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Production Liquid">Production Liquid/External preparation Required ?</label>
                                                <select name="ProductionLiquid_Review" disabled
                                                    id="ProductionLiquid_Review">
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->ProductionLiquid_Review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->ProductionLiquid_Review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->ProductionLiquid_Review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                        <option @if ($data1->ProductionLiquid_Review == 'na' || empty($data1->ProductionLiquid_Review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 52,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 productionLiquid">
                                            <div class="group-input">
                                                <label for="Production Liquid notification">Production Liquid/External preparation Person
                                                    <span id="asteriskInvi11" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <select name="ProductionLiquid_person" disabled
                                                    id="ProductionLiquid_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->ProductionLiquid_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if ($data->stage == 3)
                                            <div class="col-md-12 mb-3 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid assessment">Impact Assessment (By
                                                        Production
                                                        Liquid/External preparation)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid feedback">Production Liquid/External preparation
                                                        Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="ProductionLiquid_feedback" id="summernote-18">{{ $data1->ProductionLiquid_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @else
                                            <div class="col-md-12 mb-3 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid assessment">Impact Assessment (By
                                                        Production
                                                        Liquid/External preparation)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid feedback">Production Liquid/External preparation
                                                        Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="ProductionLiquid_feedback" id="summernote-18">{{ $data1->ProductionLiquid_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @endif
                                        <div class="col-12 productionLiquid">
                                            <div class="group-input">
                                                <label for="Production Liquid attachment">Production Liquid/External preparation
                                                    Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="ProductionLiquid_attachment">
                                                        @if ($data1->ProductionLiquid_attachment)
                                                            @foreach (json_decode($data1->ProductionLiquid_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input disabled
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="ProductionLiquid_attachment[]"
                                                            oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 productionLiquid">
                                            <div class="group-input">
                                                <label for="Production Liquid Completed By">Production Liquid/External preparation
                                                    Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->ProductionLiquid_by }}"
                                                    name="ProductionLiquid_by" id="ProductionLiquid_by">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 productionLiquid new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Production Liquid Completed On">Production Liquid/External preparation
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="ProductionLiquid_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->ProductionLiquid_on) }}" />
                                                    <input readonly type="date" name="ProductionLiquid_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'ProductionLiquid_on')" />
                                                </div>
                                                @error('ProductionLiquid_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif



                                    <div class="sub-head">
                                        Microbiology
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            @if ($data1->Microbiology_Review !== 'yes')
                                                $('.Microbiology').hide();

                                                $('[name="Microbiology_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.Microbiology').show();
                                                        $('.Microbiology span').show();
                                                    } else {
                                                        $('.Microbiology').hide();
                                                        $('.Microbiology span').hide();
                                                    }
                                                });
                                            @endif
                                        });
                                    </script>
                                    @php
                                        $data1 = DB::table('risk_managment_cfts')
                                            ->where('risk_id', $data->id)
                                            ->first();
                                    @endphp

                                    @if ($data->stage == 2 || $data->stage == 3)
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Microbiology"> Microbiology Required ? <span
                                                        class="text-danger">*</span></label>
                                                <select name="Microbiology_Review" id="Microbiology_Review">
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Microbiology_Review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->Microbiology_Review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->Microbiology_Review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                        <option @if ($data1->Microbiology_Review == 'na' || empty($data1->Microbiology_Review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 56,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 Microbiology">
                                            <div class="group-input">
                                                <label for="Microbiology notification">Microbiology Person <span
                                                        id="asteriskPT"
                                                        style="display: {{ $data1->Microbiology_Review == 'yes' ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span>
                                                </label>
                                                <select @if ($data->stage == 3) disabled @endif
                                                    name="Microbiology_person" class="Microbiology_person"
                                                    id="Microbiology_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->Microbiology_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 Microbiology">
                                            <div class="group-input">
                                                <label for="Microbiology assessment">Impact Assessment (By
                                                    Microbiology) <span id="asteriskPT1"
                                                        style="display: {{ $data1->Microbiology_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea @if ($data1->Microbiology_Review == 'yes' && $data->stage == 3) required @endif class="summernote Microbiology_assessment"
                                                    @if ($data->stage == 2 || (isset($data1->Microbiology_person) && Auth::user()->name != $data1->Microbiology_person)) readonly @endif name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 mb-3 Microbiology">
                                            <div class="group-input">
                                                <label for="Microbiology feedback">Microbiology Feedback <span
                                                        id="asteriskPT2"
                                                        style="display: {{ $data1->Microbiology_Review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote Microbiology_feedback" @if ($data->stage == 2 || (isset($data1->Microbiology_person) && Auth::user()->name != $data1->Microbiology_person)) readonly @endif
                                                    name="Microbiology_feedback" id="summernote-18" @if ($data1->Microbiology_Review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Microbiology_feedback }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 Microbiology">
                                            <div class="group-input">
                                                <label for="Microbiology attachment">Microbiology Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Microbiology_attachment">
                                                        @if ($data1->Microbiology_attachment)
                                                            @foreach (json_decode($data1->Microbiology_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Microbiology_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'Microbiology_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 Microbiology">
                                            <div class="group-input">
                                                <label for="Microbiology Completed By">Microbiology Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->Microbiology_by }}"
                                                    name="Microbiology_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                    id="Microbiology_by">


                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6 Microbiology">
                                         <div class="group-input ">
                                        <label for="Microbiology Completed On">Microbiology Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="Microbiology_on"
                                            name="Microbiology_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            value="{{ $data1->Microbiology_on }}">
                                         </div>
                                      </div> --}}
                                        <div class="col-lg-6 Microbiology new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Microbiology Completed On">Microbiology
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="Microbiology_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->Microbiology_on) }}" />
                                                    <input readonly type="date" name="Microbiology_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'Microbiology_on')" />
                                                </div>
                                                @error('Microbiology_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var selectField = document.getElementById('Microbiology_Review');
                                                var inputsToToggle = [];

                                                // Add elements with class 'facility-name' to inputsToToggle
                                                var facilityNameInputs = document.getElementsByClassName('Microbiology_person');
                                                for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    inputsToToggle.push(facilityNameInputs[i]);
                                                }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }

                                                selectField.addEventListener('change', function() {
                                                    var isRequired = this.value === 'yes';
                                                    console.log(this.value, isRequired, 'value');

                                                    inputsToToggle.forEach(function(input) {
                                                        input.required = isRequired;
                                                        console.log(input.required, isRequired, 'input req');
                                                    });

                                                    // Show or hide the asterisk icon based on the selected value
                                                    var asteriskIcon = document.getElementById('asteriskPT');
                                                    asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                });
                                            });
                                        </script>
                                    @else
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Microbiology">Microbiology Required ?</label>
                                                <select name="Microbiology_Review" disabled
                                                    id="Microbiology_Review">
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Microbiology_Review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->Microbiology_Review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->Microbiology_Review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                        <option @if ($data1->Microbiology_Review == 'na' || empty($data1->Microbiology_Review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 56,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 Microbiology">
                                            <div class="group-input">
                                                <label for="Microbiology notification">Microbiology Person <span
                                                        id="asteriskInvi11" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <select name="Microbiology_person" disabled
                                                    id="Microbiology_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->Microbiology_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if ($data->stage == 3)
                                            <div class="col-md-12 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology assessment">Impact Assessment (By
                                                        Microbiology)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology feedback">Microbiology Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Microbiology_feedback" id="summernote-18">{{ $data1->Microbiology_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @else
                                            <div class="col-md-12 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology assessment">Impact Assessment (By
                                                        Microbiology)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology feedback">Microbiology Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="Microbiology_feedback" id="summernote-18">{{ $data1->Microbiology_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @endif
                                        <div class="col-12 Microbiology">
                                            <div class="group-input">
                                                <label for="Microbiology attachment">Microbiology Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Microbiology_attachment">
                                                        @if ($data1->Microbiology_attachment)
                                                            @foreach (json_decode($data1->Microbiology_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input disabled
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Microbiology_attachment[]"
                                                            oninput="addMultipleFiles(this, 'Microbiology_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 Microbiology">
                                            <div class="group-input">
                                                <label for="Microbiology Completed By">Microbiology Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->Microbiology_by }}" name="Microbiology_by"
                                                    id="Microbiology_by">


                                            </div>
                                        </div>
                                        <div class="col-lg-6 Microbiology new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Microbiology Completed On">Microbiology
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="Microbiology_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->Microbiology_on) }}" />
                                                    <input readonly type="date" name="Microbiology_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'Microbiology_on')" />
                                                </div>
                                                @error('Microbiology_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    <div class="sub-head">
                                        Engineering
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            @if ($data1->Engineering_review !== 'yes')
                                                $('.Engineering').hide();

                                                $('[name="Engineering_review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.Engineering').show();
                                                        $('.Engineering span').show();
                                                    } else {
                                                        $('.Engineering').hide();
                                                        $('.Engineering span').hide();
                                                    }
                                                });
                                            @endif
                                        });
                                    </script>
                                    @php
                                        $data1 = DB::table('risk_managment_cfts')
                                            ->where('risk_id', $data->id)
                                            ->first();
                                    @endphp

                                    @if ($data->stage == 2 || $data->stage == 3)
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Engineering"> Engineering Required ? <span
                                                        class="text-danger">*</span></label>
                                                <select name="Engineering_review" id="Engineering_review"
                                                    @if ($data->stage == 3) disabled @endif>
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Engineering_review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->Engineering_review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->Engineering_review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                        <option @if ($data1->Engineering_review == 'na' || empty($data1->Engineering_review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 25,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 Engineering">
                                            <div class="group-input">
                                                <label for="Engineering notification">Engineering Person <span
                                                        id="asteriskPT"
                                                        style="display: {{ $data1->Engineering_review == 'yes' ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span>
                                                </label>
                                                <select @if ($data->stage == 3) disabled @endif
                                                    name="Engineering_person" class="Engineering_person"
                                                    id="Engineering_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->Engineering_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 Engineering">
                                            <div class="group-input">
                                                <label for="Engineering assessment">Impact Assessment (By Engineering)
                                                    <span id="asteriskPT1"
                                                        style="display: {{ $data1->Engineering_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea @if ($data1->Engineering_review == 'yes' && $data->stage == 3) required @endif class="summernote Engineering_assessment"
                                                    @if ($data->stage == 2 || (isset($data1->Engineering_person) && Auth::user()->name != $data1->Engineering_person)) readonly @endif name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 mb-3 Engineering">
                                            <div class="group-input">
                                                <label for="Engineering feedback">Engineering Feedback <span
                                                        id="asteriskPT2"
                                                        style="display: {{ $data1->Engineering_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote Engineering_feedback" @if ($data->stage == 2 || (isset($data1->Engineering_person) && Auth::user()->name != $data1->Engineering_person)) readonly @endif
                                                    name="Engineering_feedback" id="summernote-18" @if ($data1->Engineering_review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Engineering_feedback }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 Engineering">
                                            <div class="group-input">
                                                <label for="Engineering attachment">Engineering Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Engineering_attachment">
                                                        @if ($data1->Engineering_attachment)
                                                            @foreach (json_decode($data1->Engineering_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Engineering_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'Engineering_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 Engineering">
                                            <div class="group-input">
                                                <label for="Engineering Completed By">Engineering Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->Engineering_by }}"
                                                    name="Engineering_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                    id="Engineering_by">


                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6 Engineering">
                                    <div class="group-input ">
                                        <label for="Engineering Completed On">Engineering Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="Engineering_on"
                                            name="Engineering_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            value="{{ $data1->Engineering_on }}">
                                    </div>
                                </div> --}}
                                        <div class="col-lg-6 Engineering new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Store Completed On">Engineering
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="Engineering_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->Engineering_on) }}" />
                                                    <input readonly type="date" name="Engineering_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'Engineering_on')" />
                                                </div>
                                                @error('Engineering_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var selectField = document.getElementById('Engineering_review');
                                                var inputsToToggle = [];

                                                // Add elements with class 'facility-name' to inputsToToggle
                                                var facilityNameInputs = document.getElementsByClassName('Engineering_person');
                                                for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    inputsToToggle.push(facilityNameInputs[i]);
                                                }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }

                                                selectField.addEventListener('change', function() {
                                                    var isRequired = this.value === 'yes';
                                                    console.log(this.value, isRequired, 'value');

                                                    inputsToToggle.forEach(function(input) {
                                                        input.required = isRequired;
                                                        console.log(input.required, isRequired, 'input req');
                                                    });

                                                    // Show or hide the asterisk icon based on the selected value
                                                    var asteriskIcon = document.getElementById('asteriskPT');
                                                    asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                });
                                            });
                                        </script>
                                    @else
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Engineering">Engineering Required ?</label>
                                                <select name="Engineering_review" disabled id="Engineering_review">
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Engineering_review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->Engineering_review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->Engineering_review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                        <option @if ($data1->Engineering_review == 'na' || empty($data1->Engineering_review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 25,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 Engineering">
                                            <div class="group-input">
                                                <label for="Engineering notification">Engineering Person <span
                                                        id="asteriskInvi11" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <select name="Engineering_person" disabled id="Engineering_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->Engineering_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if ($data->stage == 3)
                                            <div class="col-md-12 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering assessment">Impact Assessment (By
                                                        Engineering)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering feedback">Engineering Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Engineering_feedback" id="summernote-18">{{ $data1->Engineering_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @else
                                            <div class="col-md-12 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering assessment">Impact Assessment (By
                                                        Engineering)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering feedback">Engineering Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="Engineering_feedback" id="summernote-18">{{ $data1->Engineering_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @endif
                                        <div class="col-12 Engineering">
                                            <div class="group-input">
                                                <label for="Engineering attachment">Engineering Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Engineering_attachment">
                                                        @if ($data1->Engineering_attachment)
                                                            @foreach (json_decode($data1->Engineering_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input disabled
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Engineering_attachment[]"
                                                            oninput="addMultipleFiles(this, 'Engineering_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 Engineering">
                                            <div class="group-input">
                                                <label for="Engineering Completed By">Engineering Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->Engineering_by }}" name="Engineering_by"
                                                    id="Engineering_by">


                                            </div>
                                        </div>
                                        <div class="col-lg-6 Engineering new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Store Completed On">Engineering
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="Engineering_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->Engineering_on) }}" />
                                                    <input readonly type="date" name="Engineering_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'Engineering_on')" />
                                                </div>
                                                @error('Engineering_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    <div class="sub-head">
                                        Safety
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            @if ($data1->Environment_Health_review !== 'yes')
                                                $('.safety').hide();

                                                $('[name="Environment_Health_review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.safety').show();
                                                        $('.safety span').show();
                                                    } else {
                                                        $('.safety').hide();
                                                        $('.safety span').hide();
                                                    }
                                                });
                                            @endif
                                        });
                                    </script>
                                    @php
                                        $data1 = DB::table('risk_managment_cfts')
                                            ->where('risk_id', $data->id)
                                            ->first();
                                    @endphp

                                    @if ($data->stage == 2 || $data->stage == 3)
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Safety"> Safety Required ? <span
                                                        class="text-danger">*</span></label>
                                                <select name="Environment_Health_review"
                                                    id="Environment_Health_review"
                                                    @if ($data->stage == 3) disabled @endif>
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Environment_Health_review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->Environment_Health_review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->Environment_Health_review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                        <option @if ($data1->Environment_Health_review == 'na' || empty($data1->Environment_Health_review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 59,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 safety">
                                            <div class="group-input">
                                                <label for="Safety notification">Safety Person <span id="asteriskPT"
                                                        style="display: {{ $data1->Environment_Health_review == 'yes' ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span>
                                                </label>
                                                <select @if ($data->stage == 3) disabled @endif
                                                    name="Environment_Health_Safety_person"
                                                    class="Environment_Health_Safety_person"
                                                    id="Environment_Health_Safety_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->Environment_Health_Safety_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 safety">
                                            <div class="group-input">
                                                <label for="Safety assessment">Impact Assessment (By Safety) <span
                                                        id="asteriskPT1"
                                                        style="display: {{ $data1->Environment_Health_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea @if ($data1->Environment_Health_review == 'yes' && $data->stage == 3) required @endif class="summernote Health_Safety_assessment"
                                                    @if (
                                                        $data->stage == 2 ||
                                                            (isset($data1->Environment_Health_Safety_person) &&
                                                                Auth::user()->name != $data1->Environment_Health_Safety_person)) readonly @endif name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-12 mb-3 safety">
                                            <div class="group-input">
                                                <label for="Safety feedback">Safety Feedback <span id="asteriskPT2"
                                                        style="display: {{ $data1->Environment_Health_review == 'yes' && $data->stage == 3 ? 'inline' : 'none' }}"
                                                        class="text-danger">*</span></label>
                                                <div><small class="text-primary">Please insert "NA" in the data field
                                                        if it
                                                        does not require completion</small></div>
                                                <textarea class="summernote Health_Safety_feedback" @if (
                                                    $data->stage == 2 ||
                                                        (isset($data1->Environment_Health_Safety_person) &&
                                                            Auth::user()->name != $data1->Environment_Health_Safety_person)) readonly @endif
                                                    name="Health_Safety_feedback" id="summernote-18" @if ($data1->Environment_Health_review == 'yes' && $data->stage == 3) required @endif>{{ $data1->Health_Safety_feedback }}</textarea>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 safety">
                                            <div class="group-input">
                                                <label for="Safety attachment">Safety Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Environment_Health_Safety_attachment">
                                                        @if ($data1->Environment_Health_Safety_attachment)
                                                            @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Environment_Health_Safety_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 safety">
                                            <div class="group-input">
                                                <label for="Safety Completed By">Safety Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->Environment_Health_Safety_by }}"
                                                    name="Environment_Health_Safety_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                    id="Environment_Health_Safety_by">


                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6 safety">
                                    <div class="group-input ">
                                        <label for="Safety Completed On">Safety Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="Environment_Health_Safety_on"
                                            name="Environment_Health_Safety_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            value="{{ $data1->Environment_Health_Safety_on }}">
                                    </div>
                                </div> --}}
                                        <div class="col-lg-6 safety new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Safety Completed On">Safety
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="Environment_Health_Safety_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->Environment_Health_Safety_on) }}" />
                                                    <input readonly type="date"
                                                        name="Environment_Health_Safety_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'Environment_Health_Safety_on')" />
                                                </div>
                                                @error('Environment_Health_Safety_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                var selectField = document.getElementById('Environment_Health_review');
                                                var inputsToToggle = [];

                                                // Add elements with class 'facility-name' to inputsToToggle
                                                var facilityNameInputs = document.getElementsByClassName('Environment_Health_Safety_person');
                                                for (var i = 0; i < facilityNameInputs.length; i++) {
                                                    inputsToToggle.push(facilityNameInputs[i]);
                                                }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }
                                                // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                                // for (var i = 0; i < facilityNameInputs.length; i++) {
                                                //     inputsToToggle.push(facilityNameInputs[i]);
                                                // }

                                                selectField.addEventListener('change', function() {
                                                    var isRequired = this.value === 'yes';
                                                    console.log(this.value, isRequired, 'value');

                                                    inputsToToggle.forEach(function(input) {
                                                        input.required = isRequired;
                                                        console.log(input.required, isRequired, 'input req');
                                                    });

                                                    // Show or hide the asterisk icon based on the selected value
                                                    var asteriskIcon = document.getElementById('asteriskPT');
                                                    asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                                });
                                            });
                                        </script>
                                    @else
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Safety">Safety Required ?</label>
                                                <select name="Environment_Health_review" disabled
                                                    id="Environment_Health_review">
                                                    <option value="">-- Select --</option>
                                                    <option @if ($data1->Environment_Health_review == 'yes') selected @endif
                                                        value='yes'>
                                                        Yes</option>
                                                    <option @if ($data1->Environment_Health_review == 'no') selected @endif
                                                        value='no'>
                                                        No</option>
                                                    {{-- <option @if ($data1->Environment_Health_review == 'na') selected @endif
                                                        value='na'>
                                                        NA</option> --}}
                                                        <option @if ($data1->Environment_Health_review == 'na' || empty($data1->Environment_Health_review)) selected @endif value='na'>NA</option>

                                                </select>

                                            </div>
                                        </div>
                                        @php
                                            $userRoles = DB::table('user_roles')
                                                ->where([
                                                    'q_m_s_roles_id' => 59,
                                                    'q_m_s_divisions_id' => $data->division_id,
                                                ])
                                                ->get();
                                            $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                            $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                        @endphp
                                        <div class="col-lg-6 safety">
                                            <div class="group-input">
                                                <label for="Safety notification">Safety Person <span
                                                        id="asteriskInvi11" style="display: none"
                                                        class="text-danger">*</span></label>
                                                <select name="Environment_Health_Safety_person" disabled
                                                    id="Environment_Health_Safety_person">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->name }}"
                                                            @if ($user->name == $data1->Environment_Health_Safety_person) selected @endif>
                                                            {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if ($data->stage == 3)
                                            <div class="col-md-12 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety assessment">Impact Assessment (By
                                                        Safety)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety feedback">Safety Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea class="tiny" name="Health_Safety_feedback" id="summernote-18">{{ $data1->Health_Safety_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @else
                                            <div class="col-md-12 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety assessment">Impact Assessment (By
                                                        Safety)</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety feedback">Safety Feedback</label>
                                                    <div><small class="text-primary">Please insert "NA" in the data
                                                            field if
                                                            it
                                                            does not require completion</small></div>
                                                    <textarea disabled class="tiny" name="Health_Safety_feedback" id="summernote-18">{{ $data1->Health_Safety_feedback }}</textarea>
                                                </div>
                                            </div> --}}
                                        @endif
                                        <div class="col-12 safety">
                                            <div class="group-input">
                                                <label for="Safety attachment">Safety Attachments</label>
                                                <div><small class="text-primary">Please Attach all relevant or
                                                        supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="Environment_Health_Safety_attachment">
                                                        @if ($data1->Environment_Health_Safety_attachment)
                                                            @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye text-primary"
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
                                                        <input disabled
                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                            type="file" id="myfile"
                                                            name="Environment_Health_Safety_attachment[]"
                                                            oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3 safety">
                                            <div class="group-input">
                                                <label for="Safety Completed By">Safety Completed
                                                    By</label>
                                                <input readonly type="text"
                                                    value="{{ $data1->Environment_Health_Safety_by }}"
                                                    name="Environment_Health_Safety_by"
                                                    id="Environment_Health_Safety_by">


                                            </div>
                                        </div>
                                        <div class="col-lg-6 safety new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Safety Completed On">Safety
                                                    Completed On</label>
                                                <div class="calenderauditee">
                                                    <input type="text" id="Environment_Health_Safety_on" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data1->Environment_Health_Safety_on) }}" />
                                                    <input readonly type="date"
                                                        name="Environment_Health_Safety_on"
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="" class="hide-input"
                                                        oninput="handleDateInput(this, 'Environment_Health_Safety_on')" />
                                                </div>
                                                @error('Environment_Health_Safety_on')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                    <div class="sub-head">
                                        Other's 1 (Additional Person Review From Departments If Required)
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Review Required1">Other's 1 Review Required?</label>
                                            <select name="Other1_review" id="Other1_review"  @if ($data->stage != 2) disabled @endif >
                                                <option value="">-- Select --</option>
                                                <option value="yes" @if ($data1->Other1_review == 'yes') selected @endif>Yes</option>
                                                <option value="no" @if ($data1->Other1_review == 'no') selected @endif>No</option>
                                                {{-- <option value="na" @if ($data1->Other1_review == 'na') selected @endif>NA</option> --}}
                                                <option @if ($data1->Other1_review == 'na' || empty($data1->Other1_review)) selected @endif value='na'>NA</option>

                                            </select>
                                        </div>
                                    </div>

                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where(['q_m_s_divisions_id' => $data->division_id])
                                            ->select('user_id')
                                            ->distinct()
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp

                                    <div class="col-lg-6 other1_reviews">
                                        <div class="group-input">
                                            <label for="Person1">Other's 1 Person
                                                <span id="asterisko1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                            </label>
                                            <select name="Other1_person" id="Other1_person" @if ($data->stage != 2) disabled @endif>
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->name }}" @if ($data1->Other1_person == $user->name) selected @endif>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($data->stage != 2)
                                            <!-- Hidden field to retain the value if select is disabled -->
                                            <input type="hidden" name="Other1_Department_person" value="{{ $data1->Other1_Department_person }}">
                                        @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12 other1_reviews">
                                        <div class="group-input">
                                            <label for="Department1">Other's 1 Department
                                                <span id="asteriskod1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                            </label>
                                            <select name="Other1_Department_person" id="Other1_Department_person" @if ($data->stage != 2) disabled @endif>
                                                <option value="">-- Select --</option>
                                                @foreach (Helpers::getDepartments() as $key => $name)
                                                    <option value="{{ $key }}" @if ($data1->Other1_Department_person == $key) selected @endif>{{ $name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($data->stage != 2)
                                            <!-- Hidden field to retain the value if select is disabled -->
                                            <input type="hidden" name="Other1_Department_person" value="{{ $data1->Other1_Department_person }}">
                                        @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3 other1_reviews">
                                        <div class="group-input">
                                            <label for="Impact Assessment12">Impact Assessment (By Other's 1)</label>
                                            <textarea class="tiny" name="Other1_assessment" id="summernote-41" @if ($data->stage != 3 || Auth::user()->name != $data1->Other1_person) readonly @endif>{{ $data1->Other1_assessment }}</textarea>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-12 mb-3 other1_reviews">
                                        <div class="group-input">
                                            <label for="Feedback1">Other's 1 Feedback</label>
                                            <textarea class="tiny" name="Other1_feedback" id="summernote-42" @if ($data->stage != 3 || Auth::user()->name != $data1->Other1_person) readonly @endif>{{ $data1->Other1_feedback }}</textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-12 other1_reviews">
                                        <div class="group-input">
                                            <label for="Audit Attachments">Other's 1 Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="Other1_attachment">
                                                    @if ($data1->Other1_attachment)
                                                        @foreach (json_decode($data1->Other1_attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary"
                                                                        style="font-size:20px;"></i></a>
                                                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                        class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile"@if ($data->stage != 4) disabled @endif
                                                        name="Other1_attachment[]" oninput="addMultipleFiles(this, 'Other1_attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3 other1_reviews">
                                        <div class="group-input">
                                            <label for="Review Completed By1">Other's 1 Review Completed By</label>
                                            <input type="text" name="Other1_by" id="Other1_by" value="{{ $data1->Other1_by }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6 other1_reviews new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Others 1 Completed On">Others 1 Completed On</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="Other1_on" readonly placeholder="DD-MMM-YYYY"
                                                    value="{{ Helpers::getdateFormat($data1->Other1_on) }}" />
                                                <input readonly type="date" name="Other1_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'Other1_on')" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add your script to handle the show/hide functionality -->
                                    <script>
                                        $(document).ready(function () {
                                            // Function to toggle visibility based on the selected value
                                            function toggleFieldsBasedOnSelection(value) {
                                                if (value === 'yes') {
                                                    $('.other1_reviews').show(); // Show all fields
                                                    $('.other1_reviews span').show(); // Show asterisks
                                                    $('input[name="Other1_person"]').prop('required', true);
                                                    $('select[name="Other1_Department_person"]').prop('required', true);
                                                    $('#asterisko1').show();
                                                    $('#asteriskod1').show();
                                                } else {
                                                    $('.other1_reviews').hide(); // Hide all fields
                                                    $('.other1_reviews span').hide(); // Hide asterisks
                                                    $('input[name="Other1_person"]').prop('required', false);
                                                    $('select[name="Other1_Department_person"]').prop('required', false);
                                                    $('#asterisko1').hide();
                                                    $('#asteriskod1').hide();
                                                }
                                            }

                                            // On page load
                                            toggleFieldsBasedOnSelection($('[name="Other1_review"]').val());

                                            // On dropdown value change
                                            $('[name="Other1_review"]').change(function () {
                                                toggleFieldsBasedOnSelection($(this).val());
                                            });
                                        });
                                    </script>
    {{--
                                @else
                                    <div class="sub-head">
                                        Other's 1 (Additional Person Review From Departments If Required)
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Review Required1">Other's 1 Review Required?</label>
                                            <select disabled name="Other1_review" id="Other1_review">
                                                <option value="">-- Select --</option>
                                                <option value="yes" @if ($data1->Other1_review == 'yes') selected @endif>Yes</option>
                                                <option value="no" @if ($data1->Other1_review == 'no') selected @endif>No</option>
                                                <option value="na" @if ($data1->Other1_review == 'na') selected @endif>NA</option>
                                            </select>
                                        </div>
                                    </div>

                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where(['q_m_s_divisions_id' => $data->division_id])
                                            ->select('user_id')
                                            ->distinct()
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp

                                    <div class="col-lg-12 Other1_reviews">
                                        <div class="group-input">
                                            <label for="Department1">Other's 1 Department
                                                <span id="asteriskod1" style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                            </label>
                                            <select name="Other1_Department_person" id="Other1_Department_person" @if ($data->stage == 4) disabled @endif>
                                                <option value="">-- Select --</option>
                                                @foreach (Helpers::getDepartments() as $key => $name)
                                                    <option value="{{ $key }}" @if ($data1->Other1_Department_person == $key) selected @endif>{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="group-input">
                                            <label for="Impact Assessment12">Impact Assessment (By Other's 1)</label>
                                            <textarea disabled class="tiny" name="Other1_assessment" id="summernote-41">{{ $data1->Other1_assessment }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="group-input">
                                            <label for="Feedback1">Other's 1 Feedback</label>
                                            <textarea disabled class="tiny" name="Other1_feedback" id="summernote-42">{{ $data1->Other1_feedback }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="group-input">
                                            <label for="Review Completed By1">Other's 1 Review Completed By</label>
                                            <input disabled type="text" value="{{ $data1->Other1_by }}" name="Other1_by" id="Other1_by">
                                        </div>
                                    </div>


                                @endif --}}
                                <div class="sub-head">
                                    Other's 2 (Additional Person Review From Departments If Required)
                                </div>

                                <script>
                                    $(document).ready(function () {
                                        // Function to toggle visibility based on "yes" value
                                        function toggleFieldsBasedOnSelection(value) {
                                            if (value === 'yes') {
                                                $('.Other2_reviews').show();
                                                $('.Other2_reviews span').show();
                                                $('input[name="Other2_person"]').prop('required', true);
                                                $('select[name="Other2_Department_person"]').prop('required', true);
                                                $('#asterisko2').show();
                                                $('#asteriskod2').show();
                                            } else {
                                                $('.Other2_reviews').hide();
                                                $('.Other2_reviews span').hide();
                                                $('input[name="Other2_person"]').prop('required', false);
                                                $('select[name="Other2_Department_person"]').prop('required', false);
                                                $('#asterisko2').hide();
                                                $('#asteriskod2').hide();
                                            }
                                        }

                                        // On page load
                                        toggleFieldsBasedOnSelection($('[name="Other2_review"]').val());

                                        // On dropdown value change
                                        $('[name="Other2_review"]').change(function () {
                                            toggleFieldsBasedOnSelection($(this).val());
                                        });
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review2"> Other's 2 Review Required?</label>
                                        <select name="Other2_review" id="Other2_review"  @if ($data->stage != 2) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option value="yes" @if ($data1->Other2_review == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if ($data1->Other2_review == 'no') selected @endif>No</option>
                                            {{-- <option value="na" @if ($data1->Other2_review == 'na') selected @endif>NA</option> --}}
                                            <option @if ($data1->Other2_review == 'na' || empty($data1->Other2_review)) selected @endif value='na'>NA</option>

                                        </select>
                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')
                                        ->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp

                                <div class="col-lg-6 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Person2">Other's 2 Person <span id="asterisko2" style="display: {{ $data1->Other2_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                        <select name="Other2_person" id="Other2_person" @if ($data->stage != 2) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}" @if ($data1->Other2_person == $user->name) selected @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($data->stage != 2)
                                        <!-- Hidden field to retain the value if select is disabled -->
                                        <input type="hidden" name="Other2_person" value="{{ $data1->Other2_person }}">
                                    @endif
                                    </div>
                                </div>

                                <div class="col-lg-12 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Department2">Other's 2 Department <span id="asteriskod2" style="display: {{ $data1->Other2_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                        <select name="Other2_Department_person" id="Other2_Department_person" @if ($data->stage != 2) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach (Helpers::getDepartments() as $key => $name)
                                                <option value="{{ $key }}" @if ($data1->Other2_Department_person == $key) selected @endif>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($data->stage != 2)
                                        <!-- Hidden field to retain the value if select is disabled -->
                                        <input type="hidden" name="Other2_Department_person" value="{{ $data1->Other2_Department_person }}">
                                    @endif
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment13">Impact Assessment (By Other's 2)</label>
                                        <textarea class="tiny" name="Other2_Assessment" id="summernote-43" @if ($data->stage != 3 || Auth::user()->name != $data1->Other2_person) readonly @endif>{{ $data1->Other2_Assessment }}</textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-md-12 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Feedback2"> Other's 2 Feedback</label>
                                        <textarea class="tiny" name="Other2_feedback" id="summernote-44" @if ($data->stage != 3 || Auth::user()->name != $data1->Other2_person) readonly @endif>{{ $data1->Other2_feedback }}</textarea>
                                    </div>
                                </div> --}}

                                <div class="col-12 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 2 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other2_attachment">
                                                @if ($data1->Other2_attachment)
                                                    @foreach (json_decode($data1->Other2_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other2_attachment[]" oninput="addMultipleFiles(this, 'Other2_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By2">Other's 2 Review Completed By</label>
                                        <input type="text" name="Other2_by" id="Other2_by" value="{{ $data1->Other2_by }}" disabled>
                                    </div>
                                </div>

                                <div class="col-6 Other2_reviews new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Others 2 Completed On">Others 2 Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other2_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other2_on) }}" />
                                            <input readonly type="date" name="Other2_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'Other2_on')" />
                                        </div>
                                        @error('Other2_on')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="sub-head">
                                    Other's 3 (Additional Person Review From Departments If Required)
                                </div>

                                <script>
                                    $(document).ready(function () {
                                        // Function to toggle visibility based on "yes" value
                                        function toggleFieldsBasedOnSelection(value) {
                                            if (value === 'yes') {
                                                $('.Other3_reviews').show();
                                                $('.Other3_reviews span').show();
                                                $('input[name="Other3_person"]').prop('required', true);
                                                $('select[name="Other3_Department_person"]').prop('required', true);
                                                $('#asterisko3').show();
                                                $('#asteriskod3').show();
                                            } else {
                                                $('.Other3_reviews').hide();
                                                $('.Other3_reviews span').hide();
                                                $('input[name="Other3_person"]').prop('required', false);
                                                $('select[name="Other3_Department_person"]').prop('required', false);
                                                $('#asterisko3').hide();
                                                $('#asteriskod3').hide();
                                            }
                                        }

                                        // On page load
                                        toggleFieldsBasedOnSelection($('[name="Other3_review"]').val());

                                        // On dropdown value change
                                        $('[name="Other3_review"]').change(function () {
                                            toggleFieldsBasedOnSelection($(this).val());
                                        });
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review3">Other's 3 Review Required?</label>
                                        <select name="Other3_review" id="Other3_review" @if ($data->stage == 3) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option value="yes" @if ($data1->Other3_review == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if ($data1->Other3_review == 'no') selected @endif>No</option>
                                            {{-- <option value="na" @if ($data1->Other3_review == 'na') selected @endif>NA</option> --}}
                                            <option @if ($data1->Other3_review == 'na' || empty($data1->Other3_review)) selected @endif value='na'>NA</option>

                                        </select>
                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')
                                        ->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp

                                <div class="col-lg-6 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Person3">Other's 3 Person <span id="asterisko3" style="display: {{ $data1->Other3_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                        <select name="Other3_person" id="Other3_person" @if ($data->stage != 2) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}" @if ($data1->Other3_person == $user->name) selected @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($data->stage != 2)
                                        <!-- Hidden field to retain the value if select is disabled -->
                                        <input type="hidden" name="Other3_person" value="{{ $data1->Other3_person }}">
                                    @endif
                                    </div>
                                </div>

                                <div class="col-lg-12 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Department3">Other's 3 Department <span id="asteriskod3" style="display: {{ $data1->Other3_review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span></label>
                                        <select name="Other3_Department_person" id="Other3_Department_person" @if ($data->stage != 2) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach (Helpers::getDepartments() as $key => $name)
                                                <option value="{{ $key }}" @if ($data1->Other3_Department_person == $key) selected @endif>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($data->stage != 2)
                                        <!-- Hidden field to retain the value if select is disabled -->
                                        <input type="hidden" name="Other3_Department_person" value="{{ $data1->Other3_Department_person }}">
                                    @endif
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment14">Impact Assessment (By Other's 3)</label>
                                        <textarea class="tiny" name="Other3_Assessment" id="summernote-45" @if ($data->stage != 3 || Auth::user()->name != $data1->Other3_person) readonly @endif>{{ $data1->Other3_Assessment }}</textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-md-12 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="feedback3">Other's 3 Feedback</label>
                                        <textarea class="tiny" name="Other3_feedback" id="summernote-46" @if ($data->stage != 3 || Auth::user()->name != $data1->Other3_person) readonly @endif>{{ $data1->Other3_feedback }}</textarea>
                                    </div>
                                </div> --}}

                                <div class="col-12 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 3 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other3_attachment">
                                                @if ($data1->Other3_attachment)
                                                    @foreach (json_decode($data1->Other3_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other3_attachment[]" oninput="addMultipleFiles(this, 'Other3_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback">Other's 3 Review Completed By</label>
                                        <input type="text" name="Other3_by" id="Other3_by" value="{{ $data1->Other3_by }}" disabled>
                                    </div>
                                </div>

                                <div class="col-6 new-date-data-field Other3_reviews">
                                    <div class="group-input input-date">
                                        <label for="Others 3 Completed On">Others 3 Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other3_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other3_on) }}" />
                                            <input readonly type="date" name="Other3_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'Other3_on')" />
                                        </div>
                                        @error('Other3_on')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <!-- Other's 4 Section -->
                                <div class="sub-head">
                                    Other's 4 (Additional Person Review From Departments If Required)
                                </div>

                                <script>
                                    $(document).ready(function () {
                                        // Function to toggle visibility based on "yes" value
                                        function toggleOther4Fields(value) {
                                            if (value === 'yes') {
                                                $('.Other4_reviews').show();
                                                $('.Other4_reviews span').show();
                                                $('#Other4_person').prop('required', true);
                                                // $('#hod_Other4_person').prop('required', true);
                                                $('#Other4_Department_person').prop('required', true);
                                                $('#asterisko4').show();
                                            } else {
                                                $('.Other4_reviews').hide();
                                                $('.Other4_reviews span').hide();
                                                $('#Other4_person').prop('required', false);
                                                // $('#hod_Other4_person').prop('required', false);
                                                $('#Other4_Department_person').prop('required', false);
                                                $('#asterisko4').hide();
                                            }
                                        }

                                        // Initial toggle on page load
                                        toggleOther4Fields($('[name="Other4_review"]').val());

                                        // Toggle on value change
                                        $('[name="Other4_review"]').change(function () {
                                            toggleOther4Fields($(this).val());
                                        });
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review4">Other's 4 Review Required?</label>
                                        <select name="Other4_review" id="Other4_review" @if ($data->stage != 2) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option value="yes" @if ($data1->Other4_review == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if ($data1->Other4_review == 'no') selected @endif>No</option>
                                            {{-- <option value="na" @if ($data1->Other4_review == 'na') selected @endif>NA</option> --}}
                                            <option @if ($data1->Other4_review == 'na' || empty($data1->Other4_review)) selected @endif value='na'>NA</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Person4">Other's 4 Person <span id="asterisko4" class="text-danger">*</span></label>
                                        <select name="Other4_person" id="Other4_person" @if ($data->stage != 2) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}" @if ($data1->Other4_person == $user->name) selected @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($data->stage != 2)
                                        <!-- Hidden field to retain the value if select is disabled -->
                                        <input type="hidden" name="Other4_person" value="{{ $data1->Other4_person }}">
                                    @endif
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6 Other4_reviews">
                                    <div class="group-input">
                                        <label for="hod_Other4_person">HOD Other's 4 Person <span id="asterisko4" class="text-danger">*</span></label>
                                        <select name="hod_Other4_person" id="hod_Other4_person" @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}" @if ($data5->hod_Other4_person == $user->name) selected @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-lg-12 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Department4">Other's 4 Department <span id="asteriskod4" class="text-danger">*</span></label>
                                        <select name="Other4_Department_person" id="Other4_Department_person" @if ($data->stage != 2) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach (Helpers::getDepartments() as $key => $name)
                                                <option value="{{ $key }}" @if ($data1->Other4_Department_person == $key) selected @endif>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($data->stage != 2)
                                            <!-- Hidden field to retain the value if select is disabled -->
                                            <input type="hidden" name="Other4_Department_person" value="{{ $data1->Other4_Department_person }}">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Description of Action Item15">Impact Assessment (By Other's 4)</label>
                                        <textarea class="tiny" name="Other4_Assessment" id="summernote-47"
                                            @if ($data->stage != 3 || Auth::user()->name != $data1->Other4_person) readonly @endif>{{ $data1->Other4_Assessment }}</textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-md-12 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="feedback4">Other's 4 Feedback</label>
                                        <textarea class="tiny" name="Other4_feedback" id="summernote-48"
                                            @if ($data->stage != 3 || Auth::user()->name != $data1->Other4_person) readonly @endif>{{ $data1->Other4_feedback }}</textarea>
                                    </div>
                                </div> --}}

                                <div class="col-12 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 4 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other4_attachment">
                                                @if ($data1->Other4_attachment)
                                                    @foreach (json_decode($data1->Other4_attachment) as $file)
                                                        <h6 class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px;"></i></a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other4_attachment[]" oninput="addMultipleFiles(this, 'Other4_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By4">Other's 4 Review Completed By</label>
                                        <input type="text" name="Other4_by" id="Other4_by" value="{{ $data1->Other4_by }}" disabled>
                                    </div>
                                </div>

                                <div class="col-6 new-date-data-field Other4_reviews">
                                    <div class="group-input input-date">
                                        <label for="Others 4 Completed On">Others 4 Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other4_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other4_on) }}" />
                                            <input readonly type="date" name="Other4_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'Other4_on')" />
                                        </div>
                                        @error('Other4_on')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Other's 5 Section -->

                                <div class="sub-head">
                                    Other's 5 (Additional Person Review From Departments If Required)
                                </div>

                                <script>
                                    $(document).ready(function () {
                                        // Function to toggle visibility based on "yes" value
                                        function toggleOther5Fields(value) {
                                            if (value === 'yes') {
                                                $('.Other5_reviews').show();
                                                $('.Other5_reviews span').show();
                                                $('#Other5_person').prop('required', true);
                                                // $('#hod_Other5_person').prop('required', true);
                                                $('#Other5_Department_person').prop('required', true);
                                                $('#asterisko5').show();
                                            } else {
                                                $('.Other5_reviews').hide();
                                                $('.Other5_reviews span').hide();
                                                $('#Other5_person').prop('required', false);
                                                // $('#hod_Other5_person').prop('required', false);
                                                $('#Other5_Department_person').prop('required', false);
                                                $('#asterisko5').hide();
                                            }
                                        }

                                        // Initial toggle on page load
                                        toggleOther5Fields($('[name="Other5_review"]').val());

                                        // Toggle on value change
                                        $('[name="Other5_review"]').change(function () {
                                            toggleOther5Fields($(this).val());
                                        });
                                    });
                                </script>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review5">Other's 5 Review Required?</label>
                                        <select name="Other5_review" id="Other5_review" @if ($data->stage != 2) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option value="yes" @if ($data1->Other5_review == 'yes') selected @endif>Yes</option>
                                            <option value="no" @if ($data1->Other5_review == 'no') selected @endif>No</option>
                                            {{-- <option value="na" @if ($data1->Other5_review == 'na') selected @endif>NA</option> --}}
                                            <option @if ($data1->Other5_review == 'na' || empty($data1->Other5_review)) selected @endif value='na'>NA</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Person5">Other's 5 Person <span id="asterisko5" class="text-danger">*</span></label>
                                        <select name="Other5_person" id="Other5_person" @if ($data->stage != 2) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}" @if ($data1->Other5_person == $user->name) selected @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($data->stage != 2)
                                        <!-- Hidden field to retain the value if select is disabled -->
                                        <input type="hidden" name="Other5_person" value="{{ $data1->Other5_person }}">
                                    @endif
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6 Other5_reviews">
                                    <div class="group-input">
                                        <label for="hod_Other5_person">HOD Other's 5 Person <span id="asterisko5" class="text-danger">*</span></label>
                                        <select name="hod_Other5_person" id="hod_Other5_person" @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->name }}" @if ($data5->hod_Other5_person == $user->name) selected @endif>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-lg-12 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Department5">Other's 5 Department <span id="asteriskod5" class="text-danger">*</span></label>
                                        <select name="Other5_Department_person" id="Other5_Department_person" @if ($data->stage != 2) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach (Helpers::getDepartments() as $key => $name)
                                                <option value="{{ $key }}" @if ($data1->Other5_Department_person == $key) selected @endif>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($data->stage != 2)
                                            <!-- Hidden field to retain the value if select is disabled -->
                                            <input type="hidden" name="Other5_Department_person" value="{{ $data1->Other5_Department_person }}">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Description of Action Item16">Impact Assessment (By Other's 5)</label>
                                        <textarea class="tiny" name="Other5_Assessment" id="summernote-49"
                                        @if ($data->stage != 3 || Auth::user()->name != $data1->Other5_person) readonly @endif>{{ $data1->Other5_Assessment }}</textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-md-12 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback">Other's 5 Feedback</label>
                                        <textarea class="tiny" name="Other5_feedback" id="summernote-50"
                                        @if ($data->stage != 3 || Auth::user()->name != $data1->Other5_person) readonly @endif>{{ $data1->Other5_feedback }}</textarea>
                                    </div>
                                </div> --}}

                                <div class="col-12 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 5 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other5_attachment">
                                                @if ($data1->Other5_attachment)
                                                    @foreach (json_decode($data1->Other5_attachment) as $file)
                                                        <h6 class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px;"></i></a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile" name="Other5_attachment[]" oninput="addMultipleFiles(this, 'Other5_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By5">Other's 5 Review Completed By</label>
                                        <input type="text" name="Other5_by" id="Other5_by" value="{{ $data1->Other5_by }}" disabled>
                                    </div>
                                </div>

                                <div class="col-6 new-date-data-field Other5_reviews">
                                    <div class="group-input input-date">
                                        <label for="Others 5 Completed On">Others 5 Completed On</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="Other5_on" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data1->Other5_on) }}" />
                                            <input readonly type="date" name="Other5_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'Other5_on')" />
                                        </div>
                                        @error('Other5_on')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                </div>
                                <div class="button-block">
                                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                        type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 12 ? 'disabled' : '' }}
                                        id="ChangesaveButton" class="saveButton saveAuditFormBtn d-flex"
                                        style="align-items: center;">
                                        <div class="spinner-border spinner-border-sm auditFormSpinner"
                                            style="display: none" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        Save
                                    </button>
                                    <button type="button" class="backButton"
                                        onclick="previousStep()">Back</button>
                                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                        type="button"{{ $data->stage == 0 || $data->stage == 12 ? 'disabled' : '' }}
                                        id="ChangeNextButton" class="nextButton"
                                        onclick="nextStep()">Next</button>
                                    <button style=" justify-content: center; width: 4rem; margin-left: 1px;;"
                                        type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white">
                                            Exit </a> </button>
                                    @if (
                                        $data->stage == 2 ||
                                            $data->stage == 3 ||
                                            $data->stage == 4 ||
                                            $data->stage == 5 ||
                                            $data->stage == 6 ||
                                            $data->stage == 7)
                                        {{-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                        class="button  launch_extension" data-bs-toggle="modal"
                                        data-bs-target="#launch_extension">
                                        Launch Extension
                                    </a> --}}
                                    @endif
                                    <!-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                                                                                                                                                            data-bs-target="#effectivenss_extension">
                                                                                                                                                            Launch Effectiveness Check
                                                                                                                                                        </a> -->
                                </div>
                            </div>
                        </div>
                    </div>



                        <!-----------------CQA/QA Review--------------->

                        <div id="CCForm5" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="sub-head">
                                    QA/CQA Review
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        @if ($data->stage == 4)
                                        <div class="group-input">
                                            <label for="Closure Comment">QA/CQA Review Comment <span
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not
                                                    require completion </small></div>
                                            <textarea class="summernote" name="qa_cqa_comments"
                                                id="summernote-1"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->qa_cqa_comments }}</textarea>
                                        </div>
                                        @else
                                        <div class="group-input">
                                            <label for="Closure Comment">QA/CQA Review Comment <span
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not
                                                    require completion </small></div>
                                            <textarea readonly class="summernote" name="qa_cqa_comments"
                                                id="summernote-1"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->qa_cqa_comments }}</textarea>
                                        </div>
                                        @endif

                                    </div>

                                    @if ($data->stage == 4)
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Inv Attachments">QA/CQA Review Attachment</label>
                                            <div>
                                                <small class="text-primary">
                                                    Please Attach all relevant or supporting documents
                                                </small>
                                            </div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="qa_cqa_attachments">
                                                    @if ($data->qa_cqa_attachments)
                                                        @foreach (json_decode($data->qa_cqa_attachments) as $file)
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
                                                    <input {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        type="file" id="qa_cqa_attachments"
                                                        name="qa_cqa_attachments[]"
                                                        oninput="addMultipleFiles(this,'qa_cqa_attachments')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Inv Attachments">QA/CQA Review Attachment</label>
                                            <div>
                                                <small class="text-primary">
                                                    Please Attach all relevant or supporting documents
                                                </small>
                                            </div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="qa_cqa_attachments">
                                                    @if ($data->qa_cqa_attachments)
                                                        @foreach (json_decode($data->qa_cqa_attachments) as $file)
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
                                                    <input disabled {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        type="file" id="qa_cqa_attachments"
                                                        name="qa_cqa_attachments[]"
                                                        oninput="addMultipleFiles(this,'qa_cqa_attachments')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif



                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton" id="saveButton"
                                        {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>


                        <!------------------------------------------------ QA/CQA Head Approval--------------------------------------------------->

                        <div id="CCForm6" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="sub-head">
                                    QA/CQA Head Approval
                                 </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        @if ($data->stage == 5)
                                        <div class="group-input">
                                            <label for="Closure Comment">QA/CQA Head Approval Comment <span
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea class="summernote" name="qa_cqa_head_comm"
                                                id="summernote-1"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->qa_cqa_head_comm }}</textarea>
                                        </div>
                                        @else
                                        <div class="group-input">
                                            <label for="Closure Comment">QA/CQA Head Approval Comment <span
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea readonly  class="summernote" name="qa_cqa_head_comm"
                                                id="summernote-1"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->qa_cqa_head_comm }}</textarea>
                                        </div>
                                        @endif

                                    </div>

                                    @if ($data->stage == 5)
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Inv Attachments">QA/CQA Head Attachment</label>
                                            <div>
                                                <small class="text-primary">
                                                    Please Attach all relevant or supporting documents
                                                </small>
                                            </div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="qa_cqa_head_attach">

                                                    @if ($data->qa_cqa_head_attach)
                                                        @foreach (json_decode($data->qa_cqa_head_attach) as $file)
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
                                                    <input {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        type="file" id="qa_cqa_head_attach"
                                                        name="qa_cqa_head_attach[]"
                                                        oninput="addMultipleFiles(this,'qa_cqa_head_attach')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Inv Attachments">QA/CQA Head Attachment</label>
                                            <div>
                                                <small class="text-primary">
                                                    Please Attach all relevant or supporting documents
                                                </small>
                                            </div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="qa_cqa_head_attach">

                                                    @if ($data->qa_cqa_head_attach)
                                                        @foreach (json_decode($data->qa_cqa_head_attach) as $file)
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
                                                    <input disabled {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        type="file" id="qa_cqa_head_attach"
                                                        name="qa_cqa_head_attach[]"
                                                        oninput="addMultipleFiles(this,'qa_cqa_head_attach')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif



                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton" id="saveButton"
                                        {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>

                        <!-- Signatures content -->
                        <div id="CCForm7" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">

                                    <div class="col-12 sub-head" style="font-size: 16px">
                                        Submit
                                    </div>



                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Submitted By..">Submit By:</label>
                                            <div class="static">{{ $data->submitted_by ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Submitted On">Submit On:</label>
                                            <div class="static">{{ $data->submitted_on ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Submit Comment:</label>
                                            <div class="static">{{ $data->submit_comment ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>

                                    <div class="col-12 sub-head" style="font-size: 16px">
                                        HOD Review Complete
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Evaluated By">HOD Review Complete By:</label>
                                            <div class="static">{{ $data->evaluated_by ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Evaluated On">HOD Review Complete On:</label>
                                            <div class="static">{{ $data->evaluated_on ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">HOD Review Complete Comment:</label>
                                            <div class="static">{{ $data->evaluation_complete_comment ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>

                                    <div class="col-12 sub-head" style="font-size: 16px">
                                        CFT Review Complete
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved By">CFT Review Complete By:</label>
                                            <div class="static">{{ $data->CFT_Review_Complete_By ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved On">CFT Review Complete On:</label>
                                            <div class="static">{{ $data->CFT_Review_Complete_On ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">CFT Review Complete Comment:</label>
                                            <div class="static">{{ $data->CFT_Review_Comments ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>

                                    <div class="col-12 sub-head" style="font-size: 16px">
                                     QA/CQA Review Complete
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved By">QA/CQA Review Complete By:</label>
                                            <div class="static">{{ $data->QA_Initial_Review_Complete_By ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved On">QA/CQA Review Complete On:</label>
                                            <div class="static">{{ $data->QA_Initial_Review_Complete_On ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">QA/CQA Review Complete Comment:</label>
                                            <div class="static">{{ $data->QA_Initial_Review_Comments ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>

                                    <div class="col-12 sub-head" style="font-size: 16px">
                                        Approved
                                    </div>


                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved By">Approved By:</label>
                                            <div class="static">{{ $data->in_approve_by ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved On">Approved On:</label>
                                            <div class="static">{{ $data->in_approve_on ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Approved Comment:</label>
                                            <div class="static">{{ $data->in_approve_Comments ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-12 sub-head" style="font-size: 16px">
                                        Closed-Done
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved By">Close Done By:</label>
                                            <div class="static">{{ $data->close_done_By }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved On">Close Done On:</label>
                                            <div class="static">{{ $data->close_done_On }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Comments:</label>
                                            <div class="static">{{ $data->close_done_Comments }}</div>
                                        </div>
                                    </div> --}}

                                    <div class="col-12 sub-head" style="font-size: 16px">
                                        Cancel
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved By">Cancel By:</label>
                                            <div class="static">{{ $data->cancelled_by ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Plan Approved On">Cancel On:</label>
                                            <div class="static">{{ $data->cancelled_on ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments">Cancel Comment:</label>
                                            <div class="static">{{ $data->comments ?? 'Not Applicable' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton"
                                        {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="submit"
                                        {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>Submit</button>
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                </div>
                            </div>
                        </div>

                        <!-- Risk Details content -->
                        {{-- <div id="CCForm2" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Department(s)">Department(s)</label>

                                                @php

                                                    $storedDepartments = $data->departments2;

                                                    $selectedDepartments = explode(',', $storedDepartments);
                                                @endphp




                                                <select multiple name="departments2[]" placeholder="Select Departments"
                                                    data-search="false" data-silent-initial-value-set="true"
                                                    id="departments2" class="new_department"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Select Department</option>
                                                    <option value="QA"
                                                        {{ in_array('QA', $selectedDepartments) ? 'selected' : '' }}>QA
                                                    </option>
                                                    <option value="QC"
                                                        {{ in_array('QC', $selectedDepartments) ? 'selected' : '' }}>QC
                                                    </option>
                                                    <option value="R&D"
                                                        {{ in_array('R&D', $selectedDepartments) ? 'selected' : '' }}>R&D
                                                    </option>
                                                    <option value="Wet Chemistry Area"
                                                        {{ in_array('Wet Chemistry Area', $selectedDepartments) ? 'selected' : '' }}>
                                                        Wet Chemistry Area</option>
                                                    <option value="Warehouse"
                                                        {{ in_array('Warehouse', $selectedDepartments) ? 'selected' : '' }}>
                                                        Warehouse</option>
                                                    <option value="Molecular Area"
                                                        {{ in_array('Molecular Area', $selectedDepartments) ? 'selected' : '' }}>
                                                        Molecular Area</option>
                                                    <option value="Microbiology Area"
                                                        {{ in_array('Microbiology Area', $selectedDepartments) ? 'selected' : '' }}>
                                                        Microbiology Area</option>
                                                    <option value="Instrumental Area"
                                                        {{ in_array('Instrumental Area', $selectedDepartments) ? 'selected' : '' }}>
                                                        Instrumental Area</option>
                                                    <option value="Administration"
                                                        {{ in_array('Administration', $selectedDepartments) ? 'selected' : '' }}>
                                                        Administration</option>
                                                    <option value="Financial Department"
                                                        {{ in_array('Financial Department', $selectedDepartments) ? 'selected' : '' }}>
                                                        Financial Department</option>
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
                                                    <option value="City MFR A"
                                                        {{ $data->site_name == 'City MFR A' ? 'selected' : '' }}>City MFR A
                                                    </option>
                                                    <option value="City MFR B"
                                                        {{ $data->site_name == 'City MFR B' ? 'selected' : '' }}>City MFR B
                                                    </option>
                                                    <option value="City MFR C"
                                                        {{ $data->site_name == 'City MFR C' ? 'selected' : '' }}>City MFR C
                                                    </option>
                                                    <option value="Complex A"
                                                        {{ $data->site_name == 'Complex A' ? 'selected' : '' }}>Complex A
                                                    </option>
                                                    <option value="Complex B"
                                                        {{ $data->site_name == 'Complex B' ? 'selected' : '' }}>Complex B
                                                    </option>
                                                    <option value="Marketing A"
                                                        {{ $data->site_name == 'Marketing A' ? 'selected' : '' }}>Marketing
                                                        A</option>
                                                    <option value="Marketing B"
                                                        {{ $data->site_name == 'Marketing B' ? 'selected' : '' }}>Marketing
                                                        B</option>
                                                    <option value="Marketing C"
                                                        {{ $data->site_name == 'Marketing C' ? 'selected' : '' }}>Marketing
                                                        C</option>
                                                    <option value="Oceanside"
                                                        {{ $data->site_name == 'Oceanside' ? 'selected' : '' }}>Oceanside
                                                    </option>
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
                                                    <option {{ $data->building == 'B' ? 'selected' : '' }}
                                                        value="B">
                                                        B</option>
                                                    <option {{ $data->building == 'C' ? 'selected' : '' }}
                                                        value="C">
                                                        C</option>
                                                    <option {{ $data->building == 'D' ? 'selected' : '' }}
                                                        value="D">
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
                                                    <option {{ $data->room == 'C-101' ? 'selected' : '' }}
                                                        value="C-101">
                                                        C-101</option>
                                                    <option {{ $data->room == 'C-202' ? 'selected' : '' }}
                                                        value="C-202">
                                                        C-202</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Duration">Duration</label>
                                                <select name="duration" id="duration"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option value="2 hours"
                                                        {{ $data->duration == '2 hours' ? 'selected' : '' }}>2 hours
                                                    </option>
                                                    <option value="4 hours"
                                                        {{ $data->duration == '4 hours' ? 'selected' : '' }}>4 hours
                                                    </option>
                                                    <option value="8 hours"
                                                        {{ $data->duration == '8 hours' ? 'selected' : '' }}>8 hours
                                                    </option>
                                                    <option value="16 hours"
                                                        {{ $data->duration == '16 hours' ? 'selected' : '' }}>16 hours
                                                    </option>
                                                    <option value="24 hours"
                                                        {{ $data->duration == '24 hours' ? 'selected' : '' }}>24 hours
                                                    </option>
                                                    <option value="36 hours"
                                                        {{ $data->duration == '36 hours' ? 'selected' : '' }}>36 hours
                                                    </option>
                                                    <option value="72 hours"
                                                        {{ $data->duration == '72 hours' ? 'selected' : '' }}>72 hours
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Hazard">Hazard</label>
                                                <select name="hazard" id="hazard"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option value="Confined Space"
                                                        {{ $data->hazard == 'Confined Space' ? 'selected' : '' }}>Confined
                                                        Space</option>
                                                    <option value="Electrical"
                                                        {{ $data->hazard == 'Electrical' ? 'selected' : '' }}>Electrical
                                                    </option>
                                                    <option value="Energy use"
                                                        {{ $data->hazard == 'Energy use' ? 'selected' : '' }}>Energy use
                                                    </option>
                                                    <option value="Ergonomics"
                                                        {{ $data->hazard == 'Ergonomics' ? 'selected' : '' }}>Ergonomics
                                                    </option>
                                                    <option value="Machine Guarding"
                                                        {{ $data->hazard == 'Machine Guarding' ? 'selected' : '' }}>
                                                        Machine Guarding</option>
                                                    <option value="Material Storage"
                                                        {{ $data->hazard == 'Material Storage' ? 'selected' : '' }}>
                                                        Material Storage</option>
                                                    <option value="Material use"
                                                        {{ $data->hazard == 'Material use' ? 'selected' : '' }}>Material
                                                        use</option>
                                                    <option value="Pressure"
                                                        {{ $data->hazard == 'Pressure' ? 'selected' : '' }}>Pressure
                                                    </option>
                                                    <option value="Thermal"
                                                        {{ $data->hazard == 'Thermal' ? 'selected' : '' }}>Thermal
                                                    </option>
                                                    <option value="Water use"
                                                        {{ $data->hazard == 'Water use' ? 'selected' : '' }}>Water use
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Room">Room</label>
                                                <select name="room2" id="room2"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option value="Automation"
                                                        {{ $data->room2 == 'Automation' ? 'selected' : '' }}>Automation
                                                    </option>
                                                    <option value="Biochemistry"
                                                        {{ $data->room2 == 'Biochemistry' ? 'selected' : '' }}>
                                                        Biochemistry</option>
                                                    <option value="Blood Collection"
                                                        {{ $data->room2 == 'Blood Collection' ? 'selected' : '' }}>Blood
                                                        Collection</option>
                                                    <option value="Enter Yo"
                                                        {{ $data->room2 == 'Enter Yo' ? 'selected' : '' }}>Enter Yo
                                                    </option>
                                                    <option value="Buffer Preparation"
                                                        {{ $data->room2 == 'Buffer Preparation' ? 'selected' : '' }}>
                                                        Buffer Preparation</option>
                                                    <option value="Bulk Fill"
                                                        {{ $data->room2 == 'Bulk Fill' ? 'selected' : '' }}>Bulk Fill
                                                    </option>
                                                    <option value="Calibration"
                                                        {{ $data->room2 == 'Calibration' ? 'selected' : '' }}>Calibration
                                                    </option>
                                                    <option value="Component Manufacturing"
                                                        {{ $data->room2 == 'Component Manufacturing' ? 'selected' : '' }}>
                                                        Component Manufacturing</option>
                                                    <option value="Computer"
                                                        {{ $data->room2 == 'Computer' ? 'selected' : '' }}>Computer
                                                    </option>
                                                    <option value="Computer / Automated Systems"
                                                        {{ $data->room2 == 'Computer / Automated Systems' ? 'selected' : '' }}>
                                                        Computer / Automated Systems</option>
                                                    <option value="Despensing Donor Suitability"
                                                        {{ $data->room2 == 'Despensing Donor Suitability' ? 'selected' : '' }}>
                                                        Despensing Donor Suitability</option>
                                                    <option value="Filling"
                                                        {{ $data->room2 == 'Filling' ? 'selected' : '' }}>Filling</option>
                                                    <option value="Filtration"
                                                        {{ $data->room2 == 'Filtration' ? 'selected' : '' }}>Filtration
                                                    </option>
                                                    <option value="Formulation"
                                                        {{ $data->room2 == 'Formulation' ? 'selected' : '' }}>Formulation
                                                    </option>
                                                    <option value="Incoming QA"
                                                        {{ $data->room2 == 'Incoming QA' ? 'selected' : '' }}>Incoming QA
                                                    </option>
                                                    <option value="Hazard"
                                                        {{ $data->room2 == 'Hazard' ? 'selected' : '' }}>Hazard</option>
                                                    <option value="Laboratory"
                                                        {{ $data->room2 == 'Laboratory' ? 'selected' : '' }}>Laboratory
                                                    </option>
                                                    <option value="Laboratory Support Facility"
                                                        {{ $data->room2 == 'Laboratory Support Facility' ? 'selected' : '' }}>
                                                        Laboratory Support Facility</option>
                                                    <option value="Enter Your"
                                                        {{ $data->room2 == 'Enter Your' ? 'selected' : '' }}>Enter Your
                                                    </option>
                                                    <option value="Lot Release"
                                                        {{ $data->room2 == 'Lot Release' ? 'selected' : '' }}>Lot Release
                                                    </option>
                                                    <option value="Manufacturing"
                                                        {{ $data->room2 == 'Manufacturing' ? 'selected' : '' }}>
                                                        Manufacturing</option>
                                                    <option value="Materials Management"
                                                        {{ $data->room2 == 'Materials Management' ? 'selected' : '' }}>
                                                        Materials Management</option>
                                                    <option value="Room"
                                                        {{ $data->room2 == 'Room' ? 'selected' : '' }}>Room</option>
                                                    <option value="Operations"
                                                        {{ $data->room2 == 'Operations' ? 'selected' : '' }}>Operations
                                                    </option>
                                                    <option value="Packaging"
                                                        {{ $data->room2 == 'Packaging' ? 'selected' : '' }}>Packaging
                                                    </option>
                                                    <option value="Plant Engineering"
                                                        {{ $data->room2 == 'Plant Engineering' ? 'selected' : '' }}>Plant
                                                        Engineering</option>
                                                    <option value="Enter Your Sele"
                                                        {{ $data->room2 == 'Enter Your Sele' ? 'selected' : '' }}>Enter
                                                        Your Sele</option>
                                                    <option value="Njown"
                                                        {{ $data->room2 == 'Njown' ? 'selected' : '' }}>Njown</option>
                                                    <option value="Powder Filling"
                                                        {{ $data->room2 == 'Powder Filling' ? 'selected' : '' }}>Powder
                                                        Filling</option>
                                                    <option value="Process Development"
                                                        {{ $data->room2 == 'Process Development' ? 'selected' : '' }}>
                                                        Process Development</option>
                                                    <option value="Product Distribution"
                                                        {{ $data->room2 == 'Product Distribution' ? 'selected' : '' }}>
                                                        Product Distribution</option>
                                                    <option value="Product Testing"
                                                        {{ $data->room2 == 'Product Testing' ? 'selected' : '' }}>Product
                                                        Testing</option>
                                                    <option value="Production Purification"
                                                        {{ $data->room2 == 'Production Purification' ? 'selected' : '' }}>
                                                        Production Purification</option>
                                                    <option value="QA" {{ $data->room2 == 'QA' ? 'selected' : '' }}>
                                                        QA</option>
                                                    <option value="QA Laboratory Quality Control"
                                                        {{ $data->room2 == 'QA Laboratory Quality Control' ? 'selected' : '' }}>
                                                        QA Laboratory Quality Control</option>
                                                    <option value="Quality Control / Assurance"
                                                        {{ $data->room2 == 'Quality Control / Assurance' ? 'selected' : '' }}>
                                                        Quality Control / Assurance</option>
                                                    <option value="Sanitization"
                                                        {{ $data->room2 == 'Sanitization' ? 'selected' : '' }}>
                                                        Sanitization</option>
                                                    <option value="Shipping/Distribution Storage/Distribution"
                                                        {{ $data->room2 == 'Shipping/Distribution Storage/Distribution' ? 'selected' : '' }}>
                                                        Shipping/Distribution Storage/Distribution</option>
                                                    <option value="Storage and Distribution"
                                                        {{ $data->room2 == 'Storage and Distribution' ? 'selected' : '' }}>
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
                                                    <option value="0. No significant regulatory issues affecting operation"
                                                        {{ $data->regulatory_climate == '0. No significant regulatory issues affecting operation' ? 'selected' : '' }}>
                                                        0. No significant regulatory issues affecting operation</option>
                                                    <option
                                                        value="1. Some regulatory or enforcement changes potentially affecting operation are anticipated"
                                                        {{ $data->regulatory_climate == '1. Some regulatory or enforcement changes potentially affecting operation are anticipated' ? 'selected' : '' }}>
                                                        1. Some regulatory or enforcement changes potentially affecting
                                                        operation are anticipated</option>
                                                    <option
                                                        value="2. A few regulatory or enforcement changes affect operations"
                                                        {{ $data->regulatory_climate == '2. A few regulatory or enforcement changes affect operations' ? 'selected' : '' }}>
                                                        2. A few regulatory or enforcement changes affect operations
                                                    </option>
                                                    <option value="3. Regulatory and enforcement changes affect operation"
                                                        {{ $data->regulatory_climate == '3. Regulatory and enforcement changes affect operation' ? 'selected' : '' }}>
                                                        3. Regulatory and enforcement changes affect operation</option>
                                                    <option
                                                        value="4. Significant programatic regulatory and enforcement changes affect operation"
                                                        {{ $data->regulatory_climate == '4. Significant programatic regulatory and enforcement changes affect operation' ? 'selected' : '' }}>
                                                        4. Significant programatic regulatory and enforcement changes affect
                                                        operation</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Number of Employees">Number of Employees</label>
                                                <select name="Number_of_employees" id="Number_of_employees"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option value="0-50"
                                                        {{ $data->Number_of_employees == '0-50' ? 'selected' : '' }}>0-50
                                                    </option>
                                                    <option value="50-100"
                                                        {{ $data->Number_of_employees == '50-100' ? 'selected' : '' }}>
                                                        50-100</option>
                                                    <option value="100-200"
                                                        {{ $data->Number_of_employees == '100-200' ? 'selected' : '' }}>
                                                        100-200</option>
                                                    <option value="200-300"
                                                        {{ $data->Number_of_employees == '200-300' ? 'selected' : '' }}>
                                                        200-300</option>
                                                    <option value="300-500"
                                                        {{ $data->Number_of_employees == '300-500' ? 'selected' : '' }}>
                                                        300-500</option>
                                                    <option value="500-1000"
                                                        {{ $data->Number_of_employees == '500-1000' ? 'selected' : '' }}>
                                                        500-1000</option>
                                                    <option value="1000+"
                                                        {{ $data->Number_of_employees == '1000+' ? 'selected' : '' }}>
                                                        1000+</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Risk Management Strategy">Risk Management Strategy</label>
                                                <select name="risk_management_strategy" id="risk_management_strategy"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option value="Accept"
                                                        {{ $data->risk_management_strategy == 'Accept' ? 'selected' : '' }}>
                                                        Accept</option>
                                                    <option value="Avoid the Risk"
                                                        {{ $data->risk_management_strategy == 'Avoid the Risk' ? 'selected' : '' }}>
                                                        Avoid the Risk</option>
                                                    <option value="Mitigate"
                                                        {{ $data->risk_management_strategy == 'Mitigate' ? 'selected' : '' }}>
                                                        Mitigate</option>
                                                    <option value="Transfer"
                                                        {{ $data->risk_management_strategy == 'Transfer' ? 'selected' : '' }}>
                                                        Transfer</option>
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
                            </div> --}}

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
                                                <input type="text" id="schedule_start_date" readonly
                                                    value="{{ Helpers::getdateFormat($data->schedule_start_date1) }}"
                                                    placeholder="DD-MMM-YYYY" />
                                                <input type="date" id="schedule_start_date_checkdate"
                                                    name="schedule_start_date1"
                                                    value="{{ $data->schedule_start_date1 }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'schedule_start_date');checkDate('schedule_start_date_checkdate','schedule_end_date_checkdate')" />
                                            </div>
                                            {{-- <input type="date" name="schedule_start_date1" value="{{$data->schedule_start_date1}}"> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Scheduled End Date">Scheduled End Date</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="schedule_end_date" readonly
                                                    value="{{ Helpers::getdateFormat($data->schedule_end_date1) }}"
                                                    placeholder="DD-MMM-YYYY" />
                                                <input type="date" id="schedule_end_date_checkdate"
                                                    name="schedule_end_date1" value="{{ $data->schedule_end_date1 }}"
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                    class="hide-input"
                                                    oninput="handleDateInput(this, 'schedule_end_date');checkDate('schedule_start_date_checkdate','schedule_end_date_checkdate')" />
                                            </div>
                                            {{-- <input type="date" name="schedule_end_date1" value="{{$data->schedule_end_date}}"> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Estimated Man-Hours">Estimated Man-Hours</label>
                                            <input type="text" name="estimated_man_hours" id="estimated_man_hours"
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                value="{{ $data->estimated_man_hours }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Estimated Cost">Estimated Cost</label>
                                            <input type="text" name="estimated_cost" id="estimated_cost"
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
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
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <option value="">Enter Your Selection Here</option>
                                                <option value="ARS-Argentine Peso"
                                                    {{ $data->currency == 'ARS-Argentine Peso' ? 'selected' : '' }}>
                                                    ARS-Argentine Peso</option>
                                                <option value="AUD-Australian Dollar"
                                                    {{ $data->currency == 'AUD-Australian Dollar' ? 'selected' : '' }}>
                                                    AUD-Australian Dollar</option>
                                                <option value="BRL-Brazilian Real"
                                                    {{ $data->currency == 'BRL-Brazilian Real' ? 'selected' : '' }}>
                                                    BRL-Brazilian Real</option>
                                                <option value="CAD-Canadian Dollar"
                                                    {{ $data->currency == 'CAD-Canadian Dollar' ? 'selected' : '' }}>
                                                    CAD-Canadian Dollar</option>
                                                <option value="CHF-Swiss Franc"
                                                    {{ $data->currency == 'CHF-Swiss Franc' ? 'selected' : '' }}>
                                                    CHF-Swiss Franc</option>
                                                <option value="CNY-Chinese Yuan"
                                                    {{ $data->currency == 'CNY-Chinese Yuan' ? 'selected' : '' }}>
                                                    CNY-Chinese Yuan</option>
                                                <option value="EUR-Euro"
                                                    {{ $data->currency == 'EUR-Euro' ? 'selected' : '' }}>EUR-Euro
                                                </option>
                                                <option value="HKD-Hong Kong Dollar"
                                                    {{ $data->currency == 'HKD-Hong Kong Dollar' ? 'selected' : '' }}>
                                                    HKD-Hong Kong Dollar</option>
                                                <option value="ILS-Israeli New Sheqel"
                                                    {{ $data->currency == 'ILS-Israeli New Sheqel' ? 'selected' : '' }}>
                                                    ILS-Israeli New Sheqel</option>
                                                <option value="INR-Indian Rupee"
                                                    {{ $data->currency == 'INR-Indian Rupee' ? 'selected' : '' }}>
                                                    INR-Indian Rupee</option>
                                                <option value="JPY-Japanese Yen"
                                                    {{ $data->currency == 'JPY-Japanese Yen' ? 'selected' : '' }}>
                                                    JPY-Japanese Yen</option>
                                                <option value="KRW-South Korean Won"
                                                    {{ $data->currency == 'KRW-South Korean Won' ? 'selected' : '' }}>
                                                    KRW-South Korean Won</option>
                                                <option value="MXN-Mexican Peso"
                                                    {{ $data->currency == 'MXN-Mexican Peso' ? 'selected' : '' }}>
                                                    MXN-Mexican Peso</option>
                                                <option value="RUB-Russian Rouble"
                                                    {{ $data->currency == 'RUB-Russian Rouble' ? 'selected' : '' }}>
                                                    RUB-Russian Rouble</option>
                                                <option value="SAR-Saudi Riyal"
                                                    {{ $data->currency == 'SAR-Saudi Riyal' ? 'selected' : '' }}>
                                                    SAR-Saudi Riyal</option>
                                                <option value="TRY-Turkish Lira"
                                                    {{ $data->currency == 'TRY-Turkish Lira' ? 'selected' : '' }}>
                                                    TRY-Turkish Lira</option>
                                                <option value="USD-US Dollar"
                                                    {{ $data->currency == 'USD-US Dollar' ? 'selected' : '' }}>USD-US
                                                    Dollar</option>
                                                <option value="XAG-Silver"
                                                    {{ $data->currency == 'XAG-Silver' ? 'selected' : '' }}>XAG-Silver
                                                </option>
                                                <option value="XAU-Gold"
                                                    {{ $data->currency == 'XAU-Gold' ? 'selected' : '' }}>XAU-Gold
                                                </option>
                                                <option value="XPD-Palladium"
                                                    {{ $data->currency == 'XPD-Palladium' ? 'selected' : '' }}>
                                                    XPD-Palladium</option>
                                                <option value="XPT-Platinum"
                                                    {{ $data->currency == 'XPT-Platinum' ? 'selected' : '' }}>
                                                    XPT-Platinum</option>
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
                                            <textarea name="justification" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} id="justification">{{ $data->justification }} </textarea>
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
                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>+</button>
                                            </label>
                                            <table class="table table-bordered" id="action_plan_details">
                                                <thead>
                                                    <tr>
                                                        <th style="width:78px;">Row #</th>
                                                        <th>Action</th>
                                                        <th>Responsible</th>
                                                        <th>Deadline</th>
                                                        <th>Item static</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody {{ Helpers::isRiskAssessment($data->stage) }}>
                                                    @if ($action_plan && $action_plan->action)
                                                        @foreach (unserialize($action_plan->action) as $key => $temps)
                                                            <tr>
                                                                <td>
                                                                    <input disabled type="text"
                                                                        name="serial_number[]"
                                                                        value="{{ $key + 1 }}"
                                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="action[]"
                                                                        value="{{ $temps ? $temps : ' ' }}"
                                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                </td>
                                                                <td>
                                                                    <select id="select-state" placeholder="Select..."
                                                                        name="responsible[]"
                                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                        <option value="">Select a value</option>
                                                                        @foreach ($users as $value)
                                                                            <option
                                                                                {{ unserialize($action_plan->responsible)[$key] ? (unserialize($action_plan->responsible)[$key] == $value->id ? 'selected' : ' ') : '' }}
                                                                                value="{{ $value->id }}">
                                                                                {{ $value->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <div class="group-input new-date-data-field mb-0">
                                                                        <div class="input-date">
                                                                            <div class="calenderauditee">
                                                                                <input type="text"
                                                                                    id="deadline{{ $key }}' + serialNumber +'"
                                                                                    readonly placeholder="DD-MMM-YYYY"
                                                                                    value="{{ Helpers::getdateFormat(unserialize($action_plan->deadline)[$key]) }}"
                                                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} />
                                                                                <input type="date" name="deadline[]"
                                                                                    class="hide-input"
                                                                                    value="{{ unserialize($action_plan->deadline)[$key] }}"
                                                                                    oninput="handleDateInput(this, `deadline{{ $key }}' + serialNumber +'`)"
                                                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="item_static[]"
                                                                        value="{{ unserialize($action_plan->item_static)[$key] ? unserialize($action_plan->item_static)[$key] : '' }}"
                                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                </td>
                                                                <td>
                                                                    <button type="text" class="removeRowBtn"
                                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Remove</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="7">No action plan available</td>
                                                        </tr>
                                                    @endif
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
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="reference">
                                                    @if ($data->reference)
                                                        @foreach (json_decode($data->reference) as $file)
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
                                                    <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="reference[]"
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



                        <!-- Residual Risk content -->
                        <div id="CCForm5" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Residual Risk">Residual Risk</label>
                                            <input type="text" name="residual_risk" id="residual_risk"
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                value="{{ $data->residual_risk }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Residual Risk Impact">Residual Risk Impact</label>
                                            <select name="residual_risk_impact" id="analysisR2"
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                onchange='calculateRiskAnalysis2(this)'>
                                                <option value="">Enter Your Selection Here</option>
                                                <option value='1'
                                                    {{ $data->residual_risk_impact == '1' ? 'selected' : '' }}>
                                                    1-Insignificant</option>
                                                <option value='2'
                                                    {{ $data->residual_risk_impact == '2' ? 'selected' : '' }}>2-Minor
                                                </option>
                                                <option value='3'
                                                    {{ $data->residual_risk_impact == '3' ? 'selected' : '' }}>3-Major
                                                </option>
                                                <option value='4'
                                                    {{ $data->residual_risk_impact == '4' ? 'selected' : '' }}>4-Critical
                                                </option>
                                                <option value='5'
                                                    {{ $data->residual_risk_impact == '5' ? 'selected' : '' }}>
                                                    5-Catastrophic</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Residual Risk Probability">Residual Risk Probability</label>
                                            <select name="residual_risk_probability" id="analysisP2"
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                onchange='calculateRiskAnalysis2(this)'>
                                                <option value="">Enter Your Selection Here</option>
                                                <option value='1'
                                                    {{ $data->residual_risk_probability == '1' ? 'selected' : '' }}>1-Very
                                                    rare</option>
                                                <option value='2'
                                                    {{ $data->residual_risk_probability == '2' ? 'selected' : '' }}>
                                                    2-Unlikely</option>
                                                <option value='3'
                                                    {{ $data->residual_risk_probability == '3' ? 'selected' : '' }}>
                                                    3-Possibly</option>
                                                <option value='4'
                                                    {{ $data->residual_risk_probability == '4' ? 'selected' : '' }}>
                                                    4-Likely</option>
                                                <option value='5'
                                                    {{ $data->residual_risk_probability == '5' ? 'selected' : '' }}>
                                                    5-Almost certain (every time)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Detection">Residual Detection</label>
                                            <select name="detection2" id="analysisN2"
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                onchange='calculateRiskAnalysis2(this)'>
                                                <option value="">Enter Your Selection Here</option>
                                                <option value='1' {{ $data->detection2 == '1' ? 'selected' : '' }}>
                                                    1-Always detected</option>
                                                <option value='2' {{ $data->detection2 == '2' ? 'selected' : '' }}>
                                                    2-Likely to detect</option>
                                                <option value='3' {{ $data->detection2 == '3' ? 'selected' : '' }}>
                                                    3-Possible to detect</option>
                                                <option value='4' {{ $data->detection2 == '4' ? 'selected' : '' }}>
                                                    4-Unlikely to detect</option>
                                                <option value='5' {{ $data->detection2 == '5' ? 'selected' : '' }}>
                                                    5-Not detectable</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="RPN">Residual RPN</label>
                                            <div><small class="text-primary">Auto - Calculated</small></div>
                                            <input type="text" name="rpn2" id="analysisRPN2"
                                                value="{{ $data->rpn2 }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="">Residual Risk Level</label>
                                            <input type="text" name="risk_level_2" id="riskLevel_2"
                                                value="{{ $data->risk_level_2 }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Comments">Comments</label>
                                            <textarea name="comments2" id="comments2" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $data->comments2 }}</textarea>
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
                                                    id="mitigation_plan_deatails"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}>+</button>
                                            </label>
                                            <table class="table table-bordered" id="mitigation_plan_deatails_details">
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
                                                        <th>Action
                                                        <th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (unserialize($mitigation_plan_details->mitigation_steps) as $key => $temps)
                                                        <tr>
                                                            <td><input disabled type="text" name="serial_number[]"
                                                                    value="{{ $key + 1 }}"></td>
                                                            <td><input type="text" name="mitigation_steps[]"
                                                                    value="{{ $temps ? $temps : ' ' }}"
                                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                            </td>
                                                            {{-- <td><input type="date" name="deadline2[]"
                                                                    value="{{ unserialize($mitigation_plan_details->deadline2)[$key] ? unserialize($mitigation_plan_details->deadline2)[$key] : '' }}">
                                                            </td> --}}
                                                            <td>
                                                                <div class="group-input new-date-data-field mb-0">
                                                                    <div class="input-date ">
                                                                        <div class="calenderauditee">
                                                                            <input type="text"
                                                                                id="deadline2{{ $key }}' + serialNumber +'"
                                                                                readonly placeholder="DD-MMM-YYYY"
                                                                                value="{{ Helpers::getdateFormat(unserialize($mitigation_plan_details->deadline2)[$key]) }}"
                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} />
                                                                            <input type="date" name="deadline2[]"
                                                                                class="hide-input"
                                                                                value="{{ unserialize($mitigation_plan_details->deadline2)[$key] }}"
                                                                                oninput="handleDateInput(this, `deadline2{{ $key }}' + serialNumber +'`)"
                                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            {{-- <td><input type="text" name="responsible_person[]"
                                                                    value="{{ unserialize($mitigation_plan_details->responsible_person)[$key] ? unserialize($mitigation_plan_details->responsible_person)[$key] : '' }}">
                                                            </td> --}}
                                                            <td> <select id="select-state" placeholder="Select..."
                                                                    name="responsible_person[]">
                                                                    <option value="">Select a Value</option>
                                                                    @foreach ($users as $value)
                                                                        <option
                                                                            {{ unserialize($mitigation_plan_details->responsible_person)[$key] ? (unserialize($mitigation_plan_details->responsible_person)[$key] == $value->id ? 'selected' : ' ') : '' }}
                                                                            value="{{ $value->id }}"
                                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                            {{ $value->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select></td>
                                                            <td><input type="text" name="status[]"
                                                                    value="{{ unserialize($mitigation_plan_details->status)[$key] ? unserialize($mitigation_plan_details->status)[$key] : '' }}"
                                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                            </td>
                                                            <td><input type="text" name="remark[]"
                                                                    value="{{ unserialize($mitigation_plan_details->remark)[$key] ? unserialize($mitigation_plan_details->remark)[$key] : '' }}"
                                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                            </td>
                                                            <td><button type="text" class="removeRowBtn"
                                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Remove</button>
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
                                            <select name="mitigation_required" placeholder="Select Departments"
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                data-search="false" data-silent-initial-value-set="true"
                                                id="">
                                                <option value="">Select Mitigation </option>
                                                <option value="yes"
                                                    {{ $data->mitigation_required == 'yes' ? 'selected' : '' }}>Yes
                                                </option>
                                                <option value="no"
                                                    {{ $data->mitigation_status == 'no' ? 'selected' : '' }}>No</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="mitigation-plan">Mitigation Plan</label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="mitigation_plan">{{ $data->mitigation_plan }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="mitigation-due-date">Scheduled End Date</label>
                                            <div class="calenderauditee">
                                                <input type="text" id="mitigation_due_date" readonly
                                                    value="{{ Helpers::getdateFormat($data->mitigation_due_date) }}"
                                                    name="mitigation_due_date" placeholder="DD-MMM-YYYY" />
                                                <input type="date" name="mitigation_due_date"
                                                    {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    value="{{ $data->mitigation_due_date }}" class="hide-input"
                                                    oninput="handleDateInput(this, 'mitigation_due_date')" />
                                            </div>
                                            {{-- <input type="date" name="mitigation_due_date"
                                                    value="{{ $data->mitigation_due_date }}"> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="mitigation-status">Status of Mitigation</label>
                                            <select name="mitigation_status"
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <option value="">-- Select --</option>
                                                <option value="Green Status"
                                                    {{ $data->mitigation_status == 'Green Status' ? 'selected' : '' }}>
                                                    Green
                                                    Status</option>
                                                <option value="Amber Status"
                                                    {{ $data->mitigation_status == 'Amber Status' ? 'selected' : '' }}>
                                                    Amber
                                                    Status</option>
                                                <option value="Red Staus"
                                                    {{ $data->mitigation_status == 'Red Staus' ? 'selected' : '' }}>Red
                                                    Staus</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="mitigation-status-comments">Mitigation Status Comments</label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="mitigation_status_comments">{{ $data->mitigation_status_comments }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="sub-head">Overall Assessment</div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="impact">Impact</label>
                                            <select name="impact"
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <option value="">-- Select --</option>
                                                <option value="high" {{ $data->impact == 'high' ? 'selected' : '' }}>
                                                    High</option>
                                                <option value="medium"
                                                    {{ $data->impact == 'medium' ? 'selected' : '' }}>Medium</option>
                                                <option value="low" {{ $data->impact == 'low' ? 'selected' : '' }}>
                                                    Low</option>
                                                <option value="none" {{ $data->impact == 'none' ? 'selected' : '' }}>
                                                    None</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="criticality">Criticality</label>
                                            <select name="criticality"
                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                <option value="">-- Select --</option>
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
                                            <textarea {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="impact_analysis">{{ $data->impact_analysis }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="risk-analysis">Risk Analysis</label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="risk_analysis">{{ $data->risk_analysis }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="severity">Severity</label>
                                                <select name="severity">
                                                    <option value="">-- Select --</option>
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
                                                    <option value="">-- Select --</option>
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
                                            <select {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                multiple id="reference_record" name="refrence_record[]"
                                                id="">
                                                {{-- <option value="">--Select---</option> --}}
                                                @foreach ($old_record as $new)
                                                    <option value="{{ $new->id }}"
                                                        {{ in_array($new->id, explode(',', $data->refrence_record)) ? 'selected' : '' }}>
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
                                            <div><small class="text-primary">Please Mention justification if due date is
                                                    crossed</small></div>
                                            <textarea {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} name="due_date_extension">{{ $data->due_date_extension }}</textarea>
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

                    <form action="{{ route('riskassesmentCancel', $data->id) }}" method="POST">
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
        {{-- <div class="modal fade" id="child-modal">
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
                                     Action Item
                                </label>



                                <label for="major">
                                    <input type="radio" name="revision" id="major" value="Action-Item">
                                    Capa
                                </label>

                                <label for="major">
                                    <input type="radio" name="revision" id="major" value="Action-Item">
                                    Change control
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
        </div> --}}


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

                                @if ($data->stage == 4)
                                    <label for="major" style="display: flex; gap: 14px; align-items: center;">
                                        <input type="radio" name="child_type" id="major" value="Action_Item">
                                        Action Item
                                    </label>

                                    <label style="display: flex; gap: 14px; align-items: center;" for="major">
                                        <input type="radio" name="child_type" id="major" value="capa">
                                        CAPA
                                    </label>
                                    <label style="display: flex; gap: 14px; align-items: center;" for="change-control">
                                        <input type="radio" name="child_type" id="major"
                                            value="Change_control">
                                        Change Control
                                    </label>
                                @endif
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


        <script>
            console.log('Script working')

            $(document).ready(function() {


                function submitForm() {

                    let auditForm = document.getElementById('auditForm');


                    console.log('sumitting form')

                    document.querySelectorAll('.saveAuditFormBtn').forEach(function(button) {
                        button.disabled = true;
                    })

                    document.querySelectorAll('.auditFormSpinner').forEach(function(spinner) {
                        spinner.style.display = 'flex';
                    })

                    auditForm.submit();
                }

                $('#ChangesaveButton01').click(function() {
                    document.getElementById('formNameField').value = 'general-open';
                    submitForm();
                });

                $('#ChangesaveButton02').click(function() {
                    document.getElementById('formNameField').value = 'ra';
                    submitForm();
                });
                $('#ChangesaveButton02221').click(function() {
                    document.getElementById('formNameField').value = 'pending';
                    submitForm();
                });
                $('#ChangesaveButton02222').click(function() {
                    document.getElementById('formNameField').value = 'hod final';
                    submitForm();
                });

                $('#ChangesaveButton03').click(function() {
                    document.getElementById('formNameField').value = 'qa';
                    submitForm();
                });

                $('#ChangesaveButton04').click(function() {
                    document.getElementById('formNameField').value = 'capa';
                    submitForm();
                });
                $('#ChangesaveButton022').click(function() {
                    document.getElementById('formNameField').value = 'qrm';
                    submitForm();
                });
                $('#ChangesaveButton023').click(function() {
                    document.getElementById('formNameField').value = 'inv';
                    submitForm();
                });

                $('#ChangesaveButton05').click(function() {
                    document.getElementById('formNameField').value = 'qa-final';
                    submitForm();
                });

                $('#ChangesaveButton06').click(function() {
                    document.getElementById('formNameField').value = 'qah';
                    submitForm();
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                var signatureForm = document.getElementById('signatureModalForm');

                signatureForm.addEventListener('submit', function(e) {

                    var submitButton = signatureForm.querySelector('.signatureModalButton');
                    var spinner = signatureForm.querySelector('.signatureModalSpinner');

                    submitButton.disabled = true;

                    spinner.style.display = 'inline-block';
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                var signatureForm = document.getElementById('pendingInitiatorForm');

                signatureForm.addEventListener('submit', function(e) {

                    var submitButton = signatureForm.querySelector('.pendingInitiatorModalButton');
                    var spinner = signatureForm.querySelector('.pendingInitiatorModalSpinner');

                    submitButton.disabled = true;

                    spinner.style.display = 'inline-block';
                });
            });


            // =========================
            wow = new WOW({
                boxClass: 'wow', // default
                animateClass: 'animated', // default
                offset: 0, // default
                mobile: true, // default
                live: true // default
            })
            wow.init();
        </script>




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
                            '<td><input type="text" name="item_static[]"></td>' +
                            '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                            '</tr>';



                        return html;
                    }

                    var tableBody = $('#action_plan_details tbody');
                    var rowCount = tableBody.children('tr').length;
                    var newRow = generateTableRow(rowCount + 1);
                    tableBody.append(newRow);
                });
                $('#mitigation_plan_deatails').click(function(e) {
                    function generateTableRow(serialNumber) {
                        var users = @json($users);
                        // console.log(users);
                        var html =
                            '<tr>' +
                            '<td><input disabled type="text" name="serial_number[]" value="' + serialNumber +
                            '"></td>' +
                            '<td><input type="text" name="mitigation_steps[]"></td>' +
                            // '<td><input type="date" name="deadline2[]"></td>' +
                            '<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"><input type="text" id="deadline2' +
                            serialNumber +
                            '" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="deadline2[]" class="hide-input" oninput="handleDateInput(this, `deadline2' +
                    serialNumber + '`)" /></div></div></div></td>' +
                            '<td><select name="responsible_person[]">' +
                            '<option value="">Select a value</option>';

                        for (var i = 0; i < users.length; i++) {
                            html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                        }

                        html += '</select></td>' +
                            '<td><input type="text" name="status[]"></td>' +
                            '<td><input type="text" name="remark[]"></td>' +
                            '<td><button type="text" class="removeRowBtn">Remove</button></td>' +

                            '</tr>';

                        return html;
                    }

                    var tableBody = $('#mitigation_plan_deatails_details tbody');
                    var rowCount = tableBody.children('tr').length;
                    var newRow = generateTableRow(rowCount + 1);
                    tableBody.append(newRow);
                });
            });
        </script>

        <script>
            VirtualSelect.init({
                ele: '#Facility, #Group, #Audit, #reviewer_person_value, #Auditee, #root-cause-methodology, #reference_record, #related_record'
            });



            $(document).on('click', '.removeBtn', function() {
                console.log('click ');
                $(this).closest('tr').remove();
            })

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
                ele: '#departments,#departments_2,#departments2, #team_members, #training-require, #impacted_objects'
            });
        </script>
        <script>
            $(document).ready(function() {
                var loc = new locationInfo();
                var countryDropdown = $("#country");
                var desiredValue = '{{ $data->country }}';
                setTimeout(function() {
                    countryDropdown.find('option[value="{{ $data->country }}"]').prop('selected', true);
                    var countryId = jQuery("option:selected", this).attr('countryid');
                    if (countryId != '') {
                        loc.getStates(countryId);
                    } else {
                        jQuery(".states option:gt(0)").remove();
                    }
                    var stateDropdown = $("#state");
                    stateDropdown.find('option[value="{{ $data->state }}"]').prop('selected', true);
                    var stateId = jQuery("option:selected", this).attr('stateid');
                    if (stateId != '') {
                        loc.getCities(stateId);
                    } else {
                        jQuery(".cities option:gt(0)").remove();
                    }
                    var cityDropdown = $("#city");
                    cityDropdown.find('option[value="{{ $data->city }}"]').prop('selected', true);
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
                // document.getElementById('analysisRPN').value = result;
                document.getElementById('analysisRPN').value = result;

                let riskLevel = '';
                if (result >= 1 && result <= 24) {
                    riskLevel = 'Low';
                } else if (result >= 25 && result <= 74) {
                    riskLevel = 'Medium';
                } else if (result >= 75) {
                    riskLevel = 'High';
                }

                document.getElementById('riskLevel').value = riskLevel;

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
            document.addEventListener('DOMContentLoaded', function() {
                const removeButtons = document.querySelectorAll('.remove-file');

                removeButtons.forEach(button => {
                    button.addEventListener('click', function() {
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
            $(document).on('click', '.removeRowBtn', function() {

                $(this).closest('tr').remove();
            })
        </script>

        <script>
            $(document).ready(function() {
                $('#root-cause-methodology').on('change', function() {
                    var selectedValues = $(this).val() || [];

                    // Hide all sections initially
                    $('#why-why-chart-section').hide();
                    $('#fmea-section').hide();
                    $('#fishbone-section').hide();
                    $('#is-is-not-section').hide();

                    // Show sections based on the selected values
                    selectedValues.forEach(function(value) {
                        if (value === 'Why-Why Chart') {
                            $('#why-why-chart-section').show();
                        }
                        if (value === 'Failure Mode and Effect Analysis') {
                            $('#fmea-section').show();
                        }
                        if (value === 'Fishbone or Ishikawa Diagram') {
                            $('#fishbone-section').show();
                        }
                        if (value === 'Is/Is Not Analysis') {
                            $('#is-is-not-section').show();
                        }
                    });
                });

                // Trigger the change event on page load to show the correct sections based on initial values
                $('#root-cause-methodology').trigger('change');
            });
        </script>

        <script>
            $(document).ready(function() {
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
            });
        </script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!-- SweetAlert2 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            @if (Session::has('swal'))
                Swal.fire({
                    title: '{{ Session::get('swal.title') }}',
                    text: '{{ Session::get('swal.message') }}',
                    icon: '{{ Session::get('swal.type') }}', // Type can be success, warning, error
                    confirmButtonText: 'OK',
                    width: '350px',
                    height: '100px',
                    size: '20px',
                });
            @endif
        </script>
        <style>
            .swal2-title {
                font-size: 14px;
                /* Customize title font size */
            }

            .swal2-html-container {
                font-size: 14px;
                /* Customize content text font size */
            }

            .swal2-confirm {
                font-size: 10px;
                /* Customize confirm button font size */
            }
        </style>

        <script>
            function addRiskAssessmentdata1(tableId) {
                var table = document.getElementById(tableId);
            var currentRowCount = table.children[1].rows.length;
            var newRow = table.children[1].insertRow(currentRowCount);
            newRow.setAttribute("id", "row" + currentRowCount);

                var cell1 = newRow.insertCell(0);
                cell1.innerHTML = currentRowCount +1;

                var cell2 = newRow.insertCell(1);
                cell2.innerHTML = "<input name='risk_factor[]' type='text'>";

                var cell4 = newRow.insertCell(2);
                cell4.innerHTML = "<input name='problem_cause[]' type='text'>";

                var cell5 = newRow.insertCell(3);
                cell5.innerHTML = "<input name='existing_risk_control[]' type='text'>";

                var cell6 = newRow.insertCell(4);
                cell6.innerHTML =
                    "<select onchange='calculateInitialResult(this)' class='fieldR' name='initial_severity[]'>" +
                    "<option value=''>-- Select --</option>" +
                    "<option value='1'>1-Insignificant</option>" +
                    "<option value='2'>2-Minor</option>" +
                    "<option value='3'>3-Major</option>" +
                    "<option value='4'>4-Critical</option>" +
                    "<option value='5'>5-Catastrophic</option>" +
                    "</select>";

                var cell7 = newRow.insertCell(5);
                cell7.innerHTML =
                    "<select onchange='calculateInitialResult(this)' class='fieldP' name='initial_probability[]'>" +
                    "<option value=''>-- Select --</option>" +
                    "<option value='1'>1-Very rare</option>" +
                    "<option value='2'>2-Unlikely</option>" +
                    "<option value='3'>3-Possibly</option>" +
                    "<option value='4'>4-Likely</option>" +
                    "<option value='5'>5-Almost certain (every time)</option>" +
                    "</select>";

                var cell8 = newRow.insertCell(6);
                cell8.innerHTML =
                    "<select onchange='calculateInitialResult(this)' class='fieldN' name='initial_detectability[]'>" +
                    "<option value=''>-- Select --</option>" +
                    "<option value='1'>1-Always detected</option>" +
                    "<option value='2'>2-Likely to detect</option>" +
                    "<option value='3'>3-Possible to detect</option>" +
                    "<option value='4'>4-Unlikely to detect</option>" +
                    "<option value='5'>5-Not detectable</option>" +
                    "</select>";

                var cell9 = newRow.insertCell(7);
                cell9.innerHTML = "<input name='initial_rpn[]' type='text' class='initial-rpn' readonly>";

                var cell11 = newRow.insertCell(8);
                cell11.innerHTML = "<input name='risk_control_measure[]' type='text'>";

                var cell12 = newRow.insertCell(9);
                cell12.innerHTML =
                    "<select onchange='calculateResidualResult(this)' class='residual-fieldR' name='residual_severity[]'>" +
                    "<option value=''>-- Select --</option>" +
                    "<option value='1'>1-Insignificant</option>" +
                    "<option value='2'>2-Minor</option>" +
                    "<option value='3'>3-Major</option>" +
                    "<option value='4'>4-Critical</option>" +
                    "<option value='5'>5-Catastrophic</option>" +
                    "</select>";

                var cell13 = newRow.insertCell(10);
                cell13.innerHTML =
                    "<select onchange='calculateResidualResult(this)' class='residual-fieldP' name='residual_probability[]'>" +
                    "<option value=''>-- Select --</option>" +
                    "<option value='1'>1-Very rare</option>" +
                    "<option value='2'>2-Unlikely</option>" +
                    "<option value='3'>3-Possibly</option>" +
                    "<option value='4'>4-Likely</option>" +
                    "<option value='5'>5-Almost certain (every time)</option>" +
                    "</select>";

                var cell14 = newRow.insertCell(11);
                cell14.innerHTML =
                    "<select onchange='calculateResidualResult(this)' class='residual-fieldN' name='residual_detectability[]'>" +
                    "<option value=''>-- Select --</option>" +
                    "<option value='1'>1-Always detected</option>" +
                    "<option value='2'>2-Likely to detect</option>" +
                    "<option value='3'>3-Possible to detect</option>" +
                    "<option value='4'>4-Unlikely to detect</option>" +
                    "<option value='5'>5-Not detectable</option>" +
                    "</select>";

                var cell15 = newRow.insertCell(12);
                cell15.innerHTML = "<input name='residual_rpn[]' type='text' class='residual-rpn' readonly>";

                var cell10 = newRow.insertCell(13);
                cell10.innerHTML =
                    "<select name='risk_acceptance[]' class='risk-acceptance' readonly>" +
                    "<option value=''>-- Select --</option>" +
                    "<option value='Low'>Low</option>" +
                    "<option value='Medium'>Medium</option>" +
                    "<option value='High'>High</option>" +
                    "</select>";

                var cell16 = newRow.insertCell(14);
                cell16.innerHTML =
                    "<select name='risk_acceptance2[]'><option value=''>-- Select --</option><option value='N'>N</option><option value='Y'>Y</option></select>";

                var cell17 = newRow.insertCell(15);
                cell17.innerHTML = "<input name='mitigation_proposal[]' type='text'>";

                var cell18 = newRow.insertCell(16);
                cell18.innerHTML = "<button class='btn btn-dark removeBtn' onclick='removeRow(this)'>Remove</button>";

                // Update row numbers
                for (var i = 0; i < currentRowCount-1; i++) {
                var row = table.children[1].rows[i];
                row.cells[0].innerHTML = i+1;
            }

                // initializeRiskAcceptance();
            }
        </script>

         <!-- Correct Order -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>


    @endsection
