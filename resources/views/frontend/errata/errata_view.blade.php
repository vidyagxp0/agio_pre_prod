@extends('frontend.layout.main')
@section('container')
    <style>
        textarea.note-codable {
            display: none !important;
        }

        /* header {
            display: none;
        } */
            header .header_rcms_bottom ,.container-fluid.header-bottom,.search-bar{
            display: none;
        }
    </style>

    <div class="form-field-head">
        {{-- <div class="pr-id">
            New Child
        </div> --}}
        <div class="division-bar">
            <strong>Site Division/Project</strong> : {{ Helpers::getDivisionName($showdata->division_id) }}/ERRATA
        </div>
    </div>


    <style>
        .progress-bars div {
            flex: 1 1 auto;
            border: 1px solid grey;
            padding: 5px;
            /* border-radius: 20px; */
            text-align: center;
            position: relative;
            /* border-right: none; */
            background: white;
        }

        .state-block {
            padding: 20px;
            margin-bottom: 20px;
        }

        .progress-bars div.active {
            background: green;
            font-weight: bold;
        }

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(1) {
            border-radius: 20px 0px 0px 20px;
        }

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(8) {
            border-radius: 0px 20px 20px 0px;

        }
    </style>

    @if (Session::has('swal'))
        <script>
            swal("{{ Session::get('swal')['title'] }}", "{{ Session::get('swal')['message'] }}",
                "{{ Session::get('swal')['type'] }}")
        </script>
    @endif

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (Session::has('swal'))
            Swal.fire({
                title: '{{ Session::get('swal.title') }}',
                text: '{{ Session::get('swal.message') }}',
                icon: '{{ Session::get('swal.type') }}', // Type can be success, warning, error
                confirmButtonText: 'OK',
                width: '300px',
                height: '200px',
                size: '50px',
            });
        @endif
    </script>
    <style>
        .swal2-title {
            font-size: 18px;
            /* Customize title font size */
        }

        .swal2-html-container {
            font-size: 14px;
            /* Customize content text font size */
        }

        .swal2-confirm {
            font-size: 14px;
            /* Customize confirm button font size */
        }
    </style>

    {{-- ! ========================================= --}}
    {{-- !               DATA FIELDS                 --}}
    {{-- ! ========================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">


            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>

                    <div class="d-flex" style="gap:20px;">
                        @php
                            $userRoles = DB::table('user_roles')
                                ->where(['user_id' => auth()->id(), 'q_m_s_divisions_id' => $showdata->division_id])
                                ->get();
                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                        @endphp
                        <button class="button_theme1"> <a class="text-white"
                                href="{{ url('errataaudittrail', $showdata->id) }}">
                                Audit Trail </a> </button>

                        @if (
                            $showdata->stage == 1 &&
                                (Helpers::check_roles($showdata->division_id, 'ERRATA', 3) || ($showdata->initiator_id == Auth::user()->id) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif(
                            $showdata->stage == 2 &&
                                (Helpers::check_roles($showdata->division_id, 'ERRATA', 4) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#reject-modal">
                                More info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#review-modal">
                                HOD Initial Review Complete
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button> --}}
                        @elseif(
                            $showdata->stage == 3 &&
                                (Helpers::check_roles($showdata->division_id, 'ERRATA', 7) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 66) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Review Complete
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button> --}}
                        @elseif(
                            $showdata->stage == 4 &&
                                (Helpers::check_roles($showdata->division_id, 'ERRATA', 65) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 42) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 43) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 39) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 9) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 18)))
                            <button class="button_theme1" data-bs-toggle="modal"
                                data-bs-target="#more-inform-required-modal">
                                More info Required
                            </button>

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hod-rewieve-modal">
                                Approval Complete
                            </button>
                        @elseif(
                            $showdata->stage == 5 &&
                                (Helpers::check_roles($showdata->division_id, 'ERRATA', 3) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 18)))
                            <button class="button_theme1" data-bs-toggle="modal"
                                data-bs-target="#more-inform-required-modal">
                                Request More Info
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#qa-head-approval-model">
                                Correction Completed
                            </button>
                        @elseif(
                            $showdata->stage == 6 &&
                                (Helpers::check_roles($showdata->division_id, 'ERRATA', 4) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 18)))
                            <button class="button_theme1" data-bs-toggle="modal"
                                data-bs-target="#more-inform-required-modal">
                                Request More Info
                            </button>

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hod-rewieve-modal">
                                HOD Review Completed
                            </button>
                        @elseif(
                            $showdata->stage == 7 &&
                                ( Helpers::check_roles($showdata->division_id, 'ERRATA', 65) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 42) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 43) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 39) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 9) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-inform-required-modal">
                                Request More Info
                            </button>

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hod-rewieve-modal">
                               QA/CQA Head Approval Completed
                            </button>
                        @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a> </button>
                    </div>

                </div>

                <style>
                    /* Linear Connected Progress Bar */
                    .progress-bars {
                        display: flex;
                        border-radius: 30px;
                        overflow: hidden;
                        border: 1px solid #e0e0e0;
                        background: #f5f5f5;
                    }
                    
                    .progress-bars div {
                        padding: 8px 12px;
                        font-size: 14px;
                        flex-grow: 1;
                        text-align: center;
                        position: relative;
                        transition: all 0.3s ease;
                        border-right: 1px solid #fff;
                    }
                    
                    .progress-bars div:last-child {
                        border-right: none;
                    }
                    
                    /* Completed Stages - Solid Green */
                    .progress-bars div.completed {
                        background-color: #4CAF50;
                        color: black;
                    }
                    
                    /* CURRENT Stage - Animated Blue (Pending Action) */
                    .progress-bars div.current {
                        background-color: #de8d0a;
                        color: black;
                        font-weight: bold;
                        animation: pulse-blue 1.5s infinite;
                    }
                    
                    /* Pending Stages - Light Gray */
                    .progress-bars div.pending {
                        background-color: #f5f5f5;
                        color: black;
                    }
                    
                    /* Closed States */
                    .progress-bars div.closed {
                        background-color: #f44336;
                        color: white;
                    }
                    
                    /* Blue Pulse Animation */
                    @keyframes pulse-blue {
                        0% { background-color: #de8d0a; }
                        50% { background-color: #dfac54; }
                        100% { background-color: #de8d0a; }
                    }
                </style>
                @php
                    $currentStage = $showdata->stage;
                @endphp
                <div class="status">
                    <div class="head">Current Status</div>
                    @if ($showdata->stage == 0)
                        <div class="progress-bars ">
                            <div class="bg-danger" style=" border-radius: 20px; ">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars d-flex" style="font-size: 15px;">

                            <div class="{{ $currentStage > 1 ? 'active' : ($currentStage == 1 ? 'current' : '') }}">Opened</div>

                            <div class="{{ $currentStage > 2 ? 'active' : ($currentStage == 2 ? 'current' : '') }}">HOD Review</div>

                            <div class="{{ $currentStage > 3 ? 'active' : ($currentStage == 3 ? 'current' : '') }}">QA/CQA Initial Review</div>

                            <div class="{{ $currentStage > 4 ? 'active' : ($currentStage == 4 ? 'current' : '') }}">QA/CQA Approval</div>

                            <div class="{{ $currentStage > 5 ? 'active' : ($currentStage == 5 ? 'current' : '') }}">Pending Correction</div>

                            <div class="{{ $currentStage > 6 ? 'active' : ($currentStage == 6 ? 'current' : '') }}">Pending HOD Review</div>

                            <div class="{{ $currentStage > 7 ? 'active' : ($currentStage == 7 ? 'current' : '') }}">Pending QA/CQA Head Approval</div>
                            @if ($showdata->stage >= 8)
                                <div class="bg-danger">Closed Done</div>
                            @else
                                <div class="">Closed Done</div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <!-- Tab links -->
            <div class="cctab">
                <button type="button" class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button type="button" class="cctablinks " onclick="openCity(event, 'CCForm2')">HOD Initial Review</button>
                <button type="button" class="cctablinks" onclick="openCity(event, 'CCForm4')">QA/CQA Initial Review</button>
                <button type="button" class="cctablinks" onclick="openCity(event, 'CCForm5')">QA/CQA Head Designee Approval</button>
                <button type="button" class="cctablinks" onclick="openCity(event, 'CCForm6')">Initiator Update</button>
                <button type="button" class="cctablinks" onclick="openCity(event, 'CCForm7')">HOD final Review</button>
                <button type="button" class="cctablinks" onclick="openCity(event, 'CCForm9')">QA/CQA Head Designee Closure
                    Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">Activity Log</button>
            </div>
            <script>
                function activateTabBasedOnStage(stage) {
                    const tabContents = document.querySelectorAll('.cctabcontent');
                    const tabLinks = document.querySelectorAll('.cctablinks');
                    
                    tabContents.forEach(content => content.style.display = 'none');
                    tabLinks.forEach(link => link.classList.remove('active'));
                    
                    let tabToActivate = '';
                    
                    if (stage == 1) {
                        tabToActivate = 'CCForm1'; 
                    } else if (stage == 2) {
                        tabToActivate = 'CCForm2'; 
                    }  else if (stage == 3) {
                        tabToActivate = 'CCForm4'; 
                    } else if (stage == 4) {
                        tabToActivate = 'CCForm5'; 
                    } else if (stage == 5) {
                        tabToActivate = 'CCForm6'; 
                    } else if (stage == 6) {
                        tabToActivate = 'CCForm7'; 
                    } else if (stage == 8){
                        tabToActivate = 'CCForm9';
                    } else if (stage == 7){
                        tabToActivate = 'CCForm10';
                    } else if (stage == 0){
                        tabToActivate = 'CCForm10';
                    }

                    if (tabToActivate) {
                        const tabContent = document.getElementById(tabToActivate);
                        const tabLink = document.querySelector(`.cctablinks[onclick*="${tabToActivate}"]`);
                        
                        if (tabContent) tabContent.style.display = 'block';
                        if (tabLink) tabLink.classList.add('active');
                    }
                }

                function openCity(evt, cityName) {
                    const tabContents = document.querySelectorAll('.cctabcontent');
                    tabContents.forEach(content => content.style.display = 'none');
                    
                    const tabLinks = document.querySelectorAll('.cctablinks');
                    tabLinks.forEach(link => link.classList.remove('active'));
                    
                    document.getElementById(cityName).style.display = 'block';
                    evt.currentTarget.classList.add('active');
                    
                    currentStep = Array.from(tabLinks).findIndex(button => button === evt.currentTarget);
                }

                document.addEventListener('DOMContentLoaded', function() {
                    const currentStage = <?php echo json_encode($showdata->stage ?? 1); ?>;
                    
                    activateTabBasedOnStage(currentStage);
                });
            </script>
            <form action="{{ route('errata.update', $showdata->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                                        <label for="RLS Record Number">Record Number</label>
                                        <input disabled type="text" name="record_no"
                                            value="{{ Helpers::getDivisionName($showdata->division_id) }}/ERRATA/{{ Helpers::year($showdata->created_at) }}/{{ str_pad($showdata->record, 4, '0', STR_PAD_LEFT) }}">
                                        {{-- <input disabled type="text" name="record"> --}}
                                        {{-- value="{{ Helpers::getDivisionName(session()->get('division')) }}/ERRATA/{{ date('Y') }}/{{ $record }}"> --}}
                                        {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code">Site/Location Code</label>
                                        <input readonly type="text" name="division_id"
                                            value="{{ Helpers::getDivisionName($showdata->division_id) }}">
                                        <input type="hidden" name="division_id" value="{{ $showdata->division_id }}">
                                        {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator">Initiator</label>
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" name="initiator_by"
                                            value="{{ Helpers::getInitiatorName($showdata->initiator_id) }}"
                                            {{ Helpers::disabledErrataFields($showdata->stage) }}>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due">Date of Initiation</label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date"
                                            {{ Helpers::disabledErrataFields($showdata->stage) }}>
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date"
                                            {{ Helpers::disabledErrataFields($showdata->stage) }}>
                                    </div>
                                </div>

                                <!-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="Initiated Through">
                                        Initiated Through <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="initiated_by"
                                        {{ Helpers::disabledErrataFields($showdata->stage) }}>
                                        <option value="">--Select--</option>
                                        <option value="Recall "{{ $showdata->initiated_by == 'Recall' ? 'selected' : '' }}>Recall </option>
                                        <option value="Return "{{ $showdata->initiated_by == 'Return' ? 'selected' : '' }}>Return </option>
                                        <option value="Deviation"{{ $showdata->initiated_by == 'Deviation' ? 'selected' : '' }}>Deviation</option>
                                        <option value="Complaint"{{ $showdata->initiated_by == 'Complaint' ? 'selected' : '' }}>Complaint</option>
                                        <option value="Regulatory"{{ $showdata->initiated_by == 'Regulatory' ? 'selected' : '' }}>Regulatory</option>
                                        <option value="Lab Incident"{{ $showdata->initiated_by == 'Lab Incident' ? 'selected' : '' }}>Lab Incident</option>
                                        <option value="Improvement"{{ $showdata->initiated_by == 'Improvement' ? 'selected' : '' }}>Improvement</option>
                                        <option value="Others"{{ $showdata->initiated_by == 'Others' ? 'selected' : '' }}>Others</option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator"><b>Department</b></label>
                                    <input readonly type="text" name="Department" id="Department"
                                        value="{{ $showdata->Department }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiation Group Code"> Department Code</label>
                                    <input type="text" name="department_code"
                                        value="{{ $showdata->department_code }}" id="department_code"
                                        readonly>
                                </div>
                            </div>

                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="Department">
                                            Department<span class="text-danger"></span>
                                        </label>
                                        <select name="Department"
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}
                                            id="selectedOptions" {{ Helpers::disabledErrataFields($showdata->stage) }}>
                                            <option value="">--Select--</option>
                                            <option value="CQA" @if ($showdata->Department == 'CQA') selected @endif>
                                                Corporate Quality Assurance</option>
                                            <option value="QA" @if ($showdata->Department == 'QA') selected @endif>
                                                Quality Assurance</option>
                                            <option value="QC" @if ($showdata->Department == 'QC') selected @endif>
                                                Quality Control</option>
                                            <option value="QM" @if ($showdata->Department == 'QM') selected @endif>
                                                Quality Control (Microbiology department)
                                            </option>
                                            <option value="PG" @if ($showdata->Department == 'PG') selected @endif>
                                                Production General</option>
                                            <option value="PL" @if ($showdata->Department == 'PL') selected @endif>
                                                Production Liquid Orals</option>
                                            <option value="PT" @if ($showdata->Department == 'PT') selected @endif>
                                                Production Tablet and Powder</option>
                                            <option value="PE" @if ($showdata->Department == 'PE') selected @endif>
                                                Production External (Ointment, Gels, Creams and Liquid)</option>
                                            <option value="PC" @if ($showdata->Department == 'PC') selected @endif>
                                                Production Capsules</option>
                                            <option value="PI" @if ($showdata->Department == 'PI') selected @endif>
                                                Production Injectable</option>
                                            <option value="EN" @if ($showdata->Department == 'EN') selected @endif>
                                                Engineering</option>
                                            <option value="HR" @if ($showdata->Department == 'HR') selected @endif>
                                                Human Resource</option>
                                            <option value="ST" @if ($showdata->Department == 'ST') selected @endif>
                                                Store</option>
                                            <option value="IT" @if ($showdata->Department == 'IT') selected @endif>
                                                Electronic Data Processing
                                            </option>
                                            <option value="FD" @if ($showdata->Department == 'FD') selected @endif>
                                                Formulation Development
                                            </option>
                                            <option value="AL" @if ($showdata->Department == 'AL') selected @endif>
                                                Analytical research and Development Laboratory
                                            </option>
                                            <option value="PD" @if ($showdata->Department == 'PD') selected @endif>
                                                Packaging Development
                                            </option>

                                            <option value="PU" @if ($showdata->Department == 'PU') selected @endif>
                                                Purchase Department
                                            </option>
                                            <option value="DC" @if ($showdata->Department == 'DC') selected @endif>
                                                Document Cell
                                            </option>
                                            <option value="RA" @if ($showdata->Department == 'RA') selected @endif>
                                                Regulatory Affairs
                                            </option>
                                            <option value="PV" @if ($showdata->Department == 'PV') selected @endif>
                                                Pharmacovigilance
                                            </option>
                                        </select>
                                    </div>
                                </div> --}}

                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Department Code</label>
                                        <input readonly type="text"
                                            name="department_code"{{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}
                                            value="{{ $showdata->department_code }}" id="initiator_group_code" readonly
                                            {{ Helpers::disabledErrataFields($showdata->stage) }}>
                                    </div>
                                </div> --}}

                                <script>
                                    document.getElementById('selectedOptions').addEventListener('change', function() {
                                        var selectedValue = this.value;
                                        document.getElementById('initiator_group_code').value = selectedValue;
                                    });

                                    function setCurrentDate(item) {
                                        if (item == 'yes') {
                                            $('#effect_check_date').val('{{ date('d-M-Y') }}');
                                        } else {
                                            $('#effect_check_date').val('');
                                        }
                                    }
                                </script>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="Department Code">
                                            Department Code<span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="department_code">
                                            <option value="{{ $showdata->department_code }}">
                                                {{ $showdata->department_code }}</option>
                                            <option value="DC01">DC01</option>
                                            <option value="DC02">DC02</option>
                                            <option value="DC03">DC03</option>
                                        </select>
                                    </div>
                                </div> --}}

                                {{-- <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Document Type">
                                            Document Type<span class="text-danger"> *</span>
                                        </label>
                                        <input type="text" name="document_type" {{ $showdata->stage != 1 ? 'readonly' : '' }}
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}
                                            value="{{ $showdata->document_type }}" required>
                                            
                                    </div>
                                </div> --}}

                                @php 
                            $initiatorRole = (Helpers::check_roles($showdata->division_id, 'ERRATA', 3) || ($showdata->initiator_id == Auth::user()->id) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 18));
                                @endphp

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">Document Type <span class="text-danger">*</span>
                                    </label>
                                        <select name="document_type" id="doc-type"
                                            onchange="handleDocumentSelection(this)"
                                            {{ Helpers::isRevised($showdata->stage) }} {{ $showdata->stage != 1 ? 'readonly' : '' }}
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}  {{ $showdata->stage == 1 && $initiatorRole ? '' : 'disabled' }}>

                                            <option value="">Enter your Selection</option>

                                            @foreach (Helpers::getDocumentTypes() as $code => $type)
                                                <option data-id="{{ $code }}" value="{{ $code }}"
                                                    {{ $code == $showdata->document_type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach

                                            <!-- Others option outside loop -->
                                            <option value="others"
                                                {{ $showdata->document_type == 'others' ? 'selected' : '' }}>
                                                Others
                                            </option>
                                        </select>
                                        @if($showdata->stage != 1)
                                         <input type="hidden" name="document_type" value="{{old('document_type', $showdata->document_type)}}">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6" id="others-input" style="display: none;">
                                    <div class="group-input">
                                        <label for="others">
                                            Others<span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="document_type_others" placeholder="" {{ $showdata->stage != 1 ? 'readonly' : '' }}
                                            value="{{ $showdata->document_type_others }}">
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

                                    // Trigger the function on page load if 'others' is already selected
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const select = document.getElementById('doc-type');
                                        handleDocumentSelection(select);
                                    });
                                </script>


                                {{-- <div class="col-6">
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
                                        <input type="text" name="others" placeholder="Please specify">
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

                                        </script>         --}}


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="short_description">Short Description<span class="text-danger">*</span></label>
                                        
                                        <textarea id="docname" name="short_description" 
                                            {{ $showdata->stage != 1 ? 'readonly' : '' }}
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'readonly' : '' }} {{ $showdata->stage == 1 && $initiatorRole ? '' : 'readonly' }}
                                            {{ Helpers::disabledErrataFields($showdata->stage) }}>{{ $showdata->short_description }}</textarea>
                                    </div>
                                </div>

                                @php
                                    // Assume $showdata is the object containing reference_document array
                                    // $showdata->reference_document = is_array($showdata->reference_document)
                                    //     ? $showdata->reference_document
                                    //     : explode(',', $showdata->reference_document);
                                    // $divisionName = Helpers::getDivisionName(Auth::user()->id);
                                    // $recordFormat = Helpers::recordFormat(Auth::user()->name);
                                    // $referenceValue = "{$divisionName}/Errata/" . date('Y') . "/{$recordFormat}";

                                    $old_record = DB::table('erratas')->get();
                                    $reference_documents = is_array($showdata->reference_document)
                                        ? $showdata->reference_document
                                        : explode(',', $showdata->reference_document);
                                @endphp

                                <!-- <div class="">
                                                <div class="group-input">
                                        <label for="reference_record">Reference Documents</label>
                                        <select multiple id="reference_record" name="reference_document[]"
                                            {{ Helpers::disabledErrataFields($showdata->stage) }}>
                                            @foreach ($old_record as $new)
                                            <option value="{{ $new->id }}"
                                                {{ in_array($new->id, $reference_documents) ? 'selected' : '' }}>
                                                {{ Helpers::getDivisionName($new->division_id) }}/ERRATA/{{ date('Y') }}/{{ str_pad($new->id, 4, '0', STR_PAD_LEFT) }}
                                                {{-- to add record number{{ Helpers::recordFormat($new->record) }}/ --}}
                                            </option>
                                            @endforeach
                                                {{-- <option value="{{ $referenceValue }}"
                                                @if (in_array($referenceValue, $showdata->reference_document)) selected @endif>
                                                {{ $referenceValue }}
                                            </option> --}}
                                                            {{-- Uncomment and add more options as needed --}}
                                                            {{-- <option value="RD02" @if (in_array('RD02', $showdata->reference_document)) selected @endif>RD02</option> --}}
                                                        </select>
                                                    </div>
                                </div> -->

                                {{-- <div class="">
                                    <div class="group-input">
                                        <label for="reference_record">Reference Documents</label>
                                        <input type="text" name="reference" maxlength="255"
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}
                                            value="{{ $showdata->reference }}">
                                    </div>
                                </div> --}}

                                <!-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="reference">Parent Record Number</label>
                                        <select multiple name="reference[]" data-silent-initial-value-set="true"
                                            id="reference" data-search="false"
                                            data-placeholder="Select Parent Record Number"
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}>
                                            @if (!empty($relatedRecords))
                                                @foreach ($relatedRecords as $records)
                                                    @php
                                                        $recordValue =
                                                            Helpers::getDivisionName(
                                                                $records->division_id ||
                                                                    $records->division ||
                                                                    $records->division_code ||
                                                                    $records->site_location_code,
                                                            ) .
                                                            '/' .
                                                            $records->process_name .
                                                            '/' .
                                                            date('Y') .
                                                            '/' .
                                                            Helpers::recordFormat($records->record);

                                                        $selected = in_array(
                                                            $recordValue,

                                                            explode(',', $showdata->reference),
                                                        )
                                                            ? 'selected'
                                                            : '';
                                                    @endphp
                                                    <option value="{{ $recordValue }}" {{ $selected }}>
                                                        {{ $recordValue }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>

                                    </div>
                                </div> -->


                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Observation on Page No.">Parent Record Number<span class="text-danger">*</span></label>
                                        <input type="text" name="reference" maxlength="255" {{ $showdata->stage != 1 ? 'readonly' : '' }}
                                            value="{{ $showdata->reference }}"
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'readonly' : '' }} {{ $showdata->stage == 1 && $initiatorRole ? '' : 'readonly' }}
                                            {{ Helpers::disabledErrataFields($showdata->stage) }} required>
                                    </div>

                                </div>


                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Observation on Page No.">Error Observed on Page  No. <span class="text-danger">*</span></label>
                                        <textarea class="summernote" name="Observation_on_Page_No" id="summernote-16" {{ $showdata->stage != 1 ? 'readonly' : '' }}
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }} {{ $showdata->stage == 1 && $initiatorRole ? '' : 'readonly' }}
                                            {{ Helpers::disabledErrataFields($showdata->stage) }} required>{{ $showdata->Observation_on_Page_No }}</textarea>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Brief Description">Brief Description of error <span class="text-danger">*</span></label>
                                        <textarea class="summernote" name="brief_description" id="summernote-16" {{ $showdata->stage != 1 ? 'readonly' : '' }}
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }} {{ $showdata->stage == 1 && $initiatorRole ? '' : 'readonly' }}
                                            {{ Helpers::disabledErrataFields($showdata->stage) }} required>{{ $showdata->brief_description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Document title">Document title <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="document_title" maxlength="255" {{ $showdata->stage != 1 ? 'readonly' : '' }}
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }} {{ $showdata->stage == 1 && $initiatorRole ? '' : 'readonly' }}
                                            value="{{ $showdata->document_title }}">
                                    </div>
                                </div>

                                @php
                                    $users = DB::table('users')->get();
                                @endphp
                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Type Of Error<span class="text-danger">*</span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="type_of_error"
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }} {{ $showdata->stage != 1 ? 'readonly' : '' }} {{ $showdata->stage == 1 && $initiatorRole ? '' : 'disabled' }}>
                                            <option value="">-- Select a value --</option>
                                            <option value="Typographical Error (TE)"
                                                {{ $showdata->type_of_error == 'Typographical Error (TE)' ? 'selected' : '' }}>
                                                Typographical Error (TE)</option>
                                            <option value="Calculation Error (CE)"
                                                {{ $showdata->type_of_error == 'Calculation Error (CE)' ? 'selected' : '' }}>
                                                Calculation Error (CE)</option>
                                            <option value="Grammatical Error (GE)"
                                                {{ $showdata->type_of_error == 'Grammatical Error (GE)' ? 'selected' : '' }}>
                                                Grammatical Error (GE)</option>
                                            <option value="Missing Word Error (ME)"
                                                {{ $showdata->type_of_error == 'Missing Word Error (ME)' ? 'selected' : '' }}>
                                                Missing Word Error (ME)</option>
                                            <option value="Other"
                                                {{ $showdata->type_of_error == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @if($showdata->stage != 1)
                                        <input type="hidden" name="type_of_error" value="{{old('type_of_error', $showdata->type_of_error)}}">
                                        @endif
                                    </div>
                                </div>


                                <div id="typeOfErrorBlock" class="group-input col-6" style="display:none;">
                                    <label for="otherFieldsUser">Other <span class="text-danger">*</span></label>
                                    <input type="text" name="otherFieldsUser" class="form-control" {{ $showdata->stage != 1 ? 'readonly' : '' }} {{ $showdata->stage == 1 && $initiatorRole ? '' : 'readonly' }}
                                        value="{{ old('otherFieldsUser', $showdata->otherFieldsUser ?? '') }}" />
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

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Correction Of Error">Correction Of Error
                                            required <span class="text-danger">*</span></label>
                                        <textarea class="summernote" name="Correction_Of_Error" id="summernote-16" {{ $showdata->stage != 1 ? 'readonly' : '' }}
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }} {{ $showdata->stage == 1 && $initiatorRole ? '' : 'readonly' }} required>{{ $showdata->Correction_Of_Error }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Department Head <span class="text-danger">*</span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="department_head_to"
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }} {{ $showdata->stage == 1 && $initiatorRole ? '' : 'disabled' }} required>
                                            <option value="">Select a Value</option>
                                            @foreach ($users as $value)
                                                <option @if ($showdata->department_head_to == $value->id) selected @endif
                                                    value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($showdata->stage != 1)
                                         <input type="hidden" name="department_head_to" value="{{old('department_head_to', $showdata->department_head_to)}}">
                                        @endif
                                        @error('department_head_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="search">
                                        <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="">
                                        <option value="">Select a value</option>
                                        @foreach ($users as $key => $value)
                                            <option  @if ($showdata->department_head_to == $value->name) selected @endif  value="{{ $value->name }}">{{ $value->name }}</option>
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
                                            QA reviewer <span class="text-danger">*</span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="qa_reviewer" {{ $showdata->stage != 1 ? 'readonly' : '' }} {{ $showdata->stage == 1 && $initiatorRole ? '' : 'disabled' }}
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }} required>
                                            <option value="">Select a value</option>
                                            @foreach ($users as $key => $value)
                                                <option @if ($showdata->qa_reviewer == $value->id) selected @endif
                                                    value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($showdata->stage != 1)
                                         <input type="hidden" name="qa_reviewer" value="{{old('qa_reviewer', $showdata->qa_reviewer)}}">
                                        @endif
                                        @error('qa_reviewer')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>


                                {{-- <div class="sub-head">Details</div> --}}
                                <div class="group-input">
                                    <label for="action-plan-grid">
                                        Details<button type="button" name="action-plan-grid" {{ $showdata->stage != 1 ? 'disabled' : '' }}
                                                id="Details_add" {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }} >+</button>
                                        <!-- <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            Launch Deviation
                                        </span> -->
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Details-table"
                                            {{ Helpers::disabledErrataFields($showdata->stage) }} >
                                            <thead>
                                                <tr>
                                                    <th style="width: 2%">Sr.No.</th>
                                                    <th style="width: 12%">List Of Impacting Document (If Any)</th>
                                                    <!-- <th style="width: 16%"> Prepared By</th>
                                                                <th style="width: 15%">Checked By</th>
                                                                <th style="width: 15%">Approved By</th> -->
                                                    <th style="width: 3%">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                               @foreach (unserialize($griddata->ListOfImpactingDocument) as $key => $temps)
                                                        <tr>

                                                                <td><input disabled type="text" name="serial_number[]"
                                                                        value="{{ $key + 1 }}">
                                                                </td>
                                                                <td><input type="text" name="ListOfImpactingDocument[]" required {{ $showdata->stage != 1 ? 'readonly' : '' }} {{ $showdata->stage == 1 && $initiatorRole ? '' : 'readonly' }}
                                                                        {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}
                                                                        value="{{ unserialize($griddata->ListOfImpactingDocument)[$key] ? unserialize($griddata->ListOfImpactingDocument)[$key] : '' }}">
                                                                </td>


                                                            <td><button type="text"
                                                                    class="removeRowBtn">Remove</button></td>
                                                        </tr>
                                                    @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="button-block">
                                @if ($showdata->stage >= 8)
                                    <button type="submit" class="saveButton" disabled>Save</button>
                                @else
                                    <button type="submit" class="saveButton">Save</button>
                                @endif
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>
                    <!-- -----------Tab-2------------ -->
                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                          @php 
                            $HodRole = (Helpers::check_roles($showdata->division_id, 'ERRATA', 4) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 18));
                          @endphp
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        @if ($showdata->stage == 2)
                                            <label class="mt-4" for="HOD Initial Comment">HOD Initial Comment <span
                                                    class="text-danger">*</span></label>
                                        @else
                                            <label class="mt-4" for="HOD Initial Comment">HOD Initial Comment</label>
                                        @endif
                                        {{-- <label class="mt-4" for="HOD Initial Comment">HOD Initial Comment</label> --}}
                                        <textarea class="summernote" name="HOD_Remarks" id="summernote-16" required
                                            {{ $showdata->stage == 1 || $showdata->stage == 3 ||$showdata->stage == 1 ||$showdata->stage == 4 || $showdata->stage == 5 ||$showdata->stage == 6 || $showdata->stage == 7 || $showdata->stage == 0 || $showdata->stage == 8 ? 'readonly' : '' }} {{ $showdata->stage == 2 && $HodRole ? '' : 'readonly' }}
                                            >{{ $showdata->HOD_Remarks }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="HOD_Attachments">HOD Initial Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="HOD_Attachments">
                                                @if ($showdata->HOD_Attachments)
                                                    @foreach (json_decode($showdata->HOD_Attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_HOD_Attachments[]"
                                                                value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>


                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="HOD_Attachments[]"
                                                {{ $showdata->stage == 1 || $showdata->stage == 3 ||$showdata->stage == 1 ||$showdata->stage == 4 || $showdata->stage == 5 ||$showdata->stage == 6 || $showdata->stage == 7 || $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }} {{ $showdata->stage == 2 && $HodRole ? '' : 'disabled' }}
                                                    oninput="addMultipleFiles(this, 'HOD_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_HOD_Attachments" name="deleted_HOD_Attachments"
                                    value="">

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
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById(
                                                        'deleted_HOD_Attachments');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                        ',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // You might need to adjust this to handle local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>



                                <div class="button-block">
                                    @if ($showdata->stage >= 8)
                                        <button type="submit" class="saveButton" disabled>Save</button>
                                    @else
                                        <button type="submit" class="saveButton">Save</button>
                                    @endif
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
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
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
                                @php 
                                $QaRole= (Helpers::check_roles($showdata->division_id, 'ERRATA', 7) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 66) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 18));
                                @endphp
                                <div class="col-12">
                                    <div class="group-input">
                                        @if ($showdata->stage == 3)
                                            <label class="mt-4" for="QA Initial Comment">QA/CQA Initial Comment<span
                                                    class="text-danger">*</span></label>
                                        @else
                                            <label class="mt-4" for="QA Initial Comment">QA/CQA Initial Comment</label>
                                        @endif
                                        {{-- <label class="mt-4" for="QA Initial Comment">QA/CQA Initial Comment</label> --}}
                                        <textarea class="summernote" name="QA_Feedbacks" id="summernote-16" required
                                            {{$showdata->stage == 1 || $showdata->stage == 2  ||$showdata->stage == 4 || $showdata->stage == 5 ||$showdata->stage == 6 || $showdata->stage == 7 ||$showdata->stage == 0 || $showdata->stage == 8 ? 'readonly' : '' }} {{ $showdata->stage == 3 && $QaRole ? '' : 'readonly' }}
                                            {{ Helpers::disabledErrataFields($showdata->stage) }}>{{ $showdata->QA_Feedbacks }}</textarea>
                                    </div>
                                </div>


                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Initial Attachments">QA/CQA Initial Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="QA_Attachments">
                                                @if ($showdata->QA_Attachments)
                                                    @foreach (json_decode($showdata->QA_Attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgba(255, 255, 255, 0);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
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
                                                <input type="file" id="myfile" name="QA_Attachments[]"
                                                    {{ $showdata->stage == 1 || $showdata->stage == 2  || $showdata->stage == 4 || $showdata->stage == 5 || $showdata->stage == 6 || $showdata->stage == 7 ||$showdata->stage == 0 || $showdata->stage == 8  ? 'disabled' : '' }}
                                                    oninput="addMultipleFiles(this, 'QA_Attachments')"
                                                    {{ Helpers::disabledErrataFields($showdata->stage) }} multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA_Attachments">QA/CQA Initial Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_Attachments">
                                                @if ($showdata->QA_Attachments)
                                                    @foreach (json_decode($showdata->QA_Attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_QA_Attachments[]"
                                                                value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="QA_Attachments[]"
                                                    {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}  {{ $showdata->stage == 3 && $QaRole ? '' : 'disabled' }}
                                                    oninput="addMultipleFiles(this, 'QA_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_QA_Attachments" name="deleted_QA_Attachments"
                                    value="">

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
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById('deleted_QA_Attachments');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                        ',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // You might need to adjust this to handle local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>



                                <div class="button-block">
                                    @if ($showdata->stage >= 8)
                                        <button type="submit" class="saveButton" disabled>Save</button>
                                    @else
                                        <button type="submit" class="saveButton">Save</button>
                                    @endif
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
                                @php 
                                $QaHeadRole  = (Helpers::check_roles($showdata->division_id, 'ERRATA', 65) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 42) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 43) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 39) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 9) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 18));
                                @endphp
                                <div class="col-12">
                                    <div class="group-input">
                                        @if ($showdata->stage == 4)
                                            <label class="mt-4" for="Approval Comment">Approval Comment<span
                                                    class="text-danger">*</span></label>
                                        @else
                                            <label class="mt-4" for="Approval Comment">Approval Comment</label>
                                        @endif
                                        {{-- <label class="mt-4" for="Approval Comment">Approval Comment</label> --}}
                                        <textarea class="summernote" name="Approval_Comment" id="summernote-16" required
                                            {{ $showdata->stage == 1 || $showdata->stage == 2  || $showdata->stage == 3 || $showdata->stage == 5 || $showdata->stage == 6 || $showdata->stage == 7 ||$showdata->stage == 0 || $showdata->stage == 8  ? 'readonly' : '' }}  {{ $showdata->stage == 4 && $QaHeadRole ? '' : 'readonly' }}>{{ $showdata->Approval_Comment }}</textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Approval Attachments">Approval Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Approval_Attachments">
                                                @if ($showdata->Approval_Attachments)
                                                    @foreach (json_decode($showdata->Approval_Attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i>
                                                            </a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input
                                                {{ $showdata->stage == 1 || $showdata->stage == 2  || $showdata->stage == 3 || $showdata->stage == 5 || $showdata->stage == 6 || $showdata->stage == 7 ||$showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}
                                                    type="file" id="Approval_Attachments"
                                                    name="Approval_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'Approval_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Approval_Attachments">Approval Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Approval_Attachments">
                                                @if ($showdata->Approval_Attachments)
                                                    @foreach (json_decode($showdata->Approval_Attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_Approval_Attachments[]"
                                                                value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="Approval_Attachments"
                                                    name="Approval_Attachments[]"
                                                    {{ $showdata->stage == 1 || $showdata->stage == 2  || $showdata->stage == 3 || $showdata->stage == 5 || $showdata->stage == 6 || $showdata->stage == 7 ||$showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }} {{ $showdata->stage == 4 && $QaHeadRole ? '' : 'disabled' }}
                                                    oninput="addMultipleFiles(this, 'Approval_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_Approval_Attachments"
                                    name="deleted_Approval_Attachments" value="">

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
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById(
                                                        'deleted_Approval_Attachments');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                        ',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // Adjust this to handle local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>







                                {{-- <div class="col-lg-12 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due">Date Of Correction</label>
                                        <div><small class="text-primary">Please mention expected date of completion</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <input type="text" id="Date_and_time_of_correction" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getdateFormat($showdata->Date_and_time_of_correction) }}" />
                                            <input type="date" name="Date_and_time_of_correction" class="hide-input"
                                                oninput="handleDateInput(this, 'Date_and_time_of_correction')" />
                                        </div>
                                    </div>

                                </div> --}}
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Closure Comments</label>
                                        <textarea class="summernote" name="Closure_Comments" id="summernote-16">{{ $showdata->Closure_Comments }}</textarea>
                                    </div>
                                </div> --}}


                                {{-- <div class="col-6">
                                    <div class="group-input">
                                        <label class="" for="Closure Comments">Closure Comments</label>
                                        <input type="text" name="Closure_Comments"
                                            value="{{ $showdata->Closure_Comments }}"
                                            {{ Helpers::disabledErrataFields($showdata->stage) }} />
                                    </div>
                                </div> --}}

                                {{-- <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="All Impacting Documents Corrected">
                                            All Impacting Documents Corrected <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..."
                                            name="All_Impacting_Documents_Corrected"
                                            {{ Helpers::disabledErrataFields($showdata->stage) }}>
                                            <option value="">--Select--</option>
                                            <option value="Yes" @if ($showdata->All_Impacting_Documents_Corrected == 'Yes') selected @endif>Yes
                                            </option>
                                            <option value="No" @if ($showdata->All_Impacting_Documents_Corrected == 'No') selected @endif>No
                                            </option>
                                        </select>
                                    </div>
                                </div> --}}

                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Remarks"> Remarks (If Any)</label>
                                        <textarea class="summernote" name="Remarks" id="summernote-16"
                                            {{ Helpers::disabledErrataFields($showdata->stage) }}>{{ $showdata->Remarks }}</textarea>
                                    </div>
                                </div> --}}

                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Closure Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Closure_Attachments">
                                                @if ($showdata->Closure_Attachments)
                                                    @foreach (json_decode($showdata->Closure_Attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i>
                                                            </a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input
                                                    {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}
                                                    type="file" id="Closure_Attachments" name="Closure_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'Closure_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Closure Attachments">Closure Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Closure_Attachments">
                                                @if ($showdata->Closure_Attachments)
                                                    @foreach (json_decode($showdata->Closure_Attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgba(255, 255, 255, 0);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Closure_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'Closure_Attachments')"
                                                    {{ Helpers::disabledErrataFields($showdata->stage) }}multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}




                                <div class="button-block">
                                    @if ($showdata->stage >= 8)
                                        <button type="submit" class="saveButton" disabled>Save</button>
                                    @else
                                        <button type="submit" class="saveButton">Save</button>
                                    @endif
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
                                        @if ($showdata->stage == 5)
                                            <label for="Date Due">Date Of Correction of document<span
                                                    class="text-danger">*</span></label>
                                        @else
                                            <label for="Date Due">Date Of Correction of document</label>
                                        @endif
                                        {{-- <label for="Date Due">Date Of Correction</label> --}}
                                        
                                        <div class="calenderauditee">
                                            <input type="text" id="Date_and_time_of_correction" readonly
                                                placeholder="DD-MMM-YYYY"
                                               {{ $showdata->stage == 1 || $showdata->stage == 2  || $showdata->stage == 3 || $showdata->stage == 4 || $showdata->stage == 6 || $showdata->stage == 7 ||$showdata->stage == 0 || $showdata->stage == 8  ? 'disabled' : '' }} {{ $showdata->stage == 5 && $initiatorRole ? '' : 'readonly' }}
                                                value="{{ Helpers::getdateFormat($showdata->Date_and_time_of_correction) }}" />
                                            <input type="date" name="Date_and_time_of_correction" class="hide-input"
                                               {{ $showdata->stage == 1 || $showdata->stage == 2  || $showdata->stage == 3 || $showdata->stage == 4 || $showdata->stage == 6 || $showdata->stage == 7 ||$showdata->stage == 0 || $showdata->stage == 8  ? 'disabled' : '' }} {{ $showdata->stage == 5 && $initiatorRole ? '' : 'readonly' }}
                                                oninput="handleDateInput(this, 'Date_and_time_of_correction')"  required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        @if ($showdata->stage == 5)
                                            <label for="All Impacting Documents Corrected">
                                                All Impacting Documents Corrected<span class="text-danger">*</span></label>
                                        @else
                                            <label for="All Impacting Documents Corrected">
                                                All Impacting Documents Corrected</label>
                                        @endif

                                        <select id="select-state" placeholder="Select..."  {{$showdata->stage == 5 ? 'required' : ''}} {{ $showdata->stage == 5 && $initiatorRole ? '' : 'disabled' }}
                                            {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}
                                            name="All_Impacting_Documents_Corrected"
                                            {{ Helpers::disabledErrataFields($showdata->stage) }}>
                                            <option value="">--Select--</option>
                                            <option value="Yes" @if ($showdata->All_Impacting_Documents_Corrected == 'Yes') selected @endif>Yes </option>
                                            <option value="No" @if ($showdata->All_Impacting_Documents_Corrected == 'No') selected @endif>No </option>
                                        </select>
                                         @if($showdata->stage != 5)
                                         <input type="hidden" name="All_Impacting_Documents_Corrected" value="{{old('All_Impacting_Documents_Corrected', $showdata->All_Impacting_Documents_Corrected)}}">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        @if ($showdata->stage == 5)
                                        <label class="mt-4" for="Remarks">Remarks <span class="text-danger">*</span></label>

                                        @else
                                        <label class="mt-4" for="Remarks"> Remarks</label>

                                        @endif
                                        <textarea class="summernote" name="Remarks" id="summernote-16"
                                        {{ $showdata->stage == 1 || $showdata->stage == 2  || $showdata->stage == 3 || $showdata->stage == 4 || $showdata->stage == 6 || $showdata->stage == 7 ||$showdata->stage == 0 || $showdata->stage == 8 ? 'readonly' : '' }}  {{ $showdata->stage == 5 && $initiatorRole ? '' : 'readonly' }}
                                         required>{{ $showdata->Remarks }}</textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Initiator Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Initiator_Attachments">
                                                @if ($showdata->Initiator_Attachments)
                                                    @foreach (json_decode($showdata->Initiator_Attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i>
                                                            </a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input
                                                    {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}
                                                    type="file" id="Initiator_Attachments"
                                                    name="Initiator_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'Initiator_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator_Attachments">Initiator Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Initiator_Attachments">
                                                @if ($showdata->Initiator_Attachments)
                                                    @foreach (json_decode($showdata->Initiator_Attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_Initiator_Attachments[]"
                                                                value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="Initiator_Attachments"
                                                    name="Initiator_Attachments[]"
                                                    {{ $showdata->stage == 1 || $showdata->stage == 2  || $showdata->stage == 3 || $showdata->stage == 4 || $showdata->stage == 6 || $showdata->stage == 7 ||$showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }} {{ $showdata->stage == 5 && $initiatorRole ? '' : 'disabled' }}
                                                    oninput="addMultipleFiles(this, 'Initiator_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_Initiator_Attachments"
                                    name="deleted_Initiator_Attachments" value="">

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
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById(
                                                        'deleted_Initiator_Attachments');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                        ',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // Adjust this to handle local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>





                                <div class="button-block">
                                    @if ($showdata->stage >= 8)
                                        <button type="submit" class="saveButton" disabled>Save</button>
                                    @else
                                        <button type="submit" class="saveButton">Save</button>
                                    @endif
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
                                        @if ($showdata->stage == 6)
                                            <label class="mt-4" for="HOD Comment">HOD final Review Comment<span
                                                    class="text-danger">*</span></label>
                                        @else
                                            <label class="mt-4" for="HOD Comment">HOD final Review Comment</label>
                                        @endif
                                        {{-- <label class="mt-4" for="HOD Comment">HOD Comment</label> --}}
                                        <textarea class="summernote" name="HOD_Comment1" id="summernote-16" required
                                        {{ $showdata->stage == 1 || $showdata->stage == 2  || $showdata->stage == 3 || $showdata->stage == 4 || $showdata->stage == 5 || $showdata->stage == 7 ||$showdata->stage == 0 || $showdata->stage == 8 ? 'readonly' : '' }} {{ $showdata->stage == 6 && $HodRole ? '' : 'readonly' }}>{{ $showdata->HOD_Comment1 }}</textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="HOD Attachments">HOD Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="HOD_Attachments1">
                                                @if ($showdata->HOD_Attachments1)
                                                    @foreach (json_decode($showdata->HOD_Attachments1) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i>
                                                            </a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input
                                                    {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}
                                                    type="file" id="HOD_Attachments1" name="HOD_Attachments1[]"
                                                    oninput="addMultipleFiles(this, 'HOD_Attachments1')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="HOD_Attachments1">HOD final Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="HOD_Attachments1">
                                                @if ($showdata->HOD_Attachments1)
                                                    @foreach (json_decode($showdata->HOD_Attachments1) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_HOD_Attachments1[]"
                                                                value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="HOD_Attachments1" name="HOD_Attachments1[]"
                                                {{ $showdata->stage == 1 || $showdata->stage == 2  || $showdata->stage == 3 || $showdata->stage == 4 || $showdata->stage == 5 || $showdata->stage == 7 ||$showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }} {{ $showdata->stage == 6 && $HodRole ? '' : 'disabled' }}
                                                    oninput="addMultipleFiles(this, 'HOD_Attachments1')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_HOD_Attachments1" name="deleted_HOD_Attachments1"
                                    value="">

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
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById(
                                                        'deleted_HOD_Attachments1');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                        ',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // Adjust this if needed for local previews
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>

                                <div class="button-block">
                                    @if ($showdata->stage >= 8)
                                        <button type="submit" class="saveButton" disabled>Save</button>
                                    @else
                                        <button type="submit" class="saveButton">Save</button>
                                    @endif
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
                                        <textarea class="summernote" name="QA_Comment1" id="summernote-16"
                                        {{ $showdata->stage == 1 || $showdata->stage == 2  || $showdata->stage == 3 || $showdata->stage == 4 || $showdata->stage == 5 || $showdata->stage == 7 ||$showdata->stage == 0 || $showdata->stage == 8 ? 'readonly' : '' }}>{{ $showdata->QA_Comment1 }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="QA Attachments">QA Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_Attachments1">
                                                @if ($showdata->QA_Attachments1)
                                                    @foreach (json_decode($showdata->QA_Attachments1) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i>
                                                            </a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input
                                                    {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}
                                                    type="file" id="QA_Attachments1" name="QA_Attachments1[]"
                                                    oninput="addMultipleFiles(this, 'QA_Attachments1')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>







                                <div class="button-block">
                                    @if ($showdata->stage >= 8)
                                        <button type="submit" class="saveButton" disabled>Save</button>
                                    @else
                                        <button type="submit" class="saveButton">Save</button>
                                    @endif
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
                            @php
                               $QAHeadrole =  ( Helpers::check_roles($showdata->division_id, 'ERRATA', 65) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 42) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 43) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 39) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 9) ||
                                    Helpers::check_roles($showdata->division_id, 'ERRATA', 18))
                                @endphp
                                <div class="col-12">
                                    <div class="group-input">
                                        @if ($showdata->stage == 7)
                                            <label class="mt-4" for="Closure Comments">Closure Comments<span
                                                    class="text-danger">*</span></label>
                                        @else
                                            <label class="mt-4" for="Closure Comments">Closure Comments</label>
                                        @endif
                                        {{-- <label class="mt-4" for="Closure Comments">Closure Comments</label> --}}
                                        <textarea class="summernote" name="Closure_Comments" id="summernote-16" required
                                        {{ $showdata->stage == 1 || $showdata->stage == 2  || $showdata->stage == 3 || $showdata->stage == 4 || $showdata->stage == 5 || $showdata->stage == 6 ||$showdata->stage == 0 || $showdata->stage == 8 ? 'readonly' : '' }} {{ $showdata->stage == 7 && $QAHeadrole ? '' : 'readonly' }}>{{ $showdata->Closure_Comments }}</textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Closure Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Closure_Attachments">
                                                @if ($showdata->Closure_Attachments)
                                                    @foreach (json_decode($showdata->Closure_Attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i>
                                                            </a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input
                                                    {{ $showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }}
                                                    type="file" id="Closure_Attachments" name="Closure_Attachments[]"
                                                    oninput="addMultipleFiles(this, 'Closure_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Closure_Attachments">Closure Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Closure_Attachments">
                                                @if ($showdata->Closure_Attachments)
                                                    @foreach (json_decode($showdata->Closure_Attachments) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file"
                                                                data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_Closure_Attachments[]"
                                                                value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="Closure_Attachments"
                                                    name="Closure_Attachments[]"
                                                    {{ $showdata->stage == 1 || $showdata->stage == 2  || $showdata->stage == 3 || $showdata->stage == 4 || $showdata->stage == 5 || $showdata->stage == 6 ||$showdata->stage == 0 || $showdata->stage == 8 ? 'disabled' : '' }} {{ $showdata->stage == 7 && $QAHeadrole ? '' : 'disabled' }}
                                                    oninput="addMultipleFiles(this, 'Closure_Attachments')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_Closure_Attachments" name="deleted_Closure_Attachments"
                                    value="">

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
                                                    // Remove hidden input associated with this file
                                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                                    if (hiddenInput) {
                                                        hiddenInput.remove();
                                                    }

                                                    // Add the file name to the deleted files list
                                                    const deletedFilesInput = document.getElementById(
                                                        'deleted_Closure_Attachments');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(
                                                        ',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });

                                    function addMultipleFiles(input, id) {
                                        const fileListContainer = document.getElementById(id);
                                        const files = input.files;

                                        for (let i = 0; i < files.length; i++) {
                                            const file = files[i];
                                            const fileName = file.name;
                                            const fileContainer = document.createElement('h6');
                                            fileContainer.classList.add('file-container', 'text-dark');
                                            fileContainer.style.backgroundColor = 'rgb(243, 242, 240)';

                                            const fileText = document.createElement('b');
                                            fileText.textContent = fileName;

                                            const viewLink = document.createElement('a');
                                            viewLink.href = '#'; // Adjust this to handle local previews if needed
                                            viewLink.target = '_blank';
                                            viewLink.innerHTML = '<i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>';

                                            const removeLink = document.createElement('a');
                                            removeLink.classList.add('remove-file');
                                            removeLink.dataset.fileName = fileName;
                                            removeLink.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>';
                                            removeLink.addEventListener('click', function() {
                                                fileContainer.style.display = 'none';
                                            });

                                            fileContainer.appendChild(fileText);
                                            fileContainer.appendChild(viewLink);
                                            fileContainer.appendChild(removeLink);

                                            fileListContainer.appendChild(fileContainer);
                                        }
                                    }
                                </script>

                                <div class="button-block">
                                    @if ($showdata->stage >= 8)
                                        <button type="submit" class="saveButton" disabled>Save</button>
                                    @else
                                        <button type="submit" class="saveButton">Save</button>
                                    @endif
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
                                <div class="sub-head">Submit</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Submitted by">Submit By</label>
                                        @if ($showdata->submitted_by)
                                        <div class="static">{{ $showdata->submitted_by ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Submitted on">Submit On</label>
                                        @if ($showdata->submitted_on)
                                        <div class="static">{{ $showdata->submitted_on ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Submitted on">Submit Comment</label>
                                        @if ($showdata->comment)
                                        <div class="static">{{ $showdata->comment ?? 'Not Applicable'}}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>

                                <div class="sub-head">Cancel</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Cancel BY">Cancel By</label>
                                        @if ($showdata->cancel_by)
                                        <div class="static">{{ $showdata->cancel_by ?? 'Not  Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Cancel On">Cancel On</label>
                                        @if ($showdata->cancel_on)
                                        <div class="static">{{ $showdata->cancel_on ?? 'Not Applicable'}}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Submitted on">Cancel Comment</label>
                                        @if ($showdata->cancel_comment)
                                        <div class="static">{{ $showdata->cancel_comment ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>

                                <div class="sub-head"> HOD Initial Review Complete </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Reviewed by">HOD Initial Review Complete By</label>
                                        @if ($showdata->review_completed_by)
                                        <div class="static">{{ $showdata->review_completed_by ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif 
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Approved on">HOD Initial Review Complete On</label>
                                        @if ($showdata->review_completed_on)
                                        <div class="static">{{ $showdata->review_completed_on ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Submitted on">HOD Initial Review Complete Comment
                                        </label>
                                        @if ($showdata->review_completed_comment)
                                        <div class="static">{{ $showdata->review_completed_comment ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif 

                                    </div>
                                </div>

                                <div class="sub-head">Review Complete</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Reviewed by">Review Complete By</label>
                                        @if ($showdata->Reviewed_by)
                                        <div class="static">{{ $showdata->Reviewed_by ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif 
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Approved on">Review Complete On</label>
                                        @if ($showdata->Reviewed_on)
                                        <div class="static">{{ $showdata->Reviewed_on ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Submitted on">Review Complete Comment</label>
                                        @if ($showdata->Reviewed_commemt)
                                        <div class="static">{{ $showdata->Reviewed_commemt ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif 
                                    </div>
                                </div>

                                <div class="sub-head">Approval Complete</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Reviewed by">Approval Complete By</label>
                                        @if ($showdata->approved_by)
                                        <div class="static">{{ $showdata->approved_by ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Approved on">Approval Complete On</label>
                                        @if ($showdata->approved_on)
                                        <div class="static">{{ $showdata->approved_on ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Submitted on">Approval Complete Comment</label>
                                        @if ($showdata->approved_comment)
                                        <div class="static">{{ $showdata->approved_comment ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif 
                                    </div>
                                </div>

                                <div class="sub-head">Correction Completed</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Correction Completed by">Correction Completed By
                                        </label>
                                        @if ($showdata->correction_completed_by)
                                        <div class="static">{{ $showdata->correction_completed_by ??  'Not Applicable'}}</div>
                                        @else
                                            Not Applicable
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Correction Completed on">Correction Completed On
                                        </label>
                                        @if ($showdata->correction_completed_on)
                                        <div class="static">{{ $showdata->correction_completed_on ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif 
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Submitted on">Correction Completed Comment</label>
                                        @if ($showdata->correction_completed_comment)
                                        <div class="static">{{ $showdata->correction_completed_comment ?? 'Not Applicable'}}</div>
                                        @else
                                            Not Applicable
                                        @endif 
                                    </div>
                                </div>

                                <div class="sub-head">HOD Review Complete</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="HOD Review Complete By">HOD Review Completed By</label>
                                        @if ($showdata->hod_review_complete_by)
                                        <div class="static">{{ $showdata->hod_review_complete_by ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="HOD Review Complete By on">HOD Review Completed On </label>
                                        @if ($showdata->hod_review_complete_on)
                                        <div class="static">{{ $showdata->hod_review_complete_on ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Submitted on">HOD Review Completed Comment
                                        </label>
                                        @if ($showdata->hod_review_complete_comment)
                                        <div class="static">{{$showdata->hod_review_complete_comment ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>

                                <div class="sub-head">QA/CQA Head Approval Complete</div>
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Head Aproval Completed by">QA/CQA Head Approval Completed By</label>
                                        @if ($showdata->qa_head_approval_completed_by)
                                        <div class="static">
                                        {{ $showdata->qa_head_approval_completed_by ?? 'Not Applicable'}}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA/CQA Head Approval Completed on">QA/CQA Head Approval Completed On</label>
                                         @if ($showdata->qa_head_approval_completed_on)
                                        <div class="static">{{  $showdata->qa_head_approval_completed_on ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Submitted on">QA/CQA Head Approval Completed Comment</label>
                                        @if ($showdata->qa_head_approval_completed_comment)
                                        <div class="static">{{ $showdata->qa_head_approval_completed_comment ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>

                                <div class="sub-head">Sent To Opened State</div> 
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Sent to Opened State BY">Sent To Opened State By
                                        </label>
                                        @if ($showdata->sent_to_open_state_by)
                                        <div class="static">{{ $showdata->sent_to_open_state_by ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>
        
                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="QA Head Aproval Completed on">Sent To Opened State On</label>
                                        @if ($showdata->sent_to_open_state_on)
                                            <div class="static">{{ $showdata->sent_to_open_state_on ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="group-input">
                                        <label for="Submitted on">Sent To Opened State Comment
                                        </label>
                                        @if ($showdata->sent_to_open_state_comment)
                                        <div class="static">{{ $showdata->sent_to_open_state_comment ?? 'Not Applicable' }}</div>
                                        @else
                                            Not Applicable
                                        @endif
                                    </div>
                                </div>

                                <div class="button-block">
                                    @if ($showdata->stage >= 8)
                                        {{-- <button type="submit" class="saveButton" disabled>Save</button> --}}
                                    @else
                                        <button type="submit" class="saveButton">Save</button>
                                    @endif
                                    {{-- <button type="button" class="backButton" onclick="previousStep()">Back</button> --}}
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>


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

    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('errata.stage', $errata_id) }}" method="POST">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">E-Signature</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
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
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="review-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('errata.stage', $errata_id) }}" method="POST">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">E-Signature</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input class="input_width" type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input class="input_width" type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input class="input_width" type="comment" name="comment">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="correction-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('errata.stage', $errata_id) }}" method="POST">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">E-Signature</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input class="input_width" type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input class="input_width" type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input class="input_width" type="comment" name="comment">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="hod-rewieve-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('errata.stage', $errata_id) }}" method="POST">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">E-Signature</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input class="input_width" type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input class="input_width" type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input class="input_width" type="comment" name="comment">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="qa-head-approval-model">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('errata.stage', $errata_id) }}" method="POST">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">E-Signature</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input class="input_width" type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input class="input_width" type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input class="input_width" type="comment" name="comment">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="cancel-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('errata.cancel', $errata_id) }}" method="POST">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">E-Signature</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
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
                            <label for="comment">Comment<span class="text-danger">*</span></label>
                            <input type="comment" name="comment" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="reject-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('errata.stagereject', $errata_id) }}" method="POST">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">E-Signature</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input class="input_width" type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input class="input_width" type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment<span class="text-danger">*</span></label>
                            <input class="input_width" type="comment" name="comment" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="more-info-required-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('errata.stagereject', $errata_id) }}" method="POST">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">E-Signature</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input class="input_width" type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input class="input_width" type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment<span class="text-danger">*</span></label>
                            <input class="input_width" type="comment" name="comment" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="more-inform-required-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('errata.stagereject', $errata_id) }}" method="POST">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">E-Signature</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input class="input_width" type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input class="input_width" type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment<span class="text-danger">*</span></label>
                            <input class="input_width" type="comment" name="comment" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="send-to-opened-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('errata.stagereject', $errata_id) }}" method="POST">
                    @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">E-Signature</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input class="input_width" type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input class="input_width" type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment<span class="text-danger">*</span></label>
                            <input class="input_width" type="comment" name="comment" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
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

        .input_width {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 11px;
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
            ele: '#reference_record, #notify_to, #reference'
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
