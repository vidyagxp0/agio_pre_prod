@extends('frontend.layout.main')
@section('container')

    @php
        $users = DB::table('users')->select('id', 'name')->where('active', 1)->get();
        $userRoles = DB::table('user_roles')->select('user_id')->where('q_m_s_roles_id', 4)->distinct()->get();
        $departments = DB::table('departments')->select('id', 'name')->get();
        $divisions = DB::table('q_m_s_divisions')->select('id', 'name')->get();

        $userIds = DB::table('user_roles')->where('q_m_s_roles_id', 4)->distinct()->pluck('user_id');

        // Step 3: Use the plucked user_id values to get the names from the users table
        $userNames = DB::table('users')->whereIn('id', $userIds)->pluck('name');

        // If you need both id and name, use the select method and get
        $userDetails = DB::table('users')->whereIn('id', $userIds)->select('id', 'name')->get();
        // dd ($userIds,$userNames, $userDetails);
    @endphp
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

    <style>
        textarea.note-codable {
            display: none !important;
        }

        /* header {
                display: none;
            } */
        header .header_rcms_bottom,
        .container-fluid.header-bottom,
        .search-bar {
            display: none;
        }

        .remove-file {
            color: white;
            cursor: pointer;
            margin-left: 10px;
        }

        .remove-file :hover {
            color: white;
        }

        .progress-bars div {
            flex: 1 1 auto;
            border: 1px solid grey;
            padding: 5px;
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

        #change-control-fields .inner-block .main-head {
            padding: 15px;
            color: black;
            background: white;
            margin-bottom: 0;
            font-weight: bold;
            font-size: 1.2rem;
        }

        /* #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(4) {
                                                                                                                                                                                                                                                                                                                                                                                                                                border-radius: 0px 20px 20px 0px;

                                                                                                                                                                                                                                                                                                                                                                                                                            } */
        .new-moreinfo {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 13px;
        }
    </style>
    </style>

    <div class="form-field-head">
        <div class="division-bar">
            <strong>Site Division/Project</strong> : {{ Helpers::getDivisionName($data->division_id) }} /
            Change Proposal And Justification
        </div>
    </div>
    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">
            <div class="inner-block state-block">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="main-head">Record Workflow </div>
                    @php
                        $userRoles = DB::table('user_roles')
                            ->where([
                                'user_id' => Auth::user()->id,
                                'q_m_s_divisions_id' => $data->site_location_code,
                            ])
                            ->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                    @endphp
                  
                    <div class="d-flex" style="gap:20px;">
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}

                        <button class="button_theme1"> <a class="text-white"
                                href="{{ url('cpjAudittrial', $data->id) }}">Audit Trail</a> </button>
                        @if ($data->stage == 1 && ($data->initiator_id == Auth::user()->id || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#reject-required-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 2 && (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 4) ||  Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                HOD Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                        @elseif($data->stage == 3 && (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 48) || (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 63) || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 18))))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA/CQA Review Complete
                            </button>

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                        @elseif($data->stage == 4 && (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 43) || (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 9) || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 65) || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 18))))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA/CQA Head/Designe Approval Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                        @endif
                        <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"><button class="button_theme1"> Exit
                            </button> </a>
                    </div>
                </div>
                <style>
                    /* Linear Connected Progress Bar */
                    .progress-bars {
                        display: flex;
                        border-radius: 30px;
                        overflow: hidden;
                        border: 1px solid #e0e0e0;
                        background: #f5f5f5ff;
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
                        background-color: #941414ff;
                        color: black;
                    }

                    /* Closed States */
                    .progress-bars div.closed {
                        background-color: #f44336;
                        color: white;
                    }

                    .progress-bars div.active {
                        background: green;
                        font-weight: bold;
                    }


                    /* Blue Pulse Animation */
                    @keyframes pulse-blue {
                        0% {
                            background-color: #de8d0a;
                        }

                        50% {
                            background-color: #dfac54;
                        }

                        100% {
                            background-color: #de8d0a;
                        }
                    }
                </style>
                <div class="status">
                    <div class="head">Current Status</div>
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @elseif ($data->stage == 6)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Rejected</div>
                        </div>
                    @else
                        <div class="progress-bars d-flex">
                            @php
                                $currentStage = $data->stage;
                            @endphp

                            <div class="{{ $currentStage > 1 ? 'active' : ($currentStage == 1 ? 'current' : '') }}">Opened
                            </div>

                            <div class="{{ $currentStage > 2 ? 'active' : ($currentStage == 2 ? 'current' : '') }}">HOD
                                Review</div>

                            <div class="{{ $data->stage > 3 ? 'active' : ($data->stage == 3 ? 'current' : '') }}"> QA CQA
                                Review</div>

                            <div class="{{ $data->stage > 4 ? 'active' : ($data->stage == 4 ? 'current' : '') }}">QA/CQA
                                Head / Designe</div>


                            @if ($data->stage >= 5)
                                <div class="bg-danger" style="border-radius: 0px 20px 20px 0px;">Closed - Done</div>
                            @else
                                <div class="" style="border-radius: 0px 20px 20px 0px;">Closed - Done</div>
                            @endif
                        </div>
                    @endif
                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">HOD Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">QA/CQA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA CQA Head Designee</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Activity Log</button>
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
                    } else if (stage == 3) {
                        tabToActivate = 'CCForm3';
                    } else if (stage == 4) {
                        tabToActivate = 'CCForm4';
                    } else if (stage == 5) {
                        tabToActivate = 'CCForm5';
                    } else if (stage == 0) {
                        tabToActivate = 'CCForm5';
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
                    const currentStage = @json($data->stage ?? 1);

                    activateTabBasedOnStage(currentStage);
                });
            </script>


            <form action="{{ route('cpupdate', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Tab content -->
                <div id="step-form">
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                 @php
                                $istab1 = ($data->stage == 1 && (($data->initiator_id == Auth::user()->id) || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 3)));
                                $istab2 = ($data->stage == 2 && (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 4)  || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 18)));
                                $istab3 = ($data->stage == 3 && (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 48) || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 63) || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 18)));
                                $istab4 = ($data->stage == 4 && (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 43) || (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 9) || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 65) || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 18))))
                                @endphp

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record"
                                            value="{{ Helpers::getDivisionName($data->division_id) }}/CPJ/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input disabled type="text" name="division_code" id="division_code"
                                            value="{{ Helpers::getDivisionName($data->division_id) }}">
                                        <input type="hidden" name="division_code" id="division_code"
                                            value="{{ $data->division_code }}">
                                        {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        {{-- <input type="hidden" value="{{ Auth::user()->name }}" name="initiator" id="initiator"> --}}
                                        <input disabled type="text" name="initiator_id" id="initiator_id"
                                            value="{{ Helpers::getInitiatorName($data->initiator_id) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator">Initiation Department</label>
                                        <input disabled type="text" value="{{ Helpers::getUserDepartmentFromDB(Auth::user()->departmentid) }}">
                                        {{-- <input disabled type="text" name="" value="{{ Helpers::getInitiatorName($data->initiator_id)  }}"> --}}
                                    </div>
                                </div>
                                @php
                                    // Calculate the due date (30 days from the initiation date)
                                    $initiationDate = date('Y-m-d'); // Current date as initiation date
                                    $dueDate = date('Y-m-d', strtotime($initiationDate . '+30 days')); // Due date
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Date of Initiation"><b>Date of Initiation</b></label>
                                        <input readonly type="text"
                                            value="{{ Helpers::getdateFormat($data->intiation_date) }}"
                                            name="initiation_date" id="initiation_date"
                                            style="background-color: light-dark(rgba(239, 239, 239, 0.3), rgba(59, 59, 59, 0.3))">
                                        {{-- <input type="hidden" value="{{ date('Y-m-d') }}" name="initiation_date_hidden"> --}}
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Due Date">Due Date <span class="text-danger">*</span></label>
                                        <div class="calenderauditee">
                                            <!-- Display formatted date -->
                                            <input disabled type="text" id="due_date_display" readonly
                                                placeholder="DD-MMM-YYYY"
                                                value="{{ $data->due_date ? \Carbon\Carbon::parse($data->due_date)->format('d-M-Y') : '' }}" />
                                            <!-- Hidden actual date -->
                                            <input type="date" name="due_date"
                                                value="{{ $data->due_date }}"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                class="hide-input"
                                                oninput="handleDateInput(this, 'due_date_display')" required />
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function handleDateInput(dateInput, displayId) {
                                        const date = new Date(dateInput.value);
                                        if (dateInput.value) {
                                            const options = { day: '2-digit', month: 'short', year: 'numeric' };
                                            document.getElementById(displayId).value =
                                                date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                        } else {
                                            document.getElementById(displayId).value = '';
                                        }
                                    }
                                </script>


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        Characters remaining
                                        <input id="docname" type="text" name="cpdescription"
                                            value="{{ $data->cpdescription }}" maxlength="255" {{ $istab1 ? "required" : "readonly" }}>
                                    </div>
                                </div>
                                <script>
                                    var maxLength = 255;
                                    $('#docname').keyup(function() {
                                        var textlen = maxLength - $(this).val().length;
                                        $('#rchars').text(textlen);
                                    });
                                </script>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Impact Assesment">Impact Assesment</label>
                                        <textarea name="impassesment" {{ $istab1 ? "" : "readonly" }}>{{ $data->impassesment }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Change Proposal Grid
                                            <button type="button" id="traceblity_add" {{ $istab1 ? "" : "disabled" }}>+</button>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="traceblity" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Sr. No.</th>
                                                        <th>Existing System</th>
                                                        <th>Proposed Change</th>
                                                        <th>Justification</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $traceabilityIndex = 1;
                                                    @endphp
                                                    {{-- @if (!empty($traceability_gi)) --}}
                                                    @if (!empty($changeProposalGrid) && is_array($changeProposalGrid->data))
                                                        @foreach ($changeProposalGrid->data as $index => $item)
                                                            <tr>
                                                                <td>
                                                                    <input disabled type="text"
                                                                        name="change_proposal_grid[{{ $index }}][serial]"
                                                                        value="{{ $loop->iteration }}" {{ $istab1 ? "" : "readonly" }}>
                                                                </td>

                                                                <td>
                                                                    <input type="text"
                                                                        name="change_proposal_grid[{{ $index }}][existing_system]"
                                                                        value="{{ $item['existing_system'] ?? '' }}" {{ $istab1 ? "" : "readonly" }}>
                                                                </td>

                                                                <td>
                                                                    <input type="text"
                                                                        name="change_proposal_grid[{{ $index }}][proposed_change]"
                                                                        value="{{ $item['proposed_change'] ?? '' }}" {{ $istab1 ? "" : "readonly" }}>
                                                                </td>

                                                                <td>
                                                                    <input type="text"
                                                                        name="change_proposal_grid[{{ $index }}][justification]"
                                                                        value="{{ $item['justification'] ?? '' }}" {{ $istab1 ? "" : "readonly" }}>
                                                                </td>

                                                                <td>
                                                                    <button type="button"
                                                                        class="removeRowBtn">Remove</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        {{-- <tr>
                                                        <td colspan="5">No found</td>
                                                    </tr> --}}
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('#traceblity_add').click(function(e) {
                                            e.preventDefault();

                                            function generateTableRow(serialNumber) {
                                                var html =
                                                    '<tr>' +

                                                    '<td><input disabled type="text" name="change_proposal_grid[' + serialNumber +
                                                    '][serial]" value="' + (serialNumber + 1) + '"></td>' +

                                                    '<td><input type="text" name="change_proposal_grid[' + serialNumber +
                                                    '][existing_system]" {{ $istab1 ? "" : "readonly" }}></td>' +

                                                    '<td><input type="text" name="change_proposal_grid[' + serialNumber +
                                                    '][proposed_change]" {{ $istab1 ? "" : "readonly" }}></td>' +

                                                    '<td><input type="text" name="change_proposal_grid[' + serialNumber +
                                                    '][justification]" {{ $istab1 ? "" : "readonly" }}></td>' +

                                                    '<td><button type="button" class="removeRowBtn">Remove</button></td>' +

                                                    '</tr>';

                                                return html;
                                            }

                                            var tableBody = $('#traceblity tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateTableRow(rowCount);
                                            tableBody.append(newRow);
                                        });
                                    });
                                </script>

                                <div class="sub-head">
                                    Change Proposal And Justification Checklist
                                </div>

                                @php
                                    $questions = [
                                        'q3_1' => 'Availability of Product Permission.',
                                        'q3_2' => 'Availability of Manufacturing License.',
                                        'q3_3' => 'Availability of Marketing Authorization.',
                                        'q3_4' => 'Technical Agreement.',
                                        'q3_5' => 'Site Variation Filing (for New Site).',
                                        'q3_6' => 'New Product Code.',
                                        'q3_7' => 'Facility Qualification / Modification.',
                                        'q3_8' => 'Utility Requirements / Qualification',
                                        'q3_9' => 'New Equipment Req. or Modifications.',
                                        'q3_10' => 'Process Validation.',
                                        'q3_11' => 'Cleaning Validation .',
                                        'q3_12' => 'Master Formula Record.',
                                        'q3_13' => 'Master Packing Record.',
                                        'q3_14' => 'Additional studies.',
                                        'q3_15' => 'Reagents/ Chemicals/ Solvents or any other Resources.',
                                        'q3_16' => 'Equipment/ Instrument Accessories/ Parts / Change Parts & Layout.',
                                        'q3_17' => 'Analytical Method Validation.',
                                        'q3_18' => 'PM BOM.',
                                        'q3_19' => 'BMR.',
                                        'q3_20' => 'Hold Time Study.',
                                        'q3_21' => 'Site Master File.',
                                        'q3_22' => 'Validation Master Plan.',
                                        'q3_23' => 'Requirement of outside test.',
                                        'q3_24' => 'Additional Equipment / Instruments.',
                                        'q3_25' => 'Environmental Condition.',
                                        'q3_26' => 'Testing Feasibility.',
                                        'q3_27' => 'Annual Product Review.',
                                        'q3_28' => 'New Source/ Vendor Requirement.',
                                        'q3_29' => 'Vendor Qualification.',
                                        'q3_30' => 'Approved Vendor List Updation.',
                                        'q3_31' => 'New Code Generation/ Item Codification.',
                                        'q3_32' => 'List of Item Codes.',
                                        'q3_33' => 'Approved Specimen/ Shade Card.',
                                        'q3_34' => 'Status of Old Stocks (for Usage / Destruction).',
                                        'q3_35' => 'Customer/ Contract Giver Approval.',
                                        'q3_36' => 'Process Parameters.',
                                        'q3_37' => 'Training.',
                                        'q3_38' => 'GMP   / GLP Requirements.',
                                        'q3_39' => 'MOC Requirements.',
                                        'q3_40' => 'List of Equipment / instruments.',
                                        'q3_41' => 'New Utility Connections / Modifications.',
                                        'q3_42' => 'Drawings / layouts.',
                                        'q3_43' => 'Equipment P & I Diagram.',
                                        'q3_44' => 'Regulatory Submissions.',
                                        'q3_46' => 'Equipment Location Layout.',
                                        'q3_47' => 'Responsibilities.',
                                        'q3_48' => 'Intimation/ Notification to Regulatory Bodies.',
                                        'q3_49' => 'Quality Management System.',
                                        'q3_50' => 'Facility and Other Layouts.',
                                        'q3_51' => 'Pharmacopeia Requirements.',
                                        'q3_52' => 'Raw Material Specifications.',
                                        'q3_53' => 'Packing Material Specification.',
                                        'q3_54' => 'In process Specification.',
                                        'q3_55' => 'Finished Product Specification.',
                                        'q3_56' => 'Approved Art works/ Proofs.',
                                        'q3_57' => 'Packaging Specification / configuration.',
                                        'q3_58' => 'Status of Existing stock in case of Artwork/ packing material related changes.',
                                        'q3_59' => 'Quality Agreements with vendors.',
                                        'q3_60' => 'Calibration.',
                                        'q3_61' => 'Calibration Planner / Addendum to Calibration Planner.',
                                        'q3_62' => 'Stability Protocol / Report / Stability studies.',
                                        'q3_63' => 'Stability Specification.',
                                        'q3_64' => 'Updating of Product Lists.',
                                        'q3_65' => 'HPLC Column.',
                                        'q3_66' => 'Placebo.',
                                        'q3_67' => 'Primary standards.',
                                        'q3_68' => 'Mfg. Feasibility.',
                                        'q3_69' => 'Qualification document (URS/DQ/IQ/OQ/PQ).',
                                        'q3_70' => 'Manual COA (Raw Material / Finish Product).',
                                        'q3_71' => 'Safety.',
                                        'q3_72' => 'Annual Maintenance Contract.',
                                        'q3_73' => 'Service agreement.',
                                        'q3_74' => 'Qualification / Re-qualification.',
                                        'q3_75' => 'SOP.',
                                        'q3_76' => 'STPs.',
                                        'q3_77' => 'Logbooks.',
                                        'q3_78' => 'Preventive Maintenance.',
                                        'q3_79' => 'Planner for PM / Addendum to PM Planner.',
                                        'q3_80' => 'Regulatory Requirements.',
                                        'q3_81' => 'Tech Transfer.',
                                        'q3_82' => 'Man & Material Movement.',
                                        'q3_83' => 'Temperature / RH/ Differential Pressures.',
                                        'q3_84' => 'Temperature Mapping.',
                                        'q3_85' => 'HVAC Validation.',
                                        'q3_86' => 'Water System Validation.',
                                        'q3_88' => 'Area Nomenclature.',
                                        'q3_89' => 'Qualified Personnel.',
                                        'q3_90' => 'Any other.',
                                        'q3_91' => 'Shelf life.',
                                        'q3_92' => 'Text matter.',
                                        'q3_93' => 'GTIN 1D.',
                                        'q3_94' => 'QR code.',
                                        'q3_95' => 'Pack size.',
                                        'q3_96' => 'Pack style.',
                                        'q3_97' => 'Design.',
                                        'q3_98' => 'Formula.',
                                        'q3_99' => 'API vendor.',
                                        'q3_100' => 'Registration Certificate number.',
                                        'q3_101' => 'Mfg. License number.',
                                    ];

                                    $savedChecklist = isset($checklistData->data) ? $checklistData->data : [];
                                @endphp

                                <div class="col-12">
                                    <div class="group-input">
                                        <div class="why-why-chart">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10%;">Sr. No.</th>
                                                        <th style="width: 40%;">Question</th>
                                                        <th style="width: 20%;">Response</th>
                                                        {{-- <th>Remarks</th> --}}
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($questions as $key => $question)
                                                        <tr>
                                                            <td class="text-center">1.{{ $loop->iteration }}</td>

                                                            {{-- <td>
                                                                {{ $question }}
                                                                <input type="hidden"
                                                                    name="checklist[{{ $key }}][question]"
                                                                    value="{{ $question }}">
                                                            </td> --}}
                                                            <td>
                                                                {{ $question }}
                                                            </td>
                                                            <td>
                                                                <select name="checklist[{{ $key }}][response]"
                                                                    style="width:100%; border:1px solid #000; background:#f0f0f0;">

                                                                    <option value="">Select</option>

                                                                    <option value="Yes"
                                                                        {{ isset($savedChecklist[$key]['response']) && $savedChecklist[$key]['response'] == 'Yes' ? 'selected' : '' }} {{ $istab1 ? "" : "readonly" }}>
                                                                        Yes
                                                                    </option>

                                                                    <option value="No"
                                                                        {{ isset($savedChecklist[$key]['response']) && $savedChecklist[$key]['response'] == 'No' ? 'selected' : '' }} {{ $istab1 ? "" : "readonly" }}>
                                                                        No
                                                                    </option>

                                                                    <option value="N/A"
                                                                        {{ isset($savedChecklist[$key]['response']) && $savedChecklist[$key]['response'] == 'N/A' ? 'selected' : '' }} {{ $istab1 ? "" : "readonly" }}>
                                                                        N/A
                                                                    </option>

                                                                </select>
                                                            </td>

                                                            {{-- <td>
                                                            <textarea name="checklist[{{ $key }}][remark]"
                                                                style="width:100%; border-radius:5px;">{{ $savedChecklist[$key]['remark'] ?? '' }}</textarea>
                                                        </td> --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Attachment Extension">Initiator Attachment</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="cpAttachment">
                                                @if ($data->cpAttachment)
                                                    @foreach (json_decode($data->cpAttachment) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                    class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-remove-id="REFEFile-{{ $loop->index }}"
                                                                data-file-name="{{ $file }}"
                                                                style="@if ($data->stage == 0 || $data->stage == 6) pointer-events: none; @endif"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="cpAttachment[]"
                                                    oninput="addMultipleFiles(this, 'cpAttachment')" {{ $istab1 ? "" : "disabled" }} multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>

                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                        class="text-white">Exit </a> </button>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- reviewer content -->
                <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Assigned To">HOD Remarks @if($data->stage == 2) <span class="text-danger">*</span>
                                        
                                    @endif</label>
                                    <textarea name="hod_comment" id="hod_comment" cols="30" {{ $istab2 ? "required" : "readonly" }}>{{ $data->hod_comment }}</textarea>
                                </div>
                            </div>

                            @if ($data->hodAttachment)
                                @foreach (json_decode($data->hodAttachment) as $file)
                                    <input id="EFREFEFile-{{ $loop->index }}" type="hidden"
                                        name="existing_hodAttachment[{{ $loop->index }}]" value="{{ $file }}">
                                @endforeach
                            @endif
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="HOD Attachments">HOD Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="hodAttachment">
                                            @if ($data->hodAttachment)
                                                @foreach (json_decode($data->hodAttachment) as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file"
                                                            data-remove-id="EFREFEFile-{{ $loop->index }}"
                                                            data-file-name="{{ $file }}"
                                                            style="@if ($data->stage == 0 || $data->stage == 6) pointer-events: none; @endif"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input value="{{ $data->hodAttachment }}" type="file" id="myfile"
                                                name="hodAttachment[]" oninput="addMultipleFiles(this, 'hodAttachment')" {{ $istab2 ? "" : "disabled" }}
                                                multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>
                <!-- Approver-->
                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Assigned To">QA/CQA Review Comments</label>
                                    <textarea name="qa_comment" id="qa_comment" cols="30" {{ $istab3 ? "required" : "readonly" }}>{{ $data->qa_comment }}</textarea>
                                </div>
                            </div>

                            @if ($data->qaAttachment)
                                @foreach (json_decode($data->qaAttachment) as $file)
                                    <input id="QAREFEFile-{{ $loop->index }}" type="hidden"
                                        name="existing_qaAttachment[{{ $loop->index }}]" value="{{ $file }}">
                                @endforeach
                            @endif
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">QA/CQA Review Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="qaAttachment">
                                            @if ($data->qaAttachment)
                                                @foreach (json_decode($data->qaAttachment) as $file)
                                                    <h6 class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a class="remove-file"
                                                            data-remove-id="QAREFEFile-{{ $loop->index }}"
                                                            data-file-name="{{ $file }}"
                                                            style="@if ($data->stage == 0 || $data->stage == 6) pointer-events: none; @endif"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="HOD_Attachments" name="qaAttachment[]"
                                                oninput="addMultipleFiles(this, 'qaAttachment')" {{ $istab3 ? "" : "disabled" }} multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton"
                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button">
                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>


                <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Assigned To">QA/CQA Head Approval Comments</label>
                                    <textarea name="qa_cqa_head_comment" id="qa_cqa_head_comment" cols="30" {{ $istab4 ? "required" : "readonly" }}>{{ $data->qa_cqa_head_comment }}</textarea>
                                </div>
                            </div>

                            @if ($data->qa_cqa_head_Attachment)
                                @foreach (json_decode($data->qa_cqa_head_Attachment) as $file)
                                    <input id="QAREFEFile-{{ $loop->index }}" type="hidden"
                                        name="existing_qa_cqa_head_Attachment[{{ $loop->index }}]"
                                        value="{{ $file }}">
                                @endforeach
                            @endif
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">QA/CQA Head Approval Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="qa_cqa_head_Attachment">
                                            @if ($data->qa_cqa_head_Attachment)
                                                @foreach (json_decode($data->qa_cqa_head_Attachment) as $file)
                                                    <h6 class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a class="remove-file"
                                                            data-remove-id="QAREFEFile-{{ $loop->index }}"
                                                            data-file-name="{{ $file }}"
                                                            style="@if ($data->stage == 0 || $data->stage == 6) pointer-events: none; @endif"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="HOD_Attachments" name="qa_cqa_head_Attachment[]"
                                                oninput="addMultipleFiles(this, 'qa_cqa_head_Attachment')" {{ $istab3 ? "" : "disabled" }} multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button">
                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>


                <!-- Activity Log content -->
                <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Activated By">Submit By</label>
                                    <div class="static">{{ $data->submit_by ?? 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Activated On">Submit On</label>
                                    <div class="static">{{ $data->submit_on ?? 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Activated On">Submit Comment</label>
                                    <div class="static">
                                        {{ !empty($data->submit_comment) ? $data->submit_comment : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">HOD Review By</label>
                                    <div class="static">
                                        {{ !empty($data->HOD_Review_Complete_By) ? $data->HOD_Review_Complete_By : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">HOD Review On</label>
                                    <div class="static">
                                        {{ !empty($data->HOD_Review_Complete_On) ? $data->HOD_Review_Complete_On : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">HOD Review Comment</label>
                                    <div class="static">
                                        {{ !empty($data->HOD_Review_Comments) ? $data->HOD_Review_Comments : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">QA/CQA Review Complete By</label>
                                    <div class="static">
                                        {{ !empty($data->qa_cqa_Review_Complete_By) ? $data->qa_cqa_Review_Complete_By : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">QA/CQA Review Complete On</label>
                                    <div class="static">
                                        {{ !empty($data->qa_cqa__Review_Complete_On) ? $data->qa_cqa__Review_Complete_On : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">QA/CQA Review Complete Comment</label>
                                    <div class="static">
                                        {{ !empty($data->qa_cqa__Review_Comments) ? $data->qa_cqa__Review_Comments : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">QA/CQA Head/Designee Complete By</label>
                                    <div class="static">
                                        {{ !empty($data->qa_cqa_Review_Complete_By) ? $data->qa_cqa_Review_Complete_By : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">QA/CQA Head/Designee Complete On</label>
                                    <div class="static">
                                        {{ !empty($data->qa_cqa__Review_Complete_On) ? $data->qa_cqa__Review_Complete_On : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">QA/CQA Head/Designee Complete Comment</label>
                                    <div class="static">
                                        {{ !empty($data->qa_cqa__Review_Comments) ? $data->qa_cqa__Review_Comments : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">Reject By</label>
                                    <div class="static">
                                        {{ !empty($data->submit_by_inapproved) ? $data->submit_by_inapproved : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Reject On</label>
                                    <div class="static">
                                        {{ !empty($data->submit_on_inapproved) ? $data->submit_on_inapproved : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Reject Comment</label>
                                    <div class="static">
                                        {{ !empty($data->submit_commen_inapproved) ? $data->submit_commen_inapproved : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">Cancel By</label>
                                    <div class="static">
                                        {{ !empty($data->reject_by) ? $data->reject_by : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Cancel On</label>
                                    <div class="static">
                                        {{ !empty($data->reject_on) ? $data->reject_on : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Cancel Comment</label>
                                    <div class="static">
                                        {{ !empty($data->reject_comment) ? $data->reject_comment : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>


                        </div>
                        
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton"
                                {{ $data->stage == 0 || $data->stage == 5 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>

                            <button type="button">
                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('cpj_send_stage', $data->id) }}" method="POST" id="signatureModalForm">
                    @csrf
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
                    <div class="modal-footer">
                        <button type="submit" class="signatureModalButton">
                            <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Submit
                        </button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="signature-reviewed-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('extension_reviewed_stage', $data->id) }}" method="POST"
                    id="signatureModalForm">
                    @csrf
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
                    <div class="modal-footer">
                        <button type="submit" class="signatureModalButton">
                            <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Submit
                        </button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="signature-cqa-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('send-cqa', $data->id) }}" method="POST" id="signatureModalForm">
                    @csrf
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
                            <label for="comment">Comment</label>
                            <input class="new-moreinfo" type="comment" name="comment">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="signatureModalButton">
                            <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Submit
                        </button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="signature-approved-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('send-approved', $data->id) }}" method="POST" id="signatureModalForm">
                    @csrf
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
                            <label for="comment">Comment</label>
                            <input class="new-moreinfo" type="comment" name="comment">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="signatureModalButton">
                            <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none"
                                role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            Submit
                        </button>
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

                <form action="{{ route('more_info_stage', $data->id) }}" method="POST">
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

    <div class="modal fade" id="reject-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('extension_reject_stage', $data->id) }}" method="POST">
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

    <div class="modal fade" id="reject-required-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('cpjCancle', $data->id) }}" method="POST">
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

                extensionForm.submit();
            }


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

@endsection
