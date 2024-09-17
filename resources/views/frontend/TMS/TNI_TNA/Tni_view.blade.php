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

    #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(5) {
        border-radius: 0px 20px 20px 0px;
    }
    #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(1) {
        border-radius: 20px 0px 0px 20px;
    }
</style>

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
<div class="form-field-head">
    <div class="pr-id">
        New Employee
    </div>
    {{-- <div class="division-bar">
            <strong>Site Division/Project</strong> :
            Plant
        </div> --}}
    {{-- <div class="button-bar">
            <button type="button">Save</button>
            <button type="button">Cancel</button>
            <button type="button">New</button>
            <button type="button">Copy</button>
            <button type="button">Child</button>
            <button type="button">Check Spelling</button>
            <button type="button">Change Project</button>
        </div> --}}
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
                    {{-- @php
                    $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' => $data->division_id])->get();
                    $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                @endphp --}}
                    {{-- <button class="button_theme1" onclick="window.print();return false;"
                        class="new-doc-btn">Print</button> --}}
                    {{--  <button class="button_theme1"> <a class="text-white" href="{{ url('send-notification', $data->id) }}"> Send Notification </a> </button>  --}}
                    {{-- {{ dd($data->stage);}} --}}
                   {{-- <a class="button_theme1 text-white"
                            href="{{ url('rcms/action-item-audittrialshow', $data->id) }}"> Audit Trail </a>  --}}
                    {{-- @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                        <a href="#signature-modal"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Submit
                        </button></a>
                       <a href="#cancel-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                            Cancel
                        </button></a>
                        {{-- @elseif($data->stage == 2 && (in_array(4, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                       {{-- <a href="#cancel-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                            More Information Required
                        </button></a> --}}
                        {{-- <a href="#child-modal1"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal1">
                            Child
                        </button></a> --}}
                        {{-- <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Acknowledge Complete
                        </button></a> --}}
                        {{-- @elseif($data->stage == 3 && (in_array(8, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                        <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                             Complete
                        </button></a>
                        {{-- <a href="#cancel-modal"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                            More Information Required
                        </button></a> --}}
                        {{-- @elseif($data->stage == 4 && (in_array(7, $userRoleIds) || in_array(18, $userRoleIds))) --}}
                       {{-- <a href="#signature-modal"> <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                       Verification  Complete
                        </button></a> --}}
                        <a href="#cancel-modal"><button class="button_theme1" data-bs-toggle="modal" data-bs-target="#more-info-required-modal">
                            More Information Required
                        </button></a>
                    {{-- @elseif($data->stage == 2 && (in_array(8, $userRoleIds) || in_array(18, $userRoleIds)))
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                            Complete
                        </button>
                        <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#cancel-modal">
                            More Information Required
                        </button> --}}
                    {{-- @endif --}}
                    <a class="text-white button_theme1" href="{{ url('rcms/qms-dashboard') }}"> Exit </a>
                </div>
            </div>
            <div class="status">
                <div class="head">Current Status</div>
                    {{-- @if ($data->stage == 0) --}}
                    {{-- <div class="progress-bars"> --}}
                        {{-- <div class="active bg-danger">Closed-Cancelled</div> --}}
                    {{-- @else --}}
                    <div class="progress-bars d-flex">
                        {{-- @if ($data->stage >= 1) --}}
                            <div class="active">Opened</div>
                        {{-- @else --}}
                            {{-- <div class="">Opened</div> --}}
                        {{-- @endif --}}
                    
                        {{-- @if ($data->stage >= 2) --}}
                            {{-- <div class="active"> Pending TNI Approval</div> --}}
                        {{-- @else --}}
                            <div class=""> Pending TNI Approval</div>
                        {{-- @endif  --}}
                        {{-- @if ($data->stage >= 3) --}}
                        {{-- <div class="active">Pending Review  of Updated TNI</div> --}}
                    {{-- @else --}}
                        <div class="">Pending Review  of Updated TNI</div>
                    {{-- @endif --}}
                  
                    {{-- @if ($data->stage >= 4) --}}
                    {{-- <div class="bg-danger">Closed - Done</div> --}}
                {{-- @else --}}
                    <div class="">Closed - Done </div>
                {{-- @endif --}}
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>

        <!-- Tab links -->
        <div class="cctab">

            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Employee</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm2')">External Training</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>

        </div>
        <form  method="POST" enctype="multipart/form-data">
            {{-- action="{{ route('Tni.update',Tni->id) }}" --}}
            @csrf
            <!-- Tab content -->
            <div id="step-form">

                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                          

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="site_name">Name <span class="text-danger">*</span></label>
                            <input type="text" id="site_division" name="site_division" >
                        </div>
                    </div>
    <div class="col-lg-6 new-date-data-field">
        <div class="group-input input-date">
            <label for="Joining Date">Joining Date</label>
            <div class="calenderauditee">
                <input type="text" id="joining_date" readonly placeholder="DD-MMM-YYYY" />
                <input type="date" name="joining_date" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'joining_date')" />
            </div>
        </div>
    </div>



</div>

<div class="button-block">
    <button type="submit" id="ChangesaveButton01" class="saveButton">Save</button>
    <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
    <button type="button" class="backButton" onclick="previousStep()">Back</button>
    <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
            Exit </a> </button>
</div>

</div>
</div>
</div>

<!-- Tab content -->
<div id="CCForm2" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="group-input" id="external-details-grid">
                <label for="audit-agenda-grid">
                    External Training Details
                    <button disabled type="button" name="audit-agenda-grid" id="details-grid">+</button>
                    <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                        (Launch Instruction)
                    </span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="external-training-table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 50px;">Sr. No.</th>
                                <th>Topic</th>

                                <th style="width: 200px;">External Training Date</th>
                                <th>External Trainer</th>

                                <th>External Training Agency</th>
                                <th style="width: 200px;">Certificate</th>
                                <th style="width: 200px;">Supporting Documents</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input disabled type="text" name="external_training[0][serial]" value="1"></td>
                                <td><input disabled type="text" name="external_training[0][topic]"></td>
                                <td><input disabled type="date" name="external_training[0][external_training_date]"></td>
                                <td><input disabled type="text" name="external_training[0][external_trainer]"></td>
                                <td><input disabled type="text" name="external_training[0][external_agency]"></td>
                                <td><input disabled type="file" name="external_training[0][certificate]"></td>
                                <td><input disabled type="file" name="external_training[0][supproting_documents]"></td>
                            </tr>

                        </tbody>

                    </table>
                </div>
                <div class="col-12">
                    <div class="group-input">
                        <label for="External Comments">External Comments</label>
                        <textarea disabled name="external_comment"></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="group-input">
                        <label for="External Attachment">External Attachment</label>
                        <input disabled type="file" id="myfile" name="external_attachment">
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $('#details-grid').click(function(e) {
                        function generateTableRow(serialNumber) {
                            var users = @json($users);

                            var html =
                                '<tr>' +
                                '<td><input disabled type="text" name="external_training[' + serialNumber +
                                '][serial]" value="' + serialNumber +
                                '"></td>' +
                                '<td><input type="text" name="external_training[' + serialNumber +
                                '][topic]"></td>' +
                                '<td><input type="date" name="external_training[' + serialNumber +
                                '][external_training_date]"></td>' +
                                '<td><input type="text" name="external_training[' + serialNumber +
                                '][external_trainer]"></td>' +
                                '<td><input type="text" name="external_training[' + serialNumber +
                                '][external_agency]"></td>' +
                                '<td><input type="file" name="external_training[' + serialNumber +
                                '][certificate]"></td>' +
                                '<td><input type="file" name="external_training[' + serialNumber +
                                '][supproting_documents]"></td>' +
                                '</tr>';

                            // for (var i = 0; i < users.length; i++) {
                            //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                            // }

                            '</tr>';

                            return html;
                        }

                        var tableBody = $('#external-training-table tbody');
                        var rowCount = tableBody.children('tr').length;
                        var newRow = generateTableRow(rowCount + 1);
                        tableBody.append(newRow);
                    });
                });
            </script>

        </div>
        <div class="button-block">
            <button type="submit" id="ChangesaveButton02" class="saveButton">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" id="ChangeNextButton" class="nextButton">Next</button>
            <button type="button"> <a href="{{ url('TMS') }}" class="text-white">
                    Exit </a> </button>
        </div>
    </div>
</div>

<script>
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
<!-- Activity Log content -->
<div id="CCForm6" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="row">
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Activated By">Activated By</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Activated On">Activated On</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for=" Rejected By">Retired By</label>
                    <div class="static"></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Rejected On">Retired On</label>
                    <div class="static"></div>
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