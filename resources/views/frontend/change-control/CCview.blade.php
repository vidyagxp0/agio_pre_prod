@extends('frontend.rcms.layout.main_rcms')
@section('rcms_container')

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
    </style>
    <style>
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
    </style>

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
    <div id="rcms_form-head">
        <div class="container-fluid">
            <div class="inner-block">


                <div class="slogan">
                    <strong>Site Division / Project </strong>:
                    {{ Helpers::getDivisionName(session()->get('division')) }} / Change Control
                </div>
            </div>
        </div>
    </div>

    <!-- /* Change Control View Data Fields */ -->

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

                        <!-- <button class="button_theme1" onclick="window.print();return false;" class="new-doc-btn">Print</button> 
                        <button class="button_theme1"> <a class="text-white" href="{{ url('send-notification', $data->id) }}"> Send Notification </a> </button> -->

                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/audit-trial', $data->id) }}"> Audit Trail </a> </button>

                        <!-- @if ($data->stage >= 9)
                            <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/eCheck', $data->id) }}">
                                    Close Done </a> </button>
                        @endif -->

                        @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submitdddsd
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 2 && (in_array([4,14], $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Info-required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Supervisor Review Complete
                            </button>
                        @elseif($data->stage == 3 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Initial Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cft-modal">
                                CFT Review Not Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                RA Review Complete
                            </button>
                        @elseif($data->stage == 4 && (in_array(5, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Review Complete
                            </button>
                        @elseif($data->stage == 5 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Send to Opened State
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Send to Pending Supervisor Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Send to Pending Initial QA Reviewer
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                QA Approver Review Complete
                            </button>
                        @elseif($data->stage == 6 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Supervisor Final Review Complete
                            </button>
                        @elseif($data->stage == 7 && (in_array(18, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                All Child Closed
                            </button>
                        @elseif($data->stage == 8 && (in_array([4,14], $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Send to Opened State
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Send to Pending Supervisor Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Send to Pending Initial QA Reviewer
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Post Implementation Review Complete
                            </button>
                        @elseif($data->stage == 9 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Send to Initiator
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Send to Supervisor/HOD/Designee
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Send to QA Reviewer
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Send to QA Approver
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA Head Review Complete
                            </button>
                        @elseif($data->stage == 10 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Re-open
                            </button>
                        @elseif($data->stage == 11 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Re-open Addendum Complete
                            </button>
                        @elseif($data->stage == 12 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Addendum Approved Complete
                            </button>
                        @elseif($data->stage == 13 && (in_array([4,14], $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Reject Re-open Request
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Addendum Execution Complete
                            </button>
                        @elseif($data->stage == 14 && (in_array(18, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                All Re-open Child Closed
                            </button>
                        @elseif($data->stage == 15 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Supervisor Final Review Complete
                            </button>
                        @else
                        @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                            </a> </button>


                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    @if ($data->stage == 0)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @elseif ($data->stage >= 1 || $data->stage < 10 )
                        <div class="progress-bars">
                            @if ($data->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif
                            @if ($data->stage >= 2)
                                <div class="active">Pending Supervisor Review</div>
                            @else
                                <div class="">Pending Supervisor Review</div>
                            @endif
                            @if ($data->stage >= 3)
                                <div class="active">Pending Initial QA Review</div>
                            @else
                                <div class="">Pending Initial QA Review</div>
                            @endif
                            @if ($data->stage >= 4)
                                <div class="active">Pending CFT Review</div>
                            @else
                                <div class="">Pending CFT Review</div>
                            @endif
                            @if ($data->stage >= 5)
                                <div class="active">Pending QA Approve Review</div>
                            @else
                                <div class="">Pending QA Approve Review</div>
                            @endif
                            @if ($data->stage >= 6)
                                <div class="active">Pending Supervisor Final Review</div>
                            @else
                                <div class="">Pending Supervisor Final Review</div>
                            @endif
                            @if ($data->stage >= 7)
                                <div class="active">Pending Child closure</div>
                            @else
                                <div class="">Pending Child closure</div>
                            @endif
                            @if ($data->stage >= 8)
                                <div class="active">Pending Post Implementation Review</div>
                            @else
                                <div class="">Pending Post Implementation Review</div>
                            @endif
                            @if ($data->stage >= 9)
                                <div class="active">Pending QA Head Review</div>
                            @else
                                <div class="">Pending QA Head Review</div>
                            @endif
                            @if ($data->stage >= 10)
                                <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif
                        </div>
                    @else
                        <div class="progress-bars">
                            @if ($data->stage >= 11)
                                <div class="active">Pending for Re-open Addendum</div>
                            @else
                                <div class="">Pending for Re-open Addendum</div>
                            @endif
                            @if ($data->stage >= 12)
                                <div class="active">Pending Addendum Approved</div>
                            @else
                                <div class="">Pending Addendum Approved</div>
                            @endif
                            @if ($data->stage >= 13)
                                <div class="active">Under Addendum Execution</div>
                            @else
                                <div class="">Under Addendum Execution</div>
                            @endif
                            @if ($data->stage >= 14)
                                <div class="active">Pending Re-open Child Close</div>
                            @else
                                <div class="">Pending Re-open Child Close</div>
                            @endif
                            @if ($data->stage >= 15)
                                <div class="active">Under Addendum Verification</div>
                            @else
                                <div class="">Under Addendum Verification</div>
                            @endif
                            @if ($data->stage >= 16)
                                <div class="active">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <div class="control-list">
                @php
                    $users = DB::table('users')->get();
                @endphp
                <div id="change-control-fields">
                    <div class="container-fluid">
                        <!-- Tab links -->
                        <div class="cctab">
                            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General
                                Information</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Change Details</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">QA Review</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Evaluation</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Impact Assessment</button>

                            {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Additional Information</button> --}}
                            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Comments</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Risk Assessment</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm8')">QA Approval Comments</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Change Closure</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm10')">Activity Log</button>
                        </div>

                        <form id="CCFormInput" action="{{ route('CC.update', $data->id) }}" method="POST"
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
                                                    <label for="rls">Record Number</label>
                                                    <div class="static">
                                                        <input disabled type="text"
                                                            value=" {{ Helpers::getDivisionName($data->division_id) }}/CC/{{ date('Y') }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Division Code"><b>Division Code</b></label>
                                                    <input disabled type="text" name="division_code"
                                                        value=" {{ Helpers::getDivisionName($data->division_id) }}">

                                                </div>
                                            </div>
                                            {{-- <div class="static">QMS-North America</div> --}}
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Initiator">Initiator</label>
                                                    <div class="static"><input disabled type="text"
                                                            value="{{ Auth::user()->name }}"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="date_initiation">Date of Initiation</label>
                                                    <div class="static"><input disabled type="text"
                                                            value="{{ date('d-M-Y') }}"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="group-input">
                                                    <label for="search">
                                                        Assigned To
                                                    </label>
                                                    <select placeholder="Select..." name="assign_to" required>
                                                        <option value="">Select a value</option>
                                                        @foreach ($users as $datas)
                                                            @if (Helpers::checkUserRolesassign_to($datas))
                                                                <option value="{{ $datas->id }}"
                                                                    {{ $data->assign_to == $datas->id ? 'selected' : '' }}
                                                                    {{-- @if ($data->assign_to == $datas->id) selected @endif --}}>
                                                                    {{ $datas->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Microbiology">CFT Reviewer</label>
                                                    <select name="Microbiology">
                                                        <option value="0">-- Select --</option>
                                                        <option value="yes" selected>Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Microbiology-Person">CFT Reviewer Person</label>
                                                    <select multiple name="Microbiology_Person[]"
                                                        placeholder="Select CFT Reviewers" data-search="false"
                                                        data-silent-initial-value-set="true" id="cft_reviewer">
                                                        <option value="0">-- Select --</option>
                                                        @foreach ($cft as $data1)
                                                            @if (Helpers::checkUserRolesMicrobiology_Person($data1))
                                                                @if (in_array($data1->id, $cft_aff))
                                                                    <option value="{{ $data1->id }}" selected>
                                                                        {{ $data1->name }}</option>
                                                                @else
                                                                    <option value="{{ $data1->id }}">
                                                                        {{ $data1->name }}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="group-input">
                                                    <label for="due-date">Due Date <span
                                                            class="text-danger"></span></label>
                                                    <div><small class="text-primary">If revising Due Date, kindly mention
                                                            revision reason in "Due Date Extension Justification" data
                                                            field.</small></div>
                                                    <input readonly type="text"
                                                        value="{{ Helpers::getdateFormat($data->due_date) }}"
                                                        name="due_date"
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="initiator-group">Initiator Group</label>
                                                    <select name="Initiator_Group" id="initiator_group">
                                                        <option value="CQA"
                                                            @if ($data->Initiator_Group == 'CQA') selected @endif>Corporate
                                                            Quality Assurance</option>
                                                        <option value="QAB"
                                                            @if ($data->Initiator_Group == 'QAB') selected @endif>Quality
                                                            Assurance Biopharma</option>
                                                        <option value="CQC"
                                                            @if ($data->Initiator_Group == 'CQC') selected @endif>Central
                                                            Quality Control</option>
                                                        <option value="MANU"
                                                            @if ($data->Initiator_Group == 'MANU') selected @endif>Manufacturing
                                                        </option>
                                                        <option value="PSG"
                                                            @if ($data->Initiator_Group == 'PSG') selected @endif>Plasma
                                                            Sourcing Group</option>
                                                        <option value="CS"
                                                            @if ($data->Initiator_Group == 'CS') selected @endif>Central
                                                            Stores</option>
                                                        <option value="ITG"
                                                            @if ($data->Initiator_Group == 'ITG') selected @endif>Information
                                                            Technology Group</option>
                                                        <option value="MM"
                                                            @if ($data->Initiator_Group == 'MM') selected @endif>Molecular
                                                            Medicine</option>
                                                        <option value="CL"
                                                            @if ($data->Initiator_Group == 'CL') selected @endif>Central
                                                            Laboratory</option>
                                                        <option value="TT"
                                                            @if ($data->Initiator_Group == 'TT') selected @endif>Tech
                                                            team</option>
                                                        <option value="QA"
                                                            @if ($data->Initiator_Group == 'QA') selected @endif>Quality
                                                            Assurance</option>
                                                        <option value="QM"
                                                            @if ($data->Initiator_Group == 'QM') selected @endif>Quality
                                                            Management</option>
                                                        <option value="IA"
                                                            @if ($data->Initiator_Group == 'IA') selected @endif>IT
                                                            Administration</option>
                                                        <option value="ACC"
                                                            @if ($data->Initiator_Group == 'ACC') selected @endif>Accounting
                                                        </option>
                                                        <option value="LOG"
                                                            @if ($data->Initiator_Group == 'LOG') selected @endif>Logistics
                                                        </option>
                                                        <option value="SM"
                                                            @if ($data->Initiator_Group == 'SM') selected @endif>Senior
                                                            Management</option>
                                                        <option value="BA"
                                                            @if ($data->Initiator_Group == 'BA') selected @endif>Business
                                                            Administration</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Initiator Group Code">Initiator Group Code</label>
                                                    <input type="text" name="initiator_group_code"
                                                        value="{{ $data->Initiator_Group }}" id="initiator_group_code"
                                                        readonly>
                                                    {{-- <div class="default-name"> <span
                                                    id="initiator_group_code">{{ $data->Initiator_Group }}</span></div> --}}
                                                </div>
                                            </div>
                                            {{-- <div class="col-12">
                                                <div class="group-input">
                                                    <label for="short-desc">Short Description</label>
                                                    <textarea name="short_description">{{ $data->short_description }}</textarea>
                                                </div>
                                            </div>  --}}
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="Short Description">Short Description<span
                                                            class="text-danger">*</span></label><span id="rchars"
                                                        class="text-primary">255 </span><span class="text-primary">
                                                        characters remaining</span>


                                                    <textarea name="short_description" id="docname" type="text" maxlength="255" required
                                                        {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }}>{{ $data->short_description }}</textarea>
                                                </div>
                                                <p id="docnameError" style="color:red">**Short Description is required</p>

                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="severity-level">Severity Level</label>
                                                    <span class="text-primary">Severity levels in a QMS record gauge issue
                                                        seriousness, guiding priority for corrective actions. Ranging from
                                                        low to high, they ensure quality standards and mitigate critical
                                                        risks.</span>
                                                    <select name="severity_level1">
                                                        <option value="0">-- Select --</option>
                                                        <option @if ($data->severity_level1 == 'minor') selected @endif
                                                            value="minor">Minor</option>
                                                        <option @if ($data->severity_level1 == 'major') selected @endif
                                                            value="major">Major</option>
                                                        <option @if ($data->severity_level1 == 'critical') selected @endif
                                                            value="critical">Critical</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Initiator Group">Initiated Through</label>
                                                    <div><small class="text-primary">Please select related
                                                            information</small></div>
                                                    <select name="initiated_through"
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
                                                    <textarea name="initiated_through_req">{{ $data->initiated_through_req }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="repeat">Repeat</label>
                                                    <div><small class="text-primary">Please select yes if it is has
                                                            recurred in past six months</small></div>
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
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="nature-change">Nature Of Change</label>
                                                    <select name="naturechange">
                                                        <option value="0">-- Select --</option>
                                                        <option {{ $data->doc_change == 'Temporary' ? 'selected' : '' }}
                                                            value="Temporary">Temporary
                                                        </option>
                                                        <option {{ $data->doc_change == 'Permanent' ? 'selected' : '' }}
                                                            value="Permanent">Permanent
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="others">If Others</label>
                                                    <textarea name="others">{{ $data->If_Others }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="group-input">
                                                    <label for="div_code">Division Code</label>
                                                    <select name="div_code">
                                                        <option value="0">-- Select --</option>
                                                        <option
                                                            {{ $data->Division_Code == 'Instrumental Lab' ? 'selected' : '' }}
                                                            value="Instrumental Lab">Instrumental Lab</option>
                                                        <option
                                                            {{ $data->Division_Code == 'Microbiology Lab' ? 'selected' : '' }}
                                                            value="Microbiology Lab"> Microbiology Lab</option>
                                                        <option
                                                            {{ $data->Division_Code == 'Molecular lab' ? 'selected' : '' }}
                                                            value="Molecular lab"> Molecular lab</option>
                                                        <option
                                                            {{ $data->Division_Code == 'Physical Lab' ? 'selected' : '' }}
                                                            value="Physical Lab"> Physical Lab</option>
                                                        <option
                                                            {{ $data->Division_Code == 'Stability Lab' ? 'selected' : '' }}
                                                            value="Stability Lab"> Stability Lab</option>
                                                        <option
                                                            {{ $data->Division_Code == 'Wet Chemistry' ? 'selected' : '' }}
                                                            value="Wet Chemistry"> Wet Chemistry</option>
                                                        {{-- <option {{ $data->Division_Code == 'IPQA Lab' ? 'selected' : '' }}
                                                            value="IPQA Lab"> IPQA Lab</option> --}}
                                                        <option
                                                            {{ $data->Division_Code == 'Quality Department' ? 'selected' : '' }}
                                                            value="Quality Department">Quality Department</option>
                                                        <option
                                                            {{ $data->Division_Code == 'Administration Department' ? 'selected' : '' }}
                                                            value="Administration Department">Administration Department
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="others">Initial attachment</label>
                                                    <div><small class="text-primary">Please Attach all relevant or
                                                            supporting documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="in_attachment">
                                                            @if ($data->in_attachment)
                                                                @foreach (json_decode($data->in_attachment) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
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
                                                            <input
                                                                {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                type="file" id="myfile" name="in_attachment[]"
                                                                oninput="addMultipleFiles(this, 'in_attachment')" multiple>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                        </div>
                                    </div>
                                </div>
                                <div id="CCForm2" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="sub-head">
                                            Change Details
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="doc-detail">
                                                        Document Details<button type="button" name="ann"
                                                            id="DocDetailbtn">+</button>
                                                    </label>
                                                    <table class="table-bordered table" id="doc-detail">
                                                        <thead>
                                                            <tr>
                                                                <th>Sr. No.</th>
                                                                <th>Current Document No.</th>
                                                                <th>Current Version No.</th>
                                                                <th>New Document No.</th>
                                                                <th>New Version No.</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (!empty($docdetail->sno))
                                                                @foreach (unserialize($docdetail->current_doc_no) as $key => $datas)
                                                                    <tr>
                                                                        <td><input type="text" name="serial_number[]"
                                                                                value="{{ $key ? $key + 1 : '1' }}"></td>
                                                                        <td><input type="text"
                                                                                name="current_doc_number[]"
                                                                                value="{{ unserialize($docdetail->current_doc_no)[$key] ? unserialize($docdetail->current_doc_no)[$key] : 'Not Applicable' }}">
                                                                        </td>
                                                                        <td><input type="text" name="current_version[]"
                                                                                value="{{ unserialize($docdetail->current_version_no)[$key] ? unserialize($docdetail->current_version_no)[$key] : 'Not Applicale' }}">
                                                                        </td>
                                                                        <td><input type="text" name="new_doc_number[]"
                                                                                value="{{ unserialize($docdetail->new_doc_no)[$key] ? unserialize($docdetail->new_doc_no)[$key] : 'Not Applicable' }}">
                                                                        </td>
                                                                        <td><input type="text" name="new_version[]"
                                                                                value="{{ unserialize($docdetail->new_version_no)[$key] ? unserialize($docdetail->new_version_no)[$key] : 'Not Applicable' }}">
                                                                        </td>

                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                            <div id="docdetaildiv"></div>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="current-practice">
                                                        Current Practice
                                                    </label>
                                                    <textarea name="current_practice">{{ $docdetail->current_practice }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="proposed_change">
                                                        Proposed Change
                                                    </label>
                                                    <textarea name="proposed_change">{{ $docdetail->proposed_change }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="reason_change">
                                                        Reason for Change
                                                    </label>
                                                    <textarea name="reason_change">{{ $docdetail->reason_change }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="other_comment">
                                                        Any Other Comments
                                                    </label>
                                                    <textarea name="other_comment">{{ $docdetail->other_comment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="supervisor_comment">
                                                        Supervisor Comments
                                                    </label>
                                                    <textarea name="supervisor_comment">{{ $docdetail->supervisor_comment }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton"
                                                onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <div id="CCForm3" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="type_change">Type of Change</label>
                                                    <select name="type_chnage">
                                                        <option value="0">-- Select --</option>
                                                        <option {{ $review->type_chnage == 'major' ? 'selected' : '' }}
                                                            value="major">Major</option>
                                                        <option {{ $review->type_chnage == 'minor' ? 'selected' : '' }}
                                                            value="minor">Minor</option>
                                                        <option {{ $review->type_chnage == 'critical' ? 'selected' : '' }}
                                                            value="critical">Critical</option>

                                                    </select>
                                                </div>



                                            </div>

                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="qa_comments">QA Review Comments</label>
                                                    <textarea name="qa_review_comments">{{ $review->qa_comments }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="related_records">Related Records</label>
                                                    {{--  <input type="text" name="related_records"
                                                        value="{{ $review->related_records }}">  --}}
                                                    <select {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        multiple id="related_records" name="related_records[]"
                                                        placeholder="Select Reference Records" data-search="false"
                                                        data-silent-initial-value-set="true" id="related_records">
                                                        @foreach ($pre as $prix)
                                                            <option value="{{ $prix->id }}"
                                                                {{ in_array($prix->id, explode(',', $data->related_records)) ? 'selected' : '' }}>
                                                                {{ Helpers::getDivisionName($prix->division_id) }}/Change-Control/{{ Helpers::year($prix->created_at) }}/{{ Helpers::record($prix->record) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="qa head">QA Attachments</label>
                                                    <div class="file-attachment-field">
                                                        <div class="file-attachment-list" id="qa_head">
                                                            @if ($review->qa_head)
                                                                @foreach (json_decode($review->qa_head) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
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
                                                            <input type="file" id="myfile" name="qa_head[]"
                                                                oninput="addMultipleFiles(this, 'qa_head')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton"
                                                onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <div id="CCForm4" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="sub-head">
                                            Evaluation Detail
                                        </div>
                                        <div class="group-input">
                                            <label for="qa-eval-comments">QA Evaluation Comments</label>
                                            <textarea name="qa_eval_comments">{{ $evaluation->qa_eval_comments }}</textarea>
                                        </div>
                                        <div class="group-input">
                                            <label for="qa-eval-attach">QA Evaluation Attachments</label>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="qa_eval_attach">
                                                    @if ($evaluation->qa_eval_attach)
                                                        @foreach (json_decode($evaluation->qa_eval_attach) as $file)
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
                                                    <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="qa_eval_attach[]"
                                                        oninput="addMultipleFiles(this, 'qa_eval_attach')" multiple>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="sub-head">
                                            Training Information
                                        </div>
                                        <div class="group-input">
                                            <label for="nature-change">Training Required</label>
                                            <select name="training_required">
                                                <option value="0">-- Select --</option>
                                                <option {{ $evaluation->training_required == 'no' ? 'selected' : '' }}
                                                    value="no">No</option>
                                                <option {{ $evaluation->training_required == 'yes' ? 'selected' : '' }}
                                                    value="yes">Yes</option>
                                            </select>
                                        </div>
                                        <div class="group-input">
                                            <label for="train-comments">Training Comments</label>
                                            <textarea name="train_comments">{{ $evaluation->train_comments }}</textarea>
                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton"
                                                onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <div id="CCForm5" class="inner-block cctabcontent">
                                    <div class="col-12">
                                        <div class="group-input">
                                            <div class="why-why-chart">
                                                <table class="table table-bordered">

                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%;">Sr.No.</th>
                                                            <th style="width: 40%;">Question</th>
                                                            <th style="width: 20%;">Response</th>
                                                            <th>Remarks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                        @foreach ($impactassement as $item)
                                                            <tr>
                                                                <td class="flex text-center">1</td>
                                                                <td>Availability of Product Permission </td>
                                                                <td>


                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_1" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            {{-- <option value="">{{ $item->response_1 }}</option> --}}
                                                                            <option value="0">Select Option</option>
                                                                            <option
                                                                                {{ $item->response_1 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes"> Yes</option>
                                                                            <option
                                                                                {{ $item->response_1 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_1 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>


                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="where_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_1" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_1 }}</textarea>
                                                                    </div>
                                                                </td>


                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">2</td>
                                                                <td>Availability of Manufacturing License</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_2" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_2 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_2 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_2 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="where_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_2" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_2 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">3</td>
                                                                <td>Availability of Marketing Authorization</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_3" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            {{--   <option value="">{{ $item->response_3 }}</option> --}}
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_3 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_3 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_3 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="when_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_3" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_3 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">4</td>
                                                                <td>Technical Agreement</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_4" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_4 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_4 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_4 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="coverage_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_4" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_4 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">5</td>
                                                                <td>Site Variation Filing (for New Site)</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_5" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Optin</option>

                                                                            <option
                                                                                {{ $item->response_5 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_5 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_5 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_5" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_5 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">6</td>
                                                                <td>New Product Code</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_6" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_6 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_6 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_6 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_6" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_6 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">7</td>
                                                                <td>Facility Qualification / Modification</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_7" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_7 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_7 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_7 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_7" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_7 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">8</td>
                                                                <td>Utility Requirements / Qualification</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_8" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_8 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_8 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                               <option
                                                                                {{ $item->response_8 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_8" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_8 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">9</td>
                                                                <td>Additional studies</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_9" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_9 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_9 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_9 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_9" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_9 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">10</td>
                                                                <td>Reagents/ Chemicals/ Solvents or any other Resources
                                                                </td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_10" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_10 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_10 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_10 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_10" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_10 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">11</td>
                                                                <td>Equipment/ Instrument Accessories/ Parts / Change Parts
                                                                    & Layout</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_11" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_11 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_11 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_11 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_11" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_11 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">12</td>
                                                                <td>Analytical Method Validation</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_12" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_12 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_12 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_12 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_12" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_12 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">13</td>
                                                                <td>Storage Requirement</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_13" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_13 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_13 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_13 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_13" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_13 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">14</td>
                                                                <td>BMR</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_14" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_14 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_14 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_14 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_14" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_14 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">15</td>
                                                                <td>BPR</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_15" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_15 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_15 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_15 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_15" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_15 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">16</td>
                                                                <td>Hold Time Study</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_16" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_16 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_16 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_16 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_16" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_16 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">17</td>
                                                                <td>Testing Feasibility</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_17" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_17 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_17 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_17 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_17" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_17 }} </textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">18</td>
                                                                <td>Annual Product Review</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_18" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_18 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_18 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_18 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_18" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_18 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">19</td>
                                                                <td>New Source/ Vendor Requirement</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_19" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_19 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_19 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_19 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_19" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_19 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">20</td>
                                                                <td>Vendor Qualification</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_20" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_20 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_20 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_20 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_20" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_20 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">21</td>
                                                                <td>Approved Vendor List Updation</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_21" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_21 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_21 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_21 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_21" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_21 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">21</td>
                                                                <td>New Code Generation/ Item Codification</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_21" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_21 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_21 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_21 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>

                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_21" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_21 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">22</td>
                                                                <td>List of Item Codes</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_22" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_22 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_22 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_22 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_22" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_22 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">23</td>
                                                                <td>Approved Specimen/ Shade Card</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_23" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_23 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_23 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_23 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_23" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_23 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">24</td>
                                                                <td>MOC Requirements</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_24" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_24 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_24 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_24 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_24" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_24 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">25</td>
                                                                <td>List of Equipment / instruments</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_25" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_25 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_25 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_25 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_25" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_25 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">26</td>
                                                                <td>New Utility Connections / Modifications</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_26" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_26 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_26 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_26 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_26" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_26 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">27</td>
                                                                <td>Drawings / layouts</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_27" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_27 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_27 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_27 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_27" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_27 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">28</td>
                                                                <td>Equipment P & I Diagram</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_28" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_28 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_28 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_28 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_28" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_28 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">29</td>
                                                                <td>Regulatory Submissions</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_29" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_29 }}</option>
                                                                            <option
                                                                                {{ $item->response_29 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_29 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_29 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_29" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_29 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">30</td>
                                                                <td>Validation Activity (Other)</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_30" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_30 }}</option>
                                                                            <option
                                                                                {{ $item->response_30 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_30 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_30 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_30" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_30 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">31</td>
                                                                <td>Equipment Location Layout</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_31" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_31 }}</option>
                                                                            <option
                                                                                {{ $item->response_31 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_31 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_31 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_31" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_31 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">32</td>
                                                                <td>New Equipment Req. or Modifications</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_32" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_32 }}</option>
                                                                            <option
                                                                                {{ $item->response_32 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_32 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_32 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_32" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;"> {{ $item->remark_32 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">33</td>
                                                                <td>Process Validation</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_33" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_33 }}</option>
                                                                            <option
                                                                                {{ $item->response_33 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_33 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_33 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_33" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_33 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">34</td>
                                                                <td>Cleaning Validation / Stability studies</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_34" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_34 }}</option>
                                                                            <option
                                                                                {{ $item->response_34 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_34 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_34 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_34" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_34 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">35</td>
                                                                <td>Master Formula Record</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_35" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_35 }}</option>
                                                                            <option
                                                                                {{ $item->response_35 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_35 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_35 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_35" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_35 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">36</td>
                                                                <td>Master Packing Record</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_36" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            
                                                                            <option
                                                                                {{ $item->response_36 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_36 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_36 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_36" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_36 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">37</td>
                                                                <td>Raw Material Specifications</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_37" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_37 }}</option>
                                                                            <option
                                                                                {{ $item->response_37 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_37 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_37 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_37" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_37 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">38</td>
                                                                <td>Packing Material Specification</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_38" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                         
                                                                            <option
                                                                                {{ $item->response_38 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_38 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_38 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="38" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_38 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">39</td>
                                                                <td>In process Specification</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_39" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                           
                                                                            <option
                                                                                {{ $item->response_39 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_39 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_39 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_39" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_39 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">40</td>
                                                                <td>Finished Product Specification</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_40" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_40 }}</option>
                                                                            <option
                                                                                {{ $item->response_40 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_40 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_40 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_40" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_40 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">41</td>
                                                                <td>Approved Art works/ Proofs</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_41" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_41 }}</option>
                                                                            <option
                                                                                {{ $item->response_41 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_41 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_41 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_41" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_41 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">42</td>
                                                                <td>Packaging Specification / configuration</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_42" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_42 }}</option>
                                                                            <option
                                                                                {{ $item->response_42 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_42 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_42 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_42" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_42 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">43</td>
                                                                <td>Site Master File</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_43" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_43 }}</option>
                                                                            <option
                                                                                {{ $item->response_43 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_43 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_43 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_43" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_43 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">44</td>
                                                                <td>Validation Master Plan</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_44" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_44 }}</option>
                                                                            <option
                                                                                {{ $item->response_44 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_44 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_44 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_44" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_44 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">45</td>
                                                                <td>Requirement of outside test</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_45" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_45 }}</option>
                                                                            <option
                                                                                {{ $item->response_45 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_45 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_45 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="45" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_45 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">46</td>
                                                                <td>Additional Equipment / Instruments</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_46" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_46 }}</option>
                                                                            <option
                                                                                {{ $item->response_46 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_46 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_46 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_46" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_46 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">47</td>
                                                                <td>Environmental Condition</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_47" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_47 }}</option>
                                                                            <option
                                                                                {{ $item->response_47 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_47 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_47 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_47" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_47 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">48</td>
                                                                <td>Stability Protocol / Report</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_48" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_48 }}</option>
                                                                            <option
                                                                                {{ $item->response_48 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_48 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_48 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_48" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_48 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">49</td>
                                                                <td>Stability Specification</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_49" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_49 }}</option>
                                                                            <option
                                                                                {{ $item->response_49 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_49 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_49 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_49" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_49 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">50</td>
                                                                <td>Updating of Product Lists</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_50" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_50 }}</option>
                                                                            <option
                                                                                {{ $item->response_50 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_50 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_50 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_50" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_50 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">51</td>
                                                                <td>HPLC Column</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_51" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_51 }}</option>
                                                                            <option
                                                                                {{ $item->response_51 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_51 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_51 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_51" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_51 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">52</td>
                                                                <td>Placebo</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_52" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_52 }}</option>
                                                                            <option
                                                                                {{ $item->response_52 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_52 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_52 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_52" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_52 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">53</td>
                                                                <td>Impurity standards</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_53 id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_53 }}</option>
                                                                            <option
                                                                                {{ $item->response_53 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_53 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_53 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_53" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_53 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">54</td>
                                                                <td>Status of Old Stocks (for Usage I Destruction)</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_54" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_54 }}</option>
                                                                            <option
                                                                                {{ $item->response_54 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_54 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_54 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_54" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_54 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">55</td>
                                                                <td>Customer/ Contract Giver Approval</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_55" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_55 }}</option>
                                                                            <option
                                                                                {{ $item->response_55 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_55 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_55 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_55" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_55 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">56</td>
                                                                <td>Process Parameters</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_56" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option value="">
                                                                                {{ $item->response_56 }}</option>
                                                                            <option
                                                                                {{ $item->response_56 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_56 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_56 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_56" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_56 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">57</td>
                                                                <td>Training</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_57" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                           
                                                                            <option
                                                                                {{ $item->response_57 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_57 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_57 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_57" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_57 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">58</td>
                                                                <td>GMP / GLP Requirements</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_58" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                           
                                                                            <option
                                                                                {{ $item->response_58 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_58 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_58 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_58" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_58 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">59</td>
                                                                <td>Safety</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_59" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            
                                                                            <option
                                                                                {{ $item->response_59 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_59 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_59 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_59" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_59 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">60</td>
                                                                <td>Annual Maintenance Contract</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_60" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            
                                                                            <option
                                                                                {{ $item->response_60 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_60 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_60 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="60" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_60 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">61</td>
                                                                <td>Service agreement</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_61" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                           
                                                                            <option
                                                                                {{ $item->response_61 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_61 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_61 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_61" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_61 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">62</td>
                                                                <td>Qualification / Re-qualification</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_62" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                        
                                                                            <option
                                                                                {{ $item->response_62 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_62 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_62 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_62" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_62 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">63</td>
                                                                <td>SOP</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_63" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                        
                                                                            <option
                                                                                {{ $item->response_63 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_63 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_63 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_63" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_63 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">64</td>
                                                                <td>STPs</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_64" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                           
                                                                            <option
                                                                                {{ $item->response_64 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_64 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_64 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_64" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_64 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">65</td>
                                                                <td>Responsibilities</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_65" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                   
                                                                            <option
                                                                                {{ $item->response_65 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_65 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_65 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_65" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_65 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">66</td>
                                                                <td>Intimation/ Notification to Regulatory Bodies</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_66" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                           
                                                                            <option
                                                                                {{ $item->response_66 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_66 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_66 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_66" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_66 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">67</td>
                                                                <td>Quality Management System</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_67" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                           
                                                                            <option
                                                                                {{ $item->response_67 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_67 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_67 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_67" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_67 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">68</td>
                                                                <td>Facility and Other Layouts</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_68" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_68 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_68 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_68 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_68" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_68 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">69</td>
                                                                <td>Pharmacopeia Requirements</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_69" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_69 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_69 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_69 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_69" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_69 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">70</td>
                                                                <td>Regulatory Requirements</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_70" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_70 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_70 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_70 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_70" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_70 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">71</td>
                                                                <td>Tech Transfer</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_71" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_71 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_71 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_71 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_71" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_71 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">72</td>
                                                                <td>Man & Material Movement</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_72" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_72 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_72 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_72 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_72" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_72 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">73</td>
                                                                <td>Temperature / RH/ Differential Pressures</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_73" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_73 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_73 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_73 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_73" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_73 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">74</td>
                                                                <td>Temperature Mapping</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_74" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_74 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_74 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_74 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_74" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_74 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">75</td>
                                                                <td>HVAC Validation</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_75" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_75 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_75 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_75 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_75" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_75 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">76</td>
                                                                <td>Status of Existing stock in case of Artwork/ packing
                                                                    material related
                                                                    changes</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_76" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_76 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_76 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_76 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="76" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_76 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">77</td>
                                                                <td>Primary standards</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_77" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_77 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_77 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_77 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}}
                                                                    <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_77" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_77 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">78</td>
                                                                <td>Logbooks</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_78" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_78 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_78 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_78 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_78" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_78 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">79</td>
                                                                <td>Water System Validation</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_79" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_79 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_79 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_79 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_79" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_79 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">80</td>
                                                                <td>Quality Agreements with vendors</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_80" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_80 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_80 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_80 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_80" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_80 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">81</td>
                                                                <td>Mfg. Feasibility</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_81" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_81 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_81 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_81 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_81" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_81 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">82</td>
                                                                <td>Preventive Maintenance</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_82" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_82 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_82 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_82 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_82" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_82 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">83</td>
                                                                <td>Area Nomenclature</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_83" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_83 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_83 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_83 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_83" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_83 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">84</td>
                                                                <td>Calibration</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_84" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select option</option>

                                                                            <option
                                                                                {{ $item->response_84 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_84 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_84 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_84" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_84 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">85</td>
                                                                <td>Qualification document (URS/DQ/IQ/OQ/PQ)</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_85" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_85 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_85 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_85 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_85" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_85 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">86</td>
                                                                <td>Planner for PM</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_86" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_86 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_86 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_86 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="remark_86" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_86 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">87</td>
                                                                <td>Qualified Personnel</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_87" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_87 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_87 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_87 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="87" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_87 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">88</td>
                                                                <td>Master Calibration Planner</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_88" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_88 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_88 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_88 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="88" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_88 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td class="flex text-center">89</td>
                                                                <td>Any other</td>
                                                                <td>
                                                                    <div
                                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                        <select name="response_89" id="response"
                                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                            <option value="0">Select Option</option>

                                                                            <option
                                                                                {{ $item->response_89 == 'Yes' ? 'selected' : '' }}
                                                                                value="Yes">Yes</option>
                                                                            <option
                                                                                {{ $item->response_89 == 'No' ? 'selected' : '' }}
                                                                                value="No">No</option>
                                                                            <option
                                                                                {{ $item->response_89 == 'N/A' ? 'selected' : '' }}
                                                                                value="N/A">N/A</option>
                                                                        </select>
                                                                    </div>


                                                                    {{-- <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                                    <select name="response" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                                        <option value="Yes">{{ $item->response_12 }}</option>
                                                                        <option value="Yes">Yes</option>
                                                                        <option value="No">No</option>
                                                                        <option value="N/A">N/A</option>
                                                                    </select>
                                                                </div> --}}
                                                                </td>
                                                                <td>
                                                                    {{-- <textarea name="who_will_not_be"></textarea> --}} <div
                                                                        style="margin: auto; display: flex; justify-content: center;">
                                                                        <textarea name="89" style="border-radius: 7px; border: 1.5px solid black; black; height:42px;">{{ $item->remark_89 }}</textarea>
                                                                    </div>
                                                                </td>

                                                            </tr>

                                                    </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton"
                                                onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        </div>
                                    </div>
                                </div>


                                {{-- <div id="

                                Form5" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="sub-head">
                                            CFT Information
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Microbiology">CFT Reviewer</label>
                                                    <select name="Microbiology">
                                                        <option value="0">-- Select --</option>
                                                        <option value="yes" selected>Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Microbiology-Person">CFT Reviewer Person</label>
                                                    <select multiple name="Microbiology_Person[]"
                                                        placeholder="Select CFT Reviewers" data-search="false"
                                                        data-silent-initial-value-set="true" id="cft_reviewer">
                                                         <option value="0">-- Select --</option>
                                                        @foreach ($cft as $data1)
                                                            @if (in_array($data1->id, $cft_aff))
                                                                <option value="{{ $data1->id }}" selected>{{ $data1->name }}</option>
                                                            @else
                                                                <option value="{{ $data1->id }}">{{ $data1->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>


                                        </div>
                                        <div class="sub-head">
                                            Concerned Information
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="group_review">Is Concerned Group Review Required?</label>
                                                    <select name="goup_review">
                                                        <option value="0">-- Select --</option>
                                                        <option {{ $info->goup_review == 'yes' ? 'selected' : '' }}
                                                            value="yes">Yes</option>
                                                        <option {{ $info->goup_review == 'no' ? 'selected' : '' }}
                                                            value="no">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Production">Production</label>
                                                    <select name="Production">
                                                        <option value="0">-- Select --</option>
                                                        <option {{ $info->Production == 'yes' ? 'selected' : '' }}
                                                            value="yes">Yes</option>
                                                        <option {{ $info->Production == 'no' ? 'selected' : '' }}
                                                            value="no">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Production-Person">Production Person</label>
                                                    <select name="Production_Person">
                                                        <option value="0">-- Select --</option>
                                                        @foreach ($users as $datas)
                                                            <option
                                                                {{ $info->Production_Person == $datas->id ? 'selected' : '' }}
                                                                value="{{ $datas->id }}">{{ $datas->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Quality-Approver">Quality Approver</label>
                                                    <select name="Quality_Approver">
                                                        <option value="0">-- Select --</option>
                                                        <option {{ $info->Quality_Approver == 'yes' ? 'selected' : '' }}
                                                            value="yes">Yes</option>
                                                        <option {{ $info->Quality_Approver == 'no' ? 'selected' : '' }}
                                                            value="no">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Quality-Approver-Person">Quality Approver Person</label>
                                                    <select name="Quality_Approver_Person">
                                                        <option value="0">-- Select --</option>
                                                        @foreach ($users as $datas)
                                                            <option {{ $info->Quality_Approver_Person == $datas->id ? 'selected' : '' }}
                                                                value="{{ $datas->id }}">{{ $datas->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="bd_domestic">Others</label>
                                                    <select name="bd_domestic">
                                                        <option value="0">-- Select --</option>
                                                        <option {{ $info->bd_domestic == 'yes' ? 'selected' : '' }}
                                                            value="yes">Yes</option>
                                                        <option {{ $info->bd_domestic == 'no' ? 'selected' : '' }}
                                                            value="no">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="bd_domestic-Person">Others Person</label>
                                                    <select name="Bd_Person">
                                                        <option value="0">-- Select --</option>

                                                        @foreach ($users as $datas)
                                                            <option {{ $info->Bd_Person == $datas->id ? 'selected' : '' }}
                                                                value="{{ $datas->id }}">{{ $datas->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="additional_attachments">Additional Attachments</label>
                                                    <div class="file-attachment-field">
                                                        <div class="file-attachment-list" id="additional_attachments">
                                                            @if ($info->additional_attachments)
                                                                @foreach (json_decode($info->additional_attachments) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
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
                                                            <input type="file" id="myfile"
                                                                name="additional_attachments[]"
                                                                oninput="addMultipleFiles(this, 'additional_attachments')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton"
                                                onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        </div>
                                    </div>
                                </div> --}}

                                <div id="CCForm6" class="inner-block cctabcontent">
                                    <div class="inner-block-content">

                                        <div class="sub-head">
                                            Feedback
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="comments">Comments</label>
                                                    <textarea name="cft_comments">{{ $comments->cft_comments }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="group-input">
                                                    <label for="comments">Attachment</label>
                                                    <div class="file-attachment-field">
                                                        <div class="file-attachment-list" id="cft_attchament">
                                                            @if ($comments->cft_attchament)
                                                                @foreach (json_decode($comments->cft_attchament) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
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
                                                            <input type="file" id="myfile"
                                                                name="cft_attchament[]"
                                                                oninput="addMultipleFiles(this, 'cft_attchament')"
                                                                multiple>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="sub-head">
                                                Concerned Feedback
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="comments">QA Comments</label>
                                                    <textarea name="qa_commentss">{{ $comments->qa_commentss }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="comments">QA Head Designee Comments</label>
                                                    <textarea name="designee_comments">{{ $comments->designee_comments }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="comments">Warehouse Comments</label>
                                                    <textarea name="Warehouse_comments">{{ $comments->Warehouse_comments }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="comments">Engineering Comments</label>
                                                    <textarea name="Engineering_comments">{{ $comments->Engineering_comments }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="comments">Instrumentation Comments</label>
                                                    <textarea name="Instrumentation_comments">{{ $comments->Instrumentation_comments }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="comments">Validation Comments</label>
                                                    <textarea name="Validation_comments">{{ $comments->Validation_comments }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="comments">Others Comments</label>
                                                    <textarea name="Others_comments">{{ $comments->Others_comments }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="comments">Comments</label>
                                                    <textarea name="Group_comments">{{ $comments->Group_comments }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="group-attachments">Attachments</label>
                                                    <div class="file-attachment-field">
                                                        <div class="file-attachment-list" id="group_attachments">
                                                            @if ($comments->group_attachments)
                                                                @foreach (json_decode($comments->group_attachments) as $file)
                                                                    <h6 type="button" class="file-container text-dark"
                                                                        style="background-color: rgb(243, 242, 240);">
                                                                        <b>{{ $file }}</b>
                                                                        <a href="{{ asset('upload/' . $file) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye text-primary"
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
                                                            <input type="file" id="myfile"
                                                                name="group_attachments[]"
                                                                oninput="addMultipleFiles(this, 'group_attachments')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton"
                                                onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton"
                                                onclick="nextStep()">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <div id="CCForm7" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="sub-head">
                                            Risk Assessment
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="risk-identification">Risk Identification</label>
                                                    <textarea name="risk_identification">{{ $assessment->risk_identification }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="severity">Severity</label>
                                                    <select name="severity" id="analysisR"
                                                        onchange='calculateRiskAnalysis(this)'>
                                                        <option value="0">-- Select --</option>
                                                        <option {{ $assessment->severity == '1' ? 'selected' : '' }}
                                                            value="1">Negligible</option>
                                                        <option {{ $assessment->severity == '2' ? 'selected' : '' }}
                                                            value="2">Minor</option>
                                                        <option {{ $assessment->severity == '3' ? 'selected' : '' }}
                                                            value="3">Moderate</option>
                                                        <option {{ $assessment->severity == '4' ? 'selected' : '' }}
                                                            value="4">Major</option>
                                                        <option {{ $assessment->severity == '5' ? 'selected' : '' }}
                                                            value="5">Fatel</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Occurance">Occurance</label>
                                                    <select name="Occurance" id="analysisP"
                                                        onchange='calculateRiskAnalysis(this)'>
                                                        <option value="0">-- Select --</option>
                                                        <option {{ $assessment->Occurance == '5' ? 'selected' : '' }}
                                                            value="5">Extremely Unlikely</option>
                                                        <option {{ $assessment->Occurance == '4' ? 'selected' : '' }}
                                                            value="4">Rare</option>
                                                        <option {{ $assessment->Occurance == '3' ? 'selected' : '' }}
                                                            value="3">Unlikely</option>
                                                        <option {{ $assessment->Occurance == '2' ? 'selected' : '' }}
                                                            value="2">Likely</option>
                                                        <option {{ $assessment->Occurance == '1' ? 'selected' : '' }}
                                                            value="1">Very Likely</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Detection">Detection</label>
                                                    <select name="Detection" id="analysisN"
                                                        onchange='calculateRiskAnalysis(this)'>
                                                        <option value="0">-- Select --</option>
                                                        <option {{ $assessment->Detection == '5' ? 'selected' : '' }}
                                                            value="5">Impossible</option>
                                                        <option {{ $assessment->Detection == '4' ? 'selected' : '' }}
                                                            value="4">Rare</option>
                                                        <option {{ $assessment->Detection == '3' ? 'selected' : '' }}
                                                            value="3">Unlikely</option>
                                                        <option {{ $assessment->Detection == '2' ? 'selected' : '' }}
                                                            value="2">Likely</option>
                                                        {{-- <option  {{   $assessment ->Detection=='Very-Likely'? 'selected' : ''}} value="Very-Likely">Very Likely</option> --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="RPN">RPN</label>
                                                    <input type="text" name="RPN" id="analysisRPN"
                                                        value="{{ $assessment->RPN }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="risk-evaluation">Risk Evaluation</label>
                                                    <textarea name="risk_evaluation">{{ $assessment->risk_evaluation }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="migration-action">Migration Action</label>
                                                    <textarea name="migration_action">{{ $assessment->migration_action }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton"
                                                onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton"
                                                onclick="nextStep()">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <div id="CCForm8" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="group-input">
                                            <label for="qa-appro-comments">QA Approval Comments</label>
                                            <textarea name="qa_appro_comments">{{ $approcomments->qa_appro_comments }}</textarea>
                                        </div>
                                        <div class="group-input">
                                            <label for="feedback">Training Feedback</label>
                                            <textarea name="feedback">{{ $approcomments->feedback }}</textarea>
                                        </div>
                                        <div class="group-input">
                                            <label for="tran-attach">Training Attachments</label>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="tran_attach">
                                                    @if ($approcomments->tran_attach)
                                                        @foreach (json_decode($approcomments->tran_attach) as $file)
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
                                                    <input type="file" id="myfile" name="tran_attach[]"
                                                        oninput="addMultipleFiles(this, 'tran_attach')" multiple>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton"
                                                onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton"
                                                onclick="nextStep()">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <div id="CCForm9" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="group-input">
                                            <label for="risk-assessment">
                                                Affected Documents<button type="button" name="ann"
                                                    id="addAffectedDocumentsbtn">+</button>
                                            </label>
                                            <table class="table table-bordered" id="affected-documents">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th>Affected Documents</th>
                                                        <th>Document Name</th>
                                                        <th>Document No.</th>
                                                        <th>Version No.</th>
                                                        <th>Implementation Date</th>
                                                        <th>New Document No.</th>
                                                        <th>New Version No.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (!empty($closure->sno))
                                                        @foreach (unserialize($closure->affected_document) as $key => $datas)
                                                            <tr>
                                                                <td><input type="text" name="serial_number[]"
                                                                        value="{{ $key ? $key + 1 : '1' }}"></td>
                                                                <td><input type="text" name="affected_documents[]"
                                                                        value="{{ unserialize($closure->affected_document)[$key] ? unserialize($closure->affected_document)[$key] : 'Not Applicable' }}">
                                                                </td>
                                                                <td><input type="text" name="document_name[]"
                                                                        value="{{ unserialize($closure->doc_name)[$key] ? unserialize($closure->doc_name)[$key] : 'Not Applicale' }}">
                                                                </td>
                                                                <td>
                                                                    <input type="number" name="document_no[]"
                                                                        value="{{ unserialize($closure->doc_no)[$key] ? unserialize($closure->doc_no)[$key] : 'Not Applicable' }}">
                                                                </td>
                                                                <td>
                                                                    @if (!empty($closure->version_no))
                                                                        <input type="text" name="version_no[]"
                                                                            value="{{ unserialize($closure->version_no)[$key] ? unserialize($closure->version_no)[$key] : 'Not Applicable' }}">
                                                                    @else
                                                                        <input type="text" name="version_no[]"
                                                                            value="Not Applicable">
                                                                    @endif
                                                                </td>

                                                                <td>
                                                                    <div class="group-input new-date-data-field ">
                                                                        <div class="  input-date  ">
                                                                            <div class="calenderauditee">
                                                                                {{-- <input type="text"  id="implementation_date{{$key}}" readonly placeholder="DD-MMM-YYYY"  value="{{  Helpers::getdateFormat(unserialize($closure->implementation_date)[$key]) ? Helpers::getdateFormat(unserialize($closure->implementation_date)[$key]) : 'Not Applicable' }}"/> --}}
                                                                                {{-- <input type="date" class="hide-input" name="implementation_date[]"  value="{{ Helpers::getdateFormat(unserialize($closure->implementation_date)[$key]) ? Helpers::getdateFormat(unserialize($closure->implementation_date)[$key]) : 'Not Applicable' }}"  oninput="handleDateInput(this, `implementation_date{{$key}}`)" /> --}}
                                                                                <input type="text"
                                                                                    id="implementation_date{{ $key }}"
                                                                                    {{ $data->stage == 0 || $data->stage == 3 ? 'disabled' : '' }}
                                                                                    readonly placeholder="DD-MMM-YYYY"
                                                                                    value="{{ Helpers::getdateFormat(unserialize($closure->implementation_date)[$key]) }}" />
                                                                                <input type="date"
                                                                                    id="implementation_date{{ $key }}"
                                                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                                    value="{{ unserialize($closure->implementation_date)[$key] }}"
                                                                                    name="implementation_date[]"
                                                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                                    value="{{ Helpers::getdateFormat(unserialize($closure->implementation_date)[$key]) }}"class="hide-input"
                                                                                    oninput="handleDateInput(this, `implementation_date{{ $key }}`)" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                        </div>
                                    </div>
                                </div>
                                </td>

                                <td><input type="text" name="new_document_no[]"
                                        value="{{ unserialize($closure->new_doc_no)[$key] ? unserialize($closure->new_doc_no)[$key] : 'Not Applicable' }}">
                                </td>
                                <td><input type="text" name="new_version_no[]"
                                        value="{{ unserialize($closure->new_version_no)[$key] ? unserialize($closure->new_version_no)[$key] : 'Not Applicable' }}">
                                </td>
                                </tr>
                                @endforeach
                                @endif
                                <div id="docdetaildiv"></div>
                                </tbody>
                                </table>
                            </div>
                            <div class="group-input">
                                <label for="qa-closure-comments">QA Closure Comments</label>
                                <textarea name="qa_closure_comments">{{ $closure->qa_closure_comments }}</textarea>
                            </div>
                            <div class="group-input">
                                <label for="attach-list">List Of Attachments</label>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="tran_attach">
                                        @if ($closure->attach_list)
                                            @foreach (json_decode($closure->attach_list) as $file)
                                                <h6 type="button" class="file-container text-dark"
                                                    style="background-color: rgb(243, 242, 240);">
                                                    <b>{{ $file }}</b>
                                                    <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                            class="fa fa-eye text-primary"
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
                                        <input type="file" id="myfile" name="attach_list[]"
                                            oninput="addMultipleFiles(this, 'attach_list')" multiple>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="sub-head">
                                                    Effectiveness Check Information
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="group-input">
                                                            <label for="effective-check">Effectivess Check Required?</label>
                                                            <select name="effective_check">
                                                                <option value="0">-- Select --</option>
                                                                <option {{ $closure->effective_check == 'yes' ? 'selected' : '' }}
                                                                    value="yes">Yes</option>
                                                                <option {{ $closure->effective_check == 'no' ? 'selected' : '' }}
                                                                    value="no">No</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 new-date-data-field">
                                                        <div class="group-input input-date">
                                                            <label for="effective-check-date">Effectiveness Check Creation Date</label>
                                                           <div class="calenderauditee">
                                                                  <input type="text"  id="effective_check_date"  readonly value="{{ Helpers::getdateFormat($data->effective_check_date) }}"
                                                                   name="effective_check_date"  placeholder="DD-MMM-YYYY" />
                                                                  <input type="date" name="effective_check_date" value="{{ $data->effective_check_date }}"  class="hide-input"
                                                                   oninput="handleDateInput(this, 'effective_check_date')"/>
                                                     </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="group-input">
                                                            <label for="Effectiveness_checker">Effectiveness Checker</label>
                                                            <select name="Effectiveness_checker">
                                                                <option value="0">Enter Your Selection Here</option>
                                                                @foreach ($users as $datas)
    <option {{ $info->Effectiveness_checker == $datas->id ? 'selected' : '' }}
                                                                         value="{{ $datas->id }}">{{ $datas->name }}
                                                                    </option>
    @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="group-input">
                                                            <label for="effective_check_plan">Effectiveness Check Plan</label>
                                                            <textarea name="effective_check_plan">{{ $data->effective_check_plan }}</textarea>
                                                        </div>
                                                    </div> -->
                            <div class="col-12 sub-head">
                                Extension Justification
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="due_date_extension">Due Date Extension
                                        Justification</label>
                                    <textarea name="due_date_extension"> {{ $due_date_extension }}</textarea>
                                </div>
                            </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                    </div>
                </div>
            </div>

            @php
                $product = DB::table('products')->get();
                $material = DB::table('materials')->get();
            @endphp

            <div id="CCForm10" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Electronic Signatures
                    </div>
                    <div class="row">
                        @if ($data->stage >= 2)
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted">Submitted By</label>
                                    @php
                                        $submit = DB::table('c_c_stage_histories')
                                            ->where('type', 'Change-Control')
                                            ->where('doc_id', $data->id)
                                            ->where('stage_id', 2)
                                            ->get();
                                    @endphp
                                    @foreach ($submit as $temp)
                                        <div class="static">{{ $temp->user_name }}</div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted">Submitted On</label>
                                    @php
                                        $submit = DB::table('c_c_stage_histories')
                                            ->where('type', 'Change-Control')
                                            ->where('doc_id', $data->id)
                                            ->where('stage_id', 2)
                                            ->get();
                                    @endphp
                                    @foreach ($submit as $temp)
                                        <div class="static">{{ $temp->created_at }}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if ($data->stage == 0)
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted">Cancelled By</label>
                                    @php
                                        $submit = DB::table('c_c_stage_histories')
                                            ->where('type', 'Change-Control')
                                            ->where('doc_id', $cc_lid)
                                            ->where('stage_id', 0)
                                            ->get();
                                    @endphp
                                    @foreach ($submit as $temp)
                                        <div class="static">{{ $temp->user_name }}</div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="submitted">Cancelled On</label>
                                    @php
                                        $submit = DB::table('c_c_stage_histories')
                                            ->where('type', 'Change-Control')
                                            ->where('doc_id', $cc_lid)
                                            ->where('stage_id', 0)
                                            ->get();
                                    @endphp
                                    @foreach ($submit as $temp)
                                        <div class="static">{{ $temp->created_at }}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        {{-- <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="submitted">More Information Required By</label>
                                                    @php
                                                        $submit = DB::table('c_c_stage_histories')
                                                            ->where('type', 'Change-Control')
                                                            ->where('doc_id', $cc_lid)
                                                            ->where('status', 'More-info Required')
                                                            ->get();
                                                    @endphp
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->user_name }}</div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="submitted">More Information Required On</label>
                                                    @php
                                                        $submit = DB::table('c_c_stage_histories')
                                                            ->where('type', 'Change-Control')
                                                            ->where('doc_id', $cc_lid)
                                                            ->where('status', 'More-info Required')
                                                            ->get();
                                                    @endphp
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                </div>
                                            </div> --}}

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="submitted">HOD Review Complete By</label>
                                @php
                                    $submit = DB::table('c_c_stage_histories')
                                        ->where('type', 'Change-Control')
                                        ->where('doc_id', $cc_lid)
                                        ->where('stage_id', 3)
                                        ->get();
                                @endphp
                                @foreach ($submit as $temp)
                                    <div class="static">{{ $temp->user_name }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="submitted">HOD Review Complete On</label>
                                @php
                                    $submit = DB::table('c_c_stage_histories')
                                        ->where('type', 'Change-Control')
                                        ->where('doc_id', $cc_lid)
                                        ->where('stage_id', 3)
                                        ->get();
                                @endphp
                                @foreach ($submit as $temp)
                                    <div class="static">{{ $temp->created_at }}</div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="submitted">Send to CFT/SME/QA Review By</label>
                                @php
                                    $submit = DB::table('c_c_stage_histories')
                                        ->where('type', 'Change-Control')
                                        ->where('doc_id', $cc_lid)
                                        ->where('stage_id', 4)
                                        ->get();
                                @endphp
                                @foreach ($submit as $temp)
                                    <div class="static">{{ $temp->user_name }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="submitted">Send to CFT/SME/QA Review On</label>
                                @php
                                    $submit = DB::table('c_c_stage_histories')
                                        ->where('type', 'Change-Control')
                                        ->where('doc_id', $cc_lid)
                                        ->where('stage_id', 4)
                                        ->get();
                                @endphp
                                @foreach ($submit as $temp)
                                    <div class="static">{{ $temp->created_at }}</div>
                                @endforeach
                            </div>
                        </div>

                        {{-- <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="submitted">CFT Reviewed By</label>
                                                    @php
                                                        $submit = DB::table('c_c_stage_histories')
                                                            ->where('type', 'Change-Control')
                                                            ->where('doc_id', $cc_lid)
                                                            ->where('stage_id', 5)
                                                            ->get();
                                                    @endphp
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->user_name }}</div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="submitted">CFT Reviewed On</label>
                                                    @php
                                                        $submit = DB::table('c_c_stage_histories')
                                                            ->where('type', 'Change-Control')
                                                            ->where('doc_id', $cc_lid)
                                                            ->where('stage_id', 5)
                                                            ->get();
                                                    @endphp
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                </div>
                                            </div> --}}


                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="submitted">CFT/SME/QA Review Not required By</label>
                                @php
                                    $submit = DB::table('c_c_stage_histories')
                                        ->where('type', 'Change-Control')
                                        ->where('doc_id', $cc_lid)
                                        ->where('stage_id', 6)
                                        ->get();
                                @endphp
                                @foreach ($submit as $temp)
                                    <div class="static">{{ $temp->user_name }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="submitted">CFT/SME/QA Review Not required On</label>
                                @php
                                    $submit = DB::table('c_c_stage_histories')
                                        ->where('type', 'Change-Control')
                                        ->where('doc_id', $cc_lid)
                                        ->where('stage_id', 6)
                                        ->get();
                                @endphp
                                @foreach ($submit as $temp)
                                    <div class="static">{{ $temp->created_at }}</div>
                                @endforeach
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="submitted">Review Completed By</label>
                                @php
                                    $submit = DB::table('c_c_stage_histories')
                                        ->where('type', 'Change-Control')
                                        ->where('doc_id', $cc_lid)
                                        ->where('stage_id', 7)
                                        ->get();
                                @endphp
                                @foreach ($submit as $temp)
                                    <div class="static">{{ $temp->user_name }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="submitted">Review Completed On</label>
                                @php
                                    $submit = DB::table('c_c_stage_histories')
                                        ->where('type', 'Change-Control')
                                        ->where('doc_id', $cc_lid)
                                        ->where('stage_id', 7)
                                        ->get();
                                @endphp
                                @foreach ($submit as $temp)
                                    <div class="static">{{ $temp->created_at }}</div>
                                @endforeach
                            </div>
                        </div>


                        {{-- <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="submitted">Change Implemented By</label>
                                                    @php
                                                        $submit = DB::table('c_c_stage_histories')
                                                            ->where('type', 'Change-Control')
                                                            ->where('doc_id', $cc_lid)
                                                            ->where('stage_id', 8)
                                                            ->get();
                                                    @endphp
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->user_name }}</div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="submitted">Change Implemented On</label>
                                                    @php
                                                        $submit = DB::table('c_c_stage_histories')
                                                            ->where('type', 'Change-Control')
                                                            ->where('doc_id', $cc_lid)
                                                            ->where('stage_id', 8)
                                                            ->get();
                                                    @endphp
                                                    @foreach ($submit as $temp)
                                                        <div class="static">{{ $temp->created_at }}</div>
                                                    @endforeach
                                                </div>
                                            </div> --}}
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="submitted">Implemented By</label>
                                @php
                                    $submit = DB::table('c_c_stage_histories')
                                        ->where('type', 'Change-Control')
                                        ->where('doc_id', $cc_lid)
                                        ->where('stage_id', 9)
                                        ->get();
                                @endphp
                                @foreach ($submit as $temp)
                                    <div class="static">{{ $temp->user_name }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="submitted">Implemented On</label>
                                @php
                                    $submit = DB::table('c_c_stage_histories')
                                        ->where('type', 'Change-Control')
                                        ->where('doc_id', $cc_lid)
                                        ->where('stage_id', 9)
                                        ->get();
                                @endphp
                                @foreach ($submit as $temp)
                                    <div class="static">{{ $temp->created_at }}</div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <div class="button-block">
                        <button type="submit" class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="submit">Submit</button>
                    </div>
                </div>
            </div>

        </div>
        </form>
    </div>
    </div>

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
                <form action="{{ route('extension_child', $cc_lid) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">

                            <!-- <label for="major">
                                        <input type="radio" name="child_type" value="extension">
                                        Extension
                                        <input type="hidden" name="parent_name" value="Change_control">
                                        <input type="hidden" name="due_date" value="{{ $data->due_date }}">
                                    </label> -->
                            <label for="major">
                                <input type="radio" name="child_type" value="documents">
                                New Document
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


    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('rcms/send-cc', $cc_lid) }}" method="POST">
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
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        {{-- <button>Close</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="division-modal" class="d-none">
        <div class="division-container">
            <div class="content-container">
                <form action="{{ route('division_submit') }}" method="post">
                    @csrf
                    <div class="division-tabs">
                        <div class="tab">
                            @php
                                $division = DB::table('divisions')->get();
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
                    <h4 class="modal-title">Child</h4>
                </div>
                <form action="{{ url('rcms/child', $cc_lid) }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="group-input">
                            <label for="major">
                                <input type="radio" name="revision" id="major" value="Action-Item">
                                Action Item
                            </label>
                            @if ($data->stage == 10)
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Extension">
                                    Extension
                                </label>
                            @elseif($data->stage == 7)
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="New Document">
                                    New Document
                                </label>
                            @endif
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

    <div class="modal fade" id="rejection-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-rejection-field', $cc_lid) }}" method="POST">
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
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        {{-- <button>Close</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cft-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-cft-field', $cc_lid) }}" method="POST">
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
                            <input type="comment" name="comment">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        {{-- <button>Close</button> --}}
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

                <form action="{{ url('rcms/send-cancel', $cc_lid) }}" method="POST">
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
                            <input type="comment" name="comment">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                        {{-- <button>Close</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>


    <style>
        #productTable,
        #materialTable {
            display: none;
        }
    </style>


    <script>
        VirtualSelect.init({
            ele: '#related_records, #cft_reviewer'
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

    <script>
        $(document).ready(function() {
            $('#add-input').click(function() {
                var lastInput = $('.bar input:last');
                var newInput = $('<input type="text" name="review_comment">');
                lastInput.after(newInput);
            });
        });
    </script>

    <!-- Example Blade View -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    @if (session()->has('errorMessages'))
        <script>
            // Create an array to hold all the error messages
            var errorMessages = @json(session()->get('errorMessages'));

            if (!Array.isArray(errorMessages)) {
                errorMessages = [errorMessages];
            }

            errorMessages = errorMessages.map(function(message) {
                return '<div class="seperator">==================================================</div>' +
                    '<div class="slogan"><div>This form was not submitted because of the following errors.</div><div>Please correct the errors and re-submit.</div></div>' +
                    '<div class="data">This Activity cannot be performed, as there are some blank required fields.</div>' +
                    '<div class="message">' + message + '</div>';
            });

            Swal.fire({
                icon: '',
                title: 'Connexo DMS Says',
                html: errorMessages.join(''),

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
            var disableInputs = {{ $data->stage }}; // Replace with your condition

            if (disableInputs == 0 || disableInputs > 8) {
                // Disable all input fields within the form
                $('#CCFormInput :input:not(select)').prop('disabled', true);
                $('#CCFormInput select').prop('disabled', true);
            } else {
                // $('#CCFormInput :input').prop('disabled', false);
            }
        });
    </script>
    <script>
        const productSelect = document.getElementById('productSelect');
        const productTable = document.getElementById('productTable');
        const materialSelect = document.getElementById('materialSelect');
        const materialTable = document.getElementById('materialTable');

        materialSelect.addEventListener('change', function() {
            if (materialSelect.value === 'yes') {
                materialTable.style.display = 'block';
            } else {
                materialTable.style.display = 'none';
            }
        });

        productSelect.addEventListener('change', function() {
            if (productSelect.value === 'yes') {
                productTable.style.display = 'block';
            } else {
                productTable.style.display = 'none';
            }
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
        function calculateRiskAnalysis(selectElement) {
            // Get the row containing the changed select element
            let row = selectElement.closest('tr');

            // Get values from select elements within the row
            let R = parseFloat(document.getElementById('analysisR').value) || 0;
            let P = parseFloat(document.getElementById('analysisP').value) || 0;
            let N = parseFloat(document.getElementById('analysisN').value) || 0;

            // Perform the calculation
            let result = R * P * N;

            // Update the result field within the row
            document.getElementById('analysisRPN').value = result;
        }
    </script>
    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>
@endsection
