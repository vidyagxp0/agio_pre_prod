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

    <div class="form-field-head">
        <div class="division-bar">
            <strong>Document Issuance Request</strong>
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
                        <button class="button_theme1"> <a class="text-white"
                                href="#">Audit Trail</a> </button>
                        @if ($data->stage == 1 && ($data->request_by == Auth::user()->id || Helpers::check_roles($data->division_id, 'Document Issuance Request', 18)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Request Sent
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#reject-required-modal">
                                Cancel
                            </button>

                        @elseif($data->stage == 2 )
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approved
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                     
                        @endif
                        <a class="text-white" href="{{ url('documents') }}"><button class="button_theme1"> Exit
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
                    @elseif ($data->stage == 4)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Rejected</div>
                        </div>
                    @else
                        <div class="progress-bars d-flex">
                            @php
                                $currentStage = $data->stage;
                            @endphp

                            <div class="{{ $currentStage > 1 ? 'active' : ($currentStage == 1 ? 'current' : '') }}">Request For Print
                            </div>

                            <div class="{{ $currentStage > 2 ? 'active' : ($currentStage == 2 ? 'current' : '') }}">QA Approval</div>

                            @if ($data->stage >= 3)
                                <div class="bg-danger" style="border-radius: 0px 20px 20px 0px;">Closed - Done</div>
                            @else
                                <div class="" style="border-radius: 0px 20px 20px 0px;">Closed - Done</div>
                            @endif
                        </div>
                    @endif
                </div>
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">QA Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Activity Log</button>
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
                    } else if (stage == 0) {
                        tabToActivate = 'CCForm3';
                    }
                    else if (stage == 4) {
                        tabToActivate = 'CCForm3';
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


            <form action="{{ route('document-request.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Tab content -->
                <div id="step-form">
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                @php
                                $istab1 = ($data->stage == 1 && (($data->initiator_id == Auth::user()->id) || Helpers::check_roles($data->division_id, 'Document Issuance Request', 3)));
                                $istab2 = ($data->stage == 2 && (Helpers::check_roles($data->division_id, 'Document Issuance Request', 4)  || Helpers::check_roles($data->division_id, 'Document Issuance Request', 18)));
                                @endphp

                               <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>
                                            <b>Request ID</b>
                                        </label>

                                   <input type="text" value="{{$data->request_id}}" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>
                                            Request By
                                        </label>

                                        <input
                                            type="text"
                                            value="{{ Helpers::getInitiatorName($data->request_by) }}"
                                            readonly
                                        >
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label>
                                            Request Department
                                        </label>

                                        <input
                                            type="text"
                                            value="{{ $data->department }}"
                                            readonly
                                        >
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="document_id">
                                            Document
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select name="document_id" id="document_id">
                                       
                                                <option value="">-- Select Document Number --</option>

                                                @foreach ($documents as $document)
                                                    <option
                                                        value="{{ $document->id }}"
                                                        {{ old('document_id', $data->document_id) == $document->id ? 'selected' : '' }}>
                                                        {{ $document->document_number }}
                                                    </option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="request_to">
                                            Request To
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select
                                            name="request_to"
                                            id="request_to"
                                        >
                                            <option value="">
                                                -- Select User --
                                            </option>

                                            @foreach ($users as $user)
                                                <option
                                                    value="{{ $user->id }}"
                                                    {{ $data->request_to == $user->id ? 'selected' : '' }}
                                                >
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="number_of_copies">
                                            Number of Copies
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input
                                            type="number"
                                            name="number_of_copies"
                                            id="number_of_copies"
                                            value="{{ $data->number_of_copies }}"
                                            min="1"
                                        >
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="reason">
                                            Reason
                                            <span class="text-danger">*</span>
                                        </label>

                                        <textarea
                                            name="reason"
                                            id="reason"
                                        >{{ $data->reason }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>

                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button"> <a href="{{ url('documents') }}"
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
                                    <label for="Assigned To">Comment</label>
                                    <textarea name="comment" id="comment" cols="30" >{{ $data->comment }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a href="{{ url('documents') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

                <!-- Activity Log content -->
                <div id="CCForm3" class="inner-block cctabcontent">
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
                                    <label for=" Rejected By">QA Approved By</label>
                                    <div class="static">
                                        {{ !empty($data->qa_cqa_Review_Complete_By) ? $data->qa_cqa_Review_Complete_By : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">QA Approved On</label>
                                    <div class="static">
                                        {{ !empty($data->qa_cqa__Review_Complete_On) ? $data->qa_cqa__Review_Complete_On : 'Not Applicable' }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">QA Approved Comment</label>
                                    <div class="static">
                                        {{ !empty($data->qa_cqa__Review_Comments) ? $data->qa_cqa__Review_Comments : 'Not Applicable' }}
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
                                <a href="{{ url('documents') }}" class="text-white">
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
                <form action="{{ route('docReq_sendstage', $data->id) }}" method="POST" id="signatureModalForm">
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

                <form action="{{ route('more_info_stage', $data->id) }}" method="POST"  id="RejectModalFormData">
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

                    
                    <div class="modal-footer">
                        <!-- <button type="submit">
                            Submit
                        </button> -->

                         <button type="submit" class="RejectInitiatorModalButton">
                            <div class="spinner-border spinner-border-sm RejectInitiatorModalSpinner"
                                style="display: none" role="status">
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

    <div class="modal fade" id="reject-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('cpjreject', $data->id) }}" method="POST" id="RejectDataModalFormData">
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

                  
                    <div class="modal-footer">
                        <!-- <button type="submit">
                            Submit
                        </button> -->
                         <button type="submit" class="RejectDataInitiatorModalButton">
                            <div class="spinner-border spinner-border-sm RejectDataInitiatorModalSpinner"
                                style="display: none" role="status">
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

    <div class="modal fade" id="reject-required-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('cpjCancle', $data->id) }}" method="POST" id="pendingInitiatorForm">
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

                  
                    <div class="modal-footer">
                        <!-- <button type="submit">
                            Submit
                        </button> -->
                         <button type="submit" class="pendingInitiatorModalButton">
                            <div class="spinner-border spinner-border-sm pendingInitiatorModalSpinner"
                                style="display: none" role="status">
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

    <div class="modal fade" id="cancel-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('hodCancle', $data->id) }}" method="POST" id="cencelInitiatorForm" >
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

                  
                    <div class="modal-footer">
                        
                         <button type="submit" class="CancelInitiatorModalButton">
                            <div class="spinner-border spinner-border-sm CancelInitiatorModalSpinner"
                                style="display: none" role="status">
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


         document.addEventListener('DOMContentLoaded', function() {
            var signatureForm = document.getElementById('RejectModalFormData');

            signatureForm.addEventListener('submit', function(e) {

                var submitButton = signatureForm.querySelector('.RejectInitiatorModalButton');
                var spinner = signatureForm.querySelector('.RejectInitiatorModalSpinner');

                submitButton.disabled = true;

                spinner.style.display = 'inline-block';
            });
        });

         document.addEventListener('DOMContentLoaded', function() {
            var signatureForm = document.getElementById('cencelInitiatorForm');

            signatureForm.addEventListener('submit', function(e) {

                var submitButton = signatureForm.querySelector('.CancelInitiatorModalButton');
                var spinner = signatureForm.querySelector('.CancelInitiatorModalSpinner');

                submitButton.disabled = true;

                spinner.style.display = 'inline-block';
            });
        });

         document.addEventListener('DOMContentLoaded', function() {
            var signatureForm = document.getElementById('RejectDataModalFormData');

            signatureForm.addEventListener('submit', function(e) {

                var submitButton = signatureForm.querySelector('.RejectDataInitiatorModalButton');
                var spinner = signatureForm.querySelector('.RejectDataInitiatorModalSpinner');

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
