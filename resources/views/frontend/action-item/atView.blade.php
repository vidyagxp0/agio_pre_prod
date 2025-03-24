@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')

<link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet'
        type='text/css' />
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'>
    </script>
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

        .new-moreinfo {
            width: 100%;
            margin-bottom: 10px;
            border-radius: 5px;
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
    {{-- ======================================
                CHANGE CONTROL VIEW
    ======================================= --}}
    <div id="rcms_form-head">
        <div class="container-fluid">
            <div class="inner-block">
                {{-- <div class="head">PR-0001</div> --}}
                <div class="slogan">
                    <strong>Site Division/Project :</strong>
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
                            $userRoles = DB::table('user_roles')
                                ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])
                                ->get();
                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                        @endphp
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                        {{--  <button class="button_theme1"> <a class="text-white" href="{{ url('send-notification', $data->id) }}"> Send Notification </a> </button>  --}}
                        {{-- {{ dd($data->stage);}} --}}
                        <a class="button_theme1 text-white" href="{{ url('rcms/action-item-audittrialshow', $data->id) }}">
                            Audit Trail </a>
                        @if ($data->stage == 1 && Helpers::check_roles($data->division_id, 'Action Item', 3))
                            <a href="#signature-modal"><button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#signature-modal">
                                    Submit
                                </button></a>
                            <a href="#cancel-modal"> <button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#cancel-modal">
                                    Cancel
                                </button></a>
                        @elseif($data->stage == 2 )
                           @if (Auth::user()->id == $data->assign_to || Helpers::check_roles($data->division_id, 'Action Item', 18))
                           <a href="#cancel-modal"> <button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#more-info-required-modal">
                                    More Information Required
                                </button></a>
                            <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#signature-modal">
                                    Acknowledge Complete
                                </button></a>
                           @endif
                        @elseif($data->stage == 3)
                        @if (Auth::user()->id == $data->assign_to || Helpers::check_roles($data->division_id, 'Action Item', 18))
                            <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#signature-modal">
                                    Complete
                                </button></a>
                            {{-- <a href="#cancel-modal"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Information Required
                            </button></a> --}}
                            @endif
                        @elseif($data->stage == 4 && (Helpers::check_roles($data->division_id, 'Action Item', 7) || Helpers::check_roles($data->division_id, 'Action Item', 66)))
                            <a href="#last-stage-modal"> <button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#last-stage-modal">
                                    Verification Complete
                                </button></a>
                            <a href="#cancel-modal"><button class="button_theme1" data-bs-toggle="modal"
                                    data-bs-target="#more-info-required-modal">
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
                                    <div class="active">Acknowledge</div>
                                @else
                                    <div class="">Acknowledge</div>
                                @endif
                                @if ($data->stage >= 3)
                                    <div class="active">Work Completion</div>
                                @else
                                    <div class="">Work Completion </div>
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
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Acknowledge</button>
                {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Parent General Information</button> --}}
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Post Completion</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA/CQA Verification</button>
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
                                        <input type="hidden" name="record_number">
                                        <input disabled type="text"
                                            value="{{ Helpers::getDivisionName($data->division_id) }}/AI/{{ Helpers::year($data->created_at) }}/{{ $data->record }}">

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
                                {{-- <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Date Due"><b>Date of Initiation</b></label>
                                            <input disabled type="text" name="intiation_date"
                                                value="{{ Helpers::getdateFormat($data->intiation_date) }}">
                                        </div>
                                    </div> --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date Due"><b>Date of Initiation</b></label>
                                        @php
                                            $formattedDate = \Carbon\Carbon::parse($data->intiation_date)->format(
                                                'j-F-Y',
                                            );
                                        @endphp
                                        <input disabled type="text" value="{{ $formattedDate }}"
                                            name="intiation_date_display">
                                        <input type="hidden" value="{{ date('d-m-Y') }}" name="intiation_date">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Parent Record Number</b></label>
                                        @if($data->parent_record_number)
                                        <input readonly type="text" name="parent_record_number"
                                            value="{{ $data->parent_record_number }}">
                                        @else
                                        <input type="text" name="parent_record_number_edit"
                                        value="{{ $data->parent_record_number_edit }}">
                                        @endif
                                    </div>
                                </div>


                               
                                <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="search">
                                                Assigned To <span class="text-danger">*</span>
                                            </label>
                                            <select {{ $data->stage == 0 || $data->stage >= 2 ? "disabled" : "" }}
                                                id="select-state" placeholder="Select..." name="assign_to" required>
                                                <option value="">Select a value</option>
                                                @foreach ($users as $value)
                                                    <option {{ $data->assign_to == $value->id ? 'selected' : '' }}
                                                        value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @error('assign_to')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

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


                                        <div class="col-md-6 new-date-data-field">
                                                    <div class="group-input input-date ">
                                                        <label for="capa_date_due">Due Date</label>
                                                        <div class="calenderauditee">
                                                            <input type="text" name="due_date"
                                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                {{ $data->stage == 0 || $data->stage >= 2 ? "disabled" : "" }}
                                                                id="due_date" readonly
                                                                placeholder="DD-MMM-YYYY"
                                                                value="{{ Helpers::getdateFormat($data->due_date) }}" />
                                                            <input type="date" class="hide-input"
                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                            {{ $data->stage == 0 || $data->stage >= 2 ? "disabled" : "" }}
                                                                value="{{ Helpers::getdateFormat($data->due_date) }}"
                                                                oninput="handleDateInput(this, 'due_date')" />
                                                        </div>
                                                    </div>
                                                </div>

                                    <!-- <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Due Date"> Due Date</label>
                                            <div class="calenderauditee">
                                                {{-- Display the formatted date or placeholder --}}
                                                <input type="text" id="due_date_display" readonly
                                                    placeholder="DD-MMM-YYYY"
                                                    value="{{ $data->due_date ? \Carbon\Carbon::parse($data->due_date)->format('d-M-Y') : '' }}" />

                                                {{-- Date input field --}}
                                                <input type="date" name="due_date"
                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    value="{{ $data->due_date ? \Carbon\Carbon::parse($data->due_date)->format('Y-m-d') : '' }}"
                                                    class="hide-input"
                                                    onchange="handleDateInput(this, 'due_date_display')" />
                                            </div>
                                        </div>
                                    </div> -->

                                    <script>
                                        function handleDateInput(dateInput, displayId) {
                                            // Check if a valid date is selected
                                            if (dateInput.value) {
                                                const date = new Date(dateInput.value);
                                                const options = {
                                                    day: '2-digit',
                                                    month: 'short',
                                                    year: 'numeric'
                                                };
                                                document.getElementById(displayId).value = date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                            } else {
                                                // Clear the display if no date is selected
                                                document.getElementById(displayId).value = '';
                                            }
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
                                    @if ($data->stage == 1)
                                        <div class="group-input">
                                            <label for="Short Description">Short Description<span
                                                    class="text-danger">*</span></label><span id="rchars">255</span>
                                            characters remaining
                                            <input name="short_description" id="docname" type="text"
                                                value="{{ $data->short_description }}" maxlength="255" required
                                                {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                type="text">

                                        </div>
                                    @else
                                        <div class="group-input">
                                            <label for="Short Description">Short Description<span
                                                    class="text-danger">*</span></label><span id="rchars">255</span>
                                            characters remaining
                                            <input name="short_description" id="docname" type="text"
                                                value="{{ $data->short_description }}" maxlength="255" readonly
                                                {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                type="text">

                                        </div>
                                    @endif
                                    @error('short_description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    <p id="docnameError" style="color:red">**Short Description is required</p>
                                </div>


                                <!-- <div class="col-lg-6">
                                    @if ($data->stage == 1)
                                        <div class="group-input">
                                            <label for="Related Records">Action Item Related Records</label>
                                            <select {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }} multiple
                                                id="related_records" name="related_records[]"
                                                placeholder="Select Reference Records">

                                                @if (!empty($old_record))
                                                    @foreach ($old_record as $new)
                                                        @php
                                                            $recordValue =
                                                                Helpers::getDivisionName($new->division_id) .
                                                                '/AI/' .
                                                                date('Y') .
                                                                '/' .
                                                                Helpers::recordFormat($new->record);
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
                                    @else
                                        <div class="group-input">
                                            <label for="Related Records">Action Item Related Records</label>
                                            <select disabled {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}
                                                multiple id="related_records" name="related_records[]"
                                                placeholder="Select Reference Records">

                                                @if (!empty($old_record))
                                                    @foreach ($old_record as $new)
                                                        @php
                                                            $recordValue =
                                                                Helpers::getDivisionName($new->division_id) .
                                                                '/AI/' .
                                                                date('Y') .
                                                                '/' .
                                                                Helpers::recordFormat($new->record);
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
                                    @endif
                                    @error('related_records')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror


                                </div> -->

                                <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="HOD Persons">Action Item Related Records <span class="text-danger">*</span></label>
                                           <input type="text" name="related_records" required value="{{ $data->related_records }}">
                                        </div>
                                    @error('hod_preson')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="HOD Persons">HOD Persons <span class="text-danger">*</span></label>
                                            <select name="hod_preson[]" placeholder="Select HOD Persons" required
                                                data-search="false" data-silent-initial-value-set="true"
                                                {{ $data->stage == 0 || $data->stage >= 2 ? "disabled" : "" }}>
                                                <option value="">Select Person</option>
                                                @foreach ($users as $value)
                                                    <option value="{{ $value->name }}"
                                                        {{ in_array($value->name, explode(',', $data->hod_preson)) ? 'selected' : '' }}>
                                                        {{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @error('hod_preson')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                @if ($data->stage == 1)
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="description">Description <span class="text-danger">*</span></label>
                                            <textarea class="summernote" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} name="description" id="" required>{{ $data->description }}</textarea>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="description">Description</label>
                                            <textarea class="summernote" readonly {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} name="description" id="" >{{ $data->description }}</textarea>
                                        </div>
                                    </div>
                                @endif
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            {{--

                                <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="Responsible Department">Responsible Department</label>
                                            <select {{ $data->stage == 0 || $data->stage >= 2 ? "disabled" : "" }}
                                                name="departments">
                                                <option value="">-- Select --</option>
                                                <option value=" Corporate Quality Assurance" @if ($data->departments == ' Corporate Quality Assurance') selected @endif>
                                                    Corporate Quality Assurance</option>
                                                <option value="Quality Assurance" @if ($data->departments == 'Quality Assurance') selected @endif>
                                                    Quality Assurance</option>
                                                <option value="Quality Control" @if ($data->departments == 'Quality Control') selected @endif>
                                                    Quality Control</option>
                                                <option value="Quality Control (Microbiology department)" @if ($data->departments == 'Quality Control (Microbiology department)') selected @endif>
                                                    Quality Control (Microbiology department)
                                                </option>
                                                <option value="Production General" @if ($data->departments == 'Production General') selected @endif>
                                                    Production General</option>
                                                <option value="Production Liquid Orals" @if ($data->departments == 'Production Liquid Orals') selected @endif>
                                                    Production Liquid Orals</option>
                                                <option value="Production Tablet and Powder" @if ($data->departments == 'Production Tablet and Powder') selected @endif>
                                                    Production Tablet and Powder</option>
                                                <option value="Production External (Ointment, Gels, Creams and Liquid)" @if ($data->departments == 'Production External (Ointment, Gels, Creams and Liquid)') selected @endif>
                                                    Production External (Ointment, Gels, Creams and Liquid)</option>
                                                <option value="Production Capsules" @if ($data->departments == 'Production Capsules') selected @endif>
                                                    Production Capsules</option>
                                                <option value="Production Injectable" @if ($data->departments == 'Production Injectable') selected @endif>
                                                    Production Injectable</option>
                                                <option value="Engineering" @if ($data->departments == 'Engineering') selected @endif>
                                                    Engineering</option>
                                                <option value="Human Resource" @if ($data->departments == 'Human Resource') selected @endif>
                                                    Human Resource</option>
                                                <option value="Store" @if ($data->departments == 'Store') selected @endif>
                                                    Store</option>
                                                <option value="Electronic Data Processing" @if ($data->departments == 'Electronic Data Processing') selected @endif>
                                                    Electronic Data Processing
                                                </option>
                                                <option value="Formulation Development" @if ($data->departments == 'Formulation Development') selected @endif>
                                                    Formulation Development
                                                </option>
                                                <option value="Analytical research and Development Laboratory" @if ($data->departments == 'Analytical research and Development Laboratory') selected @endif>
                                                    Analytical research and Development Laboratory
                                                </option>
                                                <option value="Packaging Development" @if ($data->departments == 'Packaging Development') selected @endif>
                                                    Packaging Development
                                                </option>

                                                <option value="Purchase Department" @if ($data->departments == 'Purchase Department') selected @endif>
                                                    Purchase Department
                                                </option>
                                                <option value="Document Cell" @if ($data->departments == 'Document Cell') selected @endif>
                                                    Document Cell
                                                </option>
                                                <option value="Regulatory Affairs" @if ($data->departments == 'Regulatory Affairs') selected @endif>
                                                    Regulatory Affairs
                                                </option>
                                                <option value="Pharmacovigilance" @if ($data->departments == 'Pharmacovigilance') selected @endif>
                                                    Pharmacovigilance
                                                </option>
                                            </select>

                                        </div>
                                    @error('departments')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                --}}


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Responsible Department</b></label>
                                        <input readonly type="text" name="departments" id="initiator_group" value="{{ $data->departments ?? '' }}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    @if ($data->stage == 1)
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
                                                                <a type="button" class="remove-file1"
                                                                    data-file-name="{{ $file }}">
                                                                    <i class="fa-solid fa-circle-xmark"
                                                                        style="color:red; font-size:20px;"></i>
                                                                    </a>
                                                            <input type="hidden" name="existing_fileAttachments[]" value="{{ $file }}">

                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="file_attach[]"
                                                        oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                                </div>
                                            </div>

                                        </div>
                                <input type="hidden" id="deleted_file_Attachments" name="deleted_file_Attachments" value="">
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeButtons = document.querySelectorAll('.remove-file1');

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
                                                    const deletedFilesInput = document.getElementById('deleted_file_Attachments');
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

                                    @else
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
                                                    <input disabled
                                                        {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="file_attach[]"
                                                        oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                                </div>
                                            </div>

                                        </div>
                                    @endif
                                    @error('file_attach')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>Save</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>

                            </div>
                        </div>
                    </div>

                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                @if ($data->stage == 2)
                                <div class="sub-head">Acknowledge</div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="qa_comments">Acknowledge Comment @if ($data->stage == 2)
                                                <span class="text-danger">*</span>
                                            @endif</label>
                                            <textarea name="acknowledge_comments" {{ $data->stage == 2 ? '' : 'readonly' }} required>{{ $data->acknowledge_comments }}</textarea>
                                        </div>
                                    </div>
                                    @else
                                    <div class="sub-head">Acknowledge</div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="qa_comments">Acknowledge Comment</label>
                                            <textarea name="acknowledge_comments" readonly {{ $data->stage == 2 ? '' : 'readonly' }}>{{ $data->acknowledge_comments }}</textarea>
                                        </div>
                                    </div>
                                @endif



                                @error('acknowledge_comments')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror


                                    <div class="col-lg-12">
                                        <div class="group-input">
                                            <label for="file_attach">Acknowledge Attachment</label>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="acknowledge_attach">
                                                    @if ($data->acknowledge_attach)
                                                    @foreach (json_decode($data->acknowledge_attach) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}"
                                                                target="_blank"><i class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file2"
                                                                data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i>
                                                                </a>
                                                        <input type="hidden" name="existing_fileAttachments[]" value="{{ $file }}">

                                                        </h6>
                                                    @endforeach
                                                @endif

                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input
                                                        type="file" id="myfile" name="acknowledge_attach[]"
                                                        oninput="addMultipleFiles(this, 'acknowledge_attach')" multiple {{ $data->stage == 2 ? '' : 'disabled' }}>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <input type="hidden" id="deleted_Acknoledge_Attachments" name="deleted_Acknoledge_Attachments" value="">
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const removeButtons = document.querySelectorAll('.remove-file2');

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
                                                        const deletedFilesInput = document.getElementById('deleted_Acknoledge_Attachments');
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

                                @error('acknowledge_attach')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror


                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
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
                                @if ($data->stage == 3)
                                    <div class="sub-head col-12">Post Completion</div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="action_taken">Action Taken @if ($data->stage == 3)
                                                    <span class="text-danger">*</span>
                                                @endif
                                            </label>
                                            <textarea {{ $data->stage == 3 ? '' : 'readonly' }} name="action_taken" required>{{ $data->action_taken }}</textarea>
                                        </div>
                                    </div>
                                @else
                                    <div class="sub-head col-12">Post Completion</div>
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="action_taken">Action Taken
                                                {{--@if ($data->stage == 3)
                                                    <span class="text-danger">*</span>
                                                @endif--}}
                                            </label>
                                            <textarea class="tiny" readonly {{ $data->stage == 3 ? '' : 'readonly' }} name="action_taken">{{ $data->action_taken }}</textarea>
                                        </div>
                                    </div>
                                @endif
                                @error('action_taken')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="row">
                                @if ($data->stage == 3)
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Audit Schedule Start Date">Actual Start Date <span class="text-danger">*</span></label>
                                            <div class="calenderauditee">
                                                <input type="text" id="start_date" placeholder="DD-MMM-YYYY"
                                                    value="{{ Helpers::getdateFormat($data->start_date) }}" />
                                                <input class="hide-input" type="date"
                                                    name="start_date"{{ $data->stage == 3 ? '' : 'readonly' }}
                                                    id="start_date_checkdate" value="{{ $data->start_date }}"
                                                    oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')" required/>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Audit Schedule Start Date">Actual Start Date <span class="text-danger">*</span></label>
                                            <div class="calenderauditee">
                                                <input type="text" id="start_date" class="tiny" readonly
                                                    placeholder="DD-MMM-YYYY"
                                                    value="{{ Helpers::getdateFormat($data->start_date) }}" />
                                                <input class="hide-input" type="date" readonly
                                                    name="start_date"{{ $data->stage == 3 ? '' : 'readonly' }}
                                                    id="start_date_checkdate" value="{{ $data->start_date }}"
                                                    oninput="handleDateInput(this, 'start_date');checkDate('start_date_checkdate','end_date_checkdate')" required/>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                                @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                @if ($data->stage == 3)
                                    <div class="col-lg-6 new-date-data-field">
                                        <div class="group-input input-date">
                                            <label for="Audit Schedule End Date">Actual End Date <span class="text-danger">*</span></label>
                                            {{-- <input type="date" name="end_date" value="{{ $data->end_date }}" --}}
                                            <div class="calenderauditee">
                                                <input type="text" id="end_date" placeholder="DD-MMM-YYYY"
                                                    value="{{ Helpers::getdateFormat($data->end_date) }}" />
                                                <input class="hide-input" type="date"
                                                    name="end_date" {{ $data->stage == 3 ? '' : 'readonly' }}
                                                    id="end_date_checkdate" value="{{ $data->end_date }}"
                                                    oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" required />
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <label for="Audit Schedule End Date">Actual End Date</label>
                                                {{-- <input type="date" name="end_date" value="{{ $data->end_date }}" --}}
                                                <div class="calenderauditee">
                                                    <input type="text" id="end_date" class="tiny" readonly
                                                        placeholder="DD-MMM-YYYY"
                                                        value="{{ Helpers::getdateFormat($data->end_date) }}" />
                                                    <input class="hide-input" type="date" readonly
                                                        name="end_date" {{ $data->stage == 3 ? '' : 'readonly' }}
                                                        id="end_date_checkdate" value="{{ $data->end_date }}"
                                                        oninput="handleDateInput(this, 'end_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                                </div>
                                            </div>

                                        </div>
                                @endif
                                @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            @if ($data->stage == 3)
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments">Comments <span class="text-danger">*</span></label>
                                        <textarea {{ $data->stage == 3 ? '' : 'readonly' }} name="comments" required>{{ $data->comments }}</textarea>
                                    </div>
                                </div>
                            @else
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Comments">Comments</label>
                                        <textarea {{ $data->stage == 3 ? '' : 'readonly' }} name="comments" readonly>{{ $data->comments }}</textarea>
                                    </div>
                                </div>
                            @endif
                            @error('comments')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        @if ($data->stage == 3)
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="file_attach">Completion Attachment</label>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Support_doc">
                                            @if ($data->Support_doc)
                                                @foreach (json_decode($data->Support_doc) as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file3"
                                                            data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                            <input type="hidden" name="existing_completion_Attachments[]" value="{{ $file }}">

                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $data->stage == 3 ? '' : 'disabled' }}
                                                type="file" id="myfile" name="Support_doc[]"
                                                oninput="addMultipleFiles(this, 'Support_doc')" multiple>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <input type="hidden" id="deleted_completion_Attachments" name="deleted_completion_Attachments" value="">
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const removeButtons = document.querySelectorAll('.remove-file3');

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
                                                const deletedFilesInput = document.getElementById('deleted_completion_Attachments');
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
                        @else
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="file_attach">Completion Attachment</label>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Support_doc">
                                            @if ($data->Support_doc)
                                                @foreach (json_decode($data->Support_doc) as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file3"
                                                            data-file-name="{{ $file }}"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input disabled {{ $data->stage == 3 ? '' : 'disabled' }}
                                                type="file" id="myfile" name="Support_doc[]"
                                                oninput="addMultipleFiles(this, 'Support_doc')" class="tiny" multiple>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif
                        @error('Support_doc')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror


                        <div class="button-block">
                            <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

                <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head">QA/CQA Verification</div>
                            @if ($data->stage == 4)
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_comments">QA/CQA Verification Comments @if ($data->stage == 4)
                                                <span class="text-danger">*</span>
                                            @endif
                                        </label>
                                        <textarea {{ $data->stage == 4 ? '' : 'readonly' }} name="qa_comments" required>{{ $data->qa_comments }}</textarea>
                                    </div>
                                </div>
                            @else
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="qa_comments">QA/CQA Verification Comments @if ($data->stage == 4)
                                                <span class="text-danger">*</span>
                                            @endif </label>
                                        <textarea class="tiny" readonly {{ $data->stage == 4 ? '' : 'readonly' }} name="qa_comments">{{ $data->qa_comments }}</textarea>
                                    </div>

                                </div>
                            @endif
                            @error('qa_comments')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            {{-- <div class="col-12 sub-head">
                                    Extension Justification
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="due_date_extension">Due Date Extension Justification</label>
                                        <textarea {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }} name="due_date_extension">{{ $data->due_date_extension }}</textarea>
                                    </div>
                                </div> --}}
                            @if ($data->stage == 4)
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="file_attach">QA/CQA Verification Attachment</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="final_attach">
                                                @if ($data->final_attach)
                                                    @foreach (json_decode($data->final_attach) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                    class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file4"
                                                                data-file-name="{{ $file }}"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                            <input type="hidden" name="existing_Approval_Attachments[]" value="{{ $file }}">

                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $data->stage == 4 ? '' : 'disabled' }}
                                                    type="file" id="myfile" name="final_attach[]"
                                                    oninput="addMultipleFiles(this, 'final_attach')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <input type="hidden" id="deleted_Approval_Attachments" name="deleted_Approval_Attachments" value="">
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const removeButtons = document.querySelectorAll('.remove-file4');

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
                                                    const deletedFilesInput = document.getElementById('deleted_Approval_Attachments');
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
                            @else
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="file_attach">QA/CQA Verification Attachments</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="final_attach">
                                                @if ($data->final_attach)
                                                    @foreach (json_decode($data->final_attach) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                    class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file4"
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
                                                {{ $data->stage == 3 ? '' : 'disabled' }}
                                                    type="file" id="myfile" name="final_attach[]"
                                                    oninput="addMultipleFiles(this, 'final_attach')" multiple>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            @endif
                            @error('final_attach')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror


                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 5 ? 'disabled' : '' }}>Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>
                <style>
                    .static{
                        font-weight: 100 !important;
                    }
                </style>

                <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            Activity Log
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="submitted by">Submit By</label>
                                    <div class="static">@if ($data->submitted_by){{ $data->submitted_by }}@else Not Applicable @endif</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="submitted on">Submit On</label>
                                    <div class="Date">@if ($data->submitted_on){{ $data->submitted_on }}@else Not Applicable @endif</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Submit Comment</label>
                                    <div class="static">@if ($data->submitted_comment){{ $data->submitted_comment }}@else Not Applicable @endif</div>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                            <div class="sub-head">Cancel</div>
                                        </div> -->
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled by">Cancel By</label>
                                    <div class="static">@if ($data->cancelled_by){{ $data->cancelled_by }}@else Not Applicable @endif</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled on">Cancel On</label>
                                    <div class="Date">@if ($data->cancelled_on){{ $data->cancelled_on }}@else Not Applicable @endif</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Cancel Comment</label>
                                    <div class="static">@if ($data->cancelled_comment){{ $data->cancelled_comment }}@else Not Applicable @endif</div>
                                </div>
                            </div>

                            <!-- <div class="col-12">
                                            <div class="sub-head">Acknowledge Complete</div>
                                        </div> -->

                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled by">Acknowledge Complete By</label>
                                    <div class="static">@if ($data->acknowledgement_by){{ $data->acknowledgement_by }}@else Not Applicable @endif</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled on">Acknowledge Complete On</label>
                                    <div class="Date">@if ($data->acknowledgement_on){{ $data->acknowledgement_on }}@else Not Applicable @endif</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Acknowledge Complete Comment</label>
                                    <div class="static">@if ($data->acknowledgement_comment){{ $data->acknowledgement_comment }}@else Not Applicable @endif</div>
                                </div>
                            </div>

                            <!-- <div class="col-12">
                                            <div class="sub-head">Complete</div>
                                        </div> -->

                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled by">Complete By</label>
                                    <div class="static">@if ($data->work_completion_by){{ $data->work_completion_by }}@else Not Applicable @endif</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled on">Complete On</label>
                                    <div class="Date">@if ($data->work_completion_on){{ $data->work_completion_on }}@else Not Applicable @endif</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Complete Comment</label>
                                    <div class="static">@if ($data->work_completion_comment){{ $data->work_completion_comment }}@else Not Applicable @endif</div>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                            <div class="sub-head">Verification Complete</div>
                                        </div> -->
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled by">Verification Complete By</label>
                                    <div class="static">@if ($data->qa_varification_by){{ $data->qa_varification_by }}@else Not Applicable @endif</div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="group-input">
                                    <label for="cancelled on">Verification Complete On</label>
                                    <div class="Date">@if ($data->qa_varification_on){{ $data->qa_varification_on }}@else Not Applicable @endif</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted on">Verification Complete Comment</label>
                                    <div class="static">@if ($data->qa_varification_comment){{ $data->qa_varification_comment }}@else Not Applicable @endif</div>
                                </div>
                            </div>

                            <!-- <div class="col-lg-4">
                                                                                <div class="group-input">
                                                                                    <label for="More information required By">More information required By</label>
                                                                                    <div class="static">{{ $data->more_information_required_by }}</div>
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
                                                                                    <div class="static">{{ $data->more_info_requ_comment }}</div>
                                                                                </div>
                                                                            </div> -->
                            <!-- <div class="col-lg-4">
                                                                                <div class="group-input">
                                                                                    <label for="completed by">Completed By</label>
                                                                                    <div class="static">{{ $data->completed_by }}</div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="group-input">
                                                                                    <label for="completed on">Completed On</label>
                                                                                    <div class="Date">{{ $data->completed_on }}</div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="group-input">
                                                                                    <label for="submitted on">Comment</label>
                                                                                    <div class="static">{{ $data->completed_comment }}</div>
                                                                                </div>
                                                                            </div> -->

                        </div>
                        <div class="button-block">
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
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

                <form action="{{ url('rcms/moreinfoState_actionitem', $data->id) }}" method="POST">
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


    <style>
          .input_width {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 11px;
        }
    </style>

    <div class="modal fade" id="last-stage-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/action-stage-last', $data->id) }}" method="POST">
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
                    <input type="text" class="hide-input" name="due_date_action" value="{{ Helpers::getdateFormat($due_date_data ) }}" readonly style="font-size: 14px;" />

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
                    <input type="text" class="hide-input" name="due_date_action" value="{{ Helpers::getdateFormat($due_date_data ) }}" readonly style="font-size: 14px;" />


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
        var textlen = maxLength - $('#docname').val().length;
        $('#rchars').text(textlen);

        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>

@endsection
