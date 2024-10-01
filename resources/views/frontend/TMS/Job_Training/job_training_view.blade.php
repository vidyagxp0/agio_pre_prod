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

        #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(7) {
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
            <strong>On the Job</strong>
            {{ Helpers::getDivisionName(session()->get('division')) }}
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
                                ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => 4])
                                ->get();
                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                        @endphp

                        <button class="button_theme1">
                            <a class="text-white" href="{{ route('job_audittrail', $jobTraining->id) }}"> Audit Trail
                            </a>
                        </button>

                        @if ($jobTraining->stage == 1)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                              Submit
                            </button>

                        {{-- @elseif($jobTraining->stage == 2)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                              Accept Complete
                            </button>
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                              Reject
                            </button> 
                        @elseif($jobTraining->stage == 3)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Review Complete
                            </button> --}}

                        @elseif($jobTraining->stage == 2)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Approval Complete
                            </button>
                        @elseif($jobTraining->stage == 3)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Answer Submit
                            </button>
                        @elseif($jobTraining->stage == 4)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Evaluation Complete
                            </button>
                        @elseif($jobTraining->stage == 5)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            QA/CQA Head Review Complete
                            </button>
                        @elseif($jobTraining->stage == 6)
                            <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Verification and Approval Complete
                            </button>
                        @endif
                        <button class="button_theme1"> 
                            <a class="text-white" href="{{ url('TMS') }}"> Exit
                            </a> 
                        </button>
                    </div>

                </div>
                <div class="status">
                    <div class="head">Current Status</div>
                    {{-- ------------------------------By Pankaj-------------------------------- --}}
                    @if ($jobTraining->stage == 0)
                        <div class="progress-bars ">
                            <div class="bg-danger">Closed-Cancelled</div>
                        </div>
                    @else
                        <div class="progress-bars d-flex">
                            @if ($jobTraining->stage >= 1)
                                <div class="active">Opened</div>
                            @else
                                <div class="">Opened</div>
                            @endif

                            {{-- @if ($jobTraining->stage >= 2)
                                <div class="active">In Accept</div>
                            @else
                                <div class="">In Accept</div>
                            @endif
                            @if ($jobTraining->stage >= 3)
                                <div class="active">QA Review</div>
                            @else
                                <div class="">QA Review</div>
                            @endif --}}

                            @if ($jobTraining->stage >= 2)
                                <div class="active">QA/CQA Head Approval</div>
                            @else
                                <div class="">QA/CQA Approval</div>
                            @endif
                            
                            @if ($jobTraining->stage >= 3)
                                <div class="active">Employee Answers</div>
                            @else
                                <div class="">Employee Answers</div>
                            @endif

                            @if ($jobTraining->stage >= 4)
                                <div class="active">Evaluation</div>
                            @else
                                <div class="">Evaluation</div>
                            @endif

                            @if ($jobTraining->stage >= 5)
                                <div class="active">QA/CQA Head Final Review</div>
                            @else
                                <div class="">QA/CQA Head Final Review</div>
                            @endif

                            @if ($jobTraining->stage >= 6)
                                <div class="active">Verification and Approval</div>
                            @else
                                <div class="">Verification and Approval</div>
                            @endif

                            @if ($jobTraining->stage >= 9)
                                <div class="bg-danger">Closed - Done</div>
                            @else
                                <div class="">Closed - Done</div>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- @endif --}}
            </div>
        </div>

        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm2')">Job Description</button>
            

            <button class="cctablinks " onclick="openCity(event, 'CCForm3')">QA Review</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm4')">QA/CQA Approval</button>

            <!-- <button class="cctablinks " onclick="openCity(event, 'CCForm5')">Questionaries</button> -->

            <button class="cctablinks " onclick="openCity(event, 'CCForm6')">Evaluation</button>

            @if ($jobTraining->stage >= 7)
            <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Certificate</button>
            @endif
            
            <button class="cctablinks " onclick="openCity(event, 'CCForm8')">QA/CQA Head Final Review</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm9')">Final Approval</button>

        </div>

        <script>
            $(document).ready(function() {
                <?php if (in_array($jobTraining->stage, [9])) : ?>
                $("#target :input").prop("disabled", true);
                <?php endif; ?>
            });
        </script>

        <form id="target" action="{{ route('job_trainingupdate', ['id' => $jobTraining->id]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div id="step-form">

                @if (!empty($parent_id))
                    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                    <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="row">
               
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number">Employee Name </label>
                                        <input type="text" name="name" id="name_employee"
                                            value="{{ $jobTraining->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="employee_id">Employee Code</label>
                                        <input id="employee_id" name="empcode" type="text"
                                            value="{{ $jobTraining->empcode }}" readonly>
                                        @error('empcode')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="type_of_training">SOP Document</label>

                                        <select name="sopdocument" id="sopdocument" onchange="fetchQuestions(this.value)">
                                            <option value="">---Select SOP Document---</option>

                                            @foreach ($data as $dat)
                                                <option
                                                    value="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}"
                                                    {{ $savedSop == $dat->sop_type_short . '/' . $dat->department_id . '/000' . $dat->id . '/R' . $dat->major ? 'selected' : '' }}>
                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                </option>
                                            @endforeach

                                        </select> 
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="type_of_training">SOP Document</label>

                                        <select name="sopdocument" id="sopdocument" onchange="fetchQuestions(this.value)">
                                            <option value="">---Select SOP Document---</option>

                                            @foreach ($data as $dat)
                                                <option
                                                    value="{{ $dat->id }}"
                                                    {{ $savedSop == $dat->id ? 'selected' : '' }}>
                                                    {{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                


                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="type_of_training">Type of Training</label>
                                        <select name="type_of_training" id="type_of_training">
                                            <option value="">----Select Training----</option>
                                            <option value="on the job"
                                                {{ $jobTraining->type_of_training == 'on the job' ? 'selected' : '' }}>On
                                                The Job</option>
                                            <option value="classroom"
                                                {{ $jobTraining->type_of_training == 'classroom' ? 'selected' : '' }}>
                                                Classroom</option>
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="start_date">Start Date</label>
                                        <input id="start_date" type="date" name="start_date"
                                            value="{{ $jobTraining->start_date }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="end_date">End Date</label>
                                        <input id="end_date" type="date" name="end_date"
                                            value="{{ $jobTraining->end_date }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Department">Department</label>
                                        <select name="department" readonly>
                                            <option value="">-- Select Dept --</option>
                                
                                            @php
                                                $savedDepartmentId = old('department', $jobTraining->department);
                                            @endphp

                                            @foreach (Helpers::getDepartments() as $code => $department)
                                                <option value="{{ $code }}"
                                                    @if ($savedDepartmentId == $code) selected @endif>{{ $department }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code">Location</label>
                                        <input type="text" name="location" value="{{ $jobTraining->location }}" readonly>
                                    </div>
                                </div> --}}

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="HOD Persons">HOD</label>
                                        <select name="hod" id="hod">
                                            <option value="">-- Select HOD --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $user->id == old('hod', $jobTraining->hod) ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="hod">Revision Purpose</label>
                                    <select name="revision_purpose" id="" >
                                        <option value="">----Select---</option>
                                            <option value="New"
                                                {{ $jobTraining->revision_purpose == 'New' ? 'selected' : '' }}>New
                                                </option>
                                            <option value="Old"
                                                {{ $jobTraining->revision_purpose == 'Old' ? 'selected' : '' }}>
                                                Old</option>

                                    </select>
                                </div>
                            </div> --}}

<div class="col-lg-6">
    <div class="group-input">
        <label for="revision_purpose">Revision Purpose</label>
        <select name="revision_purpose" id="revision_purpose" onchange="toggleRemarkInput()">
            <option value="">----Select---</option>
            <option value="New" {{ isset($jobTraining) && $jobTraining->revision_purpose == 'New' ? 'selected' : '' }}>New</option>
            <option value="Old" {{ isset($jobTraining) && $jobTraining->revision_purpose == 'Old' ? 'selected' : '' }}>Old</option>
        </select>
    </div>
</div>

<!-- Remark Input Field -->
<div class="col-lg-6" id="remark_container" style="display: {{ isset($jobTraining) && $jobTraining->revision_purpose == 'Old' ? 'block' : 'none' }};">
    <div class="group-input">
        <label for="remark">Remark</label>
        <textarea name="remark" id="remark" rows="4" placeholder="Enter your remark here...">{{ isset($jobTraining) ? $jobTraining->remark : '' }}</textarea>
    </div>
</div>
<script>
    // Function to toggle the remark input based on selection
    function toggleRemarkInput() {
        const revisionPurposeSelect = document.getElementById('revision_purpose');
        const remarkContainer = document.getElementById('remark_container');

        // Show the remark input if "Old" is selected, otherwise hide it
        if (revisionPurposeSelect.value === 'Old') {
            remarkContainer.style.display = 'block';
        } else {
            remarkContainer.style.display = 'none';
            // Clear the remark input when hiding (optional)
            document.getElementById('remark').value = '';
        }
    }

    // Call the function on page load to set the initial state
    document.addEventListener('DOMContentLoaded', function() {
        toggleRemarkInput(); // Call the function to initialize display based on current selection
    });
</script>



                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="hod">Evaluation Required</label>
                                    <select name="evaluation_required" id="" >
                                        <option value="">----Select---</option>
                                        <option value="Yes"
                                                {{ $jobTraining->evaluation_required == 'Yes' ? 'selected' : '' }}>Yes
                                                </option>
                                            <option value="No"
                                                {{ $jobTraining->evaluation_required == 'No' ? 'selected' : '' }}>
                                                No</option>
                                    
                                    </select>
                                </div>
                            </div>


                                <div class="col-12">
                                    <div class="group-input">
                                        <div class="why-why-chart">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;">Sr.No.</th>
                                                        <th style="width: 30%;">Document Title</th>
                                                        <th>Type of Training</th>
                                                        <th>SOP NO.</th>
                                                        <th>Trainer</th>
                                                        <th> Date of Training</th>
                                                        <th>Date of Completion </th>
                                                        <th>SOP Preview</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        // Fetch the trainers' IDs
                                                        $trainerIds = DB::table('user_roles')
                                                            ->where('q_m_s_roles_id', 6)
                                                            ->pluck('user_id');
                                                        $usersDetails = DB::table('users')->select('id', 'name')->get();
                                                        $trainers = DB::table('users')
                                                            ->whereIn('id', $trainerIds)
                                                            ->select('id', 'name')
                                                            ->get();
                                                    @endphp

                                                    <!-- @for ($i = 1; $i <= 5; $i++)
                                                        <tr>
                                                            <td>{{ $i }} </td>
                                                            <td>
                                                                <input type="text" name="subject_{{ $i }}"
                                                                    value="{{ $jobTraining->{'subject_' . $i} }}">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                    name="type_of_training_{{ $i }}"
                                                                    value="{{ $jobTraining->{'type_of_training_' . $i} }}">
                                                            </td>
                                                            <td>
                                                                <input type="text"
                                                                    name="reference_document_no_{{ $i }}"
                                                                    value="{{ $jobTraining->{'reference_document_no_' . $i} }}">
                                                            </td>
                     
                                                            <td>
                                                                <select name="trainer_{{ $i }}"
                                                                    id="">
                                                                    <option value="">-- Select --</option>
                                                                    @foreach ($usersDetails as $u)
                                                                        <option value="{{ $u->id }}"
                                                                            {{ $jobTraining->{'trainer_' . $i} == $u->id ? 'selected' : '' }}>
                                                                            {{ $u->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="date"
                                                                    name="startdate_{{ $i }}"
                                                                    value="{{ $jobTraining->{'startdate_' . $i} }}"
                                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                    class="hide-input"
                                                                    oninput="handleDateInput(this, 'startdate');checkDate('startdate','enddate')">
                                                            </td>

                                                            <td>
                                                                <input type="date"
                                                                    name="enddate_{{ $i }}"
                                                                    value="{{ $jobTraining->{'enddate_' . $i} }}"
                                                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                    class="hide-input"
                                                                    oninput="handleDateInput(this, 'enddate');checkDate('enddate','startdate')">
                                                            </td>
                              
                                                        </tr>
                                                    @endfor -->
<tr>
<td>1</td>
<td>
    <select name="subject_1" id="sopdocument" onchange="fetchDocumentDetails(this)">
        <option value="">---Select Document Name---</option>
        @foreach ($data as $dat)
        <option value="{{ $dat->document_name }}" 
                data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}" 
                data-sop-id="{{ $dat->id }}"
                @if(old('subject_1', $jobTraining->subject_1 ?? '') == $dat->document_name) selected @endif>
            {{ $dat->document_name }}
        </option>
        @endforeach
    </select>
</td>
<td><input type="text" name="type_of_training_1" value="{{ old('type_of_training_1', $jobTraining->type_of_training_1 ?? '') }}"></td>
<td><input type="text" name="reference_document_no_1" id="document_number" value="{{ old('reference_document_no_1', $jobTraining->reference_document_no_1 ?? '') }}" readonly></td>
<td>
    <select name="trainer_1" id="trainer_1">
        <option value="">-- Select --</option>
        @foreach ($usersDetails as $u)
        <option value="{{ $u->id }}" @if(old('trainer_1', $jobTraining->trainer_1 ?? '') == $u->id) selected @endif>{{ $u->name }}</option>
        @endforeach
    </select>
</td>
<td><input type="date" name="startdate_1" id="startdate_1" value="{{ old('startdate_1', $jobTraining->startdate_1 ?? '') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
<td><input type="date" name="enddate_1" id="enddate_1" value="{{ old('enddate_1', $jobTraining->enddate_1 ?? '') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
<td>
    <a href="{{ $jobTraining->reference_document_no_1 ? '/documents/viewpdf/' . $jobTraining->reference_document_no_1 : '#' }}" id="view_sop" target="_blank" style="display: {{ $jobTraining->reference_document_no_1 ? 'inline' : 'none' }};">View SOP</a>
</td>

<input type="hidden" name="reference_document_no_1" id="selected_document_id" value="{{ old('reference_document_no_1', $jobTraining->reference_document_no_1 ?? '') }}">
</tr>

                                                    <tr>
                                                    <td>2</td>
                                                    <td>
    <select name="subject_2" id="sopdocument" onchange="fetchDocumentDetails2(this)">
        <option value="">---Select Document Name---</option>
        @foreach ($data as $dat)
        <option value="{{ $dat->document_name }}" 
                data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}" 
                data-sop-id="{{ $dat->id }}"
                @if(old('subject_2', $jobTraining->subject_2 ?? '') == $dat->document_name) selected @endif>
            {{ $dat->document_name }}
        </option>
        @endforeach
    </select>
</td>
<td><input type="text" name="type_of_training_2" value="{{ old('type_of_training_2', $jobTraining->type_of_training_2 ?? '') }}"></td>
<td><input type="text" name="reference_document_no_2" id="document_number2" value="{{ old('reference_document_no_2', $jobTraining->reference_document_no_2 ?? '') }}" readonly></td>
<td>
    <select name="trainer_2" id="trainer_2">
        <option value="">-- Select --</option>
        @foreach ($usersDetails as $u)
        <option value="{{ $u->id }}" @if(old('trainer_2', $jobTraining->trainer_2 ?? '') == $u->id) selected @endif>{{ $u->name }}</option>
        @endforeach
    </select>
</td>
<td><input type="date" name="startdate_2" id="startdate_2" value="{{ old('startdate_2', $jobTraining->startdate_2 ?? '') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
<td><input type="date" name="enddate_2" id="enddate_2" value="{{ old('enddate_2', $jobTraining->enddate_2 ?? '') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
<td>
    <a href="{{ $jobTraining->reference_document_no_2 ? '/documents/viewpdf/' . $jobTraining->reference_document_no_2 : '#' }}" id="view_sop2" target="_blank" style="display: {{ $jobTraining->reference_document_no_2 ? 'inline' : 'none' }};">View SOP</a>
</td>
<!-- Hidden field to store the document ID (which will go to the database) -->
<input type="hidden" name="reference_document_no_2" id="selected_document_id2" value="{{ old('reference_document_no_2', $jobTraining->reference_document_no_2 ?? '') }}">
</tr>

<tr>
<td>3</td>
<td>
    <select name="subject_3" id="sopdocument" onchange="fetchDocumentDetails3(this)">
        <option value="">---Select Document Name---</option>
        @foreach ($data as $dat)
        <option value="{{ $dat->document_name }}" 
                data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}" 
                data-sop-id="{{ $dat->id }}"
                @if(old('subject_3', $jobTraining->subject_3 ?? '') == $dat->document_name) selected @endif>
            {{ $dat->document_name }}
        </option>
        @endforeach
    </select>
</td>
<td><input type="text" name="type_of_training_3" value="{{ old('type_of_training_3', $jobTraining->type_of_training_3 ?? '') }}"></td>
<td><input type="text" name="reference_document_no_3" id="document_number3" value="{{ old('reference_document_no_3', $jobTraining->reference_document_no_3 ?? '') }}" readonly></td>
<td>
    <select name="trainer_3" id="trainer_3">
        <option value="">-- Select --</option>
        @foreach ($usersDetails as $u)
        <option value="{{ $u->id }}" @if(old('trainer_3', $jobTraining->trainer_3 ?? '') == $u->id) selected @endif>{{ $u->name }}</option>
        @endforeach
    </select>
</td>
<td><input type="date" name="startdate_3" id="startdate_3" value="{{ old('startdate_3', $jobTraining->startdate_3 ?? '') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
<td><input type="date" name="enddate_3" id="enddate_3" value="{{ old('enddate_3', $jobTraining->enddate_3 ?? '') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
<td>
    <a href="{{ $jobTraining->reference_document_no_3 ? '/documents/viewpdf/' . $jobTraining->reference_document_no_3 : '#' }}" id="view_sop3" target="_blank" style="display: {{ $jobTraining->reference_document_no_3 ? 'inline' : 'none' }};">View SOP</a>
</td>
<!-- Hidden field to store the document ID (which will go to the database) -->
<input type="hidden" name="reference_document_no_3" id="selected_document_id3" value="{{ old('reference_document_no_3', $jobTraining->reference_document_no_3 ?? '') }}">
</tr>

<tr>
<td>4</td>
<td>
    <select name="subject_4" id="sopdocument" onchange="fetchDocumentDetails4(this)">
        <option value="">---Select Document Name---</option>
        @foreach ($data as $dat)
        <option value="{{ $dat->document_name }}" 
                data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}" 
                data-sop-id="{{ $dat->id }}"
                @if(old('subject_4', $jobTraining->subject_4 ?? '') == $dat->document_name) selected @endif>
            {{ $dat->document_name }}
        </option>
        @endforeach
    </select>
</td>
<td><input type="text" name="type_of_training_4" value="{{ old('type_of_training_4', $jobTraining->type_of_training_4 ?? '') }}"></td>
<td><input type="text" name="reference_document_no_4" id="document_number4" value="{{ old('reference_document_no_4', $jobTraining->reference_document_no_4 ?? '') }}" readonly></td>
<td>
    <select name="trainer_4" id="trainer_4">
        <option value="">-- Select --</option>
        @foreach ($usersDetails as $u)
        <option value="{{ $u->id }}" @if(old('trainer_4', $jobTraining->trainer_4 ?? '') == $u->id) selected @endif>{{ $u->name }}</option>
        @endforeach
    </select>
</td>
<td><input type="date" name="startdate_4" id="startdate_4" value="{{ old('startdate_4', $jobTraining->startdate_4 ?? '') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
<td><input type="date" name="enddate_4" id="enddate_4" value="{{ old('enddate_4', $jobTraining->enddate_4 ?? '') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
<td>
    <a href="{{ $jobTraining->reference_document_no_4 ? '/documents/viewpdf/' . $jobTraining->reference_document_no_4 : '#' }}" id="view_sop4" target="_blank" style="display: {{ $jobTraining->reference_document_no_4 ? 'inline' : 'none' }};">View SOP</a>
</td>
<input type="hidden" name="reference_document_no_4" id="selected_document_id4" value="{{ old('reference_document_no_4', $jobTraining->reference_document_no_4 ?? '') }}">
</tr>

<tr>
<td>5</td>
<td>
    <select name="subject_5" id="sopdocument" onchange="fetchDocumentDetails5(this)">
        <option value="">---Select Document Name---</option>
        @foreach ($data as $dat)
        <option value="{{ $dat->document_name }}" 
                data-doc-number="{{ $dat->sop_type_short }}/{{ $dat->department_id }}/000{{ $dat->id }}/R{{ $dat->major }}" 
                data-sop-id="{{ $dat->id }}"
                @if(old('subject_5', $jobTraining->subject_5 ?? '') == $dat->document_name) selected @endif>
            {{ $dat->document_name }}
        </option>
        @endforeach
    </select>
</td>
<td><input type="text" name="type_of_training_5" value="{{ old('type_of_training_5', $jobTraining->type_of_training_5 ?? '') }}"></td>
<td><input type="text" name="reference_document_no_5" id="document_number5" value="{{ old('reference_document_no_5', $jobTraining->reference_document_no_5 ?? '') }}" readonly></td>
<td>
    <select name="trainer_5" id="trainer_5">
        <option value="">-- Select --</option>
        @foreach ($usersDetails as $u)
        <option value="{{ $u->id }}" @if(old('trainer_5', $jobTraining->trainer_5 ?? '') == $u->id) selected @endif>{{ $u->name }}</option>
        @endforeach
    </select>
</td>
<td><input type="date" name="startdate_5" id="startdate_5" value="{{ old('startdate_5', $jobTraining->startdate_5 ?? '') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
<td><input type="date" name="enddate_5" id="enddate_5" value="{{ old('enddate_5', $jobTraining->enddate_5 ?? '') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"></td>
<td>
    <a href="{{ $jobTraining->reference_document_no_5 ? '/documents/viewpdf/' . $jobTraining->reference_document_no_5 : '#' }}" id="view_sop5" target="_blank" style="display: {{ $jobTraining->reference_document_no_5 ? 'inline' : 'none' }};">View SOP</a>
</td>
<input type="hidden" name="reference_document_no_5" id="selected_document_id5" value="{{ old('reference_document_no_5', $jobTraining->reference_document_no_5 ?? '') }}">
</tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <script>
                                function fetchDocumentDetails(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];

                                    var documentNumber = selectedOption.getAttribute('data-doc-number');
                                    
                                    var documentId = selectedOption.getAttribute('data-sop-link');

                                    document.getElementById('document_number').value = documentNumber;

                                    var sopAnchor = document.getElementById('view_sop');
                                    if (documentId) {
                                        sopAnchor.href = `/documents/viewpdf/${documentId}`;
                                        sopAnchor.style.display = 'inline';
                                    } else {
                                        sopAnchor.style.display = 'none';
                                    }
                                }

                                function fetchDocumentDetails2(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];

                                    var documentNumber = selectedOption.getAttribute('data-doc-number');
                                    
                                    var documentId = selectedOption.getAttribute('data-sop-link');

                                    document.getElementById('document_number1').value = documentNumber;

                                    var sopAnchor = document.getElementById('view_sop1');
                                    if (documentId) {
                                        sopAnchor.href = `/documents/viewpdf/${documentId}`;
                                        sopAnchor.style.display = 'inline';
                                    } else {
                                        sopAnchor.style.display = 'none';
                                    }
                                }

                                function fetchDocumentDetails3(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];

                                    var documentNumber = selectedOption.getAttribute('data-doc-number');
                                    
                                    var documentId = selectedOption.getAttribute('data-sop-link');

                                    document.getElementById('document_number2').value = documentNumber;

                                    var sopAnchor = document.getElementById('view_sop2');
                                    if (documentId) {
                                        sopAnchor.href = `/documents/viewpdf/${documentId}`;
                                        sopAnchor.style.display = 'inline';
                                    } else {
                                        sopAnchor.style.display = 'none';
                                    }
                                }

                                function fetchDocumentDetails4(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];

                                    var documentNumber = selectedOption.getAttribute('data-doc-number');
                                    
                                    var documentId = selectedOption.getAttribute('data-sop-link');

                                    document.getElementById('document_number3').value = documentNumber;

                                    var sopAnchor = document.getElementById('view_sop3');
                                    if (documentId) {
                                        sopAnchor.href = `/documents/viewpdf/${documentId}`;
                                        sopAnchor.style.display = 'inline';
                                    } else {
                                        sopAnchor.style.display = 'none';
                                    }
                                }

                                function fetchDocumentDetails5(selectElement) {
                                    var selectedOption = selectElement.options[selectElement.selectedIndex];

                                    var documentNumber = selectedOption.getAttribute('data-doc-number');
                                    
                                    var documentId = selectedOption.getAttribute('data-sop-link');

                                    document.getElementById('document_number4').value = documentNumber;

                                    var sopAnchor = document.getElementById('view_sop4');
                                    if (documentId) {
                                        sopAnchor.href = `/documents/viewpdf/${documentId}`;
                                        sopAnchor.style.display = 'inline';
                                    } else {
                                        sopAnchor.style.display = 'none';
                                    }
                                }
                            </script> -->

                            <div class="button-block">
                                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                      

                            </div>
                        </div>
                    </div>

                </div>
<script>
  function fetchDocumentDetails(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];

    var documentName = selectedOption.value;
    var documentNumber = selectedOption.getAttribute('data-doc-number');
    var documentId = selectedOption.getAttribute('data-sop-id');

    document.getElementById('document_number').value = documentNumber;
    document.getElementById('selected_document_id').value = documentId;

    // Update the "View SOP" link's href based on the selected document's ID
    var sopAnchor = document.getElementById('view_sop');
    if (documentId) {
        sopAnchor.href = '/documents/viewpdf/' + documentId; // Correct SOP path
        sopAnchor.style.display = 'inline'; // Show the "View SOP" link
    } else {
        sopAnchor.style.display = 'none'; // Hide the "View SOP" link if no document is selected
    }

    // Log values for debugging
    console.log("Document Name:", documentName);
    console.log("Document Number (displayed):", documentNumber);
    console.log("Document ID (stored):", documentId);
}

</script>
<script>
    function fetchDocumentDetails2(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];

    var documentName = selectedOption.value; 
    var documentNumber = selectedOption.getAttribute('data-doc-number');
    var documentId = selectedOption.getAttribute('data-sop-id');
    
    // Update document number input (this shows the document number, but ID will be stored in the database)
    document.getElementById('document_number2').value = documentNumber;

    // Update the hidden field where the actual document ID will be stored for the database
    document.getElementById('selected_document_id2').value = documentId;

    // Update the "View SOP" link's href based on the selected document's ID
    var sopAnchor = document.getElementById('view_sop2');
    if (documentId) {
        sopAnchor.href = '/documents/viewpdf/' + documentId; // Correct SOP path
        sopAnchor.style.display = 'inline'; // Show the "View SOP" link
    } else {
        sopAnchor.style.display = 'none';
    }

    console.log("Document Name:", documentName);
    console.log("Document Number (displayed):", documentNumber);
    console.log("Document ID (stored):", documentId);
}
</script>

<script>
     function fetchDocumentDetails3(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];

    var documentName = selectedOption.value; 
    var documentNumber = selectedOption.getAttribute('data-doc-number');
    var documentId = selectedOption.getAttribute('data-sop-id');
    
    document.getElementById('document_number3').value = documentNumber;

    document.getElementById('selected_document_id3').value = documentId;

    // Update the "View SOP" link's href based on the selected document's ID
    var sopAnchor = document.getElementById('view_sop3');
    if (documentId) {
        sopAnchor.href = '/documents/viewpdf/' + documentId;
        sopAnchor.style.display = 'inline';
    } else {
        sopAnchor.style.display = 'none';
    }

    console.log("Document Name:", documentName);
    console.log("Document Number (displayed):", documentNumber);
    console.log("Document ID (stored):", documentId);
}
</script>

<script>
     function fetchDocumentDetails4(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];

    var documentName = selectedOption.value; 
    var documentNumber = selectedOption.getAttribute('data-doc-number');
    var documentId = selectedOption.getAttribute('data-sop-id');
    
    document.getElementById('document_number4').value = documentNumber;

    document.getElementById('selected_document_id4').value = documentId;

    // Update the "View SOP" link's href based on the selected document's ID
    var sopAnchor = document.getElementById('view_sop4');
    if (documentId) {
        sopAnchor.href = '/documents/viewpdf/' + documentId;
        sopAnchor.style.display = 'inline';
    } else {
        sopAnchor.style.display = 'none';
    }

    console.log("Document Name:", documentName);
    console.log("Document Number (displayed):", documentNumber);
    console.log("Document ID (stored):", documentId);
}
</script>

<script>
     function fetchDocumentDetails5(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];

    var documentName = selectedOption.value; 
    var documentNumber = selectedOption.getAttribute('data-doc-number');
    var documentId = selectedOption.getAttribute('data-sop-id');
    
    document.getElementById('document_number5').value = documentNumber;

    document.getElementById('selected_document_id5').value = documentId;

    var sopAnchor = document.getElementById('view_sop5');
    if (documentId) {
        sopAnchor.href = '/documents/viewpdf/' + documentId;
        sopAnchor.style.display = 'inline';
    } else {
        sopAnchor.style.display = 'none';
    }

    console.log("Document Name:", documentName);
    console.log("Document Number (displayed):", documentNumber);
    console.log("Document ID (stored):", documentId);
}
</script>


        <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="select-state">Name of Employee</label>
                                    <select id="select-state" name="name_employee_disabled" disabled>
                                        <option value="">Select an employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" 
                                                {{ $employee->id == old('name_employee', $jobTraining->name_employee) ? 'selected' : '' }}
                                                data-name="{{ $employee->employee_name }}">
                                                {{ $employee->employee_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="name_employee" value="{{ old('name_employee', $jobTraining->name_employee) }}">
                                    @error('employee_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Job Description Number</label>
                                    <input type="text" name="job_description_no" value="{{ old('job_description_no', $jobTraining->job_description_no) }}" @if($jobTraining->stage != 3) disabled @endif>
                                </div>
                            </div>
              
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="end_date">Effective Date </label>
                                    <input id="end_date" type="date" value="{{ old('effective_date', $jobTraining->effective_date) }}" name="effective_date" >
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="employee_id">Employee ID </label>
                                    <input disabled type="text" name="employee_id" value="{{ $jobTraining->empcode }}" id="employee_ids" readonly>


                                    
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="department_location">Department</label>
                                    <select  name="new_department">
                                            <option value="">-- Select Dept --</option>
                                
                                            @php
                                                $savedDepartmentId = old('new_department', $jobTraining->new_department);
                                            @endphp

                                            @foreach (Helpers::getDepartments() as $code => $department)
                                                <option value="{{ $code }}"
                                                    @if ($savedDepartmentId == $code) selected @endif>{{ $department }}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="designation">Designation </label>
                                    <input type="text" name="designation" id="designees" value="{{ $jobTraining->designation }}"  readonly>
                                </div>
                            </div>
                            <input type="hidden" name="employee_name" id="employee_name">

                            <div class="col-6">
                                <div class="group-input">
                                    <label for="Short Description">Qualification </label>
                                    <input id="qualifications" type="text" name="qualification" value="{{ $jobTraining->qualification }}" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input" id="repeat_nature">
                                    <label for="repeat_nature">OutSide Experience In Years</label>
                                    <input type="text" name="total_experience" value="{{ old('total_experience', $jobTraining->total_experience) }}" @if($jobTraining->stage != 2) disabled @endif>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="repeat_nature">Date of Joining<span class="text-danger d-none">*</span></label>
                                        <div class="calenderauditee">
                                            <input type="text" id="date_joining_displays" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="date_joining" id="date_joinings" class="hide-input" oninput="handleDateInput(this, 'date_joining_display')" value="{{ $jobTraining->date_joining }}" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>

                                document.getElementById('select-state').addEventListener('change', function() {
                                    var selectedOption = this.options[this.selectedIndex];
                                    var employeeId = selectedOption.value;
                                    var employeeName = selectedOption.getAttribute('data-name');

                                    if (employeeId) {
                                        fetch(`/employees/${employeeId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                document.getElementById('employee_ids').value = data.full_employee_id;
                                                document.getElementById('departments').value = data.department;
                                                document.getElementById('designees').value = data.job_title;
                                                document.getElementById('experience').value = data.experience;
                                                document.getElementById('qualifications').value = data.qualification;
                                                document.getElementById('date_joinings').value = data.joining_date;
                                                document.getElementById('date_joining_displays').value = formatDate(data.joining_date);
                                            });
                                        document.getElementById('employee_name').value = employeeName;
                                    } else {
                                        // Reset fields if no employee is selected
                                        document.getElementById('employee_ids').value = '';
                                        document.getElementById('departments').value = '';
                                        document.getElementById('designees').value = '';
                                        document.getElementById('experience').value = '';
                                        document.getElementById('qualifications').value = '';
                                        document.getElementById('employee_name').value = '';
                                        document.getElementById('date_joinings').value = '';
                                        document.getElementById('date_joining_displays').value = '';
                                    }
                                });


                                function formatDate(dateString) {
                                    const date = new Date(dateString);
                                    const options = {
                                        year: 'numeric',
                                        month: 'short',
                                        day: '2-digit'
                                    };
                                    return date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                }
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Experience With Agio Pharma </label>
                                    <input type="text" name="experience_with_agio" value="{{ old('experience_with_agio', $jobTraining->experience_with_agio) }}" @if($jobTraining->stage != 2) disabled @endif>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Total Years of Experience </label>
                                    <input type="text" name="experience_if_any" id="" value="{{ $jobTraining->experience_if_any }}" readonly>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Reason For Revision </label>
                                    <input type="text" name="reason_for_revision" value="{{ old('reason_for_revision', $jobTraining->reason_for_revision) }}" @if($jobTraining->stage != 2) disabled @endif>
                                </div>
                            </div> --}}

                            <div class="col-lg-6">
    <div class="group-input">
        <label for="jd_type">Job Description Status</label>
        <select id="jd_type" name="jd_type" required>
            <option value="">Select...</option>
            <option value="new" {{ old('jd_type', $jobTraining->jd_type) === 'new' ? 'selected' : '' }}>New</option>
            <option value="old" {{ old('jd_type', $jobTraining->jd_type) === 'old' ? 'selected' : '' }}>Old</option>
        </select>
    </div>
</div>

<div class="col-lg-6" id="revision_reason_div" style="{{ $jobTraining->jd_type === 'old' ? 'display: block;' : 'display: none;' }}">
    <div class="group-input">
        <label for="reason_for_revision">Reason for Revision</label>
        <input type="text" name="reason_for_revision" id="reason_for_revision" value="{{ old('reason_for_revision', $jobTraining->reason_for_revision) }}">
    </div>
</div>

<script>
    // Initialize visibility of the revision reason field based on the current status
    document.addEventListener('DOMContentLoaded', function() {
        var statusSelect = document.getElementById('jd_type');
        var selectedValue = statusSelect.value;

        // Show or hide the reason for revision field based on selection
        if (selectedValue === 'old') {
            document.getElementById('revision_reason_div').style.display = 'block';
        } else {
            document.getElementById('revision_reason_div').style.display = 'none';
        }
    });

    document.getElementById('jd_type').addEventListener('change', function() {
        var selectedValue = this.value;

        // Show or hide the reason for revision field based on selection
        if (selectedValue === 'old') {
            document.getElementById('revision_reason_div').style.display = 'block';
        } else {
            document.getElementById('revision_reason_div').style.display = 'none';
            document.getElementById('reason_for_revision').value = ''; // Clear input when hiding
        }
    });
</script>



                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Delegate</label>
                                    <select name="delegate" id="hod">
                                            <option value="">-- Select Delegate --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $user->id == old('delegate', $jobTraining->delegate) ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>

                            
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="For Revision">Delegate</label>
                                    <select id="select-state" placeholder="Select..." name="delegate" required>
                                        <option value="">Select an employee</option>
                                        @foreach ($users as $user)
                                        <option value="" data-name="">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}


                
                    <div class="col-12 sub-head">
                        Job Responsibilities
                    </div>
                    <div class="pt-2 group-input">
                        <label for="audit-agenda-grid">
                            Job Responsibilities
                            <button type="button" name="audit-agenda-grid" id="ObservationAdd">+</button>
                            <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                (Launch Instruction)
                            </span>
                        </label>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="job-responsibilty-table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">Sr No.</th>
                                        <th>Job Responsibilities </th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($employee_grid_data && is_array($employee_grid_data->data))
                                    @foreach ($employee_grid_data->data as $index => $employee_grid)
                                    <tr>
                                        <td><input disabled type="text" name="jobResponsibilities[{{ $loop->index }}][serial]" value="{{ $loop->index+1 }}"></td>
                                        <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][job]" value="{{ array_key_exists('job', $employee_grid) ? $employee_grid['job'] : '' }}" @if($jobTraining->stage != 2) disabled @endif></td>
                                        <td><input type="text" name="jobResponsibilities[{{ $loop->index }}][remarks]" value="{{ array_key_exists('remarks', $employee_grid) ? $employee_grid['remarks'] : '' }}" @if($jobTraining->stage != 2) disabled @endif></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td><input disabled type="text" name="jobResponsibilities[0][serial]" value="1"></td>
                                        <td><input type="text" name="jobResponsibilities[0][job]" @if($jobTraining->stage != 2) disabled @endif></td>
                                        <td><input type="text" name="jobResponsibilities[0][remarks]" @if($jobTraining->stage != 2) disabled @endif></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div> 

                    {{-- <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Submitted By">Reporting Authority: </label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Submitted On">Responsible Person/s in absence </label>
                            <div class="static"></div>
                        </div>
                    </div> 

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Submitted By">Accepted by (Employee): </label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Submitted On">Authorized by (Head QA/CQA):  </label>
                            <div class="static"></div>
                        </div>
                    </div>--}}

            </div>
            <div class="button-block">
                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                <!-- <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                        Exit </a> </button> -->

            </div>
        </div>
        </div>

 

                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Activated On">Remark</label>
                                <textarea name="qa_review" maxlength="255">{{ $jobTraining->qa_review }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="External Attachment">Attachment</label>
                                <input type="file" id="myfile" name="qa_review_attachment" value="{{ $jobTraining->qa_review_attachment }}">
                                <a href="{{ asset('upload/' . $jobTraining->qa_review_attachment) }}" target="_blank">{{ $jobTraining->qa_review_attachment }}</a>
                            </div>
                        </div>
  
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>                                    
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        </div>
                    </div>
                </div>

                <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Activated On">Remark</label>
                                <textarea name="qa_cqa_comment" maxlength="255">{{ $jobTraining->qa_cqa_comment }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="External Attachment">Attachment</label>
                                <input type="file" id="myfile" name="qa_cqa_attachment" value="{{ $jobTraining->qa_cqa_attachment }}">
                                <a href="{{ asset('upload/' . $jobTraining->qa_cqa_attachment) }}" target="_blank">{{ $jobTraining->qa_cqa_attachment }}</a>
                            </div>
                        </div>
  
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>                                    
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        </div>
                    </div>
                </div>

                <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div id="questionsContainer" class="container">
                                <div>
                                    <!-- Questions will be dynamically injected here -->
                                </div>
                            </div>

                            
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectedDocumentId = document.getElementById('sopdocument').value;
        if (selectedDocumentId) {
            fetchQuestions(selectedDocumentId); // Document select hote hi questions fetch kare
        }
    });

    // Questions fetch kare aur quiz ko handle kare
    function fetchQuestions(documentId) {
        if (documentId) {
            fetch(`/fetch-questions/${documentId}`)
                .then(response => response.json())
                .then(data => {
                    const questionsContainer = document.getElementById('questionsContainer');
                    questionsContainer.innerHTML = ''; // Pehle ke questions clear kare

                    if (data.length > 0) {
                        window.quizData = data; // Globally save kare questions ko
                        data.forEach((question, index) => {
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

                        // Submit button add kare
                        questionsContainer.innerHTML += `
                            <div class="quiz-buttons">
                                <button type="button" id="submit-btn" class="btn btn-primary">Submit</button>
                            </div>
                        `;

                        // Submit button event listener add kare
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
            document.getElementById('questionsContainer').innerHTML = ''; // Clear questions if no document selected
        }
    }

    // Quiz submit kare aur result calculate kare
    // function submitQuiz() {
    //     const userAnswers = [];

    //     // User answers ko collect kare
    //     quizData.forEach(question => {
    //         const questionId = `question_${question.id}`;
    //         const answerElements = document.querySelectorAll(`input[name="${questionId}"]:checked`);
    //         const answers = [...answerElements].map(input => input.value);
    //         userAnswers.push(answers);
    //     });

    //     calculateResults(userAnswers);
    // }
    function submitQuiz() {
    const userAnswers = [];

    // User answers ko collect kare
    quizData.forEach(question => {
        const questionId = `question_${question.id}`;
        const answerElements = document.querySelectorAll(`input[name="${questionId}"]:checked`);
        const answers = [...answerElements].map(input => input.value);
        userAnswers.push({ questionId: question.id, answers: answers });
    });

    // Answers ko server par bhejne ke liye
    saveAnswers(userAnswers);
}

function saveAnswers(userAnswers) {
    fetch('/save-answers', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
        },
        body: JSON.stringify({ answers: userAnswers })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            calculateResults(userAnswers); // Result calculate karne ke liye
        } else {
            alert('Error saving answers.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


    // Result ko calculate kare aur display kare
    function calculateResults(userAnswers) {
    let marks = 0;

    quizData.forEach((question, index) => {
        const correctAnswer = question.answer;
        const userAnswer = userAnswers[index]?.answers;

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
    });

    displaySummary(marks);
    evaluatePassingCriteria(marks);
}


    // Marks ko display kare
    function displaySummary(marks) {
        const totalQuestions = quizData.length;
        alert(`You scored ${marks} out of ${totalQuestions}`);
    }

    // Passing criteria ko evaluate kare aur next steps show kare
    function evaluatePassingCriteria(marks) {
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

    // Helper function to compare arrays for multiple choice answers
    function arraysEqual(arr1, arr2) {
        return Array.isArray(arr1) &&
            Array.isArray(arr2) &&
            arr1.length === arr2.length &&
            arr1.every((val, index) => val === arr2[index]);
    }
</script>

                        
  
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>                                    
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        </div>
                    </div>
                </div>


                <div id="CCForm6" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Activated On">Remark</label>
                                <textarea name="evaluation_comment" maxlength="255">{{ $jobTraining->evaluation_comment }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="External Attachment">Attachment</label>
                                <input type="file" id="myfile" name="evaluation_attachment" value="{{ $jobTraining->evaluation_attachment }}">
                                <a href="{{ asset('upload/' . $jobTraining->evaluation_attachment) }}" target="_blank">{{ $jobTraining->evaluation_attachment }}</a>
                            </div>
                        </div>
  
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>                                    
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        </div>
                    </div>
                </div>

                @if ($jobTraining->stage >= 7)
                    <div id="CCForm7" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="col-lg-12">
                                <div class="button-block">
                                        <button type="button" class="printButton" onclick="printCertificate()">
                                            <i class="fas fa-print"></i> Print
                                        </button>
                                    </div>
                                    <div class="certificate-container">
                                        <div class="certificate-title">TRAINING CERTIFICATE</div>

                                        <div class="certificate-description"><br><br>
                                            This is to certify that Mr./Ms./Mrs. <strong>{{$jobTraining->name}}</strong>.
                                            has undergone On Job training including the requirement of cGMP and has shown a good attitude and thorough understanding in the subject.
                                        </div>

                                        <div class="certificate-description">
                                            Therefore we certify that Mr. Ms. / Mrs. <strong>{{$jobTraining->name}}</strong>.
                                            is capable of performing his/her assigned duties in the <strong>{{$jobTraining->department}}</strong> Department independently.
                                        </div>

                                        <div class="date-container">
                                        <div class="signature-block">
                                            <strong>Sign/Date:</strong>_________
                                            <div>HR Department</div>
                                        </div>

                                        <div>
                                                <strong>Sign/Date:</strong>_________
                                                <div class="signature">Head QA/CQA<div></div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="margin-top: 40px;" class="button-block">
                                <button type="submit" class=" btn btn saveButton">Save</button>
                                <button type="button" id="ChangeNextButton" class=" btn btn nextButton">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

    <style>
                .certificate-container {
                width: 685px;
                height: 500px;
                border: 4px solid #3d6186;
                padding: 18px;
                background-color: white;
                position: relative;
                margin: auto;
                box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
            }
            .certificate-title {
                font-size: 30px;
                font-weight: bold;
                color: #677078;
                display: flex;
                justify-content: center;
            }
            .certificate-subtitle {
                font-size: 18px;
                color: #555;
            } 
            .certificate-description {
                margin-top: 30px;
                font-size: 18px;
                color: #333;
            }
            .date-container {
                display: flex;
                justify-content: space-between;
                margin-top: 60px;
                font-size: 18px;
            }
            .signature-container {
                position: absolute;
                bottom: 40px;
                right: 50px;
                text-align: center;
                font-size: 18px;
                color: #333;
            }

            @media print {
                .button-block {
                    display: none !important;
                }

                body * {
                    visibility: hidden;
                }

                #CCForm6, #CCForm6 * {
                    visibility: visible;
                }

                #CCForm6 {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }
            }

            .button-block {
                display: flex;
                justify-content: flex-end;
                margin-top: 50px;
            }

            .printButton {
                background-color: #2c3e50;
                color: white;
                border: none;
                padding: 12px 24px;
                font-size: 16px;
                cursor: pointer;
                border-radius: 5px;
                transition: background-color 0.3s ease;
                float: right;
            }

            .printButton:hover {
                background-color: #1a252f;
            }

            .printButton i {
                margin-right: 8px;
            }

            @media print {
                .button-block {
                    display: none !important;
                }

                body * {
                    visibility: hidden;
                }

                #CCForm6, #CCForm6 * {
                    visibility: visible;
                }

                #CCForm6 {
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 100%;
                }
            }

    </style>
      <script>
        function printCertificate() {
            var buttons = document.querySelectorAll(".button-block");
            buttons.forEach(button => button.style.display = 'none');

            window.print();

            buttons.forEach(button => button.style.display = 'flex');
        }
    </script>


                <div id="CCForm8" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Activated On">Remark</label>
                                <textarea name="qa_cqa_head_comment" maxlength="255">{{ $jobTraining->qa_cqa_head_comment }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="External Attachment">Attachment</label>
                                <input type="file" id="myfile" name="qa_cqa_head_attachment" value="{{ $jobTraining->qa_cqa_head_attachment }}">
                                <a href="{{ asset('upload/' . $jobTraining->qa_cqa_head_attachment) }}" target="_blank">{{ $jobTraining->qa_cqa_head_attachment }}</a>
                            </div>
                        </div>
  
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>                                    
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
                        </div>
                    </div>
                </div>

                <div id="CCForm9" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                        <div class="col-lg-12">
                            <div class="group-input">
                                <label for="Activated On">Remark</label>
                                <textarea name="final_review_comment" maxlength="255">{{ $jobTraining->final_review_comment }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="External Attachment">Attachment</label>
                                <input type="file" id="myfile" name="final_review_attachment" value="{{ $jobTraining->final_review_attachment }}">
                                <a href="{{ asset('upload/' . $jobTraining->final_review_attachment) }}" target="_blank">{{ $jobTraining->final_review_attachment }}</a>
                            </div>
                        </div>
  
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>                                    
                            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
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


    <div class="modal fade" id="signature-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('rcms/job_trainer_send', $jobTraining->id) }}" method="POST"
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

                <div class="modal-header">
                    <h4 class="modal-title">E-Signature</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('tms/jobTraining/cancelstage', $jobTraining->id) }}" method="POST">
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
