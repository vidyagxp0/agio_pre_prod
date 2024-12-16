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

        header {
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
            {{ Helpers::getDivisionName($extensionNew->site_location_code) }} /
            Extension
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
                                'q_m_s_divisions_id' => $extensionNew->site_location_code,
                            ])
                            ->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                    @endphp--}}
                    @php
                    $userRoles = DB::table('user_roles')
                        ->where([
                            'user_id' => Auth::user()->id,
                            'q_m_s_divisions_id' => $extensionNew->site_location_code,
                        ])
                        ->get();
                    $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                @endphp
                    <div class="d-flex" style="gap:20px;">
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}

                        <button class="button_theme1"> <a class="text-white"
                                href="{{ url('rcms/audit_trailNew', $extensionNew->id) }}"> Audit Trail </a> </button>
                        @if ($extensionNew->stage == 1 && Helpers::check_roles($extensionNew->site_location_code, 'Extension', 3))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#reject-required-modal">
                                Cancel
                            </button>
                        @elseif($extensionNew->stage == 2 && Helpers::check_roles($extensionNew->site_location_code, 'Extension', 4))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                        @elseif($extensionNew->stage == 3 && Helpers::check_roles($extensionNew->site_location_code, 'Extension', 67))
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                               Approved
                            </button> --}}
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-approved-modal">
                                Approved
                            </button>
                            @if($extensionNew->count == 3)
                                <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button> -->
                            @endif
                            <!-- @if (Helpers::getChildData($extensionNew->parent_id, 'LabIncident') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'Deviation') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'OOC') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'OOT') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'Management Review') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'CAPA') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'Action Item') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'Resampling') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'Observation') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'RCA') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'Risk Assesment') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'Management Review') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'External Audit') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'Internal Audit') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'Audit Program') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'CC') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'New Documnet') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'Effectiveness Check') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'OOS Micro') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'OOS Chemical') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'Market Complaint') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @elseif(Helpers::getChildData($extensionNew->parent_id, 'Failure Investigation') == 3)
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                                @elseif($extensionNew->count == 'number')
                                <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-cqa-modal">
                                    Send for CQA
                                </button>
                            @endif -->
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#reject-modal">
                                Reject
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                        @elseif($extensionNew->stage == 5 && Helpers::check_roles($extensionNew->site_location_code, 'Extension', 64))
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
                <div class="status">
                    <div class="head">Current Status</div>
                    @if ($extensionNew->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @elseif ($extensionNew->stage == 4)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Rejected</div>
                        </div>
                    @else
                        <div class="progress-bars d-flex">
                            @if ($extensionNew->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif

                            @if ($extensionNew->stage >= 2)
                                <div class="active">In Review</div>
                            @else
                                <div class="">In Review</div>
                            @endif

                            @if ($extensionNew->stage >= 3)
                                <div class="active">In Approved</div>
                            @else
                                <div class="">In Approved</div>
                            @endif

                            @if($extensionNew->count == 3 && $extensionNew->stage >= 5)
                                <div class="active">In CQA Approval</div>
                            @else
                                <div class="" style="display: none;">In CQA Approval</div>
                            @endif
                            
                            @if ($extensionNew->stage >= 6)
                                <div class="bg-danger" style="border-radius: 0px 20px 20px 0px;">Closed - Done</div>
                            @else
                                <div class="" style="border-radius: 0px 20px 20px 0px;">Closed - Done</div>
                            @endif

                            <!-- {{-- @if ($extensionNew->stage == 3 || $extensionNew->stage == 4 ||  ($extensionNew->stage == 6 && $extensionNew->stage_hide == null))
                                <div class="active">In Approved</div>
                            @elseif($extensionNew->stage == 6 && $extensionNew->stage_hide == "stage-6")
                                <div style="display: none" class="active">In Approved</div>
                            @elseif($extensionNew->stage == 5 )
                                <div class="" style="display: none;">In Approved</div>
                            @else
                                <div class="">In Approved</div>
                            @endif
                            <div style="display: none" class=""> In CQA Approval</div> --}} -->
                            <!-- @if ($extensionNew->stage == 3 || $extensionNew->stage == 4 || ($extensionNew->stage == 6 && $extensionNew->stage_hide == null))
                                <div class="active">In Approved</div>
                            @elseif($extensionNew->stage == 6 && $extensionNew->stage_hide == "stage-6")
                                <div style="display: none" class="active">In Approved</div>
                            @elseif($extensionNew->stage == 5 || $extensionNew->count_data == "number" || $extensionNew->count == 3)
                                <div class="" style="display: none;">In Approved</div>
                            @else
                                <div class="">In Approved</div>
                            @endif -->
                            <!-- {{-- @if ($extensionNew->parent_type == 'number'|| $extensionNew->count == 3) --}} -->
                            <!-- <div class="" style="display: none;"> In CQA Approval</div> -->
                            <!-- {{-- @endif --}} -->


                            <!-- @if ($extensionNew->stage == 4 )
                                <div class="bg-danger" style="border-radius: 0px 20px 20px 0px;">Closed - Reject</div>
                                <div style="display: none" class="">Closed - Done</div>
                                <div style="display: none" class=""> In CQA Approval</div>
                            
                            @elseif(($extensionNew->stage == 1 && $extensionNew->count == 'number' && $extensionNew->parent_type == 'number') || ($extensionNew->stage == 2 && $extensionNew->count == 'number' && $extensionNew->parent_type == 'number'))
                                <div class="" style="display: none"> Closed - Reject</div>
                            @elseif($extensionNew->count == 3 && $extensionNew->parent_type != null)
                                <div class="" style="display: none"> Closed - Reject</div>
                            @elseif($extensionNew->stage >= 6 || $extensionNew->count_data == 'number' || $extensionNew->data_number == 3)
                                <div class="" style="display: none; border-radius: 0px 20px 20px 0px;"> Closed - Reject</div>
                            @else
                                <div class="" style="border-radius: 0px 20px 20px 0px;"> Closed - Reject</div>    
                            @endif -->
                            <!-- @if ( $extensionNew->stage_hide == "stage-6")
                            <div class="active"> In CQA Approval</div>
                            @endif -->
                            <!-- @if ($extensionNew->stage == 5)
                                <div class="bg-danger" style="display: none" style="border-radius: 0px 20px 20px 0px;">Closed - Reject</div>
                                <div class="active"> In CQA Approval</div>
                                <div class="" style="border-radius: 0px 20px 20px 0px;">Closed - Done</div>
                            @elseif(($extensionNew->stage_hide == 'stage-6' && $extensionNew->count == 3 && $extensionNew->parent_type != null) || $extensionNew->stage_hide == "stage-6")
                            <div class="" style="display: none;"> In CQA Approval</div>
                            <div class="" style="display: none; border-radius: 0px 20px 20px 0px;">Closed - Done</div>
                            @elseif($extensionNew->count_data == 'number' || ($extensionNew->count == 3 && $extensionNew->parent_type != null) || $extensionNew->data_number == 3)    
                                <div class=""> In CQA Approval</div>
                                <div class="" style="border-radius: 0px 20px 20px 0px;">Closed - Done</div>
                            @endif -->
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

                @if ($extensionNew->data_number == 3)
                <button class="cctablinks" style="display: none;" onclick="openCity(event, 'CCForm3')">QA/CQA Approval</button>
                @elseif($extensionNew->count_data == 'number1' || $extensionNew->count_data == 'number2' || $extensionNew->data_number == 1 || $extensionNew->data_number == 2 || $extensionNew->count == 1 || $extensionNew->count == 2)
                    <button class="cctablinks" onclick="openCity(event, 'CCForm3')">QA/CQA Approval</button>
                @endif

                @if($extensionNew->data_number == 3 || $extensionNew->count_data == 'number' || $extensionNew->count == 3)
                    <button class="cctablinks" onclick="openCity(event, 'CCForm5')">CQA Approval</button>
                @endif

                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Activity Log</button>
            </div>


            <form action="{{ route('extension_new.update', $extensionNew->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Tab content -->
                <div id="step-form">

                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                @if (!empty($parent_id))
                                    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                                    <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                                    <input type="hidden" name="parent_record" value="{{ $parent_record }}">
                                @endif
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record_number"
                                            value="{{ Helpers::getDivisionName($extensionNew->site_location_code) }}/Ext/{{ Helpers::year($extensionNew->created_at) }}/{{ str_pad($extensionNew->record_number, 4, '0', STR_PAD_LEFT) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Site/Location Code</b></label>
                                        <input disabled type="text" name="site_location" id="site_location"
                                            value="{{ Helpers::getDivisionName($extensionNew->site_location_code) }}">
                                        <input type="hidden" name="site_location_code" id="site_location_code"
                                            value="{{ $extensionNew->site_location_code }}">
                                        {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator"><b>Initiator</b></label>
                                        {{-- <input type="hidden" value="{{ Auth::user()->name }}" name="initiator" id="initiator"> --}}
                                        <input disabled type="text" name="initiator" id="initiator"
                                            value="{{ Helpers::getInitiatorName($extensionNew->initiator) }}">
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
                                            value="{{ Helpers::getdateFormat($extensionNew->initiation_date) }}"
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
                                        <input id="docname" type="text" name="short_description"
                                            {{ $extensionNew->stage == 1 ? '' : 'readonly' }}
                                            value="{{ $extensionNew->short_description }}" maxlength="255" required>
                                    </div>
                                    {{-- @error('short_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror --}}
                                </div>
                                <script>
                                    var maxLength = 255;
                                    $('#docname').keyup(function() {
                                        var textlen = maxLength - $(this).val().length;
                                        $('#rchars').text(textlen);
                                    });
                                </script>
                                <!-- <div class="col-lg-6">
                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="group-input">
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <label for="Assigned To">HOD review  </label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <select id="choices-multiple-remove" class="choices-multiple-reviewe"
                                                                                                                                                                                                                                                                                                                                                                                                                                                        name="reviewers" placeholder="Select Reviewers" >
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <option value="">-- Select --</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        @if (!empty($reviewers))
    @foreach ($reviewers as $lan)
    @if (Helpers::checkUserRolesreviewer($lan))
    <option value="{{ $lan->id }}" @if ($lan->id == $extensionNew->reviewers) selected @endif>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        {{ $lan->name }}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </option>
    @endif
    @endforeach
    @endif
                                                                                                                                                                                                                                                                                                                                                                                                                                                    </select>
                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                            </div> -->

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="Extension Number">
                                            Extension Number<span class="text-danger"></span>
                                        </label>
                                            @if (empty($extensionNew->parent_type) || $extensionNew->parent_type == 'number' || $extensionNew->parent_type == 'number1' || $extensionNew->parent_type == 'number2')
                                            <select name="count_data" id="" {{$extensionNew->stage == 1 ? '' : 'disabled'}}>
                                                <option value="">--Select Extension Number--</option>
                                                <option value="number1" @if ($extensionNew->count_data == 'number1' || $extensionNew->data_number == '1') selected @endif>1</option>
                                                <option value="number2" @if ($extensionNew->count_data == 'number2' || $extensionNew->data_number == '2') selected @endif>2</option>
                                                <option value="number" @if ($extensionNew->count_data == 'number' || $extensionNew->data_number == '3') selected @endif>3</option>
                                                </select>
                                            @else
                                                <!-- <select name="count" id="" disabled>
                                                <option value="" >--Select Extension Number--</option>
                                                <option value="1" @if ($extensionNew->count == '1') selected @endif>1</option>
                                                <option value="2" @if ($extensionNew->count == '2') selected @endif>2</option>
                                                <option value="3" @if ($extensionNew->count == '3' || $extensionNew->count == 'number') selected @endif>3</option>
                                                </select> -->
                                                <input type="text" name="count" value="{{ $extensionNew->count }}" readonly>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Assigned To">HOD Review <span class="text-danger">*</span></label>
                                        <select id="choices-multiple-remove" class="choices-multiple-reviewe"
                                            name="reviewers" placeholder="Select Reviewers"
                                            {{ $extensionNew->stage == 0 || $extensionNew->stage == 5 || $extensionNew->stage == 6 ? 'disabled' : '' }} Required>
                                            <option value="">-- Select --</option>
                                            @if (!empty(Helpers::getHODDropdown()))
                                                @foreach (Helpers::getHODDropdown() as $listHod)
                                                    <option value="{{ $listHod['id'] }}"
                                                        @if ($listHod['id'] == $extensionNew->reviewers) selected @endif>
                                                        {{ $listHod['name'] }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="col-lg-6">
                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="group-input">
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <label for="Assigned To">QA approval </label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <select id="choices-multiple-remove-but" class="choices-multiple-reviewer"
                                                                                                                                                                                                                                                                                                                                                                                                                                                        name="approvers" placeholder="Select Approvers" >
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <option value="">-- Select --</option>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        @if (!empty($approvers))
    @foreach ($approvers as $lan)
    @if (Helpers::checkUserRolesApprovers($lan))
    <option value="{{ $lan->id }}" @if ($lan->id == $extensionNew->approvers) selected @endif>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        {{ $lan->name }}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </option>
    @endif
    @endforeach
    @endif
                                                                                                                                                                                                                                                                                                                                                                                                                                                    </select>
                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                            </div> -->
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="related_records">Related Records</label>

                                        <select multiple name="related_records[]" placeholder="Select Reference Records"
                                            data-silent-initial-value-set="true" id="related_records">

                                            @foreach ($relatedRecords as $record)
                                                <option value="{{ $record->id }}">
                                                    {{ Helpers::getDivisionName($record->division_id) }}/{{ Helpers::year($record->created_at) }}/{{ Helpers::record($record->record) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="related_records">Parent Records Number</label>

                                        <!-- Virtual Select Dropdown -->
                                        <div id="related_records" class="virtual-select">
                                            <select multiple name="related_records[]" data-silent-initial-value-set="true"
                                                data-search="false" data-placeholder="Select Parent Record Number"
                                                {{ $extensionNew->stage == 0 || $extensionNew->stage == 6 ? 'disabled' : '' }}>
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

                                                                explode(',', $extensionNew->related_records),
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
                                </div> --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Parent Records Number</b></label>
                                        @if ($extensionNew->related_records)
                                            <input readonly type="text" name="related_records"
                                                value="{{ $extensionNew->related_records }}">
                                        @else
                                            <input type="text" name="related_records_edits"
                                                value="{{ $extensionNew->related_records_edits }}">
                                        @endif
                                    </div>
                                </div>






                                <!-- Add the Virtual Select CSS and JS -->
                                <script>
                                    < link href = "https://cdn.jsdelivr.net/npm/virtual-select@2.0.0/dist/virtual-select.min.css"
                                    rel = "stylesheet" >
                                </script>
                                <script src="https://cdn.jsdelivr.net/npm/virtual-select@2.0.0/dist/virtual-select.min.js"></script>

                                <!-- Initialize the Virtual Select -->
                                <script>
                                    VirtualSelect.init({
                                        ele: '#related_records select', // Target the select element
                                        multiple: true, // Allow multiple selections
                                        search: false, // Disable search (set to true if needed)
                                        placeholder: 'Select Reference Records', // Placeholder text
                                        silentInitialValueSet: true // Silent initial value set
                                    });
                                </script>





                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Assigned To">QA/CQA Approval <span
                                        class="text-danger">*</span></label>
                                        <select id="choices-multiple-remove-but" class="choices-multiple-reviewer"
                                            name="approvers" placeholder="Select Approvers"
                                            {{ $extensionNew->stage == 0 || $extensionNew->stage == 5 || $extensionNew->stage == 6 ? 'disabled' : '' }} required>
                                            <option value="">-- Select --</option>

                                            @if (!empty($users))
                                                @foreach ($users as $lan)
                                                    <option value="{{ $lan->id }}"
                                                        @if ($lan->id == $extensionNew->approvers) selected @endif
                                                        >
                                                        {{ $lan->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Actual Start Date">Current Due Date (Parent)</label>
                                        <div class="calenderauditee">

                                            <input type="text" id="current_due_date"
                                                {{ $extensionNew->stage == 1 ? '' : 'readonly' }}
                                                value="{{ Helpers::getdateFormat($extensionNew->current_due_date) }}"
                                                readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="current_due_date"
                                                {{ $extensionNew->stage == 1 ? '' : 'readonly' }}
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                value="{{ $extensionNew->current_due_date }}" class="hide-input"
                                                oninput="handleDateInput(this, 'current_due_date')" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Actual Start Date">Proposed Due Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="proposed_due_date"
                                                {{ $extensionNew->stage == 1 ? '' : 'readonly' }}
                                                value="{{ Helpers::getdateFormat($extensionNew->proposed_due_date) }}"
                                                readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="proposed_due_date"
                                                {{ $extensionNew->stage == 1 ? '' : 'readonly' }}
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                value="{{ $extensionNew->proposed_due_date }}" class="hide-input"
                                                oninput="handleDateInput(this, 'proposed_due_date')" />
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        function updateProposedDueDateMin() {
                                            var currentDueDateInput = document.querySelector('input[name="current_due_date"]');
                                            var proposedDueDateInput = document.querySelector('input[name="proposed_due_date"]');

                                            if (currentDueDateInput && proposedDueDateInput) {
                                                var currentDueDateValue = currentDueDateInput.value;
                                                if (currentDueDateValue) {
                                                    proposedDueDateInput.setAttribute('min', currentDueDateValue);
                                                } else {
                                                    proposedDueDateInput.setAttribute('min', new Date().toISOString().split('T')[0]);
                                                }
                                            }
                                        }
                                        updateProposedDueDateMin();
                                        document.querySelector('input[name="current_due_date"]').addEventListener('change',
                                            updateProposedDueDateMin);
                                    });
                                </script>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description"> Description</label>
                                        <textarea id="docname" type="text" name="description" value=""
                                            {{ $extensionNew->stage == 1 ? '' : 'readonly' }}>{{ $extensionNew->description }}</textarea>
                                    </div>
                                    {{-- @error('short_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror --}}
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Short Description"> Justification / Reason </label>

                                        <textarea id="docname" type="text" name="justification_reason" value=""
                                            {{ $extensionNew->stage == 1 ? '' : 'readonly' }}>{{ $extensionNew->justification_reason }}</textarea>
                                    </div>
                                    {{-- @error('short_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror --}}
                                </div>
                                <!-- <div class="col-12">
                                                                                                                            <div class="group-input">
                                                                                                                                <label for="Inv Attachments"> Extension Attachment</label>
                                                                                                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                                                                                                        documents</small></div>
                                                                                                                                <div class="file-attachment-field">
                                                                                                                                    <div disabled class="file-attachment-list" id="file_attachment_extension">
                                                                                                                                        @if ($extensionNew->file_attachment_extension)
    @foreach (json_decode($extensionNew->file_attachment_extension) as $file)
    <h6 class="file-container text-dark"
                                                                                                                                                        style="background-color: rgb(243, 242, 240);">
                                                                                                                                                        <b>{{ $file }}</b>
                                                                                                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                                                                                                            target="_blank"><i class="fa fa-eye text-primary"
                                                                                                                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                                                                                                                        <a class="remove-file"
                                                                                                                                                            data-file-name="{{ $file }}"><i
                                                                                                                                                                class="fa-solid fa-circle-xmark"
                                                                                                                                                                style="color:red; font-size:20px;"></i></a>
                                                                                                                                                    </h6>
    @endforeach
    @endif
                                                                                                                                                </div>
                                                                                                                                                <div class="add-btn">
                                                                                                                                                    <div>Add</div>
                                                                                                                                                    <input type="file" id="Extension_Attachments"
                                                                                                                                                        name="file_attachment_extension[]" {{ $extensionNew->stage == 1 ? '' : 'disabled' }}
                                                                                                                                                        oninput="addMultipleFiles(this, 'file_attachment_extension')" multiple>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    </div> -->

                                @if ($extensionNew->file_attachment_extension)
                                    @foreach (json_decode($extensionNew->file_attachment_extension) as $file)
                                        <input id="REFEFile-{{ $loop->index }}" type="hidden"
                                            name="existing_file_attachment_extension[{{ $loop->index }}]"
                                            value="{{ $file }}">
                                    @endforeach
                                @endif
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Attachment Extension">Attachment Extension</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="file_attachment_extension">
                                                @if ($extensionNew->file_attachment_extension)
                                                    @foreach (json_decode($extensionNew->file_attachment_extension) as $file)
                                                        <h6 type="button" class="file-container text-dark"
                                                            style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                    class="fa fa-eye text-primary"
                                                                    style="font-size:20px; margin-right:-10px;"></i></a>
                                                            <a type="button" class="remove-file"
                                                                data-remove-id="REFEFile-{{ $loop->index }}"
                                                                data-file-name="{{ $file }}"
                                                                style="@if ($extensionNew->stage == 0 || $extensionNew->stage == 6) pointer-events: none; @endif"><i
                                                                    class="fa-solid fa-circle-xmark"
                                                                    style="color:red; font-size:20px;"></i></a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input {{ $extensionNew->stage == 1 ? '' : 'disabled' }} type="file"
                                                    id="myfile" name="file_attachment_extension[]"
                                                    oninput="addMultipleFiles(this, 'file_attachment_extension')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton" {{ $extensionNew->stage == 0 || $extensionNew->stage == 5 || $extensionNew->stage == 6 ? 'disabled' : '' }}>Save</button>

                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                        Exit </a> </button>
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
                                    <label for="Assigned To">HOD Remarks @if($extensionNew->stage == 2)<span class="text-danger">*</span>@endif</label>
                                    <textarea name="reviewer_remarks" id="reviewer_remarks" cols="30"
                                        {{ $extensionNew->stage == 2 ? '' : 'readonly' }}>{{ $extensionNew->reviewer_remarks }}</textarea>
                                </div>
                            </div>
                            {{-- <div class="col-12">
                            <div class="group-input">
                                <label for="Guideline Attachment">Reviewer Attachment  </label>
                                <div><small class="text-primary">Please Attach all relevant or supporting
                                        documents</small></div>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="file_attachment_reviewer"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="file_attachment_reviewer[]"
                                            oninput="addMultipleFiles(this, 'file_attachment_reviewer')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                            <!-- <div class="col-12">
                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="group-input">
                                                                                                                                                                                                                                                                                                                                                                                                                                                <label for="Inv Attachments">HOD Attachment </label>
                                                                                                                                                                                                                                                                                                                                                                                                                                                <div><small class="text-primary">Please Attach all relevant or supporting
                                                                                                                                                                                                                                                                                                                                                                                                                                                        documents</small></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="file-attachment-field">
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div disabled class="file-attachment-list" id="file_attachment_reviewer">
                                                                                                                                                                                                                                                                                                                                                                                                                                                        @if ($extensionNew->file_attachment_reviewer)
    @foreach (json_decode($extensionNew->file_attachment_reviewer) as $file)
    <h6 class="file-container text-dark"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    style="background-color: rgb(243, 242, 240);">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <b>{{ $file }}</b>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <a class="remove-file"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        data-file-name="{{ $file }}"><i
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            class="fa-solid fa-circle-xmark"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            style="color:red; font-size:20px;"></i></a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                </h6>
    @endforeach
    @endif
                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="add-btn">
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div>Add</div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                        <input type="file" id="HOD_Attachments"
                                                                                                                                                                                                                                                                                                                                                                                                                                                            name="file_attachment_reviewer[]"
                                                                                                                                                                                                                                                                                                                                                                                                                                                            oninput="addMultipleFiles(this, 'file_attachment_reviewer')" multiple>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                          </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                        </div> -->
                            @if ($extensionNew->file_attachment_reviewer)
                                @foreach (json_decode($extensionNew->file_attachment_reviewer) as $file)
                                    <input id="EFREFEFile-{{ $loop->index }}" type="hidden"
                                        name="existing_file_attachment_reviewer[{{ $loop->index }}]"
                                        value="{{ $file }}">
                                @endforeach
                            @endif
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="HOD Attachments">HOD Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="file_attachment_reviewer">
                                            @if ($extensionNew->file_attachment_reviewer)
                                                @foreach (json_decode($extensionNew->file_attachment_reviewer) as $file)
                                                    <h6 type="button" class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a type="button" class="remove-file"
                                                            data-remove-id="EFREFEFile-{{ $loop->index }}"
                                                            data-file-name="{{ $file }}"
                                                            style="@if ($extensionNew->stage == 0 || $extensionNew->stage == 6) pointer-events: none; @endif"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input {{ $extensionNew->stage == 2 ? '' : 'disabled' }}
                                                value="{{ $extensionNew->file_attachment_reviewer }}" type="file"
                                                id="myfile" name="file_attachment_reviewer[]"
                                                oninput="addMultipleFiles(this, 'file_attachment_reviewer')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton" {{ $extensionNew->stage == 0 || $extensionNew->stage == 5 || $extensionNew->stage == 6 ? 'disabled' : '' }}>Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>
                <!-- Approver-->
                @if( $extensionNew->count_data == 'number1' || $extensionNew->count_data == 'number2' || $extensionNew->data_number == 2 || $extensionNew->data_number == 1 || $extensionNew->count == 1 || $extensionNew->count == 2)
                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Assigned To">QA/CQA Approval Comments @if($extensionNew->stage == 3)<span class="text-danger">*</span>@endif </label>
                                    <textarea name="approver_remarks" id="approver_remarks" cols="30"
                                        {{ in_array($extensionNew->stage, [3, 5]) ? '' : 'readonly' }}>{{ $extensionNew->approver_remarks }}</textarea>
                                </div>
                            </div>

                            @if ($extensionNew->file_attachment_approver)
                                @foreach (json_decode($extensionNew->file_attachment_approver) as $file)
                                    <input id="QAREFEFile-{{ $loop->index }}" type="hidden"
                                        name="existing_file_attachment_approver[{{ $loop->index }}]"
                                        value="{{ $file }}">
                                @endforeach
                            @endif
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">QA/CQA Approval Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="file_attachment_approver">
                                            @if ($extensionNew->file_attachment_approver)
                                                @foreach (json_decode($extensionNew->file_attachment_approver) as $file)
                                                    <h6 class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a class="remove-file"
                                                            data-remove-id="QAREFEFile-{{ $loop->index }}"
                                                            data-file-name="{{ $file }}"
                                                            style="@if ($extensionNew->stage == 0 || $extensionNew->stage == 6) pointer-events: none; @endif"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="HOD_Attachments" name="file_attachment_approver[]"
                                                oninput="addMultipleFiles(this, 'file_attachment_approver')" multiple
                                                {{ in_array($extensionNew->stage, [3, 5]) ? '' : 'disabled' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton" {{ $extensionNew->stage == 0 || $extensionNew->stage == 6 ? 'disabled' : '' }}>Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button">
                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>
                @endif

                @if($extensionNew->data_number == 3 || $extensionNew->count_data == 'number' || $extensionNew->count == 3)
                <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Assigned To">CQA Approval Comments @if($extensionNew->stage == 5)<span class="text-danger">*</span>@endif</label>
                                    <textarea name="QAapprover_remarks" id="QAapprover_remarks" cols="30"
                                        {{ in_array($extensionNew->stage, [3, 5]) ? '' : 'readonly' }}>{{ $extensionNew->QAapprover_remarks }}</textarea>
                                </div>
                            </div>

                            @if ($extensionNew->QAfile_attachment_approver)
                                @foreach (json_decode($extensionNew->QAfile_attachment_approver) as $file)
                                    <input id="QAREFEFile-{{ $loop->index }}" type="hidden"
                                        name="existing_QAfile_attachment_approver[{{ $loop->index }}]"
                                        value="{{ $file }}">
                                @endforeach
                            @endif
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">CQA Approval Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="QAfile_attachment_approver">
                                            @if ($extensionNew->QAfile_attachment_approver)
                                                @foreach (json_decode($extensionNew->QAfile_attachment_approver) as $file)
                                                    <h6 class="file-container text-dark"
                                                        style="background-color: rgb(243, 242, 240);">
                                                        <b>{{ $file }}</b>
                                                        <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                class="fa fa-eye text-primary"
                                                                style="font-size:20px; margin-right:-10px;"></i></a>
                                                        <a class="remove-file"
                                                            data-remove-id="QAREFEFile-{{ $loop->index }}"
                                                            data-file-name="{{ $file }}"
                                                            style="@if ($extensionNew->stage == 0 || $extensionNew->stage == 6) pointer-events: none; @endif"><i
                                                                class="fa-solid fa-circle-xmark"
                                                                style="color:red; font-size:20px;"></i></a>
                                                    </h6>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="HOD_Attachments" name="QAfile_attachment_approver[]"
                                                oninput="addMultipleFiles(this, 'QAfile_attachment_approver')" multiple
                                                {{ in_array($extensionNew->stage, [3, 5]) ? '' : 'disabled' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton" {{ $extensionNew->stage == 0 ||  $extensionNew->stage == 6 ? 'disabled' : '' }}>Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button">
                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>
                @endif
                <!-- Activity Log content -->
                <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Activated By">Submit By</label>
                                    <div class="static">{{ $extensionNew->submit_by }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Activated On">Submit On</label>
                                    <div class="static">{{ $extensionNew->submit_on }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Activated On">Submit Comment</label>
                                    <div class="static">{{ $extensionNew->submit_comment }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">Cancel By</label>
                                    <div class="static">{{ $extensionNew->reject_by }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Cancel On</label>
                                    <div class="static">{{ $extensionNew->reject_on }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Cancel Comment</label>
                                    <div class="static">{{ $extensionNew->reject_comment }}</div>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">Review By</label>
                                    <div class="static">{{ $extensionNew->submit_by_review }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Review On</label>
                                    <div class="static">{{ $extensionNew->submit_on_review }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Review Comment</label>
                                    <div class="static">{{ $extensionNew->submit_comment_review }}</div>
                                </div>
                            </div>




                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">Reject By</label>
                                    <div class="static">{{ $extensionNew->submit_by_inapproved }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Reject On</label>
                                    <div class="static">{{ $extensionNew->submit_on_inapproved }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Reject Comment</label>
                                    <div class="static">{{ $extensionNew->submit_commen_inapproved }}</div>
                                </div>
                            </div>


                        @if($extensionNew->count == 3)
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">Send for CQA By</label>
                                    <div class="static">{{ $extensionNew->send_cqa_by }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Send for CQA On</label>
                                    <div class="static">{{ $extensionNew->send_cqa_on }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Send for CQA Comment</label>
                                    <div class="static">{{ $extensionNew->send_cqa_comment }}</div>
                                </div>
                            </div>
                        @endif    

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By"> Approved By</label>
                                    <div class="static">{{ $extensionNew->submit_by_approved }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On"> Approved On</label>
                                    <div class="static">{{ $extensionNew->submit_on_approved }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Approved Comment</label>
                                    <div class="static">{{ $extensionNew->submit_comment_approved }}</div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By"> CQA Approval Complete By</label>
                                    <div class="static">{{ $extensionNew->cqa_approval_by }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On"> CQA Approval Complete On</label>
                                    <div class="static">{{ $extensionNew->cqa_approval_on }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">CQA Approval Complete Comment</label>
                                    <div class="static">{{ $extensionNew->cqa_approval_comment }}</div>
                                </div>
                            </div>

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
                            <button type="submit" id="ChangesaveButton" class="saveButton" {{ $extensionNew->stage == 0 || $extensionNew->stage == 5 || $extensionNew->stage == 6 ? 'disabled' : '' }}>Save</button>
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
                <form action="{{ route('extension_send_stage', $extensionNew->id) }}" method="POST"
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
                <form action="{{ route('send-cqa', $extensionNew->id) }}" method="POST" id="signatureModalForm">
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
                <form action="{{ route('send-approved', $extensionNew->id) }}" method="POST" id="signatureModalForm">
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

                <form action="{{ route('moreinfoState_extension', $extensionNew->id) }}" method="POST">
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

                <form action="{{ route('extension_reject_stage', $extensionNew->id) }}" method="POST">
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

                <form action="{{ route('RejectState_extension', $extensionNew->id) }}" method="POST">
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
