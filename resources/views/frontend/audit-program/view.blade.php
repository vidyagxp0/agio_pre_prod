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
        $users = DB::table('users')
            ->select('id', 'name')
            ->get();

    @endphp



    <script>
        function otherController(value, checkValue, blockID) {
            let block = document.getElementById(blockID)
            let blockTextarea = block.getElementsByTagName('textarea')[0];
            let blockLabel = block.querySelector('label span.text-danger');
            if (value === checkValue) {
                blockLabel.classList.remove('d-none');
                blockTextarea.setAttribute('required', 'required');
            } else {
                blockLabel.classList.add('d-none');
                blockTextarea.removeAttribute('required');
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#audit_program').click(function(e) {
                function generateTableRow(serialNumber) {
                    var users = @json($users);
                    console.log(users);
                    var html =
                        '<tr>' +
                        '<td><input type="text" name="serial_number[]" value="' + serialNumber + '"></td>' +
                        '<td><select name="Auditees[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }

                    html += '</select></td>' +
                        // '<td><input type="date" name="start_date[]"></td>' +
                        '<td><div class="group-input new-date-data-field mb-0">
                        <div class="input-date "><div class="calenderauditee"> 
                        <input type="text" id="start_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" />
                        <input type="date" class="hide-input" name="start_date[]"   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"   {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }} id="start_date' + serialNumber +'_checkdate"  
                         oninput="handleDateInput(this, `start_date' + serialNumber +'`);checkDate(`start_date' + serialNumber +'_checkdate`,`end_date' + serialNumber +'_checkdate`)" /></div></div></div></td>' +

                        // '<td><input type="date" name="end_date[]"></td>' +
                        '<td><div class="group-input new-date-data-field mb-0">
                        <div class="input-date "><div class="calenderauditee">
                         <input type="text" id="end_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" />
                         <input type="date" name="end_date[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="end_date'+ serialNumber +'_checkdate" class="hide-input" oninput="handleDateInput(this, `end_date' + serialNumber +'`);checkDate(`start_date' + serialNumber +'_checkdate`,`end_date' + serialNumber +'_checkdate`)" /></div></div></div></td>' 

                        '<td><select name="lead_investigator[]">' +
                        '<option value="">Select a value</option>';

                    for (var i = 0; i < users.length; i++) {
                        html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    }
                    html += '</select></td>' +
                        '<td><input type="text" name="comment[]"></td>' +
                        '</tr>';

                    return html;
                }

                var tableBody = $('#audit_program_body tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            let country_arr = new Array("-- Select --", "AUSTRALIA", "INDIA", "NEW ZEALAND", "USA", "UAE",
                "MAURITIUS");

            $.each(country_arr, function(i, item) {
                $('#country').append($('<option>', {
                    value: i,
                    text: item,
                }, '</option>'));
            });

            let s_a = new Array();
            s_a[0] = "-- Select --";
            s_a[1] = "-- Select --|QUEENSLAND|VICTORIA";
            s_a[2] =
                "-- Select --|ANDHRAPRADESH|KARNATAKA|TAMILNADU|DELHI|GOA|WEST-BENGAL|GUJARAT|MADHYAPRADESH|MAHARASHTRA|RAJASTHAN";
            s_a[3] = "-- Select --|AUCKLAND";
            s_a[4] = "-- Select --|NEWJERSEY|ILLINOIS";
            s_a[5] = "-- Select --|DUBAI";
            s_a[6] = "-- Select --|MAURITIUS";

            let c_a = new Array();
            c_a['QUEENSLAND'] = "-- Select --|BRISBANE";
            c_a['VICTORIA'] = "-- Select --|MELBOURNE";
            c_a['ANDHRAPRADESH'] = "-- Select --|HYDERABAD";
            c_a['KARNATAKA'] = "-- Select --|BANGLORE";
            c_a['TAMILNADU'] = "-- Select --|CHENNAI";
            c_a['DELHI'] = "-- Select --|DELHI";
            c_a['GOA'] = "-- Select --|GOA";
            c_a['W-BENGAL'] = "-- Select --|KOLKATA";
            c_a['GUJARAT'] =
                "-- Select --|AHMEDABAD1|AHMEDABAD2|AHMEDABAD3|BARODA|BHAVNAGAR|MEHSANA|RAJKOT|SURAT|UNA";
            c_a['MADHYAPRADESH'] = "-- Select --|INDORE";
            c_a['MAHARASHTRA'] = "-- Select --|MUMBAI|PUNE";
            c_a['RAJASTHAN'] = "-- Select --|ABU";
            c_a['AUCKLAND'] = "-- Select --|AUCKLAND";
            c_a['NEWJERSEY'] = "-- Select --|EDISON";
            c_a['ILLINOIS'] = "-- Select --|CHICAGO";
            c_a['MAURITIUS'] = "-- Select --|MAURITIUS";
            c_a['DUBAI'] = "-- Select --|DUBAI";

            $('#country').change(function() {
                let c = $(this).val();
                let state_arr = s_a[c].split("|");
                $('#state').empty();
                $('#city').empty();
                if (c == 0) {
                    $('#state').append($('<option>', {
                        value: '0',
                        text: '-- Select --',
                    }, '</option>'));
                } else {
                    $.each(state_arr, function(i, item_state) {
                        $('#state').append($('<option>', {
                            value: item_state,
                            text: item_state,
                        }, '</option>'));
                    });
                }
                $('#city').append($('<option>', {
                    value: '0',
                    text: '-- Select --',
                }, '</option>'));
            });

            $('#state').change(function() {
                let s = $(this).val();
                if (s == '-- Select --') {
                    $('#city').empty();
                    $('#city').append($('<option>', {
                        value: '0',
                        text: '-- Select --',
                    }, '</option>'));
                }
                let city_arr = c_a[s].split("|");
                $('#city').empty();

                $.each(city_arr, function(j, item_city) {
                    $('#city').append($('<option>', {
                        value: item_city,
                        text: item_city,
                    }, '</option>'));
                });

            });
        });
    </script>

    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($data->division_id) }} / Audit Program
        </div>
    </div>

    {{-- ---------------------- --}}
    <div id="change-control-view">
        <div class="container-fluid">

            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>
                    @php
                        $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                    @endphp
                    <div class="d-flex" style="gap:20px;">
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                        <button class="button_theme1"> <a class="text-white"
                                href="{{ route('showAuditProgramTrial', $data->id) }}"> Audit Trail </a> </button>

                        @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                        @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds) || in_array(13, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approve
                            </button>
                            
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Reject
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 3 && (in_array(10, $userRoleIds) || in_array(18, $userRoleIds) || in_array(13, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Audit Completed 
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
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
                                <div class="active">Pending Approval </div>
                            @else
                                <div class="">Pending Approval</div>
                            @endif

                            @if ($data->stage >= 3)
                                <div class="active">Pending Audit</div>
                            @else
                                <div class="">Pending Audit</div>
                            @endif

                            @if ($data->stage >= 4)
                                <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif
                        </div>
                    @endif


                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
        </div>

        <div class="control-list">

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
                        <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Audit Program</button>
                        <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Signatures</button>
                    </div>

                    <form action="{{ route('AuditProgramUpdate', $data->id) }}" method="post"
                        enctype="multipart/form-data">
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
                                                <input disabled type="text" name="record_number"
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}/AP/{{ Helpers::year($data->created_at) }}/{{ $data->record }}">
                                                {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Division Code"><b>Site/Location Code</b></label>
                                                <input readonly type="text" name="division_code"{{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                    value="{{ Helpers::getDivisionName($data->division_id) }}">
                                                {{-- <div class="static">QMS-North America</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator"><b>Initiator</b></label>
                                                {{-- <div class="static">{{ Auth::user()->name }}</div> --}}
                                                <input disabled type="text" value="{{ $data->initiator_name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Date Due"><b>Date of Initiation</b></label>
                                                <input disabled type="text"
                                                    value="{{ Helpers::getdateFormat($data->intiation_date) }}"
                                                    name="intiation_date">

                                                {{-- <div class="static">{{ date('d-M-Y') }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="search">
                                                    Assigned To <span class="text-danger"></span>
                                                </label>
                                                <select id="select-state" placeholder="Select..." name="assign_to"
                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
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
                                                    name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                            </div>
                                        </div>
                                     <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group"><b>Initiator Group</b></label>
                                                <select name="Initiator_Group" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                     id="initiator_group">
                                                    <option value="Corporate Quality Assurance"
                                                        @if ($data->Initiator_Group== 'Corporate
                                                        Quality Assurance') selected @endif>Corporate
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
                                                        Team</option>
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
                                                <input type="text" name="initiator_group_code"{{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                    value="{{ $data->Initiator_Group}}" id="initiator_group_code"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Type">Type</label>
                                                <select name="type"
                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                    <option value="">-- Select --</option>
                                                    <option value="other"
                                                        @if ($data->type == 'other') selected @endif>other
                                                    </option>
                                                    <option value="annual"
                                                        @if ($data->type == 'annual') selected @endif>annual
                                                    </option>
                                                    <option value="monthly"
                                                        @if ($data->type == 'monthly') selected @endif>monthly
                                                    </option>
                                                    <option value="quarterly"
                                                        @if ($data->type == 'quarterly') selected @endif>quarterly
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Year">Year</label>
                                                <select name="year"
                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                    <option value="">-- Select --</option>
                                                    <option value="2024"
                                                        @if ($data->year == '2024') selected @endif>2024</option>
                                                    <option value="2025"
                                                        @if ($data->year == '2025') selected @endif>2025</option>
                                                    <option value="2026"
                                                        @if ($data->year == '2026') selected @endif>2026</option>
                                                    <option value="2027"
                                                        @if ($data->year == '2027') selected @endif>2027</option>
                                                    <option value="2028"
                                                        @if ($data->year == '2028') selected @endif>2028</option>
                                                    <option value="2029"
                                                        @if ($data->year == '2029') selected @endif>2029</option>
                                                    <option value="2030"
                                                        @if ($data->year == '2030') selected @endif>2030</option>
                                                    <option value="2031"
                                                        @if ($data->year == '2031') selected @endif>2031</option>
                                                    <option value="2032"
                                                        @if ($data->year == '2032') selected @endif>2032</option>
                                                    <option value="2033"
                                                        @if ($data->year == '2033') selected @endif>2033</option>
                                                    <option value="2034"
                                                        @if ($data->year == '2034') selected @endif>2034</option>
                                                    <option value="2035"
                                                        @if ($data->year == '2035') selected @endif>2035</option>
                                                    <option value="2036"
                                                        @if ($data->year == '2036') selected @endif>2036</option>
                                                    <option value="2037"
                                                        @if ($data->year == '2037') selected @endif>2037</option>
                                                    <option value="2038"
                                                        @if ($data->year == '2038') selected @endif>2038</option>
                                                    <option value="2039"
                                                        @if ($data->year == '2039') selected @endif>2039</option>
                                                    <option value="2040"
                                                        @if ($data->year == '2040') selected @endif>2040</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="group-input">
                                                <label for="Quarter">Quarter</label>
                                                <select name="Quarter"
                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                    <option value="">-- Select --</option>
                                                    <option value="Q1"
                                                        @if ($data->Quarter == 'Q1') selected @endif>Q1
                                                    </option>
                                                    <option value="Q2"
                                                        @if ($data->Quarter == 'Q2') selected @endif>Q2
                                                    </option>
                                                    <option value="Q3"
                                                        @if ($data->Quarter == 'Q3') selected @endif>Q3
                                                    </option>
                                                    <option value="Q4"
                                                        @if ($data->Quarter == 'Q4') selected @endif>Q4
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- ----------------------------------Audit program grid----------------------------------- -->

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="audit-program-grid">
                                                    Audit Program<button type="button" name="ann"
                                                        onclick="addAuditProgram('audit-program-grid')"
                                                        {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>+</button>
                                                </label>
                                                <table class="table table-bordered" id="audit-program-grid">
                                                    <thead>
                                                        <tr>
                                                            <th>Row #</th>
                                                            <th>Auditees</th>
                                                            <th>Date Start</th>
                                                            <th>Date End</th>
                                                            <th>Lead Investigator</th>
                                                            <th>Comment</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($AuditProgramGrid)
                                                        @foreach (unserialize($AuditProgramGrid->auditor) as $key => $temps)
                                                        <tr>
                                                            <td><input disabled type="text" name="serial_number[]" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                    value="{{ $key + 1 }}" ></td>
                                                            <td> <select id="select-state" placeholder="Select..."
                                                                    name="Auditees[]"  {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                                    <option value="">-Select-</option>
                                                                    @foreach ($users as $value)
                                                                        <option
                                                                            {{ unserialize($AuditProgramGrid->auditor)[$key] ? (unserialize($AuditProgramGrid->auditor)[$key] == $value->id ? 'selected' : ' ') : '' }}
                                                                            value="{{ $value->id }}">
                                                                            {{ $value->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select></td>
                                                            {{-- <td><input type="date" name="start_date[]"  {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                    value="{{ unserialize($AuditProgramGrid->start_date)[$key] ? unserialize($AuditProgramGrid->start_date)[$key] : '' }}"  {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                            </td>
                                                            <td><input type="date" name="end_date[]"  {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                            
                                                                    value="{{ unserialize($AuditProgramGrid->end_date)[$key] ? unserialize($AuditProgramGrid->end_date)[$key] : '' }}"  {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                            </td> --}}
                                                            
                                                            <td><div class="group-input new-date-data-field mb-0">
                                                                        <div class="input-date "><div class="calenderauditee">
                                                                         <input  type="text"   id="start_date{{$key}}" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat(unserialize($AuditProgramGrid->start_date)[$key]) }}"/>
                                                                                <input class="hide-input" type="date"  id="start_date{{$key}}_checkdate" value="{{unserialize($AuditProgramGrid->start_date)[$key]}}"  name="start_date[]"   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }} value="{{ Helpers::getdateFormat(unserialize($AuditProgramGrid->start_date)[$key]) }}
                                                                                   oninput="handleDateInput(this, `start_date' + serialNumber +'`)" /></div></div></div></td>
                                                                <td><div class="group-input new-date-data-field mb-0">
                                                                        <div class="input-date "><div
                                                                         class="calenderauditee">
                                                                         <input type="text"   id="end_date{{$key}}" readonly placeholder="DD-MMM-YYYY" value="{{ Helpers::getdateFormat(unserialize($AuditProgramGrid->end_date)[$key]) }}"/>
                                                                <input class="hide-input" type="date"  id="end_date{{$key}}_checkdate" value="{{unserialize($AuditProgramGrid->end_date)[$key]}}"  name="end_date[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }} value="{{ Helpers::getdateFormat(unserialize($AuditProgramGrid->end_date)[$key]) }}
                                                                  oninput="handleDateInput(this, `end_date' + serialNumber +'`)" /></div></div></div></td>
                                                                  <td> <select id="select-state" placeholder="Select..."
                                                                    name="lead_investigator[]"  {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                                                    <option value="">-Select-</option>
                                                                    @foreach ($users as $value)
                                                                        <option
                                                                            {{ unserialize($AuditProgramGrid->lead_investigator)[$key] ? (unserialize($AuditProgramGrid->lead_investigator)[$key] == $value->id ? 'selected' : ' ') : '' }}
                                                                            value="{{ $value->id }}">
                                                                            {{ $value->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select></td>
                                                            {{-- <td><input type="text" name="lead_investigator[]" value="{{unserialize($AuditProgramGrid->lead_investigator)[$key] ? unserialize($AuditProgramGrid->lead_investigator)[$key] : "" }}"></td> --}}
                                                            <td><input type="text" name="comment[]"  {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                                    value="{{ unserialize($AuditProgramGrid->comment)[$key] ? unserialize($AuditProgramGrid->comment)[$key] : '' }}">
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                        </div>

                            
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="Short Description">Short Description<span
                                                        class="text-danger">*</span></label><span id="rchars">255</span>
                                                characters remaining
                                                
                                                <textarea name="short_description"   id="docname" type="text"    maxlength="255" required  {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>{{ $data->short_description }}</textarea>
                                            </div>
                                            <p id="docnameError" style="color:red">**Short Description is required</p>
        
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="severity-level">Severity Level</label>
                                                <span class="text-primary">Severity levels in a QMS record gauge issue seriousness, guiding priority for corrective actions. Ranging from low to high, they ensure quality standards and mitigate critical risks.</span>
                                                <select {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }} name="severity1_level">
                                                    <option value="0">-- Select --</option>
                                                    <option @if ($data->severity1_level == 'minor') selected @endif
                                                     value="minor">Minor</option>
                                                    <option  @if ($data->severity1_level == 'major') selected @endif 
                                                    value="major">Major</option>
                                                    <option @if ($data->severity1_level == 'critical') selected @endif
                                                    value="critical">Critical</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Initiator Group">Initiated Through</label>
                                                <div><small class="text-primary">Please select related information</small></div>
                                                <select {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }} name="initiated_through"
                                                    onchange="otherController(this.value, 'others', 'initiated_through_req')">
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option @if ($data->initiated_through == 'recall') selected @endif
                                                        value="recall">Recall</option>
                                                    <option @if ($data->initiated_through == 'return') selected @endif
                                                        value="return">Return</option>
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
                                                        value="others">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="initiated_through_req">
                                                <label for="initiated_through">Others<span
                                                        class="text-danger d-none">*</span></label>
                                                <textarea name="initiated_through_req"{{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>{{ $data->initiated_through_req }}</textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="repeat">Repeat</label>
                                                <select name="repeat"
                                                    onchange="otherController(this.value, 'yes', 'repeat_nature')">
                                                    <option value="">Enter Your Selection Here</option>
                                                    <option @if ($data->repeat == 'yes') selected @endif
                                                        value="yes">Yes</option>
                                                    <option @if ($data->repeat == 'no') selected @endif
                                                        value="no">No</option>
                                                    <option @if ($data->repeat == 'na') selected @endif
                                                        value="na">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input" id="repeat_nature">
                                                <label for="repeat_nature">Repeat Nature<span
                                                        class="text-danger d-none">*</span></label>
                                                <textarea name="repeat_nature">{{ $data->repeat_nature }}</textarea>
                                            </div>
                                        </div> --}}
                                        
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="comments">Comments</label>
                                                <textarea name="comments" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>{{ $data->comments }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="group-input">
                                                <label for="attachments">Attached Files</label>
                                                <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>
                                                <div class="file-attachment-field" >
                                                    <div disabled class="file-attachment-list"  id="attachments">
                                                        @if ($data->attachments)
                                                            @foreach (json_decode($data->attachments) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                                            <a  type="button" class="remove-file" data-file-name="{{ $file }}"><i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;" ></i></a>

                                                                </h6>
                                                            @endforeach
                                                        @endif

                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input
                                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                            type="file" id="myfile" name="attachments[]"
                                                            oninput="addMultipleFiles(this, 'attachments')" multiple>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                       
                            <div class="col-12">
                               <div class="group-input">
                                   <label for="related_url">Related URL</label>
                                   <input name="related_url" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }} value="{{ $data->related_url }}"> 
                               </div>
                            </div>

                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="related_url">URl's description</label>
                                                <input {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}
                                                    type="text" value="{{ $data->url_description }}"
                                                    name="url_description" id="url_description" />
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="group-input">
                                                <label for="suggested_audit">Suggested Audits</label>
                                                <input type="text" name="suggested_audits"
                                                    value="{{ $data->suggested_audits }}"
                                                    {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>
                                            </div>
                                        </div> --}}
                                       
                                        
                                        <div class="col-12 sub-head">
                                            Extension Justification
                                        </div>
                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="due_date_extension">Due Date Extension Justification</label>
                                                <div><small class="text-primary">Please Mention justification if due date is crossed</small></div>
                                                <textarea name="due_date_extension"{{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>{{$data->due_date_extension}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-block">
                                        @if ($data->stage != 0)
                                            <button type="submit" id="ChangesaveButton" class="saveButton" {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Save</button>
                                        @endif
                                        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                                        <button type="button"> <a class="text-white"
                                                href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                                    </div>
                                </div>
                            </div>

                            <div id="CCForm2" class="inner-block cctabcontent">
                                <div class="inner-block-content">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted_By..">Submitted By</label>
                                                <div class="static">{{ $data->submitted_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Submitted_On">Submitted On</label>
                                                <div class="static">{{ $data->submitted_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved_By">Approved By</label>
                                                <div class="static">{{ $data->approved_by }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                                <label for="Approved_On">Approved On</label>
                                                <div class="static">{{ $data->approved_on }}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="group-input">
                                               <label for="Rejected_By">Rejected By</label>
                                               <div class="static">{{ $data->rejected_by}}</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                           <div class="group-input">
                                             <label for="Rejected_On">Rejected On</label>
                                             <div class="static">{{ $data->rejected_on }}</div>
                                          </div>
                                       </div>
                                      <div class="col-lg-6">
                                         <div class="group-input">
                                        <label for="Audit_Completed_By">Audit Completed By</label>
                                        <div class="static">{{ $data->Audit_Completed_By }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Audit_Completed_On">Audit Completed On</label>
                                        <div class="static">{{ $data->Audit_Completed_On }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancelled_By">Cancelled By</label>
                                        <div class="static">{{ $data->cancelled_by }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Cancelled_On">Cancelled On</label>
                                        <div class="static">{{ $data->cancelled_on }}</div>
                                    </div>
                                </div>
                                    </div>
                                    <div class="button-block">
                                        <button type="submit" class="saveButton"
                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Save</button>
                                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button type="submit"
                                            {{ $data->stage == 0 || $data->stage == 4 ? 'disabled' : '' }}>Submit</button>
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
                        <form action="{{ route('StateChangeAuditProgram', $data->id) }}" method="POST">
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

                        <form action="{{ route('AuditProgramCancel', $data->id) }}" method="POST">
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

                        <form action="{{ route('AuditProgramStateRecject', $data->id) }}" method="POST">
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
                                    <label for="comment">Comment<span class="text-danger">*</span></label>
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
                        <form action="{{ route('auditProgramChild', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    
                                    <label for="major">

                                    </label>
                                    <label for="major">
                                        <input type="radio" name="child_type" value="Internal_Audit">
                                         Internal Audit
                                    </label>
                                    <label for="minor">
                                        <input type="radio" name="child_type" value="External_Audit">
                                        External Audit
                                    </label>
                                    <!-- <label for="minor">
                                        <input type="radio" name="child_type" value="extension">
                                        Extension
                                    </label> -->
                                    
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
                                        <input type="hidden" name="parent_name" value="Audit_program">
                                        <input type="hidden" name="due_date" value="{{ $data->due_date }}">
                                        <!-- <input type="radio" name="child_type" value="extension">
                                        Extension -->
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

            <Script>
                function addAuditProgram(tableId) {
                    var table = document.getElementById(tableId);
                    var currentRowCount = table.rows.length;
                    var newRow = table.insertRow(currentRowCount);
                    newRow.setAttribute("id", "row" + currentRowCount);
                    var cell1 = newRow.insertCell(0);
                    cell1.innerHTML = currentRowCount;

                    var cell2 = newRow.insertCell(1);
                    cell2.innerHTML =
                        '<select name="Auditees[]"><option value="">-- Select --</option>@foreach ($users as $data)<option value="{{ $data->id }}">{{ $data->name }}</option>@endforeach</select>'

                    var cell3 = newRow.insertCell(2);
                    cell3.innerHTML ='<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="start_date' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="start_date[]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"    id="start_date' + currentRowCount +'_checkdate"  class="hide-input" oninput="handleDateInput(this, `start_date' + currentRowCount +'`);checkDate(`start_date' + currentRowCount +'_checkdate`,`end_date' + currentRowCount +'_checkdate`)" /></div></div></div></td>';
;

                    var cell4 = newRow.insertCell(3);
                    cell4.innerHTML ='<td><div class="group-input new-date-data-field mb-0"><div class="input-date "><div class="calenderauditee"> <input type="text" id="end_date' + currentRowCount +'" readonly placeholder="DD-MMM-YYYY" /><input type="date" name="end_date[]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"   id="end_date'+ currentRowCount +'_checkdate" class="hide-input" oninput="handleDateInput(this, `end_date' + currentRowCount +'`);checkDate(`start_date' + currentRowCount +'_checkdate`,`end_date' + currentRowCount +'_checkdate`)" /></div></div></div></td>';


                    var cell5 = newRow.insertCell(4);
                    // cell5.innerHTML = "<input type='text' name='lead_investigator'>";
                    cell5.innerHTML =
                        '<select name="lead_investigator[]"><option value="">-- Select --</option>@foreach ($users as $data)<option value="{{ $data->id }}">{{ $data->name }}</option>@endforeach</select>'

                    var cell6 = newRow.insertCell(5);
                    cell6.innerHTML = "<input type='text' name='comment[]'>";
                    for (var i = 1; i < currentRowCount; i++) {
                        var row = table.rows[i];
                        row.cells[0].innerHTML = i;
                    }
                }
            </Script>

            <script>
                VirtualSelect.init({
                    ele: '#investigators'
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
