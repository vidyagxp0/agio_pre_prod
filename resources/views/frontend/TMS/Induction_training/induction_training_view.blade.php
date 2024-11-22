@extends('frontend.layout.main')
@section('container')
    @php
        $users = DB::table('users')->get();
    @endphp
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>

    <style>
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

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(8) {
            border-radius: 0px 20px 20px 0px;

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


    <div class="form-field-head">

        <div class="division-bar">
            <strong>Induction Training</strong>
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

                    <div class="d-flex" style="gap:20px;">

                        @php
                            $userRoles = DB::table('user_roles')
                                ->where([
                                    'user_id' => Auth::user()->id,
                                    'q_m_s_divisions_id' => $inductionTraining->division_id,
                                ])
                                ->get();
                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                            // dd($jobTraining->division_id);
                        @endphp

                        <button class="button_theme1">
                            <a class="text-white" href="{{ route('induction_audittrail', $inductionTraining->id) }}"> Audit
                                Trail
                            </a>
                        </button>

                        @if ($inductionTraining->stage == 1)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Submit
                            </button>
                            {{-- @elseif($inductionTraining->stage == 2)
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                       Question-Answers
                    </button> --}}
                        @elseif($inductionTraining->stage == 2)
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                    Answer Submit
                    </button> --}}
                        @elseif($inductionTraining->stage == 3)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Evaluation Complete
                            </button>
                            {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                        Cancel
                    </button> --}}
                        @elseif($inductionTraining->stage == 4)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Approval Complete
                            </button>
                        @elseif($inductionTraining->stage == 5)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                QA/CQA Head Approval Complete
                            </button>
                        @elseif($inductionTraining->stage == 6)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Send To OJT
                            </button>
                        @elseif($inductionTraining->stage == 7)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                                Child
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                                Creation Complete
                            </button>
                        @endif
                        <button class="button_theme1"> <a class="text-white" href="{{ url('TMS') }}"> Exit
                            </a>
                        </button>
                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    @if ($inductionTraining->stage == 0)
                        <div class="progress-bars ">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars d-flex">
                            @if ($inductionTraining->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif

                            {{-- @if ($inductionTraining->stage >= 2)
                    <div class="active">Question-Answer</div>
                    @else
                    <div class="">Question-Answer</div>
                    @endif --}}

                            @if ($inductionTraining->stage >= 2)
                                <div class="active">Employee Answers</div>
                            @else
                                <div class="">Employee Answers</div>
                            @endif
                            @if ($inductionTraining->stage >= 3)
                                <div class="active">Evaluation</div>
                            @else
                                <div class="">Evaluation</div>
                            @endif

                            @if ($inductionTraining->stage >= 4)
                                <div class="active">HR Head Approval</div>
                            @else
                                <div class="">HR Head Approval</div>
                            @endif

                            @if ($inductionTraining->stage >= 5)
                                <div class="active">QA/CQA Head Approval</div>
                            @else
                                <div class="">QA/CQA Head Approval</div>
                            @endif
                            @if ($inductionTraining->stage >= 6)
                                <div class="active">In HR Final Review</div>
                            @else
                                <div class="">In HR Final Review</div>
                            @endif

                            @if ($inductionTraining->stage >= 7)
                                <div class="active">OJT Creation</div>
                            @else
                                <div class="">OJT Creation</div>
                            @endif

                            @if ($inductionTraining->stage >= 8)
                                <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif
                    @endif

                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
        </div>

        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
            {{-- @if ($inductionTraining->questionaries_required == 'Yes')
                    <button class="cctablinks" id="questionariesTab" onclick="openCity(event, 'CCForm2')">Questionaries</button>
                @else
                    <button class="cctablinks" id="questionariesTab" style="display: none;" onclick="openCity(event, 'CCForm2')">Questionaries</button>
                @endif --}}


            <!-- <button class="cctablinks" id="questionariesTab" style="display: none;" onclick="openCity(event, 'CCForm2')">Questionaries</button> -->


            <!-- <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Final Remarks</button> -->

            <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Evaluation</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm5')">HR Head Approval</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">QA/CQA Head Approval</button>
            @if ($inductionTraining->stage >= 6)
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Certificate</button>
            @endif
            <button class="cctablinks" onclick="openCity(event, 'CCForm7')">In HR Final Review</button>


            <button class="cctablinks" onclick="openCity(event, 'CCForm9')">On The Job Training</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm10')">Activity Log</button>

        </div>

        <script>
            $(document).ready(function() {
                <?php if (in_array($inductionTraining->stage, [8])) : ?>
                $("#target :input").prop("disabled", true);
                <?php endif; ?>
            });
        </script>

        <form id="target" action="{{ route('induction_training.update', $inductionTraining->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div id="step-form">

                {{-- @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif --}}
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <!-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number">Name of Employee</label>
                                        <input disabled type="text" name="name_employee_display" id="name_employee_display" maxlength="255" value="{{ $inductionTraining->name_employee }}">
                                        <input type="hidden" name="name_employee" value="{{ $inductionTraining->name_employee }}">
                                    </div>
                                </div> -->
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number">Name of Employee</label>
                                    <!-- Disabled input to display the employee name -->
                                    <input disabled type="text" name="name_employee_display"
                                        id="name_employee_display" maxlength="255" value="{{ $employee_name }}">
                                    <!-- Hidden input to store the employee ID -->
                                    <input type="hidden" name="name_employee"
                                        value="{{ $inductionTraining->name_employee }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number">Employee Code </label>
                                    <input disabled type="text" name="employee_id_display"
                                        value="{{ $inductionTraining->employee_id }}">
                                    <input type="hidden" name="employee_id"
                                        value="{{ $inductionTraining->employee_id }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Division Code">Department</label>
                                    <input disabled type="text" name="department"
                                        value="{{ $inductionTraining->department }}">
                                    {{-- <select disabled name="department">
                                            <option value="">-- Select Dept --</option>
                                            @php
                                                $savedDepartmentId = old('department', $inductionTraining->department);
                                            @endphp

                                            @foreach (Helpers::getDepartments() as $code => $department)
                                                <option value="{{ $code }}"
                                                    @if ($savedDepartmentId == $code) selected @endif>{{ $department }}
                                                </option>
                                            @endforeach
                                    </select> --}}
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Division Code">Location </label>
                                    <input disabled type="text" name="location_display" maxlength="255" value="{{ $inductionTraining->location }}">
                                    <input type="hidden" name="location" value="{{ $inductionTraining->location }}">
                                </div>
                            </div> --}}

                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group Code">Designation </label>
                                    <input disabled type="text" name="designee_display" id="designee" maxlength="255" value="{{ $inductionTraining->designation }}">
                                    <input type="hidden" name="designation" value="{{ $inductionTraining->designation }}">
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Job Title">Designation</label>
                                    <input type="text" name="designation_visible" id="job_title" required
                                        oninput="checkDesignation()" value="{{ $inductionTraining->designation }}"
                                        readonly>
                                    <input type="hidden" name="designation" id="hidden_designation"
                                        value="{{ $inductionTraining->designation }}" readonly>
                                </div>
                            </div>



                            <script>
                                // Removed higherDesignations array as it's no longer needed

                                // Function to check the designation (only updating hidden input now)
                                function checkDesignation() {
                                    const selectedDesignation = document.getElementById('job_title').value.trim();
                                    document.getElementById('hidden_designation').value = selectedDesignation;
                                }

                                // Function to check if 'Yes' is selected in Evaluation Required
                                function checkYesNo() {
                                    const questionariesRequired = document.getElementById('questionaries_required').value;
                                    const questionariesTab = document.getElementById('questionariesTab');

                                    if (questionariesRequired === 'Yes') {
                                        questionariesTab.style.display = 'inline';
                                    } else {
                                        questionariesTab.style.display = 'none';
                                    }
                                }

                                document.addEventListener("DOMContentLoaded", function() {
                                    const hiddenDesignation = document.getElementById('hidden_designation').value;
                                    const jobTitleInput = document.getElementById('job_title');

                                    // Set the input field to the pre-selected designation (from the database)
                                    jobTitleInput.value = hiddenDesignation;

                                    // Call checkDesignation after setting the value
                                    checkDesignation();

                                    // Check if Evaluation Required? field should be shown based on the saved data
                                    if (document.getElementById('questionaries_required').value === 'Yes') {
                                        document.getElementById('yesNoField').style.display = 'block';
                                    }
                                });
                            </script>




                            <div class="col-6">
                                <div class="group-input">
                                    <label for="Short Description">Qualification </label>
                                    <input id="qualification_display" disabled type="text"
                                        name="qualification_display" maxlength="255"
                                        value="{{ $inductionTraining->qualification }}">
                                    <input type="hidden" name="qualification"
                                        value="{{ $inductionTraining->qualification }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input" id="repeat_nature">
                                    <label for="repeat_nature">Experience (if any)</label>
                                    <input disabled type="text" name="experience_if_any_display" maxlength="255"
                                        value="{{ $inductionTraining->experience_if_any }}">
                                    <input type="hidden" name="experience_if_any"
                                        value="{{ $inductionTraining->experience_if_any }}">
                                </div>
                            </div>

                            <div class="col-md-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="due-date">Date of Joining</label>
                                    <div class="calenderauditee">
                                        <input disabled type="text" id="date_joining_display"
                                            value="{{ Helpers::getdateFormat($inductionTraining->date_joining) }}"
                                            readonly placeholder="DD-MMM-YYYY" />
                                        <input type="hidden" name="date_joining"
                                            value="{{ $inductionTraining->date_joining }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="start_date">Start Date</label>
                                    <input id="start_date" type="date" name="start_date"
                                        value="{{ $inductionTraining->start_date }}" onchange="setMinEndDate()">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="end_date">End Date</label>
                                    <input id="end_date" type="date" name="end_date"
                                        value="{{ $inductionTraining->end_date }}" onchange="setMaxStartDate()">
                                </div>
                            </div>

                            <script>
                                function setMinEndDate() {
                                    var startDate = document.getElementById('start_date').value;
                                    document.getElementById('end_date').min = startDate;
                                }

                                function setMaxStartDate() {
                                    var endDate = document.getElementById('end_date').value;
                                    document.getElementById('start_date').max = endDate;
                                }
                            </script>
                            <div class="col-lg-6" id="yesNoField">
                                <div class="group-input">
                                    <label for="questionariesRequired">Evaluation Required?</label>
                                    <select name="questionaries_required" id="questionaries_required"
                                        onchange="checkYesNo()">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ $inductionTraining->questionaries_required == 'Yes' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="No"
                                            {{ $inductionTraining->questionaries_required == 'No' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="group-input">
                                    <div class="why-why-chart">
                                    <button type="button" onclick="addNewRow()" class="btn btn-primary"> + Add </button>
                                        <table class="table table-bordered" id="documentTable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;">Sr.No.</th>
                                                    <th style="width: 30%;">Name of Document</th>
                                                    <th>Document Number</th>
                                                    <th>Training Date</th>
                                                    {{-- <th>Trainee Sign/Date </th> --}}
                                                    <th>Attachment</th>
                                                    <th>Remark</th>
                                                    <th>View SOP</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td style="background: #DCD8D8">Introduction of Agio Plant</td>

                                                    <td>
                                                        <select name="document_number_1" id="sopdocument"
                                                            onchange="fetchSopLink(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_1 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_1"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_1)  }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_1"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_1 }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_1')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_1"
                                                            value="{{ $inductionTraining->attachment_1 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_1) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_1 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_1">{{ $inductionTraining->{"remark_1"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_1 ? route('documents.view', $inductionTraining->document_number_1) : '#' }}"
                                                            id="view_sop_link" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_1 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td style="background: #DCD8D8">Personnel Hygiene</td>


                                                    <td>
                                                        <select name="document_number_2" id="sopdocument2"
                                                            onchange="fetchSopLink2(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_2 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_2"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_2)  }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_2"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_2 }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_2')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_2"
                                                            value="{{ $inductionTraining->attachment_2 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_2) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_2 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_2">{{ $inductionTraining->{"remark_2"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_2 ? route('documents.view', $inductionTraining->document_number_2) : '#' }}"
                                                            id="view_sop_link2" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_2 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td style="background: #DCD8D8">Entry Exit Procedure in Factory
                                                        premises</td>
                                                    <td>
                                                        <select name="document_number_3" id="sopdocument3"
                                                            onchange="fetchSopLink3(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_3 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_3"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_3)  }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_3"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_3 }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_3')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_3"
                                                            value="{{ $inductionTraining->attachment_3 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_3) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_3 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_3">{{ $inductionTraining->{"remark_3"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_3 ? route('documents.view', $inductionTraining->document_number_3) : '#' }}"
                                                            id="view_sop_link3" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_3 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td style="background: #DCD8D8">Good Documentation Practices</td>
                                                    <td>
                                                        <select name="document_number_4" id="sopdocument4"
                                                            onchange="fetchSopLink4(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_4 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_4"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_4) }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_4"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_4 }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_4')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_4"
                                                            value="{{ $inductionTraining->attachment_4 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_4) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_4 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_4">{{ $inductionTraining->{"remark_4"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_4 ? route('documents.view', $inductionTraining->document_number_4) : '#' }}"
                                                            id="view_sop_link4" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_4 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td style="background: #DCD8D8">Data Integrity</td>
                                                    <td>
                                                        <select name="document_number_5" id="sopdocument5"
                                                            onchange="fetchSopLink5(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_5 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_5"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_5) }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_5"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_5 }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_5')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_5"
                                                            value="{{ $inductionTraining->attachment_5 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_5) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_5 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_5">{{ $inductionTraining->{"remark_5"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_5 ? route('documents.view', $inductionTraining->document_number_5) : '#' }}"
                                                            id="view_sop_link5" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_5 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td style="background: #77a5d1">Modules</td>


                                                </tr>
                                                <tr>
                                                    <td>6 . a</td>
                                                    <td style="background: #DCD8D8"> GMP</td>
                                                    <td>
                                                        <select name="document_number_6" id="sopdocument6"
                                                            onchange="fetchSopLink6(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_6 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_6"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_6) }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_6"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_6 }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_6')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_6"
                                                            value="{{ $inductionTraining->attachment_6 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_6) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_6 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_6">{{ $inductionTraining->{"remark_6"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_6 ? route('documents.view', $inductionTraining->document_number_6) : '#' }}"
                                                            id="view_sop_link6" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_6 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6 . b</td>
                                                    <td style="background: #DCD8D8"> Documentation</td>
                                                    <td>
                                                        <select name="document_number_7" id="sopdocument7"
                                                            onchange="fetchSopLink7(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_7 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_7"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_7) }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_7"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_7 }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_7')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_7"
                                                            value="{{ $inductionTraining->attachment_7 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_7) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_7 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_7">{{ $inductionTraining->{"remark_7"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_7 ? route('documents.view', $inductionTraining->document_number_7) : '#' }}"
                                                            id="view_sop_link7" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_7 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6 . c</td>
                                                    <td style="background: #DCD8D8"> Process Control</td>
                                                    <td>
                                                        <select name="document_number_8" id="sopdocument8"
                                                            onchange="fetchSopLink8(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_8 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_8"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_8) }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_8"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_8 }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_8')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_8"
                                                            value="{{ $inductionTraining->attachment_8 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_8) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_8 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_8">{{ $inductionTraining->{"remark_8"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_8 ? route('documents.view', $inductionTraining->document_number_8) : '#' }}"
                                                            id="view_sop_link8" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_8 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6 . d</td>
                                                    <td style="background: #DCD8D8"> Cross Contamination</td>
                                                    <td>
                                                        <select name="document_number_9" id="sopdocument9"
                                                            onchange="fetchSopLink9(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_9 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_9"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_9) }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_9"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_9 }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_9')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_9"
                                                            value="{{ $inductionTraining->attachment_9 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_9) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_9 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_9">{{ $inductionTraining->{"remark_9"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_9 ? route('documents.view', $inductionTraining->document_number_9) : '#' }}"
                                                            id="view_sop_link9" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_9 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6 . e</td>
                                                    <td style="background: #DCD8D8"> Sanitization and Hygiene</td>
                                                    <td>
                                                        <select name="document_number_10" id="sopdocument10"
                                                            onchange="fetchSopLink10(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_10 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_10"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_10) }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_10"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_10 }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_10')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_10"
                                                            value="{{ $inductionTraining->attachment_10 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_10) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_10 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_10">{{ $inductionTraining->{"remark_10"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_10 ? route('documents.view', $inductionTraining->document_number_10) : '#' }}"
                                                            id="view_sop_link10" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_10 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6 . f</td>
                                                    <td style="background: #DCD8D8"> Warehousing</td>
                                                    <td>
                                                        <select name="document_number_11" id="sopdocument11"
                                                            onchange="fetchSopLink11(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_11 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_11"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_11) }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_11"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_11 }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_11')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_11"
                                                            value="{{ $inductionTraining->attachment_11 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_11) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_11 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_11">{{ $inductionTraining->{"remark_11"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_11 ? route('documents.view', $inductionTraining->document_number_11) : '#' }}"
                                                            id="view_sop_link11" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_11 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6 . g</td>
                                                    <td style="background: #DCD8D8"> Complaint and Recall</td>
                                                    <td>
                                                        <select name="document_number_12" id="sopdocument12"
                                                            onchange="fetchSopLink12(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_12 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_12"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_12) }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_12"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_12 }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_12')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_12"
                                                            value="{{ $inductionTraining->attachment_12 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_12) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_12 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_12">{{ $inductionTraining->{"remark_12"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_12 ? route('documents.view', $inductionTraining->document_number_12) : '#' }}"
                                                            id="view_sop_link12" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_12 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>
                                                <tr>
                                                    <td>6 . h</td>
                                                    <td style="background: #DCD8D8"> Utilities</td>
                                                    <td>
                                                        <select name="document_number_13" id="sopdocument13"
                                                            onchange="fetchSopLink13(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_13 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_13"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_13) }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_13"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_13 }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_13')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_13"
                                                            value="{{ $inductionTraining->attachment_13 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_13) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_13 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_13">{{ $inductionTraining->{"remark_13"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_13 ? route('documents.view', $inductionTraining->document_number_13) : '#' }}"
                                                            id="view_sop_link13" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_13 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6 . i</td>
                                                    <td style="background: #DCD8D8"> Water</td>
                                                    <td>
                                                        <select name="document_number_14" id="sopdocument14"
                                                            onchange="fetchSopLink14(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_14 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_14"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_14) }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_14"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_14 }}" class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_14')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_14"
                                                            value="{{ $inductionTraining->attachment_14 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_14) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_14 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_14">{{ $inductionTraining->{"remark_14"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_14 ? route('documents.view', $inductionTraining->document_number_14) : '#' }}"
                                                            id="view_sop_link14" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_14 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>6 . j</td>
                                                    <td style="background: #DCD8D8"> Safety Module</td>
                                                    <td>
                                                        <select name="document_number_15" id="sopdocument15"
                                                            onchange="fetchSopLink15(this)">
                                                            <option value="">---Select Document Number---</option>
                                                            @foreach ($data as $dat)
                                                                <option value="{{ $dat->id }}"
                                                                    data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                                    data-sop-id="{{ $dat->id }}"
                                                                    {{ $inductionTraining->document_number_15 == $dat->id ? 'selected' : '' }}>
                                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>

                                                        <div class=" new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input type="text" id="training_date_15"
                                                                        value="{{ Helpers::getdateFormat($inductionTraining->training_date_15) }}"
                                                                        readonly placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="training_date_15"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        value="{{ $inductionTraining->training_date_15 }}"  class="hide-input"
                                                                        oninput="handleDateInput(this, 'training_date_15')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label for="Attached CV"></label>
                                                        <input type="file" id="myfile" name="attachment_15"
                                                            value="{{ $inductionTraining->attachment_15 }}">
                                                        <a href="{{ asset('upload/' . $inductionTraining->attachment_15) }}"
                                                            target="_blank">{{ $inductionTraining->attachment_15 }}</a>
                                                    </td>
                                                    <td>
                                                        <textarea name="remark_15">{{ $inductionTraining->{"remark_15"} }}</textarea>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $inductionTraining->document_number_15 ? route('documents.view', $inductionTraining->document_number_15) : '#' }}"
                                                            id="view_sop_link15" target="_blank"
                                                            style="display: {{ $inductionTraining->document_number_15 ? 'inline' : 'none' }};">
                                                            View SOP
                                                        </a>
                                                    </td>
                                                </tr>

                                                @if (!empty($documents))
                                                    @foreach ($documents as $index => $document)
                                                        <tr id="row_{{ $index + 16 }}">
                                                            <td>{{ $index + 16 }}</td>
                                                            <td>
                                                                {{-- <input type="text" name="document_title[]" value="{{ $document['document_title'] }}" /> --}}
                                                                <input type="text" name="document_title[]" value="{{ $document['document_title'] ?? '' }}" />

                                                            </td>
                                                            <td>
                                                                <select name="document_number[]" id="document_number_{{ $index + 16 }}" onchange="fetchSopLink0(this, {{ $index + 16 }})">
                                                                    <option value="">----Select---</option>
                                                                    @foreach ($data as $item)
                                                                        <option value="{{ $item->id }}" data-sop-link="{{ $item->id }}" {{ $item->id == $document['document_number'] ? 'selected' : '' }}>
                                                                            {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="date" name="training_date[]" value="{{ $document['training_date'] }}" />
                                                            </td>
                                                            <td>
                                                                @if (!empty($document['attachment']))
                                                                <input type="file" name="attachment[]" />
                                                                    <a href="{{ asset('upload/' . $document['attachment']) }}" target="_blank">{{ $document['attachment'] }}</a>
                                                                @else
                                                                    <input type="file" name="attachment[]" />
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <textarea name="remark[]">{{ $document['remark'] }}</textarea>
                                                            </td>
                                                            <td>
                                                                <a href="{{ $document['document_number'] ? route('documents.view', $document['document_number']) : '#' }}" 
                                                                    id="view_sop_link_{{ $index + 16 }}" target="_blank" 
                                                                    style="display: {{ $document['document_number'] ? 'inline' : 'none' }};">
                                                                    View SOP
                                                                </a>  
                                                            <td>
                                                                <button type="button" onclick="removeRow(this)">Remove</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="16">No documents found.</td>
                                                    </tr>
                                                @endif

                                                
                                            </tbody>


                                            
                                        </table>

                                    </div>
                                </div>
                            </div>



                            <script>
                                let rowCount = {{ is_array($documents) ? count($documents) : 0 }};

                                function addNewRow() {
                                    rowCount++;
                                    const tableBody = document.querySelector('#documentTable tbody');
                                    
                                    const newRow = document.createElement('tr');
                                    newRow.setAttribute('id', `row_${rowCount}`);
                                    
                                    newRow.innerHTML = `
                                        <td>${rowCount}</td>
                                        <td>
                                        <input type="text" name="document_title[]" />
                                        </td>
                                        <td>
                                            <select name="document_number[]" id="document_number_${rowCount}" onchange="fetchSopLink0(this, ${rowCount})">
                                                <option value="">----Select---</option>
                                                @foreach ($data as $item)
                                                <option value="{{ $item->id }}" data-sop-link="{{ $item->id }}">
                                                    {{ $item->sop_type_short }}/{{ $item->department_id }}/000{{ $item->id }}/R{{ $item->major }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="date" name="training_date[]" />
                                        </td>
                                        <td>
                                            <input type="file" name="attachment[]" />
                                        </td>
                                        <td>
                                            <textarea name="remark[]"></textarea>
                                        </td>
                                        <td>
                                            <a href="#" id="view_sop_link_${rowCount}" target="_blank" style="display: none;">View SOP</a>
                                        </td>
                                    `;
                                    
                                    tableBody.appendChild(newRow);
                                }

                                function fetchSopLink0(selectElement, row) {
                                    const selectedOption = selectElement.options[selectElement.selectedIndex];
                                    const sopId = selectedOption.getAttribute('data-sop-id');
                                    const sopLink = document.getElementById(`view_sop_link_${row}`);

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }

                                // On page load, fetch SOP links for already saved documents
                                window.onload = function() {
                                    @if(is_array($documents) && count($documents) > 0)
                                        @foreach ($documents as $index => $document)
                                            var sopSelect = document.getElementById('document_number_{{ $index + 1 }}');
                                            fetchSopLink(sopSelect, {{ $index + 1 }});
                                        @endforeach
                                    @endif
                                };


                                function removeRow(button) {
                                    const row = button.closest('tr');
                                    row.remove();
                                }
                            </script>


                            <script>
                                function fetchSopLink(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument');
                                    fetchSopLink(sopSelect);
                                };
                            </script>

                            <script>
                                function fetchSopLink2(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link2');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument2');
                                    fetchSopLink(sopSelect);
                                };
                            </script>

                            <script>
                                function fetchSopLink3(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link3');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument3');
                                    fetchSopLink(sopSelect);
                                };
                            </script>

                            <script>
                                function fetchSopLink4(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link4');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument4');
                                    fetchSopLink(sopSelect);
                                };
                            </script>

                            <script>
                                function fetchSopLink5(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link5');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument5');
                                    fetchSopLink(sopSelect);
                                };
                            </script>

                            <script>
                                function fetchSopLink6(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link6');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument6');
                                    fetchSopLink(sopSelect);
                                };
                            </script>

                            <script>
                                function fetchSopLink7(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link7');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument7');
                                    fetchSopLink(sopSelect);
                                };
                            </script>

                            <script>
                                function fetchSopLink8(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link8');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument8');
                                    fetchSopLink(sopSelect);
                                };
                            </script>

                            <script>
                                function fetchSopLink9(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link9');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument9');
                                    fetchSopLink(sopSelect);
                                };
                            </script>

                            <script>
                                function fetchSopLink10(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link10');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument10');
                                    fetchSopLink(sopSelect);
                                };
                            </script>

                            <script>
                                function fetchSopLink11(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link11');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument11');
                                    fetchSopLink(sopSelect);
                                };
                            </script>

                            <script>
                                function fetchSopLink12(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link12');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument12');
                                    fetchSopLink(sopSelect);
                                };
                            </script>

                            <script>
                                function fetchSopLink13(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link13');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument13');
                                    fetchSopLink(sopSelect);
                                };
                            </script>

                            <script>
                                function fetchSopLink14(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link14');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument14');
                                    fetchSopLink(sopSelect);
                                };
                            </script>

                            <script>
                                function fetchSopLink15(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                                    var sopId = selectedOption.getAttribute('data-sop-id');

                                    var sopLink = document.getElementById('view_sop_link15');

                                    if (sopId) {
                                        sopLink.href = `/documents/view/${sopId}`;
                                        sopLink.style.display = 'inline';
                                    } else {
                                        sopLink.style.display = 'none';
                                    }
                                }
                                window.onload = function() {
                                    var sopSelect = document.getElementById('sopdocument15');
                                    fetchSopLink(sopSelect);
                                };
                            </script>
                            {{-- <div class="col-6">
                                <div class="group-input">
                                    <label for="severity-level">HR Department</label>
                                    <select name="hr_name" value="{{ $inductionTraining->hr_name }}">
                                        <option value="0">-- Select --</option>
                                        <option value="hr" {{ $inductionTraining->hr_name == "hr" ? 'selected' : '' }}>HR </option>
                                    </select>
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="training_type">Type of Training</label>
                                    <input type="text" value="{{ $inductionTraining->training_type }}" readonly>
                                </div>
                            </div>

                          {{--  <div class="col-6">
                                <div class="group-input">
                                    <label for="training_type">Type of Training</label>
                                    <select name="training_type" id="training_type" disabled>
                                        <option value="">-- Select --</option>
                                        <option value="self-reading"
                                            {{ old('training_type', $inductionTraining->training_type ?? '') == 'self-reading' ? 'selected' : '' }}>
                                            Self-Reading</option>
                                        {{-- 
                                            <option value="classroom" {{ old('training_type', $inductionTraining->training_type ?? '') == 'classroom' ? 'selected' : '' }}>Classroom</option>
                                            <option value="hands-on" {{ old('training_type', $inductionTraining->training_type ?? '') == 'hands-on' ? 'selected' : '' }}>Hands-On</option>
                                            <option value="virtual" {{ old('training_type', $inductionTraining->training_type ?? '') == 'virtual' ? 'selected' : '' }}>Virtual</option> 
                                       --}}
                                    {{--</select>
                                </div>
                            </div> --}}




                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="HOD Persons">Trainer Name</label>
                                    <select name="trainee_name" id="hod">
                                        <option value="">-- Select Trainer --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $user->id == old('trainee_name', $inductionTraining->trainee_name) ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="trainer_name">Trainer Name</label>
                                    <input type="text" value="{{ $inductionTraining->trainee_name }}" readonly>
                                </div>
                            </div> --}}
                            {{-- <div class="col-6">
                                <div class="group-input">
                                    <label for="severity-level">Trainer Name</label>

                                    <select name="trainee_name" value="{{ $inductionTraining->trainee_name }}">
                                        <option value="0">-- Select --</option>
                                        <option value="trainee1" {{ $inductionTraining->trainee_name == "trainee1" ? 'selected' : '' }}>trainee 1</option>

                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>

                        </div>
                    </div>
                </div>


                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const selectedDocumentId = document.getElementById('sopdocument').value;
                        if (selectedDocumentId) {
                            fetchQuestion(selectedDocumentId); // Fetch questions on page load if a document is selected
                        }
                    });

                    function fetchQuestion(documentId) {
                        if (documentId) {
                            fetch(`/fetch-question/${documentId}`)
                                .then(response => response.json())
                                .then(data => {
                                    const questionsContainer = document.getElementById('questionsContainer');
                                    questionsContainer.innerHTML = ''; // Clear previous questions

                                    if (data.length > 0) {
                                        data.forEach((question, index) => {
                                            // Create a form fieldset for each question
                                            const questionBlock = `
                                                        <div class="question-block">
                                                            <p><strong>Q${index + 1}: ${question.question}</strong></p>
                                                            <ul>
                                                                ${Object.entries(question.options).map(([key, option]) => `
                                                                                    <li>
                                                                                        <label>
                                                                                            <input type="${question.answer_type === 'multiple' ? 'checkbox' : 'radio'}" 
                                                                                                name="question_${question.id}" 
                                                                                                value="${key}">
                                                                                            ${option}
                                                                                        </label>
                                                                                    </li>
                                                                                `).join('')}
                                                            </ul>
                                                        </div>
                                                    `;
                                            questionsContainer.innerHTML += questionBlock;
                                        });

                                        // Add Submit button
                                        questionsContainer.innerHTML += `
                                                    <div class="quiz-buttons">
                                                        <button type="button" id="submit-btn" class="btn btn-primary">Submit</button>
                                                    </div>
                                                `;

                                        // Add event listener to the submit button
                                        document.getElementById('submit-btn').addEventListener('click', submitQuiz);
                                    } else {
                                        questionsContainer.innerHTML = '<p>No questions available for this document.</p>';
                                    }
                                })
                                .catch(error => {
                                    console.error('Error fetching questions:', error);
                                    document.getElementById('questionsContainer').innerHTML = '<p>Error fetching questions.</p>';
                                });
                        } else {
                            document.getElementById('questionsContainer').innerHTML = ''; // Clear questions if no document is selected
                        }
                    }

                    function submitQuiz() {
                        saveAnswer();

                        var marks = 0;

                        for (var i = 0; i < quizData.length; i++) {
                            var correctAnswer = quizData[i].answer;
                            var userAnswer = userAnswers[i];

                            console.log("Correct Answer:", correctAnswer);
                            console.log("User Answer:", userAnswer);

                            if (typeof correctAnswer === 'string') {
                                if (correctAnswer.toLowerCase() === userAnswer[0]?.toLowerCase()) {
                                    marks++;
                                }
                            } else if (Array.isArray(correctAnswer)) {
                                if (arraysEqual(correctAnswer, userAnswer)) {
                                    marks++;
                                }
                            } else {
                                if (correctAnswer == userAnswer[0]) {
                                    marks++;
                                }
                            }
                        }

                        displaySummary(marks);

                        // Calculate passing marks
                        var passing = @json($quize ? $quize->passing : 0); // Use 0 or a default value if quize or passing is null
                        var totalQuestions = quizData.length;
                        var percentageRequired = (passing / 100) * totalQuestions;

                        console.log("Marks Scored:", marks);
                        console.log("Passing Marks:", percentageRequired);

                        if (marks >= percentageRequired) {
                            var btnsElement = document.querySelector(".btns");
                            var button = document.createElement("button");
                            button.id = "complete-training";
                            button.setAttribute("data-bs-toggle", "modal");
                            button.setAttribute("data-bs-target", "#trainee-sign");
                            button.textContent = "Complete Training";

                            // Append button to the btnsElement
                            btnsElement.appendChild(button);
                        } else {
                            alert("You did not pass the quiz.");
                        }

                    }
                </script>


                <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="col-12 sub-head">
                            Questionaries
                        </div>
                        {{-- <div class="pt-2 group-input">
                            <label for="audit-agenda-grid">
                                Questionaries
                                <button type="button" name="audit-agenda-grid" id="ObservationAdd" @if ($inductionTraining->stage != 2) disabled @endif>+</button>
                                <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="job-responsibilty-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sr No.</th>
                                            <th>Questions</th>
                                            <th>Answer Fillup by Employee</th>
                                            <th>Comments</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @if ($employee_grid_data && is_array($employee_grid_data->data))
                                            @foreach ($employee_grid_data->data as $index => $employee_grid)
                                            <tr>
                                                <td><input disabled type="text" name="jobResponsibilities[{{ $loop->index }}][serial]" value="{{ $loop->index+1 }}"></td>
                                                <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][job]" value="{{ array_key_exists('job', $employee_grid) ? $employee_grid['job'] : '' }}" class="question-input" 
                                                    @if ($inductionTraining->stage == 2 || $inductionTraining->stage == 3) 
                                                    @else 
                                                        readonly
                                                    @endif>
                                                </td>
                                                <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][remarks]" value="{{ array_key_exists('remarks', $employee_grid) ? $employee_grid['remarks'] : '' }}" class="answer-input" 
                                                    @if ($inductionTraining->stage == 3) 
                                                    @else 
                                                        readonly
                                                    @endif>
                                                </td>
                                                <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][comments]" value="{{ array_key_exists('comments', $employee_grid) ? $employee_grid['comments'] : '' }}" class="answer-input" 
                                                    @if ($inductionTraining->stage == 2 || $inductionTraining->stage == 3) 
                                                    @else 
                                                        readonly
                                                    @endif>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td><input disabled type="text" name="jobResponsibilities[0][serial]" value="1"></td>
                                                <td><input type="text" name="jobResponsibilities[0][job]" class="question-input" 
                                                    @if ($inductionTraining->stage == 2 || $inductionTraining->stage == 3) 
                                                    @else 
                                                        readonly
                                                    @endif>
                                                </td>
                                                <td><input type="text" name="jobResponsibilities[0][remarks]" class="answer-input" 
                                                    @if ($inductionTraining->stage == 3) 
                                                    @else 
                                                        readonly
                                                    @endif>
                                                </td>
                                                <td><input type="text" name="jobResponsibilities[0][comments]" class="answer-input" 
                                                    @if ($inductionTraining->stage == 2 || $inductionTraining->stage == 3) 
                                                    @else 
                                                        readonly
                                                    @endif>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                        </div>  --}}

                        <div id="questionsContainer" class="container">
                            <div>
                                <!-- Questions will be dynamically injected here -->
                            </div>
                        </div>


                        <div class="button-block">
                            <button type="submit" class="saveButton" id=""
                                @if ($inductionTraining->stage != 2 && $inductionTraining->stage != 3) disabled @endif>Save</button>
                            <!-- <a href="TMS"> -->
                            <!-- <button type="button" class="backButton">Back</button> -->
                            <!-- </a> -->
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        </div>
                    </div>
                </div>

                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Remarks</label>
                                    <textarea name="final_r_comment">{{ $inductionTraining->final_r_comment }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="External Attachment">Final Attachment</label>
                                    <input type="file" id="myfile" name="final_r_attachment"
                                        value="{{ $inductionTraining->final_r_attachment }}">
                                    <a href="{{ asset('upload/' . $inductionTraining->final_r_attachment) }}"
                                        target="_blank">{{ $inductionTraining->final_r_attachment }}</a>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>

                        </div>
                    </div>
                </div>


                <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Remarks</label>
                                    <textarea name="evaluation_comment">{{ $inductionTraining->evaluation_comment }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="External Attachment">Final Attachment</label>
                                    <input type="file" id="myfile" name="evaluation_attachment"
                                        value="{{ $inductionTraining->evaluation_attachment }}">
                                    <a href="{{ asset('upload/' . $inductionTraining->evaluation_attachment) }}"
                                        target="_blank">{{ $inductionTraining->evaluation_attachment }}</a>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>

                        </div>
                    </div>
                </div>


                <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Remarks</label>
                                    <textarea name="hr_head_comment">{{ $inductionTraining->hr_head_comment }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="External Attachment">Final Attachment</label>
                                    <input type="file" id="myfile" name="hr_head_attachment"
                                        value="{{ $inductionTraining->hr_head_attachment }}">
                                    <a href="{{ asset('upload/' . $inductionTraining->hr_head_attachment) }}"
                                        target="_blank">{{ $inductionTraining->hr_head_attachment }}</a>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>

                        </div>
                    </div>
                </div>

                <div id="CCForm6" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Remarks</label>
                                    <textarea name="qa_final_comment">{{ $inductionTraining->qa_final_comment }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="External Attachment">Final Attachment</label>
                                    <input type="file" id="myfile" name="qa_final_attachment"
                                        value="{{ $inductionTraining->qa_final_attachment }}">
                                    <a href="{{ asset('upload/' . $inductionTraining->qa_final_attachment) }}"
                                        target="_blank">{{ $inductionTraining->qa_final_attachment }}</a>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>

                        </div>
                    </div>
                </div>

                <div id="CCForm7" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Remarks</label>
                                    <textarea name="hr_final_comment">{{ $inductionTraining->hr_final_comment }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="External Attachment">Final Attachment</label>
                                    <input type="file" id="myfile" name="hr_final_attachment"
                                        value="{{ $inductionTraining->hr_final_attachment }}">
                                    <a href="{{ asset('upload/' . $inductionTraining->hr_final_attachment) }}"
                                        target="_blank">{{ $inductionTraining->hr_final_attachment }}</a>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton">Back</button>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>

                        </div>
                    </div>
                </div>

   
                @if ($inductionTraining->stage >= 6)
                    <div id="CCForm8" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="button-block">
                                        <button type="button" class="printButton" onclick="downloadCertificate()">
                                            <i class="fas fa-print"></i> Print
                                        </button>
                                    </div>

                                <div >
                                <div class="pm-certificate-container">
                                    <div class="outer-border"></div>
                                    <div class="inner-border"></div>
                                    
                                    <div class="pm-certificate-border">
                                        <!-- Logos Section -->
                                        <div class="pm-certificate-logos text-center">
                                            <img src="{{ asset('user/images/agio-removebg-preview.png') }}" alt="Agio Logo" class="logo logo-left">
                                            <img src="{{ asset('user/images/vidhyaGxp.png') }}" alt="Vidhya GxP Logo" class="logo logo-right">
                                        </div>

                                        <div class="pm-certificate-header">
                                            <div class="pm-certificate-title cursive text-center">
                                                <h2>Certificate of Induction Training</h2>
                                            </div>
                                        </div>

                                        <div class="pm-certificate-body">
                                            <div class="pm-certificate-block">
                                                <p class="text-center">
                                                    This is to certify that Mr. / Ms. / Mrs. 
                                                    <strong>{{ \App\Models\Employee::find($inductionTraining->name_employee)?->employee_name ?? 'Employee not found' }}</strong>
                                                    has undergone Induction Training, including the requirement of cGMP and has shown a good attitude and thorough understanding in the subject.
                                                </p>

                                                <p class="text-center">
                                                    Therefore, we certify that Mr. / Ms. / Mrs. 
                                                    <strong>{{ \App\Models\Employee::find($inductionTraining->name_employee)?->employee_name ?? 'Employee not found' }}</strong> 
                                                    is capable of performing his/her assigned duties in the 
                                                    <strong>{{ $inductionTraining->department }}</strong> Department independently.
                                                </p>
                                            </div>       

                                            <div class="pm-certificate-footer">
                                                <div class="pm-certified text-center">
                                                    <span class="bold block">Sign / Date:</span>
                                                    <strong>{{ $inductionTraining->evaluation_complete_by }} /
                                                    {{ \Carbon\Carbon::parse($inductionTraining->evaluation_complete_on)->format('d-M-Y') }}
                                                    </strong>
                                                    <span class="pm-empty-space block underline"></span>
                                                    <span class="bold block">HR Head</span>
                                                </div>
                                                <div class="pm-certified text-center">
                                                    <span class="bold block">Sign / Date:</span>
                                                    <strong>{{ $inductionTraining->approval_complete_by }} /
                                                        {{ \Carbon\Carbon::parse($inductionTraining->approval_complete_on)->format('d-M-Y') }}</strong>
                                                    <span class="pm-empty-space block underline"></span>
                                                    <span class="bold block">Head QA/CQA</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                    <div style="margin-top: 40px;" class="button-block">
                                        {{-- <button type="submit" class="btn btn saveButton">Save</button>
                                        <button type="button" id="ChangeNextButton"
                                            class="btn btn nextButton">Next</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                        </div>
                @endif

                <!-- CSS Styling -->
            

                <style>
              @import url('https://fonts.googleapis.com/css?family=Open+Sans|Pinyon+Script|Rochester');



                .cursive {
                    font-family: 'Pinyon Script', cursive;
                }

                .sans {
                    font-family: 'Open Sans', sans-serif;
                }

                .bold {
                    font-weight: bold;
                }

                .block {
                    display: block;
                }

                .underline {
                    border-bottom: 1px solid #777;
                    padding: 5px;
                    margin-bottom: 15px;
                }

                .text-center {
                    text-align: center;
                }

                .pm-empty-space {
                    /* height: 40px; */
                    width: 100%;
                }

                .pm-certificate-container {
                    position: relative;
                    width: 90%;
                    max-width: 800px;
                    background-color: #618597;
                    padding: 30px;
                    color: #333;
                    font-family: 'Open Sans', sans-serif;
                    box-shadow: 0 9px 15px rgb(18 5 23 / 60%);
                    margin-left: 325px;
                }

                .outer-border {
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    border: 2px solid #fff;
                    pointer-events: none;
                }

                .inner-border {
                    position: absolute;
                    top: 10px;
                    left: 10px;
                    right: 10px;
                    bottom: 10px;
                    border: 2px solid #fff;
                    pointer-events: none;
                }

                .pm-certificate-border {
                    position: relative;
                    padding: 20px;
                    border: 1px solid #E1E5F0;
                    background-color: rgba(255, 255, 255, 1);
                }


                .pm-certificate-logos {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                
                }

                .logo {
                    max-width: 100px;
                }

                .logo-left {
                    transform: scale(0.7);
                    margin-bottom: 14px;
                }

                .logo-right {
                    transform: scale(1.8);
                    margin-right: 65px;
                }

                .pm-certificate-header {
                    margin-bottom: 10px;
                }

                .pm-certificate-title h2 {
                    font-size: 34px;
                }

                .pm-certificate-body {
                    padding: 20px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }

                .pm-certificate-block {
                    text-align: center;
                }

                .pm-name-text {
                    font-size: 20px;
                }

                .pm-earned {
                    margin: 15px 0 20px;
                }

                .pm-earned-text {
                    font-size: 20px;
                }

                .pm-credits-text {
                    font-size: 15px;
                }

                .pm-course-title {
                    margin-bottom: 15px;
                }

                .pm-certified {
                    font-size: 12px;
                    width: 300px; 
                    margin-top: 0; 
                    text-align: center;
                }

                .pm-certificate-footer {
                    display: flex;
                    justify-content: space-between;
                    align-items: center; 
                    width: 100%;
                    margin-top: 20px;
                    flex-wrap: nowrap
                }
                @media print {
                    .print-button {
                        display: none;
                    }
                    .print-button-container {
                        display: none;
                    }
                }


                .print-button {
                    padding: 10px 20px;
                    background-color: #007bff; 
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 14px;
                    font-weight: bold;
                    margin-block-end: 700px;
                }


                @media print {
                    body {
                        background: none;
                        -webkit-print-color-adjust: exact; 
                        margin: 0;
                        padding: 0;
                        width: 100%;
                    }

                    .pm-certificate-container {
                        page-break-inside: avoid; 
                        page-break-after: avoid; 
                        width: 100%;
                        height: auto; 
                        max-height: 100vh; 
                        overflow: hidden; 
                        box-shadow: none; 
                        background-color: #618597; 
                        padding: 30px;
                        margin: 0 auto; 
                    }

                    .outer-border, .inner-border {
                        border-color: #d3d0d0; 
                    }

                    .print-button, .print-button-container {
                        display: none; 
                        
                    }

                
                    html, body {
                        height: auto; 
                        max-height: 100vh; 
                        overflow: hidden;
                    }
                }

                </style>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>


                <script>
                    function downloadCertificate() {
                        const element = document.querySelector('.pm-certificate-container');
                        const options = {
                            margin: 19,
                        
                            filename: 'Induction-training-certificate.pdf',
                            html2canvas: { scale: 2 },
                            jsPDF: { orientation: 'landscape' }
                        };
                        html2pdf().from(element).set(options).save();
                    }
                </script>

              

                <script>
                    document.getElementById("saveForm").addEventListener("click", function(event) {
                        let questionInputs = document.querySelectorAll(".question-input");
                        let answerInputs = document.querySelectorAll(".answer-input");
                        let allFilled = true;

                        questionInputs.forEach(function(input) {
                            if (input.value.trim() === "") {
                                allFilled = false;
                            }
                        });

                        answerInputs.forEach(function(input) {
                            if (input.value.trim() === "") {
                                allFilled = false;
                            }
                        });

                        if (!allFilled) {
                            event.preventDefault();
                            alert("Please fill required field before submitting.");
                        }
                    });
                </script>


                <div id="CCForm9" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Activated On">Remark</label>
                                    <textarea name="on_the_job_comment" maxlength="255">{{ $inductionTraining->on_the_job_comment }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="External Attachment">Induction Training Attachment</label>
                                    <input type="file" id="myfile" name="on_the_job_attachment"
                                        value="{{ $inductionTraining->on_the_job_attachment }}">
                                    <a href="{{ asset('upload/' . $inductionTraining->on_the_job_attachment) }}"
                                        target="_blank">{{ $inductionTraining->on_the_job_attachment }}</a>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        </div>
                    </div>
                </div>
                </div>

                <div id="CCForm10" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Activated By">Submit By</label>
                                    <div class="static">{{ $inductionTraining->submit_by }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Activated On">Submit On</label>
                                    <div class="static">
                                        {{ $inductionTraining->submit_on }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Activated On">Submit Comment</label>
                                    <div class="static">
                                        {{ $inductionTraining->submit_comment }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for=" Rejected By">Answer Submit By</label>
                                    <div class="static">{{ $inductionTraining->answer_submit_by }}</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Answer Submit On</label>
                                    <div class="static">{{ $inductionTraining->answer_submit_on }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Answer Submit Comment</label>
                                    <div class="static">{{ $inductionTraining->answer_submit_comment }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Evaluation Complete By</label>
                                    <div class="static">{{ $inductionTraining->evaluation_complete_by }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Evaluation Complete On</label>
                                    <div class="static">{{ $inductionTraining->evaluation_complete_on }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Evaluation Complete Comment</label>
                                    <div class="static">{{ $inductionTraining->evaluation_complete_comment }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Approval Complete By</label>
                                    <div class="static">{{ $inductionTraining->approval_complete_by }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Approval Complete On</label>
                                    <div class="static">{{ $inductionTraining->approval_complete_on }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Approval Complete Comment</label>
                                    <div class="static">{{ $inductionTraining->approval_complete_comment }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">QA/CQA Head Approval Complete By</label>
                                    <div class="static">{{ $inductionTraining->qa_head_approval_complete_by }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">QA/CQA Head Approval Complete On</label>
                                    <div class="static">{{ $inductionTraining->qa_head_approval_complete_on }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">QA/CQA Head Approval Complete Comment</label>
                                    <div class="static">{{ $inductionTraining->qa_head_approval_complete_comment }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Send To OJT By</label>
                                    <div class="static">{{ $inductionTraining->Send_To_OJT_by }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Send To OJT On</label>
                                    <div class="static">{{ $inductionTraining->Send_To_OJT_on }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Send To OJT Comment</label>
                                    <div class="static">{{ $inductionTraining->Send_To_OJT_comment }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Creation Complete By</label>
                                    <div class="static">{{ $inductionTraining->creation_complete_by }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Creation Complete On</label>
                                    <div class="static">{{ $inductionTraining->creation_complete_on }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="group-input">
                                    <label for="Rejected On">Creation Complete Comment</label>
                                    <div class="static">{{ $inductionTraining->creation_complete_comment }}
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton"> <a href="{{ url('TMS') }}"
                                    class="text-white">
                                    Save </a></button>
                            <!-- <a href="/rcms/qms-dashboard"> -->
                            {{-- <button type="button" class="backButton">Back</button> --}}
                            </a>
                            {{-- <button type="submit">Submit</button> --}}
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>

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
            $('#ObservationAdd').click(function(e) {
                function generateTableRow(serialNumber) {

                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="jobResponsibilities[' + serialNumber +
                        '][serial]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="jobResponsibilities[' + serialNumber +
                        '][job]"></td>' +
                        '<td><input type="text" class="Document_Remarks" name="jobResponsibilities[' +
                        serialNumber + '][remarks]"></td>' +


                        '</tr>';

                    return html;
                }

                var tableBody = $('#job-responsibilty-table tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <script>
        VirtualSelect.init({
            ele: '#Facility, #Group, #Audit, #Auditee , #capa_related_record,#cft_reviewer'
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

        function setCurrentDate(item) {
            if (item == 'yes') {
                $('#effect_check_date').val('{{ date('
                                d - M - Y ') }}');
            } else {
                $('#effect_check_date').val('');
            }
        }
    </script>
    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>


    {{-- Child   --}}
    <div class="modal fade" id="child-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Child</h4>
                </div>
                <div class="model-body">

                    <form action="{{ route('induction.child', $inductionTraining->id) }}" method="POST">
                        @csrf
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="group-input">
                                <label style="display: flex;" for="major">
                                    <input type="radio" name="child_type" id="major" value="job_training">
                                    On The Job Training
                                </label>
                                <label style="display: flex;" for="major">
                                    <input type="radio" name="child_type" id="major" value="job_description">
                                    Job Description
                                </label>

                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit">Submit</button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('tms/induction/sendstage', $inductionTraining->id) }}" method="POST"
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

    <div class="modal fade" id="cancel-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('tms/induction/cancelstage', $inductionTraining->id) }}" method="POST">
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

                    <div class="modal-footer">
                        <button type="submit" data-bs-dismiss="modal">Submit</button>
                        <button type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
