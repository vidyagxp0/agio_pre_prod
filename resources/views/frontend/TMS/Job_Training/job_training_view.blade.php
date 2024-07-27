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

    #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(3) {
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
        <strong>Site Division/Project</strong> :
        {{ Helpers::getDivisionName(session()->get('division')) }} / On the Job
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
                    $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => 4])->get();
                    $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                    // dd($jobTraining->division_id);
                    @endphp

                    <button class="button_theme1">
                        <a class="text-white" href="{{ route('job_audittrail', $jobTraining->id) }}"> Audit Trail
                        </a>
                    </button>

                    @if ($jobTraining->stage == 1)
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        Retire
                    </button>
                    @elseif($jobTraining->stage == 2)
                    <!-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        Retire
                    </button> -->
                    @endif
                    <button class="button_theme1"> <a class="text-white" href="{{ url('TMS') }}"> Exit
                        </a> </button>


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

                    <!-- @if ($jobTraining->stage >= 3)
                    <div class="active">Active </div>
                    @else
                    <div class="">Active</div>
                    @endif -->

                    @if ($jobTraining->stage >= 2)
                    <div class="bg-danger">Closed - Done</div>
                    @else
                    <div class="">Closed - Retired</div>
                    @endif
                    @endif


                </div>
                {{-- @endif --}}
                {{-- ---------------------------------------------------------------------------------------- --}}
            </div>
        </div>

        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>

        </div>

        <script>
            $(document).ready(function() {
                <?php if (in_array($jobTraining->stage, [2])) : ?>
                    $("#target :input").prop("disabled", true);
                <?php endif; ?>
            });
        </script>

        <form id="target" action="{{ route('job_trainingupdate', ['id' => $jobTraining->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div id="step-form">

                @if (!empty($parent_id))
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif
                <!-- General information content -->
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RLS Record Number">Employee ID</label>
                                    <input type="text" name="employee_id" value="">
                                    {{<div class="static">QMS-EMEA/CAPA/{{ date('Y') }}/{{ $record_number }}
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-6">
                    <div class="group-input">
                        <label for="RLS Record Number">Name </label>
                        <input type="text" name="name" id="name_employee" value="{{ $jobTraining->name }}">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="group-input">
                        <label for="Department">Department</label>
                        <select name="department">
                            <option value="">-- Select Dept --</option>
                            {{-- @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ $department->id == old('department', $jobTraining->department) ? 'selected' : '' }}>
                            {{ $department->name }}
                            </option>
                            @endforeach --}}
                            @php
                            $savedDepartmentId = old('department', $jobTraining->department);
                            @endphp

                            @foreach (Helpers::getDepartments() as $code => $department)
                            <option value="{{ $code }}" @if ($savedDepartmentId==$code) selected @endif>{{ $department }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="group-input">
                        <label for="Division Code">Location</label>

                        <input type="text" name="location" value="{{$jobTraining->location}}">

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="group-input">
                        <label for="HOD Persons">HOD</label>
                        <select name="hod" id="hod">
                            <option value="">-- Select HOD --</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == old('hod', $jobTraining->hod) ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>




                {{-- <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Start Date of Training</label>
                                        <div class="calenderauditee">                                     
                                            <input type="text"  id="startdate"  value="{{ Helpers::getdateFormat($jobTraining->startdate) }}" readonly placeholder="DD-MMM-YYYY" />
                <input type="date" name="startdate" value="{{ Helpers::getdateFormat($jobTraining->startdate) }}" class="hide-input" oninput="handleDateInput(this, 'startdate')" />
            </div>

    </div>
</div>
<div class="col-md-6 new-date-data-field">
    <div class="group-input input-date">
        <label for="due-date">End Date of Training</label>
        <div class="calenderauditee">
            <input type="text" id="enddate" value="{{ Helpers::getdateFormat($jobTraining->enddate) }}" readonly placeholder="DD-MMM-YYYY" />
            <input type="date" name="enddate" value="{{ Helpers::getdateFormat($jobTraining->enddate) }}" class="hide-input" oninput="handleDateInput(this, 'enddate')" />
        </div>
    </div>
</div>--}}








<div class="col-12">
    <div class="group-input">
        <div class="why-why-chart">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%;">Sr.No.</th>
                        <th style="width: 30%;">Subject</th>
                        <th>Type of Training</th>
                        <th>Reference Document No.</th>
                        {{-- <th>Trainee Name</th> --}}
                        <th>Trainer</th>
                        <th>Start Date of Training</th>
                        <th>End Date of Training</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    // Fetch the trainers' IDs
                    $trainerIds = DB::table('user_roles')->where('q_m_s_roles_id', 6)->pluck('user_id');
                    $usersDetails = DB::table('users')->select('id', 'name')->get();
                    $trainers = DB::table('users')->whereIn('id', $trainerIds)->select('id', 'name')->get();
                    @endphp

                    @for ($i = 1; $i <= 5; $i++) <tr>
                        <td>{{ $i }}</td>
                        <td>
                            <input type="text" name="subject_{{ $i }}" value="{{ $jobTraining->{'subject_' . $i} }}">
                        </td>
                        <td>
                            <input type="text" name="type_of_training_{{ $i }}" value="{{ $jobTraining->{'type_of_training_' . $i} }}">
                        </td>
                        <td>
                            <input type="text" name="reference_document_no_{{ $i }}" value="{{ $jobTraining->{'reference_document_no_' . $i} }}">
                        </td>
                        {{-- <td>
                        <select name="trainee_name_{{ $i }}" id="">
                        <option value="">-- Select --</option>
                        @foreach ($trainers as $trainer)
                        <option value="{{ $trainer->id }}" {{ $jobTraining->{'trainee_name_' . $i} == $trainer->id ? 'selected' : '' }}>{{ $trainer->name }}</option>
                        @endforeach
                        </select>
                        </td> --}}
                        <td>
                            <select name="trainer_{{ $i }}" id="">
                                <option value="">-- Select --</option>
                                @foreach ($usersDetails as $u)
                                <option value="{{ $u->id }}" {{ $jobTraining->{'trainer_' . $i} == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="date" name="startdate_{{ $i }}" value="{{ $jobTraining->{'startdate_' . $i} }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'startdate');checkDate('startdate','enddate')">
                        </td>
                        <td>
                            <input type="date" name="enddate_{{ $i }}" value="{{ $jobTraining->{'enddate_' . $i} }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'enddate');checkDate('startdate','enddate')">
                        </td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>




</div>
<div class="button-block">
    <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
    {{-- <button type="button" id="ChangeNextButton" class="nextButton">Next</button> --}}
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


<div class="modal fade" id="signature-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ url('rcms/job_trainer_send', $jobTraining->id) }}" method="POST" id="signatureModalForm">
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
                        <div class="spinner-border spinner-border-sm signatureModalSpinner" style="display: none" role="status">
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
@endsection