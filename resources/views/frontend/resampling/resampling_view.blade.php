@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')
    @php
        $users = DB::table('users')->select('id', 'name')->get();

    @endphp

    <style>
        #step-form>div {
            display: none
        }

        #step-form>div:nth-child(1) {
            display: block;
        }

        .hide-input {
            display: none !important;
        }

        .remove-file{
            cursor: pointer;
        }
   
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
        .form-control{
            margin-bottom: 20px;
        }
        
    </style>

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
    {{-- ======================================
                CHANGE CONTROL VIEW
    ======================================= --}}
    <div id="rcms_form-head">
        <div class="container-fluid">
            <div class="inner-block">
                {{-- <div class="head">PR-0001</div> --}}
                <div class="slogan">
                    <strong>Site Division/Project :</strong>
                    {{ Helpers::getDivisionName($data->division_id) }} / Resampling
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
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                        {{--  <button class="button_theme1"> <a class="text-white" href="{{ url('send-notification', $data->id) }}"> Send Notification </a> </button>  --}}
                        {{-- {{ dd($data->stage);}} --}}
                       <a class="button_theme1 text-white"
                                href="{{ route('resampling-audittrialshow', $data->id) }}"> Audit Trail </a> 

                         @if ($data->stage == 1 && ($data->initiator_id == Auth::user()->id || Helpers::check_roles($data->division_id, 'Resampling', 18)))
                      
                            <a href="#signature-modal"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button></a>
                           <a href="#cancel-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button></a>

                        @elseif($data->stage == 2 && (Helpers::check_roles($data->division_id, 'Resampling', 42) || Helpers::check_roles($data->division_id, 'Resampling', 9) || Helpers::check_roles($data->division_id, 'Resampling', 39) || Helpers::check_roles($data->division_id, 'Resampling', 43) || Helpers::check_roles($data->division_id, 'Resampling', 65) || Helpers::check_roles($data->division_id, 'Resampling', 18)))
        
                           <a > <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Information Required
                            </button></a>
                            {{-- <a href="#child-modal1"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button></a> --}}
                            <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approved
                            </button></a>
                        @elseif($data->stage == 3 && ($data->assign_to == Auth::user()->id || Helpers::check_roles($data->division_id, 'Resampling', 18)))

                            <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Acknowledge  Complete
                            </button></a>
                            <a href="#more-info-required-modal"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Information Required
                            </button></a>

                            @elseif($data->stage == 4 && (Helpers::check_roles($data->division_id, 'Resampling', 7) || Helpers::check_roles($data->division_id, 'Resampling', 66)|| Helpers::check_roles($data->division_id, 'Resampling', 18)))
                         
                           <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                             Verification  Complete
                            </button></a>
                            <a href="#more-info-required-modal"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Information Required
                            </button></a>
                        {{-- @elseif($data->stage == 2 && (in_array(8, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                More Information Required
                            </button> --}}
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
                            {{-- @if ($data->stage >= 2)
                                <div class="active">HOD Review</div>
                            @else
                                <div class="">HOD Review</div>
                            @endif --}}
                            @if ($data->stage >= 2)
                                <div class="active">Head QA/CQA Approval</div>
                            @else
                                <div class="">Head QA/CQA Approval</div>
                            @endif 
                            @if ($data->stage >= 3)
                            <div class="active">Acknowledge</div>
                        @else
                            <div class="">Acknowledge </div>
                        @endif
                        @if ($data->stage >= 4)
                        <div class="active">QA/CQA Verification</div>
                    @else
                        <div class="">QA/CQA Verification </div>
                    @endif
                        @if ($data->stage >= 5)
                        <div class="bg-danger">Closed - Done</div>
                    @else
                        <div class="">Closed - Done </div>
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
                    <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Head QA/CQA Approval</button>
                     
                    <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Acknowledge</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA/CQA Verification</button>
                    <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Activity Log</button>
                </div>
                <form action="{{ route('resampling-update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

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
                                                value="{{ Helpers::getDivisionName($data->division_id) }}/Resampling/{{ \Carbon\Carbon::parse($data->created_at)->format('Y') }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Division Code"><b>Site/Location Code</b></label>
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
                                    {{--  <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Date Due"><b>Date of Initiation</b></label>
                                            @php
                                                $formattedDate = \Carbon\Carbon::parse($data->intiation_date)->format('j-F-Y');
                                            @endphp
                                            <input disabled type="text" value="{{ $formattedDate }}" name="intiation_date_display">
                                            <input type="hidden" value="{{ date('d-m-Y') }}" name="intiation_date">
                                        </div>
                                    </div>  --}}

                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="search">
                                                Assigned To <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                            </label>

                                            <!-- Select Field -->
                                            <select 
                                                {{ in_array($data->stage, [0, 2, 3, 4, 5]) ? 'disabled' : '' }} 
                                                id="select-state" 
                                                name="assign_to" 
                                                {{ $data->stage == 1 ? 'required' : '' }}>
                                                <option value="">Select a value</option>
                                                @foreach ($users as $value)
                                                    <option value="{{ $value->id }}" 
                                                        {{ old('assign_to', $data->assign_to) == $value->id ? 'selected' : '' }}>
                                                           {{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <!-- Hidden Input to Retain Value When Disabled -->
                                            @if (in_array($data->stage, [0, 2, 3, 4, 5]))
                                                <input type="hidden" name="assign_to" value="{{ old('assign_to', $data->assign_to) }}">
                                            @endif
                                        </div>
                                    </div>


                                    {{-- <div class="col-md-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="due-date">Due Date <span class="text-danger"></span></label>
                                            <!-- <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                value="" name="due_date"> -->
                                                <div class="calenderauditee">
                                                    <!-- Display the formatted date in a readonly input -->
                                                    <input type="text" id="due_date_display" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getDueDate(30, true) }}" />
                                                    <input type="date" name="due_date_gi" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ Helpers::getDueDate(30, false) }}" class="hide-input" readonly />
                                                </div>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-md-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="due-date">Due Date <span class="text-danger">*</span></label>
                                            <div class="calenderauditee">
                                                <!-- Format ki hui date dikhane ke liye readonly input -->
                                                <input type="text" id="due_date_display" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getDueDate123($data->intiation_date, true) }}" />
                                                <!-- Hidden input date format ke sath -->
                                                <input type="date" name="due_date_gi" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ Helpers::getDueDate123($data->intiation_date, true, 'Y-m-d') }}" class="hide-input" readonly />
                                            </div>
                                        </div>
                                    </div> --}}
                                  
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Audit Schedule Start Date">
                                            Due Date <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                        </label>
                                        
                                        <div class="calenderauditee">                                     
                                            <input type="text"  id="due_dateq"  readonly placeholder="DD-MM-YYYY" value="{{ Helpers::getdateFormat($data->due_date) }}"
                                                {{ $data->stage == 0 || $data->stage == 2 ? 'disabled' : '' }}/>
                                            <input type="date" id="due_dateq" name="due_date"min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 ? 'readonly' : '' }} {{ $data->stage == 1 ? 'required' : '' }} value="{{ $data->due_date }}" class="hide-input"
                                            oninput="handleDateInput(this, 'due_dateq');checkDate('due_dateq')"/>
                                        </div>
                                    </div>
                                </div>

                                

                                <script>
                                    function handleDateInput(input, targetId) {
                                                    var dateInput = document.getElementById(targetId);
                                                    var originalValue = dateInput.getAttribute('data-original-value');
                                                    
                                                    if (input.value !== originalValue) {
                                                        dateInput.value = input.value; // Update only if different from the original value
                                                    } else {
                                                        input.value = dateInput.value; // Preserve the existing value if no change
                                                    }
                                                }
                                </script>
                                
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
                                    

                                 

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars"
                                            class="text-primary">255 </span><span class="text-primary">
                                            characters remaining</span>


                                        <input name="short_description" id="docname" type="text" maxlength="255" required type="text"
                                        {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 ? 'readonly' : '' }} value="{{ $data->short_description }}">
                                    </div>
                                    <p id="docnameError" style="color:red">**Short Description is required</p>

                                </div>

                                    {{--  <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Related Records">Related Records</label>
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
                                            <input type="longText" name="related_records"{{ $data->stage == 0 || $data->stage == 5 ? "disabled" : "" }} value="{{ $data->related_records }}">

                                        </div>
                                    </div>  --}}

                                

                                    <div class="col-6">
                                        <div class="group-input">
                                            <label for="related_records">
                                                Related Records <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                            </label>

                                            <!-- Select Field -->
                                            <select multiple name="related_records[]" id="related_records" placeholder="Select Reference Records"
                                                data-silent-initial-value-set="true"
                                                {{ in_array($data->stage, [0, 2, 3, 4, 5]) ? 'disabled' : '' }} 
                                                {{ $data->stage == 1 ? 'required' : '' }}>

                                                @if (!empty($relatedRecords))
                                                    @foreach ($relatedRecords as $records)
                                                        @php
                                                            $recordValue = Helpers::getDivisionName(
                                                                $records->division_id ?? $records->division ?? $records->division_code ?? $records->site_location_code
                                                            ) . '/' . $records->process_name . '/' . date('Y') . '/' . Helpers::recordFormat($records->record);

                                                            $selected = in_array($recordValue, explode(',', $data->related_records ?? '')) ? 'selected' : '';
                                                        @endphp
                                                        <option value="{{ $recordValue }}" {{ $selected }}>
                                                            {{ $recordValue }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            <!-- Hidden Input to Retain Values When Select is Disabled -->
                                            @if (in_array($data->stage, [0, 2, 3, 4, 5]))
                                                @foreach (explode(',', $data->related_records ?? '') as $record)
                                                    <input type="hidden" name="related_records[]" value="{{ $record }}">
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>



                                    {{--  <div class="col-6">
                                        <div class="group-input">
                                            <label for="related_records">Related Records</label>
    
                                            <!-- Virtual Select Dropdown -->
                                            <div id="related_records" class="virtual-select">
                                                <select multiple name="related_records[]" data-silent-initial-value-set="true"
                                                    data-search="false" data-placeholder="Select Reference Records">
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
    
                                                                    explode(',', $data->related_records),
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
                                        </div>
                                    </div>  --}}
    
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="HOD Persons">
                                                HOD Person <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                            </label>
                                            <select name="hod_preson" 
                                                    placeholder="Select HOD Persons" 
                                                    data-search="false"
                                                    data-silent-initial-value-set="true" 
                                                    id="hod" 
                                                    {{ in_array($data->stage, [0, 2, 3, 4, 5]) ? 'disabled' : '' }} 
                                                    {{ $data->stage == 1 ? 'required' : '' }}>
                                                    <option value="">Select Person</option>
                                                    @foreach ($users as $value)
                                                        <option value="{{ $value->id }}" 
                                                            {{ old('hod_preson', $data->hod_preson) == $value->id ? 'selected' : '' }}>
                                                            {{ $value->name }}
                                                        </option>
                                                    @endforeach
                                            </select>
                                                    
                                            @if (in_array($data->stage, [0, 2, 3, 4, 5]))
                                                <input type="hidden" name="hod_preson" value="{{ old('hod_preson', $data->hod_preson) }}">
                                            @endif

                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="related_records">Resampling Related Records</label>
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

                                    <div class="col-12" >
                                        <div class="group-input">
                                            <label for="description">
                                                Description <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                            </label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 ? 'readonly' : '' }} name="description" {{ $data->stage == 1 ? 'required' : '' }}>{{ $data->description }}</textarea>
                                        </div>
                                    </div>


                                    {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="initiator-group">
                                                Responsible Department <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                            </label>
                                            <select name="departments" id="departments"  {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 ? 'readonly' : '' }} {{ $data->stage == 1 ? 'required' : '' }}>
                                                <option value="">-- Select --</option>
                                                <option value="CQA"
                                                    @if ($data->departments == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                                <option value="QA"
                                                    @if ($data->departments == 'QA') selected @endif>Quality Assurance</option>
                                                <option value="QC"
                                                    @if ($data->departments == 'QC') selected @endif>Quality Control</option>
                                                <option value="QM"
                                                    @if ($data->departments == 'QM') selected @endif>Quality Control (Microbiology department)
                                                </option>
                                                <option value="PG"
                                                    @if ($data->departments == 'PG') selected @endif>Production General</option>
                                                <option value="PL"
                                                    @if ($data->departments == 'PL') selected @endif>Production Liquid Orals</option>
                                                <option value="PT"
                                                    @if ($data->departments == 'PT') selected @endif>Production Tablet and Powder</option>
                                                <option value="PE"
                                                    @if ($data->departments == 'PE') selected @endif>Production External (Ointment, Gels, Creams and Liquid)</option>
                                                <option value="PC"
                                                    @if ($data->departments == 'PC') selected @endif>Production Capsules</option>
                                                <option value="PI"
                                                    @if ($data->departments == 'PI') selected @endif>Production Injectable</option>
                                                <option value="EN"
                                                    @if ($data->departments == 'EN') selected @endif>Engineering</option>
                                                <option value="HR"
                                                    @if ($data->departments == 'HR') selected @endif>Human Resource</option>
                                                <option value="ST"
                                                    @if ($data->departments == 'ST') selected @endif>Store</option>
                                                <option value="IT"
                                                    @if ($data->departments == 'IT') selected @endif>Electronic Data Processing
                                                </option>
                                                <option value="FD"
                                                    @if ($data->departments == 'FD') selected @endif>Formulation  Development
                                                </option>
                                                <option value="AL"
                                                    @if ($data->departments == 'AL') selected @endif>Analytical research and Development Laboratory
                                                </option>
                                                <option value="PD"
                                                    @if ($data->departments == 'PD') selected @endif>Packaging Development
                                                </option>

                                                <option value="PU"
                                                    @if ($data->departments == 'PU') selected @endif>Purchase Department
                                                </option>
                                                <option value="DC"
                                                    @if ($data->departments == 'DC') selected @endif>Document Cell
                                                </option>
                                                <option value="RA"
                                                    @if ($data->departments == 'RA') selected @endif>Regulatory Affairs
                                                </option>
                                                <option value="PV"
                                                    @if ($data->departments == 'PV') selected @endif>Pharmacovigilance
                                                </option>
                                            </select>
                                        </div>
                                    </div> --}}

                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="initiator-group">
                                                Responsible Department <span class="text-danger">{{ $data->stage == 1 ? '*' : '' }}</span>
                                            </label>

                                            <!-- Select Field -->
                                            <select name="departments" id="departments" 
                                                {{ in_array($data->stage, [0, 2, 3, 4, 5]) ? 'disabled' : '' }} 
                                                  {{ $data->stage == 1 ? 'required' : '' }}>
                                                <option value="">-- Select --</option>
                                                <option value="CQA" {{ old('departments', $data->departments) == 'CQA' ? 'selected' : '' }}>Corporate Quality Assurance</option>
                                                <option value="QA" {{ old('departments', $data->departments) == 'QA' ? 'selected' : '' }}>Quality Assurance</option>
                                                <option value="QC" {{ old('departments', $data->departments) == 'QC' ? 'selected' : '' }}>Quality Control</option>
                                                <option value="QM" {{ old('departments', $data->departments) == 'QM' ? 'selected' : '' }}>Quality Control (Microbiology department)</option>
                                                <option value="PG" {{ old('departments', $data->departments) == 'PG' ? 'selected' : '' }}>Production General</option>
                                                <option value="PL" {{ old('departments', $data->departments) == 'PL' ? 'selected' : '' }}>Production Liquid Orals</option>
                                                <option value="PT" {{ old('departments', $data->departments) == 'PT' ? 'selected' : '' }}>Production Tablet and Powder</option>
                                                <option value="PE" {{ old('departments', $data->departments) == 'PE' ? 'selected' : '' }}>Production External (Ointment, Gels, Creams, and Liquid)</option>
                                                <option value="PC" {{ old('departments', $data->departments) == 'PC' ? 'selected' : '' }}>Production Capsules</option>
                                                <option value="PI" {{ old('departments', $data->departments) == 'PI' ? 'selected' : '' }}>Production Injectable</option>
                                                <option value="EN" {{ old('departments', $data->departments) == 'EN' ? 'selected' : '' }}>Engineering</option>
                                                <option value="HR" {{ old('departments', $data->departments) == 'HR' ? 'selected' : '' }}>Human Resource</option>
                                                <option value="ST" {{ old('departments', $data->departments) == 'ST' ? 'selected' : '' }}>Store</option>
                                                <option value="IT" {{ old('departments', $data->departments) == 'IT' ? 'selected' : '' }}>Electronic Data Processing</option>
                                                <option value="FD" {{ old('departments', $data->departments) == 'FD' ? 'selected' : '' }}>Formulation Development</option>
                                                <option value="AL" {{ old('departments', $data->departments) == 'AL' ? 'selected' : '' }}>Analytical Research and Development Laboratory</option>
                                                <option value="PD" {{ old('departments', $data->departments) == 'PD' ? 'selected' : '' }}>Packaging Development</option>
                                                <option value="PU" {{ old('departments', $data->departments) == 'PU' ? 'selected' : '' }}>Purchase Department</option>
                                                <option value="DC" {{ old('departments', $data->departments) == 'DC' ? 'selected' : '' }}>Document Cell</option>
                                                <option value="RA" {{ old('departments', $data->departments) == 'RA' ? 'selected' : '' }}>Regulatory Affairs</option>
                                                <option value="PV" {{ old('departments', $data->departments) == 'PV' ? 'selected' : '' }}>Pharmacovigilance</option>
                                            </select>

                                            <!-- Hidden Input to Retain Value When Disabled -->
                                            @if (in_array($data->stage, [0, 2, 3, 4, 5]))
                                                <input type="hidden" name="departments" value="{{ old('departments', $data->departments) }}">
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="others">If Others</label>
                                            <textarea name="if_others" {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 ? 'readonly' : '' }}>{{ $data->if_others }}</textarea>
                                        </div>
                                    </div>

                                    {{--  <div class="col-12">
                                        <div class="group-input">
                                            <label for="related_records">Related Records</label>
    
                                            <select multiple name="related_records[]" placeholder="Select Reference Records"
                                                data-silent-initial-value-set="true" id="related_records">
    
                                                @foreach ($relatedRecords as $record)
                                                    <option value="{{ $record->id }}" 
                                                        {{ in_array($record->id, explode(',', $data->related_records ?? '')) ? 'selected' : '' }}>
                                                        {{ Helpers::getDivisionName($record->c) }}/{{ Helpers::year($record->created_at) }}/{{ Helpers::record($record->record) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>  --}}
                                    <div class="col-12">
                                    <div class="group-input">
                                        <label for="file_attach">File Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="file_attach">
                                                @if ($data->file_attach)
                                                    @foreach(json_decode($data->file_attach) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_file_attach[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="file_attach[]" 
                                                 {{ $data->stage == 0 || $data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 ? 'readonly' : '' }}
                                                    oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_file_attach" name="deleted_file_attach" value="">
                                
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
                                                    const deletedFilesInput = document.getElementById('deleted_file_attach');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
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
                                  </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton"  {{ $data->stage == 0 || $data->stage == 5  ? 'disabled' : '' }}>Save</button>
                                    <button type="button" class="nextButton" onclick="nextStep()"  {{ $data->stage == 0 || $data->stage == 5  ? 'disabled' : '' }}>Next</button>
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





                        
                        <div id="CCForm2" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                

                                
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="qa_comments">QA/CQA Head Remark  @if($data->stage == 2) <span class="text-danger">*</span>@endif</label>
                                            <textarea name="qa_remark" {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 ? 'readonly' : '' }}>{{$data->qa_remark}}</textarea>
                                        </div>
                                    </div>



                                 @if ($data->qa_head)
                                        @foreach (json_decode($data->qa_head) as $file)
                                            <input id="QaAttachmentFile-{{ $loop->index }}" type="hidden"
                                                name="existinQAFile[{{ $loop->index }}]"
                                                value="{{ $file }}">
                                        @endforeach
                                    @endif
                                    <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_head">QA/CQA Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="qa_head">
                                                @if ($data->qa_head)
                                                    @foreach(json_decode($data->qa_head) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_qa_head[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="qa_head[]" 
                                                    {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 ? 'readonly' : '' }}
                                                    oninput="addMultipleFiles(this, 'qa_head')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_qa_head" name="deleted_qa_head" value="">
                                
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
                                                    const deletedFilesInput = document.getElementById('deleted_qa_head');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
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


                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 5  ? 'disabled' : '' }}>Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()" {{ $data->stage == 0 || $data->stage == 5  ? 'disabled' : '' }}>Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()" {{ $data->stage == 0 || $data->stage == 5  ? 'disabled' : '' }}>Next</button>
                                    <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                        <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="CCForm3" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="sub-head col-12">Acknowledge</div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="action_taken">Action Taken  @if($data->stage == 3) <span class="text-danger">*</span>@endif</label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 2 || $data->stage == 4 || $data->stage == 5 ? 'readonly' : '' }} {{ $data->stage == 3 ? 'required' : '' }} name="action_taken">{{ $data->action_taken }}</textarea>
                                        </div>
                                    </div>
                                    
                                    
                                <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Audit Schedule Start Date">
                                    Actual Start Date <span class="text-danger">{{ $data->stage == 3 ? '*' : '' }}</span>
                                </label>
                                {{-- <div class="calenderauditee">
                                    <input type="text" 
                                        id="start_date" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->start_date) }}"  />
                                    <input class="hide-input" type="date"   name="start_date"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} id="start_date_checkdate" value="{{ $data->start_date }}"
                                        oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                </div> --}}
                                <div class="calenderauditee">
                                    <input type="text" id="start_date" name="start_date" readonly placeholder="DD-MM-YYYY"
                                        value="{{ Helpers::getdateFormat($data->start_date) }}" />
                                    <input type="date" id="start_date_name" name="start_date_name"
                                        max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        value="{{ $data->start_date ? \Carbon\Carbon::parse($data->start_date)->format('Y-m-d') : '' }}"
                                        class="hide-input"
                                        oninput="handleDateInput(this, 'start_date');updateEndDateMin();"  {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 2 || $data->stage == 4 || $data->stage == 5 ? 'readonly' : '' }} {{ $data->stage == 3 ? 'required' : '' }} />
                                </div>
                            </div>
                        </div>
                       <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Audit Schedule End Date">
                                    Actual End Date<span class="text-danger">{{ $data->stage == 3 ? '*' : '' }}</span>
                                </label>
                                {{-- <input type="date" name="end_date" value="{{ $data->end_date }}" --}}
                                {{-- <div class="calenderauditee">
                                    <input type="text" 
                                        id="end_date" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat($data->end_date) }}"  />
                                    <input class="hide-input" type="date"   name="end_date"{{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} id="end_date_checkdate" value="{{ $data->end_date }}"
                                        oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                </div> --}}
                                <div class="calenderauditee">
                                    <input type="text" id="end_date" name="end_date" readonly placeholder="DD-MM-YYYY"
                                        value="{{ Helpers::getdateFormat($data->end_date) }}" />
                                    <input type="date" id="end_date_name" name="end_date_name"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        value="{{ $data->end_date ? \Carbon\Carbon::parse($data->end_date)->format('Y-m-d') : '' }}"
                                        class="hide-input" oninput="handleDateInput(this, 'end_date');"  {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 2 || $data->stage == 4 || $data->stage == 5 ? 'readonly' : '' }}{{ $data->stage == 3 ? 'required' : '' }} />
                                </div>
                            </div>
                        </div>

                        
    <script>
        function handleDateInput(inputElement, displayElementId) {
            var displayElement = document.getElementById(displayElementId);
            var dateValue = new Date(inputElement.value);
            displayElement.value = dateValue.toLocaleDateString('en-GB', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        }

        function updateEndDateMin() {
            var startDate = document.getElementById('start_date_name').value;
            var endDateInput = document.getElementById('end_date_name');

            if (startDate) {
                // Set the minimum date to one day after the start date
                var minEndDate = new Date(startDate);
                minEndDate.setDate(minEndDate.getDate());

                // Format the date to match the input type date format (yyyy-mm-dd)

                var formattedMinEndDate = minEndDate.toISOString().split('T')[0];
                endDateInput.setAttribute('min', formattedMinEndDate);

                // Ensure the next audit date is after the last audit date
                // if (endDateInput.value && endDateInput.value <= startDate) {
                //     endDateInput.value = '';
                //     // alert("The next audit date must be after the last audit date.");
                // }
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            updateEndDateMin(); // Initialize the end date min on page load

            // Reapply the min attribute whenever the start date is changed
            document.getElementById('start_date_name').addEventListener('input', function() {
                updateEndDateMin();
            });

            // Validate the end date when it is changed
            document.getElementById('end_date_name').addEventListener('input', function() {
                updateEndDateMin();
            });
        });
    </script>
                                </div>
                                      <div class="col-12">
                                        <div class="group-input">
                                            <label for="Comments">
                                                Comments<span class="text-danger">{{ $data->stage == 3 ? '*' : '' }}</span>
                                            </label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 2 || $data->stage == 4 || $data->stage == 5 ? 'readonly' : '' }}{{ $data->stage == 3 ? 'required' : '' }} name="comments">{{ $data->comments }}</textarea>
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
                                    {{-- <div class="col-12">
                                        <div class="group-input">
                                            <label for="Support_doc">Completion Attachment</label>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="Support_doc"></div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="myfile" name="Support_doc[]"
                                                        oninput="addMultipleFiles(this, 'Support_doc')" multiple>
                                                </div>
                                            </div>
    
                                        </div>
                                    </div> --}}



                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Comments">
                                                Sampled By<span class="text-danger">{{ $data->stage == 3 ? '*' : '' }}</span>
                                            </label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 2 || $data->stage == 4 || $data->stage == 5 ? 'readonly' : '' }} {{ $data->stage == 3 ? 'required' : '' }} name="sampled_by">{{ $data->sampled_by }}</textarea>
                                        </div>
                                    </div> 


                                    
                                    <div class="col-12">
                                    <div class="group-input">
                                        <label for="Support_doc">Completion Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Support_doc">
                                                @if ($data->Support_doc)
                                                    @foreach(json_decode($data->Support_doc) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_Support_doc[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Support_doc[]" 
                                                    {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 2 || $data->stage == 4 || $data->stage == 5 ? 'readonly' : '' }}
                                                    oninput="addMultipleFiles(this, 'Support_doc')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_Support_doc" name="deleted_Support_doc" value="">
                                
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
                                                    const deletedFilesInput = document.getElementById('deleted_Support_doc');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
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
                                    <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 5  ? 'disabled' : '' }}>Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()" {{ $data->stage == 0 || $data->stage == 5  ? 'disabled' : '' }}>Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()" {{ $data->stage == 0 || $data->stage == 5  ? 'disabled' : '' }}>Next</button>
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">
                                            Exit </a> </button>
                                </div>
                            </div>
                        </div>

                        <div id="CCForm4" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="row">
                                    <div class="sub-head">QA/CQA Verification</div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="qa_comments">QA/CQA Review Comments  @if($data->stage == 4) <span class="text-danger">*</span>@endif</label>
                                            <textarea {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 2 || $data->stage == 3 || $data->stage == 5 ? 'readonly' : '' }} name="qa_comments">{{ $data->qa_comments }}</textarea>
                                        </div>
                                    </div>

                                    {{-- <div class="col-12 sub-head">
                                        Extension Justification
                                    </div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="due_date_extension">Due Date Extension Justification</label>
                                            <textarea  {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} name="due_date_extension">{{ $data->due_date_extension }}</textarea>
                                        </div>
                                    </div> --}}



                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="final_attach">
                                            QA/CQA Verification Attachment 
                                        </label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="final_attach">
                                                @if ($data->final_attach)
                                                    @foreach(json_decode($data->final_attach) as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                            <input type="hidden" name="existing_final_attach[]" value="{{ $file }}">
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="final_attach[]" 
                                                   {{ $data->stage == 0 || $data->stage == 1 || $data->stage == 2 || $data->stage == 3 || $data->stage == 5 ? 'readonly' : '' }}
                                                    oninput="addMultipleFiles(this, 'final_attach')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Hidden field to keep track of files to be deleted -->
                                <input type="hidden" id="deleted_final_attach" name="deleted_final_attach" value="">
                                
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
                                                    const deletedFilesInput = document.getElementById('deleted_final_attach');
                                                    let deletedFiles = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
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


                                </div>
                                <div class="button-block">
                                    <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} >Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} >Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} >Next</button>
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">
                                            Exit </a> </button>
                                </div>
                            </div>
                        </div>

                        <div id="CCForm5" class="inner-block cctabcontent">
                            <div class="inner-block-content">
                                <div class="sub-head">
                                Activity Log
                                </div>
                                <div class="row">
                                    <div class="col-lg-4" style="margin-bottom: 1rem" >
                                        <div class="group-input">
                                            <label for="submitted by">Submitted By</label>
                                            <div class="Date">@if ( $data->acknowledgement_by )
                                                {{ $data->acknowledgement_by }}
                                             @else   Not Applicable
                                        
                                           @endif</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input"  style="margin-bottom: 1rem" >
                                            <label for="submitted on">Submitted On</label>
                                            <div class="Date">
                                                @if ($data->acknowledgement_on)
                                                {{ $data->acknowledgement_on }}
                                                @else Not Applicable  
                                                @endif</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input"  style="margin-bottom: 1rem">
                                            <label for="submitted on">Submitted Comment</label>
                                            <div class="Date">
                                                @if ($data->cancelacknowledgement_commentled_by)
                                                {{ $data->cancelled_by }}
                                                @else Not Applicable  
                                                @endif
                                                </div>
                                        </div>
                                    </div>

                                  
                                    <div class="col-lg-4">
                                        <div class="group-input"  style="margin-bottom: 1rem">
                                            <label for="cancelled by">Approved By</label>
                                            <div class="Date">
                                                @if ($data->work_completion_by)
                                                {{ $data->work_completion_by }}
                                                @else Not Applicable  
                                                @endif</div> 
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input" style="margin-bottom: 1rem">
                                            <label for="cancelled on">Approved On</label>
                                            <div class="Date">
                                                @if ($data->work_completion_on)
                                                {{ $data->work_completion_on }}
                                                @else Not Applicable  
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input" style="margin-bottom: 1rem" >
                                            <label for="submitted on">Approved Comment</label>
                                            <div class="Date">
                                                @if ($data->work_completion_comment)
                                                {{ $data->work_completion_comment }}
                                                @else Not Applicable  
                                                @endif</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input" style="margin-bottom: 1rem">
                                            <label for="cancelled by">Acknowledge Complete By</label>
                                            <div class="Date">
                                                @if ($data->qa_varification_by)
                                                {{ $data->qa_varification_by }}
                                                @else Not Applicable  
                                                @endif
                                               </div> 
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input" style="margin-bottom: 1rem">
                                            <label for="cancelled on">Acknowledge Complete On</label>
                                            <div class="Date">
                                                @if ($data->qa_varification_on)
                                                {{ $data->qa_varification_on }}
                                                @else Not Applicable  
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input" style="margin-bottom: 1rem">
                                            <label for="submitted on"> Acknowledge Completete Comment</label>
                                            <div class="Date">
                                                @if ($data->qa_varification_comment)
                                                {{ $data->qa_varification_comment }}
                                                @else Not Applicable  
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More information required By">More information required By</label>
                                            <div class="Date">{{ $data->more_information_required_by }}</div> 
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="More information required On">More information required On</label>
                                            <div class="Date">{{ $data->more_information_required_on }}</div> 
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input">
                                            <label for="submitted on">Comment</label>
                                            <div class="Date">{{ $data->more_info_requ_comment }}</div>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-4">
                                        <div class="group-input" style="margin-bottom: 1rem">
                                            <label for="completed by">Verification Completed By</label>
                                            <div class="Date">
                                                @if ($data->completed_by)
                                                {{ $data->completed_by }}
                                                @else Not Applicable  
                                                @endif
                                                </div> 
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input" style="margin-bottom: 1rem">
                                            <label for="completed on">Verification Completed On</label>
                                            <div class="Date">
                                               
                                                @if ($data->completed_on)
                                                {{ $data->completed_on }}
                                                @else Not Applicable  
                                                @endif
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input" style="margin-bottom: 1rem">
                                            <label for="submitted on">Verification Completed Comment</label>
                                            <div class="Date">
                                                @if ($data->completed_comment)
                                                {{ $data->completed_comment }}
                                                @else Not Applicable  
                                                @endif
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input" style="margin-bottom: 1rem">
                                            <label for="cancelled by">Cancelled By</label>
                                            <div class="Date">
                                                @if ($data->cancelled_by)
                                                {{ $data->cancelled_by }}
                                                @else Not Applicable  
                                                @endif</div> 
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input" style="margin-bottom: 1rem">
                                            <label for="cancelled on">Cancelled On</label>
                                            <div class="Date">
                                                @if ($data->cancelled_on)
                                                {{ $data->cancelled_on }}
                                                @else Not Applicable  
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="group-input" style="margin-bottom: 1rem">
                                            <label for="submitted on">Cancelled Comment</label>
                                            <div class="Date">
                                                @if ($data->cancelled_comment)
                                                {{ $data->cancelled_comment }}
                                                @else Not Applicable  
                                                @endif
                                               </div>
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
                                Extension
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
            ele: '#related_records'
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
                <form action="{{ route('send-resampling', $data->id) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username<span class="text-danger">*</span></label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password<span class="text-danger">*</span></label>
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

    <div class="modal fade" id="more-info-required-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('moreinfoState_resampling', $data->id) }}" method="POST">
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
                            <input class="new-moreinfo" type="text" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input class="new-moreinfo" type="password" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <input class="new-moreinfo" type="comment" name="comment" required>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <!-- <div class="modal-footer">
                            <button type="submit" data-bs-dismiss="modal">Submit</button>
                            <button>Close</button>
                        </div> -->
                    <div class="modal-footer">
                        <button type="submit">
                            Submit
                        </button>
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

                        <form action="{{ route('resapling-stage-cancel', $data->id) }}" method="POST">
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
                                Resampling

                            </label>
                            <label for="minor">
                                <input type="radio" name="revision" id="minor">
                                Extension
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
        var textlen = maxLength - $('#docname').val().length;
        $('#rchars').text(textlen);
    
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>

@endsection
