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
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                        @elseif($data->stage == 3 && (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 48) || (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 7) || (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 63) || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 18)))))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA/CQA Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                        @elseif($data->stage == 4 && (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 43) || (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 9) || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 65) || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 18))))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA/CQA Head/Designee Approval Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                             <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#reject-modal">
                                Reject
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

                            <div class="{{ $currentStage > 2 ? 'active' : ($currentStage == 2 ? 'current' : '') }}">HOD/Designee Review
                                </div>

                            <div class="{{ $data->stage > 3 ? 'active' : ($data->stage == 3 ? 'current' : '') }}"> QA/CQA Review</div>

                            <div class="{{ $data->stage > 4 ? 'active' : ($data->stage == 4 ? 'current' : '') }}">QA/CQA Head / Designee Approval</div>


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
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">HOD/Designee Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">QA/CQA Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">QA/CQA Head / Designee Approval</button>
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
                    else if (stage == 6) {
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
                                $istab3 = ($data->stage == 3 && (Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 48) || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 63) || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 18) || Helpers::check_roles($data->division_id, 'Change Proposal And Justification', 7)));
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
                                
                                {{-- <div class="col-lg-6 new-date-data-field">
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
                                </div> --}}

                                {{-- <script>
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
                                </script> --}}


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
                                        <label for="Impact Assesment">Description of Change @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                                   @endif</label>
                                        <textarea name="impassesment" {{ $istab1 ? "required" : "readonly" }}>{{ $data->impassesment }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Change Proposal And Justification Details Grid @if($data->stage ==1)
                                            <span class="text-danger">*</span>
                                                   @endif
                                            <button type="button" id="traceblity_add" {{ $istab1 ? "" : "disabled" }}>+</button>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="traceblity" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Sr. No.</th>
                                                        <th>Current Practice</th>
                                                        <th>Proposed Change</th>
                                                        <th>Justification / reason for change</th>
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
                                                                    value="{{ $loop->iteration }}"
                                                                    {{ $istab1 ? 'required' : 'readonly' }}>
                                                                </td>

                                                                <td>
                                                                    <textarea
                                                                        name="change_proposal_grid[{{ $index }}][existing_system]"
                                                                        {{ $istab1 ? 'required' : 'readonly' }}>{{ $item['existing_system'] ?? '' }}</textarea>
                                                                </td>

                                                                <td>
                                                                    <textarea
                                                                        name="change_proposal_grid[{{ $index }}][proposed_change]"
                                                                        {{ $istab1 ? 'required' : 'readonly' }}>{{ $item['proposed_change'] ?? '' }}</textarea>
                                                                </td>

                                                                <td>
                                                                    <textarea
                                                                        name="change_proposal_grid[{{ $index }}][justification]"
                                                                        {{ $istab1 ? 'required' : 'readonly' }}>{{ $item['justification'] ?? '' }}</textarea>
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
                                $(document).ready(function () {

                                    $('#traceblity_add').on('click', function (e) {
                                        e.preventDefault();

                                        let rowCount = $('#traceblity tbody tr').length;

                                        let html = `
                                            <tr>
                                                <td>
                                                    <input type="text"
                                                        name="change_proposal_grid[${rowCount}][serial]"
                                                        value="${rowCount + 1}"
                                                        readonly>
                                                </td>

                                                <td>
                                                    <textarea
                                                        name="change_proposal_grid[${rowCount}][existing_system]"
                                                        {{ $istab1 ? 'required' : 'readonly' }}></textarea>
                                                </td>

                                                <td>
                                                    <textarea
                                                        name="change_proposal_grid[${rowCount}][proposed_change]"
                                                        {{ $istab1 ? 'required' : 'readonly' }}></textarea>
                                                </td>

                                                <td>
                                                    <textarea
                                                        name="change_proposal_grid[${rowCount}][justification]"
                                                        {{ $istab1 ? 'required' : 'readonly' }}></textarea>
                                                </td>

                                                

                                                <td>
                                                    <button type="button" class="removeRowBtn"  {{ $data->stage == 1 ? '' : 'disabled' }}>Remove</button>
                                                </td>
                                            </tr>
                                        `;

                                        $('#traceblity tbody').append(html);
                                    });

                                    // Remove Row
                                    $(document).on('click', '.removeRowBtn', function () {
                                        @if($data->stage != 1)
                                            return false;
                                        @endif
                                        $(this).closest('tr').remove();

                                        // Re-serial numbering
                                        $('#traceblity tbody tr').each(function (index) {
                                            $(this).find('td:first input').val(index + 1);
                                            $(this).find('td:first input').attr(
                                                'name',
                                                `change_proposal_grid[${index}][serial]`
                                            );

                                            $(this).find('textarea').eq(0).attr(
                                                'name',
                                                `change_proposal_grid[${index}][existing_system]`
                                            );

                                            $(this).find('textarea').eq(1).attr(
                                                'name',
                                                `change_proposal_grid[${index}][proposed_change]`
                                            );

                                            $(this).find('textarea').eq(2).attr(
                                                'name',
                                                `change_proposal_grid[${index}][justification]`
                                            );
                                        });
                                    });

                                });
                                </script>

                        <div class="sub-head">
                            Impact Assessment @if($data->stage ==1)
                                    <span class="text-danger">*</span>
                                            @endif
                        </div>

                                @php
                                    $questions = [
                                        'q1_1' => 'Availability of Product Permission.',
                                        'q1_2' => 'Availability of Manufacturing License.',
                                        'q1_3' => 'Availability of Marketing Authorization.',
                                        'q1_4' => 'Technical Agreement.',
                                        'q1_5' => 'Site Variation Filing (for New Site).',
                                        'q1_6' => 'New Product Code.',
                                        'q1_7' => 'Facility Qualification / Modification.',
                                        'q1_8' => 'Utility Requirements / Qualification',
                                        'q1_9' => 'New Equipment Req. or Modifications.',
                                        'q1_10' => 'Process Validation.',
                                        'q1_11' => 'Cleaning Validation .',
                                        'q1_12' => 'Master Formula Record.',
                                        'q1_13' => 'Master Packing Record.',
                                        'q1_14' => 'Additional studies.',
                                        'q1_15' => 'Reagents/ Chemicals/ Solvents or any other Resources.',
                                        'q1_16' => 'Equipment/ Instrument Accessories/ Parts / Change Parts & Layout.',
                                        'q1_17' => 'Analytical Method Validation.',
                                        'q1_18' => 'PM BOM.',
                                        'q1_19' => 'BMR.',
                                        'q1_20' => 'BPR.',
                                        'q1_21' => 'Hold Time Study.',
                                        'q1_22' => 'Site Master File.',
                                        'q1_23' => 'Validation Master Plan.',
                                        'q1_24' => 'Requirement of outside test.',
                                        'q1_25' => 'Additional Equipment / Instruments.',
                                        'q1_26' => 'Environmental Condition.',
                                        'q1_27' => 'Testing Feasibility.',
                                        'q1_28' => 'Annual Product Review.',
                                        'q1_29' => 'New Source/ Vendor Requirement.',
                                        'q1_30' => 'Vendor Qualification.',
                                        'q1_31' => 'Approved Vendor List Updation.',
                                        'q1_32' => 'New Code Generation/ Item Codification.',
                                        'q1_33' => 'List of Item Codes.',
                                        'q1_34' => 'Approved Specimen/ Shade Card.',
                                        'q1_35' => 'Status of Old Stocks (for Usage / Destruction).',
                                        'q1_36' => 'Customer/ Contract Giver Approval.',
                                        'q1_37' => 'Process Parameters.',
                                        'q1_38' => 'Training.',
                                        'q1_39' => 'GMP   / GLP Requirements.',
                                        'q1_40' => 'MOC Requirements.',
                                        'q1_41' => 'List of Equipment / instruments.',
                                        'q1_42' => 'New Utility Connections / Modifications.',
                                        'q1_43' => 'Drawings / layouts.',
                                        'q1_44' => 'Equipment P & I Diagram.',
                                        'q1_45' => 'Regulatory Submissions.',
                                        'q1_46' => 'Validation Activity (Other).',
                                        'q1_47' => 'Equipment Location Layout.',
                                        'q1_48' => 'Responsibilities.',
                                        'q1_49' => 'Intimation/ Notification to Regulatory Bodies.',
                                        'q1_50' => 'Quality Management System.',
                                        'q1_51' => 'Facility and Other Layouts.',
                                        'q1_52' => 'Pharmacopeia Requirements.',
                                        'q1_53' => 'Raw Material Specifications.',
                                        'q1_54' => 'Packing Material Specification.',
                                        'q1_55' => 'In process Specification.',
                                        'q1_56' => 'Finished Product Specification.',
                                        'q1_57' => 'Approved Art works/ Proofs.',
                                        'q1_58' => 'Packaging Specification / configuration.',
                                        'q1_59' => 'Status of Existing stock in case of Artwork/ packing material related changes.',
                                        'q1_60' => 'Quality Agreements with vendors.',
                                        'q1_61' => 'Calibration.',
                                        'q1_62' => 'Calibration Planner / Addendum to Calibration Planner.',
                                        'q1_63' => 'Stability Protocol / Report / Stability studies.',
                                        'q1_64' => 'Stability Specification.',
                                        'q1_65' => 'Updating of Product Lists.',
                                        'q1_66' => 'HPLC Column.',
                                        'q1_67' => 'Placebo.',
                                        'q1_68' => 'Impurity standards.',
                                        'q1_69' => 'Primary standards.',
                                        'q1_70' => 'Mfg. Feasibility.',
                                        'q1_71' => 'Qualification document (URS/DQ/IQ/OQ/PQ).',
                                        'q1_72' => 'Manual COA (Raw Material / Finish Product).',
                                        'q1_73' => 'Safety.',
                                        'q1_74' => 'Annual Maintenance Contract.',
                                        'q1_75' => 'Service agreement.',
                                        'q1_76' => 'Qualification / Re-qualification.',
                                        'q1_77' => 'SOP.',
                                        'q1_78' => 'STPs.',
                                        'q1_79' => 'Logbooks.',
                                        'q1_80' => 'Preventive Maintenance.',
                                        'q1_81' => 'Planner for PM / Addendum to PM Planner.',
                                        'q1_82' => 'Regulatory Requirements.',
                                        'q1_83' => 'Tech Transfer.',
                                        'q1_84' => 'Man & Material Movement.',
                                        'q1_85' => 'Temperature / RH/ Differential Pressures.',
                                        'q1_86' => 'Temperature Mapping.',
                                        'q1_87' => 'HVAC Validation.',
                                        'q1_88' => 'Water System Validation.',
                                        'q1_89' => 'Area Nomenclature.',
                                        'q1_90' => 'Qualified Personnel.',
                                        'q1_91' => 'Shelf life.',
                                        'q1_92' => 'Text matter.',
                                        'q1_93' => 'GTIN 1D.',
                                        'q1_94' => 'QR code.',
                                        'q1_95' => 'Pack size.',
                                        'q1_96' => 'Pack style.',
                                        'q1_97' => 'Design.',
                                        'q1_98' => 'Formula.',
                                        'q1_99' => 'API vendor.',
                                        'q1_100' => 'Registration Certificate number.',
                                        'q1_101' => 'Mfg. License number.',
                                        'q1_102' => 'Final COA (Raw Material/ Finish Product).',
                                        'q1_103' => 'Any Other', // Last question with manual input
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
                                                        <th style="width: 50%;">Particular</th>
                                                        <th style="width: 40%;">Yes/No</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                @foreach ($questions as $key => $question)
                                                    @php
                                                        $isLastQuestion = $loop->last;
                                                        $saved = $savedChecklist[$key] ?? [];
                                                    @endphp

                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}.</td>

                                                        {{-- Question --}}
                                                        <td>
                                                            {{ $question }}
                                                            <input type="hidden" name="checklist[{{ $key }}][question]" value="{{ $question }}">
                                                        </td>

                                                        {{-- Answer --}}
                                                        <td>
                                                            @if(!$isLastQuestion)

                                                                {{-- YES / NO --}}
                                                                <select name="checklist[{{ $key }}][response]" style="width:100%; border:1px solid #000;">

                                                                    <option value="No"
                                                                        {{ isset($saved['response']) && $saved['response'] == 'No' ? 'selected' : '' }}>
                                                                        No
                                                                    </option>

                                                                    <option value="Yes"
                                                                        {{ isset($saved['response']) && $saved['response'] == 'Yes' ? 'selected' : '' }}>
                                                                        Yes
                                                                    </option>

                                                                </select>

                                                            @else

                                                                {{-- LAST QUESTION (Manual Input) --}}
                                                                <textarea 
                                                                    name="checklist[{{ $key }}][manual_response]"
                                                                    rows="3"
                                                                    style="width:100%; border:1px solid #ccc; padding:8px; border-radius:5px;"
                                                                    placeholder="Enter additional comments..."
                                                                >{{ $saved['manual_response'] ?? '' }}</textarea>

                                                            @endif
                                                        </td>
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
                                                                    style="font-size:20px; margin-right:4px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-remove-id="REFEFile-{{ $loop->index }}"
                                                                data-file-name="{{ $file }}"
                                                                style="@if ($data->stage == 0 || $data->stage == 6) pointer-events: none; @endif"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px; margin-right:4px;"></i></a>
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

                                <input type="hidden" id="deleted_cpAttachment" name="deleted_cpAttachment" value="">
                                
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
                                                    const deletedFilesInput = document.getElementById('deleted_cpAttachment');
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
                                    <label for="Assigned To">HOD/Designee Review Comment @if($data->stage == 2) <span class="text-danger">*</span>                                        
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
                                    <label for="HOD Attachments">HOD/Designee Attachments</label>
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
                                                                style="font-size:20px; margin-right:4px;"></i></a>
                                                        <a type="button" class="remove-file"
                                                            data-remove-id="EFREFEFile-{{ $loop->index }}"
                                                            data-file-name="{{ $file }}"
                                                            style="@if ($data->stage == 0 || $data->stage == 6) pointer-events: none; @endif"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px; margin-right:4px;"></i></a>
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

                            <input type="hidden" id="deleted_hodAttachment" name="deleted_hodAttachment" value="">
                                
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
                                                    const deletedFilesInput = document.getElementById('deleted_hodAttachment');
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
                                    <label for="Assigned To">QA/CQA Review Comments @if($data->stage == 3) <span class="text-danger">*</span>@endif</label>
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
                                                                style="font-size:20px; margin-right:4px;"></i></a>
                                                        <a class="remove-file"
                                                            data-remove-id="QAREFEFile-{{ $loop->index }}"
                                                            data-file-name="{{ $file }}"
                                                            style="@if ($data->stage == 0 || $data->stage == 6) pointer-events: none; @endif"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px; margin-right:4px;"></i></a>
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

                            <input type="hidden" id="deleted_qaAttachment" name="deleted_qaAttachment" value="">
                                
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
                                                    const deletedFilesInput = document.getElementById('deleted_qaAttachment');
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
                                    <label for="Assigned To">QA/CQA Head / Designee Approval Comments @if($data->stage == 4) <span class="text-danger">*</span>@endif</label>
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
                                                                style="font-size:20px; margin-right:4px;"></i></a>
                                                        <a class="remove-file"
                                                            data-remove-id="QAREFEFile-{{ $loop->index }}"
                                                            data-file-name="{{ $file }}"
                                                            style="@if ($data->stage == 0 || $data->stage == 6) pointer-events: none; @endif"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px; margin-right:4px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="HOD_Attachments" name="qa_cqa_head_Attachment[]"
                                                oninput="addMultipleFiles(this, 'qa_cqa_head_Attachment')" {{ $istab4 ? "" : "disabled" }} multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="deleted_qa_cqa_head_Attachment" name="deleted_qa_cqa_head_Attachment" value="">
                                
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
                                                    const deletedFilesInput = document.getElementById('deleted_qa_cqa_head_Attachment');
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
                                    <label for=" Rejected By">Cancel By</label>
                                    <div class="static">
                                        {{ !empty($data->cancelled_by) ? $data->cancelled_by : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Cancel On</label>
                                    <div class="static">
                                        {{ !empty($data->cancelled_on) ? $data->cancelled_on : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Cancel Comment</label>
                                    <div class="static">
                                        {{ !empty($data->cancel_comment) ? $data->cancel_comment : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="HOD /Designee Review comment By">HOD/Designee Review By</label>
                                    <div class="static">
                                        {{ !empty($data->HOD_Review_Complete_By) ? $data->HOD_Review_Complete_By : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="HOD /Designee Review comment By">HOD/Designee Review On </label>
                                    <div class="static">
                                        {{ !empty($data->HOD_Review_Complete_On) ? $data->HOD_Review_Complete_On : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="HOD /Designee Review comment By">HOD/Designee Review Comment</label>
                                    <div class="static">
                                        {{ !empty($data->HOD_Review_Comments) ? $data->HOD_Review_Comments : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>

                                <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Cancel hod By">Cancel By</label>
                                    <div class="static">
                                        {{ !empty($data->hod_cancelled_by) ? $data->hod_cancelled_by : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="HOD cancel On">Cancel On</label>
                                    <div class="static">
                                        {{ !empty($data->hod_cancelled_on) ? $data->hod_cancelled_on : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="HOD CancelOn">Cancel Comment</label>
                                    <div class="static">
                                        {{ !empty($data->hod_cancel_comment) ? $data->hod_cancel_comment : 'Not Applicable' }}
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
                                    <label for=" Rejected By">QA/CQA Head/Designee Approval Complete By</label>
                                    <div class="static">
                                        {{ !empty($data->qa_cqa_head_Review_Complete_By) ? $data->qa_cqa_head_Review_Complete_By : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">QA/CQA Head/Designee Approval Complete On</label>
                                    <div class="static">
                                        {{ !empty($data->qa_cqa_head_Review_Complete_On) ? $data->qa_cqa_head_Review_Complete_On : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">QA/CQA Head/Designee Approval Complete Comment</label>
                                    <div class="static">
                                        {{ !empty($data->qa_cqa_head_Review_Comments) ? $data->qa_cqa_head_Review_Comments : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>

                             <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">Rejected By</label>
                                    <div class="static">
                                        {{ !empty($data->rejected_by) ? $data->rejected_by : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Rejected On</label>
                                    <div class="static">
                                        {{ !empty($data->rejected_on) ? $data->rejected_on : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Rejected Comment</label>
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

                <form action="{{ route('cpjreject', $data->id) }}" method="POST">
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

    <div class="modal fade" id="cancel-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('hodCancle', $data->id) }}" method="POST">
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
