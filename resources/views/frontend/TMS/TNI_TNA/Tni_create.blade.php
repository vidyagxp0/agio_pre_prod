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
      TNI
    </div>
    
</div>




{{-- ======================================
                    DATA FIELDS
    ======================================= --}}
<div id="change-control-fields">
    <div class="container-fluid">

        <!-- Tab links -->
        <div class="cctab">

            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
            <button class="cctablinks " onclick="openCity(event, 'CCForm2')">External Training</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Activity Log</button>

        </div>
        <form action="{{ route('tni.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Tab content -->
            <div id="step-form">

                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                          

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="site_name">Record Number </label>
                            <input type="text" id="record_number" name="record_number" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="site_name">Site / Location <span class="text-danger">*</span></label>
                            <input type="text" id="site_division" name="site_division" >
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="site_name">Initiator <span class="text-danger">*</span></label>
                            <input type="text" id="Initiator_id" name="Initiator_id" >
                        </div>
                    </div>
                    <div class="col-lg-6 new-date-data-field">
                        <div class="group-input input-date">
                            <label for="Joining Date">Joining Date</label>
                            <div class="calenderauditee">
                                <input type="text" id="initiation_date" readonly placeholder="DD-MMM-YYYY" />
                                <input type="date" name="initiation_date" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'joining_date')" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="site_name">Department <span class="text-danger">*</span></label>
                            <input type="text" id="depart" name="initiation_date" >
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
            <div id="CCForm2" class="inner-block cctabcontent">
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