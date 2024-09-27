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

        <div class="form-field-head">
            <div class="division-bar">
                <strong>Site Division/Project</strong> :
                {{ Helpers::getDivisionName($data->division_id) }} / Root Cause Analysis
            </div>
        </div>
        @php
            $users = DB::table('users')->get();
        @endphp

        <!-- ======================================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    DATA FIELDS
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ======================================= -->
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
                            @endphp
                            {{-- <button class="button_theme1" onclick="window.print();return false;"
                                class="new-doc-btn">Print</button> --}}
                            <button class="button_theme1"> <a class="text-white"
                                    href="{{ url('rootAuditTrial', $data->id) }}">
                                    Audit Trail </a> </button>

                            @if ($data->stage == 1 && Helpers::check_roles($data->division_id, 'Root Cause Analysis', 3))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    Acknowledge
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                    Cancel
                                </button>
                            @elseif($data->stage == 2 && Helpers::check_roles($data->division_id, 'Root Cause Analysis', 4))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                    More Info Required
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    HOD Review Complete
                                </button>
                            @elseif($data->stage == 3 && Helpers::check_roles($data->division_id, 'Root Cause Analysis', 7))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                    More Info Required
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    QA/CQA Review Complete
                                </button>
                            @elseif($data->stage == 4 && Helpers::check_roles($data->division_id, 'Root Cause Analysis', 3))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                    More Info Required
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    Submit
                                </button>

                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                    Child

                                </button>
                            @elseif($data->stage == 5 && Helpers::check_roles($data->division_id, 'Root Cause Analysis', 4))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                    More Info Required

                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    HOD Final Review Complete

                                </button>
                            @elseif($data->stage == 6 && Helpers::check_roles($data->division_id, 'Root Cause Analysis', 7))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                    More Information
                                    Required
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    Final QA/CQA Review Complete
                                </button>
                            @elseif(
                                ($data->stage == 7 && Helpers::check_roles($data->division_id, 'Root Cause Analysis', 42)))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                    More Information
                                    Required
                                </button>
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    QAH/CQAH Closure
                                </button>
                            @endif
                            <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit
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
                                    <div class="active">Initial QA/CQA Review</div>
                                @else
                                    <div class="">Initial QA/CQA Review</div>
                                @endif


                                @if ($data->stage >= 4)
                                    <div class="active">Investigation in Progress </div>
                                @else
                                    <div class="">Investigation in Progress</div>
                                @endif
                                @if ($data->stage >= 5)
                                    <div class="active">HOD Final Review</div>
                                @else
                                    <div class="">HOD Final Review</div>
                                @endif


                                {{-- @if ($data->stage >= 3)
                                    <div class="active">Pending Group Review Discussion</div>
                                @else
                                    <div class="">Pending Group Review Discussion</div>
                                @endif

                                @if ($data->stage >= 4)
                                    <div class="active">Pending Group Review</div>
                                @else
                                    <div class="">Pending Group Review</div>
                                @endif --}}


                                @if ($data->stage >= 6)
                                    <div class="active">Final QA/CQA Review </div>
                                @else
                                    <div class="">Final QA/CQA Review </div>
                                @endif
                                @if ($data->stage >= 7)
                                    <div class="active">QAH/CQAH Final Review</div>
                                @else
                                    <div class="">QAH/CQAH Final Review</div>
                                @endif
                                @if ($data->stage >= 8)
                                    <div class="bg-danger">Closed - Done</div>
                                @else
                                    <div class="">Closed - Done</div>
                                @endif
                            </div>
                        @endif


                    </div>

                </div>
            </div>


            <div id="change-control-fields">

                <div class="container-fluid">

                    <!-- Tab links -->
                    <div class="cctab">
                        <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Investigation</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm9')">HOD Review</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Initial QA/CQA  Review</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Investigation & Root Cause</button>
                        {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Investigation & Root Cause</button> --}}
                   
                        <button class="cctablinks" onclick="openCity(event, 'CCForm10')">HOD Final Review</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm11')">QA Final Review</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm12')">QAH/CQAH Final Approval</button>




                        <!-- {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Environmental Monitoring</button> --}}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Lab Investigation Remark</button> --}}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm6')">QC Head/Designee Eval Comments</button> --}} -->
                        <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Activity Log</button>
                    </div>

                    <form action="{{ route('root_update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div id="step-form">

                            <div id="CCForm1" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="RLS Record Number"><b>Record Number</b></label>
                                                <input disabled type="text" name="record_number"
                                                    value="{{ Helpers::getDivisionName(session()->get('division')) }}/RCA/{{ date('Y') }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Division Code"><b>Site/Location Code</b></label>
                                                <input readonly type="text" name="division_code"
                                                    {{ $data->stage == 0 || $data->stage == 11 ? 'disabled' : '' }}
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}">
                                                {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator"><b>Initiator</b></label>
                                                <input type="hidden" name="initiator_id">
                                                {{-- <div class="static">{{ $data->initiator_name }} </div> --}}
                                                <input disabled type="text" value="{{ $data->initiator_name }} ">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input ">
                                                <label for="Date Due"><b>Date of Initiation</b></label>
                                                <input disabled type="text" value="{{ date('d-M-Y') }}"
                                                    name="intiation_date">
                                                <input type="hidden" value="{{ date('d-m-Y') }}" name="intiation_date">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Initiator Department </label>
                                                <select name="initiator_Group"
                                                    {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                    id="initiator_group">
                                                    {{-- <option value="0">-- Select --</option> --}}
                                                    <option value="">-- Select --</option>
                                                    <option value="CQA"
                                                        @if ($data->initiator_Group == 'CQA') selected @endif>Corporate Quality
                                                        Assurance</option>
                                                    <option value="QA"
                                                        @if ($data->initiator_Group == 'QA') selected @endif>Quality Assurance
                                                    </option>
                                                    <option value="QC"
                                                        @if ($data->initiator_Group == 'QC') selected @endif>Quality Control
                                                    </option>
                                                    <option value="QM"
                                                        @if ($data->initiator_Group == 'QM') selected @endif>Quality Control
                                                        (Microbiology department)
                                                    </option>
                                                    <option value="PG"
                                                        @if ($data->initiator_Group == 'PG') selected @endif>Production
                                                        General</option>
                                                    <option value="PL"
                                                        @if ($data->initiator_Group == 'PL') selected @endif>Production Liquid
                                                        Orals</option>
                                                    <option value="PT"
                                                        @if ($data->initiator_Group == 'PT') selected @endif>Production Tablet
                                                        and Powder</option>
                                                    <option value="PE"
                                                        @if ($data->initiator_Group == 'PE') selected @endif>Production
                                                        External (Ointment, Gels, Creams and Liquid)</option>
                                                    <option value="PC"
                                                        @if ($data->initiator_Group == 'PC') selected @endif>Production
                                                        Capsules</option>
                                                    <option value="PI"
                                                        @if ($data->initiator_Group == 'PI') selected @endif>Production
                                                        Injectable</option>
                                                    <option value="EN"
                                                        @if ($data->initiator_Group == 'EN') selected @endif>Engineering
                                                    </option>
                                                    <option value="HR"
                                                        @if ($data->initiator_Group == 'HR') selected @endif>Human Resource
                                                    </option>
                                                    <option value="ST"
                                                        @if ($data->initiator_Group == 'ST') selected @endif>Store</option>
                                                    <option value="IT"
                                                        @if ($data->initiator_Group == 'IT') selected @endif>Electronic Data
                                                        Processing
                                                    </option>
                                                    <option value="FD"
                                                        @if ($data->initiator_Group == 'FD') selected @endif>Formulation
                                                        Development
                                                    </option>
                                                    <option value="AL"
                                                        @if ($data->initiator_Group == 'AL') selected @endif>Analytical
                                                        research and Development Laboratory
                                                    </option>
                                                    <option value="PD"
                                                        @if ($data->initiator_Group == 'PD') selected @endif>Packaging
                                                        Development
                                                    </option>

                                                    <option value="PU"
                                                        @if ($data->initiator_Group == 'PU') selected @endif>Purchase
                                                        Department
                                                    </option>
                                                    <option value="DC"
                                                        @if ($data->initiator_Group == 'DC') selected @endif>Document Cell
                                                    </option>
                                                    <option value="RA"
                                                        @if ($data->initiator_Group == 'RA') selected @endif>Regulatory
                                                        Affairs
                                                    </option>
                                                    <option value="PV"
                                                        @if ($data->initiator_Group == 'PV') selected @endif>
                                                        Pharmacovigilance
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group Code">Initiator Department Code</label>
                                                <input readonly type="text"
                                                    name="initiator_group_code"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                    value="{{ $data->initiator_Group }}" id="initiator_group_code"
                                                    readonly>
                                                {{-- <div class="static"></div> --}}
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description<span
                                                        class="text-danger">*</span></label><span
                                                    id="rchars">255</span>
                                                characters remaining

                                                <input name="short_description" id="docname" type="text"
                                                    maxlength="255" required
                                                    {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                    value="{{ $data->short_description }}">
                                            </div>
                                            <p id="docnameError" style="color:red">**Short Description is required</p>

                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="severity-level">Severity Level</label>
                                                <span class="text-primary">Severity levels in a QMS record gauge issue
                                                    seriousness, guiding priority for corrective actions. Ranging from low
                                                    to
                                                    high, they ensure quality standards and mitigate critical risks.</span>
                                                <select {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                    name="severity_level">
                                                    <option value="0">-- Select --</option>
                                                    <option @if ($data->severity_level == 'minor') selected @endif
                                                        value="minor">
                                                        Minor</option>
                                                    <option @if ($data->severity_level == 'major') selected @endif
                                                        value="major">
                                                        Major</option>
                                                    <option @if ($data->severity_level == 'critical') selected @endif
                                                        value="critical">Critical</option>
                                                </select>
                                                {{-- <option value="minor">Minor</option>
                                                    <option value="major">Major</option>
                                                    <option value="critical">Critical</option>
                                                </select> --}}
                                            {{-- </div> --}}
                                        {{-- </div> --}} 
                                        {{--  <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="search">
                                                    Assigned To <span class="text-danger"></span>
                                                </label>
                                                <select id="select-state" placeholder="Select..." name="assign_to"
                                                    {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}  required>
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
                                        </div>  --}}



                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="select-state">Name of Responsible department Head <span
                                                        class="text-danger">*</span></label>
                                                <select id="select-state" placeholder="Select..." name="assign_to"
                                                    {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                    required>
                                                    <option value="">Select a value</option>
                                                    @foreach ($users as $key => $value)
                                                        <option value="{{ $value->id }}"
                                                            @if ($data->assign_to == $value->id) selected @endif>
                                                            {{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('assign_to')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="select-state">QA Reviewer <span
                                                        class="text-danger">*</span></label>
                                                <select id="select-state" placeholder="Select..." name="qa_reviewer"
                                                    {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                    required>
                                                    <option value="">Select a value</option>
                                                    @foreach ($users as $key => $value)
                                                        <option value="{{ $value->id }}"
                                                            @if ($data->qa_reviewer == $value->id) selected @endif>
                                                            {{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('qa_reviewer')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Due Date"> Due Date</label>
                                                <div><small class="text-primary">If revising Due Date, kindly mention
                                                        revision
                                                        reason in "Due Date Extension Justification" data field.</small>
                                                </div>
                                                <div class="calenderauditee">
                                                    <input disabled type="text" id="due_date" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ $data->due_date ? \Carbon\Carbon::parse($data->due_date)->format('d-M-Y') : '' }}" />
                                                    <input type="date" name="due_date"
                                                        {{ $data->stage == 0 || $data->stage > 1 ? 'disabled' : '' }}
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="{{ Helpers::getdateFormat($data->due_date) }}"
                                                        class="hide-input" oninput="handleDateInput(this, 'due_date')" />
                                                </div>
                                                {{-- <input type="text" id="due_date" name="due_date"
                                                    placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->due_date) }}"min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                                                <!-- <input type="date" name="due_date" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}} min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" --> --}}

                                            </div>
                                        </div>











                                        <!-- <div class="col-lg-6">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="group-input">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <label for="Initiator Group"><b>Initiator Group</b></label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <select name="initiatorGroup" {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                id="initiator-group">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="CQA"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'CQA') selected @endif>Corporate
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Quality Assurance</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="QAB"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'QAB') selected @endif>Quality
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Assurance Biopharma</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="CQC"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'CQC') selected @endif>Central
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Quality Control</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="CQC"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'CQC') selected @endif>Manufacturing
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="PSG"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'PSG') selected @endif>Plasma
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Sourcing Group</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="CS"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'CS') selected @endif>Central
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Stores</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="ITG"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'ITG') selected @endif>Information
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Technology Group</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="MM"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'MM') selected @endif>Molecular
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Medicine</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="CL"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'CL') selected @endif>Central
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Laboratory</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="TT"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'TT') selected @endif>Tech
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    team</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="QA"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'QA') selected @endif>Quality
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Assurance</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="QM"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'QM') selected @endif>Quality
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Management</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="IA"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'IA') selected @endif>IT
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Administration</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="ACC"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'ACC') selected @endif>Accounting
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="LOG"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'LOG') selected @endif>Logistics
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="SM"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'SM') selected @endif>Senior
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Management</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="BA"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @if ($data->initiatorGroup == 'BA') selected @endif>Business
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Administration</option>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </select>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="col-lg-6">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="group-input">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <label for="Initiator Group Code">Initiator Group Code</label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <input type="text" name="initiator_group_code"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                value="{{ $data->initiator_Group }}" disabled>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="col-12">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="group-input">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <label for="Short Description">Short Description <span
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    class="text-danger">*</span></label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div><small class="text-primary">Please mention brief summary</small></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <textarea name="short_description" {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->short_description }}</textarea>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div> -->














                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Initiated Through</label>
                                                <div><small class="text-primary">Please select related information</small>
                                                </div>
                                                <select {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                    name="initiated_through"
                                                    onchange="otherController(this.value, 'others', 'initiated_through_req')">
                                                    <option value="">-- select --</option>
                                                    <option @if ($data->initiated_through == 'recall') selected @endif
                                                        value="recall">
                                                        Recall</option>
                                                    <option @if ($data->initiated_through == 'return') selected @endif
                                                        value="return">
                                                        Return</option>
                                                    <option @if ($data->initiated_through == 'deviation') selected @endif
                                                        value="deviation">Deviation</option>
                                                    <option @if ($data->initiated_through == 'complaint') selected @endif
                                                        value="complaint">Complaint</option>
                                                    <option @if ($data->initiated_through == 'regulatory') selected @endif
                                                        value="regulatory">Regulatory</option>
                                                    <option @if ($data->initiated_through == 'lab-incident') selected @endif
                                                        value="lab-incident">Lab Incident</option>
                                                    <option @if ($data->initiated_through == 'improvement') selected @endif
                                                        value="improvement">Improvement</option>
                                                    <option @if ($data->initiated_through == 'others') selected @endif
                                                        value="others">
                                                        Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="initiated_through_req">
                                                <label for="If Other">Others<span
                                                        class="text-danger d-none">*</span></label>
                                                <textarea {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }} name="initiated_if_other">{{ $data->initiated_if_other }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Type">Type</label>
                                                <select name="Type" id="Type"
                                                    {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                    <option value="">-- Select --</option>

                                                    <option value="Process"
                                                        @if ($data->Type == 'Process') selected @endif>Process</option>
                                                    <option value="Document"
                                                        @if ($data->Type == 'Document') selected @endif>Document
                                                    </option>
                                                    <option value="Equipment"
                                                        @if ($data->Type == 'Equipment') selected @endif>Equipment
                                                    </option>
                                                    <option value="Instrument"
                                                        @if ($data->Type == 'Instrument') selected @endif>Instrument
                                                    </option>


                                                    <option value="Facilities"
                                                        @if ($data->Type == 'Facilities') selected @endif>Facilities
                                                    </option>
                                                    <option value="Other"
                                                        @if ($data->Type == 'Other') selected @endif>
                                                        Other</option>
                                                    <option value="Stability"
                                                        @if ($data->Type == 'Stability') selected @endif>Stability
                                                    </option>
                                                    <option value="Raw Material"
                                                        @if ($data->Type == 'Raw Material') selected @endif>Raw Material
                                                    </option>
                                                    <option value="Clinical Production"
                                                        @if ($data->Type == 'Clinical Production') selected @endif>Clinical
                                                        Production
                                                    </option>
                                                    <option value="Commercial Production"
                                                        @if ($data->Type == 'Commercial Production') selected @endif>Commercial
                                                        Production</option>
                                                    <option value="Labeling"
                                                        @if ($data->Type == 'Labeling') selected @endif>Labeling
                                                    </option>
                                                    <option value="Laboratory"
                                                        @if ($data->Type == 'Laboratory') selected @endif>Laboratory
                                                    </option>
                                                    <option value="Utilities"
                                                        @if ($data->Type == 'Utilities') selected @endif>Utilities
                                                    </option>
                                                    <option value="Validation"
                                                        @if ($data->Type == 'Validation') selected @endif>Validation
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        {{--  <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="priority_level">Priority Level</label>
                                                <div><small class="text-primary">Choose high if Immidiate actions are
                                                        </small></div>

                                                <select {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }} name="priority_level">

                                                    <option value="0">-- Select --</option>
                                                    <option @if ($data->priority_level == 'low') selected @endif
                                                    value="low">Low</option>
                                                    <option  @if ($data->priority_level == 'medium') selected @endif
                                                    value="medium">Medium</option>
                                                    <option @if ($data->priority_level == 'high') selected @endif
                                                    value="high">High</option>
                                                </select>
                                            </div>
                                        </div>  --}}
                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="investigators">Additional Investigators</label>
                                                <select  name="investigators" placeholder="Select Investigators"
                                                {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}  name="investigators" placeholder="Select Investigators"
                                                    data-search="false" data-silent-initial-value-set="true" id="investigators">
                                                    <option value="">Select Investigators</option>
                                                    <option @if ($data->investigators == '1') selected @endif value="1">Amit Guru</option>
                                                    <option @if ($data->investigators == '2') selected @endif value="2">Shaleen Mishra</option>
                                                    <option @if ($data->investigators == '3') selected @endif value="3">Madhulika Mishra</option>
                                                    <option @if ($data->investigators == '4') selected @endif value="4"> Patel</option>
                                                    <option @if ($data->investigators == '5') selected @endif value="5">Harsh Mishra</option>
                                                </select>
                                            </div>
                                        </div> --}}

                                        {{-- <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="department">Responsible Department</label>
                                                @php
                                                    $storedDepartments = $data->department; // Ensure this field name matches your database column
                                                    $selectedDepartments = explode(',', $storedDepartments);
                                                    // Split the comma-separated string into an array

                                                    // dd($selectedDepartments);
                                                @endphp

                                                <select multiple name="departments[]" placeholder="Select Department(s)"
                                                    data-search="false" data-silent-initial-value-set="true"
                                                    id="department"
                                                    {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                    <option value="Work Instruction"
                                                        @if (in_array('Work Instruction', $selectedDepartments)) selected @endif>Work Instruction
                                                    </option>
                                                    <option value="Quality Assurance"
                                                        @if (in_array('Quality Assurance', $selectedDepartments)) selected @endif>Quality
                                                        Assurance
                                                    </option>
                                                    <option value="Specifications"
                                                        @if (in_array('Specifications', $selectedDepartments)) selected @endif>Specifications
                                                    </option>
                                                    <option value="Production"
                                                        @if (in_array('Production', $selectedDepartments)) selected @endif>Production
                                                    </option>
                                                </select>
                                            </div>
                                        </div> --}}

                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="Responsible Department">Responsible Department</label>
                                                <select name="department"
                                                    {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                    id="department">
                                                    <option value="">-- Select --</option>
                                                    <option value="Corporate Quality Assurance"
                                                        @if ($data->department == 'Corporate Quality Assurance') selected @endif>Corporate
                                                        Quality Assurance</option>
                                                    <option value="Quality Assurance"
                                                        @if ($data->department == 'Quality Assurance') selected @endif>Quality
                                                        Assurance</option>
                                                    <option value="Quality Control"
                                                        @if ($data->department == 'Quality Control') selected @endif>Quality Control
                                                    </option>
                                                    <option value="Quality Control (Microbiology department)"
                                                        @if ($data->department == 'Quality Control (Microbiology department)') selected @endif>Quality Control
                                                        (Microbiology department)</option>
                                                    <option value="Production General"
                                                        @if ($data->department == 'Production General') selected @endif>Production
                                                        General</option>
                                                    <option value="Production Liquid Orals"
                                                        @if ($data->department == 'Production Liquid Orals') selected @endif>Production
                                                        Liquid Orals</option>
                                                    <option value="Production Tablet and Powder"
                                                        @if ($data->department == 'Production Tablet and Powder') selected @endif>Production
                                                        Tablet and Powder</option>
                                                    <option value="Production External (Ointment, Gels, Creams and Liquid)"
                                                        @if ($data->department == 'Production External (Ointment, Gels, Creams and Liquid)') selected @endif>Production
                                                        External (Ointment, Gels, Creams and Liquid)</option>
                                                    <option value="Production Capsules"
                                                        @if ($data->department == 'Production Capsules') selected @endif>Production
                                                        Capsules</option>
                                                    <option value="Production Injectable"
                                                        @if ($data->department == 'Production Injectable') selected @endif>Production
                                                        Injectable</option>
                                                    <option value="Engineering"
                                                        @if ($data->department == 'Engineering') selected @endif>Engineering
                                                    </option>
                                                    <option value="Human Resource"
                                                        @if ($data->department == 'Human Resource') selected @endif>Human Resource
                                                    </option>
                                                    <option value="Store"
                                                        @if ($data->department == 'Store') selected @endif>Store</option>
                                                    <option value="Electronic Data Processing"
                                                        @if ($data->department == 'Electronic Data Processing') selected @endif>Electronic Data
                                                        Processing</option>
                                                    <option value="Formulation Development"
                                                        @if ($data->department == 'Formulation Development') selected @endif>Formulation
                                                        Development</option>
                                                    <option value="Analytical Research and Development Laboratory"
                                                        @if ($data->department == 'Analytical Research and Development Laboratory') selected @endif>Analytical
                                                        Research and Development Laboratory</option>
                                                    <option value="Packaging Development"
                                                        @if ($data->department == 'Packaging Development') selected @endif>Packaging
                                                        Development</option>
                                                    <option value="Purchase Department"
                                                        @if ($data->department == 'Purchase Department') selected @endif>Purchase
                                                        Department</option>
                                                    <option value="Document Cell"
                                                        @if ($data->department == 'Document Cell') selected @endif>Document Cell
                                                    </option>
                                                    <option value="Regulatory Affairs"
                                                        @if ($data->department == 'Regulatory Affairs') selected @endif>Regulatory
                                                        Affairs</option>
                                                    <option value="Pharmacovigilance"
                                                        @if ($data->department == 'Pharmacovigilance') selected @endif>
                                                        Pharmacovigilance</option>

                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <div class="sub-head">Investigation details</div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="description">Description</label>

                                                <textarea name="description"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="comments">Comments</label>
                                                <textarea name="comments"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->comments }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Inv Attachments">Initial Attachment</label>
                                                <div>
                                                    <small class="text-primary">
                                                        Please Attach all relevant or supporting documents
                                                    </small>
                                                </div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="root_cause_initial_attachment">
                                                        @if ($data->root_cause_initial_attachment)
                                                            @foreach (json_decode($data->root_cause_initial_attachment) as $file)
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

                                                        <input type="file" id="myfile"
                                                            name="root_cause_initial_attachment[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'root_cause_initial_attachment')"
                                                            multiple>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-12">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="group-input">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <label for="severity-level">Sevrity Level</label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <select name="severity-level">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="0">-- Select --</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="minor">Minor</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="major">Major</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <option value="critical">Critical</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </select>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>  -->

                                        {{--  <div class="col-12">
                                <div class="group-input">
                                <label for="related_url">Related URL</label>
                            <input name="related_url" {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }} value="{{ $data->related_url }}">
                        </div>  --}}
                                    </div>

                                    <div class="button-block">
                                        <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                                class="text-white"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="CCForm5" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="objective">Objective</label>
                                            <textarea name="objective"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->objective }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="scope">Scope</label>
                                            <textarea name="scope"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->scope }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="problem_statement">Problem Statement</label>
                                            <textarea name="problem_statement_rca"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->problem_statement_rca }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="requirement">Background</label>
                                            <textarea name="requirement"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->requirement }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="immediate_action">Immediate Action</label>
                                            <textarea name="immediate_action"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->immediate_action }}</textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="investigation_team">Investigation Team</label>
                                            <select id="investigation_team" name="investigation_team"
                                                {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                class="form-control">
                                                <option value="">Select a member of the Investigation Team</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if ($data->investigation_team == $user->id) selected @endif>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('investigation_team')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="investigation_team">Investigation Team</label>
                                            <select id="investigation_team" name="investigation_team[]" multiple
                                                {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                <option value="">Select members of the Investigation Team</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" {{-- Check if the user is part of the selected investigation team --}}
                                                        {{ in_array($user->id, explode(',', $data->investigation_team ?? '')) ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('investigation_team')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="root-cause-methodology">Root Cause Methodology</label>
                                            @php
                                                $selectedMethodologies = explode(',', $data->root_cause_methodology);
                                            @endphp
                                            <select name="root_cause_methodology[]" multiple
                                                {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                id="root-cause-methodology">
                                                <option value="Why-Why Chart"
                                                    @if (in_array('Why-Why Chart', $selectedMethodologies)) selected @endif>Why-Why Chart
                                                </option>
                                                <option value="Failure Mode and Effect Analysis"
                                                    @if (in_array('Failure Mode and Effect Analysis', $selectedMethodologies)) selected @endif>Failure Mode and
                                                    Effect
                                                    Analysis</option>
                                                <option value="Fishbone or Ishikawa Diagram"
                                                    @if (in_array('Fishbone or Ishikawa Diagram', $selectedMethodologies)) selected @endif>Fishbone or
                                                    Ishikawa
                                                    Diagram</option>
                                                <option value="Is/Is Not Analysis"
                                                    @if (in_array('Is/Is Not Analysis', $selectedMethodologies)) selected @endif>Is/Is Not Analysis
                                                </option>
                                                <option value="Rootcauseothers"                                            

                                                    @if (in_array('Rootcauseothers', $selectedMethodologies)) selected @endif>Is/Is Not Analysis
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="root-cause-others"style="display:none;">
                                        <div class="group-input">
                                            <label for="root_cause_Others">Others</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it does not require completion</small></div>
                                            <textarea class="summernote" name="root_cause_Others" id="summernote-1">{{ $data->root_cause_Others}} </textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Inv Attachments"> Attachment</label>
                                            <div>
                                                <small class="text-primary">
                                                    Please Attach all relevant or supporting documents
                                                </small>
                                            </div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list"
                                                    id="investigation_attachment">
                                                    @if ($data->investigation_attachment)
                                                        @foreach (json_decode($data->investigation_attachment) as $file)
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

                                                    <input type="file" id="myfile"
                                                        name="investigation_attachment[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'investigation_attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="root_cause">
                                                Root Cause
                                                <button type="button"
                                                    onclick="add4Input_case('root-cause-first-table')"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>+</button>
                                            </label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="root-cause-first-table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:5%">Row #</th>
                                                            <th>Root Cause Category</th>
                                                            <th>Root Cause Sub-Category</th>
                                                            <th>Probability</th>
                                                            <th>Remarks</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($data->Root_Cause_Category))
                                                            @foreach (unserialize($data->Root_Cause_Category) as $key => $Root_Cause_Category)
                                                                <tr>
                                                                    <td><input disabled type="text"
                                                                            name="serial_number[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                                            value="{{ $key + 1 }}">
                                                                    </td>
                                                                    <td><input type="text"
                                                                            name="Root_Cause_Category[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                                            value="{{ unserialize($data->Root_Cause_Category)[$key] ? unserialize($data->Root_Cause_Category)[$key] : '' }}">
                                                                    </td>
                                                                    <td><input type="text"
                                                                            name="Root_Cause_Sub_Category[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                                            value="{{ unserialize($data->Root_Cause_Sub_Category)[$key] ? unserialize($data->Root_Cause_Sub_Category)[$key] : '' }}">
                                                                    </td>
                                                                    <td><input type="text"
                                                                            name="Probability[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                                            value="{{ unserialize($data->Probability)[$key] ? unserialize($data->Probability)[$key] : '' }}">
                                                                    </td>
                                                                    <td><input type="text"
                                                                            name="Remarks[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                                            value="{{ unserialize($data->Remarks)[$key] ?? null }}">
                                                                    </td>
                                                                    <td><button type="text" class="removeRowBtn"
                                                                            {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Remove</button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{--  <div class="col-12 sub-head"></div>  --}}
                                    {{-- <div class="col-12 mb-4" id="fmea-section" style="display:none;">

                                        <div class="group-input">
                                            <label for="agenda">
                                                Failure Mode and Effect Analysis<button type="button" name="agenda"
                                                    onclick="addRootCauseAnalysisRiskAssessment1('risk-assessment-risk-management')"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>+</button>
                                            </label>
                                            <div class="table-responsive">
                                             <table class="table table-bordered" style="width: 200%" id="risk-assessment-risk-management">
                                            <thead>
                                                {{-- <tr>
                                                    <th colspan="1"style="text-align:center;">Row #</th>
                                                    <th colspan="2"style="text-align:center;">Risk Identification</th>
                                                    <th colspan="1"style="text-align:center;">Risk Analysis</th>
                                                    <th colspan="4"style="text-align:center;">Risk Evaluation</th>
                                                    <th colspan="1"style="text-align:center;">Risk Control</th>
                                                    <th colspan="6"style="text-align:center;">Risk Evaluation</th>
                                                    <th colspan="2"style="text-align:center;"></th>
                                                </tr> --
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Activity</th>
                                                    <th>Possible Risk/Failure (Identified Risk)</th>
                                                    <th>Consequences of Risk/Potential Causes</th>
                                                    <th>Severity (S)</th>
                                                    <th>Probability (P)</th>
                                                    <th>Detection (D)</th>
                                                    <th>Risk Level (RPN)</th>
                                                    <th>Control Measures recommended/ Risk mitigation proposed</th>
                                                    <th>Severity (S)</th>
                                                    <th>Probability (P)</th>
                                                    <th>Detection (D)</th>
                                                    <th>Risk Level (RPN)</th>
                                                    <th>Category of Risk Level (Low, Medium and High)</th>
                                                    <th>Risk Acceptance (Y/N)</th>
                                                    <th>Traceability document number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td> <!-- Example Row Number -->
                                                    <td>Example Activity</td>
                                                    <td>Example Risk</td>
                                                    <td>Example Consequences</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>2</td>
                                                    <td>24</td>
                                                    <td>Example Control Measures</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>2</td>
                                                    <td>12</td>
                                                    <td>Medium</td>
                                                    <td>Y</td>
                                                    <td>Example Traceability Document Number</td> <!-- Added field -->
                                                    <td><button>Action</button></td> <!-- Added field -->
                                                </tr>
                                                <!-- You can replicate the <tr> block above to add more rows as needed -->
                                            </tbody>
                                        </table>
                                      </div>

                                        </div>
                                    </div> --}}
                                    <div class="col-12 mb-4" id="fmea-section" style="display:none;">
                                        <div class="group-input">
                                            <label for="agenda">
                                                Failure Mode and Effect Analysis
                                                <button type="button" name="agenda"
                                                    onclick="addRootCauseAnalysisRiskAssessment1('risk-assessment-risk-management')"
                                                    {{ $data->stage == 0 || $data->stage == 9 ? 'disabled' : '' }}>+</button>
                                            </label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" style="width: 200%"
                                                    id="risk-assessment-risk-management">
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
                                                        @if (!empty($data->risk_factor))
                                                            @foreach (unserialize($data->risk_factor) as $key => $riskFactor)
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td><input name="risk_factor[]" type="text"
                                                                            value="{{ $riskFactor }}"
                                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                    </td>
                                                                    <td><input name="problem_cause[]" type="text"
                                                                            value="{{ unserialize($data->problem_cause)[$key] ?? null }}"
                                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                    </td>
                                                                    <td><input name="existing_risk_control[]"
                                                                            type="text"
                                                                            value="{{ unserialize($data->existing_risk_control)[$key] ?? null }}"
                                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                    </td>
                                                                    <td>
                                                                        <select onchange="calculateInitialResult(this)"
                                                                            class="fieldR" name="initial_severity[]"
                                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                            <option value="">-- Select --</option>
                                                                            <option value="1"
                                                                                {{ (unserialize($data->initial_severity)[$key] ?? null) == 1 ? 'selected' : '' }}>
                                                                                1-Insignificant</option>
                                                                            <option value="2"
                                                                                {{ (unserialize($data->initial_severity)[$key] ?? null) == 2 ? 'selected' : '' }}>
                                                                                2-Minor</option>
                                                                            <option value="3"
                                                                                {{ (unserialize($data->initial_severity)[$key] ?? null) == 3 ? 'selected' : '' }}>
                                                                                3-Major</option>
                                                                            <option value="4"
                                                                                {{ (unserialize($data->initial_severity)[$key] ?? null) == 4 ? 'selected' : '' }}>
                                                                                4-Critical</option>
                                                                            <option value="5"
                                                                                {{ (unserialize($data->initial_severity)[$key] ?? null) == 5 ? 'selected' : '' }}>
                                                                                5-Catastrophic</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <select onchange="calculateInitialResult(this)"
                                                                            class="fieldP" name="initial_detectability[]"
                                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                            <option value="">-- Select --</option>
                                                                            <option value="1"
                                                                                {{ (unserialize($data->initial_detectability)[$key] ?? null) == 1 ? 'selected' : '' }}>
                                                                                1-Very rare</option>
                                                                            <option value="2"
                                                                                {{ (unserialize($data->initial_detectability)[$key] ?? null) == 2 ? 'selected' : '' }}>
                                                                                2-Unlikely</option>
                                                                            <option value="3"
                                                                                {{ (unserialize($data->initial_detectability)[$key] ?? null) == 3 ? 'selected' : '' }}>
                                                                                3-Possibly</option>
                                                                            <option value="4"
                                                                                {{ (unserialize($data->initial_detectability)[$key] ?? null) == 4 ? 'selected' : '' }}>
                                                                                4-Likely</option>
                                                                            <option value="5"
                                                                                {{ (unserialize($data->initial_detectability)[$key] ?? null) == 5 ? 'selected' : '' }}>
                                                                                5-Almost certain (every time)</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <select onchange="calculateInitialResult(this)"
                                                                            class="fieldN" name="initial_probability[]"
                                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                            <option value="">-- Select --</option>
                                                                            <option value="1"
                                                                                {{ (unserialize($data->initial_probability)[$key] ?? null) == 1 ? 'selected' : '' }}>
                                                                                1-Always detected</option>
                                                                            <option value="2"
                                                                                {{ (unserialize($data->initial_probability)[$key] ?? null) == 2 ? 'selected' : '' }}>
                                                                                2-Likely to detect</option>
                                                                            <option value="3"
                                                                                {{ (unserialize($data->initial_probability)[$key] ?? null) == 3 ? 'selected' : '' }}>
                                                                                3-Possible to detect</option>
                                                                            <option value="4"
                                                                                {{ (unserialize($data->initial_probability)[$key] ?? null) == 4 ? 'selected' : '' }}>
                                                                                4-Unlikely to detect</option>
                                                                            <option value="5"
                                                                                {{ (unserialize($data->initial_probability)[$key] ?? null) == 5 ? 'selected' : '' }}>
                                                                                5-Not detectable</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input name="initial_rpn[]" type="text"
                                                                            class='initial-rpn'
                                                                            value="{{ unserialize($data->initial_rpn)[$key] ?? null }}"
                                                                            readonly
                                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                    </td>
                                                                    <td><input name="risk_control_measure[]"
                                                                            type="text"
                                                                            value="{{ unserialize($data->risk_control_measure)[$key] ?? null }}"
                                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                    </td>
                                                                    <td>
                                                                        <select onchange="calculateResidualResult(this)"
                                                                            class="residual-fieldR"
                                                                            name="residual_severity[]"
                                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                            <option value="">-- Select --</option>
                                                                            <option value="1"
                                                                                {{ (unserialize($data->residual_severity)[$key] ?? null) == 1 ? 'selected' : '' }}>
                                                                                1-Insignificant</option>
                                                                            <option value="2"
                                                                                {{ (unserialize($data->residual_severity)[$key] ?? null) == 2 ? 'selected' : '' }}>
                                                                                2-Minor</option>
                                                                            <option value="3"
                                                                                {{ (unserialize($data->residual_severity)[$key] ?? null) == 3 ? 'selected' : '' }}>
                                                                                3-Major</option>
                                                                            <option value="4"
                                                                                {{ (unserialize($data->residual_severity)[$key] ?? null) == 4 ? 'selected' : '' }}>
                                                                                4-Critical</option>
                                                                            <option value="5"
                                                                                {{ (unserialize($data->residual_severity)[$key] ?? null) == 5 ? 'selected' : '' }}>
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
                                                                                {{ (unserialize($data->residual_probability)[$key] ?? null) == 1 ? 'selected' : '' }}>
                                                                                1-Very rare</option>
                                                                            <option value="2"
                                                                                {{ (unserialize($data->residual_probability)[$key] ?? null) == 2 ? 'selected' : '' }}>
                                                                                2-Unlikely</option>
                                                                            <option value="3"
                                                                                {{ (unserialize($data->residual_probability)[$key] ?? null) == 3 ? 'selected' : '' }}>
                                                                                3-Possibly</option>
                                                                            <option value="4"
                                                                                {{ (unserialize($data->residual_probability)[$key] ?? null) == 4 ? 'selected' : '' }}>
                                                                                4-Likely</option>
                                                                            <option value="5"
                                                                                {{ (unserialize($data->residual_probability)[$key] ?? null) == 5 ? 'selected' : '' }}>
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
                                                                                {{ (unserialize($data->residual_detectability)[$key] ?? null) == 1 ? 'selected' : '' }}>
                                                                                1-Always detected</option>
                                                                            <option value="2"
                                                                                {{ (unserialize($data->residual_detectability)[$key] ?? null) == 2 ? 'selected' : '' }}>
                                                                                2-Likely to detect</option>
                                                                            <option value="3"
                                                                                {{ (unserialize($data->residual_detectability)[$key] ?? null) == 3 ? 'selected' : '' }}>
                                                                                3-Possible to detect</option>
                                                                            <option value="4"
                                                                                {{ (unserialize($data->residual_detectability)[$key] ?? null) == 4 ? 'selected' : '' }}>
                                                                                4-Unlikely to detect</option>
                                                                            <option value="5"
                                                                                {{ (unserialize($data->residual_detectability)[$key] ?? null) == 5 ? 'selected' : '' }}>
                                                                                5-Not detectable</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input name="residual_rpn[]" type="text"
                                                                            class='residual-rpn'
                                                                            value="{{ unserialize($data->residual_rpn)[$key] ?? null }}"
                                                                            readonly></td>
                                                                    <td>
                                                                        <input name="risk_acceptance[]" readonly
                                                                            class="risk-acceptance"
                                                                            value="{{ unserialize($data->risk_acceptance)[$key] ?? '' }}"
                                                                            readonly
                                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                    </td>
                                                                    <td>
                                                                        <select name="risk_acceptance2[]"
                                                                            {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                                            <option value="">-- Select --</option>
                                                                            <option value="N"
                                                                                {{ (unserialize($data->risk_acceptance2)[$key] ?? null) == 'N' ? 'selected' : '' }}>
                                                                                N</option>
                                                                            <option value="Y"
                                                                                {{ (unserialize($data->risk_acceptance2)[$key] ?? null) == 'Y' ? 'selected' : '' }}>
                                                                                Y</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input name="mitigation_proposal[]" type="text"
                                                                            value="{{ unserialize($data->mitigation_proposal)[$key] ?? null }}"
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
                                    {{--  <div class="col-12 sub-head"></div>  --}}
                                    <div class="col-12" id="fishbone-section" style="display:none;">
                                        <div class="group-input">
                                            <label for="fishbone">
                                                Fishbone or Ishikawa Diagram
                                                <button type="button" name="agenda"
                                                    onclick="addFishBone('.top-field-group', '.bottom-field-group')"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>+</button>
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
                                                            @if (!empty($data->measurement))
                                                                @foreach (unserialize($data->measurement) as $key => $measure)
                                                                    <div><input type="text"
                                                                            value="{{ $measure }}"
                                                                            name="measurement[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                                    </div>
                                                                    <div><input type="text"
                                                                            value="{{ unserialize($data->materials)[$key] ? unserialize($data->materials)[$key] : '' }}"
                                                                            name="materials[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                                    </div>
                                                                    <div><input type="text"
                                                                            value="{{ unserialize($data->methods)[$key] ?? null }}"
                                                                            name="methods[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="mid"></div>
                                                    <div class="bottom-field-group">
                                                        <div class="grid-field fields bottom-field">
                                                            @if (!empty($data->environment))
                                                                @foreach (unserialize($data->environment) as $key => $measure)
                                                                    <div><input type="text"
                                                                            value="{{ $measure }}"
                                                                            name="environment[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                                    </div>
                                                                    <div><input type="text"
                                                                            value="{{ unserialize($data->manpower)[$key] ? unserialize($data->manpower)[$key] : '' }}"
                                                                            name="manpower[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                                    </div>
                                                                    <div><input type="text"
                                                                            value="{{ unserialize($data->machine)[$key] ? unserialize($data->machine)[$key] : '' }}"
                                                                            name="machine[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="grid-field field-name">
                                                        <div>Mother Environment</div>
                                                        <div>Man</div>
                                                        <div>Machine</div>
                                                    </div>
                                                </div>
                                                <div class="right-group">
                                                    <div class="field-name">
                                                        Problem Statement
                                                    </div>
                                                    <div class="field">
                                                        <textarea name="problem_statement"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->problem_statement }}</textarea>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-12" id="Inference" style="display:none;">
                                        <div class="group-input">
                                            <label for="Inference">Inference</label>
                                            <select {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                name="Inference">
                                                <option value="">-- select --</option>
                                                <option @if ($data->Inference == 'Measurement') selected @endif
                                                    value="Measurement">
                                                    Measurement</option>
                                                <option @if ($data->Inference == 'Materials') selected @endif
                                                    value="Materials">
                                                    Materials</option>
                                                <option @if ($data->Inference == 'Methods') selected @endif
                                                    value="Methods">Methods</option>
                                                <option @if ($data->Inference == 'Environment') selected @endif
                                                    value="Environment">Environment</option>
                                                <option @if ($data->Inference == 'Manpower') selected @endif
                                                    value="Manpower">Manpower</option>
                                                <option @if ($data->Inference == 'Machine') selected @endif
                                                    value="Machine">Machine</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                    <div class="col-12" id="HideInference" style="display:none;">
                                        <div class="group-input">
                                            <label for="Inference">
                                                Inference
                                                <button type="button"
                                                    onclick="addInference('Inference')"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>+</button>
                                            </label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="Inference">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:5%">Row #</th>
                                                            <th>Type</th>
                                                            <th>Remarks</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($data->inference_type) && !empty($data->inference_remarks))
                                                            @php
                                                                // Unserialize the arrays
                                                                $inference_types = unserialize($data->inference_type);
                                                                $inference_remarks = unserialize(
                                                                    $data->inference_remarks,
                                                                );
                                                            @endphp

                                                            @foreach ($inference_types as $key => $inference_type)
                                                                <tr>
                                                                    <td>
                                                                        <input disabled type="text"
                                                                            name="serial_number[]"
                                                                            value="{{ $key + 1 }}"
                                                                            {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                                    </td>
                                                                    <td>
                                                                        <select name="inference_type[]"
                                                                            {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                                            <option value="">-- Select --</option>
                                                                            <option value="Measurement"
                                                                                {{ $inference_type == 'Measurement' ? 'selected' : '' }}>
                                                                                Measurement</option>
                                                                            <option value="Materials"
                                                                                {{ $inference_type == 'Materials' ? 'selected' : '' }}>
                                                                                Materials</option>
                                                                            <option value="Methods"
                                                                                {{ $inference_type == 'Methods' ? 'selected' : '' }}>
                                                                                Methods</option>
                                                                            <option value="Environment"
                                                                                {{ $inference_type == 'Environment' ? 'selected' : '' }}>
                                                                                Environment</option>
                                                                            <option value="Manpower"
                                                                                {{ $inference_type == 'Manpower' ? 'selected' : '' }}>
                                                                                Manpower</option>
                                                                            <option value="Machine"
                                                                                {{ $inference_type == 'Machine' ? 'selected' : '' }}>
                                                                                Machine</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="inference_remarks[]"
                                                                            value="{{ $inference_remarks[$key] ?? '' }}"
                                                                            {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="removeRowBtn"
                                                                            {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Remove</button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        function addWhyField(containerClass, fieldName) {
                                            let container = document.querySelector('.' + containerClass);

                                            // Create the textarea
                                            let textarea = document.createElement('textarea');
                                            textarea.name = fieldName;

                                            // Create the remove button
                                            let removeButton = document.createElement('span');
                                            removeButton.innerText = 'Remove';
                                            removeButton.style.cursor = 'pointer';
                                            removeButton.style.color = 'red';
                                            removeButton.onclick = function() {
                                                removeWhyField(this);
                                            };

                                            // Create a wrapper for the textarea and the remove button
                                            let fieldWrapper = document.createElement('div');
                                            fieldWrapper.classList.add('why-field-wrapper');
                                            fieldWrapper.appendChild(textarea);
                                            fieldWrapper.appendChild(removeButton);

                                            // Append the new field wrapper to the container
                                            container.appendChild(fieldWrapper);
                                        }

                                        function removeWhyField(button) {
                                            let fieldWrapper = button.parentNode; // Get the wrapper div
                                            fieldWrapper.remove(); // Remove the wrapper div, which removes the textarea and the remove button
                                        }
                                    </script>
                                    {{--  <div class="col-12 sub-head"></div>  --}}
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
                                                            <th style="width:150px;">Problem Statement</th>
                                                            <td>
                                                                <textarea name="why_problem_statement">{{ $data->why_problem_statement }}</textarea>
                                                            </td>
                                                        </tr>

                                                        @foreach (range(1, 5) as $why_number)
                                                            <tr class="why-row">
                                                                <th style="width:150px; color: #393cd4;">
                                                                    Why {{ $why_number }}
                                                                    <span
                                                                        onclick="addWhyField('why_{{ $why_number }}_block', 'why_{{ $why_number }}[]')"
                                                                        {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>+</span>
                                                                </th>
                                                                <td>
                                                                    <div class="why_{{ $why_number }}_block">
                                                                        @if (!empty($data['why_' . $why_number]))
                                                                            @foreach (unserialize($data['why_' . $why_number]) as $key => $measure)
                                                                                <div class="why-field-wrapper">
                                                                                    <textarea name="why_{{ $why_number }}[]" {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $measure }}</textarea>
                                                                                    <span class="remove-field"
                                                                                        onclick="removeWhyField(this)"
                                                                                        style="cursor:pointer; color:red;">Remove</span>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        <tr style="background: #0080006b;">
                                                            <th style="width:150px;">Root Cause :</th>
                                                            <td>
                                                                <textarea name="why_root_cause"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->why_root_cause }}</textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 sub-head"></div>

                                    <div class="col-12" id="is-is-not-section" style="display:none;">
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
                                                                <textarea name="what_will_be" {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->what_will_be }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="what_will_not_be" {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->what_will_not_be }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="what_rationable"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}> {{ $data->what_rationable }}</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="background: #0039bd85">Where</th>
                                                            <td>
                                                                <textarea name="where_will_be"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}> {{ $data->where_will_be }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="where_will_not_be"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}> {{ $data->where_will_not_be }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="where_rationable"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}> {{ $data->where_rationable }}</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="background: #0039bd85">When</th>
                                                            <td>
                                                                <textarea name="when_will_be"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}> {{ $data->when_will_be }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="when_will_not_be"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->when_will_not_be }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="when_rationable"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}> {{ $data->when_rationable }}</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="background: #0039bd85">Why</th>
                                                            <td>
                                                                <textarea name="coverage_will_be"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}> {{ $data->coverage_will_be }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="coverage_will_not_be"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}> {{ $data->coverage_will_not_be }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="coverage_rationable"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}> {{ $data->coverage_rationable }}</textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th style="background: #0039bd85">Who</th>
                                                            <td>
                                                                <textarea name="who_will_be"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}> {{ $data->who_will_be }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="who_will_not_be"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}> {{ $data->who_will_not_be }}</textarea>
                                                            </td>
                                                            <td>
                                                                <textarea name="who_rationable"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}> {{ $data->who_rationable }}</textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 " id="root-cause-others"style="display:none;">
                                        <div class="group-input">
                                            <label for="root_cause_Others">Others</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if
                                                    it does not require completion</small></div>
                                            <textarea name="root_cause_Others"  >{{ $data->root_cause_Others }}</textarea>
                                        </div>
                                    </div> --}}
                                    


                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton"
                                        {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Save</button>
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
                                <!-- <div class="sub-head">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    CFT Feedback
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>  -->
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="comments">QA Review Comments</label>
                                            <textarea name="cft_comments_new"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->cft_comments_new }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="comments">QA Review Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="cft_attchament_new">
                                                    {{-- @if (!is_null($data->cft_attchament_new) && is_array(json_decode($data->cft_attchament_new))) --}}
                                                    @if ($data->cft_attchament_new)
                                                        @foreach (json_decode($data->cft_attchament_new) as $file)
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
                                                        {{-- @endif --}}
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile"
                                                        name="cft_attchament_new[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'cft_attchament_new')" multiple>
                                                </div>
                                            </div>
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


                        <div id="CCForm2" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">

                                    {{-- <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="investigation_tool">Investigation Tool</label>
                                            <textarea name="investigation_tool"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->investigation_tool }}</textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="root_cause">Root Cause</label>
                                            <textarea name="root_cause"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->root_cause }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="impact_risk_assessment">Impact / Risk Assessment</label>
                                            <textarea name="impact_risk_assessment"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->impact_risk_assessment }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="capa">CAPA</label>
                                            <textarea name="capa"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->capa }}</textarea>
                                        </div>
                                    </div>


                                    {{-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="root_cause_description">Root Cause Description</label>
                                            <textarea name="root_cause_description_rca"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->root_cause_description_rca }}</textarea>
                                        </div>
                                    </div> --}}
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="investigation_summary">Investigation Summary</label>
                                            <textarea name="investigation_summary_rca"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->investigation_summary_rca }}</textarea>
                                        </div>
                                    </div>

                                    {{--  <div class="col-lg-12">
                                                    <div class="group-input">
                                                        <label for="investigation_summary">Investigation Summary</label>
                                                        <textarea name="investigation_summary"></textarea>
                                                    </div>
                                                </div>
                                            </div>  --}}

                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="comments">Investigation Attachment
                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                        documents</small></div>
                                                <div class="file-attachment-field">
                                                    <div disabled class="file-attachment-list"
                                                        id="root_cause_initial_attachment_rca">
                                                        {{-- @if (!is_null($data->cft_attchament_new) && is_array(json_decode($data->cft_attchament_new))) --}}
                                                        @if ($data->root_cause_initial_attachment_rca)
                                                            @foreach (json_decode($data->root_cause_initial_attachment_rca) as $file)
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
                                                            {{-- @endif --}}
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile"
                                                            name="root_cause_initial_attachment_rca[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                            oninput="addMultipleFiles(this, 'root_cause_initial_attachment_rca')"
                                                            multiple>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>



                                </div>

                                <div class="button-block">
                                    <button type="submit" class="saveButton"
                                        {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">
                                            Exit </a> </button>
                                </div>
                            </div>
                        </div>


                        <div id="CCForm9" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <!-- <div class="sub-head">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    CFT Feedback
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>  -->
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="comments">HOD Review Comment </label>
                                            <textarea name="hod_comments"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->hod_final_comments }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="comments">HOD Review Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="hod_attachments">
                                                    {{-- @if (!is_null($data->cft_attchament_new) && is_array(json_decode($data->cft_attchament_new))) --}}
                                                    @if ($data->hod_attachments)
                                                        @foreach (json_decode($data->hod_attachments) as $file)
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
                                                        {{-- @endif --}}
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile"
                                                        name="hod_attachments[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'hod_attachments')" multiple>
                                                </div>
                                            </div>
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

                        <div id="CCForm10" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <!-- <div class="sub-head">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    CFT Feedback
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>  -->
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="comments">HOD Final Review Comments</label>
                                            <textarea name="hod_final_comments"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->hod_final_comments }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="comments">HOD Final Review Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="hod_final_attachments">
                                                    {{-- @if (!is_null($data->cft_attchament_new) && is_array(json_decode($data->cft_attchament_new))) --}}
                                                    @if ($data->hod_final_attachments)
                                                        @foreach (json_decode($data->hod_final_attachments) as $file)
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
                                                        {{-- @endif --}}
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile"
                                                        name="hod_final_attachments[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'hod_final_attachments')" multiple>
                                                </div>
                                            </div>
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
                        <div id="CCForm11" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <!-- <div class="sub-head">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            CFT Feedback
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>  -->
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="comments">QA Final Review Comments</label>
                                            <textarea name="qa_final_comments"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->qa_final_comments }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="comments">QA Final Review Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="qa_final_attachments">
                                                    {{-- @if (!is_null($data->cft_attchament_new) && is_array(json_decode($data->cft_attchament_new))) --}}
                                                    @if ($data->qa_final_attachments)
                                                        @foreach (json_decode($data->qa_final_attachments) as $file)
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
                                                        {{-- @endif --}}
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile"
                                                        name="qa_final_attachments[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'qa_final_attachments')" multiple>
                                                </div>
                                            </div>
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
                        <div id="CCForm12" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <!-- <div class="sub-head">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            CFT Feedback
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>  -->
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="comments">QAH/CQAH Final Approval Comment</label>
                                            <textarea name="qah_final_comments"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->qah_final_comments }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="comments">QAH/CQAH Final Approval Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="qah_final_attachments">
                                                    {{-- @if (!is_null($data->cft_attchament_new) && is_array(json_decode($data->cft_attchament_new))) --}}
                                                    @if ($data->qah_final_attachments)
                                                        @foreach (json_decode($data->qah_final_attachments) as $file)
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
                                                        {{-- @endif --}}
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile"
                                                        name="qah_final_attachments[]"{{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'qah_final_attachments')" multiple>
                                                </div>
                                            </div>
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


                        <div id="CCForm7" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="acknowledge_by">Acknowledge By</label>
                                            <div class="static">{{ $data->acknowledge_by }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="acknowledge_on">Acknowledge On</label>
                                            <div class="static">{{ $data->acknowledge_on }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="ack_comments"> Acknowledge Comment</label>
                                            <div class="static">{{ $data->ack_comments }}</div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Audit Mgr.more Info Reqd By">More Info Req.
                                                By</label>
                                            <div class="static">{{ $data->More_Info_ack_by }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More_Info_ack_on">More Info Req.
                                                On</label>
                                            <div class="static">{{ $data->More_Info_ack_on }}</div>
                                        </div>
                                    </div>


                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More_Info_ack_comment">Comments</label>
                                            <div class="static">{{ $data->More_Info_ack_comment }}</div>
                                        </div>
                                    </div> --}}

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="HOD_Review_Complete_By">HOD Review Completed By</label>
                                            <div class="static">{{ $data->HOD_Review_Complete_By }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="HOD_Review_Complete_On">HOD Review Completed On</label>
                                            <div class="static">{{ $data->HOD_Review_Complete_On }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments"> HOD Review Completed Comments</label>
                                            <div class="static">{{ $data->HOD_Review_Complete_Comment }}</div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More_Info_hrc_by">More Info Req.
                                                By</label>
                                            <div class="static">{{ $data->More_Info_hrc_by }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More_Info_hrc_on">More Info Req.
                                                On</label>
                                            <div class="static">{{ $data->More_Info_hrc_on }}</div>
                                        </div>
                                    </div>


                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More_Info_hrc_comment">Comments</label>
                                            <div class="static">{{ $data->More_Info_hrc_comment }}</div>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="QQQA_Review_Complete_By">QA/CQA Review Completed By</label>
                                            <div class="static">{{ $data->QQQA_Review_Complete_By }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="QQQA_Review_Complete_On">QA/CQA Review Completed On</label>
                                            <div class="static">{{ $data->QQQA_Review_Complete_On }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments"> QA/CQA Review Completed Comment</label>
                                            <div class="static">{{ $data->QAQQ_Review_Complete_comment }}</div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More_Info_qac_by">More Info Req.
                                                By</label>
                                            <div class="static">{{ $data->More_Info_qac_by }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More_Info_qac_on">More Info Req.
                                                On</label>
                                            <div class="static">{{ $data->More_Info_qac_on }}</div>
                                        </div>
                                    </div>


                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More_Info_qac_comment">Comments</label>
                                            <div class="static">{{ $data->More_Info_qac_comment }}</div>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="submitted_by">Submitted By</label>
                                            <div class="static">{{ $data->submitted_by }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="submitted_on">Submitted On</label>
                                            <div class="static">{{ $data->submitted_on }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments"> Submitted Comments</label>
                                            <div class="static">{{ $data->qa_comments_new }}</div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More_Info_sub_by">More Info Req.
                                                By</label>
                                            <div class="static">{{ $data->More_Info_sub_by }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More_Info_sub_on">More Info Req.
                                                On</label>
                                            <div class="static">{{ $data->More_Info_sub_on }}</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More_Info_sub_comment">Comments</label>
                                            <div class="static">{{ $data->More_Info_sub_comment }}</div>
                                        </div>
                                    </div> --}}

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="HOD_Final_Review_Complete_By">HOD Final Review Completed By</label>
                                            <div class="static">{{ $data->HOD_Final_Review_Complete_By }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="HOD_Final_Review_Complete_On">HOD Final Review Completed On</label>
                                            <div class="static">{{ $data->HOD_Final_Review_Complete_On }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments"> HOD Final Review Completed Comment</label>
                                            <div class="static">{{ $data->HOD_Final_Review_Complete_Comment }}</div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More_Info_hfr_by">More Info Req.
                                                By</label>
                                            <div class="static">{{ $data->More_Info_hfr_by }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More_Info_hfr_on">More Info Req.
                                                On</label>
                                            <div class="static">{{ $data->More_Info_hfr_on }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More_Info_hfr_comment">Comments</label>
                                            <div class="static">{{ $data->More_Info_hfr_comment }}</div>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Final_QA_Review_Complete_By">Final QA/CQA Review Completed
                                                By</label>
                                            <div class="static">{{ $data->Final_QA_Review_Complete_By }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Final_QA_Review_Complete_On">Final QA/CQA Review Completed
                                                On</label>
                                            <div class="static">{{ $data->Final_QA_Review_Complete_On }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments"> Final QA/CQA Review Completed Comments</label>
                                            <div class="static">{{ $data->Final_QA_Review_Complete_Comment }}</div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="qA_review_complete_by">More Info Req.
                                                By</label>
                                            <div class="static">{{ $data->qA_review_complete_by }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="qA_review_complete_on">More Info Req.
                                                On</label>
                                            <div class="static">{{ $data->qA_review_complete_on }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="qA_review_complete_comment">Comments</label>
                                            <div class="static">{{ $data->qA_review_complete_comment }}</div>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="evaluation_complete_by">QAH/CQAH Closure By</label>
                                            <div class="static">{{ $data->evaluation_complete_by }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="evaluation_complete_on">QAH/CQAH Closure On</label>
                                            <div class="static">{{ $data->evaluation_complete_on }}</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="evalution_Closure_comment"> QAH/CQAH Closure Comments</label>
                                            <div class="static">{{ $data->evalution_Closure_comment }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Cancelled By">Cancelled By</label>
                                            <div class="static">{{ $data->cancelled_by }}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Cancelled On">Cancelled On</label>
                                            <div class="static">{{ $data->cancelled_on }}</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="Comments"> Cancelled Comments</label>
                                            <div class="static">{{ $data->cancel_comment }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-block">
                                    {{-- <button type="submit" class="saveButton"
                                        {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Save</button> --}}
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    {{-- <button type="submit"
                                        {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>Submit</button> --}}
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">
                                            Exit </a> </button>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
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

                    <form action="{{ route('root_reject', $data->id) }}" method="POST">
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
                        {{-- <div class="modal-footer">
                                <button type="submit" data-bs-dismiss="modal">Submit</button>
                                <button>Close</button>
                            </div> --}}
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

                    <form action="{{ route('root_Cancel', $data->id) }}" method="POST">
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
                        <div class="modal-footer">
                            <button type="submit" data-bs-dismiss="modal">Submit</button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                            {{-- <button>Close</button> --}}
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
                    <form action="{{ route('R_C_A_root_child', $data->id) }}" method="POST">
                        @csrf
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="group-input">
                                <label for="capa-child">
                                    <input type="radio" name="revision" id="capa-child" value="capa-child">
                                    CAPA
                                </label>
                            </div>
                            <div class="group-input">
                                <label for="root-item">
                                    <input type="radio" name="revision" id="root-item" value="Action-Item">
                                    Action Item
                                </label>
                            </div>
                            {{-- <div class="group-input">
                            <label for="root-item">
                            <input type="radio" name="revision" id="root-item" value="effectiveness-check">
                                Effectiveness check
                            </label>
                        </div> --}}
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


        <div class="modal fade" id="signature-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">E-Signature</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('root_send_stage', $data->id) }}" method="POST">
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
                        <div class="modal-footer">
                            <button type="submit" data-bs-dismiss="modal">Submit</button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                            {{-- <button>Close</button> --}}
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
            $(document).on('click', '.removeRowBtn', function() {
                $(this).closest('tr').remove();
            })
        </script>
        <script>
            // ================================ FOUR INPUTS
            function add4Input_case(tableId) {
                var table = document.getElementById(tableId);
                var currentRowCount = table.rows.length;
                var newRow = table.insertRow(currentRowCount);

                newRow.setAttribute("id", "row" + currentRowCount);
                var cell1 = newRow.insertCell(0);
                cell1.innerHTML = currentRowCount;

                var cell2 = newRow.insertCell(1);
                cell2.innerHTML = "<input type='text' name='Root_Cause_Category[]'>";

                var cell3 = newRow.insertCell(2);
                cell3.innerHTML = "<input type='text'  name='Root_Cause_Sub_Category[]'>";

                var cell4 = newRow.insertCell(3);
                cell4.innerHTML = "<input type='text'  name='Probability[]''>";

                var cell5 = newRow.insertCell(4);
                cell5.innerHTML = "<input type='text'  name='Remarks[]'>";

                var cell6 = newRow.insertCell(5);
                cell6.innerHTML = "<button type='text' class='removeRowBtn' name='Action[]' readonly>Remove</button>";

                for (var i = 1; i < currentRowCount; i++) {
                    var row = table.rows[i];
                    row.cells[0].innerHTML = i;
                }
            }

            function addRootCauseAnalysisRiskAssessment1(tableId) {
                var table = document.getElementById(tableId);
                var currentRowCount = table.rows.length;
                var newRow = table.insertRow(currentRowCount);
                newRow.setAttribute("id", "row" + currentRowCount);
                var cell1 = newRow.insertCell(0);
                cell1.innerHTML = currentRowCount;

                var cell2 = newRow.insertCell(1);
                cell2.innerHTML = "<input name='risk_factor[]' type='text'>";

                var cell3 = newRow.insertCell(2);
                cell3.innerHTML = "<input name='risk_element[]' type='text'>";

                var cell4 = newRow.insertCell(3);
                cell4.innerHTML = "<input name='problem_cause[]' type='text'>";

                // var cell5 = newRow.insertCell(4);
                // cell5.innerHTML = "<input name='existing_risk_control[]' type='text'>";

                var cell5 = newRow.insertCell(4);
                cell5.innerHTML =
                    "<select onchange='calculateInitialResult(this)' class='fieldR' name='initial_severity[]'><option value=''>-- Select --</option><option value='1'>1-Insignificant</option><option value='2'>2-Minor</option><option value='3'>3-Major</option><option value='4'>4-Critical</option><option value='5'>5-Catastrophic</option></select>";
                    //  "<input name='initial_severity[]' type='text'>";

                var cell6 = newRow.insertCell(5);
                cell6.innerHTML =
                    "<select onchange='calculateInitialResult(this)' class='fieldP' name='initial_probability[]'><option value=''>-- Select --</option><option value='1'>1-Very rare</option><option value='2'>2-Unlikely</option><option value='3'>3-Possibly</option><option value='4'>4-Likely</option><option value='5'>5-Almost certain (every time)</option></select>";

                var cell7 = newRow.insertCell(6);
                cell7.innerHTML =
                    "<select onchange='calculateInitialResult(this)' class='fieldN' name='initial_detectability[]'><option value=''>-- Select --</option><option value='1'>1-Always detected</option><option value='2'>2-Likely to detect</option><option value='3'>3-Possible to detect</option><option value='4'>4-Unlikely to detect</option><option value='5'>5-Not detectable</option></select>";

                var cell8 = newRow.insertCell(7);
                cell8.innerHTML = "<input name='initial_rpn[]' type='text' class='initial-rpn' readonly>";

                // var cell10 = newRow.insertCell(9);
                // cell10.innerHTML =
                //     "<select name='risk_acceptance[]'><option value=''>-- Select --</option><option value='N'>N</option><option value='Y'>Y</option></select>";

                var cell9 = newRow.insertCell(8);
                cell9.innerHTML = "<input name='risk_control_measure[]' type='text'>";

                var cell10 = newRow.insertCell(9);
                cell10.innerHTML =
                    "<select onchange='calculateResidualResult(this)' class='residual-fieldR' name='residual_severity[]'><option value=''>-- Select --</option><option value='1'>1-Insignificant</option><option value='2'>2-Minor</option><option value='3'>3-Major</option><option value='4'>4-Critical</option><option value='5'>5-Catastrophic</option></select>";

                var cell11 = newRow.insertCell(10);
                cell11.innerHTML =
                    "<select onchange='calculateResidualResult(this)' class='residual-fieldP' name='residual_probability[]'><option value=''>-- Select --</option><option value='1'>1-Very rare</option><option value='2'>2-Unlikely</option><option value='3'>3-Possibly</option><option value='4'>4-Likely</option><option value='5'>5-Almost certain (every time)</option></select>";

                var cell12 = newRow.insertCell(11);
                cell12.innerHTML =
                    "<select onchange='calculateResidualResult(this)' class='residual-fieldN' name='residual_detectability[]'><option value=''>-- Select --</option><option value='1'>1-Always detected</option><option value='2'>2-Likely to detect</option><option value='3'>3-Possible to detect</option><option value='4'>4-Unlikely to detect</option><option value='5'>5-Not detectable</option></select>";

                var cell13 = newRow.insertCell(12);
                cell13.innerHTML = "<input name='residual_rpn[]' type='text' class='residual-rpn' readonly>";
                var cell14 = newRow.insertCell(13);
                cell14.innerHTML =
                    "<select name='risk_acceptance[]' class='risk-acceptance' readonly>" +
                    "<option value=''>-- Select --</option>" +
                    "<option value='Low'>Low</option>" +
                    "<option value='Medium'>Medium</option>" +
                    "<option value='High'>High</option>" +
                    "</select>";

                    var cell15 = newRow.insertCell(14);
                    cell15.innerHTML =
                        "<select name='risk_acceptance2[]'><option value=''>-- Select --</option><option value='N'>N</option><option value='Y'>Y</option></select>";

                    var cell16 = newRow.insertCell(15);
                    cell16.innerHTML = "<input name='mitigation_proposal[]' type='text'>";

                    var cell17 = newRow.insertCell(16);
                    cell17.innerHTML = "<button type='text' class='removeRowBtn' name='Action[]' readonly>Remove</button>";

                for (var i = 1; i < currentRowCount; i++) {
                    var row = table.rows[i];
                    row.cells[0].innerHTML = i;
                }
            }

            function addInference(tableId) {
                var table = document.getElementById(tableId);
                var currentRowCount = table.rows.length;
                var newRow = table.insertRow(currentRowCount);

                newRow.setAttribute("id", "row" + currentRowCount);
                var cell1 = newRow.insertCell(0);
                cell1.innerHTML = currentRowCount;

                var cell2 = newRow.insertCell(1);
                cell2.innerHTML =
                    "<select  name='inference_type[]'><option value=''>-- Select --</option><option value='Measurement'>Measurement</option><option value='Materials'>Materials</option><option value='Methods'>Methods</option><option value='Environment'>Environment</option><option value='Manpower'>Manpower</option><option value='Machine'>Machine</option></select>";

                var cell3 = newRow.insertCell(2);
                cell3.innerHTML = "<input type='text'  name='inference_remarks[]'>";

                var cell4 = newRow.insertCell(3);
                cell4.innerHTML = "<button type='text' class='removeRowBtn' name='Action[]' readonly>Remove</button>";

                for (var i = 1; i < currentRowCount; i++) {
                    var row = table.rows[i];
                    row.cells[0].innerHTML = i;
                }
            }
        </script>
        <script>
            VirtualSelect.init({
                ele: '#investigators, #root-cause-methodology,#investigation_team'
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
            VirtualSelect.init({
                ele: '#departments, #team_members, #training-require, #impacted_objects'
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
            function calculateInitialResult(selectElement) {
                let row = selectElement.closest('tr');
                let R = parseFloat(row.querySelector('.fieldR').value) || 0;
                let P = parseFloat(row.querySelector('.fieldP').value) || 0;
                let N = parseFloat(row.querySelector('.fieldN').value) || 0;
                let result = R * P * N;
                row.querySelector('.initial-rpn').value = result;
            }
        </script>

        <script>
            function calculateResidualResult(selectElement) {
                let row = selectElement.closest('tr');
                let R = parseFloat(row.querySelector('.residual-fieldR').value) || 0;
                let P = parseFloat(row.querySelector('.residual-fieldP').value) || 0;
                let N = parseFloat(row.querySelector('.residual-fieldN').value) || 0;
                let result = R * P * N;
                row.querySelector('.residual-rpn').value = result;
            }
        </script>
        <script>
            document.getElementById('initiator_group').addEventListener('change', function() {
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

        <script>
            document.getElementById('initiator_group').addEventListener('change', function() {
                var selectedValue = this.value;
                document.getElementById('initiator_group_code').value = selectedValue;
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
            var maxLength = 255;
            $('#docname').keyup(function() {
                var textlen = maxLength - $(this).val().length;
                $('#rchars').text(textlen);
            });
        </script>


        {{--  <script>
        $(document).ready(function() {
            $('#root-cause-methodology').on('change', function() {
                var selectedValues = $(this).val();
                $('#why-why-chart-section').hide();
                $('#fmea-section').hide();
                $('#fishbone-section').hide();
                $('#is-is-not-section').hide();

                if (selectedValues.includes('Why-Why Chart')) {
                    $('#why-why-chart-section').show();
                }
                if (selectedValues.includes('Failure Mode and Effect Analysis')) {
                    $('#fmea-section').show();
                }
                if (selectedValues.includes('Fishbone or Ishikawa Diagram')) {
                    $('#fishbone-section').show();
                }
                if (selectedValues.includes('Is/Is Not Analysis')) {
                    $('#is-is-not-section').show();
                }
            });
        });
    </script>    --}}


        <script>
            $(document).ready(function() {
                $('#root-cause-methodology').on('change', function() {
                    var selectedValues = $(this).val() || [];

                    // Hide all sections initially
                    $('#why-why-chart-section').hide();
                    $('#fmea-section').hide();
                    $('#fishbone-section').hide();
                    $('#HideInference').hide();
                    $('#is-is-not-section').hide();
                    $('#root-cause-others').hide();


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
                            $('#HideInference').show();
                        }
                        if (value === 'Is/Is Not Analysis') {
                            $('#is-is-not-section').show();
                        }
                        if (selectedValues.includes('Rootcauseothers')) {
                            $('#root-cause-others').show();
                         }
                    });
                });

                // Trigger the change event on page load to show the correct sections based on initial values
                $('#root-cause-methodology').trigger('change');
            });
        </script>
    @endsection
 <script>
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

        
        </script>
