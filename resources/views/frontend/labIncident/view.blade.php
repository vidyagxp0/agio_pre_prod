@extends('frontend.layout.main')
@section('container')
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
        .input_width {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 11px;
        }
    </style>
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
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            QC Head/HOD Initial Review Complete
                            </button>
                            @if(Helpers::getChildData($data->id, 'LabIncident') < 3)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal3">
                                Child
                            </button>
                            @endif
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 3 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA Initial Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            @if(Helpers::getChildData($data->id, 'LabIncident') < 3)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal3">
                                Child
                            </button>
                            @endif
                        @elseif($data->stage == 4 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))

                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                            More Information Required
                        </button>
                        <button class="button_theme1" name="assignable_cause_identification" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Pending Initiator Update Complete
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                            Child
                        </button>

                        {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                All Activities Completed
                            </button> --}}
                        @elseif($data->stage == 5 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QC Head/HOD Secondary Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            @if(Helpers::getChildData($data->id, 'LabIncident') < 3)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal3">
                                Child
                            </button>
                            @endif
                        @elseif($data->stage == 6 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            QA Secondary Review Complete
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                            More Information Required
                        </button>
                        @if(Helpers::getChildData($data->id, 'LabIncident') < 3)
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal3">
                            Child
                        </button>
                        @endif
                        @elseif($data->stage == 7 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#root-modal">
                                Approved
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            @if(Helpers::getChildData($data->id, 'LabIncident') < 3)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal3">
                                Child
                            </button>
                            @endif
                         @elseif($data->stage == 8 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Pending Approval
                            </button> --}}
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA Head/HOD Final Review Complete
                            </button>
                            @if(Helpers::getChildData($data->id, 'LabIncident') < 3)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal3">
                                Child
                            </button>
                            @endif
                            @elseif($data->stage == 9 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA Final Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            @if(Helpers::getChildData($data->id, 'LabIncident') < 3)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal3">
                                Child
                            </button>
                            @endif
                            @elseif($data->stage == 10 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds) || in_array(7, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Final Root Cause Found
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#back-modal">
                                Final Root Cause Not Found
                            </button>
                            @if(Helpers::getChildData($data->id, 'LabIncident') < 3)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal3">
                                Child
                            </button>
                            @endif


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
                                <div class="active"  style="width: 8% ">QC Head/HOD Initial Review</div>
                            @else
                                <div class="">QC Head/HOD Initial Review</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="active">QA Initial Review</div>
                            @else
                                <div class="">QA Initial Review</div>
                            @endif

                            @if ($data->stage >= 4)
                                <div class="active">Pending Initiator Update</div>
                            @else
                                <div class="">Pending Initiator Update</div>
                            @endif
                            @if ($data->stage >= 5)
                                <div class="active">QC Head/HOD Secondary Review</div>
                            @else
                                <div class="">QC Head/HOD Secondary Review</div>
                            @endif
                            @if ($data->stage >= 6)
                                <div class="active">QA Secondary Review</div>
                            @else
                                <div class="">QA Secondary Review</div>
                            @endif
                            @if ($data->stage >= 7)
                                <div class="active">QAH Approval</div>
                            @else
                                <div class="">QAH Approval</div>
                            @endif
                             <!-- @if ($data->stage >= 8)
                                <div class="active">QA Head/HOD Final Review</div>
                            @else
                                <div class="">QA Head/HOD Final Review</div>
                            @endif
                            @if ($data->stage >= 9)
                                <div class="active">QA Final Review</div>
                            @else
                                <div class="">QA Final Review</div>
                            @endif

                            @if ($data->stage >= 10)
                                <div class="active" >QAH Final Approval</div>
                            @else
                                <div class="">QAH Final Approval</div>
                            @endif -->

                            @if ($data->stage >= 11)
                                <div class="bg-danger" >Closed - Done</div>
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
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Immediate Actions</button> -->
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Extension</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Incident Details</button> --}}
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm4')">CAPA</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">QC Initial Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm12')">QA Initial Review</button>
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm13')">Pending Initiator Update</button> -->
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Investigation Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm14')">QC Head/HOD Secondary Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm15')">QA Secondary Review</button>
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm6')">QA Head/Designee Approval</button> -->
                <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm10')">System Suitability Failure Incidence</button> -->
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
                                        <input disabled type="text" name="record_number" id="record_number"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}/LI/{{ Helpers::year($data->created_at) }}/{{ $data->record }}">
                                         {{-- <div class="static">QMS-EMEA/CAPA/{{ date('y') }}/{{ $record_number }}</div> --}}
                                    </div>

                                    {{-- <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record_number" id="record_number" 
                                            value="---/LI/{{ date('y') }}/{{ $record_number }}"></div> --}}
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input readonly type="text" name="division_code" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }} value="{{ Helpers::getDivisionName($data->division_id) }}">
                                        {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                        <input disabled type="text" name="division_code" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }}
                                            value="{{ $data->initiator_name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        <input disabled type="text" name="intiation_date" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }}
                                         value="{{ Helpers::getdateFormat($data->intiation_date)}}" >
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="search">
                                            Assigned To <span class="text-danger"></span>
                                        </label>
                                        <select id="select-state" placeholder="Select..." name="assign_to" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }}>
                                            @foreach ($users as $value)
                                                <option @if ($data->assign_to == $value->id) selected @endif value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div> --}}

                                {{-- <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Date Due"> Due Date</label>
                                        <div><small class="text-primary">Please mention expected date of completion</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly
                                                placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->due_date) }}" {{ $data->stage == 0 || $data->stage >= 2 ? 'disabled' : ''}}/>
                                            <input type="date" name="due_date" {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : ''}}  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Due Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_date_display" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getDueDate123($data->intiation_date, true) }}" />
                                            <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ Helpers::getDueDate123($data->intiation_date, true, 'Y-m-d') }}" class="hide-input" readonly />
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Due Date"> Due Date</label>
                                                <div><small class="text-primary">
                                                </small></div>
                                                <div class="calenderauditee">
                                                    <input disabled type="text" id="due_date" readonly placeholder="DD-MMM-YYYY"
                                                        value="{{ $data->due_date ? \Carbon\Carbon::parse($data->due_date)->format('d-M-Y') : '' }}" />
                                                    <input type="date" name="due_date"
                                                    {{ $data->stage == 0 || $data->stage >= 2 ? "disabled" : "" }}
                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                        value="{{ Helpers::getdateFormat($data->due_date) }}"
                                                        class="hide-input" oninput="handleDateInput(this, 'due_date')" />
                                                </div>
                                                {{-- <input type="text" id="due_date" name="due_date"
                                                    placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->due_date) }}"min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                                                <!-- <input type="date" name="due_date" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : ''}} min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" --> --}}

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
                                    </script>
                                    
                                    <style>
                                    .hide-input {
                                        display: none;
                                    }
                                    </style>

                                        <div class="col-lg-6">
                                            <div class="group-input" id="incident_interval_others_gi">
                                                <label for="incident_interval_others_gi">Name of Analyst<span
                                                        class="text-danger d-none">*</span></label>
                                                <!-- <textarea type="text" name="name_of_analyst" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }}>{{ $data->name_of_analyst }}</textarea> -->
                                                 <input type="text" name="name_of_analyst" value="{{ $data->name_of_analyst }}" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }}>
                                            </div>

                                        </div>


                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group"><b>Initiator Group</b><span class="text-danger">*</span></label>
                                        <select name="Initiator_Group" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }}
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
                                        <input type="text" id="initiator_group_code"  name="initiator_group_code" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }} value="{{$data->initiator_group_code}}" readonly>
                                    </div>
                                </div> --}}

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining

                                        <!-- <textarea name="short_desc"   id="docname" type="text"    maxlength="255" required  {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }}>{{ $data->short_desc }}</textarea> -->
                                         <input type="text" name="short_desc"   id="docname" type="text"    maxlength="255" required  {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }} value="{{ $data->short_desc }}">
                                    </div>
                                    <p id="docnameError" style="color:red">**Short Description is required</p>

                                </div>

                                 {{-- Table --}}




                                 <div class="col-12">
                                    <div class="group-input" id="IncidentRow">
                                        <label for="audit-incident-grid">
                                            Incident Investigation Report
                                            <button type="button" name="audit-incident-grid" id="IncidentAdd" {{ $data->stage == 0 || $data->stage >= 2 ? "disabled" : "" }}>+</button>
                                            <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>

                                        <table class="table table-bordered" id="onservation-incident-table">
                                            <thead>
                                                <tr>
                                                    <th>Row #</th>
                                                    <th>Name of Product</th>
                                                    <th>B No./A.R. No.</th>
                                                    <th>Remarks</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $serialNumber = 1;
                                                    $dataItems = is_array($report->data) ? $report->data : [];
                                                @endphp
                                                @foreach ($dataItems as $r)
                                                    <tr>
                                                        {{-- <td style="width: 6%"><input type="text" name="investrecord[0][s_no]" value="{{ $r['s_no']}}"> --}}
                                                        <td style="width: 6%">{{ $serialNumber++ }}</td>
                                                        <td><input type="text" {{ $data->stage == 0 || $data->stage >= 2 ? 'disabled' : '' }}
                                                                name="investrecord[{{ $loop->index }}][name_of_product]"
                                                                value="{{ $r['name_of_product'] }}">
                                                        </td>
                                                        <td><input type="text" {{ $data->stage == 0 || $data->stage >= 2 ? 'disabled' : '' }}
                                                                name="investrecord[{{ $loop->index }}][batch_no]" value="{{ $r['batch_no'] }}"></td>
                                                        <td><input type="text" {{ $data->stage == 0 || $data->stage >= 2 ? 'disabled' : '' }}
                                                                name="investrecord[{{ $loop->index }}][remarks]" value="{{ $r['remarks'] }}"></td>
                                                        <td><button {{ $data->stage == 0 || $data->stage >= 2 ? "disabled" : "" }} class="removeRowBtn">Remove</button></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

    
    
    
                  <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var selectField = document.getElementById('Facility_Equipment');
                        var inputsToToggle = [];
    
                        // Add elements with class 'facility-name' to inputsToToggle
                        var facilityNameInputs = document.getElementsByClassName('facility-name');
                        for (var i = 0; i < facilityNameInputs.length; i++) {
                            inputsToToggle.push(facilityNameInputs[i]);
                        }
    
                        // Add elements with class 'id-number' to inputsToToggle
                        var idNumberInputs = document.getElementsByClassName('id-number');
                        for (var j = 0; j < idNumberInputs.length; j++) {
                            inputsToToggle.push(idNumberInputs[j]);
                        }
    
                        // Add elements with class 'remarks' to inputsToToggle
                        var remarksInputs = document.getElementsByClassName('remarks');
                        for (var k = 0; k < remarksInputs.length; k++) {
                            inputsToToggle.push(remarksInputs[k]);
                        }
    
    
                        selectField.addEventListener('change', function() {
                            var isRequired = this.value === 'yes';
                            console.log(this.value, isRequired, 'value');
    
                            inputsToToggle.forEach(function(input) {
                                input.required = isRequired;
                                console.log(input.required, isRequired, 'input req');
                            });
    
                            document.getElementById('facilityRow').style.display = isRequired ? 'block' : 'none';
                            // Show or hide the asterisk icon based on the selected value
                            var asteriskIcon = document.getElementById('asteriskInvi');
                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                        });
                    });
                    </script>
    
    
    <script>
        $(document).ready(function() {
            let investdetails = 1;
            $('#IncidentAdd').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
    
                    var html =
                        '<tr>' +
                        '<td><input type="text"  name="investrecord[][s_no]" value="' + serialNumber +
                        '" disabled></td>' +
                        '<td><input type="text" name="investrecord['+ serialNumber +'][name_of_product]" value=""></td/>' +
                        '<td><input type="text" name="investrecord['+ serialNumber +'][batch_no]" value=""></td>' +
                        '<td><input type="text" name="investrecord['+ serialNumber +'][remarks]" value=""></td>' +
                        '<td><button class="removeRowBtn">Remove</button></td>' +
    
    
                        '</tr>';
    
                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }
    
                    html += '</select></td>' +
    
                        '</tr>';

                        investdetails++;
                    return html;
                }
    
                var tableBody = $('#onservation-incident-table tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
            $(document).on('click', '.removeRowBtn', function() {
        $(this).closest('tr').remove();
    });
        });
        </script>
    
    
    
    
    
                            {{-- new added table --}}

                        {{-- New Added --}}
                        <div class="col-lg-12">
                            <div class="group-input" id="incident_involved_others_gi">
                                <label for="incident_involved_others_gi">Instrument Involved<span
                                        class="text-danger d-none">*</span></label>
                                <textarea {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }} name="incident_involved_others_gi">{{ $data->incident_involved_others_gi }}</textarea>
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="group-input" id="stage_stage_gi">
                                <label for="stage_stage_gi">Stage<span
                                        class="text-danger d-none">*</span></label>
                                <input type="text" name="stage_stage_gi" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }} value="{{ $data->stage_stage_gi }}">
                            </div>

                        </div><br>

                        <div class="col-lg-4">                              
                            <div class="group-input" id="incident_stability_cond_gi">
                                <label for="incident_stability_cond_gi">Stability Condition (If Applicable)<span
                                        class="text-danger d-none">*</span></label>
                                <input type="text" name="incident_stability_cond_gi" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }} value="{{ $data->incident_stability_cond_gi }}">
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="group-input" id="incident_interval_others_gi">
                                <label for="incident_interval_others_gi">Interval (If Applicable)<span
                                        class="text-danger d-none">*</span></label>
                                <input type="text" name="incident_interval_others_gi" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }} value="{{ $data->incident_interval_others_gi }}">
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="group-input" id="test_gi">
                                <label for="test_gi">Test<span
                                        class="text-danger d-none">*</span></label>
                                <input type="text" name="test_gi" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }} value="{{ $data->test_gi }}" >
                            </div>

                        </div>
                          
                        
                        {{-- <div class="col-lg-6">
                            <div class="group-input" id="incident_date_analysis_gi">
                                <label for="incident_date_analysis_gi">Date of Analysis<span
                                        class="text-danger d-none">*</span></label>
                                <input type="date" name="incident_date_analysis_gi" id="incident_date_analysis_gi" value="{{ $data->incident_date_analysis_gi }}">
                            </div>

                        </div>
                        <script>
                            function formatDate(input) {
                                var dateValue = new Date(input.value);
                                var day = dateValue.getDate();
                                var month = dateValue.toLocaleString('default', { month: 'long' });
                                var year = dateValue.getFullYear();
                                var formattedDate = day + '-' + month + '-' + year;
                                input.value = formattedDate;
                            }
                        </script> --}}

                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Date Due"> Date Of Analysis</label>
                                <div><small class="text-primary">Please mention expected date of completion</small>
                                </div>
                                <div class="calenderauditee">
                                    <input type="text" id="incident_date_analysis_gi" readonly
                                        placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->incident_date_analysis_gi) }}"/>
                                    <input type="date" name="incident_date_analysis_gi" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }}  class="hide-input"
                                        oninput="handleDateInput(this, 'incident_date_analysis_gi')" />
                                </div>
                            </div>
                        </div>
                        

                        

                        <div class="col-lg-6">
                            <div class="group-input" id="incident_specification_no_gi">
                                <label for="Incident_specification_no">Specification Number<span
                                        class="text-danger d-none">*</span></label>
                                <input type="text" name="incident_specification_no_gi" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }} value="{{ $data->incident_specification_no_gi }}">
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" id="incident_stp_no_gi">
                                <label for="incident_stp_no_gi">STP Number<span
                                        class="text-danger d-none">*</span></label>
                                <input type="text" name="incident_stp_no_gi"  {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }} value="{{ $data->incident_stp_no_gi }}">
                            </div>

                        </div>

                        {{-- <div class="col-lg-6">
                            <div class="group-input" id="Incident_name_analyst_no_gi">
                                <label for="Incident_name_analyst_no">Name Of Analyst<span
                                        class="text-danger d-none">*</span></label>
                                <input type="text" name="Incident_name_analyst_no_gi" value="{{ $data->Incident_name_analyst_no_gi }}">
                            </div>

                        </div> --}}

                        {{-- <div class="col-lg-6">
                            <div class="group-input" id="incident_date_incidence_gi">
                                <label for="Incident_date_incidence">Date Of Incidence akash<span
                                        class="text-danger d-none">*</span></label>
                                <input type="date" name="incident_date_incidence_gi" value="{{ $data->incident_date_incidence_gi }}">
                            </div>

                        </div> --}}

                        <div class="col-lg-12 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Date Due">Date of Incidence</label>
                                <div><small class="text-primary">Please mention expected date of completion</small>
                                </div>
                                <div class="calenderauditee">
                                    <input type="text" id="incident_date_incidence_gi" readonly
                                        placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->incident_date_incidence_gi) }}"/>
                                    <input type="date" name="incident_date_incidence_gi" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }} class="hide-input"
                                        oninput="handleDateInput(this, 'incident_date_incidence_gi')" />
                                </div>
                            </div>
                        </div>
                        
                        

                        <div class="col-lg-12">
                            <div class="group-input" id="description_incidence_gi">
                                <label for="Description_incidence"> Description Of Incidence<span
                                        class="text-danger d-none">*</span></label>
                                <textarea name="description_incidence_gi" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }}>{{ $data->description_incidence_gi }}</textarea>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="group-input">
                                <label for="search">
                                    Reported By <span class="text-danger"></span>
                                </label>
                                <textarea name="analyst_sign_date_gi" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }}>{{ $data->analyst_sign_date_gi }}</textarea>
                                <!-- <select id="select-state" placeholder="Select..." name="analyst_sign_date_gi" {{ $data->stage == 0 || $data->stage >= 2 ? 'disabled' : '' }}>
                                    <option value="">Select a value</option> 
                                    @foreach ($users as $key => $value)
                                        <option value="{{ $value->id }}" @if ($data->analyst_sign_date_gi == $value->id) selected @endif>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @error('analyst_sign_date_gi')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror -->
                            </div>
                        </div>

                        {{-- <div class="col-md-6">
                            <div class="group-input">
                                <label for="search">
                                    Section Head Name <span class="text-danger"></span>
                                </label>
                                <select id="select-state" placeholder="Select..." name="section_sign_date_gi" {{ $data->stage == 0 || $data->stage >= 2 ? 'disabled' : '' }} onchange="markFieldAsChanged('section_sign_date_gi_changed')">
                                    <option value="">Select a value</option> 
                                    @foreach ($users as $key => $value)
                                        <option value="{{ $value->id }}" @if ($data->section_sign_date_gi == $value->id) selected @endif>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="hidden" id="section_sign_date_gi_changed" name="section_sign_date_gi_changed" value="0"> -->
                                @error('section_sign_date_gi')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="group-input">
                                <label for="search">
                                    QC Head/HOD Person <span class="text-danger"></span>
                                </label>
        
                                <!-- <textarea name="investigator_qc">{{ $data->investigator_qc }}</textarea> -->
        
                                <select id="select-state" placeholder="Select..." name="investigator_qc" {{ $data->stage == 0 || $data->stage >= 2 ? "disabled" : "" }}>
                                    <option value="">Select a value</option>
                                    @foreach ($users as $key=> $value)
                                        <option  @if ($data->investigator_qc == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @error('investigator_qc')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- <input type="hidden" name="investigator_qc" value="{{ $data->investigator_qc }}"> -->
                        
                        <script>
                            document.addEventListener('DOMContentLoaded', (event) => {
                                const originalValue = document.querySelector('#select-state').value;
                                document.querySelector('#section_sign_date_gi_changed').value = '0';
                            });
                        
                            function markFieldAsChanged(hiddenInputId) {
                                document.getElementById(hiddenInputId).value = '1';
                            }
                        </script>
                        
                        

                


                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="severity-level">Severity Level</label>
                                        <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span>
                                        <select name="severity_level2" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }} >
                                            <option value="0">-- Select --</option>
                                            <option @if ($data->severity_level2=='minor') selected @endif  value="minor">Minor</option>
                                            <option @if ($data->severity_level2=='major') selected @endif value="major">Major</option>
                                            <option @if ($data->severity_level2=='critical') selected @endif value="critical">Critical</option>
                                        </select>
                                    </div>
                                </div> --}}

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
                                            <div class="group-input" id="initiated_through_req1">
                                                <label for="Incident_Category_others">Others<span
                                                        class="text-danger d-none">*</span></label>
                                                <textarea name="Incident_Category_others" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }}>{{ $data->Incident_Category_others }}</textarea>
                                            </div>
                                        </div>
                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Invocation Type">Invocation Type</label>
                                        <select  name="Invocation_Type" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }}>
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1" @if ($data->Invocation_Type== '1') selected @endif>1
                                            </option>
                                            <option value="2" @if ($data->Invocation_Type== '2') selected @endif>2
                                            </option>
                                            <option value="3" @if ($data->Invocation_Type== '3') selected @endif>3
                                            </option>
                                        </select>
                                    </div>
                                </div> --}}

                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initial Attachments">Initial Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attachments_gi">
                                                @if ($data->attachments_gi)
                                                    @foreach (json_decode($data->attachments_gi) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }} type="file" id="attachments_gi" name="attachments_gi[]"
                                                    oninput="addMultipleFiles(this, 'attachments_gi')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="removed_files" id="removed_files">
                                
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeFileLinks = document.querySelectorAll('.remove-file');
                                        const removedFilesInput = document.getElementById('removed_files');
                                
                                        removeFileLinks.forEach(link => {
                                            link.addEventListener('click', function() {
                                                const fileName = this.getAttribute('data-file-name');
                                                this.parentElement.remove();
                                
                                                // Add the file name to the removed files input
                                                let removedFiles = removedFilesInput.value ? JSON.parse(removedFilesInput.value) : [];
                                                removedFiles.push(fileName);
                                                removedFilesInput.value = JSON.stringify(removedFiles);
                                            });
                                        });
                                    });
                                </script>
                                 --}}
                                {{-- --------------------------------by sunil  code file attchemnt  --}}
                                <!-- <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="attachments_gi">
                                        @if ($data->attachments_gi)
                                        @foreach(json_decode($data->attachments_gi) as $file)
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
                                        <input type="file" id="myfile" name="attachments_gi[]" value="{{$data->attachments_gi}}" oninput="addMultipleFiles(this, 'attachments_gi')" multiple>
                                    </div>
                                </div> -->
                                {{-- =======kkkkkuldeep --}}
                                
                                {{-- ====kkkk? --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Immediate_action">Immediate Action</label>
                                        <textarea name="immediate_action_ia" {{ $data->stage == 0 || $data->stage >= 2 ? "readonly" : "" }}>{{$data->immediate_action_ia}}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Attachments">Initial Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="attachments_gi">
                                                @if ($data->attachments_gi)
                                                    @foreach(json_decode($data->attachments_gi) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            <input type="hidden" name="existing_attachments_gi[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="attachments_gi[]" {{ $data->stage == 0 || $data->stage >= 2 ? "disabled" : "" }} oninput="addMultipleFiles(this, 'attachments_gi')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_attachments_gi" name="deleted_attachments_gi" value="">
                                
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
                                                    const deletedFilesInput = document.getElementById('deleted_attachments_gi');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });
                                </script>
                                
                               
                                
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="search">
                                        QA Reviewer <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="qc_review_to" {{ $data->stage == 0 || $data->stage >= 2 ? "disabled" : "" }}>
                                        <option value="">Select a value</option>
                                        @foreach ($users as $key=> $value)
                                            <option  @if ($data->qc_review_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('qc_review_to')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                <!-- <input type="hidden" name="qc_review_to" value="{{ $data->qc_review_to }}"> -->
                                </div>
                            </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input" id="immediate_date_ia">
                                        <label for="immediate_date_ia">Analyst Sign/Date akash mishra<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="date" name="immediate_date_ia" value="{{$data->immediate_date_ia}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input" id="section_date_ia">
                                        <label for="section_date_ia">Section Head Sign/Date<span
                                                class="text-danger d-none">*</span></label>
                                        <input type="date" name="section_date_ia" value="{{$data->section_date_ia}}">
                                    </div>
                                </div> --}}
                              


                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton" {{ $data->stage == 0 || $data->stage >= 2 ? "disabled" : "" }}>Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

                    <!-- <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Immediate_action">Immediate Action</label>
                                        <textarea name="immediate_action_ia" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>{{$data->immediate_action_ia}}</textarea>
                                    </div>
                                </div>
                                
                               <div class="col-12">
                                <div class="group-input">
                                    <label for="detail investigation ">Detail Investigation / Probable Root Cause</label>
                                <textarea name="details_investigation_ia" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>{{$data->details_investigation_ia}}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="proposed corrective action ">Proposed Corrective Action/Corrective Action Taken</label>
                            <textarea name="proposed_correctivei_ia" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>{{$data->proposed_correctivei_ia}}</textarea>
                        </div>
                     </div>


                     <div class="col-12">
                        <div class="group-input">
                            <label for="Repeat Analysis Plan ">Repeat Analysis Plan</label>
                        <textarea name="repeat_analysis_plan_ia" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>{{$data->repeat_analysis_plan_ia}}</textarea>
                      </div>
                         </div>


                <div class="col-12">
                    <div class="group-input">
                        <label for="Result Of Repeat Analysis ">Result Of Repeat Analysis</label>
                    <textarea name="result_of_repeat_analysis_ia" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>{{$data->result_of_repeat_analysis_ia}}</textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Corrective and Preventive Action">Corrective and Preventive Action</label>
                <textarea name="corrective_and_preventive_action_ia" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>{{$data->corrective_and_preventive_action_ia}}</textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="group-input">
                <label for="CAPA Number">CAPA Number</label>
            <input type="text" name="capa_number_im" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }} value="{{$data->capa_number_im}}">
        </div>
         </div>

         <div class="col-12">
            <div class="group-input">
                <label for="Investigation Summary">Investigation Summary</label>
            <textarea name="investigation_summary_ia" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>{{$data->investigation_summary_ia}}</textarea>
        </div>
    </div>




    <div class="col-lg-12">
        <div class="group-input">
            <label for="Type Of Incidence"><b>Type of Incidence</b></label>
            <select name="type_incidence_ia" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }} id="type_incidence">
                <option value="">-- Select --</option>
                <option value="Analyst Error" {{ $data->type_incidence_ia == 'Analyst Error' ? 'selected' : '' }}>Analyst Error</option>
                <option value="Instrument Error" {{ $data->type_incidence_ia == 'Instrument Error' ? 'selected' : '' }}>Instrument Error</option>
                <option value="Atypical Error" {{ $data->type_incidence_ia == 'Atypical Error' ? 'selected' : '' }}>Atypical Error</option>
                <option value="Other" {{ $data->type_incidence_ia == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
    </div>
    
    <div class="col-lg-12" id="other_incidence_div" style="display: none;">
        <div class="group-input">
            <label for="Other Incidence"><b>Other Incidence</b></label>
            <input type="text" name="other_incidence" id="other_incidence" value="{{ $data->other_incidence ?? '' }}" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }} />
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeIncidenceSelect = document.getElementById('type_incidence');
            const otherIncidenceDiv = document.getElementById('other_incidence_div');
    
            function toggleOtherIncidence() {
                if (typeIncidenceSelect.value === 'Other') {
                    otherIncidenceDiv.style.display = 'block';
                } else {
                    otherIncidenceDiv.style.display = 'none';
                }
            }
    
            typeIncidenceSelect.addEventListener('change', toggleOtherIncidence);
    
            toggleOtherIncidence();
        });
    </script>
    

                
                <div class="col-md-6">
                    <div class="group-input">
                        <label for="search">
                            Investigator(QC) <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="investigator_qc" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>
                            <option value="">Select a value</option>
                            @foreach ($users as $key=> $value)
                                <option  @if ($data->investigator_qc == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        @error('investigator_qc')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="group-input">
                        <label for="search">
                            QC Review <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="qc_review_to" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>
                            <option value="">Select a value</option>
                            @foreach ($users as $key=> $value)
                                <option  @if ($data->qc_review_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        @error('qc_review_to')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>



                <div class="col-12">
                    <div class="group-input">
                        <label for="Attachments">Attachments</label>
                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                        <div class="file-attachment-field">
                            <div class="file-attachment-list" id="attachments_ia">
                                @if ($data->attachments_ia)
                                    @foreach (json_decode($data->attachments_ia) as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                            <input type="hidden" name="existing_attachments_ia[]" value="{{ $file }}">
                                        </h6>
                                    @endforeach
                                @endif
                            </div>
                            <div class="add-btn">
                                <div>Add</div>
                                <input {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }} type="file" id="attachments_ia" name="attachments_ia[]"
                                    oninput="addMultipleFiles(this, 'attachments_ia')" multiple>
                            </div>
                        </div>
                    </div>
                </div>
                
                <input type="hidden" id="deleted_attachments_ia" name="deleted_attachments_ia" value="">
                
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const removeButtons = document.querySelectorAll('.remove-file');
                
                        removeButtons.forEach(button => {
                            button.addEventListener('click', function() {
                                const fileName = this.getAttribute('data-file-name');
                                const fileContainer = this.closest('.file-container');
                
                                if (fileContainer) {
                                    fileContainer.style.display = 'none';
                                    const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                                    if (hiddenInput) {
                                        hiddenInput.remove();
                                    }
                
                                    const deletedFilesInput = document.getElementById('deleted_attachments_ia');
                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                    deletedFiles.push(fileName);
                                    deletedFilesInput.value = deletedFiles.join(',');
                                }
                            });
                        });
                    });
                </script>
                

                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
                            </div>
                        </div>
                    </div> -->

                     {{-- extension --}}
                    



                  

              

                  
                    <!-- QA Review content -->
                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                            <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Review Comments">QC Head Review Comments @if($data->stage == 2)<span class="text-danger">*</span>@endif</label>
                                        <textarea name="QA_Review_Comments" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>{{ $data->QA_Review_Comments }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Head Attachments">QC Head Review Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="QA_Head_Attachment">
                                                @if ($data->QA_Head_Attachment)
                                                    @foreach (json_decode($data->QA_Head_Attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            <input type="hidden" name="existing_QA_Head_Attachment[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "disabled" : "" }} type="file" id="myfile" name="QA_Head_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'QA_Head_Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_QA_Head_Attachment" name="deleted_QA_Head_Attachment" value="">
                                
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
                                                    const deletedFilesInput = document.getElementById('deleted_QA_Head_Attachment');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });
                                </script>
                                
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "disabled" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

{{-- ---------------QA Initial Review--------- --}}
<div id="CCForm12" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">

        <!-- <div class="col-lg-12">
                    <div class="group-input">
                        <label for="search">
                            QA Initial Review Person <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="qa_initial_person" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>
                            <option value="">--Select--</option>
                            @foreach ($users as $key=> $value)
                                <option  @if ($data->qa_initial_person == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        @error('qa_initial_person')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div> -->

            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Incident Category">QA Initial Review Comments @if($data->stage==3)<span class="text-danger">*</span>   
                    @endif</label>
                    <textarea name="QA_initial_Comments" {{ $data->stage <= 2 || $data->stage >= 4 ? "readonly" : "" }}>{{ $data->QA_initial_Comments }}</textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="QA Head Attachments">QA Initial Review Attachments</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="QA_Initial_Attachment">
                            @if ($data->QA_Initial_Attachment)
                                @foreach(json_decode($data->QA_Initial_Attachment) as $file)
                                    <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                        <b>{{ $file }}</b>
                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                        <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                        <input type="hidden" name="existing_QA_Initial_Attachment[]" value="{{ $file }}">
                                    </h6>
                                @endforeach
                            @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="QA_Initial_Attachment[]" {{ $data->stage <= 2 || $data->stage >= 4 ? "disabled" : "" }} oninput="addMultipleFiles(this, 'QA_Initial_Attachment')" multiple>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Hidden field to keep track of files to be deleted -->
            <input type="hidden" id="deleted_QA_Initial_Attachment" name="deleted_QA_Initial_Attachment" value="">
            
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
                                const deletedFilesInput = document.getElementById('deleted_QA_Initial_Attachment');
                                let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                deletedFiles.push(fileName);
                                deletedFilesInput.value = deletedFiles.join(',');
                            }
                        });
                    });
                });
            </script>
            
        </div>
        <div class="button-block">
            <button type="submit" class="saveButton" {{ $data->stage <= 2 || $data->stage >= 4 ? "disabled" : "" }}>Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
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
                                        <label for="Investigation Details ">Investigation Details @if($data->stage==4)<span class="text-danger">*</span>   
                                            @endif</label>
                                        <textarea name="Investigation_Details" {{ $data->stage <= 3 || $data->stage >= 5 ? "readonly" : "" }}>{{ $data->Investigation_Details }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Action Taken">Action Taken</label>
                                        <textarea name="Action_Taken" {{ $data->stage <= 3 || $data->stage >= 5 ? "readonly" : "" }}>{{ $data->Action_Taken }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Root Cause">Root Cause</label>
                                        <textarea name="Root_Cause" {{ $data->stage <= 3 || $data->stage >= 5 ? "readonly" : "" }}>{{ $data->Root_Cause }}</textarea>
                                    </div>
                                </div>



                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">Inv Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Inv_Attachment">
                                                @if ($data->Inv_Attachment)
                                                    @foreach (json_decode($data->Inv_Attachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            <input type="hidden" name="existing_Inv_Attachment[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage <= 3 || $data->stage >= 5 ? "disabled" : "" }} type="file" id="myfile" name="Inv_Attachment[]"
                                                    oninput="addMultipleFiles(this, 'Inv_Attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_Inv_Attachment" name="deleted_Inv_Attachment" value="">
                                
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
                                                    const deletedFilesInput = document.getElementById('deleted_Inv_Attachment');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                                    deletedFiles.push(fileName);
                                                    deletedFilesInput.value = deletedFiles.join(',');
                                                }
                                            });
                                        });
                                    });
                                </script>

                                <div class="col-12">
                                <div class="group-input">
                                    <label for="detail investigation ">Detail Investigation / Probable Root Cause</label>
                                <textarea name="details_investigation_ia" {{ $data->stage <= 3 || $data->stage >= 5 ? "readonly" : "" }}>{{$data->details_investigation_ia}}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="proposed corrective action ">Proposed Corrective Action/Corrective Action Taken</label>
                            <textarea name="proposed_correctivei_ia" {{ $data->stage <= 3 || $data->stage >= 5 ? "readonly" : "" }}>{{$data->proposed_correctivei_ia}}</textarea>
                        </div>
                     </div>


                     <div class="col-12">
                        <div class="group-input">
                            <label for="Repeat Analysis Plan ">Repeat Analysis Plan</label>
                        <textarea name="repeat_analysis_plan_ia" {{ $data->stage <= 3 || $data->stage >= 5 ? "readonly" : "" }}>{{$data->repeat_analysis_plan_ia}}</textarea>
                      </div>
                         </div>


                          {{-- selection field --}}
                
                          
                         
                {{-- selection field --}}
                <div class="col-12">
                    <div class="group-input">
                        <label for="Result Of Repeat Analysis ">Result Of Repeat Analysis</label>
                    <textarea name="result_of_repeat_analysis_ia" {{ $data->stage <= 3 || $data->stage >= 5 ? "readonly" : "" }}>{{$data->result_of_repeat_analysis_ia}}</textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Corrective and Preventive Action">Corrective and Preventive Action</label>
                <textarea name="corrective_and_preventive_action_ia" {{ $data->stage <= 3 || $data->stage >= 5 ? "readonly" : "" }}>{{$data->corrective_and_preventive_action_ia}}</textarea>
            </div>
        </div>
        <div class="col-12">
            <div class="group-input">
                <label for="CAPA Number">CAPA Number</label>
            <input type="text" name="capa_number_im" {{ $data->stage <= 3 || $data->stage >= 5 ? "readonly" : "" }} value="{{$data->capa_number_im}}">
        </div>
         </div>

         <div class="col-12">
            <div class="group-input">
                <label for="Investigation Summary">Investigation Summary</label>
            <textarea name="investigation_summary_ia" {{ $data->stage <= 3 || $data->stage >= 5 ? "readonly" : "" }}>{{$data->investigation_summary_ia}}</textarea>
        </div>
    </div>



    {{-- type of incidence --}}

    {{-- <div class="col-lg-12">
        <div class="group-input">
            <label for="Type Of Incidence"><b>Type Of Incidence</b></label>
            <select name="type_incidence_ia" {{ $data->stage <= 3 || $data->stage >= 5 ? "readonly" : "" }} id="initiator_group">
                <option value="NA" {{ $data->type_incidence_ia == '0' ? 'selected' : '' }}>-- Select --</option>
                <option value="Analyst Error" {{ $data->type_incidence_ia == 'Analyst Error' ? 'selected' : '' }}>Analyst Error</option>
                <option value="Instrument Error" {{ $data->type_incidence_ia == 'Instrument Error' ? 'selected' : '' }}>Instrument Error</option>
                <option value="Atypical Error" {{ $data->type_incidence_ia == 'Atypical Error' ? 'selected' : '' }}>Atypical Error</option>
                {{-- <option value="" {{ $data->type_incidence_ia == 'Atypical Error' ? 'selected' : '' }}>Atypical Error</option> --}}

            {{-- </select>
        </div>
    </div>  --}}



    <div class="col-lg-12">
        <div class="group-input">
            <label for="Type Of Incidence"><b>Type of Incidence</b></label>
            <select name="type_incidence_ia" id="type_incidence" @if ($data->stage <= 3 || $data->stage >= 5) disabled @endif>
                <option value="">-- Select --</option>
                <option value="Analyst Error" {{ $data->type_incidence_ia == 'Analyst Error' ? 'selected' : '' }}>Analyst Error</option>
                <option value="Instrument Error" {{ $data->type_incidence_ia == 'Instrument Error' ? 'selected' : '' }}>Instrument Error</option>
                <option value="Atypical Error" {{ $data->type_incidence_ia == 'Atypical Error' ? 'selected' : '' }}>Atypical Error</option>
                <option value="Other" {{ $data->type_incidence_ia == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
    </div>
    
    <div class="col-lg-12" id="other_incidence_div" style="display: none;">
        <div class="group-input">
            <label for="Other Incidence"><b>Other Incidence</b></label>
            <input type="text" name="other_incidence" id="other_incidence" value="{{ $data->other_incidence ?? '' }}" {{ $data->stage <= 3 || $data->stage >= 5 ? "readonly" : "" }} />
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeIncidenceSelect = document.getElementById('type_incidence');
            const otherIncidenceDiv = document.getElementById('other_incidence_div');
    
            function toggleOtherIncidence() {
                if (typeIncidenceSelect.value === 'Other') {
                    otherIncidenceDiv.style.display = 'block';
                } else {
                    otherIncidenceDiv.style.display = 'none';
                }
            }
    
            typeIncidenceSelect.addEventListener('change', toggleOtherIncidence);
    
            // Initial check on page load
            toggleOtherIncidence();
        });
    </script>
    
    
    {{-- type of incidence --}}


                {{-- selection field --}}
                
             
                 {{-- <div class="col-md-4">
                    <div class="group-input">
                        <label for="search">
                            QC Approved By <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="qc_approved_to" {{ $data->stage <= 3 || $data->stage >= 5 ? "readonly" : "" }}>
                            <option value="">Select a value</option>
                            @foreach ($users as $key=> $value)
                                <option  @if ($data->qc_approved_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        @error('qc_approved_to')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div> --}}

                {{-- selection field --}}
                <div class="col-md-6">
                    <div class="group-input">
                        <label for="search">
                            QC Investigator <span class="text-danger"></span>
                        </label>
                            <textarea name="investigator_data" id="" {{ $data->stage <= 3 || $data->stage >= 5 ? "readonly" : "" }}>{{ $data->investigator_data }}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="group-input">
                        <label for="search">
                            QC Review <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="qc_review_data" {{ $data->stage <= 3 || $data->stage >= 5 ? "disabled" : "" }}>
                            <option value="">Select a value</option>
                            @foreach ($users as $key=> $value)
                                <option  @if ($data->qc_review_data == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        <!-- <input type="hidden" name="qc_review_data" value="{{ $data->qc_review_data }}"> -->
                        @error('qc_review_data')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="group-input">
                        <label for="Attachments">Immidiate Action Attachments</label>
                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                        <div class="file-attachment-field">
                            <div class="file-attachment-list" id="attachments_ia">
                                @if ($data->attachments_ia)
                                    @foreach (json_decode($data->attachments_ia) as $file)
                                        <h6 type="button" class="file-container text-dark"
                                            style="background-color: rgb(243, 242, 240);">
                                            <b>{{ $file }}</b>
                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                            <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                            <input type="hidden" name="existing_attachments_ia[]" value="{{ $file }}">
                                        </h6>
                                    @endforeach
                                @endif
                            </div>
                            <div class="add-btn">
                                <div>Add</div>
                                <input {{ $data->stage <= 3 || $data->stage >= 5 ? "disabled" : "" }} type="file" id="attachments_ia" name="attachments_ia[]"
                                    oninput="addMultipleFiles(this, 'attachments_ia')" multiple>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Hidden field to keep track of files to be deleted -->
                <input type="hidden" id="deleted_attachments_ia" name="deleted_attachments_ia" value="">
                
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
                                    const deletedFilesInput = document.getElementById('deleted_attachments_ia');
                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                    deletedFiles.push(fileName);
                                    deletedFilesInput.value = deletedFiles.join(',');
                                }
                            });
                        });
                    });
                </script>
                

                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage <= 3 || $data->stage >= 5 ? "disabled" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div>

{{-- -------------------------------Pending Initiator Update---------------------- --}}

<!-- <div id="CCForm13" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Incident Category">Pending Initiator Update Comments</label>
                    <textarea name="pending_update_Comments">{{ $data->pending_update_Comments }}</textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="QA Head Attachments">Pending Initiator Update Attachments</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="pending_update_Attachment">
                            @if ($data->pending_update_Attachment)
                                @foreach(json_decode($data->pending_update_Attachment) as $file)
                                    <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                        <b>{{ $file }}</b>
                                        <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                            <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                        </a>
                                        <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                            <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                        </a>
                                        <input type="hidden" name="existing_pending_update_Attachment[]" value="{{ $file }}">
                                    </h6>
                                @endforeach
                            @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="pending_update_Attachment[]" 
                                   oninput="addMultipleFiles(this, 'pending_update_Attachment')" multiple>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <input type="hidden" id="deleted_pending_update_Attachment" name="deleted_pending_update_Attachment" value="">
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const removeButtons = document.querySelectorAll('.remove-file');
        
                removeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const fileName = this.getAttribute('data-file-name');
                        const fileContainer = this.closest('.file-container');
        
                        if (fileContainer) {
                            fileContainer.style.display = 'none';

                            const hiddenInput = fileContainer.querySelector('input[type="hidden"]');
                            if (hiddenInput) {
                                hiddenInput.remove();
                            }
        
                            const deletedFilesInput = document.getElementById('deleted_pending_update_Attachment');
                            let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                            deletedFiles.push(fileName);
                            deletedFilesInput.value = deletedFiles.join(',');
                        }
                    });
                });
            });
        </script>
        <div class="button-block">
            <button type="submit" class="saveButton">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
        </div>
    </div>
</div> -->
{{-- ---------------------------------------QC Head/HOD Secondary Review------------------------------------------------ --}}
<div id="CCForm14" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">

        <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Incident Category">Incident Category</label>
                                        <select {{ $data->stage <= 4 || $data->stage >= 6 ? "disabled" : "" }} name="Incident_Category" id="Incident_Category_data">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="Analyst Error" @if ($data->Incident_Category== 'Analyst Error') selected @endif>
                                                Analyst Error
                                            </option>
                                            <option value="Instrument Error" @if ($data->Incident_Category== 'Instrument Error') selected @endif>
                                                Instrument Error
                                            </option>
                                            <option value="Atypical Error" @if ($data->Incident_Category== 'Atypical Error') selected @endif>
                                                Atypical Error
                                            </option>
                                            <option value="Other" @if ($data->Incident_Category== 'Other') selected @endif>
                                                Other
                                            </option>
                                        </select>
                                        <!-- <input type="hidden" name="Incident_Category" value="{{ $data->Incident_Category }}"> -->
                                    </div>
                                </div>

                                <div class="col-lg-12" id="other_incidence_data" style="display: none;">
                                    <div class="group-input">
                                        <label for="Other Incidence"><b>Other Incident Category</b></label>
                                        <input type="text" name="other_incidence_data" id="other_incidence_data" value="{{ $data->other_incidence_data ?? '' }}" {{ $data->stage <= 4 || $data->stage >= 6 ? "readonly" : "" }} />
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const typeIncidenceSelect = document.getElementById('Incident_Category_data');
                                        const otherIncidenceDiv = document.getElementById('other_incidence_data');
                                
                                        function toggleOtherIncidence() {
                                            if (typeIncidenceSelect.value === 'Other') {
                                                otherIncidenceDiv.style.display = 'block';
                                            } else {
                                                otherIncidenceDiv.style.display = 'none';
                                            }
                                        }
                                
                                        typeIncidenceSelect.addEventListener('change', toggleOtherIncidence);
                                
                                        // Initial check on page load
                                        toggleOtherIncidence();
                                    });
                                </script>
        <!-- <div class="col-lg-12">
                    <div class="group-input">
                        <label for="search">
                            QC Head/HOD Person <span class="text-danger"></span>
                        </label>
                        <select id="select-state" placeholder="Select..." name="qc_head" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>
                            <option value="">--Select--</option>
                            @foreach ($users as $key=> $value)
                                <option  @if ($data->qc_head == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                        @error('qc_head')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div> -->
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Incident Category">QC Head/HOD Secondary Review Comments  @if($data->stage==5)<span class="text-danger">*</span>
                        
                        @endif</label>
                    <textarea name="QC_head_hod_secondry_Comments" {{ $data->stage <= 4 || $data->stage >= 6 ? "readonly" : "" }}>{{ $data->QC_head_hod_secondry_Comments }}</textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="QA Head Attachments">QC Head/HOD Secondary Review Attachments</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="QC_headhod_secondery_Attachment">
                            @if ($data->QC_headhod_secondery_Attachment)
                                @foreach(json_decode($data->QC_headhod_secondery_Attachment) as $file)
                                    <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                        <b>{{ $file }}</b>
                                        <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                            <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                        </a>
                                        <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                            <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                        </a>
                                        <input type="hidden" name="existing_QC_headhod_secondery_Attachment[]" value="{{ $file }}">
                                    </h6>
                                @endforeach
                            @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="QC_headhod_secondery_Attachment[]" 
                                   oninput="addMultipleFiles(this, 'QC_headhod_secondery_Attachment')" {{ $data->stage <= 4 || $data->stage >= 6 ? "disabled" : "" }} multiple>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Hidden field to keep track of files to be deleted -->
        <input type="hidden" id="deleted_QC_headhod_secondery_Attachment" name="deleted_QC_headhod_secondery_Attachment" value="">
        
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
                            const deletedFilesInput = document.getElementById('deleted_QC_headhod_secondery_Attachment');
                            let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                            deletedFiles.push(fileName);
                            deletedFilesInput.value = deletedFiles.join(',');
                        }
                    });
                });
            });
        </script>
        <div class="button-block">
            <button type="submit" class="saveButton" {{ $data->stage <= 4 || $data->stage >= 6 ? "disabled" : "" }}>Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
        </div>
    </div>
</div>
                    {{-- ---------------------------------------QA Secondary Review----------------------------------------------- --}}
<div id="CCForm15" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Incident Category">QA Secondary Review Comments @if($data->stage==6)<span class="text-danger">*</span>
                        
                        @endif</label></label>
                    <textarea name="QA_secondry_Comments" {{ $data->stage <= 5 || $data->stage >= 7 ? "readonly" : "" }}>{{ $data->QA_secondry_Comments }}</textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="QA Head Attachments">QA Secondary Review Attachments</label>
                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="QA_secondery_Attachment">
                            @if ($data->QA_secondery_Attachment)
                                @foreach(json_decode($data->QA_secondery_Attachment) as $file)
                                    <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                        <b>{{ $file }}</b>
                                        <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                            <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                        </a>
                                        <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                            <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                        </a>
                                        <input type="hidden" name="existing_QA_secondery_Attachment[]" value="{{ $file }}">
                                    </h6>
                                @endforeach
                            @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="QA_secondery_Attachment[]" 
                                   oninput="addMultipleFiles(this, 'QA_secondery_Attachment')" {{ $data->stage <= 5 || $data->stage >= 7 ? "disabled" : "" }} multiple>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Hidden field to keep track of files to be deleted -->
        <input type="hidden" id="deleted_QA_secondery_Attachment" name="deleted_QA_secondery_Attachment" value="">
        
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
                            const deletedFilesInput = document.getElementById('deleted_QA_secondery_Attachment');
                            let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                            deletedFiles.push(fileName);
                            deletedFilesInput.value = deletedFiles.join(',');
                        }
                    });
                });
            });
        </script>
        <div class="button-block">
            <button type="submit" class="saveButton" {{ $data->stage <= 5 || $data->stage >= 7 ? "disabled" : "" }}>Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit </a> </button>
        </div>
    </div>
</div>



                    <!-- QA Head/Designee Approval content -->
                    <!-- <div id="CCForm6" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12 sub-head">
                                    Closure
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="QA Head/Designee Comments">QA Head/Designee Comments</label>
                                        <textarea name="QA_Head" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>{{ $data->QA_Head }}</textarea>
                                    </div>
                                </div>
                            <div class="col-lg-6">
                               
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Conclusion">Conclusion</label>
                                        <textarea name="Conclusion"{{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }} >{{ $data->Conclusion }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 sub-head">
                                    Extension Justification
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="due_date_extension">Due Date Extension Justification</label>
                                        <div><small class="text-primary">Please Mention justification if due date is crossed</small></div>
                                  
                                        <textarea name="due_date_extension" id="duedoc" type="text" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>{{$data->due_date_extension}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div> -->

                <div id="CCForm11" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="closure_incident">Closure of Incident</label>
                                    <input type="text" name="closure_incident_c" {{ $data->stage <= 6 || $data->stage >= 8 ? "readonly" : "" }}  value="{{$labnew->closure_incident_c}}">
                                </div>

                            </div>

                            <!-- <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="head remark"><b>QC Head Remark</b></label>
                                   <textarea name="qc_hear_remark_c" {{ $data->stage <= 6 || $data->stage >= 8 ? "readonly" : "" }}>{{$labnew->qc_hear_remark_c}}</textarea>
                                </div>
                            </div>

                        <div class="col-md-6">
                            <div class="group-input">
                                <label for="search">
                                    QC Head Closure <span class="text-danger"></span>
                                </label>
                                <select id="select-state" placeholder="Select..." name="qc_head_closure" {{ $data->stage <= 6 || $data->stage >= 8 ? "readonly" : "" }}>
                                    <option value="">--Select--</option>
                                    @foreach ($users as $value)
                                        <option @if ($data->qc_head_closure == $value->id) selected @endif value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                                @error('qc_head_closure')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div> -->


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for=" qa head remark"><b>QA Head Comment</b> @if($data->stage==7)<span class="text-danger">*</span>   
                                @endif</label>
                               <textarea name="qa_hear_remark_c" {{ $data->stage <= 6 || $data->stage >= 8 ? "readonly" : "" }}>{{$labnew->qa_hear_remark_c}}</textarea>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="closure_attachment_c">Closure Attachment</label>
                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="closure_attachment_c">
                                        @if ($labnew->closure_attachment_c)
                                            @foreach (json_decode($labnew->closure_attachment_c) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i></a>
                                                    <a type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                    <input type="hidden" name="existing_closure_attachment_c[]" value="{{ $file }}">
                                                </h6>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input {{ $data->stage <= 6 || $data->stage >= 8 ? "disabled" : "" }} type="file" id="closure_attachment_c" name="closure_attachment_c[]"
                                            oninput="addMultipleFiles(this, 'closure_attachment_c')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" id="deleted_closure_attachment_c" name="deleted_closure_attachment_c" value="">
                        
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
                                            const deletedFilesInput = document.getElementById('deleted_closure_attachment_c');
                                            let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
                                            deletedFiles.push(fileName);
                                            deletedFilesInput.value = deletedFiles.join(',');
                                        }
                                    });
                                });
                            });
                        </script>
                        

                        <div class="button-block">
                            <button type="submit" class="saveButton" {{ $data->stage <= 6 || $data->stage >= 8 ? "disabled" : "" }}>Save</button>
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
                              
                                <div class="col-12 sub-head" style="font-size: 16px">
                                    Submitted
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submitted By">Submitted By</label>
                                        <div class="static">{{ $data->submitted_by }}</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Submitted On">Submitted On</label>
                                        <div class="Date">{{ $data->submitted_on }}</div>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static" >{{$data->comment}}</div>
                                    </div>
                                </div>
                            
                                <div class="col-12 sub-head"  style="font-size: 16px">
                                    QA Head/HOD Initial Review 
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Verification Complete">QA Head/HOD Initial Review Complete By</label>
                                        <div class="static">{{ $data->verification_complete_completed_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Incident Review Completed On">QA Head/HOD Initial Review Complete On</label>
                                        <div class="Date">{{ $data->verification_completed_on }}</div>
                                    </div>
                                </div>
                                {{-- @foreach($detail as $d) --}}
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static">{{$data->verification_complete_comment}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Verification Complete">More Info Required By</label>
                                        <div class="static">{{ $data->more_info_req_1_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Incident Review Completed On">More Info Required On</label>
                                        <div class="Date">{{ $data->more_info_req_1_on }}</div>
                                    </div>
                                </div>
                                {{-- @foreach($detail as $d) --}}
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static">{{$data->more_info_req_1_comment}}</div>
                                    </div>
                                </div>
                                {{-- @endforeach --}}
                                <div class="col-12 sub-head"  style="font-size: 16px">
                                    QA Initial Review
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Investigation Completed By">QA Initial Review Complete By</label>
                                        <div class="static">{{ $data->preliminary_completed_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Investigation Completed On">QA Initial Review Complete On</label>
                                        <div class="Date">{{ $data->preliminary_completed_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static">{{$data->preliminary_completed_comment}}</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Verification Complete">More Info Required By</label>
                                        <div class="static">{{ $data->more_info_req_2_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Incident Review Completed On">More Info Required On</label>
                                        <div class="Date">{{ $data->more_info_req_2_on }}</div>
                                    </div>
                                </div>
                                {{-- @foreach($detail as $d) --}}
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static">{{$data->more_info_req_2_comment}}</div>
                                    </div>
                                </div>

                                <div class="col-12 sub-head"  style="font-size: 16px">
                                    Pending Initiator Update
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Assignable Cause Identification Completed">Pending Initiator Update Complete By</label>
                                        <div class="static">{{ $data->all_activities_completed_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Assignable Cause Identification Completed">Pending Initiator Update Complete On</label>
                                        <div class="Date">{{ $data->all_activities_completed_on }}</div>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6"> --}}
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static">{{$data->all_activities_completed_comment}}</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Verification Complete">More Info Required By</label>
                                        <div class="static">{{ $data->more_info_req_3_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Incident Review Completed On">More Info Required On</label>
                                        <div class="Date">{{ $data->more_info_req_3_on }}</div>
                                    </div>
                                </div>
                                {{-- @foreach($detail as $d) --}}
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static">{{$data->more_info_req_3_comment}}</div>
                                    </div>
                                </div>

                                <div class="col-12 sub-head"  style="font-size: 16px">
                                    QC Head/HOD Secondary Review
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="No Assignable Completed By">QC Head/HOD Secondary Review Complete By</label>
                                        <div class="static">{{$data->review_completed_by}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="No Assignable Completed On">QC Head/HOD Secondary Review Complete On</label>
                                        <div class="Date">{{$data->review_completed_on}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static">{{$data->solution_validation_comment}}</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Verification Complete">More Info Required By</label>
                                        <div class="static">{{ $data->more_info_req_4_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Incident Review Completed On">More Info Required On</label>
                                        <div class="Date">{{ $data->more_info_req_4_on }}</div>
                                    </div>
                                </div>
                                {{-- @foreach($detail as $d) --}}
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static">{{$data->more_info_req_4_comment}}</div>
                                    </div>
                                </div>

                                <div class="col-12 sub-head"  style="font-size: 16px">
                                    QA Secondary Review
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Extended Inv Completed By">QA Secondry Review Complete By</label>
                                        <div class="static">{{$data->extended_inv_complete_by}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Extended Inv Completed On">QA Secondry Review Complete On</label>
                                        <div class="Date">{{$data->extended_inv_complete_on}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static">{{$data->extended_inv_comment}}</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Verification Complete">More Info Required By</label>
                                        <div class="static">{{ $data->more_info_req_5_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Incident Review Completed On">More Info Required On</label>
                                        <div class="Date">{{ $data->more_info_req_5_on }}</div>
                                    </div>
                                </div>
                                {{-- @foreach($detail as $d) --}}
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static">{{$data->more_info_req_5_comment}}</div>
                                    </div>
                                </div>

                                <div class="col-12 sub-head"  style="font-size: 16px">
                                    QAH Approval 
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Solution Validation Completed By">Approved By</label>
                                        <div class="static">{{$data->no_assignable_cause_by}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Solution Validation Completed On">Approved On</label>
                                        <div class="Date">{{$data->no_assignable_cause_on}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static">{{$data->no_assignable_cause_comment}}</div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Verification Complete">More Info Required By</label>
                                        <div class="static">{{ $data->more_info_req_6_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Incident Review Completed On">More Info Required On</label>
                                        <div class="Date">{{ $data->more_info_req_6_on }}</div>
                                    </div>
                                </div>
                                {{-- @foreach($detail as $d) --}}
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static">{{$data->more_info_req_6_comment}}</div>
                                    </div>
                                </div>

                                <div class="col-12 sub-head"  style="font-size: 16px">
                                    Cancel
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Cancelled By">Cancel By</label>
                                        <div class="static">{{ $data->cancelled_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Cancelled On">Cancel On</label>
                                        <div class="Date">{{ $data->cancelled_on }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="group-input">
                                        <label for="Comment">Comment</label>
                                        <div class="static">{{$data->cancell_comment}}</div>
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
                                <!-- <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 1 || $data->stage >= 3 ? "readonly" : "" }}>Save</button> -->
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <!-- <button type="submit" {{ $data->stage == 0 || $data->stage == 8 ? "readonly" : "" }}>Submit</button> -->
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

    <div class="modal fade" id="back-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('StageChangeLabtwo', $data->id) }}" method="POST">
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

    <div class="modal fade" id="root-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('StageChangeLabcancel', $data->id) }}" method="POST">
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
                            <input class="input_width" type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password  <span
                                class="text-danger">*</span></label>
                            <input class="input_width" type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input class="input_width" type="comment" name="comment">
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

    <div class="modal fade" id="signature-modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('StageChangeLabtwo', $data->id) }}" method="POST">
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
                            <input class="input_full_width" type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password  <span
                                class="text-danger">*</span></label>
                            <input class="input_full_width" type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment</label>
                            <input class="input_full_width" type="comment" name="comment">
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
                        <div class="group-input">
                            <label for="root-item">
                             <input type="radio" name="revision" id="root-item" value="effectiveness-check">
                                Effectiveness check
                            </label>
                        </div>
                        <div class="group-input">
                            <label for="root-item">
                                <input type="radio" name="revision" id="root-item" value="Extension">
                                Extension
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
    <div class="modal fade" id="child-modal2">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('labincidentRisk_Child', $data->id) }}" method="POST">
                        @csrf
                        <div class="group-input">
                            
                        </div>
                        <div class="group-input">
                            <label for="root-item">
                                <input type="radio" name="revision" id="root-item" value="risk-Item">
                                Risk Assessment
                            </label>
                        </div>
                        <div class="group-input">
                            <label for="root-item">
                                <input type="radio" name="revision" id="root-item" value="Extension">
                                Extension
                            </label>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit">Submit</button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="child-modal3">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('lab_incident_extension_child', $data->id) }}" method="POST">
                        @csrf
                        
                        <div class="group-input">
                            <label for="root-item">
                                <input type="radio" name="revision" id="root-item" value="Extension">
                                Extension
                            </label>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit">Submit</button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="child-modal1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('lab_incident_capa_child', $data->id) }}" method="POST">
                        @csrf
                        <div class="group-input">
                            <label for="capa-child">
                                <input type="radio" name="revision" id="capa-child" value="rca">
                                RCA
                            </label>
                        </div>
                        <div class="group-input">
                            <label for="root-item">
                                <input type="radio" name="revision" id="root-item" value="Action-Item">
                                Action Item
                            </label>
                        </div>
                        <div class="group-input">
                            <label for="root-item">
                                <input type="radio" name="revision" id="root-item" value="resampling">
                                Reasampling
                            </label>
                        </div>
                        <div class="group-input">
                            <label for="root-item">
                                <input type="radio" name="revision" id="root-item" value="capa">
                                CAPA
                            </label>
                        </div>
                        @if(Helpers::getChildData($data->id, 'LabIncident') < 3)
                        <div class="group-input">
                            <label for="root-item">
                                <input type="radio" name="revision" id="root-item" value="Extension">
                                Extension
                            </label>
                        @endif
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit">Submit</button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>

                      {{-- <!-- CAPA content -->
                    <div id="CCForm4" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                               
                                    



                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Currective Action">Capa</label>
                                        <textarea name="capa_capa" {{ $data->stage == 0 || $data->stage == 10 ? "readonly" : "" }}>{{ $data->capa_capa }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Currective Action">Corrective Action</label>
                                        <textarea name="Currective_Action" {{ $data->stage == 0 || $data->stage == 10 ? "readonly" : "" }}>{{ $data->Currective_Action }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Preventive Action">Preventive Action</label>
                                        <textarea name="Preventive_Action" {{ $data->stage == 0 || $data->stage == 10 ? "readonly" : "" }}>{{ $data->Preventive_Action }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Corrective & Preventive Action">Corrective & Preventive Action</label>
                                        <textarea name="Corrective_Preventive_Action" {{ $data->stage == 0 || $data->stage == 10 ? "readonly" : "" }}>{{ $data->Corrective_Preventive_Action }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="CAPA Attachments">CAPA Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="CAPA_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "readonly" : "" }}
                                            value="{{ $data->CAPA_Attachment }}"> --}}
                                            {{-- <div class="file-attachment-field">
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
                                                    <input {{ $data->stage == 0 || $data->stage == 10 ? "readonly" : "" }} type="file" id="myfile" name="CAPA_Attachment[]"
                                                        oninput="addMultipleFiles(this, 'CAPA_Attachment')" multiple>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 10 ? "readonly" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div> --}} 
                      <!-- Incident Details content -->
                    {{-- <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Incident Details">Incident Details</label>
                                        <textarea name="Incident_Details" {{ $data->stage == 0 || $data->stage == 10 ? "readonly" : "" }}>{{ $data->Incident_Details }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Document Details ">Document Details</label>
                                        <textarea name="Document_Details" {{ $data->stage == 0 || $data->stage == 10 ? "readonly" : "" }}>{{ $data->Document_Details }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Instrument Details">Instrument Details</label>
                                        <textarea name="Instrument_Details" {{ $data->stage == 0 || $data->stage == 10 ? "readonly" : "" }}>{{ $data->Instrument_Details }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Involved Personnel">Involved Personnel</label>
                                        <textarea name="Involved_Personnel" {{ $data->stage == 0 || $data->stage == 10 ? "readonly" : "" }}>{{ $data->Involved_Personnel }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Product Details,If Any">Product Details,If Any</label>
                                        <textarea name="Product_Details" {{ $data->stage == 0 || $data->stage == 10 ? "readonly" : "" }}>{{ $data->Product_Details }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Supervisor Review Comments">Supervisor Review Comments</label>
                                        <textarea name="Supervisor_Review_Comments" {{ $data->stage == 0 || $data->stage == 10 ? "readonly" : "" }}>{{ $data->Supervisor_Review_Comments }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="ccf_attachments">Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        {{-- <input type="file" id="myfile" name="Initial_Attachment" {{ $data->stage == 0 || $data->stage == 8 ? "readonly" : "" }}
                                            value="{{ $data->Initial_Attachment }}"> --}}
                                            {{-- <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="ccf_attachments">
                                                    @if ($data->ccf_attachments)
                                                    @foreach (json_decode($data->ccf_attachments) as $file)
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
                                                <div class="add-btn ">
                                                    <div>Add</div>
                                                    <input {{ $data->stage == 0 || $data->stage == 10 ? "readonly" : "" }} type="file" id="ccf_attachments" name="ccf_attachments[]"
                                                        oninput="addMultipleFiles(this, 'ccf_attachments')" multiple>
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
                                        <textarea name="Cancelation_Remarks" {{ $data->stage == 0 || $data->stage == 8 ? "readonly" : "" }}>{{ $data->Cancelation_Remarks }}</textarea>
                                    </div>
                                </div> --}}
                            {{-- </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 10 ? "readonly" : "" }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                            </div>
                        </div>
                    </div> --}}  

                    {{-- <div id="CCForm3" class="inner-block cctabcontent">
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
                                     <textarea name="reasoon_for_extension_e">{{$data->reasoon_for_extension_e}}</textarea>
                                 </div>
                             </div>
 
                             {{-- <div class="col-6">
                                 <div class="group-input">
                                 <label for="extension date">Extension Date (if required)</label>
                                 <input type="date" name="extension_date_esc" id="extension_date" value="{{$data->extension_date_esc}}">
                                 </div>
                             </div> 

                             <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Date Due"> Extension Date</label>
                                    <div><small class="text-primary">Please mention expected date of completion</small>
                                    </div>
                                    <div class="calenderauditee">
                                        <input type="text" id="extension_date_esc" readonly
                                            placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->extension_date_esc) }}"/>
                                        <input type="date" name="extension_date_esc"  class="hide-input"
                                            oninput="handleDateInput(this, 'extension_date_esc')" />
                                    </div>
                                </div>
                            </div>



                            
                                
                             {{-- <div class="col-6">
                                 <div class="group-input">
                                 <label for="extension date">Extension Initiator Date</label>
                                 <input type="date" name="extension_date_initiator" id="extension_date" value="{{$data->extension_date_initiator}}">
                                 </div>
                             </div> 


                             <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Date Due"> Extension Initiator Date</label>
                                    <div><small class="text-primary">Please mention expected date of completion</small>
                                    </div>
                                    <div class="calenderauditee">
                                        <input type="text" id="extension_date_initiator" readonly
                                            placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->extension_date_initiator) }}" />
                                        <input type="date" name="extension_date_initiator" class="hide-input"
                                            oninput="handleDateInput(this, 'extension_date_initiator')" />
                                    </div>
                                </div>
                            </div>
                             {{-- person field --}}

                             {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="search">
                                        Extension HOD <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="assign_to" >
                                        <option value="">Select a value</option>
                                        @foreach ($users as $key=> $value)
                                            <option  @if ($data->assign_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('assign_to')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div> --}}

                            {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="search">
                                        Extension Approved By <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="assign_to" >
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
                                 <textarea name="reasoon_for_extension_esc">{{$data->reasoon_for_extension_esc}}</textarea>
                                 </div>
                              </div>
 
                           
                              {{-- <div class="col-6">
                                 <div class="group-input">
                                  <label for="extension date">Extension Date (if required)</label>
                                   <input type="date" name="extension_date_e" id="extension_date__sc" value="{{$data->extension_date_e}}">
                                 </div>
                              </div> 

                              <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Date Due"> Extension Date</label>
                                    <div><small class="text-primary">Please mention expected date of completion</small>
                                    </div>
                                    <div class="calenderauditee">
                                        <input type="text" id="extension_date_e" readonly
                                            placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->extension_date_e) }}" />
                                        <input type="date" name="extension_date_e"  class="hide-input"
                                            oninput="handleDateInput(this, 'extension_date_e')" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Date Due"> Extension Initiator Date</label>
                                    <div><small class="text-primary">Please mention expected date of completion</small>
                                    </div>
                                    <div class="calenderauditee">
                                        <input type="text" id="extension_date_idsc" readonly
                                            placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->extension_date_idsc) }}" >
                                        <input type="date" name="extension_date_idsc"  class="hide-input"
                                            oninput="handleDateInput(this, 'extension_date_idsc')" />
                                    </div>
                                </div>
                            </div>

                                 {{-- <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="extension_date_idsc">Extension Initiator Date <span class="text-danger"></span></label> --}}
                                        {{-- <p class="text-primary">Last date this record should be closed by</p> --}}
                                
                                        {{-- <div class="calenderauditee">
                                            <input type="date" id="extension_date_idsc_display" 
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" id="extension_date_idsc" name="extension_date_idsc"
                                                class="hide-input" oninput="handleDateInput(this)" />
                                        </div>
                                        
                                    </div> --}}
                      {{--           </div> --}}
                      


                                    
    
                                                {{-- person field --}}
                                                

                                                {{-- <div class="col-md-6">
                                                    <div class="group-input">
                                                        <label for="search">
                                                            Extension Approved By <span class="text-danger"></span>
                                                        </label>
                                                        <select id="select-state" placeholder="Select..." name="qc_approved_to" >
                                                            <option value="">Select a value</option>
                                                            @foreach ($users as $key=> $value)
                                                                <option  @if ($data->qc_approved_to == $value->id) selected @endif  value="{{ $value->id }}">{{ $value->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('qc_approved_to')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div> 

                           </div>

                           {{-- third section 

                           <div class="row">
                             <div class="group-input">
                                   <div class="col-12 sub-head">
                                 Third Extension
                                 </div>
                             </div>
                           <div class="col-12">
                               <div class="group-input">
                              <label for="reason for extension tc">Reason For Extension</label>
                              <textarea name="reasoon_for_extension_tc">{{$data->reasoon_for_extension_tc}}</textarea>
                              </div>
                           </div>
 
                        
                           
                           <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Date Due"> Extension Date</label>
                                <div><small class="text-primary">Please mention expected date of completion</small>
                                </div>
                                <div class="calenderauditee">
                                    <input type="text" id="extension_date__tc" readonly
                                        placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->extension_date__tc) }}"/>
                                    <input type="date" name="extension_date__tc"   class="hide-input"
                                        oninput="handleDateInput(this, 'extension_date__tc')" />
                                </div>
                            </div>
                        </div>
                         
                              

                              <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Date Due"> Extension Initiator Date</label>
                                    <div><small class="text-primary">Please mention expected date of completion</small>
                                    </div>
                                    <div class="calenderauditee">
                                        <input type="text" id="extension_date_idtc" readonly
                                            placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->extension_date_idtc) }}" />
                                        <input type="date" name="extension_date_idtc"  class="hide-input"
                                            oninput="handleDateInput(this, 'extension_date_idtc')" />
                                    </div>
                                </div>
                            </div>
                                    {{-- person field 

                                    <div class="col-md-6">
                                        {{-- <div class="group-input">
                                            <label for="search">
                                                Extension Approved By QA <span class="text-danger"></span>
                                            </label>
                                            <select id="select-state" placeholder="Select..." name="assign_to" >
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
                                        {{-- <div class="group-input">
                                            <label for="search">
                                                Extension Approved By CQA <span class="text-danger"></span>
                                            </label>
                                            <select id="select-state" placeholder="Select..." name="assign_to" >
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
                                <div class="file-attachment-list" id="extension_attachments_e">
                                    @if ($data->extension_attachments_e)
                                    @foreach (json_decode($data->extension_attachments_e) as $file)
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
                                    <input  type="file" id="extension_attachments_e" name="extension_attachments_e[]"
                                        oninput="addMultipleFiles(this, 'extension_attachments_e')" multiple>
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
                     </div> --}}



                </div>
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
        .input_full_width{
            width: 100%;
    border-radius: 5px;
    margin-bottom: 10px;
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
            if (textlen < 0) {
                textlen = 0;
            }
            $('#rchars').text(textlen);
        });
    </script>
        <script>
        var maxLength = 255;
        $('#duedoc').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchar').text(textlen);});
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
var originalRecordNumber = document.getElementById('record_number').value;
var initialPlaceholder = '---';

document.getElementById('initiator_group').addEventListener('change', function() {
    var selectedValue = this.value;
    var recordNumberElement = document.getElementById('record_number');
    var initiatorGroupCodeElement = document.getElementById('initiator_group_code');

    // Update the initiator group code
    initiatorGroupCodeElement.value = selectedValue;

    // Update the record number by replacing the initial placeholder with the selected initiator group code
    var newRecordNumber = originalRecordNumber.replace(initialPlaceholder, selectedValue);
    recordNumberElement.value = newRecordNumber;

    // Update the original record number to keep track of changes
    originalRecordNumber = newRecordNumber;
    initialPlaceholder = selectedValue;
});
});

</script>
@endsection
