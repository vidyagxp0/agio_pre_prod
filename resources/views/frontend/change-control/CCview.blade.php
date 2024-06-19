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
  

    <script>
        $(document).ready(function() {
            let affectedDocumentDetailIndex = {{ $affetctedDocumnetGrid && is_array($affetctedDocumnetGrid) ? count($affetctedDocumnetGrid) : 1 }};
            $('#addAffectedDoc').click(function(e) {
                function generateTableRow(serialNumber) {
                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                        ' <td><input type="text" name="affectedDocuments[' + affectedDocumentDetailIndex + '][afftectedDoc]"></td>' +
                        ' <td><input type="text" name="affectedDocuments[' + affectedDocumentDetailIndex + '][documentName]"></td>' +
                        '<td><input type="number" name="affectedDocuments[' + affectedDocumentDetailIndex + '][documentNumber]"></td>' +
                        '<td><input type="text" name="affectedDocuments[' + affectedDocumentDetailIndex + '][versionNumber]"></td>' +
                        ' <td><input type="date" name="affectedDocuments[' + affectedDocumentDetailIndex + '][implimentationDate]"></td>' +
                        '<td><input type="text" name="affectedDocuments[' + affectedDocumentDetailIndex + '][newDocumentNumber]"></td>' +
                        '<td><input type="text" name="affectedDocuments[' + affectedDocumentDetailIndex + '][newVersionNumber]"></td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +

                        '</tr>';
                    '</tr>';
                    affectedDocumentDetailIndex++;
                    return html;
                }

                var tableBody = $('#afftectedDocTable tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>
    <div id="rcms_form-head">
        <div class="container-fluid">
            <div class="inner-block">


                <div class="slogan">
                    @php 
                        $name = DB::table('q_m_s_divisions')->where('id', $data->id)->value('name');
                    @endphp
                    <strong>Site Division / Project </strong>:
                    {{$division->name}} / Change Control
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
                                Submit
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                HOD Review Complete
                            </button>
                        @elseif($data->stage == 3 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#send-cft-from-QA-modal">
                                QA Initial Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cft-modal">
                                CFT Review Not Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                RA Review Required
                            </button>
                        @elseif($data->stage == 4 && (in_array(18, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                RA Review Complete
                            </button>
                        @elseif($data->stage == 5 && (in_array(5, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                CFT Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                        @elseif($data->stage == 6 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#opened-state-modal">
                                Send to Initiator
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#hod-modal">
                                Send to HOD
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#initalQA-review-modal">
                                Send to QA Initial Review
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA Final Review Complete
                            </button>
                        @elseif($data->stage == 7 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Pre-Approved
                            </button>
                        @elseif($data->stage == 8 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approved
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
                    @else
                        <div class="progress-bars">
                            @if ($data->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif
                            @if ($data->stage >= 2)
                                <div class="active">HOD Review</div>
                            @else
                                <div class="">HOD Review</div>
                            @endif
                            @if ($data->stage >= 3)
                                <div class="active">QA Initial Review</div>
                            @else
                                <div class="">QA Initial Review</div>
                            @endif
                            @if ($data->stage >= 4)
                                <div class="active">Pending RA Review</div>
                            @else
                                <div class="">Pending RA Review</div>
                            @endif
                            @if ($data->stage >= 5)
                                <div class="active">CFT Review</div>
                            @else
                                <div class="">CFT Review</div>
                            @endif
                            @if ($data->stage >= 6)
                                <div class="active">QA Final Review</div>
                            @else
                                <div class="">QA Final Review</div>
                            @endif
                            @if ($data->stage >= 7)
                                <div class="active">QA Head/Manager Designee Pre-Approval</div>
                            @else
                                <div class="">QA Head/Manager Designee Pre-Approval</div>
                            @endif
                            @if ($data->stage >= 8)
                                <div class="active">QA Head/Manager Designee Approval</div>
                            @else
                                <div class="">QA Head/Manager Designee Approval</div>
                            @endif
                            @if ($data->stage >= 9)
                                <div class="bg-danger">Closed - Done</div>
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
                            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm7')" style="display: none" id="riskAssessmentButton">Risk Assessment</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Change Details</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm13')" style="display: {{ $data->hod_person == Auth::user()->id ? 'inline' : 'none' }}">HOD Review</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">QA Review</button>
                            <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm12')">RA Comment</button> -->
                            <button class="cctablinks" onclick="openCity(event, 'CCForm11')">CFT</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Evaluation</button>
                            <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Impact Assessment</button>
                            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Comments</button> -->
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
                                                        @if($data->stage >= 3)
                                                            <input disabled type="text" value=" {{ Helpers::getDivisionName($data->division_id) }}/CC/{{ date('Y') }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}">
                                                        @else
                                                            <input type="text" placeholder="Record Number" readonly >
                                                        @endif
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
                                                            value="{{ Helpers::getInitiatorName($data->initiator_id) }}"></div>
                                                </div>
                                            </div>

                                            @php
                                                // Calculate the due date (30 days from the initiation date)
                                                $initiationDate = date('Y-m-d'); // Current date as initiation date
                                                $dueDate = date('Y-m-d', strtotime($initiationDate . ' + ' . $data->due_days . ' days')); // Due date
                                            @endphp
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="date_initiation">Date of Initiation</label>
                                                    <div class="static"><input disabled type="text"
                                                            value="{{ date('d-M-Y') }}"></div>
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-6">
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
                                            </div> -->

                                            
                                            <div class="col-md-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="due-date">Due Date <span class="text-danger"></span></label>
                                                    <div class="calenderauditee">
                                                        @if($data->stage >= 3 || $data->stage >= 6)
                                                            <input type="text" id="due_date" readonly placeholder="DD-MM-YYYY" />
                                                            <input type="date" name="due_date" readonly
                                                                min="{{ \Carbon\Carbon::now()->format('d-M-Y') }}" class="hide-input"
                                                                oninput="handleDateInput(this, 'due_date')" />
                                                        @else
                                                            <input type="text" placeholder="Due Date" readonly>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                // Format the due date to DD-MM-YYYY
                                                // Your input date
                                                var dueDate = "{{ $dueDate }}"; // Replace {{ $dueDate }} with your actual date variable

                                                // Create a Date object
                                                var date = new Date(dueDate);

                                                // Array of month names
                                                var monthNames = [
                                                    "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                                                ];

                                                // Extracting day, month, and year from the date
                                                var day = date.getDate().toString().padStart(2, '0'); // Ensuring two digits
                                                var monthIndex = date.getMonth();
                                                var year = date.getFullYear();

                                                // Formatting the date in "dd-MMM-yyyy" format
                                                var dueDateFormatted = `${day}-${monthNames[monthIndex]}-${year}`;

                                                // Set the formatted due date value to the input field
                                                document.getElementById('due_date').value = dueDateFormatted;
                                            </script>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="initiator-group">Initiation Department</label>
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
                                                    <label for="Initiation Group Code">Initiation Department Code</label>
                                                    <input type="text" name="initiator_group_code"
                                                        value="{{ $data->Initiator_Group }}" id="initiator_group_code"
                                                        readonly>
                                                    {{-- <div class="default-name"> <span
                                                    id="initiator_group_code">{{ $data->Initiator_Group }}</span></div> --}}
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    function toggleRiskAssessmentButton() {
                                                        var riskAssessmentRequired = $('#risk_assessment_required').val();
                                                        if (riskAssessmentRequired === 'yes') {
                                                            $('#riskAssessmentButton').show();
                                                        } else {
                                                            $('#riskAssessmentButton').hide();
                                                        }
                                                    }
                                                    toggleRiskAssessmentButton();

                                                    // Call the function on dropdown change
                                                    $('#risk_assessment_required').change(function() {
                                                        toggleRiskAssessmentButton();
                                                    });
                                                });
                                            </script>

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Risk Assessment Required">Risk Assessment Required? </label>
                                                    <select name="risk_assessment_required" id="risk_assessment_required">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data->risk_assessment_required == 'yes') selected @endif value='yes'>Yes</option>
                                                        <option @if ($data->risk_assessment_required == 'no') selected @endif value='no'>No</option>
                                                    </select>
                                                    <!-- @error('capa_required')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror -->
                                                </div>
                                            </div>

                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 4,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get();
                                            @endphp

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="hod_person">HOD Person</label>
                                                    <select name="hod_person" id="hod_person" >
                                                        <option value="">Select HOD Persion</option>
                                                        @if($users)
                                                            @foreach($users as $user)
                                                                <option value="{{ $user->id }}" @if ($user->id == $data->hod_person) selected @endif>{{ $user->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
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

                                            <!-- <div class="col-md-6">
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
                                            </div> -->
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
                                            <!-- <div class="col-12">
                                                <div class="group-input">
                                                    <label for="supervisor_comment">
                                                        Supervisor Comments
                                                    </label>
                                                    <textarea name="supervisor_comment">{{ $docdetail->supervisor_comment }}</textarea>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton"
                                                onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        </div>
                                    </div>
                                </div>

                                <div id="CCForm13" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if ($data->stage == 2)
                                                    <div class="group-input">
                                                        <label for="HOD Remarks">HOD Remarks</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="HOD_Remarks" id="summernote-4" required>{{ $data->HOD_Remarks }}</textarea>
                                                    </div>
                                                @else
                                                    <div class="group-input">
                                                        <label for="HOD Remarks">HOD Remarks</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea readonly class="tiny" name="HOD_Remarks" id="summernote-4">{{ $data->HOD_Remarks }}</textarea>
                                                    </div>
                                                @endif
                                                @error('HOD_Remarks')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                @if ($data->stage == 2)
                                                    <div class="group-input">
                                                        <label for="Inv Attachments">HOD Attachments</label>
                                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                                documents</small></div>
                                                        <div class="file-attachment-field">
                                                            <div disabled class="file-attachment-list" id="HOD_attachment">
                                                                @if ($data->HOD_attachment)
                                                                    @foreach (json_decode($data->HOD_attachment) as $file)
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
                                                                <input
                                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                    type="file" id="HOD_attachment"
                                                                    name="HOD_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                    oninput="addMultipleFiles(this, 'HOD_attachment')" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="group-input">
                                                        <label for="Inv Attachments">HOD Attachments</label>
                                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                                documents</small></div>
                                                        <div class="file-attachment-field">
                                                            <div disabled class="file-attachment-list" id="HOD_attachment">
                                                                @if ($data->HOD_attachment)
                                                                    @foreach (json_decode($data->HOD_attachment) as $file)
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
                                                                <input disabled
                                                                    {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                                    type="file" id="HOD_attachment"
                                                                    name="HOD_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                    oninput="addMultipleFiles(this, 'HOD_attachment')" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                            <script>
                                                $(document).ready(function() {
                                                    // Event listener for the remove file button
                                                    $(document).on('click', '.remove-file', function() {
                                                        $(this).closest('.file-container').remove();
                                                    });
                                                });
                                            </script>


                                        </div>
                                        <div class="button-block">

                                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }}
                                                class="saveButton saveAuditFormBtn d-flex" style="align-items: center;"
                                                id="ChangesaveButton02">
                                                <div class="spinner-border spinner-border-sm auditFormSpinner"
                                                    style="display: none" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Save
                                            </button>
                                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                class="nextButton" onclick="nextStep()">Next</button>
                                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a href="{{ url('rcms/qms-dashboard') }}"
                                                    class="text-white"> Exit </a>
                                                </button>
                                        </div>
                                    </div>
                                </div>

                                <div id="CCForm3" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">
                                            <!-- <div class="col-lg-12">
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



                                            </div> -->

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Microbiology-Person">CFT Reviewer Person</label>
                                                    <select multiple name="Microbiology_Person[]"
                                                        placeholder="Select CFT Reviewers" data-search="false"
                                                        data-silent-initial-value-set="true" id="cft_reviewer">
                                                        <option value="">-- Select --</option>
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

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="due_days"> Due Days </label>
                                                    <input type="number" name="due_days" id="due_days" value="{{ $data->due_days }}" >
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="severity-level">Severity Level</label>
                                                    <span class="text-primary">Severity levels in a QMS record gauge issue
                                                        seriousness, guiding priority for corrective actions. Ranging from
                                                        low to high, they ensure quality standards and mitigate critical
                                                        risks.</span>
                                                    <select name="severity_level1">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data->severity_level1 == 'minor') selected @endif
                                                            value="minor">Minor</option>
                                                        <option @if ($data->severity_level1 == 'major') selected @endif
                                                            value="major">Major</option>
                                                        <option @if ($data->severity_level1 == 'critical') selected @endif
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
                                                    <select {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        multiple id="related_records" name="related_records[]"
                                                        placeholder="Select Reference Records" data-search="false"
                                                        data-silent-initial-value-set="true">
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
                                        <!-- <div class="sub-head">
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
                                        </div> -->
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton"
                                                onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                        </div>
                                    </div>
                                </div>


                                <div id="CCForm7" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="sub-head">
                                            Risk Assessment
                                        </div>

                                        <div class="col-12">
                                            <div class="group-input">
                                                <label for="risk_assessment_related_record">Related Records</label>
                                                <select  multiple id="risk_assessment_related_record" name="risk_assessment_related_record[]" placeholder="Select Reference Records" 
                                                        data-search="false" data-silent-initial-value-set="true">
                                                    @foreach ($preRiskAssessment as $prix)
                                                        <option value="{{ $prix->id }}"
                                                            {{ in_array($prix->id, explode(',', $data->risk_assessment_related_record)) ? 'selected' : '' }}>
                                                            {{ Helpers::getDivisionName($prix->division_id) }}/Risk-Assessment/{{ Helpers::year($prix->created_at) }}/{{ Helpers::record($prix->record) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
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
                                                    <label for="migration-action">Mitigation Action</label>
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
                                                    id="addAffectedDoc">+</button>
                                            </label>
                                            <table class="table table-bordered" id="afftectedDocTable">
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
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                        @if ($affetctedDocumnetGrid && is_array($affetctedDocumnetGrid))
                                                            @foreach ($affetctedDocumnetGrid as $gridData)
                                                            <tr>
                                                                <td>
                                                                    <input disabled type="text" name="affectedDocuments[{{ $loop->index }}][serial]"
                                                                        value="{{ $loop->index + 1 }}">
                                                                </td>
                                                                <td>
                                                                    <input class="afftectedDoc" type="text" name="affectedDocuments[{{ $loop->index }}][afftectedDoc]"
                                                                        value="{{ isset($gridData['afftectedDoc']) ? $gridData['afftectedDoc'] : '' }}">
                                                                </td>
                                                                <td>
                                                                    <input class="documentName" type="text" name="affectedDocuments[{{ $loop->index }}][documentName]"
                                                                        value="{{ isset($gridData['documentName']) ? $gridData['documentName'] : '' }}">
                                                                </td>
                                                                <td>
                                                                    <input class="documentNumber" type="number" name="affectedDocuments[{{ $loop->index }}][documentNumber]"
                                                                        value="{{ isset($gridData['documentNumber']) ? $gridData['documentNumber'] : '' }}">
                                                                </td>
                                                                <td>
                                                                    <input class="versionNumber" type="text" name="affectedDocuments[{{ $loop->index }}][versionNumber]"
                                                                        value="{{ isset($gridData['versionNumber']) ? $gridData['versionNumber'] : '' }}">
                                                                </td>
                                                                <td>
                                                                    <input class="implimentationDate" type="date"
                                                                        name="affectedDocuments[{{ $loop->index }}][implimentationDate]"
                                                                        value="{{ isset($gridData['implimentationDate']) ? $gridData['implimentationDate'] : '' }}">
                                                                </td>
                                                                <td>
                                                                    <input class="newDocumentNumber" type="text"
                                                                        name="affectedDocuments[{{ $loop->index }}][newDocumentNumber]"
                                                                        value="{{ isset($gridData['newDocumentNumber']) ? $gridData['newDocumentNumber'] : '' }}">
                                                                </td>
                                                                <td>
                                                                    <input class="newVersionNumber" type="text" name="affectedDocuments[{{ $loop->index }}][newVersionNumber]"
                                                                        value="{{ isset($gridData['newVersionNumber']) ? $gridData['newVersionNumber'] : '' }}">
                                                                </td>
                                                                <td><input type="text" class="Removebtn" name="Action[]" readonly></td>
                                                            </tr>
                                                        @endforeach
                                                        @else                                                        
                                                            <td><input type="text" name="affectedDocuments[0][serial]" value="1" readonly></td>
                                                            <td><input type="text" name="affectedDocuments[0][afftectedDoc]"></td>
                                                            <td><input type="text" name="affectedDocuments[0][documentName]"></td>
                                                            <td><input type="number" name="affectedDocuments[0][documentNumber]"></td>
                                                            <td><input type="text" name="affectedDocuments[0][versionNumber]"></td>
                                                            <td><input type="date" name="affectedDocuments[0][implimentationDate]"></td>
                                                            <td><input type="text" name="affectedDocuments[0][newDocumentNumber]"></td>
                                                            <td><input type="text" name="affectedDocuments[0][newVersionNumber]"></td>
                                                            <td><input type="text" class="Action" name="" readonly></td>
                                                    @endif
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
                        <div class="sub-head">Submission</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="submit by">Submit By :-</label>
                                <div class="static">{{ $data->submit_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="submit on">Submit On :-</label>
                                <div class="static">{{ $data->submit_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px;">
                                <label for="submit comment">Submit Comments :-</label>
                                <div class="">{{ $data->submit_comment }}</div>
                            </div>
                        </div>

                        <div class="sub-head">HOD Review Completed</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete By">HOD Review Complete By :-</label>
                                <div class="static">{{ $data->hod_review_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete On">HOD Review Complete On :-</label>
                                <div class="static">{{ $data->hod_review_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style=" ">
                                <label for="HOD Review Comments">HOD Review Comments :-</label>
                                <div class="">{{ $data->hod_review_comment }}</div>
                            </div>
                        </div>

                        <div class="sub-head">Sent to Initiator (From HOD)</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete By">Initiator Complete By :-</label>
                                <div class="static">{{ $data->hod_to_initiator_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete On">Initiator Complete On :-</label>
                                <div class="static">{{ $data->hod_to_initiator_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style=" ">
                                <label for="HOD Review Comments">Initiator Comments :-</label>
                                <div class="">{{ $data->hod_to_initiator_comment }}</div>
                            </div>
                        </div>


                        <div class="sub-head">QA Initial Review Completed</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Initial Review Complete By">QA Initial Review Complete By :-</label>
                                <div class="static">{{ $data->QA_initial_review_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Initial Review Complete On">QA Initial Review Complete On :-</label>
                                <div class="static">{{ $data->QA_initial_review_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px;">
                                <label for="QA Initial Review Comments">QA Initial Review Comments:-</label>
                                <div class="">{{ $data->QA_initial_review_comment }}</div>
                            </div>
                        </div>

                        <div class="sub-head">Sent to HOD (From QA Initial)</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete By">HOD Complete By :-</label>
                                <div class="static">{{ $data->QA_initialTo_HOD_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete On">HOD Complete On :-</label>
                                <div class="static">{{ $data->QA_initialTo_HOD_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style=" ">
                                <label for="HOD Review Comments">HOD Comments :-</label>
                                <div class="">{{ $data->QA_initialTo_HOD_comment }}</div>
                            </div>
                        </div>

                        <div class="sub-head">Pending RA Review Complete</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="CFT Review Complete By">Pending RA Review Complete By :-</label>
                                <div class="static">{{ $data->pending_RA_review_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="CFT Review Complete On">Pending RA Review Complete On :-</label>
                                <div class="static">{{ $data->pending_RA_review_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                                <label for="CFT Review Comments">Pending RA Review Comments :-</label>
                                <div class="">{{ $data->pending_RA_review_comment }}</div>
                            </div>
                        </div>

                        <div class="sub-head">CFT Review Complete</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="CFT Review Complete By">CFT Review Complete By :-</label>
                                <div class="static">{{ $data->cft_review_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="CFT Review Complete On">CFT Review Complete On :-</label>
                                <div class="static">{{ $data->cft_review_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                                <label for="CFT Review Comments">CFT Review Comments :-</label>
                                <div class="">{{ $data->cft_review_comment }}</div>
                            </div>
                        </div>


                        <div class="sub-head">Sent to QA Initial (From CFT)</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete By">QA Initial Complete By :-</label>
                                <div class="static">{{ $data->cft_to_qaInitial_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="HOD Review Complete On">QA Initial Complete On :-</label>
                                <div class="static">{{ $data->cft_to_qaInitial_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style=" ">
                                <label for="HOD Review Comments">QA Initial Comments :-</label>
                                <div class="">{{ $data->cft_to_qaInitial_comment }}</div>
                            </div>
                        </div>


                        <div class="sub-head"> QA Final Review Completed</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Final Review Complete By"> QA Final Review Complete By :-</label>
                                <div class="static">{{ $data->QA_final_review_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Final Review Complete On"> QA Final Review Complete On :-</label>
                                <div class="static">{{ $data->QA_final_review_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                                <label for="QA Final Review Comments"> QA Final Review Comments :-</label>
                                <div class="">{{ $data->QA_final_review_comment }}</div>
                            </div>
                        </div>

                        <div class="sub-head">QA Head/Manager Designee Pre-Approval</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Final Review Complete By">QA Head/Manager Designee Pre-Approval Complete By :-</label>
                                <div class="static">{{ $data->QA_preapproved_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Final Review Complete On">QA Head/Manager Designee Pre-Approval Complete On :-</label>
                                <div class="static">{{ $data->QA_preapproved_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                                <label for="QA Final Review Comments">QA Head/Manager Designee Pre-Approval Comments :-</label>
                                <div class="">{{ $data->QA_preapproved_comment }}</div>
                            </div>
                        </div>

                        <div class="sub-head">QA Head/Manager Designee Approval</div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Final Review Complete By">QA Head/Manager Designee Approval Complete By :-</label>
                                <div class="static">{{ $data->QA_head_approval_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="group-input">
                                <label for="QA Final Review Complete On">QA Head/Manager Designee Approval Complete On :-</label>
                                <div class="static">{{ $data->QA_head_approval_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input" style="width:1620px; height:100px; `padding:5px; ">
                                <label for="QA Final Review Comments">QA Head/Manager Designee Approval Comments :-</label>
                                <div class="">{{ $data->QA_head_approval_comment }}</div>
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

            <div id="CCForm11" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">  
                                <div class="sub-head">
                                    RA Review
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.ra_review').hide();

                                        $('[name="RA_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.ra_review').show();
                                                $('.ra_review span').show();
                                            } else {
                                                $('.ra_review').hide();
                                                $('.ra_review span').hide();
                                            }
                                        });
                                    });
                                </script>
                                @php
                                    $data1 = DB::table('cc_cfts')
                                        ->where('cc_id', $data->id)
                                        ->first();
                                @endphp

                                @if ($data->stage == 3 || $data->stage == 4)
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="RA Review"> RA Review Required ? <span
                                                    class="text-danger">*</span></label>
                                            <select name="RA_Review" id="RA_Review"
                                                @if ($data->stage == 4) disabled @endif
                                                @if ($data->stage == 3) required @endif>
                                                <option value="">-- Select --</option>
                                                <option @if ($data1->RA_Review == 'yes') selected @endif value='yes'>
                                                    Yes</option>
                                                <option @if ($data1->RA_Review == 'no') selected @endif value='no'>
                                                    No</option>
                                                <option @if ($data1->RA_Review == 'na') selected @endif value='na'>
                                                    NA</option>
                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 22,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 ra_review">
                                        <div class="group-input">
                                            <label for="RA notification">RA Person <span
                                                    id="asteriskRA"
                                                    style="display: {{ $data1->RA_Review == 'yes' ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span>
                                            </label>
                                            <select @if ($data->stage == 4) disabled @endif
                                                name="RA_person" class="RA_person"
                                                id="RA_person">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if ($user->id == $data1->RA_person) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 ra_review">
                                        <div class="group-input">
                                            <label for="RA assessment">Impact Assessment (By RA) <span
                                                    id="asteriskRA1"
                                                    style="display: {{ $data1->RA_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea @if ($data1->RA_Review == 'yes' && $data->stage == 4) required @endif class="summernote RA_assessment"
                                                @if ($data->stage == 3 || Auth::user()->id != $data1->RA_person) readonly @endif name="RA_assessment" id="summernote-17">{{ $data1->RA_assessment }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 ra_review">
                                        <div class="group-input">
                                            <label for="RA feedback">RA Feedback <span
                                                    id="asteriskRA2"
                                                    style="display: {{ $data1->RA_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea class="summernote RA_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->RA_person) readonly @endif
                                                name="RA_feedback" id="summernote-18" @if ($data1->RA_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->RA_feedback }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 ra_review">
                                        <div class="group-input">
                                            <label for="RA attachment">RA Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="RA_attachment">
                                                    @if ($data1->RA_attachment)
                                                        @foreach (json_decode($data1->RA_attachment) as $file)
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
                                                        type="file" id="myfile"
                                                        name="RA_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'RA_attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 ra_review">
                                        <div class="group-input">
                                            <label for="RA Review Completed By">RA Review Completed
                                                By</label>
                                            <input readonly type="text" value="{{ $data1->RA_by }}"
                                                name="RA_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                id="RA_by">


                                        </div>
                                    </div>
                                    <div class="col-lg-6 ra_review">
                                        <div class="group-input ">
                                            <label for="RA Review Completed On">RA Review Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input type="date"id="RA_on"
                                                name="RA_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data1->RA_on }}">
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var selectField = document.getElementById('RA_Review');
                                            var inputsToToggle = [];

                                            // Add elements with class 'facility-name' to inputsToToggle
                                            var facilityNameInputs = document.getElementsByClassName('RA_person');
                                            for (var i = 0; i < facilityNameInputs.length; i++) {
                                                inputsToToggle.push(facilityNameInputs[i]);
                                            }
                                            // var facilityNameInputs = document.getElementsByClassName('RA_assessment');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }
                                            // var facilityNameInputs = document.getElementsByClassName('RA_feedback');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }

                                            selectField.addEventListener('change', function() {
                                                var isRequired = this.value === 'yes';
                                                console.log(this.value, isRequired, 'value');

                                                inputsToToggle.forEach(function(input) {
                                                    input.required = isRequired;
                                                    console.log(input.required, isRequired, 'input req');
                                                });

                                                // Show or hide the asterisk icon based on the selected value
                                                var asteriskIcon = document.getElementById('asteriskRA');
                                                asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            });
                                        });
                                    </script>
                                @else
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="RA Review">RA Review Required ?</label>
                                            <select name="RA_Review" disabled id="RA_Review">
                                                <option value="">-- Select --</option>
                                                <option @if ($data1->RA_Review == 'yes') selected @endif value='yes'>
                                                    Yes</option>
                                                <option @if ($data1->RA_Review == 'no') selected @endif value='no'>
                                                    No</option>
                                                <option @if ($data1->RA_Review == 'na') selected @endif value='na'>
                                                    NA</option>
                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 22,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 ra_review">
                                        <div class="group-input">
                                            <label for="RA notification">RA Person <span
                                                    id="asteriskInvi11" style="display: none"
                                                    class="text-danger">*</span></label>
                                            <select name="RA_person" disabled id="RA_person">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if ($user->id == $data1->RA_person) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if ($data->stage == 4)
                                        <div class="col-md-12 mb-3 ra_review">
                                            <div class="group-input">
                                                <label for="RA assessment">Impact Assessment (By RA)
                                                    <!-- <span
                                                        id="asteriskInvi12" style="display: none"
                                                        class="text-danger">*</span> -->
                                                    </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="RA_assessment" id="summernote-17">{{ $data1->RA_assessment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 ra_review">
                                            <div class="group-input">
                                                <label for="RA feedback">RA Feedback
                                                    <!-- <span
                                                        id="asteriskInvi22" style="display: none"
                                                        class="text-danger">*</span> -->
                                                    </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="RA_feedback" id="summernote-18">{{ $data1->RA_feedback }}</textarea>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12 mb-3 ra_review">
                                            <div class="group-input">
                                                <label for="RA assessment">Impact Assessment (By RA)
                                                    <!-- <span
                                                        id="asteriskInvi12" style="display: none"
                                                        class="text-danger">*</span> -->
                                                    </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea disabled class="tiny" name="RA_assessment" id="summernote-17">{{ $data1->RA_assessment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 ra_review">
                                            <div class="group-input">
                                                <label for="RA feedback">RA Feedback
                                                    <!-- <span
                                                        id="asteriskInvi22" style="display: none"
                                                        class="text-danger">*</span> -->
                                                    </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea disabled class="tiny" name="RA_feedback" id="summernote-18">{{ $data1->RA_feedback }}</textarea>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12 ra_review">
                                        <div class="group-input">
                                            <label for="RA attachment">RA Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="RA_attachment">
                                                    @if ($data1->RA_attachment)
                                                        @foreach (json_decode($data1->RA_attachment) as $file)
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
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="RA_attachment[]"
                                                        oninput="addMultipleFiles(this, 'RA_attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 ra_review">
                                        <div class="group-input">
                                            <label for="RA Review Completed By">RA Review Completed
                                                By</label>
                                            <input readonly type="text" value="{{ $data1->RA_by }}"
                                                name="RA_by" id="RA_by">


                                        </div>
                                    </div>
                                    <div class="col-lg-6 ra_review">
                                        <div class="group-input">
                                            <label for="RA Review Completed On">RA Review Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input readonly type="date"id="RA_on" name="RA_on"
                                                value="{{ $data1->RA_on }}">
                                        </div>
                                    </div>
                                @endif




                                <div class="sub-head">
                                    Production Table
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.productionTable').hide();

                                        $('[name="Production_Table_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.productionTable').show();
                                                $('.productionTable span').show();
                                            } else {
                                                $('.productionTable').hide();
                                                $('.productionTable span').hide();
                                            }
                                        });
                                    });
                                </script>
                                @php
                                    $data1 = DB::table('cc_cfts')
                                        ->where('cc_id', $data->id)
                                        ->first();
                                @endphp

                                @if ($data->stage == 3 || $data->stage == 4)
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Production Table"> Production Table Required ? <span class="text-danger">*</span></label>
                                            <select name="Production_Table_Review" id="Production_Table_Review" @if ($data->stage == 4) disabled @endif
                                                @if ($data->stage == 3) required @endif>
                                                <option value="">-- Select --</option>
                                                <option @if ($data1->Production_Table_Review == 'yes') selected @endif value='yes'>
                                                    Yes</option>
                                                <option @if ($data1->Production_Table_Review == 'no') selected @endif value='no'>
                                                    No</option>
                                                <option @if ($data1->Production_Table_Review == 'na') selected @endif value='na'>
                                                    NA</option>
                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 22,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 productionTable">
                                        <div class="group-input">
                                            <label for="Production Table notification">Production Table Person <span id="asteriskPT"
                                                    style="display: {{ $data1->Production_Table_Review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                            </label>
                                            <select @if ($data->stage == 4) disabled @endif name="Production_Table_Person" class="Production_Table_Person" id="Production_Table_Person">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" @if ($user->id == $data1->Production_Table_Person) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 productionTable">
                                        <div class="group-input">
                                            <label for="Production Table assessment">Impact Assessment (By Production Table) <span id="asteriskPT1"
                                                    style="display: {{ $data1->Production_Table_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea @if ($data1->Production_Table_Review == 'yes' && $data->stage == 4) required @endif class="summernote Production_Table_Assessment"
                                                @if ($data->stage == 3 || Auth::user()->id != $data1->Production_Table_Person) readonly @endif name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 productionTable">
                                        <div class="group-input">
                                            <label for="Production Table feedback">Production Table Feedback <span id="asteriskPT2"
                                                    style="display: {{ $data1->Production_Table_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea class="summernote Production_Table_Feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Production_Table_Person) readonly @endif name="Production_Table_Feedback"
                                                id="summernote-18" @if ($data1->Production_Table_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Production_Table_Feedback }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 productionTable">
                                        <div class="group-input">
                                            <label for="Production Table attachment">Production Table Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="Production_Table_Attachment">
                                                    @if ($data1->Production_Table_Attachment)
                                                        @foreach (json_decode($data1->Production_Table_Attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                        class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                        class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile"
                                                        name="Production_Table_Attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'Production_Table_Attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 productionTable">
                                        <div class="group-input">
                                            <label for="Production Table Completed By">Production Table Completed
                                                By</label>
                                            <input readonly type="text" value="{{ $data1->Production_Table_By }}"
                                                name="Production_Table_By"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }} id="Production_Table_By">


                                        </div>
                                    </div>
                                    <div class="col-lg-6 productionTable">
                                        <div class="group-input ">
                                            <label for="Production Table Completed On">Production Table Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input type="date"id="Production_Table_On"
                                                name="Production_Table_On"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data1->Production_Table_On }}">
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var selectField = document.getElementById('Production_Table_Review');
                                            var inputsToToggle = [];

                                            // Add elements with class 'facility-name' to inputsToToggle
                                            var facilityNameInputs = document.getElementsByClassName('Production_Table_Person');
                                            for (var i = 0; i < facilityNameInputs.length; i++) {
                                                inputsToToggle.push(facilityNameInputs[i]);
                                            }
                                            // var facilityNameInputs = document.getElementsByClassName('Production_Table_Assessment');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }
                                            // var facilityNameInputs = document.getElementsByClassName('Production_Table_Feedback');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }

                                            selectField.addEventListener('change', function() {
                                                var isRequired = this.value === 'yes';
                                                console.log(this.value, isRequired, 'value');

                                                inputsToToggle.forEach(function(input) {
                                                    input.required = isRequired;
                                                    console.log(input.required, isRequired, 'input req');
                                                });

                                                // Show or hide the asterisk icon based on the selected value
                                                var asteriskIcon = document.getElementById('asteriskPT');
                                                asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            });
                                        });
                                    </script>
                                @else
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Production Table">Production Table Required ?</label>
                                            <select name="Production_Table_Review" disabled id="Production_Table_Review">
                                                <option value="">-- Select --</option>
                                                <option @if ($data1->Production_Table_Review == 'yes') selected @endif value='yes'>
                                                    Yes</option>
                                                <option @if ($data1->Production_Table_Review == 'no') selected @endif value='no'>
                                                    No</option>
                                                <option @if ($data1->Production_Table_Review == 'na') selected @endif value='na'>
                                                    NA</option>
                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 22,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 productionTable">
                                        <div class="group-input">
                                            <label for="Production Table notification">Production Table Person <span id="asteriskInvi11" style="display: none"
                                                    class="text-danger">*</span></label>
                                            <select name="Production_Table_Person" disabled id="Production_Table_Person">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" @if ($user->id == $data1->Production_Table_Person) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if ($data->stage == 4)
                                        <div class="col-md-12 mb-3 productionTable">
                                            <div class="group-input">
                                                <label for="Production Table assessment">Impact Assessment (By Production Table)
                                                    <!-- <span
                                                                                        id="asteriskInvi12" style="display: none"
                                                                                        class="text-danger">*</span> -->
                                                </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 productionTable">
                                            <div class="group-input">
                                                <label for="Production Table feedback">Production Table Feedback
                                                    <!-- <span
                                                                                        id="asteriskInvi22" style="display: none"
                                                                                        class="text-danger">*</span> -->
                                                </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="Production_Table_Feedback" id="summernote-18">{{ $data1->Production_Table_Feedback }}</textarea>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12 mb-3 productionTable">
                                            <div class="group-input">
                                                <label for="Production Table assessment">Impact Assessment (By Production Table)
                                                    <!-- <span
                                                                                        id="asteriskInvi12" style="display: none"
                                                                                        class="text-danger">*</span> -->
                                                </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea disabled class="tiny" name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 productionTable">
                                            <div class="group-input">
                                                <label for="Production Table feedback">Production Table Feedback
                                                    <!-- <span
                                                                                        id="asteriskInvi22" style="display: none"
                                                                                        class="text-danger">*</span> -->
                                                </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea disabled class="tiny" name="Production_Table_Feedback" id="summernote-18">{{ $data1->Production_Table_Feedback }}</textarea>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12 productionTable">
                                        <div class="group-input">
                                            <label for="Production Table attachment">Production Table Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="Production_Table_Attachment">
                                                    @if ($data1->Production_Table_Attachment)
                                                        @foreach (json_decode($data1->Production_Table_Attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                        class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                        class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                        id="myfile" name="Production_Table_Attachment[]" oninput="addMultipleFiles(this, 'Production_Table_Attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 productionTable">
                                        <div class="group-input">
                                            <label for="Production Table Completed By">Production Table Completed
                                                By</label>
                                            <input readonly type="text" value="{{ $data1->Production_Table_By }}" name="Production_Table_By" id="Production_Table_By">


                                        </div>
                                    </div>
                                    <div class="col-lg-6 productionTable">
                                        <div class="group-input">
                                            <label for="Production Table Completed On">Production Table Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input readonly type="date"id="Production_Table_On" name="Production_Table_On" value="{{ $data1->Production_Table_On }}">
                                        </div>
                                    </div>
                                @endif


                                <div class="sub-head">
                                    Production Injection
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.productionInjection').hide();

                                        $('[name="Production_Injection_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.productionInjection').show();
                                                $('.productionInjection span').show();
                                            } else {
                                                $('.productionInjection').hide();
                                                $('.productionInjection span').hide();
                                            }
                                        });
                                    });
                                </script>
                                @php
                                    $data1 = DB::table('cc_cfts')
                                        ->where('cc_id', $data->id)
                                        ->first();
                                @endphp

                                @if ($data->stage == 3 || $data->stage == 4)
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Production Injection"> Production Injection Required ? <span class="text-danger">*</span></label>
                                            <select name="Production_Injection_Review" id="Production_Injection_Review" @if ($data->stage == 4) disabled @endif
                                                @if ($data->stage == 3) required @endif>
                                                <option value="">-- Select --</option>
                                                <option @if ($data1->Production_Injection_Review == 'yes') selected @endif value='yes'>
                                                    Yes</option>
                                                <option @if ($data1->Production_Injection_Review == 'no') selected @endif value='no'>
                                                    No</option>
                                                <option @if ($data1->Production_Injection_Review == 'na') selected @endif value='na'>
                                                    NA</option>
                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 22,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection notification">Production Injection Person <span id="asteriskPT"
                                                    style="display: {{ $data1->Production_Injection_Review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                            </label>
                                            <select @if ($data->stage == 4) disabled @endif name="Production_Injection_Person" class="Production_Injection_Person" id="Production_Injection_Person">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" @if ($user->id == $data1->Production_Injection_Person) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection assessment">Impact Assessment (By Production Injection) <span id="asteriskPT1"
                                                    style="display: {{ $data1->Production_Injection_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea @if ($data1->Production_Injection_Review == 'yes' && $data->stage == 4) required @endif class="summernote Production_Injection_Assessment"
                                                @if ($data->stage == 3 || Auth::user()->id != $data1->Production_Injection_Person) readonly @endif name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection feedback">Production Injection Feedback <span id="asteriskPT2"
                                                    style="display: {{ $data1->Production_Injection_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea class="summernote Production_Injection_Feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Production_Injection_Person) readonly @endif name="Production_Injection_Feedback"
                                                id="summernote-18" @if ($data1->Production_Injection_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Production_Injection_Feedback }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection attachment">Production Injection Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="Production_Injection_Attachment">
                                                    @if ($data1->Production_Injection_Attachment)
                                                        @foreach (json_decode($data1->Production_Injection_Attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                        class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                        class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file" id="myfile"
                                                        name="Production_Injection_Attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'Production_Injection_Attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection Completed By">Production Injection Completed
                                                By</label>
                                            <input readonly type="text" value="{{ $data1->Production_Injection_By }}"
                                                name="Production_Injection_By"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }} id="Production_Injection_By">


                                        </div>
                                    </div>
                                    <div class="col-lg-6 productionInjection">
                                        <div class="group-input ">
                                            <label for="Production Injection Completed On">Production Injection Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input type="date"id="Production_Injection_On"
                                                name="Production_Injection_On"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data1->Production_Injection_On }}">
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var selectField = document.getElementById('Production_Injection_Review');
                                            var inputsToToggle = [];

                                            // Add elements with class 'facility-name' to inputsToToggle
                                            var facilityNameInputs = document.getElementsByClassName('Production_Injection_Person');
                                            for (var i = 0; i < facilityNameInputs.length; i++) {
                                                inputsToToggle.push(facilityNameInputs[i]);
                                            }
                                            // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Assessment');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }
                                            // var facilityNameInputs = document.getElementsByClassName('Production_Injection_Feedback');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }

                                            selectField.addEventListener('change', function() {
                                                var isRequired = this.value === 'yes';
                                                console.log(this.value, isRequired, 'value');

                                                inputsToToggle.forEach(function(input) {
                                                    input.required = isRequired;
                                                    console.log(input.required, isRequired, 'input req');
                                                });

                                                // Show or hide the asterisk icon based on the selected value
                                                var asteriskIcon = document.getElementById('asteriskPT');
                                                asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            });
                                        });
                                    </script>
                                @else
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Production Injection">Production Injection Required ?</label>
                                            <select name="Production_Injection_Review" disabled id="Production_Injection_Review">
                                                <option value="">-- Select --</option>
                                                <option @if ($data1->Production_Injection_Review == 'yes') selected @endif value='yes'>
                                                    Yes</option>
                                                <option @if ($data1->Production_Injection_Review == 'no') selected @endif value='no'>
                                                    No</option>
                                                <option @if ($data1->Production_Injection_Review == 'na') selected @endif value='na'>
                                                    NA</option>
                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 22,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection notification">Production Injection Person <span id="asteriskInvi11" style="display: none"
                                                    class="text-danger">*</span></label>
                                            <select name="Production_Injection_Person" disabled id="Production_Injection_Person">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" @if ($user->id == $data1->Production_Injection_Person) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if ($data->stage == 4)
                                        <div class="col-md-12 mb-3 productionInjection">
                                            <div class="group-input">
                                                <label for="Production Injection assessment">Impact Assessment (By Production Injection)
                                                    <!-- <span
                                                                                        id="asteriskInvi12" style="display: none"
                                                                                        class="text-danger">*</span> -->
                                                </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 productionInjection">
                                            <div class="group-input">
                                                <label for="Production Injection feedback">Production Injection Feedback
                                                    <!-- <span
                                                                                        id="asteriskInvi22" style="display: none"
                                                                                        class="text-danger">*</span> -->
                                                </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="Production_Injection_Feedback" id="summernote-18">{{ $data1->Production_Injection_Feedback }}</textarea>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12 mb-3 productionInjection">
                                            <div class="group-input">
                                                <label for="Production Injection assessment">Impact Assessment (By Production Injection)
                                                    <!-- <span
                                                                                        id="asteriskInvi12" style="display: none"
                                                                                        class="text-danger">*</span> -->
                                                </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea disabled class="tiny" name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 productionInjection">
                                            <div class="group-input">
                                                <label for="Production Injection feedback">Production Injection Feedback
                                                    <!-- <span
                                                                                        id="asteriskInvi22" style="display: none"
                                                                                        class="text-danger">*</span> -->
                                                </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea disabled class="tiny" name="Production_Injection_Feedback" id="summernote-18">{{ $data1->Production_Injection_Feedback }}</textarea>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection attachment">Production Injection Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="Production_Injection_Attachment">
                                                    @if ($data1->Production_Injection_Attachment)
                                                        @foreach (json_decode($data1->Production_Injection_Attachment) as $file)
                                                            <h6 type="button" class="file-container text-dark"
                                                                style="background-color: rgb(243, 242, 240);">
                                                                <b>{{ $file }}</b>
                                                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                                                        class="fa fa-eye text-primary"
                                                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                                                        class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                                                            </h6>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                        id="myfile" name="Production_Injection_Attachment[]" oninput="addMultipleFiles(this, 'Production_Injection_Attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection Completed By">Production Injection Completed
                                                By</label>
                                            <input readonly type="text" value="{{ $data1->Production_Injection_By }}" name="Production_Injection_By" id="Production_Injection_By">


                                        </div>
                                    </div>
                                    <div class="col-lg-6 productionInjection">
                                        <div class="group-input">
                                            <label for="Production Injection Completed On">Production Injection Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input readonly type="date"id="Production_Injection_On" name="Production_Injection_On" value="{{ $data1->Production_Injection_On }}">
                                        </div>
                                    </div>
                                @endif








                                <div class="sub-head">
                                    Production
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.p_erson').hide();

                                        $('[name="Production_Review"]').change(function() {
                                            if ($(this).val() === 'yes') {

                                                $('.p_erson').show();
                                                $('.p_erson span').show();
                                            } else {
                                                $('.p_erson').hide();
                                                $('.p_erson span').hide();
                                            }
                                        });
                                    });
                                </script>
                                @php
                                    $data1 = DB::table('cc_cfts')
                                        ->where('cc_id', $data->id)
                                        ->first();
                                @endphp
                                @if ($data->stage == 3 || $data->stage == 4)
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Production Review"> Production Review Required ? <span
                                                    class="text-danger">*</span></label>
                                            <select name="Production_Review" id="Production_Review"
                                                @if ($data->stage == 4) disabled @endif
                                                @if ($data->stage == 3) required @endif>
                                                <option value="">-- Select --</option>
                                                <option @if ($data1->Production_Review == 'yes') selected @endif value='yes'>
                                                    Yes</option>
                                                <option @if ($data1->Production_Review == 'no') selected @endif value='no'>
                                                    No</option>
                                                <option @if ($data1->Production_Review == 'na') selected @endif value='na'>
                                                    NA</option>
                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 22,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 p_erson">
                                        <div class="group-input">
                                            <label for="Production notification">Production Person <span
                                                    id="asteriskProduction"
                                                    style="display: {{ $data1->Production_Review == 'yes' ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span>
                                            </label>
                                            <select @if ($data->stage == 4) disabled @endif
                                                name="Production_person" class="Production_person"
                                                id="Production_person">
                                                <option value="">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if ($user->id == $data1->Production_person) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 p_erson">
                                        <div class="group-input">
                                            <label for="Production assessment">Impact Assessment (By Production) <span
                                                    id="asteriskProduction1"
                                                    style="display: {{ $data1->Production_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea @if ($data1->Production_Review == 'yes' && $data->stage == 4) required @endif class="summernote Production_assessment"
                                                @if ($data->stage == 3 || Auth::user()->id != $data1->Production_person) readonly @endif name="Production_assessment" id="summernote-17">{{ $data1->Production_assessment }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 p_erson">
                                        <div class="group-input">
                                            <label for="Production feedback">Production Feedback <span
                                                    id="asteriskProduction2"
                                                    style="display: {{ $data1->Production_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea class="summernote Production_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Production_person) readonly @endif
                                                name="Production_feedback" id="summernote-18" @if ($data1->Production_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Production_feedback }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 p_erson">
                                        <div class="group-input">
                                            <label for="production attachment">Production Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="production_attachment">
                                                    @if ($data1->production_attachment)
                                                        @foreach (json_decode($data1->production_attachment) as $file)
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
                                                        type="file" id="myfile"
                                                        name="production_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        oninput="addMultipleFiles(this, 'production_attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 p_erson">
                                        <div class="group-input">
                                            <label for="Production Review Completed By">Production Review Completed
                                                By</label>
                                            <input readonly type="text" value="{{ $data1->Production_by }}"
                                                name="production_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                id="production_by">


                                        </div>
                                    </div>
                                    <div class="col-lg-6 p_erson">
                                        <div class="group-input ">
                                            <label for="Production Review Completed On">Production Review Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input type="date"id="production_on"
                                                name="production_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                value="{{ $data1->production_on }}">
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var selectField = document.getElementById('Production_Review');
                                            var inputsToToggle = [];

                                            // Add elements with class 'facility-name' to inputsToToggle
                                            var facilityNameInputs = document.getElementsByClassName('Production_person');
                                            for (var i = 0; i < facilityNameInputs.length; i++) {
                                                inputsToToggle.push(facilityNameInputs[i]);
                                            }
                                            // var facilityNameInputs = document.getElementsByClassName('Production_assessment');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }
                                            // var facilityNameInputs = document.getElementsByClassName('Production_feedback');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }

                                            selectField.addEventListener('change', function() {
                                                var isRequired = this.value === 'yes';
                                                console.log(this.value, isRequired, 'value');

                                                inputsToToggle.forEach(function(input) {
                                                    input.required = isRequired;
                                                    console.log(input.required, isRequired, 'input req');
                                                });

                                                // Show or hide the asterisk icon based on the selected value
                                                var asteriskIcon = document.getElementById('asteriskProduction');
                                                asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            });
                                        });
                                    </script>
                                @else
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Production Review">Production Review Required ?</label>
                                            <select name="Production_Review" disabled id="Production_Review">
                                                <option value="">-- Select --</option>
                                                <option @if ($data1->Production_Review == 'yes') selected @endif value='yes'>
                                                    Yes</option>
                                                <option @if ($data1->Production_Review == 'no') selected @endif value='no'>
                                                    No</option>
                                                <option @if ($data1->Production_Review == 'na') selected @endif value='na'>
                                                    NA</option>
                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 22,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 p_erson">
                                        <div class="group-input">
                                            <label for="Production notification">Production Person <span
                                                    id="asteriskInvi11" style="display: none"
                                                    class="text-danger">*</span></label>
                                            <select name="Production_person" disabled id="Production_person">
                                                <option value="0">-- Select --</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if ($user->id == $data1->Production_person) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if ($data->stage == 4)
                                        <div class="col-md-12 mb-3 p_erson">
                                            <div class="group-input">
                                                <label for="Production assessment">Impact Assessment (By Production)
                                                    <!-- <span
                                                        id="asteriskInvi12" style="display: none"
                                                        class="text-danger">*</span> -->
                                                    </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="Production_assessment" id="summernote-17">{{ $data1->Production_assessment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 p_erson">
                                            <div class="group-input">
                                                <label for="Production feedback">Production Feedback
                                                    <!-- <span
                                                        id="asteriskInvi22" style="display: none"
                                                        class="text-danger">*</span> -->
                                                    </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea class="tiny" name="Production_feedback" id="summernote-18">{{ $data1->Production_feedback }}</textarea>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12 mb-3 p_erson">
                                            <div class="group-input">
                                                <label for="Production assessment">Impact Assessment (By Production)
                                                    <!-- <span
                                                        id="asteriskInvi12" style="display: none"
                                                        class="text-danger">*</span> -->
                                                    </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea disabled class="tiny" name="Production_assessment" id="summernote-17">{{ $data1->Production_assessment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 p_erson">
                                            <div class="group-input">
                                                <label for="Production feedback">Production Feedback
                                                    <!-- <span
                                                        id="asteriskInvi22" style="display: none"
                                                        class="text-danger">*</span> -->
                                                    </label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                                <textarea disabled class="tiny" name="Production_feedback" id="summernote-18">{{ $data1->Production_feedback }}</textarea>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12 p_erson">
                                        <div class="group-input">
                                            <label for="production attachment">Production Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="production_attachment">
                                                    @if ($data1->production_attachment)
                                                        @foreach (json_decode($data1->production_attachment) as $file)
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
                                                        {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                        type="file" id="myfile" name="production_attachment[]"
                                                        oninput="addMultipleFiles(this, 'production_attachment')"
                                                        multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 p_erson">
                                        <div class="group-input">
                                            <label for="Production Review Completed By">Production Review Completed
                                                By</label>
                                            <input readonly type="text" value="{{ $data1->Production_by }}"
                                                name="production_by" id="production_by">


                                        </div>
                                    </div>
                                    <div class="col-lg-6 p_erson">
                                        <div class="group-input">
                                            <label for="Production Review Completed On">Production Review Completed
                                                On</label>
                                            <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                            <input readonly type="date"id="production_on" name="production_on"
                                                value="{{ $data1->production_on }}">
                                        </div>
                                    </div>
                                @endif

                                <div class="sub-head">
                                    Warehouse
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Warehouse_review !== 'yes')

                                        $('.warehouse').hide();

                                        $('[name="Warehouse_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.warehouse').show();
                                                $('.warehouse span').show();
                                            } else {
                                                $('.warehouse').hide();
                                                $('.warehouse span').hide();
                                            }
                                        });
                                        @endif
                                    });
                                </script>
                                @if ($data->stage == 3 || $data->stage == 4)
                                    <div class="col-lg-6">
                                        <div class="group-input">
                                            <label for="Warehouse Review Required">Warehouse Review Required ? <span
                                                    class="text-danger">*</span></label>
                                            <select @if ($data->stage == 3) required @endif
                                                name="Warehouse_review" id="Warehouse_review"
                                                @if ($data->stage == 4) disabled @endif>
                                                <option value="0">-- Select --</option>
                                                <option @if ($data1->Warehouse_review == 'yes') selected @endif
                                                    value="yes">Yes</option>
                                                <option @if ($data1->Warehouse_review == 'no') selected @endif
                                                    value="no">No</option>
                                                <option @if ($data1->Warehouse_review == 'na') selected @endif
                                                    value="na">NA</option>

                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 23,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 warehouse">
                                        <div class="group-input">
                                            <label for="Warehouse Person">Warehouse Person <span id="asteriskware"
                                                    style="display: {{ $data1->Warehouse_review == 'yes' ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span></label>
                                            <select name="Warehouse_notification" class="Warehouse_notification"
                                                id="Warehouse_notification"
                                                value="{{ $data1->Warehouse_notification }}"
                                                @if ($data->stage == 4) disabled @endif>
                                                <option value=""> -- Select --</option>
                                                @foreach ($users as $user)
                                                    <option
                                                        {{ $data1->Warehouse_notification == $user->id ? 'selected' : '' }}
                                                        value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 warehouse">
                                        <div class="group-input">
                                            <label for="Impact Assessment1">Impact Assessment (By Warehouse)
                                                <!-- <spa
                                             -->
                                                </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea @if ($data1->Warehouse_review == 'yes' && $data->stage == 4) required @endif class="summernote Warehouse_assessment"
                                                name="Warehouse_assessment" id="summernote-19" @if ($data->stage == 3 || Auth::user()->id != $data1->Warehouse_notification) readonly @endif>{{ $data1->Warehouse_assessment }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 warehouse">
                                        <div class="group-input">
                                            <label for="Warehouse Feedback">Warehouse Feedback
                                                <!-- <span id="asteriskware3"
                                                    style="display: {{ $data1->Warehouse_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                    class="text-danger">*</span> -->
                                                </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                            <textarea @if ($data1->Warehouse_review == 'yes' && $data->stage == 4) required @endif class="summernote Warehouse_feedback"
                                                name="Warehouse_feedback" id="summernote-20" @if ($data->stage == 3 || Auth::user()->id != $data1->Warehouse_notification) readonly @endif>{{ $data1->Warehouse_feedback }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 warehouse">
                                        <div class="group-input">
                                            <label for="Warehouse attachment">Warehouse Attachments</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting
                                                    documents</small></div>
                                            <div class="file-attachment-field">
                                                <div disabled class="file-attachment-list" id="Warehouse_attachment">
                                                    @if ($data1->Warehouse_attachment)
                                                        @foreach (json_decode($data1->Warehouse_attachment) as $file)
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
                                                        type="file" id="myfile" name="Warehouse_attachment[]"
                                                        oninput="addMultipleFiles(this, 'Warehouse_attachment')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var selectField = document.getElementById('Warehouse_review');
                                            var inputsToToggle = [];

                                            // Add elements with class 'facility-name' to inputsToToggle
                                            var facilityNameInputs = document.getElementsByClassName('Warehouse_notification');
                                            for (var i = 0; i < facilityNameInputs.length; i++) {
                                                inputsToToggle.push(facilityNameInputs[i]);
                                            }
                                            // var facilityNameInputs = document.getElementsByClassName('Warehouse_assessment');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }
                                            // var facilityNameInputs = document.getElementsByClassName('Warehouse_feedback');
                                            // for (var i = 0; i < facilityNameInputs.length; i++) {
                                            //     inputsToToggle.push(facilityNameInputs[i]);
                                            // }

                                            selectField.addEventListener('change', function() {
                                                var isRequired = this.value === 'yes';

                                                inputsToToggle.forEach(function(input) {
                                                    input.required = isRequired;
                                                });

                                                // Show or hide the asterisk icon based on the selected value
                                                var asteriskIcon = document.getElementById('asteriskware');
                                                asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            });
                                        });
                                    </script>

                                    <div class="col-md-6 mb-3 warehouse">
                                        <div class="group-input">
                                            <label for="Warehouse Review Completed By">Warehouse Review Completed By</label>
                                            <input disabled type="text" value="{{ $data1->Warehouse_by }}" name="Warehouse_by" id="Warehouse_by">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3 warehouse">
                                        <div class="group-input">
                                            <label for="Warehouse Review Completed On">Warehouse Review Completed On</label>
                                            <input type="date"id="Warehouse_on" name="Warehouse_on"
                                                value="{{ $data1->Warehouse_on }}">
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-6 warehouse">
                                        <div class="group-input">
                                            <label for="Warehouse Review Required">Warehouse Review Required ?</label>
                                            <select disabled name="Warehouse_review" id="Warehouse_review">
                                                <option value="0">-- Select --</option>
                                                <option @if ($data1->Warehouse_review == 'yes') selected @endif
                                                    value="yes">Yes</option>
                                                <option @if ($data1->Warehouse_review == 'no') selected @endif
                                                    value="no">No</option>
                                                <option @if ($data1->Warehouse_review == 'na') selected @endif
                                                    value="na">NA</option>

                                            </select>

                                        </div>
                                    </div>
                                    @php
                                        $userRoles = DB::table('user_roles')
                                            ->where([
                                                'q_m_s_roles_id' => 23,
                                                'q_m_s_divisions_id' => $data->division_id,
                                            ])
                                            ->get();
                                        $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                        $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                    @endphp
                                    <div class="col-lg-6 warehouse">
                                        <div class="group-input">
                                            <label for="Warehouse Person">Warehouse Person </label>
                                            <select disabled name="Warehouse_notification" id="Warehouse_notification"
                                                value="{{ $data1->Warehouse_notification }}">
                                                <option value=""> -- Select --</option>
                                                @foreach ($users as $user)
                                                    <option
                                                        {{ $data1->Warehouse_notification == $user->id ? 'selected' : '' }}
                                                        value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    @if ($data->stage == 4)
                                        <div class="col-md-12 mb-3 warehouse">
                                            <div class="group-input">
                                                <label for="Impact Assessment1">Impact Assessment (By Warehouse)</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if
                                                        it does not require completion</small></div>
                                                <textarea class="tiny" name="Warehouse_assessment" id="summernote-19">{{ $data1->Warehouse_assessment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3 warehouse">
                                            <div class="group-input">
                                                <label for="Warehouse Feedback">Warehouse Feedback</label>
                                                <div><small class="text-primary">Please insert "NA" in the data field if
                                                        it does not require completion</small></div>
                                                <textarea class="tiny" name="Warehouse_feedback" id="summernote-20">{{ $data1->Warehouse_feedback }}</textarea>
                                            </div>
                                        </div>
                            </div>
                        @else
                            <div class="col-md-12 mb-3 warehouse">
                                <div class="group-input">
                                    <label for="Impact Assessment1">Impact Assessment (By Warehouse)</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea disabled class="tiny" name="Warehouse_assessment" id="summernote-19">{{ $data1->Warehouse_assessment }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 warehouse">
                                <div class="group-input">
                                    <label for="Warehouse Feedback">Warehouse Feedback</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea disabled class="tiny" name="Warehouse_feedback" id="summernote-20">{{ $data1->Warehouse_feedback }}</textarea>
                                </div>
                            </div>
                            @endif
                            <div class="col-12 warehouse">
                                <div class="group-input">
                                    <label for="Warehouse attachment">Warehouse Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div disabled class="file-attachment-list" id="Warehouse_attachment">
                                            @if ($data1->Warehouse_attachment)
                                                @foreach (json_decode($data1->Warehouse_attachment) as $file)
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
                                            <input disabled {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }}
                                                type="file" id="myfile" name="Warehouse_attachment[]"
                                                oninput="addMultipleFiles(this, 'Warehouse_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 warehouse">
                                <div class="group-input">
                                    <label for="Warehouse Review Completed By">Warehouse Review Completed By</label>
                                    <input disabled type="text" value="{{ $data1->Warehouse_by }}"
                                        name="Warehouse_by" id="Warehouse_by">
                                </div>
                            </div>
                            <div class="col-lg-6 warehouse">
                                <div class="group-input">
                                    <label for="Warehouse Review Completed On">Warehouse Review Completed On</label>
                                    <input disabled type="date"id="Warehouse_on" name="Warehouse_on"
                                        value="{{ $data1->Warehouse_on }}">
                                </div>
                            </div>
                            @endif

                            <div class="sub-head">
                                Quality Control
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.quality_control').hide();

                                    $('[name="Quality_review"]').change(function() {
                                        if ($(this).val() === 'yes') {
                                            $('.quality_control').show();
                                            $('.quality_control span').show();
                                        } else {
                                            $('.quality_control').hide();
                                            $('.quality_control span').hide();
                                        }
                                    });
                                });
                            </script>
                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control Review Required">Quality Control Review Required?
                                            <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif name="Quality_review"
                                            id="Quality_review" @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Quality_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Quality_review == 'no') selected @endif value="no">No
                                            </option>
                                            <option @if ($data1->Quality_review == 'na') selected @endif value="na">NA
                                            </option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 24, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Person">Quality Control Person
                                            <!-- <span id="asteriskQC"
                                                style="display: {{ $data1->Quality_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <select name="Quality_Control_Person" class="Quality_Control_Person"
                                            id="Quality_Control_Person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Quality_Control_Person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_control">
                                    <div class="group-input">
                                        <label for="Impact Assessment2">Impact Assessment (By Quality Control)
                                            <!-- <span
                                                id="asteriskQC1"
                                                style="display: {{ $data1->Quality_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Quality_review == 'yes' && $data->stage == 4) required @endif class="summernote Quality_Control_assessment"
                                            name="Quality_Control_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->Quality_Control_Person) readonly @endif id="summernote-21">{{ $data1->Quality_Control_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Feedback">Quality Control Feedback
                                            <!-- <span
                                                id="asteriskQC2"
                                                style="display: {{ $data1->Quality_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Quality_review == 'yes' && $data->stage == 4) required @endif class="summernote Quality_Control_feedback"
                                            name="Quality_Control_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Quality_Control_Person) readonly @endif id="summernote-22">{{ $data1->Quality_Control_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Quality_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Quality_Control_Person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskQC');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Attachments">Quality Control Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Quality_Control_attachment">
                                                @if ($data1->Quality_Control_attachment)
                                                    @foreach (json_decode($data1->Quality_Control_attachment) as $file)
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
                                                    type="file" id="myfile" name="Quality_Control_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Control_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Review Completed By">Quality Control Review Completed
                                            By</label>
                                        <input disabled type="text" value="{{ $data1->Quality_Control_by }}"
                                            name="Quality_Control_by" id="Quality_Control_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 quality_control">
                                    <div class="group-input">
                                        <label for="Quality Control Review Completed On">Quality Control Review Completed
                                            On</label>
                                        <input type="date"id="Quality_Control_on" name="Quality_Control_on"
                                            value="{{ $data1->Quality_Control_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Quality Assurance
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Quality_Assurance_Review !== 'yes')

                                        $('.quality_assurance').hide();

                                        $('[name="Quality_Assurance"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.quality_assurance').show();
                                                $('.quality_assurance span').show();
                                            } else {
                                                $('.quality_assurance').hide();
                                                $('.quality_assurance span').hide();
                                            }
                                        });
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Required">Quality Assurance Review Required ?
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Quality_Assurance_Review" id="Quality_Assurance_Review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Quality_Assurance_Review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Quality_Assurance_Review == 'no') selected @endif value="no">No
                                            </option>
                                            <option @if ($data1->Quality_Assurance_Review == 'na') selected @endif value="na">NA
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 26, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Person">Quality Assurance Person <span
                                                id="asteriskQQA"
                                                style="display: {{ $data1->Quality_Assurance_Review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="QualityAssurance_person" class="QualityAssurance_person"
                                            id="QualityAssurance_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->QualityAssurance_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Impact Assessment3">Impact Assessment (By Quality Assurance) <span
                                                id="asteriskQQA1"
                                                style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 4) required @endif class="summernote QualityAssurance_assessment"
                                            name="QualityAssurance_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->QualityAssurance_person) readonly @endif id="summernote-23">{{ $data1->QualityAssurance_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Feedback">Quality Assurance Feedback <span
                                                id="asteriskQQA2"
                                                style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 4) required @endif class="summernote QualityAssurance_feedback"
                                            name="QualityAssurance_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->QualityAssurance_person) readonly @endif id="summernote-24">{{ $data1->QualityAssurance_feedback }}</textarea>
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Quality_Assurance_Review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('QualityAssurance_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskQQA');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Attachments">Quality Assurance Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Quality_Assurance_attachment">
                                                @if ($data1->Quality_Assurance_attachment)
                                                    @foreach (json_decode($data1->Quality_Assurance_attachment) as $file)
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
                                                    type="file" id="myfile"
                                                    name="Quality_Assurance_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Completed By">Quality Assurance Review
                                            Completed By</label>
                                        <input type="text" name="QualityAssurance_by" id="QualityAssurance_by"
                                            value="{{ $data1->QualityAssurance_by }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6 quality_assurance">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Completed On">Quality Assurance Review
                                            Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date"id="QualityAssurance_on" name="QualityAssurance_on"
                                            value="{{ $data1->QualityAssurance_on }}">
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Engineering_review !== 'yes')

                                        $('.engineering').hide();

                                        $('[name="Engineering_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.engineering').show();
                                                $('.engineering span').show();
                                            } else {
                                                $('.engineering').hide();
                                                $('.engineering span').hide();
                                            }
                                        });
                                        @endif

                                    });
                                </script>
                                <div class="sub-head">
                                    Engineering
                                </div>

                                <div class="col-lg-6 ">
                                    <div class="group-input">
                                        <label for="Customer notification">Engineering Review Required ? <span
                                                class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Engineering_review" id="Engineering_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Engineering_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Engineering_review == 'no') selected @endif value="no">No
                                            </option>
                                            <option @if ($data1->Engineering_review == 'na') selected @endif value="na">NA
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 25, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 engineering">
                                    <div class="group-input">
                                        <label for="Customer notification">Engineering Person <span id="asteriskEP"
                                                style="display: {{ $data1->Engineering_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Engineering_person" class="Engineering_person"
                                            id="Engineering_person" @if ($data->stage == 4) disabled @endif>
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Engineering_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 engineering">
                                    <div class="group-input">
                                        <label for="Impact Assessment4">Impact Assessment (By Engineering)
                                            <!-- <span
                                                id="asteriskEP1"
                                                style="display: {{ $data1->Engineering_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Engineering_review == 'yes' && $data->stage == 4) required @endif class="summernote Engineering_assessment"
                                            name="Engineering_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->Engineering_person) readonly @endif id="summernote-25">{{ $data1->Engineering_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 engineering">
                                    <div class="group-input">
                                        <label for="Engineering Feedback">Engineering Feedback
                                            <!-- <span id="asteriskEP2"
                                                style="display: {{ $data1->Engineering_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea @if ($data1->Engineering_review == 'yes' && $data->stage == 4) required @endif class="summernote Engineering_feedback"
                                            name="Engineering_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Engineering_person) readonly @endif id="summernote-26">{{ $data1->Engineering_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Engineering_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Engineering_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskEP');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 engineering">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Engineering Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Engineering_attachment">
                                                @if ($data1->Engineering_attachment)
                                                    @foreach (json_decode($data1->Engineering_attachment) as $file)
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
                                                    type="file" id="myfile" name="Engineering_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Engineering_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 engineering">
                                    <div class="group-input">
                                        <label for="Engineering Review Completed By">Engineering Review Completed
                                            By</label>
                                        <input disabled type="text" value="{{ $data1->Engineering_by }}"
                                            name="Engineering_by" id="Engineering_by">

                                    </div>
                                </div>
                                <div class="col-lg-6 engineering">
                                    <div class="group-input">
                                        <label for="Engineering Review Completed On">Engineering Review Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date" id="Engineering_on" name="Engineering_on"
                                            value="{{ $data1->Engineering_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Analytical Development Laboratory
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Analytical_Development_review!== 'yes')

                                        $('.analytical_development').hide();

                                        $('[name="Analytical_Development_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.analytical_development').show();
                                                $('.analytical_development span').show();
                                            } else {
                                                $('.analytical_development').hide();
                                                $('.analytical_development span').hide();
                                            }
                                        });
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Required">Analytical
                                            Development Laboratory Review Required ? <span
                                                class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Analytical_Development_review" id="Analytical_Development_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Analytical_Development_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Analytical_Development_review == 'no') selected @endif value="no">No
                                            </option>
                                            <option @if ($data1->Analytical_Development_review == 'na') selected @endif value="na">NA
                                            </option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 27, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 analytical_development">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Person"> Analytical Development
                                            Laboratory Person <span id="asteriskAD"
                                                style="display: {{ $data1->Analytical_Development_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Analytical_Development_person"
                                            class="Analytical_Development_person" id="Analytical_Development_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Analytical_Development_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 analytical_development">
                                    <div class="group-input">
                                        <label for="Impact Assessment5">Impact Assessment (By Analytical Development
                                            Laboratory)
                                            <!-- <span id="asteriskAD1"
                                                style="display: {{ $data1->Analytical_Development_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <textarea @if ($data1->Analytical_Development_review == 'yes' && $data->stage == 4) required @endif class="summernote Analytical_Development_assessment"
                                            name="Analytical_Development_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->Analytical_Development_person) readonly @endif
                                            id="summernote-27">{{ $data1->Analytical_Development_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 analytical_development">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Feedback"> Analytical Development
                                            Laboratory Feedback
                                            <!-- <span id="asteriskAD2"
                                                style="display: {{ $data1->Analytical_Development_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <textarea @if ($data1->Analytical_Development_review == 'yes' && $data->stage == 4) required @endif class="summernote Analytical_Development_feedback"
                                            name="Analytical_Development_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Analytical_Development_person) readonly @endif id="summernote-28">{{ $data1->Analytical_Development_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Analytical_Development_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Analytical_Development_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskAD');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 analytical_development">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Analytical Development Laboratory
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Analytical_Development_attachment">
                                                @if ($data1->Analytical_Development_attachment)
                                                    @foreach (json_decode($data1->Analytical_Development_attachment) as $file)
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
                                                    type="file" id="myfile"
                                                    name="Analytical_Development_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Analytical_Development_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 analytical_development">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Completed By">Analytical
                                            Development Laboratory Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Analytical_Development_by }}"
                                            name="Analytical_Development_by" id="Analytical_Development_by">
                                    </div>
                                </div>
                                <div class="col-lg-6 analytical_development">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Completed On">Analytical
                                            Development Laboratory Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input type="date" id="Analytical_Development_on"
                                            name="Analytical_Development_on"
                                            value="{{ $data1->Analytical_Development_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Process Development Laboratory / Kilo Lab
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Kilo_Lab_review !== 'yes')

                                        $('.kilo_lab').hide();

                                        $('[name="Kilo_Lab_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.kilo_lab').show();
                                                $('.kilo_lab span').show();
                                            } else {
                                                $('.kilo_lab').hide();
                                                $('.kilo_lab span').hide();
                                            }
                                        });
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Process Development Laboratory"> Process Development Laboratory / Kilo
                                            Lab Review Required ? <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Kilo_Lab_review" id="Kilo_Lab_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Kilo_Lab_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Kilo_Lab_review == 'no') selected @endif value="no">No
                                            </option>
                                            <option @if ($data1->Kilo_Lab_review == 'na') selected @endif value="na">NA
                                            </option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 28, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 kilo_lab">
                                    <div class="group-input">
                                        <label for="Process Development Laboratory"> Process Development Laboratory / Kilo
                                            Lab Person <span id="asteriskPDL"
                                                style="display: {{ $data1->Kilo_Lab_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Kilo_Lab_person" class="Kilo_Lab_person" id="Kilo_Lab_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Kilo_Lab_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 kilo_lab">
                                    <div class="group-input">
                                        <label for="Impact Assessment6">Impact Assessment (By Process Development
                                            Laboratory / Kilo Lab)
                                            <!-- <span id="asteriskPDL1"
                                                style="display: {{ $data1->Kilo_Lab_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <textarea @if ($data1->Kilo_Lab_review == 'yes' && $data->stage == 4) required @endif class="summernote Analytical_Development_assessment"
                                            name="Kilo_Lab_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->Kilo_Lab_person) readonly @endif id="summernote-29">{{ $data1->Kilo_Lab_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 kilo_lab">
                                    <div class="group-input">
                                        <label for="Kilo Lab Feedback"> Process Development Laboratory / Kilo Lab Feedback
                                            <!-- <span id="asteriskPDL2"
                                                style="display: {{ $data1->Kilo_Lab_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <textarea @if ($data1->Kilo_Lab_review == 'yes' && $data->stage == 4) required @endif class="summernote Analytical_Development_feedback"
                                            name="Kilo_Lab_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Kilo_Lab_person) readonly @endif id="summernote-30">{{ $data1->Kilo_Lab_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Kilo_Lab_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Kilo_Lab_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPDL');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 kilo_lab">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Process Development Laboratory / Kilo Lab
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Kilo_Lab_attachment">
                                                @if ($data1->Kilo_Lab_attachment)
                                                    @foreach (json_decode($data1->Kilo_Lab_attachment) as $file)
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
                                                    type="file" id="myfile" name="Kilo_Lab_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Kilo_Lab_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 kilo_lab">
                                    <div class="group-input">
                                        <label for="Kilo Lab Review Completed By">Process Development Laboratory / Kilo
                                            Lab Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Kilo_Lab_attachment_by }}"
                                            name="Kilo_Lab_attachment_by" id="Kilo_Lab_attachment_by">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 kilo_lab">
                                    <div class="group-input">
                                        <label for="Kilo Lab Review Completed On">Process Development Laboratory / Kilo
                                            Lab Review Completed On</label>
                                        <input type="date" id="Kilo_Lab_attachment_on"
                                            name="Kilo_Lab_attachment_on"
                                            value="{{ $data1->Kilo_Lab_attachment_on }}">

                                    </div>
                                </div>
                                <div class="sub-head">
                                    Technology Transfer / Design
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Technology_transfer_review !== 'yes')

                                        $('.technology_transfer').hide();

                                        $('[name="Technology_transfer_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.technology_transfer').show();
                                                $('.technology_transfer span').show();
                                            } else {
                                                $('.technology_transfer').hide();
                                                $('.technology_transfer span').hide();
                                            }
                                        });
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Design Review Required">Technology Transfer / Design Review Required ?
                                            <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Technology_transfer_review" id="Technology_transfer_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Technology_transfer_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Technology_transfer_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Technology_transfer_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 29, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 technology_transfer">
                                    <div class="group-input">
                                        <label for="Design Person"> Technology Transfer / Design Person <span
                                                id="asteriskTT"
                                                style="display: {{ $data1->Technology_transfer_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Technology_transfer_person" class="Technology_transfer_person"
                                            id="Technology_transfer_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Technology_transfer_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 technology_transfer">
                                    <div class="group-input">
                                        <label for="Impact Assessment7">Impact Assessment (By Technology Transfer /
                                            Design)
                                            <!-- <span id="asteriskTT1"
                                                style="display: {{ $data1->Technology_transfer_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <textarea @if ($data1->Technology_transfer_review == 'yes' && $data->stage == 4) required @endif class="summernote Technology_transfer_assessment"
                                            name="Technology_transfer_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->Technology_transfer_person) readonly @endif id="summernote-31">{{ $data1->Technology_transfer_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 technology_transfer">
                                    <div class="group-input">
                                        <label for="Design Feedback"> Technology Transfer / Design Feedback
                                            <!-- <span
                                                id="asteriskTT2"
                                                style="display: {{ $data1->Technology_transfer_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <textarea @if ($data1->Technology_transfer_review == 'yes' && $data->stage == 4) required @endif class="summernote Technology_transfer_feedback"
                                            name="Technology_transfer_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Technology_transfer_person) readonly @endif id="summernote-32">{{ $data1->Technology_transfer_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Technology_transfer_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Technology_transfer_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskTT');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 technology_transfer">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Technology Transfer / Design Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Technology_transfer_attachment">
                                                @if ($data1->Technology_transfer_attachment)
                                                    @foreach (json_decode($data1->Technology_transfer_attachment) as $file)
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
                                                    type="file" id="myfile"
                                                    name="Technology_transfer_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Technology_transfer_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 technology_transfer">
                                    <div class="group-input">
                                        <label for="productionfeedback">Technology Transfer / Design Review Completed
                                            By</label>
                                        <input disabled type="text" value="{{ $data1->Technology_transfer_by }}"
                                            name="Technology_transfer_by" id="Technology_transfer_by">


                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 technology_transfer">
                                    <div class="group-input">
                                        <label for="productionfeedback">Technology Transfer / Design Review Completed
                                            On</label>
                                        <input type="date" id="Technology_transfer_on"
                                            name="Technology_transfer_on"
                                            value="{{ $data1->Technology_transfer_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Environment, Health & Safety
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Environment_Health_review !== 'yes')

                                        $('.environmental_health').hide();

                                        $('[name="Environment_Health_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.environmental_health').show();
                                                $('.environmental_health span').show();
                                            } else {
                                                $('.environmental_health').hide();
                                                $('.environmental_health span').hide();
                                            }
                                        });
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Safety Review Required">Environment, Health & Safety Review Required ?
                                            <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Environment_Health_review" id="Environment_Health_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Environment_Health_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Environment_Health_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Environment_Health_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 30, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 environmental_health">
                                    <div class="group-input">
                                        <label for="Safety Person"> Environment, Health & Safety Person <span
                                                id="asteriskEH"
                                                style="display: {{ $data1->Environment_Health_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Environment_Health_Safety_person"
                                            class="Environment_Health_Safety_person"
                                            id="Environment_Health_Safety_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Environment_Health_Safety_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="Impact Assessment8">Impact Assessment (By Environment, Health &
                                            Safety)
                                            <!-- <span id="asteriskEH1"
                                                style="display: {{ $data1->Environment_Health_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <textarea @if ($data1->Environment_Health_review == 'yes' && $data->stage == 4) required @endif class="tiny" name="Health_Safety_assessment"
                                            @if ($data->stage == 3 || Auth::user()->id != $data1->Environment_Health_Safety_person) readonly @endif id="summernote-33">{{ $data1->Health_Safety_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="Safety Feedback">Environment, Health & Safety Feedback
                                            <!-- <span
                                                id="asteriskEH2"
                                                style="display: {{ $data1->Environment_Health_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <textarea @if ($data1->Environment_Health_review == 'yes' && $data->stage == 4) required @endif class="tiny" name="Health_Safety_feedback"
                                            id="summernote-34" @if ($data->stage == 3 || Auth::user()->id != $data1->Environment_Health_Safety_person) readonly @endif>{{ $data1->Health_Safety_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Environment_Health_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Environment_Health_Safety_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskEH');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 environmental_health">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Environment, Health & Safety Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Environment_Health_Safety_attachment">
                                                @if ($data1->Environment_Health_Safety_attachment)
                                                    @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $file)
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
                                                    type="file" id="myfile"
                                                    name="Environment_Health_Safety_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="Safety Review Completed By">Environment, Health & Safety Review
                                            Completed By</label>
                                        <input disabled type="text"
                                            value="{{ $data1->Environment_Health_Safety_by }}"
                                            name="Environment_Health_Safety_by" id="Environment_Health_Safety_by">


                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 environmental_health">
                                    <div class="group-input">
                                        <label for="Safety Review Completed On">Environment, Health & Safety Review
                                            Completed On</label>
                                        <input type="date" id="Environment_Health_Safety_on"
                                            name="Environment_Health_Safety_on"
                                            value="{{ $data1->Environment_Health_Safety_on }}">

                                    </div>
                                </div>
                                <div class="sub-head">
                                    Human Resource & Administration
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Human_Resource_review !== 'yes')

                                        $('.human_resources').hide();

                                        $('[name="Human_Resource_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.human_resources').show();
                                                $('.human_resources span').show();
                                            } else {
                                                $('.human_resources').hide();
                                                $('.human_resources span').hide();
                                            }
                                        });
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Human Resource & Administration Review Required
                                            ? <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Human_Resource_review" id="Human_Resource_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Human_Resource_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Human_Resource_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Human_Resource_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 31, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 human_resources">
                                    <div class="group-input">
                                        <label for="Customer notification"> Human Resource & Administration Person <span
                                                id="asteriskHR"
                                                style="display: {{ $data1->Human_Resource_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Human_Resource_person" class="Human_Resource_person"
                                            id="Human_Resource_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Human_Resource_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Human Resource &
                                            Administration )
                                            <!-- <span id="asteriskHR1"
                                                style="display: {{ $data1->Human_Resource_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <textarea @if ($data1->Human_Resource_review == 'yes' && $data->stage == 4) required @endif class="summernote Human_Resource_assessment"
                                            name="Human_Resource_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->Human_Resource_person) readonly @endif id="summernote-35">{{ $data1->Human_Resource_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="productionfeedback">Human Resource & Administration Feedback
                                            <!-- <span
                                                id="asteriskHR2"
                                                style="display: {{ $data1->Human_Resource_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <textarea @if ($data1->Human_Resource_review == 'yes' && $data->stage == 4) required @endif class="summernote Human_Resource_feedback"
                                            name="Human_Resource_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Human_Resource_person) readonly @endif id="summernote-36">{{ $data1->Human_Resource_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Human_Resource_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Human_Resource_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskHR');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 human_resources">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Human Resource & Administration Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Human_Resource_attachment">
                                                @if ($data1->Human_Resource_attachment)
                                                    @foreach (json_decode($data1->Human_Resource_attachment) as $file)
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
                                                    type="file" id="myfile" name="Human_Resource_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Human_Resource_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="Administration Review Completed By"> Human Resource & Administration
                                            Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Human_Resource_by }}"
                                            name="Human_Resource_by" id="Human_Resource_by">


                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 human_resources">
                                    <div class="group-input">
                                        <label for="Administration Review Completed On"> Human Resource & Administration
                                            Review Completed On</label>
                                        <input type="date" id="Environment_Health_Safety_on"
                                            name="Environment_Health_Safety_on"
                                            value="{{ $data1->Environment_Health_Safety_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Information Technology
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Information_Technology_review !== 'yes')

                                        $('.information_technology').hide();

                                        $('[name="Information_Technology_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.information_technology').show();
                                                $('.information_technology span').show();
                                            } else {
                                                $('.information_technology').hide();
                                                $('.information_technology span').hide();
                                            }
                                        });
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6 ">
                                    <div class="group-input">
                                        <label for="Information Technology Review Required"> Information Technology Review
                                            Required ? <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name=" Information_Technology_review" id=" Information_Technology_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Information_Technology_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Information_Technology_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Information_Technology_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 32, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 information_technology">
                                    <div class="group-input">
                                        <label for="Information Technology Person"> Information Technology Person <span
                                                id="asteriskITP"
                                                style="display: {{ $data1->Information_Technology_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name=" Information_Technology_person"
                                            class="Information_Technology_person" id=" Information_Technology_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Information_Technology_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 information_technology">
                                    <div class="group-input">
                                        <label for="Impact Assessment10">Impact Assessment (By Information Technology)
                                            <!-- <span id="asteriskITP"
                                                style="display: {{ $data1->Information_Technology_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <textarea @if ($data1->Information_Technology_review == 'yes' && $data->stage == 4) required @endif class="summernote Information_Technology_assessment"
                                            name="Information_Technology_assessment" @if ($data->stage == 3 || Auth::user()->id != $data1->Information_Technology_person) readonly @endif
                                            id="summernote-37">{{ $data1->Information_Technology_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 information_technology">
                                    <div class="group-input">
                                        <label for="Information Technology Feedback">Information Technology Feedback
                                            <!-- <span
                                                id="asteriskITP"
                                                style="display: {{ $data1->Information_Technology_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <textarea @if ($data1->Information_Technology_review == 'yes' && $data->stage == 4) required @endif class="summernote Information_Technology_feedback"
                                            name="Information_Technology_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Information_Technology_person) readonly @endif id="summernote-38">{{ $data1->Information_Technology_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Information_Technology_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Information_Technology_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskITP');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 information_technology">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Information Technology Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Information_Technology_attachment">
                                                @if ($data1->Information_Technology_attachment)
                                                    @foreach (json_decode($data1->Information_Technology_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    type="file" id="myfile"
                                                    name="Information_Technology_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Information_Technology_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 information_technology">
                                    <div class="group-input">
                                        <label for="Information Technology Review Completed By"> Information Technology
                                            Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Information_Technology_by }}"
                                            name="Information_Technology_by" id="Information_Technology_by">

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 information_technology">
                                    <div class="group-input">
                                        <label for="Information Technology Review Completed On">Information Technology
                                            Review Completed On</label>
                                        <input type="text" name="Information_Technology_on"
                                            id="Information_Technology_on"
                                            value={{ $data1->Information_Technology_on }}>
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Project Management
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        @if($data1->Project_management_review !== 'yes')

                                        $('.project_management').hide();

                                        $('[name="Project_management_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.project_management').show();
                                                $('.project_management span').show();
                                            } else {
                                                $('.project_management').hide();
                                                $('.project_management span').hide();
                                            }
                                        });
                                        @endif

                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Project management Review Required"> Project management Review
                                            Required ? <span class="text-danger">*</span></label>
                                        <select @if ($data->stage == 3) required @endif
                                            name="Project_management_review" id="Project_management_review"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Project_management_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Project_management_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Project_management_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 33, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 project_management">
                                    <div class="group-input">
                                        <label for="Project management Person"> Project management Person <span
                                                id="asteriskPMP"
                                                style="display: {{ $data1->Project_management_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Project_management_person" class="Project_management_person"
                                            id="Project_management_person"
                                            @if ($data->stage == 4) disabled @endif>
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Project_management_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 project_management">
                                    <div class="group-input">
                                        <label for="Impact Assessment11">Impact Assessment (By Project management )
                                            <!-- <span
                                                id="asteriskPMP"
                                                style="display: {{ $data1->Project_management_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <textarea @if ($data1->Project_management_review == 'yes' && $data->stage == 4) required @endif class="summernote Project_management_assessment"
                                            name="Project_management_assessment" id="summernote-39" @if ($data->stage == 3 || Auth::user()->id != $data1->Project_management_person) readonly @endif>{{ $data1->Project_management_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 project_management">
                                    <div class="group-input">
                                        <label for="Project management Feedback"> Project management Feedback
                                            <!-- <span
                                                id="asteriskPMP"
                                                style="display: {{ $data1->Project_management_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                class="text-danger">*</span> -->
                                            </label>
                                        <textarea @if ($data1->Project_management_review == 'yes' && $data->stage == 4) required @endif class="summernote Project_management_feedback"
                                            name="Project_management_feedback" @if ($data->stage == 3 || Auth::user()->id != $data1->Project_management_person) readonly @endif id="summernote-40">{{ $data1->Project_management_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Project_management_review');
                                        var inputsToToggle = [];

                                        // Add elements with class 'facility-name' to inputsToToggle
                                        var facilityNameInputs = document.getElementsByClassName('Project_management_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            // Show or hide the asterisk icon based on the selected value
                                            var asteriskIcon = document.getElementById('asteriskPMP');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 project_management">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Project management Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Project_management_attachment">
                                                @if ($data1->Project_management_attachment)
                                                    @foreach (json_decode($data1->Project_management_attachment) as $file)
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
                                                    type="file" id="myfile"
                                                    name="Project_management_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Project_management_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 project_management">
                                    <div class="group-input">
                                        <label for="Project management Review Completed By"> Project management Review
                                            Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Project_management_by }}"
                                            name="Project_management_by" id="Project_management_by">

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 project_management">
                                    <div class="group-input">
                                        <label for="Project management Review Completed On">Project management Review
                                            Completed On</label>
                                        <input type="date" name="Project_management_on" id="Project_management_on"
                                            value="{{ $data1->Project_management_on }}">
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control Review Required">Quality Control Review
                                            Required?</label>
                                        <select disabled name="Quality_review" id="Quality_review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Quality_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Quality_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Quality_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 24, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control Person">Quality Control Person</label>
                                        <select disabled name="Quality_Control_Person" id="Quality_Control_Person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Quality_Control_Person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment2">Impact Assessment (By Quality Control)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny"
                                            name="Quality_Control_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-21">{{ $data1->Quality_Control_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Quality Control Feedback">Quality Control Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny"
                                            name="Quality_Control_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-22">{{ $data1->Quality_Control_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Quality Control Attachments">Quality Control Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Quality_Control_attachment">
                                                @if ($data1->Quality_Control_attachment)
                                                    @foreach (json_decode($data1->Quality_Control_attachment) as $file)
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
                                                    type="file" id="myfile" name="Quality_Control_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Control_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Quality Control Review Completed By">Quality Control Review Completed
                                            By</label>
                                        <input disabled type="text" value="{{ $data1->Quality_Control_by }}"
                                            name="Quality_Control_by" id="Quality_Control_by">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Control Review Completed On">Quality Control Review Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input disabled type="date"id="Quality_Control_on" name="Quality_Control_on"
                                            value="{{ $data1->Quality_Control_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Quality Assurance
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Required">Quality Assurance Review Required
                                            ?</label>
                                        <select disabled name="Quality_Assurance_Review" id="Quality_Assurance_Review">
                                            <option @if ($data1->Quality_Assurance_Review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Quality_Assurance_Review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Quality_Assurance_Review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 26, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Assurance Person">Quality Assurance Person</label>
                                        <select disabled name="QualityAssurance_person" id="QualityAssurance_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->QualityAssurance_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment3">Impact Assessment (By Quality Assurance)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny"
                                            name="QualityAssurance_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-23">{{ $data1->QualityAssurance_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Quality Assurance Feedback">Quality Assurance Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny"
                                            name="QualityAssurance_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-24">{{ $data1->QualityAssurance_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Quality Assurance Attachments">Quality Assurance Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Quality_Assurance_attachment">
                                                @if ($data1->Quality_Assurance_attachment)
                                                    @foreach (json_decode($data1->Quality_Assurance_attachment) as $file)
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
                                                    type="file" id="myfile"
                                                    name="Quality_Assurance_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Completed By">Quality Assurance Review
                                            Completed By</label>
                                        <input disabled type="text" value="{{ $data1->QualityAssurance_by }}"
                                            name="QualityAssurance_by" id="QualityAssurance_by">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Quality Assurance Review Completed On">Quality Assurance Review
                                            Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input disabled type="date"id="QualityAssurance_on"
                                            name="QualityAssurance_on" value="{{ $data1->QualityAssurance_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Engineering
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Engineering Review Required ?</label>
                                        <select disabled name="Engineering_review" id="Engineering_review">
                                            <option value="">-- Select --</option>
                                            <option @if ($data1->Engineering_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Engineering_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Engineering_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 25, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Engineering Person</label>
                                        <select disabled name="Engineering_person" id="Engineering_person">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Engineering_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment4">Impact Assessment (By Engineering)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny"
                                            name="Engineering_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-25">{{ $data1->Engineering_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Engineering Feedback">Engineering Feedback</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="tiny" name="Engineering_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-26">{{ $data1->Engineering_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Engineering Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Engineering_attachment">
                                                @if ($data1->Engineering_attachment)
                                                    @foreach (json_decode($data1->Engineering_attachment) as $file)
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
                                                    type="file" id="myfile" name="Engineering_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Engineering_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Engineering Review Completed By">Engineering Review Completed
                                            By</label>
                                        <input disabled type="text" value="{{ $data1->Engineering_by }}"
                                            name="Engineering_by" id="Engineering_by">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Engineering Review Completed On">Engineering Review Completed
                                            On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input disabled type="date" id="Engineering_on" name="Engineering_on"
                                            value="{{ $data1->Engineering_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Analytical Development Laboratory
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Required">Analytical
                                            Development Laboratory Review Required ?</label>
                                        <select disabled name="Analytical_Development_review"
                                            id="Analytical_Development_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Analytical_Development_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Analytical_Development_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Analytical_Development_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 27, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Person"> Analytical Development
                                            Laboratory Person</label>
                                        <select disabled name="Analytical_Development_person"
                                            id="Analytical_Development_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Analytical_Development_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment5">Impact Assessment (By Analytical Development
                                            Laboratory)</label>
                                        <textarea class="tiny"
                                            name="Analytical_Development_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-27">{{ $data1->Analytical_Development_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Feedback"> Analytical Development
                                            Laboratory Feedback</label>
                                        <textarea class="tiny"
                                            name="Analytical_Development_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-28">{{ $data1->Analytical_Development_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Analytical Development Laboratory
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Analytical_Development_attachment">
                                                @if ($data1->Analytical_Development_attachment)
                                                    @foreach (json_decode($data1->Analytical_Development_attachment) as $file)
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
                                                    type="file" id="myfile"
                                                    name="Analytical_Development_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Analytical_Development_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Completed By">Analytical
                                            Development Laboratory Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Analytical_Development_by }}"
                                            name="Analytical_Development_by" id="Analytical_Development_by">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Analytical Development Laboratory Review Completed On">Analytical
                                            Development Laboratory Review Completed On</label>
                                        <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                        <input disabled type="date" id="Analytical_Development_on"
                                            name="Analytical_Development_on"
                                            value="{{ $data1->Analytical_Development_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Process Development Laboratory / Kilo Lab
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Process Development Laboratory"> Process Development Laboratory / Kilo
                                            Lab Review Required ?</label>
                                        <select disabled name="Kilo_Lab_review" id="Kilo_Lab_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Kilo_Lab_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Kilo_Lab_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Kilo_Lab_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 28, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Process Development Laboratory"> Process Development Laboratory / Kilo
                                            Lab Person</label>
                                        <select disabled name="Kilo_Lab_person" id="Kilo_Lab_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Kilo_Lab_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment6">Impact Assessment (By Process Development
                                            Laboratory / Kilo Lab)</label>
                                        <textarea class="tiny" name="Kilo_Lab_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-29">{{ $data1->Kilo_Lab_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Kilo Lab Feedback"> Process Development Laboratory / Kilo Lab
                                            Feedback</label>
                                        <textarea class="tiny" name="Kilo_Lab_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-30">{{ $data1->Kilo_Lab_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Process Development Laboratory / Kilo Lab
                                            Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Kilo_Lab_attachment">
                                                @if ($data1->Kilo_Lab_attachment)
                                                    @foreach (json_decode($data1->Kilo_Lab_attachment) as $file)
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
                                                    type="file" id="myfile" name="Kilo_Lab_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Kilo_Lab_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Kilo Lab Review Completed By">Process Development Laboratory / Kilo
                                            Lab Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Kilo_Lab_attachment_by }}"
                                            name="Kilo_Lab_attachment_by" id="Kilo_Lab_attachment_by">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Kilo Lab Review Completed On">Process Development Laboratory / Kilo
                                            Lab Review Completed On</label>
                                        <input disabled type="date" id="Kilo_Lab_attachment_on"
                                            name="Kilo_Lab_attachment_on"
                                            value="{{ $data1->Kilo_Lab_attachment_on }}">

                                    </div>
                                </div>
                                <div class="sub-head">
                                    Technology Transfer / Design
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Design Review Required">Technology Transfer / Design Review Required
                                            ?</label>
                                        <select disabled name="Technology_transfer_review"
                                            id="Technology_transfer_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Technology_transfer_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Technology_transfer_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Technology_transfer_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 29, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Design Person"> Technology Transfer / Design Person</label>
                                        <select disabled name="Technology_transfer_person"
                                            id="Technology_transfer_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Technology_transfer_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment7">Impact Assessment (By Technology Transfer /
                                            Design)</label>
                                        <textarea class="tiny"
                                            name="Technology_transfer_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-31">{{ $data1->Technology_transfer_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Design Feedback"> Technology Transfer / Design Feedback</label>
                                        <textarea class="tiny"
                                            name="Technology_transfer_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-32">{{ $data1->Technology_transfer_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Technology Transfer / Design Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Technology_transfer_attachment">
                                                @if ($data1->Technology_transfer_attachment)
                                                    @foreach (json_decode($data1->Technology_transfer_attachment) as $file)
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
                                                    type="file" id="myfile"
                                                    name="Technology_transfer_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Technology_transfer_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Technology Transfer / Design Review Completed
                                            By</label>
                                        <input disabled type="text" value="{{ $data1->Technology_transfer_by }}"
                                            name="Technology_transfer_by" id="Technology_transfer_by">


                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Technology Transfer / Design Review Completed
                                            On</label>
                                        <input disabled type="date" id="Technology_transfer_on"
                                            name="Technology_transfer_on"
                                            value="{{ $data1->Technology_transfer_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Environment, Health & Safety
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Safety Review Required">Environment, Health & Safety Review Required
                                            ?</label>
                                        <select disabled name="Environment_Health_review"
                                            id="Environment_Health_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Environment_Health_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Environment_Health_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Environment_Health_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 30, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Safety Person"> Environment, Health & Safety Person</label>
                                        <select disabled name="Environment_Health_Safety_person"
                                            id="Environment_Health_Safety_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Environment_Health_Safety_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment8">Impact Assessment (By Environment, Health &
                                            Safety)</label>
                                        <textarea class="tiny"
                                            name="Health_Safety_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-33">{{ $data1->Health_Safety_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Safety Feedback">Environment, Health & Safety Feedback</label>
                                        <textarea class="tiny"
                                            name="Health_Safety_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-34">{{ $data1->Health_Safety_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments"> Environment, Health & Safety Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Environment_Health_Safety_attachment">
                                                @if ($data1->Environment_Health_Safety_attachment)
                                                    @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $file)
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
                                                    type="file" id="myfile"
                                                    name="Environment_Health_Safety_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Safety Review Completed By">Environment, Health & Safety Review
                                            Completed By</label>
                                        <input disabled type="text"
                                            value="{{ $data1->Environment_Health_Safety_by }}"
                                            name="Environment_Health_Safety_by" id="Environment_Health_Safety_by">


                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Safety Review Completed On">Environment, Health & Safety Review
                                            Completed On</label>
                                        <input disabled type="date" id="Environment_Health_Safety_on"
                                            name="Environment_Health_Safety_on"
                                            value="{{ $data1->Environment_Health_Safety_on }}">

                                    </div>
                                </div>
                                <div class="sub-head">
                                    Human Resource & Administration
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification">Human Resource & Administration Review Required
                                            ?</label>
                                        <select disabled name="Human_Resource_review" id="Human_Resource_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Human_Resource_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Human_Resource_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Human_Resource_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 31, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Customer notification"> Human Resource & Administration Person</label>
                                        <select disabled name="Human_Resource_person" id="Human_Resource_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Human_Resource_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Impact Assessment (By Human Resource &
                                            Administration )</label>
                                        <textarea class="tiny"
                                            name="Human_Resource_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-35">{{ $data1->Human_Resource_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Human Resource & Administration Feedback</label>
                                        <textarea class="tiny"
                                            name="Human_Resource_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-36">{{ $data1->Human_Resource_feedback }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Human Resource & Administration Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Human_Resource_attachment">
                                                @if ($data1->Human_Resource_attachment)
                                                    @foreach (json_decode($data1->Human_Resource_attachment) as $file)
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
                                                <input {{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                    type="file" id="myfile" name="Human_Resource_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Human_Resource_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Administration Review Completed By"> Human Resource & Administration
                                            Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Human_Resource_by }}"
                                            name="Human_Resource_by" id="Human_Resource_by">


                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Administration Review Completed On"> Human Resource & Administration
                                            Review Completed On</label>
                                        <input type="date" id="Environment_Health_Safety_on"
                                            name="Environment_Health_Safety_on"
                                            value="{{ $data1->Environment_Health_Safety_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Information Technology
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Information Technology Review Required"> Information Technology Review
                                            Required ?</label>
                                        <select disabled name=" Information_Technology_review"
                                            id=" Information_Technology_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Information_Technology_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Information_Technology_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Information_Technology_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 32, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Information Technology Person"> Information Technology Person</label>
                                        <select disabled name=" Information_Technology_person"
                                            id=" Information_Technology_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Information_Technology_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment10">Impact Assessment (By Information
                                            Technology)</label>
                                        <textarea class="tiny"
                                            name="Information_Technology_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-37">{{ $data1->Information_Technology_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Information Technology Feedback">Information Technology
                                            Feedback</label>
                                        <textarea class="tiny"
                                            name="Information_Technology_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-38">{{ $data1->Information_Technology_feedback }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Information Technology Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Information_Technology_attachment">
                                                @if ($data1->Information_Technology_attachment)
                                                    @foreach (json_decode($data1->Information_Technology_attachment) as $file)
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
                                                    type="file" id="myfile"
                                                    name="Information_Technology_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Information_Technology_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Information Technology Review Completed By"> Information Technology
                                            Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Information_Technology_by }}"
                                            name="Information_Technology_by" id="Information_Technology_by">

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Information Technology Review Completed On">Information Technology
                                            Review Completed On</label>
                                        <input disabled type="text" name="Information_Technology_on"
                                            id="Information_Technology_on"
                                            value={{ $data1->Information_Technology_on }}>
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Project Management
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Project management Review Required"> Project management Review
                                            Required ?</label>
                                        <select disabled name="Project_management_review"
                                            id="Project_management_review">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Project_management_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Project_management_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Project_management_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>
                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_roles_id' => 33, 'q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Project management Person"> Project management Person</label>
                                        <select disabled name="Project_management_person"
                                            id="Project_management_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option
                                                    {{ $data1->Project_management_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment11">Impact Assessment (By Project management
                                            )</label>
                                        <textarea class="tiny"
                                            name="Project_management_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-39">{{ $data1->Project_management_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Project management Feedback"> Project management Feedback</label>
                                        <textarea class="tiny"
                                            name="Project_management_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="summernote-40">{{ $data1->Project_management_feedback }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Project management Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list"
                                                id="Project_management_attachment">
                                                @if ($data1->Project_management_attachment)
                                                    @foreach (json_decode($data1->Project_management_attachment) as $file)
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
                                                    type="file" id="myfile"
                                                    name="Project_management_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Project_management_attachment')"
                                                    multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Project management Review Completed By"> Project management Review
                                            Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Project_management_by }}"
                                            name="Project_management_by" id="Project_management_by">

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Project management Review Completed On">Project management Review
                                            Completed On</label>
                                        <input disabled type="date" name="Project_management_on"
                                            id="Project_management_on" value={{ $data1->Project_management_on }}>


                                    </div>
                                </div>
                            @endif
                            @if ($data->stage == 3 || $data->stage == 4)
                                <div class="sub-head">
                                    Other's 1 ( Additional Person Review From Departments If Required)
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.other1_reviews').hide();

                                        $('[name="Other1_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.other1_reviews').show();
                                                $('.other1_reviews span').show();
                                            } else {
                                                $('.other1_reviews').hide();
                                                $('.other1_reviews span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Review Required1"> Other's 1 Review Required? </label>
                                        <select name="Other1_review" @if ($data->stage == 4) disabled @endif
                                            id="Other1_review" value="{{ $data1->Other1_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other1_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other1_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other1_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 other1_reviews ">
                                    <div class="group-input">
                                        <label for="Person1"> Other's 1 Person <span id="asterisko1"
                                                style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other1_person" @if ($data->stage == 4) disabled @endif
                                            id="Other1_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other1_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 other1_reviews ">

                                    <div class="group-input">
                                        <label for="Department1"> Other's 1 Department <span id="asteriskod1"
                                                style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other1_Department_person"
                                            @if ($data->stage == 4) disabled @endif
                                            id="Other1_Department_person"
                                            value="{{ $data1->Other1_Department_person }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other1_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other1_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other1_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other1_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other1_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other1_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other1_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other1_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other1_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other1_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other1_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other1_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 other1_reviews ">
                                    <div class="group-input">
                                        <label for="Impact Assessment12">Impact Assessment (By Other's 1)
                                            </label>
                                        <textarea @if ($data1->Other1_review == 'yes' && $data->stage == 4) required @endif class="tiny" name="Other1_assessment"
                                            @if ($data->stage == 3 || Auth::user()->id != $data1->Other1_person) readonly @endif id="summernote-41">{{ $data1->Other1_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 other1_reviews ">
                                    <div class="group-input">
                                        <label for="Feedback1"> Other's 1 Feedback
                                            </label>
                                        <textarea @if ($data1->Other1_review == 'yes' && $data->stage == 4) required @endif class="tiny" name="Other1_feedback"
                                            @if ($data->stage == 3 || Auth::user()->id != $data1->Other1_person) readonly @endif id="summernote-42">{{ $data1->Other1_feedback }}</textarea>
                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Other1_review');
                                        var inputsToToggle = [];

                                        var facilityNameInputs = document.getElementsByClassName('Other1_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        var facilityNameInputs = document.getElementsByClassName('Other1_Department_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            var asteriskIcon = document.getElementById('asterisko1');
                                            var asteriskIcon1 = document.getElementById('asteriskod1');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            asteriskIcon1.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-12 other1_reviews ">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 1 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other1_attachment">
                                                @if ($data1->Other1_attachment)
                                                    @foreach (json_decode($data1->Other1_attachment) as $file)
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
                                                    type="file" id="myfile" name="Other1_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other1_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 other1_reviews ">
                                    <div class="group-input">
                                        <label for="Review Completed By1"> Other's 1 Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Other1_by }}"
                                            name="Other1_by" id="Other1_by">

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 other1_reviews ">
                                    <div class="group-input">
                                        <label for="Review Completed On1">Other's 1 Review Completed On</label>
                                        <input disabled type="date" name="Other1_on" id="Other1_on"
                                            value="{{ $data1->Other1_on }}">

                                    </div>
                                </div>
                                <div class="sub-head">
                                    Other's 2 ( Additional Person Review From Departments If Required)
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.Other2_reviews').hide();

                                        $('[name="Other2_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.Other2_reviews').show();
                                                $('.Other2_reviews span').show();
                                            } else {
                                                $('.Other2_reviews').hide();
                                                $('.Other2_reviews span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review2"> Other's 2 Review Required ?</label>
                                        <select name="Other2_review" @if ($data->stage == 4) disabled @endif
                                            id="Other2_review" value="{{ $data1->Other2_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other2_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other2_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other2_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Person2"> Other's 2 Person <span id="asterisko2"
                                                style="display: {{ $data1->Other2_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other2_person" @if ($data->stage == 4) disabled @endif
                                            id="Other2_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other2_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Department2"> Other's 2 Department <span id="asteriskod2"
                                                style="display: {{ $data1->Other2_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other2_Department_person"
                                            @if ($data->stage == 4) disabled @endif
                                            id="Other2_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other2_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other2_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other2_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other2_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other2_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other2_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other2_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other2_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other2_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other2_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other2_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other2_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>

                                        </select>

                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Other2_review');
                                        var inputsToToggle = [];

                                        var facilityNameInputs = document.getElementsByClassName('Other2_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        var facilityNameInputs = document.getElementsByClassName('Other2_Department_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            var asteriskIcon = document.getElementById('asterisko2');
                                            var asteriskIcon1 = document.getElementById('asteriskod2');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            asteriskIcon1.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-md-12 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment13">Impact Assessment (By Other's 2)
                                            </label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other2_person) readonly @endif class="tiny" name="Other2_Assessment"
                                            @if ($data1->Other2_review == 'yes' && $data->stage == 4) required @endif id="summernote-43">{{ $data1->Other2_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Feedback2"> Other's 2 Feedback
                                            </label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other2_person) readonly @endif class="tiny" name="Other2_feedback"
                                            @if ($data1->Other2_review == 'yes' && $data->stage == 4) required @endif id="summernote-44">{{ $data1->Other2_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 2 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other2_attachment">
                                                @if ($data1->Other2_attachment)
                                                    @foreach (json_decode($data1->Other2_attachment) as $file)
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
                                                    type="file" id="myfile" name="Other2_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other2_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By2"> Other's 2 Review Completed By</label>
                                        <input type="text" name="Other2_by" id="Other2_by"
                                            value="{{ $data1->Other2_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other2_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed On2">Other's 2 Review Completed On</label>
                                        <input disabled type="date" name="Other2_on" id="Other2_on"
                                            value="{{ $data1->Other2_on }}">
                                    </div>
                                </div>

                                <div class="sub-head">
                                    Other's 3 ( Additional Person Review From Departments If Required)
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.Other3_reviews').hide();

                                        $('[name="Other3_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.Other3_reviews').show();
                                                $('.Other3_reviews span').show();
                                            } else {
                                                $('.Other3_reviews').hide();
                                                $('.Other3_reviews span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review3"> Other's 3 Review Required ?</label>
                                        <select name="Other3_review" @if ($data->stage == 4) disabled @endif
                                            id="Other3_review" value="{{ $data1->Other3_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other3_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other3_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other3_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                        </select>

                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Person3">Other's 3 Person <span id="asterisko3"
                                                style="display: {{ $data1->Other3_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other3_person" @if ($data->stage == 4) disabled @endif
                                            id="Other3_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other3_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Department3">Other's 3 Department <span id="asteriskod3"
                                                style="display: {{ $data1->Other3_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other3_Department_person"
                                            @if ($data->stage == 4) disabled @endif
                                            id="Other3_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other3_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other3_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other3_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other3_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other3_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other3_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other3_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other3_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other3_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other3_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other3_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other3_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>
                                        </select>

                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Other3_review');
                                        var inputsToToggle = [];

                                        var facilityNameInputs = document.getElementsByClassName('Other3_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        var facilityNameInputs = document.getElementsByClassName('Other3_Department_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            var asteriskIcon = document.getElementById('asterisko3');
                                            var asteriskIcon1 = document.getElementById('asteriskod3');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            asteriskIcon1.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-md-12 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment14">Impact Assessment (By Other's 3)
                                            </label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other3_person) readonly @endif class="tiny" name="Other3_Assessment"
                                            @if ($data1->Other3_review == 'yes' && $data->stage == 4) required @endif id="summernote-45">{{ $data1->Other3_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="feedback3"> Other's 3 Feedback
                                            </label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other3_person) readonly @endif class="tiny" name="Other3_feedback"
                                            @if ($data1->Other3_review == 'yes' && $data->stage == 4) required @endif id="summernote-46">{{ $data1->Other3_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 Other3_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 3 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other3_attachment">
                                                @if ($data1->Other3_attachment)
                                                    @foreach (json_decode($data1->Other3_attachment) as $file)
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
                                                    type="file" id="myfile" name="Other3_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other3_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 3 Review Completed By</label>
                                        <input type="text" name="Other3_by" id="Other3_by"
                                            value="{{ $data1->Other3_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other3_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback">Other's 3 Review Completed On</label>
                                        <input disabled type="date" name="Other3_on" id="Other3_on"
                                            value="{{ $data1->Other3_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Other's 4 ( Additional Person Review From Departments If Required)
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.Other4_reviews').hide();

                                        $('[name="Other4_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.Other4_reviews').show();
                                                $('.Other4_reviews span').show();
                                            } else {
                                                $('.Other4_reviews').hide();
                                                $('.Other4_reviews span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review4">Other's 4 Review Required ?</label>
                                        <select name="Other4_review" @if ($data->stage == 4) disabled @endif
                                            id="Other4_review" value="{{ $data1->Other4_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other4_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other4_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other4_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Person4"> Other's 4 Person <span id="asterisko4"
                                                style="display: {{ $data1->Other4_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other4_person" @if ($data->stage == 4) disabled @endif
                                            id="Other4_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other4_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Department4"> Other's 4 Department <span id="asteriskod4"
                                                style="display: {{ $data1->Other4_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other4_Department_person"
                                            @if ($data->stage == 4) disabled @endif
                                            id="Other4_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other4_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other4_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other4_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other4_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other4_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other4_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other4_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other4_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other4_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other4_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other4_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other4_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>
                                        </select>

                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Other4_review');
                                        var inputsToToggle = [];

                                        var facilityNameInputs = document.getElementsByClassName('Other4_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        var facilityNameInputs = document.getElementsByClassName('Other4_Department_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            var asteriskIcon = document.getElementById('asterisko4');
                                            var asteriskIcon1 = document.getElementById('asteriskod4');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            asteriskIcon1.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-md-12 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment15">Impact Assessment (By Other's 4)
                                            </label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other4_person) readonly @endif class="tiny" name="Other4_Assessment"
                                            @if ($data1->Other4_review == 'yes' && $data->stage == 4) required @endif id="summernote-47">{{ $data1->Other4_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="feedback4"> Other's 4 Feedback
                                            </label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other4_person) readonly @endif class="tiny" name="Other4_feedback"
                                            @if ($data1->Other4_review == 'yes' && $data->stage == 4) required @endif id="summernote-48">{{ $data1->Other4_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 4 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other4_attachment">
                                                @if ($data1->Other4_attachment)
                                                    @foreach (json_decode($data1->Other4_attachment) as $file)
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
                                                    type="file" id="myfile" name="Other4_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other4_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By4"> Other's 4 Review Completed By</label>
                                        <input type="text" name="Other4_by" id="Other4_by"
                                            value="{{ $data1->Other4_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other4_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed On4">Other's 4 Review Completed On</label>
                                        <input disabled type="date" name="Other4_on" id="Other4_on"
                                            value="{{ $data1->Other4_on }}">

                                    </div>
                                </div>



                                <div class="sub-head">
                                    Other's 5 ( Additional Person Review From Departments If Required)
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('.Other5_reviews').hide();

                                        $('[name="Other5_review"]').change(function() {
                                            if ($(this).val() === 'yes') {
                                                $('.Other5_reviews').show();
                                                $('.Other5_reviews span').show();
                                            } else {
                                                $('.Other5_reviews').hide();
                                                $('.Other5_reviews span').hide();
                                            }
                                        });
                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review5">Other's 5 Review Required ?</label>
                                        <select name="Other5_review" @if ($data->stage == 4) disabled @endif
                                            id="Other5_review" value="{{ $data1->Other5_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other5_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other5_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other5_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Person5">Other's 5 Person
                                            <span id="asterisko5"
                                                style="display: {{ $data1->Other5_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span>
                                            </label>
                                        <select name="Other5_person" @if ($data->stage == 4) disabled @endif
                                            id="Other5_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other5_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Department5"> Other's 5 Department <span id="asteriskod5"
                                                style="display: {{ $data1->Other5_review == 'yes' ? 'inline' : 'none' }}"
                                                class="text-danger">*</span></label>
                                        <select name="Other5_Department_person"
                                            @if ($data->stage == 4) disabled @endif
                                            id="Other5_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other5_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other5_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other5_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other5_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other5_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other5_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other5_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other5_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other5_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other5_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other5_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other5_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>
                                        </select>

                                    </div>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectField = document.getElementById('Other5_review');
                                        var inputsToToggle = [];

                                        var facilityNameInputs = document.getElementsByClassName('Other5_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }
                                        var facilityNameInputs = document.getElementsByClassName('Other5_Department_person');
                                        for (var i = 0; i < facilityNameInputs.length; i++) {
                                            inputsToToggle.push(facilityNameInputs[i]);
                                        }

                                        selectField.addEventListener('change', function() {
                                            var isRequired = this.value === 'yes';

                                            inputsToToggle.forEach(function(input) {
                                                input.required = isRequired;
                                            });

                                            var asteriskIcon = document.getElementById('asterisko5');
                                            var asteriskIcon1 = document.getElementById('asteriskod5');
                                            asteriskIcon.style.display = isRequired ? 'inline' : 'none';
                                            asteriskIcon1.style.display = isRequired ? 'inline' : 'none';
                                        });
                                    });
                                </script>
                                <div class="col-md-12 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Impact Assessment16">Impact Assessment (By Other's 5)
                                            </label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other5_person) readonly @endif class="tiny"
                                            name="Other5_Assessment"@if ($data1->Other5_review == 'yes' && $data->stage == 4) required @endif id="summernote-49">{{ $data1->Other5_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 5 Feedback
                                            </label>
                                        <textarea @if ($data->stage == 3 || Auth::user()->id != $data1->Other5_person) readonly @endif class="tiny"
                                            name="Other5_feedback"@if ($data1->Other5_review == 'yes' && $data->stage == 4) required @endif id="summernote-50">{{ $data1->Other5_feedback }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 5 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other5_attachment">
                                                @if ($data1->Other5_attachment)
                                                    @foreach (json_decode($data1->Other5_attachment) as $file)
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
                                                    type="file" id="myfile" name="Other5_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other5_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed By5"> Other's 5 Review Completed By</label>
                                        <input type="text" name="Other5_by" id="Other5_by"
                                            value="{{ $data1->Other5_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 Other5_reviews">
                                    <div class="group-input">
                                        <label for="Review Completed On5">Other's 5 Review Completed On</label>
                                        <input disabled type="date" name="Other5_on" id="Other5_on"
                                            value="{{ $data1->Other5_on }}">
                                    </div>
                                </div>
                            @else
                                <div class="sub-head">
                                    Other's 1 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Review Required1"> Other's 1 Review Required? </label>
                                        <select disabled
                                            name="Other1_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other1_review" value="{{ $data1->Other1_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other1_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other1_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other1_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person1"> Other's 1 Person </label>
                                        <select disabled
                                            name="Other1_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other1_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other1_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department1"> Other's 1 Department</label>
                                        <select disabled
                                            name="Other1_Department_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other1_Department_person"
                                            value="{{ $data1->Other1_Department_person }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other1_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other1_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other1_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other1_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other1_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other1_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other1_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other1_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other1_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other1_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other1_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other1_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment12">Impact Assessment (By Other's 1)</label>
                                        <textarea disabled class="tiny"
                                            name="Other1_assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-41">{{ $data1->Other1_assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Feedback1"> Other's 1 Feedback</label>
                                        <textarea disabled class="tiny"
                                            name="Other1_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-42">{{ $data1->Other1_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 1 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other1_attachment">
                                                @if ($data1->Other1_attachment)
                                                    @foreach (json_decode($data1->Other1_attachment) as $file)
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
                                                    type="file" id="myfile" name="Other1_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other1_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed By1"> Other's 1 Review Completed By</label>
                                        <input disabled type="text" value="{{ $data1->Other1_by }}"
                                            name="Other1_by" id="Other1_by">

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed On1">Other's 1 Review Completed On</label>
                                        <input disabled type="date" name="Other1_on" id="Other1_on"
                                            value="{{ $data1->Other1_on }}">

                                    </div>
                                </div>

                                <div class="sub-head">
                                    Other's 2 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review2"> Other's 2 Review Required ?</label>
                                        <select disabled
                                            name="Other2_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other2_review" value="{{ $data1->Other2_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other2_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other2_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other2_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person2"> Other's 2 Person</label>
                                        <select disabled
                                            name="Other2_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other2_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other2_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department2"> Other's 2 Department</label>
                                        <select disabled
                                            name="Other2_Department_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other2_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other2_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other2_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other2_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other2_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other2_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other2_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other2_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other2_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other2_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other2_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other2_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other2_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>

                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment13">Impact Assessment (By Other's 2)</label>
                                        <textarea disabled ="summernote"
                                            name="Other2_Assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-43">{{ $data1->Other2_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Feedback2"> Other's 2 Feedback</label>
                                        <textarea disabled class="tiny"
                                            name="Other2_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-44">{{ $data1->Other2_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 2 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other2_attachment">
                                                @if ($data1->Other2_attachment)
                                                    @foreach (json_decode($data1->Other2_attachment) as $file)
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
                                                    type="file" id="myfile" name="Other2_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other2_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed By2"> Other's 2 Review Completed By</label>
                                        <input type="text" name="Other2_by" id="Other2_by"
                                            value="{{ $data1->Other2_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed On2">Other's 2 Review Completed On</label>
                                        <input disabled type="date" name="Other2_on" id="Other2_on"
                                            value="{{ $data1->Other2_on }}">
                                    </div>
                                </div>

                                <div class="sub-head">
                                    Other's 3 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review3"> Other's 3 Review Required ?</label>
                                        <select disabled
                                            name="Other3_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other3_review" value="{{ $data1->Other3_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other3_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other3_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other3_review == 'na') selected @endif value="na">
                                                NA</option>
                                        </select>

                                        </select>

                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person3">Other's 3 Person</label>
                                        <select disabled
                                            name="Other3_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other3_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other3_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department3">Other's 3 Department</label>
                                        <select disabled
                                            name="Other3_Department_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other3_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other3_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other3_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other3_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other3_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other3_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other3_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other3_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other3_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other3_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other3_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other3_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other3_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment14">Impact Assessment (By Other's 3)</label>
                                        <textarea disabled class="tiny"
                                            name="Other3_Assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-45">{{ $data1->Other3_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="feedback3"> Other's 3 Feedback</label>
                                        <textarea disabled class="tiny"
                                            name="Other3_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-46">{{ $data1->Other3_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 3 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other3_attachment">
                                                @if ($data1->Other3_attachment)
                                                    @foreach (json_decode($data1->Other3_attachment) as $file)
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
                                                    type="file" id="myfile" name="Other3_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other3_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 3 Review Completed By</label>
                                        <input type="text" name="Other3_by" id="Other3_by"
                                            value="{{ $data1->Other3_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback">Other's 3 Review Completed On</label>
                                        <input disabled type="date" name="Other3_on" id="Other3_on"
                                            value="{{ $data1->Other3_on }}">
                                    </div>
                                </div>
                                <div class="sub-head">
                                    Other's 4 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review4">Other's 4 Review Required ?</label>
                                        <select disabled
                                            name="Other4_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other4_review" value="{{ $data1->Other4_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other4_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other4_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other4_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>

                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->select('user_id')->distinct()
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person4"> Other's 4 Person</label>
                                        <select
                                            name="Other4_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other4_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other4_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department4"> Other's 4 Department</label>
                                        <select disabled
                                            name="Other4_Department_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other4_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other4_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other4_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other4_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other4_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other4_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other4_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other4_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other4_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other4_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other4_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other4_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other4_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment15">Impact Assessment (By Other's 4)</label>
                                        <textarea disabled class="tiny"
                                            name="Other4_Assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-47">{{ $data1->Other4_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="feedback4"> Other's 4 Feedback</label>
                                        <textarea disabled class="tiny"
                                            name="Other4_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-48">{{ $data1->Other4_feedback }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 4 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other4_attachment">
                                                @if ($data1->Other4_attachment)
                                                    @foreach (json_decode($data1->Other4_attachment) as $file)
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
                                                    type="file" id="myfile" name="Other4_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other4_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed By4"> Other's 4 Review Completed By</label>
                                        <input type="text" name="Other4_by" id="Other4_by"
                                            value="{{ $data1->Other4_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed On4">Other's 4 Review Completed On</label>
                                        <input disabled type="date" name="Other4_on" id="Other4_on"
                                            value="{{ $data1->Other4_on }}">

                                    </div>
                                </div>



                                <div class="sub-head">
                                    Other's 5 ( Additional Person Review From Departments If Required)
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="review5">Other's 5 Review Required ?</label>
                                        <select disabled
                                            name="Other5_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other5_review" value="{{ $data1->Other5_review }}">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other5_review == 'yes') selected @endif value="yes">
                                                Yes</option>
                                            <option @if ($data1->Other5_review == 'no') selected @endif value="no">
                                                No</option>
                                            <option @if ($data1->Other5_review == 'na') selected @endif value="na">
                                                NA</option>

                                        </select>

                                    </div>
                                </div>
                                @php
                                    $userRoles = DB::table('user_roles')
                                        ->where(['q_m_s_divisions_id' => $data->division_id])
                                        ->get();
                                    $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                    $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Person5">Other's 5 Person</label>
                                        <select disabled
                                            name="Other5_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other5_person">
                                            <option value="0">-- Select --</option>
                                            @foreach ($users as $user)
                                                <option {{ $data1->Other5_person == $user->id ? 'selected' : '' }}
                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Department5"> Other's 5 Department</label>
                                        <select disabled
                                            name="Other5_Department_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                            id="Other5_Department_person">
                                            <option value="0">-- Select --</option>
                                            <option @if ($data1->Other5_Department_person == 'Production') selected @endif
                                                value="Production">Production</option>
                                            <option @if ($data1->Other5_Department_person == 'Warehouse') selected @endif
                                                value="Warehouse"> Warehouse</option>
                                            <option @if ($data1->Other5_Department_person == 'Quality_Control') selected @endif
                                                value="Quality_Control">Quality Control</option>
                                            <option @if ($data1->Other5_Department_person == 'Quality_Assurance') selected @endif
                                                value="Quality_Assurance">Quality Assurance</option>
                                            <option @if ($data1->Other5_Department_person == 'Engineering') selected @endif
                                                value="Engineering">Engineering</option>
                                            <option @if ($data1->Other5_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                value="Analytical_Development_Laboratory">Analytical Development
                                                Laboratory</option>
                                            <option @if ($data1->Other5_Department_person == 'Process_Development_Lab') selected @endif
                                                value="Process_Development_Lab">Process Development Laboratory / Kilo Lab
                                            </option>
                                            <option @if ($data1->Other5_Department_person == 'Technology transfer/Design') selected @endif
                                                value="Technology transfer/Design"> Technology Transfer/Design</option>
                                            <option @if ($data1->Other5_Department_person == 'Environment, Health & Safety') selected @endif
                                                value="Environment, Health & Safety">Environment, Health & Safety</option>
                                            <option @if ($data1->Other5_Department_person == 'Human Resource & Administration') selected @endif
                                                value="Human Resource & Administration">Human Resource & Administration
                                            </option>
                                            <option @if ($data1->Other5_Department_person == 'Information Technology') selected @endif
                                                value="Information Technology">Information Technology</option>
                                            <option @if ($data1->Other5_Department_person == 'Project management') selected @endif
                                                value="Project management">Project management</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment16">Impact Assessment (By Other's 5)</label>
                                        <textarea disabled class="tiny"
                                            name="Other5_Assessment"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-49">{{ $data1->Other5_Assessment }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="productionfeedback"> Other's 5 Feedback</label>
                                        <textarea disabled class="tiny"
                                            name="Other5_feedback"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }} id="summernote-50">{{ $data1->Other5_feedback }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Audit Attachments">Other's 5 Attachments</label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting
                                                documents</small></div>
                                        <div class="file-attachment-field">
                                            <div disabled class="file-attachment-list" id="Other5_attachment">
                                                @if ($data1->Other5_attachment)
                                                    @foreach (json_decode($data1->Other5_attachment) as $file)
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
                                                    type="file" id="myfile" name="Other5_attachment[]"
                                                    oninput="addMultipleFiles(this, 'Other5_attachment')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed By5"> Other's 5 Review Completed By</label>
                                        <input type="text" name="Other5_by" id="Other5_by"
                                            value="{{ $data1->Other5_by }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="group-input">
                                        <label for="Review Completed On5">Other's 5 Review Completed On</label>
                                        <input disabled type="date" name="Other5_on" id="Other5_on"
                                            value="{{ $data1->Other5_on }}">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="button-block">
                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="submit"{{ $data->stage == 0 || $data->stage == 7 || $data->stage == 9 ? 'disabled' : '' }}
                                id="ChangesaveButton" class="saveButton saveAuditFormBtn d-flex"
                                style="align-items: center;">
                                <div class="spinner-border spinner-border-sm auditFormSpinner" style="display: none"
                                    role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                Save
                            </button>
                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                id="ChangeNextButton" class="nextButton">Next</button>
                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                                    @if ($data->stage == 2 || $data->stage == 3 || $data->stage == 4 || $data->stage == 5 || $data->stage == 6 || $data->stage == 7 )
                                    <a style="  justify-content: center; width: 10rem; margin-left: 1px;;" type="button"
                                            class="button  launch_extension" data-bs-toggle="modal"
                                            data-bs-target="#launch_extension">
                                            Launch Extension
                                        </a>
                                        @endif
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
                            <input type="comment" name="comments">
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
                            <label for="minor">
                                <input type="radio" name="revision" id="minor" value="Extension">
                                Extension
                            </label>
                            @if($data->stage == 3)
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="RCA">
                                    RCA
                                </label>
                            @endif
                            @if($data->stage == 6)
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Capa">
                                    Capa
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


    <!-- /************ Open State Modal ***********/ -->
    <div class="modal fade" id="opened-state-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-initiator', $cc_lid) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <input type="comment" class="form-control" name="comments" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /************ Open State Modal ***********/ -->

    <!-- /************ Initial QA Modal ***********/ -->
    <div class="modal fade" id="initalQA-review-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-initialQA', $cc_lid) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <input type="comment" class="form-control" name="comments" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /************ Initial QA Modal ***********/ -->

    <!-- /************ CFT from QA Modal ***********/ -->
    <div class="modal fade" id="send-cft-from-QA-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-cft-from-QA', $cc_lid) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <input type="comment" class="form-control" name="comments" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /************ CFT from QA Modal ***********/ -->


    <!-- /************ HOD Modal ***********/ -->
    <div class="modal fade" id="hod-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-hod', $cc_lid) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 text-justify">
                            Please select a meaning and a outcome for this task and enter your username
                            and password for this task. You are performing an electronic signature,
                            which is legally binding equivalent of a hand written signature.
                        </div>
                        <div class="group-input">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="group-input">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="group-input">
                            <label for="comment">Comment <span class="text-danger">*</span></label>
                            <input type="comment" class="form-control" name="comments" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /************ HOD Modal ***********/ -->


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
                            <input type="comment" name="comments" required>
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
                            <input type="comment" name="comments">
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
                            <input type="comment" name="comments">
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
            ele: '#related_records, #cft_reviewer, #risk_assessment_related_record'
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                    <script>
                                        $(document).ready(function() {
                                            // Event listener for the remove file button
                                            $(document).on('click', '.remove-file', function() {
                                                $(this).closest('.file-container').remove();
                                            });
                                        });
                                    </script>
                                    
    <script>

        document.addEventListener('DOMContentLoaded', function() {
        const removeButtons = document.querySelectorAll('.remove-file');

        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const fileName = this.getAttribute('data-file-name');
                const fileContainer = this.parentElement;

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
        $(document).on('click', '.removeRowBtn', function() {
            $(this).closest('tr').remove();
        })
    </script>
    <script>
        // JavaScript
        document.getElementById('initiator_group').addEventListener('change', function() {
            var selectedValue = this.value;
            document.getElementById('initiator_group_code').value = selectedValue;
        });
    </script>
    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>
@endsection
