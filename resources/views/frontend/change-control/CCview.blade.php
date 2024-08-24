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

                        @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            {{--  <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>  --}}
                        @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                HOD Assessment Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                                Cancel
                            </button>
                        @elseif($data->stage == 3 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA Initial Assessment Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                        @elseif($data->stage == 4 && (in_array(5, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                CFT Assessment Complete
                                
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                        @elseif($data->stage == 5 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                RA Review Required
                            </button>
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
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#qa-head-approval">
                                QA Final Review Complete
                            </button>
                        @elseif($data->stage == 6 && (in_array(18, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                RA Approval Complete
                            </button>
                        @elseif($data->stage == 7 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#send-post-implementation">
                                Approved
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#qa-head-approval">
                                Rejected
                            </button>
                        @elseif ($data->stage == 9 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#send-post-implementation">
                                Initiator Updated Completed
                            </button>
                            {{--  <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Info Required
                            </button>  --}}

                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal-stage_8">
                                Child
                            </button>
                        @elseif ($data->stage == 10 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#send-post-implementation">
                                HOD Final Review Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>

                        @elseif ($data->stage == 11 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#send-post-implementation">
                                Send For Final QA Head Approval
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button>    

                            @elseif ($data->stage == 12 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#send-post-implementation">
                                Closure Approved
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#rejection-modal">
                                More Information Required
                            </button> 
                            
                            @elseif ($data->stage == 13 && (in_array(9, $userRoleIds) || in_array(18, $userRoleIds)))
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child_effective_ness">
                                Child
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
                    @elseif($data->stage == 8)
                        <div class="progress-bars">
                            <div class="bg-danger">Closed - Rejected</div>
                        </div>
                    @else
                        <div class="progress-bars">
                            @if ($data->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif
                            @if ($data->stage >= 2)
                                <div class="active">HOD Assessment</div>
                            @else
                                <div class="">HOD Assessment</div>
                            @endif
                            @if ($data->stage >= 3)
                                <div class="active">QA Initial Assessment</div>
                            @else
                                <div class="">QA Initial Assessment</div>
                            @endif
                            @if ($data->stage >= 4)
                                <div class="active">CFT Assessment</div>
                            @else
                                <div class="">CFT Assessment</div>
                            @endif
                            @if ($data->stage >= 5)
                                <div class="active">QA Final Review</div>
                            @else
                                <div class="">QA Final Review</div>
                            @endif
                            @if ($data->stage >= 6)
                                <div class="active">Pending RA Review</div>
                            @else
                                <div class="">Pending RA Review</div>
                            @endif
                            @if ($data->stage >= 7)
                                <div class="active">QA Head/Manager Designee Approval</div>
                            @else
                                <div class="">QA Head/Manager Designee Approval</div>
                            @endif

                            @if ($data->stage >= 9)
                                <div class="active" @if($data->stage == 8) style="display: none" @endif>Pending Initiator Update</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>Pending Initiator Update</div>
                            @endif

                            @if ($data->stage >= 10)
                                <div class="active" @if($data->stage == 8) style="display: none" @endif>HOD Final Review</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>HOD Final Review</div>
                            @endif

                            @if ($data->stage >= 11)
                                <div class="active" @if($data->stage == 8) style="display: none" @endif>Implementation Verification by QA</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>Implementation Verification by QA</div>
                            @endif

                            @if ($data->stage >= 12)
                                <div class="active" @if($data->stage == 8) style="display: none" @endif>QA Closure Approval</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>QA Closure Approval</div>
                            @endif



                            @if ($data->stage >= 13)
                                <div class="active bg-danger" @if($data->stage == 8) style="display: none" @endif>Closed - Done</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>Closed - Done</div>
                            @endif

                            

                            <!-- @if ($data->stage >= 9)
                                <div class="active" @if($data->stage == 8) style="display: none" @endif>Post Implementation</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>Post Implementation</div>
                            @endif

                            @if ($data->stage >= 10)
                                <div class="active" @if($data->stage == 8) style="display: none" @endif>QA Closure Approval</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>QA Closure Approval</div>
                            @endif

                            @if ($data->stage >= 11)
                                <div class="active bg-danger" @if($data->stage == 8) style="display: none" @endif>Closed - Done</div>
                            @else
                                <div class="" @if($data->stage == 8) style="display: none" @endif>Closed - Done</div>
                            @endif -->
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
                        <input type="hidden" name="stage" id="stage" value="{{ $data->stage }}" >

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
                                                        @if($data->stage == 3)
                                                            <input type="hidden" name="record_number"  value="{{ Helpers::getDivisionName($data->division_id) }}/CC/{{ date('Y') }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}">
                                                        @endif
                                                        @if($data->record_number != null)
                                                            <input type="text" placeholder="{{ $data->record_number }}" readonly >
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
                                                    <div class="static"><input disabled type="text" value="{{ Helpers::getdateFormat($data->intiation_date) }}"></div>
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
                                                        <option value="">-- Select --</option>
                                                        <option value="yes" selected>Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                            </div> -->

                                            
                                            <div class="col-md-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <label for="due-date">Due Date <span class="text-danger"></span></label>
                                                    <div class="calenderauditee">
                                                        @if($data->due_date != null)
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
                                                            @if ($data->Initiator_Group == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                                        <option value="QA"
                                                            @if ($data->Initiator_Group == 'QA') selected @endif>Quality Assurance</option>
                                                        <option value="QC"
                                                            @if ($data->Initiator_Group == 'QC') selected @endif>Quality Control</option>
                                                        <option value="QM"
                                                            @if ($data->Initiator_Group == 'QM') selected @endif>Quality Control (Microbiology department)
                                                        </option>
                                                        <option value="PG"
                                                            @if ($data->Initiator_Group == 'PG') selected @endif>Production General</option>
                                                        <option value="PL"
                                                            @if ($data->Initiator_Group == 'PL') selected @endif>Production Liquid Orals</option>
                                                        <option value="PT"
                                                            @if ($data->Initiator_Group == 'PT') selected @endif>Production Tablet and Powder</option>
                                                        <option value="PE"
                                                            @if ($data->Initiator_Group == 'PE') selected @endif>Production External (Ointment, Gels, Creams and Liquid)</option>
                                                        <option value="PC"
                                                            @if ($data->Initiator_Group == 'PC') selected @endif>Production Capsules</option>
                                                        <option value="PI"
                                                            @if ($data->Initiator_Group == 'PI') selected @endif>Production Injectable</option>
                                                        <option value="EN"
                                                            @if ($data->Initiator_Group == 'EN') selected @endif>Engineering</option>
                                                        <option value="HR"
                                                            @if ($data->Initiator_Group == 'HR') selected @endif>Human Resource</option>
                                                        <option value="ST"
                                                            @if ($data->Initiator_Group == 'ST') selected @endif>Store</option>
                                                        <option value="IT"
                                                            @if ($data->Initiator_Group == 'IT') selected @endif>Electronic Data Processing
                                                        </option>
                                                        <option value="FD"
                                                            @if ($data->Initiator_Group == 'FD') selected @endif>Formulation  Development
                                                        </option>
                                                        <option value="AL"
                                                            @if ($data->Initiator_Group == 'AL') selected @endif>Analytical research and Development Laboratory
                                                        </option>
                                                        <option value="PD"
                                                            @if ($data->Initiator_Group == 'PD') selected @endif>Packaging Development
                                                        </option>

                                                        <option value="PU"
                                                            @if ($data->Initiator_Group == 'PU') selected @endif>Purchase Department
                                                        </option>
                                                        <option value="DC"
                                                            @if ($data->Initiator_Group == 'DC') selected @endif>Document Cell
                                                        </option>
                                                        <option value="RA"
                                                            @if ($data->Initiator_Group == 'RA') selected @endif>Regulatory Affairs
                                                        </option>
                                                        <option value="PV"
                                                            @if ($data->Initiator_Group == 'PV') selected @endif>Pharmacovigilance
                                                        </option>
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


                                                    <input name="short_description" id="docname" type="text" maxlength="255" required type="text"
                                                        {{ $data->stage == 0 || $data->stage == 8 ? 'disabled' : '' }} value="{{ $data->short_description }}">
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
                                                    <select name="doc_change">
                                                        <option value="">-- Select --</option>
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
                                                        <option value="">-- Select --</option>
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
                                            @if ($data->in_attachment)
                                                @foreach (json_decode($data->in_attachment) as $file)
                                                    <input id="initialFile-{{ $loop->index }}" type="hidden"
                                                        name="existing_initial_files[{{ $loop->index }}]"
                                                        value="{{ $file }}">
                                                @endforeach
                                            @endif

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
                                                                            data-remove-id="initialFile-{{ $loop->index }}"
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
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
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
                                                    <textarea name="risk_identification">{{ $data->risk_identification }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="severity">Severity</label>
                                                    <select name="severity" id="analysisR"
                                                        onchange='calculateRiskAnalysis(this)'>
                                                        <option value="">-- Select --</option>
                                                        <option {{ $data->severity == '1' ? 'selected' : '' }}
                                                            value="1">Negligible</option>
                                                        <option {{ $data->severity == '2' ? 'selected' : '' }}
                                                            value="2">Minor</option>
                                                        <option {{ $data->severity == '3' ? 'selected' : '' }}
                                                            value="3">Moderate</option>
                                                        <option {{ $data->severity == '4' ? 'selected' : '' }}
                                                            value="4">Major</option>
                                                        <option {{ $data->severity == '5' ? 'selected' : '' }}
                                                            value="5">Fatel</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Occurance">Occurance</label>
                                                    <select name="Occurance" id="analysisP"
                                                        onchange='calculateRiskAnalysis(this)'>
                                                        <option value="">-- Select --</option>
                                                        <option {{ $data->Occurance == '5' ? 'selected' : '' }}
                                                            value="5">Extremely Unlikely</option>
                                                        <option {{ $data->Occurance == '4' ? 'selected' : '' }}
                                                            value="4">Rare</option>
                                                        <option {{ $data->Occurance == '3' ? 'selected' : '' }}
                                                            value="3">Unlikely</option>
                                                        <option {{ $data->Occurance == '2' ? 'selected' : '' }}
                                                            value="2">Likely</option>
                                                        <option {{ $data->Occurance == '1' ? 'selected' : '' }}
                                                            value="1">Very Likely</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Detection">Detection</label>
                                                    <select name="Detection" id="analysisN"
                                                        onchange='calculateRiskAnalysis(this)'>
                                                        <option value="">-- Select --</option>
                                                        <option {{ $data->Detection == '4' ? 'selected' : '' }}
                                                            value="4">Impossible</option>
                                                        <option {{ $data->Detection == '3' ? 'selected' : '' }}
                                                            value="3">Rare</option>
                                                        <option {{ $data->Detection == '2' ? 'selected' : '' }}
                                                            value="2">Unlikely</option>
                                                        <option {{ $data->Detection == '1' ? 'selected' : '' }}
                                                            value="1">Likely</option>
                                                        {{-- <option  {{   $data ->Detection=='Very-Likely'? 'selected' : ''}} value="Very-Likely">Very Likely</option> --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="RPN">RPN</label>
                                                    <input type="text" name="RPN" id="analysisRPN"
                                                        value="{{ $data->RPN }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="risk-evaluation">Risk Evaluation</label>
                                                    <textarea name="risk_evaluation">{{ $data->risk_evaluation }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="group-input">
                                                    <label for="migration-action">Mitigation Action</label>
                                                    <textarea name="migration_action">{{ $data->migration_action }}</textarea>
                                                </div>
                                            </div>

                                            @if ($data->risk_assessment_atch)
                                                @foreach (json_decode($data->risk_assessment_atch) as $file)
                                                    <input id="riskAssessmentFile-{{ $loop->index }}" type="hidden"
                                                        name="existinRiskAssessmentFile[{{ $loop->index }}]"
                                                        value="{{ $file }}">
                                                @endforeach
                                            @endif
                                            <div class="group-input">
                                                <label for="tran-attach">Risk Assessment Attachment</label>
                                                <div class="file-attachment-field">
                                                    <div class="file-attachment-list" id="risk_assessment_atch">
                                                        @if ($data->risk_assessment_atch)
                                                            @foreach (json_decode($data->risk_assessment_atch) as $file)
                                                                <h6 type="button" class="file-container text-dark"
                                                                    style="background-color: rgb(243, 242, 240);">
                                                                    <b>{{ $file }}</b>
                                                                    <a href="{{ asset('upload/' . $file) }}"
                                                                        target="_blank"><i class="fa fa-eye text-primary"
                                                                            style="font-size:20px; margin-right:-10px;"></i></a>
                                                                    <a type="button" class="remove-file"                                                                    
                                                                            data-remove-id="riskAssessmentFile-{{ $loop->index }}"
                                                                            data-file-name="{{ $file }}"><i
                                                                            class="fa-solid fa-circle-xmark"
                                                                            style="color:red; font-size:20px;"></i></a>
                                                                </h6>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="add-btn">
                                                        <div>Add</div>
                                                        <input type="file" id="myfile" name="risk_assessment_atch[]"
                                                            oninput="addMultipleFiles(this, 'risk_assessment_atch')" multiple>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
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
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
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
                                                    @if ($data->HOD_attachment)
                                                        @foreach (json_decode($data->HOD_attachment) as $file)
                                                            <input id="hodAttachmentFile-{{ $loop->index }}" type="hidden"
                                                                name="existinHodFile[{{ $loop->index }}]"
                                                                value="{{ $file }}">
                                                        @endforeach
                                                    @endif
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
                                                                                data-remove-id="hodAttachmentFile-{{ $loop->index }}"
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
                                                    @if ($data->HOD_attachment)
                                                        @foreach (json_decode($data->HOD_attachment) as $file)
                                                            <input id="hodAttachmentFile-{{ $loop->index }}" type="hidden"
                                                                name="existinHodFile[{{ $loop->index }}]"
                                                                value="{{ $file }}">
                                                        @endforeach
                                                    @endif
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
                                                                                    data-remove-id="hodAttachmentFile-{{ $loop->index }}"
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
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                class="nextButton" onclick="nextStep()">Next</button>
                                            <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                                    Exit
                                                </a>
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
                                                        <option value="">-- Select --</option>
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
                                                    <select multiple name="cft_reviewer[]"
                                                        placeholder="Select CFT Reviewers" data-search="false"
                                                        data-silent-initial-value-set="true" id="cft_reviewer">
                                                        <!-- <option value="">-- Select --</option> -->
                                                        @foreach ($cft as $data1)
                                                            @if (Helpers::checkUserRolesMicrobiology_Person($data1))
                                                                @if (in_array($data1->id, $cftReviewerIds))
                                                                    <option value="{{ $data1->id }}" {{ in_array($data1->id, $cftReviewerIds) ? 'selected' : '' }}>
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
                                                            <option value="{{ $prix->id }}" {{ in_array($prix->id, $previousRelated) ? 'selected' : '' }}>
                                                                {{ Helpers::getDivisionName($prix->division_id) }}/Change-Control/{{ Helpers::year($prix->created_at) }}/{{ Helpers::record($prix->record) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            @if ($data->qa_head)
                                                @foreach (json_decode($data->qa_head) as $file)
                                                    <input id="QaAttachmentFile-{{ $loop->index }}" type="hidden"
                                                        name="existinQAFile[{{ $loop->index }}]"
                                                        value="{{ $file }}">
                                                @endforeach
                                            @endif
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
                                                                            data-remove-id="QaAttachmentFile-{{ $loop->index }}"
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
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div id="CCForm11" class="inner-block cctabcontent">
                                    <div class="inner-block-content">
                                        <div class="row">

                                            <div class="sub-head">
                                                RA Review
                                            </div>
                                            @php
                                                $data1 = DB::table('cc_cfts')
                                                    ->where('cc_id', $data->id)
                                                    ->first();
                                            @endphp

                                                <script>
                                                $(document).ready(function() {
                                         
                                                   @if($data1->RA_Review!=='yes')
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
                                                        @endif
                                                    });
                                                </script>
                                        

                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="RA Review"> RA Review Required ? <span class="text-danger">*</span></label>
                                                    <select name="RA_Review" id="RA_Review">
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
                                                        'q_m_s_roles_id' => 50,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 ra_review">
                                                <div class="group-input">
                                                    <label for="RA notification">RA Person <span id="asteriskRA"
                                                            style="display: {{ $data1->RA_Review == 'yes' ? 'inline' : 'none' }}" class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="RA_person" class="RA_person"
                                                        id="RA_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->RA_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 ra_review">
                                                <div class="group-input">
                                                    <label for="RA assessment">Impact Assessment (By RA) <span id="asteriskRA1"
                                                            style="display: {{ $data1->RA_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->RA_Review == 'yes' && $data->stage == 4) required @endif class="summernote RA_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->RA_person) && Auth::user()->name != $data1->RA_person)) readonly @endif name="RA_assessment" id="summernote-17">{{ $data1->RA_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 ra_review">
                                                <div class="group-input">
                                                    <label for="RA feedback">RA Feedback <span id="asteriskRA2"
                                                            style="display: {{ $data1->RA_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote RA_feedback" @if ($data->stage == 3 || (isset($data1->RA_person) && Auth::user()->name != $data1->RA_person)) readonly @endif name="RA_feedback"
                                                        id="summernote-18" @if ($data1->RA_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->RA_feedback }}</textarea>
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
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
                                                        name="RA_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }} id="RA_by">


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
                                                    <select name="RA_Review" id="RA_Review" disabled>
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
                                                        'q_m_s_roles_id' => 50,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 ra_review">
                                                <div class="group-input">
                                                    <label for="RA notification">RA Person <span id="asteriskInvi11" style="display: none"
                                                            class="text-danger">*</span></label>
                                                    <select name="RA_person" disabled id="RA_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->RA_person) selected @endif>
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
                                                                id="myfile" name="RA_attachment[]" oninput="addMultipleFiles(this, 'RA_attachment')"
                                                                multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 ra_review">
                                                <div class="group-input">
                                                    <label for="RA Review Completed By">RA Review Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->RA_by }}" name="RA_by" id="RA_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 ra_review">
                                                <div class="group-input">
                                                    <label for="RA Review Completed On">RA Review Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date"id="RA_on" name="RA_on" value="{{ $data1->RA_on }}">
                                                </div>
                                            </div>
                                        @endif



                                        <div class="sub-head">
                                            Quality Assurance
                                        </div>
                                      
                                        <script>
                                            $(document).ready(function() {

                                                @if($data1->Quality_Assurance_Review!=='yes')
                                                $('.QualityAssurance').hide();

                                                $('[name="Quality_Assurance_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.QualityAssurance').show();
                                                        $('.QualityAssurance span').show();
                                                    } else {
                                                        $('.QualityAssurance').hide();
                                                        $('.QualityAssurance span').hide();
                                                    }
                                                });
                                                @endif
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
                                                    <label for="Quality Assurance"> Quality Assurance Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Quality_Assurance_Review" id="Quality_Assurance_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Quality_Assurance_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Quality_Assurance_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Quality_Assurance_Review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 26,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance notification">Quality Assurance Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Quality_Assurance_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="QualityAssurance_person"
                                                        class="QualityAssurance_person" id="QualityAssurance_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->QualityAssurance_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance assessment">Impact Assessment (By Quality Assurance) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 4) required @endif class="summernote QualityAssurance_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->QualityAssurance_person) && Auth::user()->name != $data1->QualityAssurance_person)) readonly @endif 
                                                        name="QualityAssurance_assessment" id="summernote-17">{{ $data1->QualityAssurance_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance feedback">Quality Assurance Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Quality_Assurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote QualityAssurance_feedback" @if ($data->stage == 3 || (isset($data1->QualityAssurance_person) && Auth::user()->name != $data1->QualityAssurance_person)) readonly @endif
                                                        name="QualityAssurance_feedback" id="summernote-18" @if ($data1->Quality_Assurance_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->QualityAssurance_feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance attachment">Quality Assurance Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Quality_Assurance_attachment">
                                                            @if ($data1->Quality_Assurance_attachment)
                                                                @foreach (json_decode($data1->Quality_Assurance_attachment) as $file)
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Quality_Assurance_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance Completed By">Quality Assurance Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->QualityAssurance_by }}"
                                                        name="QualityAssurance_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="QualityAssurance_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 QualityAssurance">
                                                <div class="group-input ">
                                                    <label for="Quality Assurance Completed On">Quality Assurance Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input type="date"id="QualityAssurance_on"
                                                        name="QualityAssurance_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        value="{{ $data1->QualityAssurance_on }}">
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
                                                    <label for="Quality Assurance">Quality Assurance Required ?</label>
                                                    <select name="Quality_Assurance_Review" id="Quality_Assurance_Review"  disabled>
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Quality_Assurance_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Quality_Assurance_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Quality_Assurance_Review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 26,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance notification">Quality Assurance Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="QualityAssurance_person" disabled id="QualityAssurance_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->QualityAssurance_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 QualityAssurance">
                                                    <div class="group-input">
                                                        <label for="Quality Assurance assessment">Impact Assessment (By Quality Assurance)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="QualityAssurance_assessment" id="summernote-17">{{ $data1->QualityAssurance_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 QualityAssurance">
                                                    <div class="group-input">
                                                        <label for="Quality Assurance feedback">Quality Assurance Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="QualityAssurance_feedback" id="summernote-18">{{ $data1->QualityAssurance_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3 QualityAssurance">
                                                    <div class="group-input">
                                                        <label for="Quality Assurance assessment">Impact Assessment (By Quality Assurance)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="QualityAssurance_assessment" id="summernote-17">{{ $data1->QualityAssurance_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 QualityAssurance">
                                                    <div class="group-input">
                                                        <label for="Quality Assurance feedback">Quality Assurance Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="QualityAssurance_feedback" id="summernote-18">{{ $data1->QualityAssurance_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance attachment">Quality Assurance Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Quality_Assurance_attachment">
                                                            @if ($data1->Quality_Assurance_attachment)
                                                                @foreach (json_decode($data1->Quality_Assurance_attachment) as $file)
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
                                                                id="myfile" name="Quality_Assurance_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance Completed By">Quality Assurance Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->QualityAssurance_by }}"
                                                        name="QualityAssurance_by" id="QualityAssurance_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 QualityAssurance">
                                                <div class="group-input">
                                                    <label for="Quality Assurance Completed On">Quality Assurance Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date" id="QualityAssurance_on" name="QualityAssurance_on"
                                                        value="{{ $data1->QualityAssurance_on }}">
                                                </div>
                                            </div>  
                                        @endif


                                        <div class="sub-head">
                                            Production (Tablet/Capsule/Powder)
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Production_Table_Review!=='yes')
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
                                                @endif
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
                                                    <label for="Production Tablet"> Production Tablet Required ? <span class="text-danger">*</span></label>
                                                    <select name="Production_Table_Review" id="Production_Table_Review">
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
                                                        'q_m_s_roles_id' => 51,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet notification">Production Tablet Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Production_Table_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Production_Table_Person"
                                                        class="Production_Table_Person" id="Production_Table_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Production_Table_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet assessment">Impact Assessment (By Production Tablet) <span id="asteriskPT1"
                                                            style="display: {{ $data1->Production_Table_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Production_Table_Review == 'yes' && $data->stage == 4) required @endif class="summernote Production_Table_Assessment"
                                                    @if ($data->stage == 3 || (isset($data1->Production_Table_Person) && Auth::user()->name != $data1->Production_Table_Person)) readonly @endif name="Production_Table_Assessment" id="summernote-17">{{ $data1->Production_Table_Assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet feedback">Production Tablet Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Production_Table_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Production_Table_Feedback" @if ($data->stage == 3 || (isset($data1->Production_Table_Person) && Auth::user()->name != $data1->Production_Table_Person)) readonly @endif
                                                        name="Production_Table_Feedback" id="summernote-18" @if ($data1->Production_Table_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Production_Table_Feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet attachment">Production Tablet Attachments</label>
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Production_Table_Attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Production_Table_Attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet Completed By">Production Tablet Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Production_Table_By }}"
                                                        name="Production_Table_By"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Production_Table_By">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 productionTable">
                                                <div class="group-input ">
                                                    <label for="Production Tablet Completed On">Production Tablet Completed
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
                                                    <label for="Production Tablet">Production Tablet Required ?</label>
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
                                                        'q_m_s_roles_id' => 51,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet notification">Production Tablet Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Production_Table_Person" disabled id="Production_Table_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Production_Table_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 productionTable">
                                                    <div class="group-input">
                                                        <label for="Production Tablet assessment">Impact Assessment (By Production Tablet)
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
                                                        <label for="Production Tablet feedback">Production Tablet Feedback
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
                                                        <label for="Production Tablet assessment">Impact Assessment (By Production Tablet)
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
                                                        <label for="Production Tablet feedback">Production Tablet Feedback
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
                                                    <label for="Production Tablet attachment">Production Tablet Attachments</label>
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
                                                    <label for="Production Tablet Completed By">Production Tablet Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Production_Table_By }}" name="Production_Table_By"
                                                        id="Production_Table_By">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 productionTable">
                                                <div class="group-input">
                                                    <label for="Production Tablet Completed On">Production Tablet Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date"id="Production_Table_On" name="Production_Table_On"
                                                        value="{{ $data1->Production_Table_On }}">
                                                </div>
                                            </div>
                                        @endif


                                        <div class="sub-head">
                                            Production (Liquid/Ointment)
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->ProductionLiquid_Review!=='yes')
                                                $('.productionLiquid').hide();

                                                $('[name="ProductionLiquid_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.productionLiquid').show();
                                                        $('.productionLiquid span').show();
                                                    } else {
                                                        $('.productionLiquid').hide();
                                                        $('.productionLiquid span').hide();
                                                    }
                                                });
                                                @endif
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
                                                    <label for="Production Liquid"> Production Liquid Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="ProductionLiquid_Review" id="ProductionLiquid_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 52,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid notification">Production Liquid Person <span id="asteriskPT"
                                                            style="display: {{ $data1->ProductionLiquid_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="ProductionLiquid_person"
                                                        class="ProductionLiquid_person" id="ProductionLiquid_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->ProductionLiquid_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid assessment">Impact Assessment (By Production Liquid) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->ProductionLiquid_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->ProductionLiquid_Review == 'yes' && $data->stage == 4) required @endif class="summernote ProductionLiquid_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->ProductionLiquid_person) && Auth::user()->name != $data1->ProductionLiquid_person)) readonly @endif name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid feedback">Production Liquid Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->ProductionLiquid_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote ProductionLiquid_feedback"  @if ($data->stage == 3 || (isset($data1->ProductionLiquid_person) && Auth::user()->name != $data1->ProductionLiquid_person)) readonly @endif
                                                        name="ProductionLiquid_feedback" id="summernote-18" @if ($data1->ProductionLiquid_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->ProductionLiquid_feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid attachment">Production Liquid Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="ProductionLiquid_attachment">
                                                            @if ($data1->ProductionLiquid_attachment)
                                                                @foreach (json_decode($data1->ProductionLiquid_attachment) as $file)
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="ProductionLiquid_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid Completed By">Production Liquid Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->ProductionLiquid_by }}"
                                                        name="ProductionLiquid_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="ProductionLiquid_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 productionLiquid">
                                                <div class="group-input ">
                                                    <label for="Production Liquid Completed On">Production Liquid Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input type="date"id="ProductionLiquid_on"
                                                        name="ProductionLiquid_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        value="{{ $data1->ProductionLiquid_on }}">
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('ProductionLiquid_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('ProductionLiquid_person');
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
                                                    <label for="Production Liquid">Production Liquid Required ?</label>
                                                    <select name="ProductionLiquid_Review" disabled id="ProductionLiquid_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->ProductionLiquid_Review == 'na') selected @endif value='na'>
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
                                            <div class="col-lg-6 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid notification">Production Liquid Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="ProductionLiquid_person" disabled id="ProductionLiquid_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->ProductionLiquid_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 productionLiquid">
                                                    <div class="group-input">
                                                        <label for="Production Liquid assessment">Impact Assessment (By Production Liquid)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 productionLiquid">
                                                    <div class="group-input">
                                                        <label for="Production Liquid feedback">Production Liquid Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="ProductionLiquid_feedback" id="summernote-18">{{ $data1->ProductionLiquid_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3 productionLiquid">
                                                    <div class="group-input">
                                                        <label for="Production Liquid assessment">Impact Assessment (By Production Liquid)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="ProductionLiquid_assessment" id="summernote-17">{{ $data1->ProductionLiquid_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 productionLiquid">
                                                    <div class="group-input">
                                                        <label for="Production Liquid feedback">Production Liquid Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="ProductionLiquid_feedback" id="summernote-18">{{ $data1->ProductionLiquid_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid attachment">Production Liquid Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="ProductionLiquid_attachment">
                                                            @if ($data1->ProductionLiquid_attachment)
                                                                @foreach (json_decode($data1->ProductionLiquid_attachment) as $file)
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
                                                                id="myfile" name="ProductionLiquid_attachment[]"
                                                                oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid Completed By">Production Liquid Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->ProductionLiquid_by }}"
                                                        name="ProductionLiquid_by" id="ProductionLiquid_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 productionLiquid">
                                                <div class="group-input">
                                                    <label for="Production Liquid Completed On">Production Liquid Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date" id="ProductionLiquid_on" name="ProductionLiquid_on"
                                                        value="{{ $data1->ProductionLiquid_on }}">
                                                </div>
                                            </div>
                                        @endif




                                        <div class="sub-head">
                                            Production Injection
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Production_Injection_Review!=='yes')
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
                                                @endif
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
                                                    <label for="Production Injection"> Production Injection Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Production_Injection_Review" id="Production_Injection_Review">
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
                                                        'q_m_s_roles_id' => 53,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection notification">Production Injection Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Production_Injection_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Production_Injection_Person"
                                                        class="Production_Injection_Person" id="Production_Injection_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Production_Injection_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection assessment">Impact Assessment (By Production Injection) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Production_Injection_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Production_Injection_Review == 'yes' && $data->stage == 4) required @endif class="summernote Production_Injection_Assessment"
                                                        @if ($data->stage == 3 || (isset($data1->Production_Injection_Person) && Auth::user()->name != $data1->Production_Injection_Person)) readonly @endif name="Production_Injection_Assessment" id="summernote-17">{{ $data1->Production_Injection_Assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection feedback">Production Injection Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Production_Injection_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Production_Injection_Feedback" @if ($data->stage == 3 || (isset($data1->Production_Injection_Person) && Auth::user()->name != $data1->Production_Injection_Person)) readonly @endif
                                                        name="Production_Injection_Feedback" id="summernote-18" @if ($data1->Production_Injection_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Production_Injection_Feedback }}</textarea>
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
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
                                                        name="Production_Injection_By"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Production_Injection_By">


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
                                                    <label for="Production Injection notification">Production Injection Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Production_Injection_Person" disabled id="Production_Injection_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Production_Injection_Person) selected @endif>
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
                                                                id="myfile" name="Production_Injection_Attachment[]"
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
                                                        name="Production_Injection_By" id="Production_Injection_By">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 productionInjection">
                                                <div class="group-input">
                                                    <label for="Production Injection Completed On">Production Injection Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date"id="Production_Injection_On" name="Production_Injection_On"
                                                        value="{{ $data1->Production_Injection_On }}">
                                                </div>
                                            </div>
                                        @endif


                                        <div class="sub-head">
                                            Stores
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Store_Review!=='yes')
                                                $('.store').hide();

                                                $('[name="Store_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.store').show();
                                                        $('.store span').show();
                                                    } else {
                                                        $('.store').hide();
                                                        $('.store span').hide();
                                                    }
                                                });
                                                @endif
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
                                                    <label for="Store"> Store Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Store_Review" id="Store_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Store_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Store_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Store_Review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 54,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 store">
                                                <div class="group-input">
                                                    <label for="Store notification">Store Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Store_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Store_person"
                                                        class="Store_person" id="Store_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Store_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Store assessment">Impact Assessment (By Store) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Store_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Store_Review == 'yes' && $data->stage == 4) required @endif class="summernote Store_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->Store_person) && Auth::user()->name != $data1->Store_person)) readonly @endif name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 store">
                                                <div class="group-input">
                                                    <label for="store feedback">store Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Store_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Store_feedback" @if ($data->stage == 3 || (isset($data1->Store_person) && Auth::user()->name != $data1->Store_person)) readonly @endif
                                                        name="Store_feedback" id="summernote-18" @if ($data1->Store_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Store_feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 store">
                                                <div class="group-input">
                                                    <label for="Store attachment">Store Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Store_attachment">
                                                            @if ($data1->Store_attachment)
                                                                @foreach (json_decode($data1->Store_attachment) as $file)
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Store_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Store_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Store Completed By">Store Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Store_by }}"
                                                        name="Store_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Store_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 store">
                                                <div class="group-input ">
                                                    <label for="Store Completed On">Store Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input type="date"id="Store_on"
                                                        name="Store_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        value="{{ $data1->Store_on }}">
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Store_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Store_person');
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
                                                    <label for="Store">Store Required ?</label>
                                                    <select name="Store_Review" disabled id="Store_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Store_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Store_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Store_Review == 'na') selected @endif value='na'>
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
                                            <div class="col-lg-6 store">
                                                <div class="group-input">
                                                    <label for="Store notification">Store Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Store_person" disabled id="Store_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Store_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 store">
                                                    <div class="group-input">
                                                        <label for="Store assessment">Impact Assessment (By Store)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 store">
                                                    <div class="group-input">
                                                        <label for="Store feedback">Store Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Store_feedback" id="summernote-18">{{ $data1->Store_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3 store">
                                                    <div class="group-input">
                                                        <label for="Store assessment">Impact Assessment (By Store)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Store_assessment" id="summernote-17">{{ $data1->Store_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 store">
                                                    <div class="group-input">
                                                        <label for="Store feedback">Store Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Store_feedback" id="summernote-18">{{ $data1->Store_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 store">
                                                <div class="group-input">
                                                    <label for="Store attachment">Store Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Store_attachment">
                                                            @if ($data1->Store_attachment)
                                                                @foreach (json_decode($data1->Store_attachment) as $file)
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
                                                                id="myfile" name="Store_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Store_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Store Completed By">Store Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Store_by }}"
                                                        name="Store_by" id="Store_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 store">
                                                <div class="group-input">
                                                    <label for="Store Completed On">Store Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date" id="Store_on" name="Store_on"
                                                        value="{{ $data1->Store_on }}">
                                                </div>
                                            </div>
                                        @endif




                                        <div class="sub-head">
                                            Quality Control
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Quality_review!=='yes')
                                                $('.qualityControl').hide();

                                                $('[name="Quality_review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.qualityControl').show();
                                                        $('.qualityControl span').show();
                                                    } else {
                                                        $('.qualityControl').hide();
                                                        $('.qualityControl span').hide();
                                                    }
                                                });
                                                @endif

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
                                                    <label for="Quality Control"> Quality Control Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Quality_review" id="Quality_review_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Quality_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Quality_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Quality_review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 24,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control notification">Quality Control Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Quality_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Quality_Control_Person"
                                                        class="Quality_Control_Person" id="Quality_Control_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Quality_Control_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control assessment">Impact Assessment (By Quality Control) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Quality_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Quality_review == 'yes' && $data->stage == 4) required @endif class="summernote Quality_Control_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->Quality_Control_Person) && Auth::user()->name != $data1->Quality_Control_Person)) readonly @endif name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control feedback">Quality Control Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Quality_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Quality_Control_feedback" @if ($data->stage == 3 || (isset($data1->Quality_Control_Person) && Auth::user()->name != $data1->Quality_Control_Person)) readonly @endif
                                                        name="Quality_Control_feedback" id="summernote-18" @if ($data1->Quality_review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Quality_Control_feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control attachment">Quality Control Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Quality_Control_attachment">
                                                            @if ($data1->Quality_Control_attachment)
                                                                @foreach (json_decode($data1->Quality_Control_attachment) as $file)
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Quality_Control_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Quality_Control_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control Completed By">Quality Control Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Quality_Control_by }}"
                                                        name="Quality_Control_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Quality_Control_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 qualityControl">
                                                <div class="group-input ">
                                                    <label for="Quality Control Completed On">Quality Control Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input type="date"id="Quality_Control_on"
                                                        name="Quality_Control_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        value="{{ $data1->Quality_Control_on }}">
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
                                                    <label for="Quality Control">Quality Control Required ?</label>
                                                    <select name="Quality_review" disabled id="Quality_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Quality_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Quality_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Quality_review == 'na') selected @endif value='na'>
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
                                            <div class="col-lg-6 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control notification">Quality Control Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Quality_Control_Person" disabled id="Quality_Control_Person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Quality_Control_Person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 qualityControl">
                                                    <div class="group-input">
                                                        <label for="Quality Control assessment">Impact Assessment (By Quality Control)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 qualityControl">
                                                    <div class="group-input">
                                                        <label for="Quality Control feedback">Quality Control Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Quality_Control_feedback" id="summernote-18">{{ $data1->Quality_Control_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3 qualityControl">
                                                    <div class="group-input">
                                                        <label for="Quality Control assessment">Impact Assessment (By Quality Control)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Quality_Control_assessment" id="summernote-17">{{ $data1->Quality_Control_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 qualityControl">
                                                    <div class="group-input">
                                                        <label for="Quality Control feedback">Quality Control Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Quality_Control_feedback" id="summernote-18">{{ $data1->Quality_Control_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control attachment">Quality Control Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Quality_Control_attachment">
                                                            @if ($data1->Quality_Control_attachment)
                                                                @foreach (json_decode($data1->Quality_Control_attachment) as $file)
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
                                                                id="myfile" name="Store_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Quality_Control_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control Completed By">Quality Control Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Quality_Control_by }}"
                                                        name="Quality_Control_by" id="Quality_Control_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 qualityControl">
                                                <div class="group-input">
                                                    <label for="Quality Control Completed On">Quality Control Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date" id="Quality_Control_on" name="Quality_Control_on"
                                                        value="{{ $data1->Quality_Control_on }}">
                                                </div>
                                            </div>
                                        @endif

                                        <div class="sub-head">
                                            Research & Development
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->ResearchDevelopment_Review!=='yes')
                                                $('.researchDevelopment').hide();

                                                $('[name="ResearchDevelopment_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.researchDevelopment').show();
                                                        $('.researchDevelopment span').show();
                                                    } else {
                                                        $('.researchDevelopment').hide();
                                                        $('.researchDevelopment span').hide();
                                                    }
                                                });
                                                @endif
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
                                                    <label for="Research Development"> Research Development Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="ResearchDevelopment_Review" id="ResearchDevelopment_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ResearchDevelopment_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->ResearchDevelopment_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->ResearchDevelopment_Review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 55,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development notification">Research Development Person <span id="asteriskPT"
                                                            style="display: {{ $data1->ResearchDevelopment_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="ResearchDevelopmentStore_Person"
                                                        class="ResearchDevelopment_person" id="ResearchDevelopment_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->ResearchDevelopment_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development assessment">Impact Assessment (By Research Development) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->ResearchDevelopment_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->ResearchDevelopment_Review == 'yes' && $data->stage == 4) required @endif class="summernote ResearchDevelopment_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->ResearchDevelopmentStore_Person) && Auth::user()->name != $data1->ResearchDevelopmentStore_Person)) readonly @endif name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development feedback">Research Development Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->ResearchDevelopment_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote ResearchDevelopment_feedback" @if ($data->stage == 3 || (isset($data1->ResearchDevelopmentStore_Person) && Auth::user()->name != $data1->ResearchDevelopmentStore_Person)) readonly @endif
                                                        name="ResearchDevelopment_feedback" id="summernote-18" @if ($data1->ResearchDevelopment_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development attachment">Research Development Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="ResearchDevelopment_attachment">
                                                            @if ($data1->ResearchDevelopment_attachment)
                                                                @foreach (json_decode($data1->ResearchDevelopment_attachment) as $file)
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="ResearchDevelopment_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'ResearchDevelopment_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development Completed By">Research Development Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->ResearchDevelopment_by }}"
                                                        name="ResearchDevelopment_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="ResearchDevelopment_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 researchDevelopment">
                                                <div class="group-input ">
                                                    <label for="Research Development Completed On">Research Development Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input type="date"id="ResearchDevelopment_on"
                                                        name="ResearchDevelopment_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        value="{{ $data1->ResearchDevelopment_on }}">
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('ResearchDevelopment_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('ResearchDevelopment_person');
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
                                                    <label for="Research Development">Research Development Required ?</label>
                                                    <select name="ResearchDevelopment_Review" disabled id="ResearchDevelopment_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ResearchDevelopment_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->ResearchDevelopment_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->ResearchDevelopment_Review == 'na') selected @endif value='na'>
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
                                            <div class="col-lg-6 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development notification">Research Development Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="ResearchDevelopment_person" disabled id="ResearchDevelopment_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->ResearchDevelopment_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 researchDevelopment">
                                                    <div class="group-input">
                                                        <label for="Research Development assessment">Impact Assessment (By Research Development)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 researchDevelopment">
                                                    <div class="group-input">
                                                        <label for="Research Development feedback">Research Development Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="ResearchDevelopment_feedback" id="summernote-18">{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3 researchDevelopment">
                                                    <div class="group-input">
                                                        <label for="Research Development assessment">Impact Assessment (By Research Development)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="ResearchDevelopment_assessment" id="summernote-17">{{ $data1->ResearchDevelopment_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 researchDevelopment">
                                                    <div class="group-input">
                                                        <label for="Research Development feedback">Research Development Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="ResearchDevelopment_feedback" id="summernote-18">{{ $data1->ResearchDevelopment_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development attachment">Research Development Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="ResearchDevelopment_attachment">
                                                            @if ($data1->ResearchDevelopment_attachment)
                                                                @foreach (json_decode($data1->ResearchDevelopment_attachment) as $file)
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
                                                                id="myfile" name="ResearchDevelopment_attachment[]"
                                                                oninput="addMultipleFiles(this, 'ResearchDevelopment_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development Completed By">Research Development Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->ResearchDevelopment_by }}"
                                                        name="ResearchDevelopment_by" id="StorResearchDevelopment_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 researchDevelopment">
                                                <div class="group-input">
                                                    <label for="Research Development Completed On">Research Development Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date" id="ResearchDevelopment_on" name="ResearchDevelopment_on"
                                                        value="{{ $data1->ResearchDevelopment_on }}">
                                                </div>
                                            </div>
                                        @endif



                                        <div class="sub-head">
                                            Engineering
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Engineering_review!=='yes')
                                                $('.Engineering').hide();

                                                $('[name="Engineering_review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.Engineering').show();
                                                        $('.Engineering span').show();
                                                    } else {
                                                        $('.Engineering').hide();
                                                        $('.Engineering span').hide();
                                                    }
                                                });
                                                @endif
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
                                                    <label for="Engineering"> Engineering Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Engineering_review" id="Engineering_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Engineering_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Engineering_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Engineering_review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 25,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering notification">Engineering Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Engineering_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Engineering_person"
                                                        class="Engineering_person" id="Engineering_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Engineering_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering assessment">Impact Assessment (By Engineering) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Engineering_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Engineering_review == 'yes' && $data->stage == 4) required @endif class="summernote Engineering_assessment"
                                                        @if ($data->stage == 3 || (isset($data1->Engineering_person) && Auth::user()->name != $data1->Engineering_person)) readonly @endif name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering feedback">Engineering Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Engineering_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Engineering_feedback" @if ($data->stage == 3 || (isset($data1->Engineering_person) && Auth::user()->name != $data1->Engineering_person)) readonly @endif
                                                        name="Engineering_feedback" id="summernote-18" @if ($data1->Engineering_review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Engineering_feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering attachment">Engineering Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Engineering_attachment">
                                                            @if ($data1->Engineering_attachment)
                                                                @foreach (json_decode($data1->Engineering_attachment) as $file)
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Engineering_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Engineering_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering Completed By">Engineering Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Engineering_by }}"
                                                        name="Engineering_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Engineering_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Engineering">
                                                <div class="group-input ">
                                                    <label for="Engineering Completed On">Engineering Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input type="date"id="Engineering_on"
                                                        name="Engineering_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        value="{{ $data1->Engineering_on }}">
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
                                                    <label for="Engineering">Engineering Required ?</label>
                                                    <select name="Engineering_review" disabled id="Engineering_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Engineering_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Engineering_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Engineering_review == 'na') selected @endif value='na'>
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
                                            <div class="col-lg-6 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering notification">Engineering Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Engineering_person" disabled id="Engineering_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Engineering_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 Engineering">
                                                    <div class="group-input">
                                                        <label for="Engineering assessment">Impact Assessment (By Engineering)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 Engineering">
                                                    <div class="group-input">
                                                        <label for="Engineering feedback">Engineering Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Engineering_feedback" id="summernote-18">{{ $data1->Engineering_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3 Engineering">
                                                    <div class="group-input">
                                                        <label for="Engineering assessment">Impact Assessment (By Engineering)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Engineering_assessment" id="summernote-17">{{ $data1->Engineering_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 Engineering">
                                                    <div class="group-input">
                                                        <label for="Engineering feedback">Engineering Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Engineering_feedback" id="summernote-18">{{ $data1->Engineering_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering attachment">Engineering Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Engineering_attachment">
                                                            @if ($data1->Engineering_attachment)
                                                                @foreach (json_decode($data1->Engineering_attachment) as $file)
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
                                                                id="myfile" name="Engineering_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Engineering_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering Completed By">Engineering Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Engineering_by }}"
                                                        name="Engineering_by" id="Engineering_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Engineering">
                                                <div class="group-input">
                                                    <label for="Engineering Completed On">Engineering Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date" id="Engineering_on" name="Engineering_on"
                                                        value="{{ $data1->Engineering_on }}">
                                                </div>
                                            </div>
                                        @endif




                                        <div class="sub-head">
                                            Human Resource
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Human_Resource_review!=='yes')
                                                $('.Human_Resource').hide();

                                                $('[name="Human_Resource_review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.Human_Resource').show();
                                                        $('.Human_Resource span').show();
                                                    } else {
                                                        $('.Human_Resource').hide();
                                                        $('.Human_Resource span').hide();
                                                    }
                                                });
                                                @endif
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
                                                    <label for="Human Resource"> Human Resource Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Human_Resource_review" id="Human_Resource_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Human_Resource_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Human_Resource_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Human_Resource_review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 31,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource notification">Human Resource Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Human_Resource_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Human_Resource_person"
                                                        class="Human_Resource_person" id="Human_Resource_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Human_Resource_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource assessment">Impact Assessment (By Human Resource) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Human_Resource_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Human_Resource_review == 'yes' && $data->stage == 4) required @endif class="summernote Human_Resource_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->Human_Resource_person) && Auth::user()->name != $data1->Human_Resource_person)) readonly @endif name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource feedback">Human Resource Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Human_Resource_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Human_Resource_feedback" @if ($data->stage == 3 || (isset($data1->Human_Resource_person) && Auth::user()->name != $data1->Human_Resource_person)) readonly @endif
                                                        name="Human_Resource_feedback" id="summernote-18" @if ($data1->Human_Resource_review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Human_Resource_feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource attachment">Human Resource Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Human_Resource_attachment">
                                                            @if ($data1->Human_Resource_attachment)
                                                                @foreach (json_decode($data1->Human_Resource_attachment) as $file)
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Human_Resource_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Human_Resource_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource Completed By">Human Resource Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Human_Resource_by }}"
                                                        name="Human_Resource_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Human_Resource_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Human_Resource">
                                                <div class="group-input ">
                                                    <label for="Human Resource Completed On">Human Resource Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input type="date"id="Human_Resource_on"
                                                        name="Human_Resource_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        value="{{ $data1->Human_Resource_on }}">
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
                                                    <label for="Human Resource">Human Resource Required ?</label>
                                                    <select name="Human_Resource_review" disabled id="Human_Resource_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Human_Resource_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Human_Resource_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Human_Resource_review == 'na') selected @endif value='na'>
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
                                            <div class="col-lg-6 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource notification">Human Resource Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Human_Resource_person" disabled id="Human_Resource_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Human_Resource_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 Human_Resource">
                                                    <div class="group-input">
                                                        <label for="Human Resource assessment">Impact Assessment (By Human Resource)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 Human_Resource">
                                                    <div class="group-input">
                                                        <label for="Human Resource feedback">Human Resource Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Human_Resource_feedback" id="summernote-18">{{ $data1->Human_Resource_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3 Human_Resource">
                                                    <div class="group-input">
                                                        <label for="Human Resource assessment">Impact Assessment (By Human Resource)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Human_Resource_assessment" id="summernote-17">{{ $data1->Human_Resource_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 Human_Resource">
                                                    <div class="group-input">
                                                        <label for="Human Resource feedback">Human Resource Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Human_Resource_feedback" id="summernote-18">{{ $data1->Human_Resource_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource attachment">Human Resource Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Human_Resource_attachment">
                                                            @if ($data1->Human_Resource_attachment)
                                                                @foreach (json_decode($data1->Human_Resource_attachment) as $file)
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
                                                                id="myfile" name="Human_Resource_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Human_Resource_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource Completed By">Human Resource Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Human_Resource_by }}"
                                                        name="Human_Resource_by" id="Human_Resource_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Human_Resource">
                                                <div class="group-input">
                                                    <label for="Human Resource Completed On">Human Resource Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date" id="Human_Resource_on" name="Human_Resource_on"
                                                        value="{{ $data1->Human_Resource_on }}">
                                                </div>
                                            </div>
                                        @endif


                                        <div class="sub-head">
                                            Microbiology
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Microbiology_Review!=='yes')
                                                $('.Microbiology').hide();

                                                $('[name="Microbiology_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.Microbiology').show();
                                                        $('.Microbiology span').show();
                                                    } else {
                                                        $('.Microbiology').hide();
                                                        $('.Microbiology span').hide();
                                                    }
                                                });
                                                @endif
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
                                                    <label for="Microbiology"> Microbiology Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Microbiology_Review" id="Microbiology_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Microbiology_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Microbiology_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Microbiology_Review == 'na') selected @endif value='na'>
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
                                            <div class="col-lg-6 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology notification">Microbiology Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Microbiology_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Microbiology_person"
                                                        class="Microbiology_person" id="Microbiology_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Microbiology_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology assessment">Impact Assessment (By Microbiology) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Microbiology_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Microbiology_Review == 'yes' && $data->stage == 4) required @endif class="summernote Microbiology_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->Microbiology_person) && Auth::user()->name != $data1->Microbiology_person)) readonly @endif name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology feedback">Microbiology Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Microbiology_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Microbiology_feedback" @if ($data->stage == 3 || (isset($data1->Microbiology_person) && Auth::user()->name != $data1->Microbiology_person)) readonly @endif
                                                        name="Microbiology_feedback" id="summernote-18" @if ($data1->Microbiology_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Microbiology_feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology attachment">Microbiology Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Microbiology_attachment">
                                                            @if ($data1->Microbiology_attachment)
                                                                @foreach (json_decode($data1->Microbiology_attachment) as $file)
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Microbiology_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Microbiology_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology Completed By">Microbiology Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Microbiology_by }}"
                                                        name="Microbiology_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Microbiology_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Microbiology">
                                                <div class="group-input ">
                                                    <label for="Microbiology Completed On">Microbiology Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input type="date"id="Microbiology_on"
                                                        name="Microbiology_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        value="{{ $data1->Microbiology_on }}">
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('Microbiology_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('Microbiology_person');
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
                                                    <label for="Microbiology">Microbiology Required ?</label>
                                                    <select name="Microbiology_Review" disabled id="Microbiology_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Microbiology_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Microbiology_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Microbiology_Review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 56,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology notification">Microbiology Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Microbiology_person" disabled id="Microbiology_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Microbiology_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 Microbiology">
                                                    <div class="group-input">
                                                        <label for="Microbiology assessment">Impact Assessment (By Microbiology)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 Microbiology">
                                                    <div class="group-input">
                                                        <label for="Microbiology feedback">Microbiology Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Microbiology_feedback" id="summernote-18">{{ $data1->Microbiology_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3 Microbiology">
                                                    <div class="group-input">
                                                        <label for="Microbiology assessment">Impact Assessment (By Microbiology)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Microbiology_assessment" id="summernote-17">{{ $data1->Microbiology_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 Microbiology">
                                                    <div class="group-input">
                                                        <label for="Microbiology feedback">Microbiology Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Microbiology_feedback" id="summernote-18">{{ $data1->Microbiology_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology attachment">Microbiology Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Microbiology_attachment">
                                                            @if ($data1->Microbiology_attachment)
                                                                @foreach (json_decode($data1->Microbiology_attachment) as $file)
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
                                                                id="myfile" name="Microbiology_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Microbiology_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology Completed By">Microbiology Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Microbiology_by }}"
                                                        name="Microbiology_by" id="Microbiology_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Microbiology">
                                                <div class="group-input">
                                                    <label for="Microbiology Completed On">Microbiology Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date" id="Microbiology_on" name="Microbiology_on"
                                                        value="{{ $data1->Microbiology_on }}">
                                                </div>
                                            </div>
                                        @endif



                                        <div class="sub-head">
                                            Regulatory Affair
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->RegulatoryAffair_Review!=='yes')
                                                $('.RegulatoryAffair').hide();

                                                $('[name="RegulatoryAffair_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.RegulatoryAffair').show();
                                                        $('.RegulatoryAffair span').show();
                                                    } else {
                                                        $('.RegulatoryAffair').hide();
                                                        $('.RegulatoryAffair span').hide();
                                                    }
                                                });
                                                @endif
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
                                                    <label for="RegulatoryAffair"> Regulatory Affair Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="RegulatoryAffair_Review" id="RegulatoryAffair_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->RegulatoryAffair_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->RegulatoryAffair_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->RegulatoryAffair_Review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 57,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair notification">Regulatory Affair Person <span id="asteriskPT"
                                                            style="display: {{ $data1->RegulatoryAffair_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="RegulatoryAffair_person"
                                                        class="RegulatoryAffair_person" id="RegulatoryAffair_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->RegulatoryAffair_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair assessment">Impact Assessment (By Regulatory Affair) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->RegulatoryAffair_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->RegulatoryAffair_Review == 'yes' && $data->stage == 4) required @endif class="summernote RegulatoryAffair_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->RegulatoryAffair_person) && Auth::user()->name != $data1->RegulatoryAffair_person)) readonly @endif name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair feedback">Regulatory Affair Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->RegulatoryAffair_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote RegulatoryAffair_feedback" @if ($data->stage == 3 || (isset($data1->RegulatoryAffair_person) && Auth::user()->name != $data1->RegulatoryAffair_person)) readonly @endif
                                                        name="RegulatoryAffair_feedback" id="summernote-18" @if ($data1->RegulatoryAffair_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair attachment">Regulatory Affair Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="RegulatoryAffair_attachment">
                                                            @if ($data1->RegulatoryAffair_attachment)
                                                                @foreach (json_decode($data1->RegulatoryAffair_attachment) as $file)
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="RegulatoryAffair_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'RegulatoryAffair_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair Completed By">Regulatory Affair Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->RegulatoryAffair_by }}"
                                                        name="RegulatoryAffair_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="RegulatoryAffair_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 RegulatoryAffair">
                                                <div class="group-input ">
                                                    <label for="Regulatory Affair Completed On">Regulatory Affair Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input type="date"id="RegulatoryAffair_on"
                                                        name="RegulatoryAffair_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        value="{{ $data1->RegulatoryAffair_on }}">
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('RegulatoryAffair_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('RegulatoryAffair_person');
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
                                                    <label for="Regulatory Affair">Regulatory Affair Required ?</label>
                                                    <select name="RegulatoryAffair_Review" disabled id="RegulatoryAffair_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->RegulatoryAffair_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->RegulatoryAffair_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->RegulatoryAffair_Review == 'na') selected @endif value='na'>
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
                                            <div class="col-lg-6 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair notification">Regulatory Affair Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="RegulatoryAffair_person" disabled id="RegulatoryAffair_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->RegulatoryAffair_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                                    <div class="group-input">
                                                        <label for="Regulatory Affair assessment">Impact Assessment (By Regulatory Affair)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                                    <div class="group-input">
                                                        <label for="Regulatory Affair feedback">Regulatory Affair Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="RegulatoryAffair_feedback" id="summernote-18">{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                                    <div class="group-input">
                                                        <label for="Regulatory Affair assessment">Impact Assessment (By Regulatory Affair)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="RegulatoryAffair_assessment" id="summernote-17">{{ $data1->RegulatoryAffair_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 RegulatoryAffair">
                                                    <div class="group-input">
                                                        <label for="Regulatory Affair feedback">Regulatory Affair Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="RegulatoryAffair_feedback" id="summernote-18">{{ $data1->RegulatoryAffair_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair attachment">Regulatory Affair Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="RegulatoryAffair_attachment">
                                                            @if ($data1->RegulatoryAffair_attachment)
                                                                @foreach (json_decode($data1->RegulatoryAffair_attachment) as $file)
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
                                                                id="myfile" name="RegulatoryAffair_attachment[]"
                                                                oninput="addMultipleFiles(this, 'RegulatoryAffair_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair Completed By">Regulatory Affair Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->RegulatoryAffair_by }}"
                                                        name="RegulatoryAffair_by" id="RegulatoryAffair_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 RegulatoryAffair">
                                                <div class="group-input">
                                                    <label for="Regulatory Affair Completed On">Regulatory Affair Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date" id="RegulatoryAffair_on" name="RegulatoryAffair_on"
                                                        value="{{ $data1->RegulatoryAffair_on }}">
                                                </div>
                                            </div>
                                        @endif



                                        <div class="sub-head">
                                            Corporate Quality Assurance
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->CorporateQualityAssurance_Review!=='yes')
                                                $('.CQA').hide();

                                                $('[name="CorporateQualityAssurance_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.CQA').show();
                                                        $('.CQA span').show();
                                                    } else {
                                                        $('.CQA').hide();
                                                        $('.CQA span').hide();
                                                    }
                                                });

                                                @endif
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
                                                    <label for="Corporate Quality Assurance"> Corporate Quality Assurance Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="CorporateQualityAssurance_Review" id="CorporateQualityAssurance_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->CorporateQualityAssurance_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->CorporateQualityAssurance_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->CorporateQualityAssurance_Review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 58,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance notification">Corporate Quality Assurance Person <span id="asteriskPT"
                                                            style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="CorporateQualityAssurance_person"
                                                        class="CorporateQualityAssurance_person" id="CorporateQualityAssurance_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->CorporateQualityAssurance_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance assessment">Impact Assessment (By Corporate Quality Assurance) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 4) required @endif class="summernote CorporateQualityAssurance_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->CorporateQualityAssurance_person) && Auth::user()->name != $data1->CorporateQualityAssurance_person)) readonly @endif name="CorporateQualityAssurance_assessment" id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance feedback">Corporate Quality Assurance Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote CorporateQualityAssurance_feedback" @if ($data->stage == 3 || (isset($data1->CorporateQualityAssurance_person) && Auth::user()->name != $data1->CorporateQualityAssurance_person)) readonly @endif
                                                        name="CorporateQualityAssurance_feedback" id="summernote-18" @if ($data1->CorporateQualityAssurance_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance attachment">Corporate Quality Assurance Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="CorporateQualityAssurance_attachment">
                                                            @if ($data1->CorporateQualityAssurance_attachment)
                                                                @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $file)
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="CorporateQualityAssurance_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'CorporateQualityAssurance_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance Completed By">Corporate Quality Assurance Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->CorporateQualityAssurance_by }}"
                                                        name="CorporateQualityAssurance_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="CorporateQualityAssurance_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 CQA">
                                                <div class="group-input ">
                                                    <label for="Corporate Quality Assurance Completed On">Corporate Quality Assurance Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input type="date"id="CorporateQualityAssurance_on"
                                                        name="CorporateQualityAssurance_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        value="{{ $data1->CorporateQualityAssurance_on }}">
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('CorporateQualityAssurance_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('CorporateQualityAssurance_person');
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
                                                    <label for="Corporate Quality Assurance">Corporate Quality Assurance Required ?</label>
                                                    <select name="CorporateQualityAssurance_Review" disabled id="CorporateQualityAssurance_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->CorporateQualityAssurance_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->CorporateQualityAssurance_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->CorporateQualityAssurance_Review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 58,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance notification">Corporate Quality Assurance Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="CorporateQualityAssurance_person" disabled id="CorporateQualityAssurance_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->CorporateQualityAssurance_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 CQA">
                                                    <div class="group-input">
                                                        <label for="Corporate Quality Assurance assessment">Impact Assessment (By Corporate Quality Assurance)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="CorporateQualityAssurance_assessment" id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 CQA">
                                                    <div class="group-input">
                                                        <label for="Corporate Quality Assurance feedback">Corporate Quality Assurance Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="CorporateQualityAssurance_feedback" id="summernote-18">{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3 CQA">
                                                    <div class="group-input">
                                                        <label for="Corporate Quality Assurance assessment">Impact Assessment (By Corporate Quality Assurance)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="CorporateQualityAssurance_assessment" id="summernote-17">{{ $data1->CorporateQualityAssurance_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 CQA">
                                                    <div class="group-input">
                                                        <label for="Corporate Quality Assurance feedback">Corporate Quality Assurance Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="CorporateQualityAssurance_feedback" id="summernote-18">{{ $data1->CorporateQualityAssurance_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance attachment">Corporate Quality Assurance Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="CorporateQualityAssurance_attachment">
                                                            @if ($data1->CorporateQualityAssurance_attachment)
                                                                @foreach (json_decode($data1->CorporateQualityAssurance_attachment) as $file)
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
                                                                id="myfile" name="Microbiology_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Microbiology_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance Completed By">Corporate Quality Assurance Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->CorporateQualityAssurance_by }}"
                                                        name="CorporateQualityAssurance_by" id="CorporateQualityAssurance_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 CQA">
                                                <div class="group-input">
                                                    <label for="Corporate Quality Assurance Completed On">Corporate Quality Assurance Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date" id="CorporateQualityAssurance_on" name="CorporateQualityAssurance_on"
                                                        value="{{ $data1->CorporateQualityAssurance_on }}">
                                                </div>
                                            </div>
                                        @endif 



                                        <div class="sub-head">
                                            Safety
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Environment_Health_review!=='yes')
                                                $('.safety').hide();

                                                $('[name="Environment_Health_review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.safety').show();
                                                        $('.safety span').show();
                                                    } else {
                                                        $('.safety').hide();
                                                        $('.safety span').hide();
                                                    }
                                                });
                                                @endif
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
                                                    <label for="Safety"> Safety Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Environment_Health_review" id="Environment_Health_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Environment_Health_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Environment_Health_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Environment_Health_review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 59,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 safety">
                                                <div class="group-input">
                                                    <label for="Safety notification">Safety Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Environment_Health_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Environment_Health_Safety_person"
                                                        class="Environment_Health_Safety_person" id="Environment_Health_Safety_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Environment_Health_Safety_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety assessment">Impact Assessment (By Safety) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Environment_Health_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Environment_Health_review == 'yes' && $data->stage == 4) required @endif class="summernote Health_Safety_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->Environment_Health_Safety_person) && Auth::user()->name != $data1->Environment_Health_Safety_person)) readonly @endif name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety feedback">Safety Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Environment_Health_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Health_Safety_feedback" @if ($data->stage == 3 || (isset($data1->Environment_Health_Safety_person) && Auth::user()->name != $data1->Environment_Health_Safety_person)) readonly @endif
                                                        name="Health_Safety_feedback" id="summernote-18" @if ($data1->Environment_Health_review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Health_Safety_feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 safety">
                                                <div class="group-input">
                                                    <label for="Safety attachment">Safety Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Environment_Health_Safety_attachment">
                                                            @if ($data1->Environment_Health_Safety_attachment)
                                                                @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $file)
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Environment_Health_Safety_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety Completed By">Safety Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Environment_Health_Safety_by }}"
                                                        name="Environment_Health_Safety_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Environment_Health_Safety_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 safety">
                                                <div class="group-input ">
                                                    <label for="Safety Completed On">Safety Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input type="date"id="Environment_Health_Safety_on"
                                                        name="Environment_Health_Safety_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        value="{{ $data1->Environment_Health_Safety_on }}">
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
                                                    <label for="Safety">Safety Required ?</label>
                                                    <select name="Environment_Health_review" disabled id="Environment_Health_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Environment_Health_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Environment_Health_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Environment_Health_review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 59,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 safety">
                                                <div class="group-input">
                                                    <label for="Safety notification">Safety Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Environment_Health_Safety_person" disabled id="Environment_Health_Safety_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Environment_Health_Safety_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 safety">
                                                    <div class="group-input">
                                                        <label for="Safety assessment">Impact Assessment (By Safety)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 safety">
                                                    <div class="group-input">
                                                        <label for="Safety feedback">Safety Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Health_Safety_feedback" id="summernote-18">{{ $data1->Health_Safety_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3 safety">
                                                    <div class="group-input">
                                                        <label for="Safety assessment">Impact Assessment (By Safety)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Health_Safety_assessment" id="summernote-17">{{ $data1->Health_Safety_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 safety">
                                                    <div class="group-input">
                                                        <label for="Safety feedback">Safety Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Health_Safety_feedback" id="summernote-18">{{ $data1->Health_Safety_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 safety">
                                                <div class="group-input">
                                                    <label for="Safety attachment">Safety Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Environment_Health_Safety_attachment">
                                                            @if ($data1->Environment_Health_Safety_attachment)
                                                                @foreach (json_decode($data1->Environment_Health_Safety_attachment) as $file)
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
                                                                id="myfile" name="Environment_Health_Safety_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 safety">
                                                <div class="group-input">
                                                    <label for="Safety Completed By">Safety Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Environment_Health_Safety_by }}"
                                                        name="Environment_Health_Safety_by" id="Environment_Health_Safety_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 safety">
                                                <div class="group-input">
                                                    <label for="Safety Completed On">Safety Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date" id="Environment_Health_Safety_on" name="Environment_Health_Safety_on"
                                                        value="{{ $data1->Environment_Health_Safety_on }}">
                                                </div>
                                            </div>
                                        @endif




                                        <div class="sub-head">
                                            Information Technology
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->Information_Technology_review!=='yes')
                                                $('.Information_Technology').hide();

                                                $('[name="Information_Technology_review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.Information_Technology').show();
                                                        $('.Information_Technology span').show();
                                                    } else {
                                                        $('.Information_Technology').hide();
                                                        $('.Information_Technology span').hide();
                                                    }
                                                });
                                                @endif
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
                                                    <label for="Information_Technology"> Information Technology Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="Information_Technology_review" id="Information_Technology_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Information_Technology_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Information_Technology_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Information_Technology_review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 32,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology notification">Information Technology Person <span id="asteriskPT"
                                                            style="display: {{ $data1->Information_Technology_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="Information_Technology_person"
                                                        class="Information_Technology_person" id="Information_Technology_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Information_Technology_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology assessment">Impact Assessment (By Information Technology) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->Information_Technology_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->Information_Technology_review == 'yes' && $data->stage == 4) required @endif class="summernote Information_Technology_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->Information_Technology_person) && Auth::user()->name != $data1->Information_Technology_person)) readonly @endif name="Information_Technology_assessment" id="summernote-17">{{ $data1->Information_Technology_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology feedback">Information Technology Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->Information_Technology_review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote Information_Technology_feedback" @if ($data->stage == 3 || (isset($data1->Information_Technology_person) && Auth::user()->name != $data1->Information_Technology_person)) readonly @endif
                                                        name="Information_Technology_feedback" id="summernote-18" @if ($data1->Information_Technology_review == 'yes' && $data->stage == 4) required @endif>{{ $data1->Information_Technology_feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology attachment">Information Technology Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Information_Technology_attachment">
                                                            @if ($data1->Information_Technology_attachment)
                                                                @foreach (json_decode($data1->Information_Technology_attachment) as $file)
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="Information_Technology_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'Information_Technology_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology Completed By">Information Technology Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Information_Technology_by }}"
                                                        name="Information_Technology_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="Information_Technology_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Information_Technology">
                                                <div class="group-input ">
                                                    <label for="Information Technology Completed On">Information Technology Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input type="date"id="Information_Technology_on"
                                                        name="Information_Technology_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        value="{{ $data1->Information_Technology_on }}">
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
                                                    <label for="Information Technology">Information Technology Required ?</label>
                                                    <select name="Information_Technology_review" disabled id="Information_Technology_review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->Information_Technology_review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->Information_Technology_review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->Information_Technology_review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 32,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology notification">Information Technology Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="Information_Technology_person" disabled id="Information_Technology_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->Information_Technology_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 Information_Technology">
                                                    <div class="group-input">
                                                        <label for="Information Technology assessment">Impact Assessment (By Information Technology)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Information_Technology_assessment" id="summernote-17">{{ $data1->Information_Technology_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 Information_Technology">
                                                    <div class="group-input">
                                                        <label for="Information Technology feedback">Information Technology Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="Information_Technology_feedback" id="summernote-18">{{ $data1->Information_Technology_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3 Information_Technology">
                                                    <div class="group-input">
                                                        <label for="Information Technology assessment">Impact Assessment (By Information Technology)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Information_Technology_assessment" id="summernote-17">{{ $data1->Information_Technology_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 Information_Technology">
                                                    <div class="group-input">
                                                        <label for="Information Technology feedback">Information Technology Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="Information_Technology_feedback" id="summernote-18">{{ $data1->Information_Technology_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology attachment">Information Technology Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="Information_Technology_attachment">
                                                            @if ($data1->Information_Technology_attachment)
                                                                @foreach (json_decode($data1->Information_Technology_attachment) as $file)
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
                                                                id="myfile" name="Information_Technology_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Information_Technology_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology Completed By">Information Technology Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->Information_Technology_by }}"
                                                        name="Information_Technology_by" id="Information_Technology_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 Information_Technology">
                                                <div class="group-input">
                                                    <label for="Information Technology Completed On">Information Technology Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date" id="Information_Technology_on" name="Information_Technology_on"
                                                        value="{{ $data1->Information_Technology_on }}">
                                                </div>
                                            </div>
                                        @endif



                                        <div class="sub-head">
                                            Contract Giver
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                @if($data1->ContractGiver_Review!=='yes')
                                                $('.ContractGiver').hide();

                                                $('[name="ContractGiver_Review"]').change(function() {
                                                    if ($(this).val() === 'yes') {

                                                        $('.ContractGiver').show();
                                                        $('.ContractGiver span').show();
                                                    } else {
                                                        $('.ContractGiver').hide();
                                                        $('.ContractGiver span').hide();
                                                    }
                                                });
                                                @endif
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
                                                    <label for="Contract Giver"> Contract Giver Required ? <span
                                                            class="text-danger">*</span></label>
                                                    <select name="ContractGiver_Review" id="ContractGiver_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ContractGiver_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->ContractGiver_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->ContractGiver_Review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 60,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 store">
                                                <div class="group-input">
                                                    <label for="Contract Giver notification">Contract Giver Person <span id="asteriskPT"
                                                            style="display: {{ $data1->ContractGiver_Review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select @if ($data->stage == 4) disabled @endif name="ContractGiver_person"
                                                        class="ContractGiver_person" id="ContractGiver_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->ContractGiver_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Contract Giver assessment">Impact Assessment (By Contract Giver) <span
                                                            id="asteriskPT1"
                                                            style="display: {{ $data1->ContractGiver_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea @if ($data1->ContractGiver_Review == 'yes' && $data->stage == 4) required @endif class="summernote ContractGiver_assessment"
                                                    @if ($data->stage == 3 || (isset($data1->ContractGiver_person) && Auth::user()->name != $data1->ContractGiver_person)) readonly @endif name="ContractGiver_assessment" id="summernote-17">{{ $data1->ContractGiver_assessment }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Contract Giver feedback">Contract Giver Feedback <span id="asteriskPT2"
                                                            style="display: {{ $data1->ContractGiver_Review == 'yes' && $data->stage == 4 ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <div><small class="text-primary">Please insert "NA" in the data field if it
                                                            does not require completion</small></div>
                                                    <textarea class="summernote ContractGiver_feedback" @if ($data->stage == 3 || (isset($data1->ContractGiver_person) && Auth::user()->name != $data1->ContractGiver_person)) readonly @endif
                                                        name="ContractGiver_feedback" id="summernote-18" @if ($data1->ContractGiver_Review == 'yes' && $data->stage == 4) required @endif>{{ $data1->ContractGiver_feedback }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 store">
                                                <div class="group-input">
                                                    <label for="Contract Giver attachment">Contract Giver Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="ContractGiver_attachment">
                                                            @if ($data1->ContractGiver_attachment)
                                                                @foreach (json_decode($data1->ContractGiver_attachment) as $file)
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile"
                                                                name="ContractGiver_attachment[]"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                                oninput="addMultipleFiles(this, 'ContractGiver_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 store">
                                                <div class="group-input">
                                                    <label for="Contract Giver Completed By">Contract Giver Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->ContractGiver_by }}"
                                                        name="ContractGiver_by"{{ $data->stage == 0 || $data->stage == 7 ? 'readonly' : '' }}
                                                        id="ContractGiver_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 store">
                                                <div class="group-input ">
                                                    <label for="Contract Giver Completed On">Contract Giver Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input type="date"id="ContractGiver_on"
                                                        name="ContractGiver_on"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
                                                        value="{{ $data1->ContractGiver_on }}">
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var selectField = document.getElementById('ContractGiver_Review');
                                                    var inputsToToggle = [];

                                                    // Add elements with class 'facility-name' to inputsToToggle
                                                    var facilityNameInputs = document.getElementsByClassName('ContractGiver_person');
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
                                                    <label for="Contract Giver">Contract Giver Required ?</label>
                                                    <select name="ContractGiver_Review" disabled id="ContractGiver_Review">
                                                        <option value="">-- Select --</option>
                                                        <option @if ($data1->ContractGiver_Review == 'yes') selected @endif value='yes'>
                                                            Yes</option>
                                                        <option @if ($data1->ContractGiver_Review == 'no') selected @endif value='no'>
                                                            No</option>
                                                        <option @if ($data1->ContractGiver_Review == 'na') selected @endif value='na'>
                                                            NA</option>
                                                    </select>

                                                </div>
                                            </div>
                                            @php
                                                $userRoles = DB::table('user_roles')
                                                    ->where([
                                                        'q_m_s_roles_id' => 60,
                                                        'q_m_s_divisions_id' => $data->division_id,
                                                    ])
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 ContractGiver">
                                                <div class="group-input">
                                                    <label for="Contract Giver notification">Contract Giver Person <span id="asteriskInvi11"
                                                            style="display: none" class="text-danger">*</span></label>
                                                    <select name="ContractGiver_person" disabled id="ContractGiver_person">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->name }}" @if ($user->name == $data1->ContractGiver_person) selected @endif>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($data->stage == 4)
                                                <div class="col-md-12 mb-3 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver assessment">Impact Assessment (By Contract Giver)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="ContractGiver_assessment" id="summernote-17">{{ $data1->ContractGiver_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver feedback">Contract Giver Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea class="tiny" name="ContractGiver_feedback" id="summernote-18">{{ $data1->ContractGiver_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12 mb-3 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver assessment">Impact Assessment (By Contract Giver)</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="ContractGiver_assessment" id="summernote-17">{{ $data1->ContractGiver_assessment }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3 ContractGiver">
                                                    <div class="group-input">
                                                        <label for="Contract Giver feedback">Contract Giver Feedback</label>
                                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                                does not require completion</small></div>
                                                        <textarea disabled class="tiny" name="ContractGiver_feedback" id="summernote-18">{{ $data1->ContractGiver_feedback }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 ContractGiver">
                                                <div class="group-input">
                                                    <label for="Contract Giver attachment">Contract Giver Attachments</label>
                                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                                            documents</small></div>
                                                    <div class="file-attachment-field">
                                                        <div disabled class="file-attachment-list" id="ContractGiver_attachment">
                                                            @if ($data1->ContractGiver_attachment)
                                                                @foreach (json_decode($data1->ContractGiver_attachment) as $file)
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
                                                                id="myfile" name="ContractGiver_attachment[]"
                                                                oninput="addMultipleFiles(this, 'ContractGiver_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 ContractGiver">
                                                <div class="group-input">
                                                    <label for="Contract Giver Completed By">Contract Giver Completed
                                                        By</label>
                                                    <input readonly type="text" value="{{ $data1->ContractGiver_by }}"
                                                        name="ContractGiver_by" id="ContractGiver_by">


                                                </div>
                                            </div>
                                            <div class="col-lg-6 ContractGiver">
                                                <div class="group-input">
                                                    <label for="Contract Giver Completed On">Contract Giver Completed
                                                        On</label>
                                                    <!-- <div><small class="text-primary">Please select related information</small></div> -->
                                                    <input readonly type="date" id="ContractGiver_on" name="ContractGiver_on"
                                                        value="{{ $data1->ContractGiver_on }}">
                                                </div>
                                            </div>
                                        @endif


                                        @if ($data->stage == 3 || $data->stage == 4)
                                            <div class="sub-head">
                                                Other's 1 ( Additional Person Review From Departments If Required)
                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                 @if($data1->Other1_review!=='yes')
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
                                                    @endif
                                                });
                                            </script>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Review Required1"> Other's 1 Review Required? </label>
                                                    <select name="Other1_review" @if ($data->stage == 4) disabled @endif id="Other1_review"
                                                        value="{{ $data1->Other1_review }}">
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
                                                    ->select('user_id')
                                                    ->distinct()
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 other1_reviews ">
                                                <div class="group-input">
                                                    <label for="Person1"> Other's 1 Person <span id="asterisko1"
                                                            style="display: {{ $data1->Other1_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <select name="Other1_person" @if ($data->stage == 4) disabled @endif id="Other1_person">
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
                                                    <select name="Other1_Department_person" @if ($data->stage == 4) disabled @endif
                                                        id="Other1_Department_person" value="{{ $data1->Other1_Department_person }}">
                                                            <option value="CQA" @if ($data1->Other1_Department_person == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                                            <option value="QA" @if ($data1->Other1_Department_person == 'QA') selected @endif>Quality Assurance</option>
                                                            <option value="QC" @if ($data1->Other1_Department_person == 'QC') selected @endif>Quality Control</option>
                                                            <option value="QM" @if ($data1->Other1_Department_person == 'QM') selected @endif>Quality Control (Microbiology department)
                                                            </option>
                                                            <option value="PG" @if ($data1->Other1_Department_person == 'PG') selected @endif>Production General</option>
                                                            <option value="PL" @if ($data1->Other1_Department_person == 'PL') selected @endif>Production Liquid Orals</option>
                                                            <option value="PT" @if ($data1->Other1_Department_person == 'PT') selected @endif>Production Tablet and Powder</option>
                                                            <option value="PE" @if ($data1->Other1_Department_person == 'PE') selected @endif>Production External (Ointment, Gels, Creams and
                                                                Liquid)</option>
                                                            <option value="PC" @if ($data1->Other1_Department_person == 'PC') selected @endif>Production Capsules</option>
                                                            <option value="PI" @if ($data1->Other1_Department_person == 'PI') selected @endif>Production Injectable</option>
                                                            <option value="EN" @if ($data1->Other1_Department_person == 'EN') selected @endif>Engineering</option>
                                                            <option value="HR" @if ($data1->Other1_Department_person == 'HR') selected @endif>Human Resource</option>
                                                            <option value="ST" @if ($data1->Other1_Department_person == 'ST') selected @endif>Store</option>
                                                            <option value="IT" @if ($data1->Other1_Department_person == 'IT') selected @endif>Electronic Data Processing
                                                            </option>
                                                            <option value="FD" @if ($data1->Other1_Department_person == 'FD') selected @endif>Formulation Development
                                                            </option>
                                                            <option value="AL" @if ($data1->Other1_Department_person == 'AL') selected @endif>Analytical research and Development
                                                                Laboratory
                                                            </option>
                                                            <option value="PD" @if ($data1->Other1_Department_person == 'PD') selected @endif>Packaging Development
                                                            </option>
                                                            <option value="PU" @if ($data1->Other1_Department_person == 'PU') selected @endif>Purchase Department
                                                            </option>
                                                            <option value="DC" @if ($data1->Other1_Department_person == 'DC') selected @endif>Document Cell
                                                            </option>
                                                            <option value="RA" @if ($data1->Other1_Department_person == 'RA') selected @endif>Regulatory Affairs
                                                            </option>
                                                            <option value="PV" @if ($data1->Other1_Department_person == 'PV') selected @endif>Pharmacovigilance
                                                            </option>
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Other1_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Other1_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 other1_reviews ">
                                                <div class="group-input">
                                                    <label for="Review Completed By1"> Other's 1 Review Completed By</label>
                                                    <input disabled type="text" value="{{ $data1->Other1_by }}" name="Other1_by" id="Other1_by">

                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 other1_reviews ">
                                                <div class="group-input">
                                                    <label for="Review Completed On1">Other's 1 Review Completed On</label>
                                                    <input disabled type="date" name="Other1_on" id="Other1_on" value="{{ $data1->Other1_on }}">

                                                </div>
                                            </div>
                                            <div class="sub-head">
                                                Other's 2 ( Additional Person Review From Departments If Required)
                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                    @if($data1->Other2_review!=='yes')
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
                                                    @endif
                                                });
                                            </script>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="review2"> Other's 2 Review Required ?</label>
                                                    <select name="Other2_review" @if ($data->stage == 4) disabled @endif id="Other2_review"
                                                        value="{{ $data1->Other2_review }}">
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
                                                    ->select('user_id')
                                                    ->distinct()
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Other2_reviews">
                                                <div class="group-input">
                                                    <label for="Person2"> Other's 2 Person <span id="asterisko2"
                                                            style="display: {{ $data1->Other2_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <select name="Other2_person" @if ($data->stage == 4) disabled @endif id="Other2_person">
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
                                                    <select name="Other2_Department_person" @if ($data->stage == 4) disabled @endif
                                                        id="Other2_Department_person">
                                                        <option value="">-- Select --</option>
                                                        <option value="CQA" @if ($data1->Other2_Department_person == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                                        <option value="QA" @if ($data1->Other2_Department_person == 'QA') selected @endif>Quality Assurance</option>
                                                        <option value="QC" @if ($data1->Other2_Department_person == 'QC') selected @endif>Quality Control</option>
                                                        <option value="QM" @if ($data1->Other2_Department_person == 'QM') selected @endif>Quality Control (Microbiology department)
                                                        </option>
                                                        <option value="PG" @if ($data1->Other2_Department_person == 'PG') selected @endif>Production General</option>
                                                        <option value="PL" @if ($data1->Other2_Department_person == 'PL') selected @endif>Production Liquid Orals</option>
                                                        <option value="PT" @if ($data1->Other2_Department_person == 'PT') selected @endif>Production Tablet and Powder</option>
                                                        <option value="PE" @if ($data1->Other2_Department_person == 'PE') selected @endif>Production External (Ointment, Gels, Creams and
                                                            Liquid)</option>
                                                        <option value="PC" @if ($data1->Other2_Department_person == 'PC') selected @endif>Production Capsules</option>
                                                        <option value="PI" @if ($data1->Other2_Department_person == 'PI') selected @endif>Production Injectable</option>
                                                        <option value="EN" @if ($data1->Other2_Department_person == 'EN') selected @endif>Engineering</option>
                                                        <option value="HR" @if ($data1->Other2_Department_person == 'HR') selected @endif>Human Resource</option>
                                                        <option value="ST" @if ($data1->Other2_Department_person == 'ST') selected @endif>Store</option>
                                                        <option value="IT" @if ($data1->Other2_Department_person == 'IT') selected @endif>Electronic Data Processing
                                                        </option>
                                                        <option value="FD" @if ($data1->Other2_Department_person == 'FD') selected @endif>Formulation Development
                                                        </option>
                                                        <option value="AL" @if ($data1->Other2_Department_person == 'AL') selected @endif>Analytical research and Development
                                                            Laboratory
                                                        </option>
                                                        <option value="PD" @if ($data1->Other2_Department_person == 'PD') selected @endif>Packaging Development
                                                        </option>
                                                        <option value="PU" @if ($data1->Other2_Department_person == 'PU') selected @endif>Purchase Department
                                                        </option>
                                                        <option value="DC" @if ($data1->Other2_Department_person == 'DC') selected @endif>Document Cell
                                                        </option>
                                                        <option value="RA" @if ($data1->Other2_Department_person == 'RA') selected @endif>Regulatory Affairs
                                                        </option>
                                                        <option value="PV" @if ($data1->Other2_Department_person == 'PV') selected @endif>Pharmacovigilance
                                                        </option>


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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Other2_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Other2_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Other2_reviews">
                                                <div class="group-input">
                                                    <label for="Review Completed By2"> Other's 2 Review Completed By</label>
                                                    <input type="text" name="Other2_by" id="Other2_by" value="{{ $data1->Other2_by }}" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Other2_reviews">
                                                <div class="group-input">
                                                    <label for="Review Completed On2">Other's 2 Review Completed On</label>
                                                    <input disabled type="date" name="Other2_on" id="Other2_on" value="{{ $data1->Other2_on }}">
                                                </div>
                                            </div>

                                            <div class="sub-head">
                                                Other's 3 ( Additional Person Review From Departments If Required)
                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                 @if($data1->Other3_review!=='yes')
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
                                                    @endif
                                                });
                                            </script>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="review3"> Other's 3 Review Required ?</label>
                                                    <select name="Other3_review" @if ($data->stage == 4) disabled @endif id="Other3_review"
                                                        value="{{ $data1->Other3_review }}">
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
                                                    ->select('user_id')
                                                    ->distinct()
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Other3_reviews">
                                                <div class="group-input">
                                                    <label for="Person3">Other's 3 Person <span id="asterisko3"
                                                            style="display: {{ $data1->Other3_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <select name="Other3_person" @if ($data->stage == 4) disabled @endif id="Other3_person">
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
                                                    <select name="Other3_Department_person" @if ($data->stage == 4) disabled @endif
                                                        id="Other3_Department_person">
                                                        <option value="">-- Select --</option>
                                                        <option value="CQA" @if ($data1->Other3_Department_person == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                                        <option value="QA" @if ($data1->Other3_Department_person == 'QA') selected @endif>Quality Assurance</option>
                                                        <option value="QC" @if ($data1->Other3_Department_person == 'QC') selected @endif>Quality Control</option>
                                                        <option value="QM" @if ($data1->Other3_Department_person == 'QM') selected @endif>Quality Control (Microbiology department)
                                                        </option>
                                                        <option value="PG" @if ($data1->Other3_Department_person == 'PG') selected @endif>Production General</option>
                                                        <option value="PL" @if ($data1->Other3_Department_person == 'PL') selected @endif>Production Liquid Orals</option>
                                                        <option value="PT" @if ($data1->Other3_Department_person == 'PT') selected @endif>Production Tablet and Powder</option>
                                                        <option value="PE" @if ($data1->Other3_Department_person == 'PE') selected @endif>Production External (Ointment, Gels, Creams and
                                                            Liquid)</option>
                                                        <option value="PC" @if ($data1->Other3_Department_person == 'PC') selected @endif>Production Capsules</option>
                                                        <option value="PI" @if ($data1->Other3_Department_person == 'PI') selected @endif>Production Injectable</option>
                                                        <option value="EN" @if ($data1->Other3_Department_person == 'EN') selected @endif>Engineering</option>
                                                        <option value="HR" @if ($data1->Other3_Department_person == 'HR') selected @endif>Human Resource</option>
                                                        <option value="ST" @if ($data1->Other3_Department_person == 'ST') selected @endif>Store</option>
                                                        <option value="IT" @if ($data1->Other3_Department_person == 'IT') selected @endif>Electronic Data Processing
                                                        </option>
                                                        <option value="FD" @if ($data1->Other3_Department_person == 'FD') selected @endif>Formulation Development
                                                        </option>
                                                        <option value="AL" @if ($data1->Other3_Department_person == 'AL') selected @endif>Analytical research and Development
                                                            Laboratory
                                                        </option>
                                                        <option value="PD" @if ($data1->Other3_Department_person == 'PD') selected @endif>Packaging Development
                                                        </option>
                                                        <option value="PU" @if ($data1->Other3_Department_person == 'PU') selected @endif>Purchase Department
                                                        </option>
                                                        <option value="DC" @if ($data1->Other3_Department_person == 'DC') selected @endif>Document Cell
                                                        </option>
                                                        <option value="RA" @if ($data1->Other3_Department_person == 'RA') selected @endif>Regulatory Affairs
                                                        </option>
                                                        <option value="PV" @if ($data1->Other3_Department_person == 'PV') selected @endif>Pharmacovigilance
                                                        </option>

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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Other3_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Other3_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Other3_reviews">
                                                <div class="group-input">
                                                    <label for="productionfeedback"> Other's 3 Review Completed By</label>
                                                    <input type="text" name="Other3_by" id="Other3_by" value="{{ $data1->Other3_by }}" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Other3_reviews">
                                                <div class="group-input">
                                                    <label for="productionfeedback">Other's 3 Review Completed On</label>
                                                    <input disabled type="date" name="Other3_on" id="Other3_on" value="{{ $data1->Other3_on }}">
                                                </div>
                                            </div>
                                            <div class="sub-head">
                                                Other's 4 ( Additional Person Review From Departments If Required)
                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                    @if($data1->Other4_review!=='yes')
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
                                                    @endif
                                                });
                                            </script>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="review4">Other's 4 Review Required ?</label>
                                                    <select name="Other4_review" @if ($data->stage == 4) disabled @endif id="Other4_review"
                                                        value="{{ $data1->Other4_review }}">
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
                                                    ->select('user_id')
                                                    ->distinct()
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Other4_reviews">
                                                <div class="group-input">
                                                    <label for="Person4"> Other's 4 Person <span id="asterisko4"
                                                            style="display: {{ $data1->Other4_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span></label>
                                                    <select name="Other4_person" @if ($data->stage == 4) disabled @endif id="Other4_person">
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
                                                    <select name="Other4_Department_person" @if ($data->stage == 4) disabled @endif
                                                        id="Other4_Department_person">
                                                        <option value="">-- Select --</option>
                                                        <option value="CQA" @if ($data1->Other4_Department_person == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                                        <option value="QA" @if ($data1->Other4_Department_person == 'QA') selected @endif>Quality Assurance</option>
                                                        <option value="QC" @if ($data1->Other4_Department_person == 'QC') selected @endif>Quality Control</option>
                                                        <option value="QM" @if ($data1->Other4_Department_person == 'QM') selected @endif>Quality Control (Microbiology department)
                                                        </option>
                                                        <option value="PG" @if ($data1->Other4_Department_person == 'PG') selected @endif>Production General</option>
                                                        <option value="PL" @if ($data1->Other4_Department_person == 'PL') selected @endif>Production Liquid Orals</option>
                                                        <option value="PT" @if ($data1->Other4_Department_person == 'PT') selected @endif>Production Tablet and Powder</option>
                                                        <option value="PE" @if ($data1->Other4_Department_person == 'PE') selected @endif>Production External (Ointment, Gels, Creams and
                                                            Liquid)</option>
                                                        <option value="PC" @if ($data1->Other4_Department_person == 'PC') selected @endif>Production Capsules</option>
                                                        <option value="PI" @if ($data1->Other4_Department_person == 'PI') selected @endif>Production Injectable</option>
                                                        <option value="EN" @if ($data1->Other4_Department_person == 'EN') selected @endif>Engineering</option>
                                                        <option value="HR" @if ($data1->Other4_Department_person == 'HR') selected @endif>Human Resource</option>
                                                        <option value="ST" @if ($data1->Other4_Department_person == 'ST') selected @endif>Store</option>
                                                        <option value="IT" @if ($data1->Other4_Department_person == 'IT') selected @endif>Electronic Data Processing
                                                        </option>
                                                        <option value="FD" @if ($data1->Other4_Department_person == 'FD') selected @endif>Formulation Development
                                                        </option>
                                                        <option value="AL" @if ($data1->Other4_Department_person == 'AL') selected @endif>Analytical research and Development
                                                            Laboratory
                                                        </option>
                                                        <option value="PD" @if ($data1->Other4_Department_person == 'PD') selected @endif>Packaging Development
                                                        </option>
                                                        <option value="PU" @if ($data1->Other4_Department_person == 'PU') selected @endif>Purchase Department
                                                        </option>
                                                        <option value="DC" @if ($data1->Other4_Department_person == 'DC') selected @endif>Document Cell
                                                        </option>
                                                        <option value="RA" @if ($data1->Other4_Department_person == 'RA') selected @endif>Regulatory Affairs
                                                        </option>
                                                        <option value="PV" @if ($data1->Other4_Department_person == 'PV') selected @endif>Pharmacovigilance
                                                        </option>

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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Other4_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Other4_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Other4_reviews">
                                                <div class="group-input">
                                                    <label for="Review Completed By4"> Other's 4 Review Completed By</label>
                                                    <input type="text" name="Other4_by" id="Other4_by" value="{{ $data1->Other4_by }}" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Other4_reviews">
                                                <div class="group-input">
                                                    <label for="Review Completed On4">Other's 4 Review Completed On</label>
                                                    <input disabled type="date" name="Other4_on" id="Other4_on" value="{{ $data1->Other4_on }}">

                                                </div>
                                            </div>



                                            <div class="sub-head">
                                                Other's 5 ( Additional Person Review From Departments If Required)
                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                   @if($data1->Other5_review!=='yes')
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
                                                    @endif
                                                });
                                            </script>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="review5">Other's 5 Review Required ?</label>
                                                    <select name="Other5_review" @if ($data->stage == 4) disabled @endif id="Other5_review"
                                                        value="{{ $data1->Other5_review }}">
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
                                                    ->select('user_id')
                                                    ->distinct()
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6 Other5_reviews">
                                                <div class="group-input">
                                                    <label for="Person5">Other's 5 Person
                                                        <span id="asterisko5" style="display: {{ $data1->Other5_review == 'yes' ? 'inline' : 'none' }}"
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select name="Other5_person" @if ($data->stage == 4) disabled @endif id="Other5_person">
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
                                                    <select name="Other5_Department_person" @if ($data->stage == 4) disabled @endif
                                                        id="Other5_Department_person">
                                                        <option value="">-- Select --</option>
                                                        <option value="CQA" @if ($data1->Other5_Department_person == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                                        <option value="QA" @if ($data1->Other5_Department_person == 'QA') selected @endif>Quality Assurance</option>
                                                        <option value="QC" @if ($data1->Other5_Department_person == 'QC') selected @endif>Quality Control</option>
                                                        <option value="QM" @if ($data1->Other5_Department_person == 'QM') selected @endif>Quality Control (Microbiology department)
                                                        </option>
                                                        <option value="PG" @if ($data1->Other5_Department_person == 'PG') selected @endif>Production General</option>
                                                        <option value="PL" @if ($data1->Other5_Department_person == 'PL') selected @endif>Production Liquid Orals</option>
                                                        <option value="PT" @if ($data1->Other5_Department_person == 'PT') selected @endif>Production Tablet and Powder</option>
                                                        <option value="PE" @if ($data1->Other5_Department_person == 'PE') selected @endif>Production External (Ointment, Gels, Creams and
                                                            Liquid)</option>
                                                        <option value="PC" @if ($data1->Other5_Department_person == 'PC') selected @endif>Production Capsules</option>
                                                        <option value="PI" @if ($data1->Other5_Department_person == 'PI') selected @endif>Production Injectable</option>
                                                        <option value="EN" @if ($data1->Other5_Department_person == 'EN') selected @endif>Engineering</option>
                                                        <option value="HR" @if ($data1->Other5_Department_person == 'HR') selected @endif>Human Resource</option>
                                                        <option value="ST" @if ($data1->Other5_Department_person == 'ST') selected @endif>Store</option>
                                                        <option value="IT" @if ($data1->Other5_Department_person == 'IT') selected @endif>Electronic Data Processing
                                                        </option>
                                                        <option value="FD" @if ($data1->Other5_Department_person == 'FD') selected @endif>Formulation Development
                                                        </option>
                                                        <option value="AL" @if ($data1->Other5_Department_person == 'AL') selected @endif>Analytical research and Development
                                                            Laboratory
                                                        </option>
                                                        <option value="PD" @if ($data1->Other5_Department_person == 'PD') selected @endif>Packaging Development
                                                        </option>
                                                        <option value="PU" @if ($data1->Other5_Department_person == 'PU') selected @endif>Purchase Department
                                                        </option>
                                                        <option value="DC" @if ($data1->Other5_Department_person == 'DC') selected @endif>Document Cell
                                                        </option>
                                                        <option value="RA" @if ($data1->Other5_Department_person == 'RA') selected @endif>Regulatory Affairs
                                                        </option>
                                                        <option value="PV" @if ($data1->Other5_Department_person == 'PV') selected @endif>Pharmacovigilance
                                                        </option>

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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Other5_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Other5_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Other5_reviews">
                                                <div class="group-input">
                                                    <label for="Review Completed By5"> Other's 5 Review Completed By</label>
                                                    <input type="text" name="Other5_by" id="Other5_by" value="{{ $data1->Other5_by }}" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3 Other5_reviews">
                                                <div class="group-input">
                                                    <label for="Review Completed On5">Other's 5 Review Completed On</label>
                                                    <input disabled type="date" name="Other5_on" id="Other5_on" value="{{ $data1->Other5_on }}">
                                                </div>
                                            </div>
                                        @else
                                            <div class="sub-head">
                                                Other's 1 ( Additional Person Review From Departments If Required)
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Review Required1"> Other's 1 Review Required? </label>
                                                    <select disabled name="Other1_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
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
                                                    ->select('user_id')
                                                    ->distinct()
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Person1"> Other's 1 Person </label>
                                                    <select disabled name="Other1_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
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
                                                        id="Other1_Department_person" value="{{ $data1->Other1_Department_person }}">
                                                        <option value="0">-- Select --</option>
                                                        <option @if ($data1->Other1_Department_person == 'Production') selected @endif value="Production">Production</option>
                                                        <option @if ($data1->Other1_Department_person == 'Warehouse') selected @endif value="Warehouse"> Warehouse</option>
                                                        <option @if ($data1->Other1_Department_person == 'Quality_Control') selected @endif value="Quality_Control">Quality Control
                                                        </option>
                                                        <option @if ($data1->Other1_Department_person == 'Quality_Assurance') selected @endif value="Quality_Assurance">Quality
                                                            Assurance</option>
                                                        <option @if ($data1->Other1_Department_person == 'Engineering') selected @endif value="Engineering">Engineering</option>
                                                        <option @if ($data1->Other1_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                            value="Analytical_Development_Laboratory">Analytical Development
                                                            Laboratory</option>
                                                        <option @if ($data1->Other1_Department_person == 'Process_Development_Lab') selected @endif value="Process_Development_Lab">Process
                                                            Development Laboratory / Kilo Lab
                                                        </option>
                                                        <option @if ($data1->Other1_Department_person == 'Technology transfer/Design') selected @endif value="Technology transfer/Design">
                                                            Technology Transfer/Design</option>
                                                        <option @if ($data1->Other1_Department_person == 'Environment, Health & Safety') selected @endif value="Environment, Health & Safety">
                                                            Environment, Health & Safety</option>
                                                        <option @if ($data1->Other1_Department_person == 'Human Resource & Administration') selected @endif value="Human Resource & Administration">
                                                            Human Resource & Administration
                                                        </option>
                                                        <option @if ($data1->Other1_Department_person == 'Information Technology') selected @endif value="Information Technology">
                                                            Information Technology</option>
                                                        <option @if ($data1->Other1_Department_person == 'Project management') selected @endif value="Project management">Project
                                                            management</option>

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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Other1_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Other1_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="group-input">
                                                    <label for="Review Completed By1"> Other's 1 Review Completed By</label>
                                                    <input disabled type="text" value="{{ $data1->Other1_by }}" name="Other1_by" id="Other1_by">

                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="group-input">
                                                    <label for="Review Completed On1">Other's 1 Review Completed On</label>
                                                    <input disabled type="date" name="Other1_on" id="Other1_on" value="{{ $data1->Other1_on }}">

                                                </div>
                                            </div>

                                            <div class="sub-head">
                                                Other's 2 ( Additional Person Review From Departments If Required)
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="review2"> Other's 2 Review Required ?</label>
                                                    <select disabled name="Other2_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
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
                                                    ->select('user_id')
                                                    ->distinct()
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Person2"> Other's 2 Person</label>
                                                    <select disabled name="Other2_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
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
                                                        <option @if ($data1->Other2_Department_person == 'Production') selected @endif value="Production">Production</option>
                                                        <option @if ($data1->Other2_Department_person == 'Warehouse') selected @endif value="Warehouse"> Warehouse</option>
                                                        <option @if ($data1->Other2_Department_person == 'Quality_Control') selected @endif value="Quality_Control">Quality Control
                                                        </option>
                                                        <option @if ($data1->Other2_Department_person == 'Quality_Assurance') selected @endif value="Quality_Assurance">Quality
                                                            Assurance</option>
                                                        <option @if ($data1->Other2_Department_person == 'Engineering') selected @endif value="Engineering">Engineering</option>
                                                        <option @if ($data1->Other2_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                            value="Analytical_Development_Laboratory">Analytical Development
                                                            Laboratory</option>
                                                        <option @if ($data1->Other2_Department_person == 'Process_Development_Lab') selected @endif value="Process_Development_Lab">Process
                                                            Development Laboratory / Kilo Lab
                                                        </option>
                                                        <option @if ($data1->Other2_Department_person == 'Technology transfer/Design') selected @endif value="Technology transfer/Design">
                                                            Technology Transfer/Design</option>
                                                        <option @if ($data1->Other2_Department_person == 'Environment, Health & Safety') selected @endif value="Environment, Health & Safety">
                                                            Environment, Health & Safety</option>
                                                        <option @if ($data1->Other2_Department_person == 'Human Resource & Administration') selected @endif value="Human Resource & Administration">
                                                            Human Resource & Administration
                                                        </option>
                                                        <option @if ($data1->Other2_Department_person == 'Information Technology') selected @endif value="Information Technology">
                                                            Information Technology</option>
                                                        <option @if ($data1->Other2_Department_person == 'Project management') selected @endif value="Project management">Project
                                                            management</option>

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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Other2_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Other2_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="group-input">
                                                    <label for="Review Completed By2"> Other's 2 Review Completed By</label>
                                                    <input type="text" name="Other2_by" id="Other2_by" value="{{ $data1->Other2_by }}" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="group-input">
                                                    <label for="Review Completed On2">Other's 2 Review Completed On</label>
                                                    <input disabled type="date" name="Other2_on" id="Other2_on" value="{{ $data1->Other2_on }}">
                                                </div>
                                            </div>

                                            <div class="sub-head">
                                                Other's 3 ( Additional Person Review From Departments If Required)
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="review3"> Other's 3 Review Required ?</label>
                                                    <select disabled name="Other3_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
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
                                                    ->select('user_id')
                                                    ->distinct()
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Person3">Other's 3 Person</label>
                                                    <select disabled name="Other3_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
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
                                                        <option @if ($data1->Other3_Department_person == 'Production') selected @endif value="Production">Production</option>
                                                        <option @if ($data1->Other3_Department_person == 'Warehouse') selected @endif value="Warehouse"> Warehouse</option>
                                                        <option @if ($data1->Other3_Department_person == 'Quality_Control') selected @endif value="Quality_Control">Quality Control
                                                        </option>
                                                        <option @if ($data1->Other3_Department_person == 'Quality_Assurance') selected @endif value="Quality_Assurance">Quality
                                                            Assurance</option>
                                                        <option @if ($data1->Other3_Department_person == 'Engineering') selected @endif value="Engineering">Engineering</option>
                                                        <option @if ($data1->Other3_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                            value="Analytical_Development_Laboratory">Analytical Development
                                                            Laboratory</option>
                                                        <option @if ($data1->Other3_Department_person == 'Process_Development_Lab') selected @endif value="Process_Development_Lab">Process
                                                            Development Laboratory / Kilo Lab
                                                        </option>
                                                        <option @if ($data1->Other3_Department_person == 'Technology transfer/Design') selected @endif value="Technology transfer/Design">
                                                            Technology Transfer/Design</option>
                                                        <option @if ($data1->Other3_Department_person == 'Environment, Health & Safety') selected @endif value="Environment, Health & Safety">
                                                            Environment, Health & Safety</option>
                                                        <option @if ($data1->Other3_Department_person == 'Human Resource & Administration') selected @endif value="Human Resource & Administration">
                                                            Human Resource & Administration
                                                        </option>
                                                        <option @if ($data1->Other3_Department_person == 'Information Technology') selected @endif value="Information Technology">
                                                            Information Technology</option>
                                                        <option @if ($data1->Other3_Department_person == 'Project management') selected @endif value="Project management">Project
                                                            management</option>
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Other3_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Other3_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="group-input">
                                                    <label for="productionfeedback"> Other's 3 Review Completed By</label>
                                                    <input type="text" name="Other3_by" id="Other3_by" value="{{ $data1->Other3_by }}" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="group-input">
                                                    <label for="productionfeedback">Other's 3 Review Completed On</label>
                                                    <input disabled type="date" name="Other3_on" id="Other3_on" value="{{ $data1->Other3_on }}">
                                                </div>
                                            </div>
                                            <div class="sub-head">
                                                Other's 4 ( Additional Person Review From Departments If Required)
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="review4">Other's 4 Review Required ?</label>
                                                    <select disabled name="Other4_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
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
                                                    ->select('user_id')
                                                    ->distinct()
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Person4"> Other's 4 Person</label>
                                                    <select name="Other4_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
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
                                                        <option @if ($data1->Other4_Department_person == 'Production') selected @endif value="Production">Production</option>
                                                        <option @if ($data1->Other4_Department_person == 'Warehouse') selected @endif value="Warehouse"> Warehouse</option>
                                                        <option @if ($data1->Other4_Department_person == 'Quality_Control') selected @endif value="Quality_Control">Quality Control
                                                        </option>
                                                        <option @if ($data1->Other4_Department_person == 'Quality_Assurance') selected @endif value="Quality_Assurance">Quality
                                                            Assurance</option>
                                                        <option @if ($data1->Other4_Department_person == 'Engineering') selected @endif value="Engineering">Engineering</option>
                                                        <option @if ($data1->Other4_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                            value="Analytical_Development_Laboratory">Analytical Development
                                                            Laboratory</option>
                                                        <option @if ($data1->Other4_Department_person == 'Process_Development_Lab') selected @endif value="Process_Development_Lab">Process
                                                            Development Laboratory / Kilo Lab
                                                        </option>
                                                        <option @if ($data1->Other4_Department_person == 'Technology transfer/Design') selected @endif value="Technology transfer/Design">
                                                            Technology Transfer/Design</option>
                                                        <option @if ($data1->Other4_Department_person == 'Environment, Health & Safety') selected @endif value="Environment, Health & Safety">
                                                            Environment, Health & Safety</option>
                                                        <option @if ($data1->Other4_Department_person == 'Human Resource & Administration') selected @endif value="Human Resource & Administration">
                                                            Human Resource & Administration
                                                        </option>
                                                        <option @if ($data1->Other4_Department_person == 'Information Technology') selected @endif value="Information Technology">
                                                            Information Technology</option>
                                                        <option @if ($data1->Other4_Department_person == 'Project management') selected @endif value="Project management">Project
                                                            management</option>
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Other4_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Other4_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="group-input">
                                                    <label for="Review Completed By4"> Other's 4 Review Completed By</label>
                                                    <input type="text" name="Other4_by" id="Other4_by" value="{{ $data1->Other4_by }}" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="group-input">
                                                    <label for="Review Completed On4">Other's 4 Review Completed On</label>
                                                    <input disabled type="date" name="Other4_on" id="Other4_on" value="{{ $data1->Other4_on }}">

                                                </div>
                                            </div>



                                            <div class="sub-head">
                                                Other's 5 ( Additional Person Review From Departments If Required)
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="review5">Other's 5 Review Required ?</label>
                                                    <select disabled name="Other5_review"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
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
                                                    ->select('user_id')
                                                    ->distinct()
                                                    ->get();
                                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                                            @endphp
                                            <div class="col-lg-6">
                                                <div class="group-input">
                                                    <label for="Person5">Other's 5 Person</label>
                                                    <select disabled name="Other5_person"{{ $data->stage == 0 || $data->stage == 7 ? 'disabled' : '' }}
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
                                                        <option @if ($data1->Other5_Department_person == 'Production') selected @endif value="Production">Production</option>
                                                        <option @if ($data1->Other5_Department_person == 'Warehouse') selected @endif value="Warehouse"> Warehouse</option>
                                                        <option @if ($data1->Other5_Department_person == 'Quality_Control') selected @endif value="Quality_Control">Quality Control
                                                        </option>
                                                        <option @if ($data1->Other5_Department_person == 'Quality_Assurance') selected @endif value="Quality_Assurance">Quality
                                                            Assurance</option>
                                                        <option @if ($data1->Other5_Department_person == 'Engineering') selected @endif value="Engineering">Engineering</option>
                                                        <option @if ($data1->Other5_Department_person == 'Analytical_Development_Laboratory') selected @endif
                                                            value="Analytical_Development_Laboratory">Analytical Development
                                                            Laboratory</option>
                                                        <option @if ($data1->Other5_Department_person == 'Process_Development_Lab') selected @endif value="Process_Development_Lab">Process
                                                            Development Laboratory / Kilo Lab
                                                        </option>
                                                        <option @if ($data1->Other5_Department_person == 'Technology transfer/Design') selected @endif value="Technology transfer/Design">
                                                            Technology Transfer/Design</option>
                                                        <option @if ($data1->Other5_Department_person == 'Environment, Health & Safety') selected @endif value="Environment, Health & Safety">
                                                            Environment, Health & Safety</option>
                                                        <option @if ($data1->Other5_Department_person == 'Human Resource & Administration') selected @endif value="Human Resource & Administration">
                                                            Human Resource & Administration
                                                        </option>
                                                        <option @if ($data1->Other5_Department_person == 'Information Technology') selected @endif value="Information Technology">
                                                            Information Technology</option>
                                                        <option @if ($data1->Other5_Department_person == 'Project management') selected @endif value="Project management">Project
                                                            management</option>
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
                                                            <input {{ $data->stage == 0 || $data->stage == 6 ? 'disabled' : '' }} type="file"
                                                                id="myfile" name="Other5_attachment[]"
                                                                oninput="addMultipleFiles(this, 'Other5_attachment')" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="group-input">
                                                    <label for="Review Completed By5"> Other's 5 Review Completed By</label>
                                                    <input type="text" name="Other5_by" id="Other5_by" value="{{ $data1->Other5_by }}" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="group-input">
                                                    <label for="Review Completed On5">Other's 5 Review Completed On</label>
                                                    <input disabled type="date" name="Other5_on" id="Other5_on" value="{{ $data1->Other5_on }}">
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
                                            
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                        <button style=" justify-content: center; width: 4rem; margin-left: 1px;;" type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                                Exit </a> </button>
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

                                        @if ($data1->Production_Injection_Attachment)
                                            @foreach (json_decode($data1->Production_Injection_Attachment) as $file)
                                                <input id="productionInjectionAttachmentFile-{{ $loop->index }}" type="hidden"
                                                    name="existinProductionInjectionFile[{{ $loop->index }}]"
                                                    value="{{ $file }}">
                                            @endforeach
                                        @endif
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
                                                                <a type="button" class="remove-file" data-remove-id="existinProductionLiquidFile-{{ $loop->index }}"
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
                                        <div class="button-block">
                                            <button type="submit" class="saveButton">Save</button>
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
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

                                        @if ($data1->Production_Injection_Attachment)
                                            @foreach (json_decode($data1->Production_Injection_Attachment) as $file)
                                                <input id="productionInjectionAttachmentFile-{{ $loop->index }}" type="hidden"
                                                    name="existinProductionInjectionFile[{{ $loop->index }}]"
                                                    value="{{ $file }}">
                                            @endforeach
                                        @endif
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
                                                                <a type="button" class="remove-file" data-remove-id="existinProductionLiquidFile-{{ $loop->index }}"
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
                                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                                            </button>
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

                                @if ($closure->tran_attach)
                                    @foreach (json_decode($closure->tran_attach) as $file)
                                        <input id="trainingAttachmentFile-{{ $loop->index }}" type="hidden"
                                            name="existinTrainingFile[{{ $loop->index }}]"
                                            value="{{ $file }}">
                                    @endforeach
                                @endif
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
                                                        <a type="button" class="remove-file" data-remove-id="existinProductionLiquidFile-{{ $loop->index }}"
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
                                                                <option value="">-- Select --</option>
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
                                                                <option value="">Enter Your Selection Here</option>
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
                        <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                            <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                        </button>
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
                        <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;;">
                            <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a>
                        </button>
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


            <div class="modal fade" id="effectiveness-check-modal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Child</h4>
                        </div>
                        <form action="{{ route('CC-effectiveness-check', $data->id) }}" method="POST">
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="group-input">
                                    <label for="major">
                                        <input type="hidden" name="parent_name" value="CC">
                                        <input type="hidden" name="due_date" value="{{ $data->due_date }}">
                                        <input type="radio" name="child_type" value="effectiveness_check">
                                        Effectiveness Check
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
                            @if($data->stage == 3)
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="RCA">
                                    RCA
                                </label>
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Extension">
                                    Extension
                                </label>
                            @endif
                            @if($data->stage == 5)
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Capa">
                                    Capa
                                </label>
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Extension">
                                    Extension
                                </label>                            
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Action-Item">
                                    Action Item
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


    <!-- modal for stage 9 child-modal-stage_8 start-->

    <div class="modal fade" id="child-modal-stage_8">
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
                            @if($data->stage == 9)
                            <div>
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="RCA">
                                    RCA
                                </label>
                            </div>
                            <div>   
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Extension">
                                    Extension
                                </label> 
                            </div>   


                            @endif
                            @if($data->stage == 9)
                            <div>
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Capa">
                                    Capa
                                </label>
                                                        
                            </div>  
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





    <!-- modal for stage 9 child-modal-stage_8 End-->
    



    <div class="modal fade" id="child_effective_ness">
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
                            @if($data->stage == 13)
                            <div>
                                <label for="minor">
                                    <input type="radio" name="revision" id="minor" value="Effective-Check">
                                    Effectiveness Check
                                </label>
                            </div>
                           

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

    <!-- /************ Sent to QA Head Approval Modal ***********/ -->
    <div class="modal fade" id="qa-head-approval">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-qa-approval', $cc_lid) }}" method="POST">
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
                            <label for="comment">Comment</label>
                            <input type="comment" class="form-control" name="comments">
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
    <!-- /************ Sent to QA Head Approval Modal ***********/ -->

    <!-- /************ Sent to Post Implementation Modal ***********/ -->
    <div class="modal fade" id="send-post-implementation">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('rcms/send-post-implementation', $cc_lid) }}" method="POST">
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
                            <label for="comment">Comment</label>
                            <input type="comment" class="form-control" name="comments">
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
    <!-- /************ Sent to Post Implementation Modal ***********/ -->


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
        document.addEventListener('DOMContentLoaded', function () {
            const currentStage = document.getElementById('stage').value;
            
            if (currentStage > 2)
            {
                const RA_Review = document.getElementById('RA_Review').value;
                const qualityAssurnce = document.getElementById('Quality_Assurance_Review').value;
                const Production_Table_Review = document.getElementById('Production_Table_Review').value;
            const ProductionLiquid_Review = document.getElementById('ProductionLiquid_Review').value;
            const Production_Injection_Review = document.getElementById('Production_Injection_Review').value;
            const Store_Review = document.getElementById('Store_Review').value;
            const Quality_review = document.getElementById('Quality_review').value;
            const ResearchDevelopment_Review = document.getElementById('ResearchDevelopment_Review').value;
            const Engineering_review = document.getElementById('Engineering_review').value;
            const Human_Resource_review = document.getElementById('Human_Resource_review').value;
            const Microbiology_Review = document.getElementById('Microbiology_Review').value;
            const RegulatoryAffair_Review = document.getElementById('RegulatoryAffair_Review').value;
            const CorporateQualityAssurance_Review = document.getElementById('CorporateQualityAssurance_Review').value;
            const Environment_Health_review = document.getElementById('Environment_Health_review').value;
            const Information_Technology_review = document.getElementById('Information_Technology_review').value;
            const ContractGiver_Review = document.getElementById('ContractGiver_Review').value;


            function updateFieldAttributes() {
                if (currentStage == 3) {
                    RA_Review.required = true;
                    qualityAssurnce.required = true;
                    Production_Table_Review.required = true;
                    ProductionLiquid_Review.required = true;
                    Production_Injection_Review.required = true;
                    Store_Review.required = true;
                    Quality_review.required = true;
                    ResearchDevelopment_Review.required = true;
                    Engineering_review.required = true;
                    Human_Resource_review.required = true;
                    Microbiology_Review.required = true;
                    RegulatoryAffair_Review.required = true;
                    CorporateQualityAssurance_Review.required = true;
                    Environment_Health_review.required = true;
                    Information_Technology_review.required = true;
                    ContractGiver_Review.required = true;

                    RA_Review.disabled = false;
                    qualityAssurnce.disabled = false;
                    Production_Table_Review.disabled = false;
                    ProductionLiquid_Review.disabled = false;
                    Production_Injection_Review.disabled = false;
                    Store_Review.disabled = false;
                    Quality_review.disabled = false;
                    ResearchDevelopment_Review.disabled = false;
                    Engineering_review.disabled = false;
                    Human_Resource_review.disabled = false;
                    Microbiology_Review.disabled = false;
                    RegulatoryAffair_Review.disabled = false;
                    CorporateQualityAssurance_Review.disabled = false;
                    Environment_Health_review.disabled = false;
                    Information_Technology_review.disabled = false;
                    ContractGiver_Review.disabled = false;
                } else if (currentStage == 4) {
                    RA_Review.required = false;
                    qualityAssurnce.required = false;
                    Production_Table_Review.required = false;
                    ProductionLiquid_Review.required = false;
                    Production_Injection_Review.required = false;
                    Store_Review.required = false;
                    Quality_review.required = false;
                    ResearchDevelopment_Review.required = false;
                    Engineering_review.required = false;
                    Human_Resource_review.required = false;
                    Microbiology_Review.required = false;
                    RegulatoryAffair_Review.required = false;
                    CorporateQualityAssurance_Review.required = false;
                    Environment_Health_review.required = false;
                    Information_Technology_review.required = false;
                    ContractGiver_Review.required = false;

                    RA_Review.disabled = true;
                    qualityAssurnce.disabled = true;
                    Production_Table_Review.disabled = true;
                    ProductionLiquid_Review.disabled = true;
                    Production_Injection_Review.disabled = true;
                    Store_Review.disabled = true;
                    Quality_review.disabled = true;
                    ResearchDevelopment_Review.disabled = true;
                    Engineering_review.disabled = true;
                    Human_Resource_review.disabled = true;
                    Microbiology_Review.disabled = true;
                    RegulatoryAffair_Review.disabled = true;
                    CorporateQualityAssurance_Review.disabled = true;
                    Environment_Health_review.disabled = true;
                    Information_Technology_review.disabled = true;
                    ContractGiver_Review.disabled = true;
                }
            }
            updateFieldAttributes();
            document.getElementById('CCFormInput').addEventListener('submit', function () {
                if (currentStage == 4) {
                    RA_Review.disabled = false;
                    qualityAssurnce.disabled = false;
                    Production_Table_Review.disabled = false;
                    ProductionLiquid_Review.disabled = false;
                    Production_Injection_Review.disabled = false;
                    Store_Review.disabled = false;
                    Quality_review.disabled = false;
                    ResearchDevelopment_Review.disabled = false;
                    Engineering_review.disabled = false;
                    Human_Resource_review.disabled = false;
                    Microbiology_Review.disabled = false;
                    RegulatoryAffair_Review.disabled = false;
                    CorporateQualityAssurance_Review.disabled = false;
                    Environment_Health_review.disabled = false;
                    Information_Technology_review.disabled = false;
                    ContractGiver_Review.disabled = false;
                }
            });
            }
        });
    </script>

    <script>
        VirtualSelect.init({
            ele: '#related_records, #cft_reviewer, #risk_assessment_related_record, #concerned_department_review'
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
