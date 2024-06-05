@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->select('id', 'name')->where('active', 1)->get();
        $userRoles = DB::table('user_roles')->select('user_id')->where('q_m_s_roles_id', 4)->distinct()->get();
        $departments = DB::table('departments')->select('id', 'name')->get();
        $divisions = DB::table('q_m_s_divisions')->select('id', 'name')->get();

        $userIds = DB::table('user_roles')
            ->where('q_m_s_roles_id', 4)
            ->distinct()
            ->pluck('user_id');

        // Step 3: Use the plucked user_id values to get the names from the users table
        $userNames = DB::table('users')
            ->whereIn('id', $userIds)
            ->pluck('name');

        // If you need both id and name, use the select method and get
        $userDetails = DB::table('users')
            ->whereIn('id', $userIds)
            ->select('id', 'name')
            ->get();
        // dd ($userIds,$userNames, $userDetails);
    @endphp
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
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

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(5) {
            border-radius: 0px 20px 20px 0px;

        }
    </style>
    </style>

    
    <div class="form-field-head">

        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{-- {{ Helpers::getDivisionName($data->division_id) }} / --}}
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
                    @php
                        $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $extensionNew->site_location_code])->get();
                        $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                    @endphp
                    <div class="d-flex" style="gap:20px;">
                        {{-- <button class="button_theme1" onclick="window.print();return false;"
                            class="new-doc-btn">Print</button> --}}
                        {{-- <button class="button_theme1"> <a class="text-white"
                                href=""> Audit Trail </a> </button> --}}

                        @if ($extensionNew->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Submit
                        </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                           
                        @elseif($extensionNew->stage == 2 && (in_array(10, $userRoleIds) || in_array(18, $userRoleIds) || in_array(13, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                              Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                                Child
                            </button> --}}
                        @elseif($extensionNew->stage == 3 && (in_array(10, $userRoleIds) || in_array(18, $userRoleIds) || in_array(13, $userRoleIds)))

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                               Approve
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                        @elseif($extensionNew->stage == 4 && (in_array(10, $userRoleIds) || in_array(18, $userRoleIds) || in_array(13, $userRoleIds)))

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                               Approved
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                                More Info Required
                            </button>
                        @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a> </button>


                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    {{-- ------------------------------By Pankaj-------------------------------- --}}
                    @if ($extensionNew->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
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
                             @if ($extensionNew->stage >= 4)
                                <div class="active"> Approved</div>
                            @else
                            <div class=""> Approved</div>
                            @endif

                            @if ($extensionNew->stage >= 5)
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
            <!-- Tab links -->
            <div class="cctab">

                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm2')">Reviewer Feedbacks</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm3')">Approver  Feedbacks</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>

            </div>
            <form action="{{ route('extension_new.update',  $extensionNew->id) }}" method="POST" enctype="multipart/form-data">
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
                                <input disabled type="text" name="record_number">
                                {{-- value="{{ Helpers::getDivisionName(session()->get('division')) }}/DEV/{{ date('Y') }}/{{ $record_number }}"> --}}
                                {{-- <div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}</div> --}}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Division Code"><b>Site/Location Code</b></label>
                                <input disabled type="text" name="site_location"   id="site_location" 
                                    value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                <input type="hidden" name="site_location_code"  id="site_location_code" value="{{ session()->get('division') }}">
                                {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}</div> --}}
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator"><b>Initiator</b></label>
                                {{-- <input type="hidden" value="{{ Auth::user()->name }}" name="initiator" id="initiator"> --}}
                                <input disabled type="text" name="initiator" id="initiator" value="{{ Auth::user()->name }}">


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
                                <input readonly type="text" value="{{ date('d-M-Y') }}" name="initiation_date"
                                    id="initiation_date"
                                    style="background-color: light-dark(rgba(239, 239, 239, 0.3), rgba(59, 59, 59, 0.3))">
                                <input type="hidden" value="{{ date('Y-m-d') }}" name="initiation_date_hidden">
                            </div>
                        </div>
                            
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Short Description">Short Description<span
                                            class="text-danger">*</span></label><span id="rchars">255</span>
                                    Characters remaining
                                    <input id="docname" type="text" name="short_description" value="{{$extensionNew->short_description}}" maxlength="255"
                                        required>
                                </div>
                                {{-- @error('short_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror --}}
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Assigned To">Reviewer </label>
                                    <select id="choices-multiple-remove" class="choices-multiple-reviewe"
                                        name="reviewers" placeholder="Select Reviewers"  >
                                        <option value="">-- Select --</option>
                                        @if (!empty($reviewer))
                                        
                                            @foreach ($reviewer as $lan)
                                                @if(Helpers::checkUserRolesreviewer($lan))
                                                    <option value="{{ $lan->id }}">
                                                        {{ $lan->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Assigned To">Approver </label>
                                    <select id="choices-multiple-remove-but" class="choices-multiple-reviewer"
                                        name="approvers" placeholder="Select Approvers" >
                                        <option value="">-- Select --</option>

                                        @if (!empty($approvers))
                                            @foreach ($approvers as $lan)
                                                @if(Helpers::checkUserRolesApprovers($lan))
                                                    <option value="{{ $lan->id }}">
                                                        {{ $lan->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                           
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Actual Start Date">Current Due Date (Parent)</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="current_due_date" value="{{$extensionNew->current_due_date}}" readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="current_due_date" value="{{$extensionNew->current_due_date}}"
                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
                                            class="hide-input" oninput="handleDateInput(this, 'current_due_date')" />
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="Actual Start Date">Proposed Due Date</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="proposed_due_date" value="{{$extensionNew->proposed_due_date}}" readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="proposed_due_date"
                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"value="{{$extensionNew->proposed_due_date}}"
                                            class="hide-input" oninput="handleDateInput(this, 'proposed_due_date')" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Short Description"> Description<span
                                            class="text-danger">*</span></label><span id="rchars">255</span>
                                    Characters remaining
                                    <input id="docname" type="text" name="description" value="{{$extensionNew->description}}" maxlength="255" >
                                </div>
                                {{-- @error('short_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror --}}
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">Attachment Extension</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="Audit_file">
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
                                            <input type="file" id="HOD_Attachments"
                                                name="file_attachment_extension[]"
                                                oninput="addMultipleFiles(this, 'file_attachment_extension')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton01" class="saveButton">Save</button>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                            <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
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
                                <label for="Assigned To">Reviewer Remarks</label>
                               <input type="text" name="reviewer_remarks" id="reviewer_remarks" value="{{$extensionNew->reviewer_remarks}}" >
                            </div>
                        </div>
                       
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Guideline Attachment">Reviewer Attachment  </label>
                                <div><small class="text-primary">Please Attach all relevant or supporting
                                        documents</small></div>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="file_attachment_guideline"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="file_attachment_guideline[]"
                                            oninput="addMultipleFiles(this, 'file_attachment_guideline')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton02" class="saveButton">Save</button>
                        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
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
                                <label for="Assigned To">Reviewer Remarks</label>
                               <input type="text" name="approver_remarks" id="approver_remarks" value="{{$extensionNew->approver_remarks}}">
                            </div>
                        </div>
                       
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Guideline Attachment">Approver Attachment  </label>
                                <div><small class="text-primary">Please Attach all relevant or supporting
                                        documents</small></div>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="file_attachment_guideline"></div>
                                    <div class="add-btn">
                                        <div>Add</div>
                                        <input type="file" id="myfile" name="file_attachment_guideline[]"
                                            oninput="addMultipleFiles(this, 'file_attachment_guideline')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" id="ChangesaveButton02" class="saveButton">Save</button>
                        <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                                Exit </a> </button>
                    </div>
                </div>
            </div>
             <!-- Activity Log content -->
             <div id="CCForm6" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Activated By">Initiated By</label>
                                <div class="static">{{ $extensionNew->submit_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Activated On">Initiated On</label>
                                <div class="static">{{ $extensionNew->submit_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" Rejected By">Reviewed By</label>
                                <div class="static">{{ $extensionNew->submit_by_review }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Rejected On">Reviewed On</label>
                                <div class="static">{{ $extensionNew->submit_on_review }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for=" Rejected By">Approved By</label>
                                <div class="static">{{ $extensionNew->submit_by_approved }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Rejected On">Approved On</label>
                                <div class="static">{{ $extensionNew->submit_on_approved }}</div>
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

        const saveButtons = document.querySelectorAll('.saveButton1');
        const form = document.getElementById('step-form');
    </script>
    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee ,#reference_record, #designee, #hod'
        });
    </script>
@endsection
