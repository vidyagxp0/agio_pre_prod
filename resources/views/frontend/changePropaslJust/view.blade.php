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
        header .header_rcms_bottom ,.container-fluid.header-bottom,.search-bar{
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
        #change-control-fields .inner-block .main-head{
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
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName($data->site_location_code) }} /
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
                    {{--@php
                        $userRoles = DB::table('user_roles')
                            ->where([
                                'user_id' => Auth::user()->id,
                                'q_m_s_divisions_id' => $data->site_location_code,
                            ])
                            ->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                    @endphp--}}
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
                                href="{{ url('rcms/audit_trailNew', $data->id) }}">Audit Trail</a> </button>
                        @if ($data->stage == 1 && (($data->initiator == Auth::user()->id) || Helpers::check_roles($data->site_location_code, 'Extension', 3) || Helpers::check_roles($data->division_id, 'Extension', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#reject-required-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 2 && (Helpers::check_roles($data->site_location_code, 'Extension', 4) || Helpers::check_roles($data->division_id, 'Extension', 18)))
                                
                            @if(($data->count == 3) || ($data->count_data == "number3"))
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-reviewed-modal">
                                    Review
                                </button>
                            @else
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                    Review
                                </button>
                            @endif
                            
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>

                        @elseif($data->stage == 3 && (Helpers::check_roles($data->site_location_code, 'Extension', 67) || Helpers::check_roles($data->site_location_code, 'Extension', 64) || Helpers::check_roles($data->division_id, 'Extension', 18)))

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-approved-modal">
                                Approved
                            </button>
                        
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#reject-modal">
                                Reject
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                        @elseif($data->stage == 5 && (Helpers::check_roles($data->site_location_code, 'Extension', 64) || Helpers::check_roles($data->division_id, 'Extension', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                CQA Approval Complete
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button> (in_array(10, $userRoleIds) || in_array(18, $userRoleIds))--}}
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
                        0% { background-color: #de8d0a; }
                        50% { background-color: #dfac54; }
                        100% { background-color: #de8d0a; }
                    }
                    
                </style>  
                <div class="status">
                    <div class="head">Current Status</div>
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @elseif ($data->stage == 4)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Rejected</div>
                        </div>
                    @else
                        <div class="progress-bars d-flex">
                            @php
                                $currentStage = $data->stage;
                            @endphp
                           
                            <div class="{{ $currentStage > 1 ? 'active' : ($currentStage == 1 ? 'current' : '') }}">Opened</div>

                            <div class="{{ $currentStage > 2 ? 'active' : ($currentStage == 2 ? 'current' : '') }}">In Review</div>

                            @if(($data->count != 3) && 
                                ($data->count_data != "number3"))
                                <div class="{{ $data->stage > 3 ? 'active' : ($data->stage == 3 ? 'current' : '') }}">
                                    In Approved
                                </div>
                            @endif

                            @if(($data->count == 3) || ($data->count_data == "number3")) 
                                <div class="{{ $data->stage > 5 ? 'active' : ($data->stage == 5 ? 'current' : '') }}">
                                    In CQA Approval
                                </div>
                            @endif

                            @if ($data->stage >= 6)
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
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">QA/CQA Approval</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">CQA Approval</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Activity Log</button>
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
                        tabToActivate = 'CCForm3'; 
                    } else if (stage == 5) {
                        tabToActivate = 'CCForm5'; 
                    } else if (stage == 6) {
                        tabToActivate = 'CCForm4'; 
                    } else if (stage == 0) {
                        tabToActivate = 'CCForm4'; 
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
                    const currentStage = <?php echo json_encode($data->stage ?? 1); ?>;
                    
                    activateTabBasedOnStage(currentStage);
                });
            </script>
            

            <form action="{{ route('cpupdate', $data->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Tab content -->
                <div id="step-form">

                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record"
                                            value="{{ Helpers::getDivisionName($data->site_location_code) }}/CPJ/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input disabled type="text" name="division_code" id="division_code"
                                            value="{{ Helpers::getDivisionName($data->site_location_code) }}">
                                        <input type="hidden" name="division_code" id="division_code"
                                            value="{{ $data->division_code }}">
                                        {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        {{-- <input type="hidden" value="{{ Auth::user()->name }}" name="initiator" id="initiator"> --}}
                                        <input disabled type="text" name="initiator" id="initiator"
                                            value="{{ Helpers::getInitiatorName($data->initiator) }}">
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
                                            value="{{ Helpers::getdateFormat($data->initiation_date) }}"
                                            name="initiation_date" id="initiation_date"
                                            style="background-color: light-dark(rgba(239, 239, 239, 0.3), rgba(59, 59, 59, 0.3))">
                                        {{-- <input type="hidden" value="{{ date('Y-m-d') }}" name="initiation_date_hidden"> --}}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        Characters remaining
                                        <input id="docname" type="text" name="cpdescription"
                                            value="{{ $data->cpdescription }}" maxlength="255" required>
                                    </div>
                                   
                                </div>
                                <script>
                                    var maxLength = 255;
                                    $('#docname').keyup(function() {
                                        var textlen = maxLength - $(this).val().length;
                                        $('#rchars').text(textlen);
                                    });
                                </script>



                            <div class="col-12">
                                <div class="group-input">
                                    <label for="root_cause">
                                        Change Proposal Grid
                                        <button type="button" id="traceblity_add">+</button>
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
                                                                value="{{ $loop->iteration }}">
                                                        </td>

                                                        <td>
                                                            <input type="text"
                                                                name="change_proposal_grid[{{ $index }}][existing_system]"
                                                                value="{{ $item['existing_system'] ?? '' }}">
                                                        </td>

                                                        <td>
                                                            <input type="text"
                                                                name="change_proposal_grid[{{ $index }}][proposed_change]"
                                                                value="{{ $item['proposed_change'] ?? '' }}">
                                                        </td>

                                                        <td>
                                                            <input type="text"
                                                                name="change_proposal_grid[{{ $index }}][justification]"
                                                                value="{{ $item['justification'] ?? '' }}">
                                                        </td>

                                                        <td>
                                                            <button type="button" class="removeRowBtn">Remove</button>
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

                                        function generateTableRow(serialNumber)
                                         {
                                        var html =
                                            '<tr>' +

                                            '<td><input disabled type="text" name="change_proposal_grid[' + serialNumber + '][serial]" value="' + (serialNumber + 1) + '"></td>' +

                                            '<td><input type="text" name="change_proposal_grid[' + serialNumber + '][existing_system]"></td>' +

                                            '<td><input type="text" name="change_proposal_grid[' + serialNumber + '][proposed_change]"></td>' +

                                            '<td><input type="text" name="change_proposal_grid[' + serialNumber + '][justification]"></td>' +

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
                              
                                

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Attachment Extension">Attachment</label>
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
                                                <input {{ $data->stage == 1 ? '' : 'disabled' }} type="file"
                                                    id="myfile" name="cpAttachment[]"
                                                    oninput="addMultipleFiles(this, 'cpAttachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton" {{ $data->stage == 0 || $data->stage == 5 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>

                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit </a> </button>
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
                                    <label for="Assigned To">HOD Remarks</label>
                                    <textarea name="hod_comment" id="hod_comment" cols="30"
                                        >{{ $data->hod_comment }}</textarea>
                                </div>
                            </div>
                            
                            @if ($data->hodAttachment)
                                @foreach (json_decode($data->hodAttachment) as $file)
                                    <input id="EFREFEFile-{{ $loop->index }}" type="hidden"
                                        name="existing_hodAttachment[{{ $loop->index }}]"
                                        value="{{ $file }}">
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
                                            <input {{ $data->stage == 2 ? '' : 'disabled' }}
                                                value="{{ $data->hodAttachment }}" type="file"
                                                id="myfile" name="hodAttachment[]"
                                                oninput="addMultipleFiles(this, 'hodAttachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton" {{ $data->stage == 0 || $data->stage == 5 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
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
                                        <label for="Assigned To">QA/CQA Approval Comments</label>
                                        <textarea name="qa_comment" id="qa_comment" cols="30"
                                            >{{ $data->qa_comment }}</textarea>
                                    </div>
                                </div>

                                @if ($data->qaAttachment)
                                    @foreach (json_decode($data->qaAttachment) as $file)
                                        <input id="QAREFEFile-{{ $loop->index }}" type="hidden"
                                            name="existing_qaAttachment[{{ $loop->index }}]"
                                            value="{{ $file }}">
                                    @endforeach
                                @endif
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">QA/CQA Approval Attachments</label>
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
                                                    oninput="addMultipleFiles(this, 'qaAttachment')" multiple
                                                    {{ in_array($data->stage, [3, 5]) ? '' : 'disabled' }}>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton" {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button">
                                    <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>
              

                    <div id="CCForm5" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Assigned To">CQA Approval Comments</label>
                                        <textarea name="qa_cqa_head_comment" id="qa_cqa_head_comment" cols="30">{{ $data->qa_cqa_head_comment }}</textarea>
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
                                        <label for="Inv Attachments">CQA Approval Attachments</label>
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
                                                    oninput="addMultipleFiles(this, 'qa_cqa_head_Attachment')" multiple
                                                    {{ in_array($data->stage, [3, 5]) ? '' : 'disabled' }}>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton" {{ $data->stage == 0 ||  $data->stage == 6 ? 'disabled' : '' }}>Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button">
                                    <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>
              

                <!-- Activity Log content -->
                <div id="CCForm4" class="inner-block cctabcontent">
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
                                    <div class="static">{{ !empty($data->submit_comment) ? $data->submit_comment : 'Not Applicable' }}</div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">Cancel By</label>
                                    <div class="static">{{ !empty($data->reject_by) ? $data->reject_by : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Cancel On</label>
                                    <div class="static">{{ !empty($data->reject_on) ? $data->reject_on : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Cancel Comment</label>
                                    <div class="static">{{ !empty($data->reject_comment) ? $data->reject_comment : 'Not Applicable' }}</div>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">Review By</label>
                                    <div class="static">{{ !empty($data->submit_by_review) ? $data->submit_by_review : 'Not Applicable' }}</div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Review On</label>
                                    <div class="static">{{ !empty($data->submit_on_review) ? $data->submit_on_review : 'Not Applicable' }}</div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Review Comment</label>
                                    <div class="static">{{ !empty($data->submit_comment_review) ? $data->submit_comment_review : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">Reject By</label>
                                    <div class="static">{{ !empty($data->submit_by_inapproved) ? $data->submit_by_inapproved : 'Not Applicable' }}</div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Reject On</label>
                                    <div class="static">{{ !empty($data->submit_on_inapproved) ? $data->submit_on_inapproved : 'Not Applicable' }}</div>
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


                        {{--@if($data->count == 3)
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">Send for CQA By</label>
                                    <div class="static">{{ !empty($data->send_cqa_by) ? $data->send_cqa_by : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Send for CQA On</label>
                                    <div class="static">{{ !empty($data->send_cqa_on) ? $data->send_cqa_on : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Send for CQA Comment</label>
                                    <div class="static">{{ !empty($data->send_cqa_comment) ? $data->send_cqa_comment : 'Not Applicable' }}</div>
                                </div>
                            </div>
                        @endif --}}

                        @if($data->count != 3)

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">Approved By</label>
                                    <div class="static">{{ !empty($data->submit_by_approved) ? $data->submit_by_approved : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Approved On</label>
                                    <div class="static">{{ !empty($data->submit_on_approved) ? $data->submit_on_approved : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Approved Comment</label>
                                    <div class="static">{{ !empty($data->submit_comment_approved) ? $data->submit_comment_approved : 'Not Applicable' }}</div>
                                </div>
                            </div>
                        @endif

                        @if($data->count == 3)
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">CQA Approval Complete By</label>
                                    <div class="static">{{ !empty($data->cqa_approval_by) ? $data->cqa_approval_by : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">CQA Approval Complete On</label>
                                    <div class="static">{{ !empty($data->cqa_approval_on) ? $data->cqa_approval_on : 'Not Applicable' }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">CQA Approval Complete Comment</label>
                                    <div class="static">{{ !empty($data->cqa_approval_comment) ? $data->cqa_approval_comment : 'Not Applicable' }}</div>
                                </div>
                            </div>
                        @endif

                        </div>
                        {{-- <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                        <a href="/rcms/qms-dashboard">
                            <button type="button" class="backButton">Back</button>
                        </a>
                        <button type="submit">Submit</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                Exit </a> </button>
                    </div> --}}

                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton" {{ $data->stage == 0 || $data->stage == 5 || $data->stage == 6 ? 'disabled' : '' }}>Save</button>
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
                <form action="{{ route('cpj_send_stage', $data->id) }}" method="POST"
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

                <form action="{{ route('RejectState_extension', $data->id) }}" method="POST">
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
    {{--  <script>
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

        const saveButtons = document.querySelectorAll('.saveButton');
        const form = document.getElementById('step-form');


    </script>  --}}
    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#relatedRecords, #designee, #hod,#'
        });
    </script>


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
        $(document).ready(function() {
            $('.remove-file').click(function() {
                const removeId = $(this).data('remove-id')
                console.log('removeId', removeId);
                $('#' + removeId).remove();
            })
        })
    </script>
@endsection
