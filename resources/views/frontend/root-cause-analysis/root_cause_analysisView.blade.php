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

    <style>
        
        /*Main Table Styling */
        #isPasted {
            width: 690px !important;
            border-collapse: collapse;
            table-layout: fixed;
        }

        /* First column adjusts to its content */
        #isPasted td:first-child,
        #isPasted th:first-child {
            white-space: nowrap; 
            width: 1%;
            vertical-align: top;
        }

        /* Second column takes remaining space */
        #isPasted td:last-child,
        #isPasted th:last-child {
            width: auto;
            vertical-align: top;

        }

        /* Common Table Cell Styling */
        #isPasted th,
        #isPasted td {
            border: 1px solid #000 !important;
            padding: 8px;
            text-align: left;
            max-width: 500px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Paragraph Styling Inside Table Cells */
        #isPasted td > p {
            text-align: justify;
            text-justify: inter-word;
            margin: 0;
            max-width: 700px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        #isPasted td > p span {
            display: inline-block;
            width: 650px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        #isPasted img {
            max-width: 500px !important;
            height: 100%;
            display: block; /* Remove extra space below the image */
            margin: 5px auto; /* Add spacing and center align */
        }

        /* If you want larger images */
        #isPasted td img {
            max-width: 400px !important; /* Adjust this to your preferred maximum width */
            height: 300px;
            margin: 5px auto;
        }

        .table-containers {
            width: 690px;
            overflow-x: fixed; /* Enable horsizontal scrolling */
        }

    
        #isPasted table {
            width: 100% !important;
            border-collapse: collapse;
            table-layout: fixed;
        }


        #isPasted table th,
        #isPasted table td {
            border: 1px solid #000 !important;
            padding: 8px;
            text-align: left;
            max-width: 500px;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }


        #isPasted table img {
            max-width: 100% !important;
            height: auto;
            display: block;
            margin: 5px auto;
        }

        .note-editable table {
            border-collapse: collapse !important;
            width: 100%;
        }

        .note-editable th,
        .note-editable td {
            border: 1px solid black !important;
            padding: 8px;
            text-align: left;
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
            let measurementInput = document.createElement('textarea')
            measurementInput.setAttribute('type', 'text')
            measurementInput.setAttribute('name', 'measurement[]')
            measurement.append(measurementInput)
            topField.append(measurement)

            let materials = document.createElement('div')
            let materialsInput = document.createElement('textarea')
            materialsInput.setAttribute('type', 'text')
            materialsInput.setAttribute('name', 'materials[]')
            materials.append(materialsInput)
            topField.append(materials)

            let methods = document.createElement('div')
            let methodsInput = document.createElement('textarea')
            methodsInput.setAttribute('type', 'text')
            methodsInput.setAttribute('name', 'methods[]')
            methods.append(methodsInput)
            topField.append(methods)

            topBlock.prepend(topField)

            let bottomField = document.createElement('div')
            bottomField.className = 'grid-field fields bottom-field'

            let environment = document.createElement('div')
            let environmentInput = document.createElement('textarea')
            environmentInput.setAttribute('type', 'text')
            environmentInput.setAttribute('name', 'environment[]')
            environment.append(environmentInput)
            bottomField.append(environment)

            let manpower = document.createElement('div')
            let manpowerInput = document.createElement('textarea')
            manpowerInput.setAttribute('type', 'text')
            manpowerInput.setAttribute('name', 'manpower[]')
            manpower.append(manpowerInput)
            bottomField.append(manpower)

            let machine = document.createElement('div')
            let machineInput = document.createElement('textarea')
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

    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }

        .sub-main-head {
            display: flex;
            justify-content: space-evenly;
        }

        .Activity-type {
            margin-bottom: 7px;
        }

        /* .sub-head {
                    margin-left: 280px;
                    margin-right: 280px;
                    color: #4274da;
                    border-bottom: 2px solid #4274da;
                    padding-bottom: 5px;
                    margin-bottom: 20px;
                    font-weight: bold;
                    font-size: 1.2rem;

                } */
        .launch_extension {
            background: #4274da;
            color: white;
            border: 0;
            padding: 4px 15px;
            border: 1px solid #4274da;
            transition: all 0.3s linear;
        }

        .main_head_modal li {
            margin-bottom: 10px;
        }

        .extension_modal_signature {
            display: block;
            width: 100%;
            border: 1px solid #837f7f;
            border-radius: 5px;
        }

        .main_head_modal {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .create-entity {
            background: #323c50;
            padding: 10px 15px;
            color: white;
            margin-bottom: 20px;

        }

        .bottom-buttons {
            display: flex;
            justify-content: flex-end;
            margin-right: 300px;
            margin-top: 50px;
            gap: 20px;
        }

        .text-danger {
            margin-top: -22px;
            padding: 4px;
            margin-bottom: 3px;
        }

        /* .saveButton:disabled{
                        background: black!important;
                        border:  black!important;

                    } */

        .main-danger-block {
            display: flex;
        }

        .swal-modal {
            scale: 0.7 !important;
        }

        .swal-icon {
            scale: 0.8 !important;
        }
    </style>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if (Session::has('swal'))
        <script>
            swal("{{ Session::get('swal')['title'] }}", "{{ Session::get('swal')['message'] }}",
                "{{ Session::get('swal')['type'] }}")
        </script>
    @endif
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

                            @elseif($data->stage == 3 && (Helpers::check_roles($data->division_id, 'Root Cause Analysis', 7) || Helpers::check_roles($data->division_id, 'Root Cause Analysis', 66)))
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
                        @elseif($data->stage == 6 && ( Helpers::check_roles($data->division_id, 'Root Cause Analysis', 7) || Helpers::check_roles($data->division_id, 'Root Cause Analysis', 66)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information
                                Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Final QA/CQA Review Complete
                            </button>
                        @elseif(
                            ($data->stage == 7 && (Helpers::check_roles($data->division_id, 'Root Cause Analysis', 42)|| Helpers::check_roles($data->division_id,'Root Cause Analysis',66))))
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
                                <div class="active">QAH/CQAH Final Approval</div>
                            @else
                                <div class="">QAH/CQAH Final Approval</div>
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
                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Investigation</button> --}}
                    <button class="cctablinks" onclick="openCity(event, 'CCForm9')">HOD Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Initial QA/CQA  Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Investigation & Root Cause</button>
                    {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Investigation & Root Cause</button> --}}

                    <button class="cctablinks" onclick="openCity(event, 'CCForm10')">HOD Final Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm11')">QA/CQA Final Review</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm12')">QAH/CQAH /Designee Final Approval</button>
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
                                                value="{{ Helpers::getDivisionName($data->division_id) }}/RCA/{{ date('Y') }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}">
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
                                            <label for="Initiator"><b>Initiator Department</b></label>
                                            <input disabled type="text" name="initiator_Group" id="initiator_group"
                                                value="{{ Helpers::getUsersDepartmentName(Auth::user()->departmentid) }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Initiation Group Code">Initiation Department Code</label>
                                            <input type="text" name="initiator_group_code"
                                                value="{{ $data->initiator_group_code }}" id="initiator_group_code"
                                                readonly>
                                        
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
                                                {{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}
                                                value="{{ $data->short_description }}">
                                        </div>
                                        <p id="docnameError" style="color:red">**Short Description is required</p>

                                    </div>
                                   <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="select-state">Name of Responsible department Head <span
                                                    class="text-danger">*</span></label>
                                            <select id="select-state" placeholder="Select..." name="assign_to"
                                                {{ in_array($data->stage,[0,2,3,4,5,6,7,8]) ? "disabled" : "" }}
                                                required>
                                                <option value="">Select a value</option>
                                                @foreach ($users as $key => $value)
                                                    <option value="{{ $value->id }}"
                                                        {{old('assign_to', $data->assign_to) == $value->id ? 'selected' : '' }}>
                                                        {{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @if(in_array($data->stage, [0,2,3,4,5,6,7,8]))
                                              <input type="hidden" name="assign_to" value="{{old('assign_to', $data->assign_to)}}">
                                            @endif  

                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="select-state">QA Reviewer <span
                                                    class="text-danger">*</span></label>
                                            <select id="select-state" placeholder="Select..." name="qa_reviewer"
                                            {{ in_array($data->stage,[0,2,3,4,5,6,7,8]) ? "disabled" : "" }}
                                                required>
                                                <option value="">Select a value</option>
                                                @foreach ($users as $key => $value)
                                                    <option value="{{ $value->id }}"
                                                        {{old('qa_reviewer', $data->qa_reviewer) == $value->id ? 'selected' : '' }}>
                                                        {{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                
                                            @if(in_array($data->stage, [0,2,3,4,5,6,7,8]))
                                              <input type="hidden" name="qa_reviewer" value="{{old('qa_reviewer', $data->qa_reviewer)}}">
                                            @endif  
                                        </div>
                                    </div>


                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Audit Schedule Start Date">Due Date <span class="text-danger">*</span></label>
                                             <div class="calenderauditee">
                                                <input type="text"  id="due_dateq"  readonly placeholder="DD-MM-YYYY" value="{{ Helpers::getdateFormat($data->due_date) }}"
                                                {{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "disabled" : "" }} required/>
                                                <input type="date" id="due_dateq" name="due_date"min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"{{ $data->stage !=1? 'disabled' : '' }} value="{{ $data->due_date }}" class="hide-input"
                                                oninput="handleDateInput(this, 'due_dateq');checkDate('due_dateq')"/>
                                            </div>
                                        </div>
                                        @error('due_date')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


                                   

                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Initiator Group">Initiated Through <span class="text-danger">*</span></label>
                                            <div>
                                                <small class="text-primary">Please select related information</small>
                                            </div>
                                            <select name="initiated_through"
                                            id="initiated_through" {{ in_array($data->stage,[0,2,3,4,5,6,7,8]) ? "disabled" : "" }}
                                                onchange="toggleOtherField()" 
                                                {{$data->stage==1 ? 'required':''}} >
                                                <option value="">-- select --</option>
                                                <option value="recall" {{old('initiated_through', $data->initiated_through) == 'recall' ? 'selected' : '' }}>Recall</option>
                                                <option value="return" {{old('initiated_through', $data->initiated_through) == 'return' ? 'selected' : '' }}>Return</option>
                                                <option value="deviation" {{old('initiated_through', $data->initiated_through) == 'deviation' ? 'selected' : '' }}>Deviation</option>
                                                <option value="complaint" {{old('initiated_through', $data->initiated_through) == 'complaint' ? 'selected' : '' }}>Complaint</option>
                                                <option value="regulatory" {{old('initiated_through', $data->initiated_through) == 'regulatory' ? 'selected' : '' }}>Regulatory</option>
                                                <option value="lab-incident" {{old('initiated_through', $data->initiated_through) == 'lab-incident' ? 'selected' : '' }}>Lab Incident</option>
                                                <option value="improvement" {{old('initiated_through', $data->initiated_through) == 'improvement' ? 'selected' : '' }}>Improvement</option>
                                                <option value="others" {{old('initiated_through', $data->initiated_through) == 'others' ? 'selected' : '' }}>Others</option>
                                            </select>

                                            @if(in_array($data->stage, [0,2,3,4,5,6,7,8]))
                                              <input type="hidden" name="initiated_through" value="{{old('initiated_through', $data->initiated_through)}}">
                                            @endif  
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="group-input" id="initiated_through_req" style="display: none;">
                                            <label for="If Other">Others <span class="text-danger">*</span></label>
                                            <textarea {{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }} name="initiated_if_other">{{ $data->initiated_if_other }}</textarea>
                                        </div>
                                    </div>

                                    <script>
                                        function toggleOtherField() {
                                            var selectBox = document.getElementById("initiated_through");
                                            var otherField = document.getElementById("initiated_through_req");

                                            if (selectBox.value === "others") {
                                                otherField.style.display = "block";
                                            } else {
                                                otherField.style.display = "none";
                                            }
                                        }

                                        // Call the function on page load to check the initial state
                                        window.onload = function() {
                                            toggleOtherField();
                                        };
                                    </script>

                                

                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="Responsible Department">Responsible Department <span class="text-danger">*</span></label>
                                            <select name="department" id="department"
                                              {{ in_array($data->stage,[0,2,3,4,5,6,7,8]) ? "disabled" : "" }}
                                                 {{$data->stage==1 ? 'required':''}}>
                                                <option value="">-- Select --</option>
                                                <option value="Corporate Quality Assurance" {{old('department', $data->department) == 'Corporate Quality Assurance' ? 'selected' : '' }}>Corporate Quality Assurance</option>
                                                <option value="Quality Assurance" {{old('department', $data->department) == 'Quality Assurance' ? 'selected' : '' }}>Quality Assurance</option>
                                                <option value="Quality Control" {{old('department', $data->department) == 'Quality Control' ? 'selected' : '' }}>Quality Control</option>
                                                <option value="Quality Control (Microbiology department)" {{old('department', $data->department) == 'Quality Control (Microbiology department)' ? 'selected' : '' }}>Quality Control (Microbiology department)</option>
                                                <option value="Production General" {{old('department', $data->department) == 'Production General' ? 'selected' : '' }}>Production General</option>
                                                <option value="Production Liquid Orals" {{old('department', $data->department) == 'Production Liquid Orals' ? 'selected' : '' }}>Production Liquid Orals</option>
                                                <option value="Production Tablet and Powder" {{old('department', $data->department) == 'Production Tablet and Powder' ? 'selected' : '' }}>Production Tablet and Powder</option>
                                                <option value="Production External (Ointment, Gels, Creams and Liquid)" {{old('department', $data->department) == 'Production External (Ointment, Gels, Creams and Liquid)' ? 'selected' : '' }}>Production External (Ointment, Gels, Creams and Liquid)</option>
                                                <option value="Production Capsules" {{old('department', $data->department) == 'Production Capsules' ? 'selected' : '' }}>Production Capsules</option>
                                                <option value="Production Injectable" {{old('department', $data->department) == 'Production Injectable' ? 'selected' : '' }}>Production Injectable</option>
                                                <option value="Engineering" {{old('department', $data->department) == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                                                <option value="Human Resource" {{old('department', $data->department) == 'Human Resource' ? 'selected' : '' }}>Human Resource</option>
                                                <option value="Store" {{old('department', $data->department) == 'Store' ? 'selected' : '' }}>Store</option>
                                                <option value="Electronic Data Processing" {{old('department', $data->department) == 'Electronic Data Processing' ? 'selected' : '' }}>Electronic Data Processing</option>
                                                <option value="Formulation Development" {{old('department', $data->department) == 'Formulation Development' ? 'selected' : '' }}>Formulation Development</option>
                                                <option value="Analytical Research and Development Laboratory" {{old('department', $data->department) == 'Analytical Research and Development Laboratory' ? 'selected' : '' }}>Analytical Research and Development Laboratory</option>
                                                <option value="Packaging Development" {{old('department', $data->department) == 'Packaging Development' ? 'selected' : '' }}>Packaging Development</option>
                                                <option value="Purchase Department" {{old('department', $data->department) == 'Purchase Department' ? 'selected' : '' }}>Purchase Department</option>
                                                <option value="Document Cell" {{old('department', $data->department) == 'Document Cell' ? 'selected' : '' }}>Document Cell</option>
                                                <option value="Regulatory Affairs" {{old('department', $data->department) == 'Regulatory Affairs' ? 'selected' : '' }}>Regulatory Affairs</option>
                                                <option value="Pharmacovigilance" {{old('department', $data->department) == 'Pharmacovigilance' ? 'selected' : '' }}>Pharmacovigilance</option>

                                            </select>
                                            @error('department')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror

                                            @if(in_array($data->stage, [0,2,3,4,5,6,7,8]))
                                              <input type="hidden" name="department" value="{{old('department', $data->department)}}">
                                            @endif  
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="sub-head">Investigation details</div>
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="description">Description <span class="text-danger">*</span></label>
                                            <textarea name="description"{{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }} required>{{ $data->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="comments">Comments <span class="text-danger" >*</span></label>
                                            <textarea name="comments" {{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }} required>{{ $data->comments }}</textarea>
                                        </div>
                                        @error('comments')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
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
                                                        name="root_cause_initial_attachment[]" {{$data->stage == 0|| $data->stage == 2 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "disabled" : "" }}
                                                        oninput="addMultipleFiles(this, 'root_cause_initial_attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="button-block">
                                    <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                    <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                            class="text-white"> Exit </a> </button>
                                </div>
                            </div>
                        </div>



                    <div id="CCForm9" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">

                                        @if ($data->stage == 2)
                                                <div class="group-input">
                                                    <label for="comments">HOD Review Comment<span
                                                        class="text-danger">*</span> </label>
                                                    <textarea name="hod_comments"  {{$data->stage ==2 ? 'required' : ''}}  {{$data->stage == 0|| $data->stage == 1 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->hod_comments }}</textarea>
                                                </div>
                                                @error('hod_comments')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        @else

                                                <div class="group-input">
                                                    <label for="comments">HOD Review Comment </label>
                                                    <textarea name="hod_comments" {{$data->stage == 0|| $data->stage == 1 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->hod_comments }}</textarea>
                                                </div>
                                        </div>
                                        @endif
                                        @error('hod_comments')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                              </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="comments">HOD Review Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="hod_attachments">
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
                                                    name="hod_attachments[]" {{$data->stage == 0|| $data->stage == 1 || $data->stage == 3|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}
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
                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">

                            <div class="row">
                                <div class="col-lg-12">
                                         @if ($data->stage == 3)

                                            <div class="group-input">
                                                <label for="comments" >Initial QA/CQA Review Comments <span
                                                    class="text-danger">*</span></label>
                                                <textarea name="cft_comments_new" {{$data->stage == 3 ? 'required' : ''}} {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->cft_comments_new }}</textarea>
                                            </div>

                                          @else
                                            <div class="group-input">
                                                <label for="comments">Initial QA/CQA Review Comments</label>
                                                <textarea name="cft_comments_new" {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->cft_comments_new }}</textarea>
                                            </div>
                                        @endif
                                            @error('cft_comments_new')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="comments">Initial QA/CQA Review Attachment</label>
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
                                                    name="cft_attchament_new[]" {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}
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
                                <div class="col-12">
                                    <div class="sub-head">Investigation </div>
                                </div>


                                <div class="col-lg-12">

                                        <div class="group-input">

                                            <label for="objective" style="">Objective<span class="text-danger">*</span></label>
                                            <textarea name="objective" class="summernote" {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->objective }}</textarea>
                                        </div>

                                        @error('objective')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                            </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="scope">Scope @if ($data->stage == 4)<span class="text-danger">*</span>@endif</label>
                                        <textarea name="scope" class="summernote" {{$data->stage == 4 ? 'required' : ''}} {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->scope }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="problem_statement">Problem Statement @if ($data->stage == 4) <span class="text-danger">*</span>@endif</label>
                                        <textarea name="problem_statement_rca" class="summernote" {{$data->stage == 4 ? 'required' : ''}} {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->problem_statement_rca }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="requirement">Background @if ($data->stage == 4) <span class="text-danger">*</span> @endif</label>
                                        <textarea name="requirement" class="summernote" {{$data->stage == 4 ? 'required' : ''}} {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->requirement }}</textarea>
                                    </div>
                                    @error('requirement')
                                        <span>{{$message}} </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="immediate_action">Immediate Action @if ($data->stage == 4) <span class="text-danger">*</span> @endif</label>
                                        <textarea name="immediate_action" class="summernote" {{$data->stage == 4 ? 'required' : ''}} {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->immediate_action }}</textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="investigation_team">Investigation Team @if ($data->stage == 4) <span class="text-danger">*</span>@endif </label>
                                        <select multiple id="investigation_team"placeholder="Select members of the Investigation Team" name="investigation_team[]"  {{ in_array($data->stage,[0,1,2,3,5,6,7,8]) ? "disabled" : "" }} {{$data->stage ==4 ? 'required' : ''}}>
                                          
                                        @foreach ($users as $key => $value)
                                            <option value="{{ $value->id }}"
                                                {{old('investigation_team', $data->investigation_team) == $value->id ? 'selected' : '' }}>
                                                {{ $value->name }}
                                            </option>
                                        @endforeach
                                        </select>
                                    
                                        @if(in_array($data->stage, [0,1,2,3,5,6,7,8]))
                                            <input type="hidden" name="investigation_team" value="{{old('investigation_team', $data->investigation_team)}}">
                                        @endif  

                                    </div>
                                </div> --}}

                        @php
                            $selectedTeam = old('investigation_team', is_array($data->investigation_team) ? $data->investigation_team : explode(',', $data->investigation_team));
                        @endphp
                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="investigation_team">Investigation Team @if ($data->stage == 4) <span class="text-danger">*</span>@endif </label>
                                <select multiple id="investigation_team" name="investigation_team[]" 
                                    {{ in_array($data->stage,[0,1,2,3,5,6,7,8]) ? "disabled" : "" }} 
                                    {{ $data->stage == 4 ? 'required' : '' }}>
                                    
                                    @foreach ($users as $key => $value)
                                        <option value="{{ $value->id }}"
                                            {{ in_array($value->id, $selectedTeam) ? 'selected' : '' }}>
                                            {{ $value->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @if(in_array($data->stage, [0,1,2,3,5,6,7,8]))
                                    @foreach($selectedTeam as $id)
                                        <input type="hidden" name="investigation_team[]" value="{{ $id }}">
                                    @endforeach
                                @endif
                            </div>
                        </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root-cause-methodology">Root Cause Methodology @if ($data->stage == 4)  <span class="text-danger">*</span>@endif</label>
                                        @php
                                            $selectedMethodologies = explode(',', $data->root_cause_methodology);
                                        @endphp
                                   

                                        <select name="root_cause_methodology[]" multiple id="root-cause-methodology"
                                            {{ in_array($data->stage, [0,1,2,3,5,6,7,8]) ? "disabled" : "" }}>
                                            <option value="Why-Why Chart" {{ in_array('Why-Why Chart', old('root_cause_methodology', $selectedMethodologies) ?? []) ? 'selected' : '' }}>Why-Why Chart</option>
                                            <option value="Failure Mode and Effect Analysis" {{ in_array('Failure Mode and Effect Analysis', old('root_cause_methodology', $selectedMethodologies) ?? []) ? 'selected' : '' }}>Failure Mode and Effect Analysis</option>
                                            <option value="Fishbone or Ishikawa Diagram" {{ in_array('Fishbone or Ishikawa Diagram', old('root_cause_methodology', $selectedMethodologies) ?? []) ? 'selected' : '' }}>Fishbone or Ishikawa Diagram</option>
                                            <option value="Is/Is Not Analysis" {{ in_array('Is/Is Not Analysis', old('root_cause_methodology', $selectedMethodologies) ?? []) ? 'selected' : '' }}>Is/Is Not Analysis</option>
                                            <option value="Rootcauseothers" {{ in_array('Rootcauseothers', old('root_cause_methodology', $selectedMethodologies) ?? []) ? 'selected' : '' }}>Others</option>
                                        </select>

                                        @error('root_cause_methodology')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror

                                        @if(in_array($data->stage, [0,1,2,3,5,6,7,8]))
                                            @foreach(old('root_cause_methodology', $selectedMethodologies) ?? [] as $methodology)
                                                <input type="hidden" name="root_cause_methodology[]" value="{{ $methodology }}">
                                            @endforeach
                                        @endif
                                    </div>
                                </div><div class="col-12 mb-4" id="fmea-section" style="display:none;">
                                    <div class="group-input">
                                        <label for="agenda">
                                            Failure Mode and Effect Analysis
                                            <button type="button" name="agenda"
                                                onclick="addRootCauseAnalysisRiskAssessment1('risk-assessment-risk-management')"
                                                {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>+</button>
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
                                                        <th>Sr.No.</th>
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
                                                        <th>Traceability document</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!empty($data->risk_factor))
                                                        @foreach (unserialize($data->risk_factor) as $key => $riskFactor)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td><textarea name="risk_factor[]"
                                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ $riskFactor }}</textarea>
                                                                </td>
                                                                <td><textarea name="risk_element[]"
                                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ unserialize($data->risk_element)[$key] ?? null }}</textarea>
                                                            </td>
                                                                <td><textarea name="problem_cause[]"
                                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ unserialize($data->problem_cause)[$key] ?? null }}</textarea>
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
                                                                <td><textarea name="mitigation_proposal[]"
                                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>{{ unserialize($data->mitigation_proposal)[$key] ?? null }}</textarea>
                                                                </td>
                                                                <td> <button class=" btn-dark removeRowBtn"
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
                                <div class="col-12" id="fishbone-section" style="display:none;">
                                    <div class="group-input">
                                        <label for="fishbone">
                                            Fishbone or Ishikawa Diagram
                                            <button type="button" name="agenda"
                                                onclick="addFishBone('.top-field-group', '.bottom-field-group')"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "disabled" : "" }}>+</button>
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
                                                                <div><textarea
                                                                        value=""
                                                                        name="measurement[]"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $measure }}</textarea>
                                                                </div>
                                                                <div><textarea
                                                                        name="materials[]"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ unserialize($data->materials)[$key] ? unserialize($data->materials)[$key] : '' }}</textarea>
                                                                </div>
                                                                <div><textarea
                                                                        name="methods[]"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ unserialize($data->methods)[$key] ?? null }}</textarea>
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
                                                                <div><textarea 
                                                                        name="environment[]"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $measure }}</textarea>
                                                                </div>
                                                                <div><textarea 
                                                                        name="manpower[]"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ unserialize($data->manpower)[$key] ? unserialize($data->manpower)[$key] : '' }}</textarea>
                                                                </div>
                                                                <div><textarea
                                                                        name="machine[]"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ unserialize($data->machine)[$key] ? unserialize($data->machine)[$key] : '' }}</textarea>
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
                                                    <textarea name="problem_statement" {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->problem_statement }}</textarea>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12" id="HideInference" style="display:none;">
                                    <div class="group-input">
                                        <label for="Inference">
                                            Inference
                                            <button type="button"
                                                onclick="addInference('Inference')"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>+</button>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="Inference">
                                                <thead>
                                                    <tr>
                                                        <th style="width:5%">Sr.No.</th>
                                                        <th>Type</th>
                                                        <th>Remarks</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!empty($data->inference_type) && !empty($data->inference_remarks))
                                                        @php
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
                                                                        {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>
                                                                </td>
                                                                <td>
                                                                    <select name="inference_type[]"
                                                                        {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>
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
                                                                        <option value="Mother Environment"
                                                                            {{ $inference_type == 'Mother Environment' ? 'selected' : '' }}>
                                                                             Mother Environment</option>
                                                                        <option value="Man"
                                                                            {{ $inference_type == 'Man' ? 'selected' : '' }}>
                                                                            Man</option>
                                                                        <option value="Machine"
                                                                            {{ $inference_type == 'Machine' ? 'selected' : '' }}>
                                                                            Machine</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <textarea name="inference_remarks[]"
                                                                        {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $inference_remarks[$key] ?? '' }}</textarea>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="removeRowBtn"
                                                                        {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>Remove</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" id="why-why-chart-section">
                                <div class="group-input">
                                    <label for="why-why-chart">
                                        Why-Why Chart
                                        <span class="text-primary add-why-question" style="font-size: 1rem; font-weight: 600; cursor: pointer; margin-left: 10px;">+</span>
                                    </label>

                                    <div class="why-why-chart">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr style="background: #f4bb22">
                                                    <th style="width:150px;">Problem Statement :</th>
                                                    <td>
                                                        <textarea name="why_problem_statement">{{ old('why_problem_statement', $data->why_problem_statement ?? '') }}</textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div id="why-questions-container">
                                            @php
                                                $whyData = !empty($data->why_data) ? unserialize($data->why_data) : [];
                                            @endphp

                                            @foreach ($whyData as $index => $why)
                                                <div class="why-field-wrapper">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width:150px; color: #393cd4;">Why {{ $index + 1 }}</th>
                                                                <td>
                                                                    <textarea name="why_questions[]" placeholder="Enter Why {{ $index + 1 }} Question">{{ $why['question'] }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th style="width:150px; color: #393cd4;">Answer {{ $index + 1 }}</th>
                                                                <td>
                                                                    <textarea name="why_answers[]" placeholder="Enter Answer for Why {{ $index + 1 }}">{{ $why['answer'] }}</textarea>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <span class="remove-field" onclick="removeWhyField(this)" style="cursor: pointer; color: red; font-weight: 600;">Remove</span>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div id="root-cause-container" style="display: {{ count($whyData) > 0 ? 'block' : 'none' }};">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr style="background: #0080006b;">
                                                        <th style="width:150px;">Root Cause :</th>
                                                        <td>
                                                            <textarea name="why_root_cause">{{ old('why_root_cause', $data->why_root_cause ?? '') }}</textarea>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                let whyCount = {{ count($whyData) }};

                                document.querySelector('.add-why-question').addEventListener('click', function () {
                                    whyCount++;

                                    const container = document.getElementById('why-questions-container');
                                    const rootCauseContainer = document.getElementById('root-cause-container');

                                    const whySet = document.createElement('div');
                                    whySet.className = 'why-field-wrapper';
                                    whySet.innerHTML = `
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th style="width:150px; color: #393cd4;">Why ${whyCount}</th>
                                                    <td>
                                                        <textarea name="why_questions[]" placeholder="Enter Why ${whyCount} Question"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="width:150px; color: #393cd4;">Answer ${whyCount}</th>
                                                    <td>
                                                        <textarea name="why_answers[]" placeholder="Enter Answer for Why ${whyCount}"></textarea>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <span class="remove-field" onclick="removeWhyField(this)" style="cursor: pointer; color: red; font-weight: 600;">Remove</span>
                                    `;

                                    container.appendChild(whySet);
                                    rootCauseContainer.style.display = 'block';
                                    container.after(rootCauseContainer);
                                });

                                function removeWhyField(element) {
                                    element.closest('.why-field-wrapper').remove();
                                    whyCount--;

                                    if (document.getElementById('why-questions-container').children.length === 0) {
                                        document.getElementById('root-cause-container').style.display = 'none';
                                    }
                                }
                            </script>


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
                                                            <textarea name="what_will_be" {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->what_will_be }}</textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="what_will_not_be" {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->what_will_not_be }}</textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="what_rationable"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}> {{ $data->what_rationable }}</textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="background: #0039bd85">Where</th>
                                                        <td>
                                                            <textarea name="where_will_be"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}> {{ $data->where_will_be }}</textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="where_will_not_be"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}> {{ $data->where_will_not_be }}</textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="where_rationable"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}> {{ $data->where_rationable }}</textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="background: #0039bd85">When</th>
                                                        <td>
                                                            <textarea name="when_will_be"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}> {{ $data->when_will_be }}</textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="when_will_not_be"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->when_will_not_be }}</textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="when_rationable"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}> {{ $data->when_rationable }}</textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="background: #0039bd85">Why</th>
                                                        <td>
                                                            <textarea name="coverage_will_be"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}> {{ $data->coverage_will_be }}</textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="coverage_will_not_be"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}> {{ $data->coverage_will_not_be }}</textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="coverage_rationable"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}> {{ $data->coverage_rationable }}</textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="background: #0039bd85">Who</th>
                                                        <td>
                                                            <textarea name="who_will_be"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}> {{ $data->who_will_be }}</textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="who_will_not_be"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}> {{ $data->who_will_not_be }}</textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="who_rationable"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}> {{ $data->who_rationable }}</textarea>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12" id="root-cause-others"style="display:none;">
                                    <div class="group-input">
                                        <label for="root_cause_Others">Others @if ($data->stage == 4)@endif</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                        <textarea class="summernote" {{$data->stage == 4 ? 'required' : ''}} name="root_cause_Others" id="summernote" {{$data->stage == 4 ? 'required' : ''}}>{{ $data->root_cause_Others}} </textarea>
                                    </div>
                                </div>

                                    <div class="col-12" id="otherAttachmentField" style="display: {{ $data->reason == 'Rootcauseothers' ? 'block' : 'none' }};">                                    <div class="group-input">
                                        <label for="Inv Attachments">Other Attachment</label>
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

                                                @php
                                                    $isReadonly = in_array($data->stage, [0,1,2,3,5,6,7,8]);
                                                    $isRequired = ($data->reason == 'Rootcauseothers' && empty($data->investigation_attachment) && $data->stage == 4);
                                                @endphp

                                                <input type="file" id="myfile"
                                                    name="investigation_attachment[]"
                                                    {{ $isReadonly ? 'readonly' : '' }}
                                                    {{ $isRequired ? 'required' : '' }}
                                                    oninput="addMultipleFiles(this, 'investigation_attachment')"
                                                    multiple>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="root_cause">Root Cause @if ($data->stage == 4) <span class="text-danger">*</span>@endif</label>
                                        <textarea name="root_cause"  class="summernote" {{$data->stage == 4 ? 'required' : ''}} {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->root_cause }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="impact_risk_assessment">Impact / Risk Assessment @if ($data->stage == 4) <span class="text-danger">*</span>@endif</label>
                                        <textarea name="impact_risk_assessment" class="summernote" {{$data->stage == 4 ? 'required' : ''}} {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->impact_risk_assessment }}</textarea>
                                    </div>
                                    @error('impact_risk_assessment')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="capa">CAPA @if ($data->stage == 4) <span class="text-danger">*</span> @endif</label>
                                        <textarea name="capa" class="summernote" {{$data->stage == 4 ? 'required' : ''}} {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->capa }}</textarea>
                                    </div>
                                    @error('capa')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="investigation_summary">Investigation Summary @if ($data->stage == 4 ? 'required' : '') <span class="text-danger">*</span> @endif</label>
                                        <textarea name="investigation_summary_rca" class="summernote" {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->investigation_summary_rca }}</textarea>
                                    </div>
                                </div>

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
                                                        name="root_cause_initial_attachment_rca[]"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}
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




                    <div id="CCForm10" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <!-- <div class="sub-head">
                                                                                                                                                                                                                                                                                                             </div>  -->
                            <div class="row">
                                <div class="col-lg-12">
                                    @if ($data->stage == 5)
                                       <div class="group-input">
                                           <label for="comments" >HOD Final Review Comments <span
                                               class="text-danger">*</span></label>
                                           <textarea name="hod_final_comments" {{$data->stage == 5 ? 'required' : ''}} {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 4 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->hod_final_comments }}</textarea>
                                       </div>
                                     @else
                                       <div class="group-input">
                                           <label for="comments">HOD Final Review Comments</label>
                                           <textarea name="hod_final_comments"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 4 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->hod_final_comments }}</textarea>
                                       </div>
                                   @endif
                                       @error('hod_final_comments')
                                       <div class="text-danger">{{ $message }}</div>
                                       @enderror
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
                                                    name="hod_final_attachments[]"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 4 || $data->stage == 6 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}
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
                                    @if ($data->stage == 6)

                                       <div class="group-input">
                                           <label for="comments" >QA/CQA Final Review Comments <span
                                               class="text-danger">*</span></label>
                                           <textarea name="qa_final_comments"  {{$data->stage == 6 ? 'required' : ''}} {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->qa_final_comments }}</textarea>
                                       </div>

                                     @else
                                       <div class="group-input">
                                           <label for="comments">QA/CQA Final Review Comments</label>
                                           <textarea name="qa_final_comments"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->qa_final_comments }}</textarea>
                                       </div>
                                   @endif
                                       @error('qa_final_comments')
                                       <div class="text-danger">{{ $message }}</div>
                                       @enderror
                           </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="comments">QA/CQA Final Review Attachment</label>
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
                                                    name="qa_final_attachments[]"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 7|| $data->stage == 8 ? "readonly" : "" }}
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
                              </div>  -->
                            <div class="row">
                                <div class="col-lg-12">
                                    @if ($data->stage == 7)

                                       <div class="group-input">
                                           <label for="comments" >QAH/CQAH/Designee Final Approval Comments <span
                                               class="text-danger">*</span></label>
                                           <textarea name="qah_final_comments" {{$data->stage == 7 ? 'required' : ''}} {{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->qah_final_comments }}</textarea>
                                       </div>

                                     @else
                                       <div class="group-input">
                                           <label for="comments">QAH/CQAH/Designee Final Approval Comments</label>
                                           <textarea name="qah_final_comments"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6|| $data->stage == 8 ? "readonly" : "" }}>{{ $data->qah_final_comments }}</textarea>
                                       </div>
                                   @endif
                                       @error('qah_final_comments')
                                       <div class="text-danger">{{ $message }}</div>
                                       @enderror
                           </div>


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="comments">QAH/CQAH/designee Final Approval Attachments</label>
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
                                                    name="qah_final_attachments[]"{{$data->stage == 0|| $data->stage == 1 || $data->stage == 2|| $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6|| $data->stage == 8 ? "readonly" : "" }}
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
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="acknowledge_by">Acknowledge By</label>
                                        <div class="">
                                            @if ($data->acknowledge_by )
                                            {{ $data->acknowledge_by }}
                                            @else Not Applicable
                                            @endif
                                           </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="acknowledge_on">Acknowledge On</label>
                                        <div class="">
                                            @if ($data->acknowledge_on )
                                            {{ $data->acknowledge_on }}
                                            @else Not Applicable
                                            @endif
                                           </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="ack_comments"> Acknowledge Comment</label>
                                        <div class="">
                                            @if ($data->ack_comments )
                                            {{ $data->ack_comments }}
                                            @else Not Applicable
                                            @endif
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="HOD_Review_Complete_By">HOD Review Complete By</label>
                                        <div class="">
                                            @if ($data->HOD_Review_Complete_By )
                                            {{ $data->HOD_Review_Complete_By }}
                                            @else Not Applicable
                                            @endif
                                            {{ $data->HOD_Review_Complete_By }}</div>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="HOD_Review_Complete_On">HOD Review Complete On</label>
                                        <div class="">
                                            @if ($data->HOD_Review_Complete_On )
                                            {{ $data->HOD_Review_Complete_On }}
                                            @else Not Applicable
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="Comments"> HOD Review Complete Comment</label>
                                        <div class="">
                                            @if ($data->HOD_Review_Complete_Comment )
                                            {{ $data->HOD_Review_Complete_Comment }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>

                              
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="QQQA_Review_Complete_By">QA/CQA Review Complete By</label>
                                        <div class="">
                                            @if ($data->QQQA_Review_Complete_By )
                                            {{ $data->QQQA_Review_Complete_By }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="QQQA_Review_Complete_On">QA/CQA Review Complete On</label>
                                        <div class="">
                                            @if ($data->QQQA_Review_Complete_On )
                                            {{ $data->QQQA_Review_Complete_On }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="Comment"> QA/CQA Review Complete Comment</label>
                                        <div class="">
                                            @if ($data->QAQQ_Review_Complete_comment )
                                            {{ $data->QAQQ_Review_Complete_comment }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input" style="margin-bottom: 1rem">
                                        <label for="submitted_by">Submit By</label>
                                        <div class="">
                                            @if ($data->submitted_by )
                                            {{ $data->submitted_by }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>
                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="submitted_on">Submit On</label>
                                        <div class="">  @if ($data->submitted_on )
                                            {{ $data->submitted_on }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>
                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="Comment"> Submit Comment</label>
                                        <div class="">  @if ($data->qa_comments_new )
                                            {{ $data->qa_comments_new }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="HOD_Final_Review_Complete_By">HOD Final Review Complete By</label>
                                        <div class="">  @if ($data->HOD_Final_Review_Complete_By )
                                            {{ $data->HOD_Final_Review_Complete_By }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>
                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="HOD_Final_Review_Complete_On">HOD Final Review Complete On</label>
                                        <div class="">  @if ($data->HOD_Final_Review_Complete_On )
                                            {{ $data->HOD_Final_Review_Complete_On }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>
                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="Comments"> HOD Final Review Complete Comment</label>
                                        <div class="">  @if ($data->HOD_Final_Review_Complete_Comment )
                                            {{ $data->HOD_Final_Review_Complete_Comment }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="More_Info_hfr_by">More Info Req.
                                            By</label>
                                        <div class="">{{ $data->More_Info_hfr_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="More_Info_hfr_on">More Info Req.
                                            On</label>
                                        <div class="">{{ $data->More_Info_hfr_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="More_Info_hfr_comment">Comments</label>
                                        <div class="">{{ $data->More_Info_hfr_comment }}</div>
                                    </div>
                                </div> --}}
                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="Final_QA_Review_Complete_By">Final QA/CQA Review Complete
                                            By</label>
                                        <div class="">  @if ($data->Final_QA_Review_Complete_By )
                                            {{ $data->Final_QA_Review_Complete_By }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>
                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="Final_QA_Review_Complete_On">Final QA/CQA Review Complete
                                            On</label>
                                        <div class="">  @if ($data->Final_QA_Review_Complete_On )
                                            {{ $data->Final_QA_Review_Complete_On }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>
                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="Comments"> Final QA/CQA Review Complete Comment</label>
                                        <div class="">  @if ($data->Final_QA_Review_Complete_Comment )
                                            {{ $data->Final_QA_Review_Complete_Comment }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="qA_review_complete_by">More Info Req.
                                            By</label>
                                        <div class="">{{ $data->qA_review_complete_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="qA_review_complete_on">More Info Req.
                                            On</label>
                                        <div class="">{{ $data->qA_review_complete_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="qA_review_complete_comment">Comments</label>
                                        <div class="">{{ $data->qA_review_complete_comment }}</div>
                                    </div>
                                </div> --}}
                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="evaluation_complete_by">QAH/CQAH Closure By</label>
                                        <div class="">  @if ($data->evaluation_complete_by )
                                            {{ $data->evaluation_complete_by }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>
                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="evaluation_complete_on">QAH/CQAH Closure On</label>
                                        <div class="">  @if ($data->evaluation_complete_on )
                                            {{ $data->evaluation_complete_on }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>

                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="evalution_Closure_comment"> QAH/CQAH Closure Comment</label>
                                        <div class="">  @if ($data->evalution_Closure_comment )
                                            {{ $data->evalution_Closure_comment }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>
                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="Cancelled By">Cancel By</label>
                                        <div class="">  @if ($data->cancelled_by )
                                            {{ $data->cancelled_by }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>
                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="Cancelled On">Cancel On</label>
                                        <div class="">  @if ($data->cancelled_on )
                                            {{ $data->cancelled_on }}
                                            @else Not Applicable
                                            @endif</div>
                                    </div>
                                </div>

                                <div class="col-lg-4" style="margin-bottom: 1rem">
                                    <div class="group-input">
                                        <label for="Comments"> Cancel Comment</label>
                                        <div class="">  @if ($data->cancel_comment )
                                            {{ $data->cancel_comment }}
                                            @else Not Applicable
                                            @endif</div>
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

        // function addRootCauseAnalysisRiskAssessment1(tableId) {
        //     var table = document.getElementById(tableId);
        //     var currentRowCount = table.rows.length;
        //     var newRow = table.insertRow(currentRowCount);
        //     newRow.setAttribute("id", "row" + currentRowCount);
        //     var cell1 = newRow.insertCell(0);
        //     cell1.innerHTML = currentRowCount;

        //     var cell2 = newRow.insertCell(1);
        //     cell2.innerHTML = "<input name='risk_factor[]' type='text'>";

        //     var cell3 = newRow.insertCell(2);
        //     cell3.innerHTML = "<input name='risk_element[]' type='text'>";

        //     var cell4 = newRow.insertCell(3);
        //     cell4.innerHTML = "<input name='problem_cause[]' type='text'>";

        //     // var cell5 = newRow.insertCell(4);
        //     // cell5.innerHTML = "<input name='existing_risk_control[]' type='text'>";

        //     var cell5 = newRow.insertCell(4);
        //     cell5.innerHTML =
        //         "<select onchange='calculateInitialResult(this)' class='fieldR' name='initial_severity[]'><option value=''>-- Select --</option><option value='1'>1-Insignificant</option><option value='2'>2-Minor</option><option value='3'>3-Major</option><option value='4'>4-Critical</option><option value='5'>5-Catastrophic</option></select>";
        //         //  "<input name='initial_severity[]' type='text'>";

        //     var cell6 = newRow.insertCell(5);
        //     cell6.innerHTML =
        //         "<select onchange='calculateInitialResult(this)' class='fieldP' name='initial_probability[]'><option value=''>-- Select --</option><option value='1'>1-Very rare</option><option value='2'>2-Unlikely</option><option value='3'>3-Possibly</option><option value='4'>4-Likely</option><option value='5'>5-Almost certain (every time)</option></select>";

        //     var cell7 = newRow.insertCell(6);
        //     cell7.innerHTML =
        //         "<select onchange='calculateInitialResult(this)' class='fieldN' name='initial_detectability[]'><option value=''>-- Select --</option><option value='1'>1-Always detected</option><option value='2'>2-Likely to detect</option><option value='3'>3-Possible to detect</option><option value='4'>4-Unlikely to detect</option><option value='5'>5-Not detectable</option></select>";

        //     var cell8 = newRow.insertCell(7);
        //     cell8.innerHTML = "<input name='initial_rpn[]' type='text' class='initial-rpn' readonly>";

        //     // var cell10 = newRow.insertCell(9);
        //     // cell10.innerHTML =
        //     //     "<select name='risk_acceptance[]'><option value=''>-- Select --</option><option value='N'>N</option><option value='Y'>Y</option></select>";

        //     var cell9 = newRow.insertCell(8);
        //     cell9.innerHTML = "<input name='risk_control_measure[]' type='text'>";

        //     var cell10 = newRow.insertCell(9);
        //     cell10.innerHTML =
        //         "<select onchange='calculateResidualResult(this)' class='residual-fieldR' name='residual_severity[]'><option value=''>-- Select --</option><option value='1'>1-Insignificant</option><option value='2'>2-Minor</option><option value='3'>3-Major</option><option value='4'>4-Critical</option><option value='5'>5-Catastrophic</option></select>";

        //     var cell11 = newRow.insertCell(10);
        //     cell11.innerHTML =
        //         "<select onchange='calculateResidualResult(this)' class='residual-fieldP' name='residual_probability[]'><option value=''>-- Select --</option><option value='1'>1-Very rare</option><option value='2'>2-Unlikely</option><option value='3'>3-Possibly</option><option value='4'>4-Likely</option><option value='5'>5-Almost certain (every time)</option></select>";

        //     var cell12 = newRow.insertCell(11);
        //     cell12.innerHTML =
        //         "<select onchange='calculateResidualResult(this)' class='residual-fieldN' name='residual_detectability[]'><option value=''>-- Select --</option><option value='1'>1-Always detected</option><option value='2'>2-Likely to detect</option><option value='3'>3-Possible to detect</option><option value='4'>4-Unlikely to detect</option><option value='5'>5-Not detectable</option></select>";

        //     var cell13 = newRow.insertCell(12);
        //     cell13.innerHTML = "<input name='residual_rpn[]' type='text' class='residual-rpn' readonly>";
        //     var cell14 = newRow.insertCell(13);
        //     cell14.innerHTML =
        //         "<select name='risk_acceptance[]' class='risk-acceptance' readonly>" +
        //         "<option value=''>-- Select --</option>" +
        //         "<option value='Low'>Low</option>" +
        //         "<option value='Medium'>Medium</option>" +
        //         "<option value='High'>High</option>" +
        //         "</select>";

        //         var cell15 = newRow.insertCell(14);
        //         cell15.innerHTML =
        //             "<select name='risk_acceptance2[]'><option value=''>-- Select --</option><option value='N'>N</option><option value='Y'>Y</option></select>";

        //         var cell16 = newRow.insertCell(15);
        //         cell16.innerHTML = "<input name='mitigation_proposal[]' type='text'>";

        //         var cell17 = newRow.insertCell(16);
        //         cell17.innerHTML = "<button type='text' class='removeRowBtn' name='Action[]' readonly>Remove</button>";

        //     for (var i = 1; i < currentRowCount; i++) {
        //         var row = table.rows[i];
        //         row.cells[0].innerHTML = i;
        //     }
        // }
        function addRootCauseAnalysisRiskAssessment1(tableId) {
        var table = document.getElementById(tableId);
        var currentRowCount = table.children[1].rows.length;
        var newRow = table.children[1].insertRow(currentRowCount);
        newRow.setAttribute("id", "row" + currentRowCount);
        var cell1 = newRow.insertCell(0);
        cell1.innerHTML = currentRowCount + 1;

        var cell2 = newRow.insertCell(1);
        cell2.innerHTML = "<textarea name='risk_factor[]' type='text'>";

        var cell3 = newRow.insertCell(2);
        cell3.innerHTML = "<textarea name='risk_element[]' type='text'>";

        var cell4 = newRow.insertCell(3);
        cell4.innerHTML = "<textarea name='problem_cause[]' type='text'>";

        // var cell5 = newRow.insertCell(4);
        // cell5.innerHTML = "<input name='existing_risk_control[]' type='text'>";

        var cell5 = newRow.insertCell(4);
        cell5.innerHTML =
            "<select onchange='calculateInitialResult(this)' class='fieldR' name='initial_severity[]'><option value=''>-- Select --</option><option value='1'>1-Insignificant</option><option value='2'>2-Minor</option><option value='3'>3-Major</option><option value='4'>4-Critical</option><option value='5'>5-Catastrophic</option></select>";
            // "<input name='initial_severity[]' type='text'>";


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

        var cell19 = newRow.insertCell(8);
        cell19.innerHTML = "<textarea name='risk_control_measure[]' type='text'>";

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
        cell16.innerHTML = "<textarea name='mitigation_proposal[]' type='text'>";

        var cell17 = newRow.insertCell(16);
        cell17.innerHTML = "<button type='text'  class='removeRowBtn  btn-dark' name='Action[]' readonly>Remove</button>";

        for (var i = 0; i < currentRowCount-1; i++) {
            var row = table.children[1].rows[i];
            row.cells[0].innerHTML = i+1;
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
            "<select name='inference_type[]'><option value=''>-- Select --</option><option value='Measurement'>Measurement</option><option value='Materials'>Materials</option><option value='Methods'>Methods</option><option value='Mother Environment'>Mother Environment</option><option value='Man'>Man</option><option value='Machine'>Machine</option></select>";

            var cell3 = newRow.insertCell(2);
            cell3.innerHTML = "<textarea type='text'  name='inference_remarks[]'>";

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


<script>
    $(document).ready(function () {
        function toggleRequiredFields(value, show) {
            switch (value) {
                case 'Failure Mode and Effect Analysis':
                    if (show) {
                        $('#fmea-section').find('input, select, textarea').attr('required', true);
                        $('#fmea-section label:first').append('<span class="text-danger req-asterisk"> *</span>');
                    } else {
                        $('#fmea-section').find('input, select, textarea').removeAttr('required');
                        $('#fmea-section .req-asterisk').remove();
                    }
                    break;
                case 'Fishbone or Ishikawa Diagram':
                    if (show) {
                        $('#fishbone-section').find('input, select, textarea').attr('required', true);
                        $('#fishbone-section label:first').append('<span class="text-danger req-asterisk"> *</span>');
                    } else {
                        $('#fishbone-section').find('input, select, textarea').removeAttr('required');
                        $('#fishbone-section .req-asterisk').remove();
                    }
                    break;
                case 'Is/Is Not Analysis':
                    if (show) {
                        $('#is-is-not-section').find('input, select, textarea').attr('required', true);
                        $('#is-is-not-section label:first').append('<span class="text-danger req-asterisk"> *</span>');
                    } else {
                        $('#is-is-not-section').find('input, select, textarea').removeAttr('required');
                        $('#is-is-not-section .req-asterisk').remove();
                    }
                    break;
                case 'Rootcauseothers':
                    // if (show) {
                    //     $('#root-cause-others').find('input, select, textarea').attr('required', true);
                    //     $('#root-cause-others label:first').append('<span class="text-danger req-asterisk"> *</span>');

                    //     // Show Other Attachment field
                    //     $('#otherAttachmentField').show();
                    //     $('#otherAttachmentField input[type="file"]').attr('required', true);
                    //     $('#otherAttachmentField label:first').append('<span class="text-danger req-asterisk"> *</span>');
                    // } else {
                    //     $('#root-cause-others').find('input, select, textarea').removeAttr('required');
                    //     $('#root-cause-others .req-asterisk').remove();

                    //     // Hide Other Attachment field
                    //     $('#otherAttachmentField').hide();
                    //     $('#otherAttachmentField input[type="file"]').removeAttr('required');
                    //     $('#otherAttachmentField .req-asterisk').remove();
                    // }

                    const existingFiles = {!! json_encode(json_decode($data->investigation_attachment)) !!};

                    if (show) {
                        $('#root-cause-others').find('input, select, textarea').attr('required', true);
                        $('#root-cause-others label:first').append('<span class="text-danger req-asterisk"> *</span>');

                        $('#otherAttachmentField').show();

                        // File required only if no file is already uploaded
                        if (!existingFiles || existingFiles.length === 0) {
                            $('#otherAttachmentField input[type="file"]').attr('required', true);
                            $('#otherAttachmentField label:first').append('<span class="text-danger req-asterisk"> *</span>');
                        }
                    } else {
                        $('#root-cause-others').find('input, select, textarea').removeAttr('required');
                        $('#root-cause-others .req-asterisk').remove();

                        $('#otherAttachmentField').hide();
                        $('#otherAttachmentField input[type="file"]').removeAttr('required');
                        $('#otherAttachmentField .req-asterisk').remove();
                    }

                    break;
                case 'Why-Why Chart':
                    if (show) {
                        $('#why-why-chart-section').find('input, select, textarea').attr('required', true);
                        $('#why-why-chart-section label:first').append('<span class="text-danger req-asterisk"> *</span>');
                    } else {
                        $('#why-why-chart-section').find('input, select, textarea').removeAttr('required');
                        $('#why-why-chart-section .req-asterisk').remove();
                    }
                    break;
            }
        }

        $('#root-cause-methodology').on('change', function () {
            var selectedValues = $(this).val() || [];

            // Hide all and reset requirements
            ['Why-Why Chart', 'Failure Mode and Effect Analysis', 'Fishbone or Ishikawa Diagram', 'Is/Is Not Analysis', 'Rootcauseothers'].forEach(function (value) {
                toggleRequiredFields(value, false);
                switch (value) {
                    case 'Why-Why Chart':
                        $('#why-why-chart-section').hide();
                        break;
                    case 'Failure Mode and Effect Analysis':
                        $('#fmea-section').hide();
                        break;
                    case 'Fishbone or Ishikawa Diagram':
                        $('#fishbone-section').hide();
                        $('#HideInference').hide();
                        break;
                    case 'Is/Is Not Analysis':
                        $('#is-is-not-section').hide();
                        break;
                    case 'Rootcauseothers':
                        $('#root-cause-others').hide();
                        $('#otherAttachmentField').hide();
                        break;
                }
            });

            // Show and set required only for selected
            selectedValues.forEach(function (value) {
                toggleRequiredFields(value, true);
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
                if (value === 'Rootcauseothers') {
                    $('#root-cause-others').show();
                }
            });
        });

        // Trigger on page load
        $('#root-cause-methodology').trigger('change');
    });
</script>



    {{-- <script>
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
    </script> --}}

    <script>
//     $('#summernote').summernote({
//       toolbar: [
//           ['style', ['style']],
//           ['font', ['bold', 'underline', 'clear', 'italic']],
//           ['color', ['color']],
//           ['para', ['ul', 'ol', 'paragraph']],
//           ['table', ['table']],
//           ['insert', ['link', 'picture', 'video']],
//           ['view', ['fullscreen', 'codeview', 'help']]
//       ]
//   });

//   $('.summernote').summernote({
//     toolbar: [
//         ['style', ['style']],
//         ['font', ['bold', 'underline', 'clear', 'italic']],
//         ['color', ['color']],
//         ['para', ['ul', 'ol', 'paragraph']],
//         ['table', ['table']],
//         ['insert', ['link', 'picture', 'video']],
//         ['view', ['fullscreen', 'codeview', 'help']]
//     ],
//         callbacks: {
//             onPaste: function (e) {
//                 let bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('text/html');

//                 bufferText = bufferText.replace(/<table/g, '<table border="1"');

//                 setTimeout(function () {
//                     $('.summernote').summernote('pasteHTML', bufferText);
//                 }, 10);
                
//                 e.preventDefault();
//             }
//         }
//     });

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

